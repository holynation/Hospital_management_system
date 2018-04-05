<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller{
	private $loggedIn;
	private $checkRole;
	private $roleName;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_staff');
		$this->load->model('Model_role');

		if($this->session->userdata('isLoggedIn')){
			$this->loggedIn = true;

			if($this->session->userdata('staff_db_id')){
				$id = $this->session->userdata('staff_db_id');
				$this->Model_staff->find_id($id);
				$user = $this->Model_staff->data();
				$this->checkRole = $user;
				$this->get_role();
			}

		}else{
			$this->loggedIn = false;
		}
	}

	public function index(){
		if($this->loggedIn === true){
			redirect('/welcome/');
		}else{
			// session destroy or not login yet
			$this->Model_staff->logout();
			$this->load->view('login/login');
		}
	}

		public function get_role(){
		if($this->checkRole->role == 'Admin'){
			$this->roleName = 'admin';
		}

		if($this->checkRole->role == 'Doctor'){
			$this->roleName = 'doctor';
		}

		if($this->checkRole->role == 'Nurse'){
			$this->roleName = 'nurse';
		}

		if($this->checkRole->role == 'Accountant'){
			$this->roleName = 'accountant';
		}

		if($this->checkRole->role == 'Laboratorist'){
			$this->roleName = 'laboratorist';
		}

		if($this->checkRole->role == 'Receptionist'){
			$this->roleName = 'receptionist';
		}

		if($this->checkRole->role == 'Pharmacist'){
			$this->roleName = 'pharmacist';
		}	
	}

	public function get_role_name(){
		return $this->roleName;
	}

	public function check_permission(){
		if($this->get_role_name() != 'admin'){
			$this->load->view('restriction/intrude');
			exit;
		}
	}

	public function create(){
		$this->check_permission();
		$config = array(
			array(
					'field' => 'role_name',
					'label' => 'role name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'role_info',
					'label' => 'role info',
					'rules' => 'trim|required'
				)
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() == false){
			$this->load->view('role/create');
		}else{
			//perform action
			$data = array(
                'role_name' => $this->input->post('role_name'),
                'description' => $this->input->post('role_info'),
                'date_created' => date('Y-m-d H:i:s')
            );

			$register = $this->Model_role->put_role($data);
			if(!$register){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('role/create', $data);
				exit;
			}
			$this->session->set_flashdata('success', 'You have successfully added a role...');
			redirect('/role/view_role/', 'refresh');
		}
	}

	public function view_role(){
		$result = $this->Model_role->view_role();
		// print_r($result);
		$data['data_role'] = $result;
		$data['permission'] = $this->get_role_name();
		$this->load->view('role/view_role',$data);
	}

	public function delete($id){
		$task = $_POST['delete'];
		if(isset($task)){

			$id = trim($id);

			$deleted = $this->Model_role->delete_role($id);

			if(!$deleted){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Deleted';
		}
	}

}