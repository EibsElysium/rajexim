<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the lead database details
    Date    :06-02-2020 
****************************************************************/
class Smtphost_model extends CI_Model 
{
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }
  // To check smtp unique
  public function checkSmtphostUnique($val)
  {
    //$this->db->reconnect();
    $result = $this->db->query("CALL checkSmtphostUnique('".$val."')")->row();
    //$this->db->close();
    return $result;
  } 
  public function get_smtphost_list()
  {
    //$this->db->reconnect();
    $result = $this->db->query("CALL get_smtphost_list()")->result_array();
    //$this->db->close();
    return $result;
  }
  public function create_smtphost($data)
  {
    //$this->db->reconnect();
    $result = $this->db->query("CALL create_smtphost('".$data['smtp_name']."','".$data['smtp_host_name']."',".$data['status'].",'".$data['created_on']."',".$data['created_by'].")");
    //$this->db->close();
    return $result;
  }
  public function smtphost_active($id, $data)
  {
    //$this->db->reconnect();
    $result = $this->db->query("CALL smtphost_active(".$id.",".$data.")");
    //$this->db->close();
    return $result;
  }
  public function get_smtphost_by_id($id)
  {
    //$this->db->reconnect();
    $result = $this->db->query("CALL get_smtphost_by_id('".$id."')")->row();
    //$this->db->close();
    return $result;
  }
  public function checkSmtphostUniqueEdit($val,$bid)
  {
    //$this->db->reconnect();
    $result = $this->db->query("CALL checkSmtphostUniqueEdit('".$val."','".$bid."')")->row();
    //$this->db->close();
    return $result;
  } 
  public function update_smtphost($data)
  {
    //$this->db->reconnect();
    $result = $this->db->query("CALL update_smtphost('".$data['smtp_name']."','".$data['smtp_host_name']."',".$data['smtp_host_id'].",'".$data['modified_on']."',".$data['modified_by'].")");
    //$this->db->close();
    return $result;
  }
  public function smtphost_delete($bid)
  {
    //$this->db->reconnect();
    $result = $this->db->query("CALL smtphost_delete('".$bid."')");
    //$this->db->close();
    return $result;
  }

}
?>