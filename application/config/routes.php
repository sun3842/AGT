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
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//********************login/logout/forgot password************************

$route['login']='Login/login';
$route['logout']='Logout/logout';


//********************admins home*********************************************
$route['admins_home']='Admins_home/admins_home';


//*********************Delivery user***********************************************

$route['add_new_delivery_user']='Delivery_user/add_new_delivery_user';
$route['delivery_user_list']='Delivery_user/delivery_user_list';
$route['delivery_user_details/(:any)']='Delivery_user/delivery_user_details/$1';
$route['de_active_delivery_user/(:any)']='Delivery_user/de_active_delivery_user/$1';
$route['active_delivery_user/(:any)']='Delivery_user/active_delivery_user/$1';
$route['remove_delivery_user/(:any)']='Delivery_user/remove_delivery_user/$1';

//**********************admin Update Account....................................
$route['admin_update_account']='Admin_account/admin_update_account';


//*********************Delivery user***********************************************

$route['add_new_admin_user']='Admin_user/add_new_admin_user';
$route['admin_user_list']='Admin_user/admin_user_list';
$route['admin_user_details/(:any)']='Admin_user/admin_user_details/$1';
$route['de_active_admin_user/(:any)']='Admin_user/de_active_admin_user/$1';
$route['active_admin_user/(:any)']='Admin_user/active_admin_user/$1';
$route['remove_admin_user/(:any)']='Admin_user/remove_admin_user/$1';


//*******************Admin DDT********************************************************
$route['admin_list_ddt']='Admin_ddt/admin_list_ddt';
$route['get_ddt_list']='Admin_ddt/get_ddt_list';
$route['delete_ddt/(:any)']='Admin_ddt/delete_ddt/$1';
$route['view_ddt/(:any)']='Admin_ddt/view_ddt/$1';
$route['admin_add_new_ddt']='Admin_ddt/add_new_ddt';
$route['lost_delete_ddt/(:any)']='Admin_ddt/lost_delete_ddt/$1';
$route['found_ddt/(:any)']='Admin_ddt/found_ddt/$1';

//********************Admin Report******************************************************
$route['ddt_load_unload_report']='Admin_report/ddt_load_unload_report';
$route['single_ddt_loading_unloading_details/(:any)']='Admin_report/single_ddt_loading_unloading_details/$1';
$route['print_report']="Admin_report/print_report";

//*********************Delivery User Activity List**********************************************
$route['delivery_user_activity_list']='Delivery_user_activity/delivery_user_activity_list';
$route['add_update_user_daily_activity']='Delivery_user_activity/add_update_user_daily_activity';
$route['list_of_delivery_point']='Delivery_user_activity/list_of_delivery_point';
$route['list_of_delivery_details/(:any)']='Delivery_user_activity/list_of_delivery_details/$1';


//**************************Language**************************************************************
$route['set_language/(:any)']="Language/set_language/$1";
$route['set_language/(:any)/(:any)']="Language/set_language/$1/$2";
$route['set_language/(:any)/(:any)/(:any)']="Language/set_language/$1/$2/$3";

//**************************forgot_password**********************************************
$route['forgot_password']='Login/forgot_password';