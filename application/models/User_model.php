<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	/**
	 * Home Model.
	 * Created By Rohan Singh
	 
	 */


    public function doRegistration(){
        $data = array(
        'name' =>$this->security->xss_clean($this->input->post('name')),
        'email' =>$this->security->xss_clean($this->input->post('email')),
        'phone' =>$this->security->xss_clean($this->input->post('phone')),
        'password' =>$this->security->xss_clean(hash('sha256', $this->input->post('pass')))
        );
        $this->db->insert('users',$data);
        return $this->db->insert_id();       
    }
    
    public function checkLogin(){
        $sel = $this->db->get_where('users',['email'=>$this->security->xss_clean($this->input->post('email'))]);
        return $sel->row_array();
    }
	
}
