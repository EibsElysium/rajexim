<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* ************************************************************************************
		Purpose : To handle all the Exporter functions
		Date    : 28-02-2020 
***************************************************************************************/
class Exporter extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Exporter_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}

	// To list exporter
	public function index()
	{
		$data['exporter_list'] = $this->Exporter_model->get_exporter_list();
		$this->load->view('exporter/exporter_list', $data);
	}

	// Check Exporter Unique
	public function checkUniqueExporter()
	{
		$exp = $_POST['value'];
		$exporter = $this->Exporter_model->checkUniqueExporter($exp);
		//echo count($exporter);
		if($exporter){ echo 1; }else{ echo 0; }
	}

	// Add Exporter
	public function create_exporter()
	{
		$expname = $data['exporter_name']=$this->input->post('exporter_name');
		$data['exporter_address']=$this->input->post('exporter_address');
		$data['exporter_country']=$this->input->post('exporter_country');
		$data['contact_name']=$this->input->post('contact_name');
		$data['phone_no']=$this->input->post('phone_no');
		$data['gst_no']=$this->input->post('gst_no');
		$data['iec_no']=$this->input->post('iec_no');
		$data['state_name']=$this->input->post('state_name');
		$data['state_code']=$this->input->post('state_code');
		$data['vat_tin_no']=$this->input->post('vat_tin_no');
		$data['cst_no']=$this->input->post('cst_no');
		$data['pan_no']=$this->input->post('pan_no');

		if(!empty($_FILES['exporter_logo']['name'])){
	      $ext = pathinfo($_FILES['exporter_logo']['name'], PATHINFO_EXTENSION);
	      $config['upload_path'] = 'exporterlogo';
	      $config['allowed_types'] = 'jpg|jpeg|png';
	      $config['file_name'] = $expname;
	      $profileName = $config['file_name'].'.'.$ext;
	      $this->load->library('upload',$config);
	      $this->upload->initialize($config);
	      if($this->upload->do_upload('exporter_logo'))
	      {
	        $uploadData = $this->upload->data();
	        $data['exporter_logo'] = $profileName;
	      }
	      else
	      {
	        $data['exporter_logo'] = '';
	      }
	    }
	    else
	    {
	      $data['exporter_logo'] = '';
	    }

		if(!empty($_FILES['exporter_sign_file']['name'])){
	      $ext = pathinfo($_FILES['exporter_sign_file']['name'], PATHINFO_EXTENSION);
	      $config['upload_path'] = 'exportersign';
	      $config['allowed_types'] = 'jpg|jpeg|png';
	      $config['file_name'] = $expname.'-Sign';
	      $profileName = $config['file_name'].'.'.$ext;
	      $this->load->library('upload',$config);
	      $this->upload->initialize($config);
	      if($this->upload->do_upload('exporter_sign_file'))
	      {
	        $uploadData = $this->upload->data();
	        $data['exporter_sign_file'] = $profileName;
	      }
	      else
	      {
	        $data['exporter_sign_file'] = '';
	      }
	    }
	    else
	    {
	      $data['exporter_sign_file'] = '';
	    }

	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $admindata['user_id'];

	    $result = $this->Exporter_model->create_exporter($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('expo_success', 'Exporter has been added successfully.');
      		redirect('/exporter');
	    }
	    else
	    {
	    	$this->session->set_flashdata('expo_err', 'Something Went Wrong.');
      		redirect('/exporter');
	    }
	}

	public function exporter_view()
	{
		$eid = $_POST['value'];
		$data['exporter_list'] = $this->Exporter_model->get_exporter_by_id($eid);
		$this->load->view('exporter/exporter_view', $data);
	}

	public function exporter_change_status()
	{
		$eid = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Exporter_model->exporter_change_status($eid, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	public function exporter_delete()
	{
		$data['eid']=$_POST['id'];
		$this->load->view('exporter/exporter_delete',$data);
	}

	public function delete(){ 
		$eid=$_POST['field'];
		$result = $this->Exporter_model->exporter_delete($eid);
		if ($result) {
		  $this->session->set_flashdata('expo_success', 'Expense has been Deleted successfully.');
		}
		else{
		  $this->session->set_flashdata('expo_err', 'Something went wrong');
		}
	}

	public function exporter_edit()
	{
		$eid = $_POST['value'];
		$data['exporter_list'] = $this->Exporter_model->get_exporter_by_id($eid);
		$this->load->view('exporter/exporter_edit', $data);
	}

	// Check Exporter Unique
	public function checkUniqueExporterEdit()
	{
		$exp = $_POST['value'];
		$eid = $_POST['eid'];
		$exporter = $this->Exporter_model->checkUniqueExporterEdit($exp,$eid);
		//echo count($exporter);
		if($exporter){ echo 1; }else{ echo 0; }
	}

	// Update Exporter
	public function update_exporter()
	{
		$oldlogo = $this->input->post('oldlogo');
		$oldsign = $this->input->post('oldsign');
		$eid = $data['exporter_id'] = $this->input->post('exporter_id');
		$expname = $data['exporter_name']=$this->input->post('exporter_name');
		$data['exporter_address']=$this->input->post('exporter_address');
		$data['exporter_country']=$this->input->post('exporter_country');
		$data['contact_name']=$this->input->post('contact_name');
		$data['phone_no']=$this->input->post('phone_no');
		$data['gst_no']=$this->input->post('gst_no');
		$data['iec_no']=$this->input->post('iec_no');
		$data['state_name']=$this->input->post('state_name');
		$data['state_code']=$this->input->post('state_code');
		$data['vat_tin_no']=$this->input->post('vat_tin_no');
		$data['cst_no']=$this->input->post('cst_no');
		$data['pan_no']=$this->input->post('pan_no');

		if(!empty($_FILES['exporter_logo']['name'])){
	      $ext = pathinfo($_FILES['exporter_logo']['name'], PATHINFO_EXTENSION);
	      $config['upload_path'] = 'exporterlogo';
	      $config['allowed_types'] = 'jpg|jpeg|png';
	      $config['file_name'] = $expname;
	      $profileName = $config['file_name'].'.'.$ext;
	      $this->load->library('upload',$config);
	      $this->upload->initialize($config);
	      unlink('exporterlogo/'.str_replace(' ', '_', $oldlogo));
	      if($this->upload->do_upload('exporter_logo'))
	      {
	        $uploadData = $this->upload->data();
	        $data['exporter_logo'] = $profileName;
	      }
	      else
	      {
	        $data['exporter_logo'] = $oldlogo;
	      }
	    }
	    else
	    {
	      $data['exporter_logo'] = $oldlogo;
	    }

		if(!empty($_FILES['exporter_sign_file']['name'])){
	      $ext = pathinfo($_FILES['exporter_sign_file']['name'], PATHINFO_EXTENSION);
	      $config['upload_path'] = 'exportersign';
	      $config['allowed_types'] = 'jpg|jpeg|png';
	      $config['file_name'] = $expname.'-Sign';
	      $profileName = $config['file_name'].'.'.$ext;
	      $this->load->library('upload',$config);
	      $this->upload->initialize($config);
	      unlink('exportersign/'.str_replace(' ', '_', $oldsign));
	      if($this->upload->do_upload('exporter_sign_file'))
	      {
	        $uploadData = $this->upload->data();
	        $data['exporter_sign_file'] = $profileName;
	      }
	      else
	      {
	        $data['exporter_sign_file'] = $oldsign;
	      }
	    }
	    else
	    {
	      $data['exporter_sign_file'] = $oldsign;
	    }

	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $admindata['user_id'];

	    $result = $this->Exporter_model->update_exporter($data);
	    if($result)
	    {
	    	$this->session->set_flashdata('expo_success', 'Exporter has been updated successfully.');
      		redirect('/exporter');
	    }
	    else
	    {
	    	$this->session->set_flashdata('expo_err', 'Something Went Wrong.');
      		redirect('/exporter');
	    }
	}

}
?>