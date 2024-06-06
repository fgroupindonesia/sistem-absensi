<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses {
	
	 protected $CI;

    public function __construct() {
        $this->CI =& get_instance(); // Get the CI super object
    }

	public function ensureAccessAdmin(){
			if(!$this->isAdmin()){
				redirect('/portal/admin_login');
			}
		}
		
	public function ensureAccessBoth(){
			if(!$this->isAdmin() && !$this->isStaff()){
				redirect('/portal/admin_login');
			}
		}

   public function isAdmin(){
		//$total_now =  $this->session->userdata('total_user');
		$user_type =  $this->CI->session->userdata('user_type');
		
		if($user_type == 'company'){
		return true;
		}
		
		return false;
		
	}

	public function isStaff(){
		//$total_now =  $this->session->userdata('total_user');
		$user_type =  $this->CI->session->userdata('user_type');
		
		if (strpos($user_type, 'admin') === false) {
    		return true;
		}
		
		return false;
		
	}

	
	
	public function getUsername(){
		$u =  $this->CI->session->userdata('username');
		
		return $u;
	}
   
	public function getUserType(){
	$u =  $this->CI->session->userdata('user_type');
		
		return $u;	
	}

	public function getAvatar(){
		$u =  $this->CI->session->userdata('avatar');
			
			return $u;	
	}

	public function getMembershipLogo(){
		$u =  $this->CI->session->userdata('membership');
			
		if($u == 'gratis'){
		$file =	"/account-free.png";
		} else {
			$file = "/account-" . $u . ".png";
		}
			return $file;	
	}

	public function getPublicToken(){
	$u =  $this->CI->session->userdata('public_token');
		
		return $u;	
	}
   
}

?>