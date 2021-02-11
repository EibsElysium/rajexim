<?php $this->load->view('common_header'); ?>

<style>


.table-wrapper {
    overflow-x: scroll;
    width: 600px;
    margin: 0 auto;
}
</style>

            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>multiproductcosting" class="m-nav__link">
                                 <span class="m-nav__link-text">Multi Product Costing - G</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Edit Multi Product Costing - G</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
                  
                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                      Edit Multi Product Costing - G
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>multiproductcosting" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <form  name="productcosting_form" id="productcosting_form" method="POST" action="<?php echo base_url(); ?>multiproductcosting/multi_product_costing_update" onsubmit="return multi_product_costing_validation();" >
                              <input type="hidden" id="multi_product_costing_id" name="multi_product_costing_id" value="<?php echo $multi_product_costing_list->multi_product_costing_id;?>">
                              <input type="hidden" id="pc_no" name="pc_no" value="<?php echo $multi_product_costing_list->multi_product_costing_no;?>">
                              <input type="hidden" id="parent_costing_id" name="parent_costing_id" value="<?php echo $multi_product_costing_list->parent_costing_id;?>">
                              <input type="hidden" id="revised" name="revised" value="<?php echo $multi_product_costing_list->revised;?>">
                              <div class="m-portlet__body">
                                 <!--begin: Datatable -->

                                 <div class="row">
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Lead<span class="text-danger">*</span></label>
                                          <!-- <select class="form-control m-bootstrap-select m_selectpicker" id="lead_id" name="lead_id" data-live-search="true">
                                             <option value="">Select Lead</option>
                                             <?php //foreach($lead_list as $plist){?>
                                                <option value="<?php //echo $plist['lead_id'];?>"><?php //echo $plist['lead_name'];?> - <?php //echo $plist['email_id'];?></option>
                                             <?php //}?>
                                          </select> -->
                                          <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $multi_product_costing_list->lead_id;?>">
                                          <input type="text" class="form-control" id="lead_name" name="lead_name" value="<?php echo $multi_product_costing_list->lead_name.' - '.$multi_product_costing_list->email_id;?>" readonly>
                                          <span id="lead_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Template<span class="text-danger">*</span></label>

                                          <input type="hidden" id="multi_product_costing_template_id" name="multi_product_costing_template_id" value="<?php echo $multi_product_costing_list->multi_product_costing_template_id;?>">
                                          <input type="text" class="form-control" id="multi_product_costing_template" name="multi_product_costing_template" value="<?php echo $multi_product_costing_list->multi_product_costing_template;?>" readonly>
                                          <span id="multi_product_costing_template_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Container<span class="text-danger">*</span></label>
                                          <input type="hidden" id="container_id" name="container_id" value="<?php echo $multi_product_costing_list->container_id;?>">
                                          <input type="text" class="form-control" id="container_name" name="container_name" value="<?php echo $multi_product_costing_list->container_name;?>" readonly>

                                          <input type="hidden" id="min_cbm" value="<?php echo $multi_product_costing_list->min_cbm;?>">
                                          <input type="hidden" id="max_cbm" value="<?php echo $multi_product_costing_list->max_cbm;?>">
                                          <input type="hidden" id="max_ton" value="<?php echo $multi_product_costing_list->max_ton;?>">
                                          <input type="hidden" id="ton_variance" value="<?php echo $multi_product_costing_list->ton_variance;?>">

                                          <span id="container_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Margin %<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="margin_in_percent" name="margin_in_percent" onkeypress="return isNumberKey(event,this);" value="<?php echo $multi_product_costing_list->margin_in_percent;?>" onkeyup="calculatedValue()">
                                          <span id="margin_in_percent_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>CHA Expense<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="cha_expense" name="cha_expense" onkeypress="return isNumberKey(event,this);" value="<?php echo $multi_product_costing_list->cha_expense;?>" onkeyup="calculatedValue()" onfocus="this.select();">
                                          <span id="cha_expense_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Based On<span class="text-danger">*</span></label>
                                             <div class="m-radio-inline">
                                             <label class="m-radio m-radio--bold m-radio--success">
                                             <input type="radio" name="cha_based_on" <?php echo ($multi_product_costing_list->cha_based_on == 0) ? 'checked' : ''; ?> id="cha_based_on_0" value="0" onchange="calculatedValue()">Weight
                                             <span></span>
                                             </label>
                                             <label class="m-radio m-radio--bold m-radio--success">
                                             <input type="radio" name="cha_based_on" <?php echo ($multi_product_costing_list->cha_based_on == 1) ? 'checked' : ''; ?> id="cha_based_on_1" value="1" onchange="calculatedValue()">Cost
                                             <span></span>
                                             </label>
                                             <!-- <label class="m-radio m-radio--bold m-radio--success">
                                             <input type="radio" name="cha_based_on" <?php //echo ($multi_product_costing_list->cha_based_on == 2) ? 'checked' : ''; ?> id="cha_based_on_2" value="2">CBM
                                             <span></span>
                                             </label> -->
                                          </div>
                                          <span class="text-danger"></span>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row">
                                                      <?php $i=1;foreach($multi_product_costing_type_list as $pcstage){
                                                         $val=$pcstage['multi_product_costing_type_id'];
                                                       }?>                                                      
                                                      <input type="hidden" id="mpctcount<?php echo $k;?>" value="<?php echo $val;?>">
                                    <div class="col-lg-12 table-wrapper">
                                       <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
                                          <thead>
                                             <tr>
                                                <th>Name</th>
                                                <th>Display Name</th>
                                                <th>SKU</th>
                                                <?php $i=1;foreach($multi_product_costing_type_list as $pcstage){?>
                                                   <th>
                                                      <?php echo $pcstage['multi_product_costing_type'];?>
                                                      <input type="hidden" id="is_edit_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['is_edit'];?>">
                                                      <input type="hidden" id="math_action_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['math_action'];?>">
                                                      <input type="hidden" id="multi_product_costing_type_id_math_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['multi_product_costing_type_id_math'];?>">
                                                      <input type="hidden" id="multi_product_costing_type_id_math_1-<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['multi_product_costing_type_id_math_1'];?>">
                                                      <input type="hidden" id="is_nop_greater_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['is_nop_greater'];?>">
                                                   </th>
                                                <?php $i++;}?>
                                             </tr>
                                          </thead>
                                          <?php $pclistgroup = $this->Multiproductcosting_model->get_multi_product_costing_product_group_by_id($multi_product_costing_list->multi_product_costing_id);
                                                               $pgcount = count($pclistgroup);
                                                            ?>
                                          <tbody id="mcontent10">
                                             <?php $i=0; foreach($pclistgroup as $pclg)
                                             {

                                                $displayname = $this->Productcosting_model->get_product_item_display_name_by_id($pclg['product_id']);
                                                ?>
                                             <tr id="mid<?php echo $i;?>">
                                                <td>
                                                <div style="width: 300px;">
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="product_id<?php echo $i;?>" name="product_id[]" data-live-search="true" onchange="getProductItemInputs(this.value,<?php echo $i;?>);"> 
                                                   <option value=''>Choose</option> 
                                                   <?php if(count($product_list)>0){
                                                      foreach($product_list as $pil)
                                                      {?>
                                                         <option value="<?php echo $pil['product_id'];?>" <?php echo $pclg['product_id'] == $pil['product_id']?'selected':'';?>><?php echo $pil['product_name'];?></option>
                                                      <?php }
                                                   }?>
                                                   </select>
                                                   </div>
                                                   <span class="text-danger" id="product_id_err<?php echo $i;?>"></span>
                                                </td>
                                                <td>
                                                   <div style="width: 200px;">
                                                      <select class="form-control m-bootstrap-select m_selectpicker" id="product_item_display_name_id<?php echo $i;?>" name="product_item_display_name_id[]" data-live-search="true" onchange="getProductItemDisplayName(this.value,<?php echo $i;?>);"> 
                                                      <option value=''>Choose Display Name</option>
                                                      <?php foreach ($displayname as $dname) {?>
                                                         <option value='<?php echo $dname["product_item_display_name_id"];?>' <?php echo $dname['product_item_display_name_id'] == $pclg['product_item_display_name_id']?'selected':'';?>><?php echo $dname["display_name"];?></option>;
                                                      <?php }
                                                      ?>
                                                      </select>
                                                      <input type="hidden" id="product_item_id<?php echo $i;?>" name="product_item_id[]" value="<?php echo $pclg['product_item_id'];?>">
                                                      <span id="product_item_display_name_id_err<?php echo $i;?>" class="text-danger"></span>
                                                   </div>
                                                </td>
                                                <td>
                                                   <div style="width: 300px;">
                                                      <select class="form-control m-bootstrap-select m_selectpicker" id="sku_unit_id<?php echo $i;?>" name="sku_unit_id[]" data-live-search="true"> 
                                                      <option value=''>Choose</option> 
                                                      <?php if(count($product_unit)>0){
                                                         foreach($product_unit as $pil)
                                                         {?>
                                                            <option value="<?php echo $pil['product_unit_id'];?>" <?php echo $pclg['sku_unit_id'] == $pil['product_unit_id']?'selected':'';?>><?php echo $pil['product_unit'];?></option>
                                                         <?php }
                                                      }?>
                                                      </select>
                                                   </div>
                                                   <span class="text-danger" id="sku_unit_id_err<?php echo $i;?>"></span>
                                                </td>
                                                <?php $s=1;foreach($multi_product_costing_type_list as $pcstage){

                                                      $mpcpbypid = $this->Multiproductcosting_model->get_multi_product_costing_product_by_item_type_id($pclg['product_count_no'],$pcstage['multi_product_costing_type_id'],$multi_product_costing_list->multi_product_costing_id);
                                                      if(count($mpcpbypid)>0)
                                                      {
                                                         $val = $mpcpbypid->multi_product_costing_input;
                                                      }
                                                      else{
                                                         $val = '0';
                                                      }
                                                   ?>
                                                   <td style="text-align: center; vertical-align: middle;">
                                                      <?php if($pcstage['is_edit']==0)
                                                      {?>
                                                         <span id="val<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>"><?php echo $val;?></span>
                                                      <?php }else{?>
                                                         <input type="text" class="form-control" id="inp<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" name="inp<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>[]" value="<?php echo $val;?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="calculatedValue()">
                                                      <?php }?>
                                                      <?php //echo $pcstage['multi_product_costing_type'];?>
                                                      <input type="hidden" id="is_edit_<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['is_edit'];?>">
                                                      <input type="hidden" id="math_action_<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['math_action'];?>">
                                                      <input type="hidden" id="multi_product_costing_type_id_math_<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['multi_product_costing_type_id_math'];?>">
                                                      <input type="hidden" id="multi_product_costing_type_id_math_1-<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['multi_product_costing_type_id_math_1'];?>">
                                                      <input type="hidden" id="is_nop_greater_<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>" value="<?php echo $pcstage['is_nop_greater'];?>">
                                                   </td>
                                                <?php $s++;}?>
                                             </tr>
                                             <?php $i++;}?>
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
                                    </div>
                                 </div>
                                 <br>
                                 <div id="totkg_err" class="text-danger"></div>
                                 <br>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group m-form__group">
                                          <div class="pull-right">
                                             <button type="button" class="btn btn-primary" onclick="addProductLine()">
                                                <i class="fa fa-plus"></i>
                                             </button>
                                          </div>
                                       </div>
                                    </div> 
                                 </div>
                                 <input type="hidden" id="mailcount" name="mailcount" value="<?php echo $pgcount;?>">
                                 
                              </div>
                              <div class="m-portlet__foot">
                                 <div class="row align-items-center">
                                    <div class="col-lg-12 m--align-right">
                                       <input type="submit"  class="btn btn-primary" name="submit" id="btnsubmit" value="Save" onclick="changedraftvalue(this.value);">
                                       <input type="submit"  class="btn btn-primary" name="draft" id="btndraft" value="Draft" onclick="changedraftvalue(this.value);">
                                    </div>
                                 </div>
                              </div>
                              <input type="hidden" id="is_draft" name="is_draft" value="<?php echo $multi_product_costing_list->is_draft;?>">
                              <input type="hidden" id="old_is_draft" name="old_is_draft" value="<?php echo $multi_product_costing_list->is_draft;?>">
                           </form>
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->
               </div>
            </div>
         </div>

         <!-- end:: Body -->

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Multi Product Costing Edit';
$(document).attr("title", title); 

