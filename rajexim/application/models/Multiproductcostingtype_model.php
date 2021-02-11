<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcostingtype_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }  
  public function get_multi_product_costing_type_list()
  {
    $result = $this->db->query("CALL get_multi_product_costing_type_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function create_multi_product_costing_type($data)
  {
    $result = $this->db->query("CALL create_multi_product_costing_type('".$data['multi_product_costing_type']."','".$data['is_edit']."','".$data['math_action']."','".$data['multi_product_costing_type_id_math']."','".$data['created_on']."','".$data['created_by']."','".$data['multi_product_costing_type_id_math_1']."','".$data['is_nop_greater']."')");
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_type_by_id($pctid)
  {
    $result = $this->db->query("CALL get_multi_product_costing_type_by_id('".$pctid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function udpate_multi_product_costing_type($data)
  {
    $result = $this->db->query("CALL udpate_multi_product_costing_type('".$data['multi_product_costing_type_id']."','".$data['multi_product_costing_type']."','".$data['is_edit']."','".$data['math_action']."','".$data['multi_product_costing_type_id_math']."','".$data['modified_on']."','".$data['modified_by']."','".$data['multi_product_costing_type_id_math_1']."','".$data['is_nop_greater']."')");
    save_query_in_log();
    return $result;
  }

}
?>