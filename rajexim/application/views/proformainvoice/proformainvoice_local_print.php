<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <?php $baseUrl=base_url();$CI =& get_instance();?>

<?php $this->load->view('common_css.php');?>

<style type="text/css">
    table thead tr th{vertical-align: middle;}

    #content{vertical-align: top;}

p {
  margin-bottom: 0 !important;
}

body{
  font-size: 14px;
}
</style>

<style type="text/css" media="print">

/*table{font-family: Verdana,sans-serif;font-weight: 400;font-size: 14px; }*/
.fa.fa-map-marker
{border: 1px solid #000;border-radius: 50%;text-align: center; }
/*table.report-container {
    page-break-after:always;
}*/
thead.report-header {
    display:table-header-group;
}
table.report-container div.article {
  page-break-inside: avoid;
  /*margin:5px 0px 0;*/
  margin:20px 0px 5%;
}


@media print {
  #printPageButton {
    display: none;
  }
  #content:after {
    display: block;
    content: "";
    margin-bottom: 200mm; /* must be larger than largest paper size you support */
  }
}
</style>


</head>

<?php $date_format =common_date_format();?>
<body style="border: 1px solid #000;">



                  <div id="printPageButton">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="pull-right">
                          <div class="form-group m-form__group">
                            <label></label>
                            <!-- <input id="goButton" onclick="printpage();" name="goButton" value="Go" class="btn btn-primary inp" style="margin-top:26px;" type="submit"> -->
                            <button type="button" onclick="printpage();" class="btn btn-primary"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
                          </div>
                        </div>
                      </div>
                    </div>
                   <!-- <a href="javascript:;" onclick="printpage();" class="btn btn-primary">
                              <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Print"><i class="fa fa-print pull-right" style="padding:15px 30px 0px 0px;"></i></span>
                            </a> -->
                  </div>


<input type="hidden" id='baseurl' name="baseurl" value="<?php echo $baseUrl;?>">
        <!-- Begin page -->
