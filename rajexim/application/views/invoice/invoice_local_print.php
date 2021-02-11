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
    margin-bottom: 130mm; /* must be larger than largest paper size you support */
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
          <!-- <th style="border-right: 0;">
            <img src="<?php //echo base_url(); ?>exporterlogo/<?php //echo str_replace(' ', '_',$exporter_list->exporter_logo); ?>" height="75" width="150" alt="logo" style="object-fit: contain;">
          </th> -->
          <th colspan="5" style="text-align: center !important;text-transform: uppercase;vertical-align: middle;border-left: 0;vertical-align: bottom;border-right: 0;">
            <h2><b>TAX INVOICE</b></h2>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td rowspan="3" width="20%">
            <img src="<?php echo base_url(); ?>exporterlogo/<?php echo str_replace(' ', '_',$exporter_list->exporter_logo); ?>" height="75" width="150" alt="logo" style="object-fit: contain;">
          </td>
          <td rowspan="3" width="30%">
            <div>
              <!-- <p style="text-align: left;margin:0px;"><b>Exporter</b></p> -->
              <p style="margin:0px;"><?php echo $exporter_list->exporter_name;?></p>
              <p style="margin:0px;"><?php echo $exporter_list->exporter_address;?></p>
              <p style="margin:0px;">GSTIN/UIN:<?php echo $exporter_list->gst_no;?></p>
              <p style="margin:0px;">State Name : <?php echo $exporter_list->state_name;?></p>
              <p style="margin:0px;">State Code : <?php echo $exporter_list->state_code;?></p>
              <!-- <p style="margin:0px;">Avaniyapauram Bye Pass Road , MAdurai-625012</p>
              <p style="margin:0px;">TAMIL NADU , INDIA</p> -->
            </div>
          </td>
          <td colspan="2" width="25%">
            <p style="text-align: left;margin:0px;"><b>Invoice No</b>:&nbsp;<?php echo $invoice_no;?></p>
          </td>
          <td colspan="2" width="25%">            
            <p style="text-align: left;margin:0px;"><b>Date</b>:&nbsp;<?php echo date($date_format, strtotime($invoice_list->invoice_date)); ?></p>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <p style="text-align: left;margin:0px;"><b>Delivery Note</b>:&nbsp;</p>   
          </td>
          <td colspan="2">
            <p style="text-align: left;margin:0px;"><b>Mode/Terms of Payment</b>:&nbsp;<?php echo $terms_and_payment_value;?></p> 
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <p style="text-align: left;margin:0px;"><b>Supplier's Ref</b>:&nbsp;</p>    
          </td>
          <td colspan="2">
            <p style="text-align: left;margin:0px;"><b>Other Reference(s)</b>:&nbsp;<?php echo $invoice_list->other_reference;?></p> 
          </td>
        </tr>
        <tr>
          <td rowspan="5" colspan="2">
            <p style="text-align: left;margin:0px;"><b>Buyer</b></p>
            <div>
              <p style="margin:0px;text-transform: uppercase;"><?php echo $lead_detail->lead_name;?> <br><?php echo $lead_detail->address;?> <br><?php echo $lead_detail->country_name;?></p>
              <p style="margin:0px;text-transform: uppercase;">GSTIN/UIN : <?php echo $lead_detail->gst_no;?></p>
              <p style="margin:0px;">State Name : <?php echo $lead_detail->state_name;?></p>
              <p style="margin:0px;">State Code : <?php echo $lead_detail->state_code!=0?$lead_detail->state_code:'';?></p>
            </div>  
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <p style="margin:0px;text-transform: uppercase;"><b>Buyer's Order No : </b><?php echo $invoice_list->order_no;?></p>
          </td>
          <td>
            <p style="margin:0px;text-transform: uppercase;"><b>Dated : </b><?php echo date($date_format, strtotime($invoice_list->buyer_confirmation_date));?></p>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <p style="margin:0px;text-transform: uppercase;"><b>Despatch Document No : </b></p>
          </td>
          <td>
            <p style="margin:0px;text-transform: uppercase;"><b>Delivery Note Date : </b></p>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <p style="margin:0px;text-transform: uppercase;"><b>Despatched through : </b><?php echo $invoice_list->despatched_through;?></p>
          </td>
          <td>
            <p style="margin:0px;text-transform: uppercase;"><b>Destination : </b><?php echo $invoice_list->polname;?> - <?php echo $invoice_list->polcountry;?></p>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p style="margin:0px;text-transform: uppercase;"><b>Terms of Delivery : </b><?php echo $invoice_list->terms_of_delivery;?></p>
          </td>
        </tr>
        <tr>
          <td colspan="5">
            <table class="inner_one" width="100%" style="border-collapse: collapse;" border="1px" cellpadding="5">
              <thead>
                <tr>
                  <th style="text-align: center !important;">S No</th>
                  <th align="center">Descriptions</th>
                  <th align="center">HSN/SAC</th>
                  <th align="center">Quantity</th>
                  <th align="center">Rate in <?php echo $curcode;?></th>
                  <th align="center">Taxable Amount</th>
                  <th align="center">Tax %</th>
                  <?php if($invoice_product_list[0]['tax_type']==1){?>
                  <th align="center">IGST</th>
                  <?php }else{?>
                  <th align="center">CGST</th>
                  <th align="center">SGST</th>
                  <?php }?>
                  <th align="center">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; $spec = '';$tqty = 0; $arr = array();foreach($invoice_product_list as $qprod){
                  $dispname = $this->Productcosting_model->get_display_name_by_product_item_display_name_id($qprod['product_item_display_name_id']);
                  $dname = $dispname->display_name;

                  $tamt = $qprod['quantity']*$qprod['rate'];
                  if($invoice_product_list[0]['tax_type']==1){
                    $sgst = '';
                    $cgst = '';
                    $igst = $tamt*$qprod['tax_percent']/100;
                  }else{
                    $sgst = $tamt*$qprod['tax_percent']/100;
                    $cgst = $tamt*$qprod['tax_percent']/100;
                    $igst = '';
                  }

                  if(isset($arr[$qprod['tax_percent']]))
                  {                    
                    $tblamt = $arr[$qprod['tax_percent']]['taxable_amount']+($qprod['quantity']*$qprod['rate']);
                    $cgt = $arr[$qprod['tax_percent']]['cgst']+$cgst;
                    $sgt = $arr[$qprod['tax_percent']]['sgst']+$sgst;
                    $igt = $arr[$qprod['tax_percent']]['igst']+$igst;
                    $newdata =  array (
                      'taxable_amount' => $tblamt,
                      'cgst' => $cgt,
                      'sgst' => $sgt,
                      'igst' => $igt
                    );

                    $arr[$qprod['tax_percent']] = $newdata;
                  }
                  else
                  {
                    $newdata =  array (
                      'taxable_amount' => ($qprod['quantity']*$qprod['rate']),
                      'cgst' => $cgst,
                      'sgst' => $sgst,
                      'igst' => $igst
                    );

                    $arr[$qprod['tax_percent']] = $newdata;
                  }

                  ?>
                <tr>
                  <td align="center"><?php echo $i;?></td>
                  <td align="center"><b><u><?php echo $dname;?></u></b><br><?php echo $qprod['specification'];?></td>
                  <td aligh="center"></td>
                  <td align="center"><?php echo $qprod['quantity'];?> <?php echo $qprod['product_unit'];?></td>
                  <td align="right"><?php echo number_format($qprod['rate'],2);?></td>
                  <td align="right"><?php echo number_format(($qprod['quantity']*$qprod['rate']),2);?></td>
                  <td align="center"><?php echo $qprod['tax_percent'];?></td>
                  <?php if( $invoice_product_list[0]['tax_type']==1){?>                    
                    <td align="right"><?php echo number_format($igst,2);?></td>
                  <?php }else{?>                    
                    <td align="right"><?php echo number_format($cgst,2);?></td>                    
                    <td align="right"><?php echo number_format($sgst,2);?></td>
                  <?php }?>
                  <td align="right"><?php echo number_format($qprod['amount'],2);?></td>
                </tr>
                <?php $i++; $tqty+=$qprod['quantity'];}?>

                <?php if(count($invoice_other_charge_list)>0)
                {
                  if($invoice_product_list[0]['tax_type']==1){
                    $osgst = '';
                    $ocgst = '';
                    $oigst = $invoice_other_charge_list->taxable_amount*$invoice_other_charge_list->tax_percent/100;
                  }else{
                    $osgst = $invoice_other_charge_list->taxable_amount*$invoice_other_charge_list->tax_percent/100;
                    $ocgst = $invoice_other_charge_list->taxable_amount*$invoice_other_charge_list->tax_percent/100;
                    $oigst = '';
                  }

                  if(isset($arr[$invoice_other_charge_list->tax_percent]))
                  {                    
                    $otblamt = $arr[$invoice_other_charge_list->tax_percent]['taxable_amount']+$invoice_other_charge_list->taxable_amount;
                    $ocgt = $arr[$invoice_other_charge_list->tax_percent]['cgst']+$ocgst;
                    $osgt = $arr[$invoice_other_charge_list->tax_percent]['sgst']+$osgst;
                    $oigt = $arr[$invoice_other_charge_list->tax_percent]['igst']+$oigst;
                    $newdata =  array (
                      'taxable_amount' => $otblamt,
                      'cgst' => $ocgt,
                      'sgst' => $osgt,
                      'igst' => $oigt
                    );

                    $arr[$invoice_other_charge_list->tax_percent] = $newdata;
                  }
                  else
                  {
                    $newdata =  array (
                      'taxable_amount' => $invoice_other_charge_list->taxable_amount,
                      'cgst' => $ocgst,
                      'sgst' => $osgst,
                      'igst' => $oigst
                    );

                    $arr[$invoice_other_charge_list->tax_percent] = $newdata;
                  }

                  ?>
                <tr>
                  <td></td>
                  <td align="center"><?php echo $invoice_other_charge_list->particulars;?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td align="right"><?php echo $invoice_other_charge_list->taxable_amount;?></td>
                  <td align="center"><?php echo $invoice_other_charge_list->tax_percent;?></td>
                  <?php if( $invoice_product_list[0]['tax_type']==1){?> 
                    <td align="right"><?php echo number_format($oigst,2);?></td>
                  <?php }else{?>                    
                    <td align="right"><?php echo number_format($ocgst,2);?></td>                    
                    <td align="right"><?php echo number_format($osgst,2);?></td>
                  <?php }?>
                  <td align="right"><?php echo $invoice_other_charge_list->amount;?></td>
                </tr>
                <?php }?>

                <tr>
                  <td></td>
                  <td align="right">Total</td>
                  <td></td>
                  <td align="center"><?php echo $tqty;?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <?php if( $invoice_product_list[0]['tax_type']==1){?> 
                  <td></td>
                  <?php }else{?>
                  <td></td>
                  <td></td>
                  <?php }?>
                  <td align="right" style="border-bottom: 0; "><b><?php echo number_format($invoice_list->grand_total,2);?></b></td>
                </tr>
              </tbody>
              <tfoot>
                
              </tfoot>
            </table>
          </td>
        </tr>
        <tr>
          <td align="left" colspan="2">Amount Chargeable (in words)</td>
          <td align="right" colspan="4" rowspan="2">E. & O.E</td>
        </tr>
        <tr>
          <td align="left" colspan="2"><p style="margin:0px;text-transform: capitalize;"><?php echo $curcode;?> <?php echo $CI->convertToCurrency(str_replace(',', '', number_format($invoice_list->grand_total, 2)));?></td>
        </tr>
        <tr>
          <td colspan="5">
            <table class="inner_one" width="100%" style="border-collapse: collapse;" border="1px" cellpadding="5">
              <thead>
                <tr>
                  <th align="center" rowspan="2">HSN/SAC</th>
                  <th align="center" rowspan="2">Taxable Value</th>
                  <?php if($invoice_product_list[0]['tax_type']==1){?>  
                    <th align="center" colspan="2">Integrated Tax</th>
                  <?php }else{?> 
                    <th align="center" colspan="2">Central Tax</th>
                    <th align="center" colspan="2">State Tax</th>
                  <?php }?>
                  <th align="center" rowspan="2">Total Tax Amount</th>
                </tr>
                <tr>
                  <?php if($invoice_product_list[0]['tax_type']==1){?>  
                    <th align="center">Rate</th>  
                    <th align="center">Amount</th>
                  <?php }else{?>   
                    <th align="center">Rate</th>  
                    <th align="center">Amount</th>  
                    <th align="center">Rate</th>  
                    <th align="center">Amount</th>
                  <?php }?>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <?php $i=0;$ttax = 0;foreach($arr as $key=>$value){
                  //$ttax+=($value['igst']!=''?$value['igst']:0+$value['cgst']$value['sgst'])?>
                  <tr>
                    <td></td>
                    <td align="right"><?php echo number_format($value['taxable_amount'],2);?></td>
                    <?php if($invoice_product_list[0]['tax_type']==1){?>  
                      <td align="center"><?php echo $key;?></td>  
                      <td align="right"><?php echo number_format($value['igst'],2);?></td>
                      <td align="right"><?php echo number_format($value['igst'],2);?></td>
                    <?php $ttax+=$value['igst'];}else{?>   
                      <td align="center"><?php echo $key;?></td>  
                      <td align="right"><?php echo number_format($value['cgst'],2);?></td>  
                      <td align="center"><?php echo $key;?></td>  
                      <td align="right"><?php echo number_format($value['sgst'],2);?></td>
                      <td aligh="right"><?php echo number_format(($value['cgst']+$value['sgst']),2);?></td>
                    <?php $ttax+=($value['cgst']+$value['sgst']);}?>
                  </tr>
                <?php }?>
              </tfoot>
            </table>
          </td>
        </tr>
        <tr>
          <td align="left" colspan="6">Tax Amount (in words) : <?php echo $curcode;?> <?php echo $CI->convertToCurrency(str_replace(',', '', number_format($ttax, 2)));?></td>
        </tr>
        <tr>
          <td align="left" colspan="6">Company's VAT TIN : <?php echo $exporter_list->vat_tin_no;?></td>
        </tr>
        <tr>
          <td align="left" colspan="6">Company's CST No : <?php echo $exporter_list->cst_no;?></td>
        </tr>
        <tr>
          <td align="left" colspan="6">Buyer's VAT TIN : <?php echo $lead_detail->vat_tin_no;?></td>
        </tr>
        <tr id="content">
          <td align="left" colspan="6">Company's PAN : <?php echo $exporter_list->pan_no;?></td>
        </tr>
        <tr>
          <td colspan="2" style=" border-top: 0;border-bottom: 0;border-right: 0;">
            <p style="margin:0px;"><b>DECLARATION</b></p>
            <p style="margin:0px;">We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p>
          </td>
          <td colspan="3" style=" border-top: 0;border-bottom: 0;text-align:right;">
            <p style="margin-right:100px;height: 100px;"><b>For <?php echo $exporter_list->exporter_name;?></b></p>
            <p style="margin-right:100px;"><b>Authorized Signatory</b></p>
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
    opener.location.href = baseurl+'invoice';
    function printpage()
        {
          var baseurl= $("#baseurl").val(); window.print();window.close(); //window.location.href = baseurl+'workorder';
        }
</script>

</body>
</html>