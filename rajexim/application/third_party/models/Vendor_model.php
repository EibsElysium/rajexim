<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_vendor_list()
  {
    $result = $this->db->query("CALL get_vendor_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_active_vendor_type_list()
  {
    $result = $this->db->query("CALL get_active_vendor_type_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_active_vendor_category_list()
  {
    $result = $this->db->query("CALL get_active_vendor_category_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_active_product_list()
  {
    $result = $this->db->query("CALL get_active_product_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueVendor($qstage)
  {
    $result = $this->db->query("CALL checkUniqueVendor('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_vendor($data)
  {
    $result = $this->db->query("CALL create_vendor('".$data['vendor_category_id']."','".$data['vendor_type_id']."','".$data['vendor_name']."','".$data['gst_no']."','".$data['phone_no']."','".$data['email_id']."','".$data['website']."','".$data['street']."','".$data['city']."','".$data['state']."','".$data['country']."','".$data['postal_code']."','".$data['contact_person_name']."','".$data['contact_person_email']."','".$data['contact_person_phone']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function last_vendor_id()
  {
    $result = $this->db->query("CALL last_vendor_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function create_vendor_product($data)
  {
    $result = $this->db->query("CALL create_vendor_product('".$data['vendor_id']."','".$data['product_id']."')");
    save_query_in_log();
    return $result;
  }
  public function vendor_change_status($qsid, $status)
  {
    $result = $this->db->query("call vendor_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  public function get_vendor_by_id($vid)
  {
    $result = $this->db->query("CALL get_vendor_by_id('".$vid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_vendor_product_by_id($vid)
  {
    $result = $this->db->query("CALL get_vendor_product_by_id('".$vid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueVendorEdit($pno,$vid)
  {
    $result = $this->db->query("CALL checkUniqueVendorEdit('".$pno."','".$vid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_vendor($data)
  {
    $result = $this->db->query("CALL update_vendor('".$data['vendor_category_id']."','".$data['vendor_type_id']."','".$data['vendor_name']."','".$data['gst_no']."','".$data['phone_no']."','".$data['email_id']."','".$data['website']."','".$data['street']."','".$data['city']."','".$data['state']."','".$data['country']."','".$data['postal_code']."','".$data['contact_person_name']."','".$data['contact_person_email']."','".$data['contact_person_phone']."','".$data['modified_on']."','".$data['modified_by']."','".$data['vendor_id']."')");
    save_query_in_log();
    return $result;
  }
  public function delete_vendor_product_by_id($vid)
  {
    $result = $this->db->query("CALL delete_vendor_product_by_id('".$vid."')");
    save_query_in_log();
    return $result;
  }
  public function vendor_delete($vid)
  {
    $result = $this->db->query("CALL vendor_delete('".$vid."')");
    save_query_in_log();
    return $result;
  }

}
?>