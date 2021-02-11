<?php if(count($product_costing_stage)==0){
   $cls = 'modal-lg';
}
else
{
   $cls = '';
}
   ?>

<div class="modal-dialog <?php //echo $cls;?> modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Product Staging - <span class="text-green"><?php echo $product_item->product_name;?> - <?php echo $product_item->product_item;?></span></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <form name="create_product_costing_stage" id="create_product_costing_stage" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>products/create_product_costing_stage" onsubmit="return product_costing_stage_validation()">
         <div class="modal-body">
            <div class="row">
               <input type="hidden" id="product_item_id" name="product_item_id" value="<?php echo $product_item->product_item_id;?>">
               <div class="col-lg-12">
                  <?php if(count($product_costing_stage)==0){?>
                     <div id="mcontent10">
                        <fieldset id="mid0">
                           <legend>
                              Stage 1
                           </legend>
                           <input type="hidden" id="stage_no0" name="stage_no[]" value="0">
                           <div class="row">
                              <div class="col-lg-2">
                                 <div class="form-group m-form__group">
                                    <!-- <label>Stage Name<span class="text-danger">*</span></label>
                                    <input type="text" name="stage_name[]" id="stage_name0" class="form-control" placeholder="Enter Stage Name">
                                    <span class="text-danger" id="stage_name_err0"></span> -->

                                    <label>SKU<span class="text-danger">*</span></label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" id="stage_name0" name="stage_name[]" data-live-search="true"> 
                                       <option value=''>Choose SKU</option> 
                                       <?php foreach($product_unit as $punit){?>
                                          <option value="<?php echo $punit['product_unit_id'];?>"><?php echo $punit['product_unit'];?></option>
                                       <?php }?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="form-group m-form__group">
                                    <label>Unit Value<span class="text-danger">*</span></label>
                                    <input type="text" name="unit_value[]" id="unit_value0" class="form-control" placeholder="Enter Unit Value" onkeypress="return isNumberKey(event,this);">
                                    <span class="text-danger" id="unit_value_err0"></span>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group m-form__group">
                                    <label>Sub Stage</label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" id="sub_stage0" name="sub_stage[]" data-live-search="true"> 
                                       <option value=''>Choose</option> 
                                    </select>
                                    <span class="text-danger" id="sub_stage_err0"></span>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group m-form__group">
                                    <label>In Unit<span class="text-danger">*</span></label>
                                    <input type="text" name="in_kg[]" id="in_kg0" class="form-control" placeholder="Enter value In Unit" onkeypress="return isNumberKey(event,this);">
                                    <span class="text-danger" id="in_kg_err0"></span>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="form-group m-form__group">
                                    <label>Unit<span class="text-danger">*</span></label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" id="product_unit_id0" name="product_unit_id[]" data-live-search="true"> 
                                       <option value=''>Choose Unit</option> 
                                       <?php $produnit = '<option value="">Select Unit</option>';?>
                                       <?php foreach($product_unit as $punit){?>
                                          <option value="<?php echo $punit['product_unit_id'];?>"><?php echo $punit['product_unit'];?></option>
                                          <?php $produnit.='<option value="'.$punit['product_unit_id'].'">'.$punit['product_unit'].'</option>';
                                        }?>
                                    </select>
                                    <span class="text-danger" id="product_unit_id_err0"></span>
                                 </div>
                              </div>
                              <!-- <div class="col-lg-3">
                                 <div class="form-group m-form__group">
                                    <label>In Price</label>
                                    <input type="text" name="in_price[]" id="in_price0" class="form-control" placeholder="Enter In Price" onkeypress="return isNumberKey(event,this);">
                                    <span class="text-danger" id="in_price_err0"></span>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="form-group m-form__group">
                                    <label>Data Status<span class="text-danger">*</span></label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" id="data_status0" name="data_status[]" data-live-search="true">
                                       <option value='0'>Dynamic</option>
                                       <option value='1'>Static</option>
                                    </select>
                                    <span class="text-danger" id="data_status_err0"></span>
                                 </div>
                              </div> -->
                              
                              
                           </div>
                        </fieldset>
                     </div>

                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <div class="pull-right">
                                 <button type="button" class="btn btn-primary" onclick="add_pcs_type(0)">
                                    <i class="fa fa-plus"></i>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" id="mailcount" name="mailcount" value="1">
                  <?php }else{?>               
                     <div id="mcontent10">
                        <?php $i=0;foreach($product_costing_stage as $psstage){?>
                           <fieldset id="mid<?php echo $i;?>">
                              <legend>
                                 Stage <?php echo $i+1;?>
                              </legend>
                              <input type="hidden" id="stage_no<?php echo $i;?>" name="stage_no[]" value="<?php echo $i;?>">
                              <div class="row">
                                 <div class="col-lg-3">
                                    <div class="form-group m-form__group">
                                       <!-- <label>Stage Name<span class="text-danger">*</span></label>
                                       <input type="text" name="stage_name[]" id="stage_name<?php //echo $i;?>" class="form-control" placeholder="Enter Stage Name" value="<?php //echo $psstage['stage_name'];?>"> -->

                                       <label>SKU<span class="text-danger">*</span></label>
                                       <select class="form-control m-bootstrap-select m_selectpicker" id="stage_name<?php echo $i;?>" name="stage_name[]" data-live-search="true"> 
                                          <option value=''>Choose SKU</option> 
                                          <?php foreach($product_unit as $punit){?>
                                             <option value="<?php echo $punit['product_unit_id'];?>" <?php echo $punit['product_unit_id'] == $psstage['stage_name']?'selected':'';?>><?php echo $punit['product_unit'];?></option>
                                          <?php }?>
                                       </select>

                                       <span class="text-danger" id="stage_name_err<?php echo $i;?>"></span>
                                    </div>
                                 </div>
                                 <p style="margin-top: 38px;"><b>=</b></p>
                                 <div class="col-lg-3">
                                    <div class="form-group m-form__group">
                                       <label>Unit Value<span class="text-danger">*</span></label>
                                       <input type="text" name="unit_value[]" id="unit_value<?php echo $i;?>" class="form-control" placeholder="Enter Unit Value" value="<?php echo $psstage['unit_value'];?>" onkeypress="return isNumberKey(event,this);" onkeyup="getSubStageValue(<?php echo $i;?>);">
                                       <span class="text-danger" id="unit_value_err<?php echo $i;?>"></span>
                                    </div>
                                 </div>
                                 <p style="margin-top: 38px;"><b>x</b></p>
                                 <div class="col-lg-3">
                                    <div class="form-group m-form__group">
                                       <label>Sub Stage<?php if($i!=0){?><span class="text-danger">*</span><?php }?></label>
                                       <select class="form-control m-bootstrap-select m_selectpicker" id="sub_stage<?php echo $i;?>" name="sub_stage[]" data-live-search="true" onchange="getSubStageValue(<?php echo $i;?>);"> 
                                          <option value=''>Choose</option> 
                                          <?php foreach($product_costing_stage as $psstage1){
                                             if($psstage1['product_costing_stage_id']<$psstage['product_costing_stage_id']){?>
                                                <option value="<?php echo $psstage1['product_costing_stage_id'];?>" <?php echo $psstage1['product_costing_stage_id'] == $psstage['sub_stage']?'selected':'';?>><?php echo $psstage1['stage_sku_name'];?></option>
                                          <?php }}?>
                                       </select>
                                       <span class="text-danger" id="sub_stage_err<?php echo $i;?>"></span>
                                    </div>
                                 </div>



                                 <?php 
                                 $prod_unit = $this->Product_model->get_product_unit_by_id($psstage['product_unit_id']);

                                 $produnit = '<option value="">Select Unit</option>';?>
                                          <?php foreach($product_unit as $punit){?>
                                          <?php $produnit.='<option value="'.$punit['product_unit_id'].'">'.$punit['product_unit'].'</option>';
                                          }?>
                                          <?php if($i==0){
                                             $intype = 'text';
                                          }else{
                                             $intype = 'hidden';
                                       }?>
                                       <div class="col-lg-3">
                                    <div class="form-group m-form__group">
                                 <input type="<?php echo $intype;?>" name="in_kg[]" id="in_kg<?php echo $i;?>" class="form-control" value="<?php echo $psstage['in_kg'];?>" onkeypress="return isNumberKey(event,this);" readonly>
                              </div>
                           </div>
                           <div class="col-lg-3">
                                    <div class="form-group m-form__group">
                                 <input type="<?php echo $intype;?>" name="product_unit[]" id="product_unit<?php echo $i;?>" class="form-control" value="<?php echo $prod_unit->product_unit;?>" readonly>
                                 <input type="hidden" name="product_unit_id[]" id="product_unit_id<?php echo $i;?>" class="form-control" value="<?php echo $psstage['product_unit_id'];?>" onkeypress="return isNumberKey(event,this);" readonly>
                              </div>
                           </div>

                                 <!-- <div class="col-lg-3">
                                    <div class="form-group m-form__group">
                                       <label>In Unit<span class="text-danger">*</span></label>
                                       <input type="text" name="in_kg[]" id="in_kg<?php echo $i;?>" class="form-control" placeholder="Enter value In Unit" value="<?php echo $psstage['in_kg'];?>" onkeypress="return isNumberKey(event,this);" readonly>
                                       <span class="text-danger" id="in_kg_err<?php //echo $i;?>"></span>
                                    </div>
                                 </div>
                                 <div class="col-lg-2">
                                    <div class="form-group m-form__group">
                                       <label>Unit<span class="text-danger">*</span></label>
                                       <select class="form-control m-bootstrap-select m_selectpicker" id="product_unit_id<?php echo $i;?>" name="product_unit_id[]" data-live-search="true"> 
                                          <option value=''>Choose Unit</option> 
                                          <?php //$produnit = '<option value="">Select Unit</option>';?>
                                          <?php //foreach($product_unit as $punit){?>
                                             <option value="<?php //echo $punit['product_unit_id'];?>" <?php //echo $punit['product_unit_id'] == $psstage['product_unit_id']?'selected':'';?>><?php //echo $punit['product_unit'];?></option>
                                          <?php //$produnit.='<option value="'.$punit['product_unit_id'].'">'.$punit['product_unit'].'</option>';
                                          //}?>
                                       </select>
                                       <span class="text-danger" id="product_unit_id_err<?php //echo $i;?>"></span>
                                    </div>
                                 </div> -->

                                 <!-- <div class="col-lg-3">
                                    <div class="form-group m-form__group">
                                       <label>In Price</label>
                                       <input type="text" name="in_price[]" id="in_price<?php //echo $i;?>" class="form-control" placeholder="Enter In Price" value="<?php //echo $psstage['in_price'];?>" onkeypress="return isNumberKey(event,this);">
                                       <span class="text-danger" id="in_price_err<?php //echo $i;?>"></span>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="form-group m-form__group">
                                       <label>Data Status<span class="text-danger">*</span></label>
                                       <select class="form-control m-bootstrap-select m_selectpicker" id="data_status<?php echo $i;?>" name="data_status[]" data-live-search="true">
                                          <option value='0' <?php //echo $psstage['data_status'] == '0'?'selected':'';?>>Dynamic</option>
                                          <option value='1' <?php //echo $psstage['data_status'] == '1'?'selected':'';?>>Static</option>
                                       </select>
                                       <span class="text-danger" id="data_status_err<?php //echo $i;?>"></span>
                                    </div>
                                 </div> -->
                                 
                                 
                              </div>
                           </fieldset>
                        <?php $i++;}?>
                     </div>

                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <div class="pull-right">
                                 <button type="button" class="btn btn-primary" onclick="add_pcs_type(<?php echo $i;?>)">
                                    <i class="fa fa-plus"></i>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" id="mailcount" name="mailcount" value="<?php echo count($product_costing_stage);?>">
                  <?php }?>

               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" name="gobutton" value="go" class="btn btn-primary">Create</button>
           
         </div>
      </form>
   </div>
