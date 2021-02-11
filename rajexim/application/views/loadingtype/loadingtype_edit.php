<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Loading Type</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>loadingtype/update_loadingtype" onsubmit="return loadingtype_edit_validation();">
					<input type="hidden" id="loading_type_id" name="loading_type_id" value="<?php echo $loadingtype_list->loading_type_id;?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>Loading Type<span class="text-danger">*</span></label>
									<input type="text" class="form-control m-input m-input--square" placeholder="Enter Loading Type" id="loading_type_edit" name="loading_type" onkeyup="checkLoadingtypeUniqueEdit(this.value);" value="<?php echo $loadingtype_list->loading_type;?>">
									<span id="loading_type_edit_err" class="text-danger"></span>
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