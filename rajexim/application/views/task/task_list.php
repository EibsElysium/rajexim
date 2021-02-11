<?php $this->load->view('common_header'); $date_format =common_date_format();?>
<style>
.m-badge.m-badge--grey
{
   background-color:grey;
   color:#fff
}
.m-badge.m-badge--blue
{
   background-color:blue;
   color:#fff
}
.m-badge.m-badge--green
{
   background-color:green;
   color:#fff
}
</style>
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>task" class="m-nav__link">
                                 <span class="m-nav__link-text">Tasks</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
                  
                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Task List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['TasksAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_task">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Task</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php }?>

                              <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                 <a href="javascript:;" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                    Export
                                 </a>
                                 <div class="m-dropdown__wrapper" style="z-index: 101;">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36px;"></span>
                                    <div class="m-dropdown__inner">
                                       <div class="m-dropdown__body">
                                          <div class="m-dropdown__content">
                                             <ul class="m-nav">
                                                <!-- <li class="m-nav__section m-nav__section--first">
                                                   <span class="m-nav__section-text">Export Tools</span>
                                                </li> -->
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_print">
                                                      <i class="m-nav__link-icon la la-print"></i>
                                                      <span class="m-nav__link-text">Print</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_copy">
                                                      <i class="m-nav__link-icon la la-copy"></i>
                                                      <span class="m-nav__link-text">Copy</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_excel">
                                                      <i class="m-nav__link-icon la la-file-excel-o"></i>
                                                      <span class="m-nav__link-text">Excel</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_csv">
                                                      <i class="m-nav__link-icon la la-file-text-o"></i>
                                                      <span class="m-nav__link-text">CSV</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_pdf">
                                                      <i class="m-nav__link-icon la la-file-pdf-o"></i>
                                                      <span class="m-nav__link-text">PDF</span>
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <?php if($this->session->flashdata('qstage_success')) { ?>
                                 <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('qstage_success'); ?>
                                 </div>
                                 <?php } ?>

                              <?php if($this->session->flashdata('qstage_err')){?>
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('qstage_err'); ?>
                                 </div>
                                 <?php } ?>  
                              <!--begin: Datatable -->

                              <div class="row">
                                 <div class="col-lg-12">
                                    <ul class="nav nav-pills nav-pills--theme" role="tablist">
                                       <li class="nav-item">
                                          <a class="nav-link <?php echo $mtask;?>" data-toggle="tab" href="#my_task">My Task</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link <?php echo $asstask;?>" data-toggle="tab" href="#assigned_task">Assigned Task</a>
                                       </li>
                                       <?php if($_SESSION['TasksView All Task']==1){ ?>
                                       <li class="nav-item">
                                          <a class="nav-link <?php echo $alltask;?>" data-toggle="tab" href="#all_task">All Task</a>
                                       </li>
                                       <?php }?>
                                    </ul>
                                    <div class="tab-content">
                                       <div class="tab-pane <?php echo $mtask;?>" id="my_task" role="tabpanel">                                          
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <form method="POST" action="<?php echo base_url();?>task">
                                                   <input type="hidden" id="mytval" name="mytval" value="mytask">
                                                   <input type="hidden" id="asstval" name="asstval" value="">
                                                   <input type="hidden" id="alltval" name="alltval" value="">
                                                   <div class="row">
                                                      <div class="col-lg-2">
                                                         <label>Priority</label>
                                                         <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="my_priority" id="my_priority" onchange="this.form.submit();">
                                                            <option value="" <?php if($mpriority=='') echo "selected";?>>Choose Priority</option>
                                                            <option value="Low" <?php if($mpriority=='Low') echo "selected";?>>Low</option>
                                                            <option value="Medium" <?php if($mpriority=='Medium') echo "selected";?>>Medium</option>
                                                            <option value="High" <?php if($mpriority=='High') echo "selected";?>>High</option>
                                                            <option value="Urgent" <?php if($mpriority=='Urgent') echo "selected";?>>Urgent</option>
                                                         </select>
                                                      </div>      
                                                      <div class="col-lg-2">
                                                         <label>Status</label>
                                                         <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="my_status" id="my_status" onchange="this.form.submit();">
                                                            <option value="" <?php if($mstatus=='') echo "selected";?>>Choose Status</option>
                                                            <option value = '0' <?php echo $mstatus==0?'selected':'';?>>Not Started</option>
                                                            <option value = '1' <?php echo $mstatus==1?'selected':'';?>>In Progress</option>
                                                            <option value = '2' <?php echo $mstatus==2?'selected':'';?>>Completed</option>
                                                         </select>
                                                      </div>
                                                      
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Filter By</label>
                                                            <select class="custom-select form-control" id="mdsearch" name="mdsearch" onchange="if (this.value!='taskperiod') {this.form.submit();} else {showMyTaskFilterDate();}">
                                                               <option value="" <?php if($mdatesearch=='') echo "selected";?>>Select</option>
                                                               <option value="today" <?php if($mdatesearch=='today') echo "selected";?>>Today's Task</option>
                                                               <option value="duedate" <?php if($mdatesearch=='duedate') echo "selected";?>>Due Date Passed</option>
                                                               <option value="upcoming" <?php if($mdatesearch=='upcoming') echo "selected";?>>Upcoming Task</option>
                                                               <option value="taskperiod" <?php if($mdatesearch=='taskperiod') echo "selected";?>>Task Period</option>
                                                            </select>
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-2 drpmy" style="<?php echo $mdatesearch=='taskperiod'?'display:inline-block':'display:none';?>">
                                                         <div class="form-group m-form__group">
                                                            <label>Date</label>
                                                            <div class="m-input-icon pull-right" id='m_daterangepicker_3'>
                                                               <input class="form-control m-input m-input--square" id="m_daterangepicker_3" name="dtrange" placeholder="Choose Date" value="<?php echo $drnge;?>" type="text">
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2 drpmy" style="<?php echo $mdatesearch=='taskperiod'?'display:inline-block':'display:none';?>">
                                                         <div class="form-group m-form__group">
                                                            <label></label>
                                                            <input id="goButton" name="goButton" value="Go" class="btn btn-primary inp" style="margin-top:26px;" type="submit">
                                                         </div>
                                                      </div>
                                                   
                                                   </div>
                                                </form>
                                               
                                                <table class="table table-striped table-bordered  table-checkable m_table_2">
                                                   <thead>
                                                      <tr>
                                                         <th>Buyer Order</th>
                                                         <th>Task Title</th>
                                                         <th>Task Duration</th>
                                                         <th>Assigned To</th>
                                                         <th>Assigned By</th>
                                                         <th>Priority</th>
                                                         <th>Comments</th>
                                                         <th>Status</th>
                                                         <th class="notexport" data-orderable="false">Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php
                                                         if(!empty($my_task_list))
                                                         {
                                                            $i = 1;
                                                            foreach ($my_task_list as $e_list) 
                                                            { 
                                                               if($e_list['status']==0)                                             
                                                                  $sts = '<span class="m-badge m-badge--grey m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Not Started">Not Started</span></span>';
                                                               elseif($e_list['status']==1)
                                                                  $sts = '<span class="m-badge m-badge--blue m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="In Progress">In Progress</span></span>';
                                                               else
                                                                  $sts = '<span class="m-badge m-badge--green m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Completed">Completed</span></span>';

                                                               ?>
                                                               <tr>
                                                                  <td>
                                                                     <?php echo $e_list['buyer_order_no']==''?'-':$e_list['buyer_order_no']; ?>  
                                                                  </td>
                                                                  <td>
                                                                     
                                                                     <h5 class="text-black">
                                                                        <?php if($e_list['buyer_order_no'] != '' && $e_list['task_type'] == '0'){ ?>
                                                                           <i class="la la-list"></i> &nbsp;
                                                                        <?php }elseif($e_list['task_type'] == '0' && $e_list['buyer_order_no'] == ''){ ?>
                                                                           <i class="flaticon-calendar-with-a-clock-time-tools"></i> &nbsp;
                                                                        <?php }elseif($e_list['task_type'] == '1'){ ?>
                                                                           <i class="la la-calendar-check-o"></i> &nbsp;
                                                                        <?php } ?>
                                                                        <?php echo $e_list['task_title']; ?>
                                                                     </h5>   
                                                                  </td>
                                                                  <td>
                                                                     <?php echo date($date_format, strtotime($e_list['task_date'])); ?> - 
                                                                     <?php if($e_list['task_end_date']<date('Y-m-d') && $e_list['status']!=2){?>
                                                                        <font color="red">
                                                                           <?php echo date($date_format, strtotime($e_list['task_end_date'])); ?>
                                                                        </font>
                                                                     <?php }else{?>
                                                                        <?php echo date($date_format, strtotime($e_list['task_end_date'])); ?>
                                                                     <?php }?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['name']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['assignee']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['priority']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['comments']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $sts; ?>
                                                                  </td>
                                                                  <td>
                                                                        <?php if($_SESSION['TasksEdit']==1 && $e_list['status']!=2 && $e_list['buyer_order_no']==''){ ?>
                                                                        <a href="javascript:;" data-toggle="modal" data-target="#task_edit" onclick="return task_edit(<?php echo $e_list['task_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                                        <?php }?>
                                                                        <?php if($_SESSION['TasksView']==1 && $e_list['buyer_order_no']==''){ ?>                                              
                                                                           <a href="javascript:;" data-toggle="modal" data-target="#task_view" onclick="return task_view(<?php echo $e_list['task_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>
                                                                        <?php }?>
                                                                     
                                                                  </td>
                                                               </tr>
                                                               
                                                         <?php   $i++; }
                                                         } ?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>

                                       <div class="tab-pane <?php echo $asstask;?>" id="assigned_task" role="tabpanel">                                          
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <form method="POST" action="<?php echo base_url();?>task">
                                                   <input type="hidden" id="mytval" name="mytval" value="">
                                                   <input type="hidden" id="asstval" name="asstval" value="assignedtask">
                                                   <input type="hidden" id="alltval" name="alltval" value="">
                                                   <div class="row">
                                                      <div class="col-lg-2">
                                                         <label>Priority</label>
                                                         <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="ass_priority" id="ass_priority" onchange="this.form.submit();">
                                                            <option value="" <?php if($asspriority=='') echo "selected";?>>Choose Priority</option>
                                                            <option value="Low" <?php if($asspriority=='Low') echo "selected";?>>Low</option>
                                                            <option value="Medium" <?php if($asspriority=='Medium') echo "selected";?>>Medium</option>
                                                            <option value="High" <?php if($asspriority=='High') echo "selected";?>>High</option>
                                                            <option value="Urgent" <?php if($asspriority=='Urgent') echo "selected";?>>Urgent</option>
                                                         </select>
                                                      </div>      
                                                      <div class="col-lg-2">
                                                         <label>Status</label>
                                                         <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="ass_status" id="ass_status" onchange="this.form.submit();">
                                                            <option value="" <?php if($assstatus=='') echo "selected";?>>Choose Status</option>
                                                            <option value = '0' <?php echo $assstatus==0?'selected':'';?>>Not Started</option>
                                                            <option value = '1' <?php echo $assstatus==1?'selected':'';?>>In Progress</option>
                                                            <option value = '2' <?php echo $assstatus==2?'selected':'';?>>Completed</option>
                                                         </select>
                                                      </div>
                                                      
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Filter By</label>
                                                            <select class="custom-select form-control" id="assdsearch" name="assdsearch" onchange="if (this.value!='taskperiod') {this.form.submit();} else {showAssTaskFilterDate();}">
                                                               <option value="" <?php if($assdatesearch=='') echo "selected";?>>Select</option>
                                                               <option value="today" <?php if($assdatesearch=='today') echo "selected";?>>Today's Task</option>
                                                               <option value="duedate" <?php if($assdatesearch=='duedate') echo "selected";?>>Due Date Passed</option>
                                                               <option value="upcoming" <?php if($assdatesearch=='upcoming') echo "selected";?>>Upcoming Task</option>
                                                               <option value="taskperiod" <?php if($assdatesearch=='taskperiod') echo "selected";?>>Task Period</option>
                                                            </select>
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-2 drpass" style="<?php echo $assdatesearch=='taskperiod'?'display:inline-block':'display:none';?>">
                                                         <div class="form-group m-form__group">
                                                            <label>Date</label>
                                                            <div class="m-input-icon pull-right" id='m_daterangepicker_ass'>
                                                               <input class="form-control m-input m-input--square" id="m_daterangepicker_ass" name="dtrange" placeholder="Choose Date" value="<?php echo $drnge;?>" type="text">
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2 drpass" style="<?php echo $assdatesearch=='taskperiod'?'display:inline-block':'display:none';?>">
                                                         <div class="form-group m-form__group">
                                                            <label></label>
                                                            <input id="goButton" name="goButton" value="Go" class="btn btn-primary inp" style="margin-top:26px;" type="submit">
                                                         </div>
                                                      </div>
                                                   
                                                   </div>
                                                </form>
                                                <table class="table table-striped table-bordered  table-checkable m_table_2">
                                                   <thead>
                                                      <tr>
                                                         <th>Buyer Order</th>
                                                         <th>Task Title</th>
                                                         <th>Task Duration</th>
                                                         <th>Assigned To</th>
                                                         <th>Assigned By</th>
                                                         <th>Priority</th>
                                                         <th>Comments</th>
                                                         <th>Status</th>
                                                         <th class="notexport" data-orderable="false">Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php
                                                         if(!empty($assigned_task_list))
                                                         {
                                                            $i = 1;
                                                            foreach ($assigned_task_list as $e_list) 
                                                            { 
                                                               if($e_list['status']==0)                                             
                                                                  $sts = '<span class="m-badge m-badge--grey m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Not Started">Not Started</span></span>';
                                                               elseif($e_list['status']==1)
                                                                  $sts = '<span class="m-badge m-badge--blue m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="In Progress">In Progress</span></span>';
                                                               else
                                                                  $sts = '<span class="m-badge m-badge--green m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Completed">Completed</span></span>';

                                                               ?>
                                                               <tr>
                                                                  <td>
                                                                     <?php echo $e_list['buyer_order_no']==''?'-':$e_list['buyer_order_no']; ?>  
                                                                  </td>
                                                                  <td>
                                                                     <h5 class="text-black">
                                                                        <?php if($e_list['buyer_order_no'] != '' && $e_list['task_type'] == '0'){ ?>
                                                                           <i class="la la-list"></i> &nbsp;
                                                                        <?php }elseif($e_list['task_type'] == '0' && $e_list['buyer_order_no'] == ''){ ?>
                                                                           <i class="flaticon-calendar-with-a-clock-time-tools"></i> &nbsp;
                                                                        <?php }elseif($e_list['task_type'] == '1'){ ?>
                                                                           <i class="la la-calendar-check-o"></i> &nbsp;
                                                                        <?php } ?>
                                                                        <?php echo $e_list['task_title']; ?>
                                                                     </h5>   
                                                                  </td>
                                                                  <td>
                                                                     <?php echo date($date_format, strtotime($e_list['task_date'])); ?> - 
                                                                     <?php if($e_list['task_end_date']<date('Y-m-d') && $e_list['status']!=2){?>
                                                                        <font color="red">
                                                                           <?php echo date($date_format, strtotime($e_list['task_end_date'])); ?>
                                                                        </font>
                                                                     <?php }else{?>
                                                                        <?php echo date($date_format, strtotime($e_list['task_end_date'])); ?>
                                                                     <?php }?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['name']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['assignee']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['priority']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['comments']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $sts; ?>
                                                                  </td>
                                                                  <td>
                                                                        <?php if($_SESSION['TasksEdit']==1 && $e_list['status']!=2 && $e_list['buyer_order_no']==''){ ?>
                                                                        <a href="javascript:;" data-toggle="modal" data-target="#task_edit" onclick="return task_edit(<?php echo $e_list['task_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                                        <?php }?>
                                                                        <?php if($_SESSION['TasksView']==1 && $e_list['buyer_order_no']==''){ ?>                                              
                                                                           <a href="javascript:;" data-toggle="modal" data-target="#task_view" onclick="return task_view(<?php echo $e_list['task_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>
                                                                        <?php }?>
                                                                     
                                                                  </td>
                                                               </tr>
                                                               
                                                         <?php   $i++; }
                                                         } ?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>

                                       <div class="tab-pane <?php echo $alltask;?>" id="all_task" role="tabpanel">                                          
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <form method="POST" action="<?php echo base_url();?>task">
                                                   <input type="hidden" id="mytval" name="mytval" value="">
                                                   <input type="hidden" id="asstval" name="asstval" value="">
                                                   <input type="hidden" id="alltval" name="alltval" value="alltask">
                                                   <div class="row">
                                                      <div class="col-lg-2">
                                                         <label>Assigned To</label>
                                                         <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="ass_to" id="ass_to" onchange="this.form.submit();">
                                                            <option value="">All Users</option>
                                                            <?php foreach($user_list as $ulist){
                                                               if($ulist['user_id']!=$_SESSION['admindata']['user_id']){?>
                                                              <option <?php echo ($ass_to == $ulist['user_id']) ? 'selected' : ''; ?> value='<?php echo $ulist['user_id'];?>'><?php echo $ulist['name'];?></option>
                                                            <?php } }?>
                                                         </select>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <label>Assigned By</label>
                                                         <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="ass_by" id="ass_by" onchange="this.form.submit();">
                                                            <option value="">All Users</option>
                                                            <?php foreach($user_list as $ulist){
                                                               if($ulist['user_id']!=$_SESSION['admindata']['user_id']){?>
                                                              <option <?php echo ($ass_by == $ulist['user_id']) ? 'selected' : ''; ?> value='<?php echo $ulist['user_id'];?>'><?php echo $ulist['name'];?></option>
                                                            <?php } }?>
                                                         </select>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <label>Priority</label>
                                                         <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="all_priority" id="all_priority" onchange="this.form.submit();">
                                                            <option value="" <?php if($allpriority=='') echo "selected";?>>Choose Priority</option>
                                                            <option value="Low" <?php if($allpriority=='Low') echo "selected";?>>Low</option>
                                                            <option value="Medium" <?php if($allpriority=='Medium') echo "selected";?>>Medium</option>
                                                            <option value="High" <?php if($allpriority=='High') echo "selected";?>>High</option>
                                                            <option value="Urgent" <?php if($allpriority=='Urgent') echo "selected";?>>Urgent</option>
                                                         </select>
                                                      </div>      
                                                      
                                                      <div class="col-lg-2">
                                                         <label>Status</label>
                                                         <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="all_status" id="all_status" onchange="this.form.submit();">
                                                            <option value="" <?php if($allstatus=='') echo "selected";?>>Choose Status</option>
                                                            <option value = '0' <?php echo $allstatus==0?'selected':'';?>>Not Started</option>
                                                            <option value = '1' <?php echo $allstatus==1?'selected':'';?>>In Progress</option>
                                                            <option value = '2' <?php echo $allstatus==2?'selected':'';?>>Completed</option>
                                                         </select>
                                                      </div>
                                                      
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Filter By</label>
                                                            <select class="custom-select form-control" id="alldsearch" name="alldsearch" onchange="if (this.value!='taskperiod') {this.form.submit();} else {showAllTaskFilterDate();}">
                                                               <option value="" <?php if($alldatesearch=='') echo "selected";?>>Select</option>
                                                               <option value="today" <?php if($alldatesearch=='today') echo "selected";?>>Today's Task</option>
                                                               <option value="duedate" <?php if($alldatesearch=='duedate') echo "selected";?>>Due Date Passed</option>
                                                               <option value="upcoming" <?php if($alldatesearch=='upcoming') echo "selected";?>>Upcoming Task</option>
                                                               <option value="taskperiod" <?php if($alldatesearch=='taskperiod') echo "selected";?>>Task Period</option>
                                                            </select>
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-2 drpall" style="<?php echo $alldatesearch=='taskperiod'?'display:inline-block':'display:none';?>">
                                                         <div class="form-group m-form__group">
                                                            <label>Date</label>
                                                            <div class="m-input-icon pull-right" id='m_daterangepicker_all'>
                                                               <input class="form-control m-input m-input--square" id="m_daterangepicker_all" name="dtrange" placeholder="Choose Date" value="<?php echo $drnge;?>" type="text">
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2 drpall" style="<?php echo $alldatesearch=='taskperiod'?'display:inline-block':'display:none';?>">
                                                         <div class="form-group m-form__group">
                                                            <label></label>
                                                            <input id="goButton" name="goButton" value="Go" class="btn btn-primary inp" style="margin-top:26px;" type="submit">
                                                         </div>
                                                      </div>
                                                   
                                                   </div>
                                                </form>
                                                <table class="table table-striped table-bordered  table-checkable m_table_2">
                                                   <thead>
                                                      <tr>
                                                         <th>Buyer Order</th>
                                                         <th>Task Title</th>
                                                         <th>Task Duration</th>
                                                         <th>Assigned To</th>
                                                         <th>Assigned By</th>
                                                         <th>Priority</th>
                                                         <th>Comments</th>
                                                         <th>Status</th>
                                                         <th class="notexport" data-orderable="false">Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php
                                                         if(!empty($all_task_list))
                                                         {
                                                            $i = 1;
                                                            foreach ($all_task_list as $e_list) 
                                                            { 
                                                               if($e_list['status']==0)                                             
                                                                  $sts = '<span class="m-badge m-badge--grey m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Not Started">Not Started</span></span>';
                                                               elseif($e_list['status']==1)
                                                                  $sts = '<span class="m-badge m-badge--blue m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="In Progress">In Progress</span></span>';
                                                               else
                                                                  $sts = '<span class="m-badge m-badge--green m-badge--wide"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Completed">Completed</span></span>';

                                                               ?>
                                                               <tr>
                                                                  <td>
                                                                     <?php echo $e_list['buyer_order_no']==''?'-':$e_list['buyer_order_no']; ?>  
                                                                  </td>
                                                                  <td>
                                                                     
                                                                     <h5 class="text-black">
                                                                        <?php if($e_list['buyer_order_no'] != '' && $e_list['task_type'] == '0'){ ?>
                                                                           <i class="la la-list"></i> &nbsp;
                                                                        <?php }elseif($e_list['task_type'] == '0' && $e_list['buyer_order_no'] == ''){ ?>
                                                                           <i class="flaticon-calendar-with-a-clock-time-tools"></i> &nbsp;
                                                                        <?php }elseif($e_list['task_type'] == '1'){ ?>
                                                                           <i class="la la-calendar-check-o"></i> &nbsp;
                                                                        <?php } ?>
                                                                        <?php echo $e_list['task_title']; ?>
                                                                     </h5>   
                                                                  </td>
                                                                  <td>
                                                                     <?php echo date($date_format, strtotime($e_list['task_date'])); ?> - 
                                                                     <?php if($e_list['task_end_date']<date('Y-m-d') && $e_list['status']!=2){?>
                                                                        <font color="red">
                                                                           <?php echo date($date_format, strtotime($e_list['task_end_date'])); ?>
                                                                        </font>
                                                                     <?php }else{?>
                                                                        <?php echo date($date_format, strtotime($e_list['task_end_date'])); ?>
                                                                     <?php }?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['name']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['assignee']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['priority']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $e_list['comments']; ?>
                                                                  </td>
                                                                  <td>
                                                                     <?php echo $sts; ?>
                                                                  </td>
                                                                  <td>
                                                                        <?php if($_SESSION['TasksEdit']==1 && $e_list['status']!=2 && $e_list['buyer_order_no']==''){ ?>
                                                                        <a href="javascript:;" data-toggle="modal" data-target="#task_edit" onclick="return task_edit(<?php echo $e_list['task_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                                        <?php }?>
                                                                        <?php if($_SESSION['TasksView']==1 && $e_list['buyer_order_no']==''){ ?>                                              
                                                                           <a href="javascript:;" data-toggle="modal" data-target="#task_view" onclick="return task_view(<?php echo $e_list['task_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>
                                                                        <?php }?>
                                                                     
                                                                  </td>
                                                               </tr>
                                                               
                                                         <?php   $i++; }
                                                         } ?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--End::Section-->
               </div>
            </div>
         </div>

         <!-- end:: Body -->

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->

      <!-- end::Scroll Top -->
      <!--begin::Modal-->
      <!-- Create Lead Status-->
<div class="container">
   <div class="modal fade" id="create_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>task/create_task" onsubmit="return task_validation()">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group m-form__group">
                           <div class="m-radio-inline">
                              <label class="m-radio m-radio--bold m-radio--success">
                              <input type="radio" name="task_type" checked="" id="task_type_0" value="0">Today
                              <span></span>
                              </label>
                              <label class="m-radio m-radio--bold m-radio--success">
                              <input type="radio" name="task_type" id="task_type_1" value="1">General
                              <span></span>
                              </label>
                           </div>
                           <input type="hidden" name="task_type_flag" id="task_type_flag" value="0">
                           <span class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Task Title<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="task_title" name="task_title" placeholder="Enter Title">
                           <span id="task_title_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>

                  <div class="row" id="snote1">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Task Description<span class="text-danger">*</span><i class="fa fa-power-off show_snote"></i></label>
                           <textarea class="form-control" id="task_description" name="task_description"></textarea>
                           <span id="task_description_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>

                  <div class="row" id="task_date_block" style="display: none;">
                     <div class="col-lg-6">
                        <label>Task Start Date<span class="text-danger">*</span></label>
                        <input type="text" id="alter_task_date" name="alter_task_date" onblur="change_startdate_to_commondate();" class="form-control m_datepicker_1" placeholder="Enter Task Start Date">
                        <input type="hidden" id="task_date" name="task_date" >
                        <span id="task_date_err" class="text-danger"></span>
                     </div>
                     <div class="col-lg-6">
                        <label>Task End Date<span class="text-danger">*</span></label>
                        <input type="text" id="alter_task_end_date" name="alter_task_end_date" onblur="change_enddate_to_commondate();" class="form-control m_datepicker_1" placeholder="Enter Task Date">
                        <input type="hidden" id="task_end_date" name="task_end_date">
                        <span id="task_end_date_err" class="text-danger"></span>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group m-form__group">
                           <label>Priority<span class="text-danger">*</span></label>
                           <select class="custom-select form-control" id="priority" name="priority">
                              <option value="">Choose Priority</option>
                              <option value="Low">Low</option>
                              <option value="Medium">Medium</option>
                              <option value="High">High</option>
                              <option value="Urgent">Urgent</option>
                           </select>
                           <span id="priority_err" class="text-danger"></span>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group m-form__group">
                           <label>Assigned To<span class="text-danger">*</span></label>
                           <select class="form-control selectpicker" data-live-search="true" id="assigned_to" name="assigned_to[]" multiple>
                              <option value="">Choose User</option>
                              <?php foreach($user_list as $ulist){?>
                              <option value="<?php echo $ulist['user_id'];?>"><?php echo $ulist['name'];?></option>
                              <?php }?>
                           </select>
                           <span id="assigned_to_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group m-form__group">
                           <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                              <input type="checkbox" class="menu_checkbox" id="is_schedule" name="is_schedule" value="0" onchange="changePermissionCheck(this.id,this.value);"> is Schedule
                              <input type="hidden" class="menu_checkbox_hidden" id="is_schedulehidden" name="is_schedule" value=0>
                              <span></span>
                           </label>
                        </div>
                     </div>

                     <div class="col-lg-6" id="stype" style="display:none;">
                        <div class="form-group m-form__group">
                           <label>Schedule Type<span class="text-danger">*</span></label>
                           <select class="custom-select form-control" id="schedule_type" name="schedule_type" onchange="getScheduleValue(this.value);">
                              <option value="">Choose Schedule Type</option>
                              <option value="Daily">Daily</option>
                              <option value="Weekly">Weekly</option>
                              <option value="Monthly">Monthly</option>
                           </select>
                           <span id="schedule_type_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-6" id="sweek" style="display:none;">
                        <div class="form-group m-form__group">
                           <label>Schedule<span class="text-danger">*</span></label>
                           <select class="form-control selectpicker" data-live-search="true" id="schedule_value_week" name="schedule_value_week[]" multiple>
                              <!-- <option value="">Choose Day</option> -->
                              <option value="Sunday">Sunday</option>
                              <option value="Monday">Monday</option>
                              <option value="Tuesday">Tuesday</option>
                              <option value="Wednesday">Wednesday</option>
                              <option value="Thursday">Thursday</option>
                              <option value="Friday">Friday</option>
                              <option value="Saturday">Saturday</option>
                           </select>
                           <span id="schedule_value_week_err" class="text-danger"></span>
                        </div>
                     </div>
                     <div class="col-lg-6" id="smonth" style="display:none;">
                        <div class="form-group m-form__group">
                           <label>Schedule<span class="text-danger">*</span></label>
                           <select class="form-control selectpicker" data-live-search="true" id="schedule_value_month" name="schedule_value_month[]" multiple>
                              <!-- <option value="">Choose Date</option> -->
                              <?php for($i=1;$i<=31;$i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                              <?php }?>
                           </select>
                           <span id="schedule_value_month_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>

               </div>
               <div class="modal-footer">
                  <button type="submit" id="btnSubmit" class="btn btn-primary">Create</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!-- Update exporter-->
<div class="container">
   <div class="modal fade" id="task_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="task_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
$('#task_description').summernote({
  lineHeights: ['0.2']
});
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Task List';
$(document).attr("title", title); 
$("#snote1 i.show_snote").click(function(){
   $('#snote1 .note-toolbar-wrapper').toggle();
   $('#snote1 .note-editable').toggleClass("mt");
  });
$('.m_table_2').dataTable();

$("#m_daterangepicker_ass").daterangepicker({buttonClasses:"m-btn btn",applyClass:"btn-primary",cancelClass:"btn-secondary"},function(a,t,n){$("#m_daterangepicker_ass .form-control").val(a.format("DD-MM-YYYY")+" / "+t.format("DD-MM-YYYY"))});

$("#m_daterangepicker_all").daterangepicker({buttonClasses:"m-btn btn",applyClass:"btn-primary",cancelClass:"btn-secondary"},function(a,t,n){$("#m_daterangepicker_all .form-control").val(a.format("DD-MM-YYYY")+" / "+t.format("DD-MM-YYYY"))})


function showMyTaskFilterDate(){
    
    var filterBy = $('#mdsearch').val(); 
    if(filterBy == 'taskperiod')
    {
        $('.drpmy').show();
    }
    else{
        $('.drpmy').hide();
    }
}

function change_startdate_to_commondate()
{
   var chosen_date = $('#alter_task_date').val();
   $('#task_date').val(chosen_date);
   $.ajax({
     url:baseurl+'Leads/change_dtrange_val',
     type:'POST',
     data:{'value':chosen_date},
     dataType: 'html',
     success:function(result){
        $('#alter_task_date').val(result);
     }
   });
}
function change_enddate_to_commondate()
{
   var chosen_date = $('#alter_task_end_date').val();
   $('#task_end_date').val(chosen_date);
   $.ajax({
     url:baseurl+'Leads/change_dtrange_val',
     type:'POST',
     data:{'value':chosen_date},
     dataType: 'html',
     success:function(result){
        $('#alter_task_end_date').val(result);
     }
   });
}
function showAssTaskFilterDate(){
    
    var filterBy = $('#assdsearch').val(); 
    if(filterBy == 'taskperiod')
    {
        $('.drpass').show();
    }
    else{
        $('.drpass').hide();
    }
}


function showAllTaskFilterDate(){
    
    var filterBy = $('#alldsearch').val(); 
    if(filterBy == 'taskperiod')
    {
        $('.drpall').show();
    }
    else{
        $('.drpall').hide();
    }
}

function getScheduleValue(val)
{
   if(val!='' && val!='Daily')
   {
      if(val=='Weekly')
      {
         $('#schedule_value_month').val('');
         $('#smonth').hide();
         $('#schedule_value_week').val('');
         $('#sweek').show();
      }
      else
      {
         $('#schedule_value_month').val('');
         $('#smonth').show();
         $('#schedule_value_week').val('');
         $('#sweek').hide();
      }
   }
   else
   {
      $('#schedule_value_month').val('');
      $('#smonth').hide();
      $('#schedule_value_week').val('');
      $('#sweek').hide();
   }
}

function changePermissionCheck(id,val)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;
      $('#stype').hide();
      $('#schedule_type').val('');
      $('#smonth').hide();
      $('#sweek').hide();
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
      $('#stype').show();
   }
}

function getScheduleValueEdit(val)
{
   if(val!='' && val!='Daily')
   {
      if(val=='Weekly')
      {
         $('#schedule_value_month_edit').val('');
         $('#smonth_edit').hide();
         $('#schedule_value_week_edit').val('');
         $('#sweek_edit').show();
      }
      else
      {
         $('#schedule_value_month_edit').val('');
         $('#smonth_edit').show();
         $('#schedule_value_week_edit').val('');
         $('#sweek_edit').hide();
      }
   }
   else
   {
      $('#schedule_value_month_edit').val('');
      $('#smonth_edit').hide();
      $('#schedule_value_week_edit').val('');
      $('#sweek_edit').hide();
   }
}

function changePermissionCheckEdit(id,val)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;
      $('#stype_edit').hide();
      $('#schedule_type_edit').val('');
      $('#smonth_edit').hide();
      $('#sweek_edit').hide();
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
      $('#stype_edit').show();
   }
}
var notification_content = '';
function lead_notification_message_generation()
{

  var assigned_to = $('#assigned_to').val();

  var task_title = $('#task_title').val();
  var created_by = '<?php echo $_SESSION['admindata']['user_id']; ?>';
  var priority = $('#priority').val();
  
  $.ajax({
      type: "POST",
      url:baseurl+'Leads/generate_task_notification_content_change',
      data:{'assigned_to':assigned_to,'task_title':task_title,'created_by':created_by,'priority':priority},
      async: false,
      dataType: "html",
      success: function(result){
         notification_content = result;
      }
   });

}

