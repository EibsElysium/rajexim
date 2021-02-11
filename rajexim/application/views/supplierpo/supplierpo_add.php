<?php $this->load->view('common_header'); ?>

            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>supplierpo" class="m-nav__link">
                                 <span class="m-nav__link-text">Supplier PO</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Create Supplier PO</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
                  
                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                      Create Supplier PO
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>supplierpo" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>supplierpo/create_supplierpo" onsubmit="return supplierpo_validation();">
                              <div class="m-portlet__body">
                                 <div class="row">
                                    <input type="hidden" id="locprod">
                                    <!-- <input type="hidden" id="location_id"> -->
                                    <div class="col-lg-12">
                                       <div id="excust">
                                          <fieldset>
                                             <legend class="text-info"><b>Supplier Info</b></legend>
                                             <div class="row">
                                                <div class="col-lg-4">
                                                   <div class="form-group m-form__group">
                                                      <label>Buyer PO<span class="text-danger">*</span></label>
                                                      <!-- <div class="input-group"> -->
                                                         <select class="form-control selectpicker" data-live-search="true" name="buyer_order_id" id="buyer_order_id" onchange="getBPOProduct(this.value);">
                                                            <option value="">Select Buyer PO</option>
                                                            <?php foreach ($buyerpo_list as $value) { ?>
                                                               <option value="<?php echo $value['buyer_order_id']; ?>"><?php echo $value['buyer_order_invoice_no'];?> - <?php echo $value['lead_name'];?></option>
                                                            <?php } ?>
                                                         </select>
                                                         <input type="hidden" id="oid_hidden">
                                                      <span id="buyer_order_id_err" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-4" style="display: none;">
                                                   <div class="form-group m-form__group">
                                                      <label>Product<span class="text-danger">*</span></label>
                                                         <select class="form-control selectpicker" data-live-search="true" name="buyer_order_product_id" id="buyer_order_product_id" onchange="getProduct(this.value);">
                                                            <option value="">Select Product</option>
                                                         </select>
                                                         <input type="hidden" id="pid_hidden">
                                                      <span id="buyer_order_product_id_err" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-4">
                                                   <div class="form-group m-form__group">
                                                      <label>Vendor<span class="text-danger">*</span></label>
                                                         <select class="form-control selectpicker" data-live-search="true" name="vendor_id" id="vendor_id">
                                                            <option value="">Select Vendor</option>
                                                            <?php foreach ($vendor_list as $value) { ?>
                                                               <option value="<?php echo $value['vendor_id']; ?>"><?php echo $value['vendor_name'];?> - <?php echo $value['phone_no'];?></option>
                                                            <?php } ?>
                                                         </select>
                                                      <span id="vendor_id_err" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-4">
                                                   <div class="form-group m-form__group"> 
                                                      <label>Delivery Place<span class="text-danger">*</span></label>
                                                      <input type="text" class="form-control m-input m-input--square" placeholder="Delivery Place" name="delivery_place" id="delivery_place">
                                                      <span id="delivery_place_err" class="text-danger"></span>
                                                   </div>
                                                </div>
                                             </div>

                                             <div class="row"> 
                                                
                                                <div class="col-lg-4">
                                                   <div class="form-group m-form__group">
                                                      <label>End Date<span class="text-danger">*</span></label>
                                                      <input type="text" class="form-control m-input m-input--square m_datepicker_2_modal" placeholder="Enter Order End Date" name="supply_end_date" id="supply_end_date">
                                                      <span class="text-danger" id="supply_end_date_err"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </fieldset>

                                       </div>


                                       <div id="wlprod">
                                         
                                       </div>


                                       <div class="row">                                        
                                          <div class="col-lg-12">
                                             <div class="form-group m-form__group"> 
                                                <label>Terms & Conditions</label>
                                                <textarea class="summernote form-control" id="terms_of_condition" name="terms_of_condition" data-msg="Content is required!"><p>Delivery with in 5 days from the date of  advance  received</p><p>Packing & Quality as per specifications</p><p>50% advance against PO and balance 50% at the time of shipment</p></textarea>
                                                <span id="terms_of_condition_err" class="text-danger"></span>
                                             </div>
                                          </div>
                                       </div>
                                       
                                    </div>
                                 </div>
                              </div>
                              <div class="m-portlet__foot">
                                 <div class="row align-items-center">
                                    <div class="col-lg-12 m--align-right">
                                       <button type="submit" id="add_wl_btn" class="btn btn-primary">Create</button>
                                    </div>
                                 </div>
                              </div>
                              <input type="hidden" id='baseurl' name="baseurl" value="<?php echo base_url();?>">
                              <input type="hidden" id='error' name="error" value="0">
                              <input type="hidden" id='visible_type' name="visible_type" value="hide">
                           </form>
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->
               </div>
            </div>
         </div>

         <!-- end:: Body -->

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->
   
<script src="<?php echo base_url();?>assets/autocomplete-master/jquery.autocomplete.js"></script>
<script src="<?php echo base_url();?>assets/demo/demo12/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>

