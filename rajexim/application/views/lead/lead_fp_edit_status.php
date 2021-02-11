<?php $date_format =common_date_format(); ?>
<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Followup</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST" action="<?php echo base_url(); ?>Leads/lead_followup_update_status" onsubmit="return lead_fups_validation();">
					<input type="hidden" id="lead_fups_id" name="lead_fups_id" value="<?php echo $lead_followups->lead_followup_id;?>">
					<input type="hidden" id="fp_lead_id" name="fp_lead_id" value="<?php echo $lead_followups->lead_id;?>">
					<div class="modal-body">

						<div class="row">
							<div class="col-lg-6 padl">
								<label class="col-lg-4">Date & Time</label>
								<label class="col-lg-1">:</label>

								<p class="col-lg-7"><?php echo date($date_format, strtotime($lead_followups->followup_date));?> <?php echo $lead_followups->followup_time;?></p>
							</div>
							<div class="col-lg-6 padl">
								<label class="col-lg-4">Details</label>
								<label class="col-lg-1">:</label>
								<p class="col-lg-7"><?php echo $lead_followups->purpose;?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<!-- <h5 class="text-theme">Previous Followup Status & Next Followup Schedule</h5><hr> -->
								<h5 class="text-theme">Follow Up Status</h5><hr>
							</div>		
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>Comments<span class="text-danger">*</span></label>
									<textarea class="form-control m-input" rows="3" id="comments_edit" name="comments"></textarea>
											<span id="comments_edit_err" class="text-danger"></span>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group m-form__group">
									<label>Status<span class="text-danger">*</span></label>
									<Select class="custom-select form-control" id="comment_status_edit" name="comment_status">
										<option value=0>Positive</option>
										<option value=1>Negative</option>
									</Select>
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Save Changes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>