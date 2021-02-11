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
                              <a href="<?php echo base_url(); ?>multiproductcostingproduct" class="m-nav__link">
                                 <span class="m-nav__link-text">Multi Product Costing - P</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Edit Multi Product Costing - P</span>
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
                                      Edit Multi Product Costing - P
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
                           <form  name="productcosting_form" id="productcosting_form" method="POST" action="<?php echo base_url(); ?>multiproductcostingproduct/multi_product_costing_product_update" onsubmit="return multi_product_costing_product_validation();" >
                              <input type="hidden" id="multi_product_costing_prod_v2_id" name="multi_product_costing_prod_v2_id" value="<?php echo $multi_product_costing_list->multi_product_costing_prod_v2_id;?>">
                              <input type="hidden" id="pc_no" name="pc_no" value="<?php echo $multi_product_costing_list->multi_product_costing_prod_v2_no;?>">
                              <input type="hidden" id="parent_costing_id" name="parent_costing_id" value="<?php echo $multi_product_costing_list->parent_costing_id;?>">
                              <input type="hidden" id="revised" name="revised" value="<?php echo $multi_product_costing_list->revised;?>">
                              <div class="m-portlet__body">
                                 <!--begin: Datatable -->

                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group m-form__group">
                                          <label>Lead<span class="text-danger">*</span></label>
                                          <!-- <select class="form-control m-bootstrap-select m_selectpicker" id="lead_id" name="lead_id" data-live-search="true">
                                             <option value="">Select Lead</option>
                                             <?php //foreach($lead_list as $plist){?>
                                                <option value="<?php //echo $plist['lead_id'];?>" <?php //echo $plist['lead_id'] == $multi_product_costing_list->lead_id?'selected':'';?>><?php //echo $plist['lead_name'];?> - <?php //echo $plist['email_id'];?></option>
                                             <?php //}?>
                                          </select> -->
                                          <input type="text" class="form-control" id="lead_name<?php echo $k;?>" name="lead_name" value="<?php echo $multi_product_costing_list->lead_name.' - '.$multi_product_costing_list->company_name.' - '.$multi_product_costing_list->country_name;?>" readonly>
                                          <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $multi_product_costing_list->lead_id;?>">
                                          <span id="lead_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Container<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" id="container_id" name="container_id" data-live-search="true" onchange="get_container_details(this.value);">
                                             <option value="">Select Container</option>
                                             <?php foreach($container_list as $plist){?>
                                                <option value="<?php echo $plist['container_id'];?>" <?php echo $plist['container_id'] == $multi_product_costing_list->container_id?'selected':'';?>><?php echo $plist['container_name'];?></option>
                                             <?php }?>
                                          </select>
                                          <input type="hidden" id="min_cbm" value="<?php echo $multi_product_costing_list->min_cbm;?>">
                                          <input type="hidden" id="max_cbm" value="<?php echo $multi_product_costing_list->max_cbm;?>">
                                          <input type="hidden" id="max_ton" value="<?php echo $multi_product_costing_list->max_ton;?>">
                                          <input type="hidden" id="ton_variance" value="<?php echo $multi_product_costing_list->ton_variance;?>">
                                          <span id="container_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>CHA Expense</label>
                                          <input type="text" class="form-control" id="cha_expense" name="cha_expense" onkeypress="return isNumberKey(event,this);" value="<?php echo $multi_product_costing_list->cha_expense;?>" onfocus="this.select();" onkeyup="getTotalValue();">
                                       </div>
                                    </div> 

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Commission Charge</label>
                                          <input type="text" class="form-control" id="commission_charge" name="commission_charge" onkeypress="return isNumberKey(event,this);" value="<?php echo $multi_product_costing_list->commission_charge;?>" onfocus="this.select();" onkeyup="getTotalValue();">
                                       </div>
                                    </div> 

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Bank Charge in %</label>
                                          <input type="text" class="form-control" id="bank_charge" name="bank_charge" onkeypress="return isNumberKey(event,this);" value="<?php echo $multi_product_costing_list->bank_charge;?>" onfocus="this.select();" onkeyup="getTotalValue();">
                                       </div>
                                    </div> 

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Freight Charge</label>
                                          <input type="text" class="form-control" id="freight_charge" name="freight_charge" onkeypress="return isNumberKey(event,this);" value="<?php echo $multi_product_costing_list->freight_charge;?>" onfocus="this.select();" onkeyup="getTotalValue();">
                                       </div>
                                    </div> 

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Currency<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" id="currency_id" name="currency_id" data-live-search="true" onchange="getCurrency(this.value);">
                                             <option value="">Select Currency</option>
                                             <?php foreach($currency_list as $plist){?>
                                                <option value="<?php echo $plist['currency_id'];?>" <?php echo $plist['currency_id'] == $multi_product_costing_list->currency_id?'selected':'';?>><?php echo $plist['currency_code'];?> - <?php echo $plist['currency_name'];?></option>
                                             <?php }?>
                                          </select>
                                          <span id="currency_id_err" class="text-danger"></span>
                                       </div>
                                    </div>

                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Conversion Rate<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="conversion_rate" name="conversion_rate" onkeypress="return isNumberKey(event,this);" value="<?php echo $multi_product_costing_list->conversion_rate;?>" onfocus="this.select();" onkeyup="getTotalValue();">
                                          <span id="conversion_rate_err" class="text-danger"></span>
                                       </div>
                                    </div> 
                                    <input type="hidden" id="totalquantity">
                                    
                                 </div>

                                 <input type="hidden" id="locprod" value="<?php echo $lead_costing;?>">

                                 <div class="row">
                                    <div class="col-lg-12 table-wrapper">
                                       <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
                                          <thead>
                                             <tr>
                                                <th></th>
                                                <th>Product Item</th>
                                                <th>Display Name</th>
                                                <th>Input SKU</th>
                                                <th>Purchase Cost</th>
                                                <th>Margin %</th>
                                                <th>Margin Value</th>
                                                <th>Quantity</th>
                                                <th>Output SKU</th>
                                                <th>FOB Value in <span id="curr"><?php echo $multi_product_costing_list->currency_code;?></span></th>
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
                                          <tbody id="mcontent10">
                                             <?php $pclistgroup = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_input_by_id($multi_product_costing_prod_v2_id);
                                             $pgcount = count($pclistgroup);
                                             $i=0; $tqty=$tfob=$tfobcur=$cnfp=$tp=$tm=$tcha=$tccharge=$tf=$cip=0; foreach($pclistgroup as $pclg)
                                             {
                                                /*$pcllist = $this->Multiproductcostingproduct_model->get_product_costing_by_id($pclg['product_costing_id']);
                                                $piid = $pcllist->product_item_id;*/
                                                $piid = $pclg['product_item_id'];
                                                $pcstage = $this->Multiproductcostingproduct_model->get_last_product_costing_stage_by_product_item_id($piid);
                                                $inkg = $pcstage->in_kg;

                                                $pcstagelist = $this->Multiproductcostingproduct_model->get_product_costing_stage_by_piid($piid);
                                                $displayname = $this->Product_model->get_display_name_by_piid($piid);

                                                /*$pcilist = $this->Multiproductcostingproduct_model->get_product_costing_input_by_type_pcid($pclg['product_costing_id']);
                                                $purcost = 0;
                                                foreach($pcilist as $pcl)
                                                {
                                                   if($pcl['product_costing_type_id']==1)
                                                   {
                                                      $purcost+= $pcl['product_costing_input'];
                                                   }
                                                   if($pcl['product_costing_type_id']==2)
                                                   {
                                                      $purcost+= $pcl['product_costing_input'];
                                                   }
                                                   if($pcl['product_costing_type_id']==3)
                                                   {
                                                      $purcost+= $pcl['product_costing_input'];
                                                   }
                                                } */                                            


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
                                                   <td>
                                                      <?php if($i!=0){?>
                                                      <label></label><button type="button" class="btn btn-danger" onclick="remove_product_line(<?php echo $i;?>)"><i class="fa fa-minus"></i></button>
                                                      <?php }?>
                                                   </td>
                                                   <td>
                                                   <div style="width: 300px;">
                                                      <select class="form-control m-bootstrap-select m_selectpicker pclist" id="product_item_id<?php echo $i;?>" name="product_item_id[]" data-live-search="true" onchange="getProductItemInputs(this.value,<?php echo $i;?>);"> 
                                                      <option value=''>Choose Product</option> 
                                                      <?php foreach ($product_item_list as $pilist) { ?>
                                                      <option value="<?php echo $pilist['product_item_id']; ?>" <?php echo $pilist['product_item_id'] == $pclg['product_item_id']?'selected':'';?>><?php echo $pilist['product_name'].' - '.$pilist['product_item'];?></option>
                                                      <?php } ?>
                                                      </select>
                                                      <input type="hidden" id="in_kg<?php echo $i;?>" value="<?php echo $inkg;?>">
                                                      <!-- <input type="hidden" id="single_cost<?php //echo $i;?>" name="single_cost[]" value="<?php //echo $purcost;?>"> -->
                                                      <span id="product_item_id_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 200px;">
                                                         <select class="form-control m-bootstrap-select m_selectpicker" id="product_item_display_name_id<?php echo $i;?>" name="product_item_display_name_id[]" data-live-search="true">
                                                         <option value=''>Choose Display Name</option>
                                                         <?php foreach ($displayname as $dname) {?>
                                                            <option value='<?php echo $dname["product_item_display_name_id"];?>' <?php echo $dname['product_item_display_name_id'] == $pclg['product_item_display_name_id']?'selected':'';?>><?php echo $dname["display_name"];?></option>;
                                                         <?php }
                                                         ?>
                                                         </select>
                                                         <span id="product_item_display_name_id_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 200px;">
                                                         <select class="form-control m-bootstrap-select m_selectpicker" id="input_product_costing_stage_id<?php echo $i;?>" name="input_product_costing_stage_id[]" data-live-search="true">
                                                         <?php foreach ($pcstagelist as $pcslist) {?>
                                                            <option value='<?php echo $pcslist["product_costing_stage_id"];?>' <?php echo $pcslist['product_costing_stage_id'] == $pclg['input_product_costing_stage_id']?'selected':'';?>><?php echo $pcslist["stage_sku_name"];?></option>;
                                                         <?php }
                                                         ?>
                                                         </select>
                                                         <input type="hidden" id="input_product_costing_stage_value<?php echo $i;?>" name="input_product_costing_stage_value[]" value="<?php echo $pclg['input_product_costing_stage_value'];?>">
                                                         <span id="input_product_costing_stage_id_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>

                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="purchase_cost<?php echo $i;?>" name="purchase_cost[]" value="<?php echo $pclg['purchase_cost'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getCalculatedValue(<?php echo $i;?>);">
                                                         <span id="purchase_cost_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>

                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="margin_in_percent<?php echo $i;?>" name="margin_in_percent[]" value="<?php echo $pclg['margin_in_percent'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getCalculatedValue(<?php echo $i;?>);">
                                                         <span id="margin_in_percent_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>                                                   
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="margin_value<?php echo $i;?>" name="margin_value[]" value="<?php echo $pclg['margin_value'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="margin_value_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="quantity<?php echo $i;?>" name="quantity[]" value="<?php echo $pclg['quantity'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getCalculatedValue(<?php echo $i;?>);">
                                                         <span id="quantity_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 200px;">
                                                         <select class="form-control m-bootstrap-select m_selectpicker" id="product_costing_stage_id<?php echo $i;?>" name="product_costing_stage_id[]" data-live-search="true">
                                                         <?php foreach ($pcstagelist as $pcslist) {
                                                            /*if($pcslist["sub_stage"]==0)
                                                            {
                                                               $unit = $pcslist["stage_name"];
                                                            }
                                                            else
                                                            {
                                                               $pcsubstagelist = $this->Multiproductcostingproduct_model->get_product_costing_stage_by_id($pcslist["sub_stage"]);
                                                               $unit = $pcsubstagelist->stage_name;
                                                            }*/?>
                                                            <option value='<?php echo $pcslist["product_costing_stage_id"];?>' <?php echo $pcslist['product_costing_stage_id'] == $pclg['product_costing_stage_id']?'selected':'';?>><?php echo $pcslist["stage_sku_name"].' '.$unit;?></option>;
                                                         <?php }
                                                         ?>
                                                         </select>
                                                         <input type="hidden" id="product_costing_stage_value<?php echo $i;?>" name="product_costing_stage_value[]" value="<?php echo $pclg['product_costing_stage_value'];?>">
                                                         <span id="product_costing_stage_id_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="fob_value_in_currency_format<?php echo $i;?>" value="<?php echo number_format($pclg['fob_value_in_currency'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="fob_value_in_currency<?php echo $i;?>" name="fob_value_in_currency[]" value="<?php echo $pclg['fob_value_in_currency'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="fob_value_in_currency_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="fcharge_format<?php echo $i;?>" value="<?php echo number_format($pclg['freight_per_quantity'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="fcharge<?php echo $i;?>" name="fcharge[]" value="<?php echo $pclg['freight_per_quantity'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="fcharge_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="cnf_price_format<?php echo $i;?>" value="<?php echo number_format($pclg['cnf_price'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="cnf_price<?php echo $i;?>" name="cnf_price[]" value="<?php echo $pclg['cnf_price'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="cnf_price_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="cha_format<?php echo $i;?>" value="<?php echo number_format($pclg['cha_per_quantity'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="cha<?php echo $i;?>" name="cha[]" value="<?php echo $pclg['cha_per_quantity'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="cha_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="ccharge_format<?php echo $i;?>" value="<?php echo number_format($pclg['commission_charge_per_quantity'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="ccharge<?php echo $i;?>" name="ccharge[]" value="<?php echo $pclg['commission_charge_per_quantity'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="ccharge_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="fob_value_format<?php echo $i;?>" value="<?php echo number_format($pclg['fob_value'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="fob_value<?php echo $i;?>" name="fob_value[]" value="<?php echo $pclg['fob_value'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="fob_value_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="bcharge_format<?php echo $i;?>" value="<?php echo number_format($pclg['bank_charge'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="bcharge<?php echo $i;?>" name="bcharge[]" value="<?php echo $pclg['bank_charge'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="bcharge_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="total_fob_value_format<?php echo $i;?>" value="<?php echo number_format($pclg['total_fob_value'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="total_fob_value<?php echo $i;?>" name="total_fob_value[]" value="<?php echo $pclg['total_fob_value'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="total_fob_value_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="total_price_format<?php echo $i;?>" value="<?php echo number_format($pclg['total_price'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="total_price<?php echo $i;?>" name="total_price[]" value="<?php echo $pclg['total_price'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="total_price_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="total_margin_format<?php echo $i;?>" value="<?php echo number_format($pclg['total_margin'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="total_margin<?php echo $i;?>" name="total_margin[]" value="<?php echo $pclg['total_margin'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="total_margin_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="total_cha_format<?php echo $i;?>" value="<?php echo number_format($pclg['total_cha'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="total_cha<?php echo $i;?>" name="total_cha[]" value="<?php echo $pclg['total_cha'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="total_cha_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="total_commission_format<?php echo $i;?>" value="<?php echo number_format($pclg['total_commission_charge'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="total_commission<?php echo $i;?>" name="total_commission[]" value="<?php echo $pclg['total_commission_charge'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="total_commission_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <div style="width: 100px;">
                                                         <input type="text" class="form-control" id="total_freight_format<?php echo $i;?>" value="<?php echo number_format($pclg['total_freight'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                         <input type="hidden" class="form-control" id="total_freight<?php echo $i;?>" name="total_freight[]" value="<?php echo $pclg['total_freight'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                         <span id="total_freight_err<?php echo $i;?>" class="text-danger"></span>
                                                      </div>
                                                   </td>
                                                   <td>
                                                      <input type="text" class="form-control" id="container_in_percent_format<?php echo $i;?>" value="<?php echo number_format($pclg['container_in_percent'],2);?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>

                                                      <input type="hidden" class="form-control" id="container_in_percent<?php echo $i;?>" name="container_in_percent[]" value="<?php echo $pclg['container_in_percent'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                      <span id="container_in_percent_err<?php echo $i;?>" class="text-danger"></span>
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
                                                <td style="text-align: center; vertical-align: middle;"><b><span id="totalcip"><?php echo number_format($cip,2);?></span></b></td>
                                             </tr>
                                          </tfoot>
                                       </table>
                                    </div>
                                 </div>
                                 <br>
                                 <div id="totkg_err" class="text-danger"></div>
                                 <div id="tcip_err" class="text-danger"></div>
                                 <br>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group m-form__group">
                                          <div class="pull-right">
                                             <button type="button" class="btn btn-primary" onclick="addMultiProductLine()">
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
                                       <input type="submit"  class="btn btn-primary" name="submit" id="btnsubmit" value="Save Changes" onclick="changedraftvalue(this.value);">
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
var title = $('title').text() + ' | ' + 'Edit Multi Product Costing - P';
$(document).attr("title", title); 

$('.table-wrapper').on('show.bs.dropdown', function () {
     $('.table-wrapper').css( "overflow", "inherit" );
});

$('.table-wrapper').on('hide.bs.dropdown', function () {
     $('.table-wrapper').css( "overflow", "auto" );
})

function get_container_details(val)
{
   if(val!='')
   {
      $.ajax({
      type: "POST",
      url: baseurl+'multiproductcostingproduct/get_container_details',
      async: false,
      data: "cid="+val,
      dataType: "html",
      success: function(response)
      {
         var sdata = response.split('|');
         $('#min_cbm').val(sdata[0]);
         $('#max_cbm').val(sdata[1]);
         $('#max_ton').val(sdata[2]);
         $('#ton_variance').val(sdata[3]);
         $('#locprod').val(sdata[4]);
         $("select[id^='product_item_id']").each(function(){
            var id = this.id;
            var res = id.substring(15);
            $('#product_item_id'+res).empty().append(sdata[4]);
            $('#product_item_id'+res).selectpicker('refresh');
         });
      }
   });
   }
}

function getCurrency(val)
{
   if(val!='')
   {
      $.ajax({
      type: "POST",
      url: baseurl+'multiproductcostingproduct/getCurrency',
      async: false,
      data: "cid="+val,
      dataType: "html",
      success: function(response)
      {
         //var sdata = response.split('|');
         $('#curr').html(response);
      }
   });
   }
}

/*function getLeadProductCosting(val)
{
   if(val!='')
   {

      $("tr[id^='mid']").each(function(){
        var id = this.id;
        var res = id.substring(3);
        if(res!=0)
        {
         $('#mid'+res).remove();
        }
        else
        {
         $('#purchase_cost'+res).val(0);
         $('#margin_in_percent'+res).val(0);
         $('#margin_value'+res).val(0);
         $('#quantity'+res).val(1);
         $('#product_costing_stage_id'+res).val('');
         $('#selling_price'+res).val(0);

         $('#total_price'+res).val(0);
         $('#total_margin'+res).val(0);
         $('#container_in_percent'+res).val(0);
         $('#total_value').val(0);
         $('#tcp').val(0);
        }
      }); 

      $.ajax({
           type: "POST",
           url: baseurl+'multiproductcostingproduct/getLeadProductCosting',
           async: false,
           type: "POST",
           data: "lid="+val,
           dataType: "html",
           success: function(response)
           {
            $("select[id^='product_costing_id']").each(function(){
              var id = this.id;
              var res = id.substring(18);
              $('#product_costing_id'+res).empty().append(response);
              $('#product_costing_id'+res).selectpicker('refresh');
            });
               $('#locprod').val(response);
           }
       });
   }
}*/

function getStageValue(val,i)
{
   if(val!='')
   {
      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcostingproduct/getStageValue',
         async: false,
         type: "POST",
         data: "pcsid="+val,
         dataType: "html",
         success: function(response)
         {
            //var splval = response.split('|');
            $('#product_costing_stage_value'+i).val(response);
         }
      });      


      var cha_expense = $('#cha_expense').val();
      var commission_charge = $('#commission_charge').val();
      var bank_charge = $('#bank_charge').val();
      var freight_charge = $('#freight_charge').val();
      var crate = $('#conversion_rate').val();
      var tqty = 0;
      var totqty = 0;
      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var pcstageval = $('#product_costing_stage_value'+res).val();
         var qty = $('#quantity'+res).val();
         totqty = parseFloat(totqty)+parseFloat(qty);
        /* var tqtyi = parseFloat(pcstageval)*parseFloat(qty);
         tqty = parseFloat(tqtyi)+parseFloat(tqty);*/
         $('#totalquantity').val(totqty);
         $('#totalqty').html(totqty.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      });

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var tqty = $('#totalquantity').val();
         var qty = $('#quantity'+res).val();
         var chaqty = parseFloat(cha_expense)/parseFloat(totqty);
         $('#cha'+res).val(chaqty);
         $('#cha_format'+res).val(chaqty.toFixed('2'));
         var ccharge = parseFloat(commission_charge)/parseFloat(totqty);
         $('#ccharge'+res).val(ccharge);
         $('#ccharge_format'+res).val(ccharge.toFixed('2'));
         var fcharge = parseFloat(freight_charge)/parseFloat(totqty);
         $('#fcharge'+res).val(fcharge);
         $('#fcharge_format'+res).val(fcharge.toFixed('2'));

      });

var totalfobval=totalfobvalcur=totalcnfprice=totalprice=totalmargin=totalcha=totalcommission=totalfreight=totalcip=0

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var i = id.substring(8);
         //var scost = $('#single_cost'+i).val();
         var inputpcstageval = $('#input_product_costing_stage_value'+i).val();
         /*var purcost = parseFloat(scost)*parseFloat(inputpcstageval);
         $('#purchase_cost'+i).val(purcost);*/
         var pcstageval = $('#product_costing_stage_value'+i).val();
         var qty = $('#quantity'+i).val();
         var tqty = parseFloat(pcstageval)*parseFloat(qty);
         var pcost = $('#purchase_cost'+i).val();
         var mip = $('#margin_in_percent'+i).val();
         var mval = (parseFloat(pcost)*parseFloat(mip))/100;
         $('#margin_value'+i).val(mval);

         var pcostout = ((parseFloat(pcost)/parseFloat(inputpcstageval))*parseFloat(pcstageval));
         var mavalout = ((parseFloat(mval)/parseFloat(inputpcstageval))*parseFloat(pcstageval));

         var cha = $('#cha'+i).val();
         var comcharge = $('#ccharge'+i).val();
         var fobval = parseFloat(pcostout)+parseFloat(mavalout)+parseFloat(cha)+parseFloat(comcharge);
         $('#fob_value'+i).val(fobval);
         $('#fob_value_format'+i).val(fobval.toFixed('2'));
         var bcharge = (parseFloat(fobval)*parseFloat(bank_charge))/100;
         $('#bcharge'+i).val(bcharge);
         $('#bcharge_format'+i).val(bcharge.toFixed('2'));
         var totfobval = parseFloat(fobval)+parseFloat(bcharge);
         $('#total_fob_value'+i).val(totfobval);
         $('#total_fob_value_format'+i).val(totfobval.toFixed('2'));
         var fobincur = parseFloat(totfobval)/parseFloat(crate);
         $('#fob_value_in_currency'+i).val(fobincur);
         $('#fob_value_in_currency_format'+i).val(fobincur.toFixed('2'));
         var fcharge = $('#fcharge'+i).val();
         var cnfprice = parseFloat(fcharge)+parseFloat(fobincur);
         $('#cnf_price'+i).val(cnfprice);
         $('#cnf_price_format'+i).val(cnfprice.toFixed('2'));
         var totprice = parseFloat(cnfprice)*parseFloat(qty);
         $('#total_price'+i).val(totprice);
         $('#total_price_format'+i).val(totprice.toFixed('2'));
         var totmargin = parseFloat(mavalout)*parseFloat(qty);
         $('#total_margin'+i).val(totmargin);
         $('#total_margin_format'+i).val(totmargin.toFixed('2'));
         var totcha = parseFloat(cha)*parseFloat(qty);
         $('#total_cha'+i).val(totcha);
         $('#total_cha_format'+i).val(totcha.toFixed('2'));
         var totcom = parseFloat(comcharge)*parseFloat(qty);
         $('#total_commission'+i).val(totcom);
         $('#total_commission_format'+i).val(totcom.toFixed('2'));
         var totfreight = parseFloat(fcharge)*parseFloat(qty);
         $('#total_freight'+i).val(totfreight);
         $('#total_freight_format'+i).val(totfreight.toFixed('2'));
         var ikg = $('#in_kg'+i).val();
         var cip = (parseFloat(tqty)/parseFloat(ikg))*100;
         $('#container_in_percent'+i).val(cip);
         $('#container_in_percent_format'+i).val(cip.toFixed('2'));

         totalfobval = parseFloat(totalfobval)+parseFloat(totfobval);
         totalfobvalcur = parseFloat(totalfobvalcur)+parseFloat(fobincur);
         totalcnfprice = parseFloat(totalcnfprice)+parseFloat(cnfprice);
         totalprice = parseFloat(totalprice)+parseFloat(totprice);
         totalmargin = parseFloat(totalmargin)+parseFloat(totmargin);
         totalcha = parseFloat(totalcha)+parseFloat(totcha);
         totalcommission = parseFloat(totalcommission)+parseFloat(totcom);
         totalfreight = parseFloat(totalfreight)+parseFloat(totfreight);
         totalcip = parseFloat(totalcip)+parseFloat(cip);


      });

      $('#totalfobval').html(totalfobval.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalfobvalcur').html(totalfobvalcur.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalcnfprice').html(totalcnfprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalprice').html(totalprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalmargin').html(totalmargin.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcha').html(totalcha.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcommission').html(totalcommission.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalfreight').html(totalfreight.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcip').html(totalcip.toLocaleString("en-IN", { minimumFractionDigits: 2 }));


   }
}

function getInputStageValue(val,i)
{
   if(val!='')
   {
      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcostingproduct/getStageValue',
         async: false,
         type: "POST",
         data: "pcsid="+val,
         dataType: "html",
         success: function(response)
         {
            //var splval = response.split('|');
            $('#input_product_costing_stage_value'+i).val(response);
         }
      });      


      var cha_expense = $('#cha_expense').val();
      var commission_charge = $('#commission_charge').val();
      var bank_charge = $('#bank_charge').val();
      var freight_charge = $('#freight_charge').val();
      var crate = $('#conversion_rate').val();
      var tqty = 0;
      var totqty = 0;
      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var pcstageval = $('#product_costing_stage_value'+res).val();
         var qty = $('#quantity'+res).val();
         totqty = parseFloat(totqty)+parseFloat(qty);
         /*var tqtyi = parseFloat(pcstageval)*parseFloat(qty);
         tqty = parseFloat(tqtyi)+parseFloat(tqty);*/
         $('#totalquantity').val(totqty);
         $('#totalqty').html(totqty.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      });

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var tqty = $('#totalquantity').val();
         var qty = $('#quantity'+res).val();
         var chaqty = parseFloat(cha_expense)/parseFloat(totqty);
         $('#cha'+res).val(chaqty);
         $('#cha_format'+res).val(chaqty.toFixed('2'));
         var ccharge = parseFloat(commission_charge)/parseFloat(totqty);
         $('#ccharge'+res).val(ccharge);
         $('#ccharge_format'+res).val(ccharge.toFixed('2'));
         var fcharge = parseFloat(freight_charge)/parseFloat(totqty);
         $('#fcharge'+res).val(fcharge);
         $('#fcharge_format'+res).val(fcharge.toFixed('2'));

      });

var totalfobval=totalfobvalcur=totalcnfprice=totalprice=totalmargin=totalcha=totalcommission=totalfreight=totalcip=0

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var i = id.substring(8);
         //var scost = $('#single_cost'+i).val();
         var inputpcstageval = $('#input_product_costing_stage_value'+i).val();
         /*var purcost = parseFloat(scost)*parseFloat(inputpcstageval);
         $('#purchase_cost'+i).val(purcost);*/
         var pcstageval = $('#product_costing_stage_value'+i).val();
         var qty = $('#quantity'+i).val();
         var tqty = parseFloat(pcstageval)*parseFloat(qty);
         var pcost = $('#purchase_cost'+i).val();
         var mip = $('#margin_in_percent'+i).val();
         var mval = (parseFloat(pcost)*parseFloat(mip))/100;
         $('#margin_value'+i).val(mval);

         var pcostout = ((parseFloat(pcost)/parseFloat(inputpcstageval))*parseFloat(pcstageval));
         var mavalout = ((parseFloat(mval)/parseFloat(inputpcstageval))*parseFloat(pcstageval));

         var cha = $('#cha'+i).val();
         var comcharge = $('#ccharge'+i).val();
         var fobval = parseFloat(pcostout)+parseFloat(mavalout)+parseFloat(cha)+parseFloat(comcharge);
         $('#fob_value'+i).val(fobval);
         $('#fob_value_format'+i).val(fobval.toFixed('2'));
         var bcharge = (parseFloat(fobval)*parseFloat(bank_charge))/100;
         $('#bcharge'+i).val(bcharge);
         $('#bcharge_format'+i).val(bcharge.toFixed('2'));
         var totfobval = parseFloat(fobval)+parseFloat(bcharge);
         $('#total_fob_value'+i).val(totfobval);
         $('#total_fob_value_format'+i).val(totfobval.toFixed('2'));
         var fobincur = parseFloat(totfobval)/parseFloat(crate);
         $('#fob_value_in_currency'+i).val(fobincur);
         $('#fob_value_in_currency_format'+i).val(fobincur.toFixed('2'));
         var fcharge = $('#fcharge'+i).val();
         var cnfprice = parseFloat(fcharge)+parseFloat(fobincur);
         $('#cnf_price'+i).val(cnfprice);
         $('#cnf_price_format'+i).val(cnfprice.toFixed('2'));
         var totprice = parseFloat(cnfprice)*parseFloat(qty);
         $('#total_price'+i).val(totprice);
         $('#total_price_format'+i).val(totprice.toFixed('2'));
         var totmargin = parseFloat(mavalout)*parseFloat(qty);
         $('#total_margin'+i).val(totmargin);
         $('#total_margin_format'+i).val(totmargin.toFixed('2'));
         var totcha = parseFloat(cha)*parseFloat(qty);
         $('#total_cha'+i).val(totcha);
         $('#total_cha_format'+i).val(totcha.toFixed('2'));
         var totcom = parseFloat(comcharge)*parseFloat(qty);
         $('#total_commission'+i).val(totcom);
         $('#total_commission_format'+i).val(totcom.toFixed('2'));
         var totfreight = parseFloat(fcharge)*parseFloat(qty);
         $('#total_freight'+i).val(totfreight);
         $('#total_freight_format'+i).val(totfreight.toFixed('2'));
         var ikg = $('#in_kg'+i).val();
         var cip = (parseFloat(tqty)/parseFloat(ikg))*100;
         $('#container_in_percent'+i).val(cip);
         $('#container_in_percent_format'+i).val(cip.toFixed('2'));

         totalfobval = parseFloat(totalfobval)+parseFloat(totfobval);
         totalfobvalcur = parseFloat(totalfobvalcur)+parseFloat(fobincur);
         totalcnfprice = parseFloat(totalcnfprice)+parseFloat(cnfprice);
         totalprice = parseFloat(totalprice)+parseFloat(totprice);
         totalmargin = parseFloat(totalmargin)+parseFloat(totmargin);
         totalcha = parseFloat(totalcha)+parseFloat(totcha);
         totalcommission = parseFloat(totalcommission)+parseFloat(totcom);
         totalfreight = parseFloat(totalfreight)+parseFloat(totfreight);
         totalcip = parseFloat(totalcip)+parseFloat(cip);


      });

      $('#totalfobval').html(totalfobval.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalfobvalcur').html(totalfobvalcur.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalcnfprice').html(totalcnfprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalprice').html(totalprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalmargin').html(totalmargin.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcha').html(totalcha.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcommission').html(totalcommission.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalfreight').html(totalfreight.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcip').html(totalcip.toLocaleString("en-IN", { minimumFractionDigits: 2 }));


   }
}

function getProductItemInputs(val,i)
{
   if(val!='')
   {
      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcostingproduct/getProductItemInputs',
         async: false,
         type: "POST",
         data: "piid="+val,
         dataType: "html",
         success: function(response)
         {
            var splval = response.split('|');
            //$('#purchase_cost'+i).val(splval[0]);
            /*$('#single_cost'+i).val(splval[0]);
            $('#margin_in_percent'+i).val(splval[1]);*/
            $('#in_kg'+i).val(splval[0]);
            $('#product_costing_stage_id'+i).empty().append(splval[1]);
            $('#product_costing_stage_id'+i).selectpicker('refresh');
            $('#input_product_costing_stage_id'+i).empty().append(splval[1]);
            $('#input_product_costing_stage_id'+i).selectpicker('refresh');
            $('#product_item_display_name_id'+i).empty().append(splval[2]);
            $('#product_item_display_name_id'+i).selectpicker('refresh');
         }
      });


      /*var cha_expense = $('#cha_expense').val();
      var commission_charge = $('#commission_charge').val();
      var bank_charge = $('#bank_charge').val();
      var freight_charge = $('#freight_charge').val();
      var crate = $('#conversion_rate').val();
      var tqty = 0;
      var totqty = 0;
      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var pcstageval = $('#product_costing_stage_value'+res).val();
         var qty = $('#quantity'+res).val();
         totqty = parseFloat(totqty)+parseFloat(qty);
         var tqtyi = parseFloat(pcstageval)*parseFloat(qty);
         tqty = parseFloat(tqtyi)+parseFloat(tqty);
         $('#totalquantity').val(tqty);
         $('#totalqty').html(tqty);
      });

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var tqty = $('#totalquantity').val();
         var qty = $('#quantity'+res).val();
         var chaqty = parseFloat(cha_expense)/parseFloat(totqty);
         $('#cha'+res).val(chaqty);
         var ccharge = parseFloat(commission_charge)/parseFloat(totqty);
         $('#ccharge'+res).val(ccharge);
         var fcharge = parseFloat(freight_charge)/parseFloat(totqty);
         $('#fcharge'+res).val(fcharge);

      });

var totalfobval=totalfobvalcur=totalcnfprice=totalprice=totalmargin=totalcha=totalcommission=totalfreight=totalcip=0

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var i = id.substring(8);
         var scost = $('#single_cost'+i).val();
         var inputpcstageval = $('#input_product_costing_stage_value'+i).val();
         var purcost = parseFloat(scost)*parseFloat(inputpcstageval);
         $('#purchase_cost'+i).val(purcost);
         var pcstageval = $('#product_costing_stage_value'+i).val();
         var qty = $('#quantity'+i).val();
         var tqty = parseFloat(pcstageval)*parseFloat(qty);
         var pcost = $('#purchase_cost'+i).val();
         var mip = $('#margin_in_percent'+i).val();
         var mval = (parseFloat(pcost)*parseFloat(mip))/100;
         $('#margin_value'+i).val(mval);

         var pcostout = ((parseFloat(pcost)/parseFloat(inputpcstageval))*parseFloat(pcstageval));
         var mavalout = ((parseFloat(mval)/parseFloat(inputpcstageval))*parseFloat(pcstageval));

         var cha = $('#cha'+i).val();
         var comcharge = $('#ccharge'+i).val();
         var fobval = parseFloat(pcostout)+parseFloat(mavalout)+parseFloat(cha)+parseFloat(comcharge);
         $('#fob_value'+i).val(fobval);
         var bcharge = (parseFloat(fobval)*parseFloat(bank_charge))/100;
         $('#bcharge'+i).val(bcharge);
         var totfobval = parseFloat(fobval)+parseFloat(bcharge);
         $('#total_fob_value'+i).val(totfobval);
         var fobincur = parseFloat(totfobval)/parseFloat(crate);
         $('#fob_value_in_currency'+i).val(fobincur);
         var fcharge = $('#fcharge'+i).val();
         var cnfprice = parseFloat(fcharge)+parseFloat(fobincur);
         $('#cnf_price'+i).val(cnfprice);
         var totprice = parseFloat(cnfprice)*parseFloat(qty);
         $('#total_price'+i).val(totprice);
         var totmargin = parseFloat(mavalout)*parseFloat(qty);
         $('#total_margin'+i).val(totmargin);
         var totcha = parseFloat(cha)*parseFloat(qty);
         $('#total_cha'+i).val(totcha);
         var totcom = parseFloat(comcharge)*parseFloat(qty);
         $('#total_commission'+i).val(totcom);
         var totfreight = parseFloat(fcharge)*parseFloat(qty);
         $('#total_freight'+i).val(totfreight);
         var ikg = $('#in_kg'+i).val();
         var cip = (parseFloat(tqty)/parseFloat(ikg))*100;
         $('#container_in_percent'+i).val(cip);

         totalfobval = parseFloat(totalfobval)+parseFloat(totfobval);
         totalfobvalcur = parseFloat(totalfobvalcur)+parseFloat(fobincur);
         totalcnfprice = parseFloat(totalcnfprice)+parseFloat(cnfprice);
         totalprice = parseFloat(totalprice)+parseFloat(totprice);
         totalmargin = parseFloat(totalmargin)+parseFloat(totmargin);
         totalcha = parseFloat(totalcha)+parseFloat(totcha);
         totalcommission = parseFloat(totalcommission)+parseFloat(totcom);
         totalfreight = parseFloat(totalfreight)+parseFloat(totfreight);
         totalcip = parseFloat(totalcip)+parseFloat(cip);


      });

      $('#totalfobval').html(totalfobval.toFixed('2'));
      $('#totalfobvalcur').html(totalfobvalcur.toFixed('2'));
      $('#totalcnfprice').html(totalcnfprice.toFixed('2'));
      $('#totalprice').html(totalprice.toFixed('2'));
      $('#totalmargin').html(totalmargin.toFixed('2'));
      $('#totalcha').html(totalcha.toFixed('2'));
      $('#totalcommission').html(totalcommission.toFixed('2'));
      $('#totalfreight').html(totalfreight.toFixed('2'));
      $('#totalcip').html(totalcip.toFixed('2'));*/


      /*var pcost = $('#purchase_cost'+i).val();
      var mip = $('#margin_in_percent'+i).val();
      var mval = (parseFloat(pcost)*parseFloat(mip))/100;
      $('#margin_value'+i).val(mval);
      var sprice = parseFloat(mval)+parseFloat(pcost);
      $('#selling_price'+i).val(sprice);
      var qty = $('#quantity'+i).val();
      if(qty==''||qty ==0)
      {
         qty = 1;
         $('#quantity'+i).val(qty);
      }
      var totprice = parseFloat(sprice)*parseFloat(qty);
      $('#total_price'+i).val(totprice);
      var totmargin = parseFloat(qty)*parseFloat(mval);
      $('#total_margin'+i).val(totmargin);

      var ikg = $('#in_kg'+i).val();
      var cip = parseFloat(qty)/parseFloat(ikg);
      $('#container_in_percent'+i).val(cip.toFixed('2'));

      var ptot = 0;
      var tcp = 0;
      $("tr[id^='mid']").each(function(){
        var id = this.id;
        var res = id.substring(3);
        var tpprice = $('#total_price'+res).val();
        ptot = parseFloat(ptot)+parseFloat(tpprice);
        var ciper = $('#container_in_percent'+res).val();
        tcp = parseFloat(tcp) + parseFloat(ciper);
     });
      var cha = $('#cha_expense').val();
      var tpcha = parseFloat(ptot)+parseFloat(cha);
      var crate = $('#conversion_rate').val();
      if(crate=='' || crate ==0)
      {
         crate = 1;
         $('#conversion_rate').val(1);
      }
      var totval = parseFloat(tpcha)/parseFloat(crate);
      $('#total_value').val(totval.toFixed('2'));
      $('#tcp').val(tcp.toFixed('2'));*/

   }
}

function getCalculatedValue(i)
{       


      var cha_expense = $('#cha_expense').val();
      var commission_charge = $('#commission_charge').val();
      var bank_charge = $('#bank_charge').val();
      var freight_charge = $('#freight_charge').val();
      var crate = $('#conversion_rate').val();
      var tqty = 0;
      var totqty = 0;
      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var pcstageval = $('#product_costing_stage_value'+res).val();
         var qty = $('#quantity'+res).val();
         totqty = parseFloat(totqty)+parseFloat(qty);
         /*var tqtyi = parseFloat(pcstageval)*parseFloat(qty);
         tqty = parseFloat(tqtyi)+parseFloat(tqty);*/
         $('#totalquantity').val(totqty);
         $('#totalqty').html(totqty.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      });

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var tqty = $('#totalquantity').val();
         var qty = $('#quantity'+res).val();
         var chaqty = parseFloat(cha_expense)/parseFloat(totqty);
         $('#cha'+res).val(chaqty);
         $('#cha_format'+res).val(chaqty.toFixed('2'));
         var ccharge = parseFloat(commission_charge)/parseFloat(totqty);
         $('#ccharge'+res).val(ccharge);
         $('#ccharge_format'+res).val(ccharge.toFixed('2'));
         var fcharge = parseFloat(freight_charge)/parseFloat(totqty);
         $('#fcharge'+res).val(fcharge);
         $('#fcharge_format'+res).val(fcharge.toFixed('2'));

      });

var totalfobval=totalfobvalcur=totalcnfprice=totalprice=totalmargin=totalcha=totalcommission=totalfreight=totalcip=0

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var i = id.substring(8);
         //var scost = $('#single_cost'+i).val();
         var inputpcstageval = $('#input_product_costing_stage_value'+i).val();
         /*var purcost = parseFloat(scost)*parseFloat(inputpcstageval);
         $('#purchase_cost'+i).val(purcost);*/
         var pcstageval = $('#product_costing_stage_value'+i).val();
         var qty = $('#quantity'+i).val();
         var tqty = parseFloat(pcstageval)*parseFloat(qty);
         var pcost = $('#purchase_cost'+i).val();
         var mip = $('#margin_in_percent'+i).val();
         var mval = (parseFloat(pcost)*parseFloat(mip))/100;
         $('#margin_value'+i).val(mval);

         var pcostout = ((parseFloat(pcost)/parseFloat(inputpcstageval))*parseFloat(pcstageval));
         var mavalout = ((parseFloat(mval)/parseFloat(inputpcstageval))*parseFloat(pcstageval));

         var cha = $('#cha'+i).val();
         var comcharge = $('#ccharge'+i).val();
         var fobval = parseFloat(pcostout)+parseFloat(mavalout)+parseFloat(cha)+parseFloat(comcharge);
         $('#fob_value'+i).val(fobval);
         $('#fob_value_format'+i).val(fobval.toFixed('2'));
         var bcharge = (parseFloat(fobval)*parseFloat(bank_charge))/100;
         $('#bcharge'+i).val(bcharge);
         $('#bcharge_format'+i).val(bcharge.toFixed('2'));
         var totfobval = parseFloat(fobval)+parseFloat(bcharge);
         $('#total_fob_value'+i).val(totfobval);
         $('#total_fob_value_format'+i).val(totfobval.toFixed('2'));
         var fobincur = parseFloat(totfobval)/parseFloat(crate);
         $('#fob_value_in_currency'+i).val(fobincur);
         $('#fob_value_in_currency_format'+i).val(fobincur.toFixed('2'));
         var fcharge = $('#fcharge'+i).val();
         var cnfprice = parseFloat(fcharge)+parseFloat(fobincur);
         $('#cnf_price'+i).val(cnfprice);
         $('#cnf_price_format'+i).val(cnfprice.toFixed('2'));
         var totprice = parseFloat(cnfprice)*parseFloat(qty);
         $('#total_price'+i).val(totprice);
         $('#total_price_format'+i).val(totprice.toFixed('2'));
         var totmargin = parseFloat(mavalout)*parseFloat(qty);
         $('#total_margin'+i).val(totmargin);
         $('#total_margin_format'+i).val(totmargin.toFixed('2'));
         var totcha = parseFloat(cha)*parseFloat(qty);
         $('#total_cha'+i).val(totcha);
         $('#total_cha_format'+i).val(totcha.toFixed('2'));
         var totcom = parseFloat(comcharge)*parseFloat(qty);
         $('#total_commission'+i).val(totcom);
         $('#total_commission_format'+i).val(totcom.toFixed('2'));
         var totfreight = parseFloat(fcharge)*parseFloat(qty);
         $('#total_freight'+i).val(totfreight);
         $('#total_freight_format'+i).val(totfreight.toFixed('2'));
         var ikg = $('#in_kg'+i).val();
         var cip = (parseFloat(tqty)/parseFloat(ikg))*100;
         $('#container_in_percent'+i).val(cip);
         $('#container_in_percent_format'+i).val(cip.toFixed('2'));

         totalfobval = parseFloat(totalfobval)+parseFloat(totfobval);
         totalfobvalcur = parseFloat(totalfobvalcur)+parseFloat(fobincur);
         totalcnfprice = parseFloat(totalcnfprice)+parseFloat(cnfprice);
         totalprice = parseFloat(totalprice)+parseFloat(totprice);
         totalmargin = parseFloat(totalmargin)+parseFloat(totmargin);
         totalcha = parseFloat(totalcha)+parseFloat(totcha);
         totalcommission = parseFloat(totalcommission)+parseFloat(totcom);
         totalfreight = parseFloat(totalfreight)+parseFloat(totfreight);
         totalcip = parseFloat(totalcip)+parseFloat(cip);


      });

      $('#totalfobval').html(totalfobval.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalfobvalcur').html(totalfobvalcur.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalcnfprice').html(totalcnfprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalprice').html(totalprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalmargin').html(totalmargin.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcha').html(totalcha.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcommission').html(totalcommission.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalfreight').html(totalfreight.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcip').html(totalcip.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
}

