<div class="modal-dialog" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Sub Lead Source</h5>
         <button Source="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <form name="sub_lead_source_edit_form" id="sub_lead_source_edit_form" method="POST" action="<?php echo base_url(); ?>Leads/sub_lead_source_update" onsubmit="return edit_sub_lead_source_validation()">
         <input type="hidden" name="sls_id" value="<?php echo $get_sls_by_id->sub_lead_source_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Lead Source<span class="text-danger">*</span></label>
                     <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="e_lead_source" id="e_lead_source" onchange="e_chk_unique_sub_lead_source();">
                        <option value="">All</option>
                           <?php
                              if(!empty($lead_sources))
                              {
                                 foreach ($lead_sources as  $lead_source) { if($lead_source->status == 0){ ?>
                                    <option <?php echo ($lead_source->lead_source_id == $get_sls_by_id->lead_source_id) ? 'selected' : ''; ?> value="<?php echo $lead_source->lead_source_id; ?>" ><?php echo $lead_source->lead_source; ?></option>
                                 <?php } }
                              }
                           ?>
                     </select>
                     <span id="e_lead_source_err" class="text-danger"></span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Sub Lead Source<span class="text-danger">*</span></label>
                     <input Source="text" class="form-control m-input m-input--square" placeholder="Enter Sub Lead Source" name="e_sub_lead_source_name" id="e_sub_lead_source_name" onkeyup="return e_chk_unique_sub_lead_source()" value="<?php echo $get_sls_by_id->sub_lead_source; ?>">
                     <input type="hidden" id="ex_sub_lead_source_name" value="<?php echo $get_sls_by_id->sub_lead_source; ?>">
                     <span id="e_sub_lead_source_name_err" class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button Source="submit" id="e_btnSubmit" class="btn btn-primary">Save</button>
            <button Source="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </form>
   </div>
</div>
<script>
   $('.m_selectpicker').selectpicker();
</script>