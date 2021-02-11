<?php $this->load->view('common_header'); ?>

            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon la la-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Settings</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Vendor</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>vendor" class="m-nav__link">
                                 <span class="m-nav__link-text">Vendor List</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Create Vendor</span>
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
                                       Create Vendor
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>vendor" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>

                           <form name="vendor_add_form" method="POST" action="<?php echo base_url(); ?>vendor/create_vendor" onsubmit="return vendor_validation();">
                              <div class="m-portlet__body">
                                 <h5 class="text-theme"><b>Vendor Info</b></h5><hr>
                                 <div class="row">
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Category<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="vendor_category_id" id="vendor_category_id"> 
                                             <option value="">Choose Category</option>
                                             <?php
                                                if(!empty($vendor_category_list))
                                                {
                                                   foreach ($vendor_category_list as $vflist) { ?>
                                                      <option value="<?php echo $vflist['vendor_category_id']; ?>"><?php echo $vflist['vendor_category']; ?></option>
                                                   <?php }
                                                }
                                             ?>
                                          </select>
                                          <span class="text-danger" id="vendor_category_id_err"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Type<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="vendor_type_id" id="vendor_type_id"> 
                                             <option value="">Choose Type</option>
                                             <?php
                                                if(!empty($vendor_type_list))
                                                {
                                                   foreach ($vendor_type_list as $vflist) { ?>
                                                      <option value="<?php echo $vflist['vendor_type_id']; ?>"><?php echo $vflist['vendor_type']; ?></option>
                                                   <?php }
                                                }
                                             ?>
                                          </select>
                                          <span class="text-danger" id="vendor_type_id_err"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Vendor Name<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Vendor Name"  name="vendor_name" id="vendor_name" maxlength="100">
                                          <span class="text-danger" id="vendor_name_err"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>GST No</label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter GST No"  name="gst_no" id="gst_no" maxlength="100">
                                          <span class="text-danger" id="gst_no_err"></span>
                                       </div>
                                    </div>
                                 </div>                                 
                                 <div class="row">
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Phone No<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Phone No"  name="phone_no" id="phone_no" maxlength="100" onkeyup="checkUniqueVendor();">
                                          <span class="text-danger" id="phone_no_err"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Email Id</label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email Id"  name="email_id" id="email_id" onkeyup="checkUniqueVendorEmail();" maxlength="100">
                                          <span class="text-danger" id="email_id_err"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Website</label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Website"  name="website" id="website" maxlength="100">
                                          <span class="text-danger" id="website_err"></span>
                                       </div>
                                    </div>
                                 </div>
                                 <h5 class="text-theme"><b>Vendor Address</b></h5><hr>  
                                 <div id="vendor_address_append">
                                    <div id="vendor_address_block_1">                               
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>Address Type<span class="text-danger">*</span></label>
                                                <select class="form-control" id="address_type_1" name="address_type[]">
                                                   <option value="">Choose Address Type</option>
                                                   <?php foreach ($addresstypes as $key => $addrtype) { ?>
                                                      <option value="<?php echo $addrtype->address_type_id; ?>"><?php echo $addrtype->address_type; ?></option>
                                                   <?php } ?>
                                                </select>
                                                <span class="text-danger" id="address_type_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>Street</label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Street"  name="street[]" id="street_1" maxlength="100">
                                                <span class="text-danger" id="street_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>City<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter City"  name="city[]" id="city_1" maxlength="100">
                                                <span class="text-danger" id="city_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>State<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter State"  name="state[]" id="state_1" maxlength="100">
                                                <span class="text-danger" id="state_err_1"></span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>Country<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Country"  name="country[]" id="country_1" maxlength="100">
                                                <span class="text-danger" id="country_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-4">
                                             <div class="form-group m-form__group">
                                                <label>Postal Code</label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Postal Code"  name="postal_code[]" id="postal_code_1" maxlength="100">
                                                <span class="text-danger" id="postal_code_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-3"></div>
                                          <div class="col-lg-1">
                                             <div class="pull-right">
                                                <div class="form-group m-form__group mt_25px">
                                                  <button type="button" class="btn btn-primary" onclick="vendor_address_add_row();"><i class="fa fa-plus"></i></button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    
                                    <input type="hidden" name="vendor_address_inc_count" id="vendor_address_inc_count" value="2">
                                 </div>
                                 <h5 class="text-theme"><b>Vendor Contact Details</b></h5><hr> 
                                 <div id="contact_person_append">                               
                                    <div class="row" id="contact_person_block_1">
                                       <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Contact Person Name</label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Name"  name="contact_person_name[]" id="contact_person_name_1" maxlength="100">
                                             <span class="text-danger" id="contact_person_name_err_1"></span>
                                          </div>
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Contact Person Email</label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Email"  name="contact_person_email[]" id="contact_person_email_1" maxlength="100">
                                             <span class="text-danger" id="contact_person_email_err_1"></span>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="form-group m-form__group">
                                             <label>Contact Person Phone</label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Phone"  name="contact_person_phone[]" id="contact_person_phone_1" maxlength="100">
                                             <span class="text-danger" id="contact_person_phone_err_1"></span>
                                          </div>
                                       </div>

                                       <div class="col-lg-1">
                                          <div class="pull-right">
                                             <div class="form-group m-form__group mt_25px">
                                               <button type="button" class="btn btn-primary" onclick="contact_person_add_row();"><i class="fa fa-plus"></i></button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>      
                                 </div>  
                                 <input type="hidden" name="contact_person_inc_count" id="contact_person_inc_count" value="2">                          
                                 <h5 class="text-theme"><b>Vendor Product</b></h5><hr>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group m-form__group">
                                          <label>Product<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" multiple data-live-search="true" name="vendor_product[]" id="vendor_product"> 
                                             <option value="">Choose Product</option>
                                             <?php
                                                if(!empty($product_list))
                                                {
                                                   foreach ($product_list as $vflist) { ?>
                                                      <option value="<?php echo $vflist['product_id']; ?>"><?php echo $vflist['product_name']; ?></option>
                                                   <?php }
                                                }
                                             ?>
                                          </select>
                                          <span class="text-danger" id="vendor_product_err"></span>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="m-portlet__foot">
                                 <div class="row align-items-center">
                                    <div class="col-lg-12 m--align-right">
                                       <button type="submit" id="add_so_btn" class="btn btn-primary">Create</button>
                                       <!-- <button type="reset" class="btn btn-default">Cancel</button> -->
                                    </div>
                                 </div>
                              </div>
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

      <!-- end::Scroll Top -->
      <!--begin::Modal-->
      <!-- Create Lead Status-->
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Create Vendor';
$(document).attr("title", title); 