function task_validation(){
   lead_notification_message_generation();
    var err = 0;
      var ttitle = $('#task_title').val();
      var tdesc = $('#task_description').val();
      var tdate = $('#task_date').val();
      var ato = $('#assigned_to').val();
      var tedate = $('#task_end_date').val();
      var pri = $('#priority').val();
      var issch = $('#is_schedule').val();
      var task_type_flag = $('#task_type_flag').val();

      if(ttitle==''){
         $('#task_title_err').html('Enter Task Title');
         err++;
      }else{
        $('#task_title_err').html('');
      }

      if(tdesc==''){
         $('#task_description_err').html('Enter Description');
         err++;
      }else{
        $('#task_description_err').html('');
      }

      if(task_type_flag == '1'){

         if(tdate==''){
            $('#task_date_err').html('Enter Task Start Date!');
            err++;
         }else{
           $('#task_date_err').html('');
         }

         if(tedate==''){
            $('#task_end_date_err').html('Enter Task End Date!');
            err++;
         }else{
           $('#task_end_date_err').html('');
         }

      }
      
      if(ato==''){
         $('#assigned_to_err').html('Choose User!');
         err++;
      }else{
        $('#assigned_to_err').html('');
      }
      
      if(pri==''){
         $('#priority_err').html('Choose Priority!');
         err++;
      }else{
        $('#priority_err').html('');
      }

      if(issch==1)
      {
         var stype = $('#schedule_type').val();
         if(stype=='')
         {
            $('#schedule_type_err').html('Choose Schedule Type!');
            err++;
         }
         else
         {
            $('#schedule_type_err').html('');
            if(stype!='Daily')
            {
               if(stype=='Weekly')
               {
                  var svalw = $('#schedule_value_week').val();
                  if(svalw=='')
                  {
                     $('#schedule_value_week_err').html('Choose Schedule Day!');
                     err++;
                  }
                  else
                  {
                     $('#schedule_value_week_err').html('');
                  }
               }
               else
               {
                  var svalm = $('#schedule_value_month').val();
                  if(svalm=='')
                  {
                     $('#schedule_value_month_err').html('Choose Schedule Date!');
                     err++;
                  }
                  else
                  {
                     $('#schedule_value_month_err').html('');
                  }
               }
            }
         }
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
   if ($('#assigned_to').val() != '') {
     client.recipient_id = $('#assigned_to').val();
   }
   conn.send(JSON.stringify(client));
   return true;
    
  }
} 

