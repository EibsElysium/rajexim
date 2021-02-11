<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vesselflight extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Vesselflight_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}

	public function index()
	{
		$data['vessel_flight_list'] = $this->Vesselflight_model->get_vessel_flight_list();
		$this->load->view('vesselflight/vessel_flight_list', $data);
	}

	public function checkUniqueVesselFlight()
	{
		$exp = $_POST['value'];
		$qstage = $this->Vesselflight_model->checkUniqueVesselFlight($exp);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function create_vessel_flight()
	{
		$data['vessel_flight_name']=$this->input->post('vessel_flight_name');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $admindata['user_id'];

	    $result = $this->Vesselflight_model->create_vessel_flight($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Vessel Flight has been added successfully.');
      		redirect('/vesselflight');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/vesselflight');
	    }
	}

	public function vessel_flight_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Vesselflight_model->vessel_flight_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function vessel_flight_delete()
	{
		$data['eid']=$_POST['id'];
		$this->load->view('vesselflight/vessel_flight_delete',$data);
	}

	public function delete(){ 
		$eid=$_POST['field'];
		$result = $this->Vesselflight_model->vessel_flight_delete($eid);
		if ($result) {
		  $this->session->set_flashdata('qstate_success', 'Vessel Flight has been Deleted successfully.');
		}
		else{
		  $this->session->set_flashdata('qstage_err', 'Something went wrong');
		}
	}

	public function vessel_flight_edit()
	{
		$eid = $_POST['value'];
		$data['vessel_flight_list'] = $this->Vesselflight_model->get_vessel_flight_by_id($eid);
		$this->load->view('vesselflight/vessel_flight_edit', $data);
	}

	// Check Exporter Unique
	public function checkUniqueVesselFlightEdit()
	{
		$exp = $_POST['value'];
		$eid = $_POST['eid'];
		$qstage = $this->Vesselflight_model->checkUniqueVesselFlightEdit($exp,$eid);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	// Add Exporter
	public function update_vessel_flight()
	{
		$data['vessel_flight_id'] = $this->input->post('vessel_flight_id');
		$data['vessel_flight_name']=$this->input->post('vessel_flight_name');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $admindata['user_id'];

	    $result = $this->Vesselflight_model->update_vessel_flight($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Vessel Flight has been updated successfully.');
      		redirect('/vesselflight');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/vesselflight');
	    }
	}

}
?>