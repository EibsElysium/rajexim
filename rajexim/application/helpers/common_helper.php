<?php
/* *******************************************************************
        Common Helper : To get common function in Rajexim CRM
* *******************************************************************/
// To get select values from table
function common_select_values($colums, $table_name, $conditions, $row_result)
{ 
  $ci= & get_instance();
  $ci->load->database();
  $conditions_val = '';
  $result = '';
  $query = '';
  if($colums != '' && $table_name != '')
  {
    // To get conditions
    if($conditions != '')
    {
      $conditions_val = 'WHERE ' .$conditions;
    }
    else{
      $conditions_val = '';
    }
    //echo "SELECT $colums FROM $table_name $conditions_val"; die;
    $query = $ci->db->query("SELECT $colums FROM $table_name $conditions_val");
    // To get results based on the condtions
    if($row_result != '' && $row_result == 'row')
    {
      $result = $query->row();
    }
    else if($row_result != '' && $row_result == 'result')
    {
      $result = $query->result();
    }
    else if($row_result != '' && $row_result == 'row_array')
    {
      $result = $query->row_array();
    }
    else if($row_result != '' && $row_result == 'result_array')
    {
      $result = $query->result_array();
    }
    else{
      $result = $query->result();
    }
    return $result;
  }
  else
  {
    return false;
  }
}
function common_get_col_name_by_col_id($colums, $table_name, $conditions)
{
  $ci= & get_instance();
  $ci->load->database();
  $conditions_val = '';
  if($conditions != '')
  {
    $conditions_val = 'WHERE ' .$conditions;
  }
  else{
    $conditions_val = '';
  }
  $query = $ci->db->query("SELECT $colums AS col_res FROM $table_name $conditions_val")->row();
  return $query->col_res;
}
// To update details to table
function common_update_values($colums, $table_name, $conditions)
{ 
  $ci= & get_instance();
  $ci->load->database();
  if($colums != '' && $table_name !='' && $conditions != '')
  {
    //echo "UPDATE $table_name SET $colums WHERE  $conditions"; die;
    $result = $ci->db->query("UPDATE $table_name SET $colums WHERE  $conditions");
  }else{
    $result = false;
  }
  return $result;
}
// To insert details to table
function common_insert_values($colums, $table_name, $insert_values)
{
  $ci= & get_instance();
  $ci->load->database();
  if($colums != '' && $table_name !='' && $insert_values != '')
  {
    $result = $ci->db->query("INSERT INTO $table_name ($colums) VALUES ($insert_values)");
  }else{
    $result = false;
  }
  return $result;

}
// To delete details to table
function common_delete_values($table_name, $conditions)
{
  $ci= & get_instance();
  $ci->load->database();
  if($table_name !='' && $conditions != '')
  {

    // To get conditions
    if($conditions != '')
    {
      $conditions_val = 'WHERE ' .$conditions;
    }
    else{
      $conditions_val = '';
    }

    $result = $ci->db->query("DELETE FROM $table_name $conditions_val");
  }else{
    $result = false;
  }
  return $result;

}
// To check file exists or not
function getImage($image)
{
  $path = base_url() . 'public/images/';
  if(file_exists($path . $image) === FALSE || $image == null)
  {
    return $path . "no_image.png";

  }
  return $path . $image;
}
// To decrypt password
function decryptthis($data, $key) 
{

  $secret_iv = 'secretivcode';
  $iv = substr(hash('sha256', $secret_iv), 0, 16);
  $encryption_key = base64_decode($key);
  return openssl_decrypt(base64_decode($data), 'aes-256-cbc', $encryption_key, 0, $iv);
}
// To encrypt password
function encryptthis($data, $key) 
{
  $secret_iv = 'secretivcode';
  $iv = substr(hash('sha256', $secret_iv), 0, 16);
  $encryption_key = base64_decode($key);
  $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
  return base64_encode($encrypted);
}
//To Check age must be 18
function age_validation_18($val)
{
    $dt = $val;
   
    // $then will first be a string-date
    $then = strtotime($dt);
    //The age to be over, over +18
    $min = strtotime('+18 years', $then);
    if(time() < $min)  
    {
        echo 1; 
    }
    else
    {
      echo 0;
    }
}
//Query execution log function
function save_query_in_log() {
  $ci=& get_instance();
  $ip = $_SERVER['REMOTE_ADDR'];
  $query = $ci->db->last_query();
  $times = $ci->db->query_times; 
  $time = number_format($times[0],5);

  $txt = "[".date('Y-m-d H:i:s')."] => ".$ip."  => ".$ci->session->userdata('user_id')."  =>  ".$query."  =>  ".$time;

  $mostRecentFilePath = "";
  $mostRecentFileMTime = 0;

  $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("Logs/Query Logs"), RecursiveIteratorIterator::CHILD_FIRST);
  foreach ($iterator as $fileinfo) {
      if ($fileinfo->isFile()) {
          if ($fileinfo->getMTime() > $mostRecentFileMTime) {
              $mostRecentFileMTime = $fileinfo->getMTime();
              $mostRecentFilePath = $fileinfo->getPathname();
          }
      }
  }

  $fsize = filesize($mostRecentFilePath);
  if($fsize>1000000)
    $myfile = file_put_contents('Logs/Query Logs/query_log-'.date("Y-m-d").'.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
  else
    $myfile = file_put_contents($mostRecentFilePath, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
}
// To get date format from general settings
function common_date_format()
{
  $ci=& get_instance();
  $ci->load->database();
  $ci->db->select('*');
  $ci->db->from('general_settings');
  $result = $ci->db->get()->row();
  save_query_in_log();
  if(!empty($result))
  {
    $date_format = $result->date_format;
  }else{
    $date_format = 'd-m-Y';
  }
  return $date_format;

}
//to get login user details
function login_user_details($id)
{
  $ci=& get_instance();
  $ci->load->database();

  $ci->db->select('*');
  $ci->db->where('user_id',$id);
  $ci->db->from('users');
  $result = $ci->db->get()->row();
  return $result;
}

function getAttachments($imap, $mailNum, $part, $partNum) {
    $attachments = array();

    if (isset($part->parts)) {
        foreach ($part->parts as $key => $subpart) {
            if($partNum != "") {
                $newPartNum = $partNum . "." . ($key + 1);
            }
            else {
                $newPartNum = ($key+1);
            }
            $result = getAttachments($imap, $mailNum, $subpart,
                $newPartNum);
            if (count($result) != 0) {
                 array_push($attachments, $result);
             }
        }
    }
    else if (isset($part->disposition)) {
        if ($part->disposition == "ATTACHMENT") {
            $partStruct = imap_bodystruct($imap, $mailNum,
                $partNum);
            $attachmentDetails = array(
                "name"    => $part->dparameters[0]->value,
                "partNum" => $partNum,
                "enc"     => $partStruct->encoding
            );
            return $attachmentDetails;
        }
    }

    return $attachments;
}
// To get smtp details
function smtp_details()
{
  $result = common_select_values('*', 'general_settings', '', 'row');
  return $result;
}
// To get lead log type name
function lead_log_type_name($val)
{
  if($val == 1)
  {
    $name = '<span class="text-info">New Lead Created</span>'; 
  }else if($val == 2){
    $name = '<span class="text-primary">Lead Details Updated</span>'; 
  }
  else if($val == 3)
  {
    $name = '<span class="text-orange">Moved To Opportunity</span>'; 

  }
  else if($val == 4)
  {
    $name = '<span class="text-danger">Opportunity To Lead</span>'; 
  }
  else if($val == 5)
  {
    $name = '<span class="text-danger">Lead Dropped</span>'; 
  }
  else if($val == 6)
  {
    $name = '<span class="text-warning">Follow Up Updated</span>'; 
  }
  else if($val == 7)
  {
    $name = '<span class="text-success">Reopened From Deleted Lead</span>'; 
  }
  else{
    $name = '';
  }
  return $name;
}

// To get subject base mail list
function imap_subject_group_mail_list($inbox, $first_index, $second_index)
{
  $MC = imap_check($inbox);
  $mail_limitation = $first_index.':'.$second_index;
  $result = imap_fetch_overview($inbox,$mail_limitation,0); 
  $restructure_arr = array();
  foreach ($result as $key => $res) {
    (object)$restructure_arr[$key];
    $restructure_arr[$key]->subject = ($res->subject) ? $res->subject : '';
    $restructure_arr[$key]->from = ($res->from) ? $res->from : '';
    $restructure_arr[$key]->to = ($res->to) ? $res->to : '';
    $restructure_arr[$key]->date = ($res->date) ? $res->date : '';
    $restructure_arr[$key]->message_id = ($res->message_id) ? $res->message_id : '';
    $restructure_arr[$key]->references = ($res->references) ? $res->references : '';
    $restructure_arr[$key]->in_reply_to = ($res->in_reply_to) ? $res->in_reply_to : '';
    $restructure_arr[$key]->size = ($res->size) ? $res->size : '';
    $restructure_arr[$key]->uid = ($res->uid) ? $res->uid : '';
    $restructure_arr[$key]->msgno = ($res->msgno) ? $res->msgno : '';
    $restructure_arr[$key]->recent = ($res->recent) ? $res->recent : '';
    $restructure_arr[$key]->flagged = ($res->flagged) ? $res->flagged : '';
    $restructure_arr[$key]->answered = ($res->answered) ? $res->answered : '';
    $restructure_arr[$key]->deleted = ($res->deleted) ? $res->deleted : '';
    $restructure_arr[$key]->seen = ($res->seen) ? $res->seen : '';
    $restructure_arr[$key]->draft = ($res->draft) ? $res->draft : '';
    $restructure_arr[$key]->udate = ($res->udate) ? $res->udate : '';
  }
  // $restructure_obj = $restructure_arr;
  // echo "<pre>";
  // print_r($restructure_arr);
  // die();
  return $result;
}



function imap_subject_group_mail_list_store_db($inbox)
{
  $MC = imap_check($inbox);
  $result = imap_fetch_overview($inbox,"1:{$MC->Nmsgs}",0); 
  return $result;
}
function imap_all_inbox_mail_count($inbox)
{
  $ima_time_2s = date('H:i:s');
  $MC = imap_num_msg ($inbox);
  return $MC;
}
function imap_all_inbox_mail_unread_message_count($inbox)  
{
  // $imap_host  = $host.':993'; // IMAP host address
  // $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
  // $imap_user  = $info_email_ID; // IMAP username
  // $imap_pass  = decryptthis($password, $pwd_keyword); // IMAP password
  // $inbox = @imap_open("{".$imap_host.$imap_flags."}".$label, $imap_user, $imap_pass)or die('Cannot connect to Gmail: ' . imap_last_error());
  $unread_msg_count = COUNT(imap_search($inbox,"UNSEEN"));
  return $unread_msg_count;
}
// To fetch email ID Base email list
function imap_email_list_by_email_id($info_email_ID, $password, $host, $pwd_keyword, $start,  $end)
{
  $email_lists = array();
  $imap_host  = $host.':993'; // IMAP host address
  $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
  $imap_user  = $info_email_ID; // IMAP username
  $imap_pass  = decryptthis($password, $pwd_keyword); // IMAP password
  $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX",$imap_user,$imap_pass);
  
  if(!empty($inbox))
  {
    
    $emails_count = COUNT(imap_search($inbox,'ALL'));
    $end = ($emails_count > $end) ? $end : $emails_count;
    $range = $start.':'.$end;
    $reverse_emails = imap_fetch_overview($inbox,"$range");
    $results = array_reverse($reverse_emails);
  }
  else{
    $results = '';
  }
  imap_close($inbox);
  $return_array = array();
  $return_array = array('emails_count'=> $emails_count, 'results' =>$results);
  return $return_array;
}
// To view email  view
function imap_mailbox_view($info_email_ID, $password, $host, $pwd_keyword, $msgno,  $label)
{
  $email_lists = array();
  $imap_host  = $host.':993'; // IMAP host address
  $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
  $imap_user  = $info_email_ID; // IMAP username
  $imap_pass  = decryptthis($password, $pwd_keyword); // IMAP password
  $inbox = @imap_open("{".$imap_host.$imap_flags."}".$label,$imap_user,$imap_pass);

  $subject = '';
  $msg_date = '';
  $from_details = '';
  $message = '';
  if(!empty($inbox))
  {
    $header = imap_headerinfo($inbox, $msgno);
    $overview = imap_fetch_overview($inbox, $msgno,0); 
 
    $subject = $overview[0]->subject;
    $msg_date = $overview[0]->date;
    $from_details = $header->from;

    // GET TEXT BODY
   $dataTxt = get_part($inbox, $msgno, "TEXT/PLAIN");
   
   // GET HTML BODY
   $dataHtml = get_part($inbox, $msgno, "TEXT/HTML");
   //echo "<pre>";
   //print_r($msgBody);die;
   
  if ($dataHtml != "") 
  {
      $message = transformHTML($dataHtml);
  } else 
  {
     $message = preg_replace("/\n/","<br>",$dataTxt);
     $message = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i","$1http://$2",    $message);
     $message = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i","<A    TARGET=\"_blank\" HREF=\"$1\">$1</A>", $message);
     $message = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i","<A    HREF=\"mailto:$1\">$1</A>",$message);
   }
   $attachments_names = array();

          $structure = imap_fetchstructure($inbox, $msgno);

          $attachments = array();

          /* if any attachments found... */
          if(isset($structure->parts) && count($structure->parts)) 
          {
              for($i = 0; $i < count($structure->parts); $i++) 
              {
                  $attachments[$i] = array(
                      'is_attachment' => false,
                      'filename' => '',
                      'name' => '',
                      'attachment' => ''
                  );

                  if($structure->parts[$i]->ifdparameters) 
                  {
                      foreach($structure->parts[$i]->dparameters as $object) 
                      {
                          if(strtolower($object->attribute) == 'filename') 
                          {
                              $attachments[$i]['is_attachment'] = true;
                              $attachments[$i]['filename'] = $object->value;
                          }
                      }
                  }

                  if($structure->parts[$i]->ifparameters) 
                  {
                      foreach($structure->parts[$i]->parameters as $object) 
                      {
                          if(strtolower($object->attribute) == 'name') 
                          {
                              $attachments[$i]['is_attachment'] = true;
                              $attachments[$i]['name'] = $object->value;
                          }
                      }
                  }

                  if($attachments[$i]['is_attachment']) 
                  {
                      $attachments[$i]['attachment'] = imap_fetchbody($inbox, $msgno, $i+1);

                      /* 3 = BASE64 encoding */
                      if($structure->parts[$i]->encoding == 3) 
                      { 
                          $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                      }
                      /* 4 = QUOTED-PRINTABLE encoding */
                      elseif($structure->parts[$i]->encoding == 4) 
                      { 
                          $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                      }
                  }
              }
          }

          /* iterate through each attachment and save it */
          foreach($attachments as $attachment)
          {
              if($attachment['is_attachment'] == 1)
              {
                  $filename = str_replace("'", '', $attachment['name']);
                  if(empty($filename)) $filename = $attachment['filename'];

                  if(empty($filename)) $filename = time() . ".dat";
                  $folder = "assets/mail_box_view_attachment";
                  $attachment_name = $msgno . "-" . $filename;
                  $attachments_names[] = $attachment_name;
                  if(!is_dir($folder))
                  {
                       mkdir($folder);
                  }

                  $fp = fopen("./". $folder ."/". $attachment_name, "w+");
                  fwrite($fp, $attachment['attachment']);
                  fclose($fp);
              }
          }
          if (count($attachments_names) > 0) {
            $attachment_name_string = implode(',', $attachments_names);
          }
          else {
            $attachment_name_string = ''; 
          }
  }
  else{
    $results = '';
  }
  // imap_close($inbox);
  $return_array = array();
  if (isset($header->ccaddress) && isset($header->bccaddress)) {
    $return_array = array('subject'=> $subject, 'msg_date' =>$msg_date, 'msg_from' =>$from_details, 'message'=>$message, 'msgno' => $msgno, 'cc_address'=> str_replace(' ', '', $header->ccaddress), 'bcc_address'=> str_replace(' ', '', $header->bccaddress), 'msg_to' => $header->to, 'reply_to' => $header->reply_toaddress, 'attachment_name_string' => $attachment_name_string);
  }
  elseif (!isset($header->ccaddress) && !isset($header->bccaddress)) {
    $return_array = array('subject'=> $subject, 'msg_date' =>$msg_date, 'msg_from' =>$from_details, 'message'=>$message, 'msgno' => $msgno, 'cc_address'=> '', 'bcc_address'=> '', 'msg_to' => $header->to, 'reply_to' => $header->reply_toaddress, 'attachment_name_string' => $attachment_name_string);
  }
  elseif (isset($header->ccaddress) && !isset($header->bccaddress)) {
    $return_array = array('subject'=> $subject, 'msg_date' =>$msg_date, 'msg_from' =>$from_details, 'message'=>$message, 'msgno' => $msgno, 'cc_address'=> str_replace(' ', '', $header->ccaddress), 'bcc_address'=> '', 'msg_to' => $header->to, 'reply_to' => $header->reply_toaddress, 'attachment_name_string' => $attachment_name_string);
  }
  elseif (!isset($header->ccaddress) && isset($header->bccaddress)) {
    $return_array = array('subject'=> $subject, 'msg_date' =>$msg_date, 'msg_from' =>$from_details, 'message'=>$message, 'msgno' => $msgno, 'cc_address'=> '', 'bcc_address'=> str_replace(' ', '', $header->bccaddress), 'msg_to' => $header->to, 'reply_to' => $header->reply_toaddress, 'attachment_name_string' => $attachment_name_string);
  }
  return $return_array;
}

