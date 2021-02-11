<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time',259200);

class Invoice extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Buyerorder_model','Lead_model','Productcosting_model'));
		$this->load->model(array('Invoice_model'));
		$this->load->model(array('Proformainvoice_model'));
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
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
      	$data['dtrange_from'] = '';
      	$data['dtrange_to'] = '';
		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$country_id = $this->input->post('country_id');

			if($country_id !='')
			{
				$cid = " AND cb.country = '$country_id'";
			}
			else
			{
				$cid = '';
			}
			$data['f_l_country'] = $country_id;

      		$fbase = $this->input->post('fbase');
    		$data['fbasesearch'] = $fbase;

    		if($fbase == '')
    		{
    			$data['purchasesearch'] = '';
				$data['drnge'] = '';
    			$data['fquartersearch'] = '';
    			//$data['ypick'] = '';

      			$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 $cid ORDER BY i.invoice_id DESC")->result_array();
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

    				$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid ORDER BY i.invoice_id DESC")->result_array();
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
    				$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid ORDER BY i.invoice_id DESC")->result_array();
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
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 $cid ORDER BY i.invoice_id DESC")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') = CURDATE() $cid ORDER BY i.invoice_id DESC")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND YEARWEEK(STR_TO_DATE(i.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid ORDER BY i.invoice_id DESC")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND MONTH(STR_TO_DATE(i.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid ORDER BY i.invoice_id DESC")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid ORDER BY i.invoice_id DESC")->result_array();
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
					
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid ORDER BY i.invoice_id DESC")->result_array();
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
			$data['invoice_list'] = $this->Invoice_model->get_invoice_list();
		}
		$this->load->view('invoice/invoice_list', $data);
	}
	public function invoice_list_by_filter()
	{
		// $data['perpage'] = $perpage = 10;
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';

		if ($search_val != '') {
			$sc = ' AND (i.invoice_no LIKE "%'.$search_val.'%" OR cb.lead_name LIKE "%'.$search_val.'%" OR pis.pi_stage LIKE "%'.$search_val.'%" OR e.exporter_name LIKE "%'.$search_val.'%" OR ac.name LIKE "%'.$search_val.'%")';
			// $data['page'] = $page = '0';
		}
		else {
			$sc = '';
		}

		$data['country_lists'] = $this->Lead_model->country_list();
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
      	$data['dtrange_from'] = '';
      	$data['dtrange_to'] = '';
		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$country_id = $this->input->post('country_id');

			if($country_id !='')
			{
				$cid = " AND cb.country = '$country_id'";
			}
			else
			{
				$cid = '';
			}
			$data['f_l_country'] = $country_id;

      		$fbase = $this->input->post('fbase');
    		$data['fbasesearch'] = $fbase;

    		if($fbase == '')
    		{
    			$data['purchasesearch'] = '';
				$data['drnge'] = '';
    			$data['fquartersearch'] = '';
    			//$data['ypick'] = '';

      			$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 $cid $sc ORDER BY i.invoice_id DESC")->result_array();
      			$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 $cid $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
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

    				$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $sc ORDER BY i.invoice_id DESC")->result_array();
    				$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
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
    				$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $sc ORDER BY i.invoice_id DESC")->result_array();
    				$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
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
					$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 $cid $sc ORDER BY i.invoice_id DESC")->result_array();
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 $cid $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					
					$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') = CURDATE() $cid $sc ORDER BY i.invoice_id DESC")->result_array();
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') = CURDATE() $cid $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					
					$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND YEARWEEK(STR_TO_DATE(i.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $sc ORDER BY i.invoice_id DESC")->result_array();
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND YEARWEEK(STR_TO_DATE(i.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					
					$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND MONTH(STR_TO_DATE(i.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $sc ORDER BY i.invoice_id DESC")->result_array();
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND MONTH(STR_TO_DATE(i.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					
					$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $sc ORDER BY i.invoice_id DESC")->result_array();
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
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
					
					$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $sc ORDER BY i.invoice_id DESC")->result_array();
					$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 AND STR_TO_DATE(i.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(i.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
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
      		$data['fbasesearch'] = '';
    		$data['purchasesearch'] = '';
			$data['drnge'] = '';
			$data['fquartersearch'] = '';
			// $data['invoice_list'] = $this->Invoice_model->get_invoice_list();
			$data['invoice_list_count'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 $sc ORDER BY i.invoice_id DESC")->result_array();
			$data['invoice_list'] = $this->db->query("SELECT i.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name FROM `invoice` i, exporter e, leads l, pi_stage pis,ad_countries ac, contact_book cb WHERE i.exporter_id = e.exporter_id AND i.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND i.pi_stage_id = pis.pi_stage_id AND cb.country = ac.id AND i.status!=2 $sc ORDER BY i.invoice_id DESC LIMIT $page, $perpage")->result_array();
		}
		$this->load->view('invoice/invoice_list_table', $data);
	}
	public function invoice_view($piid)
	{
		$pi_list = $data['invoice_list'] = $this->Invoice_model->get_invoice_by_id($piid);
		$data['invoice_product_list'] = $this->Invoice_model->get_invoice_product_by_id($piid);		
		$data['invoice_other_charge_list'] = $this->Invoice_model->get_invoice_other_charge_by_id($piid);

		$data['invoice_no'] = $pi_list->invoice_no;

		$data['bank_detail'] = $this->Proformainvoice_model->get_bank_detail_by_id($pi_list->bank_detail_id);

		$curlist = $this->Proformainvoice_model->get_currency_by_id($pi_list->currency_id);
		$data['curcode'] = $curlist->currency_code;

		$data['exporter_list'] = $exporter_list = $this->Proformainvoice_model->get_exporter_by_id($pi_list->exporter_id);
		$data['gst_no'] = $exporter_list->gst_no;
		$data['iec_no'] = $exporter_list->iec_no;
		
		$this->load->view('invoice/invoice_view', $data);
	}

	public function convertToCurrency($number) {
	    $no = round($number);
	    $decimal = round($number - ($no = floor($number)), 2) * 100;    
	    $digits_length = strlen($no);    
	    $i = 0;
	    $str = array();
	    $words = array(
	        0 => '',
	        1 => 'One',
	        2 => 'Two',
	        3 => 'Three',
	        4 => 'Four',
	        5 => 'Five',
	        6 => 'Six',
	        7 => 'Seven',
	        8 => 'Eight',
	        9 => 'Nine',
	        10 => 'Ten',
	        11 => 'Eleven',
	        12 => 'Twelve',
	        13 => 'Thirteen',
	        14 => 'Fourteen',
	        15 => 'Fifteen',
	        16 => 'Sixteen',
	        17 => 'Seventeen',
	        18 => 'Eighteen',
	        19 => 'Nineteen',
	        20 => 'Twenty',
	        30 => 'Thirty',
	        40 => 'Forty',
	        50 => 'Fifty',
	        60 => 'Sixty',
	        70 => 'Seventy',
	        80 => 'Eighty',
	        90 => 'Ninety');
	    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
	    while ($i < $digits_length) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
	            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
	        } else {
	            $str [] = null;
	        }  
	    }
	    
	    $Rupees = implode(' ', array_reverse($str));
	    $paise = ($decimal) ? "And " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10])  : '';
	    return ($Rupees ? $Rupees : '') . $paise . " Only";
	}

	public function invoice_print($piid)
	{
		$pi_list = $data['invoice_list'] = $this->Invoice_model->get_invoice_by_id($piid);
		$data['invoice_product_list'] = $this->Invoice_model->get_invoice_product_by_id($piid);		
		$data['invoice_other_charge_list'] = $this->Invoice_model->get_invoice_other_charge_by_id($piid);

		$data['invoice_no'] = $pi_list->invoice_no;

		$data['lead_detail'] = $this->Proformainvoice_model->lead_by_id($pi_list->lead_id);

		$curlist = $this->Proformainvoice_model->get_currency_by_id($pi_list->currency_id);
		$data['curcode'] = $curlist->currency_code;

		$data['exporter_list'] = $exporter_list = $this->Proformainvoice_model->get_exporter_by_id($pi_list->exporter_id);
		$data['gst_no'] = $exporter_list->gst_no;
		$data['iec_no'] = $exporter_list->iec_no;

		$ilist = $this->Proformainvoice_model->get_tap_by_id($pi_list->terms_and_payment_id);
		$data['terms_and_payment_value'] = $ilist->terms_and_payment_value;

		$this->load->view('invoice/invoice_print', $data);
	}

	public function invoice_pl_print($piid)
	{
		$pi_list = $data['invoice_list'] = $this->Invoice_model->get_invoice_by_id($piid);
		$data['invoice_product_list'] = $this->Invoice_model->get_invoice_product_by_id($piid);		
		$data['invoice_other_charge_list'] = $this->Invoice_model->get_invoice_other_charge_by_id($piid);

		$data['invoice_no'] = $pi_list->invoice_no;

		$data['lead_detail'] = $this->Proformainvoice_model->lead_by_id($pi_list->lead_id);

		$curlist = $this->Proformainvoice_model->get_currency_by_id($pi_list->currency_id);
		$data['curcode'] = $curlist->currency_code;

		$data['exporter_list'] = $exporter_list = $this->Proformainvoice_model->get_exporter_by_id($pi_list->exporter_id);
		$data['gst_no'] = $exporter_list->gst_no;
		$data['iec_no'] = $exporter_list->iec_no;

		$ilist = $this->Proformainvoice_model->get_tap_by_id($pi_list->terms_and_payment_id);
		$data['terms_and_payment_value'] = $ilist->terms_and_payment_value;

		$this->load->view('invoice/invoice_pl_print', $data);
	}

	public function invoice_local_print($piid)
	{
		$pi_list = $data['invoice_list'] = $this->Invoice_model->get_invoice_by_id($piid);
		$data['invoice_product_list'] = $this->Invoice_model->get_invoice_product_by_id($piid);		
		$data['invoice_other_charge_list'] = $this->Invoice_model->get_invoice_other_charge_by_id($piid);

		$data['invoice_no'] = $pi_list->invoice_no;

		$data['lead_detail'] = $this->Proformainvoice_model->lead_by_id($pi_list->lead_id);

		$curlist = $this->Proformainvoice_model->get_currency_by_id($pi_list->currency_id);
		$data['curcode'] = $curlist->currency_code;

		$data['exporter_list'] = $exporter_list = $this->Proformainvoice_model->get_exporter_by_id($pi_list->exporter_id);
		$data['gst_no'] = $exporter_list->gst_no;
		$data['iec_no'] = $exporter_list->iec_no;

		$ilist = $this->Proformainvoice_model->get_tap_by_id($pi_list->terms_and_payment_id);
		$data['terms_and_payment_value'] = $ilist->terms_and_payment_value;

		$this->load->view('invoice/invoice_local_print', $data);
	}

}
?>