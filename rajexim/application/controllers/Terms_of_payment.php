<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Terms_of_payment Controls details
    Date    :29-02-2020 
****************************************************************/
class Terms_of_payment extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Terms_of_payment_model'));
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
		$data['terms_of_payment_list'] = $this->Terms_of_payment_model->get_terms_of_payment_list();
		$this->load->view('terms_of_payment/terms_of_payment_list', $data);
	}

	public function getTermsandPayment()
	{
		$tapid = $_POST['id'];
		$tap_list = $this->Terms_of_payment_model->get_terms_and_payment_by_type_id($tapid);
		$option = '<option value="">Choose Terms of Payment</option>';
		foreach($tap_list as $plist)
		{
			$option.='<option value="'.$plist['terms_and_payment_id'].'">'.$plist['terms_and_payment'].'</option>';
		}
		echo $option;
	}

	//To check Unique price term name
	public function checkUniquetopName()
	{
		$exp = $_POST['value'];
		$qstage = $this->Terms_of_payment_model->checkUniquetopName($exp);
		
		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}
	//To add price term into database
	public function create_top()
	{
		$data['top_name']=$this->input->post('top_name');
		$data['top_text'] = $this->input->post('top_text');
		$data['top_type'] = $this->input->post('top_type');
		$data['terms_and_payment_id'] = $this->input->post('terms_and_payment_id');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Terms_of_payment_model->create_top($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Terms of payment has been added successfully.');
      		redirect('/Terms_of_payment');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Terms_of_payment');
	    }
	}

	public function top_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Terms_of_payment_model->top_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function top_edit()
	{
		$eid = $_POST['value'];
		$data['get_top_type'] = $this->Terms_of_payment_model->get_terms_of_payment_type();
		$top_by_id = $data['top_by_id'] = $this->Terms_of_payment_model->get_top_by_id($eid);
		$data['tap_list'] = $this->Terms_of_payment_model->get_terms_and_payment_by_type_id($top_by_id->terms_of_payment_type_id);
		$this->load->view('terms_of_payment/terms_of_payment_edit', $data);
	}

	public function update_top()
	{
		$data['top_id'] = $this->input->post('top_id');
		$data['top_name']=$this->input->post('e_top_name');
		$data['top_text'] = $this->input->post('e_top_text');
		$data['top_type'] = $this->input->post('e_top_type');
		$data['terms_and_payment_id'] = $this->input->post('terms_and_payment_id');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->Terms_of_payment_model->update_top($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Terms of payment has been updated successfully.');
      		redirect('/Terms_of_payment');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Terms_of_payment');
	    }
	}
	//To interest_delete from list 
	public function top_delete()
	{
		$top_id = $this->input->post('del_terms_of_payment_id');
		$result = $this->Terms_of_payment_model->top_delete($top_id);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Terms of payment has been Deleted successfully.');
      		redirect('/Terms_of_payment');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/Terms_of_payment');
	    }
	}
}
?>