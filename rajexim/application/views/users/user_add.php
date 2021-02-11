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
                                  Add User
                                </h3>
                              </div>
                            </div>
                            <div class="m-portlet__head-tools">
                              
                            </div>
                          </div>
                          
                          <div class="m-portlet__body">
                            <form method="POST" action="<?php echo base_url(); ?>Users/user_save" enctype="multipart/form-data" onsubmit="return user_validation();">
                                      <div class="row">
                                        <div class="col-lg-6">
                                          <div class="row">
                                          <div class="col-lg-12">
                                                <h5 class="text-theme"><b>User Info</b></h5><hr>
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <div class="form-group m-form__group">
                                                         <label>Name<span class="text-danger">*</span></label>
                                                         <input type="text" class="form-control m-input m-input--square" placeholder="Enter Name" name="name" id="name" maxlength="60" autocomplete="off">
                                                         <span class="text-danger" id="name_err"></span>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <div class="form-group m-form__group">
                                                         <label>D.O.B</label>
                                                         <input type="text" class="form-control  m-input m-input--square m_datepicker_1" placeholder="Enter D.O.B" readonly="" name="dob" id="dob" onclick="dob_validation(this.value); ">
                                                         <span class="text-danger" id="dob_err"></span>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group m-form__group">
                                                         <label>Gender</label>
                                                            <div class="m-radio-inline">
                                                            <label class="m-radio m-radio--bold m-radio--success">
                                                            <input type="radio" name="gender" checked id="gender_0" value="0">Male
                                                            <span></span>
                                                            </label>
                                                            <label class="m-radio m-radio--bold m-radio--success">
                                                            <input type="radio" name="gender" id="gender_1" value="1">Female
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
                                                         <textarea class="form-control" name="address" id="address" placeholder="Enter Address"></textarea>
                                                         <span class="text-danger" id="address_err"></span>
                                                      </div>
                                                   </div>
                                                </div>
                                                 
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                     <div class="form-group m-form__group">
                                                         <label>Pincode</label>
                                                         <input type="text" class="form-control m-input m-input--square"  placeholder="Enter Pincode" maxlength="6" name="pincode" 
                                                         id="pincode" onkeypress="isNumber(event, 'pincode_err');">
                                                         <span class="text-danger" id="pincode_err"></span>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group m-form__group">
                                                         <label>Contact No</label>
                                                         <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact No" name="contact_no" id="contact_no" maxlength="12" autocomplete="off" onkeypress="return isNumber(event,'contact_no_err');" onblur="unique_contact_no(this.value);">
                                                         <span class="text-danger" id="contact_no_err"></span>
                                                      </div>
                                                   </div>
                                        </div>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <div class="form-group m-form__group">
                                                         <label>User Role<span class="text-danger">*</span></label>                             
                                                         <select class="form-control m-bootstrap-select m_selectpicker" onchange="chk_role_has_lead_auth();" data-live-search="true" name="role_id" id="role_id">
                                                            <option value="">Choose</option>
                                                            <?php
                                                               if(!empty($role_lists))
                                                               {
                                                                  foreach ($role_lists as $key => $role_list) { if($role_list->status == 0){ ?>
                                                                     <option value="<?php echo $role_list->role_id; ?>" ><?php echo $role_list->role_name; ?></option>
                                                                  <?php } }
                                                               }
                                                            ?>
                                                         </select>
                                                          <span class="text-danger" id="role_id_err"></span>
                                                      </div>
                                                   </div>
                                                    <div class="col-lg-6">
                                                      <div class="form-group m-form__group" style="display: none">
                                                            <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                                                               <input type="checkbox" name="allow_lead" id="allow_lead" checked value="1"> Allow Lead
                                                               <span></span>
                                                            </label>
                                                         </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                   <div class="col-lg-6">
                                                      <div class="form-group m-form__group">
                                                         <label>User Profile</label>
                                                         <div class="text-center">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                               <div class="fileinput-new thumbnail img-file">
                                                                  <img src="<?php echo base_url();?>assets/images/default_image.jpg" width="200" class="img-responsive" height="150" alt="logo">
                                                               </div>
                                                               <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" height="150">
                                                               </div>
                                                               <div class="text-center">
                                                                  <span class="btn btn-primary btn-file ">
                                                                  <span class="fileinput-new">Select Image</span>
                                                                  <span class="fileinput-exists">Change</span>
                                                                  <input type="file" id="user_profile" name="user_profile">
                                                                  </span>
                                                                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                               </div>
                                                               <span class="m-form__help text-danger" id="user_profile_err"></span>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>


                                                   <div class="col-lg-6">
                                                      <div class="form-group m-form__group">
                                                         <label>Signature</label>
                                                         <div class="text-center">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                               <div class="fileinput-new thumbnail img-file">
                                                                   <img src="<?php echo base_url();?>assets/images/default_image.jpg" width="200" class="img-responsive" height="150" alt="logo">
                                                               </div>
                                                               <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" height="150">
                                                               </div>
                                                               <div class="text-center">
                                                                  <span class="btn btn-primary btn-file ">
                                                                  <span class="fileinput-new">Select Image</span>
                                                                  <span class="fileinput-exists">Change</span>
                                                                  <input type="file" id="signature" name="signature">
                                                                  </span>
                                                                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                               </div>
                                                               <span class="m-form__help text-danger" id="signature_err"></span>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-12">
                                              <div class="form-group m-form__group">
                                                    <label>Email ID</label>
                                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple id="email_id" name="user_email_id[]">
                                                       <option>Choose Emails</option>
                                                       <?php foreach ($get_all_configured_email as $email_list) { ?>
                                                       <option value="<?php echo $email_list->email_detail_id; ?>"><?php echo $email_list->email_ID; ?></option>
                                                       <?php } ?>
                                                    </select>
                                                    <span class="m-form__help text-danger" id="email_id_err"></span>
                                                </div>
                                              
                                                <!-- <h5 class="text-theme"><b>User Emails</b></h5><hr>
                                                <div id="users_owned_email_append_block">
                                                  <div class="row" id="user_email_block_1">
                                                       <div class="col-lg-11">
                                                        <div class="form-group m-form__group">
                                                           <label>Email ID</label>
                                                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email ID" name="user_email_id[]" id="email_id_1">
                                                           <span class="text-danger" id="email_id_err_1"></span>
                                                        </div>
                                                     </div>
                                                  </div>
                                              </div>
                                                <input type="hidden" id="user_email_block_count" value="2">
                                                <div class="row">
                                                  <div class="col-lg-6"></div>
                                                  <div class="col-lg-6">
                                                    <div class="pull-right">
                                                          <div class="form-group m-form__group mt_25px">
                                                             <button type="button" class="btn btn-primary" onclick="user_email_add_row();"><i class="fa fa-plus"></i></button>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div> -->
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <h5 class="text-theme"><b>User Credential</b></h5><hr>
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <div class="form-group m-form__group">
                                                         <label>Username<span class="text-danger">*</span></label>
                                                         <input type="text" class="form-control m-input m-input--square" placeholder="Enter Username" name="username" id="username" maxlength="60" onblur="username_unique(this.value);">
                                                         <span class="m-form__help text-danger" id="username_err"></span>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <div class="form-group m-form__group">
                                                         <label>Password<span class="text-danger">*</span></label>
                                                         <span class="m-input-icon__icon m-input-icon__icon--right" onclick="change_view();" style="height: calc(2.95rem + 2px);"><span style="cursor:pointer;"><i id="close" class="fa fa-eye-slash"></i><i id="open" style="display:none" class="fa fa-eye"></i></span></span>
                                                         <input type="password" class="form-control m-input m-input--square" placeholder="Enter Password" name="password" id="password">
                                                         <span class="m-form__help text-danger" id="password_err"></span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div id="show_lead_user_block" style="display: none;">
                                            <h5 class="text-theme"><b>Show Lead Info For User</b></h5><hr>
                                            <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group m-form__group">
                                                           <label>Show Leads</label>&nbsp;&nbsp;<span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Remove Lead Access" style="cursor: pointer;" onclick="rmv_other_lead_accesses()"><i class="fa fa-times-circle"></i></span>
                                                              <div class="m-radio-inline">
                                                              <label class="m-radio m-radio--bold m-radio--success">
                                                              <input type="radio" name="show_leads" id="show_leads_1" value="1"  class="show_leads_class" onclick="check_show_leads(this.value);">All Lead
                                                              <span></span>
                                                              </label>
                                                              <label class="m-radio m-radio--bold m-radio--success" style="display: none;">
                                                              <input type="radio" checked name="show_leads" id="show_leads_2" value="2" class="show_leads_class" onclick="check_show_leads(this.value);" >My Lead
                                                              <span></span>
                                                               </label>
                                                              <label class="m-radio m-radio--bold m-radio--success">
                                                              <input type="radio" name="show_leads" id="show_leads_3" value="3" class="show_leads_class" onclick="check_show_leads(this.value);" >Product Users
                                                              <span></span>
                                                              </label>
                                                           </div>
                                                           <span class="text-danger" id="show_leads_err"></span>
                                                        </div>
                                                     </div>

                                                      <div class="col-lg-6" style="display: none;" id="prd_users_div">
                                                        <div class="form-group m-form__group">
                                                           <label>Product Users<span class="text-danger">*</span></label>                             
                                                           <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple name="product_users[]" id="product_users">
                                                              <!-- <option value="">Choose</option> -->
                                                              <?php
                                                                 if(!empty($assigned_user_lists))
                                                                 {
                                                                    foreach ($assigned_user_lists as  $assigned_user_list) { ?>
                                                                       
                                                                    <option data-content="<span><b><?php echo $assigned_user_list->name;?></b></span>&nbsp;<span class=testt><span class=text-info><b><sub><?php echo $assigned_user_list->role_name;?></sub><b></span></b></span></span>" value='<?php echo $assigned_user_list->user_id;?>' ><?php echo $assigned_user_list->user_name;?></option><option data-divider="true"></option>
                                                                    <?php } 
                                                                 }
                                                              ?>
                                                           </select>
                                                            <span class="text-danger" id="product_users_err"></span>
                                                        </div>
                                                     </div>
                                                     
                                             </div>
                                          </div>
                                       
                                          <input type="hidden" id='visible_type' name="visible_type" value="hide">
                                          </div>

                                          <div class="col-lg-6">
                                            <h5 class="text-theme"><b>User Product Info</b></h5><hr>
                                              <div class="user_dynamic">
                                                 <div class="row" id="user_dynamic_id_0">
                                                    <div class="col-lg-6">
                                                       <div class="form-group m-form__group">
                                                          <label>Product Name</label>
                                                          <select class="form-control m-bootstrap-select m_selectpicker prd_class" data-live-search="true" name="product_id[]" 
                                                          id="product_id_0" onchange="product_email_IDs(0);">
                                                             <option value="">Choose</option>
                                                             <?php $option_val = '<option value="">Choose</option>'; ?> 
                                                             <?php
                                                                if(!empty($product_lists))
                                                                {
                                                                   foreach ($product_lists as $key => $product_list) { if($product_list->status == 0){ ?>
                                                                      <option value="<?php echo $product_list->product_id; ?>" ><?php echo $product_list->product_name; ?></option>
                                                                      <?php $option_val .= '<option value="'.$product_list->product_id.'">'.$product_list->product_name.'</option>';?>
                                                                   <?php } }
                                                                }
                                                             ?>
                                                          </select>
                                                          <span class="m-form__help text-danger" id="product_id_err_0"></span>
                                                       </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                       <div class="form-group m-form__group">
                                                          <label>Email ID</label>
                                                          <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple 
                                                          id="p_email_id_0" name="email_id[]">
                                                             <option>Choose</option>
                                                          </select>
                                                           <span class="m-form__help text-danger" id="p_email_id_err_0"></span>
                                                       </div>
                                                    </div>
                                                 </div>
                                            </div>

                                              <div class="row">
                                                 <div class="col-lg-12">
                                                    <div class="pull-right">
                                                       <div class="form-group m-form__group mt_25px">
                                                          <button type="button" class="btn btn-primary" onclick="user_add_row();"><i class="fa fa-plus"></i></button>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                              <input type="hidden" name="indus_dynamic_val" id="user_dynamic_val" value="1">
                                          </div>
                                      </div>
                                       <div class="row">
                                        <div class="col-lg-10"></div>
                                        <div class="col-lg-2"><button type="submit" id="btnsubmit" class="btn btn-primary">Create</button></div>
                                       </div>
                                </form>
                            <!--begin: Datatable -->
                            
                          </div>
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
<script>
window.onunload = refreshParenttriggerAlertOnParent;
function refreshParenttriggerAlertOnParent() {
    //window.opener.location.hash = "showAlert";
    window.opener.location.reload();
    window.close();
}
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'User List';
$(document).attr("title", title);

