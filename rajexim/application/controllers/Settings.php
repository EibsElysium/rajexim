<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* ************************************************************************************
		Purpose : To handle all common settings functions
		Date    : 04-10-2018 
***************************************************************************************/
class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Setting_model', 'User_model'));
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
						Purpose : To handle General Setting Functions
	        **********************************************************************/
	public function index()
	{
		$data['date_formats']  = common_select_values('date_format', 'date_formats', '', 'result');
		$_SESSION['user_id'] = 1;
		$data['g_settings'] = common_select_values('*', 'general_settings', '', 'row');
		$countryId = ($data['g_settings']->country) ? $data['g_settings']->country : 101;
		$stateId   = ($data['g_settings']->state) ? $data['g_settings']->state : 35;
		$data['country_lists']= common_select_values('*', 'ad_countries', '', 'result');
		$data['state_lists']  = $states = common_select_values('*', 'ad_states', ' country_id = "'.$countryId.'"', 'result');
		$data['city_lists']   = $states = common_select_values('*', 'ad_cities', ' state_id = "'.$stateId.'"', 'result');
		$this->load->view('common_settings/general_settings', $data);
	}
	// To list state details based on country id
	public function state_list()
	{
		$countryId = $this->input->post('country');
		$states = $this->Setting_model->state_list($countryId);
		$option = '';
	     $option.='<option value="">Select State</option>'; 
	    foreach ($states as $state) {
	        $option.='<option value='.$state->id.'>'.$state->name.'</option>';
	    }
	    echo $option;
	}
	
	// To list city details based on state id
	public function city_list()
	{
		$stateId = $this->input->post('state');
		$cities = $this->Setting_model->city_list($stateId);
		$option = '';
	     $option.='<option value="">Select City</option>'; 
	    foreach ($cities as $city) {
	        $option.='<option value='.$city->sid.'>'.$city->name.'</option>';
	    }
	    echo $option;
	}
	// To update general setting details 
	public function general_settings_update()
    {
    	
	    if($this->input->post('submit'))
	    {
	      $oldlogo = $this->input->post('oldlogo');
	      $oldfav  = $this->input->post('oldfav');

	      if(!empty($_FILES['product_logo']['name']))
	      { 

	        $ext = pathinfo($_FILES['product_logo']['name'], PATHINFO_EXTENSION);	       
	        $config['upload_path'] = 'assets/common_images';
	        $config['allowed_types'] = 'jpg|jpeg|png|gif';
	        $config['file_name'] = 'logo';
	        $this->load->library('upload',$config);
	        $this->upload->initialize($config);
	        if(file_exists('assets/common_images/'.$oldfav))
	        {
	        	unlink('assets/common_images/'.$oldlogo);
	        }
	        if($this->upload->do_upload('product_logo')){
	          $uploadData = $this->upload->data();
	          $data['product_logo'] = 'logo.'.$ext;
	          }else{
	          $data['product_logo'] = $oldlogo;
	          }
	        }else{
	        	$data['product_logo'] = $oldlogo;
	        }

	      if(!empty($_FILES['favicon']['name'])){ 

	        $ext = pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
	        $config['upload_path'] = 'assets/common_images';
	        $config['allowed_types'] = 'ico|jpg|jpeg|png|gif|image/x-icon';
	        $config['file_name'] = 'favicon';
	        $this->load->library('upload',$config);

	        if(file_exists('assets/common_images/'.$oldfav))
	        {
	        	unlink('assets/common_images/'.$oldfav);
	        }
	      
	        $this->upload->initialize($config);
	        if($this->upload->do_upload('favicon')) 
	        {
	          $uploadData = $this->upload->data();
	          $data['favicon'] = 'favicon.'.$ext;
	          
	          }else{
	          $data['favicon'] = $oldfav;
	          }
	        }else{
	        	$data['favicon'] = $oldfav;
	        }
	        
	      $data['product_title'] = $this->input->post('title');
	      $data['contact_person_name'] = $this->input->post('contact_person_name');
	      $data['contact_person_email_id'] = $this->input->post('contact_person_emailId');
	      $data['website'] = $this->input->post('website');
	      $data['address'] = $this->input->post('address');
	      $data['country'] = $this->input->post('country');
	      $data['state']   = $this->input->post('state');
	      $data['city']    = $this->input->post('city');
	      $data['pincode'] = $this->input->post('pincode');
	      $data['date_format'] = $this->input->post('date_format');
	      $data['modified_on'] = date('Y-m-d H:i:s');
	      $data['sgst'] = $this->input->post('sgst');
	      $data['cgst'] = $this->input->post('cgst');
	      $data['max_reply'] = $this->input->post('max_reply');
	      $data['min_duration'] = $this->input->post('unattend_min_duration');
	      $data['currency_format'] = 'INR';
	      $data['gst_no'] = $this->input->post('gst_no');
	      $data['cin_no'] = $this->input->post('cin_no');
	      
	      $data['smtp_host_name'] = $this->input->post('smtp_host_name');
	      $data['smtp_user_name'] = $this->input->post('smtp_user_name');
	      $data['smtp_password'] = encryptthis($this->input->post('smtp_password'),'Rajexim2020');

	      $id = 1;
	      $result = $this->Setting_model->general_setting_update($data, $id);

	      if($result){
				$this->session->set_flashdata('g_success', 'General Setting details have been updated successfully...');
	      }else{
	      	   $this->session->set_flashdata('g_err', 'Could not update general setting details!');
	      }

	    }else{
	    	
	    } 
		redirect('Settings');      
  }	
  /* ************************************************************************************
						Purpose : To handle Industry Functions
	        **********************************************************************/
	// To list industry details
	public function industry_list()					
	{
		$data['industry_lists'] = $this->Setting_model->industry_list();
		$this->load->view('industry/industry_list', $data);
	}
	// To save industry details
	public function industry_save()
	{
		$industry_names = (!empty($this->input->post('industry'))) ? $this->input->post('industry') : '';
		if(!empty($industry_names))
		{
			$insert_columns = 'industry_name, created_on, created_by';
			$insert_values = '';
			foreach ($industry_names as $key => $industry_name) 
			{
				$insert_values = "'".$industry_name."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
				$insert_result = $this->Setting_model->industry_save($insert_columns, 'industries',  $insert_values);
			}
		}	
		$this->session->set_flashdata('industry_success', 'Industry Name has been created successfully...');

		redirect('Settings/industry_list');     
	}
	// To change industry status
	public function industry_status_change()
	{
		$data['industry_id'] = $this->input->post('id');
	    $data['status'] = $this->input->post('status');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Setting_model->industry_status_change($data);
	    return ($result) ? 1 : 0;
	}
	// To get industry edit
	public function industry_edit()
	{
		$industry_id = $this->input->post('val');
		$data['industry_details'] = $this->Setting_model->industry_by_id($industry_id);
		$this->load->view('industry/industry_edit',$data);
	}
	// To check industry name unique
	public function industry_unique()
	{
		$industry_name = $this->input->post('value');
	    $result = $this->Setting_model->industry_unique($industry_name);
	    if(!empty($result)){ $result = 1;}else{ $result = 0; }
	    echo  $result;
	}
	// To save industry details
	public function industry_update()
	{
		$data['industry_id'] = $this->input->post('industry_id');
		$data['industry_name'] = $this->input->post('industry_name');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Setting_model->industry_update($data);
		$this->session->set_flashdata('industry_success', 'Industry Name has been updated successfully...');
		redirect('Settings/industry_list');     
	}
	// To delete industry
	public function industry_delete()
	{
		$data['industry_id'] = $this->input->post('indus_id');
	    $data['status'] = 2;
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');

	    // To check lead type in lead
		$check_l_industry = $this->Setting_model->industry_in_product($data['industry_id']);

		if(empty($check_l_industry))
		{
			$result = $this->Setting_model->industry_status_change($data);
			$this->session->set_flashdata('industry_success', 'Industry has been deleted successfully...');
		}else{
			$this->session->set_flashdata('l_t_err', 'Could not delete Industry. Industry is mapped with other modules!');
		}

	    redirect('Settings/industry_list');
	}
	 /* ************************************************************************************
						Purpose : To handle Email Settings Functions
	        **********************************************************************/
	// To list email settings email ID details
	public function email_list()					
	{
		$data['email_lists'] = $this->Setting_model->email_list();
		$data['smtp_host_list'] = $this->Setting_model->smtp_host_list();
		$this->load->view('email/email_list', $data);
	}
	// To change email status
	public function email_status_change()
	{
		$data['email_detail_id'] = $this->input->post('id');
	    $data['status'] = $this->input->post('status');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Setting_model->email_status_change($data);
	    return ($result) ? 1 : 0;
	}
	// To save email details
	public function email_save()
	{
		$email_ID = ($this->input->post('email_ID')) ? $this->input->post('email_ID') : '';
		$from_name = ($this->input->post('from_name')) ? $this->input->post('from_name') : '';
		$signature = ($this->input->post('signature')) ? $this->input->post('signature') : '';
		$cc = (!empty($this->input->post('email_cc'))) ? implode(',', $this->input->post('email_cc')) : '';
		$bcc = (!empty($this->input->post('email_bcc'))) ? implode(',', $this->input->post('email_bcc')) : '';
		$password = ($this->input->post('password')) ? encryptthis($this->input->post('password'), 'Rajexim2020')  : '';
		$smtp_host = ($this->input->post('smtp_host')) ? $this->input->post('smtp_host') : '';

		if(!empty($email_ID) && !empty($from_name))
		{
			$insert_columns = 'email_ID, from_name, signature, cc, bcc, created_on, created_by, password, smtp_host';
			$insert_values = '';
			$insert_values = "'".$email_ID."', '".$from_name."', '".$signature."',  '".$cc."', '".$bcc."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."', '".$password."', '".$smtp_host."' ";
			$insert_result = $this->Setting_model->email_save($insert_columns, 'email_details',  $insert_values);
			
		}
		if($insert_result)
		{
			$this->session->set_flashdata('email_success', 'Email ID has been created successfully...');
		}else{
			$this->session->set_flashdata('email_err', 'Could not create Email ID!');
		}
		redirect('Settings/email_list'); 
	}
	// To check email ID unique
	public function email_ID_unique()
	{
		$email_ID = $this->input->post('value');
	    $result = $this->Setting_model->email_ID_unique($email_ID);
	    if(!empty($result)){ $result = 1;}else{ $result = 0; }
	    echo  $result;
	}
	// To get Email ID edit
	public function email_ID_edit()
	{
		$data['smtp_host_list'] = $this->Setting_model->smtp_host_list();
		$data['email_lists'] = $this->Setting_model->email_list();
		$email_ID_val = $this->input->post('val');
		$data['email_ID_details'] = $this->Setting_model->email_ID_by_id($email_ID_val);
		$data['pass'] = decryptthis($data['email_ID_details']->password, 'Rajexim2020');
		$this->load->view('email/email_edit',$data);
	}
	// To update email ID details
	public function email_update()
	{
		$data['email_detail_id'] = $this->input->post('email_detail_id');
		$data['email_ID'] = $this->input->post('email_ID');
		$data['from_name'] = $this->input->post('from_name');
		$data['cc'] = (!empty($this->input->post('email_cc'))) ? implode(',', $this->input->post('email_cc')) : '';
		$data['bcc'] = (!empty($this->input->post('email_bcc'))) ? implode(',', $this->input->post('email_bcc')) : '';
		$data['signature'] = $this->input->post('signature');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['password']  = ($this->input->post('password')) ? encryptthis($this->input->post('password'), 'Rajexim2020') : '';
		$data['smtp_host'] = ($this->input->post('smtp_host')) ? $this->input->post('smtp_host') : '';

	    $result = $this->Setting_model->email_update($data);
		$this->session->set_flashdata('email_success', 'Email ID has been updated successfully...');
		redirect('Settings/email_list');     
	}
	// To delete email ID
	public function email_ID_delete()
	{
		$data['email_detail_id'] = $this->input->post('email_detail_id');
	    $data['status'] = 2;
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Setting_model->email_status_change($data);
	    if($result)
	    {
	         $this->session->set_flashdata('email_success', 'Email ID has been deleted successfully...');
	    }else{
	        $this->session->set_flashdata('email_err', 'Could not delete Email ID!');
	    }
	    redirect('Settings/email_list');
	}
	
  /* ************************************************************************************
						Purpose : To handle Email Configuration Functions
	        **********************************************************************/
	// To display Email Configuration View form
	public function email_configuration()					
	{
		$data['ec_configuration'] = general_setting_details();
		$this->load->view('settings/email_configuration', $data);
	}
	// To update email configuration details
	public function email_configuration_update()
	{
    
		$data['smtp_host_name'] = $this->input->post('smtp_host_name');
		$data['smtp_user_name'] = $this->input->post('smtp_username');
		$smtp_password = aes128Encrypt('atchayapathra', $this->input->post('smtp_password'));
		$data['smtp_password'] = $smtp_password;
		$data['from_mail'] = $this->input->post('from_mail');
		$id = 1;
		$result = $this->Setting_model->email_configuration_update($data, $id);
 		if($result){
			  $this->session->set_flashdata('ec_success', 'Email Configuration has been updated successfully...');
	     }else{
	      	  $this->session->set_flashdata('ec_err', 'Could not update email configuration!');
	     }
	     redirect('email-configuration');
	}
	/* ************************************************************************************
						Purpose : To handle SMS Configuration Functions
	        **********************************************************************/
	// To display SMS Configuration View form
	public function sms_configuration()					
	{
		$data['sms_configuration'] = general_setting_details();
		$this->load->view('settings/sms_configuration', $data);
	}

	// To update sms configuration details
	public function sms_configuration_update()
	{

		$data['sms_sender_id'] = $this->input->post('sms_sender_id');
		$data['sms_auth_key'] = $this->input->post('sms_auth_key');
		$id = 1;
		$result = $this->Setting_model->sms_configuration_update($data, $id);
 		if($result){
			  $this->session->set_flashdata('sms_success', 'SMS Configuration has been updated successfully...');
	     }else{
	      	  $this->session->set_flashdata('sms_err', 'Could not update SMS configuration!');
	     }
	     redirect('settings/sms_configuration');
	}
	/* ************************************************************************************
						Purpose : To handle Email Template Functions
	        **********************************************************************/	
	// To list email template list
	public function email_template_list()
	{
		$data['et_lists'] = $this->Setting_model->email_template_list();
		$this->load->view('settings/email_template_list', $data);
		
	}   

	// To update email active and inactive status
	public function email_template_change_status()
	{
		$data['status']=$this->input->post('status');
	    $data['modified_by']   = $_SESSION['user_id'];
		$data['modified_on']   = date('Y-m-d H:i:s');
		$id = $this->input->post('id');
	    $result = $this->Setting_model->email_template_change_status($data, $id);
	    if($result){ echo 1; } else{ echo 0; }

	}

	// To view email template details
	public function email_template_view()
	{
		$et_id = $this->input->post('id');
		$data['sms_template_view'] = $this->Setting_model->email_template_by_id($et_id);
		$this->load->view('settings/sms_template_view', $data);
	}       

	// To edit email template details
	public function email_template_edit($id)
	{
		$et_id = $id;
		$data['email_template'] = $this->Setting_model->email_template_by_id($et_id);
		$this->load->view('settings/email_template_edit', $data);
	}     

	// To update email template details
	public function email_template_update()
	{

		$et_id  = $this->input->post('et_id');
		$data['email_name'] = $this->input->post('title');
		$data['email_subject'] = $this->input->post('subject');
		$data['email_content'] = $this->input->post('content');
		$data['modified_by']   = $_SESSION['user_id'];
		$data['modified_on']   = date('Y-m-d H:i:s');
		$result = $this->Setting_model->email_template_update($data, $et_id);
		if($result){
			  $this->session->set_flashdata('et_success', 'Email Template has been updated successfully...');
	     }else{
	      	  $this->session->set_flashdata('et_err', 'Could not update email template!');
	     }
	     redirect('settings/email_template_list');
		
	}  	

	/* ************************************************************************************
						Purpose : To handle SMS Template Functions
	        **********************************************************************/	
	// To list sms template list
	public function sms_template_list()
	{
		$data['sms_lists'] = $this->Setting_model->sms_template_list();
		$this->load->view('settings/sms_template_list', $data);
		
	}   
	// To update the active and inactive status
	public function sms_template_change_status()
	{
		$data['status']=$this->input->post('status');
	    $data['modified_by']   = $_SESSION['user_id'];
		$data['modified_on']   = date('Y-m-d H:i:s');
		$id = $this->input->post('id');
	    $result = $this->Setting_model->sms_template_change_status($data, $id);
	    if($result){ echo 1; } else{ echo 0; }

	}

	// To view sms template details
	public function sms_template_view()
	{
		$sms_id = $this->input->post('id');
		$data['sms_template_view'] = $this->Setting_model->sms_template_by_id($sms_id);
		$this->load->view('settings/sms_template_view', $data);
	}       

	// To edit sms template details
	public function sms_template_edit($id)
	{
		$et_id = $id;
		$data['sms_template'] = $this->Setting_model->sms_template_by_id($et_id);
		$this->load->view('settings/sms_template_edit', $data);
	}     

	// To update sms template details
	public function sms_template_update()
	{

		$sms_id  = $this->input->post('sms_id');
		$data['sms_template_name'] = $this->input->post('title');
		$data['sms_content'] = $this->input->post('content');
		$data['modified_by']   = $_SESSION['user_id'];
		$data['modified_on']   = date('Y-m-d H:i:s');
		$result = $this->Setting_model->sms_template_update($data, $sms_id);
		if($result){
			  $this->session->set_flashdata('sms_success', 'SMS Template has been updated successfully...');
	     }else{
	      	  $this->session->set_flashdata('sms_err', 'Could not update SMS template!');
	     }
	     redirect('settings/sms_template_list');
		
	} 

	/* ************************************************************************************
						Purpose : To handle Department Template Functions
	        **********************************************************************/	

	public function department()
	{
		$data['dept_list'] = $this->Setting_model->get_dept_list();
	    $this->load->view('settings/dept_list',$data);
	}
    public function dept_delete()
   { 
    $id = $this->input->post('department');
    $result = $this->Setting_model->dept_delete($id);
    if ($result) {
      $this->session->set_flashdata('dept_suc_del', 'Department has been deleted successfully.');
    }
    else{
      $this->session->set_flashdata('dept_err_del', 'Something went wrong');
    }
    redirect('/settings/department');
   }
  public function add_dept_page()
  {
    $this->load->view('settings/dept_add');
  }
 public function unique_dept()
 {
    $val = $this->input->post('value');
    $result = $this->Setting_model->department_unique($val);
    echo count($result);
 }
 public function unique_dept_edit()
 {

    	$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		if($val!=$oldmname)
		{
			$res = $this->Setting_model->department_unique($val);
			if($res){ echo 1; }else{ echo 0; }
		}
		else
		{
			echo 0;
		}

 }
 public function create_dept()
 { 
    $data['department']=$this->input->post('department');
   	$data['status']=0;
   	$data['mon'] = date('Y-m-d H:i:s');
    $result = $this->Setting_model->dept_create($data);
    if($result){
      $this->session->set_flashdata('dept_suc_add', 'Department has been created successfully.');
    }
    else{
      $this->session->set_flashdata('dept_err_add', 'Something went wrong.');
    }
    redirect('/settings/department');
  }
  public function edit_dept()
  {
  	$id = $this->input->post('value');
  	$data['department'] = $this->Setting_model->get_dept($id);
  	if($data['department']){ echo $data['department']->department_id.'|'.$data['department']->dept_name; }else{ echo ''; }
  }
 public function update_dept()
 { 
    $data['department']=$this->input->post('department');
   	$data['id']=$this->input->post('id');
   	$data['mon'] = date('Y-m-d H:i:s');
    $result = $this->Setting_model->dept_update($data);
    if($result){
      $this->session->set_flashdata('dept_suc_up', 'Department has been updated successfully.');
    }
    else{
      $this->session->set_flashdata('dept_err_up', 'Something went wrong.');
    }
    redirect('/settings/department');
  }


  //To active and inactive User Type status
	public function dept_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->dept_active($data,$id);

    	if($data==1){

	    	$this->session->set_flashdata('dept_err_up', 'Department has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('dept_suc_del', 'Department has been activated successfully.');
    	}
    	echo 1;
	}

  /* ************************************************************************************
						Purpose : To handle menu item Catogary Functions
	        **********************************************************************/

	//To Get All product Category and load product category list page
	public function category_list()
	{
		$data['type_lists'] = $this->Product_model->dish_type_list();
		$data['product'] = $this->Setting_model->product_category_list();
		$this->load->view('settings/menu_item_category/category_list',$data);
	}

	//To active and inactive category status
	public function category_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->product_category_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('cat_err', 'Category has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('cat_success', 'Category has been activated successfully.');
    	}
    	echo 1;
	}


	//To Check Menu item category unique
	public function unique_product_category()
	{
		$val = $this->input->post('value');
		$type = $this->input->post('type');

		$type = implode(',', $type);
		$res = $this->Setting_model->product_category_unique($val, $type);
		if($res){ echo 1; }else{ echo 0; }
	}

	//To insert  category
	public function category_add()
	{

		$type_id = implode(',', $this->input->post('m_type'));

		$check_cat = $this->Setting_model->product_category_unique($this->input->post('product_category'), $type_id);

		if(empty($check_cat))
		{
			$data['product_category'] = $this->input->post('product_category');
			$data['type_id'] = $type_id;
			$data['modified_on'] = date('Y-m-d H:i:s');
			$data['status'] = 0;
			$result = $this->Setting_model->product_category_add($data);
		}
			
		$this->session->set_flashdata('cat_success', 'Category has been added successfully.');

	    redirect('/category');
	}

	//To get product category and load producat category edit page
	public function edit_category_page()
	{
		$data['type_lists'] = $this->Product_model->dish_type_list();
		$id = $this->input->post('id');
		$data['product'] = $this->Setting_model->product_category_by_id($id);

		$this->load->view('settings/menu_item_category/category_edit',$data);
	}

	//To Check category Unique
	public function edit_unique_category()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		$type = $this->input->post('type');
		$cat_id = $this->input->post('cat_id');

		$res = $this->Setting_model->product_category_unique_edit($val, $type, $cat_id);
		if($res){ echo 1; }else{ echo 0; }
	}

	//To Delete Category
	public function category_delete()
	{
		$id = $this->input->post('product');

		// To check category is associated with product table
		$check_prod = $this->Setting_model->product_category_in_products($id);

		// To check category is associated with menu rule day
		$check_m_rule_day = $this->Setting_model->product_category_in_menu_rule_day($id);

		// To check category is associated with menu rule
		$check_m_rule = $this->Setting_model->product_category_in_menu_rule($id);

		// To check category is associated with product table
		$check_m_maker = $this->Setting_model->product_category_in_menu_maker($id);

		if(empty($check_prod) && empty($check_m_rule_day) && empty($check_m_rule) && empty($check_m_maker))
		{
			$data = 2;
			$result = $this->Setting_model->product_category_delete($data,$id);

			$this->session->set_flashdata('cat_success', 'Category has been deleted successfully.');

		}else{
			$this->session->set_flashdata('cat_err', 'Could not delete category. Category is mapped with other modules.');
		}

    	redirect('/category');
	}
		//To Update Product Category
	public function product_category_update()
	{
		$data['id'] = $this->input->post('id');
		$data['product_category'] = $this->input->post('product_category');
		$m_type = implode(',', $this->input->post('m_type'));

		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['m_type'] = $m_type;
		$this->Setting_model->product_category_update($data);

		$this->session->set_flashdata('product_update', 'Product Category has been updated successfully.');
	    redirect('/category');
	}

