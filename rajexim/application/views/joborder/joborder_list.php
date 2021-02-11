<?php $this->load->view('common_header'); $date_format =common_date_format();?>

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="#" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>joborder" class="m-nav__link">
                                 <span class="m-nav__link-text">Job Order</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <!-- END: Subheader -->
               <div class="m-content">
               <?php if($this->session->flashdata('purchase_success')){?>
               <div class="alert alert-success alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('purchase_success'); ?>               
               </div>
               <?php } ?> 
               <?php if($this->session->flashdata('purchase_err')){?>
               <div class="alert alert-danger alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('purchase_err'); ?>                
               </div>
               <?php } ?> 

                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                      Job Order List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" id="tog_filter">
                                          <span>
                                             <i class="fa fa-filter"></i>
                                             <span></span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php if($_SESSION['Job OrderAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_joborder">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php }?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" onclick="jo_export_items();" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="fa fa-file-export"></i>
                                             <span>Generate Report</span>
                                          </span>
                                       </a>
                                    </li><!-- 
                                    <li class="m-portlet__nav-item">
                                       <a href="#" onclick="jo_export_items();" class="m-portlet__nav-link btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                          Export
                                       </a>
                                    </li> -->
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">

                              <?php if($this->session->flashdata('qstage_success')){?>
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
                              <form method="POST" action="<?php echo base_url();?>buyerorder">
                                 <div class="my_filter" style="display: none;"> 
                                    <div class="row">
                                       
                                       <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Users</label>
                                             <select class="form-control selectpicker" data-live-search="true" id="user_id" name="user_id" onchange="submit_jo_filter('filter');">
                                                <option value="">All User</option>
                                                <?php
                                                   if(!empty($user_list))
                                                   {
                                                      foreach ($user_list as $l_source)
                                                        {
                                                          if ($l_source['role_id'] != 1) { ?>

                                                         <option value="<?php echo $l_source['user_id']; ?>" ><?php echo $l_source['name']; ?></option>

                                                      <?php } 
                                                   } }
                                                ?>
                                             </select>
                                          </div>
                                       </div>

                                       <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Filter Based On</label>
                                             <select class="custom-select form-control" id="fbase" name="fbase" onchange="showFBase();">
                                                <!-- <option value="" <?php //if($fbasesearch=='') echo "selected";?>>Select</option> -->
                                                <option value="BonQuarter" <?php if($fbasesearch=='BonQuarter') echo "selected";?>>Quarter</option>
                                                <option value="BonDate" <?php if($fbasesearch=='BonDate') echo "selected";?>>Date</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-2 boq" style="<?php echo $fbasesearch=='BonQuarter'?'':'display:none';?>">
                                          <div class="form-group m-form__group">
                                             <label>Quarter</label>
                                             <select class="custom-select form-control" id="fquarter" name="fquarter">
                                                <option value="" <?php if($fquartersearch=='') echo "selected";?>>All</option>
                                                <option value="Q1" <?php if($fquartersearch=='Q1') echo "selected";?>>Q1</option>
                                                <option value="Q2" <?php if($fquartersearch=='Q2') echo "selected";?>>Q2</option>
                                                <option value="Q3" <?php if($fquartersearch=='Q3') echo "selected";?>>Q3</option>
                                                <option value="Q4" <?php if($fquartersearch=='Q4') echo "selected";?>>Q4</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-2 boq" style="<?php echo $fbasesearch=='BonQuarter'?'':'display:none';?>">
                                          <div class="form-group m-form__group">
                                             <label>Year</label>
                                             <div class="m-input-icon pull-right">
                                                <input type="text" id="ypick" name="ypick" class="form-control" placeholder="Choose Year" value="<?php echo $ypick;?>" readonly>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-2 boq" style="">
                                          <div class="form-group m-form__group">
                                             <label></label>
                                             <input id="goButtonboq" name="goButtonboq" value="Go" class="btn btn-primary inp" style="margin-top:26px;" type="button" onclick="submit_jo_filter('filter');">
                                          </div>
                                       </div>
                                       
                                       <div class="col-lg-2 bod">
                                          <div class="form-group m-form__group">
                                             <label>Filter By</label>
                                             <select class="custom-select form-control" id="searchChange" name="searchChange" onchange="if (this.value!='thisDate') {showFilterDate();submit_jo_filter('filter');} else {showFilterDate();}">
                                                <option value="">Select</option>
                                                <option value="today">Today</option>
                                                     <option value="thisweek">This Week</option>
                                                     <option value="thismonth">This Month</option>
                                                     <option value="thisyear">This Year</option>
                                                      <option value="thisDate">Date</option>
                                             </select>
                                          </div>
                                       </div>

                                      <div class="col-lg-2 drp" style=" min-width: 360px; ">
                                         <div class="form-group m-form__group">
                                            <label>Date Range</label>
                                            <div class="row">
                                               <div class="col-lg-5">
                                                  <input type="text" id="alter_dtrange_from" onblur="change_from_date_format();" name="alter_dtrange_from" placeholder="From Date" class="form-control m_datepicker_1" value="" style="width: 130px;"> 
                                               </div>
                                               <div class="col-lg-1">To</div>
                                               <div class="col-lg-5">
                                                  <input type="text" id="alter_dtrange_to" onblur="change_to_date_format();" name="alter_dtrange_to" placeholder="To Date" class="form-control m_datepicker_1" value="" style="width: 130px;">
                                               </div>
                                               <div class="col-lg-1">
                                                  <div class="input-group-append">
                                                        <input id="goButton" name="goButton" value="Go" class="btn btn-primary inp" type="button" onclick="submit_jo_filter('filter');">
                                                  </div>
                                               </div>
                                            </div>
                                            <input type="hidden" id="dtrange_from" name="dtrange_from" placeholder="From Date" class="form-control" value="">
                                            <input type="hidden" id="dtrange_to" name="dtrange_to" placeholder="To Date" class="form-control" value="">
                                         </div>
                                      </div>

                                    </div>
                                 </div>
                              </form>
                              <div class="row" id="jo_list_table_append_block" style="display: none;"> 
                                 
                              </div>
                              <div class="row" id="jo_list_table_append_block_loader"> 
                                 <div class="col-lg-5"></div>
                                 <div class="col-lg-2">
                                    <img src="<?php echo base_url(); ?>assets/demo/demo12/media/img/logo/aero_world2.gif" height="100px" width="100px" style="margin-top: 93px;">
                                 </div>
                                 <div class="col-lg-5"></div>
                              </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->
               </div>
            </div>
         </div>


         <!--Create job order-->
<div class="container">
 <div class="modal fade" id="create_joborder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Create Job Order</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>joborder/create_joborder" onsubmit="return joborder_validation();">
             <div class="modal-body">
               <fieldset>
                  <legend class="text-info"><b>Job Order Info</b></legend>
                  <div class="row">                    
                      <div class="col-lg-6">
                         <div class="form-group m-form__group">
                            <label>Supplier PO No<span class="text-danger">*</span></label>
                            <select class="custom-select form-control" id="supplier_purchase_order_id" name="supplier_purchase_order_id" onchange="getSupplyDate(this.value);">
                               <option value="">Choose Supplier PO</option>
                               <?php foreach($supplierpo_list as $spolist){?>
                                 <option value="<?php echo $spolist['supplier_purchase_order_id'];?>"><?php echo $spolist['supplier_purchase_order_no'];?></option>
                               <?php }?>
                            </select>
                            <input type="hidden" id="supply_date" name="supply_date">
                            <input type="hidden" id="supply_end_date" name="supply_end_date">
                            <span id="supplier_purchase_order_id_err" class="text-danger"></span>
                         </div>
                      </div>
                      <div class="col-lg-6">
                         <div class="form-group m-form__group">
                            <label>Assigned To<span class="text-danger">*</span></label>
                            <select class="custom-select form-control" id="employee_id" name="employee_id">
                               <option value="">Choose Employee</option>
                               <?php
                                    if(!empty($assigned_user_lists))
                                    {  
                                       foreach ($assigned_user_lists as  $assigned_user_list) { 
                                        if ($assigned_user_list->role_id != 1) {
                                        ?>
                                          <option value="<?php echo $assigned_user_list->user_id; ?>"><?php echo $assigned_user_list->name; ?></option>
                                       <?php } 
                                    }
                                  }
                                 ?>
                            </select>
                            <span id="employee_id_err" class="text-danger"></span>
                         </div>
                      </div>
                      
                  </div>
                  <div class="row">
                      <div class="col-lg-6">
                         <div class="form-group m-form__group">
                            <label>Job Order Date<span class="text-danger">*</span></label>
                            <input type="text" id="job_order_date" name="job_order_date" class="form-control m-input m_datepicker_2_modal m-input--square" placeholder="Enter Job Order Date">
                            <span id="job_order_date_err" class="text-danger"></span>
                         </div>
                      </div>
                      <div class="col-lg-6">
                         <div class="form-group m-form__group">
                            <label>Job Order End Date<span class="text-danger">*</span></label>
                            <input type="text" id="job_order_end_date" name="job_order_end_date" class="form-control m-input m_datepicker_2_modal m-input--square" placeholder="Enter Job Order End Date">
                            <span id="job_order_end_date_err" class="text-danger"></span>
                         </div>
                      </div>
                  </div>
              </fieldset>
             </div>
             <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
            </form>
       </div>
    </div>
 </div>
</div>

      <!--Edit Job Order-->
      <div class="container">
         <div class="modal fade" id="edit_joborder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
         </div>
      </div>  

<!-- View Job Order -->
<div class="container">
 <div class="modal fade" id="view_joborder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
 </div>
</div>


            <!--Process job order-->
      <div class="container">
         <div class="modal fade" id="process_joborder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
         </div>
      </div>


            <!--Edit Process job order-->
      <div class="container">
         <div class="modal fade" id="edit_joborder_process" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
         </div>
      </div>


            <!--Add Process job order-->
      <div class="container">
         <div class="modal fade" id="add_joborder_process" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
         </div>
      </div>

            <!--Inspect job order-->
      <div class="container">
         <div class="modal fade" id="inspect_joborder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
         </div>
      </div>

<!--Loading job order document-->
<div class="container">
    <div class="modal fade" id="load_doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       
    </div>
   </div>

<!--job order complete-->
<div class="container">
    <div class="modal fade" id="jo_complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       
    </div>
   </div>
<div class="container">
   <div class="modal fade" id="jo_export_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Export Job Order Info</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?php echo base_url(); ?>Leads/export_jo_info" method="POST" onsubmit="return jo_exp_validation()">
               <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                       <div class="form-group m-form__group">
                          <h3>Filter By<span class="text-danger"></span></h3>
                          <div class="row">
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Year :</label>
                                     <input type="hidden" name="exp_jo_filt_year_val" id="exp_jo_filt_year_val">
                                     <input type="hidden" name="quarter_or_range" id="quarter_or_range">
                                     <span id="exp_jo_filt_year"></span>
                                   </label>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Quarter :</label>
                                     <input type="hidden" name="exp_jo_filt_quarter_val" id="exp_jo_filt_quarter_val">
                                     <span id="exp_jo_filt_quarter"></span>
                                   </label>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Search By :</label>
                                     <input type="hidden" name="exp_jo_filt_search_val" id="exp_jo_filt_search_val">
                                     <span id="exp_jo_filt_search"></span>
                                   </label>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Date Range Wise :</label>
                                     <input type="hidden" name="exp_jo_filt_dtrng_val" id="exp_jo_filt_dtrng_val">
                                     <span id="exp_jo_filt_dtrng"></span>
                                   </label>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">User :</label>
                                     <input type="hidden" name="exp_jo_filt_user_val" id="exp_jo_filt_user_val">
                                     <span id="exp_jo_filt_user"></span>
                                   </label>
                                </div>
                             </div><!-- 
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Country :</label>
                                     <input type="hidden" name="exp_bo_filt_country_val" id="exp_bo_filt_country_val">
                                     <span id="exp_bo_filt_country"></span>
                                   </label>
                                </div>
                             </div> -->
                          </div>
                       </div>
                    </div>
                  </div>
                  <hr>
                  <div class="required">
                    <div class="row">
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_lead_name" class = "jo_export" name="jo_export[]" value="Lead Name"><label class="label" for="exp_lead_name">Lead Name</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_supplier_order_no" class = "jo_export" name="jo_export[]" value="Supplier Order No"><label class="label" for="exp_supplier_order_no">Supplier Order No</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_buyer_ord" class = "jo_export" name="jo_export[]" value="Buyer Order No"><label class="label" for="exp_buyer_ord">Buyer Order No</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_job_order_no" class = "jo_export" name="jo_export[]" value="Job Order No"><label class="label" for="exp_job_order_no">Job Order No</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                    </div>

                    <div class="row">
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_job_ord_date" class = "jo_export" name="jo_export[]" value="Job Order Date"><label class="label" for="exp_job_ord_date">Job Order Date</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_job_ord_end_date" class = "jo_export" name="jo_export[]" value="Job Order End Date"><label class="label" for="exp_job_ord_end_date">Job Order End Date</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_emp_name" class = "jo_export" name="jo_export[]" value="Employee"><label class="label" for="exp_emp_name">Employee</label>
                               <span></span>   
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_product" class = "jo_export" name="jo_export[]" value="Product"><label class="label" for="exp_product">Employee</label>
                               <span></span>   
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_container_no" class = "jo_export" name="jo_export[]" value="Container No"><label class="label" for="exp_container_no">Container No</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                    </div>

                    <div class="row">
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_lorry_no" class = "jo_export" name="jo_export[]" value="Lorry No"><label class="label" for="exp_lorry_no">Lorry No</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_complete_date" class = "jo_export" name="jo_export[]" value="Complete Date"><label class="label" for="exp_complete_date">Complete Date</label>
                                  <span></span>
                             </label>
                          </div>
                       </div>
                    </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <div class="bank m-checkbox-inline">
                     <label class="m-checkbox">
                       <input type="checkbox" onclick="toggle(this)"><label class="label">All</label>
                       <span></span>
                     </label>
                  </div>&nbsp;
                  <p class="text-danger" id="exp_error"></p>
                 <button type="submit" class="btn btn-primary">Yes</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
         <!-- end:: Body -->

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->


<script type="text/javascript">
   var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Job Order List';
   $(document).attr("title", title);
$('#job_order_date').datepicker({ format : 'yyyy/mm/dd', todayHighlight:!0,orientation:"bottom left",templates:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'}});
$('#job_order_end_date').datepicker({ format : 'yyyy/mm/dd', todayHighlight:!0,orientation:"bottom left",templates:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'}});

$('#tog_filter').click(function(){
  $('.my_filter').slideToggle('slow'); 
});
function showFilterDate(){
    
    var filterBy = $('#searchChange').val(); 
    if(filterBy == 'thisDate')
    {
        $('.drp').show();
    }
    else{
        $('.drp').hide();
    }
}
function jo_exp_validation()
 {
  var err = 0;
  if ($('div.required :checkbox:checked').length > 0) {
    $('#exp_error').html('');
  }
  else {
    $('#exp_error').html('Choose Any one..');
    err++;
  }
  if (err == 0) {
    return true;
  }
  else {
    return false;
  }
 }
showFBase();
function showFBase()
{

   var bon = $('#fbase').val();
   $('#quarter_or_range').empty().val(bon);
   if(bon=='BonQuarter')
   {
      $('.bod').hide();
      $('.drp').hide();
      $('#searchChange').val('');
      $('.boq').show();
   }
   else if(bon=='BonDate')
   {
      $('.bod').show();
      $('.boq').hide();
      $('#fquarter').val('');
   }
   else 
   {
      $('.bod').hide();
      $('.drp').hide();
      $('#searchChange').val('');
      $('.boq').hide();
      $('#fquarter').val('');
   }
}
function change_from_date_format() {
  var alter_dtrange_from = $('#alter_dtrange_from').val();
  $('#dtrange_from').val(alter_dtrange_from);
  $.ajax({
     url:baseurl+'Leads/change_dtrange_val',
     type:'POST',
     data:{'value':alter_dtrange_from},
     dataType: 'html',
     success:function(result){
        $('#alter_dtrange_from').val(result);
     }
  });
}
function change_to_date_format() {
  var alter_dtrange_to = $('#alter_dtrange_to').val();
  $('#dtrange_to').val(alter_dtrange_to);
  $.ajax({
     url:baseurl+'Leads/change_dtrange_val',
     type:'POST',
     data:{'value':alter_dtrange_to},
     dataType: 'html',
     success:function(result){
        $('#alter_dtrange_to').val(result);
     }
  });
}
var pagecount = '';
var current_pagination_index = '';
function paginate_page(page,l_id)
{  
   current_pagination_index = l_id;
   pagecount = page;
   submit_jo_filter('pagination');
}

var search_val = '';
function search_on_list(val)
{
   // if (val != '') {
    search_val = val;
    submit_jo_filter('search');
   // }
}

submit_jo_filter('filter');
function submit_jo_filter(diff) {
   if(diff=='pagination'){
      current_pagination_index = current_pagination_index;
   }
   else{
      current_pagination_index = 1;
   }
   if (diff == 'search' || diff=='perpage_count') {
      pagecount = 0;
   }
   else {
      pagecount = pagecount;
   }
   // var pagecount = localStorage.getItem('curr_page');
   $('#jo_list_table_append_block_loader').show();
   $('#jo_list_table_append_block').hide();
   // var country_id = $('#country_id').val();
   // var product_id = $('#product_id').val();
   var user_id = $('#user_id').val();
   var fbase = $('#fbase').val();
   var goButtonboq = $('#goButtonboq').val();
   var fquarter = $('#fquarter').val();
   var ypick = $('#ypick').val();
   var goButton = $('#goButton').val();
   var searchChange = $('#searchChange').val();
   var dtrange_from = $('#dtrange_from').val();
   var dtrange_to = $('#dtrange_to').val();
   // var active_tab = "<?php // echo (isset($_GET['active_tab'])) ? '?active_tab='.$_GET['active_tab'] : ''; ?>";
   var perpage = $('#perpage').val();
   $.ajax({
      url:baseurl+'Joborder/jo_list_by_filter',
      type:'POST',
      data:{'user_id':user_id,'fbase':fbase,'goButtonboq':goButtonboq,'fquarter':fquarter,'ypick':ypick,'goButton':goButton,'searchChange':searchChange,'dtrange_from' : dtrange_from, 'dtrange_to' : dtrange_to, 'pagecount' : pagecount, 'search_val' : search_val, 'current_pagination_index' : current_pagination_index,'perpage':perpage},
      dataType: 'html',
      success:function(result){
         $('#jo_list_table_append_block').empty().append(result);
         $('#jo_list_table_append_block_loader').hide();
         $('#jo_list_table_append_block').show();
      }
   });
}

var toDate = $('#ypick').datepicker({
    format: "yyyy",
    minViewMode: 2,
  autoclose : true
    }).on('hide',function(date){
  $("#ypick").val(date.target.value + "-" + (parseInt(date.target.value) + parseInt(1)));
});

function jo_complete(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'joborder/jo_complete',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#jo_complete').empty().append(response);
}
});
}

function completeJO(val)
{ 
//var baseurl= $("#baseUrl").val();
$.ajax({
type: "POST",
url: baseurl+'joborder/completeJO',
async: false,
data:"joid="+val,
success: function(response)
{
window.location.href = baseurl+'joborder';
}
});
}

function getSupplyDate(val)
{
    //var baseurl= $("#baseUrl").val();

    if(val !='')
    {
       $.ajax({
           type: "POST",
           url: baseurl+'joborder/getSupplyDate',
           async: false,
           type: "POST",
           data: "id="+val,
           dataType: "html",
           success: function(response)
           {
            var data = response.split('|');
            $('#supply_date').val(data[0]);
            $('#supply_end_date').val(data[1]);
           }
       });
   }
}


function joborder_validation()
{
   var err = 0;
   var jod = $('#job_order_date').val();
   var joed = $('#job_order_end_date').val();
   var spoid = $('#supplier_purchase_order_id').val();
   var empid = $('#employee_id').val();
   var sdate = $('#supply_date').val();
   var sedate = $('#supply_end_date').val();

   var jodt = jod.split('/');
   var jd = jodt[0]+'-'+jodt[1]+'-'+jodt[2];
   var joedt = joed.split('/');
   var jed = joedt[0]+'-'+joedt[1]+'-'+joedt[2];

   var sodt = sdate.split('/');
   var sot = sodt[0]+'-'+sodt[1]+'-'+sodt[2];
   var soedt = sedate.split('/');
   var soet = soedt[0]+'-'+soedt[1]+'-'+soedt[2];

   var spo_date = new Date(sot); //dd-mm-YYYY
   var spo_end_date = new Date(soedt); //dd-mm-YYYY
   var jo_date = new Date(jd);
   var jo_end_date = new Date(jed);

   // alert('sp_date '+spo_date);
   // alert('spe_date '+spo_end_date);
   // alert('jo_date '+jo_date);
   // alert('jo_end_date '+jo_end_date);
   if(jod==''){
      $('#job_order_date_err').html('JO Date is required!');
      err++;
   }
   else
   {
      if(jo_date<spo_date || jo_date>=spo_end_date)
      {
         $('#job_order_date_err').html('Invalid Date!');
         err++;
      }
      else
      {
         $('#job_order_date_err').html('');        
      }
   }

   if(joed==''){
      $('#job_order_end_date_err').html('JO End Date is required!');
      err++;
   }
   else
   {     
      if(jo_end_date<jo_date || jo_end_date>=spo_end_date)
      {
         $('#job_order_end_date_err').html('Invalid Date!');
         err++;
      }
      else
      {
         $('#job_order_end_date_err').html('');       
      }
   }

   if(spoid==''){
      $('#supplier_purchase_order_id_err').html('Choose Supplier PO!');
      err++;
   }
   else
   {
      $('#supplier_purchase_order_id_err').html('');
   }

   if(empid==''){
      $('#employee_id_err').html('Choose Employee!');
      err++;
   }
   else
   {
      $('#employee_id_err').html('');
   }

   if(err>0){ return false; }else{ return true; }
}

function joborder_edit(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'joborder/joborder_edit',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#edit_joborder').empty().append(response);
}
});
}

function joborder_edit_validation()
{
   var err = 0;
   var joed = $('#job_order_end_date_edit').val();

   if(joed==''){
      $('#job_order_end_date_edit_err').html('JO End Date is required!');
      err++;
   }
   else
   {
      $('#job_order_end_date_edit_err').html('');
   }

   if(err>0){ return false; }else{ return true; }
}

function joborder_view(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'joborder/joborder_view',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#view_joborder').empty().append(response);
}
});
}



