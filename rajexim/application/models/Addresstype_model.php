<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Addresstype_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }  
  public function get_addresstype_list()
  {
    $result = $this->db->query("CALL get_addresstype_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkAddresstypeUnique($val)
  {
    $result = $this->db->query("CALL checkAddresstypeUnique('".$val."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_addresstype($data)
  {
    $result = $this->db->query("CALL create_addresstype('".$data['address_type']."','".$data['created_on']."',".$data['created_by'].")");
    save_query_in_log();
    return $result;
  }
  public function addresstype_active($id, $data)
  {
    $result = $this->db->query("CALL addresstype_active(".$id.",".$data.")");
    save_query_in_log();
    return $result;
  }
  public function get_addresstype_by_id($id)
  {
    $result = $this->db->query("CALL get_addresstype_by_id('".$id."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkAddresstypeUniqueEdit($val,$bid)
  {
    $result = $this->db->query("CALL checkAddresstypeUniqueEdit('".$val."','".$bid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_addresstype($data)
  {
    $result = $this->db->query("CALL update_addresstype('".$data['address_type_id']."','".$data['address_type']."','".$data['modified_on']."',".$data['modified_by'].")");
    save_query_in_log();
    return $result;
  }
  public function addresstype_delete($bid)
  {
    $result = $this->db->query("CALL addresstype_delete('".$bid."')");
    save_query_in_log();
    return $result;
  }

}?>