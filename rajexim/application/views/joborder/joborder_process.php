<div class="modal-dialog modal-lg cust_modal" role="document">
   <div class="modal-content">
      <div class="modal-header">
        <?php //$joex = explode('/', $joborder_list->job_order_no);?>
         <h5 class="modal-title" id="exampleModalLabel">Job Order Process - <?php echo $joborder_list->job_order_no;?></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <?php $date_format =common_date_format();?>
      <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>joborder/create_joborder_process" onsubmit="return joborder_process_validation();">
         <div class="modal-body">
           <div class="row">
               <div class="col-lg-12">
                  <fieldset>
                     <legend class="text-info"><b>Job Order Info</b></legend>
                        <div class="row">
                           <div class="col-lg-6">
                              <label class="col-lg-5">JO Date</label>
                              <label class="col-lg-1">:</label>
                              <p class="col-lg-5"><?php echo date($date_format, strtotime($joborder_list->job_order_date));?></p>
                           </div>
                           <div class="col-lg-6">
                              <label class="col-lg-5">JO End Date</label>
                              <label class="col-lg-1">:</label>
                              <p class="col-lg-5"><?php echo date($date_format, strtotime($joborder_list->job_order_end_date));?></p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-6">
                              <label class="col-lg-5">SPO No</label>
                              <label class="col-lg-1">:</label>
                              <p class="col-lg-5"><?php echo $joborder_list->supplier_purchase_order_no;?></p>
                           </div>
                           <div class="col-lg-6">
                              <label class="col-lg-5">Assigned To</label>
                              <label class="col-lg-1">:</label>
                              <p class="col-lg-5"><?php echo $joborder_list->display_name;?></p>
                           </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-6">
                               <label class="col-lg-5">Buyer</label>
                               <label class="col-lg-1">:</label>
                               <p class="col-lg-5"><?php echo $joborder_list->lead_name;?></p>
                            </div>
                            <div class="col-lg-6">
                               <label class="col-lg-5">Vendor</label>
                               <label class="col-lg-1">:</label>
                               <p class="col-lg-5"><?php echo $joborder_list->vendor_name;?></p>
                            </div>
                         </div>
                         <!-- <fieldset>
                          <legend class="text-info"><b>Specification</b></legend>
                             <div class="row">
                                <div class="col-lg-12">
                                   <?php //echo $joborder_list->description;?>
                                </div>
                             </div>
                             
                       </fieldset> -->
                  </fieldset>
                  
               </div>
            </div>

            <?php //if(count($joborder_process)>0){
              $earlier = new DateTime($joborder_list->job_order_date);
              $cdate = date('Y-m-d');
              if($joborder_list->job_order_date>$cdate)
                $diff=-1;
              else
              {
              if($cdate<=$joborder_list->job_order_end_date)
                $edate = $cdate;
              else
                $edate = $joborder_list->job_order_end_date;
              $later = new DateTime($edate);

              $diff = $later->diff($earlier)->format("%a");
            }
              /*echo $joborder_list->job_order_date;
            echo $cdate;
            echo $diff;*/
              ?>
               <fieldset>
                  <legend class="text-info"><b>Job Order Process History</b></legend>
                  <table class="table table-bordered m-table m-table--border-success m-table--head-bg-success">
                     <thead>
                        <tr>
                           <th width="25%">Process Date</th>
                           <th width="25%">Morning</th>
                           <th width="25%">Afternoon</th>
                           <th width="25%">Evening</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php for($i=0;$i<=$diff;$i++){
                          $stop_date = date('Y-m-d', strtotime($joborder_list->job_order_date . ' +'.$i.' day'));
                          $jopro = $this->Joborder_model->get_job_order_process_by_id_date($joborder_list->job_order_id,$stop_date);
                          ?>                          
                        <tr>
                          <td><?php echo date($date_format, strtotime($stop_date));?></td>
                          <?php $mo=' - ';$af=' - ';$ev=' - ';if(count($jopro)==0)
                            {?>
                            <td><span class="pull-left"><?php echo $mo;?></span><?php if($mo!=' - '){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#edit_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit" onclick="joborder_process_edit('<?php echo $mjopid; ?>')"><i class="fa fa-pencil-alt"></i></span></a></span><?php }else{if($stop_date!=$cdate){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#add_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Create" onclick="joborder_process_add('<?php echo $joborder_list->job_order_id; ?>','<?php echo $stop_date;?>','Morning')"><i class="fa fa-plus"></i></span></a></span><?php }}?></td>

                            <td><span class="pull-left"><?php echo $af;?></span><?php if($af!=' - '){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#edit_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit" onclick="joborder_process_edit('<?php echo $ajopid; ?>')"><i class="fa fa-pencil-alt"></i></span></a></span><?php }else{if($stop_date!=$cdate){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#add_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Create" onclick="joborder_process_add('<?php echo $joborder_list->job_order_id; ?>','<?php echo $stop_date;?>','Afternoon')"><i class="fa fa-plus"></i></span></a></span><?php }}?></td>

                            <td><span class="pull-left"><?php echo $ev;?></span><?php if($ev!=' - '){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#edit_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit" onclick="joborder_process_edit('<?php echo $ejopid; ?>')"><i class="fa fa-pencil-alt"></i></span></a></span><?php }else{if($stop_date!=$cdate){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#add_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Create" onclick="joborder_process_add('<?php echo $joborder_list->job_order_id; ?>','<?php echo $stop_date;?>','Evening')"><i class="fa fa-plus"></i></span></a></span><?php }}?></td>
                           <?php }else{foreach($jopro as $jop){
                            if($jop['modified_by']==0)
                              {
                                $lfdate = $jop['created_on'];
                                $lfby = $jop['created_by'];
                              }
                              else
                              {
                                $lfdate = $jop['modified_on'];
                                $lfby = $jop['modified_by'];
                              }
                              $lfbydet = $this->Joborder_model->get_user_by_id($lfby);
                              $lfbyname = $lfbydet->name;

                            ?>
                           <?php if($jop['process_type']=='Morning'){
                              $mjopid = $jop['job_order_process_id'];

                              $title='Date : '.date('Y-m-d H:i:s', strtotime($lfdate)).'<br>User : '.$lfbyname;
                              //$desc = strlen($jop['description']) > 100 ? substr($jop['description'],0,100).'<span class="tooltip-animation" data-toggle="m-tooltip" data-html="true" data-placement="top" title="'.$jop['description'].'"> <br><b>Read More</b></span>' : $jop['description'];
                              $desc = strlen($jop['description']) > 100 ? substr($jop['description'],0,100).'<span><br><a href="javascript:;" data-toggle="modal" data-target="#view_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="More" onclick="joborder_process_view('.$mjopid.')"><b>Read More</b></span></a></span>' : $jop['description'];

                              //$mjopid = $jop['job_order_process_id'];
                              $mo = '<span class="tooltip-animation" data-toggle="m-tooltip" data-html="true" data-placement="top" title="'.$title.'"><b>Qty : </b>'.$jop['quantity'].'</span><br><b>Desc : </b>'.$desc;
                            }?>
                           <?php if($jop['process_type']=='Afternoon'){
                              $title='Date : '.date('Y-m-d H:i:s', strtotime($lfdate)).'<br>User : '.$lfbyname;
                              //$desc = strlen($jop['description']) > 100 ? substr($jop['description'],0,100).'<span class="tooltip-animation" data-toggle="m-tooltip" data-html="true" data-placement="top" title="'.$jop['description'].'"> <br><b>Read More</b></span>' : $jop['description'];

                              $ajopid = $jop['job_order_process_id'];

                              $desc = strlen($jop['description']) > 100 ? substr($jop['description'],0,100).'<span><br><a href="javascript:;" data-toggle="modal" data-target="#view_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="More" onclick="joborder_process_view('.$ajopid.')"><b>Read More</b></span></a></span>' : $jop['description'];

                              $af = '<span class="tooltip-animation" data-toggle="m-tooltip" data-html="true" data-placement="top" title="'.$title.'"><b>Qty : </b>'.$jop['quantity'].'</span><br><b>Desc : </b>'.$desc;
                           }?>
                           <?php if($jop['process_type']=='Evening'){
                              $title='Date : '.date('Y-m-d H:i:s', strtotime($lfdate)).'<br>User : '.$lfbyname;
                              //$desc = strlen($jop['description']) > 100 ? substr($jop['description'],0,100).'<span class="tooltip-animation" data-toggle="m-tooltip" data-html="true" data-placement="top" title="'.$jop['description'].'"> <br><b>Read More</b></span>' : $jop['description'];

                              $ejopid = $jop['job_order_process_id'];

                              $desc = strlen($jop['description']) > 100 ? substr($jop['description'],0,100).'<span><br><a href="javascript:;" data-toggle="modal" data-target="#view_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="More" onclick="joborder_process_view('.$ejopid.')"><b>Read More</b></span></a></span>' : $jop['description'];

                              $ev = '<span class="tooltip-animation" data-toggle="m-tooltip" data-html="true" data-placement="top" title="'.$title.'"><b>Qty : </b>'.$jop['quantity'].'</span><br><b>Desc : </b>'.$desc;
                           }?>
                           <?php }?>
                           <td><span class="pull-left"><?php echo $mo;?></span><?php if($mo!=' - '){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#edit_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit" onclick="joborder_process_edit('<?php echo $mjopid; ?>')"><i class="fa fa-pencil-alt"></i></span></a></span><?php }else{if($stop_date!=$cdate){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#add_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Create" onclick="joborder_process_add('<?php echo $joborder_list->job_order_id; ?>','<?php echo $stop_date;?>','Morning')"><i class="fa fa-plus"></i></span></a></span><?php }}?></td>

                            <td><span class="pull-left"><?php echo $af;?></span><?php if($af!=' - '){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#edit_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit" onclick="joborder_process_edit('<?php echo $ajopid; ?>')"><i class="fa fa-pencil-alt"></i></span></a></span><?php }else{if($stop_date!=$cdate){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#add_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Create" onclick="joborder_process_add('<?php echo $joborder_list->job_order_id; ?>','<?php echo $stop_date;?>','Afternoon')"><i class="fa fa-plus"></i></span></a></span><?php }}?></td>

                            <td><span class="pull-left"><?php echo $ev;?></span><?php if($ev!=' - '){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#edit_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit" onclick="joborder_process_edit('<?php echo $ejopid; ?>')"><i class="fa fa-pencil-alt"></i></span></a></span><?php }else{if($stop_date!=$cdate){?><span class="pull-right"><a href="javascript:;" data-toggle="modal" data-target="#add_joborder_process"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Create" onclick="joborder_process_add('<?php echo $joborder_list->job_order_id; ?>','<?php echo $stop_date;?>','Evening')"><i class="fa fa-plus"></i></span></a></span><?php }}?></td>
                        <?php }}?>
                     </tbody>
                  </table>
               </fieldset>
            <?php //}?>

            <?php $cdate = date('Y-m-d');
            if(($cdate>=$joborder_list->job_order_date) && ($cdate<=$joborder_list->job_order_end_date))
            {
              $joprocess = $this->Joborder_model->get_job_order_process_by_date_id($cdate,$joborder_list->job_order_id);
              $jopro = $this->Joborder_model->get_job_order_process_by_id_date($joborder_list->job_order_id,$cdate);
              if(count($jopro)<3){
              ?>
              <fieldset>
                 <input type="hidden" id="job_order_id" name="job_order_id" value="<?php echo $joborder_list->job_order_id;?>">
                 <legend class="text-info"><b>Process Info</b></legend>
                 <div id="mcontent10">
                    <div class="row">
                       <div class="col-lg-3">
                          <label>Process Date</label>
                          <p><?php echo $cdate;?></p>
                          <input type="hidden" id="process_date" name="process_date" value="<?php echo $cdate;?>">
                       </div>
                       <div class="col-lg-3">
                          <div class="form-group m-form__group">
                             <label>Type<span class="text-danger">*</span></label>
                             <select class="custom-select form-control" id="process_type" name="process_type">
                               <option value="">Choose Type</option>
                               <?php if(count($joprocess)==0){?>
                                <option value="Morning">Morning</option>
                                <option value="Afternoon">Afternoon</option>
                                <option value="Evening">Evening</option>
                                <?php }else{$tarray = explode(',', $joprocess->ptype);?>
                                <?php if(!in_array('Morning', $tarray)){?>
                                  <option value="Morning">Morning</option>
                                <?php }if(!in_array('Afternoon', $tarray)){?>
                                  <option value="Afternoon">Afternoon</option>
                                <?php }if(!in_array('Evening', $tarray)){?>
                                <option value="Evening">Evening</option>
                                <?php }}?>
                            </select>
                             <span id="process_type_err" class="text-danger"></span>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="form-group m-form__group">
                             <label>Quantity<span class="text-danger">*</span></label>
                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Quantity" name="quantity" id="quantity" onkeypress="return isNumber(event);">
                             <span id="quantity_err" class="text-danger"></span>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="form-group m-form__group">
                             <label>Description<span class="text-danger">*</span></label>
                             <textarea class="m-input form-control" id="description" name="description"></textarea>
                             <span id="description_err" class="text-danger"></span>
                          </div>
                       </div>
                    </div>
                 </div>
              </fieldset>
            <?php }}?>
         </div>
         <div class="modal-footer">
          <?php if($diff>=0){?>
            <button type="submit" class="btn btn-primary">Save</button>
            <?php }?>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </form>
   </div>
</div>




<script type="text/javascript">
$(function () {
  $('.tooltip-animation').tooltip()
})
</script>