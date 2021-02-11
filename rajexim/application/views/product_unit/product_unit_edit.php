<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Product Unit</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Settings/update_product_unit" onsubmit="return update_product_unit_validataion()">
         <input type="hidden" name="product_unit_id" value="<?php echo $get_product_unit_by_id->product_unit_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Product Unit<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Product Unit" name="e_product_unit" id="e_product_unit" onkeyup="e_checkUniquePIStage();" value="<?php echo $get_product_unit_by_id->product_unit; ?>">
                           <input type="hidden" name="ex_product_unit" id="ex_product_unit" value="<?php echo $get_product_unit_by_id->product_unit; ?>">
                           <span id="e_product_unit_err" class="text-danger"></span>
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
   var val = $('#e_product_unit').val();
   var ex_val = $('#ex_product_unit').val();
   if(val.toLowerCase() != ex_val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'Settings/checkUniqueprounit',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_product_unit_err').html('Product Unit already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_product_unit_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function update_product_unit_validataion()
{
   var err = 0;
   var name = $('#e_product_unit').val();
   if(name == '')
   {
      $('#e_product_unit_err').html('Product Unit is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#e_product_unit_err').html('Product Unit already exists!');
         err++;
      }
      else
      {
         $('#e_product_unit_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}



</script>