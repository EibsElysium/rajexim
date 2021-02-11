<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">SPO Complete</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<p>Are You Sure You Want to Complete this SPO?</p>
		</div>
		<div class="modal-footer">
			<button type="button" onclick="completeSPO(<?php echo $spoid;?>)" class="btn btn-primary">Yes</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		</div>
	</div>
</div>