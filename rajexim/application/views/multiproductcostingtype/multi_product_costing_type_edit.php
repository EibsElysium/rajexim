<div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Multi Product Costing Type</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form name="create_exporter" id="edit_create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>multiproductcostingtype/update_multi_product_costing_type" onsubmit="return multi_product_costing_type_edit_validation()">
         <input type="hidden" id="multi_product_costing_type_id" name="multi_product_costing_type_id" value="<?php echo $multi_product_costing_type->multi_product_costing_type_id;?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-3">
                  <div class="form-group m-form__group">
                     <label>Costing Type<span class="text-danger">*</span></label>
                     <input type="text" class="form-control m-input m-input--square" id="multi_product_costing_type_edit" name="multi_product_costing_type" placeholder="Enter Costing Type" value="<?php echo $multi_product_costing_type->multi_product_costing_type;?>">
                     <span id="multi_product_costing_type_edit_err" class="text-danger"></span>
                  </div>
               </div>

               <div class="col-lg-3">
                  <div class="form-group m-form__group">
                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                        <input type="checkbox" class="menu_checkbox" id="is_edit_edit" name="is_edit" value="<?php echo $multi_product_costing_type->is_edit; ?>" <?php echo $multi_product_costing_type->is_edit==1?'checked':''; ?> onchange="changePermissionCheckEdit(this.id,this.value);"> Is Editable
                        <input type="hidden" class="menu_checkbox_hidden" id="is_edit_edithidden" name="is_edit" value=0 <?php echo $multi_product_costing_type->is_edit==1?'disabled':''; ?>>
                        <span></span>
                     </label>
                  </div>
               </div>

               <div class="col-lg-3" id="maction_edit">
                  <div class="form-group m-form__group">
                     <label>Mathematic Action</label>
                     <select class="form-control custom-select" id="math_action_edit" name="math_action" onchange="changemathtypeEdit(this.value);">
                        <option value="">Select Mathematic Action</option>
                        <option value="Addition(+)" <?php echo $multi_product_costing_type->math_action == 'Addition(+)'?'selected':'';?>>Addition ( + )</option>
                        <option value="Subtraction(-)" <?php echo $multi_product_costing_type->math_action == 'Subtraction(-)'?'selected':'';?>>Subtraction ( - )</option>
                        <option value="Multiplication(*)" <?php echo $multi_product_costing_type->math_action == 'Multiplication(*)'?'selected':'';?>>Multiplication ( * )</option>
                        <option value="Division(/)" <?php echo $multi_product_costing_type->math_action == 'Division(/)'?'selected':'';?>>Division ( / )</option>
                        <option value="Percentage(%)" <?php echo $multi_product_costing_type->math_action == 'Percentage(%)'?'selected':'';?>>Percentage ( % )</option>
                     </select>
                     <span id="math_action_edit_err" class="text-danger"></span>
                  </div>
               </div>

               <div class="col-lg-3" id="mtype_edit" style="<?php echo $multi_product_costing_type->math_action=='Division(/)'?'display:none':'';?>">
                  <div class="form-group m-form__group">
                     <label>Math Type</label>
                     <select class="form-control m-bootstrap-select m_selectpicker" multiple id="multi_product_costing_type_id_math_edit" name="multi_product_costing_type_id_math[]" data-live-search="true"> 
                        <option value=''>Choose</option> 
                        <?php if(count($multi_product_costing_type_list)>0){
                           $iprods = explode(',', $multi_product_costing_type->multi_product_costing_type_id_math);
                           foreach($multi_product_costing_type_list as $mpctl)
                           {?>
                              <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>" <?php echo in_array($mpctl['multi_product_costing_type_id'], $iprods)?'selected':'';?>><?php echo $mpctl['multi_product_costing_type'];?></option>
                           <?php }
                        }?>
                     </select>
                     <span class="text-danger" id="multi_product_costing_type_id_math_edit_err"></span>
                  </div>
               </div>

               <div class="col-lg-3" id="mtype_div_edit"  style="<?php echo $multi_product_costing_type->math_action!='Division(/)'?'display:none':'';?>">
                  <div class="form-group m-form__group">
                     <label>Math Type</label>
                     <select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math1_edit" name="multi_product_costing_type_id_math1" data-live-search="true"> 
                        <option value=''>Choose</option> 
                        <?php if(count($multi_product_costing_type_list)>0){
                           foreach($multi_product_costing_type_list as $mpctl)
                           {?>
                              <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>" <?php echo $multi_product_costing_type->multi_product_costing_type_id_math == $mpctl['multi_product_costing_type_id']?'selected':'';?>><?php echo $mpctl['multi_product_costing_type'];?></option>
                           <?php }
                        }?>
                     </select>
                     <span class="text-danger" id="multi_product_costing_type_id_math1_edit_err"></span>
                  </div>
               </div>

               <div class="col-lg-3" id="mtype_1_div_edit"  style="<?php echo $multi_product_costing_type->math_action!='Division(/)'?'display:none':'';?>">
                  <div class="form-group m-form__group">
                     <label>Math Type</label>
                     <select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math_1_edit" name="multi_product_costing_type_id_math_1" data-live-search="true"> 
                        <option value=''>Choose</option> 
                        <?php if(count($multi_product_costing_type_list)>0){
                           foreach($multi_product_costing_type_list as $mpctl)
                           {?>
                              <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>" <?php echo $multi_product_costing_type->multi_product_costing_type_id_math_1 == $mpctl['multi_product_costing_type_id']?'selected':'';?>><?php echo $mpctl['multi_product_costing_type'];?></option>
                           <?php }
                        }?>
                     </select>
                     <span class="text-danger" id="multi_product_costing_type_id_math_1_edit_err"></span>
                  </div>
               </div>

               <div class="col-lg-3" id="mtype_2_div_edit"  style="<?php echo $multi_product_costing_type->math_action!='Division(/)'?'display:none':'';?>">
                  <div class="form-group m-form__group">
                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                        <input type="checkbox" class="menu_checkbox" id="is_nop_greater_edit" name="is_nop_greater" value="<?php echo $multi_product_costing_type->is_nop_greater; ?>" <?php echo $multi_product_costing_type->is_nop_greater==1?'checked':''; ?> onchange="changePermissionEdit(this.id,this.value);"> Is No of Pack > 1 (Multiply)
                        <input type="hidden" class="menu_checkbox_hidden" id="is_nop_greater_edithidden" name="is_nop_greater" value=0 <?php echo $multi_product_costing_type->is_nop_greater==1?'disabled':''; ?>>
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

 

