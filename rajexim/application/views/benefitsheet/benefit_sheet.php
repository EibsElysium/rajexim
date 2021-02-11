<?php $this->load->view('common_header'); ?>
<style>
   span.lead_source_color {
       border: 1px solid #aaa;
       padding: 1px 11px;
       margin-left: 2%;
       border-radius: 50px;
   }
</style>

            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>benefitsheet" class="m-nav__link">
                                 <span class="m-nav__link-text">Benefit Sheet</span>
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
                                       Benefit Sheet
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div class="row">
                                 <div class="col-lg-4">
                                    <div class="form-group m-form__group">
                                       <label>Exporter</label>
                                       <select class="form-control" id="exporter_id" name="exporter_id">
                                          <option value=''>Select Exporter</option>
                                          <?php foreach($exporter_list as $elist){?>
                                             <option value="<?php echo $elist['exporter_id'];?>"><?php echo $elist['exporter_name'];?></option>
                                          <?php }?>
                                       </select>
                                    </div>
                                 </div>

                                 
                                 <div class="col-lg-4">
                                   <div class="form-group m-form__group">
                                      <label>Date Range</label>
                                      <div class="row">
                                         <div class="col-lg-4">
                                            <input type="text" id="alter_dtrange_from" onblur="change_from_date_format();" name="alter_dtrange_from" placeholder="From Date" class="form-control m_datepicker_1" value="<?php echo $dtrange_from; ?>" style="width: 130px;"> 
                                         </div>
                                         <div class="col-lg-1">To</div>
                                         <div class="col-lg-4">
                                            <input type="text" id="alter_dtrange_to" onblur="change_to_date_format();" name="alter_dtrange_to" placeholder="To Date" class="form-control m_datepicker_1" value="<?php echo $dtrange_to; ?>" style="width: 130px;">
                                         </div>
                                         <div class="col-lg-1">
                                            <div class="input-group-append">
                                                  <input onclick="getBOBenefitsheet();" value="Go" class="btn btn-primary inp" type="submit">
                                            </div>
                                         </div>
                                      </div>
                                      <input type="hidden" id="dtrange_from" name="dtrange_from" placeholder="From Date" class="form-control" value="">
                                      <input type="hidden" id="dtrange_to" name="dtrange_to" placeholder="To Date" class="form-control" value="">
                                   </div>
                                   <span id="bo_date_err" class="text-danger"></span>
                                </div>
                              </div>
                              <br><br>
                              <div class="row">
                                 <div id="sheettable"></div>
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

      <!-- end::Scroll Top -->
      <!--begin::Modal-->
      <!-- Create Lead Status-->
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Benefit Sheet';
$(document).attr("title", title); 

function getBOBenefitsheet()
{
   var dtrange_from = $('#dtrange_from').val();
   var dtrange_to = $('#dtrange_to').val();
   var eid = $('#exporter_id').val();
   if(dtrange_from!='' && dtrange_to!='')
   {
      $('#bo_date_err').html('');
      $.ajax({
         type: "POST",
         url: baseurl+'benefitsheet/getBOBenefitsheet',
         async: false,
         data: "dtrange_from="+dtrange_from+"&dtrange_to="+dtrange_to+"&eid="+eid,
         dataType: "html",
         success: function(response)
         {
         $('#sheettable').html(response);
         }
      });
   }
   else
   {
      $('#bo_date_err').html('Choose Date!');
   }
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


</script>
</body>
   <!-- end::Body -->
</html>