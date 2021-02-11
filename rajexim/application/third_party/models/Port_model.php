<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the exporter database details
    Date    :28-02-2020 
****************************************************************/
class Port_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_active_vessel_flight_list()
  {
    $result = $this->db->query("CALL get_active_vessel_flight_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_port_list()
  {
    $result = $this->db->query("CALL get_port_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkUniquePort($qstage)
  {
    $result = $this->db->query("CALL checkUniquePort('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_port($data)
  {
    $result = $this->db->query("CALL create_port('".$data['vessel_flight_id']."','".$data['port_name']."','".$data['port_city']."','".$data['port_country']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function port_change_status($qsid, $status)
  {
    $result = $this->db->query("call port_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  public function port_delete($eid)
  {
    $result = $this->db->query("call port_delete('".$eid."')");
    save_query_in_log();
    return $result;
  }
  public function get_port_by_id($exp)
  {
    $result = $this->db->query("CALL get_port_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkUniquePortEdit($exp,$eid)
  {
    $result = $this->db->query("CALL checkUniquePortEdit('".$exp."','".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_port($data)
  {
    $result = $this->db->query("CALL update_port('".$data['vessel_flight_id']."','".$data['port_name']."','".$data['port_city']."','".$data['port_country']."','".$data['modified_on']."','".$data['modified_by']."','".$data['port_id']."')");
    save_query_in_log();
    return $result;
  }

}
?>