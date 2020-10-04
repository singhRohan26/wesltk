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
        if(empty($this->session->userdata('booking'))){
            return redirect('/');
        }
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
    public function catring_checkout(){
        if(empty($this->session->flashdata('data_ses')) || empty($this->session->flashdata('product_ses'))){
            redirect(base_url());
        }else{
            $this->session->set_flashdata('data_ses', $this->session->flashdata('data_ses'));
            $this->session->set_flashdata('product_ses', $this->session->flashdata('product_ses'));
            $data['fill_data'] = $this->session->flashdata('data_ses');
        }
        $data['title'] = 'Checkout';
        $data['userData'] = $this->getLoginDetail();
        $user_id = $data['userData']['user_id']; 
        $data['product'] = $this->home_model->getSalonProductByProductId($this->session->flashdata('product_ses'), 'salon');
        $data['address'] = $this->home_model->getAddressByUserId($user_id);
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        if(empty($data['userData'])){
            $this->load->view('front/booking/catring_checkout');    
        }else{
            $this->load->view('front/booking/catring_address');   
        }
        
        $this->load->view('front/commons/footer');
     }
    public function test(){
         require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
         try {
            $charge = \Stripe\Charge::create ([
                            "amount" => 100 * 100,
                            "currency" => "usd",
                            "source" => $this->input->post('stripeToken'),
                            "description" => "Test payment from itsolutionstuff.com." 
                    ]);
            $chargeJson = $charge->jsonSerialize();
            } catch(Stripe_CardError $e) {
            echo " it's a decline, Stripe_CardError will be caught";die;
              $body = $e->getJsonBody();
              $err  = $body['error'];
            
              print('Status is:' . $e->getHttpStatus() . "\n");
              print('Type is:' . $err['type'] . "\n");
              print('Code is:' . $err['code'] . "\n");
              // param is '' in this case
              print('Param is:' . $err['param'] . "\n");
              print('Message is:' . $err['message'] . "\n");
            } catch (Stripe_InvalidRequestError $e) {
                
              echo " Invalid parameters were supplied to Stripe's API";die;
            } catch (Stripe_AuthenticationError $e) {
              // Authentication with Stripe's API failed
              echo " (maybe you changed API keys recently)";die;
            } catch (Stripe_ApiConnectionError $e) {
              echo "Network communication with Stripe failed";die;
            } catch (Stripe_Error $e) {
              echo " Display a very generic error to the user, and maybe send";die;
              // yourself an email
            } catch (Exception $e) {
              echo "Something else happened, completely unrelated to Stripe";die;
            }
            
                
            //  if($chargeJson)
            //  {
            //      // $txn_id = $chargeJson['balance_transaction'];
            //      // $this->home_model->updatePersonDetail($this->session->userdata('user_id'));
            //      // redirect(base_url('home/result'));
            //  }else{
            //     $this->session->unset_userdata('stripe_payment');
            //     redirect('home/paymentFailure/');
            // }
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
    
    public function doEditAddress($id){
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
        $result = $this->home_model->doEditAddress($id);
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Address Added Successfully!..']));
                return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
        }
        
        
    }
    
    public function deleteAddress($id){
        $result = $this->home_model->deleteAddress($id);
        if($result){
        return redirect('/');    
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
        $address_data = $this->home_model->getAddressById($address_id);
        $payment_type = $this->input->post('card_type');
        $unique_id = $this->uniqueId();
        $user_id = $this->getLoginDetail()['user_id'];
        $total = $this->cart->total();
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
        $address_id = $this->home_model->doAddOrderAddress($address_data);
        $result = $this->home_model->order($unique_id,$vendor_id,$user_id,$total, $address_id);
        $this->home_model->order_details($data);
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('home/confirmation'), 'msg' => 'Order placed Successfully!..']));
                return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
        }
    
    }
    
    public function orderConfirmation(){
        if(empty($this->cart->contents())){
            redirect(base_url());
        }
        $this->cart->destroy();
        $this->session->unset_userdata('booking');
        $data['title'] = 'Order-confirmation';
        $data['userData'] = $this->getLoginDetail();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/booking/confirmation');    
        $this->load->view('front/commons/footer');
        
    }
    
    public function removeCart($rowid){
        $data = array(
        'rowid'   => $rowid,
        'qty'     => 0
        );

        $res = $this->cart->update($data);
        if($res){
            return redirect('home/your-cart');
        }
    }
    
    public function cancelOrder($id){
     $this->output->set_content_type('application/json');
        $result = $this->home_model->cancelOrder($id);
        if($result){
          $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('user/user-profile'), 'msg' => 'Order Cancelled!']));
                return FALSE;  
        }else{
          $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;  
        }
    }
    
    public function addReviews(){
     $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('rating', 'Rating', 'required');
        $this->form_validation->set_rules('review', 'Review', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        } 
        $data['userData'] = $this->getLoginDetail();
        $rating = $this->input->post('rating');
        $review = $this->input->post('review');
        $vendor_id = $this->input->post('vendor_id');
        
        $result = $this->home_model->addReviews($rating,$review,$vendor_id,$data['userData']['user_id']);
        if($result){
         $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('user/user-profile'), 'msg' => 'Review Added']));
                return FALSE;    
        }else{
           $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;   
        }
    }


	
	
}
