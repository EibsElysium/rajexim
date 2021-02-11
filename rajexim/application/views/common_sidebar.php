<?php 

	// echo '<pre>';
	// print_r($_SESSION); die;
?>
<style>
.m-aside-menu .m-menu__nav {
    padding: 12px 0 30px 0;
}
.m-aside-left--minimize .m-aside-menu .m-menu__nav {
    padding: 12px 0 30px 0;
}
</style>
<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
                  <ul class="m-menu__nav ">
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>dashboard" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-dashboard"></i><span class="m-menu__link-text">Dashboard</span></a>
                      </li>
                    <?php if($_SESSION['Lead ManagementView']==1){ ?>
                      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                           <a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-filter"></i><span
                              class="m-menu__link-text">Lead Management</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                           <div class="m-menu__submenu ">
                              <span class="m-menu__arrow"></span>
                              <ul class="m-menu__subnav">
                                
                                 <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>new_leads?active_tab=1" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-leaf"><span></span></i><span class="m-menu__link-text">New Lead</span>
                                    </a>
                                 </li>
                                
                                 <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>followup_leads?active_tab=2" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-binoculars"><span></span></i><span class="m-menu__link-text">Followup Leads</span>
                                    </a>
                                 </li>
                                 
                                 <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>archived_leads?active_tab=3" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-archive"><span></span></i><span class="m-menu__link-text">Archived Leads</span>
                                    </a>
                                 </li>
                                 
                                  <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>Leads/all_leads_list_for_search" class="m-menu__link ">
                                         <i class="m-menu__link-icon la la-search"><span></span></i><span class="m-menu__link-text">Search Lead</span>
                                      </a>
                                   </li>
                               </ul>
                           </div>
                      </li>
                    <?php } ?>
                    <?php if($_SESSION['Lead ManagementView']==1) { ?>
                    <!--   <li class="m-menu__item" aria-haspopup="true"><a href="<?php // echo base_url(); ?>Leads/opportunity_list" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-diamond"></i><span class="m-menu__link-text">Opportunity</span></a>
                      </li> -->
                      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                           <a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-diamond"></i><span
                              class="m-menu__link-text">Opportunity</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                           <div class="m-menu__submenu ">
                              <span class="m-menu__arrow"></span>
                              <ul class="m-menu__subnav">
                                
                                 <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>Leads/opportunity_list?active_tab=1" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-list-alt"><span></span></i><span class="m-menu__link-text">Opportunity List</span>
                                    </a>
                                 </li>
                                
                                 <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>converted_leads?active_tab=2" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-check"><span></span></i><span class="m-menu__link-text">Converted List</span>
                                    </a>
                                 </li>
                               </ul>
                           </div>
                      </li>
                    <?php } ?>
                    <?php if($_SESSION['MailboxView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>Mailbox" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-envelope"></i><span class="m-menu__link-text">Mail Box</span></a>
                      </li>
                      <?php } ?>
                     <?php 
                     if($_SESSION['Product CostingView']==1 || $_SESSION['Multi Product CostingView']==1 || $_SESSION['Multi Product Costing - PView']==1) { ?>
                      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                           <a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-money"></i><span class="m-menu__link-text">Product Costing</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                           <div class="m-menu__submenu ">
                              <span class="m-menu__arrow"></span>
                              <ul class="m-menu__subnav">
                                <?php if($_SESSION['Product CostingView']==1) { ?>
                                 <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>productcosting" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-money"><span></span></i><span class="m-menu__link-text">Single Costing</span>
                                    </a>
                                 </li>
                                 <?php } ?>
                                <?php if($_SESSION['Multi Product CostingView']==1){ ?>
                                 <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>multiproductcosting" class="m-menu__link ">
                                       <i class="m-menu__link-icon fas fa-coins"><span></span></i><span class="m-menu__link-text">Multi Costing - G</span>
                                    </a>
                                 </li>
                                 <?php }?>
                                <?php if($_SESSION['Multi Product Costing - PView']==1){ ?>
                                 <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>multiproductcostingproduct" class="m-menu__link ">
                                       <i class="m-menu__link-icon fas fa-coins"><span></span></i><span class="m-menu__link-text">Multi Costing - P</span>
                                    </a>
                                 </li>
                                 <?php } ?>
                               </ul>
                           </div>
                      </li>
                      <?php }?>
                      <?php //if($_SESSION['Product CostingView']==1){ ?>
                      <!-- <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>productcosting" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon fa fa-file-invoice-dollar"></i><span class="m-menu__link-text">Product Costing</span></a>
                      </li> -->
                      <?php //}?>
                      <?php //if($_SESSION['Multi Product CostingView']==1){ ?>
                      <!-- <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>multiproductcosting" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon fa fa-file-invoice-dollar"></i><span class="m-menu__link-text">Multi Product Costing - G</span></a>
                      </li> -->
                      <?php //}?>
                      <?php //if($_SESSION['Multi Product Costing - PView']==1){ ?>
                      <!-- <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>multiproductcostingproduct" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon fa fa-file-invoice-dollar"></i><span class="m-menu__link-text">Multi Product Costing - P</span></a>
                      </li> -->
                      <?php //}?>
                      
                    
                      <?php //if($_SESSION['TasksView']==1){ ?>
                      <!--<li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>task" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-tasks"></i><span class="m-menu__link-text">Tasks</span></a>
                      </li>-->
                      <?php //} ?>
                      <?php if($_SESSION['Quote ManagementView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>quote" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-newspaper-o"></i><span class="m-menu__link-text">Quote Management</span></a>
                      </li>
                      <?php }?>
                      <?php if($_SESSION['Proforma InvoiceView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>proformainvoice" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-comment"></i><span class="m-menu__link-text">Proforma Invoice</span></a>
                      </li>
                      <?php }?>
                      <?php if($_SESSION['Target ManagementView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>Targets" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-bullseye"></i><span class="m-menu__link-text">Target Management</span></a>
                      </li>
                      <?php }?>
                      <?php if($_SESSION['Buyer OrderView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>buyerorder" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-list"></i><span class="m-menu__link-text">Buyer Order</span></a>
                      </li>
                      <?php }?>
                      <?php if($_SESSION['Followup SheetView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>followupsheet" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-calendar-with-a-clock-time-tools"></i><span class="m-menu__link-text">Followup Sheet</span></a>
                      </li>
                      <?php }?>
                      <?php if($_SESSION['Benefit SheetView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>benefitsheet" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-money"></i><span class="m-menu__link-text">Benefit Sheet</span></a>
                      </li>
                      <?php }?>
                      <?php if($_SESSION['VendorView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>Vendor/index" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-user-plus"></i><span class="m-menu__link-text">Vendor</span></a>
                      </li>
                      <?php } ?>
                      <?php if($_SESSION['Supplier POView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>supplierpo" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-cubes"></i><span class="m-menu__link-text">Supplier PO</span></a>
                      </li>
                      <?php }?>
                      <?php if($_SESSION['Job OrderView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>joborder" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-briefcase"></i><span class="m-menu__link-text">Job Order</span></a>
                      </li>
                      <?php }?>
                      <?php if($_SESSION['InvoiceView']==1){ ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>invoice" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-sticky-note"></i><span class="m-menu__link-text">Invoice</span></a>
                      </li>
                      <?php }?>
                       <?php if($_SESSION['File ManagerView']==1) { ?>
                      <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/filemanager" class="m-menu__link">
                        <span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-file"></i><span class="m-menu__link-text">File Manager</span></a>
                      </li>
                      <?php } ?>
                      
                       <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                           <a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-pie-chart"></i><span
                              class="m-menu__link-text">Report Management</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                           <div class="m-menu__submenu ">
                              <span class="m-menu__arrow"></span>
                              <ul class="m-menu__subnav">
                                <?php if($_SESSION['Lead ReportView']) { ?>
                                 <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon la la-filter"><span></span></i>
                                    <span
                                       class="m-menu__link-text">Lead Report
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu ">
                                       <span class="m-menu__arrow"></span>
                                       <ul class="m-menu__subnav">
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>lead_source_report" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Lead Source Report</span></a></li>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Reports/lead_report_based_on_lead_source" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Lead By Product</span></a></li>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Reports/user_lead_report" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Lead By Users</span></a></li>
                                       </ul>
                                    </div>
                                 </li>
                                 <?php } ?>
                                 <!-- <li class="m-menu__item " aria-haspopup="true"> <a href="<?php // echo base_url(); ?>Reports/oppo_index" class="m-menu__link ">
                                       <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Opportunity Report</span>
                                    </a>
                                 </li> -->
                                 <?php if($_SESSION['Opportunity ReportView']) { ?>
                                 <li class="m-menu__item " aria-haspopup="true"> <a href="<?php echo base_url(); ?>Reports/oppo_based_product" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-diamond"><span></span></i><span class="m-menu__link-text">Opportunity Product Report</span>
                                    </a>
                                 </li>
                                 <?php } ?>
                                 <?php if($_SESSION['Quote ReportView']) { ?>
                                 <li class="m-menu__item " aria-haspopup="true"> <a href="<?php echo base_url(); ?>Reports/quote_report" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-newspaper-o"><span></span></i><span class="m-menu__link-text">Quote Report</span>
                                    </a>
                                 </li>
                                 <?php } ?>
                                 <?php if($_SESSION['Proforma ReportView']) { ?>
                                 <li class="m-menu__item " aria-haspopup="true"> <a href="<?php echo base_url(); ?>Reports/proforma_report" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-comment"><span></span></i><span class="m-menu__link-text">Proforma Report</span>
                                    </a>
                                 </li>
                                 <?php } ?>
                                 <li class="m-menu__item " aria-haspopup="true"> <a href="<?php echo base_url(); ?>buyerreport" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-list"><span></span></i><span class="m-menu__link-text">Buyer Report</span>
                                    </a>
                                 </li>

                                 <li class="m-menu__item " aria-haspopup="true"> <a href="<?php echo base_url(); ?>supplierreport" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-cubes"><span></span></i><span class="m-menu__link-text">Supplier Report</span>
                                    </a>
                                 </li>

                                 <li class="m-menu__item " aria-haspopup="true"> <a href="<?php echo base_url(); ?>salesreport" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-money"><span></span></i><span class="m-menu__link-text">Sales Report</span>
                                    </a>
                                 </li>

                                 <?php if($_SESSION['Comparison ReportView']) { ?>
                                 <li class="m-menu__item " aria-haspopup="true"> <a href="<?php echo base_url(); ?>Reports/comparison_report" class="m-menu__link ">
                                       <i class="m-menu__link-icon" style="font-size: 14px;font-weight: bold;">VS<span></span></i><span class="m-menu__link-text">Comparison Report</span>
                                    </a>
                                 </li>
                                <?php } ?>
                                <?php if($_SESSION['Target ReportView']) { ?>
                                 <li class="m-menu__item " aria-haspopup="true"> 
                                    <a href="<?php echo base_url(); ?>Reports/target_report" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-trophy"><span></span></i><span class="m-menu__link-text">Target VS Achievement</span>
                                    </a>
                                 </li>
                                <?php } ?>
                              </ul>
                           </div>
                      </li>
                       
                      <!--  <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                           <a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-open-box"></i><span
                              class="m-menu__link-text">Product Management</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                           <div class="m-menu__submenu ">
                              <span class="m-menu__arrow"></span>
                              <ul class="m-menu__subnav">
                                 <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                                  <a href="<?php //echo base_url(); ?>Settings/industry_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Industry List</span></a></li>

                                 <li class="m-menu__item " aria-haspopup="true"><a href="<?php //echo base_url(); ?>Products" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Product List</span></a></li>
                              </ul>
                           </div>
                      </li> -->

                      <!-- <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                           <a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-profile-1"></i><span
                              class="m-menu__link-text">User Management</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                           <div class="m-menu__submenu ">
                              <span class="m-menu__arrow"></span>
                              <ul class="m-menu__subnav">
                                 <li class="m-menu__item" aria-haspopup="true" m-menu-link-redirect="1"><a href="<?php //echo base_url(); ?>Roles" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Role Permission</span></a></li>

                                 <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>Users" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">User List</span></a></li>
                              </ul>
                           </div>
                      </li> -->
                      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                           <a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon la la-cog"></i><span
                              class="m-menu__link-text">Settings</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                           <div class="m-menu__submenu ">
                              <span class="m-menu__arrow"></span>
                              <ul class="m-menu__subnav">
                                <?php if($_SESSION['General SettingsEdit']==1){ ?>
                                 <li class="m-menu__item" aria-haspopup="true">    <a href="<?php echo base_url(); ?>Settings" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-gears"><span></span></i><span class="m-menu__link-text">General Settings</span>
                                    </a>
                                 </li>
                                 <?php }?>
                                 <?php if($_SESSION['Dashboard SettingsEdit']==1){ ?>
                                    <li class="m-menu__item " aria-haspopup="true">
                                      <a href="<?php echo base_url(); ?>dashboardsettings" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-dashboard"><span></span></i><span class="m-menu__link-text">Dashboard Settings</span>
                                      </a>
                                    </li>
                                  <?php }?>

                                 <?php if($_SESSION['Rajexim Email SettingsView']==1){ ?>
                                  <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon la la-envelope"><span></span></i>
                                    <span
                                       class="m-menu__link-text">Email Settings
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu ">
                                       <span class="m-menu__arrow"></span>
                                       <ul class="m-menu__subnav">
                                          <?php if($_SESSION['Rajexim Email SettingsView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/email_list" class="m-menu__link ">
                                          <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Email Configuration</span>
                                          </a></li>
                                          <?php } ?>
                                          <?php if($_SESSION['Email DomainView']==1) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/email_domain" class="m-menu__link ">
                                          <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Email Domain</span>
                                          </a>
                                          </li>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/block_email_domain" class="m-menu__link">
                                          <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Block Email Domain</span>
                                          </a>
                                          </li>
                                          <?php } ?>
                                       </ul>
                                    </div>
                                 </li>
                                 <!-- 
                                 <li class="m-menu__item " aria-haspopup="true">    <a href="<?php echo base_url(); ?>Settings/email_list" class="m-menu__link ">
                                       <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Email Settings</span>
                                    </a>
                                 </li> -->
                                 <?php } ?>
                                 <?php if($_SESSION['Loading TypeView']==1){ ?>
                                    <li class="m-menu__item " aria-haspopup="true">
                                      <a href="<?php echo base_url(); ?>loadingtype" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-ship"><span></span></i><span class="m-menu__link-text">Loading Type</span>
                                      </a>
                                    </li>
                                  <?php } ?>
                                
                                 <?php if($_SESSION['ContainerView']==1) { ?>
                                    <li class="m-menu__item " aria-haspopup="true">
                                      <a href="<?php echo base_url(); ?>container" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-dropbox"><span></span></i><span class="m-menu__link-text">Container</span>
                                      </a>
                                    </li>
                                  <?php } ?>

                                  <?php if($_SESSION['File Manager AccessView']==1){ ?>
                                    <li class="m-menu__item " aria-haspopup="true">
                                      <a href="<?php echo base_url(); ?>Settings/filemanager_access" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-folder-open"><span></span></i><span class="m-menu__link-text">File Manager Access</span>
                                      </a>
                                    </li>
                                  <?php } ?>
                                  <?php if($_SESSION['Task TagView']==1){ ?>
                                    <li class="m-menu__item " aria-haspopup="true">
                                      <a href="<?php echo base_url(); ?>tasktag" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-tags"><span></span></i><span class="m-menu__link-text">Task Tags</span>
                                      </a>
                                    </li>
                                  <?php } ?>
                                <li class="m-menu__item " aria-haspopup="true">  <a href="<?php echo base_url(); ?>Settings/display_menu" class="m-menu__link ">
                                       <i class="m-menu__link-icon la la-outdent"><span></span></i><span class="m-menu__link-text">Menu Display Settings</span>
                                    </a>
                                 </li>
                                 <!-- <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>Leads/lead_type_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Lead Type</span></a></li>
                                 <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>Leads/lead_source_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Lead Source</span></a></li>
                                 <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>Leads/lead_status_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Lead Status</span></a></li> -->
                                 <?php if($_SESSION['Lead SettingsView']==1){ ?>
                                 <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon la la-filter"><span></span></i>
                                    <span
                                       class="m-menu__link-text">Lead Settings
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu ">
                                       <span class="m-menu__arrow"></span>
                                       <ul class="m-menu__subnav">
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/lead_type_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Lead Type</span></a></li>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/lead_source_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Lead Source</span></a>
                                          </li>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/sub_lead_source_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Sub Lead Source</span></a>
                                          </li>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/lead_status_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Lead Status</span></a>
                                          </li>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/oppo_status_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Opportunity Status</span></a>
                                          </li>
                                       </ul>
                                    </div>
                                 </li>
                                 <?php } ?>
                                <?php if($_SESSION['ExporterView']==1 || $_SESSION['Quote StageView']==1 || $_SESSION['Vessel FlightView']==1 || $_SESSION['PortView']==1 || $_SESSION['Price TermsView']==1 || $_SESSION['CurrencyView']==1 || $_SESSION['InterestView']==1 || $_SESSION['PI StageView']==1 || $_SESSION['Pre-Carriage ByView']==1 || $_SESSION['Terms of PaymentView']==1 || $_SESSION['Terms and PaymentView']==1 || $_SESSION['ArbitrationView']==1 || $_SESSION['DeclarationView']==1 || $_SESSION['Document RequiredView']==1 || $_SESSION['Bank DetailView']==1 || $_SESSION['Product Costing CategoryView']==1 || $_SESSION['Product Costing TypeView']==1 || $_SESSION['Multi Product Costing TypeView']==1 || $_SESSION['Multi Product Costing Type - PView']==1 || $_SESSION['Value VariantView']==1){ ?>
                                 <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon la la-comment"><span></span></i>
                                    <span
                                       class="m-menu__link-text">Proforma Invoice
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu ">
                                       <span class="m-menu__arrow"></span>
                                       <ul class="m-menu__subnav">
                                        <?php if($_SESSION['ExporterView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>exporter" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Exporter</span></a>
                                          </li>
                                          <?php }?>
                                        <?php if($_SESSION['Quote StageView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>quotestage" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Quote Stage</span></a>
                                          </li>
                                          <?php }?>
                                          <?php if($_SESSION['Value VariantView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/value_variant" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Value Variant</span></a>
                                          </li>
                                          <?php } ?>
                                          <!-- <li class="m-menu__item " aria-haspopup="true">
                                            <a href="<?php //echo base_url(); ?>Settings/value_variant" class="m-menu__link ">
                                             <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Value Variant</span>
                                            </a>
                                          </li> -->
                                        <?php if($_SESSION['Vessel FlightView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>vesselflight" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Vessel Flight</span></a>
                                          </li>
                                          <?php } ?>
                                        <?php if($_SESSION['PortView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>port" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Port</span></a>
                                          </li>
                                          <?php }?>
                                        <?php if($_SESSION['Price TermsView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>PriceTerms" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Price Terms</span></a>
                                          </li>
                                        <?php }?>
                                        <?php if($_SESSION['CurrencyView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Currency" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Currency</span></a>
                                          </li>
                                        <?php }?>
                                        <?php if($_SESSION['InterestView'] == 1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Interests" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Interest</span></a>
                                          </li>
                                        <?php } ?>
                                        <?php if($_SESSION['PI StageView'] == 1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>PI_Stages" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">PI Stage</span></a>
                                          </li>
                                        <?php } ?>
                                        <?php if($_SESSION['Pre-Carriage ByView'] == 1) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Pre_carriage_by" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Pre-Carriage By</span></a>
                                          </li>
                                        <?php } ?>
                                        <?php if($_SESSION['Terms of PaymentView'] == 1) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Terms_of_payment" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Terms of Payment</span></a>
                                          </li>
                                        <?php } ?>
                                        <?php if($_SESSION['Terms and PaymentView'] == 1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Terms_and_payment" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Terms and Payment</span></a>
                                          </li>
                                        <?php } ?>
                                        <?php if($_SESSION['ArbitrationView'] == 1) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Arbitrations" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Arbitration</span></a>
                                          </li>
                                        <?php } ?>
                                        <?php if($_SESSION['DeclarationView'] == 1) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Declarations" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Declaration</span></a>
                                          </li>
                                        <?php } ?>
                                        <?php if($_SESSION['Document RequiredView'] == 1) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Document_Req" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Document Required</span></a>
                                          </li>
                                        <?php } ?>
                                        <?php if($_SESSION['Bank DetailView'] == 1) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>bankdetail" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Bank Detail</span></a>
                                          </li>
                                        <?php } ?>
                                       </ul>
                                    </div>
                                 </li>
                                 <?php }?>

                                <?php if($_SESSION['Followup Sheet CategoryView']==1 || $_SESSION['Followup Sheet StageView']==1){ ?>
                                 <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon la la-calendar-check-o"><span></span></i>
                                    <span
                                       class="m-menu__link-text">Followup Sheet
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu ">
                                       <span class="m-menu__arrow"></span>
                                       <ul class="m-menu__subnav">
                                        <?php if($_SESSION['Followup Sheet CategoryView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>followupsheetcategory" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Category</span></a>
                                          </li>
                                          <?php }?>
                                        <?php if($_SESSION['Followup Sheet StageView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>followupsheetstage" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Stage</span></a>
                                          </li>
                                          <?php }?>
                                       </ul>
                                    </div>
                                 </li>
                                 <?php }?>

                                <?php if($_SESSION['Product Costing CategoryView']==1 || $_SESSION['Product Costing TypeView']==1 || $_SESSION['Multi Product Costing TypeView']==1 || $_SESSION['Multi Product Costing Type - PView']==1){ ?>
                                 <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon la la-money"><span></span></i>
                                    <span
                                       class="m-menu__link-text">Product Costing
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu ">
                                       <span class="m-menu__arrow"></span>
                                       <ul class="m-menu__subnav">
                                        <?php if($_SESSION['Product Costing CategoryView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>productcostingcategory" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Product Costing Category</span></a>
                                          </li>
                                          <?php }?>
                                        <?php if($_SESSION['Product Costing TypeView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>productcostingtype" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Product Costing Type</span></a>
                                          </li>
                                          <?php }?>
                                        <?php if($_SESSION['Multi Product Costing TypeView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>multiproductcostingtemplate" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Multi Product Costing Type - G</span></a>
                                          </li>
                                          <?php }?>
                                        <?php if($_SESSION['Multi Product Costing Type - PView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>multiproductcostingtypeproduct" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Multi Product Costing Type - P</span></a>
                                          </li>
                                          <?php }?>
                                       </ul>
                                    </div>
                                 </li>
                                 <?php }?>

                                <?php if($_SESSION['Vendor TypeView']==1 || $_SESSION['Vendor CategoryView']==1){ ?>
                                 <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon la la-user-plus"><span></span></i>
                                    <span
                                       class="m-menu__link-text">Vendor
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu ">
                                       <span class="m-menu__arrow"></span>
                                       <ul class="m-menu__subnav">
                                        <?php if($_SESSION['Vendor TypeView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>vendortype" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Vendor Type</span></a>
                                          </li>
                                          <?php }?>
                                        <?php if($_SESSION['Vendor CategoryView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>vendorcategory" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Vendor Category</span></a>
                                          </li>
                                          <?php }?>
                                       </ul>
                                    </div>
                                 </li>
                                 <?php } ?>

                                <?php if($_SESSION['Industry ListView']==1 || $_SESSION['Product ListView']==1 || $_SESSION['Product Item ListView']==1 || $_SESSION['Product UnitView']==1){ ?>
                                 <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon la la-cart-plus"><span></span></i>
                                    <span
                                       class="m-menu__link-text">Product Settings
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu ">
                                       <span class="m-menu__arrow"></span>
                                       <ul class="m-menu__subnav">
                                        <?php if($_SESSION['Industry ListView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/industry_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Industry List</span></a></li>
                                          <?php } ?>
                                          <?php if($_SESSION['Product ListView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Products" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Product List</span></a>
                                          </li>
                                          <?php } ?>
                                          <?php if($_SESSION['Product Item ListView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>product_item_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Product Item List</span></a>
                                          </li>
                                          <?php } ?>
                                          <?php if($_SESSION['Product UnitView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/product_unit" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Product Unit</span></a>
                                          </li>
                                          <?php } ?>
                                       </ul>
                                    </div>
                                 </li>
                                 <?php } ?>
                                <?php if($_SESSION['Role PermissionView']==1 || $_SESSION['UserView']==1 || $_SESSION['EmployeeView']==1) { ?>
                                 <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon la la-users"><span></span></i>
                                    <span
                                       class="m-menu__link-text">User Settings
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu ">
                                       <span class="m-menu__arrow"></span>
                                       <ul class="m-menu__subnav">
                                        <?php if($_SESSION['Role PermissionView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Roles" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Role Permission</span></a></li>
                                        <?php } ?>
                                          <?php if($_SESSION['UserView']==1){ ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Users" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">User List</span></a>
                                          <?php } ?>
                                            <?php //if($_SESSION['EmployeeView']==1) { ?>
                                          <!--<li class="m-menu__item " aria-haspopup="true"><a href="<?php //echo base_url(); ?>employee" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Employee</span></a>
                                          </li>-->
                                          <?PHP //} ?>
                                       </ul>
                                    </div>
                                 </li>
                               <?php } ?>
                               <?php if($_SESSION['Task Data ClearanceDelete']==1){ ?>
                               <li class="m-menu__item " aria-haspopup="true">
                                <a href="<?php echo base_url(); ?>Settings/task_data_clear_page" class="m-menu__link ">
                                  <i class="m-menu__link-icon la la-trash">
                                    <span></span>
                                  </i>
                                  <span class="m-menu__link-text">Task Data Clearance</span>
                                </a>
                               </li>
                               <?php } ?>
                               <?php if($_SESSION['Run Auto Setup FunctionsDB_backup']==1 || $_SESSION['Run Auto Setup FunctionsEmail_import']==1){ ?>
                               <li class="m-menu__item " aria-haspopup="true">
                                <a href="<?php echo base_url(); ?>Settings/manual_crons" class="m-menu__link ">
                                  <i class="m-menu__link-icon la la-refresh">
                                    <span></span>
                                  </i>
                                  <span class="m-menu__link-text">Run Auto Setup Functions</span>
                                </a>
                               </li>
                               <?php } echo $_SESSION['Task Data Clearance']; ?>

                               
                              </ul>
                           </div>
                      </li> 

                      <!-- <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                         <a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-interface-7"></i><span class="m-menu__link-text">Forms
                         & Controls</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                         <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                               <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Forms & Controls</span></span></li>
                               <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                  <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                  <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                  <span
                                     class="m-menu__link-text">Form Controls
                                  </span>
                                  <i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                  <div class="m-menu__submenu ">
                                     <span class="m-menu__arrow"></span>
                                     <ul class="m-menu__subnav">
                                        <li class="m-menu__item " aria-haspopup="true"><a href="crud/forms/controls/base.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Base Inputs</span></a></li>
                                        <li class="m-menu__item " aria-haspopup="true"><a href="crud/forms/controls/checkbox-radio.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Checkbox &
                                           Radio</span></a>
                                        </li>
                                     </ul>
                                  </div>
                               </li>
                            </ul>
                         </div>
                      </li> -->
                  </ul>
</div>