/* ************************************************************************************
						Purpose : To handle User Type Setting Functions
	        **********************************************************************/
	//To Get All user type and load user type list page
	public function user_type()
	{
		$data['utype'] = $this->Setting_model->get_all_usertype();
		$this->load->view('settings/usertype/usertype_list',$data);
	}

	//To active and inactive User Type status
	public function usertype_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->usertype_active($data,$id);
    	if($data==1){
	    	$this->session->set_flashdata('user_inactive', 'User Type has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('user_active', 'User Type has been activated successfully.');
    	}
    	echo 1;
	}

	//To Load Usertype add page
	public function usertype_add_page()
	{
		$this->load->view('settings/usertype/usertype_add');
	}

	//To Check user type unique
	public function unique_usertype()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->usertype_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
	}

	//To insert User Type
	public function usertype_add()
	{
		$data['usertype'] = $this->input->post('usertype');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['status'] = 0;

		$result = $this->Setting_model->usertype_add($data);

		$this->session->set_flashdata('user_success', 'User Type has been added successfully.');
	    redirect('/settings/user_type');
	}

	public function edit_usertype_page()
	{
		$id = $this->input->post('value');
		$res['user'] = $this->Setting_model->user_type_by_id($id);
		if($res['user']){ echo $res['user'][0]['user_type_id'].'|'.$res['user'][0]['type_name']; }else{ echo ''; }
	}

	//To Check edit user type unique
	public function edit_unique_usertype()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		if($val!=$oldmname)
		{
		$res = $this->Setting_model->usertype_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
		}
		else
		{
			echo 0;
		}
	}

	// To update usertype 
	public function usertype_update()
	{

		$data['usertype'] = $this->input->post('usertype');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['id'] = $this->input->post('id');

		$result = $this->Setting_model->usertype_update($data);
		$this->session->set_flashdata('user_update', 'User Type has been updated successfully.');
		redirect('/Settings/user_type');
	}

	//To Delete user type
	public function usertype_delete()
	{
		$id = $this->input->post('utype');
		$result = $this->Setting_model->usertype_delete($id);
		if($result){
    		$this->session->set_flashdata('del_success', 'User Type has been deleted successfully.');
    	}
    	else{
    		$this->session->set_flashdata('del_error', 'User Type has been deleted successfully.');
    	}
    	redirect('/Settings/user_type');
	}


	 /* ************************************************************************************
						Purpose : To handle Dish Type Setting Functions
	        **********************************************************************/
	  public function dish_type_list()
	  {
	    $data['dish_list'] = $this->Product_model->dish_type_list();  
	    $this->load->view('settings/dish_type/dish_type_list',$data);
	  }

	  public function dish_type_active()
	  {
	    $value['id'] = $this->input->post('id');
	    $value['status'] = $this->input->post('status');
	    $result = $this->Product_model->dish_type_active($value);  
	    if($result){
	      echo 1;
	    }
	  }

	  public function dish_type_unique()
	  {
	    $id = $this->input->post('value');
	    $result = $this->Product_model->dish_type_unique($id);

	    if($result){ echo 1; }else{ echo 0; }
	   
	  }

	  public function dish_type_add_page()
	  {
	    $this->load->view('settings/dish_type/dish__add');
	  }

	  // To add menu item type
	  public function dish_type_add()
	  {
	      $ext = $_FILES['timg'];
		$ext1 = explode('.', $ext['name']);

		$value['type_name'] = $this->input->post('type_name');
	    $value['color_name'] = $this->input->post('tcolor');
	    $value['modifiedon'] = date('Y-m-d H:i:s');
	    $value['status'] = 0;

		$configtimg['upload_path'] = 'assets/images/menu_type_image'; # check path is correct
		$configtimg['max_size'] = '10240000';
		$configtimg['allowed_types'] =  'jpg|jpeg|png'; # image extenstion on here
		$configtimg['overwrite'] = FALSE;
		$configtimg['remove_spaces'] = TRUE;
		$timg_name = str_replace(" ", "_", $value['type_name']);
		$configtimg['file_name'] = $timg_name;

		$this->load->library('upload', $configtimg);
		$this->upload->initialize($configtimg);

		if (!$this->upload->do_upload('timg')) # form input field attribute
		{
		    # Upload Failed
		    $this->session->set_flashdata('t_add_err', $this->upload->display_errors());
		    redirect('/Settings/dish_type_list');
		}
		else
		{
		    # Upload Successfull
		    $value['timg'] = $timg_name.".".$ext1[1];
		    $result = $this->Product_model->dish_type_add($value);
		}


	    
	      
	    if($result){
	      $this->session->set_flashdata('t_add_done', 'Type has been created successfully.');
	    }
	    else{
	      $this->session->set_flashdata('t_add_err', 'Could not add type!.');
	    }
	    redirect('/Settings/dish_type_list');
	    
	   // $value['type_name'] = $this->input->post('type_name');
	   // $value['color_name'] = $this->input->post('tcolor');
	   // $value['modifiedon'] = date('Y-m-d H:i:s');
	   // $value['status'] = 0;
	   // $result = $this->Product_model->dish_type_add($value);  
	   // if($result){
	   //   $this->session->set_flashdata('t_add_done', 'Type has been created successfully.');
	   // }
	   // else{
	   //   $this->session->set_flashdata('t_add_err', 'Could not add type!.');
	   // }
	   // redirect('/Settings/dish_type_list');
	  }
	  // To delete menu item type and change status 2 
	  public function dish_type_delete()
	  {
	    $value = $this->input->post('type');

	    // To check type is associated with any product category
	    $check_category = $this->Setting_model->dish_type_in_category($value);

	    // To check type is associated with product table
	    $check_m_item = $this->Setting_model->dish_type_in_products($value);

	    // To check type is associated with menu maker
	    $check_m_maker = $this->Setting_model->dish_type_in_menu_maker($value);

	    // To check type is associated with menu day rule
	    $check_m_day = $this->Setting_model->dish_type_in_menu_rule_day($value);

	    // To check type is associated with menu base rule
	    $check_m_rule = $this->Setting_model->dish_type_in_menu_rule($value);

	    if(empty($check_category) && empty($check_m_item) && empty($check_m_maker) && empty($check_m_day) &&  empty($check_m_rule))
	    {	
	    	$result = $this->Product_model->dish_type_delete($value);  
	    	$this->session->set_flashdata('t_add_done', 'Type has been deleted successfully.');

	    }else{

	    	$this->session->set_flashdata('t_add_err', 'Could not delete type. Type is mapped with other modules!.');
	    }

	    redirect('/type');
	  }
	  // To show menu item type edit page
	  public function dish_type_edit()
	  {
	  	$id = $this->input->post('id');

	    $data['dish'] = $this->Product_model->get_dish_type_by_id($id);  
	    $this->load->view('settings/dish_type/dish_type_edit',$data);
	  }

	  public function dish_type_edit_unique()
	  {
	    $id['name'] = $this->input->post('value');
	    $id['id'] = $this->input->post('id');
	    $result = $this->Product_model->dish_type_edit_unique($id);
	    if($result){ echo 1; }else{ echo 0; }
	  }

	  public function dish_type_update()
	  {
	      
	      
	      if ($this->input->post('fexist'))
		{
			$ext = $_FILES['timg'];
			$ext1 = explode('.', $ext['name']);

			$value['name'] = $this->input->post('type_name');
		    $value['id'] = $this->input->post('type_id');
		    $value['color_name'] = $this->input->post('tcolor');
			$oldtimg = $this->input->post('oldtimg');

			$configimg['upload_path'] = 'assets/images/menu_type_image'; # check path is correct
			$configimg['max_size'] = '10240000';
			$configimg['allowed_types'] = 'jpg|jpeg|png'; # add image on here
			$configimg['overwrite'] = FALSE;
			$configimg['remove_spaces'] = TRUE;
			$img_name = str_replace(" ", "_", $value['name']);
			$configimg['file_name'] = $img_name;

			$this->load->library('upload', $configimg);
			$this->upload->initialize($configimg);

			unlink('assets/app/media/video/'.$oldtimg);

			if (!$this->upload->do_upload('video')) # form input field attribute
			{
			    # Upload Failed
			    $this->session->set_flashdata('t_add_err', $this->upload->display_errors());
		    redirect('/Settings/dish_type_list');
			}
			else
			{
			    # Upload Successfull
			    $value['img'] = $img_name.".".$ext1[1];
			    $result = $this->Product_model->dish_type_update($value); 
			    $this->session->set_flashdata('t_add_done', 'Type has been updated successfully.');
			    redirect('/Settings/dish_type_list');
			}
		}
		else
		{
		    $value['name'] = $this->input->post('type_name');
		    $value['id'] = $this->input->post('type_id');
		    $value['color_name'] = $this->input->post('tcolor');
		    $result = $this->Product_model->dish_type_update($value);  
		    if($result){
		      $this->session->set_flashdata('t_add_done', 'Type has been updated successfully.');
		    }
		    else{
		      $this->session->set_flashdata('t_add_err', 'Could not update type!.');
		    }
		    redirect('/Settings/dish_type_list');
		}
		
		
	   // $value['name'] = $this->input->post('type_name');
	   // $value['id'] = $this->input->post('type_id');
	   // $value['color_name'] = $this->input->post('tcolor');
	   // $result = $this->Product_model->dish_type_update($value);  
	   // if($result){
	   //   $this->session->set_flashdata('t_add_done', 'Type has been updated successfully.');
	   // }
	   // else{
	   //   $this->session->set_flashdata('t_add_err', 'Could not update type!.');
	   // }
	   // redirect('/Settings/dish_type_list');
	}

