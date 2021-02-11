<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_invoice_list()
  {
    $result = $this->db->query("CALL get_invoice_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_invoice_by_id($iid)
  {
    $result = $this->db->query("CALL get_invoice_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_invoice_product_by_id($iid)
  {
    $result = $this->db->query("CALL get_invoice_product_by_id('".$iid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_invoice_other_charge_by_id($qid)
  {
    $result = $this->db->query("CALL get_invoice_other_charge_by_id('".$qid."')")->row();
    save_query_in_log();
    return $result;
  }

}
?>