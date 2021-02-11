<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Delete Vessel Flight</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<p>Are You Sure You Want to Delete this Vessel Flight Permanently?</p>
		</div>
		<div class="modal-footer">
			<button type="button" onclick="removeVesselFlight(<?php echo $eid;?>)" class="btn btn-primary">Yes</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		</div>
	</div>
</div>