<div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Quote Stage</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form name="edit_exporter" id="edit_exporter" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>quotestage/update_quote_stage" onsubmit="return quote_stage_edit_validation()">
               <input type="hidden" name="quote_stage_id" id="quote_stage_id" value="<?php echo $quote_stage_list->quote_stage_id;?>">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">                        
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <label>Quote Stage<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Quote Stage" name="quote_stage" id="quote_stage_edt" value="<?php echo $quote_stage_list->quote_stage;?>" onkeyup="checkUniqueQuoteStageEdit();">
                                 <span id="quote_stage_edit_err" class="text-danger"></span>
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
var eexpo = 0;
function checkUniqueQuoteStageEdit()
{
   var val = $('#quote_stage_edt').val();
   var eid = $('#quote_stage_id').val();

   $.ajax({
      type:"POST",
      url:baseurl+'quotestage/checkUniqueQuoteStageEdit',
      data:{'value':val,'eid':eid},
      cache: false,
      dataStatus: "html",
      success: function(result){
         if(result>0)
         {
            $('#quote_stage_edit_err').html('Quote Stage already exists!');
            $('#btnSubmit').prop('disabled', true);
            eexpo = 1;
         }
         else
         {
            $('#quote_stage_edit_err').html('');
            $('#btnSubmit').prop('disabled', false);
            eexpo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function quote_stage_edit_validation()
{
   var err = 0;
   var name = $('#quote_stage_edt').val();
   if(name == '')
   {
      $('#quote_stage_edit_err').html('Quote Stage is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#quote_stage_edit_err').html('Quote Stage already exists!');
         err++;
      }
      else
      {
         $('#quote_stage_edit_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

</script>