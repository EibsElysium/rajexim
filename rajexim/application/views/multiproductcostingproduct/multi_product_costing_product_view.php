<?php $this->load->view('common_header'); $date_format =common_date_format();?>

<style>


.table-wrapper {
    overflow-x: scroll;
    width: 600px;
    margin: 0 auto;
}

.wrapclass{
   word-wrap: break-word;
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
                              <a href="<?php echo base_url(); ?>multiproductcostingproduct" class="m-nav__link">
                                 <span class="m-nav__link-text">Multi Product Costing - P</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">View Multi Product Costing - P</span>
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
                                       View Multi Product Costing - P
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>multiproductcostingproduct" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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
                                       <?php $isapp=0;foreach($multi_product_costing_product_list as $qlist){
                                          if($qlist['is_approve']==1)
                                             $isapp=1;?>
                                       <li class="nav-item <?php echo $qlist['is_approve']==1?'tabcolor':'';?>">
                                          <a class="nav-link <?php echo $qlist['multi_product_costing_prod_v2_id'] == $multi_product_costing_prod_v2_id?'active':'';?>"  data-toggle="tab" href="#q_<?php echo $qlist['multi_product_costing_prod_v2_id'];?>"><?php echo $qlist['multi_product_costing_prod_v2_no'];?></a>
                                       </li>
                                       <?php }?>
                                    </ul>
                                    <div class="tab-content">
                                       <input type="hidden" id="mpcostcount" value="<?php echo count($multi_product_costing_product_list);?>">
                                       <?php $k=0;foreach($multi_product_costing_product_list as $pcost){ 
                                          ?>
                                          <div class="tab-pane <?php echo $pcost['multi_product_costing_prod_v2_id'] == $multi_product_costing_prod_v2_id?' active':'';?>" id="q_<?php echo $pcost['multi_product_costing_prod_v2_id'];?>" role="tabpanel">
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
                                                <?php if($_SESSION['Multi Product Costing - PEdit']==1 && $pcost['is_approve']==0 && $isapp==0){ ?>
                                                <a href="<?php echo base_url(); ?>multiproductcostingproduct/multi_product_costing_product_edit/<?php echo $pcost['multi_product_costing_prod_v2_id'];?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>

                                                <?php if($_SESSION['Multi Product Costing - PDelete']==1 && $pcost['is_approve']==0 && $isapp==0){ ?>
                                                <a href="javascript:;" onclick="return multi_product_costing_product_delete(<?php echo $pcost['multi_product_costing_prod_v2_id']; ?>)" data-toggle="m-tooltip" data-placement="top" title="Delete"><span class="tooltip-animation"><i class="fa fa-trash-alt"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>

                                                <?php if($_SESSION['Multi Product Costing - PApprove']==1 && $pcost['is_approve']==0 && $isapp==0){ ?>
                                                <!-- <a href="javascript:;" onclick="return multi_product_costing_product_approve(<?php //echo $pcost['multi_product_costing_prod_v2_id']; ?>)" data-toggle="m-tooltip" data-placement="top" title="Approve"><span class="tooltip-animation"><i class="fa fa-check-circle"></i></span></a>&nbsp;&nbsp;

                                                <span id="apperr<?php //echo $pcost['multi_product_costing_prod_v2_id'];?>" style="display:none;"></span> -->
                                                <?php }?>

                                                <?php if($_SESSION['Multi Product Costing - PMove To Quote']==1){ ?>
                                                <?php if($pcost['lead_status']==3){?>

                                                <!-- <a href="<?php //echo base_url(); ?>multiproductcostingproduct/quote_create/<?php //echo $pcost['multi_product_costing_prod_v2_id'];?>" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                                   <span>
                                                      <i class="fa fa-arrow-circle-right"></i>
                                                      <span>Move to Quote</span>
                                                   </span>
                                                </a> -->

                                                <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#move_to_quote" onclick="return move_to_quote(<?php echo $pcost['multi_product_costing_prod_v2_id'];?>);">
                                                   <span>
                                                      <i class="fa fa-arrow-circle-right"></i>
                                                      <span>Move to Quote</span>
                                                   </span>
                                                </a>
                                                <br><br>
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
                                    <div class="col-lg-6">
                                       <div class="form-group m-form__group">
                                          <label>Lead<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="lead_name<?php echo $k;?>" name="lead_name" value="<?php echo $pcost['lead_name'].' - '.$pcost['company_name'].' - '.$pcost['name'];?>" readonly>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Container<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="container_name<?php echo $k;?>" name="container_name" value="<?php echo $pcost['container_name'];?>" readonly>

                                          <input type="hidden" id="min_cbm<?php echo $k;?>" value="<?php echo $pcost['min_cbm'];?>">
                                          <input type="hidden" id="max_cbm<?php echo $k;?>" value="<?php echo $pcost['max_cbm'];?>">
                                          <input type="hidden" id="max_ton<?php echo $k;?>" value="<?php echo $pcost['max_ton'];?>">
                                          <input type="hidden" id="ton_variance<?php echo $k;?>" value="<?php echo $pcost['ton_variance'];?>">

                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>CHA Expense</label>
                                          <input type="text" class="form-control" id="cha_expense<?php echo $k;?>" name="cha_expense" onkeypress="return isNumberKey(event,this);" value="<?php echo $pcost['cha_expense'];?>" readonly>
                                       </div>
                                    </div> 

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Commission Charge</label>
                                          <input type="text" class="form-control" id="commission_charge<?php echo $k;?>" name="commission_charge" onkeypress="return isNumberKey(event,this);" value="<?php echo $pcost['commission_charge'];?>" readonly>
                                       </div>
                                    </div> 

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Bank Charge in %</label>
                                          <input type="text" class="form-control" id="bank_charge<?php echo $k;?>" name="bank_charge" onkeypress="return isNumberKey(event,this);" value="<?php echo $pcost['bank_charge'];?>" readonly>
                                       </div>
                                    </div> 

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Freight Charge</label>
                                          <input type="text" class="form-control" id="freight_charge<?php echo $k;?>" name="freight_charge" onkeypress="return isNumberKey(event,this);" value="<?php echo $pcost['freight_charge'];?>" readonly>
                                       </div>
                                    </div> 

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Currency<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="currency<?php echo $k;?>" name="currency" value="<?php echo $pcost['currency_code'].' - '.$pcost['currency_name'];?>" readonly>
                                       </div>
                                    </div>

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Conversion Rate</label>
                                          <input type="text" class="form-control" id="conversion_rate<?php echo $k;?>" name="conversion_rate" onkeypress="return isNumberKey(event,this);" value="<?php echo $pcost['conversion_rate'];?>" readonly>
                                       </div>
                                    </div> 
                                 </div>


                                                   <div class="row">
                                                      <!-- <input type="hidden" id="mpctcount<?php //echo $k;?>" value="<?php //echo count($multi_product_costing_type_list);?>"> -->
                                                      <div class="col-lg-12 table-wrapper">
                                                         <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme wrapclass">
                                                            <thead>
                                                               <tr>
                                                                  <th>Product Item</th>
                                                                  <th>Display Name</th>
                                                                  <th>Input SKU</th>
                                                                  <th>Purchase Cost</th>
                                                                  <th>Margin %</th>
                                                                  <th>Margin Value</th>
                                                                  <th>Quantity</th>
                                                                  <th>Output SKU</th>
                                                                  <th>FOB Value in <?php echo $pcost['currency_code'];?></th>
                                                                  <th>Freight/Qty</th>
                                                                  <th>CNF Price/Qty</th>
                                                                  <th>CHA/Qty</th>
                                                                  <th>Commission Charge/Qty</th>
                                                                  <th>FOB Value</th>
                                                                  <th>Bank Charge</th>
                                                                  <th>Total FOB Value</th>
                                                                  <th>Total Price</th>
                                                                  <th>Total Margin</th>
                                                                  <th>Total CHA</th>
                                                                  <th>Total Commission Charge</th>
                                                                  <th>Total Freight</th>
                                                                  <th>% in Container</th>
                                                               </tr>
                                                            </thead>
                                                            <?php $pclistgroup = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_input_by_id($pcost['multi_product_costing_prod_v2_id']);
                                                               $pgcount = count($pclistgroup);

                                                            ?>
                                                            <input type="hidden" id="mailcount<?php echo $k;?>" value="<?php echo $pgcount;?>">
                                                            <tbody id="mcontent10">
                                                               <?php $i=0; $tqty=$tfob=$tfobcur=$cnfp=$tp=$tm=$tcha=$tccharge=$tf=$cip=0; foreach($pclistgroup as $pclg)
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

                                                                  $pcsubstagelist = $this->Multiproductcostingproduct_model->get_product_costing_stage_by_id($pclg["product_costing_stage_id"]);
                                                                  $unit = $pcsubstagelist->stage_sku_name;
                                                                  /*if($pcsubstagelist->sub_stage==0)
                                                                  {
                                                                     $unit = $pcsubstagelist->unit_value.' '.$pcsubstagelist->stage_name;
                                                                  }
                                                                  else
                                                                  {
                                                                     $pcsubstageli = $this->Multiproductcostingproduct_model->get_product_costing_stage_by_id($pcsubstagelist->sub_stage);
                                                                     $unit = $pcsubstagelist->unit_value.' '.$pcsubstageli->stage_name;
                                                                  }*/

                                                                  $ipcsubstagelist = $this->Multiproductcostingproduct_model->get_product_costing_stage_by_id($pclg["input_product_costing_stage_id"]);
                                                                  $iunit = $ipcsubstagelist->stage_sku_name;
                                                                  /*if($ipcsubstagelist->sub_stage==0)
                                                                  {
                                                                     $iunit = $ipcsubstagelist->unit_value.' '.$ipcsubstagelist->stage_name;
                                                                  }
                                                                  else
                                                                  {
                                                                     $ipcsubstageli = $this->Multiproductcostingproduct_model->get_product_costing_stage_by_id($ipcsubstagelist->sub_stage);
                                                                     $iunit = $ipcsubstagelist->unit_value.' '.$ipcsubstageli->stage_name;
                                                                  }*/


                                                                  //$tqty+=$pclg['quantity']*$pclg['product_costing_stage_value'];
                                                                  $tqty+=$pclg['quantity'];
                                                                  $tfob+=$pclg['total_fob_value'];
                                                                  $tfobcur+=$pclg['fob_value_in_currency'];
                                                                  $cnfp+=$pclg['cnf_price'];
                                                                  $tp+=$pclg['total_price'];
                                                                  $tm+=$pclg['total_margin'];
                                                                  $tcha+=$pclg['total_cha'];
                                                                  $tccharge+=$pclg['total_commission_charge'];
                                                                  $tf+=$pclg['total_freight'];
                                                                  $cip+=$pclg['container_in_percent'];
                                                                  ?>
                                                               <tr id="mid<?php echo $i;?>">
                                                                  <td style="text-align: center; vertical-align: middle;">
                                                                  <div style="width: 300px;">
                                                                     <p><b><?php echo $pclg['product_name'].' - '.$pclg['product_item'];?></b></p>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 200px;">
                                                                        <?php echo $dname;?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 200px;">
                                                                        <?php echo $iunit;?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo $pclg['purchase_cost'];?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo $pclg['margin_in_percent'];?>
                                                                     </div>
                                                                  </td>
                                                                  <td>                                                   
                                                                     <div style="width: 100px;">
                                                                        <?php echo $pclg['margin_value'];?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo $pclg['quantity'];?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 200px;">
                                                                        <?php echo $unit;?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['fob_value_in_currency'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['freight_per_quantity'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['cnf_price'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['cha_per_quantity'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['commission_charge_per_quantity'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['fob_value'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['bank_charge'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['total_fob_value'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['total_price'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['total_margin'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['total_cha'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['total_commission_charge'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>
                                                                     <div style="width: 100px;">
                                                                        <?php echo number_format($pclg['total_freight'],2);?>
                                                                     </div>
                                                                  </td>
                                                                  <td>     
                                                                        <?php echo number_format($pclg['container_in_percent'],2);?>
                                                                  </td>
                                                               </tr>
                                                               <?php $i++;}?>
                                                            </tbody>
                                                            <tfoot>
                                                               <tr>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalqty"><?php echo number_format($tqty,2);?></span></b></td>
                                                                  <td></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalfobvalcur"><?php //echo number_format($tfobcur,2);?></span></b></td>
                                                                  <td></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalcnfprice"><?php //echo number_format($cnfp,2);?></span></b></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalfobval"><?php echo number_format($tfob,2);?></span></b></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalprice"><?php echo number_format($tp,2);?></span></b></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalmargin"><?php echo number_format($tm,2);?></span></b></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalcha"><?php echo number_format($tcha,2);?></span></b></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalcommission"><?php echo number_format($tccharge,2);?></span></b></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalfreight"><?php echo number_format($tf,2);?></span></b></td>
                                                                  <td style="text-align: center; vertical-align: middle;"><b><span id="totalcip<?php echo $pcost['multi_product_costing_prod_v2_id'];?>"><?php echo number_format($cip,2);?></span></b></td>
                                                               </tr>
                                                            </tfoot>
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
            <form action="<?php echo base_url(); ?>multiproductcostingproduct/multi_product_costing_product_delete" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Multi Product Costing - P</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Delete this Multi Product Costing - P Permanently?</p>
            </div>
            <input type="hidden" name="mpcpid" id="mpcpid" value="">
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
            <form action="<?php echo base_url(); ?>multiproductcostingproduct/multi_product_costing_product_approve" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Approve Multi Product Costing - P</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Approve this Multi Product Costing - P?</p>
            </div>
            <input type="hidden" name="mpcostpid" id="mpcostpid" value="">
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
   <div class="modal fade" id="approve_prd_cost_exceed_cont" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form action="<?php echo base_url(); ?>multiproductcostingproduct/multi_product_costing_product_approve" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Approve Multi Product Costing - P</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Approve this Multi Product Costing - P With Container % exceeds 100?</p>
            </div>
            <input type="hidden" name="mpcostpid" id="mpcostpid" value="">
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
   var title = $('title').text() + ' | ' + 'View Multi Product Costing - P';
   $(document).attr("title", title);

   $("div[id^='q_']").each(function(){
      var id = this.id;
      var i = id.substring(2);
      var totalcip = $('#totalcip'+i).html();
      
      if(totalcip>100)
      {
         $('#apperr'+i).html(1);
      }
      else
      {
         $('#apperr'+i).html(0);
      }
   });

   

function move_to_quote(val){
   
$.ajax({
type: "POST",
url: baseurl+'multiproductcostingproduct/move_to_quote',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#move_to_quote').empty().append(response);
}
});
}  


/*$(document).ready(function() {
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
         }
      }
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

}*/

function multi_product_costing_product_delete(val)
{
   $("#mpcpid").val(val);
   $("#delete_prd_cost").modal('show');
}

function multi_product_costing_product_approve(val)
{
   var apperr = $('#apperr'+val).html();
   $("#mpcostpid").val(val);
   if(apperr==0)
      $("#approve_prd_cost").modal('show');
   else
      $("#approve_prd_cost_exceed_cont").modal('show');
}
</script>

   </body>

   <!-- end::Body -->
</html>