<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcostingtype extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Multiproductcostingtype_model'));
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
		$data['multi_product_costing_type_list'] = $this->Multiproductcostingtype_model->get_multi_product_costing_type_list();
		$this->load->view('multiproductcostingtype/multi_product_costing_type_list', $data);
	}

	public function create_multi_product_costing_type()
	{
		$data['multi_product_costing_type'] = $this->input->post('multi_product_costing_type');
		$data['is_edit'] = $this->input->post('is_edit');
		$data['math_action'] = $this->input->post('math_action');
		if($data['math_action']!='Division(/)')
		{
			$data['multi_product_costing_type_id_math'] = implode(",",$this->input->post('multi_product_costing_type_id_math'));
			$data['multi_product_costing_type_id_math_1'] = '';
			$data['is_nop_greater']=0;
		}
		else
		{
			$data['multi_product_costing_type_id_math'] = $this->input->post('multi_product_costing_type_id_math1');
			$data['multi_product_costing_type_id_math_1'] = $this->input->post('multi_product_costing_type_id_math_1');
			$data['is_nop_greater'] = $this->input->post('is_nop_greater');
		}
		$data['created_on'] = date('Y-m-d H:i:s');
	   	$data['created_by'] = $_SESSION['admindata']['user_id'];
		//print_r($data);exit;
		$result = $this->Multiproductcostingtype_model->create_multi_product_costing_type($data);
		if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Multi Product Costing Type has been created successfully.');
      		redirect('/multiproductcostingtype');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/multiproductcostingtype');
	    }
	}

	public function multi_product_costing_type_edit()
	{
		$pctid = $_POST['value'];
		$data['multi_product_costing_type_list'] = $this->Multiproductcostingtype_model->get_multi_product_costing_type_list();
		$data['multi_product_costing_type'] = $this->Multiproductcostingtype_model->get_multi_product_costing_type_by_id($pctid);

		$this->load->view('multiproductcostingtype/multi_product_costing_type_edit', $data);
	}

	public function update_multi_product_costing_type()
	{
		$data['multi_product_costing_type_id'] = $this->input->post('multi_product_costing_type_id');
		$data['multi_product_costing_type'] = $this->input->post('multi_product_costing_type');
		$data['is_edit'] = $this->input->post('is_edit');
		$data['math_action'] = $this->input->post('math_action');
		if($data['math_action']!='Division(/)')
		{
			$data['multi_product_costing_type_id_math'] = implode(",",$this->input->post('multi_product_costing_type_id_math'));
			$data['multi_product_costing_type_id_math_1'] = '';
			$data['is_nop_greater'] = 0;
		}
		else
		{
			$data['multi_product_costing_type_id_math'] = $this->input->post('multi_product_costing_type_id_math1');
			$data['multi_product_costing_type_id_math_1'] = $this->input->post('multi_product_costing_type_id_math_1');
			$data['is_nop_greater'] = $this->input->post('is_nop_greater');
		}
		$data['modified_on'] = date('Y-m-d H:i:s');
	   	$data['modified_by'] = $_SESSION['admindata']['user_id'];
		//print_r($data);exit;
		$result = $this->Multiproductcostingtype_model->udpate_multi_product_costing_type($data);
		if($result)
	    {
	    	$this->session->set_flashdata('qstage_success', 'Multi Product Costing Type has been updated successfully.');
      		redirect('/multiproductcostingtype');
	    }
	    else
	    {
	    	$this->session->set_flashdata('qstage_err', 'Something Went Wrong.');
      		redirect('/multiproductcostingtype');
	    }
	}

}
?>