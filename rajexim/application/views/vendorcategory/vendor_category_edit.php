<div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Vendor Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form name="edit_exporter" id="edit_exporter" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendorcategory/update_vendor_category" onsubmit="return vendor_category_edit_validation()">
               <input type="hidden" name="vendor_category_id" id="vendor_category_id" value="<?php echo $vendor_category_list->vendor_category_id;?>">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">                        
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <label>Vendor Category<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Vendor Category" name="vendor_category" id="vendor_category_edt" value="<?php echo $vendor_category_list->vendor_category;?>" onkeyup="checkUniqueVendorCategoryEdit();">
                                 <span id="vendor_category_edit_err" class="text-danger"></span>
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
function checkUniqueVendorCategoryEdit()
{
   var val = $('#vendor_category_edt').val();
   var eid = $('#vendor_category_id').val();

   $.ajax({
      type:"POST",
      url:baseurl+'vendorcategory/checkUniqueVendorCategoryEdit',
      data:{'value':val,'eid':eid},
      cache: false,
      dataStatus: "html",
      success: function(result){
         if(result>0)
         {
            $('#vendor_category_edit_err').html('Vendor Category already exists!');
            $('#btnSubmit').prop('disabled', true);
            eexpo = 1;
         }
         else
         {
            $('#vendor_category_edit_err').html('');
            $('#btnSubmit').prop('disabled', false);
            eexpo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function vendor_category_edit_validation()
{
   var err = 0;
   var name = $('#vendor_category_edt').val();
   if(name == '')
   {
      $('#vendor_category_edit_err').html('Vendor Category is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#vendor_category_edit_err').html('Vendor Category already exists!');
         err++;
      }
      else
      {
         $('#vendor_category_edit_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

</script>