<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcostingproduct_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_multi_product_costing_product_list()
  {
    $result = $this->db->query("CALL get_multi_product_costing_product_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_lead_list()
  {
    $result = $this->db->query("CALL get_lead_list()")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_multi_product_costing_type_prod_list()
  {
    $result = $this->db->query("CALL get_multi_product_costing_type_prod_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_container_list()
  {
    $result = $this->db->query("CALL get_container_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_currency_list()
  {
    $result = $this->db->query("CALL get_currency_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_container_by_id($cid)
  {
    $result = $this->db->query("CALL get_container_by_id('".$cid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_product_unit()
  {
    $result = $this->db->query("CALL get_product_unit()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_prod_costing_by_lead_id($cid)
  {
    $result = $this->db->query("CALL get_prod_costing_by_lead_id('".$cid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_input_by_type_pcid($pcid)
  {
    $result = $this->db->query("CALL get_product_costing_input_by_type_pcid('".$pcid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_by_id($pcid)
  {
    $result = $this->db->query("CALL get_product_costing_by_id('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_last_product_costing_stage_by_product_item_id($piid)
  {
    $result = $this->db->query("CALL get_last_product_costing_stage_by_product_item_id('".$piid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function multi_product_costing_product_last_parent_id()
  {
    $result = $this->db->query("CALL multi_product_costing_product_last_parent_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function multi_product_costing_product_last_id()
  {
    $result = $this->db->query("CALL multi_product_costing_product_last_id()")->row();
    save_query_in_log();
    return $result;
  } 
  public function create_multi_product_costing_prod_v2($data)
  {
    $result = $this->db->query("CALL create_multi_product_costing_prod_v2('".$data['lead_id']."','".$data['currency_id']."','".$data['container_id']."','".$data['cha_expense']."','".$data['conversion_rate']."','".$data['commission_charge']."','".$data['created_on']."','".$data['created_by']."','".$data['multi_product_costing_prod_v2_no']."','".$data['parent_costing_id']."','".$data['is_draft']."','".$data['revised']."','".$data['bank_charge']."','".$data['freight_charge']."')");
    save_query_in_log();
    return $result;
  } 
  public function create_multi_product_costing_prod_v2_input($data)
  {
    $result = $this->db->query("CALL create_multi_product_costing_prod_v2_input('".$data['multi_product_costing_prod_v2_id']."','".$data['product_item_id']."','".$data['purchase_cost']."','".$data['margin_in_percent']."','".$data['margin_value']."','".$data['quantity']."','".$data['product_costing_stage_id']."','".$data['in_kg']."','".$data['product_costing_stage_value']."','".$data['cha_per_quantity']."','".$data['commission_charge_per_quantity']."','".$data['fob_value']."','".$data['bank_charge']."','".$data['total_fob_value']."','".$data['fob_value_in_currency']."','".$data['freight_per_quantity']."','".$data['cnf_price']."','".$data['total_price']."','".$data['total_margin']."','".$data['total_cha']."','".$data['total_commission_charge']."','".$data['total_freight']."','".$data['container_in_percent']."','".$data['input_product_costing_stage_id']."','".$data['input_product_costing_stage_value']."','".$data['product_item_display_name_id']."')");
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_product_by_id($pcid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_product_by_id('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_product_by_parent_id($parcid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_product_by_parent_id('".$parcid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_product_input_by_id($parcid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_product_input_by_id('".$parcid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function multi_product_costing_product_delete($data)
  {
    $result = $this->db->query("CALL multi_product_costing_product_delete('".$data['multi_product_costing_prod_v2_id']."','".$data['status']."')");
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_prod_by_no($pcno)
  {
    $result = $this->db->query("CALL get_multi_product_costing_prod_by_no('".$pcno."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function get_multi_product_costing_prod_by_revised($pcid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_prod_by_revised('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function update_multi_product_costing_prod_v2($data)
  {
    $result = $this->db->query("CALL update_multi_product_costing_prod_v2('".$data['multi_product_costing_prod_v2_id']."','".$data['lead_id']."','".$data['currency_id']."','".$data['container_id']."','".$data['cha_expense']."','".$data['conversion_rate']."','".$data['commission_charge']."','".$data['modified_on']."','".$data['modified_by']."','".$data['parent_costing_id']."','".$data['is_draft']."','".$data['revised']."','".$data['bank_charge']."','".$data['freight_charge']."')");
    save_query_in_log();
    return $result;
  }
  public function delete_multi_product_costing_prod_input_by_mpcpid($mpcid)
  {
    $result = $this->db->query("CALL delete_multi_product_costing_prod_input_by_mpcpid('".$mpcid."')");
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_stage_by_piid($piid)
  {
    $result = $this->db->query("CALL get_product_costing_stage_by_piid('".$piid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_stage_by_id($pcsid)
  {
    $result = $this->db->query("CALL get_product_costing_stage_by_id('".$pcsid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_currency_by_id($cid)
  {
    $result = $this->db->query("CALL get_currency_by_id('".$cid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_product_item_list()
  {
    $result = $this->db->query("CALL get_product_item_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function multi_product_costing_product_approve($data)
  {
    $result = $this->db->query("CALL multi_product_costing_product_approve('".$data['multi_product_costing_prod_v2_id']."','".$data['is_approve']."','".$data['approved_by']."','".$data['approved_date']."')");
    save_query_in_log();
    return $result;
  }
  public function get_product_item_by_container_id($cid)
  {
    $result = $this->db->query("CALL get_product_item_by_container_id('".$cid."')")->result_array();
    save_query_in_log();
    return $result;
  }

}
?>