<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DBWorks extends CI_Model {

    public function verifyByColumn($col, $val){


        $hasil = false;

        $filterNa = array(
                        $col => $val
        );
        
       $this->db->where($filterNa);
       $query = $this->db->get('data_user');

        if($query->num_rows() > 0){
            $hasil = $query->row();
        }

        return $hasil;

    }

     public function getUserByToken($tokenVal){

        $hasil = false;

        $filterNa = array(
            'public_token' => $tokenVal
        );
        
       $this->db->where($filterNa);
       $query = $this->db->get('data_user');

        if($query->num_rows() > 0){
            $hasil = $query->row();
        }

        return $hasil;

    }
  

    public function verifyByColumnWithUpdatedToken($col, $val, $tok){
   
        $hasil = false;

        $newData = array(
           'public_token' => $tok
        );

        $filterNa = array(
                $col => $val
        );
        
       $this->db->where($filterNa);
       $this->db->update('data_user', $newData);

        $this->db->where($filterNa);
       $query = $this->db->get('data_user');

        if($query->num_rows() > 0){
            $hasil = $query->row();
        }

        return $hasil;

    }

    public function verifyExist($data, $category, $token){

    	$hasil = false;

        if($category == 'wa'){
         $hasil =   $this->verifyByColumnWithUpdatedToken('phone_numbers', $data, $token);   

            if($hasil == false){
                $hasil = $this->verifyByColumnWithUpdatedToken('mobile', $data, $token);  
            }

        }else{
        
         $hasil =   $this->verifyByColumnWithUpdatedToken('email', $data, $token);
        
        }

        return $hasil;

    }

    public function verifyAndActivate($codeNa){

        $filterNa =  array(
                'public_token' => $codeNa 
            );
        

        // update the warning status to 0
        // means no error all works properly!
        $data = array(
            'warning_status' => 0
        );

        if(isset($codeNa)){
            $this->db->where($filterNa);
            $this->db->update('data_user', $data);
        }
        // Check if the update was successful
        return $this->db->affected_rows() > 0;

    }
	
	public function getAllAttendance($username){
		
		$data = array(
            'username' => $username
        );

		$this->db->where($data);
        $this->db->order_by('date_created', 'DESC');
		$query = $this->db->get('data_attendance');
		
		 if ($query->num_rows() > 0) {
			   // array returned
            return $query->result(); 
        } else {
            return false;
        }
		
    }
}