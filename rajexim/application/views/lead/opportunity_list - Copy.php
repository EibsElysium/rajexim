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
table.table-hover p {
                /*display: none;*/
                visibility: hidden;margin-bottom: 0;
               }
         table.table-hover tr:hover p {
                                  /* display: block;*/
                                   visibility: visible;
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
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Opportunity</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
                   <div class="row">
                     <div class="col-md-12">
                        <div style="margin-bottom:2.2rem;">
                              <ul class="que_sett">
                                 <li class="<?php if($tab_val == 1 || $tab_val == ''){ echo 'active'; }else{ echo ''; } ?>"><a href="<?php echo base_url(); ?>opportunity_leads?active_tab=1">Opportunity Leads</a></li>
                                 <li class="<?php if($tab_val == 2 || $tab_val == ''){ echo 'active'; }else{ echo ''; } ?>" ><a href="<?php echo base_url(); ?>converted_leads?active_tab=2">Converted Leads</a></li>
                              </ul>
                        </div>
                     </div>
                  </div>
                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
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
                                       List&nbsp;&nbsp;<span class="text-info"></b><?php echo (!empty($lead_lists)) ? ' - '.COUNT($lead_lists) : ''; ?></b></span>&nbsp;
                                       <?php if( $lead_today_fup_count->today_followups > 0 && $tab_val == 1) { ?>
                                          <a href="<?php echo base_url(); ?>Leads/opportunity_list?t_fup=1"><span class="tag">Today's Followup - <?php echo 
                                      $lead_today_fup_count->today_followups; ?></span></a>
                                       <?php }else if($tab_val == 2 && $today_convert_leads->lead_count > 0){ ?>
                                              <i class="fa fa-arrow-alt-circle-right"></i> &nbsp;<sapn class="text-success">Today's Converted - <?php echo 
                                      $today_convert_leads->lead_count; ?></sapn>
                                          <?php }else{ } ?>
                                    </h3>

                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                   
                                    <li class="m-portlet__nav-item">
                                       <a href="#" onclick="bulk_updation();" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" target="_blank">
                                          <span>
                                             <i class="la la-edit"></i>
                                             <span>Bulk Updation</span>
                                          </span>
                                       </a>
                                    </li>
                                 
                                   
                              <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                 <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
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
                                                   <a href="#" class="m-nav__link" id="export_print">
                                                      <i class="m-nav__link-icon la la-print"></i>
                                                      <span class="m-nav__link-text">Print</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="#" class="m-nav__link" id="export_copy">
                                                      <i class="m-nav__link-icon la la-copy"></i>
                                                      <span class="m-nav__link-text">Copy</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="#" class="m-nav__link" id="export_excel">
                                                      <i class="m-nav__link-icon la la-file-excel-o"></i>
                                                      <span class="m-nav__link-text">Excel</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="#" class="m-nav__link" id="export_csv">
                                                      <i class="m-nav__link-icon la la-file-text-o"></i>
                                                      <span class="m-nav__link-text">CSV</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="#" class="m-nav__link" id="export_pdf">
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
                              <div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Lead has been activated successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Lead has been deactivated successfully.
                              </div>

                              <div class="alert alert-warning alert-dismissible fade show" role="alert" id="oop_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Lead has been deactivated successfully.
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
                              <div class="row">
                                 <div class="col-lg-10">
                                    <form name="lead_filter_form" id="lead_filter_form" action="<?php echo base_url(); ?>Leads/opportunity_list" method="POST">   
                                 
                                       <div class="row">
                                          <div class="col-lg-4">
                                             <div class="form-group m-form__group">
                                                <label>Year</label>
                                                <input type="text" class="form-control year" placeholder="Enter Year" name="l_year" id="l_year"  onchange="submit_lead_form();" value="<?php echo ($p_year) ? $p_year : date('Y'); ?>">
                                             </div>
                                          </div>
                                          <!-- <div class="col-lg-1">
                                             <div class="form-group m-form__group">
                                                <label>Month</label>
                                                <select name="l_month" id="l_month" class="custom-select form-control" onchange="submit_lead_form();">
                                                   <option value="all" <?php if($p_month == "all"){ echo 'selected'; }else{ echo ''; } ?>>All</option>
                                                   <option value="01" <?php if($p_month == "01"){ echo 'selected'; }else{ echo ''; } ?> >Jan</option>
                                                   <option value="02" <?php if($p_month == "02"){ echo 'selected'; }else{ echo ''; } ?>>Feb</option>
                                                   <option value="03" <?php if($p_month == "03"){ echo 'selected'; }else{ echo ''; } ?>>Mar</option>
                                                   <option value="04" <?php if($p_month == "04"){ echo 'selected'; }else{ echo ''; } ?>>Apr</option>
                                                   <option value="05" <?php if($p_month == "05"){ echo 'selected'; }else{ echo ''; } ?>>May</option>
                                                   <option value="06" <?php if($p_month == "06"){ echo 'selected'; }else{ echo ''; } ?>>Jun</option>
                                                   <option value="07" <?php if($p_month == "07"){ echo 'selected'; }else{ echo ''; } ?>>July</option>
                                                   <option value="08" <?php if($p_month == "08"){ echo 'selected'; }else{ echo ''; } ?>>Aug</option>
                                                   <option value="09" <?php if($p_month == "09"){ echo 'selected'; }else{ echo ''; } ?>>Sep</option>
                                                   <option value="10" <?php if($p_month == "10"){ echo 'selected'; }else{ echo ''; } ?>>Oct</option>
                                                   <option value="11" <?php if($p_month == "11"){ echo 'selected'; }else{ echo ''; } ?>>Nov</option>
                                                   <option value="12" <?php if($p_month == "12"){ echo 'selected'; }else{ echo ''; } ?>>Dec</option>
                                                </select>
                                             </div>
                                          </div> -->
                                          <div class="col-lg-4">
                                             <div class="form-group m-form__group">
                                                <label>Product</label>
                                                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_product" id="list_product" onchange="submit_lead_form();">
                                                   <option value="">All</option>
                                                      <?php
                                                         if(!empty($product_lists))
                                                         {
                                                            foreach ($product_lists as $key => $product_list) { if($product_list->status == 0){ ?>
                                                               <option value="<?php echo $product_list->product_id; ?>" <?php if($product_list->product_id == $list_product && $list_product != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo $product_list->product_name; ?></option>
                                                            <?php } }
                                                         }
                                                      ?>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-lg-4">
                                             <div class="form-group m-form__group">
                                                <label>Priority</label>
                                                <select class="custom-select form-control" name="list_lead_type" id="list_lead_type" onchange="submit_lead_form();">
                                                   <option value="">All</option>
                                                      <?php
                                                         if(!empty($lead_type_lists))
                                                         {
                                                            foreach ($lead_type_lists as $key => $lead_type) { if($lead_type->status == 0){ ?>
                                                               <option value="<?php echo $lead_type->lead_type_id; ?>" <?php if($lead_type->lead_type_id == $list_lead_type && $list_lead_type != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo $lead_type->lead_type; ?></option>
                                                            <?php } }
                                                         }
                                                      ?>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row  my_filter" style="display: none;">

                                          <div class="col-lg-4">
                                             <div class="form-group m-form__group">
                                                <label>Lead Source</label>
                                                <select class="custom-select form-control refer" name="list_lead_source" id="list_lead_source" onchange="submit_lead_form();">
                                                   <option value="">All</option>
                                                   <?php
                                                      if(!empty($lead_source_lists))
                                                      {
                                                         foreach ($lead_source_lists as $key => $lead_source) { if($lead_source->status == 0){ ?>
                                                            <option value="<?php echo $lead_source->lead_source_id; ?>" <?php if($lead_source->lead_source_id == $list_lead_source && $list_lead_source != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo $lead_source->lead_source; ?></option>
                                                         <?php } }
                                                      }
                                                   ?>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-lg-4">
                                             <div class="form-group m-form__group">
                                                <label>Lead Status</label>
                                                <select class="custom-select form-control refer" name="list_lead_status" id="list_lead_status" onchange="submit_lead_form();">
                                                   <option value="">All</option>
                                                   <?php
                                                      if(!empty($lead_status_lists))
                                                      {
                                                         foreach ($lead_status_lists as $key => $lead_status_list) { if($lead_status_list->status == 0){ ?>
                                                            <option value="<?php echo $lead_status_list->lead_status_id; ?>" <?php if($lead_status_list->lead_status_id == $list_lead_status && $list_lead_status != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo
                                                             $lead_status_list->lead_status; ?></option>
                                                         <?php } }
                                                      }
                                                   ?>
                                                </select>
                                             </div>
                                          </div>

                                          

                                          <div class="col-lg-4">
                                             <div class="form-group m-form__group">
                                                <label>Date Range</label>
                                                <div class='input-group pull-right' id="m_daterangepicker_3">
                                                <input type='text' class="form-control m-input" readonly placeholder="Select Date Range"  
                                                name="lead_list_date" value="<?php echo ($lead_list_date != '') ? $lead_list_date : ''; ?>"/>
                                                   <div class="input-group-append">
                                                      <button class="btn btn-primary" type="submit">Go</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </form> 
                                 </div>
                                 <div class="col-lg-2">
                                    <div class="pull-right">
                                       <div class="form-group m-form__group mt_25px">
                                          <button class="btn btn-primary" id="tog_filter">
                                             <i class="la la-filter"></i>&nbsp;&nbsp;Advanced
                                          </button>
                                       </div>

                                    </div>
                                 </div>
                              </div>
                              
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
                              <div class="row"> 
                                 <div class="col-lg-12">  
                                    <table class="table table-striped table-bordered table-hover table-checkable" id="m_table_2">
                                       <thead>
                                          <tr>
                                             <th data-sortable="false">
                                                <label class="m-checkbox m-checkbox--bold m-checkbox--state-info">
                                                         <input id="allchk" type="checkbox" onclick="overall_chk();">
                                                         <span style="top:-10px;"></span>
                                                   </label>
                                             </th>
                                             <th>Lead Name</th>
                                             <th>Product</th>
                                             <th>Country</th>
                                             <th>Source</th>
                                             <th>Priority</th>
                                             <th>Status</th>
                                             <th>Assigned To</th>
                                             <th>Created On</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                          $select_all_leads = '';
                                          $i = 0;
                                          if(!empty($lead_lists)){   foreach ($lead_lists as $key => $lead_list) { 

                                                $select_all_leads .= $lead_list->lead_id.',';

                                                $res = $this->Lead_model->followup_lists($lead_list->lead_id);
                                                $fupcnt = count($res);
                                                $pleads = $this->Lead_model->lead_followups_by_pending_lfuid($lead_list->lead_id);

                                                if(!empty($pleads)){
                                                   $fcclass = 'm-badge--info';
                                                }else{
                                                   $fcclass = 'm-badge--danger';
                                                }

                                                if($fupcnt>0)
                                                {
                                                   $lfup = $this->Lead_model->get_last_followup_by_id($lead_list->lead_id);
                                                   if($lfup->modified_by==0)
                                                   {
                                                      $lfdate = $lfup->created_on;
                                                      $lfby = $lfup->created_by;
                                                   }
                                                   else
                                                   {
                                                      $lfdate = $lfup->modified_on;
                                                      $lfby = $lfup->modified_by;
                                                   }
                                                }
                                                else
                                                {
                                                   if($lead_list->modified_by==0)
                                                   {
                                                      $lfdate = $lead_list->created_on;
                                                      $lfby   = $lead_list->created_by;
                                                   }
                                                   else
                                                   {
                                                      $lfdate = $lead_list->modified_on;
                                                      $lfby   = $lead_list->modified_by;
                                                   }

                                                }

                                                $lfbydet = login_user_details($lfby);
                                                $displayname = $lfbydet->name;
                                                if($lfbydet){ $lfbyname = ($displayname) ? $displayname : ''; }
                                                
                                                $datetime1 = new DateTime(date_format(date_create($lfdate),'Y-m-d'));
                                                $datetime2 = new DateTime(date('Y-m-d'));
                                                $interval = $datetime1->diff($datetime2);

                                                if($interval->format('%y')==0 && $interval->format('%m')==0)
                                                {
                                                   $tday = $interval->format('%d').' D';
                                                   $tclass = 'btn-info';
                                                }
                                                else if($interval->format('%y')==0 && $interval->format('%m')!=0)
                                                {
                                                   $tday = $interval->format('%m').' M';
                                                   $tclass = 'btn-warning';
                                                }
                                                else
                                                {
                                                   $tday = $interval->format('%y').' Y';
                                                   $tclass = 'btn-danger';
                                                }
                                                ?>
                                          <tr  bgcolor="<?php echo ($lead_list->status==1) ? '#e6ffe6':'';?><?php echo ($lead_list->status==2)?'#ffe6e6':'';?>">
                                                <td data-sortable="false">
                                                    <label class="m-checkbox m-checkbox--bold m-checkbox--state-info">
                                                         <input type="checkbox" id="chk<?php echo $i; ?>" value="<?php echo $lead_list->lead_id; ?>">
                                                         <span style="top:-10px;"></span>
                                                   </label>
                                                </td>
                                             <td>
                                                <p class="text-right">
                                                   <a href="<?php echo base_url(); ?>lead_view/<?php echo $lead_list->lead_id; ?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Lead Info"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;

                                                   <?php
                                                   if($lead_list->status == 0 || $lead_list->status == 3){ ?>
                                                      <a href="#" data-toggle="modal" onclick="lead_edit(<?php echo $lead_list->lead_id; ?>)"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
                                                       <a href="#" data-toggle="modal" data-target="#cancel_lead" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Drop" onclick="cancel_lead('<?php echo $lead_list->lead_id; ?>')"><i class="fa fa-times"></i></span></a>&nbsp;&nbsp;
                                                   <?php } ?>

                                                  
                                                </p>
                                                <h5 class="text-black"  style="margin-bottom: 0px;"><?php echo $lead_list->lead_name; ?></h5>
                                                <span style="font-size: 16.5px;" class="text-green"><b><sub><?php echo $lead_list->email_id; ?></sub><b></b></b></span>
                                                
                                             </td>
                                             <td>
                                                <h5 class="text-black"  style="margin-bottom: 0px;"><?php echo $lead_list->product_name; ?></h5>
                                                <span style="font-size: 16.5px;" class="text-green"><b><sub><?php echo $lead_list->industry_name; ?></sub><b></b></b></span>
                                             </td>
                                              <td>
                                                <?php 
                                                      if($lead_list->status == 0 || $lead_list->status == 3)
                                                      {  ?>
                                                         <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_country"
                                                            onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'country');" > 
                                                                <?php
                                                                     if(!empty($country_lists))
                                                                     {
                                                                        foreach ($country_lists as  $country_list) { ?>
                                                                           <option value="<?php echo $country_list->id; ?>"  <?php echo ($country_list->id == $lead_list->country) ? 'selected' : ''; ?> ><?php echo $country_list->name; ?></option>
                                                                        <?php } 
                                                                     }
                                                                  ?>
                                                            </select>
                                                     <?php  }else{ echo $lead_list->country_name; } ?>
                                             </td>
                                            
                                             <td width="10%">
                                                 <?php 
                                                      if($lead_list->status == 0 || $lead_list->status == 3)
                                                      {  ?>
                                                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_source_id"
                                                onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'lead_source');" > 
                                                    <?php
                                                         if(!empty($lead_source_lists))
                                                         {
                                                            foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                                               <option value="<?php echo $lead_source_list->lead_source_id; ?>"  <?php echo ($lead_source_list->lead_source_id == $lead_list->lead_source_id) ? 'selected' : ''; ?> ><?php echo $lead_source_list->lead_source; ?></option>
                                                            <?php } }
                                                         }
                                                      ?>
                                                </select>
                                                <?php  }else{ echo $lead_list->source_name; } ?>
                                             </td>
                                              <td width="10%">
                                                <?php 
                                                      if($lead_list->status == 0 || $lead_list->status == 3)
                                                      {  ?>
                                                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_type_id" onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'lead_type');"> 
                                                   <?php
                                                         if(!empty($lead_type_lists))
                                                         {
                                                            foreach ($lead_type_lists as $key => $lead_type_list) { if($lead_type_list->status == 0){ ?>
                                                               <option value="<?php echo $lead_type_list->lead_type_id; ?>" <?php echo ($lead_type_list->lead_type_id == $lead_list->lead_type_id) ? 'selected' : ''; ?> ><?php echo $lead_type_list->lead_type; ?></option>
                                                            <?php } }
                                                         }
                                                      ?>
                                                </select>
                                                <?php  }else{ echo $lead_list->lead_type_name; } ?>
                                                
                                             </td>
                                             <td width="10%">
                                                <?php if($lead_list->status == 0 || $lead_list->status == 3)
                                                      {  ?>
                                                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_status_id" onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'lead_status');"> 
                                                   <?php
                                                         if(!empty($lead_status_lists))
                                                         {
                                                            foreach ($lead_status_lists as $key => $lead_status_list) { if($lead_status_list->status == 0){ ?>
                                                               <option value="<?php echo $lead_status_list->lead_status_id; ?>" <?php echo ($lead_status_list->lead_status_id == $lead_list->lead_status_id) ? 'selected' : ''; ?> ><?php echo $lead_status_list->lead_status; ?></option>
                                                            <?php } }
                                                         }
                                                      ?>
                                                </select>
                                                <?php  }else{ echo $lead_list->lead_status_name; } ?>
                                             </td>
                                              <td>
                                                <?php echo $lead_list->lead_assign_name; ?>
                                                  <?php 

                                                 if (isset($lead_list->fup_status) && $lead_list->fup_status != 0){ if($lead_list->fupst == 0){
                                                   $ftimes = explode(',', $lead_list->fup_status);
                                                  ?>
                                                  <span class="tag_fup"><i style="font-size: 16px;" class="fa fa-clock"></i><b> - <?php
                                                  foreach ($ftimes as $ft) {
                                                      $time = date("h:i A",strtotime($ft));
                                                      $ctime = date("h:i A");
                                                      if(date("H:i:s",strtotime($time)) < date("H:i:s",strtotime($ctime)))
                                                      {
                                                         echo '<b class="text-danger">'.$time.'&nbsp;</b>';
                                                      }
                                                      else
                                                      {
                                                         echo '<b>'.$time.'&nbsp;</b>';
                                                      }
                                                  }
                                                  ?>
                                                   </b></span>
                                                <?php } else{ ?>
                                                   <span class="tag_fup">Followed</span>
                                                <?php } } ?>
                                             </td>
                                              <td>
                                                 <h6  style="margin-bottom: 0px;"><?php echo date($date_format. ' H:i:s', strtotime($lead_list->created_on)); ?></h6>
                                                <span style="font-size: 16.5px;" class="text-green"><b><sub><?php echo $lead_list->lead_created_by; ?></sub><b></b></b></span>
                                                
                                             </td>
                                             <td>
                                                <?php if($lead_list->status == 3){?>
                                                      <a href="#" data-toggle="modal" onclick="lead_opportunity_change(0, '<?php echo $lead_list->lead_id; ?>', 'status');"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Move To Lead">
                                                         <i class="fa fa-thumbs-up text-orange"></i></span></a>&nbsp;&nbsp;

                                             <?php } ?>
                                             <?php if($lead_list->status == 0 && ($lead_list->lead_status_name == 'Potential' && $lead_list->lead_type_name == 'Hot')  ){ ?>     
                                                      <a href="#" id="opp_id" data-toggle="modal" onclick="lead_opportunity_change(3, '<?php echo $lead_list->lead_id; ?>', 'status');"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Move To Opportunity"><i class="fa fa-hands-helping"></i></span></a>&nbsp;&nbsp;

                                             <?php } ?>

                                                <?php

                                             if($lead_list->status == 0 || $lead_list->status == 3){ ?>

                                                   <a href="#" data-toggle="modal" data-target="#follow_edit">
                                                      <span style="position:relative;">
                                                      <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Follow Up" onclick="lead_fp_edit('<?php echo $lead_list->lead_id; ?>')"><i class="flaticon-calendar-with-a-clock-time-tools"></i></span>

                                                      <?php if($fupcnt>0){?>
                                                      <span class="m-badge <?php echo $fcclass;?>" style="position:absolute;right: 0;top: -15px;left: 3px;"><?php echo $fupcnt;?></span><?php }?></span>
                                                   </a>&nbsp;&nbsp;
                                             <?php } ?>
                                             
                                             <div class="btn-group">
                                                   <button type="button" class="btn btn-sm <?php echo $tclass;?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b><?php echo $tday;?></b></button>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <a class="dropdown-item" href="javascript:;">Last Modified By <br><b><?php echo $lfbyname;?></b></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="javascript:;">Last Modified On <br><b><?php echo date($date_format.' H:i:s', strtotime($lfdate));?></b></a>
                                                      
                                                   </div>
                                                </div>
                                                <?php if ($lead_list->status == 2){ ?>
                                                   <a href="#" data-toggle="modal" data-target="#re_lead" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Reopen Lead" onclick="re_lead('<?php echo $lead_list->lead_id; ?>')"><i class="fa fa-undo-alt"></i></span></a>
                                                <?php } ?>

                                               
                                             
                                             </td>
                                          </tr>
                                           <?php $i++; } } ?> 
                                       </tbody>
                                    </table>
                                    <input type="hidden" id="countchk" value="<?php echo $i; ?>">
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
         <script src="<?php echo base_url();?>assets/demo/demo12/custom/crud/forms/widgets/bootstrap-daterangepicker.js"></script>
         <script src="<?php echo base_url(); ?>assets/demo/demo12/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->
<!--begin::Create Lead-->
<div class="container">
   <div class="modal fade" id="create_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg cust_modal" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Lead</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">

        <!--        <div class="row">
                  <div class="col-lg-12">
                     <div class="m-radio-inline">
                        <label class="m-radio m-radio--bold m-radio--success">
                        <input type="radio" name="type_lead" value="1" id="new" checked="">New
                        <span></span>
                        </label>
                        <label class="m-radio m-radio--bold m-radio--success">
                        <input type="radio" name="type_lead" value="2" id="existing">Existing
                        <span></span>
                        </label>
                        <label class="m-radio m-radio--bold m-radio--success">
                        <input type="radio" name="type_lead" value="3" id="client">Client
                        <span></span>
                        </label>
                     </div>
                  </div>
               </div> -->
               <form name="lead_add_form" method="POST" action="<?php echo base_url(); ?>Leads/lead_save" onsubmit="return lead_validation();">
               <h5 class="mt_25px">
                  <b>Lead Info</b> 
               </h5><hr>
               <div class="row">
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Lead Name<span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Name"  name="lead_name" id="lead_name" maxlength="100">
                        <span class="text-danger" id="lead_name_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Company Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Company Name" name="company_name" id="company_name" maxlength="100">
                        <span class="text-danger" id="company_name_err"></span>
                     </div>
                  </div>
                  
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                           <label>Country<span class="text-danger">*</span></label>
                           <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="country" id="country">
                              <option value="">Choose</option>
                              <?php
                                    if(!empty($country_lists))
                                    {
                                       foreach ($country_lists as $key => $country_list) {  ?>
                                          <option value="<?php echo $country_list->id; ?>"><?php echo $country_list->name; ?></option>
                                       <?php } 
                                    }
                                 ?>
                           </select>
                           <span class="text-danger" id="country_err"></span>
                        </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Designation<span class="text-danger">*</span></label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Designation" name="designation" id="designation" maxlength="100">
                        <span class="text-danger" id="designation_err"></span>
                     </div>
                  </div>
                     
               </div>
               <div class="row">

                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Website</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Website" id="website" name="website">
                        <span class="text-danger" id="website_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-9">
                     <div class="form-group m-form__group">
                        <label>Address<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="address" id="address"></textarea>
                        <span class="text-danger" id="address_err"></span>
                     </div>
                  </div>
               </div>

               <h5><b>Lead Contact Info</b></h5><hr>

               <div class="row">
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Primary Email ID<span class="text-danger">*</span></label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Primary Email ID" name="email_id" id="email_id" maxlength="100" onblur="email_id_unique(this.value);">
                        <span class="text-danger" id="email_id_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Alternate Email ID</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Alternate Email ID" name="alternative_email_id" id="alternative_email_id" maxlength="100" >
                        <span class="text-danger" id="alternative_email_id_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Skype ID</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Skype ID" id="skype_id" name="skype_id">
                        <span class="text-danger" id="skype_id_err"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Contact No<span class="text-danger">*</span></label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact No" id="contact_no" name="contact_no" maxlength="12">
                        <span class="text-danger" id="contact_no_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Whatsapp No</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Whatsapp No" id="whatsapp_no" name="whatsapp_no" maxlength="12">
                        <span class="text-danger" id="whatsapp_no_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group m-form__group">
                        <label>Office Contact No</label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Office Contact No"  id="office_phone_no" name="office_phone_no" maxlength="12">
                        <span class="text-danger" id="office_phone_no_err"></span>
                     </div>
                  </div>
               </div>
               <h5><b>Interested Product Info</b></h5><hr>
               <div class="row">
                  <div class="col-lg-6">
                        <div class="form-group m-form__group">
                              <label>Product<span class="text-danger">*</span></label>
                              <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="product_id" id="product_id" onchange="product_user_list(this.value);">
                                 <option value="">Choose</option>
                                 <?php
                                    if(!empty($product_lists))
                                    {
                                       foreach ($product_lists as $key => $product_list) { if($product_list->status == 0){ ?>
                                          <option value="<?php echo $product_list->product_id; ?>"><?php echo $product_list->product_name; ?></option>
                                       <?php } }
                                    }
                                 ?>
                              </select>
                              <span class="text-danger" id="product_id_err"></span>
                        </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group m-form__group">
                        <label>Industry</label>
                        <input type="text" class="form-control"  readonly="" name="industry_name" id="industry_name">
                        <input type="hidden"  class="form-control"  readonly="" name="industry_id" id="industry_id">
                        <span class="text-danger" ></span>
                     </div>
                  </div>
               </div>

               <h5><b>Lead Source Info</b></h5><hr>

               <div class="row">
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Lead Source<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source" id="lead_source"> 
                           <option value="">Choose</option> 
                           <?php
                              if(!empty($lead_source_lists))
                              {
                                 foreach ($lead_source_lists as $key => $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                    <option value="<?php echo $lead_source_list->lead_source_id; ?>"><?php echo $lead_source_list->lead_source; ?></option>
                                 <?php } }
                              }
                           ?>
                        </select>
                        <span class="text-danger" id="lead_source_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Priority<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_type" id="lead_type"> 
                           <option value="">Choose</option> 
                           <?php
                              if(!empty($lead_type_lists))
                              {
                                 foreach ($lead_type_lists as $key => $lead_type_list) { if($lead_type_list->status == 0){ ?>
                                    <option value="<?php echo $lead_type_list->lead_type_id; ?>"><?php echo $lead_type_list->lead_type; ?></option>
                                 <?php } }
                              }
                           ?>
                        </select>
                        <span class="text-danger" id="lead_type_err"></span>
                     </div>
                  </div>

                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Lead Status</label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_status" id="lead_status"> 
                           <option value="">Choose</option> 
                          <?php
                              if(!empty($lead_status_lists))
                              {
                                 foreach ($lead_status_lists as $key => $lead_status_list) { if($lead_status_list->status == 0){ ?>
                                    <option value="<?php echo $lead_status_list->lead_status_id; ?>"><?php echo $lead_status_list->lead_status; ?></option>
                                 <?php } }
                              }
                           ?>
                        </select>
                        <span class="text-danger"></span>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label>Assigned To<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="assigned_to" id="assigned_to"> 
                           <option value="">Choose</option> 
                           
                        </select>
                        <span class="text-danger" id="assigned_to_err"></span>
                     </div>
                  </div>
               </div>

               <h5><b>Message Info</b></h5><hr>
               <div class="row">
                     <div class="col-lg-12">
                        <label>Message</label>
                        <div class="form-group m-form__group">
                           <textarea class="summernote" id="m_summernote_1" name="lead_message"></textarea>
                           <span class="text-danger" id="lead_message_err"></span>
                        </div>
                     </div>
               </div>
            </div>
            <div class="modal-footer">
               <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Create">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

         </form>
         </div>
      </div>
   </div>
