<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Container</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>container/update_container" onsubmit="return container_edit_validation();">
					<input type="hidden" id="container_id" name="container_id" value="<?php echo $container_list->container_id;?>">
					<div class="modal-body">
						
		                  <div class="row">

		                     <div class="col-lg-4">
		                        <div class="form-group m-form__group">
		                           <label>Container<span class="text-danger">*</span></label>
		                           <input type="text" class="form-control m-input m-input--square" id="container_name_edit" name="container_name" placeholder="Enter Container" onkeyup="checkContainerUniqueEdit(this.value);" value="<?php echo $container_list->container_name;?>">
		                           <span id="container_name_edit_err" class="text-danger"></span>
		                        </div>
		                     </div>

		                     <div class="col-lg-4">
		                        <div class="form-group m-form__group">
		                           <label>Min CBM<span class="text-danger">*</span></label>
		                           <input type="text" class="form-control m-input m-input--square" id="min_cbm_edit" name="min_cbm" placeholder="Enter Min CBM" onkeypress="return isNumberKey(event,this);" value="<?php echo $container_list->min_cbm;?>">
		                           <span id="min_cbm_edit_err" class="text-danger"></span>
		                        </div>
		                     </div>

		                     <div class="col-lg-4">
		                        <div class="form-group m-form__group">
		                           <label>Max CBM<span class="text-danger">*</span></label>
		                           <input type="text" class="form-control m-input m-input--square" id="max_cbm_edit" name="max_cbm" placeholder="Enter Max CBM" onkeypress="return isNumberKey(event,this);" value="<?php echo $container_list->max_cbm;?>">
		                           <span id="max_cbm_edit_err" class="text-danger"></span>
		                        </div>
		                     </div>

		                  </div>
		                  <div class="row">

		                     <div class="col-lg-4">
		                        <div class="form-group m-form__group">
		                           <label>Max Ton<span class="text-danger">*</span></label>
		                           <input type="text" class="form-control m-input m-input--square" id="max_ton_edit" name="max_ton" placeholder="Enter Max Ton" onkeypress="return isNumberKey(event,this);" value="<?php echo $container_list->max_ton;?>">
		                           <span id="max_ton_edit_err" class="text-danger"></span>
		                        </div>
		                     </div>

		                     <div class="col-lg-4">
		                        <div class="form-group m-form__group">
		                           <label>Ton Variance</label>
		                           <input type="text" class="form-control m-input m-input--square" id="ton_variance_edit" name="ton_variance" placeholder="Enter Ton Variance" onkeypress="return isNumberKey(event,this);" value="<?php echo $container_list->ton_variance;?>">
		                           <span id="ton_variance_edit_err" class="text-danger"></span>
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