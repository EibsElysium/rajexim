<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendorcategory extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Vendorcategory_model'));
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
		$data['vendor_category_list'] = $this->Vendorcategory_model->get_vendor_category_list();
		$this->load->view('vendorcategory/vendor_category_list', $data);
	}

	public function checkUniqueVendorCategory()
	{
		$exp = $_POST['value'];
		$qstage = $this->Vendorcategory_model->checkUniqueVendorCategory($exp);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function create_vendor_category()
	{
		$data['vendor_category']=$this->input->post('vendor_category');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $admindata['user_id'];

	    $result = $this->Vendorcategory_model->create_vendor_category($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Vendor Category has been added successfully.');
      		redirect('/vendorcategory');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/vendorcategory');
	    }
	}

	public function vendor_category_change_status()
	{
		$qsid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Vendorcategory_model->vendor_category_change_status($qsid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function vendor_category_delete()
	{
		$data['eid']=$_POST['id'];
		$this->load->view('vendorcategory/vendor_category_delete',$data);
	}

	public function delete(){ 
		$eid=$_POST['field'];
		$result = $this->Vendorcategory_model->vendor_category_delete($eid);
		if ($result) {
		  $this->session->set_flashdata('qstate_success', 'Vendor Category has been Deleted successfully.');
		}
		else{
		  $this->session->set_flashdata('qstage_err', 'Something went wrong');
		}
	}

	public function vendor_category_edit()
	{
		$eid = $_POST['value'];
		$data['vendor_category_list'] = $this->Vendorcategory_model->get_vendor_category_by_id($eid);
		$this->load->view('vendorcategory/vendor_category_edit', $data);
	}

	// Check Exporter Unique
	public function checkUniqueVendorCategoryEdit()
	{
		$exp = $_POST['value'];
		$eid = $_POST['eid'];
		$qstage = $this->Vendorcategory_model->checkUniqueVendorCategoryEdit($exp,$eid);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	// Add Exporter
	public function update_vendor_category()
	{
		$data['vendor_category_id'] = $this->input->post('vendor_category_id');
		$data['vendor_category']=$this->input->post('vendor_category');
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $admindata['user_id'];

	    $result = $this->Vendorcategory_model->update_vendor_category($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Vendor Category has been updated successfully.');
      		redirect('/vendorcategory');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/vendorcategory');
	    }
	}

}
?>