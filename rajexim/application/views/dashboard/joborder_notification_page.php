<?php $this->load->view('common_header'); ?>

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
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Notitfication</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Job Order Notitfication</span>
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
                                       Job Order Notification
                                    </h3>
                                 </div>
                              </div> 
                           </div>
                           <div class="m-portlet__body">
                            <div class="row">
                              <div class="col-lg-8 col-lg-offset-2">
                                <div class="row">
                                       <div class="col-lg-4 expand_width">
                                         
                                       </div>
                                       <div class="col-lg-4 expand_width">
                                        <?php if ($_SESSION['admindata']['user_hasnt_product'] == 1) { ?>
                                          <select class="m_selectpicker form-control" data-live-search = "true" id="joborder_noti_assign_person" name="joborder_noti_assign_person" onchange="get_joborder_noti_filt();">
                                              <option value="">All Users</option>
                                              <?php foreach($employee_list as $emplist){?>
                                                <option value="<?php echo $emplist['employee_id'];?>"><?php echo $emplist['display_name'];?></option>
                                              <?php }?>
                                          </select>      
                                        <?php } else { ?>
                                          <input type="hidden" id="joborder_noti_assign_person" name="joborder_noti_assign_person" value="<?php echo $_SESSION['admindata']['user_id'];?>">
                                        <?php } ?>
                                       </div>
                                       <div class="col-lg-4 expand_width">
                                          <select class="form-control m_selectpicker" data-live-search = "true" onchange="get_joborder_noti_filt();" id="joborder_noti_product">
                                             <option value="">All Products</option>
                                             <?php foreach ($get_all_product as $product) { ?>
                                             <option value="<?php echo $product->product_id ?>"><?php echo $product->product_name; ?></option>
                                             <?php } ?>
                                          </select>      
                                       </div>
                                    </div>
                                    <div class="mt_25px"></div>
                                    <div class="timeline timeline-3 dashboard_notification_body" id="joborder_noti_append_filt">
                                       <div class="timeline-items">
                                          <?php if (!empty($joborder_notifications)) { 
                                             foreach ($joborder_notifications as $joborder_notification) {
                                             ?>
                                          <div class="timeline-item">
                                             <div class="timeline-media-<?php echo (date('Y-m-d') > date('Y-m-d',strtotime($joborder_notification->job_order_end_date))) ? 'job' : 'lead'; ?>">
                                                <?php echo date('M',strtotime($joborder_notification->job_order_end_date)); ?><br/><?php echo date('d',strtotime($joborder_notification->job_order_end_date)); ?>
                                             </div>
                                             <div class="timeline-content">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                   <div class="mr-3">                        
                                                      <b><?php echo ucfirst($joborder_notification->product_name); ?></b> from <b><?php echo $joborder_notification->job_order_no; ?></b> given is <?php echo (date('Y-m-d') > date('Y-m-d',strtotime($joborder_notification->job_order_end_date))) ? 'over' : 'near'; ?> to due                 
                                                      <span class="text-muted ml-2">
                                                      <?php echo ucfirst($joborder_notification->vendor_name).'-'.ucfirst($joborder_notification->vendor_city); ?>
                                                      </span>                        
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <?php } } ?>
                                       </div>
                                    </div>
                              </div> 
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

<script>
  var baseurl = "<?php echo base_url(); ?>";
get_joborder_noti_filt();
function get_joborder_noti_filt()
{
   var assign_person = $('#joborder_noti_assign_person').val();
   var product = $('#joborder_noti_product').val();
   $.ajax({
    type: "POST",
    url: baseurl+'Dashboard/get_joborder_noti_filt',
    async: false,
    //data: "qpid="+qpid+"&quid="+quid+"&qqtr="+qqtr+"&fy="+fy,
    data: "assign_person="+assign_person+"&product="+product,
    dataType: "html",
    success: function(response)
    {
      $('#joborder_noti_append_filt').empty().append(response);
    }
  });  
}
</script>

</body>
   <!-- end::Body -->
</html>