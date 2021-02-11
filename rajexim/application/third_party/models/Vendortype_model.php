<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the exporter database details
    Date    :28-02-2020 
****************************************************************/
class Vendortype_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_vendor_type_list()
  {
    $result = $this->db->query("CALL get_vendor_type_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueVendorType($qstage)
  {
    $result = $this->db->query("CALL checkUniqueVendorType('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_vendor_type($data)
  {
    $result = $this->db->query("CALL create_vendor_type('".$data['vendor_type']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function vendor_type_change_status($qsid, $status)
  {
    $result = $this->db->query("call vendor_type_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  public function vendor_type_delete($eid)
  {
    $result = $this->db->query("call vendor_type_delete('".$eid."')");
    save_query_in_log();
    return $result;
  }
  public function get_vendor_type_by_id($exp)
  {
    $result = $this->db->query("CALL get_vendor_type_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueVendorTypeEdit($exp,$eid)
  {
    $result = $this->db->query("CALL checkUniqueVendorTypeEdit('".$exp."','".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_vendor_type($data)
  {
    $result = $this->db->query("CALL update_vendor_type('".$data['vendor_type']."','".$data['modified_on']."','".$data['modified_by']."','".$data['vendor_type_id']."')");
    save_query_in_log();
    return $result;
  }

}
?>