<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proformainvoice_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_proforma_invoice_list()
  {
    $result = $this->db->query("CALL get_proforma_invoice_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_proforma_invoice_product_by_id($qid)
  {
    $result = $this->db->query("CALL get_proforma_invoice_product_by_id('".$qid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_exporter_list()
  {
    $result = $this->db->query("CALL get_exporter_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_pi_stage_list()
  {
    $result = $this->db->query("CALL get_pi_stage_list()")->result_array();
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
  public function get_pre_carriage_by_list()
  {
    $result = $this->db->query("CALL get_pre_carriage_by_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_interests_list()
  {
    $result = $this->db->query("CALL get_interests_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_terms_and_payment_list()
  {
    $result = $this->db->query("CALL get_terms_and_payment_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_terms_of_payment_list()
  {
    $result = $this->db->query("CALL get_terms_of_payment_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_terms_of_payment_type()
  {
    $result = $this->db->query("CALL get_terms_of_payment_type()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_arbitrations_list()
  {
    $result = $this->db->query("CALL get_arbitrations_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_declaration_list()
  {
    $result = $this->db->query("CALL get_declaration_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_doc_req_list()
  {
    $result = $this->db->query("CALL get_doc_req_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function proforma_invoice_last_id()
  {
    $result = $this->db->query("CALL proforma_invoice_last_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function get_exporter_by_id($eid)
  {
    $result = $this->db->query("CALL get_exporter_by_id('".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_terms_of_payment_by_type_id($eid)
  {
    $result = $this->db->query("CALL get_terms_of_payment_by_type_id('".$eid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_bank_detail_by_currency_exporter_id($cid,$eid)
  {
    $result = $this->db->query("CALL get_bank_detail_by_currency_exporter_id('".$cid."','".$eid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_interest_by_id($iid)
  {
    $result = $this->db->query("CALL get_interest_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_tap_by_id($iid)
  {
    $result = $this->db->query("CALL get_tap_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_top_by_id($iid)
  {
    $result = $this->db->query("CALL get_top_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_aribitration_by_id($iid)
  {
    $result = $this->db->query("CALL get_aribitration_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_declaration_by_id($iid)
  {
    $result = $this->db->query("CALL get_declaration_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_proformainvoice($data)
  {
    $result = $this->db->query("CALL create_proformainvoice('".$data['exporter_id']."','".$data['proforma_invoice_no']."','".$data['subject']."','".$data['terms_of_payment_type_id']."','".$data['proforma_invoice_date']."','".$data['buyer_confirmation_date']."','".$data['other_reference']."','".$data['pi_stage_id']."','".$data['lead_id']."','".$data['pre_carriage_by_id']."','".$data['place_of_receipt_by_pre_carrier']."','".$data['vessel_flight_id']."','".$data['port_of_loading_id']."','".$data['port_of_discharge_id']."','".$data['final_destination_id']."','".$data['currency_id']."','".$data['rate']."','".$data['bank_detail_id']."','".$data['sales_note']."','".$data['purchase_note']."','".$data['shipping_note']."','".$data['accounts_note']."','".$data['specification_packing_details']."','".$data['price_validity']."','".$data['interest_id']."','".$data['loadability']."','".$data['terms_and_payment_id']."','".$data['terms_of_payment_id']."','".$data['arbitration_id']."','".$data['declaration_id']."','".$data['document_required']."','".$data['grand_total']."','".$data['created_on']."','".$data['created_by']."','".$data['quote_id']."','".$data['price']."','".$data['is_local']."','".$data['terms_and_payment']."','".$data['terms_of_payment']."','".$data['specification_group']."')");
    save_query_in_log();
    return $result;
  }
  public function create_proformainvoice_product($data)
  {
    $result = $this->db->query("CALL create_proformainvoice_product('".$data['proforma_invoice_id']."','".$data['vendor_id']."','".$data['marks_and_no']."','".$data['product_item_id']."','".$data['quantity']."','".$data['rate']."','".$data['amount']."','".$data['product_item_display_name_id']."','".$data['sku_unit_id']."','".$data['specification']."','".$data['tax_type']."','".$data['tax_percent']."')");
    save_query_in_log();
    return $result;
  }
  public function get_proforma_invoice_by_id($iid)
  {
    $result = $this->db->query("CALL get_proforma_invoice_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_port_by_vessel_flight_id($eid)
  {
    $result = $this->db->query("CALL get_port_by_vessel_flight_id('".$eid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_currency_by_id($eid)
  {
    $result = $this->db->query("CALL get_currency_by_id('".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function delete_proforma_invoice_product_by_id($profoid)
  {
    $result = $this->db->query("CALL delete_proforma_invoice_product_by_id('".$profoid."')");
    save_query_in_log();
    return $result;
  }
  public function update_proformainvoice($data)
  {
    $result = $this->db->query("CALL update_proformainvoice('".$data['proforma_invoice_id']."','".$data['exporter_id']."','".$data['subject']."','".$data['terms_of_payment_type_id']."','".$data['proforma_invoice_date']."','".$data['buyer_confirmation_date']."','".$data['other_reference']."','".$data['pi_stage_id']."','".$data['lead_id']."','".$data['pre_carriage_by_id']."','".$data['place_of_receipt_by_pre_carrier']."','".$data['vessel_flight_id']."','".$data['port_of_loading_id']."','".$data['port_of_discharge_id']."','".$data['final_destination_id']."','".$data['currency_id']."','".$data['rate']."','".$data['bank_detail_id']."','".$data['sales_note']."','".$data['purchase_note']."','".$data['shipping_note']."','".$data['accounts_note']."','".$data['specification_packing_details']."','".$data['price_validity']."','".$data['interest_id']."','".$data['loadability']."','".$data['terms_and_payment_id']."','".$data['terms_of_payment_id']."','".$data['arbitration_id']."','".$data['declaration_id']."','".$data['document_required']."','".$data['grand_total']."','".$data['modified_on']."','".$data['modified_by']."','".$data['price']."','".$data['is_local']."','".$data['terms_of_payment']."','".$data['terms_and_payment']."','".$data['specification_group']."')");
    save_query_in_log();
    return $result;
  }
  public function get_bank_detail_by_id($bdid)
  {
    $result = $this->db->query("CALL get_bank_detail_by_id('".$bdid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_document_required_by_proforma_invoice_id($piid)
  {
    $result = $this->db->query("CALL get_document_required_by_proforma_invoice_id('".$piid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function lead_by_id($lid)
  {
    $result = $this->db->query("CALL lead_by_id('".$lid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function buyer_order_last_id()
  {
    $result = $this->db->query("CALL buyer_order_last_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function proforma_invoice_to_buyer_order_save($invoice_id, $invoice_no, $buyer_order_no, $buyer_order_date, $order_end_date)
  {
    $result = $this->db->query("CALL buyer_order_next_auto_id()")->row();
    if($query = $this->db->query("call proforma_invoice_to_buyer_order_save('".$invoice_id."', '$invoice_no', '$buyer_order_no', '$buyer_order_date', '$order_end_date')"))
    {  return $result; }else{ return false; } 
  }  
  public function proforma_invoice_prd_to_buyer_order_prd_save($invoice_id, $buyer_order_id)
  {
    if($query = $this->db->query("call proforma_invoice_prd_to_buyer_order_prd_save('".$invoice_id."', '".$buyer_order_id."')"))
    {  return true; }else{ return false; } 
  }
  public function proforma_invoice_confirm_file_name_update($invoice_id, $profileName)
  {
    if($query = $this->db->query("call proforma_invoice_confirm_file_name_update('".$profileName."','".$invoice_id."')"))
        {  return true; }else{ return false; } 
  }
  public function update_lead_contact_details($data)
  {
    $result = $this->db->query("CALL update_lead_contact_details('".$data['contact_book_id']."','".$data['company_name']."','".$data['country']."','".$data['email_id']."','".$data['contact_no']."','".$data['office_phone_no']."','".$data['address']."')");
    save_query_in_log();
    return $result;
  }
  public function update_pi_stage($pi_id,$value,$type_val)
  {
    $result = $this->db->query("UPDATE `proforma_invoice` SET $type_val = '$value' WHERE `proforma_invoice_id`= '$pi_id'");
    save_query_in_log();
    return 1;
  }
  public function get_terms_and_payment_by_type_id($eid)
  {
    $result = $this->db->query("CALL get_terms_and_payment_by_type_id('".$eid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_terms_of_payment_by_tap_id($eid)
  {
    $result = $this->db->query("CALL get_terms_of_payment_by_tap_id('".$eid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function create_proformainvoice_other_charge($data)
  {
    $result = $this->db->query("CALL create_proformainvoice_other_charge('".$data['proforma_invoice_id']."','".$data['particulars']."','".$data['taxable_amount']."','".$data['otax_type']."','".$data['otax_percent']."','".$data['oamount']."')");
    save_query_in_log();
    return $result;
  }
  public function get_proforma_invoice_other_charge_by_id($qid)
  {
    $result = $this->db->query("CALL get_proforma_invoice_other_charge_by_id('".$qid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function delete_proforma_invoice_other_charge_by_id($profoid)
  {
    $result = $this->db->query("CALL delete_proforma_invoice_other_charge_by_id('".$profoid."')");
    save_query_in_log();
    return $result;
  }
  public function pi_other_charge_to_bo_other_charge_save($invoice_id, $buyer_order_id)
  {
    if($query = $this->db->query("call pi_other_charge_to_bo_other_charge_save('".$invoice_id."', '".$buyer_order_id."')"))
    {  return true; }else{ return false; } 
  }
}
?>