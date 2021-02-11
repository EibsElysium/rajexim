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
                                 <span class="m-nav__link-text">Proforma Report</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Proforma Based PI stage Report</span>
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
                                       Proforma Based PI stage Report
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                <div class="row">
                                  <div class="col-lg-2 expand_width">
                                    <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?> 
                                  <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="pi_sales_user" id="pi_sales_user" onchange="get_dynamic_pi_based_on_pi_stage();">
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
                           <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2">
                              <a href="javascript:;" onclick="pi_report_export('pi_report_export','PI_report');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                  <span>
                                     <i class="la la-plus"></i>
                                     <span>Export</span>
                                  </span>
                               </a>
                            </div>
                          </div>
                           <div class="m-portlet__body">
                              <!--begin: Datatable -->
                              <div id="dynamic_pi_based_on_pistage_append"></div>
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

function pi_report_export(tableID, filename = '')
{
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
    
    if(navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTMLData], {
            type: dataFileType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }
    else {
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
    
        // Setting the file name
        downloadurl.download = filename;
        
        //triggering the function
        downloadurl.click();
    }
}
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
</script> 
   </body>

   <!-- end::Body -->
</html>