<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Followupsheetcategory extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Followupsheetcategory_model'));
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
		$data['followup_sheet_category_list'] = $this->Followupsheetcategory_model->get_followup_sheet_category_list();
		$this->load->view('followupsheetcategory/followup_sheet_category_list', $data);
	}

	public function checkUniqueFollowupSheetCategory()
	{
		$exp = $_POST['value'];
		$qstage = $this->Followupsheetcategory_model->checkUniqueFollowupSheetCategory($exp);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function create_followup_sheet_category()
	{
		$data['followup_sheet_category']=str_replace("'", "`", $this->input->post('followup_sheet_category'));
		$data['input_type']=$this->input->post('input_type');
		$data['is_default']=$this->input->post('is_default');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Followupsheetcategory_model->create_followup_sheet_category($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Followup Sheet Category has been added successfully.');
      		redirect('/followupsheetcategory');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/followupsheetcategory');
	    }
	}

	public function followup_sheet_category_edit()
	{
		$fscid = $_POST['value'];
		$data['followup_sheet_category'] = $this->Followupsheetcategory_model->get_followup_sheet_category_by_id($fscid);
		$this->load->view('followupsheetcategory/followup_sheet_category_edit', $data);
	}

	public function checkUniqueFollowupSheetCategoryEdit()
	{
		$exp = $_POST['value'];
		$fscid = $_POST['fscid'];
		$qstage = $this->Followupsheetcategory_model->checkUniqueFollowupSheetCategoryEdit($exp,$fscid);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function update_followup_sheet_category()
	{
		$data['followup_sheet_category_id'] = $this->input->post('followup_sheet_category_id');
		$data['followup_sheet_category']=str_replace("'", "`", $this->input->post('followup_sheet_category'));
		$data['input_type']=$this->input->post('input_type');
		$data['is_default']=$this->input->post('is_default');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Followupsheetcategory_model->update_followup_sheet_category($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Followup Sheet Category has been updated successfully.');
      		redirect('/followupsheetcategory');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/followupsheetcategory');
	    }
	}

}
?>