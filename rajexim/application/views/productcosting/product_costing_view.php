<?php $this->load->view('common_header'); $date_format =common_date_format();?>
<style>
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
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Product Costing</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Product Costing View</span>
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
                                       Product Costing View
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>productcosting" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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
                                       <?php $isapp=0; foreach($product_costing_list as $qlist){
                                          if($qlist['is_approve']==1)
                                             $isapp=1;
                                          ?>
                                       <li class="nav-item <?php echo $qlist['is_approve']==1?'tabcolor':'';?>">
                                          <a class="nav-link <?php echo $qlist['product_costing_id'] == $product_costing_id?'active':'';?>"  data-toggle="tab" href="#q_<?php echo $qlist['product_costing_id'];?>"><?php echo $qlist['product_costing_no'];?></a>
                                       </li>
                                       <?php }?>
                                    </ul>
                                    <div class="tab-content">
                                       <input type="hidden" id="pcostcount" value="<?php echo count($product_costing_list);?>">
                                       <?php $s=0;foreach($product_costing_list as $pcost){                                          
                                             $product_mapping_list = $this->Productcosting_model->get_product_costing_mapping();
                                             $product_item_id_list = $this->Productcosting_model->get_product_item_by_id($pcost['product_item_id']);
                                             $product_costing_stage = $this->Productcosting_model->get_product_costing_stage_by_piid($pcost['product_item_id']);
                                          ?>
                                          <div class="tab-pane <?php echo $pcost['product_costing_id'] == $product_costing_id?' active':'';?>" id="q_<?php echo $pcost['product_costing_id'];?>" role="tabpanel">
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
                                                <?php if($_SESSION['Product CostingEdit']==1 && $pcost['is_approve']==0 && $isapp==0){ ?>
                                                <a href="<?php echo base_url(); ?>productcosting/product_costing_edit/<?php echo $pcost['product_costing_id'];?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>

                                                <?php if($_SESSION['Product CostingDelete']==1 && $pcost['is_approve']==0 && $isapp==0){ ?>
                                                <a href="javascript:;" onclick="return product_costing_delete(<?php echo $pcost['product_costing_id']; ?>)" data-toggle="m-tooltip" data-placement="top" title="Delete"><span class="tooltip-animation"><i class="fa fa-trash-alt"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>

                                                <?php if($_SESSION['Product CostingApprove']==1 && $pcost['is_approve']==0 && $isapp==0){ ?>
                                                <!-- <a href="javascript:;" onclick="return product_costing_approve(<?php //echo $pcost['product_costing_id']; ?>)" data-toggle="m-tooltip" data-placement="top" title="Approve"><span class="tooltip-animation"><i class="fa fa-check-circle"></i></span></a>&nbsp;&nbsp; -->
                                                <?php }?>

                                                <?php if($_SESSION['Product CostingMove To Quote']==1){ ?>
                                                <?php if($pcost['lead_status']==3){?>
                                                <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#move_to_quote" onclick="return move_to_quote(<?php echo $pcost['product_costing_id']; ?>,<?php echo $s;?>);">
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
                                                   <p class="top_head">
                                                      &nbsp;&nbsp;<?php echo $pcost['product_name'].' - '.$pcost['product_item'];?>
                                                      <span class="pull-right"><?php echo $pcost['created_on'];?> / <?php echo $pcost['name'];?></span>
                                                   </p>


                                                   <div class="row">
                                       <input type="hidden" id="cscount<?php echo $s;?>" value="<?php echo count($product_costing_stage);?>">
                                       <input type="hidden" id="pmlist<?php echo $s;?>" value="<?php echo count($product_mapping_list);?>">
                                       <?php $cspan = count($product_costing_stage)+2;?>
                                       <div class="col-lg-12">
                                          <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
                                             <thead>
                                                <tr>
                                                   <th colspan="<?php echo $cspan;?>" style="text-align: center!important;"><?php echo $pcost['product_name'];?> - <?php echo $pcost['product_item'];?></th>
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
                                                     <input type="hidden" id="in_kg<?php echo $i;?><?php echo $s;?>" value="<?php echo $pcstage['in_kg'];?>">
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
                                                   <input type="hidden" id="pctypecount<?php echo $k;?><?php echo $s;?>" value="<?php echo count($pct);?>">
                                                   <?php $j=0; foreach($pct as $pctype){
                                                      $pcctype = $this->Productcosting_model->get_product_costing_type_by_id($pctid[$j]);
                                                      $pcinputs = $this->Productcosting_model->get_product_costing_input_by_pctype_pcid($pctid[$j],$pcost['product_costing_id']);
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
                                                      <tr id="partitr<?php echo $pctid[$j];?><?php echo $s;?>" <?php echo $inval==0?"style=display:none;":'';?>>
                                                         <td>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pcctype->product_costing_type;?> <?php if($pcctype->is_percent==1){?>(%)<?php }?>
                                                            <input type="hidden" id="ptmaction<?php echo $k;?><?php echo $j;?><?php echo $s;?>" value="<?php echo $pcctype->math_action;?>">
                                                            <input type="hidden" id="product_costing_type_id<?php echo $k;?><?php echo $j;?><?php echo $s;?>" name="product_costing_type_id[]" value="<?php echo $pctid[$j];?>">
                                                            <input type="hidden" id="ispercent<?php echo $k;?><?php echo $j;?><?php echo $s;?>" value="<?php echo $pcctype->is_percent;?>">
                                                            <input type="hidden" id="typecc<?php echo $k;?><?php echo $j;?><?php echo $s;?>" value="<?php echo $pcctype->type_costing_category;?>">
                                                            <input type="hidden" id="isedit<?php echo $k;?><?php echo $j;?><?php echo $s;?>" value="<?php echo $pcctype->is_edit;?>">
                                                         </td>
                                                         <td>
                                                            <!-- <input type="text" id="input<?php //echo $k;?><?php// echo $j;?><?php //echo $s;?>" name="product_costing_input[]" onkeyup="getCalculatedValue(<?php //echo $s;?>)" onkeypress="return isNumberKey(event,this);" value=<?php //echo $inval;?> class="form-control" style="height:25px;" onfocus="this.select();"> -->
                                                            <span id="inputformat<?php echo $k;?><?php echo $j;?><?php echo $s;?>" class="pull-right"><?php echo number_format($inval,2);?></span>
                                                            <span style="display:none;" id="input<?php echo $k;?><?php echo $j;?><?php echo $s;?>" class="pull-right"><?php echo $inval;?></span>
                                                         </td>
                                                         <?php for($i=0;$i<count($product_costing_stage);$i++)
                                                         {?>
                                                            <!-- <td><span id="val<?php //echo $k;?><?php //echo $j;?><?php //echo $i;?>" class="pull-right">0</span></td> -->
                                                            <?php //if($isedit[$j]==0){?>
                                                               <td><span id="val<?php echo $k;?><?php echo $j;?><?php echo $i;?><?php echo $s;?>" class="pull-right">0</span></td>
                                                            <?php //}else{?>
                                                               <!-- <td><input type="text" id="inpval<?php //echo $k;?><?php //echo $j;?><?php //echo $i;?>" onkeyup="getCalculatedStageValue(<?php //echo $k;?>,<?php //echo $j;?>,<?php //echo $i;?>)" onkeypress="return isNumberKey(event,this);" value=0 class="form-control" style="height:25px;" onfocus="this.select();"></td> -->
                                                            <?php //}?>
                                                         <?php }?>
                                                      </tr>
                                                   <?php $j++;}?>
                                                      <tr>
                                                         <td>
                                                         <h5 class="text-black"><?php echo $pcpm['product_costing_category_name'];?></h5>
                                                            <input type="hidden" id="pprodccat<?php echo $k;?><?php echo $s;?>" value="<?php echo $pcpm['parent_product_costing_category_id'];?>">
                                                            <input type="hidden" id="pcmaction<?php echo $k;?><?php echo $s;?>" value="<?php echo $pcpm['math_action'];?>">
                                                         </td>
                                                         <td>
                                                            <h5 class="text-black"></h5>
                                                         </td>
                                                         
                                                         <?php for($i=0;$i<count($product_costing_stage);$i++)
                                                         {?>
                                                            <!-- <td><h5 class="text-black"><span id="stagetot<?php //echo $k;?><?php //echo $i;?><?php //echo $s;?>" class="pull-right">0</span></h5></td> -->
                                                            <td><h5 class="text-black"><span id="stagetotcom<?php echo $k;?><?php echo $i;?><?php echo $s;?>" class="pull-right">0</span></h5>
                                                                <input type="hidden" id="stagetot<?php echo $k;?><?php echo $i;?><?php echo $s;?>">
                                                         <?php }?>
                                                      </tr>
                                                <?php $k++;}?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>


                                                   </div>
                                                </div>
                                       <?php $s++;}?>
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
            <form action="<?php echo base_url(); ?>productcosting/product_costing_delete" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Product Costing</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Delete this Product Costing Permanently?</p>
            </div>
            <input type="hidden" name="pcid" id="pcid" value="">
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Yes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
         <!--begin::Modal-->
<div class="container">
   <div class="modal fade" id="approve_prd_cost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form action="<?php echo base_url(); ?>productcosting/product_costing_approve" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Approve Product Costing</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Approve this Product Costing?</p>
            </div>
            <input type="hidden" name="pcostid" id="pcostid" value="">
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
   var title = $('title').text() + ' | ' + 'Product Costing View';
   $(document).attr("title", title);

function move_to_quote(val,s){
   var cscount = $('#cscount'+s).val();
   var fobval=[];
   var fobusdval=[];
   for(var i=0;i<cscount;i++)
   {
      fobval.push($('#stagetot2'+i+s).val());
      fobusdval.push($('#stagetot3'+i+s).val()); 
   }

   var curval = $('#input300').html();
   
$.ajax({
type: "POST",
url: baseurl+'productcosting/move_to_quote',
async: false,
type: "POST",
data: "id="+val+"&fobusdval="+fobusdval+"&curval="+curval+"&fobval="+fobval,
dataType: "html",
success: function(response)
{
$('#move_to_quote').empty().append(response);
}
});
}  


$(document).ready(function() {
var pcostcount = $('#pcostcount').val();
for(var i=0;i<pcostcount;i++)
{
   getCalculatedValue(i);
}
});


function getCalculatedValue(c)
{
   var pmlist = $('#pmlist'+c).val();
   var cscount = $('#cscount'+c).val();
   for(var k=0;k<pmlist;k++)
   {
      var pctcount = $('#pctypecount'+k+c).val();
      for(var j=0;j<pctcount;j++)
      {
         var ispercent = $('#ispercent'+k+j+c).val();
         var isedit = $('#isedit'+k+j+c).val();
         for(var i=0;i<cscount;i++)
         {
            var kgval = $('#in_kg'+i+c).val();
            var ival = $('#input'+k+j+c).html();
            if(ival == '')
            {
               $('#input'+k+j+c).html(0);
               ival = 0;
            }
            if(ispercent==1)
            {
               var tval = (parseFloat($('#stagetot'+(k-1)+i+c).val())*parseFloat(ival))/100;
            }
            else if(ispercent==2)
            {
               if(ival!=0)
                  var tval = (parseFloat($('#stagetot'+(k-1)+i+c).val())/parseFloat(ival));
               else
                  var tval = parseFloat(0);
            }
            else
            {
               var tval = parseFloat(kgval)*parseFloat(ival);
            }
            $('#val'+k+j+i+c).html(tval.toFixed('2'));
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
               var typval = $('#val'+k+s+i+c).html();

               /*isedit = $('#isedit'+k+s).val();
               if(isedit==0)
                  var typval = $('#val'+k+s+i).html();
               else
                  var typval = $('#inpval'+k+s+i).val();*/

               if(typval=='' || typval==null)
                  typval = 0;
               var maction = $('#ptmaction'+k+j+c).val();
               if(maction == 'Addition(+)')
                  tcat = parseFloat(tcat)+parseFloat(typval);
               if(maction == 'Subtraction(-)')
                  tcat = parseFloat(tcat)-parseFloat(typval);
               if(maction == 'Multiplication(*)')
                  tcat = parseFloat(tcat)*parseFloat(typval);
               if(maction == 'Division(/)')
                  tcat = parseFloat(tcat)/parseFloat(typval);
            }

            var pprodccat = $('#pprodccat'+k+c).val();
            var pcmaction = $('#pcmaction'+k+c).val();
            if(pprodccat !=0)
            {
               if(pcmaction == 'Addition(+)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i+c).val())+parseFloat(tcat);
               if(pcmaction == 'Subtraction(-)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i+c).val())-parseFloat(tcat);
               if(pcmaction == 'Multiplication(*)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i+c).val())*parseFloat(tcat);
               if(pcmaction == 'Division(/)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i+c).val())/parseFloat(tcat);
               
               $('#stagetotcom'+k+i+c).html(ptcat.toLocaleString("en"));
               $('#stagetot'+k+i+c).val(ptcat.toFixed('2'));
            }
            else
            {
               $('#stagetotcom'+k+i+c).html(tcat.toLocaleString("en"));
               $('#stagetot'+k+i+c).val(tcat.toFixed('2'));
            }

         }

      }

   }

}

function product_costing_delete(val)
{
   $("#pcid").val(val);
   $("#delete_prd_cost").modal('show');
}

function product_costing_approve(val)
{
   $("#pcostid").val(val);
   $("#approve_prd_cost").modal('show');
}
</script>

   </body>

   <!-- end::Body -->
</html>