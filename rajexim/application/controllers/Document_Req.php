<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Document_Req Controls details
    Date    :29-02-2020 
****************************************************************/
class Document_Req extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Document_Req_model'));
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
		$data['doc_req_list'] = $this->Document_Req_model->get_doc_req_list();
		$this->load->view('document_requirement/doc_req_list', $data);
	}
	//To check Unique price term name
	public function checkUniquedocReq()
	{
		$exp = $_POST['value'];
		$qstage = $this->Document_Req_model->checkUniquedocReq($exp);
		
		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}
	//To add price term into database
	public function create_doc_req()
	{
		$data['doc_req']=$this->input->post('doc_req');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Document_Req_model->create_doc_req($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Document Required has been added successfully.');
      		redirect('/Document_Req');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Document_Req');
	    }
	}

	public function doc_req_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Document_Req_model->doc_req_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function doc_req_edit()
	{
		$eid = $_POST['value'];
		
		$data['doc_req_by_id'] = $this->Document_Req_model->get_doc_req_by_id($eid);
		$this->load->view('document_requirement/doc_req_edit', $data);
	}

	public function update_doc_req()
	{
		$data['doc_req_id'] = $this->input->post('doc_req_id');
		$data['doc_req']=$this->input->post('e_doc_req');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Document_Req_model->update_doc_req($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Document Required has been updated successfully.');
      		redirect('/Document_Req');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Document_Req');
	    }
	}
	//To interest_delete from list 
	public function doc_req_delete()
	{
		$doc_req_id = $this->input->post('del_doc_req_id');
		$result = $this->Document_Req_model->doc_req_delete($doc_req_id);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Document Required has been Deleted successfully.');
      		redirect('/Document_Req');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Document_Req');
	    }
	}
}
?>