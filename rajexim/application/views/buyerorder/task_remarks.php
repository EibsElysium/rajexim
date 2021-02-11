<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Task Remarks</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php $date_format =common_date_format();?>
		<form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>buyerorder/update_task_remarks" onsubmit="return task_remarks_validation();">
			<input type="hidden" id="buyer_order_task_id" name="buyer_order_task_id" value="<?php echo $botask->buyer_order_task_id;?>">
			<input type="hidden" id="buyer_order_id" name="buyer_order_id" value="<?php echo $botask->buyer_order_id;?>">
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6">
						<label class="col-lg-4">Task Date</label>
						<label class="col-lg-1">:</label>
						<p class="col-lg-7"><?php echo ($botask->buyer_order_task_date) ? date('d-m-Y', strtotime($botask->buyer_order_task_date)) : '-';?></p>
					</div>
					<div class="col-lg-6">
						<label class="col-lg-4">Task End Date</label>
						<label class="col-lg-1">:</label>
						<p class="col-lg-7"><?php echo ($botask->buyer_order_task_end_date) ? date('d-m-Y', strtotime($botask->buyer_order_task_end_date)) : '-';?></p>
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
function buyer_ord_remarks_notification_message_generation()
{
	// var assigned_to = $('#assigned_to').val();
	var buyer_order_task_id = $('#buyer_order_task_id').val();
	var created_by = '<?php echo $_SESSION['admindata']['user_id']; ?>';
	var buyer_order_id = '<?php echo $buyer_oreder_id; ?>';
	$.ajax({
	    type: "POST",
	    url:baseurl+'Leads/generate_buyer_task_remarks_notification_content',
	    data:{'buyer_order_task_id':buyer_order_task_id,'created_by':created_by,'buyer_order_id':buyer_order_id},
	    async: false,
	    dataType: "html",
	    success: function(result){
	    	alert(result);
	       var res_array = result.split('~');
	       notification_content_remark = res_array[0];
	       receiver = res_array[1];
	    }
	});
}
function task_remarks_validation(){
	buyer_ord_remarks_notification_message_generation();
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
  	var connremark = new WebSocket('ws://localhost:8282');
    var client_remark = {
     user_id: <?php echo $_SESSION['admindata']['user_id']; ?>,
     recipient_id: null,
     type: 'socket',
     token: null,
     message: null
    };

    connremark.onopen = function (e) {
     connremark.send(JSON.stringify(client_remark));
     // $('#messages').append('<font color="green">Successfully connremarkected as user ' + client_remark.user_id + '</font><br>');
     console.log(client_remark.user_id);
    };

    connremark.onmessage = function (e) {
     var data = JSON.parse(e.data);
     if (data.message) {
         $('.noti_li').append(data.message);
         console.log(data.user_id + ' : ' + data.message);
     }
     if (data.type === 'token') {
         // $('#token').html('JWT Token : ' + data.token);
         console.log('JWT Token : ' + data.token);
     }
    };

    client_remark.message = notification_content_remark;
    client_remark.token = $('#token').text().split(': ')[1];
    client_remark.type = 'chat';
    if (receiver != '') {
     client_remark.recipient_id = parseInt(receiver);
    }
    connremark.send(JSON.stringify(client_remark));

  	return true; 
  }
}   
</script>