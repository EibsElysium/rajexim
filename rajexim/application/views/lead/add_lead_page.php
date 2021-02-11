<?php 
   $g_settings = common_select_values('*', 'general_settings', '', 'row');
   $p_title = isset($g_settings->product_title) ? $g_settings->product_title : 'Raj Exim';
   $p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/images/logo.png';
   $p_favicon  = isset($g_settings->favicon) ? base_url().'assets/common_images/'.$g_settings->favicon : base_url().'assets/images/favicon.ico';
  $user_details = login_user_details($_SESSION['admindata']['user_id']);
  $body_class = ($user_details->show_menu == 0) ? "m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default m-brand--minimize m-aside-left--minimize" : "m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"; 
$body_class1 = ($user_details->show_menu == 1) ? "m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop   m-container m-container--responsive m-container--xxl m-page__container m-body" : "m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body"; 
?>

<!DOCTYPE html>
<html lang="en">
   <!-- begin::Head -->
   <head>
      <meta charset="utf-8" />
      <title><?php echo $p_title; ?></title>
      <meta name="description" content="Latest updates and statistic charts">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

      <!--begin::Web font -->
      <script src="<?php echo base_url(); ?>assets/demo/demo12/base/webfont.js"></script>
      <script>
         WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700","Nunito:400,400i,600,600i,700,700i,800,800i,900,900"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <link rel="shortcut icon" href="<?php echo $p_favicon; ?>" />
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
   background: url("assets/demo/demo12/media/img/logo/aero_world.gif") center no-repeat #fff;
}
#mycalculator {
  position: absolute;
  z-index: 9;
  background-color: #f1f1f1;
  text-align: center;
  border: 1px solid #d3d3d3;
  z-index: 9999;
}

#mycalculatorheader {
  padding: 10px;
  cursor: move;
  z-index: 10;
  background-color: #2196F3;
  color: #fff;
}
.m-portlet .m-portlet__body {
    padding: 0.2rem 2.2rem !important;
}
/*.note-editable {
    height: 631.031px;
}*/
.m-footer--push.m-aside-left--enabled:not(.m-footer--fixed) .m-aside-right, .m-footer--push.m-aside-left--enabled:not(.m-footer--fixed) .m-wrapper {
    margin-bottom: 0px !important;
}
</style>
<!-- Paste this code after body tag -->
            <div class="se-pre-con"></div>
      <!-- Ends -->
   <?php $this->load->view('common_css'); ?>
  <!-- end::Head -->
