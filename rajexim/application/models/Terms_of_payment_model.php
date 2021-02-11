<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Terms_of_payment_model database details
    Date    :29-02-2020 
****************************************************************/
class Terms_of_payment_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_terms_of_payment_list()
  {
    $result = $this->db->query("CALL get_terms_of_payment_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_terms_and_payment_by_type_id($tapid)
  {
    $result = $this->db->query("CALL get_terms_and_payment_by_type_id('".$tapid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_terms_of_payment_type()
  {
    $result = $this->db->query("CALL get_terms_of_payment_type()")->result();
    save_query_in_log();
    return $result;
  }
  //To check unique price tag name procedure
  public function checkUniquetopName($qstage)
  {
    $result = $this->db->query("CALL checkUniquetopName('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_top($data)
  {
    $result = $this->db->query("CALL create_top('".$data['top_name']."','".$data['top_text']."','".$data['top_type']."','".$data['created_on']."','".$data['created_by']."','".$data['terms_and_payment_id']."')");
    save_query_in_log();
    return $result;
  }

  public function top_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL top_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  
  public function get_top_by_id($exp)
  {
    $result = $this->db->query("CALL get_top_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  
  public function update_top($data)
  {
    $result = $this->db->query("CALL update_top('".$data['top_id']."','".$data['top_name']."','".$data['top_text']."','".$data['top_type']."','".$data['modified_on']."','".$data['modified_by']."','".$data['terms_and_payment_id']."')");
    save_query_in_log();
    return $result;
  }
  public function top_delete($id)
  {
    $result = $this->db->query("CALL top_delete('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>