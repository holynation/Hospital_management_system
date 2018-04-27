<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Casenote extends CI_Controller {
	private $loggedIn;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_staff');
		$this->load->model('Model_patient');
		$this->load->model('Model_casenote');
		$this->load->library('hash_created');
		$this->load->library('DateCreate');

		if($this->session->userdata('isLoggedIn')){
			$this->loggedIn = true;
		}else{
			$this->loggedIn = false;
		}
	}

	public function index(){
		if($this->loggedIn === true){
			$this->load->view('templates/header.php');
			$this->load->view('ehm', array('loggedIn' => $this->loggedIn ));
			$this->load->view('templates/footer.php');
		}else{
			// session destroy or not login yet
			$this->Model_staff->logout();
			$this->load->view('login/login');
		}
	}

	public function create($id){


		$id = trim($id);

		$result = $this->Model_casenote->get_appointment_by_id($id);
		if(!$result){
			echo 'There is an error with the info from the db...';
			exit;
		}

		$result2 = $result->patient_id;
		$result5 = $result->doctor_name;

		//print_r($result2);die();

		$result3 = $this->Model_patient->view_patient_where($result2);
		$cnresult = $this->Model_casenote->view_casenote_by_id($result2);

		$result4 = $this->Model_casenote->view_appointment_by_id($id);
		// print_r($result);

		$data['data_appointment'] = $result4;

		$result6 = $this->Model_casenote->get_doctor_by_id($result5);
		// print_r($result);

		$data['data_doctor'] = $result6;

		$data['data_patient'] = $result3;

		$data['data_cn'] = $cnresult;

	    $this->load->view('casenote/add_casenote',$data);
		
		
	}

	public function create_direct(){

		//echo "got here"; die();

                
				$urlid1 = $this->input->post('app_id');
				$urlid = trim($urlid1);
				$url = "casenote/create/$urlid " ;
				//echo "$url"; die();
		
			//create casenote
			$data = array(

				'patient_id' => $this->input->post('patient_id'),
				'health_status ' => $this->input->post('health_status'),
                'prescription' => $this->input->post('prescription'),
				'diagnosis' => $this->input->post('description'),
				'created_by' => $this->input->post('created_by'),
				'date_created' => date('Y-m-d H:i:s')

			);

			//print_r($data); die();

			$result = $this->Model_casenote->put_casenote($data);
			if(!$result){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view($url,$data);
				exit;
			}

			$this->session->set_flashdata('success', 'You Have Successfully Created Patient Case Note...');
			redirect($url, 'refresh');
		
		
	}

	public function ANC($id = null){
		// using this id is coming from session if redirect is used
		if($this->session->has_userdata('patient_anc_id'))
		{
			$id = $this->session->userdata('patient_anc_id'); 
		}
		// using this id if coming from the view appointment
		else if(!empty($id))
		{
			$id = $id;
		}
		
		$patient_result = $this->Model_patient->get_patient_by_id($id);
		// print_r($patient_result);
		$data['patient'] = $patient_result;
		$this->load->view('casenote/anc', $data);
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
		$this->load->view('appointment/view_appoint',$data);
	}


	
		public function view_casenote(){
		$result = $this->Model_casenote->get_all_casenote();
		// print_r($result);

		$data['data_cn'] = $result;
		$this->load->view('casenote/view_casenote',$data);
	}


	public function add_casenote(){
	//	$data['data_appointment'] = $result;
		$this->load->view('casenote/general_casenote');
	}


	public function search_patient(){
		if(isset($_POST['search'])){
			$name = $_POST['search'];
			$name = trim($name);

			$result = $this->Model_appointment->search_name($name);
			if($result == NULL){
				echo '';
			}

			if($result == 'no result'){
				echo 'patient not found...';
				exit;
			}

			if(!$result){
				echo " ";
			}else{ ?>
				<div class="col-sm-10">
					<ul>
						<?php foreach($result as $r): ?>
						<a href="" id="list-name" data="<?php echo $r->first_name, ' ', $r->last_name, ' ', $r->middle_name; ?>"><li><?php echo $r->first_name, ' ', $r->last_name, ' ', $r->middle_name; ?></li></a>
						<input type="hidden" id="patient_id" name="patient_id" value="<?php echo $r->id; ?>" disabled />
					<?php endforeach; ?>
					</ul>
				</div>
			<?php }

		}
	}

	public function edit_casenote($id){
		$id = trim($id);
		$result = $this->Model_casenote->get_casenote_by_id($id);
		if(!$result){
			echo 'There is an error with the info from the db...';
			exit;
		}
		$data['data_casenote'] = $result;
		$this->load->view('casenote/edit_casenote', $data);
	}

    public function edit_casenote2($id){
        $id = trim($id);
        $result = $this->Model_casenote->get_casenote_by_id($id);
        if(!$result){
            echo 'There is an error with the info from the db...';
            exit;
        }
        $data['data_casenote'] = $result;
        $this->load->view('casenote/edit_casenote2', $data);
    }

	public function update_casenote(){

			if(isset($_POST['Update'])){
                $id = $this->input->post('case_id');
                $data = array(
                    'health_status ' => $this->input->post('health_status'),
                    'prescription' => $this->input->post('prescription'),
                    'diagnosis' => $this->input->post('description'),
                    'date_updated' => date('Y-m-d H:i:s')

                );


	            $updated = $this->Model_casenote->update_casenote($id, $data);

	            if(!$updated){
	            	echo 'There is an error updating...';
					exit;
	            }
                   
                $this->session->set_flashdata('success', 'You have successfully updated the case note...');
				redirect('/casenote/view_casenote/', 'refresh');
			}
	}


    public function update_casenote2(){

        if(isset($_POST['Update'])){
            $id = $this->input->post('case_id');
            $data = array(
                'health_status ' => $this->input->post('health_status'),
                'prescription' => $this->input->post('prescription'),
                'diagnosis' => $this->input->post('description'),
                'date_updated' => date('Y-m-d H:i:s')

            );


            $updated = $this->Model_casenote->update_casenote($id, $data);

            if(!$updated){
                echo 'There is an error updating...';
                exit;
            }

            $this->session->set_flashdata('success', 'You have successfully updated the case note...');
            //redirect('/casenote/view_casenote/', 'refresh');
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }

	public function delete($id){
		$task = $_POST['delete'];
		if(isset($task)){

			$id = trim($id);

			$deleted = $this->Model_casenote->delete_casenote($id);

			if(!$deleted){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Deleted';
			redirect('appointment/view_appoint/', 'refresh');
		}
	}

}