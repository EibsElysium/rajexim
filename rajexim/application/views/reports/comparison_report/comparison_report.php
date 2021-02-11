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

                                 <span class="m-nav__link-text">Comparison Report</span>

                              </a>

                           </li>

                           <li class="m-nav__separator">-</li>

                           <li class="m-nav__item">

                              <a href="" class="m-nav__link">

                                 <span class="m-nav__link-text">Comparison Based Product</span>

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

                                       Comparision Based on Product

                                    </h3>

                                 </div>

                              </div>

                              <div class="m-portlet__head-tools">

                                 

                              </div>

                           </div>

                           <div class="container">

                             <div class="row">

                                <div class="col-lg-2 expand_width">                    

                                 <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="comp_sales_user" id="comp_sales_user" onchange="get_dynamic_comparison_based_on_product();">

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

                                    </div>

                                <div class="col-lg-2 expand_width">

                                  <select class="form-control m_selectpicker" data-live-search = "true" id="comp_indus_id" name="comp_indus_id" onchange="get_dynamic_comparison_based_on_product();">

                                    <option value="">All Industry</option>

                                       <?php foreach($industry_lists as $indlist){

                                          ?>

                                       <option value='<?php echo $indlist->industry_id;?>'><?php echo $indlist->industry_name;?></option>

                                       <?php } ?>

                                  </select>

                                

                                </div>

                                <div class="col-lg-2 expand_width">

                                  <select class="form-control m_selectpicker" data-live-search = "true" id="comp_product" name="comp_product" onchange="get_dynamic_comparison_based_on_product();" multiple>

                                    <option value="">All Product</option>

                                       <?php foreach($get_all_product as $product){

                                          ?>

                                       <option selected value='<?php echo $product->product_id;?>'><?php echo $product->product_name;?></option>

                                       <?php } ?>

                                  </select>

                                

                                </div>

                                

                                <div class="col-lg-2 expand_width">

                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="comp_filt_type" id="comp_filt_type" onchange="comp_filt_type();">

                                         <option value="0">Year</option>

                                         <option value="1">Day</option>

                                    </select>

                                </div>

                              

                                  <div class="col-lg-2 expand_width comp_filt_year">

                                      <input type="text" class="form-control finance_year" id="comp_financial_year" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>" onchange="get_dynamic_comparison_based_on_product();">

                                  </div>

                                  <div class="col-lg-2 expand_width comp_filt_year">

                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="comp_quarter" id="comp_quarter" multiple onchange="get_dynamic_comparison_based_on_product();">

                                      

                                      <?php foreach ($quarter_list as $quarter) { 
                                        $start_q = explode('-', $quarter->start_month_date);
                                        $end_q = explode('-', $quarter->end_month_date);

                                        ?>

                                         <option <?php if($start_q[0] <= date('m') && $end_q[0] >= date('m')) { echo "selected"; } ?> value="<?php echo $quarter->quarter_id; ?>"><?php echo $quarter->quarter_label; ?></option>

                                      <?php } ?>

                                    </select>

                                  </div>

                              

                                  <div class="col-lg-2 expand_width" id="comp_filt_day" style="display: none;">

                                    <div class="form-group m-form__group">

                                        <select class="custom-select form-control" id="comp_searchChange" name="comp_searchChange" onchange="get_dynamic_comparison_based_on_product();">

                                           <option value="">Select</option>

                                           <option value="today">Today</option>

                                          <option value="thisweek">This Week</option>

                                          <option value="thismonth">This Month</option>

                                          <option value="thisyear">This Year</option>

                                          <option value="thisDate">Date</option>

                                        </select>

                                    </div>

                                  </div>

                                   <div class="col-lg-2 expand_width" id="comp_date_range" style="display: none;">

                                       <div class="form-group m-form__group">

                                          <!-- <input class="form-control m-input m-input--square" id="m_daterangepicker_3" name="dtrange" placeholder="Choose Date" value="" type="text"> -->

                                          <div class="m-input-icon pull-right" id='m_daterangepicker_3'>

                                             <input class="form-control m-input m-input--square comp_dtrange" id="m_daterangepicker_3" placeholder="Choose Date" value="" type="text" onblur ="get_dynamic_comparison_based_on_product();" onchange="get_dynamic_comparison_based_on_product();" onfocus="get_dynamic_comparison_based_on_product();" onkeyup="get_dynamic_comparison_based_on_product();">

                                          </div>

                                       </div>

                                    </div>   

                              </div>

                              <div class="row">

                                <div class="col-lg-2 expand_width">

                                       <div class="form-group m-form__group">

                                          <select id="comp_country" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" onchange="get_dynamic_comparison_based_on_product();">

                                            <option value="">All Country</option>

                                            <?php

                                                if(!empty($country_lists))

                                                {

                                                   foreach ($country_lists as  $country_list) { ?>

                                                      <option value="<?php echo $country_list->id; ?>"><?php echo $country_list->name; ?></option>

                                                   <?php } 

                                                }

                                             ?>

                                          </select>

                                       </div>

                                    </div>
                                    <div class="col-lg-2 expand_width">
                                      <a href="javascript:;" onclick="comparison_report_export('comparison_report_export','comparison_report');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                        <span>
                                           <i class="la la-plus"></i>
                                           <span>Export</span>
                                        </span>
                                      </a>
                                    </div>
                                    <!-- <div class="col-lg-2 expand_width">
                                      <a href="javascript:;" onclick="options_select_all('comp_product');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                        <span>
                                           <i class="la la-plus"></i>
                                           <span>Select All</span>
                                        </span>
                                      </a>
                                    </div>
                                    <div class="col-lg-2 expand_width">
                                      <a href="javascript:;" onclick="options_deselect_all('comp_product');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                        <span>
                                           <i class="la la-plus"></i>
                                           <span>DeSelect All</span>
                                        </span>
                                      </a>
                                    </div> -->
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
function options_select_all(id)
{
  $('select#'+id+' option').attr("selected","selected");
}
function options_deselect_all(id)
{
  $('select#'+id+' option').removeAttr("selected");
}
function comparison_report_export(tableID, filename = '')
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

