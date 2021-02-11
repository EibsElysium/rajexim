<div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Multi Product Costing Type</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="update_multi_product_costing_template" id="update_multi_product_costing_template" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>multiproductcostingtemplate/create_multi_product_costing_template" onsubmit="return multi_product_costing_template_edit_validation()">
               <input type="hidden" id="multi_product_costing_template_id_edit" name="multi_product_costing_template_id" value="<?php echo $multi_product_costing_template->multi_product_costing_template_id;?>">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Template<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="multi_product_costing_template_edit" name="multi_product_costing_template" placeholder="Enter Costing Template" value="<?php echo $multi_product_costing_template->multi_product_costing_template;?>">
                           <span id="multi_product_costing_template_edit_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>

                  <div id="mcontent_edit10">
                     <?php $i=0;foreach($multi_product_costing_type_list as $psstage){?>
                        <div id="mid_edit<?php echo $i;?>">
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="form-group m-form__group">
                                    <label>Costing Type<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" id="multi_product_costing_type_edit<?php echo $i;?>" name="multi_product_costing_type[]" placeholder="Enter Costing Type" value="<?php echo $psstage['multi_product_costing_type'];?>">
                                    <span id="multi_product_costing_type_edit_err<?php echo $i;?>" class="text-danger"></span>
                                    <input type="hidden" id="stage_no_edit<?php echo $i;?>" name="stage_no[]" value="<?php echo $psstage['stage_no'];?>">
                                 </div>
                              </div>

                              <div class="col-lg-3">
                                 <div class="form-group m-form__group">
                                    <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                       <input type="checkbox" class="menu_checkbox" id="is_edit_edit<?php echo $i;?>" name="is_edit[]" value="<?php echo $psstage['is_edit']; ?>" <?php echo $psstage['is_edit']==1?'checked':''; ?> onchange="changePermissionCheckEdit(this.id,this.value,<?php echo $i;?>);"> Is Editable
                                       <input type="hidden" class="menu_checkbox_hidden" id="is_edit_edit<?php echo $i;?>hidden" name="is_edit[]" value=0 <?php echo $psstage['is_edit']==1?'disabled':''; ?>>
                                       <span></span>
                                    </label>
                                 </div>
                              </div>

                              <div class="col-lg-3">
                                 <div class="form-group m-form__group">
                                    <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                       <input type="checkbox" class="menu_checkbox" id="is_display_edit<?php echo $i;?>" name="is_display[]"value="<?php echo $psstage['is_display']; ?>" <?php echo $psstage['is_display']==1?'checked':''; ?> onchange="changePermissionEdit(this.id,this.value,<?php echo $i;?>);"> Is Display
                                       <input type="hidden" class="menu_checkbox_hidden" id="is_display_edit<?php echo $i;?>hidden" name="is_display[]" value=0 <?php echo $psstage['is_display']==1?'disabled':''; ?>>
                                       <span></span>
                                    </label>
                                 </div>
                              </div>

                              <div class="col-lg-3" id="maction_edit<?php echo $i;?>">
                                 <div class="form-group m-form__group">
                                    <label>Mathematic Action</label>
                                    <select class="form-control custom-select" id="math_action_edit<?php echo $i;?>" name="math_action[]" onchange="changemathtype_edit(this.value,<?php echo $i;?>);">
                                       <option value="">Select Mathematic Action</option>
                                       <option value="Addition(+)" <?php echo $psstage['math_action'] == 'Addition(+)'?'selected':'';?>>Addition ( + )</option>
                                       <option value="Subtraction(-)" <?php echo $psstage['math_action'] == 'Subtraction(-)'?'selected':'';?>>Subtraction ( - )</option>
                                       <option value="Multiplication(*)" <?php echo $psstage['math_action'] == 'Multiplication(*)'?'selected':'';?>>Multiplication ( * )</option>
                                       <option value="Division(/)" <?php echo $psstage['math_action'] == 'Division(/)'?'selected':'';?>>Division ( / )</option>
                                       <option value="Percentage(%)" <?php echo $psstage['math_action'] == 'Percentage(%)'?'selected':'';?>>Percentage ( % )</option>
                                    </select>
                                    <span id="math_action_edit_err<?php echo $i;?>" class="text-danger"></span>
                                 </div>
                              </div>

                              <div class="col-lg-3" id="mtype_edit<?php echo $i;?>" style="<?php echo $psstage['math_action']=='Division(/)'?'display:none':'';?>">
                                 <div class="form-group m-form__group">
                                    <label>Math Type</label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" multiple id="multi_product_costing_type_id_math_edit<?php echo $i;?>" name="multi_product_costing_type_id_math[<?php echo $i;?>][]" data-live-search="true"> 
                                       <option value=''>Choose</option> 
                                       <?php if(count($multi_product_costing_type_list)>0){
                                             $iprods = explode(',', $psstage['multi_product_costing_type_id_math']);
                                             foreach($multi_product_costing_type_list as $mpctl)
                                             {
                                                if($mpctl['multi_product_costing_type_id']<$psstage['multi_product_costing_type_id']){?>
                                                <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>" <?php echo in_array($mpctl['multi_product_costing_type_id'], $iprods)?'selected':'';?>><?php echo $mpctl['multi_product_costing_type'];?></option>
                                             <?php } }
                                          }?>
                                    </select>
                                    <span class="text-danger" id="multi_product_costing_type_id_math_edit_err<?php echo $i;?>"></span>
                                 </div>
                              </div>

                              <div class="col-lg-3" id="mtype_div_edit<?php echo $i;?>" style="<?php echo $psstage['math_action']!='Division(/)'?'display:none':'';?>">
                                 <div class="form-group m-form__group">
                                    <label>Math Type</label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math1_edit<?php echo $i;?>" name="multi_product_costing_type_id_math1[]" data-live-search="true"> 
                                       <option value=''>Choose</option> 
                                       <?php if(count($multi_product_costing_type_list)>0){
                                          foreach($multi_product_costing_type_list as $mpctl)
                                          {if($mpctl['multi_product_costing_type_id']<$psstage['multi_product_costing_type_id']){?>
                                             <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>" <?php echo $psstage['multi_product_costing_type_id_math'] == $mpctl['multi_product_costing_type_id']?'selected':'';?>><?php echo $mpctl['multi_product_costing_type'];?></option>
                                          <?php } }
                                       }?>
                                    </select>
                                    <span class="text-danger" id="multi_product_costing_type_id_math1_edit_err<?php echo $i;?>"></span>
                                 </div>
                              </div>

                              <div class="col-lg-3" id="mtype_1_div_edit<?php echo $i;?>" style="<?php echo $psstage['math_action']!='Division(/)'?'display:none':'';?>">
                                 <div class="form-group m-form__group">
                                    <label>Math Type</label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math_1
                                    _edit<?php echo $i;?>" name="multi_product_costing_type_id_math_1[]" data-live-search="true"> 
                                       <option value=''>Choose</option> 
                                       <?php if(count($multi_product_costing_type_list)>0){
                                          foreach($multi_product_costing_type_list as $mpctl)
                                          {if($mpctl['multi_product_costing_type_id']<$psstage['multi_product_costing_type_id']){?>
                                             <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>" <?php echo $psstage['multi_product_costing_type_id_math_1'] == $mpctl['multi_product_costing_type_id']?'selected':'';?>><?php echo $mpctl['multi_product_costing_type'];?></option>
                                          <?php } }
                                       }?>
                                    </select>
                                    <span class="text-danger" id="multi_product_costing_type_id_math_1_edit_err<?php echo $i;?>"></span>
                                 </div>
                              </div>

                              <div class="col-lg-3" id="mtype_2_div_edit<?php echo $i;?>" style="<?php echo $psstage['math_action']!='Division(/)'?'display:none':'';?>">
                                 <div class="form-group m-form__group">
                                    <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                       <input type="checkbox" class="menu_checkbox" id="is_nop_greater_edit<?php echo $i;?>" name="is_nop_greater[]" value="<?php echo $psstage['is_nop_greater']; ?>" <?php echo $psstage['is_nop_greater']==1?'checked':''; ?> onchange="changePermissionEdit(this.id,this.value,<?php echo $i;?>);"> Is No of Pack > 1 (Multiply)
                                       <input type="hidden" class="menu_checkbox_hidden" id="is_nop_greater_edit<?php echo $i;?>hidden" name="is_nop_greater[]" value=0 <?php echo $psstage['is_nop_greater']==1?'disabled':''; ?>>
                                       <span></span>
                                    </label>
                                 </div>
                              </div>

                           </div>
                           <hr>
                        </div>
                     <?php $i++;}?>
                  </div>

                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <div class="pull-right">
                              <button type="button" class="btn btn-primary" onclick="add_pcs_type_edit()">
                                 <i class="fa fa-plus"></i>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" id="mailcount_edit" name="mailcount" value="<?php echo count($multi_product_costing_type_list);?>">

               </div>
               <div class="modal-footer">
                  <button type="submit" id="btnSubmit" name="gobutton" value="go" class="btn btn-primary">Save Changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>

