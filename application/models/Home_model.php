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
    
    public function getRestaurants(){
        $this->db->select('v.name,v.image,v.category');
        $this->db->from('vendors v');
        $sel = $this->db->get();
        return $sel->result_array();
    }
	
}
