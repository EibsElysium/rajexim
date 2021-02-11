<div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Edit Job Order - <?php echo $joborder_list->job_order_no;?></h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <?php $date_format =common_date_format();?>
                  <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>joborder/update_joborder" onsubmit="return joborder_edit_validation();">
                     <input type="hidden" id="job_order_id" name="job_order_id" value="<?php echo $joborder_list->job_order_id;?>">
                     <div class="modal-body">

                        <fieldset>
                           <legend class="text-info"><b>Job Order Info</b></legend>
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Job Order Date<span class="text-danger">*</span></label>
                                    <input type="text" id="job_order_date_edit" name="job_order_date" class="form-control m-input m-input--square" placeholder="Enter Job Order Date" value="<?php echo date($date_format, strtotime($joborder_list->job_order_date));?>" readonly>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Job Order End Date<span class="text-danger">*</span></label>
                                    <input type="text" id="job_order_end_date_edit" name="job_order_end_date" class="form-control m-input m_datepicker_2_modal m-input--square" placeholder="Enter Job Order End Date" value="<?php $vdate = explode('-', $joborder_list->job_order_end_date); echo $vdate[2].'/'.$vdate[1].'/'.$vdate[0];?>">
                                    <span id="job_order_end_date_edit_err" class="form-control-feedback err_msg"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Supplier PO No<span class="text-danger">*</span></label>
                                    <input type="text" id="supplier_purchase_order_id_edit" name="supplier_purchase_order_id" class="form-control m-input m-input--square" placeholder="Enter Job Order Date" value="<?php echo $joborder_list->supplier_purchase_order_no;?>" readonly>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Assigned To<span class="text-danger">*</span></label>
                                    <input type="text" id="employee_id_edit" name="employee_id" class="form-control m-input m-input--square" placeholder="Enter Job Order Date" value="<?php echo $joborder_list->display_name;?>" readonly>
                                 </div>
                              </div>
                              
                           </div>
                        </fieldset>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                  </form>
               </div>
            </div>


<script>
$('.m_datepicker_2_modal').datepicker();
</script>       