/********************************************************************************************
                            Purpose : To handle Property Settings Function
    *****************************************************************************************/

	//To Get property settings and load property list
    public function property_settings()
	{
		$data['property'] = $this->Setting_model->property_settings_list();
		$this->load->view('settings/property/property_list',$data);
	}  

	//To active and inactive property status
	public function property_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->property_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('property_err', 'Property has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('property_success', 'Property has been activated successfully.');
    	}
    	echo 1;
	}  


	//To get property name and Load property add page
	public function property_add_page()
	{
		$data['sub'] = $this->Setting_model->property_name_list();
		$this->load->view('settings/property/property_add', $data);
	}

	//To Check property name unique
	public function property_unique()
	{
		$val = $this->input->post('val');
		$res = $this->Setting_model->property_unique($val);
		if($res){ echo 1; }else{ echo 0; }
	}

	//To Check icon unique
	public function icon_unique()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->property_icon_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
	}

	//To insert property
	public function property_add()
	{
		$name = $this->input->post('property_name');
		$icon = $this->input->post('icon');
		$data['status'] = 0;
		
		$data['name'] = $name;
	    $data['icon'] = $icon;
	    $data['modifiedon'] = date('Y-m-d H:i:s');
	    $result = $this->Setting_model->property_add($data);
	  	$this->session->set_flashdata('property_success', 'Property has been added successfully.');
	       
		redirect('/property');
	}

	//To get Property and load property edit page
	public function edit_property_page()
	{
		$id = $this->input->post('id');
		$res['property'] = $this->Setting_model->property_by_id($id);
		$this->load->view('settings/property/property_edit',$res);
	}


	//To Check property Unique
	public function edit_unique_property()
	{

		$val = $this->input->post('val');
		$id = $this->input->post('id');

		$res = $this->Setting_model->property_unique_edit($val, $id);
		if($res){ echo 1; }else{ echo 0; }
	}

	//To Check icon Unique
	public function edit_unique_icon()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		if($val!=$oldmname)
		{
		$res = $this->Setting_model->property_icon_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
		}
		else
		{
			echo 0;
		}
	}

	//To Update property settings
	public function property_update()
	{

		$data['pid'] = $this->input->post('pid');
		$data['name'] = $this->input->post('name');
		$data['icon'] = $this->input->post('icon');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$this->Setting_model->property_update($data);
		$this->session->set_flashdata('property_success', 'Property has been updated successfully.');
	    redirect('/property');
	}

	//To Delete Property
	public function property_delete()
	{
		$id = $this->input->post('property');

		// To check property in subproperty
		$check_subproperty = $this->Setting_model->property_in_subproperty($id);

		// To check property in products
		$check_prod = $this->Setting_model->property_in_products($id);

		// To check property in menu maker
		$check_m_maker = $this->Setting_model->property_in_menu_maker($id);

		// To check property in menu_rule
		$check_m_rule = $this->Setting_model->property_in_menu_rule($id);

		// To check property in menu_rule day
		$check_m_rule_day = $this->Setting_model->property_in_menu_rule_day($id);

		if(empty($check_subproperty) &&  empty($check_prod) &&  empty($check_m_maker) && empty($check_m_rule) && empty($check_m_rule_day))
		{
			$data = 2;
			$result = $this->Setting_model->property_delete($data,$id);
			$this->session->set_flashdata('property_success', 'Property has been deleted successfully.');
		}
		else{

			$this->session->set_flashdata('property_err', 'Could not delete property. Property is mapped with other modules.');
		}	
	
    	redirect('/property');
	}

	public function property_view()
	{
		$id = $this->input->post('id');
		$res['property'] = $this->Setting_model->property_by_id($id);
		$res['subprop'] = $this->Setting_model->subproperty_by_id($id);

		$this->load->view('settings/property/property_view',$res);

	}

	/********************************************************************************************
                            Purpose : To handle Sub Property Settings Function
    *****************************************************************************************/

     // To list sub property 
    public function sub_property_list()
	{
		$data['property'] = $this->Setting_model->subproperty_list();
		$this->load->view('settings/subproperty/subproperty_list',$data);
	}                        

	//To get property name and Load property add page
	public function subproperty_add_page()
	{
		$data['subproperty'] = $this->Setting_model->property_name_list();
		$this->load->view('settings/subproperty/subproperty_add', $data);
	}

	//To Check sub property name unique
	public function subproperty_unique()
	{
		$val = $this->input->post('val');
		$proid = $this->input->post('proid');
		$res = $this->Setting_model->subproperty_unique($val,$proid);
		if($res){ echo 1; }else{ echo 0; }
	}

	//To insert subproperty
	public function subproperty_add()
	{
		$sname = $this->input->post('sname');
		$proid = $this->input->post('propname');
		
		$data['property_id'] = $proid;
		$data['name'] = $sname;
		$data['status'] = 0;
    	$data['modified_on'] = date('Y-m-d H:i:s');
		$result = $this->Setting_model->subproperty_add($data);
	    $this->session->set_flashdata('property_success', 'Subproperty has been added successfully.');
		redirect('/sub-property');

	}
	public function subproperty_edit_unique()
	{
		$val = $this->input->post('val');
		$id = $this->input->post('proid');
		$sid = $this->input->post('id');
		$res = $this->Setting_model->subproperty_edit_unique($val,$id,$sid);	
		if($res){ echo 1; }else{ echo 0; }
	}

	//To active and inactive subproperty status
	public function subproperty_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->subproperty_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('property_err', 'Subproperty has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('property_success', 'Subproperty has been activated successfully.');
    	}
    	echo 1;
	}  

	//To Delete sub Property
	public function subproperty_delete()
	{
		$id = $this->input->post('property');

		// To check subproperty is in menu maker
		$check_m_maker = $this->Setting_model->subproperty_in_menu_maker($id);

		// To check subproperty is in menu rule
		$check_m_rule = $this->Setting_model->subproperty_in_menu_rule($id);

		// To check subproperty is in menu rule day
		$check_m_rule_day = $this->Setting_model->subproperty_in_menu_rule_day($id);

		// To check subpropery in products
		$sub_pp_details = $this->Setting_model->subproperty_by_id($id);

		$pp = $sub_pp_details[0]['property_id'];


		$p_positions = $this->Menu_Maker_model->menu_maker_property_type_products($pp);


		$m1 = array();
		if(! empty($p_positions))
        {
          foreach ($p_positions as $key => $p_position)
          {
            $explode_prds = explode('|', $p_position->property);
            $position_base_prds = $explode_prds[$p_position->p_type_position-1];
            $explode_position_base_prds = explode(',', $position_base_prds);

            if (in_array($id, $explode_position_base_prds))
              {
                $m1[] = $p_position->product_id;
                break;
              }  
          }
        }else{
        	$m1 = '';
        }

        if(empty($check_m_maker) && empty($check_m_rule) && empty($check_m_rule) && empty($check_m_rule_day) && empty($m1) )
        {
        	$data = 2;
			$result = $this->Setting_model->subproperty_delete($id);
			$this->session->set_flashdata('property_success', 'Subproperty has been deleted successfully.');
        }else{
        	$this->session->set_flashdata('property_err', 'Could not delete subproperty. Subproperty is mapped with other modules!');
        }
    	redirect('/sub-property');
	}

	//To get sub Property and load property edit page
	public function edit_subproperty_page()
	{	
		$id = $this->input->post('id');
		$res['subproperty'] = $this->Setting_model->property_name_list();
		$res['subprop'] = $this->Setting_model->subproperty_by_id($id);

		$this->load->view('settings/subproperty/subproperty_edit',$res);
	}

	//To Update subproperty settings
	public function subproperty_update()
	{
		$sname = $this->input->post('sname');
		$propname = $this->input->post('propname');
		$sid = $this->input->post('s_id');
		$data['name'] = $sname;
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['p_id'] = $propname;
		$this->Setting_model->subproperty_update($data,$sid);
		$this->session->set_flashdata('property_success', 'Subproperty has been updated successfully.');
	    redirect('/sub-property');
	}

