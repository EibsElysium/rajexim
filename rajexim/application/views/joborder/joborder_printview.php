<!DOCTYPE html>
<html>
<head>
<?php
	$g_settings = common_select_values('*', 'general_settings', '', 'row');
 	$p_title = isset($g_settings->product_title) ? $g_settings->product_title : 'Raj Exim';
 	$p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/images/logo.png';
 	$p_favicon  = isset($g_settings->favicon) ? base_url().'assets/common_images/'.$g_settings->favicon : base_url().'assets/images/favicon.ico';

 	$date_format =common_date_format();
 	//$joex = explode('/', $joborder_list->job_order_no);
?>
	<title><?php echo $p_title;?> Job Order</title>
</head>
<style type="text/css">
	ul{display: flex;margin: 0;padding: 0}
	ul li{list-style-type: none;margin:0 25px 0 5px}
	table p{font-size: 13px;padding-bottom: 5px;vertical-align: top;}
	table td{vertical-align: top;}

@media print {
  #printPageButton {
    display: none;
  }}
  
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
</style>
<body>

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

<table border="1" cellpadding="5" style="border-collapse: collapse;width: 100%;">
	<thead>
		<tr>
			<th colspan="2" style="text-align: center;text-transform: uppercase;">
				<img alt="" src="<?php echo $p_logo; ?>" ><br>
				Job Order - <?php echo $joborder_list->job_order_no;?>
			</th>
		</tr>
	</thead>
</table>


<!--Buyer & Product Information-->
<fieldset style="margin-top:10px;">
	<legend><h4 style="margin:0;">JO Information</h4></legend>
	<div style="display: flex;">
		<table border="1" width="100%" cellpadding="5" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td>JO Date</td>
					<td><?php echo date($date_format, strtotime($joborder_list->job_order_date));?></td>
				</tr>
				<tr>
					<td>JO End Date</td>
					<td><?php echo date($date_format, strtotime($joborder_list->job_order_end_date));?></td>
				</tr>
				<tr>
					<td>SPO No</td>
					<td><?php echo $joborder_list->supplier_purchase_order_no;?></td>
				</tr>
				<tr>
					<td>Assigned To</td>
					<td><?php echo $joborder_list->display_name;?></td>
				</tr>
				<tr>
					<td>Vendor</td>
					<td>
						<?php echo $joborder_list->vendor_name;?>
					</td>
				</tr>
				<tr>
					<td>Product</td>
					<td><?php echo $joborder_list->product_name;?> - <?php echo $joborder_list->product_item;?></td>
				</tr>
				<!-- <tr>
					<td>Specification</td>
					<td><?php //echo $joborder_list->description;?></td>
				</tr> -->
			</tbody>
		</table>
	</div>
</fieldset>
<!--Buyer & Product Information-->
<?php $this->load->view('common_js.php');?>
<script type="text/javascript">
	var baseurl = '<?php echo base_url(); ?>';
opener.location.href = baseurl+'joborder';
function printpage()
{
var baseurl= baseurl; window.print();window.close(); //window.location.href = baseurl+'workorder';
}
</script>

</body>
</html>