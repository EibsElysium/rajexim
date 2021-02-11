<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Designation_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }  
  public function get_designation_list()
  {
    $result = $this->db->query("CALL get_designation_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkDesignationUnique($val)
  {
    $result = $this->db->query("CALL checkDesignationUnique('".$val."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_designation($data)
  {
    $result = $this->db->query("CALL create_designation('".$data['designation']."','".$data['created_on']."',".$data['created_by'].")");
    save_query_in_log();
    return $result;
  }
  public function designation_active($id, $data)
  {
    $result = $this->db->query("CALL designation_active(".$id.",".$data.")");
    save_query_in_log();
    return $result;
  }
  public function get_designation_by_id($id)
  {
    $result = $this->db->query("CALL get_designation_by_id('".$id."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkDesignationUniqueEdit($val,$bid)
  {
    $result = $this->db->query("CALL checkDesignationUniqueEdit('".$val."','".$bid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_designation($data)
  {
    $result = $this->db->query("CALL update_designation('".$data['designation_id']."','".$data['designation']."','".$data['modified_on']."',".$data['modified_by'].")");
    save_query_in_log();
    return $result;
  }
  public function designation_delete($bid)
  {
    $result = $this->db->query("CALL designation_delete('".$bid."')");
    save_query_in_log();
    return $result;
  }

}?>