/********************************************************************************************
                            Purpose : To handle Subscription plan Function
    *****************************************************************************************/

    //To Get subscription plan and load subscription plan list
    public function subscription_plan()
	{
		$data['subscription'] = $this->Setting_model->subscription_plan_list();
		$this->load->view('settings/subscription/subscription_list',$data);
	}

	//To active and inactive subscription plan status
	public function subscription_plan_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->subscription_plan_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('subscription_inactive', 'Subscription Plan has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('subscription_active', 'Subscription Plan has been activated successfully.');
    	}
    	echo 1;
	}

	//To Load subscription plan add page
	public function subscription_plan_add_page()
	{
		$data['product'] = $this->Setting_model->get_all_product();
		$this->load->view('settings/subscription/subscription_add',$data);
	}

	//To Check Subscription plan name unique
	public function subscription_plan_unique()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->subscription_plan_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
	}

	//To insert subscription plan
	public function subscription_plan_add()
	{

		$data['pro'] = $this->input->post('product');
		$data['name'] = $this->input->post('name');
		$data['option'] = "deliver";
		$data['duration'] = $this->input->post('duration');
		$data['no_days_type'] = $this->input->post('no_days_type');
		$data['no_of_delivers'] = $this->input->post('no_of_delivers');
		$data['tax'] = $this->input->post('tax');
		$data['amount'] = $this->input->post('amount');
		$data['minium_amount'] = $this->input->post('minium_amount');
		$data['discount'] = $this->input->post('discount');
		$data['days'] = implode(',',$this->input->post('days'));
		$data['modifiedon'] = date('Y-m-d H:i:s');
		$data['status'] = 0;

		$result = $this->Setting_model->subscription_plan_add($data);

		$this->session->set_flashdata('subscription_success', 'Subscription Plan has been added successfully.');
	    redirect('/settings/subscription_plan');
	}

	//To get Subscription plan and load subscription plan edit page
	public function edit_subscription_plan_page()
	{
		$id = $this->input->post('id');
		$res['product'] = $this->Setting_model->get_all_product();
		$res['subscription'] = $this->Setting_model->subscription_plan_by_id($id);
		//$res['product'] = $this->Setting_model->get_all_product_by_id($res['subscription'][0]['product']);
		$this->load->view('settings/subscription/subscription_edit',$res);
	}

	//To Check subscription plan Unique
	public function edit_subscription_plan_unique()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		if($val!=$oldmname)
		{
		$res = $this->Setting_model->subscription_plan_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
		}
		else
		{
			echo 0;
		}
	}

	//To view the subscription plan view page
	public function subscription_plan_view()
	{
		$id = $this->input->post('id');
		$res['plan'] = $this->Setting_model->subscription_plan_by_id($id);
		$res['pro'] = $this->Setting_model->get_product_package_by_id($res['plan'][0]['product']);
		$this->load->view('settings/subscription/subscription_view',$res);

	}

	//To Update subscription plan
	public function subscription_plan_update()
	{
		$data['id'] = $this->input->post('id');
		$data['pro'] = $this->input->post('product');
		$data['name'] = $this->input->post('name');
		$data['option'] = "deliver";
		$data['duration'] = $this->input->post('duration');
		$data['no_days_type'] = $this->input->post('no_days_type');
		$data['no_of_delivers'] = $this->input->post('no_of_delivers');
		$data['tax'] = $this->input->post('tax');
		$data['amount'] = $this->input->post('amount');
		$data['minium_amount'] = $this->input->post('minium_amount');
		$data['discount'] = $this->input->post('discount');
		$data['days'] = implode(',',$this->input->post('days'));
		$data['modifiedon'] = date('Y-m-d H:i:s');
		$this->Setting_model->subscription_plan_update($data);


		$this->session->set_flashdata('subscription_update', 'Subscription Plan has been updated successfully.');
	    redirect('/settings/subscription_plan');
	}

	//To Delete Subscription plan
	public function subscription_plan_delete()
	{
		$id = $this->input->post('subscription');
		$result = $this->Setting_model->subscription_plan_delete($id);
		if($result){
    		$this->session->set_flashdata('del_success', 'Subscription Plan has been deleted successfully.');
    	}
    	else{
    		$this->session->set_flashdata('del_error', 'Subscription Plan has been deleted successfully.');
    	}
    	redirect('/settings/subscription_plan');
	}
	/********************************************************************************************
                            Purpose : To handle product Function
    *****************************************************************************************/
    //To Get product product package list
    public function product_list()
	{
		$data['package'] = $this->Setting_model->product_package_list();
		$this->load->view('settings/product/product_list',$data);
	}

	//To active and inactive product status
	public function product_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->product_package_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('product_err', 'Subscription Plan Type has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('product_success', 'Subscription Plan Type has been activated successfully.');
    	}
    	echo 1;
	}

	//To Load product add page
	public function product_add_page()
	{
		$data['dish'] = $this->Setting_model->get_all_dish_type();
		$data['meal_time_lists'] = $this->Setting_model->meal_time_list();
		$this->load->view('settings/product/product_add', $data);
	}

	//To Check property package unique
	public function product_unique()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->product_package_unique($val);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To Check property package unique
	public function product_unique_edit()
	{
		$val = $this->input->post('value');
		$p_id = $this->input->post('p_id');
		$res = $this->Setting_model->product_package_unique_edit($val, $p_id);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To insert product 
	public function product_add()
	{

		$data['name'] = $this->input->post('name');
		$data['amount'] = '';
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['status'] = 0;

		
		$data['delivery_start_time'] = $this->input->post('delivery_start_time');
		$data['delivery_end_time'] = $this->input->post('delivery_end_time');
		$data['return_start_time'] = $this->input->post('return_start_time');
		$data['return_end_time']   = $this->input->post('return_end_time');

		$data['last_ordered_time']   = '';
		$data['trip_sheet_end_time'] = '';
		$data['product_color'] = $this->input->post('lcolor'); 
		$data['preparation_time'] = $this->input->post('preparation_time');
		$data['meal_time'] = $this->input->post('meal_time');
		
		if(!empty($_FILES['p_image']['name']))
		{ 
	        $ext = pathinfo($_FILES['p_image']['name'], PATHINFO_EXTENSION);
	        
	        $config['upload_path'] = 'assets/images/product_image';
	        $config['allowed_types'] = 'jpg|jpeg|png|gif';
	        $randNum = rand();
	        $product_code = str_replace(' ', '_', $this->input->post('name'));

	        $config['file_name'] = $product_code;

	        $this->load->library('upload',$config);
	        $this->upload->initialize($config);
	        if($this->upload->do_upload('p_image'))
	        {
	          $uploadData = $this->upload->data();

	          $data['p_image'] = $product_code.'.'.$ext;

	         }else{
	          $data['p_image'] = '';
	        }
	    }else{
	        $data['p_image'] = '';
	    }

		$result = $this->Setting_model->product_package_add($data);
		$last_id = $result[0]->AUTO_INCREMENT;

		$ptype = $this->input->post('ptype');
		$pcount = $this->input->post('pcount');
		
			for($i=0;$i<count($ptype);$i++)
			{
				$data['id'] = $last_id;
				$data['ptype'] = $ptype[$i];
				$data['pcount'] = 1;
				$data['status'] = 0;
		    	$data['modified_on'] = date('Y-m-d H:i:s');

		    	$result = $this->Setting_model->product_scheme_add($data);	
	       	}

		$this->session->set_flashdata('product_success', 'Subscription Plan Type has been added successfully.');
	    redirect('/Settings/product_list');
	}

	//To get Property and load property edit page
	public function edit_product_page()
	{
		$id = $this->input->post('id');
		$res['meal_time_lists'] = $this->Setting_model->meal_time_list();
		$res['package'] = $this->Setting_model->product_package_by_id($id);
		$res['scheme'] = $this->Setting_model->product_scheme_by_id($id);
		$res['dish'] = $this->Setting_model->get_all_dish_type();
		$this->load->view('settings/product/product_edit',$res);
	}

	//To Update product and product scheme
	public function product_update()
	{
		$data['name'] = $this->input->post('name');
		$data['amount'] = '';
		$data['modified_on'] = date('Y-m-d H:i:s');

		$data['delivery_start_time'] = $this->input->post('delivery_start_time');
		$data['delivery_end_time'] = $this->input->post('delivery_end_time');
		$data['return_start_time'] = $this->input->post('return_start_time');
		$data['return_end_time']   = $this->input->post('return_end_time');

		$data['last_ordered_time']   = '';
		$data['trip_sheet_end_time'] = '';
		$data['preparation_time'] = $this->input->post('preparation_time');
		$data['meal_time'] = $this->input->post('meal_time');
		$data['product_color'] = $this->input->post('lcolor'); 
		
		$data['p_image'] = '';
		$old_p_image = $this->input->post('old_p_image'); 

		if($_FILES['p_image']['name'] != '')
		{ 
           $unlink_image = 'assets/images/product_image/'.$old_product_image;
           unlink($unlink_image);

          $ext = pathinfo($_FILES['p_image']['name'], PATHINFO_EXTENSION);
          
          $config['upload_path'] = 'assets/images/product_image';
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
         
          $product_code = str_replace(' ', '_', $this->input->post('name'));
          $config['file_name'] = $product_code;

          $this->load->library('upload',$config);
          $this->upload->initialize($config);
          if($this->upload->do_upload('p_image')){
            $uploadData = $this->upload->data();

            $data['p_image'] = $product_code.'.'.$ext;
            }else{
            $data['p_image'] = $old_p_image;
            }
        }else{
          $data['p_image'] = $old_p_image;
        }


		$id = $this->input->post('id');
		$this->Setting_model->product_package_update($data,$id);

		$ptype = $this->input->post('ptype');
		$pcount = 1;
		$delid = $this->input->post('delid');
		$sid = $this->input->post('sid');
		$subprop = explode('_', $delid);

		for ($i=0; $i < count($subprop); $i++) 
		{ 	if($i!=0)
			{
				$this->Setting_model->product_scheme_delete($subprop[$i]);
			}
		}
	
		for($i=0;$i<count($ptype);$i++)
		{
		    
			$pack_id = $sid[$i];
			$data['ptype'] = $ptype[$i];
			$data['pcount'] = 1;
		    $data['modified_on'] = date('Y-m-d H:i:s');
		   
		    if($pack_id != "")
		    {
		    	$this->Setting_model->product_scheme_update($data,$pack_id);
			}
			else if($pack_id == '')
			{
				$data1['id'] = $id;
				$data1['ptype'] = $ptype[$i];
				$data1['pcount'] = 1;
				$data1['status'] = 0;
		    	$data1['modified_on'] = date('Y-m-d H:i:s');
				$result = $this->Setting_model->product_scheme_add($data1);
			}else{ }
		}
		$this->session->set_flashdata('product_success', 'Subscription Plan Type has been updated successfully.');
	    redirect('/product');
	}

	//To Delete Product package and product scheme
	public function product_delete()
	{
		$id = $this->input->post('package');
		// To check package is in plan
		$check_package_plan = $this->Setting_model->product_package_in_plan($id);
		if($check_package_plan)
		{
			$this->session->set_flashdata('product_err', 'Could not delete subscription plan type. Subscription Plan Type is mapped with other modules!');	
		}else{
			$result = $this->Setting_model->product_package_delete($id);

			$this->Setting_model->product_scheme_delete_by_package_id($id);

			if($result){
	    		$this->session->set_flashdata('product_success', 'Subscription Plan Type has been deleted successfully.');
	    	}
	    	else{
	    		$this->session->set_flashdata('product_err', 'Could not delete subscription plan type !');
	    	}
		}

    	redirect('/product');
	}
	/* ************************************************************************************
						Purpose : To handle KYC Settings Functions
	        **********************************************************************/


	//To Get KYC settings and View KYC list page
	public function kyc_settings()
	{
		$data['kyc'] = $this->Setting_model->get_kyc_settings();
		$this->load->view('settings/kyc/kyc_list',$data);
	}		

	//To Active and Inactive KYC Status
	public function kyc_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->kyc_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('kyc_inactive', 'KYC has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('kyc_active', 'KYC has been activated successfully.');
    	}
    	echo 1;
	}	

	//To Load The KYC settings Add Page
	public function kyc_settings_add_page()
	{
		$this->load->view('settings/kyc/kyc_add');
	}	

	//To Check KYC Name Unique
	public function unique_kyc_name()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->kyc_name_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
	}

	//To Insert The KYC Settings
	public function kyc_add()
	{
		$data['kyc_name'] = $this->input->post('kyc_name');
		$data['mon'] = date('Y-m-d H:i:s');
		$data['status'] = 0;

		$result = $this->Setting_model->kyc_add($data);

		$this->session->set_flashdata('kyc_success', 'KYC has been added successfully.');
	    redirect('Settings/kyc_settings');
	}

	//To get KYC settings And Load the KYC edit Page
	public function edit_kyc_page()
	{
		$id = $this->input->post('value');
		$res['kyc'] = $this->Setting_model->kyc_by_id($id);
		if($res['kyc']){ echo $res['kyc'][0]['id'].'|'.$res['kyc'][0]['kyc_name']; }else{ echo ''; }
	}
	
	//To Check KYC Name Unique
	public function edit_unique_kyc_name()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		if($val!=$oldmname)
		{
		$res = $this->Setting_model->kyc_name_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
		}
		else
		{
			echo 0;
		}
	}

	//To Update KYC Settings
	public function kyc_update()
	{
		$data['id'] = $this->input->post('id');
		$data['kycname'] = $this->input->post('kyc_name');
		$data['mon'] = date('Y-m-d H:i:s');
		$this->Setting_model->kyc_update($data);

		$this->session->set_flashdata('kyc_update', 'KYC has been updated successfully.');
	    redirect('Settings/kyc_settings');
	}

	//To Delete KYC Settings
	public function kyc_delete()
	{
		$id = $this->input->post('delkyc');
		$result = $this->Setting_model->kyc_delete($id);
		if($result){
    		$this->session->set_flashdata('del_success', 'KYC has been deleted successfully.');
    	}
    	else{
    		$this->session->set_flashdata('del_error', 'KYC has been deleted successfully.');
    	}
    	redirect('Settings/kyc_settings');
	}
	/* ************************************************************************************
						Purpose : To handle Relevant Industry Functions
	        **********************************************************************/


	//To Get Relevant Industry And load Relevant Industry List page
	public function relevant_industry()
	{
		$data['ri'] = $this->Setting_model->get_all_relevant_industry();
		$this->load->view('settings/relevant_industry/ri_list',$data);
	}

	//To Active and Inactive the Relevant Industry Status
	public function relevant_industry_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->relevant_industry_active($data,$id);
    	if($data==1){
	    	$this->session->set_flashdata('ri_inactive', 'Relevant Industry has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('ri_active', 'Relevant Industry has been activated successfully.');
    	}
    	echo 1;
	}

	//To Load Relevant Industry Add Page
	public function relevant_industry_add_page()
	{
		$this->load->view('settings/relevant_industry/ri_add');
	}	

	//To Check Relevant Industry Unique
	public function unique_relevant_industry()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->relevant_industry_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
	}

	//To Insert Relevant Industry Details
	public function relevant_industry_add()
	{
		$data['ri_name'] = $this->input->post('ri_name');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['status'] = 0;

		$result = $this->Setting_model->relevant_industry_add($data);

		$this->session->set_flashdata('ri_success', 'Relevant Industry has been added successfully.');
	    redirect('/settings/relevant_industry');
	}

	//To Get Relevant Industry and Load Relevant Industry Edit page
	public function edit_relevant_industry_page()
	{
		$id = $this->input->post('value');
		$res['ri'] = $this->Setting_model->relevant_industry_by_id($id);
		if($res['ri']){ echo $res['ri'][0]['id'].'|'.$res['ri'][0]['relevant_industry']; }else{ echo ''; }
	}

	//To Check Relevant Industry Unique
	public function edit_unique_relevant_industry()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		if($val!=$oldmname)
		{
		$res = $this->Setting_model->relevant_industry_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
		}
		else
		{
			echo 0;
		}
	}

	//To Update Relevant Industry
	public function relevant_industry_update()
	{
		$data['id'] = $this->input->post('id');
		$data['riname'] = $this->input->post('ri_name');
		$data['mon'] = date('Y-m-d H:i:s');
		$this->Setting_model->relevant_industry_update($data);

		$this->session->set_flashdata('ri_update', 'Relevant Industry has been updated successfully.');
	    redirect('/settings/relevant_industry');
	}

	//To Delete Relevant Industry
	public function relevant_industry_delete()
	{
		$id = $this->input->post('ri');
		$result = $this->Setting_model->relevant_industry_delete($id);
		if($result){
    		$this->session->set_flashdata('del_success', 'Relevant Industry has been deleted successfully.');
    	}
    	else{
    		$this->session->set_flashdata('del_error', 'Relevant Industry has been deleted successfully.');
    	}
    	redirect('/settings/relevant_industry');
	}

	/* ************************************************************************************
						Purpose : To handle area Functions
	        **********************************************************************/
	// To list area
	public function area_list()
	{
		$data['area_lists']  = $this->Setting_model->area_list_all();
		$this->load->view('settings/area/area_list', $data);
	}	
	//To Load area Add Page
	public function area_add_page()
	{
		$data['district_lists'] = $this->Setting_model->district_list(35);
		$this->load->view('settings/area/area_add', $data);
	}	
	// To add area 
	public function area_add()
	{
	    $area_name = get_city_name($this->input->post('dist_name')); 
		$data['area_name'] = $area_name->name.' - '.$this->input->post('area_name');
		$data['dist_name'] = $this->input->post('dist_name');
		
		$data['mon'] = date('Y-m-d H:i:s');		
		$this->Setting_model->area_area($data);
		$this->session->set_flashdata('a_success', 'Area has been added successfully.');
	    redirect('/lead-area');
	}
	//To Check area Name Unique
	public function area_unique()
	{
		$val = $this->input->post('val');
		$dist_name = $this->input->post('dist_name');
		$res = $this->Setting_model->area_unique($val, $dist_name);
		if($res){ echo 1; }else{ echo 0; }
	}	
	//To active and inactive subproperty status
	public function area_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->area_active($id,$data);
    	echo 1;
    	
	} 
	//To get area edit page
	public function area_edit_page()
	{
		$id = $this->input->post('id');
		$data['district_lists'] = $this->Setting_model->district_list(35);
		$data['area_edit'] = $this->Setting_model->area_by_id($id);

		$this->load->view('settings/area/area_edit', $data);
	}
   //To Check area Name Unique edit
	public function area_unique_edit()
	{
		$val = $this->input->post('val');
		$a_id = $this->input->post('a_id');
		$d_name = $this->input->post('d_name');

		$res = $this->Setting_model->area_unique_edit($val, $d_name, $a_id);
		if($res){ echo 1; }else{ echo 0; }
	}	
	// To update area_update
	public function area_update()
	{
		$data['aid'] = $this->input->post('a_id');
		$data['dist_name'] = $this->input->post('dist_name');
		
		$area_name = get_city_name($this->input->post('dist_name')); 
		$data['area_name'] = $area_name->name.' - '.$this->input->post('area_name');
		$data['mon'] = date('Y-m-d H:i:s');		
		$this->Setting_model->area_update($data);

		$this->session->set_flashdata('a_success', 'Area has been updated successfully.');
	    redirect('/lead-area');
	}

	// To update area_update
	public function area_delete()
	{
		$area_id = $this->input->post('area_id');
		// To check area in lead
		$check_l_area = $this->Setting_model->area_in_lead($area_id);

		// To check area in customer
		$check_c_area = $this->Setting_model->area_in_customer($area_id);
		if(empty($check_l_area) && empty($check_c_area))
		{
			$data = 2;
			$result = $this->Setting_model->area_active($area_id,$data);

			$this->session->set_flashdata('a_success', 'Area has been deleted successfully.');	
		}else{
			$this->session->set_flashdata('a_err', 'Could not delete area. Area is mapped with other modules!.');	
		}
	    redirect('/lead-area');
	}
	/* ************************************************************************************
						Purpose : To handle Holiday Event Functions
	        **********************************************************************/

	// To list holiday
	public function holiday_list()
	{
		$data['holiday_lists']  = $this->Setting_model->holiday_list();
		$this->load->view('settings/holiday/holiday_list', $data);
	}	
	//To Load area Add Page
	public function holiday_add_page()
	{
		$this->load->view('settings/holiday/holiday_add');
	}	
	// To save holiday details
	public function holiday_save()
	{
		$data['event_name'] = $this->input->post('event_name');
		$e_date = explode('-', $this->input->post('holiday_date'));

		$start_date = explode('/', $e_date[0]);
		$data['event_start_date'] = trim($start_date[2], ' ').'-'.$start_date[0].'-'.$start_date[1];
		$end_date = explode('/', $e_date[1]);
		$data['event_end_date'] = $end_date[2].'-'.trim($end_date[0], ' ').'-'.$end_date[1];
		$data['modified_on'] = date('Y-m-d H:i:s');
		$result = $this->Setting_model->holiday_add($data);
		if($result){
    		$this->session->set_flashdata('h_success', 'Holiday has been added successfully.');
    	}
    	else{
    		$this->session->set_flashdata('h_err', 'Could not add holiday event!');
    	}
    	redirect('/holiday-list');
	}

	// To change holiday status
	public function holiday_change_status()
	{
		$id= $this->input->post('id');
		$status = $this->input->post('status');
		$result = $this->Setting_model->holiday_change_status($id, $status);
		if($result && $status == 0)
		{
    		$this->session->set_flashdata('h_success', 'Holiday has been activated successfully.');
		}else{
			$this->session->set_flashdata('h_err', 'Holiday has been deactivated successfully.');
		}
	}
	// To delete holiday
	public function holiday_delete()
	{
		$id= $this->input->post('h_day_id');
		$status = 2;
		$result = $this->Setting_model->holiday_change_status($id, $status);
		if($result)
		{
    		$this->session->set_flashdata('h_success', 'Holiday has been deleted successfully.');
		}else{
			$this->session->set_flashdata('h_err', 'Could not delete holiday!');
		}
		redirect('/holiday-list');
	}
	// To show edit page
	public function holiday_edit()
	{
		$id= $this->input->post('id');
		$data['holiday_edit'] = $this->Setting_model->holiday_by_id($id);
		$this->load->view('settings/holiday/holiday_edit', $data);

	}

	// To update holiday
	public function holiday_update()
	{
	
		$data['event_name'] = $this->input->post('event_name');
		$data['holiday_id'] = $this->input->post('h_id');
		$e_date = explode('-', $this->input->post('holiday_date'));

		$start_date = explode('/', $e_date[0]);
		$data['event_start_date'] = trim($start_date[2], ' ').'-'.$start_date[0].'-'.$start_date[1];
		$end_date = explode('/', $e_date[1]);
		$data['event_end_date'] = $end_date[2].'-'.trim($end_date[0], ' ').'-'.$end_date[1];
		$data['modified_on'] = date('Y-m-d H:i:s');
		$result = $this->Setting_model->holiday_update($data);
		if($result){
    		$this->session->set_flashdata('h_success', 'Holiday has been updated successfully.');
    	}
    	else{
    		$this->session->set_flashdata('h_err', 'Could not update holiday event!');
    	}
    	redirect('/holiday-list');
	}

	// To check event name unique
	public function holiday_unique()
	{
		$event_name = $this->input->post('value');
		$result = $this->Setting_model->holiday_unique($event_name);

		if($result)
		{
			echo 1;
		}else{
			echo 0;
		}
	}
	// To check event name unique edit
	public function holiday_unique_edit()
	{
		$event_name = $this->input->post('value');
		$id = $this->input->post('id');
		$result = $this->Setting_model->holiday_unique_edit($event_name, $id);
		if($result)
		{
			echo 1;
		}else{
			echo 0;
		}
	}
	/* ************************************************************************************
						Purpose : To handle SMS & Email Notification
	        **********************************************************************/	
// To list SMS & Email Notification list
public function email_sms_notification_list()
{

	$data['sms_email_lists'] = $this->Setting_model->email_sms_notification_list();
	
	$this->load->view('settings/sms_email_notification', $data);
}	

// To update email status
public function change_email_status()
{
	$id = $this->input->post('id');
	$val = $this->input->post('value');
	$result = $this->Setting_model->change_email_status($id, $val);
	echo 1;

}
// To update email status
public function change_sms_status()
{
	$id = $this->input->post('id');
	$val = $this->input->post('value');
	$result = $this->Setting_model->change_sms_status($id, $val);
	echo 1;

}

/* ************************************************************************************
						Purpose : To handle alergic Food settings
	        **********************************************************************/

// To list alergic food 
public function alergic_food_list()
{
	$data['alergic_food_lists'] = $this->Setting_model->alergic_food_list();
	$this->load->view('settings/alergic_food/alergic_food_list', $data);
}

// To check alergic food is unique
public function alergic_food_unique()
{
	$value  = $this->input->post('value');
	$result = $this->Setting_model->alergic_food_unique($value);
	if($result)
	{
		echo 1;
	}else {
		echo 0;
	}

}
// To add alergic food
public function alergic_food_add()
{
	$data['alergic_foods_name'] = $this->input->post('alg_food_name');
	$data['modified_on'] = date('Y-m-d H:i:s');
	$result = $this->Setting_model->alergic_food_add($data);

	if($result)
	{
		$this->session->set_flashdata('algf_success', 'Allergic/ Not Preferred Food has been added successfully.');
	}else{
		$this->session->set_flashdata('algf_err', 'Could not add Allergic/ Not Preferred Food!');
	}

	redirect('/alergic-foods');
}

// To change alergic food status
 public function alergic_food_change_status()
 {
 	$id = $this->input->post('id');
 	$status = $this->input->post('status');
 	$result = $this->Setting_model->alergic_food_change_status($id, $status);
 
 	echo 1;
 }

// To delete alergic food
 public function alergic_food_delete()
 {
 	$id = $this->input->post('alg_food_id');
 	$result = $this->Setting_model->alergic_food_change_status($id, 2);

 	$this->session->set_flashdata('algf_success', 'Allergic/ Not Preferred Food has been deleted successfully.');
 	redirect('/alergic-foods');
 }
 // To show edit page
