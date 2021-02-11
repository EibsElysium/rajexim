<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Interest Controls details
    Date    :29-02-2020 
****************************************************************/
class PI_Stages extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('PI_Stage_model'));
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
		$data['pi_stage_list'] = $this->PI_Stage_model->get_pi_stage_list();
		$this->load->view('pi_stage/pi_stage_list', $data);
	}
	//To check Unique price term name
	public function checkUniquePIStage()
	{
		$exp = $_POST['value'];
		$qstage = $this->PI_Stage_model->checkUniquePIStage($exp);
		
		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}
	//To add price term into database
	public function create_pi_stage()
	{
		$data['pi_stage']=$this->input->post('pi_stage');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->PI_Stage_model->create_pi_stage($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'PI Stage has been added successfully.');
      		redirect('/PI_Stages');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/PI_Stages');
	    }
	}

	public function pi_stage_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->PI_Stage_model->pi_stage_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function pi_stage_edit()
	{
		$eid = $_POST['value'];
		$data['pi_stage_by_id'] = $this->PI_Stage_model->get_pi_stage_by_id($eid);
		$this->load->view('pi_stage/pi_stage_edit', $data);
	}

	public function update_pi_stage()
	{
		$data['pi_stage_id'] = $this->input->post('pi_stage_id');
		$data['pi_stage']=$this->input->post('e_pi_stage');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->PI_Stage_model->update_pi_stage($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'PI Stage has been updated successfully.');
      		redirect('/PI_Stages');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/PI_Stages');
	    }
	}
	//To pi_stage_delete from list 
	public function pi_stage_delete()
	{
		$pi_stage_id = $this->input->post('del_pi_stage_id');
		$result = $this->PI_Stage_model->pi_stage_delete($pi_stage_id);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'PI Stage has been Deleted successfully.');
      		redirect('/PI_Stages');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/PI_Stages');
	    }
	}
}
?>