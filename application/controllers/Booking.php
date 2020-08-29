<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

	/**
	 * Home  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('user_model');
	}
    
    public function uniqueId() {
        $str = '123456789';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 8);
        return $unique_id;
    }
    
    public function checkout(){
        $data['title'] = 'Checkout';
        $data['userData'] = $this->getLoginDetail();
        $user_id = $data['userData']['user_id'];
        $data['address'] = $this->home_model->getAddressByUserId($user_id);
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        if(empty($data['userData'])){
        $this->load->view('front/booking/checkout');    
        }else{
        $this->load->view('front/booking/address');   
        }
        
        $this->load->view('front/commons/footer');
     }
    
     private function is_login(){
		return $this->session->userdata('login_id');
	}
    
    private function getLoginDetail(){
		$login_id = $this->session->userdata('login_id');
		return $this->user_model->getLoginDetail($login_id);
	}
    
    public function doAddAddress (){
       $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('username', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('pincode', 'Pin code', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        } 
        
        $data['userData'] = $this->getLoginDetail();
        $user_id = $data['userData']['user_id'];
        $result = $this->home_model->doAddAddress($user_id);
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Address Added Successfully!..']));
                return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
        }
        
    }
    
    public function order(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('address_id', 'Address', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $address_id = $this->input->post('address_id');
        $payment_type = $this->input->post('radion3');
        $unique_id = $this->uniqueId();
        $user_id = $this->getLoginDetail()['user_id'];
        $total = $this->input->post('total');
        $data = [];
        $vendor_id = '';
        foreach($this->cart->contents() as $cart ){
            $data[] = array(
            'product_id' => $cart['id'],
            'qty' => $cart['qty'],
            'price'=>$cart['price'],
            'unique_id'=>$unique_id
            );
            $vendor_id = $cart['vendor_id'];
        }
        //insert-order-details
        $result = $this->home_model->order($unique_id,$vendor_id,$user_id,$total);
        $this->home_model->order_details($data);
        if($result){
            $this->cart->destroy();
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('home/confirmation'), 'msg' => 'Order placed Successfully!..']));
                return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
        }
    
    }
    
    public function orderConfirmation(){
        $data['title'] = 'Order-confirmation';
        $data['userData'] = $this->getLoginDetail();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/booking/confirmation');    
        $this->load->view('front/commons/footer');
        
    }


	
	
}
