<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Works extends CI_Controller {

	public function __construct() {

		date_default_timezone_set('Asia/Jakarta');
        parent::__construct();
        $this->load->model('DBWorks');
        $this->load->model('DBClient');
    }

public function check_device_tag(){

    $this->akses->global_anticors();

    $tag = $this->input->post('device_tag');

    $result = array(
        'status' => 'failed',
        'message' => 'data not found!'
    );

    $filter = array(
        'device_tag' => $tag
    );

    if(!empty($tag)){
        $hasil = $this->DBClient->getSpecificBy('table_staff', $filter);     


        if($hasil){
            $result['status'] = 'success';
            $result['message'] = 'data exist!';
        }
    }
   
   return json_encode($result);

}

public function clear_tag(){

    // terima id dan public token
    $id = $this->input->post('id');
    $token = $this->input->post('public_token');

    if (!$id || !$token) {
        echo json_encode(['status' => 'error', 'message' => 'no access']);
        return;
    }

    $filter = array(
        'id' => $id,
        'public_token' => $token
    );

   $hasil =  $this->DBClient->clearStaffTagBy($filter);

   if($hasil){

    $result['status'] = 'success';
    $result['message'] = 'Device Tag berhasil dibersihkan!';

   }

   echo json_encode($result);

}

public function upgrade_membership()
{
    // Pastikan request POST
    $id = $this->input->post('id');
    $level = strtolower($this->input->post('level')); // semua lowercase

    if (!$id || !$level) {
        echo json_encode(['status' => 'error', 'msg' => 'ID atau level tidak valid']);
        return;
    }

    $filter = array('id' => $id);

    // Ambil user dari DB
    $user = $this->DBClient->getSpecificBy('table_user', $filter);
    if (!$user) {
        echo json_encode(['status' => 'error', 'msg' => 'User tidak ditemukan']);
        return;
    }

    $token = $user->public_token;
    $email = $user->email;
    $username = $user->username;

    // Tentukan kuota sesuai level
    $quota = $this->akses->getAccountQuota($level);

    $data_membership_baru = array(
        'name' => $level,
        'quota_limit' => $quota
    );

    // Update user membership & kuota
    $this->DBClient->update_membership($token, $data_membership_baru);
    
    // Kirim email sederhana
   $this->send_email_upgrade_account_success($username, $email, $level);

    // Return sukses
    echo json_encode(['status' => 'success', 'msg' => "User berhasil diupgrade ke '$level'."]);
}


  public function check_email_user()
{
    // ambil email dari POST
    $email = $this->input->post('email');

    // cek apakah email ada di database
    $filter = array('email' => $email);

    $exists = $this->DBClient->getSpecificBy('table_user', $filter);

    if ($exists) {
        // kalo sudah ada
        $response = [
            'status'  => 'error',
            'message' => 'Email sudah terpakai!'
        ];
    } else {
        // kalo belum ada
        $response = [
            'status'  => 'success',
            'message' => 'Akun aman digunakan!'
        ];
    }

    // balikin json
    echo json_encode($response);
}


    public function add_user(){

    	// this user is company
    	$membership = $this->input->post('membership');
    	$email 		= $this->input->post('email');
    	$username 		= $this->input->post('username');

    	$wa = $this->input->post('whatsapp');
    	$wa = format_hp_clear($wa);

    	 $data = [
            'username'       => $username,
            'email'          => $email,
            'pass'       	 => $this->input->post('pass'),
            'bio'            => $this->input->post('bio'),
            'country'        => $this->input->post('country'),
            'region'         => $this->input->post('region'),
            'whatsapp'       => $wa,
            'user_type'      => 'company',
            'city'           => $this->input->post('city'),
            'address'        	=> $this->input->post('address'),
            'public_profile' 	=> $this->input->post('public_profile') ? 1 : 0,
            'public_token' 		=> $this->generateToken(7)
        ];


        // check apakah ada avatar image?
         // Konfigurasi upload
    $config['upload_path']   = FCPATH . 'assets/img/avatars/';
    $config['allowed_types'] = 'jpg|jpeg|png|bmp';
    $config['max_size']      = 2048; // max 2MB
    $config['encrypt_name']  = TRUE; // biar nama file random

    $this->load->library('upload', $config);

  if ($this->upload->do_upload('avatar')) {
    $uploadData = $this->upload->data();
    $fileName   = $uploadData['file_name'];
    $data['avatar'] = $fileName; // simpan ke DB
} else {
    // kalau avatar optional, bisa di-skip errornya
    if (!empty($_FILES['avatar']['name'])) {
        $response['message'] = $this->upload->display_errors('', '');
    }
}


        // add also the membership type
        $data_membership = null;

        if(!empty($membership)){
        	$data_membership = array();
        	$data_membership['name'] = $membership;
        	$data_membership['quota_used'] = 0;
        	$data_membership['public_token'] = $data['public_token'];
        	$data_membership['quota_limit'] = $this->akses->getAccountQuota($membership);
        }

        // insert ke DB lewat model
        $insert = $this->DBClient->addNewUser($data, $data_membership);

        if ($insert) {
            $response = [
                'status'  => 'success',
                'message' => 'User berhasil ditambahkan'
            ];

            // kirim emailnya
            if(!empty($email)){
            	$this->send_email_registration_success($email, $username, $membership);	
            }
            

        } else {
            $response = [
                'status'  => 'error',
                'message' => 'Gagal menambahkan user'
            ];
        }

        // return JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));

    }

  public function delete_user()
    {
        // ambil data dari POST
        $ids   = $this->input->post('ids');
        $mode = $this->input->post('mode');

        // validasi token sederhana (optional, lu bisa ganti logic-nya)
        // klo dia orang management mode nya maka jalan broo
        if (empty($mode)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Acces tidak valid'
            ]);
            return;
        }

        if (!empty($ids) && is_array($ids)) {
            foreach ($ids as $id) {

            $filter = array('id'=> $id);
            $data_user = $this->DBClient->getSpecificBy('table_user', $filter);
            $token_dia = $data_user->public_token;
            $this->DBClient->deleteUser($id, $token_dia);
	               if ($data_user->avatar != 'sample.jpg' && file_exists('./assets/img/avatars/' . $data_user->avatar)) {
		            unlink('./assets/img/avatars/' . $data_user->avatar);
		        }
            }
            echo json_encode([
                'status' => 'success',
                'message' => 'User berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tidak ada data yang dipilih'
            ]);
        }
    }

  public function superadmin_management_order_update_stat() {
   
    // ambil data dari POST
    $orderId = $this->input->post('id');
    $newStatus = $this->input->post('status');

    if(!$orderId || !$newStatus) {
        echo json_encode(['status' => 'failed', 'message' => 'ID atau Status tidak valid']);
        return;
    }

    $filter = array(
    	'id' => $orderId
    );

    $data_order = $this->DBClient->getSpecificBy('table_order_membership', $filter);

    $filter2 = array(
    	'public_token' => $data_order->public_token
    );

    $data_user = $this->DBClient->getSpecificBy('table_user', $filter2);
    $data_membership = $this->DBClient->getSpecificBy('table_membership', $filter2);
    
    $quota_limit_lama = $data_membership->quota_limit;
    $quota_limit_baru = $this->akses->getAccountQuota($data_order->membership_name);

     $updateData = [
        'status'          => $newStatus,
        'public_token'    => $data_order->public_token,
        'membership_name' => $data_order->membership_name,
        'quota_final'		=> $quota_limit_lama + $quota_limit_baru
    ];

    // panggil model update
    $update = $this->DBClient->updateMembershipOrder($orderId, $updateData);




    if($newStatus == 'paid'){
    	$username 	= $data_user->username;
    	$email 		= $data_user->email;
    	$membership_name = $data_order->membership_name;

    	$this->send_email_upgrade_account_success($username, $email, $membership_name);
    }

    // response
    if($update){
        echo json_encode(['status' => 'success', 'message' => 'Status berhasil diperbarui']);
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Gagal update status']);
    }
}


    public function download_pdf_checkpoint()
{
    if (!empty($_FILES['file']['tmp_name'])) {
        $target = FCPATH . "assets/downloads/pdf/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $target);
        echo json_encode([
            "url" => base_url("assets/downloads/pdf/" . $_FILES['file']['name'])
        ]);
    }
}


    public function change_avatar_admin_settings() {
	   
	    $user_id = $this->input->post('id');
	    $action = $this->input->post('action');
	   
	    $cari = array(
	    	'id' => $user_id
	    );

	    $user = $this->DBClient->getSpecificBy('table_user', $cari);

	    if ($action == 'upload') {
	        $config['upload_path'] = './assets/img/avatars/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
	        $config['file_name'] = 'avatar_' . time();
	        $config['overwrite'] = TRUE;
	        
	        $this->load->library('upload', $config);

	        if (!$this->upload->do_upload('avatar')) {
	            return $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode(['status' => 'error', 'msg' => $this->upload->display_errors()]));
	        } else {
	            $upload_data = $this->upload->data();
	            $new_filename = $upload_data['file_name'];

	            // Delete old file if not default
	            if ($user->avatar != 'sample.jpg' && file_exists('./assets/img/avatars/' . $user->avatar)) {
	                unlink('./assets/img/avatars/' . $user->avatar);
	            }

	            $this->DBClient->update_avatar($user_id, $new_filename);

	            // update session entirely
	            $carian = array(
	            	'id'=> $user_id
	            );

	            $dataUser = $this->DBClient->getSpecificBy('table_user', $carian);
				$dataEntry = (array)$dataUser;
				$this->session->set_userdata($dataEntry);


	            return $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode(['status' => 'success']));
	        }

	    } elseif ($action == 'delete') {
	        if ($user->avatar != 'sample.jpg' && file_exists('./assets/img/avatars/' . $user->avatar)) {
	            unlink('./assets/img/avatars/' . $user->avatar);
	        }

	        $this->DBClient->update_avatar($user_id, 'sample.jpg');

	        // update too
	         $dataUser = $this->DBClient->getSpecificBy('table_user', $carian);
				$dataEntry = (array)$dataUser;
				$this->session->set_userdata($dataEntry);

	        return $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode(['status' => 'success']));
	    }
}


     public function update_admin_settings() {
        $this->output->set_content_type('application/json');


        $data = array(
        	'id'			=> $this->input->post('id')
        );

       $fields = array(
		    'username',
		    'password',  // kamu tulis 'pass', tapi diasumsikan field-nya 'password'
		    'email',
		    'bio',
		    'country',
		    'region',
		    'city',
		    'address',
		    'public_profile'
		);

		// Tambahkan field ke array jika post-nya tidak null
		foreach ($fields as $field) {
		    $value = $this->input->post($field);
		    if ($value !== null) {

		    	if($field == 'password'){
		    		$data['pass'] = $value;
		    	}else{
		    		$data[$field] = $value;	
		    	}
		        
		    }
		}
       
       $carian = array(
       	'id' => $data['id']
       );

       // check klo password dulu beda dgn yg terkini
       $dataUser = $this->DBClient->getSpecificBy('table_user', $carian);
       if(isset($data['pass'])){

       	if($data['pass'] != $dataUser->pass){
       		// kirim email notif
       		$email = $dataUser->email;
       		if(isset($data['email'])){
       			$email = $data['email'];
       		}
       		
       		$this->send_email_update_pass_success($dataUser->username, $email);
       	}

       }


        if ($this->DBClient->update_user($data)) {
        
	        // nyetor ulang disession
	       	$dataUser = $this->DBClient->getSpecificBy('table_user', $carian);
			$dataEntry = (array)$dataUser;
			$this->session->set_userdata($dataEntry);

            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate data']);
        }
    }

    public function update_user() {

    $id = $this->input->post('id'); // ambil id user
    $membership = $this->input->post('membership');
    $email = $this->input->post('email');
    $username = $this->input->post('username');
    $pass = $this->input->post('pass');
    $bio = $this->input->post('bio');
    $country = $this->input->post('country');
    $region = $this->input->post('region');
    $city = $this->input->post('city');
    $address = $this->input->post('address');
    $whatsapp = format_hp_clear($this->input->post('whatsapp'));
    $public_profile = $this->input->post('public_profile') ? 1 : 0;

    $data = [
        'username'       => $username,
        'email'          => $email,
        'pass'           => $pass,
        'bio'            => $bio,
        'country'        => $country,
        'region'         => $region,
        'city'           => $city,
        'address'        => $address,
        'whatsapp'       => $whatsapp,
        'public_profile' => $public_profile,
        'id' => $id
    ];

    // handle avatar upload jika ada
    if (!empty($_FILES['avatar']['name'])) {
        $config['upload_path']   = FCPATH . 'assets/img/avatars/';
        $config['allowed_types'] = 'jpg|jpeg|png|bmp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('avatar')) {
            $uploadData = $this->upload->data();
            $data['avatar'] = $uploadData['file_name'];
        } else {
            $response = [
                'status'  => 'error',
                'message' => $this->upload->display_errors('', '')
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }
    }

    // update user table
    $this->DBClient->update_user($data);
    //$this->db2->where('id', $id);
    //$this->db2->update('table_user', $data);

    // update membership jika ada
    if (!empty($membership)) {
        $membershipData = [
            'name'        => $membership,
            'quota_limit' => $this->akses->getAccountQuota($membership)
        ];
        $public_token = $this->input->post('public_token'); // harus dikirim hidden dari form
        $this->DBClient->update_membership($public_token, $membershipData);
        
    }

    $response = [
        'status'  => 'success',
        'message' => 'User berhasil diupdate'
    ];

    $this->output->set_content_type('application/json')->set_output(json_encode($response));
}


	public function delete_checkpoint(){

		 	$id = $this->input->post('id');
	    	$tk = $this->input->post('public_token');

	    	$result = array(
	    		'status' => 'error',
	    		'message' => 'no access!'
	    	);

	    	if(empty($tk)){

	    		 return $this->output
            ->set_status_header(400)
           ->set_output(json_encode($result));

	    	}

	    	$data = array(
	    		'id' => $id,
	    		'public_token'	=> $tk
	    	);

	    	 $saved = $this->DBClient->delete_checkpoint($data);

	    	if ($saved) {

	    		$result['status'] = 'success';
	    		$result['message'] = 'data berhasil terhapus!';

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
	    } else {

	    	$result['status'] = 'error';
	    	$result['message'] = 'data gagal terhapus!';

	        return $this->output
	             ->set_content_type('application/json')
	           ->set_output(json_encode($result));
	    }

	}

