<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboardsettings_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta'); 
    }
	public function dashboard_setting_update($data)
	{
		$result = $this->db->query("CALL dashboard_setting_update('".$data['lead_days_after']."','".$data['jo_days_before']."','".$data['bo_days_before']."','".$data['max_product_count']."','".$data['max_lead_source_count']."','".$data['max_supplier_count']."','".$data['supplier_point_before']."','".$data['supplier_point_ondate']."','".$data['supplier_point_after']."','".$data['dashboard_settings_id']."')");
		save_query_in_log();
		return $result;
	}

}
?>