<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Multi Product Costing Type - P</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>multiproductcostingtypeproduct/update_multi_product_costing_type_product" onsubmit="return multi_product_costing_type_product_edit_validation();">
					<input type="hidden" id="multi_product_costing_type_product_id" name="multi_product_costing_type_product_id" value="<?php echo $multi_product_costing_type_product_list->multi_product_costing_type_product_id;?>">
					<div class="modal-body">
						
		                  <div class="row">

		                     <div class="col-lg-6">
		                        <div class="form-group m-form__group">
		                           <label>Multi Product Costing Type - P<span class="text-danger">*</span></label>
		                           <input type="text" class="form-control m-input m-input--square" id="multi_product_costing_type_product_edit_col" name="multi_product_costing_type_product" placeholder="Enter Multi Product Costing Type - P" onkeyup="checkContainerUniqueEdit(this.value);" value="<?php echo $multi_product_costing_type_product_list->multi_product_costing_type_product;?>">
		                           <span id="multi_product_costing_type_product_edit_err" class="text-danger"></span>
		                        </div>
		                     </div>

				               <div class="col-lg-6" id="maction_edit">
				                  <div class="form-group m-form__group">
				                     <label>Mathematic Action</label>
				                     <select class="form-control custom-select" id="math_action_edit" name="math_action" onchange="changemathtypeEdit(this.value);">
				                        <option value="">Select Mathematic Action</option>
				                        <option value="Addition(+)" <?php echo $multi_product_costing_type_product_list->math_action == 'Addition(+)'?'selected':'';?>>Addition ( + )</option>
				                        <option value="Subtraction(-)" <?php echo $multi_product_costing_type_product_list->math_action == 'Subtraction(-)'?'selected':'';?>>Subtraction ( - )</option>
				                        <option value="Multiplication(*)" <?php echo $multi_product_costing_type_product_list->math_action == 'Multiplication(*)'?'selected':'';?>>Multiplication ( * )</option>
				                        <option value="Division(/)" <?php echo $multi_product_costing_type_product_list->math_action == 'Division(/)'?'selected':'';?>>Division ( / )</option>
				                     </select>
				                     <span id="math_action_edit_err" class="text-danger"></span>
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