<div class="modal-dialog modal-lg cust_modal" role="document">
 <div class="modal-content">
    <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Create Lead</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
       </button>
    </div>
<form name="lead_add_form" method="POST" action="<?php echo base_url(); ?>Leads/lead_save" onsubmit="return lead_validation();">
    <div class="modal-body">
       <h5 class="mt_25px text-theme">
          <b>Lead Info</b> 
       </h5><hr>
       <div class="row">
          <div class="col-lg-3">
             <div class="form-group m-form__group">
                <label>Lead Name<span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Name"  name="lead_name" id="lead_name" maxlength="100" value="<?php echo ($lead_name != '') ? $lead_name : ''; ?>">
                <span class="text-danger" id="lead_name_err"></span>
             </div>
          </div>
          <div class="col-lg-3">
             <div class="form-group m-form__group">
                <label>Company Name</label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Company Name" name="company_name" id="company_name" maxlength="100">
                <span class="text-danger" id="company_name_err"></span>
             </div>
          </div>
          <div class="col-lg-3">
             <div class="form-group m-form__group">
                   <label>Country<span class="text-danger">*</span></label>
                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="country" id="country">
                      <option value="">Choose</option>
                      <?php
                            if(!empty($country_lists))
                            {
                               foreach ($country_lists as $country_list) {  ?>
                                  <option value="<?php echo $country_list->id; ?>"><?php echo $country_list->name; ?></option>
                               <?php } 
                            }
                         ?>
                   </select>
                   <span class="text-danger" id="country_err"></span>
                </div>
          </div>
          <div class="col-lg-3">
             <div class="form-group m-form__group">
                <label>Designation</label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Designation" name="designation" id="designation" maxlength="100">
                <span class="text-danger" id="designation_err"></span>
             </div>
          </div>
             
       </div>
       <div class="row">

          <div class="col-lg-3">
             <div class="form-group m-form__group">
                <label>Website</label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Website" id="website" name="website">
                <span class="text-danger" id="website_err"></span>
             </div>
          </div>
          <div class="col-lg-9">
             <div class="form-group m-form__group">
                <label>Address</label>
                <textarea class="form-control" name="address" id="address" placeholder="Enter Address"></textarea>
                <span class="text-danger" id="address_err"></span>
             </div>
          </div>
       </div>

       <h5 class="text-theme"><b>Lead Contact Info</b></h5><hr>

       <div class="row">
          <div class="col-lg-4">
             <div class="form-group m-form__group">
                <label>Primary Email ID<span class="text-danger">*</span></label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Primary Email ID" name="email_id" id="email_id" maxlength="100" onblur="email_id_unique(this.value);chk_if_email_is_blocked(this.value);" value="<?php echo ($email_id != '') ? $email_id : ''; ?>">
                <span class="text-danger" id="email_id_err"></span>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="form-group m-form__group">
                <label>Alternate Email ID</label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Alternate Email ID" name="alternative_email_id" id="alternative_email_id" maxlength="100" >
                <span class="text-danger" id="alternative_email_id_err"></span>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="form-group m-form__group">
                <label>Skype ID</label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Skype ID" id="skype_id" name="skype_id">
                <span class="text-danger" id="skype_id_err"></span>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-lg-4">
             <div class="form-group m-form__group">
                <label>Contact No</label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact No" id="contact_no" name="contact_no" maxlength="12">
                <span class="text-danger" id="contact_no_err"></span>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="form-group m-form__group">
                <label>Whatsapp No</label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Whatsapp No" id="whatsapp_no" name="whatsapp_no" maxlength="12">
                <span class="text-danger" id="whatsapp_no_err"></span>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="form-group m-form__group">
                <label>Office Contact No</label>
                <input type="text" class="form-control m-input m-input--square" placeholder="Enter Office Contact No"  id="office_phone_no" name="office_phone_no" maxlength="12">
                <span class="text-danger" id="office_phone_no_err"></span>
             </div>
          </div>
       </div>
       <h5 class="text-theme"><b>Interested Product Info</b></h5><hr>
       <div class="row">
          <div class="col-lg-6">
                <div class="form-group m-form__group">
                      <label>Product<span class="text-danger">*</span></label>
                      <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="product_id" id="product_id" onchange="product_user_list(this.value);">
                         <option value="">Choose</option>
                         <?php
                            if(!empty($product_lists))
                            {
                               foreach ($product_lists as $product_list) { if($product_list->status == 0){ ?>
                                  <option value="<?php echo $product_list->product_id; ?>"><?php echo $product_list->product_name; ?></option>
                               <?php } }
                            }
                         ?>
                      </select>
                      <span class="text-danger" id="product_id_err"></span>
                </div>
          </div>
          <div class="col-lg-6">
             <div class="form-group m-form__group">
                <label>Industry</label>
                <input type="text" class="form-control"  readonly="" name="industry_name" id="industry_name">
                <input type="hidden"  class="form-control"  readonly="" name="industry_id" id="industry_id">
                <span class="text-danger" ></span>
             </div>
          </div>
       </div>

       <h5 class="text-theme"><b>Lead Source Info</b></h5><hr>

       <div class="row">
          <div class="col-lg-3">
             <div class="form-group m-form__group">
                <label>Lead Source<span class="text-danger">*</span></label>
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source" id="lead_source"> 
                   <option value="">Choose</option> 
                   <!-- <?php
                      if(!empty($lead_source_lists))
                      {
                         foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                            <option value="<?php echo $lead_source_list->lead_source_id; ?>"><?php echo $lead_source_list->lead_source; ?></option>
                         <?php } }
                      }
                   ?> -->
                   <?php
                      if(!empty($lead_source_lists))
                      {
                         foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                            <optgroup label="<?php echo $lead_source_list->lead_source; ?>">
                               <?php $get_all_subgroup_source = get_all_subgroup_source($lead_source_list->lead_source_id); 
                               foreach ($get_all_subgroup_source as $sub_lead){
                               ?>
                               <option <?php if($alibaba_or_not == '1'){ echo ($sub_lead->sub_lead_source_id == 2) ? 'selected' : ''; } ?> value="<?php echo $sub_lead->sub_lead_source_id; ?>"><?php echo $sub_lead->sub_lead_source; ?></option>
                               <?php } ?>
                            </optgroup>
                            
                         <?php } }
                      }
                   ?>
                </select>
                <span class="text-danger" id="lead_source_err"></span>
             </div>
          </div>
          <div class="col-lg-3">
             <div class="form-group m-form__group">
                <label>Priority<span class="text-danger">*</span></label>
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_type" id="lead_type"> 
                   <option value="">Choose</option> 
                   <?php
                      if(!empty($lead_type_lists))
                      {
                         foreach ($lead_type_lists as  $lead_type_list) { if($lead_type_list->status == 0){ ?>
                            <option value="<?php echo $lead_type_list->lead_type_id; ?>"><?php echo $lead_type_list->lead_type; ?></option>
                         <?php } }
                      }
                   ?>
                </select>
                <span class="text-danger" id="lead_type_err"></span>
             </div>
          </div>

          <div class="col-lg-3">
             <div class="form-group m-form__group">
                <label>Lead Status<span class="text-danger">*</span></label>
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_status" id="lead_status"> 
                   <option value="">Choose</option> 
                  <?php
                      if(!empty($lead_status_lists))
                      {
                         foreach ($lead_status_lists as $lead_status_list) { if($lead_status_list->status == 0){ ?>
                            <option value="<?php echo $lead_status_list->lead_status_id; ?>"><?php echo $lead_status_list->lead_status; ?></option>
                         <?php } }
                      }
                   ?>
                </select>
                <span class="text-danger" id="lead_status_err"></span>
             </div>
          </div>
          <div class="col-lg-3">
             <div class="form-group m-form__group">
                <label>Assigned To<span class="text-danger">*</span></label>
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="assigned_to" id="assigned_to"> 
                   <option value="">Choose</option> 
                   
                </select>
                <span class="text-danger" id="assigned_to_err"></span>
             </div>
          </div>
       </div>

       <h5 class="text-theme"><b>Message Info</b></h5><hr>
       <div class="row">
             <div class="col-lg-12">
                <label>Message</label>
                <div class="form-group m-form__group">
                   <textarea class="summernote " id="m_summernote_12" name="lead_message"><?php echo ($message != '') ? $message : ''; ?></textarea>
                   <span class="text-danger" id="lead_message_err"></span>
                </div>
             </div>
       </div>
    </div>
    <div class="modal-footer">
       <button type="submit" class="btn btn-primary">Generate Lead</button>
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>

</form>
 </div>
</div>

<script>
	$('#m_summernote_12').summernote();
	$('.m_selectpicker').selectpicker();
function chk_if_email_is_blocked(val)
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/chk_lead_email_is_blocked',
      data:{'value':val},
      async: false,
      dataType: "html",
      success: function(result){
         if(result > 0)
         {
            $('#email_id_err').html('This email is Blocked');
            er = 1;
         }else{
            $('#email_id_err').html('');
            er = 0;
         }
         
      }
   });
}
</script>