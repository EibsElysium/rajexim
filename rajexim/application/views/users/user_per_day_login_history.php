<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
					<h5><span style="color: white;">User Per Day Login History</span></h5><hr>

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
	 	<div class="modal-body">
			

			<div class="row">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered  table-checkable responsive no-wrap m_table_11" id="">
							<thead>
								<tr>
									<th>Date</th>
									<th>Login Time</th>
									<th>Logout Time</th>
									<th>Logged Duration</th>
									<!-- <th class="notexport" data-orderable="false">Action</th> -->
								</tr>
							</thead>
							<tbody>
								<?php foreach ($get_user_per_day_login_history as $per_day_log_his) { ?>
								<tr>
									<td><?php echo date('d-m-Y',strtotime($per_day_log_his->login_time)); ?></td>
									<td><?php echo $per_day_log_his->login_time; ?></td>
									<td><?php echo $per_day_log_his->logout_time; ?></td>
									<td><?php echo $per_day_log_his->log_diff; ?></td>
									
								</tr>
								<?php } ?>
							</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>