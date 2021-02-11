<div class="m-accordion m-accordion--bordered" id="m_accordion_2" role="tablist">
                              <div class="m-accordion__item">
                                 <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_2_item_1_head" data-toggle="collapse" href="#m_accordion_2_item_1_body" aria-expanded="false">
                                    <span class="m-accordion__item-title">Product Costing</span>
                                    <span class="m-accordion__item-mode"></span>
                                 </div>
                                 <div class="m-accordion__item-body collapse" id="m_accordion_2_item_1_body" role="tabpanel" aria-labelledby="m_accordion_2_item_1_head" data-parent="#m_accordion_2" style="">
                                    <div class="m-accordion__item-content">
                                       <div class="container">

<div class="row">
	<div class="col-lg-12">
		<?php //foreach($product_costing_list as $pcost){
			$product_mapping_list = $this->Productcosting_model->get_product_costing_mapping();
			$product_item_id_list = $this->Productcosting_model->get_product_item_by_id($product_costing_list->product_item_id);
			$product_costing_stage = $this->Productcosting_model->get_product_costing_stage_by_piid($product_costing_list->product_item_id);?>
			<div class="col-lg-12">


                                                   <div class="row">
                                       <input type="hidden" id="cscount" value="<?php echo count($product_costing_stage);?>">
                                       <input type="hidden" id="pmlist" value="<?php echo count($product_mapping_list);?>">
                                       <?php $cspan = count($product_costing_stage)+2;?>
                                       <div class="col-lg-12">
                                          <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
                                             <thead>
                                                <tr>
                                                   <th colspan="<?php echo $cspan;?>" style="text-align: center!important;"><?php echo $product_costing_list->product_name;?> - <?php echo $product_costing_list->product_item;?></th>
                                                </tr>
                                                <tr>
                                                   <th>Particulars</th>
                                                   <th>Inputs</th>
                                                   <?php foreach($product_costing_stage as $pcstage){
                                                      if($pcstage['sub_stage']==0){
                                                         $sname = $pcstage['unit_value'].' '.$pcstage['stage_sku_name'];
                                                      }
                                                      else
                                                      {
                                                         $pcs = $this->Productcosting_model->get_product_costing_stage_by_id($pcstage['sub_stage']);
                                                         $pcslist = $this->Productcosting_model->get_product_costing_stage_by_id($pcs->product_costing_stage_id);
                                                         $sname = $pcstage['unit_value'].' '.$pcs->stage_sku_name.' / '.$pcstage['stage_sku_name'];
                                                      }
                                                         ?>
                                                      <th><?php echo $sname;?></th>
                                                   <?php }?>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                   <td>

                                                   </td>
                                                   <td>
                                                      
                                                   </td>
                                                   <?php $i=0; foreach($product_costing_stage as $pcstage)
                                                   {?>
                                                   <td>
                                                     <h5 class="text-black" align="center"><?php echo $pcstage['in_kg'];?></h5>
                                                     <input type="hidden" id="in_kg<?php echo $i;?>" value="<?php echo $pcstage['in_kg'];?>">
                                                   </td>
                                                   <?php $i++;}?>
                                                </tr>
                                                <?php $k=0; foreach($product_mapping_list as $pcpm){
                                                   $pct = explode(',', $pcpm['pctype']);
                                                   $pctid = explode(',', $pcpm['product_costing_type_id']);
                                                   $maction = explode(',', $pcpm['maction']);
                                                   $ispercent = explode(',', $pcpm['ispercent']);
                                                   $typecc = explode(',', $pcpm['typecostingcategory']);
                                                   $isedit = explode(',', $pcpm['isedit']);
                                                   sort($pctid);
                                                   ?>
                                                   <input type="hidden" id="pctypecount<?php echo $k;?>" value="<?php echo count($pct);?>">
                                                   <?php $j=0; foreach($pct as $pctype){
                                                      $pcctype = $this->Productcosting_model->get_product_costing_type_by_id($pctid[$j]);
                                                      $pcinputs = $this->Productcosting_model->get_product_costing_input_by_pctype_pcid($pctid[$j],$product_costing_list->product_costing_id);
                                                      /*if(count($pcinputs)>0)
                                                      {
                                                         $inval = $pcinputs->product_costing_input;
                                                      }
                                                      else
                                                      {
                                                         $inval = 0;
                                                      }*/
                                                      $inval = $pcinputs->product_costing_input;
                                                      ?>
                                                      <tr id="partitr<?php echo $pctid[$j];?>" <?php echo $inval==0?"style=display:none;":'';?>>
                                                         <td>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pcctype->product_costing_type;?> <?php if($pcctype->is_percent==1){?>(%)<?php }?>
                                                            <input type="hidden" id="ptmaction<?php echo $k;?><?php echo $j;?>" value="<?php echo $pcctype->math_action;?>">
                                                            <input type="hidden" id="product_costing_type_id<?php echo $k;?><?php echo $j;?>" name="product_costing_type_id[]" value="<?php echo $pctid[$j];?>">
                                                            <input type="hidden" id="ispercent<?php echo $k;?><?php echo $j;?>" value="<?php echo $pcctype->is_percent;?>">
                                                            <input type="hidden" id="typecc<?php echo $k;?><?php echo $j;?>" value="<?php echo $pcctype->type_costing_category;?>">
                                                            <input type="hidden" id="isedit<?php echo $k;?><?php echo $j;?>" value="<?php echo $pcctype->is_edit;?>">
                                                         </td>
                                                         <td>
                                                            <!-- <input type="text" id="input<?php //echo $k;?><?php// echo $j;?><?php //echo $s;?>" name="product_costing_input[]" onkeyup="getCalculatedValue(<?php //echo $s;?>)" onkeypress="return isNumberKey(event,this);" value=<?php //echo $inval;?> class="form-control" style="height:25px;" onfocus="this.select();"> -->
                                                            <span id="inputformat<?php echo $k;?><?php echo $j;?>" class="pull-right"><?php echo number_format($inval,2);?></span>
                                                            <span style="display:none;" id="input<?php echo $k;?><?php echo $j;?>" class="pull-right"><?php echo $inval;?></span>
                                                         </td>
                                                         <?php for($i=0;$i<count($product_costing_stage);$i++)
                                                         {?>
                                                            <!-- <td><span id="val<?php //echo $k;?><?php //echo $j;?><?php //echo $i;?>" class="pull-right">0</span></td> -->
                                                            <?php //if($isedit[$j]==0){?>
                                                               <td><span id="val<?php echo $k;?><?php echo $j;?><?php echo $i;?>" class="pull-right">0</span></td>
                                                            <?php //}else{?>
                                                               <!-- <td><input type="text" id="inpval<?php //echo $k;?><?php //echo $j;?><?php //echo $i;?>" onkeyup="getCalculatedStageValue(<?php //echo $k;?>,<?php //echo $j;?>,<?php //echo $i;?>)" onkeypress="return isNumberKey(event,this);" value=0 class="form-control" style="height:25px;" onfocus="this.select();"></td> -->
                                                            <?php //}?>
                                                         <?php }?>
                                                      </tr>
                                                   <?php $j++;}?>
                                                      <tr>
                                                         <td>
                                                         <h5 class="text-black"><?php echo $pcpm['product_costing_category_name'];?></h5>
                                                            <input type="hidden" id="pprodccat<?php echo $k;?>" value="<?php echo $pcpm['parent_product_costing_category_id'];?>">
                                                            <input type="hidden" id="pcmaction<?php echo $k;?>" value="<?php echo $pcpm['math_action'];?>">
                                                         </td>
                                                         <td>
                                                            <h5 class="text-black"></h5>
                                                         </td>
                                                         
                                                         <?php for($i=0;$i<count($product_costing_stage);$i++)
                                                         {?>
                                                            <!-- <td><h5 class="text-black"><span id="stagetot<?php //echo $k;?><?php //echo $i;?><?php //echo $s;?>" class="pull-right">0</span></h5></td> -->
                                                            <td><h5 class="text-black"><span id="stagetotcom<?php echo $k;?><?php echo $i;?>" class="pull-right">0</span></h5>
                                                                <input type="hidden" id="stagetot<?php echo $k;?><?php echo $i;?>">
                                                         <?php }?>
                                                      </tr>
                                                <?php $k++;}?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>


                                                   </div>
                                                   <?php //}?>
	</div>
