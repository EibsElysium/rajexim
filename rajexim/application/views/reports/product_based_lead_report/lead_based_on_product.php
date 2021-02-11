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
.expand_width{
   padding-left: 0px;
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
                                 <span class="m-nav__link-text">Lead by Product</span>
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

                                    <div class="row">
                                 <?php  foreach ($lead_sources as $ls) { ?>
                                 &nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="lead_cor_active" style="color: <?php echo $ls->source_color; ?>;"></span> &nbsp;<b class="pa-top"><?php echo $ls->lead_source; ?></b> 
                                 <?php } ?>
                              </div>
                                 </ul>
                              </div>
                           </div>
                           <div id = "classic_view_daily_report">
                              <div class="container">
                                 <div class="row mt_25px">
                                    
                                    <div class="col-lg-2">
                                       <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>  
                                       <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="d_industry" id="d_industry" onchange="lead_source_daily_report();get_products_by_industry(this.value);">
                                          <option value="">All Industry</option>
                                          <?php foreach($industry_lists as $indlist){
                                             ?>
                                            <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                          <?php } ?>
                                       </select>
                                       <?php } else { ?>
                                       <input type="hidden" name="d_industry" id="d_industry" value="">
                                     <?php } ?>
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                       <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>
                                       <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="d_product" id="d_product" onchange="lead_source_daily_report();">
                                          <option value="">All Products</option>
                                          
                                       </select>
                                       <?php } ?>
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                       <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>  
                                       <select class="form-control m_selectpicker" data-live-search = "true" onchange="lead_source_daily_report();" id="d_lead_assign_person">
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
                                       <input type="hidden" name="d_lead_assign_person" id="d_lead_assign_person" value="<?php echo $_SESSION['admindata']['user_id']; ?>">
                                       <?php } ?>  
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                       <input type="text" id="justAnInputBox1" placeholder="All Lead Source" onchange="lead_source_daily_report();" autocomplete="off"/>
                                       <input type="hidden" name="lead_source_id" id="lead_source_id">
                                    </div>
                                    <div class="col-lg-2 expand_width">   
                                          <input type="text" class="form-control year_month" placeholder="Enter Year-Month" name="f_daily_year_month" id="f_daily_year_month"  onchange="lead_source_daily_report();" value="<?php echo date('Y-M'); ?>">
                                    </div>
                                    <div class="col-lg-2 expand_width">   
                                       <a href="javascript:;" onclick="ls_pro_daily_export('ls_pro_daily_export','ls_pro_daily');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                           <i class="la la-plus"></i>
                                           <span>Export</span>
                                          </span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="m-portlet__body">
                                 
                                 <!--begin: Datatable -->
                                 <div id="lead_source_daily_report"></div>
                              </div>
                           </div>
                           <div id = "graph_view_daily_report" style="display: none;">
                              <div class="container">
                                 <div class="row mt_25px">
                                    
                                    <div class="col-lg-2">
                                       <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?> 
                                       <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="gd_industry" id="gd_industry" onchange="graph_lead_source_daily_report();graph_get_products_by_industry(this.value);">
                                          <option value="">All Industry</option>
                                          <?php foreach($industry_lists as $indlist){
                                             ?>
                                            <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                          <?php } ?>
                                       </select>
                                       <?php } else { ?>
                                    <input type="hidden" name="gd_industry" id="gd_industry" value="">
                                  <?php } ?>
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                       <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?> 
                                       <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="gd_product" id="gd_product" onchange="graph_lead_source_daily_report();">
                                          <option value="">All Products</option>
                                          
                                       </select>
                                    <?php } ?>
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                       <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?> 
                                       <select class="form-control m_selectpicker" data-live-search = "true" onchange="graph_lead_source_daily_report();" id="gd_lead_assign_person">
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
                                       <input type="hidden" name="gd_lead_assign_person" id="gd_lead_assign_person" value="<?php echo $_SESSION['admindata']['user_id']; ?>">
                                     <?php } ?>
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                       <input type="text" id="g_justAnInputBox1" placeholder="All Lead Source" autocomplete="off"/>
                                       <input type="hidden" name="g_lead_source_id" id="g_lead_source_id">
                                    </div>
                                    <div class="col-lg-2 expand_width">   
                                          <input type="text" class="form-control year_month" placeholder="Enter Year-Month" name="g_f_daily_year_month" id="g_f_daily_year_month"  onchange="graph_lead_source_daily_report();" value="<?php echo date('Y-M'); ?>">
                                    </div>
                                 </div>
                              </div>
                              
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

                                    <div class="row">
                                       <?php  foreach ($lead_sources as $ls) { ?>
                                       &nbsp;&nbsp;&nbsp;&nbsp;
                                          <span class="lead_cor_active" style="color: <?php echo $ls->source_color; ?>;"></span> &nbsp;<b class="pa-top"><?php echo $ls->lead_source; ?></b> 
                                       <?php } ?>
                                       
                                    </div>
                                    
                                    
                                 </ul>
                              </div>
                              
                           </div>
                           <div id="classic_view_monthly_report">
                              <div class="container">
                                    <div class="row mt_25px">
                                       
                                       <div class="col-lg-2 ">
                                          <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?> 
                                          <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="m_industry" id="m_industry" onchange="lead_source_month_report();get_products_by_industry(this.value);">
                                             <option value="">All Industry</option>
                                             <?php foreach($industry_lists as $indlist){
                                                ?>
                                               <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                             <?php } ?>
                                          </select>
                                          <?php } else { ?>
                                          <input type="hidden" name="m_industry" id="m_industry" value="">
                                        <?php } ?>
                                       </div>
                                       <div class="col-lg-2 expand_width">
                                          <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?> 
                                          <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="m_product" id="m_product" onchange="lead_source_month_report();">
                                             <option value="">All Products</option>
                                             
                                          </select>
                                          <?php } ?>
                                       </div>
                                       <div class="col-lg-2 expand_width">
                                          <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>  
                                          <select class="form-control m_selectpicker" data-live-search = "true" onchange="lead_source_month_report();" id="m_lead_assign_person">
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
                                    <input type="hidden" name="m_lead_assign_person" id="m_lead_assign_person" value="<?php echo $_SESSION['admindata']['user_id']; ?>">
                                  <?php } ?>   
                                       </div>
                                       <div class="col-lg-2 expand_width">
                                          <input type="text" id="justAnInputBox" placeholder="All Lead Source" onchange="lead_source_month_report();" autocomplete="off"/>
                                          <input type="hidden" name="m_lead_source_id" id="m_lead_source_id">
                                       </div>
                                       <div class="col-lg-2 expand_width">   
                                             
                                          <input type="text" class="form-control finance_year" placeholder="Enter Year" name="f_month" id="f_month"  onchange="lead_source_month_report();" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>">
                                          
                                       </div>
                                       <div class="col-lg-2 expand_width">   
                                          <a href="javascript:;" onclick="ls_pro_monthly_export('ls_pro_monthly_export','ls_pro_monthly');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                             <span>
                                                <i class="la la-plus"></i>
                                                <span>Export</span>
                                             </span>
                                          </a>
                                       </div>
                                    </div>
                              </div>
                              <div class="m-portlet__body">
                                 <!-- <div class="row">
                                    <?php  foreach ($lead_sources as $ls) { ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                       <span class="lead_cor_active" style="color: <?php echo $ls->source_color; ?>;"></span> &nbsp;<b class="pa-top"><?php echo $ls->lead_source; ?></b> 
                                    <?php } ?>
                                 </div> -->
                                 <!--begin: Datatable -->
                                 <div id="lead_source_month_report"></div>
                              
                              </div>
                           </div>
                           <div id="graph_view_monthly_report" style="display: none;">
                              <div class="container">
                                 <div class="row mt_25px">
                                    
                                    <div class="col-lg-2">
                                       <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>  
                                       <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="gm_industry" id="gm_industry" onchange="graph_lead_source_monthly_report();graph_get_products_by_industry_monthly(this.value);">
                                          <option value="">All Industry</option>
                                          <?php foreach($industry_lists as $indlist){
                                             ?>
                                            <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                          <?php } ?>
                                       </select>
                                       <?php } else { ?>
                                    <input type="hidden" name="gm_industry" id="gm_industry" value="">
                                  <?php } ?>
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                       <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>  
                                       <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="gm_product" id="gm_product" onchange="graph_lead_source_monthly_report();">
                                          <option value="">All Products</option>
                                          
                                       </select>
                                       <?php } ?>
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                       <?php if($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>  
                                       <select class="form-control m_selectpicker" data-live-search = "true" onchange="graph_lead_source_monthly_report();" id="gm_lead_assign_person">
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
                                    <input type="hidden" name="gm_lead_assign_person" id="gm_lead_assign_person" value="<?php echo $_SESSION['admindata']['user_id']; ?>">
                                  <?php } ?>  
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                       <input type="text" id="gm_justAnInputBox1" placeholder="All Lead Source" autocomplete="off"/>
                                       <input type="hidden" name="gm_lead_source_id" id="gm_lead_source_id">
                                    </div>
                                    <div class="col-lg-2 expand_width">   
                                       <input type="text" class="form-control finance_year" placeholder="Enter Year" name="gm_year" id="gm_year"  onchange="graph_lead_source_monthly_report();" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>">
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="m-portlet__body">
                                 <div id="graph_lead_source_monthly_report"></div>
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



