<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DBClient extends CI_Model {

    protected $db2;

    public function __construct() {
        parent::__construct();
        $this->reload();
    }

    public function getStaffByTokenAndID($dataArray){
        $hasil = false;
        $selection = array(
            'public_token' => $dataArray['public_token'],
            'id' => $dataArray['id']
        );

        $this->db2->where($selection);
        $query =  $this->db2->get('table_staff');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = $query->row();
        }

        return $hasil;
    }

    public function getAllStaffByToken($ptoken){
        $hasil = false;
        $selection = array('public_token' => $ptoken);

        $this->db2->where($selection);
        $query =  $this->db2->get('table_staff');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = $query->result();
        }

        return $hasil;
    }

      public function getStaffByTokenAndWa($arrayCome){
        $hasil = false;
        $selection = array(
            'public_token' => $arrayCome['public_token'],
            'whatsapp'     => $arrayCome['whatsapp']
        );

        $this->db2->where($selection);
        $query =  $this->db2->get('table_staff');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = $query->row();
        }

        return $hasil;
    }

     public function getAllStaffByTokenLimit($ptoken, $limit){
        $hasil = false;
        $selection = array('public_token' => $ptoken);

        $this->db2->where($selection);
        $this->db2->limit($limit);
        $query =  $this->db2->get('table_staff');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = $query->result();
        }

        return $hasil;
    }

      public function getMembershipByToken($ptoken){
        $hasil = false;
        $selection = array('public_token' => $ptoken);

        $this->db2->where($selection);
        $query =  $this->db2->get('table_membership');

        if($query->num_rows() > 0){
            $hasil = $query->row();
            //$hasil = $query->result();
            
        }

        return $hasil;
    }

    public function update_existing_staff($data){

        $this->reload();

        $id = $data['id'];
        $dataFilter = array('id' => $id);

        $this->db2->where($dataFilter);
        $this->db2->update('table_staff', $data);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;

    }

     public function delete_existing_staff($data){

        $this->reload();

        $id = $data['id'];
        $dataFilter = array('id' => $id);

        $this->db2->where($dataFilter);
        $this->db2->delete('table_staff');
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;

    }

    public function add_new_user($data){

        $this->reload();

        $email = $data['email'];
        $dataFilter = array('email' => $email);

        $existing_data = $this->db2->get_where('table_user', $dataFilter)->row();

        if(!$existing_data){

        $this->db2->insert('table_user', $data);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;
        }

        return false;

    }

    public function add_new_staff($data){

        $this->reload();

        $email = $data['email'];
        $dataFilter = array('email' => $email);

        $existing_data = $this->db2->get_where('table_staff', $dataFilter)->row();

        if(!$existing_data){

        $this->db2->insert('table_staff', $data);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;
        }

        return false;

    }

    public function add_new_membership($data){

        $this->reload();

        $pToken = $data['public_token'];
        $dataFilter = array('public_token' => $pToken);

        $existing_data = $this->db2->get_where('table_membership', $dataFilter)->row();

        if(!$existing_data){

        $this->db2->insert('table_membership', $data);
        // Check if the insertion was successful
        return $this->db2->affected_rows() > 0;
        }

        return false;

    }

    public function reload(){
        $this->db2 = $this->load->database('client', TRUE);
    }

    public function getSpecific($username){
          $hasil = false;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $datana = explode('@', $username);
            $username = $datana[0];
        }

        $data = array(
            'username' => $username
        );

         $this->db2->where($data);
       $query =  $this->db2->get('table_user');

        if($query->num_rows() > 0){
            $hasil = $query->row();
        }

        return $hasil;
    }

    public function is_activated($token){
        $hasil = false;

        $data = array(
            'public_token'  => $token,
            'status'        => 'active'
        );

       $this->db2->where($data);
       $query =  $this->db2->get('table_user');

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = true;
        }

        return $hasil;
    }

     public function activate($token){
        $hasil = false;

        $data = array(
            'public_token'  => $token
        );

        $dataUpdate = array(
            'status' => 'active'
        );

       $this->db2->where($data);
       $this->db2->update('table_staff', $data);

        if($query->num_rows() > 0){
            //$hasil = $query->row();
            $hasil = true;
        }

        return $hasil;
    }

    public function verify($username, $pass){

        $hasil = false;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $datana = explode('@', $username);
            $username = $datana[0];
        }

        $data = array(
            'username' => $username,
            'pass' => $pass
        );

		 $this->db2->where($data);
       $query =  $this->db2->get('table_user');

        if($query->num_rows() > 0){
        	//$hasil = $query->row();
            $hasil = true;
        }

        return $hasil;

    }
}