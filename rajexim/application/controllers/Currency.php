<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/***************************************************************

    Purpose : To handle all the Currnecy Controls details

    Date    :29-02-2020 

****************************************************************/

class Currency extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Currency_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}
	//To list All Currency in index page of this settings..
	public function index()
	{
		$data['currency_list'] = $this->Currency_model->get_currency_list();
		$this->load->view('currency/currency_list', $data);
	}
	//To check Unique Currency name
	public function checkUniqueCurrencyName()
	{
		$exp = $_POST['value'];
		$qstage = $this->Currency_model->checkUniqueCurrencyName($exp);

		

		if(count($qstage) > 0){ echo 1; }else{ echo 0; }

	}

	//To check Unique Currency name

	public function checkUniqueCurrencyCode()

	{

		$exp = $_POST['value'];

		$qstage = $this->Currency_model->checkUniqueCurrencyCode($exp);

		

		if(count($qstage) > 0){ echo 1; }else{ echo 0; }

	}

	//To add price term into database

	public function create_currency()

	{

		$data['currency_name']=$this->input->post('currency_name');

		$data['currency_code'] = $this->input->post('currency_code');

		$data['currency_symb'] = $this->input->post('currency_symb');

		$data['currency_int'] = $this->input->post('currency_int');

		$data['currency_dec'] = $this->input->post('currency_dec');

	    $data['created_on'] = date('Y-m-d H:i:s');

	    $data['created_by'] = $_SESSION['admindata']['user_id'];



	    $result = $this->Currency_model->create_currency($data);

	    if($result)

	    {

	    	$this->session->set_flashdata('qstage_success', 'Currency has been added successfully.');

      		redirect('/Currency');

	    }

	    else

	    {

	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');

      		redirect('/Currency');

	    }

	}

	//To Change staus active and in-active controler function

	public function currency_change_status()

	{

		$qsid = $this->input->post('id');

		$status = $this->input->post('status');



		$result = $this->Currency_model->currency_change_status($qsid, $status);

		if($result){ echo 1; }else{ echo 0; }

	}

	//To get and open currency edit modal right here

	public function currency_edit()

	{

		$eid = $_POST['value'];

		$data['currency_by_id'] = $this->Currency_model->get_currency_by_id($eid);

		$this->load->view('currency/currency_edit', $data);

	}

	//To update currency controller function

	public function update_currency()

	{

		$data['currency_id'] = $this->input->post('currency_id');

		$data['currency_name']=$this->input->post('e_currency_name');

		$data['currency_code'] = $this->input->post('e_currency_code');

		$data['currency_symb'] = $this->input->post('e_currency_symb');

		$data['currency_int'] = $this->input->post('e_currency_int');

		$data['currency_dec'] = $this->input->post('e_currency_dec');

	    $data['modi_on'] = date('Y-m-d H:i:s');

	    $data['modi_by'] = $_SESSION['admindata']['user_id'];



	    $result = $this->Currency_model->update_currency($data);

	    if($result)

	    {

	    	$this->session->set_flashdata('qstage_success', 'Currency has been updated successfully.');

      		redirect('/Currency');

	    }

	    else

	    {

	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');

      		redirect('/Currency');

	    }

	}

	//To delete currency_delete from list 

	public function currency_delete()

	{

		$currency_id = $this->input->post('del_currency_id');

		$result = $this->Currency_model->currency_delete($currency_id);

	    if($result)

	    {

	    	$this->session->set_flashdata('qstage_success', 'Currency has been Deleted successfully.');

      		redirect('/Currency');

	    }

	    else

	    {

	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');

      		redirect('/Currency');

	    }

	}

}

?>