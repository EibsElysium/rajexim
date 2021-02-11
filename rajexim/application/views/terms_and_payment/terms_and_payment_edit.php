<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Terms and Payment</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Terms_and_payment/update_tap" onsubmit="return edit_tap_validataion()">
         <input type="hidden" name="tap_id" value="<?php echo $tap_by_id->terms_and_payment_id; ?>">
         <div class="modal-body">
            <div class="row">                        
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Terms of Payment Type</label>
                     <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="terms_of_payment_type_id" id="terms_of_payment_type_id_edit">
                        <option value="">Choose Terms of Payment Type</option>
                           <?php
                              if(!empty($get_top_type))
                              {
                                 foreach ($get_top_type as $top_type) { if($top_type->status == 0){ ?>
                                    <option value="<?php echo $top_type->terms_of_payment_type_id; ?>" <?php echo $top_type->terms_of_payment_type_id == $tap_by_id->terms_of_payment_type_id?'selected':''; ?>><?php echo $top_type->terms_of_payment_type; ?></option>
                                 <?php } }
                              }
                           ?>
                     </select>
                     <span id="terms_of_payment_type_id_edit_err" class="text-danger"></span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Terms and Payment Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Terms and Payment Name" name="e_tap_name" id="e_tap_name" onkeyup="e_checkUniquetapName();" value="<?php echo $tap_by_id->terms_and_payment; ?>">
                           <input type="hidden" id="ex_tap_name" value="<?php echo $tap_by_id->terms_and_payment; ?>">
                           <span id="e_tap_name_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Terms and Payment Value<span class="text-danger">*</span></label>
                           <textarea class="form-control snote" name="e_tap_value" id="e_tap_value" rows="5"><?php echo $tap_by_id->terms_and_payment_value; ?></textarea>
                           <span id="e_tap_value_err" class="text-danger"></span>
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
   $('#e_tap_type').selectpicker();
   $('.m_selectpicker').selectpicker();
   $('.snote').summernote();
var eexpo = 0;
function e_checkUniquetapName()
{
   var val = $('#e_tap_name').val();
   var ex_val = $('#ex_tap_name').val();
   if (val.toLowerCase() != ex_val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'Terms_and_payment/checkUniquetapName',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_tap_name_err').html('Terms and payment Name already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_tap_name_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function edit_tap_validataion()
{
   var err = 0;
   var name = $('#e_tap_name').val();
   var value = $('#e_tap_value').val();
   var topt = $('#terms_of_payment_type_id_edit').val();
   if(name == '')
   {
      $('#e_tap_name_err').html('Terms and payment Name is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#e_tap_name_err').html('Terms and payment Name already exists!');
         err++;
      }
      else
      {
         $('#e_tap_name_err').html('');
      }
   }

   if(value=='')
   {
      $('#e_tap_value_err').html('Terms and Payment Value is required!');
      err++
   }
   else
   {
      $('#e_tap_value_err').html('');
   }

   if(topt=='')
   {
      $('#terms_of_payment_type_id_edit_err').html('Choose Terms of Payment Type!');
      err++
   }
   else
   {
      $('#terms_of_payment_type_id_edit_err').html('');
   }
  
   if(err> 0){ return false;}else{ return true; }   
}


</script>