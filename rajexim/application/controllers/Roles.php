<?php
	class Roles extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		    $this->load->model('Role_model');
		    $this->load->model('Setting_model');
		    $admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		  date_default_timezone_set("Asia/Kolkata");
  		}

  		//to get role list and load role list page
  		public function index()
  		{	
  			$data['role_list'] = $this->Role_model->get_role_lists();
			$this->load->view('role/role_list',$data);
  		}

  		//To active and inactive role
  		public function role_active()
  		{	
  			$id = $this->input->post('id');
	    	$data = $this->input->post('status');
	    	$result = $this->Role_model->role_change_status($id,$data);
	    	if($result==1)
	    	{
				echo 1;
	    	}
  		}


  		//To get menus and load role add page
  		public function add_role_page()
		{
			$data['get_all_folder_access'] = $this->Setting_model->get_all_folder_access();
			$data['menu_list'] = $this->Role_model->get_menu_lists(0);
			$data['ftype'] = 0;
			$this->load->view('role/role_add',$data);
		}


		//to check role name unique
	 	public function unique_role()
		{
		    $val= $_POST['value'];
		    $result = $this->Role_model->unique_role($val);
		    if(!empty($result)){ echo 1; }else{ echo 0; }
	   	}

	   	//To save role permission
	   	public function role_add()
	  	{
		    $data['rname'] = $this->input->post('rname');
		    $data['st'] = 0;
		    $data['mon'] = date('Y-m-d H:i:s');
		    $data['mby'] = $_SESSION['admindata']['user_id'];
		    $val = $this->Role_model->roles_create($data);
		    $query1=$this->db->select('*')->order_by('role_id','desc')->limit(1)->get('roles');
		    $res = $query1->result_array();
		    $count = count($this->input->post('menuId'));
		    $data1['role_id'] = $res[0]['role_id'];
		    $inserted_role_id = $res[0]['role_id'];
		    $folders_id = $this->input->post('role_folders');
		    $role_has_acc = $this->input->post('role_has_acc');
		    if ($role_has_acc == '1') {
		    	for ($i=0; $i < count($folders_id); $i++) { 
			    	$add_folders_to_role = $this->Role_model->add_folders_to_role($inserted_role_id,$folders_id[$i],$data['mon'],$data['mby']);
			    }
		    }
		    
		    $menu = explode(",",implode(",",$this->input->post('menuId')));
		    $submenu = explode(",",implode(",",$this->input->post('subMenuId')));
		    $menufields = explode(",",implode(",",$this->input->post('menuFields')));
		    for($i=0;$i<$count;$i++)
		    {
		      $data1['menu_id'] = $menu[$i];
		      $data1['submenu_id'] = $submenu[$i];
		      $data1['fields'] = $menufields[$i];
		      $pvalue = explode(",",implode(",",$this->input->post('value'.$menu[$i])));
		      $cpvalue = count($pvalue);
		      for($j=0;$j<$cpvalue;$j++)
		      {
		        if($j==0)
		        {
		          $cval = $pvalue[$j];
		        }
		        else
		        {
		          $cval.='~'.$pvalue[$j];
		        }
		      }
		      $data1['value'] = $cval;
		      $data1['status'] = 0;

		      $result = $this->Role_model->permission_create($data1);
		    }

		     $this->session->set_flashdata('role_success', 'Role has been created successfully.');
		     redirect('/Roles');
	  	}

	  	//To get role and role permission by role id
	  	public function edit_role_page($id)
		{
	    	$data['role'] = $this->Role_model->get_role_by_id($id);
	    	$data['get_all_folder_access'] = $this->Setting_model->get_all_folder_access();
			$data['get_role_has_folder_access'] = $this->Role_model->get_role_has_folder_access($id);
			$data['menu_list'] = $this->Role_model->get_menu_lists(0);
				$data['ftype'] = 0;

			$this->load->view('role/role_edit',$data);
		}

		//To update role
		public function role_update()
	  	{
	        $data['rname']=$this->input->post('rname');
		    $data['id']= $this->input->post('rid');
		    $data['mon'] = date('Y-m-d H:i:s');
		    $data['mby'] = $_SESSION['admindata']['user_id'];
		    $update = $this->Role_model->update_role($data);
		    $re_create = $this->Role_model->drop_permission($data['id']);
		    $count = count($this->input->post('menuId'));
		    $data1['role_id'] = $data['id'];
		    $folders_id = $this->input->post('role_folders');
		    $role_has_acc = $this->input->post('role_has_acc');
		    if ($role_has_acc == '1') {
		    	$del_folders_acc_by_role_id = $this->Role_model->del_folders_acc_by_role_id($data['id']);
		    	for ($i=0; $i < count($folders_id); $i++) { 
			    	$add_folders_to_role = $this->Role_model->add_folders_to_role($data['id'],$folders_id[$i],$data['mon'],$data['mby']);
			    }
		    }
		    else if($role_has_acc == '0') {
		    	$del_folders_acc_by_role_id = $this->Role_model->del_folders_acc_by_role_id($data['id']);
		    }
		    $menu = explode(",",implode(",",$this->input->post('menuId')));
		    $submenu = explode(",",implode(",",$this->input->post('subMenuId')));
		    $menufields = explode(",",implode(",",$this->input->post('menuFields')));
		    for($i=0;$i<$count;$i++)
		    {
		      $data1['menu_id'] = $menu[$i];
		      $data1['submenu_id'] = $submenu[$i];
		      $data1['fields'] = $menufields[$i];
		      $pvalue = explode(",",implode(",",$this->input->post('value'.$menu[$i])));
		      $cpvalue = count($pvalue);
		      for($j=0;$j<$cpvalue;$j++)
		      {
		        if($j==0)
		        {
		          $cval = $pvalue[$j];
		        }
		        else
		        {
		          $cval.='~'.$pvalue[$j];
		        }
		      }
		      $data1['value'] = $cval;
		      $data1['status'] = 0;
		      $this->Role_model->permission_create($data1);
		    }
		    $this->session->set_flashdata('role_success', 'Role has been updated successfully.');
		    redirect('/Roles');
	 	}


	 	//To delete the Role
		public function role_delete()
		{
		    $id=$_POST['rid'];
		    $result = $this->User_model->role_change_status($id, 2);
		    if ($result) {
		      $this->session->set_flashdata('role_success', 'Role has been deleted successfully.');
		    }
		    else{
		      $this->session->set_flashdata('role_err', 'Something went wrong');
		    }
		    redirect('/Roles');
		}

  		
	}


?>