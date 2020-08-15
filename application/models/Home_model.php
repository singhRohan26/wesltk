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
	
}
