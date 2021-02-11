<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supplierpo_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  } 
  public function get_supplierpo_list()
  {
    $result = $this->db->query("CALL get_supplierpo_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_active_buyerpo_by_qty()
  {
    $result = $this->db->query("CALL get_active_buyerpo_by_qty()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_vendor_list()
  {
    $result = $this->db->query("CALL get_vendor_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_product_by_id($poid)
  {
    $result = $this->db->query("CALL get_buyer_order_product_by_id('".$poid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_product_by_id_proditemid($poid,$pid)
  {
    $result = $this->db->query("CALL get_buyer_order_product_by_id_proditemid('".$poid."','".$pid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function supplierpo_last_id()
  {
    $result = $this->db->query("CALL supplierpo_last_id()")->row();
    save_query_in_log();
    return $result;
  } 
  public function create_supplierpo($data)
  {
    $result = $this->db->query("CALL create_supplierpo('".$data['supplier_purchase_order_no']."','".$data['vendor_id']."','".$data['buyer_order_id']."','".$data['supply_date']."','".$data['delivery_place']."','".$data['total_amount']."','".$data['terms_of_condition']."','".$data['created_on']."',".$data['created_by'].",'".$data['supply_end_date']."')");
    save_query_in_log();
    return $result;
  }
  public function create_supplierpo_product($data)
  {
    $result = $this->db->query("CALL create_supplierpo_product('".$data['supplier_purchase_order_id']."','".$data['product_item_id']."','".$data['buyer_order_product_id']."','".$data['quantity']."','".$data['rate']."','".$data['amount']."')");
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_product_by_bop_id($bopid)
  {
    $result = $this->db->query("CALL get_buyer_order_product_by_bop_id('".$bopid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function update_buyer_order_sup_qty($data)
  {
    
    $result = $this->db->query("CALL update_buyer_order_sup_qty('".$data['supplier_quantity']."','".$data['buyer_order_product_id']."')");
    save_query_in_log();
    return $result;
  }
  public function get_supplierpo_by_id($spoid)
  {
    $result = $this->db->query("CALL get_supplierpo_by_id('".$spoid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function get_supplierpo_product_by_id($spoid)
  {
    $result = $this->db->query("CALL get_supplierpo_product_by_id('".$spoid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function update_supplierpo($data)
  {
    $result = $this->db->query("CALL update_supplierpo('".$data['supplier_purchase_order_id']."','".$data['delivery_place']."','".$data['total_amount']."','".$data['terms_of_condition']."','".$data['modified_on']."',".$data['modified_by'].",'".$data['supply_end_date']."')");
    save_query_in_log();
    return $result;
  }
  public function update_supplierpo_product($data)
  {
    $result = $this->db->query("CALL update_supplierpo_product('".$data['supplier_purchase_order_product_id']."','".$data['rate']."','".$data['amount']."')");
    save_query_in_log();
    return $result;
  }
  public function supplierpo_complete($data)
  {
    $result = $this->db->query("CALL supplierpo_complete('".$data['supplier_purchase_order_id']."','".$data['is_complete']."','".$data['completed_date']."')");
    save_query_in_log();
    return $result;
  }
  public function create_supplier_points($data)
  {
    $result = $this->db->query("CALL create_supplier_points('".$data['vendor_id']."','".$data['supplier_purchase_order_id']."','".$data['points']."')");
    save_query_in_log();
    return $result;
  }
  public function get_vendor_by_id($vid)
  {
    $result = $this->db->query("CALL get_vendor_by_id('".$vid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function update_vendor_points($totpoints,$vid)
  {
    $result = $this->db->query("CALL update_vendor_points('".$totpoints."','".$vid."')");
    save_query_in_log();
    return $result;
  }

}
?>