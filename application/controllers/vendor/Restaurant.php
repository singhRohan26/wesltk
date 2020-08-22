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

	public function restaurantProduct(){
		$data['title'] = "Restaurant Product";
		$data['userData'] = $this->getLoginDetail();
		$data['products'] = $this->restaurant_model->getProductData();
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/restaurant/restaurantProduct');
		$this->load->view('vendor/commons/footer');
	}
	public function addRestaurantProduct($id = null){
		$data['title'] = "Add Restaurant Product";
		$data['userData'] = $this->getLoginDetail();
		if(!empty($id)){
			$data['product'] = $this->restaurant_model->getProductDataById($id);
			if(empty($data['product'])){
				redirect(base_url('vendor/restaurant-product'));
			}
			$data['product_image'] = $this->restaurant_model->getProductImageByProductId($id);
		}
		$data['menus'] = $this->restaurant_model->getMenuData();
		$this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/restaurant/addRestaurantProduct');
		$this->load->view('vendor/commons/footer');
	}


	private function doUploadMultiImage($id = null) {
        $this->load->library('upload');
        $count = count($_FILES['image_url']['size']);
        $this->session->unset_userdata('image_url');
        if(empty($_FILES['image_url']['name'][0]) && empty($id)){
            $this->session->set_userdata('image_url', array('image_url' => 'Please Upload Image'));
            return false;
        }
        $image = [];
        $ext = array('png', 'jpg', 'jpeg');
        $i = 1;
        if(!empty($_FILES['image_url']['name'][0]) || empty($id)){
	        foreach ($_FILES as $key => $value) {
	            for ($s = 0; $s < $count; $s++) {
	                $ext1 = strtolower(pathinfo($value['name'][$s], PATHINFO_EXTENSION));
	                if(in_array($ext1, $ext)){
	                    $maxsize    = 2097152;
	                    if(($value['size'][$s] >= $maxsize) || ($value['size'][$s] == 0)) {
	                        $this->session->set_userdata('image_url', array('image_url' => 'File too large. File must be less than 2 megabytes.'));
	                        return false; 
	                    }
	                    $image[$s]['file_name'] = rand(1, 9999).'.'.$ext1;
	                    $image[$s]['tmp_name'] = $value['tmp_name'][$s];
	                }else{
	                   $this->session->set_userdata('image_url', array('image_url' => 'Invalid file type. Only JPG, JPEG and PNG types are accepted.'));
	                   return false; 
	                }
	            }
	        }
	    }
        return $image;
    }

	public function doAddProduct(){
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('menu', 'menu', 'required');
		$this->form_validation->set_rules('name', 'Item Name', 'required');
		$this->form_validation->set_rules('price', 'Item Price', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		// $exist = $this->admin_model->checkDuplicateProductData();
		// if($exist){
		// 	$this->output->set_output(json_encode(['result' => 0, 'errors' => ['product_name' =>'This Product Name already Taken!..']]));
		// 	return FALSE;
		// }
		$img_res = $this->doUploadMultiImage();
		if($img_res){
	 		foreach ($img_res as $res) {
	    		move_uploaded_file($res['tmp_name'], './uploads/product_image/'. $res['file_name']);
	    	}
	    }else{
	    	$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('image_url')]));
            return FALSE;
	    }
		$result = $this->restaurant_model->doAddProduct($img_res);
		if ($result) {
			$this->output->set_output(json_encode(['result' => 1, 'url' => base_url("vendor/restaurant-product"), 'msg' => 'Product Added Successfully!!..']));
			return FALSE;
		} else {
			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!!..']));
			return FALSE;
		}
	}
	public function doEditProduct($id){
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('menu', 'menu', 'required');
		$this->form_validation->set_rules('name', 'Item Name', 'required');
		$this->form_validation->set_rules('price', 'Item Price', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		// $exist = $this->admin_model->checkDuplicateProductData($id);
		// if($exist){
		// 	$this->output->set_output(json_encode(['result' => 0, 'errors' => ['product_name' =>'This Product Name already Taken!..']]));
		// 	return FALSE;
		// }
		$img_res = $this->doUploadMultiImage($id);
		if($img_res){
	 		foreach ($img_res as $res) {
	    		move_uploaded_file($res['tmp_name'], './uploads/product_image/'. $res['file_name']);
	    	}
	    }else{
	    	if(!empty($this->session->userdata('image_url'))){
		    	$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('image_url')]));
	            return FALSE;
	        }
	    }	
		$result = $this->restaurant_model->doEditProduct($id, $img_res);
		if ($result) {
			$this->output->set_output(json_encode(['result' => 1, 'url' => base_url("vendor/restaurant-product"), 'msg' => 'Product Updated Successfully!!..']));
			return FALSE;
		} else {
			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!!..']));
			return FALSE;
		}
	}

	public function deleteRestaurantProductImage($id){
		$this->output->set_content_type('application/json');
		$img = $this->restaurant_model->getProductImageById($id);
		if($img){
			unlink('uploads/product_image/'.$img['image']);
		}
		$this->restaurant_model->deleteProductImageById($id);
		$this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Product Deleted Successfully!!..']));
		return FALSE;
	}
	
}
