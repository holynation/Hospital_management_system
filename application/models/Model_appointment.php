<?php 

class Model_appointment extends CI_Model{

	function __construct(){
		parent::__construct();
	}

 	function search_name($name){
  		if(empty($name)){
	      return null;
	    }
	    
	    if(isset($name)){
	 		$this->db->select('*');
		    $this->db->from('patient');
		    $this->db->like('first_name', $name, 'both');
		    $this->db->or_like('last_name', $name);
		    $this->db->or_like('middle_name', $name);
		    $result = $this->db->get();
		    $row = $result->result();

			return ($result->num_rows() > 0) ? $row : 'no result';
	    }

	    return false;
 	}

 	function put_appointment($fields = array()){
 		$put = $this->db->insert('appointment', $fields);
 		return ($put) ? true : false; 
 	}

 	function get_doctor_by_department($id,$doctor){
 		$this->db->select('*');
        $this->db->from('role');
        $this->db->join('staff', 'staff.role = role.id');
        $this->db->where('staff.department_id', $id);
        $this->db->where('role_name', $doctor);
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
	    $sql = 'SELECT * FROM appointment ORDER BY id DESC';
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

    function get_doctor_appointment($id){
    	$this->db->select();
		$this->db->from('appointment');
		$this->db->where('doctor_name', $id);
		$this->db->order_by('date_created', 'desc');
		$this->db->limit(10);
		$result = $this->db->get();
		$row = $result->result();

		return ($result->num_rows() > 0) ? $row : 'no result';
    }

    function get_all_appointment(){
    	$this->db->select();
		$this->db->from('appointment');
		$this->db->order_by('date_created', 'desc');
		$this->db->limit(10);
		$result = $this->db->get();
		$row = $result->result();

		return ($result->num_rows() > 0) ? $row : 'no result';
    }

    function count_doctor_appoint($id){
    	$this->db->select();
    	$this->db->from('appointment');
    	$this->db->where('doctor_name', $id);
    	$result = $this->db->get();
    	$count = $result->num_rows();

    	return ($result->num_rows() > 0) ? $count : 'no result';
    }

    function count_get_today_db($id,$from){
	     $date = new DateTime("now");

	     $curr_date = $date->format('Y-m-d ');

	     $this->db->select('*');
	     $this->db->from($from); 
	     $this->db->where('doctor_name', $id);
	     $this->db->where('DATE(date_created)',$curr_date);//use date function
	     $result = $this->db->get();
	     $count_today_appoint = $result->num_rows();
	      return ($result->num_rows() > 0) ? $count_today_appoint : 'no result';
  	}

 	function update_appointment($id, $data = array()){
 		$this->db->where('id', $id);
		$update = $this->db->update('appointment', $data);
		return ($update) ? true : false;
 	}

 	function delete_appointment($id){
		$this->db->where('id', $id);
		$this->db->delete('appointment');

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

}