<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time',259200);

class Proformainvoice extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Proformainvoice_model','Quote_model','Lead_model','Buyerorder_model','Productcosting_model','Product_model'));
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
		$data['user_list'] = $this->Lead_model->product_assigned_users();
		$data['pi_stage_list'] = $this->Proformainvoice_model->get_pi_stage_list();
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;

		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$country_id = $this->input->post('country_id');
      		// $product_id = $this->input->post('product_id');
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

      			$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 $cid $uid ORDER BY pi.proforma_invoice_id DESC")->result_array();
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

    				$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid ORDER BY pi.proforma_invoice_id DESC")->result_array();
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
    				$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid ORDER BY pi.proforma_invoice_id DESC")->result_array();
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
				// $dtrange = $this->input->post('dtrange_from').' - '.$this->input->post('dtrange_to');
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
					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 $cid $uid ORDER BY pi.proforma_invoice_id DESC")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					
					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_idAND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') = CURDATE() $cid $uid ORDER BY pi.proforma_invoice_id DESC")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					
					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND YEARWEEK(STR_TO_DATE(pi.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid ORDER BY pi.proforma_invoice_id DESC")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					
					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND MONTH(STR_TO_DATE(pi.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid ORDER BY pi.proforma_invoice_id DESC")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					
					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_idAND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid ORDER BY pi.proforma_invoice_id DESC")->result_array();
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
					
					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid ORDER BY pi.proforma_invoice_id DESC")->result_array();
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
			$data['proforma_invoice_list'] = $this->Proformainvoice_model->get_proforma_invoice_list();
		}
		$this->load->view('proformainvoice/proforma_invoice_list', $data);
	}
	public function pi_list_by_filter()
	{
		// $data['perpage'] = $perpage = 10;
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
		if ($search_val != '') {
			$sc = ' AND (pi.proforma_invoice_no LIKE "%'.$search_val.'%" OR cb.lead_name LIKE "%'.$search_val.'%" OR pis.pi_stage LIKE "%'.$search_val.'%" OR e.exporter_name LIKE "%'.$search_val.'%" OR ac.name LIKE "%'.$search_val.'%")';
		}
		else {
			$sc = '';
		}

		$data['country_lists'] = $this->Lead_model->country_list();
		$data['user_list'] = $this->Buyerorder_model->get_user_list();
		$data['pi_stage_list'] = $this->Proformainvoice_model->get_pi_stage_list();
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;

		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$country_id = $this->input->post('country_id');
      		// $product_id = $this->input->post('product_id');
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
    			$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();
      			$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
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
					$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();
    				$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
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
    				$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();
    				$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
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
				// $dtrange = $this->input->post('dtrange_from').' - '.$this->input->post('dtrange_to');
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
					$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();
					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					
					$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_idAND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') = CURDATE() $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();

					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_idAND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') = CURDATE() $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					
					$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND YEARWEEK(STR_TO_DATE(pi.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();

					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND YEARWEEK(STR_TO_DATE(pi.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';

					$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND MONTH(STR_TO_DATE(pi.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();

					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND MONTH(STR_TO_DATE(pi.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];

					$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_idAND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();

					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_idAND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
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

					$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();

					$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac, quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
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
			$data['pi_list_count'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac,quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 $sc ORDER BY pi.proforma_invoice_id DESC")->result_array();

			$data['proforma_invoice_list'] = $this->db->query("SELECT pi.*,e.exporter_name,cb.lead_name,pis.pi_stage,ac.name as country_name, q.comments FROM `proforma_invoice` pi, exporter e, leads l, contact_book cb, pi_stage pis,ad_countries ac,quote q WHERE pi.exporter_id = e.exporter_id AND pi.quote_id = q.quote_id AND pi.lead_id = l.lead_id AND pi.pi_stage_id = pis.pi_stage_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND pi.status!=2 $sc ORDER BY pi.proforma_invoice_id DESC LIMIT $page, $perpage")->result_array();
		}
		$this->load->view('proformainvoice/proforma_invoice_list_table', $data);
	}
	public function proformainvoice_add()
	{
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

		$this->load->view('proformainvoice/proforma_invoice_add', $data);
	}

	public function getExporterDetail()
	{
		$eid = $_POST['id'];
		$exporter_list = $this->Proformainvoice_model->get_exporter_by_id($eid);
		echo $exporter_list->gst_no."|".$exporter_list->iec_no;
	}

	public function getTermsandPayment()
	{
		$topid = $_POST['id'];
		$top_list = $this->Proformainvoice_model->get_terms_and_payment_by_type_id($topid);
		$option = '<option value="">Choose Terms & Payment</option>';
		foreach($top_list as $plist)
		{
			$option.='<option value="'.$plist['terms_and_payment_id'].'">'.$plist['terms_and_payment'].'</option>';
		}
		echo $option;
	}

	public function getTermsofPayment()
	{
		$topid = $_POST['id'];
		$top_list = $this->Proformainvoice_model->get_terms_of_payment_by_type_id($topid);
		$option = '<option value="">Choose Terms of Payment</option>';
		foreach($top_list as $plist)
		{
			$option.='<option value="'.$plist['terms_of_payment_id'].'">'.$plist['terms_of_payment_name'].'</option>';
		}
		echo $option;
	}

	public function getBankDetail()
	{
		$cid = $_POST['cid'];
		$eid = $_POST['eid'];
		$bd_list = $this->Proformainvoice_model->get_bank_detail_by_currency_exporter_id($cid,$eid);
		$option = '<option value="">Choose Bank Detail</option>';
		foreach($bd_list as $plist)
		{
			$option.='<option value="'.$plist['bank_detail_id'].'">'.$plist['bank_label'].'</option>';
		}
		echo $option;
	}

	public function getInterestText()
	{
		$iid = $_POST['id'];
		$ilist = $this->Proformainvoice_model->get_interest_by_id($iid);
		echo $ilist->interest_text;
	}

	public function getTAPText()
	{
		$iid = $_POST['id'];
		$ilist = $this->Proformainvoice_model->get_tap_by_id($iid);

		$top_list = $this->Proformainvoice_model->get_terms_of_payment_by_tap_id($iid);
		$option = '<option value="">Choose Terms of Payment</option>';
		foreach($top_list as $plist)
		{
			$option.='<option value="'.$plist['terms_of_payment_id'].'">'.$plist['terms_of_payment_name'].'</option>';
		}

		echo $ilist->terms_and_payment_value."||".$option;
	}

	public function getTOPText()
	{
		$iid = $_POST['id'];
		$ilist = $this->Proformainvoice_model->get_top_by_id($iid);
		echo $ilist->terms_of_payment_text;
	}

	public function getArbitrationText()
	{
		$iid = $_POST['id'];
		$ilist = $this->Proformainvoice_model->get_aribitration_by_id($iid);
		echo $ilist->arbitration_text;
	}

	public function getDeclarationText()
	{
		$iid = $_POST['id'];
		$ilist = $this->Proformainvoice_model->get_declaration_by_id($iid);
		echo $ilist->declaration;
	}

	public function create_proformainvoice()
	{
		$data['exporter_id'] = $this->input->post('exporter_id');
		$data['proforma_invoice_no'] = $this->input->post('proforma_invoice_no');
		$data['subject'] = $this->input->post('subject');
    	$data['terms_of_payment_type_id'] = $this->input->post('terms_of_payment_type_id');
		$cdt = explode('/', $this->input->post('proforma_invoice_date'));
    	$data['proforma_invoice_date'] = $cdt[2].'-'.$cdt[0].'-'.$cdt[1];
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
    	$data['sales_note'] = $this->input->post('sales_note');
    	$data['purchase_note'] = $this->input->post('purchase_note');
    	$data['shipping_note'] = $this->input->post('shipping_note');
    	$data['accounts_note'] = $this->input->post('accounts_note');
    	$data['specification_packing_details'] = $this->input->post('specification_packing_details');
    	$data['price_validity'] = $this->input->post('price_validity');
    	$data['interest_id'] = $this->input->post('interest_id');
    	$data['loadability'] = $this->input->post('loadability');
    	$data['terms_and_payment_id'] = $this->input->post('terms_and_payment_id');
    	
    	$data['terms_of_payment_id'] = $this->input->post('terms_of_payment_id');
    	$data['terms_and_payment'] = $this->input->post('terms_and_payment_text');
    	$data['terms_of_payment'] = $this->input->post('terms_of_payment_text');
    	$data['specification_group'] = $this->input->post('specification_group');
    	$data['arbitration_id'] = $this->input->post('arbitration_id');
    	$data['declaration_id'] = $this->input->post('declaration_id');
    	$data['document_required'] = $this->input->post('docrequired');
    	$data['price'] = $this->input->post('price');
    	$data['grand_total'] = $this->input->post('grand_total');
		$data['created_on'] = date('Y-m-d H:i:s');
    	$data['created_by'] = $_SESSION['admindata']['user_id'];    	
    	$qid = $data['quote_id'] = $this->input->post('quote_id');
    	$isloc = $data['is_local'] = $this->input->post('is_local');
	    $result = $this->Proformainvoice_model->create_proformainvoice($data);

	    if ($result) {
			$last_id_value = $this->Proformainvoice_model->proforma_invoice_last_id();
			$last_value=$last_id_value->proforma_invoice_id;
			$data1['proforma_invoice_id'] = $last_value;

			$vid = explode(",",implode(",",$this->input->post('vendor_id')));
			$man = explode(",",implode(",",$this->input->post('marks_and_no')));
			$piid = explode(",",implode(",",$this->input->post('product_item_id')));
			$pidnid = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
			$skuid = explode(",",implode(",",$this->input->post('sku_unit_id')));
			$qty = explode(",",implode(",",$this->input->post('quantity')));
			$rate = explode(",",implode(",",$this->input->post('rate')));
			$amt = explode(",",implode(",",$this->input->post('amount')));
			$spec = explode("|***|",implode("|***|",$this->input->post('specification')));
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
					$data1['specification'] = $spec[$i];
					$data1['tax_type'] = $ttype[$i];
					$data1['tax_percent'] = $tpecent[$i];
					$this->Proformainvoice_model->create_proformainvoice_product($data1);
				}
			}

			if($isloc==1 && $this->input->post('particulars')!='')
			{
				$data3['proforma_invoice_id'] = $last_value;
				$data3['particulars'] = $this->input->post('particulars');
				$data3['taxable_amount'] = $this->input->post('taxable_amount');
				$data3['otax_type'] = $this->input->post('otax_type');
				$data3['otax_percent'] = $this->input->post('otax_percent');
				$data3['oamount'] = $this->input->post('oamount');
				$this->Proformainvoice_model->create_proformainvoice_other_charge($data3);
			}
		}

		$leadid = $this->Proformainvoice_model->lead_by_id($lid);
		$data2['contact_book_id'] = $leadid->contact_book_id;
		$data2['company_name'] = $this->input->post('organization_name');
		$data2['country'] = $this->input->post('country');
		$data2['email_id'] = $this->input->post('email_id');
		$data2['contact_no'] = $this->input->post('phone_no');
		$data2['office_phone_no'] = $this->input->post('mobile_no');
		$data2['address'] = $this->input->post('address');

		$this->Proformainvoice_model->update_lead_contact_details($data2);

		$quotelist = $this->Quote_model->get_quote_by_id($qid);
		$parqid = $quotelist->parent_quote_id;
		$this->Quote_model->update_quote_pi_by_parent_quote_id($parqid);
		$this->session->set_flashdata('qstage_success', 'Proforma Invoice has been added successfully.');
    	redirect('/proformainvoice');
	}	

	public function proformainvoice_edit($piid)
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

		$pi_list = $data['proformainvoice_list'] = $this->Proformainvoice_model->get_proforma_invoice_by_id($piid);
		$data['proformainvoice_product_list'] = $this->Proformainvoice_model->get_proforma_invoice_product_by_id($piid);
		$data['proformainvoice_other_charge_list'] = $this->Proformainvoice_model->get_proforma_invoice_other_charge_by_id($piid);

		$data['proforma_invoice_no'] = $pi_list->proforma_invoice_no;

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

		$tap_list = $this->Proformainvoice_model->get_terms_and_payment_by_type_id($pi_list->terms_of_payment_type_id);
		$tapoption = '<option value="">Choose Terms & Payment</option>';
		foreach($tap_list as $plist)
		{
			if($pi_list->terms_and_payment_id == $plist['terms_and_payment_id'])
				$tapoption.='<option value="'.$plist['terms_and_payment_id'].'" selected>'.$plist['terms_and_payment'].'</option>';
			else
				$tapoption.='<option value="'.$plist['terms_and_payment_id'].'">'.$plist['terms_and_payment'].'</option>';
		}
		$data['tap'] = $tapoption;

		$top_list = $this->Proformainvoice_model->get_terms_of_payment_by_tap_id($pi_list->terms_and_payment_id);
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

		$this->load->view('proformainvoice/proforma_invoice_edit', $data);
	}

	public function update_proformainvoice()
	{
		$profoid = $data['proforma_invoice_id'] = $this->input->post('proforma_invoice_id');
		$data['exporter_id'] = $this->input->post('exporter_id');
		$data['subject'] = $this->input->post('subject');
    	$data['terms_of_payment_type_id'] = $this->input->post('terms_of_payment_type_id');
		$cdt = explode('/', $this->input->post('proforma_invoice_date'));
    	$data['proforma_invoice_date'] = $cdt[2].'-'.$cdt[0].'-'.$cdt[1];
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
    	$data['sales_note'] = $this->input->post('sales_note');
    	$data['purchase_note'] = $this->input->post('purchase_note');
    	$data['shipping_note'] = $this->input->post('shipping_note');
    	$data['accounts_note'] = $this->input->post('accounts_note');
    	$data['specification_packing_details'] = $this->input->post('specification_packing_details');
    	$data['price_validity'] = $this->input->post('price_validity');
    	$data['interest_id'] = $this->input->post('interest_id');
    	$data['loadability'] = $this->input->post('loadability');
    	$data['terms_and_payment_id'] = $this->input->post('terms_and_payment_id');
    	$data['terms_of_payment_id'] = $this->input->post('terms_of_payment_id');
    	
    	$data['terms_of_payment'] = $this->input->post('terms_of_payment_text');
    	$data['terms_and_payment'] = $this->input->post('terms_and_payment_text');
    	$data['specification_group'] = $this->input->post('specification_group');
    	
    	$data['arbitration_id'] = $this->input->post('arbitration_id');
    	$data['declaration_id'] = $this->input->post('declaration_id');
    	$data['document_required'] = $this->input->post('docrequired');
    	$data['price'] = $this->input->post('price');
    	$data['grand_total'] = $this->input->post('grand_total');
		$data['modified_on'] = date('Y-m-d H:i:s');
    	$data['modified_by'] = $_SESSION['admindata']['user_id'];
    	$isloc = $data['is_local'] = $this->input->post('is_local');

	    $result = $this->Proformainvoice_model->update_proformainvoice($data);

	    if ($result) {
	    	$this->Proformainvoice_model->delete_proforma_invoice_product_by_id($profoid);
			$data1['proforma_invoice_id'] = $profoid;
			$vid = explode(",",implode(",",$this->input->post('vendor_id')));
			$man = explode(",",implode(",",$this->input->post('marks_and_no')));
			$piid = explode(",",implode(",",$this->input->post('product_item_id')));
			$pidnid = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
			$skuid = explode(",",implode(",",$this->input->post('sku_unit_id')));
			$qty = explode(",",implode(",",$this->input->post('quantity')));
			$rate = explode(",",implode(",",$this->input->post('rate')));
			$amt = explode(",",implode(",",$this->input->post('amount')));
			$spec = explode("|***|",implode("|***|",$this->input->post('specification')));
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
					$data1['specification'] = $spec[$i];
					$data1['tax_type'] = $ttype[$i];
					$data1['tax_percent'] = $tpecent[$i];
					$this->Proformainvoice_model->create_proformainvoice_product($data1);
				}
			}

	    	$this->Proformainvoice_model->delete_proforma_invoice_other_charge_by_id($profoid);
			if($isloc==1 && $this->input->post('particulars')!='')
			{
				$data3['proforma_invoice_id'] = $profoid;
				$data3['particulars'] = $this->input->post('particulars');
				$data3['taxable_amount'] = $this->input->post('taxable_amount');
				$data3['otax_type'] = $this->input->post('otax_type');
				$data3['otax_percent'] = $this->input->post('otax_percent');
				$data3['oamount'] = $this->input->post('oamount');
				$this->Proformainvoice_model->create_proformainvoice_other_charge($data3);
			}
		}

		$leadid = $this->Proformainvoice_model->lead_by_id($lid);
		$data2['contact_book_id'] = $leadid->contact_book_id;
		$data2['company_name'] = $this->input->post('organization_name');
		$data2['country'] = $this->input->post('country');
		$data2['email_id'] = $this->input->post('email_id');
		$data2['contact_no'] = $this->input->post('phone_no');
		$data2['office_phone_no'] = $this->input->post('mobile_no');
		$data2['address'] = $this->input->post('address');

		$this->Proformainvoice_model->update_lead_contact_details($data2);

		$this->session->set_flashdata('qstage_success', 'Proforma Invoice has been updated successfully.');
    	redirect('/proformainvoice');
	}

	public function proformainvoice_view($piid)
	{
		$pi_list = $data['proformainvoice_list'] = $this->Proformainvoice_model->get_proforma_invoice_by_id($piid);
		$data['proformainvoice_product_list'] = $this->Proformainvoice_model->get_proforma_invoice_product_by_id($piid);
		$data['proformainvoice_other_charge_list'] = $this->Proformainvoice_model->get_proforma_invoice_other_charge_by_id($piid);

		$data['proforma_invoice_no'] = $pi_list->proforma_invoice_no;

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
		
		$this->load->view('proformainvoice/proforma_invoice_view', $data);
	}

	public function proformainvoice_local_print($piid)
	{
		$pi_list = $data['proformainvoice_list'] = $this->Proformainvoice_model->get_proforma_invoice_by_id($piid);
		$data['proformainvoice_product_list'] = $this->Proformainvoice_model->get_proforma_invoice_product_by_id($piid);
		$data['proformainvoice_other_charge_list'] = $this->Proformainvoice_model->get_proforma_invoice_other_charge_by_id($piid);

		$data['proforma_invoice_no'] = $pi_list->proforma_invoice_no;

		$data['lead_detail'] = $this->Proformainvoice_model->lead_by_id($pi_list->lead_id);

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
		
		$this->load->view('proformainvoice/proformainvoice_local_print', $data);
	}

	public function proformainvoice_print($piid)
	{
		$pi_list = $data['proformainvoice_list'] = $this->Proformainvoice_model->get_proforma_invoice_by_id($piid);
		$data['proformainvoice_product_list'] = $this->Proformainvoice_model->get_proforma_invoice_product_by_id($piid);

		$data['proforma_invoice_no'] = $pi_list->proforma_invoice_no;

		$data['lead_detail'] = $this->Proformainvoice_model->lead_by_id($pi_list->lead_id);

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
		if($pi_list->terms_of_payment_type_id == 1)
			$this->load->view('proformainvoice/proforma_invoice_advance_print', $data);
		else
			$this->load->view('proformainvoice/proforma_invoice_lc_print', $data);
	}

	public function proformainvoice_sc_print($piid)
	{
		$pi_list = $data['proformainvoice_list'] = $this->Proformainvoice_model->get_proforma_invoice_by_id($piid);
		$data['proformainvoice_product_list'] = $this->Proformainvoice_model->get_proforma_invoice_product_by_id($piid);

		$data['proforma_invoice_no'] = $pi_list->proforma_invoice_no;

		$data['lead_detail'] = $this->Proformainvoice_model->lead_by_id($pi_list->lead_id);

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
		
		if($pi_list->terms_of_payment_type_id == 1)
			$this->load->view('proformainvoice/proforma_invoice_sc_advance_print', $data);
		else
			$this->load->view('proformainvoice/proforma_invoice_sc_lc_print', $data);
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

// To upload confired proforma invoice
  public function proformainvoice_confirm_upload($invoice_id)
  {
    $data['proforma_invoice_id'] = $invoice_id;
    $data['pi_details'] = $this->Proformainvoice_model->get_proforma_invoice_by_id($invoice_id);
    $this->load->view('proformainvoice/proforma_invoice_confirm', $data);
  }

  // To upload proforma invoice confirmation
  public function proforma_invoice_confirm_save()
  {
    $buyer_order_no = $this->input->post('order_no');
    if($this->input->post('order_date')!='')
      $buyer_order_date = date('Y-m-d', strtotime($this->input->post('order_date')));
    else
      $buyer_order_date = date('Y-m-d');
    $order_end_date = date('Y-m-d', strtotime($this->input->post('order_end_date')));

  	$invoice_id = $this->input->post('proforma_invoice_id');
    $proformainvoice_detail = $this->Proformainvoice_model->get_proforma_invoice_by_id($invoice_id);
    $lead_id = $proformainvoice_detail->lead_id;
    

    $invoice_no = '';
    $last_id_value = $this->Proformainvoice_model->buyer_order_last_id();
    $financial_year_to2 = (date('m') > 3) ? date('y') +1 : date('y');
    $financial_year_from2 = $financial_year_to2 - 1;
    $finhi = $financial_year_from2.'-'.$financial_year_to2;
    if(count($last_id_value)==0)
    {
      $buyer_order_invoice_no = 'BO/'.$finhi.'/001'; 
    }else{
      $lno = $last_id_value->buyer_order_invoice_no;
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
        $buyer_order_invoice_no = 'BO/'.$finhi.'/'.$nval;
      }
      else
      {
        $buyer_order_invoice_no = 'BO/'.$finhi.'/001';
      }
    }

  	if(!empty($_FILES['file']['name']))
  	{
  		$customer_folder_path = 'signed_order/';
		$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		$config['upload_path'] = $customer_folder_path;
		$config['allowed_types'] = 'jpg|jpeg|png|doc|pdf|xlsx|docx';
		$config['file_name'] = str_replace('/', '-', $buyer_order_invoice_no);
		$profileName = $config['file_name'].'.'.$ext;
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
  		if($this->upload->do_upload('file'))
  		{
  			$uploadData = $this->upload->data();
  			// To save proforma invoice to buyer order table
  			$purchase_result = $this->Proformainvoice_model->proforma_invoice_to_buyer_order_save($invoice_id, $buyer_order_invoice_no, $buyer_order_no, $buyer_order_date, $order_end_date);
  			$buyer_order_id = $purchase_result->AUTO_INCREMENT;
  			$purchase_prds_result = $this->Proformainvoice_model->proforma_invoice_prd_to_buyer_order_prd_save($invoice_id, $buyer_order_id);

  			if($proformainvoice_detail->is_local==1)
  			{
  				$purchase_other_charge_result = $this->Proformainvoice_model->pi_other_charge_to_bo_other_charge_save($invoice_id, $buyer_order_id);
  			}

  			// To update the file name
  			$update_piv_file_res = $this->Proformainvoice_model->proforma_invoice_confirm_file_name_update($invoice_id, $profileName);
  		}
  		else
  		{
  			$this->session->set_flashdata('invoice_err', 'Could not upload the file.');
  		}
	  }
  	else
  	{ 
  		$this->session->set_flashdata('invoice_err', 'No File');
  	}
  	redirect('buyerorder');

  }
  public function pi_stage_change()
  {
  	$pi_id = $this->input->post('pi_id');
	$value = $this->input->post('value');
	$type_val = $this->input->post('type_val');
	$update_quote_stage = $this->Proformainvoice_model->update_pi_stage($pi_id,$value,$type_val);
	echo 1;
  }
}
?>