<div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Product Costing Type</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>productcostingtype/update_product_costing_type" onsubmit="return product_costing_type_edit_validation()">
         <input type="hidden" id="product_costing_type_id" name="product_costing_type_id" value="<?php echo $product_costing_type->product_costing_type_id;?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group m-form__group">
                     <label>Costing Category<span class="text-danger">*</span></label>
                     <select class="form-control m-bootstrap-select m_selectpicker" id="product_costing_category_id_edit" name="product_costing_category_id" data-live-search="true" onchange="getTypePCCEdit(this.value);">
                        <option value=''>Select Costing Category</option>
                        <?php foreach($product_costing_category_list as $pclist){?>
                           <option value="<?php echo $pclist['product_costing_category_id'];?>" <?php echo $pclist['product_costing_category_id']==$product_costing_type->product_costing_category_id?'selected':'';?>><?php echo $pclist['product_costing_category_name'];?></option>
                        <?php }?>
                     </select>
                     <span id="product_costing_category_id_edit_err" class="text-danger"></span>
                  </div>
               </div>

               <div class="col-lg-2">
                  <div class="form-group m-form__group">
                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                        <input type="checkbox" class="menu_checkbox" id="is_edit_edit" name="is_edit" value="<?php echo $product_costing_type->is_edit; ?>" <?php echo $product_costing_type->is_edit==1?'checked':''; ?> onchange="changePermissionCheck(this.id,this.value);"> Is Editable
                        <input type="hidden" class="menu_checkbox_hidden" id="is_edit_edithidden" name="is_edit" value=0 <?php echo $product_costing_type->is_edit==1?'disabled':''; ?>>
                        <span></span>
                     </label>
                  </div>
               </div>

               <div class="col-lg-2">
                  <div class="form-group m-form__group">
                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                        <input type="checkbox" class="menu_checkbox" id="is_defaultedit" name="is_default" value="<?php echo $product_costing_type->is_default; ?>" <?php echo $product_costing_type->is_default==1?'checked':''; ?> onchange="changePermissionCheck(this.id,this.value);"> is Default
                        <input type="hidden" class="menu_checkbox_hidden" id="is_defaultedithidden" name="is_default" value=0 <?php echo $product_costing_type->is_default==1?'disabled':''; ?>>
                        <span></span>
                     </label>
                  </div>
               </div>

               <div class="col-lg-2">
                  <div class="form-group m-form__group">
                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                        <input type="checkbox" class="menu_checkbox" id="is_inputedit" name="is_input" value="<?php echo $product_costing_type->is_input; ?>" <?php echo $product_costing_type->is_input==1?'checked':''; ?> onchange="changePermissionCheck(this.id,this.value);"> is Input
                        <input type="hidden" class="menu_checkbox_hidden" id="is_inputedithidden" name="is_input" value=0 <?php echo $product_costing_type->is_input==1?'disabled':''; ?>>
                        <span></span>
                     </label>
                  </div>
               </div>

            </div>
            <div class="row" id="mid0">
               <div class="col-lg-3">
                  <div class="form-group m-form__group">
                     <label>Costing Type<span class="text-danger">*</span></label>
                     <input type="text" class="form-control m-input m-input--square" id="product_costing_type_editt" name="product_costing_type" placeholder="Enter Costing Type" value="<?php echo $product_costing_type->product_costing_type;?>">
                     <span id="product_costing_type_edit_err" class="text-danger"></span>
                  </div>
               </div>
               <div class="col-lg-2">
                  <!-- <div class="form-group m-form__group mt_25px">
                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-success" style="margin-top: 10px;">
                        <input type="checkbox" class="menu_checkbox" id="is_percent_edit" name="is_percent" value="<?php //echo $product_costing_type->is_percent; ?>" <?php //echo $product_costing_type->is_percent==1?'checked':''; ?> onchange="changePermissionEdit(this.id,this.value);"> is % 
                        <input type="hidden" class="menu_checkbox_hidden" id="is_percent_edithidden" name="is_percent" value=0 <?php //echo $product_costing_type->is_percent==1?'disabled':''; ?>>
                        <span></span>
                     </label>
                  </div> -->
                  <div class="form-group m-form__group">
                     <label>Is % or /</label>
                     <select class="form-control custom-select" id="is_percent_edit" name="is_percent" onchange="changePermissionEdit(this.value);">
                        <option value="0" <?php echo $product_costing_type->is_percent==0?'selected':''; ?>>Select</option>
                        <option value="1" <?php echo $product_costing_type->is_percent==1?'selected':''; ?>>%</option>
                        <option value="2" <?php echo $product_costing_type->is_percent==2?'selected':''; ?>>/</option>
                     </select>
                  </div>
               </div>                      
               <div class="col-lg-3" id="ptcc_edit" style="<?php echo $product_costing_type->is_percent!=0?'':'display:none'; ?>">
                  <div class="form-group m-form__group">
                     <label>Type Costing Category<span class="text-danger">*</span></label>
                     <select class="form-control custom-select tcc_edit" id="type_costing_category_edit" name="type_costing_category">
                        <?php echo $st;?>
                     </select>
                     <span id="type_costing_category_edit_err" class="text-danger"></span>
                  </div>
               </div>
               <div class="col-lg-3">
                  <div class="form-group m-form__group">
                     <label>Mathematic Action<span class="text-danger">*</span></label>
                     <select class="form-control custom-select" id="math_action_edit" name="math_action">
                        <option value="">Select Mathematic Action</option>
                        <option value="Addition(+)" <?php echo $product_costing_type->math_action == 'Addition(+)'?'selected':'';?>>Addition ( + )</option>
                        <option value="Subtraction(-)" <?php echo $product_costing_type->math_action == 'Subtraction(-)'?'selected':'';?>>Subtraction ( - )</option>
                        <option value="Multiplication(*)" <?php echo $product_costing_type->math_action == 'Multiplication(*)'?'selected':'';?>>Multiplication ( * )</option>
                        <option value="Division(/)" <?php echo $product_costing_type->math_action == 'Division(/)'?'selected':'';?>>Division ( / )</option>
                     </select>
                     <span id="math_action_edit_err" class="text-danger"></span>
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

