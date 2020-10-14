<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckPermission {
	private static $checkRole;
	private $roleName;
	protected $CI;

    public function __construct(){
    	$this->CI =& get_instance();
		$this->CI->load->model('Model_staff');
		$this->CI->load->library('session');

		if($this->CI->session->userdata('isLoggedIn')){

			if($this->CI->session->userdata('staff_db_id')){
				$id = $this->CI->session->userdata('staff_db_id');
				$this->CI->Model_staff->find_id($id);
				$user = $this->CI->Model_staff->data();
				self::checkRole = $user;
				$this->get_role();
			}
		}else{
			// logout
		}
	}

    public static function get_role(){
		if(self::checkRole->role == 'Admin'){
			$this->roleName = 'admin';
		}

		if(self::checkRole->role == 'Doctor'){
			$this->roleName = 'doctor';
		}

		if(self::checkRole->role == 'Nurse'){
			$this->roleName = 'nurse';
		}

		if(self::checkRole->role == 'Accountant'){
			$this->roleName = 'accountant';
		}

		if(self::checkRole->role == 'Laboratorist'){
			$this->roleName = 'laboratorist';
		}

		if(self::checkRole->role == 'Receptionist'){
			$this->roleName = 'receptionist';
		}

		if(self::checkRole->role == 'Pharmacist'){
			$this->roleName = 'pharmacist';
		}	
	}

	public static function get_role_name(){
		return $this->roleName;
	}

	public static function check_permission(){
		if(self::get_role_name() != 'admin'){
			$this->CI->load->view('restriction/intrude');
			exit;
		}
	}
}