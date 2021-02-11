<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Interest Controls details
    Date    :29-02-2020 
****************************************************************/
class Interests extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Interest_model'));
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
		$data['interests_list'] = $this->Interest_model->get_interests_list();
		$this->load->view('interest/interest_list', $data);
	}
	//To check Unique price term name
	public function checkUniqueInterestLabel()
	{
		$exp = $_POST['value'];
		$qstage = $this->Interest_model->checkUniqueInterestLabel($exp);
		
		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}
	//To add price term into database
	public function create_Interest()
	{
		$data['interest_label']=$this->input->post('interest_label');
		$data['interest_text'] = $this->input->post('interest_text');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Interest_model->create_Interest($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Interest has been added successfully.');
      		redirect('/Interests');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Interests');
	    }
	}

	public function interest_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Interest_model->interest_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function interest_edit()
	{
		$eid = $_POST['value'];
		$data['interest_by_id'] = $this->Interest_model->get_interest_by_id($eid);
		$this->load->view('interest/interest_edit', $data);
	}

	public function update_Interest()
	{
		$data['interest_id'] = $this->input->post('interest_id');
		$data['interest_label']=$this->input->post('e_interest_label');
		$data['interest_text'] = $this->input->post('e_interest_text');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Interest_model->update_Interest($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Interest has been updated successfully.');
      		redirect('/Interests');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Interests');
	    }
	}
	//To interest_delete from list 
	public function interest_delete()
	{
		$interest_id = $this->input->post('del_interest_id');
		$result = $this->Interest_model->delete_interest($interest_id);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Interest has been Deleted successfully.');
      		redirect('/Interests');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Interests');
	    }
	}
}
?>