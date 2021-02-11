<?php $this->load->view('common_header'); $date_format =common_date_format();?>
<style>
  .dashboard_notification_body 
  {
    overflow-y: scroll;
    height: 317px !important;
  }
  .nav_width
  {
    width: 74px;
  }
  .card_tod_green 
  {
    font-size: 13px;
    font-weight: 500;
    color: #28A745;
    text-align: left;
  }
  .expand_width 
  {
    padding: 3px;
    width: 125px;
  }
  .expand_width_funnel 
  {
    padding: 3px;
    width: 100px;
  }
  .dataTables_wrapper .dataTable
  {
    margin:0px!important;
  }
  table.dataTable
  {
    margin-top:0px!important
  }
  /*.bootstrap-select>.dropdown-toggle {
    padding-right: 20rem;
  }*/
  .dashboard_block_dd_style 
  {
    float:right;
  }

  #usage_cost>thead>tr>th[style]{font-size: 16px!important;}
  .top_access_style .btn 
  {
      width: 300px !important;
  }
  .nav.nav-pills.nav-pills--brand .nav-link.active {
    background: #3B5D9C;
    color: #fff;
    padding: 5px 26px !important;
    border-radius: 2px;
  }
  .card-small{
    cursor: pointer;
  }
  .timeline-content{
    cursor: pointer;
  }
  .lalead {
    background: #EBB32E;
  }
  .laoppo {
    background: #28A745;
  }
  .laquot {
    background: #891482;
  }
  /*.laprof {
    background: #ff49ec;
  }*/
  .noti_pro_block {
    height: 500px !important;
  }
  
  .m-portlet__body.notification_block_body {
    padding: 0.2rem 2.2rem !important;
  }
</style>