function getTotalValue()
{      


      var cha_expense = $('#cha_expense').val();
      var commission_charge = $('#commission_charge').val();
      var bank_charge = $('#bank_charge').val();
      var freight_charge = $('#freight_charge').val();
      var crate = $('#conversion_rate').val();
      var tqty = 0;
      var totqty = 0;
      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var pcstageval = $('#product_costing_stage_value'+res).val();
         var qty = $('#quantity'+res).val();
         totqty = parseFloat(totqty)+parseFloat(qty);
         /*var tqtyi = parseFloat(pcstageval)*parseFloat(qty);
         tqty = parseFloat(tqtyi)+parseFloat(tqty);*/
         $('#totalquantity').val(totqty);
         $('#totalqty').html(totqty.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      });

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var tqty = $('#totalquantity').val();
         var qty = $('#quantity'+res).val();
         var chaqty = parseFloat(cha_expense)/parseFloat(totqty);
         $('#cha'+res).val(chaqty);
         $('#cha_format'+res).val(chaqty.toFixed('2'));
         var ccharge = parseFloat(commission_charge)/parseFloat(totqty);
         $('#ccharge'+res).val(ccharge);
         $('#ccharge_format'+res).val(ccharge.toFixed('2'));
         var fcharge = parseFloat(freight_charge)/parseFloat(totqty);
         $('#fcharge'+res).val(fcharge);
         $('#fcharge_format'+res).val(fcharge.toFixed('2'));

      });

