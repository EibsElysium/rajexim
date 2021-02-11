<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Terms of Payment</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Terms_of_payment/update_top" onsubmit="return edit_top_validataion()">
         <input type="hidden" name="top_id" value="<?php echo $top_by_id->terms_of_payment_id; ?>">
         <div class="modal-body">
            <div class="row">                        
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Terms of Payment Type</label>
                     <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="e_top_type" id="e_top_type" onchange="getTermsandPaymentEdit(this.value);">
                        <option value="">Choose Terms of Payment Type</option>
                           <?php
                              if(!empty($get_top_type))
                              {
                                 foreach ($get_top_type as $top_type) { if($top_type->status == 0){ ?>
                                    <option <?php echo($top_type->terms_of_payment_type_id == $top_by_id->terms_of_payment_type_id) ? 'selected' : ''; ?> value="<?php echo $top_type->terms_of_payment_type_id; ?>" ><?php echo $top_type->terms_of_payment_type; ?></option>
                                 <?php } }
                              }
                           ?>
                     </select>
                     <span id="e_top_type_err" class="text-danger"></span>
                  </div>
               </div>
            </div>
            
            <div class="row">                        
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Terms and Payment</label>
                     <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="terms_and_payment_id" id="terms_and_payment_id_edit">
                        <option value="">Choose Terms And Payment</option>
                           <?php
                              if(!empty($tap_list))
                              {
                                 foreach ($tap_list as $tlist) { if($tlist['status'] == 0){ ?>
                                    <option <?php echo($tlist['terms_and_payment_id'] == $top_by_id->terms_and_payment_id) ? 'selected' : ''; ?> value="<?php echo $tlist['terms_and_payment_id']; ?>" ><?php echo $tlist['terms_and_payment']; ?></option>
                                 <?php } }
                              }
                           ?>
                     </select>
                     <span id="terms_and_payment_id_edit_err" class="text-danger"></span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Terms of Payment Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Terms of Payment Name" name="e_top_name" id="e_top_name" onkeyup="e_checkUniquetopName();" value="<?php echo $top_by_id->terms_of_payment_name; ?>">
                           <input type="hidden" id="ex_top_name" value="<?php echo $top_by_id->terms_of_payment_name; ?>">
                           <span id="e_top_name_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Terms of Payment Text<span class="text-danger">*</span></label>
                           <textarea class="form-control snote" placeholder="Enter Terms of Payment Text" name="e_top_text" id="e_top_text" ><?php echo $top_by_id->terms_of_payment_text; ?></textarea>
                           <span id="e_top_text_err" class="text-danger"></span>
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
   $('#e_top_type').selectpicker();
   $('.m_selectpicker').selectpicker();
   $('.snote').summernote();



function getTermsandPaymentEdit(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'Terms_of_payment/getTermsandPayment',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#terms_and_payment_id_edit').empty().html(response).selectpicker('refresh');
        }
      });
   }
   else
   {      
      $('#terms_and_payment_id_edit').empty().html('<option vaue="">Choose Term and Payment</option>').selectpicker('refresh');
   }
}

var eexpo = 0;
function e_checkUniquetopName()
{
   var val = $('#e_top_name').val();
   var ex_val = $('#ex_top_name').val();
   if (val.toLowerCase() != ex_val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'Terms_of_payment/checkUniquetopName',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_top_name_err').html('Terms of payment Name already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_top_name_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function edit_top_validataion()
{
   var err = 0;
   var name = $('#e_top_name').val();
   var txt = $('#e_top_text').val();
   var type = $('#e_top_type').val();
   var tapid = $('#terms_and_payment_id_edit').val();
   if(name == '')
   {
      $('#e_top_name_err').html('Terms of payment Name is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#e_top_name_err').html('Terms of payment Name already exists!');
         err++;
      }
      else
      {
         $('#e_top_name_err').html('');
      }
   }
   if (txt.trim() == '') {
      $('#e_top_text_err').html('Terms of payment Text is required!');
      err++;
   }
   else {
      $('#e_top_text_err').html('');
   }
   if (type == '') {
      $('#e_top_type_err').html('Terms of payment Type is required!');
      err++;
   }
   else {
      $('#e_top_type_err').html('');
   }
   if (tapid == '') {
      $('#terms_and_payment_id_edit_err').html('Choose Terms and Payment!');
      err++;
   }
   else {
      $('#terms_and_payment_id_edit_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }   
}


</script>