<script src="<?php echo base_url(); ?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/drilldown.js"></script>
<script src="<?php echo base_url(); ?>assets/js/funnel.js"></script>
<script src="<?php echo base_url(); ?>assets/js/accessibility.js"></script>
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader">
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
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link">
                                 <span class="m-nav__link-text breadcrumb_fonts">Dashboard</span>
                              </a>
                           </li>
                          
                        </ul>
                     </div>
                     <span class="dashboard_block_dd_style">
                        <select class="form-control m_selectpicker top_access_style" id="dashboard_blocks_control" name="dashboard_blocks_control" multiple onchange="show_only_selected();" >
                          <?php if ($_SESSION['TablesLead Based LeadSource'] == 1) { ?>
                          <option selected value="lead_based_on_product_div">Lead Based On Product</option>
                          <?php } ?>
                          <?php if ($_SESSION['TablesLead Based LeadStatus'] == 1) { ?>
                          <option selected value="oppo_based_on_product_div">Opportunity Based On Product</option>
                          <?php } ?>
                          <?php if ($_SESSION['TablesQuote Based Stage'] == 1) { ?>
                          <option selected value="quote_based_on_stage_div">Quote Based on Stage</option>
                          <?php } ?>
                          <?php if ($_SESSION['TablesRecent Quotation'] == 1) { ?>
                          <option selected value="recent_quotation_div">Recent Quotations</option>
                          <?php } ?>
                          <?php if ($_SESSION['TablesTarget Statistics'] == 1) { ?>
                          <option selected value="target_statistics_div">Target Statistics</option>
                          <?php } ?>
                          <?php if ($_SESSION['TablesPI Based Stage'] == 1) { ?>
                          <option selected value="proforma_invoice_based_on_pi_stage_div">Proforma Invoice Based on PI stage</option> 
                          <?php } ?>
                          <?php if ($_SESSION['Graph And ChartPI Status'] == 1) { ?>
                          <option selected value="proforma_invoice_status_div">Proforma Invoice Status</option>
                          <?php } ?>
                          <?php if ($_SESSION['TablesTop Suppliers'] == 1) { ?>
                          <option selected value="top_least_suppliers_div">Top / Least Suppliers</option>
                          <?php } ?>
                        </select>
                    </span>
                  </div>
               </div>
               

               <!-- END: Subheader -->
               <div class="m-content">

                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">

                        <!--begin:: Dashboard/Counts-->
                        <div class="row">
                          <?php if($_SESSION['StatisticsLeads'] == 1){ ?>
                          <div class="col-lg-3">
                            <div class="card-small" onclick='window.open("<?php echo base_url(); ?>Leads", "_blank");'>
                              <p class="card__name">
                                  <span>Leads</span>
                              </p>
                              <i class="la la-filter lalead"></i>
                                         
                              <div class="card__number"><?php echo number_format($total_lead_count->today_leads); ?><span class="card_tod_green">&nbsp;Today</span></div>
                              <?php $diff_lead = $total_lead_count->yesterday_leads - $total_lead_count->today_leads; ?>
                              
                              <div class="card__change<?php if ($total_lead_count->yesterday_leads > $total_lead_count->today_leads) { echo '-down'; } elseif($total_lead_count->yesterday_leads == $total_lead_count->today_leads) { echo '-down'; } else { echo ''; }  ?>">
                                  <i class="fa fa-arrow<?php if ($total_lead_count->yesterday_leads > $total_lead_count->today_leads) { echo '-down'; } else if($total_lead_count->yesterday_leads == $total_lead_count->today_leads) { echo 's-alt-h'; } elseif ($total_lead_count->yesterday_leads < $total_lead_count->today_leads) { echo '-up'; }  ?>"></i>
                                  <span><?php echo abs($diff_lead); ?></span>                
                              </div>            
                              <div class="card_tod">Yesterday - <?php echo number_format($total_lead_count->yesterday_leads); ?></div> 
                              <div class="card_tod_right">OverAll - <?php echo number_format($total_lead_count->total_active_leads); ?></div>           
                            </div>
                          </div>
                          <?php } ?>
                          <?php if($_SESSION['StatisticsOpportunity'] == 1){ ?>
                          <div class="col-lg-3">
                            <div class="card-small" onclick='window.open("<?php echo base_url(); ?>Leads/opportunity_list", "_blank");'>
                              <p class="card__name">
                                  <span>Opportunities</span>
                              </p>
                              <i class="la la la-group laoppo" aria-hidden="true"></i>
                              <!-- <div class="card__number">4285</div>
                              <div class="card__change">
                                  <i class="fa fa-arrow-down"></i>
                                  <span>13</span>
                              </div> -->
                              <div class="card__number"><?php echo number_format($total_opportunity_count->today_opportunities); ?><span class="card_tod_green">&nbsp;Today</span></div>
                              <?php $diff_oppr = $total_opportunity_count->yesterday_opportunities - $total_opportunity_count->today_opportunities; ?>
                              

                              <div class="card__change<?php if ($total_opportunity_count->yesterday_opportunities > $total_opportunity_count->today_opportunities) { echo '-down'; } elseif($total_opportunity_count->yesterday_opportunities == $total_opportunity_count->today_opportunities) { echo '-down'; } else { echo ''; }  ?>">

                                  <i class="fa fa-arrow<?php if ($total_opportunity_count->yesterday_opportunities > $total_opportunity_count->today_opportunities) { echo '-down'; } elseif($total_opportunity_count->yesterday_opportunities == $total_opportunity_count->today_opportunities) { echo 's-alt-h'; } else { echo '-up'; }  ?>"></i>
                                  <span><?php echo abs($diff_oppr); ?></span>
                              </div>
                              <div class="card_tod">Yesterday - <?php echo number_format($total_opportunity_count->yesterday_opportunities); ?></div> 
                              <div class="card_tod_right">OverAll - <?php echo number_format($total_opportunity_count->total_active_opportunities); ?></div>
                            </div>
                          </div>
                          <?php } ?>
                          <?php if($_SESSION['StatisticsQuotes'] == 1){ ?>
                          <div class="col-lg-3">
                            <div class="card-small" onclick='window.open("<?php echo base_url(); ?>quote/", "_blank");'>
                              <p class="card__name">
                                  <span>Quotes</span>
                              </p>
                              <i class="la la-newspaper-o laquot" aria-hidden="true"></i>
                              <div class="card__number"><?php echo number_format($total_quotation_count->today_quote); ?><span class="card_tod_green">&nbsp;Today</span></div>
                              <?php $diff_quo = $total_quotation_count->yesterday_quote - $total_quotation_count->today_quote; ?>
                                          <div class="card__change<?php if ($total_quotation_count->yesterday_quote > $total_quotation_count->today_quote) { echo '-down'; } elseif($total_quotation_count->yesterday_quote == $total_quotation_count->today_quote) { echo '-down'; } else { echo ''; }  ?>">
                                  <i class="fa fa-arrow<?php if ($total_quotation_count->yesterday_quote > $total_quotation_count->today_quote) { echo '-down'; } elseif($total_quotation_count->yesterday_quote == $total_quotation_count->today_quote) { echo 's-alt-h'; } else { echo '-up'; }  ?>"></i>
                                  <span><?php echo abs($diff_oppr); ?></span>
                              </div>

                              <div class="card_tod">Yesterday - <?php echo number_format($total_quotation_count->yesterday_quote); ?></div> 
                              <div class="card_tod_right">OverAll - <?php echo number_format($total_quotation_count->total_active_quo); ?></div>
                            </div>
                          </div>
                          <?php } ?>
                          <?php if($_SESSION['StatisticsPI'] == 1){ ?>
                          <div class="col-lg-3">
                            <div class="card-small" onclick='window.open("<?php echo base_url(); ?>proformainvoice/", "_blank");'>
                              <p class="card__name">
                                  <span>Proforma Invoice</span>
                              </p>
                              <i class="la la-file-text laprof" aria-hidden="true"></i>
                              <div class="card__number"><?php echo number_format($total_proforma_count->today_pro_inv); ?><span class="card_tod_green">&nbsp;Today</span></div>
                              <?php $diff_pro = $total_proforma_count->yesterday_pro_inv - $total_proforma_count->today_pro_inv; ?>
                              

                              <div class="card__change<?php if ($total_proforma_count->yesterday_pro_inv > $total_proforma_count->today_pro_inv) { echo '-down'; } elseif($total_proforma_count->yesterday_pro_inv == $total_proforma_count->today_pro_inv) { echo '-down'; } else { echo ''; }  ?>">
                                  <i class="fa fa-arrow<?php if ($total_proforma_count->yesterday_pro_inv > $total_proforma_count->today_pro_inv) { echo '-down'; } elseif($total_proforma_count->yesterday_pro_inv == $total_proforma_count->today_pro_inv) { echo 's-alt-h'; } else { echo '-up'; }  ?>"></i>
                                  <span><?php echo abs($diff_oppr); ?></span>
                              </div>

                              <div class="card_tod">Yesterday - <?php echo number_format($total_proforma_count->yesterday_pro_inv); ?></div> 
                              <div class="card_tod_right">OverAll - <?php echo number_format($total_proforma_count->total_active_pro_inv); ?></div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>

                        <!--end:: Widgets/Top Products-->
                     </div>
                     
                     
                  </div>

                  <!--End::Section-->

                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-6">
                        <!--begin:: Widgets/Tasks -->
                        <div class="m-portlet m-portlet--full-height noti_pro_block">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Notifications
                                    </h3>
                                 </div>
                              </div>
                              <?php
                                $notification_rp_arr = array($_SESSION['NotificationLeads'], $_SESSION['NotificationJO'], $_SESSION['NotificationBO'], $_SESSION['NotificationUnattended Leads']);
                                $lead_noti_active = "0";
                                $JO_noti_active = "0";
                                $BO_noti_active = "0";
                                $unlead_noti_active = "0";
                                for ($i=0; $i < count($notification_rp_arr); $i++) { 
                                  if ($notification_rp_arr[$i] == 1) {
                                    if ($i == 0) {
                                      $lead_noti_active = "1";
                                      break;
                                    }
                                    elseif ($i == 1) {
                                      $JO_noti_active = "1";
                                      break;
                                    }
                                    elseif ($i == 2) {
                                      $BO_noti_active = "1";
                                      break;
                                    }
                                    elseif ($i == 3) {
                                      $unlead_noti_active = "1";
                                      break;
                                    }
                                  }
                                }
                              ?>
                              <div class="m-portlet__head-tools">
                                 <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                  <?php if ($_SESSION['NotificationLeads'] == 1) { ?>
                                    <li class="nav-item m-tabs__item">
                                       <a class="nav-link m-tabs__link nav-link-pad <?php echo ($lead_noti_active == "1") ? "active show" : ""; ?>" data-toggle="tab" href="#m_widget2_tab1_content" role="tab">
                                       Lead
                                       </a>
                                    </li>
                                  <?php } ?>
                                  <?php if ($_SESSION['NotificationJO'] == 1) { ?>
                                    <li class="nav-item m-tabs__item">
                                       <a class="nav-link m-tabs__link nav-link-pad <?php echo ($JO_noti_active == "1") ? "active show" : ""; ?>" data-toggle="tab" href="#m_widget2_tab2_content1" role="tab">
                                       Job Order
                                       </a>
                                    </li>
                                  <?php } ?>
                                  <?php if ($_SESSION['NotificationBO'] == 1) { ?>  
                                    <li class="nav-item m-tabs__item">
                                       <a class="nav-link m-tabs__link nav-link-pad <?php echo ($BO_noti_active == "1") ? "active show" : ""; ?>" data-toggle="tab" href="#m_widget2_tab3_content1" role="tab">
                                       Buyer Order
                                       </a>
                                    </li>
                                  <?php } ?>
                                  <?php if ($_SESSION['NotificationUnattended Leads'] == 1) { ?>  
                                    <li class="nav-item m-tabs__item">
                                       <a class="nav-link m-tabs__link nav-link-pad <?php echo ($unlead_noti_active == "1") ? "active show" : ""; ?>" data-toggle="tab" href="#m_widget2_tab4_content1" role="tab">
                                       Un-Attended Leads
                                       </a>
                                    </li>
                                  <?php } ?>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body notification_block_body">
                              <div class="tab-content">

                                 <div class="tab-pane <?php echo ($lead_noti_active == "1") ? "active show" : ""; ?>" id="m_widget2_tab1_content">
                                    <div class="row">
                                       
                                      <div class="col-lg-4 expand_width">

                                       <?php if ($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>
                                        
                                          <select class="form-control m_selectpicker" data-live-search = "true" onchange="get_lead_notification_by_filter();" id="lead_noti_assign_person">
                                             <option value="">All Users</option>
                                             <?php
                                                if(!empty($assigned_user_lists))
                                                {  
                                                   foreach ($assigned_user_lists as  $assigned_user_list) { ?>
                                                      <option value="<?php echo $assigned_user_list->user_id; ?>"><?php echo $assigned_user_list->name; ?></option>
                                                   <?php } 
                                                }
                                             ?>
                                          </select>
                                        <?php } else { ?>
                                          <input type="hidden" id="lead_noti_assign_person" name="lead_noti_assign_person" value="<?php echo $_SESSION['admindata']['user_id'];?>">
                                        <?php } ?>      
                                       </div>

                                       <div class="col-lg-4 expand_width">
                                          <select class="form-control m_selectpicker" data-live-search = "true" onchange="get_lead_notification_by_filter();" id="lead_noti_product">
                                             <option value="">All Products</option>
                                             <?php foreach ($get_all_product as $product) { ?>
                                             <option value="<?php echo $product->product_id ?>"><?php echo $product->product_name; ?></option>
                                             <?php } ?>
                                          </select>      
                                       </div>

                                       <div class="col-lg-4 expand_width">
                                         <a href="<?php echo base_url(); ?>Dashboard/lead_notification_page" data-toggle="m-tooltip" data-placement="top" title="View" class="tooltip-animation btn btn-primary" target="_blank" style="width: 49px;"><i class="la la-eye"></i></a>
                                       </div>
                                       
                                    </div>
                                    <div class="mt_25px"></div>
                                    <div class="timeline timeline-3 dashboard_notification_body" id="lead_noti_append_filt">
                                       <div class="timeline-items">
                                          <?php if (!empty($lead_notifications)) { 
                                             foreach ($lead_notifications as $lead_notification) {
                                             ?>
                                                <div class="timeline-item">
                                                   <div class="timeline-media-<?php echo (date('Y-m-d') > date('Y-m-d',strtotime($lead_notification->followup_date))) ? 'job' : 'lead'; ?>">
                                                      <?php echo date('M',strtotime($lead_notification->followup_date)); ?><br/><?php echo date('d',strtotime($lead_notification->followup_date)); ?>
                                                   </div>
                                                   <div class="timeline-content">
                                                      <div class="d-flex align-items-center justify-content-between mb-3">
                                                         <div class="mr-2">                        
                                                            <b><?php echo ucfirst($lead_notification->lead_name); ?></b> from <b><?php echo ucfirst($lead_notification->country_name); ?></b> regarding <b><?php echo ucfirst($lead_notification->product_name); ?></b> has a sales follow up at <b><?php echo $lead_notification->followup_time; ?></b> to be  
                                                            followed by 
                                                            <span class="text-muted ml-2">
                                                            <?php echo ucfirst($lead_notification->name); ?>
                                                            </span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                          <?php } } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane <?php echo ($JO_noti_active == "1") ? "active show" : ""; ?>" id="m_widget2_tab2_content1">
                                    <div class="row">
                                       
                                       <div class="col-lg-4 expand_width">
                                        <?php if ($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>
                                          <select class="m_selectpicker form-control" data-live-search = "true" id="joborder_noti_assign_person" name="joborder_noti_assign_person" onchange="get_joborder_noti_filt();">
                                              <option value="">All Users</option>
                                              <?php
                                                if(!empty($assigned_user_lists))
                                                {  
                                                   foreach ($assigned_user_lists as  $assigned_user_list) { ?>
                                                      <option value="<?php echo $assigned_user_list->user_id; ?>"><?php echo $assigned_user_list->name; ?></option>
                                                   <?php } 
                                                }
                                             ?>
                                          </select>      
                                        <?php } else { ?>
                                          <input type="hidden" id="joborder_noti_assign_person" name="joborder_noti_assign_person" value="<?php echo $_SESSION['admindata']['user_id'];?>">
                                        <?php } ?>
                                       </div>
                                       <div class="col-lg-4 expand_width">
                                          <select class="form-control m_selectpicker" data-live-search = "true" onchange="get_joborder_noti_filt();" id="joborder_noti_product">
                                             <option value="">All Products</option>
                                             <?php foreach ($get_all_product as $product) { ?>
                                             <option value="<?php echo $product->product_id ?>"><?php echo $product->product_name; ?></option>
                                             <?php } ?>
                                          </select>      
                                       </div>
                                       <div class="col-lg-4 expand_width">
                                         <a href="<?php echo base_url(); ?>Dashboard/joborder_notification_page" style="width: 49px;" target="_blank" data-toggle="m-tooltip" data-placement="top" title="View" class="tooltip-animation btn btn-primary"><i class="la la-eye"></i></a>
                                       </div>
                                    </div>
                                    <div class="mt_25px"></div>
                                    <div class="timeline timeline-3 dashboard_notification_body" id="joborder_noti_append_filt">
                                       <div class="timeline-items">
                                          <?php if (!empty($joborder_notifications)) { 
                                             foreach ($joborder_notifications as $joborder_notification) {
                                             ?>
                                          <div class="timeline-item">
                                             <div class="timeline-media-<?php echo (date('Y-m-d') > date('Y-m-d',strtotime($joborder_notification->job_order_end_date))) ? 'job' : 'lead'; ?>">
                                                <?php echo date('M',strtotime($joborder_notification->job_order_end_date)); ?><br/><?php echo date('d',strtotime($joborder_notification->job_order_end_date)); ?>
                                             </div>
                                             <div class="timeline-content">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                   <div class="mr-3">                        
                                                      <b><?php echo ucfirst($joborder_notification->product_name); ?></b> from <b><?php echo $joborder_notification->job_order_no; ?></b> given is <?php echo (date('Y-m-d') > date('Y-m-d',strtotime($joborder_notification->job_order_end_date))) ? 'over' : 'near'; ?> to due                 
                                                      <span class="text-muted ml-2">
                                                      <?php echo ucfirst($joborder_notification->vendor_name).'-'.ucfirst($joborder_notification->vendor_city); ?>
                                                      </span>                        
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <?php } } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane <?php echo ($BO_noti_active == "1") ? "active show" : ""; ?>" id="m_widget2_tab3_content1">
                                    <div class="row">
                                       
                                       <div class="col-lg-4 expand_width">
                                        <?php if ($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>
                                          <select class="form-control m_selectpicker" data-live-search = "true" onchange="get_buyerorder_notification_by_filter();" id="buyerorder_noti_assign_person">
                                             <option value="">All Users</option>
                                             <?php
                                                if(!empty($assigned_user_lists))
                                                {  
                                                   foreach ($assigned_user_lists as  $assigned_user_list) { ?>
                                                      <option value="<?php echo $assigned_user_list->user_id; ?>"><?php echo $assigned_user_list->name; ?></option>
                                                   <?php } 
                                                }
                                             ?>
                                          </select>
                                        <?php } else { ?>
                                          <input type="hidden" id="buyerorder_noti_assign_person" name="buyerorder_noti_assign_person" value="<?php echo $_SESSION['admindata']['user_id'];?>">
                                        <?php } ?>      
                                       </div>
                                       <div class="col-lg-4 expand_width">
                                          <select class="form-control m_selectpicker" data-live-search = "true" onchange="get_buyerorder_notification_by_filter();" id="buyerorder_noti_product">
                                             <option value="">All Products</option>
                                             <?php foreach ($get_all_product as $product) { ?>
                                             <option value="<?php echo $product->product_id ?>"><?php echo $product->product_name; ?></option>
                                             <?php } ?>
                                          </select>      
                                       </div>
                                       <div class="col-lg-4 expand_width">
                                         <a href="<?php echo base_url(); ?>Dashboard/buyerorder_notification_page" target="_blank" style="width: 49px;" data-toggle="m-tooltip" data-placement="top" title="View" class="tooltip-animation btn btn-primary"><i class="la la-eye"></i></a>
                                       </div>
                                    </div>
                                    <div class="mt_25px"></div>
                                    <div class="timeline timeline-3 dashboard_notification_body" id="buyerorder_noti_append_filt">
                                        <div class="timeline-items">
                                           <?php if (!empty($buyerorder_notifications)) { 
                                              foreach ($buyerorder_notifications as $buyerorder_notification) {
                                              ?>
                                           <div class="timeline-item">
                                              <div class="timeline-media-<?php echo (date('Y-m-d') > date('Y-m-d',strtotime($buyerorder_notification->order_end_date))) ? 'job' : 'lead'; ?>">
                                                 <?php echo date('M',strtotime($buyerorder_notification->order_end_date)); ?><br/><?php echo date('d',strtotime($buyerorder_notification->order_end_date)); ?>
                                              </div>
                                              <div class="timeline-content">
                                                 <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <div class="mr-3">  
                                                       The order code <b><?php echo $buyerorder_notification->buyer_order_invoice_no; ?></b> Assigned Person is <b><?php echo $buyerorder_notification->name; ?></b>, of this products (<b><?php echo ucfirst($buyerorder_notification->products_name); ?></b>) which its supplied to the buyer <?php echo (date('Y-m-d') > date('Y-m-d',strtotime($buyerorder_notification->order_end_date))) ? 'End date is Over' : 'will be ended soon'; ?> .
                                
                                                                      
                                                       <span class="text-muted ml-2">
                                                       <?php echo ucfirst($buyerorder_notification->lead_name).'-'.ucfirst($buyerorder_notification->lead_country); ?>
                                                       </span>                        
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                           <?php } } ?>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane <?php echo ($unlead_noti_active == "1") ? "active show" : ""; ?>" id="m_widget2_tab4_content1">

                                    <div class="row">
                                       
                                       <div class="col-lg-4 expand_width">
                                        <?php if ($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>
                                          <select class="form-control m_selectpicker" data-live-search = "true" onchange="get_lessmail_reply_notification_by_filter();" id="lessmail_reply_noti_assign_person">
                                             <option value="">All Users</option>
                                             <?php
                                                if(!empty($assigned_user_lists))
                                                {  
                                                   foreach ($assigned_user_lists as  $assigned_user_list) { ?>
                                                      <option value="<?php echo $assigned_user_list->user_id; ?>"><?php echo $assigned_user_list->name; ?></option>
                                                   <?php } 
                                                }
                                             ?>
                                          </select>
                                          <?php } else { ?>
                                          <input type="hidden" id="lessmail_reply_noti_assign_person" name="lessmail_reply_noti_assign_person" value="<?php echo $_SESSION['admindata']['user_id'];?>">
                                        <?php } ?>      
                                       </div>
                                       <div class="col-lg-4 expand_width">
                                          <select class="form-control m_selectpicker" data-live-search = "true" onchange="get_lessmail_reply_notification_by_filter();" id="lessmail_reply_noti_product">
                                             <option value="">All Products</option>
                                             <?php foreach ($get_all_product as $product) { ?>
                                             <option value="<?php echo $product->product_id ?>"><?php echo $product->product_name; ?></option>
                                             <?php } ?>
                                          </select>      
                                       </div>
                                       <div class="col-lg-4 expand_width">
                                         <a href="<?php echo base_url(); ?>Dashboard/lessreply_notification_page" style="width: 49px;" data-toggle="m-tooltip" data-placement="top" title="View" class="tooltip-animation btn btn-primary" target="_blank"><i class="la la-eye"></i></a>
                                       </div>
                                    </div>
                                    <div class="mt_25px"></div>
                                    <div class="timeline timeline-3 dashboard_notification_body" id="lessmail_reply_noti_append_filt">
                                        <div class="timeline-items">
                                           <?php 
                                           $g_settings = common_select_values('*', 'general_settings', '', 'row');
                                           $max_replies = $g_settings->lead_replies_max;
                                           if (!empty($lessmail_reply_notifications)) { 
                                              foreach ($lessmail_reply_notifications as $lessreply_notification) {
                                                $now = time();
                                                $create_date = strtotime($lessreply_notification->created_on);
                                                $datediff = $now - $create_date;

                                                $diff_days = round($datediff / (60 * 60 * 24));
                                                if ($diff_days > $g_settings->lead_unattend_minimum_duration) {
                                                 if ($lessreply_notification->lead_replies < $max_replies) {
                                              ?>
                                           <div class="timeline-item">
                                              <div class="timeline-media-<?php $date_raw = date('Y-m-d'); echo (date('Y-m-d',strtotime('-10 day', strtotime($date_raw))) > date('Y-m-d',strtotime($lessreply_notification->last_reply_date))) ? 'job' : 'lead'; ?>">
                                                 <?php echo date('M',strtotime($lessreply_notification->last_reply_date)); ?><br/><?php echo date('d',strtotime($lessreply_notification->last_reply_date)); ?>
                                              </div>
                                              <div class="timeline-content">
                                                 <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <div class="mr-3"> 
                                                      <b><?php echo $lessreply_notification->name; ?></b> Sent Only <b><?php echo $lessreply_notification->lead_replies; ?></b> to <b><?php echo ucfirst($lessreply_notification->lead_name); ?></b> From <b><?php echo ucfirst($lessreply_notification->country_name); ?></b>, Who is since from CRM On <b><?php echo date('d-m-Y',strtotime($lessreply_notification->created_on)); ?></b>.           
                                                       <span class="text-muted ml-2">
                                                       
                                                       </span>                        
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                           <?php } } } } ?>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--end:: Widgets/Tasks -->
                     </div>
                     <?php if ($_SESSION['Graph And ChartTop Product'] == 1) { ?>
                     <div class="col-xl-6">
                        <div class="m-portlet m-portlet--full-height noti_pro_block">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       <span id="pro_top_or_least">Top <?php $dash_noti = get_dashboard_settings_info(); echo $dash_noti->max_product_count; ?> Productss </span>
                                       <input type="hidden" id="ptc" value="<?php echo $dash_noti->max_product_count; ?>">
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <select class="form-control custom-select" onchange="get_product_chart_by_filter();" id="top_least_pro_filt">
                                    <option value="1">Top</option>
                                    <option value="0">Least</option>
                                 </select>
                                 &nbsp;&nbsp;
                                 <input type="text" class="form-control finance_year" id="top_least_pro_year_filt" value="<?php echo date('m'); if(date('m') > '03'){ echo date('Y').'-'.date('Y',strtotime('+1 year')); } else { echo date('Y',strtotime('-1 year')).'-'.date('Y'); } ?>" onchange = "get_product_chart_by_filter();">  
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div id="top_5_products_container"></div>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                  </div>

                  <!--End::Section-->

                  <!--Begin::Section-->
              <div class="row">
                <?php if ($_SESSION['Graph And ChartSales Statistics'] == 1) { ?>
                 <div class="col-xl-6">
                    <!--begin:: Widgets/Support Tickets -->
                    <div class="m-portlet m-portlet--full-height ">
                       <div class="m-portlet__head">
                          <div class="m-portlet__head-caption">
                             <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                   Sales Statistics
                                </h3>
                             </div>
                          </div>
                          <div class="m-portlet__head-tools">
                            <div class="row">
                              <div class="col-lg-4 expand_width_funnel">
                                <?php if ($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>
                                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="funnel_sales_user" id="funnel_sales_user" onchange="get_funnel_report_by_year();">
                                   <option value="">All Users</option>
                                   <?php foreach($assigned_user_lists as $ulist){
                                     if($ulist->role_id!=1){?>
                                     <option value='<?php echo $ulist->user_id;?>'><?php echo $ulist->name;?></option>
                                   <?php }}?>
                                </select>
                                <?php } else { ?>
                                <input type="hidden" id="funnel_sales_user" name="funnel_sales_user" value="<?php echo $_SESSION['admindata']['user_id'];?>">
                                <?php } ?>   
                              </div>
                              <div class="col-lg-4 expand_width_funnel">
                                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="funnel_product" id="funnel_product" onchange="get_funnel_report_by_year();">
                                    <option value="">All Products</option>
                                    <?php foreach ($get_all_product as $product) { ?>
                                    <option value="<?php echo $product->product_id ?>"><?php echo $product->product_name; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <div class="col-lg-4 expand_width_funnel">
                                <input type="text" class="form-control finance_year" id="funnel_year" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>" onchange="get_funnel_report_by_year();">
                              </div>   
                            </div>
                                    
                          </div>
                       </div>
                       <div class="m-portlet__body">
                          <div id="container1"></div>
                       </div>
                    </div>
                    <!--end:: Widgets/Support Tickets -->
                 </div>
                <?php } ?>
                <?php if ($_SESSION['Graph And ChartTop LeadSource'] == 1) { ?>
                 <div class="col-xl-6">
                    <!--begin:: Widgets/Support Tickets -->
                    <div class="m-portlet m-portlet--full-height ">
                       <div class="m-portlet__head">
                          <div class="m-portlet__head-caption">
                             <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                   <span id="ls_top_or_least">Top <?php echo $dash_noti->max_lead_source_count; ?> Lead Sources </span>
                                   <input type="hidden" id="lstc" value="<?php echo $dash_noti->max_lead_source_count; ?>">
                                </h3>
                             </div>
                          </div>
                          <div class="m-portlet__head-tools">
                             <select class="form-control custom-select" onchange="get_lead_source_chart_by_filter();" id="top_least_ls_filt">
                                <option value="1">Top</option>
                                <option value="0">Least</option>
                             </select>
                             &nbsp;&nbsp;
                             <input type="text" class="form-control finance_year" id="top_least_ls_year_filt" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>" onchange = "get_lead_source_chart_by_filter();">        
                          </div>
                       </div>
                       <div class="m-portlet__body">
                          <div id="top_5_lead_sources_container"></div>
                       </div>
                    </div>
                    <!--end:: Widgets/Support Tickets -->
                 </div>
                <?php } ?>
              </div>

                  <!--End::Section-->
                  <?php if ($_SESSION['TablesLead Based LeadSource'] == 1) { ?>
                  <div class="row hide_div_class" id="lead_based_on_product_div">
                     <div class="col-xl-12">

                        <!--begin:: Widgets/Tasks -->
                        
                        <div class="m-portlet m-portlet--full-height ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Lead Based On Product
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools"> 
                                <div class="row">
                                  <div class="col-lg-2 expand_width">     
                                  <?php if($_SESSION['admindata']['user_hasnt_product']==1){ ?>                        
                                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_sales_user" id="lead_sales_user" onchange="get_dynamic_lead_based_on_product();">
                                         <option value="">All Users</option>
                                         <?php foreach($assigned_user_lists as $ulist){
                                           if($ulist->role_id!=1){?>
                                           <option value='<?php echo $ulist->user_id;?>'><?php echo $ulist->name;?></option>
                                         <?php }} ?>
                                      </select>
                                    <?php } else { ?>
                                      <input type="hidden" id="lead_sales_user" name="lead_sales_user" value="<?php echo $_SESSION['admindata']['user_id']; ?>">
                                    <?php } ?>
                                  </div>

                                  <div class="col-lg-2 expand_width">  
                                  <?php if($_SESSION['admindata']['user_hasnt_product']==1){ ?>                            
                                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_industry" id="lead_industry" onchange="get_dynamic_lead_based_on_product();">
                                         <option value="">All Industry</option>
                                         <?php foreach($industry_lists as $indlist){
                                            ?>
                                           <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                         <?php } ?>
                                      </select>
                                      <?php } else { ?>
                                      <input type="hidden" id="lead_industry" name="lead_industry" value="">
                                    <?php } ?>
                                  </div>
                                  <div class="col-lg-2 expand_width">                              
                                      <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source_filt" id="lead_source_filt" onchange="get_dynamic_lead_based_on_product();" multiple>
                                         <option value="">All Lead Source</option>
                                         <?php foreach($lead_sources_for_filt as $lead_source){
                                            ?>
                                           <option selected value='<?php echo $lead_source->lead_source_id;?>'><?php echo $lead_source->lead_source;?></option>
                                         <?php } ?>
                                      </select>
                                  </div>
                                  <div class="col-lg-2 expand_width">
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_filt_type" id="lead_filt_type" onchange="lead_filt_type();">
                                         <option value="0">Year</option>
                                         <option value="1">Day</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-2 expand_width lead_filt_year" >
                                      <input type="text" class="form-control finance_year" id="lead_financial_year" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>" onchange="get_dynamic_lead_based_on_product();">
                                  </div>
                                  <div class="col-lg-2 expand_width lead_filt_year">
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_quarter" id="lead_quarter" onchange="get_dynamic_lead_based_on_product();">
                                      <option value="">All Quarter Year</option>
                                      <?php foreach ($quarter_list as $quarter) { ?>
                                         <option value="<?php echo $quarter->quarter_id; ?>"><?php echo $quarter->quarter_label; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="col-lg-2 expand_width" id="lead_filt_day" style="display: none;">
                                    <div class="form-group m-form__group">
                                        
                                        <select class="custom-select form-control" id="lead_searchChange" name="lead_searchChange" onchange="get_dynamic_lead_based_on_product();">
                                           <option value="">Select</option>
                                           <option value="today">Today</option>
                                                <option value="thisweek">This Week</option>
                                                <option value="thismonth">This Month</option>
                                                <option value="thisyear">This Year</option>
                                                <option value="thisDate">Date</option>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-lg-2 expand_width" id="lead_date_range" style="display: none;">
                                       <div class="form-group m-form__group">
                                          <!-- <input class="form-control m-input m-input--square" id="m_daterangepicker_3" name="dtrange" placeholder="Choose Date" value="" type="text"> -->
                                          <div class="m-input-icon pull-right" id='m_daterangepicker_3'>
                                             <input class="form-control m-input m-input--square lead_dtrange" id="m_daterangepicker_3" placeholder="Choose Date" value="" type="text" onblur ="get_dynamic_lead_based_on_product();" onchange="get_dynamic_lead_based_on_product();" onfocus="get_dynamic_lead_based_on_product();" onkeyup="get_dynamic_lead_based_on_product();">
                                          </div>
                                       </div>
                                    </div>
                                </div>      
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div id="dynamic_lead_based_on_product_append">
                                 
                              </div>
                           </div>
                        </div>
                                 
                        <!--end:: Widgets/Tasks -->
                     </div>
                  </div>
                  <?php } ?>  
                  <!--Begin::Section-->
                  <?php if ($_SESSION['TablesLead Based LeadStatus'] == 1) { ?>
                  <div class="row hide_div_class" id="oppo_based_on_product_div">
                     <div class="col-xl-12">
                        <!--begin:: Widgets/Tasks -->
                        <div class="m-portlet m-portlet--full-height ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Opportunity Based on Product
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">  
                                <div class="row">
                                  <div class="col-lg-2 expand_width">
                                  <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>                    
                                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="sales_user" id="sales_user" onchange="get_dynamic_opportunity_based_on_industry();">
                                          <option value="">All Users</option>
                                         <?php foreach($assigned_user_lists as $ulist){
                                           if($ulist->role_id!=1){?>
                                           <option value='<?php echo $ulist->user_id;?>'><?php echo $ulist->name;?></option>
                                         <?php }} ?>
                                    </select>
                                    <?php } else { ?>
                                      <input type="hidden" name="sales_user" id="sales_user" value="<?php echo $_SESSION['admindata']['user_id']; ?>">
                                    <?php } ?>
                                  </div>
                                  <div class="col-lg-2 expand_width">
                                    <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>   
                                    <select class="form-control m_selectpicker" data-live-search = "true" id="oppo_indus_id" name="oppo_indus_id" onchange="get_dynamic_opportunity_based_on_industry();">
                                      <option value="">All Industry</option>
                                         <?php foreach($industry_lists as $indlist){
                                            ?>
                                         <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                         <?php } ?>
                                    </select>
                                    <?php } else { ?>
                                      <input type="hidden" name="oppo_indus_id" id="oppo_indus_id" value="">
                                    <?php } ?>
                                  </div>
                                  <div class="col-lg-2 expand_width">
                                    <select class="form-control m_selectpicker" data-live-search = "true" id="oppo_status_id" name="oppo_status_id" onchange="get_dynamic_opportunity_based_on_industry();" multiple>
                                      <option value="">All Status</option>
                                         <?php foreach($oppo_status_lists as $lead_status){
                                            ?>
                                         <option selected value='<?php echo $lead_status->oppo_status_id;?>'><?php echo $lead_status->oppo_status;?></option>
                                         <?php } ?>
                                    </select>
                                  
                                  </div>
                                  <div class="col-lg-2 expand_width">
                                      <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="oppo_filt_type" id="oppo_filt_type" onchange="oppo_filt_type();">
                                           <option value="0">Year</option>
                                           <option value="1">Day</option>
                                      </select>
                                    </div>
                                    <div class="col-lg-2 expand_width oppo_filt_year" >
                                        <input type="text" class="form-control finance_year" id="oppo_financial_year" onchange="
                                      get_dynamic_opportunity_based_on_industry();" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>" >
                                    </div>
                                    <div class="col-lg-2 expand_width oppo_filt_year">
                                      <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="oppo_quarter" id="oppo_quarter" onchange="get_dynamic_opportunity_based_on_industry();">
                                        <option value="">All Quarter Year</option>
                                        <?php foreach ($quarter_list as $quarter) { ?>
                                           <option value="<?php echo $quarter->quarter_id; ?>"><?php echo $quarter->quarter_label; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-lg-2 expand_width" id="oppo_filt_day" style="display: none;">
                                      <div class="form-group m-form__group">
                                          
                                          <select class="custom-select form-control" id="oppo_searchChange" name="oppo_searchChange" onchange="get_dynamic_opportunity_based_on_industry();">
                                             <option value="">Select</option>
                                             <option value="today">Today</option>
                                                  <option value="thisweek">This Week</option>
                                                  <option value="thismonth">This Month</option>
                                                  <option value="thisyear">This Year</option>
                                                  <option value="thisDate">Date</option>
                                          </select>
                                      </div>
                                    </div>

                                    <div class="col-lg-2 expand_width" id="oppo_date_range" style="display: none;">
                                         <div class="form-group m-form__group">
                                            <!-- <input class="form-control m-input m-input--square" id="m_daterangepicker_3" name="dtrange" placeholder="Choose Date" value="" type="text"> -->
                                            <div class="m-input-icon pull-right" id='m_daterangepicker_11'>
                                               <input class="form-control m-input m-input--square oppo_dtrange" id="m_daterangepicker_11" placeholder="Choose Date" value="" type="text" onblur ="get_dynamic_opportunity_based_on_industry();" onchange="get_dynamic_opportunity_based_on_industry();" onfocus="get_dynamic_opportunity_based_on_industry();" onkeyup="get_dynamic_opportunity_based_on_industry();">
                                            </div>
                                         </div>
                                      </div>
                                            
                                </div>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div id="dynamic_opportunity_based_on_industry_append">
                                 
                              </div>
                           </div>
                        </div>
                                 
                        <!--end:: Widgets/Tasks -->
                     </div>
                     
                  </div>
                  <?php } ?>

                  <!--End::Section-->

                  <!--Begin::Section-->
                  <?php if ($_SESSION['TablesQuote Based Stage'] == 1) { ?>
                  <div class="row hide_div_class" id="quote_based_on_stage_div">
                     <div class="col-xl-12">

                        <!--begin:: Widgets/Tasks -->
                        
                        <div class="m-portlet m-portlet--full-height ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Quote Based on Stage
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">                               
                                <div class="row">
                                  <div class="col-lg-2 expand_width">
                                    <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>  
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="quo_sales_user" id="quo_sales_user" onchange="get_dynamic_quote_based_on_industry();">
                                       <option value="">All Users</option>
                                       <?php foreach($assigned_user_lists as $ulist){
                                         if($ulist->role_id!=1){?>
                                         <option value='<?php echo $ulist->user_id;?>'><?php echo $ulist->name;?></option>
                                       <?php }} ?>
                                    </select>
                                    <?php } else { ?>
                                      <input type="hidden" name="quo_sales_user" id="quo_sales_user" value="<?php echo $_SESSION['admindata']['user_id']; ?>">
                                  <?php } ?>
                                  </div>
                                  
                                  <div class="col-lg-2 expand_width">
                                    <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?> 
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="quote_industry" id="quote_industry" onchange="get_dynamic_quote_based_on_industry();">
                                        <option value="">All Industry</option>
                                        <?php foreach($industry_lists as $indlist){
                                          ?>
                                       <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                       <?php } ?>
                                     </select>
                                     <?php } else { ?>
                                      <input type="hidden" name="quote_industry" id="quote_industry" value="<?php echo $_SESSION['admindata']['user_id']; ?>">
                                  <?php } ?>
                                  </div>
                                  <div class="col-lg-2 expand_width">
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="quo_stage_filt" id="quo_stage_filt" onchange="get_dynamic_quote_based_on_industry();" multiple>
                                       <option value="">All Quote Stage</option>
                                       <?php foreach ($quote_stage_list as $quote_stage) { ?>
                                                <option selected value="<?php echo $quote_stage['quote_stage_id']; ?>"><?php echo $quote_stage['quote_stage']; ?></option>
                                                
                                        <?php } ?>>
                                    </select>
                                  </div>
                                  <div class="col-lg-2 expand_width">
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="quote_filt_type" id="quote_filt_type" onchange="quote_filt_type();">
                                         <option value="0">Year</option>
                                         <option value="1">Day</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-2 expand_width quote_filt_year" >
                                      <input type="text" class="form-control finance_year" id="quote_financial_year" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>" onchange="get_dynamic_quote_based_on_industry();">
                                  </div>
                                  <div class="col-lg-2 expand_width quote_filt_year">
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="quote_quarter" id="quote_quarter" onchange="get_dynamic_quote_based_on_industry();">
                                      <option value="">All Quarter Year</option>
                                      <?php foreach ($quarter_list as $quarter) { ?>
                                         <option value="<?php echo $quarter->quarter_id; ?>"><?php echo $quarter->quarter_label; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="col-lg-2 expand_width" id="quote_filt_day" style="display: none;">
                                    <div class="form-group m-form__group">
                                        
                                        <select class="custom-select form-control" id="quote_searchChange" name="quote_searchChange" onchange="get_dynamic_quote_based_on_industry();">
                                           <option value="">Select</option>
                                           <option value="today">Today</option>
                                                <option value="thisweek">This Week</option>
                                                <option value="thismonth">This Month</option>
                                                <option value="thisyear">This Year</option>
                                                <option value="thisDate">Date</option>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-lg-2 expand_width" id="quote_date_range" style="display: none;">
                                       <div class="form-group m-form__group">
                                          <!-- <input class="form-control m-input m-input--square" id="m_daterangepicker_3" name="dtrange" placeholder="Choose Date" value="" type="text"> -->
                                          <div class="m-input-icon pull-right" id='m_daterangepicker_12'>
                                             <input class="form-control m-input m-input--square quote_dtrange" id="m_daterangepicker_12" placeholder="Choose Date" value="" type="text" onblur ="get_dynamic_quote_based_on_industry();" onchange="get_dynamic_quote_based_on_industry();" onfocus="get_dynamic_quote_based_on_industry();" onkeyup="get_dynamic_quote_based_on_industry();">
                                          </div>
                                       </div>
                                    </div>
                                    
                                </div>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div id="dynamic_quote_based_on_industry_append">
                                 
                              </div>
                           </div>
                        </div>
                                 
                        <!--end:: Widgets/Tasks -->
                     </div>
                     
                  </div>
                  <?php } ?>
                  <?php if ($_SESSION['TablesRecent Quotation'] == 1) { ?>
                  <div class="row hide_div_class" id="recent_quotation_div">
                     <div class="col-xl-12">

                        <!--begin:: Widgets/Tasks -->
                        
                        <div class="m-portlet m-portlet--full-height ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Recent Quotations
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">                               
                                <!-- <select class="form-control custom-select" id="quote_product_id" name="quote_product_id" onchange="getQuoteList();">
                                  <option value=''>Select Product</option>
                                  <?php //foreach($product_list as $plist){?>
                                    <option value='<?php //echo $plist['product_id'];?>'><?php //echo $plist['product_name'];?></option>
                                  <?php //}?>
                                </select>                        
                                &nbsp;&nbsp; -->
                                <div class="row">
                                  <div class="col-lg-4"></div>
                                  <div class="col-lg-2 expand_width">
                                    <?php if($_SESSION['admindata']['user_hasnt_product']==1){?>
                                  <select class="form-control custom-select" id="quote_user_id" name="quote_user_id" onchange="getQuoteList();">
                                    <option value="">All User</option>
                                    <?php foreach($assigned_user_lists as $ulist){
                                         if($ulist->role_id!=1){?>
                                         <option value='<?php echo $ulist->user_id;?>'><?php echo $ulist->name;?></option>
                                       <?php }} ?>
                                  </select>
                                <?php }else{?>
                                  <input type="hidden" id="quote_user_id" name="quote_user_id" value="<?php echo $_SESSION['admindata']['user_id'];?>">
                                <?php }?>
                                  </div>
                                  

                                  <div class="col-lg-2 expand_width">
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="rec_quote_filt_type" id="rec_quote_filt_type" onchange="rec_quote_filt_type();">
                                         <option value="0">Year</option>
                                         <option value="1">Day</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-2 expand_width rec_quote_filt_year" >
                                      <input type="text" id="quote_fin_year" name="quote_fin_year" class="form-control finance_year" value="<?php echo $financial_year_from;?>-<?php echo $financial_year_to;?>" onchange="getQuoteList();">  
                                  </div>
                                  <div class="col-lg-2 expand_width rec_quote_filt_year">
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="rec_quote_quarter" onchange="getQuoteList();">
                                      <option value="">All Quarter Year</option>
                                      <?php foreach ($quarter_list as $quarter) { ?>
                                         <option value="<?php echo $quarter->quarter_id; ?>"><?php echo $quarter->quarter_label; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="col-lg-2 expand_width" id="rec_quote_filt_day" style="display: none;">
                                    <div class="form-group m-form__group">
                                        
                                        <select class="custom-select form-control" id="rec_quote_searchChange" name="rec_quote_searchChange" onchange="getQuoteList();">
                                           <option value="">Select</option>
                                           <option value="today">Today</option>
                                                <option value="thisweek">This Week</option>
                                                <option value="thismonth">This Month</option>
                                                <option value="thisyear">This Year</option>
                                                <option value="thisDate">Date</option>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-lg-2 expand_width" id="rec_quote_date_range" style="display: none;">
                                       <div class="form-group m-form__group">
                                          <!-- <input class="form-control m-input m-input--square" id="m_daterangepicker_3" name="dtrange" placeholder="Choose Date" value="" type="text"> -->
                                          <div class="m-input-icon pull-right" id='m_daterangepicker_14'>
                                             <input class="form-control m-input m-input--square rec_quote_dtrange" id="m_daterangepicker_14" placeholder="Choose Date" value="" type="text" onblur ="getQuoteList();" onchange="getQuoteList();" onfocus="getQuoteList();" onkeyup="getQuoteList();">
                                          </div>
                                       </div>
                                    </div>
                                    
                                </div>  
                                
                              
                              
                                     
                              </div>
                           </div>
                           <div class="m-portlet__body">
                                 <div class="row">
                                    <div class="col-lg-12" id="quote_list_table">
                                       <table class="table table-striped table-bordered m_table_1">
                                         <thead class="thead-theme">
                                            <tr>
                                               <th>Quote No</th>
                                               <th>Date</th>
                                               <th>Exporter</th>
                                               <th>Consignee</th>
                                               <th>Country</th>
                                               <th>Assigned To</th>
                                               
                                            </tr>
                                         </thead>
                                         <tbody>
                                          <?php $i=0;foreach ($quote_list as $qlist){
                                             $quotlist = $this->Quote_model->get_quote_by_id($qlist['qid']);
                                             $qprod = $this->Quote_model->get_quote_product_by_quote_id($qlist['qid']);
                                             ?>
                                              <tr>
                                                <td><h5 class="text-black" style="margin-bottom: 0px;"><a href="<?php echo base_url(); ?>quote/quote_view/<?php echo $quotlist->quote_id;?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><?php echo $qlist['quote_no'];?></a></h5> <?php if($qlist['qcount']>1){?><span class="m-badge m-badge--info pull-right tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $qlist['qcount']-1; ?> QTN Revised"><?php echo $qlist['qcount']-1; ?></span><?php }?>
                                                </td>
                                                <td align="center"><?php echo date($date_format, strtotime($quotlist->created_date)); ?> / <?php echo date($date_format, strtotime($quotlist->valid_till)); ?></td>
                                                <td align="center"><?php echo $quotlist->exporter_name;?></td>
                                                <td align="center"><h5 class="text-black" style="margin-bottom: 0px;"><?php echo $quotlist->lead_name;?></h5></td>
                                                <td align="center"><?php echo $quotlist->country_name; ?></td>
                                                <td align="center"><?php echo $quotlist->lead_assigned_name;?></td>                                            
                                              </tr>
                                              <?php }?>
                                          
                                         </tbody>
                                         
                                      </table>
                                    </div>
                                 </div>
                              </div>
                        </div>
                                 
                        <!--end:: Widgets/Tasks -->
                     </div>
                     
                  </div>
                  <?php } ?>
                  <?php if ($_SESSION['TablesTarget Statistics'] == 1) { ?>
                  <div class="row hide_div_class" id="target_statistics_div">
                     <div class="col-xl-12">
                        <!--begin:: Widgets/Tasks -->
                        <div class="m-portlet m-portlet--full-height ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Target Statistics
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">                               
                                 
                                  <?php if($_SESSION['admindata']['user_hasnt_product']==1){?>
                                  <select class="form-control custom-select" id="quote_quat_user_id_tar" name="quote_quat_user_id_tar" onchange="getQuoteQuatListTar();">
                                    <option value="">All Users</option>
                                    <?php foreach($assigned_user_lists as $ulist){
                                           if($ulist->role_id!=1){?>
                                           <option value='<?php echo $ulist->user_id;?>'><?php echo $ulist->name;?></option>
                                         <?php }} ?>
                                  </select>
                                <?php }else{ ?>
                                  <input type="hidden" id="quote_quat_user_id_tar" name="quote_quat_user_id_tar" value="<?php echo $_SESSION['admindata']['user_id'];?>" onchange="getQuoteQuatListTar();">
                                <?php }?>
                                  &nbsp;&nbsp;
                                  <select class="form-control custom-select" id="quote_quat_indus_id_tar" name="quote_quat_indus_id_tar" onchange="getQuoteQuatListTar();">
                                    <option value="">All Industry</option>
                                       <?php foreach($industry_lists as $indlist){
                                          ?>
                                       <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                       <?php } ?>
                                  </select>
                                  &nbsp;&nbsp;
                                <input type="text" class="form-control finance_year" id="quote_quat_fin_year_target" name="quote_quat_fin_year_target" value="<?php echo $financial_year_from;?>-<?php echo $financial_year_to;?>">     
                              </div>
                           </div>
                           <div class="m-portlet__body">
                                 <div class="row">
                                    <div class="col-lg-12" id="quote_indus_list_table_target">
                                       
                                    </div>
                                 </div>
                              </div>
                        </div>
                                 
                        <!--end:: Widgets/Tasks -->
                     </div>
                     
                  </div>
                  <?php } ?>
                  <?php if ($_SESSION['TablesPI Based Stage'] == 1) { ?>
                  <div class="row hide_div_class" id="proforma_invoice_based_on_pi_stage_div">
                     <div class="col-xl-12">

                        <!--begin:: Widgets/Tasks -->
                        
                        <div class="m-portlet m-portlet--full-height ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Proforma Invoice Based on PI stage
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">                               
                                <div class="row">

                                  <div class="col-lg-2 expand_width">
                                    <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?> 
                                  <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="pi_sales_user" id="pi_sales_user" onchange="get_dynamic_pi_based_on_pi_stage();">
                                       <option value="">All Users</option>
                                       <?php foreach($assigned_user_lists as $ulist){
                                           if($ulist->role_id!=1){?>
                                           <option value='<?php echo $ulist->user_id;?>'><?php echo $ulist->name;?></option>
                                         <?php }} ?>
                                    </select>
                                    <?php } else { ?>
                                    <input type="hidden" name="sales_user" id="sales_user" value="<?php echo $_SESSION['admindata']['user_id']; ?>">
                                  <?php } ?>
                                   </div>

                                  <div class="col-lg-2 expand_width">
                                    <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?> 
                                  <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="pi_industry" id="pi_industry" onchange="get_dynamic_pi_based_on_pi_stage();">
                                      <option value="">All Industry</option>
                                      <?php foreach($industry_lists as $indlist){
                                            ?>
                                           <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                         <?php } ?>
                                   </select>
                                    <?php } else { ?>
                                      <input type="hidden" name="pi_industry" id="pi_industry" value="">
                                    <?php } ?>
                                  </div>
                                  <div class="col-lg-2 expand_width">
                                  <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="pi_stage_id" id="pi_stage_id" onchange="get_dynamic_pi_based_on_pi_stage();" multiple>
                                      <option value="">All Pi Stage</option>
                                      <?php foreach ($pi_stage_list as $pi_stage) { ?>
                                                        <option value="<?php echo $pi_stage['pi_stage_id']; ?>"><?php echo $pi_stage['pi_stage']; ?></option>
                                                        
                                                        <?php } ?>
                                   </select>
                                  </div>

                                  <div class="col-lg-2 expand_width">
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="pi_filt_type" id="pi_filt_type" onchange="pi_filt_type();">
                                         <option value="0">Year</option>
                                         <option value="1">Day</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-2 expand_width pi_filt_year" >
                                      <input type="text" class="form-control finance_year" id="pi_financial_year" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>" onchange="get_dynamic_pi_based_on_pi_stage();">
                                  </div>
                                  <div class="col-lg-2 expand_width pi_filt_year">
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="pi_quarter" id="pi_quarter" onchange="get_dynamic_pi_based_on_pi_stage();">
                                      <option value="">All Quarter Year</option>
                                      <?php foreach ($quarter_list as $quarter) { ?>
                                         <option value="<?php echo $quarter->quarter_id; ?>"><?php echo $quarter->quarter_label; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="col-lg-2 expand_width" id="pi_filt_day" style="display: none;">
                                    <div class="form-group m-form__group">
                                        
                                        <select class="custom-select form-control" id="pi_searchChange" name="pi_searchChange" onchange="get_dynamic_pi_based_on_pi_stage();">
                                           <option value="">Select</option>
                                           <option value="today">Today</option>
                                                <option value="thisweek">This Week</option>
                                                <option value="thismonth">This Month</option>
                                                <option value="thisyear">This Year</option>
                                                <option value="thisDate">Date</option>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-lg-2 expand_width" id="pi_date_range" style="display: none;">
                                       <div class="form-group m-form__group">
                                          <!-- <input class="form-control m-input m-input--square" id="m_daterangepicker_3" name="dtrange" placeholder="Choose Date" value="" type="text"> -->
                                          <div class="m-input-icon pull-right" id='m_daterangepicker_13'>
                                             <input class="form-control m-input m-input--square pi_dtrange" id="m_daterangepicker_13" placeholder="Choose Date" value="" type="text" onblur ="get_dynamic_pi_based_on_pi_stage();" onchange="get_dynamic_pi_based_on_pi_stage();" onfocus="get_dynamic_pi_based_on_pi_stage();" onkeyup="get_dynamic_pi_based_on_pi_stage();">
                                          </div>
                                       </div>
                                    </div>

                                </div>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div id="dynamic_pi_based_on_pistage_append">
                                 
                              </div>
                           </div>
                        </div>
                                 
                        <!--end:: Widgets/Tasks -->
                     </div>
                     
                  </div>
                  <?php } ?>
                  
                  <!-- End Recent Quotes -->

                        <!-- Begin Proforma Invoice -->
                  <?php if ($_SESSION['Graph And ChartPI Status'] == 1) { ?>
                  <div class="row hide_div_class" id="proforma_invoice_status_div">
                     <div class="col-xl-12">

                        <!--begin:: Widgets/Tasks -->
                        
                        <div class="m-portlet m-portlet--full-height ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Proforma Invoice Status
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">                               
                                 <!-- <select class="form-control custom-select">
                                        <option>Products</option>
                                       <option>Coffee Bean</option>
                                       <option>Instant Coffee</option>
                                       <option>Chilly</option>
                                       <option>Yarn</option>
                                       <option>Rice</option>
                                       <option>Honey</option>
                                    </select>  -->                                   
                                    &nbsp;&nbsp;                                    
                                    <?php if($_SESSION['admindata']['user_hasnt_product']==1){?>
                                  <select class="form-control custom-select" id="pi_bo_user_id" name="pi_bo_user_id" onchange="getPIBOList();">

                                    <option value=''>All User</option>
                                    <?php foreach($assigned_user_lists as $ulist){
                                         if($ulist->role_id!=1){?>
                                         <option value='<?php echo $ulist->user_id;?>'><?php echo $ulist->name;?></option>
                                       <?php }} ?>
                                  </select>
                                <?php }else{?>
                                  <input type="hidden" id="pi_bo_user_id" name="pi_bo_user_id" value="<?php echo $_SESSION['admindata']['user_id'];?>" onchange="getPIBOList();">
                                <?php }?>                   
                                    &nbsp;&nbsp;
                                    <input type="text" class="form-control finance_year" id="pi_bo_fin_year" name="pi_bo_fin_year" value="<?php echo $financial_year_from;?>-<?php echo $financial_year_to;?>" onchange="getPIBOList();">   
                              </div>
                           </div>
                           <div class="m-portlet__body">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div id="Proformainvoice"></div>
                                       <?php $arr='';$boarr='';
                                            if($pi_tot->m1_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m1_ach_val,2).',';
                                            }
                                            if($pi_tot->m2_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m2_ach_val,2).',';
                                            }
                                            if($pi_tot->m3_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m3_ach_val,2).',';
                                            }
                                            if($pi_tot->m4_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m4_ach_val,2).',';
                                            }
                                            if($pi_tot->m5_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m5_ach_val,2).',';
                                            }
                                            if($pi_tot->m6_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m6_ach_val,2).',';
                                            }
                                            if($pi_tot->m7_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m7_ach_val,2).',';
                                            }
                                            if($pi_tot->m8_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m8_ach_val,2).',';
                                            }
                                            if($pi_tot->m9_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m9_ach_val,2).',';
                                            }
                                            if($pi_tot->m10_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m10_ach_val,2).',';
                                            }
                                            if($pi_tot->m11_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m11_ach_val,2).',';
                                            }
                                            if($pi_tot->m12_ach_val=='')
                                            {
                                                $arr.='0,';
                                            }
                                            else
                                            {
                                                $arr.=round($pi_tot->m12_ach_val,2).',';
                                            }



                                            if($bo_tot->bo1_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo1_ach_val,2).',';
                                            }
                                            if($bo_tot->bo2_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo2_ach_val,2).',';
                                            }
                                            if($bo_tot->bo3_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo3_ach_val,2).',';
                                            }
                                            if($bo_tot->bo4_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo4_ach_val,2).',';
                                            }
                                            if($bo_tot->bo5_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo5_ach_val,2).',';
                                            }
                                            if($bo_tot->bo6_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo6_ach_val,2).',';
                                            }
                                            if($bo_tot->bo7_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo7_ach_val,2).',';
                                            }
                                            if($bo_tot->bo8_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo8_ach_val,2).',';
                                            }
                                            if($bo_tot->bo9_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo9_ach_val,2).',';
                                            }
                                            if($bo_tot->bo10_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo10_ach_val,2).',';
                                            }
                                            if($bo_tot->bo11_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo11_ach_val,2).',';
                                            }
                                            if($bo_tot->bo12_ach_val=='')
                                            {
                                                $boarr.='0,';
                                            }
                                            else
                                            {
                                                $boarr.=round($bo_tot->bo12_ach_val,2).',';
                                            }
                                        //}
                                        $sp = explode(',', $arr);$bo = explode(',', $boarr);?>
                                        <script type="text/javascript">
                                            var day1 = '<?php echo $sp[0]; ?>';
                                            var day2 = '<?php echo $sp[1]; ?>';
                                            var day3 = '<?php echo $sp[2]; ?>';
                                            var day4 = '<?php echo $sp[3]; ?>';
                                            var day5 = '<?php echo $sp[4]; ?>';
                                            var day6 = '<?php echo $sp[5]; ?>';
                                            var day7 = '<?php echo $sp[6]; ?>';
                                            var day8 = '<?php echo $sp[7]; ?>';
                                            var day9 = '<?php echo $sp[8]; ?>';
                                            var day10 = '<?php echo $sp[9]; ?>';
                                            var day11 = '<?php echo $sp[10]; ?>';
                                            var day12 = '<?php echo $sp[11]; ?>';

                                            var boday1 = '<?php echo $bo[0]; ?>';
                                            var boday2 = '<?php echo $bo[1]; ?>';
                                            var boday3 = '<?php echo $bo[2]; ?>';
                                            var boday4 = '<?php echo $bo[3]; ?>';
                                            var boday5 = '<?php echo $bo[4]; ?>';
                                            var boday6 = '<?php echo $bo[5]; ?>';
                                            var boday7 = '<?php echo $bo[6]; ?>';
                                            var boday8 = '<?php echo $bo[7]; ?>';
                                            var boday9 = '<?php echo $bo[8]; ?>';
                                            var boday10 = '<?php echo $bo[9]; ?>';
                                            var boday11 = '<?php echo $bo[10]; ?>';
                                            var boday12 = '<?php echo $bo[11]; ?>';

                                            Highcharts.chart('Proformainvoice', {
                                            chart: {
                                                type: 'areaspline'
                                            },
                                            title: {
                                                text: ''
                                            },
                                            legend: {
                                                layout: 'vertical',
                                                align: 'left',
                                                verticalAlign: 'top',
                                                x: 150,
                                                y: 100,
                                                floating: true,
                                                borderWidth: 1,
                                                backgroundColor:
                                                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
                                            },
                                            xAxis: {
                                                categories: [
                                                    'January',
                                                    'February',
                                                    'March',
                                                    'April',
                                                    'May',
                                                    'June',
                                                    'July',
                                                    'August',
                                                    'September',
                                                    'October',
                                                    'November',
                                                    'December'
                                                ],
                                                plotBands: [{ // visualize the weekend
                                                    from: 4.5,
                                                    to: 6.5,
                                                    color: 'rgba(68, 170, 213, .2)'
                                                }]
                                            },
                                            yAxis: {
                                                title: {
                                                    text: 'Total'
                                                }
                                            },
                                            tooltip: {
                                                shared: true,
                                                valueSuffix: ''
                                            },
                                            credits: {
                                                enabled: false
                                            },
                                            plotOptions: {
                                                areaspline: {
                                                    fillOpacity: 0.2
                                                }
                                            },
                                            series: [{
                                                name: 'Proforma Invoice',
                                                data: [Number(day1), Number(day2), Number(day3), Number(day4), Number(day5), Number(day6), Number(day7), Number(day8), Number(day9), Number(day10), Number(day11), Number(day12)]
                                            }, {
                                                name: 'Orders',
                                                data: [Number(boday1), Number(boday2), Number(boday3), Number(boday4), Number(boday5), Number(boday6), Number(boday7), Number(boday8), Number(boday9), Number(boday10), Number(boday11), Number(boday12)]
                                            }]
                                        });
                                      </script>
                                    </div>
                                 </div>
                              </div>
                        </div>
                                 
                        <!--end:: Widgets/Tasks -->
                     </div>
                     
                  </div>
                  <?php } ?>

                        <!-- End Proforma Invoice -->

                        <!-- Begin Top 5 Suppliers -->
                  <?php if ($_SESSION['TablesTop Suppliers'] == 1) { ?>
                  <div class="row hide_div_class" id="top_least_suppliers_div">
                     <div class="col-xl-12">

                        <!--begin:: Widgets/Tasks -->
                        
                        <div class="m-portlet m-portlet--full-height ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       <span id="sctl">Top <?php echo $topleast_supplier;?> Suppliers</span>
                                       <input type="hidden" id="topleast_supplier" value="<?php echo $topleast_supplier;?>">
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">                               
                                 <select class="form-control custom-select" id="sctlsel" name="sctlsel" onchange="getSCTL(this.value);">
                                        <option value="top">Top</option>
                                       <option value="least">Least</option>                                      
                                    </select>
                                    &nbsp;&nbsp;
                                    <!-- <input type="text" class="form-control finance_year" value="2019-2020">        -->
                              </div>
                           </div>
                           <div class="m-portlet__body">
                                 <div class="row">
                                    <div class="col-lg-12" id="sup_point_list">
                                       <table class="table table-striped table-bordered m_table_1">
                                                <thead>
                                                   <tr>
                                                      <th>Name</th>
                                                      <th>Product</th>
                                                      <th>Scores</th>                                            
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                  <?php foreach($topleast_supplier_list as $tlsl)
                                                  {

                                                    $vendor_product_details = $this->Vendor_model->get_vendor_product_by_id($tlsl['vendor_id']);
                                                    $vparr = []; foreach($vendor_product_details as $vprod){
                                                       array_push($vparr, $vprod['product_name']);
                                                    }
                                                    $vprod = implode(', ', $vparr);
                                                    if($tlsl['points']>=0)
                                                    {
                                                      $cclass = 'text-green';
                                                    }
                                                    else
                                                    {
                                                      $cclass = 'text-danger';
                                                    }
                                                    ?>
                                                      <tr>
                                                         <td><h5><?php echo $tlsl['vendor_name']; ?></h5></td>
                                                         <td align="center"><?php echo str_replace(',', ', ', $vprod); ?>  </td>            
                                                         <td align="center"><h4  class="<?php echo $cclass;?>"><?php echo $tlsl['points'];?></h4></td>
                                                      </tr>
                                                  <?php }?>
                                                   
                                                </tbody>
                                                
                                             </table>
                                    </div>
                                 </div>
                              </div>
                        </div>
                                 
                        <!--end:: Widgets/Tasks -->
                     </div>
                     
                  </div>
                  <?php } ?>
                        <!-- End Top 5 Suppliers -->


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

