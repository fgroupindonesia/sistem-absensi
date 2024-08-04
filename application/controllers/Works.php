<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Works extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('DBWorks');
        $this->load->model('DBClient');
    }

    public function portal()
	{
		$this->load->view('portal');
	}

	private function send_email_activation($emailNa, $usernameNa, $tokenNa, $waNa){

		// the API key from elasticemails
		// 2D4A325AD5254D2572BE2AF3F554E2D5067252A744D63A79DE2B0C3A67B89960702138D35AB8CECA6A260B65CC90C2BF

	$judul = "Aktifasi Akun Sistem Absensi";
	$dest = $emailNa;
	$fullname = $usernameNa;
	$token = $tokenNa;
	$wa = $waNa;

	$data = array(
		'name' => $fullname,
		'code' => $token,
		'whatsapp' => $wa
	);	


	$htmlkonten =	$this->load->view('email_templates/email_activation', $data, true);

try {


	$this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.mailersend.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'MS_a68HiS@fgroupindonesia.com';
        $mail->Password = 'HSv5JwwPZTfigafw';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;

        $emailSenderAs = 'info@fgroupindonesia.com';
        $cpName = 'FGI - FGroupIndonesia';

        $mail->setFrom($emailSenderAs, $cpName);
        $mail->addReplyTo($emailSenderAs, $cpName);

        // Add a recipient
        $mail->addAddress($dest);

        // Add cc or bcc 
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Email subject
        $mail->Subject = $judul;

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mail->Body = $htmlkonten;

        // Send email
        if(!$mail->send()){
            //echo 'Message could not be sent.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            //echo 'Message has been sent';
        }
	

		} catch(Exception $ex){
			echo $ex->getMessage();
		}
	

	}

	private function is_time_passed_hours($limitHour, $dateNa){


		date_default_timezone_set('Asia/Jakarta');
		$currentTime = time();

    // Convert the given datetime string to a timestamp
    $givenTime = strtotime($dateNa);

    // Check if the given time is valid
    if ($givenTime === false) {
        return false; // Invalid datetime string
    }

    // Add 3 hours to the given time
    $threeHoursAhead = $givenTime + ($limitHour * 3600); // 3 hours in seconds

    // Check if the current time is less than the calculated three hours ahead time
    return $currentTime < $threeHoursAhead;

	}

	// this is called by email link clicked
	public function activate(){

		$v = false;

		$pWA = $this->input->get('whatsapp');
		$pType = $this->input->get('type');
		$pToken = $this->input->get('token');

		$madeAtDate = $this->input->get('date');
		$madeAtTime = $this->input->get('time');

		$completeDate = $madeAtDate . " " . $madeAtTime;
		$dataUser = null;

		// we limit this activation using 3 hours limit only
		$stillSafeTime = $this->is_time_passed_hours(3, $completeDate);

		if(isset($pToken) && isset($pType)){

			if($pType == 'student' && $stillSafeTime){
			// student use db from portal
			// check first is this account already activated or not?
				$v =	$this->DBWorks->verifyAndActivate($pToken);
				$dataDB = $this->DBWorks->getUserByToken($pToken);

				$dataUser = array(
					'username' 		=> $dataDB->username,
					'phone_numbers' => $dataDB->phone_numbers,
					'email'			=> $dataDB->email
				);

			} else if ($pType != 'student' && $stillSafeTime) {

			// client use db from staff (sistem absen)
			$v = 	$this->DBClient->activate($pToken);
			$dataDB = $this->DBClient->getStaffByTokenAndWa($pToken, $pWA);
			
				$dataUser = array(
					'username' 		=> $dataDB->username,
					'phone_numbers' => $dataDB->whatsapp,
					'email'			=> $dataDB->email
				);


			}

			if($stillSafeTime){
				
		// pass the data into client view
		// so the client will save it into localstorage (browser)
				$this->load->view('portal_activation_success', $dataUser);
			}else{
				$this->load->view('portal_activation_failed');
			}

		}

		// echo json_encode($v);

	}

	// the same function inside models
	private function generateToken($digit){
 	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $digit; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

   
		return $randomString;
	}

	// this will be called by JS
	public function add_staff(){
		$n = $this->input->post('name');
		$u = $this->input->post('unit_division');
		$w = $this->input->post('whatsapp');
		$e = $this->input->post('email');
		$k = $this->input->post('kelamin');
		$s = $this->input->post('status');
		$n = $this->input->post('notes');
		$ni = $this->input->post('number_ic');
		$tk = $this->input->post('public_token');

		//$tk = $this->akses->getPublicToken();
		$data = array();

		$data['name'] = $n;
		$data['unit_division'] = $u;
		$data['whatsapp'] = $w;
		$data['email']	= $e;
		$data['kelamin'] = $k;
		$data['status'] = $s;
		$data['notes'] = $n;
		$data['number_ic'] = $ni;
		$data['public_token'] = $tk;

		$this->DBClient->add_new_staff($data);
		echo "success";
			
	}

	// this will be called by JS
	public function edit_staff(){
		$id = $this->input->post('id');
		$tk = $this->input->post('public_token');
		
		//$tk = $this->akses->getPublicToken();
		$data = array(
			'id'=>$id,
			'public_token'=>$tk
		);

		$hasil = $this->DBClient->getStaffByTokenAndID($data);
		echo json_encode($hasil);
			
	}

	// this will be called by JS
	public function update_staff(){
		$id = $this->input->post('id');
		$n = $this->input->post('name');
		$u = $this->input->post('unit_division');
		$w = $this->input->post('whatsapp');
		$e = $this->input->post('email');
		$k = $this->input->post('kelamin');
		$s = $this->input->post('status');
		$nt = $this->input->post('notes');
		$ni = $this->input->post('number_ic');
		$tk = $this->input->post('public_token');

		//$tk = $this->akses->getPublicToken();
		$data = array();

		$data['id'] = $id;
		$data['name'] = $n;
		$data['unit_division'] = $u;
		$data['whatsapp'] = $w;
		$data['email']	= $e;
		$data['kelamin'] = $k;
		$data['status'] = $s;
		$data['notes'] = $nt;
		$data['number_ic'] = $ni;
		$data['public_token'] = $tk;

		$this->DBClient->update_existing_staff($data);
		echo "success";
			
	}

	// this will be called by JS
	public function delete_staff(){
		$id = $this->input->post('id');
		$tk = $this->input->post('public_token');

		//$tk = $this->akses->getPublicToken();
		$data = array();

		$data['id'] = $id;
		$data['public_token'] = $tk;

		$this->DBClient->delete_existing_staff($data);
		echo "success";
			
	}

	public function register()
	{
		$u = $this->input->post('username');
		$p = $this->input->post('pass');
		$e = $this->input->post('email');
		$w = $this->input->post('whatsapp');

		$data = array(
			'username'=>$u,
			'pass'=>$p,
			'email'=>$e,
			'whatsapp'=>$w	);

        // default data definition
		$pToken = $this->generateToken(7);

        $data['user_type'] = "company";
        $data['avatar'] = "sample.jpg";
		$data['public_profile'] = 0;
        
		$data['address'] = "-";
        $data['country'] = "indonesia";
        $data['city'] = "-";
        $data['bio'] = "-";
        $data['membership'] = "gratis";
		$data['public_token'] = $pToken;
		$data['status'] = "active";
		//$data['status'] = "pending";

		$dataMembersip = array(
			'name' => 'gratis',
			'quota_used' => 0,
			'quota_limit' => 5,
			'public_token' => $pToken
		);

		$hasil = $this->DBClient->add_new_user($data);
		$hasil = $this->DBClient->add_new_membership($dataMembersip);

		if($hasil){
			redirect('/portal/admin');
			//echo (json_encode($data));
		}

		echo json_encode($hasil);
	}

	public function verifikasi()
	{
		// received by POST of js call from client
		$wa = $this->input->post('phone_numbers');
		$email = $this->input->post('user_email');

		// we generate the new token incase
		// this account was found

		$incaseToken = $this->generateToken(7);

		$hasil = "";

		if(isset($wa)){

		$hasil = $this->DBWorks->verifyExist($wa, 'wa', $incaseToken);

		}else if(isset($email)){

		$hasil = $this->DBWorks->verifyExist($email, 'email', $incaseToken);

		$username = null;
		$token = null;

			if($hasil != false){
				$wa 		= $hasil->mobile;

				if($this->is_empty($wa)){
					$wa = $hasil->phone_numbers;
				}

				$username 	= $hasil->username;
				$token 		= $hasil->public_token;
			}

		// send the email
		if($username != null)	
		$this->send_email_activation($email, $username, $token, $wa);

		}

		echo json_encode($hasil);
	}

	private function is_empty($data){
		if($data == 'not available'){
			return true;
		} else if($data == ''){
			return true;
		}else if(strlen($data) == 0){
			return true;
		}else if($data == null){
			return true;
		}

		return false;
	}


	public function add_absensi(){

		// using POST parameter
		$email 	=	$this->input->post('email');
		$client =	$this->input->post('client');

		// the client type is the sender
		// thus it would be either : portal or device (mobile)	

		$result = null;
		$fromWhere = null;

		if(isset($email)){
			$result =	$this->DBWorks->verifyByColumn('email', $email);

			if($result == false){
				
				// check from another database
				$result = $this->DBClient->verifyByColumn('email', $email);

				if($result != false){
					$fromWhere = "client";
				}

			}else{
				$fromWhere = "portal";
			}


			if($result != false){

				if($fromWhere != null){
					// we execute it 
					$dataArray = (array) $result;

					if($fromWhere == "client"){
						$result =	$this->DBClient->add_new_attendance($dataArray);
					}else if($fromWhere == "portal"){
						$result =	$this->DBWorks->add_new_attendance($dataArray, null);
					}
				}

				echo json_encode($result);
			}

		}

	 	

	}

	public function verifikasiwa()
	{
		// received by POST of js call from client
		$digit7 = $this->input->post('code');
		
		if(isset($digit7)){

		$hasil = $this->DBWorks->verifyAndActivate($digit7);

		if($hasil == false){
			// when the data is not coming from the first db
			// thus we verify the second data coming from 
			// the attendance system table
			$hasil = $this->DBClient->activate($digit7);
		}

		}

		echo json_encode($hasil);
	}

	public function absen_sebelumnya(){

		$username = $this->input->post('username');

		$hasil = $this->DBWorks->getAllAttendance($username);
	
		echo json_encode($hasil);
	}

	public function admin_login(){

		$u = $this->input->post('username');
		$p = $this->input->post('pass');

		// check langsung
		$n = $this->DBClient->verify($u, $p);
		// store data user di session
		$dataUser = $this->DBClient->getSpecific($u);

		//echo var_dump($dataUser);
		$dataEntry = (array)$dataUser;

		// bakalan ke store dan terpakai oleh library Akses
		$this->session->set_userdata($dataEntry);

		if($n == false){
			redirect('/portal/admin?status=error');
		}else{
			redirect('/portal/dashboard');
		}

	}

	public function admin_logout(){
		$this->clearAllSession();
		redirect('portal/admin');
	}	

	private function clearAllSession(){
		$this->session->sess_destroy();
	}


}
