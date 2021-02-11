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
    $result = $this->db->query("CALL create_quote('".$data['exporter_id']."','".$data['quote_no']."','".$data['subject']."','".$data['created_date']."','".$data['valid_till']."','".$data['quote_stage_id']."','".$data['price_validity']."','".$data['lead_id']."','".$data['vessel_flight_id']."','".$data['from_port']."','".$data['to_port']."','".$data['price_term_id']."','".$data['currency_id']."','".$data['rate']."','".$data['grand_total']."','".$data['revised']."','".$data['parent_quote_id']."','".$data['created_on']."','".$data['created_by']."','".$data['is_local']."','".$data['product_costing_id']."','".$data['stage_type']."','".$data['stage_id']."','".$data['fob_stage_id']."','".$data['fobusdval']."','".$data['fobinrval']."')");
    save_query_in_log();
    return $result;
  }
  public function create_quote_product($data)
  {
    $result = $this->db->query("CALL create_quote_product('".$data['quote_id']."','".$data['vendor_id']."','".$data['marks_and_no']."','".$data['product_item_id']."','".$data['quantity']."','".$data['rate']."','".$data['amount']."','".$data['sku_unit_id']."','".$data['product_item_display_name_id']."','".$data['tax_type']."','".$data['tax_percent']."')");
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
  public function get_quote_by_parent_id($qno)
  {
    $result = $this->db->query("CALL get_quote_by_parent_id('".$qno."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function update_quote_pi_by_parent_quote_id($parqid)
  {
    $result = $this->db->query("CALL update_quote_pi_by_parent_quote_id('".$parqid."')");
    save_query_in_log();
    return $result;
  }
  public function get_product_item_by_id($eid)
  {
    $result = $this->db->query("CALL get_product_item_by_id('".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function quote_approve($data)
  {
    $result = $this->db->query("CALL quote_approve('".$data['quote_id']."','".$data['is_approve']."','".$data['approved_by']."','".$data['approved_date']."')");
    save_query_in_log();
    return $result;
  }
  public function get_quote_comments_by_id($tid)
  {
    $result = $this->db->query("CALL get_quote_comments_by_id('".$tid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function add_quote_comment($quote_id,$comments,$c_on,$c_by)
  {
    $result = $this->db->query("INSERT INTO `quote_comments`(`quote_id`, `comments`, `created_by`, `created_on`) VALUES ('$quote_id','$comments','$c_by','$c_on')");
    save_query_in_log();
    return $result;
  }
  public function update_quote_comment($quote_id,$comments)
  {
    $result = $this->db->query("UPDATE `quote` SET `comments`= '$comments' WHERE `quote_id`= '$quote_id'");
    save_query_in_log();
    return $result;
  }
  public function update_quote_stage($quote_id,$value,$type_val)
  {
    $result = $this->db->query("UPDATE `quote` SET $type_val = '$value' WHERE `quote_id`= '$quote_id'");
    save_query_in_log();
    return 1;
  }
}
?>