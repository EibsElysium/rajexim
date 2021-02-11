<div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>task/update_task" onsubmit="return task_edit_validation()">
         <input type="hidden" id="task_id" name="task_id" value="<?php echo $task_list->task_id;?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group m-form__group">
                     <div class="m-radio-inline">
                        <label class="m-radio m-radio--bold m-radio--success">
                        <input type="radio" name="task_type" <?php if($task_list->task_type == '0'){ ?> checked="" <?php } else { ?>  <?php } ?> value="0">Today
                        <span></span>
                        </label>
                        <label class="m-radio m-radio--bold m-radio--success">
                        <input type="radio" name="task_type" <?php if($task_list->task_type == '0'){ ?>  <?php } else { ?> checked="" <?php } ?> value="1">General
                        <span></span>
                        </label>
                     </div>
                     <input type="hidden" name="task_type_flag" id="task_type_flag_edit" value="<?php echo $task_list->task_type; ?>">
                     <span class="text-danger"></span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Task Title<span class="text-danger">*</span></label>
                     <input type="text" class="form-control m-input m-input--square" id="task_title_edit" name="task_title" placeholder="Enter Title" value="<?php echo $task_list->task_title;?>">
                     <span id="task_title_edit_err" class="text-danger"></span>
                  </div>
               </div>
            </div>
            <div class="row" id="snote2">
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Task Description<span class="text-danger">*</span><i class="fa fa-power-off show_snote2"></i></label>
                     <textarea class="form-control" id="task_description_edit" name="task_description"><?php echo $task_list->task_description;?></textarea>
                     <span id="task_description_edit_err" class="text-danger"></span>
                  </div>
               </div>
            </div>

            <div class="row" id="task_date_block_edit"  <?php if($task_list->task_type == '0'){ ?> style="display: none;" <?php } else { ?> style="display: block;" <?php } ?> >
               <div class="col-lg-6">
                  <label>Task Start Date<span class="text-danger">*</span></label>
                  <input type="text" id="e_alter_task_date" onblur="e_change_startdate_to_commondate();" name="e_alter_task_date" class="form-control m_datepicker_1" placeholder="Enter Task Start Date" value="<?php $qdate = explode('-', $task_list->task_date); echo $qdate[1].'/'.$qdate[2].'/'.$qdate[0];?>">
                  <input type="hidden" id="task_date_edit" name="task_date" value="<?php $qdate = explode('-', $task_list->task_date); echo $qdate[1].'/'.$qdate[2].'/'.$qdate[0];?>">
                  <span id="task_date_edit_err" class="text-danger"></span>
               </div>
               <div class="col-lg-6">
                  <label>Task End Date<span class="text-danger">*</span></label>
                  <input type="text" id="e_alter_task_end_date" name="e_alter_task_end_date" onblur="e_change_enddate_to_commondate();" class="form-control m_datepicker_1" placeholder="Enter Task Date" value="<?php $qdate = explode('-', $task_list->task_end_date); echo $qdate[1].'/'.$qdate[2].'/'.$qdate[0];?>">
                  <input type="hidden" id="task_end_date_edit" name="task_end_date" value="<?php $qdate = explode('-', $task_list->task_end_date); echo $qdate[1].'/'.$qdate[2].'/'.$qdate[0];?>">
                  <span id="task_end_date_edit_err" class="text-danger"></span>
               </div>
            </div>

            <div class="row">

               <div class="col-lg-6">
                  <div class="form-group m-form__group">
                     <label>Priority<span class="text-danger">*</span></label>
                     <select class="custom-select form-control" id="priority_edit" name="priority">
                        <option value="" <?php echo $task_list->priority==''?'selected':'';?>>Choose Priority</option>
                        <option value="Low" <?php echo $task_list->priority=='Low'?'selected':'';?>>Low</option>
                        <option value="Medium" <?php echo $task_list->priority=='Medium'?'selected':'';?>>Medium</option>
                        <option value="High" <?php echo $task_list->priority=='High'?'selected':'';?>>High</option>
                        <option value="Urgent" <?php echo $task_list->priority=='Urgent'?'selected':'';?>>Urgent</option>
                     </select>
                     <span id="priority_edit_err" class="text-danger"></span>
                  </div>
               </div>
               <?php 
                  $iparr = explode(',', $task_list->assigned_to);
               ?>
               <div class="col-lg-6">
                  <div class="form-group m-form__group">
                     <label>Assigned To<span class="text-danger">*</span></label>
                     <select class="form-control selectpicker" data-live-search="true" id="assigned_to_edit" name="assigned_to[]" multiple>
                        <!-- <option value="">Choose User</option> -->
                        <?php foreach($user_list as $ulist){?>
                        <option value="<?php echo $ulist['user_id'];?>" <?php echo in_array($ulist['user_id'], $iparr)?'selected':'';?>><?php echo $ulist['name'];?></option>
                        <?php }?>
                     </select>
                     <span id="assigned_to_edit_err" class="text-danger"></span>
                     <input type="hidden" id="old_assigned_to" name="old_assigned_to" value="<?php echo $task_list->assigned_to;?>">
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group m-form__group">
                     <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                        <input type="checkbox" class="menu_checkbox" id="is_schedule_edit" name="is_schedule" value="<?php echo $task_list->is_schedule; ?>" <?php echo $task_list->is_schedule==1?'checked':''; ?> onchange="changePermissionCheckEdit(this.id,this.value);"> is Schedule
                        <input type="hidden" class="menu_checkbox_hidden" id="is_schedule_edithidden" name="is_schedule" value=0 <?php echo $task_list->is_schedule==1?'disabled':''; ?>>
                        <span></span>
                     </label>
                  </div>
               </div>

               <div class="col-lg-6" id="stype_edit" style="<?php echo $task_list->is_schedule==1?'display:block':'display:none';?>">
                  <div class="form-group m-form__group">
                     <label>Schedule Type<span class="text-danger">*</span></label>
                     <select class="custom-select form-control" id="schedule_type_edit" name="schedule_type" onchange="getScheduleValueEdit(this.value);">
                        <option value="" <?php echo $task_list->schedule_type==''?'selected':'';?>>Choose Schedule Type</option>
                        <option value="Daily" <?php echo $task_list->schedule_type=='Daily'?'selected':'';?>>Daily</option>
                        <option value="Weekly" <?php echo $task_list->schedule_type=='Weekly'?'selected':'';?>>Weekly</option>
                        <option value="Monthly" <?php echo $task_list->schedule_type=='Monthly'?'selected':'';?>>Monthly</option>
                     </select>
                     <span id="schedule_type_edit_err" class="text-danger"></span>
                  </div>
               </div>
            </div>

            <?php 
                  $sweekarr = explode(',', $task_list->schedule_value);
               ?>

            <div class="row">
               <div class="col-lg-6" id="sweek_edit" style="<?php echo $task_list->schedule_type=='Weekly'?'display:block':'display:none';?>">
                  <div class="form-group m-form__group">
                     <label>Schedule<span class="text-danger">*</span></label>
                     <select class="form-control selectpicker" data-live-search="true" id="schedule_value_week_edit" name="schedule_value_week[]" multiple>
                        <!-- <option value="" <?php //echo $task_list->schedule_value==''?'selected':'';?>>Choose Day</option> -->
                        <option value="Sunday" <?php echo in_array('Sunday', $sweekarr)?'selected':'';?>>Sunday</option>
                        <option value="Monday" <?php echo in_array('Monday', $sweekarr)?'selected':'';?>>Monday</option>
                        <option value="Tuesday" <?php echo in_array('Tuesday', $sweekarr)?'selected':'';?>>Tuesday</option>
                        <option value="Wednesday" <?php echo in_array('Wednesday', $sweekarr)?'selected':'';?>>Wednesday</option>
                        <option value="Thursday" <?php echo in_array('Thursday', $sweekarr)?'selected':'';?>>Thursday</option>
                        <option value="Friday" <?php echo in_array('Friday', $sweekarr)?'selected':'';?>>Friday</option>
                        <option value="Saturday" <?php echo in_array('Saturday', $sweekarr)?'selected':'';?>>Saturday</option>
                     </select>
                     <span id="schedule_value_week_edit_err" class="text-danger"></span>
                  </div>
               </div>
               <div class="col-lg-6" id="smonth_edit" style="<?php echo $task_list->schedule_type=='Monthly'?'display:block':'display:none';?>">
                  <div class="form-group m-form__group">
                     <label>Schedule<span class="text-danger">*</span></label>
                     <select class="form-control selectpicker" data-live-search="true" id="schedule_value_month_edit" name="schedule_value_month[]" multiple>
                        <!-- <option value="" <?php //echo $task_list->schedule_value==''?'selected':'';?>>Choose Date</option> -->
                        <?php for($i=1;$i<=31;$i++){?>
                        <option value="<?php echo $i;?>" <?php echo in_array($i, $sweekarr)?'selected':'';?>><?php echo $i;?></option>
                        <?php }?>
                     </select>
                     <span id="schedule_value_month_edit_err" class="text-danger"></span>
                  </div>
               </div>
            </div>

         </div>
         <div class="modal-footer">
            <button type="submit" id="btnSubmit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </form>
   </div>