// function get_products_by_industry(val)

// {

//    $.ajax({

      

//       url:baseurl+'Reports/get_products_based_industry',

//       type:'POST',

//       data:{'industry_id':val},

//       dataType: 'html',



//       success:function(result){

//          $('#comp_product').empty().append(result);

//          $('#comp_product').selectpicker('refresh');

//       }

//    });

// }

get_dynamic_comparison_based_on_product();

   function get_dynamic_comparison_based_on_product()

   {

      var comp_country = $('#comp_country').val();

      var funnel_year_raw = $('#comp_financial_year').val();

      var sale_user = $('#comp_sales_user').val();

      var industry_id = $('#comp_indus_id').val();

      var lead_status_id = $('#comp_status_id').val();

      var quarter = $('#comp_quarter').val();

      var day_filt = $('#comp_searchChange').val();

      var product = $('#comp_product').val();

      

      // if (product != '') {

      //   $('#comp_indus_id').val('');

      // } 

      if (industry_id != '') {

        $('#comp_product').val('');

      }

      var dtrange = '';

      if (day_filt == 'thisDate') {

        $('#comp_date_range').show();

        dtrange = $('.comp_dtrange').val();

      }

      else {

        $('#comp_date_range').hide();

        $('.comp_dtrange').val('');

      }

      var next_year = '';

      var funnel_year = '';

      if (funnel_year_raw.length == 4) {

         next_year = parseInt(funnel_year_raw) + 1;

         funnel_year = funnel_year_raw+'-'+next_year;

      }

      else {

         funnel_year = funnel_year_raw;

      }

      $.ajax({

         type:"POST",

         url:baseurl+'Reports/get_dynamic_comparison_based_on_product',

         data:{'year':funnel_year,'sale_user':sale_user,'quarter_year':quarter,'industry_id':industry_id,'product_id':product,'day_filt':day_filt,'dtrange':dtrange,'country':comp_country},

         cache: false,

         dataType: "html",

         success: function(result){

            

           $('#dynamic_opportunity_based_on_industry_append').empty().append(result);

         }

      });

      

   }

   function comp_filt_type()

  {

    var val = $('#comp_filt_type').val();

    if (val == 0) {

      $('.comp_filt_year').show();

      $('#comp_filt_day').hide();

      $('#comp_searchChange').val('');

    }

    else {

      $('#comp_filt_day').show();

      $('.comp_filt_year').hide();

      $('#comp_financial_year').val('');

      $('#comp_quarter').val('');

    }

  }

</script> 

   </body>



   <!-- end::Body -->

</html>