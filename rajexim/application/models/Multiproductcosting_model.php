<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcosting_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }     
  public function get_multi_product_costing_list()
  {
    $result = $this->db->query("CALL get_multi_product_costing_list()")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_multi_product_costing_by_id($pcid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_by_id('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_lead_list()
  {
    $result = $this->db->query("CALL get_lead_list()")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_multi_product_costing_type_list($tid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_type_list('".$tid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_product_item_list()
  {
    $result = $this->db->query("CALL get_product_item_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function multi_product_costing_last_id()
  {
    $result = $this->db->query("CALL multi_product_costing_last_id()")->row();
    save_query_in_log();
    return $result;
  } 
  public function create_multi_product_costing($data)
  {
    $result = $this->db->query("CALL create_multi_product_costing('".$data['lead_id']."','".$data['margin_in_percent']."','".$data['created_on']."','".$data['created_by']."','".$data['multi_product_costing_no']."','".$data['parent_costing_id']."','".$data['is_draft']."','".$data['revised']."','".$data['container_id']."','".$data['cha_expense']."','".$data['cha_based_on']."','".$data['multi_product_costing_template_id']."')");
    save_query_in_log();
    return $result;
  }
  public function create_multi_product_costing_product($data)
  {
    $result = $this->db->query("CALL create_multi_product_costing_product('".$data['multi_product_costing_id']."','".$data['product_item_id']."','".$data['multi_product_costing_type_id']."','".$data['multi_product_costing_input']."','".$data['product_count_no']."','".$data['sku_unit_id']."','".$data['product_item_display_name_id']."','".$data['product_id']."')");
    save_query_in_log();
    return $result;
  }
  public function multi_product_costing_last_parent_id()
  {
    $result = $this->db->query("CALL multi_product_costing_last_parent_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_by_parent_id($parcid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_by_parent_id('".$parcid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_product_group_by_id($mpcid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_product_group_by_id('".$mpcid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_product_by_item_type_id($pcno,$mpctid,$mpcid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_product_by_item_type_id('".$pcno."','".$mpctid."','".$mpcid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_by_no($pcno)
  {
    $result = $this->db->query("CALL get_multi_product_costing_by_no('".$pcno."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function get_multi_product_costing_by_revised($pcid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_by_revised('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function update_multi_product_costing($data)
  {
    $result = $this->db->query("CALL update_multi_product_costing('".$data['multi_product_costing_id']."','".$data['lead_id']."','".$data['margin_in_percent']."','".$data['modified_on']."','".$data['modified_by']."','".$data['parent_costing_id']."','".$data['is_draft']."','".$data['revised']."','".$data['container_id']."','".$data['cha_expense']."','".$data['cha_based_on']."','".$data['multi_product_costing_template_id']."')");
    save_query_in_log();
    return $result;
  }
  public function delete_multi_product_costing_product_by_mpcid($mpcid)
  {
    $result = $this->db->query("CALL delete_multi_product_costing_product_by_mpcid('".$mpcid."')");
    save_query_in_log();
    return $result;
  }
  public function multi_product_costing_delete($data)
  {
    $result = $this->db->query("CALL multi_product_costing_delete('".$data['multi_product_costing_id']."','".$data['status']."')");
    save_query_in_log();
    return $result;
  }
  public function get_container_list()
  {
    $result = $this->db->query("CALL get_container_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_container_by_id($cid)
  {
    $result = $this->db->query("CALL get_container_by_id('".$cid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function multi_product_costing_approve($data)
  {
    $result = $this->db->query("CALL multi_product_costing_approve('".$data['multi_product_costing_id']."','".$data['is_approve']."','".$data['approved_by']."','".$data['approved_date']."')");
    save_query_in_log();
    return $result;
  }
  public function get_product_list()
  {
    $result = $this->db->query("CALL get_product_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_display_name_by_id($cid)
  {
    $result = $this->db->query("CALL get_display_name_by_id('".$cid."')")->row();
    save_query_in_log();
    return $result;
  }     
  public function get_multi_product_costing_template_list()
  {
    $result = $this->db->query("CALL get_multi_product_costing_template_list()")->result_array();
    save_query_in_log();
    return $result;
  }  
  public function get_multi_product_costing_template_type_by_template_id($tid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_template_type_by_template_id('".$tid."')")->result_array();
    save_query_in_log();
    return $result;
  } 

}
?>