<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Task Remarks</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php $date_format =common_date_format();?>
		<form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>leads/update_task_remarks" onsubmit="return task_remarks_validation();">
			<input type="hidden" id="lead_task_id" name="lead_task_id" value="<?php echo $botask->lead_task_id;?>">
			<input type="hidden" id="lead_id" name="lead_id" value="<?php echo $botask->lead_id;?>">
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6">
						<label class="col-lg-4">Task Date</label>
						<label class="col-lg-1">:</label>
						<p class="col-lg-7"><?php echo ($botask->lead_task_date) ? date('d-m-Y', strtotime($botask->lead_task_date)) : '-';?></p>
					</div>
					<div class="col-lg-6">
						<label class="col-lg-4">Task End Date</label>
						<label class="col-lg-1">:</label>
						<p class="col-lg-7"><?php echo ($botask->lead_task_end_date) ? date('d-m-Y', strtotime($botask->lead_task_end_date)) : '-';?></p>
					</div>
					<div class="col-lg-6">
						<label class="col-lg-4">Task</label>
						<label class="col-lg-1">:</label>
						<p class="col-lg-7"><?php echo $botask->task;?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<label>Remarks<span class="text-danger">*</span></label>
						<textarea rows="3" id="remarks" name="remarks" class="form-control m-input"></textarea>
						<span id="remarks_err" class="text-danger"></span>
					</div>
					<div class="col-lg-4">
						<label>Status<span class="text-danger">*</span></label>
						<select class="form-control custom-select" id="status" name="status"> 
							<option value = '0'>Not Started</option>
							<option value = '1'>In Progress</option>
							<option value = '2'>Completed</option>
						</select>
						<span id="status_err" class="text-danger"></span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="add_wl_btn" class="btn btn-primary">Save Changes</button>
			</div>
		</form>
	</div>
</div>

<script>
var notification_content_remark = '';
var receiver = '';

function task_remarks_validation(){
    var err = 0;
      var rem = $('#remarks').val();
      if(rem==''){
         $('#remarks_err').html('Enter Remarks!');
         err++;
      }else{
        $('#remarks_err').html('');
      }


  if(err>0){ 
  	return false; 
  }else{ 
  	
  	return true; 
  }
}   
</script>