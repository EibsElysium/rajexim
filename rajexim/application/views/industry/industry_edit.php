<div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Update Industry</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form method="POST" action="<?php echo base_url(); ?>Settings/industry_update" onsubmit="return e_industry_validation();">
            <div class="modal-body">
               <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Industry Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Industry Name" name="industry_name" id="e_industry_name" value="<?php echo $industry_details->industry_name; ?>" maxlength="60" onblur="e_industry_unique(this.value);">

                           <input type="hidden" class="form-control m-input m-input--square" placeholder="Enter Industry Name" name="o_industry_name" id="o_industry_name" value="<?php echo $industry_details->industry_name; ?>" maxlength="60">
                           <span class="text-danger" id="e_industry_name_err"></span>
                        </div>
                     </div>
               </div>
            </div>
            <input type="hidden" name="industry_id" id="industry_id" value="<?php echo $industry_details->industry_id; ?>">
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
         </form>


         </div>
      </div>