<?php
 $this->load->view('common_header'); 
 $date_format =common_date_format();?>
 
<style type="text/css">
.tag {
   display: inline-block;
   width: auto;
   height: 38px;
   background-color: #ffd24d;
   -webkit-border-radius: 3px 4px 4px 3px;
   -moz-border-radius: 3px 4px 4px 3px;
   border-radius: 3px 4px 4px 3px;
   border-left: 1px solid #ffd24d;
  /*  This makes room for the triangle */
   margin-left: 19px;
   position: relative;
   color: #39474E;
   font-weight: 300;
   font-family: 'Source Sans Pro', sans-serif;
   font-size: 18px;
   line-height: 38px;
   padding: 0 10px 0 10px;
}

/* Makes the triangle */
.tag:before {
   content: "";
   position: absolute;
   display: block;
   right: -17px;
   width: 0;
   height: 0;
   border-top: 19px solid transparent;
   border-bottom: 19px solid transparent;
   border-left: 19px solid #ffd24d;
}

/* Makes the circle */
.tag:after {
   content: "";
   background-color: white;
   border-radius: 50%;
   width: 4px;
   height: 4px;
   display: block;
   position: absolute;
   left: -9px;
   top: 17px;
}

.tag_fup {
   display: inline-block;
  
  width: auto;
   height: 22px;
   
   background-color: #ffd24d;
  /* -webkit-border-radius: 3px 4px 4px 3px;
   -moz-border-radius: 3px 4px 4px 3px;*/
   border-radius: 3px 4px 4px 3px;
   
   border-left: 1px solid #ffd24d;

   /* This makes room for the triangle */
   /*margin-left: 19px;*/
   
   position: relative;
   
   color: #39474E;
   font-weight: 300;
  /* font-family: 'Source Sans Pro', sans-serif;
   font-size: 12px;*/
   line-height: 23px;

   /*padding: 0 10px 0 10px;*/
   padding: 0 0 0 0;
}

/* Makes the triangle */
.tag_fup:before {
   content: "";
   position: absolute;
   display: block;
   right: -17px;
   width: 0;
   height: 0;
   border-top: 12px solid transparent;
   border-bottom: 12px solid transparent;
   border-left: 19px solid #ffd24d;
}

