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
                                 <span class="m-nav__link-text">Target Report</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Recent Target Report</span>
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
                                       Target VS Achievement Report
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                <a href="javascript:;" onclick="target_report_export('target_report_export','target_report');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                  <span>
                                     <i class="la la-plus"></i>
                                     <span>Export</span>
                                  </span>
                                </a>
                                 &nbsp;&nbsp;
                                <?php if($_SESSION['admindata']['user_hasnt_product']==1){ ?>
                                  <select class="form-control custom-select" id="quote_quat_user_id_tar" name="quote_quat_user_id_tar" onchange="getQuoteQuatListTar();">
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
                                <?php }else{?>
                                  <input type="hidden" id="quote_quat_user_id_tar" name="quote_quat_user_id_tar" value="<?php echo $_SESSION['admindata']['user_id'];?>" onchange="getQuoteQuatListTar();">
                                <?php }?>
                                  &nbsp;&nbsp;
                                  <select class="form-control custom-select" id="quote_quat_indus_id_tar" name="quote_quat_indus_id_tar" onchange="getQuoteQuatListTar();">
                                    <option value="">All Industry</option>
                                       <?php foreach($industry_lists as $indlist){
                                          ?>
                                       <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>
                                       <?php } ?>
                                  </select>
                                  &nbsp;&nbsp;
                                <input type="text" class="form-control finance_year" id="quote_quat_fin_year_target" name="quote_quat_fin_year_target" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>">
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <!--begin: Datatable -->
                              <div id="quote_indus_list_table_target"></div>
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
function target_report_export(tableID, filename = '')
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
getQuoteQuatListTar();
function getQuoteQuatListTar()
{
   var ind_id = $('#quote_quat_indus_id_tar').val();
  var quid = $('#quote_quat_user_id_tar').val();
  var fy = $('#quote_quat_fin_year_target').val();

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
    type: "POST",
    url: baseurl+'dashboard/getQuoteQuatListTar',
    async: false,
    data: "quid="+quid+"&fy="+funnel_year+"&industry_id="+ind_id,
    dataType: "html",
    success: function(response)
    {
      $('#quote_indus_list_table_target').empty().append(response);
    }
  });
}
</script> 
   </body>

   <!-- end::Body -->
</html>