<script type="text/javascript">
  
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Dashboard';
$(document).attr("title", title); 
$('.m_table_1').DataTable({
        /* Disable initial sort */
        "aaSorting": []
    });
$('.m_table_2').DataTable();
// To check exporter name is unique
$(document).ready(function() {
//getQuoteQuatList();
});

</script>
<script type="text/javascript">
   $('.finance_year').datepicker({
       format: "yyyy",
       minViewMode: 2,
     autoclose : true
       }).on('hide',function(date){
     $(".finance_year").val(date.target.value + "-" + (parseInt(date.target.value) + parseInt(1)));
   });
// <option selected value="lead_based_on_product_div">Lead Based On Product</option>
// <option selected value="oppo_based_on_product_div">Opportunity Based On Product</option>
// <option selected value="quote_based_on_stage_div">Quote Based on Stage</option>
// <option selected value="recent_quotation_div">Recent Quotations</option>
// <option selected value="target_statistics_div">Target Statistics</option>
// <option selected value="proforma_invoice_based_on_pi_stage_div">Proforma Invoice Based on PI stage</option>
// <option selected value="proforma_invoice_status_div">Proforma Invoice Status</option>
// <option selected value="top_least_suppliers_div">Top / Least Suppliers</option>
function show_only_selected() {
  var dashboar_div = $('#dashboard_blocks_control').val();
  var i;
  $(".hide_div_class").css("display", "none");
  // var text = '';
  for (i = 0; i < dashboar_div.length; i++) {
    $('#'+dashboar_div[i]).show();
  }

}
function lead_filt_type()
{
  var val = $('#lead_filt_type').val();
  if (val == 0) {
    $('.lead_filt_year').show();
    $('#lead_filt_day').hide();
    $('#lead_searchChange').val('');

  }
  else {
    $('#lead_filt_day').show();
    $('.lead_filt_year').hide();
    $('#lead_financial_year').val('');
    $('#lead_quarter').val('');
  }
}
function rec_quote_filt_type()
{
  var val = $('#rec_quote_filt_type').val();
  if (val == 0) {
    $('.rec_quote_filt_year').show();
    $('#rec_quote_filt_day').hide();
    $('#rec_quote_searchChange').val('');

  }
  else {
    $('#rec_quote_filt_day').show();
    $('.rec_quote_filt_year').hide();
    $('#rec_quote_financial_year').val('');
    $('#rec_quote_quarter').val('');
  } 
}
function pi_filt_type()
{
  var val = $('#pi_filt_type').val();
  if (val == 0) {
    $('.pi_filt_year').show();
    $('#pi_filt_day').hide();
    $('#pi_searchChange').val('');

  }
  else {
    $('#pi_filt_day').show();
    $('.pi_filt_year').hide();
    $('#pi_financial_year').val('');
    $('#pi_quarter').val('');
  }
}
function oppo_filt_type()
{
  var val = $('#oppo_filt_type').val();
  if (val == 0) {
    $('.oppo_filt_year').show();
    $('#oppo_filt_day').hide();
    $('#oppo_searchChange').val('');
  }
  else {
    $('#oppo_filt_day').show();
    $('.oppo_filt_year').hide();
    $('#oppo_financial_year').val('');
    $('#oppo_quarter').val('');
  }
}
function quote_filt_type()
{
  var val = $('#quote_filt_type').val();
  if (val == 0) {
    $('.quote_filt_year').show();
    $('#quote_filt_day').hide();
    $('#quote_searchChange').val('');
  }
  else {
    $('#quote_filt_day').show();
    $('.quote_filt_year').hide();
    $('#quote_financial_year').val('');
    $('#quote_quarter').val('');
  }
}
<?php if ($_SESSION['NotificationLeads'] == 1) { ?>
get_lead_notification_by_filter();
function get_lead_notification_by_filter()
{
   var assign_person = $('#lead_noti_assign_person').val();
   var product = $('#lead_noti_product').val();
   $.ajax({
    type: "POST",
    url: baseurl+'Dashboard/get_lead_noti_filt',
    async: false,
    //data: "qpid="+qpid+"&quid="+quid+"&qqtr="+qqtr+"&fy="+fy,
    data: "assign_person="+assign_person+"&product="+product,
    dataType: "html",
    success: function(response)
    {
      $('#lead_noti_append_filt').empty().append(response);
    }
  });   
}
<?php } ?>
<?php if ($_SESSION['NotificationUnattended Leads'] == 1) { ?>  
get_lessmail_reply_notification_by_filter();
function get_lessmail_reply_notification_by_filter()
{
   var assign_person = $('#lessmail_reply_noti_assign_person').val();
   var product = $('#lessmail_reply_noti_product').val();
   $.ajax({
    type: "POST",
    url: baseurl+'Dashboard/get_lessmail_reply_noti_filt',
    async: false,
    //data: "qpid="+qpid+"&quid="+quid+"&qqtr="+qqtr+"&fy="+fy,
    data: "assign_person="+assign_person+"&product="+product,
    dataType: "html",
    success: function(response)
    {

      $('#lessmail_reply_noti_append_filt').empty().append(response);
    }
  });   
}
<?php } ?>
<?php if ($_SESSION['NotificationJO'] == 1) { ?>
get_joborder_noti_filt();
function get_joborder_noti_filt()
{
   var assign_person = $('#joborder_noti_assign_person').val();
   var product = $('#joborder_noti_product').val();
   $.ajax({
    type: "POST",
    url: baseurl+'Dashboard/get_joborder_noti_filt',
    async: false,
    //data: "qpid="+qpid+"&quid="+quid+"&qqtr="+qqtr+"&fy="+fy,
    data: "assign_person="+assign_person+"&product="+product,
    dataType: "html",
    success: function(response)
    {
      $('#joborder_noti_append_filt').empty().append(response);
    }
  });  
}
<?php } ?>
<?php if ($_SESSION['NotificationBO'] == 1) { ?>  
get_buyerorder_notification_by_filter();
function get_buyerorder_notification_by_filter()
{
   var assign_person = $('#buyerorder_noti_assign_person').val();
   var product = $('#buyerorder_noti_product').val();
   $.ajax({
    type: "POST",
    url: baseurl+'Dashboard/get_buyerorder_noti_filt',
    async: false,
    //data: "qpid="+qpid+"&quid="+quid+"&qqtr="+qqtr+"&fy="+fy,
    data: "assign_person="+assign_person+"&product="+product,
    dataType: "html",
    success: function(response)
    {
      $('#buyerorder_noti_append_filt').empty().append(response);
    }
  });  
}
<?php } ?>
<?php if ($_SESSION['TablesRecent Quotation'] == 1) { ?>
function getQuoteList()
{
  //var qpid = $('#quote_product_id').val();
  var quid = $('#quote_user_id').val();
 
  var fy = $('#quote_fin_year').val();

  var next_year = '';
  var funnel_year = '';
  if (fy.length == 4) {
     next_year = parseInt(fy) + 1;
     funnel_year = fy+'-'+next_year;
  }
  else {
     funnel_year = fy;
  }
  var dtrange = '';
  var rec_quote_quarter = $('#rec_quote_quarter').val();
  var search_by_day = $('#rec_quote_searchChange').val();
  if (search_by_day == 'thisDate') {
    $('#rec_quote_date_range').show();
    dtrange = $('.rec_quote_dtrange').val();
  }
  else {
    $('#rec_quote_date_range').hide();
    $('.rec_quote_dtrange').val(''); 
  }
  $.ajax({
    type: "POST",
    url: baseurl+'dashboard/getQuoteList',
    async: false,
    //data: "qpid="+qpid+"&quid="+quid+"&qqtr="+qqtr+"&fy="+fy,
    data: "quid="+quid+"&qqtr="+rec_quote_quarter+"&fy="+funnel_year+"&day_filt="+search_by_day+"&dtrange="+dtrange,
    dataType: "html",
    success: function(response)
    {
      $('#quote_list_table').empty().append(response);
    }
  });
} 
<?php } ?>
// function getQuoteQuatList()
// {
//   var quid = $('#quote_quat_user_id').val();
//   var fy = $('#quote_quat_fin_year').val();