/* Makes the circle */
.tag_fup:after {
   content: "";
   background-color: white;
   border-radius: 50%;
   width: 4px;
   height: 4px;
   display: block;
   position: absolute;
   left: -9px;
   top: 17px;
}
table.table p {
 /*display: none;*/
 visibility: hidden;margin-bottom: 0;
}
table.table tr:hover p {
      /* display: block;*/
      visibility: visible;
}
.lead_table td{
    border-top: solid 1px #ebebeb;
    border-spacing:none;
    cellpadding: 0;
    cellspacing: 0;
    color: #3D3D3D;
    padding: 0px 4px 0px 4px;
    margin-left: 3px !important; 
}
.lead_table td .contact_info{
    white-space: nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
    min-width:47px;
}
.breadcrumb_fonts {
   font-size: 12px !important;
}
.m-portlet .m-portlet__body {
    padding: 0.2rem 2.2rem !important;
}
.tr_size{
   height: 10px !important;
}
.m-subheader {
    padding: 0px 15px 0 15px;
}
.m-body .m-content {
    padding: 0px 15px;
}
.btn.m-btn--custom {
    padding: 5px 12px !important;
}
.m-portlet .m-portlet__head {
    height: 43px !important;
}
.lead_modi_info {
   padding: 1px !important;
}
.handshake_hide {
   display: none;
}
/*.td_bold_font {
   font-size : 6px;
}*/
</style>
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home breadcrumb_fonts"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right breadcrumb_fonts"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text breadcrumb_fonts">Lead Management</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right breadcrumb_fonts"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>" class="m-nav__link">
                                 <span class="m-nav__link-text breadcrumb_fonts">Search Lead List</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
                  <!-- <div class="row">
                     <div class="col-md-12">
                        <div style="margin-bottom:2.2rem;">
                              <ul class="que_sett">
                                 <li class="<?php // if($tab_val == 1 || $tab_val == ''){ echo 'active'; }else{ echo ''; } ?>"><a href="<?php // echo base_url(); ?>new_leads?active_tab=1">New Leads</a></li>
                                 <li class="<?php // if($tab_val == 2 || $tab_val == ''){ echo 'active'; }else{ echo ''; } ?>" ><a href="<?php // echo base_url(); ?>followup_leads?active_tab=2">Followup Leads</a></li>
                                 <li class="<?php // if($tab_val == 3 || $tab_val == ''){ echo 'active'; }else{ echo ''; } ?>" ><a href="<?php // echo base_url(); ?>archived_leads?active_tab=3">Archived Leads</a></li>
                              </ul>
                        </div>
                     </div>
                  </div> -->
                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile " style="background-color: #e6ffff;">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                    Search Lead List&nbsp;&nbsp;<!-- <span class="text-info"></b><?php // echo (!empty($lead_lists)) ? ' - '.COUNT($lead_lists) : ''; ?></b></span>&nbsp; -->
                                    <?php if(isset($lead_today_fup_count)) { ?>
                                       <?php  if($tab_val == 2 && $lead_today_fup_count->today_followups > 0) { ?>
                                          <a href="<?php echo base_url(); ?>Leads?t_fup=1"><span class="tag">Today's Followup - <?php echo 
                                      $lead_today_fup_count->today_followups; ?></span></a>
                                       <?php }else{ } ?>
                                    <?php } ?>
                                    </h3>

                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <!-- <a href="javascript:;" id="tog_filter" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="fa fa-search"></i>
                                          </span>
                                       </a> -->
                                       <input type="text" name="search_lead_bar" id="search_lead_bar" class="form-control" style="height: 30px;">
                                    </li>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" onclick="submit_lead_form('filter');" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="fa fa-search"></i>
                                             <span>Search</span>
                                          </span>
                                       </a>
                                    </li>
                                   
                              <!-- <li class="m-portlet__nav-item">
                                 <a href="#" onclick="lead_export_items();" class="m-portlet__nav-link btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                    Export
                                 </a>

                              </li> -->
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              
                              <!--begin: Datatable -->

                             
                              <div class="row">
                                    
                                    
                              </div>
                                  
                              
                              <div class="row" id="search_lead_list_table_append_block" style="display: none;"> 
                                 
                              </div>
                              <div class="row" id="search_lead_list_table_append_block_loader"> 
                                 <div class="col-lg-5"></div>
                                 <div class="col-lg-2">
                                    <img src="<?php echo base_url(); ?>assets/demo/demo12/media/img/logo/aero_world2.gif" height="100px" width="100px" style="margin-top: 93px;">
                                 </div>
                                 <div class="col-lg-5"></div>
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
         <script src="<?php echo base_url();?>assets/demo/demo12/custom/crud/forms/widgets/bootstrap-daterangepicker.js"></script>
         <script src="<?php echo base_url(); ?>assets/demo/demo12/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->
<!--begin::Create Lead-->

<!--End::-->


<!--begin::Update Lead-->




<script type="text/javascript">


// //modal-script
var pagecount = '';
var current_pagination_index = '';
function paginate_page(page,l_id)
{  
   current_pagination_index = l_id;
   pagecount = page;
   submit_lead_form('pagination');
}


// function search_on_list(val)
// {
  
//    search_val = val;
//    submit_lead_form('search');
// }
// submit_lead_form('filter');
function submit_lead_form(diff) {
   var baseurl = '<?php echo base_url(); ?>';
   if(diff=='pagination'){
      current_pagination_index = current_pagination_index;
   }
   else{
      current_pagination_index = 1;
   }
   if (diff == 'search' || diff == 'perpage_count') {
      pagecount = 0;
   }
   else {
      pagecount = pagecount;
   }
   // var pagecount = localStorage.getItem('curr_page');
   $('#search_lead_list_table_append_block_loader').show();
   $('#search_lead_list_table_append_block').hide();
   var perpage = $('#perpage').val();
   
   var search_val = $('#search_lead_bar').val();
  
   $.ajax({
      url:baseurl+'Leads/search_lead_list_result_by_filters',
      type:'POST',
      data:{ 'pagecount' : pagecount, 'search_val' : search_val, 'current_pagination_index' : current_pagination_index, 'perpage' : perpage },
      dataType: 'html',
      success:function(result){
         $('#search_lead_list_table_append_block').empty().append(result);
         $('#search_lead_list_table_append_block_loader').hide();
         $('#search_lead_list_table_append_block').show();
      }
   });
}

