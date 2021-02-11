<style>
.dropdown-check-list {
  display: inline-block;
}
.dropdown-check-list .anchor {
  position: relative;
  cursor: pointer;
  display: inline-block;
  padding: 5px 50px 5px 10px;
  border: 1px solid #ccc;
}
.dropdown-check-list .anchor:after {
  position: absolute;
  content: "";
  border-left: 2px solid black;
  border-top: 2px solid black;
  padding: 5px;
  right: 10px;
  top: 20%;
  -moz-transform: rotate(-135deg);
  -ms-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  -webkit-transform: rotate(-135deg);
  transform: rotate(-135deg);
}
.dropdown-check-list .anchor:active:after {
  right: 8px;
  top: 21%;
}
.dropdown-check-list ul.items {
  padding: 2px;
  display: none;
  margin: 0;
  border: 1px solid #ccc;
  border-top: none;
}
.dropdown-check-list ul.items li {
  list-style: none;
  padding: 10px 0px 0px 10px;
}
.dropdown-check-list.visible .anchor {
  color: #0094ff;
}
.dropdown-check-list.visible .items {
  display: block;
}
.select_cost_drop{
  overflow: inherit;
}
</style>

<!-- <div class="row">
  <div class="col-lg-12">
    <b>Product Specification : </b><?php //echo $product_list->product_item_spec;?>
  </div>
</div> -->

<div class="row">
   <input type="hidden" id="cscount" value="<?php echo count($product_costing_stage);?>">
   <input type="hidden" id="pmlist" value="<?php echo count($product_mapping_list);?>">
   <?php $cspan = count($product_costing_stage)+2;?>
   <div class="col-lg-12">
      <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
         <thead>
            <tr>
               <th colspan="<?php echo $cspan;?>" style="text-align: center!important;"><?php echo $product_list->product_name;?> - <?php echo $product_list->product_item;?></th>
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
                     $sname = $pcstage['unit_value'].' '.$pcslist->stage_sku_name.' / '.$pcstage['stage_sku_name'];
                  }
                     ?>
                  <th><?php echo $sname;?></th>
               <?php }?>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  <!-- <select class="form-control" id="pctfilter" name="pctfilter">
                     <?php //foreach($product_costing_type_list as $pctlist){?>
                        <input type="checkbox" class="menu_checkbox" id="chkfilter" value="<?php //echo $pctlist['is_default']; ?>" <?php //echo $pctlist['is_default']==1?'checked':''; ?> onchange="changePermissionCheck(this.id,this.value);"><option value="<?php //echo $pctlist['product_costing_type_id'];?>"><?php //echo $pctlist['product_costing_type'];?></option>
                     <?php //}?>
                  </select> -->
                  <div id="list1" class="dropdown-check-list" tabindex="100">
                     <!-- <span class="anchor">Select</span> -->
                     <!-- <ul class="items" id="select_cost_drop">
                        <?php /*$j=0;foreach($product_costing_type_list as $pctlist){
                           $k = $pctlist['product_costing_category_id']-1;*/?>
                           <li><input type="checkbox" id="chkfilter<?php //echo $pctlist['product_costing_type_id']; ?>" value="<?php //echo $pctlist['is_default']; ?>" <?php //echo $pctlist['is_default']==1?'checked':''; ?> onchange="changePermissionCheck(<?php //echo $pctlist['product_costing_type_id']; ?>,this.value,this.id,<?php //echo $j;?>,<?php //echo $k;?>);" /><?php //echo $pctlist['product_costing_type'];?></li>
                        <?php //$j++;}?>
                     </ul> -->
                     <div class="input-group-btn">
              <button tabindex="-1" class="btn btn-default" type="button">Select</button>
              <button tabindex="-1" data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
              <span class="caret"></span>
              </button>
              <ul role="menu" class="dropdown-menu overflow_dropmenu">
                <?php $j=0;foreach($product_costing_type_list as $pctlist){
                           $k = $pctlist['product_costing_category_id']-1;?>
                <li><a href="javascript:;">
                <input type="checkbox" id="chkfilter<?php echo $pctlist['product_costing_type_id']; ?>" value="<?php echo $pctlist['is_default']; ?>" <?php echo $pctlist['is_default']==1?'checked':''; ?> onchange="changePermissionCheck(<?php echo $pctlist['product_costing_type_id']; ?>,this.value,this.id,<?php echo $j;?>,<?php echo $k;?>);" />
                <span class="lbl"> <?php echo $pctlist['product_costing_type'];?></span>
                </a></li>
                <li class="divider"></li>
                <?php $j++;}?>
                <!-- <li><a href="#">
                <input type="checkbox">
                <span class="lbl"> Monday</span>
              </a></li>
                <li><a href="#">
                <input type="checkbox"><span class="lbl">
                Tuesday</span>
                </a></li>
                <li><a href="#">
                <input type="checkbox"><span class="lbl">
                Wednesday</span>
                </a></li>
                <li><a href="#">
                <input type="checkbox"><span class="lbl">
                Thursday</span>
                </a></li>
                <li><a href="#">
                <input type="checkbox"><span class="lbl">
                Friday</span>
                </a></li>
                <li><a href="#">
                <input type="checkbox"><span class="lbl">
                Saturday</span>
                </a></li>
                <li><a href="#">
                <input type="checkbox"><span class="lbl">
                Sunday</span>
              </a></li>
                <li class="divider"></li>
                <li><a href="#">
                <input type="checkbox"><span class="lbl"> Last Weekday in month</span>
