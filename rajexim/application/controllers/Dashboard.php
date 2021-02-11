<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Dashboard Controls details
    Date    :29-02-2020 
****************************************************************/
class Dashboard extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Dashboard_model','Quote_model', 'Vendor_model','Lead_model','Joborder_model','Quotestage_model','PI_Stage_model','Setting_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}
	//To list All price Terms in index page of this settings..
	public function index()
	{	
		$data['quarter_list'] = $this->Setting_model->quarter_year_list();
		$finstart = $_SESSION['finstart'];
		$finend = $_SESSION['finend'];
		$data['financial_year_to'] = $financial_year_to = (date('m') > 3) ? date('Y') +1 : date('Y');
        $data['financial_year_from'] = $financial_year_from = $financial_year_to - 1;
        $data['assigned_user_lists'] = $this->Lead_model->product_assigned_users();
		$data['total_lead_count'] = $this->Dashboard_model->get_lead_count_info();
		$data['total_opportunity_count'] = $this->Dashboard_model->get_opportunity_count_info();
		$data['total_proforma_count'] = $this->Dashboard_model->get_proforma_count_info();
		$data['total_quotation_count'] = $this->Dashboard_model->get_quotation_count_info();
		$data['get_all_product'] = $this->Dashboard_model->get_all_product();
		
		$data['employee_list'] = $this->Joborder_model->get_active_employee_list();
		// $data['get_users_allocated_industry'] = $this->Dashboard_model->get_users_allocated_industry($data['assigned_user_lists'][0]->user_id);
		$data['get_users_allocated_industry'] = $this->Setting_model->industry_list();
		$data['quote_stage_list'] = array_reverse($this->Quotestage_model->get_quote_stage_list());

		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		$data['industry_lists'] = $this->Setting_model->industry_list();

		$data['lead_sources'] = $this->Lead_model->lead_source_list();
		$data['lead_sources_for_filt'] = $this->Lead_model->lead_source_list();
		//PI based on PI stage
		$data['pi_stage_list'] = $this->PI_Stage_model->get_pi_stage_list();


		$dashboard_settings_info = get_dashboard_settings_info();

		$data['lead_notifications'] = $this->Dashboard_model->get_lead_followup_notification_before_three_days_and_missed($dashboard_settings_info->lead_days_after);
		$data['joborder_notifications'] = $this->Dashboard_model->get_incomplete_joborder_notificaiton_before_enddate($dashboard_settings_info->jo_days_before);
		$data['buyerorder_notificajoborders'] = $this->Dashboard_model->get_incomplete_buyerorder_notificaiton_before_enddate($dashboard_settings_info->bo_days_before);

		$d_settings = common_select_values('*', 'dashboard_settings', '', 'row');
		$g_settings = common_select_values('*', 'general_settings', '', 'row');
		$data['lessmail_reply_notifications'] = $this->Dashboard_model->get_lessmail_reply_notifications();
		$topleast_supplier = $d_settings->max_supplier_count;


		if($_SESSION['admindata']['user_hasnt_product']==1)
		{
			//$data['product_list'] = $this->Dashboard_model->get_product_list();
			$quser = '';
			$data['user_list'] = $this->Dashboard_model->get_user_list();
			$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,cb.lead_name,qs.quote_stage,l.lead_assigned_to FROM `quote` q, exporter e, leads l, quote_stage qs, contact_book cb WHERE cb.contact_book_id = l.contact_book_id AND q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND q.status!=2 AND  STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
		}
		else
		{
			$userid = $_SESSION['admindata']['user_id'];
			$quser = ' AND l.lead_assigned_to = '.$userid;
			$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,cb.lead_name,qs.quote_stage,l.lead_assigned_to FROM `quote` q, exporter e, leads l, quote_stage qs, contact_book cb WHERE cb.contact_book_id = l.contact_book_id AND q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND q.status!=2 AND  STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND l.lead_assigned_to='".$userid."' GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
		}


			
			$data['pi_tot'] = $this->db->query("SELECT  
      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 01) AS m1_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 02) AS m2_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 03) AS m3_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 04) AS m4_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 05) AS m5_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 06) AS m6_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 07) AS m7_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 08) AS m8_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 09) AS m9_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 10) AS m10_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 11) AS m11_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 12) AS m12_ach_val

      FROM proforma_invoice GROUP BY m1_ach_val")->row();

			$data['bo_tot'] = $this->db->query("SELECT  
      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 01) AS bo1_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 02) AS bo2_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 03) AS bo3_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 04) AS bo4_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 05) AS bo5_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 06) AS bo6_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 07) AS bo7_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 08) AS bo8_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 09) AS bo9_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 10) AS bo10_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 11) AS bo11_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 12) AS bo12_ach_val

      FROM buyer_order GROUP BY bo1_ach_val")->row();

		$data['topleast_supplier'] = $topleast_supplier;
		$ascdec = 'DESC';
		$slimit = $topleast_supplier;
		$data['topleast_supplier_list'] = $this->db->query("SELECT v.*,vt.vendor_type,vc.vendor_category FROM vendor v, vendor_type vt, vendor_category vc WHERE v.vendor_type_id = vt.vendor_type_id AND v.vendor_category_id = vc.vendor_category_id AND v.status!=2 ORDER BY v.points $ascdec LIMIT $slimit	")->result_array();

		$this->load->view('dashboard/dashboard_view', $data);
	}

	public function getSCTL()
	{
		$tl = $_POST['tl'];
		$topleast_supplier = $_POST['topleast_supplier'];
		if($tl=='top')
			$ascdec = 'DESC';
		else
			$ascdec = 'ASC';
		$slimit = $topleast_supplier;
		$data['topleast_supplier_list'] = $this->db->query("SELECT v.*,vt.vendor_type,vc.vendor_category FROM vendor v, vendor_type vt, vendor_category vc WHERE v.vendor_type_id = vt.vendor_type_id AND v.vendor_category_id = vc.vendor_category_id AND v.status!=2 ORDER BY v.points $ascdec LIMIT $slimit	")->result_array();
		$data['tl'] = $tl;
		$this->load->view('dashboard/supplier_point', $data);
	}

	public function getQuoteList()
	{
		//$qpid = $_POST['qpid'];
		$quid = $_POST['quid'];
		$qqtr = $_POST['qqtr'];
		$fy = $_POST['fy'];

		if($quid!='')
		{
			$quser = ' AND l.lead_assigned_to = '.$quid;
		}
		else
		{
			$quser = '';
		}

		if ($fy != '') {
			$exp = explode('-', $fy);
			$y1 = $exp[0];
			$y2 = $exp[1];

		    if ($qqtr == '') {
		      $fy_1 = $y1.'-04-01';
		      $fy_2 = $y2.'-03-31';
		      $date_filt = "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
		    }
		    else {
		      $get_quarter_period = $this->Dashboard_model->get_single_quarter_year_by_id($qqtr);
		      $s_y = $get_quarter_period->start_month_date;
		      $e_y = $get_quarter_period->end_month_date;
		      if ($qqtr != 4) {
		        $fy_1 = $y1.'-'.$s_y;
		        $fy_2 = $y1.'-'.$e_y;  
		        $date_filt = "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
		      }
		      else {
		        $fy_1 = $y2.'-'.$s_y;
		        $fy_2 = $y2.'-'.$e_y;  
		        $date_filt = "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')"; 
		      }
		      
		    }
		    
		}
		else {
			$date_filt = "";
		}
		$day_filt = $_POST['day_filt'];
		$dt_range = $_POST['dtrange'];
		  if ($day_filt == 'today') {
		    $day_filt = "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') = CURDATE()";
		  }
		  elseif ($day_filt == 'thisweek') {
		    $day_filt = "AND YEARWEEK(STR_TO_DATE(q.valid_till, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
		  }
		  elseif ($day_filt == 'thismonth') {
		    $day_filt = "AND MONTH(STR_TO_DATE(q.valid_till, '%Y-%m-%d')) = MONTH(CURDATE())";
		  }
		  elseif ($day_filt == 'thisyear') {
		    $finstart = $_SESSION['finstart'];
		    $finend = $_SESSION['finend'];
		    $day_filt = "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
		  }
		  elseif ($day_filt == 'thisDate') {
		    if ($dt_range != '') {
		      $dr = explode(' / ', $dt_range);

		      $fd = explode('-', $dr[0]);
		      $td = explode('-', $dr[1]);

		      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
		      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
		      $day_filt = "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		    }
		    else {
		      $day_filt = '';
		    }
		  }  
		

		//echo "SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,l.lead_name,qs.quote_stage,l.lead_assigned_to FROM `quote` q, exporter e, leads l, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND q.status!=2 $quser AND  STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') GROUP BY q.parent_quote_id ORDER BY qid DESC";exit;

		$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,l.lead_name,qs.quote_stage,l.lead_assigned_to FROM `quote` q, exporter e, leads l, quote_stage qs, contact_book cb WHERE cb.contact_book_id = l.contact_book_id AND q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND q.status!=2 $quser $date_filt $day_filt GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

		$this->load->view('dashboard/quote_list', $data);
	}

	public function getQuoteQuatList()
	{
		$data['quid'] = $quid = $_POST['quid'];
		$data['fy'] = $fy = $_POST['fy'];

		if($quid!='')
		{
			$quser = ' AND u.user_id = '.$quid;
		}
		else
		{
			$quser = '';
		}

		if($fy!='')
		{
			$yr = explode('-', $fy);
			$fdate = $yr[0].'-04-01';
			$tdate = $yr[1].'-03-31';
		}

		$data['user_industry_list'] = $this->db->query("SELECT i.* FROM industries i, products p,user_products up,users u WHERE i.industry_id = p.industry_id AND p.product_id = up.product_id AND up.user_id = u.user_id $quser GROUP BY i.industry_id ")->result_array();

		$this->load->view('dashboard/quote_industry_list', $data);
	}
	public function getQuoteQuatListTar()
	{
		$data['quid'] = $quid = $_POST['quid'];
		$data['fy'] = $fy = $_POST['fy'];
		$data['filt_industry_id'] = $filt_industry_id = $_POST['industry_id'];
		if($quid!='')
		{
			$quser = ' AND u.user_id = '.$quid;
		}
		else
		{
			$quser = '';
		}

		if($fy!='')
		{
			$yr = explode('-', $fy);
			$fdate = $yr[0].'-04-01';
			$tdate = $yr[1].'-03-31';
		}
		

		// $data['user_industry_list'] = $this->db->query("SELECT i.*,p.product_id, p.product_name FROM industries i, products p,user_products up,users u WHERE i.industry_id = p.industry_id AND p.product_id = up.product_id AND up.user_id = u.user_id $quser GROUP BY i.industry_id ")->result_array();
		if ($data['quid'] == '') {
			if ($filt_industry_id != '') {
				$data['user_products_list'] = $this->Dashboard_model->get_product_by_industry_id($filt_industry_id);
			}
			else {
				$data['user_products_list'] = $this->db->query("SELECT p.* FROM products p WHERE p.status != 2")->result();
			}
		}
		else {
			$data['user_products_list'] = $this->Dashboard_model->get_products_by_user_allocated($data['quid']);
		}
		$this->load->view('dashboard/quote_industry_list_tar', $data);
	}

	public function getPIBOList()
	{
		$data['quid'] = $quid = $_POST['quid'];
		$data['fy'] = $fy = $_POST['fy'];

		if($quid!='')
		{
			$quser = ' AND l.lead_assigned_to = '.$quid;
		}
		else
		{
			$quser = '';
		}

		if($fy!='')
		{
			$yr = explode('-', $fy);
			$fdate = $yr[0].'-04-01';
			$tdate = $yr[1].'-03-31';
		}

		$data['pi_tot'] = $this->db->query("SELECT  
      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 01) AS m1_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 02) AS m2_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 03) AS m3_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 04) AS m4_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 05) AS m5_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 06) AS m6_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 07) AS m7_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 08) AS m8_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 09) AS m9_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 10) AS m10_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 11) AS m11_ach_val,

      (SELECT SUM(pi.grand_total) FROM proforma_invoice pi,leads l WHERE pi.lead_id = l.lead_id $quser AND STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(pi.proforma_invoice_date, '%Y-%m-%d')) = 12) AS m12_ach_val

      FROM proforma_invoice GROUP BY m1_ach_val")->row();

	
		$data['bo_tot'] = $this->db->query("SELECT  
      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 01) AS bo1_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 02) AS bo2_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 03) AS bo3_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 04) AS bo4_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 05) AS bo5_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 06) AS bo6_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 07) AS bo7_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 08) AS bo8_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 09) AS bo9_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 10) AS bo10_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 11) AS bo11_ach_val,

      (SELECT SUM(bo.grand_total) FROM buyer_order bo,leads l WHERE bo.lead_id = l.lead_id $quser AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') AND MONTH(STR_TO_DATE(bo.order_date, '%Y-%m-%d')) = 12) AS bo12_ach_val

      FROM buyer_order GROUP BY bo1_ach_val")->row();


		$this->load->view('dashboard/po_bo_chart', $data);
	}

	//jegan
	public function funnel_dashboard_dynamic()
	{
		$user = $this->input->post('user');
		$product = $this->input->post('product');
		$raw_yr = $this->input->post('year');
		$exp_yr = explode('-', $raw_yr);
		$yr1 = $exp_yr[0];
		$yr2 = $exp_yr[1];

		$funnel_counts = $this->Dashboard_model->get_funnel_report_counts($yr1,$yr2,$user,$product);

		echo $funnel_counts->lead_count.'|'.$funnel_counts->opportunity_count.'|'.$funnel_counts->quotation_count.'|'.$funnel_counts->proforma_invoice_count.'|'.$funnel_counts->order_count;
	}
	public function product_dashboard_dynamic()
	{
		$dashboard_settings_info = get_dashboard_settings_info();
		$top_or_least = $this->input->post('top_or_least');
		$raw_yr = $this->input->post('year');
		$exp_yr = explode('-', $raw_yr);
		$yr1 = $exp_yr[0];
		$yr2 = $exp_yr[1];
		$top_least_count = $dashboard_settings_info->max_product_count;
		$get_top_least_product = $this->Dashboard_model->get_top_least_product($top_or_least,$yr1,$yr2,$top_least_count);
		echo json_encode($get_top_least_product);
	}
	public function leadsource_dashboard_dynamic()
	{
		$dashboard_settings_info = get_dashboard_settings_info();
		$top_or_least = $this->input->post('top_or_least');
		$raw_yr = $this->input->post('year');
		$exp_yr = explode('-', $raw_yr);
		$yr1 = $exp_yr[0];
		$yr2 = $exp_yr[1];
		$top_least_count = $dashboard_settings_info->max_lead_source_count;
		$get_top_least_ls = $this->Dashboard_model->get_top_least_lead_source($top_or_least,$yr1,$yr2,$top_least_count);
		$ls_chart_array = array();
		foreach ($get_top_least_ls as $ls_filt) {
			$ls_chart_array[] = array('name' => $ls_filt['lead_source'],'y' => $ls_filt['lead_source_counts']);
		}

		echo json_encode($ls_chart_array, JSON_NUMERIC_CHECK);
		// print_r($ls_chart_array);
		// die();
		// echo json_encode($ls_chart_array);
	}
	public function get_dynamic_opportunity_based_on_industry()
	{
		$sales_user = $this->input->post('sale_user');
		$raw_yr = $this->input->post('year');
		$industry_id = $this->input->post('industry_id');
		$lead_status_id = $this->input->post('lead_status_id');

		$day_filt = $this->input->post('day_filt');
		$dt_range = $this->input->post('date_range');
		$quarter = $this->input->post('quarter');
		$data['quarter'] = $quarter;
		$data['day_filt'] = $day_filt;
		$data['dt_range'] = $dt_range;
		if (!empty($lead_status_id)) {
			if (count($lead_status_id) > 1) {
			    $ls_query = '';
			    for ($i=0; $i < count($lead_status_id); $i++) { 
			          $ls_query .= "ls.oppo_status_id = ".$lead_status_id[$i]." OR ";
			    }
			    $trimmed = rtrim($ls_query);
			    $get_query = rtrim($trimmed, 'OR');
			    $ls_filt = "AND ($get_query)";
			    $data['oppo_status_lists'] = $this->Dashboard_model->get_lead_status_by_id($ls_filt);
			}
			else {
				$ls_filt = "AND ls.oppo_status_id = '$lead_status_id[0]'";
				$data['oppo_status_lists'] = $this->Dashboard_model->get_lead_status_by_id($ls_filt);
			}
		}
		else {
			$data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		}
		if ($raw_yr != '') {
			$exp_yr = explode('-', $raw_yr);
			$yr1 = $exp_yr[0];
			$yr2 = $exp_yr[1];	
		}
		else {
			$yr1 = '';  
			$yr2 = '';	
		}
		
		$data['sale_user'] = $sales_user;
		$data['financial_year_to'] = $yr2;
        $data['financial_year_from'] = $yr1;
		// $data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		if ($_SESSION['admindata']['user_hasnt_product'] == 1) {
			if ($sales_user == '') {
				if ($industry_id == '') {
					$data['get_all_product'] = $this->Dashboard_model->get_all_product();
				}
				else {
					$data['get_all_product'] = $this->Dashboard_model->get_product_by_industry_id($industry_id);
				}
			}
			else {
				$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($sales_user);
			}
		}
		else {
			$userid = $_SESSION['admindata']['user_id'];
			$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($userid);
		}
		$this->load->view('dashboard/get_opportunity_based_industry',$data);
	}
	public function get_lead_noti_filt()
	{
		$assign_person = $this->input->post('assign_person');
		$product = $this->input->post('product');
		$dashboard_settings_info = get_dashboard_settings_info();

		$data['lead_notifications'] = $this->Dashboard_model->get_lead_followup_notification_before_three_days_and_missed_by_filt($dashboard_settings_info->lead_days_after, $assign_person, $product);

		$this->load->view('dashboard/lead_notification_filter',$data);
	}
	public function lead_notification_page()
	{
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		$data['get_all_product'] = $this->Dashboard_model->get_all_product();
		$dashboard_settings_info = get_dashboard_settings_info();
		$data['lead_notifications'] = $this->Dashboard_model->get_lead_followup_notification_before_three_days_and_missed($dashboard_settings_info->lead_days_after);
		$this->load->view('dashboard/lead_notification_page',$data);
	}
	public function joborder_notification_page()
	{
		$data['employee_list'] = $this->Joborder_model->get_active_employee_list();
		$data['get_all_product'] = $this->Dashboard_model->get_all_product();
		$this->load->view('dashboard/joborder_notification_page',$data);
	}
	public function buyerorder_notification_page()
	{
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		$data['get_all_product'] = $this->Dashboard_model->get_all_product();
		$this->load->view('dashboard/buyerorder_notification_page',$data);
	}
	public function lessreply_notification_page()
	{
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		$data['get_all_product'] = $this->Dashboard_model->get_all_product();
		$this->load->view('dashboard/lessreply_notification_page',$data);
	}
	public function get_joborder_noti_filt()
	{
		$assign_person = $this->input->post('assign_person');
		$product = $this->input->post('product');
		$dashboard_settings_info = get_dashboard_settings_info();

		$data['joborder_notifications'] = $this->Dashboard_model->get_incomplete_joborder_notificaiton_before_enddate_by_filt($dashboard_settings_info->jo_days_before, $assign_person, $product);
		$this->load->view('dashboard/joborder_notification_filter',$data);	
	}
	public function get_buyerorder_noti_filt()
	{
		$assign_person = $this->input->post('assign_person');
		$product = $this->input->post('product');
		$dashboard_settings_info = get_dashboard_settings_info();

		$data['buyerorder_notifications'] = $this->Dashboard_model->get_incomplete_buyerorder_notificaiton_before_enddate_by_filt($dashboard_settings_info->bo_days_before, $assign_person, $product);
		$this->load->view('dashboard/buyerorder_notification_filter',$data);		
	}
	public function get_lessmail_reply_noti_filt()
	{
		$assign_person = $this->input->post('assign_person');
		$product = $this->input->post('product');

		$data['lessmail_reply_notifications'] = $this->Dashboard_model->get_lessmail_reply_notifications_by_filt($assign_person, $product);
		$this->load->view('dashboard/lessreply_notification_filter',$data);	
	}
	public function get_dynamic_quote_based_on_industry()
	{

		$raw_yr = $this->input->post('year');
		$quote_industry = $this->input->post('quote_industry');
		$quote_stage = $this->input->post('quote_stage');
		if ($raw_yr != '') {
			$exp_yr = explode('-', $raw_yr);
			$data['yr1'] = $exp_yr[0];
			$data['yr2'] = $exp_yr[1];
		}
		else {
			$data['yr1'] = '';
			$data['yr2'] = '';	
		}
				
		$day_filt = $this->input->post('day_filt');
		$dt_range = $this->input->post('date_range');
		$quarter = $this->input->post('quarter');
		$data['quarter'] = $quarter;
		$data['day_filt'] = $day_filt;
		$data['dt_range'] = $dt_range;
		$data['sale_user'] = $this->input->post('sale_user');
		
		if (!empty($quote_stage)) {
			if (count($quote_stage) > 1) {
			    $quote_stage_query = '';
			    for ($i=0; $i < count($quote_stage); $i++) { 
			          $quote_stage_query .= "qs.quote_stage_id = ".$quote_stage[$i]." OR ";
			    }
			    $trimmed = rtrim($quote_stage_query);
			    $get_query = rtrim($trimmed, 'OR');
			    $quote_stage_filt = "AND ($get_query)";
			    $data['quote_stage_list'] = $this->Dashboard_model->get_quote_stage_by_id($quote_stage_filt);
			}
			else {
				$quote_stage_filt = "AND qs.quote_stage_id = '$quote_stage[0]'";
				$data['quote_stage_list'] = $this->Dashboard_model->get_quote_stage_by_id($quote_stage_filt);
			}	
		}
		else {
			$data['quote_stage_list'] = array_reverse($this->Quotestage_model->get_quote_stage_list());
		}
		
		if ($_SESSION['admindata']['user_hasnt_product'] == 1)
		{
			if ($data['sale_user'] == '') {
				if ($quote_industry == '') {
					$data['get_all_product'] = $this->Dashboard_model->get_all_product();
				}
				else {
					$data['get_all_product'] = $this->Dashboard_model->get_product_by_industry_id($quote_industry);
				}
			}
			else {
				$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($data['sale_user']);
			}
		}
		else {
			$userid = $_SESSION['admindata']['user_id'];
			$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($userid);
		}
			$this->load->view('dashboard/get_quote_based_quote_stage',$data);
		
	}
	public function get_dynamic_pi_based_on_pi_stage()
	{
		$raw_yr = $this->input->post('year');
		$quote_industry = $this->input->post('pi_industry');
		$pi_stage_id = $this->input->post('pi_stage_id');
		if ($raw_yr != '') {
			$exp_yr = explode('-', $raw_yr);
			$data['yr1'] = $exp_yr[0];
			$data['yr2'] = $exp_yr[1];	
		}
		else {
			$data['yr1'] = '';
			$data['yr2'] = '';	
		}

		$day_filt = $this->input->post('day_filt');
		$dt_range = $this->input->post('date_range');
		$quarter = $this->input->post('quarter');
		$data['quarter'] = $quarter;
		$data['day_filt'] = $day_filt;
		$data['dt_range'] = $dt_range;

		$data['sale_user'] = $this->input->post('sale_user');
		if (!empty($pi_stage_id)) {
			if (count($pi_stage_id) > 1) {
			    $pi_stage_id_query = '';
			    for ($i=0; $i < count($pi_stage_id); $i++) { 
			          $pi_stage_id_query .= "pi.pi_stage_id = ".$pi_stage_id[$i]." OR ";
			    }
			    $trimmed = rtrim($pi_stage_id_query);
			    $get_query = rtrim($trimmed, 'OR');
			    $pi_stage_id_filt = "AND ($get_query)";
			    $data['pi_stage_list'] = $this->Dashboard_model->get_pi_stage_by_id($pi_stage_id_filt);
			}
			else {
				$pi_stage_id_filt = "AND pi.pi_stage_id = '$pi_stage_id[0]'";
				$data['pi_stage_list'] = $this->Dashboard_model->get_pi_stage_by_id($pi_stage_id_filt);
			}
		}
		else {
			$data['pi_stage_list'] = $this->PI_Stage_model->get_pi_stage_list();
		}
		if ($_SESSION['admindata']['user_hasnt_product'] == 1)
		{
			if ($data['sale_user'] == '') {
				if ($quote_industry == '') {
					$data['get_all_product'] = $this->Dashboard_model->get_all_product();
				}
				else {
					$data['get_all_product'] = $this->Dashboard_model->get_product_by_industry_id($quote_industry);
				}
			}
			else {
				$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($data['sale_user']);	
			}
		}
		else {
			$userid = $_SESSION['admindata']['user_id'];
			$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($userid);	
		}
		
		$this->load->view('dashboard/get_pi_based_pistage',$data);
	}
	public function get_dynamic_lead_based_on_product()
	{	
		$raw_yr = $this->input->post('year');
		$industry_id = $this->input->post('industry_id');
		$ls = $this->input->post('lead_source');
		$day_filt = $this->input->post('day_filt');
		$dt_range = $this->input->post('date_range');
		$quarter = $this->input->post('quarter');
		$data['quarter'] = $quarter;
		$data['day_filt'] = $day_filt;
		$data['dt_range'] = $dt_range;
		if (!empty($ls)) {
			if (count($ls) > 1) {
			    $ls_query = '';
			    for ($i=0; $i < count($ls); $i++) { 
			          $ls_query .= "ls.lead_source_id = ".$ls[$i]." OR ";
			    }
			    $trimmed = rtrim($ls_query);
			    $get_query = rtrim($trimmed, 'OR');
			    $ls_filt = "AND ($get_query)";
			    $data['lead_sources'] = $this->Dashboard_model->get_lead_source_by_id($ls_filt);
			}
			else {
				$ls_filt = "AND ls.lead_source_id = '$ls[0]'";
				$data['lead_sources'] = $this->Dashboard_model->get_lead_source_by_id($ls_filt);
			}
		}
		else {
			$data['lead_sources'] = $this->Lead_model->lead_source_list();
		}
		// $quote_product = $this->input->post('pi_product');
		if ($raw_yr != '') {
			$exp_yr = explode('-', $raw_yr);
			$data['yr1'] = $exp_yr[0];
			$data['yr2'] = $exp_yr[1];
		}
		else {
			$data['yr1'] = '';
			$data['yr2'] = '';
		}
				
		$data['sale_user'] = $this->input->post('sale_user');

		if($_SESSION['admindata']['user_hasnt_product'] == 1) {
			if ($data['sale_user'] == '') {
				if ($industry_id == '') {
					$data['get_all_product'] = $this->Dashboard_model->get_all_product();
				}
				else {
					$data['get_all_product'] = $this->Dashboard_model->get_product_by_industry_id($industry_id);
				}
			}
			else {
				$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($data['sale_user']);
				
			}
		}
		else{
			$userid = $_SESSION['admindata']['user_id'];
			$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($userid);
		} 

			$this->load->view('dashboard/get_lead_based_product',$data);	
	}
}
?>