function imap_mailbox_view_store_to_db($inbox, $msgno)
{
  $email_lists = array();
  // $imap_host  = $host.':993'; // IMAP host address
  // $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
  // $imap_user  = $info_email_ID; // IMAP username
  // $imap_pass  = decryptthis($password, $pwd_keyword); // IMAP password
  // $inbox = @imap_open("{".$imap_host.$imap_flags."}".$label,$imap_user,$imap_pass);

  $subject = '';
  $msg_date = '';
  $from_details = '';
  $message = '';
  if(!empty($inbox))
  {
    $header = imap_headerinfo($inbox, $msgno);
    $overview = imap_fetch_overview($inbox, $msgno,0); 
 
    $subject = (isset($overview[0]->subject)) ? $overview[0]->subject : '';
    $msg_date = $overview[0]->date;
    $from_details = $header->from;

    // GET TEXT BODY
   $dataTxt = get_part_db($inbox, $msgno, "TEXT/PLAIN");
   
   // GET HTML BODY
   $dataHtml = get_part_db($inbox, $msgno, "TEXT/HTML");
   //echo "<pre>";
   //print_r($msgBody);die;
   
    if ($dataHtml != "") 
    {
        $message = transformHTML($dataHtml);
    } else 
    {
       $message = preg_replace("/\n/","<br>",$dataTxt);
       $message = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i","$1http://$2",    $message);
       $message = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i","<A    TARGET=\"_blank\" HREF=\"$1\">$1</A>", $message);
       $message = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i","<A    HREF=\"mailto:$1\">$1</A>",$message);
     }
          $attachments_names = array();

          $structure = imap_fetchstructure($inbox, $msgno);

          $attachments = array();

          /* if any attachments found... */
          if(isset($structure->parts) && count($structure->parts)) 
          {
              for($i = 0; $i < count($structure->parts); $i++) 
              {
                  $attachments[$i] = array(
                      'is_attachment' => false,
                      'filename' => '',
                      'name' => '',
                      'attachment' => ''
                  );

                  if($structure->parts[$i]->ifdparameters) 
                  {
                      foreach($structure->parts[$i]->dparameters as $object) 
                      {
                          if(strtolower($object->attribute) == 'filename') 
                          {
                              $attachments[$i]['is_attachment'] = true;
                              $attachments[$i]['filename'] = $object->value;
                          }
                      }
                  }

                  if($structure->parts[$i]->ifparameters) 
                  {
                      foreach($structure->parts[$i]->parameters as $object) 
                      {
                          if(strtolower($object->attribute) == 'name') 
                          {
                              $attachments[$i]['is_attachment'] = true;
                              $attachments[$i]['name'] = $object->value;
                          }
                      }
                  }

                  if($attachments[$i]['is_attachment']) 
                  {
                      $attachments[$i]['attachment'] = imap_fetchbody($inbox, $msgno, $i+1);

                      /* 3 = BASE64 encoding */
                      if($structure->parts[$i]->encoding == 3) 
                      { 
                          $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                      }
                      /* 4 = QUOTED-PRINTABLE encoding */
                      elseif($structure->parts[$i]->encoding == 4) 
                      { 
                          $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                      }
                  }
              }
          }

          /* iterate through each attachment and save it */
          foreach($attachments as $attachment)
          {
              if($attachment['is_attachment'] == 1)
              {
                  $filename = str_replace("'", '', $attachment['name']);
                  if(empty($filename)) $filename = $attachment['filename'];

                  if(empty($filename)) $filename = time() . ".dat";
                  $folder = "assets/mail_box_attachment";
                  $attachment_name = $msgno . "-" . $filename;
                  $attachments_names[] = $attachment_name;
                  if(!is_dir($folder))
                  {
                       mkdir($folder);
                  }

                  $fp = fopen("./". $folder ."/". $attachment_name, "w+");
                  fwrite($fp, $attachment['attachment']);
                  fclose($fp);
              }
          }
          if (count($attachments_names) > 0) {
            $attachment_name_string = implode(',', $attachments_names);
          }
          else {
            $attachment_name_string = ''; 
          }

  }
  else{
    $results = '';
  }
  $return_array = array();
  $return_array = array('subject'=> $subject, 'msg_date' =>$msg_date, 'msg_from' =>$from_details, 'message'=>$message, 'msgno' => $msgno, 'attachments_name' => $attachment_name_string);
  return $return_array;
}

function get_mime_type(&$structure) 
{
   $primary_mime_type = array("TEXT", "MULTIPART","MESSAGE", "APPLICATION", "AUDIO","IMAGE", "VIDEO", "OTHER");
   if($structure->subtype) {
    return $primary_mime_type[(int) $structure->type] . '/' .$structure->subtype;
   }
    return "TEXT/PLAIN";
}
function get_part_db($stream, $msg_number, $mime_type, $structure = false,$part_number = false) 
{
  $prefix = '';
   
    if(!$structure) {
      $structure = imap_fetchstructure($stream, $msg_number);
    }
    if($structure) {
      if($mime_type == get_mime_type($structure)) {
        if(!$part_number) {
          $part_number = "1";
        }
        $text = imap_fetchbody($stream, $msg_number, $part_number, FT_PEEK);
        if($structure->encoding == 3) {
          return imap_base64($text);
        } else if($structure->encoding == 4) {
          return imap_qprint($text);
        } else {
        return $text;
      }
    }
   
    if($structure->type == 1) /* multipart */ {
      while(list($index, $sub_structure) = each($structure->parts)) {
        if($part_number) {
          $prefix = $part_number . '.';
        }
        $data = get_part($stream, $msg_number, $mime_type, $sub_structure,$prefix .    ($index + 1));
        if($data) {
          return $data;
        }
      } // END OF WHILE
      } // END OF MULTIPART
    } // END OF STRUTURE
    return false;
   } // END OF FUNCTION