var expo = 0;
function checkUniqueVendor()
{
   var val = $('#phone_no').val();
   $.ajax({
      type:"POST",
      url:baseurl+'vendor/checkUniqueVendor',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#phone_no_err').html('Vendor already exists!');
            //$('#btnSubmit').prop('disabled', true);
            expo = 1;
         }
         else
         {
            $('#phone_no_err').html('');
            //$('#btnSubmit').prop('disabled', false);
            expo = 0;
         }
      }
   });
}
var eexpo = 0;
function checkUniqueVendorEmail()
{
   var val = $('#email_id').val();
   $.ajax({
      type:"POST",
      url:baseurl+'vendor/checkUniqueVendorEmail',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#email_id_err').html('Vendor Email already exists!');
            //$('#btnSubmit').prop('disabled', true);
            eexpo = 1;
         }
         else
         {
            $('#email_id_err').html('');
            //$('#btnSubmit').prop('disabled', false);
            eexpo = 0;
         }
      }
   });
}

function vendor_validation()
{
   var err = 0;
   var vcat = $('#vendor_category_id').val();
   var vtype = $('#vendor_type_id').val();
   var vname = $('#vendor_name').val();
   var pno = $('#phone_no').val();
   var eid = $('#email_id').val();

   var vprod = $('#vendor_product').val();
   var website = $('#website').val();

   if(website != '' && !isUrlValid(website))
   {
       $('#website_err').html('Valid Website is required!');
       err++;
   }else{
      $('#website_err').html('');
   } 
   if(vcat=='')
   {
      $('#vendor_category_id_err').html('Choose Category!');
      err++;
   }
   else
   {
      $('#vendor_category_id_err').html('');
   }

   if(vtype=='')
   {
      $('#vendor_type_id_err').html('Choose Type!');
      err++;
   }
   else
   {
      $('#vendor_type_id_err').html('');
   }

   if(vname=='')
   {
      $('#vendor_name_err').html('Vendor Name is required!');
      err++;
   }
   else
   {
      $('#vendor_name_err').html('');
   }

   if(pno == '')
   {
      $('#phone_no_err').html('Phone No is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#phone_no_err').html('Vendor already exists!');
         err++;
      }
      else
      {
         $('#phone_no_err').html('');
      }
   }

   if(eid=='')
   {
      // $('#email_id_err').html('Email Id is required!');
      // err++;
   }
   else
   {
      // var test = ValidateEmail(email_id);
      // alert(test);
      if(!ValidateEmail(eid)){ 
        $('#email_id_err').html('Invalid Email ID!');
        err++;
      }
      else if(eexpo == 1) {
         $('#email_id_err').html('Vendor Email already exists!');
         err++;
      }
      else {
         $('#email_id_err').html('');
      }
   }

   
   if(vprod=='')
   {
      $('#vendor_product_err').html('Choose Product!');
      err++;
   }
   else
   {
      $('#vendor_product_err').html('');
   }
   $('select[id^="address_type_"]').each(function(){
      var id = this.id;
      var pro_id = id.substring(13);
      var address_type = $('#address_type_'+pro_id+'').val();
      var city = $('#city_'+pro_id+'').val();
      var state = $('#state_'+pro_id+'').val();
      var ctry = $('#country_'+pro_id+'').val();

      if (address_type == '') {
         $('#address_type_err_'+pro_id).html('Address Type is required!');
         err++;
      }
      else {
         $('#address_type_err_'+pro_id).html('');
      }

      if (city == '') {
         $('#city_err_'+pro_id).html('City is required!');
         err++;
      }
      else {
         $('#city_err_'+pro_id).html('');
      }

      if (state == '') {
         $('#state_err_'+pro_id).html('State is required!');
         err++;
      }
      else {
         $('#state_err_'+pro_id).html('');
      }

      if (ctry == '') {
         $('#country_err_'+pro_id).html('Country is required!');
         err++;
      }
      else {
         $('#country_err_'+pro_id).html('');
      }

   });
   if(err> 0){ return false;}else{ return true; }   
}
function contact_person_add_row()
{
  var cp_inc = $('#contact_person_inc_count').val();
  $('#contact_person_append').append('<div class="row" id="contact_person_block_'+cp_inc+'"><div class="col-lg-4"><div class="form-group m-form__group"><label>Contact Person Name</label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Name"  name="contact_person_name[]" id="contact_person_name_'+cp_inc+'" maxlength="100"> <span class="text-danger" id="contact_person_name_err_'+cp_inc+'"></span> </div></div><div class="col-lg-4"><div class="form-group m-form__group"><label>Phone</label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Email"  name="contact_person_email[]" id="contact_person_email_'+cp_inc+'" maxlength="100"><span class="text-danger" id="contact_person_email_err_'+cp_inc+'"></span></span> </div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Email</label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Phone"  name="contact_person_phone[]" id="contact_person_phone_'+cp_inc+'" maxlength="100"><span class="text-danger" id="contact_person_phone_err_'+cp_inc+'"></span> </div></div><div class="col-lg-1"><div class="pull-right"><div class="form-group m-form__group mt_25px"><button type="button" class="btn btn-danger" onclick="contact_person_rmv_row('+cp_inc+');"><i class="fa fa-minus"></i></button> </div></div></div></div>');

  cp_inc = Number(cp_inc) + 1;
  $('#contact_person_inc_count').val(cp_inc);
}
function contact_person_rmv_row(lid)
{
  $('#contact_person_block_'+lid).remove();
}