public function alergic_food_edit()
{
	$id= $this->input->post('value');
	$data['alergic_food_edit'] = $this->Setting_model->alergic_food_edit($id);
	$this->load->view('settings/alergic_food/alergic_food_edit', $data);

}

// To update alergic food
public function alergic_food_update()
{

	$data['id'] = $this->input->post('e_alg_food_id');
	$data['alg_food_name'] = $this->input->post('alg_food_name');
	$data['modified_on'] = date('Y-m-d H:i:s');
	$result = $this->Setting_model->alergic_food_update($data);
	
	if($result){
		$this->session->set_flashdata('algf_success', 'Allergic/ Not Preferred Food has been updated successfully.');
	}
	else{
		$this->session->set_flashdata('algf_err', 'Could not delete subproperty. Subproperty is mapped with other modules!');
	}
	redirect('/alergic-foods');
}
 
// To check alergic food update
public function alergic_food_unique_edit()
{
	$value  = $this->input->post('value');
	$alg_food_id  = $this->input->post('alg_food_id');
	$result = $this->Setting_model->alergic_food_unique_edit($value, $alg_food_id);
	if($result)
	{
		echo 1;
	}else {
		echo 0;
	}

}

/*****************************************************************************************/
			// To handle Meal time Functions
/*****************************************************************************************/

// To list meal times
public function meal_time_list()
{
	$data['meal_time_lists'] = $this->Setting_model->meal_time_list();
	$this->load->view('settings/meal_time/meal_time_list', $data);
}

// To show meal time add  page
public function meal_time_add()
{
	$this->load->view('settings/meal_time/meal_time_add');
}

// To save meal time details
public function meal_time_save()
{
	$data['meal_time_name'] = $this->input->post('meal_time_name');
	$data['trip_sheet_end_time'] = $this->input->post('trip_sheet_end_time');
	$data['modified_on'] = date('Y-m-d H:i:s');
	$result = $this->Setting_model->meal_time_save($data);

	if($result)
	{
		$this->session->set_flashdata('mt_success', 'Meal Time has been added successfully.');
	}else{

		$this->session->set_flashdata('mt_err', 'Could not add meal time!');
	}

	redirect('meal-time-list');
}

// To check meal_time_unique
public function meal_time_unique()
{
	$meal_time_name = $this->input->post('value');
	
	$result = $this->Setting_model->meal_time_unique($meal_time_name);
	if($result)
	{
		echo 1;
	}else{
		echo 0;
	}
}

// To change the status for meal time
public function meal_time_change_status()
{
	$id = $this->input->post('id');
 	$status = $this->input->post('status');
 	$result = $this->Setting_model->meal_time_change_status($id, $status);
 	echo 1;

}

// To get meal time edit page
public function meal_time_edit()
{
	$id= $this->input->post('id');
	$data['meal_time_edit'] = $this->Setting_model->meal_time_by_id($id);
	$this->load->view('settings/meal_time/meal_time_edit', $data);
}

// To check meal time exits for another id
public function meal_time_edit_unique()
{
	$mt_id= $this->input->post('mt_id');
	$value= $this->input->post('value');
	$result = $this->Setting_model->meal_time_edit_unique($mt_id, $value);
	if($result)
	{
		echo 1;
	}else{
		echo 0;
	}
}
// To update meal time
public function meal_time_update()
{
	$data['meal_time_name'] = $this->input->post('meal_time_name');
	$data['trip_sheet_end_time'] = $this->input->post('trip_sheet_end_time');
	$data['modified_on'] = date('Y-m-d H:i:s');
	$data['meal_time_id'] = $this->input->post('meal_time_id');
	$result = $this->Setting_model->meal_time_update($data);

	if($result)
	{
		$this->session->set_flashdata('mt_success', 'Meal Time has been updated successfully.');
	}else{

		$this->session->set_flashdata('mt_err', 'Meal Time has been updated successfully.');
	}

	redirect('meal-time-list');
}
// To delete meal time
public function meal_time_delete()
{
	$id = $this->input->post('mt_id'); 

	// To check meal id mapped with subscription type
	$check_mt_prod = $this->Setting_model->meal_time_exits_product_package($id);
	if($check_mt_prod)
	{
		$this->session->set_flashdata('mt_err', 'Meal Time is mapped with other modules.');
	}
	else{

		$result = $this->Setting_model->meal_time_change_status($id, 2);
		$this->session->set_flashdata('mt_success', 'Meal Time has been deleted successfully.');
	}
	redirect('meal-time-list');
}	
/*****************************************************************************************/
			// To handle Carry Bag Functions
/*****************************************************************************************/

// To list carry bag details
public function carry_bag_list()
{
	$data['carry_bag_lists'] = $this->Setting_model->carry_bag_list();
	$this->load->view('settings/carry_bag/carry_bag_list', $data);
}
// To change the status for carry bag
public function carry_bag_change_status()
{
	$id = $this->input->post('id');
 	$status = $this->input->post('status');
 	$result = $this->Setting_model->carry_bag_change_status($id, $status);
 	echo 1;
}

// To get carry bag prefix
public function carry_bag_prefix()
{
	$id= $this->input->post('id');
	$b_type_details = $this->Setting_model->bag_type_by_id($id);
	if(!empty($b_type_details) && $b_type_details[0]['bag_prefix'] != '')
	{
		$bag_prefix = $b_type_details[0]['bag_prefix'];
	}
	else{
		$bag_prefix = '';
	}
	echo $bag_prefix;
}


// To get carry bag edit page
public function carry_bag_edit()
{
	$id= $this->input->post('id');
	$data['carry_bag_edit'] = $this->Setting_model->carry_bag_by_id($id);
	$data['bag_lists'] = $this->Setting_model->bag_type_list();
	$this->load->view('settings/carry_bag/carry_bag_edit', $data);
}
// To show carry bag add  page
public function carry_bag_add()
{
	$data['bag_lists'] = $this->Setting_model->bag_type_list();
	$this->load->view('settings/carry_bag/carry_bag_add', $data);
}

// To save carry bag details
public function carry_bag_save()
{


	$data['bag_type'] = $this->input->post('bag_type_id');
	$bag_prefix = $this->input->post('bag_prefix');
	$carry_bag_count = $this->input->post('carry_bag_count');
	// To get bag last count
	$get_last_bag_id = $this->Setting_model->carry_bag_last_id();
	$bag_name = '';
	$last_id = 0;
	if($carry_bag_count > 0)
	{
		if(!empty($get_last_bag_id) && $get_last_bag_id->carry_bag_id > 0)
		{
			$last_id = $get_last_bag_id->carry_bag_id;
		}
		else{ $last_id = 0; }

		for($i=1; $i<= $carry_bag_count; $i++)
		{

			$bag_name = $bag_prefix.($last_id+$i);

			$data['carry_bag_name'] = $bag_name;
			$data['modified_on'] = date('Y-m-d H:i:s');
		    $result = $this->Setting_model->carry_bag_save($data);

		}
	}
	if($result)
	{
		$this->session->set_flashdata('cb_success', 'Carry Bag has been added successfully.');
	}else{

		$this->session->set_flashdata('cb_err', 'Could not add carry bag!');
	}

	redirect('carry-bag-list');
}

// To update carry bag
public function carry_bag_update()
{
	$data['carry_bag_name'] = $this->input->post('carry_bag_name');
	$data['bag_type'] = $this->input->post('bag_type_id');
	$data['modified_on'] = date('Y-m-d H:i:s');
	$data['carry_bag_id'] = $this->input->post('carry_bag_id');
	$result = $this->Setting_model->carry_bag_update($data);

	if($result)
	{
		$this->session->set_flashdata('cb_success', 'Carry Bag has been updated successfully.');
	}else{

		$this->session->set_flashdata('cb_err', 'Carry Bag has been updated successfully.');
	}

	redirect('carry-bag-list');
}
// To check  carry bag name unique
public function carry_bag_unique()
{
	$carry_bag_name = $this->input->post('value');
	
	$result = $this->Setting_model->carry_bag_unique($carry_bag_name);
	if($result)
	{
		echo 1;
	}else{
		echo 0;
	}
}
// To check carry bag exits for another id
public function carry_bag_edit_unique()
{
	$cb_id= $this->input->post('cb_id');
	$value= $this->input->post('value');
	$result = $this->Setting_model->carry_bag_edit_unique($cb_id, $value);
	if($result)
	{
		echo 1;
	}else{
		echo 0;
	}
}
// To delete carry bag
public function carry_bag_delete()
{
	$id = $this->input->post('cb_id'); 
	$bag_reason = $this->input->post('bag_reason'); 
	// To check carry bag id mapped with biker table
	$check_cb_prod = $this->Setting_model->carry_bag_exits_in_biker($id);


	if($check_cb_prod)
	{

		$this->session->set_flashdata('cb_err', 'Carry bag is mapped with other modules.');
	}
	else{

		$m_on = date('Y-m-d H:i:s');
		$result = $this->Setting_model->carry_bag_delete($id, 2, $bag_reason, $m_on);
		$this->session->set_flashdata('cb_success', 'Carry Bag has been deleted successfully.');
	}
	redirect('carry-bag-list');
}	
/********************************************************************************************
                            Purpose : To handle Bag Type Settings
    *****************************************************************************************/


    //To Get bag type settings and load bag type list page
    public function bag_type_settings()
	{
		$data['bag'] = $this->Setting_model->bag_type_list();
		$data['meal_time_lists'] = $this->Setting_model->meal_time_active_list();
		$data['product_lists'] = $this->Setting_model->product_package_list();

		$this->load->view('settings/bag_type/bag_type_list',$data);
	}    



	//To active and inactive bag type settings
	public function bag_type_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->bag_type_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('bag_err', 'Bag Type has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('bag_success', 'Bag Type has been activated successfully.');
    	}
    	echo 1;
	}  


	//To Check bag type name unique
	public function unique_bag_type_name()
	{
		$val = $this->input->post('val');
		$res = $this->Setting_model->unique_bag_type_name($val);

		if($res){ echo 1; }else{ echo 0; }
	}   


	//To insert  bag type
	public function bag_type_add()
	{	

		$data['meal_time_id'] = implode(',', $this->input->post('m_time'));

		$b_limit = '';
		$prd_ids = $this->input->post('prd_id');
		if(!empty($prd_ids))
		{	
			
			$bcapacity = $this->input->post('bcapacity');
			$limit = 0;
			foreach ($prd_ids as $key => $prd_id) {

				$limit = ($bcapacity[$key]) ? $bcapacity[$key] : 0;
				$b_limit .= $prd_id.'-'.$limit.',';
			}
		}
		$data['bname'] = $this->input->post('bname');
		$data['bcapacity'] = trim($b_limit, ',');
		$data['bag_prefix'] = $this->input->post('bag_prefix');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['status'] = 0;
		$result = $this->Setting_model->bag_type_add($data);
		$this->session->set_flashdata('bag_success', 'Bag Type has been added successfully.');

	    redirect('bag-type-list');
	} 

	//To get bag type and load bag type edit page
	public function bag_type_edit()
	{
		$id = $this->input->post('id');
		$data['bag'] = $this->Setting_model->bag_type_by_id($id);
	
		$data['meal_time_lists'] = $this->Setting_model->meal_time_active_list();
		$data['product_lists'] = $this->Setting_model->product_package_list();

		$this->load->view('settings/bag_type/bag_type_edit',$data);
	}


	//To Check bag type name Unique for edit page
	public function edit_unique_bag_type()
	{


		$val = $this->input->post('val');
		$b_id = $this->input->post('id');

		$res = $this->Setting_model->bag_type_unique_edit($val, $b_id);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To Update bag type
	public function bag_type_update()
	{

	
		$data['id'] = $this->input->post('id');
		$data['bname'] = $this->input->post('bname');
		
		$data['bag_prefix'] = $this->input->post('bag_prefix');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['meal_time_id'] = implode(',', $this->input->post('m_time'));

		$b_limit = '';
		$prd_ids = $this->input->post('prd_id');
		if(!empty($prd_ids))
		{	
			
			$bcapacity = $this->input->post('bcapacity');
			$limit = 0;
			foreach ($prd_ids as $key => $prd_id) {

				$limit = ($bcapacity[$key]) ? $bcapacity[$key] : 0;
				$b_limit .= $prd_id.'-'.$limit.',';
			}
		}
		$data['bcapacity'] = trim($b_limit, ',');

		$this->Setting_model->bag_type_update($data);
		$this->session->set_flashdata('bag_success', 'Bag Type has been updated successfully.');
	    redirect('bag-type-list');
	}

	//To Delete bag type
	public function bag_type_delete()
	{
		$id = $this->input->post('bag');

		$res = $this->Setting_model->check_bag_type_used($id);
		if(count($res) > 0)
		{
			$this->session->set_flashdata('bag_err', 'Bag Type is Mapped With Other Moduls');
			redirect('bag-type-list');
		}
		else
		{
			$data = 2;
			$result = $this->Setting_model->bag_type_delete($data,$id);
			$this->session->set_flashdata('bag_success', 'Bag Type has been deleted successfully.');
			redirect('bag-type-list');
		}

		
	}
// To get meal base product id
public function meal_time_base_product()
{
	$m_time_id = $this->input->post('m_time_id');
	$product_details = $this->Setting_model->meal_time_base_product($m_time_id);

	$p_list = '';
	if(!empty($product_details))
	{
		$i = 1;
		$p_list .='<div class="row">
				<div class="col-lg-6">
					<label>Subscription Type</label>
				</div>
				<div class="col-lg-6">
					<label>Bag Capacity</label>
				</div>
			</div>';
		
		foreach ($product_details as $key => $product_detail) {
			
			$p_list .= '<div class="row">';
			$p_list .= '<div class="col-lg-6">
						<div class="form-group m-form__group">';
			$p_list .= '<input type="hidden" name="prd_id[]" id="prd_id"  placeholder="" value="'.$product_detail->product_package_id.'">';

			$p_list .= '<input type="text" class="form-control m-input m-input--square" placeholder="" value="'.$product_detail->product_package_name.'" readonly style="background-color: #f1f1f1;">';
			$p_list .= '</div></div>';

			$p_list .= '<div class="col-lg-6">
				<div class="form-group m-form__group">
					<input type="text" class="form-control m-input m-input--square" placeholder="Enter Bag Capacity"  name="bcapacity[]" id="bcapacity'.$i.'"  autocomplete="off" onkeypress="return eisNumber(event,'."'bcapacity_err".$i."'".');">
					<span id="bcapacity_err'.$i.'" style="color:red"></span>
				</div>
			</div>';
			$p_list .= '</div>';

		$i++; }
	}

	echo $p_list;
}	
// To get meal base product id
public function meal_time_base_product_edit()
{
	$m_time_id = $this->input->post('m_time_id');
	$id = $this->input->post('id');
	$bag_details = $this->Setting_model->bag_type_by_id($id);

	$prd_limit = ($bag_details[0]['bag_capacity']) ? explode(',', $bag_details[0]['bag_capacity']) : '';
	$product_details = $this->Setting_model->meal_time_base_product($m_time_id);

	$p_list = '';
	if(!empty($product_details))
	{
		$i = 1;
		$p_list .='<div class="row">
				<div class="col-lg-6">
					<label>Subscription Type</label>
				</div>
				<div class="col-lg-6">
					<label>Bag Capacity</label>
				</div>
			</div>';
		
		foreach ($product_details as $key => $product_detail) {
			
			$p_list .= '<div class="row">';
			$p_list .= '<div class="col-lg-6">
						<div class="form-group m-form__group">';
			$p_list .= '<input type="hidden" name="prd_id[]" id="prd_id"  placeholder="" value="'.$product_detail->product_package_id.'">';

			$p_list .= '<input type="text" class="form-control m-input m-input--square" placeholder="" value="'.$product_detail->product_package_name.'" readonly style="background-color: #f1f1f1;">';
			$p_list .= '</div></div>';

			if(!empty($prd_limit))
			{
				foreach ($prd_limit as $key => $p_limit) {

					$prd_id = '';
					$prd_val = '';
					$prd_id = ($p_limit) ? explode('-', $p_limit) : '';

					if($prd_id[0] == $product_detail->product_package_id)
					{
						$prd_val = 	$prd_id[1];
					}
					else{
						$prd_val = '';
					}
					$p_list .= '<div class="col-lg-6">
					<div class="form-group m-form__group">
						<input type="text" class="form-control m-input m-input--square" placeholder="Enter Bag Capacity"  name="bcapacity[]" id="bcapacity'.$i.'"  autocomplete="off" onkeypress="return isNumber(event,'."'bcapacity_err".$i."'".');" value="'.$prd_val.'">
						<span id="bcapacity_err'.$i.'" style="color:red"></span>
					</div>
				</div>';
				}
			}

			
			$p_list .= '</div>';

		$i++; }
	}

	echo $p_list;
}	
/* ************************************************************************************
						Purpose : To handle Payment Settings Functions
	        **********************************************************************/	

	//To get payment gateway details and load payment gateway list page
	public function payment_gateway()
	{
		
		$data['payment'] = $this->Setting_model->payment_gateway_list();
		$this->load->view('settings/payment/paymentgateway_list',$data);
	}

	//To active and inactive payment gateway status
	public function payment_gateway_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->payment_gateway_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('payment_inactive', 'Payment Gatway has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('payment_active', 'Payment Gatway has been activated successfully.');
    	}
    	echo 1;
	}
    
    //To active and inactive payment gateway status
	public function payment_gateway_expense_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->payment_gateway_expense_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('payment_inactive', 'Expense Payment Gatway has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('payment_active', 'Expense Payment Gatway has been activated successfully.');
    	}
    	echo 1;
	}
    
    
	//To Load payment gateway add page
	public function payment_gateway_add_page()
	{
		$data['currency'] = $this->Setting_model->currency_list();
		$data['pgconf'] = $this->Setting_model->pgconfig_list();
		$this->load->view('settings/payment/paymentgateway_add',$data);
	}

	//To check Payment gateway unique
	public function payment_gateway_unique()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->payment_gateway_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
	}

	//To insert Payment gateway
	public function payment_gateway_add()
	{

		$res = general_autpincrement_id();
		$auto_id = $res->auto_increment;

		if(!empty($_FILES['logo']['name']))
		{ 
      		$ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
      		//$name = $last_user.'.'.$ext;
      		$config['upload_path'] = 'assets/images/paymentgateway';
      		$config['allowed_types'] = 'jpg|jpeg|png|gif';
      		$config['file_name'] = $auto_id;
      		$this->load->library('upload',$config);
      		$this->upload->initialize($config);
      		if($this->upload->do_upload('logo'))
      		{
        		$uploadData = $this->upload->data();
        		$data['logo'] = $auto_id.'.'.$ext;
        	}
        	else
        	{
        		$data['logo'] = 'no-image.jpg';
        	}
      	}
      	else
        {
      		$data['logo'] = 'no-image.jpg';
        }

      	$data['paymentgateway'] = $this->input->post('name');

    	$field = implode(",",$this->input->post('fields'));
    	$data['fields']=$field;

    	$curr = implode(",",$this->input->post('currency'));
    	$data['currency']=$curr;

		$result = $this->Setting_model->payment_gateway_add($data);

		$this->session->set_flashdata('payment_success', 'Payment Gateway has been added successfully.');
	    redirect('payment-gateway');
	}

	//To get payment gateway and load payment gatway edit page
	public function edit_payment_gateway_page()
	{
		$id = $this->input->post('id');
		$res['payment'] = $this->Setting_model->get_payment_gateway_by_id($id);
		$res['currency'] = $this->Setting_model->currency_list();
		$res['pgconf'] = $this->Setting_model->pgconfig_list();
		$this->load->view('settings/payment/paymentgateway_edit',$res);
	}

	public function payment_gateway_edit_unique()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		if($val!=$oldmname)
		{
		$res = $this->Setting_model->payment_gateway_unique($val);
		if(COUNT($res) > 0){ echo 1; }else{ echo 0; }
		}
		else
		{
			echo 0;
		}
	}

	public function payment_gateway_update()
	{
		$res = general_autpincrement_id();
		$auto_id = $res->auto_increment;

		$id = $this->input->post('pid');

    	$oldLogo = $_POST['oldlogo'];
    	if(!empty($_FILES['logo']['name']))
		{ 
    		$ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
    		//$name = $last_user.'.'.$ext;
    		$config['upload_path'] = 'assets/images/paymentgateway';
    		$config['allowed_types'] = 'jpg|jpeg|png|gif';
    		$config['file_name'] = $auto_id;
    		$this->load->library('upload',$config);
    		$this->upload->initialize($config);
    		if($oldLogo!='no-image.jpg')
      			unlink('paymentgateway/'.$oldLogo);
    		if($this->upload->do_upload('logo'))
    		{
      			$uploadData = $this->upload->data();
      			$data['logo'] = $auto_id.'.'.$ext;
      		}
      		else
      		{
      			$data['logo'] = 'no-image.jpg';
      		}
    	}
    	else
    	{
    		$data['logo'] = $oldLogo;
    	}

    	$data['id'] = $this->input->post('pid');
    	$data['paymentgateway'] = $this->input->post('name');

    	$field = implode(",",$this->input->post('fields'));
    	$data['fields']=$field;

    	$curr = implode(",",$this->input->post('currency'));
    	$data['currency']=$curr;
		$this->Setting_model->payment_gateway_update($data);

		$this->session->set_flashdata('payment_update', 'Payment Gateway has been updated successfully.');
	    redirect('payment-gateway');
	}

	public function payment_gateway_delete()
	{
		$id = $this->input->post('payment');
		$data = 2;
		$result = $this->Setting_model->payment_gateway_delete($data,$id);
		if($result){
    		$this->session->set_flashdata('del_success', 'Payment Gateway has been deleted successfully.');
    	}
    	else{
    		$this->session->set_flashdata('del_error', 'Payment Gateway has been deleted successfully.');
    	}
    	redirect('/settings/payment_gateway');
	}