function get_part($stream, $msg_number, $mime_type, $structure = false,$part_number = false) 
{
  $prefix = '';
   
    if(!$structure) {
      $structure = imap_fetchstructure($stream, $msg_number);
    }
    if($structure) {
      if($mime_type == get_mime_type($structure)) {
        if(!$part_number) {
          $part_number = "1";
        }
        $text = imap_fetchbody($stream, $msg_number, $part_number);
        if($structure->encoding == 3) {
          return imap_base64($text);
        } else if($structure->encoding == 4) {
          return imap_qprint($text);
        } else {
        return $text;
      }
    }
   
    if($structure->type == 1) /* multipart */ {
      while(list($index, $sub_structure) = each($structure->parts)) {
        if($part_number) {
          $prefix = $part_number . '.';
        }
        $data = get_part($stream, $msg_number, $mime_type, $sub_structure,$prefix .    ($index + 1));
        if($data) {
          return $data;
        }
      } // END OF WHILE
      } // END OF MULTIPART
    } // END OF STRUTURE
    return false;
   } // END OF FUNCTION

   function transformHTML($str)
   {
     if ((strpos($str,"<HTML") < 0) || (strpos($str,"<html")    < 0)) {
        $makeHeader = "<html><head><meta http-equiv=\"Content-Type\"    content=\"text/html; charset=iso-8859-1\"></head>\n";
      if ((strpos($str,"<BODY") < 0) || (strpos($str,"<body")    < 0)) {
        $makeBody = "\n<body>\n";
        $str = $makeHeader . $makeBody . $str ."\n</body></html>";
      } else {
        $str = $makeHeader . $str ."\n</html>";
      }
     } else {
      $str = "<meta http-equiv=\"Content-Type\" content=\"text/html;    charset=iso-8859-1\">\n". $str;
     }
      return $str;
 }
function time_elapsed_string_in_helper($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'min',
      's' => 'sec',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  if (date('d', strtotime($datetime)) == date('d') && date('Y', strtotime($datetime)) == date('Y') && date('m', strtotime($datetime)) == date('m')) { 
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }
  else if(date('Y', strtotime($datetime)) == date('Y'))
  {
    return date("d M", strtotime($datetime));
  }
  else 
  {
    return date("m/d/Y", strtotime($datetime));
  }
}
function timing_log($start_time,$end_time,$name)
{
  $diff = strtotime($end_time) - strtotime($start_time);
     $txt = "[".$name." Loading Start at :".$start_time."] => [".$name." Loading End at :".$end_time."] | ".$name." Loaded Seconds : ".$diff." S";

    $myfile = file_put_contents('assets/Mail_timing/Fetch_time/mail_fetch_log.txt', $txt.PHP_EOL, FILE_APPEND | LOCK_EX);
}
function get_users_mail_details_if_exist($email_id)
{
  $ci= & get_instance();
  $ci->load->database();
  $result = $ci->db->query("SELECT ed.* FROM email_details ed WHERE ed.email_detail_id = '$email_id'")->row();
  return $result;
}
function get_common_date_format()
{
    $ci= & get_instance();
    $ci->load->database();
    $result = $ci->db->query("SELECT gs.date_format FROM general_settings gs WHERE gs.general_setting_id = 1")->row();

    return $result->date_format;
}
function get_all_subgroup_source($id)
{
    $ci= & get_instance();
    $ci->load->database();
    $result = $ci->db->query("SELECT * FROM sub_lead_source WHERE lead_source_id = '$id' AND status = 0")->result();

    return $result;
}
function chk_blocked_emails_note($email)
{
    $ci= & get_instance();
    $ci->load->database();
    $result = $ci->db->query("SELECT bed.* FROM block_email_or_domain bed WHERE bed.status = 0 AND bed.email_or_domain = 1 AND bed.value = '$email'")->row();
    return $result;
}
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
function imap_email_list_by_lead_email_id($inbox,$lead_email,$company_email)
{ 
  $emails_sorted_1 = imap_search($inbox,'FROM "'.$lead_email.'"');
  $mail_list_contents = array();
  $standard_index_array = array();
  for ($i=0; $i < count($emails_sorted_1); $i++) { 
    $mail_content = imap_fetch_overview($inbox,$emails_sorted_1[$i]);

    $standard_index_array[0]['subject'] = ($mail_content[0]->subject) ? $mail_content[0]->subject : '';
    $standard_index_array[0]['from'] = ($mail_content[0]->from) ? $mail_content[0]->from : '';
    $standard_index_array[0]['to'] = ($mail_content[0]->to) ? $mail_content[0]->to : '';
    $standard_index_array[0]['date'] = ($mail_content[0]->date) ? $mail_content[0]->date : '';
    $standard_index_array[0]['message_id'] = ($mail_content[0]->message_id) ? $mail_content[0]->message_id : '';
    $standard_index_array[0]['references'] = ($mail_content[0]->references) ? $mail_content[0]->references : '';
    $standard_index_array[0]['in_reply_to'] = ($mail_content[0]->in_reply_to) ? $mail_content[0]->in_reply_to : '';
    $standard_index_array[0]['size'] = ($mail_content[0]->size) ? $mail_content[0]->size : '';
    $standard_index_array[0]['uid'] = ($mail_content[0]->uid) ? $mail_content[0]->uid : '';
    $standard_index_array[0]['msgno'] = ($mail_content[0]->msgno) ? $mail_content[0]->msgno : '';
    $standard_index_array[0]['recent'] = ($mail_content[0]->recent) ? $mail_content[0]->recent : '0';
    $standard_index_array[0]['flagged'] = ($mail_content[0]->flagged) ? $mail_content[0]->flagged : '0';
    $standard_index_array[0]['answered'] = ($mail_content[0]->answered) ? $mail_content[0]->answered : '0';
    $standard_index_array[0]['deleted'] = ($mail_content[0]->deleted) ? $mail_content[0]->deleted : '0';
    $standard_index_array[0]['seen'] = ($mail_content[0]->seen) ? $mail_content[0]->seen : '0';
    $standard_index_array[0]['draft'] = ($mail_content[0]->draft) ? $mail_content[0]->draft : '0';
    $standard_index_array[0]['udate'] = ($mail_content[0]->udate) ? $mail_content[0]->udate : '';
  
    $mail_list_contents[] = $standard_index_array;
    $standard_index_array = array();
  }
  $results = array_reverse($mail_list_contents);
  return $results;
}
function imap_email_sendbox_list_by_lead_email_id($inbox,$lead_email,$company_email)
{ 
  $emails_sorted_1 = imap_search($inbox,'TO "'.$lead_email.'"');
  $mail_list_contents = array();
  $standard_index_array = array();
  for ($i=0; $i < count($emails_sorted_1); $i++) { 
    $mail_content = imap_fetch_overview($inbox,$emails_sorted_1[$i]);

    $standard_index_array[0]['subject'] = ($mail_content[0]->subject) ? $mail_content[0]->subject : '';
    $standard_index_array[0]['from'] = ($mail_content[0]->from) ? $mail_content[0]->from : '';
    $standard_index_array[0]['to'] = ($mail_content[0]->to) ? $mail_content[0]->to : '';
    $standard_index_array[0]['date'] = ($mail_content[0]->date) ? $mail_content[0]->date : '';
    $standard_index_array[0]['message_id'] = ($mail_content[0]->message_id) ? $mail_content[0]->message_id : '';
    $standard_index_array[0]['references'] = ($mail_content[0]->references) ? $mail_content[0]->references : '';
    $standard_index_array[0]['in_reply_to'] = ($mail_content[0]->in_reply_to) ? $mail_content[0]->in_reply_to : '';
    $standard_index_array[0]['size'] = ($mail_content[0]->size) ? $mail_content[0]->size : '';
    $standard_index_array[0]['uid'] = ($mail_content[0]->uid) ? $mail_content[0]->uid : '';
    $standard_index_array[0]['msgno'] = ($mail_content[0]->msgno) ? $mail_content[0]->msgno : '';
    $standard_index_array[0]['recent'] = ($mail_content[0]->recent) ? $mail_content[0]->recent : '0';
    $standard_index_array[0]['flagged'] = ($mail_content[0]->flagged) ? $mail_content[0]->flagged : '0';
    $standard_index_array[0]['answered'] = ($mail_content[0]->answered) ? $mail_content[0]->answered : '0';
    $standard_index_array[0]['deleted'] = ($mail_content[0]->deleted) ? $mail_content[0]->deleted : '0';
    $standard_index_array[0]['seen'] = ($mail_content[0]->seen) ? $mail_content[0]->seen : '0';
    $standard_index_array[0]['draft'] = ($mail_content[0]->draft) ? $mail_content[0]->draft : '0';
    $standard_index_array[0]['udate'] = ($mail_content[0]->udate) ? $mail_content[0]->udate : '';
  
    $mail_list_contents[] = $standard_index_array;
    $standard_index_array = array();
  }
  $results = array_reverse($mail_list_contents);
  return $results;
}
function send_email_common_method($email_id,$password,$tomailarray,$subject,$content,$attach_file,$ccmailarray,$bccmailarray,$email_id_name) {
  $ci= & get_instance();
  $ci->load->database();
  $result = $ci->db->query("SELECT ed.*,sh.smtp_host_name,sh.send_host_name FROM email_details ed LEFT JOIN smtp_host sh ON sh.smtp_host_name = ed.smtp_host WHERE ed.email_ID = '".$email_id."'")->row();
  $send_host_name = trim($result->send_host_name);

  include_once(APPPATH."third_party/PHPMailer/PHPMailerAutoload.php");
  $mail = new PHPMailer;
  // $mail->SMTPDebug = true;
  $mail->isHTML(true);
  $mail->isSMTP();
  $mail->Host = $send_host_name;
  $mail->Port = 465;//587
  $mail->SMTPSecure = 'ssl';
  $mail->SMTPAuth = true;
  $mail->Username = trim($email_id);
  $mail->Password = trim($password);
  $mail->setFrom($email_id, $email_id_name);
  
  $mail->Subject = $subject;
  $mail->msgHTML($content);
  for ($i=0; $i < count($attach_file); $i++) { 
    if (file_exists($attach_file[$i])) {   
      $mail->addAttachment($attach_file[$i]);
    }
  }
  if (!empty($ccmailarray)) {
    foreach($ccmailarray as $ccarray)
    {
      $cc_email = trim($ccarray);
      $mail->AddCC($cc_email);
    }
  }
  
   
  foreach($tomailarray as $toarray)
  {
    $to_email = trim($toarray);
    $mail->addAddress($to_email);
  }

  if (!empty($bccmailarray)) {
    foreach($bccmailarray as $bccarray)
    {
      $bcc_email = trim($bccarray);
      $mail->AddBCC($bcc_email);
    }
  } 
  
  //print_r($mail);exit;
  if (!$mail->send()) {
    // $error = "Mailer Error: " . $mail->ErrorInfo;
    // return $error;
  //echo '<p id="para">'.$error.'</p>';exit;
  }
  else {
    return 1;
  }
}
function get_dashboard_settings_info()
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT ds.* FROM dashboard_settings ds WHERE ds.dashboard_settings_id = 1");
  $result = $query->row();
  return $result;  
}
function get_user_lead_count_based_on_industry($ls_id,$ind_id,$u_id,$y1,$y2,$dt_range,$day_filt,$quarter)
{
    $ci=& get_instance();
  $ci->load->database();
  if ($u_id != '') {
    $user_filt = " AND l.lead_assigned_to = '$u_id'";
  }
  else {
    $user_filt = "";
  }

  if ($y1 != '' && $y2 != '') {
    if ($quarter == '') {
      $fy_1 = $y1.'-04-01';
      $fy_2 = $y2.'-03-31';
      $date_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
    }
    else {
      $get_quarter_period = $ci->db->query("SELECT qy.* FROM quarter_year qy WHERE qy.quarter_id = '$quarter'")->row();
      $s_y = $get_quarter_period->start_month_date;
      $e_y = $get_quarter_period->end_month_date;
      if ($quarter != 4) {
        $fy_1 = $y1.'-'.$s_y;
        $fy_2 = $y1.'-'.$e_y;  
        $date_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
      }
      else {
        $fy_1 = $y2.'-'.$s_y;
        $fy_2 = $y2.'-'.$e_y;  
        $date_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')"; 
      }
      
    }
  }
  else {
    $date_filt = "";
  }
  if ($day_filt == 'today') {
    $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') = CURDATE()";
  }
  elseif ($day_filt == 'thisweek') {
    $day_filt = "AND YEARWEEK(STR_TO_DATE(l.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
  }
  elseif ($day_filt == 'thismonth') {
    $day_filt = "AND MONTH(STR_TO_DATE(l.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
  }
  elseif ($day_filt == 'thisyear') {
    $finstart = $_SESSION['finstart'];
    $finend = $_SESSION['finend'];
    $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
  }
  elseif ($day_filt == 'thisDate') {
    if ($dt_range != '') {
      $dr = explode(' / ', $dt_range);

      $fd = explode('-', $dr[0]);
      $td = explode('-', $dr[1]);

      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
      $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    }
    else {
      $day_filt = '';
    }
  }

  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS status_count,l.industry_id FROM leads l WHERE l.status != 2 $user_filt AND l.product_id = '$ind_id' AND l.lead_status_id = '$ls_id' $date_filt $day_filt");
  $result = $query->row();
  return $result; 
}

