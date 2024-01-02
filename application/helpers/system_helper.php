<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('date_setup'))
{
	function date_setup($cdate){
		if($cdate!='0000-00-00'){
			return date('F j, Y', strtotime($cdate));
		}else{
			return '';
		}
	}
}  