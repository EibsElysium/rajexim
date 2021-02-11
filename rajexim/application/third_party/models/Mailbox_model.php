<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* ************************************************************************************
    Purpose : To handle email setting function
    Date    : 09-09-2019 
***************************************************************************************/
class Mailbox_model extends CI_Model 
{
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  // To list email details
  public function email_list()
  {
    $sql = $this->db->query("SELECT * FROM email_details WHERE status !=2"); 
    $result =  $sql->result(); 
    return $result;
  } 

  // To get email details by id
  public function email_by_id($id)
  {

    $sql = $this->db->query("SELECT * FROM email_details WHERE email_detail_id = '$id' AND status !=2"); 
    $result =  $sql->row(); 
    return $result;
  }
    //To update followup date for lead id
  public function lead_followup_date_update($lead_id, $m_on, $m_by, $followup_date)
  {
      $result = $this->db->query("UPDATE lead SET followup_date = '$followup_date',  modified_on = '$m_on', modified_by = '$m_by' WHERE lead_id = '$lead_id' ");
        return $result;
  }
  
  //To update followup date for lead id
  public function pi_followup_date_update($lead_id, $m_on, $m_by, $followup_date)
  {
      $result = $this->db->query("UPDATE proforma_invoice SET followup_date = '$followup_date',  modified_on = '$m_on', modified_by = '$m_by' WHERE proforma_invoice_id = '$lead_id' ");
        return $result;
  }

    //To update followup date for lead id
  public function order_followup_date_update($lead_id, $m_on, $m_by, $followup_date)
  {
      $result = $this->db->query("UPDATE proforma_invoice SET followup_date = '$followup_date',  modified_on = '$m_on', modified_by = '$m_by' WHERE purchase_order_id = '$lead_id' ");
        return $result;
  }
  public function email_id_by_email_add($email_add)
  {
       $sql = $this->db->query("SELECT * FROM email WHERE email_name = '$email_add' and status !=2
      "); 
      $result =  $sql->row(); 
      $email_id = '';
      if($result)
      {
          $email_id = $result->email_id;
      }else{
          $email_id = '';
      }
    return $email_id;
  }
  public function add_mail_to_lead($lead_name,$message,$c_by,$c_on,$country,$email_id,$lead_source_id)
  {
    $result = $this->db->query("INSERT INTO `leads`(`lead_name`, `country`, `email_id`, `lead_source_id`, `message`, `lead_taken_by`, `lead_assigned_to`, `created_by`, `created_on`) VALUES ('$lead_name','$country','$email_id','$lead_source_id','$message','$c_by','$c_by','$c_by','$c_on')");

        return 1;
  }

}
?>