function changemathtypeEdit(val)
{
   if(val=='Division(/)')
   {
      $('#mtype_edit').hide();
      $('#mtype_div_edit').show();
      $('#mtype_1_div_edit').show();
      $('#mtype_2_div_edit').show();
   }
   else
   {
      $('#mtype_edit').show();
      $('#mtype_div_edit').hide();
      $('#mtype_1_div_edit').hide();
      $('#mtype_2_div_edit').hide();
   }
}


function changePermissionCheckEdit(id,val)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;

      $('#math_action_edit').val('');
      $('#maction_edit').show();
      $('#multi_product_costing_type_id_math_edit').val('');
      $('#mtype_edit').show();
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
      $('#math_action_edit').val('');
      $('#maction_edit').hide();
      $('#multi_product_costing_type_id_math_edit').val('');
      $('#mtype_edit').hide();
   }
}


function changePermissionEdit(id,val)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
   }
}

function multi_product_costing_type_edit_validation()
{
   var err = 0;
   var pctype = $('#multi_product_costing_type_edit').val();
   
   if(pctype == '')
   {
      $('#multi_product_costing_type_edit_err').html('Costing Type is required!');
      err++;
   }else{
      $('#multi_product_costing_type_edit_err').html('');
   }

   //if($('#is_edit'). is(":not(:checked)")){
      var maction = $('#math_action_edit').val();
      var mtype = $('#multi_product_costing_type_id_math_edit').val();
      var mtype1 = $('#multi_product_costing_type_id_math1_edit').val();
      var mtype_1 = $('#multi_product_costing_type_id_math_1_edit').val();
      /*if(maction == '')
      {
         $('#math_action_err').html('Mathematic Action is required!');
         err++;
      }else{
         $('#math_action_err').html('');
      }*/

      if(maction!='' && maction!='Division(/)' && mtype == '')
      {
         $('#multi_product_costing_type_id_math_edit_err').html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_edit_err').html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype1 == '')
      {
         $('#multi_product_costing_type_id_math1_edit_err').html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math1_edit_err').html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype_1 == '')
      {
         $('#multi_product_costing_type_id_math_1_edit_err').html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_1_edit_err').html('');
      }
   //}
   
   if(err> 0){ return false;}else{ return true; }   
}
</script>