</div>

</div>
</div>
</div>
</div>
</div>

<script>
getCalculatedValue();

function getCalculatedValue()
{
   var pmlist = $('#pmlist').val();
   var cscount = $('#cscount').val();
   for(var k=0;k<pmlist;k++)
   {
      var pctcount = $('#pctypecount'+k).val();
      for(var j=0;j<pctcount;j++)
      {
         var ispercent = $('#ispercent'+k+j).val();
         var isedit = $('#isedit'+k+j).val();
         for(var i=0;i<cscount;i++)
         {
            var kgval = $('#in_kg'+i).val();
            var ival = $('#input'+k+j).html();
            if(ival == '')
            {
               $('#input'+k+j).html(0);
               ival = 0;
            }
            if(ispercent==1)
            {
               var tval = (parseFloat($('#stagetot'+(k-1)+i).val())*parseFloat(ival))/100;
            }
            else if(ispercent==2)
            {
               if(ival!=0)
                  var tval = (parseFloat($('#stagetot'+(k-1)+i).val())/parseFloat(ival));
               else
                  var tval = parseFloat(0);
            }
            else
            {
               var tval = parseFloat(kgval)*parseFloat(ival);
            }
            $('#val'+k+j+i).html(tval.toFixed('2'));
            /*if(isedit==0)
               $('#val'+k+j+i).html(tval.toFixed('2'));
            else
            {
               $('#inpval'+k+j+i).val(tval);
            }*/
         }

         for(var i=0;i<cscount;i++)
         {
            var tcat = 0;
            for(var s=0;s<pctcount;s++)
            {
               var typval = $('#val'+k+s+i).html();

               /*isedit = $('#isedit'+k+s).val();
               if(isedit==0)
                  var typval = $('#val'+k+s+i).html();
               else
                  var typval = $('#inpval'+k+s+i).val();*/

               if(typval=='' || typval==null)
                  typval = 0;
               var maction = $('#ptmaction'+k+j).val();
               if(maction == 'Addition(+)')
                  tcat = parseFloat(tcat)+parseFloat(typval);
               if(maction == 'Subtraction(-)')
                  tcat = parseFloat(tcat)-parseFloat(typval);
               if(maction == 'Multiplication(*)')
                  tcat = parseFloat(tcat)*parseFloat(typval);
               if(maction == 'Division(/)')
                  tcat = parseFloat(tcat)/parseFloat(typval);
            }

            var pprodccat = $('#pprodccat'+k).val();
            var pcmaction = $('#pcmaction'+k).val();
            if(pprodccat !=0)
            {
               if(pcmaction == 'Addition(+)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i).val())+parseFloat(tcat);
               if(pcmaction == 'Subtraction(-)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i).val())-parseFloat(tcat);
               if(pcmaction == 'Multiplication(*)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i).val())*parseFloat(tcat);
               if(pcmaction == 'Division(/)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i).val())/parseFloat(tcat);
               
               $('#stagetotcom'+k+i).html(ptcat.toLocaleString("en"));
               $('#stagetot'+k+i).val(ptcat.toFixed('2'));
            }
            else
            {
               $('#stagetotcom'+k+i).html(tcat.toLocaleString("en"));
               $('#stagetot'+k+i).val(tcat.toFixed('2'));
            }

         }

      }

   }

}
</script>