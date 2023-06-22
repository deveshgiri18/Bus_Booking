<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_bus_booking extends CI_Controller
{


	public function index()
	{
       	$data = array();
		$this->load->model('Admin_bus_booking_model');
		$data["role_list"] = $this->Admin_bus_booking_model->get_all_data();
        $data["list"] = $this->Admin_bus_booking_model->get_data_bus_booking();
        $this->load->view('include/header');
        $this->load->view('include/side_panel');
        $this->load->view('bus_booking', $data);
        $this->load->view('include/footer');
    }

    public function bus_booking_add()
    {
        $data = array();
		$name = $this->input->post('name');
		$busno = $this->input->post('busno');
		$date = $this->input->post('date');
		$seats = $this->input->post('seats');
		$num = $this->input->post('num');

		if ($name == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Bus No';
		} 
		if ($busno == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Bording';
		}
		if ($date == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Destination';
		}
		if ($seats == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Journey Date';
		}
		if ($num == "") {
			$data['response'] = False;
			$data['message'] = 'Please enter Amount';
		}
		else {
			$this->load->model('Admin_bus_booking_model');
			$r = $this->Admin_bus_booking_model->get_bus_details($busno);
		$start = $r[0]->start;
		$end = $r[0]->end;

		$amount = $r[0]->amount;

			$insert_arr = array('name' => $name,'busno' => $busno,'date' => $date,'start'=>$start,'end'=>$end,'amount'=>$amount,
			'seats' => $seats,'num' => $num);
			$res = $this->Admin_bus_booking_model->bus_booking_add($insert_arr);
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

            public function get_data_bus_booking()
            {
                $data = array();
                $data["title"] = "bus_booking";
                $this->load->model('Admin_bus_booking_model');
                $data["list"] = $this->Admin_bus_booking_model->get_data_bus_booking();
               $this->load->view('include/header', $data);
		       $this->load->view('include/side_panel', $data);
		       $this->load->view('bus_booking', $data);
		       $this->load->view('include/footer', $data);
            }
    }

