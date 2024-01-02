<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['category/(:num)/(:any)'] = 'Book/store/$1/$2';
$route['showbook/(:num)/(:any)'] = 'Book/bookdetails/$1/$2';
$route['showbook/(:num)/(:any)'] = 'Book/bookdetails/$1/$2';


$route['default_controller'] = 'Book';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