function vendor_address_add_row() {
   var va_inc = $('#vendor_address_inc_count').val();
   $('#vendor_address_append').append('<div id="vendor_address_block_'+va_inc+'"> <div class="row"> <div class="col-lg-3"><div class="form-group m-form__group"> <label>Address Type<span class="text-danger">*</span></label><select class="form-control" id="address_type_'+va_inc+'" name="address_type[]"><option value="">Choose Address Type</option> <?php foreach ($addresstypes as $key => $addrtype) { ?><option value="<?php echo $addrtype->address_type_id; ?>"><?php echo $addrtype->address_type; ?></option> <?php } ?></select><span class="text-danger" id="address_type_err_'+va_inc+'"></span></div></div><div class="col-lg-3"> <div class="form-group m-form__group"> <label>Street</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Street" name="street[]" id="street_'+va_inc+'" maxlength="100"> <span class="text-danger" id="street_err_'+va_inc+'"></span> </div> </div> <div class="col-lg-3"> <div class="form-group m-form__group"> <label>City<span class="text-danger">*</span></label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter City" name="city[]" id="city_'+va_inc+'" maxlength="100"> <span class="text-danger" id="city_err_'+va_inc+'"></span> </div> </div> <div class="col-lg-3"> <div class="form-group m-form__group"> <label>State<span class="text-danger">*</span></label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter State" name="state[]" id="state_'+va_inc+'" maxlength="100"> <span class="text-danger" id="state_err_'+va_inc+'"></span> </div> </div> </div> <div class="row"> <div class="col-lg-3"> <div class="form-group m-form__group"> <label>Country<span class="text-danger">*</span></label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Country" name="country[]" id="country_'+va_inc+'" maxlength="100"> <span class="text-danger" id="country_err_'+va_inc+'"></span> </div> </div> <div class="col-lg-4"> <div class="form-group m-form__group"> <label>Postal Code</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Postal Code" name="postal_code[]" id="postal_code_'+va_inc+'" maxlength="100"> <span class="text-danger" id="postal_code_err_'+va_inc+'"></span> </div> </div> <div class="col-lg-3"></div> <div class="col-lg-1"> <div class="pull-right"> <div class="form-group m-form__group mt_25px"> <button type="button" class="btn btn-danger" onclick="vendor_address_rmv_row('+va_inc+');"><i class="fa fa-minus"></i></button> </div> </div> </div> </div> </div>');

  va_inc = Number(va_inc) + 1;
  $('#vendor_address_inc_count').val(va_inc);
}
function vendor_address_rmv_row(lid)
{
   $('#vendor_address_block_'+lid).remove();
}
</script>
</body>
   <!-- end::Body -->
</html>