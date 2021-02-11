<?php

//$imap =  @imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX', 'elysiumservice24@gmail.com', 'EIBSGLOBAL@2019') or die('Cannot connect to Gmail: ' . imap_last_error());
//$imap = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', 'tumail987654321@gmail.com', '9a8b7c6d');
$gmailURL = "{imap.gmail.com:993/imap/ssl}Inbox";
$imap = imap_open($gmailURL, 'vimala2611992@gmail.com', 'vimalavinnarasicud12') or die('Cannot connect to Gmail: ' . imap_last_error());
$MC = imap_check($imap);
// Fetch an overview for all messages in INBOX
$result = imap_fetch_overview($imap,"1:{$MC->Nmsgs}",0);

echo '<pre>';
print_r($result);

$subjects = $datetime = $msgid = array();
foreach ($result as $overview) 
{
    $subject = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $overview->subject));
    if(!empty($subjects))
    {
        echo '<pre>';
        echo 'test 1';
        

        echo '<pre>';
        echo 'Subject';
        echo $subject;

        if(in_array($subject, $subjects))
        {
            echo '<pre>';
            echo 'test 2';
            $index = array_keys($subjects, $subject);

            echo '<pre>';
            echo 'Index val';
            print_r($index);
            $datetime_val = $datetime[$index[0]];

            if(date('d-m-Y H:i:s', strtotime($overview->date)) > $datetime_val)
            {
                echo '<pre>';
                echo 'test 3';
                $subjects[$index[0]] = $subject;
                $datetime[$index[0]] = date('d-m-Y H:i:s', strtotime($overview->date));
                $msgid[$index[0]] = $overview;
            }
            else{
                echo '<pre>';
            echo 'test 6';

                $subjects[$index[0]] = $subjects[$index[0]];
                $datetime[$index[0]] = $datetime[$index[0]];
                $msgid[$index[0]] = $msgid[$index[0]];
            }
        }
        else
        {
            echo '<pre>';
            echo 'test 4';
            $subjects[] = $subject;
            $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
            $msgid[] = $overview;
        }


    }
    else
    {
        echo '<pre>';
            echo 'test 5';
        $subjects[] = $subject;
        $datetime[] = date('d-m-Y H:i:s', strtotime($overview->date));
        $msgid[] = $overview;

    }
    echo '<pre>';
            echo '--------------------------';
   
}


echo '<pre>';
//asort($subjects);
print_r($subjects);

echo '<pre>';
//ksort($datetime);
print_r($datetime);

echo '<pre>';
//asort($msgid);
print_r($msgid);




$dates = array();       
foreach($msgid AS $val){
    $dates[] = strtotime($val->date);
}
array_multisort($dates, SORT_ASC, $msgid);


echo '<pre>';
echo 'sort Val';
//asort($msgid);
print_r($msgid);

die;










$threads = $rootValues = $parentValues = array();

$thread = imap_thread($imap);


$root = 0;

 echo '<pre>';
 print_r($thread);

//first we find the root (or parent) value for each email in the thread
//we ignore emails that have no root value except those that are infact
//the root of a thread

//we want to gather the message IDs in a way where we can get the details of
//all emails on one call rather than individual calls ( for performance )

//foreach thread
foreach ($thread as $i => $messageId) { 

 echo '<pre>';
 echo 'messageId';
    echo $messageId;

    //get sequence and type
    list($sequence, $type) = explode('.', $i);
   
    //if type is not num or messageId is 0 or (start of a new thread and no next) or is already set
    if($type != 'num' || $messageId == 0
       || ($root == 0 && $thread[$sequence.'.next'] == 0)
       || isset($rootValues[$messageId])) {
        //ignore it
        echo '<pre>';
        echo 'test';
        $parentValues[$messageId] = $messageId;
        continue;
    }
     
    //if this is the start of a new thread
    if($root == 0) {
        //set root

    echo '<pre>';
    echo 'test 1';
        $root = $messageId;
    }
   
    //at this point this will be part of a thread
    //let's remember the root for this email
    $rootValues[$messageId] = $root;


    echo '<pre>';
    echo 'rootvalues';
    print_r($rootValues); 
   
    //if there is no next
    if($thread[$sequence.'.next'] == 0) {

    echo '<pre>';
    echo 'test 2';
        //reset root
        $root = 0;
    }
     echo '<pre>';
    echo '-------------------------------------';
    
}


//now get all the emails details in rootValues in one call
//because one call for 1000 rows to a server is better
//than calling the server 1000 times 
$emails = imap_fetch_overview($imap, implode(',', array_keys($rootValues)));

//foreach email
foreach ($emails as $email) {
    //get root

    echo '<pre>';
print_r($email); 


    $root = $rootValues[$email->msgno];
   
    //add to threads
    $threads[$root][] = $email;
}   
die;

//there is no need to sort, the threads will automagically in chronological yp_order(domain, map)
echo '<pre>'.print_r($threads, true).'</pre>';
imap_close($imap);
exit;
?>