/*function changePermissionEdit(id,val)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;
      $('#ptcc_edit').hide();
      $('#type_costing_category_edit').val('');
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
      $('#ptcc_edit').show();
   }
}*/
function changePermissionEdit(val)
{
   if(val==0)
   {
      //$('#'+id).val(0);
      //document.getElementById(id+'hidden').disabled = false;
      $('#ptcc_edit').hide();
      $('#type_costing_category_edit').val('');
   }
   else
   {
      //$('#'+id).val(1);
      //document.getElementById(id+'hidden').disabled = true;
      $('#ptcc_edit').show();
   }
}

function product_costing_type_edit_validation()
{
   var err = 0;
   var pccid = $('#product_costing_category_id_edit').val();
   var pctype=$('#product_costing_type_editt').val();
   var maction=$('#math_action_edit').val();
   var ispercent = $('#is_percent_edit').val();

   if(pccid == '')
   {
      $('#product_costing_category_id_edit_err').html('Costing Category is required!');
      err++;
   }else{
      $('#product_costing_category_id_edit_err').html('');
   }

   if(pctype == '')
   {
      $('#product_costing_type_edit_err').html('Costing Type is required!');
      err++;
   }else{
      $('#product_costing_type_edit_err').html('');
   }

   if(ispercent!=0)
   {
      var tcc = $('#type_costing_category_edit').val();
      if(tcc == '')
      {
         $('#type_costing_category_edit_err').html('Category is required!');
         err++;
      }else{
         $('#type_costing_category_edit_err').html('');
      }
   }

   if(maction == '')
   {
      $('#math_action_edit_err').html('Mathematic Action is required!');
      err++;
   }else{
      $('#math_action_edit_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

function getTypePCCEdit(val)
{
   if(val!='')
   {
      $.ajax({
           type: "POST",
           url: baseurl+'productcostingtype/getTypePCC',
           async: false,
           type: "POST",
           data: "id="+val,
           dataType: "html",
           success: function(response)
           {
               $('.tcc_edit').empty().append(response);
           }
       });
   }
}
</script>