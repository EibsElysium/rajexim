<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the PriceTerms database details
    Date    :29-02-2020 
****************************************************************/
class PriceTerms_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_price_terms_list()
  {
    $result = $this->db->query("CALL get_price_terms_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  //To check unique price tag name procedure
  public function checkUniquePriceTermName($qstage)
  {
    $result = $this->db->query("CALL checkUniquePriceTermName('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_price_term($data)
  {
    $result = $this->db->query("CALL create_price_term('".$data['price_term_name']."','".$data['price_term']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function price_term_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL price_term_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  // public function vessel_flight_delete($eid)
  // {
  //   $result = $this->db->query("call vessel_flight_delete('".$eid."')");
  //   save_query_in_log();
  //   return $result;
  // }
  public function get_price_term_by_id($exp)
  {
    $result = $this->db->query("CALL get_price_term_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  // public function checkUniqueVesselFlightEdit($exp,$eid)
  // {
  //   $result = $this->db->query("CALL checkUniqueVesselFlightEdit('".$exp."','".$eid."')")->row();
  //   save_query_in_log();
  //   return $result;
  // }
  public function update_price_term($data)
  {
    $result = $this->db->query("CALL update_price_term('".$data['price_term_id']."','".$data['price_term_name']."','".$data['price_term']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }
  public function delete_price_term($id)
  {
    $result = $this->db->query("CALL delete_price_term('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>