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
  public function checkUniqueVendorEmail($email)
  {
    $result = $this->db->query("SELECT v.* FROM vendor v WHERE v.email_id = '$email'")->row();
    save_query_in_log();
    return $result;
  }
  public function create_vendor($data)
  {
    $result = $this->db->query("CALL create_vendor('".$data['vendor_category_id']."','".$data['vendor_type_id']."','".$data['vendor_name']."','".$data['gst_no']."','".$data['phone_no']."','".$data['email_id']."','".$data['website']."','".$data['created_on']."','".$data['created_by']."')");
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
    $result = $this->db->query("CALL update_vendor('".$data['vendor_category_id']."','".$data['vendor_type_id']."','".$data['vendor_name']."','".$data['gst_no']."','".$data['phone_no']."','".$data['email_id']."','".$data['website']."','".$data['street']."','".$data['city']."','".$data['state']."','".$data['country']."','".$data['postal_code']."','".$data['modified_on']."','".$data['modified_by']."','".$data['vendor_id']."')");
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
  public function add_vendor_contact_info($vendor_id,$cont_per,$cont_per_email,$cont_per_phone)
  {
    $result = $this->db->query("INSERT INTO `vendor_contact_person`(`vendor_id`, `contact_person`, `contact_person_phone`, `contact_person_email`, `status`) VALUES ('$vendor_id','$cont_per','$cont_per_phone','$cont_per_email','0')");
    save_query_in_log();
    return $result;
  }
  public function update_vendor_contact_info($ven_cont_per_id,$vendor_id,$cont_per,$cont_per_email,$cont_per_phone)
  {
    /*echo 'UPDATE `vendor_contact_person` SET `vendor_id`="'.$vendor_id.'",`contact_person`="'.$cont_per.'",`contact_person_phone`="'.$cont_per_phone.'",`contact_person_email`="'.$cont_per_email.'" WHERE `vendor_contact_person_id`="'.$ven_cont_per_id.'"';
    die();*/
    $result = $this->db->query('UPDATE `vendor_contact_person` SET `vendor_id`="'.$vendor_id.'",`contact_person`="'.$cont_per.'",`contact_person_phone`="'.$cont_per_phone.'",`contact_person_email`="'.$cont_per_email.'" WHERE `vendor_contact_person_id`="'.$ven_cont_per_id.'"');
    save_query_in_log();
    return $result;
  }
  public function rmv_ven_cont_per_id($id)
  {
    $result = $this->db->query('DELETE FROM `vendor_contact_person` WHERE `vendor_contact_person_id` = "'.$id.'"');
    save_query_in_log();
    return 1;
  }
  public function add_vendor_address($last_value,$address_type,$street,$city,$state,$country,$postal_code)
  {
    $result = $this->db->query('INSERT INTO `vendor_address`(`vendor_id`, `address_type_id`, `street`, `city`, `state`, `country`, `postal_code`) VALUES ("'.$last_value.'","'.$address_type.'","'.$street.'","'.$city.'","'.$state.'","'.$country.'","'.$postal_code.'")');
    save_query_in_log();
    return 1;
  }
  public function update_vendor_address($ven_addr_id,$vendor_id,$address_type,$street,$city,$state,$country,$postal_code)
  {
    $result = $this->db->query('UPDATE `vendor_address` SET `vendor_id`="'.$vendor_id.'",`address_type_id`="'.$address_type.'",`street`="'.$street.'",`city`="'.$city.'",`state`="'.$state.'",`country`="'.$country.'",`postal_code`="'.$postal_code.'" WHERE `vendor_address`="'.$ven_addr_id.'"');
    save_query_in_log();
    return 1;
  }
  public function rmv_ven_addr_id($ven_addr_id)
  {
    $result = $this->db->query('DELETE FROM `vendor_address` WHERE `vendor_address` = "'.$ven_addr_id.'"');
    save_query_in_log();
    return 1;
  }
}
?>