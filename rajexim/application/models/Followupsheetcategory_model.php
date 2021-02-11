<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Followupsheetcategory_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_followup_sheet_category_list()
  {
    $result = $this->db->query("CALL get_followup_sheet_category_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueFollowupSheetCategory($qstage)
  {
    $result = $this->db->query("CALL checkUniqueFollowupSheetCategory('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_followup_sheet_category($data)
  {
    $result = $this->db->query("CALL create_followup_sheet_category('".$data['followup_sheet_category']."','".$data['input_type']."','".$data['is_default']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function get_followup_sheet_category_by_id($pccid)
  {
    $result = $this->db->query("CALL get_followup_sheet_category_by_id('".$pccid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueFollowupSheetCategoryEdit($qstage,$pccid)
  {
    $result = $this->db->query("CALL checkUniqueFollowupSheetCategoryEdit('".$qstage."','".$pccid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_followup_sheet_category($data)
  {
    $result = $this->db->query("CALL update_followup_sheet_category('".$data['followup_sheet_category_id']."','".$data['followup_sheet_category']."','".$data['input_type']."','".$data['is_default']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }

}
?>