<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Supplier PO Create';
$(document).attr("title", title); 
$('#supply_end_date').datepicker({ format : 'yyyy/mm/dd', todayHighlight:!0,orientation:"bottom left",templates:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'}});

function getBPOProduct(val)
{
   var baseurl = $('#baseurl').val();
    var oid = $('#oid_hidden').val();
    if(oid == '')
    {
        $('#oid_hidden').val(val);
    }
    else{
        if(oid != val)
        {

            $('#oid_hidden').val(val);
            $('#wlprod').html('');
            $('#buyer_order_product_id').html('<option value="">Select Product</option>');
            $('#pid_hidden').val('');

            alert('PO changed');
        }
        else{
             $('#oid_hidden').val(val);
        }
    }
    $.ajax({
        type: "POST",
        url: baseurl+'supplierpo/getBPOProduct',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
            $('#wlprod').empty().append(response);
            // $('#wlprod').selectpicker('refresh');
        }
    });
}

function getProduct(val)
{
  var baseurl = $('#baseurl').val();
    var pid = $('#pid_hidden').val();
    var poid = $('#buyer_order_id').val();
    if(pid == '')
    {
        $('#pid_hidden').val(val);
    }
    else{
        if(pid != val)
        {

            $('#pid_hidden').val(val);

            alert('Product changed');
        }
        else{
             $('#pid_hidden').val(val);
        }
    }

    $.ajax({
        type: "POST",
        url: baseurl+'supplierpo/getProduct',
        async: false,
        type: "POST",
        data: "poid="+poid+"&prodId="+val,
        dataType: "html",
        success: function(response)
        {
            $('#wlprod').html(response);
        }
    });
}

function isNumberKey(evt, obj)
{ 
    var charCode = (evt.which) ? evt.which : event.keyCode
    var value = obj.value;
    var dotcontains = value.indexOf(".") != -1;
    if (dotcontains)
        if (charCode == 46) return false;
    if (charCode == 46) return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function getAmount(rate,i)
{
  var qty = $('#quantity'+i).val();
  var amt = parseFloat(qty)*parseFloat(rate);
  $('#amount'+i).val(amt.toFixed('2'));

  var totamt = 0;

  $("input[id^='amount']").each(function(){
    var id = this.id;
    var res = id.substring(6);

    totamt = parseFloat(totamt)+parseFloat($('#'+id).val());
  });

  $('#total_amount').val(totamt.toFixed('2'));
}

function supplierpo_validation(){

  var err = 0;
  var sid = $('#vendor_id').val();
  var bpo = $('#buyer_order_id').val();
  var dplace = $('#delivery_place').val();
  var sedate = $('#supply_end_date').val();
  

  if(sid=='')
  {
    $('#vendor_id_err').html('Choose Vendor!');
    err++;
  }
  else
  {
    $('#vendor_id_err').html('');
  }

  if(bpo=='')
  {
    $('#buyer_order_id_err').html('Choose Buyer PO!');
    err++;
  }
  else
  {
    $('#buyer_order_id_err').html('');
  }

  if(dplace=='')
  {
    $('#delivery_place_err').html('Delivery Place is Required!');
    err++;
  }
  else
  {
    $('#delivery_place_err').html('');
  }
  if(sedate == '') {
    $('#supply_end_date_err').html("End Date is required!");
    err++;
  }
  else {
    $('#supply_end_date_err').html("");
  }

$("div[id^='mid']").each(function(){
  var id = this.id;
  var res = id.substring(3);

  var product = $('#product'+res).val();
  var rate = $('#rate'+res).val();
  var qty = $('#quantity'+res).val();
  var rqty = $('#reqqty'+res).val();

  var odate = $('#order_end_date').val();

  // alert(odate);
  var sdt = sedate.split('/');
  // var st = sdt[2]+'-'+sdt[0]+'-'+sdt[1];
  var st = sdt[0]+'-'+sdt[1]+'-'+sdt[2];

  var odt = odate.split('/');
  var ot = odt[0]+'-'+odt[1]+'-'+odt[2];
  var spo_date = new Date(st); //dd-mm-YYYY
  var bo_date = new Date(ot);
  // alert('spo date '+spo_date);
  // alert('Bo date '+bo_date);

  if(spo_date>=bo_date)
  {
    // alert('yes');
    $('#supply_end_date_err').html('Invalid Date!');
    err++;
  }
  else
  {
    // alert('no');
    $('#supply_end_date_err').html('');
  }

  if (product == '') {
    $('#product_err'+res).html('Product is required!');
    err++;
  }
  else {
    $('#product_err'+res).html('');
  }

  if(parseFloat(qty)>parseFloat(rqty))
  {
    $('#quantity_err'+res).html('Invalid Quantity');
    err++;
  }
  else
  {
    $('#quantity_err'+res).html('');
  }

  if(rate=='' || rate==0){
    $('#rate_err'+res).html('Rate is required!');
    err++;
  }else{
    $('#rate_err'+res).html('');
  }
});

if(err>0){ return false; }else{ $('#add_wl_btn').attr("disabled","disabled");return true; }
} 

var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

$("#del_date").datepicker({
  todayHighlight: !0,
    startDate: today // set the minDate to the today's date
    // you can add other options here
});



</script>
</body>
   <!-- end::Body -->
</html>