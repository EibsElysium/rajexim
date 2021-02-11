<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <?php $baseUrl=base_url();?>

<?php //$this->load->view('common_css.php');?>

<style type="text/css">
body{font-family: 'Arial';}
  table p,table th{font-size: 9.5pt;padding-bottom: 5px;vertical-align: top;font-family: 'Arial';}


@media print {
  #printPageButton {
    display: none;
  }
    .foot{position: absolute;bottom: 0px;right: 0px;left:0px;}
   #pageborder {
      position:fixed;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      border: 0.2px solid black;
      /*padding: 5px;*/
    }
}
.btn.btn-primary {
    color: #fff;
    background: #04488b;
    border-color: #04488b;
}
.btn {
    padding: .5rem 2rem;
    font-size: 1rem;
    font-weight: 400;
    font-family: Montserrat;
    margin: 15px 15px 15px 0;
}
table.inner td, 
table.inner th {
    border: 1px solid grey;
}
table.inner tr:first-child td,
table.inner tr:first-child th {
    border-top: 0;
}
table.inner tr:last-child td,
table.inner tr:first-child th {
    border-bottom: 0;
}
table.inner tr td:first-child,
table.inner tr th:first-child {
    border-left: 0;
}
table.inner tr td:last-child,
table.inner tr th:last-child {
    border-right: 0;
}
table.inner_one td, 
table.inner_one th {
    border: 1px solid grey;
}
table.inner_one tr:first-child td,
table.inner_one tr:first-child th {
    border-top: 0;
}
table.inner_one tr:last-child td,
table.inner_one tr:first-child th {
    /*border-bottom: 0;*/
}
table.inner_one tr td:first-child,
table.inner_one tr th:first-child {
    border-left: 0;
}
table.inner_one tr td:last-child,
table.inner_one tr th:last-child {
    border-right: 0;
}
</style>

</head>
<?php 
  $g_settings = common_select_values('*', 'general_settings', '', 'row');
  $p_title = isset($g_settings->product_title) ? $g_settings->product_title : 'Raj Exim';
  $p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/images/logo.png';
  $p_favicon  = isset($g_settings->favicon) ? base_url().'assets/common_images/'.$g_settings->favicon : base_url().'assets/images/favicon.ico';

  $date_format =common_date_format();
?>
<body id="pageborder">



                  <div id="printPageButton">
                    <div class="row">
                      <div class="col-lg-12">
                        <div style="float: right;">
                          <div class="form-group m-form__group">
                            <label></label>
                            <button type="button" onclick="printpage();" class="btn btn-primary"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
<div style="clear:both!important;"></div>

<input type="hidden" id='baseurl' name="baseurl" value="<?php echo $baseUrl;?>">
        <!-- Begin page -->

<table border="1" cellpadding="5" style="border-collapse: collapse;width: 100%;">
  <tbody>
    <!-- Header-->
    <tr>
      <td style="width:50%;">
        <div style="margin:0 auto;text-align: center;">
          <img alt="" src="<?php echo $p_logo; ?>" >
        </div>
      </td>

      <td style="text-align: center;width:50%;vertical-align: middle;">
        <p style="text-align: center;padding:0;margin:0;font-size:15.5pt;font-weight: bold;font-family: Arial; ">INSPECTION REPORT</p>
      </td>
    </tr>
    <!-- Header-->

    <!-- Buyer & product info-->
    <tr>
      <td colspan="2" style="padding: 0;">
        <table class="inner" style="border-collapse: collapse;width: 100%;">
          <tr>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;">Buyer Name</p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $joborder_list->lead_name;?></p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;">Date</p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo date($date_format, strtotime($joborder_list->job_order_date));?></p></td>
          </tr>
          <tr>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;">Product Name</p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $joborder_list->product_name;?> - <?php echo $joborder_list->product_item;?></p></td>
          </tr>
          <tr>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;">JO No / SPO No</p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $joborder_list->job_order_no;?> / <?php echo $joborder_list->supplier_purchase_order_no;?></p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;">BRAND</p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"></p></td>
          </tr>
          <tr>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;">Container No</p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $joborder_list->container_no;?></p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;">Lorry No</p></td>
            <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $joborder_list->lorry_no;?></p></td>
          </tr>
        </table>
        
      </td>
    </tr>
    <!-- Buyer & product info-->


    <!--Job Temp item Details-->
    <tr>
      <td colspan="2" style="padding:0;">
        <table class="inner" cellpadding="5" style="border-collapse: collapse;width: 100%;">
          <thead>
            <tr>
              <th >S.No</th>
              <th >ITEMS</th>
              <th >SPECIFICATION AS PER CUSTOMER REQUIRMENTS</th>
              <th >INSPECTION TOOLS</th>
              <th >OBSERVATION</th>
              <th >PASS/FAIL</th>
            </tr>
            <?php $i=1; foreach($joborder_items as $joitem){
                if($joitem['pass_fail']==0)
                 {
                    $pf = 'Fail';
                 }
                 else
                 {
                    $pf = 'Pass';
                 }
              ?>
            <tr>
              <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $i;?></p></td>
              <td ><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $joitem['items'];?></p></td>
              <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $joitem['specification'];?></p></td>
              <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $joitem['tools'];?></p></td>
              <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $joitem['observation'];?></p></td>
              <td style="padding:3px"><p style="text-align:left;font-size: 9.5pt;margin:0;padding:0;"><?php echo $pf;?></p></td>
            </tr>
            <?php $i++;}?>
          
          </thead>
        </table>
      </td>
    </tr>
    <!--Job Temp item Details-->
  </tbody>
</table>

<div  class="foot">
  <table width="100%" border="1" style="border-collapse: collapse;">
        <!-- Verification-->
    <tr>
      <td style="width:50%;vertical-align: top;padding: 3px;">
        <p style="text-align: left;margin:0px;">Checked By: </p>
        <div style="height:50px;">
        </div>
      </td>
      <td style="width:50%;vertical-align: top;padding: 3px;">
        <p style="text-align: left;margin:0px;">Approved By:</p>
         <div style="height:50px;">
        </div>
      </td>
    </tr>
    <!-- Verification-->
  </table>
</div>
            
        <!-- End Page -->   

            <?php $this->load->view('common_js.php');?>


<script type="text/javascript">
var baseurl= $("#baseurl").val();
opener.location.href = baseurl+'joborder';
function printpage()
{
var baseurl= $("#baseurl").val(); window.print();window.close(); //window.location.href = baseurl+'workorder';
}
//$(window).on('load',function() {var baseurl= $("#baseurl").val(); window.print(); window.location.href = baseurl+'workorder';});
</script>

</body>
</html>