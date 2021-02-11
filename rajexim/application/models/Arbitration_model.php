<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Arbitration_model database details
    Date    :29-02-2020 
****************************************************************/
class Arbitration_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_arbitrations_list()
  {
    $result = $this->db->query("CALL get_arbitrations_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  //To check unique price tag name procedure
  public function checkUniquearbitrationLabel($qstage)
  {
    $result = $this->db->query("CALL checkUniquearbitrationLabel('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_Arbitration($data)
  {
    $result = $this->db->query("CALL create_Arbitration('".$data['arbitration_label']."','".$data['arbitration_text']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function arbitration_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL arbitration_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  
  public function get_aribitration_by_id($exp)
  {
    $result = $this->db->query("CALL get_aribitration_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  
  public function update_Arbitration($data)
  {
    $result = $this->db->query("CALL update_Arbitration('".$data['arbitration_id']."','".$data['arbitration_label']."','".$data['arbitration_text']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }
  public function delete_arbitration($id)
  {
    $result = $this->db->query("CALL delete_arbitration('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>