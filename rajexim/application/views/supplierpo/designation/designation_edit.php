<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Designation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>designation/update_designation" onsubmit="return designation_edit_validation();">
					<input type="hidden" id="designation_id" name="designation_id" value="<?php echo $designation_list->designation_id;?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>Designation<span class="text-danger">*</span></label>
									<input type="text" class="form-control m-input m-input--square" placeholder="Enter Designation" id="designation_edit1" name="designation" onkeyup="checkDesignationUniqueEdit(this.value);" value="<?php echo $designation_list->designation;?>">
									<span id="designation_edit_err" class="text-danger"></span>
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