function get_quote_based_quote_stage($quote_stage_id,$product_id,$y1,$y2,$user,$dt_range,$day_filt,$quarter)
{
    $ci=& get_instance();
  $ci->load->database();
  if ($user != '') {
    $user_filt = " AND l.lead_assigned_to = '$user'";
  }
  else {
    $user_filt = "";
  }
  if ($y1 != '' && $y2 != '') {
    if ($quarter == '') {
      $fy_1 = $y1.'-04-01';
    $fy_2 = $y2.'-03-31';
    $date_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
    }
    else {
      $get_quarter_period = $ci->db->query("SELECT qy.* FROM quarter_year qy WHERE qy.quarter_id = '$quarter'")->row();
      $s_y = $get_quarter_period->start_month_date;
      $e_y = $get_quarter_period->end_month_date;
      if ($quarter != 4) {
        $fy_1 = $y1.'-'.$s_y;
        $fy_2 = $y1.'-'.$e_y;  
        $date_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
      }
      else {
        $fy_1 = $y2.'-'.$s_y;
        $fy_2 = $y2.'-'.$e_y;  
        $date_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')"; 
      }
      
    }
    
  }
  else {
    $date_filt = "";
  }

  if ($day_filt == 'today') {
    $day_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') = CURDATE()";
  }
  elseif ($day_filt == 'thisweek') {
    $day_filt = "AND YEARWEEK(STR_TO_DATE(q.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
  }
  elseif ($day_filt == 'thismonth') {
    $day_filt = "AND MONTH(STR_TO_DATE(q.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
  }
  elseif ($day_filt == 'thisyear') {
    $finstart = $_SESSION['finstart'];
    $finend = $_SESSION['finend'];
    $day_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
  }
  elseif ($day_filt == 'thisDate') {
    if ($dt_range != '') {
      $dr = explode(' / ', $dt_range);

      $fd = explode('-', $dr[0]);
      $td = explode('-', $dr[1]);

      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
      $day_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    }
    else {
      $day_filt = '';
    }
  }

  $query = $ci->db->query("SELECT COUNT(q.quote_id) AS quote_count FROM quote q LEFT JOIN quote_product qp ON qp.quote_id = q.quote_id LEFT JOIN product_items pi ON pi.product_item_id = qp.product_item_id LEFT JOIN leads l ON l.lead_id = q.lead_id WHERE q.quote_stage_id = '$quote_stage_id' AND pi.product_id = '$product_id' $user_filt $date_filt $day_filt");
  $result = $query->row();
  return $result;
}
function get_pi_based_pi_stage($pi_stage_id,$product_id,$y1,$y2,$user,$dt_range,$day_filt,$quarter)
{
  $ci=& get_instance();
  $ci->load->database();
  if ($user != '') {
    $user_filt = " AND l.lead_assigned_to = '$user'";
  }
  else {
    $user_filt = "";
  }
  if ($y1 != '' && $y2 != '') {
    if ($quarter == '') {
      $fy_1 = $y1.'-04-01';
      $fy_2 = $y2.'-03-31';
      $date_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
    }
    else {
      $get_quarter_period = $ci->db->query("SELECT qy.* FROM quarter_year qy WHERE qy.quarter_id = '$quarter'")->row();
      $s_y = $get_quarter_period->start_month_date;
      $e_y = $get_quarter_period->end_month_date;
      if ($quarter != 4) {
        $fy_1 = $y1.'-'.$s_y;
        $fy_2 = $y1.'-'.$e_y;  
        $date_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
      }
      else {
        $fy_1 = $y2.'-'.$s_y;
        $fy_2 = $y2.'-'.$e_y;  
        $date_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')"; 
      }
      
    }
    
  }
  else {
    $date_filt = "";
  }
  if ($day_filt == 'today') {
    $day_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') = CURDATE()";
  }
  elseif ($day_filt == 'thisweek') {
    $day_filt = "AND YEARWEEK(STR_TO_DATE(pi.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
  }
  elseif ($day_filt == 'thismonth') {
    $day_filt = "AND MONTH(STR_TO_DATE(pi.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
  }
  elseif ($day_filt == 'thisyear') {
    $finstart = $_SESSION['finstart'];
    $finend = $_SESSION['finend'];
    $day_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
  }
  elseif ($day_filt == 'thisDate') {
    if ($dt_range != '') {
      $dr = explode(' / ', $dt_range);

      $fd = explode('-', $dr[0]);
      $td = explode('-', $dr[1]);

      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
      $day_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    }
    else {
      $day_filt = '';
    }
  }  
  $query = $ci->db->query("SELECT COUNT(pi.proforma_invoice_id) AS pi_count FROM proforma_invoice pi 
            LEFT JOIN proforma_invoice_product pip ON pip.proforma_invoice_id = pi.proforma_invoice_id
            LEFT JOIN product_items pri ON pri.product_item_id = pip.product_item_id
            LEFT JOIN leads l ON l.lead_id = pi.lead_id
            WHERE pi.status != 2 AND pi_stage_id = '$pi_stage_id' AND pri.product_id = '$product_id' $user_filt $date_filt $day_filt");
  $result = $query->row();
  return $result; 
}
function get_user_lead_based_on_product($ls_id,$product_id,$y1,$y2,$user,$dt_range,$day_filt,$quarter)
{
  $ci=& get_instance();
  $ci->load->database();
  if ($user != '') {
    $user_filt = " AND l.lead_assigned_to = '$user'";
  }
  else {
    $user_filt = "";
  }
  if ($y1 != '' && $y2 != '') {
    if ($quarter == '') {
      $fy_1 = $y1.'-04-01';
      $fy_2 = $y2.'-03-31';
      $date_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
    }
    else {
      $get_quarter_period = $ci->db->query("SELECT qy.* FROM quarter_year qy WHERE qy.quarter_id = '$quarter'")->row();
      $s_y = $get_quarter_period->start_month_date;
      $e_y = $get_quarter_period->end_month_date;
      if ($quarter != 4) {
        $fy_1 = $y1.'-'.$s_y;
        $fy_2 = $y1.'-'.$e_y;  
        $date_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')";
      }
      else {
        $fy_1 = $y2.'-'.$s_y;
        $fy_2 = $y2.'-'.$e_y;  
        $date_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fy_1', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('$fy_2', '%Y-%m-%d')"; 
      }
      
    }
  }
  else {
    $date_filt = "";
  }
  if ($day_filt == 'today') {
    $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') = CURDATE()";
  }
  elseif ($day_filt == 'thisweek') {
    $day_filt = "AND YEARWEEK(STR_TO_DATE(l.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
  }
  elseif ($day_filt == 'thismonth') {
    $day_filt = "AND MONTH(STR_TO_DATE(l.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
  }
  elseif ($day_filt == 'thisyear') {
    $finstart = $_SESSION['finstart'];
    $finend = $_SESSION['finend'];
    $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
  }
  elseif ($day_filt == 'thisDate') {
    if ($dt_range != '') {
      $dr = explode(' / ', $dt_range);

      $fd = explode('-', $dr[0]);
      $td = explode('-', $dr[1]);

      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
      $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    }
    else {
      $day_filt = '';
    }
  }
  
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l LEFT JOIN sub_lead_source sls ON sls.sub_lead_source_id = l.lead_source_id WHERE l.product_id = '$product_id' AND sls.lead_source_id = '$ls_id' $user_filt $day_filt $date_filt");
  $result = $query->row();
  return $result; 
}
function get_target_count_based_on_industry($product_id,$fy)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT SUM(t.quote) AS total_industry_target_count FROM target t 
                          
                          WHERE t.year = '$fy' AND t.product_id = '$product_id'");
  $result = $query->row();
  return $result;
}
function get_total_count_based_on_product_by_date($product_id,$cell_date,$assign_to,$lead_source)
{

  if (trim($lead_source) != '') {
    $exp_ls = explode(',', $lead_source);
      $ls_query = '';
      for ($i=0; $i < count($exp_ls); $i++) { 
        if (strpos($exp_ls[$i], '.') !== false) {
            $sls_id_ls_id = explode('.', $exp_ls[$i]);
            $ls_query .= "l.lead_source_id = ".$sls_id_ls_id[1]." OR ";
        }
      }
      $trimmed = rtrim($ls_query);
      $get_query = rtrim($trimmed, 'OR');
      if ($get_query != '') {
        $ls_filt= 'AND ('.$get_query.')';  
      }
      else {
        $ls_filt= ""; 
      }
      
  }
  else {
    $ls_filt= '';
  }
  if ($assign_to != '') {
    $user_filt = " AND l.lead_assigned_to = '$assign_to'";
  }
  else {
    $user_filt = "";
  }

  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l WHERE l.product_id = '$product_id' AND DATE(l.created_on) = '$cell_date' $user_filt $ls_filt");
  $que = "SELECT COUNT(l.lead_id) AS lead_count FROM leads l, contact_book cb WHERE cb.contact_book_id = l.contact_book_id AND l.product_id = '$product_id' AND DATE(l.created_on) = '$cell_date' $user_filt $ls_filt";
   $result = $query->row();
  return $result; 
}
function get_total_count_divide_by_lead_source_based_on_product_by_date($product_id,$cell_date,$assign_to,$lead_source)
{
  
  if ($lead_source != '') {
    $exp_ls = explode(',', $lead_source);
    $ls_query = '';
    for ($i=0; $i < count($exp_ls); $i++) { 
      if (strpos($exp_ls[$i], '.') !== false) {
          $sls_id_ls_id = explode('.', $exp_ls[$i]);
          $ls_query .= "l.lead_source_id = ".$sls_id_ls_id[1]." OR ";
      }
    }
    $trimmed = rtrim($ls_query);
    $get_query = rtrim($trimmed, 'OR');
    $ls_filt= 'AND ('.$get_query.')';
  }
  else {
    $ls_filt= '';
  }
  if ($assign_to != '') {
    $user_filt = " AND l.lead_assigned_to = '$assign_to'";
  }
  else {
    $user_filt = "";
  }

  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS ls_count, sls.lead_source_id,ls.lead_source,ls.source_color FROM leads l LEFT JOIN sub_lead_source sls ON sls.sub_lead_source_id = l.lead_source_id LEFT JOIN lead_source ls ON ls.lead_source_id = sls.lead_source_id WHERE l.product_id = '$product_id' AND DATE(l.created_on) = '$cell_date' $user_filt $ls_filt GROUP BY sls.lead_source_id");
  $result = $query->result();
  return $result;  
}
function get_monthly_total_count_based_on_product_by_date($product_id,$month,$f_year,$assign_to,$lead_source)
{
  if ($lead_source != '') {
    $exp_ls = explode(',', $lead_source);
    $ls_query = '';
    for ($i=0; $i < count($exp_ls); $i++) { 
      if (strpos($exp_ls[$i], '.') !== false) {
          $sls_id_ls_id = explode('.', $exp_ls[$i]);
          $ls_query .= "l.lead_source_id = ".$sls_id_ls_id[1]." OR ";
      }
    }
    $trimmed = rtrim($ls_query);
    $get_query = rtrim($trimmed, 'OR');
    if ($get_query !='') {
      $ls_filt= 'AND ('.$get_query.')';
    }
    else {
      $ls_filt= ""; 
    }
    
  }
  else {
    $ls_filt= '';
  }
  if ($assign_to != '') {
    $user_filt = " AND l.lead_assigned_to = '$assign_to'";
  }
  else {
    $user_filt = "";
  }

  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l WHERE l.product_id = '$product_id' AND MONTH(l.created_on) = '$month' AND YEAR(l.created_on) = '$f_year' $user_filt $ls_filt");
  $result = $query->row();
  return $result; 
}
function get_month_total_count_divide_by_lead_source_based_on_product_by_date($product_id,$month,$f_year,$assign_to,$lead_source)
{
  if ($lead_source != '') {
    $exp_ls = explode(',', $lead_source);
    $ls_query = '';
    for ($i=0; $i < count($exp_ls); $i++) { 
      if (strpos($exp_ls[$i], '.') !== false) {
          $sls_id_ls_id = explode('.', $exp_ls[$i]);
          $ls_query .= "l.lead_source_id = ".$sls_id_ls_id[1]." OR ";
      }
    }
    $trimmed = rtrim($ls_query);
    $get_query = rtrim($trimmed, 'OR');
    if ($get_query !='') {
      $ls_filt= 'AND ('.$get_query.')';
    }
    else {
      $ls_filt= ""; 
    }
  }
  else {
    $ls_filt= '';
  }
  if ($assign_to != '') {
    $user_filt = " AND l.lead_assigned_to = '$assign_to'";
  }
  else {
    $user_filt = "";
  }

  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS ls_count, sls.lead_source_id,ls.lead_source,ls.source_color FROM leads l LEFT JOIN sub_lead_source sls ON sls.sub_lead_source_id = l.lead_source_id LEFT JOIN lead_source ls ON ls.lead_source_id = sls.lead_source_id WHERE l.product_id = '$product_id' AND MONTH(l.created_on) = '$month' AND YEAR(l.created_on) = '$f_year' $user_filt $ls_filt GROUP BY sls.lead_source_id");
  $result = $query->result();
  return $result;  
}
function get_day_lead_by_user_product($product_id,$user_id,$check_date)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l WHERE l.lead_assigned_to = '$user_id' AND l.product_id = '$product_id' AND DATE(l.created_on) = '$check_date'");
  $result = $query->row();
  return $result;  
}
function get_day_lead_by_user_product_from_india($product_id,$user_id,$check_date)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l, contact_book cb WHERE l.lead_assigned_to = '$user_id' AND cb.contact_book_id = l.contact_book_id AND l.product_id = '$product_id' AND DATE(l.created_on) = '$check_date' AND cb.country = '101'");
  $result = $query->row();
  return $result; 
}
function get_month_lead_by_user_product($product_id,$user_id,$month,$year)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l WHERE l.lead_assigned_to = '$user_id' AND l.product_id = '$product_id' AND MONTH(l.created_on) = '$month' AND YEAR(l.created_on) = '$year'");
  $result = $query->row();
  return $result; 
}
function get_month_lead_by_user_product_from_india($product_id,$user_id,$month,$year)
{
  $gs = smtp_details();
  $admin_country = $gs->country;
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l,contact_book cb WHERE l.lead_assigned_to = '$user_id' AND cb.contact_book_id = l.contact_book_id AND l.product_id = '$product_id' AND cb.country = '$admin_country' AND MONTH(l.created_on) = '$month' AND YEAR(l.created_on) = '$year'");
  $result = $query->row();
  return $result; 
}
function get_sls_count_by_ls_id($ls_id)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT sls.* FROM sub_lead_source sls WHERE sls.lead_source_id = '$ls_id' AND sls.status != 2");
  $result = $query->result();
  return $result; 
}
function get_lead_source_count($sub_lead_source_id,$check_date)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l WHERE DATE(l.created_on) = '$check_date' AND l.lead_source_id = '$sub_lead_source_id' AND l.status != 2");
  $result = $query->row();
  return $result; 
}
function get_lead_compare_counts($sale_user,$q_s_month,$q_e_month,$product_id,$country)
{
  $ci=& get_instance();
  $ci->load->database();
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 
  if ($q_s_month != '' && $q_e_month != '') {
    $date_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$q_s_month."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$q_e_month."', '%Y-%m-%d')";
  }
  else {
    $date_filt = "";
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  // echo "SELECT COUNT(l.lead_id) AS lead_count FROM leads l, contact_book cb WHERE l.contact_book_id = cb.contact_book_id AND l.status != 3 AND l.status != 2 AND l.product_id = '$product_id' $user_filt $date_filt $country_filt";
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l, contact_book cb WHERE l.contact_book_id = cb.contact_book_id AND l.status != 2 AND l.status != 3 AND l.product_id = '$product_id' $user_filt $date_filt $country_filt");
  $result = $query->row();
  return $result;
}
function get_oppo_compare_counts($sale_user,$q_s_month,$q_e_month,$product_id,$country)
{
  $ci=& get_instance();
  $ci->load->database();
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 
  if ($q_s_month != '' && $q_e_month != '') {
    $date_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$q_s_month."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$q_e_month."', '%Y-%m-%d')";
  }
  else {
    $date_filt = "";
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l, contact_book cb WHERE cb.contact_book_id = l.contact_book_id AND l.status != 2 AND l.status = 3 AND l.product_id = '$product_id' $user_filt $date_filt $country_filt");
  $result = $query->row();
  return $result; 
}
function get_quote_compare_counts($sale_user,$q_s_month,$q_e_month,$product_id,$country)
{
  $ci=& get_instance();
  $ci->load->database();
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 
  if ($q_s_month != '' && $q_e_month != '') {
    $date_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$q_s_month."', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$q_e_month."', '%Y-%m-%d')";
  }
  else {
    $date_filt = "";
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  $query = $ci->db->query("SELECT COUNT(q.quote_id) AS quote_count FROM quote q LEFT JOIN quote_product qp ON qp.quote_id = q.quote_id LEFT JOIN product_items pi ON pi.product_item_id = qp.product_item_id LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id WHERE q.status != 2 AND pi.product_id = '$product_id' $user_filt $date_filt $country_filt");
  $result = $query->row();
  return $result; 
}
function get_pi_compare_counts($sale_user,$q_s_month,$q_e_month,$product_id,$country)
{
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 
  if ($q_s_month != '' && $q_e_month != '') {
    $date_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$q_s_month."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$q_e_month."', '%Y-%m-%d')";
  }
  else {
    $date_filt = "";
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(pi.proforma_invoice_id) AS pi_count FROM proforma_invoice pi 
            LEFT JOIN proforma_invoice_product pip ON pip.proforma_invoice_id = pi.proforma_invoice_id
            LEFT JOIN product_items pri ON pri.product_item_id = pip.product_item_id
            LEFT JOIN leads l ON l.lead_id = pi.lead_id
            LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
            WHERE pi.status != 2 AND pri.product_id = '$product_id' $user_filt $date_filt $country_filt");
  $result = $query->row();
  return $result; 
}
function get_order_compare_counts($sale_user,$q_s_month,$q_e_month,$product_id,$country)
{
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 
  if ($q_s_month != '' && $q_e_month != '') {
    $date_filt = "AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$q_s_month."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$q_e_month."', '%Y-%m-%d')";
  }
  else {
    $date_filt = "";
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(bo.buyer_order_id) AS order_count FROM buyer_order bo 
        LEFT JOIN buyer_order_product bop ON bop.buyer_order_id = bo.buyer_order_id
        LEFT JOIN leads l ON l.lead_id = bo.lead_id
        LEFT JOIN product_items pi ON pi.product_item_id = bop.product_item_id
        LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
        WHERE bo.status != 2 AND pi.product_id = '$product_id' $user_filt $date_filt $country_filt");
  $result = $query->row();
  return $result; 
}
function get_lead_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product_id,$country)
{
  $ci=& get_instance();
  $ci->load->database();
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 

  if ($day_filt == 'today') {
    $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') = CURDATE()";
  }
  elseif ($day_filt == 'thisweek') {
    $day_filt = "AND YEARWEEK(STR_TO_DATE(l.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
  }
  elseif ($day_filt == 'thismonth') {
    $day_filt = "AND MONTH(STR_TO_DATE(l.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
  }
  elseif ($day_filt == 'thisyear') {
    $finstart = $_SESSION['finstart'];
    $finend = $_SESSION['finend'];
    $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
  }
  elseif ($day_filt == 'thisDate') {
    if ($dtrange != '') {
      $dr = explode(' / ', $dtrange);

      $fd = explode('-', $dr[0]);
      $td = explode('-', $dr[1]);

      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
      $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    }
    else {
      $day_filt = '';
    }
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id WHERE l.lead_status_id != '3' AND l.lead_type_id != '1' AND l.status != 2 AND l.product_id = '$product_id' $user_filt $day_filt $country_filt");
  $result = $query->row();
  return $result;
}
function get_oppo_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product_id,$country)
{
  $ci=& get_instance();
  $ci->load->database();
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 
  if ($day_filt == 'today') {
    $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') = CURDATE()";
  }
  elseif ($day_filt == 'thisweek') {
    $day_filt = "AND YEARWEEK(STR_TO_DATE(l.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
  }
  elseif ($day_filt == 'thismonth') {
    $day_filt = "AND MONTH(STR_TO_DATE(l.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
  }
  elseif ($day_filt == 'thisyear') {
    $finstart = $_SESSION['finstart'];
    $finend = $_SESSION['finend'];
    $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
  }
  elseif ($day_filt == 'thisDate') {
    if ($dtrange != '') {
      $dr = explode(' / ', $dtrange);

      $fd = explode('-', $dr[0]);
      $td = explode('-', $dr[1]);

      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
      $day_filt = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    }
    else {
      $day_filt = '';
    }
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id WHERE l.lead_status_id = '3' AND l.lead_type_id = '1' AND l.status != 2 AND l.product_id = '$product_id' $user_filt $day_filt $country_filt");
  $result = $query->row();
  return $result; 
}
function get_quote_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product_id,$country)
{
  $ci=& get_instance();
  $ci->load->database();
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 
  if ($day_filt == 'today') {
    $day_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') = CURDATE()";
  }
  elseif ($day_filt == 'thisweek') {
    $day_filt = "AND YEARWEEK(STR_TO_DATE(q.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
  }
  elseif ($day_filt == 'thismonth') {
    $day_filt = "AND MONTH(STR_TO_DATE(q.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
  }
  elseif ($day_filt == 'thisyear') {
    $finstart = $_SESSION['finstart'];
    $finend = $_SESSION['finend'];
    $day_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
  }
  elseif ($day_filt == 'thisDate') {
    if ($dtrange != '') {
      $dr = explode(' / ', $dtrange);

      $fd = explode('-', $dr[0]);
      $td = explode('-', $dr[1]);

      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
      $day_filt = "AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    }
    else {
      $day_filt = '';
    }
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  $query = $ci->db->query("SELECT COUNT(q.quote_id) AS quote_count FROM quote q LEFT JOIN quote_product qp ON qp.quote_id = q.quote_id LEFT JOIN product_items pi ON pi.product_item_id = qp.product_item_id LEFT JOIN leads l ON l.lead_id = q.lead_id LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id WHERE q.status != 2 AND pi.product_id = '$product_id' $user_filt $day_filt $country_filt");
  $result = $query->row();
  return $result; 
}
function get_pi_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product_id,$country)
{
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 
  if ($day_filt == 'today') {
    $day_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') = CURDATE()";
  }
  elseif ($day_filt == 'thisweek') {
    $day_filt = "AND YEARWEEK(STR_TO_DATE(pi.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
  }
  elseif ($day_filt == 'thismonth') {
    $day_filt = "AND MONTH(STR_TO_DATE(pi.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
  }
  elseif ($day_filt == 'thisyear') {
    $finstart = $_SESSION['finstart'];
    $finend = $_SESSION['finend'];
    $day_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
  }
  elseif ($day_filt == 'thisDate') {
    if ($dtrange != '') {
      $dr = explode(' / ', $dtrange);

      $fd = explode('-', $dr[0]);
      $td = explode('-', $dr[1]);

      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
      $day_filt = "AND STR_TO_DATE(pi.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pi.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    }
    else {
      $day_filt = '';
    }
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(pi.proforma_invoice_id) AS pi_count FROM proforma_invoice pi 
            LEFT JOIN proforma_invoice_product pip ON pip.proforma_invoice_id = pi.proforma_invoice_id
            LEFT JOIN product_items pri ON pri.product_item_id = pip.product_item_id
            LEFT JOIN leads l ON l.lead_id = pi.lead_id
            LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
            WHERE pi.status != 2 AND pri.product_id = '$product_id' $user_filt $day_filt $country_filt");
  $result = $query->row();
  return $result; 
}
function get_order_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product_id,$country)
{
  if ($sale_user != '') {
    $user_filt = "AND l.lead_assigned_to = '$sale_user'";
  }
  else {
    $user_filt = "";
  } 
  if ($day_filt == 'today') {
    $day_filt = "AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') = CURDATE()";
  }
  elseif ($day_filt == 'thisweek') {
    $day_filt = "AND YEARWEEK(STR_TO_DATE(bo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
  }
  elseif ($day_filt == 'thismonth') {
    $day_filt = "AND MONTH(STR_TO_DATE(bo.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
  }
  elseif ($day_filt == 'thisyear') {
    $finstart = $_SESSION['finstart'];
    $finend = $_SESSION['finend'];
    $day_filt = "AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
  }
  elseif ($day_filt == 'thisDate') {
    if ($dtrange != '') {
      $dr = explode(' / ', $dtrange);

      $fd = explode('-', $dr[0]);
      $td = explode('-', $dr[1]);

      $fdate = $fd[2].'-'.$fd[1].'-'.$fd[0];
      $tdate = $td[2].'-'.$td[1].'-'.$td[0];
      $day_filt = "AND STR_TO_DATE(bo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(bo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')";
    }
    else {
      $day_filt = '';
    }
  }
  if ($country != '') {
    $country_filt = "AND cb.country = '$country'";
  }
  else {
    $country_filt = ""; 
  }
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(bo.buyer_order_id) AS order_count FROM buyer_order bo 
        LEFT JOIN buyer_order_product bop ON bop.buyer_order_id = bo.buyer_order_id
        LEFT JOIN leads l ON l.lead_id = bo.lead_id
        LEFT JOIN product_items pi ON pi.product_item_id = bop.product_item_id
        LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
        WHERE bo.status != 2 AND pi.product_id = '$product_id' $user_filt $day_filt $country_filt");
  $result = $query->row();
  return $result; 
}
function column_name_by_id($tbl_name, $col_id, $col_val, $col_name)
{
  if ($tbl_name != '' && $col_id != '' && $col_val != '' && $col_name != '') {
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT tc.$col_name as col_name FROM $tbl_name tc WHERE tc.$col_id = $col_val");
    $result = $query->row();
    return ($result) ? $result->col_name : '';
  }
}
function column_name_by_multi_id($tbl_name, $col_id, $col_val, $col_name)
{
  if ($tbl_name != '' && $col_id != '' && $col_val != '' && $col_name != '') {
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT GROUP_CONCAT(tc.$col_name) as col_name FROM $tbl_name tc WHERE tc.$col_id IN ($col_val)");
    $result = $query->row();
    return ($result) ? $result->col_name : '';
  }
}
function get_dynamic_pivot_report($left_col_name, $top_col_name, $left_column_id, $top_column_id, $lead_type , $lead_source, $lead_daterange, $lead_status, $year, $month, $product_id, $lead_country, $lead_assigned_to)
{
  if ($lead_country != '') {
    $lc_filt = " AND bc.country = '$lead_country'";
  }
  else {
    $lc_filt = "";
  }
  if ($lead_assigned_to != '') {
    $la_filt = " AND l.lead_assigned_to = '$lead_assigned_to'";
  }
  else {
    $la_filt = "";
  }

  if($product_id != '')
  {
    $pv = " AND l.product_id = '$product_id'";
  }
  else{
    $pv = "";
  }

  if($lead_type != '')
  {
    $lt = " AND l.lead_type_id = '$lead_type'";
  }
  else{
    $lt = "";
  }

  if($lead_source != '')
  {
    $ls = " AND l.lead_source_id = '$lead_source'";
  }
  else{
    $ls = "";
  }

  if($lead_status != '')
  {
    $lst = " AND l.lead_status_id = '$lead_status'";
  }
  else{
    $lst = "";
  }

  $explode_date = '';
  $startdate = '';
  $enddate = '';
  $year_month = '';
  if($year != '' && $month != '' && $lead_daterange == '')
  {
    $year_month = $year.'-'.$month;
    $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
  }
  else if($lead_daterange != ''){
      $explode_date = explode(' - ', $lead_daterange);
      $startdate = date('Y-m-d', strtotime($explode_date[0]));
      $enddate =date('Y-m-d', strtotime($explode_date[1]));
      $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
  }
  else{
    $year_month_val = "";
  }

  // $que = "SELECT COUNT(l.lead_id) AS lead_count FROM leads l, contact_book cb
  // WHERE $left_col_name = '$left_column_id' AND $top_col_name = '$top_column_id' AND l.status != 3 AND l.status != 2 AND l.contact_book_id = cb.contact_book_id $year_month_val $lt $ls $lst $pv $lc_filt $la_filt";
  // return $que;
  // die(); 
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l, contact_book cb
  WHERE $left_col_name = '$left_column_id' AND $top_col_name = '$top_column_id' AND l.status != 3 AND l.status != 2 AND l.contact_book_id = cb.contact_book_id $year_month_val $lt $ls $lst $pv $lc_filt $la_filt");
  $result = $query->row();
  return $result; 
}
function get_oppo_dynamic_pivot_report($left_col_name, $top_col_name, $left_column_id, $top_column_id, $lead_type , $lead_source, $lead_daterange, $lead_status, $year, $month, $product_id, $lead_country, $lead_assigned_to)
{
  if ($lead_country != '') {
    $lc_filt = " AND cb.country = '$lead_country'";
  }
  else {
    $lc_filt = "";
  }
  if ($lead_assigned_to != '') {
    $la_filt = " AND l.lead_assigned_to = '$lead_assigned_to'";
  }
  else {
    $la_filt = "";
  }

  if($product_id != '')
  {
    $pv = " AND l.product_id = '$product_id'";
  }
  else{
    $pv = "";
  }

  if($lead_type != '')
  {
    $lt = " AND l.lead_type_id = '$lead_type'";
  }
  else{
    $lt = "";
  }

  if($lead_source != '')
  {
    $ls = " AND l.lead_source_id = '$lead_source'";
  }
  else{
    $ls = "";
  }

  if($lead_status != '')
  {
    $lst = " AND l.lead_status_id = '$lead_status'";
  }
  else{
    $lst = "";
  }

  $explode_date = '';
  $startdate = '';
  $enddate = '';
  $year_month = '';
  if($year != '' && $month != '' && $lead_daterange == '')
  {
    $year_month = $year.'-'.$month;
    $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
  }
  else if($lead_daterange != ''){
      $explode_date = explode(' - ', $lead_daterange);
      $startdate = date('Y-m-d', strtotime($explode_date[0]));
      $enddate =date('Y-m-d', strtotime($explode_date[1]));
      $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
  }
  else{
    $year_month_val = "";
  }
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT COUNT(l.lead_id) AS lead_count FROM leads l,contact_book cb 
  WHERE $left_col_name = '$left_column_id' AND $top_col_name = '$top_column_id' AND l.status = 3 AND l.status != 2 AND cb.contact_book_id = l.contact_book_id $year_month_val $lt $ls $lst $pv $lc_filt $la_filt");
  $result = $query->row();
  return $result; 
}
function get_value_variant_by_value($value)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT vv.* FROM value_variant vv WHERE vv.status = 0 AND (vv.vv_from_amount <= '$value' AND vv.vv_to_amount >= '$value') ");
  $result = $query->row();
  return $result; 
}
function get_notify_countByUser()
{
  $ci=& get_instance();
  $ci->load->database();
  
  $uid = $_SESSION['admindata']['user_id'];
  $qcond = " AND find_in_set('$uid', n.notification_allow_to)";
  
  $query = $ci->db->query("SELECT n.* FROM notification n WHERE !find_in_set('$uid', n.count_status_id) <> 0 $qcond");
  $result = $query->num_rows();
  
  return $result;
}

function get_task_notify_countByUser()
{
  $ci=& get_instance();
  $ci->load->database();
  
  $uid = $_SESSION['admindata']['user_id'];
  $qcond = " AND find_in_set('$uid', n.notification_allow_to)";
  
  $query = $ci->db->query("SELECT n.* FROM notification n WHERE (n.notification_type_id = 3 || n.notification_type_id = 4 || n.notification_type_id = 5 || n.notification_type_id = 6) AND !find_in_set('$uid', n.count_status_id) <> 0 $qcond");
  $result = $query->num_rows();
  
  return $result;
}
function get_notify_message()
{
  $uid = $_SESSION['admindata']['user_id'];
  $ci=& get_instance();
  $ci->load->database();
  $datetime = new DateTime('tomorrow'); 
  $tdate = $datetime->format('Y-m-d H:i:s');
  $query = $ci->db->query("SELECT n.*,nt.notification_type_id,nt.notification_type,nt.content,lap.product_name AS al_intrest_product,lcby.name AS lead_created_by_name, laby.name AS lead_assigned_to_name, alc.name AS add_lead_country,nlcb.lead_name, 
    lf.followup_date, lf.followup_time, lcby_lf.name AS lead_fup_cby_name, laby_lf.name AS lead_fup_aby_name, alc_lf.name AS lf_lead_country, lap_lf.product_name AS lf_product_name,nlcb_lf.lead_name AS lf_lead_name, tau.name AS task_allocated_person, tcu.name AS task_created_person, botau.name AS bo_task_allocated_person, botcu.name AS bo_task_created_person, t.task_title, t.priority, tct.task_title AS task_title_for_comments, tccu.name AS task_comment_create_user, bot.task AS bo_task, tcru.name AS task_comment_receiver,botccu.name AS bo_task_commentor, botcru.name AS bo_task_receiver, botr.task AS bo_comment_task, bo.buyer_order_invoice_no AS bo_code_for_bot, boitr.buyer_order_invoice_no AS bo_code_for_botr FROM notification n

      LEFT JOIN notification_type nt ON nt.notification_type_id = n.notification_type_id

      LEFT JOIN leads l ON l.lead_id = n.lead_id
      LEFT JOIN contact_book nlcb ON nlcb.contact_book_id = l.contact_book_id
      LEFT JOIN products lap ON lap.product_id = l.product_id
      LEFT JOIN users lcby ON lcby.user_id = l.created_by
      LEFT JOIN users laby ON laby.user_id = l.lead_assigned_to
      LEFT JOIN ad_countries alc ON alc.id = nlcb.country 

      LEFT JOIN lead_followups lf ON lf.lead_followup_id = n.lead_followup_id
      LEFT JOIN leads lf_li ON lf_li.lead_id = lf.lead_id
      LEFT JOIN contact_book nlcb_lf ON nlcb_lf.contact_book_id = lf_li.contact_book_id
      LEFT JOIN products lap_lf ON lap_lf.product_id = lf_li.product_id
      LEFT JOIN users lcby_lf ON lcby_lf.user_id = lf.created_by
      LEFT JOIN users laby_lf ON laby_lf.user_id = lf.lead_assigned_to
      LEFT JOIN ad_countries alc_lf ON alc_lf.id = nlcb_lf.country 

      LEFT JOIN task t ON t.task_id = n.task_id
      LEFT JOIN users tau ON tau.user_id = t.assigned_to
      LEFT JOIN users tcu ON tcu.user_id = t.created_by

      LEFT JOIN task_comments tc ON tc.task_comments_id = n.task_comments_id
      LEFT JOIN task tct ON tct.task_id = tc.task_id
      LEFT JOIN users tccu ON tccu.user_id = n.created_by 
      LEFT JOIN users tcru ON tcru.user_id = n.notification_allow_to

      LEFT JOIN buyer_order_task bot ON bot.buyer_order_task_id = n.bo_task_id
      LEFT JOIN buyer_order bo ON bo.buyer_order_id = bot.buyer_order_id 
      LEFT JOIN users botau ON botau.user_id = bot.assigned_to
      LEFT JOIN users botcu ON botcu.user_id = bot.created_by

      LEFT JOIN buyer_order_task botr ON botr.buyer_order_task_id = n.bo_task_id
      LEFT JOIN buyer_order boitr ON boitr.buyer_order_id = botr.buyer_order_id 
      LEFT JOIN users botccu ON botccu.user_id = n.created_by 
      LEFT JOIN users botcru ON botcru.user_id = n.notification_allow_to
      WHERE n.created_on < '$tdate' AND find_in_set('$uid', n.notification_allow_to)
      ORDER BY n.created_on DESC LIMIT 10");
  $result = $query->result(); 
  return $result;
}
function get_read_notify_message($user_id,$noti_id)
{
  $ci=& get_instance();
  $ci->load->database();

  $query = $ci->db->query("SELECT notification_id FROM notification WHERE find_in_set('".$user_id."', read_status_id) AND notification_id = ".$noti_id);
  $result = $query->num_rows();
 
  return $result;
}
function get_notification_content($noti)
{
  $date_format = common_date_format();
  $content = $noti->content;

  $lead_name = "";
  $taken_user_name = "";
  $alloc_user_name = "";
  $lead_country_name = "";
  $lead_country = "";
  $cre_date = "";
  $product_name = "";
  $followup_date = "";
  $followup_time = "";
  $task_name = "";
  $priority = "";
  $bo_code = "";
  if($noti->notification_type_id == 1)
  {
    $lead_name = '<b class="text-green">'.ucfirst($noti->lead_name).'</b>';
    $taken_user_name = '<b class="text-orange">'.ucfirst($noti->lead_created_by_name).'</b>';
    $alloc_user_name = '<b class="text-orange">'.$noti->lead_assigned_to_name.'</b> ';
    $product_name = '<b class="text-danger">'.$noti->al_intrest_product.'</b>';
    $lead_country = '<b class="text-green">'.$noti->add_lead_country.'</b>';
    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($noti->created_on)).'</b> ';

    $content = str_replace('#Created_by#',$taken_user_name, $content);
    $content = str_replace('#Lead_name#',$lead_name, $content);
    $content = str_replace('#Created_date#',$cre_date, $content);
    $content = str_replace('#Product_name#',$product_name, $content);
    $content = str_replace('#Assigned_by#',$alloc_user_name, $content);
    $content = str_replace('#Country_name#',$lead_country, $content);
  }
  if($noti->notification_type_id == 2)
  {
    $lead_name = '<b class="text-green">'.ucfirst($noti->lf_lead_name).'</b>';
    $taken_user_name = '<b class="text-orange">'.ucfirst($noti->lead_fup_cby_name).'</b>';
    $alloc_user_name = '<b class="text-orange">'.$noti->lead_fup_aby_name.'</b> ';
    $product_name = '<b class="text-danger">'.$noti->lf_product_name.'</b>';
    $lead_country = '<b class="text-green">'.$noti->lf_lead_country.'</b>';
    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($noti->created_on)).'</b> ';
    $followup_time = '<b class="text-danger">'.date($date_format,strtotime($noti->followup_time)).'</b> ';
    $followup_date = '<b class="text-danger">'.date($date_format,strtotime($noti->followup_date)).'</b> ';

    $content = str_replace('#created_by#',$taken_user_name, $content);
    $content = str_replace('#Lead_name#',$lead_name, $content);
    $content = str_replace('#Created_date#',$cre_date, $content);
    $content = str_replace('#Product_name#',$product_name, $content);
    $content = str_replace('#Assigned_by#',$alloc_user_name, $content);
    $content = str_replace('#Country_name#',$lead_country, $content);
    $content = str_replace('#followup_time#',$followup_time, $content);
    $content = str_replace('#followup_date#',$followup_date, $content);
  }
  if($noti->notification_type_id == 3)
  {
    $taken_user_name = '<b class="text-green">'.ucfirst($noti->task_created_person).'</b>';
    $alloc_user_name = '<b class="text-green">'.$noti->task_allocated_person.'</b> ';
    $priority = '<b class="text-info">'.$noti->priority.'</b>';
    $task_name = '<b class="text-orange">'.$noti->task_title.'</b>';
    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($noti->created_on)).'</b> ';
    

    $content = str_replace('#Assigned_by#',$taken_user_name, $content);
    $content = str_replace('#Task_name#',$task_name, $content);
    $content = str_replace('#Priority#',$priority, $content);
    $content = str_replace('#Assigned_on#',$cre_date, $content);
    $content = str_replace('#Assigned_to#',$alloc_user_name, $content);
  }
  if($noti->notification_type_id == 4)
  {
    $taken_user_name = '<b class="text-green">'.ucfirst($noti->task_comment_create_user).'</b>';
    $alloc_user_name = '<b class="text-green">'.$noti->task_comment_receiver.'</b> ';
    $task_name = '<b class="text-orange">'.$noti->task_title_for_comments.'</b>';
    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($noti->created_on)).'</b> ';
    

    $content = str_replace('#Commentor#',$taken_user_name, $content);
    $content = str_replace('#Task_name#',$task_name, $content);
    $content = str_replace('#Commented_date#',$cre_date, $content);
    $content = str_replace('#Receiver#',$alloc_user_name, $content);
  }
  if($noti->notification_type_id == 5)
  {
    $taken_user_name = '<b class="text-green">'.ucfirst($noti->bo_task_created_person).'</b>';
    $alloc_user_name = '<b class="text-green">'.$noti->bo_task_allocated_person.'</b> ';
    $task_name = '<b class="text-orange">'.$noti->bo_task.'</b>';
    $bo_code = '<b class="text-green">'.$noti->bo_code_for_bot.'</b>';
    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($noti->created_on)).'</b> ';
    
    $content = str_replace('#Assigned_by#',$taken_user_name, $content);
    $content = str_replace('#Bo_code#', $bo_code, $content);
    $content = str_replace('#Task_name#',$task_name, $content);
    $content = str_replace('#Assigned_on#',$cre_date, $content);
    $content = str_replace('#Assigned_to#',$alloc_user_name, $content);
  }
  if($noti->notification_type_id == 6)
  {
    $taken_user_name = '<b class="text-green">'.ucfirst($noti->bo_task_commentor).'</b>';
    $alloc_user_name = '<b class="text-green">'.$noti->bo_task_receiver.'</b> ';
    $task_name = '<b class="text-orange">'.$noti->bo_comment_task.'</b>';
    $bo_code = '<b class="text-green">'.$noti->bo_code_for_botr.'</b>';
    $cre_date = '<b class="text-danger">'.date($date_format,strtotime($noti->created_on)).'</b> ';
    

    $content = str_replace('#Commentor#',$taken_user_name, $content);
    $content = str_replace('#Bo_code#', $bo_code, $content);
    $content = str_replace('#Task_name#',$task_name, $content);
    $content = str_replace('#Commented_date#',$cre_date, $content);
    $content = str_replace('#Receiver#',$alloc_user_name, $content);
  }
  return $content;
}
function select_table_with_condition($tname, $cond)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT $cond ");
  $result = $query->result();
  return $result;
}
function update_table($tname, $setval, $cond)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("UPDATE $tname SET $setval WHERE $cond ");
  return 1;
}
function update_users_last_active_time($login_history_id,$current_time)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("UPDATE `login_history_details` SET `last_active_time`='$current_time' WHERE `login_history_detail_id`='$login_history_id'");
  return 1;
}
function get_user_name_by_id($user_id)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT u.* FROM users u WHERE u.user_id = '".$user_id."'")->row();
  $user_name = ($query->name) ? $query->name : '';
  return $user_name;
}
function last_id($table)
{
  $ci=& get_instance();
  $ci->load->database();

  $query = $ci->db->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = database() AND TABLE_NAME = '$table' ");
  $result = $query->result();
  return $result;
}