</div>

<script>
$('.m_selectpicker').selectpicker();

function product_costing_stage_validation()
{
   var err = 0;
   $("fieldset[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);
      var sname = $('#stage_name'+res).val();
      var uvalue = $('#unit_value'+res).val();
      var sstage = $('#sub_stage'+res).val();
      var punit = $('#product_unit_id'+res).val();
      var inkg = $('#in_kg'+res).val();

      if(sname == '')
      {
         $('#stage_name_err'+res).html('Stage Name is required!');
         err++;
      }else{
         $('#stage_name_err'+res).html('');
      }

      if(uvalue == '')
      {
         $('#unit_value_err'+res).html('Unit Value is required!');
         err++;
      }else{
         $('#unit_value_err'+res).html('');
      }

      if(sstage == '' && res!=0)
      {
         $('#sub_stage_err'+res).html('Sub Stage is required!');
         err++;
      }else{
         $('#sub_stage_err'+res).html('');
      }

      if(punit == '')
      {
         $('#product_unit_id_err'+res).html('Product Unit is required!');
         err++;
      }else{
         $('#product_unit_id_err'+res).html('');
      }

      if(inkg == '' || inkg==0)
      {
         $('#in_kg_err'+res).html('Product Unit value is required!');
         err++;
      }else{
         $('#in_kg_err'+res).html('');
      }

   });
   
   if(err> 0){ return false;}else{ return true;}
}

