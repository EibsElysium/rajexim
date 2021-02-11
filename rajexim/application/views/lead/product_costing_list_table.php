<div class="row">
   <div class="col-lg-12 pull-right">
      <?php if($_SESSION['Product CostingAdd']==1){ ?>
         <a href="<?php echo base_url(); ?>productcosting/product_costing_add/<?php echo $lead_view->lead_id; ?>" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
            <span>
               <i class="la la-plus"></i>
               <span>Create Single Costing</span>
            </span>
         </a>
      <?php }?>
      <?php if($_SESSION['Multi Product CostingAdd']==1){ ?>
         <a href="<?php echo base_url(); ?>multiproductcosting/multi_product_costing_add/<?php echo $lead_view->lead_id; ?>" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
            <span>
               <i class="la la-plus"></i>
               <span>Create Multi Costing - G</span>
            </span>
         </a>
      <?php }?>
      <?php if($_SESSION['Multi Product Costing - PAdd']==1){ ?>
         <a href="<?php echo base_url(); ?>multiproductcostingproduct/multi_product_costing_product_add/<?php echo $lead_view->lead_id; ?>" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
            <span>
               <i class="la la-plus"></i>
               <span>Create Multi Costing - P</span>
            </span>
         </a>
      <?php }?>
   </div>
</div>
<br>
<h3>Single Costing</h3><br>
<div class="row"> 
                                 <div class="col-lg-12">  
                                    <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
                                       <thead>
                                          <tr>
                                             <th>Product Costing No</th>
                                             <th>Lead</th>
                                             <th>Country</th>
                                             <th>Product</th>
                                             <th>Product Item</th>
                                             <th class="notexport" data-orderable="false">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php $i=0;foreach ($product_costing_list as $qlist){
                                             $pclist = $this->Productcosting_model->get_product_costing_by_id($qlist['pcid']);
                                             ?>
                                          <tr>
                                             <td>                                                
                                                <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['product_costing_no'];?> <?php if($qlist['pccount']>1){?><span class="m-badge m-badge--info pull-right tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $qlist['pccount']-1; ?> PC Revised"><?php echo $qlist['pccount']-1; ?></span><?php }?></h5>
                                                
                                             </td> 
                                             <td>
                                                <?php echo $pclist->lead_name;?> - <?php echo $pclist->email_id;?>
                                             </td>
                                             <td>
                                                <?php echo $pclist->country_name;?>
                                             </td>
                                             <td>
                                                <?php echo $pclist->product_name;?>
                                             </td>
                                             <td>
                                                <?php echo $pclist->product_item;?>
                                             </td>
                                             <td>
                                                <?php if($_SESSION['Product CostingView']==1){ ?>
                                                <a href="<?php echo base_url(); ?>productcosting/product_costing_view/<?php echo $pclist->product_costing_id;?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>
                                                <?php //if($_SESSION['Product CostingEdit']==1){ ?>
                                                <!-- <a href="<?php //echo base_url(); ?>productcosting/product_costing_edit/<?php //echo $pclist->product_costing_id;?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></span></a> -->
                                                <?php //}?>
                                                
                                             </td>
                                          </tr>
                                          <?php $i++;}?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>

<hr>
<h3>Multi Costing - P</h3><br>
<div class="row"> 
                                 <div class="col-lg-12">  
                                    <table class="table table-striped- table-bordered table-checkable m_table_2">
                                       <thead>
                                          <tr>
                                             <th>SNo</th>
                                             <th>Multi Product Costing No</th>
                                             <th>Lead</th>
                                             <th>Country</th>
                                             <th>CHA</th>
                                             <th>Commission Charge</th>
                                             <th>Freight</th>
                                             <th>Currency</th>
                                             <th>Conversion Rate</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php $i=0;foreach ($multi_product_costing_product_list as $qlist){
                                             $pclist = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_by_id($qlist['mpcpid']);

                                             $mpcplist = $this->Multiproductcostingproduct_model->get_multi_product_costing_product_by_parent_id($pclist->parent_costing_id);
                                             
                                             $isapp=0; foreach($mpcplist as $plist){
                                                if($plist['is_approve']==1)
                                                   $isapp=1;
                                             }

                                             if($isapp==1)
                                             {
                                                $rowcolor = '#e6ffe6';
                                             }
                                             else
                                             {
                                                $rowcolor = '';
                                             }
                                             ?>
                                          <tr bgcolor="<?php echo $rowcolor;?>">
                                             <td><?php echo $i+1;?></td>
                                             <td> 
                                                <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['multi_product_costing_prod_v2_no'];?> <?php if($qlist['mpcpcount']>1){?><span class="m-badge m-badge--info pull-right tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $qlist['mpcpcount']-1; ?> MPC - P Revised"><?php echo $qlist['mpcpcount']-1; ?></span><?php }?></h5>
                                                
                                             </td> 
                                             <td>
                                                <?php echo $pclist->lead_name;?> - <?php echo $pclist->email_id;?>
                                             </td>
                                             <td>
                                                <?php echo $pclist->country_name;?>
                                             </td>
                                             <td>
                                                <?php echo $pclist->cha_expense;?>
                                             </td>
                                             <td>
                                                <?php echo $pclist->commission_charge;?>
                                             </td>
                                             <td>
                                                <?php echo $pclist->freight_charge;?>
                                             </td>
                                             <td>
                                                <?php echo $pclist->currency_code.' - '.$pclist->currency_name;?>
                                             </td>
                                             <td>
                                                <?php echo $pclist->conversion_rate;?>
                                             </td>
                                             <td>
                                                <?php if($_SESSION['Multi Product Costing - PView']==1){ ?>
                                                <a href="<?php echo base_url(); ?>multiproductcostingproduct/multi_product_costing_product_view/<?php echo $pclist->multi_product_costing_prod_v2_id;?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>
                                                
                                             </td>
                                          </tr>
                                          <?php $i++;}?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>                              