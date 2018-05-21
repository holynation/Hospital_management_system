<?php

$ci =& get_instance();
$ci->load->model('Model_staff');

function getsettingsdetails(){
	
	$ci =& get_instance();
	$s =$ci->Model_staff->settings_details();
	
	//print json_encode( $s );
	return $s;
}
 
function get_last_insert_id($table){
    $ci =& get_instance();
    $ci->db->select('id');
    $ci->db->from($table);
    $ci->db->order_by('id', 'DESC');
    $result = $ci->db->get();
    return ($result->num_rows() > 0 ) ? $result->row()->id : false;
}

// this should only be used when you've inserted the data you wanna notify
// so has to get the last insert id of the data in the table...
function put_notifice_json($table, $desc){
    if($table){
        $last_insert_id = get_last_insert_id($table);
        // $json_data = array($table => $last_insert_id);
        $json_data = array(
                'table' => $table,
                'id'    => $last_insert_id
        );
        $json_data = json_encode($json_data);
        $obj = & get_instance();

        $data = array(
            'foreign_table_id' => $json_data,
            'description' => $desc
        );

        $result = $obj->db->insert('notification',$data);
        if($result){
            return true;
        } 
    }
    
    return false;
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
		$cur_time = time();
        $time_elapsed = $cur_time - strtotime($date_of_birth);
        $seconds = $time_elapsed ;
        $minutes = round($time_elapsed / 60 );
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400 );
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640 );
        $years = round($time_elapsed / 31207680 ); 

        if($seconds <= 60){
         	return  "$seconds seconds ago";
        }
        else if($minutes <=60){
            if($minutes==1){
             	return  "one minute ago";
            }
            else{
             	return  "$minutes minutes ago";
            }
        }
        else if($hours <=24){
            if($hours==1){
             	return  "an hour ago";
            }
            else{
             	return  "$hours hours ago";
            }
        }
        else if($days <= 7){
            if($days==1){
             	return  "yesterday";
            }
            else{
             	return  "$days days ago";
            }
        }
        else if($weeks <= 4.3){
            if($weeks==1){
             	return  "a week ago";
            }
            else{
             	return  "$weeks weeks ago";
            }
        }
        else if($months <=12){
            if($months==1){
             	return  "a month ago";
            }
            else{
             	return  "$months months ago";
            }
        }
        else{
            if($years==1){
             	$today = date("Y-m-d");
			    $diff = date_diff(date_create($date_of_birth), date_create($today));
			    return $diff->format('%y') . ' year old';
            }
            else{
             	$today = date("Y-m-d");
			    $diff = date_diff(date_create($date_of_birth), date_create($today));
			    return $diff->format('%y') . ' years old';
            }
        }
}

function get_local_currency(){
	echo '&#8358;'; // this is a naira currency
}

function get_date_format($posted){
    if($posted){
        $date = strftime("%B %d, %Y", strtotime($posted));
        return $date;
    }
    return false;
}

function get_enum_value(){
    $db_obj = & get_instance();
    $sql = "SHOW COLUMNS FROM permission LIKE 'permissions'";
    $query = $db_obj->db->query($sql);
    $column = $query->row();
    $type = $column->Type;
    $output = str_replace("enum('", "", $type);
    $output = str_replace("')", "", $output);
    $results = explode("','", $output);
    return $results;
}

function get_user_permission($staff_id = null){
    $db_obj = & get_instance();
    $id = '';
    if($db_obj->session->has_userdata('staff_db_id'))
        $default_id = $db_obj->session->userdata('staff_db_id');
    if($staff_id != null){
        $id = $staff_id;
    }else{
        $id = $default_id;
    }

    $db_obj->db->select('*');
    $db_obj->db->from('permission');
    $db_obj->db->where('staff_id', $id);
    $result = $db_obj->db->get();
    if($result->num_rows() > 0 ){
        $row = $result->row();
        return $row;
    }else{
        return false; // return false (read) by default if not found at all
    }
}

function get_ehm_title(){
    $user_data = is_logged();
    $title = getsettingsdetails()->title;
    $user_role_value = '';
    if($user_data->status == 'success'){
      $user_role_value = get_user_role($user_data); 
    }
    else{ 
        $user_role_value = ' ';
    }

    return $title . ' | ' . $user_role_value . ' '. 'Dashboard ';
}

function get_user_role($user_data){
    $db_obj = & get_instance();
	$role_name = '';		

    $role_id = $user_data->role;

    $db_obj->db->select('*');
    $db_obj->db->from('role');
    $db_obj->db->where('id', $role_id);
    $result = $db_obj->db->get();

    if($result->num_rows() > 0){
        $row = $result->row();
        $role_name =  $row->role_name;
    }else{
        die('No result found on the role');
    }

	return $role_name;
}

function check_all_access(){
    $user_data = is_logged();
    $permission = get_user_permission($user_data->id);
    // print_r($permission);

    if(!$permission){
        include (APPPATH.'views/restriction/intrude.php');
        // $this->load->view('restriction/intrude');
        exit;
    }else if(!$user_data){
        redirect('/welcome/');
    }else if ($permission->permissions != 'w'){
        include (APPPATH.'views/restriction/intrude.php');
        // $this->load->view('restriction/intrude');
        exit;
    }

    return $user_data;
}