<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buyerorder_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_buyer_order_list()
  {
    $result = $this->db->query("CALL get_buyer_order_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_product_by_id($qid)
  {
    $result = $this->db->query("CALL get_buyer_order_product_by_id('".$qid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_by_id($iid)
  {
    $result = $this->db->query("CALL get_buyer_order_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function invoice_last_id()
  {
    $result = $this->db->query("CALL invoice_last_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function create_invoice($data)
  {
    $result = $this->db->query("CALL create_invoice('".$data['buyer_order_id']."','".$data['exporter_id']."','".$data['invoice_no']."','".$data['subject']."','".$data['terms_of_payment_type_id']."','".$data['invoice_date']."','".$data['buyer_confirmation_date']."','".$data['other_reference']."','".$data['pi_stage_id']."','".$data['lead_id']."','".$data['pre_carriage_by_id']."','".$data['place_of_receipt_by_pre_carrier']."','".$data['vessel_flight_id']."','".$data['port_of_loading_id']."','".$data['port_of_discharge_id']."','".$data['final_destination_id']."','".$data['currency_id']."','".$data['rate']."','".$data['bank_detail_id']."','".$data['created_on']."','".$data['created_by']."','".$data['is_local']."','".$data['grand_total']."','".$data['terms_and_payment_id']."','".$data['price']."','".$data['despatched_through']."','".$data['terms_of_delivery']."')");
    save_query_in_log();
    return $result;
  }
  public function create_invoice_product($data)
  {
    $result = $this->db->query("CALL create_invoice_product('".$data['invoice_id']."','".$data['buyer_order_product_id']."','".$data['vendor_id']."','".$data['marks_and_no']."','".$data['product_item_id']."','".$data['quantity']."','".$data['rate']."','".$data['amount']."','".$data['product_item_display_name_id']."','".$data['sku_unit_id']."','".$data['specification']."','".$data['tax_type']."','".$data['tax_percent']."')");
    save_query_in_log();
    return $result;
  }
  public function update_buyer_order_inv_qty($data)
  {
    $result = $this->db->query("CALL update_buyer_order_inv_qty('".$data['invoice_quantity']."','".$data['buyer_order_product_id']."')");
    save_query_in_log();
    return $result;
  }
  public function update_bo_feedback_mail_status_by_id($data)
  {
    $result = $this->db->query("CALL update_bo_feedback_mail_status_by_id('".$data['po_id']."','".$data['feedback_mail_status']."')");
    save_query_in_log();
    return $result;
  }
  public function email_template_by_id($iid)
  {
    $result = $this->db->query("CALL email_template_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function buyer_order_feedback_list($iid)
  {
    $result = $this->db->query("CALL buyer_order_feedback_list('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function buyerorder_complete($data)
  {
    $result = $this->db->query("CALL buyerorder_complete('".$data['buyer_order_id']."','".$data['is_complete']."','".$data['completed_date']."')");
    save_query_in_log();
    return $result;
  }
  public function get_user_list()
  {
    $result = $this->db->query("CALL get_user_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_task_list($boid)
  {
    $result = $this->db->query("CALL get_buyer_order_task_list('".$boid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function create_buyer_order_task($data)
  {
    $result = $this->db->query("CALL create_buyer_order_task('".$data['buyer_order_task_date']."','".$data['task']."','".$data['assigned_to']."','".$data['buyer_order_task_end_date']."','".$data['buyer_order_id']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_task_by_id($iid)
  {
    $result = $this->db->query("CALL get_buyer_order_task_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_buyer_order_task($data)
  {
    $result = $this->db->query("CALL update_buyer_order_task('".$data['buyer_order_task_id']."','".$data['remarks']."','".$data['modified_on']."','".$data['modified_by']."','".$data['status']."')");
    save_query_in_log();
    return $result;
  }
  public function create_buyer_order_task_remarks($data)
  {
    $result = $this->db->query("CALL create_buyer_order_task_remarks('".$data['buyer_order_task_id']."','".$data['remarks']."','".$data['modified_on']."','".$data['modified_by']."','".$data['status']."')");
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_task_remarks_by_botid($iid)
  {
    $result = $this->db->query("CALL get_buyer_order_task_remarks_by_botid('".$iid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_followup_default_category()
  {
    $result = $this->db->query("CALL get_followup_default_category()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_followup_other_category()
  {
    $result = $this->db->query("CALL get_followup_other_category()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_followup_sheet_stage_list()
  {
    $result = $this->db->query("CALL get_followup_sheet_stage_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_supplierpo_by_bo_id($iid)
  {
    $result = $this->db->query("CALL get_supplierpo_by_bo_id('".$iid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function create_buyerorder_followup($data)
  {
    $result = $this->db->query("CALL create_buyerorder_followup('".$data['buyer_order_id']."','".$data['automatic_field']."','".$data['followup_sheet_category_id']."','".$data['input_field']."','".$data['remarks']."','".$data['followup_sheet_stage_id']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_followup_sheet($iid)
  {
    $result = $this->db->query("CALL get_buyer_order_followup_sheet('".$iid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function delete_buyerorder_followup($boid)
  {
    $result = $this->db->query("call delete_buyerorder_followup('".$boid."')");
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_benefit($iid)
  {
    $result = $this->db->query("CALL get_buyer_order_benefit('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_benefit_details($iid)
  {
    $result = $this->db->query("CALL get_buyer_order_benefit_details('".$iid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function create_buyer_order_benefit($data)
  {
    $result = $this->db->query("CALL create_buyer_order_benefit('".$data['buyer_order_id']."','".$data['total_tt_receipt']."','".$data['total_pur_value']."','".$data['contribution']."','".$data['meis']."','".$data['drawback']."')");
    save_query_in_log();
    return $result;
  }
  public function buyer_order_benefit_last_id()
  {
    $result = $this->db->query("CALL buyer_order_benefit_last_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function create_buyer_order_benefit_details($data)
  {
    $result = $this->db->query("CALL create_buyer_order_benefit_details('".$data['buyer_order_benefit_id']."','".$data['buyer_order_benefit_date']."','".$data['particulars']."','".$data['tt_receipt']."','".$data['pur_value']."','".$data['total_pur_value']."','".$data['is_tot']."','".$data['cur_rate']."','".$data['con_rate']."')");
    save_query_in_log();
    return $result;
  }
  public function update_buyer_order_benefit($data)
  {
    $result = $this->db->query("CALL update_buyer_order_benefit('".$data['buyer_order_id']."','".$data['total_tt_receipt']."','".$data['total_pur_value']."','".$data['contribution']."','".$data['meis']."','".$data['drawback']."')");
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_benefit_by_boid($boid)
  {
    $result = $this->db->query("CALL get_buyer_order_benefit_by_boid('".$boid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function delete_buyer_order_benefit_details($bobid)
  {
    $result = $this->db->query("call delete_buyer_order_benefit_details('".$bobid."')");
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_other_charge_by_id($qid)
  {
    $result = $this->db->query("CALL get_buyer_order_other_charge_by_id('".$qid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_invoice_other_charge($data)
  {
    $result = $this->db->query("CALL create_invoice_other_charge('".$data['invoice_id']."','".$data['particulars']."','".$data['taxable_amount']."','".$data['otax_type']."','".$data['otax_percent']."','".$data['oamount']."')");
    save_query_in_log();
    return $result;
  }
  public function lead_by_id($lid)
  {
    $result = $this->db->query("CALL lead_by_id('".$lid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_local_invoice_contact_book($data)
  {
    $result = $this->db->query("CALL update_local_invoice_contact_book('".$data['contact_book_id']."','".$data['state_name']."','".$data['state_code']."','".$data['gst_no']."','".$data['vat_tin_no']."')");
    save_query_in_log();
    return $result;
  }

}
?>