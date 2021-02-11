<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* ************************************************************************************
		Purpose : To handle all the Exporter functions
		Date    : 28-02-2020 
***************************************************************************************/
class Quotestage extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Quotestage_model'));
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
		$data['quote_stage_list'] = $this->Quotestage_model->get_quote_stage_list();
		$this->load->view('quotestage/quote_stage_list', $data);
	}

	public function checkUniqueQuoteStage()
	{
		$exp = $_POST['value'];
		$qstage = $this->Quotestage_model->checkUniqueQuoteStage($exp);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function create_quote_stage()
	{
		$data['quote_stage']=$this->input->post('quote_stage');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $admindata['user_id'];

	    $result = $this->Quotestage_model->create_quote_stage($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Quote Stage has been added successfully.');
      		redirect('/quotestage');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/quotestage');
	    }
	}

	public function quote_stage_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Quotestage_model->quote_stage_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function quote_stage_delete()
	{
		$data['eid']=$_POST['id'];
		$this->load->view('quotestage/quote_stage_delete',$data);
	}

	public function delete(){ 
		$eid=$_POST['field'];
		$result = $this->Quotestage_model->quote_stage_delete($eid);
		if ($result) {
		  $this->session->set_flashdata('qstate_success', 'Quote Stage has been Deleted successfully.');
		}
		else{
		  $this->session->set_flashdata('qstage_err', 'Something went wrong');
		}
	}

	public function quote_stage_edit()
	{
		$eid = $_POST['value'];
		$data['quote_stage_list'] = $this->Quotestage_model->get_quote_stage_by_id($eid);
		$this->load->view('quotestage/quote_stage_edit', $data);
	}

	// Check Exporter Unique
	public function checkUniqueQuoteStageEdit()
	{
		$exp = $_POST['value'];
		$eid = $_POST['eid'];
		$qstage = $this->Quotestage_model->checkUniqueQuoteStageEdit($exp,$eid);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	// Add Exporter
	public function update_quote_stage()
	{
		$data['quote_stage_id'] = $this->input->post('quote_stage_id');
		$data['quote_stage']=$this->input->post('quote_stage');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $admindata['user_id'];

	    $result = $this->Quotestage_model->update_quote_stage($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Quote Stage has been updated successfully.');
      		redirect('/quotestage');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/quotestage');
	    }
	}

}
?>