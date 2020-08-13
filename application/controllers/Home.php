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
	}


	public function index(){
        $data['title'] = 'Homepage';
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/index');
        $this->load->view('front/commons/footer');
    }
    
        
    public function cart(){
        $data['title'] = 'Cart';
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/cart/cart');
        $this->load->view('front/commons/footer');
    }
    

	
}
