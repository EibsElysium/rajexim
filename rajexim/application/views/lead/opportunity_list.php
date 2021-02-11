<?php
 $this->load->view('common_header'); 
 $date_format =common_date_format();?>
 
   <style type="text/css">
   .tag {
   display: inline-block;
  
  width: auto;
   height: 38px;
   
   background-color: #ffd24d;
   -webkit-border-radius: 3px 4px 4px 3px;
   -moz-border-radius: 3px 4px 4px 3px;
   border-radius: 3px 4px 4px 3px;
   border-left: 1px solid #ffd24d;
   /* This makes room for the triangle */
   margin-left: 19px;
   position: relative;
   color: #39474E;
   font-weight: 300;
   font-family: 'Source Sans Pro', sans-serif;
   font-size: 18px;
   line-height: 38px;
   padding: 0 10px 0 10px;
}

/* Makes the triangle */
.tag:before {
   content: "";
   position: absolute;
   display: block;
   right: -17px;
   width: 0;
   height: 0;
   border-top: 19px solid transparent;
   border-bottom: 19px solid transparent;
   border-left: 19px solid #ffd24d;
}

/* Makes the circle */
.tag:after {
   content: "";
   background-color: white;
   border-radius: 50%;
   width: 4px;
   height: 4px;
   display: block;
   position: absolute;
   left: -9px;
   top: 17px;
}

.tag_fup {
   display: inline-block;
  
  width: auto;
   height: 22px;
   
   background-color: #ffd24d;
  /* -webkit-border-radius: 3px 4px 4px 3px;
   -moz-border-radius: 3px 4px 4px 3px;*/
   border-radius: 3px 4px 4px 3px;
   
   border-left: 1px solid #ffd24d;

   /* This makes room for the triangle */
   /*margin-left: 19px;*/
   
   position: relative;
   
   color: #39474E;
   font-weight: 300;
  /* font-family: 'Source Sans Pro', sans-serif;
   font-size: 12px;*/
   line-height: 23px;

   /*padding: 0 10px 0 10px;*/
   padding: 0 0 0 0;
}

/* Makes the triangle */
.tag_fup:before {
   content: "";
   position: absolute;
   display: block;
   right: -17px;
   width: 0;
   height: 0;
   border-top: 12px solid transparent;
   border-bottom: 12px solid transparent;
   border-left: 19px solid #ffd24d;
}

/* Makes the circle */
.tag_fup:after {
   content: "";
   background-color: white;
   border-radius: 50%;
   width: 4px;
   height: 4px;
   display: block;
   position: absolute;
   left: -9px;
   top: 17px;
}
table.table p {
                /*display: none;*/
                visibility: hidden;margin-bottom: 0;
               }
         table.table tr:hover p {
                                  /* display: block;*/
                                   visibility: visible;
                                 }
