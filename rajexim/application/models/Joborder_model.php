<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Joborder_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  } 
  public function get_active_supplierpo_list()
  {
    $result = $this->db->query("CALL get_active_supplierpo_list()")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_active_employee_list()
  {
    $result = $this->db->query("CALL get_active_employee_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_joborder_list()
  {
    $result = $this->db->query("CALL get_joborder_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function joborder_last_id()
  {
    $result = $this->db->query("CALL joborder_last_id()")->row();
    save_query_in_log();
    return $result;
  }    
  public function create_joborder($data)
  {
    $result = $this->db->query("CALL create_joborder('".$data['job_order_no']."','".$data['job_order_date']."','".$data['job_order_end_date']."','".$data['supplier_purchase_order_id']."','".$data['employee_id']."','".$data['created_on']."',".$data['created_by'].")");
    save_query_in_log();
    return $result;
  }
  public function update_spo_status_by_id($data)
  {
    $result = $this->db->query("CALL update_spo_status_by_id('".$data['status']."','".$data['supplier_purchase_order_id']."')");
    save_query_in_log();
    return $result;
  }
  public function get_joborder_by_id($joid)
  {
    $result = $this->db->query("CALL get_joborder_by_id('".$joid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_joborder($data)
  {
    $result = $this->db->query("CALL update_joborder('".$data['job_order_id']."','".$data['job_order_end_date']."','".$data['modified_on']."',".$data['modified_by'].")");
    save_query_in_log();
    return $result;
  }
  public function get_joborder_item_by_id($joid)
  {
    $result = $this->db->query("CALL get_joborder_item_by_id('".$joid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_joborder_process_by_id($joid)
  {
    $result = $this->db->query("CALL get_joborder_process_by_id('".$joid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_job_order_process_by_id_date($joid,$cdate)
  {
    $result = $this->db->query("CALL get_job_order_process_by_id_date('".$joid."','".$cdate."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_user_by_id($uid)
  {
    $result = $this->db->query("CALL get_user_by_id('".$uid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_job_order_process_by_date_id($cdate,$joid)
  {
    $result = $this->db->query("CALL get_job_order_process_by_date_id('".$cdate."','".$joid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_joborder_process($data)
  {
    $result = $this->db->query("CALL create_joborder_process('".$data['job_order_id']."','".$data['process_date']."','".$data['process_type']."','".$data['quantity']."','".$data['description']."','".$data['created_on']."',".$data['created_by'].")");
    save_query_in_log();
    return $result;
  }
  public function get_joborder_process_by_jop_id($jopid)
  {
    $result = $this->db->query("CALL get_joborder_process_by_jop_id('".$jopid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_joborder_process($data)
  {
    $result = $this->db->query("CALL update_joborder_process('".$data['job_order_process_id']."','".$data['quantity']."','".$data['description']."','".$data['modified_on']."',".$data['modified_by'].")");
    save_query_in_log();
    return $result;
  }
  public function update_joborder_container_lorry_no($data)
  {
    $result = $this->db->query("CALL update_joborder_container_lorry_no('".$data['container_no']."','".$data['lorry_no']."','".$data['job_order_id']."')");
    save_query_in_log();
    return $result;
  }
  public function create_joborder_inspect($data)
  {
    $result = $this->db->query("CALL create_joborder_inspect('".$data['job_order_id']."','".$data['items']."','".$data['specification']."','".$data['tools']."','".$data['observation']."','".$data['pass_fail']."','".$data['job_order_item_date']."')");
    save_query_in_log();
    return $result;
  }
  public function get_active_loading_type()
  {
    $result = $this->db->query("CALL get_active_loading_type()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function joborder_complete($data)
  {
    $result = $this->db->query("CALL joborder_complete('".$data['job_order_id']."','".$data['is_complete']."','".$data['completed_date']."')");
    save_query_in_log();
    return $result;
  }

}
?>