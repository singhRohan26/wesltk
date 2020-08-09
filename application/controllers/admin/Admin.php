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
    
    public function forgotpassword(){
        $data['title'] = "Forgot Password";
		$this->load->view('admin/forgot-password', $data);
    }
    
    public function doLogin(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->admin_model->checkLogin();
		if ($result) {
			$this->session->set_userdata('login_id', $result['id']);
			$this->output->set_output(json_encode(['result' => 1, 'url' => base_url("admin/dashboard"), 'msg' => 'Loading..']));
			return FALSE;
		} else {
			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username or password']));
			return FALSE;
		}
    }
    
    private function is_login(){
		return $this->session->userdata('login_id');
	}
    
    private function getLoginDetail(){
		$login_id = $this->session->userdata('login_id');
		return $this->admin_model->getLoginDetail($login_id);
	}
    
    public function dashboard(){
        if(empty($this->is_login())){
			redirect(base_url('admin'));
		}
		$data['title'] = "Dashboard";
		$data['userData'] = $this->getLoginDetail();		
		$this->load->view('admin/commons/header', $data);
		$this->load->view('admin/commons/sidebar');
		$this->load->view('admin/index');
		$this->load->view('admin/commons/footer');
    }
    
    public function doForgotPassword(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        $email = $this->security->xss_clean($this->input->post('email'));
        $checkEmail = $this->admin_model->checkEmail();
        if($checkEmail){
        $password = substr(md5(uniqid()), 0, 6);
        $this->send_forgot_password_link($email,$password);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("admin"), 'msg' => 'Password has been sent To your Mail Id..']));
			return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'This E-mail id does not exist']));
			return FALSE;
        }
        
    }
    
    public function send_forgot_password_link($email,$password){
        $config = array(
            'mailtype' => 'html',
        );
        $this->load->library('email',$config);
        $htmlContent = "<div>Hi Admin,</div>";
        $htmlContent .= "<div style='padding-top:8px;'>Your new password is ".$password."</div>";
        $this->email->to($email);
        $this->email->from('info@admin.com', 'Admin');
        $this->email->subject('Forgot Password?');
        $this->email->message($htmlContent);
        $this->email->send();
        return true;
    }
    
    public function logout(){
        $this->session->unset_userdata('login_id');
		redirect(base_url('admin'));
    }
    
    public function changePassword(){
        if(empty($this->is_login())){
			redirect(base_url('admin'));
		}
		$data['title'] = "Change Password";
		$data['userData'] = $this->getLoginDetail();		
		$this->load->view('admin/commons/header', $data);
		$this->load->view('admin/commons/sidebar');
		$this->load->view('admin/change_password');
		$this->load->view('admin/commons/footer');
    }
    
    public function doChangePass(){
		if(empty($this->is_login())){
			redirect(base_url('admin'));
		}
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('opass', 'Old Password', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$this->form_validation->set_rules('npass', 'New Password', 'required|min_length[6]');
		$this->form_validation->set_rules('cpass', 'Confirm Password', 'required|min_length[6]|matches[npass]');
		$userData = $this->getLoginDetail();
		// echo $userData['password']."<br>".$this->security->xss_clean(hash('sha256', $this->input->post('opass')));die;
		if(strtolower($userData['password']) != $this->security->xss_clean(hash('sha256', $this->input->post('opass')))){
			$err['opass'] = 'Old Password is incorrect';
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $err]));
			return FALSE;
		}
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->admin_model->doChangePass();
		if ($result) {
			$this->output->set_output(json_encode(['result' => 1, 'url' => base_url("admin"), 'msg' => 'Password Changed Successfully..']));
			return FALSE;
		} else {
			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'Old Password and new password should not be same']));
			return FALSE;
		}
	}
    
    public function editProfile(){
        if(empty($this->is_login())){
			redirect(base_url('admin'));
		}
		$data['title'] = "edit profile";
		$id = $this->session->userdata('login_id');
		$data['profileData'] = $this->admin_model->edit_profile($id);
		$data['userData'] = $this->getLoginDetail();
		$this->load->view('admin/commons/header', $data);
		$this->load->view('admin/commons/sidebar');
		$this->load->view('admin/edit-profile');
		$this->load->view('admin/commons/footer');
    }
    
    public function doChangeProfile($id){
        if(empty($this->is_login())){
			redirect(base_url('admin'));
		}
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('admin_name','admin name','trim|required');
		$this->form_validation->set_rules('email_id','Email','required|valid_email');
		$this->form_validation->set_rules('phone','Phone Number','required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		 
         $result = $this->admin_model->doChangeProfile($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Profile Changed successfully!!.', 'url' => base_url('admin/edit-profile/')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made!!.']));
            return FALSE;
        }
    }
    
    

	
}