</div>

<script>
   $('#task_description_edit').summernote({
     lineHeights: ['0.2']
   });
   $("#snote2 i.show_snote2").click(function(){
     $('#snote2 .note-toolbar-wrapper').toggle();
     $('#snote2 .note-editable').toggleClass("mt");
    });
function e_change_startdate_to_commondate()
{
   var chosen_date = $('#e_alter_task_date').val();
   $('#task_date_edit').val(chosen_date);
   $.ajax({
     url:baseurl+'Leads/change_dtrange_val',
     type:'POST',
     data:{'value':chosen_date},
     dataType: 'html',
     success:function(result){
        $('#e_alter_task_date').val(result);
     }
   });
}
function e_change_enddate_to_commondate()
{
   var chosen_date = $('#e_alter_task_end_date').val();
   $('#task_end_date_edit').val(chosen_date);
   $.ajax({
     url:baseurl+'Leads/change_dtrange_val',
     type:'POST',
     data:{'value':chosen_date},
     dataType: 'html',
     success:function(result){
        $('#e_alter_task_end_date').val(result);
     }
   });
}
$("input[name$='task_type']").click(function() {
  var task_type_val = $(this).val();
  if (task_type_val == 0) {
   $('#task_date_block_edit').hide();
   $('#task_type_flag_edit').val(task_type_val);
   $('#task_date_edit').val('');
   $('#e_alter_task_date').val('');
   $('#e_alter_task_end_date').val('');
   $('#task_end_date_edit').val('');
  }
  else {
   $('#task_date_block_edit').show();
   $('#task_type_flag_edit').val(task_type_val);
  }

});
$('.m_datepicker_1').datepicker();
$('.selectpicker').selectpicker();
</script>