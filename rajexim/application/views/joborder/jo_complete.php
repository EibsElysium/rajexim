<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">JO Complete</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<p>Are You Sure You Want to Complete this JO?</p>
		</div>
		<div class="modal-footer">
			<button type="button" onclick="completeJO(<?php echo $joid;?>)" class="btn btn-primary">Yes</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		</div>
	</div>
</div>