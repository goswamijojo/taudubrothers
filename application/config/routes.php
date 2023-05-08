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
$route['default_controller'] = 'web';
//Website routing start



$route['user_profile']='User_controller/user_profile';
$route['register']='web/register';

$route['checkout']='User_controller/checkout';
$route['my_order']='User_controller/my_order';

$route['seller_order']='User_controller/seller_order';

$route['privacy_policy']='web/privacy_policy';
$route['return_policy']='web/return_policy';
$route['shipping_policy']='web/shipping_policy';
$route['term_condition']='web/term_condition';
//$route['location']='web/location';
//$route['location']='User_controller/location';

// user route
$route['register']='User_controller/register';
$route['user_signup']='User_controller/user_signup';

$route['login']='User_controller/login';
$route['login_check']='User_controller/login_check';
$route['resend_otp/(:any)']='User_controller/resend_otp/$1';
$route['verify']='User_controller/verify';
$route['verification']='User_controller/verification';
$route['blog']='web/bloglist';
$route['dashboard_overview']='web/dashboard_overview';
$route['dashboard_overview']='User_controller/dashboard_overview';
$route['logout']='User_controller/logout';
$route['kyc_vendor']='User_controller/kyc_vendor';
$route['add_kyc_details']='User_controller/add_kyc_details';
$route['add_address']='User_controller/add_address';
$route['add_address_user']='User_controller/add_address_user';
$route['place_order']='User_controller/checkout_new';
$route['update_profile']='User_controller/update_profile';


$route['delete_address/(:num)']='User_controller/delete_address/$1';
$route['add_product']='User_controller/add_product';
$route['add_seller_product']='User_controller/add_seller_product';
$route['edit_seller_product/(:any)']='User_controller/edit_seller_product/$1';

$route['getMyWislistItems']='web/get_wishlist';
$route['wishlist']='User_controller/wishlist_list';

$route['delete_wishlist_web/(:num)']='User_controller/delete_wishlist_web/$1';

$route['getMyCartItems']='web/get_cart';


$route['cancel_order']='User_controller/cancel_order';


$route['view_product']='User_controller/view_product';
$route['delete_product/(:num)']='User_controller/delete_product/$1';
$route['near']='web/near';
$route['near_location']='web/near_location';
$route['delivery_enquiry']='web/delivery_enquiry';
$route['connect_seller']='web/connect_seller';

$route['seller_shop_list']='web/seller_shop_list';
$route['seller_shop_list/(:num)']='web/seller_shop_list/$1';

$route['seller_profile']='web/single_saller_location';
$route['seller_profile/(:num)']='web/single_saller_location/$1';

$route['followers/(:num)']='web/followers/';

//$route['seller_profile']='web/seller_profile';


//End User route



$route['market-place']='web/marketplace';
$route['market-place/(:any)'] = 'web/marketplace/$1';

$route['admin'] = 'admin';

$route['all_blog']='web/all_blog';
$route['all_blog/(:any)']='web/blog/$id';



$route['blog']='web/bloglist';
$route['blog/(:any)']='web/bloglist';
$route['brand_list']='web/brand_list';
$route['brand_list/(:any)']='web/brand_list/$id';
$route['product_details'] = 'web/productlist';
$route['product_details/(:any)'] = 'web/productlist/$id';
$route['search'] = 'web/searchlist';
$route['search/(:num)'] = 'web/searchlist/$1';
$route['search_shop'] = 'web/search_shop';

$route['grocery']='web/grocery';
$route['grocery/(:any)']='web/typecategorylist/$1';
$route['grocery/(:any)/(:num)']='web/typecategorylist/$1/$2';

$route['fresh']='web/fresh';
$route['fresh/(:any)']='web/typecategorylistfresh/$1';
$route['fresh/(:any)/(:num)']='web/typecategorylistfresh/$1/$2';

$route['(:any)'] = 'web/categorylist/$1';
$route['(:any)/(:num)'] = 'web/categorylist/$1/$1';
 







// $route[' '] = '/user/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
