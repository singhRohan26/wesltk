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
    public function becomePartner(){
        $data = array(
        'name' =>$this->security->xss_clean($this->input->post('vendor_name')),
        'email' =>$this->security->xss_clean($this->input->post('vendor_email')),
        'phone' =>$this->security->xss_clean($this->input->post('vendor_phone')),
        'website' =>$this->security->xss_clean($this->input->post('vendor_website')),
        );
        $this->db->insert('vendors',$data);
        return $this->db->insert_id();       
    }
    
    public function updatProfile($image){
        $data = array(
        'name' =>$this->security->xss_clean($this->input->post('profile_name')),
        'email' =>$this->security->xss_clean($this->input->post('profile_email')),
        'phone' =>$this->security->xss_clean($this->input->post('profile_phone')),
        'image'=> $image
        );
        $this->db->update('users', $data, ['user_id' => $this->session->userdata('login_id')]);
        return $this->db->affected_rows();       
    }   
    public function changePassword(){
        $data = array(
        'password' =>$this->security->xss_clean(hash('sha256', $this->input->post('npass')))
        );
        $this->db->update('users', $data, ['user_id' => $this->session->userdata('login_id')]);
        return $this->db->affected_rows();       
    }
    
    public function checkemail($user_id = null){
        if(!empty($user_id)){
            $this->db->where('user_id !=', $user_id);
        }
        $sel = $this->db->get_where('users',['email'=>$this->security->xss_clean($this->input->post('email'))]);
        return $sel->row_array();
    } 
    public function checkVendorEmail($vendor_id = null){
        if(!empty($user_id)){
            $this->db->where('vendor_id !=', $user_id);
        }
        $sel = $this->db->get_where('vendors',['email'=>$this->security->xss_clean($this->input->post('email'))]);
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
