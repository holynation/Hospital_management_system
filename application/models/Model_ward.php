<?php 

class Model_ward extends CI_Model{

	function __construct(){
		parent::__construct();
	}

 	function put_ward($fields = array()){
 		$put = $this->db->insert('ward', $fields);
 		return ($put) ? true : false; 
 	}

 	function put_ward_assign($fields = array()){
 		$put = $this->db->insert('ward_assign', $fields);
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

 	function view_ward(){
	    $sql = 'SELECT * FROM ward';
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

 	function get_ward_available($id){
		$this->db->select('*');
		$this->db->from('ward');
		$this->db->join('ward_assign', 'ward_assign.ward_id = ward.id');
		$this->db->where('ward_id', $id);
		$query = $this->db->get();
		$result = $query->row();

		if($query->num_rows() > 0){
			$result->count = $query->num_rows();
			return $result; 
		}else{
			return 'no result';
		}
		
 	}

 	function get_bed_assign_list(){
 		$this->db->select('*');
		$this->db->from('ward');
		$this->db->join('ward_assign', 'ward_assign.ward_id = ward.id');
		$this->db->order_by('ward_assign.id', 'DESC');
		$query = $this->db->get();
		$result = $query->result();

		if($query->num_rows() > 0){
			return $result; 
		}else{
			return 'no result';
		}
 	}

 	function get_patient_ward_by_id($id){
 		$this->db->select('*');
		$this->db->from('ward');
		$this->db->join('ward_assign', 'ward_assign.ward_id = ward.id');
		$this->db->where('ward_assign.id', $id);
		$query = $this->db->get();
		$result = $query->row();

		if($query->num_rows() > 0){
			return $result; 
		}else{
			return 'no result';
		}
 	}

 	function get_ward_by_id($id){
      $get = $this->db->get_where('ward', array('id' => $id), 1)->row();
      return ($get) ? $get : false;
    }

    function get_ward_assign_by_id($id){
      // $get = $this->db->get_where('ward_assign', array('id' => $id), 1)->row();
      // return ($get) ? $get : false;
      
      	$this->db->select('*');
		$this->db->from('ward');
		$this->db->join('ward_assign', 'ward_assign.ward_id = ward.id');
		$this->db->where('ward_assign.id', $id);
		$query = $this->db->get();
		$result = $query->row();

		if($query->num_rows() > 0){
			return $result; 
		}else{
			return 'no result';
		}
    }

    function get_ward(){
	    $sql = 'SELECT * FROM ward';
	    $result = $this->db->query($sql);
	    $row = $result->result();

	    return ($result->num_rows() > 0) ? $row : 'no result';
	  }

 	function update_ward($id, $data = array()){
 		$this->db->where('id', $id);
		$update = $this->db->update('ward', $data);
		return ($update) ? true : false;
 	}

 	function update_ward_status($id, $data = array()){
 		$this->db->where('id', $id);
		$update = $this->db->update('ward', $data);
		return ($update) ? true : false;
 	}

 	function update_ward_discharge_status($id, $data = array()){
 		$this->db->where('id', $id);
		$update = $this->db->update('ward_assign', $data);
		return ($update) ? true : false;
 	}

 	function delete_ward($id,$from){
		$this->db->where('id', $id);
		$this->db->delete($from);

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

}