$('.table-wrapper').on('show.bs.dropdown', function () {
     $('.table-wrapper').css( "overflow", "inherit" );
});

$('.table-wrapper').on('hide.bs.dropdown', function () {
     $('.table-wrapper').css( "overflow", "auto" );
})



$( document ).ready(function() {
    getCalculatedValue();
});

function addProductLine()
{
   var count=$('#mailcount').val();
   var cont = $("#mcontent10");
   var tempid = $('#multi_product_costing_template_id').val();
   var contplus = parseFloat(count)+1;
   $.ajax({
      type: "POST",
      url: baseurl+'multiproductcosting/addProductLine',
      async: false,
      data: "count="+count+"&tempid="+tempid,
      dataType: "html",
      success: function(response)
      {
         cont.append(response);
         $('#mailcount').val(contplus);
      }
   });
}

/*function getCalculatedValue()
{
   var mip = $('#margin_in_percent').val();
   var noprbb=0;tkg=0;mpcpkg=0;cpftqiu=tifp=tmar=mpct=tcec=0
   if(mip!='')
   {
      var linecount=$('#mailcount').val();
      var mpctcount=$('#mpctcount').val();
      for(var lc=0;lc<linecount;lc++)
      {
         for(var mpctc=1;mpctc<=mpctcount;mpctc++)
         {
            var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
            if(isedit!=1)
            {
               var mathaction = $('#math_action_'+lc+'_'+mpctc).val();
               if(mathaction=='')
               {
                  var ival = $('#inp'+lc+'_'+(mpctc-1)).val();
                  if(ival>1 || ival==0)
                  {
                     $('#val'+lc+'_'+mpctc).html(ival);
                  }
                  else
                  {
                     inpval = 1/ival;
                     $('#val'+lc+'_'+mpctc).html(inpval.toFixed('2'));
                  }
               }
               else if(mathaction=='Addition(+)')
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                  var splmpctim = mpctim.split(',');
                  var cntsplmpctim = splmpctim.length;
                  var mval = 0;
                  for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                  {
                     var reqval = splmpctim[cntspl];
                     var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                     if(isedit1!=1)
                     {
                        mval = parseFloat(mval) + parseFloat($('#val'+lc+'_'+reqval).html());
                     }
                     else
                     {
                        mval = parseFloat(mval) + parseFloat($('#inp'+lc+'_'+reqval).val());
                     }
                  }
                  $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
               }
               else if(mathaction=='Subtraction(-)')
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                  var splmpctim = mpctim.split(',');
                  var cntsplmpctim = splmpctim.length;
                  var mval = 0;
                  for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                  {
                     var reqval = splmpctim[cntspl];
                     var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                     if(isedit1!=1)
                     {
                        mval = parseFloat(mval) - parseFloat($('#val'+lc+'_'+reqval).html());
                     }
                     else
                     {
                        mval = parseFloat(mval) - parseFloat($('#inp'+lc+'_'+reqval).val());
                     }
                  }
                  $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
               }
               else if(mathaction=='Multiplication(*)')
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                  var splmpctim = mpctim.split(',');
                  var cntsplmpctim = splmpctim.length;
                  var mval = 1;
                  for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                  {
                     var reqval = splmpctim[cntspl];
                     var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                     if(isedit1!=1)
                     {
                        mval = parseFloat(mval) * parseFloat($('#val'+lc+'_'+reqval).html());
                     }
                     else
                     {
                        mval = parseFloat(mval) * parseFloat($('#inp'+lc+'_'+reqval).val());
                     }
                  }
                  $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
               }
               else if(mathaction=='Percentage(%)')
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                  var isedit1 = $('#is_edit_'+lc+'_'+mpctim).val();
                  if(isedit1!=1)
                  {
                     var pval = parseFloat($('#val'+lc+'_'+mpctim).html());
                  }
                  else
                  {
                     var pval = parseFloat($('#inp'+lc+'_'+mpctim).val());
                  }
                  var mval = (parseFloat(pval)*parseFloat(mip))/100;
                  $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
               }
               else
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                  var mpctim1 = $('#multi_product_costing_type_id_math_1-'+lc+'_'+mpctc).val();
                  var nopg = $('#is_nop_greater_'+lc+'_'+mpctc).val();

                  var isedit1 = $('#is_edit_'+lc+'_'+mpctim).val();
                  if(isedit1!=1)
                  {
                     var mval1 = parseFloat($('#val'+lc+'_'+mpctim).html());
                  }
                  else
                  {
                     var mval1 = parseFloat($('#inp'+lc+'_'+mpctim).val());
                  }

                  var isedit2 = $('#is_edit_'+lc+'_'+mpctim1).val();
                  if(isedit2!=1)
                  {
                     var mval2 = parseFloat($('#val'+lc+'_'+mpctim1).html());
                  }
                  else
                  {
                     var mval2 = parseFloat($('#inp'+lc+'_'+mpctim1).val());
                  }

                  
                  if(ival>1 && nopg==1)
                     var mval = parseFloat(mval1) * parseFloat(mval2);
                  else
                     var mval = parseFloat(mval1) / parseFloat(mval2);

                  $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
               }
            }
            if(mpctc==3)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
               if(isedit!=1)
               {
                  noprbb = parseFloat(noprbb) + parseFloat($('#val'+lc+'_'+mpctc).html());
               }
               else
               {
                  noprbb = parseFloat(noprbb) + parseFloat($('#inp'+lc+'_'+mpctc).val());
               }
               $('#noprbb').html(noprbb.toFixed('2'));
            }
            if(mpctc==4)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
               if(isedit!=1)
               {
                  tkg = parseFloat(tkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
               }
               else
               {
                  tkg = parseFloat(tkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
               }
               $('#tkg').html(tkg.toFixed('2'));
            }
            if(mpctc==6)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
               if(isedit!=1)
               {
                  mpcpkg = parseFloat(mpcpkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
               }
               else
               {
                  mpcpkg = parseFloat(mpcpkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
               }
               $('#mpcpkg').html(mpcpkg.toFixed('2'));
            }
            if(mpctc==14)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
               if(isedit!=1)
               {
                  cpftqiu = parseFloat(cpftqiu) + parseFloat($('#val'+lc+'_'+mpctc).html());
               }
               else
               {
                  cpftqiu = parseFloat(cpftqiu) + parseFloat($('#inp'+lc+'_'+mpctc).val());
               }
               $('#cpftqiu').html(cpftqiu.toFixed('2'));
            }
            if(mpctc==15)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
               if(isedit!=1)
               {
                  tifp = parseFloat(tifp) + parseFloat($('#val'+lc+'_'+mpctc).html());
               }
               else
               {
                  tifp = parseFloat(tifp) + parseFloat($('#inp'+lc+'_'+mpctc).val());
               }
               $('#tifp').html(tifp.toFixed('2'));
            }
            if(mpctc==16)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
               if(isedit!=1)
               {
                  tmar = parseFloat(tmar) + parseFloat($('#val'+lc+'_'+mpctc).html());
               }
               else
               {
                  tmar = parseFloat(tmar) + parseFloat($('#inp'+lc+'_'+mpctc).val());
               }
               $('#tmar').html(tmar.toFixed('2'));
            }
            if(mpctc==17)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
               if(isedit!=1)
               {
                  mpct = parseFloat(mpct) + parseFloat($('#val'+lc+'_'+mpctc).html());
               }
               else
               {
                  mpct = parseFloat(mpct) + parseFloat($('#inp'+lc+'_'+mpctc).val());
               }
               $('#mpct').html(mpct.toFixed('2'));
            }
            if(mpctc==18)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
               if(isedit!=1)
               {
                  tcec = parseFloat(tcec) + parseFloat($('#val'+lc+'_'+mpctc).html());
               }
               else
               {
                  tcec = parseFloat(tcec) + parseFloat($('#inp'+lc+'_'+mpctc).val());
               }
               $('#tcec').html(tcec.toFixed('2'));
            }
         }
      }
      var tkgval = $('#tkg').html();
      if((tkgval/1000)<=20)
      {
         $('#tkg').html('<font color="green">'+tkgval+'</font>');
      }
      else if(((tkgval/1000)>20) && ((tkgval/1000)<=28))
      {
         $('#tkg').html('<font color="orange">'+tkgval+'</font>');
      }
      else
      {
         $('#tkg').html('<font color="red">'+tkgval+'</font>');
      }
   }

}*/



