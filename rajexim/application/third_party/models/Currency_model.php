<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Currnecy_model database details
    Date    :29-02-2020 
****************************************************************/
class Currency_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all currency Procedure
  public function get_currency_list()
  {
    $result = $this->db->query("CALL get_currency_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  //To check unique currency name procedure
  public function checkUniqueCurrencyName($qstage)
  {
    $result = $this->db->query("CALL checkUniqueCurrencyName('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  //To check unique currency code procedure
  public function checkUniqueCurrencyCode($qstage)
  {
    $result = $this->db->query("CALL checkUniqueCurrencyCode('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  //To add currency into database
  public function create_currency($data)
  {
    $result = $this->db->query("CALL create_currency('".$data['currency_name']."','".$data['currency_code']."','".$data['currency_symb']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  //To Change status active in-active function
  public function currency_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL currency_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  //To get individual currency by id procedure
  public function get_currency_by_id($exp)
  {
    $result = $this->db->query("CALL get_currency_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  //To update currency informaion 
  public function update_currency($data)
  {
    $result = $this->db->query("CALL update_currency('".$data['currency_id']."', '".$data['currency_name']."','".$data['currency_code']."','".$data['currency_symb']."','".$data['modi_on']."','".$data['modi_by']."')");
    save_query_in_log();
    return $result;
  }
  //To individual delete currency
  public function currency_delete($id)
  {
    $result = $this->db->query("CALL currency_delete('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>