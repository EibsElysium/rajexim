<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time',259200);
class Taskcron extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Task_model'));
  }

  public function scheduledtask()
  {
    $schtask = $this->Task_model->get_scheduled_task();

    if(count($schtask)>0)
    {
        $cdate = date('Y-m-d');
        $con = date('Y-m-d H:i:s');
        foreach($schtask as $stask)
        {
            if($stask['is_parent']==0)
            {
                if($stask['schedule_type']=='Daily')
                {
                    $this->db->query("INSERT INTO `task`(`task_date`, `task_end_date`, `is_parent`, `parent_task_id`, `assigned_to`, `task_title`, `task_description`, `priority`, `created_on`, `created_by`) VALUES ('".$cdate."','".$cdate."','".$stask['is_parent']."','".$stask['parent_task_id']."','".$stask['assigned_to']."','".$stask['task_title']."','".$stask['task_description']."','".$stask['priority']."','".$con."','".$stask['created_by']."')");
                }
                elseif($stask['schedule_type']=='Weekly')
                {
                    $sval = explode(',', $stask['schedule_value']);
                    if(in_array(date('l'), $sval))
                    {
                        $this->db->query("INSERT INTO `task`(`task_date`, `task_end_date`, `is_parent`, `parent_task_id`, `assigned_to`, `task_title`, `task_description`, `priority`, `created_on`, `created_by`) VALUES ('".$cdate."','".$cdate."','".$stask['is_parent']."','".$stask['parent_task_id']."','".$stask['assigned_to']."','".$stask['task_title']."','".$stask['task_description']."','".$stask['priority']."','".$con."','".$stask['created_by']."')");
                    }
                }
                else
                {
                    $sval = explode(',', $stask['schedule_value']);
                    if(in_array(date('j'), $sval))
                    {
                        $this->db->query("INSERT INTO `task`(`task_date`, `task_end_date`, `is_parent`, `parent_task_id`, `assigned_to`, `task_title`, `task_description`, `priority`, `created_on`, `created_by`) VALUES ('".$cdate."','".$cdate."','".$stask['is_parent']."','".$stask['parent_task_id']."','".$stask['assigned_to']."','".$stask['task_title']."','".$stask['task_description']."','".$stask['priority']."','".$con."','".$stask['created_by']."')");
                    }
                }
            }
            else
            {
                if($stask['schedule_type']=='Daily')
                {
                    $task_id = $this->Task_model->task_next_auto_id();
                    
                    $this->db->query("INSERT INTO `task`(`task_date`, `task_end_date`, `is_parent`, `parent_task_id`, `assigned_to`, `task_title`, `task_description`, `priority`, `created_on`, `created_by`) VALUES ('".$cdate."','".$cdate."','".$stask['is_parent']."','".$stask['parent_task_id']."','".$stask['assigned_to']."','".$stask['task_title']."','".$stask['task_description']."','".$stask['priority']."','".$con."','".$stask['created_by']."')");

                    $ptid = $task_id->AUTO_INCREMENT;
                    $ato = explode(",",$stask['assigned_to']);
                    for($uc=0;$uc<count($ato);$uc++)
                    {
                        $this->db->query("INSERT INTO `task`(`task_date`, `task_end_date`, `is_parent`, `parent_task_id`, `assigned_to`, `task_title`, `task_description`, `priority`, `created_on`, `created_by`) VALUES ('".$cdate."','".$cdate."','0','".$ptid."','".$ato[$uc]."','".$stask['task_title']."','".$stask['task_description']."','".$stask['priority']."','".$con."','".$stask['created_by']."')");
                    }
                }
                elseif($stask['schedule_type']=='Weekly')
                {
                    $sval = explode(',', $stask['schedule_value']);
                    if(in_array(date('l'), $sval))
                    {
                        $task_id = $this->Task_model->task_next_auto_id();

                        $this->db->query("INSERT INTO `task`(`task_date`, `task_end_date`, `is_parent`, `parent_task_id`, `assigned_to`, `task_title`, `task_description`, `priority`, `created_on`, `created_by`) VALUES ('".$cdate."','".$cdate."','".$stask['is_parent']."','".$stask['parent_task_id']."','".$stask['assigned_to']."','".$stask['task_title']."','".$stask['task_description']."','".$stask['priority']."','".$con."','".$stask['created_by']."')");

                        $ptid = $task_id->AUTO_INCREMENT;
                        $ato = explode(",",$stask['assigned_to']);
                        for($uc=0;$uc<count($ato);$uc++)
                        {
                            $this->db->query("INSERT INTO `task`(`task_date`, `task_end_date`, `is_parent`, `parent_task_id`, `assigned_to`, `task_title`, `task_description`, `priority`, `created_on`, `created_by`) VALUES ('".$cdate."','".$cdate."','0','".$ptid."','".$ato[$uc]."','".$stask['task_title']."','".$stask['task_description']."','".$stask['priority']."','".$con."','".$stask['created_by']."')");
                        }
                    }
                }
                else
                {
                    $sval = explode(',', $stask['schedule_value']);
                    if(in_array(date('j'), $sval))
                    {
                        $task_id = $this->Task_model->task_next_auto_id();

                        $this->db->query("INSERT INTO `task`(`task_date`, `task_end_date`, `is_parent`, `parent_task_id`, `assigned_to`, `task_title`, `task_description`, `priority`, `created_on`, `created_by`) VALUES ('".$cdate."','".$cdate."','".$stask['is_parent']."','".$stask['parent_task_id']."','".$stask['assigned_to']."','".$stask['task_title']."','".$stask['task_description']."','".$stask['priority']."','".$con."','".$stask['created_by']."')");

                        $ptid = $task_id->AUTO_INCREMENT;
                        $ato = explode(",",$stask['assigned_to']);
                        for($uc=0;$uc<count($ato);$uc++)
                        {
                            $this->db->query("INSERT INTO `task`(`task_date`, `task_end_date`, `is_parent`, `parent_task_id`, `assigned_to`, `task_title`, `task_description`, `priority`, `created_on`, `created_by`) VALUES ('".$cdate."','".$cdate."','0','".$ptid."','".$ato[$uc]."','".$stask['task_title']."','".$stask['task_description']."','".$stask['priority']."','".$con."','".$stask['created_by']."')");
                        }
                    }
                }
            }
        }
    }
  }

}
?>