</head>
<body class="<?php echo $body_class; ?>">

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

      <!-- BEGIN: Header -->
      <?php //$this->load->view('common_topbar'); ?>

      <!-- END: Header -->

      <!-- begin::Body -->
      
        
       



            <div class="m-grid__item m-grid__item--fluid m-wrapper">



               <!-- BEGIN: Subheader -->



               <!-- END: Subheader -->

               <div class="m-content">
                  <h3 class="text-theme" style="background: #fff;">Create New Lead</h3>
                  

                  <!--Begin::Section-->

                  <div class="row">

                     <div class="col-xl-12">

                        <div class="m-portlet m-portlet--mobile ">
                        
                        <div id="empty_mail_content" <?php if (isset($lead_add_from_mail_box)){ if($get_ind_mail_details['subject'] == ''){ ?> style="display: block;" <?php } else { ?> style="display: none;" <?php } } elseif(!isset($lead_add_from_mail_box)) { ?> style="display: none;"; <?php } ?> >
                          <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8"><h5><span class="text-danger">Mail Server Couldn't Connect !</span> <span class="text-info">Try Again.</span> </h5></div>
                            <div class="col-lg-2"></div>
                          </div>
                        </div>
                        <div id="go_lead_form">
                          <form name="lead_add_form" method="POST" id="lead_add_form_id" action="<?php echo base_url(); ?>Leads/lead_save" onsubmit="return lead_validation();">
                             <div class="m-portlet__body">
                                <!--begin: Datatable -->
                                <div class="row">
                                   <div class="col-lg-6">
                                      <h5 class="mt_25px text-theme">
                                         <b>Lead Info</b> 
                                      </h5><hr>
                                      <div class="row">
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Lead Name<span class="text-danger">*</span>
                                               </label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Name"  name="lead_name" id="lead_name" maxlength="100" value="<?php if(isset($lead_name)){ echo ($lead_name != '') ? $lead_name : ''; } ?>">
                                               <span class="text-danger" id="lead_name_err"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Company Name</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Company Name" name="company_name" id="company_name" maxlength="100">
                                               <span class="text-danger" id="company_name_err"></span>
                                            </div>
                                         </div>
                                         
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                                  <label>Country<span class="text-danger">*</span></label>
                                                  <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="country" id="country">
                                                     <option value="">Choose Country</option>
                                                     <?php
                                                           if(!empty($country_lists))
                                                           {
                                                              foreach ($country_lists as $country_list) {  ?>
                                                                 <option value="<?php echo $country_list->id; ?>"><?php echo $country_list->name; ?></option>
                                                              <?php } 
                                                           }
                                                        ?>
                                                  </select>
                                                  <span class="text-danger" id="country_err"></span>
                                               </div>
                                         </div>
                                         
                                            
                                      </div>
                                      <div class="row">
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Designation</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Designation" name="designation" id="designation" maxlength="100">
                                               <span class="text-danger" id="designation_err"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Website</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Website" id="website" name="website">
                                               <span class="text-danger" id="website_err"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4" id="snote1">
                                            <div class="form-group m-form__group">
                                               <label>Address</label><i class="fa fa-power-off show_snote"></i>
                                               <textarea class="form-control snote" name="address" id="address" placeholder="Enter Address"></textarea>
                                               <span class="text-danger" id="address_err"></span>
                                            </div>
                                         </div>
                                      </div>

                                      <h5 class="text-theme"><b>Lead Contact Info</b></h5><hr>

                                      <div class="row">
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Primary Email ID<span class="text-danger">*</span></label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Primary Email ID" name="email_id" id="email_id" maxlength="100" onblur="chk_if_email_is_blocked(this.value);email_id_unique(this.value);" value="<?php if (isset($email_id)){ echo ($email_id != '') ? $email_id : ''; } ?>">
                                               <span class="text-danger" id="email_id_err"></span>
                                            </div>
                                            <input type="hidden" name="cont_book_id" id="cont_book_id" value="0">
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Alternate Email ID</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Alternate Email ID" name="alternative_email_id" id="alternative_email_id" maxlength="100" >
                                               <span class="text-danger" id="alternative_email_id_err"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Skype ID</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Skype ID" id="skype_id" name="skype_id">
                                               <span class="text-danger" id="skype_id_err"></span>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Contact No</label>
                                               <input type="text" class="form-control m-input m-input--square" onblur="contact_no_unique(this.value);" placeholder="Enter Contact No" id="contact_no" name="contact_no" maxlength="20">
                                               <span class="text-danger" id="contact_no_err"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Whatsapp No</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Whatsapp No" id="whatsapp_no" name="whatsapp_no" maxlength="20">
                                               <span class="text-danger" id="whatsapp_no_err"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Office Contact No</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Office Contact No"  id="office_phone_no" name="office_phone_no" maxlength="20">
                                               <span class="text-danger" id="office_phone_no_err"></span>
                                            </div>
                                         </div>
                                      </div>
                                      <div id="contact_person_block_append">
                                        <div class="row" id="contact_person_block_1">
                                           <div class="col-lg-4">
                                              <div class="form-group m-form__group">
                                                 <label>Contact Person Name</label>
                                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Name" id="contact_person_name_1" name="contact_person_name[]">
                                                 <span class="text-danger" id="contact_person_name_err_1"></span>
                                              </div>
                                           </div>
                                           <div class="col-lg-4">
                                              <div class="form-group m-form__group">
                                                 <label>Phone</label>
                                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Phone" id="contact_person_phone_1" onblur="chk_unique_contact_person_phone('1');" onkeypress="return isNumberobj(event,contact_person_phone_err_1);" name="contact_person_phone[]" maxlength="20">
                                                 <span class="text-danger" id="contact_person_phone_err_1"></span>
                                              </div>
                                           </div>
                                           <div class="col-lg-3">
                                              <div class="form-group m-form__group">
                                                 <label>Email</label>
                                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email" id="contact_person_email_1" onblur="chk_unique_contact_person_email('1');" name="contact_person_email[]" maxlength="20">
                                                 <span class="text-danger" id="contact_person_email_err_1"></span>
                                              </div>
                                           </div>
                                           <div class="col-lg-1">
                                              <div class="pull-right">
                                                <div class="form-group m-form__group mt_25px">
                                                  <button type="button" class="btn btn-primary" onclick="contact_person_add_row();"><i class="fa fa-plus"></i></button>
                                                </div>
                                              </div>
                                           </div>
                                        </div>
                                      </div>
                                      <input type="hidden" name="contact_person_inc_count" id="contact_person_inc_count" value="2">

                                      <div id="address_block_append">
                                        <div class="row" id="address_block_1">
                                           <div class="col-lg-11">
                                              <div class="form-group m-form__group">
                                                 <label>Shipping Address</label>
                                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Shipping Address" id="shipping_address_1" name="shipping_address[]">
                                                 <span class="text-danger" id="shipping_address_err_1"></span>
                                              </div>
                                           </div>
                                           
                                           <div class="col-lg-1">
                                              <div class="pull-right">
                                                <div class="form-group m-form__group mt_25px">
                                                  <button type="button" class="btn btn-primary" onclick="address_add_row();"><i class="fa fa-plus"></i></button>
                                                </div>
                                              </div>
                                           </div>
                                        </div>
                                      </div>
                                      <input type="hidden" name="address_inc_count" id="address_inc_count" value="2">

                                      <div id="address1_block_append">
                                        <div class="row" id="address1_block_1">
                                           <div class="col-lg-11">
                                              <div class="form-group m-form__group">
                                                 <label>Billing Address</label>
                                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Billing Address" id="billing_address_1" name="billing_address[]">
                                                 <span class="text-danger" id="billing_address_err_1"></span>
                                              </div>
                                           </div>

                                           <div class="col-lg-1">
                                              <div class="pull-right">
                                                <div class="form-group m-form__group mt_25px">
                                                  <button type="button" class="btn btn-primary" onclick="address1_add_row();"><i class="fa fa-plus"></i></button>
                                                </div>
                                              </div>
                                           </div>
                                        </div>
                                      </div>
                                      <input type="hidden" name="address1_inc_count" id="address1_inc_count" value="2">
                                      
                                      <h5 class="text-theme"><b>Interested Product Info</b></h5><hr>
                                      <div class="row">
                                         <div class="col-lg-4">
                                           <div class="form-group m-form__group">
                                             <label>Product<span class="text-danger">*</span></label>
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="product_id" id="product_id" onchange="product_user_list(this.value);chk_email_and_product_are_same_and_already_exist();">
                                                <option value="">Choose Product</option>
                                                <?php
                                                   if(!empty($product_lists))
                                                   {
                                                      foreach ($product_lists as $product_list) { if($product_list->status == 0){ ?>
                                                         <option value="<?php echo $product_list->product_id; ?>"><?php echo $product_list->product_name; ?></option>
                                                      <?php } }
                                                   }
                                                ?>
                                             </select>
                                             <span class="text-danger" id="product_id_err"></span>
                                           </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Industry</label>
                                               <input type="text" class="form-control"  readonly="" name="industry_name" id="industry_name">
                                               <input type="hidden"  class="form-control"  readonly="" name="industry_id" id="industry_id">
                                               <span class="text-danger" ></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4"></div>
                                      </div>
                                      <h5 class="mt_25px text-theme"><b>Lead Source Info</b></h5><hr>

                                      <div class="row">
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Lead Source<span class="text-danger">*</span></label>
                                               <!-- <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source" id="lead_source"> 
                                                  <option value="">Choose</option> 
                                                  <?php
                                                     if(!empty($lead_source_lists))
                                                     {
                                                        foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                                           <optgroup label="<?php echo $lead_source_list->lead_source; ?>">
                                                              <?php $get_all_subgroup_source = get_all_subgroup_source($lead_source_list->lead_source_id); 
                                                              foreach ($get_all_subgroup_source as $sub_lead){
                                                              ?>
                                                              <option value="<?php echo $sub_lead->sub_lead_source_id; ?>"><?php echo $sub_lead->sub_lead_source; ?></option>
                                                              <?php } ?>
                                                           </optgroup>
                                                           
                                                        <?php } }
                                                     }
                                                  ?>
                                               </select> -->
                                               <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="ori_lead_source" id="ori_lead_source" onchange="get_sub_lead_source_by_ls_id();"> 
                                                  <option value="">Choose Lead Source</option> 
                                                  <?php
                                                     if(!empty($lead_source_lists))
                                                     {
                                                        foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                                           <option <?php if(isset($alibaba_or_not)){ if($alibaba_or_not == '1'){ echo ($lead_source_list->lead_source_id == 2) ? 'selected' : ''; } } ?> value="<?php echo $lead_source_list->lead_source_id; ?>"><?php echo $lead_source_list->lead_source; ?></option>
                                                        <?php } }
                                                     }
                                                  ?>
                                               </select>
                                               <span class="text-danger" id="ori_lead_source_err"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Sub Lead Source<span class="text-danger">*</span></label>
                                              
                                               <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source" id="lead_source"> 
                                                  <option value="">Choose Sub Lead Source</option> 
                                                  
                                               </select>
                                               <span class="text-danger" id="lead_source_err"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Priority<span class="text-danger">*</span></label>
                                               <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_type" id="lead_type"> 
                                                  <option value="">Choose Priority</option> 
                                                  <?php
                                                     if(!empty($lead_type_lists))
                                                     {
                                                        foreach ($lead_type_lists as  $lead_type_list) { if($lead_type_list->status == 0){ ?>
                                                           <option <?php echo ($lead_type_list->lead_type_id == 3) ? 'selected' : ''; ?> value="<?php echo $lead_type_list->lead_type_id; ?>"><?php echo $lead_type_list->lead_type; ?></option>
                                                        <?php } }
                                                     }
                                                  ?>
                                               </select>
                                               <span class="text-danger" id="lead_type_err"></span>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Lead Status<span class="text-danger">*</span></label>
                                               <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_status" id="lead_status"> 
                                                  <option value="">Choose Lead Status</option> 
                                                 <?php
                                                     if(!empty($lead_status_lists))
                                                     {
                                                        foreach ($lead_status_lists as $lead_status_list) { if($lead_status_list->status == 0){ ?>
                                                           <option <?php echo ($lead_status_list->lead_status_id == 6) ? 'selected' : ''; ?> value="<?php echo $lead_status_list->lead_status_id; ?>"><?php echo $lead_status_list->lead_status; ?></option>
                                                        <?php } }
                                                     }
                                                  ?>
                                               </select>
                                               <span class="text-danger" id="lead_status_err"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Assigned To<span class="text-danger">*</span></label>
                                               <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="assigned_to" id="assigned_to"> 
                                                  <option value="">Choose Assigned To</option> 
                                                  
                                               </select>
                                               <span class="text-danger" id="assigned_to_err"></span>
                                            </div>
                                         </div>
                                      </div>
                                      
                                   </div>
                                   <div class="col-lg-6">
                                      
                                      <h5 class="mt_25px text-theme"><b>Message Info</b></h5><hr>
                                      <div class="row" id="snote2">
                                            <div class="col-lg-12">
                                               <label>Message</label><i class="fa fa-power-off show_snote2"></i>
                                               <div class="form-group m-form__group">
                                                  <textarea class="summernote" id="m_summernote_1" name="lead_message"><?php echo (isset($message)) ? $message : ''; ?></textarea>
                                                  <span class="text-danger" id="lead_message_err"></span>
                                               </div>
                                            </div>
                                      </div>
                                   </div>
                                </div>
                                <div class="row">
                                   <div class="col-lg-8" id="acknow_sub_block">
                                     <p style="font-weight: bold;font-color:black; font-size: 15px;" id="acknow_sub_err"></p>
                                   </div>
                                   <div class="col-lg-2"></div>
                                   <div class="col-lg-2">
                                    <input type="submit" onclick="exist_lead_confirmed_add_lead();" name="acknow_sub" id="acknow_sub" class="btn btn-primary" value="Confirm and submit" style="display: none;">
                                   <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Create Lead">
                                   
                                   <!-- <p class="text-danger" id="acknow_sub_err"></p> -->
                                   <input type="hidden" name="acknow_confirm_flag" id="acknow_confirm_flag" value="1">
                                   <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                   </div>
                                </div>
                             
                             </div>
                          </form>
                        </div> 

                        
                        </div>

                     </div>

                  </div>

                  <!--End::Section-->

               </div>

            </div>

      
