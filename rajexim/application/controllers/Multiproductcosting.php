<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcosting extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Multiproductcosting_model','Lead_model','Buyerorder_model','Productcosting_model','Quote_model','Product_model'));
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
				$cid = " AND c.country = '$country_id'";
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

      			$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 $cid $uid GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
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

    				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
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
					
    				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
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
					
    				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 $cid $uid GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					
					$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') = CURDATE() $cid $uid GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					
					$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND YEARWEEK(STR_TO_DATE(mpc.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					
					$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND MONTH(STR_TO_DATE(mpc.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					
					$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
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
					
					$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
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
			$data['multi_product_costing_list'] = $this->Multiproductcosting_model->get_multi_product_costing_list();
		}*/
		$this->load->view('multiproductcosting/multi_product_costing_list', $data);
	}

	public function multi_product_costing_result_list()
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
				$cid = " AND c.country = '$country_id'";
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

  		if ($search_val != '') {
	      $sc = 'AND (mpc.multi_product_costing_no LIKE "%'.$search_val.'%" OR c.lead_name LIKE "%'.$search_val.'%" OR c.email_id LIKE "%'.$search_val.'%" OR ac.name LIKE "%'.$search_val.'%" )';
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

			$data['multi_product_costing_lists_count'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();

  			$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC LIMIT $page, $perpage")->result_array();
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

				$data['multi_product_costing_lists_count'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();

				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC LIMIT $page, $perpage")->result_array();
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

				$data['multi_product_costing_lists_count'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();

				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC LIMIT $page, $perpage")->result_array();
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

				$data['multi_product_costing_lists_count'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();

				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC LIMIT $page, $perpage")->result_array();
			}
			elseif($schange == 'today')
			{
				$data['drnge'] = '';

				$data['multi_product_costing_lists_count'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') = CURDATE() $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
				
				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') = CURDATE() $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC LIMIT $page, $perpage")->result_array();
			}
			else if($schange == 'thisweek')
			{
				$data['drnge'] = '';

				$data['multi_product_costing_lists_count'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND YEARWEEK(STR_TO_DATE(mpc.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
				
				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND YEARWEEK(STR_TO_DATE(mpc.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC LIMIT $page, $perpage")->result_array();
			}      
			else if($schange == 'thismonth')
			{
				$data['drnge'] = '';

				$data['multi_product_costing_lists_count'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND MONTH(STR_TO_DATE(mpc.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
				
				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND MONTH(STR_TO_DATE(mpc.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC LIMIT $page, $perpage")->result_array();
			}			
			else if($schange == 'thisyear')
			{
				$data['drnge'] = '';
				$finstart = $_SESSION['finstart'];
				$finend = $_SESSION['finend'];

				$data['multi_product_costing_lists_count'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
				
				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC LIMIT $page, $perpage")->result_array();
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

				$data['multi_product_costing_lists_count'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC")->result_array();
				
				$data['multi_product_costing_list'] = $this->db->query("SELECT mpc.*,max(mpc.multi_product_costing_id) as mpcid,count(mpc.multi_product_costing_id) as mpccount,mpc.parent_costing_id,c.lead_name,c.email_id,ac.name as country_name FROM multi_product_costing mpc, leads l, contact_book c, ad_countries ac WHERE mpc.lead_id = l.lead_id AND c.country = ac.id AND l.contact_book_id = c.contact_book_id AND mpc.status!=2 AND STR_TO_DATE(mpc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(mpc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $uid $sc GROUP BY mpc.parent_costing_id ORDER BY mpcid DESC LIMIT $page, $perpage")->result_array();
			}
			//echo $schange;exit;
			$data['purchasesearch'] = $schange;
			$data['drnge'] = $dtrange;
			$data['fquartersearch'] = '';
			//$data['ypick'] = '';
		}
		 
		$this->load->view('multiproductcosting/multi_product_costing_list_table', $data);
	}

	public function multi_product_costing_add($lid = null)
	{
		$data['lead_list'] = $this->Multiproductcosting_model->get_lead_list();
		//$data['multi_product_costing_type_list'] = $this->Multiproductcosting_model->get_multi_product_costing_type_list();
		$data['product_item_list'] = $this->Multiproductcosting_model->get_product_item_list();
		$data['container_list'] = $this->Multiproductcosting_model->get_container_list();
		$data['product_unit'] = $this->Product_model->get_product_unit();
		$data['product_list'] = $this->Multiproductcosting_model->get_product_list();

		if($lid!=null)
		{
			$llist = $data['lead_details'] = $this->Lead_model->lead_by_id($lid);
			$data['contact_book_details'] = $this->Lead_model->contact_book_info_by_id($llist->contact_book_id);
		}
		$data['lid'] = $lid;
		$data['multi_product_costing_template_list'] = $this->Multiproductcosting_model->get_multi_product_costing_template_list();

		$this->load->view('multiproductcosting/multi_product_costing', $data);
	}

	public function get_container_details()
	{
		$cid = $_POST['cid'];
		$container_list = $this->Multiproductcosting_model->get_container_by_id($cid);
		echo $container_list->min_cbm."|".$container_list->max_cbm."|".$container_list->max_ton."|".$container_list->ton_variance;
	}

	public function get_template_details()
	{
		$tid = $_POST['tid'];
		$data['product_unit'] = $this->Product_model->get_product_unit();
		$data['product_list'] = $this->Multiproductcosting_model->get_product_list();
		$data['multi_product_costing_type_list'] = $multi_product_costing_type_list = $this->Multiproductcosting_model->get_multi_product_costing_template_type_by_template_id($tid);
		echo count($multi_product_costing_type_list)."|".$this->load->view('multiproductcosting/template_header', $data);
	}

	public function addProductLine()
	{
		$data['count'] = $_POST['count'];
		$tempid = $_POST['tempid'];
		//$data['multi_product_costing_type_list'] = $this->Multiproductcosting_model->get_multi_product_costing_type_list();
		$data['multi_product_costing_type_list'] = $this->Multiproductcosting_model->get_multi_product_costing_template_type_by_template_id($tempid);
		//echo count($data['multi_product_costing_type_list']);exit;
		$data['product_item_list'] = $this->Multiproductcosting_model->get_product_item_list();
		$data['product_unit'] = $this->Product_model->get_product_unit();
		$data['product_list'] = $this->Multiproductcosting_model->get_product_list();
		$this->load->view('multiproductcosting/addProductLine', $data);
	}

	public function multi_product_costing_save()
	{
		/*print_r($_POST);
		exit;*/
		$data['lead_id'] = $this->input->post('lead_id');
		$data['margin_in_percent'] = $this->input->post('margin_in_percent');
		$data['container_id'] = $this->input->post('container_id');
		$data['cha_expense'] = $this->input->post('cha_expense');
		$data['cha_based_on'] = $this->input->post('cha_based_on');
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $financial_year_to2 = (date('m') > 3) ? date('y') +1 : date('y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$last_id_value = $this->Multiproductcosting_model->multi_product_costing_last_parent_id();

      	$finhi = $financial_year_from2.'-'.$financial_year_to2;

	    if(count($last_id_value)==0)
	    {
	      //$ino = $data['invoice_no'] = date("Y").'/'.date('m').'/'.$locDetails->location_code.'/INV001';
	      $data['multi_product_costing_no'] = 'MPC/'.$finhi.'/001';
	    }
	    else
	    {
	      $lno = $last_id_value->multi_product_costing_no;
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
	        $data['multi_product_costing_no'] = 'MPC/'.$finhi.'/'.$nval;
	      }
	      else
	      {
	        $data['multi_product_costing_no'] = 'MPC/'.$finhi.'/001';
	      }
		}

		$last_id_value = $this->Multiproductcosting_model->multi_product_costing_last_id();
    	if(count($last_id_value)>0)
	    {
	      $last_value=$last_id_value->multi_product_costing_id;
	      $data['parent_costing_id'] = $last_value+1;
	    }
	    else
	    {
	      $data['parent_costing_id'] = 1;
	    }

		$data['is_draft'] = $this->input->post('is_draft');
		$data['revised'] = 0;
		$tempid = $data['multi_product_costing_template_id'] = $this->input->post('multi_product_costing_template_id');


	    $result = $this->Multiproductcosting_model->create_multi_product_costing($data);
	    if ($result) {
			$last_id_value = $this->Multiproductcosting_model->multi_product_costing_last_id();
			$last_value=$last_id_value->multi_product_costing_id;
			$data1['multi_product_costing_id'] = $last_value;
			$multi_product_costing_type_list = $this->Multiproductcosting_model->get_multi_product_costing_type_list($tempid);


			$pid = explode(",",implode(",",$this->input->post('product_id')));
			$piid = explode(",",implode(",",$this->input->post('product_item_id')));
			$skuid = explode(",",implode(",",$this->input->post('sku_unit_id')));
			$pidname = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
			$subcount = count($this->input->post('product_item_id')); 
			for($i=0;$i<$subcount;$i++)
			{
				if($piid[$i]!='')
				{
					$data1['product_id'] = $pid[$i];
					$data1['product_item_id'] = $piid[$i];
					$data1['product_item_display_name_id'] = $pidname[$i]!=''?$pidname[$i]:'0';
					$data1['sku_unit_id'] = $skuid[$i];
					$data1['product_count_no'] = $i+1;
					$s=1;foreach($multi_product_costing_type_list as $pcstage){
						if($pcstage['is_edit']==1)
						{
							$inp = implode(",",$this->input->post('inp'.$i.'_'.$pcstage['multi_product_costing_type_id']));
							$data1['multi_product_costing_type_id'] = $pcstage['multi_product_costing_type_id'];
							$data1['multi_product_costing_input'] = $inp;
							$this->Multiproductcosting_model->create_multi_product_costing_product($data1);
						}

					$s++;}
					//$this->Productcosting_model->create_product_costing_input($data1);
				}
			}
		}
		$this->session->set_flashdata('qstage_success', 'Multi Product Costing has been added successfully.');
    	redirect('/multiproductcosting');
	}

	public function multi_product_costing_view($id)
	{
		$quot['multi_product_costing_id'] = $id;
		$quotlist = $this->Multiproductcosting_model->get_multi_product_costing_by_id($id);
		$qcode = $quotlist->parent_costing_id;
		$mpctid = $quotlist->multi_product_costing_template_id;
		$quot['multi_product_costing_list'] = $this->Multiproductcosting_model->get_multi_product_costing_by_parent_id($qcode);
		$quot['multi_product_costing_type_list'] = $this->Multiproductcosting_model->get_multi_product_costing_type_list($mpctid);

		$this->load->view('multiproductcosting/multi_product_costing_view',$quot);
	}

	public function multi_product_costing_edit($id)
	{
		//$data['lead_list'] = $this->Multiproductcosting_model->get_lead_list();
		$data['product_item_list'] = $this->Multiproductcosting_model->get_product_item_list();
		$mpclist = $data['multi_product_costing_list'] = $this->Multiproductcosting_model->get_multi_product_costing_by_id($id);		
		$data['container_list'] = $this->Multiproductcosting_model->get_container_list();
		$data['product_unit'] = $this->Product_model->get_product_unit();
		$data['product_list'] = $this->Multiproductcosting_model->get_product_list();
		$data['multi_product_costing_template_list'] = $this->Multiproductcosting_model->get_multi_product_costing_template_list();
		$data['multi_product_costing_type_list'] = $this->Multiproductcosting_model->get_multi_product_costing_type_list($mpclist->multi_product_costing_template_id);
		$this->load->view('multiproductcosting/multi_product_costing_edit', $data);
	}

	public function multi_product_costing_update()
	{
		$pcid = $data['multi_product_costing_id'] = $this->input->post('multi_product_costing_id');
		$tempid = $data['multi_product_costing_template_id'] = $this->input->post('multi_product_costing_template_id');
		if($this->input->post('old_is_draft')==0)
		{
			$data['lead_id'] = $this->input->post('lead_id');
			$data['margin_in_percent'] = $this->input->post('margin_in_percent');
			$data['container_id'] = $this->input->post('container_id');
			$data['cha_expense'] = $this->input->post('cha_expense');
			$data['cha_based_on'] = $this->input->post('cha_based_on');
		    $data['created_on'] = date('Y-m-d H:i:s');
		    $data['created_by'] = $_SESSION['admindata']['user_id'];

		    $qno = $this->input->post('pc_no');

		    $pclist = $this->Multiproductcosting_model->get_multi_product_costing_by_no($qno);

		    if($pclist->revised==0)
		    {
		    	$pcid = $pclist->multi_product_costing_id;
		    }
		    else
		    {
		    	$pcid = $pclist->parent_costing_id;
		    }


		    //$pcid = $pclist->product_costing_id;

		    $pcrlist = $this->Multiproductcosting_model->get_multi_product_costing_by_revised($pcid);

		    if(count($pcrlist)>0)
		    {
		    	$qno = $pcrlist->multi_product_costing_no;
		    }
		    else
		    {
		    	$qno = $pclist->multi_product_costing_no;
		    }



			if(strpos($qno, ' - ') !== false)
		    {
		      $exp = explode(' - ', $qno);
		        $tval = $exp[1]+1;
		        $data['multi_product_costing_no'] = $exp[0].' - '.$tval;
		    }
		    else
		    {
		      $data['multi_product_costing_no'] = $qno.' - 1';
		    }

			$data['parent_costing_id'] = $this->input->post('parent_costing_id');

			$data['is_draft'] = $this->input->post('is_draft');
			$data['revised'] = 1;

/*print_r($data);
echo "<br><br>";*/
		    $result = $this->Multiproductcosting_model->create_multi_product_costing($data);
		    if ($result) {
				$last_id_value = $this->Multiproductcosting_model->multi_product_costing_last_id();
				$last_value=$last_id_value->multi_product_costing_id;
				$data1['multi_product_costing_id'] = $last_value;
				$multi_product_costing_type_list = $this->Multiproductcosting_model->get_multi_product_costing_type_list($tempid);

				$pid = explode(",",implode(",",$this->input->post('product_id')));
				$piid = explode(",",implode(",",$this->input->post('product_item_id')));
				$skuid = explode(",",implode(",",$this->input->post('sku_unit_id')));
				$pidname = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
				$subcount = count($this->input->post('product_item_id')); 
				for($i=0;$i<$subcount;$i++)
				{
					if($piid[$i]!='')
					{
						$data1['product_id'] = $pid[$i];
						$data1['product_item_id'] = $piid[$i];
						$data1['product_item_display_name_id'] = $pidname[$i]!=''?$pidname[$i]:'0';
						$data1['sku_unit_id'] = $skuid[$i];
						$data1['product_count_no'] = $i+1;
						$s=1;foreach($multi_product_costing_type_list as $pcstage){
							if($pcstage['is_edit']==1)
							{
								$inp = implode(",",$this->input->post('inp'.$i.'_'.$pcstage['multi_product_costing_type_id']));
								$data1['multi_product_costing_type_id'] = $pcstage['multi_product_costing_type_id'];
								$data1['multi_product_costing_input'] = $inp;
								$this->Multiproductcosting_model->create_multi_product_costing_product($data1);
							}

						$s++;}
					}
				}
			}
			//exit;
			$this->session->set_flashdata('qstage_success', 'Multi Product Costing has been revised successfully.');
		}
		else
		{
			$mpcid = $data['multi_product_costing_id'] = $this->input->post('multi_product_costing_id');
			$data['lead_id'] = $this->input->post('lead_id');
			$data['margin_in_percent'] = $this->input->post('margin_in_percent');
			$data['container_id'] = $this->input->post('container_id');
			$data['cha_expense'] = $this->input->post('cha_expense');
			$data['cha_based_on'] = $this->input->post('cha_based_on');
		    $data['modified_on'] = date('Y-m-d H:i:s');
		    $data['modified_by'] = $_SESSION['admindata']['user_id'];
		    $data['is_draft'] = $this->input->post('is_draft');
			$data['revised'] = $this->input->post('revised');;
			$data['parent_costing_id'] = $this->input->post('parent_costing_id');

		    $result = $this->Multiproductcosting_model->update_multi_product_costing($data);
		    if ($result) {

		    	$this->Multiproductcosting_model->delete_multi_product_costing_product_by_mpcid($mpcid);

				$data1['multi_product_costing_id'] = $pcid;

				$multi_product_costing_type_list = $this->Multiproductcosting_model->get_multi_product_costing_type_list($tempid);


				$pid = explode(",",implode(",",$this->input->post('product_id')));
				$piid = explode(",",implode(",",$this->input->post('product_item_id')));
				$skuid = explode(",",implode(",",$this->input->post('sku_unit_id')));
				$pidname = explode(",",implode(",",$this->input->post('product_item_display_name_id')));
				$subcount = count($this->input->post('product_item_id')); 
				for($i=0;$i<$subcount;$i++)
				{
					if($piid[$i]!='')
					{
						$data1['product_id'] = $pid[$i];
						$data1['product_item_id'] = $piid[$i];
						$data1['product_item_display_name_id'] = $pidname[$i]!=''?$pidname[$i]:'0';
						$data1['sku_unit_id'] = $skuid[$i];
						$data1['product_count_no'] = $i+1;
						$s=1;foreach($multi_product_costing_type_list as $pcstage){
							if($pcstage['is_edit']==1)
							{
								$inp = implode(",",$this->input->post('inp'.$i.'_'.$pcstage['multi_product_costing_type_id']));
								$data1['multi_product_costing_type_id'] = $pcstage['multi_product_costing_type_id'];
								$data1['multi_product_costing_input'] = $inp;
								$this->Multiproductcosting_model->create_multi_product_costing_product($data1);
							}

						$s++;}
						//$this->Productcosting_model->create_product_costing_input($data1);
					}
				}
			}
			$this->session->set_flashdata('qstage_success', 'Multi Product Costing has been udpated successfully.');
		}
    	redirect('/multiproductcosting');
	}

	public function multi_product_costing_delete()
	{
		$data['multi_product_costing_id'] = $this->input->post('mpcid');
	    $data['status'] = 2;
	    $result = $this->Multiproductcosting_model->multi_product_costing_delete($data);
	   $this->session->set_flashdata('qstage_success', 'Multi Product Costing has been deleted successfully...');
	   redirect('/multiproductcosting');     

	}

	public function multi_product_costing_approve()
	{
		$data['multi_product_costing_id'] = $this->input->post('mpcostid');
	    $data['is_approve'] = 1;
		$data['approved_by'] = $_SESSION['admindata']['user_id'];
	    $data['approved_date'] = date('Y-m-d H:i:s');
	    $result = $this->Multiproductcosting_model->multi_product_costing_approve($data);
	   $this->session->set_flashdata('qstage_success', 'Multi Product Costing has been approved successfully...');
	   redirect('/multiproductcosting');

	}



	public function getProductItemInputs()
	{
		$piid = $_POST['piid'];

		$displayname = $this->Productcosting_model->get_product_item_display_name_by_id($piid);
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
		echo $dname;
	}

	public function getProductItemDisplayName()
	{
	   $pidnid = $_POST['pidnid'];

	   $displayname = $this->Productcosting_model->get_display_name_by_id($pidnid);
	   
	   echo $displayname->product_item_id;
	}

	public function quote_create()
	{
		//$mpcid = $id;
		$mpcid = $this->input->post('mprodcostid');
		//$cifval = rtrim($this->input->post('cifval'),',');
		$data['cifvalue'] = rtrim($this->input->post('cifval'),',');
		$mpclist = $this->Multiproductcosting_model->get_multi_product_costing_by_id($mpcid);
		$data['product_unit'] = $this->Product_model->get_product_unit();
		
		$data['lead_list'] = $this->Productcosting_model->lead_by_id($mpclist->lead_id);

		$llist = $data['lead_details'] = $this->Lead_model->lead_by_id($mpclist->lead_id);
		$data['contact_book_details'] = $this->Lead_model->contact_book_info_by_id($llist->contact_book_id);

		$data['multi_product_costing_input_list'] = $this->db->query("SELECT mpcp.*,p.product_name,pi.product_item,pi.product_item_spec FROM multi_product_costing_product mpcp,products p,product_items pi WHERE mpcp.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND mpcp.multi_product_costing_id = $mpcid AND multi_product_costing_type_id=3 GROUP BY mpcp.product_count_no ")->result_array();

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

		$this->load->view('multiproductcosting/quote_add', $data);
	}

}
?>