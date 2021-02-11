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
    margin-bottom: 75mm; /* must be larger than largest paper size you support */
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
          <th style="border-right: 0;">
            <img src="<?php echo base_url(); ?>exporterlogo/<?php echo str_replace(' ', '_',$exporter_list->exporter_logo); ?>" height="100" width="200" alt="logo" style="object-fit: contain;">
          </th>
          <th colspan="2" style="text-align: left;text-transform: uppercase;vertical-align: middle;border-left: 0;vertical-align: bottom;font-family: 'TimesNewRoman';border-right: 0;">
            <h1><b>PROFORMA NVOICE</b></h1>
          </th>
        </tr>
        <tr>
          <td rowspan="3" colspan="2" width="50%">
            <div>
              <p style="text-align: left;margin:0px;"><b>Exporter</b></p>
              <p style="margin:0px;"><?php echo $exporter_list->exporter_name;?></p>
              <p style="margin:0px;"><?php echo $exporter_list->exporter_address;?></p>
            </div>
          </td>
          <td colspan="4" width="50%">
            <p style="text-align: left;margin:0px;"><b>Proforma Invoice No</b>:&nbsp;<?php echo $proforma_invoice_no;?></p>
            <p style="text-align: left;margin:0px;"><b>Date</b>:&nbsp;<?php echo date($date_format, strtotime($proformainvoice_list->proforma_invoice_date)); ?></p>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p style="text-align: left;margin:0px;"><b>Buyer's Confirmation Date</b>:&nbsp;<?php echo date($date_format, strtotime($proformainvoice_list->buyer_confirmation_date)); ?></p>
            <p style="text-align: left;margin:0px;"><b>Other References</b>:&nbsp;<?php echo $proformainvoice_list->other_reference;?></p>    
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p style="text-align: left;margin:0px;"><b>IEC No</b>:&nbsp;<?php echo $iec_no;?></p>
            <p style="text-align: left;margin:0px;"><b>GST No</b>:&nbsp;<?php echo $gst_no;?></p>     
          </td>
        </tr>
        <tr>
          <td rowspan="2" colspan="2">
            <p style="text-align: left;margin:0px;"><b>Consignee</b></p>
            <div>
              <p style="margin:0px;text-transform: uppercase;"><?php echo $lead_detail->company_name;?> <br><?php echo $lead_detail->country_name;?></p>
              <!-- <p style="margin:0px;text-transform: uppercase;"><?php //echo $lead_detail->contact_no!=''?$lead_detail->contact_no:'';?></p> -->
            </div>  
          </td>
          <th>
            Country of origin of Goods
          </th>
          <th>
            Country of Final Destination
          </th>
        </tr>
        <tr>
          <td align="center"><b><?php echo strtoupper($proformainvoice_list->polcountry);?></b></td>
          <td align="center"><b><?php echo strtoupper($proformainvoice_list->fdcountry);?></b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <p style="text-align: center;margin:0px;"><b>Pre-carriage By</b></p>
            <p style="text-align: center;margin:0px;"><?php echo $proformainvoice_list->pre_carriage_by;?></p>
          </td>
          <td>
            <p style="text-align: center;margin:0px;"><b>Place of Receipt By carrier</b></p>
            <p style="text-align: center;margin:0px;"><?php echo $proformainvoice_list->place_of_receipt_by_pre_carrier;?></p>
          </td>
          <td colspan="2">
            <p style="text-align: center;margin:0px;"><b>Terms & Payment</b></p>
          </td>
        </tr>
        <tr>
          <td>
            <p style="text-align: center;margin:0px;"><b>Vessel/Flight</b></p>
            <p style="text-align: center;margin:0px;"><?php echo $proformainvoice_list->vessel_flight_name!=''?$proformainvoice_list->vessel_flight_name:'-';?></p>
          </td>
          <td>
            <p style="text-align: center;margin:0px;"><b>Port Of Loading</b></p>
            <p style="text-align: center;margin:0px;"><?php echo $proformainvoice_list->polname;?> - <?php echo $proformainvoice_list->polcountry;?></p>
          </td>
          <td colspan="2">
            <p style="text-align: center;margin:0px;">
              <?php echo $terms_and_payment_value;?>
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <p style="text-align: center;margin:0px;"><b>Port of Dis-charge</b></p>
            <p style="text-align: center;margin:0px;"><?php echo $proformainvoice_list->podname;?> - <?php echo $proformainvoice_list->podcountry;?></p>
          </td>
          <td>
            <p style="text-align: center;margin:0px;"><b>Final Destination</b></p>
            <p style="text-align: center;margin:0px;"><?php echo $proformainvoice_list->fdname;?> - <?php echo $proformainvoice_list->fdcountry;?></p>
          </td>
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
                  <th align="center">Amount in <?php echo $curcode;?></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; $spec = '';foreach($proformainvoice_product_list as $qprod){
                  $dispname = $this->Productcosting_model->get_display_name_by_product_item_display_name_id($qprod['product_item_display_name_id']);
                  $dname = $dispname->display_name;?>
                <tr>
                  <td align="center"><?php echo $qprod['marks_and_no'];?></td>
                  <td align="left"><?php echo $dname;?></td>
                  <td align="center"><?php echo $qprod['quantity'];?> <?php echo $qprod['product_unit'];?></td>
                  <td align="right"><?php echo number_format($qprod['rate'],2);?></td>
                  <td align="right"><?php echo number_format($qprod['amount'],2);?></td>
                </tr>
                <?php $i++; $spec.="<u>".$dname."</u><br>".$qprod['specification']."<br><br>";}?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3" style="border-bottom: 0; ">
                    <p style="text-align: left;margin:0px;"><b>Amount Chargeable</b> in <?php echo $curcode;?> :</p>
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
          <td colspan="2">
            <p style="text-align: left;margin:0px;text-transform: capitalize;"><b>Specification & Packing Details</b>:</p>
            <p style="font-family: 'Courier New';">
              <?php //echo $proformainvoice_list->specification_packing_details;?>
              <?php echo $spec;?>
            </p>      
          </td>
          <td colspan="2">
            <p style="text-align: left;margin:0px;text-transform: capitalize;"><b>Load Ability</b>:</p>
            <p style="font-family: 'Courier New';">
              <?php echo $proformainvoice_list->loadability;?>
            </p>  
            <p style="text-align: left;margin:0px;text-transform: capitalize;"><b>Price Validity</b>:</p>
            <p style="font-family: 'Courier New';">
              <?php echo $proformainvoice_list->price_validity;?>
            </p>  
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p style="margin:2px;text-transform: uppercase;border-bottom: 1px solid #ccc;"><b>Bank Details</b></p>
            <p style="margin:2px;"><u>Beneficiary Bank</u></p>
            <p style="margin:2px;"><?php echo $bank_detail->bank_detail;?></p>   
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p style="margin:2px;text-transform: uppercase;border-bottom: 1px solid #ccc;"><b>Terms of Payment</b></p>  
            <p style="margin:2px;"><?php echo $terms_of_payment_text;?></p>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p style="margin:2px;text-transform: uppercase;border-bottom: 1px solid #ccc;"><b>Arbitration</b></p>
            <p style="font-family: 'Courier New';">
              <?php echo $arbitration_text;?>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p style="margin:2px;text-transform: uppercase;border-bottom: 1px solid #ccc;"><b>Interest</b></p>  
            <p style="font-family: 'Courier New';">
              <?php echo $interest_text;?>
            </p>  
          </td>
        </tr>
        <tr>
          <td colspan="4" style="border-bottom: 0;">
              <p style="margin:2px;"><b>Declaration</b></p>
              <p style="margin:0px;padding: 0"><?php echo $declaration;?></p>    
          </td>
        </tr>
        <tr>
          <td colspan="2" style=" border-top: 0;border-bottom: 0;border-right: 0;">
            <p style="margin:0px;height: 100px;"><b>For <?php echo $exporter_list->exporter_name;?></b></p>
            <p style="margin:0px;"><b>Authorized Signatory</b></p>
          </td>
          <td colspan="2" style=" border-top: 0;border-bottom: 0;border-left: 0;text-align:right;">
            <p style="margin-right:100px;height: 100px;"><b>For <?php echo $lead_detail->company_name;?></b></p>
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
    opener.location.href = baseurl+'proformainvoice';
    function printpage()
    {
      var baseurl= $("#baseurl").val(); window.print();window.close(); 
      // window.location.href = baseurl+'workorder';
    }
</script>

</body>
</html>