<div class="container">
   <div class="modal fade" id="acknow_ex_modal" data-keyboard="false" data-backdrop = "static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Lead Already Exist with Other Products...</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
               <div class="modal-body">
                  <!-- <input type="hidden" name="imp_lead_id" id="imp_lead_id">
                  <input type="hidden" name="imp_flag" id="imp_flag">
                  <p id="imp_mail_label"></p> -->
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
               </div>
            
         </div>
      </div>
   </div>
</div>


         <!-- end:: Body -->



         <!-- begin::Footer -->

         <?php $this->load->view('common_footer'); ?>

         <!-- end::Footer -->

      </div>

      <!-- end:: Page -->



      <!-- begin::Scroll Top -->

      <div id="m_scroll_top" class="m-scroll-top">

         <i class="la la-arrow-up"></i>

      </div>

      <!-- end::Scroll Top -->

      <!--begin::Modal-->

      <!-- Create Lead Status-->

<!-- Update Lead Status-->





   

<script type="text/javascript">
$('#m_summernote_1').summernote('lineHeight', '5px');
var baseurl = '<?php echo base_url(); ?>';

$("#snote1 i.show_snote").click(function(){
       $('#snote1 .note-toolbar-wrapper').toggle();
       $('#snote1 .note-editable').toggleClass("mt");
      });