function joborder_process(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'joborder/joborder_process',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#process_joborder').empty().append(response);
}
});
}

function joborder_process_validation()
{
   var err = 0;
     //var phone_type_id=$('#phone_type_id'+res).val();
     var ptype=$('#process_type').val();
     var qty = $('#quantity').val();
     var desc = $('#description').val();

       if(ptype==''){
         $('#process_type_err').html('Choose Type!');
         err++;
       }else{
         $('#process_type_err').html('');
       }

       if(qty==''){
         $('#quantity_err').html('Quantity is required!');
         err++;
       }else{
         $('#quantity_err').html('');
       }

       if(desc==''){
         $('#description_err').html('Description is required!');
         err++;
       }else{
         $('#description_err').html('');
       }

if(err>0){ return false; }else{ return true; }

}

function joborder_process_edit(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'joborder/joborder_process_edit',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#edit_joborder_process').empty().append(response);
}
});
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function joborder_process_edit_validation()
{
   var err = 0;
     //var phone_type_id=$('#phone_type_id'+res).val();
     var qty = $('#quantity_edit').val();
     var desc = $('#description_edit').val();

       if(qty==''){
         $('#quantity_edit_err').html('Quantity is required!');
         err++;
       }else{
         $('#quantity_edit_err').html('');
       }

       if(desc==''){
         $('#description_edit_err').html('Description is required!');
         err++;
       }else{
         $('#description_edit_err').html('');
       }

if(err>0){ return false; }else{ return true; }

}

