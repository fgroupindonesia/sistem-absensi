<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DBWorks extends CI_Model {

    // NOTES :
    // $this->db is actually db_fgi_portal_v2
    // whereas
    // $this->db2 is actually db_fgi_sistem_absensi_v1

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

    private function getClassRegisteredByUsername($username){

        $hasil = false;

        $filterNa = array(
            'username' => $tokenVal
        );
        
       $this->db->where($filterNa);
       $query = $this->db->get('data_schedule');

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
	
    public function add_new_attendance($data, $sign){

       // here in portal we used BAHASA INDONESIA data

        // status is either 1 :
        // sakit = ill
        // idzin = excuse
        // absen = skip
        // hadir = present

        $s       = "hadir";
        $u       = $data['username'];
        $c       = $this->getClassRegisteredByUsername($u);
        date_default_timezone_set('Asia/Jakarta');
        $date    = date('Y-m-d H:i:s');
        
        if($sign == null){
            $sign = 'not available';
        }

        $newData = array(
            'username'          => $u,
            'class_registered'  => $c,
            'status'            => $s,
            'signature'         => $sign,
            'date_created'      => $dt  
        );

        $this->db2->insert('table_attendance', $data);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;


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