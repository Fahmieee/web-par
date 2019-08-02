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
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = 'errorPage';
$route['translate_uri_dashes'] = TRUE;

/*
| -------------------------------------------------------------------------
| AUTHENTIFIKASI
| -------------------------------------------------------------------------
*/
$route['api/login'] = 'api/auth/login';
$route['api/register'] = 'api/auth/register';
$route['api/change_password'] = 'api/auth/change_password'; 
$route['api/verification'] = 'api/auth/verification_code';
$route['api/reset_password'] = 'api/auth/reset_password'; 
$route['api/verification_reset'] = 'api/auth/verification_reset_code';
$route['api/notif'] = 'api/auth/notif';
$route['api/send_email'] = 'api/auth/send_email';
$route['api/profile'] = 'api/auth/get_profile';
$route['api/logout'] = 'api/auth/logout';
$route['api/register'] = 'api/auth/register';
/*
| -------------------------------------------------------------------------
| DASHBOARD
| -------------------------------------------------------------------------
*/
$route['api/dashboard'] = 'api/report/get_summary_dashboard'; 

/*
| -------------------------------------------------------------------------
| SCHEDULER
| -------------------------------------------------------------------------
*/
$route['api/update_km'] = 'api/scheduler/update_km'; 
$route['api/pairing'] = 'api/scheduler/get_scheduler'; 
/*
| -------------------------------------------------------------------------
| UNIT
| -------------------------------------------------------------------------
*/
$route['api/unit_user'] = 'api/units/get_unit_by_user';
$route['api/units/save_unit'] = 'api/units/save_unit';
$route['api/units/getallunit'] = 'api/units/getallunit';
$route['api/units/getunit_bytype'] = 'api/units/getunit_bytype';
$route['api/units/getunit_bymerk'] = 'api/units/getunit_bymerk';
$route['api/units/getunit_bynopol'] = 'api/units/getunit_bynopol';
$route['api/units/getunit_byassets'] = 'api/units/getunit_byassets';
/*
| -------------------------------------------------------------------------
| SERVICES
| -------------------------------------------------------------------------
*/
$route['api/perbaikan'] = 'api/services/get_perbaikan';  
$route['api/perawatan'] = 'api/services/get_perawatan';  
$route['api/darurat'] = 'api/services/get_darurat';  
$route['api/services/order_workshop'] = 'api/services/order_workshop';  
$route['api/services/upload_repair'] = 'api/services/upload_repair';  
/*
| -------------------------------------------------------------------------
| WORKSHOP
| -------------------------------------------------------------------------
*/
$route['api/workshop/find_nearby'] = 'api/workshop/find_nearby';   
$route['api/workshop/find_workshop'] = 'api/workshop/find_workshop';   
$route['api/workshop/save_workshop'] = 'api/workshop/save_workshop';
/*
| -------------------------------------------------------------------------
| ORDER
| -------------------------------------------------------------------------
*/
$route['api/order/repair'] = 'api/order/repair';   
$route['api/order/emergency'] = 'api/order/emergency';   
$route['api/order/treatment'] = 'api/order/treatment';   
$route['api/order/send_emergency'] = 'api/order/send_emergency';   
$route['api/order/all'] = 'api/order/all_order';   
$route['api/order/detail'] = 'api/order/detail_order';   
$route['api/order/done'] = 'api/order/done';   

/*
| -------------------------------------------------------------------------
| NOTIF
| -------------------------------------------------------------------------
*/
$route['api/notif'] = 'api/auth/notif';    
/*
| -------------------------------------------------------------------------
| DRIVER
| -------------------------------------------------------------------------
*/
$route['api/driver'] = 'api/drivers/get_drivers';   /*
| -------------------------------------------------------------------------
| reviews
| -------------------------------------------------------------------------
*/
$route['api/review'] = 'api/reviews/get_reviews';    
$route['api/review_periodik'] = 'api/reviews/review_periodik';    
$route['api/review_spot'] = 'api/reviews/review_spot';   
/*
| -------------------------------------------------------------------------
| Produk (Alfin)
| -------------------------------------------------------------------------
*/ 
$route['api/produk/save_produk'] = 'api/produk/save_produk';
/*
| -------------------------------------------------------------------------
| Area (Alfin)
| -------------------------------------------------------------------------
*/ 
$route['api/area/getallarea'] = 'api/area/getallarea';
$route['api/area/getarea_bycode'] = 'api/area/getarea_bycode';
/*
| -------------------------------------------------------------------------
| City (Alfin)
| -------------------------------------------------------------------------
*/ 
$route['api/city/getallcity'] = 'api/city/getallcity';
$route['api/city/getcity_bycode'] = 'api/city/getcity_bycode';
/*
| -------------------------------------------------------------------------
| Branch (Alfin)
| -------------------------------------------------------------------------
*/ 
$route['api/branch/getallbranch'] = 'api/branch/getallbranch';
$route['api/branch/getbranch_bycode'] = 'api/branch/getbranch_bycode';
$route['api/branch/getbranch_byarea'] = 'api/branch/getbranch_byarea';
$route['api/branch/getbranch_bycity'] = 'api/branch/getbranch_bycity';