function get_all_today_tasks()
{
  $ci=& get_instance();
  $ci->load->database();
  $user_id = $_SESSION['admindata']['user_id'];
  $query = $ci->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND FIND_IN_SET('".$user_id."',t.assigned_to) AND STR_TO_DATE(t.task_date, '%Y-%m-%d') <= CURDATE() AND STR_TO_DATE(t.task_end_date, '%Y-%m-%d') >= CURDATE() UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to = '".$user_id."' AND STR_TO_DATE(bot.buyer_order_task_date, '%Y-%m-%d') <= CURDATE() AND STR_TO_DATE(bot.buyer_order_task_end_date, '%Y-%m-%d') >= CURDATE()) ut ORDER BY ut.task_end_date ASC");
  $result = $query->result();
  return $result;
}

function get_all_pending_tasks()
{
  $ci=& get_instance();
  $ci->load->database();
  $user_id = $_SESSION['admindata']['user_id'];
  $query = $ci->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_end_date_both,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee,ut.task_end_date FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_end_date as task_end_date_both,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.task_end_date,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.status != 2 AND t.created_by = asign.user_id AND t.parent_task_id=0 AND FIND_IN_SET('".$user_id."',t.assigned_to) AND STR_TO_DATE(t.task_end_date, '%Y-%m-%d') < CURDATE() UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title,bot.buyer_order_task_end_date as task_end_date_both, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.status != 2 AND bot.created_by = asign.user_id AND bot.assigned_to = '".$user_id."' AND STR_TO_DATE(bot.buyer_order_task_end_date, '%Y-%m-%d') < CURDATE()) ut ORDER BY ut.task_end_date ASC");
  $result = $query->result();
  return $result;
}

