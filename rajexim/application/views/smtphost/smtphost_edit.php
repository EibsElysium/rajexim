<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit SMTP Host</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>smtphost/update_smtphost" onsubmit="return smtphost_edit_validation();">
					<input type="hidden" id="smtp_host_id" name="smtp_host_id" value="<?php echo $smtphost_list->smtp_host_id;?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>SMTP Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control m-input m-input--square" placeholder="Enter SMTP Name" id="smtp_name_edit" name="smtp_name" onkeyup="checkSmtphostUniqueEdit(this.value);" value="<?php echo $smtphost_list->smtp_name;?>">
									<span id="smtp_name_edit_err" class="form-control-feedback err_msg"></span>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>SMTP Host Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control m-input m-input--square" placeholder="Enter SMTP Host Name" id="smtp_host_name_edit" name="smtp_host_name" value="<?php echo $smtphost_list->smtp_host_name;?>">
									<span id="smtp_host_name_edit_err" class="form-control-feedback err_msg"></span>
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