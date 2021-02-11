<div class="modal-dialog modal-lg" role="document">

         <div class="modal-content">

            <div class="modal-header">

               <h5 class="modal-title" id="exampleModalLabel">Update Email ID</h5>

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

               </button>

            </div>



            <form method="POST" action="<?php echo base_url(); ?>Settings/email_update" onsubmit="return e_email_validation();">

            <div class="modal-body">

               <div class="row">

                     <div class="col-lg-6">

                        <div class="form-group m-form__group">

                           <label>Email ID<span class="text-danger">*</span></label>

                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email ID" name="email_ID" id="e_email_ID" maxlength="100" onblur="e_email_ID_unique(this.value);" value="<?php echo $email_ID_details->email_ID; ?>">



                           <input type="hidden" class="form-control m-input m-input--square" placeholder="Enter Email ID" name="o_email_ID" id="o_email_ID" maxlength="100" value="<?php echo $email_ID_details->email_ID; ?>">



                           <span class="text-danger" id="e_email_ID_err"></span>

                        </div>

                     </div>

                     <div class="col-lg-6">

                        <div class="form-group m-form__group">

                           <label>From Name<span class="text-danger">*</span></label>

                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter From Name" name="from_name" id="e_from_name" maxlength="60" value="<?php echo $email_ID_details->from_name; ?>">

                           <span class="text-danger" id="e_from_name_err"></span>

                        </div>

                     </div>

               </div>

                <div class="row">

                      <div class="col-lg-6">

                              <div class="form-group m-form__group">

                                 <label>Password<span class="text-danger">*</span></label>

                                 <span class="m-input-icon__icon m-input-icon__icon--right" onclick="e_change_view();" style="height: calc(2.95rem + 2px);"><span style="cursor:pointer;"><i id="e_close" class="fa fa-eye-slash"></i><i id="e_open" style="display:none" class="fa fa-eye"></i></span></span>

                                 <input type="password" class="form-control m-input m-input--square" placeholder="Enter Password" name="password" id="e_password" value="<?php echo $pass; ?>">

                                 <span class="m-form__help text-danger" id="e_password_err"></span>
                                 <input type="hidden" id='e_visible_type' name="e_visible_type" value="hide">
                              </div>

                           </div>

                      <div class="col-lg-6">

                         <div class="form-group m-form__group">

                            <label>SMTP Host<span class="text-danger">*</span></label>

                            <select class="form-control m-bootstrap-select m_selectpicker" name="smtp_host" id="e_smtp_host">

                           <option value="">Choose</option>

                           <?php foreach ($smtp_host_list as $value) { ?>

                              <option value="<?php echo $value['smtp_host_name']; ?>"

                               <?php echo (trim($value['smtp_host_name']) == trim($email_ID_details->smtp_host)) ? 'selected' : ''; ?> ><?php echo $value['smtp_name']; ?></option>

                           <?php } ?>

                        </select>

                            <span id="e_smtp_host_err" class="text-danger"></span>

                         </div>

                      </div>

               </div>

               <?php

                  $edit_cc = ($email_ID_details->cc != '') ? explode(',', $email_ID_details->cc) : array();
                  $edit_bcc = ($email_ID_details->bcc != '') ? explode(',', $email_ID_details->bcc) : array();
               ?>

               <div class="row">

                  <div class="col-lg-12">

                     <div class="form-group m-form__group">

                        <label>Add CC</label>

                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple name="email_cc[]" id="e_email_cc">

                           <option value="">Choose CC</option>

                           <?php

                              if(!empty($email_lists))

                              {

                                 foreach ($email_lists as $key => $email_list) { if($email_list->status == 0 && $email_list->email_detail_id != $email_ID_details->email_detail_id ){ ?>

                                    <option value="<?php echo $email_list->email_detail_id; ?>" <?php echo (in_array($email_list->email_detail_id,$edit_cc)) ? 'selected' : '';?> ><?php echo $email_list->email_ID; ?></option>

                                 <?php   } } }

                           ?>

                        </select>

                        <span class="text-danger" id="e_email_cc_err"></span>

                     </div>

                  </div>

               </div>

               <div class="row">

                  <div class="col-lg-12">

                     <div class="form-group m-form__group">

                        <label>Add BCC</label>

                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple name="email_bcc[]" id="e_email_bcc">

                           <option value="">Choose BCC</option>

                           <?php

                              if(!empty($email_lists))

                              {

                                 foreach ($email_lists as $key => $email_list) { if($email_list->status == 0 && $email_list->email_detail_id != $email_ID_details->email_detail_id ){ ?>

                                    <option value="<?php echo $email_list->email_detail_id; ?>" <?php echo (in_array($email_list->email_detail_id,$edit_bcc)) ? 'selected' : '';?> ><?php echo $email_list->email_ID; ?></option>

                                 <?php   } } }

                           ?>

                        </select>

                        <span class="text-danger" id="e_email_bcc_err"></span>

                     </div>

                  </div>

               </div>

               <div class="row">

                     <div class="col-lg-12">

                        <div class="form-group m-form__group">

                           <label>Signature</label>

                           <textarea class="summernote" id="e_m_summernote_1" name="signature"><?php echo $email_ID_details->signature; ?></textarea>

                           <span class="text-danger" id="signature_err"></span>

                        </div>

                     </div>

               </div>

               

            </div>

            <input type="hidden" name="email_detail_id" id="email_detail_id" value="<?php echo $email_ID_details->email_detail_id; ?>">

            <div class="modal-footer">

               <button type="submit" class="btn btn-primary">Save Changes</button>

            </div>

         </form>





         </div>

      </div>

      <script type="text/javascript">

         $('.m_selectpicker').selectpicker();

         $('.summernote').summernote({ height : 150 });



      </script>