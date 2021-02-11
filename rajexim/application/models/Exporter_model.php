<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the exporter database details
    Date    :28-02-2020 
****************************************************************/
class Exporter_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }

  // To list exporter
  public function get_exporter_list()
  {
    $result = $this->db->query("CALL get_exporter_list()")->result_array();
    save_query_in_log();
    return $result;
  }

  // To check unique exporter
  public function checkUniqueExporter($exp)
  {
    $result = $this->db->query("CALL checkUniqueExporter('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }

  //Create Exporter
  public function create_exporter($data)
  {
    $result = $this->db->query("CALL create_exporter('".$data['exporter_name']."','".$data['exporter_address']."','".$data['exporter_country']."','".$data['contact_name']."','".$data['phone_no']."','".$data['gst_no']."','".$data['iec_no']."','".$data['exporter_logo']."','".$data['exporter_sign_file']."','".$data['created_on']."','".$data['created_by']."','".$data['state_name']."','".$data['state_code']."','".$data['vat_tin_no']."','".$data['cst_no']."','".$data['pan_no']."')");
    save_query_in_log();
    return $result;
  }

  public function get_exporter_by_id($exp)
  {
    $result = $this->db->query("CALL get_exporter_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }

  public function exporter_change_status($eid, $status)
  {
    $result = $this->db->query("call exporter_change_status('".$eid."','".$status."')");
    save_query_in_log();
    return $result;
  }

  public function exporter_delete($eid)
  {
    $result = $this->db->query("call exporter_delete('".$eid."')");
    save_query_in_log();
    return $result;
  }

  // To check unique exporter
  public function checkUniqueExporterEdit($exp,$eid)
  {
    $result = $this->db->query("CALL checkUniqueExporterEdit('".$exp."','".$eid."')")->row();
    save_query_in_log();
    return $result;
  }

  //Update Exporter
  public function update_exporter($data)
  {
    $result = $this->db->query("CALL update_exporter('".$data['exporter_name']."','".$data['exporter_address']."','".$data['exporter_country']."','".$data['contact_name']."','".$data['phone_no']."','".$data['gst_no']."','".$data['iec_no']."','".$data['exporter_logo']."','".$data['exporter_sign_file']."','".$data['modified_on']."','".$data['modified_by']."','".$data['exporter_id']."','".$data['state_name']."','".$data['state_code']."','".$data['vat_tin_no']."','".$data['cst_no']."','".$data['pan_no']."')");
    save_query_in_log();
    return $result;
  }

}
?>