function task_edit_validation(){
    var err = 0;
      var ttitle = $('#task_title_edit').val();
      var tdesc = $('#task_description_edit').val();
      var tdate = $('#task_date_edit').val();
      var ato = $('#assigned_to_edit').val();
      var tedate = $('#task_end_date_edit').val();
      var pri = $('#priority_edit').val();
      var issch = $('#is_schedule_edit').val();

      if(ttitle==''){
         $('#task_title_edit_err').html('Enter Task Title');
         err++;
      }else{
        $('#task_title_edit_err').html('');
      }

      if(tdesc==''){
         $('#task_description_edit_err').html('Enter Description');
         err++;
      }else{
        $('#task_description_edit_err').html('');
      }

      if(tdate==''){
         $('#task_date_edit_err').html('Enter Task Start Date!');
         err++;
      }else{
        $('#task_date_edit_err').html('');
      }

      if(tedate==''){
         $('#task_end_date_edit_err').html('Enter Task End Date!');
         err++;
      }else{
        $('#task_end_date_edit_err').html('');
      }
      
      if(ato==''){
         $('#assigned_to_edit_err').html('Choose User!');
         err++;
      }else{
        $('#assigned_to_edit_err').html('');
      }
      
      if(pri==''){
         $('#priority_edit_err').html('Choose Priority!');
         err++;
      }else{
        $('#priority_edit_err').html('');
      }

      if(issch==1)
      {
         var stype = $('#schedule_type_edit').val();
         if(stype=='')
         {
            $('#schedule_type_edit_err').html('Choose Schedule Type!');
            err++;
         }
         else
         {
            $('#schedule_type_edit_err').html('');
            if(stype!='Daily')
            {
               if(stype=='Weekly')
               {
                  var svalw = $('#schedule_value_week_edit').val();
                  if(svalw=='')
                  {
                     $('#schedule_value_week_edit_err').html('Choose Schedule Day!');
                     err++;
                  }
                  else
                  {
                     $('#schedule_value_week_edit_err').html('');
                  }
               }
               else
               {
                  var svalm = $('#schedule_value_month_edit').val();
                  if(svalm=='')
                  {
                     $('#schedule_value_month_edit_err').html('Choose Schedule Date!');
                     err++;
                  }
                  else
                  {
                     $('#schedule_value_month_edit_err').html('');
                  }
               }
            }
         }
      }


  if(err>0||er>0){ return false; }else{ return true; }
}

function task_edit(val){
$.ajax({
type: "POST",
url: baseurl+'task/task_edit',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#task_edit').empty().append(response);
}
});
}  

function task_view(val){
$.ajax({
type: "POST",
url: baseurl+'task/task_view',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#task_view').empty().append(response);
}
});
}


$("input[name$='task_type']").click(function() {
  var task_type_val = $(this).val();
  if (task_type_val == 0) {
   $('#task_date_block').hide();
   $('#task_type_flag').val(task_type_val);
   $('#task_date').val('');
   $('#task_end_date').val('');

   // $('#assigned_to').removeAttr("multiple");
   // $('#assigned_to').selectpicker('refresh');
  }
  else {
   $('#task_date_block').show();
   $('#task_type_flag').val(task_type_val);
   // $('#assigned_to').attr("multiple","true");
   // $('#assigned_to').selectpicker('refresh');
  }

});
</script>
</body>
   <!-- end::Body -->
</html>