$("#snote2 i.show_snote2").click(function(){
       $('#snote2 .note-toolbar-wrapper').toggle();
       $('#snote2 .note-editable').toggleClass("mt");
      });

$('.snote').summernote('lineHeight', '5px');

var title = $('title').text() + ' | ' + 'Lead List';
window.onunload = refreshParenttriggerAlertOnParent;
function refreshParenttriggerAlertOnParent() {
    //window.opener.location.hash = "showAlert";
    <?php if(!isset($lead_add_from_mail_box)){ ?>
      window.opener.location.reload();
    <?php } ?>
    window.close();
}
$(document).attr("title", title);   
get_sub_lead_source_by_ls_id();
function get_sub_lead_source_by_ls_id() {
      var ls = $('#ori_lead_source').val();
      $.ajax({
         url:baseurl+'Leads/get_sub_lead_source_by_ls_id',
         type:'POST',
         data:{'value':ls},
         dataType: 'html',
         success:function(result){
            $('#lead_source').empty().append(result);
            $('.m_selectpicker').selectpicker('refresh');
         }
      });
   }
var block_er = 0;
function chk_if_email_is_blocked(val)
{

   $.ajax({
      type: "POST",
      url:baseurl+'Leads/chk_lead_email_is_blocked',
      data:{'value':val},
      async: false,
      dataType: "html",
      success: function(result){
         if(result > 0)
         {
            $('#email_id_err').html('This email is Blocked');
            block_er = 1;
         }else{
            $('#email_id_err').html('');
            block_er = 0;
         }
         
      }
   });
}
function exist_lead_confirmed_add_lead()
{
  $('#acknow_confirm_flag').val('0');
  $('#lead_add_form_id').submit();
}
function chk_email_and_product_are_same_and_already_exist()
{
  console.log('checking Product is same or not');
}
var notification_content = '';
function lead_notification_message_generation()
{
  var assigned_to = $('#assigned_to').val();
  var lead_name = $('#lead_name').val();
  var country = $('#country').val();
  var created_by = '<?php echo $_SESSION['admindata']['user_id']; ?>';
  var product_id = $('#product_id').val();

  $.ajax({
      type: "POST",
      url:baseurl+'Leads/generate_notification_content',
      data:{'assigned_to':assigned_to,'lead_name':lead_name,'country':country,'created_by':created_by,'product_id':product_id},
      async: false,
      dataType: "html",
      success: function(result){
         notification_content = result;
      }
   });

}
function lead_validation()
{
  $('#submit').prop('disabled',true);
  lead_notification_message_generation();
   var err = 0;
   var lead_name = $('#lead_name').val();
   var company_name = $('#company_name').val();
   var country = $('#country').val();
   var designation = $('#designation').val();
   var website = $('#website').val();
   var address = $('#address').val();
   var email_id = $('#email_id').val();
   var alternative_email_id = $('#alternative_email_id').val();
   var website = $('#website').val();
   var skype_id = $('#skype_id').val();
   var contact_no = $('#contact_no').val();
   var whatsapp_no = $('#whatsapp_no').val();
   var office_phone_no = $('#office_phone_no').val();
   var product_id = $('#product_id').val();
   var lead_source = $('#lead_source').val();
   var ori_lead_source = $('#ori_lead_source').val();
   var lead_type = $('#lead_type').val();
   var lead_status = $('#lead_status').val();
   var assigned_to = $('#assigned_to').val();
   var message = $('#m_summernote_1').val();
   var lead_status = $('#lead_status').val();
   
   var acknow_confirm_flag = $('#acknow_confirm_flag').val();
   if(lead_name == '')
   {
      if (acknow_confirm_flag == "1") {
      $('#lead_name_err').html('Lead Name is required!');
      
        err++;
      }
      else {
        $('#lead_name_err').html('');
      }
   }else{
      $('#lead_name_err').html('');
   }  
   if(country == '')
   {
      if (acknow_confirm_flag == "1") {
      $('#country_err').html('Country is required!');
      
        err++;
      }
      else {
        $('#country_err').html('');
      }
   }else{
      $('#country_err').html('');
   } 
  
   if(website != '' && !isUrlValid(website))
   {
       $('#website_err').html('Valid Website is required!');
       if (acknow_confirm_flag == "1") {
        err++;
       }
   }else{
      $('#website_err').html('');
   } 

   if (contact_no.trim() == '' &&  email_id.trim() == '') {
      $('#email_id_err').html('Email ID is required!');
      $('#contact_no_err').html('Contact No is required!');
      if (acknow_confirm_flag == "1") {
        err++;
      }
      // if(email_id == '')
      // {
      //    $('#email_id_err').html('Email ID is required!');
      //    err++;

      // }else if(!ValidateEmail(email_id)){ 

      //         $('#email_id_err').html('Invalid Email ID!');
      //         err++;
      // }else if(er > 0){
      //    $('#email_id_err').html('Email ID already exists!');
      //    err++;
      // }else if(erb > 0){

      //    $('#email_id_err').html('This email is Blocked');
      //    err++;
      // }
      // else{
      //   $('#email_id_err').html('');
      // }

      // if (contact_no == '') {
      //    $('#contact_no_err').html('Contact No is required!');
      //      err++;
      // }
      // else if(contact_no != '' && contact_no=='0000000000')
      //  { 
      //      $('#contact_no_err').html('Contact No should be maxium 10 No!');
      //      err++;
      //  }else if(isNaN(contact_no))
      //  { 
      //      $('#contact_no_err').html('Invalid Contact No!');
      //      err++;
      //  }
      //  else{
      //      $('#contact_no_err').html('');
      //  }
   }
   else {
      $('#email_id_err').html('');
      $('#contact_no_err').html('');
   }

   if(cpp_err > 0){
    $('#contact_person_phone_err_1').html('Phone no Already Exist!');
    err++;
   }
   else {
    $('#contact_person_phone_err_1').html('');
   }


   if(cpe_err > 0){
    $('#contact_person_email_err_1').html('Email Already Exist!');
    err++;
   }
   else {
    $('#contact_person_email_err_1').html('');
   }

   if(contact_no != '')
   { 
        
       if(isNaN(contact_no))
       { 
           $('#contact_no_err').html('Invalid Contact No!');
           err++;
       }
       else if (cer > 0){
           $('#contact_no_err').html('Contact No already exists!');
           $('#acknow_sub_err').html('Note: Seems the Contact has already Request with the other Product');
           $("#acknow_sub").prop('value', 'Create Lead');
           $('#acknow_sub').show();
           $('#submit').hide();
           
           if (acknow_confirm_flag == "1") {
             err++;
             var contact_book_id = $('#cont_book_id').val();
             if(contact_book_id != '0')
             {
               $.ajax({
                  type: "POST",
                  url:baseurl+'Leads/lead_pro_and_email_email_id_exits',
                  data:{'contact_book_id':contact_book_id,'product_id':product_id},
                  async: false,
                  dataType: "html",
                  success: function(result){
                     if (result == 1) {
                      $('#acknow_sub_err').html('Note: Seems the Contact has already Request with the other Product');
                      $('#acknow_sub').show();
                      err++;
                     }
                  }
               });
             }
           }
           else {
            $('#email_id_err').html('');
           }
       }
       else {
           $('#contact_no_err').html('');
           $('#email_id_err').html(''); 
       }
   }
   if (email_id.trim() != '') {
    if(!ValidateEmail(email_id)){ 
        $('#email_id_err').html('Invalid Email ID!');
        err++;
      }else if(er > 0){

         $('#email_id_err').html('Email ID already exists!');
         $('#acknow_sub_err').html('Note: Seems the Contact has already Request with the other Product');
         $('#acknow_ex_modal').modal('show');
         $("#acknow_sub").prop('value', 'Create Lead');
         $('#acknow_sub').show();
         $('#submit').hide();
         
         if (acknow_confirm_flag == "1") {
           err++;
           var contact_book_id = $('#cont_book_id').val();
           if(contact_book_id != '0')
           {
             $.ajax({
                type: "POST",
                url:baseurl+'Leads/lead_pro_and_email_email_id_exits',
                data:{'contact_book_id':contact_book_id,'product_id':product_id},
                async: false,
                dataType: "html",
                success: function(result){
                   if (result == 1) {
                    $('#acknow_sub_err').html('Note: Seems the Contact has already Request with the other Product');
                    $('#acknow_sub').show();
                    err++;
                   }
                }
             });
           }
         }
         else {
          $('#email_id_err').html('');
         }
      }else if(block_er > 0){

         $('#email_id_err').html('This email is Blocked');
         err++;
      }
      else{
        $('#email_id_err').html('');
      }
   }
   if(alternative_email_id != '' && !ValidateEmail(alternative_email_id)){ 

           $('#alternative_email_id_err').html('Invalid Email ID!');
           err++;
   }
   else{
     $('#alternative_email_id_err').html('');
   }

   
    
   if(whatsapp_no != '' && whatsapp_no=='0000000000')
    { 
        $('#whatsapp_no_err').html('Invalid Whatsapp No!');
        err++;
    }else if(isNaN(whatsapp_no))
    { 
        $('#whatsapp_no_err').html('Invalid Whatsapp No!');
        err++;
    }
    else{
        $('#whatsapp_no_err').html('');
    }
      
   if(office_phone_no != '' && office_phone_no=='0000000000')
    { 
        $('#office_phone_no_err').html('Invalid Office Contact No!');
        err++;
    }else if(isNaN(office_phone_no))
    { 
        $('#office_phone_no_err').html('Invalid Office Contact No!');
        err++;
    }
    else{
        $('#office_phone_no_err').html('');
    }
   if(product_id.trim()==''){

      $('#product_id_err').html('Product is required!');
      err++;
   }else{
      $('#product_id_err').html('');

   }

   if(lead_source.trim()==''){

      $('#lead_source_err').html('Sub Lead Source is required!');
      err++;
   }else{
      $('#lead_source_err').html('');

   }
   if (ori_lead_source == '') {
      $('#ori_lead_source_err').html('Lead Source is required!');
      err++;
   }
   else {
      $('#ori_lead_source_err').html('');
   }
    if(lead_type.trim()==''){

      $('#lead_type_err').html('Priority is required!');
      err++;
   }else{
      $('#lead_type_err').html('');

   }
   if(lead_status.trim()==''){

      $('#lead_status_err').html('Lead Status is required!');
      err++;
   }else{
      $('#lead_status_err').html('');

   }

   if(assigned_to.trim()==''){

      $('#assigned_to_err').html('Assigned To is required!');
      err++;
   }else{
      $('#assigned_to_err').html('');

   }
   if(err == 0){ 
      var conn = new WebSocket('ws://localhost:8282');
      var client = {
          user_id: <?php echo $_SESSION['admindata']['user_id']; ?>,
          recipient_id: null,
          type: 'socket',
          token: null,
          message: null
      };

      conn.onopen = function (e) {
          conn.send(JSON.stringify(client));
          // $('#messages').append('<font color="green">Successfully connected as user ' + client.user_id + '</font><br>');
          console.log(client.user_id);
      };

      conn.onmessage = function (e) {
          var data = JSON.parse(e.data);
          if (data.message) {
              $('.noti_li').append(data.message);
              console.log(data.user_id + ' : ' + data.message);
          }
          if (data.type === 'token') {
              // $('#token').html('JWT Token : ' + data.token);
              console.log('JWT Token : ' + data.token);
          }
      };

      client.message = notification_content;
      client.token = $('#token').text().split(': ')[1];
      client.type = 'chat';
      if ($('#assigned_to').val() != '') {
          client.recipient_id = $('#assigned_to').val();
      }
      conn.send(JSON.stringify(client));
      return true; 
   }
   else{ 
    $('#submit').prop('disabled',false); 
    return false; 
   }
}   


