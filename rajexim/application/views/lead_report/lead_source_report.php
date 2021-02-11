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
                                 <span class="m-nav__link-text">Lead Report</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Lead Source Report</span>
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
                                       Day Wise Report &nbsp; <span onclick="daily_table_chart_change();"><i id="change_ico_chart" class="la la-bar-chart" style="cursor: pointer;"></i><i style="display: none;cursor: pointer;" id="change_ico_table" class="la la-table"></i></span>
                                       <input type="hidden" id="daily_table_chart_change_val" value="0">
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                       <div class="form-group m-form__group">
                                          <a href="javascript:;" onclick="daily_ls_report_export('daily_ls_report_export','lead_source_daily');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                             <span>
                                                <i class="la la-plus"></i>
                                                <span>Export</span>
                                             </span>
                                          </a>
                                       </div>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                       <div class="form-group m-form__group">
                                          <input type="text" class="form-control year_month" placeholder="Enter Year-Month" name="f_daily_year_month" id="f_daily_year_month"  onchange="chk_clas_graph_fn();" value="<?php echo date('Y-M'); ?>">
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div id="classic_view_daily_report">
                              <div class="m-portlet__body">
                                 <!--begin: Datatable -->
                                 <div id="lead_source_daily_report"></div>
                              </div>
                           </div>
                           <div id="graph_view_daily_report">
                              <div class="m-portlet__body">
                                 <!--begin: Datatable -->
                                 <div id="graph_lead_source_daily_report"></div>
                              </div>
                           </div>
                           
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->

                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Month Wise Report  &nbsp; <span onclick="monthly_table_chart_change();"><i id="month_change_ico_chart" class="la la-bar-chart" style="cursor: pointer;"></i><i style="display: none;cursor: pointer;" id="month_change_ico_table" class="la la-table"></i></span>
                                       <input type="hidden" id="monthly_table_chart_change_val" value="0">
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                       <div class="form-group m-form__group">
                                          <a href="javascript:;" onclick="monthly_ls_report_export('monthly_ls_report_export','lead_source_monthly');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                             <span>
                                                <i class="la la-plus"></i>
                                                <span>Export</span>
                                             </span>
                                          </a>
                                       </div>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                       <div class="form-group m-form__group">
                                          <input type="text" class="form-control finance_year" placeholder="Enter Year" name="f_month" id="f_month"  onchange="yr_chk_clas_graph_fn();" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>">
                                       </div>
                                    </li>
                                    
                                    
                                 </ul>
                              </div>
                           </div>
                           <div id="classic_view_monthly_report">
                              <div class="m-portlet__body">
                                 <!--begin: Datatable -->
                                 <div id="lead_source_month_report"></div>
                              </div>
                           </div>
                           <div id="graph_view_monthly_report"> 
                              <div class="m-portlet__body">
                                 <!--begin: Datatable -->
                                 <div id="graph_lead_source_month_report"></div>
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
         <?php $this->load->view('common_footer'); ?>
         <!-- <script src="<?php //echo base_url(); ?>assets/demo/demo12/custom/crud/datatables/basic/scrollable.js" type="text/javascript"></script> -->

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->

<script type="text/javascript">
   $('.finance_year').datepicker({
       format: "yyyy",
       minViewMode: 2,
       autoclose : true
       }).on('hide',function(date){
     $(".finance_year").val(date.target.value + "-" + (parseInt(date.target.value) + parseInt(1)));
   });
  var title = $('title').text() + ' | ' + ' Lead Source Report';
$(document).attr("title", title);
var baseurl = '<?php echo base_url(); ?>';
  $('.year_month').datepicker({
        minViewMode: 1,
         todayHighlight: true,
        format: 'yyyy-M',
          autoclose: true
   });
