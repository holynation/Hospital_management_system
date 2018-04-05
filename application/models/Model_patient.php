<?php 

class Model_patient extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('hash_created');
		$this->load->library('cookiecreate');
		$this->load->helper('cookie');
	}

	function put_patient($fields = array()){
 		$put = $this->db->insert('patient', $fields);
 		return ($put) ? true : false; 
 	}

 	function view_patient(){
 		$sql = 'SELECT * FROM patient ORDER BY id DESC';
		$result = $this->db->query($sql);
		$row = $result->result();

		return ($result->num_rows() > 0) ? $row : 'no result';
 	}

 	function view_patient_where($id){
 		$get = $this->db->get_where('patient', array('id' => $id), 1)->result();
 		return ($get) ? $get : false;
 	}

 	function get_patient_by_id($id){
 		$get = $this->db->get_where('patient', array('id' => $id), 1)->row();
 		return ($get) ? $get : false;
 	}

 	function update_patient($id, $data = array()){
 		$this->db->where('id', $id);
		$update = $this->db->update('patient', $data);
		return ($update) ? true : false;
 	}

 	function get_appointment($id){
 		$this->db->select('*');
        $this->db->from('appointment');
        $this->db->where('patient_id', $id);
        $result = $this->db->get();

		return ($result->num_rows() > 0 ) ? $result : 'no result';
 	}
}