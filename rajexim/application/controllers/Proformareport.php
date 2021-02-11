<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proformareport extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model(array('Multiproductcostingproduct_model','Lead_model'));
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
		$this->load->view('proformareport/proforma_report');
	}

}
?>