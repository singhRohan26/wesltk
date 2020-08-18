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

	public function updatProfile(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('profile_name', 'Name', 'required');
		$this->form_validation->set_rules('profile_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('profile_phone', 'Phone Number', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        
        if (!empty($_FILES['imageUpload']['name'])) {
            echo 'ho';die;
                $image_name = $_FILES['imageUpload']['name'];
                $img = rand(1, 99999);
                $image_tmp = $_FILES['imageUpload']['tmp_name'];
                $allowed_types = ["jpeg","jpg","png"];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                if(in_array($ext, $allowed_types)){
                    $image = $img.".".$ext;
                    move_uploaded_file($image_tmp, './uploads/users/'.$image);
                }
            }else{
//            echo 'hi';die;
                $user = $this->getLoginDetail();
                $image = $user['image'];
            } 
        
		$result = $this->user_model->checkemail($this->session->userdata('login_id'));
		if ($result) {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email already exists.']));
			return FALSE;
		} else {
            $register = $this->user_model->updatProfile($image);
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
        $config['file_name'] = rand();
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
         $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("home"), 'msg' => 'Login Success']));
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
