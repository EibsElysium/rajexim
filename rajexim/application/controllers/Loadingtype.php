<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loadingtype extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Loadingtype_model'));
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
    $data['loadingtype_list'] = $this->Loadingtype_model->get_loadingtype_list();
    $this->load->view('loadingtype/loadingtype_list',$data);
  } 

  public function checkLoadingtypeUnique()
  {
    $val = $_POST['value'];
    $result = $this->Loadingtype_model->checkLoadingtypeUnique($val);
    echo count($result);
  } 

  public function create_loadingtype()
  {
    $data['loading_type']=$this->input->post('loading_type');
    $data['created_on'] = date('Y-m-d H:i:s');
    //$data['created_by'] = $admindata['user_id'];
    $data['created_by'] = 1;
    
    $result = $this->Loadingtype_model->create_loadingtype($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Loading Type has been created successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/loadingtype');
  }

  public function loadingtype_active(){
    $id = $this->input->post('id');
    $data = $this->input->post('status');
    $result = $this->Loadingtype_model->loadingtype_active($id,$data);
    echo 1;
  }

  public function loadingtype_edit()
  {
    $bid=$_POST['id'];
    $data['loadingtype_list'] = $this->Loadingtype_model->get_loadingtype_by_id($bid);

    $this->load->view('loadingtype/loadingtype_edit',$data);
  }

  public function checkLoadingtypeUniqueEdit()
  {
    $val = $_POST['value'];
    $bid = $_POST['bid'];
    $result = $this->Loadingtype_model->checkLoadingtypeUniqueEdit($val,$bid);
    echo count($result);
  }

  public function update_loadingtype()
  {
  	//print_r($_POST);exit;
    $data['loading_type_id'] = $this->input->post('loading_type_id');
    $data['loading_type']=$this->input->post('loading_type');
    $data['modified_on'] = date('Y-m-d H:i:s');
    //$data['modified_by'] = $_SESSION['user_id'];
    $data['modified_by'] = 1;

    
    $result = $this->Loadingtype_model->update_loadingtype($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Loading Type has been Updated successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/loadingtype');
  }

  public function loadingtype_delete()
  {
    $data['bid']=$_POST['id'];
    $this->load->view('loadingtype/loadingtype_delete',$data);
  }

  public function delete(){ 
    $bid=$_POST['field'];
    $result = $this->Loadingtype_model->loadingtype_delete($bid);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Loading Type has been Deleted successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
  }

}
?>