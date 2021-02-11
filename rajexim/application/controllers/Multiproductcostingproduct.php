<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcostingproduct extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Multiproductcostingproduct_model','Lead_model','Buyerorder_model','Productcosting_model','Quote_model','Product_model'));
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
		//$data['multi_product_costing_product_list'] = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_list();
		$data['country_lists'] = $this->Lead_model->country_list();
      	$data['user_list'] = $this->Buyerorder_model->get_user_list();
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
		/*if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$country_id = $this->input->post('country_id');
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
				$uid = " AND mpc.created_by = '$user_id'";
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

    			$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 $cid $uid GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
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

    				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
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

    				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
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
					
    				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 $cid $uid GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					
					$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') = CURDATE() $cid $uid GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					
					$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND YEARWEEK(STR_TO_DATE(mpcp.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					
					$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND MONTH(STR_TO_DATE(mpcp.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					
					$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
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
					
					$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
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
			$data['multi_product_costing_product_list'] = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_list();
		}*/
		$this->load->view('multiproductcostingproduct/multi_product_costing_product_list', $data);
	}

	public function multi_product_costing_product_result_list()
	{
		// $data['perpage'] = $perpage = 10;
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';	
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
    		$country_id = $this->input->post('country_id');
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
				$uid = " AND mpcp.created_by = '$user_id'";
			}
			else
			{
				$uid = '';
			}
			$data['f_l_country'] = $country_id;
      		$data['f_l_user'] = $user_id;

  		if ($search_val != '') {
	      $sc = 'AND (mpcp.multi_product_costing_prod_v2_no LIKE "%'.$search_val.'%" OR cb.lead_name LIKE "%'.$search_val.'%" OR cb.email_id LIKE "%'.$search_val.'%" OR ac.name LIKE "%'.$search_val.'%" )';
	      //$data['page'] = $page = '0';
	    }
	    else {
	      $sc = '';
	      //$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';
	    }

  		$fbase = $this->input->post('fbase');
		$data['fbasesearch'] = $fbase;

		if($fbase == '')
		{
			$data['purchasesearch'] = '';
			$data['drnge'] = '';
			$data['fquartersearch'] = '';
			//$data['ypick'] = '';

			$data['multi_product_costing_product_lists_count'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();

  			$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC LIMIT $page, $perpage")->result_array();
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

				$data['multi_product_costing_product_lists_count'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();

				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC LIMIT $page, $perpage")->result_array();
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

				$data['multi_product_costing_product_lists_count'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();

				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC LIMIT $page, $perpage")->result_array();
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
			// $dtrange = $this->input->post('dtrange');
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

				$data['multi_product_costing_product_lists_count'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();

				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC LIMIT $page, $perpage")->result_array();
			}
			elseif($schange == 'today')
			{
				$data['drnge'] = '';

				$data['multi_product_costing_product_lists_count'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') = CURDATE() $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
				
				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') = CURDATE() $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC LIMIT $page, $perpage")->result_array();
			}
			else if($schange == 'thisweek')
			{
				$data['drnge'] = '';

				$data['multi_product_costing_product_lists_count'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND YEARWEEK(STR_TO_DATE(mpcp.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
				
				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND YEARWEEK(STR_TO_DATE(mpcp.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC LIMIT $page, $perpage")->result_array();
			}      
			else if($schange == 'thismonth')
			{
				$data['drnge'] = '';

				$data['multi_product_costing_product_lists_count'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND MONTH(STR_TO_DATE(mpcp.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
				
				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND MONTH(STR_TO_DATE(mpcp.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC LIMIT $page, $perpage")->result_array();
			}			
			else if($schange == 'thisyear')
			{
				$data['drnge'] = '';
				$finstart = $_SESSION['finstart'];
				$finend = $_SESSION['finend'];

				$data['multi_product_costing_product_lists_count'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
				
				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC LIMIT $page, $perpage")->result_array();
			}
			else
			{
				$data['drnge'] = $dtrange;
				$data['dtrange_from'] = $dtrange_from;
				$data['dtrange_to'] = $dtrange_to;
				$dr = explode(' - ', $dtrange);

				/*$fd = explode('/', $dr[0]);
				$td = explode('/', $dr[1]);*/

				$fd = explode('/', $dtrange_from);
				$td = explode('/', $dtrange_to);

				$fdate = $fd[2].'-'.$fd[0].'-'.$fd[1];
				$tdate = $td[2].'-'.$td[0].'-'.$td[1];

				$data['multi_product_costing_product_lists_count'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC")->result_array();
				
				$data['multi_product_costing_product_list'] = $this->db->query("SELECT mpcp.*,max(mpcp.multi_product_costing_prod_v2_id) as mpcpid, count(mpcp.multi_product_costing_prod_v2_id) as mpcpcount,mpcp.parent_costing_id,c.currency_code,c.currency_name,cb.lead_name,cb.email_id,ac.name as country_name FROM multi_product_costing_prod_v2 mpcp, currency c,leads l, contact_book cb, ad_countries ac WHERE mpcp.currency_id = c.currency_id AND mpcp.lead_id = l.lead_id AND cb.country = ac.id AND cb.contact_book_id = l.contact_book_id AND mpcp.status!=2 AND STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpcp.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpcp.parent_costing_id ORDER BY mpcpid DESC LIMIT $page, $perpage")->result_array();
			}
			//echo $schange;exit;
			$data['purchasesearch'] = $schange;
			$data['drnge'] = $dtrange;
			$data['fquartersearch'] = '';
			//$data['ypick'] = '';
		}
		 
		$this->load->view('multiproductcostingproduct/multi_product_costing_product_list_table', $data);
	}

	public function multi_product_costing_product_add($lid = null)
	{
		$data['lead_list'] = $this->Multiproductcostingproduct_model->get_lead_list();
		$data['multi_product_costing_type_product_list'] = $this->Multiproductcostingproduct_model->get_multi_product_costing_type_prod_list();
		$data['container_list'] = $this->Multiproductcostingproduct_model->get_container_list();
		$data['currency_list'] = $this->Multiproductcostingproduct_model->get_currency_list();
		$data['product_unit_list'] = $this->Multiproductcostingproduct_model->get_product_unit();
		$data['product_item_list'] = $this->Multiproductcostingproduct_model->get_product_item_list();

		if($lid!=null)
		{
			$llist = $data['lead_details'] = $this->Lead_model->lead_by_id($lid);
			$data['contact_book_details'] = $this->Lead_model->contact_book_info_by_id($llist->contact_book_id);
		}
		$data['lid'] = $lid;
		$this->load->view('multiproductcostingproduct/multi_product_costing_product_add', $data);
	}

	/*public function get_container_details()
	{
		$cid = $_POST['cid'];
		$container_list = $this->Multiproductcostingproduct_model->get_container_by_id($cid);
		echo $container_list->min_cbm."|".$container_list->max_cbm."|".$container_list->max_ton."|".$container_list->ton_variance;
	}*/

	public function getLeadProductCosting()
	{
		$lid = $_POST['lid'];
		$product_costing_list = $this->Multiproductcostingproduct_model->get_prod_costing_by_lead_id($lid);
		if(count($product_costing_list)>0)
		{
			$st = "<option value=''>Choose Product Costing</option>";
			foreach ($product_costing_list as $prod) {
				$st.='<option value='.$prod["product_costing_id"].'>'.$prod["product_costing_no"].' | '.$prod["product_name"].' - '.$prod["product_item"].'</option>';
			}
		}
		else
		{
			$st = '<option value="">No Costing Available</option>';
		}
		echo $st;
	}

	public function getStageValue()
	{
		$pcsid = $_POST['pcsid'];
		$pcsubstagelist = $this->Multiproductcostingproduct_model->get_product_costing_stage_by_id($pcsid);
		echo $pcsubstagelist->in_kg;
	}

	public function getCurrency()
	{
		$cid = $_POST['cid'];
		$clist = $this->Multiproductcostingproduct_model->get_currency_by_id($cid);
		echo $clist->currency_code;
	}

	public function getProductItemInputs()
	{
		$piid = $_POST['piid'];
		/*$pclist = $this->Multiproductcostingproduct_model->get_product_costing_by_id($pcid);
		$piid = $pclist->product_item_id;
		$pcilist = $this->Multiproductcostingproduct_model->get_product_costing_input_by_type_pcid($pcid);*/

		$pcstage = $this->Multiproductcostingproduct_model->get_last_product_costing_stage_by_product_item_id($piid);
		$inkg = $pcstage->in_kg;

		$pcstagelist = $this->Multiproductcostingproduct_model->get_product_costing_stage_by_piid($piid);

		if(count($pcstagelist)>0)
		{
			$st = "<option value=''>Choose SKU</option>";
			foreach ($pcstagelist as $pcslist) {
				/*if($pcslist["sub_stage"]==0)
				{
					$unit = $pcslist["stage_name"];
				}
				else
				{
					$pcsubstagelist = $this->Multiproductcostingproduct_model->get_product_costing_stage_by_id($pcslist["sub_stage"]);
					$unit = $pcsubstagelist->stage_name;
				}*/
				//$st.='<option value='.$pcslist["product_costing_stage_id"].'>'.$pcslist["unit_value"].' '.$unit.'</option>';
				$st.='<option value='.$pcslist["product_costing_stage_id"].'>'.$pcslist["stage_sku_name"].'</option>';
			}
		}
		else
		{
			$st = '<option value="">No SKU Available</option>';
		}

		$displayname = $this->Product_model->get_display_name_by_piid($piid);
		if(count($displayname)>0)
		{
		  $dname = '<option value="">Select Display Name</option>';
		  foreach ($displayname as $prod) {
		    $dname.='<option value='.$prod["product_item_display_name_id"].'>'.$prod["display_name"].'</option>';
			}
		}
		else
		{
		  $dname = '<option value="">No Display Name</option>';
		}

		/*$purcost = 0;
		$margin = 0;
		foreach($pcilist as $pcl)
		{
			if($pcl['product_costing_type_id']==1)
			{
				$purcost+= $pcl['product_costing_input'];
			}
			if($pcl['product_costing_type_id']==2)
			{
				$purcost+= $pcl['product_costing_input'];
			}
			if($pcl['product_costing_type_id']==3)
			{
				$purcost+= $pcl['product_costing_input'];
			}
			if($pcl['product_costing_type_id']==4)
			{
				$margin = $pcl['product_costing_input'];
			}
		}
		echo $purcost."|".$margin."|".$inkg."|".$st;*/
		echo $inkg."|".$st."|".$dname;
	}

	public function multi_product_costing_product_save()
	{
		$data['lead_id'] = $this->input->post('lead_id');
		$data['currency_id'] = $this->input->post('currency_id');
		$data['container_id'] = $this->input->post('container_id');
		$data['cha_expense'] = $this->input->post('cha_expense');
		$data['conversion_rate'] = $this->input->post('conversion_rate');
		$data['commission_charge'] = $this->input->post('commission_charge');
		$data['bank_charge'] = $this->input->post('bank_charge');
		$data['freight_charge'] = $this->input->post('freight_charge');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $financial_year_to2 = (date('m') > 3) ? date('y') +1 : date('y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$last_id_value = $this->Multiproductcostingproduct_model->multi_product_costing_product_last_parent_id();

      	$finhi = $financial_year_from2.'-'.$financial_year_to2;

	    if(count($last_id_value)==0)
	    {
	      $data['multi_product_costing_prod_v2_no'] = 'MPCP/'.$finhi.'/001';
	    }
	    else
	    {
	      $lno = $last_id_value->multi_product_costing_prod_v2_no;
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
	        $data['multi_product_costing_prod_v2_no'] = 'MPCP/'.$finhi.'/'.$nval;
	      }
	      else
	      {
	        $data['multi_product_costing_prod_v2_no'] = 'MPCP/'.$finhi.'/001';
	      }
		}

		$last_id_value = $this->Multiproductcostingproduct_model->multi_product_costing_product_last_id();
    	if(count($last_id_value)>0)
	    {
	      $last_value=$last_id_value->multi_product_costing_prod_v2_id;
	      $data['parent_costing_id'] = $last_value+1;
	    }
	    else
	    {
	      $data['parent_costing_id'] = 1;
	    }

		$data['is_draft'] = $this->input->post('is_draft');
		$data['revised'] = 0;


	    $result = $this->Multiproductcostingproduct_model->create_multi_product_costing_prod_v2($data);
	    if ($result) {
			$last_id_value = $this->Multiproductcostingproduct_model->multi_product_costing_product_last_id();
			$last_value=$last_id_value->multi_product_costing_prod_v2_id;
			$data1['multi_product_costing_prod_v2_id'] = $last_value;

			$pcid = explode(",",implode(",",$this->input->post('product_item_id')));
			$pcost = explode(",",implode(",",$this->input->post('purchase_cost')));
			$mip = explode(",",implode(",",$this->input->post('margin_in_percent')));
			$mval = explode(",",implode(",",$this->input->post('margin_value')));
			$qty = explode(",",implode(",",$this->input->post('quantity')));
			$pcsid = explode(",",implode(",",$this->input->post('product_costing_stage_id')));
			$inkg = explode(",",implode(",",$this->input->post('in_kg')));
			$pcsval = explode(",",implode(",",$this->input->post('product_costing_stage_value')));
			$cha = explode(",",implode(",",$this->input->post('cha')));
			$ccharge = explode(",",implode(",",$this->input->post('ccharge')));
			$fobvalue = explode(",",implode(",",$this->input->post('fob_value')));
			$bcharge = explode(",",implode(",",$this->input->post('bcharge')));
			$totalfobvalue = explode(",",implode(",",$this->input->post('total_fob_value')));
			$fobvalueincurrency = explode(",",implode(",",$this->input->post('fob_value_in_currency')));
			$fcharge = explode(",",implode(",",$this->input->post('fcharge')));
			$cnfprice = explode(",",implode(",",$this->input->post('cnf_price')));
			$totalprice = explode(",",implode(",",$this->input->post('total_price')));
			$totalmargin = explode(",",implode(",",$this->input->post('total_margin')));
			$totalcha = explode(",",implode(",",$this->input->post('total_cha')));
			$totalcommission = explode(",",implode(",",$this->input->post('total_commission')));
			$totalfreight = explode(",",implode(",",$this->input->post('total_freight')));
			$cip = explode(",",implode(",",$this->input->post('container_in_percent')));
			$inppcsid = explode(",",implode(",",$this->input->post('input_product_costing_stage_id')));
			$inppcsval = explode(",",implode(",",$this->input->post('input_product_costing_stage_value')));
			$pidname = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
			$subcount = count($this->input->post('product_item_id')); 
			for($i=0;$i<$subcount;$i++)
			{
				if($pcid[$i]!='')
				{
					$data1['product_item_id'] = $pcid[$i];
					$data1['purchase_cost'] = $pcost[$i];
					$data1['margin_in_percent'] = $mip[$i];
					$data1['margin_value'] = $mval[$i];
					$data1['quantity'] = $qty[$i];
					$data1['product_costing_stage_id'] = $pcsid[$i];
					$data1['in_kg'] = $inkg[$i];
					$data1['product_costing_stage_value'] = $pcsval[$i];
					$data1['cha_per_quantity'] = $cha[$i];
					$data1['commission_charge_per_quantity'] = $ccharge[$i];
					$data1['fob_value'] = $fobvalue[$i];
					$data1['bank_charge'] = $bcharge[$i];
					$data1['total_fob_value'] = $totalfobvalue[$i];
					$data1['fob_value_in_currency'] = $fobvalueincurrency[$i];
					$data1['freight_per_quantity'] = $fcharge[$i];
					$data1['cnf_price'] = $cnfprice[$i];
					$data1['total_price'] = $totalprice[$i];
					$data1['total_margin'] = $totalmargin[$i];
					$data1['total_cha'] = $totalcha[$i];
					$data1['total_commission_charge'] = $totalcommission[$i];
					$data1['total_freight'] = $totalfreight[$i];
					$data1['container_in_percent'] = $cip[$i];
					$data1['input_product_costing_stage_id'] = $inppcsid[$i];
					$data1['input_product_costing_stage_value'] = $inppcsval[$i];
					$data1['product_item_display_name_id'] = $pidname[$i]!=''?$pidname[$i]:'0';
					$this->Multiproductcostingproduct_model->create_multi_product_costing_prod_v2_input($data1);
				}
			}
		}
		$this->session->set_flashdata('qstage_success', 'Multi Product Costing - P has been added successfully.');
    	redirect('/multiproductcostingproduct');
	}

	public function multi_product_costing_product_view($id)
	{
		$quot['multi_product_costing_prod_v2_id'] = $id;
		$quotlist = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_by_id($id);
		$qcode = $quotlist->parent_costing_id;
		$quot['multi_product_costing_product_list'] = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_by_parent_id($qcode);

		$this->load->view('multiproductcostingproduct/multi_product_costing_product_view',$quot);
	}

	public function multi_product_costing_product_delete()
	{
		$data['multi_product_costing_prod_v2_id'] = $this->input->post('mpcpid');
	    $data['status'] = 2;
	    $result = $this->Multiproductcostingproduct_model->multi_product_costing_product_delete($data);
	   $this->session->set_flashdata('qstage_success', 'Multi Product Costing - P has been deleted successfully...');
	   redirect('/multiproductcostingproduct');     

	}

	public function multi_product_costing_product_approve()
	{
		$data['multi_product_costing_prod_v2_id'] = $this->input->post('mpcostpid');
	    $data['is_approve'] = 1;
		$data['approved_by'] = $_SESSION['admindata']['user_id'];
	    $data['approved_date'] = date('Y-m-d H:i:s');
	    $result = $this->Multiproductcostingproduct_model->multi_product_costing_product_approve($data);
	   $this->session->set_flashdata('qstage_success', 'Multi Product Costing - P has been approved successfully...');
	   redirect('/multiproductcostingproduct');     

	}

	public function multi_product_costing_product_edit($id)
	{
		$quot['lead_list'] = $this->Multiproductcostingproduct_model->get_lead_list();
		$quot['multi_product_costing_type_product_list'] = $this->Multiproductcostingproduct_model->get_multi_product_costing_type_prod_list();
		$quot['container_list'] = $this->Multiproductcostingproduct_model->get_container_list();
		$quot['currency_list'] = $this->Multiproductcostingproduct_model->get_currency_list();
		$quot['product_unit_list'] = $this->Multiproductcostingproduct_model->get_product_unit();

		$quot['multi_product_costing_prod_v2_id'] = $id;
		$quotlist = $quot['multi_product_costing_list'] = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_by_id($id);
		$product_item_list = $quot['product_item_list'] = $this->Multiproductcostingproduct_model->get_product_item_by_container_id($quotlist->container_id);

		//$quot['product_costing_list'] = $product_costing_list = $this->Multiproductcostingproduct_model->get_prod_costing_by_lead_id($quotlist->lead_id);
		if(count($product_item_list)>0)
		{
			$st = "<option value=''>Choose Product</option>";
			foreach ($product_item_list as $prod) {
				$st.='<option value='.$prod["product_item_id"].'>'.$prod["product_name"].' - '.$prod["product_item"].'</option>';
			}
		}
		else
		{
			$st = "<option value=''>No Product Available</option>";
		}

		$quot['lead_costing'] = $st;

		$this->load->view('multiproductcostingproduct/multi_product_costing_product_edit',$quot);
	}

	public function multi_product_costing_product_update()
	{
		$mpcid = $data['multi_product_costing_prod_v2_id'] = $this->input->post('multi_product_costing_prod_v2_id');
		if($this->input->post('old_is_draft')==0)
		{
			$data['lead_id'] = $this->input->post('lead_id');
			$data['currency_id'] = $this->input->post('currency_id');
			$data['container_id'] = $this->input->post('container_id');
			$data['cha_expense'] = $this->input->post('cha_expense');
			$data['conversion_rate'] = $this->input->post('conversion_rate');
			$data['commission_charge'] = $this->input->post('commission_charge');
			$data['bank_charge'] = $this->input->post('bank_charge');
			$data['freight_charge'] = $this->input->post('freight_charge');
		    $data['created_on'] = date('Y-m-d H:i:s');
		    $data['created_by'] = $_SESSION['admindata']['user_id'];

		    $qno = $this->input->post('pc_no');

		    $pclist = $this->Multiproductcostingproduct_model->get_multi_product_costing_prod_by_no($qno);

		    if($pclist->revised==0)
		    {
		    	$pcid = $pclist->multi_product_costing_prod_v2_id;
		    }
		    else
		    {
		    	$pcid = $pclist->parent_costing_id;
		    }

		    $pcrlist = $this->Multiproductcostingproduct_model->get_multi_product_costing_prod_by_revised($pcid);

		    if(count($pcrlist)>0)
		    {
		    	$qno = $pcrlist->multi_product_costing_prod_v2_no;
		    }
		    else
		    {
		    	$qno = $pclist->multi_product_costing_prod_v2_no;
		    }

			if(strpos($qno, ' - ') !== false)
		    {
		      $exp = explode(' - ', $qno);
		        $tval = $exp[1]+1;
		        $data['multi_product_costing_prod_v2_no'] = $exp[0].' - '.$tval;
		    }
		    else
		    {
		      $data['multi_product_costing_prod_v2_no'] = $qno.' - 1';
		    }

			$data['parent_costing_id'] = $this->input->post('parent_costing_id');

			$data['is_draft'] = $this->input->post('is_draft');
			$data['revised'] = 1;

		    $result = $this->Multiproductcostingproduct_model->create_multi_product_costing_prod_v2($data);
		    if ($result) {
				$last_id_value = $this->Multiproductcostingproduct_model->multi_product_costing_product_last_id();
				$last_value=$last_id_value->multi_product_costing_prod_v2_id;
				$data1['multi_product_costing_prod_v2_id'] = $last_value;

				$pcid = explode(",",implode(",",$this->input->post('product_item_id')));
				$pcost = explode(",",implode(",",$this->input->post('purchase_cost')));
				$mip = explode(",",implode(",",$this->input->post('margin_in_percent')));
				$mval = explode(",",implode(",",$this->input->post('margin_value')));
				$qty = explode(",",implode(",",$this->input->post('quantity')));
				$pcsid = explode(",",implode(",",$this->input->post('product_costing_stage_id')));
				$inkg = explode(",",implode(",",$this->input->post('in_kg')));
				$pcsval = explode(",",implode(",",$this->input->post('product_costing_stage_value')));
				$cha = explode(",",implode(",",$this->input->post('cha')));
				$ccharge = explode(",",implode(",",$this->input->post('ccharge')));
				$fobvalue = explode(",",implode(",",$this->input->post('fob_value')));
				$bcharge = explode(",",implode(",",$this->input->post('bcharge')));
				$totalfobvalue = explode(",",implode(",",$this->input->post('total_fob_value')));
				$fobvalueincurrency = explode(",",implode(",",$this->input->post('fob_value_in_currency')));
				$fcharge = explode(",",implode(",",$this->input->post('fcharge')));
				$cnfprice = explode(",",implode(",",$this->input->post('cnf_price')));
				$totalprice = explode(",",implode(",",$this->input->post('total_price')));
				$totalmargin = explode(",",implode(",",$this->input->post('total_margin')));
				$totalcha = explode(",",implode(",",$this->input->post('total_cha')));
				$totalcommission = explode(",",implode(",",$this->input->post('total_commission')));
				$totalfreight = explode(",",implode(",",$this->input->post('total_freight')));
				$cip = explode(",",implode(",",$this->input->post('container_in_percent')));
				$inppcsid = explode(",",implode(",",$this->input->post('input_product_costing_stage_id')));
				$inppcsval = explode(",",implode(",",$this->input->post('input_product_costing_stage_value')));
				$pidname = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
				$subcount = count($this->input->post('product_item_id')); 
				for($i=0;$i<$subcount;$i++)
				{
					if($pcid[$i]!='')
					{
						$data1['product_item_id'] = $pcid[$i];
						$data1['purchase_cost'] = $pcost[$i];
						$data1['margin_in_percent'] = $mip[$i];
						$data1['margin_value'] = $mval[$i];
						$data1['quantity'] = $qty[$i];
						$data1['product_costing_stage_id'] = $pcsid[$i];
						$data1['in_kg'] = $inkg[$i];
						$data1['product_costing_stage_value'] = $pcsval[$i];
						$data1['cha_per_quantity'] = $cha[$i];
						$data1['commission_charge_per_quantity'] = $ccharge[$i];
						$data1['fob_value'] = $fobvalue[$i];
						$data1['bank_charge'] = $bcharge[$i];
						$data1['total_fob_value'] = $totalfobvalue[$i];
						$data1['fob_value_in_currency'] = $fobvalueincurrency[$i];
						$data1['freight_per_quantity'] = $fcharge[$i];
						$data1['cnf_price'] = $cnfprice[$i];
						$data1['total_price'] = $totalprice[$i];
						$data1['total_margin'] = $totalmargin[$i];
						$data1['total_cha'] = $totalcha[$i];
						$data1['total_commission_charge'] = $totalcommission[$i];
						$data1['total_freight'] = $totalfreight[$i];
						$data1['container_in_percent'] = $cip[$i];
						$data1['input_product_costing_stage_id'] = $inppcsid[$i];
						$data1['input_product_costing_stage_value'] = $inppcsval[$i];
						$data1['product_item_display_name_id'] = $pidname[$i];
						$this->Multiproductcostingproduct_model->create_multi_product_costing_prod_v2_input($data1);
					}
				}
			}
			$this->session->set_flashdata('qstage_success', 'Multi Product Costing has been revised successfully.');
		}
		else
		{
			$mpcid = $data['multi_product_costing_prod_v2_id'] = $this->input->post('multi_product_costing_prod_v2_id');
			$data['lead_id'] = $this->input->post('lead_id');
			$data['currency_id'] = $this->input->post('currency_id');
			$data['container_id'] = $this->input->post('container_id');
			$data['cha_expense'] = $this->input->post('cha_expense');
			$data['conversion_rate'] = $this->input->post('conversion_rate');
			$data['commission_charge'] = $this->input->post('commission_charge');
			$data['bank_charge'] = $this->input->post('bank_charge');
			$data['freight_charge'] = $this->input->post('freight_charge');
		    $data['modified_on'] = date('Y-m-d H:i:s');
		    $data['modified_by'] = $_SESSION['admindata']['user_id'];
		    $data['is_draft'] = $this->input->post('is_draft');
			$data['revised'] = $this->input->post('revised');;
			$data['parent_costing_id'] = $this->input->post('parent_costing_id');

		    $result = $this->Multiproductcostingproduct_model->update_multi_product_costing_prod_v2($data);
		    if ($result) {

		    	$this->Multiproductcostingproduct_model->delete_multi_product_costing_prod_input_by_mpcpid($mpcid);

				$data1['multi_product_costing_prod_v2_id'] = $mpcid;

				$pcid = explode(",",implode(",",$this->input->post('product_item_id')));
				$pcost = explode(",",implode(",",$this->input->post('purchase_cost')));
				$mip = explode(",",implode(",",$this->input->post('margin_in_percent')));
				$mval = explode(",",implode(",",$this->input->post('margin_value')));
				$qty = explode(",",implode(",",$this->input->post('quantity')));
				$pcsid = explode(",",implode(",",$this->input->post('product_costing_stage_id')));
				$inkg = explode(",",implode(",",$this->input->post('in_kg')));
				$pcsval = explode(",",implode(",",$this->input->post('product_costing_stage_value')));
				$cha = explode(",",implode(",",$this->input->post('cha')));
				$ccharge = explode(",",implode(",",$this->input->post('ccharge')));
				$fobvalue = explode(",",implode(",",$this->input->post('fob_value')));
				$bcharge = explode(",",implode(",",$this->input->post('bcharge')));
				$totalfobvalue = explode(",",implode(",",$this->input->post('total_fob_value')));
				$fobvalueincurrency = explode(",",implode(",",$this->input->post('fob_value_in_currency')));
				$fcharge = explode(",",implode(",",$this->input->post('fcharge')));
				$cnfprice = explode(",",implode(",",$this->input->post('cnf_price')));
				$totalprice = explode(",",implode(",",$this->input->post('total_price')));
				$totalmargin = explode(",",implode(",",$this->input->post('total_margin')));
				$totalcha = explode(",",implode(",",$this->input->post('total_cha')));
				$totalcommission = explode(",",implode(",",$this->input->post('total_commission')));
				$totalfreight = explode(",",implode(",",$this->input->post('total_freight')));
				$cip = explode(",",implode(",",$this->input->post('container_in_percent')));
				$inppcsid = explode(",",implode(",",$this->input->post('input_product_costing_stage_id')));
				$inppcsval = explode(",",implode(",",$this->input->post('input_product_costing_stage_value')));
				$subcount = count($this->input->post('product_item_id')); 
				for($i=0;$i<$subcount;$i++)
				{
					if($pcid[$i]!='')
					{
						$data1['product_item_id'] = $pcid[$i];
						$data1['purchase_cost'] = $pcost[$i];
						$data1['margin_in_percent'] = $mip[$i];
						$data1['margin_value'] = $mval[$i];
						$data1['quantity'] = $qty[$i];
						$data1['product_costing_stage_id'] = $pcsid[$i];
						$data1['in_kg'] = $inkg[$i];
						$data1['product_costing_stage_value'] = $pcsval[$i];
						$data1['cha_per_quantity'] = $cha[$i];
						$data1['commission_charge_per_quantity'] = $ccharge[$i];
						$data1['fob_value'] = $fobvalue[$i];
						$data1['bank_charge'] = $bcharge[$i];
						$data1['total_fob_value'] = $totalfobvalue[$i];
						$data1['fob_value_in_currency'] = $fobvalueincurrency[$i];
						$data1['freight_per_quantity'] = $fcharge[$i];
						$data1['cnf_price'] = $cnfprice[$i];
						$data1['total_price'] = $totalprice[$i];
						$data1['total_margin'] = $totalmargin[$i];
						$data1['total_cha'] = $totalcha[$i];
						$data1['total_commission_charge'] = $totalcommission[$i];
						$data1['total_freight'] = $totalfreight[$i];
						$data1['container_in_percent'] = $cip[$i];
						$data1['input_product_costing_stage_id'] = $inppcsid[$i];
						$data1['input_product_costing_stage_value'] = $inppcsval[$i];
						$this->Multiproductcostingproduct_model->create_multi_product_costing_prod_v2_input($data1);
					}
				}
			}
			$this->session->set_flashdata('qstage_success', 'Multi Product Costing has been udpated successfully.');
		}
    	redirect('/multiproductcostingproduct');
	}

	public function quote_create()
	{
		$id = $this->input->post('multi_product_costing_product_id');
		$curid = $this->input->post('currency_id');
		$convrate = $this->input->post('conversion_rate');

		$data['curid'] = $curid;
		$data['convrate'] = $convrate;

		$data['quote_type'] = $this->input->post('quote_type');
		$mpcpid = $id;
		$mpcplist = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_by_id($id);
		$data['lead_list'] = $this->Productcosting_model->lead_by_id($mpcplist->lead_id);

		$llist = $data['lead_details'] = $this->Lead_model->lead_by_id($mpcplist->lead_id);
		$data['contact_book_details'] = $this->Lead_model->contact_book_info_by_id($llist->contact_book_id);

		$data['multi_product_costing_product_input_list'] = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_input_by_id($id);
		$data['product_unit'] = $this->Product_model->get_product_unit();

		$data['exporter_list'] = $this->Quote_model->get_exporter_list();
		$data['quote_stage_list'] = $this->Quote_model->get_quote_stage_list();
		$data['opportunity_list'] = $this->Quote_model->get_oppertunity_list();
		$data['vessel_flight_list'] = $this->Quote_model->get_vessel_flight_list();
		$data['port_list'] = $this->Quote_model->get_port_list();
		$data['price_term_list'] = $this->Quote_model->get_price_terms_list();
		$data['currency_list'] = $this->Quote_model->get_currency_list();
		$data['vendor_list'] = $this->Quote_model->get_vendor_list();
		//$data['product_item_list'] = $this->Quote_model->get_product_item_list();
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

		$this->load->view('multiproductcostingproduct/quote_add', $data);
	}

	public function move_to_quote()
	{
		$pcid = $_POST['id'];
		$data['multi_product_costing_list'] = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_by_id($pcid);
		$data['pcid']=$pcid;
		$this->load->view('multiproductcostingproduct/move_to_quote', $data);

	}

	public function get_container_details()
	{
		$cid = $_POST['cid'];
		$container_list = $this->Multiproductcostingproduct_model->get_container_by_id($cid);

		$productcc = $this->Multiproductcostingproduct_model->get_product_item_by_container_id($cid);
		if(count($productcc)>0)
		{
		  $st = '<option value="">Select Product Item</option>';
		  foreach ($productcc as $prod) {
		    $st.='<option value='.$prod["product_item_id"].'>'.$prod["product_name"].' - '.$prod["product_item"].'</option>';
			}
		}
		else
		{
		  $st = '<option value="">No Item Available</option>';
		}

		echo $container_list->min_cbm."|".$container_list->max_cbm."|".$container_list->max_ton."|".$container_list->ton_variance."|".$st;
	}

}
?>