function getCalculatedValue()
{
   var mip = $('#margin_in_percent').val();
   var cid = $('#container_id').val();
   var cha = $('#cha_expense').val();
   var noprbb=0;tkg=0;mpcpkg=0;cpftqiu=tifp=tmar=mpct=tcec=pcpkg=0;
   if(cid!='')
   {
      var mton = $('#max_ton').val();
      var tvari = $('#ton_variance').val();
      var tdiff = parseFloat(mton) - parseFloat(tvari);
      var radioValue = $("input[name='cha_based_on']:checked").val();
      
      if(mip!='')
      {
         if(cha!='' && cha>0)
         {
            

            /*if(radioValue==0)
            {
               var totkg = $($('#tkg').html()).text();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            if(radioValue==1)
            {
               var totkg = $('#pcpkg').html();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            var linecount=$('#mailcount').val();
            for(var lc=0;lc<linecount;lc++)
            {
               $('#inp'+lc+'_9').val(spcha.toFixed('2'));
            }*/


            var linecount=$('#mailcount').val();
            var mpctcount=$('#mpctcount').val();
            for(var lc=0;lc<linecount;lc++)
            {
               for(var mpctc=1;mpctc<=mpctcount;mpctc++)
               {
                  var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                  if(isedit!=1)
                  {
                     var mathaction = $('#math_action_'+lc+'_'+mpctc).val();
                     if(mathaction=='')
                     {
                        var ival = $('#inp'+lc+'_'+(mpctc-1)).val();
                        if(ival>1 || ival==0)
                        {
                           $('#val'+lc+'_'+mpctc).html(ival);
                        }
                        else
                        {
                           inpval = 1/ival;
                           $('#val'+lc+'_'+mpctc).html(inpval.toFixed('2'));
                        }
                     }
                     else if(mathaction=='Addition(+)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var splmpctim = mpctim.split(',');
                        var cntsplmpctim = splmpctim.length;
                        var mval = 0;
                        for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                        {
                           var reqval = splmpctim[cntspl];
                           var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                           if(isedit1!=1)
                           {
                              mval = parseFloat(mval) + parseFloat($('#val'+lc+'_'+reqval).html());
                           }
                           else
                           {
                              mval = parseFloat(mval) + parseFloat($('#inp'+lc+'_'+reqval).val());
                           }
                        }
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else if(mathaction=='Subtraction(-)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var splmpctim = mpctim.split(',');
                        var cntsplmpctim = splmpctim.length;
                        var mval = 0;
                        for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                        {
                           var reqval = splmpctim[cntspl];
                           var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                           if(isedit1!=1)
                           {
                              mval = parseFloat(mval) - parseFloat($('#val'+lc+'_'+reqval).html());
                           }
                           else
                           {
                              mval = parseFloat(mval) - parseFloat($('#inp'+lc+'_'+reqval).val());
                           }
                        }
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else if(mathaction=='Multiplication(*)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var splmpctim = mpctim.split(',');
                        var cntsplmpctim = splmpctim.length;
                        var mval = 1;
                        for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                        {
                           var reqval = splmpctim[cntspl];
                           var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                           if(isedit1!=1)
                           {
                              mval = parseFloat(mval) * parseFloat($('#val'+lc+'_'+reqval).html());
                           }
                           else
                           {
                              mval = parseFloat(mval) * parseFloat($('#inp'+lc+'_'+reqval).val());
                           }
                        }
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else if(mathaction=='Percentage(%)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var isedit1 = $('#is_edit_'+lc+'_'+mpctim).val();
                        if(isedit1!=1)
                        {
                           var pval = parseFloat($('#val'+lc+'_'+mpctim).html());
                        }
                        else
                        {
                           var pval = parseFloat($('#inp'+lc+'_'+mpctim).val());
                        }
                        var mval = (parseFloat(pval)*parseFloat(mip))/100;
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var mpctim1 = $('#multi_product_costing_type_id_math_1-'+lc+'_'+mpctc).val();
                        var nopg = $('#is_nop_greater_'+lc+'_'+mpctc).val();

                        var isedit1 = $('#is_edit_'+lc+'_'+mpctim).val();
                        if(isedit1!=1)
                        {
                           var mval1 = parseFloat($('#val'+lc+'_'+mpctim).html());
                        }
                        else
                        {
                           var mval1 = parseFloat($('#inp'+lc+'_'+mpctim).val());
                        }

                        var isedit2 = $('#is_edit_'+lc+'_'+mpctim1).val();
                        if(isedit2!=1)
                        {
                           var mval2 = parseFloat($('#val'+lc+'_'+mpctim1).html());
                        }
                        else
                        {
                           var mval2 = parseFloat($('#inp'+lc+'_'+mpctim1).val());
                        }

                        /*if(nopg==0)
                           var mval = parseFloat(mval1) / parseFloat(mval2);
                        else
                           var mval = parseFloat(mval1) * parseFloat(mval2);*/
                        if(ival>1 && nopg==1)
                           var mval = parseFloat(mval1) * parseFloat(mval2);
                        else
                           var mval = parseFloat(mval1) / parseFloat(mval2);

                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                  }
                  if(mpctc==3)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        noprbb = parseFloat(noprbb) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        noprbb = parseFloat(noprbb) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#noprbb').html(noprbb.toFixed('2'));
                  }
                  if(mpctc==4)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tkg = parseFloat(tkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tkg = parseFloat(tkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tkg').html(tkg.toFixed('2'));
                  }
                  if(mpctc==6)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        mpcpkg = parseFloat(mpcpkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        mpcpkg = parseFloat(mpcpkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#mpcpkg').html(mpcpkg.toFixed('2'));
                  }
                  if(mpctc==7)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        pcpkg = parseFloat(pcpkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        pcpkg = parseFloat(pcpkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#pcpkg').html(pcpkg.toFixed('2'));
                  }
                  if(mpctc==14)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        cpftqiu = parseFloat(cpftqiu) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        cpftqiu = parseFloat(cpftqiu) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#cpftqiu').html(cpftqiu.toFixed('2'));
                  }
                  if(mpctc==15)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tifp = parseFloat(tifp) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tifp = parseFloat(tifp) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tifp').html(tifp.toFixed('2'));
                  }
                  if(mpctc==16)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tmar = parseFloat(tmar) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tmar = parseFloat(tmar) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tmar').html(tmar.toFixed('2'));
                  }
                  if(mpctc==17)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        mpct = parseFloat(mpct) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        mpct = parseFloat(mpct) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#mpct').html(mpct.toFixed('2'));
                  }
                  if(mpctc==18)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tcec = parseFloat(tcec) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tcec = parseFloat(tcec) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tcec').html(tcec.toFixed('2'));
                  }
               }
            }
            var tkgval = $('#tkg').html();
            if((tkgval/1000)<=parseFloat(tdiff))
            {
               $('#tkg').html('<font color="green">'+tkgval+'</font>');
            }
            else if(((tkgval/1000)>parseFloat(tdiff)) && ((tkgval/1000)<=parseFloat(mton)))
            {
               $('#tkg').html('<font color="orange">'+tkgval+'</font>');
            }
            else
            {
               $('#tkg').html('<font color="red">'+tkgval+'</font>');
            }

            if(radioValue==0)
            {
               var totkg = $($('#tkg').html()).text();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            if(radioValue==1)
            {
               var totkg = $('#tifp').html();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            var linecount=$('#mailcount').val();
            for(var lc=0;lc<linecount;lc++)
            {
               //$('#inp'+lc+'_9').val(spcha.toFixed('2'));

               if(radioValue==1)
               {
                  var pppk = $('#inp'+lc+'_5').val();
                  var spcha1 = parseFloat(spcha)*parseFloat(pppk);
               }
               else
                  var spcha1 = spcha;
               
               $('#inp'+lc+'_9').val(spcha1.toFixed('2'));
            }
         }
         else
         {
            alert("CHA is required!");
         }
      }
      else
      {
         alert("Margin is required!");
      }
   }
   else
   {
      alert("Choose Container");
   }

}

function calculatedValue()
{
   var mip = $('#margin_in_percent').val();
   var cid = $('#container_id').val();
   var cha = $('#cha_expense').val();
   var noprbb=0;tkg=0;mpcpkg=0;cpftqiu=tifp=tmar=mpct=tcec=pcpkg=0;
   if(cid!='')
   {
      var mton = $('#max_ton').val();
      var tvari = $('#ton_variance').val();
      var tdiff = parseFloat(mton) - parseFloat(tvari);
      var radioValue = $("input[name='cha_based_on']:checked").val();
      
      if(mip!='')
      {
         if(cha!='' && cha>0)
         {
            

            if(radioValue==0)
            {
               var totkg = $($('#tkg').html()).text();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            if(radioValue==1)
            {
               var totkg = $('#tifp').html();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            var linecount=$('#mailcount').val();
            for(var lc=0;lc<linecount;lc++)
            {
               //$('#inp'+lc+'_9').val(spcha.toFixed('2'));

               if(radioValue==1)
               {
                  var pppk = $('#inp'+lc+'_5').val();
                  var spcha1 = parseFloat(spcha)*parseFloat(pppk);
               }
               else
                  var spcha1 = spcha;
               $('#inp'+lc+'_9').val(spcha1.toFixed('2'));
            }

            
            var linecount=$('#mailcount').val();
            var mpctcount=$('#mpctcount').val();
            for(var lc=0;lc<linecount;lc++)
            {
               for(var mpctc=1;mpctc<=mpctcount;mpctc++)
               {
                  var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                  if(isedit!=1)
                  {
                     var mathaction = $('#math_action_'+lc+'_'+mpctc).val();
                     if(mathaction=='')
                     {
                        var ival = $('#inp'+lc+'_'+(mpctc-1)).val();
                        if(ival>1 || ival==0)
                        {
                           $('#val'+lc+'_'+mpctc).html(ival);
                        }
                        else
                        {
                           inpval = 1/ival;
                           $('#val'+lc+'_'+mpctc).html(inpval.toFixed('2'));
                        }
                     }
                     else if(mathaction=='Addition(+)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var splmpctim = mpctim.split(',');
                        var cntsplmpctim = splmpctim.length;
                        var mval = 0;
                        for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                        {
                           var reqval = splmpctim[cntspl];
                           var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                           if(isedit1!=1)
                           {
                              mval = parseFloat(mval) + parseFloat($('#val'+lc+'_'+reqval).html());
                           }
                           else
                           {
                              mval = parseFloat(mval) + parseFloat($('#inp'+lc+'_'+reqval).val());
                           }
                        }
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else if(mathaction=='Subtraction(-)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var splmpctim = mpctim.split(',');
                        var cntsplmpctim = splmpctim.length;
                        var mval = 0;
                        for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                        {
                           var reqval = splmpctim[cntspl];
                           var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                           if(isedit1!=1)
                           {
                              mval = parseFloat(mval) - parseFloat($('#val'+lc+'_'+reqval).html());
                           }
                           else
                           {
                              mval = parseFloat(mval) - parseFloat($('#inp'+lc+'_'+reqval).val());
                           }
                        }
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else if(mathaction=='Multiplication(*)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var splmpctim = mpctim.split(',');
                        var cntsplmpctim = splmpctim.length;
                        var mval = 1;
                        for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                        {
                           var reqval = splmpctim[cntspl];
                           var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                           if(isedit1!=1)
                           {
                              mval = parseFloat(mval) * parseFloat($('#val'+lc+'_'+reqval).html());
                           }
                           else
                           {
                              mval = parseFloat(mval) * parseFloat($('#inp'+lc+'_'+reqval).val());
                           }
                        }
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else if(mathaction=='Percentage(%)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var isedit1 = $('#is_edit_'+lc+'_'+mpctim).val();
                        if(isedit1!=1)
                        {
                           var pval = parseFloat($('#val'+lc+'_'+mpctim).html());
                        }
                        else
                        {
                           var pval = parseFloat($('#inp'+lc+'_'+mpctim).val());
                        }
                        var mval = (parseFloat(pval)*parseFloat(mip))/100;
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var mpctim1 = $('#multi_product_costing_type_id_math_1-'+lc+'_'+mpctc).val();
                        var nopg = $('#is_nop_greater_'+lc+'_'+mpctc).val();

                        var isedit1 = $('#is_edit_'+lc+'_'+mpctim).val();
                        if(isedit1!=1)
                        {
                           var mval1 = parseFloat($('#val'+lc+'_'+mpctim).html());
                        }
                        else
                        {
                           var mval1 = parseFloat($('#inp'+lc+'_'+mpctim).val());
                        }

                        var isedit2 = $('#is_edit_'+lc+'_'+mpctim1).val();
                        if(isedit2!=1)
                        {
                           var mval2 = parseFloat($('#val'+lc+'_'+mpctim1).html());
                        }
                        else
                        {
                           var mval2 = parseFloat($('#inp'+lc+'_'+mpctim1).val());
                        }

                        /*if(nopg==0)
                           var mval = parseFloat(mval1) / parseFloat(mval2);
                        else
                           var mval = parseFloat(mval1) * parseFloat(mval2);*/
                        if(ival>1 && nopg==1)
                           var mval = parseFloat(mval1) * parseFloat(mval2);
                        else
                           var mval = parseFloat(mval1) / parseFloat(mval2);

                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                  }
                  if(mpctc==3)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        noprbb = parseFloat(noprbb) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        noprbb = parseFloat(noprbb) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#noprbb').html(noprbb.toFixed('2'));
                  }
                  if(mpctc==4)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tkg = parseFloat(tkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tkg = parseFloat(tkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tkg').html(tkg.toFixed('2'));
                  }
                  if(mpctc==6)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        mpcpkg = parseFloat(mpcpkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        mpcpkg = parseFloat(mpcpkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#mpcpkg').html(mpcpkg.toFixed('2'));
                  }
                  if(mpctc==7)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        pcpkg = parseFloat(pcpkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        pcpkg = parseFloat(pcpkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#pcpkg').html(pcpkg.toFixed('2'));
                  }
                  if(mpctc==14)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        cpftqiu = parseFloat(cpftqiu) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        cpftqiu = parseFloat(cpftqiu) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#cpftqiu').html(cpftqiu.toFixed('2'));
                  }
                  if(mpctc==15)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tifp = parseFloat(tifp) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tifp = parseFloat(tifp) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tifp').html(tifp.toFixed('2'));
                  }
                  if(mpctc==16)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tmar = parseFloat(tmar) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tmar = parseFloat(tmar) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tmar').html(tmar.toFixed('2'));
                  }
                  if(mpctc==17)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        mpct = parseFloat(mpct) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        mpct = parseFloat(mpct) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#mpct').html(mpct.toFixed('2'));
                  }
                  if(mpctc==18)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tcec = parseFloat(tcec) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tcec = parseFloat(tcec) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tcec').html(tcec.toFixed('2'));
                  }
               }
            }
            var tkgval = $('#tkg').html();
            if((tkgval/1000)<=parseFloat(tdiff))
            {
               $('#tkg').html('<font color="green">'+tkgval+'</font>');
            }
            else if(((tkgval/1000)>parseFloat(tdiff)) && ((tkgval/1000)<=parseFloat(mton)))
            {
               $('#tkg').html('<font color="orange">'+tkgval+'</font>');
            }
            else
            {
               $('#tkg').html('<font color="red">'+tkgval+'</font>');
            }

            if(radioValue==0)
            {
               var totkg = $($('#tkg').html()).text();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            if(radioValue==1)
            {
               var totkg = $('#tifp').html();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            var linecount=$('#mailcount').val();
            for(var lc=0;lc<linecount;lc++)
            {
               //$('#inp'+lc+'_9').val(spcha.toFixed('2'));

               if(radioValue==1)
               {
                  var pppk = $('#inp'+lc+'_5').val();
                  var spcha1 = parseFloat(spcha)*parseFloat(pppk);
               }
               else
                  var spcha1 = spcha;
               $('#inp'+lc+'_9').val(spcha1.toFixed('2'));
            }
         }
         else
         {
            alert("CHA is required!");
         }
      }
      else
      {
         alert("Margin is required!");
      }
   }
   else
   {
      alert("Choose Container");
   }

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

function changedraftvalue(val)
{
   if(val=='Draft')
   {
      $('#is_draft').val(1);
   }
   else
   {
      $('#is_draft').val(0);
   }
}

function multi_product_costing_validation()
{
   var err=0;
   var lid = $('#lead_id').val();
   var mip = $('#margin_in_percent').val();
   var tkgval = $($('#tkg').html()).text();
   
   if((tkgval/1000)>28)
   {
      $('#totkg_err').html('Exceed Container Weight!');
      err++;
   }
   else
   {
      $('#totkg_err').html('');
   }
   if(lid=='')
   {
      $('#lead_id_err').html('Choose Lead!');
      err++;
   }
   else
   {
      $('#lead_id_err').html('');
   }

   if(mip=='')
   {
      $('#margin_in_percent_err').html('Margin % is required!');
      err++;
   }
   else
   {
      $('#margin_in_percent_err').html('');
   }

   var bav=0
   $("tr[id^='mid']").each(function(){
     var id = this.id;
     var res = id.substring(3);
     var pid=$('#product_id'+res).val();
     var pidnid=$('#product_item_display_name_id'+res).val();
     var sku=$('#sku_unit_id'+res).val();

     if(bav==0)  
     {     
        if(pid==''){
          $('#product_id_err'+res).html('Choose Product!');
          err++;
        }else{
          $('#product_id_err'+res).html('');
        }

        if(pidnid==''){
          $('#product_item_display_name_id_err'+res).html('Display Name is required!');
          err++;
        }else{
          $('#product_item_display_name_id_err'+res).html('');
        }

        if(sku==''){
          $('#sku_unit_id_err'+res).html('SKU is required!');
          err++;
        }else{
          $('#sku_unit_id_err'+res).html('');
        }
      }
      else
      {     

        if(pid!='' && pidnid==''){
          $('#product_item_display_name_id_err'+res).html('Display Name is required!');
          err++;
        }else{
          $('#product_item_display_name_id_err'+res).html('');
        }        

        if(pid!='' && sku==''){
          $('#sku_unit_id_err'+res).html('SKU is required!');
          err++;
        }else{
          $('#sku_unit_id_err'+res).html('');
        }
        
      }
      bav++;
   });
   if(err>0){ return false; }else{ return true; }
}

function getProductItemInputs(val,i)
{
   if(val!='')
   {
      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcosting/getProductItemInputs',
         async: false,
         type: "POST",
         data: "piid="+val,
         dataType: "html",
         success: function(response)
         {
            $('#product_item_display_name_id'+i).empty().append(response);
            $('#product_item_display_name_id'+i).selectpicker('refresh');
         }
      });

   }
}

function getProductItemDisplayName(val,i)
{
   if(val!='')
   {
      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcosting/getProductItemDisplayName',
         async: false,
         type: "POST",
         data: "pidnid="+val,
         dataType: "html",
         success: function(response)
         {
            $('#product_item_id'+i).val(response);
         }
      });

   }
   else
   {
      $('#product_item_id'+i).val('');
   }
}



</script>
</body>
   <!-- end::Body -->
</html>