$('#dob').datepicker({

  format : 'dd-mm-yyyy'
});
// To validate user profile
$("#user_profile").change(function() {

  var ext = document.getElementById('user_profile').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#btnsubmit').prop('disabled', true);
            $('#user_profile_err').html('Upload file allows only file types of GIF, PNG, JPG and JPEG');
            error++;
        }else{
            $('#btnsubmit').prop('disabled', false);
            $('#user_profile_err').html('');
            error=0;
        }
    }else{  $('#btnsubmit').prop('disabled', false);
            $('#user_profile_err').html(''); error=0; }
});

// To validate signature
$("#signature").change(function() {

  var ext = document.getElementById('signature').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#btnsubmit').prop('disabled', true);
            $('#signature_err').html('Upload file allows only file types of GIF, PNG, JPG and JPEG');
            error++;
        }else{
            $('#btnsubmit').prop('disabled', false);
            $('#signature_err').html('');
            error=0;
        }
    }else{  $('#btnsubmit').prop('disabled', false);
            $('#signature_err').html(''); error=0; }
});


// To validate user profile
$("#e_user_profile").change(function() {

  var ext = document.getElementById('e_user_profile').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#e_btnsubmit').prop('disabled', true);
            $('#e_user_profile_err').html('Upload file allows only file types of GIF, PNG, JPG and JPEG');
            error++;
        }else{
            $('#e_btnsubmit').prop('disabled', false);
            $('#user_profile_err').html('');
            error=0;
        }
    }else{  $('#e_btnsubmit').prop('disabled', false);
            $('#user_profile_err').html(''); error=0; }
});

