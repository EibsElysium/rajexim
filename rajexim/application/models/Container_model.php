<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Container_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }  
  public function get_container_list()
  {
    $result = $this->db->query("CALL get_container_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkContainerUnique($val)
  {
    $result = $this->db->query("CALL checkContainerUnique('".$val."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_container($data)
  {
    $result = $this->db->query("CALL create_container('".$data['container_name']."','".$data['min_cbm']."','".$data['max_cbm']."','".$data['max_ton']."','".$data['ton_variance']."','".$data['created_on']."',".$data['created_by'].")");
    save_query_in_log();
    return $result;
  }
  public function checkContainerUniqueEdit($val,$bid)
  {
    $result = $this->db->query("CALL checkContainerUniqueEdit('".$val."','".$bid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_container_by_id($id)
  {
    $result = $this->db->query("CALL get_container_by_id('".$id."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_container($data)
  {
    $result = $this->db->query("CALL update_container('".$data['container_id']."','".$data['container_name']."','".$data['min_cbm']."','".$data['max_cbm']."','".$data['max_ton']."','".$data['ton_variance']."','".$data['modified_on']."',".$data['modified_by'].")");
    save_query_in_log();
    return $result;
  }

}
?>