var er = 0;
function email_id_unique(val) 
{
  if(val.trim() != '') {
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/lead_email_id_exits',
      data:{'value':val},
      async: false,
      dataType: "html",
      success: function(result1){
       
         if(result1 > '0')
         {
            $('#cont_book_id').empty().val(result1);
            $('#email_id_err').html('Email ID already exists!');
            er = 1;
         }else{
            $('#email_id_err').html('');
            er = 0;
         }
      }
   });
  }
}

var cer = 0;
function contact_no_unique(val) 
{
  if(val.trim() != '') {
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/lead_contact_no_exits',
      data:{'value':val},
      async: false,
      dataType: "html",
      success: function(result){
         if(result > 0)
         {
            $('#cont_book_id').empty().val(result);
            $('#contact_no_err').html('Contact No already exists!');
            cer = 1;
         }else{
            $('#contact_no_err').html('');
            cer = 0;
         }
      }
   });
  }
}
function product_user_list(val) 
{
   $.ajax({
      url:baseurl+'Leads/product_user_list',
      type:'POST',
      data:{'value':val},
      dataType: 'html',

      success:function(result){
         var valval = result.split("|");
         $('#industry_name').val(valval[1]);
         $('#industry_id').val(valval[2]);
         $('#assigned_to').empty().append(valval[0]);
         $('.m_selectpicker').selectpicker('refresh');
      }
   });
}