// var next_year = '';
// var funnel_year = '';
// if (fy.length == 4) {
//    next_year = parseInt(fy) + 1;
//    funnel_year = fy+'-'+next_year;
// }
// else {
//    funnel_year = fy;
// }

//   $.ajax({
//     type: "POST",
//     url: baseurl+'dashboard/getQuoteQuatList',
//     async: false,
//     data: "quid="+quid+"&fy="+funnel_year,
//     dataType: "html",
//     success: function(response)
//     {
//       $('#quote_indus_list_table').empty().append(response);
//     }
//   });
// }  
<?php if ($_SESSION['TablesTarget Statistics'] == 1) { ?>   
getQuoteQuatListTar();
function getQuoteQuatListTar()
{
   var ind_id = $('#quote_quat_indus_id_tar').val();
  var quid = $('#quote_quat_user_id_tar').val();
  var fy = $('#quote_quat_fin_year_target').val();

   var next_year = '';
   var funnel_year = '';
   if (fy.length == 4) {
      next_year = parseInt(fy) + 1;
      funnel_year = fy+'-'+next_year;
   }
   else {
      funnel_year = fy;
   }
  $.ajax({
    type: "POST",
    url: baseurl+'dashboard/getQuoteQuatListTar',
    async: false,
    data: "quid="+quid+"&fy="+funnel_year+"&industry_id="+ind_id,
    dataType: "html",
    success: function(response)
    {
      $('#quote_indus_list_table_target').empty().append(response);
    }
  });
}
<?php } ?>
function getPIBOList()
{
  //var qpid = $('#quote_product_id').val();
  var quid = $('#pi_bo_user_id').val();
  var fy = $('#pi_bo_fin_year').val();

var next_year = '';
var funnel_year = '';
if (fy.length == 4) {
   next_year = parseInt(fy) + 1;
   funnel_year = fy+'-'+next_year;
}
else {
   funnel_year = fy;
}

  $.ajax({
    type: "POST",
    url: baseurl+'dashboard/getPIBOList',
    async: false,
    //data: "qpid="+qpid+"&quid="+quid+"&qqtr="+qqtr+"&fy="+fy,
    data: "quid="+quid+"&fy="+funnel_year,
    dataType: "html",
    success: function(response)
    {
      $('#Proformainvoice').empty().append(response);
    }
  });
} 

