<?php $this->load->view('common_header'); $date_format =common_date_format();?>

 
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
/*.td_bold_font {
   font-size : 6px;
}*/
</style>

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
                              <a href="<?php echo base_url(); ?>invoice" class="m-nav__link">
                                 <span class="m-nav__link-text">Invoice</span>
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
                                      Invoice List
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

                                    <!-- <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                       <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                          Export
                                       </a>
                                       <div class="m-dropdown__wrapper" style="z-index: 101;">
                                          <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36px;"></span>
                                          <div class="m-dropdown__inner">
                                             <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                   <ul class="m-nav">
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
                                    </li> -->
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" onclick="inv_export_items();" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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



                              <form method="POST" action="<?php echo base_url();?>invoice">
                                 <div class="my_filter" style="display: none;"> 
                                    <div class="row">
                                       <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Country</label>
                                             <select class="form-control selectpicker" data-live-search="true" id="country_id" name="country_id" onchange="submit_iv_filter('filter');">
                                                <option value="">All</option>
                                                <?php
                                                   if(!empty($country_lists))
                                                   {
                                                      foreach ($country_lists as $key => $c_list) 
                                                      { ?>
                                                         <option value="<?php echo $c_list->id; ?>" <?php if($f_l_country == $c_list->id){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $c_list->name; ?></option>

                                                      <?php  } 
                                                   }
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
                                       <div class="col-lg-2 boq" style="<?php echo $fbasesearch=='BonQuarter'?'':'display:none';?>">
                                          <div class="form-group m-form__group">
                                             <label></label>
                                             <input id="goButtonboq" name="goButtonboq" value="Go" class="btn btn-primary inp" style="margin-top:26px;" type="button" onclick="submit_iv_filter('filter');">
                                          </div>
                                       </div>
                                       
                                       <div class="col-lg-2 bod" style="<?php echo $fbasesearch=='BonDate'?'':'display:none';?>">
                                          <div class="form-group m-form__group">
                                             <label>Filter By</label>
                                             <select class="custom-select form-control" id="searchChange" name="searchChange" onchange="if (this.value!='thisDate') {showFilterDate();submit_iv_filter('filter');} else {showFilterDate();}">
                                                <option value="" <?php if($purchasesearch=='') echo "selected";?>>Select</option>
                                                <option value="today" <?php if($purchasesearch=='today') echo "selected";?>>Today</option>
                                                     <option value="thisweek" <?php if($purchasesearch=='thisweek') echo "selected";?>>This Week</option>
                                                     <option value="thismonth" <?php if($purchasesearch=='thismonth') echo "selected";?>>This Month</option>
                                                     <option value="thisyear" <?php if($purchasesearch=='thisyear') echo "selected";?>>This Year</option>
                                                      <option value="thisDate" <?php if($purchasesearch=='thisDate') echo "selected";?>>Date</option>
                                             </select>
                                          </div>
                                       </div>

                                       <div class="col-lg-2 drp" style="<?php echo $purchasesearch=='thisDate'?'display:inline-block':'display:none';?>; min-width: 360px; ">
                                          <div class="form-group m-form__group">
                                             <label>Date Range</label>
                                             <div class="row">
                                                <div class="col-lg-5">
                                                   <input type="text" id="alter_dtrange_from" onblur="change_from_date_format();" name="alter_dtrange_from" placeholder="From Date" class="form-control m_datepicker_1" value="<?php echo $dtrange_from; ?>" style="width: 130px;"> 
                                                </div>
                                                <div class="col-lg-1">To</div>
                                                <div class="col-lg-5">
                                                   <input type="text" id="alter_dtrange_to" onblur="change_to_date_format();" name="alter_dtrange_to" placeholder="To Date" class="form-control m_datepicker_1" value="<?php echo $dtrange_to; ?>" style="width: 130px;">
                                                </div>
                                                <div class="col-lg-1">
                                                   <div class="input-group-append">
                                                         <input id="goButton" name="goButton" value="Go" class="btn btn-primary inp" type="button" onclick="submit_iv_filter('filter');">
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
                              <div class="row" id="iv_list_table_append_block" style="display: none;"> 
                                 
                              </div>
                              <div class="row" id="iv_list_table_append_block_loader"> 
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
         <div class="container">
            <div class="modal fade" id="inv_export_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Export Invoice Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="<?php echo base_url(); ?>Leads/export_inv_info" method="POST" onsubmit="return inv_exp_validation()">
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
                                               <input type="hidden" name="exp_inv_filt_year_val" id="exp_inv_filt_year_val">
                                               <input type="hidden" name="quarter_or_range" id="quarter_or_range">
                                               <span id="exp_inv_filt_year"></span>
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="">
                                             <label class="">
                                               <label class="label" style="color: #2D4A89;">Quarter :</label>
                                               <input type="hidden" name="exp_inv_filt_quarter_val" id="exp_inv_filt_quarter_val">
                                               <span id="exp_inv_filt_quarter"></span>
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="">
                                             <label class="">
                                               <label class="label" style="color: #2D4A89;">Search By :</label>
                                               <input type="hidden" name="exp_inv_filt_search_val" id="exp_inv_filt_search_val">
                                               <span id="exp_inv_filt_search"></span>
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="">
                                             <label class="">
                                               <label class="label" style="color: #2D4A89;">Date Range Wise :</label>
                                               <input type="hidden" name="exp_inv_filt_dtrng_val" id="exp_inv_filt_dtrng_val">
                                               <span id="exp_inv_filt_dtrng"></span>
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <!-- <div class="col-lg-3">
                                          <div class="">
                                             <label class="">
                                               <label class="label" style="color: #2D4A89;">User :</label>
                                               <input type="hidden" name="exp_inv_filt_user_val" id="exp_inv_filt_user_val">
                                               <span id="exp_inv_filt_user"></span>
                                             </label>
                                          </div>
                                       </div> -->
                                       <div class="col-lg-3">
                                          <div class="">
                                             <label class="">
                                               <label class="label" style="color: #2D4A89;">Country :</label>
                                               <input type="hidden" name="exp_inv_filt_country_val" id="exp_inv_filt_country_val">
                                               <span id="exp_inv_filt_country"></span>
                                             </label>
                                          </div>
                                       </div>
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
                                         <input type="checkbox" id="exp_lead_name" class = "inv_export" name="inv_export[]" value="Lead Name"><label class="label" for="exp_lead_name">Lead Name</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_quo_no" class = "inv_export" name="inv_export[]" value="Invoice No"><label class="label" for="exp_quo_no">Invoice No</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_exporter" class = "inv_export" name="inv_export[]" value="Exporter"><label class="label" for="exp_exporter">Exporter</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_subject" class = "inv_export" name="inv_export[]" value="Subject"><label class="label" for="exp_subject">Subject</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_cre_date" class = "inv_export" name="inv_export[]" value="Created Date"><label class="label" for="exp_cre_date">Created Date</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_con_date" class = "inv_export" name="inv_export[]" value="Buyer Confirmation Date"><label class="label" for="exp_con_date">Buyer Confirmation Date</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_pi_stage" class = "inv_export" name="inv_export[]" value="PI Stage"><label class="label" for="exp_pi_stage">PI Stage</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_other_ref" class = "inv_export" name="inv_export[]" value="Other Reference"><label class="label" for="exp_other_ref">Other Reference</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_terms_of_payment_type" class = "inv_export" name="inv_export[]" value="Terms Of Payment Type"><label class="label" for="exp_terms_of_payment_type">Terms of Payment Type</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_pre_car" class = "inv_export" name="inv_export[]" value="Pre Carriage By"><label class="label" for="exp_pre_car">Pre Carriage By</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_place_of_rec" class = "inv_export" name="inv_export[]" value="Place Of Reciept By Pre Carrier"><label class="label" for="exp_place_of_rec">Place Of Reciept By Pre Carrier</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_vessel_flight_id" class = "inv_export" name="inv_export[]" value="Vessel Flight"><label class="label" for="exp_vessel_flight_id">Vessel Flight</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_pol" class = "inv_export" name="inv_export[]" value="Port Of Loading"><label class="label" for="exp_pol">Port Of Loading</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_pod" class = "inv_export" name="inv_export[]" value="Port Of Discharge"><label class="label" for="exp_pod">Port Of Discharge</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_fin_dest" class = "inv_export" name="inv_export[]" value="Final Destination"><label class="label" for="exp_fin_dest">Final Destination</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_curr" class = "inv_export" name="inv_export[]" value="Currency"><label class="label" for="exp_curr">Currency</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_rate" class = "inv_export" name="inv_export[]" value="Rate"><label class="label" for="exp_rate">Rate</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_bank_det" class = "inv_export" name="inv_export[]" value="Bank Info"><label class="label" for="exp_bank_det">Bank Info</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_sales_note" class = "inv_export" name="inv_export[]" value="Buyer Order No"><label class="label" for="exp_sales_note">Buyer Order No</label>
                                         <span></span>
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-3">
                                    <div class="bank m-checkbox-inline">
                                       <label class="m-checkbox">
                                         <input type="checkbox" id="exp_grand_tot" class = "inv_export" name="inv_export[]" value="Grand Total"><label class="label" for="exp_grand_tot">Grand Total</label>
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
   var title = $('title').text() + ' | ' + 'Invoice List';
   $(document).attr("title", title);

   $('#tog_filter').click(function(){
  $('.my_filter').slideToggle('slow'); 
});

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
function inv_exp_validation()
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
   function inv_export_items()
   {
      var quarter = $('#fquarter').val();
      var ypick = $('#ypick').val();
      var search = $('#searchChange').val();
      var dtrnge_from = $('#dtrange_from').val();
      var dtrnge_to = $('#dtrange_to').val();
      var dtrnge = dtrnge_from+' - '+dtrnge_to;
      var fbase = $('#fbase').val();
      // var pi_sales_user = $('#user_id').val();
      // var pi_sales_user_name = get_id_by_name_in_js(pi_sales_user,'users','name','user_id');
      var country_id = $('#country_id').val();
      var country_name = get_id_by_name_in_js(country_id,'ad_countries','name','id');

      $('#exp_inv_filt_year').empty().append(ypick);
      $('#exp_inv_filt_year_val').empty().val(ypick);

      $('#exp_inv_filt_quarter').empty().append(quarter);
      $('#exp_inv_filt_quarter_val').empty().val(quarter);

      $('#exp_inv_filt_search').empty().append(search);
      $('#exp_inv_filt_search_val').empty().val(search);

      $('#exp_inv_filt_dtrng').empty().append(dtrnge);
      $('#exp_inv_filt_dtrng_val').empty().val(dtrnge);

      // $('#exp_inv_filt_user').empty().append(pi_sales_user_name);
      // $('#exp_inv_filt_user_val').empty().val(pi_sales_user);

      $('#exp_inv_filt_country').empty().append(country_name);
      $('#exp_inv_filt_country_val').empty().val(country_id);

      $('#quarter_or_range').empty().val(fbase);

      $('#inv_export_model').modal('show');
   }
   function toggle(source) {
         
      checkboxes = document.getElementsByClassName('inv_export');
      for(var i=0, n=checkboxes.length;i<n;i++) {
         checkboxes[i].checked = source.checked;
      }
   }
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
var pagecount = '';
var current_pagination_index = '';
function paginate_page(page,l_id)
{  
   current_pagination_index = l_id;
   pagecount = page;
   submit_iv_filter('pagination');
}

var search_val = '';
function search_on_list(val)
{
   // if (val != '') {
    search_val = val;
    submit_iv_filter('search');
   // }
}

submit_iv_filter('filter');
function submit_iv_filter(diff) {
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
   // var pagecount = localStorage.getItem('curr_page');
   $('#iv_list_table_append_block_loader').show();
   $('#iv_list_table_append_block').hide();
   var country_id = $('#country_id').val();
   var fbase = $('#fbase').val();
   var goButtonboq = $('#goButtonboq').val();
   var fquarter = $('#fquarter').val();
   var ypick = $('#ypick').val();
   var goButton = $('#goButton').val();
   var searchChange = $('#searchChange').val();
   var dtrange_from = $('#dtrange_from').val();
   var dtrange_to = $('#dtrange_to').val();
   var perpage = $('#perpage').val();
   // var active_tab = "<?php // echo (isset($_GET['active_tab'])) ? '?active_tab='.$_GET['active_tab'] : ''; ?>";
  
   $.ajax({
      url:baseurl+'invoice/invoice_list_by_filter',
      type:'POST',
      data:{'country_id':country_id,'fbase':fbase,'goButtonboq':goButtonboq,'fquarter':fquarter,'ypick':ypick,'goButton':goButton,'searchChange':searchChange,'dtrange_from' : dtrange_from, 'dtrange_to' : dtrange_to, 'pagecount' : pagecount, 'search_val' : search_val, 'current_pagination_index' : current_pagination_index,'perpage':perpage},
      dataType: 'html',
      success:function(result){
         $('#iv_list_table_append_block').empty().append(result);
         $('#iv_list_table_append_block_loader').hide();
         $('#iv_list_table_append_block').show();
      }
   });
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
   else
   {
      $('.bod').show();
      $('.boq').hide();
      $('#fquarter').val('');
   }
}

var toDate = $('#ypick').datepicker({
    format: "yyyy",
    minViewMode: 2,
  autoclose : true
    }).on('hide',function(date){
  $("#ypick").val(date.target.value + "-" + (parseInt(date.target.value) + parseInt(1)));
});

</script>


   </body>

   <!-- end::Body -->
</html>