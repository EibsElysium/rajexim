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
                                       <span class="m-nav__link-text">Settings</span>
                                    </a>
                                 </li>
                                 <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                                 <li class="m-nav__item">
                                    <a href="javascript:;" class="m-nav__link">
                                       <span class="m-nav__link-text">Lead Settings</span>
                                    </a>
                                 </li>
                                 <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                                 <li class="m-nav__item">
                                    <a href="javascript:;" class="m-nav__link">
                                       <span class="m-nav__link-text">Sub Lead Source List</span>
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
                                       Sub Lead Source List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">

                                 
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#sub_lead_source_create">
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
                                 <button Source="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Sub Lead Source has activated successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button Source="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Sub Lead Source has deactivated successfully.
                              </div>

                              <?php if($this->session->flashdata('l_t_success')){?>
                                   <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
                                 <button Source="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('l_t_success'); ?>
                                 </div>
                                 <?php } ?>

                              <?php if($this->session->flashdata('l_t_err')){?>
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
                                    <button Source="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('l_t_err'); ?>
                                 </div>
                                 <?php } ?>  

                              <!--begin: Datatable -->
                           <table class="table table-striped table-bordered  table-checkable" id="m_table_2">
                              <thead>
                                 <tr>
                                    <th>Sub Lead Source</th>
                                    <th>Status</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php  if(!empty($sub_lead_sources)) { $i = 1; foreach($sub_lead_sources as $sub_lead_source){ ?>
                                 <tr>
                                    <td><?php echo $sub_lead_source->lead_source.' | '.$sub_lead_source->sub_lead_source; ?></td>
                                  
                                    <td>
                                       <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="<?php if($sub_lead_source->status==0){ echo 'Active'; }else{ echo 'In Active'; } ?>">
                                       <label>
                                          <input type="checkbox" <?php if($sub_lead_source->status==0){ echo "checked";} ?> name="activeunactive_<?php echo $i;?>" id="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $sub_lead_source->sub_lead_source_id; ?>,<?php echo $i; ?>)" value="<?php echo $sub_lead_source->status;?>">
                                          <span></span>
                                       </label>
                                       </span>
                                    </td>

                                    <td>
                                    
                                       <a href="javascript:;" data-toggle="modal" data-target="#edit_sub_lead_source" onclick="return sub_lead_source_edit(<?php echo $sub_lead_source->sub_lead_source_id; ?>)"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                    
                                       <a href="javascript:;" data-toggle="modal" data-target="#delete_sub_lead_source" onclick="return sub_lead_source_delete(<?php echo $sub_lead_source->sub_lead_source_id; ?>)" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
                                       
                                    </td>
                                 </tr>
                                 
                              <?php  $i++; } } ?>
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
<!--begin::Modal-->


<!--Add Job-->
<div class="container">
   <div class="modal fade" id="sub_lead_source_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Sub Lead Source</h5>
               <button Source="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form name="sub_lead_source_add_form" id="sub_lead_source_add_form" method="POST" action="<?php echo base_url(); ?>Leads/sub_lead_source_add" onsubmit="return sub_lead_source_validation()">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Lead Source<span class="text-danger">*</span></label>
                           <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="lead_source" id="lead_source" onchange="chk_unique_sub_lead_source();">
                              <option value="">All</option>
                                 <?php
                                    if(!empty($lead_sources))
                                    {
                                       foreach ($lead_sources as  $lead_source) { if($lead_source->status == 0){ ?>
                                          <option value="<?php echo $lead_source->lead_source_id; ?>" ><?php echo $lead_source->lead_source; ?></option>
                                       <?php } }
                                    }
                                 ?>
                           </select>
                           <span id="lead_source_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Sub Lead Source<span class="text-danger">*</span></label>
                           <input Source="text" class="form-control m-input m-input--square" placeholder="Enter Sub Lead Source" name="sub_lead_source_name" id="sub_lead_source_name" onkeyup="return chk_unique_sub_lead_source()">
                           <span id="sub_lead_source_name_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
               
               </div>
               <div class="modal-footer">
                  <button Source="submit" id="btnSubmit" class="btn btn-primary">Create</button>
                  <button Source="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!--Edit Job-->
<div class="container">
   <div class="modal fade" id="edit_sub_lead_source" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     
   </div>
</div>

<!--Delete Job-->
<div class="container">
   <div class="modal fade" id="delete_sub_lead_source" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Sub Lead Source</h5>
               <button Source="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form name="sub_lead_source_delete_form" id="sub_lead_source_delete_form" method="POST" action="<?php echo base_url(); ?>Leads/sub_lead_source_delete">
               <div class="modal-body">
                  <p>Are You Sure You Want to Delete this Sub Lead Source Permanently?</p>
               </div>
               <input type="hidden" name="delete_sub_lead_source_id" id="delete_sub_lead_source_id">
               <div class="modal-footer">
                  <button Source="submit" id="delete_btnSubmit" class="btn btn-primary">Yes</button>
                  <button Source="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--end::Modal-->