function getSCTL(val)
{
  var topleast_supplier = $('#topleast_supplier').val();
  if(val == 'top')
  {
    $('#sctl').html('Top '+topleast_supplier+' Suppliers');
  }
  else
  {
    $('#sctl').html('Least '+topleast_supplier+' Suppliers');
  }
  $.ajax({
    type: "POST",
    url: baseurl+'dashboard/getSCTL',
    async: false,
    data: "tl="+val+"&topleast_supplier="+topleast_supplier,
    dataType: "html",
    success: function(response)
    {
      $('#sup_point_list').empty().append(response);
    }
  });
}

</script>



<script>
    //Sales Funnel
    Highcharts.chart('container1', {
    chart: {
        type: 'funnel'
    },
    title: {
        text: ''
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b> ({point.y:,.0f})',
                softConnector: true
            },
            center: ['40%', '50%'],
            neckWidth: '30%',
            neckHeight: '25%',
            width: '100%'
        }
    },
    legend: {
        enabled: false
    },
    series: [{
        name: '',
        data: [
            ['Leads', 742],
            ['Opportunities', 524],
            ['Quotes', 421],
            ['Proforma Invoice', 324],
            ['Orders', 300]
        ]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                plotOptions: {
                    series: {
                        dataLabels: {
                            inside: true
                        },
                        center: ['50%', '50%'],
                        width: '100%'
                    }
                }
            }
        }]
    }
});
</script>

