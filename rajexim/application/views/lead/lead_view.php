

<?php
 $this->load->view('common_header'); 
$date_format =common_date_format();  ?>
<link href="<?php echo base_url();?>assets/mailbox/css/bootstrap.css" rel="stylesheet">
       <link href="<?php echo base_url();?>assets/mailbox/css/mailbox.css" rel="stylesheet">
       <!-- MailBox Premium Icon -->
       <link href="<?php echo base_url();?>assets/mailbox/css/mailbox/mailbox-icons.css" rel="stylesheet">
       <!--mailbox [ DEMONSTRATION ]-->
       <link href="<?php echo base_url();?>assets/mailbox/css/mailbox/mailbox.css" rel="stylesheet">
       <!--Magic Checkbox [ OPTIONAL ]-->
       <link href="<?php echo base_url();?>assets/mailbox/css/mailbox/magic-check.css" rel="stylesheet">
       <!--Summernote [ OPTIONAL ]-->
       <link href="<?php echo base_url();?>assets/mailbox/js/summernote/summernote.css" rel="stylesheet">
       <link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/jquery.fancybox.css" rel="stylesheet">
       <link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-preview.min.css" rel="stylesheet" type="text/css" />
       <style type="text/css">

            .no-js #loader { display: none;  }
            .js #loader { display: block; position: absolute; left: 100px; top: 0; }
            .se-pre-con {
               position: fixed;
               left: 0px;
               top: 0px;
               width: 100%;
               height: 100%;
               z-index: 9999;
               background: url("http://smallenvelop.com/wp-content/uploads/2014/08/Preloader_2.gif") center no-repeat #fff;
            }
            .fancybox img { 
               border: 1px solid #8c8c8c;padding: 2px; 
            }
            #log_details_box {
                display: inline-block;
                width: 180px;
                white-space: nowrap;
                overflow: hidden !important;
                text-overflow: ellipsis;
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
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Lead Management</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Lead View</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
                  <?php if($this->session->flashdata('l_view_success')) { ?>
                  <div class="alert alert-success alert-dismissible" role="alert" id="alertaddmessage">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     <?php echo $this->session->flashdata('l_view_success'); ?>
                  </div>
                  <?php } ?>
                  <?php if($this->session->flashdata('mail_success')){?>
                       <div class="alert alert-success alert-dismissible" role="alert" id="alertaddmessage">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     <?php echo $this->session->flashdata('mail_success'); ?>
                  </div>
                  <?php } ?>
                  <?php if($this->session->flashdata('mail_err')){?>
                       <div class="alert alert-danger alert-dismissible" role="alert" id="alertaddmessage">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     <?php echo $this->session->flashdata('mail_err'); ?>
                  </div>
                  <?php } ?>
                  <?php if($this->session->flashdata('mail_reply_sent')){ ?>
                       <div class="alert alert-danger alert-dismissible" role="alert" id="alertaddmessage">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     <?php echo $this->session->flashdata('mail_reply_sent'); ?>
                  </div>
                  <?php } ?>
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
                                       Lead View of&nbsp;<span class="text-theme"><?php echo ucfirst($contact_book_info->lead_name); ?></span><?php if($contact_book_info->company_name != '') { ?>&nbsp;-&nbsp;<span class="text-theme"><?php echo ($contact_book_info->company_name) ? $contact_book_info->company_name : '-'; ?></span><?php } ?><?php if($contact_book_info->lead_code != '') { ?>&nbsp;-&nbsp;<span class="text-theme"><?php echo ($lead_view->lead_code) ? $lead_view->lead_code : '-'; ?></span><?php } ?>
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>Leads" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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
                              <div class="row">
                                 <div class="col-lg-12">

                                    <ul class="nav nav-pills nav-pills--theme" role="tablist">
                                       <li class="nav-item">
                                          <a class="nav-link <?php if(isset($_SESSION['active_panel']) && $_SESSION['active_panel'] == 'lead_info'){ echo "active"; }elseif(!isset($_SESSION['active_panel'])) { echo "active"; } ?>"  data-toggle="tab" href="#lead_info" onclick="lead_info();">Lead Info</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link <?php if(isset($_SESSION['active_panel'])){ echo ($_SESSION['active_panel'] == "email") ? 'active' : ''; } ?>" data-toggle="tab" href="#email">Emails</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#active_leads">Active Enquiries</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link <?php if(isset($_SESSION['active_panel'])){ echo ($_SESSION['active_panel'] == "lead_documents") ? 'active' : ''; } ?>" data-toggle="tab" href="#lead_documents">Documents</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#lead_product_costing">Product Costing</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#lead_quote">Quote</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#pro_invoice">Proforma Invoice</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#lead_buyer_order">Buyer Order</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#history_log">History Log</a>
                                       </li>
                                       <?php if($contact_book_info->whatsapp_no != ''){ ?>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#whatsapp_info">Whatsapp Info</a>
                                       </li>
                                       <?php } ?>
                                      
                                    </ul>
                                    <div class="tab-content">
                                       <div class="tab-pane <?php if(isset($_SESSION['active_panel']) && $_SESSION['active_panel'] == 'lead_info'){ echo "active"; } elseif(!isset($_SESSION['active_panel'])) { echo "active"; } ?>" id="lead_info" role="tabpanel">
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5 class="text-theme">Lead Info <a href="<?php echo base_url(); ?>Leads/lead_info_export_pdf/<?php echo $lead_view->lead_id; ?>" style="cursor: pointer;"><i class="fa fa-download"></i></a> </h5><hr>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Lead ID</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($lead_view->lead_code) ? $lead_view->lead_code : '-'; ?></p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Lead Name</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->lead_name) ? $contact_book_info->lead_name : '-'; ?></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Company Name</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->company_name) ? $contact_book_info->company_name : '-'; ?></p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Country</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->country_name) ? $contact_book_info->country_name : '-'; ?></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Designation</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->designation) ? $contact_book_info->designation : '-'; ?></p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Website</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->website) ? $contact_book_info->website : '-'; ?></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Address</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->address) ? $contact_book_info->address : '-'; ?></p>
                                                   </div>
                                                </div>  

                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5 class="text-theme">Lead Contact Info</h5><hr>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Primary Email ID</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->email_id) ? $contact_book_info->email_id : '-'; ?></p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Alternate Email ID</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->alternative_email_id) ? $contact_book_info->alternative_email_id : '-'; ?></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Skype ID</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->skype_id) ? $contact_book_info->skype_id : '-'; ?></p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Contact No</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->contact_no) ? $contact_book_info->contact_no : '-'; ?></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Whatsapp No</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->whatsapp_no) ? $contact_book_info->whatsapp_no : '-'; ?></p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Office Contact No</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($contact_book_info->office_phone_no) ? $contact_book_info->office_phone_no : '-'; ?></p>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5 class="text-theme">Lead Source Info</h5><hr>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Lead Source</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($lead_view->sub_lead_source_name) ? $lead_view->lead_source_name.' | '.$lead_view->sub_lead_source_name : '-'; ?></p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Priority</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($lead_view->l_type) ? $lead_view->l_type : '-'; ?></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Lead Status</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($lead_view->lead_status_name) ? $lead_view->lead_status_name : '-'; ?></p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Assigned To</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($lead_view->lead_assigned_name) ? $lead_view->lead_assigned_name : '-'; ?></p>
                                                   </div>
                                                </div>
                                                      

                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5 class="text-theme">Interested Product Info</h5><hr>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Product</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($lead_view->product_name) ? $lead_view->product_name : '-'; ?></p>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <label class="col-lg-4">Industry</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($lead_view->industry_name) ? $lead_view->industry_name : '-'; ?></p>
                                                   </div>
                                                </div>
                                                      

                                             </div>
                                          </div>

                                          <div class="row">
                                          
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <label class="col-lg-4">Message</label>
                                                      <label class="col-lg-1">:</label>
                                                      <p class="col-lg-7"><?php echo ($lead_view->message) ? $lead_view->message : '-'; ?></p>
                                                   </div>
                                                   
                                                </div>
                                                      

                                             </div>
                                          </div>


                                          <?php if (!empty($get_all_mail_replies)) { 
                                             $get_gen_sett_info = smtp_details();
                                             // print_r($get_gen_sett_info);
                                             $lead_replies_max = $get_gen_sett_info->lead_replies_max;

                                             ?>
                                          <div>
                                             <span style="position:relative;">
                                             <button id="show_hide_mail_reply_btn" type="button" class="btn btn-primary">                                                               <i class="fa fa-eye"></i> Show Replies</button>

                                               <span class="m-badge m-badge--<?php echo ($lead_replies_max <= count($get_all_mail_replies)) ? 'success' : 'danger'; ?>" style="position:absolute;right: 0;top: -15px;left: 116px;"><?php echo count($get_all_mail_replies); ?></span></span>                                                    
                                          </div>
                                       <?php } ?>


                                          <div id="mail_replies_block" style="display: none;">
                                          <?php if (!empty($get_all_mail_replies)) { 
                                             foreach ($get_all_mail_replies as $mail_reply) { ?>
                                          
                                          <div class="row">
                                          
                                             <div class="col-lg-12">
                                                <div class="row">
                                                   <div class="panel col-md-12" style="margin-top: 25px;">
                                                      <div class="panel-body">
                                                          <div class="mar-btm pad-btm bord-btm">
                                                              <h1 class="page-header text-overflow">
                                                                  <!-- <span class="label label-normal label-info">Business</span> -->
                                                                  <?php echo $mail_reply->mail_subject; ?> 
                                                              </h1>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-sm-7">

                                                                  <div class="media">
                                                                    <span class="media-left">
                                                                        <img src="<?php echo base_url(); ?>assets/images/avatar.png" class="img-circle img-sm" alt="Profile Picture">
                                                                    </span>
                                                                    <div class="media-body">
                                                                        <div class="text-bold"><?php echo $mail_reply->lead_name; ?> < <a href="javascript:;"><?php echo $mail_reply->send_to; ?></a> ></div>
                                                                        <div class="btn-group" style="position: unset;display: none;" >
                                                                        <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                                                                            to me <i class="dropdown-caret"></i>
                                                                        </button>
                                                                        
                                                                    </div>
                                                                    </div>
                                                                </div>

                                                              </div>
                                                              <hr class="hr-sm visible-xs">
                                                              <div class="col-sm-5 clearfix">
                                          
                                                                  <!--Details Information-->
                                                                  <div class="pull-right text-right">
                                                                      <p class="mar-no"><small class="text-muted"><?php echo date('d M Y, H:s', strtotime($mail_reply->created_on)); ?></small></p>
                                                                      <a href="#">
                                                                          <strong>

                                                                              </strong>
                                                                          
                                                                      </a>
                                                                  </div>
                                                              </div>
                                                          </div>
                                          
                                                          <!--Message-->
                                                          <!--===================================================-->
                                                          <div class="pad-ver bord-ver">
                                                             <?php echo $mail_reply->mail_content; ?>
                                                          </div>
                                                          <!--===================================================-->
                                                          <!--End Message-->

                                                          <!--Quick reply : Summernote Placeholder -->
                                          
                                                          <!--Send button-->
                                                          <!-- <div class="pad-ver">
                                                              <button id="mailbox-mail-send-btn" type="button" class="btn btn-primary hide">
                                                                  <span class="mailbox-psi-mail-send icon-lg icon-fw"></span>
                                                                  Send Message
                                                              </button>
                                                          </div> -->
                                                      </div>
                                                  </div>
                                                </div>
                                                      
                                             </div>
                                          </div>
                                          <?php } } ?>
                                       </div>
                                          <?php if(count($get_all_mail_replies) < 1){ ?>
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5>Reply Message</h5>
                                                <div class="panel">
                                                    <div class="panel-body">
                                                      
                                                        <!--Input form-->
                                                        <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Leads/send_reply_forward_compose_mail"  enctype="multipart/form-data" onsubmit="return send_reply_validation();">
                                                            <input type="hidden" name="reply_mail_lead_id" value="<?php echo $lead_view->lead_id; ?>">
                                                            <div class="form-group">
                                                                <div class="col-lg-11">
                                                                    <select name="lead_email_reply" id="lead_email_reply" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" onchange="get_email_signature_into_content(this.value);">
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
                                                            
                                                            <div class="form-group">
                                                                <label class="col-lg-1 control-label text-left" for="inputEmail">To</label>
                                                                <div class="col-lg-11">
                                                                    <input type="text" id="reply_to_email" name="reply_to_email" class="form-control" value="<?php echo $contact_book_info->email_id; echo (trim($contact_book_info->alternative_email_id)!= '') ? ','.$contact_book_info->alternative_email_id : ''; ?>">
                                                                    <input type="hidden" name="reply_to_lead_id" value="<?php echo $lead_view->lead_id; ?>">
                                                                    <p class="text-danger" id="reply_to_email_err"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-lg-1 control-label text-left" for="inputCc">Cc</label>
                                                                <div class="col-lg-11">
                                                                    <input type="text" id="reply_to_cc_email" name="reply_to_cc_email" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-lg-1 control-label text-left" for="inputBcc">Bcc</label>
                                                                <div class="col-lg-11">
                                                                    <input type="text" id="reply_to_bcc_email" name="reply_to_bcc_email" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-lg-1 control-label text-left" for="inputSubject">Subject</label>
                                                                <div class="col-lg-11">
                                                                    <input type="text" id="reply_sub_email" name="reply_sub_email"  class="form-control">
                                                                    <p class="text-danger" id="reply_sub_email_err"></p>
                                                                </div>
                                                            </div>

                                                        <!--Attact file button-->
                                                       <!--  <div class="media pad-btm">
                                                            <div class="media-left lead_reply_attach_block">
                                                               
                                                                    <input type="file" name="reply_attach_email[]" id="reply_attach_email" multiple onchange="get_all_files_name();">
                                                               
                                                            </div>
                                                            <div id="mailbox-attach-file" class="media-body"></div>
                                                        </div> -->
                                                         <div class="row">
                                                            <div class="col-lg-12">
                                                               <input type="file" class="filepond" id="reply_attach_email" name="reply_attach_email[]" multiple  />
                                                            </div>
                                                         </div>

                                                        <!--Wysiwyg editor : Summernote placeholder-->
                                                        <div class="row" id="snote1">
                                                            <i class="fa fa-power-off show_snote"></i>
                                                           <div class="col-lg-12" > 
                                                              <textarea name="reply_content_email" class="reply_content_email" id
                                                              ="reply-mailbox-mail-compose"></textarea>
                                                              <p class="text-danger" id="reply_content_email_err"></p>
                                                           </div>
                                                        </div>

                                                        <input type="hidden" name="removed_reply_attachment_name" id="removed_reply_attachment_name">
                                                        <!-- <div ></div> -->
                                                         <div class="form-group m-form__group">
                                                            <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                                               <input type="checkbox" checked class="menu_checkbox" id="is_message_need" name="is_message_need" value="0" onchange="get_lead_message_with_reply();"> Make Reply with Lead Message
                                                               <input type="hidden" class="menu_checkbox_hidden" id="need_message_for_reply" name="need_message_for_reply" value="1">
                                                               <span></span>
                                                            </label>
                                                         </div>
                                                         <div class="pad-ver">
                                                            <button id="mail-send-btn" type="submit" name="btn_submit"  class="btn btn-primary">
                                                                <i class="mailbox-psi-mail-send icon-lg icon-fw"></i> Reply Mail
                                                            </button>
                                                         </div>

                                                </form>
                                                    </div>
                                                </div>
                                             </div>
                                          </div>
                                          <?php } ?>
                                       </div>
                                       <div class="tab-pane <?php if(isset($_SESSION['active_panel'])){ echo ($_SESSION['active_panel'] == "email") ? 'active' : ''; } ?>" id="email" role="tabpanel">
                                          <?php if($lead_view->status == 0 || $lead_view->status == 3) { ?>
                                         <div class="row"> 
                                          <select name="lead_emails" id="lead_emails" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" onchange="get_info_email_list('1');">

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

                                                      <option <?php if($email_lists[0]->email_ID == $email_list->email_ID){ echo 'selected'; }else{ echo ''; } ?> value="<?php echo $email_list->email_ID; ?>"><?php echo $email_list->email_ID; ?></option>     
                                                   <?php }
                                                }
                                             ?>
                                          </select>
                                          </div>
                                          <br>
                                          <div class="row">
                                             <div class="col-md-12">
                                                <ul class="nav nav-pills nav-pills--theme" role="tablist">
                                                   <li class="nav-item" style="cursor: pointer;">
                                                      <a class="nav-link active"  data-toggle="tab" onclick="get_info_email_list('1');">Inbox</a>
                                                   </li>
                                                   <li class="nav-item" style="cursor: pointer;">
                                                      <a class="nav-link" onclick="get_info_email_list('2');" data-toggle="tab">Sent Items</a>
                                                   </li>
                                                   
                                                </ul>
                                             </div>
                                          </div>
                                          <div id="lead_email_list" class="col-lg-12"></div>
                                          <?php }else { ?>
                                          whoops!
                                          <?php } ?>
                                       </div>
                                       <div class="tab-pane" id="active_leads" role="tabpanel">
                                          
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme m_table_2">
                                                   <thead>
                                                      <tr>
                                                         <th>Date</th>
                                                         <th>Email ID</th>
                                                         <th>Company Name</th>
                                                         <th>Product</th>
                                                         <th>Assigned Person</th>
                                                         
                                                         
                                                         <th>Status</th>
                                                         
                                                         
                                                         <th>Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>

                                                      <?php
                                                      if(!empty($lead_active_enquiries))
                                                      {
                                                         foreach ($lead_active_enquiries as $key => $active_lead) { 
                                                            $chk_blocked_emails_note = chk_blocked_emails_note($active_lead->email_id);
                                                            if (count($chk_blocked_emails_note) == 0) {
                                                            ?>
                                                            <tr>
                                                               <td><?php echo date($date_format, strtotime($active_lead->created_on)); ?> </td>
                                                               <td><?php echo $active_lead->email_id; ?></td>
                                                               <td><?php echo $active_lead->company_name; ?></td>
                                                               <td><?php echo $active_lead->product_name; ?> - <?php echo $active_lead->industry_name; ?></td>
                                                               <td><?php echo $active_lead->assigned_person; ?></td>
                                                               <td><?php echo $active_lead->lead_status_name; ?></td>
                                                               <td>
                                                                  <a href="<?php echo base_url(); ?>Leads/lead_view/<?php echo $active_lead->lead_id; ?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Lead Info"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                                                               </td>
                                                            </tr>
                                                         <?php 
                                                            }
                                                         }
                                                      } ?>
                                                      
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane <?php if(isset($_SESSION['active_panel'])){ echo ($_SESSION['active_panel'] == "lead_documents") ? 'active' : ''; } ?>" id="lead_documents" role="tabpanel">

                                          <div class="row"> 
                                             <div class="col-lg-12">
                                                <div class="pull-right">
                                                   <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" onclick="upload_document(<?php echo $lead_view->lead_id; ?>);">
                                                      <span>
                                                         <i class="la la-upload"></i>
                                                         <span>Upload Document</span>
                                                      </span>
                                                   </a>
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <?php
                                             $dir = 'assets/lead_documents/lead-'.$lead_view->lead_id;

                                             if(is_dir($dir)) {
                                               $files = scandir($dir, 0);
                                             } else {
                                               $files = array();
                                             }

                                             $extenions = array('PDF', 'pdf', 'txt', 'TXT', 'DOC', 'doc', 'DOCX', 'docx', 'XL', 'xl', 'XLS', 'xls', 'xlsx', 'XLSX');
                                             $img_extenions = array('PNG', 'png', 'JPEG', 'jpeg', 'JPG', 'jpg', 'GIF', 'gif');
                                             $other_files = array();
                                             $images_files = array();
                                             if(count($files) > 0)
                                             {
                                                for($i = 2; $i < count($files); $i++)
                                                {
                                                   $ex_val = explode('.', $files[$i]);
                                                   if(!empty($ex_val) && in_array($ex_val[1], $extenions))
                                                   { 
                                                      $other_files[] = $files[$i];
                                                   }

                                                   if(!empty($ex_val) && (in_array($ex_val[1], $img_extenions)))
                                                   { 
                                                      $images_files[] = $files[$i];
                                                   }

                                                } 
                                             }   ?>
                                                <div class="row mt_25px">
                                                <div class="col-lg-4">
                                                   <p class="top_head">
                                                      <i class="fa fa-file"></i>&nbsp;&nbsp;Documents
                                                   </p>
                                                   <div class="card-box">
                                                      <div class="m-scrollable m-scroller" data-scrollable="true" data-height="200" data-mobile-height="200">
                                                   <?php 
                                                   if(!empty($other_files))
                                                   {
                                                      foreach ($other_files as $key => $other_file) { ?>
                                                         <a href="<?php echo base_url(); ?>assets/lead_documents/lead-<?php echo $lead_view->lead_id; ?>/<?php echo $other_file; ?>" download><h5 style="word-break: break-all;"><?php echo $other_file; ?></h5></a><hr>
                                                      <?php } ?>
                                                      
                                                
                                                   <?php }else{ ?>
                                                      <h5 class="text-theme">No Document Available</h5>
                                                   <?php } ?> 
                                                      </div>
                                                   </div>

                                                 </div>
                                                 <div class="col-lg-8">
                                                   <p class="top_head">
                                                      <i class="fa fa-image"></i>&nbsp;&nbsp;Images
                                                   </p>
                                                   <div class="card-box"> 

                                                      <div class="m-scrollable m-scroller" data-scrollable="true" data-height="200" data-mobile-height="200">
                                                    <?php 
                                                   if(!empty($images_files))
                                                   {
                                                      foreach ($images_files as $key => $images_file) { ?>
                                                         <a class="fancybox" href="<?php echo base_url(); ?>assets/lead_documents/lead-<?php echo $lead_view->lead_id; ?>/<?php echo $images_file; ?>"  data-fancybox-group="gallery" ><img src="<?php echo base_url(); ?>assets/lead_documents/lead-<?php echo $lead_view->lead_id; ?>/<?php echo $images_file; ?>" width="50" height="50"></a>
                                                         
                                                      <?php } ?>
                                                   <?php }else{ ?>
                                                      <h5 class="text-theme">No Image Available</h5>
                                                   <?php } ?> 
                                                      </div>
                                                   </div>
                                                   </div>
                                       </div>
                                          
                                       </div>

                                       <div class="tab-pane" id="lead_product_costing" role="tabpanel">


        <?php $this->load->view('lead/product_costing_list_table'); ?>
                                          
                                       </div>

                                       <div class="tab-pane" id="lead_quote" role="tabpanel">
                                          
                                          <div class="row"> 
                                             <div class="col-lg-12">  
                                                <table class="table table-striped- table-bordered table-hover table-checkable m_table_2">
                                                   <thead>
                                                      <tr>
                                                         <th>Quote No</th>
                                                         <th>Exporter</th>
                                                         <th>Subject</th>
                                                         <th>Consignee</th>
                                                         <th>No.of Products</th>
                                                         <th>Value</th>
                                                         <th>Stages</th>
                                                         <th>Assigned To</th>
                                                         <th>Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php $i=0;foreach ($quote_list as $key => $qlist){
                                                            $quotlist = $this->Quote_model->get_quote_by_id($qlist['qid']);
                                                            $qprod = $this->Quote_model->get_quote_product_by_quote_id($qlist['qid']);
                                                            $get_value_variant_by_quote_Value = get_value_variant_by_value($quotlist->grand_total);
                                                            // $value_based_color = '';
                                                            $value_based_color = ($get_value_variant_by_quote_Value) ? $get_value_variant_by_quote_Value->vv_color : '';
                                                         ?>
                                                      <tr>
                                                         <td>
                  
                                                            <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['quote_no'];?></h5> <?php if($qlist['qcount']>1){?><span class="m-badge m-badge--info pull-right tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $qlist['qcount']-1; ?> QTN Revised"><?php echo $qlist['qcount']-1; ?></span><?php }?>
                                                            <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo date($date_format, strtotime($quotlist->created_date)); ?> / <?php echo date($date_format, strtotime($quotlist->valid_till)); ?></sub><b></b></b></span>
                                                            
                                                         </td> 
                                                         <td>
                                                            <?php echo $quotlist->exporter_name;?>
                                                         </td>
                                                         <td>
                                                            <?php echo $quotlist->subject;?>
                                                         </td>
                                                         <td>
                                                            <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $quotlist->lead_name;?></h5>
                                                            <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo $quotlist->country_name; ?></sub><b></b></b></span>
                                                         </td>
                                                         <td align="center">
                                                            <h5 class="text-black"><?php echo count($qprod);?></h5>
                                                         </td>
                                                         <td class="grand_total" style="background-color: <?php echo $value_based_color; ?>;">
                                                            <h5 class="text-black">
                                                               <span class="pull-left">
                                                                  <i class="fa fa-rupee-sign"></i>
                                                               </span>
                                                               <span class="pull-right"><?php echo number_format($quotlist->grand_total,2);?></span>
                                                            </h5>
                                                            <h6 class="text-primary curr_amnt_info">
                                                               <span class="pull-right"> <?php $convert_curr = $quotlist->grand_total / $quotlist->rate; echo $quotlist->currency_code.' '.number_format($convert_curr,2); ?></span>
                                                            </h6>
                                                         </td>
                                                         <td>
                                                           <h5 class="text-black"><?php echo $quotlist->quote_stage; ?></h5>
                                                         </td>
                                                         <td>
                                                            <?php echo $quotlist->lead_assigned_name;?>
                                                         </td>
                                                         <td>
                                                            <?php if($_SESSION['Quote ManagementView']==1){ ?>
                                                            <a href="<?php echo base_url(); ?>quote/quote_view/<?php echo $quotlist->quote_id;?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                                                            <?php }?>                                                            
                                                         </td>
                                                      </tr>
                                                      <?php $i++;}?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>


                                       </div>



                                       <div class="tab-pane" id="pro_invoice" role="tabpanel">
                                          
                                          <div class="row"> 
                                             <div class="col-lg-12">  
                                                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
                                                   <thead>
                                                      <tr>
                                                         <th>Invoice No / Date</th>
                                                         <th>Exporter</th>
                                                         <th>Consignee</th>
                                                         <th>No.of Products</th>
                                                         <th>Country</th>
                                                         <th>Stages</th>
                                                         <th>Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php $i=0;foreach ($proforma_invoice_list as $qlist){
                                                         $qprod = $this->Proformainvoice_model->get_proforma_invoice_product_by_id($qlist['proforma_invoice_id']);
                                                         ?>
                                                      <tr>
                                                         <td>
                                                            
                                                            <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['proforma_invoice_no'];?></h5>
                                                            <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo date($date_format, strtotime($qlist['proforma_invoice_date'])); ?></sub><b></b></b></span>
                                                            
                                                         </td> 
                                                         <td>
                                                            <?php echo $qlist['exporter_name'];?>
                                                         </td>
                                                         <td>
                                                            <?php echo $qlist['lead_name'];?>
                                                         </td>
                                                         <td align="center">
                                                            <h5 class="text-black"><?php echo count($qprod);?></h5>
                                                         </td>
                                                         <td align="center">
                                                            <?php echo $qlist['country_name'];?>
                                                         </td>
                                                         <td>
                                                           <h5 class="text-black"><?php echo $qlist['pi_stage'];?></h5>
                                                         </td>
                                                         <td>
                                                            <?php if($_SESSION['Proforma InvoiceView']==1){ ?>
                                                            <a href="<?php echo base_url(); ?>proformainvoice/proformainvoice_view/<?php echo $qlist['proforma_invoice_id'];?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                                                            <?php }?>
                                                         </td>
                                                      </tr>
                                                      <?php $i++;}?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>


                                       </div>



                                       <div class="tab-pane" id="lead_buyer_order" role="tabpanel">
                                          
                                          <div class="row"> 
                                             <div class="col-lg-12">  
                                                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
                                                   <thead>
                                                      <tr>
                                                         <th>Invoice No / Date</th>
                                                         <th>Exporter</th>
                                                         <th>Consignee</th>
                                                         <th>No.of Products</th>
                                                         <th>Country</th>
                                                         <th>Stages</th>
                                                         <th>Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php $i=0;foreach ($buyer_order_list as $qlist){
                                                         $qprod = $this->Buyerorder_model->get_buyer_order_product_by_id($qlist['buyer_order_id']);
                                                         ?>
                                                      <tr>
                                                         <td>
                                                            
                                                            <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['buyer_order_invoice_no'];?></h5>
                                                            <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo date($date_format, strtotime($qlist['invoice_date'])); ?></sub><b></b></b></span>
                                                            
                                                         </td> 
                                                         <td>
                                                            <?php echo $qlist['exporter_name'];?>
                                                         </td>
                                                         <td>
                                                            <?php echo $qlist['lead_name'];?>
                                                         </td>
                                                         <td align="center">
                                                            <h5 class="text-black"><?php echo count($qprod);?></h5>
                                                         </td>
                                                         <td align="center">
                                                            <?php echo $qlist['country_name'];?>
                                                         </td>
                                                         <td>
                                                           <h5 class="text-black"><?php echo $qlist['pi_stage'];?></h5>
                                                         </td>
                                                         <td>
                                                            <?php if($_SESSION['Buyer OrderView']==1){ ?>
                                                            <a href="<?php echo base_url(); ?>buyerorder/buyerorder_view/<?php echo $qlist['buyer_order_id'];?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                                                            <?php }?>
                                                         </td>
                                                      </tr>
                                                      <?php $i++;}?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>


                                       </div>

                                       <div class="tab-pane" id="history_log" role="tabpanel">
                                          
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme m_table_2">
                                                   <thead>
                                                      <tr>
                                                         <th>Action By</th>
                                                         <th>Created On</th>
                                                         <th>Log Type</th>
                                                         <th>Log Details</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>

                                                      <?php
                                                      if(!empty($lead_log_lists))
                                                      {
                                                         $i = 1;
                                                         foreach ($lead_log_lists as $key => $lead_log_list) { ?>
                                                            <tr>
                                                               <td><?php echo $lead_log_list->log_created_by; ?></td>
                                                               <td><?php echo date($date_format .' H:i:s', strtotime($lead_log_list->created_on)); ?></td>
                                                               <td><?php echo lead_log_type_name($lead_log_list->log_type); ?></td>
                                                               <td><a href="#" data-toggle="modal" onclick="view_log_details(<?php echo $i; ?>);">
                                                          <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-eye" ></i>
                                                       </a></td>
                                                               <input type="hidden" id="log_view_<?php echo $i; ?>" value="<?php echo $lead_log_list->log_details; ?>">
                                                            </tr>
                                                         <?php $i++; }
                                                      } ?>
                                                      
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>

                                       

                                       <div class="tab-pane" id="whatsapp_info" role="tabpanel">
                                          <div class="row">
                                             <div class="col-lg-9"></div>
                                             <div class="col-lg-3">
                                                <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air pull-right" onclick="open_add_whatsapp_modal();">
                                                   <span>
                                                      <i class="la la-plus"></i>
                                                      <span>Add Whatsapp Message</span>
                                                   </span>
                                                </a>
                                             </div>
                                          </div>
                                          <br>
                                          <ul class="nav nav-pills nav-pills--theme" role="tablist">
                                             <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="javascript:;" onclick="list_view_show('0');" id="list_view_btn">
                                                   List View
                                                </a>
                                             </li>
                                             <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="javascript:;" onclick="list_view_show('1');" id="message_view_btn">
                                                   Message View
                                                </a>
                                             </li>
                                          </ul>
                                          <div class="row" id="list_view_block"> 
                                             <div class="col-lg-12">  
                                                <table class="table table-striped- table-bordered table-hover table-checkable m_table_2">
                                                   <thead>
                                                      <tr>
                                                         <th>Created Date</th>
                                                         <th>Created By</th>
                                                         <!-- <th>Conversation</th> -->
                                                         <th>Attachment Info</th>
                                                         <th>Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php foreach ($get_whatsapp_conversation as $whatsapp_message) { ?>
                                                      <tr>
                                                         <td><?php echo date($date_format,strtotime($whatsapp_message->created_on)); ?></td>
                                                         <td><?php echo get_user_name_by_id($whatsapp_message->created_by); ?></td>
                                                         <!-- <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:100px;"><?php echo $whatsapp_message->messages; ?>
                                                         </td> -->
                                                         <td>
                                                            <?php 
                                                            if($whatsapp_message->attachments != ''){
                                                               $exp_attaches = explode(',', $whatsapp_message->attachments);
                                                               echo (count($exp_attaches) > 0) ? count($exp_attaches) : '-';
                                                            }
                                                            else {
                                                               echo '-';
                                                            }
                                                             ?>
                                                         </td>
                                                         <td><span onclick="view_all_whatsapp_messages(<?php echo $whatsapp_message->lead_whatsapp_message_id; ?>);"><i class="fa fa-eye"></i></span></td>
                                                      </tr>
                                                      <?php } ?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
<style>

.chat-search-box {
    -webkit-border-radius: 3px 0 0 0;
    -moz-border-radius: 3px 0 0 0;
    border-radius: 3px 0 0 0;
    padding: .75rem 1rem;
}

.chat-search-box .input-group .form-control {
    -webkit-border-radius: 2px 0 0 2px;
    -moz-border-radius: 2px 0 0 2px;
    border-radius: 2px 0 0 2px;
    border-right: 0;
}

.chat-search-box .input-group .form-control:focus {
    border-right: 0;
}

.chat-search-box .input-group .input-group-btn .btn {
    -webkit-border-radius: 0 2px 2px 0;
    -moz-border-radius: 0 2px 2px 0;
    border-radius: 0 2px 2px 0;
    margin: 0;
}

.chat-search-box .input-group .input-group-btn .btn i {
    font-size: 1.2rem;
    line-height: 100%;
    vertical-align: middle;
}

@media (max-width: 767px) {
    .chat-search-box {
        display: none;
    }
}


/************************************************
  ************************************************
                  Users Container
  ************************************************
************************************************/

.users-container {
    position: relative;
    padding: 1rem 0;
    border-right: 1px solid #e6ecf3;
    height: 100%;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
}


/************************************************
  ************************************************
                      Users
  ************************************************
************************************************/

.users {
    padding: 0;
}

.users .person {
    position: relative;
    width: 100%;
    padding: 10px 1rem;
    cursor: pointer;
    border-bottom: 1px solid #f0f4f8;
}

.users .person:hover {
    background-color: #ffffff;
    /* Fallback Color */
    background-image: -webkit-gradient(linear, left top, left bottom, from(#e9eff5), to(#ffffff));
    /* Saf4+, Chrome */
    background-image: -webkit-linear-gradient(right, #e9eff5, #ffffff);
    /* Chrome 10+, Saf5.1+, iOS 5+ */
    background-image: -moz-linear-gradient(right, #e9eff5, #ffffff);
    /* FF3.6 */
    background-image: -ms-linear-gradient(right, #e9eff5, #ffffff);
    /* IE10 */
    background-image: -o-linear-gradient(right, #e9eff5, #ffffff);
    /* Opera 11.10+ */
    background-image: linear-gradient(right, #e9eff5, #ffffff);
}

.users .person.active-user {
    background-color: #ffffff;
    /* Fallback Color */
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f7f9fb), to(#ffffff));
    /* Saf4+, Chrome */
    background-image: -webkit-linear-gradient(right, #f7f9fb, #ffffff);
    /* Chrome 10+, Saf5.1+, iOS 5+ */
    background-image: -moz-linear-gradient(right, #f7f9fb, #ffffff);
    /* FF3.6 */
    background-image: -ms-linear-gradient(right, #f7f9fb, #ffffff);
    /* IE10 */
    background-image: -o-linear-gradient(right, #f7f9fb, #ffffff);
    /* Opera 11.10+ */
    background-image: linear-gradient(right, #f7f9fb, #ffffff);
}

.users .person:last-child {
    border-bottom: 0;
}

.users .person .user {
    display: inline-block;
    position: relative;
    margin-right: 10px;
}

.users .person .user img {
    width: 48px;
    height: 48px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}

.users .person .user .status {
    width: 10px;
    height: 10px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
    background: #e6ecf3;
    position: absolute;
    top: 0;
    right: 0;
}

.users .person .user .status.online {
    background: #9ec94a;
}

.users .person .user .status.offline {
    background: #c4d2e2;
}

.users .person .user .status.away {
    background: #f9be52;
}

.users .person .user .status.busy {
    background: #fd7274;
}

.users .person p.name-time {
    font-weight: 600;
    font-size: .85rem;
    display: inline-block;
}

.users .person p.name-time .time {
    font-weight: 400;
    font-size: .7rem;
    text-align: right;
    color: #8796af;
}

@media (max-width: 767px) {
    .users .person .user img {
        width: 30px;
        height: 30px;
    }
    .users .person p.name-time {
        display: none;
    }
    .users .person p.name-time .time {
        display: none;
    }
}


/************************************************
  ************************************************
                  Chat right side
  ************************************************
************************************************/

.selected-user {
    width: 100%;
    padding: 0 15px;
    min-height: 64px;
    line-height: 64px;
    border-bottom: 1px solid #e6ecf3;
    -webkit-border-radius: 0 3px 0 0;
    -moz-border-radius: 0 3px 0 0;
    border-radius: 0 3px 0 0;
}

.selected-user span {
    line-height: 100%;
}

.selected-user span.name {
    font-weight: 700;
}

.chat-container {
    position: relative;
    padding: 1rem;
    width: 100%;
}

.chat-container li.chat-left,
.chat-container li.chat-right {
    display: flex;
    flex: 1;
    flex-direction: row;
    margin-bottom: 40px;
}

.chat-container li img {
    width: 48px;
    height: 48px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
}

.chat-container li .chat-avatar {
    margin-right: 20px;
}

.chat-container li.chat-right {
    justify-content: flex-end;
}

.chat-container li.chat-right > .chat-avatar {
    margin-left: 20px;
    margin-right: 0;
}

.chat-container li .chat-name {
    font-size: .75rem;
    color: #999999;
    text-align: center;
}

.chat-container li .chat-text {
    padding: .4rem 1rem;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #ffffff;
    font-weight: 300;
    line-height: 150%;
    position: relative;
    max-width: 1000px !important;
}

.chat-container li .chat-text:before {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    top: 10px;
    left: -20px;
    border: 10px solid;
    border-color: transparent #ffffff transparent transparent;
}

.chat-container li.chat-right > .chat-text {
    text-align: right;
    max-width: 510px;
}

.chat-container li.chat-right > .chat-text:before {
    right: -20px;
    border-color: transparent transparent transparent #ffffff;
    left: inherit;
}

.chat-container li .chat-hour {
    padding: 0;
    margin-bottom: 10px;
    font-size: .75rem;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin: 0 0 0 15px;
}

.chat-container li .chat-hour > span {
    font-size: 16px;
    color: #9ec94a;
}

.chat-container li.chat-right > .chat-hour {
    margin: 0 15px 0 0;
}

@media (max-width: 767px) {
    .chat-container li.chat-left,
    .chat-container li.chat-right {
        flex-direction: column;
        margin-bottom: 30px;
    }
    .chat-container li img {
        width: 32px;
        height: 32px;
    }
    .chat-container li.chat-left .chat-avatar {
        margin: 0 0 5px 0;
        display: flex;
        align-items: center;
    }
    .chat-container li.chat-left .chat-hour {
        justify-content: flex-end;
    }
    .chat-container li.chat-left .chat-name {
        margin-left: 5px;
    }
    .chat-container li.chat-right .chat-avatar {
        order: -1;
        margin: 0 0 5px 0;
        align-items: center;
        display: flex;
        justify-content: right;
        flex-direction: row-reverse;
    }
    .chat-container li.chat-right .chat-hour {
        justify-content: flex-start;
        order: 2;
    }
    .chat-container li.chat-right .chat-name {
        margin-right: 5px;
    }
    .chat-container li .chat-text {
        font-size: .8rem;
    }
}

.chat-form {
    padding: 15px;
    width: 100%;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ffffff;
    border-top: 1px solid white;
}

.ul-li {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.card {
    border: 0;
    background: #f4f5fb;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    margin-bottom: 2rem;
    box-shadow: none;
}
ul#comments_block {
    max-height: 200px;
    overflow-y: scroll;
}
</style>
                                          <div class="row" id="message_view_block" style="display: none;">
                                             <div class="row">
                                                 <div class="col-md-12">
                                                   <br>
                                                   <div class="row page-header">
                                                      <div class="col-md-3"> <h5 style="padding-left: 15px;padding-top: 13px;"><?php echo count($get_whatsapp_conversation); ?> Message<?php echo(count($get_whatsapp_conversation) > 1) ? 's' : '' ?></h5> </div>
                                                      <div class="col-md-6"></div>
                                                      <div class="col-md-3">
                                                         <input type="text" id="search_in_comment" class="form-control" placeholder="Search in Comments" style="margin-bottom: 8px;width: 161px;">
                                                      </div>
                                                   </div> 
                                                   <div class="container">
                                                       <div class="content-wrapper">

                                                           <div class="row gutters">

                                                               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                                                   <div class="card m-0">

                                                                       <!-- Row start -->
                                                                       <div class="row no-gutters">
                                                                              
                                                                               <div class="chat-container">
                                                                                   <ul class="chat-box chatContainerScroll ul-li" id="comments_block">
                                                                                    <?php foreach($get_whatsapp_conversation as $botlist){ 
                                                                                      $get_user_info = common_select_values('*','users','user_id = "'.$botlist->created_by.'"','row');
                                                                                       ?>
                                                                                       <li class="chat-left each_comments_blocks">
                                                                                           <div class="chat-avatar">
                                                                                               <img src="<?php echo base_url(); ?>assets/user_profile/<?php echo $get_user_info->profile_image; ?>">
                                                                                               <div class="chat-name"><?php echo $get_user_info->name;?></div>
                                                                                           </div>
                                                                                           <div class="chat-text">
                                                                                             <?php  
                                                                                               echo $botlist->messages; 

                                                                                               if ($botlist->attachments != '') { 
                                                                                                  ?>
                                                                                             <hr>
                                                                                             <h5 class="text-info">Attachments</h5>
                                                                                             <?php
                                                                                                 $exp_files = explode(',',$botlist->attachments);

                                                                                                 $extenions = array('PDF', 'pdf', 'txt', 'TXT', 'DOC', 'doc', 'DOCX', 'docx', 'XL', 'xl', 'XLS', 'xls', 'xlsx', 'XLSX');
                                                                                                  $img_extenions = array('PNG', 'png', 'JPEG', 'jpeg', 'JPG', 'jpg', 'GIF', 'gif');
                                                                                                  $other_files = array();
                                                                                                  $images_files = array();
                                                                                                  if(count($exp_files) > 0)
                                                                                                  {
                                                                                                     for($i = 0; $i < count($exp_files); $i++)
                                                                                                     {
                                                                                                        $ex_val = explode('.', $exp_files[$i]);
                                                                                                        if(!empty($ex_val) && in_array($ex_val[1], $extenions))
                                                                                                        { 
                                                                                                           $other_files[] = $exp_files[$i];
                                                                                                        }

                                                                                                        if(!empty($ex_val) && (in_array($ex_val[1], $img_extenions)))
                                                                                                        { 
                                                                                                           $images_files[] = $exp_files[$i];
                                                                                                        }

                                                                                                     } 
                                                                                                  }
                                                                                                 ?>
                                                                                                 <?php 
                                                                                                    if(!empty($other_files))
                                                                                                    {
                                                                                                       foreach ($other_files as $key => $other_file) { ?>
                                                                                                          <a href="<?php echo base_url(); ?>assets/whatsapp_attach/<?php echo $other_file; ?>" download><h5 style="word-break: break-all;"><?php echo $other_file; ?></h5></a><hr>
                                                                                                       <?php } ?>
                                                                                                       
                                                                                                 
                                                                                                 <?php } ?>
                                                                                                 <?php 
                                                                                                 if(!empty($images_files))
                                                                                                  {

                                                                                                     foreach ($images_files as $key => $images_file) { ?>
                                                                                                        <a class="fancybox" href="<?php echo base_url(); ?>assets/whatsapp_attach/<?php echo $images_file; ?>"  data-fancybox-group="gallery" ><img src="<?php echo base_url(); ?>assets/whatsapp_attach/<?php echo $images_file; ?>" width="50" height="50"></a>
                                                                                                        
                                                                                                     <?php } ?>
                                                                                                  <?php } ?>
                                                                                             <?php }
                                                                                             ?>    
                                                                                           </div>
                                                                                           <div class="chat-hour"><?php echo time_elapsed_string_in_helper($botlist->created_on);?> <span class="fa fa-check-circle"></span></div>
                                                                                       </li>
                                                                                       
                                                                                    <?php }  ?>
                                                                                   </ul>
                                                                                   
                                                                               </div>
                                                                           
                                                                       </div>
                                                                       <!-- Row end -->
                                                                   </div>

                                                               </div>

                                                           </div>
                                                           <!-- Row end -->

                                                       </div>
                                                       <!-- Content wrapper end -->

                                                   </div>
                                                     
                                                 </div>
                                             </div>
                                          </div>
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
      <!-- end:: Page -->

<!--begin::Update Lead-->
<div class="container">
   <div class="modal fade" id="upload_document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
   </div>
</div>
<div class="container">
   <div class="modal fade" id="whatsapp_messages_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
   </div>
</div>
<div class="container">
   <div class="modal fade" id="append_log_details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Lead Log Details</h5>
               <button Source="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            
               <div class="modal-body">
                  <div id="append_log_details"></div>   
               </div>
               <div class="modal-footer">
                  
                  <button Source="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            
         </div>
      </div>
   </div>
</div>

<div class="container">
   <div class="modal fade" id="add_whatsapp_conversation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Whatsapp Messages</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Leads/add_whatsapp_conversation" onsubmit="return add_whatsapp_validataion()">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Messages<span class="text-danger">*</span></label>
                                    <textarea class="form-control m-input m-input--square whatsapp_summernote" placeholder="Enter Whatsapp Messages" name="whatsapp_messages" id="whatsapp_messages"></textarea>
                                    <input type="hidden" name="message_lead_id" value="<?php echo $lead_view->lead_id; ?>">
                                    <span id="whatsapp_messages_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-12">
                                 <input type="file" class="filepond" name="whatsapp_attach[]" id="whatsapp_attach" multiple>
                               </div>
                             </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" id="btnSubmit" class="btn btn-primary">Create</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
               </form>
            </div>
      </div>
   </div>
</div>
<!--End::-->
   <script src="<?php echo base_url();?>assets/mailbox/js/bootstrap.js"></script>
   <script src="<?php echo base_url();?>assets/mailbox/js/mailbox.js"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/jquery.fancybox.pack.js" type="text/javascript"></script>

   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-preview.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-exif-orientation.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-size.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-encode.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-type.min.js" type="text/javascript"></script>
   <script type="text/javascript">
$(document).ready(function() {
     $("#snote1 i.show_snote").click(function(){
       $('#snote1 .note-toolbar-wrapper').toggle();
       $('#snote1 .note-editable').toggleClass("mt");
      });

   $("#comments_block").pagify(6, ".each_comments_blocks");
   $('.fancybox').fancybox();

   

   var pcostcount = $('#pcostcount').val();
   for(var i=0;i<pcostcount;i++)
   {
      getCalculatedValue(i);
   }
});

FilePond.registerPlugin(
  // encodes the file as base64 data
  FilePondPluginFileEncode,

  // validates files based on input type
  FilePondPluginFileValidateType,

  // validates the size of the file
  FilePondPluginFileValidateSize,

  // corrects mobile image orientation
  FilePondPluginImageExifOrientation,

  // previews dropped images
  // FilePondPluginImagePreview
);
         
// Select the file input and use create() to turn it into a pond
FilePond.create(document.querySelector('#reply_attach_email'), {
  acceptedFileTypes: []
});
          
          // Select the file input and use create() to turn it into a pond
FilePond.create(document.querySelector('#whatsapp_attach'), {
acceptedFileTypes: []
});
$(document).ready(function(){
  $("#search_in_comment").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#comments_block .each_comments_blocks").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
function get_lead_message_with_reply()
{
   if($("#is_message_need").prop('checked') == true){
       $('#need_message_for_reply').val('1');
   }
   else {
       $('#need_message_for_reply').val('0');
   }
}
function lead_comment_validation(){
    var err = 0;
      var cmnts = $('#comments').val();

      if(cmnts==''){
         $('#comments_err').html('Enter Comments');
         err++;
      }else{
        $('#comments_err').html('');
      }


  if(err>0){ return false; }else{ return true; }
}  

function view_log_details(id)
{
   var block = $('#log_view_'+id).val();
   $('#append_log_details').empty().append(block);
   $('#append_log_details_modal').modal('show');
}
function getCalculatedValue(c)
{
   var pmlist = $('#pmlist'+c).val();
   var cscount = $('#cscount'+c).val();
   for(var k=0;k<pmlist;k++)
   {
      var pctcount = $('#pctypecount'+k+c).val();
      for(var j=0;j<pctcount;j++)
      {
         var ispercent = $('#ispercent'+k+j+c).val();
         var isedit = $('#isedit'+k+j+c).val();
         for(var i=0;i<cscount;i++)
         {
            var kgval = $('#in_kg'+i+c).val();
            var ival = $('#input'+k+j+c).html();
            if(ival == '')
            {
               $('#input'+k+j+c).html(0);
               ival = 0;
            }
            if(ispercent==1)
            {
               var tval = (parseFloat($('#stagetot'+(k-1)+i+c).html())*parseFloat(ival))/100;
            }
            else if(ispercent==2)
            {
               if(ival!=0)
                  var tval = (parseFloat($('#stagetot'+(k-1)+i+c).html())/parseFloat(ival));
               else
                  var tval = parseFloat(0);
            }
            else
            {
               var tval = parseFloat(kgval)*parseFloat(ival);
            }
            $('#val'+k+j+i+c).html(tval.toFixed('2'));
            /*if(isedit==0)
               $('#val'+k+j+i).html(tval.toFixed('2'));
            else
            {
               $('#inpval'+k+j+i).val(tval);
            }*/
         }

         for(var i=0;i<cscount;i++)
         {
            var tcat = 0;
            for(var s=0;s<pctcount;s++)
            {
               var typval = $('#val'+k+s+i+c).html();

               /*isedit = $('#isedit'+k+s).val();
               if(isedit==0)
                  var typval = $('#val'+k+s+i).html();
               else
                  var typval = $('#inpval'+k+s+i).val();*/

               if(typval=='' || typval==null)
                  typval = 0;
               var maction = $('#ptmaction'+k+j+c).val();
               if(maction == 'Addition(+)')
                  tcat = parseFloat(tcat)+parseFloat(typval);
               if(maction == 'Subtraction(-)')
                  tcat = parseFloat(tcat)-parseFloat(typval);
               if(maction == 'Multiplication(*)')
                  tcat = parseFloat(tcat)*parseFloat(typval);
               if(maction == 'Division(/)')
                  tcat = parseFloat(tcat)/parseFloat(typval);
            }

            var pprodccat = $('#pprodccat'+k+c).val();
            var pcmaction = $('#pcmaction'+k+c).val();
            if(pprodccat !=0)
            {
               if(pcmaction == 'Addition(+)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i+c).html())+parseFloat(tcat);
               if(pcmaction == 'Subtraction(-)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i+c).html())-parseFloat(tcat);
               if(pcmaction == 'Multiplication(*)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i+c).html())*parseFloat(tcat);
               if(pcmaction == 'Division(/)')
                  var ptcat = parseFloat($('#stagetot'+(pprodccat-1)+i+c).html())/parseFloat(tcat);
               
               $('#stagetot'+k+i+c).html(ptcat.toFixed('2'));
            }
            else
            {
               $('#stagetot'+k+i+c).html(tcat.toFixed('2'));
            }

         }

      }

   }

}

</script> 
      <script type="text/javascript">
         $(document).ready(function(){
           $("#show_hide_mail_reply_btn").click(function(){
             $("#mail_replies_block").slideToggle();
           });
         });
          var title = $('title').text() + ' | ' + ' Lead View';
          $(document).attr("title", title);

$('.m_table_2').dataTable();
var baseurl = '<?php echo base_url(); ?>';

get_info_email_list('1');

function get_info_email_list(email_type)
{  

   var val = $("#lead_emails").val();

   var s_e_id = '<?php echo $contact_book_info->email_id; ?>';
   var select_val = $("#lead_emails option:selected").text();
   var lead_id = '<?php echo $lead_view->lead_id; ?>';
   $.ajax({
   type: "POST",
   url: baseurl+'Leads/lead_email_list',
   type: "POST",
   data: "e_id="+val+"&start=1&s_e_id="+s_e_id+"&lead_id="+lead_id+"&email_type="+email_type,
   dataType: "html",
   success: function(response)
      {
         $('#lead_email_list').empty().append(response);
      }
   
   });
}
function get_info_email_list_from_imap(email_type)
{  
   var val = $("#lead_emails").val();
   var lead_email_id = '<?php echo $contact_book_info->email_id; ?>';
   var select_val = $("#lead_emails option:selected").text();
   var lead_id = '<?php echo $lead_view->lead_id; ?>';
   $.ajax({
      type: "POST",
      url: baseurl+'Leads/lead_email_list_from_imap',
      type: "POST",
      data: "e_id="+val+"&start=1&lead_email_id="+lead_email_id+"&lead_id="+lead_id+"&email_type="+email_type,
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
   var s_e_id = '<?php echo $contact_book_info->email_id; ?>';
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
// To show email thread
// function show_email_thread(parent_id, subject, lead_id)
// {
//    $.ajax({
//       type: "POST",
//       url: baseurl+'Leads/show_email_thread',
//       async: false,
//       type: "POST",
//       data: {'parent_id':parent_id, 'subject' : subject, 'lead_id' : lead_id},
//       dataType: "html",
//       success: function(response)
//          {
//             $('#lead_email_list').empty().append(response);
            
//          }
//       });
// }
function show_email_thread(msg_no, label, company_email, lead_email)
{
   var email_id = $('#lead_emails').val();
   var lead_id = '<?php echo $lead_view->lead_id; ?>';
   $.ajax({
      type: "POST",
      url: baseurl+'Leads/view_email',
      type: "POST",
      data: {'msg_no':msg_no, 'label' : label, 'lead_email' : lead_email, 'company_email' : company_email, 'lead_id': lead_id},
      dataType: "html",
      success: function(response)
         {
            $('#lead_email_list').empty().append(response);
            
         }
      });
}
function compose_mail()
{
   var lead_id = $('#mail_view_lead_id').val();
   var off_chosen_mail = $('#lead_emails').val();
   $.ajax({
      type: "POST",
      url: baseurl+'Leads/lead_compose_mail',
      async: false,
      type: "POST",
      data:{'lead_id': lead_id, 'off_chosen_mail': off_chosen_mail},
      dataType: "html",
      success: function(response)
      {
         $('#lead_email_list').empty().append(response);
         
      }
   });

}

function send_compose_validation()
{
   var sub_email = $('#sub_email').val();
   var mail_message = $('#mailbox-mail-compose').val();
   var to_email = $('#to_email').val();
   var err = 0; 
   if (sub_email == '') {
      $('#sub_email_err').html('Email Subject Required!');
      err++;
   }
   else {
      $('#sub_email_err').html('');
   }
   if (mail_message == '') {
      $('#mail_message_err').html('Contect is Required!');
      err++;
   }
   else {
      $('#mail_message_err').html('');
   }
   if (to_email == '') {
      $('#to_email_err').html('Reciever Mail Required!');
      err++;  
   }
   else {
      $('#to_email_err').html('');
   }
   if (err > 0) {
      return false;
   }
   else {
      return true;
   }

}
$('#reply-mailbox-mail-compose').summernote('lineHeight', '5px');
$('.whatsapp_summernote').summernote();

function send_reply_validation()
{
   var sub_email = $('#reply_sub_email').val();
   var mail_message = $('.reply_content_email').val();
   var to_email = $('#reply_to_email').val();
   var from_email = $('#lead_email_reply').val();

   var err = 0;
   if (from_email == '') {
      $('#lead_email_reply_err').html('Choose Mail to Send!');
      err++;
   }
   else {
      $('#lead_email_reply_err').html('');
   } 
   if (sub_email == '') {
      $('#reply_sub_email_err').html('Email Subject Required!');
      err++;
   }
   else {
      $('#reply_sub_email_err').html('');
   }
   if (mail_message == '') {
      $('#reply_content_email_err').html('Contect is Required!');
      err++;
   }
   else {
      $('#reply_content_email_err').html('');
   }
   if (to_email == '') {
      $('#reply_to_email_err').html('Reciever Mail Required!');
      err++;  
   }
   else {
      $('#reply_to_email_err').html('');
   }
   if (err > 0) {
      return false;
   }
   else {
      return true;
   }
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

function get_all_files_name()
{
   $('.file_names').remove();
   var files = $('#reply_attach_email').prop("files")
   var names = $.map(files, function(val) { return val.name; });
   var each_file_name = '';
   for (var i = 0; i < names.length; i++) {
     each_file_name = "'"+names[i]+"'";

     $('.lead_reply_attach_block').append('<span class="file_names" style="position:relative; cursor:pointer;" id="ind_file_in_attach_'+i+'"><button class="btn btn-primary" style="padding: 5px; margin: 3px;">'+names[i]+'</button><span class="m-badge m-badge--danger" style="position:absolute;right: 0;top: -15px;left: 255px;" onclick="rmv_attachment('+each_file_name+','+i+');">&times;</span></span>');
   }
   $('#removed_reply_attachment_name').val('');
}
function rmv_attachment(file_name,id)
{
   $('#ind_file_in_attach_'+id).remove();
   var remval = $('#removed_reply_attachment_name').val();
   if(remval=='')
   {
     var removed_attachment_name = file_name;
   }
   else
   {
     var removed_attachment_name = remval+','+file_name;
   }
   $('#removed_reply_attachment_name').val(removed_attachment_name);
}

function open_add_whatsapp_modal()
{
   $('#add_whatsapp_conversation').modal('show');
}
function view_all_whatsapp_messages(wm_id)
{
   if (wm_id != '') {
      $.ajax({
         type: "POST",
         url:baseurl+'Leads/get_whatsapp_conversation_by_id',
         data:{'wm_id':wm_id},
         async: false,
         dataType: "html",
         success: function(result){

            $('#whatsapp_messages_view').empty().append(result);
            $("#whatsapp_messages_view").modal('show');
         }
      });
   }
}
function add_whatsapp_validataion()
{
   var whatsapp_messages = $('#whatsapp_messages').val();
   var err = 0;
   if (whatsapp_messages == '') {
      $('#whatsapp_messages_err').html('Message is Required!');
      err++;
   }
   else {
      $('#whatsapp_messages_err').html('');
   }
   if (err > 0) {
      return false;
   }
   else {
      return true;
   }
}
function list_view_show(flag)
{
   if(flag == '0')
   {
      $('#list_view_block').show();
      $('#message_view_block').hide();
      $('#list_view_btn').removeClass('active');
      $('#message_view_btn').addClass('active');
   }
   else if(flag == '1') {
      $('#list_view_block').hide();
      $('#message_view_block').show();    
      $('#message_view_btn').removeClass('active');
      $('#list_view_btn').addClass('active'); 
   }
}

function get_email_signature_into_content(val)
{
   if (val != '') {
      $.ajax({
         type: "POST",
         url:baseurl+'Leads/get_email_signature_into_content',
         data:{'email_id':val},
         async: false,
         dataType: "html",
         success: function(result){
            $("#reply-mailbox-mail-compose").summernote("code", result);
            // $('#reply-mailbox-mail-compose').summernote('refresh');
         }
      });
   }
}
      </script>

   </body>

   <!-- end::Body -->
</html>