var totalfobval=totalfobvalcur=totalcnfprice=totalprice=totalmargin=totalcha=totalcommission=totalfreight=totalcip=0

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var i = id.substring(8);
         //var scost = $('#single_cost'+i).val();
         var inputpcstageval = $('#input_product_costing_stage_value'+i).val();
         /*var purcost = parseFloat(scost)*parseFloat(inputpcstageval);
         $('#purchase_cost'+i).val(purcost);*/
         var pcstageval = $('#product_costing_stage_value'+i).val();
         var qty = $('#quantity'+i).val();
         var tqty = parseFloat(pcstageval)*parseFloat(qty);
         var pcost = $('#purchase_cost'+i).val();
         var mip = $('#margin_in_percent'+i).val();
         var mval = (parseFloat(pcost)*parseFloat(mip))/100;
         $('#margin_value'+i).val(mval);

         var pcostout = ((parseFloat(pcost)/parseFloat(inputpcstageval))*parseFloat(pcstageval));
         var mavalout = ((parseFloat(mval)/parseFloat(inputpcstageval))*parseFloat(pcstageval));

         var cha = $('#cha'+i).val();
         var comcharge = $('#ccharge'+i).val();
         var fobval = parseFloat(pcostout)+parseFloat(mavalout)+parseFloat(cha)+parseFloat(comcharge);
         $('#fob_value'+i).val(fobval);
         $('#fob_value_format'+i).val(fobval.toFixed('2'));
         var bcharge = (parseFloat(fobval)*parseFloat(bank_charge))/100;
         $('#bcharge'+i).val(bcharge);
         $('#bcharge_format'+i).val(bcharge.toFixed('2'));
         var totfobval = parseFloat(fobval)+parseFloat(bcharge);
         $('#total_fob_value'+i).val(totfobval);
         $('#total_fob_value_format'+i).val(totfobval.toFixed('2'));
         var fobincur = parseFloat(totfobval)/parseFloat(crate);
         $('#fob_value_in_currency'+i).val(fobincur);
         $('#fob_value_in_currency_format'+i).val(fobincur.toFixed('2'));
         var fcharge = $('#fcharge'+i).val();
         var cnfprice = parseFloat(fcharge)+parseFloat(fobincur);
         $('#cnf_price'+i).val(cnfprice);
         $('#cnf_price_format'+i).val(cnfprice.toFixed('2'));
         var totprice = parseFloat(cnfprice)*parseFloat(qty);
         $('#total_price'+i).val(totprice);
         $('#total_price_format'+i).val(totprice.toFixed('2'));
         var totmargin = parseFloat(mavalout)*parseFloat(qty);
         $('#total_margin'+i).val(totmargin);
         $('#total_margin_format'+i).val(totmargin.toFixed('2'));
         var totcha = parseFloat(cha)*parseFloat(qty);
         $('#total_cha'+i).val(totcha);
         $('#total_cha_format'+i).val(totcha.toFixed('2'));
         var totcom = parseFloat(comcharge)*parseFloat(qty);
         $('#total_commission'+i).val(totcom);
         $('#total_commission_format'+i).val(totcom.toFixed('2'));
         var totfreight = parseFloat(fcharge)*parseFloat(qty);
         $('#total_freight'+i).val(totfreight);
         $('#total_freight_format'+i).val(totfreight.toFixed('2'));
         var ikg = $('#in_kg'+i).val();
         var cip = (parseFloat(tqty)/parseFloat(ikg))*100;
         $('#container_in_percent'+i).val(cip);
         $('#container_in_percent_format'+i).val(cip.toFixed('2'));

         totalfobval = parseFloat(totalfobval)+parseFloat(totfobval);
         totalfobvalcur = parseFloat(totalfobvalcur)+parseFloat(fobincur);
         totalcnfprice = parseFloat(totalcnfprice)+parseFloat(cnfprice);
         totalprice = parseFloat(totalprice)+parseFloat(totprice);
         totalmargin = parseFloat(totalmargin)+parseFloat(totmargin);
         totalcha = parseFloat(totalcha)+parseFloat(totcha);
         totalcommission = parseFloat(totalcommission)+parseFloat(totcom);
         totalfreight = parseFloat(totalfreight)+parseFloat(totfreight);
         totalcip = parseFloat(totalcip)+parseFloat(cip);


      });

      $('#totalfobval').html(totalfobval.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalfobvalcur').html(totalfobvalcur.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalcnfprice').html(totalcnfprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalprice').html(totalprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalmargin').html(totalmargin.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcha').html(totalcha.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcommission').html(totalcommission.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalfreight').html(totalfreight.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcip').html(totalcip.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
}

