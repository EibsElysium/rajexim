<tr id="mid<?php echo $count;?>">
   <td>
   <div style="width: 300px;">
      <select class="form-control m-bootstrap-select m_selectpicker" id="product_id<?php echo $count;?>" name="product_id[]" data-live-search="true" onchange="getProductItemInputs(this.value,<?php echo $count;?>);"> 
      <option value=''>Choose</option> 
      <?php if(count($product_list)>0){
         foreach($product_list as $pil)
         {?>
            <option value="<?php echo $pil['product_id'];?>"><?php echo $pil['product_name'];?></option>
         <?php }
      }?>
      </select>
      </div>
      <span class="text-danger" id="product_id_err<?php echo $count;?>"></span>
   </td>
   
   <td>
      <div style="width: 200px;">
         <select class="form-control m-bootstrap-select m_selectpicker" id="product_item_display_name_id<?php echo $count;?>" name="product_item_display_name_id[]" data-live-search="true" onchange="getProductItemDisplayName(this.value,<?php echo $count;?>);"> 
         <option value=''>Choose Display Name</option>
         </select>
         <span id="product_item_display_name_id_err<?php echo $count;?>" class="text-danger"></span>
      </div>
      <input type="hidden" id="product_item_id<?php echo $count;?>" name="product_item_id[]">
      <span class="text-danger" id="product_item_display_name_id_err<?php echo $count;?>"></span>
   </td>
   <td>
   <div style="width: 300px;">
      <select class="form-control m-bootstrap-select m_selectpicker" id="sku_unit_id<?php echo $count;?>" name="sku_unit_id[]" data-live-search="true"> 
      <option value=''>Choose</option> 
      <?php if(count($product_unit)>0){
         foreach($product_unit as $pil)
         {?>
            <option value="<?php echo $pil['product_unit_id'];?>"><?php echo $pil['product_unit'];?></option>
         <?php }
      }?>
      </select>
      </div>
      <span class="text-danger" id="sku_unit_id_err<?php echo $count;?>"></span>
   </td>
   <?php $s=1;foreach($multi_product_costing_type_list as $pcstage){?>
      <td style="text-align: center; vertical-align: middle;">
         <?php if($pcstage['is_edit']==0)
         {?>
            <span id="val<?php echo $count;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>"></span>
         <?php }else{
            /*if($s==12)
               $val=1;
            else*/
               $val=0;?>
            <input type="text" class="form-control" id="inp<?php echo $count;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" name="inp<?php echo $count;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>[]" value="<?php echo $val;?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getCalculatedValue()">
         <?php }?>
         <?php //echo $pcstage['multi_product_costing_type'];?>
         <input type="hidden" id="is_edit_<?php echo $count;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['is_edit'];?>">
         <input type="hidden" id="math_action_<?php echo $count;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['math_action'];?>">
         <input type="hidden" id="multi_product_costing_type_id_math_<?php echo $count;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['multi_product_costing_type_id_math'];?>">
         <input type="hidden" id="multi_product_costing_type_id_math_1-<?php echo $count;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['multi_product_costing_type_id_math_1'];?>">
         <input type="hidden" id="is_nop_greater_<?php echo $count;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['is_nop_greater'];?>">
      </td>
   <?php $s++;}?>
</tr>

<script>
$('.m_selectpicker').selectpicker();
</script>