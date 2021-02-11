      <?php $baseUrl=base_url();?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	 <form name="followup_edit_form" id="followup_edit_form" action="<?php echo base_url();?>Leads/lead_followup_update" method="post" onsubmit="return follow_edit_validation();">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Followup</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-lg-12">
					<h5 class="text-theme">Next Followup Schedule</h5><hr>
				</div>		
			</div>

		<div class="row">
				<div class="col-lg-6">
					<div class="form-group m-form__group">
						<label>Date<span class="text-danger">*</span></label>
						<input type="text" class="form-control m-input m-input--square" onblur="change_date_by_dateformat();" placeholder="Enter Date" id="m_datepicker_1_modal" name="alter_followup_date">
						<input type="hidden" id="m_datepicker_1_modal_ori" placeholder="Enter Date" name="followup_date">
						<span id="followup_date_err" class="text-danger"></span>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group m-form__group">
						<label>Time<span class="text-danger">*</span></label>
						<input type="text" class="form-control m-input m-input--square" placeholder="Enter Time" id="m_timepicker_1_modal" name="followup_time">
						<span id="followup_time_err" class="text-danger"></span>
					</div>
				</div>
				
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="form-group m-form__group">
						<label>Details<span class="text-danger">*</span></label>
						<textarea class="form-control m-input"  rows="3" id="followup_purpose_next" name="followup_purpose_next" placeholder="Details"></textarea>
						<span id="followup_purpose_next_err" style="color: red;"></span>        
					</div>
				</div>
				
			</div>
		</div>
		<div class="modal-footer">

			<input type="hidden" id="l_assigned_to" name="assigned_to" value="<?php echo $lead_details->lead_assigned_to; ?>">

			<input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead_id; ?>">
			<button type="submit" id="edit_btnsubmit" class="btn btn-primary">Save Changes</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	    </form>

	 	<div class="modal-body">

			<?php if(count($followup_lists)>0){?>
			<div class="row mt_25px">
				<div class="col-lg-12">
					<h5 class="text-theme">Followup History</h5><hr>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered  table-checkable responsive no-wrap m_table_11" id="">
							<thead>
								<tr>
									<th>Date & Time</th>
									<th>Followed By</th>
									<th>Comments</th>
									<th>Status</th>
									<!-- <th class="notexport" data-orderable="false">Action</th> -->
								</tr>
							</thead>
							<tbody>
								<?php

									$date_format =common_date_format();
								 foreach($followup_lists as $lfs){
									?>
								<tr>
									<td><?php echo date($date_format, strtotime($lfs['followup_date']));?> &nbsp;&nbsp;&nbsp;
										<span> <?php echo $lfs['followup_time'];?></span></td>
									<td><?php echo $lfs['displayname'];?></td>
									<td><?php echo $lfs['comments'];?></td>
									<td>
										<?php if($lfs['comments']==''){?>
											<span class="btn-group">
											<span class="m-badge  m-badge--info m-badge--wide">Fresh</span>
											<span class="m-badge  m-badge--info m-badge--wide"><a href="javascript:;" data-toggle="modal" data-target="#follow_edit_status">
												<span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Fresh" onclick="lead_fp_edit_status('<?php echo $lfs['lead_followup_id']; ?>')"><i class="fa fa-comment-dots" style="color:#fff;"></i></span>
											</a></span>
											</span>
										<?php }else{if($lfs['comment_status']==0){?>
											<span class="m-badge  m-badge--success m-badge--wide">Positive</span>
										<?php }else{?>
											<span class="m-badge  m-badge--danger m-badge--wide">Negative</span>
										<?php }}?>
									</td>
									
								</tr>
								<?php }?>
							</tbody>
					</table>
				</div>
			</div>

			<?php }?>
		</div>
	</div>
	
</div>
<script type="text/javascript">
$('#m_timepicker_1_modal').timepicker();
$('#m_datepicker_1_modal').datepicker({format:'dd-mm-yyyy', todayHighlight:!0,orientation:"bottom left",templates:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'}});

var notification_content = '';
function lead_notification_message_generation()
{

  var assigned_to = $('#l_assigned_to').val();

  var lead_id = $('#lead_id').val();
  var created_by = '<?php echo $_SESSION['admindata']['user_id']; ?>';
  var followup_date = $('#m_datepicker_1_modal').val();
  var followup_time = $('#m_timepicker_1_modal').val();
  
  $.ajax({
      type: "POST",
      url:baseurl+'Leads/generate_followup_notification_content',
      data:{'assigned_to':assigned_to,'lead_id':lead_id,'followup_date':followup_date,'created_by':created_by,'followup_time':followup_time},
      async: false,
      dataType: "html",
      success: function(result){
         notification_content = result;
      }
   });
}
function change_date_by_dateformat()
{
	var date_picker_val = $('#m_datepicker_1_modal').val();
	$('#m_datepicker_1_modal_ori').val(date_picker_val);
	$.ajax({
	     url:baseurl+'Leads/change_dtrange_val',
	     type:'POST',
	     data:{'value':date_picker_val},
	     dataType: 'html',
	     success:function(result){
	        $('#m_datepicker_1_modal').val(result);
	     }
	  });
}
function follow_edit_validation()
 {
 	lead_notification_message_generation();
    var err = 0;    
    var comments = $('#followup_comments').val();
    var assigned_to = $('#l_assigned_to').val();	
    
    var followup_date = $('#m_datepicker_1_modal').val();
    var followup_time = $('#m_timepicker_1_modal').val();
    var purpose = $('#followup_purpose_next').val();


    
  if(followup_date.trim()==''){
       $('#followup_date_err').html('Date is required!');
       err++;
       }else{
         $('#followup_date_err').html('');
    }
   if(followup_time.trim()==''){
       $('#followup_time_err').html('Time is required!');
       err++;
       }else{
         $('#followup_time_err').html('');
    }
    if(purpose.trim()==''){
          $('#followup_purpose_next_err').html('Details is required!');
          err++;
       }else{
         $('#followup_purpose_next_err').html('');
    }

     if(err>0){ 
     	return false; 
     }else{ 
     	var conn = new WebSocket('ws://localhost:8282');
		var client = {
		  user_id: <?php echo $_SESSION['admindata']['user_id']; ?>,
		  recipient_id: null,
		  type: 'socket',
		  token: null,
		  message: null
		};

		conn.onopen = function (e) {
		  conn.send(JSON.stringify(client));
		  // $('#messages').append('<font color="green">Successfully connected as user ' + client.user_id + '</font><br>');
		  console.log(client.user_id);
		};

		conn.onmessage = function (e) {
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

		client.message = notification_content;
		client.token = $('#token').text().split(': ')[1];
		client.type = 'chat';
		if ($('#l_assigned_to').val() != '') {
		  client.recipient_id = $('#l_assigned_to').val();
		}
		conn.send(JSON.stringify(client));
     	return true; 
     }
 }

</script>