<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Task_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Calcutta'); 
	}   
	public function get_all_task()
	{
		$result = $this->db->query("CALL get_all_task()")->result_array();
		save_query_in_log();
		return $result;
	}  
	public function get_task_by_assigned_to($uid)
	{
		$result = $this->db->query("CALL get_task_by_assigned_to('".$uid."')")->result_array();
		save_query_in_log();
		return $result;
	}
	public function create_task($data)
	{
		$result = $this->db->query("CALL create_task('".str_replace("'", "`", $data['task_title'])."','".str_replace("'", "`", $data['task_description'])."','".$data['task_date']."','".$data['task_end_date']."','".$data['assigned_to']."','".$data['created_on']."','".$data['created_by']."','".$data['priority']."','".$data['is_schedule']."','".$data['schedule_type']."','".$data['schedule_value']."','".$data['is_parent']."','".$data['parent_task_id']."','".$data['task_type']."')");
		save_query_in_log();
		return $result;
	} 
	public function get_task_by_id($tid)
	{
		$result = $this->db->query("CALL get_task_by_id('".$tid."')")->row();
		save_query_in_log();
		return $result;
	}
	public function update_task($data)
	{
		$result = $this->db->query("CALL update_task('".str_replace("'", "`", $data['task_title'])."','".str_replace("'", "`", $data['task_description'])."','".$data['task_date']."','".$data['task_end_date']."','".$data['assigned_to']."','".$data['modified_on']."','".$data['modified_by']."','".$data['task_id']."','".$data['priority']."','".$data['is_schedule']."','".$data['schedule_type']."','".$data['schedule_value']."','".$data['is_parent']."','".$data['parent_task_id']."','".$data['task_type']."')");
		save_query_in_log();
		return $result;
	} 
	public function get_task_comments_by_task_id($tid)
	{
		$result = $this->db->query("CALL get_task_comments_by_task_id('".$tid."')")->result_array();
		save_query_in_log();
		return $result;
	}
	public function update_task_status($data)
	{
		$result = $this->db->query("CALL update_task_status('".$data['task_id']."','".$data['status']."','".$data['completed_date']."','".$data['completed_by']."','".$data['comments']."')");
		save_query_in_log();
		return $result;
	} 
	public function create_task_comments($data)
	{
		$result = $this->db->query("CALL create_task_comments('".$data['task_id']."','".str_replace("'", "`", $data['comments'])."','".$data['created_on']."','".$data['created_by']."')");
		save_query_in_log();
		return $result;
	} 
	public function create_task_status_history($data)
	{
		$result = $this->db->query("CALL create_task_status_history('".$data['task_id']."','".$data['status']."','".$data['created_on']."','".$data['created_by']."')");
		save_query_in_log();
		return $result;
	}
	public function get_task_status_history_by_task_id($tid)
	{
		$result = $this->db->query("CALL get_task_status_history_by_task_id('".$tid."')")->result_array();
		save_query_in_log();
		return $result;
	} 
	public function get_my_task_list($uid)
	{
		$result = $this->db->query("CALL get_my_task_list('".$uid."')")->result_array();
		save_query_in_log();
		return $result;
	}
	public function get_assigned_task_list($uid)
	{
		$result = $this->db->query("CALL get_assigned_task_list('".$uid."')")->result_array();
		save_query_in_log();
		return $result;
	}
	public function get_all_task_list($uid)
	{
		$result = $this->db->query("CALL get_all_task_list('".$uid."')")->result_array();
		save_query_in_log();
		return $result;
	} 
	public function get_scheduled_task()
	{
		$result = $this->db->query("CALL get_scheduled_task()")->result_array();
		save_query_in_log();
		return $result;
	}
	public function task_next_auto_id()
    {
        $result = common_select_values('AUTO_INCREMENT', 'INFORMATION_SCHEMA.TABLES', ' TABLE_SCHEMA = database() AND TABLE_NAME = "task"', 'row');
        return $result; 
    }
    public function task_comments_next_auto_id()
    {
        $result = common_select_values('AUTO_INCREMENT', 'INFORMATION_SCHEMA.TABLES', ' TABLE_SCHEMA = database() AND TABLE_NAME = "task_comments"', 'row');
        return $result; 
    }
    public function bo_task_next_auto_id()
    {
    	$result = common_select_values('AUTO_INCREMENT', 'INFORMATION_SCHEMA.TABLES', ' TABLE_SCHEMA = database() AND TABLE_NAME = "buyer_order_task"', 'row');
        return $result;	
    }
    public function save_task_list($data)
    {
    	// print_r($data);
    	// die();
    	$this->db->insert('task_lists',$data);
    	return 1;
    }
    public function del_task_lists($task_id)
    {
    	$res = $this->db->query("DELETE FROM task_lists WHERE task_id = '".$task_id."'");
    	return 1;
    }
    public function update_task_list_completed($data,$task_list_id)
    {
    	$this->db->where('task_list_id', $task_list_id);
    	$result = $this->db->update('task_lists',$data);
    	return 1;
    }
}
?>