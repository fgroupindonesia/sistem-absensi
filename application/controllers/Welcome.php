<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('DBWorks');
        $this->load->model('DBClient');
    }
	
	public function business_page()
	{
		$this->load->view('landing_page');
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

	public function admin_management_staff(){

		$data = array();

		$entry_limit = $this->input->get('entry_limit');

		$tk = $this->akses->getPublicToken();
		$dataStaff = $this->DBClient->getAllStaffByToken($tk);


		if(is_array($dataStaff)){
			$data['total_staff'] = count($dataStaff);
		}else{
			$data['total_staff'] = 0;
		}

		if(isset($entry_limit)){
			$dataStaff = $this->DBClient->getAllStaffByTokenLimit($tk, $entry_limit);
		}else{
			$entry_limit = 2;
		}

		$data['public_token'] = $tk;

		$data['entry_limit']  = $entry_limit;
		$data['data_staff'] = (array)$dataStaff;


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

	public function admin_settings(){

		$data = array();

		$tk = $this->akses->getPublicToken();
		$dataStaff = $this->DBClient->getAllStaffByToken($tk);

		if(is_array($dataStaff)){
			$data['total_staff'] = count($dataStaff);
		}else{
			$data['total_staff'] = 0;
		}

		$this->load->view('admin_settings', $data);
	}

	public function admin_dashboard(){

		$data = array('search_visibility' => 'hidden');

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
	}

	public function admin_attendance(){

		$data = array();

		$tk = $this->akses->getPublicToken();
		$dataStaff = $this->DBClient->getAllStaffByToken($tk);

		if(is_array($dataStaff)){
			$data['total_staff'] = count($dataStaff);
		}else{
			$data['total_staff'] = 0;
		}

		$this->load->view('admin_management_attendance', $data);
	}

	public function admin_upgrade_akun(){
		
		$akun = $this->input->get('akun');
		$btn_ultimate = "";
		$btn_sederhana = "";
		$btn_developer = "";

		$data = array();

		if(isset($akun)){

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

			$data['btn_ultimate'] = $btn_ultimate;
			$data['btn_sederhana'] = $btn_sederhana;
			$data['btn_developer'] = $btn_developer;


		$this->load->view('all_package_page', $data);
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
