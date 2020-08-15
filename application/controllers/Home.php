<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Home  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('user_model');
	}


	public function index(){
        $data['title'] = 'Homepage';
        $data['userData'] = $this->getLoginDetail();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/index');
        $this->load->view('front/commons/footer');
    }
    
        
    public function cart(){
        $data['title'] = 'Cart';
        $data['userData'] = $this->getLoginDetail();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/cart/cart');
        $this->load->view('front/commons/footer');
    }
         
    public function becomePartner(){
       $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('vendor_name', 'Vendor Name', 'required');
        $this->form_validation->set_rules('vendor_email', 'Vendor Email', 'required|valid_email');
        $this->form_validation->set_rules('vendor_phone', 'Vendor Phone Number', 'required');
        $this->form_validation->set_rules('vendor_website', 'vendor website', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->user_model->checkVendorEmail();
        if ($result) {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Vendo Email already exists.']));
            return FALSE;
        } else {
            $register = $this->user_model->becomePartner();
            if($register){
                $this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Request Added Successfully!..']));
                return FALSE;
            }else{
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
            }
            
        }
    }   
    public function about(){
        $data['title'] = 'About';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('about');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/about');
        $this->load->view('front/commons/footer');
    }
           
    public function privacy_policy(){
        $data['title'] = 'privacy-policy';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('privacy');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/about');
        $this->load->view('front/commons/footer');
    }
    
    private function is_login(){
		return $this->session->userdata('login_id');
	}
    
    private function getLoginDetail(){
		$login_id = $this->session->userdata('login_id');
		return $this->user_model->getLoginDetail($login_id);
	}
    

	
}
