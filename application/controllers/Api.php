<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Home  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['api_model']);
	}
    
    
    public function login_registration(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('full_name','Full Name','trim|required');
        $this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
        $this->form_validation->set_rules('source', 'Source', 'trim|required');
        $source = $this->input->post('source');
        if($source === "self"){
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

        }
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $email = $this->security->xss_clean($this->input->post('email'));
        $already_register = $this->api_model->check_useraccount($email);
        if(!empty($already_register)){
            if (!empty($already_register['source'] !== 'self')) {
                if (!empty($already_register['status'] === 'Active')) {
                    $users_info = $this->api_model->get_userdata($already_register['user_id']);
                    if (!empty($users_info['image'])) {
                        $users_info['image'] = base_url('uploads/users-profile/' . $users_info['image']);
                    } else {
                        $users_info['image'] = 'NULL';
                    }
                    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login successfully!', 'data' => $users_info]));
                    return true;
                }
                else {
                    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'You are block by admin!']));
                    return false;
                }
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email address is already registered!']));
                return false;
            }
        } else {
            $registered = $this->api_model->user_register();
            if(!empty($registered)){
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Registration successfull!', 'data' => $registered]));
                return true;
            }else{
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something went wrong!']));
                return false; 
            }
        }
    }
    
    public function login(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');
        if($this->form_validation->run() === false){
            $this->output->set_output(json_encode(['result' =>0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $email = $this->security->xss_clean($this->input->post('email')); 
        $password = $this->security->xss_clean(hash('sha256', $this->input->post('password')));
        $results = $this->api_model->login($email,$password);
        if($results){
            if(!empty($results['image'])){
                $results['image'] = base_url('uploads/users-profile/' . $results['image']);

            }
            else{
                $results['image'] = null;
            }
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login successfully!', 'data' => $results]));
            return true;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email-address or Password is incorrect!!']));
            return false;

        }
    }
    
    public function changePassword(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id','User Id','trim|required');
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        } 
        $checked = $this->api_model->check_oldpassword();
        if(!empty($checked)){
            $this->form_validation->set_message('min_length', 'New password must be of 6 digits');
            $this->form_validation->set_message('matches', 'Password and confirm password must be same');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
            if ($this->form_validation->run() === false) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
                return false;
            }
            $results = $this->api_model->change_password($checked['user_id']);
            if ($results) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password changed successfully!']));
                return true;
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'New password should not be same as old password!']));
                return false;
            }
        }
        else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Incorrect old password']));
            return false;
        }
    }
    
    public function edit_profile(){
       $this->output->set_content_type('application/json');
       $this->form_validation->set_rules('user_id','User ID','trim|required');
       $this->form_validation->set_rules('full_name','Full Name','trim|required');
       $this->form_validation->set_rules('mobile_no','Phone Number','required|min_length[10]|max_length[10]');
       if ($this->form_validation->run() === false) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return false;
      }
    $user_id = $this->security->xss_clean($this->input->post('user_id'));
    if(!empty($_FILES['image']['name'])){
            $file1=$this->updateProfileImage('image');
    }
    else{
       $image = $this->api_model->get_userdata($user_id);
       $file1 = $image['image'];
   }
   $results = $this->api_model->edit_profile($user_id,$file1);
   if ($results) {
    if (!empty($results['image'])) {
        $results['image'] = base_url('uploads/users-profile/' . $results['image']);
    } else {
        $results['image'] = '';
    }
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Profile updated', 'data' => $results]));
    return TRUE;
   } else {
    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!']));
    return false;
  }

}
    /**
     * updateProfileImage using this function Upload Image!
     *
     * @return void
     */
    public function updateProfileImage($file){
        $file1 = $_FILES[$file]['name'];
        $config['upload_path'] = './uploads/users-profile/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
       // $config['max_filename'] = '2555';
        $config['file_name'] = rand();
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $upload_data = $this->upload->data();
        return $upload_data['file_name'];
        
    }

    


	
    
    

	
}
