<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

///   home Controlller ////
$route['home/your-cart'] = 'home/cart';
$route['salon'] = 'home/salonLists';
$route['catring'] = 'home/catringLists';
$route['becomePartner'] = 'home/becomePartner';
$route['addToCart/(:any)'] = 'home/addToCart/$1';
$route['about'] = 'home/about';
$route['restaurant-details/(:any)'] = 'home/restaurant-details/$1';
$route['catring-detail/(:any)'] = 'home/catring-detail/$1';
$route['salon-details/(:any)'] = 'home/salon-details/$1';
$route['catring-details/(:any)'] = 'home/catring-details/$1';
$route['home/product-listing/(:any)'] = 'home/product-listing/$1';
$route['privacy-policy'] = 'home/privacy_policy';
$route['home/user-registration'] = 'user/doRegistration';
$route['home/restaurant-lists'] = 'home/restaurantsLists';
$route['home/products-shops'] = 'home/productsLists';
$route['shop-details/(:any)'] = 'home/shopDetails/$1';
$route['home/shop-product-listing/(:any)'] = 'home/shopProductListing/$1';
$route['home/contact-us'] = 'home/contactUs';
$route['home/career'] = 'home/career';
$route['home/do-add-career'] = 'home/doAddCareer';
$route['home/wesltk-offers'] = 'home/offers';
$route['home/why-us'] = 'home/whyus';
$route['home/cancellation-policy'] = 'home/cancellation';
$route['home/terms-and-conditions'] = 'home/terms';
$route['home/add-review'] = 'booking/addReviews';


///   User Controlller ////
$route['user/user-profile'] = 'user/profile';
$route['user/logout'] = 'user/logout';
$route['user/user-login'] = 'user/doLogin';
$route['home/forgot-password'] = 'user/forgotPassword';
$route['home/check-otp'] = 'user/checkOtp';
$route['home/reset-password'] = 'user/resetPassword';

// Booking controller//
$route['checkout'] = 'booking/checkout';
$route['home/confirmation'] = 'booking/orderConfirmation';
$route['home/remove-cart/(:any)'] = 'booking/removeCart/$1';


///   Vendor Controlller ////
$route['vendor'] = 'vendor/vendor/index';
$route['vendor/doLogin'] = 'vendor/vendor/doLogin';
$route['vendor/dashboard'] = 'vendor/vendor/dashboard';
$route['vendor/logout'] = 'vendor/vendor/logout';
$route['vendor/change-password'] = 'vendor/vendor/changePassword';
$route['vendor/doChangePass'] = 'vendor/vendor/doChangePass';
$route['vendor/edit-profile'] = 'vendor/vendor/editProfile';
$route['vendor/doChangeProfile/(:any)'] = 'vendor/vendor/doChangeProfile/$1';
$route['vendor/order-lists'] = 'vendor/vendor/orderLists';
$route['vendor/changeOrderStatus/(:any)'] = 'vendor/vendor/changeOrderStatus/$1';
$route['vendor/assignDeliveryBoy/(:any)'] = 'vendor/vendor/assignDeliveryBoy/$1';

///   Delivery boy(vendor panel) ////
$route['vendor/delivery-boy'] = 'vendor/vendor/deliveryBoy';
$route['vendor/add-delivery-boy'] = 'vendor/vendor/addDeliveryBoy';
$route['vendor/doAddDeliveryBoy'] = 'vendor/vendor/doAddDeliveryBoy';
$route['vendor/edit-delivery-boy/(:any)'] = 'vendor/vendor/addDeliveryBoy/$1';
$route['vendor/doEditDeliveryBoy/(:any)'] = 'vendor/vendor/doEditDeliveryBoy/$1';
$route['vendor/delete-boy/(:any)'] = 'vendor/vendor/deleteBoy/$1';

///   Product Controlller ////
$route['vendor/product-lists'] = 'vendor/product/index';
$route['vendor/add-product'] = 'vendor/product/addProduct';
$route['vendor/doAddShopProduct'] = 'vendor/product/doAddShopProduct';
$route['vendor/delete-product/(:any)'] = 'vendor/product/deleteProduct/$1';
$route['vendor/edit-product/(:any)'] = 'vendor/product/addProduct/$1';
$route['vendor/doEditShopProduct/(:any)'] = 'vendor/product/doEditProduct/$1';