/* ************************************************************************************
						Purpose : To handle Payment Gateway Settings Functions
	        **********************************************************************/	

	//To get payment gateway and payment gateway settings details and load payment geteway settings page
	public function payment_gateway_settings()
	{
		$data['payment'] = $this->Setting_model->payment_gateway_settings_list();
		$this->load->view('settings/paymentgateway/pg_list',$data);
	}

	//To active and inactive payment gateway settings
	public function payment_gateway_settings_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->payment_gateway_settings_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('pg_inactive', 'Payment Gatway Settings has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('pg_active', 'Payment Gatway Settings has been activated successfully.');
    	}
    	echo 1;
	}

	//To get payment gateway settings Load payment gateway add page
	public function payment_gateway_settings_add_page()
	{
		$data['pgs'] = $this->Setting_model->get_payment_gateway_settings();
		$this->load->view('settings/paymentgateway/pg_add',$data);
	}

	//To get Required fields for payment gateway settings
	public function get_required_fields()
	{
		$id = $this->input->post('id');
		$data['reqfields'] = $this->Setting_model->get_required_fields($id);
		$this->load->view('settings/paymentgateway/pg_reqfields',$data);
	}

	//To add payment gateway settings
	public function payment_gateway_settings_add()
	{
    	$data['pgsid'] = $this->input->post('pgsid');
    	$data['type'] = $this->input->post('type');

    	if($this->input->post('config')!='')
    	{
      		$conf = implode(",",$this->input->post('config'));
      		$data['config'] = $conf;
    	}
    	//To Check payment gateway already exists
    	$res = $this->Setting_model->payment_gateway_settings_check($data['pgsid']);
    	if(COUNT($res) == 0)
    	{ 
    		$result = $this->Setting_model->payment_gateway_settings_add($data);
    	}
    	else
    	{ 
    		$result1 = $this->Setting_model->get_payment_gateway_settings_by_pgsid($data['pgsid']);
    		$id = $result1[0]['paymentGatewayId'];
    		$result = $this->Setting_model->payment_gateway_settings_update1($data,$id);
    	}

		

		$this->session->set_flashdata('pg_success', 'Payment Gateway Settings has been added successfully.');
	    redirect('/settings/payment_gateway_settings');
	}

	//To get payment gateway and load payment gatway settings edit page
	public function edit_payment_gateway_settings_page()
	{
		$id = $this->input->post('id');
		$res['payment'] = $this->Setting_model->get_payment_gateway_settings_by_id($id);
		$res['pg'] = $this->Setting_model->get_payment_gateway_settings();
		$this->load->view('settings/paymentgateway/pg_edit',$res);
	}

	//To update payment gateway settings update
	public function payment_gateway_settings_update()
	{
		$id = $this->input->post('pid');
    	$data['type'] = $_POST['type'];

    	if($this->input->post('config')!='')
    	{
      		$conf = implode(",",$this->input->post('config'));
      		$data['config'] = $conf;
    	}
    	//echo $data['config'];
		$this->Setting_model->payment_gateway_settings_update($data,$id);

		$this->session->set_flashdata('pg_update', 'Payment Gateway has been updated successfully.');
	    redirect('/settings/payment_gateway_settings');
	}

	//To View the payment gateway settings view page
	public function payment_gateway_settings_view()
	{
		$pid = $this->input->post('id');
		$data['payment'] = $this->Setting_model->get_payment_gateway_settings_for_view($pid);
		$this->load->view('settings/paymentgateway/pg_view',$data);
 	}

 	//To Delete Payment gateway settings
 	public function payment_gateway_settings_delete()
	{
		$id = $this->input->post('payment');
		$data = 2;
		$result = $this->Setting_model->payment_gateway_settings_delete($data,$id);
		if($result){
    		$this->session->set_flashdata('del_success', 'Payment Gateway Settings has been deleted successfully.');
    	}
    	else{
    		$this->session->set_flashdata('del_error', 'Payment Gateway Settings has been deleted successfully.');
    	}
    	redirect('/settings/payment_gateway_settings');
	}


	/********************************************************************************************
                            Purpose : To handle payment gatway config Settings
    *****************************************************************************************/


    //To Get payement gateway config and load list page
    public function pg_config()
	{
		$data['pg'] = $this->Setting_model->pg_config_list();
		$this->load->view('settings/payment/pg_config_list',$data);
	}    



	//To active and inactive payment gateway config settings
	public function pg_config_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->pg_config_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('pg_err', 'Payment Gateway Config has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('pg_success', 'Payment Gateway Config has been activated successfully.');
    	}
    	echo 1;
	}  


	//To Check pg congig name unique
	public function unique_pg_config_name()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->unique_pg_config_name($val);
		if($res){ echo 1; }else{ echo 0; }
	}   


	//To insert pg config add
	public function pg_config_add()
	{
		$data['name'] = $this->input->post('name');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['status'] = 0;
		$result = $this->Setting_model->pg_config_add($data);

		$this->session->set_flashdata('pg_success', 'Payment Gateway Config has been added successfully.');

	    redirect('payment-config');
	} 

	//To get pg config and load pg config edit page
	public function pg_config_edit()
	{
		$id = $this->input->post('id');
		$data['pg'] = $this->Setting_model->pg_config_by_id($id);

		$this->load->view('settings/payment/pg_config_edit',$data);
	}


	//To Check pg config name Unique for edit page
	public function edit_unique_pg_config()
	{
		$val = $this->input->post('value');
		$return_id = $this->input->post('return_id');

		$res = $this->Setting_model->edit_unique_pg_config($val, $return_id);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To Update pg config
	public function pg_config_update()
	{
		$data['id'] = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$this->Setting_model->pg_config_update($data);

		$this->session->set_flashdata('pg_success', 'Payment Gateway Config has been updated successfully.');
	    redirect('payment-config');
	}


	//To Delete pg config
	public function pg_config_delete()
	{
		$id = $this->input->post('pg');

		$res = $this->Setting_model->pg_config_delete($id);
		$this->session->set_flashdata('pg_success', 'Payment Gateway Config has been deleted successfully.');
    	redirect('payment-config');

		
	}
	
	
	
	
	
	
/********************************************************************************************
                            Purpose : To handle Delivery App Admin side settings
    *****************************************************************************************/


/********************************************************************************************
                            Purpose : To handle Return Reason Settings
    *****************************************************************************************/


	//To Get return reason and load retrun reason list
    public function return_reason_list()
	{
		$data['return'] = $this->Setting_model->return_reason_list();
		$this->load->view('settings/reason/return_reason_list',$data);
	}

	//To active and inactive return reason
	public function return_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->return_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('return_err', 'Return Reason has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('return_success', 'Return Reason has been activated successfully.');
    	}
    	echo 1;
	}


	//To Check return reason unique
	public function unique_return_reason()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->unique_return_reason($val);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To insert return reason
	public function return_add()
	{
		$data['return_reason'] = $this->input->post('return_reason');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['status'] = 0;
		$result = $this->Setting_model->return_add($data);

		$this->session->set_flashdata('return_success', 'Return Reason has been added successfully.');

	    redirect('settings/return_reason_list');
	}


	//To get return reason and load return reason edit page
	public function return_edit()
	{
		$id = $this->input->post('id');
		$data['return'] = $this->Setting_model->return_reason_by_id($id);

		$this->load->view('settings/reason/return_edit',$data);
	}


	//To Check return Unique
	public function edit_unique_return()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		$return_id = $this->input->post('return_id');

		$res = $this->Setting_model->return_unique_edit($val, $return_id);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To Update return reason
	public function return_update()
	{
		$data['id'] = $this->input->post('id');
		$data['return_reason'] = $this->input->post('return_reason');

		$data['modified_on'] = date('Y-m-d H:i:s');
		$this->Setting_model->return_update($data);

		$this->session->set_flashdata('return_success', 'Return Reason has been updated successfully.');
	    redirect('settings/return_reason_list');
	}


	//To Delete return reason
	public function return_delete()
	{
		$id = $this->input->post('return');

		
		$data = 2;
		$result = $this->Setting_model->return_delete($data,$id);

		$this->session->set_flashdata('return_success', 'Return Reason has been deleted successfully.');


    	redirect('settings/return_reason_list');
	}





/********************************************************************************************
                            Purpose : To handle outstanding Reason Settings
    *****************************************************************************************/


	//To Get Outstanding reason and load outstanding reason list
    public function outstanding_reason_list()
	{
		$data['os'] = $this->Setting_model->outstanding_reason_list();
		$this->load->view('settings/reason/outstanding_reason_list',$data);
	}

	//To active inactive outstanding reason
	public function outstanding_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->outstanding_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('os_err', 'Outstanding Reason has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('os_success', 'Outstanding Reason has been activated successfully.');
    	}
    	echo 1;
	}


	//To Check outstanding reason unique
	public function unique_outstanding_reason()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->unique_outstanding_reason($val);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To insert outstanding reason
	public function outstanding_add()
	{
		$data['os_reason'] = $this->input->post('os_reason');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['status'] = 0;
		$result = $this->Setting_model->outstanding_add($data);

		$this->session->set_flashdata('os_success', 'outstanding Reason has been added successfully.');

	    redirect('settings/outstanding_reason_list');
	}


	//To get outstanding reason and load outstanding reason edit page
	public function outstanding_edit()
	{
		$id = $this->input->post('id');
		$data['outstanding'] = $this->Setting_model->outstanding_reason_by_id($id);

		$this->load->view('settings/reason/outstanding_edit',$data);
	}


	//To Check outstanding Unique
	public function edit_unique_outstanding()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		$return_id = $this->input->post('return_id');

		$res = $this->Setting_model->outstanding_unique_edit($val, $return_id);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To Update outstanding reason
	public function outstanding_update()
	{
		$data['id'] = $this->input->post('id');
		$data['os_reason'] = $this->input->post('os_reason');

		$data['modified_on'] = date('Y-m-d H:i:s');
		$this->Setting_model->outstanding_update($data);

		$this->session->set_flashdata('os_success', 'Outstanding Reason has been updated successfully.');
	    redirect('settings/outstanding_reason_list');
	}


	//To Delete outstanding reason
	public function outstanding_delete()
	{
		$id = $this->input->post('outstanding');

		
		$data = 2;
		$result = $this->Setting_model->outstanding_delete($data,$id);

		$this->session->set_flashdata('os_success', 'outstanding Reason has been deleted successfully.');


    	redirect('settings/outstanding_reason_list');
	}



/********************************************************************************************
                            Purpose : To handle pickup Reason Settings
    *****************************************************************************************/


	//To Get pickup reason and load pickup reason list
    public function pickup_reason_list()
	{
		$data['pickup'] = $this->Setting_model->pickup_reason_list();
		$this->load->view('settings/reason/pickup_reason_list',$data);
	}

	//To active and inactive pickup reason
	public function pickup_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->pickup_active($id,$data);
    	if($data==1){
	    	$this->session->set_flashdata('pickup_err', 'Pickup Reason has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('pickup_success', 'Pickup Reason has been activated successfully.');
    	}
    	echo 1;
	}


	//To Check pickup reason unique
	public function unique_pickup_reason()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->unique_pickup_reason($val);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To insert  pickup reason
	public function pickup_add()
	{
		$data['pickup_reason'] = $this->input->post('pickup_reason');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['status'] = 0;
		$result = $this->Setting_model->pickup_add($data);

		$this->session->set_flashdata('pickup_success', 'Pickup Reason has been added successfully.');

	    redirect('settings/pickup_reason_list');
	}


	//To get pickup reason and load pickup reason edit page
	public function pickup_edit()
	{
		$id = $this->input->post('id');
		$data['pickup'] = $this->Setting_model->pickup_reason_by_id($id);

		$this->load->view('settings/reason/pickup_edit',$data);
	}


	//To Check pickup Unique for edit page
	public function edit_unique_pickup()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		$return_id = $this->input->post('return_id');

		$res = $this->Setting_model->pickup_unique_edit($val, $return_id);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To Update pickup reason
	public function pickup_update()
	{
		$data['id'] = $this->input->post('id');
		$data['pickup_reason'] = $this->input->post('pickup_reason');

		$data['modified_on'] = date('Y-m-d H:i:s');
		$this->Setting_model->pickup_update($data);

		$this->session->set_flashdata('pickup_success', 'Pickup Reason has been updated successfully.');
	    redirect('settings/pickup_reason_list');
	}


	//To Delete pickup reason
	public function pickup_delete()
	{
		$id = $this->input->post('pickup');

		
		$data = 2;
		$result = $this->Setting_model->pickup_delete($data,$id);

		$this->session->set_flashdata('pickup_success', 'Pickup Reason has been deleted successfully.');


    	redirect('settings/pickup_reason_list');
	}