</a></li> -->
              </ul>
            </div>
                  </div> 

                  
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
               $isdefault = explode(',', $pcpm['isdefault']);
               sort($pctid);
               ?>
               <input type="hidden" id="pctypecount<?php echo $k;?>" value="<?php echo count($pct);?>">
               <?php $j=0; foreach($pct as $pctype){
                  $pcctype = $this->Productcosting_model->get_product_costing_type_by_id($pctid[$j]);
                  if($pcctype->is_input==0)
                    $inptype = 'hidden';
                  else
                    $inptype = 'text';
                  ?>
                  <tr id="partitr<?php echo $pctid[$j];?>" <?php echo $pcctype->is_default==0?"style=display:none;":'';?>>
                     <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pcctype->product_costing_type;?> <?php if($pcctype->is_percent==1){?>(%)<?php }?>
                        <input type="hidden" id="ptmaction<?php echo $k;?><?php echo $j;?>" value="<?php echo $pcctype->math_action;?>">                      
                        <input type="hidden" id="product_costing_type_id<?php echo $k;?><?php echo $j;?>" name="product_costing_type_id[]" value="<?php echo $pctid[$j];?>">
                        <input type="hidden" id="ispercent<?php echo $k;?><?php echo $j;?>" value="<?php echo $pcctype->is_percent;?>">
                        <input type="hidden" id="typecc<?php echo $k;?><?php echo $j;?>" value="<?php echo $pcctype->type_costing_category;?>">
                        <input type="hidden" id="isedit<?php echo $k;?><?php echo $j;?>" value="<?php echo $pcctype->is_edit;?>">
                     </td>
                     <td>
                        <input type="<?php echo $inptype;?>" id="input<?php echo $k;?><?php echo $j;?>" name="product_costing_input[]" onkeyup="getCalculatedValue()" onblur="isemptytext(<?php echo $k;?>,<?php echo $j;?>)" onkeypress="return isNumberKey(event,this);" value=0 class="form-control" style="height:25px;" onfocus="this.select();" size="4">
                     </td>
                     <?php for($i=0;$i<count($product_costing_stage);$i++)
                     {?>
                     <?php if($pcctype->is_edit==0){?>
                        <td><span id="valcom<?php echo $k;?><?php echo $j;?><?php echo $i;?>" class="pull-right">0</span>
                          <input type="hidden" id="val<?php echo $k;?><?php echo $j;?><?php echo $i;?>">
                        </td>
                        <?php }else{?>
                        <td>                          
                          <!-- <p class="text-right"> -->
                          <div style="width:100%">
                            <div style="float:left; width:20%;">
                               <a href="javascript:;" data-toggle="modal" id="quick_edit_<?php echo $k;?><?php echo $j;?><?php echo $i;?>" onclick="show_quick_icon(<?php echo $k;?>, <?php echo $j;?>, <?php echo $i;?>);">
                                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt" ></i>
                               </a>
                               <a style="display: none;" href="javascript:;" data-toggle="modal" id="quick_save_<?php echo $k;?><?php echo $j;?><?php echo $i;?>" 
                                  onclick="show_quick_pencil_icon(<?php echo $k;?>, <?php echo $j;?>, <?php echo $i;?>);">
                                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Cancel"><i class="fa fa-save"></i>
                               </a>
                             </div>
                            <!-- </p> -->
                            <div style="float:right; width:80%;">
                            <span id="valcom<?php echo $k;?><?php echo $j;?><?php echo $i;?>" class="pull-right">0</span>
                            <input type="hidden" id="val<?php echo $k;?><?php echo $j;?><?php echo $i;?>">
                          </div>
                          <div style="float:right; width:80%;">
                            <span id="inpval_<?php echo $k;?><?php echo $j;?><?php echo $i;?>" style="display: none;">
                              <input type="text" id="inpval<?php echo $k;?><?php echo $j;?><?php echo $i;?>" onkeypress="return isNumberKey(event,this);" value=0 class="form-control" style="height:25px;" onfocus="this.select();" size="4">
                            </span>
                          </div>
                        </div>
                        </td>
                        <?php }?>
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
                        <td><h5 class="text-black"><span id="stagetotcom<?php echo $k;?><?php echo $i;?>" class="pull-right">0</span></h5>                          
                          <input type="hidden" id="stagetot<?php echo $k;?><?php echo $i;?>">
                        </td>
                     <?php }?>
                  </tr>
            <?php $k++;}?>
         </tbody>
      </table>
   </div>
