<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses {
	
	 protected $CI;

    public function __construct() {
        $this->CI =& get_instance(); // Get the CI super object
        $this->CI->load->model('DBClient');
    }

	public function ensureAccessCompany(){
			if(!$this->isCompany()){
				redirect(base_url('portal/admin'));
			}
		}

	public function ensureAccessBoth(){
	if (!$this->isAdmin() && !$this->isStaff() && !$this->isCompany()) {
		redirect(base_url('portal/admin'));
	}
}

public function getUpgradeAccountOrders(){

	// coba tanya ke model DBClient->getUpgradeAccountsOrdered() agar dpt integer
	$count = $this->CI->DBClient->getUpgradeAccountsOrdered();
        return intval($count);
}

public function getTotalRegisteredUsers(){

	$datanya = $this->CI->session->userdata('total_users');
	return $datanya;

}

public function getAccountPrice($jenis){
$harga = 0;

	if($jenis == 'sederhana'){
			$harga = 50000;
		}else if($jenis == 'developer'){
			$harga = 150000;
		}else if($jenis == 'ultimate'){
			$harga = 450000;
		}

	return $harga;	
}

public function getAccountQuota($jenis){
$qty = 0;

	if($jenis == 'sederhana'){
			$qty = 25;
		}else if($jenis == 'developer'){
			$qty = 100;
		}else if($jenis == 'ultimate'){
			$qty = 1000;
		}else {
			$qty = 5;
		}

	return $qty;	
}

public function global_anticors(){

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");

	if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

}

public function getTotalStaff(){
	$datanya = $this->CI->session->userdata('total_staff');
	return $datanya;
}

 public function isAdmin(){
	$user_type = $this->CI->session->userdata('user_type');
	return ($user_type === 'admin' );
}

 public function isCompany(){
	$user_type = $this->CI->session->userdata('user_type');
	return ($user_type === 'company');
}

public function isStaff(){
	$user_type = $this->CI->session->userdata('user_type');
	return $user_type === 'staff';
}

	public function getData($field){
		$u =  $this->CI->session->userdata($field);
		
		return $u;
	}
	
	public function getUsername(){
		$u =  $this->CI->session->userdata('username');
		
		return $u;
	}
   
	public function getUserType(){
	$u =  $this->CI->session->userdata('user_type');
		
		return $u;	
	}


	public function getEmail(){
	$u =  $this->CI->session->userdata('email');
		
		return $u;	
	}

	public function getAvatar(){
		$u =  $this->CI->session->userdata('avatar');
			
			return $u;	
	}

	public function getMembershipName(){
		$u =  $this->CI->session->userdata('membership');
			
			return $u;	
	}

	public function getMembershipLogo(){
		$u =  $this->CI->session->userdata('membership');
			
		if($u == 'gratis'){
		$file =	"/account-free.png";
		} else {
			$file = "/account-" . $u . ".jpeg";
		}
			return $file;	
	}

	public function getPublicToken(){
	$u =  $this->CI->session->userdata('public_token');
		
		return $u;	
	}
   
}

?>