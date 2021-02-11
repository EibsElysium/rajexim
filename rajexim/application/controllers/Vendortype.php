<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendortype extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Vendortype_model'));
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
		$data['vendor_type_list'] = $this->Vendortype_model->get_vendor_type_list();
		$this->load->view('vendortype/vendor_type_list', $data);
	}

	public function checkUniqueVendorType()
	{
		$exp = $_POST['value'];
		$qstage = $this->Vendortype_model->checkUniqueVendorType($exp);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function create_vendor_type()
	{
		$data['vendor_type']=$this->input->post('vendor_type');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $admindata['user_id'];

	    $result = $this->Vendortype_model->create_vendor_type($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Vendor Type has been added successfully.');
      		redirect('/vendortype');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/vendortype');
	    }
	}

	public function vendor_type_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Vendortype_model->vendor_type_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function vendor_type_delete()
	{
		$data['eid']=$_POST['id'];
		$this->load->view('vendortype/vendor_type_delete',$data);
	}

	public function delete(){ 
		$eid=$_POST['field'];
		$result = $this->Vendortype_model->vendor_type_delete($eid);
		if ($result) {
		  $this->session->set_flashdata('qstate_success', 'Vendor Type has been Deleted successfully.');
		}
		else{
		  $this->session->set_flashdata('qstage_err', 'Something went wrong');
		}
	}

	public function vendor_type_edit()
	{
		$eid = $_POST['value'];
		$data['vendor_type_list'] = $this->Vendortype_model->get_vendor_type_by_id($eid);
		$this->load->view('vendortype/vendor_type_edit', $data);
	}

	// Check Exporter Unique
	public function checkUniqueVendorTypeEdit()
	{
		$exp = $_POST['value'];
		$eid = $_POST['eid'];
		$qstage = $this->Vendortype_model->checkUniqueVendorTypeEdit($exp,$eid);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	// Add Exporter
	public function update_vendor_type()
	{
		$data['vendor_type_id'] = $this->input->post('vendor_type_id');
		$data['vendor_type']=$this->input->post('vendor_type');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $admindata['user_id'];

	    $result = $this->Vendortype_model->update_vendor_type($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Vendor Type has been updated successfully.');
      		redirect('/vendortype');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/vendortype');
	    }
	}

}
?>