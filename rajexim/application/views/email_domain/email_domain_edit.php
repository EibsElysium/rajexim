<div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Email Domain</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Settings/edit_email_domain" onsubmit="return edit_email_domian_validation()">
            	<input type="hidden" name="ed_id" value="<?php echo $get_email_domain_by_id->email_domain_id; ?>">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Email Domain<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="e_email_domain" name="e_email_domain" placeholder="Enter Email Domain" value="<?php echo $get_email_domain_by_id->email_domain; ?>" onkeyup="e_chk_email_domain_unique(this.value);">
                           <input type="hidden" name="ex_email_domain" id="ex_email_domain" value="<?php echo $get_email_domain_by_id->email_domain; ?>">
                           <span id="e_email_domain_err" class="text-danger"></span>
                        </div>
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