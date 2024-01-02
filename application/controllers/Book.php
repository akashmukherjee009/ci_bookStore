<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

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
		$this->load->library('cart');
		$this->load->model('mod_book');
		/* Load helper */	
		/* Location: ./application/helper/system_helper.php */		
		$this->load->helper('system_helper');		
    }

	public function index($fieldby='',$orderby='')
	{
		
		$data=array();
		$sessionData = $this->session->userdata('sessdata');
		// print_r($sessionData);die;
		if(isset($sessionData) && $sessionData['islogin']==1){
			$fieldby = ($fieldby=='')?'id':$fieldby;
			$orderby = ($orderby=='')?'asc':$orderby;
			$data['orderby'] = ($orderby=='asc')?'desc':'asc';
			$data['dataset'] = $this->mod_book->getMultiData('book',$where=array('book_active'=>1,'book_trash'=>0,'user_id'=>$sessionData['id']),$fieldby,$orderby);
		}else{
			$fieldby = ($fieldby=='')?'id':$fieldby;
			$orderby = ($orderby=='')?'asc':$orderby;
			$data['orderby'] = ($orderby=='asc')?'desc':'asc';
			$data['dataset'] = $this->mod_book->getMultiData('book',$where=array('book_active'=>1,'book_trash'=>0),$fieldby,$orderby);
		}
		$this->load->view('book',$data);
	}
	public function store($cateid='',$cateslug=''){
		$data=array();
		$data['categories'] = $this->mod_book->getMultiData('book_category',$where=array());
		$where = array();
		$where['book_active'] =1;
		$where['book_trash'] =0;
		if($cateid){
			$where['category_id'] =$cateid;
		}
		$data['books'] = $this->mod_book->getMultiData('book',$where);
		$this->load->view('home',$data);
	}
	public function bookdetails($id='',$bookslug=''){
		$data=array();
		$data['categories'] = $this->mod_book->getMultiData('book_category',$where=array());
		//$where = array();
		//$where['book_active'] =1;
		//$where['book_trash'] =0;		
		$data['book'] = $this->mod_book->getSingleData('book',$where=array('id'=>$id));
		$this->load->view('details',$data);
	}
	public function addtocart($itemid){
		$book = $this->mod_book->getSingleData('book',$where=array('id'=>$itemid));
		$data = array(
			'id'      => 'sku_book_'.$book->id,
			'qty'     => 1,
			'price'   => $book->book_price,
			'name'    => $book->book_name,
			'options' => array('Size' => '280page', 'Bind' => 'Yes')
		);	
		$this->cart->insert($data);
		redirect('/book/store', 'refresh');	
	}
	public function viewcart(){
		$data = array();
		$this->load->view('viewcart',$data);
	}
	public function clearcart($rowid){
		
		$this->cart->remove($rowid);
		$this->load->view('viewcart');
	}
	public function updatecart($rowid, $qty){
		$data = array(
			'rowid' => $rowid,
			'qty'   => $qty
	   );
	
		$this->cart->update($data);
		$this->load->view('viewcart');
	}
	public function insert(){

		$sessionData = $this->session->userdata('sessdata');
		if($sessionData['islogin']==1){
		    
			$todo  = $this->input->post('todo');
			if($todo=='save'){
				$this->form_validation->set_rules('book_name','Book name is required','required');
				$this->form_validation->set_rules('book_price','Book price is required','required');
					if ($this->form_validation->run() === FALSE ){
						$error = '<span style="color:#ff0000;">'.form_error('book_name').form_error('book_price').'</span>';
						$this->session->set_flashdata('message', $error);
						redirect('/book/insert', 'refresh');
					}else{
						$insert = array();
						$insert['book_name'] = $this->security->xss_clean(trim($this->input->post('book_name')));
						$insert['book_price'] = $this->security->xss_clean(trim($this->input->post('book_price')));
						$insert['book_pd'] = $this->security->xss_clean(trim($this->input->post('book_pd')));
						$insert['user_id'] = $sessionData['id'];
						$insert['book_active'] = 1;
						$insert['book_trash'] = 0;
						
						if(isset($_FILES['book_pic'])){	
							$uploads = $this->mod_book->upload_files('./upload/',time(),$_FILES['book_pic']);
							if($uploads){
								foreach($uploads as $file){
									$insert['book_pic'] 	= $file;
								}
							}
						}
						$this->mod_book->get_InsertData('book',$insert);
						redirect('/book/index', 'refresh');
					}
			}else{
				$data=array();
				$data['session'] = $sessionData;
				$this->load->view('bookdetails',$data);
			}
		}else{
			redirect('/user/index', 'refresh');	
		}
		
		
	}
	public function update($id=''){

		$todo  = $this->input->post('todo');
		if($todo=='save'){
			$this->form_validation->set_rules('book_name','Book name is required','required');
			$this->form_validation->set_rules('book_price','Book price is required','required');
			if ($this->form_validation->run() === FALSE ){
				$error = '<span style="color:#ff0000;">'.form_error('book_name').form_error('book_price').'</span>';
				$this->session->set_flashdata('message', $error);
				redirect('/book/update/'.$id, 'refresh');
			}else{
				$update = array();
				$where = array();
				$where['id'] = $this->input->post('id');
				$update['book_name'] = $this->security->xss_clean(trim($this->input->post('book_name')));
				$update['book_price'] = $this->security->xss_clean(trim($this->input->post('book_price')));
				$update['book_pd'] = $this->security->xss_clean(trim($this->input->post('book_pd')));
				if(isset($_FILES['book_pic'])){	
					$uploads = $this->mod_book->upload_files('./upload/',time(),$_FILES['book_pic']);
					if($uploads){
						foreach($uploads as $file){
							$update['book_pic'] 	= $file;
						}
					}
				}
				
				$this->mod_book->get_UpdateData('book',$update, $where);
				redirect('/book/index', 'refresh');
			}
		}else{
			$data=array();
			$data['dataset'] = $this->mod_book->getSingleData('book',$where=array('id'=>$id));
			$this->load->view('bookdetails',$data);
		}


	}
	public function delete($id=''){
		$update = array();
		$where = array();
		$where['id']= $id;
		$update['book_trash']= 1;
		$this->mod_book->get_UpdateData('book',$update, $where);
		redirect('/book/index', 'refresh');
	}
}
