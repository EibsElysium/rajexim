<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the exporter database details
    Date    :28-02-2020 
****************************************************************/
class Quotestage_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_quote_stage_list()
  {
    $result = $this->db->query("CALL get_quote_stage_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueQuoteStage($qstage)
  {
    $result = $this->db->query("CALL checkUniqueQuoteStage('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_quote_stage($data)
  {
    $result = $this->db->query("CALL create_quote_stage('".$data['quote_stage']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function quote_stage_change_status($qsid, $status)
  {
    $result = $this->db->query("call quote_stage_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  public function quote_stage_delete($eid)
  {
    $result = $this->db->query("call quote_stage_delete('".$eid."')");
    save_query_in_log();
    return $result;
  }
  public function get_quote_stage_by_id($exp)
  {
    $result = $this->db->query("CALL get_quote_stage_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  public function checkUniqueQuoteStageEdit($exp,$eid)
  {
    $result = $this->db->query("CALL checkUniqueQuoteStageEdit('".$exp."','".$eid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_quote_stage($data)
  {
    $result = $this->db->query("CALL update_quote_stage('".$data['quote_stage']."','".$data['modified_on']."','".$data['modified_by']."','".$data['quote_stage_id']."')");
    save_query_in_log();
    return $result;
  }

}
?>