public function request_consultation()
{
    $judul = $this->input->post('judul');
    $deskripsi = $this->input->post('deskripsi');
    $tk = $this->input->post('public_token');


    if (!$judul || !$deskripsi) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode(['error' => 'Judul dan deskripsi wajib diisi.']));
    }

     if (!$tk) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode(['error' => 'akses ditolak!']));
    }
   
    $saved = $this->DBClient->save_request_consultation($judul, $deskripsi, $tk);

    if ($saved) {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    } else {
        return $this->output
            ->set_status_header(500)
            ->set_output(json_encode(['error' => 'Gagal menyimpan pengajuan.']));
    }
}


 public function report_bugs()
{
    $public_token = $this->input->post('public_token');

    if (!$public_token) {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => 'failed', 'message' => 'Token tidak ditemukan.']));
    }

    $postData = [
        'title' => $this->input->post('title'),
        'priority_bugs' => $this->input->post('priority_bugs'),
        'description' => $this->input->post('description'),
        'url' => $this->input->post('url'),
        'public_token' => $public_token
    ];

  
    $result = $this->DBClient->save_report_bug($postData, $_FILES);

    return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));
}



    public function add_division(){
    	$token = $this->input->post('public_token');
    	$name = $this->input->post('name');

    	$data = array(
    		'division_name' => $name,
    		'public_token'	=> $token
    	);

    	$hasil = $this->DBClient->add_new_division($data);

    	$response = array();
    	$response['status'] = 'failed';


    	if(!empty($hasil)){
    		$response['status'] = 'success';
    		$response['data'] = $hasil;

    	}

    	header('Content-Type: application/json');
		echo json_encode($response);

    }

      public function delete_division(){
    	$token = $this->input->post('public_token');
    	$id = $this->input->post('id');

    	$data = array(
    		'id'	=> $id
    	);

  	    $response = array();
    	$response['status'] = 'failed';

    	if(!empty($token) && !empty($id)){
    			$hasil = $this->DBClient->delete_division($data);

    			if(!empty($hasil)){
    				$response['status'] = 'success';
    				$response['data'] = $hasil;
    			}

    	}
    
    	header('Content-Type: application/json');
		echo json_encode($response);

    }

       public function update_division(){
    	$token 	= $this->input->post('public_token');
    	$id 	= $this->input->post('id');
    	$name 	= $this->input->post('name');

    	$data = array(
    		'id'	=> $id,
    		'division_name' => $name
    	);

  	    $response = array();
    	$response['status'] = 'failed';

    	if(!empty($token) && !empty($id)){
    			$hasil = $this->DBClient->update_division($data);

    			if(!empty($hasil)){
    				$response['status'] = 'success';
    				$response['data'] = $hasil;
    			}

    	}
    
    	header('Content-Type: application/json');
		echo json_encode($response);

    }

     public function all_division(){
    	$token = $this->input->post('public_token');
    	

    	$data = array(
    		'public_token'	=> $token
    	);

  	    $response = array();
    	$response['status'] = 'failed';
    	//$response['data'] = $data;

    	if(!empty($token)){
    			$hasil = $this->DBClient->getAllDivisionsByToken($data);

    			if(!empty($hasil)){
    				$response['status'] = 'success';
    				$response['data'] = $hasil;
    			}

    	}
    
    	header('Content-Type: application/json');
		echo json_encode($response);

    }

    public function summary_dashboard_staff_quota(){

    	
     	$token = $this->input->post('public_token');

  
     		$result = $this->DBClient->get_staff_quota_data($token);	
     
        

        echo json_encode($result);

    }

    public function summary_dashboard_attendance(){

    	// take the staff attandance by token
    	$token = $this->input->post('public_token');

    	$data = array(
    		'a.public_token' => $token
    	);

    	if(!empty($token))
    	$hasil = $this->DBClient->getSummaryAttendanceBy($data);

    	$response = array();
    		$response['status'] = 'failed';


    	if(!empty($hasil)){
    		$response['status'] = 'success';
    		$response['data'] = $hasil;

    	}

    	header('Content-Type: application/json');
		echo json_encode($response);



    }

    public function summary_dashboard_average(){

    	// take the staff attandance by token
    	$token = $this->input->post('public_token');

    	$data = array(
    		'public_token' => $token
    	);

    	if(!empty($token))
    	$hasil = $this->DBClient->getSummaryAverageAttendanceBy($data);

    	$response = array();
    		$response['status'] = 'failed';


    	if(!empty($hasil)){
    		$response['status'] = 'success';
    		$response['data'] = $hasil;

    	}

    	header('Content-Type: application/json');
		echo json_encode($response);


    }

    public function summary_dashboard_lowest_top(){

    	// take the staff attandance by token
    	$token = $this->input->post('public_token');

    	$data = array(
    		'a.public_token' => $token
    	);


    	if(!empty($token))
    	$hasil = $this->DBClient->getSummaryStaffCountAttendance($data);

    	$response = array();
    	$response['status'] = 'failed';


    	if(!empty($hasil)){
    		$response['status'] = 'success';
    		$response['data'] = $hasil;

    	}

    	header('Content-Type: application/json');
		echo json_encode($response);



    }

    public function portal()
	{
		$this->load->view('portal');
	}

	public function activate_staff() {

		$via = $this->input->post('via');
		$token = $this->input->post('public_token');
		$id = $this->input->post('id');

		$statusna = $this->input->post('status');
		// antara 1 atau 0

		$data = [
				'public_token' => $token,
				'id' => $id
			];

			// langsung turn off
		if($statusna == 0){
				$this->DBClient->activateStaff($data, false);		
		}
	
		// Default response
		$response = ['status' => 'failed'];
	
		if ($via === 'email') {
			
			$hasil = $this->DBClient->getStaffByTokenAndID($data);
	
			if (!empty($hasil)) {
				$email = $hasil->email;
				$username = $hasil->name;
				$wa = $hasil->whatsapp;
				
				// kalau trnyata minta dimatikan maka jgn kasih email
				if($statusna != 0)
				$this->send_email_activation2($email, $username, $token, $wa);
	
				$response['status'] = 'success'; // Ubah status jika berhasil
			}
		}
	
		// Output JSON
		header('Content-Type: application/json');
		echo json_encode($response);
	}




	public function send_email_attendance($emailNa, $usernameNa, $tokenNa, $status, $namaAcara){

		$formatter = new IntlDateFormatter(
			    'id_ID', // Locale
			    IntlDateFormatter::FULL, // Date style
			    IntlDateFormatter::SHORT, // Time style
			    'Asia/Jakarta',
			    IntlDateFormatter::GREGORIAN,
			    "EEEE, d MMMM yyyy HH:mm"
			);

			$waktuKonfirmasi = $formatter->format(new DateTime());


		if(!empty($tokenNa)){
				 $this->myemailer->send_html_email(
				    $emailNa,
				    "Status Kehadiran Anda!",
				    'email_templates/attendance_success',
				    array(
				        'username' => $usernameNa,
				        'jenis' => $jenis,
				        'event_name' => $namaAcara,
				        'status' => $status,
				        'waktu_konfirmasi' => $waktuKonfirmasi,
				        'tanggal_email' => date('j F Y h:i:s')
				    )
					);
		}

	}