</div>
<!--End::-->


<!--begin::Update Lead-->
<div class="container">
   <div class="modal fade" id="edit_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
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
<!--begin::Drop Lead-->
<div class="container">
   <div class="modal fade" id="drop_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Drop Lead</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to drop this Lead Permanently?</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary">Drop</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
         </div>
      </div>
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

            <form name="bulk_updation_form" id="bulk_updation_form" method="POST" action="<?php echo base_url(); ?>Leads/bulk_updation" onsubmit="return bulk_update_validation();">
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
                              <input type="radio" name="bulk_update" value="2" id="lead_bulk_drop" onclick="show_drop_val(2);">Drop
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
                           <label>Priority</label>
                           <select class="form-control m-bootstrap-select m_selectpicker" id="bulk_lead_type" name="bulk_lead_type">
                              <option value="">Choose</option> 
                              <?php
                                 if(!empty($lead_type_lists))
                                 {
                                    foreach ($lead_type_lists as $key => $lead_type_list) { if($lead_type_list->status == 0){ ?>
                                       <option value="<?php echo $lead_type_list->lead_type_id; ?>"><?php echo $lead_type_list->lead_type; ?></option>
                                    <?php } }
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
                      <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label>Lead Source</label>
                           <select class="form-control m-bootstrap-select m_selectpicker" id="bulk_lead_source" name="bulk_lead_source">
                              <option value="">Choose</option> 
                              <?php
                                 if(!empty($lead_source_lists))
                                 {
                                    foreach ($lead_source_lists as $key => $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                       <option value="<?php echo $lead_source_list->lead_source_id; ?>"><?php echo $lead_source_list->lead_source; ?></option>
                                    <?php } }
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label>Lead Status</label>
                           <select class="form-control m-bootstrap-select m_selectpicker" id="bulk_lead_status" name="bulk_lead_status">
                             <option value="">Choose</option> 
                             <?php
                                 if(!empty($lead_status_lists))
                                 {
                                    foreach ($lead_status_lists as $key => $lead_status_list) { if($lead_status_list->status == 0){ ?>
                                       <option value="<?php echo $lead_status_list->lead_status_id; ?>"><?php echo $lead_status_list->lead_status; ?></option>
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
                                    foreach ($assigned_user_lists as $key => $assigned_user_list) { ?>
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

<div class="container">
   <div class="modal fade" id="remove_opportunity_updation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
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

<!--end::Modal-->
<script type="text/javascript">
   var baseurl = '<?php echo base_url(); ?>';
   
   var title = $('title').text() + ' | ' + ' Opportunity List';
$(document).attr("title", title);

$('.year').datepicker({
        minViewMode: 2,
         todayHighlight: true,
        format: 'yyyy',
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
//modal-script
function submit_lead_form()
{
   $('#lead_filter_form').submit();
}

// To get product user list 
function product_user_list(val) 
{
   $.ajax({
      
      url:baseurl+'Leads/product_user_list',
      type:'POST',
      data:{'value':val},
      dataType: 'html',

      success:function(result){

         var valval = result.split("|");
         $('#assigned_to').empty().append(valval[0]);
         $('#assigned_to').modal('show');
         $('.m_selectpicker').selectpicker('refresh');

         $('#industry_name').val(valval[1]);
         $('#industry_id').val(valval[2]);
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
         $('#e_assigned_to').empty().append(valval[0]);
         $('.m_selectpicker').selectpicker('refresh');

         $('#e_industry_name').val(valval[1]);
         $('#e_industry_id').val(valval[2]);

      }
   });
}

// To change lead type
function lead_opportunity_change(val, lead_id, type_val)
{
   $('#opp_lead_id').val(lead_id);
   $('#remove_opportunity_updation').modal('show');
}
function opportunity_update(val,  type_val){

   var lead_id = $('#opp_lead_id').val();
   var opp_reason = $('#opp_reason').val();
   if(opp_reason == '')
   {
      $('#opp_reason_err').html('Reason is required!');
   }else{

         $.ajax({
         type:'POST',
         url:baseurl+'Leads/lead_status_type_change',
         data:{'value':val, 'lead_id':lead_id, 'type_val':type_val, 'reason':opp_reason},
         dataType: 'html',
         success:function(result){
            $('#show_success').show();
               setTimeout(function() {
               window.location = baseurl+"Leads/opportunity_list";
            }, 3000);
         }
      });
   }
}
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
// To show edit lead 
function lead_edit(val)
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/lead_edit',
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
   url: baseurl+'Leads/lead_followup_edit',
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
   url: baseurl+'Leads/lead_fp_edit_status',
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
   window.location.href = baseurl+'Leads';
   }
   });
}
function cancel_lead(val)
{

   $.ajax({
   type: "POST",
   url: baseurl+'Leads/cancel_lead',
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
   
   $.ajax({
   type: "POST",
   url: baseurl+'Leads/lead_delete',
   async: false,
   data:"field="+val,
   success: function(response)
   {
   window.location.href = baseurl+'Leads';
   }
   });
}
var er = 0;
function email_id_unique(val) 
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
            $('#email_id_err').html('Email ID already exists!');
            er = 1;
         }else{
            er = 0;
         }
         
      }
   });
}
// To validate lead form
function lead_validation()
{
   var err = 0;
   var lead_name = $('#lead_name').val();
   var company_name = $('#company_name').val();
   var country = $('#country').val();
   var designation = $('#designation').val();
   var website = $('#website').val();
   var address = $('#address').val();
   var email_id = $('#email_id').val();
   var alternative_email_id = $('#alternative_email_id').val();
   var website = $('#website').val();
   var skype_id = $('#skype_id').val();
   var contact_no = $('#contact_no').val();
   var whatsapp_no = $('#whatsapp_no').val();
   var office_phone_no = $('#office_phone_no').val();
   var product_id = $('#product_id').val();
   var lead_source = $('#lead_source').val();
   var lead_type = $('#lead_type').val();
   var lead_status = $('#lead_status').val();
   var assigned_to = $('#assigned_to').val();
   var message = $('#m_summernote_1').val();
   
   if(lead_name == '')
   {
      $('#lead_name_err').html('Lead Name is required!');
      err++;
   }else{
      $('#lead_name_err').html('');
   }  
   
   if(company_name == '')
   {
      $('#company_name_err').html('Company Name is required!');
      err++;
   }else{
      $('#company_name_err').html('');
   } 
   if(country == '')
   {
      $('#country_err').html('Country is required!');
      err++;
   }else{
      $('#country_err').html('');
   } 
   if(designation == '')
   {
      $('#designation_err').html('Designation is required!');
      err++;
   }else{
      $('#designation_err').html('');
   }  
   
   if(website != '' && !isUrlValid(website))
   {
       $('#website_err').html('Valid Website is required!');
      err++;
   }else{
      $('#website_err').html('');
   }  
    if(address.trim()==''){

      $('#address_err').html('Address is required!');
      err++;
   }else{
      $('#address_err').html('');

   }

   if(email_id == '')
   {
         $('#email_id_err').html('Email ID is required!');
           err++;

   }else if(!ValidateEmail(email_id)){ 

           $('#email_id_err').html('Invalid Email ID!');
           err++;
   }else if(er > 0){

      $('#email_id_err').html('Email ID already exists!');
      err++;
   }
   else{
     $('#email_id_err').html('');
   }

   if(alternative_email_id != '' && !ValidateEmail(alternative_email_id)){ 

           $('#alternative_email_id_err').html('Invalid Email ID!');
           err++;
   }
   else{
     $('#alternative_email_id_err').html('');
   }

   if(contact_no ==''){
        $('#contact_no_err').html('Contact No is required!');
        err++;
        
    }else if(contact_no.length!=10||contact_no=='0000000000')
    { 
        $('#contact_no_err').html('Contact No should be maxium 10 No!');
        err++;
    }else if(isNaN(contact_no))
    { 
        $('#contact_no_err').html('Invalid Contact No!');
        err++;
    }
    else{
        $('#contact_no_err').html('');
    }
    
   if(whatsapp_no != '' && whatsapp_no.length!=10||whatsapp_no=='0000000000')
    { 
        $('#whatsapp_no_err').html('Whatsapp No should be maxium 10 No!');
        err++;
    }else if(isNaN(whatsapp_no))
    { 
        $('#whatsapp_no_err').html('Invalid Whatsapp No!');
        err++;
    }
    else{
        $('#whatsapp_no_err').html('');
    }
      
   if(office_phone_no != '' && office_phone_no.length!=10||office_phone_no=='0000000000')
    { 
        $('#office_phone_no_err').html('Office Contact No should be maxium 10 No!');
        err++;
    }else if(isNaN(office_phone_no))
    { 
        $('#office_phone_no_err').html('Invalid Office Contact No!');
        err++;
    }
    else{
        $('#office_phone_no_err').html('');
    }
   if(product_id.trim()==''){

      $('#product_id_err').html('Product is required!');
      err++;
   }else{
      $('#product_id_err').html('');

   }

   if(lead_source.trim()==''){

      $('#lead_source_err').html('Lead Source is required!');
      err++;
   }else{
      $('#lead_source_err').html('');

   }
    if(lead_type.trim()==''){

      $('#lead_type_err').html('Priority is required!');
      err++;
   }else{
      $('#lead_type_err').html('');

   }
   if(assigned_to.trim()==''){

      $('#assigned_to_err').html('Assigned To is required!');
      err++;
   }else{
      $('#assigned_to_err').html('');

   }
   
   if(err>0){ return false; }else{ return true; }
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
   
   if(lead_name == '')
   {
      $('#e_lead_name_err').html('Lead Name is required!');
      err++;
   }else{
      $('#e_lead_name_err').html('');
   }  
   
   if(company_name == '')
   {
      $('#e_company_name_err').html('Company Name is required!');
      err++;
   }else{
      $('#e_company_name_err').html('');
   } 
   if(country == '')
   {
      $('#e_country_err').html('Country is required!');
      err++;
   }else{
      $('#e_country_err').html('');
   } 
   if(designation == '')
   {
      $('#e_designation_err').html('Designation is required!');
      err++;
   }else{
      $('#e_designation_err').html('');
   }  
   
   if(website != '' && !isUrlValid(website))
   {
       $('#e_website_err').html('Valid Website is required!');
      err++;
   }else{
      $('#e_website_err').html('');
   }  
    if(address.trim()==''){

      $('#e_address_err').html('Address is required!');
      err++;
   }else{
      $('#e_address_err').html('');

   }

   if(email_id == '')
   {
         $('#e_email_id_err').html('Email ID is required!');
           err++;

   }else if(!ValidateEmail(email_id)){ 

           $('#e_email_id_err').html('Invalid Email ID!');
           err++;
   }else if(er > 0){

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

   if(contact_no ==''){
        $('#e_contact_no_err').html('Contact No is required!');
        err++;
        
    }else if(contact_no.length!=10||contact_no=='0000000000')
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
function select_all_leads()
{
   var sl = '<?php echo trim($select_all_leads, ","); ?>';
   $('#bulk_lead_ids').val(sl);
   $('#bulk_updation').modal('show');
}
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


$('#tog_filter').click(function(){
  $('.my_filter').slideToggle('slow'); 
})
</script>

   </body>

   <!-- end::Body -->
</html>