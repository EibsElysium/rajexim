<?php
require_once('DBConnect.php');
$user_id = $_REQUEST['user_id'];
$ImageData = $_REQUEST['prof_image'];

$ImagePath = "profile_image/$user_id.JPEG";
 
$ServerURL = "http://demo.elysiumservices.in/uniqueindustry/service/$ImagePath";

echo $ServerURL;

if($user_id==''){

	$data['invoice_data'][0]['message']="Not Uploaded";
	
}else{
	$user_img = $user_id.'.JPEG';
	$sql = "update user_management i set i.user_profile='$user_img' where i.user_id=$user_id";
	$query = mysqli_query($con,$sql);
    $data = base64_decode($ImageData);


     
//file_put_contents('/tmp/image.png', $data);

  //base64_decode($ImageData);


 file_put_contents($ImagePath,$data);

error_log(print_r($_POST, 1));

	//echo $DefaultId;
	$data['invoice_data'][0]['status'] = 1;
	$data['invoice_data'][0]['message']="upload successfully";
}

echo json_encode($data);
?>