public function send_email_upgrade_account_success($username, $email, $membership_name){

	if(!empty($username)){

			date_default_timezone_set('Asia/Jakarta');

				 $this->myemailer->send_html_email(
				    $email,
				    "Upgrade Membership Akun Berhasil",
				    'email_templates/upgrade_account_verified_success',
				    array(
				        'username' => $username,
				        'membership_name' => $membership_name,
				        'tanggal_email' => date('j F Y h:i:s')
				    )
					);

				

		}

}

public function send_email_update_pass_success($usernameNa, $emailNa){


		if(!empty($usernameNa)){

			date_default_timezone_set('Asia/Jakarta');

				 $this->myemailer->send_html_email(
				    $emailNa,
				    "Profil Berhasil Diperbarui",
				    'email_templates/update_pass_success_admin_notif',
				    array(
				        'username' => $usernameNa,
				        'link' => base_url() . 'portal/admin',
				        'tanggal_email' => date('j F Y h:i:s')
				    )
					);

				

		}

	}

public function send_email_registration_success($emailNa, $usernameNa, $jenis){


		if(!empty($emailNa)){

			date_default_timezone_set('Asia/Jakarta');

				 $this->myemailer->send_html_email(
				    $emailNa,
				    "Pendaftaran Berhasil!",
				    'email_templates/registration_success',
				    array(
				        'username' => $usernameNa,
				        'jenis' => $jenis,
				        'link' => base_url() . 'portal/admin',
				        'tanggal_email' => date('j F Y h:i:s')
				    )
					);

				 // ke admin
				 $emailAdmin = "fgroupindonesia@gmail.com";
				 $this->myemailer->send_html_email(
				    $emailAdmin,
				    "Pengguna Baru Telah Mendaftar",
				    'email_templates/registration_success_admin_notif',
				    array(
				        'username' => $usernameNa,
				        'jenis' => $jenis,
				        'link' => base_url() . 'portal/admin?type=management',
				        'date' => date('j F Y h:i:s')
				    )
					);

		}

	}

	public function send_email_staff_added($emailNa, $usernameNa,$jenis){


		if(!empty($emailNa)){


			$linkAsli = base_url(). 'install';
			//$linkAsliTesting = 'https://apps.fgroupindonesia.com/absensi/install';
            $linkAsliTesting = 'https://apkpure.com/p/apps.fgroupindonesia.com.absensi.staff';

			date_default_timezone_set('Asia/Jakarta');

				 $this->myemailer->send_html_email(
				    $emailNa,
				    "Pendaftaran Berhasil!",
				    'email_templates/registration_success_staff_notif',
				    array(
				        'username' => $usernameNa,
				        'link' => $linkAsliTesting,
				        'jenis_divisi' => $jenis,
				        'tanggal_email' => date('j F Y h:i:s')
				    )
					);
		}

	}

	public function send_email_checkpoint_generated($emailNa, $usernameNa, $tokenNa, $linkQRCode, $jenis, $event){


		if(!empty($tokenNa)){
				 $this->myemailer->send_html_email(
				    $emailNa,
				    "Checkpoint Berhasil Dibuat!",
				    'email_templates/checkpoint_success_generated',
				    array(
				        'username' => $usernameNa,
				        'link_qrcode' => $linkQRCode,
				        'event_name' => $event,
				        'jenis' => $jenis,
				        'tanggal_email' => date('j F Y h:i:s')
				    )
					);
		}

	}
	
	private function send_email_activation2($emailNa, $usernameNa, $tokenNa, $waNa)
{

	date_default_timezone_set('Asia/Jakarta');
		$date = date('l, d-F-Y H:i:s') . " WIB";
		$computerDate = date('Y-m-d');
		$computerTime = date('H:i:s');

		$linkAsli = base_url();
		$linkAsliTesting = 'https://apps.fgroupindonesia.com/absensi/';

		$link = $linkAsliTesting . "account/activate?token=" . $tokenNa . "&type=staff&date=" . $computerDate . "&time=" . $computerTime . "&whatsapp=" . $waNa;
   
   $this->myemailer->send_html_email(
    $emailNa,
    "Aktifasi Akun Sistem Absensi",
    'email_templates/email_activation',
    array(
        'name' => $usernameNa,
        'usertype' => 'staff',
        'link' => $link,
        'date' => $date
    )
	);


}

