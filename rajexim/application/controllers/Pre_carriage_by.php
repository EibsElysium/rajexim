<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Pre_carriage_by Controls details
    Date    :29-02-2020 
****************************************************************/
class Pre_carriage_by extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Pre_carriage_by_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}
	//To list All price Terms in index page of this settings..
	public function index()
	{
		$data['pre_carriage_by_list'] = $this->Pre_carriage_by_model->get_pre_carriage_by_list();
		$this->load->view('pre_carriage_by/pre_carriage_by_list', $data);
	}
	//To check Unique price term name
	public function checkUniquePreCarriage()
	{
		$exp = $_POST['value'];
		$qstage = $this->Pre_carriage_by_model->checkUniquePreCarriage($exp);
		
		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}
	//To add price term into database
	public function create_pre_carriage_by()
	{
		$data['pre_carriage_by']=$this->input->post('pre_carriage_by');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Pre_carriage_by_model->create_pre_carriage_by($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Pre-Carriage by has been added successfully.');
      		redirect('/Pre_carriage_by');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Pre_carriage_by');
	    }
	}

	public function pre_carriage_by_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Pre_carriage_by_model->pre_carriage_by_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function pre_carriage_by_edit()
	{
		$eid = $_POST['value'];
		$data['pre_carriage_by_id'] = $this->Pre_carriage_by_model->get_pre_carriage_by_id($eid);
		$this->load->view('pre_carriage_by/pre_carriage_by_edit', $data);
	}

	public function update_pre_carriage_by()
	{
		$data['pre_carriage_by_id']=$this->input->post('pre_carriage_by_id');
		$data['pre_carriage_by']=$this->input->post('e_pre_carriage_by');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Pre_carriage_by_model->update_pre_carriage_by($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Pre-Carriage by has been updated successfully.');
      		redirect('/Pre_carriage_by');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Pre_carriage_by');
	    }
	}
	//To pi_stage_delete from list 
	public function pre_carriage_by_delete()
	{
		$pre_carriage_by_id = $this->input->post('del_pre_carriage_by_id');
		$result = $this->Pre_carriage_by_model->pre_carriage_by_delete($pre_carriage_by_id);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Pre-Carriage by has been Deleted successfully.');
      		redirect('/Pre_carriage_by');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Pre_carriage_by');
	    }
	}
}
?>