// To validate signature
$("#e_signature").change(function() {

  var ext = document.getElementById('e_signature').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#e_btnsubmit').prop('disabled', true);
            $('#e_signature_err').html('Upload file allows only file types of GIF, PNG, JPG and JPEG');
            error++;
        }else{
            $('#e_btnsubmit').prop('disabled', false);
            $('#e_signature_err').html('');
            error=0;
        }
    }else{  $('#e_btnsubmit').prop('disabled', false);
            $('#e_signature_err').html(''); error=0; }
});
function rmv_other_lead_accesses()
{
  $('input[name="show_leads"]').each(function(){
      $(this).prop('checked', false);
  });
  $("#show_leads_2").prop('checked', true);
  $( "#prd_users_div").hide();
  // $("#show_leads_2").attr('checked', 'checked');
}
function user_login_history(u_id)
{
  $.ajax({
      type: "POST",
      url: baseurl+'Users/get_user_login_history',
      data: "u_id="+u_id,
      success: function(response) {   
        $('#user_login_history').empty().append(response);
        $('#user_login_history').modal('show');
      }
    }); 
}
function change_view() 
{
  var show = $("#visible_type").val();
    if (show == "hide") 
    {
    $("#password").attr("type", "text");
    $("#open").show();
    $("#close").hide();
    $("#visible_type").val('show');
  }
  else
  {
    $("#visible_type").val('hide');
    $("#password").attr("type", "password");
    $("#close").show();
    $("#open").hide();
    } 
}
// To validate dob
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
          $('#dob_err').html('Date of Birth should be above +18 years!');
          dob_err = 1;
        }
        else{
          $('#dob_err').html('');
          
        }
      }
    });
}
// To get product email ids
function product_email_IDs(v)
{
  var value = $('#product_id_'+v).val();
  var alreadyprod = 0;
  var prod = $('select[id^="product_id_"]').length;
  if(value != '')
  {
    for(var i=0;i<prod;i++)
    {
        var prodval = $("#product_id_"+i).val();
        if(v!=i && value == prodval)
        {
            alreadyprod++;
        }
    }
    if(alreadyprod > 0)
    {
      $("#product_id_"+v).val('');
        alert("Product Name already selected!");
    }else{
          $.ajax({
          type: "POST",
          url: baseurl+'Users/product_email_ID_by_product_id',
          data: "val="+value,
          success: function(response) 
          { 
            $('#p_email_id_'+v).empty().append(response);
            $('.m_selectpicker').selectpicker('refresh');
          }
        });

       
    }
  }
  //product_users();
}

