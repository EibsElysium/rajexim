  <div class="modal-dialog modal-lg cust_modal" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Update Lead</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form name="lead_edit_form" id="lead_edit_form" action="<?php echo base_url(); ?>Leads/lead_update" method="POST" onsubmit="return e_lead_validation();">
              
               <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead_edit->lead_id; ?>">
               <input type="hidden" name="cont_book_id" id="cont_book_id" value="<?php echo $contact_book_info->contact_book_id; ?>">
               <h5 class="mt_25px text-info">
                  <b>Lead Info</b> 
               </h5><hr>
               <div class="row">
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Lead Name<span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Name"  name="lead_name" id="e_lead_name" maxlength="100" value="<?php echo $contact_book_info->lead_name; ?>">
                        <span class="text-danger" id="e_lead_name_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Company Name</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Company Name" name="company_name" id="company_name" maxlength="100" value="<?php echo ($contact_book_info->company_name) ? $contact_book_info->company_name : ''; ?>">
                        <span class="text-danger" id="company_name_err"></span>
                     </div>
                  </div>
                  
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                           <label>Country<span class="text-danger">*</span></label>
                           <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="country" id="e_country">
                              <option value="">Choose</option>
                              <?php
                                    if(!empty($country_lists))
                                    {
                                       foreach ($country_lists as $key => $country_list) {  ?>
                                          <option value="<?php echo $country_list->id; ?>" <?php echo ($country_list->id == $contact_book_info->country) ? 'selected' : ''; ?> ><?php echo $country_list->name; ?></option>
                                       <?php } 
                                    }
                                 ?>
                           </select>
                           <span class="text-danger" id="e_country_err"></span>
                        </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Designation</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Designation" name="designation" id="e_designation" maxlength="100" value="<?php echo ($contact_book_info->designation) ? $contact_book_info->designation : ''; ?>">
                        <span class="text-danger" id="e_designation_err"></span>
                     </div>
                  </div>
               </div>
               <div class="row">

                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Website</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Website" id="e_website" name="website" value="<?php echo ($contact_book_info->website) ? $contact_book_info->website : ''; ?>">
                        <span class="text-danger" id="e_website_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-9">
                     <div class="form-group m-form__group">
                        <label>Address</label>
                        <textarea class="form-control" name="address" id="e_address" placeholder="Enter Address"><?php echo ($contact_book_info->address) ? $contact_book_info->address : ''; ?> 
                     </textarea>
                        <span class="text-danger" id="e_address_err"></span>
                     </div>
                  </div>
               </div>
               <h5 class="text-theme"><b>Lead Contact Info</b></h5><hr>
               <div class="row">
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Primary Email ID<span class="text-danger">*</span></label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Primary Email ID" name="email_id" id="e_email_id" maxlength="100" value="<?php echo ($contact_book_info->email_id) ? $contact_book_info->email_id : ''; ?>" onblur="e_email_id_unique(this.value);">

                        <input type="hidden" class="form-control m-input m-input--square" placeholder="Enter Primary Email ID" name="" id="o_email_id" maxlength="100" value="<?php echo ($contact_book_info->email_id) ? $contact_book_info->email_id : ''; ?>">

                        <span class="text-danger" id="e_email_id_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Alternate Email ID</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Alternate Email ID" name="alternative_email_id" id="e_alternative_email_id" maxlength="100" value="<?php echo ($contact_book_info->alternative_email_id) ? $contact_book_info->alternative_email_id : ''; ?>">
                        <span class="text-danger" id="e_alternative_email_id_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Skype ID</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Skype ID" id="e_skype_id" name="skype_id" value="<?php echo ($contact_book_info->skype_id) ? $contact_book_info->skype_id : ''; ?>">
                        <span class="text-danger" id="e_skype_id_err"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Contact No</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact No" id="e_contact_no" name="contact_no" maxlength="12" value="<?php echo ($contact_book_info->contact_no) ? $contact_book_info->contact_no : ''; ?>">
                        <span class="text-danger" id="e_contact_no_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Whatsapp No</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Whatsapp No" id="e_whatsapp_no" name="whatsapp_no" maxlength="12" value="<?php echo ($contact_book_info->whatsapp_no) ? $contact_book_info->whatsapp_no : ''; ?>">
                        <span class="text-danger" id="e_whatsapp_no_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Office Contact No</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Office Contact No"  id="e_office_phone_no" name="office_phone_no" maxlength="12" value="<?php echo ($contact_book_info->office_phone_no) ? $contact_book_info->office_phone_no : ''; ?>">
                        <span class="text-danger" id="e_office_phone_no_err"></span>
                     </div>
                  </div>
               </div>
               <h5 class="text-theme"><b>Interested Product Info</b></h5><hr>
               <div class="row">
                  <div class="col-lg-6">
                        <div class="form-group m-form__group">
                              <label>Product<span class="text-danger">*</span></label>
                              <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="product_id" id="e_product_id" onchange="e_product_user_list(this.value);">
                                 <option value="">Choose</option>
                                 <?php
                                    if(!empty($product_lists))
                                    {
                                       foreach ($product_lists as $key => $product_list) { if($product_list->status == 0){ ?>
                                          <option value="<?php echo $product_list->product_id; ?>" <?php echo ($product_list->product_id == $lead_edit->product_id) ? 'selected' : ''; ?> ><?php echo $product_list->product_name; ?></option>
                                       <?php } }
                                    }
                                 ?>
                              </select>
                              <span class="text-danger" id="e_product_id_err"></span>
                        </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group m-form__group">
                        <label>Industry</label>
                        <input type="text" class="form-control"  readonly="" name="industry_name" id="e_industry_name" value="<?php echo ($lead_edit->industry_name) ? $lead_edit->industry_name : ''; ?>">
                        <input type="hidden"  class="form-control"  readonly="" name="industry_id" id="e_industry_id" value="<?php echo ($lead_edit->industry_id) ? $lead_edit->industry_id : ''; ?>">
                        <span class="text-danger" id="e_industry_name_err"></span>
                     </div>
                  </div>
               </div>

               <h5 class="text-theme"><b>Lead Source Info</b></h5><hr>

               <div class="row">
                  <!-- <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Lead Source<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source" id="e_lead_source"> 
                           <option value="">Choose</option> 
                          
                           <?php
                              if(!empty($lead_source_lists))
                              {
                                 foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                    <optgroup label="<?php echo $lead_source_list->lead_source; ?>">
                                       <?php $get_all_subgroup_source = get_all_subgroup_source($lead_source_list->lead_source_id); 
                                       foreach ($get_all_subgroup_source as $sub_lead){
                                       ?>
                                       <option <?php echo ($sub_lead->sub_lead_source_id == $lead_edit->lead_source_id) ? 'selected' : ''; ?> value="<?php echo $sub_lead->sub_lead_source_id; ?>"><?php echo $sub_lead->sub_lead_source; ?></option>
                                       <?php } ?>
                                    </optgroup>
                                    
                                 <?php } }
                              }
                           ?>
                        </select>
                        <span class="text-danger" id="e_lead_source_err"></span>
                     </div>
                  </div> -->
                  <div class="col-lg-2">
                     <div class="form-group m-form__group">
                        <label>Lead Source<span class="text-danger">*</span></label>
                       
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="e_ori_lead_source" id="e_ori_lead_source" onchange="e_get_sub_lead_source_by_ls_id();"> 
                           <option value="">Choose</option> 
                           <?php
                              if(!empty($lead_source_lists))
                              {
                                 foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                    <option <?php echo($lead_edit->ls_id == $lead_source_list->lead_source_id) ? 'selected' : ''; ?> value="<?php echo $lead_source_list->lead_source_id; ?>"><?php echo $lead_source_list->lead_source; ?></option>
                                 <?php } }
                              }
                           ?>
                        </select>
                        <span class="text-danger" id="e_ori_lead_source_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group m-form__group">
                        <label>Sub Lead Source<span class="text-danger">*</span></label>
                       
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source" id="e_lead_source"> 
                           <option value="">Choose</option> 
                           <?php foreach ($sub_lead_sources as $sls_list) {
                              if ($sls_list->status == 0) { ?>
                              <option <?php echo ($sls_list->sub_lead_source_id == $lead_edit->lead_source_id) ? 'selected' : ''; ?> value="<?php echo $sls_list->sub_lead_source_id; ?>"><?php echo $sls_list->sub_lead_source; ?></option>      
                             <?php }
                              # code...
                           } ?>
                           
                        </select>
                        <span class="text-danger" id="e_lead_source_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group m-form__group">
                        <label>Priority<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_type" id="e_lead_type"> 
                           <option value="">Choose</option> 
                           <?php
                              if(!empty($lead_type_lists))
                              {
                                 foreach ($lead_type_lists as $key => $lead_type_list) { if($lead_type_list->status == 0){ ?>
                                    <option value="<?php echo $lead_type_list->lead_type_id; ?>" <?php echo ($lead_type_list->lead_type_id == $lead_edit->lead_type_id) ? 'selected' : ''; ?> ><?php echo $lead_type_list->lead_type; ?></option>
                                 <?php } }
                              }
                           ?>
                        </select>
                        <span class="text-danger" id="e_lead_type_err"></span>
                     </div>
                  </div>

                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Lead Status<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_status" id="e_lead_status"> 
                           <option value="">Choose</option> 
                          <?php
                              if(!empty($lead_status_lists))
                              {
                                 foreach ($lead_status_lists as $key => $lead_status_list) { if($lead_status_list->status == 0){ ?>
                                    <option value="<?php echo $lead_status_list->lead_status_id; ?>" <?php echo ($lead_status_list->lead_status_id == $lead_edit->lead_status_id) ? 'selected' : ''; ?> ><?php echo $lead_status_list->lead_status; ?></option>
                                 <?php } }
                              }
                           ?>
                        </select>
                        <span class="text-danger" id="e_lead_status_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Assigned To<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="assigned_to" id="e_assigned_to"> 
                           <option value="">Choose</option> 
                           <?php
                              if(!empty($product_users))
                              {
                                 foreach ($product_users as $key => $product_user) {  ?>
                                    <option value="<?php echo $product_user->user_id; ?>" <?php echo ($product_user->user_id == $lead_edit->lead_assigned_to) ? 'selected' : ''; ?> ><?php echo $product_user->user_name; ?></option>
                                 <?php } 
                              }
                           ?>
                           
                        </select>
                        <span class="text-danger" id="e_assigned_to_err"></span>
                     </div>
                  </div>
               </div>

               <h5 class="text-theme"><b>Message Info</b></h5><hr>
               <div class="row">
                     <div class="col-lg-12">
                        <label>Message</label>
                        <div class="form-group m-form__group">
                           <textarea class="summernote" id="e_m_summernote_1" name="lead_message"><?php echo ($lead_edit->message) ? $lead_edit->message : ''; ?></textarea>
                           <span class="text-danger" id="e_lead_message_err"></span>
                        </div>
                     </div>
               </div>
            </div>
            
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary" onclick="submit_form();">Save Changes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
       </form>
      <script type="text/javascript">
         $('.summernote').summernote();
         $('.m_selectpicker').selectpicker();
         function submit_form() {
            $('#lead_edit_form').submit();
         }
      </script>