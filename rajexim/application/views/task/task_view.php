<style>
.strike_out {
  text-decoration: line-through;
}
.chat-search-box {
    -webkit-border-radius: 3px 0 0 0;
    -moz-border-radius: 3px 0 0 0;
    border-radius: 3px 0 0 0;
    padding: .75rem 1rem;
}

.chat-search-box .input-group .form-control {
    -webkit-border-radius: 2px 0 0 2px;
    -moz-border-radius: 2px 0 0 2px;
    border-radius: 2px 0 0 2px;
    border-right: 0;
}

.chat-search-box .input-group .form-control:focus {
    border-right: 0;
}

.chat-search-box .input-group .input-group-btn .btn {
    -webkit-border-radius: 0 2px 2px 0;
    -moz-border-radius: 0 2px 2px 0;
    border-radius: 0 2px 2px 0;
    margin: 0;
}

.chat-search-box .input-group .input-group-btn .btn i {
    font-size: 1.2rem;
    line-height: 100%;
    vertical-align: middle;
}

@media (max-width: 767px) {
    .chat-search-box {
        display: none;
    }
}


/************************************************
  ************************************************
                  Users Container
  ************************************************
************************************************/

.users-container {
    position: relative;
    padding: 1rem 0;
    border-right: 1px solid #e6ecf3;
    height: 100%;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
}


/************************************************
  ************************************************
                      Users
  ************************************************
************************************************/

.users {
    padding: 0;
}

.users .person {
    position: relative;
    width: 100%;
    padding: 10px 1rem;
    cursor: pointer;
    border-bottom: 1px solid #f0f4f8;
}

