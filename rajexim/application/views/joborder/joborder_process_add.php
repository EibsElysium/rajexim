<div class="modal-dialog modal-lg" role="document">
                  <?php $date_format =common_date_format();?>
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Add Job Order Process - <?php echo date($date_format, strtotime($pdate));?> - <?php echo $ptype;?></h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>joborder/create_joborder_process" onsubmit="return joborder_process_add_validation();">
                     <input type="hidden" id="job_order_id" name="job_order_id" value="<?php echo $joid;?>">
                     <input type="hidden" id="process_date" name="process_date" value="<?php echo $pdate;?>">
                     <input type="hidden" id="process_type" name="process_type" value="<?php echo $ptype;?>">
                     <div class="modal-body">

                        <fieldset>
                           <legend class="text-info"><b>Job Order Process Info</b></legend>
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Quantity<span class="text-danger">*</span></label>
                                    <input type="text" id="quantity_add" name="quantity" class="form-control m-input m-input--square" placeholder="Enter Quantity" onkeypress="return isNumber(event);">
                                    <span id="quantity_add_err" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Description<span class="text-danger">*</span></label>
                                    <textarea class="m-input form-control" id="description_add" name="description"></textarea>
                                    <span id="description_add_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                  </form>
               </div>
            </div>


<script>
$('.m_datepicker_2_modal').datepicker();
</script>       