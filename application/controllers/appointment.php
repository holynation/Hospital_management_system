<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointment extends CI_Controller {
	private $loggedIn;
	private $checkRole;
	private $roleName;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_staff');
		$this->load->model('Model_patient');
		$this->load->model('Model_appointment');
		$this->load->library('hash_created');
		$this->load->library('DateCreate');

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

	public function create($id){
		$id = trim($id);
		$config = array(
				array(
					'field' => 'department',
					'label' => 'department',
					'rules' => 'required'
				),
				array(
					'field' => 'doctor_name',
					'label' => 'doctor name',
					'rules' => 'required'
				),
				array(
					'field' => 'appointment_date',
					'label' => 'appointment',
					'rules' => 'required'
				)
				// array(
				// 	'field' => 'complaint',
				// 	'label' => 'complaint',
				// 	'rules' => 'trim|required'
				// )
		);
		$this->form_validation->set_rules($config);
		$data['departments'] = $this->Model_staff->get_department();
		if($data['departments'] == 'no result'){
			$data['error'] = 'Please create a list of department for the system...';
			$this->load->view('appointment/add_appointment',$data);
			exit;
		}
		$result = $this->Model_patient->view_patient_where($id);
		if(!$result){
			// echo 'There is an error with the info from the db...';
			$this->show_restrict();
			exit;
		}

		$data['data_patient'] = $result;
		if($this->form_validation->run() == false){
			$this->load->view('appointment/add_appointment',$data);
		}else{
			//perform appointment
			$data = array(

				'patient_id' => $this->input->post('patient_id'),
				'department' => $this->input->post('department'),
				'doctor_name' => $this->input->post('doctor_name'),
				'appointment_date' => $this->input->post('appointment_date'),
				// 'complaint' => $this->input->post('complaint'),
				'type' => $this->input->post('type'),
				'status' => 'false', // this let us know if appointment had been checked in by doctor by sendin a checked response
				'date_created' => date('Y-m-d H:i:s')

			);

			$result = $this->Model_appointment->put_appointment($data);
			if(!$result){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('appointment/add_appointment',$data);
				exit;
			}

			$this->session->set_flashdata('success', 'You have successfully booked an appointment...');
			redirect('/appointment/view_appoint/', 'refresh');
		}
		
	}

	public function createOutPatient(){
		$this->load->view('appointment/create_out_patient');
	}

	public function create_direct($id){
		$id = trim($id);
		$config = array(
				array(
					'field' => 'department',
					'label' => 'department',
					'rules' => 'required'
				),
				array(
					'field' => 'doctor_name',
					'label' => 'doctor name',
					'rules' => 'required'
				)
				// array(
				// 	'field' => 'complaint',
				// 	'label' => 'complaint',
				// 	'rules' => 'trim|required'
				// )
		);
		$this->form_validation->set_rules($config);
		$data['departments'] = $this->Model_staff->get_department();
		$result = $this->Model_patient->view_patient_where($id);
		if(!$result){
			// echo 'There is an error with the info from the db...';
			$this->show_restrict();
			exit;
		}

		$data['data_patient'] = $result;
		if($this->form_validation->run() == false){
			$this->load->view('appointment/add_appointment',$data);
		}else{
			//perform appointment
			$data = array(

				'patient_id' => $this->input->post('patient_id'),
				'department' => $this->input->post('department'),
				'doctor_name' => $this->input->post('doctor_name'),
				'appointment_date' => date('Y-m-d H:i:s'),
				// 'complaint' => $this->input->post('complaint'),
				'type' => $this->input->post('type'),
				'status' => 'true',
				'date_created' => date('Y-m-d H:i:s')

			);

			$result = $this->Model_appointment->put_appointment($data);
			if(!$result){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('appointment/add_appointment',$data);
				exit;
			}

			$this->session->set_flashdata('success', 'You have successfully booked an appointment...');
			redirect('/appointment/view_appoint/', 'refresh');
		}
		
	}

	public function load_doctor(){
		$id = $_POST['department_id'];
		$data_result = '';

		$data = $this->Model_appointment->get_doctor_by_department($id,'Doctor');

		if($data == 'no result'){ ?>

			<select id="doctor_name" name="doctor_name" class="form-control">
				<option value="">  </option>
				<option value=""> no doctor available... </option>
            </select>

		<?php	exit;}

		$data_result = $data->result();

		if(!$data_result){
		 	echo '';
		}else{ ?>

			<select id="doctor_name" name="doctor_name" class="form-control">
				<?php  foreach($data_result as $d){ ?>
					<option value="">  </option>
                	<option value="<?php echo $d->id; ?>"> Dr. <?php echo $d->first_name, ' ', $d->last_name; ?> </option>
        		<?php } ?>
            </select>
			
		<?php }
	}

	public function load_doctor_1(){
		$id = $_POST['department_id'];
		$data_result = '';

		$data = $this->Model_appointment->get_doctor_by_department($id,'Doctor');

		if($data == 'no result'){ ?>

			<select id="doctor_name_3" name="doctor_name" class="form-control">
				<option value="">  </option>
				<option value=""> no doctor available... </option>
            </select>

		<?php	exit;}

		$data_result = $data->result();

		if(!$data_result){
		 	echo '';
		}else{ ?>

			<select id="doctor_name_3" name="doctor_name" class="form-control" onchange="load_schedule();">
					<option value="">  </option>
					<?php  foreach($data_result as $d){ ?>
                	<option value="<?php echo $d->id; ?>"> Dr. <?php echo $d->first_name, ' ', $d->last_name; ?> </option>
        			<?php } ?>
            </select>

            <script>
                function load_schedule(){
                    var data = $('#doctor_name_3').val();
                    $.post('<?php echo base_url();?>appointment/load_doctor_schedule', { doctor_id: data },
                      function(result){
                        // console.log(result);
                        $('#feedbackschedule').html(result).show();
                        $('#doctor_name2').hide();
                    });
                }
                
            </script>
			
		<?php }
	}

	public function load_doctor_schedule(){
		$id = $_POST['doctor_id'];
		$data_result = '';

		$data = $this->Model_appointment->get_doctor_by_schedule($id);

		if($data == 'no result'){ ?>

			<div class="col-sm-10">
			 	<p> Dr. not available... </p>
            </div>

		<?php	exit;}

		$data_result = $data->result();

		if(!$data_result){
		 	echo '';
		}else{ ?>

			<div class="col-sm-12">
				<?php  foreach($data_result as $d){ ?>
		            <span id="schedule-span" class="text text-success" style="padding-left:15%;"><i class="fa fa-fw ti-calendar"></i> 
		            	<ul style="padding-left: 20.5% ;margin-top: -5.5%; ">
		                    <li> <?php echo $d->available_days, ' ( ' , $d->available_time_start, ' - ', $d->available_time_end, ' ) ' ;  ?> </li>
		                </ul>
		            </span>
	            <?php } ?>
        	</div>
			
		<?php }
	}

	public function view_appoint(){
		$result = $this->Model_appointment->view_appointment();
		// print_r($result);

		$data['data_appointment'] = $result;
		$data['permission'] = $this->get_role_name();
		$this->load->view('appointment/view_appoint',$data);
	}

	public function search_patient(){
		if(isset($_GET['search'])){
			$name = $_GET['search'];
			$name = trim($name);

			$result = $this->Model_appointment->search_name($name);
			if($result == NULL){
				echo '';
			}

			if(!$result){
				echo " ";
			}else{ 
				$data['search_result'] = $result;
				$this->view_search($result);
			}
		}
	}

	public function view_search($result){
		if(isset($result)){
			$data['search_result'] = $result;
			$data['from'] = 'data_patient_appointment';
			$this->load->view('search_result_patient', $data);
		}
		
		return false;
	}

	public function edit_appointment($id){
		$id = trim($id);
		$result = $this->Model_appointment->get_appointment_by_id($id);
		if(!$result){
			// echo 'There is an error with the info from the db...';
			$this->show_restrict();
			exit;
		}
		$data['departments'] = $this->Model_staff->get_department();
		$data['data_appointment'] = $result;
		$this->load->view('appointment/edit_appointment', $data);
	}

	public function update_appointment(){
			$id = $this->input->post('patient_update_id');
			if(isset($_POST['btnAppointUpdate'])){
				$data = array(
					'appointment_date' => $this->input->post('appointment_date'),
					'complaint' => $this->input->post('complaint'),
					'type' => $this->input->post('type'),
					'date_modified' => date('Y-m-d H:i:s')
	            );

	            $updated = $this->Model_appointment->update_appointment($id, $data);

	            if(!$updated){
	            	$data['error'] = 'There is an error updating...';
	            	$this->load->view('appointment/edit_appointment');
					exit;
	            }
                   
                $this->session->set_flashdata('success', 'You have successfully rescheduled the appointment...');
				redirect('/appointment/view_appoint/', 'refresh');
			}
	}

	public function delete($id){
		$this->check_permission();
		$task = $_POST['delete'];
		if(isset($task)){

			$id = trim($id);

			$deleted = $this->Model_appointment->delete_appointment($id);

			if(!$deleted){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Deleted';
			redirect('appointment/view_appoint/', 'refresh');
		}
	}

	public function show_restrict(){
		$this->load->view('restriction/block');
	}

}