<script>
$('.m_selectpicker').selectpicker();




function changemathtype_edit(val,i)
{
   if(val=='Division(/)')
   {
      $('#mtype_edit'+i).hide();
      $('#mtype_div_edit'+i).show();
      $('#mtype_1_div_edit'+i).show();
      $('#mtype_2_div_edit'+i).show();
   }
   else
   {
      $('#mtype_edit'+i).show();
      $('#mtype_div_edit'+i).hide();
      $('#mtype_1_div_edit'+i).hide();
      $('#mtype_2_div_edit'+i).hide();
   }
}


function changePermissionCheckEdit(id,val,i)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;

      $('#math_action_edit'+i).val('');
      $('#maction_edit'+i).show();
      $('#multi_product_costing_type_id_math_edit'+i).val('');
      $('#mtype_edit'+i).show();
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
      $('#math_action_edit'+i).val('');
      $('#maction_edit'+i).hide();
      $('#multi_product_costing_type_id_math_edit'+i).val('');
      $('#mtype_edit'+i).hide();
   }
}


function changePermissionEdit(id,val,i)
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

var expoe=0;

function multi_product_costing_template_edit_validation()
{
   var err = 0;

   var mpctemp = $('#multi_product_costing_template_edit').val();
   if(mpctemp == '')
   {
      $('#multi_product_costing_template_edit_err').html('Template is required!');
      err++;
   }else{
      //$('#multi_product_costing_template_err').html('');
      if(expoe == 1)
      {
         $('#multi_product_costing_template_edit_err').html('Template already exists!');
         err++;
      }
      else
      {
         $('#multi_product_costing_template_edit_err').html('');
      }
   }

   $("div[id^='mid_edit']").each(function(){
      var id = this.id;
      var res = id.substring(8);
      var pctype = $('#multi_product_costing_type_edit'+res).val();
      if(pctype == '')
      {
         $('#multi_product_costing_type_edit_err'+res).html('Costing Type is required!');
         err++;
      }else{
         $('#multi_product_costing_type_edit_err'+res).html('');
      }
      
      var maction = $('#math_action_edit'+res).val();
      var mtype = $('#multi_product_costing_type_id_math_edit'+res).val();
      var mtype1 = $('#multi_product_costing_type_id_math1_edit'+res).val();
      var mtype_1 = $('#multi_product_costing_type_id_math_1_edit'+res).val();

      if(maction!='' && maction!='Division(/)' && mtype == '')
      {
         $('#multi_product_costing_type_id_math_edit_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_edit_err'+res).html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype1 == '')
      {
         $('#multi_product_costing_type_id_math1_edit_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math1_edit_err'+res).html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype_1 == '')
      {
         $('#multi_product_costing_type_id_math_1_edit_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_1_edit_err'+res).html('');
      }
   });
   
   if(err> 0){ return false;}else{ return true; }   
}



