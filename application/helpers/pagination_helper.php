<?php

$ci =& get_instance();
$ci->load->model('Model_staff');

function getsettingsdetails(){
	
	$ci =& get_instance();
	$s =$ci->Model_staff->settings_details();
	
	//print json_encode( $s );
	return $s;
}
 

function is_logged() {
	$obj = & get_instance();
    $sessionData = $obj->session->userdata('staff_db_id');
    if($sessionData) {
		$obj->db->select('*');
		$obj->db->where('id', $sessionData);
	    $query = $obj->db->get('staff');
		$result = $query->row();
		$result->username = $result->staff_username; // this is echoing out the result of the username
	
		if($result){
			$result->status = 'success';  // this is the success message
			return $result;
		} 
		else{
			return false;
		}
	}
	else{
		return false;
	}
}

function get_current_age($date_of_birth){
	$today = date("Y-m-d");
    $diff = date_diff(date_create($date_of_birth), date_create($today));
    return $diff->format('%y');
}

function get_local_currency(){
	echo '&#8358;'; // this is a naira currency
}

function user_data_role($user_data){
			
	$role_name = '';		

	if($user_data->role == 'Admin'){
		$role_name = 'admin';
	}

	if($user_data->role == 'Doctor'){
		$role_name = 'doctor';
	}

	if($user_data->role == 'Nurse'){
		$role_name = 'nurse';
	}

	if($user_data->role == 'Accountant'){
		$role_name = 'accountant';
	}

	if($user_data->role == 'Laboratorist'){
		$role_name = 'laboratorist';
	}

	if($user_data->role == 'Receptionist'){
		$role_name = 'receptionist';
	}

	if($user_data->role == 'Pharmacist'){
		$role_name = 'pharmacist';
	}

	return $role_name;
}