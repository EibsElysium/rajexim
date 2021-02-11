<div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Followup Sheet Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>followupsheetcategory/update_followup_sheet_category" onsubmit="return followup_sheet_category_edit_validation()">
                  <input type="hidden" id="followup_sheet_category_id" name="followup_sheet_category_id" value="<?php echo $followup_sheet_category->followup_sheet_category_id;?>">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Category<span class="text-danger">*</span></label>
                              <input type="text" class="form-control m-input m-input--square" placeholder="Enter Followup Sheet Category" id="followup_sheet_categoryedit" name="followup_sheet_category" onkeyup="checkUniqueFollowupSheetCategoryEdit();" value="<?php echo $followup_sheet_category->followup_sheet_category;?>">
                              <span id="followup_sheet_category_edit_err" class="text-danger"></span>
                           </div>
                        </div>                           
                     </div>
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group m-form__group">
                              <label>Input Type<span class="text-danger">*</span></label>
                              <select class="form-control custom-select" id="input_type_edit" name="input_type">
                                 <option value="">Select Type</option>
                                 <option value="0" <?php echo $followup_sheet_category->input_type==0?'selected':'';?>>Textbox</option>
                                 <option value="1" <?php echo $followup_sheet_category->input_type==1?'selected':'';?>>Checkbox</option>
                              </select>
                              <span id="input_type_edit_err" class="text-danger"></span>
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group m-form__group">
                              <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                        <input type="checkbox" class="menu_checkbox" id="is_default_edit" name="is_default" value="<?php echo $followup_sheet_category->is_default; ?>" <?php echo $followup_sheet_category->is_default==1?'checked':''; ?> onchange="changePermissionCheck(this.id,this.value);"> is Default
                        <input type="hidden" class="menu_checkbox_hidden" id="is_default_edithidden" name="is_default" value=0 <?php echo $followup_sheet_category->is_default==1?'disabled':''; ?>>
                        <span></span>
                     </label>
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

var expoe = 0;
function checkUniqueFollowupSheetCategoryEdit()
{
   var val = $('#followup_sheet_categoryedit').val();
   var fscid = $('#followup_sheet_category_id').val();
   $.ajax({
      type:"POST",
      url:baseurl+'followupsheetcategory/checkUniqueFollowupSheetCategoryEdit',
      data:{'value':val,'fscid':fscid},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#followup_sheet_category_edit_err').html('Category already exists!');
            $('#btnSubmit').prop('disabled', true);
            expoe = 1;
         }
         else
         {
            $('#followup_sheet_category_edit_err').html('');
            $('#btnSubmit').prop('disabled', false);
            expoe = 0;
         }
      }
   });
}


function followup_sheet_category_edit_validation()
{
   var err = 0;
   var name = $('#followup_sheet_categoryedit').val();
   var itype = $('#input_type_edit').val();
   if(name == '')
   {
      $('#followup_sheet_category_edit_err').html('Category is required!');
      err++;
   }else{
      if(expoe == 1)
      {
         $('#followup_sheet_category_edit_err').html('Category already exists!');
         err++;
      }
      else
      {
         $('#followup_sheet_category_edit_err').html('');
      }
   }

   if(itype=='')
   {
      $('#input_type_edit_err').html('Choose Type!');
      err++;
   }
   else
   {
      $('#input_type_edit_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}
</script>