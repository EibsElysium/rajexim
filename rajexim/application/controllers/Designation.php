<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Designation extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Designation_model'));
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
    $data['designation_list'] = $this->Designation_model->get_designation_list();
    $this->load->view('designation/designation_list',$data);
  } 

  public function checkDesignationUnique()
  {
    $val = $_POST['value'];
    $result = $this->Designation_model->checkDesignationUnique($val);
    echo count($result);
  } 

  public function create_designation()
  {
    $data['designation']=$this->input->post('designation');
    $data['created_on'] = date('Y-m-d H:i:s');
    //$data['created_by'] = $admindata['user_id'];
    $data['created_by'] = 1;
    
    $result = $this->Designation_model->create_designation($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Designation has been created successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/designation');
  }

  public function designation_active(){
    $id = $this->input->post('id');
    $data = $this->input->post('status');
    $result = $this->Designation_model->designation_active($id,$data);
    echo 1;
  }

  public function designation_edit()
  {
    $bid=$_POST['id'];
    $data['designation_list'] = $this->Designation_model->get_designation_by_id($bid);

    $this->load->view('designation/designation_edit',$data);
  }

  public function checkDesignationUniqueEdit()
  {
    $val = $_POST['value'];
    $bid = $_POST['bid'];
    $result = $this->Designation_model->checkDesignationUniqueEdit($val,$bid);
    echo count($result);
  }

  public function update_designation()
  {
  	//print_r($_POST);exit;
    $data['designation_id'] = $this->input->post('designation_id');
    $data['designation']=$this->input->post('designation');
    $data['modified_on'] = date('Y-m-d H:i:s');
    //$data['modified_by'] = $_SESSION['user_id'];
    $data['modified_by'] = 1;

    
    $result = $this->Designation_model->update_designation($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Designation has been Updated successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/designation');
  }

  public function designation_delete()
  {
    $data['bid']=$_POST['id'];
    $this->load->view('designation/designation_delete',$data);
  }

  public function delete(){ 
    $bid=$_POST['field'];
    $result = $this->Designation_model->designation_delete($bid);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Designation has been Deleted successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
  }

}
?>