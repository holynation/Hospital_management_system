<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends CI_Controller{
	private $loggedIn;
	private $checkRole;
	private $roleName;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_staff');
		$this->load->model('Model_department');

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
		$user_data = is_logged();
		$role = get_user_role($user_data);
		$role = strtolower($role);
		if($role){
			$this->roleName = $role;
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
		// $this->check_permission();
		$config = array(
			array(
					'field' => 'department_name',
					'label' => 'department name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'department_info',
					'label' => 'department info',
					'rules' => 'trim|required'
				)
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() == false){
			$this->load->view('department/add_department');
		}else{
			//perform action
			$data = array(
                'department_name' => $this->input->post('department_name'),
                'description' => $this->input->post('department_info'),	
                'date_created' => date('Y-m-d H:i:s')
            );

			$register = $this->Model_department->put_department($data);
			if(!$register){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('department/add_department', $data);
				exit;
			}
			$this->session->set_flashdata('success', 'You have successfully added a department...');
			redirect('/department/view_department/', 'refresh');
		}
	}

	public function view_department(){
		$result = $this->Model_department->view_department();
		// print_r($result);
		$data['data_department'] = $result;
		$data['permission'] = $this->get_role_name();
		$this->load->view('department/view_department',$data);
	}

	public function edit(){
		if(isset($_POST['edit'])){
			$id = trim($_POST['id']);
			$department = $_POST['department_name'];
			$desc = $_POST['desc_info'];

			$data = array(
				'department_name' => $department,
				'description' => $desc,
			);

			$updated = $this->Model_department->update_department($id,$data,'department');

			if(!$updated){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Updated';
		}
	}

	public function delete($id){
		$task = $_POST['delete'];
		if(isset($task)){

			$id = trim($id);

			$deleted = $this->Model_department->delete_department($id);

			if(!$deleted){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Deleted';
		}
	}

}