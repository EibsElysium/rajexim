<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Arbitration Controls details
    Date    :29-02-2020 
****************************************************************/
class Arbitrations extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Arbitration_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          redirect('Dashboard');
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}
	//To list All price Terms in index page of this settings..
	public function index()
	{
		$data['arbitrations_list'] = $this->Arbitration_model->get_arbitrations_list();
		$this->load->view('arbitration/arbitration_list', $data);
	}
	//To check Unique price term name
	public function checkUniquearbitrationLabel()
	{
		$exp = $_POST['value'];
		$qstage = $this->Arbitration_model->checkUniquearbitrationLabel($exp);
		
		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}
	//To add price term into database
	public function create_Arbitration()
	{
		$data['arbitration_label']=$this->input->post('arbitration_label');
		$data['arbitration_text'] = $this->input->post('arbitration_text');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Arbitration_model->create_Arbitration($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Arbitration has been added successfully.');
      		redirect('/Arbitrations');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Arbitrations');
	    }
	}

	public function arbitration_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Arbitration_model->arbitration_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function arbitration_edit()
	{
		$eid = $_POST['value'];
		$data['aribitration_by_id'] = $this->Arbitration_model->get_aribitration_by_id($eid);
		$this->load->view('arbitration/arbitration_edit', $data);
	}

	public function update_Arbitration()
	{
		$data['arbitration_id'] = $this->input->post('arbitration_id');
		$data['arbitration_label']=$this->input->post('e_arbitration_label');
		$data['arbitration_text'] = $this->input->post('e_arbitration_text');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Arbitration_model->update_Arbitration($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Arbitration has been updated successfully.');
      		redirect('/Arbitrations');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Arbitrations');
	    }
	}
	//To Arbitration_delete from list 
	public function Arbitration_delete()
	{
		$arbi_id = $this->input->post('del_arbitration_id');
		$result = $this->Arbitration_model->delete_arbitration($arbi_id);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Arbitration has been Deleted successfully.');
      		redirect('/Arbitrations');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Arbitrations');
	    }
	}
}
?>