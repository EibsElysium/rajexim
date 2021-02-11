<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Document_Req_model database details
    Date    :29-02-2020 
****************************************************************/
class Document_Req_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_doc_req_list()
  {
    $result = $this->db->query("CALL get_doc_req_list()")->result_array();
    save_query_in_log();
    return $result;
  }
 
  //To check unique price tag name procedure
  public function checkUniquedocReq($qstage)
  {
    $result = $this->db->query("CALL checkUniquedocReq('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_doc_req($data)
  {
    $result = $this->db->query("CALL create_doc_req('".$data['doc_req']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }

  public function doc_req_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL doc_req_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  
  public function get_doc_req_by_id($exp)
  {
    $result = $this->db->query("CALL get_doc_req_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  
  public function update_doc_req($data)
  {
    $result = $this->db->query("CALL update_doc_req('".$data['doc_req_id']."','".$data['doc_req']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }
  public function doc_req_delete($id)
  {
    $result = $this->db->query("CALL doc_req_delete('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>