<div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Followup Sheet Stage</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>followupsheetstage/update_followup_sheet_stage" onsubmit="return followup_sheet_stage_edit_validation()">
                  <input type="hidden" id="followup_sheet_stage_id" name="followup_sheet_stage_id" value="<?php echo $followup_sheet_stage->followup_sheet_stage_id;?>">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Stage<span class="text-danger">*</span></label>
                              <input type="text" class="form-control m-input m-input--square" placeholder="Enter Followup Sheet Stage" id="followup_sheet_stageedit" name="followup_sheet_stage" onkeyup="checkUniqueFollowupSheetStageEdit();" value="<?php echo $followup_sheet_stage->followup_sheet_stage;?>">
                              <span id="followup_sheet_stage_edit_err" class="text-danger"></span>
                           </div>
                        </div>                           
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Stage Color</label>
                              <input type="text"  class="form-control m-input m-input--square picker4" readonly placeholder="Choose Stage Color" name="stage_color" id="stage_color_edit" value="<?php echo $followup_sheet_stage->stage_color;?>">
                              <span id="stage_color_edit_err" class="text-danger"></span>
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

$('.picker4').colorpicker({
   colorSelectors: {
       'default': '#A9B6BC',
       'primary': '#418BCA',
       'success': '#01BC8C',
       'info': '#67C5DF',
       'warning': '#F89A14',
       'danger': '#EF6F6C'
   }
});

var expoe = 0;
function checkUniqueFollowupSheetStageEdit()
{
   var val = $('#followup_sheet_stageedit').val();
   var fscid = $('#followup_sheet_stage_id').val();
   $.ajax({
      type:"POST",
      url:baseurl+'followupsheetstage/checkUniqueFollowupSheetStageEdit',
      data:{'value':val,'fscid':fscid},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#followup_sheet_stage_edit_err').html('Stage already exists!');
            $('#btnSubmit').prop('disabled', true);
            expoe = 1;
         }
         else
         {
            $('#followup_sheet_stage_edit_err').html('');
            $('#btnSubmit').prop('disabled', false);
            expoe = 0;
         }
      }
   });
}


function followup_sheet_stage_edit_validation()
{
   var err = 0;
   var name = $('#followup_sheet_stageedit').val();
   //var scolor = $('#stage_color_edit').val();
   if(name == '')
   {
      $('#followup_sheet_stage_edit_err').html('Stage is required!');
      err++;
   }else{
      if(expoe == 1)
      {
         $('#followup_sheet_stage_edit_err').html('Stage already exists!');
         err++;
      }
      else
      {
         $('#followup_sheet_stage_edit_err').html('');
      }
   }

   /*if(scolor=='')
   {
      $('#stage_color_edit_err').html('Choose Type!');
      err++;
   }
   else
   {
      $('#stage_color_edit_err').html('');
   }*/
   
   if(err> 0){ return false;}else{ return true; }   
}
</script>