<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Benefitsheet_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_buyer_order_list_by_date($sdate,$edate)
  {
    $result = $this->db->query("CALL get_buyer_order_list_by_date('".$sdate."','".$edate."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_invoice_value($boid)
  {
    $result = $this->db->query("CALL get_buyer_order_invoice_value('".$boid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_fob_value($boid)
  {
    $result = $this->db->query("CALL get_buyer_order_fob_value('".$boid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_product_by_id($boid)
  {
    $result = $this->db->query("CALL get_buyer_order_product_by_id('".$boid."')")->row();
    save_query_in_log();
    return $result;
  }

}
?>