var comboTree3 = '';
get_lead_sublead_source();
function get_lead_sublead_source(){
   var base_url = '<?php echo base_url(); ?>';
   var val = '1';
   $.ajax({
      url:base_url+'Reports/get_lead_sublead_source',
      type:'POST',
      data:{'value':val},
      dataType: 'html',
      success:function(result){
         
      var SampleJSONData2 = JSON.parse(result);
//   jQuery(document).ready(function($) {
         
         comboTree3 = $('#justAnInputBox1').comboTree({
            source : SampleJSONData2,
            isMultiple: true,
            cascadeSelect: true,
            collapse: false
         });

         comboTree3.setSource(SampleJSONData2);
         comboTree3.onChange(function(){ 
            var lead_source_id = comboTree3.getSelectedIds(); 
            $('#lead_source_id').empty().val(lead_source_id);
            lead_source_daily_report();
         });
  // });
      }
   });
   
}
function ls_pro_daily_export(tableID, filename = '')
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
function ls_pro_monthly_export(tableID, filename = '')
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
var comboTree4 = '';
get_lead_sublead_source_month();
function get_lead_sublead_source_month(){
   var base_url = '<?php echo base_url(); ?>';
   var val = '1';
   $.ajax({
      url:base_url+'Reports/get_lead_sublead_source',
      type:'POST',
      data:{'value':val},
      dataType: 'html',
      success:function(result){
         
      var SampleJSONData = JSON.parse(result);
//   jQuery(document).ready(function($) {
         
         comboTree4 = $('#justAnInputBox').comboTree({
            source : SampleJSONData,
            isMultiple: true,
            cascadeSelect: true,
            collapse: false
         });

         comboTree4.setSource(SampleJSONData);
         comboTree4.onChange(function(){ 
            var lead_source_id = comboTree4.getSelectedIds(); 
            $('#m_lead_source_id').empty().val(lead_source_id);
            lead_source_month_report();
         });
  // });
      }
   });
   
}

