<?php $this->load->view('common_header'); ?>
   </head>
   <!-- end::Head -->

   <!-- begin::Body -->
   <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

      <!-- begin:: Page -->
      <div class="m-grid m-grid--hor m-grid--root m-page">

         <!-- BEGIN: Header -->
         <?php $this->load->view('common_topbar'); ?>

         <!-- END: Header -->

         <!-- begin::Body -->
         <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

            <!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
            <div id="m_aside_left" class="m-grid__item   m-aside-left  m-aside-left--skin-dark ">

               <!-- BEGIN: Aside Menu -->
               <?php $this->load->view('common_sidebar'); ?>
               <!-- END: Aside Menu -->
            </div>

            <!-- END: Left Aside -->
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
                                 <span class="m-nav__link-text">Lead Course Type List</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
                  <div class="row">
                     <div class="col-md-12">
                        <div style="margin-bottom:2.2rem;">
                          <ul class="que_sett">
                              <li><a href="<?php echo base_url(); ?>Leads">Lead List</a></li>
                              <li><a href="<?php echo base_url(); ?>Leads/lead_type_list">Lead Type List</a></li>
                              <li><a href="<?php echo base_url(); ?>Leads/lead_source_list">Lead Source List</a></li>
                              <li class="active"><a href="<?php echo base_url(); ?>Leads/lead_course_type_list">Lead Course Type List</a></li>
                          </ul>
                       </div>
                     </div>
                  </div>

                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Lead Course Type List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_lead_type">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create</span>
                                          </span>
                                       </a>
                                    </li>

                              <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                 <a href="javascript:;" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                    Export
                                 </a>
                                 <div class="m-dropdown__wrapper" style="z-index: 101;">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36px;"></span>
                                    <div class="m-dropdown__inner">
                                       <div class="m-dropdown__body">
                                          <div class="m-dropdown__content">
                                             <ul class="m-nav">
                                                <!-- <li class="m-nav__section m-nav__section--first">
                                                   <span class="m-nav__section-text">Export Tools</span>
                                                </li> -->
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_print">
                                                      <i class="m-nav__link-icon la la-print"></i>
                                                      <span class="m-nav__link-text">Print</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_copy">
                                                      <i class="m-nav__link-icon la la-copy"></i>
                                                      <span class="m-nav__link-text">Copy</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_excel">
                                                      <i class="m-nav__link-icon la la-file-excel-o"></i>
                                                      <span class="m-nav__link-text">Excel</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_csv">
                                                      <i class="m-nav__link-icon la la-file-text-o"></i>
                                                      <span class="m-nav__link-text">CSV</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_pdf">
                                                      <i class="m-nav__link-icon la la-file-pdf-o"></i>
                                                      <span class="m-nav__link-text">PDF</span>
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Lead Course Type activated successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Lead Course Type deactivated successfully.
                              </div>

                              <?php if($this->session->flashdata('l_t_success')){?>
                                   <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('l_t_success'); ?>
                                 </div>
                                 <?php } ?>

                              <?php if($this->session->flashdata('l_t_err')){?>
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('l_t_err'); ?>
                                 </div>
                                 <?php } ?>  
                              <!--begin: Datatable -->
                           <table class="table table-striped table-bordered table-checkable" id="m_table_2">
                              <thead>
                                 <tr>
                                    <th>Lead Course Type</th>
                                    <th>Status</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($lead_course_types))
                                    {
                                       $i = 1;
                                       foreach ($lead_course_types as $key => $lead_course_type) 
                                       { ?>
                                          <tr>
                                             <td><?php echo $lead_course_type->lead_course_type; ?></td>
                                             <td>
                                                <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="<?php if($lead_course_type->status==0){ echo 'Active'; }else{ echo 'In Active'; } ?>">
                                                  <label>
                                                      <input type="checkbox" <?php if($lead_course_type->status==0){ echo "checked";} ?> name="activeunactive_<?php echo $i;?>" id="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $lead_course_type->lead_course_type_id; ?>,<?php echo $i; ?>)" value="<?php echo $lead_course_type->status;?>">
                                                      <span></span>
                                                   </label>
                                                </span>
                                             </td>
                                             <td>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#lead_type_edit" onclick="return lead_course_type_edit(<?php echo $lead_course_type->lead_course_type_id; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                              
                                                   <a href="javascript:;" data-toggle="modal" data-target="#delete_lead_type" onclick="return lead_course_type_delete(<?php echo $lead_course_type->lead_course_type_id; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
                                                
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

      <!-- begin::Scroll Top -->
      <div id="m_scroll_top" class="m-scroll-top">
         <i class="la la-arrow-up"></i>
      </div>

      <!-- end::Scroll Top -->
      <!--begin::Modal-->
      <!-- Create Lead Type-->
<div class="container">
   <div class="modal fade" id="create_lead_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
         <form name="lead_type_add_form" id="lead_type_add_form" method="POST" action="<?php echo base_url(); ?>Leads/lead_course_type_add" onsubmit="return lead_course_type_validation()">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Lead Course Type</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">
                         
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <label>Lead Course Type<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Course Type" name="lead_course_type" id="lead_course_type" maxlength="100" onblur="return lead_course_type_unique();">
                                 <span id="lead_course_type_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" id="btnSubmit" class="btn btn-primary">Create</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Update Lead Type-->
<div class="container">
   <div class="modal fade" id="lead_course_type_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
         <form name="lead_type_edit_form" id="lead_type_edit_form" method="POST" action="<?php echo base_url(); ?>Leads/lead_course_type_update" onsubmit="return lead_course_type_edit_validation()">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Lead Course Type</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">
                         
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <label>Lead Course Type<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Type" name="lead_course_type" id="e_lead_course_type" maxlength="100" onblur="return lead_course_type_unique_edit();">
                                 <span id="e_lead_course_type_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <input type="hidden" name="e_lead_course_type_id" id="e_lead_course_type_id" value="">
                  <button type="submit" id="edit_btnSubmit" class="btn btn-primary">Save Changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="lead_course_type_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <form name="lead_type_delete_form" id="lead_type_delete_form" method="POST" action="<?php echo base_url(); ?>Leads/lead_course_type_delete">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Lead Course Type</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <p>Are You Sure You Want to Drop this lead course type permanently?</p>
               </div>
               <input type="hidden" name="delete_lead_course_type_id" id="delete_lead_course_type_id">
               <div class="modal-footer">
                  <button type="submit" id="delete_btnSubmit" class="btn btn-primary">Yes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
 // To validate lead type add form
function lead_course_type_validation()
{
   var err = 0;
   var l_t_name = $('#lead_course_type').val();
   if(l_t_name == '')
   {
      $('#lead_course_type_err').html('Lead Course Type is required');
      err++;
   }else{
      $('#lead_course_type_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

 // To validate lead type edit form
function lead_course_type_edit_validation()
{
   var err = 0;
   var l_t_name = $('#e_lead_course_type').val();
   if(l_t_name == '')
   {
      $('#e_lead_course_type_err').html('Lead Course Type is required');
      err++;
   }else{
      $('#e_lead_course_type_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

// To check lead course type name is unique
function lead_course_type_unique()
{
   var l_t_name = $('#lead_course_type').val();

   $.ajax({
      type:"POST",
      url:baseurl+'Leads/lead_course_type_unique',
      data:{'value':l_t_name},
      cache: false,
      dataType: "html",
      success: function(result){
            
         if(result>0)
         {
            $('#lead_course_type_err').html('Lead Course Type already exists!');
            $('#btnSubmit').prop('disabled', true);
         }
         else
         {
            $('#btnSubmit').prop('disabled', false);
         }
      }
   });
}

// To check lead type name is unique for edit form
function lead_course_type_unique_edit()
{
   var l_t_name = $('#e_lead_course_type').val();
   var l_t_id   = $('#e_lead_course_type_id').val();

   $.ajax({
      type:"POST",
      url:baseurl+'Leads/lead_course_type_unique_edit',
      data:{'value':l_t_name, 'id':l_t_id},
      cache: false,
      dataType: "html",
      success: function(result){
            
         if(result>0)
         {
            $('#e_lead_course_type_err').html('Lead Course Type already exists!');
            $('#edit_btnSubmit').prop('disabled', true);
         }
         else
         {
            $('#edit_btnSubmit').prop('disabled', false);
         }
      }
   });
}

// To show lead edit
function lead_course_type_edit(val)
{
   $.ajax({
      type:"POST",
      url:baseurl+'Leads/lead_course_type_edit',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){

         if(result != '')
         {
            var res = result.split('|');
            $("#e_lead_course_type_id").val(res[0]);
            $("#e_lead_course_type").val(res[1]);
         }else{
            $("#e_lead_course_type_id").val();
            $("#e_lead_course_type").val();
         }
         
      }
   });
   $("#lead_course_type_edit").modal('show');
}
// To change active status
function activeunactive(val,ival) {

   var unactive;
   var unactv;
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
      url:baseurl+'Leads/lead_course_type_change_status',
      data:datastring,
      cache: false,
      dataType: "html",
      success: function(result){ 
        if(unactive == 0){
            $('#active_success').show();
            $('#inactive_success').hide();
            setTimeout(function() {
            window.location = baseurl+"Leads/lead_course_type_list";
         }, 3000);
        }else{
            $('#active_success').hide();
            $('#inactive_success').show();
            setTimeout(function() {
         window.location = baseurl+"Leads/lead_course_type_list";
         }, 3000);
        }
       } 
   });
}
// To delete lead type id
function lead_course_type_delete(val){

   $("#delete_lead_course_type_id").val(val)
   $("#lead_course_type_delete").modal('show');

}
</script>
</body>
   <!-- end::Body -->
</html>