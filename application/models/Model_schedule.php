<?php 

class Model_schedule extends CI_Model{

	function __construct(){
		parent::__construct();
	} 

 	function put_schedule($fields = array()){
 		$put = $this->db->insert('schedule', $fields);
 		return ($put) ? true : false; 
 	}

 	function get_doctors(){
 		$sql = "SELECT * FROM staff WHERE role = 'doctor' ";
		$result = $this->db->query($sql);
		$row = $result->result();

		return ($result->num_rows() > 0) ? $row : 'no result';
 	}

 	function view_schedule(){ 
	    $sql = 'SELECT * FROM schedule';
	    $result = $this->db->query($sql);
	    $row = $result->result();

	    return ($result->num_rows() > 0) ? $row : 'no result';
	}

	function get_doctor_by_id($id){
		$sql = "SELECT * FROM staff WHERE id = '$id' ";
		$result = $this->db->query($sql);
		$row = $result->row();

		return ($result->num_rows() > 0) ? $row : 'no result';
	}

}