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
    save_query_in_log();
    return $result;
  } 

  // To get email details by id
  public function email_by_id($id)
  {

    $sql = $this->db->query("SELECT * FROM email_details WHERE email_detail_id = '$id' AND status !=2"); 
    $result =  $sql->row(); 
    save_query_in_log();
    return $result;
  }
    //To update followup date for lead id
  public function lead_followup_date_update($lead_id, $m_on, $m_by, $followup_date)
  {
      $result = $this->db->query("UPDATE lead SET followup_date = '$followup_date',  modified_on = '$m_on', modified_by = '$m_by' WHERE lead_id = '$lead_id' ");
        save_query_in_log();
        return $result;
  }
  
  //To update followup date for lead id
  public function pi_followup_date_update($lead_id, $m_on, $m_by, $followup_date)
  {
      $result = $this->db->query("UPDATE proforma_invoice SET followup_date = '$followup_date',  modified_on = '$m_on', modified_by = '$m_by' WHERE proforma_invoice_id = '$lead_id' ");
        save_query_in_log();
        return $result;
  }

    //To update followup date for lead id
  public function order_followup_date_update($lead_id, $m_on, $m_by, $followup_date)
  {
      $result = $this->db->query("UPDATE proforma_invoice SET followup_date = '$followup_date',  modified_on = '$m_on', modified_by = '$m_by' WHERE purchase_order_id = '$lead_id' ");
        save_query_in_log();
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
    save_query_in_log();
    return $email_id;
  }
  public function add_mail_to_lead($lead_name,$message,$c_by,$c_on,$country,$email_id,$lead_source_id)
  {
    $result = $this->db->query("INSERT INTO `leads`(`lead_name`, `country`, `email_id`, `lead_source_id`, `message`, `lead_taken_by`, `lead_assigned_to`, `created_by`, `created_on`) VALUES ('$lead_name','$country','$email_id','$lead_source_id','$message','$c_by','$c_by','$c_by','$c_on')");
    save_query_in_log();
    return 1;
  }
  public function chk_email_subject_already_exist($email_id,$uid,$msgno)
  {
    $query = $this->db->query("SELECT eli.* FROM email_list_info eli WHERE eli.company_email = '$email_id' AND eli.uid = '$uid' AND eli.msgno = '$msgno'")->result();
    save_query_in_log();
    return $query;
  }
  public function add_mail_subject_to_db($comp_email_id,$comp_email,$subject,$from,$to,$date,$message_id,$references,$in_reply_to,$size,$uid,$msgno,$recent,$flagged,$answered,$deleted,$seen,$draft,$udate) 
  {
    $result = $this->db->query("INSERT INTO `email_list_info`(`company_email_id`, `company_email`, `subject`, `from`, `to`, `date`, `message_id`, `references`, `in_reply_to`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`) VALUES ('$comp_email_id','$comp_email','$subject','$from','$to','$date','$message_id','$references','$in_reply_to','$size','$uid','$msgno','$recent','$flagged','$answered','$deleted','$seen','$draft','$udate')");
    save_query_in_log();
    return 1; 
  }
  public function store_all_subjects($values)
  {
    $result = $this->db->query("INSERT INTO `email_list_info`(`company_email_id`, `company_email`, `lead_id`, `subject`, `from`, `to`, `date`, `message_id`, `references`, `in_reply_to`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`, `email_type`) VALUES ".$values."");
    save_query_in_log();
    return 1; 
  }
  public function add_mail_messages_to_db($comp_email_id,$comp_email,$subject,$msg_date,$msg_from,$personal,$mailbox,$host,$message,$msgno)
  {
    $result = $this->db->query("INSERT INTO `email_info_messages`(`company_email_id`, `company_email`, `subject`, `msg_date`, `msg_from`, `message`, `msg_no`, `msg_from_personal`, `msg_from_mailbox`, `msg_from_host`) VALUES ('$comp_email_id','$comp_email','$subject','$msg_date','$msg_from','$message','$msgno','$personal','$mailbox', '$host')");
    save_query_in_log();
    return 1; 
  }
  public function store_all_messages($values)
  {
    $result = $this->db->query("INSERT INTO `email_info_messages`(`company_email_id`, `company_email`, `lead_id`, `subject`, `msg_date`, `message`, `msg_no`, `attachments`, `msg_from_host`, `email_type`) VALUES ".$values."");
    save_query_in_log();
    return 1; 
  }
  public function get_all_mail_subject()
  {
    $result = $this->db->query("SELECT * FROM `email_list_info`")->result();
    save_query_in_log();
    return $result; 
  }
  public function get_all_mail_msg(){
    $result = $this->db->query("SELECT * FROM `email_info_messages`")->result();
    save_query_in_log();
    return $result; 
  }
  public function trun_mail_subject(){
    $result = $this->db->query("TRUNCATE TABLE `email_list_info`");
    save_query_in_log();
    return 1; 
  }
  public function trun_mail_msg() {
    $result = $this->db->query("TRUNCATE TABLE `email_info_messages`");
    save_query_in_log();
    return 1; 
  }
  public function get_all_mail_subjects_from_db_by_chosen_mailid($emails_id)
  {
    $result = $this->db->query("SELECT eli.subject,eli.from,eli.to,eli.date,eli.message_id,eli.references,eli.in_reply_to,eli.size,eli.uid,eli.msgno,eli.recent,eli.flagged,eli.answered,eli.deleted,eli.seen,eli.draft,eli.udate FROM email_list_info eli WHERE eli.company_email_id = '$emails_id'")->result();
    save_query_in_log();
    return $result;
  }
  public function get_mail_message_from_db_by_msgno_email($emails_id,$msgno)
  {
    $result = $this->db->query("SELECT eim.* FROM email_info_messages eim WHERE eim.company_email_id = '$emails_id' AND eim.msg_no = '$msgno'")->row_array();
    save_query_in_log();
    return $result; 
  }
  public function get_role_id_by_user_id($user_id)
  {
    $query = $this->db->query("SELECT u.* FROM users u WHERE u.user_id = '$user_id'")->row();
    save_query_in_log();
    return $query;

  }
  public function get_user_allocated_emails($user_id)
  {
    $query = $this->db->query("SELECT ed.* FROM user_emails ue LEFT JOIN email_details ed ON ed.email_detail_id = ue.email_detail_id WHERE ue.user_id = '$user_id' GROUP BY ue.email_detail_id")->result();
    save_query_in_log();
    return $query;
  }
  public function chk_this_mail_already_as_a_lead($sender_mailid)
  {
    $query = $this->db->query("SELECT l.*,cb.* FROM leads l,contact_book cb WHERE cb.contact_book_id = l.contact_book_id AND cb.email_id = '$sender_mailid' AND l.status != 2")->result();
    save_query_in_log();
    return $query;
  }
  public function update_stream_to_db($email_detail_id,$inbox)
  {
    $query = $this->db->query("UPDATE email_details ed SET ed.imap_stream = '$inbox' WHERE ed.email_detail_id = '$email_detail_id'");
    save_query_in_log();
    return 1;
  }
  public function get_lead_by_email_matches($sender_mailid,$cc_address,$bcc_address,$reply_to,$receiver_mailid)
  {
    // echo $receiver_mailid;
    if ($sender_mailid != '') {
      $sender_mail_query = " (c.email_id = '".$sender_mailid."' OR c.alternative_email_id = '".$sender_mailid."')";
    }
    else {
      $sender_mail_query = "";
    }
    if ($cc_address != '') {
      $cc_query = " (c.email_id = '".$cc_address."' OR c.alternative_email_id = '".$cc_address."')";
    }
    else {
      $cc_query = "";
    }
    if ($bcc_address != '') {
      $bcc_query = " (c.email_id = '".$bcc_address."' OR c.alternative_email_id = '".$bcc_address."')";
    }
    else {
      $bcc_query = "";
    }
    if ($reply_to != '') {
      $reply_to_query = " (c.email_id = '".$reply_to."' OR c.alternative_email_id = '".$reply_to."')";
    }
    else {
      $reply_to_query = "";
    }
    if ($receiver_mailid != '') {
      $receiver_mailid_query = " (c.email_id = '".$receiver_mailid."' OR c.alternative_email_id = '".$receiver_mailid."')";
    }
    else {
      $receiver_mailid_query = "";
    }
    $email_check_colmn = array($sender_mail_query, $cc_query, $bcc_query, $reply_to_query, $receiver_mailid_query);

    $empty_less_column = array();
    foreach ($email_check_colmn as $key => $value) {
      if($value != ''){
        $empty_less_column[] = $value;
      }
    }

    $imploaded_columns = implode(' OR ', $empty_less_column);

    $final_email_checking_query = ' AND ('.$imploaded_columns.')';
    // echo "SELECT c.* FROM contact_book c WHERE c.status = 0 $final_email_checking_query";
    // die();
    // echo "SELECT c.* FROM contact_book c WHERE c.status = 0 $final_email_checking_query";
    // die();
    $query = $this->db->query("SELECT c.* FROM contact_book c WHERE c.status = 0 $final_email_checking_query")->row();
    return $query;
  }
  public function get_all_lead_by_contact_id($cb_id)
  {
    $query = $this->db->query("SELECT l.*,cb.lead_name,cb.email_id,cb.company_name,p.product_name FROM leads l,contact_book cb,products p WHERE l.status != 2 AND p.product_id = l.product_id AND cb.contact_book_id = l.contact_book_id AND l.contact_book_id = '".$cb_id."'")->result();
    return $query;
  }
}
?>