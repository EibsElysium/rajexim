<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcostingtemplate_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }  
  public function get_multi_product_costing_template_list()
  {
    $result = $this->db->query("CALL get_multi_product_costing_template_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function create_multi_product_costing_template($data)
  {
    $result = $this->db->query("CALL create_multi_product_costing_template('".$data['multi_product_costing_template']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_template_last_id()
  {
    $result = $this->db->query("CALL get_multi_product_costing_template_last_id()")->row();
    save_query_in_log();
    return $result;
  }   
  public function get_multi_product_costing_type_by_mpc_template_id_stage_no($mpctid,$sno)
  {
      $result = $this->db->query("CALL get_multi_product_costing_type_by_mpc_template_id_stage_no('".$mpctid."','".$sno."')")->row();
      save_query_in_log();
      return $result;
  }  
  public function update_multi_product_costing_template_type($data,$mpctid)
  {
      $result = $this->db->query("CALL update_multi_product_costing_template_type('".$data['multi_product_costing_template_id']."','".$data['stage_no']."','".$data['multi_product_costing_type']."','".$data['is_edit']."','".$data['is_display']."','".$data['math_action']."','".$data['multi_product_costing_type_id_math']."','".$data['multi_product_costing_type_id_math_1']."','".$data['is_nop_greater']."','".$data['modified_on']."','".$data['modified_by']."','".$mpctid."')");
      save_query_in_log();
      return $result;
  }  
  public function create_multi_product_costing_template_type($data)
  {
      $result = $this->db->query("CALL create_multi_product_costing_template_type('".$data['multi_product_costing_template_id']."','".$data['stage_no']."','".$data['multi_product_costing_type']."','".$data['is_edit']."','".$data['is_display']."','".$data['math_action']."','".$data['multi_product_costing_type_id_math']."','".$data['multi_product_costing_type_id_math_1']."','".$data['is_nop_greater']."','".$data['created_on']."','".$data['created_by']."')");
      save_query_in_log();
      return $result;
  } 
  public function get_multi_product_costing_template_type_by_template_id($mpctid)
  {
      $result = $this->db->query("CALL get_multi_product_costing_template_type_by_template_id('".$mpctid."')")->result_array();
      save_query_in_log();
      return $result;
  } 
  //To check unique template name procedure
  public function checkUniqueTemplateName($qstage)
  {
    $result = $this->db->query("CALL checkUniqueTemplateName('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_multi_product_costing_template_by_id($mpctid)
  {
      $result = $this->db->query("CALL get_multi_product_costing_template_by_id('".$mpctid."')")->row();
      save_query_in_log();
      return $result;
  } 
  public function multi_product_costing_type_by_template_id($mpctid)
  {
      $result = $this->db->query("CALL multi_product_costing_type_by_template_id('".$mpctid."')")->result_array();
      save_query_in_log();
      return $result;
  } 

}
?>