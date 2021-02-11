<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcostingtypeproduct_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_multi_product_costing_type_prod_list()
  {
    $result = $this->db->query("CALL get_multi_product_costing_type_prod_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function create_multi_product_costing_type_product($data)
  {
    $result = $this->db->query("CALL create_multi_product_costing_type_product('".$data['multi_product_costing_type_product']."','".$data['math_action']."','".$data['created_on']."',".$data['created_by'].")");
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_type_product_by_id($id)
  {
    $result = $this->db->query("CALL get_multi_product_costing_type_product_by_id('".$id."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_multi_product_costing_type_product($data)
  {
    $result = $this->db->query("CALL update_multi_product_costing_type_product('".$data['multi_product_costing_type_product_id']."','".$data['multi_product_costing_type_product']."','".$data['math_action']."','".$data['modified_on']."',".$data['modified_by'].")");
    save_query_in_log();
    return $result;
  }

}
?>