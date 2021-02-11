<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the PI_Stage_model database details
    Date    :29-02-2020 
****************************************************************/
class PI_Stage_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_pi_stage_list()
  {
    $result = $this->db->query("CALL get_pi_stage_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  //To check unique price tag name procedure
  public function checkUniquePIStage($qstage)
  {
    $result = $this->db->query("CALL checkUniquePIStage('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_pi_stage($data)
  {
    $result = $this->db->query("CALL create_pi_stage('".$data['pi_stage']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function pi_stage_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL pi_stage_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  
  public function get_pi_stage_by_id($exp)
  {
    $result = $this->db->query("CALL get_pi_stage_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  
  public function update_pi_stage($data)
  {
    $result = $this->db->query("CALL update_pi_stage('".$data['pi_stage_id']."','".$data['pi_stage']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }
  public function pi_stage_delete($id)
  {
    $result = $this->db->query("CALL pi_stage_delete('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>