<script Source="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Sub Lead Source List';
$(document).attr("title", title);   
// To validate Sub lead Source add form
function sub_lead_source_validation()
{
   var err = 0;
   var s_l_s_name = $('#sub_lead_source_name').val();
   var l_s = $('#lead_source').val();
   if(s_l_s_name == '')
   {
      $('#sub_lead_source_name_err').html('Sub Lead Source is required!');
      err++;
   }else{
      $('#sub_lead_source_name_err').html('');
   }
   if (l_s == '') {
      $('#lead_source_err').html('Sub Lead Source is required!');
      err++;
   }
   else {
      $('#lead_source_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }
      
}
function edit_sub_lead_source_validation()
{
   var err = 0;
   var s_l_s_name = $('#e_sub_lead_source_name').val();
   var l_s = $('#e_lead_source').val();
   if(s_l_s_name == '')
   {
      $('#e_sub_lead_source_name_err').html('Sub Lead Source is required!');
      err++;
   }else{
      $('#e_sub_lead_source_name_err').html('');
   }
   if (l_s == '') {
      $('#e_lead_source_err').html('Sub Lead Source is required!');
      err++;
   }
   else {
      $('#e_lead_source_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }
      
}

// To check Sub lead Source name is unique
function chk_unique_sub_lead_source()
{
   var l_s_name = $('#lead_source').val();
   var s_l_s_name = $('#sub_lead_source_name').val();
   if (l_s_name == '') {
      $('#sub_lead_source_name_err').html('Choose Lead Source');
      $('#sub_lead_source_name').val('');
      $('#lead_source').focus();
   }
   if (l_s_name != '' && s_l_s_name != '') {
      $.ajax({
         type:"POST",
         url:baseurl+'Leads/sub_lead_source_unique',
         data:{'l_s_name':l_s_name,'s_l_s_name':s_l_s_name},
         cache: false,
         dataType: "html",
         success: function(result){ 
            if(result>0)
            {
               $('#sub_lead_source_name_err').html('Sub Lead Source already exists!');
               $('#btnSubmit').prop('disabled', true);
            }
            else
            {
               $('#sub_lead_source_name_err').html('');
               $('#btnSubmit').prop('disabled', false);
            }
         }
      });
   }
}

// To show lead edit
function sub_lead_source_edit(val)
{
   $.ajax({
      type:"POST",
      url:baseurl+'Leads/sub_lead_source_edit',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         $('#edit_sub_lead_source').empty().append(result);
         $("#edit_sub_lead_source").modal('show');         
      }
   }); 
}


// To validate Sub lead Source edit form
function e_chk_unique_sub_lead_source()
{

   var l_s_name = $('#e_lead_source').val();
   var s_l_s_name = $('#e_sub_lead_source_name').val();
   var ex_s_l_s_name = $('#ex_sub_lead_source_name').val();
   
   if (l_s_name == '') {
      $('#e_sub_lead_source_name_err').html('Choose Lead Source');
      $('#e_sub_lead_source_name').val('');
      $('#e_lead_source').focus();
   }

      if (s_l_s_name.toLowerCase() != ex_s_l_s_name.toLowerCase()) {
         $.ajax({
            type:"POST",
            url:baseurl+'Leads/sub_lead_source_unique',
            data:{'l_s_name':l_s_name,'s_l_s_name':s_l_s_name},
            cache: false,
            dataType: "html",
            success: function(result){ 

               if(result>0)
               {
                  $('#e_sub_lead_source_name_err').html('Sub Lead Source already exists!');
                  $('#e_btnSubmit').prop('disabled', true);
               }
               else
               {
                  $('#e_sub_lead_source_name_err').html('');
                  $('#e_btnSubmit').prop('disabled', false);
               }
            }
         });
      }
   
}

// To delete Sub lead Source id
function sub_lead_source_delete(val){

    $("#delete_sub_lead_source_id").val(val)
   $("#delete_sub_lead_source").modal('show');

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
      url:baseurl+'Leads/sub_lead_source_change_status',
      data:datastring,
      cache: false,
      dataType: "html",

      success: function(result){ 
        if(unactive == 0){
            $('#active_success').show();
            $('#inactive_success').hide();
            setTimeout(function() {
            window.location = baseurl+"Leads/sub_lead_source_list";
         }, 3000);
        }else{
            $('#active_success').hide();
            $('#inactive_success').show();
            setTimeout(function() {
         window.location = baseurl+"Leads/sub_lead_source_list";
         }, 3000);
        }
       } 
   });
}
</script>
   </body>
   <!-- end::Body -->
</html>