function addMultiProductLine()
{
   var count=$('#mailcount').val();
   var cont = $("#mcontent10");
   var locprod = $('#locprod').val();

   cont.append('<tr id="mid'+count+'"><td><label></label><button type="button" class="btn btn-danger" onclick="remove_product_line('+count+')"><i class="fa fa-minus"></i></button></td><td><div style="width: 300px;"><select class="form-control m-bootstrap-select m_selectpicker pclist" id="product_item_id'+count+'" name="product_item_id[]" data-live-search="true" onchange="getProductItemInputs(this.value,'+count+');">'+locprod+'</select><input type="hidden" id="in_kg'+count+'" name="in_kg[]"><span id="product_item_id_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 200px;"><select class="form-control m-bootstrap-select m_selectpicker" id="product_item_display_name_id'+count+'" name="product_item_display_name_id[]" data-live-search="true"><option value="">Choose Display Name</option></select><span id="product_item_display_name_id_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 200px;"><select class="form-control m-bootstrap-select m_selectpicker" id="input_product_costing_stage_id'+count+'" name="input_product_costing_stage_id[]" data-live-search="true" onchange="getInputStageValue(this.value,'+count+');"><option value="">Choose SKU</option></select><input type="hidden" id="input_product_costing_stage_value'+count+'" name="input_product_costing_stage_value[]" value="1"><span id="input_product_costing_stage_id_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="purchase_cost'+count+'" name="purchase_cost[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getCalculatedValue('+count+');"><span id="purchase_cost_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="margin_in_percent'+count+'" name="margin_in_percent[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getCalculatedValue('+count+');"><span id="margin_in_percent_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="margin_value'+count+'" name="margin_value[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="margin_value_err'+count+'" class="text-danger"></span></div></td></td><td><div style="width: 100px;"><input type="text" class="form-control" id="quantity'+count+'" name="quantity[]" value="1" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getCalculatedValue('+count+');"><span id="quantity_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 200px;"><select class="form-control m-bootstrap-select m_selectpicker" id="product_costing_stage_id'+count+'" name="product_costing_stage_id[]" data-live-search="true" onchange="getStageValue(this.value,'+count+');"><option value="">Choose SKU</option></select><input type="hidden" id="product_costing_stage_value'+count+'" name="product_costing_stage_value[]" value="1"><span id="product_costing_stage_id_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="fob_value_in_currency_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="fob_value_in_currency'+count+'" name="fob_value_in_currency[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="fob_value_in_currency_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="fcharge_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="fcharge'+count+'" name="fcharge[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="fcharge_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="cnf_price_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="cnf_price'+count+'" name="cnf_price[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="cnf_price_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="cha_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="cha'+count+'" name="cha[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="cha_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="ccharge_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="ccharge'+count+'" name="ccharge[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="ccharge_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="fob_value_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="fob_value'+count+'" name="fob_value[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="fob_value_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="bcharge_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="bcharge'+count+'" name="bcharge[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="bcharge_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="total_fob_value_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="total_fob_value'+count+'" name="total_fob_value[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="total_fob_value_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="total_price_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="total_price'+count+'" name="total_price[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="total_price_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="total_margin_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="total_margin'+count+'" name="total_margin[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="total_margin_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="total_cha_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="total_cha'+count+'" name="total_cha[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="total_cha_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="total_commission_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="total_commission'+count+'" name="total_commission[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="total_commission_err'+count+'" class="text-danger"></span></div></td><td><div style="width: 100px;"><input type="text" class="form-control" id="total_freight_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="total_freight'+count+'" name="total_freight[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="total_freight_err'+count+'" class="text-danger"></span></div></td><td><input type="text" class="form-control" id="container_in_percent_format'+count+'" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><input type="hidden" class="form-control" id="container_in_percent'+count+'" name="container_in_percent[]" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly><span id="container_in_percent_err'+count+'" class="text-danger"></span></td></tr>');

   count=Number(count)+1;
   $('#mailcount').val(count);

            $('.m_selectpicker').selectpicker('refresh');
}