function address_add_row()
{
  var cp_inc = $('#address_inc_count').val();
  $('#address_block_append').append('<div class="row" id="address_block_'+cp_inc+'"> <div class="col-lg-11"> <div class="form-group m-form__group"> <label>Shipping Address</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Shipping Address" id="shipping_address_'+cp_inc+'" name="shipping_address[]"> <span class="text-danger" id="shipping_address_err_'+cp_inc+'"></span> </div> </div>  <div class="col-lg-1"> <div class="pull-right"> <div class="form-group m-form__group mt_25px"> <button type="button" class="btn btn-danger" onclick="address_rmv_row('+cp_inc+');"><i class="fa fa-minus"></i></button> </div> </div> </div> </div>');

  cp_inc = Number(cp_inc) + 1;
  $('#address_inc_count').val(cp_inc);
}
function address_rmv_row(lid)
{
  $('#address_block_'+lid).remove();
}

function address1_add_row()
{
  var cp_inc = $('#address1_inc_count').val();
  $('#address1_block_append').append('<div class="row" id="address1_block_'+cp_inc+'"> <div class="col-lg-11"> <div class="form-group m-form__group"> <label>Billing Address</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Billing Address" id="billing_address1_'+cp_inc+'" name="billing_address[]"> <span class="text-danger" id="billing_address1_err_'+cp_inc+'"></span> </div> </div>  <div class="col-lg-1"> <div class="pull-right"> <div class="form-group m-form__group mt_25px"> <button type="button" class="btn btn-danger" onclick="address1_rmv_row('+cp_inc+');"><i class="fa fa-minus"></i></button> </div> </div> </div> </div>');

  cp_inc = Number(cp_inc) + 1;
  $('#address1_inc_count').val(cp_inc);
}
function address1_rmv_row(lid)
{
  $('#address1_block_'+lid).remove();
}
function contact_person_add_row()
{
  var cp_inc = $('#contact_person_inc_count').val();
  $('#contact_person_block_append').append('<div class="row" id="contact_person_block_'+cp_inc+'"><div class="col-lg-4"><div class="form-group m-form__group"><label>Contact Person Name</label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Name" id="contact_person_name_'+cp_inc+'" name="contact_person_name[]"> <span class="text-danger" id="contact_person_name_err_'+cp_inc+'"></span> </div></div><div class="col-lg-4"><div class="form-group m-form__group"><label>Phone</label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Phone" id="contact_person_phone_'+cp_inc+'" onblur="chk_unique_contact_person_phone('+cp_inc+');" onkeypress="return isNumberobj(event,contact_person_phone_err_'+cp_inc+');" name="contact_person_phone[]" maxlength="20"> <span class="text-danger" id="contact_person_phone_err_'+cp_inc+'"></span> </div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Email</label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Email" id="contact_person_email_'+cp_inc+'" onblur="chk_unique_contact_person_email('+cp_inc+');" name="contact_person_email[]" maxlength="20"> <span class="text-danger" id="contact_person_email_err_'+cp_inc+'"></span> </div></div><div class="col-lg-1"><div class="pull-right"><div class="form-group m-form__group mt_25px"><button type="button" class="btn btn-danger" onclick="contact_person_rmv_row('+cp_inc+');"><i class="fa fa-minus"></i></button> </div></div></div></div>');

  cp_inc = Number(cp_inc) + 1;
  $('#contact_person_inc_count').val(cp_inc);
}
function contact_person_rmv_row(lid)
{
  $('#contact_person_block_'+lid).remove();
}

