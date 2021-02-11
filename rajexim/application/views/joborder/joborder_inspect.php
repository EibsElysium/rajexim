<div class="modal-dialog modal-lg cust_modal" role="document">
   <div class="modal-content">
      <div class="modal-header">
        <?php //$joex = explode('/', $joborder_list->job_order_no);?>
         <h5 class="modal-title" id="exampleModalLabel">Inspect Job Order - <?php echo $joborder_list->job_order_no;?></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <?php $date_format =common_date_format();?>
      <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>joborder/update_joborder_inspect" onsubmit="return joborder_inspect_validation();">
         <div class="modal-body">
           <div class="row">
               <div class="col-lg-12">
                  <fieldset>
                     <legend class="text-info"><b>Job Order Info</b></legend>
                        <div class="row">
                           <div class="col-lg-6">
                              <label class="col-lg-5">JO Date</label>
                              <label class="col-lg-1">:</label>
                              <p class="col-lg-5"><?php echo date($date_format, strtotime($joborder_list->job_order_date));?></p>
                           </div>
                           <div class="col-lg-6">
                              <label class="col-lg-5">JO End Date</label>
                              <label class="col-lg-1">:</label>
                              <p class="col-lg-5"><?php echo date($date_format, strtotime($joborder_list->job_order_end_date));?></p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-6">
                              <label class="col-lg-5">SPO No</label>
                              <label class="col-lg-1">:</label>
                              <p class="col-lg-5"><?php echo $joborder_list->supplier_purchase_order_no;?></p>
                           </div>
                           <div class="col-lg-6">
                              <label class="col-lg-5">Assigned To</label>
                              <label class="col-lg-1">:</label>
                              <p class="col-lg-5"><?php echo $joborder_list->display_name;?></p>
                           </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-6">
                               <label class="col-lg-5">Buyer</label>
                               <label class="col-lg-1">:</label>
                               <p class="col-lg-5"><?php echo $joborder_list->lead_name;?></p>
                            </div>
                            <div class="col-lg-6">
                               <label class="col-lg-5">Vendor</label>
                               <label class="col-lg-1">:</label>
                               <p class="col-lg-5"><?php echo $joborder_list->vendor_name;?></p>
                            </div>
                         </div>
                         <!-- <fieldset>
                          <legend class="text-info"><b>Specification</b></legend>
                             <div class="row">
                                <div class="col-lg-12">
                                   <?php //echo $joborder_list->description;?>
                                </div>
                             </div>
                             
                       </fieldset> -->
                  </fieldset>
                  
               </div>
            </div>

            <?php if(count($joborder_items)>0){?>
               <fieldset>
                  <legend class="text-info"><b>Job Order Inspection History</b></legend>
                  <table class="table table-bordered m-table m-table--border-success m-table--head-bg-success">
                     <thead>
                        <tr>
                           <th>Inspection Date</th>
                           <th>Item</th>
                           <th>Specifications</th>
                           <th>Inspection Tools</th>
                           <th>Observation</th>
                           <th>Pass / Fail</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($joborder_items as $joitems){
                           if($joitems['pass_fail']==0)
                           {
                              $pf = '<span class="m-badge m-badge--danger m-badge--wide">Fail</span>';
                           }
                           else
                           {
                              $pf = '<span class="m-badge m-badge--success m-badge--wide">Pass</span>';
                           }
                           ?>
                           <tr>
                              <td><?php echo date($date_format, strtotime($joitems['job_order_item_date']));?></td>
                              <td><?php echo $joitems['items'];?></td>
                              <td><?php echo $joitems['specification'];?></td>
                              <td><?php echo $joitems['tools'];?></td>
                              <td><?php echo $joitems['observation'];?></td>
                              <td><?php echo $pf;?></td>
                           </tr>
                        <?php }?>
                     </tbody>
                  </table>
               </fieldset>
            <?php }?>

            <fieldset>
               <input type="hidden" id="job_order_id" name="job_order_id" value="<?php echo $joborder_list->job_order_id;?>">
               <legend class="text-info"><b>Inspect Item Info</b></legend>
               <div class="row">
                <div class="col-lg-6">
                  <div class="form-group m-form__group">
                     <label>Container No</label>
                     <input type="text" class="form-control m-input m-input--square" id="container_no" name="container_no" placeholder="Enter Container No" value="<?php echo $joborder_list->container_no;?>">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group m-form__group">
                     <label>Lorry No</label>
                     <input type="text" class="form-control m-input m-input--square" id="lorry_no" name="lorry_no" placeholder="Enter Lorry No" value="<?php echo $joborder_list->lorry_no;?>">
                  </div>
                </div>
               </div>
               <div id="mcontent10">
                  <div class="row" id="mid0">
                     <div class="col-lg-2">
                        <div class="form-group m-form__group">
                           <label>Item Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="items0" name="items[]" placeholder="Enter Item Name">
                           <span id="items_err0" class="text-danger"></span>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label>Specifications<span class="text-danger">*</span></label>
                           <textarea class="m-input form-control" id="specification0" name="specification[]"></textarea>
                           <span id="specification_err0" class="text-danger"></span>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label>Inspection Tools<span class="text-danger">*</span></label>
                           <textarea class="m-input form-control" id="tools0" name="tools[]"></textarea>
                           <span id="tools_err0" class="text-danger"></span>
                        </div>
                     </div>
                     <div class="col-lg-2">
                        <div class="form-group m-form__group">
                           <label>Observation<span class="text-danger">*</span></label>
                           <textarea class="m-input form-control" id="observation0" name="observation[]"></textarea>
                           <span id="observation_err0" class="text-danger"></span>
                        </div>
                     </div>
                     <div class="col-lg-1">
                        <div class="form-group m-form__group">
                           <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                           <input type="checkbox" class="menu_checkbox" id="pass_fail0" name="pass_fail[]" value="0" onchange="changePermission(this.id,this.value);"> Pass/Fail
                           <input type="hidden" class="menu_checkbox_hidden" id="pass_fail0hidden" name="pass_fail[]" value=0>
                           <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-1">
                        <div class="form-group m-form__group mt_25px pull-right">
                           <button type="button" class="btn btn-primary" onclick="add_inspect(0)">
                              <i class="fa fa-plus"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
               <input type="hidden" id="mailcount" name="mailcount" value="1">
            </fieldset>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </form>
   </div>
</div>