// To get product users
function product_users()
{

  var prd_id = '';

  $("select[id^='product_id']").each(function(){

    var id = this.id;
    var res = id.substring(11);
    if($('#product_id_'+res).val() != '')
    { 
      prd_id += $('#product_id_'+res).val()+',';
    }else{
      prd_id = '';
    }
    
  });

  $.ajax({
      type: "POST",
      url: baseurl+'Users/users_by_product_id',
      data: "prd_id="+prd_id+"&user_id=''",
      success: function(response) 
      { 
        $('#product_users').empty().append(response);
        $('.m_selectpicker').selectpicker('refresh');
      }
    });

}


function user_add_row()
{
  var option_val = '<?php echo $option_val; ?>';
  var user_dynamic_val = $('#user_dynamic_val').val();
  var user_dynamic = $('.user_dynamic');
  user_dynamic.append('<div class="row" id="user_dynamic_id_'+user_dynamic_val+'"><div class="col-lg-6"><div class="form-group m-form__group"><label>Product Name</label><select class="form-control m-bootstrap-select m_selectpicker prd_class" data-live-search="true" name="product_id[]" id="product_id_'+user_dynamic_val+'" onchange="product_email_IDs('+user_dynamic_val+');">'+option_val+'</select></div></div><div class="col-lg-4"><div class="form-group m-form__group"><label>Email ID</label><select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple id="p_email_id_'+user_dynamic_val+'" name="email_id[]"></select><span class="m-form__help text-danger" id="p_email_id_err_'+user_dynamic_val+'"></span></div></div><div class="col-lg-2"><div class="pull-right"><div class="form-group m-form__group mt_25px"><button class="btn btn-danger" onclick="remove_user_product(user_dynamic_id_'+user_dynamic_val+','+user_dynamic_val+');"><i class="fa fa-minus"></i></button></div></div></div> </div>');
  user_dynamic_val = Number(user_dynamic_val)+1;
  $('#user_dynamic_val').val(user_dynamic_val);
   $('.m_selectpicker').selectpicker();
}
function remove_user_product(id,val)
{
  $(id).remove();
  //product_users();

}

