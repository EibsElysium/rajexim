<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Employee_model'));
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
    $data['employee_list'] = $this->Employee_model->get_employee_list(); 
    $this->load->view('employee/employee_list',$data);
  }

  public function add_employee()
  {
    $last_id_value = $this->Employee_model->last_id();

    if(count($last_id_value)==0)
    {
      $data['employee_no'] = date("Y").'/'.date('m').'/EMP001';
    }
    else
    {
      $lno = $last_id_value->employee_no;
      $exlno = substr($lno,11);
      $next_value = (int)$exlno + 1;
      $slen = strlen($next_value);
      if($slen==1)
        $nval = '00'.$next_value;
      else if($slen==2)
        $nval = '0'.$next_value;
      else
        $nval = $next_value;
      $data['employee_no'] = date("Y").'/'.date('m').'/EMP'.$nval;
    }

    $data['designation_list'] = $this->Employee_model->get_active_designation();

    $this->load->view('employee/employee_add',$data);
  }

 public function unique_cno()
 {
    $val = $_POST['value'];
    $result = $this->Employee_model->employee_unique_cno($val);
    echo count($result);
 }

  public function create_employee()
  {

    $data['employee_no']=$this->input->post('employee_no');
    $data['first_name']=$this->input->post('first_name');
    $data['last_name']=$this->input->post('last_name');
    $data['display_name']=ucfirst($data['first_name']).' '.ucfirst($data['last_name']);
    $data['contact_no'] = $this->input->post('contact_no');
    $data['gender']=$this->input->post('gender');
    $data['address']=$this->input->post('address');
    $data['designation_id'] = $this->input->post('designation_id');
    $data['area'] = $this->input->post('area');
    $data['status'] = 0;
    $data['created_on'] = date('Y-m-d H:i:s');
    //$data['created_by'] = $_SESSION['user_id'];
    $data['created_by'] = 1;

    if(!empty($_FILES['profile']['name'])){
      $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
      $config['upload_path'] = 'assets/images/employee_profile';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['file_name'] = str_replace('/', '-', $this->input->post('employee_no'));
      $profileName = $config['file_name'].'.'.$ext;
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('profile'))
      {
        $uploadData = $this->upload->data();
        $data['profile_image'] = $profileName;
      }
      else
      {
        $data['profile_image'] = 'defaultprofile.jpg';
      }
    }
    else
    { 
      $data['profile_image'] = 'defaultprofile.jpg';
    }

    
    $result = $this->Employee_model->create_employee($data);
    if ($result) {
      $this->session->set_flashdata('employee_success', 'Employee has been created successfully.');
    }
    else{
      $this->session->set_flashdata('employee_err', 'Something went wrong');
    }
    redirect('/employee');
  }

  public function employee_edit($id)
  {
    $data['employee_details'] = $this->Employee_model->get_employee_by_id($id);
    $data['designation_list'] = $this->Employee_model->get_active_designation();
    $this->load->view('employee/employee_edit',$data);
  }
  public function unique_cno_edit()
  {
    $val['value'] = $_POST['value'];
    $val['id'] = $_POST['id'];
    $result = $this->Employee_model->employee_unique_cno_edit($val);
    echo count($result);
  }

  public function update_employee()
  {
    $data['employee_id'] = $this->input->post('employeeId');
    $data['employee_no'] = $this->input->post('employee_no');
    $data['first_name']=$this->input->post('first_name');
    $data['last_name']=$this->input->post('last_name');
    $data['display_name']=ucfirst($data['first_name']).' '.ucfirst($data['last_name']);
    $data['contact_no'] = $this->input->post('contact_no');
    $data['gender']=$this->input->post('gender');
    $data['address']=$this->input->post('address');
    $data['modified_on'] = date('Y-m-d H:i:s');
    //$data['modified_by'] = $_SESSION['user_id'];
    $data['modified_by'] = 1;
    $data['designation_id'] = $this->input->post('designation_id');
    $data['area'] = $this->input->post('area');

    $old_image=$this->input->post('old_image');

    if(!empty($_FILES['profile']['name'])){
      $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
      if($old_image!='defaultprofile.jpg'){
        unlink('assets/images/employee_profile/'.$old_image);
      }
      $config['upload_path'] = 'assets/images/employee_profile';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['file_name'] = str_replace('/', '-', $this->input->post('employee_no'));
      $profileName = $config['file_name'].'.'.$ext;
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('profile'))
      {
        $uploadData = $this->upload->data();
        $data['profile_image'] = $profileName;
      }
      else
      {
        $data['profile_image'] = 'defaultprofile.jpg';
      }
    }
    else
    { 
      $data['profile_image'] = $old_image;
    }

    $result = $this->Employee_model->update_employee($data);
    if ($result) {
      $this->session->set_flashdata('employee_success', 'Employee details has been updated successfully.');
    }
    else{
      $this->session->set_flashdata('employee_err', 'Something went wrong');
    }
    redirect('/employee');
  }
  public function employee_view($id)
  {
    $data['employee_details'] = $this->Employee_model->get_employee_by_id($id);
    $this->load->view('employee/employee_view',$data);
  }
  public function employee_delete()
  {
    $id=$_POST['employee'];
    $result = $this->Employee_model->employee_delete($id);
    if ($result) {
      $this->session->set_flashdata('employee_success', 'Employee has been deleted successfully.');
    }
    else{
      $this->session->set_flashdata('employee_err', 'Something went wrong');
    }
    redirect('/employee');
  }

  public function employee_active(){
    $id = $this->input->post('id');
    $data = $this->input->post('status');
    $result = $this->Employee_model->employee_active($data,$id);
    echo 1;
  }

}
?>