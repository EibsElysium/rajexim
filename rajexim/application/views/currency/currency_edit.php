<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Currency</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" action="<?php echo base_url(); ?>Currency/update_currency" onsubmit="return update_currency_validataion()">
         <input type="hidden" name="currency_id" value="<?php echo $currency_by_id->currency_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Currency Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Currency Name" name="e_currency_name" id="e_currency_name" onkeyup="e_checkUniqueCurrencyName();" value="<?php echo $currency_by_id->currency_name; ?>">
                           <input type="hidden" id="ex_currency_name" value="<?php echo $currency_by_id->currency_name; ?>">
                           <span id="e_currency_name_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Currency Code<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" onkeyup="e_checkUniqueCurrencyCode();" placeholder="Enter Currency Code" name="e_currency_code" id="e_currency_code" value="<?php echo $currency_by_id->currency_code; ?>">
                           <input type="hidden" id="ex_currency_code" value="<?php echo $currency_by_id->currency_code; ?>">
                           <span id="e_currency_code_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Currency Symbol<span class="text-danger"></span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Currency Symbol" name="e_currency_symb" id="e_currency_symb" value="<?php echo $currency_by_id->currency_symbol; ?>">
                           <span id="e_currency_symb" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">                        
                     <div class="col-lg-6">
                        <div class="form-group m-form__group">
                           <label>Currency Integer Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Currency Integer Name" name="e_currency_int" id="e_currency_int" value="<?php echo $currency_by_id->integer_name; ?>" >
                           <span id="e_currency_int_err" class="text-danger"></span>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group m-form__group">
                           <label>Currency Decimal Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Currency Decimal Name" name="e_currency_dec" id="e_currency_dec" value="<?php echo $currency_by_id->decimal_name; ?>">
                           <span id="e_currency_dec_err" class="text-danger"></span>
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
// To check exporter name is unique
var eexpo = 0;
function e_checkUniqueCurrencyName()
{
   var val = $('#e_currency_name').val();
   var ex_val = $('#ex_currency_name').val();
   if(val.toLowerCase() != ex_val.toLowerCase()){
      $.ajax({
         type:"POST",
         url:baseurl+'Currency/checkUniqueCurrencyName',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_currency_name_err').html('Currency Name already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_currency_name_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}
var eexpo1 = 0;
function e_checkUniqueCurrencyCode()
{
   var val = $('#e_currency_code').val();
   var ex_val = $('#ex_currency_code').val();
   if(val.toLowerCase() != ex_val.toLowerCase()){
      $.ajax({
         type:"POST",
         url:baseurl+'Currency/checkUniqueCurrencyCode',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_currency_code_err').html('Currency Code already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo1 = 1;
            }
            else
            {
               $('#e_currency_code_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo1 = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function update_currency_validataion()
{
   var err = 0;
   var name = $('#e_currency_name').val();
   var code = $('#e_currency_code').val();
   var currency_int = $('#e_currency_int').val();
   var currency_dec = $('#e_currency_dec').val();
   if(name == '')
   {
      $('#e_currency_name_err').html('Currency Name is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#e_currency_name_err').html('Currency Name already exists!');
         err++;
      }
      else
      {
         $('#e_currency_name_err').html('');
      }
   }
   if(code == '')
   {
      $('#e_currency_code_err').html('Currency Code is required!');
      err++;
   }else{
      if(eexpo1 == 1)
      {
         $('#e_currency_code_err').html('Currency Code already exists!');
         err++;
      }
      else
      {
         $('#e_currency_code_err').html('');
      }
   }
   if (currency_dec == '') {
      $('#e_currency_dec_err').html(' Currency Integer value is required!');
      err++;
   }
   else {
      $('#e_currency_dec_err').html(' ');
   }
   if (currency_int == '') {
      $('#e_currency_int_err').html(' Currency Decimal value is required!');
      err++;
   }
   else {
      $('#e_currency_int_err').html(' ');
   }
   if(err> 0){ return false;}else{ return true; }   
}


</script>