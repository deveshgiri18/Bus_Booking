<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
        public function index(){
            $data = array();
            $this->load->model('Home_model');
            $data["role_list"] = $this->Home_model->get_data();
            $this->load->view('home/header');
            $this->load->view('home/home', $data);
            $this->load->view('home/footer',);
			$this->load->view('include/footer',);
        }


        public function get_bus_booking_details(){
            $data= array();
            $gofrom = $this->input->post('gofrom');
            $goto = $this->input->post('goto');
            $dateid = $this->input->post('dateid');
            if ($gofrom == "") {
                $data['response'] = False;
                $data['message'] = 'Please enter your email';
            }else if ($goto == "") {
                $data['response'] = False;
                $data['message'] = 'Please enter your Password';
            }else if ($dateid == "") {
                $data['response'] = False;
                $data['message'] = 'Please enter your Password';
            }else{
            $this->load->model('Home_model');
            $res = $this->Home_model->get_bus_booking_details($goto,$gofrom,$dateid);
            if($res){
                $data['response'] = true;
                $data['total_records'] = count($res);
                $data['all_records'] = $res;
            }else{
                $data['response'] = false;
                $data['message'] ="No records";
            }
           
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
		$this->load->model('Home_model');
		$res = $this->Home_model->get_data_by_id($id);
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

       public function confirm_booking(){
        $data = array();
        $id = $this->input->post('id');
		$name = $this->input->post('name');
		$number = $this->input->post('number');
		$seats = $this->input->post('seats');
		
		

		if ($name == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Your name';
		} 
		else if ($number == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter your number';
		}
		
		else if ($seats == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter seats';
		}
		else {
			$this->load->model('Home_model');
			$r = $this->Home_model->get_data_by_id($id);
		$start = $r[0]->start;
		$end = $r[0]->end;
        $date =$r[0]->date;
        $busno =$r[0]->busno;
		$amount = $r[0]->amount;

			$insert_arr = array('name' => $name,'busno' => $busno,'date' => $date,'start'=>$start,'end'=>$end,'amount'=>$amount,'number'=>$number,'seats'=>$seats);
			$res = $this->Home_model->confirm_booking($insert_arr);
				if ($res > 0) {
					$data['response'] = True;
					$data['message'] = 'Successfully Booking Confirmed';
					// redirect(base_url('Admin'));
				} else {
					$data['response'] = False;
					$data['message'] = 'Something went worng';
				}
			}
			echo json_encode($data);
			}



			public function success(){

				
				$this->load->view('home/success');
				
			}

    }
    