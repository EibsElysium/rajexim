<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the PriceTerms database details
    Date    :29-02-2020 
****************************************************************/
class Interest_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_interests_list()
  {
    $result = $this->db->query("CALL get_interests_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  //To check unique price tag name procedure
  public function checkUniqueInterestLabel($qstage)
  {
    $result = $this->db->query("CALL checkUniqueInterestLabel('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_Interest($data)
  {
    $result = $this->db->query("CALL create_Interest('".$data['interest_label']."','".$data['interest_text']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function interest_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL interest_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  
  public function get_interest_by_id($exp)
  {
    $result = $this->db->query("CALL get_interest_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  
  public function update_Interest($data)
  {
    $result = $this->db->query("CALL update_Interest('".$data['interest_id']."','".$data['interest_label']."','".$data['interest_text']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }
  public function delete_interest($id)
  {
    $result = $this->db->query("CALL delete_interest('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>