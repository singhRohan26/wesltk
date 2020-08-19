<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_model extends CI_Model {

    /**
     * Admin  Model.
     * Created By Rohan Singh
     
     */

    public function doAddRestaurantMenu(){
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'status' => $this->security->xss_clean($this->input->post('status'))
          );
        $this->db->insert('menu_restaurant', $data);
        return $this->db->insert_id();
    }
    public function doEditRestaurantMenu($id){
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'status' => $this->security->xss_clean($this->input->post('status'))
          );
        $this->db->update('menu_restaurant', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doDeleteRestaurantMenu($id){
        $data = array(
            'deleted_status' => '1'
          );
        $this->db->update('menu_restaurant', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function getMenuData(){
        $query = $this->db->get_where('menu_restaurant', ['deleted_status' => '0']);
        return $query->result_array();
    }
    public function getMenuDataById($id){
        $query = $this->db->get_where('menu_restaurant', ['id' => $id, 'deleted_status' => '0']);
        return $query->row_array();
    }
    
}
