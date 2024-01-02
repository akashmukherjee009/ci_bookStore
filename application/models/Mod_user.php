<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_user extends CI_Model {	

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




	
}//END CLASS

?>