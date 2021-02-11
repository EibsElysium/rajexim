<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time',259200);

class Buyerorder extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Buyerorder_model','Lead_model','Task_model','Mailbox_model','Productcosting_model','Product_model'));
		$this->load->model(array('Proformainvoice_model'));
		$this->load->model(array('Followupsheetcategory_model'));
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
		$data['dtrange_from'] = '';
		$data['dtrange_to'] = '';
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['user_list'] = $this->Buyerorder_model->get_user_list();
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$country_id = $this->input->post('country_id');
      		$product_id = $this->input->post('product_id');
      		$user_id = $this->input->post('user_id');

			if($country_id !='')
			{
				$cid = " AND l.country = '$country_id'";
			}
			else
			{
				$cid = '';
			}

			if($user_id !='')
			{
				$uid = " AND l.lead_assigned_to = '$user_id'";
			}
			else
			{
				$uid = '';
			}
			$data['f_l_country'] = $country_id;
      		$data['f_l_user'] = $user_id;

      		$fbase = $this->input->post('fbase');
    		$data['fbasesearch'] = $fbase;

    		if($fbase == '')
    		{
    			$data['purchasesearch'] = '';
				$data['drnge'] = '';
    			$data['fquartersearch'] = '';
    			//$data['ypick'] = '';

      			$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 $cid $uid ORDER BY bo.buyer_order_id DESC")->result_array();
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

    				$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid ORDER BY bo.buyer_order_id DESC")->result_array();
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
    				$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid ORDER BY bo.buyer_order_id DESC")->result_array();
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
					$data['drnge'] = '';
					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 $cid $uid ORDER BY bo.buyer_order_id DESC")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					
					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') = CURDATE() $cid $uid ORDER BY bo.buyer_order_id DESC")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					
					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND YEARWEEK(STR_TO_DATE(bo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid ORDER BY bo.buyer_order_id DESC")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					
					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND MONTH(STR_TO_DATE(bo.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid ORDER BY bo.buyer_order_id DESC")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					
					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid ORDER BY bo.buyer_order_id DESC")->result_array();
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
					
					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid ORDER BY bo.buyer_order_id DESC")->result_array();
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
			$data['f_l_country'] = '';
      		$data['f_l_user'] = '';
      		$data['fbasesearch'] = 'BonQuarter';
    		$data['purchasesearch'] = '';
			$data['drnge'] = '';
			//$data['fquartersearch'] = '';
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
			$data['buyer_order_list'] = $this->Buyerorder_model->get_buyer_order_list();
		}
		$this->load->view('buyerorder/buyer_order_list', $data);
	}
	public function bo_list_by_filter()
	{
		// $data['perpage'] = $perpage = 10;
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';

		if ($search_val != '') {
			$sc = ' AND (bo.buyer_order_invoice_no LIKE "%'.$search_val.'%" OR cb.lead_name LIKE "%'.$search_val.'%" OR pis.pi_stage LIKE "%'.$search_val.'%" OR e.exporter_name LIKE "%'.$search_val.'%" OR ac.name LIKE "%'.$search_val.'%")';
			// $data['page'] = $page = '0';
		}
		else {
			$sc = '';
		}

		$data['country_lists'] = $this->Lead_model->country_list();
		$data['user_list'] = $this->Buyerorder_model->get_user_list();
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$country_id = $this->input->post('country_id');
      		$product_id = $this->input->post('product_id');
      		$user_id = $this->input->post('user_id');

			if($country_id !='')
			{
				$cid = " AND cb.country = '$country_id'";
			}
			else
			{
				$cid = '';
			}

			if($user_id !='')
			{
				$uid = " AND l.lead_assigned_to = '$user_id'";
			}
			else
			{
				$uid = '';
			}
			$data['f_l_country'] = $country_id;
      		$data['f_l_user'] = $user_id;

      		$fbase = $this->input->post('fbase');
    		$data['fbasesearch'] = $fbase;

    		if($fbase == '')
    		{
    			$data['purchasesearch'] = '';
				$data['drnge'] = '';
    			$data['fquartersearch'] = '';
    			//$data['ypick'] = '';
    			$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 $cid $uid $sc ORDER BY bo.buyer_order_id DESC")->result_array();
    			
      			$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 $cid $uid $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
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
					$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY bo.buyer_order_id DESC")->result_array();

    				$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
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
    				$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY bo.buyer_order_id DESC")->result_array();

    				$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
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
					$data['drnge'] = '';
					$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 $cid $uid $sc ORDER BY bo.buyer_order_id DESC")->result_array();

					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 $cid $uid $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					
					$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') = CURDATE() $cid $uid $sc ORDER BY bo.buyer_order_id DESC")->result_array();

					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') = CURDATE() $cid $uid $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					
					$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND YEARWEEK(STR_TO_DATE(bo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid $sc ORDER BY bo.buyer_order_id DESC")->result_array();

					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND YEARWEEK(STR_TO_DATE(bo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					
					$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND MONTH(STR_TO_DATE(bo.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid $sc ORDER BY bo.buyer_order_id DESC")->result_array();

					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND MONTH(STR_TO_DATE(bo.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					
					$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid $sc ORDER BY bo.buyer_order_id DESC")->result_array();

					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
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
					
					$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY bo.buyer_order_id DESC")->result_array();

					$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
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
			$data['f_l_country'] = '';
      		$data['f_l_user'] = '';
      		$data['fbasesearch'] = '';
    		$data['purchasesearch'] = '';
			$data['drnge'] = '';
			$data['fquartersearch'] = '';

			$data['buyer_order_list_count'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 $sc ORDER BY bo.buyer_order_id DESC")->result_array();

			$data['buyer_order_list'] = $this->db->query("SELECT bo.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name,c.currency_name,c.currency_code,c.currency_symbol FROM `buyer_order` bo, exporter e, leads l, pi_stage pis,ad_countries ac, currency c,contact_book cb WHERE bo.exporter_id = e.exporter_id AND bo.currency_id = c.currency_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND bo.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND bo.status!=2 $sc ORDER BY bo.buyer_order_id DESC LIMIT $page, $perpage")->result_array();
		}
		$this->load->view('buyerorder/buyer_order_list_table', $data);
	}
	public function buyerorder_view($piid)
	{
		$pi_list = $data['buyer_order_list'] = $this->Buyerorder_model->get_buyer_order_by_id($piid);
		$data['buyer_order_product_list'] = $this->Buyerorder_model->get_buyer_order_product_by_id($piid);
		$data['buyer_order_other_charge_list'] = $this->Buyerorder_model->get_buyer_order_other_charge_by_id($piid);

		$data['buyer_order_invoice_no'] = $pi_list->buyer_order_invoice_no;

		$data['bank_detail'] = $this->Proformainvoice_model->get_bank_detail_by_id($pi_list->bank_detail_id);

		$curlist = $this->Proformainvoice_model->get_currency_by_id($pi_list->currency_id);
		$data['curcode'] = $curlist->currency_code;

		$data['exporter_list'] = $exporter_list = $this->Proformainvoice_model->get_exporter_by_id($pi_list->exporter_id);
		$data['gst_no'] = $exporter_list->gst_no;
		$data['iec_no'] = $exporter_list->iec_no;

		$ilist = $this->Proformainvoice_model->get_interest_by_id($pi_list->interest_id);
		$data['interest_text'] = $ilist->interest_text;

		$ilist = $this->Proformainvoice_model->get_tap_by_id($pi_list->terms_and_payment_id);
		$data['terms_and_payment_value'] = $ilist->terms_and_payment_value;

		$ilist = $this->Proformainvoice_model->get_top_by_id($pi_list->terms_of_payment_id);
		$data['terms_of_payment_text'] = $ilist->terms_of_payment_text;

		$ilist = $this->Proformainvoice_model->get_aribitration_by_id($pi_list->arbitration_id);
		$data['arbitration_text'] = $ilist->arbitration_text;

		$ilist = $this->Proformainvoice_model->get_declaration_by_id($pi_list->declaration_id);
		$data['declaration'] = $ilist->declaration;	

		$ilist = $this->Proformainvoice_model->get_document_required_by_proforma_invoice_id($piid);
		$data['document_required'] = $ilist->dreq;

		$data['order_feedbacks'] = $this->Buyerorder_model->buyer_order_feedback_list($piid);
		
		$this->load->view('buyerorder/buyer_order_view', $data);
	}
	public function buyerorder_verify_files($boid)
	{
		$data['boid'] = $boid;
		$data['bo_details'] = $this->Buyerorder_model->get_buyer_order_by_id($boid);
		$this->load->view('buyerorder/buyerorder_verify_files', $data);
	}

	public function upload_po_verify_docs()
	{
		$boid = $this->input->post('boid');
		$buyer_order_details = $this->Buyerorder_model->get_buyer_order_by_id($boid);
		//$customer_id = $buyer_order_details->buyer_id;
		$invoice_no  = str_replace('/', '_', ($buyer_order_details->buyer_order_invoice_no.'-'.$buyer_order_details->order_date));

		// Count total files
		$countfiles = count($_FILES['files']['name']);

		if($countfiles > 0)
		{
			//$customer_details = $this->Invoice_model->get_customer_by_id($customer_id);
			//$cuscode = str_replace('/', '-', $customer_details->customer_code);
			$pocode = str_replace('/', '-', $buyer_order_details->buyer_order_invoice_no);

			$customer_folder_path = $pocode.'/verify_docs/';

			if (!is_dir('buyer_order_document/'.$customer_folder_path)) 
			{
				mkdir('./buyer_order_document/' . $customer_folder_path, 0777, TRUE);
			}
			// Looping all files
			$i = 0;
			for($j=1;$j<=$countfiles;$j++)
			{

				if(!empty($_FILES['files']['name'][$i]))
				{

					$_FILES['file']['name'] = '';
					$_FILES['file']['type'] = '';
					$_FILES['file']['tmp_name'] = '';
					$_FILES['file']['error'] = '';
					$_FILES['file']['size'] = '';

					// Define new $_FILES array - $_FILES['file']
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					// Set preference
					$config['upload_path'] = 'buyer_order_document/'.$customer_folder_path; 
					$config['allowed_types'] = 'jpg|jpeg|png|doc|pdf|xlsx|docx|xls';
					$config['max_size'] = '5000'; // max_size in kb
					$config['file_name'] = $_FILES['file']['name'];

					//Load upload library
					$this->load->library('upload',$config); 
					$this->upload->initialize($config);

					// File upload
					if($this->upload->do_upload('file')){

						// Get data about the file
						$uploadData = $this->upload->data();

						$filename = $uploadData['file_name'];

						// Initialize array
						$data['filenames'][] = $filename;
					}
				}
				$i++;
			}
			$this->session->set_flashdata('purchase_success', 'Document has been uploaded successfully...');
		}else{
			$this->session->set_flashdata('purchase_err', 'No File!');
		}

		redirect('buyerorder/buyerorder_verify_files/'.$boid);
	}

	public function invoice_copy($piid)
	{
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

		$pi_list = $data['buyer_order_list'] = $this->Buyerorder_model->get_buyer_order_by_id($piid);
		$data['buyer_order_product_list'] = $this->Buyerorder_model->get_buyer_order_product_by_id($piid);
		$data['buyer_order_other_charge_list'] = $this->Buyerorder_model->get_buyer_order_other_charge_by_id($piid);

		$data['buyer_order_invoice_no'] = $pi_list->buyer_order_invoice_no;

		$curlist = $this->Proformainvoice_model->get_currency_by_id($pi_list->currency_id);
		$data['curcode'] = $curlist->currency_code;

		$exporter_list = $this->Proformainvoice_model->get_exporter_by_id($pi_list->exporter_id);
		$data['gst_no'] = $exporter_list->gst_no;
		$data['iec_no'] = $exporter_list->iec_no;

		$port_list = $this->Proformainvoice_model->get_port_by_vessel_flight_id($pi_list->vessel_flight_id);
		$option = '<option value="">Choose Port</option>';
		foreach($port_list as $plist)
		{
			if($pi_list->port_of_loading_id == $plist['port_id'])
				$option.='<option value="'.$plist['port_id'].'" selected>'.$plist['port_name'].' - '.$plist['port_city'].' - '.$plist['port_country'].'</option>';
			else				
				$option.='<option value="'.$plist['port_id'].'">'.$plist['port_name'].' - '.$plist['port_city'].' - '.$plist['port_country'].'</option>';
		}
		$data['port_of_loading_id'] = $option;

		$top_list = $this->Proformainvoice_model->get_terms_of_payment_by_type_id($pi_list->terms_of_payment_id);
		$topoption = '<option value="">Choose Terms of Payment</option>';
		foreach($top_list as $plist)
		{
			if($pi_list->terms_of_payment_id == $plist['terms_of_payment_id'])
				$topoption.='<option value="'.$plist['terms_of_payment_id'].'" selected>'.$plist['terms_of_payment_name'].'</option>';
			else
				$topoption.='<option value="'.$plist['terms_of_payment_id'].'">'.$plist['terms_of_payment_name'].'</option>';
		}
		$data['top'] = $topoption;

		$bd_list = $this->Proformainvoice_model->get_bank_detail_by_currency_exporter_id($pi_list->currency_id,$pi_list->exporter_id);
		$bdoption = '<option value="">Choose Bank Detail</option>';
		foreach($bd_list as $plist)
		{	if($pi_list->bank_detail_id == $plist['bank_detail_id'])
				$bdoption.='<option value="'.$plist['bank_detail_id'].'" selected>'.$plist['bank_label'].'</option>';
			else
				$bdoption.='<option value="'.$plist['bank_detail_id'].'">'.$plist['bank_label'].'</option>';
		}
		$data['bdetail'] = $bdoption;	

		$this->load->view('buyerorder/invoice_copy', $data);
	}

	public function invoice_copy_save()
	{
		$profoid = $data['buyer_order_id'] = $this->input->post('buyer_order_id');

		$financial_year_to2 = (date('m') > 3) ? date('y') +1 : date('y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$last_id_value = $this->Buyerorder_model->invoice_last_id();

      	$finhi = $financial_year_from2.'-'.$financial_year_to2;

	    if(count($last_id_value)==0)
	    {
	      //$ino = $data['invoice_no'] = date("Y").'/'.date('m').'/'.$locDetails->location_code.'/INV001';
	      $data['invoice_no'] = 'INV/'.$finhi.'/001';
	    }
	    else
	    {
	      $lno = $last_id_value->invoice_no;
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
	        $data['invoice_no'] = 'INV/'.$finhi.'/'.$nval;
	      }
	      else
	      {
	        $data['invoice_no'] = 'INV/'.$finhi.'/001';
	      }
		}

		$data['exporter_id'] = $this->input->post('exporter_id');
		$data['subject'] = $this->input->post('subject');
    	$data['terms_of_payment_type_id'] = $this->input->post('terms_of_payment_type_id');
		$cdt = explode('/', $this->input->post('invoice_date'));
    	$data['invoice_date'] = $cdt[2].'-'.$cdt[0].'-'.$cdt[1];
		$vdt = explode('/', $this->input->post('buyer_confirmation_date'));
    	$data['buyer_confirmation_date'] = $vdt[2].'-'.$vdt[0].'-'.$vdt[1];
    	$data['other_reference'] = $this->input->post('other_reference');
    	$data['pi_stage_id'] = $this->input->post('pi_stage_id');
    	$lid = $data['lead_id'] = $this->input->post('lead_id');
    	$data['pre_carriage_by_id'] = $this->input->post('pre_carriage_by_id');
    	$data['place_of_receipt_by_pre_carrier'] = $this->input->post('place_of_receipt_by_pre_carrier');
    	$data['vessel_flight_id'] = $this->input->post('vessel_flight_id');
    	$data['port_of_loading_id'] = $this->input->post('port_of_loading_id');
    	$data['port_of_discharge_id'] = $this->input->post('port_of_discharge_id');
    	$data['final_destination_id'] = $this->input->post('final_destination_id');
    	$data['currency_id'] = $this->input->post('currency_id');
    	$data['rate'] = $this->input->post('ratec');
    	$data['bank_detail_id'] = $this->input->post('bank_detail_id');
    	$data['grand_total'] = $this->input->post('grand_total');
    	$isloc = $data['is_local'] = $this->input->post('is_local');
    	$data['terms_and_payment_id'] = $this->input->post('terms_and_payment_id');
    	$data['price'] = $this->input->post('price');
    	$data['despatched_through'] = $this->input->post('despatched_through');
    	$data['terms_of_delivery'] = $this->input->post('terms_of_delivery');
		$data['created_on'] = date('Y-m-d H:i:s');
    	$data['created_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Buyerorder_model->create_invoice($data);

	    if ($result) {
	    	$last_id_value = $this->Buyerorder_model->invoice_last_id();
			$last_value=$last_id_value->invoice_id;
			$data1['invoice_id'] = $last_value;
			//$data1['proforma_invoice_id'] = $profoid;
			$bopid = explode(",",implode(",",$this->input->post('buyer_order_product_id')));
			$vid = explode(",",implode(",",$this->input->post('vendor_id')));
			$man = explode(",",implode(",",$this->input->post('marks_and_no')));
			$piid = explode(",",implode(",",$this->input->post('product_item_id')));
			$qty = explode(",",implode(",",$this->input->post('quantity')));
			$rate = explode(",",implode(",",$this->input->post('rate')));
			$amt = explode(",",implode(",",$this->input->post('amount')));
			$pidnid = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
			$skuid = explode(",",implode(",",$this->input->post('sku_unit_id')));
			$spec = explode("|***|",implode("|***|",$this->input->post('specification')));
			$ttype = explode(",",implode(",",$this->input->post('tax_type')));
			$tpecent = explode(",",implode(",",$this->input->post('tax_percent')));
			$subcount = count($this->input->post('marks_and_no')); 
			for($i=0;$i<$subcount;$i++)
			{
				if($vid[$i]!='')
				{
					$data1['buyer_order_product_id'] = $bopid[$i];
					$data1['vendor_id'] = $vid[$i];
					$data1['marks_and_no'] = $man[$i];
					$data1['product_item_id'] = $piid[$i];
					$data1['quantity'] = $qty[$i];
					$data1['rate'] = $rate[$i];
					$data1['amount'] = $amt[$i];
					$data1['product_item_display_name_id'] = $pidnid[$i]!=''?$pidnid[$i]:'0';
					$data1['sku_unit_id'] = $skuid[$i];
					$data1['specification'] = $spec[$i];
					$data1['tax_type'] = $ttype[$i];
					$data1['tax_percent'] = $tpecent[$i];
					$this->Buyerorder_model->create_invoice_product($data1);

					$posqty = $this->Buyerorder_model->get_buyer_order_product_by_id($bopid[$i]);
		            $invqty = $posqty->invoice_quantity+$qty[$i];
		            $data2['invoice_quantity'] = $invqty;
		            $data2['buyer_order_product_id'] = $bopid[$i];
		            $this->Buyerorder_model->update_buyer_order_inv_qty($data2);
				}
			}

			if($isloc==1 && $this->input->post('particulars')!='')
			{
				$data3['invoice_id'] = $last_value;
				$data3['particulars'] = $this->input->post('particulars');
				$data3['taxable_amount'] = $this->input->post('taxable_amount');
				$data3['otax_type'] = $this->input->post('otax_type');
				$data3['otax_percent'] = $this->input->post('otax_percent');
				$data3['oamount'] = $this->input->post('oamount');
				$this->Buyerorder_model->create_invoice_other_charge($data3);
			}

			if($isloc==1)
			{
				$leadlist = $this->Buyerorder_model->lead_by_id($lid);
				$cbid = $leadlist->contact_book_id;

				$data4['contact_book_id'] = $cbid;
				$data4['state_name'] = $this->input->post('state_name');
				$data4['state_code'] = $this->input->post('state_code');
				$data4['gst_no'] = $this->input->post('gst_no');
				$data4['vat_tin_no'] = $this->input->post('vat_tin_no');

				$this->Buyerorder_model->update_local_invoice_contact_book($data4);
			}
		}
		$this->session->set_flashdata('qstage_success', 'Invoice has been created successfully.');
    	redirect('/invoice');
	}

  public function random_strings($length_of_string) 
  { 
    
      // String of all alphanumeric character 
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    
      // Shufle the $str_result and returns substring 
      // of specified length 
      return substr(str_shuffle($str_result),  
                         0, $length_of_string); 
  } 

  public function po_feedback($po_id)
  {
  	$data['bo_details'] = $this->Buyerorder_model->get_buyer_order_by_id($po_id);
  	$rand = $this->random_strings(10);
    $data['po_id'] = $po_id;
    $data['feedback_mail_status'] = $rand;
    $po_details = $this->Buyerorder_model->get_buyer_order_by_id($po_id);
    $to_mail = $po_details->email_id;

    $data['to_mail'] = $to_mail;

    $g_settings = common_select_values('*', 'general_settings', '', 'row');

    $this->Buyerorder_model->update_bo_feedback_mail_status_by_id($data);
    $encryptorder_no = $rand;
    $et = $this->Buyerorder_model->email_template_by_id(1);

	$subject = $et->email_subject;

	$data['subject'] = $subject;

	$content = $et->email_content;

	$content = str_replace('#displayName#',$po_details->lead_name, $content);
	$content = str_replace('#orderNo#',$po_details->buyer_order_invoice_no, $content);
	$content = str_replace('#year#', date('Y'), $content);
	$content = str_replace('#regards#', $g_settings->product_title, $content);
	$content = str_replace('#baseurl#', base_url(), $content);
	$content = str_replace('#link#', base_url().'feedback/order_feedback/'.$encryptorder_no, $content);

	$data['content'] = $content;

	$get_role_id_by_user_id = $this->Mailbox_model->get_role_id_by_user_id($_SESSION['admindata']['user_id']);
    $role_id = $get_role_id_by_user_id->role_id;
    if ($role_id == 1) {
      $data['email_lists'] = $this->Mailbox_model->email_list();
    }
    else {
      $data['email_lists'] = $this->Mailbox_model->get_user_allocated_emails($_SESSION['admindata']['user_id']);
    }
/*echo "<pre>";
print_r($data);exit;*/
    $this->load->view('buyerorder/po_feedback', $data);

  }

  public function send_feedback()
  {
  	$data = $_POST;
    $email_details = $this->Lead_model->email_by_name($data['lead_email_reply']);

      // // To get info email details
      $email_id = $email_details->email_ID; 
      $password =  decryptthis($email_details->password, 'Rajexim2020');
      $email_id_name = $email_details->from_name;
      $attachment_files_path = array();
      $ccmailarray = array();
      $bccmailarray = array();
      $content = $data['reply_content_email'];
      $content .= '<br>';
      $content .= '<br>';
      $content .= $email_details->signature;
      $html_content = htmlentities($content);
     
      $to_emails = $data['reply_to_email'];
	  $tomailarray = explode(',', $to_emails);
      $send_email = send_email_common_method($email_id,$password,$tomailarray,$data['reply_sub_email'],$content,$attachment_files_path,$ccmailarray,$bccmailarray,$email_id_name);
           	  
   			  // echo $send_email;
   			  // die();
			  if($send_email == 1) {
      		     	$this->session->set_flashdata('qstage_success', 'Mail Sent Successfully');
			  }
			  else {
			  	$this->session->set_flashdata('qstage_err', 'Mail Fail to sent');
			  }	
             	redirect('buyerorder');
  }

  /*public  function po_feedback($po_id)
  {
    $rand = $this->random_strings(10);

    $data['po_id'] = $po_id;
    $data['feedback_mail_status'] = $rand;
    //$data['po_details'] = $this->Purchaseorder_model->purchase_order_by_po_id($po_id);
    $po_details = $this->Buyerorder_model->get_buyer_order_by_id($po_id);
    $to_mail = $po_details->email_id;

    $this->Buyerorder_model->update_bo_feedback_mail_status_by_id($data);

    //$encryptorder_no = str_replace('/', '1212121212', str_replace('=', '', aes128Encrypt('arjunerp',$po_details->invoice_no)));
    $encryptorder_no = $rand;

    //$mcRes = general_setting_details();
    $g_settings = common_select_values('*', 'general_settings', '', 'row');

    $config = Array( 
    'protocol' => 'smtp',
    'smtp_host' => $g_settings->smtp_host_name,
    'smtp_user' => $g_settings->smtp_user_name, 
    'smtp_pass' => $g_settings->smtp_password,
    'smtp_port' => 465,
    'mailtype'  => 'html', 
    'charset'   => 'utf-8',
    'newline'  => "\r\n",
    'wordwrap' => TRUE,
    );
     //$et = $this->Order_model->order_mail_template();
      $et = $this->Buyerorder_model->email_template_by_id(1);
      $subject = $et->email_subject;
      $content = $et->email_content;

      $content = str_replace('#displayName#',$po_details->lead_name, $content);
      $content = str_replace('#orderNo#',$po_details->buyer_order_invoice_no, $content);
      $content = str_replace('#year#', date('Y'), $content);
      $content = str_replace('#regards#', $g_settings->product_title, $content);
      $content = str_replace('#baseurl#', base_url(), $content);
      $content = str_replace('#link#', base_url().'feedback/order_feedback/'.$encryptorder_no, $content);
      $this->load->library('email',$config);
  //   $this->email->initialize($config);
      $this->email->from($mcRes->from_mail);          
      $this->email->to($to_mail);
      $this->email->subject($subject);
      $this->email->message($content);
      $this->email->set_mailtype('html');

      //$this->email->to($marray[$m]);
      if($this->email->send())
      {
        $result =1; echo " mail sent";
      }else{
        print_r($this->email->print_debugger());
        die();
      }
    
    if($result==1){
          $this->session->set_flashdata('qstage_success', 'Feedback Mail has been sent successfully.');
      }
      else{
          $this->session->set_flashdata('qstage_err', 'Something went wrong.');
      }
      redirect('/buyerorder');

  }*/

  public function bo_complete()
  {
    $data['boid']=$_POST['id'];
    $this->load->view('buyerorder/bo_complete',$data);
  }

  public function completeBO(){ 
    $boid=$_POST['boid'];
    $data['is_complete'] = 1;
    $data['completed_date'] = date('Y-m-d');
    $data['buyer_order_id'] = $boid;
    $result = $this->Buyerorder_model->buyerorder_complete($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Buyer Order has been Completed successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
  }

  public function buyerorder_task($boid)
  {
  	$data['buyer_order_task_list'] = $this->Buyerorder_model->get_buyer_order_task_list($boid);
  	$data['bo_details'] = $this->Buyerorder_model->get_buyer_order_by_id($boid);
  	$data['user_list'] = $this->Buyerorder_model->get_user_list();
  	$data['buyer_oreder_id'] = $boid;
  	$data['login_id']=$_SESSION['admindata']['user_id'];
  	$this->load->view('buyerorder/buyerorder_task',$data);
  }

  public function create_buyer_order_task()
  {
  	$bo_task_id = $this->Task_model->bo_task_next_auto_id();
  	$botdt = explode('/', $this->input->post('buyer_order_task_date'));
    $data['buyer_order_task_date'] = $botdt[2].'-'.$botdt[0].'-'.$botdt[1];
    $data['task'] = $this->input->post('task');
    $data['assigned_to'] = $this->input->post('assigned_to');
    $botedt = explode('/', $this->input->post('buyer_order_task_end_date'));
    $data['buyer_order_task_end_date'] = $botedt[2].'-'.$botedt[0].'-'.$botedt[1];
    $boid = $data['buyer_order_id'] = $this->input->post('buyer_order_id');    
	$data['created_on'] = date('Y-m-d H:i:s');
	$data['created_by'] = $_SESSION['admindata']['user_id'];
    $result = $this->Buyerorder_model->create_buyer_order_task($data);

    $data_n['notification_type_id'] = "5";
	$data_n['bo_task_id'] = $bo_task_id->AUTO_INCREMENT;
	$data_n['notification_allow_to'] = $this->input->post('assigned_to');
	$data_n['created_by'] = $_SESSION['admindata']['user_id'];
	$data_n['created_on'] = date('Y-m-d H:i:s');

	$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Buyer Order Task has been Added successfully');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/buyerorder/buyerorder_task/'.$boid);
  }

  public function task_remarks()
  {
  	$botid = $_POST['botid'];
  	$data['botask'] = $this->Buyerorder_model->get_buyer_order_task_by_id($botid);
  	$this->load->view('buyerorder/task_remarks',$data);
  }

  public function update_task_remarks()
  {
  	$boid = $this->input->post('buyer_order_id');
  	$data['buyer_order_task_id'] = $this->input->post('buyer_order_task_id');
  	$data['remarks'] = $this->input->post('remarks');
  	$data['status'] = $this->input->post('status');
	$data['modified_on'] = date('Y-m-d H:i:s');
	$data['modified_by'] = $_SESSION['admindata']['user_id'];

	$result = $this->Buyerorder_model->update_buyer_order_task($data);
	$bo_task_info = $this->Buyerorder_model->get_buyer_order_task_by_id($data['buyer_order_task_id']);
	$noti_alow_to = "";
    if ($_SESSION['admindata']['user_id'] == $bo_task_info->assigned_to) {
    	$noti_alow_to = $bo_task_info->created_by;
    }
    else if($_SESSION['admindata']['user_id'] == $bo_task_info->created_by) {
    	$noti_alow_to = $bo_task_info->assigned_to;
    }

	$data_n['notification_type_id'] = "6";
	$data_n['bo_task_id'] = $data['buyer_order_task_id'];
	$data_n['notification_allow_to'] = $noti_alow_to;
	$data_n['created_by'] = $_SESSION['admindata']['user_id'];
	$data_n['created_on'] = date('Y-m-d H:i:s');

	$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
    if ($result) {
    	$this->Buyerorder_model->create_buyer_order_task_remarks($data);
      $this->session->set_flashdata('qstage_success', 'Buyer Order Task has been Updated successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/buyerorder/buyerorder_task/'.$boid);
  }

  public function task_remarks_list()
  {
  	$botid = $_POST['botid'];
  	$data['botask'] = $this->Buyerorder_model->get_buyer_order_task_by_id($botid);
  	$data['botask_rem'] = $this->Buyerorder_model->get_buyer_order_task_remarks_by_botid($botid);
  	$this->load->view('buyerorder/task_remarks_list',$data);
  }

  public function followup_sheet($boid)
  {
  	$data['buyer_order_list'] = $this->Buyerorder_model->get_buyer_order_by_id($boid);
  	$data['buyer_order_followup'] = $this->Buyerorder_model->get_buyer_order_followup_sheet($boid);
  	$data['followup_default_category'] = $this->Buyerorder_model->get_followup_default_category();
  	$data['followup_other_category'] = $this->Buyerorder_model->get_followup_other_category();
  	$data['followup_stage'] = $this->Buyerorder_model->get_followup_sheet_stage_list();
  	$supplier_po_list = $this->Buyerorder_model->get_supplierpo_by_bo_id($boid);
  		$spono='';$sup='';
  	if(count($supplier_po_list)>0)
  	{
  		foreach($supplier_po_list as $spolist){
  			$spono.=$spolist['supplier_purchase_order_no'].",";
  			$sup.=$spolist['vendor_name'].",";
  		}
  	}
  	$data['spono'] = rtrim($spono, ',');
  	$data['supli'] = rtrim($sup, ',');
  	$this->load->view('buyerorder/followup_sheet',$data);
  }

  public function getCategoryInputType()
  {
  	$val = $_POST['val'];
  	$fupcat = $this->Followupsheetcategory_model->get_followup_sheet_category_by_id($val);
  	echo $fupcat->input_type;
  }

  public function buyerorder_followup()
  {
  	$boid = $this->input->post('buyer_order_id');
  	$this->Buyerorder_model->delete_buyerorder_followup($boid);
  	$af = explode("*|*|",implode("*|*|",$this->input->post('automatic_field')));
	$fscid = explode("*|*|",implode("*|*|",$this->input->post('followup_sheet_category_id')));
	$infield = explode("*|*|",implode("*|*|",$this->input->post('input_field')));
	$intfield = explode("*|*|",implode("*|*|",$this->input->post('inputt_field')));
	$rem = explode("*|*|",implode("*|*|",$this->input->post('remarks')));
	$stg = explode("*|*|",implode("*|*|",$this->input->post('followup_sheet_stage_id')));
	$subcount = count($this->input->post('automatic_field')); 
	for($i=0;$i<$subcount;$i++)
	{
		if($af[$i]!='' || $fscid[$i]!='')
		{
			$data['buyer_order_id'] = $boid;
			$data['automatic_field'] = $af[$i];
			$data['followup_sheet_category_id'] = $fscid[$i];
			if($fscid[$i]!='')
			{
				$fupcat = $this->Followupsheetcategory_model->get_followup_sheet_category_by_id($fscid[$i]);
				if($fupcat->input_type == 0)
				{
					$data['input_field'] = $intfield[$i];
				}
				else
				{
					$data['input_field'] = $infield[$i];
				}
			}
			else
			{
				$data['input_field'] = $intfield[$i];
			}
			$data['remarks'] = $rem[$i];
			$data['followup_sheet_stage_id'] = $stg[$i];
			$data['created_on'] = date('Y-m-d H:i:s');
	    	$data['created_by'] = $_SESSION['admindata']['user_id'];
			$this->Buyerorder_model->create_buyerorder_followup($data);
		}
	}
	$this->session->set_flashdata('qstage_success', 'Buyer Order Follow Up has been Updated successfully.');
	redirect('/buyerorder');
  }

  public function followup_sheet_view($boid)
  {
  	$data['followup_sheet_category_list'] = $this->Followupsheetcategory_model->get_followup_sheet_category_list();
  	$data['buyer_order_list'] = $this->Buyerorder_model->get_buyer_order_by_id($boid);
  	$this->load->view('buyerorder/followup_sheet_view',$data);
  }

  public function followup_sheet_edit($boid)
  {
  	$data['buyer_order_list'] = $this->Buyerorder_model->get_buyer_order_by_id($boid);
  	$data['buyer_order_followup'] = $this->Buyerorder_model->get_buyer_order_followup_sheet($boid);
  	$data['followup_default_category'] = $this->Buyerorder_model->get_followup_default_category();
  	$data['followup_other_category'] = $this->Buyerorder_model->get_followup_other_category();
  	$data['followup_stage'] = $this->Buyerorder_model->get_followup_sheet_stage_list();
  	$this->load->view('buyerorder/followup_sheet_edit',$data);
  }

  public function benefit_sheet($boid)
  {
  	$data['buyer_order_list'] = $this->Buyerorder_model->get_buyer_order_by_id($boid);
  	$bobenefit = $data['buyer_order_benefit'] = $this->Buyerorder_model->get_buyer_order_benefit($boid);
  	if(count($bobenefit)>0)
  		$data['buyer_order_benefit_details'] = $this->Buyerorder_model->get_buyer_order_benefit_details($bobenefit->buyer_order_benefit_id);
  	else
  		$data['buyer_order_benefit_details'] = array();
  	$this->load->view('buyerorder/benefit_sheet',$data);
  }

  public function buyerorder_benefit()
  {
  	$boid = $data['buyer_order_id'] = $this->input->post('buyer_order_id');
  	$boben = $this->Buyerorder_model->get_buyer_order_benefit_by_boid($boid);
  	$data['total_tt_receipt'] = $this->input->post('total_tt_receipt');
  	$data['total_pur_value'] = $this->input->post('total_pur_val');
  	$data['contribution'] = $this->input->post('contribution');
  	$data['meis'] = $this->input->post('meis');
  	$data['drawback'] = $this->input->post('drawback');
  	if(count($boben)==0)
  	{	  	
	  	$result = $this->Buyerorder_model->create_buyer_order_benefit($data);
	  	$last_id_value = $this->Buyerorder_model->buyer_order_benefit_last_id();
		$last_value=$last_id_value->buyer_order_benefit_id;
	}
	else
	{
		$result = $this->Buyerorder_model->update_buyer_order_benefit($data);
		$last_value=$boben->buyer_order_benefit_id;
		$this->Buyerorder_model->delete_buyer_order_benefit_details($boben->buyer_order_benefit_id);
	}
  	if ($result) {
		$data1['buyer_order_benefit_id'] = $last_value;

		$bobdate = explode("*|*|",implode("*|*|",$this->input->post('buyer_order_benefit_date')));
		$parti = explode("*|*|",implode("*|*|",$this->input->post('particulars')));
		$ttrec = explode("*|*|",implode("*|*|",$this->input->post('tt_receipt')));
		$purval = explode("*|*|",implode("*|*|",$this->input->post('pur_value')));
		$istot = explode("*|*|",implode("*|*|",$this->input->post('is_tot')));
		$tpurval = explode("*|*|",implode("*|*|",$this->input->post('total_pur_value')));
		$cur_rate = explode("*|*|",implode("*|*|",$this->input->post('cur_rate')));
		$con_rate = explode("*|*|",implode("*|*|",$this->input->post('con_rate')));
		$subcount = count($this->input->post('particulars')); 
		for($i=0;$i<$subcount;$i++)
		{
			if($bobdate!='')
			{
				$cdt = explode('/', $bobdate[$i]);
				$data1['buyer_order_benefit_date'] = $cdt[2].'-'.$cdt[0].'-'.$cdt[1];
			}
			else
			{
				$data1['buyer_order_benefit_date'] = '0000-00-00';
			}
			$data1['particulars'] = $parti[$i];
			$data1['tt_receipt'] = $ttrec[$i];
			$data1['pur_value'] = $purval[$i];
			$data1['total_pur_value'] = $tpurval[$i];
			$data1['is_tot'] = $istot[$i];
			$data1['cur_rate'] = $cur_rate[$i]!=''?$cur_rate[$i]:0;
			$data1['con_rate'] = $con_rate[$i]!=''?$con_rate[$i]:0;
			$this->Buyerorder_model->create_buyer_order_benefit_details($data1);
		}
  	}
  	$this->session->set_flashdata('qstage_success', 'Buyer Order Benefits has been added successfully.');
    redirect('/buyerorder');
  }


}
?>