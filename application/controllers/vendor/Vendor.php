<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	/**
	 * vendor  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('vendor_model');
	}


	public function index()
	{
//		if(!empty($this->is_login())){
//			redirect(base_url('vendor/dashboard'));
//		}
		$data['title'] = "vendor Panel";
		$this->load->view('vendor/login', $data);
	}
    
    public function forgotpassword(){
        $data['title'] = "Forgot Password";
		$this->load->view('vendor/forgot-password', $data);
    }
    
    public function doLogin(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->vendor_model->checkLogin();
		if ($result) {
			$this->session->set_userdata('vendor_login_id', $result['vendor_id']);
			$this->output->set_output(json_encode(['result' => 1, 'url' => base_url("vendor/dashboard"), 'msg' => 'Loading..']));
			return FALSE;
		} else {
			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username or password']));
			return FALSE;
		}
    }
    
    private function is_login(){
		return $this->session->userdata('vendor_login_id');
	}
    
    private function getLoginDetail(){
		$vendor_login_id = $this->session->userdata('vendor_login_id');
		return $this->vendor_model->getLoginDetail($vendor_login_id);
	}
    
    public function dashboard(){
        if(empty($this->is_login())){
			redirect(base_url('vendor'));
		}
		$data['title'] = "Dashboard";
		$data['userData'] = $this->getLoginDetail();		
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/index');
		$this->load->view('vendor/commons/footer');
    }
    
    public function doForgotPassword(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        $email = $this->security->xss_clean($this->input->post('email'));
        $checkEmail = $this->vendor_model->checkEmail();
        if($checkEmail){
        $password = substr(md5(uniqid()), 0, 6);
        $this->send_forgot_password_link($email,$password);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("vendor"), 'msg' => 'Password has been sent To your Mail Id..']));
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
        $htmlContent = "<div>Hi vendor,</div>";
        $htmlContent .= "<div style='padding-top:8px;'>Your new password is ".$password."</div>";
        $this->email->to($email);
        $this->email->from('info@vendor.com', 'vendor');
        $this->email->subject('Forgot Password?');
        $this->email->message($htmlContent);
        $this->email->send();
        return true;
    }
    
    public function logout(){
        $this->session->unset_userdata('vendor_login_id');
		redirect(base_url('vendor'));
    }
    
    public function changePassword(){
        if(empty($this->is_login())){
			redirect(base_url('vendor'));
		}
		$data['title'] = "Change Password";
		$data['userData'] = $this->getLoginDetail();		
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/change_password');
		$this->load->view('vendor/commons/footer');
    }
    
    public function doChangePass(){
		if(empty($this->is_login())){
			redirect(base_url('vendor'));
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
		if(strtolower($userData['password']) != $this->security->xss_clean(hash('sha256', $this->input->post('opass')))){
			$err['opass'] = 'Old Password is incorrect';
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $err]));
			return FALSE;
		}
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->vendor_model->doChangePass();
		if ($result) {
			$this->output->set_output(json_encode(['result' => 1, 'url' => base_url("vendor/change-password"), 'msg' => 'Password Changed Successfully..']));
			return FALSE;
		} else {
			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'Old Password and new password should not be same']));
			return FALSE;
		}
	}
    
    public function editProfile(){
        if(empty($this->is_login())){
			redirect(base_url('vendor'));
		}
		$data['title'] = "edit profile";
		$id = $this->session->userdata('vendor_login_id');
		$data['profileData'] = $this->vendor_model->edit_profile($id);
		$data['userData'] = $this->getLoginDetail();
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/edit-profile');
		$this->load->view('vendor/commons/footer');
    }
    
    public function doChangeProfile($id){
        if(empty($this->is_login())){
			redirect(base_url('vendor'));
		}
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('vendor_name','vendor name','trim|required');
		$this->form_validation->set_rules('email_id','Email','required|valid_email');
		$this->form_validation->set_rules('phone','Phone Number','required');
		$this->form_validation->set_rules('amount','Minimum amount','required');
		$this->form_validation->set_rules('time','Delivery Time','required');
		$this->form_validation->set_rules('hours','Working Hours','required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        $data['userData'] = $this->getLoginDetail();
        if(!empty($_FILES['image_url']['name'])){
            $file1=$this->doUploadProfileImage('image_url');
        }if(empty($_FILES['image_url']['name'])){
            $file1=$data['userData']['image'];
        }
		 
        $result = $this->vendor_model->doChangeProfile($id,$file1);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Profile Changed successfully!!.', 'url' => base_url('vendor/edit-profile/')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made!!.']));
            return FALSE;
        }
    }
    
    public function doUploadProfileImage($file){
        $file1 = $_FILES[$file]['name'];
        $config['upload_path'] = './uploads/vendor/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
       // $config['max_filename'] = '2555';
        $config['file_name'] = rand();
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $upload_data = $this->upload->data();
        return $upload_data['file_name'];
        
    }
    
    public function pages($page_id){
        if(empty($this->is_login())){
			redirect(base_url('vendor'));
		}
		$data['pages_side'] = "true";
		$data['title'] = ucwords($page_id);
		$data['userData'] = $this->getLoginDetail();
		$data['page_data'] = $this->vendor_model->getPageDataByPageId($page_id);
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/pages/pages');
		$this->load->view('vendor/commons/footer');
    }
    
    public function doupdateContent($page_id){
    	if(empty($this->is_login())){
			redirect(base_url('vendor'));
		}
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('page_name', 'Content', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->vendor_model->doupdateContent($page_id);
		if ($result) {
			$this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Data Updated successfully!!..']));
			return FALSE;
		} else {
			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes Were Made!']));
			return FALSE;
		}
    }
    
    public function deliveryBoy(){
        if(empty($this->is_login())){
			redirect(base_url('vendor'));
		}
		$data['title'] = 'Delivery Boy';
		$data['userData'] = $this->getLoginDetail();
        $data['boys'] = $this->vendor_model->getDeliveryBoys($data['userData']['vendor_id']);
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/delivery/list');
		$this->load->view('vendor/commons/footer');
        
    }
    
    public function addDeliveryBoy($id = null){
        if(empty($this->is_login())){
			redirect(base_url('vendor'));
		}
		$data['title'] = 'Delivery Boy';
		$data['userData'] = $this->getLoginDetail();
        if(!empty($id)){
			$data['delivery'] = $this->vendor_model->getDeliveryBoyById($id);
			if(empty($data['delivery'])){
				redirect(base_url('vendor/delivery-boy'));
			}
			
		}
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/delivery/add-boy');
		$this->load->view('vendor/commons/footer');
    }
    
    public function doAddDeliveryBoy(){
       $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        $data['userData'] = $this->getLoginDetail();
        $result = $this->vendor_model->doAddDeliveryBoy($data['userData']['vendor_id']);
        if($result){
           $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('vendor/delivery-boy'), 'msg' => 'Delivery boy added']));
			return FALSE; 
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes Were Made!']));
			return FALSE;
        }
        
    }
    
    public function doEditDeliveryBoy($id){
      $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
        
        $result = $this->vendor_model->doEditDeliveryBoy($id);
        if($result){
           $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('vendor/delivery-boy'), 'msg' => 'Delivery boy updated']));
			return FALSE; 
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes Were Made!']));
			return FALSE;
        }  
        
    }
    
    public function deleteBoy($id){
        $result = $this->vendor_model->deleteBoy($id);
        if($result){
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('vendor/delivery-boy'), 'msg' => 'Delivery boy deleted']));
			return FALSE; 
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes Were Made!']));
			return FALSE;
        }  
    }
    
    public function orderLists(){
        if(empty($this->is_login())){
			redirect(base_url('vendor'));
		}
		$data['title'] = 'Order List';
		$data['userData'] = $this->getLoginDetail();
        $data['boys'] = $this->vendor_model->getDeliveryBoys($data['userData']['vendor_id']);
        $data['orders'] = $this->vendor_model->orderListByVendorId($data['userData']['vendor_id']);
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/order/order-list');
		$this->load->view('vendor/commons/footer');
        
    }
    
    public function changeOrderStatus($unique_id){
        $status = $this->input->post('status');
        $result = $this->vendor_model->changeOrderStatus($unique_id,$status);
        if ($result) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Status updated sucessfully!!', 'url' => base_url('vendor/order-lists')]));
        return FALSE;
    } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Try Again']));
            return FALSE;
        }
    }
    
    public function assignDeliveryBoy($unique_id){
        $id = $this->input->post('delivery_id');
        $result = $this->vendor_model->assignDeliveryBoy($unique_id,$id);
        if ($result) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Status updated sucessfully!!', 'url' => base_url('vendor/order-lists')]));
        return FALSE;
    } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Try Again']));
            return FALSE;
        }
        
    }
    

    
    
    
    

	
}