.lead_table td{
    border-top: solid 1px #ebebeb;
    border-spacing:none;
    cellpadding: 0;
    cellspacing: 0;
    color: #3D3D3D;
    padding: 0px 4px 0px 4px;
    margin-left: 3px !important; 

}
.lead_table td .contact_info{
    white-space: nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
    min-width:47px;
}
.breadcrumb_fonts {
   font-size: 12px !important;
}
.m-portlet .m-portlet__body {
    padding: 0.2rem 2.2rem !important;
}
.tr_size{
   height: 10px !important;
}
.m-subheader {
    padding: 0px 15px 0 15px;
}
.m-body .m-content {
    padding: 0px 15px;
}
.btn.m-btn--custom {
    padding: 5px 12px !important;
}
.m-portlet .m-portlet__head {
    height: 43px !important;
}
.lead_modi_info {
   padding: 1px !important;
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
                                 <i class="m-nav__link-icon fa fa-home breadcrumb_fonts"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right breadcrumb_fonts"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text breadcrumb_fonts">Opportunity</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right breadcrumb_fonts"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>Leads/<?php 
                                          if($tab_val == 1)
                                          {
                                             echo 'opportunity_list?active_tab=1';
                                          }else if($tab_val == 2)
                                          {
                                              echo 'converted_leads?active_tab=2';
                                          }
                                          else{
                                             echo '';
                                          } ?>" class="m-nav__link">
                                 <span class="m-nav__link-text breadcrumb_fonts"><?php
                                          if($tab_val == 1)
                                          {
                                             echo 'Opportunity';
                                          }else if($tab_val == 2)
                                          {
                                              echo 'Converted';
                                          }
                                          else{
                                             echo '';
                                          }
                                       ?> Lead List</span>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>

               <!-- END: Subheader -->
               <div class="m-content">
                  <!-- <div class="row">
                     <div class="col-md-12">
                         <div style="margin-bottom:2.2rem;">
                              <ul class="que_sett">
                                 <li class="<?php if($tab_val == 1 || $tab_val == ''){ echo 'active'; }else{ echo ''; } ?>"><a href="<?php echo base_url(); ?>opportunity_leads?active_tab=1">Opportunity List</a></li>
                                 <li class="<?php if($tab_val == 2 || $tab_val == ''){ echo 'active'; }else{ echo ''; } ?>" ><a href="<?php echo base_url(); ?>converted_leads?active_tab=2">Converted List</a></li>
                              </ul>
                        </div>
                     </div>
                  </div> -->
                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile " style="background-color: #fff2e6;">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">

                                       <?php
                                          if($tab_val == 1)
                                          {
                                             echo 'Opportunity';
                                          }else if($tab_val == 2)
                                          {
                                              echo 'Converted';
                                          }
                                          else{
                                             echo '';
                                          }
                                       ?>
                                     List
                                       <?php  if($lead_today_fup_count->today_followups > 0 && $tab_val == 1) { ?>
                                          <a href="<?php echo base_url(); ?>Leads?t_fup=1"><span class="tag">Today's Followup - <?php echo 
                                      $lead_today_fup_count->today_followups; ?></span></a>
                                       <?php }else{ } ?>
                                    </h3>

                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <!-- <li class="m-portlet__nav-item">
                                       <div class="form-group m-form__group">
                                          <button class="btn btn-primary" id="tog_filter">
                                             <i class="la la-filter"></i>&nbsp;&nbsp;Advanced
                                          </button>
                                       </div>
                                    </li> -->
                                   
                                 <?php if($_SESSION['Lead ManagementAdd'] == 1){ ?>
                                 <?php if($tab_val == 1){ ?>
                                 <li class="m-portlet__nav-item">
                                    <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" onclick="bulk_import();">
                                       <span>
                                          <i class="fa fa-file-import"></i>
                                          <span>Bulk Import</span>
                                       </span>
                                    </a>
                                 </li>
                                 <?php } ?>
                              <?php } ?>
                             </ul>
                          </div>
                              <div class="m-portlet__head-tools">
                                <ul class="m-portlet__nav">
                                  <li class="m-portlet__nav-item">
                                    <div class="form-group m-form__group">
                                       <select class="form-control" style="height: 30px;margin-top: 18px;width: 150px;padding: 6px;" onchange="submit_lead_form('filter');" name="filter_templates" id="filter_templates" >
                                          <option value="">Choose Templates</option>
                                             <?php
                                                if(!empty($get_all_oppo_template))
                                                {
                                                   foreach ($get_all_oppo_template as  $lead_template) { if($lead_template->status == 0){ ?>
                                                      <option value="<?php echo $lead_template->filter_template; ?>"><?php echo $lead_template->filter_template_name; ?></option>
                                                   <?php } }
                                                }
                                             ?>
                                       </select>
                                    </div>
                                  </li>
                                  <li class="m-portlet__nav-item">
                                     <div class="pull-right">
                                        <div class="form-group m-form__group mt_25px">
                                           <button class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" id="tog_filter">
                                              <i class="la la-filter"></i>&nbsp;&nbsp;Filters
                                           </button>
                                        </div>
                                     </div>
                                  </li> 
                                  <li class="m-portlet__nav-item">
                                     <a href="javascript:;" onclick="lead_export_items();generate_reports();" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" style="margin-top: 12px;">
                                        <span>
                                           <i class="fa fa-file-export"></i>
                                           <span>Generate Report</span>
                                        </span>
                                     </a>
                                  </li>
                                </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">

                              <div class="alert alert-success alert-dismissible fade show" role="alert" id="add_template_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Opportunity Filter Template has been Added successfully.
                              </div>

                              <div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Opportunity Lead has been activated successfully.
                              </div>
                              <div class="alert alert-success alert-dismissible fade show" role="alert" id="convert_to_lead_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Opportunity has been Converted into Lead successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Opportunity Lead has been deactivated successfully.
                              </div>

                              <?php if($this->session->flashdata('l_success')){?>
                                   <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('l_success'); ?>
                                 </div>
                                 <?php } ?>

                              <?php if($this->session->flashdata('l_err')){?>
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('l_err'); ?>
                                 </div>
                                 <?php } ?>
                              <!--begin: Datatable -->

                              <?php 
                              $link = '';
                              if($tab_val == 1)
                              {
                                 $link = 'opportunity_leads?active_tab=1';
                              }else if($tab_val == 2)
                              {
                                  $link = 'opportunity_leads?active_tab=2';
                              }
                              else{
                                 $link = 'opportunity_leads?active_tab=1';
                              }

                              ?>
                              <div class="my_filter"  style="display: none;">
                                <div class="row">
                                    <div class="col-lg-12">
                                       <form name="lead_filter_form" id="lead_filter_form" action="<?php echo base_url().$link; ?>" method="POST">   

                                    <div class="row">
                                       
                                       <!-- <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Product</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_product[]" multiple id="list_product">
                                                <option value="">All Product</option>
                                                   <?php
                                                      if(!empty($product_lists))
                                                      {
                                                         foreach ($product_lists as  $product_list) { if($product_list->status == 0){ ?>
                                                            <option value="<?php echo $product_list->product_id; ?>" <?php if($product_list->product_id == $list_product && $list_product != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo $product_list->product_name; ?></option>
                                                         <?php } }
                                                      }
                                                   ?>
                                             </select>
                                          </div>
                                       </div> -->
                                       <!-- <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Priority</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_lead_type" id="list_lead_type">
                                                <option value="">All Priority</option>
                                                   <?php
                                                      if(!empty($lead_type_lists))
                                                      {
                                                         foreach ($lead_type_lists as $lead_type) { if($lead_type->status == 0){ ?>
                                                            <option value="<?php echo $lead_type->lead_type_id; ?>" <?php if($lead_type->lead_type_id == $list_lead_type && $list_lead_type != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo $lead_type->lead_type; ?></option>
                                                         <?php } }
                                                      }
                                                   ?>
                                             </select>
                                          </div>
                                       </div> -->
                                       <!-- <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Lead Source</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_lead_source" name="list_lsource" onchange="get_sub_lead_source_by_ls_id_for_filt();">
                                                <option value="">All Lead Source</option>
                                                <?php
                                                   if(!empty($lead_source_lists))
                                                   {
                                                      foreach ($lead_source_lists as  $lead_source) { if($lead_source->status == 0) { ?>
                                                         <option value="<?php echo $lead_source->lead_source_id; ?>" <?php if($lead_source->lead_source_id == $list_lead_source && $list_lead_source != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo $lead_source->lead_source; ?></option>
                                                      <?php } }
                                                   }
                                                ?>
                                             </select>
                                          </div>
                                       </div> -->
                                       <!-- <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Sub Lead Source</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_lead_source" id="list_sub_lead_source">
                                                <option value="">All Sub Lead Source</option>
                                               
                                             </select>
                                          </div>
                                       </div> -->
                                       <!-- <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Country</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_lead_country" id="list_lead_country">
                                                <option value="">All Country</option>
                                                <?php
                                                   if(!empty($country_lists))
                                                   {
                                                      foreach ($country_lists as $country_list) {  ?>
                                                         <option <?php echo($selected_country != '' && $selected_country == $country_list->id) ? 'selected' : ''; ?> value="<?php echo $country_list->id; ?>"><?php echo $country_list->name; ?></option>
                                                      <?php } 
                                                   }
                                                ?>
                                             </select>
                                          </div>
                                       </div> -->
                                       <!-- <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Opportunity Status</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_lead_status" id="list_lead_status" >
                                                <option value="">All Opportunity Status</option>
                                                <?php
                                                   if(!empty($oppo_status_lists))
                                                   {
                                                      foreach ($oppo_status_lists as  $oppo_status_list) { if($oppo_status_list->status == 0){ ?>
                                                         <option value="<?php echo $oppo_status_list->oppo_status_id; ?>" <?php if($oppo_status_list->oppo_status_id == $list_lead_status && $list_lead_status != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo
                                                          $oppo_status_list->oppo_status; ?></option>
                                                      <?php } }
                                                   }
                                                ?>
                                             </select>
                                          </div>
                                       </div> -->
                                    </div>
                                    
                                    <div class="row">
                                       <!-- <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Assigned to</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="filt_assign_to[]" multiple id="filt_assign_to">
                                                <option value="">All Assigned to</option>
                                                <?php
                                                   if(!empty($assigned_user_lists))
                                                   {
                                                      foreach ($assigned_user_lists as  $assigned_user_list) { ?>
                                                         <option value="<?php echo $assigned_user_list->user_id; ?>"><?php echo $assigned_user_list->name; ?></option>
                                                      <?php } 
                                                   }
                                                ?>
                                             </select>
                                          </div>
                                       </div> -->
                                       <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Month</label>
                                             <input type="text" class="form-control year" placeholder="Enter Month" name="l_year" id="l_year" value="">
                                          </div>
                                       </div>
                                       <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Date Filter</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="dtrng_or_all" id="dtrng_or_all" onchange="dtrange_wise_filt_function();">
                                                <option value="All">All</option>
                                                <option value="today">Today</option>
                                                <option value="thisweek">This Week</option>
                                                <option value="thismonth">This Month</option>
                                                <option value="thisyear">This Year</option>
                                                <option value="dtrng">Date Range</option>
                                             </select>
                                          </div>
                                       </div>
                                       
                                       <div class="col-lg-2" id="dtrng_append_block" style="display: none;min-width: 360px; ">
                                          <div class="form-group m-form__group">
                                             <label>Date Range</label>
                                             <!-- <div class='input-group pull-right' id="m_daterangepicker_3">
                                                <input type='text' oninput="change_chosen_date_format();" class="form-control m-input" readonly placeholder="Select Date Range"  
                                             name="lead_list_date" id="lead_list_date" value="<?php echo ($lead_list_date != '') ? $lead_list_date : ''; ?>"/>
                                                <div class="input-group-append">
                                                      <button class="btn btn-primary" type="button" onclick="submit_lead_form('filter');">Go</button>
                                                </div>
                                             </div> -->
                                             <div class="row">
                                                <div class="col-lg-5">
                                                   <input type="text" id="alter_dtrange_from" onblur="change_from_date_format();" name="alter_dtrange_from" placeholder="From Date" class="form-control m_datepicker_1" value="" style="width: 130px;"> 
                                                </div>
                                                <div class="col-lg-1">To</div>
                                                <div class="col-lg-5">
                                                   <input type="text" id="alter_dtrange_to" onblur="change_to_date_format();" name="alter_dtrange_to" placeholder="To Date" class="form-control m_datepicker_1" value="" style="width: 130px;">
                                                </div>
                                                
                                             </div>
                                             <input type="hidden" id="dtrange_from" name="dtrange_from" placeholder="From Date" class="form-control" value="">
                                             <input type="hidden" id="dtrange_to" name="dtrange_to" placeholder="To Date" class="form-control" value="">
                                          </div>
                                       </div>
                                       <div class="col-lg-1 mt_25px">
                                           <div class="input-group-append">
                                                 <button class="btn btn-primary" type="button" onclick="submit_lead_form('filter');">Go</button>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                       <!-- <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Date Range</label>
                                             <div class='input-group pull-right' id="m_daterangepicker_3">
                                             <input type='text' class="form-control m-input" readonly placeholder="Select Date Range"  
                                             name="lead_list_date" id="lead_list_date" value="<?php echo ($lead_list_date != '') ? $lead_list_date : ''; ?>"/>
                                                <div class="input-group-append">
                                                      <button class="btn btn-primary" type="button" onclick="submit_lead_form();">Go</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div> -->
                                       
                                    </div>
                                 
                                 </form>
                                    </div>
                                    <div class="col-lg-2">
                                       <!-- <div class="pull-right">
                                          <div class="form-group m-form__group mt_25px">
                                             <button class="btn btn-primary" id="tog_filter">
                                                <i class="la la-filter"></i>&nbsp;&nbsp;Advanced
                                             </button>
                                          </div>
                                       </div> -->
                                    </div>
                                </div>
                               
                              </div>
                             <!--  <?php if($tab_val == 1){ ?>
                                <div class="row">
                                 <div class="col-lg-4">
                                    <div class="form-group m-form__group mt_10px">
                                       <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                                          <input type="checkbox" class="menu_checkbox" onclick="select_all_leads();"> <h5>Select All Leads</h5>
                                          <span></span>
                                       </label>
                                    </div>
                                 </div>
                              </div>
                           <?php } ?> -->
                              <div class="row" id="oppo_list_table_append_block" style="display: none;"> 
                                 
                              </div>
                              <div class="row" id="oppo_list_table_append_block_loader"> 
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
         <!-- end:: Body -->
         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>
         <script src="<?php echo base_url();?>assets/demo/demo12/custom/crud/forms/widgets/bootstrap-daterangepicker.js"></script>
         <script src="<?php echo base_url(); ?>assets/demo/demo12/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->



<!--begin::Update Lead-->
<div class="container">
   <div class="modal fade" id="edit_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
   </div>
</div>
<div class="container">
   <div class="modal fade" id="lead_comments_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
   </div>
</div>
<!--End::-->

<div class="container">
   <div class="modal fade" id="follow_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
<div class="container">
   <div class="modal fade" id="follow_edit_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
<div class="container">
   <div class="modal fade" id="re_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
<div class="container">
   <div class="modal fade" id="cancel_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<div class="container">
   <div class="modal fade" id="bulk_updation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Bulk Updation</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="bulk_updation_form" id="bulk_updation_form" method="POST" action="<?php echo base_url(); ?>Leads/opportunity_bulk_updation" onsubmit="return bulk_update_validation();">
               <div class="modal-body">

                  <input type="hidden" name="bulk_lead_ids" id="bulk_lead_ids">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                              <div class="m-radio-inline">
                              <label class="m-radio m-radio--bold m-radio--success">
                              <input type="radio" name="bulk_update" value="1" id="lead_bulk_update" checked onclick="show_drop_val(1);">Bulk Update
                              <span></span>
                              </label>
                              <label class="m-radio m-radio--bold m-radio--success">
                              <input type="radio" name="bulk_update" value="2" id="lead_bulk_drop" onclick="show_drop_val(2);">Archive
                              <span></span>
                              </label>
                           </div>
                           <span id="gender_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row" id="bulk_update_div">
                    
                      <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label>Lead Source</label>
                           <select class="form-control m-bootstrap-select m_selectpicker" id="bulk_lead_source" name="bulk_lead_source">
                              <option value="">Choose</option> 
                              <?php
                                 if(!empty($lead_source_lists))
                                 {
                                    foreach ($lead_source_lists as $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                       <option value="<?php echo $lead_source_list->lead_source_id; ?>"><?php echo $lead_source_list->lead_source; ?></option>
                                    <?php } }
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
                   
                     <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label>Assigned To</label>
                           <select class="form-control m-bootstrap-select m_selectpicker" id="bulk_lead_assigned_to" name="bulk_lead_assigned_to">
                              <option value="">Choose</option> 
                             <?php
                                 if(!empty($assigned_user_lists))
                                 {
                                    foreach ($assigned_user_lists as  $assigned_user_list) { ?>
                                       <option value="<?php echo $assigned_user_list->user_id; ?>"><?php echo $assigned_user_list->name; ?></option>
                                    <?php } 
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Reason<span class="text-danger">*</span></label>
                           <textarea class="form-control" id="bulk_reason" name="bulk_reason" placeholder="Enter Reason"></textarea>
                           <span id="bulk_reason_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="modal-footer">
                 <span class="text-danger" id="bulk_edit_err_msg"></span>  <button type="submit" class="btn btn-primary">Save Changes</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </form>

         </div>
      </div>
   </div>
</div>

<!--end::Modal-->
<div class="container">
   <div class="modal fade" id="remove_opportunity_updation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Opportunity To Lead Update</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
               <div class="modal-body">
                  <input type="hidden" name="opp_lead_id" id="opp_lead_id">
                  <h5>Are You Sure You Want to Remove this lead from opportunity?</h5>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Reason<span class="text-danger">*</span></label>
                           <textarea class="form-control" id="opp_reason" name="opportunity_reason" placeholder="Enter Reason"></textarea>
                           <span id="opp_reason_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group m-form__group">
                       <label>Lead Status</label>
                       <select class="form-control m-bootstrap-select m_selectpicker" id="oppo_to_lead_lead_status" name="oppo_to_lead_lead_status">
                          <option value="">Choose</option> 
                         <?php
                             if(!empty($lead_status_lists))
                             {
                                foreach ($lead_status_lists as  $lead_status_list) { ?>
                                   <option value="<?php echo $lead_status_list->lead_status_id; ?>"><?php echo $lead_status_list->lead_status; ?></option>
                                <?php } 
                             }
                          ?>
                       </select>
                       <p class="text-danger" id="oppo_to_lead_lead_status_err"></p>
                    </div>
               </div>
               
               <div class="modal-footer">
                 <button type="button" class="btn btn-primary" onclick="opportunity_update(0, 'status');">Yes</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               </div>
            </form>

         </div>
      </div>
   </div>
</div>

<div class="container">
   <div class="modal fade" id="save_filter_template" data-keyboard="false" data-backdrop = "static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Save Filter Template</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?php echo base_url(); ?>Leads/update_lead_mails_import" method="POST">
               <div class="modal-body">
                  <div class="form-group m-form__group">
                     <label>Filter Template Name</label>
                     <input type="text" class="form-control m-input m-input--square" placeholder="Enter Filter Template Name" id="fiter_template_name" name="fiter_template_name">
                     <span class="text-danger" id="fiter_template_name_err"></span>
                  </div>
                  <input type="hidden" name="is_filter_template" id="is_filter_template" value="0">
               </div>
               
               <div class="modal-footer">
                 <button type="button" onclick="if($('#fiter_template_name').val() != ''){ $('#is_filter_template').val('1');submit_lead_form('filter');$('#is_filter_template').val('0');$('#fiter_template_name').val(''); $('#fiter_template_name_err').html(''); $('#save_filter_template').modal('toggle'); $('#add_template_success').show(); setTimeout(function() { $('#add_template_success').hide('slow') }, 3000); }else { $('#fiter_template_name_err').html('Filter Template Name is required!'); }" class="btn btn-primary">Yes</button>
                 <button type="button" onclick="$('#is_filter_template').val('0');$('#fiter_template_name').val('');submit_lead_form('filter');" class="btn btn-secondary" data-dismiss="modal">No</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="container">
   <div class="modal fade" id="bulk_import" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop = "static" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<div class="container">
   <div class="modal fade" id="lead_export_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Export Opportunity Info</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
           
               <!-- <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <h3>Filter By<span class="text-danger"></span></h3>
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Date Month :</label>
                                      <input type="hidden" name="exp_lead_filt_month_val" id="exp_lead_filt_month_val">
                                      <span id="exp_lead_filt_month"></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Country Name :</label>
                                      <input type="hidden" name="exp_lead_filt_country_val" id="exp_lead_filt_country_val">
                                      <span id="exp_lead_filt_country"><?php echo column_name_by_id('ad_countries', 'id', $selected_country, 'name'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Product :</label>
                                      <input type="hidden" name="exp_lead_filt_product_val" id="exp_lead_filt_product_val">
                                      <span id="exp_lead_filt_product"><?php echo column_name_by_id('products', 'product_id', $list_product, 'product_name'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Priority :</label>
                                      <input type="hidden" name="exp_lead_filt_priority_val" id="exp_lead_filt_priority_val">
                                      <span id="exp_lead_filt_priority"><?php echo column_name_by_id('lead_type', 'lead_type_id', $list_lead_type, 'lead_type'); ?></span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Lead Source :</label>
                                      <input type="hidden" name="exp_lead_filt_ls_val" id="exp_lead_filt_ls_val">
                                      <span id="exp_lead_filt_ls"><?php echo column_name_by_id('lead_type', 'lead_type_id', $list_lead_source, 'lead_type'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Lead Status :</label>
                                      <input type="hidden" name="exp_lead_filt_lst_val" id="exp_lead_filt_lst_val">
                                      <span id="exp_lead_filt_lst"><?php echo column_name_by_id('lead_status', 'lead_status_id', $list_lead_status, 'lead_status'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Assigned To :</label>
                                      <input type="hidden" name="exp_lead_filt_ass_to_val" id="exp_lead_filt_ass_to_val">
                                      <span id="exp_lead_filt_ass_to"><?php echo column_name_by_id('users', 'user_id', $selected_lead_ass, 'name'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Date Range Wise :</label>
                                      <input type="hidden" name="exp_lead_filt_dtrng_val" id="exp_lead_filt_dtrng_val">
                                      <span id="exp_lead_filt_dtrng">Hot</span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_lead_name" class = "lead_export" name="oppo_export[]" value="Lead Name"><label class="label" for="exp_lead_name">Lead Name</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_coountry_name" class = "lead_export" name="oppo_export[]" value="Country"><label class="label" for="exp_coountry_name">Country Name</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="exp_company_name" class = "lead_export" name="oppo_export[]" value="Company Name"><label class="label" for="exp_company_name">Company Name</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="exp_designation" class = "lead_export" name="oppo_export[]" value="Designation"><label class="label" for="exp_designation">Designation</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="exp_website" class = "lead_export" name="oppo_export[]" value="Website"><label class="label" for="exp_website">Website</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_address" class = "lead_export" name="oppo_export[]" value="Address"><label class="label" for="exp_address">Address</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_email_id" class = "lead_export" name="oppo_export[]" value="Email ID"><label class="label" for="exp_email_id">Email ID</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_alter_email" class = "lead_export" name="oppo_export[]" value="Alter Email ID"><label class="label" for="exp_alter_email">Alter Email ID</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="exp_skype" class = "lead_export" name="oppo_export[]" value="Skype ID"><label class="label" for="exp_skype">Skype</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_contact" class = "lead_export" name="oppo_export[]" value="Contact No"><label class="label" for="exp_contact">Contact No</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="exp_what_no" class = "lead_export" name="oppo_export[]" value="Whatsapp No"><label class="label" for="exp_what_no">Whats App No</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="exp_off_phno" class = "lead_export" name="oppo_export[]" value="Office No"><label class="label" for="exp_off_phno">Office No</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="exp_about_lead" class = "lead_export" name="oppo_export[]" value="Message"><label class="label" for="exp_about_lead">Message</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_ls_id" class = "lead_export" name="oppo_export[]" value="Lead Source"><label class="label" for="exp_ls_id">Lead Source</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="exp_lead_take" class = "lead_export" name="oppo_export[]" value="Lead Taken By"><label class="label" for="exp_lead_take">Lead Taken By</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_ass_to" class = "lead_export" name="oppo_export[]" value="Lead Assigned To"><label class="label" for="exp_ass_to">Lead Assigned To</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_l_st" class = "lead_export" name="oppo_export[]" value="Lead Status"><label class="label" for="exp_l_st">Lead Status</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_l_type" class = "lead_export" name="oppo_export[]" value="Lead Type"><label class="label" for="exp_l_type">Lead Type</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_pro" class = "lead_export" name="oppo_export[]" value="Product"><label class="label" for="exp_pro">Product</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" id="exp_indus" class = "lead_export" name="oppo_export[]" value="Industry"><label class="label" for="exp_indus">Industry</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3">
                        <div class="bank m-checkbox-inline">
                           <label class="m-checkbox">
                             <input type="checkbox" checked id="exp_cre_on" class = "lead_export" name="oppo_export[]" value="Created On"><label class="label" for="exp_cre_on">Created On</label>
                             <span></span>
                           </label>
                        </div>
                     </div>
                  </div>

               </div> -->

               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <h3>Filter By<span class="text-danger"></span></h3>
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Date Month :</label>
                                      
                                      <span id="exp_lead_filt_month"></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Country Name :</label>
                                      
                                      <span id="exp_lead_filt_country"><?php echo (column_name_by_id('ad_countries', 'id', $selected_country, 'name') == '') ? 'All' : column_name_by_id('ad_countries', 'id', $selected_country, 'name'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Product :</label>
                                      
                                      <span id="exp_lead_filt_product"><?php echo (column_name_by_id('products', 'product_id', $list_product, 'product_name') == '') ? 'All' : column_name_by_id('products', 'product_id', $list_product, 'product_name'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Priority :</label>
                                      
                                      <span id="exp_lead_filt_priority"><?php echo (column_name_by_id('lead_type', 'lead_type_id', $list_lead_type, 'lead_type')=='') ? 'All' : column_name_by_id('lead_type', 'lead_type_id', $list_lead_type, 'lead_type'); ?></span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Lead Source :</label>
                                      <span id="exp_lead_filt_ls"><?php echo (column_name_by_id('lead_type', 'lead_type_id', $list_lead_source, 'lead_type')=='') ? 'All' : column_name_by_id('lead_type', 'lead_type_id', $list_lead_source, 'lead_type'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Lead Status :</label>
                                      <span id="exp_lead_filt_lst"><?php echo (column_name_by_id('lead_status', 'lead_status_id', $list_lead_status, 'lead_status')=='') ? 'All' : column_name_by_id('lead_status', 'lead_status_id', $list_lead_status, 'lead_status'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Assigned To :</label>
                                      
                                      <span id="exp_lead_filt_ass_to"><?php echo (column_name_by_id('users', 'user_id', $selected_lead_ass, 'name')=='') ? 'All' : column_name_by_id('users', 'user_id', $selected_lead_ass, 'name'); ?></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="">
                                    <label class="">
                                      <label class="label" style="color: #2D4A89;">Date Range Wise :</label>
                                      
                                      <span id="exp_lead_filt_dtrng"></span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="m-accordion m-accordion--bordered" id="m_accordion_2" role="tablist">
                              <div class="m-accordion__item">
                                 <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_2_item_1_head" data-toggle="collapse" href="#m_accordion_2_item_1_body" aria-expanded="false">
                                    <span class="m-accordion__item-title">List</span>
                                    <span class="m-accordion__item-mode"></span>
                                 </div>
                                 <div class="m-accordion__item-body collapse" id="m_accordion_2_item_1_body" role="tabpanel" aria-labelledby="m_accordion_2_item_1_head" data-parent="#m_accordion_2" style="">
                                    <div class="m-accordion__item-content">
                                       <div class="container">
                                          <form action="<?php echo base_url(); ?>Leads/export_oppo_info" method="POST">

                                             <input type="hidden" name="exp_lead_filt_month_val" id="exp_lead_filt_month_val">
                                             <input type="hidden" name="exp_lead_filt_country_val" id="exp_lead_filt_country_val">
                                             <input type="hidden" name="exp_lead_filt_product_val" id="exp_lead_filt_product_val">
                                             <input type="hidden" name="exp_lead_filt_priority_val" id="exp_lead_filt_priority_val">
                                             <input type="hidden" name="exp_lead_filt_ls_val" id="exp_lead_filt_ls_val">
                                             <input type="hidden" name="exp_lead_filt_lst_val" id="exp_lead_filt_lst_val">
                                             <input type="hidden" name="exp_lead_filt_ass_to_val" id="exp_lead_filt_ass_to_val">
                                             <input type="hidden" name="exp_lead_filt_dtrng_val" id="exp_lead_filt_dtrng_val">
                                             <div class="bank m-checkbox-inline">
                                                <label class="m-checkbox">
                                                  <input type="checkbox" onclick="toggle(this)"><label class="label">Select All</label>
                                                  <span></span>
                                                </label>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" checked id="exp_lead_name" class = "lead_export" name="oppo_export[]" value="Lead Name"><label class="label" for="exp_lead_name">Lead Name</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" checked id="exp_coountry_name" class = "lead_export" name="oppo_export[]" value="Country"><label class="label" for="exp_coountry_name">Country Name</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_company_name" class = "lead_export" name="oppo_export[]" value="Company Name"><label class="label" for="exp_company_name">Company Name</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_designation" class = "lead_export" name="oppo_export[]" value="Designation"><label class="label" for="exp_designation">Designation</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_website" class = "lead_export" name="oppo_export[]" value="Website"><label class="label" for="exp_website">Website</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" checked id="exp_address" class = "lead_export" name="oppo_export[]" value="Address"><label class="label" for="exp_address">Address</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" checked id="exp_email_id" class = "lead_export" name="oppo_export[]" value="Email ID"><label class="label" for="exp_email_id">Email ID</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_alter_email" class = "lead_export" name="oppo_export[]" value="Alter Email ID"><label class="label" for="exp_alter_email">Alter Email ID</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_skype" class = "lead_export" name="oppo_export[]" value="Skype ID"><label class="label" for="exp_skype">Skype</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" checked id="exp_contact" class = "lead_export" name="oppo_export[]" value="Contact No"><label class="label" for="exp_contact">Contact No</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_what_no" class = "lead_export" name="oppo_export[]" value="Whatsapp No"><label class="label" for="exp_what_no">Whats App No</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_off_phno" class = "lead_export" name="oppo_export[]" value="Office No"><label class="label" for="exp_off_phno">Office No</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_about_lead" class = "lead_export" name="oppo_export[]" value="Message"><label class="label" for="exp_about_lead">Message</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_ls_id" checked class = "lead_export" name="oppo_export[]" value="Lead Source"><label class="label" for="exp_ls_id">Lead Source</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_lead_take" class = "lead_export" name="oppo_export[]" value="Lead Taken By"><label class="label" for="exp_lead_take">Lead Taken By</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_ass_to" checked class = "lead_export" name="oppo_export[]" value="Lead Assigned To"><label class="label" for="exp_ass_to">Lead Assigned To</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_l_st" checked class = "lead_export" name="oppo_export[]" value="Lead Status"><label class="label" for="exp_l_st">Lead Status</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_l_type" checked class = "lead_export" name="oppo_export[]" value="Lead Type"><label class="label" for="exp_l_type">Lead Type</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" checked id="exp_pro" class = "lead_export" name="oppo_export[]" value="Product"><label class="label" for="exp_pro">Product</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_indus" class = "lead_export" name="oppo_export[]" value="Industry"><label class="label" for="exp_indus">Industry</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-3">
                                                   <div class="bank m-checkbox-inline">
                                                      <label class="m-checkbox">
                                                        <input type="checkbox" id="exp_cre_on" class = "lead_export" name="oppo_export[]" value="Created On"><label class="label" for="exp_cre_on">Created On</label>
                                                        <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-9"></div>

                                                <div class="col-lg-3">
                                                   <button type="submit" class="btn btn-primary">Export</button>
                                                </div>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              
                           </div>
                           <div class="m-accordion m-accordion--bordered" id="m_accordion_3" role="tablist">
                              <div class="m-accordion__item">
                                 <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_3_item_1_head" data-toggle="collapse" href="#m_accordion_3_item_1_body" aria-expanded="false">
                                    <span class="m-accordion__item-title">Pivot</span>
                                    <span class="m-accordion__item-mode"></span>
                                 </div>
                                 <div class="m-accordion__item-body collapse" id="m_accordion_3_item_1_body" role="tabpanel" aria-labelledby="m_accordion_3_item_1_head" data-parent="#m_accordion_3" style="">
                                    <form action="<?php echo base_url(); ?>Leads/oppo_pivot_report_generate" method="POST" onsubmit="return pivot_report_validation();" target="_blank">
                                      <input type="hidden" name="pivot_exp_lead_filt_month_val" id="pivot_exp_lead_filt_month_val">
                                       <input type="hidden" name="pivot_exp_lead_filt_country_val" id="pivot_exp_lead_filt_country_val">
                                       <input type="hidden" name="pivot_exp_lead_filt_product_val" id="pivot_exp_lead_filt_product_val">
                                       <input type="hidden" name="pivot_exp_lead_filt_priority_val" id="pivot_exp_lead_filt_priority_val">
                                       <input type="hidden" name="pivot_exp_lead_filt_ls_val" id="pivot_exp_lead_filt_ls_val">
                                       <input type="hidden" name="pivot_exp_lead_filt_lst_val" id="pivot_exp_lead_filt_lst_val">
                                       <input type="hidden" name="pivot_exp_lead_filt_ass_to_val" id="pivot_exp_lead_filt_ass_to_val">
                                       <input type="hidden" name="pivot_exp_lead_filt_dtrng_val" id="pivot_exp_lead_filt_dtrng_val">
                                       <div class="m-accordion__item-content">
                                          <div class="container">
                                             <div class="row">
                                                <div class="col-lg-6">
                                                   <div class="form-group m-form__group">
                                                      <label>Left Side Column</label>
                                                         <div class="m-radio-inline">
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success"> 
                                                                  <input type="radio" name="pivot_left" id="left_country" value="cb.country" required>Country
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_left" id="left_lead_source" value="l.lead_source_id" required>Lead Source 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_left" id="left_product" value="l.product_id" required>Product 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_left" id="left_users" value="l.lead_assigned_to" required>User 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_left" id="left_lstatus" value="l.lead_status_id" required>Lead Status 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_left" id="left_ltype" value="l.lead_type_id" required>Lead Type 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      <span class="text-danger pivot_err"></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group m-form__group">
                                                      <label>Top Columns</label>
                                                         <div class="m-radio-inline">
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success"> 
                                                                  <input type="radio" name="pivot_top" id="top_country" value="cb.country" required>Country
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_top" id="top_lead_source" value="l.lead_source_id" required>Lead Source 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_top" id="top_product" value="l.product_id" required>Product 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_top" id="top_users" value="l.lead_assigned_to" required>User 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_top" id="top_lstatus" value="l.lead_status_id" required>Lead Status 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="pivot_top" id="top_ltype" value="l.lead_type_id" required>Lead Type 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      <span class="text-danger pivot_err"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="text-right">
                                                <button type="submit" class="btn btn-primary">Generate</button>
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <div class="m-accordion m-accordion--bordered" id="m_accordion_4" role="tablist">
                              <div class="m-accordion__item">
                                 <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_4_item_1_head" data-toggle="collapse" href="#m_accordion_4_item_1_body" aria-expanded="false">
                                    <span class="m-accordion__item-title">Graph</span>
                                    <span class="m-accordion__item-mode"></span>
                                 </div>
                                 <div class="m-accordion__item-body collapse" id="m_accordion_4_item_1_body" role="tabpanel" aria-labelledby="m_accordion_4_item_1_head" data-parent="#m_accordion_4" style="">
                                    <form action="<?php echo base_url(); ?>Leads/oppo_graph_report_generate" method="POST"  target="_blank" onsubmit="return graph_report_validation();">
                                      <input type="hidden" name="graph_exp_lead_filt_month_val" id="graph_exp_lead_filt_month_val">
                                       <input type="hidden" name="graph_exp_lead_filt_country_val" id="graph_exp_lead_filt_country_val">
                                       <input type="hidden" name="graph_exp_lead_filt_product_val" id="graph_exp_lead_filt_product_val">
                                       <input type="hidden" name="graph_exp_lead_filt_priority_val" id="graph_exp_lead_filt_priority_val">
                                       <input type="hidden" name="graph_exp_lead_filt_ls_val" id="graph_exp_lead_filt_ls_val">
                                       <input type="hidden" name="graph_exp_lead_filt_lst_val" id="graph_exp_lead_filt_lst_val">
                                       <input type="hidden" name="graph_exp_lead_filt_ass_to_val" id="graph_exp_lead_filt_ass_to_val">
                                       <input type="hidden" name="graph_exp_lead_filt_dtrng_val" id="graph_exp_lead_filt_dtrng_val">
                                    <div class="m-accordion__item-content">
                                       <div class="container">
                                        <div class="row">
                                                <div class="col-lg-12">
                                                   <div class="form-group m-form__group">
                                                      <label>Export As Line Chart or Bar Chart</label>
                                                      
                                                         <div class="m-radio-inline">
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success"> 
                                                                  <input type="radio" name="exp_method" id="exp_meth_line" value="line" required>Line
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="exp_method" id="exp_meth_bar" value="bar" required>Bar
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            
                                                         </div>
                                                      <span class="text-danger graph_err"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-6">
                                                   <div class="form-group m-form__group">
                                                      <label>Axis</label>
                                                      
                                                         <div class="m-radio-inline">
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success"> 
                                                                  <input type="radio" name="graph_left" id="yaxix_country" value="cb.country" required>Country
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_left" id="yaxix_lead_source" value="l.lead_source_id" required>Lead Source 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_left" id="yaxix_product" value="l.product_id" required>Product 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_left" id="yaxix_users" value="l.lead_assigned_to" required>User 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_left" id="yaxix_lstatus" value="l.lead_status_id" required>Lead Status 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_left" id="yaxix_ltype" value="l.lead_type_id" required>Lead Type 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      <span class="text-danger graph_err"></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-6">
                                                   <div class="form-group m-form__group">
                                                      <label>Bottom</label>
                                                         <div class="m-radio-inline">
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success"> 
                                                                  <input type="radio" name="graph_bot" id="xaxix_country" value="cb.country" required>Country
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_bot" id="xaxix_lead_source" value="l.lead_source_id" required>Lead Source 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_bot" id="xaxix_product" value="l.product_id" required>Product 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_bot" id="xaxix_users" value="l.lead_assigned_to" required>User 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_bot" id="xaxix_lstatus" value="l.lead_status_id" required>Lead Status 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                               <div class="col-lg-6">
                                                                  <label class="m-radio m-radio--bold m-radio--success">
                                                                  <input type="radio" name="graph_bot" id="xaxix_ltype" value="l.lead_type_id" required>Lead Type 
                                                                  <span></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      <span class="text-danger graph_err"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="text-right">
                                                <button type="submit" class="btn btn-primary">Generate</button>
                                             </div>
                                          </div>
                                    </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                 
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">

   var baseurl = '<?php echo base_url(); ?>';
   var tab_val = '<?php echo $tab_val; ?>';
   var tab_name = '';
   if(tab_val == 1)
   {
      tab_name = 'Opportunity';
   }
   else if(tab_val == 2)
   {
      tab_name = 'Converted';
   }
   else{
      tab_name = 'Opportunity';
   }
   var title = $('title').text() + ' | ' + tab_name + ' Lead List';
$(document).attr("title", title);

$('.year').datepicker({
        minViewMode: 1,
         todayHighlight: true,
        format: 'yyyy-M',
          autoclose: true
   });
      //modal-script
$(document).ready(function () {

 $('#openBtn').click(function () {
     $('#follow_edit').modal({
         show: true
     })
 });

$(document).on({
      'show.bs.modal': function () {
         var zIndex = 1040 + (10 * $('.modal:visible').length);
         $(this).css('z-index', zIndex);
         setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
         }, 0);
      },
      'hidden.bs.modal': function() {
         if ($('.modal:visible').length > 0) {
            // restore the modal-open class to the body element, so that scrolling works
            // properly after de-stacking a modal.
            setTimeout(function() {
               $(document.body).addClass('modal-open');
            }, 0);
         }
      }
    }, '.modal');

});
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
function dtrange_wise_filt_function() {
  var dtrng_or_all = $('#dtrng_or_all').val();
  if (dtrng_or_all == 'All') {
     $('#alter_dtrange_to').val('');
     $('#alter_dtrange_from').val('');
     $('#dtrange_from').val('');
     $('#dtrange_to').val('');
     $('#l_year').val('');
     $('#dtrng_append_block').hide();
     // submit_lead_form('filter');
  }
  else if(dtrng_or_all == 'dtrng') {
     $('#dtrng_append_block').show();
     $('#l_year').val('');
  }
  else {
       $('#alter_dtrange_to').val('');
       $('#alter_dtrange_from').val('');
       $('#dtrange_from').val('');
       $('#dtrange_to').val('');
       $('#dtrng_append_block').hide();
       $('#l_year').val('');
       // submit_lead_form();
    }
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
function generate_reports()
{
  var month_filt = $('#l_year').val();
var pro_filt = $('#list_product').val();
var l_type_filt = $('#list_lead_type').val();
var ls_filt = $('#list_lead_source').val();
var lst_filt = $('#list_lead_status').val();
var ls_country_filt = $('#list_lead_country').val();
var l_ass_filt = $('#filt_assign_to').val();
//var l_dtrange_filt = $('#lead_list_date').val();
var dtrange_from = $('#dtrange_from').val();
var dtrange_to = $('#dtrange_to').val();
$('#exp_lead_filt_month').empty().append(month_filt);
$('#exp_lead_filt_month_val').empty().val(month_filt);


// $('#exp_lead_filt_product').empty().append(pro_filt);
$('#exp_lead_filt_product_val').empty().val(pro_filt);

// $('#exp_lead_filt_priority').empty().append(l_type_filt);
$('#exp_lead_filt_priority_val').empty().val(l_type_filt);

// $('#exp_lead_filt_ls').empty().append(ls_filt);
$('#exp_lead_filt_ls_val').empty().val(ls_filt);

// $('#exp_lead_filt_lst').empty().append(lst_filt);
$('#exp_lead_filt_lst_val').empty().val(lst_filt);

// $('#exp_lead_filt_country').empty().append(ls_country_filt);
$('#exp_lead_filt_country_val').empty().val(ls_country_filt);

// $('#exp_lead_filt_ass_to').empty().append(l_ass_filt);
$('#exp_lead_filt_ass_to_val').empty().val(l_ass_filt);
$('#exp_lead_filt_product').empty().append(get_id_by_name_in_js(pro_filt,'products','product_name','product_id'));
 $('#exp_lead_filt_priority').empty().append(get_id_by_name_in_js(l_type_filt,'lead_type','lead_type','lead_type_id'));
 $('#exp_lead_filt_ls').empty().append(get_id_by_name_in_js(ls_filt,'lead_source','lead_source','lead_source_id'));
 $('#exp_lead_filt_lst').empty().append(get_id_by_name_in_js(lst_filt,'lead_status','lead_status','lead_status_id'));
 $('#exp_lead_filt_country').empty().append(get_id_by_name_in_js(ls_country_filt,'ad_countries','name','id'));
 $('#exp_lead_filt_ass_to').empty().append(get_id_by_name_in_js(l_ass_filt,'users','name','user_id'));
$('#exp_lead_filt_dtrng').empty().append(l_dtrange_filt);
if (dtrange_from != '' && dtrange_to != '') {
  $('#exp_lead_filt_dtrng_val').empty().val(dtrange_from+' - '+dtrange_to);
  var alter_dtrange_from = $('#alter_dtrange_from').val();
  var alter_dtrange_to = $('#alter_dtrange_to').val();
  $('#exp_lead_filt_dtrng').empty().append(alter_dtrange_from+' - '+alter_dtrange_to);
}
else {
  $('#exp_lead_filt_dtrng_val').empty().val('');
  $('#exp_lead_filt_dtrng').empty().append('-');  
}


   $('#pivot_exp_lead_filt_month_val').empty().val(month_filt);
   $('#pivot_exp_lead_filt_product_val').empty().val(pro_filt);
   $('#pivot_exp_lead_filt_priority_val').empty().val(l_type_filt);
   $('#pivot_exp_lead_filt_ls_val').empty().val(ls_filt);
   $('#pivot_exp_lead_filt_lst_val').empty().val(lst_filt);
   $('#pivot_exp_lead_filt_country_val').empty().val(ls_country_filt);
   $('#pivot_exp_lead_filt_ass_to_val').empty().val(l_ass_filt);
   if (dtrange_from != '' && dtrange_to != '') {
      $('#pivot_exp_lead_filt_dtrng_val').empty().val(dtrange_from+' - '+dtrange_to);
   }
   else {
      $('#pivot_exp_lead_filt_dtrng_val').empty().val('');
   }


   $('#graph_exp_lead_filt_month_val').empty().val(month_filt);
   $('#graph_exp_lead_filt_product_val').empty().val(pro_filt);
   $('#graph_exp_lead_filt_priority_val').empty().val(l_type_filt);
   $('#graph_exp_lead_filt_ls_val').empty().val(ls_filt);
   $('#graph_exp_lead_filt_lst_val').empty().val(lst_filt);
   $('#graph_exp_lead_filt_country_val').empty().val(ls_country_filt);
   $('#graph_exp_lead_filt_ass_to_val').empty().val(l_ass_filt);
   
   if (dtrange_from != '' && dtrange_to != '') {
      $('#pivot_exp_lead_filt_dtrng_val').empty().val(dtrange_from+' - '+dtrange_to);
   }
   else {
      $('#pivot_exp_lead_filt_dtrng_val').empty().val('');
   }
}
function toggle(source) {      
  checkboxes = document.getElementsByClassName('lead_export');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
function get_sub_lead_source_by_ls_id_for_filt() {
  var ls = $('#list_lead_source').val();
  $.ajax({
     url:baseurl+'Leads/get_sub_lead_source_by_ls_id',
     type:'POST',
     data:{'value':ls},
     dataType: 'html',
     success:function(result){
        $('#list_sub_lead_source').empty().append(result);
        $('.m_selectpicker').selectpicker('refresh');
     }
  });
}
function pivot_report_validation()
{
  var pivot_top = $("input[name='pivot_top']:checked").val();
  var pivot_left = $("input[name='pivot_left']:checked").val();
  var pi_err = 0;
  if (pivot_left == pivot_top) {
     $('.pivot_err').html('Chosen option should be Different...');
     pi_err++;
  }
  else {
     $('.pivot_err').html('');
  }
  if (pi_err > 0) { return false; }else { return true; }
}
function e_chk_if_email_is_blocked(val)
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/chk_lead_email_is_blocked',
      data:{'value':val},
      async: false,
      dataType: "html",
      success: function(result){
         if(result > 0)
         {
            $('#e_email_id_err').html('This email is Blocked');
            er = 1;
         }else{
            $('#e_email_id_err').html('');
            er = 0;
         }
         
      }
   });
}
function opportunity_update(val,  type_val){

   var lead_id = $('#opp_lead_id').val();
   var opp_reason = $('#opp_reason').val();
   var oppo_to_lead_lead_status = $('#oppo_to_lead_lead_status').val();
   var err = 0;
   if(opp_reason == '')
   {
      $('#opp_reason_err').html('Reason is required!');
      err++;
   }else{
      $('#opp_reason_err').html('');
   }
   if(oppo_to_lead_lead_status == '')
   {
      $('#oppo_to_lead_lead_status_err').html('Lead Status is required!');
      err++;
   }else{
      $('#oppo_to_lead_lead_status_err').html('');
   }
    if (err == 0) {
         $.ajax({
         type:'POST',
         url:baseurl+'Leads/lead_status_type_change',
         data:{'value':val, 'lead_id':lead_id, 'type_val':type_val, 'reason':opp_reason, 'oppo_to_lead_lead_status' : oppo_to_lead_lead_status},
         dataType: 'html',
         success:function(result){
            $('#remove_opportunity_updation').modal('toggle');
            $('#convert_to_lead_success').show();
            submit_lead_form('filter');
         }
      });
    }
}
function save_filt_temp()
{
   $('#save_filter_template').modal('show');
   // submit_lead_form('filter');
}
var pagecount = '';
var current_pagination_index = '';
function paginate_page(page,l_id)
{  
   current_pagination_index = l_id;
   pagecount = page;
   submit_lead_form('pagination');
}

var search_val = '';
function search_on_list(val)
{ 
    search_val = val;
    submit_lead_form('search');
}

//modal-script
submit_lead_form('filter');
function submit_lead_form(diff){
   if(diff=='pagination'){
      current_pagination_index = current_pagination_index;
   }
   else{
      current_pagination_index = 1;
   }
   if (diff == 'search' || diff == 'perpage_count') {
      pagecount = 0;
   }
   else {
      pagecount = pagecount;
   }
   $('#oppo_list_table_append_block_loader').show();
   $('#oppo_list_table_append_block').hide();
   var perpage = $('#perpage').val();

   // var l_year = $('#l_year').val();
   // var list_product = $('#list_product').val();
   // var list_lead_type = $('#list_lead_type').val();
   // var list_lead_source = $('#list_sub_lead_source').val();
   // var list_lead_country = $('#list_lead_country').val();
   // var list_lead_status = $('#list_lead_status').val();
   // var filt_assign_to = $('#filt_assign_to').val();
   // var dtrange_from = $('#dtrange_from').val();
   // var dtrange_to = $('#dtrange_to').val();
   var filter_templates = $('#filter_templates').val();
   var is_filt_temp = $('#is_filter_template').val();
   var filt_temp_name = $('#fiter_template_name').val();

   var l_year = '';
   var list_product = '';
   var list_lead_type = '';
   var list_lead_source = '';
   var list_lead_country = '';
   var list_lead_status = '';
   var filt_assign_to = '';
   var dtrange_from = '';
   var dtrange_to = '';
   var list_lsource = '';
   var dtrng_or_other = '';

    var product_sort = $('#product_sort').val();
    var country_sort = $('#country_sort').val();
    var leadsource_sort = $('#leadsource_sort').val();
    var priority_sort = $('#priority_sort').val();
    var status_sort = $('#status_sort').val();
    var user_sort = $('#user_sort').val();
    var leadname_sort = $('#leadname_sort').val();
    var created_on_sort = $('#created_on_sort').val();

   var filter_type = '';
   if(filter_templates == ''){
      l_year = $('#l_year').val();
      list_product = $('#list_product').val();
      list_lead_type = $('#list_lead_type').val();
      list_lead_source = $('#list_sub_lead_source').val();
      list_lead_country = $('#list_lead_country').val();
      list_lead_status = $('#list_lead_status').val();
      filt_assign_to = $('#filt_assign_to').val();
      dtrange_from = $('#dtrange_from').val();
      dtrange_to = $('#dtrange_to').val();
      list_lsource = $('#list_lead_source').val();
      dtrng_or_other = $('#dtrng_or_all').val();

      filter_type = '0';
   }
   else {
      $.ajax({ 
         url:baseurl+'Leads/lead_filter_template_val_split',
         type:'POST',
         async:false,
         data:{ 'filter_templates' : filter_templates },
         dataType: 'html',
         success:function(ft_res){
            var res_arr = JSON.parse(ft_res);
            l_year = res_arr.l_year;
            list_product = res_arr.list_product;
            list_lead_type = res_arr.list_lead_type;
            list_lead_source = res_arr.list_lead_source;
            list_lead_country = res_arr.list_lead_country;
            list_lead_status = res_arr.list_lead_status;
            filt_assign_to = res_arr.filt_assign_to;
            dtrange_from = res_arr.dtrange_from;
            dtrange_to = res_arr.dtrange_to;
            list_lsource = res_arr.list_lsource;

            filter_type = '1';
         }
      });
   }
   var active_tab = "<?php echo (isset($_GET['active_tab'])) ? '?active_tab='.$_GET['active_tab'] : ''; ?>";
   $.ajax({
      url:baseurl+'Leads/oppo_list_result_by_filters'+active_tab,
      type:'POST',
      data:{'l_year':l_year,'list_product':list_product,'list_lead_type':list_lead_type,'list_lead_source':list_lead_source,'list_lead_country':list_lead_country,'list_lead_status':list_lead_status,'filt_assign_to':filt_assign_to,'dtrange_from' : dtrange_from, 'dtrange_to' : dtrange_to, 'pagecount' : pagecount, 'search_val' : search_val, 'current_pagination_index' : current_pagination_index, 'perpage' : perpage, 'is_filt_temp' : is_filt_temp, 'filt_temp_name' : filt_temp_name,'filter_type' : filter_type,'list_lsource':list_lsource, 'product_sort':product_sort,'country_sort':country_sort,'leadsource_sort':leadsource_sort,'priority_sort':priority_sort,'status_sort':status_sort,'user_sort':user_sort,'leadname_sort':leadname_sort,'created_on_sort':created_on_sort,'dtrng_or_other':dtrng_or_other },
      dataType: 'html',
      success:function(result){
         $('#oppo_list_table_append_block').empty().append(result);
         $('#oppo_list_table_append_block_loader').hide();
         $('#oppo_list_table_append_block').show();
      }
   });
}


// To get product user list 
function e_product_user_list(val) 
{
   $.ajax({
      type:'POST',
      url:baseurl+'Leads/product_user_list',
      data:{'value':val},
      dataType: 'html',
      success:function(result){
         var valval = result.split("|");
         $('#e_industry_name').val(valval[1]);
         $('#e_industry_id').val(valval[2]);
         $('#e_assigned_to').empty().append(valval[0]);
         $('.m_selectpicker').selectpicker('refresh');

      }
   });
}

function lead_opportunity_modal(lead_id)
{
   $('#opp_lead_id').val(lead_id);
   $('#opportunity_lead').modal('show');
}


// To change lead type
function lead_opportunity_change(val, lead_id, type_val)
{
   $('#opp_lead_id').val(lead_id);
   $('#remove_opportunity_updation').modal('show');
}
// function opportunity_update(val,  type_val){
  
//    var lead_id = $('#opp_lead_id').val();
//    var opp_reason = $('#opp_reason').val();
//    var oppo_to_lead_lead_status = $('#oppo_to_lead_lead_status').val();
//    var err = 0;
//    if(opp_reason == '')
//    {
//       $('#opp_reason_err').html('Reason is required!');
//       err++;
//    }else{
//       $('#opp_reason_err').html('');
//    }
//    if(oppo_to_lead_lead_status == '')
//    {
//       $('#oppo_to_lead_lead_status_err').html('Lead Status is required!');
//       err++;
//    }else{
//       $('#oppo_to_lead_lead_status_err').html('');
//    }
//    if (err == 0) {
//       $.ajax({
//          type:'POST',
//          url:baseurl+'Leads/lead_status_type_change',
//          data:{'value':val, 'lead_id':lead_id, 'type_val':type_val, 'reason':opp_reason, 'lead_status':oppo_to_lead_lead_status},
//          dataType: 'html',
//          success:function(result){
//             $('#show_success').show();
//                setTimeout(function() {
//                window.location = baseurl+"Leads/opportunity_list";
//             }, 3000);
//          }
//       });
//    }
// }
// To change lead type
function lead_status_type_change(val, lead_id, type_val)
{

   var list_type_id = $('#list_type_id option:selected').text();
   var list_status_id = $('#list_status_id option:selected').text();
   $.ajax({
      type:'POST',
      url:baseurl+'Leads/lead_status_type_change',
      data:{'value':val, 'lead_id':lead_id, 'type_val':type_val},
      dataType: 'html',
      success:function(result){

         if(list_type_id == 'Hot' && list_status_id == 'Potential')
         {
            $('#opp_id').show();
         }else{
            $('#opp_id').hide();
         }
      }
   });
}
function e_get_sub_lead_source_by_ls_id() {
      var ls = $('#e_ori_lead_source').val();
      $.ajax({
         url:baseurl+'Leads/get_sub_lead_source_by_ls_id',
         type:'POST',
         data:{'value':ls},
         dataType: 'html',
         success:function(result){
            $('#e_lead_source').empty().append(result);
            $('.m_selectpicker').selectpicker('refresh');
         }
      });
   }
// To show edit lead 
function lead_edit(val)
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/opportunity_edit',
      data:{'value':val},
      async: false,
      dataType: "html",
      success: function(result){

         $('#edit_lead').empty().append(result);
         $("#edit_lead").modal('show');
      }
   });
}
function lead_fp_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'Leads/opportunity_followup_edit',
   async: false,
   type: "POST",
   data: "lead_id="+val,
   dataType: "html",
   success: function(response)
   {
   $('#follow_edit').empty().append(response);
   }
   });
}
function lead_fp_edit_status(val)
{

   $.ajax({
   type: "POST",
   url: baseurl+'Leads/opportunity_fp_edit_status',
   async: false,
   type: "POST",
   data: "id="+val,
   dataType: "html",
   success: function(response)
   {
   $('#follow_edit_status').empty().append(response);
   }
   });
}
function lead_fups_validation()
{
   var err = 0;
   var comments = $('#comments_edit').val();
   if(comments==''){
      $('#comments_edit_err').html('Comments is required!');
      err++;
   }
   else
   {
      $('#comments_edit_err').html('');
   }
   if(err>0){ return false; }else{ return true; }
}
function re_lead(val)
{

   $.ajax({
   type: "POST",
   url: baseurl+'Leads/re_lead',
   async: false,
   type: "POST",
   data: "id="+val,
   dataType: "html",
   success: function(response)
   {
   $('#re_lead').empty().append(response);
   }
   });
}
function reLead(val)
{ 

   $.ajax({
   type: "POST",
   url: baseurl+'Leads/reLead',
   async: false,
   data:"field="+val,
   success: function(response)
   {
   window.location.href = baseurl+'Leads/opportunity_list?active_tab=1';
   }
   });
}
function cancel_lead(val)
{

   $.ajax({
   type: "POST",
   url: baseurl+'Leads/opportunity_cancel_lead',
   async: false,
   type: "POST",
   data: "id="+val,
   dataType: "html",
   success: function(response)
   {
   $('#cancel_lead').empty().append(response);
   }
   });
}
function cancelLead(val)
{ 
   var reason = $('#drop_reason').val();
   if(reason != '')
   {
      $('#drop_reason_err').html('');
       $.ajax({
      type: "POST",
      url: baseurl+'Leads/opportunity_lead_delete',
      async: false,
      data:"field="+val+"&reason="+reason,
      success: function(response)
      {
      window.location.href = baseurl+'Leads/opportunity_list?active_tab=1';
      }
      });

   }else{
      $('#drop_reason_err').html('Reason is required!');
   }
  
}
var e_er = 0;
function e_email_id_unique(val) 
{
   var o_email_id = $('#o_email_id').val();
   if(o_email_id != val)
   {
       $.ajax({
         type: "POST",
         url:baseurl+'Leads/lead_email_id_exits',
         data:{'value':val},
         async: false,
         dataType: "html",
         success: function(result){
            if(result > 0)
            {
               $('#e_email_id_err').html('Email ID already exists!');
               e_er = 1;
            }else{
               e_er = 0;
            }
            
         }
      });
   }
  
}
// To validate lead form
function e_lead_validation()
{
   var err = 0;
   var lead_name = $('#e_lead_name').val();
   var company_name = $('#e_company_name').val();
   var country = $('#e_country').val();
   var designation = $('#e_designation').val();
   var website = $('#e_website').val();
   var address = $('#e_address').val();
   var email_id = $('#e_email_id').val();
   var alternative_email_id = $('#e_alternative_email_id').val();
   var website = $('#e_website').val();
   var skype_id = $('#e_skype_id').val();
   var contact_no = $('#e_contact_no').val();
   var whatsapp_no = $('#e_whatsapp_no').val();
   var office_phone_no = $('#e_office_phone_no').val();
   var product_id = $('#e_product_id').val();
   var lead_source = $('#e_lead_source').val();
   var lead_type = $('#e_lead_type').val();
   var lead_status = $('#e_lead_status').val();
   var assigned_to = $('#e_assigned_to').val();
   var message = $('#e_m_summernote_1').val();
   var lead_status = $('#e_lead_status').val();
   
   if(lead_name == '')
   {
      $('#e_lead_name_err').html('Lead Name is required!');
      err++;
   }else{
      $('#e_lead_name_err').html('');
   }  
   
   if(country == '')
   {
      $('#e_country_err').html('Country is required!');
      err++;
   }else{
      $('#e_country_err').html('');
   } 
   
   if(website != '' && !isUrlValid(website))
   {
       $('#e_website_err').html('Valid Website is required!');
      err++;
   }else{
      $('#e_website_err').html('');
   }

   if(email_id == '')
   {
         $('#e_email_id_err').html('Email ID is required!');
           err++;

   }else if(!ValidateEmail(email_id)){ 

           $('#e_email_id_err').html('Invalid Email ID!');
           err++;
   }else if(e_er > 0){

      $('#e_email_id_err').html('Email ID already exists!');
      err++;
   }
   else{
     $('#e_email_id_err').html('');
   }

   if(alternative_email_id != '' && !ValidateEmail(alternative_email_id)){ 

           $('#e_alternative_email_id_err').html('Invalid Email ID!');
           err++;
   }
   else{
     $('#e_alternative_email_id_err').html('');
   }

    if(contact_no != '' && contact_no.length!=10||contact_no=='0000000000')
    { 
        $('#e_contact_no_err').html('Contact No should be maxium 10 No!');
        err++;
    }else if(isNaN(contact_no))
    { 
        $('#e_contact_no_err').html('Invalid Contact No!');
        err++;
    }
    else{
        $('#e_contact_no_err').html('');
    }
    
   if(whatsapp_no != '' && whatsapp_no.length!=10||whatsapp_no=='0000000000')
    { 
        $('#e_whatsapp_no_err').html('Whatsapp No should be maxium 10 No!');
        err++;
    }else if(isNaN(whatsapp_no))
    { 
        $('#e_whatsapp_no_err').html('Invalid Whatsapp No!');
        err++;
    }
    else{
        $('#e_whatsapp_no_err').html('');
    }
      
   if(office_phone_no != '' && office_phone_no.length!=10||office_phone_no=='0000000000')
    { 
        $('#e_office_phone_no_err').html('Office Contact No should be maxium 10 No!');
        err++;
    }else if(isNaN(office_phone_no))
    { 
        $('#e_office_phone_no_err').html('Invalid Office Contact No!');
        err++;
    }
    else{
        $('#e_office_phone_no_err').html('');
    }
   if(product_id.trim()==''){

      $('#e_product_id_err').html('Product is required!');
      err++;
   }else{
      $('#e_product_id_err').html('');

   }

   if(lead_source.trim()==''){

      $('#e_lead_source_err').html('Lead Source is required!');
      err++;
   }else{
      $('#e_lead_source_err').html('');

   }
    if(lead_type.trim()==''){

      $('#e_lead_type_err').html('Priority is required!');
      err++;
   }else{
      $('#e_lead_type_err').html('');

   }
   if(lead_status.trim()==''){

      $('#e_lead_status_err').html('Lead Status is required!');
      err++;
   }else{
      $('#e_lead_status_err').html('');

   }
   if(assigned_to.trim()==''){

      $('#e_assigned_to_err').html('Assigned To is required!');
      err++;
   }else{
      $('#e_assigned_to_err').html('');

   }

   if(err>0){ return false; }else{ return true; }
} 

function overall_chk()
{
   $('input:checkbox').prop('checked'); 
   chkcount = $('#countchk').val();
   if($('#allchk').prop("checked") == true)
   {
      for (var i = 0; i < chkcount; i++) {
         $('#chk'+i).prop("checked", true);
      }
   }
   else
   {
      for (var i = 0; i < chkcount; i++)
      {
         $('#chk'+i).prop("checked", false);
      }
   }
}

function bulk_updation()
{
   var n = [];
   var j = 0;
   chkcount = $('#countchk').val();
   for (var i = 0; i < chkcount; i++) {
      if($('#chk'+i).prop("checked") == true){
        n[j] = $('#chk'+i).val();
        j++;
    }
   }
   if(j!=0)
   {
   var c = n + '';
      $('#bulk_lead_ids').val(c);
      $('#bulk_updation').modal('show');
   }
   else
   {
      alert("No Checkboxes Checked");
   }
}
// function select_all_leads()
// {
//    var sl = '<?php // echo trim($select_all_leads, ","); ?>';
//    $('#bulk_lead_ids').val(sl);
//    $('#bulk_updation').modal('show');
// }
function show_drop_val(val)
{
   if(val == 2)
   {
      $('#bulk_update_div').hide();
      
   }else{
      $('#bulk_update_div').show();
      
   }
}
function bulk_update_validation()
{
   var radioValue = $("input[name='bulk_update']:checked").val();
   var bulk_lead_type = $('#bulk_lead_type').val();
   var bulk_lead_source = $('#bulk_lead_source').val();
   var bulk_lead_status = $('#bulk_lead_status').val();
   var bulk_lead_assigned_to = $('#bulk_lead_assigned_to').val();
   var bulk_reason = $('#bulk_reason').val();
   
   var err = 0;

   if(radioValue == 1)
   {
      if(bulk_lead_type =='' && bulk_lead_source == '' && bulk_lead_status == '' && bulk_lead_assigned_to == '' )
      {

         $('#bulk_edit_err_msg').html('Select any option to update or drop');
         err++;
      }
      else{
          $('#bulk_edit_err_msg').html('');
       }
   }else{
      $('#bulk_edit_err_msg').html('');
   }

   if(bulk_reason =='')
   {
      $('#bulk_reason_err').html('Reason is required!');
      err++;
   }
   else{
       $('#bulk_reason_err').html('');
      $('#bulk_edit_err_msg').html('');
   }
   if(err>0) { return false; }else{ return true; }
}
function show_quick_icon(id_val, v, col)
{  
   $('#'+id_val+'_label_'+v).hide();
   $('#'+id_val+'_'+v).show();
   $('#quick_edit_'+col+'_'+v).hide();
   $('#quick_save_'+col+'_'+v).show(); 
}
function show_quick_pencil_icon(id_val, v, col)
{
   $('#quick_edit_'+col+'_'+v).show();
   $('#quick_save_'+col+'_'+v).hide();
   $('#'+id_val+'_label_'+v).show();
   $('#'+id_val+'_'+v).hide();
}
// To change lead type
function lead_status_type_change(val, lead_id, type_val, quick_val, v, col)
{
   var list_type_id = $('#list_type_id_'+v+' option:selected').text();
   var list_status_id = $('#list_status_id_'+v+'  option:selected').text();
   var list_source_id = $('#list_source_id_'+v+'  option:selected').text();
   var list_country = $('#list_country_'+v+'  option:selected').text();
   $.ajax({
      type:'POST',
      url:baseurl+'Leads/lead_status_type_change',
      data:{'value':val, 'lead_id':lead_id, 'type_val':type_val},
      dataType: 'html',
      success:function(result){

         if(type_val == 'country')
         {
            $('#'+quick_val+'_label_'+v).html(list_country);
            
         }
         else if(type_val == 'lead_source')
         {
            $('#'+quick_val+'_label_'+v).html(list_source_id);
            submit_lead_form('fitler');
         }
         else if(type_val == 'lead_type')
         {
             $('#'+quick_val+'_label_'+v).html(list_type_id);
         }
         else if(type_val == 'lead_status')
         {
            $('#'+quick_val+'_label_'+v).html(list_status_id);
         }
         else{ }
            
         $('#'+quick_val+'_label_'+v).show();
         $('#quick_edit_'+col+'_'+v).show();
         $('#quick_save_'+col+'_'+v).hide();
         $('#'+quick_val+'_'+v).hide();

         if(list_type_id == 'Hot' && list_status_id == 'Potential')
         {
            $('#opp_id_'+v).show();
         }else{
            $('#opp_id_'+v).hide();
         }
      }
   });
}
function bulk_import()
{
    $.ajax({
      type: "POST",
      url:baseurl+'Leads/oppo_bulk_import',
      async: false,
      dataType: "html",
      success: function(result){
      
         $('#bulk_import').empty().append(result);
         $("#bulk_import").modal('show');
      }
   });
}



$('#tog_filter').click(function(){
  $('.my_filter').slideToggle('slow'); 
});

var lead_source = '<?php echo $list_lead_source; ?>';
var list_lead_status = '<?php echo $list_lead_status; ?>';


if(lead_source != '' || list_lead_status != '')
{
   $('.my_filter').show(); 
}
else{
   $('.my_filter').hide(); 
}
function lead_export_items()
{
   $('#lead_export_model').modal('show');
}
function view_lead_comments(l_id)
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/get_lead_comments_by_lead_id',
      async: false,
      data: 'lead_id='+l_id+'&view_from=Opportunity',
      dataType: "html",
      success: function(result){
      
         $('#lead_comments_modal').empty().append(result);
         $("#lead_comments_modal").modal('show');
      }
   });
}

// function bulk_import()
// {
//     $.ajax({
//       type: "POST",
//       url:baseurl+'Leads/lead_bulk_import',
//       async: false,
//       dataType: "html",
//       success: function(result){
      
//          $('#bulk_import').empty().append(result);
//          $("#bulk_import").modal('show');
//       }
//    });
// }
</script>

   </body>

   <!-- end::Body -->
</html>