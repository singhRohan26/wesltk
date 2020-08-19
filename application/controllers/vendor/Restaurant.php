<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant extends CI_Controller {

	/**
	 * vendor  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['restaurant_model', 'vendor_model']);
	}

	private function getLoginDetail(){
		$vendor_login_id = $this->session->userdata('vendor_login_id');
		return $this->vendor_model->getLoginDetail($vendor_login_id);
	}

	public function index($id = null)
	{
		$data['title'] = "Restaurant Menu";
		$data['userData'] = $this->getLoginDetail();
		$data['menus'] = $this->restaurant_model->getMenuData();
		if(!empty($id)){
			$data['menu_data'] = $this->restaurant_model->getMenuDataById($id);
			if(empty($data['menu_data'])){
				redirect(base_url('vendor/restaurant-menu'));
			}
		}		
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/restaurant/menu');
		$this->load->view('vendor/commons/footer');
	}
    
	public function addRestaurantMenu(){
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('name', 'Name', 'required|is_unique[menu_restaurant.name]');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
  //       $checkEmail = $this->vendor_model->checkMenu();
  //       if ($this->form_validation->run() === FALSE) {
		// 	$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
		// 	return FALSE;
		// }
		$result = $this->restaurant_model->doAddRestaurantMenu();
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("vendor/restaurant-menu"), 'msg' => 'Menu Added Successfully..']));
			return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!!...']));
			return FALSE;
        }
	}       
	public function editRestaurantMenu($id){
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
  //       $checkEmail = $this->vendor_model->checkMenu();
  //       if ($this->form_validation->run() === FALSE) {
		// 	$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
		// 	return FALSE;
		// }
		$result = $this->restaurant_model->doEditRestaurantMenu($id);
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("vendor/restaurant-menu"), 'msg' => 'Menu Updated Successfully..']));
			return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made!!...']));
			return FALSE;
        }
	}         
	public function delete_restaurant_menu($id){
		$this->output->set_content_type('application/json');
		$result = $this->restaurant_model->doDeleteRestaurantMenu($id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url("vendor/restaurant-menu"), 'msg' => 'Menu Updated Successfully..']));
		return FALSE;
	}    

	
}
