<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {
	private $loggedIn;
	private $checkRole;
	private $roleName;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_staff');
		$this->load->model('Model_patient');
		$this->load->model('Model_schedule');

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
		if(!($this->get_role_name() == 'admin' || $this->get_role_name() == 'doctor')){
			$this->load->view('restriction/intrude');
			exit;
		}
	}

	public function create(){
		$this->check_permission();

		$config = array(
				array(
					'field' => 'doctor_name',
					'label' => 'doctor name',
					'rules' => 'required'
				),
				array(
					'field' => 'available_days',
					'label' => 'available days',
					'rules' => 'required'
				),
				array(
					'field' => 'available_time_start',
					'label' => 'available time start',
					'rules' => 'required'
				),
				array(
					'field' => 'available_time_end',
					'label' => 'available time end',
					'rules' => 'required'
				)
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == false){
			$doctors = $this->get_doctor();
			$data['data_doctors'] = $doctors;
			$this->load->view('schedule/add_schedule', $data);
		}else{
			//perform appointment
			$data_input = array(
				'doctor_id' => $this->input->post('doctor_name'),
				'available_days' => $this->input->post('available_days'),
				'available_time_start' => $this->input->post('available_time_start'),
				'available_time_end' => $this->input->post('available_time_end'),
				'date_created' => date('Y-m-d H:i:s')
			);

			$result = $this->Model_schedule->put_schedule($data_input);
			if(!$result){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('schedule/add_schedule',$data);
				exit;
			}

			$this->session->set_flashdata('success', 'You have successfully made a schedule...');
			redirect('/schedule/view_schedule', 'refresh');
		}
		
	}

	public function view_schedule(){
		$this->check_permission();
		$result = $this->Model_schedule->view_schedule();
		// print_r($result);
		$data['data_schedule'] = $result;
		$this->load->view('schedule/view_schedule', $data);
	}

	public function get_doctor(){
		return $this->Model_schedule->get_doctors();
	}

}