var comboTree5 = '';
get_graph_lead_sublead_source_month();
function get_graph_lead_sublead_source_month(){
   var base_url = '<?php echo base_url(); ?>';
   var val = '1';
   $.ajax({
      url:base_url+'Reports/get_lead_sublead_source',
      type:'POST',
      data:{'value':val},
      dataType: 'html',
      success:function(result){
         
      var SampleJSONData5 = JSON.parse(result);
//   jQuery(document).ready(function($) {
         
         comboTree5 = $('#g_justAnInputBox1').comboTree({
            source : SampleJSONData5,
            isMultiple: true,
            cascadeSelect: true,
            collapse: false
         });

         comboTree5.setSource(SampleJSONData5);
         comboTree5.onChange(function(){ 
            var lead_source_id = comboTree5.getSelectedIds(); 
            $('#g_lead_source_id').empty().val(lead_source_id);
            graph_lead_source_daily_report();
         });
  // });
      }
   });
   
}
var comboTree6 = '';
get_month_graph_lead_sublead_source_month();
function get_month_graph_lead_sublead_source_month(){
   var base_url = '<?php echo base_url(); ?>';
   var val = '1';
   $.ajax({
      url:base_url+'Reports/get_lead_sublead_source',
      type:'POST',
      data:{'value':val},
      dataType: 'html',
      success:function(result){
         
      var SampleJSONData6 = JSON.parse(result);
//   jQuery(document).ready(function($) {
         
         comboTree6 = $('#gm_justAnInputBox1').comboTree({
            source : SampleJSONData6,
            isMultiple: true,
            cascadeSelect: true,
            collapse: false
         });

         comboTree6.setSource(SampleJSONData6);
         comboTree6.onChange(function(){ 
            var lead_source_id = comboTree6.getSelectedIds(); 
            $('#gm_lead_source_id').empty().val(lead_source_id);
            graph_lead_source_monthly_report();
         });
  // });
      }
   });
   
}
</script>
<script type="text/javascript">
  var title = $('title').text() + ' | ' + ' Lead Source Report';
$(document).attr("title", title);

var baseurl = '<?php echo base_url(); ?>';
  $('.year_month').datepicker({
        minViewMode: 1,
         todayHighlight: true,
        format: 'yyyy-M',
          autoclose: true
   });
    $('.year').datepicker({
        minViewMode: 2,
         todayHighlight: true,
        format: 'yyyy',
          autoclose: true
   });