function import_lead_flag(id,val)
{
  if (val == 0) { 
   $('#imp_mail_label').html('Are you sure, you want to Disable this lead`s Emails Import ?');
  } 
  else {
   $('#imp_mail_label').html('Are you sure, you want to Allow this lead`s Emails Import ?');
  }
  $('#imp_lead_id').empty().val(id);
  $('#imp_flag').empty().val(val);
  $('#imp_lead_modal').modal('show');
}
// To get product user list 
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
// To get product user list 
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

function lead_opportunity_modal(lead_id)
{
   $('#opp_lead_id').val(lead_id);
   $('#opportunity_lead').modal('show');
}

// To change lead type
function lead_opportunity_change(val,type_val)
{
   var oppo_status = $('#oppo_status').val();
   var err = 0;
   if (oppo_status == '') {
      $('#oppo_status_err').html("Opportunity Status is required!");
      err++;
   }
   else {
      $('#oppo_status_err').html("");
   }
   var lead_id = $('#opp_lead_id').val();
   if (err == 0) {
      $.ajax({
         type:'POST',
         url:baseurl+'Leads/lead_status_type_change',
         data:{'value':val, 'lead_id':lead_id, 'type_val':type_val, 'oppo_status':oppo_status},
         dataType: 'html',
         success:function(result){
             $('#opportunity_lead').modal('toggle');
             $('#convert_to_oppo_success').show();
             submit_lead_form();
         }
      });
   }
}

