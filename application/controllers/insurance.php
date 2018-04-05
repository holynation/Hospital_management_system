<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insurance extends CI_Controller{
	private $loggedIn;
	private $checkRole;
	private $roleName;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_staff');
		$this->load->model('Model_patient');
		$this->load->model('Model_insurance');

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

	public function create_package(){
		$this->check_permission();
		$config = array(
			array(
					'field' => 'package_name',
					'label' => 'package name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'package_percentage',
					'label' => 'percentage',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'package_info',
					'label' => 'package info',
					'rules' => 'trim|required'
				)
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == false){
			$this->load->view('insurance/packages');
		}else{
			//perform action
			$data = array(
                'package_name' => trim($this->input->post('package_name')),
                'percentage' => $this->input->post('package_percentage'),	
                'description' => $this->input->post('package_info'),	
                'type' => $this->input->post('pack_type'),
                'date_created' => date('Y-m-d H:i:s')
            );

			$register = $this->Model_insurance->put_insurance('insurance',$data);
			if(!$register){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('insurance/packages', $data);
				exit;
			}
			$this->session->set_flashdata('success', 'You have successfully added a Package...');
			redirect('/insurance/view_package/', 'refresh');
		}
	}

	public function create_Nhis(){
		$this->check_permission();
		$config = array(
			array(
					'field' => 'package_name',
					'label' => 'package name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'package_percentage',
					'label' => 'percentage',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'package_info',
					'label' => 'package info',
					'rules' => 'trim|required'
				)
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == false){
			$this->load->view('insurance/nhis');
		}else{
			//perform action
			$data = array(
                'package_name' => trim($this->input->post('package_name')),
                'percentage' => $this->input->post('package_percentage'),	
                'description' => $this->input->post('package_info'),	
                'type' => $this->input->post('pack_type'),
                'date_created' => date('Y-m-d H:i:s')
            );

			$register = $this->Model_insurance->put_insurance('insurance',$data);
			if(!$register){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('insurance/nhis', $data);
				exit;
			}
			$this->session->set_flashdata('success', 'You have successfully added a NHIS Package...');
			redirect('/insurance/view_package/', 'refresh');
		}
	}

	public function edit_package(){
		if(isset($_POST['edit'])){
			$id = trim($_POST['id']);
			$name = $_POST['package_name'];
			$percent_package = $_POST['percentPackage'];
			$desc = $_POST['desc_info'];
			// $name = $this->checkRole->role . ' ' . $this->checkRole->first_name . ' ' . $this->checkRole->last_name;
			$data = array(
				'package_name' => $name,
				'percentage' => $percent_package,
				'description' => $desc,
				'date_modified' => date('Y-m-d H:i:s')
			);

			$updated = $this->Model_insurance->update_insurance($id,$data,'insurance');

			if(!$updated){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Updated';
		}
	}

	public function view_package(){
		$result = $this->Model_insurance->view_insurance('insurance');
		// print_r($result);
		$data['data_insurance'] = $result;
		$data['permission'] = $this->get_role_name();
		$this->load->view('insurance/view_package',$data);
	}

	public function edit_medicine($id){
		$id = trim($id);

		$result = $this->Model_pharmacy->get_medicine_by_id($id);
		// print_r($result);
		if(!$result){
			// echo 'There is an error with the info from the db...';
			$this->show_restrict();
			exit;
		}
		$data['data_medicine'] = $result;
		$data['category'] = $this->Model_pharmacy->get_category();

		$this->load->view('pharmacy/edit_medicine', $data);
	}

	public function delete($id){
		$action = $_POST['delete'];
		// $task = $_POST['task'];
		if(isset($action)){
				$id = trim($id);

				$deleted = $this->Model_insurance->delete_insurance($id,'insurance');

				if(!$deleted){
					echo 'Error performing the operation';
					exit;
				}

				echo 'Deleted';
				exit;
		}

	}

	public function show_restrict(){
		$this->load->view('restriction/block');
	}

}