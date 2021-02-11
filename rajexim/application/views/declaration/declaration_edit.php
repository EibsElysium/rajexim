<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Declaration</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Declarations/update_Declaration" onsubmit="return edit_Declaration_validataion()">
         <input type="hidden" name="declaration_id" value="<?php echo $declaration_by_id->declaration_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Declaration Label<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Declaration Label" name="e_declaration_label" id="e_declaration_label" onkeyup="e_checkUniqueDeclarationLabel();" value="<?php echo $declaration_by_id->declaration_label; ?>">
                           <input type="hidden" id="ex_declaration_label" value="<?php echo $declaration_by_id->declaration_label; ?>">
                           <span id="e_declaration_label_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Declaration<span class="text-danger">*</span></label>
                           <textarea class="form-control m-input m-input--square" placeholder="Enter Declaration Text" name="e_declaration_text" id="e_declaration_text" ><?php echo $declaration_by_id->declaration; ?></textarea>
                           <span id="e_declaration_text_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" id="e_btnSubmit" class="btn btn-primary">Create</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </form>
   </div>
</div>

<script>
var eexpo = 0;
function e_checkUniqueDeclarationLabel()
{
   var ex_val = $('#ex_declaration_label').val();
   var val = $('#e_declaration_label').val();
   if (ex_val.toLowerCase() != val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'Declarations/checkUniqueDeclarationLabel',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_declaration_label_err').html('Declaration Label already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_declaration_label_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function edit_Declaration_validataion()
{
   var err = 0;
   var name = $('#e_declaration_label').val();
   var txt = $('#e_declaration_text').val();
   if(name == '')
   {
      $('#e_declaration_label_err').html('Declaration Label is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#e_declaration_label_err').html('Declaration Label already exists!');
         err++;
      }
      else
      {
         $('#e_declaration_label_err').html('');
      }
   }
   if (txt.trim() == '') {
      $('#e_declaration_text_err').html('Declaration Text is required!');
      err++;
   }
   else {
      $('#e_declaration_text_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }   
}



</script>