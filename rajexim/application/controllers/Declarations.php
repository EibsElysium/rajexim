<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Declaration Controls details
    Date    :29-02-2020 
****************************************************************/
class Declarations extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Declaration_model'));
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
		$data['declaration_list'] = $this->Declaration_model->get_declaration_list();
		$this->load->view('declaration/declaration_list', $data);
	}
	//To check Unique price term name
	public function checkUniqueDeclarationLabel()
	{
		$exp = $_POST['value'];
		$qstage = $this->Declaration_model->checkUniqueDeclarationLabel($exp);
		
		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}
	//To add price term into database
	public function create_Declaration()
	{
		$data['declaration_label']=$this->input->post('declaration_label');
		$data['declaration_text'] = $this->input->post('declaration_text');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Declaration_model->create_Declaration($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Declaration has been added successfully.');
      		redirect('/Declarations');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Declarations');
	    }
	}

	public function declaration_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Declaration_model->declaration_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function declaration_edit()
	{
		$eid = $_POST['value'];
		$data['declaration_by_id'] = $this->Declaration_model->get_declaration_by_id($eid);
		$this->load->view('declaration/declaration_edit', $data);
	}

	public function update_Declaration()
	{
		$data['declaration_id'] = $this->input->post('declaration_id');
		$data['declaration_label']=$this->input->post('e_declaration_label');
		$data['declaration_text'] = $this->input->post('e_declaration_text');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Declaration_model->update_Declaration($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Declaration has been updated successfully.');
      		redirect('/Declarations');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Declarations');
	    }
	}
	//To declaration_delete from list 
	public function declaration_delete()
	{
		$dec_id = $this->input->post('del_declaration_id');
		$result = $this->Declaration_model->declaration_delete($dec_id);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Declaration has been Deleted successfully.');
      		redirect('/Declarations');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Declarations');
	    }
	}
	public function res_filemanager()
	{
		$this->load->view('responsive_filemanager/filemanager/dialog');
	}
}
?>