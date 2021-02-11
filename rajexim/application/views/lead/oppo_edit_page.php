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
                  <h3 class="text-theme" style="background: #fff;">Update Opportunity</h3>
                  

                  <!--Begin::Section-->

                  <div class="row">

                     <div class="col-xl-12">

                        <div class="m-portlet m-portlet--mobile ">

                         
                        <form name="lead_edit_form" id="lead_edit_form" action="<?php echo base_url(); ?>Leads/opportunity_update" method="POST" onsubmit="return e_lead_validation();">
                           <div class="m-portlet__body">
                              <!--begin: Datatable -->
                              <div class="row">
                                <div class="col-lg-6">
                                  <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead_edit->lead_id; ?>">
                                  <input type="hidden" name="cont_book_id" id="cont_book_id" value="<?php echo $contact_book_info->contact_book_id; ?>">
                                  <h5 class="mt_25px text-theme">
                                      <b>Lead Info</b> 
                                  </h5><hr>
                                   <div class="row">
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Lead Name<span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Name"  name="lead_name" id="e_lead_name" maxlength="100" value="<?php echo $contact_book_info->lead_name; ?>">
                                            <span class="text-danger" id="e_lead_name_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Company Name" name="company_name" id="company_name" maxlength="100" value="<?php echo ($contact_book_info->company_name) ? $contact_book_info->company_name : ''; ?>">
                                            <span class="text-danger" id="company_name_err"></span>
                                         </div>
                                      </div>
                                      
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                               <label>Country<span class="text-danger">*</span></label>
                                               <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="country" id="e_country">
                                                  <option value="">Choose</option>
                                                  <?php
                                                        if(!empty($country_lists))
                                                        {
                                                           foreach ($country_lists as $key => $country_list) {  ?>
                                                              <option value="<?php echo $country_list->id; ?>" <?php echo ($country_list->id == $contact_book_info->country) ? 'selected' : ''; ?> ><?php echo $country_list->name; ?></option>
                                                           <?php } 
                                                        }
                                                     ?>
                                               </select>
                                               <span class="text-danger" id="e_country_err"></span>
                                            </div>
                                      </div>
                                      
                                   </div>
                                   <div class="row">
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Designation</label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Designation" name="designation" id="e_designation" maxlength="100" value="<?php echo ($contact_book_info->designation) ? $contact_book_info->designation : ''; ?>">
                                            <span class="text-danger" id="e_designation_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Website</label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Website" id="e_website" name="website" value="<?php echo ($contact_book_info->website) ? $contact_book_info->website : ''; ?>">
                                            <span class="text-danger" id="e_website_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4" id="snote1">
                                         <div class="form-group m-form__group">
                                            <label>Address</label><i class="fa fa-power-off show_snote"></i>
                                            <textarea class="form-control snote" name="address" id="e_address" placeholder="Enter Address"><?php echo ($contact_book_info->address) ? $contact_book_info->address : ''; ?> 
                                         </textarea>
                                            <span class="text-danger" id="e_address_err"></span>
                                         </div>
                                      </div>
                                   </div>
                                   <h5 class="text-theme"><b>Lead Contact Info</b></h5><hr>
                                   <div class="row">
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Primary Email ID<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Primary Email ID" name="email_id" id="e_email_id" maxlength="100" value="<?php echo ($contact_book_info->email_id) ? $contact_book_info->email_id : ''; ?>" onblur="e_email_id_unique(this.value);">

                                            <input type="hidden" class="form-control m-input m-input--square" placeholder="Enter Primary Email ID" name="" id="o_email_id" maxlength="100" value="<?php echo ($contact_book_info->email_id) ? $contact_book_info->email_id : ''; ?>">

                                            <span class="text-danger" id="e_email_id_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Alternate Email ID</label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Alternate Email ID" name="alternative_email_id" id="e_alternative_email_id" maxlength="100" value="<?php echo ($contact_book_info->alternative_email_id) ? $contact_book_info->alternative_email_id : ''; ?>">
                                            <span class="text-danger" id="e_alternative_email_id_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Skype ID</label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Skype ID" id="e_skype_id" name="skype_id" value="<?php echo ($contact_book_info->skype_id) ? $contact_book_info->skype_id : ''; ?>">
                                            <span class="text-danger" id="e_skype_id_err"></span>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="row">
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Contact No</label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact No" id="e_contact_no" name="contact_no" maxlength="20" value="<?php echo ($contact_book_info->contact_no) ? $contact_book_info->contact_no : ''; ?>">
                                            <span class="text-danger" id="e_contact_no_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Whatsapp No</label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Whatsapp No" id="e_whatsapp_no" name="whatsapp_no" maxlength="20" value="<?php echo ($contact_book_info->whatsapp_no) ? $contact_book_info->whatsapp_no : ''; ?>">
                                            <span class="text-danger" id="e_whatsapp_no_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Office Contact No</label>
                                            <input type="text" class="form-control m-input m-input--square" placeholder="Enter Office Contact No"  id="e_office_phone_no" name="office_phone_no" maxlength="20" value="<?php echo ($contact_book_info->office_phone_no) ? $contact_book_info->office_phone_no : ''; ?>">
                                            <span class="text-danger" id="e_office_phone_no_err"></span>
                                         </div>
                                      </div>
                                   </div>
                                   <div id="contact_person_block_append">
                                    <?php 
                                    if(count($contact_person_information_by_contact_book_id) > 0){
                                      $k=1;
                                    foreach ($contact_person_information_by_contact_book_id as $cp_info) { ?>
                                  
                                      <div class="row" id="contact_person_block_<?php echo $k; ?>">
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Contact Person Name</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Name" id="contact_person_name_<?php echo $k; ?>" name="contact_person_name[]" value="<?php echo $cp_info->contact_person_name; ?>">
                                               <span class="text-danger" id="contact_person_name_err_<?php echo $k; ?>"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                               <label>Phone</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Phone" id="contact_person_phone_<?php echo $k; ?>" onblur="chk_unique_contact_person_phone('<?php echo $k; ?>');" onkeypress="return isNumberobj(event,contact_person_phone_err_<?php echo $k; ?>);" name="contact_person_phone[]" maxlength="20" value="<?php echo $cp_info->contact_person_phone; ?>">
                                               <span class="text-danger" id="contact_person_phone_err_<?php echo $k; ?>"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-3">
                                            <div class="form-group m-form__group">
                                               <label>Email</label>
                                               <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email" id="contact_person_email_<?php echo $k; ?>" onblur="chk_unique_contact_person_email('<?php echo $k; ?>');" name="contact_person_email[]" maxlength="20" value="<?php echo $cp_info->contact_person_email; ?>">
                                               <span class="text-danger" id="contact_person_email_err_<?php echo $k; ?>"></span>
                                            </div>
                                         </div>
                                         <div class="col-lg-1">
                                            <div class="pull-right">
                                              <div class="form-group m-form__group mt_25px">
                                                <?php if($k == 1){ ?>
                                                  <button type="button" class="btn btn-primary" onclick="contact_person_add_row();"><i class="fa fa-plus"></i></button>
                                                <?php }else { ?>
                                                  <button type="button" class="btn btn-danger" onclick="contact_person_rmv_row('<?php echo $k; ?>');"><i class="fa fa-minus"></i></button>
                                                <?php } ?>
                                              </div>
                                            </div>
                                         </div>
                                      </div>
                                    <?php $k++; } }else { ?>
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
                                    <?php } ?>
                                    </div>
                                    <input type="hidden" name="contact_person_inc_count" id="contact_person_inc_count" value="<?php echo (count($contact_person_information_by_contact_book_id) > 0) ? count($contact_person_information_by_contact_book_id) + 1 : 2; ?>">
                                   <h5 class="text-theme"><b>Interested Product Info</b></h5><hr>
                                   <div class="row">
                                      <div class="col-lg-4">
                                            <div class="form-group m-form__group">
                                                  <label>Product<span class="text-danger">*</span></label>
                                                  <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="product_id" id="e_product_id" onchange="e_product_user_list(this.value);">
                                                     <option value="">Choose</option>
                                                     <?php
                                                        if(!empty($product_lists))
                                                        {
                                                           foreach ($product_lists as $key => $product_list) { if($product_list->status == 0){ ?>
                                                              <option value="<?php echo $product_list->product_id; ?>" <?php echo ($product_list->product_id == $lead_edit->product_id) ? 'selected' : ''; ?> ><?php echo $product_list->product_name; ?></option>
                                                           <?php } }
                                                        }
                                                     ?>
                                                  </select>
                                                  <span class="text-danger" id="e_product_id_err"></span>
                                            </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Industry</label>
                                            <input type="text" class="form-control"  readonly="" name="industry_name" id="e_industry_name" value="<?php echo ($lead_edit->industry_name) ? $lead_edit->industry_name : ''; ?>">
                                            <input type="hidden"  class="form-control"  readonly="" name="industry_id" id="e_industry_id" value="<?php echo ($lead_edit->industry_id) ? $lead_edit->industry_id : ''; ?>">
                                            <span class="text-danger" id="e_industry_name_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                        <div class="form-group m-form__group">
                                          <label>Industry</label>
                                          <input type="text" class="form-control"  readonly="" name="industry_name" id="e_industry_name" value="<?php echo ($lead_edit->industry_name) ? $lead_edit->industry_name : ''; ?>">
                                          <input type="hidden"  class="form-control"  readonly="" name="industry_id" id="e_industry_id" value="<?php echo ($lead_edit->industry_id) ? $lead_edit->industry_id : ''; ?>">
                                          <span class="text-danger" id="e_industry_name_err"></span>
                                        </div>
                                      </div>
                                      <div class="col-lg-4"></div>
                                   </div>

                                   <h5 class="text-theme"><b>Lead Source Info</b></h5><hr>

                                   <div class="row">
                                      <!-- <div class="col-lg-3">
                                         <div class="form-group m-form__group">
                                            <label>Lead Source<span class="text-danger">*</span></label>
                                            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source" id="e_lead_source"> 
                                               <option value="">Choose</option> 
                                              
                                               <?php
                                                  if(!empty($lead_source_lists))
                                                  {
                                                     foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                                        <optgroup label="<?php echo $lead_source_list->lead_source; ?>">
                                                           <?php $get_all_subgroup_source = get_all_subgroup_source($lead_source_list->lead_source_id); 
                                                           foreach ($get_all_subgroup_source as $sub_lead){
                                                           ?>
                                                           <option <?php echo ($sub_lead->sub_lead_source_id == $lead_edit->lead_source_id) ? 'selected' : ''; ?> value="<?php echo $sub_lead->sub_lead_source_id; ?>"><?php echo $sub_lead->sub_lead_source; ?></option>
                                                           <?php } ?>
                                                        </optgroup>
                                                        
                                                     <?php } }
                                                  }
                                               ?>
                                            </select>
                                            <span class="text-danger" id="e_lead_source_err"></span>
                                         </div>
                                      </div> -->
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Lead Source<span class="text-danger">*</span></label>
                                           
                                            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="e_ori_lead_source" id="e_ori_lead_source" onchange="e_get_sub_lead_source_by_ls_id();"> 
                                               <option value="">Choose</option> 
                                               <?php
                                                  if(!empty($lead_source_lists))
                                                  {
                                                     foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                                        <option <?php echo($lead_edit->ls_id == $lead_source_list->lead_source_id) ? 'selected' : ''; ?> value="<?php echo $lead_source_list->lead_source_id; ?>"><?php echo $lead_source_list->lead_source; ?></option>
                                                     <?php } }
                                                  }
                                               ?>
                                            </select>
                                            <span class="text-danger" id="e_ori_lead_source_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Sub Lead Source<span class="text-danger">*</span></label>
                                           
                                            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source" id="e_lead_source"> 
                                               <option value="">Choose</option> 
                                               <?php foreach ($sub_lead_sources as $sls_list) {
                                                  if ($sls_list->status == 0) { ?>
                                                  <option <?php echo ($sls_list->sub_lead_source_id == $lead_edit->lead_source_id) ? 'selected' : ''; ?> value="<?php echo $sls_list->sub_lead_source_id; ?>"><?php echo $sls_list->sub_lead_source; ?></option>      
                                                 <?php }
                                                  # code...
                                               } ?>
                                               
                                            </select>
                                            <span class="text-danger" id="e_lead_source_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Priority<span class="text-danger">*</span></label>
                                            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_type" id="e_lead_type"> 
                                               <option value="">Choose</option> 
                                               <?php
                                                  if(!empty($lead_type_lists))
                                                  {
                                                     foreach ($lead_type_lists as $key => $lead_type_list) { if($lead_type_list->status == 0){ ?>
                                                        <option value="<?php echo $lead_type_list->lead_type_id; ?>" <?php echo ($lead_type_list->lead_type_id == $lead_edit->lead_type_id) ? 'selected' : ''; ?> ><?php echo $lead_type_list->lead_type; ?></option>
                                                     <?php } }
                                                  }
                                               ?>
                                            </select>
                                            <span class="text-danger" id="e_lead_type_err"></span>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="row">
                                     <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Lead Status<span class="text-danger">*</span></label>
                                            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_status" id="e_lead_status"> 
                                               <option value="">Choose</option> 
                                              <?php
                                                  if(!empty($lead_status_lists))
                                                  {
                                                     foreach ($lead_status_lists as $key => $lead_status_list) { if($lead_status_list->status == 0){ ?>
                                                        <option value="<?php echo $lead_status_list->lead_status_id; ?>" <?php echo ($lead_status_list->lead_status_id == $lead_edit->lead_status_id) ? 'selected' : ''; ?> ><?php echo $lead_status_list->lead_status; ?></option>
                                                     <?php } }
                                                  }
                                               ?>
                                            </select>
                                            <span class="text-danger" id="e_lead_status_err"></span>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group m-form__group">
                                            <label>Assigned To<span class="text-danger">*</span></label>
                                            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="assigned_to" id="e_assigned_to"> 
                                               <option value="">Choose</option> 
                                               <?php
                                                  if(!empty($product_users))
                                                  {
                                                     foreach ($product_users as $key => $product_user) {  ?>
                                                        <option value="<?php echo $product_user->user_id; ?>" <?php echo ($product_user->user_id == $lead_edit->lead_assigned_to) ? 'selected' : ''; ?> ><?php echo $product_user->user_name; ?></option>
                                                     <?php } 
                                                  }
                                               ?>
                                               
                                            </select>
                                            <span class="text-danger" id="e_assigned_to_err"></span>
                                         </div>
                                      </div>
                                   </div>
                                 </div>
                                 <div class="col-lg-6">
                                    
                                    <h5 class="mt_25px text-theme"><b>Message Info</b></h5><hr>
                                   <div class="row">
                                         <div class="col-lg-12" id="snote2">
                                            <label>Message <i class="fa fa-power-off show_snote2"></i></label>
                                            <div class="form-group m-form__group">
                                               <textarea class="summernote" id="e_m_summernote_1" name="lead_message"><?php echo ($lead_edit->message) ? $lead_edit->message : ''; ?></textarea>
                                               <span class="text-danger" id="e_lead_message_err"></span>
                                            </div>
                                         </div>
                                   </div>
                                 </div>
                              </div>
                              <div class="row">
                                
                                 <div class="col-lg-10"></div>
                                 <div class="col-lg-2">
                                 <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update Lead">
                                 </div>
                              </div>
                           
                           </div>
                        </form>
                        </div>

                     </div>

                  </div>

                  <!--End::Section-->

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
  $("#snote1 i.show_snote").click(function(){
   $('#snote1 .note-toolbar-wrapper').toggle();
   $('#snote1 .note-editable').toggleClass("mt");
  });

  $("#snote2 i.show_snote2").click(function(){
   $('#snote2 .note-toolbar-wrapper').toggle();
   $('#snote2 .note-editable').toggleClass("mt");
  });
