<?php

class Model_insurance extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function put_insurance($table,$fields = array()){
 		$put = $this->db->insert($table, $fields);
 		return ($put) ? true : false; 
 	}

  	function view_insurance($from){
    	$sql = "SELECT * FROM $from ORDER BY id DESC";
    	$result = $this->db->query($sql);
    	$row = $result->result();

    	return ($result->num_rows() > 0) ? $row : 'no result';
  	}

  	function update_insurance($id, $data, $from){
  		$this->db->where('id', $id);
		$update = $this->db->update($from, $data);
		return ($update) ? true : false;
  	}

  	function delete_insurance($id,$from){
		$this->db->where('id', $id);
		$this->db->delete($from);

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

}