<script>
       // Proforma Invoice
    /*Highcharts.chart('Proformainvoice', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: ''
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
    },
    xAxis: {
        categories: [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ],
        plotBands: [{ // visualize the weekend
            from: 4.5,
            to: 6.5,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
        title: {
            text: 'Count'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ''
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.2
        }
    },
    series: [{
        name: 'Proforma Invoice',
        data: [3, 4, 3, 5, 4, 10, 12, 20, 24, 14, 28, 35]
    }, {
        name: 'Orders',
        data: [1, 3, 4, 3, 3, 5, 4, 10, 14, 18, 24, 30]
    }]
});*/
</script>

<script>

//Top 5 Products 

//jegan
<?php if ($_SESSION['Graph And ChartSales Statistics'] == 1) { ?>
get_funnel_report_by_year(); 
   
   function get_funnel_report_by_year()
   {
      var res_arr = '';
      var funnel_year_raw = $('#funnel_year').val();
      var next_year = '';
      var funnel_year = '';
      if (funnel_year_raw.length == 4) {
         next_year = parseInt(funnel_year_raw) + 1;
         funnel_year = funnel_year_raw+'-'+next_year;
      }
      else {
         funnel_year = funnel_year_raw;
      }
      var fn_pro = $('#funnel_product').val();
      var fn_user = $('#funnel_sales_user').val();
      $.ajax({
         type:"POST",
         url:baseurl+'Dashboard/funnel_dashboard_dynamic',
         data:{'year':funnel_year,'user':fn_user,'product':fn_pro},
         cache: false,
         dataType: "html",
         success: function(result){
           if (result != '0|0|0|0|0') {
           
            res_arr = result.split('|');
            var l_count = parseInt(res_arr[0]);
            var oppo_count = parseInt(res_arr[1]);
            var quo_count = parseInt(res_arr[2]);
            var proforma_count = parseInt(res_arr[3]);
            var ord_count = parseInt(res_arr[4]);
      
          //Sales Funnel
          Highcharts.chart('container1', {
             chart: {
                 type: 'funnel'
             },
             title: {
                 text: ''
             },
             plotOptions: {
                 series: {
                     dataLabels: {
                         enabled: true,
                         format: '<b>{point.name}</b> ({point.y:,.0f})',
                         softConnector: true
                     },
                     center: ['40%', '50%'],
                     neckWidth: '30%',
                     neckHeight: '25%',
                     width: '100%'
                 }
             },
             legend: {
                 enabled: false
             },
             series: [{
                 name: '',
                 data: [
                     ['Leads', l_count],
                     ['Opportunities', oppo_count],
                     ['Quotes', quo_count],
                     ['Proforma Invoice', proforma_count],
                     ['Orders', ord_count]
                 ]
             }],
   
             responsive: {
                 rules: [{
                     condition: {
                         maxWidth: 500
                     },
                     chartOptions: {
                         plotOptions: {
                             series: {
                                 dataLabels: {
                                     inside: true
                                 },
                                 center: ['50%', '50%'],
                                 width: '100%'
                             }
                         }
                     }
                 }]
             }
            });
          }
         else {
            $('#container1').html("No Record Found!");
         }
         }
      });
      
   }
<?php } ?>
<?php if ($_SESSION['Graph And ChartTop Product'] == 1) { ?>
   get_product_chart_by_filter();
   function get_product_chart_by_filter()
   {
      var ptc = $('#ptc').val();
      var product_year_raw = $('#top_least_pro_year_filt').val();
      var pro_top_least = $('#top_least_pro_filt').val();
      var next_year = '';
      var product_year = '';
      var pro_top_res = '';
      if (product_year_raw.length == 4) {
         next_year = parseInt(product_year_raw) + 1;
         product_year = product_year_raw+'-'+next_year;
      }
      else {
         product_year = product_year_raw;
      }
      if (pro_top_least == 1) {
         $('#pro_top_or_least').empty().html('Top '+ptc+' Products');
      }
      else {
         $('#pro_top_or_least').empty().html('Least '+ptc+' Products');
      }
      $.ajax({
         type:"POST",
         url:baseurl+'Dashboard/product_dashboard_dynamic',
         data:{'year':product_year,'top_or_least':pro_top_least},
         cache: false,
         dataType: "html",
         success: function(result){
            pro_top_res = JSON.parse(result);
            var data_series = [];
            for( var i = pro_top_res.length - 1; i >= 0; i-- ) {
                var obj=pro_top_res[i];
                data_series.push( [ obj.product_name, parseInt( obj.product_order_count ) ] );
            }
            Highcharts.chart('top_5_products_container', {
             chart: {
                 plotBackgroundColor: null,
                 plotBorderWidth: 0,
                 plotShadow: false
             },
             credits:false,
             title: {
                 text: 'Products',
                 align: 'center',
                 verticalAlign: 'middle',
                 y: 60
             },
             tooltip: {
                 pointFormat: '{series.name}: <b>{point:y}</b>'
             },
             accessibility: {
                 point: {
                     valueSuffix: '%'
                 }
             },
             plotOptions: {
                 pie: {
                     dataLabels: {
                         enabled: true,
                         distance: -50,
                         style: {
                             fontWeight: 'bold',
                             color: 'white'
                         }
                     },
                     startAngle: -90,
                     endAngle: 90,
                     center: ['50%', '75%'],
                     size: '110%'
                 }
             },
             series: [{
                 type: 'pie',
                 name: 'Product',
                 innerSize: '50%',
                 data: data_series
             }]
         });

         }
      });
      
   }
<?php } ?>
<?php if ($_SESSION['Graph And ChartTop LeadSource'] == 1) { ?>
   get_lead_source_chart_by_filter();
   function get_lead_source_chart_by_filter()
   {
      var tslc = $('#lstc').val();
      var product_year_raw = $('#top_least_ls_year_filt').val();
      var pro_top_least = $('#top_least_ls_filt').val();
      var next_year = '';
      var product_year = '';
      if (product_year_raw.length == 4) {
         next_year = parseInt(product_year_raw) + 1;
         product_year = product_year_raw+'-'+next_year;
      }
      else {
         product_year = product_year_raw;
      }
      if (pro_top_least == 1) {
         $('#ls_top_or_least').empty().html('Top '+tslc+' Lead Sources');
      }
      else {
         $('#ls_top_or_least').empty().html('Least '+tslc+' Lead Sources');
      }
      $.ajax({
         type:"POST",
         url:baseurl+'Dashboard/leadsource_dashboard_dynamic',
         data:{'year':product_year,'top_or_least':pro_top_least},
         cache: false,
         dataType: "html",
         success: function(result){
            
            var ls_top_res = JSON.parse(result);
            
            var data_series = [];
            for( var i = ls_top_res.length - 1; i >= 0; i-- ) {
                var obj=ls_top_res[i];
                data_series.push( [ obj.name, parseInt( obj.y ) ] );
            }
            
            Highcharts.chart('top_5_lead_sources_container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                credits:false,
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point:y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Lead Source',
                    colorByPoint: true,
                    data: data_series
                }]
            });
      
         }
      });
   }
