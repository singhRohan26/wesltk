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
        // $this->load->view('front/commons/navbar');
        $this->load->view('front/index');
        $this->load->view('front/commons/footer');
    }
    
        
    public function cart(){
        $data['title'] = 'Cart';
        $data['userData'] = $this->getLoginDetail();
        $this->session->set_userdata('booking','booking');
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
    
    public function offers(){
        $data['title'] = 'Offers';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('offer');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/offer');
        $this->load->view('front/commons/footer');
    }
    
    public function terms(){
        $data['title'] = 'Terms and conditions';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('term');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/terms');
        $this->load->view('front/commons/footer');
    }
    
    public function whyus(){
        $data['title'] = 'whyus';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('whyus');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/terms');
        $this->load->view('front/commons/footer');
    }
    
    public function cancellation(){
        $data['title'] = 'Cancellation policy';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('cancellation');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/terms');
        $this->load->view('front/commons/footer');
    }
    public function contactUs(){
        $data['title'] = 'Contact us';
        $data['userData'] = $this->getLoginDetail();
        $data['about_data'] = $this->home_model->getPagesData('privacy');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/contact-us');
        $this->load->view('front/commons/footer');
    }
    
    public function career(){
        $data['title'] = 'Career with us';
        $data['userData'] = $this->getLoginDetail();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/career');
        $this->load->view('front/commons/footer');
    }
    
    public function doAddCareer(){
      $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', ' Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', ' Phone Number', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $result = $this->home_model->doAddCareer();
        if($result){
          $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('/'), 'msg' => 'Thankyou for the details']));
                return FALSE;  
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
        }
    }
    
    private function is_login(){
		return $this->session->userdata('login_id');
	}
    
    private function getLoginDetail(){
		$login_id = $this->session->userdata('login_id');
		return $this->user_model->getLoginDetail($login_id);
	}
    
    public function doContactUs(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', ' Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', ' Phone Number', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('msg', 'Message', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $result = $this->home_model->doContactUs();
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('/'), 'msg' => 'Message sent Successfully!..']));
                return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
        }
    } 


    private function uniqueId() {
        $str = '123456789';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 8);
        return $unique_id;
    }

    public function bookService(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('full_name_ser', 'Name', 'required');
        $this->form_validation->set_rules('email_sir', ' Email', 'required|valid_email');
        $this->form_validation->set_rules('phone_no_ser', ' Phone Number', 'required');
        $this->form_validation->set_rules('date_ser', 'Date', 'required');
        $this->form_validation->set_rules('time_ser', 'Time', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $unique_id = $this->uniqueId();
        $user_id = $this->getLoginDetail()['user_id'];
        $product_detail = $this->home_model->getLoginDetailBySalonProductId($this->input->post('product_id'));
        $vendor_id = $product_detail['vendor_id'];
        $total = $product_detail['price'];
        $data[] = array(
            'product_id' => $this->input->post('product_id'),
            'qty' => 1,
            'price'=>$total,
            'unique_id'=>$unique_id
            );
        $result = $this->home_model->doBookService();
        $this->home_model->order($unique_id,$vendor_id,$user_id,$total, $result);
        $this->home_model->order_details($data);
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Service Booked Successfully!..', 'swal' => 'true']));
                return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
        }
    }
    public function bookCatringService(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('full_name_ser', 'Name', 'required');
        $this->form_validation->set_rules('email_sir', ' Email', 'required|valid_email');
        $this->form_validation->set_rules('phone_no_ser', ' Phone Number', 'required');
        $this->form_validation->set_rules('date_ser', 'Date', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $user_id = $this->getLoginDetail()['user_id'];
        $result = $this->home_model->doBookCatringService($user_id);
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'url' => $_SERVER['HTTP_REFERER'], 'msg' => 'Catring Booked Successfully!..', 'swal' => 'true']));
                return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong!..']));
                return FALSE;
        }
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
    public function salonLists(){
        $data['title'] = 'Restaurant List';
        $data['userData'] = $this->getLoginDetail();
        $data['menus'] = $this->home_model->getAdminSalonMenu();
        $data['about_data'] = $this->home_model->getPagesData('privacy');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/salon/salon-list');
        $this->load->view('front/commons/footer');
    }
    public function catringLists(){
        $data['title'] = 'Restaurant List';
        $data['userData'] = $this->getLoginDetail();
        $data['menus'] = $this->home_model->getAdminSalonMenu();
        $data['about_data'] = $this->home_model->getPagesData('privacy');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/catring/catring-list');
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
    public function salonWrapper(){
        $this->output->set_content_type('application/json');
        $checked_val = $this->input->post('checked_val');
        $data_id = $this->input->post('data_id');
        $data['restaurants'] = $this->home_model->getsalons($checked_val, 'salon');
        $wrapper = $this->load->view('front/wrapper/salon-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper, 'count_wrapper' => '('.count($data['restaurants']).')']));
        return FALSE;
    }
    public function catringWrapper(){
        $this->output->set_content_type('application/json');
        $checked_val = $this->input->post('checked_val');
        $data_id = $this->input->post('data_id');
        $data['restaurants'] = $this->home_model->getsalons($checked_val, 'catring');
        $wrapper = $this->load->view('front/wrapper/catring-list', $data, true);
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
    public function search_salon(){
        $this->output->set_content_type('application/json');
        $search = $this->input->post('key_search');
        $checked_val = $this->input->post('checked_val');
        $data_id = $this->input->post('data_id');
        $data['restaurants'] = $this->home_model->searchRestaurants($search, $checked_val);
        $wrapper = $this->load->view('front/wrapper/salon-list', $data, true);
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
    public function salon_details($restaurant_name){
        $data['title'] = 'Restaurant List';
        $restaurant_name = str_replace('-', ' ', $restaurant_name);
        $data['userData'] = $this->getLoginDetail();
        $data['restaurant'] = $this->home_model->getSalonDataByName($restaurant_name, 'salon');
//        print_r($data['restaurant']);die;
        if(empty($data['restaurant'])){
            redirect(base_url('salon'));
        }
        $data['menus'] = $this->home_model->getSalonMenuData($data['restaurant']['vendor_id'], 'salon');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/salon/salon-detail');
        $this->load->view('front/commons/footer');
    }
    public function catring_details($restaurant_name){
        $data['title'] = 'Restaurant List';
        $restaurant_name = str_replace('-', ' ', $restaurant_name);
        $data['userData'] = $this->getLoginDetail();
        $data['restaurant'] = $this->home_model->getSalonDataByName($restaurant_name, 'catring');
        if(empty($data['restaurant'])){
            redirect(base_url('catring'));
        }
        $data['menus'] = $this->home_model->getSalonMenuData($data['restaurant']['vendor_id'], 'catring');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/catring/catring-detail');
        $this->load->view('front/commons/footer');
    }
    public function catring_detail($p_id){
        $data['title'] = 'Restaurant List';
        $data['userData'] = $this->getLoginDetail();
        $data['restaurant'] = $this->home_model->getCatringDetailById($p_id, 'catring');
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/navbar');
        $this->load->view('front/catring/catring-details');
        $this->load->view('front/commons/footer');
    }

    public function product_listing($vendor_id){
        $this->output->set_content_type('application/json');
        $veg_type = $this->input->post('veg_type');
        $cat_type = $this->input->post('cat_type');
        $data['products'] = $this->home_model->getProducts($veg_type, $cat_type, $vendor_id);
//        print_r($data['products']);die;
        $wrapper = $this->load->view('front/wrapper/product-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;
    }
    public function salon_listing($vendor_id){
        $this->output->set_content_type('application/json');
        $cat_type = $this->input->post('cat_type');
        $data['products'] = $this->home_model->getSalonProduct($cat_type, $vendor_id, 'salon');
//        print_r($data['products']);die;
        $wrapper = $this->load->view('front/wrapper/salon-product-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;
    }
    public function catring_listing($vendor_id){
        $this->output->set_content_type('application/json');
        $cat_type = $this->input->post('cat_type');
        $data['products'] = $this->home_model->getSalonProduct($cat_type, $vendor_id, 'catring');
//        print_r($data['products']);die;
        $wrapper = $this->load->view('front/wrapper/catring-product-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;
    }
    public function catring_inner_listing($p_id){
        $this->output->set_content_type('application/json');
        $data['products'] = $this->home_model->getSalonProductByProductId($p_id, 'catring');
//        print_r($data['products']);die;
        $wrapper = $this->load->view('front/wrapper/catring-inner-list', $data, true);
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
    public function salon_product($vendor_id){
        $this->output->set_content_type('application/json');
        $key_search = $this->input->post('key_search');
        $cat_type = $this->input->post('cat_type');
        $data['products'] = $this->home_model->getSalonProductSearch($key_search, $cat_type, $vendor_id, 'salon');
        $wrapper = $this->load->view('front/wrapper/salon-product-list', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;
    }
    public function catring_product($vendor_id){
        $this->output->set_content_type('application/json');
        $key_search = $this->input->post('key_search');
        $cat_type = $this->input->post('cat_type');
        $data['products'] = $this->home_model->getSalonProductSearch($key_search, $cat_type, $vendor_id, 'catring');
        $wrapper = $this->load->view('front/wrapper/catring-product-list', $data, true);
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
    public function product_img($vendor_id,$type){
        $this->output->set_content_type('application/json');
//        $veg_type = $this->input->post('veg_type');
//        $cat_type = $this->input->post('cat_type');
        
        $data['reviews'] = "true";
        $data['product_images'] = $this->home_model->getProductImages($vendor_id,$type);
//        print_r($data['product_images']);die;
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
    
    public function shop_product_img($vendor_id,$type){
      $this->output->set_content_type('application/json');
        
        $data['reviews'] = "true";
        $data['product_images'] = $this->home_model->getShopProductImages($vendor_id,$type);
//        print_r($data['product_images']);die;
        $wrapper = $this->load->view('front/wrapper/restaurant-img', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;  
    }
    
    public function saloon_product_img($vendor_id,$type){
       $this->output->set_content_type('application/json');
        
        $data['reviews'] = "true";
        $data['product_images'] = $this->home_model->getSaloonProductImages($vendor_id,$type);
//        print_r($data['product_images']);die;
        $wrapper = $this->load->view('front/wrapper/shop-img', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'wrapper' => $wrapper]));
        return FALSE;   
    }
    
    
//Add to cart section
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
        $content_wrapper = $this->load->view('front/wrapper/cart-wrapper', $data, TRUE);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    
	
}
