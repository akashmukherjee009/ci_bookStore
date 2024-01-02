<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_book extends CI_Model {	

	function __construct(){
			parent::__construct();
		}
	
/* Insert record */	
	/* Parameters:  Tablename, data */
	function get_InsertData($table,$insertdata){
		$res = $this->db->insert($table,$insertdata);
		if(!$res){
		  $val = $this->db->_error_message();
		}else{
			$last_id = $this->db->insert_id();
			$this->session->set_flashdata('temp_lastid', $last_id);
		  	$val = 1;	
		}
		return $val;
	}
	/* Update record */	
	/* Parameters:  Tablename, where, data */
	function get_UpdateData($table,$updatedata,$where){
		$this->db->update($table,$updatedata,$where);
		$val = 1;
		return $val;			
	}
	/* Single Records  set */	
	/* Parameters:  Tablename, where, fieldname, orderby */
	function getSingleData($table,$where){		
			$this->db->from($table);
			$this->db->where($where);
			$query = $this->db->get();
			$result = $query->row();
			return $result;
	}
	/* Multiple Records  set */	
	/* Parameters:  Tablename, where, fieldname, orderby */
	function getMultiData($table,$where, $fieldname='', $orderby=''){		
			$this->db->from($table);
			$this->db->where($where);
			if($fieldname != ''){
				$this->db->order_by($fieldname, $orderby);
			}
			$query = $this->db->get();
			$result = $query->result();
			return $result;
	}


	public function upload_files($path, $title, $files){
	    $config = array(
	        'upload_path'   => $path,
	        'allowed_types' => 'jpeg|jpg|gif|png|doc|pdf|docx|xlsx|xls|ppt|pptx',
	        'overwrite'     => 0,
	        'remove_spaces' => FALSE
	    );

	   
	    $this->load->library('upload', $config);
	    $images = array();


	    foreach ($files['name'] as $key => $image) {

	        $_FILES['images[]']['name']= $files['name'][$key];
	        $_FILES['images[]']['type']= $files['type'][$key];
	        $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
	        $_FILES['images[]']['error']= $files['error'][$key];
	        $_FILES['images[]']['size']= $files['size'][$key];
	        $file_ext = pathinfo($_FILES['images[]']["name"], PATHINFO_EXTENSION);
	        $fileName = md5(uniqid($title)).'.'. $file_ext;
	        $fileName = $_FILES['images[]']["name"];	       
	        $config['file_name'] = $fileName;
	        $this->upload->initialize($config);
	        if ($this->upload->do_upload('images[]')) {
	            $uploadData = $this->upload->data();
	            $images[] =  $uploadData['orig_name'];
	        } else {
				echo $this->upload->display_errors();
				//return false;
	        }
	    }
	    return $images;
	 }


	
}//END CLASS

?>