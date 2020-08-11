<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	/**
	 * Admin  Model.
	 * Created By Rohan Singh
	 
	 */

    
    public function checkLogin(){
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password')))
        );
        $query = $this->db->get_where('admin', $data);
        return $query->row_array();
    }
    
    public function getLoginDetail($login_id){
        $sel = $this->db->get_where('admin',['id'=>$login_id]);
        return $sel->row_array();
    }
    
    public function doChangePass(){
        $data = array(
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('npass')))
        );
        $this->db->update('admin', $data);
        return $this->db->affected_rows();
    }
    
    public function edit_profile($id){
       $query = $this->db->get_where('admin',['id'=>$id]);
       return $query->row_array();
    }
    
    public function doChangeProfile($id){
         $logindata = array(
            'name' => $this->security->xss_clean($this->input->post('admin_name')),
            'email' => $this->security->xss_clean($this->input->post('email_id')),
            'phone' =>$this->security->xss_clean($this->input->post('phone')),
          );
         $this->db->update('admin', $logindata,['id'=>$id]);
        return $this->db->affected_rows();

    }
    
    public function getPageDataByPageId($page_id){
        $query = $this->db->get_where('pages', ['page_id' => $page_id]);
        return $query->row_array();
    }
    
    public function doupdateContent($id){
        $data = array(
            'message' => $this->input->post('page_name'),
          );
         $this->db->update('pages', $data, ['id' => $id]);
         return $this->db->affected_rows();
    }
	
}
