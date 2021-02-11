<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ************************************************************************************
    Purpose : To handle all login functions
    Date    : 03-02-2020 
***************************************************************************************/
class Login extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mailbox_model', 'Lead_model', 'Setting_model', 'Product_model','Login_model'));
    // $this->load->database();
  //   $this->db->hostname('localhost');
  //   $this->db->username('root');
  //   $this->db->password('');
  //   $this->db->database('rajexim_july15_2020');
    date_default_timezone_set("Asia/Kolkata");
  }
  /* ************************************************************************************
            Purpose : To handle admin login function 
          **********************************************************************/
  public function index()
  {
      
      $this->load->view('login');
  }

  public function db_config()
  {
    
    if (isset($_GET['auth_db'])) {
      $url_code = $_GET['auth_db'];
      if ($url_code == "UFltekh3QlFVRHl0d0ZRV25KMTNIZz09") {
        $this->load->view('db_configuration');
      }
      else {
        echo "Access Denied!";
      }
    }
    else {
      echo "Invalid Access...";
    }
      
  }
  public function db_dyno_config()
  {
    $data['err'] = '';
    if(isset($_POST['sub'])){
      $host = $_POST['host'];
      $uname = $_POST['username'];
      $pass = $_POST['pass'];
      $db = $_POST['dbname'];
     
      $conn = new mysqli($host, $uname, $pass);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 
      $sql = "CREATE DATABASE $db";
      if ($conn->query($sql) === TRUE) {
          $data['err'] = "Database created successfully with the name newDB";
      } else {
          $data['err'] = "Error creating database: " . $conn->error;
      }
      
      $conn->close();

      $conn1 = mysqli_connect($host, $uname, $pass, $db);
      
      $query = '';
      $sqlScript = file('assets/source_db/first.sql');
     
      $i=1;

      $total_query = count($sqlScript);
     
      $all_query_succ = 0;
      foreach ($sqlScript as $line) {
       
        $startWith = substr(trim($line), 0 ,2);
        $endWith = substr(trim($line), -1 ,1);
        
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
          continue;
        }
          
        $query = $query . $line;
        if ($endWith == ';') {
          $query = str_replace(';', '', $query);
        
          $flag = mysqli_query($conn1,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
          $query= '';  
        }
        $i++;
      }
     
        if(file_exists('application/config/database.php')){
            $myfile = fopen("application/config/database.php", "w") or die("Unable to open file!");
            $txt = "<?php ";
            fwrite($myfile, $txt);
            $txt = "defined('BASEPATH') or exit('No direct script access allowed');\n";
            fwrite($myfile, $txt);
            $txt = "$";
            fwrite($myfile, $txt);
            $txt = "active_group = 'default';\n";
            fwrite($myfile, $txt);
            $txt = "$";
            fwrite($myfile, $txt);
            $txt = "query_builder = true;\n";
            fwrite($myfile, $txt);
            $txt = "$";
            fwrite($myfile, $txt);
            $txt = "db['default']=array(";
            fwrite($myfile, $txt);
            $txt = "'dsn' => '','hostname' => '".$host."','username' => '".$uname."', 'password' => '".$pass."', 'database' => '".$db."', 'dbdriver' => 'mysqli', 'dbprefix' => '', 'pconnect' => false, 'db_debug' => (ENVIRONMENT !== 'production') , 'cache_on' => false, 'cachedir' => '', 'char_set' => 'utf8', 'dbcollat' => 'utf8_general_ci', 'swap_pre' => '', 'encrypt' => false, 'compress' => false, 'stricton' => false, 'failover' => array() , 'save_queries' => true );";
            fwrite($myfile, $txt);
            fclose($myfile);
        }
        else {
            echo "Database file doesn't exist";
        }
      
      redirect('Login/db_config');
    }
  }
  public function admin_login_check()
  { 
    $username = $this->input->post('name'); 
    $userin   = $this->input->post('password');
    $rememberme = $this->input->post('rememberme');
    $row_res = $this->Login_model->admin_login_details($username);
    $row_count = (!empty($row_res)) ? $row_res : 0;
    if($username == "" && $userin !='' )
    {
      $ip = $_SERVER['REMOTE_ADDR'];
      $txt = "[".date('Y-m-d H:i:s')."] => ".$ip."  -   -  username is empty";
      $mostRecentFilePath = "";
      $mostRecentFileMTime = 0;

      $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("Logs/Login Logs"), RecursiveIteratorIterator::CHILD_FIRST);
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
        $myfile = file_put_contents('Logs/Login Logs/login_log-'.date("Y-m-d").'.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
      else
        $myfile = file_put_contents($mostRecentFilePath, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
      echo 1;
    }
    else if($userin==""&&$username!='')
    {
      $ip = $_SERVER['REMOTE_ADDR'];
      $txt = "[".date('Y-m-d H:i:s')."] => ".$ip."  -  " .$username. "  -  Password is empty";
      $mostRecentFilePath = "";
      $mostRecentFileMTime = 0;

      $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("Logs/Login Logs"), RecursiveIteratorIterator::CHILD_FIRST);
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
        $myfile = file_put_contents('Logs/Login Logs/login_log-'.date("Y-m-d").'.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
      else
        $myfile = file_put_contents($mostRecentFilePath, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
      echo 2;
    }
    else if($username == "" && $userin == "")
    {
      $ip = $_SERVER['REMOTE_ADDR'];
      $txt = "[".date('Y-m-d H:i:s')."] => ".$ip."  -    -  Username & Password is empty";
      $mostRecentFilePath = "";
      $mostRecentFileMTime = 0;

      $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("Logs/Login Logs"), RecursiveIteratorIterator::CHILD_FIRST);
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
        $myfile = file_put_contents('Logs/Login Logs/login_log-'.date("Y-m-d").'.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
      else
        $myfile = file_put_contents($mostRecentFilePath, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
      echo 3;
    }
    
    else if(!empty($row_res) && $row_res->status==1)
    {
      $ip = $_SERVER['REMOTE_ADDR'];
      $txt = "[".date('Y-m-d H:i:s')."] => ".$ip."  -  " .$username. "  -  User Inactive";
      $mostRecentFilePath = "";
      $mostRecentFileMTime = 0;

      $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("Logs/Login Logs"), RecursiveIteratorIterator::CHILD_FIRST);
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
        $myfile = file_put_contents('Logs/Login Logs/login_log-'.date("Y-m-d").'.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
      else
        $myfile = file_put_contents($mostRecentFilePath, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
      echo 5;
    }
    else if(!empty($row_res) && $row_res->status==0)
    {
      
      $logpass = decryptthis($row_res->password,'Rajexim2020');
      $_SESSION['core_user_id'] = $row_res->user_id;
      $_SESSION['core_role_id'] = $row_res->role_id;
      if($userin == $logpass)
      {

        $get_all_product_by_user_id = $this->Login_model->get_all_product_by_user_id($row_res->user_id);
        if (count($get_all_product_by_user_id) > 0) {
          $user_hasnt_product = 0;
        }
        else {
          $user_hasnt_product = 1;
        }
        $mydata = array('username' => $row_res->username , 'user_id' => $row_res->user_id, 'role_id' => $row_res->role_id, 'show_menu' => $row_res->show_menu, 'user_hasnt_product' => $user_hasnt_product);
        $rolep = $this->Login_model->get_role_permission_by_role_id($row_res->role_id);
        foreach($rolep as $rp)
        {
          $rpf = explode('~', $rp['fields']);
          $rpv = explode('~', $rp['value']);
          $crpf = count($rpf);
          for($i=0;$i<$crpf;$i++)
          {
            $this->session->set_userdata($rp['menu_name'].$rpf[$i],$rpv[$i]);
            $mydata[$rp['menu_name'].$rpf[$i]] = $rpv[$i];
          }
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $txt = "[".date('Y-m-d H:i:s')."] => ".$ip."  -  ".$row_res->username."  -  Success";
        $mostRecentFilePath = "";
        $mostRecentFileMTime = 0;

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("Logs/Login Logs"), RecursiveIteratorIterator::CHILD_FIRST);
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
          $myfile = file_put_contents('Logs/Login Logs/login_log-'.date("Y-m-d").'.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        else
          $myfile = file_put_contents($mostRecentFilePath, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        //print_r($mydata);exit;
        $financial_year_to = (date('m') > 3) ? date('Y') +1 : date('Y');
        $financial_year_from = $financial_year_to - 1;
        $finstart = $financial_year_from.'-04-01';
        $finend = $financial_year_to.'-03-31';

        $get_all_users_email = $this->Login_model->get_all_user_own_mail_by_id($row_res->user_id);
        
        $get_logged_user_login_history = $this->Login_model->get_logged_user_login_history($row_res->user_id);
        // print_r($get_logged_user_login_history);
        // die();
        if (empty($get_logged_user_login_history)) {
          $login_time = date('Y-m-d H:i:s');
          $user_ip = getenv("REMOTE_ADDR");
          $store_login_time = $this->Login_model->store_login_time($row_res->user_id,$login_time,$user_ip);
          // echo $store_login_time;
          // die();
          $this->session->set_userdata('login_history_id', $store_login_time);
          $this->session->set_userdata('user_login_time', $login_time);
          $this->session->set_userdata('user_last_active_time', $login_time);
        }
          

        $this->session->set_userdata('finstart', $finstart);
        $this->session->set_userdata('finend', $finend);
        $this->session->set_userdata('admindata',$mydata);
        $this->session->set_userdata('user_own_emails',$get_all_users_email);

        if($rememberme==1)
        {
          set_cookie("username",$username,'31536000');
          set_cookie("password",$userin,'31536000');
          set_cookie("rememberme",'1','31536000');
        }
        else if($rememberme==0)
        {
            delete_cookie("username");
            delete_cookie("password");
            delete_cookie("rememberme");
        }
             echo 6;
      }
     }
  }
  // To logout
  public function logout()
  {
    $login_history_id = $this->session->userdata('login_history_id');
    $get_log_hist_by_id = $this->Login_model->get_log_hist_by_id($login_history_id);

    $login_time = $get_log_hist_by_id->login_time;
    $logout_time = date('Y-m-d H:i:s');
    $datetime1 = strtotime($logout_time);
    $datetime2 = strtotime($get_log_hist_by_id->login_time);

    $secs = $datetime1 - $datetime2;
    $diff_log = gmdate("H:i:s", $secs);
    
    $update_logout_time = $this->Login_model->update_logout_time($login_history_id,$logout_time,$diff_log);
    if ($update_logout_time == 1) {
      $user_data = $this->session->all_userdata();
      foreach ($user_data as $key => $value) {
                $this->session->unset_userdata($key);
        }

      
    }
    redirect(base_url("login"));
  }

  // To show 404 page
  public function show_404_page()
  {
    $this->load->view('404_page');
  }
  public function export_backup_db()
  {
    $link = mysqli_connect('localhost','root','','eibselys_rajexim_crm');
  // mysqli_select_db($name,$link);
  $tables = '*';
  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysqli_query($link,'SHOW TABLES');
    while($row = mysqli_fetch_row($result))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
  $return = '';
  //cycle through
  foreach($tables as $table)
  {
    $result = mysqli_query($link,'SELECT * FROM '.$table);
    $num_fields = mysqli_num_fields($result);
    
    $return.= 'DROP TABLE '.$table.';';
    $row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";
    
    for ($i = 0; $i < $num_fields; $i++) 
    {
      while($row = mysqli_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j < $num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
          // $row[$j] = preg_replace("\n","\\n",$row[$j]);
          $row[$j] = preg_replace("#\n#","\\n",$row[$j]);
          if (isset($row[$j])) { $return.= "'".$row[$j]."'" ; } else { $return.= "''"; }
          if ($j < ($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }
    $return.="\n\n\n";
  }
  
  //save file
  $handle = fopen('assets/db_backup/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
  fwrite($handle,$return);
  fclose($handle);
  echo "1";
  }
  function logout_all_inactive_users()
  {
    $current_time = date('Y-m-d H:i:s');
    $get_all_login_users = $this->Login_model->get_all_login_users();
    $minimum_away_time = 2;
    foreach ($get_all_login_users as $logged_users) {
      $last_active_time = $logged_users->last_active_time;
      $start_date = new DateTime($last_active_time);
      $since_start = $start_date->diff(new DateTime($current_time));
      $differ_mins = $since_start->i;
      if ($minimum_away_time < $differ_mins) {
        $datetime1 = strtotime($current_time);
        $datetime2 = strtotime($logged_users->login_time);
        $secs = $datetime1 - $datetime2;
        $diff_log = gmdate("H:i:s", $secs);
        $update_logout_time = $this->Login_model->update_logout_time($logged_users->login_history_detail_id,$current_time,$diff_log);  
      }
    }
  }
  // This is a Cron job
  public function check_not_confirmed_lead_is_old_and_delete_that_lead_emails()
  {
    $no_of_days = 30;
    $current_date = date('Y-m-d');
    $get_all_fresh_lead = common_select_values('*','leads','status = 0','result');

    foreach ($get_all_fresh_lead as $fresh_lead) {
      if($fresh_lead->import_lead_mails == 0){
        $lead_date = date('Y-m-d',strtotime($fresh_lead->created_on));

        $startTimeStamp = strtotime($lead_date);

        $endTimeStamp = strtotime($current_date);

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = $timeDiff/86400;  // 86400 seconds in one day

        $numberDays = intval($numberDays);

        if ($numberDays > $no_of_days) {
          $lead_id = $fresh_lead->lead_id;
          common_update_values('import_lead_mails = 2','leads','lead_id = "'.$lead_id.'"');
          $delete_email_subjects_of_lead = $this->db->query("DELETE FROM email_list_info WHERE lead_id = '".$lead_id."'");
          $delete_email_message_of_lead = $this->db->query("DELETE FROM email_info_messages WHERE lead_id = '".$lead_id."'");
        }
      }
    }
    echo "1";

  }
  public function get_all_configured_emails_to_leads_emails_into_database(){
    
    $email_details = $this->Setting_model->email_list();
    $all_mail_subjects_array = array();
    $all_mail_messages_array = array();
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
            
            
            $inbox = @imap_open("{".$imap_host.$imap_flags."}INBOX", $imap_user, $imap_pass);
            // $results = imap_subject_group_mail_list_store_db($inbox);
            // $results = imap_email_list_by_lead_email_id($inbox,'elysiumservice24@gmail.com',$imap_user);
            $results = imap_email_list_by_lead_email_id($inbox,$import_lead_emails->email_id,$imap_user);
            // echo "<pre>";
            // print_r($results);
            // die();
            $mail_subject_array = array();
            
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
                  }else if ($count_of_subject_array == 16){
                    $inserted3 = array('');
                    array_splice( $mail_subject_array, 2, 0, $inserted3 );
                  }
                  else if($count_of_subject_array == 14) {
                    $inserted1 = array('');
                    array_splice( $mail_subject_array, 2, 0, $inserted1 );
                    $inserted2 = array('','');
                    array_splice( $mail_subject_array, 5, 0, $inserted2 );
                  }
                  $comp_mail_info = array($email_detail->email_detail_id,$email_detail->email_ID,$import_lead_emails->lead_id);
                  array_splice( $mail_subject_array, 0, 0, $comp_mail_info);
                  array_push($mail_subject_array, "1");
                  $all_mail_subjects_array[] = "("."'" . implode ( "', '", $mail_subject_array ) . "'".")";

                  // print_r($all_mail_subjects_array);
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
                  
                  // print_r($all_mail_messages_array);
                  $get_w_msg_end = date('H:i:s');

                  
                   
                    // if ($email_exist_flag != 0) {
                      if(count($all_mail_subjects_array) == 100){
                        $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
                        $implode_all_mail_messages = implode(',', $all_mail_messages_array);
                        $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
                        $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
                        $all_mail_subjects_array = array();
                        $all_mail_messages_array = array();
                      }
                      // return 1;
                    // }
                    // else {
                    //   // return 0;
                    // }
                  // timing_log($get_w_msg_start ,$get_w_msg_end,'~~Individual email Message storing');

                  
                  // $add_mail_messages_to_db = $this->Mailbox_model->add_mail_messages_to_db($comp_email_id,$comp_email,$msg_subject,$imap_email_lists['msg_date'],$msg_from_array_string,$imap_email_lists['msg_from'][0]->personal,$imap_email_lists['msg_from'][0]->mailbox,$imap_email_lists['msg_from'][0]->host,$message,$imap_email_lists['msgno']);
                  
                }
              }
            }
            imap_close($inbox);
            // $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
            // $implode_all_mail_messages = implode(',', $all_mail_messages_array);
             
            //   if ($email_exist_flag != 0) {
            //     if(count($all_mail_subjects_array) == 100){
            //       $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
            //       $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
            //       $all_mail_subjects_array = array();
            //       $all_mail_messages_array = array();
            //     }
            //     // return 1;
            //   }
            //   else {
            //     // return 0;
            //   }

              // $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
              // $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
             $get_w_sub_end = date('H:i:s');
             timing_log($get_w_sub_start,$get_w_sub_end,'~~All email subject and messages storing');
          }
        }
      }
    }
    if(count($all_mail_subjects_array) > 0 ) {
      $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
      $implode_all_mail_messages = implode(',', $all_mail_messages_array);
       
        // if ($email_exist_flag != 0) {
      // if(count($all_mail_subjects_array) == 100){
        $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
        $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
        $all_mail_subjects_array = array();
        $all_mail_messages_array = array();
      // }
    }
    return 1;
  }
  public function get_all_sentbox_configured_emails_to_leads_emails_into_database(){
    
    $email_details = $this->Setting_model->email_list();
    $all_mail_subjects_array = array();
    $all_mail_messages_array = array();
    foreach ($email_details as $email_detail) {
      if ($email_detail->status == 0){

        if($email_detail->email_ID != '' && $email_detail->password != '')
        {
          $get_allow_import_leads_email_id = $this->Lead_model->get_allow_import_leads_email_id();
          // echo "<pre>";
          // print_r($get_allow_import_leads_email_id);
          // die();
          foreach ($get_allow_import_leads_email_id as $import_lead_emails) {
            $get_w_sub_start = date('H:i:s');
            $imap_host  = $email_detail->smtp_host.':993'; // IMAP host address
            $imap_flags = "/imap/ssl/novalidate-cert"; // IMAP Flags
            $imap_user  = $email_detail->email_ID; // IMAP username
            $imap_pass  = decryptthis($email_detail->password, 'Rajexim2020'); // IMAP password
            
            $inbox = @imap_open("{".$imap_host.$imap_flags."}[Gmail]/Sent Mail", $imap_user, $imap_pass);
            // $results = imap_subject_group_mail_list_store_db($inbox);
            $results = imap_email_sendbox_list_by_lead_email_id($inbox,$import_lead_emails->email_id,$imap_user);
            // echo "<pre>";
            // print_r($results);
            $mail_subject_array = array();
            // $all_mail_subjects_array = array();
            // $all_mail_messages_array = array();
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
                  else if ($count_of_subject_array == 16){
                    $inserted3 = array('');
                    array_splice( $mail_subject_array, 2, 0, $inserted3 );
                  }
                  else if($count_of_subject_array == 14) {
                    $inserted1 = array('');
                    array_splice( $mail_subject_array, 2, 0, $inserted1 );
                    $inserted2 = array('','');
                    array_splice( $mail_subject_array, 5, 0, $inserted2 );
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

                  
                   
                    // if ($email_exist_flag != 0) {
                      if(count($all_mail_subjects_array) == 100){
                        $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
                        $implode_all_mail_messages = implode(',', $all_mail_messages_array);
                        $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
                        $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
                        $all_mail_subjects_array = array();
                        $all_mail_messages_array = array();
                      }
                      // return 1;
                    // }
                    // else {
                    //   // return 0;
                    // }
                  // timing_log($get_w_msg_start ,$get_w_msg_end,'~~Individual email Message storing');

                  
                  // $add_mail_messages_to_db = $this->Mailbox_model->add_mail_messages_to_db($comp_email_id,$comp_email,$msg_subject,$imap_email_lists['msg_date'],$msg_from_array_string,$imap_email_lists['msg_from'][0]->personal,$imap_email_lists['msg_from'][0]->mailbox,$imap_email_lists['msg_from'][0]->host,$message,$imap_email_lists['msgno']);
                  
                }
              }
            }
            imap_close($inbox);
            // echo "<pre>";
            // print_r($all_mail_subjects_array);
            // die();
            // $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
            // $implode_all_mail_messages = implode(',', $all_mail_messages_array);
             // echo "<pre>";
             // print_r($all_mail_subjects_array); 
             // print_r($all_mail_messages_array);
             // die();
             // echo "<br>";
             // echo $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);

             // echo "<br>";
             // echo "INSERT INTO `email_list_info`(`company_email_id`, `company_email`, `subject`, `from`, `to`, `date`, `message_id`, `references`, `in_reply_to`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`) VALUES ".$implode_all_mail_subjects."";
            // if ($email_exist_flag != 0) {
            //   $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
            //   $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
            //   // return 1;
            // }
            // else {
            //   // return 0;
            // }
              
             $get_w_sub_end = date('H:i:s');
             timing_log($get_w_sub_start,$get_w_sub_end,'~~All email subject and messages storing');
          }
        }
      }
    }
    if(count($all_mail_subjects_array) > 0 ) {
      $implode_all_mail_subjects = implode(',', $all_mail_subjects_array);
      $implode_all_mail_messages = implode(',', $all_mail_messages_array);
       
        // if ($email_exist_flag != 0) {
      // if(count($all_mail_subjects_array) == 100){
        $this->Mailbox_model->store_all_subjects($implode_all_mail_subjects);
        $this->Mailbox_model->store_all_messages($implode_all_mail_messages);
        $all_mail_subjects_array = array();
        $all_mail_messages_array = array();
      
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
  // function socket_command()
  // {
  //   $change_dir = $_SERVER['DOCUMENT_ROOT'].'/rajexim';
  //   chdir($change_dir);
  //   exec('php index.php welcome index');
  //   echo "<script>window.close();</script>";
  // }
}
?>