function get_all_upcoming_tasks()
{
  $ci=& get_instance();
  $ci->load->database();
  $user_id = $_SESSION['admindata']['user_id'];
  $query = $ci->db->query("SELECT ut.task_type,ut.buyer_order_no,ut.task_title,ut.task_date,ut.task_start_date_both,ut.status,ut.name,ut.priority,ut.comments,ut.task_id,ut.assignee,ut.task_end_date FROM (SELECT '' as buyer_order_no,t.task_type as task_type,t.task_title,t.task_date,t.task_date as task_start_date_both,t.status,(SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id,t.assigned_to) ORDER BY t.task_id) as name,t.task_end_date,t.priority,t.comments,t.task_id, asign.name as assignee FROM task t, users u, users asign WHERE u.user_id = t.assigned_to AND t.created_by = asign.user_id AND t.parent_task_id=0 AND FIND_IN_SET('".$user_id."',t.assigned_to) AND STR_TO_DATE(t.task_date, '%Y-%m-%d') > CURDATE() UNION SELECT bo.buyer_order_invoice_no as buyer_order_no,'0' as task_type,bot.task as task_title,bot.buyer_order_task_date as task_start_date_both, bot.buyer_order_task_date as task_date, bot.buyer_order_task_end_date as task_end_date, bot.status,u.name,'' as priority,bot.remarks as comments,bot.buyer_order_task_id as task_id, asign.name as assignee FROM buyer_order_task bot, buyer_order bo,users u, users asign WHERE bot.buyer_order_id = bo.buyer_order_id AND bot.assigned_to = u.user_id AND bot.created_by = asign.user_id AND bot.assigned_to = '".$user_id."' AND STR_TO_DATE(bot.buyer_order_task_date, '%Y-%m-%d') > CURDATE()) ut ORDER BY ut.task_end_date ASC");
  $result = $query->result();
  return $result;
}
function imap_search_base_subject_lists($inbox,$mailbox_search,$search_criteria)
{
  
  $returned_msg_no = array();

  if($search_criteria == "FROM"){
    $emails_sorted_1 = imap_search($inbox,''.$search_criteria.' "'.$mailbox_search.'"');
    if(is_array($emails_sorted_1)){
      for ($i=0; $i < count($emails_sorted_1); $i++) { 
        if($emails_sorted_1[$i] != '')
        {
          $returned_msg_no[] = $emails_sorted_1[$i];
        }   
      }
    }
  }
  if($search_criteria == "TO"){
    $emails_sorted_2 = imap_search($inbox,''.$search_criteria.' "'.$mailbox_search.'"');
    if(is_array($emails_sorted_2)){
      for ($i=0; $i < count($emails_sorted_2); $i++) { 
        if($emails_sorted_2[$i] != '')
        {
          $returned_msg_no[] = $emails_sorted_2[$i];
        }   
      }
    }
  }
  if($search_criteria == "CC"){
    $emails_sorted_3 = imap_search($inbox,''.$search_criteria.' "'.$mailbox_search.'"');
    if(is_array($emails_sorted_3)){
      for ($i=0; $i < count($emails_sorted_3); $i++) { 
        if($emails_sorted_3[$i] != '')
        {
          $returned_msg_no[] = $emails_sorted_3[$i];
        }   
      }
    }
  }

  if($search_criteria == "BCC"){
    $emails_sorted_4 = imap_search($inbox,''.$search_criteria.' "'.$mailbox_search.'"');
    if(is_array($emails_sorted_4)){
      for ($i=0; $i < count($emails_sorted_4); $i++) { 
        if($emails_sorted_4[$i] != '')
        {
          $returned_msg_no[] = $emails_sorted_4[$i];
        }   
      }
    }
  }
  if($search_criteria == "TEXT"){
    $emails_sorted_5 = imap_search($inbox,''.$search_criteria.' "'.$mailbox_search.'"');
    if(is_array($emails_sorted_5)){
      for ($i=0; $i < count($emails_sorted_5); $i++) { 
        if($emails_sorted_5[$i] != '')
        {
          $returned_msg_no[] = $emails_sorted_5[$i];
        }   
      }
    }
  }
  if($search_criteria == "KEYWORD"){
    $emails_sorted_6 = imap_search($inbox,''.$search_criteria.' "'.$mailbox_search.'"');
    if(is_array($emails_sorted_6)){
      for ($i=0; $i < count($emails_sorted_6); $i++) { 
        if($emails_sorted_6[$i] != '')
        {
          $returned_msg_no[] = $emails_sorted_6[$i];
        }   
      }
    }
  }
  if($search_criteria == "SUBJECT") {
    $emails_sorted_7 = imap_search($inbox,''.$search_criteria.' "'.$mailbox_search.'"');
    if(is_array($emails_sorted_7)){
      for ($i=0; $i < count($emails_sorted_7); $i++) { 
        if($emails_sorted_7[$i] != '')
        {
          $returned_msg_no[] = $emails_sorted_7[$i];
        }   
      }
    }
  }

 $unique_number_only = array_unique($returned_msg_no);
  return $unique_number_only;
  

}

