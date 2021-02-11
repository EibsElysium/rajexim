<div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Bank Detail</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>bankdetail/update_bankdetail" onsubmit="return bankdetail_edit_validation()">
                  <input type="hidden" id="bank_detail_id" name="bank_detail_id" value="<?php echo $bank_detail_list->bank_detail_id;?>">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="row">                        
                              <div class="col-lg-4">
                                 <div class="form-group m-form__group">
                                    <label>Exporter<span class="text-danger">*</span></label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="exporter_id" id="exporter_id_edit"> 
                                       <option value="">Choose Exporter</option>
                                       <?php
                                          if(!empty($exporter_list))
                                          {
                                             foreach ($exporter_list as $vflist) { ?>
                                                <option value="<?php echo $vflist['exporter_id']; ?>" <?php echo $vflist['exporter_id'] == $bank_detail_list->exporter_id?'selected':'';?>><?php echo $vflist['exporter_name']; ?></option>
                                             <?php }
                                          }
                                       ?>
                                    </select>
                                    <span class="text-danger" id="exporter_id_edit_err"></span>
                                 </div>
                              </div>                        
                              <div class="col-lg-4">
                                 <div class="form-group m-form__group">
                                    <label>Currency<span class="text-danger">*</span></label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="currency_id" id="currency_id_edit"> 
                                       <option value="">Choose Currency</option>
                                       <?php
                                          if(!empty($currency_list))
                                          {
                                             foreach ($currency_list as $vflist) { ?>
                                                <option value="<?php echo $vflist['currency_id']; ?>" <?php echo $vflist['currency_id'] == $bank_detail_list->currency_id?'selected':'';?>><?php echo $vflist['currency_name']; ?> - <?php echo $vflist['currency_code']; ?></option>
                                             <?php }
                                          }
                                       ?>
                                    </select>
                                    <span class="text-danger" id="currency_id_edit_err"></span>
                                 </div>
                              </div>                       
                              <div class="col-lg-4">
                                 <div class="form-group m-form__group">
                                    <label>Bank Label<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Bank Label" name="bank_label" id="bank_label_edit" value="<?php echo $bank_detail_list->bank_label;?>">
                                    <span id="bank_label_edit_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">                        
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Correspondence Bank<span class="text-danger">*</span></label>
                                    <textarea class="form-control snote" rows="5" id="correspondence_bank_edit" name="correspondence_bank"><?php echo $bank_detail_list->correspondence_bank;?></textarea>
                                    <span id="correspondence_bank_edit_err" class="text-danger"></span>
                                 </div>
                              </div>                       
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Bank Detail<span class="text-danger">*</span></label>
                                    <textarea class="form-control snote" rows="5" id="bank_detail_edit" name="bank_detail"><?php echo $bank_detail_list->bank_detail;?></textarea>
                                    <span id="bank_detail_edit_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" id="btnSubmit" class="btn btn-primary">Save Changes</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
               </form>
            </div>
      </div>

<script>

$('.m_selectpicker').selectpicker();
$('.snote').summernote();

function bankdetail_edit_validation()
{
   var err = 0;
   var eid = $('#exporter_id_edit').val();
   var cid = $('#currency_id_edit').val();
   var blabel = $('#bank_label_edit').val();
   var cbank = $('#correspondence_bank_edit').val();
   var bdetail = $('#bank_detail_edit').val();

   if(eid=='')
   {
      $('#exporter_id_edit_err').html('Choose Exporter!');
      err++;
   }
   else
   {
      $('#exporter_id_edit_err').html('');
   }

   if(cid=='')
   {
      $('#currency_id_edit_err').html('Choose Currency!');
      err++;
   }
   else
   {
      $('#currency_id_edit_err').html('');
   }

   if(blabel == '')
   {
      $('#bank_label_edit_err').html('Bank Label is required!');
      err++;
   }else{
      $('#bank_label_edit_err').html('');
   }

   if(cbank=='')
   {
      $('#correspondence_bank_edit_err').html('Correspondence Bank is required!');
      err++;
   }
   else
   {
      $('#correspondence_bank_edit_err').html('');
   }

   if(bdetail=='')
   {
      $('#bank_detail_edit_err').html('Bank Detail is required!');
      err++;
   }
   else
   {
      $('#bank_detail_edit_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}
</script>