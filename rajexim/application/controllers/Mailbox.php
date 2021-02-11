<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* ************************************************************************************
    Purpose : To handle Gmail function
    Date    : 12-09-2019 
***************************************************************************************/
ini_set('max_execution_time',259200);

class Mailbox extends CI_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mailbox_model', 'Lead_model', 'Setting_model', 'Product_model'));
    $this->load->helper('download');
    $admindata = $this->session->userdata('admindata');
        // if ($admindata['user_id']>0)
        // {
        //     //do something
        // }else{
        //     redirect('login'); //if session is not there, redirect to login page
        // } 
    date_default_timezone_set("Asia/Kolkata");
  }
 
  public function index()
  {
    $get_role_id_by_user_id = $this->Mailbox_model->get_role_id_by_user_id($_SESSION['admindata']['user_id']);
    $role_id = $get_role_id_by_user_id->role_id;
    if ($role_id == 1) {
      $data['email_lists'] = $this->Mailbox_model->email_list();
    }
    else {
      $data['email_lists'] = $this->Mailbox_model->get_user_allocated_emails($_SESSION['admindata']['user_id']);
    }
    
    if ($this->input->post('info_email') != '') {
      $data['default_email'] = $this->input->post('info_email');
    }
    else {
      $data['default_email'] = $data['email_lists'][0]->email_detail_id;
    }
    
    $this->load->view('mailbox/mailbox_list', $data);
  }
  public function email_content_block()
  {
    $start_time = date('H:i:s');  
    $data['per_page'] = 50; //$this->config->item("per_page");
    $data['start'] =  1;
    $data['default_email'] = $this->input->post('email_id');
    $email_details = $this->Mailbox_model->email_by_id($data['default_email']);
    
    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
    $ima_time_1s = date('H:i:s');
    $imap_open_start = date('H:i:s');

    $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');

    // $update_stream_to_db = $this->Mailbox_model->update_stream_to_db($email_details->email_detail_id,$inbox);
    $data['email_name'] = $imap_user;
    $imap_open_end = date('H:i:s');
    $data['tot_mail_list_count'] = imap_all_inbox_mail_count($inbox);
  
    if ($data['tot_mail_list_count'] < $data['per_page'])
    {
      $data['displayed_mail_list_count'] = 1;
    }
    else 
    {
      $data['displayed_mail_list_count'] = $data['tot_mail_list_count'] - $data['per_page'];
    }
    $w_i_fun_s = date('H:i:s');  

    $f_i_fun_s = date('H:i:s');  
    $result = imap_subject_group_mail_list($inbox,$data['displayed_mail_list_count'],$data['tot_mail_list_count']);
    $f_i_fun_e = date('H:i:s');  

   

    $w_i_fun_e = date('H:i:s');  

    // $data['first_index'] = $data['displayed_mail_list_count'];
    // $data['second_index'] = $data['tot_mail_list_count'];
    // echo $data['unread_message_count'];
    // die();

    $subjects = $datetime = $msgid = array();
    if(!empty($result))
    {
      $f_start_time = date('H:i:s');
      foreach ($result as $key => $overview) 
      {
          $result[$key]->subject = str_replace(',', '٫', $overview->subject);
          $result[$key]->from = str_replace(',', '٫', $overview->from);
          $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview->subject));
    
          if(!empty($subjects))
          {
              if(in_array($subject, $subjects))
              {
                  $index = array_keys($subjects, $subject);
                  $datetime_val = $datetime[$index[0]];
                  if(date('d-m-Y H:i:s', strtotime($overview->date)) > $datetime_val)
                  {
                      $subjects[$index[0]] = $subject;
                      $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview->date));
                      $msgid[$index[0]] = $overview;
                  }
                  else{
                      
                      $subjects[$index[0]] = $subjects[$index[0]];
                      $datetime[$index[0]] = $datetime[$index[0]];
                      $msgid[$index[0]] = $msgid[$index[0]];
                  }
              }
              else
              {
                  $subjects[] = $subject;
                  $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
                  $msgid[] = $overview;
              }


          }
          else
          {
              $subjects[] = $subject;
              $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
              $msgid[] = $overview;

          }
      }
      $f_end_time = date('H:i:s');
      $dates = array();   
      $s_start_time = date('H:i:s');    
      foreach($msgid as $val)
      {
          $dates[] = strtotime($val->date);
      }
      $s_end_time = date('H:i:s');  
      array_multisort($dates, SORT_ASC, $msgid);

      $data['mail_lists'] = array_reverse($msgid);

    }
    else{
      $data['mail_lists'] = '';
    }

    $data['mail_list_count'] = COUNT($data['mail_lists']);

    if(COUNT($data['mail_lists']) > $data['per_page'])
    {
      $data['end'] =  $data['per_page'];
    }
    else{
      $data['end'] = $data['per_page'];
    }  
    // echo "msg idaa";
    // echo "<pre>";
    // print_r($msgid);
    // die();

    $end_time = date('H:i:s');  
   
    // timing_log($start_time,$end_time,'Whole');
    // timing_log($f_start_time,$f_end_time,'Forward message Loop');
    // timing_log($s_start_time,$s_end_time,'Date Format Changing Loop');
    
    // timing_log($f_i_fun_s,$f_i_fun_e,'Get Mail List Contents');
    // timing_log($fi_i_fun_s,$fi_i_fun_e,'Total No of Mail');
    // timing_log($imap_open_start,$imap_open_end,'Imap_open Timing');
    imap_close($inbox);

    $this->load->view('mailbox/mailbox_content',$data);
  }
  public function get_unread_mails_count()
  {
    $emailid = $this->input->post('emailid');
    $email_details = $this->Mailbox_model->email_by_id($emailid);
    $unread_message_count = imap_all_inbox_mail_unread_message_count($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', 'INBOX');

    $sent_unread_message_count = '';

    $draft_unread_message_count = '';

    echo $unread_message_count.'|'.$sent_unread_message_count.'|'.$draft_unread_message_count;
  }
  public function imap_server_informations()
  {
    $data['email_lists'] = $this->Mailbox_model->email_list();
    $data['default_email'] = $data['email_lists'][0]->email_detail_id;
    
    $email_details = $this->Mailbox_model->email_by_id($data['default_email']);
    $server = '{imap.gmail.com:993/ssl}';
    $password = decryptthis($email_details->password,'Rajexim2020');
    $connection = imap_open($server, '', $password); 
    $mailboxes = imap_list($connection, $server, '*');
    echo "<pre>";
    print_r($mailboxes);
    imap_close($connection);
  }
  // To get info email list
  public function info_email_list()
  {
    $data['per_page'] = $this->input->post('per_page');
    $data['emailid'] = $this->input->post('emailid');
    $data['start'] = ($this->input->post('start')) ? $this->input->post('start') : 1;
    $data['end'] = ($this->input->post('end')) ? $this->input->post('end') : $data['per_page'];
    // $data['emails_count'] = $this->input->post('mail_list_count');
    $data['emails_count'] = $this->input->post('tot_mail_list_count');
    $data['displayed_mail_list_count'] = $this->input->post('displayed_mail_list_count');
    $data['mailbox_array'] = $this->input->post('mailbox_array');
    $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    $data['first_index'] = $this->input->post('displayed_mail_list_count');
    $data['second_index'] = $this->input->post('tot_mail_list_count');
    $this->load->view('mailbox/mailbox_email_list', $data);
  }
  public function search_based_email_list()
  {
    $attach = $this->input->post('attach');
    if ($attach != '') {
      $exp_files = explode(',', $attach);
      foreach ($exp_files as $key => $value) {
        if ($value != '') {
          unlink('assets/mail_box_view_attachment/'.$value);
        }
      }
    }
    $data['per_page'] = 10;
    $data['start'] = 0;
    $data['end'] = $data['start'] + $data['per_page'];

    $data['search_criteria'] = $search_criteria = $this->input->post('search_criteria');
    
    $data['search_for_flag'] = $search_for_flag = $this->input->post('search_for_flag');
    $data['emailid'] = $emailid = $this->input->post('emailid');
    $data['mailbox_search'] = $mailbox_search = $this->input->post('mailbox_search');

    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);

    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password

    if($search_for_flag == '1') {      
      $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    }
    else if($search_for_flag == '2') {      
      $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Sent Mail", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    }
    else if($search_for_flag == '3') {      
      $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Drafts", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    }
    else if($search_for_flag == '4') {      
      $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Bin", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    }


      // $result = imap_subject_group_mail_list($inbox,$data['first_index'],$data['second_index']);
      $all_search_base_msg_no = imap_search_base_subject_lists($inbox,$mailbox_search,$search_criteria);

      // print_r($all_search_base_msg_no);
      // die();

      $data['search_msg_no_lists'] = $all_search_base_msg_no;

      $data['current_arr'] = array_slice($all_search_base_msg_no, $data['start'], $data['per_page']);


      $result = mailbox_fetch_overview_contents($inbox, $data['current_arr']);

      // print_r($result);
      // die();
      //  echo "<pre>";
      // print_r($result);
      // echo $result[0][0]->subject;
      // die();

      $subjects = $datetime = $msgid = array();
      if(!empty($result))
      {
        foreach ($result as $key => $overview) 
        {
            $result[$key]->subject = str_replace(',', '٫', $overview[0]->subject);
            $result[$key]->from = str_replace(',', '٫', $overview[0]->from);
            $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview[0]->subject));
      
            if(!empty($subjects))
            {
                if(in_array($subject, $subjects))
                {
                    $index = array_keys($subjects, $subject);
                    $datetime_val = $datetime[$index[0]];
                    if(date('d-m-Y H:i:s', strtotime($overview[0]->date)) > $datetime_val)
                    {
                        $subjects[$index[0]] = $subject;
                        $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview[0]->date));
                        $msgid[$index[0]] = $overview[0];
                    }
                    else{
                        
                        $subjects[$index[0]] = $subjects[$index[0]];
                        $datetime[$index[0]] = $datetime[$index[0]];
                        $msgid[$index[0]] = $msgid[$index[0]];
                    }
                }
                else
                {
                    $subjects[] = $subject;
                    $datetime[] = date('d-m-Y H:i:s', strtotime($overview[0]->date));
                    $msgid[] = $overview[0];
                }


            }
            else
            {
                $subjects[] = $subject;
                $datetime[] = date('d-m-Y H:i:s', strtotime($overview[0]->date));
                $msgid[] = $overview[0];

            }
        }

        $dates = array();       
        foreach($msgid as $val)
        {
            $dates[] = strtotime($val->date);
        }
        array_multisort($dates, SORT_ASC, $msgid);

        $data['mail_lists'] = array_reverse($msgid);

      }
      else
      {
        $data['mail_lists'] = '';
      }

      $data['mail_list_count'] = COUNT($data['mail_lists']);

      // print_r($data['mail_lists']);
      // die();
      $data['mailbox_array'] = str_replace("'","`",json_encode($data['mail_lists']));

      imap_close($inbox);

      $this->load->view('mailbox/search_mailbox_email_list', $data);

  }

  public function get_another_part_of_search()
  {
    // echo "<pre>";
    // print_r($_POST);
    // die();

    $data['per_page'] = ($this->input->post('per_page')) ? $this->input->post('per_page') : '10';
    $data['start'] = ($this->input->post('start')) ? $this->input->post('start') : '0';
    $data['end'] = ($this->input->post('end')) ? $this->input->post('end') : $data['start'] + $data['per_page'];

    $data['search_criteria'] = $search_criteria = $this->input->post('search_criteria');
    
    $data['search_for_flag'] = $search_for_flag = $this->input->post('search_for_flag');
    $data['emailid'] = $this->input->post('emailid');
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);

    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password

    if($search_for_flag == '1') {      
      $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    }
    else if($search_for_flag == '2') {      
      $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Sent Mail", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    }
    else if($search_for_flag == '3') {      
      $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Drafts", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    }
    else if($search_for_flag == '4') {      
      $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Bin", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    }


      // $result = imap_subject_group_mail_list($inbox,$data['first_index'],$data['second_index']);
      // $all_search_base_msg_no = imap_search_base_subject_lists($inbox,$mailbox_search,$search_criteria);

      // print_r($all_search_base_msg_no);
      // die();

      $data['search_msg_no_lists'] = json_decode($this->input->post('search_arr'));

      $data['current_arr'] = array_slice($data['search_msg_no_lists'], $data['start'], $data['per_page']);

      // print_r($data['current_arr']);

      $result = mailbox_fetch_overview_contents($inbox, $data['current_arr']);

      // print_r($result);
      // die();
      //  echo "<pre>";
      // print_r($result);
      // echo $result[0][0]->subject;
      // die();

      $subjects = $datetime = $msgid = array();
      if(!empty($result))
      {
        foreach ($result as $key => $overview) 
        {
            $result[$key]->subject = str_replace(',', '٫', $overview[0]->subject);
            $result[$key]->from = str_replace(',', '٫', $overview[0]->from);
            $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview[0]->subject));
      
            if(!empty($subjects))
            {
                if(in_array($subject, $subjects))
                {
                    $index = array_keys($subjects, $subject);
                    $datetime_val = $datetime[$index[0]];
                    if(date('d-m-Y H:i:s', strtotime($overview[0]->date)) > $datetime_val)
                    {
                        $subjects[$index[0]] = $subject;
                        $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview[0]->date));
                        $msgid[$index[0]] = $overview[0];
                    }
                    else{
                        
                        $subjects[$index[0]] = $subjects[$index[0]];
                        $datetime[$index[0]] = $datetime[$index[0]];
                        $msgid[$index[0]] = $msgid[$index[0]];
                    }
                }
                else
                {
                    $subjects[] = $subject;
                    $datetime[] = date('d-m-Y H:i:s', strtotime($overview[0]->date));
                    $msgid[] = $overview[0];
                }


            }
            else
            {
                $subjects[] = $subject;
                $datetime[] = date('d-m-Y H:i:s', strtotime($overview[0]->date));
                $msgid[] = $overview[0];

            }
        }

        $dates = array();       
        foreach($msgid as $val)
        {
            $dates[] = strtotime($val->date);
        }
        array_multisort($dates, SORT_ASC, $msgid);

        $data['mail_lists'] = array_reverse($msgid);

      }
      else
      {
        $data['mail_lists'] = '';
      }

      $data['mail_list_count'] = COUNT($data['mail_lists']);

      // print_r($data['mail_lists']);
      // die();
      $data['mailbox_array'] = str_replace("'","`",json_encode($data['mail_lists']));

      imap_close($inbox);

      $this->load->view('mailbox/search_mailbox_email_list', $data);

  }
  public function get_pagination_based_email_list()
  {
    $attach = $this->input->post('attach');
    if ($attach != '') {
      $exp_files = explode(',', $attach);
      foreach ($exp_files as $key => $value) {
        if ($value != '') {
          unlink('assets/mail_box_view_attachment/'.$value);
        }
      }
    }
    $start_time = date('H:i:s');
    $data['start'] = $this->input->post('start');
    $data['end'] = $this->input->post('end');
    $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    $data['emails_count'] = $this->input->post('tot_mail_list_count');
    $data['emailid'] = $this->input->post('emailid');
    $data['second_index'] = $this->input->post('second_index');
    $data['first_index'] = $this->input->post('first_index');
    $data['per_page'] = $this->input->post('per_page');
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);

    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
    $ima_time_1s = date('H:i:s');
    $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    $result = imap_subject_group_mail_list($inbox,$data['first_index'],$data['second_index']);
    $data['displayed_mail_list_count'] = $data['first_index'];
    // echo $data['unread_message_count'];
    // die();

    $subjects = $datetime = $msgid = array();
    if(!empty($result))
    {
      foreach ($result as $key => $overview) 
      {
          $result[$key]->subject = str_replace(',', '٫', $overview->subject);
          $result[$key]->from = str_replace(',', '٫', $overview->from);
          $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview->subject));
    
          if(!empty($subjects))
          {
              if(in_array($subject, $subjects))
              {
                  $index = array_keys($subjects, $subject);
                  $datetime_val = $datetime[$index[0]];
                  if(date('d-m-Y H:i:s', strtotime($overview->date)) > $datetime_val)
                  {
                      $subjects[$index[0]] = $subject;
                      $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview->date));
                      $msgid[$index[0]] = $overview;
                  }
                  else{
                      
                      $subjects[$index[0]] = $subjects[$index[0]];
                      $datetime[$index[0]] = $datetime[$index[0]];
                      $msgid[$index[0]] = $msgid[$index[0]];
                  }
              }
              else
              {
                  $subjects[] = $subject;
                  $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
                  $msgid[] = $overview;
              }


          }
          else
          {
              $subjects[] = $subject;
              $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
              $msgid[] = $overview;

          }
      }

      $dates = array();       
      foreach($msgid as $val)
      {
          $dates[] = strtotime($val->date);
      }
      array_multisort($dates, SORT_ASC, $msgid);

      $data['mail_lists'] = array_reverse($msgid);

    }
    else{
      $data['mail_lists'] = '';
    }

    $data['mail_list_count'] = COUNT($data['mail_lists']);

    
    $data['mailbox_array'] = str_replace("'","`",json_encode($data['mail_lists']));
    // print_r($_POST);
    // echo "<br>";
    // echo $data['end'];
    // echo "<br>";
    // echo $data['mailbox_array'];
    // echo "<br>";
    // echo $data['mailbox_array'];
    // die();
    // echo "<pre>";
    // print_r($data);
    // die();

    imap_close($inbox);
    $this->load->view('mailbox/mailbox_email_list', $data);
  }
  public function get_send_pagination_based_email_list()
  {
    $attach = $this->input->post('attach');
    if ($attach != '') {
      $exp_files = explode(',', $attach);
      foreach ($exp_files as $key => $value) {
        if ($value != '') {
          unlink('assets/mail_box_view_attachment/'.$value);
        }
      }
    }

    $data['start'] = $this->input->post('start');
    $data['end'] = $this->input->post('end');
    $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    $data['emails_count'] = $this->input->post('tot_mail_list_count');
    $data['emailid'] = $this->input->post('emailid');
    $data['second_index'] = $this->input->post('second_index');
    $data['first_index'] = $this->input->post('first_index');
    $data['per_page'] = $this->input->post('per_page');
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);

    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
    $ima_time_1s = date('H:i:s');
    $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Sent Mail", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');

    $result = imap_subject_group_mail_list($inbox,$data['first_index'],$data['second_index']);
    $data['displayed_mail_list_count'] = $data['first_index'];
    // echo $data['unread_message_count'];
    // die();

    $subjects = $datetime = $msgid = array();
    if(!empty($result))
    {
      foreach ($result as $key => $overview) 
      {
          $result[$key]->subject = str_replace(',', '٫', $overview->subject);
          $result[$key]->from = str_replace(',', '٫', $overview->from);
          $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview->subject));
    
          if(!empty($subjects))
          {
              if(in_array($subject, $subjects))
              {
                  $index = array_keys($subjects, $subject);
                  $datetime_val = $datetime[$index[0]];
                  if(date('d-m-Y H:i:s', strtotime($overview->date)) > $datetime_val)
                  {
                      $subjects[$index[0]] = $subject;
                      $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview->date));
                      $msgid[$index[0]] = $overview;
                  }
                  else{
                      
                      $subjects[$index[0]] = $subjects[$index[0]];
                      $datetime[$index[0]] = $datetime[$index[0]];
                      $msgid[$index[0]] = $msgid[$index[0]];
                  }
              }
              else
              {
                  $subjects[] = $subject;
                  $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
                  $msgid[] = $overview;
              }


          }
          else
          {
              $subjects[] = $subject;
              $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
              $msgid[] = $overview;

          }
      }

      $dates = array();       
      foreach($msgid as $val)
      {
          $dates[] = strtotime($val->date);
      }
      array_multisort($dates, SORT_ASC, $msgid);

      $data['mail_lists'] = array_reverse($msgid);

    }
    else{
      $data['mail_lists'] = '';
    }

    $data['mail_list_count'] = COUNT($data['mail_lists']); 
    // echo "msg idaa";
    // echo "<pre>";
    // print_r($msgid);
    // die();
    $data['mailbox_array'] = str_replace("'","`",json_encode($data['mail_lists']));
    // print_r($_POST);
    // echo "<br>";
    // echo $data['end'];
    // echo "<br>";
    // echo $data['mailbox_array'];
    // echo "<br>";
    // echo $data['mailbox_array'];
    // die();
    imap_close($inbox);
    $this->load->view('mailbox/sent_mailbox_email_list', $data);
  }
  public function info_sent_email_list()
  {
    $data['per_page'] = 50; //$this->config->item("per_page");
    $data['start'] =  1;
    $data['emailid'] = $this->input->post('emailid');
    
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
    $ima_time_1s = date('H:i:s');
    $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Sent Mail", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');

     $data['tot_mail_list_count'] = imap_all_inbox_mail_count($inbox);
     $data['emails_count'] = $data['tot_mail_list_count'];
    if ($data['tot_mail_list_count'] < $data['per_page'])
    {
      $data['displayed_mail_list_count'] = 1;
    }
    else 
    {
      $data['displayed_mail_list_count'] = $data['tot_mail_list_count'] - $data['per_page'];
    }

    $result = imap_subject_group_mail_list($inbox,$data['displayed_mail_list_count'],$data['tot_mail_list_count']);
    $data['first_index'] = $data['displayed_mail_list_count'];
    $data['second_index'] = $data['tot_mail_list_count'];
    // echo $data['unread_message_count'];
    // die();

    $subjects = $datetime = $msgid = array();
    if(!empty($result))
    {
      foreach ($result as $key => $overview) 
      {
          $result[$key]->subject = str_replace(',', '٫', $overview->subject);
          $result[$key]->from = str_replace(',', '٫', $overview->from);
          $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview->subject));
    
          if(!empty($subjects))
          {
              if(in_array($subject, $subjects))
              {
                  $index = array_keys($subjects, $subject);
                  $datetime_val = $datetime[$index[0]];
                  if(date('d-m-Y H:i:s', strtotime($overview->date)) > $datetime_val)
                  {
                      $subjects[$index[0]] = $subject;
                      $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview->date));
                      $msgid[$index[0]] = $overview;
                  }
                  else{
                      
                      $subjects[$index[0]] = $subjects[$index[0]];
                      $datetime[$index[0]] = $datetime[$index[0]];
                      $msgid[$index[0]] = $msgid[$index[0]];
                  }
              }
              else
              {
                  $subjects[] = $subject;
                  $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
                  $msgid[] = $overview;
              }


          }
          else
          {
              $subjects[] = $subject;
              $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
              $msgid[] = $overview;

          }
      }

      $dates = array();       
      foreach($msgid as $val)
      {
          $dates[] = strtotime($val->date);
      }
      array_multisort($dates, SORT_ASC, $msgid);

      $data['mail_lists'] = array_reverse($msgid);

    }
    else{
      $data['mail_lists'] = '';
    }

    $data['mail_list_count'] = COUNT($data['mail_lists']);

    if(COUNT($data['mail_lists']) > $data['per_page'])
    {
      $data['end'] =  $data['per_page'];
    }
    else{
      $data['end'] = $data['per_page'];
    }  
    
    $data['mailbox_array'] = str_replace("'","`",json_encode($data['mail_lists']));
    imap_close($inbox);
    $this->load->view('mailbox/sent_mailbox_email_list', $data);
  }
  public function info_draft_email_list()
  {
    $data['per_page'] = 50; //$this->config->item("per_page");
    $data['start'] =  1;
    $data['emailid'] = $this->input->post('emailid');
    
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
    $ima_time_1s = date('H:i:s');
    $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Drafts", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
     $data['tot_mail_list_count'] = imap_all_inbox_mail_count($inbox);
     $data['emails_count'] = $data['tot_mail_list_count'];
    if ($data['tot_mail_list_count'] < $data['per_page'])
    {
      $data['displayed_mail_list_count'] = 1;
    }
    else 
    {
      $data['displayed_mail_list_count'] = $data['tot_mail_list_count'] - $data['per_page'];
    }

    $result = imap_subject_group_mail_list($inbox,$data['displayed_mail_list_count'],$data['tot_mail_list_count']);
    $data['first_index'] = $data['displayed_mail_list_count'];
    $data['second_index'] = $data['tot_mail_list_count'];
    // echo $data['unread_message_count'];
    // die();

    $subjects = $datetime = $msgid = array();
    if(!empty($result))
    {
      foreach ($result as $key => $overview) 
      {
          $result[$key]->subject = str_replace(',', '٫', $overview->subject);
          $result[$key]->from = str_replace(',', '٫', $overview->from);
          $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview->subject));
    
          if(!empty($subjects))
          {
              if(in_array($subject, $subjects))
              {
                  $index = array_keys($subjects, $subject);
                  $datetime_val = $datetime[$index[0]];
                  if(date('d-m-Y H:i:s', strtotime($overview->date)) > $datetime_val)
                  {
                      $subjects[$index[0]] = $subject;
                      $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview->date));
                      $msgid[$index[0]] = $overview;
                  }
                  else{
                      
                      $subjects[$index[0]] = $subjects[$index[0]];
                      $datetime[$index[0]] = $datetime[$index[0]];
                      $msgid[$index[0]] = $msgid[$index[0]];
                  }
              }
              else
              {
                  $subjects[] = $subject;
                  $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
                  $msgid[] = $overview;
              }


          }
          else
          {
              $subjects[] = $subject;
              $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
              $msgid[] = $overview;

          }
      }

      $dates = array();       
      foreach($msgid as $val)
      {
          $dates[] = strtotime($val->date);
      }
      array_multisort($dates, SORT_ASC, $msgid);

      $data['mail_lists'] = array_reverse($msgid);

    }
    else{
      $data['mail_lists'] = '';
    }

    $data['mail_list_count'] = COUNT($data['mail_lists']);

    if(COUNT($data['mail_lists']) > $data['per_page'])
    {
      $data['end'] =  $data['per_page'];
    }
    else{
      $data['end'] = $data['per_page'];
    }  
    
    $data['mailbox_array'] = str_replace("'","`",json_encode($data['mail_lists']));
    imap_close($inbox);
    $this->load->view('mailbox/draft_mailbox_email_list', $data);
  }
  
  public function get_draft_pagination_based_email_list()
  {
    $data['start'] = $this->input->post('start');
    $data['end'] = $this->input->post('end');
    $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    $data['emails_count'] = $this->input->post('tot_mail_list_count');
    $data['emailid'] = $this->input->post('emailid');
    $data['second_index'] = $this->input->post('second_index');
    $data['first_index'] = $this->input->post('first_index');
    $data['per_page'] = $this->input->post('per_page');
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
    $ima_time_1s = date('H:i:s');
    $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Drafts", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');

    $result = imap_subject_group_mail_list($inbox,$data['first_index'],$data['second_index']);
    $data['displayed_mail_list_count'] = $data['first_index'];
    // echo $data['unread_message_count'];
    // die();

    $subjects = $datetime = $msgid = array();
    if(!empty($result))
    {
      foreach ($result as $key => $overview) 
      {
          $result[$key]->subject = str_replace(',', '٫', $overview->subject);
          $result[$key]->from = str_replace(',', '٫', $overview->from);
          $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview->subject));
    
          if(!empty($subjects))
          {
              if(in_array($subject, $subjects))
              {
                  $index = array_keys($subjects, $subject);
                  $datetime_val = $datetime[$index[0]];
                  if(date('d-m-Y H:i:s', strtotime($overview->date)) > $datetime_val)
                  {
                      $subjects[$index[0]] = $subject;
                      $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview->date));
                      $msgid[$index[0]] = $overview;
                  }
                  else{
                      
                      $subjects[$index[0]] = $subjects[$index[0]];
                      $datetime[$index[0]] = $datetime[$index[0]];
                      $msgid[$index[0]] = $msgid[$index[0]];
                  }
              }
              else
              {
                  $subjects[] = $subject;
                  $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
                  $msgid[] = $overview;
              }


          }
          else
          {
              $subjects[] = $subject;
              $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
              $msgid[] = $overview;

          }
      }

      $dates = array();       
      foreach($msgid as $val)
      {
          $dates[] = strtotime($val->date);
      }
      array_multisort($dates, SORT_ASC, $msgid);

      $data['mail_lists'] = array_reverse($msgid);

    }
    else{
      $data['mail_lists'] = '';
    }

    $data['mail_list_count'] = COUNT($data['mail_lists']);

    // if(COUNT($data['mail_lists']) > $data['per_page'])
    // {
    //   $data['end'] =  $data['per_page'];
    // }
    // else{
    //   $data['end'] = $data['per_page'];
    // }  
    // echo "msg idaa";
    // echo "<pre>";
    // print_r($msgid);
    // die();
    $data['mailbox_array'] = str_replace("'","`",json_encode($data['mail_lists']));
    // print_r($_POST);
    // echo "<br>";
    // echo $data['end'];
    // echo "<br>";
    // echo $data['mailbox_array'];
    // echo "<br>";
    // echo $data['mailbox_array'];
    // die();
    imap_close($inbox);
    $this->load->view('mailbox/draft_mailbox_email_list', $data);
  }
  public function draft_imap_mailbox_view()
  {
    $data['start'] = $this->input->post('start');
    $data['end'] = $this->input->post('end');
    $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    $data['emails_count'] = $this->input->post('tot_mail_list_count');
    $data['second_index'] = $this->input->post('second_index');
    $data['first_index'] = $this->input->post('first_index');
    $data['per_page'] = $this->input->post('per_page');

    $data['emailid'] = $this->input->post('emailid');
    $data['msgno'] = ($this->input->post('msgno')) ? $this->input->post('msgno') : '';
    $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $data['imap_email_lists'] = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msgno'], $data['label']);
    $sender_mailid = $data['imap_email_lists']['msg_from'][0]->mailbox.'@'.$data['imap_email_lists']['msg_from'][0]->host;
    if (strpos($sender_mailid, 'feedback@service.alibaba.com') !== false) {
      $data['is_alibaba_mail'] = 1;
      $data['user_mail_already_exist'] = 0;
    }
    else {
      $data['is_alibaba_mail'] = 0;
      $chk_sender_is_already_lead = $this->Mailbox_model->chk_this_mail_already_as_a_lead($sender_mailid);  
      if (count($chk_sender_is_already_lead) > 0) {
        $data['user_mail_already_exist'] = 1;
      }
      else {
        $data['user_mail_already_exist'] = 1;
      }
    }
    $this->load->view('mailbox/draft_mailbox_email_view', $data);
  }

  public function info_bin_email_list()
  {
    $data['per_page'] = 50; //$this->config->item("per_page");
    $data['start'] =  1;
    $data['emailid'] = $this->input->post('emailid');
    
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
    $ima_time_1s = date('H:i:s');
    $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Bin", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
     $data['tot_mail_list_count'] = imap_all_inbox_mail_count($inbox);
     $data['emails_count'] = $data['tot_mail_list_count'];
    if ($data['tot_mail_list_count'] < $data['per_page'])
    {
      $data['displayed_mail_list_count'] = 1;
    }
    else 
    {
      $data['displayed_mail_list_count'] = $data['tot_mail_list_count'] - $data['per_page'];
    }

    $result = imap_subject_group_mail_list($inbox,$data['displayed_mail_list_count'],$data['tot_mail_list_count']);
    $data['first_index'] = $data['displayed_mail_list_count'];
    $data['second_index'] = $data['tot_mail_list_count'];
    // echo $data['unread_message_count'];
    // die();

    $subjects = $datetime = $msgid = array();
    if(!empty($result))
    {
      foreach ($result as $key => $overview) 
      {
          $result[$key]->subject = str_replace(',', '٫', $overview->subject);
          $result[$key]->from = str_replace(',', '٫', $overview->from);
          $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview->subject));
    
          if(!empty($subjects))
          {
              if(in_array($subject, $subjects))
              {
                  $index = array_keys($subjects, $subject);
                  $datetime_val = $datetime[$index[0]];
                  if(date('d-m-Y H:i:s', strtotime($overview->date)) > $datetime_val)
                  {
                      $subjects[$index[0]] = $subject;
                      $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview->date));
                      $msgid[$index[0]] = $overview;
                  }
                  else{
                      
                      $subjects[$index[0]] = $subjects[$index[0]];
                      $datetime[$index[0]] = $datetime[$index[0]];
                      $msgid[$index[0]] = $msgid[$index[0]];
                  }
              }
              else
              {
                  $subjects[] = $subject;
                  $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
                  $msgid[] = $overview;
              }


          }
          else
          {
              $subjects[] = $subject;
              $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
              $msgid[] = $overview;

          }
      }

      $dates = array();       
      foreach($msgid as $val)
      {
          $dates[] = strtotime($val->date);
      }
      array_multisort($dates, SORT_ASC, $msgid);

      $data['mail_lists'] = array_reverse($msgid);

    }
    else{
      $data['mail_lists'] = '';
    }

    $data['mail_list_count'] = COUNT($data['mail_lists']);

    if(COUNT($data['mail_lists']) > $data['per_page'])
    {
      $data['end'] =  $data['per_page'];
    }
    else{
      $data['end'] = $data['per_page'];
    }  
    
    $data['mailbox_array'] = str_replace("'","`",json_encode($data['mail_lists']));
    imap_close($inbox);
    $this->load->view('mailbox/bin_mailbox_email_list', $data);
  }
  public function get_bin_pagination_based_email_list()
  {
    $data['start'] = $this->input->post('start');
    $data['end'] = $this->input->post('end');
    $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    $data['emails_count'] = $this->input->post('tot_mail_list_count');
    $data['emailid'] = $this->input->post('emailid');
    $data['second_index'] = $this->input->post('second_index');
    $data['first_index'] = $this->input->post('first_index');
    $data['per_page'] = $this->input->post('per_page');
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
    $ima_time_1s = date('H:i:s');
    $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Bin", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');

    $result = imap_subject_group_mail_list($inbox,$data['first_index'],$data['second_index']);
    $data['displayed_mail_list_count'] = $data['first_index'];
    // echo $data['unread_message_count'];
    // die();

    $subjects = $datetime = $msgid = array();
    if(!empty($result))
    {
      foreach ($result as $key => $overview) 
      {
          $result[$key]->subject = str_replace(',', '٫', $overview->subject);
          $result[$key]->from = str_replace(',', '٫', $overview->from);
          $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview->subject));
    
          if(!empty($subjects))
          {
              if(in_array($subject, $subjects))
              {
                  $index = array_keys($subjects, $subject);
                  $datetime_val = $datetime[$index[0]];
                  if(date('d-m-Y H:i:s', strtotime($overview->date)) > $datetime_val)
                  {
                      $subjects[$index[0]] = $subject;
                      $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview->date));
                      $msgid[$index[0]] = $overview;
                  }
                  else{
                      
                      $subjects[$index[0]] = $subjects[$index[0]];
                      $datetime[$index[0]] = $datetime[$index[0]];
                      $msgid[$index[0]] = $msgid[$index[0]];
                  }
              }
              else
              {
                  $subjects[] = $subject;
                  $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
                  $msgid[] = $overview;
              }


          }
          else
          {
              $subjects[] = $subject;
              $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
              $msgid[] = $overview;

          }
      }

      $dates = array();       
      foreach($msgid as $val)
      {
          $dates[] = strtotime($val->date);
      }
      array_multisort($dates, SORT_ASC, $msgid);

      $data['mail_lists'] = array_reverse($msgid);

    }
    else{
      $data['mail_lists'] = '';
    }

    $data['mail_list_count'] = COUNT($data['mail_lists']);

    // if(COUNT($data['mail_lists']) > $data['per_page'])
    // {
    //   $data['end'] =  $data['per_page'];
    // }
    // else{
    //   $data['end'] = $data['per_page'];
    // }  
    // echo "msg idaa";
    // echo "<pre>";
    // print_r($msgid);
    // die();
    $data['mailbox_array'] = str_replace("'","`",json_encode($data['mail_lists']));
    // print_r($_POST);
    // echo "<br>";
    // echo $data['end'];
    // echo "<br>";
    // echo $data['mailbox_array'];
    // echo "<br>";
    // echo $data['mailbox_array'];
    // die();
    imap_close($inbox);
    $this->load->view('mailbox/bin_mailbox_email_list', $data);
  }
  public function bin_imap_mailbox_view()
  {
    $data['start'] = $this->input->post('start');
    $data['end'] = $this->input->post('end');
    $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    $data['emails_count'] = $this->input->post('tot_mail_list_count');
    $data['second_index'] = $this->input->post('second_index');
    $data['first_index'] = $this->input->post('first_index');
    $data['per_page'] = $this->input->post('per_page');

    $data['emailid'] = $this->input->post('emailid');
    $data['msgno'] = ($this->input->post('msgno')) ? $this->input->post('msgno') : '';
    $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $data['imap_email_lists'] = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msgno'], $data['label']);
    
    $sender_mailid = $data['imap_email_lists']['msg_from'][0]->mailbox.'@'.$data['imap_email_lists']['msg_from'][0]->host;
    if (strpos($sender_mailid, 'feedback@service.alibaba.com') !== false) {
      $data['is_alibaba_mail'] = 1;
      $data['user_mail_already_exist'] = 0;
    }
    else {
      $data['is_alibaba_mail'] = 0;
      $chk_sender_is_already_lead = $this->Mailbox_model->chk_this_mail_already_as_a_lead($sender_mailid);  
      if (count($chk_sender_is_already_lead) > 0) {
        $data['user_mail_already_exist'] = 1;
      }
      else {
        $data['user_mail_already_exist'] = 1;
      }
    }
    $this->load->view('mailbox/bin_mailbox_email_view', $data);
  }
  public function sent_imap_mailbox_view()
  {
    $data['start'] = $this->input->post('start');
    $data['end'] = $this->input->post('end');
    $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    $data['emails_count'] = $this->input->post('tot_mail_list_count');
    $data['second_index'] = $this->input->post('second_index');
    $data['first_index'] = $this->input->post('first_index');
    $data['per_page'] = $this->input->post('per_page');

    $data['emailid'] = $this->input->post('emailid');
    $data['msgno'] = ($this->input->post('msgno')) ? $this->input->post('msgno') : '';
    $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $data['imap_email_lists'] = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msgno'], $data['label']);
    
    $sender_mailid = $data['imap_email_lists']['msg_from'][0]->mailbox.'@'.$data['imap_email_lists']['msg_from'][0]->host;
    
    $receiver_mailid = $data['imap_email_lists']['msg_to'][0]->mailbox.'@'.$data['imap_email_lists']['msg_to'][0]->host;
    $get_lead_by_email_matches = $this->Mailbox_model->get_lead_by_email_matches($sender_mailid,$cc_address,$bcc_address,$reply_to,$receiver_mailid);
    $cc_address = $data['imap_email_lists']['cc_address'];
    $bcc_address = $data['imap_email_lists']['bcc_address'];
    $reply_to = $data['imap_email_lists']['reply_to'];
    $data['is_lead'] = count($get_lead_by_email_matches);

    $data['contact_book_id'] = $get_lead_by_email_matches->contact_book_id;

    $data['all_lead_info'] = $this->Mailbox_model->get_all_lead_by_contact_id($get_lead_by_email_matches->contact_book_id);

    if (strpos($sender_mailid, 'feedback@service.alibaba.com') !== false) {
      $data['is_alibaba_mail'] = 1;
      $data['user_mail_already_exist'] = 0;
    }
    else {
      $data['is_alibaba_mail'] = 0;
      $chk_sender_is_already_lead = $this->Mailbox_model->chk_this_mail_already_as_a_lead($sender_mailid);  
      if (count($chk_sender_is_already_lead) > 0) {
        $data['user_mail_already_exist'] = 1;
      }
      else {
        $data['user_mail_already_exist'] = 1;
      }
    }
    $this->load->view('mailbox/sent_mailbox_email_view', $data);
  }
  // To view mail message 
  public function imap_mailbox_view()
  {
    $data['start'] = $this->input->post('start');
    $data['end'] = $this->input->post('end');
    $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    $data['emails_count'] = $this->input->post('tot_mail_list_count');
    $data['second_index'] = $this->input->post('second_index');
    $data['first_index'] = $this->input->post('first_index');
    $data['per_page'] = $this->input->post('per_page');

    $data['emailid'] = $this->input->post('emailid');
    $data['msgno'] = ($this->input->post('msgno')) ? $this->input->post('msgno') : '';
    $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $data['imap_email_lists'] = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msgno'], $data['label']);
    
    $sender_mailid = $data['imap_email_lists']['msg_from'][0]->mailbox.'@'.$data['imap_email_lists']['msg_from'][0]->host;
    $receiver_mailid = $data['imap_email_lists']['msg_to'][0]->mailbox.'@'.$data['imap_email_lists']['msg_to'][0]->host;
    $cc_address = $data['imap_email_lists']['cc_address'];
    $bcc_address = $data['imap_email_lists']['bcc_address'];
    $reply_to = $data['imap_email_lists']['reply_to'];



    $get_lead_by_email_matches = $this->Mailbox_model->get_lead_by_email_matches($sender_mailid,$cc_address,$bcc_address,$reply_to,$receiver_mailid);

    $data['is_lead'] = count($get_lead_by_email_matches);

    $data['contact_book_id'] = $get_lead_by_email_matches->contact_book_id;

    $data['all_lead_info'] = $this->Mailbox_model->get_all_lead_by_contact_id($get_lead_by_email_matches->contact_book_id);

    if (strpos($sender_mailid, 'feedback@service.alibaba.com') !== false) {
      $data['is_alibaba_mail'] = 1;
      $data['user_mail_already_exist'] = 0;
    }
    else {
      $data['is_alibaba_mail'] = 0;
      $chk_sender_is_already_lead = $this->Mailbox_model->chk_this_mail_already_as_a_lead($sender_mailid);  
      if (count($chk_sender_is_already_lead) > 0) {
        // $data['user_mail_already_exist'] = 0;
        $data['user_mail_already_exist'] = 1;
      }
      else {
        $data['user_mail_already_exist'] = 1;
      }
    }
    // print_r($data['imap_email_lists']);
    // die();
    $this->load->view('mailbox/mailbox_email_view', $data);
  }

  public function imap_mailbox_view_search()
  {
    // $data['start'] = $this->input->post('start');
    // $data['end'] = $this->input->post('end');
    // $data['tot_mail_list_count'] = $this->input->post('tot_mail_list_count');
    // $data['emails_count'] = $this->input->post('tot_mail_list_count');
    // $data['second_index'] = $this->input->post('second_index');
    // $data['first_index'] = $this->input->post('first_index');
    // $data['per_page'] = $this->input->post('per_page');

    $data['search_criteria'] = $this->input->post('search_criteria');
    $data['flag'] = $this->input->post('flag');
    $data['emailid'] = $this->input->post('emailid');
    $data['msgno'] = ($this->input->post('msgno')) ? $this->input->post('msgno') : '';
    $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $data['imap_email_lists'] = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msgno'], $data['label']);
    
    $sender_mailid = $data['imap_email_lists']['msg_from'][0]->mailbox.'@'.$data['imap_email_lists']['msg_from'][0]->host;
    $receiver_mailid = $data['imap_email_lists']['msg_to'][0]->mailbox.'@'.$data['imap_email_lists']['msg_to'][0]->host;
    $cc_address = $data['imap_email_lists']['cc_address'];
    $bcc_address = $data['imap_email_lists']['bcc_address'];
    $reply_to = $data['imap_email_lists']['reply_to'];

    // "<br>";

    $get_lead_by_email_matches = $this->Mailbox_model->get_lead_by_email_matches($sender_mailid,$cc_address,$bcc_address,$reply_to,$receiver_mailid);
    // print_r($get_lead_by_email_matches);
    // die();
    $data['is_lead'] = count($get_lead_by_email_matches);

    $data['contact_book_id'] = $get_lead_by_email_matches->contact_book_id;

    $data['all_lead_info'] = $this->Mailbox_model->get_all_lead_by_contact_id($get_lead_by_email_matches->contact_book_id);

    if (strpos($sender_mailid, 'feedback@service.alibaba.com') !== false) {
      $data['is_alibaba_mail'] = 1;
      $data['user_mail_already_exist'] = 0;
    }
    else {
      $data['is_alibaba_mail'] = 0;
      $chk_sender_is_already_lead = $this->Mailbox_model->chk_this_mail_already_as_a_lead($sender_mailid);  
      if (count($chk_sender_is_already_lead) > 0) {
        // $data['user_mail_already_exist'] = 0;
        $data['user_mail_already_exist'] = 1;
      }
      else {
        $data['user_mail_already_exist'] = 1;
      }
    }
    // print_r($data['imap_email_lists']);
    // die();
    $this->load->view('mailbox/search_mailbox_email_view', $data);
  }

  
  //To save the lead from mail
  public function save_mail_to_lead($email,$msgno,$label)
  {
    // $data['emailid'] = $this->input->post('emailid');
    // $data['msgno'] = ($this->input->post('msgno')) ? $this->input->post('msgno') : '';
    // $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
    $data['emailid'] = $email;
    $data['msgno'] = $msgno;
    $data['label'] = $label;
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $get_ind_mail_details = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msgno'], $data['label']);
    $data['get_ind_mail_details'] = $get_ind_mail_details;
    $mail_subject = $get_ind_mail_details['subject'];  
    $less_subject = substr($mail_subject, strpos($mail_subject, "You have a new inquiry: ") + 24);    
    $data['lead_name'] = str_replace(" has sent you an inquiry","",$less_subject);
    $data['message'] = $get_ind_mail_details['message'];
    $to_get_lead_email_1 = substr($get_ind_mail_details['message'], strpos($get_ind_mail_details['message'], "Reply-To:") + 2); 
    $to_get_lead_email_2 = substr($to_get_lead_email_1, strpos($to_get_lead_email_1, "_blank") + 2); 

    $lead_email_id = get_string_between($to_get_lead_email_2, '&lt;', '&gt;');
    // $data['email_id'] = trim($lead_email_id);
    $data['email_id'] = $get_ind_mail_details['msg_from'][0]->mailbox.'@'.$get_ind_mail_details['msg_from'][0]->host;
    // die();
    // $c_by =  $_SESSION['admindata']['user_id'];
    // $c_on = date('Y-m-d H:i:s');
    // $country = '1000';
    // $email_id = 'unknown_alibaba_client_email@xxx.com';
    // $lead_source_id = '100';
    // $add_to_lead = $this->Mailbox_model->add_mail_to_lead($lead_name,$message,$c_by,$c_on,$country,$email_id,$lead_source_id);
    // if ($add_to_lead == 1) {
    //   echo "1";
    // }
    // else {
    //   echo "0";
    // }
    $data['country_lists'] = $this->Lead_model->country_list();
    $data['product_lists'] = $this->Product_model->product_list_count('all', '', '');
    $data['lead_type_lists'] = $this->Lead_model->lead_type_list();
    $data['lead_source_lists'] = $this->Lead_model->lead_source_list();
    $data['lead_status_lists'] = $this->Lead_model->lead_status_list();
    $data['alibaba_or_not'] = '1';
    // echo $to_get_lead_email_2;
    $data['lead_add_from_mail_box'] = '1';
    // $this->load->view('mailbox/mail_to_create_lead',$data);
    $this->load->view('lead/add_lead_page',$data);

  }
  public function normal_save_mail_to_lead($email,$msgno,$label)
  {
    $data['alibaba_or_not'] = '0';
    // $data['emailid'] = $this->input->post('emailid');
    // $data['msgno'] = ($this->input->post('msgno')) ? $this->input->post('msgno') : '';
    // $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
    $data['emailid'] = $email;
    $data['msgno'] = $msgno;
    $data['label'] = $label;
    $email_details = $this->Mailbox_model->email_by_id($data['emailid']);
    $get_ind_mail_details = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msgno'], $data['label']);
    
    // $mail_subject = $get_ind_mail_details['subject'];  
    // $less_subject = substr($mail_subject, strpos($mail_subject, "You have a new inquiry:") + 30);  
    $data['get_ind_mail_details'] = $get_ind_mail_details;  
    $data['lead_name'] = '';
    $data['email_id'] = $get_ind_mail_details['msg_from'][0]->mailbox.'@'.$get_ind_mail_details['msg_from'][0]->host;
    $data['message'] = str_replace("'", '"', $get_ind_mail_details['message']);
    // echo $get_ind_mail_details['reply_to'];
    // die();
    $data['country_lists'] = $this->Lead_model->country_list();
    $data['product_lists'] = $this->Product_model->product_list_count('all', '', '');
    $data['lead_type_lists'] = $this->Lead_model->lead_type_list();
    $data['lead_source_lists'] = $this->Lead_model->lead_source_list();
    $data['lead_status_lists'] = $this->Lead_model->lead_status_list();
    $data['lead_add_from_mail_box'] = '1';
    // $this->load->view('mailbox/mail_to_create_lead',$data);
    $this->load->view('lead/add_lead_page',$data);

  }
  // To compose mail
  public function compose_mail($info_email)
  {
    $data['compose_mail_from_lead_or_mail'] = '0';
    $data['lead_email'] = '';
    $data['mail_compose_from'] = '2';
    // $data['info_email'] = $this->input->post('info_email');
    $data['info_email'] = $info_email;
    $email_details = $this->Mailbox_model->email_by_id($data['info_email']);
    // $data['info_email_name'] = $email_details->email_ID; 
    $data['info_email_name'] = $info_email;
    $this->load->view('mailbox/compose_email', $data);   
  }

  // To show reply form 
  public function reply_mail()
  {
    $data['mail_reply_from'] = $this->input->post('mail_reply_from');
    $data['info_email'] = $this->input->post('info_email');
    $data['msg_to'] = $this->input->post('msg_to');
    $get_emails_lead = common_select_values('*','contact_book','email_id = "'.$data['msg_to'].'"','row');
    if (count($get_emails_lead) > 0) {
      $data['get_all_lead_based_contact_book_id'] = common_select_values('*','leads','contact_book_id = "'.$get_emails_lead->contact_book_id.'"','result_array');
    }
    else {
      $data['get_all_lead_based_contact_book_id'] = array();  
    }
    $data['msg_no'] = $this->input->post('msg_no');
    
    $data['lead_id'] = $this->input->post('lead_id');
    $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
  
    if ($data['mail_reply_from'] == 1) {
      $email_details = $this->Lead_model->email_by_name($data['info_email']);
    }else {
      $email_details = $this->Mailbox_model->email_by_id($data['info_email']);
    }
    $data['info_email_name'] = $email_details->email_ID;
    $data['imap_email_lists'] = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msg_no'], $data['label']);
    $data['signature'] = '<br>'.$email_details->signature.'<br>';
    $this->load->view('mailbox/reply_email', $data);   
  }
  // To show reply form 
  public function reply_to_all_mail()
  {
    $data['mail_reply_from'] = $this->input->post('mail_reply_from');
    $data['info_email'] = $this->input->post('info_email');
    $data['msg_to'] = $this->input->post('msg_to');
    $get_emails_lead = common_select_values('*','contact_book','email_id = "'.$data['msg_to'].'"','row');
    if (count($get_emails_lead) > 0) {
      $data['get_all_lead_based_contact_book_id'] = common_select_values('*','leads','contact_book_id = "'.$get_emails_lead->contact_book_id.'"','result_array');
    }
    else {
      $data['get_all_lead_based_contact_book_id'] = array();  
    }
    $data['msg_no'] = $this->input->post('msg_no');
    
    $data['lead_id'] = $this->input->post('lead_id');
    $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
  
    if ($data['mail_reply_from'] == 1) {
      $email_details = $this->Lead_model->email_by_name($data['info_email']);
    }else {
      $email_details = $this->Mailbox_model->email_by_id($data['info_email']);
    }
    $data['info_email_name'] = $email_details->email_ID;
    $data['imap_email_lists'] = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msg_no'], $data['label']);
    $data['signature'] = '<br>'.$email_details->signature.'<br>';
    $this->load->view('mailbox/reply_to_all_email', $data);   
  }
  // To get forward email
  public function forward_mail()
  {
    $data['mail_reply_from'] = $this->input->post('mail_reply_from');
    $data['info_email'] = $this->input->post('info_email');
    $data['msg_to'] = $this->input->post('msg_to');
    $data['msg_no'] = $this->input->post('msg_no');
    $data['lead_id'] = $this->input->post('lead_id');
    $data['label'] = ($this->input->post('label')) ? $this->input->post('label') : '';
    if ($data['mail_reply_from'] == 1) {
      $email_details = $this->Lead_model->email_by_name($data['info_email']);
    }else {
      $email_details = $this->Mailbox_model->email_by_id($data['info_email']);
    }
    $data['info_email_name'] = $email_details->email_ID;
    $data['imap_email_lists'] = imap_mailbox_view($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $data['msg_no'], $data['label']);
    $data['signature'] = '<br>'.$email_details->signature.'<br>';
    $this->load->view('mailbox/forward_email', $data);   

  }

  // To reply email
  public function send_reply_forward_mail()
  {
      $data = $_POST;
      $data['attachs'] = $_FILES;
      $attach_file = '';
      if(!empty($_FILES['attach_email']['name']))
      {
        if (!is_dir('assets/attachment_files/')) 
        {
          mkdir('./assets/attachment_files/', 0777, TRUE);
        }
  
        $ext = pathinfo($_FILES['attach_email']['name'], PATHINFO_EXTENSION);
        $config['upload_path'] = 'assets/attachment_files/';
        $config['allowed_types'] = 'jpg|jpeg|png|doc|pdf|xlsx|docx';
        $config['file_name'] = $_FILES['attach_email']['name'];
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $attach_file = 'assets/attachment_files/'.$_FILES['attach_email']['name'];

        if($this->upload->do_upload('attach_email'))
        {
          $uploadData = $this->upload->data();
        }
      } 
          //$mcRes = $this->Offermail_model->get_general_settings_details();
          //$smtp_pwd = decryptthis($mcRes->smtp_password, 'arjunerp');  

      $host_name = 'eibs.elysiumproduct.com' ;
      $username  =  'eibselysiumprodu';
      $password  =  'Madurai@20';
      $from_email= $this->input->post('from_email');
      $to_email  = $this->input->post('to_email');
      $cc_email  = $this->input->post('cc_email');
      $bcc_email = $this->input->post('bcc_email');
      $subject   = $this->input->post('sub_email');
      $content_email = $this->input->post('content_email');
      $config = Array( 
        'protocol' => 'smtp',
        'smtp_host' => $host_name,
        'smtp_user' => $username, 
        'smtp_pass' => $password,
        'smtp_port' => 465,
        'mailtype'  => 'html', 
        'charset'   => 'utf-8',
        'newline'  => "\r\n",
        'wordwrap' => TRUE,
        );
        $this->load->library('email',$config);
        //   $this->email->initialize($config);
        $this->email->from($from_email);    
        $this->email->to($to_email);
        //$this->email->to($cemail);
        $this->email->subject($subject);
        $this->email->message($content_email);
        $this->email->set_mailtype('html');
        if($attach_file != '')
        {
          $this->email->attach($attach_file);
        }
        if($this->email->send())
        {
            if($attach_file != '' && $this->upload->do_upload('attach_email'))
            {
              //unlink file
               unlink($attach_file);
            }

         $result =1;
        }else{ }
      
   
    
   redirect('mailbox');

  }
  public function inbox_email_list()
  {
    $data['per_page'] = 50;
    $data['start'] = ($this->input->post('start')) ?  $this->input->post('start') : '';
    $data['e_id'] = $this->input->post('e_id');
    $data['search_email_id'] = $this->input->post('s_e_id');
    $data['email_details'] = $this->Mailbox_model->email_by_id($data['e_id']);
    $data['default_email'] = $data['email_details']->email_id;
    
    $this->load->view('inbox/inbox_email_list', $data);
  }
  public function draft_email_list()
  {
    $data['e_id'] = $this->input->post('e_id');
    $data['email_details'] = $this->Mailbox_model->email_by_id($data['e_id']);
    //$data['default_email'] = $data['email_lists'][0]->email_id;
    $this->load->view('inbox/draft_email_list', $data);
  }
  public function sent_email_list()
  {
    $data['per_page'] = 50;
    $data['e_id'] = $this->input->post('e_id');
    $data['search_email_id'] = $this->input->post('s_e_id');
    $data['from_name'] = $this->input->post('from_name');
     $data['start'] = ($this->input->post('start')) ?  $this->input->post('start') : '';
    
    $data['email_details'] = $this->Mailbox_model->email_by_id($data['e_id']);
    //$data['default_email'] = $data['email_lists'][0]->email_id;
    $this->load->view('inbox/sent_email_list', $data);
  }
  public function spam_email_list()
  {
    $data['e_id'] = $this->input->post('e_id');
    $data['email_details'] = $this->Mailbox_model->email_by_id($data['e_id']);
    //$data['default_email'] = $data['email_lists'][0]->email_id;
    $this->load->view('inbox/spam_email_list', $data);
  }
  public function trash_email_list()
  {
    $data['e_id'] = $this->input->post('e_id');
    $data['email_details'] = $this->Mailbox_model->email_by_id($data['e_id']);
   // $data['default_email'] = $data['email_lists'][0]->email_id;
    $this->load->view('inbox/trash_email_list', $data);
  }
  public function email_message_view($msgno, $e_id, $email_label, $search_id)
  {
     $data['email_lists'] = $this->Mailbox_model->email_list();
     if($email_label == 'Inbox' || $email_label == 'INBOX')
     {
        $data['email_label'] = $email_label;
     }else{
         $data['email_label'] = '[Gmail]/'.$email_label;
     }
    
    $data['search_email_id'] = str_replace('_', '@', $search_id);
    $data['from_name'] = '';
    $data['e_id'] = $e_id;
    $data['msgno'] = $msgno;
    $data['email_details'] = $this->Mailbox_model->email_by_id($data['e_id']);
    $this->load->view('inbox/email_message_view', $data);
  }
  
  
  public function download_attach()
  {
      $data['e_id'] = $this->input->post('e_id');
      $data['email_details'] = $this->Mailbox_model->email_by_id($data['e_id']);
      $data['email_label'] = $this->input->post('label');
      $data['msgno'] = $this->input->post('msgno');
      $this->load->view('inbox/download_attachment', $data); 
  }
  
  public function email_address_list($l_id, $email_id)
  {
    
    $data['lead_details'] = $this->Lead_model->get_lead_by_id($l_id);
    $ex_val = explode('_', $l_id);
    $data['lead_id'] = ($ex_val[0] == 'l-id') ?  $ex_val[1] : '';
    $data['pi_id']   = ($ex_val[0] == 'pi-id') ?  $ex_val[1] : '';
    $data['o_id']    = ($ex_val[0] == 'o-id') ?  $ex_val[1] : '';
    
    $data['search_email_id'] = str_replace('_', '@', $email_id); 
    $data['email_lists'] = $this->Mailbox_model->email_list();
    $data['default_email'] = $data['email_lists'][0]->email_id;
    $data['email_details'] = $this->Mailbox_model->email_by_id($data['default_email']);
    $data['per_page'] = 50;
     $data['start'] =  1;
    $this->load->view('inbox/inbox_list', $data);
     
  }
  
  // To compose email
  public function send_compose_mail()
  {
      
     $data = $_POST;
      $data['attachs'] = $_FILES;
      $email_details = $this->Mailbox_model->email_by_id($data['e_id']);
      // To get info email details
      $email_id = $email_details->email_name; 
      $password =  aes128Decrypt('arjunerp',$email_details->password);
      $smtp_name = $email_details->smtp_host;
        /* connect to gmail */
      $hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}[Gmail]/Sent Mail';
        //$hostname = '{crm.geewinmatches.net:465/imap/ssl/novalidate-cert}[crm.geewinmatches.net]/Sent Mail';
        $username = $email_id;
        $password = $password;
        /* try to connect */
        $conn = imap_open($hostname,$username,$password) or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
        
        $attach_file = '';
        if(!empty($_FILES['attach_email']['name']))
        {
          if (!is_dir('assets/attachment_files/')) 
          {
            mkdir('./assets/attachment_files/', 0777, TRUE);
        }
    
            for($i=0; $i<=count($_FILES['attach_email']['name']); $i++)
        {
            
            $_FILES['file']['name'] = $_FILES['attach_email']['name'][$i];
                $_FILES['file']['type'] = $_FILES['attach_email']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['attach_email']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['attach_email']['error'][$i];
                $_FILES['file']['size'] = $_FILES['attach_email']['size'][$i];
                
            $ext = pathinfo($_FILES['attach_email']['name'][$i], PATHINFO_EXTENSION);
            $config['upload_path'] = 'assets/attachment_files/';
            $config['allowed_types'] = 'jpg|jpeg|png|doc|pdf|xlsx|docx';
            $config['file_name'] = $_FILES['attach_email']['name'][$i];
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
              if($this->upload->do_upload('file'))
              {
                $uploadData = $this->upload->data();
                  $filename = $uploadData['file_name'];
                    $data['totalFiles'][] = $filename;
              }
        } 
        } 
        
          $mcRes = $this->Offermail_model->get_general_settings_details();
            $smtp_pwd = $this->aes128Decrypt('arjunerp', $mcRes->smtp_password);   
            $config = Array( 
            'protocol' => 'smtp',
            'smtp_host' => $mcRes->smtp_host_name,
            'smtp_user' => $mcRes->smtp_user_name, 
            'smtp_pass' => $smtp_pwd,
            'smtp_port' => 465,
            'mailtype'  => 'html', 
            'charset'   => 'utf-8',
            'newline'  => "\r\n",
            'wordwrap' => TRUE,
            );
             $this->load->library('email',$config);
            //   $this->email->initialize($config);
            $this->email->from($data['from_email']);    
            //$this->email->from('info@geewinexim.com'); 
            $this->email->to($data['to_email']);
            //$this->email->to($cemail);
            $this->email->subject($data['sub_email']);
            $this->email->message(strip_tags($data['content_email']));
            $this->email->set_mailtype('html');
            if(!empty($data['totalFiles']))
            {
                foreach ($data['totalFiles'] as $k => $v) {
                    $attach_file = 'assets/attachment_files/'.$v;
                    $this->email->attach($attach_file);
                } 
                
            }
             
             if($this->email->send())
              {
                if(!empty($data['totalFiles']))
                {
                  foreach ($data['totalFiles'] as $k => $v) 
                  {
                      $attach_file = 'assets/attachment_files/'.$v;
                      //unlink file
                      unlink($attach_file);
                  }
                }  
                $result =1;
                $this->session->set_flashdata('mail_success', 'Email Sent Successfully...');
              }else{
                $this->session->set_flashdata('mail_err', 'Could not send email!');
              }
      
    //  elseif
    //  {
    //      $envelope = array();
    //         $envelope["date"] = date('r');
    //          $envelope["from"] = $data['from_email'];
    //         //$envelope["from"] = 'info@crm.geewinmatches.net';
    //         $envelope["to"] = $data['to_email'];
    //         $envelope["subject"] = $data['sub_email'];
    //         if (array_key_exists('cc_email', $data)) {
    //             $envelope["cc"] = $data['cc_email'];
    //         }
    //         if (array_key_exists('bcc_email', $data)) {
    //             $envelope["bcc"] = $data['bcc_email'];
    //         }
            
    //          if ($data['content_email']) 
    //           {
    //              $part = array();
    //              $part["type"] = "TEXT";
    //              $part["subtype"] = "html";
    //              $part["description"] = '';
    //              $part["contents.data"] = strip_tags($data['content_email']);
    //              $body[] = $part;
    //           }
               
    //              $from_mail = $data['from_email'];
    //              $to = $data['to_email'];
    //              $sub = $data['sub_email'];
    //              $msg = imap_mail_compose($envelope, $body);
    //              imap_mail ($data['to_email'],$data['sub_email'],$msg);
    //              imap_append($conn, $hostname, "From: ".$from_mail."\r\n"
    //               . "To: ".$to."\r\n"
    //               . "Subject: ".$sub."\r\n"
    //               . "\r\n"
    //               . ".$msg.\r\n");
    //  }
    
      
      // To update followup date for lead id
      $followup_date = $this->input->post('followup_date');
      if($this->input->post('lead_id') != '' && $followup_date != '' )
      {
          $lead_id = $this->input->post('lead_id');
          $followup_date = date('Y-m-d', strtotime($this->input->post('followup_date')));
          $m_on = date('Y-m-d H:i:s');
          $m_by = $_SESSION['user_id'];
          $update_lead_id = $this->Mailbox_model->lead_followup_date_update($lead_id, $m_on, $m_by, $followup_date);
      }
        
        // To update followup date for lead id
      if($this->input->post('pi_id') != '' && $followup_date != '')
      {
          $pi_id = $this->input->post('pi_id');
          $followup_date = date('Y-m-d', strtotime($this->input->post('followup_date')));
          $m_on = date('Y-m-d H:i:s');
          $m_by = $_SESSION['user_id'];
          $update_pi_id = $this->Mailbox_model->pi_followup_date_update($pi_id, $m_on, $m_by, $followup_date);
      }
      
      // To update followup date for lead id
      if($this->input->post('order_id') != '' && $followup_date != '')
      {
          $o_id = $this->input->post('order_id');
          $followup_date = date('Y-m-d', strtotime($this->input->post('followup_date')));
          $m_on = date('Y-m-d H:i:s');
          $m_by = $_SESSION['user_id'];
          $update_lead_id = $this->Mailbox_model->order_followup_date_update($o_id, $m_on, $m_by, $followup_date);
      }

      // To list email details
    $data['email_lists'] = $this->Mailbox_model->email_list();
    
   $data['default_email'] = $data['e_id'];
    $data['email_details'] = $this->Mailbox_model->email_by_id($data['default_email']);
    $data['per_page'] = 50;
    
    $data['search_email_id'] = '';
    $data['start'] =1;
    imap_close($conn);
    $this->load->view('inbox/inbox_list', $data);
    //redirect('/inbox');

  }
  function aes128Decrypt($key, $data) {
$data = base64_decode($data);
if(16 !== strlen($key)) $key = hash('MD5', $key, true);
$data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
$padding = ord($data[strlen($data) - 1]); 
return substr($data, 0, -$padding); 
}

  
  
  
  
  
  // To compose email
  public function send_forward_mail()
  {
      $data = $_POST;
      $data['attachs'] = $_FILES;
      $email_details = $this->Mailbox_model->email_by_id($data['e_id']);
      // To get info email details
      $email_id = $email_details->email_name; 
      $password =  aes128Decrypt('arjunerp',$email_details->password);
      $smtp_name = $email_details->smtp_host;
      $email_label = $data['email_label'];
        /* connect to gmail */
      $hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}'.str_replace('_', ' ',$email_label);
      //$hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}';
        //$hostname = '{crm.geewinmatches.net:465/imap/ssl/novalidate-cert}[crm.geewinmatches.net]/Sent Mail';
        $username = $email_id;
        $password = $password;
        /* try to connect */
        $conn = imap_open($hostname,$username,$password) or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
        
    // To check email has attachment
    $msgno = $this->input->post('msgno');
    $structure = imap_fetchstructure($conn, $msgno);
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
                    $attachments[$i]['attachment'] = imap_fetchbody($conn, $msgno, $i+1);
 
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
        
        if(!empty($attachments))
        {
            foreach($attachments as $attachment)
             {
                if($attachment['is_attachment'] == 1)
                {
                    $filename = $attachment['name'];
                    if(empty($filename)) $filename = $attachment['filename'];
     
                    if(empty($filename)) $filename = time() . ".dat";
     
                    /* prefix the email number to the filename in case two emails
                     * have the attachment with the same file name.
                     */
                    $fp = fopen($_SERVER['DOCUMENT_ROOT']."/demo/assets/attachment_files/" . $filename, "w+");
                    fwrite($fp, $attachment['attachment']);
                    $data['totalFiles'][] = $filename;
                    fclose($fp);
                    
                }
 
            }
        }
        
        $attach_file = '';
        if(!empty($_FILES['attach_email']['name']))
        {
          if (!is_dir('assets/attachment_files/')) 
          {
            mkdir('./assets/attachment_files/', 0777, TRUE);
        }
        
        for($i=0; $i<=count($_FILES['attach_email']['name']); $i++)
        {
            
            $_FILES['file']['name'] = $_FILES['attach_email']['name'][$i];
                $_FILES['file']['type'] = $_FILES['attach_email']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['attach_email']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['attach_email']['error'][$i];
                $_FILES['file']['size'] = $_FILES['attach_email']['size'][$i];
          
          $ext = pathinfo($_FILES['attach_email']['name'][$i], PATHINFO_EXTENSION);
            $config['upload_path'] = 'assets/attachment_files/';
            $config['allowed_types'] = 'jpg|jpeg|png|doc|pdf|xlsx|docx';
            $config['file_name'] = $_FILES['attach_email']['name'][$i];
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
              if($this->upload->do_upload('file'))
              {
                $uploadData = $this->upload->data();
                  $filename = $uploadData['file_name'];
                    $data['totalFiles'][] = $filename;
              }
            
        }
        } 
        
          $mcRes = $this->Offermail_model->get_general_settings_details();
            $smtp_pwd = $this->aes128Decrypt('arjunerp', $mcRes->smtp_password);   
            $config = Array( 
            'protocol' => 'smtp',
            'smtp_host' => $mcRes->smtp_host_name,
            'smtp_user' => $mcRes->smtp_user_name, 
            'smtp_pass' => $smtp_pwd,
            'smtp_port' => 465,
            'mailtype'  => 'html', 
            'charset'   => 'utf-8',
            'newline'  => "\r\n",
            'wordwrap' => TRUE,
            );
            
            $this->load->library('email',$config);
            //   $this->email->initialize($config);
            $this->email->from($data['from_email']);    
            //$this->email->from('info@geewinexim.com'); 
            $this->email->to($data['to_email']);
            //$this->email->to($cemail);
            $this->email->subject($data['sub_email']);
            $this->email->message(strip_tags($data['content_email']));
            $this->email->set_mailtype('html');
            
            // echo '<pre>';
            // print_r($data['totalFiles']); 
                if(!empty($data['totalFiles'])){
                    foreach ($data['totalFiles'] as $k => $v) {
                        $attach_file = 'assets/attachment_files/'.$v;
                        $this->email->attach($attach_file);
                    } 
                    
                    
                } 
            //     echo '<pre>';
            // print_r($this->email); 
                
            //     die;
              if($this->email->send())
              {
                  
                 //unlink file
                //  if(!empty($data['totalFiles'])){
                //   foreach ($data['totalFiles'] as $k => $v) {
                //         $attach_file = 'assets/attachment_files/'.$v;
                //         unlink($attach_file);
                //     }       
                //  }
                  $this->session->set_flashdata('mail_success', 'Email Sent Successfully...');
                  
                $result =1;
                
              }else{
                  $this->session->set_flashdata('mail_err', 'Could not send email!');
              }
    
      
     // To list email details
    $data['email_lists'] = $this->Mailbox_model->email_list();
    
    $data['default_email'] = $data['e_id'];
    $data['email_details'] = $this->Mailbox_model->email_by_id($data['default_email']);
    $data['per_page'] = 50;
    
    $data['search_email_id'] = '';
    $data['start'] =1;
    imap_close($conn);
    $this->load->view('inbox/inbox_list', $data);
    //redirect('/inbox'); 

  }
  public function get_all_configured_emails_into_database(){

    $email_details = $this->Setting_model->email_list();
    foreach ($email_details as $email_detail) {
      if ($email_detail->status == 0){
        if($email_detail->email_ID != '' && $email_detail->password != '')
        {
          $get_w_sub_start = date('H:i:s');
          $imap_host  = $email_detail->smtp_host.':993'; // IMAP host address
          $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
          $imap_user  = $email_detail->email_ID; // IMAP username
          $imap_pass  = decryptthis($email_detail->password, 'Rajexim2020'); // IMAP password
          
          $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
          $results = imap_subject_group_mail_list_store_db($inbox);
          echo "<pre>";
          print_r($results);
          die();
          $mail_subject_array = array();
          $all_mail_subjects_array = array();
          $all_mail_messages_array = array();

          foreach ($results as $key => $result) {
            $results[$key]->subject = str_replace("'", "`", $result->subject); 
            $chk_email_subject_already_exist = $this->Mailbox_model->chk_email_subject_already_exist($email_detail->email_ID,$result->uid,$result->msgno);
            if (COUNT($chk_email_subject_already_exist) == 0) {
              $mail_subject_array = (array) $result;

              $count_of_subject_array = count($mail_subject_array);
              if ($count_of_subject_array == 15) {
                $inserted = array('', '');
                array_splice( $mail_subject_array, 5, 0, $inserted );
              }
              $comp_mail_info = array($email_detail->email_detail_id,$email_detail->email_ID);
              array_splice( $mail_subject_array, 0, 0, $comp_mail_info);
              array_push($mail_subject_array, "1");
              $all_mail_subjects_array[] = "("."'" . implode ( "', '", $mail_subject_array ) . "'".")";

              // $comp_email_id = $email_detail->email_detail_id;
              // $comp_email = $email_detail->email_ID;
              // $list_subject = str_replace("'", "`", $result->subject);
              // $add_mail_subject_to_db = $this->Mailbox_model->add_mail_subject_to_db($comp_email_id,$comp_email,$list_subject,$result->from,$result->to,$result->date,$result->message_id,$result->references,$result->in_reply_to,$result->size,$result->uid,$result->msgno,$result->recent,$result->flagged,$result->answered,$result->deleted,$result->seen,$result->draft,$result->udate);
              // $data['emailid'] = $email_detail->email_detail_id;
              $get_w_msg_start = date('H:i:s');
              $data['msgno'] = $result->msgno;
              $data['label'] = 'INBOX';
              $imap_email_lists = imap_mailbox_view_store_to_db($inbox, $data['msgno']);

              $imap_email_lists['subject'] = str_replace("'", "`", $imap_email_lists['subject']);
              $imap_email_lists['message'] = str_replace("'", '"', $imap_email_lists['message']);
              $msg_from_info = (array)$imap_email_lists['msg_from'][0];
              if (!empty($msg_from_info)) {
                $msg_from_array_string = implode(',', $msg_from_info);                
              }
              else {
                $msg_from_array_string = ''; 
              }
              array_splice( $imap_email_lists, 0, 0, $comp_mail_info );
              array_push($imap_email_lists, $msg_from_array_string, "1");
              unset($imap_email_lists['msg_from']);
              $all_mail_messages_array[] = "("."'" . implode ( "', '", $imap_email_lists ) . "'".")";
              
              $get_w_msg_end = date('H:i:s');
              // timing_log($get_w_msg_start ,$get_w_msg_end,'~~Individual email Message storing');

              
              // $add_mail_messages_to_db = $this->Mailbox_model->add_mail_messages_to_db($comp_email_id,$comp_email,$msg_subject,$imap_email_lists['msg_date'],$msg_from_array_string,$imap_email_lists['msg_from'][0]->personal,$imap_email_lists['msg_from'][0]->mailbox,$imap_email_lists['msg_from'][0]->host,$message,$imap_email_lists['msgno']);
              
            }
          }
          imap_close($inbox);
          $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
          $implode_all_mail_messages = implode(',', $all_mail_messages_array);
           // echo "<pre>";
           // print_r($all_mail_subjects_array); 
           // print_r($all_mail_messages_array);
           // echo "<br>";
           // echo $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);

           // echo "<br>";
           // echo "INSERT INTO `email_list_info`(`company_email_id`, `company_email`, `subject`, `from`, `to`, `date`, `message_id`, `references`, `in_reply_to`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`) VALUES ".$implode_all_mail_subjects."";
            $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
            $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
           $get_w_sub_end = date('H:i:s');
           timing_log($get_w_sub_start,$get_w_sub_end,'~~All email subject and messages storing');
        }
      }
    }
  }
  public function get_all_configured_emails_sentitems_into_database(){

    $email_details = $this->Setting_model->email_list();
    foreach ($email_details as $email_detail) {
      if ($email_detail->status == 0){
        if($email_detail->email_ID != '' && $email_detail->password != '')
        {
          $get_w_sub_start = date('H:i:s');
          $imap_host  = $email_detail->smtp_host.':993'; // IMAP host address
          $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
          $imap_user  = $email_detail->email_ID; // IMAP username
          $imap_pass  = decryptthis($email_detail->password, 'Rajexim2020'); // IMAP password
          
          $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Sent Mail", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
          $results = imap_subject_group_mail_list_store_db($inbox);
          
          $mail_subject_array = array();
          $all_mail_subjects_array = array();
          $all_mail_messages_array = array();

          foreach ($results as $key => $result) {
            $results[$key]->subject = str_replace("'", "`", $result->subject); 
            $chk_email_subject_already_exist = $this->Mailbox_model->chk_email_subject_already_exist($email_detail->email_ID,$result->uid,$result->msgno);
            if (COUNT($chk_email_subject_already_exist) == 0) {
              $mail_subject_array = (array) $result;

              $count_of_subject_array = count($mail_subject_array);
              if ($count_of_subject_array == 15) {
                $inserted = array('', '');
                array_splice( $mail_subject_array, 5, 0, $inserted );
              }
              $comp_mail_info = array($email_detail->email_detail_id,$email_detail->email_ID);
              array_splice( $mail_subject_array, 0, 0, $comp_mail_info);
              array_push($mail_subject_array, "2");
              $all_mail_subjects_array[] = "("."'" . implode ( "', '", $mail_subject_array ) . "'".")";

              // $comp_email_id = $email_detail->email_detail_id;
              // $comp_email = $email_detail->email_ID;
              // $list_subject = str_replace("'", "`", $result->subject);
              // $add_mail_subject_to_db = $this->Mailbox_model->add_mail_subject_to_db($comp_email_id,$comp_email,$list_subject,$result->from,$result->to,$result->date,$result->message_id,$result->references,$result->in_reply_to,$result->size,$result->uid,$result->msgno,$result->recent,$result->flagged,$result->answered,$result->deleted,$result->seen,$result->draft,$result->udate);
              // $data['emailid'] = $email_detail->email_detail_id;
              $get_w_msg_start = date('H:i:s');
              $data['msgno'] = $result->msgno;
              $data['label'] = 'INBOX';
              $imap_email_lists = imap_mailbox_view_store_to_db($inbox, $data['msgno']);

              $imap_email_lists['subject'] = str_replace("'", "`", $imap_email_lists['subject']);
              $imap_email_lists['message'] = str_replace("'", '"', $imap_email_lists['message']);
              $msg_from_info = (array)$imap_email_lists['msg_from'][0];
              if (!empty($msg_from_info)) {
                $msg_from_array_string = implode(',', $msg_from_info);                
              }
              else {
                $msg_from_array_string = ''; 
              }
              array_splice( $imap_email_lists, 0, 0, $comp_mail_info );
              array_push($imap_email_lists, $msg_from_array_string, "2");
              unset($imap_email_lists['msg_from']);
              $all_mail_messages_array[] = "("."'" . implode ( "', '", $imap_email_lists ) . "'".")";
              
              $get_w_msg_end = date('H:i:s');
              // timing_log($get_w_msg_start ,$get_w_msg_end,'~~Individual email Message storing');

              
              // $add_mail_messages_to_db = $this->Mailbox_model->add_mail_messages_to_db($comp_email_id,$comp_email,$msg_subject,$imap_email_lists['msg_date'],$msg_from_array_string,$imap_email_lists['msg_from'][0]->personal,$imap_email_lists['msg_from'][0]->mailbox,$imap_email_lists['msg_from'][0]->host,$message,$imap_email_lists['msgno']);
              
            }
          }
          imap_close($inbox);
          $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
          $implode_all_mail_messages = implode(',', $all_mail_messages_array);
           // echo "<pre>";
           // print_r($all_mail_subjects_array); 
           // print_r($all_mail_messages_array);
           // echo "<br>";
           // echo $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);

           // echo "<br>";
           // echo "INSERT INTO `email_list_info`(`company_email_id`, `company_email`, `subject`, `from`, `to`, `date`, `message_id`, `references`, `in_reply_to`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`) VALUES ".$implode_all_mail_subjects."";
            $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
            $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
           $get_w_sub_end = date('H:i:s');
           timing_log($get_w_sub_start,$get_w_sub_end,'~~All email subject and messages storing');
        }
      }
    }
  }



  public function get_all_configured_emails_drafts_into_database(){

    $email_details = $this->Setting_model->email_list();
    foreach ($email_details as $email_detail) {
      if ($email_detail->status == 0){
        if($email_detail->email_ID != '' && $email_detail->password != '')
        {
          $get_w_sub_start = date('H:i:s');
          $imap_host  = $email_detail->smtp_host.':993'; // IMAP host address
          $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
          $imap_user  = $email_detail->email_ID; // IMAP username
          $imap_pass  = decryptthis($email_detail->password, 'Rajexim2020'); // IMAP password
          
          $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Drafts", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
          $results = imap_subject_group_mail_list_store_db($inbox);
          

          $mail_subject_array = array();
          $all_mail_subjects_array = array();
          $all_mail_messages_array = array();

          foreach ($results as $key => $result) {
            $results[$key]->subject = str_replace("'", "`", $result->subject); 
            $chk_email_subject_already_exist = $this->Mailbox_model->chk_email_subject_already_exist($email_detail->email_ID,$result->uid,$result->msgno);
            if (COUNT($chk_email_subject_already_exist) == 0) {
              $mail_subject_array = (array) $result;

              $res = array_slice($mail_subject_array, 0, 3, true) +
              array("company_email_id" => $email_detail->email_detail_id,"company_email" => $email_detail->email_ID,"email_type" => "3") +
              array_slice($mail_subject_array, 3, count($mail_subject_array)-3, true);
              // echo "<pre>";
              // print_r($res);
              // die();
              $this->db->insert('email_list_info',$res);
              // if ($count_of_subject_array == 14) {
              //   $empty_inserted = array('Empty_to');
              //   array_splice( $mail_subject_array, 1, 0, $empty_inserted );
              //   $double_inserted = array('', '');
              //   array_splice( $mail_subject_array, 5, 0, $double_inserted );
              // }
              // $count_of_subject_array = count($mail_subject_array);
              // if ($count_of_subject_array == 15) {
              //   $inserted = array('', '');
              //   array_splice( $mail_subject_array, 5, 0, $inserted );
              // }
              
              $comp_mail_info = array($email_detail->email_detail_id,$email_detail->email_ID);
              // array_splice( $mail_subject_array, 0, 0, $comp_mail_info);
              // array_push($mail_subject_array, "3");
              // $all_mail_subjects_array[] = "("."'" . implode ( "', '", $mail_subject_array ) . "'".")";

              // $comp_email_id = $email_detail->email_detail_id;
              // $comp_email = $email_detail->email_ID;
              // $list_subject = str_replace("'", "`", $result->subject);
              // $add_mail_subject_to_db = $this->Mailbox_model->add_mail_subject_to_db($comp_email_id,$comp_email,$list_subject,$result->from,$result->to,$result->date,$result->message_id,$result->references,$result->in_reply_to,$result->size,$result->uid,$result->msgno,$result->recent,$result->flagged,$result->answered,$result->deleted,$result->seen,$result->draft,$result->udate);
              // $data['emailid'] = $email_detail->email_detail_id;
              $get_w_msg_start = date('H:i:s');
              $data['msgno'] = $result->msgno;
              $data['label'] = 'INBOX';
              $imap_email_lists = imap_mailbox_view_store_to_db($inbox, $data['msgno']);

              $imap_email_lists['subject'] = str_replace("'", "`", $imap_email_lists['subject']);
              $imap_email_lists['message'] = str_replace("'", '"', $imap_email_lists['message']);
              $msg_from_info = (array)$imap_email_lists['msg_from'][0];
              if (!empty($msg_from_info)) {
                $msg_from_array_string = implode(',', $msg_from_info);                
              }
              else {
                $msg_from_array_string = ''; 
              }
              array_splice( $imap_email_lists, 0, 0, $comp_mail_info );
              array_push($imap_email_lists, $msg_from_array_string, "3");
              unset($imap_email_lists['msg_from']);
              $all_mail_messages_array[] = "("."'" . implode ( "', '", $imap_email_lists ) . "'".")";
              
              $get_w_msg_end = date('H:i:s');
              // timing_log($get_w_msg_start ,$get_w_msg_end,'~~Individual email Message storing');

              
              // $add_mail_messages_to_db = $this->Mailbox_model->add_mail_messages_to_db($comp_email_id,$comp_email,$msg_subject,$imap_email_lists['msg_date'],$msg_from_array_string,$imap_email_lists['msg_from'][0]->personal,$imap_email_lists['msg_from'][0]->mailbox,$imap_email_lists['msg_from'][0]->host,$message,$imap_email_lists['msgno']);
              
            }
          }
          // echo "<pre>";
          // print_r($all_mail_subjects_array);
          // die();
          imap_close($inbox);
          // $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
          $implode_all_mail_messages = implode(',', $all_mail_messages_array);
           // echo "<pre>";
           // print_r($all_mail_subjects_array); 
           // print_r($all_mail_messages_array);
           // echo "<br>";
           // echo $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);

           // echo "<br>";
           // echo "INSERT INTO `email_list_info`(`company_email_id`, `company_email`, `subject`, `from`, `to`, `date`, `message_id`, `references`, `in_reply_to`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`) VALUES ".$implode_all_mail_subjects."";
            // $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
            $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
           $get_w_sub_end = date('H:i:s');
           timing_log($get_w_sub_start,$get_w_sub_end,'~~All email subject and messages storing');
        }
      }
    }
  }

  public function get_all_configured_emails_and_configured_emails_into_database(){

    $email_details = $this->Setting_model->email_list();
    foreach ($email_details as $email_detail) {
      if ($email_detail->status == 0){
        if($email_detail->email_ID != '' && $email_detail->password != '')
        {
    
          $imap_host  = $email_detail->smtp_host.':993'; // IMAP host address
          $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
          $imap_user  = $email_detail->email_ID; // IMAP username
          $imap_pass  = decryptthis($email_detail->password, 'Rajexim2020'); // IMAP password
          $ima_time_1s = date('H:i:s');
          $imap_open_start = date('H:i:s');
          
          $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
          $get_allow_import_leads_email_id = $this->Lead_model->get_allow_import_leads_email_id();
          foreach ($get_allow_import_leads_email_id as $lead_email_list) {
            $results = imap_email_list_by_lead_email_id($inbox,$lead_email_list->email_id,$email_detail->email_ID);
            
            $mail_subject_array = array();
            $all_mail_subjects_array = array();
            $all_mail_messages_array = array();

            foreach ($results as $key => $result) {
              $results[$key]->subject = str_replace("'", "`", $result->subject); 
              $chk_email_subject_already_exist = $this->Mailbox_model->chk_email_subject_already_exist($email_detail->email_ID,$result->uid,$result->msgno);
              if (COUNT($chk_email_subject_already_exist) == 0) {
                $mail_subject_array = (array) $result;

                $count_of_subject_array = count($mail_subject_array);
                if ($count_of_subject_array == 15) {
                  $inserted = array('', '');
                  array_splice( $mail_subject_array, 5, 0, $inserted );
                }
                $comp_mail_info = array($email_detail->email_detail_id,$email_detail->email_ID);
                array_splice( $mail_subject_array, 0, 0, $comp_mail_info);
                $all_mail_subjects_array[] = "("."'" . implode ( "', '", $mail_subject_array ) . "'".")";

                // $comp_email_id = $email_detail->email_detail_id;
                // $comp_email = $email_detail->email_ID;
                // $list_subject = str_replace("'", "`", $result->subject);
                // $add_mail_subject_to_db = $this->Mailbox_model->add_mail_subject_to_db($comp_email_id,$comp_email,$list_subject,$result->from,$result->to,$result->date,$result->message_id,$result->references,$result->in_reply_to,$result->size,$result->uid,$result->msgno,$result->recent,$result->flagged,$result->answered,$result->deleted,$result->seen,$result->draft,$result->udate);
                // $data['emailid'] = $email_detail->email_detail_id;
                $data['msgno'] = $result->msgno;
                $data['label'] = 'INBOX';
                $imap_email_lists = imap_mailbox_view($email_detail->email_ID, $email_detail->password, $email_detail->smtp_host, 'Rajexim2020', $data['msgno'], $data['label']);

                $imap_email_lists['subject'] = str_replace("'", "`", $imap_email_lists['subject']);
                $imap_email_lists['message'] = str_replace("'", '"', $imap_email_lists['message']);
                if (!empty($imap_email_lists['msg_from'][0])) {
                  $msg_from_array_string = implode(',', $imap_email_lists['msg_from'][0]);                
                }
                else {
                  $msg_from_array_string = ''; 
                }
                $add_mail_messages_to_db = $this->Mailbox_model->add_mail_messages_to_db($comp_email_id,$comp_email,$msg_subject,$imap_email_lists['msg_date'],$msg_from_array_string,$imap_email_lists['msg_from'][0]->personal,$imap_email_lists['msg_from'][0]->mailbox,$imap_email_lists['msg_from'][0]->host,$message,$imap_email_lists['msgno']);
                
              }
            }  
          }
          
          echo "<pre>";
           print_r($all_mail_subjects_array); 
           echo "<br>";
           echo $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
           echo "<br>";
           echo "INSERT INTO `email_list_info`(`company_email_id`, `company_email`, `subject`, `from`, `to`, `date`, `message_id`, `references`, `in_reply_to`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`) VALUES ".$implode_all_mail_subjects."";
        }
      }
    }
    imap_close($inbox);
  }
  public function count_mail_database()
  {
    $get_all_mail_subject = $this->Mailbox_model->get_all_mail_subject();
    $get_all_mail_msg = $this->Mailbox_model->get_all_mail_msg();
    
    echo "subject_count : ".count($get_all_mail_subject);
    echo "<br>";
    echo "Message_count : ".count($get_all_mail_msg);

  }
  public function truncate_mail_table()
  {
    $trun_mail_subject = $this->Mailbox_model->trun_mail_subject();
    $trun_mail_msg = $this->Mailbox_model->trun_mail_msg();
  }

  public function get_all_configured_emails_to_leads_emails_into_database(){
    
    $email_details = $this->Setting_model->email_list();

    foreach ($email_details as $email_detail) {
      if ($email_detail->status == 0){
        
        if($email_detail->email_ID != '' && $email_detail->password != '')
        {
          $get_allow_import_leads_email_id = $this->Lead_model->get_allow_import_leads_email_id();

          foreach ($get_allow_import_leads_email_id as $import_lead_emails) {
            $get_w_sub_start = date('H:i:s');
            $imap_host  = $email_detail->smtp_host.':993'; // IMAP host address
            $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
            $imap_user  = $email_detail->email_ID; // IMAP username
            $imap_pass  = decryptthis($email_detail->password, 'Rajexim2020'); // IMAP password
            
            
            $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
            // $results = imap_subject_group_mail_list_store_db($inbox);
            // $results = imap_email_list_by_lead_email_id($inbox,'elysiumservice24@gmail.com',$imap_user);
            $results = imap_email_list_by_lead_email_id($inbox,$import_lead_emails->email_id,$imap_user);
            // echo "<pre>";
            // print_r($results);
            // die();
            $mail_subject_array = array();
            $all_mail_subjects_array = array();
            $all_mail_messages_array = array();
            $email_exist_flag = 0;
            for ($i=0; $i < count($results); $i++) { 
              foreach ($results[$i] as $key => $result) {
                // if(array_key_exists("subject",$result))
                // {
                //   continue;
                // }
                // else {
                //   $result->subject = '';
                // }
                $results[$i][$key]->subject = str_replace("'", "`", $result->subject); 
                $chk_email_subject_already_exist = $this->Mailbox_model->chk_email_subject_already_exist($email_detail->email_ID,$result->uid,$result->msgno);
                if (COUNT($chk_email_subject_already_exist) == 0) {
                  $email_exist_flag++;
                  $mail_subject_array = (array) $result;

                  $count_of_subject_array = count($mail_subject_array);
                  if ($count_of_subject_array == 15) {
                    $inserted = array('', '');
                    array_splice( $mail_subject_array, 5, 0, $inserted );
                  }
                  $comp_mail_info = array($email_detail->email_detail_id,$email_detail->email_ID,$import_lead_emails->lead_id);
                  array_splice( $mail_subject_array, 0, 0, $comp_mail_info);
                  array_push($mail_subject_array, "1");
                  $all_mail_subjects_array[] = "("."'" . implode ( "', '", $mail_subject_array ) . "'".")";

                  // $comp_email_id = $email_detail->email_detail_id;
                  // $comp_email = $email_detail->email_ID;
                  // $list_subject = str_replace("'", "`", $result->subject);
                  // $add_mail_subject_to_db = $this->Mailbox_model->add_mail_subject_to_db($comp_email_id,$comp_email,$list_subject,$result->from,$result->to,$result->date,$result->message_id,$result->references,$result->in_reply_to,$result->size,$result->uid,$result->msgno,$result->recent,$result->flagged,$result->answered,$result->deleted,$result->seen,$result->draft,$result->udate);
                  // $data['emailid'] = $email_detail->email_detail_id;
                  $get_w_msg_start = date('H:i:s');
                  $data['msgno'] = $result->msgno;
                  $data['label'] = 'INBOX';
                  $imap_email_lists = imap_mailbox_view_store_to_db($inbox, $data['msgno']);

                  $imap_email_lists['subject'] = str_replace("'", "`", $imap_email_lists['subject']);
                  $imap_email_lists['message'] = str_replace("'", '"', $imap_email_lists['message']);
                  $msg_from_info = (array)$imap_email_lists['msg_from'][0];
                  if (!empty($msg_from_info)) {
                    $msg_from_array_string = implode(',', $msg_from_info);                
                  }
                  else {
                    $msg_from_array_string = ''; 
                  }
                  array_splice( $imap_email_lists, 0, 0, $comp_mail_info );
                  array_push($imap_email_lists, $msg_from_array_string, "1");
                  unset($imap_email_lists['msg_from']);
                  $all_mail_messages_array[] = "("."'" . implode ( "', '", $imap_email_lists ) . "'".")";
                  
                  $get_w_msg_end = date('H:i:s');
                  // timing_log($get_w_msg_start ,$get_w_msg_end,'~~Individual email Message storing');

                  
                  // $add_mail_messages_to_db = $this->Mailbox_model->add_mail_messages_to_db($comp_email_id,$comp_email,$msg_subject,$imap_email_lists['msg_date'],$msg_from_array_string,$imap_email_lists['msg_from'][0]->personal,$imap_email_lists['msg_from'][0]->mailbox,$imap_email_lists['msg_from'][0]->host,$message,$imap_email_lists['msgno']);
                  
                }
              }
            }
            imap_close($inbox);
            $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
            $implode_all_mail_messages = implode(',', $all_mail_messages_array);
             // echo "<pre>";
             // print_r($all_mail_subjects_array); 
             // print_r($all_mail_messages_array);
             // die();
             // echo "<br>";
             // echo $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);

             // echo "<br>";
             // echo "INSERT INTO `email_list_info`(`company_email_id`, `company_email`, `subject`, `from`, `to`, `date`, `message_id`, `references`, `in_reply_to`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`) VALUES ".$implode_all_mail_subjects."";
              if ($email_exist_flag != 0) {
                $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
                $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
                // return 1;
              }
              else {
                // return 0;
              }

              // $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
              // $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
             $get_w_sub_end = date('H:i:s');
             timing_log($get_w_sub_start,$get_w_sub_end,'~~All email subject and messages storing');
          }
        }
      }
    }
    return 1;
  }
  public function get_all_sentbox_configured_emails_to_leads_emails_into_database(){
    
    $email_details = $this->Setting_model->email_list();
    foreach ($email_details as $email_detail) {
      if ($email_detail->status == 0){
        if($email_detail->email_ID != '' && $email_detail->password != '')
        {
          $get_allow_import_leads_email_id = $this->Lead_model->get_allow_import_leads_email_id();
          foreach ($get_allow_import_leads_email_id as $import_lead_emails) {
            $get_w_sub_start = date('H:i:s');
            $imap_host  = $email_detail->smtp_host.':993'; // IMAP host address
            $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
            $imap_user  = $email_detail->email_ID; // IMAP username
            $imap_pass  = decryptthis($email_detail->password, 'Rajexim2020'); // IMAP password
            
            $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Sent Mail", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
            // $results = imap_subject_group_mail_list_store_db($inbox);
            $results = imap_email_sendbox_list_by_lead_email_id($inbox,$import_lead_emails->email_id,$imap_user);
            // echo "<pre>";
            // print_r($results);
            $mail_subject_array = array();
            $all_mail_subjects_array = array();
            $all_mail_messages_array = array();
            $email_exist_flag = 0;
            for ($i=0; $i < count($results); $i++) { 
              foreach ($results[$i] as $key => $result) {
                
                $results[$i][$key]->subject = str_replace("'", "`", $result->subject); 
                $chk_email_subject_already_exist = $this->Mailbox_model->chk_email_subject_already_exist($email_detail->email_ID,$result->uid,$result->msgno);
                if (COUNT($chk_email_subject_already_exist) == 0) {
                  $email_exist_flag++;
                  $mail_subject_array = (array) $result;

                  $count_of_subject_array = count($mail_subject_array);
                  if ($count_of_subject_array == 15) {
                    $inserted = array('', '');
                    array_splice( $mail_subject_array, 5, 0, $inserted );
                  }
                  $comp_mail_info = array($email_detail->email_detail_id,$email_detail->email_ID,$import_lead_emails->lead_id);
                  array_splice( $mail_subject_array, 0, 0, $comp_mail_info);
                  array_push($mail_subject_array, "2");
                  $all_mail_subjects_array[] = "("."'" . implode ( "', '", $mail_subject_array ) . "'".")";

                  // $comp_email_id = $email_detail->email_detail_id;
                  // $comp_email = $email_detail->email_ID;
                  // $list_subject = str_replace("'", "`", $result->subject);
                  // $add_mail_subject_to_db = $this->Mailbox_model->add_mail_subject_to_db($comp_email_id,$comp_email,$list_subject,$result->from,$result->to,$result->date,$result->message_id,$result->references,$result->in_reply_to,$result->size,$result->uid,$result->msgno,$result->recent,$result->flagged,$result->answered,$result->deleted,$result->seen,$result->draft,$result->udate);
                  // $data['emailid'] = $email_detail->email_detail_id;
                  $get_w_msg_start = date('H:i:s');
                  $data['msgno'] = $result->msgno;
                  $data['label'] = 'INBOX';
                  $imap_email_lists = imap_mailbox_view_store_to_db($inbox, $data['msgno']);

                  $imap_email_lists['subject'] = str_replace("'", "`", $imap_email_lists['subject']);
                  $imap_email_lists['message'] = str_replace("'", '"', $imap_email_lists['message']);
                  $msg_from_info = (array)$imap_email_lists['msg_from'][0];
                  if (!empty($msg_from_info)) {
                    $msg_from_array_string = implode(',', $msg_from_info);                
                  }
                  else {
                    $msg_from_array_string = ''; 
                  }
                  array_splice( $imap_email_lists, 0, 0, $comp_mail_info );
                  array_push($imap_email_lists, $msg_from_array_string, "2");
                  unset($imap_email_lists['msg_from']);
                  $all_mail_messages_array[] = "("."'" . implode ( "', '", $imap_email_lists ) . "'".")";
                  
                  $get_w_msg_end = date('H:i:s');
                  // timing_log($get_w_msg_start ,$get_w_msg_end,'~~Individual email Message storing');

                  
                  // $add_mail_messages_to_db = $this->Mailbox_model->add_mail_messages_to_db($comp_email_id,$comp_email,$msg_subject,$imap_email_lists['msg_date'],$msg_from_array_string,$imap_email_lists['msg_from'][0]->personal,$imap_email_lists['msg_from'][0]->mailbox,$imap_email_lists['msg_from'][0]->host,$message,$imap_email_lists['msgno']);
                  
                }
              }
            }
            imap_close($inbox);
            // echo "<pre>";
            // print_r($all_mail_subjects_array);
            // die();
            $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
            $implode_all_mail_messages = implode(',', $all_mail_messages_array);
             // echo "<pre>";
             // print_r($all_mail_subjects_array); 
             // print_r($all_mail_messages_array);
             // die();
             // echo "<br>";
             // echo $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);

             // echo "<br>";
             // echo "INSERT INTO `email_list_info`(`company_email_id`, `company_email`, `subject`, `from`, `to`, `date`, `message_id`, `references`, `in_reply_to`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`) VALUES ".$implode_all_mail_subjects."";
            if ($email_exist_flag != 0) {
              $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
              $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
              // return 1;
            }
            else {
              // return 0;
            }
              
             $get_w_sub_end = date('H:i:s');
             timing_log($get_w_sub_start,$get_w_sub_end,'~~All email subject and messages storing');
          }
        }
      }
    }
    return 1;
  }

  // This is a Cron Job
  public function run_mails_import_function()
  {
    $inbox_mails = $this->get_all_configured_emails_to_leads_emails_into_database();
    $sentbox_mails = $this->get_all_sentbox_configured_emails_to_leads_emails_into_database();
    if (($inbox_mails == 1 || $sentbox_mails == 1) || ($inbox_mails == 0 || $sentbox_mails == 0)) {
      echo "1";
    }
    else {
      echo "0";
    }
  }
  public function send_reply_mail_via_ajax()
  {  
      $data = $_POST;
      $data['attachs'] = $_FILES;
      $email_details = $this->Lead_model->email_by_name($data['from_email']);
      
    //   echo "<pre>";
    // print_r($email_details);
    // die();
      $raw_removed_files_name = $data['removed_attachment_name'];

      if ($raw_removed_files_name != '') {
        $removed_files_name = explode(',', $raw_removed_files_name);
      }
      else {
        $removed_files_name = array(); 
      }
      // To get info email details
      $email_id = $email_details->email_ID; 
      $password =  decryptthis($email_details->password, 'Rajexim2020');
      $email_id_name = $email_details->from_name;
      $cc_mail_ids = $email_details->cc;
      $bcc_mail_ids = $email_details->bcc;
      $get_cc_email_name = $this->Setting_model->get_email_names_by_findinset($cc_mail_ids);
      $get_bcc_email_name = $this->Setting_model->get_email_names_by_findinset($bcc_mail_ids);      
        $attach_file = '';
        $attachment_files_path = array();
        // if(!empty($_FILES['attach_email']['name']))
        // {
        //   if (!is_dir('assets/attachment_files/')) 
        //   {
        //     mkdir('./assets/attachment_files/', 0777, TRUE);
        //   }
    
        //   for ($i=0; $i < count($_FILES['attach_email']['name']); $i++) {
        //     if (!in_array($_FILES['attach_email']['name'][$i], $removed_files_name)) {
        //       $_FILES['email_attach']['name'] = $_FILES['attach_email']['name'][$i];
        //       $_FILES['email_attach']['type'] = $_FILES['attach_email']['type'][$i];
        //       $_FILES['email_attach']['tmp_name'] = $_FILES['attach_email']['tmp_name'][$i];
        //       $_FILES['email_attach']['error'] = $_FILES['attach_email']['error'][$i];
        //       $_FILES['email_attach']['size'] = $_FILES['attach_email']['size'][$i];

        //       $ext = pathinfo($_FILES['email_attach']['name'], PATHINFO_EXTENSION);
        //       if (strpos($_FILES['email_attach']['name'], ' ') !== false) {
                 
        //         $_FILES['email_attach']['name'] =  str_replace(' ', '_', $_FILES['email_attach']['name']);
        //       }
        //       $config['upload_path'] = 'assets/attachment_files/';
        //       // $config['allowed_types'] = 'hqx|cpt|csv|bin|dms|lha|lzh|class|psd|so|sea|dll|oda|ai|eps|ps|smi|smil|mif|xls|ppt|pptx|wbxml|wmlc|dcr|dir|dxr|dvi|gtar|gz|gzip|php|phtml|phps|js|swf|sit|tar|tgz|z|xhtml|xht|zip|rar|bmp|gif|jpe|jp2|jpf|jpg2|jpx|jpm|mj2|mjp2|tiff|tif|css|html|htm|shtml|txt|text|log|rtx|rtf|xml|xsl|dot|word|xl|eml|json|pem|ics|ical|zsh|7z|7zip|cdr|wma|jar|svg|vcf|srt|vtt|ico|odc|otc|odf|otf|odg|otg|odi|oti|oth|jpg|jpeg|png|doc|pdf|xlsx|docx|sql|odp|otp|otp|ods|ots|odt|odm|ott';
        //       $config['allowed_types'] = '*';
        //       $config['file_name'] = $_FILES['email_attach']['name'];
        //       $this->load->library('upload',$config);
        //       $this->upload->initialize($config);
        //       $attach_file = 'assets/attachment_files/'.$_FILES['email_attach']['name'];

        //       if($this->upload->do_upload('email_attach')){
        //           chmod("assets/attachment_files/".$_FILES['email_attach']['name'], 0777);
        //           $attachment_files_path[] = "assets/attachment_files/".$_FILES['email_attach']['name'];
        //           // array_push($attachment_files, "assets/attachment_files/".$_FILES['email_attach']['name']);
        //       }
        //     }
        //   }
        // } 
        $abspath = getcwd();
        $filePondArray = $_POST['attach_email'];
        $numFilePondObjects = sizeof($filePondArray);
        if($numFilePondObjects > 0)
        {
          if (!is_dir('assets/attachment_files/')) 
            {
              mkdir('./assets/attachment_files/', 0777, TRUE);
            }
          $baseFileLocation = '/assets/attachment_files/';
          for ($xx=0; $xx<$numFilePondObjects; $xx++)
          {
            $thisFilePondJSON_object = $filePondArray[$xx];
            $thisFilePondArray = json_decode($thisFilePondJSON_object, true);
            $thisFilePondArray_picData = $thisFilePondArray['data'];
            $thisFilePondArray_numPics = sizeof($thisFilePondArray_picData);
            
            $thisPic_name_temp = $thisFilePondArray['name'];
            $thisPic_encodedData = $thisFilePondArray_picData;
            $thisPic_decodedData = base64_decode($thisPic_encodedData);
            $thisPic_fullPathAndName = $baseFileLocation . $thisPic_name_temp; 
            file_put_contents($abspath.$thisPic_fullPathAndName, $thisPic_decodedData);
            $attachment_files_path[] = "assets/attachment_files/".$thisFilePondArray['name'];
          }
        }
        if ($cc_mail_ids != '') {
          $ccemail = $data['cc_email'].','.$get_cc_email_name->mail_name; 
        } 
        else{
          $ccemail = $data['cc_email'];
        }
        $ccmailarray = explode(',', $ccemail);

        if ($bcc_mail_ids != '') {
          $bccemail = $data['bcc_email'].','.$get_bcc_email_name->mail_name;  
        } 
        else{
          $bccemail = $data['bcc_email'];
        }

        $bccmailarray = explode(',', $bccemail);
        //       $ccemail = $data['cc_email'];
          // $ccmailarray = explode(',', $ccemail);

          // $bccemail = $data['bcc_email'];
          // $bccmailarray = explode(',', $bccemail);
          $content = $data['content_email'];
            $content .= '<br>';
            $content .= '<br>';
            $content .= $email_details->signature;

              $send_email = send_email_common_method($email_id,$password,$data['to_email'],$data['sub_email'],$content,$attachment_files_path,$ccmailarray,$bccmailarray,$email_id_name);  

              if($send_email == 1)
              {
                if (!empty($attachment_files_path)) {
                  for ($i=0; $i < count($attachment_files_path); $i++) { 
                    unlink($attachment_files_path[$i]);  
                  }
                  
                }
                $result =1;
                echo "Sent Successfully";
              }else{
                echo "Fail to Send, Try Again";
              }
  }

  public function send_forward_mail_via_ajax()
  {
      $data = $_POST;
      
      $email_details = $this->Lead_model->email_by_name($data['from_email']);
      $raw_removed_files_name = $data['removed_attachment_name'];

      if ($raw_removed_files_name != '') {
        $removed_files_name = explode(',', $raw_removed_files_name);
      }
      else {
        $removed_files_name = array(); 
      }
      // To get info email details
      $email_id = $email_details->email_ID; 
      $password =  decryptthis($email_details->password, 'Rajexim2020');
      $cc_mail_ids = $email_details->cc;
      $bcc_mail_ids = $email_details->bcc;
      $get_cc_email_name = $this->Setting_model->get_email_names_by_findinset($cc_mail_ids);
      $get_bcc_email_name = $this->Setting_model->get_email_names_by_findinset($bcc_mail_ids);
      $email_id_name = $email_details->from_name;
        $attach_file = '';
        $attachment_files_path = array();
        
        $abspath = getcwd();
        $filePondArray = $_POST['attach_email'];
        $numFilePondObjects = sizeof($filePondArray);
        if($numFilePondObjects > 0)
        {
          if (!is_dir('assets/attachment_files/')) 
            {
              mkdir('./assets/attachment_files/', 0777, TRUE);
            }
            $user_temp_folder = $_SESSION['admindata']['user_id'].date('m').date('d').date('H').date('i').date('s');
            mkdir('./assets/attachment_files/'.$user_temp_folder, 0777, TRUE);
          $baseFileLocation = './assets/attachment_files/'.$user_temp_folder.'/';
          for ($xx=0; $xx<$numFilePondObjects; $xx++)
          {
            $thisFilePondJSON_object = $filePondArray[$xx];
            $thisFilePondArray = json_decode($thisFilePondJSON_object, true);
            $thisFilePondArray_picData = $thisFilePondArray['data'];
            $thisFilePondArray_numPics = sizeof($thisFilePondArray_picData);
            
            $thisPic_name_temp = $thisFilePondArray['name'];
            $thisPic_encodedData = $thisFilePondArray_picData;
            $thisPic_decodedData = base64_decode($thisPic_encodedData);
            $thisPic_fullPathAndName = $baseFileLocation . $thisPic_name_temp; 
            file_put_contents($abspath.$thisPic_fullPathAndName, $thisPic_decodedData);
            $attachment_files_path[] = "assets/attachment_files/".$user_temp_folder.'/'.$thisFilePondArray['name'];
          }
        }
        // print_r($attachment_files_path);
        // die();
      if ($cc_mail_ids != '') {
        $ccemail = $data['cc_email'].','.$get_cc_email_name->mail_name; 
      } 
      else{
        $ccemail = $data['cc_email'];
      }
      if (trim($ccemail) == '') {
        $ccmailarray = array(); 
       }
       else {
        $ccmailarray = explode(',', $ccemail);
       }

      if ($bcc_mail_ids != '') {
        $bccemail = $data['bcc_email'].','.$get_bcc_email_name->mail_name;  
      } 
      else{
        $bccemail = $data['bcc_email'];
      }
      if (trim($bccemail) == '') {
        $bccmailarray = array();  
       }
       else {
        $bccmailarray = explode(',', $bccemail);
       }
        //   $ccemail = $data['cc_email'];
        // $ccmailarray = explode(',', $ccemail);

        // $bccemail = $data['bcc_email'];
        // $bccmailarray = explode(',', $bccemail);
        $content = $data['content_email'];
        $content .= '<br>';
        $content .= '<br>';
        // $content .= $email_details->signature;
        $to_emails = $data['to_email'];
        $tomailarray = explode(',', $to_emails);
        
        // $get_ind_two_mails = explode(',', $to_emails);
        // for ($i=0; $i < count($get_ind_two_mails); $i++) { 
        
          $send_email = send_email_common_method($email_id,$password,$tomailarray,$data['sub_email'],$content,$attachment_files_path,$ccmailarray,$bccmailarray,$email_id_name);    
          if($send_email == 1)
          {
            if (!empty($attachment_files_path)) {
              for ($i=0; $i < count($attachment_files_path); $i++) { 
                unlink($attachment_files_path[$i]);  
              }
              
            }
            rmdir($baseFileLocation);
            $result =1;
            echo "Sent Successfully";
          }
          else
          {
            echo "Fail to Send, Try Again";
          }

        // $smtp_detaiils = smtp_details();
        //   //$mcRes = $this->Offermail_model->get_general_settings_details();
        //     $smtp_pwd = decryptthis($smtp_detaiils->smtp_password, 'Rajexim2020');   
        //     $config = Array( 
        //     'protocol' => 'smtp',
        //     'smtp_host' => $smtp_detaiils->smtp_host_name,
        //     'smtp_user' => $smtp_detaiils->smtp_user_name, 
        //     'smtp_pass' => $smtp_pwd,
        //     'smtp_port' => 465,
        //     'mailtype'  => 'html', 
        //     'charset'   => 'utf-8',
        //     'newline'  => "\r\n",
        //     'wordwrap' => TRUE,
        //     );
            
        //     $this->load->library('email',$config);
        //     $this->email->from($data['from_email']);    
        //     $this->email->to($data['to_email']);
        //     if (!empty($ccmailarray)) {
        //       $this->email->cc($ccmailarray); 
        //     }
        //     if (!empty($bccmailarray)) {
        //       $this->email->bcc($bccmailarray); 
        //     }
        //     $this->email->subject($data['sub_email']);
        //     $this->email->message(strip_tags($content));
        //     $this->email->set_mailtype('html');

        //     if ($_FILES['attach_email']['name'] != "")
        //     {
        //       $this->email->attach($attach_file);
        //     } 
        //     if ($this->email->send())
        //     {
        //       if ($_FILES['attach_email']['name'] != '') 
        //       {
        //         // unlink($attach_file);
        //       }
        //       //$this->session->set_flashdata('mail_success', 'Email Sent Successfully...');
        //       $result =1;
        //       echo "Sent Successfully";
        //     }
        //     else
        //     {
        //       // $this->session->set_flashdata('mail_err', 'Could not send email!');
        //       echo "Fail to Send, Try Again";
        //     }
        
  }
  public function send_reply_all_mail_via_ajax()
  {  
      // echo "yes";
      // print_r($_POST);
      // die();
      $data = $_POST;
      $data['attachs'] = $_FILES;
      $email_details = $this->Lead_model->email_by_name($data['from_email']);
      $raw_removed_files_name = $data['removed_attachment_name'];

      if ($raw_removed_files_name != '') {
        $removed_files_name = explode(',', $raw_removed_files_name);
      }
      else {
        $removed_files_name = array(); 
      }
      // To get info email details
      $email_id = $email_details->email_ID; 
      $password =  decryptthis($email_details->password, 'Rajexim2020');
      $email_id_name = $email_details->from_name;
      $cc_mail_ids = $email_details->cc;
      $bcc_mail_ids = $email_details->bcc;
      $get_cc_email_name = $this->Setting_model->get_email_names_by_findinset($cc_mail_ids);
      $get_bcc_email_name = $this->Setting_model->get_email_names_by_findinset($bcc_mail_ids);      
        $attach_file = '';
        $attachment_files_path = array();
        // if(!empty($_FILES['attach_email']['name']))
        // {
        //   if (!is_dir('assets/attachment_files/')) 
        //   {
        //     mkdir('./assets/attachment_files/', 0777, TRUE);
        //   }
    
        //   for ($i=0; $i < count($_FILES['attach_email']['name']); $i++) {
        //     if (!in_array($_FILES['attach_email']['name'][$i], $removed_files_name)) {
        //       $_FILES['email_attach']['name'] = $_FILES['attach_email']['name'][$i];
        //       $_FILES['email_attach']['type'] = $_FILES['attach_email']['type'][$i];
        //       $_FILES['email_attach']['tmp_name'] = $_FILES['attach_email']['tmp_name'][$i];
        //       $_FILES['email_attach']['error'] = $_FILES['attach_email']['error'][$i];
        //       $_FILES['email_attach']['size'] = $_FILES['attach_email']['size'][$i];

        //       $ext = pathinfo($_FILES['email_attach']['name'], PATHINFO_EXTENSION);
        //       if (strpos($_FILES['email_attach']['name'], ' ') !== false) {
                 
        //         $_FILES['email_attach']['name'] =  str_replace(' ', '_', $_FILES['email_attach']['name']);
        //       }
        //       $config['upload_path'] = 'assets/attachment_files/';
        //       // $config['allowed_types'] = 'hqx|cpt|csv|bin|dms|lha|lzh|class|psd|so|sea|dll|oda|ai|eps|ps|smi|smil|mif|xls|ppt|pptx|wbxml|wmlc|dcr|dir|dxr|dvi|gtar|gz|gzip|php|phtml|phps|js|swf|sit|tar|tgz|z|xhtml|xht|zip|rar|bmp|gif|jpe|jp2|jpf|jpg2|jpx|jpm|mj2|mjp2|tiff|tif|css|html|htm|shtml|txt|text|log|rtx|rtf|xml|xsl|dot|word|xl|eml|json|pem|ics|ical|zsh|7z|7zip|cdr|wma|jar|svg|vcf|srt|vtt|ico|odc|otc|odf|otf|odg|otg|odi|oti|oth|jpg|jpeg|png|doc|pdf|xlsx|docx|sql|odp|otp|otp|ods|ots|odt|odm|ott';
        //       $config['allowed_types'] = '*';
        //       $config['file_name'] = $_FILES['email_attach']['name'];
        //       $this->load->library('upload',$config);
        //       $this->upload->initialize($config);
        //       $attach_file = 'assets/attachment_files/'.$_FILES['email_attach']['name'];

        //       if($this->upload->do_upload('email_attach')){
        //           chmod("assets/attachment_files/".$_FILES['email_attach']['name'], 0777);
        //           $attachment_files_path[] = "assets/attachment_files/".$_FILES['email_attach']['name'];
        //           // array_push($attachment_files, "assets/attachment_files/".$_FILES['email_attach']['name']);
        //       }
        //     }
        //   }
        // } 
        $abspath = getcwd();
        $filePondArray = $_POST['attach_email'];
        $numFilePondObjects = sizeof($filePondArray);
        if($numFilePondObjects > 0)
        {
          if (!is_dir('assets/attachment_files/')) 
            {
              mkdir('./assets/attachment_files/', 0777, TRUE);
            }
          $baseFileLocation = '/assets/attachment_files/';
          for ($xx=0; $xx<$numFilePondObjects; $xx++)
          {
            $thisFilePondJSON_object = $filePondArray[$xx];
            $thisFilePondArray = json_decode($thisFilePondJSON_object, true);
            $thisFilePondArray_picData = $thisFilePondArray['data'];
            $thisFilePondArray_numPics = sizeof($thisFilePondArray_picData);
            
            $thisPic_name_temp = $thisFilePondArray['name'];
            $thisPic_encodedData = $thisFilePondArray_picData;
            $thisPic_decodedData = base64_decode($thisPic_encodedData);
            $thisPic_fullPathAndName = $baseFileLocation . $thisPic_name_temp; 
            file_put_contents($abspath.$thisPic_fullPathAndName, $thisPic_decodedData);
            $attachment_files_path[] = "assets/attachment_files/".$thisFilePondArray['name'];
          }
        }
        if ($cc_mail_ids != '') {
          $ccemail = $data['cc_email'].','.$get_cc_email_name->mail_name; 
        } 
        else{
          $ccemail = $data['cc_email'];
        }
        $ccmailarray = explode(',', $ccemail);

        if ($bcc_mail_ids != '') {
          $bccemail = $data['bcc_email'].','.$get_bcc_email_name->mail_name;  
        } 
        else{
          $bccemail = $data['bcc_email'];
        }

        $bccmailarray = explode(',', $bccemail);
        //       $ccemail = $data['cc_email'];
          // $ccmailarray = explode(',', $ccemail);

          // $bccemail = $data['bcc_email'];
          // $bccmailarray = explode(',', $bccemail);
          $content = $data['content_email'];
            $content .= '<br>';
            $content .= '<br>';
            // $content .= $email_details->signature;
            $tomailarray = explode(',', $data['to_email']);
            // for ($i=0; $i < count($send_multi_to_email); $i++) { 
              $send_email = send_email_common_method($email_id,$password,$tomailarray,$data['sub_email'],$content,$attachment_files_path,$ccmailarray,$bccmailarray,$email_id_name);  
            // }
              

              if($send_email == 1)
              {
                if (!empty($attachment_files_path)) {
                  for ($i=0; $i < count($attachment_files_path); $i++) { 
                    unlink($attachment_files_path[$i]);  
                  }
                  
                }
                $reply_for_lead_id = ($data['reply_lead_id']) ? $data['reply_lead_id'] : '';
                if($reply_for_lead_id != '')
                {
                  $c_by = $_SESSION['admindata']['user_id'];
                  $c_on = date('Y-m-d H:i:s');
                  $qutoe_rmved_message = str_replace("'", "`", $content); 
                  $add_lead_reply_to_db = $this->Lead_model->add_lead_reply_to_db($reply_for_lead_id,$email_id,$data['to_email'],$data['cc_email'],$data['sub_email'],$qutoe_rmved_message,$c_by,$c_on);
                }
                $result =1;
                echo "Sent Successfully";
              }else{
                echo "Fail to Send, Try Again";
              }
  }
  public function draft_forward_mail_via_ajax()
  {
      $data = $_POST;
      $email_details = $this->Lead_model->email_by_name($data['from_email']);

      $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
      $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
      $imap_user  = $email_details->email_ID; // IMAP username
      $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
   
      $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Drafts", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
      // To get info email details
      $email_id = $email_details->email_ID; 
      $password =  decryptthis($email_details->password, 'Rajexim2020');
      $cc_mail_ids = $email_details->cc;
      $bcc_mail_ids = $email_details->bcc;
      $get_cc_email_name = $this->Setting_model->get_email_names_by_findinset($cc_mail_ids);
      $get_bcc_email_name = $this->Setting_model->get_email_names_by_findinset($bcc_mail_ids);
      $email_id_name = $email_details->from_name;
        $attach_file = '';
    
        $content = $data['content_email'];
        $content .= '<br>';
        $content .= '<br>';
        $content .= $email_details->signature;
        $to_emails = $data['to_email'];
        $tomailarray = explode(',', $to_emails);
        
        imap_append($inbox, "{".$imap_host.$imap_flags."}[Gmail]/Drafts"
                   , "From: ".$imap_user."\r\n"
                   . "To: ".$data['to_email']."\r\n"
                   . "Subject: ".$data['sub_email']."\r\n"
                   . "\r\n"
                   . "".$content."\r\n"
                   );
        imap_close($inbox);
        echo "1";
  }
  public function move_to_bin()
  {
    $emailid = $this->input->post('emailid');
    $uid = $this->input->post('uid');
    $email_details = $this->Mailbox_model->email_by_id($emailid);
    
    $imap_host  = $email_details->smtp_host.':993'; // IMAP host address
    $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
    $imap_user  = $email_details->email_ID; // IMAP username
    $imap_pass  = decryptthis($email_details->password, 'Rajexim2020'); // IMAP password
    
    $inbox = @imap_open("{".$imap_host.$imap_flags."}", $imap_user, $imap_pass)or die('<h1 class="text-center">Cannot connect to Gmail..</h1>');
    if(imap_mail_move($inbox, $uid, '[Gmail]/Bin') or die(imap_last_error()))
    {
      echo '1';
    }
    else 
    {
      echo '0';
    }
    imap_close($inbox);

  }

  public function get_list_of_lead_by_contact_bood_id()
  {
    $data['emailid'] = $emailid = $this->input->post('emailid');
    $data['msg_no'] = $msg_no = $this->input->post('msg_no');
    $data['label'] = $label = $this->input->post('label');
    $data['contact_book_id'] = $contact_book_id = $this->input->post('contact_book_id');

    $data['all_lead_info'] = $this->Mailbox_model->get_all_lead_by_contact_id($contact_book_id);

    $this->load->view('mailbox/mail_attachment_import_for_lead',$data);

  }
  public function import_email_attachment_for_lead()
  {
    $msg_no = $this->input->post('msg_no');
    $lead_id = $this->input->post('lead_id');
    $label = $this->input->post('label');
    $email_id = $this->input->post('email_id');
    $contact_book_id = $this->input->post('contact_book_id');

    $email_details = $this->Mailbox_model->email_by_id($email_id);
    $imap_email_attachments = imap_mailbox_attchments($email_details->email_ID, $email_details->password, $email_details->smtp_host, 'Rajexim2020', $msg_no, $label, $lead_id);

    echo "1";

  }

}
?>


