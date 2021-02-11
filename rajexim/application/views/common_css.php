<?php $baseUrl=base_url();

 	$user_details = login_user_details($_SESSION['admindata']['user_id']);
?>
<!--begin::Global Theme Styles -->
	<link href="<?php echo $baseUrl;?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

<?php if($user_details->show_menu == 1){ ?>

	<link href="<?php echo $baseUrl;?>assets/demo/demo12/base/style.bundle_default.css" rel="stylesheet" type="text/css" />
<?php }else{ ?> <link href="<?php echo $baseUrl;?>assets/demo/demo12/base/style.bundle.css" rel="stylesheet" type="text/css" /> <?php } ?>

<link href="<?php echo $baseUrl;?>assets/demo/demo12/base/jasny-bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $baseUrl;?>assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
 <!--end::Global Theme Styles-->
<link href="<?php echo $baseUrl;?>assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> 
<link href="<?php echo $baseUrl;?>assets/demo/demo12/base/cust_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $baseUrl;?>assets/css/jquery-ui.css" />
<link href="<?php echo $baseUrl;?>assets/vendors/custom/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.cs
s">
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>assets/fancybox/jquery.fancybox.css" media="screen">