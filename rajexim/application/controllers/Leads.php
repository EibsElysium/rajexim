<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
require_once 'dompdf/autoload.inc.php';

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/* reference the Dompdf namespace */

use Dompdf\Dompdf;
/* ************************************************************************************
		Purpose : To handle all the Lead functions
		Date    : 06-11-2019 
***************************************************************************************/
class Leads extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Lead_model', 'Product_model', 'User_model', 'Setting_model', 'User_model', 'Mailbox_model','Productcosting_model','Proformainvoice_model','Buyerorder_model','Task_model','Multiproductcostingproduct_model','Quote_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}

	/* ************************************************************************************
						Purpose : To handle Lead Functions
	        **********************************************************************/
	public function index()
	{	
		$data['industry_lists'] = $this->Setting_model->industry_list();
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['product_lists'] = $this->Product_model->lead_product_list();
		$data['lead_type_lists'] = $this->Lead_model->lead_type_list();
		$data['lead_source_lists'] = $this->Lead_model->lead_source_list();
		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		$data['assigned_user_lists'] = $this->Lead_model->product_assigned_users();

		$lead_type = $this->input->post('list_lead_type');
		$lead_source = $this->input->post('list_lead_source');
		$list_lsource = $this->input->post('list_lsource');
		$lead_status = $this->input->post('list_lead_status');
		$lead_country = $this->input->post('list_lead_country');
		$lead_assigned_to = $this->input->post('filt_assign_to');
		$data['selected_lead_ass'] = $lead_assigned_to;
		$data['selected_country'] = $lead_country;
		$lead_daterange = ($this->input->post('lead_list_date') != '') ? $this->input->post('lead_list_date') : '';
		$list_product = ($this->input->post('list_product') != '') ? $this->input->post('list_product') : '';

		if($this->input->post('l_year'))
		{
			$l_year = explode('-', $this->input->post('l_year'));
			$data['p_month'] = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
			$data['p_year']  = ($l_year[0]) ? $l_year[0] : date('Y');
		}
		else
		{
			$data['p_month'] =  "";
			$data['p_year']  = "";
		}
		
		$data['f_year_month'] = ($this->input->post('l_year')) ? $this->input->post('l_year') : date('Y-M');
		$data['list_lead_type'] = $this->input->post('list_lead_type');
		$data['list_lead_source'] = $this->input->post('list_lead_source');
		$data['list_lsource'] = $this->input->post('list_lsource');
		$data['lead_list_date'] = $lead_daterange;
		$data['list_lead_status'] = $this->input->post('list_lead_status');
		$data['list_product'] = $list_product;


		if(isset($_GET['active_tab']) &&  $_GET['active_tab']!='')
		{

			$data['tab_val'] = $_GET['active_tab'];
		// 	echo $data['tab_val'];
		// die();
		}
		else 
		{
			$data['tab_val'] = 1;
		}

		if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1)
		{
			$t_fup = 1;
			
		}else if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1){
			$t_fup = 1;
			
		}else{
			$t_fup = '';
			
		 }
		$perpage = '';
		$page = '';
		$search_val = '';
		$data['get_all_lead_template'] = $this->Lead_model->get_filter_template_by_module('1');
		 // $data['lead_lists'] = $this->Lead_model->lead_list($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $data['p_year'], $data['p_month'], $list_product, $data['tab_val'], $lead_country, $lead_assigned_to, $page, $perpage, $search_val);
		 $data['lead_today_fup_count'] = $this->Lead_model->lead_today_followup_list($lead_type , $lead_source, $lead_daterange,$lead_status, $list_product, $data['tab_val'],$list_lsource);
		 $data['today_leads'] = $this->Lead_model->lead_count_by_date($date = date('Y-m-d'), 0);
		 
		$this->load->view('lead/lead_list', $data);
	}
	public function lead_list_result_by_filters()
	{
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['product_lists'] = $this->Product_model->lead_product_list();
		$data['lead_type_lists'] = $this->Lead_model->lead_type_list();
		$data['lead_source_lists'] = $this->Lead_model->lead_source_list();
		$data['sub_lead_sources'] = $this->Lead_model->sub_lead_source_list();
		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['assigned_user_lists'] = $this->Lead_model->product_assigned_users();


		// $data['perpage'] = $perpage = 10;
		$_SESSION['lead_perpage'] = $data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		// $data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';
		$_SESSION['lead_search_val'] = $data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$_SESSION['lead_current_pagination_index'] = $data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
		$_SESSION['lead_page'] = $data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';
		
		// $data['country_lists'] = $this->Lead_model->country_list();
		// $data['product_lists'] = $this->Product_model->lead_product_list();
		// $data['lead_type_lists'] = $this->Lead_model->lead_type_list();
		// $data['lead_source_lists'] = $this->Lead_model->lead_source_list();
		// $data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		// $data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		// $data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();

		// $filter_templates = $this->input->post('filter_templates');

		$_SESSION['lead_leadtype'] = $lead_type = $this->input->post('list_lead_type');
		$_SESSION['lead_leadsource'] = $lead_source = $this->input->post('list_lead_source');
		$_SESSION['lead_leadstatus'] = $lead_status = $this->input->post('list_lead_status');
		$_SESSION['lead_leadcountry'] = $data['list_lead_country'] = $lead_country = $this->input->post('list_lead_country');
		$_SESSION['lead_leadassignto'] = $data['filt_assign_to'] = $lead_assigned_to = $this->input->post('filt_assign_to');
		$_SESSION['lead_list_lsource'] = $list_lsource = $this->input->post('list_lsource');

		$data['selected_lead_ass'] = $lead_assigned_to;
		$data['selected_country'] = $lead_country;
		// $lead_daterange = ($this->input->post('lead_list_date') != '') ? $this->input->post('lead_list_date') : '';
		$_SESSION['lead_dtrange_from'] = $dtrange_from = $this->input->post('dtrange_from');
		$_SESSION['lead_dtrange_to'] = $dtrange_to = $this->input->post('dtrange_to');
		

		if ($dtrange_from != '' && $dtrange_to != '') {
			$lead_daterange = $dtrange_from.' - '.$dtrange_to;
		}
		else {
			$lead_daterange = '';	
		}
			
		$_SESSION['lead_leadproduct'] = $data['list_product'] = $list_product = ($this->input->post('list_product') != '') ? $this->input->post('list_product') : '';



		$_SESSION['lead_leadfilttype'] = $filter_type = $this->input->post('filter_type');

		if ( ($lead_type != '' || $lead_source != '' || $lead_status != '' || $lead_country != '' || $lead_assigned_to != '' || $dtrange_from != '' || $dtrange_to != '' || $this->input->post('l_year') != '' || $list_product != '' || $list_lsource != '') && $filter_type == '0' ) {
			$data['save_temp_btn_flag'] = '1';
		}
		else {
			$data['save_temp_btn_flag'] = '0';
		}

		if($this->input->post('l_year'))
		{
			$l_year = explode('-', $this->input->post('l_year'));
			$data['p_month'] = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
			$data['p_year']  = ($l_year[0]) ? $l_year[0] : date('Y');
		}
		else
		{
			$data['p_month'] =  "";
			$data['p_year']  = "";
		}
		
		$_SESSION['lead_f_year_month'] = $data['f_year_month'] = ($this->input->post('l_year')) ? $this->input->post('l_year') : date('Y-M');
		$data['list_lead_type'] = $this->input->post('list_lead_type');
		$data['list_lead_source'] = $this->input->post('list_lead_source');
		$data['list_lsource'] = $this->input->post('list_lsource');
		$data['dtrange_from'] = $dtrange_from;
		$data['dtrange_to'] = $dtrange_to;

		$data['list_lead_status'] = $this->input->post('list_lead_status');
		$data['list_product'] = $list_product;

		if(isset($_GET['active_tab']) &&  $_GET['active_tab']!='')
		{
			$data['tab_val'] = $_GET['active_tab'];
		}
		else 
		{
			$data['tab_val'] = 1;
		}

		if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1)
		{
			$t_fup = 1;
			
		}else if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1){
			$t_fup = 1;
			
		}
		else{
			$t_fup = '';
		}

if(is_array($list_product))
	$list_product = implode(',', $list_product);
if(is_array($lead_assigned_to))
	$lead_assigned_to = implode(',', $lead_assigned_to);

		$is_filt_temp = $this->input->post('is_filt_temp');
		$filt_temp_name = $this->input->post('filt_temp_name');

		$temp_array = array();
		if ($this->input->post('l_year') != '') {
			$temp_array[] = 'l_year='.$this->input->post('l_year');
		}
		if ($list_product != '') {
			$temp_array[] = 'list_product='.$list_product;
		}
		if ($lead_type != '') {
			$temp_array[] = 'list_lead_type='.$this->input->post('list_lead_type');
		}
		if ($lead_source != '') {
			$temp_array[] = 'list_lead_source='.$this->input->post('list_lead_source');
		}
		if ($list_lsource != '') {
			$temp_array[] = 'list_lsource='.$this->input->post('list_lsource');
		}
		if ($lead_country != '') {
			$temp_array[] = 'list_lead_country='.$this->input->post('list_lead_country');
		}
		if ($this->input->post('list_lead_status') != '') {
			$temp_array[] = 'list_lead_status='.$this->input->post('list_lead_status');
		}
		if ($this->input->post('filt_assign_to') != '') {
			$temp_array[] = 'filt_assign_to='.$lead_assigned_to;	
		}
		if ($this->input->post('dtrange_from') != '') {
			$temp_array[] = 'dtrange_from='.$this->input->post('dtrange_from');	
		}
		if ($this->input->post('dtrange_to') != '') {
			$temp_array[] = 'dtrange_to='.$this->input->post('dtrange_to');	
		}
		$filt_temp = implode('~', $temp_array);
		// echo $filt_temp;
		// print_r($temp_array);
		// die();

		if ($is_filt_temp == '1') {
			$add_filt_template = $this->Lead_model->add_filt_template('1',$filt_temp_name,$filt_temp);
		}

		$data['product_sort'] = $product_sort = $this->input->post('product_sort');
		$data['country_sort'] = $country_sort = $this->input->post('country_sort');
		$data['leadsource_sort'] = $leadsource_sort = $this->input->post('leadsource_sort');
		$data['priority_sort'] = $priority_sort = $this->input->post('priority_sort');
		$data['status_sort'] = $status_sort = $this->input->post('status_sort');
		$data['user_sort'] = $user_sort = $this->input->post('user_sort');
		$data['created_on_sort'] = $created_on_sort = $this->input->post('created_on_sort');
		$data['leadname_sort'] = $leadname_sort = $this->input->post('leadname_sort');

	  	$_SESSION['lead_dtrange_or_other'] = $data['dtrng_or_other'] = $dtrng_or_other = $this->input->post('dtrng_or_other');