function joborder_process_add(joid,pdate,ptype){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'joborder/joborder_process_add',
async: false,
type: "POST",
data: "joid="+joid+'&pdate='+pdate+'&ptype='+ptype,
dataType: "html",
success: function(response)
{
$('#add_joborder_process').empty().append(response);
}
});
}

function joborder_process_add_validation()
{
   var err = 0;
     //var phone_type_id=$('#phone_type_id'+res).val();
     var qty = $('#quantity_add').val();
     var desc = $('#description_add').val();

       if(qty==''){
         $('#quantity_add_err').html('Quantity is required!');
         err++;
       }else{
         $('#quantity_add_err').html('');
       }

       if(desc==''){
         $('#description_add_err').html('Description is required!');
         err++;
       }else{
         $('#description_add_err').html('');
       }

if(err>0){ return false; }else{ return true; }

}

function joborder_inspect(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'joborder/joborder_inspect',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#inspect_joborder').empty().append(response);
}
});
}

function changePermission(id,val)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
   }
}

function add_inspect()
{
   var count=$('#mailcount').val();
   var cont = $("#mcontent10");
   
   cont.append('<div class="row" id="mid'+count+'"><div class="col-lg-2"><div class="form-group m-form__group"><label>Item Name<span class="text-danger">*</span></label><input type="text" class="form-control m-input m-input--square" id="items'+count+'" name="items[]" placeholder="Enter Item Name"><span id="items_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Specifications<span class="text-danger">*</span></label><textarea class="m-input form-control" id="specification'+count+'" name="specification[]"></textarea><span id="specification_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Inspection Tools<span class="text-danger">*</span></label><textarea class="m-input form-control" id="tools'+count+'" name="tools[]"></textarea><span id="tools_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group"><label>Observation<span class="text-danger">*</span></label><textarea class="m-input form-control" id="observation'+count+'" name="observation[]"></textarea><span id="observation_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-1"><div class="form-group m-form__group"><label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px"><input type="checkbox" class="menu_checkbox" id="pass_fail'+count+'" name="pass_fail[]" value="0" onchange="changePermission(this.id,this.value);"> Pass/Fail<input type="hidden" class="menu_checkbox_hidden" id="pass_fail'+count+'hidden" name="pass_fail[]" value=0><span></span></label></div></div><div class="col-lg-1"><div class="form-group m-form__group mt_25px pull-right"><button type="button" class="btn btn-danger" onclick="remove_inspect('+count+')"><i class="fa fa-minus"></i></button></div></div></div>');

   count=Number(count)+1;
   $('#mailcount').val(count);
}

