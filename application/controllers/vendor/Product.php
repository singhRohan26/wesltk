<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	/**
	 * vendor  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['product_model','vendor_model']);
	}
    
    private function getLoginDetail(){
		$vendor_login_id = $this->session->userdata('vendor_login_id');        
		return $this->vendor_model->getLoginDetail($vendor_login_id);
	}
    
    public function index(){
        $data['title'] = 'Product Lists';
        $data['userData'] = $this->getLoginDetail();
        $data['products'] = $this->product_model->getProducts();
        
        $this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/product/product-list');
		$this->load->view('vendor/commons/footer');
    }
    
    public function addProduct(){
        $data['title'] = 'Product Lists';
        $data['userData'] = $this->getLoginDetail();
        $data['category'] = $this->product_model->getProductCategory();
        $data['menus'] = $this->product_model->getMenu();
        $this->load->view('vendor/commons/header', $data);
		$this->load->view('vendor/commons/sidebar');
		$this->load->view('vendor/product/add-product');
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

	public function doAddShopProduct(){
		$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('product_menu', 'Product Category', 'required');
		$this->form_validation->set_rules('menu', 'Category', 'required');
		$this->form_validation->set_rules('name', 'Item Name', 'required');
		$this->form_validation->set_rules('price', 'Item Price', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		
		$img_res = $this->doUploadMultiImage();
		if($img_res){
	 		foreach ($img_res as $res) {
	    		move_uploaded_file($res['tmp_name'], './uploads/product_image/'. $res['file_name']);
	    	}
	    }else{
	    	$this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('image_url')]));
            return FALSE;
	    }
		$result = $this->product_model->doAddProduct($img_res);
		if ($result) {
			$this->output->set_output(json_encode(['result' => 1, 'url' => base_url("vendor/product-lists"), 'msg' => 'Product Added Successfully!!..']));
			return FALSE;
		} else {
			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!!..']));
			return FALSE;
		}
	}


    
    
    

	
}
