<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Interest</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Interests/update_Interest" onsubmit="return edit_Interest_validataion()">
         <input type="hidden" name="interest_id" value="<?php echo $interest_by_id->interest_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Interest Label<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Interest Label" name="e_interest_label" id="e_interest_label" onkeyup="e_checkUniqueInterestLabel();" value="<?php echo $interest_by_id->interest_label; ?>">
                           <input type="hidden" name="ex_interest_label" id="ex_interest_label" value="<?php echo $interest_by_id->interest_label; ?>">
                           <span id="e_interest_label_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Interest Text<span class="text-danger">*</span></label>
                           <textarea class="form-control m-input m-input--square" placeholder="Enter Interest Text" name="e_interest_text" id="e_interest_text" ><?php echo $interest_by_id->interest_text; ?></textarea>
                           <span id="e_interest_text_err" class="text-danger"></span>
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
function e_checkUniqueInterestLabel()
{  
   var ex_val = $('#ex_interest_label').val();
   var val = $('#e_interest_label').val();
   if(ex_val.toUpperCase() != val.toUpperCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'Interests/checkUniqueInterestLabel',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result > 0)
            {
               $('#e_interest_label_err').html('Interest Label already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_interest_label_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function edit_Interest_validataion()
{
   var err = 0;
   var name = $('#e_interest_label').val();
   var txt = $('#e_interest_text').val();
   if(name == '')
   {
      $('#e_interest_label_err').html('Interest Label is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#e_interest_label_err').html('Interest Label already exists!');
         err++;
      }
      else
      {
         $('#e_interest_label_err').html('');
      }
   }
   if (txt.trim() == '') {
      $('#e_interest_text_err').html('Interest Text is required!');
      err++;
   }
   else {
      $('#e_interest_text_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }   
}


</script>