<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ************************************************************************************
		Purpose : To handle all login functions
		Date    : 04-10-2018 
***************************************************************************************/
class Profiles extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Profile_model");
		$admindata = $this->session->userdata('admindata');
      if ($admindata['user_id']>0)
      {
          //do something
      }else{
          redirect('login'); //if session is not there, redirect to login page
      } 
		date_default_timezone_set("Asia/Kolkata");
	}
	/* ************************************************************************************
						Purpose : To handle Profile function 
	        **********************************************************************/

	//To get user Profile and load profile view page
	public function index()
	{
    $admindata = $this->session->userdata('admindata');
    $user_id = $admindata['user_id'];
    $data['profile'] = $this->Profile_model->user_profile_details($user_id);
	 $this->load->view('profile/profile_view',$data);
	}
  // To update profile details
  public function profile_update()
  {
    $admindata = $this->session->userdata('admindata');
    $oimage = $this->input->post('oimage');
    $user_id = $this->input->post('eid');
    $data['fname']=$this->input->post('fname');
    $data['dob']= date('Y-m-d', strtotime($this->input->post('dob')));
    $data['pincode']= $this->input->post('pincode');
    $data['cno'] = $this->input->post('cno');
    $data['email']=$this->input->post('email');
    $data['address']=$this->input->post('address');
    $data['modified_on']=date('Y-m-d H:i:s');
    $data['modified_by'] = $admindata['user_id'];
    if(!empty($_FILES['image']['name'])){
      $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

      if($oimage!='defaultprofile.jpg'){
        unlink('assets/user_profile/'.$oimage);
      }
      $config['upload_path'] = 'assets/user_profile';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['file_name'] = $this->input->post('eid');
      $profileName = $config['file_name'].'.'.$ext;
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('image'))
      {
        $uploadData = $this->upload->data();
        $data['profile_image'] = $profileName;
      }
      else
      {
        $data['profile_image'] = $oimage;
      }
    }
    else
    { 
      $data['profile_image'] = $oimage;
    }

    $result = $this->Profile_model->profile_update($data, $user_id);
    if($result){
      $this->session->set_flashdata('update_success', 'Profile details has been updated successfully...');
    }
    else{
      $this->session->set_flashdata('update_error', 'Could not update profile details!');
    }
    redirect('/Profiles');

  }
  // To validate dob
  public function dob_validation()
  {
    $dob = $this->input->post('dob');
    $result = age_validation_18($dob);
    echo  $result;die;
  }
  //To Check Old password correct
  public function profile_password_check()
  {
    $pass = $this->input->post('value');
    $val = encryptthis($pass, 'Rajexim2020');
    $eid = $this->input->post('id');
    $res = $this->Profile_model->profile_password_check($val,$eid);
    if(!empty($res)){ echo 1; }else{ echo 0; }
  }

  //To Update New Password
  public function password_update()
  {
      $user_id = $this->input->post('eid');
      $pass    = $this->input->post('npass');
      $val     = encryptthis($pass, 'Rajexim2020');
      $result = $this->Profile_model->profile_update_pass($val, $user_id);
      if($result){
          $this->session->set_flashdata('update_success', 'Password has been updated successfully.');
      }
      else{
          $this->session->set_flashdata('update_error', 'Could not update password!');
      }
      redirect('/Login');

  }





}
