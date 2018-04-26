<?php
class Model_staff extends CI_Model{

	private $_data;

	function __construct(){
		parent::__construct();
		$this->load->library('hash_created');
		$this->load->library('cookiecreate');
		$this->load->helper('cookie');
	}

  function put_general($table, $fields = array()){
    $put = $this->db->insert($table, $fields);
    return ($put) ? true : false; 
  }

  function view_general($table){
    $sql = "SELECT * FROM  $table ORDER BY id DESC";
    $result = $this->db->query($sql);
    $row = $result->result();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  function update_general($id, $data, $table){
    $this->db->where('id', $id);
    $update = $this->db->update($table, $data);
    return ($update) ? true : false;
  }

  function get_general_by_id($table,$id){
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where('id', $id);
    $this->db->order_by('id', 'desc');
    $query = $this->db->get();
    $result = $query->result();

    return ($query->num_rows() > 0) ? $result : 'no result';

  }

  function get_notify(){
    $this->db->select('*');
    $this->db->from('notification');
    // $this->db->where('status', 'false');
    $this->db->order_by('id', 'desc');
    $query = $this->db->get();
    $result = $query->result();
    return ($query->num_rows() > 0) ? $result : 'no result';
  }

  function get_notify_where(){
    $this->db->select('*');
    $this->db->from('notification');
    $this->db->where('status', 'false');
    $this->db->order_by('id', 'desc');
    $query = $this->db->get();
    $result = $query->result();
    return ($query->num_rows() > 0) ? $result : 'no result';
  }

  function delete_general($table,$id){
    $this->db->where('id', $id);
    $this->db->delete($table);

    if($this->db->affected_rows()){
      return true;
    }else{
      return false;
    }
  }

	function find($user = null){
 		if($user){
 			$field = (is_numeric($user)) ? 'id' : 'staff_username';
 		    $data = $this->db->get_where('staff', array($field => $user));
 		 
 		   if($data->num_rows() > 0){
 		   	  $this->_data = $data->row(); // setting the data value of a user to making it public
 		   	   return true;
 		   }	
 		}

  	 	return false;		
  	}

  	function find_id($user = null){
 		if($user){
 			$field = (is_numeric($user)) ? 'id' : 'staff_id';
 		    $data = $this->db->get_where('staff', array($field => $user));
 		 
 		   if($data->num_rows() > 0){
 		   	  $this->_data = $data->row(); // setting the data value of a user to making it public
 		   	   return true;
 		   }	
 		}

  	 	return false;		
  	}

	function login($data, $remember = false){
		// this aspect is for remember me function
		if($this->exists()){
    		$session_data = array(
              'username' => $this->data()->staff_username,
              'staff_db_id' => $this->data()->id,
              'staff_id' => $this->data()->staff_id,
              'isLoggedIn' => TRUE
            );

        $this->session->set_userdata($session_data);
    }else{
	// grab user input

		//print_r($data);exit;
		unset($data['log_show']);	// this is the name attribute for the button clicked for login section

    	$username = $data['staff_username'];
        $password = $data['password'];
		$remember = '';

		if(isset($data['rememberme'])){

        	$remember = $data['rememberme'];

		}

		$user = $this->find($username); // this find the username in the database

		if($user){
			if($this->hash_created->decode_password($password, $this->data()->password)){
				// setting user session
				$session_data = array(
                  'username' => $this->data()->staff_username,
                  'staff_db_id' => $this->data()->id,
                  'staff_id' => $this->data()->staff_id,
                  'isLoggedIn' => TRUE
                );

				$this->session->set_userdata($session_data);

				// if remember me function is activated
               	if($remember == 'on' && $remember != ''){
                   $hash = $this->hash_created->unique();
                   $hashCheck = $this->db->get_where('users_session', array('staff_id' => $this->data()->staff_id));

                    if(!$hashCheck->num_rows){
                        $this->db->insert('users_session', array(
                          'staff_id' =>  $this->data()->staff_id,
                          'ip_address'	 => $this->input->ip_address(),
                          'hash'    =>  $hash
                          ));
                    }else{
                        $hash = $hashCheck->row()->hash;
                    }
                      // setting the cookie
                    $cookie = array(
		                'name'   => $this->config->item('cookie_name'), // username cookie_hash
		                'value'  => $hash,
		                'expire' => $this->config->item('cookie_expiry') // the expiry date is a day privilege
		            );

			        $this->input->set_cookie($cookie);
					// $this->input->cookie('username', false);

               	} // end remember me function
               		echo 1;
  	 		 		return true;
  	 		}else{
  	 			return 3; //  incorrect password
				return false;
  	 		}
		}else{
			// not found, can't find the username
			return 2;
			return false;
		}
	}
		return 4; // if nothing, can't login
		return false;
	}

	function exists(){
       return (!empty($this->_data)) ? true : false;
    }

	function data(){
  	 	return $this->_data;
  	}

  	function check_attempt(){
  		$ip = $this->input->ip_address();
		  $user_agent = $this->input->user_agent();
  		$query = "Select * from login_attempt where ip_address = '".$ip."' OR user_agent = '".$user_agent."' ";
  		$result = $this->db->query($query);
  		if($result->num_rows() > 0){
  			return true;
  		}else{
  			return false;
  		}
  	}

  	function user_exists($username,$field){
		$this->db->select('*');
        $this->db->from('staff');
        $this->db->where($field, $username);
        $result = $this->db->get();
        $row = $result->row(); // this return a single result

		return ($result->num_rows() === 1 && $row->staff_username) ? true : false;
	}

  	function email_exists($email){
		$sql = 'SELECT first_name,email FROM staff WHERE email = "' . $email . '" LIMIT 1';
		$result = $this->db->query($sql);
		$row = $result->row();

		return ($result->num_rows() === 1 && $row->email) ? $row->first_name : false;
	}

	function verify_reset_password_code($email, $code){
		$sql = 'SELECT first_name,email FROM staff WHERE email = "'. $email . '" ';
		$result = $this->db->query($sql);
		$row = $result->row();

		if($result->num_rows() === 1){
			return ($code == md5($this->config->item('salt') . $row->first_name )) ? true : false;
		}else{
			return false;
		}
	}

	function update_password($email,$password){

		$data = array(
				'password' => $password
			);

		$this->db->where('email', $email);
		$this->db->update('staff', $data);

		if($this->db->affected_rows() === 1){
			return true;
		}else{
			return false;
		}

	}

  function update_appointment_status($id, $data = array()){
    $this->db->where('id', $id);
    $update = $this->db->update('appointment', $data);
    return ($update) ? true : false;
  }

	function delete_login_attempt(){
		$ip = $this->input->ip_address();
		$user_agent = $this->input->user_agent();
		$this->db->where('ip_address', $ip);
    $this->db->or_where('user_agent =', $user_agent);
		$this->db->delete('login_attempt');

		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

  function get_today_db($from){
     $date = new DateTime("now");

     $curr_date = $date->format('Y-m-d ');

     $this->db->select('*');
     $this->db->from($from); 
     $this->db->where('DATE(date_created)',$curr_date);//use date function
     $result = $this->db->get();
     $count_today_appoint = $result->num_rows();
      return ($result->num_rows() > 0) ? $count_today_appoint : 'no result';
  }

  function get_today_doctor($from){
     $date = new DateTime("now");

     $curr_date = $date->format('Y-m-d ');

     $this->db->select('*');
     $this->db->from('role'); 
     $this->db->join($from, $from .'.'.'role = role.id'); 
     // $this->db->where('DATE(date_created)',$curr_date);//use date function
     $this->db->where('role_name', 'Doctor');
     $result = $this->db->get();
     $count_today_appoint = $result->num_rows();
      return ($result->num_rows() > 0) ? $count_today_appoint : 'no result';
  }

	function put_staff($fields = array()){
 		$put = $this->db->insert('staff', $fields);
 		return ($put) ? true : false; 
 	}

  function create_permission($fields = array()){
    $put = $this->db->insert('permission', $fields);
    return ($put) ? true : false; 
  }

 	function view_staff(){
 		// $sql = 'SELECT * FROM staff';
    $this->db->select();
    $this->db->from('role');
    $this->db->join('staff', 'staff.role = role.id');
    $this->db->where('role_name !=', 'Admin');
    $this->db->order_by('staff.id','DESC');
		$result = $this->db->get();
		$row = $result->result();

		return ($result->num_rows() > 0) ? $row : 'no result';
 	}

  function view_detail_where($id){
    $get = $this->db->get_where('staff', array('id' => $id), 1)->result();
    return ($get) ? $get : false;
  }

  function view_staff_in_role(){
    // $sql = 'SELECT * FROM staff';
    $this->db->select();
    $this->db->from('staff');
    $this->db->order_by('id','DESC');
    $result = $this->db->get();
    $row = $result->result();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  function get_doctor_appointment($id){
    $this->db->select();
    $this->db->from('appointment');
    $this->db->where('doctor_name', $id);
    $this->db->order_by('id','DESC');
    $result = $this->db->get();
    $row = $result->result();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  function get_department(){
    $sql = 'SELECT * FROM department';
    $result = $this->db->query($sql);
    $row = $result->result();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  function get_recent_staff(){
    $this->db->select();
    $this->db->from('staff');
    $this->db->order_by('id','DESC');
    $this->db->limit(1);
    $result = $this->db->get();
    $row = $result->result();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  function get_roles(){
    $sql = 'SELECT * FROM role';
    $result = $this->db->query($sql);
    $row = $result->result();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  function get_role_id($id){
    $this->db->select('*');
    $this->db->from('role');
    $this->db->where('id', $id);
    $result = $this->db->get();
    $row = $result->row();

    return ($result->num_rows() > 0) ? $row : 'no result';
  }

  function get_depart_name($id){
    return $this->db->get_where('department', array('id' => $id));
  }

  function get_patient_by_id($id){
    return $this->db->get_where('patient', array('id' => $id));
  }

  	function custom_template_mail($to,$sub,$name,$email,$code){
        $row = $this->db->get('settings')->row();
        $this->load->library('email');
        $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => $row->smtp_host,//'',
                'smtp_port' => 25,
                'smtp_user' =>  $row->smtp_username,//'', // change it to yours
                'smtp_pass' =>  $row->smtp_password,//'', // change it to yours
                'smtp_timeout'=>  20,
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
               );

        $this->email->initialize($config);// add this line
        $this->email->set_newline("\r\n");

        $data = array(
          'name' => $name,
          'email' => $email,
          'email_code' => $code
        );

        $body = $this->load->view('templates/email', $data,TRUE);

        $this->email->from($this->config->item('hot_email'), $this->config->item('hot_email'));
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($body);  
        if($this->email->send()){
          return "success";
        } else {
          return 1;
        }
  }

  function send_mail($to,$sub, $msg){
		// $this->db->order_by("id","desc");
		    $row = $this->db->get('settings')->row();
        $this->load->library('email');
        $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => $row->smtp_host,//'',
                'smtp_port' => 25,
                'smtp_user' => 	$row->smtp_username,//'', // change it to yours
                'smtp_pass' =>  $row->smtp_password,//'', // change it to yours
                'smtp_timeout'=>  20,
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
               );

        $this->email->initialize($config);// add this line
        $this->email->set_newline("\r\n");
        $data = array(
          'name' => $name,
          'email' => $email,
          'email_code' => $code
        );
        $body = $this->load->view('templates/email', $data,TRUE);

        $this->email->from($this->config->item('hot_email'), $this->config->item('hot_email'));
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($body);  
        if($this->email->send()){
        	return "success";
        } else {
        	return 1;
        }
 	}

 	function logout(){
		$id = $this->session->userdata('staff_id');
        $this->session->sess_destroy();
        if($this->cookiecreate->exists($this->config->item('cookie_name'))){
        	$this->db->delete('users_session', array('staff_id' => $id));
        	// $this->cookiecreate->delete($this->config->item('cookie_name'));
        	delete_cookie($this->config->item('cookie_name'));
        }
	}

	function get_state(){
    	$sql = "SELECT * FROM states ORDER BY id ASC";
     	return $this->db->query($sql);
  	}

  	function check_lga($id){
    	return $this->db->get_where('local_government', array('state_id' => $id));
  	}

  	function display_state($id){
        return $this->db->get_where('states', array('id' => $id))->row();
    }

    function view_staff_where($id){
      $get = $this->db->get_where('staff', array('id' => $id), 1)->result();
      return ($get) ? $get : false;
    }

    function update_staff($id, $data = array()){
      $this->db->where('id', $id);
      $update = $this->db->update('staff', $data);
      return ($update) ? true : false;
    }

    function update_staff_status($id, $data = array()){
      $this->db->where('id', $id);
      $update = $this->db->update('staff', $data);
      return ($update) ? true : false;
    }

    function settings_details(){
      $select_data = "*"; 
        $where_data = array(  // ----------------Array for check data exist ot not
          'id'     => 1
          );
          
        $table = "settings";  //------------ Select table
        $result = $this->get_table_where( $select_data, $where_data, $table );
        return $result;
    }

    function get_table_where( $select_data, $where_data, $table){
        
      $this->db->select($select_data);
      $this->db->where($where_data);
      
      $query  = $this->db->get($table); 
            //--- Table name = User
      $result = $query->row(); 
      
      return $result; 
     }

   function search_patient($item){
    if(empty($item)){
      return null;
    }

    if(isset($item)){
      $this->db->select();
      $this->db->from('patient');
      $this->db->like('first_name', $item, 'both');
      $this->db->or_like('last_name', $item);
      $this->db->or_like('middle_name', $item);
      $result = $this->db->get();
      $row = $result->result();

      return ($result->num_rows() > 0) ? $row : 'no result';
    }

    return false;
      
  }

    function update_settings($fields = array()){
      $this->db->where('id', 1);
      $update = $this->db->update('settings', $fields);
      return ($update) ? true : false; 
    }

    function get_settings(){
      $this->db->select('*');
      $this->db->from('settings');
      $this->db->where('id', 1);
      $result = $this->db->get();
      $row = $result->row();

      return ($result->num_rows() > 0) ? $row : 'no result';
    }
}