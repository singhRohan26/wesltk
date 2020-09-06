<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

	/**
	 * Home Model.
	 * Created By Rohan Singh
	 
	 */
    
    public function check_useraccount($email){
        $sel = $this->db->get_where('users',['email'=>$email]);
        return $sel->row_array();
        
    }
    
    public function get_userdata($id){
        $sel = $this->db->get_where('users',['user_id'=>$id]);
        return $sel->row_array();
    }
    
    public function user_register(){
        $user_data = array(
            'name' => $this->security->xss_clean($this->input->post('full_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password'))),
            'phone' => $this->security->xss_clean($this->input->post('mobile_no')),
            'source' => $this->security->xss_clean($this->input->post('source')),
        );
        
        $this->db->insert('users',$user_data);
        $id =  $this->db->insert_id();
        $sel = $this->db->get_where('users',['user_id'=>$id]);
        return $sel->row_array();
        
    }
    
    public function login($email,$password){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function check_oldpassword(){
    $user_id = $this->security->xss_clean($this->input->post('user_id'));
    $current_password = $this->security->xss_clean(hash('sha256', $this->input->post('current_password')));
    $query = $this->db->get_where('users', ['user_id' => $user_id, 'password' => $current_password, 'status' => 'Active']);
    return $query->row_array();
    }
    
    public function change_password($user_id){
       $password = $this->security->xss_clean(hash('sha256', $this->input->post('password')));
       $this->db->update('users', ['password' => $password], ['user_id' => $user_id, 'status' => 'Active']);
       return $this->db->affected_rows();
    }
    
    public function edit_profile($user_id,$file1){
       $user_data = array(
            'name' => $this->security->xss_clean($this->input->post('full_name')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password'))),
            'phone' => $this->security->xss_clean($this->input->post('mobile_no')),
            'image'=>$file1,
            'source' => $this->security->xss_clean($this->input->post('source')),
        ); 
        $this->db->where('user_id',$user_id);
        $this->db->update('users',$user_data);
        $sel = $this->db->get_where('users',['user_id'=>$user_id]);
        return $sel->row_array();
    }
    
    public function getFaq(){
      $this->db->select('*');
        $this->db->from('faq');
        $sel = $this->db->get();
        return $sel->result_array();  
    }
    
    

}
