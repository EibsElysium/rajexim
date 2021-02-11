<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productcostingcategory_model extends CI_Model 
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
  public function get_product_costing_category_by_id($pccid)
  {
    $result = $this->db->query("CALL get_product_costing_category_by_id('".$pccid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueProductCostingCategory($qstage)
  {
    $result = $this->db->query("CALL checkUniqueProductCostingCategory('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_product_costing_category($data)
  {
    $result = $this->db->query("CALL create_product_costing_category('".$data['product_costing_category_name']."','".$data['parent_product_costing_category_id']."','".$data['math_action']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function checkUniqueProductCostingCategoryEdit($qstage,$pccid)
  {
    $result = $this->db->query("CALL checkUniqueProductCostingCategoryEdit('".$qstage."','".$pccid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_product_costing_category($data)
  {
    $result = $this->db->query("CALL update_product_costing_category('".$data['product_costing_category_name']."','".$data['parent_product_costing_category_id']."','".$data['math_action']."','".$data['modified_on']."','".$data['modified_by']."','".$data['product_costing_category_id']."')");
    save_query_in_log();
    return $result;
  }

}