function mailbox_fetch_overview_contents($inbox,$msg_no)
{
  // echo "<pre>";
    $mail_list_contents = array();
    for ($i=0; $i < count($msg_no); $i++) { 

      $mail_content = imap_fetch_overview($inbox,$msg_no[$i]);
      
      // print_r($mail_content);
      // die();
      $mail_list_contents[$i][0]->subject = ($mail_content[0]->subject) ? $mail_content[0]->subject : '';
      $mail_list_contents[$i][0]->from = ($mail_content[0]->from) ? $mail_content[0]->from : '';
      $mail_list_contents[$i][0]->to = ($mail_content[0]->to) ? $mail_content[0]->to : '';
      $mail_list_contents[$i][0]->date = ($mail_content[0]->date) ? $mail_content[0]->date : '';
      $mail_list_contents[$i][0]->message_id = ($mail_content[0]->message_id) ? $mail_content[0]->message_id : '';
      $mail_list_contents[$i][0]->references = ($mail_content[0]->references) ? $mail_content[0]->references : '';
      $mail_list_contents[$i][0]->in_reply_to = ($mail_content[0]->in_reply_to) ? $mail_content[0]->in_reply_to : '';
      $mail_list_contents[$i][0]->size = ($mail_content[0]->size) ? $mail_content[0]->size : '';
      $mail_list_contents[$i][0]->uid = ($mail_content[0]->uid) ? $mail_content[0]->uid : '';
      $mail_list_contents[$i][0]->msgno = ($mail_content[0]->msgno) ? $mail_content[0]->msgno : '';
      $mail_list_contents[$i][0]->recent = ($mail_content[0]->recent) ? $mail_content[0]->recent : '';
      $mail_list_contents[$i][0]->flagged = ($mail_content[0]->flagged) ? $mail_content[0]->flagged : '';
      $mail_list_contents[$i][0]->answered = ($mail_content[0]->answered) ? $mail_content[0]->answered : '';
      $mail_list_contents[$i][0]->deleted = ($mail_content[0]->deleted) ? $mail_content[0]->deleted : '';
      $mail_list_contents[$i][0]->seen = ($mail_content[0]->seen) ? $mail_content[0]->seen : '';
      $mail_list_contents[$i][0]->draft = ($mail_content[0]->draft) ? $mail_content[0]->draft : '';
      $mail_list_contents[$i][0]->udate = ($mail_content[0]->udate) ? $mail_content[0]->udate : '';
    }
    $results = array_reverse($mail_list_contents);
    // echo "<pre>";
    // print_r($results);
    // die();
    return $results;
}

