<?php 

class Model_casenote extends CI_Model{

	function __construct(){
		parent::__construct();
	}

 	function search_name($name){
 		$name = trim($name);
 		$sql = "SELECT id,first_name,middle_name,last_name FROM patient
 				 WHERE first_name LIKE '%$name%' OR last_name LIKE '%$name%' OR middle_name LIKE '%$name%' LIMIT 5";
		$result = $this->db->query($sql);
		$row = $result->result();

		return ($result->num_rows() > 0) ? $row : 'no result';
 	} 

 	function put_casenote($fields = array()){
 		$put = $this->db->insert('casenote', $fields);
 		return ($put) ? true : false; 
 	}

 	function get_doctor_by_department($id,$doctor){
 		$this->db->select('*');
        $this->db->from('staff');
        $this->db->where('department_id', $id);
        $this->db->where('role', $doctor);
        $result = $this->db->get();

		return ($result->num_rows() > 0 ) ? $result : 'no result';
 	}

 	function get_doctor_by_schedule($id){
 		$this->db->select('*');
        $this->db->from('schedule');
        $this->db->where('doctor_id', $id);
        $result = $this->db->get();

		return ($result->num_rows() > 0 ) ? $result : 'no result';
 	}

 	function get_doctor_by_id($id){
		$sql = "SELECT * FROM staff WHERE id = '$id' ";
		$result = $this->db->query($sql);
		$row = $result->row();

		return ($result->num_rows() > 0) ? $row : 'no result';
	}

 	function view_appointment(){
	    $sql = 'SELECT * FROM appointment';
	    $result = $this->db->query($sql);
	    $row = $result->result();

	    return ($result->num_rows() > 0) ? $row : 'no result';
	}



	function get_patient_by_id($id){
		$this->db->select('*');
		$this->db->from('patient');
		$this->db->where('id', $id);
 		$result = $this->db->get();

		return ($result->num_rows() > 0 ) ? $result->row() : 'not found';
 	}

 	function get_appointment_by_id($id){
      $get = $this->db->get_where('appointment', array('id' => $id), 1)->row();
      return ($get) ? $get : false;
    }

    function get_casenote_by_id($id){
        $get = $this->db->get_where('casenote', array('id' => $id), 1)->row();
        return ($get) ? $get : false;
    }

 	function update_casenote($id, $data = array()){
 		$this->db->where('id', $id);
		$update = $this->db->update('casenote', $data);
		return ($update) ? true : false;
 	}



 	function delete_casenote($id){
		$this->db->where('id', $id);
		$this->db->delete('casenote');

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}


	//added new function



     function view_appointment_by_id($id){
	    $sql = " SELECT * FROM appointment WHERE id = '$id' LIMIT 2";
	    $result = $this->db->query($sql);
	    $row = $result->result();

	    return ($result->num_rows() > 0) ? $row : 'no result';
	}


	   function view_casenote_by_id($id){
	    $sql = " SELECT * FROM casenote WHERE patient_id = '$id' ";
	    $result = $this->db->query($sql);
	    $row = $result->result();

	    return ($result->num_rows() > 0) ? $row : 'no result';
	}


 	

	function get_last_casenote($id){
		$this->db->select();
		$this->db->from('casenote');
		$this->db->where('created_by', $id);
		$this->db->order_by('date_created', 'desc');
		$result = $this->db->get();
		$row = $result->result();

		return ($result->num_rows() > 0) ? $row : 'no result';
	}

	function get_all_casenote(){
		$this->db->select();
		$this->db->from('casenote');
		$this->db->order_by('date_created', 'desc');
		$this->db->limit(10);
		$result = $this->db->get();
		$row = $result->result();

		return ($result->num_rows() > 0) ? $row : 'no result';
	}

	function count_doctor_casenote($id){
		$this->db->select();
    	$this->db->from('casenote');
    	$this->db->where('created_by', $id);
    	$result = $this->db->get();
    	$count = $result->num_rows();

    	return ($result->num_rows() > 0) ? $count : 'no result';
	}

	function count_all_casenote(){
		$this->db->select();
    	$this->db->from('casenote');
    	$result = $this->db->get();
    	$count = $result->num_rows();

    	return ($result->num_rows() > 0) ? $count : 'no result';
	}

	function count_get_today_db($id){
	    $date = new DateTime("now");

	    $curr_date = $date->format('Y-m-d ');

	    $this->db->select('*');
	    $this->db->from('casenote'); 
	    $this->db->where('created_by', $id);
	    $this->db->where('DATE(date_created)',$curr_date);//use date function
	    $result = $this->db->get();
	    $count_today_appoint = $result->num_rows();
	     	return ($result->num_rows() > 0) ? $count_today_appoint : 'no result';
  	}






}