/********************************************************************************************
                            Purpose : To handle app side menu Reason Settings
    *****************************************************************************************/


	//To Get app side menu reason and load app side menu reason list
    public function app_side_menu_list()
	{
		$data['asm'] = $this->Setting_model->app_side_menu_list();
		$this->load->view('settings/app_side_menu/side_menu',$data);
	}

	//To active and inactive app side menu reason
	public function app_side_menu_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->app_side_menu_active($id,$data);
    	if($data==0){
	    	$this->session->set_flashdata('asm_err', 'Side Menu has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('asm_success', 'Side Menu Reason has been activated successfully.');
    	}
    	echo 1;
	}



/********************************************************************************************
                            Purpose : To handle Delivery App About APF Content Settings
    *****************************************************************************************/


	//To Get about apf content and load list
    public function about_apf_content()
	{
		$data['apf'] = $this->Setting_model->about_apf_content();
		$this->load->view('settings/app_content/about_apf_content',$data);
	}


	//To get about apf and load about apf edit page
	public function about_apf_edit()
	{
		$data['apf'] = $this->Setting_model->about_apf_content();

		$this->load->view('settings/app_content/about_apf_edit',$data);
	}

	//To Update about apf content
	public function about_apf_update()
	{
		$data['apf'] = $this->input->post('apf');
		$this->Setting_model->about_apf_update($data);

		$this->session->set_flashdata('apf_success', 'About APF Content has been updated successfully.');
	    redirect('settings/about_apf_content');
	}

	//To get about apf and load about apf edit page
	public function about_apf_view()
	{
		$data['apf'] = $this->Setting_model->about_apf_content();

		$this->load->view('settings/app_content/about_apf_view',$data);
	}



/********************************************************************************************
          Purpose : To handle Delivery App Roles & Responsibilities APF Content Settings
    *****************************************************************************************/


	//To Get roles and responsibilities apf content and load list
    public function roles_responsibilities_apf()
	{
		$data['apf'] = $this->Setting_model->roles_responsibilities_apf();
		$this->load->view('settings/app_content/roles_responsibilities_apf',$data);
	}


	//To get roles and responsibilities of the APF page and load edit page
	public function roles_apf_edit()
	{
		$data['apf'] = $this->Setting_model->roles_responsibilities_apf();

		$this->load->view('settings/app_content/roles_apf_edit',$data);
	}

	//To Update roles & responsibilities apf content
	public function roles_apf_update()
	{
		$data['apf'] = $this->input->post('apf');
		$this->Setting_model->roles_apf_update($data);

		$this->session->set_flashdata('apf_success', 'Roles & Responsibilities Of APF has been updated successfully.');
	    redirect('settings/about_apf_content');
	}

	//To get roles & responsibilities apf and load about apf edit page
	public function roles_apf_view()
	{
		$data['apf'] = $this->Setting_model->roles_responsibilities_apf();

		$this->load->view('settings/app_content/roles_apf_view',$data);
	}


