<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Targets Controls details
    Date    :29-02-2020 
****************************************************************/
class Targets extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Target_model','Dashboard_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}
	//To list All price Terms in index page of this settings..
	public function index()
	{
		if (!empty($this->input->post('target_year'))) {
			$year = $this->input->post('target_year');
			$data['year'] = $year;
		}
		else {
			$yr_from = date('Y');
			$yr_to = date('Y',strtotime('+1 year'));
			$year = $yr_from.'-'.$yr_to;
			$data['year'] = $year;
		}
		
		$data['get_all_product'] = $this->Dashboard_model->get_all_product();
		// $data['get_all_target_by_target'] = $this->Target_model->get_all_target_by_target($year);
		$this->load->view('target/target_list',$data);
	}
	public function create_all_product_target($year)
	{
		// $yr_from = date('Y');
		// $yr_to = date('Y',strtotime('+1 year'));
		// $yr = $yr_from.'-'.$yr_to;
		$yr = $year;
		$all_product = $this->Dashboard_model->get_all_product();
		foreach ($all_product as $product) {
			$chk_pro_and_year_already_exist = $this->Target_model->chk_pro_and_year_already_exist($product->product_id,$yr);
			
			// echo count($chk_pro_and_year_already_exist);
			// die();
			if (COUNT($chk_pro_and_year_already_exist) == 0) {
				$this->Target_model->add_products_with_year($product->product_id,$yr);
			}
		}
	}
	public function update_target_counts()
	{
		$value = $this->input->post('value');
		$tar_id = $this->input->post('tar_id');
		$column = $this->input->post('type_val');

		$update_target_counts = $this->Target_model->update_target_counts($tar_id,$column,$value);
	}
	public function chk_filter_year_exist_or_not()
	{
		// $data['perpage'] = $perpage = 10;
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';

		$data['year'] = $year = $this->input->post('year');
		$chk_filter_year_exist_or_not = $this->Target_model->chk_filter_year_exist_or_not($year);
		if (COUNT($chk_filter_year_exist_or_not) == 0) {
			$this->create_all_product_target($year);
		}
		$data['get_all_target_by_target_count'] = $this->Target_model->get_all_target_by_target_count($year,$search_val);
		$data['get_all_target_by_target'] = $this->Target_model->get_all_target_by_target($year,$search_val,$page,$perpage);
		$this->load->view('target/target_list_table',$data);
	}
}
?>