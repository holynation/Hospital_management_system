<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pharmacy extends CI_Controller{
	private $loggedIn;
	private $checkRole;
	private $roleName;

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_staff');
		$this->load->model('Model_patient');
		$this->load->model('Model_pharmacy');

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

	public function createMedicine(){
		// $this->check_permission();
		$config = array(
			array(
					'field' => 'name',
					'label' => 'Medicine name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'medicine_category',
					'label' => 'category',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'manufacture_date',
					'label' => 'manufacture date',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'form',
					'label' => 'drug form',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'packing',
					'label' => 'packing',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'generic_name',
					'label' => 'generic name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'quantity',
					'label' => 'quantity',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'expire_date',
					'label' => 'expire date',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'selling_price',
					'label' => 'selling price',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'purchase_price',
					'label' => 'purchase price',
					'rules' => 'trim|required'
				)
		);
		$this->form_validation->set_rules($config);
		$data['category'] = $this->Model_pharmacy->get_category();
		if($data['category'] == 'no result'){
			$data['error'] = 'Please create a list of category for medicine...';
			$this->load->view('pharmacy/add_medicine', $data);
			exit;
		}
		if($this->form_validation->run() == false){
			$this->load->view('pharmacy/add_medicine', $data);
		}else{
			//perform action
			$data = array(
                'name' => $this->input->post('name'),
                'category' => $this->input->post('medicine_category'),	
                'manufacture_date' => $this->input->post('manufacture_date'),	
                'form' => $this->input->post('form'),	
                'packing' => $this->input->post('packing'),	
                'effect' => $this->input->post('effect'),	
                'generic_name' => $this->input->post('generic_name'),	
                'quantity' => $this->input->post('quantity'),	
                'expire_date' => $this->input->post('expire_date'),	
                'selling_price' => $this->input->post('selling_price'),	
                'company' => $this->input->post('company'),	
                'purchase_price' => $this->input->post('purchase_price'),	
                'date_created' => date('Y-m-d H:i:s')
            );

			$register = $this->Model_pharmacy->put_pharmacy('medicine',$data);
			if(!$register){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('pharmacy/add_medicine', $data);
				exit;
			}
			$this->session->set_flashdata('success', 'You have successfully added a Medicine...');
			redirect('/pharmacy/view_medicine/', 'refresh');
		}
	}

	public function createCategory(){
		$this->check_permission();
		$config = array(
			array(
					'field' => 'category_name',
					'label' => 'category name',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'desc_info',
					'label' => 'desc info',
					'rules' => 'trim|required'
				)
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() == false){
			$this->load->view('pharmacy/add_category');
		}else{
			//perform action
			$data = array(
                'category_name' => $this->input->post('category_name'),
                'description' => $this->input->post('desc_info'),	
                'date_created' => date('Y-m-d H:i:s')
            );

			$register = $this->Model_pharmacy->put_pharmacy('medicine_category',$data);
			if(!$register){
				// this should not occur, error inserting to database
				$data['error'] = 'Problem inserting into database...';
				$this->load->view('pharmacy/add_category', $data);
				exit;
			}
			$this->session->set_flashdata('success', 'You have successfully added medicine category...');
			redirect('/pharmacy/view_category/', 'refresh');
		}
	}

	public function view_medicine(){
		$result = $this->Model_pharmacy->view_medicine();
		// print_r($result);
		$data['data_medicine'] = $result;
		$data['permission'] = $this->get_role_name();
		$this->load->view('pharmacy/view_medicine',$data);
	}

	public function view_category(){
		$result = $this->Model_pharmacy->view_pharmacy('medicine_category');
		// print_r($result);
		$data['data_category'] = $result;
		$data['permission'] = $this->get_role_name();
		$this->load->view('pharmacy/view_category',$data);
	}

	public function pos(){
		$this->load->view('pharmacy/pos');
	}

	public function administer($id){
		$id = trim($id);
		// $casenote = $this->Model_pharmacy->get_patient_casenote($id);
		$patient = $this->Model_patient->get_patient_by_id($id);
		$medicine = $this->Model_pharmacy->get_all_medicine();
		if(!$patient){
			echo 'patient not found or does not exist...';
			exit;
		}

		// $data['casenote'] = $casenote;
		$data['patient'] = $patient;
		$data['medicines'] = $medicine;
		$this->load->view('pharmacy/administer', $data);
	}

	public function search_patient(){
		if(isset($_GET['search'])){
			$name = $_GET['search'];
			$name = trim($name);

			$result = $this->Model_pharmacy->search_name($name);
			if($result == NULL){
				echo '';
			}

			if($result == 'no result'){
				echo '<div class="alert alert-warning">patient not found...</div>';
				exit;
			}

			if(!$result){
				echo " ";
			}else{ 
				$data['search_result'] = $result;
				$this->load->view('pharmacy/search_result_patient', $data);
				exit;
			}

		}
	}

	public function get_medicine_jquery(){
		if(!empty($_GET['id'])){
			$i = 0;
			$id = $_GET['id'];
			$patient_id = $_GET['patientId'];
		 	$sql = "SELECT * FROM medicine" ;
		 	$total = 'SELECT SUM(selling_price) AS TotalItemsPrice FROM medicine';
		 	foreach($id as $item_id){
		 		$i++;

		 		if($i == 1){
		 			$sql .= " WHERE id = ". $item_id . "";
		 			$total .= " WHERE id = ". $item_id . "";
		 		}else{
		 			$sql .= " OR id = ". $item_id . "";
		 			$total .= " OR id = ". $item_id . "";
		 		}

		 	}
	 		
			$result = $this->Model_pharmacy->get_medicine_by_id_jquery($sql);
			$sum_price = $this->Model_pharmacy->sum_of_price($total);
			if(!$result){
				echo ' ';
				exit;
			}

			$data['result'] = $result;
			$data['sum_of_price'] = $sum_price->TotalItemsPrice;
			$data['patient_id'] = $patient_id;
			$this->load->view('pharmacy/view_form_medicine', $data);
			exit;
		}

		echo 'null';
		exit;
	}

	public function check_stock(){
		if(isset($_POST['task'])){
			if($_POST['task'] == 'check_stock'){
				$pId = $_POST['id'];
				$quantity = $_POST['quantity'];

				if($quantity == ''){
					echo " ";
					return;
				}

				$stock_data = $this->Model_pharmacy->get_medicine_by_id($pId);

				$stock_value = $stock_data->quantity;
				if($stock_value == 0){
					echo '<div style="color:#fff;font-weight:bold;line-height:15px;border-radius:4px;background-color:#F0677C;padding:10px;">Item no longer available in stock !</div>';
					return;
				}

				if($stock_value == 20){
					echo '<div style="color:#fff;font-weight:bold;line-height:15px;border-radius:4px;background-color:#F0677C;padding:10px;">Quantity is about to finish  ' . $stock_value . ' left !</div>';
					
				}

				if($quantity <= $stock_value){
					echo "";
					return;
				}else{
					echo '<div style="color:#fff;font-weight:bold;line-height:15px;border-radius:4px;background-color:#F0677C;padding:10px;">Quantity is out of stock !</div>';
					return ;
				}
			}
		}
	}

	public function medicine_order(){
		if(isset($_POST['medicine_name'])){
			$medicine = $_POST['medicine_name'];
			$company = $_POST['medicine_company'];
			$price = $_POST['medicine_price'];
			$stock = $_POST['medicine_stock'];
			$quantity = $_POST['medicine_quantity'];
			$medicine_id = $_POST['medicineId'];
			$patient_id = $_POST['patientId'];
			$a = array();
			$data_medicine = array();
			$aa = array('medicine_name' => $medicine,
			  			'price' => $price,
						'quantity' => $quantity,
						'medicine_id' => $medicine_id
					);	
			
			for($i=0; $i<count($aa['medicine_name']); $i++){
				$a[] = array_column($aa, $i); // using array_column to group all indexes together for each drug posted
			}

			foreach($a as $p => $k){
				$result = array($medicine[$p] => $k);
				$data_medicine[] = $result;
			}

			// $_SESSION['cart_item'] = $data_medicine;
			$this->session->set_userdata('cart', $data_medicine);
			// print_r($this->session->userdata('cart')[1]['Vitamin c']);

			$data['patient_id'] = $patient_id;
			$data['medicine_id'] = $medicine_id;
			$this->load->view('pharmacy/medicine_order_invoice', $data);
		}
		
		redirect('/pharmacy/pos/', 'refresh');
	}

	public function search_key_item(){
		$id = $_POST['id'];
		$name = $this->Model_pharmacy->get_medicine_by_id($id);
		if($name == 'no result'){
			echo 'Medicine not longer exists or have been deleted...';
			exit;
		}
		$medicine_name = $name->name;
		$data_search = $this->session->userdata('cart');
		// print_r($this->session->userdata('cart_item'));

		foreach($data_search as $p => $k){
			foreach($k as $i =>$j){
				if($c = array_search($id, $j)){
					if($j[$c] == $id){
						if(!empty($this->session->userdata('cart'))){
							foreach($this->session->userdata('cart') as $a => $v){
								foreach($v as $key => $value){
									if($medicine_name == $key)
										// $this->session->userdata('cart')[1]['Vitamin c']
										// print_r($a);
										$this->session->unset_userdata('cart')[$a][$medicine_name];

									if(empty($this->session->userdata('cart')))
										$this->session->unset_userdata('cart');
								}
							}
						}
					}
				}
			}
		}
	}

	public function final_order(){
		if(isset($_POST['btnSubmitOrder'])){
			$each_id = '';
			$each_quantity = '';
			$patient_id = $_POST['patient_id'];
			$itemDiscount = $_POST['itemDiscount'];
			$final_total = $_POST['final_total'];
			$medicine_id = $_POST['medicine_id'];
			$quantity = $_POST['quantity'];
			$each_id .= implode(",", $medicine_id);
			$each_quantity .= implode(",", $quantity);

			for($j = 0;$j<count($medicine_id); $j++){
				$check_result = $this->Model_pharmacy->get_pharmacy_quantity($medicine_id[$j]);
				if($check_result == 'no result'){
					echo "Medicine with the id '$j' does not exists or have been deleted...";
					exit;
				}
				$stock_value = $check_result->quantity;
				if($stock_value <= 0){ ?>
					<div style="color:#fff;margin-left:30%;font-weight:bold;width:90%;line-height:30px;border-radius:4px;background-color:#F0677C;padding:10px;"> Medicine no longer available in stock !</div>
				<?php }
				if($quantity[$j] <= $stock_value){
					$newStock = (int)($stock_value - $quantity[$j]);
					$data = array(
						'quantity' => $newStock
					);
					
					$this->Model_pharmacy->update_pharmacy($medicine_id[$j], $data, 'medicine');
				}
				// continue;
			}
			

			$name = $this->checkRole->role . ' ' . $this->checkRole->first_name . ' ' . $this->checkRole->last_name;
				$data = array(
					'patient_id' => $patient_id,
					'medicine_id' => $each_id,
					'quantity' => $each_quantity,
					'discount' => $itemDiscount,
					'total'	=> $final_total,
					'date_created' => date('Y-m-d H:i:s'),
					'submitted_by'	=> $name
				);

				$result = $this->Model_pharmacy->put_pharmacy('medicine_sold', $data);
				if(!$result){
					echo "Error performing the system operation...";
					exit;
				}

			$this->session->set_flashdata('success', 'You have successfully submitted the invoice.');
			redirect('/pharmacy/view_medicine_sold/', 'refresh');
		}
	}

	public function view_medicine_sold(){
		$result = $this->Model_pharmacy->view_pharmacy('medicine_sold');
		// print_r($result);

		$data['data_sold'] = $result;
		$data['permission'] = $this->get_role_name();
		$this->load->view('pharmacy/view_medicine_sold',$data);
	}

	public function edit(){
		if(isset($_POST['edit'])){
			$id = trim($_POST['id']);
			$category = $_POST['category_name'];
			$desc = $_POST['desc_info'];
			$name = $this->checkRole->role . ' ' . $this->checkRole->first_name . ' ' . $this->checkRole->last_name;
			$data = array(
				'category_name' => $category,
				'description' => $desc,
				'date_modified' => date('Y-m-d H:i:s'),
				'modifier' => $name
			);

			$updated = $this->Model_pharmacy->update_pharmacy($id,$data,'medicine_category');

			if(!$updated){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Updated';
		}
	}

	public function update_quantity($id){
		if(isset($_POST['task'])){
			$id = trim($id);
			$quantity = $_POST['data_quantity'];
			$quantity = trim($quantity);
			if(!is_numeric($quantity)){
				echo "Please enter a numeric value";
				exit;
			}

			$result = $this->Model_pharmacy->get_pharmacy_quantity($id);
			$old_quantity = $result->quantity;
			$new_quantity = $old_quantity + $quantity;

			$name = $this->checkRole->role . ' ' . $this->checkRole->first_name . ' ' . $this->checkRole->last_name;
			$data = array(
				'quantity' => $new_quantity,
				'date_modified' => date('Y-m-d H:i:s'),
				'modifier' => $name
			);

			$updated = $this->Model_pharmacy->update_pharmacy($id,$data,'medicine');

			if(!$updated){
				echo 'Error performing the operation';
				exit;
			}

			echo 'Updated';
		}
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

	public function edit_medicine_update(){
		if(isset($_POST['btnUpdateMedicine'])){
			$id = $this->input->post('update_medicine_id');
			$name = $this->checkRole->role . ' ' . $this->checkRole->first_name . ' ' . $this->checkRole->last_name;
			$data = array(
                'name' => $this->input->post('name'),
                'category' => $this->input->post('medicine_category'),	
                'manufacture_date' => $this->input->post('manufacture_date'),	
                'form' => $this->input->post('form'),	
                'packing' => $this->input->post('packing'),	
                'effect' => $this->input->post('effect'),	
                'generic_name' => $this->input->post('generic_name'),	
                'quantity' => $this->input->post('quantity'),	
                'expire_date' => $this->input->post('expire_date'),	
                'selling_price' => $this->input->post('selling_price'),	
                'company' => $this->input->post('company'),	
                'purchase_price' => $this->input->post('purchase_price'),	
                'date_modified' => date('Y-m-d H:i:s'),
                'modifier' => $name
            );

            $updated = $this->Model_pharmacy->update_pharmacy($id,$data,'medicine');

			if(!$updated){
				echo 'Error performing the operation';
				exit;
			}

            $this->session->set_flashdata('success', 'You have successfuly updated the medicine.');
            redirect('/pharmacy/view_medicine/', 'refresh');
		}
	}

	public function delete($id){
		$action = $_POST['delete'];
		$task = $_POST['task'];
		if(isset($action)){
			if($task == 'category'){
				$id = trim($id);

				$deleted = $this->Model_pharmacy->delete_pharmacy($id,'medicine_category');

				if(!$deleted){
					echo 'Error performing the operation';
					exit;
				}

				echo 'Deleted';
				exit;

			}else if($task == 'medicine'){
				$id = trim($id);

				$deleted = $this->Model_pharmacy->delete_pharmacy($id,'medicine');

				if(!$deleted){
					echo 'Error performing the operation';
					exit;
				}

				echo 'Deleted';
				exit;
			}else if($task == 'medicine_sold'){
				$id = trim($id);

				$deleted = $this->Model_pharmacy->delete_pharmacy($id,'medicine_sold');

				if(!$deleted){
					echo 'Error performing the operation';
					exit;
				}

				echo 'Deleted';
				exit;
			}
		}

	}

	public function show_restrict(){
		$this->load->view('restriction/block');
	}

}