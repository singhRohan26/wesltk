<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_model extends CI_Model {

    /**
     * Admin  Model.
     * Created By Rohan Singh
     
     */

    public function doAddRestaurantMenu($vendor_id){
        $data = array(
            'vendor_id' => $vendor_id,
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
    public function doAddServiceMenu($vendor_id){
        $data = array(
            'vendor_id' => $vendor_id,
            'name' => $this->security->xss_clean($this->input->post('name')),
            'status' => $this->security->xss_clean($this->input->post('status'))
          );
        $this->db->insert('menu_servcie', $data);
        return $this->db->insert_id();
    }
    public function doEditServiceMenu($id){
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'status' => $this->security->xss_clean($this->input->post('status'))
          );
        $this->db->update('menu_servcie', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doDeleteRestaurantMenu($id){
        $data = array(
            'deleted_status' => '1'
          );
        $this->db->update('menu_restaurant', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function doDeleteServiceMenu($id){
        $data = array(
            'deleted_status' => '1'
          );
        $this->db->update('menu_servcie', $data, ['id' => $id]);
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
    public function getMenuServiceData(){
        $query = $this->db->get_where('menu_servcie', ['deleted_status' => '0']);
        return $query->result_array();
    }
    public function getMenuServiceDataById($id){
        $query = $this->db->get_where('menu_servcie', ['id' => $id, 'deleted_status' => '0']);
        return $query->row_array();
    }
    public function getProductData(){
        $this->db->select('m.name as menu_name, p.name as product_name, p.price,p.status, p.id');
        $this->db->from('menu_restaurant m');
        $this->db->join('product p', 'p.menu_id = m.id');
        $this->db->where(['m.deleted_status' => '0', 'p.deleted_status' => '0', 'm.status' => 'Active','p.form_type'=>'food']);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getProductDataById($id){
        $this->db->select('m.name as menu_name, p.name as product_name, p.price,p.status, p.id,p.description,p.product_type, m.id as menu_id,am.name as admin_menu,am.id as admin_menu_id');
        $this->db->from('menu_restaurant m');
        $this->db->join('product p', 'p.menu_id = m.id');
        $this->db->join('admin_menu am','am.id=p.admin_menu_id');
        $this->db->where(['m.deleted_status' => '0', 'p.deleted_status' => '0', 'm.status' => 'Active', 'p.id' => $id]);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getServiceProductData(){
        $this->db->select('m.name as menu_name, p.name as product_name, p.price,p.status, p.id');
        $this->db->from('menu_servcie m');
        $this->db->join('product p', 'p.service_menu_id = m.id');
        $this->db->join('admin_service_menu am','am.id=p.admin_service_menu_id');
        $this->db->where(['m.deleted_status' => '0', 'p.deleted_status' => '0', 'm.status' => 'Active','p.form_type'=>'services']);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getServiceProductDataById($id){
        $this->db->select('m.name as menu_name, p.name as product_name, p.price,p.status, p.id,p.description,p.product_type, m.id as menu_id,am.name as admin_menu,am.id as admin_menu_id');
        $this->db->from('menu_servcie m');
        $this->db->join('product p', 'p.service_menu_id = m.id');
        $this->db->join('admin_service_menu am','am.id=p.admin_service_menu_id');
        $this->db->where(['m.deleted_status' => '0', 'p.deleted_status' => '0', 'm.status' => 'Active', 'p.id' => $id]);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getProductImageByProductId($id){
        $query = $this->db->get_where('product_image', ['product_id' => $id]);
        return $query->result_array();
    }
    public function getProductImageById($id){
        $query = $this->db->get_where('product_image', ['id' => $id]);
        return $query->row_array();
    }
    public function deleteProductImageById($id){
        $query = $this->db->delete('product_image', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function doAddProduct($img_res){
        $data = array(
            'admin_menu_id' => $this->security->xss_clean($this->input->post('admin_menu')),
            'menu_id' => $this->security->xss_clean($this->input->post('menu')),
            'name' => $this->security->xss_clean($this->input->post('name')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'status' => $this->security->xss_clean($this->input->post('status')),
            'product_type'=>$this->security->xss_clean($this->input->post('food_type')),
            'form_type'=>'food'
          );
        $this->db->insert('product', $data);
        $product_id = $this->db->insert_id();
        foreach ($img_res as $img) {
            $this->db->insert('product_image', ['image' => $img['file_name'], 'product_id' => $product_id]);
        }
        return $product_id;
    }
    public function doAddServiceProduct($img_res){
        $data = array(
            'admin_service_menu_id' => $this->security->xss_clean($this->input->post('admin_menu')),
            'service_menu_id' => $this->security->xss_clean($this->input->post('menu')),
            'name' => $this->security->xss_clean($this->input->post('name')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'status' => $this->security->xss_clean($this->input->post('status')),
            'form_type'=>'services'
          );
        $this->db->insert('product', $data);
        $product_id = $this->db->insert_id();
        foreach ($img_res as $img) {
            $this->db->insert('product_image', ['image' => $img['file_name'], 'product_id' => $product_id]);
        }
        return $product_id;
    }
    public function doEditProduct($id, $img_res){
        $data = array(
            'menu_id' => $this->security->xss_clean($this->input->post('menu')),
            'name' => $this->security->xss_clean($this->input->post('name')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'status' => $this->security->xss_clean($this->input->post('status'))
          );
        $this->db->update('product', $data, ['id' => $id]);
        $this->db->affected_rows();
        if(!empty($img_res)){
            foreach ($img_res as $img) {
                $this->db->insert('product_image', ['image' => $img['file_name'], 'product_id' => $id]);
            }
        }
        return $id;
    }
    public function doEditServiceProduct($id, $img_res){
        $data = array(
            'admin_service_menu_id' => $this->security->xss_clean($this->input->post('admin_menu')),
            'service_menu_id' => $this->security->xss_clean($this->input->post('menu')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'status' => $this->security->xss_clean($this->input->post('status'))
          );
        $this->db->update('product', $data, ['id' => $id]);
        $this->db->affected_rows();
        if(!empty($img_res)){
            foreach ($img_res as $img) {
                $this->db->insert('product_image', ['image' => $img['file_name'], 'product_id' => $id]);
            }
        }
        return $id;
    }
    public function deleteServiceProduct($id){
        $data = array(
            'deleted_status' => '1'
          );
        $this->db->update('product', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function getAdminMenus(){
        $this->db->select('*');
        $this->db->from('admin_menu');
        $this->db->where('deleted_status', '0');
        $this->db->where('status', 'Active');
        $sel = $this->db->get();
        return $sel->result_array();
    } 
    public function getAdminServiceMenus(){
        $this->db->select('*');
        $this->db->from('admin_service_menu');
        $this->db->where('deleted_status', '0');
        $this->db->where('status', 'Active');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
}
