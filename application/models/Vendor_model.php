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
    
    public function getLoginDetail($login_id, $category_type = null){
        $sel = $this->db->get_where('vendors', ['vendor_id'=>$login_id]);
        $row = $sel->row_array();
        if(!empty($category_type)){
            if(in_array($category_type, explode(',', $row['category']))){
                return $row;
            }
        }else{
            return $row;
        }
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
    
    public function doChangeProfile($id,$img_res){
         $logindata = array(
            'name' => $this->security->xss_clean($this->input->post('vendor_name')),
            'email' => $this->security->xss_clean($this->input->post('email_id')),
            'phone' =>$this->security->xss_clean($this->input->post('phone')),
            'website' =>$this->security->xss_clean($this->input->post('website')),
            'min_amount' =>$this->security->xss_clean($this->input->post('amount')),
            'delivery_time' =>$this->security->xss_clean($this->input->post('time')),
            'working_hours' =>$this->security->xss_clean($this->input->post('hours')),
            'image'=>$img_res
             
          );
         $this->db->update('vendors', $logindata,['vendor_id'=>$id]);
        return $this->db->affected_rows();

    }
    
    public function doAddDeliveryBoy($vendor_id){
        $data = array(
        'vendor_id'=>$vendor_id,
        'name' => $this->security->xss_clean($this->input->post('name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'phone' =>$this->security->xss_clean($this->input->post('phone')),
            'status' =>$this->security->xss_clean($this->input->post('status')),
            'password' =>$this->security->xss_clean(hash('sha256', $this->input->post('pass'))),
        );
        
        $this->db->insert('delivery',$data);
        return $this->db->insert_id();
    }
    
    public function getDeliveryBoys($vendor_id){
        $this->db->select('*');
        $this->db->from('delivery');
        $this->db->where('vendor_id',$vendor_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getDeliveryBoyById($id){
        $sel = $this->db->get_where('delivery',['delivery_boy_id'=>$id]);
        return $sel->row_array();
    }
    
    public function doEditDeliveryBoy($id){
       $data = array(
        'name' => $this->security->xss_clean($this->input->post('name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'phone' =>$this->security->xss_clean($this->input->post('phone')),
            'status' =>$this->security->xss_clean($this->input->post('status')),
            'password' =>$this->security->xss_clean($this->input->post('pass')),
        );
        
        $this->db->where('delivery_boy_id',$id);
        $this->db->update('delivery',$data);
        return $this->db->affected_rows();
        
    }
    
    public function deleteBoy($id){
        $this->db->where('delivery_boy_id',$id);
        $this->db->update('delivery',['status'=>'Inactive']);
        return $this->db->affected_rows();
    }
    
    public function orderListByVendorId($user_id){
        $this->db->select('u.name,o.*');
        $this->db->from('order o');
        $this->db->join('users u','u.user_id=o.user_id');
        $this->db->order_by('o.id','desc');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function changeOrderStatus($unique_id,$status){
        $this->db->where('unique_id',$unique_id);
        $this->db->update('order',['status'=>$status]);
        return $this->db->affected_rows();
    }
    
    public function assignDeliveryBoy($unique_id,$id){
      $this->db->where('unique_id',$unique_id);
        $this->db->update('order',['delivery_boy_id'=>$id]);
        return $this->db->affected_rows();  
    }
    
}
