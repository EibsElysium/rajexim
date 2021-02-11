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
                                 <span class="m-nav__link-text">Edit Vendor</span>
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
                                       Edit Vendor
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

                           <form name="vendor_edit_form" method="POST" action="<?php echo base_url(); ?>vendor/update_vendor" onsubmit="return vendor_validation();">
                              <input type="hidden" id="vendor_id" name="vendor_id" value="<?php echo $vendor_details->vendor_id;?>">
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
                                                      <option value="<?php echo $vflist['vendor_category_id']; ?>" <?php echo $vflist['vendor_category_id']==$vendor_details->vendor_category_id?'selected':'';?>><?php echo $vflist['vendor_category']; ?></option>
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
                                                      <option value="<?php echo $vflist['vendor_type_id']; ?>" <?php echo $vflist['vendor_type_id']==$vendor_details->vendor_type_id?'selected':'';?>><?php echo $vflist['vendor_type']; ?></option>
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
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Vendor Name"  name="vendor_name" id="vendor_name" maxlength="100" value="<?php echo $vendor_details->vendor_name;?>">
                                          <span class="text-danger" id="vendor_name_err"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>GST No</label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter GST No"  name="gst_no" id="gst_no" maxlength="100" value="<?php echo $vendor_details->gst_no;?>">
                                          <span class="text-danger" id="gst_no_err"></span>
                                       </div>
                                    </div>
                                 </div>                                 
                                 <div class="row">
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Phone No<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Phone No"  name="phone_no" id="phone_no" maxlength="100" onkeyup="checkUniqueVendorEdit();" value="<?php echo $vendor_details->phone_no;?>">
                                          <span class="text-danger" id="phone_no_err"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Email Id</label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email Id"  name="email_id" id="email_id" maxlength="100" value="<?php echo $vendor_details->email_id;?>">
                                          <span class="text-danger" id="email_id_err"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Website</label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Website"  name="website" id="website" maxlength="100" value="<?php echo $vendor_details->website;?>">
                                          <span class="text-danger" id="website_err"></span>
                                       </div>
                                    </div>
                                 </div>
                                 <h5 class="text-theme"><b>Vendor Address</b></h5><hr>  

                                 <div id="vendor_address_append">
                                    <?php 
                                    if(count($vendor_addresses) > 0) {
                                       $i=1;
                                       foreach ($vendor_addresses as $key => $ven_addr) { ?>
                                    <div id="vendor_address_block_<?php echo $i; ?>">    
                                       <input type="hidden" name="vendor_address_id[]" value="<?php echo $ven_addr->vendor_address; ?>">                           
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>Address Type<span class="text-danger">*</span></label>
                                                <select class="form-control" id="address_type_1" name="address_type[]">
                                                   <option value="">Choose Address Type</option>
                                                   <?php foreach ($addresstypes as $key => $addrtype) { ?>
                                                      <option <?php echo ($ven_addr->address_type_id == $addrtype->address_type_id) ? 'selected' : ''; ?> value="<?php echo $addrtype->address_type_id; ?>"><?php echo $addrtype->address_type; ?></option>
                                                   <?php } ?>
                                                </select>
                                                <span class="text-danger" id="address_type_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>Street</label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Street"  name="street[]" id="street_1" maxlength="100" value="<?php echo $ven_addr->street; ?>">
                                                <span class="text-danger" id="street_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>City<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter City"  name="city[]" id="city_1" maxlength="100" value="<?php echo $ven_addr->city; ?>">
                                                <span class="text-danger" id="city_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>State<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter State"  name="state[]" id="state_1" maxlength="100" value="<?php echo $ven_addr->state; ?>">
                                                <span class="text-danger" id="state_err_1"></span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <div class="form-group m-form__group">
                                                <label>Country<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Country"  name="country[]" id="country_1" maxlength="100" value="<?php echo $ven_addr->country; ?>">
                                                <span class="text-danger" id="country_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-4">
                                             <div class="form-group m-form__group">
                                                <label>Postal Code</label>
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Postal Code"  name="postal_code[]" id="postal_code_1" maxlength="100" value="<?php echo $ven_addr->postal_code; ?>">
                                                <span class="text-danger" id="postal_code_err_1"></span>
                                             </div>
                                          </div>
                                          <div class="col-lg-3"></div>
                                          <div class="col-lg-1">
                                             <div class="pull-right">
                                                <div class="form-group m-form__group mt_25px">
                                                   <?php if($i==1){ ?>
                                                  <button type="button" class="btn btn-primary" onclick="vendor_address_add_row();"><i class="fa fa-plus"></i></button>
                                                   <?php }else { ?>
                                                      <button type="button" class="btn btn-danger" onclick="vendor_address_rmv_row('<?php echo $i; ?>','<?php echo $ven_addr->vendor_address; ?>');"><i class="fa fa-minus"></i></button>
                                                   <?php } ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <?php $i++; } }else { ?>
                                    <div id="vendor_address_block_1">    
                                       <input type="hidden" name="vendor_address_id[]" value="0">                           
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
                                    <?php } ?>
                                    <input type="hidden" name="vendor_address_inc_count" id="vendor_address_inc_count" value="<?php if(count($vendor_addresses) == 0) { echo "2"; }else { echo count($vendor_addresses)+1; } ?>">
                                    <input type="hidden" name="del_ven_addr_id" id="del_ven_addr_id">
                                 </div>


                                 <h5 class="text-theme"><b>Vendor Contact Details</b></h5><hr>    
                                 <?php if(count($vendor_contact_person_info) > 0) { ?>
                                    <input type="hidden" id="contact_person_inc_count" value="<?php echo count($vendor_contact_person_info) + 1; ?>">
                                 <?php } else { ?>
                                    <input type="hidden" id="contact_person_inc_count" value="2">
                                 <?php } ?>             
                                 <input type="hidden" name="del_vendor_contact_person_id" id="del_vendor_contact_person_id">                
                                 <div id="contact_person_append">     
                                    <?php 
                                    if(count($vendor_contact_person_info) > 0) {
                                       $i = 1;
                                    foreach ($vendor_contact_person_info as $key => $ven_con_per) { ?>
                                                       
                                    <div class="row" id="contact_person_block_<?php echo $i; ?>">
                                       <input type="hidden" name="vendor_contact_person_id[]" id="vendor_contact_person_id_<?php echo $i; ?>" value="<?php echo $ven_con_per->vendor_contact_person_id; ?>">    
                                       <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Contact Person Name</label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Name"  name="contact_person_name[]" id="contact_person_name_<?php echo $i; ?>" maxlength="100" value="<?php echo $ven_con_per->contact_person; ?>">
                                             <span class="text-danger" id="contact_person_name_err_<?php echo $i; ?>"></span>
                                          </div>
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Contact Person Email</label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Email"  name="contact_person_email[]" id="contact_person_email_<?php echo $i; ?>" maxlength="100" value="<?php echo $ven_con_per->contact_person_email; ?>">
                                             <span class="text-danger" id="contact_person_email_err_<?php echo $i; ?>"></span>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="form-group m-form__group">
                                             <label>Contact Person Phone</label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Phone"  name="contact_person_phone[]" id="contact_person_phone_<?php echo $i; ?>" maxlength="100" value="<?php echo $ven_con_per->contact_person_phone; ?>">
                                             <span class="text-danger" id="contact_person_phone_err_<?php echo $i; ?>"></span>
                                          </div>
                                       </div>
                                       <?php if($i == 1){ ?>
                                       <div class="col-lg-1">
                                          <div class="pull-right">
                                             <div class="form-group m-form__group mt_25px">
                                               <button type="button" class="btn btn-primary" onclick="contact_person_add_row();"><i class="fa fa-plus"></i></button>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } else { ?>
                                       <div class="col-lg-1">
                                          <div class="pull-right">
                                             <div class="form-group m-form__group mt_25px">
                                               <button type="button" class="btn btn-danger" onclick="contact_person_rmv_row('<?php echo $i; ?>','<?php echo $ven_con_per->vendor_contact_person_id; ?>');"><i class="fa fa-minus"></i></button>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } ?>

                                    </div>    
                                    <?php $i++; } } else { ?>
                                    <div class="row" id="contact_person_block_1">
                                       <input type="hidden" name="vendor_contact_person_id[]" id="vendor_contact_person_id_1" value="0">    
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
                                    <?php } ?>     
                                 </div>   
                                 <?php $vparr = []; foreach($vendor_product_details as $vprod){
                                    array_push($vparr, $vprod['product_id']);
                                 }
                                 ?>                             
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
                                                      <option value="<?php echo $vflist['product_id']; ?>" <?php echo in_array($vflist['product_id'], $vparr)?'selected':'';?>><?php echo $vflist['product_name']; ?></option>
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
                                       <button type="submit" id="add_so_btn" class="btn btn-primary">Save Changes</button>
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
function checkUniqueVendorEdit()
{
   var val = $('#phone_no').val();
   var vid = $('#vendor_id').val();
   $.ajax({
      type:"POST",
      url:baseurl+'vendor/checkUniqueVendorEdit',
      data:{'value':val,'vid':vid},
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

function vendor_validation()
{
   var err = 0;
   var vcat = $('#vendor_category_id').val();
   var vtype = $('#vendor_type_id').val();
   var vname = $('#vendor_name').val();
   var pno = $('#phone_no').val();
   var eid = $('#email_id').val();
   var city = $('#city').val();
   var state = $('#state').val();
   var ctry = $('#country').val();
   var vprod = $('#vendor_product').val();

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
      $('#email_id_err').html('');
   }

   if(city=='')
   {
      $('#city_err').html('City is required!');
      err++;
   }
   else
   {
      $('#city_err').html('');
   }

   if(state=='')
   {
      $('#state_err').html('State is required!');
      err++;
   }
   else
   {
      $('#state_err').html('');
   }

   if(ctry=='')
   {
      $('#country_err').html('Country is required!');
      err++;
   }
   else
   {
      $('#country_err').html('');
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
   
   if(err> 0){ return false;}else{ return true; }   
}
function contact_person_add_row()
{
  var cp_inc = $('#contact_person_inc_count').val();
  $('#contact_person_append').append('<div class="row" id="contact_person_block_'+cp_inc+'"><input type="hidden" name="vendor_contact_person_id[]" id="vendor_contact_person_id_'+cp_inc+'" value="0"> <div class="col-lg-4"><div class="form-group m-form__group"><label>Contact Person Name</label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Name"  name="contact_person_name[]" id="contact_person_name_'+cp_inc+'" maxlength="100"> <span class="text-danger" id="contact_person_name_err_'+cp_inc+'"></span> </div></div><div class="col-lg-4"><div class="form-group m-form__group"><label>Phone</label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Email"  name="contact_person_email[]" id="contact_person_email_'+cp_inc+'" maxlength="100"><span class="text-danger" id="contact_person_email_err_'+cp_inc+'"></span></span> </div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Email</label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Phone"  name="contact_person_phone[]" id="contact_person_phone_'+cp_inc+'" maxlength="100"><span class="text-danger" id="contact_person_phone_err_'+cp_inc+'"></span> </div></div><div class="col-lg-1"><div class="pull-right"><div class="form-group m-form__group mt_25px"><button type="button" class="btn btn-danger" onclick="contact_person_rmv_row('+cp_inc+',0);"><i class="fa fa-minus"></i></button> </div></div></div></div>');

  cp_inc = Number(cp_inc) + 1;
  $('#contact_person_inc_count').val(cp_inc);
}
// function contact_person_rmv_row(lid,ven_con_id)
// {
//   $('#contact_person_block_'+lid).remove();
//   if(ven_con_id != 0) {

//   }
// }
function contact_person_rmv_row(lid,del_ven_con_id) { 
   var delete_id =$('#del_vendor_contact_person_id').val(); 
   var ven_con_ai_id = $('#vendor_contact_person_id_'+lid).val();
   if(ven_con_ai_id != 0){
      if(delete_id=="") {
         $('#del_vendor_contact_person_id').val(del_ven_con_id); 
      }
      else { 
         var concat_val = delete_id +','+ del_ven_con_id;
         $('#del_vendor_contact_person_id').val(concat_val); 
      } 
   }
   $('#contact_person_block_'+lid).remove(); 
}

function vendor_address_add_row() {
   var va_inc = $('#vendor_address_inc_count').val();
   $('#vendor_address_append').append('<div id="vendor_address_block_'+va_inc+'"><input type="hidden" name="vendor_address_id[]" value="0">    <div class="row"> <div class="col-lg-3"><div class="form-group m-form__group"> <label>Address Type<span class="text-danger">*</span></label><select class="form-control" id="address_type_'+va_inc+'" name="address_type[]"><option value="">Choose Address Type</option> <?php foreach ($addresstypes as $key => $addrtype) { ?><option value="<?php echo $addrtype->address_type_id; ?>"><?php echo $addrtype->address_type; ?></option> <?php } ?></select><span class="text-danger" id="address_type_err_'+va_inc+'"></span></div></div><div class="col-lg-3"> <div class="form-group m-form__group"> <label>Street</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Street" name="street[]" id="street_'+va_inc+'" maxlength="100"> <span class="text-danger" id="street_err_'+va_inc+'"></span> </div> </div> <div class="col-lg-3"> <div class="form-group m-form__group"> <label>City<span class="text-danger">*</span></label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter City" name="city[]" id="city_'+va_inc+'" maxlength="100"> <span class="text-danger" id="city_err_'+va_inc+'"></span> </div> </div> <div class="col-lg-3"> <div class="form-group m-form__group"> <label>State<span class="text-danger">*</span></label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter State" name="state[]" id="state_'+va_inc+'" maxlength="100"> <span class="text-danger" id="state_err_'+va_inc+'"></span> </div> </div> </div> <div class="row"> <div class="col-lg-3"> <div class="form-group m-form__group"> <label>Country<span class="text-danger">*</span></label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Country" name="country[]" id="country_'+va_inc+'" maxlength="100"> <span class="text-danger" id="country_err_'+va_inc+'"></span> </div> </div> <div class="col-lg-4"> <div class="form-group m-form__group"> <label>Postal Code</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Postal Code" name="postal_code[]" id="postal_code_'+va_inc+'" maxlength="100"> <span class="text-danger" id="postal_code_err_'+va_inc+'"></span> </div> </div> <div class="col-lg-3"></div> <div class="col-lg-1"> <div class="pull-right"> <div class="form-group m-form__group mt_25px"> <button type="button" class="btn btn-danger" onclick="vendor_address_rmv_row('+va_inc+',0);"><i class="fa fa-minus"></i></button> </div> </div> </div> </div> </div>');

  va_inc = Number(va_inc) + 1;
  $('#vendor_address_inc_count').val(va_inc);
}

function vendor_address_rmv_row(lid,ven_addr_id)   
{

    var delete_id =$('#del_ven_addr_id').val();

    if(ven_addr_id != 0){
       if(delete_id=="")
       {
         // var delval = $('#sub_tab_hidden'+del).val();
         $('#del_ven_addr_id').val(ven_addr_id);

       }
       else
       {
         // var delval = $('#sub_tab_hidden'+del).val();
         var concat_val = delete_id +','+ ven_addr_id;
         $('#del_ven_addr_id').val(concat_val);
       }  
    }
    $('#vendor_address_block_'+lid).remove();
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
</script>
</body>
   <!-- end::Body -->
</html>