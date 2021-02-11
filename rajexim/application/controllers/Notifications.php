<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ************************************************************************************
		Purpose : To handle all Notification functions
		Date    : 03-02-2020 
***************************************************************************************/
class Notifications extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array("Notification_model"));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
    $this->session->set_userdata('comtitle', 'Notification');
	}
	/* ************************************************************************************
						Purpose : To handle Notification function 
	        **********************************************************************/
	//to get notification alert every 5 seconds
	public function get_notification_content()
	{
		$this->load->view('notification/notification_content');
	}

	//to get notification count every 5 seconds
	public function get_notification_count()
	{
		$not_tot = get_notify_countByUser();
		if($not_tot != 0)
		{
		  echo '<span class="m-nav__link-badge m-badge m-badge--danger noti_count" id="badge">'.$not_tot.'<span>';
		}
		else
		{
		  echo "";
		}
	}
	//To update the user id in notification_table count status column
	public function change_notification()
	{
		$cond = " * FROM notification ";
		$get_user = select_table_with_condition('notification', $cond);
		
		foreach($get_user as $guser)
		{
		  $user_id = $guser->count_status_id;

		  if($user_id != '')
		  {
		    $users = array_unique(explode(",",$user_id));
		    $ruid='';
		    foreach ($users as $user) 
		    {
		       if($user == $_SESSION['admindata']['user_id'])
		       {
		         // nothing
		       }
		       else{
		        $ruid.=$user.",";
		       }
		    }
		    $cstid = $ruid.$_SESSION['admindata']['user_id'];
		  }
		  else
		  {
		    $cstid = $_SESSION['admindata']['user_id'];
		  }

		  $stval = " count_status_id = '$cstid' ";
		  $cond = " notification_id = $guser->notification_id ";
		  update_table('notification', $stval, $cond);
		}
		echo 1;
	}
	//To change color for each readed notification
	public function change_notification_read()
	{
		$noti_id = $_POST['id'];
		$cond = " * FROM notification WHERE notification_id = $noti_id ";
		$get_user = select_table_with_condition('notification', $cond);
		$user_id = $get_user[0]->read_status_id;

		if($user_id != '')
		{
		  $users = array_unique(explode(",",$user_id));
		 $ruid='';
		  foreach ($users as $user) {
		     if($user == $_SESSION['admindata']['user_id'])
		     {
		       // nothing
		     }
		     else{
		      $ruid.=$user.",";
		     }
		  }
		  $rstid = $ruid.$_SESSION['admindata']['user_id'];
		}
		else{
		  $rstid = $_SESSION['admindata']['user_id'];
		}
		$nid = $get_user[0]->notification_id;
		$stval = " read_status_id = '$rstid' ";
		$cond = " notification_id = $nid ";
		update_table('notification', $stval, $cond);
		echo 1;
	}
	//to get all notification list and load notification list page
      public function view_all_notification()
      { 
        $adddate = $this->input->post('list_product_date');
        $ntype = $this->input->post('ntype');
        $data['list_product_date'] = $this->input->post('list_product_date');   
        $data['ntype'] = $this->input->post('ntype');
        $user_id = $_SESSION['admindata']['user_id'];
        $data['notification'] = $this->Notification_model->get_all_notification($user_id,$ntype,$adddate);
        $data['notification_type'] = $this->Notification_model->get_all_notification_type();
        $this->load->view('notification/view_all_notification', $data);
      }
}	
?>