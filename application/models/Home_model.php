<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	/**
	 * Home Model.
	 * Created By Rohan Singh
	 
	 */

	public function getPagesData($page_id)
	{
		$query = $this->db->get_where('pages', ['page_id' => $page_id]);
		return $query->row_array();
	}
    
    public function getRestaurants($checked_val){
        $this->db->select('v.name,v.image,v.category');
        $this->db->from('vendors v');
        $this->db->join('menu_restaurant m', 'm.vendor_id = v.vendor_id');
        $this->db->join('product p', 'p.menu_id = m.id');
        $this->db->where(['p.deleted_status' => '0', 'm.deleted_status' => '0', 'p.status' => 'Active', 'm.status' => 'Active']);
        $this->db->where_in('p.admin_menu_id', $checked_val);
        $this->db->group_by('v.vendor_id');
        $sel = $this->db->get();
        return $sel->result_array();
    }     
    public function searchRestaurants($key_search, $checked_val){
        $this->db->select('v.name,v.image,v.category');
        $this->db->from('vendors v');
        $this->db->join('menu_restaurant m', 'm.vendor_id = v.vendor_id');
        $this->db->join('product p', 'p.menu_id = m.id');
        $this->db->where(['p.deleted_status' => '0', 'm.deleted_status' => '0', 'p.status' => 'Active', 'm.status' => 'Active']);
        $this->db->where_in('p.admin_menu_id', $checked_val);
        $this->db->like('v.name', $key_search, 'both');
        $this->db->group_by('v.vendor_id');
        $sel = $this->db->get();
        return $sel->result_array();
    }       
    public function getProducts($veg_type, $cat_type, $vendor_id){
        $this->db->select('p.*');
        $this->db->from('vendors v');
        $this->db->join('menu_restaurant m', 'm.vendor_id = v.vendor_id');
        $this->db->join('product p', 'p.menu_id = m.id');
        $this->db->where(['p.deleted_status' => '0', 'm.deleted_status' => '0', 'p.status' => 'Active', 'm.status' => 'Active', 'v.vendor_id' => $vendor_id]);
        $this->db->where_in('p.product_type', $veg_type);
        $this->db->where_in('p.menu_id', $cat_type);
        $sel = $this->db->get();
        return $sel->result_array();
    }        
    public function getProductSearch($key_search, $veg_type, $cat_type, $vendor_id){
        $this->db->select('p.*');
        $this->db->from('vendors v');
        $this->db->join('menu_restaurant m', 'm.vendor_id = v.vendor_id');
        $this->db->join('product p', 'p.menu_id = m.id');
        $this->db->where(['p.deleted_status' => '0', 'm.deleted_status' => '0', 'p.status' => 'Active', 'm.status' => 'Active', 'v.vendor_id' => $vendor_id]);
        $this->db->where_in('p.product_type', $veg_type);
        $this->db->where_in('p.menu_id', $cat_type);
        $this->db->like('p.name', $key_search, 'both');
        $sel = $this->db->get();
        return $sel->result_array();
    }        
    public function getProductImages($vendor_id){
        $this->db->select('pi.*');
        $this->db->from('vendors v');
        $this->db->join('menu_restaurant m', 'm.vendor_id = v.vendor_id');
        $this->db->join('product p', 'p.menu_id = m.id');
        $this->db->join('product_image pi', 'pi.product_id = p.id');
        $this->db->where(['p.deleted_status' => '0', 'm.deleted_status' => '0', 'p.status' => 'Active', 'm.status' => 'Active', 'v.vendor_id' => $vendor_id]);
        $sel = $this->db->get();
        return $sel->result_array();
    }    
    public function getRestaurantDataByName($restaurant_name){
        $this->db->select('v.name,v.image,v.category, v.vendor_id');
        $this->db->from('vendors v');
        $this->db->join('menu_restaurant m', 'm.vendor_id = v.vendor_id');
        $this->db->join('product p', 'p.menu_id = m.id');
        $this->db->where(['p.deleted_status' => '0', 'm.deleted_status' => '0', 'p.status' => 'Active', 'm.status' => 'Active']);
        $this->db->where_in('v.name', $restaurant_name);
        $this->db->group_by('v.vendor_id');
        $sel = $this->db->get();
        return $sel->row_array();
    }    
    public function getRestaurantMenuData($vendor_id){
        $this->db->from('menu_restaurant m');
        $this->db->where(['m.deleted_status' => '0', 'm.status' => 'Active']);
        $this->db->where_in('m.vendor_id', $vendor_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }

    public function getAdminMenu(){
    	$sel = $this->db->get_where('admin_menu', ['status' => 'Active', 'delete_status' => '0']);
        return $sel->result_array();
    }
	
}
