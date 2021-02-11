<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardsettings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Dashboardsettings_model'));
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
		$data['d_settings'] = common_select_values('*', 'dashboard_settings', '', 'row');
		$data['g_settings'] = common_select_values('*', 'general_settings', '', 'row');
		$this->load->view('dashboard/dashboard_settings', $data);
	}

	public function dashboard_settings_update()
    {

		$data['lead_days_after'] = $this->input->post('lead_days_after');
		$data['jo_days_before'] = $this->input->post('jo_days_before');
		$data['bo_days_before'] = $this->input->post('bo_days_before');
		$data['max_product_count'] = $this->input->post('max_product_count');
		$data['max_lead_source_count'] = $this->input->post('max_lead_source_count');
		$data['max_supplier_count'] = $this->input->post('max_supplier_count');
		$data['supplier_point_before']   = $this->input->post('supplier_point_before');
		$data['supplier_point_ondate']    = $this->input->post('supplier_point_ondate');
		$data['supplier_point_after'] = $this->input->post('supplier_point_after');
		$data['dashboard_settings_id'] = $this->input->post('dashboard_settings_id');
		$lead_replies_max = $this->input->post('un_attend_count');
		$update_lead_reply_count = update_table("general_settings", "lead_replies_max = '$lead_replies_max'", "general_setting_id = 1");
		$result = $this->Dashboardsettings_model->dashboard_setting_update($data, $id);

		if($result){
			$this->session->set_flashdata('g_success', 'Dashboard Setting details have been updated successfully...');
		}else{
			   $this->session->set_flashdata('g_err', 'Could not update dashboard setting details!');
		}

		redirect('dashboardsettings');      
  	}	

}
?>