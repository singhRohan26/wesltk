<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Home  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}


	public function doRegistration(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('cpass', 'Confirm Password', 'required|min_length[6]|matches[pass]');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->user_model->checkemail();
		if ($result) {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email already exists.']));
			return FALSE;
		} else {
            $register = $this->user_model->doRegistration();
            if($register){
            $this->session->set_userdata('login_id', $register);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("home"), 'msg' => 'Registration Success']));
			return FALSE;
            }
			
		}
    }
    
    public function doLogin(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        
        $result = $this->user_model->checkLogin();
        if($result){
            $this->session->set_userdata('login_id', $result['user_id']);
         $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("home"), 'msg' => 'Login Success']));
			return FALSE;   
        }else{
           $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid credentials']));
			return FALSE; 
        }
        
    }
    
    
    public function profile(){
        $data['title'] = 'User Profile';
        $data['userData'] = $this->getLoginDetail();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/profile');
        $this->load->view('front/commons/footer');
    }
    
    private function is_login(){
		return $this->session->userdata('login_id');
	}
    
    private function getLoginDetail(){
		$login_id = $this->session->userdata('login_id');
		return $this->user_model->getLoginDetail($login_id);
	}
    
    public function logout(){
        $this->session->unset_userdata('login_id');
		redirect(base_url('home'));
    }
    
    
    

	
}
