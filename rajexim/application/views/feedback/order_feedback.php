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
        <h3 class="text-center">Customer Feedback Form</h3>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12"> 
          <div class="row">
            <div class="col-md-6">

              <fieldset>
                  <legend class="text-info"><b>Buyer & Order Info</b></legend>
                  <table class="table table-bordered">
                    <thead>

                      <tr>
                        <th>Order No</th><td><?php echo $buyer_order_details->buyer_order_invoice_no;?></td>
                      </tr>
                      <tr>
                        <th>Order Date</th><td><?php echo date($date_format, strtotime($buyer_order_details->invoice_date)); ?></td>
                      </tr>
                      <tr>
                        <th>Buyer Name</th><td><?php echo $buyer_order_details->lead_name;?></td>
                      </tr>
                      <tr>
                        <th>Country</th><td><?php echo $buyer_order_details->country_name;?></td>
                      </tr>
                    </thead>
                  </table>
              </fieldset>
            </div>

            <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>feedback/save_feedback">
              <div class="col-md-6">
                <input type="hidden" id="poid" name="poid" value="<?php echo $buyer_order_details->buyer_order_id;?>">
                  <fieldset>
                    <legend class="text-info"><b>Feedback</b></legend>
                      <form>
                        <div class="form-group">
                          <h5><b>Work Followup</b></h5>
                            <div>
                              <label class="radio-inline">
                                <input type="radio" name="work_followup" checked id="work_followup_0" value="Excellent">Excellent
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="work_followup" id="work_followup_1" value="Good">Good
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="work_followup" id="work_followup_2" value="Fair">Fair
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="work_followup" id="work_followup_3" value="Poor">Poor
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                          <h5><b>Staff Approach</b></h5>
                            <div>
                              <label class="radio-inline">
                                <input type="radio" name="staff_approach" checked id="staff_approach_0" value="Excellent">Excellent
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="staff_approach" id="staff_approach_1" value="Good">Good
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="staff_approach" id="staff_approach_2" value="Fair">Fair
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="staff_approach" id="staff_approach_3" value="Poor">Poor
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                          <h5><b>Timely Delivery</b></h5>
                            <div>
                              <label class="radio-inline">
                                <input type="radio" name="timely_delivery" checked id="timely_delivery_0" value="Excellent">Excellent
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="timely_delivery" id="timely_delivery_1" value="Good">Good
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="timely_delivery" id="timely_delivery_2" value="Fair">Fair
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="timely_delivery" id="timely_delivery_3" value="Poor">Poor
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                          <h5><b>Quality</b></h5>
                            <div>
                              <label class="radio-inline">
                                <input type="radio" name="quality" checked id="quality_0" value="Excellent">Excellent
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="quality" id="quality_1" value="Good">Good
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="quality" id="quality_2" value="Fair">Fair
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="quality" id="quality_3" value="Poor">Poor
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                          <h5><b>Suggestion</b></h5>
                          <textarea class="form-control" cols="20" rows="5" id="suggestion" name="suggestion"></textarea>
                        </div>
                        <div class="form-group">
                          <div class="pull-right">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                      </form>
                  </fieldset>
              </div>
            </form>
          </div>
          
        
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('common_footer'); ?>

</body>
</html>
