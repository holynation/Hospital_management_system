<?php
ob_start();
class Model_department extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('hash_created');
		$this->load->library('cookiecreate');
		$this->load->helper('cookie');
	}

	function put_department($fields = array()){
 		$put = $this->db->insert('department', $fields);
 		return ($put) ? true : false; 
 	}

  function view_department(){
    $sql = 'SELECT * FROM department';
    $result = $this->db->query($sql);
    $row = $result->result();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  function update_department($id, $data, $from){
  		$this->db->where('id', $id);
		$update = $this->db->update($from, $data);
		return ($update) ? true : false;
  	}

  function delete_department($id){
		$this->db->where('id', $id);
		$this->db->delete('department');

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

}