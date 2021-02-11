<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Pre_carriage_by_model database details
    Date    :29-02-2020 
****************************************************************/
class Pre_carriage_by_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_pre_carriage_by_list()
  {
    $result = $this->db->query("CALL get_pre_carriage_by_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  //To check unique price tag name procedure
  public function checkUniquePreCarriage($qstage)
  {
    $result = $this->db->query("CALL checkUniquePreCarriage('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_pre_carriage_by($data)
  {
    $result = $this->db->query("CALL create_pre_carriage_by('".$data['pre_carriage_by']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  
  public function pre_carriage_by_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL pre_carriage_by_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  
  public function get_pre_carriage_by_id($exp)
  {
    $result = $this->db->query("CALL get_pre_carriage_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  
  public function update_pre_carriage_by($data)
  {
    $result = $this->db->query("CALL update_pre_carriage_by('".$data['pre_carriage_by_id']."','".$data['pre_carriage_by']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }
  public function pre_carriage_by_delete($id)
  {
    $result = $this->db->query("CALL pre_carriage_by_delete('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>