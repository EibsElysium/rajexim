<div class="modal-dialog modal-lg cust_modal" role="document">
       <div class="modal-content">
          <div class="modal-header">
            <?php //$joex = explode('/', $joborder_list->job_order_no);?>
             <h5 class="modal-title" id="exampleModalLabel">View Job Order - <?php echo $joborder_list->job_order_no;?></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <?php $date_format =common_date_format();?>
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
                   <!-- <fieldset>
                      <legend class="text-info">Stages History</legend>
                      <ul class="timeline">
                         <li>
                            <a class="date_time" tabindex="0">05-07-2019 10:00 AM</a>
                            <p class="">
                               <b><span class="m-badge m-badge--warning m-badge--wide">In Progress</span></b>
                            </p>
                         </li>
                         <li>
                            <a class="date_time" tabindex="0">05-07-2019 9:30 AM</a>
                            <p class="">
                               <b><span class="m-badge m-badge--info m-badge--wide">Packed</span></b>
                            </p>
                         </li>
                         <li>
                            <a class="date_time" tabindex="0">06-07-2019 4:35 PM</a>
                            <p class="">
                               <b><span class="m-badge m-badge--theme m-badge--wide">Verified</span></b>
                            </p>
                         </li>
                         <li>
                            <a class="date_time" tabindex="0">06-07-2019 10:00 AM</a>
                            <p class="">
                               <b><span class="m-badge m-badge--primary m-badge--wide">Loading</span></b>
                            </p>
                         </li>
                         <li>
                            <a class="date_time" tabindex="0">06-07-2019 10:00 AM</a>
                            <p class="">
                               <b><span class="m-badge m-badge--success m-badge--wide">Completed</span></b>
                            </p>
                         </li>
                      </ul>
                   </fieldset> -->
                </div>
             </div>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
       </div>
    </div>