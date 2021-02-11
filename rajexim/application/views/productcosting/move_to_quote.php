<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Move To Quote</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>productcosting/quote_create" onsubmit="return move_to_quote_validation();">
					<input type="hidden" id="product_costing_id" name="product_costing_id" value="<?php echo $pcid;?>">
					<input type="hidden" id="fobusdval" name="fobusdval" value="<?php echo $fobusdval;?>">
					<input type="hidden" id="fobarrval" name="fobarrval" value="<?php echo $fobval;?>">
					<input type="hidden" id="curval" name="curval" value="<?php echo $curval;?>">
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
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>Stage Type<span class="text-danger">*</span></label>
									<select class="form-control m-bootstrap-select m_selectpicker" id="stage_type" name="stage_type" data-live-search="true" onchange="changeStage(this.value);">
                                     <option value=''>Select Type</option>
                                     <option value="fob">FOB</option>
                                     <option value="cnf">CNF</option>
                                  </select>
                                  <span id="stage_type_err" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row" id="cnfstage" style="display:none">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>Stage<span class="text-danger">*</span></label>
									<select class="form-control m-bootstrap-select m_selectpicker" id="stage_id" name="stage_id" data-live-search="true">
                                     <?php echo $stage;?>
                                  </select>
                                  <span id="stage_id_err" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row" id="fobstage" style="display:none">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>Stage<span class="text-danger">*</span></label>
									<select class="form-control m-bootstrap-select m_selectpicker" id="fob_stage_id" name="fob_stage_id" data-live-search="true">
                                     <?php echo $fobstage;?>
                                  </select>
                                  <span id="fob_stage_id_err" class="text-danger"></span>
								</div>
							</div>
						</div>

						<input type="hidden" id="pcstagelist" name="pcstagelist" value='<?php echo $stage;?>'>
						
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

function changeStage(val)
{
	if(val!='')
	{
		if(val=='fob')
		{
			$('#fobstage').show();
			$('#cnfstage').hide();
			$('#stage_id').val('');
		}
		else
		{
			$('#cnfstage').show();
			$('#fobstage').hide();
			$('#fob_stage_id').val('');
		}
	}
	else
	{
		$('#cnfstage').hide();
		$('#fobstage').hide();
		$('#fob_stage_id').val('');
		$('#stage_id').val('');
	}
}

function move_to_quote_validation()
{
   var err=0;
   //var sid = $('#stage_id').val();
   var qtid = $('#quote_type').val();
   var stype = $('#stage_type').val();
   if(qtid=='')
   {
      $('#quote_type_err').html('Choose Quote Type!');
      err++;
   }
   else
   {
      $('#quote_type_err').html('');
   }
   if(stype=='')
   {
   		$('#stage_type_err').html('Choose Stage Type!');
   		err++;
   }
   else
   {
   		if(stype=='cnf')
   		{
   			var sid = $('#stage_id').val();
   			if(sid=='')
			{
				$('#stage_id_err').html('Choose Stage!');
				err++;
			}
			else
			{
				$('#stage_id_err').html('');
			}
   		}
   		else
   		{
   			var sid = $('#fob_stage_id').val();
   			if(sid=='')
			{
				$('#fob_stage_id_err').html('Choose Stage!');
				err++;
			}
			else
			{
				$('#fob_stage_id_err').html('');
			}
   		}
   		$('#stage_type_err').html('');
   }
   
   if(err>0){ return false; }else{ return true; }
}
</script>		