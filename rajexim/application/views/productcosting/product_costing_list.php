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
                              <a href="<?php echo base_url(); ?>productcosting" class="m-nav__link">
                                 <span class="m-nav__link-text">Product Costing</span>
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
                                      Product Costing List
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
                                    <?php if($_SESSION['Product CostingAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>productcosting/product_costing_add" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Product Costing</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php }?>

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


                              <form method="POST" action="<?php echo base_url();?>productcosting">
                                 <div class="my_filter" style="display: none;"> 
                                    <div class="row">
                                       <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Country</label>
                                             <select class="form-control selectpicker" data-live-search="true" id="country_id" name="country_id" onchange="submit_product_costing_form('filter');">
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
                                             <label>Product</label>
                                             <select class="form-control selectpicker" data-live-search="true" id="product_id" name="product_id" onchange="submit_product_costing_form('filter');">
                                                <option value="">All</option>
                                                <?php
                                                   if(!empty($product_lists))
                                                   {
                                                      foreach ($product_lists as $l_source) 
                                                      { 
                                                         if($l_source['status'] == 0){ ?>

                                                         <option value="<?php echo $l_source['product_id']; ?>" <?php if($f_l_product == $l_source['product_id']){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $l_source['product_name']; ?></option>

                                                      <?php } } 
                                                   }
                                                ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-2">
                                          <div class="form-group m-form__group">
                                             <label>Users</label>
                                             <select class="form-control selectpicker" data-live-search="true" id="user_id" name="user_id" onchange="submit_product_costing_form('filter');">
                                                <option value="">All User</option>
                                                <?php
                                                   if(!empty($user_list))
                                                   {
                                                      foreach ($user_list as $l_source) 
                                                      {?>

                                                         <option value="<?php echo $l_source['user_id']; ?>" <?php if($f_l_user == $l_source['user_id']){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $l_source['name']; ?></option>

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
                                                <option value="" <?php if($fbasesearch=='') echo "selected";?>>Select</option>
                                                <option value="BonQuarter" <?php if($fbasesearch=='BonQuarter') echo "selected";?>>Quarter</option>
                                                <option value="BonDate" <?php if($fbasesearch=='BonDate') echo "selected";?>>Date</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-2 boq" style="<?php echo $fbasesearch=='BonQuarter'?'':'display:none';?>">
                                          <div class="form-group m-form__group">
                                             <label>Quarter</label>
                                             <select class="custom-select form-control" id="fquarter" name="fquarter">
                                                <option value="" <?php if($fquartersearch=='') echo "selected";?>>Select</option>
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
                                             <input id="goButtonboq" name="goButtonboq" value="Go" class="btn btn-primary inp" style="margin-top:26px;" type="button" onclick="submit_product_costing_form('filter');">
                                          </div>
                                       </div>
                                       
                                       <div class="col-lg-2 bod" style="<?php echo $fbasesearch=='BonDate'?'':'display:none';?>">
                                          <div class="form-group m-form__group">
                                             <label>Filter By</label>
                                             <select class="custom-select form-control" id="searchChange" name="searchChange" onchange="if (this.value!='thisDate') {submit_product_costing_form('filter');} else {showFilterDate();}">
                                                <option value="" <?php if($purchasesearch=='') echo "selected";?>>Select</option>
                                                <option value="today" <?php if($purchasesearch=='today') echo "selected";?>>Today</option>
                                                     <option value="thisweek" <?php if($purchasesearch=='thisweek') echo "selected";?>>This Week</option>
                                                     <option value="thismonth" <?php if($purchasesearch=='thismonth') echo "selected";?>>This Month</option>
                                                     <option value="thisyear" <?php if($purchasesearch=='thisyear') echo "selected";?>>This Year</option>
                                                      <option value="thisDate" <?php if($purchasesearch=='thisDate') echo "selected";?>>Date</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
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
                                                         <input id="goButton" name="goButton" value="Go" class="btn btn-primary inp" type="button" onclick="submit_product_costing_form('filter');">
                                                   </div>
                                                </div>
                                             </div>
                                             <input type="hidden" id="dtrange_from" name="dtrange_from" placeholder="From Date" class="form-control" value="">
                                             <input type="hidden" id="dtrange_to" name="dtrange_to" placeholder="To Date" class="form-control" value="">
                                          </div>
                                       </div>
                                       <!-- <div class="col-lg-2 drp" style="<?php echo $purchasesearch=='thisDate'?'display:inline-block':'display:none';?>">
                                          <div class="form-group m-form__group">
                                             <label>Date</label>
                                             <div class="m-input-icon pull-right" id='m_daterangepicker_3'>
                                                <input class="form-control m-input m-input--square" id="m_daterangepicker_3" name="dtrange" placeholder="Choose Date" value="<?php echo $drnge;?>" type="text">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-2 drp" style="<?php echo $purchasesearch=='thisDate'?'display:inline-block':'display:none';?>">
                                          <div class="form-group m-form__group">
                                             <label></label>
                                             <input id="goButton" name="goButton" value="Go" class="btn btn-primary inp" style="margin-top:26px;" type="submit">
                                          </div>
                                       </div> -->
                                    </div>
                                 </div>
                              </form>

                              <?php //$this->load->view('productcosting/product_costing_list_table'); ?>
                              <div id="product_costing_table_append_block" style="display: none;"> 
                                 
                              </div>
                              <div class="row" id="product_costing_table_append_block_loader"> 
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

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->


<script type="text/javascript">
   var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Product Costing List';
   $(document).attr("title", title);


var pagecount = '';
var current_pagination_index = '';
function paginate_page(page,l_id)
{  
   current_pagination_index = l_id;
   pagecount = page;
   submit_product_costing_form('pagination');
}

var search_val = '';
function search_on_list(val)
{
   //if (val != '') {
    search_val = val;
    submit_product_costing_form('search');
   //}
}
submit_product_costing_form('filter');
function submit_product_costing_form(diff) {
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
   $('#product_costing_table_append_block_loader').show();
   $('#product_costing_table_append_block').hide();
   var perpage = $('#perpage').val();
   var country_id = $('#country_id').val();
   var product_id = $('#product_id').val();
   var user_id = $('#user_id').val();
   var fbase = $('#fbase').val();
   var fquarter = $('#fquarter').val();
   var ypick = $('#ypick').val();
   var searchChange = $('#searchChange').val();
   var dtrange_from = $('#dtrange_from').val();
   var dtrange_to = $('#dtrange_to').val();
  
   $.ajax({
      url:baseurl+'productcosting/product_costing_result_list',
      type:'POST',
      data:{'country_id':country_id,'product_id':product_id,'user_id':user_id,'fbase':fbase,'fquarter':fquarter,'ypick':ypick,'searchChange':searchChange,'dtrange_from' : dtrange_from, 'dtrange_to' : dtrange_to, 'pagecount' : pagecount, 'search_val' : search_val, 'current_pagination_index' : current_pagination_index, 'perpage' : perpage},
      dataType: 'html',
      success:function(result){
         $('#product_costing_table_append_block').empty().append(result);
         $('#product_costing_table_append_block_loader').hide();
         $('#product_costing_table_append_block').show();
      }
   });
}


   $('#tog_filter').click(function(){
  $('.my_filter').slideToggle('slow'); 
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