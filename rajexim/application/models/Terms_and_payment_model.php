<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Terms_and_payment_model database details
    Date    :29-02-2020 
****************************************************************/
class Terms_and_payment_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_terms_and_payment_list()
  {
    $result = $this->db->query("CALL get_terms_and_payment_list()")->result_array();
    save_query_in_log();
    return $result;
  }
 
  //To check unique price tag name procedure
  public function checkUniquetapName($qstage)
  {
    $result = $this->db->query("CALL checkUniquetapName('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_tap($data)
  {
    $result = $this->db->query("CALL create_tap('".$data['tap_name']."','".$data['created_on']."','".$data['created_by']."','".$data['tap_value']."','".$data['terms_of_payment_type_id']."')");
    save_query_in_log();
    return $result;
  }

  public function tap_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL tap_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  
  public function get_tap_by_id($exp)
  {
    $result = $this->db->query("CALL get_tap_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  
  public function update_tap($data)
  {
    $result = $this->db->query("CALL update_tap('".$data['tap_id']."','".$data['tap_name']."','".$data['modified_on']."','".$data['modified_by']."','".$data['tap_value']."','".$data['terms_of_payment_type_id']."')");
    save_query_in_log();
    return $result;
  }
  public function tap_delete($id)
  {
    $result = $this->db->query("CALL tap_delete('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>