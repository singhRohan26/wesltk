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
    
    public function getShopProducts($checked_val){
       $this->db->select('v.name,v.image,v.category');
        $this->db->from('vendors v');
        $this->db->join('menu_product m', 'm.vendor_id = v.vendor_id');
        $this->db->join('product p', 'p.menu_product_id = m.id');
        $this->db->where(['p.deleted_status' => '0', 'm.deleted_status' => '0', 'p.status' => 'Active', 'm.status' => 'Active']);
        $this->db->where_in('p.admin_product_menu_id', $checked_val);
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
    
    public function getProductDataByName($restaurant_name){
        $this->db->select('v.name,v.image,v.category, v.vendor_id');
        $this->db->from('vendors v');
        $this->db->join('menu_product m', 'm.vendor_id = v.vendor_id');
        $this->db->join('product p', 'p.menu_product_id = m.id');
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
    
    public function getProductMenuData($vendor_id){
        $this->db->from('menu_product m');
        $this->db->where(['m.deleted_status' => '0', 'm.status' => 'Active']);
        $this->db->where_in('m.vendor_id', $vendor_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }

    public function getAdminMenu(){
    	$sel = $this->db->get_where('admin_menu', ['status' => 'Active', 'deleted_status' => '0']);
        return $sel->result_array();
    }
    
    public function getProductMenu(){
        $sel = $this->db->get_where('admin_product_menu', ['status' => 'Active', 'deleted_status' => '0']);
        return $sel->result_array();
    }
    
    public function getShopProductLists($vendor_id,$cat_type){
        $this->db->select('p.*');
        $this->db->from('vendors v');
        $this->db->join('menu_product m', 'm.vendor_id = v.vendor_id');
        $this->db->join('product p', 'p.menu_product_id = m.id');
        $this->db->where(['p.deleted_status' => '0', 'm.deleted_status' => '0', 'p.status' => 'Active', 'm.status' => 'Active', 'v.vendor_id' => $vendor_id]);
        $this->db->where_in('m.id',$cat_type);
        $sel = $this->db->get();
//        echo $this->db->last_query();die;
        return $sel->result_array();
    }
	
    public function getProductDataById($id){
        $query = $this->db->get_where('product', ['id' => $id]);
        return $query->row_array();
    }
    public function getProductImageById($id){
        $query = $this->db->get_where('product_image', ['product_id' => $id]);
        return $query->row_array();
    }
    public function getVenodrIdByProductMenu($id){
       $this->db->select('m.vendor_id');
        $this->db->from('menu_product m');
        $this->db->where(['m.status' => 'Active', 'm.id' => $id]);        
        $sel = $this->db->get();
//        echo $this->db->last_query();die;
        return $sel->row_array()['vendor_id'];
    }
    public function getVenodrIdByResturantMenu($id){
       $this->db->select('m.vendor_id');
        $this->db->from('menu_restaurant m');
        $this->db->where(['m.status' => 'Active', 'm.id' => $id]);        
        $sel = $this->db->get();
        return $sel->row_array()['vendor_id'];
    }
    
    public function doAddAddress($user_id){
        $data = array(
        'user_id' =>$user_id,
        'name' =>$this->security->xss_clean($this->input->post('username')),
        'address' =>$this->security->xss_clean($this->input->post('address')),
        'pincode' =>$this->security->xss_clean($this->input->post('pincode')),
        'city_id' =>$this->security->xss_clean($this->input->post('city')),
        'state_id' =>$this->security->xss_clean($this->input->post('state')),
        'country_id' =>$this->security->xss_clean($this->input->post('country')),
//        'type' =>$this->security->xss_clean($this->input->post('vendor_website')),
        );
        
        $this->db->insert('address',$data);
        return $this->db->insert_id();
    }
    
    public function getAddressByUserId($user_id){
        $sel = $this->db->get_where('address',['user_id'=>$user_id]);
        return $sel->result_array();
    }
    
    public function order($unique_id,$vendor_id,$user_id,$total){
       $data = array(
        'unique_id' =>$unique_id,
        'vendor_id'=>$vendor_id,
        'user_id'=>$user_id,
        'sub_total'=>$total,
        'status'=>'Processing'
        );
        
        $this->db->insert('order',$data);
        return $this->db->insert_id();
    }
    
    public function order_details($data){
        $this->db->insert_batch('order_details',$data);
        return $this->db->insert_id();
    }
}