private function send_email_activation_device_access($emailNa, $usernameNa, $tokenNa)
{

	date_default_timezone_set('Asia/Jakarta');
		$date = date('l, d-F-Y H:i:s') . " WIB";
		$computerDate = date('Y-m-d');
		$computerTime = date('H:i:s');

   
   $this->myemailer->send_html_email(
    $emailNa,
    "Aktifasi Akun Sistem Absensi",
    'email_templates/email_activation_device_access',
    array(
        'name' => $usernameNa,
        'code' => $tokenNa,
        'date' => $date
    )
	);


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


		/*$this->load->library('phpmailer_lib');

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
        $mail->Body = $htmlkonten;*/

        // Send email
        //if(!$mail->send()){

		// Ambil input
			$emailnorep = "support@fgroupindonesia.com";

			// Email tujuan dan judul email
			$to = $dest; // Ganti dengan email tujuan sebenarnya
			$mailSubject = $judul;

			// Header email
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
			$headers .= "From: <$emailnorep>" . "\r\n";

			// Ambil isi template sebagai string
			$body = $htmlkonten;

			// Gantikan placeholder di template
			//$body = str_replace('$name', htmlspecialchars($name), $body);
			//$body = str_replace('$email', htmlspecialchars($email), $body);
			//$body = str_replace('$message', nl2br(htmlspecialchars($message)), $body);
			//$body = str_replace('$subject', htmlspecialchars($subject), $body);

			// Kirim email
			if (mail($to, $mailSubject, $body, $headers)) {
				echo "Sending Email success";
			} else {
				echo "Sending Email failed";
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

			$cari = array(
				'whatsapp' => $pWA,
				'public_token' => $pToken
			);

			$dataDB = $this->DBClient->getStaffByTokenAndWa($cari);
			
				$dataUser = array(
					'username' 		=> $dataDB->name,
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

	private function generate_qr($data_code){

		$back_path = "assets/img/qrcodes/";
		$qr_dir = FCPATH . $back_path;

		if (!is_dir($qr_dir)) {
		    mkdir($qr_dir, 0755, true); 
		}

		// generate 3 digit alphbet + 4 digit numeric leading zeros
		$randomAlpha = '';
		for ($i = 0; $i < 3; $i++) {
		    // Generate a random letter (a-z)
		    $randomAlpha .= chr(rand(97, 122));
		}

		// Generate a random number between 1 and 9999 with leading zeros
		$randomNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

		// Combine the letters and number
		$ran = $randomAlpha . $randomNumber;

		 $fileName =  "qr_" . $ran . ".png";
		 $complete_path = $qr_dir . $fileName;

		$config['cacheable']    = true; 
  		$config['quality']      = true; 
  		$config['size']         = '1024'; 
  		$config['black']        = array(224,255,255);
  		$config['white']        = array(70,130,180); 
  		$this->ciqrcode->initialize($config);


		$params['data'] 	= $data_code;
		$params['level'] 	= 'H'; 
		$params['size'] 	= 10;
		
		$params['savename'] = $complete_path;
		 
		$this->ciqrcode->generate($params);

		return base_url() . $back_path . $fileName;

	}

	public function recalibrate_checkpoint()
    {
        $code = $this->input->post('token');
        $id = $this->input->post('id');

	
		$valid = $this->DBClient->isTokenExist($code);

		$filter = array(
			'id' => $id,
			'public_token' => $code
		);

        // Simulasi path QR baru, misalnya hasil generate ulang berdasarkan waktu akhir
        $data_checkpoint = $this->DBClient->getSpecificBy('table_checkpoint', $filter);
		
		// data qr lama buang
		$this->clear_previous_qrcode($id, $code);

		// generate ulang data_embed simpen lagi ke update nya
		$data_embed_lama = $data_checkpoint->data_embed;

		date_default_timezone_set('Asia/Jakarta');
		$date = date('dmYHis');
	

		$parts = explode(";", $data_embed_lama);

		// buang elemen terakhir (timestamp lama)
		array_pop($parts);

		// tambah timestamp baru
		$parts[] = $date;

		// gabung lagi jadi string
		$data_embed = implode(";", $parts);
		$qr_code =  $this->generate_qr($data_embed);

		$invalidPath = base_url() . "assets/img/empty.png";

		$path = $invalidPath;

		if(!empty($valid)){
			$path = $qr_code;

			$data_update = array(
				'data_embed' => $data_embed,
				'qr_code' => basename($qr_code)
			);

			// update qrcode dan data aembed di db
			$this->DBClient->update_checkpoint($filter, $data_update);
		}

		$output = array(
			'status' => 'ok',
			'path'   => $path
		);
	
		echo json_encode($output);
    }

	// this will be called by JS
	public function add_checkpoint(){

		$end_result = array();

		
		$status_qr = $this->input->post('status'); // ini untuk qr 

		if($status_qr == 'non-active'){
			$status_qr = 'inactive';
		}

		$status = ''; // ini untuk json 

		$ne = $this->input->post('nama-event');
		$lk = $this->input->post('lokasi');

		$name = isset($ne) ? $ne : $lk;

		$lat = $this->input->post('lat');
		$long = $this->input->post('long');

		$lat = !empty($lat) ? $lat : 0;
		$long = !empty($long) ? $long : 0;

		$patokan = $this->input->post('patokan');
		$jenis = $this->input->post('jenis');
		$public_token = $this->input->post('public_token');
		$unit_division = $this->input->post('unit_division');
		
		$starting_time = $this->input->post('starting_time');
        $starting_date = $this->input->post('starting_date');
        $expired_mode = $this->input->post('expired_mode');

		// generate url
		// /randomnum/event-small-case
		$cleaned = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $name));
    	$nama_safe = strtr($cleaned, [' ' => '-']);

		$url_generated = date('dmYhis') . '/' . $nama_safe;
		
		// jika by event / kordinat name 
		// maka rekam data : 
		// EVENT
		// a. nama event
		// b. jenis (dinamis-statis)

		// LOKASI
		// a. nama lokasi
		// b. jenis (dinamis-statis)
		// c. long
		// d. lat

		$data_embed = null;

		date_default_timezone_set('Asia/Jakarta');
		$date = date('dmYHis');
		

		if($patokan == 'event'){
			$data_embed = $name . ";" . $jenis . ";" . $date;
		}else {
			$data_embed = $name . ";" . $jenis . ";" . $long . ";" . $lat . ";" . $date;
		}

		$nextID = $this->DBClient->nextCheckPointID();
		$data_embed = $nextID . ";" . $data_embed;	
		$qr_code = null;

		$data = array();

		if(isset($lk)){
			$data['location'] = $lk;
		}

		if(isset($unit_division)){
			$data['unit_division'] = $unit_division;
		}
		
		$data['patokan'] = $patokan;
		$data['jenis'] = $jenis;
		$data['url'] = $url_generated;
		$data['name'] = $name;
		$data['long']	= $long;
		$data['lat'] = $lat;
		$data['status'] = $status_qr;
		$data['data_embed'] = $data_embed;
		$data['qr_code'] = null; // first is empty null
		$data['public_token'] = $public_token;

        $data['starting_time'] = $starting_time;
        $data['starting_date'] = $starting_date;
        $data['expired_mode'] = $expired_mode;

		$res = $this->DBClient->add_new_checkpoint($data);

		$checkpoint_id = $res; // id hasil insert checkpoint
		$divisions = $this->input->post('division'); // array of division_id

		if($unit_division != 'public'){
				if(!empty($divisions)){
				    foreach($divisions as $div_id){
				    	
				    	$dataRelation = array(
				    		'division_id' => $div_id,
				    		'checkpoint_id' => $checkpoint_id,
				    		'public_token' => $public_token
				    	);
				    	
				        $this->DBClient->add_checkpoint_division($dataRelation);
				    }
				}	
		}

		if(!empty($res)){
			$status = "success";
			$qr_code = $this->generate_qr($data_embed);

			// now res is ID
			// update nama qrcode na
			$data['id'] = $res;
			$data['qr_code'] = basename($qr_code);

			$this->DBClient->update_existing_checkpoint($data);

			// pengiriman notifikasi ke user
			$emailNa = $this->akses->getEmail();
			$usernameNa = $this->akses->getUsername();
			$tokenNa = $this->akses->getPublicToken();

			//entry is the data_embed matching
			if($jenis == 'statis'){
				$linkAkses = base_url() . 'device/checkpoint/download/' . $url_generated;
			}else{
				$linkAkses = base_url() . 'device/checkpoint/display/' . $url_generated;
			}
			

			$this->send_email_checkpoint_generated($emailNa, $usernameNa, $tokenNa, $linkAkses, $jenis, $name);
		}

		if(empty($res))
		$status = "invalid";

		$end_result['status'] = $status;
		$end_result['qr_code'] = $qr_code;

		$safe_able_data = str_replace(";", "_", $data_embed);
		$safe_able_data = str_replace(" ", "_", $safe_able_data);
		

		$end_result['checkpoint'] = $safe_able_data;


		echo json_encode($end_result);
			
	}

	
	public function download_checkpoint($numeric, $event){

// isinya salah nih/// harusnya download pdf
	$response = array(
			'status' => 'failed',
			'message'	=> 'no access!'
		);

		$url = $numeric . '/' . $event;
		$carian = array(
			'url' => $url
		);

		$data_checkpoint = $this->DBClient->get_checkpoint_by_url($carian);
		 
		if(empty($data_checkpoint)){
			echo "<h2>NO ACCESS!</h2>";
			exit();
		}

		//echo json_encode($event);
		$link = base_url(). 'assets/img/qrcodes/' . $data_checkpoint->qr_code;
        
		$data = array(
			'title' => $event,
			'link' => $link
		);

        $file_pdf = $numeric . '_' . $event;

        $paper = 'A4';
        $orientation = "portrait";
        $html = $this->load->view('downloadable/qr_view', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);


	}

	 public function display_checkpoint_qr($numeric, $event) {

	 		$response = array(
			'status' => 'failed',
			'message'	=> 'no access!'
		);

		 
		//echo json_encode($event);
        

		$cari = array(
			'url' => $numeric . '/' . $event
		);

		$data_checkpoint = $this->DBClient->get_checkpoint_by_url($cari);

		if(empty($data_checkpoint)){
			echo json_encode($response);
			exit();
		}

		$ev = $data_checkpoint->name;
		$tk = $data_checkpoint->public_token;
		$id = $data_checkpoint->id;
		$path = FCPATH . 'assets/img/qrcodes/' . $data_checkpoint->qr_code; 
		$default = base_url() . 'assets/img/qrcodes/none.jpg';

		// cek file ada atau enggak
		if (file_exists($path) && !is_dir($path)) {
		    // kalau ada, pake URL normal
		    $path = base_url() . 'assets/img/qrcodes/' . $data_checkpoint->qr_code;
		} else {
		    // kalau nggak ada, fallback ke default
		    $path = $default;
		}


		$data = array(
			'token' => $tk,
			'event_name' => $ev,
			'id' => $id,
			'path' => $path
		);

			$this->load->view('dynamic_qrcode_frame', $data);

	}



	// this will be called by JS
	public function add_staff(){

		$na = $this->input->post('name');
		$u = $this->input->post('unit_division');
		$w = $this->input->post('whatsapp');
		$e = $this->input->post('email');
		$k = $this->input->post('kelamin');
		$s = $this->input->post('status');
		$n = $this->input->post('notes');
		$ni = $this->input->post('number_ic');
		$tk = $this->input->post('public_token');

		if(empty($s)){
			$s = 'inactive';
		}

		

		//$tk = $this->akses->getPublicToken();
		$data = array();

		$data['name'] = $na;
		$data['unit_division'] = $u;
		$data['whatsapp'] = format_hp_clear($w);
		$data['email']	= $e;
		$data['kelamin'] = $k;
		$data['status'] = $s;
		$data['notes'] = $n;
		$data['number_ic'] = $ni;
		$data['public_token'] = $tk;

		$masihBisaQuota =	$this->DBClient->use_quota_membership($tk);
		
		$returned = array();
		$returned['status'] = 'failed';
		$returned['message'] = 'quota habis!';

		if(!empty($masihBisaQuota)){
			$hasil = $this->DBClient->add_new_staff($data);

			$returned['status'] = 'success';
			$returned['message'] = 'data berhasil disimpan!';

			// kita minta ke db ini nama unit nya apa saja?
			// returned array
			$unit_divs_names = $this->DBClient->get_unit_divisionname_by_ids($u);

			$this->send_email_staff_added($e, $na, $unit_divs_names);
		}

		$jumlahStaff = $this->DBClient->getTotalStaffByToken($tk);
		$this->session->set_userdata('total_staff', $jumlahStaff);

		echo json_encode($returned);
			
	}

  public function edit_user() {
    $id = $this->input->post('id');
    $mode = $this->input->post('mode');

    if (empty($mode)) {
        $result = [
            'status' => 'failed',
            'message' => 'no access!'
        ];
        echo json_encode($result);
        exit();
    }

    $user = $this->DBClient->getSpecificUser($id);

    if ($user) {
        $result = [
            'status' => 'success',
            'data'   => $user
        ];
    } else {
        $result = [
            'status' => 'failed',
            'message' => 'User not found!'
        ];
    }

    echo json_encode($result);
}


	// this will be called by JS
	public function edit_staff(){

        $this->akses->global_anticors();

		$id = $this->input->post('id');
		$tk = $this->input->post('public_token');
		
        if(empty($id) || empty($tk)){
            $result = array(
            'status' => 'failed',
            'message' => 'no access!'
            );
        }

		//$tk = $this->akses->getPublicToken();
		$data = array(
			'id'=>$id,
			'public_token'=>$tk
		);

		$hasil = $this->DBClient->getStaffByTokenAndID($data);
        $result = array(
            'status' => 'success',
            'message' => 'Data Ditemukan!',
            'data' => $hasil
        );


		echo json_encode($result);
			
	}

	public function edit_checkpoint(){
		$id = $this->input->post('id');
		$tk = $this->input->post('public_token');
		
		//$tk = $this->akses->getPublicToken();
		$data = array(
			'id'=>$id,
			'public_token'=>$tk
		);

		$hasil = $this->DBClient->getCheckpointByTokenAndID($data);
		echo json_encode($hasil);
			
	}

    public function update_attendance(){

    $this->akses->global_anticors();

    $result = array(
        'status' => 'failed',
        'message' => 'Data Gagal diupdate!'
    );

    $ids = $this->input->post('id'); // bisa array atau single
    $s = $this->input->post('status');
    $tk = $this->input->post('public_token');

    if(!empty($ids) && !empty($s)) {

        // pastikan $ids selalu array
        if(!is_array($ids)) {
            $ids = [$ids];
        }

        $updated = 0;
        foreach($ids as $id){
            $data = array('status' => $s);
            if(!empty($tk)){
                $data['public_token'] = $tk;
            }

            $res = $this->DBClient->update_existing_attendance(array_merge(['id' => $id], $data));

            if(!empty($res)) $updated++;
        }

        if($updated > 0){
            $result['status'] = 'success';
            $result['message'] = 'Data berhasil diupdate!';
        }

    }

    echo json_encode($result);
}


	// this will be called by JS
	public function update_staff(){

            $this->akses->global_anticors();

		$result = array(
			'status' => 'falied',
			'message' => 'Data Gagal diupdate!'
		);

		$id = $this->input->post('id');
		$n = $this->input->post('name');
		
		$w = $this->input->post('whatsapp');
		$e = $this->input->post('email');
		$k = $this->input->post('kelamin');
        $u = $this->input->post('unit_division');
		$s = $this->input->post('status');

		$nt = $this->input->post('notes');
		$ni = $this->input->post('number_ic');
		$tk = $this->input->post('public_token');

		//$tk = $this->akses->getPublicToken();
		$data = array();

		$data['id'] = $id;
		$data['name'] = $n;
		
        if(!empty($s)){
            $data['status'] = $s;    
        }
        
        if(!empty($u)){
            $data['unit_division'] = $u;    
        }
        
		
		$data['whatsapp'] = $w;
		$data['email']	= $e;
		$data['kelamin'] = $k;
		
		$data['notes'] = $nt;
		$data['number_ic'] = $ni;

         if(!empty($tk)){
                $data['public_token'] = $tk; 
        }
	
		$hasil = $this->DBClient->update_existing_staff($data);

		if(!empty($hasil)){
			$result['status'] = 'success';
			$result['message'] = 'Data Berhasil diupdate!';
		}

		echo json_encode($result);
			
	}

	// this will be called by JS
	public function delete_staff(){
	    $ids = $this->input->post('ids'); // array of ids
	    $tk  = $this->input->post('public_token');

	    if (is_array($ids)) {
	        foreach($ids as $id){
	            $data = array(
	                'id' => $id,
	                'public_token' => $tk
	            );
	            $this->DBClient->delete_existing_staff($data);
	            $this->DBClient->delete_quota_membership($tk);
	        }
	    }else{
	    	$data = array(
	                'id' => $ids,
	                'public_token' => $tk
	            );
	    	$this->DBClient->delete_existing_staff($data);
	    	$this->DBClient->delete_quota_membership($tk);

	    }


	    $jumlahStaff = $this->DBClient->getTotalStaffByToken($tk);
	    $this->session->set_userdata('total_staff', $jumlahStaff);

	    echo json_encode([
	        'status'  => 'success',
	        'message' => 'Data staff berhasil dihapus!'
	    ]);
}


	public function register()
	{
		
		$p = $this->input->post('pass');
		$e = $this->input->post('email');
		$u = strstr($e, '@', true); 
		$w = $this->input->post('whatsapp');
		$tp = $this->input->post('type');

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
        $data['membership'] = $tp;
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
			$this->send_email_registration_success($e, $u, $tp);

			redirect('/portal/admin?status=success');
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


 public function initiate_device() {

 		$this->akses->global_anticors();

        $email = $this->input->post('email');
        $whatsapp = $this->input->post('whatsapp');
        $mode = $this->input->post('mode');


        $data = array(
        	'email'=> $email,
        	'whatsapp'=> $whatsapp
        );

        if(empty($mode)){
        	$data_passed = $this->DBClient->get_staff_by_email_wa($data);	
        }else{
        		$data_passed = $this->DBClient->get_user_by_email_wa($data);	
        }
        
        if (!$data_passed) {
            echo json_encode(['status' => 'error', 'message' => 'Akun tidak ditemukan!']);
            return;
        }else if ($data_passed->device_tag != null){
        	// device ini pernah diinstal di hp lain
        	echo json_encode(['status' => 'error', 'message' => 'Akun sudah ada di Device lain!']);
            return;
        }

        if(empty($mode)){
        	$username = $data_passed->name;	
        }else{
        	$username = $data_passed->username;	
        }
        

        $ptoken = $data_passed->public_token;
        $this->send_email_activation_device_access($email, $username, $ptoken);

        $returned = [
            'status' => 'success',
            'message' => 'Kode aktivasi telah dikirim!'
        ];

        if(empty($mode)){
        	// for staff device
        	$returned['staff'] = $data_passed;
        }else{

        	// for admin device
        	$returned['data'] = $data_passed;
        }

        echo json_encode($returned);
    }

public function all_staff(){
    // CORS / header
    $this->akses->global_anticors();

    $ptoken   = $this->input->post('public_token');
    $mode     = $this->input->post('mode');

    $result = [
        'status'  => 'failed',
        'message' => 'no access!'
    ];

    // public_token wajib
    if (empty($ptoken) && empty($mode)) {
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($result));
        return;
    }

    // Admin: minta semua data
    if ($mode === 'management') {
        $staff = $this->DBClient->get_all_staff([], true);
    }
    // User biasa kirim by token
    elseif (!empty($ptoken)) {
        // sesuai permintaan: staff hasilnya berdasarkan public_token
        //$staff = $this->DBClient->get_all_staff(['public_token' => $ptoken], false);
        $staff = $this->DBClient->getAllStaffWithDivision($ptoken);
        
    }
    // Bukan admin dan tidak punya ptoken => tolak
    else {
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($result));
        return;
    }

    if (!empty($staff)) {
        $result = [
            'status'  => 'success',
            'message' => 'Ditemukan Data Staff',
            'data'    => $staff
        ];
    } else {
        $result = [
            'status'  => 'failed',
            'message' => 'Data tidak ditemukan'
        ];
    }

    $this->output->set_content_type('application/json')
                 ->set_output(json_encode($result));
}