<?php } ?>
<?php if ($_SESSION['TablesLead Based LeadStatus'] == 1) { ?>
   get_dynamic_opportunity_based_on_industry();
   function get_dynamic_opportunity_based_on_industry()
   {
      var funnel_year_raw = $('#oppo_financial_year').val();
      var sale_user = $('#sales_user').val();
      var industry_id = $('#oppo_indus_id').val();
      var lead_status_id = $('#oppo_status_id').val();
      var next_year = '';
      var funnel_year = '';
      if (funnel_year_raw.length == 4) {
         next_year = parseInt(funnel_year_raw) + 1;
         funnel_year = funnel_year_raw+'-'+next_year;
      }
      else {
         funnel_year = funnel_year_raw;
      }
      var dtrange = '';
      var oppo_quarter = $('#oppo_quarter').val();
      var search_by_day = $('#oppo_searchChange').val();
      if (search_by_day == 'thisDate') {
        $('#oppo_date_range').show();
        dtrange = $('.oppo_dtrange').val();
      }
      else {
        $('#oppo_date_range').hide();
        $('.oppo_dtrange').val(''); 
      }
      $.ajax({
         type:"POST",
         url:baseurl+'Dashboard/get_dynamic_opportunity_based_on_industry',
         data:{'year':funnel_year,'sale_user':sale_user,'lead_status_id':lead_status_id,'industry_id':industry_id,'day_filt':search_by_day,'date_range':dtrange,'quarter':oppo_quarter},
         cache: false,
         dataType: "html",
         success: function(result){
            
           $('#dynamic_opportunity_based_on_industry_append').empty().append(result);
         }
      });
      
   }
<?php } ?>

   <?php if ($_SESSION['TablesLead Based LeadSource'] == 1) { ?>
   get_dynamic_lead_based_on_product();
   function get_dynamic_lead_based_on_product()
   {
      var funnel_year_raw = $('#lead_financial_year').val();
      var sale_user = $('#lead_sales_user').val();
      var industry_id = $('#lead_industry').val();
      var ls_filt = $('#lead_source_filt').val();
      var next_year = '';
      var funnel_year = '';
      
      if (funnel_year_raw.length == 4) {
         next_year = parseInt(funnel_year_raw) + 1;
         funnel_year = funnel_year_raw+'-'+next_year;
      }
      else {
         funnel_year = funnel_year_raw;
      }
      var dtrange = '';
      var lead_quarter = $('#lead_quarter').val();
      var search_by_day = $('#lead_searchChange').val();
      if (search_by_day == 'thisDate') {
        $('#lead_date_range').show();
        dtrange = $('.lead_dtrange').val();
      }
      else {
        $('#lead_date_range').hide();
        $('.lead_dtrange').val(''); 
      }
      
      $.ajax({
         type:"POST",
         url:baseurl+'Dashboard/get_dynamic_lead_based_on_product',
         data:{'year':funnel_year,'sale_user':sale_user,'industry_id':industry_id,'lead_source':ls_filt,'day_filt':search_by_day,'date_range':dtrange,'quarter':lead_quarter}, 
         cache: false,
         dataType: "html",
         success: function(result){
            
           $('#dynamic_lead_based_on_product_append').empty().append(result);
         }
      });
      
   }
   <?php } ?>
   <?php if ($_SESSION['TablesQuote Based Stage'] == 1) { ?>
   get_dynamic_quote_based_on_industry();
   function get_dynamic_quote_based_on_industry()
   {
      var funnel_year_raw = $('#quote_financial_year').val();
      var sale_user = $('#quo_sales_user').val();
      var quote_industry = $('#quote_industry').val();
      var quo_stage_filt = $('#quo_stage_filt').val();
      var next_year = '';
      var funnel_year = '';
      if (funnel_year_raw.length == 4) {
         next_year = parseInt(funnel_year_raw) + 1;
         funnel_year = funnel_year_raw+'-'+next_year;
      }
      else {
         funnel_year = funnel_year_raw;
      }
      var dtrange = '';
      var quote_quarter = $('#quote_quarter').val();
      var search_by_day = $('#quote_searchChange').val();
      if (search_by_day == 'thisDate') {
        $('#quote_date_range').show();
        dtrange = $('.quote_dtrange').val();
      }
      else {
        $('#quote_date_range').hide();
        $('.quote_dtrange').val(''); 
      }
      $.ajax({
         type:"POST",
         url:baseurl+'Dashboard/get_dynamic_quote_based_on_industry',
         data:{'year':funnel_year,'sale_user':sale_user,'quote_industry':quote_industry,'quote_stage':quo_stage_filt,'day_filt':search_by_day,'date_range':dtrange,'quarter':quote_quarter},
         cache: false,
         dataType: "html",
         success: function(result)
         {
           $('#dynamic_quote_based_on_industry_append').empty().append(result);
         }
      });
   }
 <?php } ?>
 <?php if ($_SESSION['TablesPI Based Stage'] == 1) { ?>
   get_dynamic_pi_based_on_pi_stage();
   function get_dynamic_pi_based_on_pi_stage()
   {
      var funnel_year_raw = $('#pi_financial_year').val();
      var sale_user = $('#pi_sales_user').val();
      var quote_industry = $('#pi_industry').val();
      var pi_stage_id = $('#pi_stage_id').val();

      var next_year = '';
      var funnel_year = '';
      if (funnel_year_raw.length == 4) {
         next_year = parseInt(funnel_year_raw) + 1;
         funnel_year = funnel_year_raw+'-'+next_year;
      }
      else {
         funnel_year = funnel_year_raw;
      }
      var dtrange = '';
      var pi_quarter = $('#pi_quarter').val();
      var search_by_day = $('#pi_searchChange').val();
      if (search_by_day == 'thisDate') {
        $('#pi_date_range').show();
        dtrange = $('.pi_dtrange').val();
      }
      else {
        $('#pi_date_range').hide();
        $('.pi_dtrange').val(''); 
      }
      $.ajax({
         type:"POST",
         url:baseurl+'Dashboard/get_dynamic_pi_based_on_pi_stage',
         data:{'year':funnel_year,'sale_user':sale_user,'pi_industry':quote_industry,'pi_stage_id' : pi_stage_id,'day_filt':search_by_day,'date_range':dtrange,'quarter':pi_quarter},
         cache: false,
         dataType: "html",
         success: function(result)
         {
           $('#dynamic_pi_based_on_pistage_append').empty().append(result);
         }
      });
   }  
<?php } ?>
</script>
</body>
   <!-- end::Body -->
</html>