<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the PriceTerms Controls details
    Date    :29-02-2020 
****************************************************************/
class PriceTerms extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('PriceTerms_model'));
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
		$data['price_terms_list'] = $this->PriceTerms_model->get_price_terms_list();
		$this->load->view('price_terms/price_terms_list', $data);
	}
	//To check Unique price term name
	public function checkUniquePriceTermName()
	{
		$exp = $_POST['value'];
		$qstage = $this->PriceTerms_model->checkUniquePriceTermName($exp);
		
		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}
	//To add price term into database
	public function create_price_term()
	{
		$data['price_term_name']=$this->input->post('price_term_name');
		$data['price_term'] = $this->input->post('price_term');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->PriceTerms_model->create_price_term($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Price Term has been added successfully.');
      		redirect('/PriceTerms');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/PriceTerms');
	    }
	}

	public function price_term_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->PriceTerms_model->price_term_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function price_term_edit()
	{
		$eid = $_POST['value'];
		$data['price_term_by_id'] = $this->PriceTerms_model->get_price_term_by_id($eid);
		$this->load->view('price_terms/price_terms_edit', $data);
	}

	public function update_price_term()
	{
		$data['price_term_id'] = $this->input->post('price_term_id');
		$data['price_term_name']=$this->input->post('e_price_term_name');
		$data['price_term'] = $this->input->post('e_price_term');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];

	    $result = $this->PriceTerms_model->update_price_term($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Price Term has been updated successfully.');
      		redirect('/PriceTerms');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/PriceTerms');
	    }
	}
	//To delete priceterms from list 
	public function price_term_delete()
	{
		$price_term_id = $this->input->post('del_price_term_id');
		$result = $this->PriceTerms_model->delete_price_term($price_term_id);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Price Term has been Deleted successfully.');
      		redirect('/PriceTerms');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/PriceTerms');
	    }
	}
}
?>