public function all_absensi(){
    // CORS / header
    $this->akses->global_anticors();

    $ptoken   = $this->input->post('public_token');
    $staff_id = $this->input->post('staff_id');
    $mode     = $this->input->post('mode');

    $result = [
        'status'  => 'failed',
        'message' => 'no access!'
    ];

    // public_token wajib
    if (empty($ptoken)) {
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($result));
        return;
    }

    // Admin: minta semua data
    if ($mode === 'management') {
        $attendance = $this->DBClient->get_all_attendance([], true);
    }
    // Staff: harus mengirim staff_id (sebagai bukti panggilan dari staf)
    elseif (!empty($staff_id)) {
        // sesuai permintaan: staff hasilnya berdasarkan public_token
        $filter = array(
            'staff_id' => $staff_id,
            'public_token' => $ptoken
        );
        
        $attendance = $this->DBClient->get_all_attendance($filter, false);
    }
    // Bukan admin dan tidak punya staff_id => tolak
    else {
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($result));
        return;
    }

    if (!empty($attendance)) {
        $result = [
            'status'  => 'success',
            'message' => 'Ditemukan Data Kehadiran',
            'data'    => $attendance
        ];
    } else {
        $result = [
            'status'  => 'failed',
            'message' => 'Data tidak ditemukan'
        ];
    }

    $this->output->set_content_type('application/json')
                 ->set_output(json_encode($result));
}



	public function add_absensi(){

		$this->akses->global_anticors();

		// using POST parameter
		$staff_id 		=	$this->input->post('staff_id');
		$checkpoint_id 	=	$this->input->post('checkpoint_id');
		$status 		=	$this->input->post('status');
		$public_token 	=	$this->input->post('public_token');

		$data = array(
			'staff_id' => $staff_id,
			'checkpoint_id' => $checkpoint_id,
			'status'	=> $status,
			'public_token'	=> $public_token
		);

		$result = array(
			'status' => 'failed',
			'message' => 'no access!'
		);

		if(!empty($staff_id) && !empty($checkpoint_id)){
			$hasil =	$this->DBClient->add_new_attendance($data);

			if(!empty($hasil)){
				$result['status'] = 'success';
				$result['message'] = 'Data Kehadiran Absensi Tersimpan!';
			}
		}

		echo json_encode($result);

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

		$result = array(
			'status' => 'failed',
			'message' => 'login gagal!'
		);


		$u = $this->input->post('username');
		$p = $this->input->post('pass');

		// check langsung
		$n = $this->DBClient->verify($u, $p);
		// store data user di session
		if($n){
			$dataUser = $this->DBClient->getSpecific($u);	
		}else{
			echo json_encode($result);
			exit();
		}
		

		if ($dataUser === false || empty($dataUser)) {
			echo json_encode($result);
			exit();
		}
		//echo var_dump($dataUser);
		$dataEntry = (array)$dataUser;

		if($dataUser->user_type == 'company'){

			// masukkin juga membership ksitu
		$filterToken = array(
			'public_token' => $dataUser->public_token
		);

		$data_membership = $this->DBClient->getSpecificBy('table_membership', $filterToken);
		$dataEntry['membership'] = $data_membership->name;

		}
		

		// skalian nyimpen nilai total staff yg sudah tercipta oleh akun ini
		// ada brp 
		$token = $dataUser->public_token;
		// ini bakal terus ada saat add dan removal staff
		$jumlahStaff = $this->DBClient->getTotalStaffByToken($token);
		$this->session->set_userdata('total_staff', $jumlahStaff);


		// bakalan ke store dan terpakai oleh library Akses
		$this->session->set_userdata($dataEntry);

		
		if($n !== false){
			$result['status'] = 'success';
			$result['message'] = 'login berhasil!';
		}

		echo json_encode($result);

	}

    public function all_attendance(){

        // receive public token if any
        $token = $this->input->post('public_token');
        $id = $this->input->post('staff_id');

        $result = array();

        if(empty($token)){
            $result['status'] = 'failed';
            $result['message'] = 'no access!';
        }

        if(!empty($id)){

            $filter = array(
                'staff_id' => $id,
                'public_token' => $token
            );

            $data_attendance = $this->DBClient->getSpecificStaffAttendanceByToken($filter);

        }else{
            $data_attendance = $this->DBClient->getAllStaffAttendanceByToken($token);
        }

        if(!empty($data_attendance)){
            $result['status'] = 'success';
            $result['message'] = 'Data ditemukan!';
        }

        $result['data'] = $data_attendance;

        echo json_encode($result);

    }

  

    public function delete_attendance(){

        $ids = $this->input->post('ids'); 
        $tk  = $this->input->post('public_token');

        if (is_array($ids)) {
            foreach($ids as $id){
                $data = array(
                    'id' => $id,
                    'public_token' => $tk
                );
                $this->DBClient->delete_existing_attendance($data);
                
            }
        }else{
            $data = array(
                    'id' => $ids,
                    'public_token' => $tk
                );
            $this->DBClient->delete_existing_attendance($data);
           

        }



        echo json_encode([
            'status'  => 'success',
            'message' => 'Data Attendance berhasil dihapus!'
        ]);
}


	public function superadmin_login(){

		$result = array(
			'status' => 'failed',
			'message' => 'login gagal!'
		);


		$u = $this->input->post('username');
		$p = $this->input->post('pass');

		// check langsung
		$n = $this->DBClient->verify($u, $p);
		// store data user di session
		$dataUser = $this->DBClient->getSpecific($u);

		if ($dataUser === false || empty($dataUser)) {
			echo json_encode($result);
			exit();
		}


		$token = $dataUser->public_token;
		
		//echo var_dump($dataUser);
		$dataEntry = (array)$dataUser;

		$banyakUsers = $this->DBClient->getTotalUsers();
		
		// bakalan ke store dan terpakai oleh library Akses
		$this->session->set_userdata($dataEntry);
		$this->session->set_userdata('total_users', $banyakUsers);


		if($n !== false){
			$result['status'] = 'success';
			$result['message'] = 'login berhasil!';
		}

		echo json_encode($result);

	}

	public function admin_logout(){
		$this->clearAllSession();
		$this->load->view('logout_clear');
	}

	public function superadmin_logout(){
		$this->clearAllSession();
		$this->load->view('logout_clear');
	}		

	private function clearAllSession(){
		$this->session->sess_destroy();
	}

	public function update_checkpoint(){

		$token = $this->input->post('public_token');
		$id = $this->input->post('id');

		$stat = $this->input->post('status');
		$patokan = $this->input->post('patokan');
		$jenis = $this->input->post('jenis');
		$name = $this->input->post('nama-event');
		$location = $this->input->post('lokasi');
		$long = $this->input->post('long');
		$lat = $this->input->post('lat');
		$unit_division = $this->input->post('unit_division');
		$division = $this->input->post('division');

        $starting_date = $this->input->post('starting_date');
        $starting_time = $this->input->post('starting_time');
        $expired_mode = $this->input->post('expired_mode');
		
		$qr_code = null;

		$data = array();

        if(isset($starting_time)){
            $data['starting_time'] = $starting_time;
        }

         if(isset($starting_date)){
            $data['starting_date'] = $starting_date;
        }

         if(isset($expired_mode)){
            $data['expired_mode'] = $expired_mode;
        }

		if(isset($stat)){
			$data['status'] = $stat;
		}

		if(isset($jenis)){
			$data['jenis'] = $jenis;
		}

		if(isset($name)){
			$data['name'] = $name;

			$cleaned = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $name));
    		$nama_safe = strtr($cleaned, [' ' => '-']);

			$url_generated = date('dmYhis') . '/' . $nama_safe;
			$data['url'] = $url_generated;

		}

		if(isset($location)){
			$data['location'] = $location;
		}

		if(isset($long)){
			$data['long'] = $long;
		}

		if(isset($lat)){
			$data['lat'] = $lat;
		}


		if(isset($patokan)){
			$data['patokan'] = $patokan;

			date_default_timezone_set('Asia/Jakarta');
			$date = date('dmYHis');

			if($patokan == 'event'){
				$data_embed = $name . ";" . $jenis . ";" . $date;
			}else {
				$data_embed = $name . ";" . $jenis . ";" . $long . ";" . $lat . ";" . $date;
			}

			$data_embed 		= $id . ";" . $data_embed;
			$data['data_embed'] = $data_embed;

			// delete dulu gmbar lama
			$this->clear_previous_qrcode($id, $token);

			$qr_code = $this->generate_qr($data_embed);
			$data['qr_code'] = basename($qr_code);

		}

		if(isset($unit_division)){
			$data['unit_division'] = $unit_division;
		}

		if(isset($division)){
			// nanti di update by query di dlm model
			$data['division'] = $division;
		}

		$data_filter = array(
			'id' => $id,
			'public_token' => $token
		);

		$end_status = null;

		if(!empty($token)){
		$end_status =	$this->DBClient->update_checkpoint($data_filter, $data);
		}
		

		$result = array(
	 		'status' => 'failed',
	 		'message' => 'no access!',
	 	);

	 	
	 	if(!empty($end_status)){
	 		$result['status'] = 'success';
	 		$result['message'] = 'Checkpoint terupdate!';

	 		if(isset($patokan)){
	 			$result['qr_code'] = $qr_code;

				$safe_able_data = str_replace(";", "_", $data_embed);
				$safe_able_data = str_replace(" ", "_", $safe_able_data);
		
				$result['checkpoint'] = $safe_able_data;
	 			
	 		}
	 		

	 	}


	 	echo json_encode($result);

	}

