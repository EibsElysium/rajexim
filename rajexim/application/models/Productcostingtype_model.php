<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productcostingtype_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }  
  public function get_product_costing_category_list()
  {
    $result = $this->db->query("CALL get_product_costing_category_list()")->result_array();
    save_query_in_log();
    return $result;
  }  
  public function get_product_costing_type_list()
  {
    $result = $this->db->query("CALL get_product_costing_type_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function create_product_costing_type($data)
  {
    $result = $this->db->query("CALL create_product_costing_type('".$data['product_costing_category_id']."','".$data['product_costing_type']."','".$data['is_percent']."','".$data['math_action']."','".$data['created_on']."','".$data['created_by']."','".$data['type_costing_category']."','".$data['is_edit']."','".$data['is_default']."','".$data['is_input']."')");
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_type_by_id($pctid)
  {
    $result = $this->db->query("CALL get_product_costing_type_by_id('".$pctid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_product_costing_type($data)
  {
    $result = $this->db->query("CALL update_product_costing_type('".$data['product_costing_type_id']."','".$data['product_costing_category_id']."','".$data['product_costing_type']."','".$data['is_percent']."','".$data['math_action']."','".$data['modified_on']."','".$data['modified_by']."','".$data['type_costing_category']."','".$data['is_edit']."','".$data['is_default']."','".$data['is_input']."')");
    save_query_in_log();
    return $result;
  }

}
?>