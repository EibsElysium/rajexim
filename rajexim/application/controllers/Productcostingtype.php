<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productcostingtype extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Productcostingtype_model'));
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
		$data['product_costing_category_list'] = $this->Productcostingtype_model->get_product_costing_category_list();
		$data['product_costing_type_list'] = $this->Productcostingtype_model->get_product_costing_type_list();
		$this->load->view('productcostingtype/product_costing_type_list', $data);
	}

	public function getTypePCC()
	{
		$pccid = $_POST['id'];
		$productcc = $this->Productcostingtype_model->get_product_costing_category_list();
		if(count($productcc)>0)
		{
		  $st = '<option value="">Select Category</option>';
		  foreach ($productcc as $prod) {
		  	if($prod['product_costing_category_id']<$pccid)
		      $st.='<option value='.$prod["product_costing_category_id"].'>'.$prod["product_costing_category_name"].'</option>';
		  }
		}
		else
		{
		  $st = '<option value="">No Category Available</option>';
		}
		echo $st;
	}

	public function create_product_costing_type()
	{
		$product_costing_category_id = $this->input->post('product_costing_category_id');
		$is_edit = $this->input->post('is_edit');
		$is_default = $this->input->post('is_default');
		$pctype = explode(",",implode(",",$this->input->post('product_costing_type')));
		$ipercent = explode(",",implode(",",$this->input->post('is_percent')));
		$tcc = explode(",",implode(",",$this->input->post('type_costing_category')));
		$maction = explode(",",implode(",",$this->input->post('math_action')));
		$is_input = $this->input->post('is_input');
		$subcount = count($this->input->post('product_costing_type')); 
		for($i=0;$i<$subcount;$i++)
		{
			if($pctype[$i] != ''){
				$data['product_costing_category_id'] = $product_costing_category_id;
				$data['is_edit'] = $is_edit;
				$data['is_default'] = $is_default;
				$data['product_costing_type'] = $pctype[$i];
				$data['is_percent'] = $ipercent[$i];
				$data['type_costing_category'] = $tcc[$i];
				$data['math_action'] = $maction[$i];
				$data['created_on'] = date('Y-m-d H:i:s');
	    		$data['created_by'] = $admindata['user_id'];
				$data['is_input'] = $is_input;
	    		$result = $this->Productcostingtype_model->create_product_costing_type($data);
			}
		}
		$this->session->set_flashdata('qstage_success', 'Product Costing Type has been added successfully.');
      	redirect('/productcostingtype');
	}

	public function product_costing_type_edit()
	{
		$pctid = $_POST['value'];
		$data['product_costing_category_list'] = $this->Productcostingtype_model->get_product_costing_category_list();
		$pcclist = $data['product_costing_type'] = $this->Productcostingtype_model->get_product_costing_type_by_id($pctid);

		$pccid = $pcclist->product_costing_category_id;
		$productcc = $this->Productcostingtype_model->get_product_costing_category_list();
		if(count($productcc)>0)
		{
		  $st = '<option value="">Select Category</option>';
		  foreach ($productcc as $prod) {
		  	if($prod['product_costing_category_id']<$pccid)
		  	{
		  		if($pcclist->is_percent!=0)
		  		{
		  			if($prod["product_costing_category_id"] == $pcclist->type_costing_category)
		  				$st.='<option value='.$prod["product_costing_category_id"].' selected>'.$prod["product_costing_category_name"].'</option>';
		  			else
		  				$st.='<option value='.$prod["product_costing_category_id"].'>'.$prod["product_costing_category_name"].'</option>';
		  		}
		  		else
		  			$st.='<option value='.$prod["product_costing_category_id"].'>'.$prod["product_costing_category_name"].'</option>';
		  	}
		  }
		}
		else
		{
		  $st = '<option value="">No Category Available</option>';
		}
	    $data['st'] = $st;

		$this->load->view('productcostingtype/product_costing_type_edit', $data);
	}

	public function update_product_costing_type()
	{
		$data['product_costing_type_id'] = $this->input->post('product_costing_type_id');
		$data['product_costing_category_id'] = $this->input->post('product_costing_category_id');
		$data['product_costing_type'] = $this->input->post('product_costing_type');
		$data['is_percent'] = $this->input->post('is_percent');
		$data['type_costing_category'] = $this->input->post('type_costing_category');
		$data['math_action'] = $this->input->post('math_action');
		$data['is_edit'] = $this->input->post('is_edit');
		$data['is_default'] = $this->input->post('is_default');
		$data['is_input'] = $this->input->post('is_input');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['modified_by'] = $admindata['user_id'];
		$result = $this->Productcostingtype_model->update_product_costing_type($data);
		if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Product Costing Type has been updated successfully.');
      		redirect('/productcostingtype');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/productcostingtype');
	    }
	}

}
?>