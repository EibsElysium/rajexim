<?php $this->load->view('common_header'); $date_format =common_date_format();?>

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="#" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>buyerorder" class="m-nav__link">
                                 <span class="m-nav__link-text">Buyer Order</span>
                              </a>
                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Feedback</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
               <?php if($this->session->flashdata('purchase_success')){?>
               <div class="alert alert-success alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('purchase_success'); ?>               
               </div>
               <?php } ?> 
               <?php if($this->session->flashdata('purchase_err')){?>
               <div class="alert alert-danger alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('purchase_err'); ?>                
               </div>
               <?php } ?> 

                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Buyer Order Feedback
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>buyerorder" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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
                              <fieldset>
                                 <legend class="text-info"><b>Buyer & Invoice Info</b></legend>
                                    <div class="row">
                                       <div class="col-lg-6">
                                         <label class="col-lg-4">PO Order No</label>
                                         <label class="col-lg-1">:</label>
                                         <p class="col-lg-7"><?php echo ($bo_details->buyer_order_invoice_no) ? $bo_details->buyer_order_invoice_no : '-';?></p>
                                       </div>
                                       <div class="col-lg-6">
                                         <label class="col-lg-4">PO Order Date</label>
                                         <label class="col-lg-1">:</label>
                                         <p class="col-lg-7"><?php echo ($bo_details->order_date) ? date('d-m-Y', strtotime($bo_details->order_date)) : '-';?></p>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                         <label class="col-lg-4">Buyer Name</label>
                                         <label class="col-lg-1">:</label>
                                         <p class="col-lg-7"><?php echo ($bo_details->lead_name) ? $bo_details->lead_name : '-';?></p>
                                       </div>
                                       <div class="col-lg-6">
                                         <label class="col-lg-4">Destination</label>
                                         <label class="col-lg-1">:</label>
                                         <p class="col-lg-7"><?php echo $bo_details->fdname;?> - <?php echo $bo_details->fdcity;?> - <?php echo $bo_details->fdcountry;?></p>
                                       </div>
                                    </div>
                                 </fieldset>

                                   <fieldset>
                                     <legend class="text-info"><b>Feedback Mail</b></legend>
                                     <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url(); ?>buyerorder/send_feedback"  enctype="multipart/form-data" onsubmit="return send_feedback_validation();">
                                        <div class="row">
                                            <div class="col-lg-11">
                                                <div class="form-group">
                                                  <label class="col-lg-1 control-label text-left" for="inputEmail">From</label>
                                                    <select name="lead_email_reply" id="lead_email_reply" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true">
                                                        <option value="">Choose</option>
                                                        <?php 
                                                        $users_emails = $this->session->userdata('user_own_emails');
                                                        if (count($users_emails) > 0) {
                                                            foreach ($users_emails as $key => $user_email) {
                                                                $users_email_info = get_users_mail_details_if_exist($user_email['user_emails']); 
                                                                if(count($users_email_info) > 0){
                                                                    echo "<option value=".$users_email_info->email_ID.">".$users_email_info->email_ID."</option>"; 
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <?php
                                                        if(!empty($email_lists))
                                                        {
                                                            foreach ($email_lists as $key => $email_list) { ?>
                                                                <option value="<?php echo $email_list->email_ID; ?>"><?php echo $email_list->email_ID; ?></option>     
                                                            <?php }
                                                        }
                                                        ?>
                                                    </select>
                                                    <p class="text-danger" id="lead_email_reply_err"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-11">
                                                <div class="form-group">
                                                    <label class="col-lg-1 control-label text-left" for="inputEmail">To</label>
                                                    <input type="text" id="reply_to_email" name="reply_to_email" class="form-control" value="<?php echo $to_mail; ?>" readonly>
                                                    <p class="text-danger" id="reply_to_email_err"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-11">
                                                <div class="form-group">
                                                    <label class="col-lg-1 control-label text-left" for="inputSubject">Subject</label>
                                                    <input type="text" id="reply_sub_email" name="reply_sub_email"  class="form-control" value="<?php echo $subject; ?>" readonly>
                                                    <p class="text-danger" id="reply_sub_email_err"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-11">
                                                <textarea name="reply_content_email" class="form-control snote" id="reply_content_email"><?php echo $content;?></textarea>
                                                <p class="text-danger" id="reply_content_email_err"></p>
                                            </div>
                                        </div>

                                        <div class="row pull-right">
                                            <button id="mail-send-btn" type="submit" name="btn_submit"  class="btn btn-primary">
                                                <i class="mailbox-psi-mail-send icon-lg icon-fw"></i> Send Feedback
                                            </button>
                                        </div>

                                    </form>
                                  </fieldset>     
                              
                           </div>
                          <!--end: Form Body -->
                          <div class="m-portlet__foot">
                             <!-- <div class="row align-items-center">
                                <div class="col-lg-12 m--align-right">
                                   <button type="submit" id="add_wl_btn" class="btn btn-primary">Create</button>
                                </div>
                             </div> -->
                          </div>
                          <input type="hidden" id='baseurl' name="baseurl" value="<?php echo base_url();?>">
                          <input type="hidden" id='error' name="error" value="0">
                          <input type="hidden" id='visible_type' name="visible_type" value="hide">
                       </form>
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->
               </div>
            </div>
         </div>

         <div class="container">
    <div class="modal fade" id="bo_complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       
    </div>
   </div>

         <div class="container">
    <div class="modal fade" id="bo_rem_complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       
    </div>
   </div>
         <!-- end:: Body -->

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->




<script type="text/javascript">
 var baseurl = '<?php echo base_url(); ?>';
 $('.snote').summernote();

 function send_feedback_validation()
{
   var mail_message = $('#reply_content_email').val();
   var from_email = $('#lead_email_reply').val();

   var err = 0;
   if (from_email == '') {
      $('#lead_email_reply_err').html('Choose From Mail!');
      err++;
   }
   else {
      $('#lead_email_reply_err').html('');
   } 
   if (mail_message == '') {
      $('#reply_content_email_err').html('Contect is Required!');
      err++;
   }
   else {
      $('#reply_content_email_err').html('');
   }

   if (err > 0) {
      return false;
   }
   else {
      return true;
   }
}
</script>

   </body>

   <!-- end::Body -->
</html>