function remove_product_line(val)
{
   $('#mid'+val).remove();      


      var cha_expense = $('#cha_expense').val();
      var commission_charge = $('#commission_charge').val();
      var bank_charge = $('#bank_charge').val();
      var freight_charge = $('#freight_charge').val();
      var crate = $('#conversion_rate').val();
      var tqty = 0;
      var totqty = 0;
      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var pcstageval = $('#product_costing_stage_value'+res).val();
         var qty = $('#quantity'+res).val();
         totqty = parseFloat(totqty)+parseFloat(qty);
         /*var tqtyi = parseFloat(pcstageval)*parseFloat(qty);
         tqty = parseFloat(tqtyi)+parseFloat(tqty);*/
         $('#totalquantity').val(totqty);
         $('#totalqty').html(totqty.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      });

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var res = id.substring(8);
         var tqty = $('#totalquantity').val();
         var qty = $('#quantity'+res).val();
         var chaqty = parseFloat(cha_expense)/parseFloat(totqty);
         $('#cha'+res).val(chaqty);
         $('#cha_format'+res).val(chaqty.toFixed('2'));
         var ccharge = parseFloat(commission_charge)/parseFloat(totqty);
         $('#ccharge'+res).val(ccharge);
         $('#ccharge_format'+res).val(ccharge.toFixed('2'));
         var fcharge = parseFloat(freight_charge)/parseFloat(totqty);
         $('#fcharge'+res).val(fcharge);
         $('#fcharge_format'+res).val(fcharge.toFixed('2'));

      });

