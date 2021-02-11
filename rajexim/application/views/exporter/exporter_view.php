<div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">View Exporter</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">

         <div class="row">
            <div class="col-lg-9">
               <div class="row">
                  <div class="col-lg-12">
                     <label class="col-lg-4">Exporter</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->exporter_name; ?></p>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <label class="col-lg-4">Address</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->exporter_address; ?></p>
                  </div>
                  <div class="col-lg-12">
                     <label class="col-lg-4">Country</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->exporter_country; ?></p>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <label class="col-lg-4">Contact Name</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->contact_name; ?></p>
                  </div>
                  <div class="col-lg-12">
                     <label class="col-lg-4">Contact No</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->phone_no; ?></p>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <label class="col-lg-4">State Name</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->state_name; ?></p>
                  </div>
                  <div class="col-lg-12">
                     <label class="col-lg-4">State Code</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->state_code; ?></p>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <label class="col-lg-4">GST No</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->gst_no; ?></p>
                  </div>
                  <div class="col-lg-12">
                     <label class="col-lg-4">IEC No</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->iec_no; ?></p>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <label class="col-lg-4">VAT TIN No</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->vat_tin_no; ?></p>
                  </div>
                  <div class="col-lg-12">
                     <label class="col-lg-4">CST No</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->cst_no; ?></p>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <label class="col-lg-4">PAN No</label>
                     <label class="col-lg-1">:</label>
                     <p class="col-lg-7"><?php echo $exporter_list->pan_no; ?></p>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">

               <div class="row">
                  <div class="col-lg-12">
                     <label>Logo</label>
                     <p><img src="<?php echo base_url(); ?>exporterlogo/<?php echo str_replace(' ', '_',$exporter_list->exporter_logo); ?>" height="75p" width="100%" style="object-fit: contain;border: 1px solid #ccc;padding: 5px;"></p>
                  </div>
                  <div class="col-lg-12">
                     <label>Sign</label>
                     <p><img src="<?php echo base_url(); ?>exportersign/<?php echo str_replace(' ', '_',$exporter_list->exporter_sign_file); ?>" height="75p" width="100%" style="object-fit: contain;border: 1px solid #ccc;padding: 5px;"></p>
                  </div>
               </div>
            </div>
         </div>

      </div>
      
      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
   </div>
</div>