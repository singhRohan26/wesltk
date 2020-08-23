<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Home  controller.
	 * Created By Rohan singh
	 
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('user_model');
	}


	public function index(){
        $data['title'] = 'Homepage';
        $data['userData'] = $this->getLoginDetail();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/index');
        $this->load->view('front/commons/footer');
    }
    
        
    public function cart(){
        $data['title'] = 'Cart';
        $data['userData'] = $this->getLoginDetail();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/cart/cart');
        $this->load->view('front/commons/footer');
    }
         
    public function becomePartner(){
       $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('vendor_name', 'Vendor Name', 'required');
        $this->form_validation->set_rules('vendor_email', 'Vendor Email', 'required|valid_email');
        $this->form_validation->set_rules('vendor_phone', 'Vendor Phone Number', 'required');
        $this->form_validation->set_rules('vendor_website', 'vendor website', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->user_model->checkVendorEmail();
        if ($result) {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Vendo Email already exists.']));
            return FALSE;
        } else {
            $register = $this->user_model->becomePartner();
            if($register){
                $this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Request Added Successfully!..']));
                return FALSE;
            }else{
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
            }
            
        }
    }   
    public function about(){
        $data['title'] = 'About';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('about');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/about');
        $this->load->view('front/commons/footer');
    }
           
    public function privacy_policy(){
        $data['title'] = 'privacy-policy';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('privacy');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/about');
        $this->load->view('front/commons/footer');
    }
    
    private function is_login(){
		return $this->session->userdata('login_id');
	}
    
    private function getLoginDetail(){
		$login_id = $this->session->userdata('login_id');
		return $this->user_model->getLoginDetail($login_id);
	}
    
    public function restaurantsLists(){
        $data['title'] = 'Restaurant List';
        $data['userData'] = $this->getLoginDetail();
        $data['menus'] = $this->home_model->getAdminMenu();
        $data['about_data'] = $this->home_model->getPagesData('privacy');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/restaurant/restaurant-list');
        $this->load->view('front/commons/footer');
    }

    public function restaurantWrapper(){
        $this->output->set_content_type('application/json');
        $checked_val = $this->input->post('checked_val');
        $data_id = $this->input->post('data_id');
        $data['restaurants'] = $this->home_model->getRestaurants($checked_val);
        $wrapper = $this->load->view('front/wrapper/restaurant-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper, 'count_wrapper' => '('.count($data['restaurants']).')']));
        return FALSE;
    }
    public function search_restaurant(){
        $this->output->set_content_type('application/json');
        $search = $this->input->post('key_search');
        $checked_val = $this->input->post('checked_val');
        $data_id = $this->input->post('data_id');
        $data['restaurants'] = $this->home_model->searchRestaurants($search, $checked_val);
        $wrapper = $this->load->view('front/wrapper/restaurant-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper, 'count_wrapper' => '('.count($data['restaurants']).')']));
        return FALSE;
    }

    public function restaurant_details($restaurant_name){
        $data['title'] = 'Restaurant List';
        $restaurant_name = str_replace('-', ' ', $restaurant_name);
        $data['userData'] = $this->getLoginDetail();
        $data['restaurant'] = $this->home_model->getRestaurantDataByName($restaurant_name);
        if(empty($data['restaurant'])){
            redirect(base_url('home/restaurant-lists'));
        }
        $data['menus'] = $this->home_model->getRestaurantMenuData($data['restaurant']['vendor_id']);
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/restaurant/restaurant-detail');
        $this->load->view('front/commons/footer');
    }

    public function product_listing($vendor_id){
        $this->output->set_content_type('application/json');
        $veg_type = $this->input->post('veg_type');
        $cat_type = $this->input->post('cat_type');
        $data['products'] = $this->home_model->getProducts($veg_type, $cat_type, $vendor_id);
        $wrapper = $this->load->view('front/wrapper/product-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;
    }
    public function search_product($vendor_id){
        $this->output->set_content_type('application/json');
        $key_search = $this->input->post('key_search');
        $veg_type = $this->input->post('veg_type');
        $cat_type = $this->input->post('cat_type');
        $data['products'] = $this->home_model->getProductSearch($key_search, $veg_type, $cat_type, $vendor_id);
        $wrapper = $this->load->view('front/wrapper/product-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;
    }
    public function review_listing($vendor_id){
        $this->output->set_content_type('application/json');
        $veg_type = $this->input->post('veg_type');
        $cat_type = $this->input->post('cat_type');
        $data['reviews'] = "true";
        // $data['products'] = $this->home_model->getProducts($veg_type, $cat_type, $vendor_id);
        $wrapper = $this->load->view('front/wrapper/restaurant-reviews', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;
    }
    public function product_img($vendor_id){
        $this->output->set_content_type('application/json');
        $veg_type = $this->input->post('veg_type');
        $cat_type = $this->input->post('cat_type');
        $data['reviews'] = "true";
        $data['product_images'] = $this->home_model->getProductImages($vendor_id);
        $wrapper = $this->load->view('front/wrapper/restaurant-img', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;
    }

	
}
