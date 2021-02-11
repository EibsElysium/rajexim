<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Followupsheetstage extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Followupsheetstage_model'));
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
		$data['followup_sheet_stage_list'] = $this->Followupsheetstage_model->get_followup_sheet_stage_list();
		$this->load->view('followupsheetstage/followup_sheet_stage_list', $data);
	}

	public function checkUniqueFollowupSheetStage()
	{
		$exp = $_POST['value'];
		$qstage = $this->Followupsheetstage_model->checkUniqueFollowupSheetStage($exp);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function create_followup_sheet_stage()
	{
		$data['followup_sheet_stage']=str_replace("'", "`", $this->input->post('followup_sheet_stage'));
		$data['stage_color']=$this->input->post('stage_color');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Followupsheetstage_model->create_followup_sheet_stage($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Followup Sheet Stage has been added successfully.');
      		redirect('/followupsheetstage');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/followupsheetstage');
	    }
	}

	public function followup_sheet_stage_edit()
	{
		$fscid = $_POST['value'];
		$data['followup_sheet_stage'] = $this->Followupsheetstage_model->get_followup_sheet_stage_by_id($fscid);
		$this->load->view('followupsheetstage/followup_sheet_stage_edit', $data);
	}

	public function checkUniqueFollowupSheetStageEdit()
	{
		$exp = $_POST['value'];
		$fscid = $_POST['fscid'];
		$qstage = $this->Followupsheetstage_model->checkUniqueFollowupSheetStageEdit($exp,$fscid);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function update_followup_sheet_stage()
	{
		$data['followup_sheet_stage_id'] = $this->input->post('followup_sheet_stage_id');
		$data['followup_sheet_stage']=str_replace("'", "`", $this->input->post('followup_sheet_stage'));
		$data['stage_color']=$this->input->post('stage_color');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Followupsheetstage_model->update_followup_sheet_stage($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Followup Sheet Stage has been updated successfully.');
      		redirect('/followupsheetstage');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/followupsheetstage');
	    }
	}

}
?>