function add_pcs_type_edit()
{
   var count=$('#mailcount_edit').val();
   var cnt = parseInt(count)-1;
   var scount = parseInt(count)+1;

   var err = 0;
   var mpctemp = $('#multi_product_costing_template_edit').val();
   if(mpctemp == '')
   {
      $('#multi_product_costing_template_edit_err').html('Template is required!');
      err++;
   }else{
      //$('#multi_product_costing_template_err').html('');
      
      if(expoe == 1)
      {
         $('#multi_product_costing_template_edit_err').html('Template already exists!');
         err++;
      }
      else
      {
         $('#multi_product_costing_template_edit_err').html('');
      }
   }

   $("div[id^='mid_edit']").each(function(){
      var id = this.id;
      var res = id.substring(8);
      var pctype = $('#multi_product_costing_type_edit'+res).val();
      if(pctype == '')
      {
         $('#multi_product_costing_type_edit_err'+res).html('Costing Type is required!');
         err++;
      }else{
         $('#multi_product_costing_type_edit_err'+res).html('');
      }
      
      var maction = $('#math_action_edit'+res).val();
      var mtype = $('#multi_product_costing_type_id_math_edit'+res).val();
      var mtype1 = $('#multi_product_costing_type_id_math1_edit'+res).val();
      var mtype_1 = $('#multi_product_costing_type_id_math_1_edit'+res).val();

      if(maction!='' && maction!='Division(/)' && mtype == '')
      {
         $('#multi_product_costing_type_id_math_edit_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_edit_err'+res).html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype1 == '')
      {
         $('#multi_product_costing_type_id_math1_edit_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math1_edit_err'+res).html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype_1 == '')
      {
         $('#multi_product_costing_type_id_math_1_edit_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_1_edit_err'+res).html('');
      }
   });
   
   if(err> 0){ return false;}else{ 

      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcostingtemplate/create_multi_product_costing_template',
         async: false,
         data: $('#update_multi_product_costing_template').serialize(),
         dataType: "html",
         success: function(response)
         {
            var cont = $("#mcontent_edit10");

            var resp = response.split('|');

            $('#multi_product_costing_template_id_edit').val(resp[1]);

            cont.append('<div id="mid_edit'+count+'"><div class="row"><div class="col-lg-3"><div class="form-group m-form__group"><label>Costing Type<span class="text-danger">*</span></label><input type="text" class="form-control m-input m-input--square" id="multi_product_costing_type_edit'+count+'" name="multi_product_costing_type[]" placeholder="Enter Costing Type"><span id="multi_product_costing_type_edit_err'+count+'" class="text-danger"></span><input type="hidden" id="stage_no_edit'+count+'" name="stage_no[]" value="'+count+'"></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px"><input type="checkbox" class="menu_checkbox" id="is_edit_edit'+count+'" name="is_edit[]" value="0" onchange="changePermissionCheckEdit(this.id,this.value,'+count+');"> Is Editable<input type="hidden" class="menu_checkbox_hidden" id="is_edit_edit'+count+'hidden" name="is_edit[]" value=0><span></span></label></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px"><input type="checkbox" class="menu_checkbox" id="is_display_edit'+count+'" name="is_display[]" value="0" onchange="changePermissionEdit(this.id,this.value,'+count+');"> Is Display<input type="hidden" class="menu_checkbox_hidden" id="is_display_edit'+count+'hidden" name="is_display[]" value=0><span></span></label></div></div><div class="col-lg-3" id="maction_edit'+count+'"><div class="form-group m-form__group"><label>Mathematic Action</label><select class="form-control custom-select" id="math_action_edit'+count+'" name="math_action[]" onchange="changemathtype_edit(this.value,'+count+');"><option value="">Select Mathematic Action</option><option value="Addition(+)">Addition ( + )</option><option value="Subtraction(-)">Subtraction ( - )</option><option value="Multiplication(*)">Multiplication ( * )</option><option value="Division(/)">Division ( / )</option><option value="Percentage(%)">Percentage ( % )</option></select><span id="math_action_edit_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-3" id="mtype_edit'+count+'"><div class="form-group m-form__group"><label>Math Type</label><select class="form-control m-bootstrap-select m_selectpicker" multiple id="multi_product_costing_type_id_math_edit'+count+'" name="multi_product_costing_type_id_math['+count+'][]" data-live-search="true">'+resp[0]+'</select><span class="text-danger" id="multi_product_costing_type_id_math_edit_err'+count+'"></span></div></div><div class="col-lg-3" id="mtype_div_edit'+count+'" style="display:none;"><div class="form-group m-form__group"><label>Math Type</label><select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math1_edit'+count+'" name="multi_product_costing_type_id_math1[]" data-live-search="true">'+resp[0]+'</select><span class="text-danger" id="multi_product_costing_type_id_math1_edit_err'+count+'"></span></div></div><div class="col-lg-3" id="mtype_1_div_edit'+count+'" style="display:none;"><div class="form-group m-form__group"><label>Math Type</label><select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math_1_edit'+count+'" name="multi_product_costing_type_id_math_1[]" data-live-search="true">'+resp[0]+'</select><span class="text-danger" id="multi_product_costing_type_id_math_1_edit_err'+count+'"></span></div></div><div class="col-lg-3" id="mtype_2_div_edit'+count+'" style="display:none;"><div class="form-group m-form__group"><label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px"><input type="checkbox" class="menu_checkbox" id="is_nop_greater_edit'+count+'" name="is_nop_greater[]" value="0" onchange="changePermissionEdit(this.id,this.value,'+count+');"> Is No of Pack > 1 (Multiply)<input type="hidden" class="menu_checkbox_hidden" id="is_nop_greater_edit'+count+'hidden" name="is_nop_greater[]" value=0><span></span></label></div></div></div><hr></div>');

            count=Number(count)+1;
            $('#mailcount_edit').val(count);
            $('.m_selectpicker').selectpicker();
         }
      });

    } 
 }

</script>      