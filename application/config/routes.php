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


$route['new_admin/forgetmypassword/code/(:any)'] = 'new_admin/forgetmypassword/code/$1';
$route['new_admin/pages/view'] = 'new_admin/pages/view';
$route['new_admin/pages/add'] = 'new_admin/pages/add';
$route['new_admin/pages/edit/(:any)'] = 'new_admin/pages/edit/$1';
$route['new_admin/pages/del/(:any)'] = 'new_admin/pages/del/$1';

$route['new_admin/menu'] = 'new_admin/menu/view';
$route['new_admin/menu/(view|add)'] = 'new_admin/menu/$1';
$route['new_admin/menu/(edit|del)/([0-9]{1,})'] = 'new_admin/menu/$1/$2';

$route['new_admin/admins/(edit)/([0-9]{1,})'] = 'new_admin/admins/edit/$2';

$route['new_admin/login'] = 'new_admin/login';
$route['new_admin/settings'] = 'new_admin/settings';
$route['new_admin/admin'] = 'new_admin/admin/index';
$route['new_admin/admin_index'] = 'new_admin/admin_index/index';

$route['new_admin/contacts'] = 'new_admin/contacts/index';
$route['new_admin/contacts/read/([0-9]{1,})'] = 'new_admin/contacts/read/$1';


#-- site ------------------------------
$route['rss.xml'] = 'rss';


$route['(pages|news|gallery)/([0-9]{1,})'] = '$1/view/$2';

$route['(categories)'] = 'category/index';
$route['([a-zA-Z]){2}'] = 'Home/country/$1';
$route['([0-9]{1,11})'] = 'category/catList/$1';
$route['([0-9]{1,11})/([a-zA-Z]{1,10})/([a-zA-Z]{1,4})/(:num)'] = 'category/catList/$1/$2/$3/$4';
$route['([0-9]{1,11})/([a-zA-Z]{1,10})/([a-zA-Z]{1,4})/'] = 'category/catList/$1/$2/$3/';
$route['(register|login|logout|cart).html'] = '$1/index';
$route['(profile)/(myorders)'] = '$1/$2';
$route['(cart)/(shipment).html'] = '$1/$2';

$route['([0-9]{1,11})/([0-9]{1,11}).html'] = 'product/single/$1/$2/$3';
$route['(index).html'] = 'home';
$route['(register).html'] = 'register/index';
$route['(brands)/([0-9]{1,11})'] = '$1/view/$2';
$route['(brands)/([0-9]{1,11})/([0-9]{1,11})'] = '$1/view/$2/$3';
$route['404_override'] = 'home/page404';
$route['pages'] = 'home/page404';
$route['translate_uri_dashes'] = FALSE;
