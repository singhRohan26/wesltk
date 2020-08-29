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
    
    //PRODUCT SECTION
    public function productsLists(){
        $data['title'] = 'Products List';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('privacy');
        $data['menus'] = $this->home_model->getProductMenu();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/products/products-list');
        $this->load->view('front/commons/footer');
    }
    
    public function productWrapper(){
        $this->output->set_content_type('application/json');
        $checked_val = $this->input->post('checked_val');
        $data_id = $this->input->post('data_id');
        $data['products'] = $this->home_model->getShopProducts($checked_val);
//        print_r($data['products']);die;
        $wrapper = $this->load->view('front/product-wrapper/product-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper, 'count_wrapper' => '('.count($data['products']).')']));
        return FALSE;
    }
    
    public function shopDetails($restaurant_name){
        $data['title'] = 'Product Details';
        $restaurant_name = str_replace('-', ' ', $restaurant_name);
        $data['userData'] = $this->getLoginDetail();
        $data['shop'] = $this->home_model->getProductDataByName($restaurant_name);
        if(empty($data['shop'])){
            redirect(base_url('home/products-shops'));
        }
        $data['menus'] = $this->home_model->getProductMenuData($data['shop']['vendor_id']);
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/products/product-details');
        $this->load->view('front/commons/footer');
    }
    
    public function shopProductListing($vendor_id){
        $this->output->set_content_type('application/json');
//        $veg_type = $this->input->post('veg_type');
        $cat_type = $this->input->post('cat_type');
        $data['products'] = $this->home_model->getShopProductLists($vendor_id,$cat_type);
//        print_r($data['products']);die;
        $wrapper = $this->load->view('front/product-wrapper/product-list-details', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;
    }
    
    

       public function addToCart($product_id) {
            $this->output->set_content_type('application/json');
            $quantity = $this->input->post('qty');
            $product_data = $this->home_model->getProductDataById($product_id);
            if(!empty($product_data['menu_id'])){
                $vendor_id = $this->home_model->getVenodrIdByResturantMenu($product_data['menu_id']);
                $type = "resturant";
            }else if (!empty($product_data['menu_product_id'])) {
                $vendor_id = $this->home_model->getVenodrIdByProductMenu($product_data['menu_product_id']);
                $type = "product";
            }
            if(!empty($this->cart->contents())) {
                foreach($this->cart->contents() as $cart){
                    if(!empty($this->input->post('minus'))){
                        $quantity = -1;
                        $this->cart->update(['rowid' => $cart['rowid'], 'qty' => 0]);
                        return false;
                    }else{
                        $quantity = 1;
                    }
                    if($cart['type'] != $type){
                        $this->output->set_output(json_encode(['result' => -1, 'msg' => "You cannot add two different type at a time",'url' => $_SERVER['HTTP_REFERER']]));
                         return FALSE; 
                    }if($cart['vendor_id'] != $vendor_id){
                        $this->output->set_output(json_encode(['result' => -1, 'msg' => "You cannot add two different vendor at a time",'url' => $_SERVER['HTTP_REFERER']]));
                         return FALSE; 
                    }
                }
            }
            $product_img = $this->home_model->getProductImageById($product_id);
            $data = array(
                    'id' => $product_id,
                    'type' => $type,
                    'vendor_id' => $vendor_id,
                    'qty' => $quantity,
                    'price' => $product_data['price'],
                    'name' => $this->strimSpecialCharacter($product_data['name']),
                    'product_name' => $product_data['name'],
                    'image' => $product_img['image']
                );
            $this->cart->insert($data);
            $this->output->set_output(json_encode(['result' => 1]));
            return FALSE;  
        }


    private function strimSpecialCharacter($variable){
         $trimed = preg_replace('/[^A-Za-z0-9\-]/', ' ', $variable);
         return $trimed;
     }
    
     public function cart_content_wrapper() {
        $this->output->set_content_type('application/json');
        $data['true'] = "1";
//        $data['tax_data'] = $this->home_model->getTaxData();
        $content_wrapper = $this->load->view('front/wrapper/cart-wrapper', $data, TRUE);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
	
}
