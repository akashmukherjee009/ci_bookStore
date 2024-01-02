<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	 function __construct(){
        parent::__construct();
	
		/* Load models */		
		/* Location: ./application/models/backend/mod_secure_pagenation.php */
		$this->load->model('mod_user');
		/* Load helper */	
		/* Location: ./application/helper/system_helper.php */		
		//$this->load->helper('system_helper');		
    }

    public function index($fieldby='',$orderby='')
	{
		$data=array();
		$this->load->view('login',$data);
	}
	public function login()
	{
		$data=array();
		$user_email = $this->input->post('user_email');
        $user_password = $this->input->post('user_password');
        $getUser = $this->mod_user->getSingleData('user',$where=array('user_email'=>$user_email, 'user_active'=>1,'user_trash'=>0));
        if($getUser->user_password == $user_password){
            $info = array();
            $info['id']  =  $getUser->user_id;
            $info['name']  =  $getUser->user_name;
            $info['email'] =  $getUser->user_email;
            $info['islogin'] =  1;
            $this->session->set_userdata('sessdata', $info);
            $this->load->view('bookdetails',$data);
        }else{
            $this->session->set_flashdata('message', 'Login fail.');
            $this->load->view('login',$data);
        }
       
	}

	public function register_form($fieldby='',$orderby='')
	{
		$data=array();
		$this->load->view('register',$data);
	}

    public function register()
	{
		$data=array();
		$user_email = $this->input->post('user_email');
        $user_password = $this->input->post('user_password');
        $createUser = $this->mod_user->get_InsertData('user',$where=array('user_email'=>$user_email, 'user_password'=>$user_password, 'user_active'=>1,'user_trash'=>0));
		$getUser = $this->mod_user->getSingleData('user',$where=array('user_email'=>$user_email, 'user_password'=>$user_password, 'user_active'=>1,'user_trash'=>0));
        if($getUser){
            $info = array();
            $info['id']  =  $getUser->user_id;
            $info['name']  =  $user_email;
            $info['email'] =  $user_password;
            $info['islogin'] =  1;
            $this->session->set_userdata('sessdata', $info);
            $this->load->view('bookdetails',$data);
        }else{
            $this->session->set_flashdata('message', 'Login fail.');
            $this->load->view('login',$data);
        }
       
	}

    public function logout()
	{
        $this->session->sess_destroy();
        redirect('/user/index', 'refresh');	
    }

}