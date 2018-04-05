<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ward extends CI_Controller {
	private $loggedIn;
	private $userDataModify;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_staff');
		$this->load->model('Model_patient');
		$this->load->model('Model_ward');
		$this->load->library('hash_created');
		$this->load->library('DateCreate');

		if($this->session->userdata('isLoggedIn')){
			$this->loggedIn = true;
			if($this->session->userdata('staff_db_id')){
				$id = $this->session->userdata('staff_db_id');
				$this->Model_staff->find_id($id);
				$user = $this->Model_staff->data();
				$this->userDataModify = $user;
			}
		}else{
			$this->Model_staff->logout();
			$this->load->view('login/login');
			exit;
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

	public function create(){
		$config = array(
				array(
					'field' => 'ward_name',
					'label' => 'ward name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'category',
					'label' => 'category',
					'rules' => 'required'
				),
				array(
					'field' => 'description',
					'label' => 'description',
					'rules' => 'trim|required'
				),array(
					'field' => 'no_of_bed',
					'label' => 'no. of bed',
					'rules' => 'required'
				),
				array(
					'field' => 'charge',
					'label' => 'charge',
					'rules' => 'required'
				)
		);

		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == false){
			$this->load->view('ward/add_ward');
		}else{
			//perform ward
			$data = array(
				'ward_name' => $this->input->post('ward_name'),
				'no_of_bed' => $this->input->post('no_of_bed'),
				'category' => $this->input->post('category'),
				'description' => $this->input->post('description'),
				'charge' => $this->input->post('charge'),
				'status' => 'Active', 
				'date_created' => date('Y-m-d H:i:s')
			);

			$result = $this->Model_ward->put_ward($data);
			if(!$result){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('ward/add_ward',$data);
				exit;
			}

			$this->session->set_flashdata('success', 'You have successfully added a ward...');
			redirect('/ward/view_ward/', 'refresh');
		}
		
	}

	public function view_ward(){
		$result = $this->Model_ward->view_ward();
		// print_r($result);

		$data['data_ward'] = $result;
		$this->load->view('ward/view_ward',$data);
	}

	public function edit_ward($id){
		$id = trim($id);
		$result = $this->Model_ward->get_ward_by_id($id);
		if(!$result){
			// echo 'There is an error with the info from the db...';
			$this->show_restrict();
			exit;
		}
		$data['data_ward'] = $result;
		$this->load->view('ward/edit_ward', $data);
	}

	public function edit_bed_assign($code,$id){
		if($code = substr(md5('ehm' . $id), 1,10)){
			$id = trim($id);
    		$result = $this->Model_ward->get_ward_assign_by_id($id);

			$data['data_patient'] = $result;
			$data['wards'] = $this->Model_ward->get_ward();
			$this->load->view('ward/edit_bed_assign', $data);
		}else{
			$this->show_restrict();
			exit;
		}
		
	}

	public function edit_bed_assign_update(){
		// if($this->input->post('btnUpdateBedAssign')){
			$id = $this->input->post('update_bed_id');
			$discharge_date = '';
			$name = '';
			if($this->userDataModify){
				$name = $this->userDataModify->role . ' ' . $this->userDataModify->first_name . ' ' . $this->userDataModify->last_name;
			}

			if(isset($_POST['discharge_date'])){
				$discharge_date = $this->input->post('discharge_date'); 
				$assign_date = $_POST['assign_date'];
				$charge = $_POST['charge'];
				$date = dateCreate::custom_difference($discharge_date, $assign_date);
				$total_amount = $charge * $date;

				$data = array(
					'ward_id' => $this->input->post('ward_type'),
					'assign_date' => $assign_date,
					'discharge_date' => $discharge_date,
					'no_of_day' => $date,
					'total_amount' => $total_amount,
					'description' => $this->input->post('description'),
					'date_modified' => date('Y-m-d H:i:s'),
					'modifier' => $name
				);
				$updated = $this->Model_ward->update_ward_discharge_status($id,$data);

				if(!$updated){
					echo 'Error performing the operation';
					exit;
				}

				$this->session->set_flashdata('success','You have successfully updated the data.');
				redirect('/ward/view_bed_assign/', 'refresh');
			}

				$assign_date = $_POST['assign_date'];

				$data = array(
					'ward_id' => $this->input->post('ward_type'),
					'assign_date' => $assign_date,
					'discharge_date' => $discharge_date,
					'description' => $this->input->post('description'),
					'date_modified' => date('Y-m-d H:i:s'),
					'modifier' => $name
				);

			$updated = $this->Model_ward->update_ward_discharge_status($id,$data);

			if(!$updated){
				echo 'Error performing the operation';
				exit;
			}

			$this->session->set_flashdata('success','You have successfully updated the data.');
			redirect('/ward/view_bed_assign/', 'refresh');
		// }
	}

	public function update_ward(){
			$id = $this->input->post('ward_update_id');
			if(isset($_POST['btnWardUpdate'])){

				if($this->userDataModify){
					$name = $this->userDataModify->role . ' ' . $this->userDataModify->first_name . ' ' . $this->userDataModify->last_name;
				}
				
				$data = array(
					'ward_name' => $this->input->post('ward_name'),
					'no_of_bed' => $this->input->post('no_of_bed'),
					'category' => $this->input->post('category'),
					'description' => $this->input->post('description'),
					'charge' => $this->input->post('charge'),
					'date_modified' => date('Y-m-d H:i:s'),
					'user_modified' => $name
		            );

	            $updated = $this->Model_ward->update_ward($id, $data);

	            if(!$updated){
	            	echo 'There is an error updating...';
					exit;
	            }
                   
                $this->session->set_flashdata('success', 'You have successfully updated the ward...');
				redirect('/ward/view_ward/', 'refresh');
			}
	}

	public function update_bed_assign(){
			$id = $this->input->post('ward_update_bed_id');
			if(isset($_POST['btnWardUpdate'])){

				if($this->userDataModify){
					$name = $this->userDataModify->role . ' ' . $this->userDataModify->first_name . ' ' . $this->userDataModify->last_name;
				}
				
				$data = array(
					'ward_name' => $this->input->post('ward_name'),
					'no_of_bed' => $this->input->post('no_of_bed'),
					'category' => $this->input->post('category'),
					'description' => $this->input->post('description'),
					'charge' => $this->input->post('charge'),
					'date_modified' => date('Y-m-d H:i:s'),
					'user_modified' => $name
		            );

	            $updated = $this->Model_ward->update_ward($id, $data);

	            if(!$updated){
	            	echo 'There is an error updating...';
					exit;
	            }
                   
                $this->session->set_flashdata('success', 'You have successfully updated the ward...');
				redirect('/ward/view_ward/', 'refresh');
			}
	}

	public function bed_assign($id){

		if(!$id){
			$this->show_restrict();
			exit;
		}
		
		$id = trim($id);
		$config = array(
				array(
					'field' => 'ward_type',
					'label' => 'ward type',
					'rules' => 'required'
				),
				array(
					'field' => 'assign_date',
					'label' => 'assign date',
					'rules' => 'required'
				),
				array(
					'field' => 'description',
					'label' => 'description',
					'rules' => 'required'
				)
		);

		$this->form_validation->set_rules($config);
		$data['wards'] = $this->Model_ward->get_ward();
		$result = $this->Model_patient->view_patient_where($id);
		if(!$result){
			// echo 'There is an error with the info from the db...';
			$this->show_restrict();
			exit;
		}

		$data['data_patient'] = $result;
		if($this->form_validation->run() == false){
			$this->load->view('ward/bed_assign',$data);
		}else{
			//perform assign
			$data = array(

				'patient_id' => $this->input->post('patient_id'),
				'ward_id' => $this->input->post('ward_type'),
				'assign_date' => $this->input->post('assign_date'),
				'description' => $this->input->post('description'),
				'assign_by' => $this->session->userdata('staff_db_id'),
				'status' => 'Active', 
				'discharge_status' => 'Inactive', 
				'date_created' => date('Y-m-d H:i:s')

			);

			$result = $this->Model_ward->put_ward_assign($data);
			if(!$result){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('ward/bed_assign',$data);
				exit;
			}

			
			$this->session->set_flashdata('success', 'You have successfully assigned a ward/bed...');
			redirect('/ward/view_bed_assign/', 'refresh');
		}
		
	}

	public function check_avaliabilty(){
		$id = $_POST['id'];

		$result = $this->Model_ward->get_ward_available($id);
		if($result == 'no result'){
			echo '';
		}else if($result->count > $result->no_of_bed){ ?>
			<div class="col-sm-12">
		            <span id="schedule-span" class="text text-danger" style="padding-left:15%;"><i class="fa fa-fw ti-close"></i> 
		            	<ul style="padding-left: 20.5% ;margin-top: -5.5%; ">
		                    <li> This ward is fully occupy... </li>
		                </ul>
		            </span>
		            <script type="text/javascript">
		            	$('#btnBedAssign').addClass('hidden');
		            </script>
	            <?php }else{
	            	$remainder = $result->no_of_bed - $result->count;
	            	 echo '<p class="text text-success text-center">There is still', ' ', $remainder, ' ', 'more space available...</p>';
	            	echo  '<script type="text/javascript">
		            	$("#btnBedAssign").removeClass("hidden");
		            </script>';
	            } ?>
        	</div>
		<?php 
	}

	public function view_bed_assign(){
		$bed_list = $this->Model_ward->get_bed_assign_list(); 

		$data['data_ward_list'] = $bed_list;
		$this->load->view('ward/view_bed_assign', $data);
	}

	public function discharge_date($id){
		// $this->check_permission();
		$id = trim($id);
    		$result = $this->Model_ward->get_patient_ward_by_id($id);

    		if(isset($_POST['btnUpdateDischargeDate'])){
			$id = $this->input->post('patient_bed_id');
			$charge = $this->input->post('charge');
			$discharge_date = trim($this->input->post('discharge_date'));
			$assign_date = $_POST['assign_date'];
			$date = dateCreate::custom_difference($discharge_date, $assign_date);

			$total_amount = $charge * $date;
			
			$data = array(
					'discharge_date' => $discharge_date,
					'no_of_day' => $date,
					'total_amount' => $total_amount,
					'discharge_status' => 'Active'
				);

			$updated = $this->Model_ward->update_ward_discharge_status($id,$data);

			if(!$updated){
				echo 'Error performing the operation';
				exit;
			}

			$this->session->set_flashdata('success','You have successfully updated the discharge date.');
			redirect('/ward/view_bed_assign/', 'refresh');
		}

			$data['data_patient'] = $result;
			$this->load->view('ward/discharge_date', $data);
	}

	public function discharge_date_status(){
		if(isset($_POST['task'])){
			if(isset($_POST['discharge_date'])){
				if($_POST['discharge_date'] == ''){
					echo ' ';
				}else{
					$assign_date = $_POST['assign_date'];
					$discharge_date = $_POST['discharge_date'];
					$date = dateCreate::custom_difference($discharge_date, $assign_date);
					if($date == 1){
						echo $date, ' ', 'day'; 
					}else{
						echo $date, ' ', 'days';
					}
					
				}
				
			}
		}
	}

	public function update_discharge_date(){
		if(isset($_POST['btnUpdateDischargeDate'])){
			$id = $this->input->post('patient_bed_id');
			$charge = $this->input->post('charge');
			$discharge_date = trim($this->input->post('discharge_date'));
			$assign_date = $_POST['assign_date'];
			$date = dateCreate::custom_difference($discharge_date, $assign_date);
			$no_of_days = '';
			// if($date == 1){
			// 	$no_of_days = $date . ' ' . 'day'; 
			// }else{
			// 	$no_of_days = $date . ' ' . 'days';
			// }

			$total_amount = $charge * $date;
			
			$data = array(
					'discharge_date' => $discharge_date,
					'no_of_day' => $date,
					'total_amount' => $total_amount,
					'discharge_status' => 'Active'
				);

			$updated = $this->Model_ward->update_ward_discharge_status($id,$data);

			if(!$updated){
				echo 'Error performing the operation';
				exit;
			}

			$this->session->set_flashdata('success','You have successfully updated the discharge date.');
			redirect('/ward/view_bed_assign/', 'refresh');
		}
		
	}

	public function delete($id){
		$task = $_POST['delete'];
		if(isset($task)){

			$id = trim($id);

			$deleted = $this->Model_ward->delete_ward($id,'ward');

			if(!$deleted){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Deleted';
			redirect('ward/view_ward/', 'refresh');
		}
	}

	public function delete_bed($id){
		$task = $_POST['delete'];
		if(isset($task)){

			$id = trim($id);

			$deleted = $this->Model_ward->delete_ward($id,'ward_assign');

			if(!$deleted){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Deleted';
		}
	}

	public function update_status($id){
		$status = $_POST['update_status'];
		$task = $_POST['task'];
		if(isset($status)){
			if($task == 'Inactive'){
				$id = trim($id);

				$data = array(
					'status' => 'Inactive'
				);

				$updated = $this->Model_ward->update_ward_status($id,$data);

				if(!$updated){
					echo 'Error performing the operation';
					exit;
				}

				echo 'Updated';
			}else if($task == 'Active'){
				$id = trim($id);

				$data = array(
					'status' => 'Active'
				);

				$updated = $this->Model_ward->update_ward_status($id,$data);

				if(!$updated){
					echo 'Error performing the operation';
					exit;
				}

				echo 'Updated';
			}
			
		}
	}

	public function show_restrict(){
		$this->load->view('restriction/block');
	}

}