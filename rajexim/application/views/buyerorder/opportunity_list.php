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
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text"><?php
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
                  <div class="row">
                     <div class="col-md-12">
                         <div style="margin-bottom:2.2rem;">
                              <ul class="que_sett">
                                 <li class="<?php if($tab_val == 1 || $tab_val == ''){ echo 'active'; }else{ echo ''; } ?>"><a href="<?php echo base_url(); ?>opportunity_leads?active_tab=1">Opportunity List</a></li>
                                 <li class="<?php if($tab_val == 2 || $tab_val == ''){ echo 'active'; }else{ echo ''; } ?>" ><a href="<?php echo base_url(); ?>converted_leads?active_tab=2">Converted List</a></li>
                              </ul>
                        </div>
                     </div>
                  </div>
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
                                    
                              <li class="m-portlet__nav-item">
                                 <a href="#" onclick="lead_export_items();" class="m-portlet__nav-link btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                    Export
                                 </a>
                                 
                              </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Opportunity Lead has been activated successfully.
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
                              <div class="row">
                                    <div class="col-lg-10">
                                       <form name="lead_filter_form" id="lead_filter_form" action="<?php echo base_url().$link; ?>" method="POST">   

                                    <div class="row">
                                       <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Year</label>
                                             <input type="text" class="form-control year" placeholder="Enter Year" name="l_year" id="l_year"  onchange="submit_lead_form();" value="<?php echo ($f_year_month) ? $f_year_month : date('Y-M'); ?>">
                                          </div>
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Product</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_product" id="list_product" onchange="submit_lead_form();">
                                                <option value="">All</option>
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
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Priority</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_lead_type" id="list_lead_type" onchange="submit_lead_form();">
                                                <option value="">All</option>
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
                                       </div>
                                    </div>
                                    <div class="my_filter"  style="display: none;">
                                    <div class="row">

                                       <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Lead Source</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_lead_source" id="list_lead_source" onchange="submit_lead_form();">
                                                <option value="">All</option>
                                                <?php
                                                   if(!empty($lead_source_lists))
                                                   {
                                                      foreach ($lead_source_lists as  $lead_source) { if($lead_source->status == 0){ ?>
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
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_lead_status" id="list_lead_status" onchange="submit_lead_form();">
                                                <option value="">All</option>
                                                <?php
                                                   if(!empty($lead_status_lists))
                                                   {
                                                      foreach ($lead_status_lists as  $lead_status_list) { if($lead_status_list->status == 0){ ?>
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
                                             <label>Country</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_lead_country" id="list_lead_country" onchange="submit_lead_form();">
                                                <option value="">All</option>
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
                                       </div>

                                       
                                    </div>
                                    <div class="row">
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
                                       <div class="col-lg-4">
                                          <div class="form-group m-form__group">
                                             <label>Assigned to</label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="filt_assign_to" id="filt_assign_to" onchange="submit_lead_form();">
                                                <option value="">All</option>
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
                                  
                              <?php if($tab_val == 1){ ?>
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
                           <?php } ?>
                              <div class="row"> 
                                 <div class="col-lg-12">  
                                    <table class="table table-striped table-bordered table-checkable" id="m_table_2">
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
                                             <th>Assigned</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                          $select_all_leads = '';
                                          $i = 0;
                                          if(!empty($lead_lists)){   foreach ($lead_lists as $key=> $lead_list) {
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
                                          <tr>
                                                <td data-sortable="false">
                                                    <label class="m-checkbox m-checkbox--bold m-checkbox--state-info">
                                                         <input type="checkbox" id="chk<?php echo $i; ?>" value="<?php echo $lead_list->lead_id; ?>">
                                                         <span style="top:-10px;"></span>
                                                   </label>
                                                </td>
                                             <td>
                                                <p class="text-right">
                                                   <?php if($_SESSION['Lead ManagementView'] == 1){ ?>
                                                   <a href="<?php echo base_url(); ?>lead_view/<?php echo $lead_list->lead_id; ?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Opportunity Info"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                                                   <?php } ?>

                                                   <?php
                                                   if($lead_list->status == 3){ ?>
                                                      <?php if($_SESSION['Lead ManagementEdit'] == 1){ ?>
                                                      <a href="#" data-toggle="modal" onclick="lead_edit(<?php echo $lead_list->lead_id; ?>)"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
                                                      <?php } ?>
                                                      <?php if($_SESSION['Lead ManagementDelete'] == 1){ ?>
                                                       <a href="#" data-toggle="modal" data-target="#cancel_lead" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Archive" onclick="cancel_lead('<?php echo $lead_list->lead_id; ?>')"><i class="fa fa-times"></i></span></a>&nbsp;&nbsp;
                                                   <?php } } ?>

                                                  
                                                </p>
                                                <h5 class="text-black"  style="margin-bottom: 0px;"><?php echo $lead_list->lead_name; ?></h5>
                                                <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo $lead_list->email_id; ?></sub><b></b></b></span>
                                                
                                             </td>
                                             <td>
                                                <h5 class="text-black"  style="margin-bottom: 0px;"><?php echo $lead_list->product_name; ?></h5>
                                                <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo $lead_list->industry_name; ?></sub><b></b></b></span>
                                             </td>
                                              <td> 
                                                <p class="text-right">
                                                   <a href="#" data-toggle="modal" id="quick_edit_1_<?php echo $key; ?>" onclick="show_quick_icon('country_quick_icon', <?php echo $key; ?>, 1);">
                                                      <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt" ></i>
                                                   </a>
                                                   <a style="display: none;" href="#" data-toggle="modal" id="quick_save_1_<?php echo $key; ?>" 
                                                      onclick="show_quick_pencil_icon('country_quick_icon', <?php echo $key; ?>, 1);">
                                                      <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Cancel"><i class="fa fa-undo-alt"></i>
                                                   </a>
                                                </p>

                                                <span  style="margin-bottom: 0px;" id="country_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->country_name; ?></span>

                                                <div id="country_quick_icon_<?php echo $key; ?>" style="display: none;">
                                                 <?php 
                                                         if($lead_list->status == 3)
                                                         {  ?>
                                                            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_country_<?php echo $key; ?>"
                                                                onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'country', 'country_quick_icon', <?php echo $key; ?>, 1);" > 
                                                                   <?php
                                                                        if(!empty($country_lists))
                                                                        {
                                                                           foreach ($country_lists as  $country_list) { ?>
                                                                              <option value="<?php echo $country_list->id; ?>"  <?php echo ($country_list->id == $lead_list->country) ? 'selected' : ''; ?> ><?php echo $country_list->name; ?></option>
                                                                           <?php } 
                                                                        }
                                                                     ?>
                                                               </select>
                                                        <?php  }?>
                                                  </div>
                                             </td>
                                            
                                              <td>
                                                  <p class="text-right">
                                                     <a href="#" data-toggle="modal" id="quick_edit_2_<?php echo $key; ?>" onclick="show_quick_icon('lead_source_quick_icon', <?php echo $key; ?>, 2);">
                                                        <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt" ></i>
                                                     </a>
                                                     <a style="display: none;" href="#" data-toggle="modal" id="quick_save_2_<?php echo $key; ?>" 
                                                        onclick="show_quick_pencil_icon('lead_source_quick_icon', <?php echo $key; ?>, 2);">
                                                        <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Cancel"><i class="fa fa-undo-alt"></i>
                                                     </a>
                                                  </p>
                                                  <span  style="margin-bottom: 0px;" id="lead_source_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->sub_source_name; ?></span>
                                                  <div id="lead_source_quick_icon_<?php echo $key; ?>" style="display: none;">
                                                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_source_id_<?php echo $key; ?>"
                                                                onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'lead_source', 'lead_source_quick_icon', <?php echo $key; ?>, 2);" > 
                                                     <?php
                                                             if(!empty($lead_source_lists))
                                                             {
                                                                foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                                                   <option value="<?php echo $lead_source_list->lead_source_id; ?>"  <?php echo ($lead_source_list->lead_source_id == $lead_list->lead_source_id) ? 'selected' : ''; ?> ><?php echo $lead_source_list->lead_source; ?></option>
                                                                <?php } }
                                                             }
                                                          ?>
                                                       </select>
                                                  </div>
                                              </td>
                                             <td>
                                                   
                                                    <span  style="margin-bottom: 0px;" id="lead_type_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->lead_type_name; ?></span>
                                                   
                                                </td>
                                             <td>
                                                 <span  style="margin-bottom: 0px;" id="lead_status_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->lead_status_name; ?></span>
                                             </td>
                                              <td>
                                                <?php echo $lead_list->lead_assign_name; ?>
                                                  <?php 

                                                 if (isset($lead_list->fup_status) && $lead_list->fup_status != 0 && $tab_val == 1){ if($lead_list->fupst == 0){
                                                   $ftimes = explode(',', $lead_list->fup_status);
                                                  ?>
                                                  <span class="tag_fup">&nbsp;<?php
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
                                                <?php if($lead_list->status == 3){?>
                                                      <a href="#" data-toggle="modal" onclick="lead_opportunity_change(0, '<?php echo $lead_list->lead_id; ?>', 'status');"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Move To Lead">
                                                         <i class="fa fa-undo-alt"></i></span></a>&nbsp;&nbsp;

                                             <?php } ?>
                                             <?php if($lead_list->status == 0 && ($lead_list->lead_status_name == 'Potential' && $lead_list->lead_type_name == 'Hot')  ){ ?>     
                                                      <a href="#" id="opp_id_<?php echo $key; ?>" data-toggle="modal" onclick="lead_opportunity_modal('<?php echo $lead_list->lead_id; ?>');"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Move To Opportunity"><i class="fa fa-hands-helping"></i></span></a>&nbsp;&nbsp;
                                             <?php } ?>

                                                <?php
                                                
                                             if($lead_list->status == 3 ){ ?>

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
                                                      <a class="dropdown-item" href="javascript:;">Created By <br><b><?php echo $lead_list->lead_created_by; ?></b></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="javascript:;">Created On <br><b><?php echo date($date_format. ' H:i:s', strtotime($lead_list->created_on)); ?></b></a>
                                                      <div class="dropdown-divider"></div>
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



<!--begin::Update Lead-->
<div class="container">
   <div class="modal fade" data-keyboard="false" data-backdrop = "static" id="edit_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
   </div>
</div>
<!--End::-->

<div class="container">
   <div class="modal fade" data-keyboard="false" data-backdrop = "static" id="follow_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
<div class="container">
   <div class="modal fade" data-keyboard="false" data-backdrop = "static" id="follow_edit_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
<div class="container">
   <div class="modal fade" data-keyboard="false" data-backdrop = "static" id="re_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
<div class="container">
   <div class="modal fade" data-keyboard="false" data-backdrop = "static" id="cancel_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<div class="container">
   <div class="modal fade" data-keyboard="false" data-backdrop = "static" id="bulk_updation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
   <div class="modal fade" data-keyboard="false" data-backdrop = "static" id="remove_opportunity_updation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


<div class="container">
   <div class="modal fade" data-keyboard="false" data-backdrop = "static" id="lead_export_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Export Opportunity Info</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?php echo base_url(); ?>Leads/export_oppo_info" method="POST">
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

               </div>
               <div class="modal-footer">
                  <div class="bank m-checkbox-inline">
                     <label class="m-checkbox">
                       <input type="checkbox" onclick="toggle(this)"><label class="label">All</label>
                       <span></span>
                     </label>
                  </div>&nbsp;
                 <button type="submit" class="btn btn-primary">Yes</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               </div>
            </form>
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
var month_filt = $('#l_year').val();
var pro_filt = $('#list_product').val();
var l_type_filt = $('#list_lead_type').val();
var ls_filt = $('#list_lead_source').val();
var lst_filt = $('#list_lead_status').val();
var ls_country_filt = $('#list_lead_country').val();
var l_ass_filt = $('#filt_assign_to').val();
var l_dtrange_filt = $('#lead_list_date').val();

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

$('#exp_lead_filt_dtrng').empty().append(l_dtrange_filt);
$('#exp_lead_filt_dtrng_val').empty().val(l_dtrange_filt);
});
function toggle(source) {      
  checkboxes = document.getElementsByClassName('lead_export');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
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
//modal-script
function submit_lead_form()
{
   $('#lead_filter_form').submit();
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
      url:baseurl+'Leads/lead_bulk_import',
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
var lead_list_date = '<?php echo $lead_list_date; ?>';

if(lead_source != '' || list_lead_status != '' || lead_list_date != '')
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
</script>

   </body>

   <!-- end::Body -->
</html>