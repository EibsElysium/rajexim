<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Benefitsheet extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Benefitsheet_model','Buyerorder_model'));
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
		$this->load->view('benefitsheet/benefit_sheet',$data);
	}

	public function getBOBenefitsheet()
	{
		//print_r($_POST);exit;
		$dtrange_from = $_POST['dtrange_from'];
		$dtrange_to - $_POST['dtrange_to'];
		$bodate = $dtrange_from.' - '.$dtrange_to;
		$eid = $_POST['eid'];
		if($eid!='')
		{
			$exid = ' AND bo.exporter_id = '.$eid;
		}
		else
		{
			$exid = '';
		}
		$bo_date = explode(' - ', $bodate);
		$sdate = explode('/', $bo_date[0]);
		$startdate = $sdate[2].'-'.$sdate[0].'-'.$sdate[1];
		$edate = explode('/', $bo_date[1]);
		$enddate = $edate[2].'-'.$edate[0].'-'.$edate[1];
  		$data['buyer_order_list'] = $this->db->query("SELECT bo.*, cb.company_name,cb.lead_name,cb.address,cb.email_id,ac.name as country_name,cb.email_id,cb.contact_no,u.name as lead_assigned_name,pi.proforma_invoice_no FROM buyer_order bo, leads l,ad_countries ac,users u,proforma_invoice pi,contact_book cb WHERE bo.proforma_invoice_id = pi.proforma_invoice_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND l.lead_assigned_to = u.user_id AND bo.invoice_date>='".$startdate."' AND bo.invoice_date<='".$enddate."' $exid")->result_array();

  		$this->load->view('benefitsheet/benefit_sheet_table',$data);
	}

}
?>