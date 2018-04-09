<?php
ob_start();
class Model_role extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('hash_created');
		$this->load->library('cookiecreate');
		$this->load->helper('cookie');
	}

	function put_role($fields = array()){
 		$put = $this->db->insert('role', $fields);
 		return ($put) ? true : false; 
 	}

  function view_role(){
    $sql = 'SELECT * FROM role';
    $result = $this->db->query($sql);
    $row = $result->result();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  function delete_role($id){
		$this->db->where('id', $id);
		$this->db->delete('role');

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

}