var cpp_err = 0;
function chk_unique_contact_person_phone(lid)
{
  var cp_phone = $('#contact_person_phone_'+lid).val();
  if(cp_phone.trim() != '') {
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/lead_contact_person_phone_no_exits',
      data:{'contact_person_phone':cp_phone},
      async: false,
      dataType: "html",
      success: function(result){
         if(result > 0)
         {
            $('#cont_book_id').empty().val(result);
            $('#contact_person_phone_err_'+lid).html('Phone No already exists!');
            cpp_err = 1;
         }else{
            $('#contact_person_phone_err_'+lid).html('');
            cpp_err = 0;
         }
      }
   });
  }
}

var cpe_err = 0;
function chk_unique_contact_person_email(lid)
{
  var cp_email = $('#contact_person_email_'+lid).val();
  if(cp_email.trim() != '') {
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/lead_contact_person_email_exits',
      data:{'contact_person_email':cp_email},
      async: false,
      dataType: "html",
      success: function(result){
         if(result > 0)
         {
            $('#cont_book_id').empty().val(result);
            $('#contact_person_email_err_'+lid).html('Email No already exists!');
            cpe_err = 1;
         }else{
            $('#contact_person_email_err_'+lid).html('');
            cpe_err = 0;
         }
      }
   });
  }
}


</script>

</body>

   <!-- end::Body -->

</html>