<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* ************************************************************************************
		Purpose : To handle all user functions
		Date    : 05-02-2020 
***************************************************************************************/
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Setting_model', 'Product_model', 'User_model', 'Profile_model','Mailbox_model','Lead_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
		
	}
	// To list user details
	public function index()					
	{	
		// $data['user_lists'] = $this->User_model->user_list();
    	$data['role_lists'] = $this->User_model->role_list();
    	$data['product_lists'] = $this->Product_model->product_list_count('all', '','');
    	$data['get_all_configured_email'] = $this->Mailbox_model->email_list();

		$this->load->view('users/user_list', $data);
	}
	public function user_list_by_filter()					
	{	//$data['perpage'] = $perpage = 10;
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';

		$data['user_type'] = $user_type = $this->input->post('user_type');

		$data['user_lists'] = $this->User_model->user_list($search_val,$page,$perpage,$user_type);
		$data['user_lists_count'] = $this->User_model->user_list_count($search_val,$user_type);
		$this->load->view('users/user_list_table', $data);
	}
	public function user_add()
	{
		// $data['user_lists'] = $this->User_model->user_list();
    	$data['role_lists'] = $this->User_model->role_list();
    	$data['product_lists'] = $this->Product_model->product_list_count('all', '','');
    	$data['get_all_configured_email'] = $this->Mailbox_model->email_list();
		$data['assigned_user_lists'] = $this->Lead_model->product_assigned_users();
		$this->load->view('users/user_add', $data);
	}
	// To get product email ids 
	public function product_email_ID_by_product_id()
	{
		$product_id  = $this->input->post('val');
		$product_emails = $this->Product_model->product_emails_by_id($product_id);
		$option = '<option value="">Choose</option>';
		if(!empty($product_emails))
		{
			foreach ($product_emails as $key => $product_email) {
				$option .= '<option value="'.$product_email["product_id"].'_'.$product_email["email_detail_id"].'">'.$product_email["email_name"].'</option>';
			}
		}
		echo $option;die;
	}
	// To check username unique
	public function username_unique()
	{
		$username = $this->input->post('val');
	    $result = $this->User_model->username_unique($username);
	    if(!empty($result)){ $result = 1;}else{ $result = 0; }
	    echo  $result;
	}
	// To save user details
	public function user_save()
	{
		// To get auto increment ID
		$user_ID = $this->User_model->user_next_auto_id();
		$name  = ($this->input->post('name')) ? $this->input->post('name') : '';
		$dob = ($this->input->post('dob')) ? date('Y-m-d', strtotime($this->input->post('dob'))) : '0000-00-00';
		$gender  = ($this->input->post('gender')) ? $this->input->post('gender') : '';
		$contact_no  = ($this->input->post('contact_no')) ? $this->input->post('contact_no') : '';
		$email_id  = ($this->input->post('user_email_id')) ? $this->input->post('user_email_id') : '';
		$address  = ($this->input->post('address')) ? $this->input->post('address') : '';
		$role_id  = ($this->input->post('role_id')) ? $this->input->post('role_id') : '';
		$pincode  = ($this->input->post('pincode')) ? $this->input->post('pincode') : '';
		$username  = ($this->input->post('username')) ? $this->input->post('username') : '';
		$password  = ($this->input->post('password')) ? encryptthis($this->input->post('password'), 'Rajexim2020') : '';
		if(!empty($_FILES['user_profile']['name'])){
	      $ext = pathinfo($_FILES['user_profile']['name'], PATHINFO_EXTENSION);
	      $config['upload_path'] = 'assets/user_profile';
	      $config['allowed_types'] = 'jpg|jpeg|png';
	      $config['file_name'] = $this->input->post('username');
	      $profileName = $this->input->post('username').'.'.$ext;
	      $this->load->library('upload',$config);
	      $this->upload->initialize($config);
	      if($this->upload->do_upload('user_profile'))
	      {
	        $uploadData = $this->upload->data();
	        $profile_image = $profileName;
	      }
	      else
	      {
	        $profile_image = '';
	      }
	    }
	    else
	    { 
	      $profile_image = '';
	    }

	    if(!empty($_FILES['signature']['name'])){
	      $ext = pathinfo($_FILES['signature']['name'], PATHINFO_EXTENSION);
	      $config['upload_path'] = 'assets/user_signature';
	      $config['allowed_types'] = 'jpg|jpeg|png';
	      $config['file_name'] = $this->input->post('username');
	      $profileName = $this->input->post('username').'.'.$ext;
	      $this->load->library('upload',$config);
	      $this->upload->initialize($config);
	      if($this->upload->do_upload('signature'))
	      {
	        $uploadData = $this->upload->data();
	        $signature = $signature;
	      }
	      else
	      {
	        $signature = '';
	      }
	    }
	    else
	    { 
	      $signature = '';
	    }
	    $allow_lead  = ($this->input->post('allow_lead')) ? $this->input->post('allow_lead') : '';
		$show_leads  = ($this->input->post('show_leads')) ? $this->input->post('show_leads') : '';
		
		$product_users  = (!empty($this->input->post('product_users'))) ? implode(',', $this->input->post('product_users')) : '';

		$insert_columns = 'name, dob, gender, address, contact_no, pincode, profile_image, signature, username, password, role_id, created_on, created_by,  allow_lead, show_leads, product_users';
		$insert_values  = '';
		$insert_values = "'".$name."', '".$dob."', '".$gender."', '".$address."' , '".$contact_no."', '".$pincode."' , '".$profile_image."', '".$signature."', '".$username."' , '".$password."', '".$role_id."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."',  '".$allow_lead."', '".$show_leads."' , '".$product_users."'";
		$insert_result = $this->User_model->user_save($insert_columns, 'users',  $insert_values);


		$user_product_ids = $this->input->post('product_id');
		$user_email_ids   = $this->input->post('email_id');
		
		if($insert_result && !empty($user_ID) && $user_ID->AUTO_INCREMENT > 0 && !empty($user_product_ids))
		{	
			$insert_columns = 'user_id, product_id, created_on, created_by';
			foreach ($user_product_ids as $key => $user_product_id) 
			{
				if($user_product_id != ''){
					$insert_values = '';
					$insert_values = "'".$user_ID->AUTO_INCREMENT."', '".$user_product_id."', '".date('Y-m-d H:i:s')."', '".$_SESSION['admindata']['user_id']."' ";
					$insert_result = $this->User_model->user_product_save($insert_columns, 'user_products',  $insert_values);
				}
			}
		}
		if($insert_result && !empty($user_ID) && $user_ID->AUTO_INCREMENT > 0 && !empty($email_id))
		{	
			$insert_columns = 'user_id, user_emails, created_on, created_by';
			foreach ($email_id as $key => $user_email_id) 
			{
				 $insert_values = '';
				 $insert_values = "'".$user_ID->AUTO_INCREMENT."', '".$user_email_id."', '".date('Y-m-d H:i:s')."', '".$_SESSION['admindata']['user_id']."' ";
				 $insert_result = $this->User_model->user_email_save($insert_columns, 'user_owned_emails',  $insert_values);
			}
		}
		if($insert_result && !empty($user_ID) && $user_ID->AUTO_INCREMENT > 0 && !empty($user_email_ids))
		{	
			$insert_columns = 'user_id, product_id, email_detail_id, created_on, created_by';
			foreach ($user_email_ids as $key => $user_email_id) 
			{
				 $ex_val = (!empty($user_email_id)) ? explode('_', $user_email_id) : '';
				 if(!empty($ex_val))
				 {
				 	$prd_val = $ex_val[0];
				 	$email_val = $ex_val[1];
				 }
				 else{
				 	$prd_val = 0;
				 	$email_val = 0;
				 }

				 $insert_values = '';
				 $insert_values = "'".$user_ID->AUTO_INCREMENT."', '".$prd_val."', '".$email_val."', '".date('Y-m-d H:i:s')."', '".$_SESSION['admindata']['user_id']."' ";
				 $insert_result = $this->User_model->user_product_email_save($insert_columns, 'user_emails',  $insert_values);
			}
		}

		$this->session->set_flashdata('user_success', 'User has been created successfully...');
		redirect('Users');     
	}

	// To change user status
	public function user_status_change()
	{
		$data['user_id'] = $this->input->post('id');
	    $data['status'] = $this->input->post('status');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->User_model->user_status_change($data);
	    return ($result) ? 1 : 0;
	}
	// To get user view
	public function user_view()
	{
		$user_id = $this->input->post('val');
		$data['user_details'] = $this->User_model->user_by_id($user_id);
		$data['user_email_details'] = $this->User_model->user_email_by_user_id($user_id);
		$data['user_product_details'] = $this->User_model->user_product_by_user_id($user_id);
		$data['users_emails_details'] = $this->User_model->users_emails_by_user_id($user_id);
		$this->load->view('users/user_view',$data);
	}
	// To get user edit
	public function user_edit($id)
	{
		// $user_id = $this->input->post('val');
		$user_id = $id;
		$data['role_lists'] = $this->User_model->role_list();
    	$data['product_lists'] = $this->Product_model->product_list_count('all', '','');
		$data['user_details'] = $this->User_model->user_by_id($user_id);
		$data['assigned_user_lists'] = $this->Lead_model->product_assigned_users();
		
		$data['pass'] = decryptthis($data['user_details']->password, 'Rajexim2020');
		$data['user_email_details'] = $this->User_model->user_email_by_user_id($user_id);
		$data['user_product_details'] = $this->User_model->user_product_by_user_id($user_id);
		$users_emails_details = $this->User_model->users_emails_by_user_id($user_id);
		$user_own_email = array();
		foreach ($users_emails_details as $user_owned_email) {
			array_push($user_own_email, $user_owned_email->user_emails);
		}
		$data['user_owned_email_by_user'] = $user_own_email;
		$data['get_all_configured_email'] = $this->Mailbox_model->email_list();
		$this->load->view('users/user_edit',$data);
	}
	
	// To save user details
	public function user_update()
	{
		// To get auto increment ID
		$user_ID = $this->input->post('user_id');
		$name  = ($this->input->post('name')) ? $this->input->post('name') : '';
		$dob = ($this->input->post('dob')) ? date('Y-m-d', strtotime($this->input->post('dob'))) : '0000-00-00';
		$gender  = ($this->input->post('gender')) ? $this->input->post('gender') : '';
		$contact_no  = ($this->input->post('contact_no')) ? $this->input->post('contact_no') : '';
		$email_id  = ($this->input->post('user_email_id')) ? $this->input->post('user_email_id') : '';
		// $user_owned_emails_id = ($this->input->post('user_owned_emails_id')) ? $this->input->post('user_owned_emails_id') : '';
		//$del_user_owned_email  = ($this->input->post('del_user_owned_email_id')) ? $this->input->post('del_user_owned_email_id') : '';
		$address  = ($this->input->post('address')) ? $this->input->post('address') : '';
		$role_id  = ($this->input->post('role_id')) ? $this->input->post('role_id') : '';
		$pincode  = ($this->input->post('pincode')) ? $this->input->post('pincode') : '';
		$username  = ($this->input->post('username')) ? $this->input->post('username') : '';
		$password  = ($this->input->post('password')) ? encryptthis($this->input->post('password'), 'Rajexim2020') : '';
		$o_user_profile  = ($this->input->post('o_user_profile')) ? $this->input->post('o_user_profile') : '';

		if(!empty($_FILES['user_profile']['name'])){
	      $ext = pathinfo($_FILES['user_profile']['name'], PATHINFO_EXTENSION);
		  if($o_user_profile!='defaultprofile.jpg')
	      {
	        unlink('assets/user_profile/'.$o_user_profile);
	      }
	      $config['upload_path'] = 'assets/user_profile';
	      $config['allowed_types'] = 'jpg|jpeg|png';
	      $profileName = $this->input->post('username').'.'.$ext;
	      $config['file_name'] = $profileName;
	      
	      $this->load->library('upload',$config);
	      $this->upload->initialize($config);
	      if($this->upload->do_upload('user_profile'))
	      {
	        $uploadData = $this->upload->data();
	        $profile_image = $profileName;
	      }
	      else
	      {
	        $profile_image = $o_user_profile;
	      }
	    }
	    else
	    { 
	      $profile_image = $o_user_profile;
	    }
	    $o_signature  = ($this->input->post('o_signature')) ? $this->input->post('o_signature') : '';
	    if(!empty($_FILES['signature']['name'])){

	      $ext = pathinfo($_FILES['signature']['name'], PATHINFO_EXTENSION);

	      if($o_signature!='defaultprofile.jpg'){
		        unlink('assets/user_signature/'.$o_user_profile);
		      }

	      $config['upload_path'] = 'assets/user_signature';
	      $config['allowed_types'] = 'jpg|jpeg|png';
	      $profileName = $this->input->post('username').'.'.$ext;
	      $config['file_name'] = $profileName;
	      
	      $this->load->library('upload',$config);
	      $this->upload->initialize($config);
	      if($this->upload->do_upload('signature'))
	      {
	        $uploadData = $this->upload->data();
	        $signature = $profileName;
	      }
	      else
	      {
	        $signature = $o_signature;
	      }
	    }
	    else
	    { 
	      $signature = $o_signature;
	    }
	   
	    $allow_lead  = ($this->input->post('allow_lead')) ? $this->input->post('allow_lead') : '';

	    $show_leads  = ($this->input->post('show_leads')) ? $this->input->post('show_leads') : '';

	    if($show_leads == 3 && (!empty($this->input->post('product_users'))))
	    {
	    	$product_users = implode(',', $this->input->post('product_users'));
	    }
	    else{
	    	$product_users = '';
	    }

	    $columns = "name = '".trim($name)."',  dob = '".trim($dob)."',  gender='".trim($gender)."' , contact_no = '".trim($contact_no)."', email_id = '".trim($email_id)."',  address = '".trim($address)."', role_id =  '".trim($role_id)."', pincode =  '".trim($pincode)."',  profile_image ='".trim($profile_image)."', signature ='".trim($signature)."',  username ='".trim($username)."', password ='".trim($password)."', modified_on = date('Y-m-d H:i:s'), modified_by = '".$_SESSION['admindata']['user_id']."', allow_lead= '".trim($allow_lead)."', show_leads= '".trim($show_leads)."', product_users = '".trim($product_users)."'";
        $condition = ' user_id = "'.$user_ID.'"';
		$insert_result = $this->User_model->user_update($columns, 'users',  $condition);

		$this->User_model->delete_user_product_userid($user_ID);
		$this->User_model->delete_user_email_user_id($user_ID);
		$this->User_model->delete_user_owned_email_user_id($user_ID);


		$user_product_ids = $this->input->post('ed_product_id');
		$user_email_ids   = $this->input->post('ed_email_id');

		//print_r($user_product_ids);
		
		// for ($i=0; $i < count($user_owned_emails_id); $i++) { 
		// 	if ($user_owned_emails_id[$i] == 0) {
		// 		$insert_columns = 'user_id, user_emails, created_on, created_by';
		// 		$insert_values = '';
		// 		 $insert_values = "'".$user_ID."', '".$email_id[$i]."', '".date('Y-m-d H:i:s')."', '".$_SESSION['admindata']['user_id']."' ";
		// 		 $insert_result = $this->User_model->user_email_save($insert_columns, 'user_owned_emails',  $insert_values);
		// 	}
		// 	else{
		// 		$this->User_model->update_users_emails($user_owned_emails_id[$i],$user_ID,$email_id[$i],date('Y-m-d H:i:s'),$_SESSION['admindata']['user_id']);
		// 	}
		// }

		// if ($del_user_owned_email != '') {
		// 	$rem_first_char = ltrim($del_user_owned_email,",");
		//     $del_id_user_email = explode(',', $rem_first_char);
	 //   	foreach ($del_id_user_email as $key => $value) {
		//     	$user_email_removed = $this->User_model->remove_user_email_by_id($value);
		//     }
		    
		// }
		if($insert_result && !empty($user_ID) && !empty($email_id))
		{	
			$insert_columns = 'user_id, user_emails, created_on, created_by';
			foreach ($email_id as $key => $user_email_id) 
			{
				 $insert_values = '';
				 $insert_values = "'".$user_ID."', '".$user_email_id."', '".date('Y-m-d H:i:s')."', '".$_SESSION['admindata']['user_id']."' ";
				 $insert_result = $this->User_model->user_email_save($insert_columns, 'user_owned_emails',  $insert_values);
			}
		}
		if($insert_result && !empty($user_ID) && !empty($user_product_ids))
		{	//echo "TEST"; exit;
			$insert_columns = 'user_id, product_id, created_on, created_by';
			foreach ($user_product_ids as $key => $user_product_id) 
			{	if($user_product_id != ''){
				 	$insert_values = '';
				 	$insert_values = "'".$user_ID."', '".$user_product_id."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
				 	$insert_result = $this->User_model->user_product_save($insert_columns, 'user_products',  $insert_values);
				}
			}
		}

		if($insert_result && !empty($user_ID) && !empty($user_email_ids))
		{	
			$insert_columns = 'user_id, product_id, email_detail_id, created_on, created_by';
			foreach ($user_email_ids as $key => $user_email_id) 
			{
				 $ex_val = (!empty($user_email_id)) ? explode('_', $user_email_id) : '';
				 if(!empty($ex_val))
				 {
				 	$prd_val = $ex_val[0];
				 	$email_val = $ex_val[1];
				 }
				 else{
				 	$prd_val = 0;
				 	$email_val = 0;
				 }

				 $insert_values = '';
				 $insert_values = "'".$user_ID."', '".$prd_val."', '".$email_val."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
				 $insert_result = $this->User_model->user_product_email_save($insert_columns, 'user_emails',  $insert_values);
			}
		}

		/*$del_user_product_ids = $this->input->post('del_user_product_id');

		if ($del_user_product_ids != '') {

		      //$rem_first_char = ltrim($del_user_product_ids,",");
		      $del_id_prd = explode(',', $del_user_product_ids);

		      for ($i=0; $i < count($del_id_prd) ; $i++) { 

		      	$ex_prd_val = explode('_', $del_id_prd[$i]);
		      	//$ex_prd_email_val = 

		        $del_user_prd_by_id = $this->User_model->delete_user_product_id($ex_prd_val[1]);
		        $del_user_prd_by_id = $this->User_model->delete_user_product_email_id($ex_prd_val[0]);
		      }
		 }

		 $user_product_ids = $this->input->post('ed_product_id');
		 $user_email_ids   = $this->input->post('ed_email_id');

		 if(!empty($user_ID) && !empty($user_product_ids))
		{	
			$insert_columns = 'user_id, product_id, created_on, created_by';
			foreach ($user_product_ids as $key => $user_product_id) 
			{
				if($user_product_id >0)
				{
					 $insert_values = '';
					 $insert_values = "'".$user_ID."', '".$user_product_id."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
					 $insert_result = $this->User_model->user_product_save($insert_columns, 'user_products',  $insert_values);
				}
				
			}
		}

		if(!empty($user_ID) && !empty($user_email_ids))
		{	
			
			$insert_columns = 'user_id, product_id, email_detail_id, created_on, created_by';
			foreach ($user_email_ids as $key => $user_email_id) 
			{
				 $ex_val = (!empty($user_email_id)) ? explode('_', $user_email_id) : '';
				 if(!empty($ex_val))
				 {
				 	$prd_val = $ex_val[0];
				 	$email_val = $ex_val[1];
				 }
				 else{
				 	$prd_val = 0;
				 	$email_val = 0;
				 }

				 $insert_values = '';
				 $insert_values = "'".$user_ID."', '".$prd_val."', '".$email_val."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
				 $insert_result = $this->User_model->user_product_email_save($insert_columns, 'user_emails',  $insert_values);
			}
		}

		
		$user_product_details = $this->User_model->user_product_by_user_id($user_ID);

		$u_prd_ids = array();
		if(!empty($user_product_details))
		{
			foreach ($user_product_details as $key => $user_product_detail) {

				$u_prd_ids[] = $user_product_detail->product_id;
			}
		}
		$edit_user_product_ids = $this->input->post('product_id');

		if(!empty($edit_user_product_ids) && !empty($u_prd_ids))
	      {
	      		$array_1 = '';
	      		$array_2 = '';
	      		if( count($edit_user_product_ids) > count($u_prd_ids))
	      		{
	      			$array_1 = $edit_user_product_ids;
	      			$array_2 = $u_prd_ids;
	      		}
	      		else{
	      			$array_1 = $u_prd_ids;
	      			$array_2 = $edit_user_product_ids;
	      		}

	      		$prd_diff_val = array_merge(array_diff($array_1, $array_2), array_diff($array_2, $array_1));

	      		if(!empty($prd_diff_val))
	      		{

	      			$insert_columns = 'product_id, email_detail_id, created_on, created_by';
					foreach ($prd_diff_val as $key => $prd_diff) 
					{
						if($prd_diff > 0)
						{
							// To check email id exists for product
							$check_prod_ID = $this->User_model->user_product_id_exists_by_product_id($user_ID, $prd_diff);

							if(!empty($check_prod_ID))
							{
								// To delete the record
								$prd_email_delete = $this->User_model->user_product_id_delete_by_id($check_prod_ID->user_product_id);
							}else{

								$insert_columns = 'user_id, product_id, created_on, created_by';
								$insert_values = '';
								$insert_values = "'".$user_ID."', '".$prd_diff."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
								$insert_result = $this->User_model->user_product_save($insert_columns, 'user_products',  $insert_values);
							}
						}
					}
	      		}

	      }
	      $user_email_details = $this->User_model->user_email_by_user_id($user_ID);
	      $u_email_ids = array();
		  if(!empty($user_email_details))
		  {
				foreach ($user_email_details as $key => $user_email_detail) {

					$u_email_ids[] = $user_email_detail->product_id.'_'.$user_email_detail->email_detail_id;
				}
		  }
	      $edit_user_email_ids   = $this->input->post('email_id');

	      if(!empty($edit_user_email_ids) && !empty($u_email_ids))
	      {
	      		$array_1 = '';
	      		$array_2 = '';
	      		if( count($edit_user_email_ids) > count($u_email_ids))
	      		{
	      			$array_1 = $edit_user_email_ids;
	      			$array_2 = $u_email_ids;
	      		}
	      		else{
	      			$array_1 = $u_email_ids;
	      			$array_2 = $edit_user_email_ids;
	      		}
	      		$email_diff_val = array_merge(array_diff($array_1, $array_2), array_diff($array_2, $array_1));

	      		if(!empty($email_diff_val))
	      		{
	      			$insert_columns = 'user_id, product_id, email_detail_id, created_on, created_by';
					foreach ($email_diff_val as $key => $email_diff) 
					{
						$ex_email_val = explode('_', $email_diff);


						// To check email id exists for product
						$check_email_ID = $this->User_model->user_email_id_exists_by_email_id($user_ID, $ex_email_val[0], $ex_email_val[1]);

						if(!empty($check_email_ID))
						{
							// To delete the record
							$prd_email_delete = $this->User_model->user_email_id_delete_by_id($check_email_ID->user_email_id);
						}else{

							$insert_columns = 'user_id, product_id, email_detail_id, created_on, created_by';
							$insert_values = '';
							$insert_values = "'".$user_ID."', '".$ex_email_val[0]."', '".$ex_email_val[1]."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
							$insert_result = $this->User_model->user_product_email_save($insert_columns, 'user_emails',  $insert_values);
						}
						 
					}
	      		}

	      }*/

		$this->session->set_flashdata('user_success', 'User has been updated successfully...');
		redirect('Users');      
	}
	// To delete user
	public function user_delete()
	{
		$data['user_id'] = $this->input->post('user_id');
		$user_type = $this->input->post('del_user_type');
	    $data['status'] = 2;
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');

	    // To  check user in lead
	    $check_user_delete = $this->User_model->user_ID_in_lead($data['user_id']);

	    if(!empty($check_user_delete))
	    {
	    	$this->session->set_flashdata('user_err', 'Could not delete user. User is mapped with other modules!');
	    }else{
	    	if ($user_type == '') {
	    		$result = $this->User_model->user_status_change($data);
		    	$delete_user_prds = $this->User_model->delete_user_products($data['user_id']);
		    	$delete_user_emails = $this->User_model->delete_user_emails($data['user_id']);
		    	$this->session->set_flashdata('user_success', 'User has been deleted successfully...');
	    	}
	    	else {
	    		$result = $this->User_model->user_delete($data['user_id']);
		    	$delete_user_prds = $this->User_model->delete_user_products($data['user_id']);
		    	$delete_user_emails = $this->User_model->delete_user_emails($data['user_id']);
		    	$this->session->set_flashdata('user_success', 'User has been Permanently deleted successfully...');
		    }	
	    }
	   
	   redirect('Users');     
	}
	// To get product users
	public function users_by_product_id()
	{
		$product_id  = trim($this->input->post('prd_id'), ',');
		$user_id  = $this->input->post('user_id');
		$user_details = $this->User_model->product_users_by_id($product_id);
		$prd_array = array();
		$user_info = '';
		if($user_id != '')
		{
			$user_info = $this->User_model->user_by_id($user_id);
           if($user_info->product_users != '')
           {
             $prd_array = explode(',', $user_info->product_users);
           }
		}

		$option = '<option value="">Choose</option>';
		if(!empty($user_details))
		{
			foreach ($user_details as $key => $user_detail) { if( $user_id != '' && $user_detail->user_id != $user_id){
				//$option .= '<option value="'.$user_detail->user_id.'">'.$user_detail->user_name.'-'.$user_detail->role.'</option>';

				if(in_array($user_detail->user_id, $prd_array))
				{
					$selected = 'selected';
				}
				else
				{
					$selected = '';
				}
				 $option.='<option data-content="<span><b>'.$user_detail->user_name.'</b></span>&nbsp;<span class=testt><span class=text-info><b><sub>'
				 .$user_detail->role_name.'</sub><b></span></b></span></span>"'.$selected.' 
				  value='.$user_detail->user_id.' >'.$user_detail->user_name.'</option><option data-divider="true"></option>';
				}

			}
		}
		echo $option;die;
	}
	// To check user contact no unique
	public function user_contact_no_unique()
	{
		$contact_no = $this->input->post('val');
	    $result = $this->User_model->user_contact_no_unique($contact_no);
	    if(!empty($result)){ $result = 1;}else{ $result = 0; }
	    echo  $result;
	}
	public function get_user_login_history()
	{
		$u_id = $this->input->post('u_id');
		$data['get_user_login_history'] = $this->User_model->get_user_login_history($u_id);
		$this->load->view('users/user_login_history',$data);
	}
	public function get_user_per_day_login_history()
	{
		$u_id = $this->input->post('u_id');
		$date = $this->input->post('date');
		
		$data['get_user_per_day_login_history'] = $this->User_model->get_user_per_day_login_history($u_id,$date);
		
		$this->load->view('users/user_per_day_login_history',$data);	
	}
	public function chk_role_has_lead_auth()
	{
		$role_id = $this->input->post('val');
		$chk_role_has_lead_acc = $this->User_model->chk_role_has_lead_acc($role_id);
		if (!empty($chk_role_has_lead_acc)) {
			$lead_permissions = $chk_role_has_lead_acc->value;
			$lead_each_permission = explode('~', $lead_permissions);
			if ($lead_each_permission[2] == 1) {
				echo "1";
			}
			else {
				echo "0";	
			}
		}
		else {
			echo "0";
		}
	}
}
?>