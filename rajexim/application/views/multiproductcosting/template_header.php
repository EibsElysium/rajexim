<table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
                                          <thead>
                                             <tr>
                                                <th>Name</th>
                                                <th>Display Name</th>
                                                <th>SKU</th>
                                                <?php $i=1;foreach($multi_product_costing_type_list as $pcstage){?>
                                                <?php if($i==1){?>
                                                <input type="hidden" id="mpctfid" name="mpctfid" value="<?php echo $pcstage['multi_product_costing_type_id'];?>">
                                                <?php }if($i==count($multi_product_costing_type_list)){?>
                                                <input type="hidden" id="mpctlid" name="mpctlid" value="<?php echo $pcstage['multi_product_costing_type_id'];?>">
                                                <?php }?>
                                                   <th>
                                                      <?php echo $pcstage['multi_product_costing_type'];?>
                                                      <input type="hidden" id="is_edit_<?php echo $i;?>" value="<?php echo $pcstage['is_edit'];?>">
                                                      <input type="hidden" id="math_action_<?php echo $i;?>" value="<?php echo $pcstage['math_action'];?>">
                                                      <input type="hidden" id="multi_product_costing_type_id_math_<?php echo $i;?>" value="<?php echo $pcstage['multi_product_costing_type_id_math'];?>">
                                                      <input type="hidden" id="multi_product_costing_type_id_math_1-<?php echo $i;?>" value="<?php echo $pcstage['multi_product_costing_type_id_math_1'];?>">
                                                      <input type="hidden" id="is_nop_greater_<?php echo $i;?>" value="<?php echo $pcstage['is_nop_greater'];?>">
                                                   </th>
                                                <?php $i++;}?>
                                             </tr>
                                          </thead>
                                          <tbody id="mcontent10">
                                             <tr id="mid0">
                                                <td>
                                                <div style="width: 300px;">
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="product_id0" name="product_id[]" data-live-search="true" onchange="getProductItemInputs(this.value,0);"> 
                                                   <option value=''>Choose</option> 
                                                   <?php if(count($product_list)>0){
                                                      foreach($product_list as $pil)
                                                      {?>
                                                         <option value="<?php echo $pil['product_id'];?>"><?php echo $pil['product_name'];?></option>
                                                      <?php }
                                                   }?>
                                                   </select>
                                                   </div>
                                                   <span class="text-danger" id="product_id_err0"></span>
                                                </td>
                                                <td>
                                                   <div style="width: 200px;">
                                                      <select class="form-control m-bootstrap-select m_selectpicker" id="product_item_display_name_id0" name="product_item_display_name_id[]" data-live-search="true" onchange="getProductItemDisplayName(this.value,0);"> 
                                                      <option value=''>Choose Display Name</option>
                                                      </select>
                                                      <span id="product_item_display_name_id_err0" class="text-danger"></span>
                                                   </div>
                                                   <input type="hidden" id="product_item_id0" name="product_item_id[]">
                                                   <span class="text-danger" id="product_item_display_name_id_err0"></span>
                                                </td>
                                                <td>
                                                   <div style="width: 300px;">
                                                      <select class="form-control m-bootstrap-select m_selectpicker" id="sku_unit_id0" name="sku_unit_id[]" data-live-search="true"> 
                                                      <option value=''>Choose</option> 
                                                      <?php if(count($product_unit)>0){
                                                         foreach($product_unit as $pil)
                                                         {?>
                                                            <option value="<?php echo $pil['product_unit_id'];?>"><?php echo $pil['product_unit'];?></option>
                                                         <?php }
                                                      }?>
                                                      </select>
                                                   </div>
                                                   <span class="text-danger" id="sku_unit_id_err0"></span>
                                                </td>
                                                <?php $s=1;foreach($multi_product_costing_type_list as $pcstage){?>
                                                   <td style="text-align: center; vertical-align: middle;">
                                                      <?php if($pcstage['is_edit']==0)
                                                      {?>
                                                         <span id="val0_<?php echo $pcstage['multi_product_costing_type_id'];?>"></span>
                                                      <?php }else{
                                                         /*if($s==12)
                                                            $val=1;
                                                         else*/
                                                            $val=0;
                                                         ?>
                                                         <input type="text" class="form-control" id="inp0_<?php echo $pcstage['multi_product_costing_type_id'];?>" name="inp0_<?php echo $pcstage['multi_product_costing_type_id'];?>[]" value="<?php echo $val;?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getCalculatedValue()">
                                                      <?php }?>
                                                      <?php //echo $pcstage['multi_product_costing_type'];?>
                                                      <input type="hidden" id="is_edit_0_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['is_edit'];?>">
                                                      <input type="hidden" id="math_action_0_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['math_action'];?>">
                                                      <input type="hidden" id="multi_product_costing_type_id_math_0_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['multi_product_costing_type_id_math'];?>">
                                                      <input type="hidden" id="multi_product_costing_type_id_math_1-0_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['multi_product_costing_type_id_math_1'];?>">
                                                      <input type="hidden" id="is_nop_greater_0_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['is_nop_greater'];?>">
                                                   </td>
                                                <?php $s++;}?>
                                             </tr>
                                          </tbody>
                                          <!-- <tfoot>
                                             <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="noprbb"></b></span></td>
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="tkg"></b></span></td>
                                                <td></td>
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="mpcpkg"></b></span></td>
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="pcpkg"></b></span></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="cpftqiu"></b></span></td>
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="tifp"></b></span></td>
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="tmar"></b></span></td>
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="mpct"></b></span></td>
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="tcec"></b></span></td>
                                             </tr>
                                          </tfoot> --> 
                                       </table>

<script>
$('.m_selectpicker').selectpicker();
</script>