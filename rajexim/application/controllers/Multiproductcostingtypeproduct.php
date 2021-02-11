<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcostingtypeproduct extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Multiproductcostingtypeproduct_model'));
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
		$data['multiproductcostingtypeproduct_list'] = $this->Multiproductcostingtypeproduct_model->get_multi_product_costing_type_prod_list();
		$this->load->view('multiproductcostingtypeproduct/multi_product_costing_type_product_list', $data);
	} 

  public function create_multi_product_costing_type_product()
  {
    $data['multi_product_costing_type_product']=$this->input->post('multi_product_costing_type_product');
    $data['math_action']=$this->input->post('math_action');
    $data['created_on'] = date('Y-m-d H:i:s');
    $data['created_by'] = $_SESSION['admindata']['user_id'];
    
    $result = $this->Multiproductcostingtypeproduct_model->create_multi_product_costing_type_product($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Multi Product Costing Type - P has been created successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/multiproductcostingtypeproduct');
  }

  public function multi_product_costing_type_product_edit()
  {
    $bid=$_POST['value'];
    $data['multi_product_costing_type_product_list'] = $this->Multiproductcostingtypeproduct_model->get_multi_product_costing_type_product_by_id($bid);

    $this->load->view('multiproductcostingtypeproduct/multi_product_costing_type_product_edit',$data);
  }

  public function update_multi_product_costing_type_product()
  {
    $data['multi_product_costing_type_product_id']=$this->input->post('multi_product_costing_type_product_id');
    $data['multi_product_costing_type_product']=$this->input->post('multi_product_costing_type_product');
    $data['math_action']=$this->input->post('math_action');
    $data['modified_on'] = date('Y-m-d H:i:s');
    $data['modified_by'] = $_SESSION['admindata']['user_id'];
    
    $result = $this->Multiproductcostingtypeproduct_model->update_multi_product_costing_type_product($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Multi Product Costing Type - P has been updated successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/multiproductcostingtypeproduct');
  }

}
?>