<!DOCTYPE html>
<?php 
 	$g_settings = common_select_values('*', 'general_settings', '', 'row');
  $p_title = isset($g_settings->product_title) ? $g_settings->product_title : 'Raj Exim';
  $p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/images/logo.png';
?>
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
<?php $baseUrl=base_url();?>
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title><?php echo $p_title; ?> | 404 Error</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

		<!--end::Web font -->

		<!--begin::Global Theme Styles -->
		<!-- <link href="<?php //echo $baseUrl;?>assets/vendors/base/arjun_vendors.bundle.css" rel="stylesheet" type="text/css" /> -->

		<!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<!-- <link href="<?php //echo $baseUrl;?>assets/demo/demo12/base/arjun_style.bundle.css" rel="stylesheet" type="text/css" /> -->

		<!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="<?php echo $p_favicon; ?>" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid  m-error-3" style="background-image: url(<?php echo $baseUrl;?>assets/login/img/atlas.png);">
				<div class="m-error_container text-center">
					<!-- <p class="m-error_title m--font-light" style="margin-left: 18.5rem;margin-top: 2.5rem;">
						<a href="<?php //echo $baseUrl;?>dashboard"><button class="btn btn-info">Back to Home</button></a>
					</p> -->
					<span class="m-error_number">
						<h1 style="color: #fff;margin-top: 1.6rem;">404</h1>
					</span>
					<p class="m-error_title m--font-light" style="color: #fff!important;">
						How did you get here
					</p>
					<p class="m-error_subtitle" style="color: #fff!important;">
						Sorry we can't seem to find the page you're looking for.
					</p>
					<p class="m-error_description" style="color: #fff!important;">
						There may be amisspelling in the URL entered,<br>
						or the page you are looking for may no longer exist.
					</p>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin::Global Theme Bundle -->
		

		<!--end::Global Theme Bundle -->
	</body>

	<!-- end::Body -->
</html>