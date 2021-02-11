<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Container extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Container_model'));
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
		$data['container_list'] = $this->Container_model->get_container_list();
		$this->load->view('container/container_list', $data);
	}

  public function checkContainerUnique()
  {
    $val = $_POST['value'];
    $result = $this->Container_model->checkContainerUnique($val);
    echo count($result);
  }  

  public function create_container()
  {
    $data['container_name']=$this->input->post('container_name');
    $data['min_cbm']=$this->input->post('min_cbm');
    $data['max_cbm']=$this->input->post('max_cbm');
    $data['max_ton']=$this->input->post('max_ton');
    $data['ton_variance']=$this->input->post('ton_variance');
    $data['created_on'] = date('Y-m-d H:i:s');
    $data['created_by'] = $_SESSION['admindata']['user_id'];
    
    $result = $this->Container_model->create_container($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Container has been created successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/container');
  }

  public function container_edit()
  {
    $bid=$_POST['value'];
    $data['container_list'] = $this->Container_model->get_container_by_id($bid);

    $this->load->view('container/container_edit',$data);
  }

  public function checkContainerUniqueEdit()
  {
    $val = $_POST['value'];
    $bid = $_POST['bid'];
    $result = $this->Container_model->checkContainerUniqueEdit($val,$bid);
    echo count($result);
  }

  public function update_container()
  {
    $data['container_id']=$this->input->post('container_id');
    $data['container_name']=$this->input->post('container_name');
    $data['min_cbm']=$this->input->post('min_cbm');
    $data['max_cbm']=$this->input->post('max_cbm');
    $data['max_ton']=$this->input->post('max_ton');
    $data['ton_variance']=$this->input->post('ton_variance');
    $data['modified_on'] = date('Y-m-d H:i:s');
    $data['modified_by'] = $_SESSION['admindata']['user_id'];
    
    $result = $this->Container_model->update_container($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Container has been updated successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/container');
  }

}
?>