<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit PI Stage</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>PI_Stages/update_pi_stage" onsubmit="return update_pi_stage_validataion()">
         <input type="hidden" name="pi_stage_id" value="<?php echo $pi_stage_by_id->pi_stage_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>PI Stage<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter PI Stage" name="e_pi_stage" id="e_pi_stage" onkeyup="e_checkUniquePIStage();" value="<?php echo $pi_stage_by_id->pi_stage; ?>">
                           <input type="hidden" name="ex_pi_stage" id="ex_pi_stage" value="<?php echo $pi_stage_by_id->pi_stage; ?>">
                           <span id="e_pi_stage_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" id="e_btnSubmit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </form>
   </div>
</div>

<script>
var eexpo = 0;
function e_checkUniquePIStage()
{
   var val = $('#e_pi_stage').val();
   var ex_val = $('#ex_pi_stage').val();
   if(val.toLowerCase() != ex_val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'PI_Stages/checkUniquePIStage',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_pi_stage_err').html('PI Stage already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_pi_stage_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function update_pi_stage_validataion()
{
   var err = 0;
   var name = $('#e_pi_stage').val();
   if(name == '')
   {
      $('#e_pi_stage_err').html('PI Stage is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#e_pi_stage_err').html('PI Stage already exists!');
         err++;
      }
      else
      {
         $('#e_pi_stage_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}



</script>