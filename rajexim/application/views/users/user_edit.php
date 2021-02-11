<?php 
   $g_settings = common_select_values('*', 'general_settings', '', 'row');
   $p_title = isset($g_settings->product_title) ? $g_settings->product_title : 'Raj Exim';
   $p_logo  = isset($g_settings->product_logo) ? base_url().'assets/common_images/'.$g_settings->product_logo : base_url().'assets/images/logo.png';
   $p_favicon  = isset($g_settings->favicon) ? base_url().'assets/common_images/'.$g_settings->favicon : base_url().'assets/images/favicon.ico';
  $user_details_basic = login_user_details($_SESSION['admindata']['user_id']);
  $body_class = ($user_details_basic->show_menu == 0) ? "m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default m-brand--minimize m-aside-left--minimize" : "m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"; 
$body_class1 = ($user_details_basic->show_menu == 1) ? "m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop   m-container m-container--responsive m-container--xxl m-page__container m-body" : "m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body"; 
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
.note-editable {
    height: 631.031px;
}
.m-footer--push.m-aside-left--enabled:not(.m-footer--fixed) .m-aside-right, .m-footer--push.m-aside-left--enabled:not(.m-footer--fixed) .m-wrapper {
    margin-bottom: 0px !important;
}
.m-scroll-top {
   display: none !important;
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
                
                <div class="m-content">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="m-portlet m-portlet--mobile">
                          <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                              <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                  Update User
                                </h3>
                              </div>
                            </div>
                            <div class="m-portlet__head-tools">
                              
                            </div>
                          </div>
                          
                          <div class="m-portlet__body">
                     <form method="POST" action="<?php echo base_url(); ?>Users/user_update" enctype="multipart/form-data" onsubmit="return e_user_validation();">
                           <input type="hidden" name="user_id" id="e_user_id" value="<?php echo $user_details->user_id; ?>">
                           <div class="row">
                              <div class="col-lg-6">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <h5 class="text-theme"><b>User Info</b></h5><hr>
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group m-form__group">
                                             <label>Name<span class="text-danger">*</span></label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Name" name="name" id="e_name" maxlength="60" autocomplete="off" value="<?php echo $user_details->name; ?>">
                                             <span class="text-danger" id="e_name_err"></span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label>D.O.B</label>
                                             <input type="text" class="form-control  m-input m-input--square m_datepicker_1" placeholder="Enter D.O.B" readonly="" name="dob" id="e_dob" onclick="e_dob_validation(this.value); " value="<?php echo date('d-m-Y', strtotime($user_details->dob)); ?>">
                                             <span class="text-danger" id="e_dob_err"></span>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label>Gender</label>
                                                <div class="m-radio-inline">
                                                <label class="m-radio m-radio--bold m-radio--success">
                                                <input type="radio" name="gender" id="e_gender_0" value="0" <?php echo ($user_details->gender == 0) ? 'checked' : ''; ?> >Male
                                                <span></span>
                                                </label>
                                                <label class="m-radio m-radio--bold m-radio--success">
                                                <input type="radio" name="gender" id="e_gender_1" value="1" <?php echo ($user_details->gender == 1) ? 'checked' : ''; ?>>Female
                                                <span></span>
                                                </label>
                                             </div>
                                             <span class="text-danger"></span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       
                                       <div class="col-lg-12">
                                          <div class="form-group m-form__group">
                                             <label>Address</label>
                                             <textarea class="form-control" name="address" id="e_address"><?php echo $user_details->address; ?></textarea>
                                             <span class="text-danger" id="e_address_err"></span>
                                          </div>
                                       </div>
                                       
                                    </div>
                                    
                                       <div class="row">

                                       
                                        <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label>Pincode</label>
                                             <input type="text" class="form-control m-input m-input--square"  placeholder="Enter Pincode" maxlength="6" name="pincode" 
                                             id="e_pincode" onipress="isNumber(event, 'pincode_err');" value="<?php echo $user_details->pincode; ?>" onkeypress="isNumber(event, 'e_pincode_err');">
                                             <span class="text-danger" id="e_pincode_err"></span>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label>Contact No</label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact No" name="contact_no" id="e_contact_no" maxlength="12" autocomplete="off" onkeypress="return isNumber(event,'contact_no_err');" value="<?php echo $user_details->contact_no; ?>" onblur="e_unique_contact_no(this.value);">

                                             <input type="hidden" class="form-control m-input m-input--square" placeholder="Enter Contact No" name="" id="o_contact_no" maxlength="12" autocomplete="off"  value="<?php echo $user_details->contact_no; ?>" >

                                             <span class="text-danger" id="e_contact_no_err"></span>
                                          </div>
                                       </div>
                                    </div>
                   
                                    <div class="row">
                                       
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label>User Role<span class="text-danger">*</span></label>                             
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="role_id" id="e_role_id" onchange="e_chk_role_has_lead_auth();">
                                                <option value="">Choose</option>
                                                <?php
                                                   if(!empty($role_lists))
                                                   {
                                                      foreach ($role_lists as $k => $role_list) { if($role_list->status == 0){ ?>
                                                         <option value="<?php echo $role_list->role_id; ?>" <?php if($role_list->role_id == $user_details->role_id){ 
                                                            echo 'selected'; }else{ echo ''; } ?> ><?php echo $role_list->role_name; ?></option>
                                                      <?php } }
                                                   }
                                                ?>
                                             </select>
                                              <span class="text-danger" id="e_role_id_err"></span>

                                          </div>
                                       </div>
                                         <div class="col-lg-6">
                                                <div class="form-group m-form__group" style="display: none;">
                                                  
                                                      <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                                                         <input type="checkbox" name="allow_lead" id="e_allow_lead" value="<?php echo $user_details->allow_lead; ?>" 
                                                         <?php echo ($user_details->allow_lead > 0) ? 'checked' : '' ?>> Allow Lead
                                                         <span></span>
                                                      </label>
                                                   </div>
                                                </div>
                                       </div>
                                       <?php 
                                       $profile = '';

                                       if($user_details->profile_image != '')
                                       {
                                             $profile = base_url().'assets/user_profile/'.$user_details->profile_image;
                                       }else{
                                          $profile = base_url().'assets/images/default_image.jpg'; 
                                       } ?>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <div class="form-group m-form__group">
                                                   <label>User Profile</label>
                                                   <div class="text-center">
                                                      <div class="fileinput fileinput-new" data-provides="fileinput">
                                                         <div class="fileinput-new thumbnail img-file">
                                                           <img src="<?php echo $profile; ?>" width="200" class="img-responsive" height="150" alt="logo">
                                                         </div>
                                                         <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" height="150">
                                                         </div>
                                                         <div class="text-center">
                                                            <span class="btn btn-primary btn-file ">
                                                            <span class="fileinput-new">Select Image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" id="e_user_profile" name="user_profile">
                                                            </span>
                                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                         </div>
                                                         <span class="m-form__help text-danger" id="e_user_profile_err"></span>
                                                         <input type="hidden" name="o_user_profile" id="o_user_profile" value="<?php echo $user_details->profile_image; ?>">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>

                                             <?php 
                                             $signature = '';

                                             if($user_details->signature != '')
                                             {
                                                   $signature = base_url().'assets/user_signature/'.$user_details->signature;
                                             }else{
                                                $signature = base_url().'assets/images/default_image.jpg'; 
                                             } ?>
                                             <div class="col-lg-6">
                                                <div class="form-group m-form__group">
                                                   <label>Signature</label>
                                                   <div class="text-center">
                                                      <div class="fileinput fileinput-new" data-provides="fileinput">
                                                         <div class="fileinput-new thumbnail img-file">
                                                             <img src="<?php echo $signature; ?>" width="200" class="img-responsive" height="150" alt="logo">
                                                         </div>
                                                         <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" height="150">
                                                         </div>
                                                         <div class="text-center">
                                                            <span class="btn btn-primary btn-file ">
                                                            <span class="fileinput-new">Select Image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" id="e_signature" name="signature">
                                                            </span>
                                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                         </div>
                                                         <span class="m-form__help text-danger" id="e_signature_err"></span>
                                                         <input type="hidden" name="o_signature" id="o_signature" value="<?php echo $user_details->signature; ?>">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       

                                       
                                    </div>
                                 
                              </div>
                              <div class="row">
                                 <!-- <div class="col-lg-12">
                                    <h5 class="text-theme"><b>User Emails</b></h5><hr>
                                    <div id="e_users_owned_email_append_block">
                                       <?php if(!empty($users_emails_details)) { 
                                          $i = 1;
                                          foreach ($users_emails_details as $user_own_email) {
                                          ?>
                                          <div class="row" id="e_user_email_block_<?php echo $i; ?>">
                                             <input type="hidden" name="user_owned_emails_id[]" id="user_owned_emails_id" value="<?php echo $user_own_email->user_owned_emails_id; ?>">
                                             <div class="col-lg-11">
                                                <div class="form-group m-form__group"> <label>Email ID</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email ID" name="user_email_id[]" value="<?php echo $user_own_email->user_emails; ?>" id="e_email_id_<?php echo $i; ?>"> <span class="text-danger" id="e_email_id_err_<?php echo $i; ?>"></span> </div>
                                             </div>
                                             <?php if($i != 1){ ?>
                                             <div class="col-lg-1">
                                                <div class="form-group m-form__group mt_25px">
                                                   <button type="button" class="btn btn-danger" onclick="e_remove_user_email_block(e_user_email_block_<?php echo $i; ?>,'<?php echo $i; ?>','<?php echo $user_own_email->user_owned_emails_id; ?>');"><i class="fa fa-minus"></i></button>
                                                </div>
                                             </div>
                                             <?php } ?>
                                          </div>
                                       <?php $i++; } ?>
                                       <input type="hidden" id="e_user_email_block_count" value="<?php echo count($users_emails_details)+1; ?>">
                                    <?php }else { ?>
                                          <div class="row" id="e_user_email_block_1">
                                             <input type="hidden" name="user_owned_emails_id[]" id="user_owned_emails_id" value="0">
                                             <div class="col-lg-11">
                                                <div class="form-group m-form__group"> <label>Email ID</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email ID" name="user_email_id[]" value="" id="e_email_id_1"> <span class="text-danger" id="e_email_id_err_1"></span> </div>
                                             </div>
                                          </div>
                                          <input type="hidden" id="e_user_email_block_count" value="2">
                                    <?php } ?>
                                    </div>
                                    <input type="hidden" id="del_user_owned_email_id" name="del_user_owned_email_id">
                                    <div class="row">
                                       <div class="col-lg-6"></div>
                                       <div class="col-lg-6">
                                          <div class="pull-right">
                                               <div class="form-group m-form__group mt_25px">
                                                  <button type="button" class="btn btn-primary" onclick="e_user_email_add_row();"><i class="fa fa-plus"></i></button>
                                               </div>
                                           </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 
                                 <div class="col-lg-12">
                                    <div class="form-group m-form__group">
                                        <label>Email ID</label>
                                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple id="e_email_id" name="user_email_id[]">
                                           <option>Choose Emails</option>
                                           <?php foreach ($get_all_configured_email as $email_list) { ?>
                                           <option <?php if(in_array($email_list->email_detail_id, $user_owned_email_by_user)) { echo "selected"; } ?> value="<?php echo $email_list->email_detail_id; ?>"><?php echo $email_list->email_ID; ?></option>
                                           <?php } ?>
                                        </select>
                                        <span class="m-form__help text-danger" id="e_email_id_err"></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-12">

                                    <h5 class="text-theme"><b>User Credential</b></h5><hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label>Username<span class="text-danger">*</span></label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Username" name="username" id="e_username" maxlength="60" onblur="e_username_unique(this.value);" value="<?php echo $user_details->username; ?>">
                                             <input type="hidden" class="form-control m-input m-input--square" placeholder="Enter Username" name="username" id="o_username" maxlength="60"  value="<?php echo $user_details->username; ?>">
                                             <span class="m-form__help text-danger" id="e_username_err"></span>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label>Password<span class="text-danger">*</span></label>
                                             <span class="m-input-icon__icon m-input-icon__icon--right" onclick="change_view();" style="height: calc(2.95rem + 2px);"><span style="cursor:pointer;"><i id="close" class="fa fa-eye-slash"></i><i id="open" style="display:none" class="fa fa-eye"></i></span></span>
                                             <input type="password" class="form-control m-input m-input--square" placeholder="Enter Password" name="password" id="e_password" value="<?php echo $pass; ?>">
                                             <span class="m-form__help text-danger" id="e_password_err"></span>
                                          </div>
                                       </div>
                                    </div>

                                    
                                 </div>
                            </div>   
                                    <div id="e_show_lead_user_block" style="display: <?php echo ($user_details->show_leads == 2) ? 'block' : 'block'; ?>;">
                               <h5 class="text-theme"><b>Show Lead Info For User</b></h5><hr>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label>Show Leads</label>&nbsp;&nbsp;<span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Remove Lead Access" style="cursor: pointer;" onclick="rmv_other_lead_accesses()"><i class="fa fa-times-circle"></i></span>
                                                <div class="m-radio-inline">
                                                <label class="m-radio m-radio--bold m-radio--success">
                                                <input type="radio" name="show_leads" id="e_show_leads_1" value="1"  class="show_leads_class" onclick="e_check_show_leads(this.value);" <?php echo ($user_details->show_leads ==1) ? 'checked' : ''; ?> >All Lead
                                                <span></span>
                                                </label>
                                                <label class="m-radio m-radio--bold m-radio--success" style="display: none;">
                                                <input type="radio" name="show_leads" id="e_show_leads_2" value="2" class="show_leads_class" onclick="e_check_show_leads(this.value);" <?php echo ($user_details->show_leads ==2) ? 'checked'  : ''; ?> >My Lead
                                                <span></span>
                                                 </label>
                                                <label class="m-radio m-radio--bold m-radio--success">
                                                <input type="radio" name="show_leads" id="e_show_leads_3" value="3" class="show_leads_class" onclick="e_check_show_leads(this.value);" <?php echo ($user_details->show_leads ==3) ? 'checked' : ''; ?> >Product Users
                                                <span></span>
                                                </label>
                                             </div>
                                             <span class="text-danger" id="e_show_leads_err"></span>
                                          </div>
                                       </div>

                                       <?php
                                          $prd_array = array();
                                           if($user_details->product_users != '')
                                           {
                                             $prd_array = explode(',', $user_details->product_users);
                                           }
                                       ?>
                                        <div class="col-lg-6" style="<?php echo ($user_details->show_leads ==3) ? '' : 'display: none'; ?>" id="e_prd_users_div">
                                          <div class="form-group m-form__group">
                                             <label>Product Users<span class="text-danger">*</span></label>                             
                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple name="product_users[]" id="e_product_users">
                                                <!-- <option value="">Choose</option> -->
                                                <?php
                                                   if(!empty($assigned_user_lists))
                                                   {
                                                      foreach ($assigned_user_lists as  $assigned_user_list) { ?>
                                                         
                                                      <option data-content="<span><b><?php echo $assigned_user_list->name;?></b></span>&nbsp;<span class=testt><span class=text-info><b><sub><?php echo $assigned_user_list->role_name;?></sub><b></span></b></span></span>" value='<?php echo $assigned_user_list->user_id;?>' <?php echo in_array($assigned_user_list->user_id, $prd_array)?'selected':'';?> ><?php echo $assigned_user_list->user_name;?></option><option data-divider="true"></option>
                                                      <?php } 
                                                   }
                                                ?>
                                             </select>
                                              <span class="text-danger" id="e_product_users_err"></span>
                                          </div>
                                       </div>
                                    </div>
                             </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <h5 class="text-theme"><b>User Product Info</b></h5><hr>
                                             <div class="e_user_dynamic">
                                             <?php 

                                             if(!empty($user_product_details))
                                             {
                                                $k=1;$m=0;
                                                foreach ($user_product_details as $user_product_detail) { ?>

                                                   <input type="hidden" name="user_product_id[]" id="user_product_id_<?php echo $k; ?>" 
                                                   value="<?php echo $user_product_detail->user_product_id; ?>">

                                                    
                                                         <div class="row" id="e_user_dynamic_id_<?php echo $k; ?>">
                                                            <div class="col-lg-5">
                                                               <div class="form-group m-form__group">
                                                                  <label>Product Name</label>
                                                                  <select class="form-control m-bootstrap-select m_selectpicker e_prd_class" data-live-search="true" name="ed_product_id[]" 
                                                                  id="ed_product_id_<?php echo $k; ?>" onchange="e_product_email_IDs(this.value, <?php echo $k; ?>);">
                                                                     <option value="">Choose</option>
                                                                     <?php $e_option_val = '<option value="">Choose</option>'; ?> 
                                                                     <?php
                                                                        if(!empty($product_lists))
                                                                        {
                                                                           foreach ($product_lists as $product_list) { if($product_list->status == 0){ ?>
                                                                              <option value="<?php echo $product_list->product_id; ?>" <?php echo ($product_list->product_id == $user_product_detail->product_id) ? 'selected': ''; ?>><?php echo $product_list->product_name; ?></option>
                                                                              <?php $e_option_val .= '<option value="'.$product_list->product_id.'">'.$product_list->product_name.'</option>';?>
                                                                           <?php } }
                                                                        }
                                                                     ?>
                                                                  </select>
                                                                  <input type="hidden" id="oproduct_id_<?php echo $k; ?>" value="<?php echo $user_product_detail->product_id; ?>">
                                                                  <span class="m-form__help text-danger" id="ed_product_id_err_<?php echo $k; ?>"></span>
                                                               </div>
                                                            </div>

                                                            <?php
                                                               $edit_product_emails = common_select_values('GROUP_CONCAT(email_detail_id) as emails', 'user_emails u', ' u.status !=2 AND u.user_id ="'.$user_product_detail->user_id.'" AND  u.product_id = "'.$user_product_detail->product_id.'"', 'row_array');
                                                               $explode_array = array();
                                                               if(!empty($edit_product_emails))
                                                               {
                                                                  $explode_array = explode(',', $edit_product_emails['emails']);

                                                               }
                                                               $product_emails = $this->Product_model->product_emails_by_id($user_product_detail->product_id);
                                                            ?>
                                                            <div class="col-lg-5">
                                                               <div class="form-group m-form__group">
                                                                  <label>Email ID</label>
                                                                  <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple id="ed_email_id_<?php echo $k; ?>" name="ed_email_id[]">
                                                                     <option value="">Choose</option>
                                                                     <?php
                                                                        if(!empty($product_emails))
                                                                        {
                                                                           foreach ($product_emails as $product_email) {  
                                                                              ?>
                                                                              <option value="<?php echo $product_email['product_id']."_".$product_email['email_detail_id']; ?>"
                                                                                 
                                                                                 <?php echo (in_array($product_email['email_detail_id'], $explode_array)) ? 'selected' : '';?>
                                                                                 ><?php echo $product_email['email_name']; ?></option>
                                                                              <?php //$option_val .= '<option value="'.$product_list->product_id.'">'.$product_list->product_name.'</option>';?>
                                                                           <?php } 
                                                                        }
                                                                     ?>
                                                                  </select>
                                                                   <span class="m-form__help text-danger" id="ed_email_id_err_<?php echo $k; ?>"></span>
                                                               </div>
                                                            </div>
                                                            <?php if($k != 1) {  ?>
                                                            <div class="col-lg-2"><div class="pull-right"><div class="form-group m-form__group mt_25px"><button type="button" class="btn btn-danger" onclick="remove_user_prod('e_user_dynamic_id_<?php echo $k; ?>', <?php echo $k; ?> , '<?php echo $user_product_detail->product_id."_".$user_product_detail->user_product_id; ?>');"><i class="fa fa-minus"></i></button></div></div></div>
                                                            <?php } ?>
                                                         </div>
                                                    
                                               <?php $k++; $m++; }  ?>
                                          <?php }else{ ?>
                                          <div class="row" id="e_user_dynamic_id_0">
                                                    <div class="col-lg-6">
                                                       <div class="form-group m-form__group">
                                                          <label>Product Name</label>
                                                          <select class="form-control m-bootstrap-select m_selectpicker prd_class" data-live-search="true" name="ed_product_id[]" 
                                                          id="ed_product_id_0" onchange="e_product_email_IDs(this.value, 0);;">
                                                             <option value="">Choose</option>
                                                             <?php $e_option_val = '<option value="">Choose</option>'; ?> 
                                                             <?php
                                                                if(!empty($product_lists))
                                                                {
                                                                   foreach ($product_lists as $key => $product_list) { if($product_list->status == 0){ ?>
                                                                      <option value="<?php echo $product_list->product_id; ?>" ><?php echo $product_list->product_name; ?></option>
                                                                      <?php $e_option_val .= '<option value="'.$product_list->product_id.'">'.$product_list->product_name.'</option>';?>
                                                                   <?php } }
                                                                }
                                                             ?>
                                                          </select>
                                                          <span class="m-form__help text-danger" id="ed_product_id_err_0"></span>
                                                       </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                       <div class="form-group m-form__group">
                                                          <label>Email ID</label>
                                                          <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple 
                                                          id="ed_email_id_0" name="ed_email_id[]">
                                                             <option>Choose</option>
                                                          </select>
                                                           <span class="m-form__help text-danger" id="ed_email_id_err_0"></span>
                                                       </div>
                                                    </div>
                                                 </div>
                                          <?php }?>
                                             </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="pull-right">
                                             <div class="form-group m-form__group mt_25px">
                                                <button type="button" class="btn btn-primary" onclick="e_user_add_row();"><i class="fa fa-plus"></i></button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <input type="hidden" name="indus_dynamic_val" id="e_user_dynamic_val" value="<?php echo $k; ?>">
                                    <input type="hidden" id="len" value="<?php echo $m;?>">
                                 </div>
                              </div>
                              
                           
                           <input type="hidden" name="del_user_product_id" id="del_user_product_id" value="">
                           <input type="hidden" id='visible_type' name="visible_type" value="hide">
                        <div class="row">
                           <div class="col-lg-10"></div>
                           <div class="col-lg-1"><button type="submit" class="btn btn-primary" id="e_btnsubmit">Save Changes</button></div>
                        </div>
                     </form>
                  </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div id="mycalculator"></div>
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
<script type="text/javascript">
window.onunload = refreshParenttriggerAlertOnParent;
function refreshParenttriggerAlertOnParent() {
    //window.opener.location.hash = "showAlert";
    window.opener.location.reload();
    window.close();
}
$('.m_selectpicker').selectpicker();
var baseurl = '<?php echo base_url(); ?>';

         // To get product email ids
function e_product_email_IDs(val, v)
{
   var value = val;
   var o_value = $('#oproduct_id_'+v).val();
   var alreadyprod = 0;
   var prod = $('select[id^="ed_product_id_"]').length;
   if(value != '')
   {
      for(var i=0;i<prod;i++)
      {
          var prodval = $("#ed_product_id_"+i).val();
          if(v!=i && value == prodval)
          {
              alreadyprod++;
          }
      }
      if(alreadyprod > 0)
      {
         $("#ed_product_id_"+v).val('');
         $('#ed_product_id_'+v).selectpicker('refresh');
          alert("Product Name already selected!");
      }else{

            if(o_value != value)
            {
               $.ajax({
                   type: "POST",
                   url: baseurl+'Users/product_email_ID_by_product_id',
                   data: "val="+value,
                   success: function(response) 
                   { 
                     $('#ed_email_id_'+v).empty().append(response);
                     $('#ed_email_id_'+v).selectpicker('refresh');
                     
                   }
                });
               
            }else{
               $("#ed_product_id_"+v).val('');
               alert("Product Name already selected!");
            }
            //e_product_users(); 
      }
   }
}

function rmv_other_lead_accesses()
{
  $('input[name="show_leads"]').each(function(){
      $(this).prop('checked', false);
  });
  $("#e_show_leads_2").prop('checked', true);
  $( "#e_prd_users_div").hide();
  // $("#show_leads_2").attr('checked', 'checked');
}

         function change_view() 
         {
            var show = $("#visible_type").val();
               if (show == "hide") 
               {
               $("#e_password").attr("type", "text");
               $("#open").show();
               $("#close").hide();
               $("#visible_type").val('show');
            }
            else
            {
               $("#visible_type").val('hide');
               $("#e_password").attr("type", "password");
               $("#close").show();
               $("#open").hide();
               }  
         }

 function e_user_add_row()
{
  var option_val = '<?php echo $e_option_val; ?>';
  var user_dynamic_val = $('#e_user_dynamic_val').val();

  var user_dynamic = $('.e_user_dynamic');
  user_dynamic.append('<div class="row" id="e_user_dynamic_id_'+user_dynamic_val+'"><div class="col-lg-5"><div class="form-group m-form__group"><label>Product Name</label><select class="form-control m-bootstrap-select m_selectpicker e_prd_class" data-live-search="true" name="ed_product_id[]" id="ed_product_id_'+user_dynamic_val+'" onchange="e_product_email_IDs(this.value,'+user_dynamic_val+');">'+option_val+'</select></div></div><div class="col-lg-5"><div class="form-group m-form__group"><label>Email ID</label><select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple id="ed_email_id_'+user_dynamic_val+'" name="ed_email_id[]"></select><span class="m-form__help text-danger" id="ed_email_id_err_'+user_dynamic_val+'"></span></div></div><div class="col-lg-2"><div class="pull-right"><div class="form-group m-form__group mt_25px"><button class="btn btn-danger" type="button" onclick="e_remove_user_product(e_user_dynamic_id_'+user_dynamic_val+','+user_dynamic_val+');"><i class="fa fa-minus"></i></button></div></div></div> </div>');
  user_dynamic_val = Number(user_dynamic_val)+1;
  $('#e_user_dynamic_val').val(user_dynamic_val);
   $('.m_selectpicker').selectpicker();
   //e_product_users();
}

function e_remove_user_product(id)
{
  $(id).remove();
  //e_product_users();
}
function remove_user_prod(id,val,u_prd_id)
 {
    $('#'+id).remove();
    if (u_prd_id != 0) {

      if($('#del_user_product_id').val()!= '')
        {
         var del_id = $('#del_user_product_id').val()+","+u_prd_id;
        } 
        else{
          del_id = u_prd_id;
        }
       
       $('#del_user_product_id').val(del_id);
    }

    //e_product_users();
 }


// To check username unique
var e_u_err = 0;
function e_username_unique(val)
{
   var o_val = $('#o_username').val();
   if(o_val != val)
   {
      $.ajax({
       type: "POST",
       url: baseurl+'Users/username_unique',
       data: "val="+val,
       success: function(response) 
       { 
         if(response > 0){ e_u_err++; $('#e_username_err').html('Username already exists!'); }else{e_u_err = 0; $('#e_username_err').html('');}
       }
    });
   }
   
}

var e_u_cno_err = 0;
function e_unique_contact_no(val)
{
  if(val!='')
  {
     var o_cno = $('#o_contact_no').val();
     if(o_cno != val)
     {
        $.ajax({
            type: "POST",
            url: baseurl+'Users/user_contact_no_unique',
            data: "val="+val,
            success: function(response) 
            { 
              if(response > 0){ e_u_cno_err++; $('#e_contact_no_err').html('Contact No already exists!'); }else{e_u_cno_err = 0; $('#e_contact_no_err').html('');}
            }
        });
     }
   }
   
}
var dob_err = 0;
function dob_validation(val)
{
   $.ajax({
       type: "POST",
       url: baseurl+'Profiles/dob_validation',
       data: "dob="+val,
       success: function(response) {   

         if(response > 0) 
         {
            $('#e_dob_err').html('Date of Birth should be above +18 years!');
            dob_err = 1;
         }
         else{
            $('#e_dob_err').html('');
            
         }
       }
    });
}
function e_user_validation()
{  

   var err = 0;
   var name = check_input_empty_values($('#e_name').val(), 'e_name_err', 'Name');
   //var dob = check_input_empty_values($('#e_dob').val(), 'e_dob_err', 'D.O.B'); 
   //var contact_no = check_input_empty_values($('#e_contact_no').val(), 'e_contact_no_err', 'Contact No'); 
   var contact_no = $('#e_contact_no').val(); 
   //var address = check_input_empty_values($('#e_address').val(), 'e_address_err', 'Address');
   var role_id = check_input_empty_values($('#e_role_id').val(), 'e_role_id_err', 'User Role');
   //var pincode = check_input_empty_values($('#e_pincode').val(), 'e_pincode_err', 'Pincode');
   var username = check_input_empty_values($('#e_username').val(), 'e_username_err', 'Username');
   var password = check_input_empty_values($('#e_password').val(), 'e_password_err', 'Password');
   var email_id = $('#e_email_id').val();
   if(name){ err++; } 

   if(dob_err > 0)
    {
      $('#e_dob_err').html('Date of Birth should be above +18 years!');
      err++;
    }else{
      $('#e_dob_err').html('');
    }

    // if(contact_no!='' && (contact_no.length > 10 || contact_no.length < 10))
    // {
    //     $('#e_contact_no_err').html('Contact No should be 10 digits only!');
    //     err++;
    // }
    if(e_u_cno_err> 0)
    {
      $('#e_contact_no_err').html('Contact No already exists!');
      err++;
    }
    else
    {
      $('#e_contact_no_err').html('');
    }

   // $('input[id^="e_email_id_"]').each(function(){
   //      var id = this.id;
   //      var l_id = id.substring(11);
        
   //      var email_id = $('#e_email_id_'+l_id+'').val();
        
   //      if(email_id !='' && !ValidateEmail(email_id)){ 
   //         $('#e_email_id_err_'+l_id).html('Invalid Email ID!');
   //         err++;
   //     }else{
   //         $('#e_email_id_err_'+l_id).html('');
   //     }
   //   });
    //if(address){ err++; }
    if(role_id){ err++; }
    //if(pincode){ err++; }
    if(username)
    { 
      err++; 
    }
    else if(e_u_err > 0)
    { 
      $('#e_username_err').html('Username already exists!');
               err++; 
   }else{ $('#e_username_err').html(''); }

    if(password){ err++; }

   $("select[id^='ed_product_id_']").each(function(){
      var id = this.id;
      var res = id.substring(14);
      if($('#ed_product_id_'+res).val() != '')
      {  
         
         if($('#ed_email_id_'+res).val() == '')
         {  
            $('#ed_email_id_err_'+res).html('Select Email ID!');
               err++;
         }else{
            $('#ed_email_id_err_'+res).html('');
         }
      }else{
         $('#ed_email_id_err_'+res).html('');
      }
      
   });

   if ($('input[name=show_leads]:checked').val() == null)      
   {
      $('#e_show_leads_err').html('Show Leads is required!');
      err++;
   }
   else if($('input[name=show_leads]:checked').val() == 3)
   {
      if($('#e_product_users').val() == '')
      {
         $('#e_product_users_err').html('Product Users is required!');
         err++;
      }else{
         $('#e_product_users_err').html('');
      }
   }  
   else{
      $('#e_show_leads_err').html('');
      $('#e_product_users_err').html('');
   }
   if(err>0){ return false }else{ return true; }
}
function e_check_show_leads(val)
{
  if(val == 3)
  {
    $( "#e_prd_users_div").show();  
     //e_product_users();
  }else{
    $( "#e_prd_users_div").hide();
  }
}
//e_product_users();
function e_product_users()
{

   var prd_id = '';
   var user_id = $('#e_user_id').val();
   $("select[id^='ed_product_id_']").each(function(){

      var id = this.id;
      var res = id.substring(14);
      if($('#ed_product_id_'+res).val() != '')
      {  
         prd_id += $('#ed_product_id_'+res).val()+',';
      }else{
         prd_id = '';
      }
   });
   $.ajax({
       type: "POST",
       url: baseurl+'Users/users_by_product_id',
       data: "prd_id="+prd_id+"&user_id="+user_id,
       success: function(response) 
       { 
         $('#e_product_users').empty().append(response);
         $('.m_selectpicker').selectpicker('refresh');
       }
    });
}

$( "#e_allow_lead" ).click(function() 
{
    if(this.checked){
        $("#e_allow_lead" ).val(1);
    }
    if(!this.checked){
        $("#e_allow_lead" ).val(0);
    }
});
e_chk_role_has_lead_auth();
function e_chk_role_has_lead_auth()
{
   var role = $('#e_role_id').val();
   $.ajax({
      type:'POST',
      url:baseurl+'Users/chk_role_has_lead_auth',
      data:{'val':role},
      dataType: 'html',
      success:function(result){
         if (result == '1') {
            $('#e_show_lead_user_block').show();
         }
         else {
            $('#e_show_lead_user_block').hide();
         }
      }
   })
}
</script>
<!-- Update Lead Status-->
</body>

   <!-- end::Body -->

</html>