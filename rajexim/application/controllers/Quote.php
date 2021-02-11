<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time',259200);
require_once 'dompdf/autoload.inc.php';


/* reference the Dompdf namespace */

use Dompdf\Dompdf;
class Quote extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Quote_model','Proformainvoice_model','Product_model','Buyerorder_model','Lead_model','Productcosting_model','User_model'));
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
		$data['country_lists'] = $this->Lead_model->country_list();
      	$data['user_list'] = $this->Lead_model->product_assigned_users();
      	$data['quote_stage_list'] = $this->Quote_model->get_quote_stage_list();
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
      	$data['dtrange_from'] = '';
		$data['dtrange_to'] = '';
		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$user_id = $this->input->post('quo_sales_user');
      		$qsid = $this->input->post('quo_stage_filt');

			if($user_id !='')
			{
				$uid = " AND l.lead_assigned_to = '$user_id'";
			}
			else
			{
				$uid = '';
			}

			if($qsid !='')
			{
				$qstgid = " AND q.quote_stage_id = '$qsid'";
			}
			else
			{
				$qstgid = '';
			}

			$data['quo_users'] = $user_id;
      		$data['quo_stage'] = $qsid;
    		$fbase = $this->input->post('fbase');
    		$data['fbasesearch'] = $fbase;

    		if($fbase == '')
    		{
    			$data['purchasesearch'] = '';
				$data['drnge'] = '';
    			$data['fquartersearch'] = '';
    			//$data['ypick'] = '';
				$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 $uid $qstgid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
    		}
    		else if($fbase == 'BonQuarter')
    		{
    			$btn = $this->input->post('goButtonboq');
    			$fqtr = $this->input->post('fquarter');
    			$yrange = $this->input->post('ypick');

    			$data['fquartersearch'] = $fqtr;
    			$data['ypick'] = $yrange;

    			if($fqtr == '') 
    			{
    				$yr = explode('-', $yrange);

					$fdate = $yr[0].'-04-01';
					$tdate = $yr[1].'-03-31';
    				$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $qstgid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
    			}
    			else
    			{
    				$yr = explode('-', $yrange);
    				if($fqtr=='Q1')
    				{
    					$fdate = $yr[0].'-04-01';
						$tdate = $yr[0].'-06-30';
    				}
    				else if($fqtr=='Q2')
    				{
    					$fdate = $yr[0].'-07-01';
						$tdate = $yr[0].'-09-30';
    				}
    				else if($fqtr=='Q3')
    				{
    					$fdate = $yr[0].'-10-01';
						$tdate = $yr[0].'-12-31';
    				}
    				else
    				{
    					$fdate = $yr[1].'-01-01';
						$tdate = $yr[1].'-03-31';
    				}
    				$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $qstgid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
    			}

    			$data['purchasesearch'] = '';
				$data['drnge'] = '';
    			//else if()
    		}
    		else
    		{
	    		$btn = $this->input->post('goButton');
				$schange = $this->input->post('searchChange');
				//echo $schange;
				$dtrange_from = $this->input->post('dtrange_from');
				$dtrange_to = $this->input->post('dtrange_to');

				if ($dtrange_from != '' && $dtrange_to != '') {
					$dtrange = $dtrange_from.' - '.$dtrange_to;
				}
				else {
					$dtrange = '';	
				}
				if($btn=='')
				{
					$dtrange='';
				}
				if($schange == '')
	        		$schange='';

	        	if($schange == '')
				{
					//SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 GROUP BY q.parent_quote_id ORDER BY qid DESC
					$data['drnge'] = '';
					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 $uid $qstgid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') = CURDATE() $uid $qstgid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND YEARWEEK(STR_TO_DATE(q.valid_till, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $uid $qstgid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND MONTH(STR_TO_DATE(q.valid_till, '%Y-%m-%d')) = MONTH(CURDATE()) $uid $qstgid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $uid $qstgid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
				}
				else
				{
					$data['drnge'] = $dtrange;
					$data['dtrange_from'] = $dtrange_from;
					$data['dtrange_to'] = $dtrange_to;
					$dr = explode(' - ', $dtrange);

					$fd = explode('/', $dr[0]);
					$td = explode('/', $dr[1]);

					$fdate = $fd[2].'-'.$fd[0].'-'.$fd[1];
					$tdate = $td[2].'-'.$td[0].'-'.$td[1];
					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $qstgid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
				}
				//echo $schange;exit;
				$data['purchasesearch'] = $schange;
				$data['drnge'] = $dtrange;
    			$data['fquartersearch'] = '';
    			//$data['ypick'] = '';
			}
    	}
    	else
    	{
    		$data['fbasesearch'] = 'BonQuarter';
    		$data['purchasesearch'] = '';
			$data['drnge'] = '';
			$data['fquartersearch'] = '';
			$data['quo_users'] = '';
      		$data['quo_stage'] = '';
			//$data['ypick'] = '';
			$yrange = $this->input->post('ypick');
			$yr = explode('-', $yrange);
			$cmonth = date('m');
			if($cmonth=='04' || $cmonth=='05' || $cmonth=='06')
			{
				$fqtr = 'Q1';
			}
			else if($cmonth=='07' || $cmonth=='08' || $cmonth=='09')
			{
				$fqtr = 'Q2';
			}
			else if($cmonth=='10' || $cmonth=='11' || $cmonth=='12')
			{
				$fqtr = 'Q3';
			}
			else
			{
				$fqtr = 'Q4';
			}

			$data['fquartersearch'] = $fqtr;
			$data['quote_list'] = $this->Quote_model->get_quote_list();
		}
		$this->load->view('quote/quote_list', $data);
	}
	public function quote_list_filter_base()
	{
		// $data['perpage'] = $perpage = 10;

		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
		if ($search_val != '') {
			$sc = ' AND (q.quote_no LIKE "%'.$search_val.'%" OR c.lead_name LIKE "%'.$search_val.'%" OR qs.quote_stage LIKE "%'.$search_val.'%" OR e.exporter_name LIKE "%'.$search_val.'%" OR q.subject LIKE "%'.$search_val.'%")';
		}
		else {
			$sc = '';
		}
		$data['user_list'] = $this->Buyerorder_model->get_user_list();
      	$data['quote_stage_list'] = $this->Quote_model->get_quote_stage_list();
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$country_id = $this->input->post('country_id');
    		$user_id = $this->input->post('quo_sales_user');
      		$qsid = $this->input->post('quo_stage_filt');

			if($country_id !='')
			{
				$cid = " AND c.country = '$country_id'";
			}
			else
			{
				$cid = '';
			}

			if($user_id !='')
			{
				if($user_id != 0) {
					$uid = " AND l.lead_assigned_to = '$user_id'";
				}
				else {
					$user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

				    if($user_details->show_leads == 1)
				    {
				      $uid == '';
				    }
				    else if($user_details->show_leads == 2)
				    {
				      $uid = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
				    }
				    else if($user_details->show_leads == 3 && $user_details->product_users != '')
				    {
				      $uid = " AND (FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."') OR l.lead_assigned_to = '".$_SESSION['admindata']['user_id']."')";
				    }else{
				        $uid = '';
				    }
				}
			}
			else
			{
				$uid = '';
			}

			if($qsid !='')
			{
				$qstgid = " AND q.quote_stage_id = '$qsid'";
			}
			else
			{
				$qstgid = '';
			}

			$data['quo_users'] = $user_id;
      		$data['quo_stage'] = $qsid;
    		$fbase = $this->input->post('fbase');
    		$data['fbasesearch'] = $fbase;

    		if($fbase == '')
    		{
    			$data['purchasesearch'] = '';
				$data['drnge'] = '';
    			$data['fquartersearch'] = '';
    			//$data['ypick'] = '';
    			$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

				$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
    		}
    		else if($fbase == 'BonQuarter')
    		{
    			$btn = $this->input->post('goButtonboq');
    			$fqtr = $this->input->post('fquarter');
    			$yrange = $this->input->post('ypick');

    			$data['fquartersearch'] = $fqtr;
    			$data['ypick'] = $yrange;

    			if($fqtr == '') 
    			{
    				$yr = explode('-', $yrange);

					$fdate = $yr[0].'-04-01';
					$tdate = $yr[1].'-03-31';
					$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    				$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
    			}
    			else
    			{
    				$yr = explode('-', $yrange);
    				if($fqtr=='Q1')
    				{
    					$fdate = $yr[0].'-04-01';
						$tdate = $yr[0].'-06-30';
    				}
    				else if($fqtr=='Q2')
    				{
    					$fdate = $yr[0].'-07-01';
						$tdate = $yr[0].'-09-30';
    				}
    				else if($fqtr=='Q3')
    				{
    					$fdate = $yr[0].'-10-01';
						$tdate = $yr[0].'-12-31';
    				}
    				else
    				{
    					$fdate = $yr[1].'-01-01';
						$tdate = $yr[1].'-03-31';
    				}
    				$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

    				$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
    			}

    			$data['purchasesearch'] = '';
				$data['drnge'] = '';
    			//else if()
    		}
    		else
    		{
	    		$btn = $this->input->post('goButton');
				$schange = $this->input->post('searchChange');
				//echo $schange;
				$dtrange_from = $this->input->post('dtrange_from');
				$dtrange_to = $this->input->post('dtrange_to');

				if ($dtrange_from != '' && $dtrange_to != '') {
					$dtrange = $dtrange_from.' - '.$dtrange_to;
				}
				else {
					$dtrange = '';	
				}
				if($btn=='')
				{
					$dtrange='';
				}
				if($schange == '')
	        		$schange='';

	        	if($schange == '')
				{
					//SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 GROUP BY q.parent_quote_id ORDER BY qid DESC
					$data['drnge'] = '';
					$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';

					$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') = CURDATE() $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') = CURDATE() $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND YEARWEEK(STR_TO_DATE(q.valid_till, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND YEARWEEK(STR_TO_DATE(q.valid_till, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND MONTH(STR_TO_DATE(q.valid_till, '%Y-%m-%d')) = MONTH(CURDATE()) $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND MONTH(STR_TO_DATE(q.valid_till, '%Y-%m-%d')) = MONTH(CURDATE()) $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
				}
				else
				{
					$data['drnge'] = $dtrange;
					$data['dtrange_from'] = $dtrange_from;
					$data['dtrange_to'] = $dtrange_to;
					$dr = explode(' - ', $dtrange);

					$fd = explode('/', $dr[0]);
					$td = explode('/', $dr[1]);

					$fdate = $fd[2].'-'.$fd[0].'-'.$fd[1];
					$tdate = $td[2].'-'.$td[0].'-'.$td[1];
					$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();

					$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $qstgid $sc $cid GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
				}
				//echo $schange;exit;
				$data['purchasesearch'] = $schange;
				$data['drnge'] = $dtrange;
    			$data['fquartersearch'] = '';
    			//$data['ypick'] = '';
			}
    	}
    	else
    	{
    		$data['fbasesearch'] = '';
    		$data['purchasesearch'] = '';
			$data['drnge'] = '';
			$data['fquartersearch'] = '';
			$data['quo_users'] = '';
      		$data['quo_stage'] = '';
			//$data['ypick'] = '';
			// $data['quote_list'] = $this->Quote_model->get_quote_list();
			$data['quote_list_count'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 $sc GROUP BY q.parent_quote_id ORDER BY qid DESC")->result_array();
			$data['quote_list'] = $this->db->query("SELECT q.*,max(q.quote_id) as qid,q.quote_no,count(q.quote_id) as qcount ,q.parent_quote_id,e.exporter_name,c.lead_name,qs.quote_stage FROM `quote` q, exporter e, leads l, contact_book c, quote_stage qs WHERE q.exporter_id = e.exporter_id AND q.lead_id = l.lead_id AND q.quote_stage_id = qs.quote_stage_id AND l.contact_book_id = c.contact_book_id AND q.status!=2 $sc GROUP BY q.parent_quote_id ORDER BY qid DESC LIMIT $page, $perpage")->result_array();
		}
		// print_r($data['quote_list']);
		// die();
		// $str = $this->db->last_query();
		// print_r($str);
		// die();
		$this->load->view('quote/quote_list_table', $data);
	}
	public function quote_add()
	{
		$data['exporter_list'] = $this->Quote_model->get_exporter_list();
		$data['quote_stage_list'] = $this->Quote_model->get_quote_stage_list();
		$data['opportunity_list'] = $this->Quote_model->get_oppertunity_list();
		$data['vessel_flight_list'] = $this->Quote_model->get_vessel_flight_list();
		$data['port_list'] = $this->Quote_model->get_port_list();
		$data['price_term_list'] = $this->Quote_model->get_price_terms_list();
		$data['currency_list'] = $this->Quote_model->get_currency_list();
		$data['vendor_list'] = $this->Quote_model->get_vendor_list();
		$data['product_item_list'] = $this->Quote_model->get_product_item_list();
		$data['product_unit'] = $this->Product_model->get_product_unit();
		$financial_year_to2 = (date('m') > 3) ? date('y') +1 : date('y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$last_id_value = $this->Quote_model->quote_last_id();

      	$finhi = $financial_year_from2.'-'.$financial_year_to2;

	    if(count($last_id_value)==0)
	    {
	      //$ino = $data['invoice_no'] = date("Y").'/'.date('m').'/'.$locDetails->location_code.'/INV001';
	      $data['quote_no'] = 'QUO/'.$finhi.'/001';
	    }
	    else
	    {
	      $lno = $last_id_value->quote_no;
	      $exlno = explode('/', $lno);
	      if($finhi == $exlno[1])
	      {
	        //$valexp = explode('-', $exlno[0]);
	        $next_value = (int)$exlno[2] + 1;
	        $slen = strlen($next_value);
	        if($slen==1)
	          $nval = '00'.$next_value;
	        else if($slen==2)
	          $nval = '0'.$next_value;
	        else
	          $nval = $next_value;
	        $data['quote_no'] = 'QUO/'.$finhi.'/'.$nval;
	      }
	      else
	      {
	        $data['quote_no'] = 'QUO/'.$finhi.'/001';
	      }
		}

		$this->load->view('quote/quote_add', $data);
	}

	public function getExporterLogo()
	{
		$eid = $_POST['id'];
		$exporter_list = $this->Quote_model->get_exporter_by_id($eid);
		echo 'exporterlogo/'.str_replace(' ', '_', $exporter_list->exporter_logo);
	}

	public function getLeadDetails()
	{
		$lid = $_POST['id'];
		$lead_list = $this->Quote_model->lead_by_id($lid);
		echo $lead_list->company_name."|".$lead_list->country_name."|".$lead_list->address."|".$lead_list->email_id."|".$lead_list->contact_no."|".$lead_list->lead_assigned_name;
	}

	public function getLeadDetails1()
	{
		$lid = $_POST['id'];
		$lead_list = $this->Quote_model->lead_by_id($lid);
		echo $lead_list->company_name."|".$lead_list->country."|".$lead_list->address."|".$lead_list->email_id."|".$lead_list->contact_no."|".$lead_list->lead_assigned_name."|".$lead_list->office_phone_no;
	}

	public function getFromPort()
	{
		$vfid = $_POST['id'];
		$port_list = $this->Quote_model->get_port_by_vessel_flight_id($vfid);
		$option = '<option value="">Choose Port</option>';
		foreach($port_list as $plist)
		{
			$option.='<option value="'.$plist['port_id'].'">'.$plist['port_name'].' - '.$plist['port_city'].' - '.$plist['port_country'].'</option>';
		}
		echo $option;
	}

	public function getCurrencyCode()
	{
		$cid = $_POST['id'];
		$currency_list = $this->Quote_model->get_currency_by_id($cid);
		echo $currency_list->currency_code;
	}

	public function create_quote()
	{
        //echo "TEST";exit;
		$data['exporter_id'] = $this->input->post('exporter_id');
		$data['quote_no'] = $this->input->post('quote_no');
		$data['subject'] = $this->input->post('subject');
		$cdt = explode('/', $this->input->post('created_date'));
    	$data['created_date'] = $cdt[2].'-'.$cdt[0].'-'.$cdt[1];
		$vdt = explode('/', $this->input->post('valid_till'));
    	$data['valid_till'] = $vdt[2].'-'.$vdt[0].'-'.$vdt[1];
    	$data['quote_stage_id'] = $this->input->post('quote_stage_id');
    	$data['price_validity'] = $this->input->post('price_validity');
    	$data['lead_id'] = $this->input->post('lead_id');
    	$data['vessel_flight_id'] = $this->input->post('vessel_flight_id');
    	$data['from_port'] = $this->input->post('from_port');
    	$data['to_port'] = $this->input->post('to_port');
    	$data['price_term_id'] = $this->input->post('price_term_id');
    	$data['currency_id'] = $this->input->post('currency_id');
    	$data['rate'] = $this->input->post('ratec');
    	$data['grand_total'] = $this->input->post('grand_total');
    	$data['revised'] = 0;
    	$data['is_local'] = $this->input->post('is_local');
    	$last_id_value = $this->Quote_model->quote_last_id();
    	if(count($last_id_value)>0)
	    {
	      $last_value=$last_id_value->quote_id;
	      $data['parent_quote_id'] = $last_value+1;
	    }
	    else
	    {
	      $data['parent_quote_id'] = 1;
	    }
		$data['created_on'] = date('Y-m-d H:i:s');
    	$data['created_by'] = $_SESSION['admindata']['user_id'];


    	$data['product_costing_id'] = $this->input->post('prod_costing_id');
    	$stype = $data['stage_type'] = $this->input->post('stage_type');
    	if($stype=='cnf')
    	{
    		$data['stage_id'] = $this->input->post('stage_id');
    		$data['fob_stage_id'] = 0;
    	}
    	else
    	{
    		$data['stage_id'] = 0;
    		$data['fob_stage_id'] = $this->input->post('fob_stage_id');
    	}

    	$data['fobusdval'] = $this->input->post('fobusdval');
    	$data['fobinrval'] = $this->input->post('fobarrval');

	    $result = $this->Quote_model->create_quote($data);

	    if ($result) {
			$last_id_value = $this->Quote_model->quote_last_id();
			$last_value=$last_id_value->quote_id;
			$data1['quote_id'] = $last_value;

			$vid = explode(",",implode(",",$this->input->post('vendor_id')));
			$man = explode(",",implode(",",$this->input->post('marks_and_no')));
			$piid = explode(",",implode(",",$this->input->post('product_item_id')));
			$pidnid = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
			$skuid = explode(",",implode(",",$this->input->post('sku_unit_id')));
			$qty = explode(",",implode(",",$this->input->post('quantity')));
			$rate = explode(",",implode(",",$this->input->post('rate')));
			$amt = explode(",",implode(",",$this->input->post('amount')));
			$ttype = explode(",",implode(",",$this->input->post('tax_type')));
			$tpecent = explode(",",implode(",",$this->input->post('tax_percent')));
			$subcount = count($this->input->post('marks_and_no')); 
			
			for($i=0;$i<$subcount;$i++)
			{
				if($vid[$i]!='')
				{
					$data1['vendor_id'] = $vid[$i];
					$data1['marks_and_no'] = $man[$i];
					$data1['product_item_id'] = $piid[$i];
					$data1['product_item_display_name_id'] = $pidnid[$i]!=''?$pidnid[$i]:'0';
					$data1['sku_unit_id'] = $skuid[$i];
					$data1['quantity'] = $qty[$i];
					$data1['rate'] = $rate[$i];
					$data1['amount'] = $amt[$i];
					$data1['tax_type'] = $ttype[$i];
					$data1['tax_percent'] = $tpecent[$i];
					$this->Quote_model->create_quote_product($data1);
				}
			}
		}
		$this->session->set_flashdata('qstage_success', 'Quote has been added successfully.');
    	redirect('/quote');
	}	

	public function quote_edit($qid)
	{
		$data['exporter_list'] = $this->Quote_model->get_exporter_list();
		$data['quote_stage_list'] = $this->Quote_model->get_quote_stage_list();
		$data['opportunity_list'] = $this->Quote_model->get_oppertunity_list();
		$data['vessel_flight_list'] = $this->Quote_model->get_vessel_flight_list();
		$data['port_list'] = $this->Quote_model->get_port_list();
		$data['price_term_list'] = $this->Quote_model->get_price_terms_list();
		$data['currency_list'] = $this->Quote_model->get_currency_list();
		$data['vendor_list'] = $this->Quote_model->get_vendor_list();
		$data['product_item_list'] = $this->Quote_model->get_product_item_list();
		$data['product_unit'] = $this->Product_model->get_product_unit();

		$quote_list = $data['quote_list'] = $this->Quote_model->get_quote_by_id($qid);
		$data['quote_product_list'] = $this->Quote_model->get_quote_product_by_id($qid);

		$curlist = $this->Proformainvoice_model->get_currency_by_id($quote_list->currency_id);
		$data['curcode'] = $curlist->currency_code;

		$port_list = $this->Quote_model->get_port_by_vessel_flight_id($quote_list->vessel_flight_id);
		$option = '<option value="">Choose Port</option>';
		foreach($port_list as $plist)
		{
			if($quote_list->from_port == $plist['port_id'])
				$option.='<option value="'.$plist['port_id'].'" selected>'.$plist['port_name'].' - '.$plist['port_city'].' - '.$plist['port_country'].'</option>';
			else				
				$option.='<option value="'.$plist['port_id'].'">'.$plist['port_name'].' - '.$plist['port_city'].' - '.$plist['port_country'].'</option>';
		}
		$data['from_port'] = $option;


		$pcid = $quote_list->product_costing_id;
		$data['fobusdval'] = $fobusdval = $quote_list->fobusdval;
		$data['fobarrval'] = $fobarrval = $quote_list->fobinrval;
		$stage_id = $quote_list->stage_id;
		$fob_stage_id = $quote_list->fob_stage_id;
		$stage_type = $quote_list->stage_type;

		$fobusdvalarr = explode(',', $fobusdval);
		$fobvalarr = explode(',', $fobarrval);

		$pclist = $this->Productcosting_model->get_product_costing_by_id($pcid);
		$data['product_costing_list_parent'] = $this->Productcosting_model->get_product_costing_by_parent_id($pclist->parent_costing_id);

		$pstage = $this->Productcosting_model->get_product_costing_stage_by_product_costing_id($pcid);
		if(count($pstage)>0)
		{
		  $st = '<option value="">Select Stage</option>';
		  $stfob =  '<option value="">Select Stage</option>';
		  $s=0;foreach ($pstage as $ps) {
		  	if($s==$stage_id && $stage_type=='cnf')
		  	{
		    	$st.='<option value='.$s.' selected>'.$ps["stage_sku_name"].' - CNF : '.$fobusdvalarr[$s].'</option>';
		    }
		    else
		    {		    	
		    	$st.='<option value='.$s.'>'.$ps["stage_sku_name"].' - CNF : '.$fobusdvalarr[$s].'</option>';
		    }
		    if($s==$fob_stage_id && $stage_type=='fob')
		  	{
		    	$stfob.='<option value='.$s.' selected>'.$ps["stage_sku_name"].' - FOB : '.$fobvalarr[$s].'</option>';
		    }
		    else
		    {
		    	$stfob.='<option value='.$s.'>'.$ps["stage_sku_name"].' - FOB : '.$fobvalarr[$s].'</option>';
		    }
			$s++;}
		}
		else
		{
		  $st = '<option value="">No Stage Available</option>';
		  $stfob = '<option value="">No Stage Available</option>';
		}

		$data['pcstagelist'] = $st;
		$data['fobpcstagelist'] = $stfob;

		$this->load->view('quote/quote_edit', $data);
	}

	public function update_quote()
	{
		$qid = $this->input->post('quote_id');
		$data['exporter_id'] = $this->input->post('exporter_id');
		$qno = $this->input->post('qno');
		if(strpos($qno, ' - ') !== false)
	    {
	      $exp = explode(' - ', $qno);
	        $tval = $exp[1]+1;
	        $data['quote_no'] = $exp[0].' - '.$tval;
	    }
	    else
	    {
	      $data['quote_no'] = $qno.' - 1';
	    }

		$data['subject'] = $this->input->post('subject');
		$cdt = explode('/', $this->input->post('created_date'));
    	$data['created_date'] = $cdt[2].'-'.$cdt[0].'-'.$cdt[1];
		$vdt = explode('/', $this->input->post('valid_till'));
    	$data['valid_till'] = $vdt[2].'-'.$vdt[0].'-'.$vdt[1];
    	$data['quote_stage_id'] = $this->input->post('quote_stage_id');
    	$data['price_validity'] = $this->input->post('price_validity');
    	$data['lead_id'] = $this->input->post('lead_id');
    	$data['vessel_flight_id'] = $this->input->post('vessel_flight_id');
    	$data['from_port'] = $this->input->post('from_port');
    	$data['to_port'] = $this->input->post('to_port');
    	$data['price_term_id'] = $this->input->post('price_term_id');
    	$data['currency_id'] = $this->input->post('currency_id');
    	$data['rate'] = $this->input->post('ratec');
    	$data['grand_total'] = $this->input->post('grand_total');
    	$data['revised'] = 1;
    	$data['parent_quote_id'] = $this->input->post('parent_quote_id');
    	$data['is_local'] = $this->input->post('is_local');
    	/*$last_id_value = $this->Quote_model->quote_last_id();
    	if(count($last_id_value)>0)
	    {
	      $last_value=$last_id_value->quote_id;
	      $data['parent_quote_id'] = $last_value+1;
	    }
	    else
	    {
	      $data['parent_quote_id'] = 1;
	    }*/
		$data['created_on'] = date('Y-m-d H:i:s');
    	$data['created_by'] = $_SESSION['admindata']['user_id'];


    	$data['product_costing_id'] = $this->input->post('prod_costing_id');
    	$stype = $data['stage_type'] = $this->input->post('stage_type');
    	if($stype=='cnf')
    	{
    		$data['stage_id'] = $this->input->post('stage_id');
    		$data['fob_stage_id'] = 0;
    	}
    	else
    	{
    		$data['stage_id'] = 0;
    		$data['fob_stage_id'] = $this->input->post('fob_stage_id');
    	}

    	$data['fobusdval'] = $this->input->post('fobusdval');
    	$data['fobinrval'] = $this->input->post('fobarrval');
    	
	    $result = $this->Quote_model->create_quote($data);

	    if ($result) {
			$last_id_value = $this->Quote_model->quote_last_insert_id();
			$last_value=$last_id_value->quote_id;
			$data1['quote_id'] = $last_value;

			$vid = explode(",",implode(",",$this->input->post('vendor_id')));
			$man = explode(",",implode(",",$this->input->post('marks_and_no')));
			$piid = explode(",",implode(",",$this->input->post('product_item_id')));
			$pidnid = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
			$skuid = explode(",",implode(",",$this->input->post('sku_unit_id')));
			$qty = explode(",",implode(",",$this->input->post('quantity')));
			$rate = explode(",",implode(",",$this->input->post('rate')));
			$amt = explode(",",implode(",",$this->input->post('amount')));
			$ttype = explode(",",implode(",",$this->input->post('tax_type')));
			$tpecent = explode(",",implode(",",$this->input->post('tax_percent')));
			$subcount = count($this->input->post('marks_and_no')); 
			for($i=0;$i<$subcount;$i++)
			{
				if($vid[$i]!='')
				{
					$data1['vendor_id'] = $vid[$i];
					$data1['marks_and_no'] = $man[$i];
					$data1['product_item_id'] = $piid[$i];
					$data1['product_item_display_name_id'] = $pidnid[$i]!=''?$pidnid[$i]:'0';
					$data1['sku_unit_id'] = $skuid[$i];
					$data1['quantity'] = $qty[$i];
					$data1['rate'] = $rate[$i];
					$data1['amount'] = $amt[$i];
					$data1['tax_type'] = $ttype[$i];
					$data1['tax_percent'] = $tpecent[$i];
					$this->Quote_model->create_quote_product($data1);
				}
			}
		}
		$this->session->set_flashdata('qstage_success', 'Quote has been Revised successfully.');
    	redirect('/quote');
	}

	public function quote_view($id)
	{
		$quot['quote_id'] = $id;
		$quot['quotelist'] = $quotlist = $this->Quote_model->get_quote_by_id($id);
		$qcode = $quotlist->quote_no;

		if(strpos($qcode, ' - ') !== false)
		{
		  $exp = explode(' - ', $qcode);
		  $baseqno = $exp[0];
		  $rqno = $exp[0].' - ';
		}
		else
		{
		  $baseqno = $qcode;
		  $crev = $this->Quote_model->getCheckRevQuotation($baseqno);
		  if(count($crev)>0)
		    $rqno=$qcode.' - ';
		  else
		    $rqno='';
		}

		if($rqno!='')
		{
		  $quot['quote_list'] = $this->Quote_model->getViewRevQuotationList($baseqno,$rqno);
		}
		else
		{
		  $quot['quote_list'] = $this->Quote_model->getViewQuotationList($baseqno);
		}

		$this->load->view('quote/quote_view',$quot);
	}

	public function move_to_pi()
	{
		$parqid = $_POST['parqid'];

		$quotelist = $this->Quote_model->get_quote_by_parent_id($parqid);
		if(count($quotelist)>0)
		{
		  $st = '<option value="">Select Quote</option>';
		  foreach ($quotelist as $ps) {
		    $st.="<option value=".$ps['quote_id'].">".$ps['quote_no']."</option>";
			}
		}
		else
		{
		  $st = '<option value="">No Quote Available</option>';
		}
		$data['quote_list'] = $st;
		$this->load->view('quote/move_to_pi', $data);

	}

	public function proformainvoice_add()
	{
		$quote_id = $this->input->post('quote_id');

		$quotelist = $data['quotelist'] = $quotlist = $this->Quote_model->get_quote_by_id($quote_id);

		$data['quote_product_list'] = $this->Quote_model->get_quote_product_by_id($quote_id);

		$curlist = $this->Proformainvoice_model->get_currency_by_id($quotelist->currency_id);
		$data['curcode'] = $curlist->currency_code;
		
		$data['product_unit'] = $this->Product_model->get_product_unit();
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['exporter_list'] = $this->Proformainvoice_model->get_exporter_list();
		$data['pi_stage_list'] = $this->Proformainvoice_model->get_pi_stage_list();
		$data['opportunity_list'] = $this->Proformainvoice_model->get_oppertunity_list();
		$data['vessel_flight_list'] = $this->Proformainvoice_model->get_vessel_flight_list();
		$data['port_list'] = $this->Proformainvoice_model->get_port_list();
		$data['currency_list'] = $this->Proformainvoice_model->get_currency_list();
		$data['vendor_list'] = $this->Proformainvoice_model->get_vendor_list();
		$data['product_item_list'] = $this->Proformainvoice_model->get_product_item_list();
		$data['pre_carriage_by_list'] = $this->Proformainvoice_model->get_pre_carriage_by_list();
		$data['interest_list'] = $this->Proformainvoice_model->get_interests_list();
		$data['terms_and_payment_list'] = $this->Proformainvoice_model->get_terms_and_payment_list();
		$data['terms_of_payment_type_list'] = $this->Proformainvoice_model->get_terms_of_payment_type();
		$data['arbitration_list'] = $this->Proformainvoice_model->get_arbitrations_list();
		$data['declaration_list'] = $this->Proformainvoice_model->get_declaration_list();
		$data['document_required_list'] = $this->Proformainvoice_model->get_doc_req_list();
		$financial_year_to2 = (date('m') > 3) ? date('y') +1 : date('y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$last_id_value = $this->Proformainvoice_model->proforma_invoice_last_id();

      	$finhi = $financial_year_from2.'-'.$financial_year_to2;

	    if(count($last_id_value)==0)
	    {
	      //$ino = $data['invoice_no'] = date("Y").'/'.date('m').'/'.$locDetails->location_code.'/INV001';
	      $data['proforma_invoice_no'] = 'PI/'.$finhi.'/001';
	    }
	    else
	    {
	      $lno = $last_id_value->proforma_invoice_no;
	      $exlno = explode('/', $lno);
	      if($finhi == $exlno[1])
	      {
	        //$valexp = explode('-', $exlno[0]);
	        $next_value = (int)$exlno[2] + 1;
	        $slen = strlen($next_value);
	        if($slen==1)
	          $nval = '00'.$next_value;
	        else if($slen==2)
	          $nval = '0'.$next_value;
	        else
	          $nval = $next_value;
	        $data['proforma_invoice_no'] = 'PI/'.$finhi.'/'.$nval;
	      }
	      else
	      {
	        $data['proforma_invoice_no'] = 'PI/'.$finhi.'/001';
	      }
		}

		$bd_list = $this->Proformainvoice_model->get_bank_detail_by_currency_exporter_id($quotelist->currency_id,$quotelist->exporter_id);
		$bdoption = '<option value="">Choose Bank Detail</option>';
		foreach($bd_list as $plist)
		{	/*if($pi_list->bank_detail_id == $plist['bank_detail_id'])
				$bdoption.='<option value="'.$plist['bank_detail_id'].'" selected>'.$plist['bank_label'].'</option>';
			else*/
				$bdoption.='<option value="'.$plist['bank_detail_id'].'">'.$plist['bank_label'].'</option>';
		}
		$data['bdetail'] = $bdoption;

		$exporter_list = $this->Proformainvoice_model->get_exporter_by_id($quotelist->exporter_id);
		$data['gst_no'] = $exporter_list->gst_no;
		$data['iec_no'] = $exporter_list->iec_no;

		$port_list = $this->Quote_model->get_port_by_vessel_flight_id($quotelist->vessel_flight_id);
		$option = '<option value="">Choose Port</option>';
		foreach($port_list as $plist)
		{
			if($plist['port_id'] == $quotelist->from_port)
				$option.='<option value="'.$plist['port_id'].'" selected>'.$plist['port_name'].' - '.$plist['port_city'].' - '.$plist['port_country'].'</option>';
			else
				$option.='<option value="'.$plist['port_id'].'">'.$plist['port_name'].' - '.$plist['port_city'].' - '.$plist['port_country'].'</option>';
		}
		$data['from_port'] = $option;

		$this->load->view('quote/proforma_invoice_add', $data);
	}

	/*public function quote_pdf($qid)
	{
		$qlist = $this->Quote_model->get_quote_by_id($qid);
		$quote_product_list = $this->Quote_model->get_quote_product_by_id($qid);
		$date_format =common_date_format();

        $html='<div class="row">
   <div class="col-lg-12">
      <h5 class="text-theme">Quote Details</h5><hr>
   </div>
   <div class="col-lg-12">
      <div class="text-center">
         <div style="border: 1px solid #ccc;padding: 5px;margin:0 auto;width: 20%;">
            <img src='.base_url().'exporterlogo/'.str_replace(' ', '_', $qlist->exporter_logo).' height="75" width="150"  alt="logo" style="object-fit: contain;">
         </div>
      </div>
   </div>';
   $html.='<div class="col-lg-12 mt_25px">
      <div class="row">
         <div class="col-lg-6">
            <label class="col-lg-4">Exporter</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->exporter_name.'</p>
         </div>
         <div class="col-lg-6">
            <label class="col-lg-4">Subject</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->subject.'</p>
         </div>
      </div>';
      $html.='<div class="row">
         <div class="col-lg-6">
            <label class="col-lg-4">Quote Duration</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.date($date_format, strtotime($qlist->created_date)).' / '.date($date_format, strtotime($qlist->valid_till)).'</p>
         </div>
         <div class="col-lg-6">
            <label class="col-lg-4">Quote Stage</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->quote_stage.'</p>
         </div>
      </div>';
      $html.='<div class="row">
         <div class="col-lg-6">
            <label class="col-lg-4">Price validtity</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->price_validity.'</p>
         </div>
      </div>
   </div>
</div>';

$html.='<div class="row">
   <div class="col-lg-12">
      <h5 class="text-theme">Buyer Details</h5><hr>
   </div>
   <div class="col-lg-12">
      <div class="row">
         <div class="col-lg-6">
            <label class="col-lg-4">Contact Name</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->lead_name.'</p>
         </div>
         <div class="col-lg-6">
            <label class="col-lg-4">Organization</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->company_name!=''?$qlist->company_name:'-'.'</p>
         </div>
      </div>';
      $html.='<div class="row">
         <div class="col-lg-6">
            <label class="col-lg-4">Address</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->address!=''?$qlist->address:'-'.'</p>
         </div>
         <div class="col-lg-6">
            <label class="col-lg-4">Country</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->country_name!=''?$qlist->country_name:'-'.'</p>
         </div>
      </div>';
      $html.='<div class="row">
         <div class="col-lg-6">
            <label class="col-lg-4">Email ID</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->email_id!=''?$qlist->email_id:'-'.'</p>
         </div>
         <div class="col-lg-6">
            <label class="col-lg-4">Phone No</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->contact_no!=''?$qlist->contact_no:'-'.'</p>
         </div>
      </div>';
      $html.='<div class="row">
         <div class="col-lg-6">
            <label class="col-lg-4">Mobile No</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">-</p>
         </div>
         <div class="col-lg-6">
            <label class="col-lg-4">Assigned To</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->lead_assigned_name!=''?$qlist->lead_assigned_name:'-'.'</p>
         </div>
      </div>';
      echo $html;exit;
      $html.='<div class="row">
         <div class="col-lg-6">
            <label class="col-lg-4">Vessel / Flight </label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->vessel_flight_name!=''?$qlist->vessel_flight_name:'-'.' </p>
         </div>
         <div class="col-lg-6">
            <label class="col-lg-4">From Port</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->fpname.' - '.$qlist->fpcity.' - '.$qlist->fpcountry.'</p>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6">
            <label class="col-lg-4">To Port</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->tpname.' - '.$qlist->tpcity.' - '.$qlist->tpcountry.'</p>
         </div>
         <div class="col-lg-6">
            <label class="col-lg-4">Price Terms</label>
            <label class="col-lg-1">:</label>
            <p class="col-lg-7">'.$qlist->price_term_name.'</p>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <h5 class="text-theme">Item Details</h5><hr>
   </div>
</div>
<div class="row">
   <div class="col-lg-6">
      <label class="col-lg-4">Currency</label>
      <label class="col-lg-1">:</label>
      <p class="col-lg-7">'.$qlist->currency_name.' - '.$qlist->currency_code.'</p>
   </div>
   <div class="col-lg-6">
      <label class="col-lg-4">Rate</label>
      <label class="col-lg-1">:</label>
      <p class="col-lg-7">'.$qlist->rate.'</p>
   </div>
</div>';
$html.='<div class="row">
   <div class="col-lg-12">
      <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme m_table_2">
         <tr>
            <th>Mark & No</th>
            <th>Vendor Name</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Rate in '.$qlist->currency_code.'</th>
            <th>Amount in '.$qlist->currency_code.'</th>
         </tr>';
         $i=1;foreach($quote_product_list as $qprod){
            $html.='<tr>
               <td>'.$qprod['marks_and_no'].'</td>
               <td>'.$qprod['vendor_name'].'</td>
               <td>'.$qprod['product_name'].' - '.$qprod['product_item'].'</td>
               <td>
               	<span class="pull-left">'.$qprod['quantity'].'</span>
               </td>
               <td align="right">'.number_format($qprod['rate'],2).'</td>
               <td align="right">'.number_format($qprod['amount'],2).'</td>
            </tr>';
         $i++;}
      $html.='</table>
   </div>
</div>
<div class="row mt_25px">
   <div class="col-lg-12">
      <h4 class="text-green text-right">Grand Total : '.number_format($qlist->grand_total,2).'</h4>
   </div>
</div>';

print_r($html);exit;

		$file_pi_no = str_replace(' ', '_', str_replace('/', '_', str_replace(' - ', '_', $qlist->quote_no)));
	    //$html = preg_replace('/>\s+</', "><", $html);
	    $dompdf = new DOMPDF();
	    $dompdf->load_html($html);
	    $dompdf->set_paper('A4','portrait');
	    $dompdf->render();
	    // Output the generated PDF (1 = download and 0 = preview)
	    $dompdf->stream($file_pi_no.".pdf", array("Attachment"=>1));                                             



	}*/

	public function getItemSpec()
	{
		$piid = $_POST['id'];
		$product_item_list = $this->Quote_model->get_product_item_by_id($piid);

		$displayname = $this->Productcosting_model->get_product_item_display_name_by_id($piid);
		if(count($displayname)>0)
		{
		  $st = '<option value="">Select Display Name</option>';
		  foreach ($displayname as $prod) {
		    $st.='<option value='.$prod["product_item_display_name_id"].'>'.$prod["display_name"].'</option>';
			}
		}
		else
		{
		  $st = '<option value="">No Display Name</option>';
		}
		//echo $st;

		echo $product_item_list->product_item_spec.'||'.$st;
	}

	public function quote_approve()
	{
		$data['quote_id'] = $this->input->post('qid');
	    $data['is_approve'] = 1;
		$data['approved_by'] = $_SESSION['admindata']['user_id'];
	    $data['approved_date'] = date('Y-m-d H:i:s');
	    $result = $this->Quote_model->quote_approve($data);
	   $this->session->set_flashdata('qstage_success', 'Quote has been approved successfully...');
	   redirect('/quote');     

	}
	public function get_quote_comments_by_quote_id()
	{
		$quote_id = $this->input->post('quote_id');
		$data['view_from'] = $this->input->post('view_from');
		$data['quote_id'] = $quote_id;
		$data['quote_comments_list'] = $this->Quote_model->get_quote_comments_by_id($quote_id);
		$this->load->view('quote/quote_comment_modal',$data);
	}
	public function create_quote_comments()
	{
		$quote_id = $this->input->post('quote_id');
		$add_from = $this->input->post('comment_add_from');
		$comments = $this->input->post('comments');
		$c_by = $_SESSION['admindata']['user_id'];
		$c_on = date('Y-m-d H:i:s');
		$add_quote_comment = $this->Quote_model->add_quote_comment($quote_id,$comments,$c_on,$c_by);
		$update_quote_comment = $this->Quote_model->update_quote_comment($quote_id,$comments);
		if ($add_quote_comment == 1) {
			if ($add_from == "Quote") {
				$this->session->set_flashdata('qstage_success', 'Quote Comment Added successfully...');
	   			redirect('/quote');
			}
			else  {
				$this->session->set_flashdata('qstage_success', 'PI Comment Added successfully...');
	   			redirect('/Proformainvoice');
			}
		}
		else {
			if ($add_from == "Quote") {
				$this->session->set_flashdata('qstage_err', 'Quote Comment Fail to Add...');
	   			redirect('/quote');
			}
			else  {
				$this->session->set_flashdata('qstage_err', 'PI Comment Fail to Add...');
	   			redirect('/Proformainvoice');
			}
		}
	}
	public function quote_stage_change()
	{
		$quote_id = $this->input->post('quote_id');
		$value = $this->input->post('value');
		$type_val = $this->input->post('type_val');
		$update_quote_stage = $this->Quote_model->update_quote_stage($quote_id,$value,$type_val);
		echo 1;
	}
	
}
?>