function daily_ls_report_export(tableID, filename = ''){
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
function monthly_ls_report_export(tableID, filename = ''){
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
function daily_table_chart_change()
{
   var val = $('#daily_table_chart_change_val').val();
   if (val == 0) {
      $('#classic_view_daily_report').hide();
      $('#graph_view_daily_report').show();
      $('#daily_table_chart_change_val').val('1');
      $('#change_ico_chart').hide();
      $('#change_ico_table').show();
      graph_lead_source_daily_report();
   }
   else {
      $('#classic_view_daily_report').show();
      $('#graph_view_daily_report').hide();
      $('#daily_table_chart_change_val').val('0'); 
      $('#change_ico_chart').show();
      $('#change_ico_table').hide(); 
   }


}
function monthly_table_chart_change()
{
   var val = $('#monthly_table_chart_change_val').val();
   if (val == 0) {
      $('#classic_view_monthly_report').hide();
      $('#graph_view_monthly_report').show();
      $('#monthly_table_chart_change_val').val('1');
      $('#month_change_ico_chart').hide();
      $('#month_change_ico_table').show();
      graph_lead_source_month_report();
   }
   else {
      $('#classic_view_monthly_report').show();
      $('#graph_view_monthly_report').hide();
      $('#monthly_table_chart_change_val').val('0'); 
      $('#month_change_ico_chart').show();
      $('#month_change_ico_table').hide(); 
   }   
}
function chk_clas_graph_fn()
{
   var flag = $('#daily_table_chart_change_val').val();
   if (flag == 0) {
      lead_source_daily_report();      
   }
   else {
      graph_lead_source_daily_report();
   }
}
function yr_chk_clas_graph_fn()
{
   var flag = $('#monthly_table_chart_change_val').val();
   if (flag == 0) {
      lead_source_month_report();      
   }
   else {
      graph_lead_source_month_report();
   }  
}
function graph_lead_source_month_report()
{
   var fy = $('#f_month').val();

   var next_year = '';
   var funnel_year = '';
   if (fy.length == 4) {
      next_year = parseInt(fy) + 1;
      funnel_year = fy+'-'+next_year;
   }
   else {
      funnel_year = fy;
   }
   var base_url = '<?php echo base_url(); ?>';
   
   $.ajax({
      url:baseurl+'Reports/graph_lead_source_month_report',
      type:'POST',
      data:{'year':funnel_year},
      dataType: 'html',

      success:function(result){
         console.log(result);
         var json_arr = JSON.parse(result);
         Highcharts.chart('graph_lead_source_month_report', {
           chart: {
             type: 'spline'
           },
           title: {
             text: 'Product Count'
           },
           subtitle: {
             text: ''
           },
           xAxis: {
             categories: ['April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'Febuary', 'March']
           },
           yAxis: {
             title: {
               text: ''
             },
             labels: {
               formatter: function () {
                 return this.value ;
               }
             }
           },
           tooltip: {
             pointFormat: 'Count: <b>{point.y:.1f}</b>'
           },
           
           plotOptions: {
             spline: {
               marker: {
                 radius: 4,
                 lineColor: '#666666',
                 lineWidth: 1
               }
             }
           }, 
           
           series: json_arr
         });             
         
      }
   });
}
function graph_lead_source_daily_report()
{
   var val = $('#f_daily_year_month').val();
      $.ajax({
      url:baseurl+'Reports/graph_lead_source_daily_report',
      type:'POST',
      data:{'month_year':val},
      dataType: 'html',

      success:function(result){
         
         var json_arr = JSON.parse(result);
         Highcharts.chart('graph_lead_source_daily_report', {
           chart: {
             type: 'spline'
           },
           title: {
             text: 'Lead source Count'
           },
           subtitle: {
             text: ''
           },
           xAxis: {
             categories: ['Day 01', 'Day 02', 'Day 03', 'Day 04', 'Day 05', 'Day 06', 'Day 07', 'Day 08', 'Day 09', 'Day 10', 'Day 11', 'Day 12', 'Day 13', 'Day 14', 'Day 15', 'Day 16', 'Day 17', 'Day 18', 'Day 19', 'Day 20', 'Day 21', 'Day 22', 'Day 23', 'Day 24', 'Day 25', 'Day 26', 'Day 27', 'Day 28', 'Day 29', 'Day 30', 'Day 31']
           },
           yAxis: {
             title: {
               text: ''
             },
             labels: {
               formatter: function () {
                 return this.value ;
               }
             }
           },
           tooltip: {
             pointFormat: 'Count: <b>{point.y:.1f}</b>'
           },
           
           plotOptions: {
             spline: {
               marker: {
                 radius: 4,
                 lineColor: '#666666',
                 lineWidth: 1
               }
             }
           }, 
           
           series: json_arr
         });             
         
      }
   });  
}

lead_source_daily_report();
function  lead_source_daily_report() 
{

   var val = $('#f_daily_year_month').val();
   $.ajax({
      
      url:baseurl+'Reports/lead_source_daily_report',
      type:'POST',
      data:{'value':val},
      dataType: 'html',

      success:function(result){
         $('#lead_source_daily_report').empty().append(result);
      }
   });
}
lead_source_month_report();
function  lead_source_month_report() 
{
   var fy = $('#f_month').val();
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
      url:baseurl+'Reports/lead_source_month_report',
      type:'POST',
      data:{'value':funnel_year},
      dataType: 'html',
      success:function(result){
         $('#lead_source_month_report').empty().append(result);
      }
   });
}

</script> 
   </body>

   <!-- end::Body -->
</html>