public function client_po_upload_payment()
{
    $order_id     = $this->input->post('order_id');
    $public_token = $this->input->post('public_token');

    $result = [
        'status'  => 'failed',
        'message' => 'Upload gagal.'
    ];

    // Pastikan user valid
    $user = $this->DBClient->getSpecificBy('table_user', ['public_token' => $public_token]);
    if (!$user) {
        $result['message'] = 'User tidak ditemukan.';
        echo json_encode($result);
        return;
    }

    // Konfigurasi upload
    $config['upload_path']   = FCPATH . 'assets/uploads/payment_screenshot/';
    $config['allowed_types'] = 'jpg|jpeg|png|pdf';
    $config['max_size']      = 2048; // max 2MB
    $config['encrypt_name']  = TRUE; // biar nama file random

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('bukti_pembayaran')) {
        // Jika gagal upload
        $result['message'] = $this->upload->display_errors('', '');
    } else {
        // Berhasil upload
        $uploadData = $this->upload->data();
        $fileName   = $uploadData['file_name'];

        $filter = array(
        	'id'=> $order_id
        );
        $data_order = $this->DBClient->getSpecificBy('table_order_membership', $filter);

        // Update ke database (misalnya table_order_membership)
        $data_update = [
            'payment_screenshot' 	=> $fileName,
            'status'        		=> 'process',
            'membership_name' 		=> $data_order->membership_name,
            'public_token' 			=> $public_token
        ];

        $this->DBClient->update_order_membership($order_id, $data_update);

     
            $result['status']  = 'success';
            $result['message'] = 'Upload berhasil. Silahkan menunggu verifikasi dalam 15 menit.';
      
    }

    echo json_encode($result);
}


	public function client_po_order_checkout() {

    $token = $this->input->post('public_token');
    $akun  = $this->input->post('account');

    // default response
    $result = array(
        'status'  => 'failed',
        'message' => 'no access!'
    );

    if (!empty($token) && !empty($akun)) {

        // pastikan user ini ada
        $filter = array('public_token' => $token);
        $data_user = $this->DBClient->getSpecificBy('table_user', $filter);

        if (!empty($data_user)) {
            $userid = $data_user->id;
            $username = $data_user->username;
            $email = $data_user->email;

            $harga = $this->akses->getAccountPrice($akun);


            // panggil model
            $hasil = $this->DBClient->order_upgrade_membership($akun, $token);

            if ($hasil) {
                $result = array(
                    'status'    => 'success',
                    'message'   => 'Pemesanan upgrade berhasil!',
                    'order_id'  => $hasil // misalnya insert_id
                );

                // kirim email 
              $this->send_email_upgrade_account_payment($username, $email, $akun, $harga);

            } else {
                $result['message'] = 'Order Double, anda sudah pernah memesan! <br>Check kembali di <b>menu Riwayat Penting</b> untuk menuntaskannya.';
            }
        }
    }

    echo json_encode($result);
}

