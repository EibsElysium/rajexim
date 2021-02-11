<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Followupsheet extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Followupsheet_model'));
		$this->load->model(array('Buyerorder_model'));
		$this->load->model(array('Followupsheetcategory_model'));
		$this->load->model(array('Quote_model'));
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
		$data['exporter_list'] = $this->Quote_model->get_exporter_list();
		$data['followup_stage'] = $this->Buyerorder_model->get_followup_sheet_stage_list();
		$this->load->view('followupsheet/followup_sheet',$data);
	}

	public function getBOFollowupsheet()
	{
		//print_r($_POST);exit;
		// $bodate = $_POST['bodate'];
		$dtrange_from = $_POST['dtrange_from'];
		$dtrange_to - $_POST['dtrange_to'];
		$bodate = $dtrange_from.' - '.$dtrange_to;
		$eid = $_POST['eid'];
		if($eid!='')
		{
			$exid = ' AND exporter_id = '.$eid;
		}
		else
		{
			$exid = '';
		}
		$data['stg'] = $stg = $_POST['stg'];
		$bo_date = explode(' - ', $bodate);
		$sdate = explode('/', $bo_date[0]);
		$startdate = $sdate[2].'-'.$sdate[0].'-'.$sdate[1];
		$edate = explode('/', $bo_date[1]);
		$enddate = $edate[2].'-'.$edate[0].'-'.$edate[1];
		
		//$data['followup_default_category'] = $this->Buyerorder_model->get_followup_default_category();
  		//$data['followup_other_category'] = $this->Buyerorder_model->get_followup_other_category();
  		$data['followup_sheet_category_list'] = $this->Followupsheetcategory_model->get_followup_sheet_category_list();
		$data['followup_stage'] = $this->Buyerorder_model->get_followup_sheet_stage_list();
  		//$data['bolist'] = $this->Followupsheet_model->get_buyer_order_list_by_date($startdate,$enddate);
  		$data['bolist'] = $this->db->query("SELECT * FROM buyer_order WHERE invoice_date>='".$startdate."' AND invoice_date<='".$enddate."' $exid")->result_array();

  		$this->load->view('followupsheet/followup_sheet_table',$data);
	}

}
?>