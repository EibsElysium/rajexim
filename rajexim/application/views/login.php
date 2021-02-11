<?php
    // if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    //     exec("where php",$output);
    //     $php_path = $output[0];
    //     $parent_path_of_app = $_SERVER['DOCUMENT_ROOT'];
    //     exec("'".$php_path."' '".$parent_path_of_app."'rajexim_wip/index.php welcome index");
    // } else {
    //     exec("whereis php",$output);
    //     $php_path = $output[0];
    //     $parent_path_of_app = $_SERVER['DOCUMENT_ROOT'];
    //     exec("'".$php_path."' '".$parent_path_of_app."'rajexim_wip/index.php welcome index");
    // }
    
    if(get_cookie('username')!=""){ $uname=get_cookie('username'); }else{ $uname=''; }
    if(get_cookie('password')!=""){ $pwd=get_cookie('password'); }else{ $pwd=''; }
?>
<?php 
    $g_settings = common_select_values('*', 'general_settings', '', 'row');
    $p_title = isset($g_settings->project_title) ? $g_settings->project_title : 'Raj Exim';
    $p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/images/logo.png';
 	$p_favicon  = isset($g_settings->favicon) ? base_url().'assets/common_images/'.$g_settings->favicon : base_url().'assets/images/favicon.ico';
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title><?php echo $p_title; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

<!-- 	 <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script> -->

	<!-- Custom Theme files -->

	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
	<!-- //Custom Theme files -->
	    <!-- Favicon icon -->
    <link rel="shortcut icon" href="<?php echo $p_favicon; ?>" type="image/x-icon" >
	<!-- web font -->
	<!-- <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet"> -->
	<!-- //web font -->

</head>
<body>

<!-- main -->
<div class="w3layouts-main"> 
	<div class="bg-layer">
		<h1>&nbsp; </h1>
		<div class="header-main">
			<div class="main-icon">
				<img src="<?php echo $p_logo; ?>">
			</div>
			<div class="header-left-bottom">
				<form action="javascript:;" method="post">
					<div class="login_form">
							<div class="icon1">
								<input class="form-control" type="text" placeholder="Username" name="username" id="username" autocomplete="off" value="<?php echo $uname;?>">
							</div>
							<div class="icon1">
								<input  type="password" name="Password" class="form-control" placeholder="Password" name="password"  id="password" value="<?php echo $pwd;?>">
							</div>
							<div class="login-check">
								 <label class="checkbox">

								 	 <?php  if(get_cookie('rememberme')!=""){ ?>
                                              <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberme" checked>
                                          <?php } else{ ?>
                                            <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberme">  
                                        <?php }
                                        ?>


								 	<i> </i> Remember Me</label>
							</div>
							<div class="bottom">
								<button class="btn" onclick="login_validate();" name="submit" id="submit">Get In</button>
							</div>
							<div id="err" class="help-block" style="color:red;"></div>
                            <div id="success" class="help-block" style="color:green;"></div>
					</div>
					<div class="forgot_form"  style="display: none;">
							<div class="icon1">
								<input class="form-control" type="text" placeholder="Email ID">
							</div>

							<div class="bottom">
								<button class="btn">Send</button>
							</div>
					</div>
					<div class="links">
						<p class="for_link"><a href="#">Forgot Password?</a></p>
						<p class="log_link" style="display: none;"><a href="#">Back To Login</a></p>
						<div class="clear"></div>
					</div>
				</form>	
			</div>
			
		</div>
		

	</div>
</div>	
<!-- //main -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>


<script type="text/javascript">
	var baseurl = '<?php echo base_url(); ?>';
    $(document).ready(function(){
      // window.open("<?php // echo base_url(); ?>Login/socket_command",'_blank');
        $('.for_link').click(function(){
        	$('.login_form').hide('slow');
        	$('.for_link').hide('slow');
        	$('.forgot_form').show('slow');
        	$('.log_link').show('slow');
        });
        $('.log_link').click(function(){

        	$('.forgot_form').hide('slow');
        	$('.log_link').hide('slow');
        	$('.login_form').show('slow');
        	$('.for_link').show('slow');
        });
    });
     var title = $('title').text() + ' | ' + 'Login';
    $(document).attr("title", title);

    $("#password").attr("onkeyup","if(event.keyCode==13) { login_validate(); }");
    // To validate login form
    function login_validate()
    {
      var username = $("#username").val(); 
      var password = $("#password").val(); 

      if($("#rememberMe").prop('checked')==true)
      {
        var re=1;
      }else{
        var re=0;
      }
      
      $.ajax({
        type: "POST",
        url: baseurl+'Login/admin_login_check',
        data: "name="+username+"&password="+password+"&rememberme="+re,
       // async: false,
        //cache: false,
           // timeout: 30000,
        beforeSend: function() {
            // setting a timeout
            $('div#err').text('');
            $('div#success').text('Authenticating...');
        },           
        success: function(response)
        {
          if(response == 1){!
            $('div#err').show();
            $('div#err').text('Please Enter Username!');
            $('div#success').text('');
            return false;
          }     
          else if(response == 2){
            $('div#err').show();
            $('div#err').text('Please Enter Password!');
            $('div#success').text('');
             return false;
          }
          else if(response == 3){
            $('div#err').show();
            $('div#err').text('Please Enter Username & Password!');
            $('div#success').text('');
            return false;
          } 
           else if(response == 5){
            $('div#err').show();
            $('div#err').text('User Inactive!');
            $('div#success').text('');
            return false;
          }  
           else if(response == 4){
            $('div#err').show();
            $('div#err').text('User Role Inactive!');
            $('div#success').text('');
            return false;
          }  
           else if(response == 0){
            $('div#err').show();
            $('div#err').text('Invalid Username / Password!');
            $('div#success').text('');
            return false;
          }  
           else if(response == 7){
            $('div#err').show();
            $('div#err').text('Invalid Password');
            $('div#success').text('');
            return false;
          }       
          else if(response == 6)
            {           
            $('div#err').text('');
            $('div#success').text('Login Successfully');
            
            //window.location=baseurl+'Dashboard';
            window.location=baseurl+'dashboard';
          }

        }
      });
    }
</script>
</body>
</html>