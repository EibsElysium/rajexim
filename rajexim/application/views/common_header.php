<?php 

 	$g_settings = common_select_values('*', 'general_settings', '', 'row');
 	$p_title = isset($g_settings->product_title) ? $g_settings->product_title : 'Raj Exim';
 	$p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/images/logo.png';
 	$p_favicon  = isset($g_settings->favicon) ? base_url().'assets/common_images/'.$g_settings->favicon : base_url().'assets/images/favicon.ico';
  $user_details = login_user_details($_SESSION['admindata']['user_id']);
  $body_class = ($user_details->show_menu == 0) ? "m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default m-brand--minimize m-aside-left--minimize" : "m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"; 
$body_class1 = ($user_details->show_menu == 1) ? "m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop   m-container m-container--responsive m-container--xxl m-page__container m-body" : "m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body"; 
  $current_time = date('Y-m-d H:i:s');
  $update_users_last_active_time = update_users_last_active_time($_SESSION['login_history_id'],$current_time);
  $_SESSION['user_last_active_time'] = $current_time;
?>

<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title><?php echo $p_title;  ?></title>

		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="<?php echo base_url(); ?>assets/demo/demo12/base/webfont.js"></script>
		<script>
			WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700","Nunito:400,400i,600,600i,700,700i,800,800i,900,900"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
    </script>
        <link rel="shortcut icon" href="<?php echo $p_favicon; ?>" />
        
<style type="text/css">
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
   position: fixed;
   left: 0px;
   top: 0px;
   width: 100%;
   height: 100%;
   z-index: 9999;
   background: url("assets/demo/demo12/media/img/logo/aero_world.gif") center no-repeat #fff;
}
#mycalculator {
  position: absolute;
  z-index: 9;
  background-color: #f1f1f1;
  text-align: center;
  border: 1px solid #d3d3d3;
  z-index: 9999;
}

#mycalculatorheader {
  padding: 10px;
  cursor: move;
  z-index: 10;
  background-color: #2196F3;
  color: #fff;
}
</style>

<!-- Paste this code after body tag -->
            <div class="se-pre-con"></div>
      <!-- Ends -->
	<?php $this->load->view('common_css'); ?>
  <!-- end::Head -->
</head>

<body class="<?php echo $body_class; ?>">

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

      <!-- BEGIN: Header -->
      <?php  $this->load->view('common_topbar'); ?>

      <!-- END: Header -->

      <!-- begin::Body -->
      <div class="<?php echo $body_class1; ?>">
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
        <?php if($user_details->show_menu == 0){ ?>
        <!-- BEGIN: Left Aside -->
        
        <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">

          <!-- BEGIN: Aside Menu -->

           <?php  $this->load->view('common_sidebar'); ?>

          <!-- END: Aside Menu -->
        </div>
      <?php } ?>
        <!-- END: Left Aside -->