function daily_table_chart_change()
{
   var val = $('#daily_table_chart_change_val').val();
   if (val == 0) {
      $('#classic_view_daily_report').hide();
      $('#graph_view_daily_report').show();
      $('#daily_table_chart_change_val').val('1');
      $('#change_ico_chart').hide();
      $('#change_ico_table').show();
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
   }
   else {
      $('#classic_view_monthly_report').show();
      $('#graph_view_monthly_report').hide();
      $('#monthly_table_chart_change_val').val('0'); 
      $('#month_change_ico_chart').show();
      $('#month_change_ico_table').hide(); 
   }   
}
graph_lead_source_daily_report();
function graph_lead_source_daily_report()
{
   var base_url = '<?php echo base_url(); ?>';
   var val = $('#g_f_daily_year_month').val();
   var assign_person = $('#gd_lead_assign_person').val();
   var industry = $('#gd_industry').val();
   var product = $('#gd_product').val();
   var lead_source = $('#g_lead_source_id').val();
   $.ajax({
      url:baseurl+'Reports/graph_get_daily_lead_report_based_on_source',
      type:'POST',
      data:{'month_year':val,'assign_person':assign_person,'industry':industry,'product':product, 'lead_source' : lead_source},
      dataType: 'html',

      success:function(result){
         console.log(result);
         var json_arr = JSON.parse(result);
         Highcharts.chart('graph_lead_source_daily_report', {
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
graph_lead_source_monthly_report();
function graph_lead_source_monthly_report()
{
   var fy = $('#gm_year').val();

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
   
   var assign_person = $('#gm_lead_assign_person').val();
   var industry = $('#gm_industry').val();
   var product = $('#gm_product').val();
   var lead_source = $('#gm_lead_source_id').val();
   $.ajax({
      url:baseurl+'Reports/graph_get_monthly_lead_report_based_on_source',
      type:'POST',
      data:{'year':funnel_year,'assign_person':assign_person,'industry':industry,'product':product, 'lead_source' : lead_source},
      dataType: 'html',

      success:function(result){
         console.log(result);
         var json_arr = JSON.parse(result);
         Highcharts.chart('graph_lead_source_monthly_report', {
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
lead_source_daily_report();
function  lead_source_daily_report() 
{
   var val = $('#f_daily_year_month').val();
   var assign_person = $('#d_lead_assign_person').val();
   var industry = $('#d_industry').val();
   var product = $('#d_product').val();
   var lead_source = $('#lead_source_id').val();
   $.ajax({
      
      url:baseurl+'Reports/get_daily_lead_report_based_on_source',
      type:'POST',
      data:{'month_year':val,'assign_person':assign_person,'industry':industry,'product':product, 'lead_source' : lead_source},
      dataType: 'html',

      success:function(result){
             
         $('#lead_source_daily_report').empty().append(result);
      }
   });
}


lead_source_month_report();
function lead_source_month_report() 
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
   //var val = $('#f_month').val();
   var assign_person = $('#m_lead_assign_person').val();
   var industry = $('#m_industry').val();
   var product = $('#m_product').val();
   var lead_source = $('#m_lead_source_id').val();
  
   $.ajax({
      
      url:baseurl+'Reports/get_monthly_lead_report_based_on_source',
      type:'POST',
      data:{'year':funnel_year,'assign_person':assign_person,'industry':industry,'product':product, 'lead_source' : lead_source},
      dataType: 'html',

      success:function(result){

         $('#lead_source_month_report').empty().append(result);
      }
   });
}

function get_products_by_industry(val)
{
   $.ajax({
      
      url:baseurl+'Reports/get_products_based_industry',
      type:'POST',
      data:{'industry_id':val},
      dataType: 'html',

      success:function(result){
         $('#d_product').empty().append(result);
         $('#d_product').selectpicker('refresh');
      }
   });
}
function graph_get_products_by_industry(val)
{
   $.ajax({
      
      url:baseurl+'Reports/get_products_based_industry',
      type:'POST',
      data:{'industry_id':val},
      dataType: 'html',

      success:function(result){
         $('#gd_product').empty().append(result);
         $('#gd_product').selectpicker('refresh');
      }
   });
}
function graph_get_products_by_industry_monthly(val)
{
   $.ajax({
      
      url:baseurl+'Reports/get_products_based_industry',
      type:'POST',
      data:{'industry_id':val},
      dataType: 'html',

      success:function(result){
         $('#gm_product').empty().append(result);
         $('#gm_product').selectpicker('refresh');
      }
   });
}
</script> 
   </body>

   <!-- end::Body -->
</html>