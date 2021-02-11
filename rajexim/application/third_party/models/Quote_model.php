<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quote_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_quote_list()
  {
    $result = $this->db->query("CALL get_quote_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_quote_product_by_quote_id($qid)
  {
    $result = $this->db->query("CALL get_quote_product_by_quote_id('".$qid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_exporter_list()
  {
    $result = $this->db->query("CALL get_exporter_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_quote_stage_list()
  {
    $result = $this->db->query("CALL get_quote_stage_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_oppertunity_list()
  {
    $result = $this->db->query("CALL get_oppertunity_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_vessel_flight_list()
  {
    $result = $this->db->query("CALL get_vessel_flight_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_port_list()
  {
    $result = $this->db->query("CALL get_port_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_price_terms_list()
  {
    $result = $this->db->query("CALL get_price_terms_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_currency_list()
  {
    $result = $this->db->query("CALL get_currency_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_vendor_list()
  {
    $result = $this->db->query("CALL get_vendor_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_product_item_list()
  {
    $result = $this->db->query("CALL get_product_item_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_exporter_by_id($eid)
  {
    $result = $this->db->query("CALL get_exporter_by_id('".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function quote_last_id()
  {
    $result = $this->db->query("CALL quote_last_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function lead_by_id($eid)
  {
    $result = $this->db->query("CALL lead_by_id('".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_port_by_vessel_flight_id($eid)
  {
    $result = $this->db->query("CALL get_port_by_vessel_flight_id('".$eid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_currency_by_id($cid)
  {
    $result = $this->db->query("CALL get_currency_by_id('".$cid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_quote($data)
  {
    $result = $this->db->query("CALL create_quote('".$data['exporter_id']."','".$data['quote_no']."','".$data['subject']."','".$data['created_date']."','".$data['valid_till']."','".$data['quote_stage_id']."','".$data['price_validity']."','".$data['lead_id']."','".$data['vessel_flight_id']."','".$data['from_port']."','".$data['to_port']."','".$data['price_term_id']."','".$data['currency_id']."','".$data['rate']."','".$data['grand_total']."','".$data['revised']."','".$data['parent_quote_id']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function create_quote_product($data)
  {
    $result = $this->db->query("CALL create_quote_product('".$data['quote_id']."','".$data['vendor_id']."','".$data['marks_and_no']."','".$data['product_item_id']."','".$data['quantity']."','".$data['rate']."','".$data['amount']."')");
    save_query_in_log();
    return $result;
  }
  public function get_quote_by_id($qid)
  {
    $result = $this->db->query("CALL get_quote_by_id('".$qid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_quote_product_by_id($qid)
  {
    $result = $this->db->query("CALL get_quote_product_by_id('".$qid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function quote_last_insert_id()
  {
    $result = $this->db->query("CALL quote_last_insert_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function getCheckRevQuotation($qno)
  {
    $result = $this->db->query("CALL getCheckRevQuotation('".$qno."')")->result();
    save_query_in_log();
    return $result;
  }
  public function getViewRevQuotationList($qno,$rqno)
  {
    $result = $this->db->query("CALL getViewRevQuotationList('".$qno."','".$rqno."')")->result();
    save_query_in_log();
    return $result;
  }
  public function getViewQuotationList($qno)
  {
    $result = $this->db->query("CALL getViewQuotationList('".$qno."')")->result();
    save_query_in_log();
    return $result;
  }

}
?>