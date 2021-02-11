<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Move To Quote</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>multiproductcostingproduct/quote_create" onsubmit="return move_to_quote_validation();">
					<input type="hidden" id="multi_product_costing_product_id" name="multi_product_costing_product_id" value="<?php echo $pcid;?>">
					<input type="hidden" id="currency_id" name="currency_id" value="<?php echo $multi_product_costing_list->currency_id;?>">
					<input type="hidden" id="conversion_rate" name="conversion_rate" value="<?php echo $multi_product_costing_list->conversion_rate;?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>Quote Type<span class="text-danger">*</span></label>
									<select class="form-control m-bootstrap-select m_selectpicker" id="quote_type" name="quote_type" data-live-search="true">
                                     <option value=''>Select Quote Type</option>
                                     <option value="1">Domestic</option>
                                     <option value="0">International</option>
                                  </select>
                                  <span id="quote_type_err" class="text-danger"></span>
								</div>
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Move</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>

<script>
$('.m_selectpicker').selectpicker();

function move_to_quote_validation()
{
   var err=0;
   var qtid = $('#quote_type').val();
   if(qtid=='')
   {
      $('#quote_type_err').html('Choose Quote Type!');
      err++;
   }
   else
   {
      $('#quote_type_err').html('');
   }
   if(err>0){ return false; }else{ return true; }
}
</script>		