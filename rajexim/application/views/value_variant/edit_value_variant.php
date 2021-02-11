<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Value Variant</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Settings/update_vv" onsubmit="return edit_vv_validation()">
         <input type="hidden" name="vv_id" value="<?php echo $get_vv_by_id->vv_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>From Amount<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter From Amount" name="e_from_amnt" id="e_from_amnt" onkeyup="chk_unique_from_amnt();" value="<?php echo $get_vv_by_id->vv_from_amount; ?>">
                           <input type="hidden" id="ex_from_amnt" value="<?php echo $get_vv_by_id->vv_from_amount; ?>">
                           <span id="e_from_amnt_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>To Amount<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter to Amount" name="e_to_amnt" id="e_to_amnt" onkeyup="chk_unique_to_amnt();" value="<?php echo $get_vv_by_id->vv_to_amount; ?>">
                           <input type="hidden" id="ex_to_amnt" value="<?php echo $get_vv_by_id->vv_to_amount; ?>">
                           <span id="e_to_amnt_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Value Color</label>
                           <input type="text"  class="form-control m-input m-input--square picker4" readonly placeholder="Choose Value Color" name="value_color" id="value_color" value="<?php echo $get_vv_by_id->vv_color; ?>">
                           <span id="value_color_err" class="text-danger"></span>
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
   $('.picker4').colorpicker({
      colorSelectors: {
          'default': '#A9B6BC',
          'primary': '#418BCA',
          'success': '#01BC8C',
          'info': '#67C5DF',
          'warning': '#F89A14',
          'danger': '#EF6F6C'
      }
   });
   $('#e_top_type').selectpicker();
   
   var eexpo = 0;
   
   function chk_unique_from_amnt()
   
   {
   
   var val = $('#e_from_amnt').val();
   
   var ex_val = $('#ex_from_amnt').val();
   
   if (val.toLowerCase() != ex_val.toLowerCase()) {
   
      $.ajax({
   
         type:"POST",
   
         url:baseurl+'Settings/chk_unique_from_amnt',
   
         data:{'value':val},
   
         cache: false,
   
         dataType: "html",
   
         success: function(result){
   
            if(result>0)
   
            {
   
               $('#e_from_amnt_err').html('From Amount Value already exists!');
   
               $('#e_btnSubmit').prop('disabled', true);
   
               eexpo = 1;
   
            }
   
            else
   
            {
   
               $('#e_from_amnt_err').html('');
   
               $('#e_btnSubmit').prop('disabled', false);
   
               eexpo = 0;
   
            }
   
         }
   
      });
   
   }
   
   }
   etoexp = 0;
   function chk_unique_to_amnt()
   
   {
   
   var val = $('#e_to_amnt').val();
   
   var ex_val = $('#ex_to_amnt').val();
   
   if (val.toLowerCase() != ex_val.toLowerCase()) {
   
      $.ajax({
   
         type:"POST",
   
         url:baseurl+'Settings/chk_unique_to_amnt',
   
         data:{'value':val},
   
         cache: false,
   
         dataType: "html",
   
         success: function(result){
   
            if(result>0)
   
            {
   
               $('#e_to_amnt_err').html('To Amount Value already exists!');
   
               $('#e_btnSubmit').prop('disabled', true);
   
               etoexp = 1;
   
            }
   
            else
   
            {
   
               $('#e_to_amnt_err').html('');
   
               $('#e_btnSubmit').prop('disabled', false);
   
               etoexp = 0;
   
            }
   
         }
   
      });
   
   }
   
   }
   
   
   
   
   // To validate lead Status add form
   
   function edit_vv_validation()
   
   {
   
   var err = 0;
   
   var from = $('#e_from_amnt').val();
   
   var to = $('#e_to_amnt').val();
   
   var v_color = $('#value_color').val();
   
   if(from == '')
   {
      $('#e_from_amnt_err').html('From Amount is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#e_from_amnt_err').html('From Amount is already exists!');
         err++;
      }
      else
      {
         $('#e_from_amnt_err').html('');
      }
   }
   if (to.trim() == '') {
      $('#e_to_amnt_err').html('To Amount is required!');
      err++;
   }
   else {
      if(etoexp == 1)
      {
         $('#e_to_amnt_err').html('To Amount is already exists!');
         err++;
      }
      else
      {
         $('#e_to_amnt_err').html('');
      }
   
   }
   
   if (v_color == '') {
   
      $('#value_color_err').html('Value Color is required!');
   
      err++;
   
   }
   
   else {
   
      $('#value_color_err').html('');
   
   }
   
   if(err > 0){ return false; } else { return true; }   
   
   }
   
   
   
   
   
</script>