function user_email_add_row() {
  var user_mail_inc = $('#user_email_block_count').val();
  var user_email_append = $('#users_owned_email_append_block');
  user_email_append.append('<div class="row" id="user_email_block_'+user_mail_inc+'">  <div class="col-lg-11"> <div class="form-group m-form__group"> <label>Email ID</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email ID" name="user_email_id[]" id="email_id_'+user_mail_inc+'"> <span class="text-danger" id="email_id_err_'+user_mail_inc+'"></span> </div> </div> <div class="col-lg-1"> <div class="form-group m-form__group mt_25px"><button type="button" class="btn btn-danger" onclick="remove_user_email_block(user_email_block_'+user_mail_inc+','+user_mail_inc+');"><i class="fa fa-minus"></i></button></div> </div> </div>');
  user_mail_inc = Number(user_mail_inc)+1;
  $('#user_email_block_count').val(user_mail_inc);
}
function remove_user_email_block(id,val)
{
  $(id).remove();
}

function e_user_email_add_row() {
  var user_mail_inc = $('#e_user_email_block_count').val();
  var user_email_append = $('#e_users_owned_email_append_block');
  user_email_append.append('<div class="row" id="e_user_email_block_'+user_mail_inc+'"> <input type="hidden" name="user_owned_emails_id[]" id="e_user_owned_emails_id" value="0"> <div class="col-lg-11"> <div class="form-group m-form__group"> <label>Email ID</label> <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email ID" name="user_email_id[]" id="e_email_id_'+user_mail_inc+'"> <span class="text-danger" id="e_email_id_err_'+user_mail_inc+'"></span> </div> </div> <div class="col-lg-1"> <div class="form-group m-form__group mt_25px"><button type="button" class="btn btn-danger" onclick="e_remove_user_email_block(e_user_email_block_'+user_mail_inc+','+user_mail_inc+',0);"><i class="fa fa-minus"></i></button></div> </div> </div>');
  user_mail_inc = Number(user_mail_inc)+1;
  $('#e_user_email_block_count').val(user_mail_inc);
}
function e_remove_user_email_block(id,val,user_own_email_id)
{
    $(id).remove();
    if (user_own_email_id != 0) {
        var del_user_email_id = $('#del_user_owned_email_id').val()+','+user_own_email_id;
        $('#del_user_owned_email_id').val(del_user_email_id);
     }
}
var u_cno_err = 0;
function unique_contact_no(val)
{
  if(val!='')
  {
    $.ajax({
        type: "POST",
        url: baseurl+'Users/user_contact_no_unique',
        data: "val="+val,
        success: function(response) 
        { 
          if(response > 0){ u_cno_err++; $('#contact_no_err').html('Contact No already exists!'); }else{u_cno_err=0; $('#contact_no_err').html('');}
        }
      });
  }
}
// To check username unique
var u_err = 0;
function username_unique(val)
{
  $.ajax({
      type: "POST",
      url: baseurl+'Users/username_unique',
      data: "val="+val,
      success: function(response) 
      { 
        if(response > 0){ u_err++; $('#username_err').html('Username already exists!'); }else{ u_err=0; $('#username_err').html('');}
      }
    });
}

