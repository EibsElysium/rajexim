<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* ************************************************************************************
    Purpose : To handle all smtp functions
    Date    : 04-02-2020 
***************************************************************************************/
class Smtphost extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Smtphost_model'));
    $admindata = $this->session->userdata('admindata');
        if ($admindata['user_id']>0)
        {
            //do something
        }else{
            redirect('login'); //if session is not there, redirect to login page
        } 
    date_default_timezone_set("Asia/Kolkata");
  }
  // To check smtp unique
  public function checkSmtphostUnique()
  {
    $val = $_POST['value'];
    $result = $this->Smtphost_model->checkSmtphostUnique($val);
    echo count($result);
  }
  // To check smtp unique for edit
  public function checkSmtphostUniqueEdit()
  {
    $val = $_POST['value'];
    $bid = $_POST['bid'];
    $result = $this->Smtphost_model->checkSmtphostUniqueEdit($val,$bid);
    echo count($result);
  }
  // To list smtp list

  public function index()
  {
    $data['smtphost_list'] = $this->Smtphost_model->get_smtphost_list();
    $this->load->view('smtphost/smtphost_list',$data);
  } 
// To create smtp host details
  public function create_smtphost()
  {
    $data['smtp_name']=$this->input->post('smtp_name');
    $data['smtp_host_name']=$this->input->post('smtp_host_name');
    $data['status'] = 0;
    $data['created_on'] = date('Y-m-d H:i:s');
    $data['created_by'] = $_SESSION['admindata']['user_id'];
    
    $result = $this->Smtphost_model->create_smtphost($data);
    if ($result) {
      $this->session->set_flashdata('add_success', 'SMTP Host has been created successfully.');
    }
    else{
      $this->session->set_flashdata('add_err', 'Something went wrong');
    }
    redirect('/smtphost');
  }
 // To active smtp host values
  public function smtphost_active(){
    $id = $this->input->post('id');
    $data = $this->input->post('status');
    $result = $this->Smtphost_model->smtphost_active($id,$data);
    echo 1;
  }
 // To get smtp edit page
  public function smtphost_edit()
  {
    $bid=$_POST['id'];
    $data['smtphost_list'] = $this->Smtphost_model->get_smtphost_by_id($bid);

    $this->load->view('smtphost/smtphost_edit',$data);
  }
  // To update smtp update
  public function update_smtphost()
  {
    $data['smtp_host_id'] = $this->input->post('smtp_host_id');
    $data['smtp_name']=$this->input->post('smtp_name');
    $data['smtp_host_name']=$this->input->post('smtp_host_name');
    $data['modified_on'] = date('Y-m-d H:i:s');
    $data['modified_by'] = $_SESSION['admindata']['user_id'];

    
    $result = $this->Smtphost_model->update_smtphost($data);
    if ($result) {
      $this->session->set_flashdata('add_success', 'SMTP Host has been Updated successfully.');
    }
    else{
      $this->session->set_flashdata('add_err', 'Something went wrong');
    }
    redirect('/smtphost');
  }
  // To delete smtp details
  public function smtphost_delete()
  {
    $data['bid']=$_POST['id'];
    $this->load->view('smtphost/smtphost_delete',$data);
  }

  public function delete(){ 
    $bid=$_POST['field'];
    $result = $this->Smtphost_model->smtphost_delete($bid);
    if ($result) {
      $this->session->set_flashdata('add_success', 'SMTP Host has been Deleted successfully.');
    }
    else{
      $this->session->set_flashdata('add_err', 'Something went wrong');
    }
  }

}
?>