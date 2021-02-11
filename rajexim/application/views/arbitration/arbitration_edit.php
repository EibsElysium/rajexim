<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Arbitration</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Arbitrations/update_Arbitration" onsubmit="return edit_Arbitration_validataion()">
         <input type="hidden" name="arbitration_id" value="<?php echo $aribitration_by_id->arbitration_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Arbitration Label<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Arbitration Label" name="e_arbitration_label" id="e_arbitration_label" onkeyup="e_checkUniquearbitrationLabel();" value="<?php echo $aribitration_by_id->arbitration_label; ?>">
                           <input type="hidden" id="ex_arbitration_label" value="<?php echo $aribitration_by_id->arbitration_label; ?>">
                           <span id="e_arbitration_label_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Arbitration Text<span class="text-danger">*</span></label>
                           <textarea class="form-control m-input m-input--square" placeholder="Enter Arbitration Text" name="e_arbitration_text" id="e_arbitration_text" ><?php echo $aribitration_by_id->arbitration_text; ?></textarea>
                           <span id="e_arbitration_text_err" class="text-danger"></span>
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
function e_checkUniquearbitrationLabel()
{
   var ex_val = $('#ex_arbitration_label').val();
   var val = $('#e_arbitration_label').val();
   if(val.toLowerCase() != ex_val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'Arbitrations/checkUniquearbitrationLabel',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result) {
            if(result > 0)
            {
               $('#e_arbitration_label_err').html('Arbitration Label already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_arbitration_label_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function edit_Arbitration_validataion()
{
   var err = 0;
   var name = $('#e_arbitration_label').val();
   var txt = $('#e_arbitration_text').val();
   if(name == '')
   {
      $('#e_arbitration_label_err').html('Arbitration Label is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#e_arbitration_label_err').html('Arbitration Label already exists!');
         err++;
      }
      else
      {
         $('#e_arbitration_label_err').html('');
      }
   }
   if (txt.trim() == '') {
      $('#e_arbitration_text_err').html('Arbitration Text is required!');
      err++;
   }
   else {
      $('#e_arbitration_text_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }   
}


</script>