function imap_mailbox_attchments($info_email_ID, $password, $host, $pwd_keyword, $msgno,  $label, $lead_id)
{
  $email_lists = array();
  $imap_host  = $host.':993'; // IMAP host address
  $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
  $imap_user  = $info_email_ID; // IMAP username
  $imap_pass  = decryptthis($password, $pwd_keyword); // IMAP password
  $inbox = @imap_open("{".$imap_host.$imap_flags."}".$label,$imap_user,$imap_pass);

  if(!empty($inbox))
  {
    
   $attachments_names = array();

          $structure = imap_fetchstructure($inbox, $msgno);

          $attachments = array();

          /* if any attachments found... */
          if(isset($structure->parts) && count($structure->parts)) 
          {
              for($i = 0; $i < count($structure->parts); $i++) 
              {
                  $attachments[$i] = array(
                      'is_attachment' => false,
                      'filename' => '',
                      'name' => '',
                      'attachment' => ''
                  );

                  if($structure->parts[$i]->ifdparameters) 
                  {
                      foreach($structure->parts[$i]->dparameters as $object) 
                      {
                          if(strtolower($object->attribute) == 'filename') 
                          {
                              $attachments[$i]['is_attachment'] = true;
                              $attachments[$i]['filename'] = $object->value;
                          }
                      }
                  }

                  if($structure->parts[$i]->ifparameters) 
                  {
                      foreach($structure->parts[$i]->parameters as $object) 
                      {
                          if(strtolower($object->attribute) == 'name') 
                          {
                              $attachments[$i]['is_attachment'] = true;
                              $attachments[$i]['name'] = $object->value;
                          }
                      }
                  }

                  if($attachments[$i]['is_attachment']) 
                  {
                      $attachments[$i]['attachment'] = imap_fetchbody($inbox, $msgno, $i+1);

                      /* 3 = BASE64 encoding */
                      if($structure->parts[$i]->encoding == 3) 
                      { 
                          $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                      }
                      /* 4 = QUOTED-PRINTABLE encoding */
                      elseif($structure->parts[$i]->encoding == 4) 
                      { 
                          $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                      }
                  }
              }
          }

          /* iterate through each attachment and save it */
          foreach($attachments as $attachment)
          {
              if($attachment['is_attachment'] == 1)
              {
                  $filename = str_replace("'", '', $attachment['name']);
                  if(empty($filename)) $filename = $attachment['filename'];

                  if(empty($filename)) $filename = time() . ".dat";
                  $folder = "assets/lead_documents/lead-".$lead_id;
                  if (!is_dir($folder)) {
                    mkdir($folder);
                  }
                  $attachment_name = $msgno . "-" . $filename;
                  $attachments_names[] = $attachment_name;
                  if(!is_dir($folder))
                  {
                       mkdir($folder);
                  }

                  $fp = fopen("./". $folder ."/". $attachment_name, "w+");
                  fwrite($fp, $attachment['attachment']);
                  fclose($fp);
              }
          }
          if (count($attachments_names) > 0) {
            $attachment_name_string = implode(',', $attachments_names);
          }
          else {
            $attachment_name_string = ''; 
          }
  }
  else {
    $attachment_name_string = ''; 
  }
  
  // imap_close($inbox);
 
  return $attachment_name_string;
}
function get_active_followup_by_lead_id($lead_id)
{
  $ci=& get_instance();
  $ci->load->database();
  $query = $ci->db->query("SELECT lf.* FROM lead_followups lf WHERE lf.status = 0 AND lf.lead_id = '".$lead_id."'");
  $result = $query->result();
  return $result; 
}
?>