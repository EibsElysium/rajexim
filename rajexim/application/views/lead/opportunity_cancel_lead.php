<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Archive Opportunity</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- <p>Are You Sure You Want to Cancel this Lead Permanently?</p> -->
					<p>Hi <?php echo $log_user->name;?>,
					<p>Are You Sure You Want to Archive the Opportunity (<b><?php echo $lead_list->lead_name;?></b>) Permanently?</p>
					<div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Reason<span class="text-danger">*</span></label>
                           <textarea class="form-control" id="drop_reason" name="drop_reason" placeholder="Enter Reason"></textarea>
                           <span id="drop_reason_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="cancelLead(<?php echo $bid;?>)" class="btn btn-primary">Yes</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>