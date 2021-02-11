<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Task extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Task_model','Buyerorder_model','Lead_model'));
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
  		$data['user_list'] = $this->Buyerorder_model->get_user_list();
		/*if($_SESSION['admindata']['role_id']==1)
		{
			$data['task_list'] = $this->Task_model->get_all_task();
		}
		else
		{
			$data['task_list'] = $this->Task_model->get_task_by_assigned_to($_SESSION['admindata']['user_id']);
		}*/

		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$uid = $_SESSION['admindata']['user_id'];
    		$mytval = $this->input->post('mytval');
    		$asstval = $this->input->post('asstval');
    		$alltval = $this->input->post('alltval');
    		if($mytval!='')
    		{
    			$mpriority = $this->input->post('my_priority');
      			$mstatus = $this->input->post('my_status');

      			if($mpriority !='')
				{
					$mp = " AND t.priority = '$mpriority'";
				}
				else
				{
					$mp = '';
				}

				if($mstatus !='')
				{
					$ms = " AND t.status = '$mstatus'";
					$mbs = " AND bot.status = '$mstatus'";
				}
				else
				{
					$ms = '';
					$mbs = '';
				}

				$data['mpriority'] = $mpriority;
      			$data['mstatus'] = $mstatus;

      			$btn = $this->input->post('goButton');
				$mdsearch = $this->input->post('mdsearch');
				$dtrange = $this->input->post('dtrange');
				if($btn=='')
				{
					$dtrange='';
				}
				if($mdsearch == '')
					$mdsearch='';

// "SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE t.created_by = asign.user_id AND t.parent_task_id=0 AND FIND_IN_SET(uid,t.assigned_to) GROUP by t.task_id UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type, bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to = uid) ut ORDER BY ut.task_end_date ASC";

				if($mdsearch == '')
				{
					$data['my_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND FIND_IN_SET('".$uid."',t.assigned_to) $mp $ms UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to = '".$uid."' $mbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				elseif($mdsearch == 'today')
				{
					$data['drnge'] = '';
					$data['my_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND FIND_IN_SET('".$uid."',t.assigned_to) AND STR_TO_DATE(t.task_date, '%Y-%m-%d') <= CURDATE() AND STR_TO_DATE(t.task_end_date, '%Y-%m-%d') >= CURDATE() $mp $ms UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to = '".$uid."' AND STR_TO_DATE(bot.buyer_order_task_date, '%Y-%m-%d') <= CURDATE() AND STR_TO_DATE(bot.buyer_order_task_end_date, '%Y-%m-%d') >= CURDATE() $mbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				else if($mdsearch == 'duedate')
				{
					$data['drnge'] = '';
					$data['my_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND FIND_IN_SET('".$uid."',t.assigned_to) AND STR_TO_DATE(t.task_end_date, '%Y-%m-%d') < CURDATE() $mp $ms UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to = '".$uid."' AND STR_TO_DATE(bot.buyer_order_task_end_date, '%Y-%m-%d') < CURDATE() $mbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}      
				else if($mdsearch == 'upcoming')
				{
					$data['drnge'] = '';
					$data['my_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND FIND_IN_SET('".$uid."',t.assigned_to) AND STR_TO_DATE(t.task_date, '%Y-%m-%d') > CURDATE() $mp $ms UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to = '".$uid."' AND STR_TO_DATE(bot.buyer_order_task_date, '%Y-%m-%d') > CURDATE() $mbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				else
				{
					$data['drnge'] = $dtrange;
					$dr = explode(' / ', $dtrange);

					$fd = explode('-', $dr[0]);
					$td = explode('-', $dr[1]);

					$fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
					$tdate = $td[2].'-'.$td[1].'-'.$td[0];

					$data['my_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND FIND_IN_SET('".$uid."',t.assigned_to) AND ((DATE(t.task_date) BETWEEN '".$fdate."' AND '".$tdate."') OR (DATE(t.task_end_date) BETWEEN '".$fdate."' AND '".$tdate."')) $mp $ms UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to = '".$uid."' AND ((DATE(bot.buyer_order_task_date) BETWEEN '".$fdate."' AND '".$tdate."') OR (DATE(bot.buyer_order_task_end_date) BETWEEN '".$fdate."' AND '".$tdate."')) $mbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				//echo $schange;exit;
				$data['mdatesearch'] = $mdsearch;
				$data['drnge'] = $dtrange;
				$data['assigned_task_list'] = $this->Task_model->get_assigned_task_list($_SESSION['admindata']['user_id']);
				$data['all_task_list'] = $this->Task_model->get_all_task_list($_SESSION['admindata']['user_id']);

    			$data['mtask']= 'active';
    			$data['asstask']= '';
    			$data['alltask']= '';
    		}

    		if($asstval!='')
    		{
    			$asspriority = $this->input->post('ass_priority');
      			$assstatus = $this->input->post('ass_status');

      			if($asspriority !='')
				{
					$assp = " AND t.priority = '$asspriority'";
				}
				else
				{
					$assp = '';
				}

				if($assstatus !='')
				{
					$asss = " AND t.status = '$assstatus'";
					$assbs = " AND bot.status = '$assstatus'";
				}
				else
				{
					$asss = '';
					$assbs = '';
				}

				$data['asspriority'] = $asspriority;
      			$data['assstatus'] = $assstatus;

      			$btn = $this->input->post('goButton');
				$assdsearch = $this->input->post('assdsearch');
				$dtrange = $this->input->post('dtrange');
				if($btn=='')
				{
					$dtrange='';
				}
				if($assdsearch == '')
					$assdsearch='';

				if($assdsearch == '')
				{
					$data['assigned_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND t.created_by = '".$uid."' $assp $asss UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.created_by = '".$uid."' $assbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				elseif($assdsearch == 'today')
				{
					$data['drnge'] = '';
					$data['assigned_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND t.created_by = '".$uid."' AND STR_TO_DATE(t.task_date, '%Y-%m-%d') <= CURDATE() AND STR_TO_DATE(t.task_end_date, '%Y-%m-%d') >= CURDATE() $assp $asss UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.created_by = '".$uid."' AND STR_TO_DATE(bot.buyer_order_task_date, '%Y-%m-%d') <= CURDATE() AND STR_TO_DATE(bot.buyer_order_task_end_date, '%Y-%m-%d') >= CURDATE() $assbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				else if($assdsearch == 'duedate')
				{
					$data['drnge'] = '';
					$data['assigned_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND t.created_by = '".$uid."' AND STR_TO_DATE(t.task_end_date, '%Y-%m-%d') < CURDATE() $assp $asss UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.created_by = '".$uid."' AND STR_TO_DATE(bot.buyer_order_task_end_date, '%Y-%m-%d') < CURDATE() $assbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}      
				else if($assdsearch == 'upcoming')
				{
					$data['drnge'] = '';
					$data['assigned_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND t.created_by = '".$uid."' AND STR_TO_DATE(t.task_date, '%Y-%m-%d') > CURDATE() $assp $asss UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.created_by = '".$uid."' AND STR_TO_DATE(bot.buyer_order_task_date, '%Y-%m-%d') > CURDATE() $assbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				else
				{
					$data['drnge'] = $dtrange;
					$dr = explode(' / ', $dtrange);

					$fd = explode('-', $dr[0]);
					$td = explode('-', $dr[1]);

					$fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
					$tdate = $td[2].'-'.$td[1].'-'.$td[0];

					$data['assigned_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND t.created_by = '".$uid."' AND ((DATE(t.task_date) BETWEEN '".$fdate."' AND '".$tdate."') OR (DATE(t.task_end_date) BETWEEN '".$fdate."' AND '".$tdate."')) $assp $asss UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.created_by = '".$uid."' AND ((DATE(bot.buyer_order_task_date) BETWEEN '".$fdate."' AND '".$tdate."') OR (DATE(bot.buyer_order_task_end_date) BETWEEN '".$fdate."' AND '".$tdate."')) $assbs) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				//echo $schange;exit;
				$data['assdatesearch'] = $assdsearch;
				$data['drnge'] = $dtrange;
				$data['my_task_list'] = $this->Task_model->get_my_task_list($_SESSION['admindata']['user_id']);
				$data['all_task_list'] = $this->Task_model->get_all_task_list($_SESSION['admindata']['user_id']);

    			$data['mtask']= '';
    			$data['asstask']= 'active';
    			$data['alltask']= '';
    		}

    		if($alltval!='')
    		{
    			$allpriority = $this->input->post('all_priority');
      			$allstatus = $this->input->post('all_status');
      			$assto = $this->input->post('ass_to');
      			$assby = $this->input->post('ass_by');

      			if($allpriority !='')
				{
					$allp = " AND t.priority = '$allpriority'";
				}
				else
				{
					$allp = '';
				}

				if($allstatus !='')
				{
					$alls = " AND t.status = '$allstatus'";
					$allbs = " AND bot.status = '$allstatus'";
				}
				else
				{
					$alls = '';
					$allbs = '';
				}

				if($assto !='')
				{
					//$tassto = " AND t.assigned_to = '$assto'";
					$tassto = " AND FIND_IN_SET('".$assto."',t.assigned_to)";
					$botassto = " AND bot.assigned_to = '$assto'";
				}
				else
				{
					$tassto = '';
					$botassto = '';
				}

				if($assby !='')
				{
					$tassby = " AND t.created_by = '$assby'";
					$botassby = " AND bot.created_by = '$assby'";
				}
				else
				{
					$tassby = '';
					$botassby = '';
				}

				$data['allpriority'] = $allpriority;
      			$data['allstatus'] = $allstatus;

      			$btn = $this->input->post('goButton');
				$alldsearch = $this->input->post('alldsearch');
				$dtrange = $this->input->post('dtrange');
				if($btn=='')
				{
					$dtrange='';
				}
				if($alldsearch == '')
					$alldsearch='';

				if($alldsearch == '')
				{
					$data['all_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND !FIND_IN_SET('".$uid."',t.assigned_to) AND t.created_by != '".$uid."' $allp $alls $tassto $tassby UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to != '".$uid."' AND bot.created_by != '".$uid."' $allbs $botassto $botassby) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				elseif($alldsearch == 'today')
				{
					$data['drnge'] = '';
					$data['all_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND !FIND_IN_SET('".$uid."',t.assigned_to) AND t.created_by != '".$uid."' AND STR_TO_DATE(t.task_date, '%Y-%m-%d') <= CURDATE() AND STR_TO_DATE(t.task_end_date, '%Y-%m-%d') >= CURDATE() $allp $alls $tassto $tassby UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to != '".$uid."' AND bot.created_by != '".$uid."' AND STR_TO_DATE(bot.buyer_order_task_date, '%Y-%m-%d') <= CURDATE() AND STR_TO_DATE(bot.buyer_order_task_end_date, '%Y-%m-%d') >= CURDATE() $allbs $botassto $botassby) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				else if($alldsearch == 'duedate')
				{
					$data['drnge'] = '';

					$data['all_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND !FIND_IN_SET('".$uid."',t.assigned_to) AND t.created_by != '".$uid."' AND STR_TO_DATE(t.task_end_date, '%Y-%m-%d') < CURDATE() $allp $alls $tassto $tassby UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to != '".$uid."' AND bot.created_by != '".$uid."' AND STR_TO_DATE(bot.buyer_order_task_end_date, '%Y-%m-%d') < CURDATE() $allbs $botassto $botassby) ut ORDER BY ut.task_end_date ASC")->result_array();
				}      
				else if($alldsearch == 'upcoming')
				{
					$data['drnge'] = '';

					$data['all_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND !FIND_IN_SET('".$uid."',t.assigned_to) AND t.created_by != '".$uid."' AND STR_TO_DATE(t.task_date, '%Y-%m-%d') > CURDATE() $allp $alls $tassto $tassby UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to != '".$uid."' AND bot.created_by != '".$uid."' AND STR_TO_DATE(bot.buyer_order_task_date, '%Y-%m-%d') > CURDATE() $allbs $botassto $botassby) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				else
				{
					$data['drnge'] = $dtrange;
					$dr = explode(' / ', $dtrange);

					$fd = explode('-', $dr[0]);
					$td = explode('-', $dr[1]);

					$fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
					$tdate = $td[2].'-'.$td[1].'-'.$td[0];

					$data['all_task_list'] = $this->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND !FIND_IN_SET('".$uid."',t.assigned_to) AND t.created_by != '".$uid."' AND ((DATE(t.task_date) BETWEEN '".$fdate."' AND '".$tdate."') OR (DATE(t.task_end_date) BETWEEN '".$fdate."' AND '".$tdate."')) $allp $alls $tassto $tassby UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to != '".$uid."' AND bot.created_by != '".$uid."' AND ((DATE(bot.buyer_order_task_date) BETWEEN '".$fdate."' AND '".$tdate."') OR (DATE(bot.buyer_order_task_end_date) BETWEEN '".$fdate."' AND '".$tdate."')) $allbs $botassto $botassby) ut ORDER BY ut.task_end_date ASC")->result_array();
				}
				//echo $schange;exit;
				$data['alldatesearch'] = $alldsearch;
				$data['drnge'] = $dtrange;
				$data['my_task_list'] = $this->Task_model->get_my_task_list($_SESSION['admindata']['user_id']);
				$data['assigned_task_list'] = $this->Task_model->get_assigned_task_list($_SESSION['admindata']['user_id']);

    			$data['mtask']= '';
    			$data['asstask']= '';
    			$data['alltask']= 'active';
	      		$data['ass_to'] = $assto;
	      		$data['ass_by'] = $assby;
    		}

    	}
    	else
    	{
    		$data['mtask']= 'active';
			$data['asstask']= '';
			$data['alltask']= '';
    		$data['mdatesearch'] = '';
			$data['drnge'] = '';
			$data['mpriority'] = '';
      		$data['mstatus'] = '';
      		$data['ass_to'] = '';
      		$data['ass_by'] = '';
			$data['my_task_list'] = $this->Task_model->get_my_task_list($_SESSION['admindata']['user_id']);
			$data['assigned_task_list'] = $this->Task_model->get_assigned_task_list($_SESSION['admindata']['user_id']);
			$data['all_task_list'] = $this->Task_model->get_all_task_list($_SESSION['admindata']['user_id']);
		}

  		$this->load->view('task/task_list',$data);
	}

	public function create_task()
	{
		$get_last_id_table = last_id('task');
		$last_id = $get_last_id_table[0]->AUTO_INCREMENT;

		$ato = explode(",",implode(",",$this->input->post('assigned_to')));
		$data['task_type'] = $task_type = $this->input->post('task_type_flag');
		$data['task_title']=$this->input->post('task_title');
		$data['task_description']=$this->input->post('task_description');
		if($task_type == '1')
		{
			$tdt = explode('/', $this->input->post('task_date'));
	    	$data['task_date'] = $tdt[2].'-'.$tdt[0].'-'.$tdt[1];
	    	$tedt = explode('/', $this->input->post('task_end_date'));
	    	$data['task_end_date'] = $tedt[2].'-'.$tedt[0].'-'.$tedt[1];
	    }
	    else if($task_type == '0') {
	    	$data['task_date'] = date('Y-m-d');
	    	$data['task_end_date'] = date('Y-m-d');
	    }
    	$data['assigned_to'] = implode(",",$this->input->post('assigned_to'));
    	$data['priority'] = $this->input->post('priority');

    	$issch = $data['is_schedule'] = $this->input->post('is_schedule');
    	if($issch==1)
    	{
    		$stype = $data['schedule_type'] = $this->input->post('schedule_type');
    		if($stype == 'Daily')
    			$data['schedule_value'] = '';
    		elseif($stype == 'Weekly')
    			$data['schedule_value'] = implode(",",$this->input->post('schedule_value_week'));
    		else
    			$data['schedule_value'] = implode(",",$this->input->post('schedule_value_month'));
    	}
    	else
    	{
    		$data['schedule_type'] = '';
    		$data['schedule_value'] = '';
    	}
    	$task_id = $this->Task_model->task_next_auto_id();
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    if(count($ato)>1)
	    {
	    	$data['is_parent']=1;
	    	$data['parent_task_id']=0;
	    }
	    else
	    {
	    	$data['is_parent']=0;
	    	$data['parent_task_id']=0;
	    }
	    
	    $result = $this->Task_model->create_task($data);



	    if(count($ato)==1)
	    {
		    $data_n['notification_type_id'] = "3";
			$data_n['task_id'] = $task_id->AUTO_INCREMENT;
			$data_n['notification_allow_to'] = implode(",",$this->input->post('assigned_to'));
			$data_n['created_by'] = $_SESSION['admindata']['user_id'];
			$data_n['created_on'] = date('Y-m-d H:i:s');
			$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
		}
		else
		{
			$ptid = $task_id->AUTO_INCREMENT;
			for($uc=0;$uc<count($ato);$uc++)
			{
				$data['task_title']=$this->input->post('task_title');
				$data['task_description']=$this->input->post('task_description');
				$tdt = explode('/', $this->input->post('task_date'));
		    	$data['task_date'] = $tdt[2].'-'.$tdt[0].'-'.$tdt[1];
		    	$tedt = explode('/', $this->input->post('task_end_date'));
		    	$data['task_end_date'] = $tedt[2].'-'.$tedt[0].'-'.$tedt[1];
		    	$data['assigned_to'] = $ato[$uc];
		    	$data['priority'] = $this->input->post('priority');
		    	$data['is_schedule'] = 0;

		    	$data['schedule_type'] = '';
		    	$data['schedule_value'] = '';

			    $data['created_on'] = date('Y-m-d H:i:s');
			    $data['created_by'] = $_SESSION['admindata']['user_id'];

			    $data['is_parent']=0;
			    $data['parent_task_id']=$ptid;
			    
			    $result = $this->Task_model->create_task($data);


			    $data_n['notification_type_id'] = "3";
				$data_n['task_id'] = $ptid;
				$data_n['notification_allow_to'] = $ato[$uc];
				$data_n['created_by'] = $_SESSION['admindata']['user_id'];
				$data_n['created_on'] = date('Y-m-d H:i:s');
				$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
			}
		}
		$explode_description = explode('</p>', $data['task_description']);
	    // echo $task_type;
	    // die();
	    if($task_type == '0') {
		    if(count($explode_description) > 0) {
			    for ($i=0; $i < count($explode_description); $i++) { 
			    	$remove_tag = str_replace('<p>', '', $explode_description[$i]);
			    	if(trim($remove_tag) != '' && trim($remove_tag) != '<br>'){
				    	$data_tl['task_id'] = $last_id;
				    	$data_tl['task'] = $remove_tag;
				    	$data_tl['created_by'] = $_SESSION['admindata']['user_id'];
				    	$data_tl['created_on'] = date('Y-m-d H:i:s');

				    	$save_task_list = $this->Task_model->save_task_list($data_tl);
			    	}
			    }
			}
		}
		//$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
	    if ($result) {
	      $this->session->set_flashdata('qstage_success', 'Task has been created successfully.');
	    }
	    else{
	      $this->session->set_flashdata('qstage_err', 'Something went wrong');
	    }
	    redirect('/task');
	}

	public function task_edit()
	{
		$tid = $_POST['id'];
		$data['task_list'] = $this->Task_model->get_task_by_id($tid);
		$data['user_list'] = $this->Buyerorder_model->get_user_list();
		$this->load->view('task/task_edit',$data);
	}

	public function update_task()
	{
		$ato = explode(",",implode(",",$this->input->post('assigned_to')));
		$oato = explode(",",$this->input->post('old_assigned_to'));
		$data['task_type'] = $task_type = $this->input->post('task_type_flag');
		$task_id = $data['task_id'] = $this->input->post('task_id');
		$data['task_title']=$this->input->post('task_title');
		$data['task_description']=$this->input->post('task_description');
		// $tdt = explode('/', $this->input->post('task_date'));
  //   	$data['task_date'] = $tdt[2].'-'.$tdt[0].'-'.$tdt[1];
  //   	$tedt = explode('/', $this->input->post('task_end_date'));
  //   	$data['task_end_date'] = $tedt[2].'-'.$tedt[0].'-'.$tedt[1];

		if($task_type == '1')
		{
			$tdt = explode('/', $this->input->post('task_date'));
	    	$data['task_date'] = $tdt[2].'-'.$tdt[0].'-'.$tdt[1];
	    	$tedt = explode('/', $this->input->post('task_end_date'));
	    	$data['task_end_date'] = $tedt[2].'-'.$tedt[0].'-'.$tedt[1];
	    }
	    else if($task_type == '0') {
	    	$data['task_date'] = date('Y-m-d');
	    	$data['task_end_date'] = date('Y-m-d');
	    }

    	$data['assigned_to'] = implode(",",$this->input->post('assigned_to'));
    	$data['priority'] = $this->input->post('priority');

    	$issch = $data['is_schedule'] = $this->input->post('is_schedule');
    	if($issch==1)
    	{
    		$stype = $data['schedule_type'] = $this->input->post('schedule_type');
    		if($stype == 'Daily')
    			$data['schedule_value'] = '';
    		elseif($stype == 'Weekly')
    			$data['schedule_value'] = implode(",",$this->input->post('schedule_value_week'));
    		else
    			$data['schedule_value'] = implode(",",$this->input->post('schedule_value_month'));
    	}
    	else
    	{
    		$data['schedule_type'] = '';
    		$data['schedule_value'] = '';
    	}

	    if(count($ato)>1)
	    {
	    	$data['is_parent']=1;
	    	$data['parent_task_id']=0;
	    }
	    else
	    {
	    	$data['is_parent']=0;
	    	$data['parent_task_id']=0;
	    }
    	
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    
	    $result = $this->Task_model->update_task($data);
	    $explode_description = explode('</p>', $data['task_description']);
	    $rmv_task_lists = $this->Task_model->del_task_lists($task_id);
	    if($task_type == '0') {
		    if(count($explode_description) > 0) {
			    for ($i=0; $i < count($explode_description); $i++) { 
			    	$remove_tag = str_replace('<p>', '', $explode_description[$i]);
			    	if(trim($remove_tag) != '' && trim($remove_tag) != '<br>'){
				    	$data_tl['task_id'] = $task_id;
				    	$data_tl['task'] = $remove_tag;
				    	$data_tl['created_by'] = $_SESSION['admindata']['user_id'];
				    	$data_tl['created_on'] = date('Y-m-d H:i:s');

				    	$save_task_list = $this->Task_model->save_task_list($data_tl);
			    	}
			    }
			}
		}
	    if ($result) {
	    	if(count($ato)>1)
	    	{
		    	for($uc=0;$uc<count($ato);$uc++)
				{
					$ctask = $this->db->query("SELECT * FROM task WHERE parent_task_id=$task_id AND assigned_to=$ato[$uc]")->row();
					if(count($ctask)>0)
					{
						$data['task_id'] = $ctask->task_id;
						$data['task_title']=$this->input->post('task_title');
						$data['task_description']=$this->input->post('task_description');
						$tdt = explode('/', $this->input->post('task_date'));
				    	$data['task_date'] = $tdt[2].'-'.$tdt[0].'-'.$tdt[1];
				    	$tedt = explode('/', $this->input->post('task_end_date'));
				    	$data['task_end_date'] = $tedt[2].'-'.$tedt[0].'-'.$tedt[1];
				    	$data['assigned_to'] = $ato[$uc];
				    	$data['priority'] = $this->input->post('priority');
				    	$data['is_schedule'] = 0;

				    	$data['schedule_type'] = '';
				    	$data['schedule_value'] = '';

					    $data['modified_on'] = date('Y-m-d H:i:s');
					    $data['modified_by'] = $_SESSION['admindata']['user_id'];

					    $data['is_parent']=0;
					    $data['parent_task_id']=$task_id;
					    
					    $result = $this->Task_model->update_task($data);
					    //array_diff( $oato, [$ato[$uc]] );
					    if (($key = array_search($ato[$uc], $oato)) !== false) {
						    unset($oato[$key]);
						}
					}
					else
					{
						$data['task_title']=$this->input->post('task_title');
						$data['task_description']=$this->input->post('task_description');
						$tdt = explode('/', $this->input->post('task_date'));
				    	$data['task_date'] = $tdt[2].'-'.$tdt[0].'-'.$tdt[1];
				    	$tedt = explode('/', $this->input->post('task_end_date'));
				    	$data['task_end_date'] = $tedt[2].'-'.$tedt[0].'-'.$tedt[1];
				    	$data['assigned_to'] = $ato[$uc];
				    	$data['priority'] = $this->input->post('priority');
				    	$data['is_schedule'] = 0;

				    	$data['schedule_type'] = '';
				    	$data['schedule_value'] = '';

					    $data['created_on'] = date('Y-m-d H:i:s');
					    $data['created_by'] = $_SESSION['admindata']['user_id'];

					    $data['is_parent']=0;
					    $data['parent_task_id']=$task_id;
					    $ntask_id = $this->Task_model->task_next_auto_id();
					    $result = $this->Task_model->create_task($data);
					    $ptid = $ntask_id->AUTO_INCREMENT;
					    $data_n['notification_type_id'] = "3";
						$data_n['task_id'] = $ptid;
						$data_n['notification_allow_to'] = $ato[$uc];
						$data_n['created_by'] = $_SESSION['admindata']['user_id'];
						$data_n['created_on'] = date('Y-m-d H:i:s');
						$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
					}
				}
				
				$aval = array_values($oato);

				if(count($aval)>0)
				{
					for($oat=0;$oat<count($aval);$oat++)
					{
						$this->db->query("Delete FROM task WHERE parent_task_id=$task_id AND assigned_to=$aval[$oat]");
					}
				}
			}

	      $this->session->set_flashdata('qstage_success', 'Task has been updated successfully.');
	    }
	    else{
	      $this->session->set_flashdata('qstage_err', 'Something went wrong');
	    }
	    redirect('/task');
	}
	public function task_view()
	{
		$tid = $_POST['id'];
		$data['task_list'] = $this->Task_model->get_task_by_id($tid);
		$data['task_comments_list'] = $this->Task_model->get_task_comments_by_task_id($tid);
		$data['task_status_list'] = $this->Task_model->get_task_status_history_by_task_id($tid);
		$this->load->view('task/task_view',$data);
	}

	public function create_task_comments()
	{
		$tlist = $this->Task_model->get_task_by_id($this->input->post('task_id'));
		if($tlist->is_parent==0)
		{
			$data['task_id'] = $this->input->post('task_id');
			$data['status'] = $this->input->post('status');
			$comments = $data['comments'] = $this->input->post('comments');
			$data['created_on'] = date('Y-m-d H:i:s');
		    $data['created_by'] = $_SESSION['admindata']['user_id'];
		    if($data['status']==2)
		    {
		    	$data['completed_date'] = date('Y-m-d H:i:s');
		    	$data['completed_by'] = $_SESSION['admindata']['user_id'];
		    }
		    else
		    {
		    	$data['completed_date'] = '0000-00-00 00:00:00';
		    	$data['completed_by'] = 0;
		    }
		    $this->Task_model->update_task_status($data);
		    $this->Task_model->create_task_status_history($data);
		    $task_comment_id = $this->Task_model->task_comments_next_auto_id();

		    $task_info = $this->Task_model->get_task_by_id($data['task_id']);
		    $noti_alow_to = "";
		    if ($_SESSION['admindata']['user_id'] == $task_info->assigned_to) {
		    	$noti_alow_to = $task_info->created_by;
		    }
		    else if($_SESSION['admindata']['user_id'] == $task_info->created_by){
		    	$noti_alow_to = $task_info->assigned_to;
		    }

		    if($comments!=''){
		    	$this->Task_model->create_task_comments($data);
		    	$data_n['notification_type_id'] = "4";
				$data_n['task_comments_id'] = $task_comment_id->AUTO_INCREMENT;
				$data_n['notification_allow_to'] = $noti_alow_to;
				$data_n['created_by'] = $_SESSION['admindata']['user_id'];
				$data_n['created_on'] = date('Y-m-d H:i:s');

				$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
		    }
		}
		else
		{
			$userid = $_SESSION['admindata']['user_id'];
			$ptaskid = $this->input->post('task_id');

			$subtask = $this->db->query("SELECT * FROM task WHERE parent_task_id = $ptaskid AND assigned_to=$userid")->row();

			if(count($subtask)>0)
			{

				$data1['task_id'] = $subtask->task_id;
				$data1['status'] = $this->input->post('status');
				$comments = $data1['comments'] = $this->input->post('comments');
				$data1['created_on'] = date('Y-m-d H:i:s');
				$data1['created_by'] = $_SESSION['admindata']['user_id'];
				if($data['status']==2)
				{
					$data1['completed_date'] = date('Y-m-d H:i:s');
					$data1['completed_by'] = $_SESSION['admindata']['user_id'];
				}
				else
				{
					$data1['completed_date'] = '0000-00-00 00:00:00';
					$data1['completed_by'] = 0;
				}
				$this->Task_model->update_task_status($data1);



				$data['task_id'] = $ptaskid;
				$data['status'] = $this->input->post('status');
				$comments = $data['comments'] = $this->input->post('comments');
				$data['created_on'] = date('Y-m-d H:i:s');
				$data['created_by'] = $_SESSION['admindata']['user_id'];
				if($data['status']==2)
				{
					$data['completed_date'] = date('Y-m-d H:i:s');
					$data['completed_by'] = $_SESSION['admindata']['user_id'];
				}
				else
				{
					$data['completed_date'] = '0000-00-00 00:00:00';
					$data['completed_by'] = 0;
				}
				if($data['status']!=2)
				{
					$this->Task_model->update_task_status($data);
				}
				else
				{
					$subtasklist = $this->db->query("SELECT * FROM task WHERE parent_task_id = $ptaskid")->result_array();
					$subtaskcomplist = $this->db->query("SELECT * FROM task WHERE parent_task_id = $ptaskid AND status=2")->result_array();
					if(count($subtasklist)==count($subtaskcomplist))
					{
						$this->Task_model->update_task_status($data);
					}
					else
					{
						$data['completed_date'] = '0000-00-00 00:00:00';
						$data['completed_by'] = 0;
						$this->Task_model->update_task_status($data);
					}
				}

				$this->Task_model->create_task_status_history($data);
				$task_comment_id = $this->Task_model->task_comments_next_auto_id();

				$task_info = $this->Task_model->get_task_by_id($data['task_id']);
				$noti_alow_to = "";
				$iparr = explode(',', $task_info->assigned_to);
				//if ($_SESSION['admindata']['user_id'] == $task_info->assigned_to) {
				if(in_array($_SESSION['admindata']['user_id'], $iparr)){
					$noti_alow_to = $task_info->created_by;

					if($comments!=''){
						$this->Task_model->create_task_comments($data);
						$data_n['notification_type_id'] = "4";
						$data_n['task_comments_id'] = $task_comment_id->AUTO_INCREMENT;
						$data_n['notification_allow_to'] = $noti_alow_to;
						$data_n['created_by'] = $_SESSION['admindata']['user_id'];
						$data_n['created_on'] = date('Y-m-d H:i:s');

						$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
					}

				}
				else if($_SESSION['admindata']['user_id'] == $task_info->created_by){
					$iparr = explode(',', $task_list->assigned_to);
					for($i=0;$i<count($iparr);$i++)
					{
						$noti_alow_to = $iparr[$i];

						if($comments!=''){
							$this->Task_model->create_task_comments($data);
							$data_n['notification_type_id'] = "4";
							$data_n['task_comments_id'] = $task_comment_id->AUTO_INCREMENT;
							$data_n['notification_allow_to'] = $noti_alow_to;
							$data_n['created_by'] = $_SESSION['admindata']['user_id'];
							$data_n['created_on'] = date('Y-m-d H:i:s');

							$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
						}
					}

				}
			}
			else
			{
				$data['task_id'] = $ptaskid;
				$data['status'] = $this->input->post('status');
				$comments = $data['comments'] = $this->input->post('comments');
				$data['created_on'] = date('Y-m-d H:i:s');
				$data['created_by'] = $_SESSION['admindata']['user_id'];
				if($data['status']==2)
				{
					$data['completed_date'] = date('Y-m-d H:i:s');
					$data['completed_by'] = $_SESSION['admindata']['user_id'];
				}
				else
				{
					$data['completed_date'] = '0000-00-00 00:00:00';
					$data['completed_by'] = 0;
				}
				if($data['status']!=2)
				{
					$this->Task_model->update_task_status($data);
				}
				else
				{
					$subtasklist = $this->db->query("SELECT * FROM task WHERE parent_task_id = $ptaskid")->result_array();
					$subtaskcomplist = $this->db->query("SELECT * FROM task WHERE parent_task_id = $ptaskid AND status=2")->result_array();
					if(count($subtasklist)==count($subtaskcomplist))
						$this->Task_model->update_task_status($data);
				}

				$this->Task_model->create_task_status_history($data);
				$task_comment_id = $this->Task_model->task_comments_next_auto_id();

				$task_info = $this->Task_model->get_task_by_id($data['task_id']);
				$noti_alow_to = "";
				$iparr = explode(',', $task_info->assigned_to);
				//if ($_SESSION['admindata']['user_id'] == $task_info->assigned_to) {
				if(in_array($_SESSION['admindata']['user_id'], $iparr)){
					$noti_alow_to = $task_info->created_by;

					if($comments!=''){
						$this->Task_model->create_task_comments($data);
						$data_n['notification_type_id'] = "4";
						$data_n['task_comments_id'] = $task_comment_id->AUTO_INCREMENT;
						$data_n['notification_allow_to'] = $noti_alow_to;
						$data_n['created_by'] = $_SESSION['admindata']['user_id'];
						$data_n['created_on'] = date('Y-m-d H:i:s');

						$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
					}

				}
				else if($_SESSION['admindata']['user_id'] == $task_info->created_by){
					$iparr = explode(',', $task_info->assigned_to);
					for($i=0;$i<count($iparr);$i++)
					{
						$noti_alow_to = $iparr[$i];

						if($comments!=''){
							$this->Task_model->create_task_comments($data);
							$data_n['notification_type_id'] = "4";
							$data_n['task_comments_id'] = $task_comment_id->AUTO_INCREMENT;
							$data_n['notification_allow_to'] = $noti_alow_to;
							$data_n['created_by'] = $_SESSION['admindata']['user_id'];
							$data_n['created_on'] = date('Y-m-d H:i:s');

							$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
						}
					}

				}
			}
		}
	    redirect('/task');
	}
	public function task_list_completed()
	{
		$task_list_id = $this->input->post('task_list_id');
		$data['completed_by'] = $_SESSION['admindata']['user_id'];
		$data['completed_on'] = date('Y-m-d H:i:s');
		$data['status'] = '1'; 

		$update_task_list = $this->Task_model->update_task_list_completed($data,$task_list_id);

		echo "1";
	}
	public function task_list_uncomplete()
	{
		$task_list_id = $this->input->post('task_list_id');
		$data['completed_by'] = '0';
		$data['completed_on'] = '0000-00-00 00:00:00';
		$data['status'] = '0'; 

		$update_task_list = $this->Task_model->update_task_list_completed($data,$task_list_id);

		echo "1";
	}

}
?>