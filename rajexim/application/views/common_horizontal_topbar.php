<style>
   /*.horizontal_scroll {
      overflow: auto;
      overflow-y: hidden;
   }*/
   /*.horizontal_scroll {
     margin: 0 auto;
     overflow-y: hidden;
   }*/
   .m-topbar .m-topbar__nav.m-nav>.m-nav__item>.m-nav__link .m-nav__link-icon .m-nav__link-icon-wrapper>i { 
    color: #d2d2d2;
   }
</style>

<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container horizontal_scroll">
                  <div class="m-stack m-stack--ver m-stack--desktop">

                     <!-- begin::Horizontal Menu -->
                     <div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
                        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                           <ul class="m-menu__nav  m-menu__nav--submenu-arrow" id="horizontal_scrollable">
                              
                              <li class="m-menu__item hori_menu" aria-haspopup="true"><a href="<?php echo base_url(); ?>Dashboard" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Dashboard</span></a></li>
                             
                              <?php if($_SESSION['Lead ManagementView']==1){ ?>
                              <!-- <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Lead Management</span></a></li> -->
                              <li class="hori_menu m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
                                     class="m-menu__link-text">Lead Management</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                 <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                       
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>new_leads?active_tab=1" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">New Lead</span> </span></span></a></li>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>followup_leads?active_tab=2" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Followup Leads</span>  </span></span></a></li>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>archived_leads?active_tab=3" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Archived Leads</span>  </span></span></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <?php } ?>
                              <?php if($_SESSION['Lead ManagementView']==1){ ?>
                              

                              <li class="hori_menu m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
                                     class="m-menu__link-text">Opportunity</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                 <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                       
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/opportunity_list?active_tab=1" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Opportunity List</span> </span></span></a></li>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>converted_leads?active_tab=2" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Converted List</span>  </span></span></a></li>
                                      
                                    </ul>
                                 </div>
                              </li>
                              <?php } ?>
                              <li class="hori_menu m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>assets/responsive_filemanager/filemanager/dialog.php?type=2" class="m-menu__link filemanager_iframe"><span class="m-menu__item-here"></span><span class="m-menu__link-text">File Manager</span></a></li>
                              <?php if($_SESSION['Multi Product CostingView']==1 || $_SESSION['Multi Product Costing - PView']==1){ ?>
                              <!-- <li class="m-menu__item " aria-haspopup="true"><a href="<?php //echo base_url(); ?>productcosting" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Product Costing</span></a></li> -->

                              <li class="hori_menu m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
                                     class="m-menu__link-text">Product Costing</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                 <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                       <?php if($_SESSION['Single Product CostingView']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>productcosting" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Single Costing</span> </span></span></a></li>
                                       <?php } ?>
                                       <?php if($_SESSION['Multi Product CostingView']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>multiproductcosting" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Multi Costing - G</span>  </span></span></a></li>
                                       <?php } ?>

                                       <?php if($_SESSION['Multi Product Costing - PView']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>multiproductcostingproduct" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Multi Costing - P</span>  </span></span></a></li>
                                       <?php } ?>
                                    </ul>
                                 </div>
                              </li>
                              <?php } ?>
                              <?php if($_SESSION['MailboxView']==1){ ?>
                                 <li class="hori_menu m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Mailbox" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Mail Box</span></a></li>
                              <?php } ?>
                              <?php if($_SESSION['Quote ManagementView']==1){ ?>
                                 <li class="hori_menu m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>quote" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Quote Management</span></a></li>
                              <?php } ?>
                              <?php if($_SESSION['Proforma InvoiceView']==1){ ?>
                                 <li class="hori_menu m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>proformainvoice" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Proforma Invoice</span></a></li>
                              <?php } ?>
                              <?php if($_SESSION['Target ManagementView']==1){ ?>
                                 <li class="hori_menu m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Targets" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Target Management</span></a></li>
                              <?php } ?>
                              <?php if($_SESSION['Buyer OrderView']==1){ ?>
                                 <li class="hori_menu m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>buyerorder" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Buyer Order</span></a></li>
                              <?php } ?>
                              <?php if($_SESSION['Supplier POView']==1){ ?>
                                 <li class="hori_menu m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>supplierpo" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Supplier PO</span></a></li>
                              <?php } ?>
                              <?php if($_SESSION['Job OrderView']==1){ ?>
                                 <li class="hori_menu m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>joborder" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Job Order</span></a></li>
                              <?php } ?>
                              <?php if($_SESSION['InvoiceView']==1){ ?>
                                 <li class="hori_menu m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>invoice" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Invoice</span></a></li>
                              <?php } ?>

                                 <li class="hori_menu m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
                                     class="m-menu__link-text">Report Management</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                       <ul class="m-menu__subnav">
                                          <?php if($_SESSION['Lead ReportView']) { ?>
                                          <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                                          <span class="m-menu__link-text">Lead Reports</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                             <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                                <ul class="m-menu__subnav">
                                                   <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>lead_source_report" class="m-menu__link "><span class="m-menu__link-text">Lead Source Report</span></a></li>
                                                   <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Reports/lead_report_based_on_lead_source" class="m-menu__link "><span class="m-menu__link-text">Lead By Product</span></a></li>
                                                   <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Reports/user_lead_report" class="m-menu__link "><span class="m-menu__link-text">Lead By Users</span></a></li>
                                                   
                                                </ul>
                                             </div>
                                          </li>
                                          <?php } ?>
                                          <?php if($_SESSION['Opportunity ReportView']) { ?>
                                          <li class="m-menu__item " aria-haspopup="true">
                                             <a href="<?php echo base_url(); ?>Reports/oppo_based_product" class="m-menu__link ">
                                                <span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Opportunity Product Report</span>  </span></span>
                                             </a>
                                          </li>
                                          <?php } ?>

                                          <?php if($_SESSION['Quote ReportView']) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Reports/quote_report" class="m-menu__link"><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Quote Report</span>  </span></span></a></li>
                                          <?php } ?>

                                          <?php if($_SESSION['Comparison ReportView']) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Reports/comparison_report" class="m-menu__link"><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Comparison Report</span>  </span></span></a></li>
                                          <?php } ?>

                                          <?php if($_SESSION['Target ReportView']) { ?>
                                          <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Reports/target_report" class="m-menu__link"><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Target VS Achievement</span>  </span></span></a></li>
                                          <?php } ?>
                                       </ul>
                                    </div>
                                 </li>
                              <!-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
                                     class="m-menu__link-text">Product Management</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                 <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php //echo base_url(); ?>Settings/industry_list" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Industry List</span>  </span></span></a></li>

                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php //echo base_url(); ?>Products" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Product List</span> </span></span></a></li>

                                       
                                    </ul>
                                 </div>
                              </li>
                              <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
                                     class="m-menu__link-text">User Management</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                 <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                       
                                       <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>Roles" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Role Permission</span> </span></span></a></li>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php //echo base_url(); ?>Users" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">User List</span>  </span></span></a></li>
                                       
                                    </ul>
                                 </div>
                              </li> -->

                              <li class="hori_menu m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
                                     class="m-menu__link-text">Settings</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                 <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                       <?php if($_SESSION['General SettingsEdit']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">General Settings</span> </span></span></a></li>
                                       <?php } ?>
                                       <?php if($_SESSION['Dashboard SettingsEdit']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>dashboardsettings" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Dashboard Settings</span>  </span></span></a></li>
                                       <?php } ?>

                                       <?php if($_SESSION['Rajexim Email SettingsView']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/email_list" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Email Settings</span>  </span></span></a></li>
                                       <?php } ?>
                                       <?php if($_SESSION['Email DomainView']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/email_domain" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Email Domain</span>  </span></span></a></li>
                                       <?php } ?>
                                       <?php if($_SESSION['Email DomainView']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/block_email_domain" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Block Email Domain</span>  </span></span></a></li>
                                       <?php } ?>
                                       <?php if($_SESSION['Loading TypeView']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>loadingtype" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Loading Type</span>  </span></span></a></li>
                                       <?php } ?>

                                       <?php if($_SESSION['DesignationView']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>designation" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Designation</span>  </span></span></a></li>
                                       <?php } ?>

                                       <?php if($_SESSION['ContainerView']==1){ ?>
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>container" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Container</span>  </span></span></a></li>
                                       <?php } ?>

                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/filemanager_access" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">File Manager Access</span>  </span></span></a></li>
                                       
                                       <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/display_menu" class="m-menu__link "><!-- <i class="m-menu__link-icon flaticon-diagram"></i> --><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Menu Display Settings</span>  </span></span></a></li>
                                      <!--  <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>Leads/lead_type_list" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Lead Type</span> </span></span></a></li>
                                       <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>Leads/lead_source_list" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Lead Source</span> </span></span></a></li>
                                       <li class="m-menu__item" aria-haspopup="true"><a href="<?php //echo base_url(); ?>Leads/lead_status_list" class="m-menu__link "><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Lead Status</span> </span></span></a></li> -->
                                       <?php if($_SESSION['Lead SettingsView']==1){ ?>
                                       <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                                          <span class="m-menu__link-text">Lead Settings</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                          <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/lead_type_list" class="m-menu__link "><span class="m-menu__link-text">Lead Type</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/lead_source_list" class="m-menu__link "><span class="m-menu__link-text">Lead Source</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/sub_lead_source_list" class="m-menu__link "><span class="m-menu__link-text">Sub Lead Source</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/lead_status_list" class="m-menu__link "><span class="m-menu__link-text">Lead Status</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Leads/oppo_status_list" class="m-menu__link "><span class="m-menu__link-text">Opportunity Status</span></a></li>
                                             </ul>
                                          </div>
                                       </li>
                                       <?php } ?>

                                       <?php if($_SESSION['ExporterView']==1 || $_SESSION['Quote StageView']==1 || $_SESSION['Vessel FlightView']==1 || $_SESSION['PortView']==1 || $_SESSION['Price TermsView']==1 || $_SESSION['CurrencyView']==1 || $_SESSION['InterestView']==1 || $_SESSION['PI StageView']==1 || $_SESSION['Pre-Carriage ByView']==1 || $_SESSION['Terms of PaymentView']==1 || $_SESSION['Terms and PaymentView']==1 || $_SESSION['ArbitrationView']==1 || $_SESSION['DeclarationView']==1 || $_SESSION['Document RequiredView']==1 || $_SESSION['Bank DetailView']==1 || $_SESSION['Product Costing CategoryView']==1 || $_SESSION['Product Costing TypeView']==1){ ?>

                                       <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                                          <span class="m-menu__link-text">Proforma Invoice</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                          <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                <?php if($_SESSION['ExporterView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>exporter" class="m-menu__link "><span class="m-menu__link-text">Exporter</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['Quote StageView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>quotestage" class="m-menu__link "><span class="m-menu__link-text">Quote Stage</span></a></li>
                                                <?php } ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/value_variant" class="m-menu__link "><span class="m-menu__link-text">Value Variant</span></a></li>
                                                
                                                <?php if($_SESSION['Vessel FlightView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>vesselflight" class="m-menu__link "><span class="m-menu__link-text">Vessel Flight</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['PortView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>port" class="m-menu__link "><span class="m-menu__link-text">Port</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['Price TermsView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>PriceTerms" class="m-menu__link "><span class="m-menu__link-text">Price Terms</span></a></li>
                                                <?php } ?>

                                                <?php if($_SESSION['CurrencyView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Currency" class="m-menu__link "><span class="m-menu__link-text">Currency</span></a></li>
                                                <?php } ?>

                                                <?php if($_SESSION['InterestView'] == 1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Interests" class="m-menu__link "><span class="m-menu__link-text">Interest</span></a></li>
                                                <?php } ?>

                                                <?php if($_SESSION['PI StageView'] == 1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>PI_Stages" class="m-menu__link "><span class="m-menu__link-text">PI Stage</span></a></li>
                                                <?php } ?>

                                                <?php if($_SESSION['Pre-Carriage ByView'] == 1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Pre_carriage_by" class="m-menu__link"><span class="m-menu__link-text">Pre-Carriage By</span></a></li>
                                                <?php } ?>

                                                <?php if($_SESSION['Terms of PaymentView'] == 1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Terms_of_payment" class="m-menu__link"><span class="m-menu__link-text">Terms of Payment</span></a></li>
                                                <?php } ?>

                                                <?php if($_SESSION['Terms and PaymentView'] == 1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Terms_and_payment" class="m-menu__link"><span class="m-menu__link-text">Terms and Payment</span></a></li>
                                                <?php } ?>

                                                <?php if($_SESSION['ArbitrationView'] == 1) { ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Arbitrations" class="m-menu__link"><span class="m-menu__link-text">Arbitration</span></a></li>
                                                <?php } ?>

                                                <?php if($_SESSION['DeclarationView'] == 1) { ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Declarations" class="m-menu__link"><span class="m-menu__link-text">Declaration</span></a></li>
                                                <?php } ?>
                                                
                                                <?php if($_SESSION['Document RequiredView'] == 1) { ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Document_Req" class="m-menu__link"><span class="m-menu__link-text">Document Required</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['Bank DetailView'] == 1) { ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>bankdetail" class="m-menu__link"><span class="m-menu__link-text">Bank Detail</span></a></li>
                                                <?php } ?>
                                             </ul>
                                          </div>
                                       </li>

                                       <?php } ?>

                                       <?php if($_SESSION['Industry ListView']==1 || $_SESSION['Product ListView']==1 || $_SESSION['Product Item ListView']==1 || $_SESSION['Product UnitView']==1){ ?>
                                       <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                                          <span
                                              class="m-menu__link-text">Product Settings</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                          <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                <?php if($_SESSION['Industry ListView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/industry_list" class="m-menu__link "><span class="m-menu__link-text">Industry List</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['Product ListView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Products" class="m-menu__link "><span class="m-menu__link-text">Product List</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['Product Item ListView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>product_item_list" class="m-menu__link "><span class="m-menu__link-text">Product Item List</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['Product UnitView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Settings/product_unit" class="m-menu__link "><span class="m-menu__link-text">Product Unit</span></a></li>
                                                <?php } ?>
                                             </ul>
                                          </div>
                                       </li>
                                       <?php } ?>
                                       <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                                          <span
                                              class="m-menu__link-text">Vendor</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                          <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                <?php if($_SESSION['Vendor TypeView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>vendortype" class="m-menu__link "><span class="m-menu__link-text">Vendor Type</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['Vendor CategoryView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>vendorcategory" class="m-menu__link "><span class="m-menu__link-text">Vendor Category</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['VendorView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>vendor" class="m-menu__link "><span class="m-menu__link-text">Vendor List</span></a></li>
                                                <?php } ?>
                                             </ul>
                                          </div>
                                       </li>
                                       <?php if($_SESSION['Role PermissionView']==1 || $_SESSION['UserView']==1 || $_SESSION['EmployeeView']==1) { ?>
                                       <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                                          <span class="m-menu__link-text">User Settings</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                          <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                             <span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                <?php if($_SESSION['Role PermissionView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Roles" class="m-menu__link "><span class="m-menu__link-text">Role Permission</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['UserView']==1){ ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Users" class="m-menu__link "><span class="m-menu__link-text">User List</span></a></li>
                                                <?php } ?>
                                                <?php if($_SESSION['EmployeeView']==1) { ?>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="<?php echo base_url(); ?>Users" class="m-menu__link "><span class="m-menu__link-text">User List</span></a></li>
                                                <?PHP } ?>
                                             </ul>
                                          </div>
                                       </li>
                                       <?php } ?>
                                    </ul>
                                 </div>
                              </li>



                              <!-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
                                 <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
                                        class="m-menu__link-text">Actions</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i>
                                 </a>
                                 <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                       <li class="m-menu__item " aria-haspopup="true">
                                          <a href="inner.html" class="m-menu__link ">
                                             <i class="m-menu__link-icon flaticon-diagram"></i>
                                             <span class="m-menu__link-title"> 
                                                <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Generate
                                                      Reports</span> 
                                                </span>
                                             </span>
                                          </a>
                                       </li>
                                       <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i class="m-menu__link-icon flaticon-business"></i>
                                          <span
                                              class="m-menu__link-text">Manage Orders</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                          <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Latest Orders</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Pending Orders</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Processed Orders</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Delivery Reports</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Payments</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Customers</span></a></li>
                                             </ul>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                              </li> -->

                              <li class="hori_menu m-menu__item" aria-haspopup="true"><a href="javascript:;" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a></li>
                              
                           </ul>
                        </div>
                     </div>

                     <!-- end::Horizontal Menu -->

                  </div>
               </div>
