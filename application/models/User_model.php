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
    
    public function checkemail(){
        $sel = $this->db->get_where('users',['email'=>$this->security->xss_clean($this->input->post('email'))]);
        return $sel->row_array();
    }
    
    public function getLoginDetail($login_id){
        $sel = $this->db->get_where('users',['user_id'=>$login_id]);
        return $sel->row_array();
    }
    
    public function checkLogin(){
        $email = $this->security->xss_clean($this->input->post('email'));
        $pass = $this->security->xss_clean(hash('sha256', $this->input->post('pass')));
        $this->db->select('*')
                ->from('users')
                ->where('email',$email)
                ->where('password',$pass);
        $sel = $this->db->get();
        return $sel->row_array();
        
    }
	
}
