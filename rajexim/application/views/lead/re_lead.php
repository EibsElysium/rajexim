<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Reopen Lead</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- <p>Are You Sure You Want to Cancel this Lead Permanently?</p> -->
					<p>Hi <?php echo $log_user->name;?>,
					<p>Are You Sure You Want to Reopen the Lead (<b><?php echo $lead_list->lead_name;?></b>)?</p>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="reLead(<?php echo $bid;?>)" class="btn btn-primary">Yes</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>