<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* ************************************************************************************
		Purpose : To handle all report functions
		Date    : 28-02-2020 
***************************************************************************************/
class Reports extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Report_model','Setting_model','Lead_model','Dashboard_model'));
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
						Purpose : To handle Lead Report Functions
	        **********************************************************************/
	public function index()
	{
		$this->load->view('lead_report/lead_source_report');
	}
	// To get lead source daily report
	public function lead_source_daily_report()
	{
		$year_month = date('Y-m', strtotime($this->input->post('value')));
		$ex_val = explode('-', $year_month);
		$no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
		$data['lead_source_lists'] = $this->Report_model->lead_source_daily_report($year_month, $no_of_days_in_month);
		// $data['get_all_lead_source'] = $this->Lead_model->lead_source_list();
		
		$data['no_of_days_in_month'] = $no_of_days_in_month;
		$data['f_year_month'] = $year_month;
		// $data['lead_source_daily_counts']  = $this->Report_model->lead_source_daily_count_report($year_month, $no_of_days_in_month);
		$this->load->view('lead_report/lead_source_daily_report', $data);
	}
	public function graph_lead_source_daily_report()
	{
		$year_month = date('Y-m', strtotime($this->input->post('month_year')));
		$ex_val = explode('-', $year_month);
		$year = $ex_val[0];
		$month = $ex_val[1];
		$no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
		$lead_source_lists = $this->Report_model->lead_source_daily_report($year_month, $no_of_days_in_month);
		$ls_count_arr = array();
		$symbols = array('circle','square','diamond','triangle','triangle-down');
		
		foreach ($lead_source_lists as $ls) {
			$rand_ind = array_rand($symbols);
			if ($no_of_days_in_month == '31') {
				$ls_count_arr[] = array('name'=> $ls['lead_source'].'-'.$ls['sub_lead_source'],'marker' => array('symbol'=>$symbols[$rand_ind]),'data'=> array($ls['01'], $ls['02'], $ls['03'], $ls['04'], $ls['05'], $ls['06'], $ls['07'], $ls['08'], $ls['09'], $ls['10'], $ls['11'], $ls['12'], $ls['13'], $ls['14'], $ls['15'], $ls['16'], $ls['17'], $ls['18'], $ls['19'], $ls['20'], $ls['21'], $ls['22'], $ls['23'], $ls['24'], $ls['25'], $ls['26'], $ls['27'], $ls['28'], $ls['29'], $ls['30'], $ls['31']));
			}
			else if ($no_of_days_in_month == '30') {
				$ls_count_arr[] = array('name'=> $ls['lead_source'].'-'.$ls['sub_lead_source'],'marker' => array('symbol'=>$symbols[$rand_ind]),'data'=> array($ls['01'], $ls['02'], $ls['03'], $ls['04'], $ls['05'], $ls['06'], $ls['07'], $ls['08'], $ls['09'], $ls['10'], $ls['11'], $ls['12'], $ls['13'], $ls['14'], $ls['15'], $ls['16'], $ls['17'], $ls['18'], $ls['19'], $ls['20'], $ls['21'], $ls['22'], $ls['23'], $ls['24'], $ls['25'], $ls['26'], $ls['27'], $ls['28'], $ls['29'], $ls['30']));
			}
			else if ($no_of_days_in_month == '29') {
				$ls_count_arr[] = array('name'=> $ls['lead_source'].'-'.$ls['sub_lead_source'],'marker' => array('symbol'=>$symbols[$rand_ind]),'data'=> array($ls['01'], $ls['02'], $ls['03'], $ls['04'], $ls['05'], $ls['06'], $ls['07'], $ls['08'], $ls['09'], $ls['10'], $ls['11'], $ls['12'], $ls['13'], $ls['14'], $ls['15'], $ls['16'], $ls['17'], $ls['18'], $ls['19'], $ls['20'], $ls['21'], $ls['22'], $ls['23'], $ls['24'], $ls['25'], $ls['26'], $ls['27'], $ls['28'], $ls['29']));
			}
			else if ($no_of_days_in_month == '28') {
				$ls_count_arr[] = array('name'=> $ls['lead_source'].'-'.$ls['sub_lead_source'],'marker' => array('symbol'=>$symbols[$rand_ind]),'data'=> array($ls['01'], $ls['02'], $ls['03'], $ls['04'], $ls['05'], $ls['06'], $ls['07'], $ls['08'], $ls['09'], $ls['10'], $ls['11'], $ls['12'], $ls['13'], $ls['14'], $ls['15'], $ls['16'], $ls['17'], $ls['18'], $ls['19'], $ls['20'], $ls['21'], $ls['22'], $ls['23'], $ls['24'], $ls['25'], $ls['26'], $ls['27'], $ls['28']));
			}
				
		}
		echo json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
	}
	public function graph_lead_source_month_report()
	{
		$year = $this->input->post('year');
		
		// $no_of_month_in_year = 12;

		$ex_val = explode('-', $year);
		// echo $ex_val[0];
		// echo $ex_val[1];
		// die();
		$no_of_month_in_year = array('04-'.$ex_val[0],'05-'.$ex_val[0],'06-'.$ex_val[0],'07-'.$ex_val[0],'08-'.$ex_val[0],'09-'.$ex_val[0],'10-'.$ex_val[0],'11-'.$ex_val[0],'12-'.$ex_val[0],'01-'.$ex_val[1],'02-'.$ex_val[1],'03-'.$ex_val[1]);
		// print_r($no_of_month_in_year);
		// die();
		$lead_source_lists = $this->Report_model->lead_source_month_report($year, $no_of_month_in_year);
		$ls_count_arr = array();
		$symbols = array('circle','square','diamond','triangle','triangle-down');
		
		foreach ($lead_source_lists as $ls) {
			$rand_ind = array_rand($symbols);
			
			$ls_count_arr[] = array('name'=> $ls['lead_source'].'-'.$ls['sub_lead_source'],'marker' => array('symbol'=>$symbols[$rand_ind]),'data'=> array($ls['04'], $ls['05'], $ls['06'], $ls['07'], $ls['08'], $ls['09'], $ls['10'], $ls['11'], $ls['12'], $ls['01'], $ls['02'], $ls['03']));
		}
		echo json_encode($ls_count_arr, JSON_NUMERIC_CHECK);
	}
	// To show lead source month report
	public function lead_source_month_report()
	{
	    $year = $this->input->post('value');
		// $no_of_month_in_year = 12;

		$ex_val = explode('-', $year);
		// echo $ex_val[0];
		// echo $ex_val[1];
		// die();
		$no_of_month_in_year = array('04-'.$ex_val[0],'05-'.$ex_val[0],'06-'.$ex_val[0],'07-'.$ex_val[0],'08-'.$ex_val[0],'09-'.$ex_val[0],'10-'.$ex_val[0],'11-'.$ex_val[0],'12-'.$ex_val[0],'01-'.$ex_val[1],'02-'.$ex_val[1],'03-'.$ex_val[1]);
		// print_r($no_of_month_in_year);
		// die();
		$data['lead_source_lists'] = $this->Report_model->lead_source_month_report($year, $no_of_month_in_year);

		$data['no_of_month_in_year'] = $no_of_month_in_year;
		$data['f_year'] = $year;
		// $data['lead_source_month_counts'] = $this->Report_model->lead_source_month_count_report($year, $no_of_month_in_year);
		$this->load->view('lead_report/lead_source_month_report', $data);
	}
	public function lead_report_based_on_lead_source()
	{
		$data['lead_sources'] = $this->Lead_model->lead_source_list();
		$data['industry_lists'] = $this->Setting_model->industry_list();
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		$this->load->view('reports/product_based_lead_report/lead_based_on_product',$data);
	}
	public function get_daily_lead_report_based_on_source()
	{
		$product = $this->input->post('product');
		$data['lead_source'] = $this->input->post('lead_source');
		
		$year_month = date('Y-m', strtotime($this->input->post('month_year')));
		$ex_val = explode('-', $year_month);
		$no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
		$industry_id = $this->input->post('industry');
		if($_SESSION['admindata']['user_hasnt_product'] == 1)
		{
			if ($industry_id != '' && $product == '') {
				$data['get_all_product'] = $this->Dashboard_model->get_product_by_industry_id($industry_id);
			}
			else if($industry_id != '' && $product != '') {
				$data['get_all_product'] = $this->Dashboard_model->get_product_by_industry_id_pro_id($industry_id,$product);
				
			}
			else if($industry_id == '' && $product == ''){
				
				$data['get_all_product'] = $this->Dashboard_model->get_all_product();
			}
		}
		else {
			$userid = $_SESSION['admindata']['user_id']; 
			$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($userid);
		}
		$data['no_of_days_in_month'] = $no_of_days_in_month;
		$data['f_year_month'] = $year_month;
		$data['assign_to'] = $this->input->post('assign_person');
		// $data['lead_source_daily_counts']  = $this->Report_model->lead_source_daily_count_report($year_months, $no_of_days_in_month);
		$this->load->view('reports/product_based_lead_report/daily_product_based_lead_report',$data);	
	}
	public function get_monthly_lead_report_based_on_source()
	{
		$product = $this->input->post('product');
		$data['lead_source'] = $this->input->post('lead_source');
		
		$year = $this->input->post('year');
		
		$ex_val = explode('-', $year);
		$no_of_month_in_year = array('04-'.$ex_val[0],'05-'.$ex_val[0],'06-'.$ex_val[0],'07-'.$ex_val[0],'08-'.$ex_val[0],'09-'.$ex_val[0],'10-'.$ex_val[0],'11-'.$ex_val[0],'12-'.$ex_val[0],'01-'.$ex_val[1],'02-'.$ex_val[1],'03-'.$ex_val[1]);

		$industry_id = $this->input->post('industry');
		if($_SESSION['admindata']['user_hasnt_product'] == 1)
		{
			if ($industry_id != '' && $product == '') {
				$data['get_all_product'] = $this->Dashboard_model->get_product_by_industry_id($industry_id);
			}
			else if($industry_id != '' && $product != '') {
				$data['get_all_product'] = $this->Dashboard_model->get_product_by_industry_id_pro_id($industry_id,$product);
				
			}
			else if($industry_id == '' && $product == ''){
				
				$data['get_all_product'] = $this->Dashboard_model->get_all_product();
			}
		}
		else {
			$userid = $_SESSION['admindata']['user_id']; 
			$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($userid);
		}
		$data['no_of_month_in_year'] = $no_of_month_in_year;
		$data['f_year'] = $year;
		$data['assign_to'] = $this->input->post('assign_person');
		// $data['lead_source_daily_counts']  = $this->Report_model->lead_source_daily_count_report($year_months, $no_of_days_in_month);
		$this->load->view('reports/product_based_lead_report/monthly_product_based_lead_report',$data);	
	}
	public function oppo_index()
	{
		$this->load->view('reports/opportunity_reports/oppo_source_report');
	}
	public function oppo_source_daily_report()
	{
		$year_month = date('Y-m', strtotime($this->input->post('value')));
		$ex_val = explode('-', $year_month);
		$no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
		$data['lead_source_lists'] = $this->Report_model->oppo_source_daily_report($year_month, $no_of_days_in_month);
		$data['no_of_days_in_month'] = $no_of_days_in_month;
		$data['f_year_month'] = $year_month;
		$data['lead_source_daily_counts']  = $this->Report_model->oppo_source_daily_count_report($year_month, $no_of_days_in_month);
		$this->load->view('reports/opportunity_reports/oppo_source_daily_report', $data);
	}
	// To show lead source month report
	public function oppo_source_month_report()
	{
	    $year = $this->input->post('value');
		$no_of_month_in_year = 12;
		$data['lead_source_lists'] = $this->Report_model->oppo_source_month_report($year, $no_of_month_in_year);
		$data['no_of_month_in_year'] = $no_of_month_in_year;
		$data['f_year'] = $year;
		$data['lead_source_month_counts']  = $this->Report_model->oppo_source_month_count_report($year, $no_of_month_in_year);
		$this->load->view('reports/opportunity_reports/oppo_source_month_report', $data);
	}
	public function get_products_based_industry()
	{
		$ind_id = $this->input->post('industry_id');
		$get_pro_base_indus = $this->Dashboard_model->get_product_by_industry_id($ind_id);
		$drop_down = "<option value = ''>All Products</options>";
		foreach ($get_pro_base_indus as $pro_ind) {
			$drop_down .= "<option value = '".$pro_ind->product_id."'>".$pro_ind->product_name."</options>";
		}
		echo $drop_down;
	}
	public function get_products_based_industry_alter()
	{
		$ind_id = $this->input->post('industry_id');
		$get_pro_base_indus = $this->Dashboard_model->get_product_by_industry_id($ind_id);
		$drop_down = "";
		foreach ($get_pro_base_indus as $pro_ind) {
			$drop_down .= "<option value = '".$pro_ind->product_id."'>".$pro_ind->product_name."</options>";
		}
		echo $drop_down;
	}
	public function get_lead_sublead_source()
	{
		$get_all_lead_source = $this->Lead_model->lead_source_list();
		$drop_down = array();
		foreach ($get_all_lead_source as $key => $lead_source) {
			$drop_down[] = array('id'=>(int)$lead_source->lead_source_id,'title'=>$lead_source->lead_source);
			$get_sub_lead_source_by_ls_id = $this->Report_model->sub_lead_source_list_by_ls_id($lead_source->lead_source_id);
			if (count($get_sub_lead_source_by_ls_id) > 0) {
				$drop_down[$key]['subs']=[];
				foreach ($get_sub_lead_source_by_ls_id as $key1 => $s_lead_source) {
					array_push($drop_down[$key]['subs'], array('id' => (float)$s_lead_source->lead_source_id.'.'.$s_lead_source->sub_lead_source_id, 'title' => $s_lead_source->sub_lead_source));
				}	
			}
			
		}
		echo json_encode($drop_down);
	}
	public function graph_get_daily_lead_report_based_on_source()
	{
		$year_month = date('Y-m', strtotime($this->input->post('month_year')));
		$ex_val = explode('-', $year_month);
		$year = $ex_val[0];
		$month = $ex_val[1];
		$no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
		$lead_source = $this->input->post('lead_source');
		if ($lead_source != '') {
		    $exp_ls = explode(',', $lead_source);
		    $ls_query = '';
		    for ($i=0; $i < count($exp_ls); $i++) { 
		      if (strpos($exp_ls[$i], '.') !== false) {
		          $sls_id_ls_id = explode('.', $exp_ls[$i]);
		          $ls_query .= "le.lead_source_id = ".$sls_id_ls_id[1]." OR ";
		      }
		    }
		    $trimmed = rtrim($ls_query);
		    $get_query = rtrim($trimmed, 'OR');
		    $ls_filt= 'AND ('.$get_query.')';
		}
		else {
			$ls_filt= '';
		}
		$industry_id = $this->input->post('industry');
		$product_id = $this->input->post('product');
		$assign_person = $this->input->post('assign_person');

		$industry_id = $this->input->post('industry');
		if($_SESSION['admindata']['user_hasnt_product'] == 1) {
			if ($industry_id != '' && $product_id == '') {
				
				$get_all_product = $this->Dashboard_model->get_product_by_industry_id($industry_id);
			}
			else if($industry_id != '' && $product_id != '') {
				
				$get_all_product = $this->Dashboard_model->get_product_by_industry_id_pro_id($industry_id,$product_id);
			}
			else if($industry_id == '' && $product_id == ''){
				
				$get_all_product = $this->Dashboard_model->get_all_product();
			}
		}
		else{
			$userid = $_SESSION['admindata']['user_id'];
			$get_all_product = $this->Dashboard_model->get_products_by_user_allocated($userid);
		} 
		$product_count_arr = array();
		$symbols = array('circle','square','diamond','triangle','triangle-down');
		
		foreach ($get_all_product as $key => $product) {
			$rand_ind = array_rand($symbols);
			$l_c_pro = $this->Report_model->get_lead_count_based_product_graph($assign_person,$month,$year,$ls_filt,$product->product_id,$product->industry_id);
			$product_count_arr[] = array('name'=> $product->product_name,'marker' => array('symbol'=>$symbols[$rand_ind]),'data'=> array($l_c_pro->d1, $l_c_pro->d2, $l_c_pro->d3, $l_c_pro->d4, $l_c_pro->d5, $l_c_pro->d6, $l_c_pro->d7, $l_c_pro->d8, $l_c_pro->d9, $l_c_pro->d10, $l_c_pro->d11, $l_c_pro->d12, $l_c_pro->d13, $l_c_pro->d14, $l_c_pro->d15, $l_c_pro->d16, $l_c_pro->d17, $l_c_pro->d18, $l_c_pro->d19, $l_c_pro->d20, $l_c_pro->d21, $l_c_pro->d22, $l_c_pro->d23, $l_c_pro->d24, $l_c_pro->d25, $l_c_pro->d26, $l_c_pro->d27, $l_c_pro->d28, $l_c_pro->d29, $l_c_pro->d30, $l_c_pro->d31));
		}
		echo json_encode($product_count_arr, JSON_NUMERIC_CHECK);
		
	}
	public function graph_get_monthly_lead_report_based_on_source()
	{
		$year = $this->input->post('year');
		
		$lead_source = $this->input->post('lead_source');
		if ($lead_source != '') {
		    $exp_ls = explode(',', $lead_source);
		    $ls_query = '';
		    for ($i=0; $i < count($exp_ls); $i++) { 
		      if (strpos($exp_ls[$i], '.') !== false) {
		          $sls_id_ls_id = explode('.', $exp_ls[$i]);
		          $ls_query .= "le.lead_source_id = ".$sls_id_ls_id[1]." OR ";
		      }
		    }
		    $trimmed = rtrim($ls_query);
		    $get_query = rtrim($trimmed, 'OR');
		    $ls_filt= 'AND ('.$get_query.')';
		}
		else {
			$ls_filt= '';
		}
		$industry_id = $this->input->post('industry');
		$product_id = $this->input->post('product');
		$assign_person = $this->input->post('assign_person');

		$industry_id = $this->input->post('industry');
		if ($industry_id != '' && $product_id == '') {
			
			$get_all_product = $this->Dashboard_model->get_product_by_industry_id($industry_id);
		}
		else if($industry_id != '' && $product_id != '') {
			
			$get_all_product = $this->Dashboard_model->get_product_by_industry_id_pro_id($industry_id,$product_id);
		}
		else if($industry_id == '' && $product_id == ''){
			
			$get_all_product = $this->Dashboard_model->get_all_product();
		}
		$product_count_arr = array();
		$symbols = array('circle','square','diamond','triangle','triangle-down');
		
		foreach ($get_all_product as $key => $product) {
			$rand_ind = array_rand($symbols);
			$l_c_pro = $this->Report_model->get_month_lead_count_based_product_graph($assign_person,$year,$ls_filt,$product->product_id,$product->industry_id);
			$product_count_arr[] = array('name'=> $product->product_name,'marker' => array('symbol'=>$symbols[$rand_ind]),'data'=> array($l_c_pro->m4, $l_c_pro->m5, $l_c_pro->m6, $l_c_pro->m7, $l_c_pro->m8, $l_c_pro->m9, $l_c_pro->m10, $l_c_pro->m11, $l_c_pro->m12, $l_c_pro->m1, $l_c_pro->m2, $l_c_pro->m3));
		}
		echo json_encode($product_count_arr, JSON_NUMERIC_CHECK);
	}
	public function user_lead_report()
	{
		if($_SESSION['admindata']['user_hasnt_product'] == 1){
			$data['product_assigned_users'] = $this->Report_model->product_assigned_users();
		}
		else {
			$user_id = $_SESSION['admindata']['user_id'];
			$data['product_assigned_users'] = $this->Report_model->get_one_user_by_id($user_id);	
		}
		$this->load->view('reports/user_lead_report/user_lead_report',$data);
	}
	public function user_lead_daily_report()
	{
		$users = $this->input->post('users');
		$year_month = date('Y-m', strtotime($this->input->post('value')));
		$ex_val = explode('-', $year_month);
		$no_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $ex_val[1], $ex_val[0]);
		$data['no_of_days_in_month'] = $no_of_days_in_month;
		$data['f_year_month'] = $year_month;

		if (!empty($users)) {
			if (count($users) > 1) {
			    $ls_query = '';
			    for ($i=0; $i < count($users); $i++) { 
			          $ls_query .= "up.user_id = ".$users[$i]." OR ";
			    }
			    $trimmed = rtrim($ls_query);
			    $get_query = rtrim($trimmed, 'OR');
			    $ls_filt = "AND ($get_query)";
			    $data['user_name_with_assigned_product'] = $this->Report_model->get_product_assigned_user_by_ids($ls_filt);
			}
			else {
				$ls_filt = "AND up.user_id = '$users[0]'";
				$data['user_name_with_assigned_product'] = $this->Report_model->get_product_assigned_user_by_ids($ls_filt);
			}
		}
		else {
			$data['user_name_with_assigned_product'] = $this->Report_model->get_user_name_with_assigned_product();
		}

		
		$this->load->view('reports/user_lead_report/user_lead_daily_report',$data);
	}
	public function user_lead_month_report()
	{
		$year = $this->input->post('value');
		$users = $this->input->post('users');
		$ex_val = explode('-', $year);
		
		$no_of_month_in_year = array('04-'.$ex_val[0],'05-'.$ex_val[0],'06-'.$ex_val[0],'07-'.$ex_val[0],'08-'.$ex_val[0],'09-'.$ex_val[0],'10-'.$ex_val[0],'11-'.$ex_val[0],'12-'.$ex_val[0],'01-'.$ex_val[1],'02-'.$ex_val[1],'03-'.$ex_val[1]);
		
		if (!empty($users)) {
			if (count($users) > 1) {
			    $ls_query = '';
			    for ($i=0; $i < count($users); $i++) { 
			          $ls_query .= "up.user_id = ".$users[$i]." OR ";
			    }
			    $trimmed = rtrim($ls_query);
			    $get_query = rtrim($trimmed, 'OR');
			    $ls_filt = "AND ($get_query)";
			    $data['user_name_with_assigned_product'] = $this->Report_model->get_product_assigned_user_by_ids($ls_filt);
			}
			else {
				$ls_filt = "AND up.user_id = '$users[0]'";
				$data['user_name_with_assigned_product'] = $this->Report_model->get_product_assigned_user_by_ids($ls_filt);
			}
		}
		else {
			$data['user_name_with_assigned_product'] = $this->Report_model->get_user_name_with_assigned_product();
		}

		$data['no_of_month_in_year'] = $no_of_month_in_year;
		$data['f_year'] = $year;
		// $data['lead_source_month_counts'] = $this->Report_model->lead_source_month_count_report($year, $no_of_month_in_year);
		$this->load->view('reports/user_lead_report/user_lead_month_report', $data);
	}
	public function oppo_based_product()
	{
		$data['user_list'] = $this->Dashboard_model->get_user_list();
		$data['lead_status_lists'] = $this->Lead_model->lead_status_list();
		$data['oppo_status_lists'] = $this->Lead_model->oppo_status_list();
		$data['industry_lists'] = $this->Setting_model->industry_list();
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		$data['quarter_list'] = $this->Setting_model->quarter_year_list();
		$this->load->view('reports/oppo_based_product/oppo_based_product',$data);
	}
	public function quote_report()
	{
		$data['user_list'] = $this->Dashboard_model->get_user_list();
		$data['quarter_list'] = $this->Setting_model->quarter_year_list();
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		$this->load->view('reports/quote_report/quote_report',$data);
	}
	public function proforma_report()
	{
		$data['user_list'] = $this->Dashboard_model->get_user_list();
		$data['quarter_list'] = $this->Setting_model->quarter_year_list();
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		$this->load->view('reports/proforma_report/proforma_report',$data);	
	}
	public function target_report()
	{
		$data['user_list'] = $this->Dashboard_model->get_user_list();
		$data['quarter_list'] = $this->Setting_model->quarter_year_list();
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		$this->load->view('reports/target_report/target_report',$data);	
	}
	public function comparison_report()
	{
		$data['user_list'] = $this->Dashboard_model->get_user_list();
		$data['country_lists'] = $this->Lead_model->country_list();
		$data['quarter_list'] = $this->Setting_model->quarter_year_list();
		$data['industry_lists'] = $this->Setting_model->industry_list();
		$data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
		$data['get_all_product'] = $this->Dashboard_model->get_all_product();
		$data['country_lists']= common_select_values('*', 'ad_countries', '', 'result');

		$this->load->view('reports/comparison_report/comparison_report',$data);
	}
	public function get_dynamic_comparison_based_on_product()
	{
		$sales_user = $this->input->post('sale_user');
		$year = $this->input->post('year');
		$quarter_id = $this->input->post('quarter_year');
		$industry_id = $this->input->post('industry_id');
		$product_id = $this->input->post('product_id');
		$day_filt = $this->input->post('day_filt');
		$dtrange = $this->input->post('dtrange');
		$country = $this->input->post('country');
		$data['country'] = $country;
		$data['sale_user'] = $sales_user;
		$data['day_filt'] = $day_filt;	
		$data['dtrange'] = $dtrange;

		if ($year != '') {
			$exp_yr = explode('-', $year);
			$data['yr1'] = $exp_yr[0];
			$data['yr2'] = $exp_yr[1];
			if (!empty($quarter_id)) {
				if (count($quarter_id) > 1) {
				    $ls_query = '';
				    for ($i=0; $i < count($quarter_id); $i++) { 
				          $ls_query .= "qy.quarter_id = ".$quarter_id[$i]." OR ";
				    }
				    $trimmed = rtrim($ls_query);
				    $get_query = rtrim($trimmed, 'OR');
				    $ls_filt = "AND ($get_query)";
				    $data['get_quarter_year'] = $this->Report_model->get_quarter_year_by_id($ls_filt);
				}
				elseif(count($quarter_id) == 1) {
					$ls_filt = "AND qy.quarter_id = '$quarter_id[0]'";
					$data['get_quarter_year'] = $this->Report_model->get_quarter_year_by_id($ls_filt);
				}
				elseif(count($quarter_id) == 0) {
					$data['get_quarter_year'] = $this->Setting_model->quarter_year_list();
				}
			}
			else {
				$data['get_quarter_year'] = $this->Setting_model->quarter_year_list();
			}
		}
		else {
			$data['yr1'] = '';
			$data['yr2'] = '';
		}
		if ($day_filt == 'thisyear') {
			$data['get_quarter_year'] = $this->Setting_model->quarter_year_list();
		}
		
		if ($sales_user == '') {
			if($industry_id != '' && !empty($product_id)) {

				if (count($product_id) > 1) {
				    $ls_query = '';
				    for ($i=0; $i < count($product_id); $i++) { 
				          $ls_query .= "p.product_id = ".$product_id[$i]." OR ";
				    }
				    $trimmed = rtrim($ls_query);
				    $get_query = rtrim($trimmed, 'OR');
				    $ls_filt = "AND ($get_query)";
				    $data['get_all_product'] = $this->Report_model->get_products_by_id($ls_filt);
				    
				}
				else {
					$ls_filt = "AND p.product_id = '$product_id[0]'";
					$data['get_all_product'] = $this->Report_model->get_products_by_id($ls_filt);

				}

				
			}
			else if($industry_id == '' && $product_id == ''){
				
				$data['get_all_product'] = $this->Dashboard_model->get_all_product();
			}
			else if ($industry_id != '' && empty($product_id)) {
				$data['get_all_product'] = $this->Dashboard_model->get_product_by_industry_id($industry_id);
			}
			else if($industry_id == '' && !empty($product_id)){
				$data['get_all_product'] = $this->Dashboard_model->get_all_product();
			}
		}
		else {
			$data['get_all_product'] = $this->Dashboard_model->get_products_by_user_allocated($sales_user);
		}
		$this->load->view('reports/comparison_report/get_dynamic_comparison_report',$data);

	}
}
?>