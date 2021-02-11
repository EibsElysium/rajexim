<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Pre-Carriage By</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Pre_carriage_by/update_pre_carriage_by" onsubmit="return update_pre_carriage_by_validataion()">
         <input type="hidden" name="pre_carriage_by_id" value="<?php echo $pre_carriage_by_id->pre_carriage_by_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Pre-Carriage By<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Pre-Carriage by" name="e_pre_carriage_by" id="e_pre_carriage_by" onkeyup="e_checkUniquePreCarriage();" value="<?php echo $pre_carriage_by_id->pre_carriage_by; ?>">
                           <input type="hidden" id="ex_pre_carriage_by" value="<?php echo $pre_carriage_by_id->pre_carriage_by; ?>">
                           <span id="e_pre_carriage_by_err" class="text-danger"></span>
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
var expo = 0;
function e_checkUniquePreCarriage()
{
   var val = $('#e_pre_carriage_by').val();
   var ex_val = $('#ex_pre_carriage_by').val();
   if (val.toLowerCase() != ex_val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'Pre_carriage_by/checkUniquePreCarriage',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_pre_carriage_by_err').html('Pre-Carriage By already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               expo = 1;
            }
            else
            {
               $('#e_pre_carriage_by_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               expo = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function update_pre_carriage_by_validataion()
{
   var err = 0;
   var name = $('#e_pre_carriage_by').val();
   if(name == '')
   {
      $('#e_pre_carriage_by_err').html('Pre-Carriage by is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#e_pre_carriage_by_err').html('Pre-Carriage by already exists!');
         err++;
      }
      else
      {
         $('#e_pre_carriage_by_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}




</script>