function user_validation()
{ 
  var err = 0;
  var name = check_input_empty_values($('#name').val(), 'name_err', 'Name');
  //var dob = check_input_empty_values($('#dob').val(), 'dob_err', 'D.O.B'); 
  //var contact_no = check_input_empty_values($('#contact_no').val(), 'contact_no_err', 'Contact No');
  var contact_no = $('#contact_no').val(); 
  //var address = check_input_empty_values($('#address').val(), 'address_err', 'Address');
  var role_id = check_input_empty_values($('#role_id').val(), 'role_id_err', 'User Role');
  //var pincode = check_input_empty_values($('#pincode').val(), 'pincode_err', 'Pincode');
  var username = check_input_empty_values($('#username').val(), 'username_err', 'Username');
  var password = check_input_empty_values($('#password').val(), 'password_err', 'Password');
  
  if(name){ err++; } 

  if(dob_err > 0)
    {
      $('#dob_err').html('Date of Birth should be above +18 years!');
      err++;
    }else{
      $('#dob_err').html('');
    }
  /*if(contact_no)
    {
        err++;
    }
    else */if(contact_no!='' && (contact_no.length > 10 || contact_no.length < 10))
    {
        $('#contact_no_err').html('Contact No should be 10 digits only!');
        err++;
    }
    else if(u_cno_err > 0)
    {
      $('#contact_no_err').html('Contact No already exists!');
      err++;
    }
    else
    {
        $('#contact_no_err').html('');
    }
    // var email_id = $('#email_id').val();
    // if(email_id ==''){ 
    //     $('#email_id_err').html('Email is required!');
    //     err++;
    // }else{
    //     $('#email_id_err').html('');
    // }
  
    // $('input[id^="email_id_"]').each(function(){
    //     var id = this.id;
    //     var l_id = id.substring(9);
        
    //     var email_id = $('#email_id_'+l_id+'').val();
        
    //     if(email_id !='' && !ValidateEmail(email_id)){ 
     //      $('#email_id_err_'+l_id).html('Invalid Email ID!');
     //      err++;
     //  }else{
     //      $('#email_id_err_'+l_id).html('');
     //  }
    //  });
    // if(address){ err++; }
    if(role_id){ err++; }
    // if(pincode){ err++; }
    if(username)
    { 
      err++; 
    }
    else if(u_err > 0)
    { 
      $('#username_err').html('Username already exists!');
            err++; 
   }else{ $('#username_err').html(''); }

    if(password){ err++; }
  $("select[id^='product_id']").each(function(){

    var id = this.id;
    var res = id.substring(11);
    if($('#product_id_'+res).val() != '')
    { 
      if($('#p_email_id_'+res).val() == '')
      { 
        $('#p_email_id_err_'+res).html('Select Email ID!');
            err++;
      }else{
        $('#p_email_id_err_'+res).html('');
      }
    }
    else{
      $('#p_email_id_err_'+res).html('');
    }
  });

  if ($('input[name=show_leads]:checked').val() == null)      
  {
    $('#show_leads_err').html('Show Leads is required!');
    err++;
  }
  else if($('input[name=show_leads]:checked').val() == 3)
  {
    if($('#product_users').val() == '')
    {
      $('#product_users_err').html('Product Users is required!');
      err++;
    }else{
      $('#product_users_err').html('');
    }
  } 
  else{
    $('#show_leads_err').html('');
    $('#product_users_err').html('');
  }
  
  if(err>0){ return false }else{ return true; }
}
function activeunactive(val,ival) 
{
      var unactive;
      var unactv;
      var baseurl='<?php echo base_url(); ?>';
      var a = $("#activeunactive_"+ival).val();
      if(a==1) {
         unactive=0;
         unactv="Active"
      }
      else{
         unactive=1;
         unactv="In-Active"
      }
      var datastring="id="+val+"&status="+unactive;
      $.ajax({
         type:"POST",
         url:baseurl+'Users/user_status_change',
         data:datastring,
         cache: false,
         dataType: "html",
         success: function(result){
             if(unactive == 0){
              $('#active_success').show();
              $('#inactive_success').hide();
              setTimeout(function() {
              window.location = baseurl+"Users";
           }, 3000);
          }else{
              $('#active_success').hide();
              $('#inactive_success').show();
              setTimeout(function() {
           window.location = baseurl+"Users";
           }, 3000);
          }
         },
         error: function (error) {
            alert('error; ' + eval(error));
         }
      });
}