//echo $list_product;
		 $data['lead_lists_count'] = $this->Lead_model->lead_list_count($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $data['p_year'], $data['p_month'], $list_product, $data['tab_val'], $lead_country, $lead_assigned_to, $search_val, $list_lsource, $product_sort, $dtrng_or_other);

		 $data['lead_lists'] = $this->Lead_model->lead_list($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $data['p_year'], $data['p_month'], $list_product, $data['tab_val'], $lead_country, $lead_assigned_to, $page, $perpage, $search_val, $list_lsource, $product_sort,$country_sort,$leadsource_sort,$priority_sort,$status_sort,$user_sort,$created_on_sort,$leadname_sort,$dtrng_or_other);

		 $data['lead_today_fup_count'] = $this->Lead_model->lead_today_followup_list($lead_type , $lead_source, $lead_daterange,$lead_status, $list_product, $data['tab_val'], $list_lsource);
		 $data['today_leads'] = $this->Lead_model->lead_count_by_date($date = date('Y-m-d'), 0);
		 
		$this->load->view('lead/lead_list_table', $data);
	}
	public function lead_filter_template_val_split()
	{
		$filter_templates = $this->input->post('filter_templates');
		$split_each = explode('~', $filter_templates);
		$filter_options_arr = array('l_year' => '', 'list_product' => '', 'list_lead_type' => '', 'list_lead_source' => '', 'list_lead_country' => '','list_lead_status' => '', 'filt_assign_to' => '', 'dtrange_from' => '', 'dtrange_to' => '', 'list_lsource' => '');
		// for ($i=0; $i < count($filter_options_arr); $i++) { 
			
		// }
		for ($i=0; $i < count($split_each); $i++) { 
			$split_with_equalto = explode('=', $split_each[$i]);
			if (array_key_exists($split_with_equalto[0],$filter_options_arr))
			{
				$filter_options_arr[$split_with_equalto[0]] = $split_with_equalto[1];
			}
		}
		echo json_encode($filter_options_arr);
		// echo $implode_filters = implode('|', $filter_options_arr);
		

	}
	// To get only opportunities leads
	public function opportunity_list()
	{	
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['product_lists'] = $this->Product_model->lead_product_list();
		$data['lead_type_lists'] = $this->Lead_model->lead_type_list();
		$data['lead_source_lists'] = $this->Lead_model->lead_source_list();
		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		$data['assigned_user_lists'] = $this->Lead_model->product_assigned_users();

		if($this->input->post('l_year'))
		{
			$l_year = explode('-', $this->input->post('l_year'));
			$data['p_month'] = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
			$data['p_year']  = ($l_year[0]) ? $l_year[0] : date('Y');
		}
		else{
			$data['p_month'] =  "";
			$data['p_year']  = "";
		}
	
		$data['f_year_month'] = ($this->input->post('l_year')) ? $this->input->post('l_year') : date('Y-M');
		$lead_assigned_to = $this->input->post('filt_assign_to');
		$lead_type = $this->input->post('list_lead_type');
		$lead_source = $this->input->post('list_lead_source');
		$list_lsource = $this->input->post('list_lsource');
		$lead_status = $this->input->post('list_lead_status');
		$lead_daterange = ($this->input->post('lead_list_date') != '') ? $this->input->post('lead_list_date') : '';
		$list_product = ($this->input->post('list_product') != '') ? $this->input->post('list_product') : '';
		$data['list_lead_type'] = $this->input->post('list_lead_type');
		$data['list_lead_source'] = $this->input->post('list_lead_source');
		$data['lead_list_date'] = $lead_daterange;
		$data['list_lsource'] = $this->input->post('list_lsource');
		$data['list_lead_status'] = $this->input->post('list_lead_status');
		$data['selected_lead_ass'] = $lead_assigned_to;
		$data['list_product'] = $list_product;
		$lead_country = $this->input->post('list_lead_country');
		$data['selected_country'] = $lead_country;
		if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1)
		{
			$t_fup = 1;
			
		}else if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1){
			$t_fup = 1;
			
		}else{
			$t_fup = '';
			
		 }

		if(isset($_GET['active_tab']) &&  $_GET['active_tab']!='')
		{
			$data['tab_val'] = $_GET['active_tab'];
		}
		else 
		{
			$data['tab_val'] = 1;
		}
		$perpage = '';
		$page = '';
		$search_val = '';
		// $data['lead_lists'] = $this->Lead_model->opportunity_lead_list($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $data['p_year'], $data['p_month'], $list_product, $data['tab_val'],$lead_country,$lead_assigned_to, $page, $perpage, $search_val);
		$data['get_all_oppo_template'] = $this->Lead_model->get_filter_template_by_module('2');
		 $data['lead_today_fup_count'] = $this->Lead_model->opportunity_lead_today_followup_list($lead_type , $lead_source, $lead_daterange,$lead_status, $list_product, $data['tab_val'],$list_lsource);
		 $data['today_leads'] = $this->Lead_model->lead_count_by_date($date = date('Y-m-d'), 1);
		 $data['today_convert_leads'] = $this->Lead_model->lead_convert_count_by_date($date = date('Y-m-d'));
		$this->load->view('lead/opportunity_list', $data);
	}
	public function oppo_list_result_by_filters()
	{
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';

		$data['country_lists'] = $this->Lead_model->country_list();
		$data['product_lists'] = $this->Product_model->lead_product_list();
		$data['lead_type_lists'] = $this->Lead_model->lead_type_list();
		$data['lead_source_lists'] = $this->Lead_model->lead_source_list();
		$data['sub_lead_sources'] = $this->Lead_model->sub_lead_source_list();
		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		$data['assigned_user_lists'] = $this->Lead_model->product_assigned_users();

		if($this->input->post('l_year'))
		{
			$l_year = explode('-', $this->input->post('l_year'));
			$data['p_month'] = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
			$data['p_year']  = ($l_year[0]) ? $l_year[0] : date('Y');
		}
		else{
			$data['p_month'] =  "";
			$data['p_year']  = "";
		}
	
		$data['f_year_month'] = ($this->input->post('l_year')) ? $this->input->post('l_year') : date('Y-M');
		$lead_assigned_to = $this->input->post('filt_assign_to');
		$lead_type = $this->input->post('list_lead_type');
		$lead_source = $this->input->post('list_lead_source');
		$list_lsource = $this->input->post('list_lsource');
		$lead_status = $this->input->post('list_lead_status');
		// $lead_daterange = ($this->input->post('lead_list_date') != '') ? $this->input->post('lead_list_date') : '';
		$dtrange_from = $this->input->post('dtrange_from');
		$dtrange_to = $this->input->post('dtrange_to');
		if ($dtrange_from != '' && $dtrange_to != '') {
			$lead_daterange = $dtrange_from.' - '.$dtrange_to;
		}
		else {
			$lead_daterange = '';	
		}
		$list_product = ($this->input->post('list_product') != '') ? $this->input->post('list_product') : '';

		$data['list_lead_type'] = $this->input->post('list_lead_type');
		$data['list_lead_source'] = $this->input->post('list_lead_source');
		$data['list_lsource'] = $this->input->post('list_lsource');
		// $data['lead_list_date'] = $lead_daterange;
		$data['dtrange_from'] = $dtrange_from;
		$data['dtrange_to'] = $dtrange_to;
		$data['list_lead_status'] = $this->input->post('list_lead_status');
		$data['selected_lead_ass'] = $lead_assigned_to;
		$data['list_product'] = $list_product;
		$data['list_lead_country'] = $lead_country = $this->input->post('list_lead_country');
		$filter_type = $this->input->post('filter_type');
		if ( ($lead_type != '' || $lead_source != '' || $lead_status != '' || $lead_country != '' || $lead_assigned_to != '' || $dtrange_from != '' || $dtrange_to != '' || $this->input->post('l_year') != '' || $list_product != '' || $list_lsource != '') && $filter_type == '0') {
			$data['save_temp_btn_flag'] = '1';
		}
		else {
			$data['save_temp_btn_flag'] = '0';
		}
		$data['selected_country'] = $lead_country;
		if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1)
		{
			$t_fup = 1;
			
		}else if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1){
			$t_fup = 1;
			
		}else{
			$t_fup = '';
			
		 }

		if(isset($_GET['active_tab']) &&  $_GET['active_tab']!='')
		{
			$data['tab_val'] = $_GET['active_tab'];
		}
		else 
		{
			$data['tab_val'] = 1;
		}
		$is_filt_temp = $this->input->post('is_filt_temp');
		$filt_temp_name = $this->input->post('filt_temp_name');

		if(is_array($list_product))
			$list_product = implode(',', $list_product);
		if(is_array($lead_assigned_to))
			$lead_assigned_to = implode(',', $lead_assigned_to);

		$temp_array = array();
		if ($this->input->post('l_year') != '') {
			$temp_array[] = 'l_year='.$this->input->post('l_year');
		}
		if ($list_product != '') {
			$temp_array[] = 'list_product='.$list_product;
		}
		if ($lead_type != '') {
			$temp_array[] = 'list_lead_type='.$this->input->post('list_lead_type');
		}
		if ($lead_source != '') {
			$temp_array[] = 'list_lead_source='.$this->input->post('list_lead_source');
		}
		if ($list_lsource != '') {
			$temp_array[] = 'list_lsource='.$this->input->post('list_lsource');
		}
		if ($lead_country != '') {
			$temp_array[] = 'list_lead_country='.$this->input->post('list_lead_country');
		}
		if ($this->input->post('list_lead_status') != '') {
			$temp_array[] = 'list_lead_status='.$this->input->post('list_lead_status');
		}
		if ($this->input->post('filt_assign_to') != '') {
			$temp_array[] = 'filt_assign_to='.$lead_assigned_to;	
		}
		if ($this->input->post('dtrange_from') != '') {
			$temp_array[] = 'dtrange_from='.$this->input->post('dtrange_from');	
		}
		if ($this->input->post('dtrange_to') != '') {
			$temp_array[] = 'dtrange_to='.$this->input->post('dtrange_to');	
		}
		$filt_temp = implode('~', $temp_array);
		// echo $filt_temp;
		// print_r($temp_array);
		// die();

		if ($is_filt_temp == '1') {
			$add_filt_template = $this->Lead_model->add_filt_template('2',$filt_temp_name,$filt_temp);
		}

		$data['product_sort'] = $product_sort = $this->input->post('product_sort');
		$data['country_sort'] = $country_sort = $this->input->post('country_sort');
		$data['leadsource_sort'] = $leadsource_sort = $this->input->post('leadsource_sort');
		$data['priority_sort'] = $priority_sort = $this->input->post('priority_sort');
		$data['status_sort'] = $status_sort = $this->input->post('status_sort');
		$data['user_sort'] = $user_sort = $this->input->post('user_sort');
		$data['leadname_sort'] = $leadname_sort = $this->input->post('leadname_sort');
		$data['created_on_sort'] = $created_on_sort = $this->input->post('created_on_sort');

		$data['dtrng_or_other'] = $dtrng_or_other = $this->input->post('dtrng_or_other');
		$data['lead_lists_count'] = $this->Lead_model->opportunity_lead_list_count($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $data['p_year'], $data['p_month'], $list_product, $data['tab_val'], $lead_country, $lead_assigned_to, $search_val, $list_lsource,$dtrng_or_other);
		$data['lead_lists'] = $this->Lead_model->opportunity_lead_list($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $data['p_year'], $data['p_month'], $list_product, $data['tab_val'],$lead_country,$lead_assigned_to, $page, $perpage, $search_val, $list_lsource, $product_sort,$country_sort,$leadsource_sort,$priority_sort,$status_sort,$user_sort,$created_on_sort,$leadname_sort,$dtrng_or_other);
		$data['lead_today_fup_count'] = $this->Lead_model->opportunity_lead_today_followup_list($lead_type , $lead_source, $lead_daterange,$lead_status, $list_product, $data['tab_val'], $list_lsource);
		 $data['today_leads'] = $this->Lead_model->lead_count_by_date($date = date('Y-m-d'), 1);
		 $data['today_convert_leads'] = $this->Lead_model->lead_convert_count_by_date($date = date('Y-m-d'));
		$this->load->view('lead/oppo_list_table', $data);
	}
	// To get product users by product id
	public  function product_user_list()
	{
		$product_id = $this->input->post('value');
		$product_users = $this->Product_model->product_users_by_id($product_id);
		$product_industry_id = $this->Lead_model->product_industry_by_product_id($product_id);
		$option = '<option value="">Choose</option>';
		if(!empty($product_users))
		{
			foreach ($product_users as $key => $product_user) {
				$option .= '<option value="'.$product_user->user_id.'">'.$product_user->user_name.'</option>';
			}
		}
		if(!empty($product_industry_id) && $product_industry_id->industry_name != '')
		{
			$industry_name_val = $product_industry_id->industry_name.'|'.$product_industry_id->industry_id;
		}else{
			$industry_name_val = '';
		}
		echo $option.'|'.$industry_name_val;
	}
	// To change type and status
	public function lead_status_type_change()
	{
		$value = $this->input->post('value');
		$lead_id = $this->input->post('lead_id');
		$type_val = $this->input->post('type_val');
		
		$opportunity_reason = ($this->input->post('reason')) ? $this->input->post('reason') : '';
		$lead_details = $this->Lead_model->lead_by_id($lead_id);
		if($type_val == 'lead_type')
		{
			$data['lead_id'] = $this->input->post('lead_id');
		    $data['type_val'] = $this->input->post('value');
		    $data['modified_by'] = $_SESSION['admindata']['user_id'];
		    $data['modified_on'] = date('Y-m-d H:i:s');


		    $result = $this->Lead_model->lead_status_type_change($data, 'lead_type_id');

		    $lead_type_details = $this->Lead_model->lead_type_by_id($data['type_val']);
		    $log_data['log_type'] = 2;
		    $log_data['log_details'] = 'Lead Type Changed  From - '. $lead_details->l_type.' To '. $lead_type_details->lead_type;

		    $result =  1;
		}
		else if($type_val == 'country'){

			$data['lead_id'] = $this->input->post('lead_id');
		    $data['type_val'] = $this->input->post('value');
		    $data['modified_by'] = $_SESSION['admindata']['user_id'];
		    $data['modified_on'] = date('Y-m-d H:i:s');
		    $result = $this->Lead_model->lead_status_type_change($data, 'country');

		    $lead_country_details = $this->Lead_model->country_name($data['type_val']);
		    $log_data['log_type'] = 2;
		    $log_data['log_details'] = 'Country Changed From - '. $lead_details->country_name.' To '. $lead_country_details->name;
		     $result =  1;
		}
		else if($type_val == 'lead_source'){
			$data['lead_id'] = $this->input->post('lead_id');
		    $data['type_val'] = $this->input->post('value');
		    $data['modified_by'] = $_SESSION['admindata']['user_id'];
		    $data['modified_on'] = date('Y-m-d H:i:s');
		    $result = $this->Lead_model->lead_status_type_change($data, 'lead_source_id');

		    /*$lead_source_details = $this->Lead_model->lead_source_by_id($data['type_val']);
		    $log_data['log_type'] = 2;
		    $log_data['log_details'] = 'Lead Source Changed From - '. $lead_details->lead_source_name.' To '. $lead_source_details->lead_source;*/
		    $lead_source_details = $this->Lead_model->get_sls_by_id($data['type_val']);
		    $log_data['log_type'] = 2;
		    $log_data['log_details'] = 'Lead Source Changed From - '. $lead_details->sub_lead_source_name.' To '. $lead_source_details->sub_lead_source;
		     $result =  1;
		}
		else if($type_val == 'status')
		{
			$data['lead_id'] = $this->input->post('lead_id');
		    $data['type_val'] = $this->input->post('value');
		    $data['modified_by'] = $_SESSION['admindata']['user_id'];
		    $data['modified_on'] = date('Y-m-d H:i:s');
		    $result = $this->Lead_model->lead_status_type_change($data, 'status');	
		    if ($data['type_val'] == 3) {
		    	$oppo_status = $this->input->post('oppo_status');
		    	$update_oppo_status = $this->Lead_model->update_oppo_status($data['lead_id'],$oppo_status);
		    }
		    else if ($data['type_val'] == 0) {
		    	$oppo_to_lead_status = $this->input->post('lead_status');
		    	$update_lead_status = $this->Lead_model->update_lead_status_from_oppo($data['lead_id'],$oppo_to_lead_status);
		    }
		    $opportunity_val = ($data['type_val'] == 3) ? $lead_details->lead_name.' has been moved to opportunity' : $lead_details->lead_name.' has been removed from opportunity.<br> <b>Reason</b> - '.$opportunity_reason;
		    $log_data['log_type'] = ($data['type_val'] == 3) ? 3 : 4;
		    $log_data['log_details'] = $opportunity_val;
		    if ($this->input->post('oppo_to_lead_lead_status') != "" ) {
				$lead_oppo_status_id =  $this->input->post('oppo_to_lead_lead_status');
				common_update_values("lead_status_id = '$lead_oppo_status_id'", "leads", "lead_id = '$lead_id'");
			}
		     $result =  2;
		}
		else{
			$data['lead_id'] = $this->input->post('lead_id');
		    $data['type_val'] = $this->input->post('value');
		    $data['modified_by'] = $_SESSION['admindata']['user_id'];
		    $data['modified_on'] = date('Y-m-d H:i:s');
		    $result = $this->Lead_model->lead_status_type_change($data, 'lead_status_id');

		    $lead_status_details = $this->Lead_model->lead_status_by_id($data['type_val']);
		    $log_data['log_type'] = 2;
		    $log_data['log_details'] = 'Lead Status Changes From - '. $lead_details->lead_status_name.' To '. $lead_status_details->lead_status;

		     $result =  1;
		}

		$log_data['lead_id'] = $this->input->post('lead_id');
		$log_data['created_by'] = $_SESSION['admindata']['user_id'];
		$log_data['created_on'] = date('Y-m-d H:i:s');
		$lead_log_result = $this->Lead_model->lead_log_save($log_data);
		echo  $result; die;
	}
	// To check lead name unique
	public function lead_name_unique()
  	{
	    $lead_name = $this->input->post('lead_name');
	    $result = $this->Lead_model->lead_name_unique($lead_name);
	   if($result){ echo 1; }else{ echo 0; }
  	}
  	

	
	// To check employee dob
	public function lead_dob_validation_18() 
	{
	    $dob = $_POST['date_of_birth'];
	    $dob = date('Y-m-d', strtotime($dob)); 
	    $date_of_birth = new DateTime($dob);
	    $date_of_now   = new DateTime(date('Y-m-d'));
	    $interval      = $date_of_birth->diff($date_of_now);
	    $year = $interval->format('%Y');
	    if($year < 18)
	    {
	      echo 1;
	    }
	}
	// To save lead details
	public function lead_save()
	{
		$lead_id = $this->Lead_model->lead_next_auto_id();
		$cont_book_id = '';
		$data['contact_book_id'] = $this->input->post('cont_book_id');
		if ($data['contact_book_id'] == 0) {
			$data['lead_name'] = $this->input->post('lead_name');
			$data['company_name'] = $this->input->post('company_name');
			$data['country'] = $this->input->post('country');
			$data['designation'] = $this->input->post('designation');
			$data['website'] = $this->input->post('website');
			$data['address'] = $this->input->post('address');
			$data['email_id'] = $this->input->post('email_id');
			$data['alternative_email_id'] = $this->input->post('alternative_email_id');
			$data['skype_id'] = $this->input->post('skype_id');
			$data['contact_no'] = $this->input->post('contact_no');
			$data['whatsapp_no'] = $this->input->post('whatsapp_no');
			$data['office_phone_no'] = $this->input->post('office_phone_no');
			$data['created_by'] = $_SESSION['admindata']['user_id'];
			$data['created_on'] = date('Y-m-d H:i:s');
			$add_contact_info = $this->Lead_model->add_new_contact_info($data);
			$contact_book_id = $add_contact_info;
		}
		else {
			$contact_book_id = $data['contact_book_id'];
		}
		$data1['lead_code'] = date('Y').''.date('m').''.'00'.$lead_id->AUTO_INCREMENT;
		$data1['cont_book_id_for_lead'] = $contact_book_id;
		$data1['product_id'] = $this->input->post('product_id');
		$data1['industry_id'] = $this->input->post('industry_id');
		$data1['lead_source_id'] = $this->input->post('lead_source');
		$data1['lead_type_id'] = $this->input->post('lead_type');
		$data1['lead_status_id'] = $this->input->post('lead_status');
		$data1['lead_assigned_to'] = $this->input->post('assigned_to');
		$data1['message'] = str_replace("'", '`', $this->input->post('lead_message'));
		$data1['created_by'] = $_SESSION['admindata']['user_id'];
		$data1['created_on'] = date('Y-m-d H:i:s');
		$data1['status'] = 0;
		$contact_person_name = $this->input->post('contact_person_name');
		$contact_person_phone = $this->input->post('contact_person_phone');
		$contact_person_email = $this->input->post('contact_person_email');

		$billing_address = $this->input->post('billing_address');
		$shipping_address = $this->input->post('shipping_address');

		if (!empty($billing_address)) {
			for ($i=0; $i < count($billing_address); $i++) { 
				$ba_data['contact_book_id'] = $contact_book_id;
				$ba_data['billing_address'] = $billing_address[$i];
				$save_billing_addr_info = $this->Lead_model->save_billing_addr_info($ba_data);
			}
		}

		if (!empty($shipping_address)) {
			for ($j=0; $j < count($shipping_address); $j++) { 
				$sa_data['contact_book_id'] = $contact_book_id;
				$sa_data['shipping_address'] = $shipping_address[$j];
				$save_shipping_addr_info = $this->Lead_model->save_shipping_addr_info($sa_data);
			}
		}

		if (!empty($contact_person_name)) {
			for ($k=0; $k < count($contact_person_name); $k++) { 
				if ($contact_person_name[$k] != '') {
					$cp_data['contact_book_id'] = $contact_book_id;
					$cp_data['contact_person_name'] = $contact_person_name[$k];
					$cp_data['contact_person_phone'] = $contact_person_phone[$k];
					$cp_data['contact_person_email'] = $contact_person_email[$k];
					$save_contact_person_info = $this->Lead_model->save_contact_person_info($cp_data);
				}
			}
		}
		

		$lead_result = $this->Lead_model->lead_save($data1);

		$log_data['lead_id'] = $lead_id->AUTO_INCREMENT;
		$log_data['log_type'] = 1;
		$log_data['log_details'] = $data['lead_name'].' - '.$data['company_name'].' has been created as new lead';
		$log_data['created_by'] = $_SESSION['admindata']['user_id'];
		$log_data['created_on'] = date('Y-m-d H:i:s');
		$lead_log_result = $this->Lead_model->lead_log_save($log_data);

		$data_n['notification_type_id'] = "1";
		$data_n['lead_id'] = $lead_id->AUTO_INCREMENT;
		$data_n['notification_allow_to'] = $this->input->post('assigned_to');
		$data_n['created_by'] = $_SESSION['admindata']['user_id'];
		$data_n['created_on'] = date('Y-m-d H:i:s');

		$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
		$this->session->set_flashdata('l_success', $this->input->post('lead_name').' has been created as new lead successfully...');
		redirect('Leads');

	}
	// To get lead view
	public function lead_view($lead_id)
	{
		$data['lead_comments_list'] = $this->Lead_model->get_lead_comments_by_id($lead_id);
		$data['get_whatsapp_conversation'] = common_select_values('*','lead_whatsapp_messages','lead_id = "'.$lead_id.'" ORDER BY lead_whatsapp_message_id DESC','result');
		$data['lead_view'] = $this->Lead_model->lead_by_id($lead_id);
		$data['contact_book_info'] = $this->Lead_model->contact_book_info_by_id($data['lead_view']->contact_book_id);
		$data['lead_followups'] = $this->Lead_model->lead_followup_by_id($lead_id);
		$data['product_costing_list'] = $this->Lead_model->get_product_costing_by_lead_id($lead_id);
		$data['multi_product_costing_product_list'] = $this->Lead_model->get_multi_product_costing_product_by_lead_id($lead_id);
		$data['proforma_invoice_list'] = $this->Lead_model->get_proforma_invoice_by_lead_id($lead_id);
		$data['buyer_order_list'] = $this->Lead_model->get_buyer_order_by_lead_id($lead_id);
		$data['quote_list'] = $this->Lead_model->get_quote_by_lead_id($lead_id);
		$ex_val = '';
		if(!empty($data['lead_view']) && $data['contact_book_info']->email_id != '')
		{

			$ex_val = explode('@', $data['contact_book_info']->email_id);
			$chk_domain_is_blocked = $this->Lead_model->chk_domain_is_blocked($ex_val[1]);
			
		  	if (count($chk_domain_is_blocked) == 0) {
				
				$data['lead_active_enquiries'] = $this->Lead_model->lead_active_enquiries($ex_val[1], $lead_id);
			}
			else {
				$data['lead_active_enquiries'] = '';
			}
		}	
		else{
			$data['lead_active_enquiries'] = '';
		}	
		$data['lead_id'] = $lead_id;
  		$data['get_all_mail_replies'] = $this->Lead_model->get_all_mail_replies($lead_id);
		// Lead Emails
		// $data['email_lists'] = $this->Lead_model->company_email_list($data['lead_view']->email_id);

		$get_role_id_by_user_id = $this->Mailbox_model->get_role_id_by_user_id($_SESSION['admindata']['user_id']);
	    $role_id = $get_role_id_by_user_id->role_id;
	    if ($role_id == 1) {
	      $data['email_lists'] = $this->Mailbox_model->email_list();
	    }
	    else {
	      $data['email_lists'] = $this->Mailbox_model->get_user_allocated_emails($_SESSION['admindata']['user_id']);
	    }
		// To get lead log
		$data['lead_log_lists'] = $this->Lead_model->lead_log_list($lead_id);
		$this->load->view('lead/lead_view', $data);
	}
	// Tp get lead follow up edit form
	public function lead_followup_edit()
  	{
	    $data['lead_id'] = $this->input->post('lead_id');
	    $data['lead_details'] = $this->Lead_model->lead_by_id($data['lead_id']);
	    $data['followup_lists'] = $this->Lead_model->followup_lists($data['lead_id']);
	    $this->load->view('lead/lead_followup_edit', $data);
	   
  	}

  	// Tp get lead follow up edit form
	public function opportunity_followup_edit()
  	{
	    $data['lead_id'] = $this->input->post('lead_id');
	    $data['lead_details'] = $this->Lead_model->lead_by_id($data['lead_id']);
	    $data['followup_lists'] = $this->Lead_model->followup_lists($data['lead_id']);
	    $this->load->view('lead/opportunity_followup_edit', $data);
	   
  	}
  	// To update lead follow up
  	public function lead_followup_update()
  	{	

  		if($this->input->post('assigned_to') != '')
  		{
  			$follow_up['assigned_to'] = $this->input->post('assigned_to');
	  		$follow_up['followup_date'] = date('Y-m-d', strtotime($this->input->post('followup_date')));
	  		$follow_up['followup_time'] = $this->input->post('followup_time');
	  		$follow_up['followup_purpose_next'] = $this->input->post('followup_purpose_next');
	  		$follow_up['lead_id'] = $this->input->post('lead_id');
     	    $follow_up['created_by'] = $_SESSION['admindata']['user_id'];
     	    $follow_up['created_on'] = date('Y-m-d H:i:s');;
	  		$follow_addUp_res = $this->Lead_model->followup_add($follow_up);
	  		$get_lfup_ai_id = $this->Lead_model->lead_followup_next_auto_id();
	  		$lfup_id = $get_lfup_ai_id->AUTO_INCREMENT;

	  		$data_n['notification_type_id'] = "2";
	  		$data_n['lead_id'] = $this->input->post('lead_id');
			$data_n['lead_followup_id'] = $lfup_id;
			$data_n['notification_allow_to'] = $this->input->post('assigned_to');
			$data_n['created_by'] = $_SESSION['admindata']['user_id'];
			$data_n['created_on'] = date('Y-m-d H:i:s');
			$save_notification = $this->Lead_model->add_lead_notification_save($data_n);

	  		$log_data['lead_id'] = $follow_up['lead_id'];
			$log_data['log_type'] = 6;
			$log_data['log_details'] = $follow_up['followup_date'].' '.$follow_up['followup_time'].' <br> '. $follow_up['followup_purpose_next'];
			$log_data['created_by'] = $_SESSION['admindata']['user_id'];
			$log_data['created_on'] = date('Y-m-d H:i:s');
			$lead_log_result = $this->Lead_model->lead_log_save($log_data);
  		}

  		if ($follow_addUp_res)
  		 {
		    $this->session->set_flashdata('l_success', 'Follow Up has been added successfully.');
		    
		}else{

		    $this->session->set_flashdata('l_err', 'Could not add follow up');
		}
	    redirect('Leads/');
  	}
  	// To update lead follow up
  	public function opportunity_followup_update()
  	{	

  		if($this->input->post('assigned_to') != '')
  		{
  			$follow_up['assigned_to'] = $this->input->post('assigned_to');
	  		$follow_up['followup_date'] = date('Y-m-d', strtotime($this->input->post('followup_date')));
	  		$follow_up['followup_time'] = $this->input->post('followup_time');
	  		$follow_up['followup_purpose_next'] = $this->input->post('followup_purpose_next');
	  		$follow_up['lead_id'] = $this->input->post('lead_id');
     	    $follow_up['created_by'] = $_SESSION['admindata']['user_id'];
     	    $follow_up['created_on'] = date('Y-m-d H:i:s');;
	  		$follow_addUp_res = $this->Lead_model->followup_add($follow_up);
	  		$log_data['lead_id'] = $follow_up['lead_id'];
			$log_data['log_type'] = 6;
			$log_data['log_details'] = $follow_up['followup_date'].' '.$follow_up['followup_time'].' <br> '. $follow_up['followup_purpose_next'];
			$log_data['created_by'] = $_SESSION['admindata']['user_id'];
			$log_data['created_on'] = date('Y-m-d H:i:s');
			$lead_log_result = $this->Lead_model->lead_log_save($log_data);
  		}

  		if ($follow_addUp_res)
  		 {
		    $this->session->set_flashdata('l_success', 'Follow Up has been added successfully.');
		    
		}else{

		    $this->session->set_flashdata('l_err', 'Could not add follow up');
		}
	    redirect('Leads/opportunity_list');
  	}

  	public function lead_fp_edit_status()
  	{
	    $lid = $this->input->post('id');
	    $data['lead_followups'] = $this->Lead_model->lead_followups_by_pending_lfuid($lid);
	    $this->load->view('lead/lead_fp_edit_status',$data);
 	}

 	public function opportunity_fp_edit_status()
  	{
	    $lid = $this->input->post('id');
	    $data['lead_followups'] = $this->Lead_model->lead_followups_by_pending_lfuid($lid);
	    $this->load->view('lead/opportunity_fp_edit_status',$data);
 	}
 		// To update lead follow up
  	public function lead_followup_update_status()
  	{	
  	
  		$lead_id = $this->input->post('fp_lead_id');
  		$data['lead_followups_id'] = $this->input->post('lead_fups_id');
	    $data['comments'] = $this->input->post('comments');
	    $data['comment_status'] = $this->input->post('comment_status');
	    $data['status'] = 1;
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] =  $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->lead_followup_update($data);

	    $log_data['lead_id'] = $lead_id;
		$log_data['log_type'] = 6;
		$log_data['log_details'] = $data['comments'];
		$log_data['created_by'] = $_SESSION['admindata']['user_id'];
		$log_data['created_on'] = date('Y-m-d H:i:s');
		$lead_log_result = $this->Lead_model->lead_log_save($log_data);

	    if ($result) {
	      $this->session->set_flashdata('l_success', 'Follow Up Status Deleted successfully.');
	    }
	    else{
	      $this->session->set_flashdata('l_err', 'Could not update follow up status!');
	    }

	    redirect('Leads/');
  	}
  	public function opportunity_followup_update_status()
  	{	
  	
  		$lead_id = $this->input->post('fp_lead_id');
  		$data['lead_followups_id'] = $this->input->post('lead_fups_id');
	    $data['comments'] = $this->input->post('comments');
	    $data['comment_status'] = $this->input->post('comment_status');
	    $data['status'] = 1;
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $data['modified_by'] =  $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->lead_followup_update($data);

	    $log_data['lead_id'] = $lead_id;
		$log_data['log_type'] = 6;
		$log_data['log_details'] = $data['comments'];
		$log_data['created_by'] = $_SESSION['admindata']['user_id'];
		$log_data['created_on'] = date('Y-m-d H:i:s');
		$lead_log_result = $this->Lead_model->lead_log_save($log_data);

	    if ($result) {
	      $this->session->set_flashdata('l_success', 'Follow Up Status Updated successfully.');
	    }
	    else{
	      $this->session->set_flashdata('l_err', 'Could not update follow up status!');
	    }

	    redirect('Leads/opportunity_list');
  	}

	// To change lead status
	public function lead_change_status()
	{
		$l_t_id = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Lead_model->lead_change_status($l_t_id, $status);
		if($result){ echo 1; }else{ echo 0; }
	}
	// To cancel lead
	public function cancel_lead()
  	{
	    $lid = $data['bid']=$_POST['id'];
	    $logid = $_SESSION['admindata']['user_id'];
	    $data['log_user']  = login_user_details($logid);
	    $data['lead_list'] = $this->Lead_model->lead_by_id($lid);
	    $this->load->view('lead/cancel_lead',$data);
  	}	

  	// To cancel lead
	public function opportunity_cancel_lead()
  	{
	    $lid = $data['bid']=$_POST['id'];
	    $logid = $_SESSION['admindata']['user_id'];
	    $data['log_user']  = login_user_details($logid);
	    $data['lead_list'] = $this->Lead_model->lead_by_id($lid);
	    $this->load->view('lead/opportunity_cancel_lead',$data);
  	}	

  	// Tp get lead follow up view form
	public function lead_followup_view()
  	{
	    $id = $this->input->post('followup_id');
	    $data['followup_view'] = $this->Lead_model->lead_followup_by_id_edit($id);
	    $this->load->view('lead/lead_followup_view', $data);
	   
  	}
  	// To delete lead
  	public function lead_delete()
  	{ 
	    $bid=$_POST['field'];
	    $d_by = $_SESSION['admindata']['user_id'];
	    $d_on = date('Y-m-d H:i:s');
	    $reason = ($this->input->post('reason')) ? '<br<Reason -'.$this->input->post('reason') : '';
	    $result = $this->Lead_model->lead_cancel($bid,$d_by,$d_on);

	    $log_data['lead_id'] = $bid;
		$log_data['log_type'] = 5;
		$log_data['log_details'] = 'Lead has been deleted.'.$reason;
		$log_data['created_by'] = $_SESSION['admindata']['user_id'];
		$log_data['created_on'] = date('Y-m-d H:i:s');
		$lead_log_result = $this->Lead_model->lead_log_save($log_data);

	    if ($result) {
	      $this->session->set_flashdata('l_success', 'Lead has been Droped successfully.');
	    }
	    else{
	      $this->session->set_flashdata('l_err', 'Could not drop lead!');
	    }
	    redirect('Leads');
    }
    // To delete lead
  	public function opportunity_lead_delete()
  	{ 
	    $bid=$_POST['field'];
	    $reason = ($this->input->post('reason')) ? '<br<Reason -'.$this->input->post('reason') : '';
	    $result = $this->Lead_model->lead_cancel($bid);

	    $log_data['lead_id'] = $bid;
		$log_data['log_type'] = 5;
		$log_data['log_details'] = 'Lead has been deleted.'.$reason;
		$log_data['created_by'] = $_SESSION['admindata']['user_id'];
		$log_data['created_on'] = date('Y-m-d H:i:s');
		$lead_log_result = $this->Lead_model->lead_log_save($log_data);

	    if ($result) {
	      $this->session->set_flashdata('l_success', 'Opportunity has been archived successfully.');
	    }
	    else{
	      $this->session->set_flashdata('l_err', 'Could not archive opportunity!');
	    }
	    redirect('Leads/opportunity_list');
    }

    
    // To reopen lead
    public function re_lead()
    {
	    $lid = $data['bid']=$_POST['id'];
	    $logid = $_SESSION['admindata']['user_id'];
	    $data['log_user'] = login_user_details($logid);
	    $data['lead_list'] = $this->Lead_model->lead_by_id($lid);

	    $this->load->view('lead/re_lead',$data);
    }

    public function reLead()
    { 
	    $bid=$_POST['field'];
	    $r_on = date('Y-m-d H:i:s');
	    $r_by = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->re_lead($bid,$r_by,$r_on);

	    $log_data['lead_id'] = $bid;
		$log_data['log_type'] = 7;
		$log_data['log_details'] = 'Lead has been Reopened';
		$log_data['created_by'] = $_SESSION['admindata']['user_id'];
		$log_data['created_on'] = date('Y-m-d H:i:s');
		$lead_log_result = $this->Lead_model->lead_log_save($log_data);

	    if ($result) {
	      $this->session->set_flashdata('l_success', 'Lead has been Reopen successfully.');
	    }
	    else{
	      $this->session->set_flashdata('l_err', 'Something went wrong');
	    }
	    redirect('Leads');
    }

  	// To show lead edit
  	public function lead_edit($id)
  	{
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['product_lists'] = $this->Product_model->lead_product_list();
		$data['lead_type_lists'] = $this->Lead_model->lead_type_list();
		$data['lead_source_lists'] = $this->Lead_model->lead_source_list();
		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['sub_lead_sources'] = $this->Lead_model->sub_lead_source_list();

  		$lead_id = $id;
  		$data['lead_edit'] = $this->Lead_model->lead_by_id($lead_id);
  		$data['contact_book_info'] = $this->Lead_model->contact_book_info_by_id($data['lead_edit']->contact_book_id);
  		$data['contact_person_information_by_contact_book_id'] = common_select_values('*','contact_persons','contact_book_id = "'.$data['lead_edit']->contact_book_id.'"','result');
  		$data['billing_addresses'] = common_select_values('*','lead_billing_address','contact_book_id = "'.$data['lead_edit']->contact_book_id.'"','result');
  		$data['shipping_addresses'] = common_select_values('*','lead_shipping_address','contact_book_id = "'.$data['lead_edit']->contact_book_id.'"','result');
  		if($data['lead_edit']->product_id > 0)
  		{
  			$data['product_users'] = $this->Product_model->product_users_by_id($data['lead_edit']->product_id);
  		}else{
  			$data['product_users'] = '';
  		}
  		
		$this->load->view('lead/edit_lead_page', $data);

  	}	

  	// To show lead edit
  	public function opportunity_edit($id)
  	{
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['product_lists'] = $this->Product_model->lead_product_list();
		$data['lead_type_lists'] = $this->Lead_model->lead_type_list();
		$data['lead_source_lists'] = $this->Lead_model->lead_source_list();
		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		$data['sub_lead_sources'] = $this->Lead_model->sub_lead_source_list();
  		$lead_id = $id;
  		$data['lead_edit'] = $this->Lead_model->lead_by_id($lead_id);
  		$data['contact_book_info'] = $this->Lead_model->contact_book_info_by_id($data['lead_edit']->contact_book_id);
  		$data['contact_person_information_by_contact_book_id'] = common_select_values('*','contact_persons','contact_book_id = "'.$data['lead_edit']->contact_book_id.'"','result');

  		$data['billing_addresses'] = common_select_values('*','lead_billing_address','contact_book_id = "'.$data['lead_edit']->contact_book_id.'"','result');
  		$data['shipping_addresses'] = common_select_values('*','lead_shipping_address','contact_book_id = "'.$data['lead_edit']->contact_book_id.'"','result');
  		// print_r($data['billing_addresses']);
  		// print_r($data['shipping_addresses']);

  		if($data['lead_edit']->product_id > 0)
  		{
  			$data['product_users'] = $this->Product_model->product_users_by_id($data['lead_edit']->product_id);
  		}else{
  			$data['product_users'] = '';
  		}
  		
		$this->load->view('lead/oppo_edit_page', $data);
  	}	

  	// To update lead details
  	public function lead_update()
  	{
  		$contact_book_id = $this->input->post('cont_book_id');

  		$data1['lead_name'] = $this->input->post('lead_name');
		$data1['company_name'] = $this->input->post('company_name');
		$data1['country'] = $this->input->post('country');
		$data1['designation'] = $this->input->post('designation');
		$data1['website'] = $this->input->post('website');
		$data1['address'] = $this->input->post('address');
		$data1['email_id'] = $this->input->post('email_id');
		$data1['alternative_email_id'] = $this->input->post('alternative_email_id');
		$data1['skype_id'] = $this->input->post('skype_id');
		$data1['contact_no'] = $this->input->post('contact_no');
		$data1['whatsapp_no'] = $this->input->post('whatsapp_no');
		$data1['office_phone_no'] = $this->input->post('office_phone_no');

		$lead_id = $this->input->post('lead_id');
		$data['product_id'] = $this->input->post('product_id');
		$data['industry_id'] = $this->input->post('industry_id');
		$data['lead_source_id'] = $this->input->post('lead_source');
		$data['lead_type_id'] = $this->input->post('lead_type');
		$data['lead_status_id'] = $this->input->post('lead_status');
		$data['lead_assigned_to'] = $this->input->post('assigned_to');
		$data['message'] = $this->input->post('lead_message');
		$data['modified_by'] = $_SESSION['admindata']['user_id'];
		$data['modified_on'] = date('Y-m-d H:i:s');


		$contact_person_name = $this->input->post('contact_person_name');
		$contact_person_phone = $this->input->post('contact_person_phone');
		$contact_person_email = $this->input->post('contact_person_email');

		$del_contact_person = $this->Lead_model->del_lead_contact_person($contact_book_id);
		if (!empty($contact_person_name)) {
			for ($i=0; $i < count($contact_person_name); $i++) { 
				if ($contact_person_name[$i] != '') {
					$cp_data['contact_book_id'] = $contact_book_id;
					$cp_data['contact_person_name'] = $contact_person_name[$i];
					$cp_data['contact_person_phone'] = $contact_person_phone[$i];
					$cp_data['contact_person_email'] = $contact_person_email[$i];
					$save_contact_person_info = $this->Lead_model->save_contact_person_info($cp_data);
				}
			}
		}


		$billing_address = $this->input->post('billing_address');
		$billing_address_id = $this->input->post('billing_address_id'); 
		$del_address1_ids = $this->input->post('del_address1_ids');

		$shipping_address = $this->input->post('shipping_address');
		$shipping_address_id = $this->input->post('shipping_address_id'); 
		$del_address_ids = $this->input->post('del_address_ids');
		// echo "<pre>";
		// print_r($billing_address);
		// print_r($shipping_address);

		// print_r($billing_address_id);
		// print_r($shipping_address_id);
		// die();
		$rem_first_char = ltrim($del_address_ids,",");
	    $del_id_shipping = explode(',', $rem_first_char);
	    // print_r($del_id_shipping);
	    // die();
	    if($del_address_ids != '')
	    {
	        foreach ($del_id_shipping as $key => $value) {
	        	// echo $value;
	            $del_shipping_removed = $this->Lead_model->remove_shipping_addr_by_id($value);
	        }
	        // die();
	    }

	    $rem_first_char1 = ltrim($del_address1_ids,",");
	    $del_id_billing = explode(',', $rem_first_char1);
	    if($del_address1_ids != '')
	    {
	        foreach ($del_id_billing as $key => $value) {
	            $del_billing_removed = $this->Lead_model->remove_billing_addr_by_id($value);
	        }
	    }

		if (!empty($billing_address_id)) {
			for ($i=0; $i < count($billing_address_id); $i++) { 
				if($billing_address_id[$i] == '0'){
					$ba_data['contact_book_id'] = $contact_book_id;
					$ba_data['billing_address'] = $billing_address[$i];
					$save_billing_addr_info = $this->Lead_model->save_billing_addr_info($ba_data);
				}
				else {
					$lead_billing_address_id = $billing_address_id[$i];
					$ba_data['contact_book_id'] = $contact_book_id;
					$ba_data['billing_address'] = $billing_address[$i];
					$update_billing_addr_info = $this->Lead_model->update_billing_addr_info($ba_data,$lead_billing_address_id);
				}
			}
		}

		if (!empty($shipping_address_id)) {
			for ($j=0; $j < count($shipping_address_id); $j++) { 
				if($shipping_address_id[$j] == '0'){

					$sa_data['contact_book_id'] = $contact_book_id;
					$sa_data['shipping_address'] = $shipping_address[$j];
					$save_shipping_addr_info = $this->Lead_model->save_shipping_addr_info($sa_data);
				}
				else {
					$lead_shipping_address_id = $shipping_address_id[$j];
					$sa_data['contact_book_id'] = $contact_book_id;
					$sa_data['shipping_address'] = $shipping_address[$j];
					$update_billing_addr_info = $this->Lead_model->update_shipping_addr_info($sa_data,$lead_shipping_address_id);
				}
			}
		}

		$log_details = '';
		$lead_details = $this->Lead_model->lead_by_id($lead_id);
		if($data1['lead_name'] != $lead_details->lead_name)
		{
			$log_details .= '<strong>Lead Name : </strong>'. $lead_details->lead_name.' To ' . $data1['lead_name'].'<br>';
		}
		if($data1['company_name'] != $lead_details->company_name)
		{
			$log_details .= '<strong>Company Name : </strong>'. $lead_details->company_name.' To ' . $data1['company_name'].'<br>';;
		}
		if($data1['country'] != $lead_details->country)
		{
			$country_details = $this->Lead_model->country_name($data1['country']);
			$log_details .= '<strong>Country Name : </strong>'. $lead_details->country_name.' To ' . $country_details->name.'<br>';;
		}

		if($data1['designation'] != $lead_details->designation)
		{
			$log_details .= '<strong>Designation Name : </strong>'. $lead_details->designation.' To ' . $data1['designation'].'<br>';;
		}
		if($data1['website'] != $lead_details->website)
		{
			$log_details .= '<strong>Website : </strong>'. $lead_details->website.' To ' . $data1['website'].'<br>';;
		}
		if (trim($data1['address']) != '' && trim($lead_details->address) != '') {
			if(trim($data1['address']) != $lead_details->address)
			{
				$log_details .= '<strong>Address : </strong>'. $lead_details->address.' To ' . $data1['address'].'<br>';;
			}
		}
		if($data1['email_id'] != $lead_details->email_id)
		{
			$log_details .= '<strong>Email ID : </strong>'. $lead_details->email_id.' To ' . $data1['email_id'].'<br>';;
		}	
		if($data1['alternative_email_id'] != $lead_details->alternative_email_id)
		{
			$log_details .= '<strong>Alternate Email ID : </strong>'. $lead_details->alternative_email_id.' To ' . $data1['alternative_email_id'].'<br>';;
		}
		if($data1['skype_id'] != $lead_details->skype_id)
		{
			$log_details .= '<strong>Skype ID : </strong>'. $lead_details->skype_id.' To ' . $data1['skype_id'].'<br>';;
		}
		if($data1['contact_no'] != $lead_details->contact_no)
		{
			$log_details .= '<strong>Contact No : </strong>'. $lead_details->contact_no.' To ' . $data1['contact_no'].'<br>';;
		}
		if($data1['whatsapp_no'] != $lead_details->whatsapp_no)
		{
			$log_details .= '<strong>Whatsapp No : </strong>'. $lead_details->whatsapp_no.' To ' . $data1['whatsapp_no'].'<br>';;
		}	
		if($data1['office_phone_no'] != $lead_details->office_phone_no)
		{
			$log_details .= '<strong>Office Contact No : </strong>'. $lead_details->office_phone_no.' To ' . $data1['office_phone_no'].'<br>';;
		}
		if($data['product_id'] != $lead_details->product_id)
		{
			$product_details = $this->Product_model->product_by_id($data['product_id']);
			$log_details .= '<strong>Product Name : </strong>'. $lead_details->product_name.' To ' . $product_details->product_name.'<br>';;
		}
		if($data['lead_source_id'] != $lead_details->lead_source_id)
		{
			$lead_source_details = $this->Lead_model->lead_source_by_id($data['lead_source_id']);
			$log_details .= '<strong>Lead Source Name : </strong>'. $lead_details->lead_source_name.' To ' . $lead_source_details->lead_source.'<br>';;
		}

		if($data['lead_type_id'] != $lead_details->lead_type_id)
		{
			$lead_type_details = $this->Lead_model->lead_type_by_id($data['lead_type_id']);
			$log_details .= '<strong>Priority : </strong>'. $lead_details->l_type.' To ' . $lead_type_details->lead_type.'<br>';;
		}
		if($data['lead_status_id'] != $lead_details->lead_status_id)
		{
			$lead_status_details = $this->Lead_model->lead_status_by_id($data['lead_status_id']);
			$log_details .= '<strong>Lead Status : </strong>'. $lead_details->lead_status_name.' To ' . $lead_status_details->lead_status.'<br>';;
		}
		if($data['lead_assigned_to'] != $lead_details->lead_assigned_to)
		{
			$user_details = $this->User_model->user_by_id($data['lead_assigned_to']);
			$log_details .= '<strong>Lead assigned To : </strong>'. $lead_details->lead_assigned_name.' To ' . $user_details->name.'<br>';;
		}
		if($data['message'] != $lead_details->message)
		{
			$log_details .= '<strong>Message : </strong>'. $lead_details->message.' To ' . $data['message'].'<br>';;
		}

		$log_data['lead_id'] = $lead_id;
		$log_data['log_type'] = 2;
		$log_data['log_details'] = $log_details;
		$log_data['created_by'] = $_SESSION['admindata']['user_id'];
		$log_data['created_on'] = date('Y-m-d H:i:s');
		$lead_log_result = $this->Lead_model->lead_log_save($log_data);
		$lead_result = $this->Lead_model->lead_update($data, $lead_id);
		$contact_info_update = $this->Lead_model->contact_info_update($data1,$contact_book_id);
		$this->session->set_flashdata('l_success', $this->input->post('lead_name').' details has been updated successfully...');
		redirect('Leads');
  	}

  	// To update lead details
  	public function opportunity_update()
  	{
  		
  		$contact_book_id = $this->input->post('cont_book_id');
  		$data1['lead_name'] = $this->input->post('lead_name');
		$data1['company_name'] = $this->input->post('company_name');
		$data1['country'] = $this->input->post('country');
		$data1['designation'] = $this->input->post('designation');
		$data1['website'] = $this->input->post('website');
		$data1['address'] = $this->input->post('address');
		$data1['email_id'] = $this->input->post('email_id');
		$data1['alternative_email_id'] = $this->input->post('alternative_email_id');
		$data1['skype_id'] = $this->input->post('skype_id');
		$data1['contact_no'] = $this->input->post('contact_no');
		$data1['whatsapp_no'] = $this->input->post('whatsapp_no');
		$data1['office_phone_no'] = $this->input->post('office_phone_no');

		$lead_id = $this->input->post('lead_id');

		$contact_person_name = $this->input->post('contact_person_name');
		$contact_person_phone = $this->input->post('contact_person_phone');
		$contact_person_email = $this->input->post('contact_person_email');

		$del_contact_person = $this->Lead_model->del_lead_contact_person($contact_book_id);
		if (!empty($contact_person_name)) {
			for ($i=0; $i < count($contact_person_name); $i++) { 
				if ($contact_person_name[$i] != '') {
					$cp_data['contact_book_id'] = $contact_book_id;
					$cp_data['contact_person_name'] = $contact_person_name[$i];
					$cp_data['contact_person_phone'] = $contact_person_phone[$i];
					$cp_data['contact_person_email'] = $contact_person_email[$i];
					$save_contact_person_info = $this->Lead_model->save_contact_person_info($cp_data);
				}
			}
		}

		$billing_address = $this->input->post('billing_address');
		$billing_address_id = $this->input->post('billing_address_id'); 
		$del_address1_ids = $this->input->post('del_address1_ids');

		$shipping_address = $this->input->post('shipping_address');
		$shipping_address_id = $this->input->post('shipping_address_id'); 
		$del_address_ids = $this->input->post('del_address_ids');
		// echo "<pre>";
		// print_r($billing_address);
		// print_r($shipping_address);

		// print_r($billing_address_id);
		// print_r($shipping_address_id);
		// die();
		$rem_first_char = ltrim($del_address_ids,",");
	    $del_id_shipping = explode(',', $rem_first_char);
	    // print_r($del_id_shipping);
	    // die();
	    if($del_address_ids != '')
	    {
	        foreach ($del_id_shipping as $key => $value) {
	        	// echo $value;
	            $del_shipping_removed = $this->Lead_model->remove_shipping_addr_by_id($value);
	        }
	        // die();
	    }

	    $rem_first_char1 = ltrim($del_address1_ids,",");
	    $del_id_billing = explode(',', $rem_first_char1);
	    if($del_address1_ids != '')
	    {
	        foreach ($del_id_billing as $key => $value) {
	            $del_billing_removed = $this->Lead_model->remove_billing_addr_by_id($value);
	        }
	    }

		if (!empty($billing_address_id)) {
			for ($i=0; $i < count($billing_address_id); $i++) { 
				if($billing_address_id[$i] == '0'){
					$ba_data['contact_book_id'] = $contact_book_id;
					$ba_data['billing_address'] = $billing_address[$i];
					$save_billing_addr_info = $this->Lead_model->save_billing_addr_info($ba_data);
				}
				else {
					$lead_billing_address_id = $billing_address_id[$i];
					$ba_data['contact_book_id'] = $contact_book_id;
					$ba_data['billing_address'] = $billing_address[$i];
					$update_billing_addr_info = $this->Lead_model->update_billing_addr_info($ba_data,$lead_billing_address_id);
				}
			}
		}

		if (!empty($shipping_address_id)) {
			for ($j=0; $j < count($shipping_address_id); $j++) { 
				if($shipping_address_id[$j] == '0'){

					$sa_data['contact_book_id'] = $contact_book_id;
					$sa_data['shipping_address'] = $shipping_address[$j];
					$save_shipping_addr_info = $this->Lead_model->save_shipping_addr_info($sa_data);
				}
				else {
					$lead_shipping_address_id = $shipping_address_id[$j];
					$sa_data['contact_book_id'] = $contact_book_id;
					$sa_data['shipping_address'] = $shipping_address[$j];
					$update_billing_addr_info = $this->Lead_model->update_shipping_addr_info($sa_data,$lead_shipping_address_id);
				}
			}
		}

		$data['product_id'] = $this->input->post('product_id');
		$data['industry_id'] = $this->input->post('industry_id');
		$data['lead_source_id'] = $this->input->post('lead_source');
		$data['lead_type_id'] = $this->input->post('lead_type');
		$data['lead_status_id'] = $this->input->post('lead_status');
		$data['lead_assigned_to'] = $this->input->post('assigned_to');
		$data['message'] = $this->input->post('lead_message');
		$data['modified_by'] = $_SESSION['admindata']['user_id'];
		$data['modified_on'] = date('Y-m-d H:i:s');
		$log_details = '';
		$lead_details = $this->Lead_model->lead_by_id($lead_id);
		if($data1['lead_name'] != $lead_details->lead_name)
		{
			$log_details .= '<strong>Lead Name : </strong>'. $lead_details->lead_name.' To ' . $data1['lead_name'].'<br>';
		}
		if($data1['company_name'] != $lead_details->company_name)
		{
			$log_details .= '<strong>Company Name : </strong>'. $lead_details->company_name.' To ' . $data1['company_name'].'<br>';;
		}
		if($data1['country'] != $lead_details->country)
		{
			$country_details = $this->Lead_model->country_name($data1['country']);
			$log_details .= '<strong>Country Name : </strong>'. $lead_details->country_name.' To ' . $country_details->name.'<br>';;
		}

		if($data1['designation'] != $lead_details->designation)
		{
			$log_details .= '<strong>Designation Name : </strong>'. $lead_details->designation.' To ' . $data1['designation'].'<br>';;
		}
		if($data1['website'] != $lead_details->website)
		{
			$log_details .= '<strong>Website : </strong>'. $lead_details->website.' To ' . $data1['website'].'<br>';;
		}
		if (trim($data1['address']) != '' && trim($lead_details->address) != '') {
			if(trim($data1['address']) != $lead_details->address)
			{
				$log_details .= '<strong>Address : </strong>'. $lead_details->address.' To ' . $data1['address'].'<br>';;
			}
		}
		if($data1['email_id'] != $lead_details->email_id)
		{
			$log_details .= '<strong>Email ID : </strong>'. $lead_details->email_id.' To ' . $data1['email_id'].'<br>';;
		}	
		if($data1['alternative_email_id'] != $lead_details->alternative_email_id)
		{
			$log_details .= '<strong>Alternate Email ID : </strong>'. $lead_details->alternative_email_id.' To ' . $data1['alternative_email_id'].'<br>';;
		}
		if($data1['skype_id'] != $lead_details->skype_id)
		{
			$log_details .= '<strong>Skype ID : </strong>'. $lead_details->skype_id.' To ' . $data1['skype_id'].'<br>';;
		}
		if($data1['contact_no'] != $lead_details->contact_no)
		{
			$log_details .= '<strong>Contact No : </strong>'. $lead_details->contact_no.' To ' . $data1['contact_no'].'<br>';;
		}
		if($data1['whatsapp_no'] != $lead_details->whatsapp_no)
		{
			$log_details .= '<strong>Whatsapp No : </strong>'. $lead_details->whatsapp_no.' To ' . $data1['whatsapp_no'].'<br>';;
		}	
		if($data1['office_phone_no'] != $lead_details->office_phone_no)
		{
			$log_details .= '<strong>Office Contact No : </strong>'. $lead_details->office_phone_no.' To ' . $data1['office_phone_no'].'<br>';;
		}
		if($data['product_id'] != $lead_details->product_id)
		{
			$product_details = $this->Product_model->product_by_id($data['product_id']);
			$log_details .= '<strong>Product Name : </strong>'. $lead_details->product_name.' To ' . $product_details->product_name.'<br>';;
		}
		if($data['lead_source_id'] != $lead_details->lead_source_id)
		{
			$lead_source_details = $this->Lead_model->lead_source_by_id($data['lead_source_id']);
			$log_details .= '<strong>Lead Source Name : </strong>'. $lead_details->lead_source_name.' To ' . $lead_source_details->lead_source.'<br>';;
		}

		if($data['lead_type_id'] != $lead_details->lead_type_id)
		{
			$lead_type_details = $this->Lead_model->lead_type_by_id($data['lead_type_id']);
			$log_details .= '<strong>Priority : </strong>'. $lead_details->l_type.' To ' . $lead_type_details->lead_type.'<br>';;
		}
		if($data['lead_status_id'] != $lead_details->lead_status_id)
		{
			$lead_status_details = $this->Lead_model->lead_status_by_id($data['lead_status_id']);
			$log_details .= '<strong>Lead Status : </strong>'. $lead_details->lead_status_name.' To ' . $lead_status_details->lead_status.'<br>';;
		}
		if($data['lead_assigned_to'] != $lead_details->lead_assigned_to)
		{
			$user_details = $this->User_model->user_by_id($data['lead_assigned_to']);
			$log_details .= '<strong>Lead assigned To : </strong>'. $lead_details->lead_assigned_name.' To ' . $user_details->name.'<br>';;
		}
		if($data['message'] != $lead_details->message)
		{
			$log_details .= '<strong>Message : </strong>'. $lead_details->message.' To ' . $data['message'].'<br>';;
		}

		$log_data['lead_id'] = $lead_id;
		$log_data['log_type'] = 2;
		$log_data['log_details'] = $log_details;
		$log_data['created_by'] = $_SESSION['admindata']['user_id'];
		$log_data['created_on'] = date('Y-m-d H:i:s');
		$lead_log_result = $this->Lead_model->lead_log_save($log_data);
		$lead_result = $this->Lead_model->lead_update($data, $lead_id);
		$contact_info_update = $this->Lead_model->contact_info_update($data1,$contact_book_id);
		$this->session->set_flashdata('l_success', $this->input->post('lead_name').' details has been updated successfully...');
		redirect('Leads/opportunity_list?active_tab=1');
  	}


  	// To check lead name unique by edit form
	public function lead_name_unique_edit()
  	{
	    $lead_name = $this->input->post('lead_name');
	    $l_id = $this->input->post('l_id');
	    $result = $this->Lead_model->lead_name_unique_edit($lead_name, $l_id);
	   if($result){ echo 1; }else{ echo 0; }
  	}
  		// To convert lead to customer in db
  	public function lead_convert_customer_add()
  	{
  	
  		$lead_id  = $this->input->post('convert_lead_id');

		// To get lead details
		$lead = $this->Lead_model->lead_by_id($lead_id);
		
		$refer_customer = ($lead->lead_source_person > 0 ) ? $lead->lead_source_person : 0;
		$customer['industry_id'] = $lead->lead_type;
		$customer['customer_type_name'] = $lead->lead_type_name;
		$customer['desgination'] = '';
		$customer['contact_person'] = $lead->lead_name;
		$customer['contact_number'] = $lead->contact_no;
		$customer['alternative_contact_number'] = $lead->alternative_contact_no;
		$customer['email_id'] = $lead->email_id;
		$customer['alternative_email_id'] = $lead->alternative_email_id;
		$customer['gender'] = '';
		$customer['address1'] = $lead->address1;
		$customer['address2'] = $lead->address2;
		$customer['pincode'] = '';
		$customer['marital_status'] = '';
		$customer['dob'] = '';
		$customer['anniversary'] = '';
		$customer['referrence'] = $lead->lead_source;
		$customer['referrence_person'] = '';
		$customer['alergic_foods'] = '';
		$customer['not_preferred_foods'] = '';
	    $customer['latitude'] = '9.920492068161163';
	    $customer['longtitude'] = '78.14806405884724';
  		$customer['area'] = $lead->area;
		$customer['created_by'] = $_SESSION['admindata']['user_id'];
		$customer['created_on'] = date('Y-m-d H:i:s');
		$customer['profile_image'] = '';
		$customer['pincode'] = $lead->pincode;

		$customer['username'] = 'apfuser';
		$password = aes128Encrypt('atchayapathra','welcome');
		$customer['password'] = $password;

		$cus_result = $this->Customer_model->customer_add($customer);
		
		// To update lead status
		$status = 1;
		$lead_status_res = $this->Lead_model->lead_convert_status($lead_id, $status);

		// To add reward points to customer for lead convert
		if($refer_customer > 0)
		{
			$reward['customer_id'] = $refer_customer;
			$reward['history_date'] = date('Y-m-d');
			$reward['reward_points'] = 1;
			$reward['reason'] = 'Lead Converted to customer';
			$reward['created_on'] = date('Y-m-d H:i:s');
			$add_reword_points = $this->Lead_model->lead_customer_reward_add($reward);
		}

		// To get general setting
		$gen_settings = general_setting_details();
		$logo = $gen_settings->product_logo;
		$leadname = $lead->lead_name;
		$email = $lead->email_id;
		$contact_no = $lead->contact_no;

		// To send email and sms notification
		$lead_email_notify_status = email_sms_notification('Lead Convert');
		if($lead_email_notify_status->email == 1 && $email != '')
		{
			// To get email template
			$email_temp = email_template_by_id(2);
			$subject = ($email_temp->email_subject) ? $email_temp->email_subject : '';
			$content = ($email_temp->email_content) ? $email_temp->email_content : '';

			$content = str_replace('#logo#', $logo, $content);
            $content = str_replace('#displayName#', $leadname, $content);
            $content = str_replace('#year#', date('Y'), $content);
            $content = str_replace('#baseurl#', base_url(), $content);
            $content = str_replace('#username#', 'apfuser', $content);
            $content = str_replace('#password#', 'welcome', $content);

            $this->to_send_email($subject, $content, $email);
		}

		if($lead_email_notify_status->sms == 1 && $contact_no != '')
		{
			$sms_temp = sms_template_by_id(2);
			$sms_content = ($sms_temp->sms_content) ? $sms_temp->sms_content : '';
			$sms_content = str_replace('#displayName#', $leadname, $sms_content);
			$sms_content = str_replace('#username#', 'apfuser', $sms_content);
            $sms_content = str_replace('#password#', 'welcome', $sms_content);
			sendsms($contact_no, $sms_content, $gen_settings->sms_auth_key,$gen_settings->sms_sender_id);
		}

  		$this->session->set_flashdata('l_a_success', 'You have added new customer to our business...');
		redirect('Leads');
  		
  	}

    // TO check lead contact no exist
    public function lead_contact_no_exits()
    {
    	$val = $this->input->post('value');
    	// echo $val;
    	// die();

    	// To check this contact no in lead
    	// $check_c_no = table_column_unique('contact_book', 'contact_number', $val);
    	$check_c_no =  common_select_values('*', 'contact_book', ' contact_no= "'.$val.'" AND status != 2', 'row');

    	if(!empty($check_c_no))
    	{
    		echo $check_c_no->contact_book_id;
    	}else if($val == ''){
    		echo 1;	
    	}else{
    		echo 0;
    	}

    }
    // TO check lead email ID exist
    public function lead_email_id_exits()
    {
    	$val = $this->input->post('value');
    	$check_c_no = common_select_values('*', 'contact_book', ' email_id= "'.$val.'" AND status != 2', 'row');

    	if($check_c_no)
    	{
    		echo $check_c_no->contact_book_id;
    		// echo 1;	
    	}else{
    		echo 0;
    	}

    }
    public function lead_pro_and_email_email_id_exits()
    {
    	$contact_book_id = $this->input->post('contact_book_id');
    	$product_id = $this->input->post('product_id');

    	$chk_the_lead_has_same_product = $this->Lead_model->chk_the_lead_has_same_product($contact_book_id,$product_id);
    	if(count($chk_the_lead_has_same_product) > 0)
    	{
    		echo "1";
    		// echo 1;	
    	}else{
    		echo "0";
    	}
    }
    // TO check lead contact no exist
    public function lead_contact_no_exits_edit()
    {
    	$val = $this->input->post('value');
    	$lead_id = $this->input->post('lead_id');
    	// To check this contact no in lead
    	$check_c_no = $this->Lead_model->lead_contact_no_exits_edit($val, $lead_id);
    	if($check_c_no)
    	{
    		echo 1;	
    	}else{
    		echo 0;
    	}

    }
	// To send email
	public function to_send_email($sub, $message, $tomail)
	{
	  // To get gensettings
	  $gen_settings = general_setting_details();

	  // Email settings
	  $hostname = $gen_settings->smtp_host_name;
	  $username = $gen_settings->smtp_user_name;
	  $smtpcode = aes128Decrypt('atchayapathra',$gen_settings->smtp_password);
	  $from_mail = $gen_settings->from_mail;
	  $config = Array( 
	          'protocol' => 'smtp',
	          'smtp_host' => $hostname,
	          'smtp_user' => $username, 
	          'smtp_pass' => $smtpcode, 
	          'smtp_port' => 25,
	          'mailtype'  => 'html', 
	          'charset'   => 'utf-8',
	          'newline'  => "\r\n",
	          'wordwrap' => TRUE,
	        );
	  $this->load->library('email',$config);
	  $this->email->from($from_mail); 
	  $this->email->to($tomail);
	  $this->email->subject($sub);
	  $this->email->message($message);
	  $this->email->set_mailtype('html');           
	  if($this->email->send())
	  {
	    //echo 1;
	  }
	  else
	  {
	    //echo $this->email->print_debugger();
	    //echo 0;
	  }  
	}
  public function view_email()
  {
  	$data['msgno'] = $this->input->post('msg_no');
  	$data['label'] = $this->input->post('label');
  	$data['lead_email'] = $this->input->post('lead_email');
  	$data['lead_id'] = $this->input->post('lead_id');
  	$exp_lead_email = explode('@', $data['lead_email']);
  	$mail_user_name = $exp_lead_email[0];
  	$data['company_email'] = $this->input->post('company_email');
  	$data['get_email_content'] = $this->Lead_model->get_email_content($mail_user_name,$data['company_email'],$data['msgno'], $data['label']);
    // $email_details = $this->Lead_model->email_by_name($data['emailid']);
    // $data['imap_email_lists'] = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msgno'], $data['label']);
  	$this->load->view('inbox/lead_email_view', $data);
  }
	// To get info email list
  public function lead_email_list()
  {
    $data['per_page'] = 20;
    $company_email = $this->input->post('e_id');
    $lead_email = $this->input->post('s_e_id');
    $data['email_type'] = $this->input->post('email_type');
    $data['company_email'] = $company_email;
    $data['lead_email'] = $lead_email;
    $data['start'] = 1;
    
    $get_lead_conversation_inbox = $this->Lead_model->get_all_leads_mails($company_email,$lead_email,$data['email_type']);

    if (count($get_lead_conversation_inbox) < $data['per_page']) {
    	$data['end'] = count($get_lead_conversation_inbox);
    }
    else {
    	$data['end'] = $data['per_page'];
    }
  
    $data['whole_array_results'] =$get_lead_conversation_inbox;
   //  echo "<pre>";

   // print_r($data['whole_array_results']);
   // die();
    $data['results'] = array_slice($get_lead_conversation_inbox,($data['start'] - 1),$data['end']);
    $data['lead_id'] = $this->input->post('lead_id');
    $data['email_list_from_db_or_imap'] = '1';
    $this->load->view('inbox/email_list', $data);
  }
  public function lead_email_list_from_imap()
  {

    $data['per_page'] = 20;
    $company_email = $this->input->post('e_id');
    $lead_email = $this->input->post('lead_email_id');
    $data['email_type'] = $this->input->post('email_type');
    $data['company_email'] = $company_email;
    $data['lead_email'] = $lead_email;
    $data['start'] = 1;
    $email_detail = $this->Lead_model->email_by_name($company_email);
    $data['comp_email_id'] = $email_detail->email_detail_id;
    $imap_host  = $email_detail->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_detail->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_detail->password, 'Rajexim2020'); // IMAP password
    if ($data['email_type'] == '1') {
    	$inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX", $imap_user, $imap_pass)or die('Cannot connect to Gmail: ' . imap_last_error());
    	$get_lead_conversation_inbox = imap_email_list_by_lead_email_id($inbox,$lead_email,$company_email);
    }
    else {
    	$inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Sent Mail", $imap_user, $imap_pass)or die('Cannot connect to Gmail: ' . imap_last_error());
    	$get_lead_conversation_inbox = imap_email_sendbox_list_by_lead_email_id($inbox,$lead_email,$company_email);
    }
    
    // print_r($get_lead_conversation_inbox);
    // die();
    imap_close($inbox);

    if (count($get_lead_conversation_inbox) < $data['per_page']) {
    	$data['end'] = count($get_lead_conversation_inbox);
    }
    else {
    	$data['end'] = $data['per_page'];
    }
  
    $data['whole_array_results'] =$get_lead_conversation_inbox;
   //  echo "<pre>";

   // print_r($data['whole_array_results']);
   // die();
    $data['email_list_from_db_or_imap'] = '0';
    $data['results'] = array_slice($get_lead_conversation_inbox,($data['start'] - 1),$data['end']);
    $data['lead_id'] = $this->input->post('lead_id');
    $this->load->view('inbox/email_list', $data);
  }
  public function lead_list_email_pagination()
  {

  	$json_decoded_array = $this->input->post('whole_array_results');
  	// die();
  	// $data['whole_array_results'] = json_decode($json_decoded_array,true);

    $data['end'] = $this->input->post('end');
    $data['company_email'] = $this->input->post('company_email');
    $data['lead_email'] = $this->input->post('lead_email');
    $data['email_type'] = $this->input->post('email_type');
    $get_lead_conversation_inbox = $this->Lead_model->get_all_leads_mails($data['company_email'],$data['lead_email'],$data['email_type']);
    $data['whole_array_results'] = $get_lead_conversation_inbox;

    // if (count($data['whole_array_results']) < $data['end']) {
    // 	$data['end'] = count($data['whole_array_results']);
    // }
    // else {
    // 	$data['end'] = $this->input->post('end');
    // }
    $data['start'] = $this->input->post('start');
    $data['per_page'] = $this->input->post('per_page');
    $data['results'] = array_slice($data['whole_array_results'],($data['start'] - 1),$data['per_page']);
    $data['lead_id'] = $this->input->post('lead_id');

    
    $data['email_list_from_db_or_imap'] = '1';
    $this->load->view('inbox/email_list', $data);
  }
   public function inbox_email_list()
  {
    $data['per_page'] = 50;
    $data['start'] = ($this->input->post('start')) ?  $this->input->post('start') : '';
    $data['e_id'] = $this->input->post('e_id');
    $data['search_email_id'] = $this->input->post('s_e_id');
    $data['email_details'] = $this->Lead_model->email_by_id($data['e_id']);



    $data['email_name'] = $data['email_details']->email_ID;
    $this->load->view('inbox/inbox_email_list', $data);
  }
  // To view email view
  public function email_message_view($lead_id, $msgno, $e_id, $email_label, $search_id)
  {
     if($email_label == 'Inbox' || $email_label == 'INBOX')
     {
        $data['email_label'] = $email_label;
     }else{
         $data['email_label'] = '[Gmail]/'.$email_label;
     }
    
    $e_id = str_replace('_', '@', $e_id);
    $data['search_email_id'] = str_replace('_', '@', $search_id);
    $data['from_name'] = '';
    $data['e_id'] = $e_id;
    $data['msgno'] = $msgno;
    $data['lead_id'] = $lead_id;
    $data['email_details'] = $this->Lead_model->email_by_name($e_id);
    $this->load->view('inbox/email_message_view', $data);
  }
  // To compose email
  public function forward_mail()
  {

    $reply_mail = $this->input->post('e_id');
    $data['e_id'] = $reply_mail;
    $data['message_details'] = $this->Lead_model->email_details_by_id($msg_no);

    if($data['message_details']->company_email == $reply_mail)
    {
    	$data['reply_mail'] = $data['message_details']->lead_email;
    }
    else{
    	$data['reply_mail'] = $data['message_details']->company_email;
    } 
    $data['lead_id'] = $this->input->post('lead_id');
    $this->load->view('inbox/forward_email', $data);  

  }
  // To compose email
  public function send_forward_mail()
  {
      $data = $_POST;
      $data['attachs'] = $_FILES;
      $email_details = $this->Lead_model->email_by_name($data['e_id']);
      // To get info email details
      $email_id = $email_details->email_ID; 
      $password =  decryptthis($email_details->password, 'Rajexim2020');
      $smtp_name = $email_details->smtp_host;
      
        
        $attach_file = '';
        if(!empty($_FILES['attach_email']['name']))
      	{
      		if (!is_dir('assets/attachment_files/')) 
      		{
    		    mkdir('./assets/attachment_files/', 0777, TRUE);
    		}
    		
    		for($i=0; $i<=count($_FILES['attach_email']['name']); $i++)
    		{
    		    
    		    $_FILES['file']['name'] = $_FILES['attach_email']['name'][$i];
                $_FILES['file']['type'] = $_FILES['attach_email']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['attach_email']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['attach_email']['error'][$i];
                $_FILES['file']['size'] = $_FILES['attach_email']['size'][$i];
          
		    	$ext = pathinfo($_FILES['attach_email']['name'][$i], PATHINFO_EXTENSION);
        		$config['upload_path'] = 'assets/attachment_files/';
        		$config['allowed_types'] = 'jpg|jpeg|png|doc|pdf|xlsx|docx';
        		$config['file_name'] = $_FILES['attach_email']['name'][$i];
        		$this->load->library('upload',$config);
        		$this->upload->initialize($config);
        		
          		if($this->upload->do_upload('file'))
          		{
          			$uploadData = $this->upload->data();
          		    $filename = $uploadData['file_name'];
                    $data['totalFiles'][] = $filename;
          		}
    		    
    		}
      	}	

      		// To get smtp details
      	    $smtp_detaiils = smtp_details();
      		//$mcRes = $this->Offermail_model->get_general_settings_details();
            $smtp_pwd = decryptthis($smtp_detaiils->smtp_password, 'Rajexim2020');   
            $config = Array( 
            'protocol' => 'smtp',
            'smtp_host' => $smtp_detaiils->smtp_host_name,
            'smtp_user' => $smtp_detaiils->smtp_user_name, 
            'smtp_pass' => $smtp_pwd,
            'smtp_port' => 465,
            'mailtype'  => 'html', 
            'charset'   => 'utf-8',
            'newline'  => "\r\n",
            'wordwrap' => TRUE,
            );
            
            $this->load->library('email',$config);
            $this->email->from($data['from_email']);    
            $this->email->to($data['to_email']);
            $this->email->subject($data['sub_email']);
            $this->email->message(strip_tags($data['content_email']));
            $this->email->set_mailtype('html');

                if(!empty($data['totalFiles'])){
                    foreach ($data['totalFiles'] as $k => $v) {
                        $attach_file = 'assets/attachment_files/'.$v;
                        $this->email->attach($attach_file);
                    }
                } 
              if($this->email->send())
              {
                  
                 //unlink file
                 if(!empty($data['totalFiles'])){
                  foreach ($data['totalFiles'] as $k => $v) {
                        $attach_file = 'assets/attachment_files/'.$v;
                        unlink($attach_file);
                    }       
                 }
                  $this->session->set_flashdata('mail_success', 'Email Sent Successfully...');
                  
                $result =1;
                
              }else{
                  $this->session->set_flashdata('mail_err', 'Could not send email!');
              }
    
              redirect('Leads/lead_view/'.$data['lead_id']);

  }
  // To compose mail
  public function compose_mail()
  {
    $data['e_id'] = $this->input->post('e_id');
    $data['mail_compose_from'] = '1';
    $data['search_email_id'] = ($this->input->post('e_id')) ? $this->input->post('e_id') : '';
    $data['lead_id'] = ($this->input->post('lead_id')) ? $this->input->post('lead_id') : '';
    $data['email_details'] = $this->Lead_model->email_by_name($data['e_id']);
    $this->load->view('inbox/compose_email', $data);   
  }
   // To compose email
  public function send_compose_mail()
  {
    $data = $_POST;
    $data['attachs'] = $_FILES;
    $email_details = $this->Lead_model->email_by_name($data['from_email']);

    $raw_removed_files_name = $data['removed_attachment_name'];

      if ($raw_removed_files_name != '') {
        $removed_files_name = explode(',', $raw_removed_files_name);
      }
      else {
        $removed_files_name = array(); 
      }

    $_SESSION['active_panel'] = "email";
    // To get info email details
    $email_id = $email_details->email_ID; 
    $password =  decryptthis($email_details->password, 'Rajexim2020');
    $cc_mail_ids = $email_details->cc;
    $bcc_mail_ids = $email_details->bcc;
    $get_cc_email_name = $this->Setting_model->get_email_names_by_findinset($cc_mail_ids);
    $get_bcc_email_name = $this->Setting_model->get_email_names_by_findinset($bcc_mail_ids);
      $email_id_name = $email_details->from_name;
      $attach_file = '';
      $attachment_files_path = array();

      $abspath = getcwd();
      $filePondArray = $_POST['attach_email'];
      $numFilePondObjects = sizeof($filePondArray);
      if($numFilePondObjects > 0)
    {
      if (!is_dir('assets/attachment_files/')) 
        {
          mkdir('./assets/attachment_files/', 0777, TRUE);
        }
      $user_temp_folder = $_SESSION['admindata']['user_id'].date('m').date('d').date('H').date('i').date('s');
            mkdir('./assets/attachment_files/'.$user_temp_folder, 0777, TRUE);
            $baseFileLocation = './assets/attachment_files/'.$user_temp_folder.'/';
      for ($xx=0; $xx<$numFilePondObjects; $xx++)
      {
        $thisFilePondJSON_object = $filePondArray[$xx];
        $thisFilePondArray = json_decode($thisFilePondJSON_object, true);
        $thisFilePondArray_picData = $thisFilePondArray['data'];
        $thisFilePondArray_numPics = sizeof($thisFilePondArray_picData);
        
        $thisPic_name_temp = $thisFilePondArray['name'];
        $thisPic_encodedData = $thisFilePondArray_picData;
        $thisPic_decodedData = base64_decode($thisPic_encodedData);
        $thisPic_fullPathAndName = $baseFileLocation . $thisPic_name_temp; 
        file_put_contents($abspath.$thisPic_fullPathAndName, $thisPic_decodedData);
        $attachment_files_path[] = "assets/attachment_files/".$user_temp_folder.'/'.$thisFilePondArray['name'];
      }
    }
      if ($cc_mail_ids != '') {
      $ccemail = $data['cc_email'].','.$get_cc_email_name->mail_name; 
    } 
    else{
      $ccemail = $data['cc_email'];
    }
    if (trim($ccemail) == '') {
        $ccmailarray = array(); 
       }
       else {
        $ccmailarray = explode(',', $ccemail);
       }

    if ($bcc_mail_ids != '') {
      $bccemail = $data['bcc_email'].','.$get_bcc_email_name->mail_name;  
    } 
    else{
      $bccemail = $data['bcc_email'];
    }
    if (trim($bccemail) == '') {
        $bccmailarray = array();  
       }
       else {
        $bccmailarray = explode(',', $bccemail);
       }
      
      $content = $data['content_email'];
        $content .= '<br>';
        $content .= '<br>';
        $content .= $email_details->signature;
        $to_emails = $data['to_email'];
          $tomailarray = explode(',', $to_emails);
        $send_email = send_email_common_method($email_id,$password,$tomailarray,$data['sub_email'],$content,$attachment_files_path,$ccmailarray,$bccmailarray,$email_id_name);
        // echo $send_email;
        // die();
          if($send_email == 1)
          {
            if (!empty($attachment_files_path)) {
              for ($i=0; $i < count($attachment_files_path); $i++) { 
                unlink($attachment_files_path[$i]);  
              }
            }
            rmdir($baseFileLocation);
          $result =1;
	    if($data['mail_compose_from'] == 1)
	    {     
	      $this->session->set_flashdata('mail_success', 'Email Sent Successfully...');
          redirect('Leads/lead_view/'.$data['lead_id']);
        }
        else {
          $this->session->set_flashdata('mail_success', 'Email Sent Successfully...');
          redirect('Mailbox');  
        }
          }
          else{
            if($data['mail_compose_from'] == 1)
          {     
            $this->session->set_flashdata('mail_err', 'Email Fail to Sent');
          redirect('Leads/lead_view/'.$data['lead_id']);
        }
        else {
          $this->session->set_flashdata('mail_err', 'Email Fail to Sent');
          redirect('Mailbox');  
        }
          }
  }
  // To send reply mail
  public function reply_mail()
  {
    $reply_mail = $this->input->post('info_email');

     $data['e_id'] = $reply_mail;
    $msg_no = $this->input->post('msg_no');
    $data['message_details'] = $this->Lead_model->email_details_by_id($msg_no);

    if($data['message_details']->company_email == $reply_mail)
    {
    	$data['reply_mail'] = $data['message_details']->lead_email;
    }
    else{
    	$data['reply_mail'] = $data['message_details']->company_email;
    }
    $data['lead_id'] = $this->input->post('lead_id');
    $this->load->view('inbox/reply_email', $data);   
  }
  // To compose email
  public function send_reply_mail()
  {
  	
  	  $data = $_POST;
      $data['attachs'] = $_FILES;
      $email_details = $this->Lead_model->email_by_name($data['from_email']);
      // To get info email details
      $email_id = $email_details->email_ID; 
      $password =  decryptthis($email_details->password, 'Rajexim2020');
      $email_id_name = $email_details->from_name;
		$cc_mail_ids = $email_details->cc;
		$bcc_mail_ids = $email_details->bcc;
		$get_cc_email_name = $this->Setting_model->get_email_names_by_findinset($cc_mail_ids);
		$get_bcc_email_name = $this->Setting_model->get_email_names_by_findinset($bcc_mail_ids);      
        $attach_file = '';
        $attachment_files_path = array();
        if(!empty($_FILES['attach_email']['name']))
      	{
      		if (!is_dir('assets/attachment_files/')) 
      		{
    		    mkdir('./assets/attachment_files/', 0777, TRUE);
    		  }
    
    		for ($i=0; $i < count($_FILES['attach_email']['name']); $i++) {

	            $_FILES['email_attach']['name'] = $_FILES['attach_email']['name'][$i];
	            $_FILES['email_attach']['type'] = $_FILES['attach_email']['type'][$i];
	            $_FILES['email_attach']['tmp_name'] = $_FILES['attach_email']['tmp_name'][$i];
	            $_FILES['email_attach']['error'] = $_FILES['attach_email']['error'][$i];
	            $_FILES['email_attach']['size'] = $_FILES['attach_email']['size'][$i];

	            $ext = pathinfo($_FILES['email_attach']['name'], PATHINFO_EXTENSION);
	            if (strpos($_FILES['email_attach']['name'], ' ') !== false) {
               
	              $_FILES['email_attach']['name'] =  str_replace(' ', '_', $_FILES['email_attach']['name']);
	            }
	            $config['upload_path'] = 'assets/attachment_files/';
	            // $config['allowed_types'] = 'hqx|cpt|csv|bin|dms|lha|lzh|class|psd|so|sea|dll|oda|ai|eps|ps|smi|smil|mif|xls|ppt|pptx|wbxml|wmlc|dcr|dir|dxr|dvi|gtar|gz|gzip|php|phtml|phps|js|swf|sit|tar|tgz|z|xhtml|xht|zip|rar|bmp|gif|jpe|jp2|jpf|jpg2|jpx|jpm|mj2|mjp2|tiff|tif|css|html|htm|shtml|txt|text|log|rtx|rtf|xml|xsl|dot|word|xl|eml|json|pem|ics|ical|zsh|7z|7zip|cdr|wma|jar|svg|vcf|srt|vtt|ico|odc|otc|odf|otf|odg|otg|odi|oti|oth|jpg|jpeg|png|doc|pdf|xlsx|docx|sql|odp|otp|otp|ods|ots|odt|odm|ott';
	            $config['allowed_types'] = '*';
	            $config['file_name'] = $_FILES['email_attach']['name'];
	            $this->load->library('upload',$config);
	            $this->upload->initialize($config);
	            $attach_file = 'assets/attachment_files/'.$_FILES['email_attach']['name'];

	            if($this->upload->do_upload('email_attach')){
	                chmod("assets/attachment_files/".$_FILES['email_attach']['name'], 0777);
	                $attachment_files_path[] = "assets/attachment_files/".$_FILES['email_attach']['name'];
	                // array_push($attachment_files, "assets/attachment_files/".$_FILES['email_attach']['name']);
	            }
	              // if($this->upload->do_upload('email_attach'))
	              // {
	                
	              //   $uploadData = $this->upload->data();
	              // }
	        }
      	}	
 
				if ($cc_mail_ids != '') {
					$ccemail = $data['cc_email'].','.$get_cc_email_name->mail_name;	
				}	
				else{
					$ccemail = $data['cc_email'];
				}
				$ccmailarray = explode(',', $ccemail);

				if ($bcc_mail_ids != '') {
					$bccemail = $data['bcc_email'].','.$get_bcc_email_name->mail_name;	
				}	
				else{
					$bccemail = $data['bcc_email'];
				}

				$bccmailarray = explode(',', $bccemail);
        //       $ccemail = $data['cc_email'];
		      // $ccmailarray = explode(',', $ccemail);

		      // $bccemail = $data['bcc_email'];
		      // $bccmailarray = explode(',', $bccemail);
				  $content = $data['content_email'];
			      $content .= '<br>';
			      $content .= '<br>';
			      $content .= $email_details->signature;
			      $to_emails = $data['to_email'];
          		  $tomailarray = explode(',', $to_emails);
              $send_email = send_email_common_method($email_id,$password,$tomailarray,$data['sub_email'],$content,$attachment_files_path,$ccmailarray,$bccmailarray,$email_id_name);   
              if($send_email == 1)
              {
	            if (!empty($attachment_files_path)) {
	              for ($i=0; $i < count($attachment_files_path); $i++) { 
	                unlink($attachment_files_path[$i]);  
	              }
	            }
           		$result =1;
               	$this->session->set_flashdata('mail_success', 'Email Sent Successfully...');
              }else{
              	$this->session->set_flashdata('mail_err', 'Could not send email!');
              }
    		if ($data['mail_reply_from'] == 1) {
    			redirect('Leads/lead_view/'.$data['lead_id']);
    		}
    		else{
             	redirect('Mailbox');
    		}
  }
  
	/* ************************************************************************************
						Purpose : To handle Lead Type Setting Functions
	        **********************************************************************/
	
	// To list lead type settings
	public function lead_type_list()
	{
		$data['lead_types'] = $this->Lead_model->lead_type_list();
		$this->load->view('lead/lead_type_list', $data);
	}
	
	// To check lead type is unique
	public function lead_type_unique()
	{
		$l_t_name = $this->input->post('value');
		$result = $this->Lead_model->lead_type_unique($l_t_name);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To check lead type name is unique for edit form
	public function lead_type_unique_edit()
	{
		$l_t_name = $this->input->post('value');
		$l_t_id = $this->input->post('id');
		$result = $this->Lead_model->lead_type_unique_edit($l_t_name, $l_t_id);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To get lead type edit form by id 
    public function lead_type_edit()
    {
		$l_t_id = $this->input->post('value');
		$result = $this->Lead_model->lead_type_by_id($l_t_id);
		if($result){ echo $result->lead_type_id.'|'.$result->lead_type; }else{ echo ''; }
    }

    // To change lead type status
	public function lead_type_change_status()
	{
		$l_t_id = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Lead_model->lead_type_change_status($l_t_id, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To add lead type
	public function lead_type_add()
	{
		$data['lead_type'] = trim($this->input->post('lead_type'), ' ');
	   	$data['c_on'] = date('Y-m-d H:i:s');
	    $data['c_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->lead_type_add($data);
	    if($result){
				$this->session->set_flashdata('l_t_success', 'Lead Type has been created successfully...');
	    }else{
	      	   $this->session->set_flashdata('l_t_err', 'Could not create lead type!');
	    }
	    redirect('Leads/lead_type_list');

	}
	 // To update lead type deatils
    public function lead_type_update()
    {
    	$l_t_id = $this->input->post('e_lead_type_id');
    	$data['lead_type'] = trim($this->input->post('lead_type'), ' ');
	    $data['m_on'] = date('Y-m-d H:i:s');
	    $data['m_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->lead_type_update($data, $l_t_id);
	    if($result){
				$this->session->set_flashdata('l_t_success', 'Lead Type has been updated successfully...');
	    }else{
	      	   $this->session->set_flashdata('l_t_err', 'Could not update lead type!');
	    }
	    redirect('Leads/lead_type_list');

    }

	// To delete lead type
	public function lead_type_delete()
	{
		$l_t_id = $this->input->post('delete_lead_type_id');
		// To check lead type in lead
		$check_l_type = $this->Lead_model->lead_type_in_lead($l_t_id);

		if(empty($check_l_type))
		{
			$status = 2;
			$result = $this->Lead_model->lead_type_change_status($l_t_id, $status);
		}else{
			$this->session->set_flashdata('l_t_err', 'Could not delete lead type. Lead Type is mapped with other modules!');
		}
	    redirect('Leads/lead_type_list');
	}
	/* *****************************************************************************************************************************
										Purpose : To handle Lead Source Functions
					        **********************************************************************/
	
	// To list lead Source settings
	public function lead_source_list()
	{
		$data['lead_sources'] = $this->Lead_model->lead_source_list();
		$this->load->view('lead/lead_source_list', $data);
	}
	
	// To check lead Source name is unique
	public function lead_source_unique()
	{
		$l_s_name = $this->input->post('value');
		$result = $this->Lead_model->lead_source_unique($l_s_name);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To check lead Source name is unique for edit form
	public function lead_source_unique_edit()
	{
		$l_s_name = $this->input->post('value');
		$l_s_id = $this->input->post('id');
		$result = $this->Lead_model->lead_source_unique_edit($l_s_name, $l_s_id);
		if($result){ echo 1; }else{ echo 0; }
	}


	// To add lead Source
	public function lead_source_add()
	{
		$data['lead_source'] = trim($this->input->post('lead_source_name'), ' ');
		$data['lead_source_color'] = trim($this->input->post('lead_source_color'), ' ');
	    $data['c_on'] = date('Y-m-d H:i:s');
	    $data['c_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->lead_source_add($data);
	    if($result){
				$this->session->set_flashdata('l_t_success', 'Lead Source has been created successfully...');
	    }else{
	      	   $this->session->set_flashdata('l_t_err', 'Could not create lead source!');
	    }

	     redirect('Leads/lead_source_list');

	}
	// To change lead Source status
	public function lead_source_change_status()
	{
		$l_t_id = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Lead_model->lead_source_change_status($l_t_id, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To delete lead Source
	public function lead_source_delete()
	{
		$l_s_id = $this->input->post('delete_lead_source_id');
		// To check lead source in lead
		$check_l_source = $this->Lead_model->lead_source_in_lead($l_s_id);
	
		if(empty($check_l_source))
		{
			$status = 2;
		    $result = $this->Lead_model->lead_source_change_status($l_s_id, $status);
		    $this->session->set_flashdata('l_t_success', 'Lead Source has been deleted successfully...');
		    redirect('Leads/lead_source_list');
		}
		else{

			$this->session->set_flashdata('l_t_err', 'Could not delete lead source. Lead Source is mapped with other modules!');
			redirect('Leads/lead_source_list');
		}
	}
	// To get lead Source edit form by id 
    public function lead_source_edit()
    {
		$l_s_id = $this->input->post('value');
		$result = $this->Lead_model->lead_source_by_id($l_s_id);
		if($result){ echo $result->lead_source_id.'|'.$result->lead_source.'|'.$result->source_color; }else{ echo ''; }
    }
    // To update lead Source deatils
    public function lead_source_update()
    {
    	$l_s_id = $this->input->post('edit_lead_source_id');
    	$data['lead_source'] = $this->input->post('edit_lead_source_name');
    	$data['source_color'] = $this->input->post('e_lead_source_color');
	    $data['m_on'] = date('Y-m-d H:i:s');
	    $data['m_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->lead_source_update($data, $l_s_id);

	    if($result == 1){
				$this->session->set_flashdata('l_t_success', 'Lead Source has been updated successfully...');
				redirect('Leads/lead_source_list');
	    }else{
	      	   $this->session->set_flashdata('l_t_err', 'Could not update lead source!');
	      	   redirect('Leads/lead_source_list');
	    }
	     
    }
	// To get status base on leads
	public function lead_status_base_list()
	{
		
		$lead_status_baseds = $this->Lead_model->lead_status_based_list();	
		$lead_status_count  = count($lead_status_baseds) ;
		$res = array();
		foreach ($lead_status_baseds as $key => $lead_status_based) {

			$key = $key+1;
			if($key  != $lead_status_count){

				$option = array('label' => $lead_status_based->label,'value' => $lead_status_based->value, 'color' => $lead_status_based->color);
			}else{
				$option = array('label' => $lead_status_based->label,'value' => $lead_status_based->value, 'color' => $lead_status_based->color);
			}	

			array_push($res, $option);

	    }
		echo json_encode( $res);
	}

	// To get status base on leads
	public function lead_source_base_list()
	{
		
		$lead_source_baseds = $this->Lead_model->lead_source_base_list();	
		$lead_source_count  = count($lead_source_baseds) ;
		$res = array();
		foreach ($lead_source_baseds as $key => $lead_source_based) {

			$key = $key+1;
			if($key  != $lead_source_count){

				$option = array('label' => $lead_source_based->label,'value' => $lead_source_based->value, 'color' => $lead_source_based->color);
			}else{
				$option = array('label' => $lead_source_based->label,'value' => $lead_source_based->value, 'color' => $lead_source_based->color);
			}	

			array_push($res, $option);

	    }
		echo json_encode( $res);
	}



	// To get type base on leads
	public function lead_type_base_list()
	{
		
		$lead_type_baseds = $this->Lead_model->lead_type_based_list();	
		$lead_type_count  = count($lead_type_baseds) ;
		$res = array();
		foreach ($lead_type_baseds as $key => $lead_type_based) {

			$key = $key+1;
			if($key  != $lead_type_count){

				$option = array('label' => $lead_type_based->label,'value' => $lead_type_based->value, 'color' => $lead_type_based->color);
			}else{
				$option = array('label' => $lead_type_based->label,'value' => $lead_type_based->value, 'color' => $lead_type_based->color);
			}	

			array_push($res, $option);

	    }
		echo json_encode( $res);
	}

	// To get lead taken by user list 
	public function lead_user_list()
	{
		$search =  $_GET['query']; 
	    $rows = $this->Lead_model->lead_user_list($search);
	    $data='[';
	    foreach($rows as $row )
	    {
	        $title='';
	        $title = $row->displayname;
	        $data.='{ "title":"'.$title.'","id":"'.$row->user_id.'","name":"'.$row->displayname.'"},';
	    }
	    $data=rtrim($data,',');
	    $data.=']';
	    print_r($data);
	}

	// To get customer list 
	public function lead_customer_list()
	{
		$search =  $_GET['query']; 
	    $rows = $this->Lead_model->lead_customer_list($search);
	    $data='[';
	    foreach($rows as $row )
	    {
	        $title='';
	        $title = $row->contact_person;
	        $data.='{ "title":"'.$title.'","id":"'.$row->customer_id.'","name":"'.$row->contact_person.'"},';
	    }
	    $data=rtrim($data,',');
	    $data.=']';
	    print_r($data);
	}
	/* ************************************************************************************
						Purpose : To handle Lead status Setting Functions
	        **********************************************************************/
	
	// To list lead status settings
	public function lead_status_list()
	{
		$data['lead_statuss'] = $this->Lead_model->lead_status_list();
		$this->load->view('lead/lead_status_list', $data);
	}
	
	// To check lead status is unique
	public function lead_status_unique()
	{
		$l_t_name = $this->input->post('value');
		$result = $this->Lead_model->lead_status_unique($l_t_name);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To check lead status name is unique for edit form
	public function lead_status_unique_edit()
	{
		$l_t_name = $this->input->post('value');
		$l_t_id = $this->input->post('id');
		$result = $this->Lead_model->lead_status_unique_edit($l_t_name, $l_t_id);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To get lead status edit form by id 
    public function lead_status_edit()
    {
		$l_t_id = $this->input->post('value');
		$result = $this->Lead_model->lead_status_by_id($l_t_id);
		if($result){ echo $result->lead_status_id.'|'.$result->lead_status; }else{ echo ''; }
    }

    // To change lead status status
	public function lead_status_change_status()
	{
		$l_t_id = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Lead_model->lead_status_change_status($l_t_id, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To add lead status
	public function lead_status_add()
	{
		$data['lead_status'] = trim($this->input->post('lead_status'), ' ');
	   	$data['c_on'] = date('Y-m-d H:i:s');
	    $data['c_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->lead_status_add($data);
	    if($result){
				$this->session->set_flashdata('l_t_success', 'Lead Status has been created successfully...');
	    }else{
	      	   $this->session->set_flashdata('l_t_err', 'Could not create lead status!');
	    }
	    redirect('Leads/lead_status_list');

	}
	 // To update lead status deatils
    public function lead_status_update()
    {
    	$l_t_id = $this->input->post('e_lead_status_id');
    	$data['lead_status'] = trim($this->input->post('lead_status'), ' ');
	    $data['m_on'] = date('Y-m-d H:i:s');
	    $data['m_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->lead_status_update($data, $l_t_id);
	    if($result){
				$this->session->set_flashdata('l_t_success', 'Lead Status has been updated successfully...');
	    }else{
	      	   $this->session->set_flashdata('l_t_err', 'Could not update lead status!');
	    }
	    redirect('Leads/lead_status_list');

    }

	// To delete lead status
	public function lead_status_delete()
	{
		$l_t_id = $this->input->post('delete_lead_status_id');
		// To check lead status in lead
		$check_l_status = $this->Lead_model->lead_status_in_lead($l_t_id);

		if(empty($check_l_status))
		{
			$status = 2;
			$result = $this->Lead_model->lead_status_change_status($l_t_id, $status);
		}else{
			$this->session->set_flashdata('l_t_err', 'Could not delete lead status. Lead Status is mapped with other modules!');
		}
	    redirect('Leads/lead_status_list');
	}


	// To bulk update details
	public function opportunity_bulk_updation()
	{

		$bulk_update = $this->input->post('bulk_update');
		$bulk_lead_ids = $this->input->post('bulk_lead_ids');

		$bulk_lead_type = ($this->input->post('bulk_lead_type')) ? $this->input->post('bulk_lead_type') : '';
		$bulk_lead_status = ($this->input->post('bulk_lead_status')) ? $this->input->post('bulk_lead_status') : '';
		$bulk_lead_assigned_to = ($this->input->post('bulk_lead_assigned_to')) ? $this->input->post('bulk_lead_assigned_to') : '';
		$bulk_lead_source = ($this->input->post('bulk_lead_source')) ? $this->input->post('bulk_lead_source') : '';
		$bulk_reason = $this->input->post('bulk_reason');

		if($bulk_lead_type > 0)
		{
			$data['lead_type_id'] = $bulk_lead_type;
		}

		if($bulk_lead_source > 0)
		{
			$data['lead_source_id'] = $bulk_lead_source;
		}

		if($bulk_lead_status > 0)
		{
			$data['lead_status_id'] = $bulk_lead_status;
		}

		if($bulk_lead_assigned_to > 0)
		{
			$data['lead_assigned_to'] = $bulk_lead_assigned_to;
		}

		if($bulk_lead_ids != '')
		{
			$explode_values = explode(',', $bulk_lead_ids);
			foreach ($explode_values as $key => $explode_val) 
			{
				$lead_details = $this->Lead_model->lead_by_id($explode_val);
				if($bulk_update == 1 && ($data['lead_type_id'] != '' || $data['lead_source_id'] != '' || $data['lead_status_id'] != '' || $data['lead_assigned_to'] != ''))
				{
					$data['modified_by'] = $_SESSION['admindata']['user_id'];
					$data['modified_on'] = date('Y-m-d H:i:s');
					$lead_result = $this->Lead_model->lead_update($data, $explode_val);
					$log_details = '';
					if( isset($data['lead_type_id']) && $data['lead_type_id'] != $lead_details->lead_type_id)
					{
						$lead_type_details = $this->Lead_model->lead_type_by_id($data['lead_type_id']);
						$log_details .= '<strong>Priority : </strong>'. $lead_details->l_type.' To ' . $lead_type_details->lead_type.'<br>';;
					}
					if( isset($data['lead_source_id']) && $data['lead_source_id'] != $lead_details->lead_source_id)
					{
						$lead_source_details = $this->Lead_model->lead_source_by_id($data['lead_source_id']);
						$log_details .= '<strong>Lead Source : </strong>'. $lead_details->lead_source_name.' To ' . $lead_source_details->lead_source.'<br>';;
					}

					if(isset($data['lead_status_id']) && $data['lead_status_id'] != $lead_details->lead_status_id)
					{
						$lead_status_details = $this->Lead_model->lead_status_by_id($data['lead_status_id']);
						$log_details .= '<strong>Lead Status : </strong>'. $lead_details->lead_status_name.' To ' . $lead_status_details->lead_status.'<br>';;
					}
					if(isset($data['lead_assigned_to']) && $data['lead_assigned_to'] != $lead_details->lead_assigned_to)
					{
						$user_details = $this->User_model->user_by_id($data['lead_assigned_to']);
						$log_details .= '<strong>Lead assigned To : </strong>'. $lead_details->lead_assigned_name.' To ' . $user_details->name.'<br>';;
					}

					if(isset($data['bulk_reason']) && $data['bulk_reason'] != '')
					{
						$log_details .= '<strong>Bulk Update Reason - </strong> : '.$data['bulk_reason'];
					}
					
					$log_data['lead_id'] = $explode_val;
					$log_data['log_type'] = 2;
					$log_data['log_details'] = $log_details;
					$log_data['created_by'] = $_SESSION['admindata']['user_id'];
					$log_data['created_on'] = date('Y-m-d H:i:s');
					$lead_log_result = $this->Lead_model->lead_log_save($log_data);
				}
				else if($bulk_update == 2)
				{
					$result = $this->Lead_model->lead_cancel($explode_val);
					$log_data['lead_id'] = $explode_val;
					$log_data['log_type'] = 5;
					$log_data['log_details'] = $bulk_reason;
					$log_data['created_by'] = $_SESSION['admindata']['user_id'];
					$log_data['created_on'] = date('Y-m-d H:i:s');
					$lead_log_result = $this->Lead_model->lead_log_save($log_data);
				}
			}
		}
		$this->session->set_flashdata('l_success', 'Bulk Updation has been updated successfully...');
		redirect('Leads/opportunity_list');
	}

 // To bulk update details
	public function bulk_updation()
	{

		$bulk_update = $this->input->post('bulk_update');
		$bulk_lead_ids = $this->input->post('bulk_lead_ids');

		$bulk_lead_type = ($this->input->post('bulk_lead_type')) ? $this->input->post('bulk_lead_type') : '';
		$bulk_lead_status = ($this->input->post('bulk_lead_status')) ? $this->input->post('bulk_lead_status') : '';
		$bulk_lead_assigned_to = ($this->input->post('bulk_lead_assigned_to')) ? $this->input->post('bulk_lead_assigned_to') : '';
		$bulk_lead_source = ($this->input->post('bulk_lead_source')) ? $this->input->post('bulk_lead_source') : '';
		$bulk_product = ($this->input->post('m_product')) ? $this->input->post('m_product') : '';
		$bulk_industry = ($this->input->post('m_industry')) ? $this->input->post('m_industry') : '';
		$bulk_reason = $this->input->post('bulk_reason');

		if($bulk_lead_type > 0)
		{
			$data['lead_type_id'] = $bulk_lead_type;
		}

		if($bulk_lead_source > 0)
		{
			$data['lead_source_id'] = $bulk_lead_source;
		}

		if($bulk_lead_status > 0)
		{
			$data['lead_status_id'] = $bulk_lead_status;
		}

		if($bulk_lead_assigned_to > 0)
		{
			$data['lead_assigned_to'] = $bulk_lead_assigned_to;
		}

		if($bulk_product > 0)
		{	
			$data['product_id'] = $bulk_product;
		}

		if($bulk_industry > 0)
		{
			$data['industry_id'] = $bulk_industry;
		}
		if($bulk_lead_ids != '')
		{
			$explode_values = explode(',', $bulk_lead_ids);
			foreach ($explode_values as $key => $explode_val) 
			{
				$lead_details = $this->Lead_model->lead_by_id($explode_val);
				if($bulk_update == 1 && ($data['lead_type_id'] != '' || $data['lead_source_id'] != '' || $data['lead_status_id'] != '' || $data['lead_assigned_to'] != '' || $data['product_id'] != ''))
				{
					$data['modified_by'] = $_SESSION['admindata']['user_id'];
					$data['modified_on'] = date('Y-m-d H:i:s');
					$lead_result = $this->Lead_model->lead_update($data, $explode_val);
					$log_details = '';
					if( isset($data['lead_type_id']) && $data['lead_type_id'] != $lead_details->lead_type_id)
					{
						$lead_type_details = $this->Lead_model->lead_type_by_id($data['lead_type_id']);
						$log_details .= '<strong>Priority : </strong>'. $lead_details->l_type.' To ' . $lead_type_details->lead_type.'<br>';;
					}
					if( isset($data['lead_source_id']) && $data['lead_source_id'] != $lead_details->lead_source_id)
					{
						$lead_source_details = $this->Lead_model->lead_source_by_id($data['lead_source_id']);
						$log_details .= '<strong>Lead Source : </strong>'. $lead_details->lead_source_name.' To ' . $lead_source_details->lead_source.'<br>';;
					}

					if(isset($data['lead_status_id']) && $data['lead_status_id'] != $lead_details->lead_status_id)
					{
						$lead_status_details = $this->Lead_model->lead_status_by_id($data['lead_status_id']);
						$log_details .= '<strong>Lead Status : </strong>'. $lead_details->lead_status_name.' To ' . $lead_status_details->lead_status.'<br>';;
					}
					if(isset($data['lead_assigned_to']) && $data['lead_assigned_to'] != $lead_details->lead_assigned_to)
					{
						$user_details = $this->User_model->user_by_id($data['lead_assigned_to']);
						$log_details .= '<strong>Lead assigned To : </strong>'. $lead_details->lead_assigned_name.' To ' . $user_details->name.'<br>';;
					}
					if(isset($data['product_id']) && $data['product_id'] != $lead_details->product_id)
					{
						$product_details = $this->Product_model->product_by_id($data['product_id']);
						$log_details .= '<strong>Lead assigned To : </strong>'. $lead_details->product_name.' To ' . $product_details->product_name.'<br>';;
					}
					if(isset($data['bulk_reason']) && $data['bulk_reason'] != '')
					{
						$log_details .= '<strong>Bulk Update Reason - </strong> : '.$data['bulk_reason'];
					}
					
					$log_data['lead_id'] = $explode_val;
					$log_data['log_type'] = 2;
					$log_data['log_details'] = $log_details;
					$log_data['created_by'] = $_SESSION['admindata']['user_id'];
					$log_data['created_on'] = date('Y-m-d H:i:s');
					$lead_log_result = $this->Lead_model->lead_log_save($log_data);
				}
				else if($bulk_update == 2)
				{
					$result = $this->Lead_model->lead_cancel($explode_val);
					$log_data['lead_id'] = $explode_val;
					$log_data['log_type'] = 5;
					$log_data['log_details'] = $bulk_reason;
					$log_data['created_by'] = $_SESSION['admindata']['user_id'];
					$log_data['created_on'] = date('Y-m-d H:i:s');
					$lead_log_result = $this->Lead_model->lead_log_save($log_data);
				}
			}
		}
		$this->session->set_flashdata('l_success', 'Bulk Updation has been updated successfully...');
		redirect('Leads');
	}
	// To upload lead document
	public function lead_upload_document()
	{
		$data['lead_id'] = $this->input->post('lead_id');
		$this->load->view('lead/lead_upload_document', $data);
	}
	// To upload file document
	public function lead_upload_document_update()
	{
		$lead_id = $this->input->post('lead_id');
		if (!is_dir('assets/lead_documents/lead-'.$lead_id)) 
	   	{
		    mkdir('assets/lead_documents/lead-'.$lead_id, 0777, TRUE);
		}

		$data = array();
        if(!empty($_FILES['files']['name'])){
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['files']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['files']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['files']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['files']['size'][$i];
 
                $config['upload_path'] = 'assets/lead_documents/lead-'.$lead_id; 
                
                $config['allowed_types'] = '*';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                }
            }
        }
        $_SESSION['active_panel'] = "lead_documents";
        $this->session->set_flashdata('l_view_success', 'Lead document has been uploaded successfully...');
	  	redirect('lead_view/'.$lead_id);
	}

// To show lead bulk import
public function lead_bulk_import()
{
	$this->load->view('lead/lead_bulk_import');
}

public function oppo_bulk_import()
{
	$this->load->view('lead/oppo_bulk_import');
}
// To download lead upload sample details
public function lead_upload_file()
{
	// echo "hello";
 //    die();
    $objPHPExcel = new PHPExcel();
    $activeSheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000')
            )/*,
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )*/
        );
    
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Lead Name(*)');
    $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
    
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Company Name');
    $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
   
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Country(*)');
    $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
   
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Designation');
    $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
   
    $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Website');
    $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Address');
    $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Primary Email ID(*)');
    $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Alternate Email ID');
    $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Skype ID');
    $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Contact No');
    $objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Whatsapp No');
    $objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Office Contact No');
    $objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Product(*)');
    $objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray($styleArray);

    // $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Industry');
    // $objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Sub Lead Source(*)');
    $objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Priority(*)');
    $objPHPExcel->getActiveSheet()->getStyle('O1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Lead Status(*)');
    $objPHPExcel->getActiveSheet()->getStyle('P1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Assigned To(*)');
    $objPHPExcel->getActiveSheet()->getStyle('Q1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Message');
    $objPHPExcel->getActiveSheet()->getStyle('R1')->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Created On');
    $objPHPExcel->getActiveSheet()->getStyle('S1')->applyFromArray($styleArray);

    $objWorkSheet = $objPHPExcel->createSheet('2');
    $objPHPExcel->setActiveSheetIndex(1)->getRowDimension(1)->setRowHeight(20);
    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('A')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A1', 'Country');
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('A1')->applyFromArray($styleArray);
    $ty = "";
    $i  = 2;
    $j  = 1;

    $country_lists = $this->Lead_model->country_list(); 

    // print_r($country_lists);
    // die();
    foreach($country_lists as $country_list)
    {     
      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$i, $country_list->name);
      $i++;
      $j++;      
    }

    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B1', 'Products');
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B1')->applyFromArray($styleArray);
    $ty = "";
    $i  = 2;
    $j  = 1;

    $products = $this->Product_model->lead_product_list(); 

    foreach($products as $product)
    {     
      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$i, $product->product_name);
      $i++;
      $j++;      
    }

    // $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('C')->setWidth(20);
    // $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C1', 'Industry');
    // $objPHPExcel->setActiveSheetIndex(1)->getStyle('C1')->applyFromArray($styleArray);
    // $ty = "";
    // $i  = 2;
    // $j  = 1;

    // $industry_lists = $this->Setting_model->industry_list();; 

    // foreach($industry_lists as $industry_list)
    // {     
    //   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$i, $industry_list->industry_name);
    //   $i++;
    //   $j++;      
    // }

    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D1', 'Sub Lead Source');
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('D1')->applyFromArray($styleArray);
    $ty = "";
    $i  = 2;
    $j  = 1;

    $lead_source_lists = $this->Lead_model->sub_lead_source_list(); 

    foreach($lead_source_lists as $lead_source_list)
    {     
    	if ($lead_source_list->status == 0) {
			$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$i, $lead_source_list->sub_lead_source);
			$i++;
			$j++;      
		}
    }

    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E1', 'Priority');
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('E1')->applyFromArray($styleArray);
    $ty = "";
    $i  = 2;
    $j  = 1;

    $lead_type_lists = $this->Lead_model->lead_type_list(); 

    foreach($lead_type_lists as $lead_type_list)
    {    
      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$i, $lead_type_list->lead_type);
      $i++;
      $j++;      
    }

    
    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F1', 'Assigned Users');
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('F1')->applyFromArray($styleArray);
    $ty = "";
    $i  = 2;
    $j  = 1;

    $user_lists = $this->User_model->get_user_list_info(); 

    foreach($user_lists as $user_list)
    {   
    $name= ''; 
    //$name = $user_list->name.'-'.$user_list->role_name;  
    $name = $user_list->name; 
      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$i, $name);
      $i++;
      $j++;      
    }

    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G1', 'Lead Status');
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('G1')->applyFromArray($styleArray);
    $ty = "";
    $i  = 2;
    $j  = 1;

    $lead_status_details = $this->Lead_model->lead_status_list(); 

    foreach($lead_status_details as $lead_status_detail)
    {  
      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$i, $lead_status_detail->lead_status);
      $i++;
      $j++;      
    }

    $objWorkSheet->setTitle("Dropdown Information");
    $filename='Sample_Lead_Upload_File.xls'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objPHPExcel->setActiveSheetIndex(0);


    if (ob_get_contents()) ob_end_clean(); 
    	
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
    
  }

  // To update lead details import
  public function lead_bulk_import_update()
  {		
	    PHPExcel_IOFactory::createReader('Excel2007');
	    $filename=$_FILES["lead_import"]["tmp_name"];
	    if($_FILES["lead_import"]["size"] > 0)
	    {
	        try
	        {
	          $objPHPExcel = PHPExcel_IOFactory::load($filename);
	        }catch(Exception $e)
	        {
	          die('Error loading file "'.pathinfo($filename,PATHINFO_BASENAME).'": '.$e->getMessage());
	        }

	        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

		//echo $arrayCount;exit;
	       
	     //   $ins=0;$alr=0; $emptrow=1;
	       
	        if(trim($allDataInSheet[1]["A"])=='Lead Name(*)' && trim($allDataInSheet[1]["C"])=='Country(*)' 
	        	&& trim($allDataInSheet[1]["G"])=='Primary Email ID(*)' && trim($allDataInSheet[1]["M"])=='Product(*)' && trim($allDataInSheet[1]["N"])=='Sub Lead Source(*)' && trim($allDataInSheet[1]["O"])=='Priority(*)' && trim($allDataInSheet[1]["P"])=='Lead Status(*)' && trim($allDataInSheet[1]["Q"])=='Assigned To(*)' && trim($allDataInSheet[1]["R"])=='Message' && trim($allDataInSheet[1]["S"])=='Created On')
	        { 
	          $emptrow  = ""; $errmsg = ""; $l_name_err = ""; $country_err = ""; $email_err = ''; $prd_err = ""; $l_source_err = ''; $l_type_err = ""; $l_status_err = ""; 
	          $l_assign_err = ""; $row_err = '';

	            if($arrayCount > 1)
	            {
	            	for($i=2;$i<=$arrayCount;$i++)
		            {
		            	$ex_contact_book_id = '';
			            if(trim($allDataInSheet[$i]["A"]) != '')
			            {
			                $data['lead_name'] = trim($allDataInSheet[$i]["A"]); 
			            }
			            else{
		                  $data['lead_name'] = '';
		                  $errmsg = "1";
		                  $l_name_err .= "'$i',";
			            }
			            if(trim($allDataInSheet[$i]["B"])!='')
			            {
			                $data['company_name'] = trim($allDataInSheet[$i]["B"]);
			            }
			            else
			            {
			                $data['company_name'] = '';
			            }

			            if(trim($allDataInSheet[$i]["C"])!='')
			            {
			                // To check menu item already exits or not
			                $country_details = $this->Lead_model->country_id(trim($allDataInSheet[$i]["C"]));

			                if(!empty($country_details))
			                {
			                    $data['country'] = $country_details->id; 
			                }else{
			                    $data['country'] = '';
			                    $errmsg = "1";
			                	$country_err .= "'$i',";
			                }
			            }
			            else
			            {
			                $data['country'] = '';
			                $errmsg = "1";
			                $country_err .= "'$i',";
			            }

			             if(trim($allDataInSheet[$i]["D"])!='')
						{
							$data['designation'] = trim($allDataInSheet[$i]["D"]);
						}
						else
						{
							$data['designation'] = '';
						}

			              if(trim($allDataInSheet[$i]["E"])!='')
			              {
			                 $data['website'] = trim($allDataInSheet[$i]["E"]);
			              }
			              else
			              {
			                $data['website'] = '';
			              }

			              if(trim($allDataInSheet[$i]["F"])!='')
			              {
			                 $data['address'] = str_replace("'", "`", trim($allDataInSheet[$i]["F"]));
			              }
			              else
			              {
			                $data['address'] = '';
			              } 

			              if(trim($allDataInSheet[$i]["G"])!='')
			              {
			              	$check_c_no = common_select_values('*', 'contact_book', ' email_id= "'.trim($allDataInSheet[$i]["G"]).'" AND status != 2', 'row');
			                 //$data['email_id'] = trim($allDataInSheet[$i]["G"]);
			              	if(empty($check_c_no))
			              	{
			                 	$data['email_id'] = trim($allDataInSheet[$i]["G"]);
			             	}
			             	else
			             	{
			             		$ex_contact_book_id = $check_c_no->contact_book_id;
			             		$data['email_id'] = $check_c_no->email_id;
			             		// $data['email_id'] = '';
				              //   $errmsg = "1";
				              //   $email_err .= "'$i',";
			             	}
			              }
			              else
			              {
			                $data['email_id'] = ''; 
			                $errmsg = "1"; 
			                $email_err .= "'$i',";  
			              } 

			              if(trim($allDataInSheet[$i]["H"])!='')
			              {
			                 $data['alternative_email_id'] = trim($allDataInSheet[$i]["H"]);
			              }
			              else
			              {
			                $data['alternative_email_id'] = '';
			              } 

			              if(trim($allDataInSheet[$i]["I"])!='')
			              {
			                 $data['skype_id'] = trim($allDataInSheet[$i]["I"]);
			              }
			              else
			              {
			                $data['skype_id'] = '';
			              } 

			              if(trim($allDataInSheet[$i]["J"])!='')
			              {
			                 $data['contact_no'] = trim($allDataInSheet[$i]["J"]);
			              }
			              else
			              {
			                $data['contact_no'] = '';
			              } 

			              if(trim($allDataInSheet[$i]["K"])!='')
			              {
			                 $data['whatsapp_no'] = trim($allDataInSheet[$i]["K"]);
			              }
			              else
			              {
			                $data['whatsapp_no'] = '';
			              }

			              if(trim($allDataInSheet[$i]["L"])!='')
			              {
			                 $data['office_phone_no'] = trim($allDataInSheet[$i]["L"]);
			              }
			              else
			              {
			                $data['office_phone_no'] = '';
			              }

			              if(trim($allDataInSheet[$i]["M"])!='')
			              {
			              	$product_details = $this->Product_model->product_id_by_name(trim($allDataInSheet[$i]["M"]));

			              	if(!empty($product_details))
			                {
			                	if($ex_contact_book_id != '') {
			                    	$product_id = $product_details->product_id; 
			                    	$industry_id = $product_details->industry_id; 
			                    	$chk_with_lead_contact_book_has_same_product = common_select_values('*','leads','contact_book_id = "'.$ex_contact_book_id.'" AND product_id = "'.$product_id.'"','row');
			                    	if (count($chk_with_lead_contact_book_has_same_product) > 0) {
			                    		// echo "same product already exist";
			                    		$data1['product_id'] = ''; 
					                    $data1['industry_id'] = ''; 
					                    $errmsg = "1"; 
					                    $prd_err .= "'$i',"; 
			                    	}
			                    	else {
			                    		$data1['product_id'] = $product_details->product_id; 
					                    $data1['industry_id'] = $product_details->industry_id; 
			                    	}
			                    } else {
			                    	$data1['product_id'] = $product_details->product_id; 
			                    	$data1['industry_id'] = $product_details->industry_id; 
			                    }
			                }else {
			                    $data1['product_id'] = '';
			                    $data1['industry_id'] = ''; 
			                    $errmsg = "1";
			                    $prd_err .= "'$i',";
			                }
			              }
			              else
			              {
			                $data1['product_id'] = '';
			                $data1['industry_id'] = ''; 
			                $errmsg = "1";
			                $prd_err .= "'$i',";
			              }

			              if(trim($allDataInSheet[$i]["N"])!='')
			              {
			              	$source_details = common_select_values('sub_lead_source_id', 'sub_lead_source', 'sub_lead_source = "'.trim($allDataInSheet[$i]["N"]).'"', 'row');

			              	if(!empty($source_details)) {
			                    $data1['lead_source_id'] = $source_details->sub_lead_source_id; 
			                } 
			                else {
			                    $data1['lead_source_id'] = '';
			                    $errmsg = "1";
			              		$l_source_err .= "'$i',";
			                }
			              }
			              else
			              {
			                $data1['lead_source_id'] = '';
			                $errmsg = "1";
			                $l_source_err .= "'$i',";
			              }

			              if(trim($allDataInSheet[$i]["O"])!='')
			              {
			              	$type_details = common_select_values('lead_type_id', 'lead_type', 'lead_type = "'.trim($allDataInSheet[$i]["O"]).'"', 'row');

			              	if(!empty($type_details))
			                {
			                    $data1['lead_type_id'] = $type_details->lead_type_id; 
			                }else{
			                    $data1['lead_type_id'] = '';
			                    $errmsg = "1";
			              		$l_type_err .= "'$i',";
			                }
			              }
			              else
			              {
			                $data1['lead_type_id'] = '';
			                $errmsg = "1";
			                $l_type_err .= "'$i',";
			              }
			              
			              if(trim($allDataInSheet[$i]["P"])!='')
			              {
			              	$status_details = common_select_values('lead_status_id', 'lead_status', 'lead_status = "'.trim($allDataInSheet[$i]["P"]).'"', 'row');

			              	if(!empty($status_details))
			                {
			                    $data1['lead_status_id'] = $status_details->lead_status_id; 
			                }else{
			                    $data1['lead_status_id'] = '';
			                    $errmsg = "1";
			                    $l_status_err .= "'$i',";
			                }
			              }
			              else
			              {
			                $data1['lead_status_id'] = '';
			                $errmsg = "1";
			                $l_status_err .= "'$i',";
			              }

			              if(trim($allDataInSheet[$i]["Q"])!='')
			              {
			              	$user_details = common_select_values('user_id', 'users', 'name = "'.trim($allDataInSheet[$i]["Q"]).'"', 'row');

			              	if(!empty($user_details))
			                {
			                    $data1['lead_assigned_to'] = $user_details->user_id; 
			                }else{
			                    $data1['lead_assigned_to'] = '';
			                    $errmsg = "1";
			              		$l_status_err .= "'$i',";
			                }
			              }
			              else
			              {
			                $data1['lead_assigned_to'] = '';
			                $errmsg = "1";
			                $l_assign_err .= "'$i',";
			              }

			              if(trim($allDataInSheet[$i]["R"])!='')
			              {
			                 $trim_rmv = trim($allDataInSheet[$i]["R"]);
			                 $data1['message'] = str_replace("'", "`", $trim_rmv);
			              }
			              else
			              {
			                $data1['message'] = '';
			              }
			              if(trim($allDataInSheet[$i]["S"])!='')
			              { 
			                 $formated_datetime = date('Y-m-d H:i:s',strtotime(trim($allDataInSheet[$i]["S"])));
			                 $data1['created_on'] = $formated_datetime;
			                 $data['created_on'] = $formated_datetime;
			              }
			              else
			              {
			                $data1['created_on'] = date('Y-m-d H:i:s');
			              }
			            $data1['created_by'] = $_SESSION['admindata']['user_id'];
			            $data['created_by'] = $_SESSION['admindata']['user_id'];

			            


						if($data['lead_name'] != '' && $data['country']!='' && $data['email_id']!='' && $data1['product_id']!='' && $data1['lead_source_id']!='' && $data1['lead_type_id']!='' && $data1['lead_status_id']!='' && $data1['lead_assigned_to']!='')
						{
							$lead_id = '';
							$lead_id = $this->Lead_model->lead_next_auto_id();
							if($ex_contact_book_id == ''){
								$add_contact_info = $this->Lead_model->add_new_contact_info($data);
							}
							else {
								$add_contact_info = $ex_contact_book_id;
							}
							$data1['cont_book_id_for_lead'] = $add_contact_info;
							$data1['lead_code'] = date('Y').''.date('m').''.'00'.$lead_id->AUTO_INCREMENT;
							$data1['status'] = '0';
							$lead_result = $this->Lead_model->lead_save($data1);

							$log_data['lead_id'] = $lead_id->AUTO_INCREMENT;
							$log_data['log_type'] = 1;
							$log_data['log_details'] = $data['lead_name'].' has been created as new lead';
							$log_data['created_by'] = $_SESSION['admindata']['user_id'];
							$log_data['created_on'] = date('Y-m-d H:i:s');
							// $lead_log_result = $this->Lead_model->lead_log_save($log_data);
						}
						else {
							$errmsg = "1";
							$data['lead_name'].'<br>';
				            $data['country'].'<br>';
				            $data['email_id'].'<br>';
				            $data['product_id'].'<br>';
				            $data['lead_source_id'].'<br>';
				            $data['lead_type_id'].'<br>';
				            $data['lead_status_id'].'<br>';
				            $data['lead_assigned_to'].'<br>';
							$row_err .= "'$i',";
						}
		            
		        	}// End for loop
	            }
	            else{
	            	$emptrow = 2;
	            }
	        ?>
	         <html>
                    <head>
                    <style>
                    .code{
                        border:1px solid blue;
                        border-left:10px solid #ccc;
                        background:#eee;
                      
                        padding:5px;
                        margin:5px;
                        overflow-x: hidden;
                    }
                    .alert {
                        padding: 20px;
                        background-color: #f44336;
                        color: white;
                        opacity: 1;
                        transition: opacity 0.6s;
                        margin-bottom: 15px;
                    }

                    .alert.success {background-color: #4CAF50;}
                    .alert.info {background-color: #2196F3;}
                    .alert.warning {background-color: #ff9800;}

                    .closebtn {
                      
                        margin-left: 15px;
                        color: black;
                        font-weight: bold;
                        float: right;
                        font-size: 35px;
                        line-height: 20px;
                        cursor: pointer;
                        transition: 0.3s;
                    }

                    .closebtn:hover {
                        color: black;
                    }
                    </style>
                    </head>
                    <body>
                    <center>
                    <div class="code" style="width:664px;">
                    <a href="<?php echo base_url(); ?>new_leads?active_tab=1"><span style="color:black" class="closebtn">&times;</span> </a>    
                    <?php if($emptrow !='' || $errmsg != '' || $l_name_err !='' || $country_err !='' || $email_err !='' || $prd_err !='' || $l_source_err !='' || $l_type_err !='' || $l_status_err !='' || $l_assign_err !='' || $row_err != '')
                    { ?>
                    	<h2>Alert Messages</h2>
                        <?php if($l_name_err !='')
                        {?>
	                        <div class="alert" style="width:464px;">
	                          <strong>Lead Name Issue!</strong> On these rows <?php echo trim($l_name_err,', ');?>.
	                        </div>
                        <?php } ?>

                        <?php if($country_err !='')
                        {?>
	                        <div class="alert" style="width:464px;">
	                          <strong>Country Issue!</strong> On these rows <?php echo trim($country_err,', ');?>.
	                        </div>
                        <?php } ?>

                        <?php if($email_err !='')
                        {?>
	                        <div class="alert" style="width:464px;">
	                          <strong>Primary Email ID Issue!</strong> On these rows <?php echo trim($email_err,', ');?>.
	                        </div>
                        <?php } ?>

                        <?php if($prd_err !='')
                        {?>
	                        <div class="alert" style="width:464px;">
	                          <strong>Product Issue!</strong> On these rows <?php echo trim($prd_err,', ');?>.
	                        </div>
                        <?php } ?>

                        <?php if($l_source_err !='')
                        {?>
	                        <div class="alert" style="width:464px;">
	                          <strong>Lead Source Issue!</strong> On these rows <?php echo trim($l_source_err,', ');?>.
	                        </div>
                        <?php } ?>

                        <?php if($l_type_err !='')
                        {?>
	                        <div class="alert" style="width:464px;">
	                          <strong>Lead Type Issue!</strong> On these rows <?php echo trim($l_type_err,', ');?>.
	                        </div>
                        <?php } ?>

                        <?php if($l_status_err !='')
                        {?>
	                        <div class="alert" style="width:464px;">
	                          <strong>Lead Status Issue!</strong> On these rows <?php echo trim($l_status_err,', ');?>.
	                        </div>
                        <?php } ?>

                         <?php if($l_assign_err !='')
                        {?>
	                        <div class="alert" style="width:464px;">
	                          <strong>Assigned User Issue!</strong> On these rows <?php echo trim($l_assign_err,', ');?>.
	                        </div>
                        <?php } ?>

                         <?php if($emptrow !=''){?>
	                        <div class="alert" style="width:464px;">
	                          <strong>Empty Row Issue!</strong> On these rows <?php echo trim($emptrow,',');?>.
	                        </div>
                        <?php } ?>

                         <?php //if($errmsg !=''){?>
		                      <!-- <div class="alert" style="width:464px;">
		                        <strong>Issue!</strong> On these rows <?php //echo trim($errmsg,',');?>.
		                      </div> -->
                        <?php //} ?>
                        <?php //if($row_err !=''){?>
		                      <!-- <div class="alert" style="width:464px;">
		                        <strong>Mandatory Value Issue!</strong> On these rows <?php //echo trim($row_err,',');?>.
		                      </div> -->
                        <?php //} ?>
              <?php }else{ ?>
                      <h2>Alert Messages</h2>
                      <div class="alert success" style="width:464px;">
                        <strong>Success!</strong> Indicates a successful Inserted Records
                      </div>
              <?php } ?>

          		</div></body></center></body></html>
	    <?php }else{ 

	    	$this->session->set_flashdata('l_err', 'Invalid Column Header File.');
      		redirect('new_leads?active_tab=1');
	    }
	}
    else
    {
      $this->session->set_flashdata('add_err', 'Invalid File.');
      redirect('new_leads?active_tab=1');
    }
  }
  // To Show email thread list
  public function show_email_thread()
  {
  	$parent_id = $this->input->post('parent_id');
  	$data['subject'] = $this->input->post('subject');
  	$data['lead_id'] = $this->input->post('lead_id');
  	$data['email_thread_lists'] = $this->Lead_model->show_email_thread($parent_id);
  	$this->load->view('inbox/email_thread_list', $data);
  }

  public function lead_compose_mail()
  {
    $data['info_email'] = $this->input->post('off_chosen_mail');
    $lead_id = $this->input->post('lead_id');
    $get_lead_by_id = $this->Lead_model->lead_by_id($lead_id);
    $data['compose_mail_from_lead_or_mail'] = '1';
    $data['lead_email'] = $get_lead_by_id->email_id;
    $data['lead_a_email'] = $get_lead_by_id->alternative_email_id;
    $data['lead_id'] = $this->input->post('lead_id');
    $email_details = $this->Lead_model->email_by_name($data['info_email']);
    $data['info_email_name'] = $email_details->email_ID; 
    // echo 'inblock'.$data['info_email_name'];
    // die();
    $this->load->view('mailbox/create_mail',$data);   
  }
  // public function send_reply_forward_compose_mail()
  // {
  //     $data = $_POST;
  //     $data['attachs'] = $_FILES;

  //     $email_details = $this->Lead_model->email_by_name($data['lead_email_reply']);
  //     // // To get info email details
  //     // $email_id = $email_details->email_ID; 
  //     // $password =  decryptthis($email_details->password, 'Rajexim2020');
  //     //   /* connect to gmail */
  //     // $hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}[Gmail]/Sent Mail';
  //     //   //$hostname = '{crm.geewinmatches.net:465/imap/ssl/novalidate-cert}[crm.geewinmatches.net]/Sent Mail';
  //     //   $username = $email_id;
  //     //   $password = $password;
  //     //   /* try to connect */
  //     //   $conn = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
        
  //       // To get info email details
  //     $email_id = $email_details->email_ID; 
  //     $password =  decryptthis($email_details->password, 'Rajexim2020');
  //     $smtp_name = $email_details->smtp_host;
  //       /* connect to gmail */
  //     $hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}[Gmail]/Sent Mail';
  //       //$hostname = '{crm.geewinmatches.net:465/imap/ssl/novalidate-cert}[crm.geewinmatches.net]/Sent Mail';
  //       $username = $email_id;
  //       $password = $password;
  //       /* try to connect */
  //       $conn = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
  //       $attach_file = '';

  //       if(!empty($_FILES['reply_attach_email']['name']))
  //     	{
  //     		if (!is_dir('assets/attachment_files/')) 
  //     		{
  //   		    mkdir('./assets/attachment_files/', 0777, TRUE);
  //   		}
    		
  //   		$ext = pathinfo($_FILES['reply_attach_email']['name'], PATHINFO_EXTENSION);
  //   		$config['upload_path'] = 'assets/attachment_files/';
  //   		$config['allowed_types'] = '*';
  //   		$config['file_name'] = $_FILES['reply_attach_email']['name'];
  //   		$this->load->library('upload',$config);
  //   		$this->upload->initialize($config);
  //   		$attach_file = 'assets/attachment_files/'.$_FILES['reply_attach_email']['name'];
  //     		if($this->upload->do_upload('reply_attach_email'))
  //     		{
  //     			$uploadData = $this->upload->data();
  //     		}
  //     	}	
      
  //     		// To get smtp details
  //     	    $smtp_detaiils = smtp_details();
  //     		//$mcRes = $this->Offermail_model->get_general_settings_details();
  //           $smtp_pwd = decryptthis($smtp_detaiils->smtp_password, 'Rajexim2020'); 
  //           $config = Array( 
  //           'protocol' => 'smtp',
  //           'smtp_host' => $smtp_detaiils->smtp_host_name,
  //           'smtp_user' => $smtp_detaiils->smtp_user_name, 
  //           'smtp_pass' => $smtp_pwd,
  //           'smtp_port' => 465,
  //           'mailtype'  => 'html', 
  //           'charset'   => 'utf-8',
  //           'newline'  => "\r\n",
  //           'wordwrap' => TRUE,
  //           );

  //            $this->load->library('email',$config);
  //                   $this->email->from($email_id);    
  //                   $this->email->to($data['reply_to_email']);
  //                   $this->email->cc($data['reply_to_cc_email']);
  //                   $this->email->subject($data['reply_sub_email']);
  //                   $this->email->message(strip_tags($data['reply_content_email']));
  //                   $this->email->set_mailtype('html');
  //                   $this->email->attach($attach_file);
         			           
  //             if($this->email->send())
  //             {
  //             	$c_by = $_SESSION['admindata']['user_id'];
  //             	$c_on = date('Y-m-d H:i:s');
  //             	$add_lead_reply_to_db = $this->Lead_model->add_lead_reply_to_db($data['reply_to_lead_id'],$email_id,$data['reply_to_email'],$data['reply_to_cc_email'],$data['reply_sub_email'],$data['reply_content_email'],$c_by,$c_on);
  //     		     	$this->session->set_flashdata('mail_reply_sent', 'Mail Reply sent Successfully');
  //         		    //unlink file
  //                   unlink($attach_file);

  //              $result =1;
  //             }else{ }
    	
  //            redirect('Leads/lead_view/'.$data['reply_to_lead_id']);
  // }
  public function send_reply_forward_compose_mail()
  {				
  	// echo date('Y-m-d', strtotime('+3 days'));
  	// die();
  	// print_r($_POST);
  	// die();
      $data = $_POST;
      //print_r($data);//exit;
      $data['attachs'] = $_FILES;
      $email_details = $this->Lead_model->email_by_name($data['lead_email_reply']);
      $raw_removed_files_name = $data['removed_reply_attachment_name'];

      if ($raw_removed_files_name != '') {
        $removed_files_name = explode(',', $raw_removed_files_name);
      }
      else {
        $removed_files_name = array(); 
      }
      // // To get info email details
      $email_id = $email_details->email_ID; 
      $password =  decryptthis($email_details->password, 'Rajexim2020');
      $cc_mail_ids = $email_details->cc;
      $bcc_mail_ids = $email_details->bcc;
      $get_cc_email_name = $this->Setting_model->get_email_names_by_findinset($cc_mail_ids);
      $get_bcc_email_name = $this->Setting_model->get_email_names_by_findinset($bcc_mail_ids);
      $email_id_name = $email_details->from_name;
        $attach_file = '';
        $attachment_files_path = array();
    

        	$abspath = getcwd();
        	$filePondArray = $_POST['reply_attach_email'];
        	$numFilePondObjects = sizeof($filePondArray);
        	if($numFilePondObjects > 0)
    		{
    			if (!is_dir('assets/attachment_files/')) 
      			{
    		    	mkdir('./assets/attachment_files/', 0777, TRUE);
    		  	}
    		  	$user_temp_folder = $_SESSION['admindata']['user_id'].date('m').date('d').date('H').date('i').date('s');
	          	mkdir('./assets/attachment_files/'.$user_temp_folder, 0777, TRUE);
	          	$baseFileLocation = './assets/attachment_files/'.$user_temp_folder.'/';
    			for ($xx=0; $xx<$numFilePondObjects; $xx++)
				{
					$thisFilePondJSON_object = $filePondArray[$xx];
					$thisFilePondArray = json_decode($thisFilePondJSON_object, true);
					$thisFilePondArray_picData = $thisFilePondArray['data'];
					$thisFilePondArray_numPics = sizeof($thisFilePondArray_picData);
					
					$thisPic_name_temp = $thisFilePondArray['name'];
					$thisPic_encodedData = $thisFilePondArray_picData;
					$thisPic_decodedData = base64_decode($thisPic_encodedData);
					$thisPic_fullPathAndName = $baseFileLocation . $thisPic_name_temp; 
					file_put_contents($abspath.$thisPic_fullPathAndName, $thisPic_decodedData);
					$attachment_files_path[] = "assets/attachment_files/".$user_temp_folder.'/'.$thisFilePondArray['name'];
				}
    		}
      		 if ($cc_mail_ids != '') {
      		 	$ccemail = $data['reply_to_cc_email'].','.$get_cc_email_name->mail_name;	
      		 }	
      		 else{
              	$ccemail = $data['reply_to_cc_email'];
             }
             if (trim($ccemail) == '') {
             	$ccmailarray = array();	
             }
             else {
             	$ccmailarray = explode(',', $ccemail);	
             }
              
             if ($bcc_mail_ids != '') {
      		 	$bccemail = $data['reply_to_bcc_email'].','.$get_bcc_email_name->mail_name;	
      		 }	
      		 else{
              	$bccemail = $data['reply_to_bcc_email'];
             }
             if($data['need_message_for_reply'] == '1')
             {
             	$lead_view = $this->Lead_model->lead_by_id($data['reply_to_lead_id']);
             	$content = $data['reply_content_email'];
             	// $content .= '<br>';
              //   $content .= '<br>';
              //   $content .= $email_details->signature;
                $content .= '<br>';
                $content .= '<br>';
             	$content .= $lead_view->message;
             	
                
             }
             else {
             	$content = $data['reply_content_email'];
                // $content .= '<br>';
                // $content .= '<br>';
                // $content .= $email_details->signature;
             }
              
              $html_content = htmlentities($content);
             if (trim($bccemail) == '') {
             	$bccmailarray = array();	
             }
             else {
             	$bccmailarray = explode(',', $bccemail);
             }
              $to_emails = $data['reply_to_email'];
        	  $tomailarray = explode(',', $to_emails);
              $send_email = send_email_common_method($email_id,$password,$tomailarray,$data['reply_sub_email'],$content,$attachment_files_path,$ccmailarray,$bccmailarray,$email_id_name);
           	  
   			  // echo $send_email;
   			  // die();
				if($send_email == 1) {
					$c_by = $_SESSION['admindata']['user_id'];
					$c_on = date('Y-m-d H:i:s');
					$qutoe_rmved_message = str_replace("'", "`", $data['reply_content_email']); 
					$add_lead_reply_to_db = $this->Lead_model->add_lead_reply_to_db($data['reply_to_lead_id'],$email_id,$data['reply_to_email'],$data['reply_to_cc_email'],$data['reply_sub_email'],$qutoe_rmved_message,$c_by,$c_on);
				     	
					    //unlink file
					$get_lead_by_id = $this->Lead_model->lead_by_id($data['reply_mail_lead_id']);
					
				    $follow_up['assigned_to'] = $get_lead_by_id->lead_assigned_to;
			  		$follow_up['followup_date'] = date('Y-m-d', strtotime('+3 days'));
			  		$follow_up['followup_time'] = '10:30 AM';
			  		$follow_up['followup_purpose_next'] = str_replace("'", "`", $content);
			  		$follow_up['lead_id'] = $data['reply_mail_lead_id'];
		     	    $follow_up['created_by'] = $_SESSION['admindata']['user_id'];
		     	    $follow_up['created_on'] = date('Y-m-d H:i:s');;
			  		$follow_addUp_res = $this->Lead_model->followup_add($follow_up);
			  		$get_lfup_ai_id = $this->Lead_model->lead_followup_next_auto_id();
			  		$lfup_id = $get_lfup_ai_id->AUTO_INCREMENT;

			  		$data_n['notification_type_id'] = "2";
			  		$data_n['lead_id'] = $data['reply_mail_lead_id'];
					$data_n['lead_followup_id'] = $lfup_id;
					$data_n['notification_allow_to'] = $get_lead_by_id->lead_assigned_to;
					$data_n['created_by'] = $_SESSION['admindata']['user_id'];
					$data_n['created_on'] = date('Y-m-d H:i:s');
					$save_notification = $this->Lead_model->add_lead_notification_save($data_n);

				    if (!empty($attachment_files_path)) {
				      for ($i=0; $i < count($attachment_files_path); $i++) { 
				        unlink($attachment_files_path[$i]);  
				      }
				    }
				    rmdir($baseFileLocation);
				    $this->session->set_flashdata('mail_reply_sent_success', 'Mail Reply sent Successfully');
				}
				else {
					$this->session->set_flashdata('mail_reply_sent', 'Mail Reply Fail to sent');
				}
			  	$_SESSION['active_panel'] = "lead_info";	
             	redirect('Leads/lead_view/'.$data['reply_to_lead_id']);
  }

  public function sub_lead_source_list()
  {
	$data['lead_sources'] = $this->Lead_model->lead_source_list();
	$data['sub_lead_sources'] = $this->Lead_model->sub_lead_source_list();
	$this->load->view('lead/sub_lead_source_list', $data);
  }
  public function sub_lead_source_unique()
  {
  	$sls_name = $this->input->post('s_l_s_name');
  	$ls = $this->input->post('l_s_name');
  	$chk_unique_sls_name = $this->Lead_model->chk_unique_sls_name($sls_name,$ls);
  	
  	if (count($chk_unique_sls_name) > 0) {
  		echo '1';
  	}
  	else {
  		echo '0';
  	}
  }
  public function sub_lead_source_add()
  {
  	$l_s = $this->input->post('lead_source');
  	$s_l_s = $this->input->post('sub_lead_source_name');
  	$c_by = $_SESSION['admindata']['user_id'];
  	$c_on = date('Y-m-d H:i:s');
  	$add_sub_lead_source = $this->Lead_model->add_sub_lead_source($l_s,$s_l_s,$c_by,$c_on);
  	if ($add_sub_lead_source == 1) {
  		$this->session->set_flashdata('l_t_success','Sub Lead Source Added Successfully');
  		redirect('Leads/sub_lead_source_list');
  	}
  	else {
  		$this->session->set_flashdata('l_t_err','Fail to Add Sub Lead Source');
  		redirect('Leads/sub_lead_source_list');	
  	}
  }
  public function sub_lead_source_change_status()
  {
  	$l_t_id = $this->input->post('id');
	$status = $this->input->post('status');

	$result = $this->Lead_model->sub_lead_sorce_status($l_t_id, $status);
	if($result){ echo 1; }else{ echo 0; }
  }
  public function sub_lead_source_edit()
  {
  	$data['lead_sources'] = $this->Lead_model->lead_source_list();
  	$sls_id = $this->input->post('value');
	$data['get_sls_by_id'] = $this->Lead_model->get_sls_by_id($sls_id);
	$this->load->view('lead/edit_sub_lead_source_list',$data);
  }
  public function sub_lead_source_update()
  {
  	$sls_id = $this->input->post('sls_id');
  	$l_s = $this->input->post('e_lead_source');
  	$s_l_s = $this->input->post('e_sub_lead_source_name');
  	$m_by = $_SESSION['admindata']['user_id'];
  	$m_on = date('Y-m-d H:i:s');
  	$update_sls_info = $this->Lead_model->update_sls_info($sls_id,$l_s,$s_l_s,$m_by,$m_on);
  	if ($update_sls_info == 1) {
  		$this->session->set_flashdata('l_t_success','Sub Lead Source Updated Successfully');
  		redirect('Leads/sub_lead_source_list');
  	}
  	else {
  		$this->session->set_flashdata('l_t_err','Fail to Update Sub Lead Source');
  		redirect('Leads/sub_lead_source_list');	
  	}
  }
  public function sub_lead_source_delete()
  {
  	$sls_id = $this->input->post('delete_sub_lead_source_id');
  	$delete_sls = $this->Lead_model->delete_sub($sls_id);
  	if ($delete_sls == 1) {
  		$this->session->set_flashdata('l_t_success','Sub Lead Source Deleted Successfully');
  		redirect('Leads/sub_lead_source_list');
  	}
  	else {
  		$this->session->set_flashdata('l_t_err','Fail to Delete Sub Lead Source');
  		redirect('Leads/sub_lead_source_list');	
  	}
  }
  public function lead_info_export_pdf($id)
  {
  	$lead_view = $this->Lead_model->lead_by_id($id);
  	
  	$get_all_mail_replies = $this->Lead_model->get_all_mail_replies($id);
  	
  	$html = '<!DOCTYPE html>
  	<html>
  	<head>
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  		<title>Lead Info PDF</title>
  	</head>
  	<body>
  		<div class = "container">
  			<div class="tab-pane active" id="lead_info" role="tabpanel">
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5 class="text-theme" style = "font-size : 16px; font-weight : bold;">Lead Info </h5><hr>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Lead Name</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'
                                                     .$lead_view->lead_name.
                                                  '</p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Company Name</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->company_name.'</p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Country</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->country_name.'</p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Designation</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->designation.'</p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Website</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->website.'</p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Address</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->address.'</p>
                                                   </div>
                                                </div>
                                                      

                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5 class="text-theme" style = "font-size : 16px; font-weight : bold;">Lead Contact Info</h5><hr>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Primary Email ID</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->email_id.'</p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Alternate Email ID</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->alternative_email_id.'</p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Skype ID</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->skype_id.'</p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Contact No</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->contact_no.'</p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Whatsapp No</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->whatsapp_no.'</p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Office Contact No</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->office_phone_no.'</p>
                                                   </div>
                                                </div>
                                                      

                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5 class="text-theme" style = "font-size : 16px; font-weight : bold;">Lead Source Info</h5><hr>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Lead Source</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->lead_source_name.' | '.$lead_view->sub_lead_source_name.'</p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Priority</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->l_type.'</p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Lead Status</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->lead_status_name.'</p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Assigned To</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->lead_assigned_name.'</p>
                                                   </div>
                                                </div>
                                                      

                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5 class="text-theme" style = "font-size : 16px; font-weight : bold;">Interested Product Info</h5><hr>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Product</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->product_name.'</p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Industry</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7">'.$lead_view->industry_name.'</p>
                                                   </div>
                                                </div>
                                                      

                                             </div>
                                          </div>

                                          <div class="row">
                                          
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <label class="col-lg-4">Message</label>
                                                      <label class="col-lg-1">'.$lead_view->message.'</label>
                                                   </div>
                                                   
                                                </div>
                                                      

                                             </div>
                                          </div>';

                                    
                                          if (!empty($get_all_mail_replies)) { 
                                             foreach ($get_all_mail_replies as $mail_reply) {
                                          
                                          $html .= '<div class="row">
                                          
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="panel col-md-12" style="margin-top: 25px;">
                                                      <div class="panel-body">
                                                          <div class="mar-btm pad-btm bord-btm">
                                                              <h1 class="page-header text-overflow">
                                                                  '.$mail_reply->mail_subject.' 
                                                              </h1>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-sm-7">

                                                                  <div class="media">
                                                                    <span class="media-left">
                                                                        <img src="assets/images/avatar.png" class="img-circle img-sm" alt="Profile Picture">
                                                                    </span>
                                                                    <div class="media-body">
                                                                        <div class="text-bold">'.$mail_reply->lead_name.' < <a href="javascript:;">'.$mail_reply->send_to.'</a> ></div>
                                                                        <div class="btn-group" style="position: unset;display: none;" >
                                                                        <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                                                                            to me <i class="dropdown-caret"></i>
                                                                        </button>
                                                                        
                                                                    </div>
                                                                    </div>
                                                                </div>

                                                              </div>
                                                              <hr class="hr-sm visible-xs">
                                                              <div class="col-sm-5 clearfix">
                                         
                                                                  <div class="pull-right text-right">
                                                                      <p class="mar-no"><small class="text-muted">'.date('d M Y, H:s', strtotime($mail_reply->created_on)).'</small></p>
                                                                      <a href="#">
                                                                          <strong>

                                                                              </strong>
                                                                          
                                                                      </a>
                                                                  </div>
                                                              </div>
                                                          </div>
                                          
                                                          
                                                          <div class="pad-ver bord-ver">
                                                             '.$mail_reply->mail_content.'
                                                          </div>
                                                       
                                                      </div>
                                                  </div>
                                                </div>
                                                      
                                             </div>
                                          </div>';
                                           } } 
                                      
                                          
                                      $html .= '</div>
                                      		<div>
                                      		</body>
  										</html>';
                                $file_pi_no = 'Lead_info_'.$id;
							    //$html = preg_replace('/>\s+</', "><", $html);
							    $dompdf = new DOMPDF();
							    $dompdf->load_html($html);
							    $dompdf->set_paper('A4','portrait');
							    $dompdf->render();
							    $dompdf->stream($file_pi_no.".pdf", array("Attachment"=>true)); 

							    redirect('Leads/lead_view/'.$id);  

  }
  public function chk_lead_email_is_blocked()
  {
  	$value = $this->input->post('value');
  	$split_value = explode('@',$value);
  	$domain_name = $split_value[1];

  	$chk_domain_is_blocked = $this->Lead_model->chk_domain_is_blocked($domain_name);

  	if (count($chk_domain_is_blocked) > 0) {
  		echo '1';
  	}
  	else 
  	{
  		$chk_email_is_blocked = $this->Lead_model->chk_email_is_blocked($value);
  		if (count($chk_email_is_blocked) > 0) {
  			echo "1";
  		}
  		else {
  			echo "0";
  		}
  	}
  }
  public function update_lead_mails_import()
  {
  	$l_id = $this->input->post('imp_lead_id');
  	$flag = $this->input->post('imp_flag');

  	$update_import_mails_from_imap_flag = $this->Lead_model->update_import_mails_from_imap_flag($l_id,$flag);
  	if ($update_import_mails_from_imap_flag == 1) {
  		$this->session->set_flashdata('l_success','Import Leads Emails Flag Changed Successfully . .');
  		redirect('Leads');
  	}
	else {
  		$this->session->set_flashdata('l_success','Import Leads Emails Fail to Change Flag ');
  		redirect('Leads');
  	}
  }
  public function get_email_signature_by_email_id()
  {
  	$email_id = $this->input->post('email_id');
  	$get_email_info = $this->Lead_model->email_by_name($email_id);
  	$signature = $get_email_info->signature;
  	echo $signature;
  }
  public function export_lead_info()
  {
  	$objPHPExcel = new PHPExcel();
    $activeSheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000')
            )/*,
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )*/
        );
    
    $year = $this->input->post('exp_lead_filt_month_val');
    $country = $this->input->post('exp_lead_filt_country_val');
    $product = $this->input->post('exp_lead_filt_product_val');
    $type = $this->input->post('exp_lead_filt_priority_val');
    $ls = $this->input->post('exp_lead_filt_ls_val');
    $lst = $this->input->post('exp_lead_filt_lst_val');
    $ass_to = $this->input->post('exp_lead_filt_ass_to_val');
    $dtrange = $this->input->post('exp_lead_filt_dtrng_val');

    if($this->input->post('exp_lead_filt_month_val'))
	{
		$l_year = explode('-', $this->input->post('exp_lead_filt_month_val'));
		$data['p_month'] = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
		$data['p_year']  = ($l_year[0]) ? $l_year[0] : date('Y');
	}
	else{
		$data['p_month'] =  date('m');
		$data['p_year']  = date('Y');
	}

    $lead_exp = $this->input->post('lead_export');
    $get_all_leads = $this->Lead_model->get_all_leads($lst , $ls, $dtrange, $lst, $data['p_year'], $data['p_month'], $product, $country, $ass_to);
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    for ($i=0; $i < count($lead_exp); $i++) { 
	    $objPHPExcel->getActiveSheet()->setCellValue($alpha[$i]."1", $lead_exp[$i]);
	    $objPHPExcel->getActiveSheet()->getStyle($alpha[$i].'1')->applyFromArray($styleArray);
	    $j=2;
	    foreach ($get_all_leads as $key => $lead_info) {
	    	if ($lead_exp[$i] == 'Lead Name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_name']);
	    	}
	    	elseif ($lead_exp[$i] == 'Country') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['country_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Company Name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['company_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Designation') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['designation']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Website') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['website']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Address') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['address']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Email ID') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['email_id']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Alter Email ID') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['alternative_email_id']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Skype ID') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['skype_id']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Contact No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['contact_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Whatsapp No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['whatsapp_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Office No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['office_phone_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Message') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['message']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Lead Source') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_source_name'].'-'.$lead_info['sub_lead_source_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'lead Taken By') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_taken_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Lead Assigned To') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_assigned_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Lead Status') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_status_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Lead Type') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['l_type']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Product') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['product_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Industry') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['industry_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Created On') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['created_on']);	
	    	}
	    	$j++;
	    }
	}
    
    // $objWorkSheet->setTitle("Lead Information");
    $filename='lead_info_'.date('Y-m-d_H-i-s').'.xlsx'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objPHPExcel->setActiveSheetIndex(0);

    if (ob_get_contents()) ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
  }
  public function export_oppo_info()
  {
  	$objPHPExcel = new PHPExcel();
    $activeSheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000')
            )/*,
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )*/
        );
    $year = $this->input->post('exp_lead_filt_month_val');
    $country = $this->input->post('exp_lead_filt_country_val');
    $product = $this->input->post('exp_lead_filt_product_val');
    $type = $this->input->post('exp_lead_filt_priority_val');
    $ls = $this->input->post('exp_lead_filt_ls_val');
    $lst = $this->input->post('exp_lead_filt_lst_val');
    $ass_to = $this->input->post('exp_lead_filt_ass_to_val');
    $dtrange = $this->input->post('exp_lead_filt_dtrng_val');

    if($this->input->post('exp_lead_filt_month_val'))
	{
		$l_year = explode('-', $this->input->post('exp_lead_filt_month_val'));
		$data['p_month'] = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
		$data['p_year']  = ($l_year[0]) ? $l_year[0] : date('Y');
	}
	else{
		$data['p_month'] =  date('m');
		$data['p_year']  = date('Y');
	}

    $lead_exp = $this->input->post('oppo_export');
    $get_all_leads = $this->Lead_model->get_all_oppo($lst , $ls, $dtrange, $lst, $data['p_year'], $data['p_month'], $product, $country, $ass_to);
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    for ($i=0; $i < count($lead_exp); $i++) { 
	    $objPHPExcel->getActiveSheet()->setCellValue($alpha[$i]."1", $lead_exp[$i]);
	    $objPHPExcel->getActiveSheet()->getStyle($alpha[$i].'1')->applyFromArray($styleArray);
	    $j=2;
	    foreach ($get_all_leads as $key => $lead_info) {
	    	if ($lead_exp[$i] == 'Lead Name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_name']);
	    	}
	    	elseif ($lead_exp[$i] == 'Country') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['country_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Company Name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['company_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Designation') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['designation']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Website') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['website']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Address') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['address']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Email ID') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['email_id']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Alter Email ID') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['alternative_email_id']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Skype ID') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['skype_id']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Contact No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['contact_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Whatsapp No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['whatsapp_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Office No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['office_phone_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Message') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['message']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Lead Source') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_source_name'].'-'.$lead_info['sub_lead_source_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'lead Taken By') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_taken_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Lead Assigned To') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_assigned_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Lead Status') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_status_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Lead Type') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['l_type']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Product') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['product_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Industry') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['industry_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Created On') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['created_on']);	
	    	}
	    	$j++;
	    }
	}
    
    // $objWorkSheet->setTitle("Lead Information");
    $filename='opportunity_info_'.date('Y-m-d_H-i-s').'.xlsx'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objPHPExcel->setActiveSheetIndex(0);

    if (ob_get_contents()) ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 	
  }
  public function export_quote_info()
  {
  	$user_id = $this->input->post('exp_quote_filt_user_val');
  	$quote_stage_id = $this->input->post('exp_quote_filt_stage_val');
  	$country_id = $this->input->post('exp_quote_country_val');
  	if ($user_id != '') {
  		$user_filt = " AND l.lead_assigned_to = '$user_id'";
  	}
  	else {
  		$user_filt = ""; 		
  	}

  	if ($quote_stage_id != '') {
  		$qs_filt = " AND q.quote_stage_id = '$quote_stage_id'";
  	}
  	else {
  		$qs_filt = ""; 		
  	}

  	if ($country_id != '') {
  		$cid = " AND cb.country = '$country_id'";
  	}
  	else {
  		$cid = ""; 		
  	}

	$objPHPExcel = new PHPExcel();
    $activeSheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000')
            ));
    	
    		$fbase = $this->input->post('quarter_or_range');

    		if($fbase == '')
    		{
    			$quarter_filt = '';
    							
    		}
    		else if($fbase == 'BonQuarter')
    		{
    			$fqtr = $this->input->post('exp_quote_filt_quarter_val');
    			$yrange = $this->input->post('exp_quote_filt_year_val');

    			if($fqtr == '') 
    			{
    				$yr = explode('-', $yrange);

					$fdate = $yr[0].'-04-01';
					$tdate = $yr[1].'-03-31';
    				$quarter_filt =  "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
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
    				$quarter_filt =  "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    			}
    			//else if()
    		}
    		else
    		{
				$schange = $this->input->post('exp_quote_filt_search_val');
				//echo $schange;
				$dtrange = $this->input->post('exp_quote_filt_dtrng_val');

	        	if($schange == '')
				{
					$quarter_filt = '';
				}
				elseif($schange == 'today')
				{
					$quarter_filt = "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') = CURDATE()";
				}
				else if($schange == 'thisweek')
				{
					$quarter_filt = "AND YEARWEEK(STR_TO_DATE(q.valid_till, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
				}      
				else if($schange == 'thismonth')
				{
					$quarter_filt = "AND MONTH(STR_TO_DATE(q.valid_till, '%Y-%m-%d')) = MONTH(CURDATE())";
					
				}			
				else if($schange == 'thisyear')
				{
					$finstart = $_SESSION['finstart'];
					$finend = $_SESSION['finend'];
					$quarter_filt = "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
				}
				else
				{
					$dr = explode(' - ', $dtrange);

					$fd = explode('/', $dr[0]);
					$td = explode('/', $dr[1]);

					$fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
					$tdate = $td[2].'-'.$td[1].'-'.$td[0];
					$quarter_filt = "AND STR_TO_DATE(q.valid_till, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.valid_till, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
				}
    			//$data['ypick'] = '';
			}
    	
    	
    $lead_exp = $this->input->post('quote_export');
    $get_all_leads = $this->Lead_model->get_all_quotes_for_expo($quarter_filt,$user_filt,$qs_filt,$cid);
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    for ($i=0; $i < count($lead_exp); $i++) { 
	    $objPHPExcel->getActiveSheet()->setCellValue($alpha[$i]."1", $lead_exp[$i]);
	    $objPHPExcel->getActiveSheet()->getStyle($alpha[$i].'1')->applyFromArray($styleArray);
	    $j=2;
	    foreach ($get_all_leads as $key => $lead_info) {
	    	if ($lead_exp[$i] == 'Lead Name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_name']);
	    	}
	    	elseif ($lead_exp[$i] == 'Quote No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['quote_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Exporter') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['exporter_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Subject') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['subject']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Created Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['created_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Valid Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['valid_till']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Quote Stage') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['quote_stage']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Price Validity') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['price_validity']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Vessel flight') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['vessel_flight_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'From Port') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['fpname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'To Port') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['tpname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Price Term') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['price_term_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Currency') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['currency_name'].' ('.$lead_info['currency_code'].')');	
	    	}
	    	elseif ($lead_exp[$i] == 'Rate') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['rate']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Grand Total') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['grand_total']);	
	    	}
	    	$j++;
	    }
	}
    
    // $objWorkSheet->setTitle("Lead Information");
    $filename='Quote_info_'.date('Y-m-d_H-i-s').'.xlsx'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objPHPExcel->setActiveSheetIndex(0);

    if (ob_get_contents()) ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
  }
  public function export_pi_info()
  {
  	echo "<pre>";
  	print_r($_POST);
  	
  	$user_id = $this->input->post('exp_pi_filt_user_val');
  	$country_id = $this->input->post('exp_pi_filt_country_val');
  	if ($user_id != '') {
  		$user_filt = " AND l.lead_assigned_to = '$user_id'";
  	}
  	else {
  		$user_filt = ""; 		
  	}

  	if ($country_id != '') {
  		$country_filt = " AND cb.country = '$country_id'";
  	}
  	else {
  		$country_filt = ""; 		
  	}

	$objPHPExcel = new PHPExcel();
    $activeSheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000')
            )/*,
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )*/
        );

    $fbase = $this->input->post('quarter_or_range');

	if($fbase == '')
	{
		$quarter_filt = '';
						
	}
	else if($fbase == 'BonQuarter')
	{
		$fqtr = $this->input->post('exp_pi_filt_quarter_val');
		$yrange = $this->input->post('exp_pi_filt_year_val');

		if($fqtr == '') 
		{
			$yr = explode('-', $yrange);

			$fdate = $yr[0].'-04-01';
			$tdate = $yr[1].'-03-31';
			$quarter_filt =  "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
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
			$quarter_filt =  "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//else if()
	}
	else
	{
		$schange = $this->input->post('exp_pi_filt_search_val');
		//echo $schange;
		$dtrange = $this->input->post('exp_pi_filt_dtrng_val');

    	if($schange == '')
		{
			$quarter_filt = '';
		}
		elseif($schange == 'today')
		{
			$quarter_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') = CURDATE()";
		}
		else if($schange == 'thisweek')
		{
			$quarter_filt = "AND YEARWEEK(STR_TO_DATE(pi.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
		}      
		else if($schange == 'thismonth')
		{
			$quarter_filt = "AND MONTH(STR_TO_DATE(pi.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
			
		}			
		else if($schange == 'thisyear')
		{
			$finstart = $_SESSION['finstart'];
			$finend = $_SESSION['finend'];
			$quarter_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
		}
		else
		{
			$dr = explode(' - ', $dtrange);

			$fd = explode('/', $dr[0]);
			$td = explode('/', $dr[1]);

			$fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
			$tdate = $td[2].'-'.$td[1].'-'.$td[0];
			$quarter_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//$data['ypick'] = '';
	}

    $lead_exp = $this->input->post('pi_export');

    $get_all_leads = $this->Lead_model->get_all_pi_for_expo($quarter_filt,$user_filt,$country_filt);
    
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    for ($i=0; $i < count($lead_exp); $i++) { 
	    $objPHPExcel->getActiveSheet()->setCellValue($alpha[$i]."1", $lead_exp[$i]);
	    $objPHPExcel->getActiveSheet()->getStyle($alpha[$i].'1')->applyFromArray($styleArray);
	    $j=2;
	    foreach ($get_all_leads as $key => $lead_info) {
	    	if ($lead_exp[$i] == 'Lead Name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_name']);
	    	}
	    	elseif ($lead_exp[$i] == 'Proforma Invoice No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['proforma_invoice_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Exporter') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['exporter_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Subject') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['subject']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Created Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['proforma_invoice_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Buyer Confirmation Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['buyer_confirmation_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'PI Stage') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['pi_stage']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Other Reference') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['other_reference']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Terms Of Payment Type') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, column_name_by_id('terms_of_payment_type', 'terms_of_payment_type_id', $lead_info['terms_of_payment_type_id'], 'terms_of_payment_type'));	
	    	}
	    	elseif ($lead_exp[$i] == 'Pre Carriage By') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['pre_carriage_by']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Place Of Reciept By Pre Carrier') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['place_of_receipt_by_pre_carrier']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Vessel Flight') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['vessel_flight_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Port Of Loading') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['polname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Port Of Discharge') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['podname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Final Destination') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['fdname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Currency') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['currency_name'].' ('.$lead_info['currency_code'].')');	
	    	}
	    	elseif ($lead_exp[$i] == 'Rate') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['rate']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Bank Info') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j,strip_tags(column_name_by_id('bank_detail', 'bank_detail_id', $lead_info['bank_detail_id'], 'bank_detail')));	
	    	}
	    	elseif ($lead_exp[$i] == 'Sales Note') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['sales_note']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Purchase Note') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['purchase_note']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Shipping Note') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['shipping_note']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Account Note') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['accounts_note']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Specification Packing Details') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['specification_packing_details']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Price Validity') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['price_validity']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Interest') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, column_name_by_id('interest', 'interest_id', $lead_info['interest_id'], 'interest_label'));	
	    	}
	    	elseif ($lead_exp[$i] == 'Loadability') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['loadability']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Terms And Payment') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, column_name_by_id('terms_and_payment', 'terms_and_payment_id', $lead_info['terms_and_payment_id'], 'terms_and_payment'));	
	    	}
	    	elseif ($lead_exp[$i] == 'Terms Of Payment') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, column_name_by_id('terms_of_payment', 'terms_of_payment_id', $lead_info['terms_of_payment_id'], 'terms_of_payment_name'));	
	    	}
	    	elseif ($lead_exp[$i] == 'Arbitration') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j,column_name_by_id('arbitration', 'arbitration_id', $lead_info['arbitration_id'], 'arbitration_label'));	
	    	}
	    	elseif ($lead_exp[$i] == 'Declaration') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, column_name_by_id('declaration', 'declaration_id', $lead_info['declaration_id'], 'declaration_label'));	
	    	}
	    	elseif ($lead_exp[$i] == 'Grand Total') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['grand_total']);	
	    	}
	    	$j++;
	    }
	}
    
    // $objWorkSheet->setTitle("Lead Information");
    $filename='Proforma_invoice_info_'.date('Y-m-d_H-i-s').'.xlsx'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objPHPExcel->setActiveSheetIndex(0);

    if (ob_get_contents()) ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
  }
  public function export_inv_info()
  {	
  	$country_id = $this->input->post('exp_inv_filt_country_val');
  	

  	if ($country_id != '') {
  		$country_filt = " AND cb.country = '$country_id'";
  	}
  	else {
  		$country_filt = ""; 		
  	}

	$objPHPExcel = new PHPExcel();
    $activeSheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000')
            )/*,
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )*/
        );

    $fbase = $this->input->post('quarter_or_range');

	if($fbase == '')
	{
		$quarter_filt = '';
						
	}
	else if($fbase == 'BonQuarter')
	{
		$fqtr = $this->input->post('exp_inv_filt_quarter_val');
		$yrange = $this->input->post('exp_inv_filt_year_val');

		if($fqtr == '') 
		{
			$yr = explode('-', $yrange);

			$fdate = $yr[0].'-04-01';
			$tdate = $yr[1].'-03-31';
			$quarter_filt =  "AND STR_TO_DATE(inv.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(inv.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
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
			$quarter_filt =  "AND STR_TO_DATE(inv.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(inv.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//else if()
	}
	else
	{
		$schange = $this->input->post('exp_inv_filt_search_val');
		//echo $schange;
		$dtrange = $this->input->post('exp_inv_filt_dtrng_val');

    	if($schange == '')
		{
			$quarter_filt = '';
		}
		elseif($schange == 'today')
		{
			$quarter_filt = "AND STR_TO_DATE(inv.created_on, '%Y-%m-%d') = CURDATE()";
		}
		else if($schange == 'thisweek')
		{
			$quarter_filt = "AND YEARWEEK(STR_TO_DATE(inv.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
		}      
		else if($schange == 'thismonth')
		{
			$quarter_filt = "AND MONTH(STR_TO_DATE(inv.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
			
		}			
		else if($schange == 'thisyear')
		{
			$finstart = $_SESSION['finstart'];
			$finend = $_SESSION['finend'];
			$quarter_filt = "AND STR_TO_DATE(inv.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(inv.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
		}
		else
		{
			$dr = explode(' - ', $dtrange);

			$fd = explode('/', $dr[0]);
			$td = explode('/', $dr[1]);

			$fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
			$tdate = $td[2].'-'.$td[1].'-'.$td[0];
			$quarter_filt = "AND STR_TO_DATE(inv.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(inv.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//$data['ypick'] = '';
	}

    $lead_exp = $this->input->post('inv_export');

    $get_all_leads = $this->Lead_model->get_all_inv_for_expo($quarter_filt,$country_filt);
    
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    for ($i=0; $i < count($lead_exp); $i++) { 
	    $objPHPExcel->getActiveSheet()->setCellValue($alpha[$i]."1", $lead_exp[$i]);
	    $objPHPExcel->getActiveSheet()->getStyle($alpha[$i].'1')->applyFromArray($styleArray);
	    $j=2;
	    foreach ($get_all_leads as $key => $lead_info) {
	    	if ($lead_exp[$i] == 'Lead Name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_name']);
	    	}
	    	elseif ($lead_exp[$i] == 'Invoice No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['invoice_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Buyer Order No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['buyer_order_invoice_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Exporter') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['exporter_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Subject') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['subject']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Created Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['invoice_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Buyer Confirmation Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['buyer_confirmation_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'PI Stage') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['pi_stage']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Other Reference') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['other_reference']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Terms Of Payment Type') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['terms_of_payment_type']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Pre Carriage By') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['pre_carriage_by']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Place Of Reciept By Pre Carrier') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['place_of_receipt_by_pre_carrier']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Vessel Flight') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['vessel_flight_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Port Of Loading') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['polname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Port Of Discharge') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['podname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Final Destination') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['fdname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Currency') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['currency_name'].' ('.$lead_info['currency_code'].')');	
	    	}
	    	elseif ($lead_exp[$i] == 'Rate') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['rate']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Bank Info') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, strip_tags($lead_info['bank_detail']));	
	    	}
	    	elseif ($lead_exp[$i] == 'Grand Total') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['grand_total']);	
	    	}
	    	$j++;
	    }
	}
    
    // $objWorkSheet->setTitle("Lead Information");
    $filename='Invoice_info_'.date('Y-m-d_H-i-s').'.xlsx'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objPHPExcel->setActiveSheetIndex(0);

    if (ob_get_contents()) ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
  }
  public function export_bo_info()
  {
  	$user_id = $this->input->post('exp_bo_filt_user_val');
  	$country_id = $this->input->post('exp_bo_filt_country_val');
  	if ($user_id != '') {
  		$user_filt = " AND l.lead_assigned_to = '$user_id'";
  	}
  	else {
  		$user_filt = ""; 		
  	}

  	if ($country_id != '') {
  		$country_filt = " AND cb.country = '$country_id'";
  	}
  	else {
  		$country_filt = ""; 		
  	}

		$objPHPExcel = new PHPExcel();
    $activeSheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000')
            )/*,
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )*/
        );
    $fbase = $this->input->post('quarter_or_range');

	if($fbase == '')
	{
		$quarter_filt = '';
						
	}
	else if($fbase == 'BonQuarter')
	{
		$fqtr = $this->input->post('exp_bo_filt_quarter_val');
		$yrange = $this->input->post('exp_bo_filt_year_val');

		if($fqtr == '') 
		{
			$yr = explode('-', $yrange);

			$fdate = $yr[0].'-04-01';
			$tdate = $yr[1].'-03-31';
			$quarter_filt =  "AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
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
			$quarter_filt =  "AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//else if()
	}
	else
	{
		$schange = $this->input->post('exp_bo_filt_search_val');
		//echo $schange;
		$dtrange = $this->input->post('exp_bo_filt_dtrng_val');

    	if($schange == '')
		{
			$quarter_filt = '';
		}
		elseif($schange == 'today')
		{
			$quarter_filt = "AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') = CURDATE()";
		}
		else if($schange == 'thisweek')
		{
			$quarter_filt = "AND YEARWEEK(STR_TO_DATE(bo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
		}      
		else if($schange == 'thismonth')
		{
			$quarter_filt = "AND MONTH(STR_TO_DATE(bo.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
			
		}			
		else if($schange == 'thisyear')
		{
			$finstart = $_SESSION['finstart'];
			$finend = $_SESSION['finend'];
			$quarter_filt = "AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
		}
		else
		{
			$dr = explode(' - ', $dtrange);

			$fd = explode('/', $dr[0]);
			$td = explode('/', $dr[1]);

			$fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
			$tdate = $td[2].'-'.$td[1].'-'.$td[0];
			$quarter_filt = "AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//$data['ypick'] = '';
	}
    $lead_exp = $this->input->post('bo_export');
    $get_all_leads = $this->Lead_model->get_all_bo_for_expo($quarter_filt,$user_filt,$country_filt);
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    for ($i=0; $i < count($lead_exp); $i++) { 
	    $objPHPExcel->getActiveSheet()->setCellValue($alpha[$i]."1", $lead_exp[$i]);
	    $objPHPExcel->getActiveSheet()->getStyle($alpha[$i].'1')->applyFromArray($styleArray);
	    $j=2;
	    foreach ($get_all_leads as $key => $lead_info) {
	    	if ($lead_exp[$i] == 'Lead Name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_name']);
	    	}
	    	elseif ($lead_exp[$i] == 'Buyer Order Invoice No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['buyer_order_invoice_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Exporter') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['exporter_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Subject') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['subject']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Invoice Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['invoice_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Buyer Confirmation Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['buyer_confirmation_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Order Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['order_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Order End Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['order_end_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'PI Stage') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['pi_stage']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Other Reference') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['other_reference']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Terms Of Payment Type') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['terms_of_payment_type']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Pre Carriage By') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['pre_carriage_by']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Place Of Reciept By Pre Carrier') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['place_of_receipt_by_pre_carrier']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Vessel Flight') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['vessel_flight_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Port Of Loading') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['polname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Port Of Discharge') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['podname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Final Destination') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['fdname']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Currency') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['currency_name'].' ('.$lead_info['currency_code'].')');	
	    	}
	    	elseif ($lead_exp[$i] == 'Rate') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['rate']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Bank Info') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['bank_detail']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Sales Note') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['sales_note']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Purchase Note') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['purchase_note']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Shipping Note') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['shipping_note']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Account Note') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['accounts_note']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Specification Packing Details') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['specification_packing_details']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Price Validity') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['price_validity']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Interest') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['interest_label']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Loadability') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['loadability']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Terms And Payment') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['terms_and_payment']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Terms Of Payment') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['terms_of_payment_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Arbitration') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['arbitration_label']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Declaration') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['declaration_label']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Grand Total') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['grand_total']);	
	    	}
	    	$j++;
	    }
	}
    
    // $objWorkSheet->setTitle("Lead Information");
    $filename='Buyerorder_invoice_info_'.date('Y-m-d_H-i-s').'.xlsx'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objPHPExcel->setActiveSheetIndex(0);

    if (ob_get_contents()) ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
	}
  public function export_spo_info()
  {
  	$user_id = $this->input->post('exp_spo_filt_user_val');
  	if ($user_id != '') {
  		$user_filt = " AND spo.vendor_id = '$user_id'";
  	}
  	else {
  		$user_filt = ""; 		
  	}
		$objPHPExcel = new PHPExcel();
    $activeSheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000')
            )/*,
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )*/
        );
    $fbase = $this->input->post('quarter_or_range');

	if($fbase == '')
	{
		$quarter_filt = '';
						
	}
	else if($fbase == 'BonQuarter')
	{
		$fqtr = $this->input->post('exp_spo_filt_quarter_val');
		$yrange = $this->input->post('exp_spo_filt_year_val');

		if($fqtr == '') 
		{
			$yr = explode('-', $yrange);

			$fdate = $yr[0].'-04-01';
			$tdate = $yr[1].'-03-31';
			$quarter_filt =  "AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
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
			$quarter_filt =  "AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//else if()
	}
	else
	{
		$schange = $this->input->post('exp_spo_filt_search_val');
		//echo $schange;
		$dtrange = $this->input->post('exp_spo_filt_dtrng_val');

    	if($schange == '')
		{
			$quarter_filt = '';
		}
		elseif($schange == 'today')
		{
			$quarter_filt = "AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') = CURDATE()";
		}
		else if($schange == 'thisweek')
		{
			$quarter_filt = "AND YEARWEEK(STR_TO_DATE(spo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
		}      
		else if($schange == 'thismonth')
		{
			$quarter_filt = "AND MONTH(STR_TO_DATE(spo.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
			
		}			
		else if($schange == 'thisyear')
		{
			$finstart = $_SESSION['finstart'];
			$finend = $_SESSION['finend'];
			$quarter_filt = "AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
		}
		else
		{
			$dr = explode(' - ', $dtrange);

			$fd = explode('/', $dr[0]);
			$td = explode('/', $dr[1]);

			$fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
			$tdate = $td[2].'-'.$td[1].'-'.$td[0];
			$quarter_filt = "AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//$data['ypick'] = '';
	}
    
    $lead_exp = $this->input->post('spo_export');
    $get_all_leads = $this->Lead_model->get_all_spo_for_expo($quarter_filt,$user_filt);
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    for ($i=0; $i < count($lead_exp); $i++) { 
	    $objPHPExcel->getActiveSheet()->setCellValue($alpha[$i]."1", $lead_exp[$i]);
	    $objPHPExcel->getActiveSheet()->getStyle($alpha[$i].'1')->applyFromArray($styleArray);
	    $j=2;
	    foreach ($get_all_leads as $key => $lead_info) {
	    	if ($lead_exp[$i] == 	'Vendor') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['vendor_name'].' ('.$lead_info['phone_no'].')');
	    	}
	    	elseif ($lead_exp[$i] == 'Supply Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['supply_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Supply End Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['supply_end_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Buyer Order No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['buyer_order_invoice_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Supplier Order No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['supplier_purchase_order_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Delivery Place') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['delivery_place']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Total Amount') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['total_amount']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Terms Of Condition') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, strip_tags($lead_info['terms_of_condition']));	
	    	}
	    	elseif ($lead_exp[$i] == 'Cancel Reason') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['cancel_reason']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Stage') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['stage']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Completed Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['completed_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Lead name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_name']);	
	    	}
	    	
	    	
	    	$j++;
	    }
	}
    
    // $objWorkSheet->setTitle("Lead Information");
    $filename='Supplier_purchase_order_invoice_info_'.date('Y-m-d_H-i-s').'.xlsx'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objPHPExcel->setActiveSheetIndex(0);

    if (ob_get_contents()) ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
	}
  public function export_jo_info()
  {
  	$user_id = $this->input->post('exp_jo_filt_user_val');
  	if ($user_id != '') {
  		$user_filt = " AND jo.employee_id = '$user_id'";
  	}
  	else {
  		$user_filt = ""; 		
  	}
		$objPHPExcel = new PHPExcel();
    $activeSheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000')
            )/*,
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )*/
        );
    $fbase = $this->input->post('quarter_or_range');

	if($fbase == '')
	{
		$quarter_filt = '';
						
	}
	else if($fbase == 'BonQuarter')
	{
		$fqtr = $this->input->post('exp_jo_filt_quarter_val');
		$yrange = $this->input->post('exp_jo_filt_year_val');

		if($fqtr == '') 
		{
			$yr = explode('-', $yrange);

			$fdate = $yr[0].'-04-01';
			$tdate = $yr[1].'-03-31';
			$quarter_filt =  "AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
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
			$quarter_filt =  "AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//else if()
	}
	else
	{
		$schange = $this->input->post('exp_jo_filt_search_val');
		//echo $schange;
		$dtrange = $this->input->post('exp_jo_filt_dtrng_val');

    	if($schange == '')
		{
			$quarter_filt = '';
		}
		elseif($schange == 'today')
		{
			$quarter_filt = "AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') = CURDATE()";
		}
		else if($schange == 'thisweek')
		{
			$quarter_filt = "AND YEARWEEK(STR_TO_DATE(jo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
		}      
		else if($schange == 'thismonth')
		{
			$quarter_filt = "AND MONTH(STR_TO_DATE(jo.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
			
		}			
		else if($schange == 'thisyear')
		{
			$finstart = $_SESSION['finstart'];
			$finend = $_SESSION['finend'];
			$quarter_filt = "AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
		}
		else
		{
			$dr = explode(' - ', $dtrange);

			$fd = explode('/', $dr[0]);
			$td = explode('/', $dr[1]);

			$fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
			$tdate = $td[2].'-'.$td[1].'-'.$td[0];
			$quarter_filt = "AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
		}
		//$data['ypick'] = '';
	}

    $lead_exp = $this->input->post('jo_export');
    $get_all_leads = $this->Lead_model->get_all_jo_for_expo($quarter_filt,$user_filt);
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    for ($i=0; $i < count($lead_exp); $i++) { 
	    $objPHPExcel->getActiveSheet()->setCellValue($alpha[$i]."1", $lead_exp[$i]);
	    $objPHPExcel->getActiveSheet()->getStyle($alpha[$i].'1')->applyFromArray($styleArray);
	    $j=2;
	    foreach ($get_all_leads as $key => $lead_info) {
	    	if ($lead_exp[$i] == 	'Lead Name') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lead_name']);
	    	}
	    	elseif ($lead_exp[$i] == 'Supplier Order No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['supplier_purchase_order_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Buyer Order No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['buyer_order_invoice_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Job Order No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['job_order_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Job Order Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['job_order_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Job Order End Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['job_order_end_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Employee') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['display_name']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Container No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, strip_tags($lead_info['container_no']));	
	    	}
	    	elseif ($lead_exp[$i] == 'Lorry No') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['lorry_no']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Complete Date') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['completed_date']);	
	    	}
	    	elseif ($lead_exp[$i] == 'Product') {
	    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['product_name']);	
	    	}

	    	
	    	
	    	
	    	$j++;
	    }
	}
    
    // $objWorkSheet->setTitle("Lead Information");
    $filename='Joborder_info_'.date('Y-m-d_H-i-s').'.xlsx'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objPHPExcel->setActiveSheetIndex(0);

    if (ob_get_contents()) ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
	}
	public function lead_pivot_report_generate()
	{
		$left_side = $this->input->post('pivot_left');
		$top_of_table = $this->input->post('pivot_top');

		$year = $this->input->post('pivot_exp_lead_filt_month_val');
	    $data['country'] = $this->input->post('pivot_exp_lead_filt_country_val');
	    $data['product'] = $this->input->post('pivot_exp_lead_filt_product_val');
	    $data['type'] = $this->input->post('pivot_exp_lead_filt_priority_val');
	    $data['ls'] = $this->input->post('pivot_exp_lead_filt_ls_val');
	    $data['lst'] = $this->input->post('pivot_exp_lead_filt_lst_val');
	    $data['ass_to'] = $this->input->post('pivot_exp_lead_filt_ass_to_val');
	    $data['dtrange'] = $this->input->post('pivot_exp_lead_filt_dtrng_val');

	    if($this->input->post('pivot_exp_lead_filt_month_val'))
		{
			$l_year = explode('-', $this->input->post('pivot_exp_lead_filt_month_val'));
			$data['p_month'] = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
			$data['p_year']  = ($l_year[0]) ? $l_year[0] : date('Y');
		}
		else{
			$data['p_month'] =  date('m');
			$data['p_year']  = date('Y');
		}

		$data['left_side'] = $left_side;
		$data['top_of_table'] = $top_of_table;

		$data['loop_array_left'] = $this->Lead_model->get_left_side_loop_array($left_side);
		$data['loop_array_top'] = $this->Lead_model->get_top_side_loop_array($top_of_table);
		// echo "<pre>";
		// print_r($data['loop_array_left']);
		// print_r($data['loop_array_top']);
		$this->load->view("lead/lead_pivot_reports",$data);
	}
	public function oppo_pivot_report_generate()
	{
		
		$left_side = $this->input->post('pivot_left');
		$top_of_table = $this->input->post('pivot_top');

		$year = $this->input->post('pivot_exp_lead_filt_month_val');
	    $data['country'] = $this->input->post('pivot_exp_lead_filt_country_val');
	    $data['product'] = $this->input->post('pivot_exp_lead_filt_product_val');
	    $data['type'] = $this->input->post('pivot_exp_lead_filt_priority_val');
	    $data['ls'] = $this->input->post('pivot_exp_lead_filt_ls_val');
	    $data['lst'] = $this->input->post('pivot_exp_lead_filt_lst_val');
	    $data['ass_to'] = $this->input->post('pivot_exp_lead_filt_ass_to_val');
	    $data['dtrange'] = $this->input->post('pivot_exp_lead_filt_dtrng_val');

	    if($this->input->post('pivot_exp_lead_filt_month_val'))
		{
			$l_year = explode('-', $this->input->post('pivot_exp_lead_filt_month_val'));
			$data['p_month'] = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
			$data['p_year']  = ($l_year[0]) ? $l_year[0] : date('Y');
		}
		else{
			$data['p_month'] =  date('m');
			$data['p_year']  = date('Y');
		}

		$data['left_side'] = $left_side;
		$data['top_of_table'] = $top_of_table;

		$data['loop_array_left'] = $this->Lead_model->get_left_side_loop_array($left_side);
		$data['loop_array_top'] = $this->Lead_model->get_top_side_loop_array($top_of_table);
		// echo "<pre>";
		// print_r($data['loop_array_left']);
		// print_r($data['loop_array_top']);
		$this->load->view("lead/oppo_pivot_reports",$data);
	}
	public function lead_graph_report_generate()
	{
		$exp_meth = $this->input->post('exp_method');
		if ($exp_meth == 'line') {
			$year = $this->input->post('graph_exp_lead_filt_month_val');
		    $country = $this->input->post('graph_exp_lead_filt_country_val');
		    $product = $this->input->post('graph_exp_lead_filt_product_val');
		    $type = $this->input->post('graph_exp_lead_filt_priority_val');
		    $ls = $this->input->post('graph_exp_lead_filt_ls_val');
		    $lst = $this->input->post('graph_exp_lead_filt_lst_val');
		    $ass_to = $this->input->post('graph_exp_lead_filt_ass_to_val');
		    $dtrange = $this->input->post('graph_exp_lead_filt_dtrng_val');

		    if($this->input->post('graph_exp_lead_filt_month_val'))
			{
				$l_year = explode('-', $this->input->post('graph_exp_lead_filt_month_val'));
				$p_month = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
				$p_year  = ($l_year[0]) ? $l_year[0] : date('Y');
			}
			else{
				$p_month =  date('m');
				$p_year  = date('Y');
			}
			// $year_month = $this->input->post('exp_graph_lead_filt_month_val');
			$graph_left = $this->input->post('graph_left');
			$graph_bot = $this->input->post('graph_bot');

			$get_lines_exist_col_value_only = $this->Lead_model->get_values_only_exist_id($graph_left);
			$get_bot_exist_col_value_only = $this->Lead_model->get_values_only_exist_id($graph_bot);

			$count_of_bottom = count($get_bot_exist_col_value_only);
			// echo "<pre>";
			// print_r($get_lines_exist_col_value_only);
			// print_r($get_bot_exist_col_value_only);
			// die();
			
			// $year_month = date('Y-m', strtotime($this->input->post('exp_graph_lead_filt_month_val')));
			// $ex_val = explode('-', $year_month);
			// $year = $ex_val[0];
			// $month = $ex_val[1];
			// $no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
			// $lead_exp_list = $this->Lead_model->lead_exp_list_daily_report($year_month, $no_of_days_in_month, $graph_left);
			
			// $lead_exp_list = $this->Report_model->lead_source_daily_report($year_month, $no_of_days_in_month);
			$ls_count_arr = array();
			$symbols = array('circle','square','diamond','triangle','triangle-down');
			$get_graph_count_by_line_bottom = array();
			for ($i=0; $i < count($get_lines_exist_col_value_only); $i++) { 
				for ($j=0; $j < count($get_bot_exist_col_value_only); $j++) { 
					// echo "<br>";echo "<br>";
					// echo $get_lines_exist_col_value_only[$i]['col_name'];
					// echo "<br>";
					// echo $get_bot_exist_col_value_only[$j]['col_name'];
					$get_graph_count_by_line_bottom[] = $this->Lead_model->get_graph_count_by_line_bottom($get_lines_exist_col_value_only[$i]['col_id'],$graph_left,$get_bot_exist_col_value_only[$j]['col_id'],$graph_bot, $lst, $ls, $dtrange, $lst, $p_year, $p_month, $product, $country, $ass_to);
				}
			}
			
			$new_single_graph_arr = array();
			for ($i=0; $i < count($get_graph_count_by_line_bottom); $i++) { 
				array_push($new_single_graph_arr, $get_graph_count_by_line_bottom[$i][0]['graph_count']);
			}
			$splited_by_bottom_cat = array_chunk($new_single_graph_arr,$count_of_bottom);
			
			for ($i=0; $i < count($get_lines_exist_col_value_only); $i++) { 
				$rand_ind = array_rand($symbols);
				$imp_splitted_arr = '"' . implode ( '", "', $splited_by_bottom_cat[$i] ) . '"'; 
				// implode(',', $splited_by_bottom_cat[$i]);
				$ls_count_arr[] = array('name'=>$get_lines_exist_col_value_only[$i]['col_name'],'marker' => array('symbol'=>$symbols[$rand_ind]),'data'=> $splited_by_bottom_cat[$i]);
			}
			$bottom_js_arr_val = '';
			for ($i=0; $i < count($get_bot_exist_col_value_only); $i++) { 
				$bottom_js_arr_val .= '"'.$get_bot_exist_col_value_only[$i]['col_name'].'",';
			}
			$bottom_js_arr_val = rtrim($bottom_js_arr_val, ',');
			$bot_exe_js_arr = '['.$bottom_js_arr_val.']';
			$data['graph_json_data'] = json_encode($bot_exe_js_arr);
			$data['graph_json_data'] .= "|";
			$data['graph_json_data'] .= json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
			// echo "<pre>";
			// print_r($ls_count_arr);
			// die();
			// echo "<pre>";
			// $data['lead_graph_json'] = json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
			// die();
			$this->load->view('lead/lead_graph_export',$data);
		}
		else if($exp_meth == 'bar') {
			$year = $this->input->post('graph_exp_lead_filt_month_val');
		    $country = $this->input->post('graph_exp_lead_filt_country_val');
		    $product = $this->input->post('graph_exp_lead_filt_product_val');
		    $type = $this->input->post('graph_exp_lead_filt_priority_val');
		    $ls = $this->input->post('graph_exp_lead_filt_ls_val');
		    $lst = $this->input->post('graph_exp_lead_filt_lst_val');
		    $ass_to = $this->input->post('graph_exp_lead_filt_ass_to_val');
		    $dtrange = $this->input->post('graph_exp_lead_filt_dtrng_val');

		    if($this->input->post('graph_exp_lead_filt_month_val'))
			{
				$l_year = explode('-', $this->input->post('graph_exp_lead_filt_month_val'));
				$p_month = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
				$p_year  = ($l_year[0]) ? $l_year[0] : date('Y');
			}
			else{
				$p_month =  date('m');
				$p_year  = date('Y');
			}
			// $year_month = $this->input->post('exp_graph_lead_filt_month_val');
			$graph_left = $this->input->post('graph_left');
			$graph_bot = $this->input->post('graph_bot');

			$get_lines_exist_col_value_only = $this->Lead_model->get_values_only_exist_id($graph_left);
			$get_bot_exist_col_value_only = $this->Lead_model->get_values_only_exist_id($graph_bot);

			$count_of_bottom = count($get_bot_exist_col_value_only);
			// echo "<pre>";
			// print_r($get_lines_exist_col_value_only);
			// print_r($get_bot_exist_col_value_only);
			// die();
			// $year_month = date('Y-m', strtotime($this->input->post('exp_graph_lead_filt_month_val')));
			// $ex_val = explode('-', $year_month);
			// $year = $ex_val[0];
			// $month = $ex_val[1];
			// $no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
			// $lead_exp_list = $this->Lead_model->lead_exp_list_daily_report($year_month, $no_of_days_in_month, $graph_left);
			
			// $lead_exp_list = $this->Report_model->lead_source_daily_report($year_month, $no_of_days_in_month);
			$ls_count_arr = array();
			$symbols = array('circle','square','diamond','triangle','triangle-down');
			$get_graph_count_by_line_bottom = array();
			for ($i=0; $i < count($get_lines_exist_col_value_only); $i++) { 
				for ($j=0; $j < count($get_bot_exist_col_value_only); $j++) { 
					// echo "<br>";echo "<br>";
					// echo $get_lines_exist_col_value_only[$i]['col_name'];
					// echo "<br>";
					// echo $get_bot_exist_col_value_only[$j]['col_name'];
					$get_graph_count_by_line_bottom[] = $this->Lead_model->get_graph_count_by_line_bottom($get_lines_exist_col_value_only[$i]['col_id'],$graph_left,$get_bot_exist_col_value_only[$j]['col_id'], $graph_bot, $lst, $ls, $dtrange, $lst, $p_year, $p_month, $product, $country, $ass_to);
				}
			}
			
			$new_single_graph_arr = array();
			for ($i=0; $i < count($get_graph_count_by_line_bottom); $i++) { 
				array_push($new_single_graph_arr, $get_graph_count_by_line_bottom[$i][0]['graph_count']);
			}
			$splited_by_bottom_cat = array_chunk($new_single_graph_arr,$count_of_bottom);
			
			for ($i=0; $i < count($get_lines_exist_col_value_only); $i++) { 
				$rand_ind = array_rand($symbols);
				$imp_splitted_arr = '"' . implode ( '", "', $splited_by_bottom_cat[$i] ) . '"'; 
				// implode(',', $splited_by_bottom_cat[$i]);
				$ls_count_arr[] = array('name'=>$get_lines_exist_col_value_only[$i]['col_name'],'data'=> $splited_by_bottom_cat[$i]);
			}
			$bottom_js_arr_val = '';
			for ($i=0; $i < count($get_bot_exist_col_value_only); $i++) { 
				$bottom_js_arr_val .= '"'.$get_bot_exist_col_value_only[$i]['col_name'].'",';
			}
			$bottom_js_arr_val = rtrim($bottom_js_arr_val, ',');
			$bot_exe_js_arr = '['.$bottom_js_arr_val.']';
			$data['graph_json_data'] = json_encode($bot_exe_js_arr);
			$data['graph_json_data'] .= "|";
			$data['graph_json_data'] .= json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
			// echo "<pre>";
			// print_r($ls_count_arr);
			// die();
			// echo "<pre>";
			// $data['lead_graph_json'] = json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
			// die();
			$this->load->view('lead/lead_bar_chart_export',$data);
		}
		
	}
	public function oppo_graph_report_generate()
	{
		$exp_meth = $this->input->post('exp_method');
		if ($exp_meth == 'line') {
			$year = $this->input->post('graph_exp_lead_filt_month_val');
		    $country = $this->input->post('graph_exp_lead_filt_country_val');
		    $product = $this->input->post('graph_exp_lead_filt_product_val');
		    $type = $this->input->post('graph_exp_lead_filt_priority_val');
		    $ls = $this->input->post('graph_exp_lead_filt_ls_val');
		    $lst = $this->input->post('graph_exp_lead_filt_lst_val');
		    $ass_to = $this->input->post('graph_exp_lead_filt_ass_to_val');
		    $dtrange = $this->input->post('graph_exp_lead_filt_dtrng_val');

		    if($this->input->post('graph_exp_lead_filt_month_val'))
			{
				$l_year = explode('-', $this->input->post('graph_exp_lead_filt_month_val'));
				$p_month = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
				$p_year  = ($l_year[0]) ? $l_year[0] : date('Y');
			}
			else{
				$p_month =  date('m');
				$p_year  = date('Y');
			}
			// $year_month = $this->input->post('exp_graph_lead_filt_month_val');
			$graph_left = $this->input->post('graph_left');
			$graph_bot = $this->input->post('graph_bot');

			$get_lines_exist_col_value_only = $this->Lead_model->get_values_only_exist_id($graph_left);
			$get_bot_exist_col_value_only = $this->Lead_model->get_values_only_exist_id($graph_bot);

			$count_of_bottom = count($get_bot_exist_col_value_only);
			// echo "<pre>";
			// print_r($get_lines_exist_col_value_only);
			// print_r($get_bot_exist_col_value_only);
			// die();
			
			// $year_month = date('Y-m', strtotime($this->input->post('exp_graph_lead_filt_month_val')));
			// $ex_val = explode('-', $year_month);
			// $year = $ex_val[0];
			// $month = $ex_val[1];
			// $no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
			// $lead_exp_list = $this->Lead_model->lead_exp_list_daily_report($year_month, $no_of_days_in_month, $graph_left);
			
			// $lead_exp_list = $this->Report_model->lead_source_daily_report($year_month, $no_of_days_in_month);
			$ls_count_arr = array();
			$symbols = array('circle','square','diamond','triangle','triangle-down');
			$get_graph_count_by_line_bottom = array();
			for ($i=0; $i < count($get_lines_exist_col_value_only); $i++) { 
				for ($j=0; $j < count($get_bot_exist_col_value_only); $j++) { 
					// echo "<br>";echo "<br>";
					// echo $get_lines_exist_col_value_only[$i]['col_name'];
					// echo "<br>";
					// echo $get_bot_exist_col_value_only[$j]['col_name'];
					$get_graph_count_by_line_bottom[] = $this->Lead_model->get_oppo_graph_count_by_line_bottom($get_lines_exist_col_value_only[$i]['col_id'],$graph_left,$get_bot_exist_col_value_only[$j]['col_id'],$graph_bot, $lst, $ls, $dtrange, $lst, $p_year, $p_month, $product, $country, $ass_to);
				}
			}
			
			$new_single_graph_arr = array();
			for ($i=0; $i < count($get_graph_count_by_line_bottom); $i++) { 
				array_push($new_single_graph_arr, $get_graph_count_by_line_bottom[$i][0]['graph_count']);
			}
			$splited_by_bottom_cat = array_chunk($new_single_graph_arr,$count_of_bottom);
			
			for ($i=0; $i < count($get_lines_exist_col_value_only); $i++) { 
				$rand_ind = array_rand($symbols);
				$imp_splitted_arr = '"' . implode ( '", "', $splited_by_bottom_cat[$i] ) . '"'; 
				// implode(',', $splited_by_bottom_cat[$i]);
				$ls_count_arr[] = array('name'=>$get_lines_exist_col_value_only[$i]['col_name'],'marker' => array('symbol'=>$symbols[$rand_ind]),'data'=> $splited_by_bottom_cat[$i]);
			}
			$bottom_js_arr_val = '';
			for ($i=0; $i < count($get_bot_exist_col_value_only); $i++) { 
				$bottom_js_arr_val .= '"'.$get_bot_exist_col_value_only[$i]['col_name'].'",';
			}
			$bottom_js_arr_val = rtrim($bottom_js_arr_val, ',');
			$bot_exe_js_arr = '['.$bottom_js_arr_val.']';
			$data['graph_json_data'] = json_encode($bot_exe_js_arr);
			$data['graph_json_data'] .= "|";
			$data['graph_json_data'] .= json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
			// echo "<pre>";
			// print_r($ls_count_arr);
			// die();
			// echo "<pre>";
			// $data['lead_graph_json'] = json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
			// die();
			$this->load->view('lead/oppo_graph_export',$data);
		}
		else if($exp_meth == 'bar') {
			$year = $this->input->post('graph_exp_lead_filt_month_val');
		    $country = $this->input->post('graph_exp_lead_filt_country_val');
		    $product = $this->input->post('graph_exp_lead_filt_product_val');
		    $type = $this->input->post('graph_exp_lead_filt_priority_val');
		    $ls = $this->input->post('graph_exp_lead_filt_ls_val');
		    $lst = $this->input->post('graph_exp_lead_filt_lst_val');
		    $ass_to = $this->input->post('graph_exp_lead_filt_ass_to_val');
		    $dtrange = $this->input->post('graph_exp_lead_filt_dtrng_val');

		    if($this->input->post('graph_exp_lead_filt_month_val'))
			{
				$l_year = explode('-', $this->input->post('graph_exp_lead_filt_month_val'));
				$p_month = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
				$p_year  = ($l_year[0]) ? $l_year[0] : date('Y');
			}
			else{
				$p_month =  date('m');
				$p_year  = date('Y');
			}
			// $year_month = $this->input->post('exp_graph_lead_filt_month_val');
			$graph_left = $this->input->post('graph_left');
			$graph_bot = $this->input->post('graph_bot');

			$get_lines_exist_col_value_only = $this->Lead_model->get_values_only_exist_id($graph_left);
			$get_bot_exist_col_value_only = $this->Lead_model->get_values_only_exist_id($graph_bot);

			$count_of_bottom = count($get_bot_exist_col_value_only);
			// echo "<pre>";
			// print_r($get_lines_exist_col_value_only);
			// print_r($get_bot_exist_col_value_only);
			// die();

			// $year_month = date('Y-m', strtotime($this->input->post('exp_graph_lead_filt_month_val')));
			// $ex_val = explode('-', $year_month);
			// $year = $ex_val[0];
			// $month = $ex_val[1];
			// $no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
			// $lead_exp_list = $this->Lead_model->lead_exp_list_daily_report($year_month, $no_of_days_in_month, $graph_left);
			
			// $lead_exp_list = $this->Report_model->lead_source_daily_report($year_month, $no_of_days_in_month);
			$ls_count_arr = array();
			$symbols = array('circle','square','diamond','triangle','triangle-down');
			$get_graph_count_by_line_bottom = array();
			for ($i=0; $i < count($get_lines_exist_col_value_only); $i++) { 
				for ($j=0; $j < count($get_bot_exist_col_value_only); $j++) { 
					// echo "<br>";echo "<br>";
					// echo $get_lines_exist_col_value_only[$i]['col_name'];
					// echo "<br>";
					// echo $get_bot_exist_col_value_only[$j]['col_name'];
					$get_graph_count_by_line_bottom[] = $this->Lead_model->get_oppo_graph_count_by_line_bottom($get_lines_exist_col_value_only[$i]['col_id'],$graph_left,$get_bot_exist_col_value_only[$j]['col_id'],$graph_bot, $lst, $ls, $dtrange, $lst, $p_year, $p_month, $product, $country, $ass_to);
				}
			}
			
			$new_single_graph_arr = array();
			for ($i=0; $i < count($get_graph_count_by_line_bottom); $i++) { 
				array_push($new_single_graph_arr, $get_graph_count_by_line_bottom[$i][0]['graph_count']);
			}
			$splited_by_bottom_cat = array_chunk($new_single_graph_arr,$count_of_bottom);
			
			for ($i=0; $i < count($get_lines_exist_col_value_only); $i++) { 
				$rand_ind = array_rand($symbols);
				$imp_splitted_arr = '"' . implode ( '", "', $splited_by_bottom_cat[$i] ) . '"'; 
				// implode(',', $splited_by_bottom_cat[$i]);
				$ls_count_arr[] = array('name'=>$get_lines_exist_col_value_only[$i]['col_name'],'data'=> $splited_by_bottom_cat[$i]);
			}
			$bottom_js_arr_val = '';
			for ($i=0; $i < count($get_bot_exist_col_value_only); $i++) { 
				$bottom_js_arr_val .= '"'.$get_bot_exist_col_value_only[$i]['col_name'].'",';
			}
			$bottom_js_arr_val = rtrim($bottom_js_arr_val, ',');
			$bot_exe_js_arr = '['.$bottom_js_arr_val.']';
			$data['graph_json_data'] = json_encode($bot_exe_js_arr);
			$data['graph_json_data'] .= "|";
			$data['graph_json_data'] .= json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
			// echo "<pre>";
			// print_r($ls_count_arr);
			// die();
			// echo "<pre>";
			// $data['lead_graph_json'] = json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
			// die();
			$this->load->view('lead/oppo_bar_chart_export',$data);
		}
		
	}
	// To list lead status settings
	public function oppo_status_list()
	{
		$data['lead_statuss'] = $this->Lead_model->oppo_status_list();
		$this->load->view('lead/opportunity_status', $data);
	}
		
	// To check lead status is unique
	public function oppo_status_unique()
	{
		$l_t_name = $this->input->post('value');
		$result = $this->Lead_model->oppo_status_unique($l_t_name);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To check lead status name is unique for edit form
	public function oppo_status_unique_edit()
	{
		$l_t_name = $this->input->post('value');
		$l_t_id = $this->input->post('id');
		$result = $this->Lead_model->oppo_status_unique_edit($l_t_name, $l_t_id);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To get lead status edit form by id 
    public function oppo_status_edit()
    {
		$l_t_id = $this->input->post('value');
		$result = $this->Lead_model->oppo_status_by_id($l_t_id);
		if($result){ echo $result->oppo_status_id.'|'.$result->oppo_status; }else{ echo ''; }
    }

    // To change lead status status
	public function oppo_status_change_status()
	{
		$l_t_id = $this->input->post('id');
		$status = $this->input->post('status');

		$result = $this->Lead_model->oppo_status_change_status($l_t_id, $status);
		if($result){ echo 1; }else{ echo 0; }
	}

	// To add lead status
	public function oppo_status_add()
	{
		$data['lead_status'] = trim($this->input->post('lead_status'), ' ');
	   	$data['c_on'] = date('Y-m-d H:i:s');
	    $data['c_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->oppo_status_add($data);
	    if($result){
				$this->session->set_flashdata('l_t_success', 'Opportunity Status has been created successfully...');
	    }else{
	      	   $this->session->set_flashdata('l_t_err', 'Could not create Opportunity status!');
	    }
	    redirect('Leads/oppo_status_list');

	}
	 // To update lead status deatils
    public function oppo_status_update()
    {
    	$l_t_id = $this->input->post('e_lead_status_id');
    	$data['lead_status'] = trim($this->input->post('lead_status'), ' ');
	    $data['m_on'] = date('Y-m-d H:i:s');
	    $data['m_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->oppo_status_update($data, $l_t_id);
	    if($result){
				$this->session->set_flashdata('l_t_success', 'Opportunity Status has been updated successfully...');
	    }else{
	      	   $this->session->set_flashdata('l_t_err', 'Could not update Opportunity status!');
	    }
	    redirect('Leads/oppo_status_list');

    }

	// To delete lead status
	public function oppo_status_delete()
	{
		$l_t_id = $this->input->post('delete_lead_status_id');
		// To check lead status in lead
		$check_l_status = $this->Lead_model->oppo_status_in_lead($l_t_id);

		if(empty($check_l_status))
		{
			$status = 2;
			$result = $this->Lead_model->oppo_status_change_status($l_t_id, $status);
			$this->session->set_flashdata('l_t_success', 'Opportunity has been Deleted successfully...');
		}else{
			$this->session->set_flashdata('l_t_err', 'Could not delete Opportunity status. Lead Status is mapped with other modules!');
		}
	    redirect('Leads/lead_status_list');
	}
	public function get_sub_lead_source_by_ls_id()
	{
		$ls_id = $this->input->post('value');
		$get_all_subgroup_source = get_all_subgroup_source($ls_id); 
		$sub_ls_options = "<option value=''>Choose</option>";
		foreach ($get_all_subgroup_source as $sub_source) {
			$sub_ls_options .= "<option value='".$sub_source->sub_lead_source_id."'>".$sub_source->sub_lead_source."</option>";
		}
		echo $sub_ls_options;
		
	}

	public function create_lead_comments()
	{
		$data['lead_id'] = $this->input->post('lead_id');
		// $add_from = (isset($this->input->post('comment_add_from'))) ? $this->input->post('comment_add_from') : '';
		$data['comments'] = $this->input->post('comments');
		$data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];
	    $_SESSION['active_panel'] = "lead_comments";
	    $this->Lead_model->update_lead_comments($data);
	    $this->Lead_model->create_lead_comments($data);
	    redirect('/Leads');
	}
	public function create_oppo_comments()
	{
		$data['lead_id'] = $this->input->post('lead_id');
		// $add_from = (isset($this->input->post('comment_add_from'))) ? $this->input->post('comment_add_from') : '';
		$data['comments'] = $this->input->post('comments');
		$data['created_on'] = date('Y-m-d H:i:s');
	    $data['created_by'] = $_SESSION['admindata']['user_id'];
	    $_SESSION['active_panel'] = "lead_comments";
	    $this->Lead_model->update_lead_comments($data);
	    $this->Lead_model->create_lead_comments($data);
	    redirect('/Leads/opportunity_list');
	}
	public function add_lead_window()
	{
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['product_lists'] = $this->Product_model->lead_product_list();
		$data['lead_type_lists'] = $this->Lead_model->lead_type_list();
		$data['lead_source_lists'] = $this->Lead_model->lead_source_list();
		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		// $data['get_parent_leads_info'] = $this->Lead_model->get_parent_leads_info();
		$this->load->view('lead/add_lead_page',$data);
	}
	public function get_lead_comments_by_lead_id()
	{
		$lead_id = $this->input->post('lead_id');
		$data['view_from'] = $this->input->post('view_from');
		$data['lead_id'] = $lead_id;
		$data['lead_comments_list'] = $this->Lead_model->get_lead_comments_by_id($lead_id);
		$this->load->view('lead/lead_comment_modal',$data);
	}
	public function generate_notification_content()
	{
		$date_format =common_date_format();
		$assigned_to = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$this->input->post('assigned_to').'"');
		$lead_name = $this->input->post('lead_name');
		$country = common_get_col_name_by_col_id('ac.name', 'ad_countries ac', 'ac.id = "'.$this->input->post('country').'"');
		$created_by = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$this->input->post('created_by').'"');
		$product_id = common_get_col_name_by_col_id('p.product_name', 'products p', 'p.product_id = "'.$this->input->post('product_id').'"');

		$get_notification_type_by_id = $this->Lead_model->get_notification_type_by_id(1);

		$content = $get_notification_type_by_id->content;
		$lead_name = '<b class="text-green">'.ucfirst($lead_name).'</b>';
	    $taken_user_name = '<b class="text-orange">'.ucfirst($created_by).'</b>';
	    $alloc_user_name = '<b class="text-orange">'.$assigned_to.'</b> ';
	    $product_name = '<b class="text-danger">'.$product_id.'</b>';
	    $lead_country = '<b class="text-green">'.$country.'</b>';
	    $cre_time = date('Y-m-d H:i:s');
	    $cre_date = '<b class="text-danger">'.date($date_format,$cre_time).'</b> ';

	    $content = str_replace('#Created_by#',$taken_user_name, $content);
	    $content = str_replace('#Lead_name#',$lead_name, $content);
	    $content = str_replace('#Created_date#',$cre_date, $content);
	    $content = str_replace('#Product_name#',$product_name, $content);
	    $content = str_replace('#Assigned_by#',$alloc_user_name, $content);
	    $content = str_replace('#Country_name#',$lead_country, $content);
		$notification_content = '<div id="noti1" style="cursor:pointer;background-color:#e6f2fe;" class="m-list-timeline__item" onclick="read_single_notification(1,1);">
		   <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
		   <span class="m-list-timeline__text">
		      <p>'.$content.'</p>
		   </span>
		   <span class="m-list-timeline__time">'.time_elapsed_string_in_helper($cre_time).'</span>
		</div>';
		echo $notification_content;
	}
	public function generate_followup_notification_content()
	{
		$date_format =common_date_format();
		$assigned_to = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$this->input->post('assigned_to').'"');

		$lead_id = $this->input->post('lead_id');
		$get_lead_by_id = $this->Lead_model->lead_by_id($lead_id);

		$raw_lead_name = $get_lead_by_id->lead_name;
		$country = $get_lead_by_id->country_name;
		$created_by = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$this->input->post('created_by').'"');
		$product_id = $get_lead_by_id->product_name;
		$raw_followup_time = $this->input->post('followup_time');
		$raw_followup_date = $this->input->post('followup_date');
		$cre_time = date('Y-m-d H:i:s');
		$get_notification_type_by_id = $this->Lead_model->get_notification_type_by_id(2);

		$content = $get_notification_type_by_id->content;
		$lead_name = '<b class="text-green">'.ucfirst($raw_lead_name).'</b>';
	    $taken_user_name = '<b class="text-orange">'.ucfirst($created_by).'</b>';
	    $alloc_user_name = '<b class="text-orange">'.$assigned_to.'</b> ';
	    $product_name = '<b class="text-danger">'.$product_id.'</b>';
	    $lead_country = '<b class="text-green">'.$country.'</b>';
	    $cre_date = '<b class="text-danger">'.date($date_format,$cre_time).'</b> ';
	    $followup_time = '<b class="text-danger">'.$raw_followup_time.'</b> ';
	    $followup_date = '<b class="text-danger">'.$raw_followup_date.'</b> ';

	    $content = str_replace('#created_by#',$taken_user_name, $content);
	    $content = str_replace('#Lead_name#',$lead_name, $content);
	    $content = str_replace('#Created_date#',$cre_date, $content);
	    $content = str_replace('#Product_name#',$product_name, $content);
	    $content = str_replace('#Assigned_by#',$alloc_user_name, $content);
	    $content = str_replace('#Country_name#',$lead_country, $content);
	    $content = str_replace('#followup_time#',$followup_time, $content);
	    $content = str_replace('#followup_date#',$followup_date, $content);
		$notification_content = '<div id="noti1" style="cursor:pointer;background-color:#e6f2fe;" class="m-list-timeline__item" onclick="read_single_notification(1,1);">
		   <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
		   <span class="m-list-timeline__text">
		      <p>'.$content.'</p>
		   </span>
		   <span class="m-list-timeline__time">'.time_elapsed_string_in_helper($cre_time).'</span>
		</div>';
		echo $notification_content;
	}

	public function generate_task_notification_content_change()
	{
		$date_format =common_date_format();
		$assigned_to = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$this->input->post('assigned_to').'"');
		$created_by = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$this->input->post('created_by').'"');
		$priority = $this->input->post('priority');
		$task_title = $this->input->post('task_title');
		$cre_time = date('Y-m-d H:i:s');

		$get_notification_type_by_id = $this->Lead_model->get_notification_type_by_id(3);

		$content = $get_notification_type_by_id->content;

		$taken_user_name = '<b class="text-green">'.ucfirst($created_by).'</b>';
	    $alloc_user_name = '<b class="text-green">'.$assigned_to.'</b> ';
	    $priority = '<b class="text-info">'.$priority.'</b>';
	    $task_name = '<b class="text-orange">'.$task_title.'</b>';
	    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($cre_time)).'</b> ';
	    

	    $content = str_replace('#Assigned_by#',$taken_user_name, $content);
	    $content = str_replace('#Task_name#',$task_name, $content);
	    $content = str_replace('#Priority#',$priority, $content);
	    $content = str_replace('#Assigned_on#',$cre_date, $content);
	    $content = str_replace('#Assigned_to#',$alloc_user_name, $content);

	    $notification_content = '<div id="noti1" style="cursor:pointer;background-color:#e6f2fe;" class="m-list-timeline__item" onclick="read_single_notification(1,1);">
		   <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
		   <span class="m-list-timeline__text">
		      <p>'.$content.'</p>
		   </span>
		   <span class="m-list-timeline__time">'.time_elapsed_string_in_helper($cre_time).'</span>
		</div>';
		echo $notification_content;
	}
	
	public function generate_task_comment_notification_content()
	{
		$date_format =common_date_format();
		$task_id = $this->input->post('task_id');
		$commentor = $this->input->post('created_by');

		$task_info = $this->Task_model->get_task_by_id($task_id);

		$receiver = '';
		if ($commentor == $task_info->created_by) {
			$receiver = $task_info->assigned_to;
		}
		else if ($commentor == $task_info->assigned_to) {
			$receiver = $task_info->created_by;
		}
		$commentor_name = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$commentor.'"');
		$receiver_name = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$receiver.'"');
		$task_title = $task_info->task_title;
		$cre_time = date('Y-m-d H:i:s');

		$get_notification_type_by_id = $this->Lead_model->get_notification_type_by_id(4);

		$content = $get_notification_type_by_id->content;

		$taken_user_name = '<b class="text-green">'.ucfirst($commentor_name).'</b>';
	    $alloc_user_name = '<b class="text-green">'.$receiver_name.'</b> ';
	    $task_name = '<b class="text-orange">'.$task_title.'</b>';
	    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($cre_time)).'</b> ';
	    

	    $content = str_replace('#Commentor#',$taken_user_name, $content);
	    $content = str_replace('#Task_name#',$task_name, $content);
	    $content = str_replace('#Commented_date#',$cre_date, $content);
	    $content = str_replace('#Receiver#',$alloc_user_name, $content);
	    $notification_content = '<div id="noti1" style="cursor:pointer;background-color:#e6f2fe;" class="m-list-timeline__item" onclick="read_single_notification(1,1);">
		   <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
		   <span class="m-list-timeline__text">
		      <p>'.$content.'</p>
		   </span>
		   <span class="m-list-timeline__time">'.time_elapsed_string_in_helper($cre_time).'</span>
		</div>';
	    echo $notification_content.'~'.$receiver;
	}
	
	public function generate_buyer_task_comment_notification_content()
	{
		$date_format =common_date_format();
		$assigned_to = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$this->input->post('assigned_to').'"');
		$created_by = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$this->input->post('created_by').'"');
		$task_title = $this->input->post('task');
		$cre_time = date('Y-m-d H:i:s');
		$bo_id = $this->input->post('buyer_order_id');
		$bo_info_by_id = $this->Buyerorder_model->get_buyer_order_by_id($bo_id);
		$get_notification_type_by_id = $this->Lead_model->get_notification_type_by_id(5);

		$content = $get_notification_type_by_id->content;

		$taken_user_name = '<b class="text-green">'.ucfirst($created_by).'</b>';
	    $alloc_user_name = '<b class="text-green">'.$assigned_to.'</b> ';
	    $task_name = '<b class="text-orange">'.$task_title.'</b>';
	    $bo_code = '<b class="text-orange">'.$bo_info_by_id->buyer_order_invoice_no.'</b>';
	    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($cre_time)).'</b> ';
	    

	    $content = str_replace('#Assigned_by#',$taken_user_name, $content);
	    $content = str_replace('#Task_name#',$task_name, $content);
	    $content = str_replace('#Assigned_on#',$cre_date, $content);
	    $content = str_replace('#Bo_code#', $bo_code, $content);
	    $content = str_replace('#Assigned_to#',$alloc_user_name, $content);

	    $notification_content = '<div id="noti1" style="cursor:pointer;background-color:#e6f2fe;" class="m-list-timeline__item" onclick="read_single_notification(1,1);">
		   <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
		   <span class="m-list-timeline__text">
		      <p>'.$content.'</p>
		   </span>
		   <span class="m-list-timeline__time">'.time_elapsed_string_in_helper($cre_time).'</span>
		</div>';
		echo $notification_content;
	}

	public function generate_buyer_task_remarks_notification_content()
	{
		$date_format =common_date_format();
		$task_id = $this->input->post('buyer_order_task_id');
		$commentor = $this->input->post('created_by');
		$bo_id = $this->input->post('buyer_order_id');
		$bo_info_by_id = $this->Buyerorder_model->get_buyer_order_by_id($bo_id);

		$bo_task_info = $this->Buyerorder_model->get_buyer_order_task_by_id($task_id);
		$receiver = "";
	    if ($_SESSION['admindata']['user_id'] == $bo_task_info->assigned_to) {
	    	$receiver = $bo_task_info->created_by;
	    }
	    else if($_SESSION['admindata']['user_id'] == $bo_task_info->created_by) {
	    	$receiver = $bo_task_info->assigned_to;
	    }
		$commentor_name = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$commentor.'"');
		$receiver_name = common_get_col_name_by_col_id('u.name', 'users u', 'u.user_id = "'.$receiver.'"');
		$task_title = $bo_task_info->task;
		$cre_time = date('Y-m-d H:i:s');

		$get_notification_type_by_id = $this->Lead_model->get_notification_type_by_id(4);

		$content = $get_notification_type_by_id->content;

		$taken_user_name = '<b class="text-green">'.ucfirst($commentor_name).'</b>';
	    $alloc_user_name = '<b class="text-green">'.$receiver_name.'</b> ';
	    $task_name = '<b class="text-orange">'.$task_title.'</b>';
	    $bo_code = '<b class="text-orange">'.$bo_info_by_id->buyer_order_invoice_no.'</b>';
	    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($cre_time)).'</b> ';
	    

	    $content = str_replace('#Commentor#',$taken_user_name, $content);
	    $content = str_replace('#Task_name#',$task_name, $content);
	    $content = str_replace('#Commented_date#',$cre_date, $content);
	    $content = str_replace('#Receiver#',$alloc_user_name, $content);
	    $content = str_replace('#Bo_code#', $bo_code, $content);
	    $notification_content = '<div id="noti1" style="cursor:pointer;background-color:#e6f2fe;" class="m-list-timeline__item" onclick="read_single_notification(1,1);">
		   <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
		   <span class="m-list-timeline__text">
		      <p>'.$content.'</p>
		   </span>
		   <span class="m-list-timeline__time">'.time_elapsed_string_in_helper($cre_time).'</span>
		</div>';
	    echo $notification_content.'~'.$receiver;
	}
	public function change_dtrange_val()
	{
		$raw_date = $this->input->post('value');
		$date_format =common_date_format();
		$changed_date = date($date_format,strtotime($raw_date));
		echo $changed_date;
	}
	public function get_id_by_name_in_js()
	{
		$id = $this->input->post('id');
		$table_name = $this->input->post('table_name');
		$name_col = $this->input->post('name_col');
		$id_col = $this->input->post('id_col');
		
		$arrid = implode(',', $id);
		if(count($id)>1)
			echo column_name_by_multi_id($table_name, $id_col, $arrid, $name_col);	
		else
			echo column_name_by_id($table_name, $id_col, $id, $name_col);
	}
	public function export_product_info()
	{
		$industry_id = $this->input->post('exp_pro_industry_val');
	  	if ($industry_id != '') {
	  		$industry_filt = " AND p.industry_id = '$industry_id'";
	  	}
	  	else {
	  		$industry_filt = ""; 		
	  	}
		$objPHPExcel = new PHPExcel();
	    $activeSheet = $objPHPExcel->getActiveSheet();
	    $styleArray = array(
	            'font' => array(
	                'bold' => true,
	                'color' => array('rgb' => '000000')
	            )/*,
	            'alignment' => array(
	                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	            )*/
	        );

	    
	    $lead_exp = $this->input->post('product_export');
	    $get_all_leads = $this->Lead_model->get_all_product_for_expo($industry_filt);
	    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
	    for ($i=0; $i < count($lead_exp); $i++) { 
		    $objPHPExcel->getActiveSheet()->setCellValue($alpha[$i]."1", $lead_exp[$i]);
		    $objPHPExcel->getActiveSheet()->getStyle($alpha[$i].'1')->applyFromArray($styleArray);
		    $j=2;
		    foreach ($get_all_leads as $key => $lead_info) {
		    	if ($lead_exp[$i] == 	'Product Name') {
		    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['product_name']);
		    	}
		    	elseif ($lead_exp[$i] == 'Industry Name') {
		    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['industry_name']);	
		    	}
		    	elseif ($lead_exp[$i] == 'Description') {
		    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['description']);	
		    	}
		    	elseif ($lead_exp[$i] == 'Product Emails') {
		    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['product_emails_group']);	
		    	}
		    	elseif ($lead_exp[$i] == 'Product Users') {
		    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, $lead_info['product_users_group']);	
		    	}
		    	elseif ($lead_exp[$i] == 'Product For') {
		    		$objPHPExcel->getActiveSheet()->setCellValue($alpha[$i].''.$j, ($lead_info['for_lead'] == 1) ? 'Lead' : 'Vendor');	
		    	}
		    	
		    	$j++;
		    }
		}
	    
	    // $objWorkSheet->setTitle("Lead Information");
	    $filename='Product_info_'.date('Y-m-d_H-i-s').'.xlsx'; //save our workbook as this file name
	    header('Content-Type: application/vnd.ms-excel'); //mime type
	    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	    header('Cache-Control: max-age=0'); //no cache

	    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	    //if you want to save it as .XLSX Excel 2007 format
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
	    $objPHPExcel->setActiveSheetIndex(0);

	    if (ob_get_contents()) ob_end_clean();
	        //force user to download the Excel file without writing it to server's HD
	        $objWriter->save('php://output'); 
	}
	public function lead_task($id)
	{
		$data['lead_task_list'] = $this->Lead_model->get_lead_task_list($id);
	  	$data['lead_details'] = $this->Lead_model->lead_by_id($id);
	  	$data['contact_book_info'] = $this->Lead_model->contact_book_info_by_id($data['lead_details']->contact_book_id);
	  	$data['user_list'] = $this->Buyerorder_model->get_user_list();
	  	$data['lead_id'] = $id;
	  	$data['login_id']=$_SESSION['admindata']['user_id'];
	  	$this->load->view('lead/lead_task',$data);
	}
	public function create_lead_task()
	{
		$lead_task_id = $this->Lead_model->lead_task_next_auto_id();
	  	$botdt = explode('/', $this->input->post('lead_task_date'));
	    $data['lead_task_date'] = $botdt[2].'-'.$botdt[0].'-'.$botdt[1];
	    $data['task'] = $this->input->post('task');
	    $data['assigned_to'] = $this->input->post('assigned_to');
	    $botedt = explode('/', $this->input->post('lead_task_end_date'));
	    $data['lead_task_end_date'] = $botedt[2].'-'.$botedt[0].'-'.$botedt[1];
	    $boid = $data['lead_id'] = $this->input->post('lead_id');    
		$data['created_on'] = date('Y-m-d H:i:s');
		$data['created_by'] = $_SESSION['admindata']['user_id'];
	    $result = $this->Lead_model->create_lead_task($data);

	    $data_n['notification_type_id'] = "7";
		$data_n['lead_task_id'] = $lead_task_id->AUTO_INCREMENT;
		$data_n['notification_allow_to'] = $this->input->post('assigned_to');
		$data_n['created_by'] = $_SESSION['admindata']['user_id'];
		$data_n['created_on'] = date('Y-m-d H:i:s');

		$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
	    if ($result) {
	      $this->session->set_flashdata('qstage_success', 'Lead Task has been Added successfully');
	    }
	    else{
	      $this->session->set_flashdata('qstage_err', 'Something went wrong');
	    }
	    redirect('/leads/lead_task/'.$boid);
	}
	public function task_remarks()
	{
		$ltid = $_POST['botid'];
		$data['botask'] = $this->Lead_model->get_lead_task_by_id($ltid);
		$this->load->view('lead/task_remarks',$data);
	}
	public function update_task_remarks()
	{
		$boid = $this->input->post('lead_id');
	  	$data['lead_task_id'] = $this->input->post('lead_task_id');
	  	$data['remarks'] = $this->input->post('remarks');
	  	$data['status'] = $this->input->post('status');
		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['modified_by'] = $_SESSION['admindata']['user_id'];

		$result = $this->Lead_model->update_lead_task($data);
		$bo_task_info = $this->Lead_model->get_lead_task_by_id($data['lead_task_id']);
		$noti_alow_to = "";
	    if ($_SESSION['admindata']['user_id'] == $bo_task_info->assigned_to) {
	    	$noti_alow_to = $bo_task_info->created_by;
	    }
	    else if($_SESSION['admindata']['user_id'] == $bo_task_info->created_by) {
	    	$noti_alow_to = $bo_task_info->assigned_to;
	    }

		$data_n['notification_type_id'] = "8";
		$data_n['lead_task_id'] = $data['lead_task_id'];
		$data_n['notification_allow_to'] = $noti_alow_to;
		$data_n['created_by'] = $_SESSION['admindata']['user_id'];
		$data_n['created_on'] = date('Y-m-d H:i:s');

		$save_notification = $this->Lead_model->add_lead_notification_save($data_n);
	    if ($result) {
	    	$this->Lead_model->create_lead_task_remarks($data);
	      $this->session->set_flashdata('qstage_success', 'Lead Task has been Updated successfully.');
	    }
	    else{
	      $this->session->set_flashdata('qstage_err', 'Something went wrong');
	    }
	    redirect('/leads/lead_task/'.$boid);
	}
	public function task_remarks_list()
	{
		$botid = $_POST['botid'];
		$data['botask'] = $this->Lead_model->get_lead_task_by_id($botid);
		$data['botask_rem'] = $this->Lead_model->get_lead_task_remarks_by_botid($botid);
		$this->load->view('lead/task_remarks_list',$data);
	}
	public function lead_contact_person_phone_no_exits()
	{
		$phone = $this->input->post('contact_person_phone');
		$get_common_values = common_select_values('*','contact_persons','contact_person_phone = "'.$phone.'"','row');
		if (count($get_common_values) > 0) {
			echo '1';
		}
		else {
			echo '0';
		}
	}
	public function lead_contact_person_email_exits()
	{
		$email = $this->input->post('contact_person_email');
		$get_common_values = common_select_values('*','contact_persons','contact_person_email = "'.$email.'"','row');
		if (count($get_common_values) > 0) {
			echo '1';
		}
		else {
			echo '0';
		}
	}
	public function add_whatsapp_conversation()
	{
        $abspath = getcwd();
        $filePondArray = $_POST['whatsapp_attach'];
        $numFilePondObjects = sizeof($filePondArray);
        $get_all_file_name = [];
        if($numFilePondObjects > 0)
        {
          if (!is_dir('assets/whatsapp_attach/')) 
            {
              mkdir('./assets/whatsapp_attach/', 0777, TRUE);
            }
            
          $baseFileLocation = './assets/whatsapp_attach/';
          for ($xx=0; $xx<$numFilePondObjects; $xx++)
          {
            $thisFilePondJSON_object = $filePondArray[$xx];
            $thisFilePondArray = json_decode($thisFilePondJSON_object, true);
            $thisFilePondArray_picData = $thisFilePondArray['data'];
            $thisFilePondArray_numPics = sizeof($thisFilePondArray_picData);
            $ext = pathinfo($thisFilePondArray['name'], PATHINFO_EXTENSION);
            $thisPic_name_temp = date('m').date('d').rand().$_SESSION['admindata']['user_id'].'.'.$ext;
            $thisPic_encodedData = $thisFilePondArray_picData;
            $thisPic_decodedData = base64_decode($thisPic_encodedData);
            $thisPic_fullPathAndName = $baseFileLocation . $thisPic_name_temp; 
            file_put_contents($abspath.$thisPic_fullPathAndName, $thisPic_decodedData);
            $get_all_file_name[] = $thisPic_name_temp;
          }
          if (count($get_all_file_name) > 0) {
              $imp_attach = implode(',', $get_all_file_name);
          }
          else {
            $imp_attach = '';
          }
        }
        else {
          $imp_attach = '';
        }
          $message = $this->input->post('whatsapp_messages');
          $lead_id = $this->input->post('message_lead_id');
          $c_by = $_SESSION['admindata']['user_id'];
          $c_on = date('Y-m-d H:i:s');
          $message_insert_columns = 'lead_id, messages, attachments, created_on, created_by';
          $message_insert_values = "'".$lead_id."', '".$message."', '".$imp_attach."', '".$c_on."' , '".$c_by."'";
          

        
          
          common_insert_values($message_insert_columns, 'lead_whatsapp_messages', $message_insert_values);

          $added_from = ($this->input->post('msg_from_list_or_view')) ? $this->input->post('msg_from_list_or_view') : '';
          // $agent_creator_info = common_select_values('*', 'agent', 'agent_id = "'.$agent_id.'"','row');
          // $agent_creator = $agent_creator_info->created_by;

          if($added_from == ''){
          	$this->session->set_flashdata('l_view_success', 'WhatsApp Messages has been Added successfully.');
          	redirect('/leads/lead_view/'.$lead_id);
      	  }
      	  else {
      	  	$this->session->set_flashdata('l_success', 'WhatsApp Messages has been Added successfully.');
          	redirect('/leads');
      	  }

        
    }
    public function get_whatsapp_conversation_by_id()
    {
    	$wm_id = $this->input->post('wm_id');

    	$data['get_whatsapp_conversations'] = common_select_values('*','lead_whatsapp_messages','lead_whatsapp_message_id = "'.$wm_id.'"','row');

    	$this->load->view('lead/lead_view_whatsapp_messages',$data);
    }

    public function get_lead_whatsapp_conversation_by_lead_id()
    {
    	$data['lead_id'] = $lead_id = $this->input->post('lead_id');

    	$data['whatsapp_view_from'] = $this->input->post('view_from');
    	$data['get_whatsapp_conversation'] = common_select_values('*','lead_whatsapp_messages','lead_id = "'.$lead_id.'" ORDER BY lead_whatsapp_message_id DESC','result');
    	$this->load->view('lead/lead_whatsapp_conversation',$data);

    }
    public function oppo_upload_file()
	{
		// echo "hello";
	 //    die();
	    $objPHPExcel = new PHPExcel();
	    $activeSheet = $objPHPExcel->getActiveSheet();
	    $styleArray = array(
	            'font' => array(
	                'bold' => true,
	                'color' => array('rgb' => '000000')
	            )/*,
	            'alignment' => array(
	                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	            )*/
	        );
	    
	    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Lead Name(*)');
	    $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
	    
	    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Company Name');
	    $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
	   
	    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Country(*)');
	    $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
	   
	    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Designation');
	    $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
	   
	    $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Website');
	    $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Address');
	    $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Primary Email ID(*)');
	    $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Alternate Email ID');
	    $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Skype ID');
	    $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Contact No');
	    $objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Whatsapp No');
	    $objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Office Contact No');
	    $objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Product(*)');
	    $objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray($styleArray);

	    // $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Industry');
	    // $objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Sub Lead Source(*)');
	    $objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Priority(*)');
	    $objPHPExcel->getActiveSheet()->getStyle('O1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Opportunity Status(*)');
	    $objPHPExcel->getActiveSheet()->getStyle('P1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Assigned To(*)');
	    $objPHPExcel->getActiveSheet()->getStyle('Q1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Message');
	    $objPHPExcel->getActiveSheet()->getStyle('R1')->applyFromArray($styleArray);

	    $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Created On');
	    $objPHPExcel->getActiveSheet()->getStyle('S1')->applyFromArray($styleArray);

	    $objWorkSheet = $objPHPExcel->createSheet('2');
	    $objPHPExcel->setActiveSheetIndex(1)->getRowDimension(1)->setRowHeight(20);
	    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('A')->setWidth(20);
	    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A1', 'Country');
	    $objPHPExcel->setActiveSheetIndex(1)->getStyle('A1')->applyFromArray($styleArray);
	    $ty = "";
	    $i  = 2;
	    $j  = 1;

	    $country_lists = $this->Lead_model->country_list(); 

	    // print_r($country_lists);
	    // die();
	    foreach($country_lists as $country_list)
	    {     
	      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$i, $country_list->name);
	      $i++;
	      $j++;      
	    }

	    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('B')->setWidth(20);
	    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B1', 'Products');
	    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B1')->applyFromArray($styleArray);
	    $ty = "";
	    $i  = 2;
	    $j  = 1;

	    $products = $this->Product_model->lead_product_list(); 

	    foreach($products as $product)
	    {     
	      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$i, $product->product_name);
	      $i++;
	      $j++;      
	    }

	    // $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('C')->setWidth(20);
	    // $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C1', 'Industry');
	    // $objPHPExcel->setActiveSheetIndex(1)->getStyle('C1')->applyFromArray($styleArray);
	    // $ty = "";
	    // $i  = 2;
	    // $j  = 1;

	    // $industry_lists = $this->Setting_model->industry_list();; 

	    // foreach($industry_lists as $industry_list)
	    // {     
	    //   $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$i, $industry_list->industry_name);
	    //   $i++;
	    //   $j++;      
	    // }

	    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('D')->setWidth(20);
	    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D1', 'Sub Lead Source');
	    $objPHPExcel->setActiveSheetIndex(1)->getStyle('D1')->applyFromArray($styleArray);
	    $ty = "";
	    $i  = 2;
	    $j  = 1;

	    $lead_source_lists = $this->Lead_model->sub_lead_source_list(); 

	    foreach($lead_source_lists as $lead_source_list)
	    {     
	    	if ($lead_source_list->status == 0) {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$i, $lead_source_list->sub_lead_source);
				$i++;
				$j++;      
			}
	    }

	    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('E')->setWidth(20);
	    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E1', 'Priority');
	    $objPHPExcel->setActiveSheetIndex(1)->getStyle('E1')->applyFromArray($styleArray);
	    $ty = "";
	    $i  = 2;
	    $j  = 1;

	    $lead_type_lists = $this->Lead_model->lead_type_list(); 

	    foreach($lead_type_lists as $lead_type_list)
	    {    
	      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$i, $lead_type_list->lead_type);
	      $i++;
	      $j++;      
	    }

	    
	    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('F')->setWidth(20);
	    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F1', 'Assigned Users');
	    $objPHPExcel->setActiveSheetIndex(1)->getStyle('F1')->applyFromArray($styleArray);
	    $ty = "";
	    $i  = 2;
	    $j  = 1;

	    $user_lists = $this->User_model->get_user_list_info(); 

	    foreach($user_lists as $user_list)
	    {   
	    $name= ''; 
	    //$name = $user_list->name.'-'.$user_list->role_name;  
	    $name = $user_list->name; 
	      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$i, $name);
	      $i++;
	      $j++;      
	    }

	    $objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('G')->setWidth(20);
	    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G1', 'Opportunity Status');
	    $objPHPExcel->setActiveSheetIndex(1)->getStyle('G1')->applyFromArray($styleArray);
	    $ty = "";
	    $i  = 2;
	    $j  = 1;

	    $lead_status_details = common_select_values('*','oppo_status','status = 0','result');

	    foreach($lead_status_details as $lead_status_detail)
	    {  
	      $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$i, $lead_status_detail->oppo_status);
	      $i++;
	      $j++;      
	    }

	    $objWorkSheet->setTitle("Dropdown Information");
	    $filename='Sample_Opportunity_Upload_File.xls'; //save our workbook as this file name
	    header('Content-Type: application/vnd.ms-excel'); //mime type
	    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	    header('Cache-Control: max-age=0'); //no cache

	    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	    //if you want to save it as .XLSX Excel 2007 format
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
	    $objPHPExcel->setActiveSheetIndex(0);


	    if (ob_get_contents()) ob_end_clean(); 
	    	
	        //force user to download the Excel file without writing it to server's HD
	        $objWriter->save('php://output');  
	}

	public function oppo_bulk_import_update()
  	{		
		    PHPExcel_IOFactory::createReader('Excel2007');
		    $filename=$_FILES["lead_import"]["tmp_name"];
		    if($_FILES["lead_import"]["size"] > 0)
		    {
		        try
		        {
		          $objPHPExcel = PHPExcel_IOFactory::load($filename);
		        }catch(Exception $e)
		        {
		          die('Error loading file "'.pathinfo($filename,PATHINFO_BASENAME).'": '.$e->getMessage());
		        }

		        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

			// echo $arrayCount;exit;
		       
		     //   $ins=0;$alr=0; $emptrow=1;
		       
		        if(trim($allDataInSheet[1]["A"])=='Lead Name(*)' && trim($allDataInSheet[1]["C"])=='Country(*)' 
		        	&& trim($allDataInSheet[1]["G"])=='Primary Email ID(*)' && trim($allDataInSheet[1]["M"])=='Product(*)' && trim($allDataInSheet[1]["N"])=='Sub Lead Source(*)' && trim($allDataInSheet[1]["O"])=='Priority(*)' && trim($allDataInSheet[1]["P"])=='Opportunity Status(*)' && trim($allDataInSheet[1]["Q"])=='Assigned To(*)' && trim($allDataInSheet[1]["R"])=='Message' && trim($allDataInSheet[1]["S"])=='Created On')
		        { 
		          $emptrow  = ""; $errmsg = ""; $l_name_err = ""; $country_err = ""; $email_err = ''; $prd_err = ""; $l_source_err = ''; $l_type_err = ""; $l_status_err = ""; 
		          $l_assign_err = ""; $row_err = '';

		            if($arrayCount > 1)
		            {
		            	for($i=2;$i<=$arrayCount;$i++)
			            {
			            	$ex_contact_book_id = '';
				            if(trim($allDataInSheet[$i]["A"]) != '')
				            {
				                $data['lead_name'] = trim($allDataInSheet[$i]["A"]); 
				            }else{
			                  $data['lead_name'] = '';
			                  $errmsg = "1";
			                  $l_name_err .= "'$i',";
				            } 

				            if(trim($allDataInSheet[$i]["B"])!='')
				            {
				                $data['company_name'] = str_replace("'", "`", trim($allDataInSheet[$i]["B"]));
				            }
				            else
				            {
				                $data['company_name'] = '';
				            }

				            if(trim($allDataInSheet[$i]["C"])!='')
				            {
				                // To check menu item already exits or not
				                $country_details = $this->Lead_model->country_id(trim($allDataInSheet[$i]["C"]));

				                if(!empty($country_details))
				                {
				                    $data['country'] = $country_details->id; 
				                }
				                else
				                {
				                    $data['country'] = '';
				                    $errmsg = "1";
				                	$country_err .= "'$i',";
				                }
				            }
				            else
				            {
				                $data['country'] = '';
				                $errmsg = "1";
				                $country_err .= "'$i',";
				            }

				             if(trim($allDataInSheet[$i]["D"])!='')
				              {
				                $data['designation'] = trim($allDataInSheet[$i]["D"]);
				              }
				              else
				              {
				                $data['designation'] = '';
				              }

				              if(trim($allDataInSheet[$i]["E"])!='')
				              {
				                 $data['website'] = trim($allDataInSheet[$i]["E"]);
				              }
				              else
				              {
				                $data['website'] = '';
				              }

				              if(trim($allDataInSheet[$i]["F"])!='')
				              {
				                 $data['address'] = str_replace("'", "`", trim($allDataInSheet[$i]["F"]));
				              }
				              else
				              {
				                $data['address'] = '';
				              } 

				              if(trim($allDataInSheet[$i]["G"])!='')
				              {
				              	$check_c_no = common_select_values('*', 'contact_book', ' email_id= "'.trim($allDataInSheet[$i]["G"]).'" AND status != 2', 'row');
				                 //$data['email_id'] = trim($allDataInSheet[$i]["G"]);
				              	if(empty($check_c_no))
				              	{
				                 	$data['email_id'] = trim($allDataInSheet[$i]["G"]);
				             	}
				             	else
				             	{
				             		$ex_contact_book_id = $check_c_no->contact_book_id;
				             		$data['email_id'] = $check_c_no->email_id;
				             		// $data['email_id'] = '';
					              //   $errmsg = "1";
					              //   $email_err .= "'$i',";
				             	}
				              }
				              else
				              {
				                $data['email_id'] = '';
				                $errmsg = "1";
				                $email_err .= "'$i',";
				              } 

				              if(trim($allDataInSheet[$i]["H"])!='')
				              {
				                 $data['alternative_email_id'] = trim($allDataInSheet[$i]["H"]);
				              }
				              else
				              {
				                $data['alternative_email_id'] = '';
				              } 

				              if(trim($allDataInSheet[$i]["I"])!='')
				              {
				                 $data['skype_id'] = trim($allDataInSheet[$i]["I"]);
				              }
				              else
				              {
				                $data['skype_id'] = '';
				              } 

				              if(trim($allDataInSheet[$i]["J"])!='')
				              {
				                 $data['contact_no'] = trim($allDataInSheet[$i]["J"]);
				              }
				              else
				              {
				                $data['contact_no'] = '';
				              } 

				              if(trim($allDataInSheet[$i]["K"])!='')
				              {
				                 $data['whatsapp_no'] = trim($allDataInSheet[$i]["K"]);
				              }
				              else
				              {
				                $data['whatsapp_no'] = '';
				              }

				              if(trim($allDataInSheet[$i]["L"])!='')
				              {
				                 $data['office_phone_no'] = trim($allDataInSheet[$i]["L"]);
				              }
				              else
				              {
				                $data['office_phone_no'] = '';
				              }

				              if(trim($allDataInSheet[$i]["M"])!='')
				              {
				              	$product_details = $this->Product_model->product_id_by_name(trim($allDataInSheet[$i]["M"]));

				              	if(!empty($product_details))
				                {
				                	if($ex_contact_book_id != '') {
				                    	$product_id = $product_details->product_id; 
				                    	$industry_id = $product_details->industry_id; 
				                    	$chk_with_lead_contact_book_has_same_product = common_select_values('*','leads','contact_book_id = "'.$ex_contact_book_id.'" AND product_id = "'.$product_id.'"','row');
				                    	if (count($chk_with_lead_contact_book_has_same_product) > 0) {
				                    		// echo "same product already exist";
				                    		$data1['product_id'] = ''; 
						                    $data1['industry_id'] = ''; 
						                    $errmsg = "1"; 
						                    $prd_err .= "'$i',"; 
				                    	}
				                    	else {
				                    		$data1['product_id'] = $product_details->product_id; 
						                    $data1['industry_id'] = $product_details->industry_id; 
				                    	}
				                    } else {
				                    	$data1['product_id'] = $product_details->product_id; 
				                    	$data1['industry_id'] = $product_details->industry_id; 
				                    }
				                }else {
				                    $data1['product_id'] = '';
				                    $data1['industry_id'] = ''; 
				                    $errmsg = "1";
				                    $prd_err .= "'$i',";
				                }
				              }
				              else
				              {
				                $data1['product_id'] = '';
				                $data1['industry_id'] = ''; 
				                $errmsg = "1";
				                $prd_err .= "'$i',";
				              }

				              if(trim($allDataInSheet[$i]["N"])!='')
				              {
				              	$source_details = common_select_values('sub_lead_source_id', 'sub_lead_source', 'sub_lead_source = "'.trim($allDataInSheet[$i]["N"]).'"', 'row');

				              	if(!empty($source_details))
				                {
				                    $data1['lead_source_id'] = $source_details->sub_lead_source_id; 
				                }else{
				                    $data1['lead_source_id'] = '';
				                    $errmsg = "1";
				              		$l_source_err .= "'$i',";
				                }
				              }
				              else
				              {
				                $data1['lead_source_id'] = '';
				                $errmsg = "1";
				                $l_source_err .= "'$i',";
				              }

				              if(trim($allDataInSheet[$i]["O"])!='')
				              {
				              	$type_details = common_select_values('lead_type_id', 'lead_type', 'lead_type = "'.trim($allDataInSheet[$i]["O"]).'"', 'row');

				              	if(!empty($type_details))
				                {
				                    $data1['lead_type_id'] = $type_details->lead_type_id; 
				                }else{
				                    $data1['lead_type_id'] = '';
				                    $errmsg = "1";
				              		$l_type_err .= "'$i',";
				                }
				              }
				              else
				              {
				                $data1['lead_type_id'] = '';
				                $errmsg = "1";
				                $l_type_err .= "'$i',";
				              }
				              
				              if(trim($allDataInSheet[$i]["P"])!='')
				              {
				              	$status_details = common_select_values('oppo_status_id', 'oppo_status', 'oppo_status = "'.trim($allDataInSheet[$i]["P"]).'"', 'row');

				              	if(!empty($status_details))
				                {
				                    $data1['lead_status_id'] = $status_details->oppo_status_id; 
				                }else{
				                    $data1['lead_status_id'] = '';
				                    $errmsg = "1";
				                    $l_status_err .= "'$i',";
				                }
				              }
				              else
				              {
				                $data1['lead_status_id'] = '';
				                $errmsg = "1";
				                $l_status_err .= "'$i',";
				              }

				              if(trim($allDataInSheet[$i]["Q"])!='')
				              {
				              	$user_details = common_select_values('user_id', 'users', 'name = "'.trim($allDataInSheet[$i]["Q"]).'"', 'row');

				              	if(!empty($user_details))
				                {
				                    $data1['lead_assigned_to'] = $user_details->user_id; 
				                }else{
				                    $data1['lead_assigned_to'] = '';
				                    $errmsg = "1";
				              		$l_status_err .= "'$i',";
				              		
				                }
				              }
				              else
				              {
				                $data1['lead_assigned_to'] = '';
				                $errmsg = "1";
				                $l_assign_err .= "'$i',";
				                
				              }

				              if(trim($allDataInSheet[$i]["R"])!='')
				              {
				                 $trim_rmv = trim($allDataInSheet[$i]["R"]);
				                 $data1['message'] = str_replace("'", "`", $trim_rmv);
				              }
				              else
				              {
				                $data1['message'] = '';
				              }
				              if(trim($allDataInSheet[$i]["S"])!='')
				              { 
				                 $formated_datetime = date('Y-m-d H:i:s',strtotime(trim($allDataInSheet[$i]["S"])));
				                 $data1['created_on'] = $formated_datetime;
				                 $data['created_on'] = $formated_datetime;
				              }
				              else
				              {
				                $data1['created_on'] = date('Y-m-d H:i:s');
				              }
				            $data1['created_by'] = $_SESSION['admindata']['user_id'];
				            $data['created_by'] = $_SESSION['admindata']['user_id'];

				            


							if($data['lead_name'] != '' && $data['country']!='' && $data['email_id']!='' && $data1['product_id']!='' && $data1['lead_source_id']!='' && $data1['lead_type_id']!='' && $data1['lead_status_id']!='' && $data1['lead_assigned_to']!='')
							{
								$lead_id = '';
								$lead_id = $this->Lead_model->lead_next_auto_id();
								if($ex_contact_book_id == ''){
									$add_contact_info = $this->Lead_model->add_new_contact_info($data);
								}
								else {
									$add_contact_info = $ex_contact_book_id;
								}
								$data1['cont_book_id_for_lead'] = $add_contact_info;
								$data1['lead_code'] = date('Y').''.date('m').''.'00'.$lead_id->AUTO_INCREMENT;
								$data1['status'] = '3';
								$lead_result = $this->Lead_model->lead_save($data1);

								$log_data['lead_id'] = $lead_id->AUTO_INCREMENT;
								$log_data['log_type'] = 1;
								$log_data['log_details'] = $data['lead_name'].' has been created as new opportunity';
								$log_data['created_by'] = $_SESSION['admindata']['user_id'];
								$log_data['created_on'] = date('Y-m-d H:i:s');
								// $lead_log_result = $this->Lead_model->lead_log_save($log_data);
							}
							else {
								$errmsg = "1";
								$data['lead_name'].'<br>';
					            $data['country'].'<br>';
					            $data['email_id'].'<br>';
					            $data['product_id'].'<br>';
					            $data['lead_source_id'].'<br>';
					            $data['lead_type_id'].'<br>';
					            $data['lead_status_id'].'<br>';
					            $data['lead_assigned_to'].'<br>';
								$row_err .= "'$i',";
							}
			            
			        	}// End for loop
		            }
		            else{
		            	$emptrow = 2;
		            }
		        ?>
		         <html>
	                    <head>
	                    <style>
	                    .code{
	                        border:1px solid blue;
	                        border-left:10px solid #ccc;
	                        background:#eee;
	                      
	                        padding:5px;
	                        margin:5px;
	                        overflow-x: hidden;
	                    }
	                    .alert {
	                        padding: 20px;
	                        background-color: #f44336;
	                        color: white;
	                        opacity: 1;
	                        transition: opacity 0.6s;
	                        margin-bottom: 15px;
	                    }

	                    .alert.success {background-color: #4CAF50;}
	                    .alert.info {background-color: #2196F3;}
	                    .alert.warning {background-color: #ff9800;}

	                    .closebtn {
	                      
	                        margin-left: 15px;
	                        color: black;
	                        font-weight: bold;
	                        float: right;
	                        font-size: 35px;
	                        line-height: 20px;
	                        cursor: pointer;
	                        transition: 0.3s;
	                    }

	                    .closebtn:hover {
	                        color: black;
	                    }
	                    </style>
	                    </head>
	                    <body>
	                    <center>
	                    <div class="code" style="width:664px;">
	                    <a href="<?php echo base_url(); ?>Leads/opportunity_list?active_tab=1"><span style="color:black" class="closebtn">&times;</span> </a>    
	                    <?php if($emptrow !='' || $errmsg != '' || $l_name_err !='' || $country_err !='' || $email_err !='' || $prd_err !='' || $l_source_err !='' || $l_type_err !='' || $l_status_err !='' || $l_assign_err !='' || $row_err != '')
	                    { ?>
	                    	<h2>Alert Messages</h2>
	                        <?php if($l_name_err !='')
	                        {?>
		                        <div class="alert" style="width:464px;">
		                          <strong>Lead Name Issue!</strong> On these rows <?php echo trim($l_name_err,', ');?>.
		                        </div>
	                        <?php } ?>

	                        <?php if($country_err !='')
	                        {?>
		                        <div class="alert" style="width:464px;">
		                          <strong>Country Issue!</strong> On these rows <?php echo trim($country_err,', ');?>.
		                        </div>
	                        <?php } ?>

	                        <?php if($email_err !='')
	                        {?>
		                        <div class="alert" style="width:464px;">
		                          <strong>Primary Email ID Issue!</strong> On these rows <?php echo trim($email_err,', ');?>.
		                        </div>
	                        <?php } ?>

	                        <?php if($prd_err !='')
	                        {?>
		                        <div class="alert" style="width:464px;">
		                          <strong>Product Issue!</strong> On these rows <?php echo trim($prd_err,', ');?>.
		                        </div>
	                        <?php } ?>

	                        <?php if($l_source_err !='')
	                        {?>
		                        <div class="alert" style="width:464px;">
		                          <strong>Lead Source Issue!</strong> On these rows <?php echo trim($l_source_err,', ');?>.
		                        </div>
	                        <?php } ?>

	                        <?php if($l_type_err !='')
	                        {?>
		                        <div class="alert" style="width:464px;">
		                          <strong>Lead Type Issue!</strong> On these rows <?php echo trim($l_type_err,', ');?>.
		                        </div>
	                        <?php } ?>

	                        <?php if($l_status_err !='')
	                        {?>
		                        <div class="alert" style="width:464px;">
		                          <strong>Opportunity Status Issue!</strong> On these rows <?php echo trim($l_status_err,', ');?>.
		                        </div>
	                        <?php } ?>

	                         <?php if($l_assign_err !='')
	                        {?>
		                        <div class="alert" style="width:464px;">
		                          <strong>Assigned User Issue!</strong> On these rows <?php echo trim($l_assign_err,', ');?>.
		                        </div>
	                        <?php } ?>

	                         <?php if($emptrow !=''){?>
		                        <div class="alert" style="width:464px;">
		                          <strong>Empty Row Issue!</strong> On these rows <?php echo trim($emptrow,',');?>.
		                        </div>
	                        <?php } ?>

	                         <?php //if($errmsg !=''){?>
			                      <!-- <div class="alert" style="width:464px;">
			                        <strong>Issue!</strong> On these rows <?php //echo trim($errmsg,',');?>.
			                      </div> -->
	                        <?php //} ?>
	                        <?php //if($row_err !=''){?>
			                      <!-- <div class="alert" style="width:464px;">
			                        <strong>Mandatory Value Issue!</strong> On these rows <?php //echo trim($row_err,',');?>.
			                      </div> -->
	                        <?php //} ?>
	              <?php }else{ ?>
	                      <h2>Alert Messages</h2>
	                      <div class="alert success" style="width:464px;">
	                        <strong>Success!</strong> Indicates a successful Inserted Records
	                      </div>
	              <?php } ?>

	          		</div></body></center></body></html>
		    <?php }else{ 

		    	$this->session->set_flashdata('l_err', 'Invalid Column Header File.');
	      		redirect('Leads/opportunity_list?active_tab=1');
		    }
		}
	    else
	    {
	      $this->session->set_flashdata('add_err', 'Invalid File.');
	      redirect('Leads/opportunity_list?active_tab=1');
	    }
	}
	public function all_leads_list_for_search()
	{
		$data['industry_lists'] = $this->Setting_model->industry_list();
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['product_lists'] = $this->Product_model->lead_product_list();
		$data['lead_type_lists'] = $this->Lead_model->lead_type_list();
		$data['lead_source_lists'] = $this->Lead_model->lead_source_list();
		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		$data['assigned_user_lists'] = $this->Lead_model->product_assigned_users();

		$lead_type = $this->input->post('list_lead_type');
		$lead_source = $this->input->post('list_lead_source');
		$list_lsource = $this->input->post('list_lsource');
		$lead_status = $this->input->post('list_lead_status');
		$lead_country = $this->input->post('list_lead_country');
		$lead_assigned_to = $this->input->post('filt_assign_to');
		$data['selected_lead_ass'] = $lead_assigned_to;
		$data['selected_country'] = $lead_country;
		$lead_daterange = ($this->input->post('lead_list_date') != '') ? $this->input->post('lead_list_date') : '';
		$list_product = ($this->input->post('list_product') != '') ? $this->input->post('list_product') : '';

		if($this->input->post('l_year'))
		{
			$l_year = explode('-', $this->input->post('l_year'));
			$data['p_month'] = (date('m', strtotime($l_year[1]))) ? date('m', strtotime($l_year[1])) : date('m');
			$data['p_year']  = ($l_year[0]) ? $l_year[0] : date('Y');
		}
		else
		{
			$data['p_month'] =  "";
			$data['p_year']  = "";
		}
		
		$data['f_year_month'] = ($this->input->post('l_year')) ? $this->input->post('l_year') : date('Y-M');
		$data['list_lead_type'] = $this->input->post('list_lead_type');
		$data['list_lead_source'] = $this->input->post('list_lead_source');
		$data['list_lsource'] = $this->input->post('list_lsource');
		$data['lead_list_date'] = $lead_daterange;
		$data['list_lead_status'] = $this->input->post('list_lead_status');
		$data['list_product'] = $list_product;


		

		if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1){
			$t_fup = 1;
		}else if(isset($_GET['t_fup']) && $_GET['t_fup'] == 1){
			$t_fup = 1;
		}else{
			$t_fup = '';
		}
		$perpage = '';
		$page = '';
		$search_val = '';
		$data['get_all_lead_template'] = $this->Lead_model->get_filter_template_by_module('1');
		 // $data['lead_lists'] = $this->Lead_model->lead_list($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $data['p_year'], $data['p_month'], $list_product, $data['tab_val'], $lead_country, $lead_assigned_to, $page, $perpage, $search_val);
		 $data['lead_today_fup_count'] = $this->Lead_model->lead_today_followup_list($lead_type , $lead_source, $lead_daterange,$lead_status, $list_product, $data['tab_val'],$list_lsource);
		 $data['today_leads'] = $this->Lead_model->lead_count_by_date($date = date('Y-m-d'), 0);
		 
		$this->load->view('lead/lead_search_list', $data);
	}
	public function search_lead_list_result_by_filters()
	{
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';

		$data['lead_lists_count'] = $this->Lead_model->search_lead_list_count($search_val);
		$data['lead_lists'] = $this->Lead_model->search_lead_list($page, $perpage, $search_val);
		// print_r($data['lead_lists_count']);
		// die();
		$this->load->view('lead/lead_search_list_table',$data);

	}
	public function get_email_signature_into_content()
	{
		$email_id = $this->input->post('email_id');
		// echo $email_id;
		$email_info = common_select_values('*','email_details','email_ID = "'.$email_id.'"','row');
		if($email_info->signature != '') {
			$signature = '<br><br>';
			$signature .= $email_info->signature;
		}
		else {
			$signature = '';
		}
		echo $signature;
	}




}
?>
