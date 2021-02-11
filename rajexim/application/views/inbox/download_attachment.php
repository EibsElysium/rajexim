<?php
// To get info email details
$email_id = $email_details->email_name; 
$password = aes128Decrypt('arjunerp',$email_details->password);
$smtp_name = $email_details->smtp_host;
/* connect to gmail */
$hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}'.str_replace('_', ' ',$email_label);
$username = $email_id;
$password = $password;
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
/* grab emails */
$header = imap_headerinfo($inbox, $msgno);
$overview = imap_fetch_overview($inbox, $msgno,0);
$subject = $overview[0]->subject;
$message = imap_fetchbody($inbox,$msgno,2);
$from_details = $header->from;

// To check email has attachment
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
                $filename = $attachment['name'];
                if(empty($filename)) $filename = $attachment['filename'];
 
                if(empty($filename)) $filename = time() . ".dat";
 
                /* prefix the email number to the filename in case two emails
                 * have the attachment with the same file name.
                 */
                $fp = fopen($_SERVER['DOCUMENT_ROOT']."/demo/assets/mailbox_downloads/" . $msgno . "-" . $filename, "w+");
                fwrite($fp, $attachment['attachment']);
                
                fclose($fp);
              
            }
 
        }

/* close the connection */
imap_close($inbox);

?>