// To show edit lead 
function lead_edit(val)
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/lead_edit',
      data:{'value':val},
      async: false,
      dataType: "html",
      success: function(result){

         $('#edit_lead').empty().append(result);
         $("#edit_lead").modal('show');
      }
   });
}
function lead_fp_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'Leads/lead_followup_edit',
   async: false,
   type: "POST",
   data: "lead_id="+val,
   dataType: "html",
   success: function(response)
   {
   $('#follow_edit').empty().append(response);
   }
   });
}
function lead_fp_edit_status(val)
{

   $.ajax({
   type: "POST",
   url: baseurl+'Leads/lead_fp_edit_status',
   async: false,
   type: "POST",
   data: "id="+val,
   dataType: "html",
   success: function(response)
   {
   $('#follow_edit_status').empty().append(response);
   }
   });
}
function lead_fups_validation()
{
   var err = 0;
   var comments = $('#comments_edit').val();
   if(comments==''){
      $('#comments_edit_err').html('Comments is required!');
      err++;
   }
   else
   {
      $('#comments_edit_err').html('');
   }
   if(err>0){ return false; }else{ return true; }
}
function re_lead(val)
{

   $.ajax({
   type: "POST",
   url: baseurl+'Leads/re_lead',
   async: false,
   type: "POST",
   data: "id="+val,
   dataType: "html",
   success: function(response)
   {
   $('#re_lead').empty().append(response);
   }
   });
}
function reLead(val)
{ 

   $.ajax({
   type: "POST",
   url: baseurl+'Leads/reLead',
   async: false,
   data:"field="+val,
   success: function(response)
   {
   window.location.href = baseurl+'Leads';
   }
   });
}
function cancel_lead(val)
{

   $.ajax({
   type: "POST",
   url: baseurl+'Leads/cancel_lead',
   async: false,
   type: "POST",
   data: "id="+val,
   dataType: "html",
   success: function(response)
   {
   $('#cancel_lead').empty().append(response);
   }
   });
}
function cancelLead(val)
{ 
   var reason = $('#drop_reason').val();
   if(reason != '')
   {
      $('#drop_reason_err').html('');
       $.ajax({
      type: "POST",
      url: baseurl+'Leads/lead_delete',
      async: false,
      data:"field="+val+"&reason="+reason,
      success: function(response)
      {
      window.location.href = baseurl+'Leads';
      }
      });

   }else{
      $('#drop_reason_err').html('Reason is required!');
   }
  
}
var er = 0;
function email_id_unique(val) 
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
            $('#email_id_err').html('Email ID already exists!');
            er = 1;
         }else{
            $('#email_id_err').html('');
            er = 0;
         }
         
      }
   });
}
var erb=0;
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
            erb = 1;
         }else{
            $('#email_id_err').html('');
            erb = 0;
         }
         
      }
   });
}
var e_erb=0;
function e_chk_if_email_is_blocked(val)
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
            $('#e_email_id_err').html('This email is Blocked');
            e_erb = 1;
         }else{
            $('#e_email_id_err').html('');
            e_erb = 0;
         }
         
      }
   });
}
// To validate lead form
function lead_validation()
{
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
   
   
   if(lead_name == '')
   {
      $('#lead_name_err').html('Lead Name is required!');
      err++;
   }else{
      $('#lead_name_err').html('');
   }  
   if(country == '')
   {
      $('#country_err').html('Country is required!');
      err++;
   }else{
      $('#country_err').html('');
   } 
  
   if(website != '' && !isUrlValid(website))
   {
       $('#website_err').html('Valid Website is required!');
      err++;
   }else{
      $('#website_err').html('');
   } 

   if (contact_no.trim() == '' &&  email_id.trim() == '') {
      $('#email_id_err').html('Email ID is required!');
      $('#contact_no_err').html('Contact No is required!');
      err++;
      
   }
   else {
      $('#email_id_err').html('');
      $('#contact_no_err').html('');
   }
   if(contact_no != '')
   { 
        
       if(isNaN(contact_no))
       { 
           $('#contact_no_err').html('Invalid Contact No!');
           err++;
       }
       else{
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
         err++;
      }else if(erb > 0){

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

   
    
   if(whatsapp_no != '' && whatsapp_no.length!=10||whatsapp_no=='0000000000')
    { 
        $('#whatsapp_no_err').html('Whatsapp No should be maxium 10 No!');
        err++;
    }else if(isNaN(whatsapp_no))
    { 
        $('#whatsapp_no_err').html('Invalid Whatsapp No!');
        err++;
    }
    else{
        $('#whatsapp_no_err').html('');
    }
      
   if(office_phone_no != '' && office_phone_no.length!=10||office_phone_no=='0000000000')
    { 
        $('#office_phone_no_err').html('Office Contact No should be maxium 10 No!');
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
   
   if(err>0){ return false; }else{ return true; }
}   
var e_er = 0;
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
// To validate lead form
// function e_lead_validation()
// {
//    var err = 0;
//    var lead_name = $('#e_lead_name').val();
//    var company_name = $('#e_company_name').val();
//    var country = $('#e_country').val();
//    var designation = $('#e_designation').val();
//    var website = $('#e_website').val();
//    var address = $('#e_address').val();
//    var email_id = $('#e_email_id').val();
//    var alternative_email_id = $('#e_alternative_email_id').val();
//    var website = $('#e_website').val();
//    var skype_id = $('#e_skype_id').val();
//    var contact_no = $('#e_contact_no').val();
//    var whatsapp_no = $('#e_whatsapp_no').val();
//    var office_phone_no = $('#e_office_phone_no').val();
//    var product_id = $('#e_product_id').val();
//    var lead_source = $('#e_lead_source').val();
//    var ori_lead_source = $('#e_ori_lead_source').val();
//    var lead_type = $('#e_lead_type').val();
//    var lead_status = $('#e_lead_status').val();
//    var assigned_to = $('#e_assigned_to').val();
//    var message = $('#e_m_summernote_1').val();
//    var lead_status = $('#e_lead_status').val();
//    if (ori_lead_source == '') {
//       $('#e_ori_lead_source_err').html('Lead Source is required!');
//       err++;
//    }
//    else {
//       $('#e_ori_lead_source_err').html('');
//    }
//    if(lead_name == '')
//    {
//       $('#e_lead_name_err').html('Lead Name is required!');
//       err++;
//    }else{
//       $('#e_lead_name_err').html('');
//    }  
   
//    if(country == '')
//    {
//       $('#e_country_err').html('Country is required!');
//       err++;
//    }else{
//       $('#e_country_err').html('');
//    } 
   
//    if(website != '' && !isUrlValid(website))
//    {
//        $('#e_website_err').html('Valid Website is required!');
//       err++;
//    }else{
//       $('#e_website_err').html('');
//    }
//    if (contact_no.trim() == '' && email_id.trim() == '') {
//       $('#e_email_id_err').html('Email ID is required!');
//       $('#e_contact_no_err').html('Contact No required!');
//       err++;
//       // if(email_id == '')
//       // {
//       //       $('#e_email_id_err').html('Email ID is required!');
//       //         err++;

//       // }else if(!ValidateEmail(email_id)){ 

//       //         $('#e_email_id_err').html('Invalid Email ID!');
//       //         err++;
//       // }else if(e_er > 0){

//       //    $('#e_email_id_err').html('Email ID already exists!');
//       //    err++;
//       // }else if(e_erb > 0){

//       //    $('#e_email_id_err').html('This email is Blocked');
//       //    err++;
//       // }
//       // else{
//       //   $('#e_email_id_err').html('');
//       // }

//       // if (contact_no == '') {

//       //    $('#e_contact_no_err').html('Contact No required!');
//       //      err++;   
//       // }
//       // else if(contact_no != '' && contact_no.length!=10||contact_no=='0000000000')
//       //  { 
//       //      $('#e_contact_no_err').html('Contact No should be maxium 10 No!');
//       //      err++;
//       //  }else if(isNaN(contact_no))
//       //  { 
//       //      $('#e_contact_no_err').html('Invalid Contact No!');
//       //      err++;
//       //  }
//       //  else{
//       //      $('#e_contact_no_err').html('');
//       //  }
//    }
//    else {
//       $('#e_email_id_err').html('');
//       $('#e_contact_no_err').html('');
      
//    }
//    if(alternative_email_id != '' && !ValidateEmail(alternative_email_id)){ 

//            $('#e_alternative_email_id_err').html('Invalid Email ID!');
//            err++;
//    }
//    else{
//      $('#e_alternative_email_id_err').html('');
//    }

//     if(contact_no != '') {
//        if(isNaN(contact_no))
//        { 
//            $('#e_contact_no_err').html('Invalid Contact No!');
//            err++;
//        }
//        else{
//            $('#e_contact_no_err').html('');
//            $('#e_email_id_err').html('');
//        }
//     }
//     if(email_id.trim() != ''){
//     if(!ValidateEmail(email_id)){ 

//               $('#e_email_id_err').html('Invalid Email ID!');
//               err++;
//       }else if(e_er > 0){

//          $('#e_email_id_err').html('Email ID already exists!');
//          err++;
//       }else if(e_erb > 0){

//          $('#e_email_id_err').html('This email is Blocked');
//          err++;
//       }
//       else{
//         $('#e_email_id_err').html('');
//       }
//    }
//    if(whatsapp_no != '' && whatsapp_no.length!=10||whatsapp_no=='0000000000')
//     { 
//         $('#e_whatsapp_no_err').html('Whatsapp No should be maxium 10 No!');
//         err++;
//     }else if(isNaN(whatsapp_no))
//     { 
//         $('#e_whatsapp_no_err').html('Invalid Whatsapp No!');
//         err++;
//     }
//     else{
//         $('#e_whatsapp_no_err').html('');
//     }
      
//    if(office_phone_no != '' && office_phone_no.length!=10||office_phone_no=='0000000000')
//     { 
//         $('#e_office_phone_no_err').html('Office Contact No should be maxium 10 No!');
//         err++;
//     }else if(isNaN(office_phone_no))
//     { 
//         $('#e_office_phone_no_err').html('Invalid Office Contact No!');
//         err++;
//     }
//     else{
//         $('#e_office_phone_no_err').html('');
//     }
//    if(product_id.trim()==''){

//       $('#e_product_id_err').html('Product is required!');
//       err++;
//    }else{
//       $('#e_product_id_err').html('');

//    }

//    if(lead_source.trim()==''){

//       $('#e_lead_source_err').html('Sub Lead Source is required!');
//       err++;
//    }else{
//       $('#e_lead_source_err').html('');

//    }
//     if(lead_type.trim()==''){

//       $('#e_lead_type_err').html('Priority is required!');
//       err++;
//    }else{
//       $('#e_lead_type_err').html('');

//    }
//    if(lead_status.trim()==''){

//       $('#e_lead_status_err').html('Lead Status is required!');
//       err++;
//    }else{
//       $('#e_lead_status_err').html('');

//    }
//    if(assigned_to.trim()==''){

//       $('#e_assigned_to_err').html('Assigned To is required!');
//       // err++;
//    }else{
//       $('#e_assigned_to_err').html('');

//    }
   
//    if(err>0){ return false; }else{ return true; }
// } 

function overall_chk()
{
   $('input:checkbox').prop('checked'); 
   chkcount = $('#countchk').val();
   if($('#allchk').prop("checked") == true)
   {
      for (var i = 0; i < chkcount; i++) {
         $('#chk'+i).prop("checked", true);
      }
   }
   else
   {
      for (var i = 0; i < chkcount; i++)
      {
         $('#chk'+i).prop("checked", false);
      }
   }
}

function bulk_updation()
{
   var n = [];
   var j = 0;
   chkcount = $('#countchk').val();
   for (var i = 0; i < chkcount; i++) {
      if($('#chk'+i).prop("checked") == true){
        n[j] = $('#chk'+i).val();
        j++;
    }
   }
   if(j!=0)
   {
   var c = n + '';
      $('#bulk_lead_ids').val(c);
      $('#bulk_updation').modal('show');
   }
   else
   {
      alert("No Checkboxes Checked");
   }
}
// function select_all_leads()
// {
//    var sl = '<?php //echo trim($select_all_leads, ","); ?>';
//    $('#bulk_lead_ids').val(sl);
//    $('#bulk_updation').modal('show');
// }
function show_drop_val(val)
{
   if(val == 2)
   {
      $('#bulk_update_div').hide();
      
   }else{
      $('#bulk_update_div').show();
      
   }
}
function bulk_update_validation()
{
   var radioValue = $("input[name='bulk_update']:checked").val();
   var bulk_lead_type = $('#bulk_lead_type').val();
   var bulk_lead_source = $('#bulk_lead_source').val();
   var bulk_lead_status = $('#bulk_lead_status').val();
   var bulk_lead_assigned_to = $('#bulk_lead_assigned_to').val();
   var bulk_reason = $('#bulk_reason').val();
   var industry = $('#m_industry').val();
   var product = $('#m_product').val();
   
   var err = 0;

   if(radioValue == 1)
   {
      if(bulk_lead_type =='' && bulk_lead_source == '' && bulk_lead_status == '' && bulk_lead_assigned_to == '' && industry == '')
      {

         $('#bulk_edit_err_msg').html('Select any option to update or drop');
         err++;
      }
      else{
          $('#bulk_edit_err_msg').html('');
       }
       if (industry != '') {
         if (product == '') {
            $('#m_product_err').html('Choose Product');
            err++;
         }
         else {
            $('#m_product_err').html('');
         }
       }
   }else{
      $('#bulk_edit_err_msg').html('');
   }

   if(bulk_reason =='')
   {
      $('#bulk_reason_err').html('Reason is required!');
      err++;
   }
   else{
       $('#bulk_reason_err').html('');
      $('#bulk_edit_err_msg').html('');
   }
   if(err>0) { return false; }else{ return true; }
}
function show_quick_icon(id_val, v, col)
{  
   $('#'+id_val+'_label_'+v).hide();
   $('#'+id_val+'_'+v).show();
   $('#quick_edit_'+col+'_'+v).hide();
   $('#quick_save_'+col+'_'+v).show(); 
}
function show_quick_pencil_icon(id_val, v, col)
{
   $('#quick_edit_'+col+'_'+v).show();
   $('#quick_save_'+col+'_'+v).hide();
   $('#'+id_val+'_label_'+v).show();
   $('#'+id_val+'_'+v).hide();
}
// To change lead type
function lead_status_type_change(val, lead_id, type_val, quick_val, v, col)
{
   var list_type_id = $('#list_type_id_'+v+' option:selected').text();
   var list_status_id = $('#list_status_id_'+v+'  option:selected').text();
   var list_source_id = $('#list_source_id_'+v+'  option:selected').text();
   var list_country = $('#list_country_'+v+'  option:selected').text();
   $.ajax({
      type:'POST',
      url:baseurl+'Leads/lead_status_type_change',
      data:{'value':val, 'lead_id':lead_id, 'type_val':type_val},
      dataType: 'html',
      success:function(result){
         

         if(list_type_id == 'Hot' && list_status_id == 'Potential')
         {
            // $('#befor_opp_id_'+v).show();
            $('#befor_opp_id_'+v).removeClass("handshake_hide");
            // submit_lead_form();
         }else{
            // $('#befor_opp_id_'+v).hide();
            $('#befor_opp_id_'+v).addClass("handshake_hide");
         }
         if(list_type_id == 'Hot' && list_status_id == 'Potential')
         {
            // $('#opp_id_'+v).show();
            $('#opp_id_'+v).removeClass("handshake_hide");
            // submit_lead_form();
         }
         else{
            // $('#opp_id_'+v).hide();
            $('#opp_id_'+v).addClass("handshake_hide");
         }
         if ($('#befor_opp_id_'+v).hasClass("handshake_hide") == false && $('#opp_id_'+v).hasClass("handshake_hide") == false) {
            $('#opp_id_'+v).addClass("handshake_hide");
         }
         if(type_val == 'country')
         {
            $('#'+quick_val+'_label_'+v).html(list_country);
            
         }
         else if(type_val == 'lead_source')
         {
            $('#'+quick_val+'_label_'+v).html(list_source_id);
            submit_lead_form();
         }
         else if(type_val == 'lead_type')
         {
             $('#'+quick_val+'_label_'+v).html(list_type_id);
         }
         else if(type_val == 'lead_status')
         {
            $('#'+quick_val+'_label_'+v).html(list_status_id);
         }
         else{ }
         
         

         $('#'+quick_val+'_label_'+v).show();
         $('#quick_edit_'+col+'_'+v).show();
         $('#quick_save_'+col+'_'+v).hide();
         $('#'+quick_val+'_'+v).hide();
 
         
      }
   });
}
function bulk_import()
{
    $.ajax({
      type: "POST",
      url:baseurl+'Leads/lead_bulk_import',
      async: false,
      dataType: "html",
      success: function(result){
      
         $('#bulk_import').empty().append(result);
         $("#bulk_import").modal('show');
      }
   });
}



$('#tog_filter').click(function(){
  $('.my_filter').slideToggle('slow'); 
});

var lead_source = '<?php echo $list_lead_source; ?>';
var list_lead_status = '<?php echo $list_lead_status; ?>';

if(lead_source != '' || list_lead_status != '')
{
   $('.my_filter').show(); 
}
else{
   $('.my_filter').hide(); 
}

function lead_export_items()
{
   $('#lead_export_model').modal('show');
}
function view_lead_comments(l_id)
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/get_lead_comments_by_lead_id',
      async: false,
      data: 'lead_id='+l_id+'&view_from=Lead',
      dataType: "html",
      success: function(result){
      
         $('#lead_comments_modal').empty().append(result);
         $("#lead_comments_modal").modal('show');
      }
   });
}
function view_lead_whatsapp_conversation(l_id)
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/get_lead_whatsapp_conversation_by_lead_id',
      async: false,
      data: 'lead_id='+l_id+'&view_from=Lead',
      dataType: "html",
      success: function(result){
      
         $('#lead_whatsapp_comment_modal').empty().append(result);
         $("#lead_whatsapp_comment_modal").modal('show');
      }
   });
}
</script>

   </body>

   <!-- end::Body -->
</html>                    