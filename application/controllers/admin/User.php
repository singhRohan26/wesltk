<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Admin  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}


	public function users(){
        if(empty($this->is_login())){
			redirect(base_url('admin'));
		}
		$data['title'] = "edit profile";
		$id = $this->session->userdata('login_id');
        $data['userData'] = $this->getLoginDetail();
		$this->load->view('admin/commons/header', $data);
		$this->load->view('admin/commons/sidebar');
		$this->load->view('admin/users/user-list');
		$this->load->view('admin/commons/footer');
    }
    
    private function is_login(){
		return $this->session->userdata('login_id');
	}
    
    private function getLoginDetail(){
		$login_id = $this->session->userdata('login_id');
		return $this->admin_model->getLoginDetail($login_id);
	}
    

	
}
