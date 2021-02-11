<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productcosting extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Productcosting_model','Buyerorder_model'));
		$this->load->model(array('Quote_model'));
		$this->load->model(array('Lead_model'));
		$this->load->model(array('Product_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}

	public function lead_list(){
    // POST data
    $postData = $this->input->post();

    // Get data
    $data = $this->Productcosting_model->lead_list($postData);

    echo json_encode($data);
  }

	public function index()
	{
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['product_lists'] = $this->Productcosting_model->get_product_list();
      	$data['user_list'] = $this->Buyerorder_model->get_user_list();
		$financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;/*
		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$country_id = $this->input->post('country_id');
      		$product_id = $this->input->post('product_id');
      		$user_id = $this->input->post('user_id');

			if($country_id !='')
			{
				$cid = " AND c.country = '$country_id'";
			}
			else
			{
				$cid = '';
			}

			if($product_id !='')
			{
				$pid = " AND pc.product_id = '$product_id'";
			}
			else
			{
				$pid = '';
			}

			if($user_id !='')
			{
				$uid = " AND pc.created_by = '$user_id'";
			}
			else
			{
				$uid = '';
			}
			$data['f_l_country'] = $country_id;
      		$data['f_l_product'] = $product_id;
      		$data['f_l_user'] = $user_id;

      		$fbase = $this->input->post('fbase');
    		$data['fbasesearch'] = $fbase;

    		if($fbase == '')
    		{
    			$data['purchasesearch'] = '';
				$data['drnge'] = '';
    			$data['fquartersearch'] = '';
    			//$data['ypick'] = '';

      			$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 $cid $pid $uid GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
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
    				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $pid $uid GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
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
    				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $pid $uid GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
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
					$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 $cid $pid $uid GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
				}
				elseif($schange == 'today')
				{
					$data['drnge'] = '';
					
					$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') = CURDATE() $cid $pid $uid GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
				}
				else if($schange == 'thisweek')
				{
					$data['drnge'] = '';
					
					$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND YEARWEEK(STR_TO_DATE(pc.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $pid $uid GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
				}      
				else if($schange == 'thismonth')
				{
					$data['drnge'] = '';
					
					$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND MONTH(STR_TO_DATE(pc.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $pid $uid GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
				}			
				else if($schange == 'thisyear')
				{
					$data['drnge'] = '';
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					
					$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $pid $uid GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
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
					
					$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $pid $uid GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
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
      		$data['f_l_product'] = '';
      		$data['f_l_user'] = '';
      		$data['fbasesearch'] = '';
    		$data['purchasesearch'] = '';
			$data['drnge'] = '';
			$data['fquartersearch'] = '';
			$data['product_costing_list'] = $this->Productcosting_model->get_product_costing_list();
		}*/
		$this->load->view('productcosting/product_costing_list', $data);
	}

	public function product_costing_result_list()
	{
		// $data['perpage'] = $perpage = 10;
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';

		$country_id = $this->input->post('country_id');
  		$product_id = $this->input->post('product_id');
  		$user_id = $this->input->post('user_id');

		if($country_id !='')
		{
			$cid = " AND c.country = '$country_id'";
		}
		else
		{
			$cid = '';
		}

		if($product_id !='')
		{
			$pid = " AND pc.product_id = '$product_id'";
		}
		else
		{
			$pid = '';
		}

		if($user_id !='')
		{
			$uid = " AND pc.created_by = '$user_id'";
		}
		else
		{
			$uid = '';
		}
		$data['f_l_country'] = $country_id;
  		$data['f_l_product'] = $product_id;
  		$data['f_l_user'] = $user_id;

  		if ($search_val != '') {
	      $sc = 'AND (pc.product_costing_no LIKE "%'.$search_val.'%" OR c.lead_name LIKE "%'.$search_val.'%" OR c.email_id LIKE "%'.$search_val.'%" OR p.product_name LIKE "%'.$search_val.'%" OR pi.product_item LIKE "%'.$search_val.'%" OR ac.name LIKE "%'.$search_val.'%" )';
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

			$data['product_costing_lists_count'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();

  			$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC LIMIT $page, $perpage")->result_array();
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

				$data['product_costing_lists_count'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();

				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC LIMIT $page, $perpage")->result_array();
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

				$data['product_costing_lists_count'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();

				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC LIMIT $page, $perpage")->result_array();
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

				$data['product_costing_lists_count'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();

				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC LIMIT $page, $perpage")->result_array();
			}
			elseif($schange == 'today')
			{
				$data['drnge'] = '';

				$data['product_costing_lists_count'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') = CURDATE() $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
				
				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') = CURDATE() $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC LIMIT $page, $perpage")->result_array();
			}
			else if($schange == 'thisweek')
			{
				$data['drnge'] = '';

				$data['product_costing_lists_count'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND YEARWEEK(STR_TO_DATE(pc.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
				
				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND YEARWEEK(STR_TO_DATE(pc.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC LIMIT $page, $perpage")->result_array();
			}      
			else if($schange == 'thismonth')
			{
				$data['drnge'] = '';

				$data['product_costing_lists_count'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND MONTH(STR_TO_DATE(pc.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
				
				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND MONTH(STR_TO_DATE(pc.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC LIMIT $page, $perpage")->result_array();
			}			
			else if($schange == 'thisyear')
			{
				$data['drnge'] = '';
				$finstart = $_SESSION['finstart'];
				$finend = $_SESSION['finend'];

				$data['product_costing_lists_count'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
				
				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC LIMIT $page, $perpage")->result_array();
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

				$data['product_costing_lists_count'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC")->result_array();
				
				$data['product_costing_list'] = $this->db->query("SELECT pc.*,max(pc.product_costing_id) as pcid,count(pc.product_costing_id) as pccount,pc.parent_costing_id,c.lead_name,c.email_id, p.product_name,pi.product_item,ac.name as country_name FROM product_costing pc, leads l,contact_book c, products p, product_items pi, ad_countries ac WHERE pc.lead_id = l.lead_id AND l.contact_book_id = c.contact_book_id AND pc.product_id = p.product_id AND pc.product_item_id = pi.product_item_id AND c.country = ac.id AND pc.status!=2 AND STR_TO_DATE(pc.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pc.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $cid $pid $uid $sc GROUP BY pc.parent_costing_id ORDER BY pcid DESC LIMIT $page, $perpage")->result_array();
			}
			//echo $schange;exit;
			$data['purchasesearch'] = $schange;
			$data['drnge'] = $dtrange;
			$data['fquartersearch'] = '';
			//$data['ypick'] = '';
		}
		 
		$this->load->view('productcosting/product_costing_list_table', $data);
	}

	public function product_costing_add($lid = null)
	{
		$data['container_list'] = $this->Product_model->get_container_list();
		$data['product_list'] = $this->Productcosting_model->get_product_list();
		$data['lead_list'] = $this->Productcosting_model->get_lead_list();
		$prodId = '';
		if($lid!=null)
		{
			$llist = $data['lead_details'] = $this->Lead_model->lead_by_id($lid);
			$data['contact_book_details'] = $this->Lead_model->contact_book_info_by_id($llist->contact_book_id);
			$prodId = $llist->product_id;
		}
		$st = '<option value="">Select Product Item</option>';
		/*$productcc = $this->Productcosting_model->get_product_item_by_product_id($prodId);
		if(count($productcc)>0)
		{
		  $st = '<option value="">Select Product Item</option>';
		  foreach ($productcc as $prod) {
		    $st.='<option value='.$prod["product_item_id"].'>'.$prod["product_item"].'</option>';
			}
		}
		else
		{
		  $st = '<option value="">Select Product</option>';
		}*/
		$data['productId'] = $prodId;
		$data['prodItem'] = $st;
		$data['lid'] = $lid;
		$this->load->view('productcosting/product_costing', $data);
	}

	public function getProductItem()
	{
		$prodId = $_POST['pId'];
		$contId = $_POST['value'];
		$productcc = $this->Productcosting_model->get_product_item_by_product_id($prodId,$contId);
		if(count($productcc)>0)
		{
		  $st = '<option value="">Select Product Item</option>';
		  foreach ($productcc as $prod) {
		    $st.='<option value='.$prod["product_item_id"].'>'.$prod["product_item"].' - '.$prod["container_name"].'</option>';
			}
		}
		else
		{
		  $st = '<option value="">No Item Available</option>';
		}
		echo $st;
	}

	public function getPPC()
	{
		$piid = $_POST['value'];
		$pid = $_POST['prodId'];
		//$data['product_mapping_list'] = $this->Productcosting_model->get_product_costing_product_mapping_by_pid($pid);
		$data['product_mapping_list'] = $this->Productcosting_model->get_product_costing_mapping();
		$data['product_list'] = $this->Productcosting_model->get_product_item_by_id($piid);
		$data['product_costing_stage'] = $this->Productcosting_model->get_product_costing_stage_by_piid($piid);
		$data['product_costing_type_list'] = $this->Productcosting_model->get_product_costing_type_list();

		$this->load->view('productcosting/product_costing_scoreboard', $data);
	}

	public function product_costing_save()
	{
		$data['lead_id'] = $this->input->post('lead_id');
		$data['product_id'] = $this->input->post('product_id');
		$data['container_id'] = $this->input->post('container_id');
		$data['product_item_id'] = $this->input->post('product_item_id');
		$data['product_item_display_name_id'] = $this->input->post('product_item_display_name_id')!=''?$this->input->post('product_item_display_name_id'):'0';
	    $data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];

	    $financial_year_to2 = (date('m') > 3) ? date('y') +1 : date('y');
      	$financial_year_from2 = $financial_year_to2 - 1;
      	$last_id_value = $this->Productcosting_model->product_costing_last_parent_id();

      	$finhi = $financial_year_from2.'-'.$financial_year_to2;

	    if(count($last_id_value)==0)
	    {
	      //$ino = $data['invoice_no'] = date("Y").'/'.date('m').'/'.$locDetails->location_code.'/INV001';
	      $data['product_costing_no'] = 'PI/'.$finhi.'/001';
	    }
	    else
	    {
	      $lno = $last_id_value->product_costing_no;
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
	        $data['product_costing_no'] = 'PI/'.$finhi.'/'.$nval;
	      }
	      else
	      {
	        $data['product_costing_no'] = 'PI/'.$finhi.'/001';
	      }
		}

		$last_id_value = $this->Productcosting_model->product_costing_last_id();
    	if(count($last_id_value)>0)
	    {
	      $last_value=$last_id_value->product_costing_id;
	      $data['parent_costing_id'] = $last_value+1;
	    }
	    else
	    {
	      $data['parent_costing_id'] = 1;
	    }

		$data['is_draft'] = $this->input->post('is_draft');
		$data['revised'] = 0;


	    $result = $this->Productcosting_model->create_product_costing($data);
	    if ($result) {
			$last_id_value = $this->Productcosting_model->product_costing_last_id();
			$last_value=$last_id_value->product_costing_id;
			$data1['product_costing_id'] = $last_value;

			$pctid = explode(",",implode(",",$this->input->post('product_costing_type_id')));
			$pci = explode(",",implode(",",$this->input->post('product_costing_input')));
			$subcount = count($this->input->post('product_costing_type_id')); 
			for($i=0;$i<$subcount;$i++)
			{
				if($pctid[$i]!='')
				{
					$data1['product_costing_type_id'] = $pctid[$i];
					$data1['product_costing_input'] = $pci[$i];
					$this->Productcosting_model->create_product_costing_input($data1);
				}
			}
		}
		$this->session->set_flashdata('qstage_success', 'Product Costing has been added successfully.');
    	redirect('/productcosting');
	}

	public function product_costing_edit($id)
	{
		$data['product_list'] = $this->Productcosting_model->get_product_list();
		$data['lead_list'] = $this->Productcosting_model->get_lead_list();
		$data['product_costing_type_list'] = $this->Productcosting_model->get_product_costing_type_list();

		$data['product_costing_list'] = $pclist = $this->Productcosting_model->get_product_costing_by_id($id);

		$productcc = $this->Productcosting_model->get_product_item_by_product_id($pclist->product_id,$pclist->container_id);
		if(count($productcc)>0)
		{
			$st = '<option value="">Select Product Item</option>';
			foreach ($productcc as $prod) {
				if($prod["product_item_id"] == $pclist->product_item_id)
					$st.='<option value='.$prod["product_item_id"].' selected>'.$prod["product_item"].'</option>';
				else
					$st.='<option value='.$prod["product_item_id"].'>'.$prod["product_item"].'</option>';
			}
		}
		else
		{
		  $st = '<option value="">No Item Available</option>';
		}
		$data['product_item_list'] = $st;

		//$data['product_mapping_list'] = $this->Productcosting_model->get_product_costing_product_mapping_by_pid($pclist->product_id);
		$data['product_mapping_list'] = $this->Productcosting_model->get_product_costing_mapping();
		$data['product_item_id_list'] = $this->Productcosting_model->get_product_item_by_id($pclist->product_item_id);
		$data['product_costing_stage'] = $this->Productcosting_model->get_product_costing_stage_by_piid($pclist->product_item_id);

		$this->load->view('productcosting/product_costing_edit', $data);
	}

	public function product_costing_update()
	{
		$pcid = $data['product_costing_id'] = $this->input->post('product_costing_id');
		if($this->input->post('old_is_draft')==0)
		{
			$data['lead_id'] = $this->input->post('lead_id');
			$data['product_id'] = $this->input->post('product_id');
			$data['container_id'] = $this->input->post('container_id');
			$data['product_item_id'] = $this->input->post('product_item_id');
			$data['product_item_display_name_id'] = $this->input->post('product_item_display_name_id')!=''?$this->input->post('product_item_display_name_id'):'0';
		    $data['created_on'] = date('Y-m-d H:i:s');
		    $data['created_by'] = $_SESSION['admindata']['user_id'];

		    $qno = $this->input->post('pc_no');

		    $pclist = $this->Productcosting_model->get_product_costing_by_no($qno);

		    if($pclist->revised==0)
		    {
		    	$pcid = $pclist->product_costing_id;
		    }
		    else
		    {
		    	$pcid = $pclist->parent_costing_id;
		    }

		    $pcrlist = $this->Productcosting_model->get_product_costing_by_revised($pcid);
		    if(count($pcrlist)>0)
		    {
		    	$qno = $pcrlist->product_costing_no;
		    }
		    else
		    {
		    	$qno = $pclist->product_costing_no;
		    }


			if(strpos($qno, ' - ') !== false)
		    {
		      $exp = explode(' - ', $qno);
		        $tval = $exp[1]+1;
		        $data['product_costing_no'] = $exp[0].' - '.$tval;
		    }
		    else
		    {
		      $data['product_costing_no'] = $qno.' - 1';
		    }

			$data['parent_costing_id'] = $this->input->post('parent_costing_id');

			$data['is_draft'] = $this->input->post('is_draft');
			$data['revised'] = 1;


		    $result = $this->Productcosting_model->create_product_costing($data);
		    if ($result) {
				$last_id_value = $this->Productcosting_model->product_costing_last_id();
				$last_value=$last_id_value->product_costing_id;
				$data1['product_costing_id'] = $last_value;

				$pctid = explode(",",implode(",",$this->input->post('product_costing_type_id')));
				$pci = explode(",",implode(",",$this->input->post('product_costing_input')));
				$subcount = count($this->input->post('product_costing_type_id')); 
				for($i=0;$i<$subcount;$i++)
				{
					if($pctid[$i]!='')
					{
						$data1['product_costing_type_id'] = $pctid[$i];
						$data1['product_costing_input'] = $pci[$i];
						$this->Productcosting_model->create_product_costing_input($data1);
					}
				}
			}
			$this->session->set_flashdata('qstage_success', 'Product Costing has been revised successfully.');
		}
		else
		{
			$pcid = $data['product_costing_id'] = $this->input->post('product_costing_id');
			$data['lead_id'] = $this->input->post('lead_id');
			$data['product_id'] = $this->input->post('product_id');
			$data['product_item_id'] = $this->input->post('product_item_id');
		    $data['modified_on'] = date('Y-m-d H:i:s');
		    $data['modified_by'] = $_SESSION['admindata']['user_id'];
		    $data['is_draft'] = $this->input->post('is_draft');
			$data['revised'] = 0;
			$data['parent_costing_id'] = $this->input->post('parent_costing_id');

		    $result = $this->Productcosting_model->update_product_costing($data);
		    if ($result) {

		    	$this->Productcosting_model->delete_product_costing_input_by_pcid($pcid);

				$data1['product_costing_id'] = $pcid;

				$pctid = explode(",",implode(",",$this->input->post('product_costing_type_id')));
				$pci = explode(",",implode(",",$this->input->post('product_costing_input')));
				$subcount = count($this->input->post('product_costing_type_id')); 
				for($i=0;$i<$subcount;$i++)
				{
					if($pctid[$i]!='')
					{
						$data1['product_costing_type_id'] = $pctid[$i];
						$data1['product_costing_input'] = $pci[$i];
						$this->Productcosting_model->create_product_costing_input($data1);
					}
				}
			}
			$this->session->set_flashdata('qstage_success', 'Product Costing has been udpated successfully.');
		}
    	redirect('/productcosting');
	}

	public function product_costing_view($id)
	{
		$quot['product_costing_id'] = $id;
		$quotlist = $this->Productcosting_model->get_product_costing_by_id($id);
		$qcode = $quotlist->parent_costing_id;
		//echo $qcode;exit;

		/*if(strpos($qcode, ' - ') !== false)
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
		}*/
		$quot['product_costing_list'] = $this->Productcosting_model->get_product_costing_by_parent_id($qcode);

		$this->load->view('productcosting/product_costing_view',$quot);
	}

	public function product_costing_delete()
	{
		$data['product_costing_id'] = $this->input->post('pcid');
	    $data['status'] = 2;
	    $result = $this->Productcosting_model->product_costing_delete($data);
	   $this->session->set_flashdata('qstage_success', 'Product Costing has been deleted successfully...');
	   redirect('/productcosting');     

	}

	public function product_costing_approve()
	{
		$data['product_costing_id'] = $this->input->post('pcostid');
	    $data['is_approve'] = 1;
		$data['approved_by'] = $_SESSION['admindata']['user_id'];
	    $data['approved_date'] = date('Y-m-d H:i:s');
	    $result = $this->Productcosting_model->product_costing_approve($data);
	   $this->session->set_flashdata('qstage_success', 'Product Costing has been approved successfully...');
	   redirect('/productcosting');     

	}

	public function move_to_quote()
	{
		$pcid = $_POST['id'];
		$fobusdval = $_POST['fobusdval'];
		$fobval = $_POST['fobval'];
		$curval = $_POST['curval'];
		/*print_r($fobusdval);
		echo implode(',', $fobusdval);
		exit;*/
		$fobusdvalarr = explode(',', $fobusdval);
		$fobvalarr = explode(',', $fobval);

		$pstage = $this->Productcosting_model->get_product_costing_stage_by_product_costing_id($pcid);
		if(count($pstage)>0)
		{
		  $st = '<option value="">Select Stage</option>';
		  $stfob =  '<option value="">Select Stage</option>';
		  $s=0;foreach ($pstage as $ps) {
		    $st.='<option value='.$s.'>'.$ps["stage_sku_name"].' - CNF : '.$fobusdvalarr[$s].'</option>';
		    $stfob.='<option value='.$s.'>'.$ps["stage_sku_name"].' - FOB : '.$fobvalarr[$s].'</option>';
			$s++;}
		}
		else
		{
		  $st = '<option value="">No Stage Available</option>';
		  $stfob = '<option value="">No Stage Available</option>';
		}

		$data['pcid']=$pcid;
		$data['fobusdval'] = $fobusdval;
		$data['fobval'] = $fobval;
		$data['curval'] = $curval;
		$data['stage'] = $st;
		$data['fobstage'] = $stfob;
		$this->load->view('productcosting/move_to_quote', $data);

	}

	public function quote_create()
	{
		$data['pcid'] = $pcid = $this->input->post('product_costing_id');
		$data['fobusdval'] = $fobusdval = $this->input->post('fobusdval');
		$data['fobarrval'] = $fobarrval = $this->input->post('fobarrval');
		$data['curval'] = $curval = $this->input->post('curval');
		$data['stage_id'] = $stage_id = $this->input->post('stage_id');
		$data['fob_stage_id'] = $fob_stage_id = $this->input->post('fob_stage_id');
		$data['stage_type'] = $stage_type = $this->input->post('stage_type');
		$data['quote_type'] = $this->input->post('quote_type');
		$pclist = $this->Productcosting_model->get_product_costing_by_id($pcid);
		$data['lead_list'] = $this->Productcosting_model->lead_by_id($pclist->lead_id);

		//$data['pcstagelist'] = $this->input->post('pcstagelist');

		$fobusdvalarr = explode(',', $fobusdval);
		$fobvalarr = explode(',', $fobarrval);

		$data['product_costing_list_parent'] = $this->Productcosting_model->get_product_costing_by_parent_id($pclist->parent_costing_id);

		$pstage = $this->Productcosting_model->get_product_costing_stage_by_product_costing_id($pcid);
		if(count($pstage)>0)
		{
		  $st = '<option value="">Select Stage</option>';
		  $stfob =  '<option value="">Select Stage</option>';
		  $s=0;foreach ($pstage as $ps) {
		  	if($s==$stage_id)
		  	{
		    	$st.='<option value='.$s.' selected>'.$ps["stage_sku_name"].' - CNF : '.$fobusdvalarr[$s].'</option>';
		    }
		    else
		    {		    	
		    	$st.='<option value='.$s.'>'.$ps["stage_sku_name"].' - CNF : '.$fobusdvalarr[$s].'</option>';
		    }
		    if($s==$fob_stage_id)
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

		$llist = $data['lead_details'] = $this->Lead_model->lead_by_id($pclist->lead_id);
		$data['contact_book_details'] = $this->Lead_model->contact_book_info_by_id($llist->contact_book_id);

		$data['product_item'] = $this->Productcosting_model->get_product_item_by_id($pclist->product_item_id);

		$data['dispname'] = $this->Productcosting_model->get_display_name_by_product_item_display_name_id($pclist->product_item_display_name_id);
		
		$data['product_unit'] = $this->Product_model->get_product_unit();

		$data['prodstage'] = $this->Productcosting_model->get_product_costing_stage_by_product_costing_id($pcid);

		if($stage_type=='cnf')
		{
			$expfob = explode(',', $fobusdval);
			$data['fobval'] = $expfob[$stage_id];
		}
		else
		{
			$expfob = explode(',', $fobarrval);
			$data['fobval'] = $expfob[$fob_stage_id];
		}
		$data['curval'] = $curval;
		/*echo "<pre>";
		print_r($data);exit;*/

		$data['exporter_list'] = $this->Quote_model->get_exporter_list();
		$data['quote_stage_list'] = $this->Quote_model->get_quote_stage_list();
		$data['opportunity_list'] = $this->Quote_model->get_oppertunity_list();
		$data['vessel_flight_list'] = $this->Quote_model->get_vessel_flight_list();
		$data['port_list'] = $this->Quote_model->get_port_list();
		$data['price_term_list'] = $this->Quote_model->get_price_terms_list();
		$data['currency_list'] = $this->Quote_model->get_currency_list();
		$data['vendor_list'] = $this->Quote_model->get_vendor_list();
		$data['product_item_list'] = $this->Quote_model->get_product_item_list();
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

		$this->load->view('productcosting/quote_add', $data);
	}



	public function get_display_name()
	{
		$piid = $_POST['value'];
		$displayname = $this->Product_model->get_display_name_by_piid($piid);
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
		echo $st;
	}

	public function change_quote_product_costing()
	{
		$pcid = $_POST['id'];
		$data['product_costing_list'] = $this->Productcosting_model->get_product_costing_by_id($pcid);
		//print_r($data);exit;
		$this->load->view('productcosting/quote_product_costing_view',$data);
	}

	public function product_costing_change()
	{
		$pcid = $_POST['id'];
		$fobusdval = $_POST['fobusdval'];
		$fobval = $_POST['fobval'];
		$curval = $_POST['curval'];
		/*print_r($fobusdval);
		echo implode(',', $fobusdval);
		exit;*/
		$fobusdvalarr = explode(',', $fobusdval);
		$fobvalarr = explode(',', $fobval);

		$pstage = $this->Productcosting_model->get_product_costing_stage_by_product_costing_id($pcid);
		if(count($pstage)>0)
		{
		  $st = '<option value="">Select Stage</option>';
		  $stfob =  '<option value="">Select Stage</option>';
		  $s=0;foreach ($pstage as $ps) {
		    $st.='<option value='.$s.'>'.$ps["stage_sku_name"].' - CNF : '.$fobusdvalarr[$s].'</option>';
		    $stfob.='<option value='.$s.'>'.$ps["stage_sku_name"].' - FOB : '.$fobvalarr[$s].'</option>';
			$s++;}
		}
		else
		{
		  $st = '<option value="">No Stage Available</option>';
		  $stfob = '<option value="">No Stage Available</option>';
		}

		$data['curval'] = $curval;
		$data['stage'] = $st;
		$data['fobstage'] = $stfob;
		//$this->load->view('productcosting/move_to_quote', $data);
		echo $curval."|".$st."|".$stfob."|".$fobusdval."|".$fobval;

	}

}
?>