var totalfobval=totalfobvalcur=totalcnfprice=totalprice=totalmargin=totalcha=totalcommission=totalfreight=totalcip=0

      $("input[id^='quantity']").each(function(){
         var id = this.id;
         var i = id.substring(8);
         //var scost = $('#single_cost'+i).val();
         var inputpcstageval = $('#input_product_costing_stage_value'+i).val();
         /*var purcost = parseFloat(scost)*parseFloat(inputpcstageval);
         $('#purchase_cost'+i).val(purcost);*/
         var pcstageval = $('#product_costing_stage_value'+i).val();
         var qty = $('#quantity'+i).val();
         var tqty = parseFloat(pcstageval)*parseFloat(qty);
         var pcost = $('#purchase_cost'+i).val();
         var mip = $('#margin_in_percent'+i).val();
         var mval = (parseFloat(pcost)*parseFloat(mip))/100;
         $('#margin_value'+i).val(mval);

         var pcostout = ((parseFloat(pcost)/parseFloat(inputpcstageval))*parseFloat(pcstageval));
         var mavalout = ((parseFloat(mval)/parseFloat(inputpcstageval))*parseFloat(pcstageval));

         var cha = $('#cha'+i).val();
         var comcharge = $('#ccharge'+i).val();
         var fobval = parseFloat(pcostout)+parseFloat(mavalout)+parseFloat(cha)+parseFloat(comcharge);
         $('#fob_value'+i).val(fobval);
         $('#fob_value_format'+i).val(fobval.toFixed('2'));
         var bcharge = (parseFloat(fobval)*parseFloat(bank_charge))/100;
         $('#bcharge'+i).val(bcharge);
         $('#bcharge_format'+i).val(bcharge.toFixed('2'));
         var totfobval = parseFloat(fobval)+parseFloat(bcharge);
         $('#total_fob_value'+i).val(totfobval);
         $('#total_fob_value_format'+i).val(totfobval.toFixed('2'));
         var fobincur = parseFloat(totfobval)/parseFloat(crate);
         $('#fob_value_in_currency'+i).val(fobincur);
         $('#fob_value_in_currency_format'+i).val(fobincur.toFixed('2'));
         var fcharge = $('#fcharge'+i).val();
         var cnfprice = parseFloat(fcharge)+parseFloat(fobincur);
         $('#cnf_price'+i).val(cnfprice);
         $('#cnf_price_format'+i).val(cnfprice.toFixed('2'));
         var totprice = parseFloat(cnfprice)*parseFloat(qty);
         $('#total_price'+i).val(totprice);
         $('#total_price_format'+i).val(totprice.toFixed('2'));
         var totmargin = parseFloat(mavalout)*parseFloat(qty);
         $('#total_margin'+i).val(totmargin);
         $('#total_margin_format'+i).val(totmargin.toFixed('2'));
         var totcha = parseFloat(cha)*parseFloat(qty);
         $('#total_cha'+i).val(totcha);
         $('#total_cha_format'+i).val(totcha.toFixed('2'));
         var totcom = parseFloat(comcharge)*parseFloat(qty);
         $('#total_commission'+i).val(totcom);
         $('#total_commission_format'+i).val(totcom.toFixed('2'));
         var totfreight = parseFloat(fcharge)*parseFloat(qty);
         $('#total_freight'+i).val(totfreight);
         $('#total_freight_format'+i).val(totfreight.toFixed('2'));
         var ikg = $('#in_kg'+i).val();
         var cip = (parseFloat(tqty)/parseFloat(ikg))*100;
         $('#container_in_percent'+i).val(cip);
         $('#container_in_percent_format'+i).val(cip.toFixed('2'));

         totalfobval = parseFloat(totalfobval)+parseFloat(totfobval);
         totalfobvalcur = parseFloat(totalfobvalcur)+parseFloat(fobincur);
         totalcnfprice = parseFloat(totalcnfprice)+parseFloat(cnfprice);
         totalprice = parseFloat(totalprice)+parseFloat(totprice);
         totalmargin = parseFloat(totalmargin)+parseFloat(totmargin);
         totalcha = parseFloat(totalcha)+parseFloat(totcha);
         totalcommission = parseFloat(totalcommission)+parseFloat(totcom);
         totalfreight = parseFloat(totalfreight)+parseFloat(totfreight);
         totalcip = parseFloat(totalcip)+parseFloat(cip);


      });

      $('#totalfobval').html(totalfobval.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalfobvalcur').html(totalfobvalcur.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      //$('#totalcnfprice').html(totalcnfprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalprice').html(totalprice.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalmargin').html(totalmargin.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcha').html(totalcha.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcommission').html(totalcommission.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalfreight').html(totalfreight.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
      $('#totalcip').html(totalcip.toLocaleString("en-IN", { minimumFractionDigits: 2 }));
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

function multi_product_costing_product_validation()
{
   var err=0;
   var lid = $('#lead_id').val();
   var cid = $('#container_id').val();
   var curid = $('#currency_id').val();
   var crate = $('#conversion_rate').val();
   var tcip = $('#totalcip').html();

   if(lid=='')
   {
      $('#lead_id_err').html('Choose Lead!');
      err++;
   }
   else
   {
      $('#lead_id_err').html('');
   }
   if(cid=='')
   {
      $('#container_id_err').html('Choose Container!');
      err++;
   }
   else
   {
      $('#container_id_err').html('');
   }

   if(curid=='')
   {
      $('#currency_id_err').html('Currency is required!');
      err++;
   }
   else
   {
      $('#currency_id_err').html('');
   }

   if(crate=='' || crate<=0)
   {
      $('#conversion_rate_err').html('Conversion Rate is required!');
      err++;
   }
   else
   {
      $('#conversion_rate_err').html('');
   }

   $("tr[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);
      var pcid = $('#product_item_id'+res).val();
      var pcost = $('#purchase_cost'+res).val();
      var puid = $('#product_costing_stage_id'+res).val();
      var ipuid = $('#input_product_costing_stage_id'+res).val();

      if(res==0)
      {
         if(pcid=='')
         {
            $('#product_item_id_err'+res).html('Choose Product Item!');
            err++;
         }
         else
         {
            $('#product_item_id_err'+res).html('');
         }
         if(pcost=='' || pcost==0)
         {
            $('#purchase_cost_err'+res).html('Purchase Cost is required!');
            err++;
         }
         else
         {
            $('#purchase_cost_err'+res).html('');
         }
         if(puid=='')
         {
            $('#product_costing_stage_id_err'+res).html('Choose SKU!');
            err++;
         }
         else
         {
            $('#product_costing_stage_id_err'+res).html('');
         }
         if(ipuid=='')
         {
            $('#input_product_costing_stage_id_err'+res).html('Choose Input SKU!');
            err++;
         }
         else
         {
            $('#input_product_costing_stage_id_err'+res).html('');
         }
      }
      else
      {
         if(pcid!='' && (pcost=='' || pcost==0))
         {
            $('#purchase_cost_err'+res).html('Purchase Cost is required!');
            err++;
         }
         else
         {
            $('#purchase_cost_err'+res).html('');
         }
         if(pcid!='' && puid=='')
         {
            $('#product_costing_stage_id_err'+res).html('Choose SKU!');
            err++;
         }
         else
         {
            $('#product_costing_stage_id_err'+res).html('');
         }
         if(pcid!='' && ipuid=='')
         {
            $('#input_product_costing_stage_id_err'+res).html('Choose Input SKU!');
            err++;
         }
         else
         {
            $('#input_product_costing_stage_id_err'+res).html('');
         }
      }
   });

   /*if(tcip>100)
   {
      $('#tcip_err').html('Exceed Container Capacity!');
      err++;
   }
   else
   {
      $('#tcip_err').html('');
   }*/

   if(err>0){ return false; }else{ return true; }
}



</script>
</body>
   <!-- end::Body -->
</html>