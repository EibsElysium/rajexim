<?php
 $this->load->view('common_header'); ?>
   
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
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Settings</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Vendor</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>vendor" class="m-nav__link">
                                 <span class="m-nav__link-text">Vendor List</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Vendor View</span>
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
                                       Vendor View
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>vendor" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">

                              <h5 class="text-theme"><b>Vendor Info</b></h5><hr>
                              <div class="row">
                                 <div class="col-lg-6">
                                    <label class="col-lg-4">Category</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $vendor_details->vendor_category; ?></p>
                                 </div>
                                 <div class="col-lg-6">
                                    <label class="col-lg-4">Type</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $vendor_details->vendor_type; ?></p>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-lg-6">
                                    <label class="col-lg-4">Vendor Name</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $vendor_details->vendor_name; ?></p>
                                 </div>
                                 <div class="col-lg-6">
                                    <label class="col-lg-4">GST No</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $vendor_details->gst_no!=''?$vendor_details->gst_no:'-'; ?></p>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-lg-6">
                                    <label class="col-lg-4">Phone No</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $vendor_details->phone_no; ?></p>
                                 </div>
                                 <div class="col-lg-6">
                                    <label class="col-lg-4">Email Id</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $vendor_details->email_id; ?></p>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-lg-6">
                                    <label class="col-lg-4">Website</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $vendor_details->website!=''?$vendor_details->website:'-'; ?></p>
                                 </div>
                              </div>

                              <h5 class="text-theme"><b>Vendor Address</b></h5><hr>
                              <?php 
                              $get_ven_addr = common_select_values('*','vendor_address','vendor_id = "'.$vendor_details->vendor_id.'"','result');
                              foreach($get_ven_addr as $ven_addr){ ?>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <label class="col-lg-4">Address Type</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php $get_addr_type = common_select_values('*','address_type','address_type_id = "'.$ven_addr->address_type_id.'"','row'); echo $get_addr_type->address_type; ?></p>
                                    </div>
                                    <div class="col-lg-6">
                                       <label class="col-lg-4">Street</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php echo $ven_addr->street!=''?$ven_addr->street:'-'; ?></p>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-lg-6">
                                       <label class="col-lg-4">City</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php echo $ven_addr->city; ?></p>
                                    </div>
                                    <div class="col-lg-6">
                                       <label class="col-lg-4">State</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php echo $ven_addr->state; ?></p>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-lg-6">
                                       <label class="col-lg-4">Country</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php echo $ven_addr->country; ?></p>
                                    </div>
                                    <div class="col-lg-6">
                                       <label class="col-lg-4">Postal Code</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php echo $ven_addr->postal_code!=''?$ven_addr->postal_code:'-'; ?></p>
                                    </div>
                                 </div>
                                 <hr>
                              <?php } ?>
                              <h5 class="text-theme"><b>Vendor Contact Details</b></h5><hr>
                              <?php foreach ($vendor_contact_person_info as $key => $ven_cont_info) { ?>
                              <div class="row">
                                 <div class="col-lg-4">
                                    <label class="col-lg-4">Contact Person Name</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $ven_cont_info->contact_person!=''?$ven_cont_info->contact_person:'-'; ?></p>
                                 </div>
                                 <div class="col-lg-4">
                                    <label class="col-lg-4">Contact Person Email</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $ven_cont_info->contact_person_email!=''?$ven_cont_info->contact_person_email:'-'; ?></p>
                                 </div>
                                 <div class="col-lg-4">
                                    <label class="col-lg-4">Contact Person Phone</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $ven_cont_info->contact_person_phone!=''?$ven_cont_info->contact_person_phone:'-'; ?></p>
                                 </div>
                              </div>
                              <?php } ?>

                              <h5 class="text-theme"><b>Vendor Product</b></h5><hr>

                              <table class="table table-striped table-bordered  table-checkable" id="m_table_2">
                                 <thead>
                                    <tr>
                                       <th>Product Name</th>
                                       <th>Industry</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       if(!empty($vendor_product_details))
                                       {
                                          $i = 1;
                                          foreach ($vendor_product_details as $e_list) 
                                          { ?>
                                             <tr>
                                                <td>
                                                   <?php echo $e_list['product_name']; ?>   
                                                </td>
                                                <td>
                                                   <?php echo $e_list['industry_name']; ?>   
                                                </td>
                                             </tr>
                                             
                                       <?php   $i++; }
                                       } ?>
                                 </tbody>
                              </table>

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

<!--begin::Update Lead-->
<div class="container">
   <div class="modal fade" id="upload_document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
   </div>
</div>
<!--End::-->
   <script src="<?php echo base_url();?>assets/mailbox/js/bootstrap.js"></script>
      <script src="<?php echo base_url();?>assets/mailbox/js/mailbox.js"></script>
       <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/jquery.fancybox.pack.js" type="text/javascript"></script>
      <script type="text/javascript">
               $(document).ready(function() {
$('.fancybox').fancybox();
});
</script> 
      <script type="text/javascript">
          var title = $('title').text() + ' | ' + ' Lead View';
          $(document).attr("title", title);

         $('.m_table_2').dataTable();
         var baseurl = '<?php echo base_url(); ?>';

         function get_info_email_list(val)
         {
            var s_e_id = '<?php echo $lead_view->email_id; ?>';
            var select_val = $("#lead_emails option:selected").text();
            var lead_id = '<?php echo $lead_view->lead_id; ?>';
            $.ajax({
            type: "POST",
            url: baseurl+'Leads/lead_email_list',
            async: false,
            type: "POST",
            data: "e_id="+val+"&start=1&s_e_id="+s_e_id+"&lead_id="+lead_id,
            dataType: "html",
            success: function(response)
               {
                  $('#lead_email_list').empty().append(response);
                  
               }
            
            });
         }
   function show_previous_page(start)
   {
      var val = $('#lead_email').val();
      var s_e_id = '<?php echo $lead_view->email_id; ?>';
      $.ajax({
      type: "POST",
      url: baseurl+'Leads/inbox_email_list',
      async: false,
      type: "POST",
      data: "start="+start+"&e_id="+val+"&s_e_id="+s_e_id,
      dataType: "html",
      success: function(response)
         {
            $('#lead_email_list').empty().append(response);
            
         }
      });
   }
   // To show lead upload document
function upload_document(val)
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/lead_upload_document',
      data:{'lead_id':val},
      async: false,
      dataType: "html",
      success: function(result){

         $('#upload_document').empty().append(result);
         $("#upload_document").modal('show');
      }
   });
}
      </script>

   </body>

   <!-- end::Body -->
</html>