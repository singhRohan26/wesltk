<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model {

	/**
	 * vendor  Model.
	 * Created By Rohan Singh
	 
	 */

    
    public function checkLogin(){
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password')))
        );
        $query = $this->db->get_where('vendors', $data);
        return $query->row_array();
    }
    
    public function getLoginDetail($login_id){
        $sel = $this->db->get_where('vendors', ['vendor_id'=>$login_id]);
        return $sel->row_array();
    }
    
    public function doChangePass(){
        $data = array(
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('npass')))
        );
        $this->db->update('vendors', $data);
        return $this->db->affected_rows();
    }
    
    public function edit_profile($id){
       $query = $this->db->get_where('vendors',['vendor_id'=>$id]);
       return $query->row_array();
    }
    
    public function doChangeProfile($id){
         $logindata = array(
            'name' => $this->security->xss_clean($this->input->post('vendor_name')),
            'email' => $this->security->xss_clean($this->input->post('email_id')),
            'phone' =>$this->security->xss_clean($this->input->post('phone')),
          );
         $this->db->update('vendors', $logindata,['vendor_id'=>$id]);
        return $this->db->affected_rows();

    }
    
}
