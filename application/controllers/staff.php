<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {
	private $loggedIn;
	private $checkRole;
	private $roleName;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_staff');
		$this->load->library('hash_created');
		$this->load->library('imageCreate');
		$this->load->library('dateCreate');

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
			// $this->load->view('tmp/index-2', array('loggedIn' => $this->loggedIn ));
			redirect('/welcome/');
		}else{
			// session destroy or not login yet
			$this->logout();
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

	public function check_login(){
		if(!$this->loggedIn === true){
			// session destroy or not login yet
			$this->logout();
			$this->load->view('login/login');
		}
	}

	public function check_permission(){
		if($this->get_role_name() != 'admin'){
			$this->load->view('restriction/intrude');
			exit;
		}
	}

	public function add_staff(){
		$this->check_login();
		// $this->check_permission();

		$this->load->library('hash_created');
		$config = array(
				array(
					'field' => 'title',
					'label' => 'title',
					'rules' => 'required'
				),
				array(
					'field' => 'username',
					'label' => 'username',
					'rules' => 'trim|required|min_length[4]|max_length[20]|callback_username_check'
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
					'field' => 'middle_name',
					'label' => 'Middle Name',
					'rules' => 'trim'
				),
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email|callback_email_check'
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
				// this is the role validation
				array(
					'field' => 'department_id',
					'label' => 'Department',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[5]'
				),	
				array(
					'field' => 'confirmpassword',
					'label' => 'Confirm Password',
					'rules' => 'trim|required|matches[password]'
				),
		);

		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			$data['departments'] = $this->Model_staff->get_department();
			$this->load->view('staff/add_staff', $data);
		}else{
			// retrive data into db
			$staff_id = 'UCH-' . date('Y') . rand(111, 9999) ;
			$password = $this->hash_created->encode_password($this->input->post('password'));
			$upload_path = '';

			if($_FILES['pic_file']['name'] == TRUE){
				imageCreate::$pathImage = 'assets/img/upload/staff';
				$img_name = 'ehm';
                $image = imageCreate::uploadImage('pic_file', $img_name);
                if (!$image)
                {
                	$data['error'] = 'Error uploading the image...';
                	$this->load->view('staff/add_staff', $data);
                    exit;
                }else{
                    $upload_path = imageCreate::getImageFullPath();   
                }
			}else{
				$upload_path = 'assets/img/upload/staff/default.jpg';
			}

			$data = array(
                'staff_id' => $staff_id,
                'staff_username' => $this->input->post('username'),
                'password' => $password,
                'title' => $this->input->post('title'),
                'first_name' => $this->input->post('first_name'),
                'middle_name' => $this->input->post('middle_name'),
                'last_name' => $this->input->post('last_name'),
                'birth' => $this->input->post('datetimepicker1'),
                'gender' => $this->input->post('gender'),
                'marital_status' => $this->input->post('marital_status'),
                'phone_no' => $this->input->post('phone_no'),
                'email' => $this->input->post('email'),
                'state' => $this->input->post('state'),
                'lga' => $this->input->post('lga'),
                'address' => $this->input->post('address'),
                'firstname_kin' => $this->input->post('firstname_kin'),
                'middle_name_kin' => $this->input->post('middle_name_kin'),
                'last_name_kin' => $this->input->post('last_name_kin'),
                'relationship_kin' => $this->input->post('relationship_kin'),
                'phone_kin' => $this->input->post('phone_kin'),
                'address_kin' => $this->input->post('address_kin'),
                'department_id' => $this->input->post('department_id'),
                'img_path' => $upload_path,
                'status' => 'Active',
                'date_created' => date('Y-m-d H:i:s')
            );

			$register = $this->Model_staff->put_staff($data);
			if(!$register){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('staff/add_staff', $data);
				exit;
			}
			$this->session->set_flashdata('success', 'You have successfully added a staff. Please assign a role...');
			redirect('/staff/assign_staff_role/', 'refresh');
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

	public function username_check($username){
        $check = $this->Model_staff->user_exists($username,'staff_username');

        if($check){
                $this->form_validation->set_message('username_check', 'The {field} already exists');
                return FALSE;
        }else{
                return TRUE;
        }
    }

    public function email_check($username){
    	$check = $this->Model_staff->user_exists($username,'email');

        if($check){
                $this->form_validation->set_message('email_check', 'The {field} already exists');
                return FALSE;
        }else{
                return TRUE;
        }
    }

	public function view_staff(){
		$this->check_login();
		$result = $this->Model_staff->view_staff();
		// print_r($result);
		$data['data_staff'] = $result;
		$data['permission'] = $this->get_role_name();
		$this->load->view('templates/header');
		$this->load->view('staff/view_staff', $data);
	}

	public function detail_staff($id){
		$id = trim($id);
		$result = $this->Model_staff->view_detail_where($id);
		if(!$result){
			$this->show_restrict();
			exit;
		}

		$data['data_staff'] = $result;
		$this->load->view('staff/detail_staff', $data);
	}

	public function edit_staff($id){
		// $this->check_permission();
		$id = trim($id);
		$result = $this->Model_staff->view_staff_where($id);
		if(!$result){
			echo 'There is an error with the info from the db...';
			exit;
		}
		$data['data_staff'] = $result;
		$this->load->view('staff/edit_staff', $data);
	}

	public function update_staff(){
		if(isset($_POST['btnStaffUpdate'])){
			$id = $this->input->post('staff_update_id');
			$data = array(
                'title' => $this->input->post('title'),
                'first_name' => $this->input->post('first_name'),
                'middle_name' => $this->input->post('middlename'),
                'last_name' => $this->input->post('last_name'),
                'birth' => $this->input->post('datetimepicker1'),
                'gender' => $this->input->post('gender'),
                'marital_status' => $this->input->post('marital_status'),
                'phone_no' => $this->input->post('phone_no'),
                'email' => $this->input->post('email'),
                'state' => $this->input->post('state'),
                'lga' => $this->input->post('lga'),
                'address' => $this->input->post('address'),
                'firstname_kin' => $this->input->post('firstname_kin'),
                'middle_name_kin' => $this->input->post('middle_name_kin'),
                'last_name_kin' => $this->input->post('last_name_kin'),
                'relationship_kin' => $this->input->post('relationship_kin'),
                'phone_kin' => $this->input->post('phone_kin'),
                'address_kin' => $this->input->post('address_kin'),
                'date_modified' => date('Y-m-d H:i:s')
            );
            $updated = $this->Model_staff->update_staff($id, $data);

            if(!$updated){
            	echo 'There is an error updating...';
				exit;
            }
                   
                $this->session->set_flashdata('success', 'You have successfully updated the staff...');
				redirect('/staff/view_staff/', 'refresh');
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

				$updated = $this->Model_staff->update_staff_status($id,$data);

				if(!$updated){
					echo 'Error performing the operation';
					exit;
				}

				echo 'Staff have been disabled...';
			}else if($task == 'Active'){
				$id = trim($id);

				$data = array(
					'status' => 'Active'
				);

				$updated = $this->Model_staff->update_staff_status($id,$data);

				if(!$updated){
					echo 'Error performing the operation';
					exit;
				}

				echo 'Staff have been enabled...';
			}
			
		}
	}

	public function role(){
		// $this->check_login();
		// $this->check_permission();
		$result = $this->Model_staff->view_staff_in_role();
		$roles = $this->Model_staff->get_roles();
		// print_r($result);
		$data['data_staff'] = $result;
		$data['data_roles'] = $roles;
		$this->load->view('role/add_role', $data);
	}

	public function assign_staff_role(){
			// $this->check_permission();
    		$result = $this->Model_staff->get_recent_staff();
    		$roles = $this->Model_staff->get_roles();
			if(!$result){
				$this->show_restrict();
				exit;
			}

			$data['data_staff'] = $result;
			$data['data_roles'] = $roles;
			$this->load->view('role/single_assign_role', $data);
	}

	public function assign_role(){
		$id = $_POST['id'];
		$role = $_POST['role'];
		$data = array(
			'role' => $role
		);
		$update = $this->Model_staff->update_staff($id,$data,'staff');
		if(!$update){
			echo 'There is an error updating...';
			exit;
		}

		echo 'updated';
	}

	public function assign_permission(){
		$staff_id = $_POST['staff_id'];
		$role_id = $_POST['role_id'];
		$permission = $_POST['permission'];

		$data = array(
			'staff_id' => $staff_id,
			'role_id'	=> $role_id,
			'permissions' => $permission
		);

		$create = $this->Model_staff->create_permission($data);
		if(!$create){
			echo 'There is an error creating a permission...';
			exit;
		}

		echo 'permitted';
	}

	public function show_restrict(){
		$this->load->view('restriction/block');
	}

	public function logout(){
        $this->Model_staff->logout();
		redirect('/welcome/login/', 'refresh');
	}


}