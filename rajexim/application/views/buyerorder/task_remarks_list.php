<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Task Remarks</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php $date_format =common_date_format();?>
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

				<fieldset>
                     <legend class="text-info"><b>Task Remarks</b></legend>
                     <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme m_table_2">
                       <thead>
                          <tr>
                             <th>Date / User</th>
                             <th>Remarks</th>
                             <th>Status</th>

                          </tr>
                       </thead>
                       <tbody>
                        <?php foreach($botask_rem as $botlist){
                          if($botlist['status']==0)
                          {
                            $sts = 'Not Started';
                          }
                          elseif($botlist['status']==1)
                          {
                            $sts = 'In Progress';
                          }
                          else
                          {
                            $sts = 'Completed';
                          }
                          ?>
                        <tr>
                          <td>
                            <b><?php echo date('d-m-Y', strtotime($botlist['created_on']));?> / <?php echo $botlist['name'];?></b>
                          </td>
                          <td>
                            <?php echo $botlist['remarks'];?>
                          </td>
                          <td>
                            <?php echo $sts;?>
                          </td>
                        </tr>
                        <?php }?>
                       </tbody>
                    </table>
                   </fieldset> 
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</form>
	</div>
</div>

<script>
function task_remarks_validation(){
    var err = 0;
      var rem = $('#remarks').val();
      if(rem==''){
         $('#remarks_err').html('Enter Remarks!');
         err++;
      }else{
        $('#remarks_err').html('');
      }


  if(err>0||er>0){ return false; }else{ return true; }
}   
</script>