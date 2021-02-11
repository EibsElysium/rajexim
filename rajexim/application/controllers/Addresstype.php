<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Addresstype extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Addresstype_model'));
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
    $data['addresstype_list'] = $this->Addresstype_model->get_addresstype_list();
    $this->load->view('addresstype/addresstype_list',$data);
  } 

  public function checkAddresstypeUnique()
  {
    $val = $_POST['value'];
    $result = $this->Addresstype_model->checkAddresstypeUnique($val);
    echo count($result);
  } 

  public function create_addresstype()
  {
    $data['address_type']=$this->input->post('address_type');
    $data['created_on'] = date('Y-m-d H:i:s');
    //$data['created_by'] = $admindata['user_id'];
    $data['created_by'] = 1;
    
    $result = $this->Addresstype_model->create_addresstype($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Address Type has been created successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/addresstype');
  }

  public function addresstype_active(){
    $id = $this->input->post('id');
    $data = $this->input->post('status');
    $result = $this->Addresstype_model->addresstype_active($id,$data);
    echo 1;
  }

  public function addresstype_edit()
  {
    $bid=$_POST['id'];
    $data['addresstype_list'] = $this->Addresstype_model->get_addresstype_by_id($bid);

    $this->load->view('addresstype/addresstype_edit',$data);
  }

  public function checkAddresstypeUniqueEdit()
  {
    $val = $_POST['value'];
    $bid = $_POST['bid'];
    $result = $this->Addresstype_model->checkAddresstypeUniqueEdit($val,$bid);
    echo count($result);
  }

  public function update_addresstype()
  {
  	//print_r($_POST);exit;
    $data['address_type_id'] = $this->input->post('address_type_id');
    $data['address_type']=$this->input->post('address_type');
    $data['modified_on'] = date('Y-m-d H:i:s');
    //$data['modified_by'] = $_SESSION['user_id'];
    $data['modified_by'] = 1;

    
    $result = $this->Addresstype_model->update_addresstype($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Address Type has been Updated successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/addresstype');
  }

  public function addresstype_delete()
  {
    $data['bid']=$_POST['id'];
    $this->load->view('addresstype/addresstype_delete',$data);
  }

  public function delete(){ 
    $bid=$_POST['field'];
    $result = $this->Addresstype_model->addresstype_delete($bid);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Address Type has been Deleted successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
  }

}
?>