</div>


<script>
function isNumberKey(evt, obj)
{ 
    var charCode = (evt.which) ? evt.which : event.keyCode
    var value = obj.value;
    var dotcontains = value.indexOf(".") != -1;
    if (dotcontains)
        if (charCode == 46) return false;
    if (charCode == 46) return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function show_quick_icon(k, j, i)
{  
   $('#valcom'+k+j+i).hide();
   $('#inpval_'+k+j+i).show();
   $('#quick_edit_'+k+j+i).hide();
   $('#quick_save_'+k+j+i).show(); 
}
function show_quick_pencil_icon(k, j, i)
{
   getCalculatedStageValue(k,j,i);
   $('#valcom'+k+j+i).show();
   $('#inpval_'+k+j+i).hide();
   $('#quick_edit_'+k+j+i).show();
   $('#quick_save_'+k+j+i).hide();
   //getCalculatedStageValue(k,j,i);
}

function getCalculatedStageValue(k,j,i)
{
   var inpval1 = $('#inpval'+k+j+i).val();
   if(inpval1=='')
      inpval1=0;
   var inkgchange = $('#in_kg'+i).val();
   var inp = parseFloat(inpval1)/parseFloat(inkgchange);
   /*var inkg1 = $('#in_kg0').val();
   var inputval = parseFloat(inp)*parseFloat(inkg1);*/
   $('#input'+k+j).val(inp);
   getCalculatedValue();
}

/*function getCalculatedStageValue(k,j,i)
{
   var inpval1 = $('#inpval'+k+j+i).val();
   var inkgchange = $('#in_kg'+i).val();
   var inkg1 = $('#in_kg0').val();
   var inp = parseFloat(inkgchange)/parseFloat(inkg1);
   var inputval = parseFloat(inpval1)/parseFloat(inp);
   $('#input'+k+j).val(inputval);
   getCalculatedValue();
}*/

/*function getCalculatedValue(k,j)
{
   var cscount = $('#cscount').val();
   var pctcount = $('#pctypecount'+k).val();
   var ispercent = $('#ispercent'+k+j).val();
   for(var i=0;i<cscount;i++)
   {
      var kgval = $('#in_kg'+i).val();
      var ival = $('#input'+k+j).val();
      if(ival == '')
      {
         $('#input'+k+j).val(0);
         ival = 0;
      }
      if(ispercent==1)
      {
         var tval = (parseFloat($('#stagetot'+(k-1)+i).html())*parseFloat(ival))/100;
      }
      else
      {
         var tval = parseFloat(kgval)*parseFloat(ival);
      }
      $('#val'+k+j+i).html(tval.toFixed('2'));
   }

   for(var i=0;i<cscount;i++)
   {
      var tcat = 0;
      for(var s=0;s<pctcount;s++)
      {
         var typval = $('#val'+k+s+i).html();
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
            var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i).html())+parseFloat(tcat);
         if(pcmaction == 'Subtraction(-)')
            var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i).html())-parseFloat(tcat);
         if(pcmaction == 'Multiplication(*)')
            var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i).html())*parseFloat(tcat);
         if(pcmaction == 'Division(/)')
            var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i).html())/parseFloat(tcat);
         
         $('#stagetot'+k+i).html(ptcat.toFixed('2'));
      }
      else
      {
         $('#stagetot'+k+i).html(tcat.toFixed('2'));
      }

   }

}*/

function isemptytext(k,j)
{
  var ival = $('#input'+k+j).val();
  if(ival == '')
    {
       $('#input'+k+j).val(0);
    }
}

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
            var ival = $('#input'+k+j).val();
            if(ival == '')
            {
               //$('#input'+k+j).val(0);
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

            if(isedit==0)
            {
               $('#val'+k+j+i).val(tval.toFixed('2'));
               $('#valcom'+k+j+i).html(tval.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
            }
            else
            {
               $('#inpval'+k+j+i).val(tval.toFixed('2'));
               $('#val'+k+j+i).val(tval.toFixed('2'));
               $('#valcom'+k+j+i).html(tval.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
            }
         }

         for(var i=0;i<cscount;i++)
         {
            var tcat = 0;
            for(var s=0;s<pctcount;s++)
            {
               isedit = $('#isedit'+k+s).val();
               if(isedit==0)
                  var typval = $('#val'+k+s+i).val();
               else
                  var typval = $('#inpval'+k+s+i).val();

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
               
               $('#stagetotcom'+k+i).html(ptcat.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
               $('#stagetot'+k+i).val(ptcat.toFixed('2'));
            }
            else
            {
               $('#stagetotcom'+k+i).html(tcat.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
               $('#stagetot'+k+i).val(tcat.toFixed('2'));
            }

         }

      }

   }

}
</script>   

<script type="text/javascript">

        var checkList = document.getElementById('list1');
        checkList.getElementsByClassName('anchor')[0].onclick = function (evt) {
            if (checkList.classList.contains('visible'))
                checkList.classList.remove('visible');
            else
                checkList.classList.add('visible');
        }

        /*checkList.onblur = function(evt) {
            checkList.classList.remove('visible');
        }*/



function changePermissionCheck(pctid,val,id,j,k)
{
   if(val==1)
   {
      $('#'+id).val(0);
      $('#partitr'+pctid).hide();
      $('#input'+k+j).val(0);
   }
   else
   {
      $('#'+id).val(1);
      $('#partitr'+pctid).show();
      $('#input'+k+j).val(0);
   }
   getCalculatedValue();
}

    </script>                           