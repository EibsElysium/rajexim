<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Port extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Port_model'));
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
		$data['vessel_flight_list'] = $this->Port_model->get_active_vessel_flight_list();
		$data['port_list'] = $this->Port_model->get_port_list();
		$this->load->view('port/port_list', $data);
	}

	public function checkUniquePort()
	{
		$exp = $_POST['value'];
		$qstage = $this->Port_model->checkUniquePort($exp);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function create_port()
	{
		$data['vessel_flight_id']=$this->input->post('vessel_flight_id');
		$data['port_name']=$this->input->post('port_name');
		$data['port_city']=$this->input->post('port_city');
		$data['port_country']=$this->input->post('port_country');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $admindata['user_id'];

	    $result = $this->Port_model->create_port($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Port has been added successfully.');
      		redirect('/port');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/port');
	    }
	}

	public function port_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Port_model->port_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function port_delete()
	{
		$data['eid']=$_POST['id'];
		$this->load->view('port/port_delete',$data);
	}

	public function delete(){ 
		$eid=$_POST['field'];
		$result = $this->Port_model->port_delete($eid);
		if ($result) {
		  $this->session->set_flashdata('qstate_success', 'Port has been Deleted successfully.');
		}
		else{
		  $this->session->set_flashdata('qstage_err', 'Something went wrong');
		}
	}

	public function port_edit()
	{
		$eid = $_POST['value'];
		$data['vessel_flight_list'] = $this->Port_model->get_active_vessel_flight_list();
		$data['port_list'] = $this->Port_model->get_port_by_id($eid);
		$this->load->view('port/port_edit', $data);
	}

	// Check Exporter Unique
	public function checkUniquePortEdit()
	{
		$exp = $_POST['value'];
		$eid = $_POST['eid'];
		$qstage = $this->Port_model->checkUniquePortEdit($exp,$eid);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	// Add Exporter
	public function update_port()
	{
		$data['port_id'] = $this->input->post('port_id');
		$data['vessel_flight_id']=$this->input->post('vessel_flight_id');
		$data['port_name']=$this->input->post('port_name');
		$data['port_city']=$this->input->post('port_city');
		$data['port_country']=$this->input->post('port_country');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $admindata['user_id'];

	    $result = $this->Port_model->update_port($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Port has been updated successfully.');
      		redirect('/port');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/port');
	    }
	}

}
?>