<div class="row">
  <div class="col-lg-12">
    <table border="1" style="border-collapse: collapse;width: 100%;">
      <thead>
        <tr>
          <th colspan="3" style="text-align: center !important;text-transform: uppercase;vertical-align: middle;border-left: 0;vertical-align: bottom;border-right: 0;">
            <h2><b>PROFORMA INVOICE</b></h2>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td rowspan="2" colspan="2" width="50%">
            <div>
              <p style="text-align: left;margin:0px;text-transform: uppercase;"><b>CONSIGNOR</b></p>
              <p style="margin:0px;"><?php echo $exporter_list->exporter_name;?></p>
              <p style="margin:0px;"><?php echo $exporter_list->exporter_address;?></p>
              <!-- <p style="margin:0px;">Avaniyapauram Bye Pass Road , MAdurai-625012</p>
              <p style="margin:0px;">TAMIL NADU , INDIA</p> -->
            </div>
          </td>
          <td colspan="4" width="50%">
            <p style="text-align: left;margin:0px;"><b>Invoice No</b>:&nbsp;<?php echo $proforma_invoice_no;?></p>
            <p style="text-align: left;margin:0px;"><b>Date</b>:&nbsp;<?php echo date($date_format, strtotime($proformainvoice_list->proforma_invoice_date)); ?></p>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p style="text-align: left;margin:0px;"><b>Buyer's Confirmation Date</b>:&nbsp;<?php echo date($date_format, strtotime($proformainvoice_list->buyer_confirmation_date)); ?></p>   
          </td>
        </tr>
        <tr>
          <td rowspan="3" colspan="2">
            <p style="text-align: left;margin:0px;text-transform: uppercase;"><b>CONSIGNEE</b></p>
            <div>
              <p style="margin:0px;text-transform: uppercase;"><?php echo $lead_detail->lead_name;?> <br><?php echo $lead_detail->country_name;?></p>
              <!-- <p style="margin:0px;text-transform: uppercase;"><?php //echo $lead_detail->contact_no!=''?$lead_detail->contact_no:'';?></p> -->
            </div>  
          </td>
          <td colspan="2">
            <p style="text-align: center;margin:0px;"><b>Terms & Payment</b></p>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <p style="text-align: center;margin:0px;">
              <?php echo $terms_and_payment_value;?>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <p style="text-align: center;margin:0px;"><b>Price Term</b></p>
            <p style="text-align: center;margin:0px;"><?php echo $proformainvoice_list->price;?></p>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <table class="inner_one" width="100%" style="border-collapse: collapse;" border="1px" cellpadding="5">
              <thead>
                <tr>
                  <th style="text-align: center !important;">Mark & No</th>
                  <th align="center">Descriptions of Goods</th>
                  <th align="center">Quantity</th>
                  <th align="center">Rate in <?php echo $curcode;?></th>
                  <th align="center">Taxable Amount</th>
                  <th align="center">Tax %</th>
                  <?php if($proformainvoice_product_list[0]['tax_type']==1){?>
                  <th align="center">IGST</th>
                  <?php }else{?>
                  <th align="center">CGST</th>
                  <th align="center">SGST</th>
                  <?php }?>
                  <th align="center">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; $spec = '';foreach($proformainvoice_product_list as $qprod){
                  $dispname = $this->Productcosting_model->get_display_name_by_product_item_display_name_id($qprod['product_item_display_name_id']);
                  $dname = $dispname->display_name;

                  $tamt = $qprod['quantity']*$qprod['rate'];
                  if($proformainvoice_product_list[0]['tax_type']==1){
                    $sgst = '';
                    $cgst = '';
                    $igst = $tamt*$qprod['tax_percent']/100;
                  }else{
                    $sgst = $tamt*$qprod['tax_percent']/100;
                    $cgst = $tamt*$qprod['tax_percent']/100;
                    $igst = '';
                  }
                  ?>
                <tr>
                  <td align="center"><?php echo $qprod['marks_and_no'];?></td>
                  <td align="center"><?php echo $dname;?></td>
                  <td align="center"><?php echo $qprod['quantity'];?> <?php echo $qprod['product_unit'];?></td>
                  <td align="right"><?php echo number_format($qprod['rate'],2);?></td>
                  <td align="right"><?php echo number_format(($qprod['quantity']*$qprod['rate']),2);?></td>
                  <td align="center"><?php echo $qprod['tax_percent'];?></td>
                  <?php if( $proformainvoice_product_list[0]['tax_type']==1){?>                    
                    <td align="right"><?php echo number_format($igst,2);?></td>
                  <?php }else{?>                    
                    <td align="right"><?php echo number_format($cgst,2);?></td>                    
                    <td align="right"><?php echo number_format($sgst,2);?></td>
                  <?php }?>
                  <td align="right"><?php echo number_format($qprod['amount'],2);?></td>
                </tr>
                <?php $i++; $spec.="<u>".$dname."</u><br>".$qprod['specification']."<br><br>";}?>

                <?php if(count($proformainvoice_other_charge_list)>0)
                {
                  if($proformainvoice_product_list[0]['tax_type']==1){
                    $osgst = '';
                    $ocgst = '';
                    $oigst = $proformainvoice_other_charge_list->taxable_amount*$proformainvoice_other_charge_list->tax_percent/100;
                  }else{
                    $osgst = $proformainvoice_other_charge_list->taxable_amount*$proformainvoice_other_charge_list->tax_percent/100;
                    $ocgst = $proformainvoice_other_charge_list->taxable_amount*$proformainvoice_other_charge_list->tax_percent/100;
                    $oigst = '';
                  }
                  ?>
                <tr>
                  <td></td>
                  <td align="center"><?php echo $proformainvoice_other_charge_list->particulars;?></td>
                  <td></td>
                  <td></td>
                  <td align="right"><?php echo $proformainvoice_other_charge_list->taxable_amount;?></td>
                  <td align="center"><?php echo $proformainvoice_other_charge_list->tax_percent;?></td>
                  <?php if( $proformainvoice_product_list[0]['tax_type']==1){?> 
                    <td align="right"><?php echo number_format($oigst,2);?></td>
                  <?php }else{?>                    
                    <td align="right"><?php echo number_format($ocgst,2);?></td>                    
                    <td align="right"><?php echo number_format($osgst,2);?></td>
                  <?php }?>
                  <td align="right"><?php echo $proformainvoice_other_charge_list->amount;?></td>
                </tr>
                <?php }?>

              </tbody>
              <tfoot>
                <?php if($proformainvoice_product_list[0]['tax_type']==1){
                    $colspan = 6;
                  }else{
                    $colspan = 7;
                  }?>
                <tr>
                  <td colspan="<?php echo $colspan;?>" style="border-bottom: 0; ">
                    <p style="text-align: left;margin:0px;"><b>Amount Chargeable (in Words)</b></p>
                    <p style="margin:0px;text-transform: capitalize;"><?php echo $curcode;?> <?php echo $CI->convertToCurrency(str_replace(',', '', number_format($proformainvoice_list->grand_total, 2)));?></p>  
                  </td>
                  <td align="right" style="border-bottom: 0; "><b>Total</b></td>
                  <td align="right" style="border-bottom: 0; "><b><?php echo number_format($proformainvoice_list->grand_total,2);?></b></td>
                </tr>
              </tfoot>
            </table>
          </td>
        </tr>
        <tr id="content">
          <td colspan="4">
            <p style="text-align: left;margin:0px;text-transform: capitalize;"><b>Specification</b>:</p>
            <p style="margin:0px;text-transform: capitalize;">
              <?php echo $spec;?>
            </p>      
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p style="margin:2px;text-transform: uppercase;"><b>Our Bank Details </b></p>
            <p style="margin:2px;"><?php echo $bank_detail->bank_detail;?></p>  
          </td>
        </tr>
        <tr>
          <td colspan="4" style="border-bottom: 0;">
            <!-- <p style="margin:2px;text-transform: uppercase;border-bottom: 1px solid #ccc;"><b>Declaration</b></p> -->
            <p style="margin:0px;padding: 0">Kindly send us your formal Purchase Order.</p>
          </td>
        </tr>
        <tr>
          <td colspan="4" style="border-bottom: 0;">
            <!-- <p style="margin:2px;text-transform: uppercase;border-bottom: 1px solid #ccc;"><b>Declaration</b></p> -->
            <p style="margin:0px;padding: 0">Regards</p>
          </td>
        </tr>
        <tr>
          <td colspan="4" style=" border-top: 0;border-bottom: 0;border-right: 0;">
            <p style="margin:0px;height: 100px;"><b>For <?php echo $exporter_list->exporter_name;?></b></p>
            <p style="margin:0px;"><b>Authorized Signatory</b></p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

             
           

            <?php $this->load->view('common_js.php');?>


        <script type="text/javascript">
    //$(window).on('load',function() {var baseurl= $("#baseurl").val(); window.print(); window.location.href = baseurl+'order';});
    var baseurl= $("#baseurl").val();
    opener.location.href = baseurl+'proformainvoice';
    function printpage()
        {
          var baseurl= $("#baseurl").val(); window.print();window.close(); //window.location.href = baseurl+'workorder';
        }
</script>

</body>
</html>