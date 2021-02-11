<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the exporter database details
    Date    :28-02-2020 
****************************************************************/
class Vesselflight_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_vessel_flight_list()
  {
    $result = $this->db->query("CALL get_vessel_flight_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueVesselFlight($qstage)
  {
    $result = $this->db->query("CALL checkUniqueVesselFlight('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_vessel_flight($data)
  {
    $result = $this->db->query("CALL create_vessel_flight('".$data['vessel_flight_name']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function vessel_flight_change_status($qsid, $status)
  {
    $result = $this->db->query("call vessel_flight_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  public function vessel_flight_delete($eid)
  {
    $result = $this->db->query("call vessel_flight_delete('".$eid."')");
    save_query_in_log();
    return $result;
  }
  public function get_vessel_flight_by_id($exp)
  {
    $result = $this->db->query("CALL get_vessel_flight_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueVesselFlightEdit($exp,$eid)
  {
    $result = $this->db->query("CALL checkUniqueVesselFlightEdit('".$exp."','".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_vessel_flight($data)
  {
    $result = $this->db->query("CALL update_vessel_flight('".$data['vessel_flight_name']."','".$data['modified_on']."','".$data['modified_by']."','".$data['vessel_flight_id']."')");
    save_query_in_log();
    return $result;
  }

}
?>