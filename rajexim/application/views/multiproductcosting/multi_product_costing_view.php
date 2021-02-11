<?php $this->load->view('common_header'); $date_format =common_date_format();?>

<style>


.table-wrapper {
    overflow-x: scroll;
    width: 600px;
    margin: 0 auto;
}

.tabcolor{
   background-color: #e6ffe6;
}
</style>

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="#" class="m-nav__link m-nav__link--icon">
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
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">View Multi Product Costing - G</span>
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
                                       View Multi Product Costing - G
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
                           <div class="m-portlet__body">
                              <div class="row">
                                 <div class="col-lg-12">

                                    <ul class="nav nav-pills nav-pills--theme" role="tablist">
                                       <?php $isapp=0;foreach($multi_product_costing_list as $qlist){
                                          if($qlist['is_approve']==1)
                                             $isapp=1;?>
                                       <li class="nav-item <?php echo $qlist['is_approve']==1?'tabcolor':'';?>">
                                          <a class="nav-link <?php echo $qlist['multi_product_costing_id'] == $multi_product_costing_id?'active':'';?>"  data-toggle="tab" href="#q_<?php echo $qlist['multi_product_costing_id'];?>"><?php echo $qlist['multi_product_costing_no'];?></a>
                                       </li>
                                       <?php }?>
                                    </ul>
                                    <div class="tab-content">
                                       <input type="hidden" id="mpcostcount" value="<?php echo count($multi_product_costing_list);?>">
                                       <?php $k=0;foreach($multi_product_costing_list as $pcost){ 
                                          ?>
                                          <div class="tab-pane <?php echo $pcost['multi_product_costing_id'] == $multi_product_costing_id?' active':'';?>" id="q_<?php echo $pcost['multi_product_costing_id'];?>" role="tabpanel">
                                             <?php 
                                             if($pcost['is_approve']==1)
                                             {
                                                $appuser = $this->Productcosting_model->get_user_by_id($pcost['approved_by']);?>
                                                <div class="pull-left">
                                                   <b>Approved by &nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $appuser->name;?><br>
                                                   <b>Approved Date :</b> <?php echo $pcost['approved_date'];?>
                                                </div>

                                             <?php }?>

                                                <div class="pull-right">
                                                <?php if($_SESSION['Multi Product CostingEdit']==1 && $pcost['is_approve']==0 && $isapp==0){ ?>
                                                <a href="<?php echo base_url(); ?>multiproductcosting/multi_product_costing_edit/<?php echo $pcost['multi_product_costing_id'];?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>

                                                <?php if($_SESSION['Multi Product CostingDelete']==1 && $pcost['is_approve']==0 && $isapp==0){ ?>
                                                <a href="javascript:;" onclick="return multi_product_costing_delete(<?php echo $pcost['multi_product_costing_id']; ?>)" data-toggle="m-tooltip" data-placement="top" title="Delete"><span class="tooltip-animation"><i class="fa fa-trash-alt"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>

                                                <?php if($_SESSION['Multi Product CostingApprove']==1 && $pcost['is_approve']==0 && $isapp==0){ ?>
                                                <a href="javascript:;" onclick="return multi_product_costing_approve(<?php echo $pcost['multi_product_costing_id']; ?>)" data-toggle="m-tooltip" data-placement="top" title="Approve"><span class="tooltip-animation"><i class="fa fa-check-circle"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>

                                                <?php if($_SESSION['Multi Product CostingMove To Quote']==1 && $pcost['is_approve']==1){ ?>
                                                <?php if($pcost['lead_status']==3){?>
                                                <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" onclick="return multi_product_costing_move_to_quote(<?php echo $pcost['multi_product_costing_id']; ?>,<?php echo $k;?>)">
                                                   <span>
                                                      <i class="fa fa-arrow-circle-right"></i>
                                                      <span>Move to Quote</span>
                                                   </span>
                                                </a><br><br>
                                                <?php }else{?>
                                                <p><font color="red">Move this lead to Opportunity</font></p>
                                                <?php }?>
                                                <?php }?>
                                             </div>



                                          <div class="col-lg-12">
                                                   <!-- <p class="top_head">
                                                      &nbsp;&nbsp;<?php //echo $pcost['lead_name'].' - '.$pcost['email_id'];?>
                                                      <span class="pull-right">Margin % : <?php //echo $pcost['margin_in_percent'];?></span>
                                                      <input type="hidden" id="margin_in_percent<?php //echo $k;?>" value="<?php //echo $pcost['margin_in_percent'];?>">
                                                   </p> -->

                                                   <div class="row">
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Lead<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="lead_name<?php echo $k;?>" name="lead_name" value="<?php echo $pcost['lead_name'].' - '.$pcost['email_id'];?>" readonly>
                                          <span id="lead_id_err" class="text-danger"></span>
                                       </div>
                                    </div>

                                    <input type="hidden" id="cif_price<?php echo $k;?>" name="cif_price">
                                    
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Template<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="multi_product_costing_template<?php echo $k;?>" name="multi_product_costing_template" value="<?php echo $pcost['multi_product_costing_template'];?>" readonly>

                                          <span id="multi_product_costing_template_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Container<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="container_name<?php echo $k;?>" name="container_name" value="<?php echo $pcost['container_name'];?>" readonly>

                                          <input type="hidden" id="min_cbm<?php echo $k;?>" value="<?php echo $pcost['min_cbm'];?>">
                                          <input type="hidden" id="max_cbm<?php echo $k;?>" value="<?php echo $pcost['max_cbm'];?>">
                                          <input type="hidden" id="max_ton<?php echo $k;?>" value="<?php echo $pcost['max_ton'];?>">
                                          <input type="hidden" id="ton_variance<?php echo $k;?>" value="<?php echo $pcost['ton_variance'];?>">

                                          <span id="container_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Margin %<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="margin_in_percent<?php echo $k;?>" name="margin_in_percent" value="<?php echo $pcost['margin_in_percent'];?>" readonly>
                                          <span id="margin_in_percent_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>CHA Expense<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="cha_expense<?php echo $k;?>" name="cha_expense" value="<?php echo $pcost['cha_expense'];?>" readonly>
                                          <span id="cha_expense_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <?php if($pcost['cha_based_on']==0)
                                             $cbon = 'Weight';
                                          else if($pcost['cha_based_on']==1)
                                             $cbon = 'Cost';
                                          else
                                             $cbon = 'CBM';
                                          ?>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Based On<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="cha_based_on<?php echo $k;?>" name="cha_based_on" value="<?php echo $cbon;?>" readonly>
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
                                                                        <input type="hidden" id="is_edit_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['is_edit'];?>">
                                                                        <input type="hidden" id="math_action_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['math_action'];?>">
                                                                        <input type="hidden" id="multi_product_costing_type_id_math_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['multi_product_costing_type_id_math'];?>">
                                                                        <input type="hidden" id="multi_product_costing_type_id_math_1-<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['multi_product_costing_type_id_math_1'];?>">
                                                                        <input type="hidden" id="is_nop_greater_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['is_nop_greater'];?>">
                                                                     </th>
                                                                  <?php $i++;}?>
                                                               </tr>
                                                            </thead>
                                                            <?php $pclistgroup = $this->Multiproductcosting_model->get_multi_product_costing_product_group_by_id($pcost['multi_product_costing_id']);
                                                               $pgcount = count($pclistgroup);
                                                            ?>
                                                            <input type="hidden" id="mailcount<?php echo $k;?>" value="<?php echo $pgcount;?>">
                                                            <tbody id="mcontent10">
                                                               <?php $i=0; foreach($pclistgroup as $pclg)
                                                               {

                                                                 if($pclg['product_item_display_name_id']>0)
                                                                 {
                                                                   $dispname = $this->Productcosting_model->get_display_name_by_id($pclg['product_item_display_name_id']);
                                                                   $dname = $dispname->display_name;
                                                                 }
                                                                 else
                                                                 {
                                                                   $dname = '';
                                                                 }

                                                                  ?>
                                                               <tr id="mid<?php echo $i;?>">
                                                                  <td style="text-align: center; vertical-align: middle;">
                                                                  <div style="width: 300px;">
                                                                     <p><b><?php echo $pclg['product_name'].' - '.$pclg['product_item'];?></b></p>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $dname;?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $pclg['product_unit'];?>
                                                                  </td>
                                                                  <?php $s=1;foreach($multi_product_costing_type_list as $pcstage){
                                                                        $mpcpbypid = $this->Multiproductcosting_model->get_multi_product_costing_product_by_item_type_id($pclg['product_count_no'],$pcstage['multi_product_costing_type_id'],$pcost['multi_product_costing_id']);
                                                                        if(count($mpcpbypid)>0)
                                                                        {
                                                                           $val = $mpcpbypid->multi_product_costing_input;
                                                                        }
                                                                        else{
                                                                           $val = '';
                                                                        }
                                                                     ?>
                                                                     <td style="text-align: center; vertical-align: middle;">
                                                                        <?php //if($pcstage['is_edit']==0)
                                                                        //{?>
                                                                           <span id="val<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>"><?php echo $val;?></span>
                                                                        <?php //}else{?>
                                                                           <!-- <input type="text" class="form-control" id="inp0_<?php //echo $pcstage['multi_product_costing_type_id'];?>" name="inp0_<?php //echo $pcstage['multi_product_costing_type_id'];?>[]" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getCalculatedValue()"> -->
                                                                        <?php //}?>
                                                                        <?php //echo $pcstage['multi_product_costing_type'];?>
                                                                        <input type="hidden" id="is_edit_<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['is_edit'];?>">
                                                                        <input type="hidden" id="math_action_<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['math_action'];?>">
                                                                        <input type="hidden" id="multi_product_costing_type_id_math_<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['multi_product_costing_type_id_math'];?>">
                                                                        <input type="hidden" id="multi_product_costing_type_id_math_1-<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['multi_product_costing_type_id_math_1'];?>">
                                                                        <input type="hidden" id="is_nop_greater_<?php echo $i;?>_<?php echo $pcstage['multi_product_costing_type_id'];?>--<?php echo $k;?>" value="<?php echo $pcstage['is_nop_greater'];?>">
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
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="noprbb<?php //echo $k;?>"></b></span></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="tkg<?php //echo $k;?>"></b></span></td>
                                                                  <td></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="mpcpkg<?php //echo $k;?>"></b></span></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="cpftqiu<?php echo $k;?>"></b></span></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="tifp<?php echo $k;?>"></b></span></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="tmar<?php echo $k;?>"></b></span></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="mpct<?php echo $k;?>"></b></span></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="tcec<?php echo $k;?>"></b></span></td>
                                                               </tr>
                                                            </tfoot> -->
                                                         </table>
                                                      </div>
                                                   </div>


                                                   </div>
                                                </div>
                                       <?php $k++;}?>
                                    </div>
                                 </div>
                              </div>

                            


                              
            
                              
                           </div>
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->
               </div>
            </div>
         </div>

         <!-- end:: Body -->
         <!--begin::Modal-->
<div class="container">
   <div class="modal fade" id="delete_prd_cost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form action="<?php echo base_url(); ?>multiproductcosting/multi_product_costing_delete" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Multi Product Costing</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Delete this Multi Product Costing Permanently?</p>
            </div>
            <input type="hidden" name="mpcid" id="mpcid" value="">
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Yes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
         
<div class="container">
   <div class="modal fade" id="approve_prd_cost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form action="<?php echo base_url(); ?>multiproductcosting/multi_product_costing_approve" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Approve Multi Product Costing</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Approve this Multi Product Costing?</p>
            </div>
            <input type="hidden" name="mpcostid" id="mpcostid" value="">
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Yes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="container">
   <div class="modal fade" id="move_to_quote_prd_cost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form action="<?php echo base_url(); ?>multiproductcosting/quote_create" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Multi Product Costing to Quote</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Move Quote this Multi Product Costing?</p>
            </div>
            <input type="hidden" name="mprodcostid" id="mprodcostid" value="">
            <input type="hidden" name="cifval" id="cifval" value="">
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Yes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="container">
   <div class="modal fade" id="move_to_quote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->




<script type="text/javascript">
   $('.m_table_2').DataTable({responsive:!0});
   $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .responsive.recalc();
   }); 

    var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Multi Product Costing View';
   $(document).attr("title", title);

/*function move_to_quote(val,s){
   var cscount = $('#cscount'+s).val();
   var fobusdval=[];
   for(var i=0;i<cscount;i++)
   {
      fobusdval.push($('#val30'+i+s).html()); 
   }
   
$.ajax({
type: "POST",
url: baseurl+'productcosting/move_to_quote',
async: false,
type: "POST",
data: "id="+val+"&fobusdval="+fobusdval,
dataType: "html",
success: function(response)
{
$('#move_to_quote').empty().append(response);
}
});
} */ 


$(document).ready(function() {
var mpcostcount = $('#mpcostcount').val();
for(var i=0;i<mpcostcount;i++)
{
   getCalculatedValue(i);
}
});


function getCalculatedValue(c)
{
   var mip = $('#margin_in_percent'+c).val();
   var mton = $('#max_ton'+c).val();
   var tvari = $('#ton_variance'+c).val();
   var tdiff = parseFloat(mton) - parseFloat(tvari);
   var noprbb=0;tkg=0;mpcpkg=0;cpftqiu=tifp=tmar=mpct=tcec=0
   if(mip!='')
   {
      var linecount=$('#mailcount'+c).val();
      var mpctcount=$('#mpctcount'+c).val();
      var pusd = '';
      for(var lc=0;lc<linecount;lc++)
      {
         for(var mpctc=1;mpctc<=mpctcount;mpctc++)
         {
            var isedit = $('#is_edit_'+lc+'_'+mpctc+'--'+c).val();
            if(isedit!=1)
            {
               var mathaction = $('#math_action_'+lc+'_'+mpctc+'--'+c).val();
               if(mathaction=='')
               {
                  var ival = $('#val'+lc+'_'+(mpctc-1)+'--'+c).html();
                  if(ival>1 || ival==0)
                  {
                     $('#val'+lc+'_'+mpctc+'--'+c).html(ival);
                  }
                  else
                  {
                     inpval = 1/ival;
                     $('#val'+lc+'_'+mpctc+'--'+c).html(inpval.toFixed('2'));
                  }
               }
               else if(mathaction=='Addition(+)')
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc+'--'+c).val();
                  var splmpctim = mpctim.split(',');
                  var cntsplmpctim = splmpctim.length;
                  var mval = 0;
                  for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                  {
                     var reqval = splmpctim[cntspl];
                     var isedit1 = $('#is_edit_'+lc+'_'+reqval+'--'+c).val();
                     if(isedit1!=1)
                     {
                        mval = parseFloat(mval) + parseFloat($('#val'+lc+'_'+reqval+'--'+c).html());
                     }
                     else
                     {
                        mval = parseFloat(mval) + parseFloat($('#val'+lc+'_'+reqval+'--'+c).html());
                     }
                  }
                  $('#val'+lc+'_'+mpctc+'--'+c).html(mval.toFixed('2'));
               }
               else if(mathaction=='Subtraction(-)')
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc+'--'+c).val();
                  var splmpctim = mpctim.split(',');
                  var cntsplmpctim = splmpctim.length;
                  var mval = 0;
                  for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                  {
                     var reqval = splmpctim[cntspl];
                     var isedit1 = $('#is_edit_'+lc+'_'+reqval+'--'+c).val();
                     if(isedit1!=1)
                     {
                        mval = parseFloat(mval) - parseFloat($('#val'+lc+'_'+reqval+'--'+c).html());
                     }
                     else
                     {
                        mval = parseFloat(mval) - parseFloat($('#val'+lc+'_'+reqval+'--'+c).html());
                     }
                  }
                  $('#val'+lc+'_'+mpctc+'--'+c).html(mval.toFixed('2'));
               }
               else if(mathaction=='Multiplication(*)')
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc+'--'+c).val();
                  var splmpctim = mpctim.split(',');
                  var cntsplmpctim = splmpctim.length;
                  var mval = 1;
                  for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                  {
                     var reqval = splmpctim[cntspl];
                     var isedit1 = $('#is_edit_'+lc+'_'+reqval+'--'+c).val();
                     if(isedit1!=1)
                     {
                        mval = parseFloat(mval) * parseFloat($('#val'+lc+'_'+reqval+'--'+c).html());
                     }
                     else
                     {
                        mval = parseFloat(mval) * parseFloat($('#val'+lc+'_'+reqval+'--'+c).html());
                     }
                  }
                  $('#val'+lc+'_'+mpctc+'--'+c).html(mval.toFixed('2'));
               }
               else if(mathaction=='Percentage(%)')
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc+'--'+c).val();
                  var isedit1 = $('#is_edit_'+lc+'_'+mpctim+'--'+c).val();
                  if(isedit1!=1)
                  {
                     var pval = parseFloat($('#val'+lc+'_'+mpctim+'--'+c).html());
                  }
                  else
                  {
                     var pval = parseFloat($('#val'+lc+'_'+mpctim+'--'+c).html());
                  }
                  var mval = (parseFloat(pval)*parseFloat(mip))/100;
                  $('#val'+lc+'_'+mpctc+'--'+c).html(mval.toFixed('2'));
               }
               else
               {
                  var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc+'--'+c).val();
                  var mpctim1 = $('#multi_product_costing_type_id_math_1-'+lc+'_'+mpctc+'--'+c).val();
                  var nopg = $('#is_nop_greater_'+lc+'_'+mpctc+'--'+c).val();

                  var isedit1 = $('#is_edit_'+lc+'_'+mpctim+'--'+c).val();
                  if(isedit1!=1)
                  {
                     var mval1 = parseFloat($('#val'+lc+'_'+mpctim+'--'+c).html());
                  }
                  else
                  {
                     var mval1 = parseFloat($('#val'+lc+'_'+mpctim+'--'+c).html());
                  }

                  var isedit2 = $('#is_edit_'+lc+'_'+mpctim1+'--'+c).val();
                  if(isedit2!=1)
                  {
                     var mval2 = parseFloat($('#val'+lc+'_'+mpctim1+'--'+c).html());
                  }
                  else
                  {
                     var mval2 = parseFloat($('#val'+lc+'_'+mpctim1+'--'+c).html());
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

                  $('#val'+lc+'_'+mpctc+'--'+c).html(mval.toFixed('2'));
               }
            }
            if(mpctc==3)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc+'--'+c).val();
               if(isedit!=1)
               {
                  noprbb = parseFloat(noprbb) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               else
               {
                  noprbb = parseFloat(noprbb) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               $('#noprbb'+c).html(noprbb.toFixed('2'));
            }
            if(mpctc==4)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc+'--'+c).val();
               if(isedit!=1)
               {
                  tkg = parseFloat(tkg) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               else
               {
                  tkg = parseFloat(tkg) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               $('#tkg'+c).html(tkg.toFixed('2'));
            }
            if(mpctc==6)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc+'--'+c).val();
               if(isedit!=1)
               {
                  mpcpkg = parseFloat(mpcpkg) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               else
               {
                  mpcpkg = parseFloat(mpcpkg) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               $('#mpcpkg'+c).html(mpcpkg.toFixed('2'));
            }
            if(mpctc==14)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc+'--'+c).val();
               if(isedit!=1)
               {
                  cpftqiu = parseFloat(cpftqiu) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               else
               {
                  cpftqiu = parseFloat(cpftqiu) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               $('#cpftqiu'+c).html(cpftqiu.toFixed('2'));
            }
            if(mpctc==15)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc+'--'+c).val();
               if(isedit!=1)
               {
                  tifp = parseFloat(tifp) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               else
               {
                  tifp = parseFloat(tifp) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               $('#tifp'+c).html(tifp.toFixed('2'));
            }
            if(mpctc==16)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc+'--'+c).val();
               if(isedit!=1)
               {
                  tmar = parseFloat(tmar) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               else
               {
                  tmar = parseFloat(tmar) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               $('#tmar'+c).html(tmar.toFixed('2'));
            }
            if(mpctc==17)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc+'--'+c).val();
               if(isedit!=1)
               {
                  mpct = parseFloat(mpct) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               else
               {
                  mpct = parseFloat(mpct) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               $('#mpct'+c).html(mpct.toFixed('2'));
            }
            if(mpctc==18)
            {
               var isedit = $('#is_edit_'+lc+'_'+mpctc+'--'+c).val();
               if(isedit!=1)
               {
                  tcec = parseFloat(tcec) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               else
               {
                  tcec = parseFloat(tcec) + parseFloat($('#val'+lc+'_'+mpctc+'--'+c).html());
               }
               $('#tcec'+c).html(tcec.toFixed('2'));
            }

            if(mpctc==13)
               pusd = pusd.concat($('#val'+lc+'_13--'+c).html()+',');
         }
      }

      $('#cif_price'+c).val('');

      var tkgval = $('#tkg'+c).html();
      if((tkgval/1000)<=parseFloat(tdiff))
      {
         $('#tkg'+c).html('<font color="green">'+tkgval+'</font>');
      }
      else if(((tkgval/1000)>parseFloat(tdiff)) && ((tkgval/1000)<=parseFloat(mton)))
      {
         $('#tkg'+c).html('<font color="orange">'+tkgval+'</font>');
      }
      else
      {
         $('#tkg'+c).html('<font color="red">'+tkgval+'</font>');
      }
   }

}

function multi_product_costing_delete(val)
{
   $("#mpcid").val(val);
   $("#delete_prd_cost").modal('show');
}

function multi_product_costing_approve(val)
{
   $("#mpcostid").val(val);
   $("#approve_prd_cost").modal('show');
}

function multi_product_costing_move_to_quote(val,k)
{
   $("#mprodcostid").val(val);
   var cifp = $('#cif_price'+k).val();
   $("#cifval").val(cifp);
   $("#move_to_quote_prd_cost").modal('show');
}
</script>

   </body>

   <!-- end::Body -->
</html>