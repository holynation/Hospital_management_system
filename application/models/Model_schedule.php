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
 		$this->db->select('*');
 		$this->db->from('role');
 		$this->db->join('staff', 'staff.role = role.id');
 		$this->db->where('role_name', 'Doctor');
 		$result = $this->db->get();
 		// $sql = "SELECT * FROM staff WHERE role = 'doctor' ";
		// $result = $this->db->query($sql);
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

	function get_schedule_by_id($id){
		$sql = 'SELECT * from schedule where id = ?';
		$result = $this->db->query($sql, array($id));
		$row = $result->row();

		return ($result->num_rows() > 0) ? $row : 'no result';
	}

	function update_schedule($id, $data = array()){
 		$this->db->where('id', $id);
		$update = $this->db->update('schedule', $data);
		return ($update) ? true : false;
 	}

 	function delete_schedule($id){
		$this->db->where('id', $id);
		$this->db->delete('schedule');

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

}