<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Move To PI</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>quote/proformainvoice_add" onsubmit="return move_to_pi_validation();">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>Quote<span class="text-danger">*</span></label>
									<select class="form-control m-bootstrap-select m_selectpicker" id="quote_id" name="quote_id" data-live-search="true">
                                     <?php echo $quote_list;?>
                                  </select>
                                  <span id="quote_id_err" class="text-danger"></span>
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

function move_to_pi_validation()
{
   var err=0;
   var sid = $('#quote_id').val();
   if(sid=='')
   {
      $('#quote_id_err').html('Choose Quote!');
      err++;
   }
   else
   {
      $('#quote_id_err').html('');
   }
   if(err>0){ return false; }else{ return true; }
}
</script>		