// user view   
function user_view(val)
{
  $.ajax({
    type:'POST',
    url:baseurl+'Users/user_view',
    data:{'val':val},
    dataType: 'html',
    success:function(result){
      $('#user_view').empty().append(result);
      $('#user_view').modal('show');
    }
  });
}

// Users Edit   
function user_edit(val)
{
  $.ajax({
    type:'POST',
    url:baseurl+'Users/user_edit',
    data:{'val':val},
    dataType: 'html',
    success:function(result){
      $('#edit_user').empty().append(result);
      $('#edit_user').modal('show');
    }
  })
}

// To delete user
function user_delete(val)
{
  $("#user_id").val(val);
  $("#delete_user").modal('show');
}

$( "#allow_lead" ).click(function() 
{

    if(this.checked){
        $( "#allow_lead" ).val(1);
    }
    if(!this.checked){
        $( "#allow_lead" ).val(0);
    }
});


function check_show_leads(val)
{
  if(val == 3)
  {
    $( "#prd_users_div").show();

  }else{
    $( "#prd_users_div").hide();
  }
}
chk_role_has_lead_auth();
function chk_role_has_lead_auth()
{
  var role = $('#role_id').val();
  $.ajax({
    type:'POST',
    url:baseurl+'Users/chk_role_has_lead_auth',
    data:{'val':role},
    dataType: 'html',
    success:function(result){
      if (result == '1') {
        $('#show_lead_user_block').show();
      }
      else {
        $('#show_lead_user_block').hide();
      }
    }
  })
}
</script>
<!-- Update Lead Status-->
</body>

   <!-- end::Body -->

</html>