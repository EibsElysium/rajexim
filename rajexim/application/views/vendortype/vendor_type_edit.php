<div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Vendor Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form name="edit_exporter" id="edit_exporter" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendortype/update_vendor_type" onsubmit="return vendor_type_edit_validation()">
               <input type="hidden" name="vendor_type_id" id="vendor_type_id" value="<?php echo $vendor_type_list->vendor_type_id;?>">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">                        
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <label>Vendor Type<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Vendor Type" name="vendor_type" id="vendor_type_edt" value="<?php echo $vendor_type_list->vendor_type;?>" onkeyup="checkUniqueVendorTypeEdit();">
                                 <span id="vendor_type_edit_err" class="text-danger"></span>
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
function checkUniqueVendorTypeEdit()
{
   var val = $('#vendor_type_edt').val();
   var eid = $('#vendor_type_id').val();

   $.ajax({
      type:"POST",
      url:baseurl+'vendortype/checkUniqueVendorTypeEdit',
      data:{'value':val,'eid':eid},
      cache: false,
      dataStatus: "html",
      success: function(result){
         if(result>0)
         {
            $('#vendor_type_edit_err').html('Vendor Type already exists!');
            $('#btnSubmit').prop('disabled', true);
            eexpo = 1;
         }
         else
         {
            $('#vendor_type_edit_err').html('');
            $('#btnSubmit').prop('disabled', false);
            eexpo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function vendor_type_edit_validation()
{
   var err = 0;
   var name = $('#vendor_type_edt').val();
   if(name == '')
   {
      $('#vendor_type_edit_err').html('Vendor Type is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#vendor_type_edit_err').html('Vendor Type already exists!');
         err++;
      }
      else
      {
         $('#vendor_type_edit_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

</script>