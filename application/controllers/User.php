<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Home  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['user_model','home_model']);
	}


	public function doRegistration(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('emailid', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
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
            $this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Registration Success']));
			return FALSE;
            }
			
		}
    }

	public function updatProfile(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('profile_name', 'Name', 'required');
		$this->form_validation->set_rules('profile_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('profile_phone', 'Phone Number', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
                
		$result = $this->user_model->checkemail($this->session->userdata('login_id'));
		if ($result) {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email already exists.']));
			return FALSE;
		} else {
			if(!empty($_FILES['imageUpload']['name'])){
				$img = $this->doUploadProfileImage('imageUpload');
			}else{
				$img = $this->user_model->getLoginDetail($this->session->userdata('login_id'))['image'];
			}
            $register = $this->user_model->updatProfile($img);
            if($register){
	            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("user/user-profile"), 'msg' => 'Profile Updated Successfully']));
				return FALSE;
            }else{
            	$this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes Were Made!..']));
				return FALSE;
            }
			
		}
    }
    
    public function doUploadProfileImage($file){
        $file1 = $_FILES[$file]['name'];
        $config['upload_path'] = './uploads/users/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
       // $config['max_filename'] = '2555';
        $config['file_name'] = rand(111, 9999);
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $upload_data = $this->upload->data();
        return $upload_data['file_name'];
        
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
         $this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Login Success']));
			return FALSE;   
        }else{
           $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid credentials']));
			return FALSE; 
        }
        
    }  
    public function change_password(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('opass', 'Old Password', 'required');
		$this->form_validation->set_rules('npass', 'New Password', 'required|min_length[6]');
		$this->form_validation->set_rules('cpass', 'Confirm Password', 'required|min_length[6]|matches[npass]');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$chk_password = $this->getLoginDetail();
        if($chk_password['password'] != $this->security->xss_clean(hash('sha256', $this->input->post('opass')))) {
        	$this->output->set_output(json_encode(['result' => 0, 'errors' => ['opass' => 'Old Password is incorrect']]));
			return FALSE;
        }
        if($chk_password['password'] == $this->security->xss_clean(hash('sha256', $this->input->post('npass')))) {
        	$this->output->set_output(json_encode(['result' => 0, 'errors' => ['opass' => 'New Password and Old Password should not be same']]));
			return FALSE;
        }
        $result = $this->user_model->changePassword();
        if($result){
         $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("user/user-profile"), 'msg' => 'Password Chaged Successfully']));
			return FALSE;   
        }else{
           $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
			return FALSE; 
        }
        
    }
    
    
    public function profile(){
        $data['title'] = 'User Profile';
        $data['userData'] = $this->getLoginDetail();
        $data['address'] = $this->home_model->getAddressByUserId($data['userData']['user_id']);
        $data['orderLists'] = $this->home_model->getOrderListByUserId($data['userData']['user_id']);

        $i=0;
        foreach($data['orderLists'] as $orders){
            $data['orderLists'][$i]['details'] = $this->home_model->getOrderDetails($orders['unique_id']);
            $i++;
        }
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
    
    public function forgotPassword(){
       $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        $phone = $this->input->post('mobile');
        $check = $this->user_model->checkPhone($phone);
        $this->session->set_flashdata('user_id',$check['user_id']);
//        $check = 1;
        $rand = rand('1111','9999');
//        $data['userData'] = $this->getLoginDetail();
        if($check){
            //otp sent
            $this->load->library('twilio');
            $sms_sender = '+12029724537';
            $sms_reciever = $phone;
            $sms_message = 'Your otp to reset your password :'.$rand;
            $from = '+'.$sms_sender; //trial account twilio number
            $to = '+'.$sms_reciever; //sms recipient number
            $response = $this->twilio->sms($from, $to,$sms_message);

            if($response->IsError){

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Otp not sent']));
			return FALSE; 
            }
            else{
            $this->user_model->updateOTP($check['user_id'],$rand);
            $this->output->set_output(json_encode(['result' => 4, 'msg' => 'OTP Sent Successfully']));
			return FALSE; 
            }
            
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Phone number does not exists']));
			return FALSE; 
        }
        
    }
    
    public function checkOtp(){
      $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('partitioned', 'OTP', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        $user_id = $this->session->flashdata('user_id');
        $this->session->set_flashdata('next_user_id',$user_id);
//        echo $user_id;die;
        $check = $this->user_model->checkOtp($user_id);
        if($check){
           $this->output->set_output(json_encode(['result' => 5, 'msg' => 'OTP Verified']));
			return FALSE;  
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid OTP']));
			return FALSE;
        }
        
    }
    
    public function resetPassword(){
     $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('fpass', 'Password', 'required');
      $this->form_validation->set_rules('fcpass', 'Confirm Password', 'required|matches[fpass]');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        $user_id = $this->session->flashdata('next_user_id');
//        echo $user_id;die;
        $result = $this->user_model->resetPassword($user_id);
        if($result){
           $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password changed!','url'=> base_url('/') ]));
			return FALSE;  
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'something went wrong']));
			return FALSE;
        }
        
    }
    
    
    
    

    
    

    
    

	
}
