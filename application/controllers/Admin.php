<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{


	public function index()
	{
		
		$this->load->view('admin_login');
		
		$this->load->model('Admin_model');
	}

	public function admin_login()
	{
		$data = array();
		$email = $this->input->post('email');
		// print_r($email);die;
		$password = $this->input->post('password');
		if ($email == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter your email';
		} else if ($password == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter your Password';
		} else {
			
			// print_r($res);die;
			$this->load->model('Admin_model');
			$res = $this->Admin_model->check_login($email, $password);
			if ($res != false) {

				$data['response'] = True;
				} else {
				$data['response'] = False;
				$data['message'] = 'your password is worng';
			}
		}
		echo json_encode($data);
	}

	public function admin_page()
	{
		
		$this->load->view('include/header');
		$this->load->view('include/side_panel');
		$this->load->view('admin_page');
		$this->load->view('include/footer');
	}

	public function location()
	{
		
		$this->load->view('include/header');
		$this->load->view('include/side_panel');
		$this->load->view('location');
		$this->load->view('include/footer');
	}

	public function add_location()
	{
		$data = array();
		$name = $this->input->post('name');

		if ($name == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter your Location name';
		} else {
			$this->load->model('Admin_model');
			$res = $this->Admin_model->check_name($name);
			if ($res == false) {
				$insert_arr = array('name' => $name);

				$res = $this->Admin_model->add_location($insert_arr);
				if ($res > 0) {
					$data['response'] = True;
					$data['message'] = 'Your data insert successfully';
				} else {
					$data['response'] = False;
					$data['message'] = 'Something went worng';
				}
			} else {
				$data['response'] = False;
				$data['message'] = 'This Location Is already Inside The Table';
			}
		}
		echo json_encode($data);
	}

	public function get_all_data()
	{
		$data = array();
		$this->load->model('Admin_model');
		$res = $this->Admin_model->get_all_data();
		if ($res != false) {
			$data['no_of_records'] = $res;
			 $data['total_records'] = count($res);
			$data['response'] = true;
		} else {
			$data['response'] = False;
			$data['message'] = 'No record found';
		}

		echo json_encode($data);
	}

	public function get_data_by_id(){
		$data = array();
		
		$id = $this->input->post('id');
		if($id == ""){
			$data['response'] = false;
			$data['message'] = 'invalid request';
		}
		$this->load->model('Admin_model');
		$res = $this->Admin_model->get_data_by_id($id);
		//print_r($res);die;
		if($res != false){
			$data['no_of_records'] = $res;
			$data['total_records'] = count($res);
			$data['response'] = true;
		}else{
			$data['response'] = false;
			$data['message'] = 'There is no record';
		}
		echo json_encode($data);
	}

	public function update_data(){

		$data = array();
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		
		if($name == ""){
			$data['response'] = False;
			$data['message'] = 'Please enter your Location';
		}else{
			$this->load->model('Admin_model');
			$res = $this->Admin_model->check_name($name);
			if($res == false){
				$update_arr = array('name'=>$name,'last_update'=>date('Y-m-d H:i:s'));
				$res = $this->Admin_model->update_data($id,$update_arr);
				if($res == true){
						$data['response'] = True;
						$data['message'] = 'Your data updated successfully';
						
				}else{
					$data['response'] = False;
					$data['message'] = 'updated failed';
				}
			}else{
				$data['response'] = False;
				$data['message'] = 'name id is already exist. please try with another name';
			}
			
			
		}
		echo json_encode($data);

	}

	public function status_update(){

		$data = array();
		$id = $this->input->post('id');
		if($id == ""){
			$data['response'] = False;
			$data['message'] = 'Please enter your Location';
		}else{
			$this->load->model('Admin_model');
			$update_arr = array('action'=> 0,'last_update'=>date('Y-m-d H:i:s'));
			$res = $this->Admin_model->update_data($id,$update_arr);
			if($res == true){
					$data['response'] = True;
			}else{
				$data['response'] = False;
				$data['message'] = 'updated failed';
			}
			
			
			
		}
		echo json_encode($data);

	}

	public function status2_update(){

		$data = array();
		$id = $this->input->post('id');
		if($id == ""){
			$data['response'] = False;
			$data['message'] = 'Please enter your Location';
		}else{
			$this->load->model('Admin_model');
			$update_arr = array('action'=> 1,'last_update'=>date('Y-m-d H:i:s'));
			$res = $this->Admin_model->update_data($id,$update_arr);
			if($res == true){
					$data['response'] = True;
			}else{
				$data['response'] = False;
				$data['message'] = 'updated failed';
			}
			
			
			
		}
		echo json_encode($data);

	}
		
	public function delete_user()
	 {
	  $data = array();
	  if($this->input->is_ajax_request())
	   {
	    $user_id = (isset($_POST["user_id"]))?$this->input->post("user_id" , TRUE):0;
	    if($user_id == 0 || trim($user_id) == "")
	     {
	      $data["response"] = FALSE;
	      $data["message"] = "Invalid User ID.";
	     }
	    else
	     {
	      $this->load->model("Admin_model");
	      
	      $update_arr = array("status" => 0,"action"=>0,'last_update'=>date('Y-m-d H:i:s'));
	      $r = $this->Admin_model->update_data($user_id , $update_arr);
	      if($r == True)
	       {
	        $data["response"] = TRUE;
	        $data["message"] = "User deleted successfully.";
	       }
	      else
	       {
	        $data["response"] = FALSE;
	        $data["message"] = "Some error occured. Please try again later.";
	       }
	     }
	   }else{
		$data["response"] = FALSE;
	        $data["message"] = "Invalid Request";
	   }
	  echo json_encode($data);
	 }

	
	 public function bus_schedule()
	 {
		$data = array();
	  
		$data["title"] = "bus_schedule";
		
		$this->load->model("Admin_model");
		
		$data["role_list"] = $this->Admin_model->action();
		 $this->load->view('include/header', $data);
		 $this->load->view('include/side_panel', $data);
		 $this->load->view('bus_schedule', $data);
		 $this->load->view('include/footer', $data);
	 }

	 public function bus_schedule_add()
	 {
		$data = array();
		$busno = $this->input->post('bus_no');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$date = $this->input->post('date');
		$amount = $this->input->post('amount');

		if ($busno == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Bus No';
		} 
		if ($start == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Bording';
		}
		if ($end == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Destination';
		}
		if ($date == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Journey Date';
		}
		if ($amount == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Amount';
		}
		else {
			$this->load->model('Admin_model');
			$insert_arr = array('busno' => $busno,'start' => $start,'end' => $end,'date' => $date,'amount' => $amount);
			$res = $this->Admin_model->bus_schedule_add($insert_arr);
				if ($res > 0) {
					$data['response'] = True;
					$data['message'] = 'Your data insert successfully';
				} else {
					$data['response'] = False;
					$data['message'] = 'Something went worng';
				}
			}
			echo json_encode($data);
			}

			public function get_all_data_bus_schedule()
	{
		$data = array();
		$this->load->model('Admin_model');
		$res = $this->Admin_model->get_all_data_bus_schedule();
		if ($res != false) {
			$data['no_of_records'] = $res;
			 $data['total_records'] = count($res);
			$data['response'] = true;
		} else {
			$data['response'] = False;
			$data['message'] = 'No record found';
		}

		echo json_encode($data);
	}




	public function get_data_by_id_bus_schedule(){
		$data = array();
		
		$id = $this->input->post('id');
		if($id == ""){
			$data['response'] = false;
			$data['message'] = 'invalid request';
		}
		$this->load->model('Admin_model');
		$res = $this->Admin_model->get_data_by_id_bus_schedule($id);
		//print_r($res);die;
		if($res != false){
			$data['no_of_records'] = $res;
			$data['total_records'] = count($res);
			$data['response'] = true;
		}else{
			$data['response'] = false;
			$data['message'] = 'There is no record';
		}
		echo json_encode($data);
	}

	public function bus_schedule_update(){
// print_r($_POST);die;
		$data = array();
		$id = $this->input->post('id');
		$busno = $this->input->post('busno');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$date = $this->input->post('date');
		$amount = $this->input->post('amount');
		
		if($busno == ""){
			$data['response'] = False;
			$data['message'] = 'Please enter your Bus No';
		}
		if($start == ""){
			$data['response'] = False;
			$data['message'] = 'Please enter your start';
		}
		if($end == ""){
			$data['response'] = False;
			$data['message'] = 'Please enter your end';
		}
		if($date == ""){
			$data['response'] = False;
			$data['message'] = 'Please enter your date';
		}
		if($amount == ""){
			$data['response'] = False;
			$data['message'] = 'Please enter your amount';
		}else{
			$this->load->model('Admin_model');
				$update_arr = array('busno'=>$busno,'start'=>$start,'end'=>$end,'date'=>$date,'amount'=>$amount,'last_update'=>date('Y-m-d H:i:s'));
				$res = $this->Admin_model->bus_schedule_update($id,$update_arr);
				if($res == true){
						$data['response'] = True;
						$data['message'] = 'Your data updated successfully';
						
				}else{
					$data['response'] = False;
					$data['message'] = 'updated failed';
				}
			}
			
			echo json_encode($data);
		}

		public function delete_user_bus_schedule()
	 {
	  $data = array();
	  if($this->input->is_ajax_request())
	   {
	    $user_id = (isset($_POST["user_id"]))?$this->input->post("user_id" , TRUE):0;
	    if($user_id == 0 || trim($user_id) == "")
	     {
	      $data["response"] = FALSE;
	      $data["message"] = "Invalid User ID.";
	     }
	    else
	     {
	      $this->load->model("Admin_model");
	      
	      $update_arr = array("status" => 0,"active"=>0,'last_update'=>date('Y-m-d H:i:s'));
	      $r = $this->Admin_model->bus_schedule_update($user_id , $update_arr);
	      if($r == True)
	       {
	        $data["response"] = TRUE;
	        $data["message"] = "User deleted successfully.";
	       }
	      else
	       {
	        $data["response"] = FALSE;
	        $data["message"] = "Some error occured. Please try again later.";
	       }
	     }
	   }else{
		$data["response"] = FALSE;
	        $data["message"] = "Invalid Request";
	   }
	  echo json_encode($data);
	 }
		

	}
			
		
		

	 
	
 
