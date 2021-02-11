<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loadingtype_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }  
  public function get_loadingtype_list()
  {
    $result = $this->db->query("CALL get_loadingtype_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkLoadingtypeUnique($val)
  {
    $result = $this->db->query("CALL checkLoadingtypeUnique('".$val."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_loadingtype($data)
  {
    $result = $this->db->query("CALL create_loadingtype('".$data['loading_type']."','".$data['created_on']."',".$data['created_by'].")");
    save_query_in_log();
    return $result;
  }
  public function loadingtype_active($id, $data)
  {
    $result = $this->db->query("CALL loadingtype_active(".$id.",".$data.")");
    save_query_in_log();
    return $result;
  }
  public function get_loadingtype_by_id($id)
  {
    $result = $this->db->query("CALL get_loadingtype_by_id('".$id."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkLoadingtypeUniqueEdit($val,$bid)
  {
    $result = $this->db->query("CALL checkLoadingtypeUniqueEdit('".$val."','".$bid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_loadingtype($data)
  {
    $result = $this->db->query("CALL update_loadingtype('".$data['loading_type_id']."','".$data['loading_type']."','".$data['modified_on']."',".$data['modified_by'].")");
    save_query_in_log();
    return $result;
  }
  public function loadingtype_delete($bid)
  {
    $result = $this->db->query("CALL loadingtype_delete('".$bid."')");
    save_query_in_log();
    return $result;
  }

}?>