<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  } 
  public function get_employee_list()
  {
    $result = $this->db->query("CALL get_employee_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function last_id()
  {
    $result = $this->db->query("CALL employee_last_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function get_active_designation()
  {
    $result = $this->db->query("CALL get_active_designation()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function employee_unique_cno($name)
  {
    $result = $this->db->query("CALL employee_unique_cno('".$name."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_employee($data)
  {
    $result = $this->db->query("CALL create_employee('".$data['employee_no']."','".$data['first_name']."','".$data['last_name']."','".$data['display_name']."','".$data['contact_no']."',".$data['gender'].",'".$data['address']."','".$data['profile_image']."',".$data['status'].",'".$data['created_on']."',".$data['created_by'].",'".$data['designation_id']."','".$data['area']."')");
    save_query_in_log();
    return $result;
  }
  public function get_employee_by_id($eid)
  {
    $result = $this->db->query("CALL get_employee_by_id('".$eid."')")->row_array();
    save_query_in_log();
    return $result;
  }
  public function employee_unique_cno_edit($name)
  {
    $result = $this->db->query("CALL employee_unique_cno_edit('".$name['value']."',".$name['id'].")")->row();
    save_query_in_log();
    return $result;
  }
  public function update_employee($data)
  {
    $result = $this->db->query("CALL update_employee('".$data['employee_id']."','".$data['employee_no']."','".$data['first_name']."','".$data['last_name']."','".$data['display_name']."','".$data['contact_no']."',".$data['gender'].",'".$data['address']."','".$data['profile_image']."','".$data['modified_on']."',".$data['modified_by'].",'".$data['designation_id']."','".$data['area']."')");
    save_query_in_log();
    return $result;
  }
  public function employee_delete($data)
  {
    $result = $this->db->query("CALL employee_delete(".$data.")");
    save_query_in_log();
    return $result;
  }
  public function employee_active($data, $id)
  {
    $result = $this->db->query("CALL employee_active(".$data.",".$id.")");
    save_query_in_log();
    return $result;
  }

}
?>