function add_pcs_type()
{
   var count=$('#mailcount').val();
   var cnt = parseInt(count)-1;
   var scount = parseInt(count)+1;

   var err = 0;
   $("fieldset[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);
      var sname = $('#stage_name'+res).val();
      var uvalue = $('#unit_value'+res).val();
      var sstage = $('#sub_stage'+res).val();
      var punit = $('#product_unit_id'+res).val();
      var inkg = $('#in_kg'+res).val();

      if(sname == '')
      {
         $('#stage_name_err'+res).html('Stage Name is required!');
         err++;
      }else{
         $('#stage_name_err'+res).html('');
      }

      if(uvalue == '')
      {
         $('#unit_value_err'+res).html('Unit Value is required!');
         err++;
      }else{
         $('#unit_value_err'+res).html('');
      }

      if(sstage == '' && res!=0)
      {
         $('#sub_stage_err'+res).html('Sub Stage is required!');
         err++;
      }else{
         $('#sub_stage_err'+res).html('');
      }

      if(punit == '')
      {
         $('#product_unit_id_err'+res).html('Product Unit is required!');
         err++;
      }else{
         $('#product_unit_id_err'+res).html('');
      }

      if(inkg == '')
      {
         $('#in_kg_err'+res).html('Product Unit value is required!');
         err++;
      }else{
         $('#in_kg_err'+res).html('');
      }

   });
   
   if(err> 0){ return false;}else{ 

      $.ajax({
         type: "POST",
         url: baseurl+'products/create_product_costing_stage',
         async: false,
         data: $('#create_product_costing_stage').serialize(),
         dataType: "html",
         success: function(response)
         {
            var cont = $("#mcontent10");
            var punit = '<?php echo $produnit;?>';
            //var response = 1;

            cont.append('<fieldset id="mid'+count+'"><legend>Stage '+scount+'</legend><input type="hidden" id="stage_no'+count+'" name="stage_no[]" value="'+count+'"><div class="row"><div class="col-lg-3"><div class="form-group m-form__group"><label>SKU<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="stage_name'+count+'" name="stage_name[]" data-live-search="true">'+punit+'</select><span class="text-danger" id="stage_name_err'+count+'"></span></div></div><p style="margin-top: 38px;"><b>=</b></p><div class="col-lg-3"><div class="form-group m-form__group"><label>Unit Value<span class="text-danger">*</span></label><input type="text" name="unit_value[]" id="unit_value'+count+'" class="form-control" placeholder="Enter Unit Value" onkeypress="return isNumberKey(event,this);" onkeyup="getSubStageValue('+count+');"><span class="text-danger" id="unit_value_err'+count+'"></span></div></div><p style="margin-top: 38px;"><b>x</b></p><div class="col-lg-3"><div class="form-group m-form__group"><label>Sub Stage<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="sub_stage'+count+'" name="sub_stage[]" data-live-search="true" onchange="getSubStageValue('+count+')">'+response+'</select><span class="text-danger" id="sub_stage_err'+count+'"></span></div></div><input type="hidden" name="in_kg[]" id="in_kg'+count+'" class="form-control" value="" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" name="product_unit_id[]" id="product_unit_id'+count+'" class="form-control" value="" onkeypress="return isNumberKey(event,this);" readonly></div></fieldset>');

            /*cont.append('<fieldset id="mid'+count+'"><legend>Stage '+scount+'</legend><input type="hidden" id="stage_no'+count+'" name="stage_no[]" value="'+count+'"><div class="row"><div class="col-lg-2"><div class="form-group m-form__group"><label>SKU<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="stage_name0" name="stage_name[]" data-live-search="true">'+punit+'</select><span class="text-danger" id="stage_name_err'+count+'"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group"><label>Unit Value<span class="text-danger">*</span></label><input type="text" name="unit_value[]" id="unit_value'+count+'" class="form-control" placeholder="Enter Unit Value" onkeypress="return isNumberKey(event,this);" onkeyup="getSubStageValue('+count+');"><span class="text-danger" id="unit_value_err'+count+'"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Sub Stage<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="sub_stage'+count+'" name="sub_stage[]" data-live-search="true" onchange="getSubStageValue('+count+')">'+response+'</select><span class="text-danger" id="sub_stage_err'+count+'"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>In Unit<span class="text-danger">*</span></label><input type="text" name="in_kg[]" id="in_kg'+count+'" class="form-control" placeholder="Enter value In Unit" onkeypress="return isNumberKey(event,this);" readonly><span class="text-danger" id="in_kg_err'+count+'"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group"><label>Unit<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="product_unit_id'+count+'" name="product_unit_id[]" data-live-search="true">'+punit+'</select><span class="text-danger" id="product_unit_id_err'+count+'"></span></div></div></div></fieldset>');*/
            //<div class="col-lg-3"><div class="form-group m-form__group"><label>In Price</label><input type="text" name="in_price[]" id="in_price'+count+'" class="form-control" placeholder="Enter In Price" onkeypress="return isNumberKey(event,this);"><span class="text-danger" id="in_price_err'+count+'"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Data Status<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="data_status'+count+'" name="data_status[]" data-live-search="true"><option value="0">Dynamic</option><option value="1">Static</option></select><span class="text-danger" id="data_status_err'+count+'"></span></div></div>

            count=Number(count)+1;
            $('#mailcount').val(count);
            $('.m_selectpicker').selectpicker();
         }
      });

    } 

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



   /*var cont = $("#mcontent10");
   var punit = '<?php echo $produnit;?>';
   var response = 1;
   
   cont.append('<fieldset id="mid'+count+'"><legend></legend><input type="hidden" id="stage_no'+count+'" name="stage_no[]" value="'+count+'"><div class="row"><div class="col-lg-4"><div class="form-group m-form__group"><label>Stage Name<span class="text-danger">*</span></label><input type="text" name="stage_name[]" id="stage_name'+count+'" class="form-control" placeholder="Enter Stage Name"><span class="text-danger" id="stage_name_err'+count+'"></span></div></div><div class="col-lg-4"><div class="form-group m-form__group"><label>Unit Value<span class="text-danger">*</span></label><input type="text" name="unit_value[]" id="unit_value'+count+'" class="form-control" placeholder="Enter Unit Value"><span class="text-danger" id="unit_value_err'+count+'"></span></div></div><div class="col-lg-4"><div class="form-group m-form__group"><label>Sub Stage<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="sub_stage'+count+'" name="sub_stage[]" data-live-search="true">'+response+'</select><span class="text-danger" id="sub_stage_err'+count+'"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>In KG</label><input type="text" name="in_kg[]" id="in_kg'+count+'" class="form-control" placeholder="Enter In KG"><span class="text-danger" id="in_kg_err'+count+'"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>In Price</label><input type="text" name="in_price[]" id="in_price'+count+'" class="form-control" placeholder="Enter In Price"><span class="text-danger" id="in_price_err'+count+'"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Unit<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="product_unit_id'+count+'" name="product_unit_id[]" data-live-search="true">'+punit+'</select><span class="text-danger" id="product_unit_id_err'+count+'"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Data Status<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="data_status'+count+'" name="data_status[]" data-live-search="true"><option value="0">Dynamic</option><option value="1">Static</option></select><span class="text-danger" id="data_status_err'+count+'"></span></div></div></div></fieldset>');

   count=Number(count)+1;
   $('#mailcount').val(count);
   $('.m_selectpicker').selectpicker();*/

}

function getSubStageValue(i)
{
   var uval = $('#unit_value'+i).val();
   var sstage = $('#sub_stage'+i).val();
   if(sstage!='')
   {
      $.ajax({
         type: "POST",
         url: baseurl+'products/getSubStageValue',
         async: false,
         data: "ssval="+sstage,
         dataType: "html",
         success: function(response)
         {
            var respsplit = response.split('||');
            if(uval=='')
            {
               $('#in_kg'+i).val(0);
               $('#product_unit_id'+i).val('');
               $('.m_selectpicker').selectpicker('refresh');
            }
            else
            {
               var kgval = parseFloat(uval)*respsplit[0];
               $('#in_kg'+i).val(kgval);
               $('#product_unit_id'+i).val(respsplit[1]);
               $('.m_selectpicker').selectpicker('refresh');
            }
         }
        });
   }
   else
   {
      $('#in_kg'+i).val(0);
   }
}
</script>      