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
                                 <span class="m-nav__link-text">Lead Report</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">User Lead Report</span>
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
                                       Day Wise Report
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                   
                                    <li class="nav-item m-tabs__item">
                                       <div class="row">
                                          <div class="col-lg-4 expand_width">
                                             <a href="javascript:;" onclick="daily_lead_user_report_export('daily_lead_user_report_export','lead_by_user_daily');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                                <span>
                                                   <i class="la la-plus"></i>
                                                   <span>Export</span>
                                                </span>
                                             </a>
                                          </div>
                                          <div class="col-lg-4 expand_width">
                                             
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="daily_up_users" id="daily_up_users" onchange="user_lead_daily_report()" multiple>
                                                <option value="">All Users</option>
                                                <?php foreach($product_assigned_users as $user){
                                                   if ($user->user_id != 1) {
                                                   ?>
                                                  <option selected value='<?php echo $user->user_id;?>'><?php echo $user->name;?></option>
                                                <?php } } ?>
                                             </select>
                                          </div>
                                          <div class="col-lg-4 expand_width">
                                             <div class="form-group m-form__group">
                                                <input type="text" class="form-control year_month" placeholder="Enter Year-Month" name="f_daily_year_month" id="f_daily_year_month"  onchange="user_lead_daily_report();" value="<?php echo date('Y-M'); ?>">
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <!--begin: Datatable -->
                              <div id="user_lead_daily_report"></div>
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
                                       Month Wise Report
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                   
                                    <li class="nav-item m-tabs__item">
                                       <div class="row">
                                          <div class="col-lg-4 expand_width">
                                             
                                                <a href="javascript:;" onclick="monthly_lead_user_report_export('monthly_lead_user_report_export','lead_by_user_monthly');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                                   <span>
                                                      <i class="la la-plus"></i>
                                                      <span>Export</span>
                                                   </span>
                                                </a>
                                          
                                          </div>
                                          <div class="col-lg-4 expand_width">
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="monthly_up_users" id="monthly_up_users" onchange="user_lead_month_report()" multiple>
                                                <option value="">All Users</option>
                                                <?php foreach($product_assigned_users as $user){
                                                   if ($user->user_id != 1) {
                                                   ?>
                                                  <option selected value='<?php echo $user->user_id;?>'><?php echo $user->name;?></option>
                                                <?php } } ?>
                                             </select>
                                          </div>
                                          <div class="col-lg-4 expand_width">
                                             <div class="form-group m-form__group">
                                                <input type="text" class="form-control finance_year" placeholder="Enter Year" name="f_month" id="f_month"  onchange="user_lead_month_report();" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>">
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    
                                    
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <!--begin: Datatable -->
                              <div id="user_lead_month_report"></div>
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
    
user_lead_daily_report();
function  user_lead_daily_report() 
{
   var val = $('#f_daily_year_month').val();
   var user = $('#daily_up_users').val();
   $.ajax({     
      url:baseurl+'Reports/user_lead_daily_report',
      type:'POST',
      data:{'value':val,'users':user},
      dataType: 'html',

      success:function(result){
         
         $('#user_lead_daily_report').empty().append(result);
      }
   });
}
user_lead_month_report();
function  user_lead_month_report() 
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
   var user = $('#monthly_up_users').val();
   $.ajax({
      url:baseurl+'Reports/user_lead_month_report',
      type:'POST',
      data:{'value':funnel_year,'users':user},
      dataType: 'html',
      success:function(result){
         $('#user_lead_month_report').empty().append(result);
      }
   });
}
function daily_lead_user_report_export(tableID, filename = ''){
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
function monthly_lead_user_report_export(tableID, filename = ''){
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
</script> 
   </body>

   <!-- end::Body -->
</html>