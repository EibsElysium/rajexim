<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productcosting_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }   
  public function get_product_costing_list()
  {
    $result = $this->db->query("CALL get_product_costing_list()")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_product_list()
  {
    $result = $this->db->query("CALL get_product_list()")->result_array();
    save_query_in_log();
    return $result;
  }  
  public function get_lead_list()
  {
    $result = $this->db->query("CALL get_lead_list()")->result_array();
    save_query_in_log();
    return $result;
  }  
  public function get_product_costing_product_mapping_by_pid($pid)
  {
    $result = $this->db->query("CALL get_product_costing_product_mapping_by_pid('".$pid."')")->result_array();
    save_query_in_log();
    return $result;
  }  
  public function get_product_by_id($pid)
  {
    $result = $this->db->query("CALL get_product_by_id('".$pid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_product_item_by_product_id($pid)
  {
    $result = $this->db->query("CALL get_product_item_by_product_id('".$pid."')")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_product_item_by_id($piid)
  {
    $result = $this->db->query("CALL get_product_item_by_id('".$piid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function get_product_costing_stage_by_piid($piid)
  {
    $result = $this->db->query("CALL get_product_costing_stage_by_piid('".$piid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_stage_by_id($piid)
  {
    $result = $this->db->query("CALL get_product_costing_stage_by_id('".$piid."')")->row();
    save_query_in_log();
    return $result;
  }  
  public function create_product_costing($data)
  {
    $result = $this->db->query("CALL create_product_costing('".$data['lead_id']."','".$data['product_id']."','".$data['product_item_id']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function product_costing_last_id()
  {
    $result = $this->db->query("CALL product_costing_last_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function create_product_costing_input($data)
  {
    $result = $this->db->query("CALL create_product_costing_input('".$data['product_costing_id']."','".$data['product_costing_type_id']."','".$data['product_costing_input']."')");
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_by_id($pcid)
  {
    $result = $this->db->query("CALL get_product_costing_by_id('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_input_by_pctype_pcid($pctid,$pcid)
  {
    $result = $this->db->query("CALL get_product_costing_input_by_pctype_pcid('".$pctid."','".$pcid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_product_costing($data)
  {
    $result = $this->db->query("CALL update_product_costing('".$data['product_costing_id']."','".$data['lead_id']."','".$data['product_id']."','".$data['product_item_id']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }
  public function delete_product_costing_input_by_pcid($pcid)
  {
    $result = $this->db->query("CALL delete_product_costing_input_by_pcid('".$pcid."')");
    save_query_in_log();
    return $result;
  }

}
?>