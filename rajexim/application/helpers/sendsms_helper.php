<?php 
/*Start sendsms_helper.php file */

    function sendsms($mobile, $msg, $authkey, $sender){
      
      /*$msgtxt= $msg;
      $mobile = $mobile;
      $ch = curl_init();
    //API details
      curl_setopt($ch,CURLOPT_URL,  "http://103.16.101.52:8080/sendsms/bulksms");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "username=kpsd-elysium&password=nag6543&type=0&dlr=0&destination=$mobile&source=022751&message=$msgtxt");
      $buffer = curl_exec($ch);
      if(empty ($buffer))
      { 
        return 0;
      }
      else
      { 
       return 1;
      }
      curl_close($ch);*/

      //$authKey = "163736ACak5vRWs6Mr595cc25f"; //163736ACak5vRWs6Mr595cc25f
      $authKey = $authkey; //163736ACak5vRWs6Mr595cc25f

//Multiple mobiles numbers separated by comma
$mobileNumber = $mobile;

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = $sender;

//Your message to send, Add URL encoding here.
$message = urlencode($msg);

//Define route 
$route = 4;
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="http://54.254.154.166/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}

if(empty ($output))
      { 
        return 0;
      }
      else
      { 
       return 1;
      }

curl_close($ch);

//echo $output;


}


 function vehicle_tracking(){
      
    
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://connect.geoshadow.tech/mobile/getGrpDataForTrustedClients?providerName=APFOODS1&fcode=VAM');
$result = curl_exec($ch);
curl_close($ch);

return json_decode($result);

}


    /*     * End sendsms_helper.php file     */
    ?>