<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Followupsheetstage_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_followup_sheet_stage_list()
  {
    $result = $this->db->query("CALL get_followup_sheet_stage_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueFollowupSheetStage($qstage)
  {
    $result = $this->db->query("CALL checkUniqueFollowupSheetStage('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_followup_sheet_stage($data)
  {
    $result = $this->db->query("CALL create_followup_sheet_stage('".$data['followup_sheet_stage']."','".$data['stage_color']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function get_followup_sheet_stage_by_id($pccid)
  {
    $result = $this->db->query("CALL get_followup_sheet_stage_by_id('".$pccid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueFollowupSheetStageEdit($qstage,$pccid)
  {
    $result = $this->db->query("CALL checkUniqueFollowupSheetStageEdit('".$qstage."','".$pccid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_followup_sheet_stage($data)
  {
    $result = $this->db->query("CALL update_followup_sheet_stage('".$data['followup_sheet_stage_id']."','".$data['followup_sheet_stage']."','".$data['stage_color']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }

}
?>