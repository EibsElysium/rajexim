<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Terms_of_payment Controls details
    Date    :29-02-2020 
****************************************************************/
class Terms_and_payment extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Terms_and_payment_model','Terms_of_payment_model'));
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
		$data['get_top_type'] = $this->Terms_of_payment_model->get_terms_of_payment_type();
		$data['terms_and_payment_list'] = $this->Terms_and_payment_model->get_terms_and_payment_list();
		$this->load->view('terms_and_payment/terms_and_payment_list', $data);
	}
	//To check Unique price term name
	public function checkUniquetapName()
	{
		$exp = $_POST['value'];
		$qstage = $this->Terms_and_payment_model->checkUniquetapName($exp);
		
		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}
	//To add price term into database
	public function create_tap()
	{
		$data['tap_name']=$this->input->post('tap_name');
		$data['tap_value']=$this->input->post('tap_value');
		$data['terms_of_payment_type_id']=$this->input->post('terms_of_payment_type_id');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Terms_and_payment_model->create_tap($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Terms and payment has been added successfully.');
      		redirect('/Terms_and_payment');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Terms_and_payment');
	    }
	}

	public function tap_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Terms_and_payment_model->tap_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function tap_edit()
	{
		$eid = $_POST['value'];
		
		$data['get_top_type'] = $this->Terms_of_payment_model->get_terms_of_payment_type();
		$data['tap_by_id'] = $this->Terms_and_payment_model->get_tap_by_id($eid);
		$this->load->view('terms_and_payment/terms_and_payment_edit', $data);
	}

	public function update_tap()
	{
		$data['tap_id'] = $this->input->post('tap_id');
		$data['tap_name']=$this->input->post('e_tap_name');
		$data['tap_value']=$this->input->post('e_tap_value');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
		$data['terms_of_payment_type_id']=$this->input->post('terms_of_payment_type_id');

	    $result = $this->Terms_and_payment_model->update_tap($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Terms and payment has been updated successfully.');
      		redirect('/Terms_and_payment');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Terms_and_payment');
	    }
	}
	//To interest_delete from list 
	public function tap_delete()
	{
		$tap_id = $this->input->post('del_terms_and_payment_id');
		$result = $this->Terms_and_payment_model->tap_delete($tap_id);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Terms and payment has been Deleted successfully.');
      		redirect('/Terms_and_payment');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Terms_and_payment');
	    }
	}
}
?>