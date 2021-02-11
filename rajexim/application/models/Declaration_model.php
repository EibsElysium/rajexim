<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Declaration_model database details
    Date    :29-02-2020 
****************************************************************/
class Declaration_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_declaration_list()
  {
    $result = $this->db->query("CALL get_declaration_list()")->result_array();
    save_query_in_log();
    return $result;
  }
  //To check unique price tag name procedure
  public function checkUniqueDeclarationLabel($qstage)
  {
    $result = $this->db->query("CALL checkUniqueDeclarationLabel('".$qstage."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_Declaration($data)
  {
    $result = $this->db->query("CALL create_Declaration('".$data['declaration_label']."','".$data['declaration_text']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function declaration_change_status($qsid, $status)
  {
    $result = $this->db->query("CALL declaration_change_status('".$qsid."','".$status."')");
    save_query_in_log();
    return $result;
  }
  
  public function get_declaration_by_id($exp)
  {
    $result = $this->db->query("CALL get_declaration_by_id('".$exp."')")->row();
    save_query_in_log();
    return $result;
  }
  
  public function update_Declaration($data)
  {
    $result = $this->db->query("CALL update_Declaration('".$data['declaration_id']."','".$data['declaration_label']."','".$data['declaration_text']."','".$data['modified_on']."','".$data['modified_by']."')");
    save_query_in_log();
    return $result;
  }
  public function declaration_delete($id)
  {
    $result = $this->db->query("CALL declaration_delete('".$id."')");
    save_query_in_log();
    return $result;
  }
}
?>