$('#e_m_summernote_1').summernote({height: 631.031});
$('.snote').summernote({height: 50});
var baseurl = '<?php echo base_url(); ?>';

var title = $('title').text() + ' | ' + 'Opportunity List';

$(document).attr("title", title); 
var e_er = 0;
function e_get_sub_lead_source_by_ls_id() {
  var ls = $('#e_ori_lead_source').val();
  $.ajax({
     url:baseurl+'Leads/get_sub_lead_source_by_ls_id',
     type:'POST',
     data:{'value':ls},
     dataType: 'html',
     success:function(result) {
        $('#e_lead_source').empty().append(result);
        $('.m_selectpicker').selectpicker('refresh');
     }
  });
}
function e_email_id_unique(val) 
{
   var o_email_id = $('#o_email_id').val();
   if(o_email_id != val)
   {
       $.ajax({
         type: "POST",
         url:baseurl+'Leads/lead_email_id_exits',
         data:{'value':val},
         async: false,
         dataType: "html",
         success: function(result){
            if(result > 0)
            {
               $('#e_email_id_err').html('Email ID already exists!');
               e_er = 1;
            }else{
               e_er = 0;
            }
            
         }
      });
   }
  
}
function e_product_user_list(val) 
{
   $.ajax({
      type:'POST',
      url:baseurl+'Leads/product_user_list',
      data:{'value':val},
      dataType: 'html',
      success:function(result){
         var valval = result.split("|");
         $('#e_industry_name').val(valval[1]);
         $('#e_industry_id').val(valval[2]);
         $('#e_assigned_to').empty().append(valval[0]);
         $('.m_selectpicker').selectpicker('refresh');

      }
   });
}  
function e_lead_validation()
{
   var err = 0;
   var lead_name = $('#e_lead_name').val();
   var company_name = $('#e_company_name').val();
   var country = $('#e_country').val();
   var designation = $('#e_designation').val();
   var website = $('#e_website').val();
   var address = $('#e_address').val();
   var email_id = $('#e_email_id').val();
   var alternative_email_id = $('#e_alternative_email_id').val();
   var website = $('#e_website').val();
   var skype_id = $('#e_skype_id').val();
   var contact_no = $('#e_contact_no').val();
   var whatsapp_no = $('#e_whatsapp_no').val();
   var office_phone_no = $('#e_office_phone_no').val();
   var product_id = $('#e_product_id').val();
   var lead_source = $('#e_lead_source').val();
   var ori_lead_source = $('#e_ori_lead_source').val();
   var lead_type = $('#e_lead_type').val();
   var lead_status = $('#e_lead_status').val();
   var assigned_to = $('#e_assigned_to').val();
   var message = $('#e_m_summernote_1').val();
   var lead_status = $('#e_lead_status').val();
   if (ori_lead_source == '') {
      $('#e_ori_lead_source_err').html('Lead Source is required!');
      err++;
   }
   else {
      $('#e_ori_lead_source_err').html('');
   }
   if(lead_name == '')
   {
      $('#e_lead_name_err').html('Lead Name is required!');
      err++;
   }else{
      $('#e_lead_name_err').html('');
   }  
   
   if(country == '')
   {
      $('#e_country_err').html('Country is required!');
      err++;
   }else{
      $('#e_country_err').html('');
   } 
   
   if(website != '' && !isUrlValid(website))
   {
       $('#e_website_err').html('Valid Website is required!');
      err++;
   }else{
      $('#e_website_err').html('');
   }
   if (contact_no.trim() == '' && email_id.trim() == '') {
      $('#e_email_id_err').html('Email ID is required!');
      $('#e_contact_no_err').html('Contact No required!');
      err++;
      // if(email_id == '')
      // {
      //       $('#e_email_id_err').html('Email ID is required!');
      //         err++;

      // }else if(!ValidateEmail(email_id)){ 

      //         $('#e_email_id_err').html('Invalid Email ID!');
      //         err++;
      // }else if(e_er > 0){

      //    $('#e_email_id_err').html('Email ID already exists!');
      //    err++;
      // }else if(e_erb > 0){

      //    $('#e_email_id_err').html('This email is Blocked');
      //    err++;
      // }
      // else{
      //   $('#e_email_id_err').html('');
      // }

      // if (contact_no == '') {

      //    $('#e_contact_no_err').html('Contact No required!');
      //      err++;   
      // }
      // else if(contact_no != '' && contact_no.length!=10||contact_no=='0000000000')
      //  { 
      //      $('#e_contact_no_err').html('Contact No should be maxium 10 No!');
      //      err++;
      //  }else if(isNaN(contact_no))
      //  { 
      //      $('#e_contact_no_err').html('Invalid Contact No!');
      //      err++;
      //  }
      //  else{
      //      $('#e_contact_no_err').html('');
      //  }
   }
   else {
      $('#e_email_id_err').html('');
      $('#e_contact_no_err').html('');
      
   }
   if(alternative_email_id != '' && !ValidateEmail(alternative_email_id)){ 

           $('#e_alternative_email_id_err').html('Invalid Email ID!');
           err++;
   }
   else{
     $('#e_alternative_email_id_err').html('');
   }

    if(contact_no != '') {
       if(isNaN(contact_no))
       { 
           $('#e_contact_no_err').html('Invalid Contact No!');
           err++;
       }
       else{
           $('#e_contact_no_err').html('');
           $('#e_email_id_err').html('');
       }
    }
    if(email_id.trim() != ''){
    if(!ValidateEmail(email_id)){ 

              $('#e_email_id_err').html('Invalid Email ID!');
              err++;
      }else if(e_er > 0){

         $('#e_email_id_err').html('Email ID already exists!');
         err++;
      }else if(e_erb > 0){

         $('#e_email_id_err').html('This email is Blocked');
         err++;
      }
      else{
        $('#e_email_id_err').html('');
      }
   }
   if(whatsapp_no != '' && whatsapp_no=='0000000000')
    { 
        $('#e_whatsapp_no_err').html('Invalid Whatsapp No!');
        err++;
    }else if(isNaN(whatsapp_no))
    { 
        $('#e_whatsapp_no_err').html('Invalid Whatsapp No!');
        err++;
    }
    else{
        $('#e_whatsapp_no_err').html('');
    }
      
   if(office_phone_no != '' && office_phone_no=='0000000000')
    { 
        $('#e_office_phone_no_err').html('Invalid Office Contact No!');
        err++;
    }else if(isNaN(office_phone_no))
    { 
        $('#e_office_phone_no_err').html('Invalid Office Contact No!');
        err++;
    }
    else{
        $('#e_office_phone_no_err').html('');
    }
   if(product_id.trim()==''){

      $('#e_product_id_err').html('Product is required!');
      err++;
   }else{
      $('#e_product_id_err').html('');

   }

   if(lead_source.trim()==''){

      $('#e_lead_source_err').html('Sub Lead Source is required!');
      err++;
   }else{
      $('#e_lead_source_err').html('');

   }
    if(lead_type.trim()==''){

      $('#e_lead_type_err').html('Priority is required!');
      err++;
   }else{
      $('#e_lead_type_err').html('');

   }
   if(lead_status.trim()==''){

      $('#e_lead_status_err').html('Lead Status is required!');
      err++;
   }else{
      $('#e_lead_status_err').html('');

   }
   if(assigned_to.trim()==''){

      $('#e_assigned_to_err').html('Assigned To is required!');
      // err++;
   }else{
      $('#e_assigned_to_err').html('');

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
   
   if(err>0){ return false; }else{ return true; }
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