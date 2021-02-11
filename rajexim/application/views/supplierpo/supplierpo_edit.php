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
                                 <span class="m-nav__link-text">Edit Supplier PO</span>
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
                                      Edit Supplier PO - <?php echo $supplierpo_list->supplier_purchase_order_no;?>
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
                           <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>supplierpo/update_supplierpo" onsubmit="return supplierpo_validation();">
                    <input type="hidden" id="supplier_purchase_order_id" name="supplier_purchase_order_id" value="<?php echo $supplierpo_list->supplier_purchase_order_id;?>">
                    <div class="m-portlet__body">
                      <div class="row">
                        <input type="hidden" id="locprod">
                      <div class="col-lg-12">
                        <div id="excust">
                          <fieldset>
                            <legend class="text-info"><b>Supplier Info</b></legend>
                            <div class="row">
                              <div class="col-lg-4">
                                <div class="form-group m-form__group">
                                  <label>Buyer PO<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Buyer PO" name="buyer_po" id="buyer_po" value="<?php echo $supplierpo_list->buyer_order_invoice_no." - ".$supplierpo_list->lead_name;?>" readonly>
                                    <input type="hidden" id="buyer_order_id" name="buyer_order_id" value="<?php echo $supplierpo_list->buyer_order_id;?>"> 
                                   <span id="buyer_order_id_err" class="text-danger"></span>
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group m-form__group">
                                  <label>Supplier<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Supplier" name="supplier_name" id="supplier_name" value="<?php echo $supplierpo_list->vendor_name;?>" readonly>
                                    <input type="hidden" id="vendor_id" name="vendor_id" value="<?php echo $supplierpo_list->vendor_id;?>">
                                  <span id="vendor_id_err" class="text-danger"></span>
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group m-form__group">  
                                  <label>Delivery Place<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control m-input m-input--square" placeholder="Delivery Place" name="delivery_place" id="delivery_place" value="<?php echo $supplierpo_list->delivery_place;?>">
                                  <span id="delivery_place_err" class="text-danger"></span>
                                </div>
                              </div>
                            </div>

                            <div class="row">                               
                              <div class="col-lg-4">
                                <div class="form-group m-form__group">
                                  <label>End Date<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control m-input m-input--square m_datepicker_2_modal" placeholder="Enter Order End Date" name="supply_end_date" id="supply_end_date" value="<?php echo date('Y/m/d', strtotime($supplierpo_list->supply_end_date)); ?>">
                                  <span class="text-danger" id="supply_end_date_err"></span>
                                </div>
                              </div>
                            </div>

                            <input type="hidden" id="order_end_date" name="order_end_date" value="<?php echo date('Y/m/d', strtotime($supplierpo_list->order_end_date)); ?>">
                          </fieldset>
                        </div>


                        <div id="wlprod">

                          <fieldset>
                            <legend class="text-info"><b>Product Info</b></legend>
                              <div id="mcontent10">
                                <?php $i=0;foreach($supplierpo_product_details as $wprod){

                                  ?>
                                  <input type="hidden" id="supplier_purchase_order_product_id<?php echo $i;?>" name="supplier_purchase_order_product_id[]" value="<?php echo $wprod['supplier_purchase_order_product_id'];?>">
                                <div class="row" id="mid<?php echo $i;?>">                            
                                  <div class="col-lg-4">
                                    <div class="form-group m-form__group">  
                                      <label>Product<span class="text-danger">*</span></label>
                                      <input type="text" class="form-control m-input m-input--square" placeholder="Product Name" name="product_name[]" id="product_name<?php echo $i;?>" readonly value="<?php echo $wprod['product_name'].' - '.$wprod['product_item'];?>">
                                      <input type="hidden" class="form-control m-input m-input--square" name="product_id[]" id="product_id<?php echo $i;?>" value="<?php echo $wprod['product_item_id'];?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-2">
                                    <div class="form-group m-form__group">  
                                      <label>Quantity</label>
                                      <input type="text" class="form-control m-input m-input--square" placeholder="Quantity" name="quantity[]" id="quantity<?php echo $i;?>" readonly value="<?php echo $wprod['quantity'];?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-2">
                                    <div class="form-group m-form__group">  
                                      <label>Rate<span class="text-danger">*</span></label>
                                      <input type="text" class="form-control m-input m-input--square" placeholder="Rate/quantity" name="rate[]" id="rate<?php echo $i;?>" value="<?php echo $wprod['rate'];?>" onkeypress="return isNumberKey(event,this);" onfocus="this.select();" onkeyup="getAmount(this.value,<?php echo $i;?>)">
                                      <span id="rate_err<?php echo $i;?>" class="text-danger"></span>
                                    </div>
                                  </div>
                                  <div class="col-lg-2">
                                    <div class="form-group m-form__group">  
                                      <label>Amount</label>
                                      <input type="text" class="form-control m-input m-input--square" placeholder="Amount" name="amount[]" id="amount<?php echo $i;?>" readonly value="<?php echo $wprod['amount'];?>">
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                <?php $i++;}?>
                                <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $wprod['total_amount'];?>">
                              </div>
                          </fieldset>

                        </div>


                        <div class="row">                           
                          <div class="col-lg-12">
                            <div class="form-group m-form__group">  
                              <label>Terms & Conditions</label>
                              <textarea class="snote form-control" id="terms_of_condition" name="terms_of_condition" data-msg="Content is required!"><?php echo $supplierpo_list->terms_of_condition;?></textarea>
                                <span id="terms_of_condition_err" class="form-control-feedback err_msg"></span>
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
                        <button type="submit" id="add_wl_btn" class="btn btn-primary">Save Changes</button>
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
var title = $('title').text() + ' | ' + 'Supplier PO Edit';
$('.snote').summernote('lineHeight', 0);
$(document).attr("title", title); 
$('#supply_end_date').datepicker({ format : 'yyyy/mm/dd', todayHighlight:!0,orientation:"bottom left",templates:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'}});

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


$("div[id^='mid']").each(function(){
  var id = this.id;
  var res = id.substring(3);

  var rate = $('#rate'+res).val();
  var qty = $('#quantity'+res).val();
  var rqty = $('#reqqty'+res).val();

  var odate = $('#order_end_date').val();

  var sdt = sedate.split('/');
  var st = sdt[2]+'-'+sdt[0]+'-'+sdt[1];

  var odt = odate.split('/');
  var ot = odt[0]+'-'+odt[1]+'-'+odt[2];
  var spo_date = new Date(st); //dd-mm-YYYY
  var bo_date = new Date(ot);
  
  if(spo_date>=bo_date)
  {
    $('#supply_end_date_err').html('Invalid Date!');
    err++;
  }
  else
  {
    $('#supply_end_date_err').html('');
  }

  if(qty>rqty)
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