///   Restaurant Controlller ////
$route['vendor/restaurant-menu'] = 'vendor/restaurant/index';
$route['vendor/edit-restaurant-menu/(:any)'] = 'vendor/restaurant/index/$1';
$route['vendor/addRestaurantMenu'] = 'vendor/restaurant/addRestaurantMenu';
$route['vendor/editRestaurantMenu/(:any)'] = 'vendor/restaurant/editRestaurantMenu/$1';
$route['vendor/delete-restaurant-menu/(:any)'] = 'vendor/restaurant/delete-restaurant-menu/$1';
$route['vendor/restaurant-product'] = 'vendor/restaurant/restaurantProduct';
$route['vendor/add-restaurant-product'] = 'vendor/restaurant/addRestaurantProduct';
$route['vendor/edit-restaurant-product/(:any)'] = 'vendor/restaurant/addRestaurantProduct/$1';
$route['vendor/delete-product-image/(:any)'] = 'vendor/restaurant/deleteRestaurantProductImage/$1';
$route['vendor/doAddProduct'] = 'vendor/restaurant/doAddProduct';
$route['vendor/doEditProduct/(:any)'] = 'vendor/restaurant/doEditProduct/$1';

///   Restaurant Controlller ////
$route['vendor/service-menu'] = 'vendor/service/index';
$route['vendor/edit-service-menu/(:any)'] = 'vendor/service/index/$1';
$route['vendor/addServiceMenu'] = 'vendor/service/addServiceMenu';
$route['vendor/editServiceMenu/(:any)'] = 'vendor/service/editServiceMenu/$1';
$route['vendor/delete-service-menu/(:any)'] = 'vendor/service/delete-service-menu/$1';
$route['vendor/service-product-lists'] = 'vendor/service/serviceProduct';
$route['vendor/add-service-product'] = 'vendor/service/addServiceProduct';
$route['vendor/edit-service-product/(:any)'] = 'vendor/service/addServiceProduct/$1';
$route['vendor/delete-service-product-image/(:any)'] = 'vendor/service/deleteServiceProductImage/$1';
$route['vendor/delete-service-product/(:any)'] = 'vendor/service/deleteServiceProduct/$1';
$route['vendor/doAddServiceProduct'] = 'vendor/service/doAddServiceProduct';
$route['vendor/doEditServiceProduct/(:any)'] = 'vendor/service/doEditServiceProduct/$1';

$route['vendor/service-catring-menu'] = 'vendor/catring/index';
$route['vendor/edit-service-catring-menu/(:any)'] = 'vendor/catring/index/$1';
$route['vendor/addServiceCatringMenu'] = 'vendor/catring/addServiceMenu';
$route['vendor/editCatringServiceMenu/(:any)'] = 'vendor/catring/editServiceMenu/$1';
$route['vendor/delete-service-catring-menu/(:any)'] = 'vendor/catring/delete-service-menu/$1';
$route['vendor/service-catring-product-lists'] = 'vendor/catring/serviceProduct';
$route['vendor/add-service-catring-product'] = 'vendor/catring/addServiceProduct';
$route['vendor/edit-service-catring-product/(:any)'] = 'vendor/catring/addServiceProduct/$1';
$route['vendor/doAddServiceCatringProduct'] = 'vendor/catring/doAddServiceProduct';
$route['vendor/doEditServiceCatringProduct/(:any)'] = 'vendor/catring/doEditServiceProduct/$1';




///   Admin-user Controlller ////
$route['admin/user'] = 'admin/user/users';
///   Admin Controlller ////
$route['admin'] = 'admin/admin/index';
$route['admin/doLogin'] = 'admin/admin/doLogin';
$route['admin/dashboard'] = 'admin/admin/dashboard';
$route['admin/forgot-password'] = 'admin/admin/forgotpassword';
$route['admin/doForgotPassword'] = 'admin/admin/doForgotPassword';
$route['admin/logout'] = 'admin/admin/logout';
$route['admin/change-password'] = 'admin/admin/changePassword';
$route['admin/doChangePass'] = 'admin/admin/doChangePass';
$route['admin/edit-profile'] = 'admin/admin/editProfile';
$route['admin/doChangeProfile/(:any)'] = 'admin/admin/doChangeProfile/$1';
$route['admin/pages/(:any)'] = 'admin/admin/pages/$1';
$route['admin/doupdateContent/(:any)'] = 'admin/admin/doupdateContent/$1';
///   Admin-user Controlller ////
$route['admin/user'] = 'admin/user/users';