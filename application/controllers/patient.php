<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends CI_Controller {
	private $loggedIn;
	private $checkRole;
	private $roleName;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_patient');
		$this->load->model('Model_staff');
		$this->load->library('hash_created');
		$this->load->library('DateCreate');
		$this->load->library('imageCreate');

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

	public function add_patient(){
		$this->load->library('hash_created');
		$config = array(
				array(
					'field' => 'title',
					'label' => 'title',
					'rules' => 'required'
				),
				array(
					'field' => 'first_name',
					'label' => 'First Name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'last_name',
					'label' => 'Last Name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'middlename',
					'label' => 'Middle Name',
					'rules' => 'trim'
				),
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email'
				),
				array(
					'field' => 'gender',
					'label' => 'Gender',
					'rules' => 'required'
				),
				array(
					'field' => 'datetimepicker1',
					'label' => 'DOB',
					'rules' => 'required'
				),
				array(
					'field' => 'marital_status',
					'label' => 'Marital Status',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'phone_no',
					'label' => 'Phone Num',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'state',
					'label' => 'State',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'lga',
					'label' => 'LGA',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'trim|required'
				),
				// next kin validation
				array(
					'field' => 'relationship_kin',
					'label' => 'Relationship',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'firstname_kin',
					'label' => 'kin First Name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'middle_name_kin',
					'label' => 'Kin Middle Name',
					'rules' => 'trim'
				),
				array(
					'field' => 'last_name_kin',
					'label' => 'Kin Last Name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'phone_kin',
					'label' => 'Kin Mobile',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'address_kin',
					'label' => 'Kin Address',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'genotype',
					'label' => 'genotype',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'blood_group',
					'label' => 'blood group',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'allergy',
					'label' => 'allergy',
					'rules' => 'trim|required'
				)
		);

		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			$this->load->view('patient/add_patient');
		}else{
			// retrive data into db
			$patient_id = 'UCH-P' . date('Y') . rand(111, 9999);

			// upload script
			$upload_path = '';

			if($_FILES['pic_file']['name'] == TRUE){
				imageCreate::$pathImage = 'assets/img/upload/patient';
				$img_name = 'ehm';
                $image = imageCreate::uploadImage('pic_file', $img_name);
                if (!$image)
                {
                	$data['error'] = 'Error uploading the image...';
                	$this->load->view('patient/add_patient', $data);
                    exit;
                }else{
                    $upload_path = imageCreate::getImageFullPath();   
                }
			}else{
				$upload_path = 'assets/img/upload/patient/default.jpg';
			}
			
			$data = array(
                'patient_id' => $patient_id,
                'title' => $this->input->post('title'),
                'first_name' => $this->input->post('first_name'),
                'middle_name' => $this->input->post('middlename'),
                'last_name' => $this->input->post('last_name'),
                'dob' => $this->input->post('datetimepicker1'),
                'gender' => $this->input->post('gender'),
                'marital_status' => $this->input->post('marital_status'),
                'phone_no' => $this->input->post('phone_no'),
                'email' => $this->input->post('email'),
                'state' => $this->input->post('state'),
                'lga' => $this->input->post('lga'),
                'occupation' => $this->input->post('occupation'),
                'address' => $this->input->post('address'),
                'city_address' => $this->input->post('city_address'),
                'firstname_kin' => $this->input->post('firstname_kin'),
                'middle_name_kin' => $this->input->post('middle_name_kin'),
                'last_name_kin' => $this->input->post('last_name_kin'),
                'relationship_kin' => $this->input->post('relationship_kin'),
                'phone_kin' => $this->input->post('phone_kin'),
                'address_kin' => $this->input->post('address_kin'),
                'picture_path' => $upload_path,
                'genotype'	=> $this->input->post('genotype'),
                'blood_group'	=> $this->input->post('blood_group'),
                'allergy'	=> $this->input->post('allergy'),
                'date_created' => date('Y-m-d H:i:s')
            );

			$register = $this->Model_patient->put_patient($data);
			if(!$register){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('patient/add_patient', $data);
				exit;
			}
			$this->session->set_flashdata('success', 'You have successfully added a patient...');
			redirect('/patient/view_patient/', 'refresh');
		}
		
	}

	public function load_state(){
		$id = $_POST['id'];
		// $data['id'] = $id;
		$stateId = $id;
		$data = $this->Model_staff->check_lga($stateId)->result();

		if($data == NULL){
		 	echo '';
		}

		if(!$data){
		 	echo " ";
		}else{ ?>

			<div class="form-group">
                <label class="col-md-4 control-label" for="val-lga">
                    LGA
                <span class="text-danger">*</span>
                </label>        
                <div class="col-md-6">
                     <select id="val-lga" name="lga" class="form-control">
                        <option value="">------ Select LGA ------</option>
                        <?php  foreach($data as $d){ ?>
                        <option value="<?php echo $d->local_name; ?>"> <?php echo $d->local_name; ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
		<?php }
	}

	public function view_patient(){
		$result = $this->Model_patient->view_patient();
		// print_r($result);
		$data['data_patient'] = $result;
		$this->load->view('patient/view_patient', $data);
	}

	public function view_patient_full($id){
		$id = trim($id);
		$result = $this->Model_patient->view_patient_where($id);
		if(!$result){
			$data['error'] = 'There is an error with the info from the db...';
			$this->load->view('patient/view_patient_full', $data);
			exit;
		}
		$data['data_patient'] = $result;
		$this->load->view('patient/view_patient_full', $data);
	}

	public function update_patient(){
		if(isset($_POST['btnPatientUpdate'])){
			$id = $this->input->post('patient_update_id');

			if($this->checkRole){
				if($this->get_role_name() == 'admin'){
					$name = $this->get_role_name();
				}else{
					$name = $this->get_role_name() . ' ' . $this->checkRole->first_name . ' ' . $this->checkRole->last_name;
				}
			}

			$data = array(
                'title' => $this->input->post('title'),
                'first_name' => $this->input->post('first_name'),
                'middle_name' => $this->input->post('middlename'),
                'last_name' => $this->input->post('last_name'),
                'dob' => $this->input->post('datetimepicker1'),
                'gender' => $this->input->post('gender'),
                'marital_status' => $this->input->post('marital_status'),
                'phone_no' => $this->input->post('phone_no'),
                'email' => $this->input->post('email'),
                'state' => $this->input->post('state'),
                'lga' => $this->input->post('lga'),
                'address' => $this->input->post('address'),
                'city_address' => $this->input->post('city_address'),
                'firstname_kin' => $this->input->post('firstname_kin'),
                'middle_name_kin' => $this->input->post('middle_name_kin'),
                'last_name_kin' => $this->input->post('last_name_kin'),
                'relationship_kin' => $this->input->post('relationship_kin'),
                'phone_kin' => $this->input->post('phone_kin'),
                'address_kin' => $this->input->post('address_kin'),
                'modifier' => $name,
                'date_modified' => date('Y-m-d H:i:s')
            );
            $updated = $this->Model_patient->update_patient($id, $data);

            if(!$updated){
            	echo 'There is an error updating...';
				exit;
            }
                   
                $this->session->set_flashdata('success', 'You have successfully updated the patient...');
				redirect('/patient/view_patient/', 'refresh');
		}
	}

	public function single_patient($id){
		$id = trim($id);
		$result = $this->Model_patient->view_patient_where($id);
		if(!$result){
			$this->show_restrict();
			exit;
		}

		$data['data_patient'] = $result;
		$this->load->view('patient/single_patient', $data);
	}

	public function show_restrict(){
		$this->load->view('restriction/block');
	}



}