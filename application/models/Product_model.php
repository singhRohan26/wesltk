<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	/**
	 * Home Model.
	 * Created By Rohan Singh
	 
	 */

    public function getProductCategory(){
        $sel = $this->db->get_where('admin_product_menu',['status'=>'Active','deleted_status'=>'0']);
        return $sel->result_array();
    }
    
    public function getMenu(){
        $sel = $this->db->get_where('menu_product',['status'=>'Active','deleted_status'=>'0']);
        return $sel->result_array();
    }
    
    public function doAddProduct($img_res){
        $data = array(
            'admin_product_menu_id' => $this->security->xss_clean($this->input->post('product_menu')),
            'menu_product_id' => $this->security->xss_clean($this->input->post('menu')),
            'name' => $this->security->xss_clean($this->input->post('name')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'status' => $this->security->xss_clean($this->input->post('status')),
            'quantity'=> $this->security->xss_clean($this->input->post('quantity')),
            'form_type'=>'products'
          );
        $this->db->insert('product', $data);
        $product_id = $this->db->insert_id();
        foreach ($img_res as $img) {
            $this->db->insert('product_image', ['image' => $img['file_name'], 'product_id' => $product_id]);
        }
        return $product_id;
    }
    
    public function getProducts(){
        $this->db->select('m.name as menu_name, p.name as product_name, p.price,p.status, p.id');
        $this->db->from('menu_product m');
        $this->db->join('product p', 'p.menu_product_id = m.id');
        $this->db->where(['m.deleted_status' => '0', 'p.deleted_status' => '0', 'm.status' => 'Active','p.form_type'=>'products']);
        $query = $this->db->get();
        return $query->result_array();
    }
	
}
