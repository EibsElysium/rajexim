<div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Block Email Domain</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Settings/edit_block_email_domain" onsubmit="return edit_email_domian_validation()">
            	<input type="hidden" name="ed_id" value="<?php echo $get_block_email_info_by_id->ed_id; ?>">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Block Email Domain<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="e_blo_email_domain" name="e_blo_email_domain" placeholder="Enter Block Email Domain" value="<?php echo $get_block_email_info_by_id->value; ?>" onkeyup="e_chk_block_email_domain_unique(this.value);e_chk_email_domain_is_cannot_blockable(this.value);">
                           <input type="hidden" name="ex_blo_email_domain" id="ex_blo_email_domain" value="<?php echo $get_block_email_info_by_id->value; ?>">
                           <span id="e_blo_email_domain_err" class="text-danger"></span>
                        </div>
                     </div>

                  </div>
                  <div class="row">
                     <div class="col-lg-8">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="e_email_or_domain_chk" name="e_email_or_domain_chk" onchange="e_chk_email_or_domain();" <?php echo ($get_block_email_info_by_id->email_or_domain == 1) ? 'checked' : ''; ?>><label class="label" id="e_email_or_domain_label" for="e_email_or_domain_chk">If You Enter Email Check Here</label>
                             <span></span>
                           </label>
                        </div>
                        <input type="hidden" name="e_email_or_domain" id="e_email_or_domain" value="<?php echo $get_block_email_info_by_id->email_or_domain; ?>">
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" id="e_btnSubmit" class="btn btn-primary">Save</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>