.users .person:hover {
    background-color: #ffffff;
    /* Fallback Color */
    background-image: -webkit-gradient(linear, left top, left bottom, from(#e9eff5), to(#ffffff));
    /* Saf4+, Chrome */
    background-image: -webkit-linear-gradient(right, #e9eff5, #ffffff);
    /* Chrome 10+, Saf5.1+, iOS 5+ */
    background-image: -moz-linear-gradient(right, #e9eff5, #ffffff);
    /* FF3.6 */
    background-image: -ms-linear-gradient(right, #e9eff5, #ffffff);
    /* IE10 */
    background-image: -o-linear-gradient(right, #e9eff5, #ffffff);
    /* Opera 11.10+ */
    background-image: linear-gradient(right, #e9eff5, #ffffff);
}

.users .person.active-user {
    background-color: #ffffff;
    /* Fallback Color */
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f7f9fb), to(#ffffff));
    /* Saf4+, Chrome */
    background-image: -webkit-linear-gradient(right, #f7f9fb, #ffffff);
    /* Chrome 10+, Saf5.1+, iOS 5+ */
    background-image: -moz-linear-gradient(right, #f7f9fb, #ffffff);
    /* FF3.6 */
    background-image: -ms-linear-gradient(right, #f7f9fb, #ffffff);
    /* IE10 */
    background-image: -o-linear-gradient(right, #f7f9fb, #ffffff);
    /* Opera 11.10+ */
    background-image: linear-gradient(right, #f7f9fb, #ffffff);
}

.users .person:last-child {
    border-bottom: 0;
}

.users .person .user {
    display: inline-block;
    position: relative;
    margin-right: 10px;
}

.users .person .user img {
    width: 48px;
    height: 48px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}

.users .person .user .status {
    width: 10px;
    height: 10px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
    background: #e6ecf3;
    position: absolute;
    top: 0;
    right: 0;
}

.users .person .user .status.online {
    background: #9ec94a;
}

.users .person .user .status.offline {
    background: #c4d2e2;
}

.users .person .user .status.away {
    background: #f9be52;
}

.users .person .user .status.busy {
    background: #fd7274;
}

.users .person p.name-time {
    font-weight: 600;
    font-size: .85rem;
    display: inline-block;
}

.users .person p.name-time .time {
    font-weight: 400;
    font-size: .7rem;
    text-align: right;
    color: #8796af;
}

@media (max-width: 767px) {
    .users .person .user img {
        width: 30px;
        height: 30px;
    }
    .users .person p.name-time {
        display: none;
    }
    .users .person p.name-time .time {
        display: none;
    }
}


/************************************************
  ************************************************
                  Chat right side
  ************************************************
************************************************/

.selected-user {
    width: 100%;
    padding: 0 15px;
    min-height: 64px;
    line-height: 64px;
    border-bottom: 1px solid #e6ecf3;
    -webkit-border-radius: 0 3px 0 0;
    -moz-border-radius: 0 3px 0 0;
    border-radius: 0 3px 0 0;
}

.selected-user span {
    line-height: 100%;
}

.selected-user span.name {
    font-weight: 700;
}

.chat-container {
    position: relative;
    padding: 1rem;
    width: 100%;
}

.chat-container li.chat-left,
.chat-container li.chat-right {
    display: flex;
    flex: 1;
    flex-direction: row;
    margin-bottom: 40px;
}

.chat-container li img {
    width: 48px;
    height: 48px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
}

.chat-container li .chat-avatar {
    margin-right: 20px;
}

.chat-container li.chat-right {
    justify-content: flex-end;
}

.chat-container li.chat-right > .chat-avatar {
    margin-left: 20px;
    margin-right: 0;
}

.chat-container li .chat-name {
    font-size: .75rem;
    color: #999999;
    text-align: center;
}

.chat-container li .chat-text {
    padding: .4rem 1rem;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #ffffff;
    font-weight: 300;
    line-height: 150%;
    position: relative;
    max-width: 510px;
}

.chat-container li .chat-text:before {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    top: 10px;
    left: -20px;
    border: 10px solid;
    border-color: transparent #ffffff transparent transparent;
}

.chat-container li.chat-right > .chat-text {
    text-align: right;
    max-width: 510px;
}

.chat-container li.chat-right > .chat-text:before {
    right: -20px;
    border-color: transparent transparent transparent #ffffff;
    left: inherit;
}

.chat-container li .chat-hour {
    padding: 0;
    margin-bottom: 10px;
    font-size: .75rem;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin: 0 0 0 15px;
}

.chat-container li .chat-hour > span {
    font-size: 16px;
    color: #9ec94a;
}

.chat-container li.chat-right > .chat-hour {
    margin: 0 15px 0 0;
}

@media (max-width: 767px) {
    .chat-container li.chat-left,
    .chat-container li.chat-right {
        flex-direction: column;
        margin-bottom: 30px;
    }
    .chat-container li img {
        width: 32px;
        height: 32px;
    }
    .chat-container li.chat-left .chat-avatar {
        margin: 0 0 5px 0;
        display: flex;
        align-items: center;
    }
    .chat-container li.chat-left .chat-hour {
        justify-content: flex-end;
    }
    .chat-container li.chat-left .chat-name {
        margin-left: 5px;
    }
    .chat-container li.chat-right .chat-avatar {
        order: -1;
        margin: 0 0 5px 0;
        align-items: center;
        display: flex;
        justify-content: right;
        flex-direction: row-reverse;
    }
    .chat-container li.chat-right .chat-hour {
        justify-content: flex-start;
        order: 2;
    }
    .chat-container li.chat-right .chat-name {
        margin-right: 5px;
    }
    .chat-container li .chat-text {
        font-size: .8rem;
    }
}

.chat-form {
    padding: 15px;
    width: 100%;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ffffff;
    border-top: 1px solid white;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.card {
    border: 0;
    background: #f4f5fb;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    margin-bottom: 2rem;
    box-shadow: none;
}
ul#comments_block {
    max-height: 200px;
    overflow-y: scroll;
}
</style>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">View Task</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php $date_format =common_date_format();?>


      <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>task/create_task_comments" onsubmit="return task_comment_validation();">
  			<div class="modal-body">
          <fieldset>
            <legend class="text-info"><b>Task Details</b></legend>
    				<div class="row">
              <div class="col-lg-12">
                <label class="col-lg-3">Task Title</label>
                <label class="col-lg-1">:</label>
                <p class="col-lg-8"><?php echo $task_list->task_title;?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <label class="col-lg-3">Task Description</label>
                <label class="col-lg-1">:</label>
                <p class="col-lg-8"><?php echo $task_list->task_description;?></p>
              </div>
            </div>
            <div class="row">
    					<div class="col-lg-6">
    						<label class="col-lg-4">Task Date</label>
    						<label class="col-lg-1">:</label>
    						<p class="col-lg-7"><?php echo ($task_list->task_date) ? date('d-m-Y', strtotime($task_list->task_date)) : '-';?></p>
    					</div>
    					<div class="col-lg-6">
    						<label class="col-lg-4">Task End Date</label>
    						<label class="col-lg-1">:</label>
    						<p class="col-lg-7"><?php echo ($task_list->task_end_date) ? date('d-m-Y', strtotime($task_list->task_end_date)) : '-';?></p>
    					</div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label class="col-lg-4">Priority</label>
                <label class="col-lg-1">:</label>
                <p class="col-lg-7"><?php echo $task_list->priority;?></p>
              </div>
              <div class="col-lg-6">
                <label class="col-lg-4">Assigned To</label>
                <label class="col-lg-1">:</label>
                <p class="col-lg-7"><?php echo $task_list->name;?></p>
              </div>
    				</div>
            <div class="row">
              <div class="col-lg-6">
                <label class="col-lg-4">is Schedule</label>
                <label class="col-lg-1">:</label>
                <p class="col-lg-7"><?php echo $task_list->is_schedule==1?'Yes':'No';?></p>
              </div>
              <div class="col-lg-6" style="<?php echo $task_list->is_schedule==1?'display:block':'display:none';?>">
                <label class="col-lg-4">Schedule</label>
                <label class="col-lg-1">:</label>
                <p class="col-lg-7"><?php echo $task_list->schedule_type;?><?php if($task_list->schedule_type!='Daily'){echo ' - '.$task_list->schedule_value;}?></p>
              </div>
            </div>
          </fieldset>

          <?php if($task_list->task_type == 0){ ?>
            <fieldset>
              <legend class="text-info"><b>Daily Task Check List</b></legend>
              <div class="row">
                <div class="col-lg-12">
                  <label class="label">Task Lists</label>
                  <?php $get_task_lists = common_select_values('*','task_lists','task_id = "'.$task_list->task_id.'"','result');
                  // echo "<pre>";
                  // print_r($get_task_lists);
                  // die();
                  if(count($get_task_lists) > 0){ 
                    foreach ($get_task_lists as $key => $daily_tak) {
                  ?>
                    <div>
                      <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                         <input type="checkbox" <?php if($daily_tak->status == '1'){ ?> checked = "" <?php } ?> class="menu_checkbox" id="is_complete_<?php echo $key; ?>" value="0" onchange="check_to_complete_task('<?php echo $key; ?>','<?php echo $daily_tak->task_list_id; ?>');"> <p id="strike_text_<?php echo $key; ?>" <?php if($daily_tak->status == '1'){ ?> class="strike_out" <?php } ?> ><?php echo $daily_tak->task; ?></p>
                         <span></span>
                      </label>
                    </div>
                  <?php
                  }
                  }
                  ?>
                </div>
              </div>
            </fieldset>
          <?php } ?>

          <?php if (count($task_status_list)>0){?>
            <fieldset>
             <legend class="text-info"><b>Status</b></legend>
             <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme m_table_2">
               <thead>
                  <tr>
                     <th width="40%">Date / User</th>
                     <th>Status</th>

                  </tr>
               </thead>
               <tbody>
                <?php foreach($task_status_list as $botlist){
                  if($botlist['task_status']==0)                                             
                     $sts = '<span class="m-badge m-badge--grey m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Not Started">Not Started</span></span>';
                  elseif($botlist['task_status']==1)
                     $sts = '<span class="m-badge m-badge--blue m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="In Progress">In Progress</span></span>';
                  else
                     $sts = '<span class="m-badge m-badge--green m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Completed">Completed</span></span>';
                  ?>
                <tr>
                  <td>
                    <b><?php echo date('d-m-Y H:i:s', strtotime($botlist['created_on']));?> / <?php echo $botlist['name'];?></b>
                  </td>
                  <td>
                    <?php echo $sts;?>
                  </td>
                </tr>
                <?php }?>
               </tbody>
            </table>
           </fieldset> 
          <?php }?>

          <?php if (count($task_comments_list)>0){?>
    				<fieldset>
             <legend class="text-info"><b>Comments</b></legend>
             <!-- <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme m_table_2">
               <thead>
                  <tr>
                     <th width="40%">Date / User</th>
                     <th>Comments</th>

                  </tr>
               </thead>
               <tbody>
                <?php foreach($task_comments_list as $botlist){
                  ?>
                <tr>
                  <td>
                    <b><?php echo date('d-m-Y H:i:s', strtotime($botlist['created_on']));?> / <?php echo $botlist['name'];?></b>
                  </td>
                  <td>
                    <?php echo $botlist['comments'];?>
                  </td>
                </tr>
                <?php }?>
               </tbody>
            </table> -->
            <div class="row">
               <div class="col-md-9"></div>
               <div class="col-md-3">
                  
               </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <br>
                  <div class="row page-header">
                     <div class="col-md-3"> <h5 style="padding-left: 15px;padding-top: 13px;"><?php echo count($task_comments_list); ?> Comment<?php echo(count($task_comments_list) == 1) ? '' : 's' ?></h5> </div>
                     <div class="col-md-6"></div>
                     <div class="col-md-3">
                        <input type="text" id="search_in_comment" class="form-control" placeholder="Search in Comments" style="margin-bottom: 8px;width: 161px;">
                     </div>
                  </div> 
                  <div class="container">
                      <div class="content-wrapper">

                          <div class="row gutters">

                              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                  <div class="card m-0">

                                      <!-- Row start -->
                                      <div class="row no-gutters">
                                             
                                              <div class="chat-container">
                                                  <ul class="chat-box chatContainerScroll" id="comments_block">
                                                   <?php foreach($task_comments_list as $botlist){ 
                                                      if($_SESSION['admindata']['user_id'] != $botlist['created_by']) {
                                                      ?>
                                                      <li class="chat-left each_comments_blocks">
                                                          <div class="chat-avatar">
                                                              <img src="<?php echo base_url(); ?><?php echo ($botlist['profile_image'] == '') ? 'assets/images/default_image.jpg' : 'assets/user_profile/'.$botlist['profile_image']; ?>">
                                                              <div class="chat-name"><?php echo $botlist['name'];?></div>
                                                          </div>
                                                          <div class="chat-text"><?php echo $botlist['comments'];?></div>
                                                          <div class="chat-hour"><?php echo time_elapsed_string_in_helper($botlist['created_on']);?> <span class="fa fa-check-circle"></span></div>
                                                      </li>
                                                      <?php } else { ?>
                                                      <li class="chat-right each_comments_blocks">
                                                          <div class="chat-hour"><?php echo time_elapsed_string_in_helper($botlist['created_on']);?> <span class="fa fa-check-circle"></span></div>
                                                          <div class="chat-text"><?php echo $botlist['comments'];?></div>
                                                          <div class="chat-avatar">
                                                              <img src="<?php echo base_url(); ?><?php echo ($botlist['profile_image'] == '') ? 'assets/images/default_image.jpg' : 'assets/user_profile/'.$botlist['profile_image']; ?>">
                                                              <div class="chat-name"><?php echo $botlist['name'];?></div>
                                                          </div>
                                                      </li>
                                                   <?php } } ?>
                                                  </ul>
                                                  
                                              </div>
                                          
                                      </div>
                                      <!-- Row end -->
                                  </div>

                              </div>

                          </div>
                          <!-- Row end -->

                      </div>
                      <!-- Content wrapper end -->

                  </div>
                </div>
            </div>
           </fieldset> 
          <?php }?>
          <input type="hidden" id="task_id" name="task_id" value="<?php echo $task_list->task_id;?>">
          <fieldset>
             <legend class="text-info"><b>Add Comments</b></legend>

             <?php if($task_list->is_parent==0){?>

              <div class="row">
                <div class="col-lg-4">
                  <label>Status<span class="text-danger">*</span></label>
                  <select class="form-control custom-select" id="status" name="status"> 
                    <option value = '0' <?php echo $task_list->status==0?'selected':'';?>>Not Started</option>
                    <option value = '1' <?php echo $task_list->status==1?'selected':'';?>>In Progress</option>
                    <option value = '2' <?php echo $task_list->status==2?'selected':'';?>>Completed</option>
                  </select>
                  <span id="status_err" class="text-danger"></span>
                </div>
              </div>
            <?php }else{
              $userid = $_SESSION['admindata']['user_id'];
              $ptaskid = $task_list->task_id;
              $subtask = $this->db->query("SELECT * FROM task WHERE parent_task_id = $ptaskid AND assigned_to=$userid")->row();
              if(count($subtask)>0)
              {?>
                <div class="row">
                <div class="col-lg-4">
                  <label>Status<span class="text-danger">*</span></label>
                  <select class="form-control custom-select" id="status" name="status"> 
                    <option value = '0' <?php echo $subtask->status==0?'selected':'';?>>Not Started</option>
                    <option value = '1' <?php echo $subtask->status==1?'selected':'';?>>In Progress</option>
                    <option value = '2' <?php echo $subtask->status==2?'selected':'';?>>Completed</option>
                  </select>
                  <span id="status_err" class="text-danger"></span>
                </div>
              </div>
              <?php }
              else{?>

                <div class="row">
                  <div class="col-lg-4">
                    <label>Status<span class="text-danger">*</span></label>
                    <select class="form-control custom-select" id="status" name="status"> 
                      <option value = '0' <?php echo $task_list->status==0?'selected':'';?>>Not Started</option>
                      <option value = '1' <?php echo $task_list->status==1?'selected':'';?>>In Progress</option>
                      <option value = '2' <?php echo $task_list->status==2?'selected':'';?>>Completed</option>
                    </select>
                    <span id="status_err" class="text-danger"></span>
                  </div>
                </div>
              <?php }
            }?>

            <div class="row">
              <div class="col-lg-12">
                <label>Comments</label>
                <textarea rows="3" id="comments" name="comments" class="form-control m-input"></textarea>
                <span id="comments_err" class="text-danger"></span>
              </div>
            </div>
          </fieldset>

  			</div>
  			<div class="modal-footer">
          <button type="submit" id="add_wl_btn" class="btn btn-primary">Save Changes</button>
  				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  			</div>
  		</form>
	</div>
</div>
<script>
  $('.m_table_2').dataTable();
  var notification_content_comment = '';
  var receiver = '';
  function lead_notification_message_generation()
  {
    var task_id = $('#task_id').val();
    var created_by = '<?php echo $_SESSION['admindata']['user_id']; ?>';
    
    $.ajax({
        type: "POST",
        url:baseurl+'Leads/generate_task_comment_notification_content',
        data:{'task_id':task_id,'created_by':created_by},
        async: false,
        dataType: "html",
        success: function(result){
           var res_array = result.split('~');
           notification_content_comment = res_array[0];
           receiver = res_array[0];
        }
     });

  }
  function task_comment_validation()
  {
    lead_notification_message_generation();
    var comment = $('#comments').val();
    var status = $('#status').val();
    var err = 0;
    if (status == '') {
      $('#status_err').html('Status required!');
      err++;
    }
    else {
      $('#status_err').html('');
    }
    if (comment == '') {
      $('#comments_err').html('Comment required!');
      err++;
    }
    else {
      $('#comment_err').html('');
    }
    if (err == 0) {
       var conntaskc = new WebSocket('ws://localhost:8282');
       var client_task_c = {
         user_id: <?php echo $_SESSION['admindata']['user_id']; ?>,
         recipient_id: null,
         type: 'socket',
         token: null,
         message: null
       };

       conntaskc.onopen = function (e) {
         conntaskc.send(JSON.stringify(client_task_c));
         // $('#messages').append('<font color="green">Successfully connected as user ' + client_task_c.user_id + '</font><br>');
         console.log(client_task_c.user_id);
       };

       conntaskc.onmessage = function (e) {
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

       client_task_c.message = notification_content_comment;
       client_task_c.token = $('#token').text().split(': ')[1];
       client_task_c.type = 'chat';
       if (receiver != '') {
         client_task_c.recipient_id = parseInt(receiver);
       }
       conntaskc.send(JSON.stringify(client_task_c));
      return true;
    }
    else {
      return false;
    }
  }
  $("#search_in_comment").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#comments_block .each_comments_blocks").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  function check_to_complete_task(lid,task_list_id)
  {
    var is_complete = document.getElementById("is_complete_"+lid).checked;
    
    if (is_complete == true) {
      $.ajax({
        type: "POST",
        url:baseurl+'Task/task_list_completed',
        data:{'task_list_id':task_list_id},
        async: false,
        success: function(result){
           $('#strike_text_'+lid).addClass('strike_out');
        }
     });
    }
    else if(is_complete == false) {
      $.ajax({
        type: "POST",
        url:baseurl+'Task/task_list_uncomplete',
        data:{'task_list_id':task_list_id},
        async: false,
        success: function(result){
           $('#strike_text_'+lid).removeClass('strike_out');
        }
     }); 
    }
  }
</script>