public function send_email_upgrade_account_payment($username, $email, $jenis, $harga){

$linkUpload	 = base_url() . 'portal/history/all';

date_default_timezone_set('Asia/Jakarta');
		$date = date('l, d-F-Y H:i:s') . " WIB";
		$computerDate = date('Y-m-d');
		$computerTime = date('H:i:s');

   $this->myemailer->send_html_email(
    $email,
    "Pemesanan Upgrade Akun Berhasil!",
    'email_templates/order_account_success',
    array(
        'username' => $username,
        'jenis' => $jenis,
        'price' => $harga,
        'tanggal_email' => $date,
        'link_konfirmasi' => $linkUpload
    )
	);


}

	public function client_po_order(){

		$jenis = $this->session->userdata('membership_ordered_type');
		$harga = 0;

		$harga = $this->akses->getAccountPrice($jenis);

		$data = array(
			'akses' => $this->akses,
			'jenis' => $jenis,
			'price' => $harga
		);

		$this->load->view('admin_checkout_membership', $data);

	}

	public function client_upgrade_akun($jenis){


		 $this->session->set_userdata('membership_ordered_type', $jenis);

		redirect('/purchase-membership/order');


	}

	private function clear_previous_qrcode($idna, $tokenna)
{
    $filter = [
        'id'           => $idna,
        'public_token' => $tokenna
    ];

    // ambil data checkpoint
    $data_checkpoint = $this->DBClient->getSpecificBy('table_checkpoint', $filter);

    // kalau data ga ketemu
    if (!$data_checkpoint || empty($data_checkpoint->qr_code)) {
        return false;
    }

    $filename = $data_checkpoint->qr_code;
    $filepath = FCPATH . 'assets/img/qrcodes/' . $filename; 
    // FCPATH = root path project CI

    // cek apakah file ada
    if (file_exists($filepath)) {
        // hapus file
        if (unlink($filepath)) {
            return true; // berhasil dihapus
        } else {
            return false; // gagal unlink
        }
    }

    return false; // file tidak ditemukan
}


	// qr code verification
	 public function check_qrcode() {

	 	$this->akses->global_anticors();

	 	$data_embed = $this->input->post('data');
	 	$pToken = $this->input->post('public_token');
	 	// ensure this data is valid or active

	 	$data_filter = array(
	 		'public_token'	=> $pToken,
	 		'data_embed' 	=> $data_embed
	 	);

	 	// true or false
	 	$end_status = $this->DBClient->check_status_checkpoint($data_filter);

	 	$result = array(
	 		'status' => 'failed',
	 		'message' => 'no access!',
	 	);

	 	
	 	if(!empty($end_status)){
	 		$result['status'] = 'success';
	 		$result['message'] = 'QRCode masih aktif!';
	 	}


	 	echo json_encode($result);

	 }


	// staff code verification
	 public function check_code() {

	 	$this->akses->global_anticors();

        $wa = $this->input->post('whatsapp');
        $email = $this->input->post('email');
        $code = $this->input->post('code');
        $dev_tag = $this->input->post('device_tag');
        $mode = $this->input->post('mode');


        $data = array(
            'public_token' => $code,
            'whatsapp' => $wa
        );

        if(empty($mode)){
        	// for staff usage
        	$data = $this->DBClient->verifyStaff($data);	
        }else{
        	// for admin usage
        	$data = $this->DBClient->verifySpecificByColumn('table_user', 'public_token', $code);
        }
        

        if (!$data) {
            echo json_encode(['status' => 'error', 'message' => 'Kode salah!']);
            return;
        }else if($data->device_tag == null){
        	$dataBaru = array(
        		'id'	=> $data->id,
        		'device_tag' => $dev_tag,
                'public_token' => $code
        	);
        	$this->DBClient->update_existing_staff($dataBaru);
        }else if($data->device_tag != null){
        	echo json_encode(['status' => 'error', 'message' => 'Akun sudah aktif di Device lain!']);
            return;
        }

        echo json_encode(['status' => 'success', 
            'message' => 'Device teraktivasi!', 
            'data' => $data]);
    }


}
