<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Admin  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}


	public function index()
	{
//		if(!empty($this->is_login())){
//			redirect(base_url('admin/dashboard'));
//		}
		$data['title'] = "Admin Panel";
		$this->load->view('admin/login', $data);
	}

	
}
