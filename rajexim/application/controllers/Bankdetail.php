<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bankdetail extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Bankdetail_model'));
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
		$data['exporter_list'] = $this->Bankdetail_model->get_exporter_list();
		$data['currency_list'] = $this->Bankdetail_model->get_currency_list();
		$data['bank_detail_list'] = $this->Bankdetail_model->get_bank_detail_list();
		$this->load->view('bankdetail/bank_detail_list', $data);
	}

	public function create_bankdetail()
	{
		$data['exporter_id']=$this->input->post('exporter_id');
		$data['currency_id']=$this->input->post('currency_id');
		$data['bank_label']=$this->input->post('bank_label');
		$data['correspondence_bank']=$this->input->post('correspondence_bank');
		$data['bank_detail']=$this->input->post('bank_detail');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $admindata['user_id'];

	    $result = $this->Bankdetail_model->create_bankdetail($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Bank Detail has been added successfully.');
      		redirect('/bankdetail');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/bankdetail');
	    }
	}

	public function bankdetail_delete()
	{
		$data['eid']=$_POST['id'];
		$this->load->view('bankdetail/bank_detail_delete',$data);
	}

	public function delete(){ 
		$eid=$_POST['field'];
		$result = $this->Bankdetail_model->bankdetail_delete($eid);
		if ($result) {
		  $this->session->set_flashdata('qstate_success', 'Bank Detail has been Deleted successfully.');
		}
		else{
		  $this->session->set_flashdata('qstage_err', 'Something went wrong');
		}
	}

	public function bankdetail_edit()
	{
		$eid = $_POST['value'];
		$data['exporter_list'] = $this->Bankdetail_model->get_exporter_list();
		$data['currency_list'] = $this->Bankdetail_model->get_currency_list();
		$data['bank_detail_list'] = $this->Bankdetail_model->get_bank_detail_by_id($eid);
		$this->load->view('bankdetail/bank_detail_edit', $data);
	}

	public function update_bankdetail()
	{
		$data['bank_detail_id'] = $this->input->post('bank_detail_id');
		$data['exporter_id']=$this->input->post('exporter_id');
		$data['currency_id']=$this->input->post('currency_id');
		$data['bank_label']=$this->input->post('bank_label');
		$data['correspondence_bank']=$this->input->post('correspondence_bank');
		$data['bank_detail']=$this->input->post('bank_detail');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $admindata['user_id'];

	    $result = $this->Bankdetail_model->update_bankdetail($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Bank Detail has been updated successfully.');
      		redirect('/bankdetail');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/bankdetail');
	    }
	}

}
?>