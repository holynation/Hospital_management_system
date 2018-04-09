<?php
ob_start();
class Model_pharmacy extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('hash_created');
		$this->load->library('cookiecreate');
		$this->load->helper('cookie');
	}

	function put_pharmacy($table,$fields = array()){
 		$put = $this->db->insert($table, $fields);
 		return ($put) ? true : false; 
 	}

  	function view_pharmacy($from){
    	$sql = "SELECT * FROM $from ORDER BY id DESC";
    	$result = $this->db->query($sql);
    	$row = $result->result();

    	return ($result->num_rows() > 0) ? $row : 'no result';
  	}

  	function view_medicine(){
  		$this->db->select('*');
		$this->db->from('medicine_category');
		$this->db->join('medicine', 'medicine.category = medicine_category.id', 'right');
		$this->db->order_by('medicine.id', 'DESC');
		$query = $this->db->get();
		$result = $query->result();

		if($query->num_rows() > 0){
			return $result; 
		}else{
			return 'no result';
		}
  	}

  	function get_all_medicine(){
  		$this->db->select('*');
		$this->db->from('medicine');
		// $this->db->join('medicine', 'medicine.category = medicine_category.id', 'right');
		$this->db->order_by('medicine.id', 'DESC');
		$query = $this->db->get();
		$result = $query->result();

		if($query->num_rows() > 0){
			return $result; 
		}else{
			return 'no result';
		}
  	}

  	function get_medicine_by_id_jquery($sql){
  		if(!$sql){
  			echo '';
  			exit;
  		}

  		$query = $this->db->query($sql);
  		$result = $query->result();
  		// $result = $query->result_array();
  		if($result){
  			return $result;
  		}else{
  			return false;
  		}
  	}

  	function sum_of_price($sql){
  		$result = $this->db->query($sql);
  		if($result){
  			return $result->row();
  		}else{
  			return false;
  		}
  	}

  // 	function check_stock($id){
  // 		$this->db->select('*');
  // 		$this->db->from('medicine');
  // 		$this->db->where('id', $id);
  // 		$result = $this->db->get();

  // 		if($result->num_rows() > 0){
		// 	return $result; 
		// }else{
		// 	return 'not found';
		// }
  // 	}

  	function get_medicine_by_id($id){
      
      	$this->db->select('*');
		$this->db->from('medicine_category');
		$this->db->join('medicine', 'medicine.category = medicine_category.id', 'right');
		$this->db->where('medicine.id', $id);
		$query = $this->db->get();
		$result = $query->row();

		if($query->num_rows() > 0){
			return $result; 
		}else{
			return 'no result';
		}
    }

  	function update_pharmacy($id, $data, $from){
  		$this->db->where('id', $id);
		$update = $this->db->update($from, $data);
		return ($update) ? true : false;
  	}

  	function get_pharmacy_quantity($id){
  		$this->db->select('*');
  		$this->db->from('medicine');
  		$this->db->where('id', $id);
  		$query = $this->db->get();
  		$result = $query->row();

  		if($query->num_rows() > 0){
			return $result; 
		}else{
			return 'no result';
		}
  	}

  	function search_name($name){
  		if(empty($name)){
	      return null;
	    }
	    
	    if(isset($name)){
	    	$name = trim($name);
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

  	function get_category(){
    $sql = 'SELECT * FROM medicine_category';
    $result = $this->db->query($sql);
    $row = $result->result();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  	function delete_pharmacy($id,$from){
		$this->db->where('id', $id);
		$this->db->delete($from);

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

}