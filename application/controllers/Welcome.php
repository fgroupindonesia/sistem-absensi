<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('DBWorks');
        $this->load->model('DBClient');
    }

   

    public function superadmin_management_user(){


    	$data_users = $this->DBClient->getAllUsers();

    	$data = array(
    		'data_users' => $data_users,
    		'akses' => $this->akses
    	);

    	$this->load->view('superadmin_management_user', $data);

    }


    public function superadmin_management_order(){

    	$data_orderan = $this->DBClient->getAllMembershipOrders();

    	$data = array(
    		'data_orders' => $data_orderan,
    		'akses' => $this->akses
    	);

    	$this->load->view('superadmin_management_order', $data);

    }

    public function display_all_user_history(){

    	$token = $this->akses->getPublicToken();

    	$data_history = $this->DBClient->getAllOrderHistoryByToken($token);
    	$data['akses'] = $this->akses;
    	$data['history'] = $data_history;

    	$this->load->view('admin_history_all', $data);

    }

    public function display_all_user_request_bugs(){

    	$this->akses->ensureAccessCompany();

    	// urlnya 
    	// portal/history/consultation'
    	//atau 
    	// portal/history/bugs-report'

    	$request_uri = $_SERVER['REQUEST_URI'];
		$need = basename(parse_url($request_uri, PHP_URL_PATH));

    	$data = array();

    	$tk = $this->akses->getPublicToken();

    	if (strpos($need, 'bugs') !== false) {
    		$data_db  = $this->DBClient->get_all_bugs_report($tk);	
    		$data['bugs_reports'] = $data_db;
    	}
    	
    	if (strpos($need, 'consultation') !== false) {
    		$data_db  = $this->DBClient->get_all_request_consultation($tk);	
    		$data['consultations'] = $data_db;
    	}

    	$data['akses'] = $this->akses;
    	
    	$this->load->view('admin_history_bugs_report', $data);

    }

    public function test(){

    	$fname = rand(10, 1000) . ".data";

    	$myfile = fopen("data/" . $fname , "w") or die("Unable to open file!");
		$txt = rand(10,1000);
		fwrite($myfile, $txt);
		fclose($myfile);
		
		echo "success call!";
    }

	public function business_page()
	{
		$this->load->view('landing_page');
	}

	public function install()
	{
		$this->load->view('install_app');
	}

	public function device()
	{

		$kode = $this->input->get('code');

		if(isset($kode)){

			$data  = $this->DBClient->verifyByColumn('public_token', $kode);

			if(!empty($data)){
				$this->load->view('device_scanner');	
			}else {
				// kode is not valid
				// do another detection
				$this->load->view('device_detector');	
			}


		}else {

			// proceed checking whether this device is 
			// activated (linked) ?
			$this->load->view('device_detector');

		}

	}

	public function register_page()
	{
		$tipe = $this->input->get('type');

		if(isset($tipe)){
			$datana = array(
				'type' => $tipe
			);

		$this->load->view('register_form', $datana);

		}else{

			$this->load->view('register_form');
		
		}

	}

	public function new_signature(){

		$tk = $this->akses->getPublicToken();
		$data_staff = $this->DBClient->getAllStaffByToken($tk);

		$this->load->view('client_new_signature', $data_staff);

	}

	public function admin_management_checkpoint(){

	$this->akses->ensureAccessCompany();

		$data = array();

		
		$tk = $this->akses->getPublicToken();
		$dataCheckPoint = $this->DBClient->getAllCheckpointByToken($tk);


		if(is_array($dataCheckPoint)){
			$data['total_checkpoint'] = count($dataCheckPoint);
		}else{
			$data['total_checkpoint'] = 0;
		}

		// ini data session ada disini
		$data['akses'] = $this->akses;
		$data['public_token'] = $tk;

		if(!empty($dataCheckPoint))
		$data['data_checkpoint'] = (array)$dataCheckPoint;

		$this->load->view('admin_management_checkpoint', $data);


	}

	public function admin_management_staff(){

		$this->akses->ensureAccessCompany();

		$data = array();

		$entry_limit = $this->input->get('entry_limit');

		$tk = $this->akses->getPublicToken();
		$dataStaff = $this->DBClient->getAllStaffWithDivision($tk);


		if(!empty($entry_limit)){
			$dataStaff = $this->DBClient->getAllStaffByTokenLimit($tk, $entry_limit);
		}else{
			$entry_limit = 2;
		}

		if(is_array($dataStaff)){
			$data['data_staff'] = (array)$dataStaff;
			$data['total_staff'] = count($dataStaff);
		}else{
			$data['total_staff'] = 0;
			$data['data_staff'] = null;
		}

		

		$data['public_token'] = $tk;

		// ini data session ada disini
		$data['akses'] = $this->akses;

		$data['entry_limit']  = $entry_limit;
		


		$this->load->view('admin_management_staff', $data);
	}

	public function admin_membership(){

		$data = array();

		$tk = $this->akses->getPublicToken();
		$dataStaff = $this->DBClient->getAllStaffByToken($tk);

		if(is_array($dataStaff)){
			$data['total_staff'] = count($dataStaff);
		}else{
			$data['total_staff'] = 0;
		}

		$this->load->view('admin_membership', $data);
	}


    public function admin_settings_membership(){
    	
    		$this->akses->ensureAccessCompany();

		$data = array();
		$data['akses'] = $this->akses;

		$this->load->view('admin_settings_membership', $data);


    }

	public function admin_settings(){

		//$this->akses->ensureAccessBoth();

		$data = array();
		$data['akses'] = $this->akses;

		$this->load->view('admin_settings', $data);

	}

	public function admin_dashboard(){

		//$this->akses->ensureAccessBoth();
		
		$data = array('search_visibility' => 'hidden');
		$data['akses'] = $this->akses;

		if($this->akses->isCompany()){

			$tk = $this->akses->getPublicToken();
			$dataStaff = $this->DBClient->getAllStaffByToken($tk);

			$dataMembership = $this->DBClient->getMembershipByToken($tk);

			$data['public_token'] = $tk;

			$data['total_staff'] = 0; // default
			$data['quota_used'] = 0;
			$data['quota_limit'] = 0;
			$data['package_name'] =  'GRATIS'; // this is the membership name
			

			if(isset($dataMembership)){
				if($dataMembership != false){
					$data['quota_used'] = $dataMembership->quota_used;
					$data['quota_limit'] = $dataMembership->quota_limit;
					$data['package_name'] = $dataMembership->name;
				}
			}

			if(is_array($dataStaff)){
				$data['total_staff'] = count($dataStaff);
			}else{
				$data['total_staff'] = 0;
			}

			$this->load->view('admin_dashboard', $data);	

		}else if($this->akses->isAdmin()){
		
			$this->load->view('superadmin_dashboard', $data);	
		}

		
	}

	public function admin_management_attendance(){

		$this->akses->ensureAccessCompany();

		$data = array();

		$tk = $this->akses->getPublicToken();
		$dataStaff = $this->DBClient->getAllStaffByToken($tk);

		$data['akses'] = $this->akses;
		$data['data_attendance'] = $this->DBClient->getAllStaffAttendanceByToken($tk);
		$data['data_staff'] = $this->DBClient->getAllStaffByToken($tk);

		if(is_array($dataStaff)){
			$data['total_staff'] = count($dataStaff);
		}else{
			$data['total_staff'] = 0;
		}

		$this->load->view('admin_management_attendance', $data);
	}

	public function admin_upgrade_akun(){
		
		$this->akses->ensureAccessCompany();

		$my_account = $this->akses->getMembershipName();

		$akun = $this->input->get('akun');
		$btn_ultimate = "";
		$btn_sederhana = "";
		$btn_developer = "";

		$data = array();

		$tk = $this->akses->getPublicToken();
		$data['public_token'] = $tk;

		$dataStaff = $this->DBClient->getAllStaffByToken($tk);

		if(is_array($dataStaff)){
			$data['total_staff'] = count($dataStaff);
		}else{
			$data['total_staff'] = 0;
		}


		if(isset($akun)){

			if($my_account == 'gratis'){
				$btn_sederhana_disabled = "";
				$btn_developer_disabled = "";
				$btn_ultimate_disabled = "";
			}else if ($my_account == 'ultimate'){
				$btn_sederhana_disabled = "invisible";
				$btn_developer_disabled = "invisible";
				$btn_ultimate_disabled = "invisible";
			}else if($my_account == 'sederhana'){
				$btn_sederhana_disabled = "";
				$btn_developer_disabled = "";
				$btn_ultimate_disabled = "";
			}else if($my_account == 'developer'){
				$btn_sederhana_disabled = "invisible";
				$btn_developer_disabled = "invisible";
				$btn_ultimate_disabled = "";
			}

			if($akun == 'ultimate'){
				$btn_ultimate = "btn-green";
			}
			
			if($akun == 'sederhana'){
				$btn_sederhana = "btn-green";
			}
			
			if($akun == 'developer'){
				$btn_developer = "btn-green";
			}

			
		}

			$data['btn_sederhana_disabled'] = $btn_sederhana_disabled;
			$data['btn_developer_disabled'] = $btn_developer_disabled;
			$data['btn_ultimate_disabled'] = $btn_ultimate_disabled;


			$data['btn_ultimate'] = $btn_ultimate;
			$data['btn_sederhana'] = $btn_sederhana;
			$data['btn_developer'] = $btn_developer;
			$data['akses'] = $this->akses;
			$data['search_visibility'] = 'd-none';

		$this->load->view('all_package_page', $data);
	}

	// used for client to view only
	public function display_checkpoint(){
		$token = $this->input->get('token');

		$data = array(
			'token' => $token 
		);

		$this->load->view('dynamic_qrcode_frame', $data);

	}

	public function admin_page()
	{

		$s = $this->input->get('status');

		$data = array();

		if(isset($s)){
			$data = array(
				'status' => $s
			);
		}

		$this->load->view('admin_login_page', $data);
	}

}
