<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
				<h5><span style="color: white;">User Login History</span></h5><hr>

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
									<th>Total Number Of Login Time</th>
									<th>View</th>
									<!-- <th class="notexport" data-orderable="false">Action</th> -->
								</tr>
							</thead>
							<tbody>
								<?php foreach ($get_user_login_history as $log_his) { ?>
								<tr>
									<td><?php echo date('d-m-Y',strtotime($log_his->login_time)); ?></td>
									<td><?php echo $log_his->total_hours_per_day; ?></td>
									<td>
										<a href="javascript:;" onclick="user_per_day_login_history(<?php echo $log_his->user_id; ?>,'<?php echo date('Y-m-d',strtotime($log_his->login_time)); ?>')" data-toggle="m-tooltip" data-placement="top" title="User Login History"><span class="tooltip-animation"><i class="fa fa-history"></i></span></a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
					</table>
				</div>
			</div>

			
		</div>
	</div>
	
</div>
<script type="text/javascript">
function  user_per_day_login_history(user_id,date) {

	var baseurl = '<?php echo base_url(); ?>';
	$.ajax({
	    type: "POST",
	    url: baseurl+'Users/get_user_per_day_login_history',
	    data: "u_id="+user_id+"&date="+date,
	    success: function(response) {
	    	$('#user_per_day_login_history').empty().append(response);
	    	$('#user_per_day_login_history').modal('show');
	    }
    });
}

</script>