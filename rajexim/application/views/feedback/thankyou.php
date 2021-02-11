<?php 
  $g_settings = common_select_values('*', 'general_settings', '', 'row');
  $p_title = isset($g_settings->product_title) ? $g_settings->product_title : 'Raj Exim';
  $p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/images/logo.png';
  $baseUrl=base_url();
?>
<?php  $date_format =common_date_format();?>

  <link rel="stylesheet" href="<?php echo $baseUrl;?>assets/feedback/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $baseUrl;?>assets/feedback/css/style.css">
  <script src="<?php echo $baseUrl;?>assets/feedback/js/jquery.min.js"></script>
  <script src="<?php echo $baseUrl;?>assets/feedback/js/bootstrap.min.js"></script>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button> -->
      <a class="navbar-brand" href="javascript:;"><img src="<?php echo $p_logo; ?>" class="img-responsive" width="200"></a>
    </div>
    <!-- <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">Feedback Form</a></li>
      </ul>
    </div> -->
  </div>
</nav>
  
<div class="container-fluid"> 
  <div class="feedback">
    <div class="row">
      <div class="col-md-12">
        <!-- <h3 class="text-center">Customer Feedback Form</h3> -->&nbsp;
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <div class="jumbotron text-center">
          <h1 class="display-3">Thank You For Your Time Today!</h1>
          <p class="lead text-center"><strong>Your Valuable Feedback is Received</strong></p>
           <p class="lead text-center"><strong>Get in Touch With Us</strong></p>
          <!-- <hr> -->
          <p class="text-center">
           <!--  For More Queries ? <a href="http://geewinexim.com">View More</a> -->&nbsp;
          </p>
          <p class="lead text-center">
            <a class="btn btn-primary btn-sm" href="https://rajexim.com/" role="button">Click To Know More About Us</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('common_footer'); ?>

</body>
</html>
