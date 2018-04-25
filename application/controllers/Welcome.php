<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $loggedIn;
	private $checkRole;
	private $roleName;
	
	public function __construct(){
		parent::__construct();
		check_installer();
		$this->load->model('Model_staff');
		$this->load->model('Model_casenote');
		$this->load->model('Model_appointment');
		$this->load->library('hash_created');
        $this->load->library('cookiecreate');
        $this->load->library('imageCreate');
        $this->load->library('dateCreate');

        // this check the remember me functionality being click
        if($this->cookiecreate->exists($this->config->item('cookie_name')) && !$this->session->has_userdata('staff_id')){
            $hash = $this->cookiecreate->get($this->config->item('cookie_name'));
            $hashcheck = $this->db->get_where('users_session', array('hash' => $hash));

            if($hashcheck->num_rows()){
                $this->load_remember($hashcheck->row()->staff_id);
                $this->Model_staff->login(); // login user
            }
        }

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

	public function index()
	{
		$s = file_exists(APPPATH.'controllers/installer.php');
		if($s == 1)
		{
			redirect('installer');
		}
		
		$this->check_attempt();
		if($this->loggedIn === true){
			$cnresult = $this->Model_casenote->get_all_casenote();
			$result_appoint = $this->Model_appointment->get_all_appointment();
			$data['data_cn'] = $cnresult;
			$data['data_appointment'] = $result_appoint;
			$this->load->view('templates/header.php');
			$this->load->view('dashboard/ehm', $data);
			$this->load->view('templates/footer.php');
		}else{
			// session destroy or not login yet
			$this->logout();
			$this->load->view('login/login');
		}
	}

	public function doctor()
	{
		$this->check_attempt();
		if($this->loggedIn === true){
			$id = $this->session->userdata('staff_db_id');
			$cnresult = $this->Model_casenote->get_last_casenote($id);
			$result_appoint = $this->Model_appointment->get_doctor_appointment($id);
			$data['data_cn'] = $cnresult;
			$data['data_appointment'] = $result_appoint;
			$this->load->view('templates/header.php');
			$this->load->view('dashboard/ehm1', $data);
			$this->load->view('templates/footer.php');
		}else{
			// session destroy or not login yet
			$this->logout();
			$this->load->view('login/login');
		}
	}


	public function nurse()
	{
		$this->check_attempt();
		if($this->loggedIn === true){
			$id = $this->session->userdata('staff_db_id');
			$cnresult = $this->Model_casenote->get_all_casenote();
			$result_appoint = $this->Model_appointment->get_all_appointment();
			$data['data_cn'] = $cnresult;
			$data['data_appointment'] = $result_appoint;
			$this->load->view('templates/header.php');
			$this->load->view('dashboard/ehm_nurse', $data);
			$this->load->view('templates/footer.php');
		}else{
			// session destroy or not login yet
			$this->logout();
			$this->load->view('login/login');
		}
	}

	public function rec()
	{
		$this->check_attempt();
		if($this->loggedIn === true){
			$cnresult = $this->Model_casenote->get_all_casenote();
			$result_appoint = $this->Model_appointment->get_all_appointment();
			$data['data_cn'] = $cnresult;
			$data['data_appointment'] = $result_appoint;
			$this->load->view('templates/header.php');
			$this->load->view('dashboard/ehmrec', $data);
			$this->load->view('templates/footer.php');
		}else{
			// session destroy or not login yet
			$this->logout();
			$this->load->view('login/login');
		}
	}


	public function cm()
	{
		$this->check_attempt();
		if($this->loggedIn === true){
			$this->load->view('templates/header.php');
			$this->load->view('dashboard/ehmcm', array('loggedIn' => $this->loggedIn));
			$this->load->view('templates/footer.php');
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

	public function dashboard(){
		if($this->get_role_name() == 'admin'){
			$this->index();
		}else

		if($this->get_role_name() == 'doctor'){
			$this->doctor();
		}else

		if($this->get_role_name() == 'receptionist'){
			$this->rec();
		}else

		if($this->get_role_name() == 'nurse'){
			$this->nurse();
		}else{
			$this->logout();
			$this->load->view('login/login');
		}
	
	}

	public function updateAppointmentStatus($id){
		$id = trim($id);
		$task = $_POST['task'];
		if(isset($id)){
			if($task == 'update_status'){
				$id = trim($id);

				$data = array(
					'status' => 'true'
				);

				$updated = $this->Model_staff->update_appointment_status($id,$data);

				if(!$updated){
					echo 'Error performing the operation';
					exit;
				}

				echo 'Checked by me';
				// redirect('ward/view_ward/', 'refresh');
			}
		}
	}

	public function load_remember($user = null){
        if(!$user){
            if($this->session->has_userdata('staff_id')){
                $user = $this->session->userdata('staff_id');
                if($this->Model_staff->find_id($user)){
                    $this->loggedIn = true;
                }else{
                    $this->logout();
                }
            }
        }else{
            $this->Model_staff->find_id($user);
        }
    }

	public function check_attempt(){
		if($this->session->has_userdata('attempts')){
			if($this->session->userdata('attempts') == 4){
				redirect('/welcome/reset/');
			}else{
				$this->session->set_userdata('attempts', $this->session->userdata('attempts'));
			}
			
		}else{
			$res = $this->Model_staff->check_attempt();
			if($res){
				redirect('/welcome/reset/');
			}
		}
	
	}

	public function login(){
		$this->check_attempt();
		$config = array(
				array(
					'field' => 'staff_username',
					'label' => 'Username',
					'rules' => 'required'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required'
				)
		);
		$this->form_validation->set_rules($config);

 		if($this->form_validation->run() === false){
 			$data['title'] = '::EHM Login::';
 			$this->load->view('login/login', $data);
 		}else{
 			//validation passed...
 			$data = $_POST;
			$result = $this->Model_staff->login($data);
			// print_r($result); 
			if(!isset($_SESSION['attempts'])){
				$this->session->set_userdata('attempts', 0);
			}

			if($this->session->userdata('attempts') < 4){
				switch ($result) {
					case 1:
						// logged in to the dashboard page
						redirect('/welcome/dashboard');
					break;

					case 2:				
						$data['title'] = '::EHM Login:: | Incorrect login';
						$data['error'] = 'Incorrect username or password...';
						$_SESSION['attempts'] = $_SESSION['attempts'] + 1;
						$this->load->view('login/login', $data);
					break;

					case 3:
						$data['title'] = '::EHM Login:: | Incorrect login';
						$data['error'] = 'Incorrect username or password...';
						$_SESSION['attempts'] = $_SESSION['attempts'] + 1;
						$this->load->view('login/login', $data);
					break;
				}
			}else{
				// reset the password
				$ip = $this->input->ip_address();
				$user_agent = $this->input->user_agent();
				$data = array(
					'ip_address' => $ip,
					'user_agent' => $user_agent,
					'status' => 1,
					'date_attempt' => date('Y-m-d H:i:s')
				);
				$this->db->insert('login_attempt',$data);
				$this->session->set_flashdata('reset', 'You were redirected to this page because you have exhausted your login limit...');
				redirect('/welcome/reset/');
			}
			
			
 		}
	}

	public function reset(){
		// $this->check_attempt();
		$this->load->view('forget/forgot_password');
	}

	public function forget_password(){

		$this->form_validation->set_rules('email','Email','required|valid_email');
		if($this->form_validation->run() === false){
			// $data['title'] = 'Reset Password';
			$this->load->view('forget/forgot_password');
		}else{
			// send reset message to user email

			$email = trim($this->input->post('email')); 
			$result = $this->Model_staff->email_exists($email);

			if($result){
				$process_email = $this->send_reset_password_email($email, $result);
				if($process_email){
					$this->load->view('forget/view_password_sent', array('email' => $email));
				}else{
					$this->load->view('forget/forgot_password', array('error' => 'Mail not sent.Check your smtp settings...'));
				}
			}else{
				// $data['title'] = 'Error|page';
				$this->load->view('forget/forgot_password', array('error' => 'Email address does not exists...!'));
			}
		}
	}

	public function reset_password_form($email, $email_code){
		// echo md5($this->config->item('salt') . 'Alatise');
		if(isset($email, $email_code)){
			$email = trim($email);
			$email_code = trim($email_code);
			$email_hash = sha1($email . $email_code);
			$verified = $this->Model_staff->verify_reset_password_code($email, $email_code);

			if($verified){
				$this->load->view('forget/reset_password', array('email_hash' => $email_hash,'email_code' => $email_code, 'email' => $email));
			}else{
				// send back to reset_password page, not update_password, if there was a problem
				$this->load->view('forget/forgot_password', array('error' => 'There was a problem with your link. Please click it again or resend to reset your password again!','email' => $email));
			}
		}else{
			$this->load->view('restriction/block');
		}
		
		
	}

	public function update_password(){
		if(isset($_POST['email'], $_POST['email_hash']))
		{
			if($_POST['email_hash'] !== sha1($_POST['email'] . $_POST['email_code'])){
				// either a hacker or they changed their mail in the mail field, just die
				echo '<a href="javascript:history.go(-1)"> Go Back </a>';
				die('Error updating your password');
			}
			
		}

		// $this->form_validation->set_rules('email_hash', 'Email Hash','trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[50]|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[3]|max_length[50]');

		 if($this->form_validation->run() === false){
		 	// user didn't validate, send back to update password form and show error
		 	$this->load->view('forget/reset_password');

		 }else{
		 	 // successful update
		 	// return users name if successful
		 	$email = $this->input->post('email');
			$password = $this->hash_created->encode_password($this->input->post('password'));
		 	$result = $this->Model_staff->update_password($email,$password);

		 	if($result){
		 		// here delete the login_attempt from the db
		 		$delete = $this->delete_attempt();
		 		if($this->session->userdata('attempts') == 0){
		 			// do nothing for now
		 		}
		 		else if(!$delete){
		 			echo '<a href="javascript:history.go(-1)"> Go Back </a>';
		 			die('Sorry,there is an error clearing the attempt or it has been cleared already...');
		 		}
		 		$this->load->view('forget/view_update_password_success');
		 	}else{
		 		// this should never happen
		 		$this->load->view('forget/reset_password', array('error' => 'Problem updating your password. Please contact ' . $this->config->item('admin_email')));
		 	}
		 }
		 // echo '<a href="javascript:history.go(-1)"> Go Back </a>';
	}

	public function send_reset_password_email($email,$name){
		$this->load->library('email');
		$email_code = md5($this->config->item('salt') . $name );

		$to = $email;
		$sub = 'Reset your password!';

 		$response = $this->Model_staff->custom_template_mail($to,$sub,$name,$email,$email_code);
 		 if($response != 'success'){
 		 	return false;
 		 }else{
 		 	return true;
 		 }

	}

	// public function email_view(){
	// 	$this->load->view('templates/email');
	// }

	public function delete_attempt(){
		$res = $this->Model_staff->delete_login_attempt();
		if($res){
			$this->session->set_userdata('attempts', 0);
			return true;
		}
		return false;
	}

	public function edit_user(){
		$this->check_login();
		$data['permission'] = $this->get_role_name();
		if(isset($_POST['btnSaveChanges'])){
			$id = $this->input->post('user_update_id');
			$current_password = trim($this->input->post('current_password'));
			$new_password = trim($this->input->post('password'));

			if(!empty($current_password)){
				if(!password_verify($current_password, $this->checkRole->password)){
					$data['permission'] = $this->get_role_name();
	   	  	  		$data['error'] = 'The current password is wrong...';
	   	  	  		$this->load->view('edit_user', $data);
					exit;
	   	  	  	}
	   	  	  	
			}

			$password = $this->hash_created->encode_password($new_password);

			if($this->get_role_name() == 'admin'){

				$data = array(
					'staff_username' => $this->input->post('username'),
					'first_name' => $this->input->post('first_name'),
					'middle_name' => $this->input->post('middle_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'phone_no' => $this->input->post('phone_no'),
					'password' => $password
				);

			}else{
				$data = array(
					'staff_username' => $this->input->post('username'),
					'password' => $password
				);
			}

			$updated = $this->Model_staff->update_staff($id, $data);

            if(!$updated){
            	// this should not occur, error inserting to database
            	$data['permission'] = $this->get_role_name();
            	$data['error'] = 'There is an error updating...';
				$this->load->view('edit_user', $data);
				exit;
            }

            $data['permission'] = $this->get_role_name();
            $data['success'] = 'Your info have been changed successfully...';
            $this->load->view('edit_user', $data);
            exit;
		}

		$this->load->view('edit_user', $data);
	}

	public function search(){
		$search_data = $this->input->get('search_patient');
		$search_data = trim($search_data);
		$results = $this->Model_staff->search_patient($search_data);
		$data['results'] = $results;
		$this->load->view('search_result', $data);
	}

	public function noticeboard(){
		$this->check_login();

		$config = array(
			array(
					'field' => 'title',
					'label' => 'title',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'description',
					'label' => 'description',
					'rules' => 'trim|required'
				)
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() == false){
			$this->load->view('noticeboard/notice');
		}else{
			// perform operation
			$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'date_created' => date('Y-m-d H:i:s')
			);

			$posted = $this->Model_staff->put_general('notice_board', $data);
			if(!$posted){
				$data['error'] = 'Error performing the operation...';
				$this->load->view('noticeboard/notice');
				exit;
			}

			redirect('welcome/view_notice/', 'refresh');
		}

		
	}

	public function view_notice(){
		$result = $this->Model_staff->view_general('notice_board');
		// print_r($result);
		$data['data_notice'] = $result;
		$data['permission'] = $this->get_role_name();

		$this->load->view('noticeboard/view_notice', $data);
	}

	public function notice_edit(){
		if(isset($_POST['edit'])){
			$id = trim($_POST['id']);
			$title = $_POST['title'];
			$description = $_POST['description'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$data = '';

			$data = array(
				'title' => $title,
				'description' => $description,
				'start_date' => $start_date,
				'end_date' => $end_date
			);

			$updated = $this->Model_staff->update_general($id,$data,'notice_board');

			if(!$updated){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Updated';
		}
	}

	public function delete_welcome_general($id){
		$task = $_POST['delete'];
		if(isset($task)){

			$id = trim($id);

			$deleted = $this->Model_staff->delete_general('notice_board',$id);

			if(!$deleted){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Deleted';
		}
	}

	public function settings(){
		$this->check_login();
		$config = array(
			array(
					'field' => 'system_title',
					'label' => 'system title',
					'rules' => 'trim|required'
				)
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() == false){
			$settings = $this->Model_staff->get_settings();
			$data['settings'] = $settings;
			$this->load->view('settings', $data);
		}else{
			//perform action

			$upload_path = '';
			$img_name = 'ehm-logo';

			if(empty($_FILES['pic_file']['name'])){
				$upload_path = '';
			}else if(isset($_FILES['pic_file'])){
				if(!empty($_FILES['pic_file'])){
					imageCreate::$pathImage = 'assets/img/upload';
	                $image = imageCreate::uploadImage('pic_file', $img_name);
	                if (!$image)
	                {
	                    echo 'File cannot be uploaded';
	                    exit;
	                }else{
	                    $upload_path = imageCreate::getImageFullPath();  
	                }
	            }
			}
			else{
				$upload_path = 'assets/img/upload/ehm.png';
			}

			if(empty($upload_path)){
				$data = array(
	                'title' => $this->input->post('system_title'),
	                // 'logo' => $upload_path,	
	                'smtp_host' => $this->input->post('smtp_host'),
	                'smtp_username' => $this->input->post('smtp_username'),
	                'smtp_password' => $this->input->post('smtp_password'),
	                'email' => $this->input->post('email'),
	                'mobile' => $this->input->post('mobile'),
	                'address' => $this->input->post('address'),
	                'date_created' => date('Y-m-d H:i:s')
	            );
			}else{
				$data = array(
	                'title' => $this->input->post('system_title'),
	                'logo' => $upload_path,	
	                'smtp_host' => $this->input->post('smtp_host'),
	                'smtp_username' => $this->input->post('smtp_username'),
	                'smtp_password' => $this->input->post('smtp_password'),
	                'email' => $this->input->post('email'),
	                'mobile' => $this->input->post('mobile'),
	                'address' => $this->input->post('address'),
	                'date_created' => date('Y-m-d H:i:s')
	            );
			}

			

			$update = $this->Model_staff->update_settings($data);
			if(!$update){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem performing the action...';
				$this->load->view('welcome/settings', $data);
				exit;
			}
			$this->session->set_flashdata('success', 'You have saved your settings for the system...');
			redirect('/welcome/settings/', 'refresh');
		}
		
	}

	public function logout(){
        $this->Model_staff->logout();
		redirect('/welcome/login/', 'refresh');
	}
	
}
