<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bankdetail_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_exporter_list()
  {
    $result = $this->db->query("CALL get_exporter_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_currency_list()
  {
    $result = $this->db->query("CALL get_currency_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_bank_detail_list()
  {
    $result = $this->db->query("CALL get_bank_detail_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function create_bankdetail($data)
  {
    $result = $this->db->query("CALL create_bankdetail('".$data['exporter_id']."','".$data['currency_id']."','".$data['bank_label']."','".$data['correspondence_bank']."','".$data['bank_detail']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function bankdetail_delete($eid)
  {
    $result = $this->db->query("call bankdetail_delete('".$eid."')");
    save_query_in_log();
    return $result;
  }
  public function get_bank_detail_by_id($exp)
  {
    $result = $this->db->query("CALL get_bank_detail_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_bankdetail($data)
  {
    $result = $this->db->query("CALL update_bankdetail('".$data['bank_detail_id']."','".$data['exporter_id']."','".$data['currency_id']."','".$data['bank_label']."','".$data['correspondence_bank']."','".$data['bank_detail']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }

}
?>