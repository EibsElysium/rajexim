<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productcostingcategory extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Productcostingcategory_model'));
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
		$data['product_costing_category_list'] = $this->Productcostingcategory_model->get_product_costing_category_list();
		$this->load->view('productcostingcategory/product_costing_category_list', $data);
	}

	public function checkUniqueProductCostingCategory()
	{
		$exp = $_POST['value'];
		$qstage = $this->Productcostingcategory_model->checkUniqueProductCostingCategory($exp);
		//echo count($exporter);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function create_product_costing_category()
	{
		$lcount = $this->input->post('listcount');
		$data['product_costing_category_name']=$this->input->post('product_costing_category_name');
		if($lcount>0)
		{
			$data['parent_product_costing_category_id']=$this->input->post('parent_product_costing_category_id');
			$data['math_action']=$this->input->post('math_action');
		}
		else
		{
			$data['parent_product_costing_category_id']='';
			$data['math_action']='';
		}
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $admindata['user_id'];

	    $result = $this->Productcostingcategory_model->create_product_costing_category($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Product Costing Category has been added successfully.');
      		redirect('/productcostingcategory');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/productcostingcategory');
	    }
	}

	public function product_costing_category_edit()
	{
		$pccid = $_POST['value'];
		$data['product_costing_category_list'] = $this->Productcostingcategory_model->get_product_costing_category_list();
		$data['product_costing_category'] = $this->Productcostingcategory_model->get_product_costing_category_by_id($pccid);
		$this->load->view('productcostingcategory/product_costing_category_edit', $data);
	}

	public function checkUniqueProductCostingCategoryEdit()
	{
		$exp = $_POST['value'];
		$pccid = $_POST['pccid'];
		$qstage = $this->Productcostingcategory_model->checkUniqueProductCostingCategoryEdit($exp,$pccid);
		if($qstage){ echo 1; }else{ echo 0; }
	}

	public function update_product_costing_category()
	{
		$lcount = $this->input->post('ppccid');
		$data['product_costing_category_id'] = $this->input->post('product_costing_category_id');
		$data['product_costing_category_name']=$this->input->post('product_costing_category_name');
		if($lcount>0)
		{
			$data['parent_product_costing_category_id']=$this->input->post('parent_product_costing_category_id');
			$data['math_action']=$this->input->post('math_action');
		}
		else
		{
			$data['parent_product_costing_category_id']='';
			$data['math_action']='';
		}
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $admindata['user_id'];

	    $result = $this->Productcostingcategory_model->update_product_costing_category($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Product Costing Category has been updated successfully.');
      		redirect('/productcostingcategory');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/productcostingcategory');
	    }
	}
}
?>