function remove_inspect(val)
{
   $('#mid'+val).remove();
}

function joborder_inspect_validation()
{
   var err = 0;
   $("div[id^='mid']").each(function(){
     var id = this.id;
     var res = id.substring(3);
     //var phone_type_id=$('#phone_type_id'+res).val();
     var item=$('#items'+res).val();
     var spec = $('#specification'+res).val();
     var tool = $('#tools'+res).val();
     var obser = $('#observation'+res).val();

       if(item==''){
         $('#items_err'+res).html('Items is required!');
         err++;
       }else{
         $('#items_err'+res).html('');
       }

       if(spec==''){
         $('#specification_err'+res).html('Specification is required!');
         err++;
       }else{
         $('#specification_err'+res).html('');
       }

       if(tool==''){
         $('#tools_err'+res).html('Inspection Tool is required!');
         err++;
       }else{
         $('#tools_err'+res).html('');
       }

       if(obser==''){
         $('#observation_err'+res).html('Observation is required!');
         err++;
       }else{
         $('#observation_err'+res).html('');
       }
   });

if(err>0){ return false; }else{ return true; }

}

function joborder_load_doc(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'joborder/joborder_load_doc',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#load_doc').empty().append(response);
}
});
}
function get_id_by_name_in_js(id,table_name,name_col,id_col)
{
   var return_name = '';
   if (id != '') {
      $.ajax({
        url:baseurl+'Leads/get_id_by_name_in_js',
        type:'POST',
        data:{'id':id,'table_name':table_name,'name_col':name_col,'id_col':id_col},
        dataType: 'html',
        async:false,
        success:function(result){
           return_name = result;
        }
      });
   }
   else {
      return_name = 'All';   
   }
   return return_name;
}
function jo_export_items()
{
  var quarter = $('#fquarter').val();
  var ypick = $('#ypick').val();
  var search = $('#searchChange').val();
  var dtrnge_from = $('#dtrange_from').val();
  var dtrnge_to = $('#dtrange_to').val();
  var dtrnge = dtrnge_from+' - '+dtrnge_to;
  var fbase = $('#fbase').val();
  var jo_sales_user = $('#user_id').val();
  var jo_sales_user_name = get_id_by_name_in_js(jo_sales_user,'users','name','user_id');

  $('#exp_jo_filt_year').empty().append(ypick);
  $('#exp_jo_filt_year_val').empty().val(ypick);

  $('#exp_jo_filt_quarter').empty().append(quarter);
  $('#exp_jo_filt_quarter_val').empty().val(quarter);

  $('#exp_jo_filt_search').empty().append(search);
  $('#exp_jo_filt_search_val').empty().val(search);

  $('#exp_jo_filt_dtrng').empty().append(dtrnge);
  $('#exp_jo_filt_dtrng_val').empty().val(dtrnge);

  $('#exp_jo_filt_user').empty().append(jo_sales_user_name);
  $('#exp_jo_filt_user_val').empty().val(jo_sales_user);

  $('#quarter_or_range').empty().val(fbase);

   $('#jo_export_model').modal('show');
}
function toggle(source) {
      
   checkboxes = document.getElementsByClassName('jo_export');
   for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
   }
}
</script>


   </body>

   <!-- end::Body -->
</html>