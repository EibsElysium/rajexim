<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once("config.php");
require_once("class.php");
require_once("mimeDecode.php");

set_time_limit(600);
ini_set('max_execution_time',600);

$mysql = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
$db_selected = mysql_select_db($mysql_db, $mysql);

mysql_set_charset('utf8',$mysql);

/* Pipe */
if ($grab_type == "pipe") {

  $source = "";
  $fd = fopen("php://stdin","r");
  while(!feof($fd)) {
    $source .= fread($fd,1024);
  }

  $uniqid = generateId(20).date("U");
  $emailMessage = new EmailObject($mysql,$uniqid,$source,$file_store);
  $emailMessage->readEmail();
}

/* Fetch */
if ($grab_type == "fetch") 
{
  // To get company email id
  $company_details_query = mysql_query ("SELECT ed.email_detail_id, ed.email_ID, ed.from_name, ed.password, ed.smtp_host  FROM email_details ed WHERE ed.status !=2");
  // To get lead list primary email id
  $lead_details_query = mysql_query ("SELECT lead_id, email_id FROM leads WHERE status = 3");
  
    while($lead_details = mysql_fetch_array($lead_details_query)) 
    {
        if($lead_details['email_id'] != '')
        {
          while ($company_details = mysql_fetch_array($company_details_query))  
          {
            $imap_host  = ""; // IMAP host address
            $imap_flags = ""; // IMAP Flags
            $imap_user  = ""; // IMAP username
            $imap_pass  = ""; // IMAP password

            if($company_details['email_ID'] != '' && $company_details['smtp_host'] != '' && $company_details['password'] != '')
            {
              $imap_host  = $company_details['smtp_host'].':993'; // IMAP host address
              $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
              $imap_user  = $company_details['email_ID']; // IMAP username
              $imap_pass  = decryptthis($company_details['password'],'Rajexim2020'); // IMAP password
              $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX",$imap_user,$imap_pass);
              if ($inbox) 
              {
                $emails = imap_search($inbox, 'FROM "'.$lead_details['email_id'].'"'); //imap_search($inbox,"ALL");
                 
                if (!empty($emails)) 
                {
                  rsort($emails);
                  if ($emails) 
                  {
                    foreach($emails as $n) 
                    {
                      $subject = '';
                      $overview = imap_fetch_overview($inbox,$n,0);
                      //$source = imap_fetchbody($inbox, $n, "");
                      $subject = $overview[0]->subject;
                      $thread_details = '';
                      $thread_details = subject_base_thread_mail($subject, $imap_host, $imap_flags, $imap_user, $imap_pass, $n); 
                      if(!empty($thread_details))
                      {
                        $email_thread_parent_id = '';
                         // To get Parent Id
                        $email_thread_parent_id_query = mysql_query ("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'eibselys_rajexim_crm' AND  TABLE_NAME = 'emails'");
                        $email_thread_parent_id = mysql_fetch_array($email_thread_parent_id_query);
                        
                        foreach ($thread_details as $index => $thread_detail) 
                        {
                          // To check email is exists already
                          $check_mail_details_query = mysql_query ("SELECT id FROM emails WHERE mail_date='".$thread_detail['date']."' AND message_id = '".$thread_detail['message_id']."' AND lead_email = '".$lead_details['email_id']."' AND company_email = '".$company_details['email_ID']."'");
                          $row_count = mysql_num_rows($check_mail_details_query);
                          
                          if($row_count == 0)
                          {
                            $uniqid = generateId(20).date("U");
                            $emailMessage = new EmailObject($mysql,$uniqid,$thread_detail['source'],$file_store, $thread_detail, $lead_details['email_id'], $company_details['email_ID'], $email_thread_parent_id['AUTO_INCREMENT']);
                            $emailMessage->readEmail();

                          }
                        }
                      }
                      
                    }
                  }
                }
                else{
                  echo 'Subject base email is empty!';
                }
                /* imap_errors() is called to supress PHP errors, such as when a mailbox is empty */
                // $errors = imap_errors();
                // imap_close($inbox);
              }
              else{
                echo 'Company Email ID Inbox is empty!';
              }
            }
            else{
              echo 'Company Email ID Or Host Or Password is empty!';
            }
            
          }// End company loop
        }
        else{
          echo 'Lead Email is Empty!';
        }
        
    }// End lead loop
}

function generateId($n) 
{

  mt_srand((double)microtime()*1000000);

  $id = "";
  while(strlen($id)<$n){
    switch(mt_rand(1,3)){
      case 1: $id.=chr(mt_rand(48,57)); break;  // 0-9
      case 2: $id.=chr(mt_rand(65,90)); break;  // A-Z
      case 3: $id.=chr(mt_rand(97,122)); break; // a-z
    }
  }
  return $id;
}
// To get subject base imap email thread array
function subject_base_thread_mail($subject, $imap_host, $imap_flags, $imap_user, $imap_pass, $email_id)
{
  $imap    = imap_open("{".$imap_host.$imap_flags."}INBOX",$imap_user,$imap_pass);
  $threads = array();
  //remove re: and fwd:
  $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $subject));
  //search for subject in current mailbox
  $results = imap_search($imap, 'SUBJECT "'.$subject.'"', SE_UID); 
  //because results can be false
  if(is_array($results)) 
  {
    foreach ($results as $result)
    {
       //now get all the emails details that were found
      $emails = imap_fetch_overview($imap, $result, FT_UID);
      $source = imap_fetchbody($imap, $emails[0]->msgno, '');
      $threads[] = array('subject' => $emails[0]->subject, 'from' => $emails[0]->from, 'to' => $emails[0]->to, 'date' => $emails[0]->date, 'message_id' => $emails[0]->message_id, 'uid' => $emails[0]->uid, 'msgno' => $emails[0]->msgno, 'source' =>$source);
    }  
  }
  //now reopen sent messages
  imap_reopen($imap, "{".$imap_host.$imap_flags.'}[Gmail]/Sent Mail');
  //search for subject in current mailbox
  $results = imap_search($imap, 'SUBJECT "'.$subject.'"', SE_UID);
 
  //because results can be false
  if(is_array($results)) 
  {
    foreach ($results as $result)
    {
       //now get all the emails details that were found
      $emails = imap_fetch_overview($imap, $result, FT_UID);
      $source = imap_fetchbody($imap, $emails[0]->msgno, '');
      $threads[] = array('subject' => $emails[0]->subject, 'from' => $emails[0]->from, 'to' => $emails[0]->to, 'date' => $emails[0]->date, 'message_id' => $emails[0]->message_id, 'uid' => $emails[0]->uid, 'msgno' => $emails[0]->msgno, 'source' =>$source);
    }  
  }
  //sort keys so we get threads in chronological order
  ksort($threads);
  return($threads);
}
// To decrypt password
function decryptthis($data, $key) 
{

  $secret_iv = 'secretivcode';
  $iv = substr(hash('sha256', $secret_iv), 0, 16);
  $encryption_key = base64_decode($key);
  return openssl_decrypt(base64_decode($data), 'aes-256-cbc', $encryption_key, 0, $iv);
}
mysql_close($mysql);