/********************************************************************************************
                            Purpose : To handle video content Settings
    *****************************************************************************************/


	//To Get video content and load video content list
    public function video_content_list()
	{
		$data['video'] = $this->Setting_model->video_content_list();
		$this->load->view('settings/app_content/video_content_list',$data);
	}

	//To active and inactive video content
	public function video_active()
	{
		$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->video_active($id,$data);
    	if($data==0){
	    	$this->session->set_flashdata('video_err', 'Video Content has been deactivated successfully.');
    	}
    	else{
	    	$this->session->set_flashdata('video_success', 'Video Content has been activated successfully.');
    	}
    	echo 1;
	}


	//To Check video name unique
	public function unique_video_name()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->unique_video_name($val);
		if($res){ echo 1; }else{ echo 0; }
	}

	//To Check video name unique
	public function unique_video_desc()
	{
		$val = $this->input->post('value');
		$res = $this->Setting_model->unique_video_desc($val);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To upload the video and insert  video content
	public function video_add()
	{
		
		$ext = $_FILES['video'];
		$ext1 = explode('.', $ext['name']);

		$data['vname'] = $this->input->post('vname');
		$data['vdesc'] = $this->input->post('vdesc');
		$data['status'] = 1;

		$configVideo['upload_path'] = 'assets/app/media/video'; # check path is correct
		$configVideo['max_size'] = '10240000';
		$configVideo['allowed_types'] = 'mp4|3gp|flv'; # add video extenstion on here
		$configVideo['overwrite'] = FALSE;
		$configVideo['remove_spaces'] = TRUE;
		$video_name = random_string('numeric', 5);
		$configVideo['file_name'] = $video_name;

		$this->load->library('upload', $configVideo);
		$this->upload->initialize($configVideo);

		if (!$this->upload->do_upload('video')) # form input field attribute
		{
		    # Upload Failed
		    $this->session->set_flashdata('video_err', $this->upload->display_errors());
		    redirect('settings/video_content_list');
		}
		else
		{
		    # Upload Successfull
		    $data['video'] = $video_name.".".$ext1[1];
		    $set1 =  $this->Setting_model->video_add($data);
		    $this->session->set_flashdata('video_success', 'Video Content has been activated successfully.');
		    redirect('settings/video_content_list');
		}

	    
	}


	//To get video content and load video content edit page
	public function video_edit()
	{
		$id = $this->input->post('id');
		$data['video'] = $this->Setting_model->video_content_by_id($id);

		$this->load->view('settings/app_content/video_content_edit',$data);
	}


	//To Check video name Unique
	public function edit_unique_video_name()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		$return_id = $this->input->post('return_id');

		$res = $this->Setting_model->video_name_unique_edit($val, $return_id);
		if($res){ echo 1; }else{ echo 0; }
	}

	//To Check video description value Unique
	public function edit_unique_video_desc()
	{
		$val = $this->input->post('value');
		$oldmname = $this->input->post('oldmname');
		$return_id = $this->input->post('return_id');

		$res = $this->Setting_model->video_desc_unique_edit($val, $return_id);
		if($res){ echo 1; }else{ echo 0; }
	}


	//To Update video content
	public function video_update()
	{

		if ($this->input->post('fexist'))
		{
			$ext = $_FILES['video'];
			$ext1 = explode('.', $ext['name']);

			$data['vname'] = $this->input->post('vname');
			$data['vdesc'] = $this->input->post('vdesc');
			$data['status'] = 1;
			$oldvideo = $this->input->post('oldvideo');

			$configVideo['upload_path'] = 'assets/app/media/video'; # check path is correct
			$configVideo['max_size'] = '10240000';
			$configVideo['allowed_types'] = 'mp4|3gp|flv'; # add video extenstion on here
			$configVideo['overwrite'] = FALSE;
			$configVideo['remove_spaces'] = TRUE;
			$video_name = random_string('numeric', 5);
			$configVideo['file_name'] = $video_name;

			$this->load->library('upload', $configVideo);
			$this->upload->initialize($configVideo);

			unlink('assets/app/media/video/'.$oldvideo);

			if (!$this->upload->do_upload('video')) # form input field attribute
			{
			    # Upload Failed
			    $this->session->set_flashdata('video_err', $this->upload->display_errors());
			    redirect('settings/video_content_list');
			}
			else
			{
			    # Upload Successfull
			    $data['id'] = $this->input->post('id');
			    $data['video'] = $video_name.".".$ext1[1];
			    $set1 =  $this->Setting_model->video_update($data);
			    $this->session->set_flashdata('video_success', 'Video Content has been activated successfully.');
			    redirect('settings/video_content_list');
			}
		}
		else
		{
			$data['vname'] = $this->input->post('vname');
			$data['vdesc'] = $this->input->post('vdesc');
			$data['video'] = $this->input->post('fexist');
			$data['status'] = 1;
			$data['id'] = $this->input->post('id');
			$set1 =  $this->Setting_model->video_update($data);
			redirect('settings/video_content_list');
		}

		
	}
	//To View video content
	public function view_video()
	{
		$id = $this->input->post('id');
		$data['video'] = $this->Setting_model->video_content_by_id($id);
		$this->load->view('settings/app_content/video_content_view',$data);
	}


	//To Delete video content
	public function video_delete()
	{
		$id = $this->input->post('video_cont');
		$data = 2;
		$result = $this->Setting_model->video_delete($data,$id);
		$this->session->set_flashdata('video_success', 'Video Content has been deleted successfully.');
    	redirect('settings/video_content_list');
	}
	/********************************************************************************************
                            Purpose : To handle display menu Settings
    *****************************************************************************************/
    // To update display menu setting
    public function display_menu()                       
    {
    	$user_ID = $_SESSION['admindata']['user_id'];
    	$data['user_details'] = $this->User_model->user_by_id($user_ID);

    	if($this->input->post('submit'))
    	{
    		$show_menu  = $this->input->post('show_menu');
		    $columns = "show_menu= '".trim($show_menu)."'";
	        $condition = ' user_id = "'.$user_ID.'"';
			$update_result = $this->User_model->user_update($columns, 'users',  $condition);
			$this->session->set_flashdata('mds_success', 'Display Menu has been changeed successfully...');

			redirect('Settings/display_menu');
    	}else{
    		$this->load->view('menu_display_settings/menu_display_settings', $data);
    	}
    	
    }
    public function email_domain()
    {
    	$data['get_all_email_domain']= $this->Setting_model->get_all_email_domain();
    	$this->load->view('email_domain/email_domain_list',$data);
    }
    public function chk_email_domain_unique()
    {
    	$value = $this->input->post('value');
    	$chk_email_domain_already_exist = $this->Setting_model->chk_email_domain_already_exist($value);
    	if(count($chk_email_domain_already_exist) > 0)
    	{
    		echo "1";
    	}
    	else 
    	{
    		echo "0";
    	}
    }
    public function add_email_domain()
    {
    	$email_domain = $this->input->post('email_domain');
    	$c_by = $_SESSION['admindata']['user_id'];
    	$c_on = date('Y-m-d H:i:s');

    	$add_email_domain = $this->Setting_model->add_email_domain($email_domain,$c_by,$c_on);
    	if ($add_email_domain == 1) {
			$this->session->set_flashdata('qstage_success', 'Email Domain Added successfully.');
	    	redirect('Settings/email_domain');		
    	}
    	else {
    		$this->session->set_flashdata('qstage_err', 'Email Domain Fail to Add');
	    	redirect('Settings/email_domain');		
    	}
    }
    public function email_domain_change_status()
    {
    	$st=$this->input->post('status');
		$id = $this->input->post('id');
	    $result = $this->Setting_model->email_domain_change_status($st, $id);

	    if($result == 1){ echo 1; } else{ echo 0; }
    }
    public function email_domain_edit()
	{
	    $id = $this->input->post('id');
	    $data['get_email_domain_by_id'] = $this->Setting_model->get_email_domain_by_id($id);
	    $this->load->view('email_domain/email_domain_edit',$data);
	}
	public function edit_email_domain()
	{
		$ed_id = $this->input->post('ed_id');
		$email_domain = $this->input->post('e_email_domain');
    	$m_by = $_SESSION['admindata']['user_id'];
    	$m_on = date('Y-m-d H:i:s');

    	$update_email_domain = $this->Setting_model->update_email_domain($ed_id,$email_domain,$m_by,$m_on);
    	if ($update_email_domain == 1) {
    		$this->session->set_flashdata('qstage_success', 'Email Domain Updated successfully.');
	    	redirect('Settings/email_domain');	
    	}
    	else {
    		$this->session->set_flashdata('qstage_err', 'Email Domain Fail to Update');
	    	redirect('Settings/email_domain');	
    	}
	}
	public function delete_email_domain()
	{
		$ed_id = $this->input->post('delete_email_domain_id');
		$delete_email_domain = $this->Setting_model->delete_email_domain($ed_id);
    	if ($update_email_domain == 1) {
    		$this->session->set_flashdata('qstage_success', 'Email Domain Deleted successfully.');
	    	redirect('Settings/email_domain');	
    	}
    	else {
    		$this->session->set_flashdata('qstage_err', 'Email Domain Fail to Delete');
	    	redirect('Settings/email_domain');	
    	}
	}
	//Block Email Domain code is start from here....
	public function block_email_domain()
    {
    	$data['get_all_block_email_domain'] = $this->Setting_model->get_all_block_email_domain();
    	$this->load->view('block_email_domain/block_email_domain_list',$data);
    }
    public function chk_block_email_domain_unique()
    {
    	$val = $this->input->post('value');
    	$chk_block_email_domain_unique = $this->Setting_model->chk_block_email_domain_unique($val);
    	if (count($chk_block_email_domain_unique) > 0) {
    		echo '1';
    	}
    	else {
    		echo '0';
    	}

    }
    public function add_block_email_domain()
    {
    	$email_domain = trim($this->input->post('blo_email_domain'));
    	$flag = $this->input->post('email_or_domain');
    	$c_by = $_SESSION['admindata']['user_id'];
    	$c_on = date('Y-m-d H:i:s');

    	$add_email_domain = $this->Setting_model->add_block_email_domain($email_domain,$flag,$c_by,$c_on);
    	if ($add_email_domain == 1) {
			$this->session->set_flashdata('qstage_success', 'Block Email Domain Added successfully.');
	    	redirect('Settings/block_email_domain');		
    	}
    	else {
    		$this->session->set_flashdata('qstage_err', 'Block Email Domain Fail to Add');
	    	redirect('Settings/block_email_domain');		
    	}
    }
    public function block_email_domain_change_status()
    {
    	$id = $this->input->post('id');
    	$data = $this->input->post('status');
    	$result = $this->Setting_model->block_email_domain_change_status($id,$data);
    	echo 1;
    }
    public function block_email_domain_edit()
    {
    	$id = $this->input->post('id');
    	$data['get_block_email_info_by_id'] = $this->Setting_model->get_block_email_info_by_id($id);
    	$this->load->view('block_email_domain/block_email_domain_edit',$data);

    }
    public function edit_block_email_domain()
    {
    	$id = $this->input->post('ed_id');
    	$value = trim($this->input->post('e_blo_email_domain'));
    	$flag = $this->input->post('e_email_or_domain');
    	$m_by = $_SESSION['admindata']['user_id'];
    	$m_on = date('Y-m-d H:i:s');

    	$update_email_domain = $this->Setting_model->update_block_email_domain($id,$value,$flag,$m_by,$m_on);
    	if ($update_email_domain == 1) {
			$this->session->set_flashdata('qstage_success', 'Block Email Domain updated successfully.');
	    	redirect('Settings/block_email_domain');		
    	}
    	else {
    		$this->session->set_flashdata('qstage_err', 'Block Email Domain Fail to update');
	    	redirect('Settings/block_email_domain');		
    	}
    }
    public function delete_block_email_domain()
    {
    	$ed_id = $this->input->post('delete_ed_id');
    	$delete_block_email_domain = $this->Setting_model->delete_block_email_domain($ed_id);
    	if ($delete_block_email_domain == 1) {
    		$this->session->set_flashdata('qstage_success', 'Block Email Domain Deleted successfully.');
	    	redirect('Settings/block_email_domain');	
    	}
    	else {
    		$this->session->set_flashdata('qstage_err', 'Block Email Domain Fail to Delete');
	    	redirect('Settings/block_email_domain');		
    	}
    }
    public function chk_email_domain_is_cannot_blockable()
    {
    	$val = $this->input->post('value');
    	$chk_email_domain_is_cannot_blockable = $this->Setting_model->chk_email_domain_is_cannot_blockable($val);
    	if (count($chk_email_domain_is_cannot_blockable) > 0) {
    		echo '1';
    	}
    	else {
    		echo '0';
    	}
    }
    //Product Unit setting codes start from here by jegan
    public function product_unit()
    {
    	$data['get_all_product_unit'] = $this->Setting_model->get_all_prodcutunit();
    	$this->load->view('product_unit/product_unit_list',$data);
    }
    public function checkUniqueprounit()
    {
    	$val = $this->input->post('value');
    	$chk_pro_unit_exist_or_not = $this->Setting_model->chk_pro_unit_exist_or_not($val);
    	if (count($chk_pro_unit_exist_or_not)>0) {
    		echo "1";
    	}
    	else {
    		echo "0";
    	}
    }
    public function create_product_unit()
    {
    	$pro_unit = $this->input->post('product_unit');
    	$c_by = $_SESSION['admindata']['user_id'];
    	$c_on = date('Y-m-d H:i:s');
    	$add_product_unit = $this->Setting_model->create_product_unit($pro_unit, $c_by, $c_on);
    	if ($add_product_unit == 1) {
    		$this->session->set_flashdata('qstage_success', 'Product Unit Added successfully.');
	    	redirect('Settings/product_unit');	
    	}
    	else {
    		$this->session->set_flashdata('qstage_err', 'Product Unit Fail to Add');
	    	redirect('Settings/product_unit');		
    	}
    }
    public function prodcut_unit_change_status()
    {
    	$st=$this->input->post('status');
		$id = $this->input->post('id');
	    $result = $this->Setting_model->prodcut_unit_change_status($st, $id);

	    if($result == 1){ echo 1; } else{ echo 0; }
    }
    public function product_unit_edit()
    {
    	$val = $this->input->post('value');
    	$data['get_product_unit_by_id'] = $this->Setting_model->get_product_unit_by_id($val);
    	$this->load->view('product_unit/product_unit_edit',$data);
    }
    public function update_product_unit()
    {
    	$pro_unit_id = $this->input->post('product_unit_id');
    	$pro_unit = $this->input->post('e_product_unit');
    	$m_by = $_SESSION['admindata']['user_id'];
    	$m_on = date('Y-m-d H:i:s');
    	$update_product_unit = $this->Setting_model->update_product_unit($pro_unit_id,$pro_unit, $m_by, $m_on);
    	if ($update_product_unit == 1) {
    		$this->session->set_flashdata('qstage_success', 'Product Unit updateed successfully.');
	    	redirect('Settings/product_unit');	
    	}
    	else {
    		$this->session->set_flashdata('qstage_err', 'Product Unit Fail to update');
	    	redirect('Settings/product_unit');		
    	}
    }
    public function product_unit_delete()
    {
    	$pro_id = $this->input->post('del_product_unit_id');
    	$product_unit_delete = $this->Setting_model->product_unit_delete($pro_id);
    	if ($product_unit_delete == 1) {
    		$this->session->set_flashdata('qstage_success', 'Product Unit Deleted successfully.');
	    	redirect('Settings/product_unit');	
    	}
    	else {
    		$this->session->set_flashdata('qstage_err', 'Product Unit Fail to Delete');
	    	redirect('Settings/product_unit');		
    	}
    }
    public function quarter_year_list()
    {
    	$data['get_all_quarter_year_list'] = $this->Setting_model->quarter_year_list();
    	$this->load->view('quarter_year/quarter_year_list',$data);
    }
    public function quarter_edit()
    {
    	$q_id = $this->input->post('value');
    	$data['get_quarter_year_by_id'] = $this->Setting_model->quarter_year_by_id($q_id);
    	$this->load->view('quarter_year/quarter_year_edit',$data);	
    }
    public function chk_unnique_label()
    {
    	$q_label = $this->input->post('value');
    	$chk_unnique_label = $this->Setting_model->chk_unnique_label($q_label);
    	if (count($chk_unnique_label)>0) {
    		echo  '1';
    	}
    	else {
    		echo '0';
    	}
    }
    public function update_quarter_year()
    {
    	$q_id = $this->input->post('quarter_id');
    	$label = $this->input->post('q_label');
    	$s_date = $this->input->post('s_date');
    	$e_date = $this->input->post('e_date');
    	$m_by = $_SESSION['admindata']['user_id'];
    	$m_on = date('Y-m-d H:i:s');

    	$update_quarter_year = $this->Setting_model->update_quarter_year($q_id,$label,$s_date,$e_date,$m_by,$m_on);
    	if ($update_quarter_year == 1) {
    		$this->session->set_flashdata('qstage_success','Quarter Date Update successfully');
    		redirect('Settings/quarter_year_list');
    	}
    	else {
    		$this->session->set_flashdata('qstage_err','Quarter Date Fail to Update');
    		redirect('Settings/quarter_year_list');	
    	}
    }
    public function value_variant()
    {
    	$data['get_all_vv'] = $this->Setting_model->get_all_vv();
    	$this->load->view('value_variant/value_variant',$data);
    }	
    public function vv_change_status()
    {
    	$data['status']=$this->input->post('status');
	    $data['modified_by']   = $_SESSION['user_id'];
		$data['modified_on']   = date('Y-m-d H:i:s');
		$id = $this->input->post('id');
	    $result = $this->Setting_model->vv_change_status($data, $id);
	    if($result == 1){ echo 1; } else{ echo 0; }
    }
    public function vv_edit()
    {
    	$vv_id = $this->input->post('value');
    	$data['get_vv_by_id'] = $this->Setting_model->get_vv_by_id($vv_id);
    	$this->load->view("value_variant/edit_value_variant",$data);
    }
    public function chk_unique_from_amnt()
    {
    	$val = $this->input->post('value');
    	$chk_unique_field = $this->Setting_model->chk_unique_from_amnt($val);
    	if (count($chk_unique_field)>0) {
    		echo "1";
    	}
    	else {
    		echo "0";
    	}
    }
    public function chk_unique_to_amnt()
    {
    	$val = $this->input->post('value');
    	$chk_unique_field = $this->Setting_model->chk_unique_to_amnt($val);
    	if (count($chk_unique_field)>0) {
    		echo "1";
    	}
    	else {
    		echo "0";
    	}
    }
    public function update_vv()
    {
    	$vv_id = $this->input->post('vv_id');
    	$from = $this->input->post('e_from_amnt');
    	$to = $this->input->post('e_to_amnt');
    	$color = $this->input->post('value_color');
    	$m_by = $_SESSION['admindata']['user_id'];
    	$m_on = date('Y-m-d H:i:s');

    	$update_vv_info = $this->Setting_model->update_vv_info($vv_id,$from,$to,$color,$m_by,$m_on);
    	if ($update_vv_info == 1) {
    		$this->session->set_flashdata('qstage_success','Value Variant Update successfully');
    		redirect('Settings/value_variant');
    	}
    	else {
    		$this->session->set_flashdata('qstage_err','Value Variant Fail to Update');
    		redirect('Settings/value_variant');	
    	}
    }
    // public function filemanager_access()
    // {
    // 	$data['get_all_folder_access'] = $this->Setting_model->get_all_folder_access();
    // 	$data['get_all_role_name'] = $this->Setting_model->get_all_role_name();
    // 	$data['get_all_folders'] = $directories = glob('assets/responsive_filemanager/source' . '/*' , GLOB_ONLYDIR);
    // 	$this->load->view('filemanager_access/filemanager_access_list',$data);
    // }
    // public function check_unique_role()
    // {

    // 	$val = $this->input->post('value');
    // 	// echo 'here id = '.$val;
    // 	// die();
    // 	$chk_unique_role = $this->Setting_model->chk_unique_role($val);
    // 	if (count($chk_unique_role)>0) {
    // 		echo "1";
    // 	}
    // 	else {
    // 		echo "0";
    // 	}
    // }
    // public function create_f_acc()
    // {

    // 	$role = $this->input->post('role');
    // 	$c_by = $_SESSION['admindata']['user_id'];
    // 	$c_on = date('Y-m-d H:i:s');
    // 	$add_f_acc = $this->Setting_model->add_f_acc($role,$c_by,$c_on);
    // 	$folders = $this->input->post('folders');
    	
    // 	for ($i=0; $i < count($folders); $i++) { 
    // 		$add_f_acc_info = $this->Setting_model->add_f_acc_info($add_f_acc,$folders[$i]);
    // 	}

    // 	if ($add_f_acc != '') {
    // 		$this->session->set_flashdata('qstage_success','File Access Added successfully');
    // 		redirect('Settings/filemanager_access');
    // 	}
    // 	else {
    // 		$this->session->set_flashdata('qstage_err','File Access Fail to Add');
    // 		redirect('Settings/filemanager_access');	
    // 	}

    // }
    // public function edit_fileaccess()
    // {
    // 	$id = $this->input->post('value');
    // 	$data['get_all_role_name'] = $this->Setting_model->get_all_role_name();
    // 	$data['get_all_folders'] = $directories = glob('assets/responsive_filemanager/source' . '/*' , GLOB_ONLYDIR);
    // 	$data['get_fa_by_id'] = $this->Setting_model->get_fa_by_id($id);
    // 	$folder_from_db = $this->Setting_model->get_fai_by_id($id);
    // 	$folder_array = array();
    // 	foreach ($folder_from_db as $folder_db) {
    // 		array_push($folder_array, $folder_db['folder_name']);
    // 	}
    // 	$data['get_fai_by_id'] = $folder_array;
    // 	$this->load->view('filemanager_access/edit_filemanager_access',$data);
    // }
    // public function update_f_acc()
    // {
    // 	// print_r($_POST);
    // 	// die();
    // 	$f_acc_id = $this->input->post('f_acc_id');
    // 	$role_id = $this->input->post('e_role');
    // 	$folders = $this->input->post('e_folders');
    // 	$m_by = $_SESSION['admindata']['user_id'];
    // 	$m_on = date('Y-m-d H:i:s');

    // 	$update_f_acc = $this->Setting_model->update_f_acc($f_acc_id,$role_id,$m_by,$m_on);
    // 	$del_f_acc = $this->Setting_model->del_f_acc_info_by_fa_id($f_acc_id);

    // 	for ($i=0; $i < count($folders); $i++) { 
    // 		$add_f_acc_info = $this->Setting_model->add_f_acc_info($f_acc_id,$folders[$i]);
    // 	}

    // 	if ($update_f_acc != '') {
    // 		$this->session->set_flashdata('qstage_success','File Access Updated successfully');
    // 		redirect('Settings/filemanager_access');
    // 	}
    // 	else {
    // 		$this->session->set_flashdata('qstage_err','File Access Fail to Update');
    // 		redirect('Settings/filemanager_access');	
    // 	}
    // }
    // public function del_filemanager_access()
    // {
    // 	$f_acc_id = $this->input->post('del_f_acc_id');
    // 	$del_f_acc = $this->Setting_model->del_f_acc($f_acc_id);
    // 	$del_f_acc_info = $this->Setting_model->del_f_acc_info_by_fa_id($f_acc_id);

    // 	if ($update_f_acc != '') {
    // 		$this->session->set_flashdata('qstage_success','File Access Deleted successfully');
    // 		redirect('Settings/filemanager_access');
    // 	}
    // 	else {
    // 		$this->session->set_flashdata('qstage_err','File Access Fail to Delete');
    // 		redirect('Settings/filemanager_access');	
    // 	}

    // }
    public function filemanager_access()
    {
    	$data['get_all_folder_access'] = $this->Setting_model->get_all_folder_access();
    	$data['get_all_role_name'] = $this->Setting_model->get_all_role_name();
    	$data['get_all_folders'] = $directories = glob('assets/responsive_filemanager/source' . '/*' , GLOB_ONLYDIR);
    	$this->load->view('filemanager_access/filemanager_access_list',$data);
    }
    public function chk_unique_folder_name()
    {
    	// echo "1";
    	// die();
    	$val = $this->input->post('value');
    	// echo 'here id = '.$val;
    	// die();
    	$chk_unique_folder = $this->Setting_model->chk_unique_folder($val);
    	if (count($chk_unique_folder)>0) {
    		echo "1";
    	}
    	else {
    		echo "0";
    	}
    }
    public function create_f_acc()
    {

    	$role = $this->input->post('role');
    	$c_by = $_SESSION['admindata']['user_id'];
    	$c_on = date('Y-m-d H:i:s');
    	
    	$folders = $this->input->post('folder');
    	mkdir("assets/responsive_filemanager/source/".$folders);
    	$add_f_acc = $this->Setting_model->add_f_acc($folders,$c_by,$c_on);
    	for ($i=0; $i < count($role); $i++) { 
    		$add_f_acc_info = $this->Setting_model->add_f_acc_info($add_f_acc,$role[$i]);
    	}

    	if ($add_f_acc != '') {
    		$this->session->set_flashdata('qstage_success','File Access Added successfully');
    		redirect('Settings/filemanager_access');
    	}
    	else {
    		$this->session->set_flashdata('qstage_err','File Access Fail to Add');
    		redirect('Settings/filemanager_access');	
    	}

    }
    public function edit_fileaccess()
    {
    	$id = $this->input->post('value');
    	$data['get_all_role_name'] = $this->Setting_model->get_all_role_name();
    	$data['get_all_folders'] = $directories = glob('assets/responsive_filemanager/source' . '/*' , GLOB_ONLYDIR);
    	$data['get_fa_by_id'] = $this->Setting_model->get_fa_by_id($id);
    	$folder_from_db = $this->Setting_model->get_fai_by_id($id);
    	$folder_array = array();
    	foreach ($folder_from_db as $folder_db) {
    		array_push($folder_array, $folder_db['role_id']);
    	}
    	$data['get_fai_by_id'] = $folder_array;
    	$this->load->view('filemanager_access/edit_filemanager_access',$data);
    }
    public function update_f_acc()
    {
    	// print_r($_POST);
    	// die();
    	$f_id = $this->input->post('f_id');
    	$role_id = $this->input->post('e_role');
    	$folders = $this->input->post('e_folder');
    	$ex_folder = $this->input->post('ex_folder');
    	$m_by = $_SESSION['admindata']['user_id'];
    	$m_on = date('Y-m-d H:i:s');
    	rename('assets/responsive_filemanager/source/'.$ex_folder, 'assets/responsive_filemanager/source/'.$folders);

    	$update_f_acc = $this->Setting_model->update_f_acc($f_id,$folders,$m_by,$m_on);
    	$del_f_acc = $this->Setting_model->del_f_acc_info_by_fa_id($f_id);

    	for ($i=0; $i < count($role_id); $i++) { 
    		$add_f_acc_info = $this->Setting_model->add_f_acc_info($f_id,$role_id[$i]);
    	}

    	if ($update_f_acc != '') {
    		$this->session->set_flashdata('qstage_success','File Access Updated successfully');
    		redirect('Settings/filemanager_access');
    	}
    	else {
    		$this->session->set_flashdata('qstage_err','File Access Fail to Update');
    		redirect('Settings/filemanager_access');	
    	}
    }
    public function del_filemanager_access()
    {
    	$f_acc_id = $this->input->post('del_f_acc_id');
    	$get_fa_by_id = $this->Setting_model->get_fa_by_id($f_acc_id);
    	rmdir('assets/responsive_filemanager/source/'.$get_fa_by_id->folder_name);
    	$del_f_acc = $this->Setting_model->del_f_acc($f_acc_id);
    	$del_f_acc_info = $this->Setting_model->del_f_acc_info_by_fa_id($f_acc_id);
    	
    	if ($update_f_acc != '') {
    		$this->session->set_flashdata('qstage_success','File Access Deleted successfully');
    		redirect('Settings/filemanager_access');
    	}
    	else {
    		$this->session->set_flashdata('qstage_err','File Access Fail to Delete');
    		redirect('Settings/filemanager_access');	
    	}

    }
    public function filemanager()
    {
    	$role_id = $_SESSION['admindata']['user_hasnt_product'];
    	if ($role_id != '1') {
    		$data['get_user_folders'] = $this->Setting_model->get_user_folders($role_id);
    	}
    	else {
    		$data['get_user_folders'] = $this->Setting_model->get_user_all_folders();
    	}
    	$this->load->view('filemanager_access/filemanager_folder_list.php',$data);
    }
    public function manual_crons()
    {
    	$this->load->view('manual_crons/manual_crons_list');
    }
    public function task_data_clear_page()
    {
    	$this->load->view('task_clearance/task_clearance_page');
    }
    public function clear_task_data()
    {
    	$from_date = $this->input->post('from_date');
    	$to_date = $this->input->post('to_date');

    	$exp_from = explode('-', $from_date);
    	$exp_to = explode('-', $to_date);

    	$modified_from_date = $exp_from[2].'-'.$exp_from[0].'-'.$exp_from[1];
    	$modified_to_date = $exp_to[2].'-'.$exp_to[0].'-'.$exp_to[1];

    	$delete_all_buyer_order_task = $this->Setting_model->delete_all_buyer_order_task($modified_from_date,$modified_to_date);

    	if ($delete_all_buyer_order_task == 1) {
    		$this->session->set_flashdata('g_success','Tasks Deleted successfully');
    		redirect('Settings/task_data_clear_page');
    	}
    	else {
    		$this->session->set_flashdata('g_err','Tasks Deleted successfully');
    		redirect('Settings/task_data_clear_page');
    	}
    }
}
?>