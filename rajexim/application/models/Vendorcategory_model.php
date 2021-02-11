<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendorcategory_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_vendor_category_list()
  {
    $result = $this->db->query("CALL get_vendor_category_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueVendorCategory($qstage)
  {
    $result = $this->db->query("CALL checkUniqueVendorCategory('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_vendor_category($data)
  {
    $result = $this->db->query("CALL create_vendor_category('".$data['vendor_category']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function vendor_category_change_status($qsid, $status)
  {
    $result = $this->db->query("call vendor_category_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  public function vendor_category_delete($eid)
  {
    $result = $this->db->query("call vendor_category_delete('".$eid."')");
    save_query_in_log();
    return $result;
  }
  public function get_vendor_category_by_id($exp)
  {
    $result = $this->db->query("CALL get_vendor_category_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueVendorCategoryEdit($exp,$eid)
  {
    $result = $this->db->query("CALL checkUniqueVendorCategoryEdit('".$exp."','".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_vendor_category($data)
  {
    $result = $this->db->query("CALL update_vendor_category('".$data['vendor_category']."','".$data['modified_on']."','".$data['modified_by']."','".$data['vendor_category_id']."')");
    save_query_in_log();
    return $result;
  }

}
?>