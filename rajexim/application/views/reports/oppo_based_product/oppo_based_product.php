<?php $this->load->view('common_header');  ?>
<style type="text/css">
.dataTables_wrapper .dataTable
{
margin:0px!important;
}
table.dataTable
{
margin-top:0px!important
}
.expand_width {
    padding: 3px;
    width: 125px;
  }
#usage_cost>thead>tr>th[style]{font-size: 16px!important;}
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
                                 <i class="m-nav__link-icon la la-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Report Management</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                          <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Opportunity Report</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Opportunity Based Product Report</span>
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
                                       <?php foreach($user_list as $ulist){
                                         if($ulist['role_id']!=1){?>
                                         <option value='<?php echo $ulist['user_id'];?>'><?php echo $ulist['name'];?></option>
                                       <?php }}?>
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
                                       <?php foreach($oppo_status_lists as $oppo_status){
                                          ?>
                                       <option selected value='<?php echo $oppo_status->oppo_status_id;?>'><?php echo $oppo_status->oppo_status;?></option>
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
                           <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2">
                              <a href="javascript:;" onclick="oppo_report_export('oppo_report_export','oppotunity_report');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                  <span>
                                     <i class="la la-plus"></i>
                                     <span>Export</span>
                                  </span>
                               </a>
                            </div>
                          </div>
                           <div class="m-portlet__body">
                              <!--begin: Datatable -->
                              <div id="dynamic_opportunity_based_on_industry_append"></div>
                           </div>
                           
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->

                  <!--Begin::Section-->
                 

                  <!--End::Section-->
               </div>
            </div>
         </div>

         <!-- end:: Body -->
         <?php $this->load->view('common_footer'); ?>
         <!-- <script src="<?php //echo base_url(); ?>assets/demo/demo12/custom/crud/datatables/basic/scrollable.js" type="text/javascript"></script> -->

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->

<script type="text/javascript">
  var title = $('title').text() + ' | ' + ' Lead Source Report';
$(document).attr("title", title);
var baseurl = '<?php echo base_url(); ?>';
$('.finance_year').datepicker({
       format: "yyyy",
       minViewMode: 2,
     autoclose : true
       }).on('hide',function(date){
     $(".finance_year").val(date.target.value + "-" + (parseInt(date.target.value) + parseInt(1)));
   });
function oppo_report_export(tableID, filename = ''){
    var date = new Date();

    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();

    newdate = (year + "-" + month + "-" + day + "-" + hours + "-" + minutes + "-" + seconds);

    var downloadurl;
    var dataFileType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+newdate+'.xls':'export_excel_data.xls';
    
    // Create download link element
    downloadurl = document.createElement("a");
    
    document.body.appendChild(downloadurl);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTMLData], {
            type: dataFileType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
    
        // Setting the file name
        downloadurl.download = filename;
        
        //triggering the function
        downloadurl.click();
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
</script> 
   </body>

   <!-- end::Body -->
</html>