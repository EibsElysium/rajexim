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
                              <a href="<?php echo base_url(); ?>supplierpo" class="m-nav__link">
                                 <span class="m-nav__link-text">Supplier PO</span>
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
                                      Supplier PO List
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

                                    <?php if($_SESSION['Supplier POAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url();?>supplierpo/supplierpo_add" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Supplier PO</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php }?>

                                    <!-- <li class="m-portlet__nav-item">
                                       <a href="#" onclick="spo_export_items();" class="m-portlet__nav-link btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                          Export
                                       </a>
                                    </li> -->

                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" onclick="spo_export_items();" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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



                              <form method="POST" action="<?php echo base_url();?>supplierpo">
                                 <div class="my_filter" style="display: none;"> 
                                    <div class="row">
                                       <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Vendor</label>
                                             <select class="form-control selectpicker" data-live-search="true" id="user_id" name="user_id" onchange="submit_spo_filter('filter');">
                                                <option value="">All Vendor</option>
                                                <?php
                                                   if(!empty($vendor_list))
                                                   {
                                                      foreach ($vendor_list as $l_source) 
                                                      {?>

                                                         <option value="<?php echo $l_source['vendor_id']; ?>" <?php if($f_l_user == $l_source['vendor_id']){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $l_source['vendor_name']; ?></option>

                                                      <?php } 
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
                                             <input id="goButtonboq" name="goButtonboq" value="Go" class="btn btn-primary inp" style="margin-top:26px;" type="button" onclick="submit_spo_filter('filter');">
                                          </div>
                                       </div>
                                       
                                       <div class="col-lg-2 bod" style="<?php echo $fbasesearch=='BonDate'?'':'display:none';?>">
                                          <div class="form-group m-form__group">
                                             <label>Filter By</label>
                                             <select class="custom-select form-control" id="searchChange" name="searchChange" onchange="if (this.value!='thisDate') {showFilterDate();submit_spo_filter('filter');} else {showFilterDate();}">
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
                                                         <input id="goButton" name="goButton" value="Go" class="btn btn-primary inp" type="button" onclick="submit_spo_filter('filter');">
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

                              <div class="row" id="spo_list_table_append_block" style="display: none;"> 
                                 
                              </div>
                              <div class="row" id="spo_list_table_append_block_loader"> 
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

<!--SPO complete-->
<div class="container">
    <div class="modal fade" id="spo_complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       
    </div>
   </div>

<div class="container">
   <div class="modal fade" id="spo_export_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Export Supplier PO Info</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?php echo base_url(); ?>Leads/export_spo_info" method="POST" onsubmit="return spo_exp_validation()">
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
                                     <input type="hidden" name="exp_spo_filt_year_val" id="exp_spo_filt_year_val">
                                     <input type="hidden" name="quarter_or_range" id="quarter_or_range">
                                     <span id="exp_spo_filt_year"></span>
                                   </label>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Quarter :</label>
                                     <input type="hidden" name="exp_spo_filt_quarter_val" id="exp_spo_filt_quarter_val">
                                     <span id="exp_spo_filt_quarter"></span>
                                   </label>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Search By :</label>
                                     <input type="hidden" name="exp_spo_filt_search_val" id="exp_spo_filt_search_val">
                                     <span id="exp_spo_filt_search"></span>
                                   </label>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Date Range Wise :</label>
                                     <input type="hidden" name="exp_spo_filt_dtrng_val" id="exp_spo_filt_dtrng_val">
                                     <span id="exp_spo_filt_dtrng"></span>
                                   </label>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Vendor :</label>
                                     <input type="hidden" name="exp_spo_filt_user_val" id="exp_spo_filt_user_val">
                                     <span id="exp_spo_filt_user"></span>
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
                               <input type="checkbox" id="exp_vendor" class = "spo_export" name="spo_export[]" value="Vendor"><label class="label" for="exp_vendor">Vendor</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_sup_date" class = "spo_export" name="spo_export[]" value="Supply Date"><label class="label" for="exp_sup_date">Supply Date</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_supply_end" class = "spo_export" name="spo_export[]" value="Supply End Date"><label class="label" for="exp_supply_end">Supply End Date</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_bo_no" class = "spo_export" name="spo_export[]" value="Buyer Order No"><label class="label" for="exp_bo_no">Buyer Order No</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                    </div>

                    <div class="row">
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_sup_no" class = "spo_export" name="spo_export[]" value="Supplier Order No"><label class="label" for="exp_sup_no">Supplier Order No</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_delivery_place" class = "spo_export" name="spo_export[]" value="Delivery Place"><label class="label" for="exp_delivery_place">Delivery Place</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_tot_amnt" class = "spo_export" name="spo_export[]" value="Total Amount"><label class="label" for="exp_tot_amnt">Total Amount</label>
                               <span></span>   
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_term_of_cond" class = "spo_export" name="spo_export[]" value="Terms Of Condition"><label class="label" for="exp_term_of_cond">Terms Of Condition</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                    </div>

                    <div class="row">
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_cancel_reason" class = "spo_export" name="spo_export[]" value="Cancel Reason"><label class="label" for="exp_cancel_reason">Cancel Reason</label>
                               <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_stage" class = "spo_export" name="spo_export[]" value="Stage"><label class="label" for="exp_stage">Stage</label>
                                  <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_comp_date" class = "spo_export" name="spo_export[]" value="Completed Date"><label class="label" for="exp_comp_date">Completed Date</label>
                                  <span></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-lg-3">
                          <div class="bank m-checkbox-inline">
                             <label class="m-checkbox">
                               <input type="checkbox" id="exp_lead_name" class = "spo_export" name="spo_export[]" value="Lead name"><label class="label" for="exp_lead_name">Lead name</label>
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
   var title = $('title').text() + ' | ' + 'Supplier PO List';
   $(document).attr("title", title);

   function spo_complete(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'supplierpo/spo_complete',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#spo_complete').empty().append(response);
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
function spo_exp_validation()
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
var pagecount = '';
var current_pagination_index = '';
function paginate_page(page,l_id)
{  
   current_pagination_index = l_id;
   pagecount = page;
   submit_spo_filter('pagination');
}

var search_val = '';
function search_on_list(val)
{
   // if (val != '') {
    search_val = val;
    submit_spo_filter('search');
   // }
}

submit_spo_filter('filter');
function submit_spo_filter(diff) {
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
   var perpage = $('#perpage').val();
   // var pagecount = localStorage.getItem('curr_page');
   $('#spo_list_table_append_block_loader').show();
   $('#spo_list_table_append_block').hide();
   
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
  
   $.ajax({
      url:baseurl+'supplierpo/spo_list_by_filter',
      type:'POST',
      data:{'user_id':user_id,'fbase':fbase,'goButtonboq':goButtonboq,'fquarter':fquarter,'ypick':ypick,'goButton':goButton,'searchChange':searchChange,'dtrange_from' : dtrange_from, 'dtrange_to' : dtrange_to, 'pagecount' : pagecount, 'search_val' : search_val, 'current_pagination_index' : current_pagination_index,'perpage':perpage},
      dataType: 'html',
      success:function(result){
         $('#spo_list_table_append_block').empty().append(result);
         $('#spo_list_table_append_block_loader').hide();
         $('#spo_list_table_append_block').show();
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
function completeSPO(val)
{ 
//var baseurl= $("#baseUrl").val();
$.ajax({
   type: "POST",
   url: baseurl+'supplierpo/completeSPO',
   async: false,
   data:"spoid="+val,
   success: function(response)
   {
      window.location.href = baseurl+'supplierpo';
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
function spo_export_items()
{
  var quarter = $('#fquarter').val();
  var ypick = $('#ypick').val();
  var search = $('#searchChange').val();
  var dtrnge_from = $('#dtrange_from').val();
  var dtrnge_to = $('#dtrange_to').val();
  var dtrnge = dtrnge_from+' - '+dtrnge_to;
  var fbase = $('#fbase').val();
  var pi_vendor = $('#user_id').val();
  var pi_vendor_name = get_id_by_name_in_js(pi_vendor,'vendor','vendor_name','vendor_id');
  // var country_id = $('#country_id').val();
  // var country_name = get_id_by_name_in_js(country_id,'ad_countries','name','id');

  $('#exp_spo_filt_year').empty().append(ypick);
  $('#exp_spo_filt_year_val').empty().val(ypick);

  $('#exp_spo_filt_quarter').empty().append(quarter);
  $('#exp_spo_filt_quarter_val').empty().val(quarter);

  $('#exp_spo_filt_search').empty().append(search);
  $('#exp_spo_filt_search_val').empty().val(search);

  $('#exp_spo_filt_dtrng').empty().append(dtrnge);
  $('#exp_spo_filt_dtrng_val').empty().val(dtrnge);

  $('#exp_spo_filt_user').empty().append(pi_vendor_name);
  $('#exp_spo_filt_user_val').empty().val(pi_vendor);

  // $('#exp_bo_filt_country').empty().append(country_name);
  // $('#exp_bo_filt_country_val').empty().val(country_id);

  $('#quarter_or_range').empty().val(fbase);

  $('#spo_export_model').modal('show');
}
function toggle(source) {
      
   checkboxes = document.getElementsByClassName('spo_export');
   for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
   }
}

   

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
