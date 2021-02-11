<?php $this->load->view('common_header'); ?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
   <!-- BEGIN: Subheader -->
   <div class="m-subheader ">
      <div class="d-flex align-items-center">
         <div class="mr-auto">
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
               <li class="m-nav__item m-nav__item--home">
                  <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
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
                  <span class="m-nav__link-text">File Manager Access</span>
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
                          File Manager Access
                        </h3>
                     </div>
                  </div>
                  <div class="m-portlet__head-tools">
                     <ul class="m-portlet__nav">
                        <?php if($_SESSION['File Manager AccessAdd']==1){ ?>
                        <li class="m-portlet__nav-item">
                           <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_f_acc">
                           <span>
                           <i class="la la-plus"></i>
                           <span>Create</span>
                           </span>
                           </a>
                        </li>
                        <?php } ?>
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
                     File Access has activated successfully.
                  </div>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     File Access has deactivated successfully.
                  </div>
                  <?php if($this->session->flashdata('qstage_success')){?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     <?php echo $this->session->flashdata('qstage_success'); ?>
                  </div>
                  <?php } ?>
                  <?php if($this->session->flashdata('qstage_err')){ ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     <?php echo $this->session->flashdata('qstage_err'); ?>
                  </div>
                  <?php } ?>  
                  <!--begin: Datatable -->
                  <table class="table table-striped table-bordered  table-checkable" id="m_table_2">
                     <thead>
                        <tr>
                           <th>Folder Name</th>
                           <th>Accessible Roles</th>
                           
                           <th class="notexport" data-orderable="false">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           if(!empty($get_all_folder_access))
                           {
                              $i = 1;
                              foreach ($get_all_folder_access as $f_acc_list) 
                              { ?>
                        <tr>
                           <td>
                              <?php echo $f_acc_list->folder_name; ?>   
                           </td>
                           <td>
                              <?php echo $f_acc_list->allocated_roles; ?>   
                           </td>
                           <td>
                              <?php if($_SESSION['File Manager AccessEdit']==1){ ?>
                              <a href="javascript:;" onclick="edit_fileaccess(<?php echo $f_acc_list->f_id; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                              <?php } ?>
                              <?php if($_SESSION['File Manager AccessDelete']==1){ ?>                                          
                              <a href="javascript:;" data-toggle="modal" data-target="#top_delete" onclick="delete_fileaccess(<?php echo $f_acc_list->f_id; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
                              <?php } ?>
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
<!-- end::Scroll Top -->
<!--begin::Modal-->
<!-- Create Lead Status-->
<div class="container">
   <div class="modal fade" id="create_f_acc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create File Manager Access</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            
            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Settings/create_f_acc" onsubmit="return create_f_acc_validation()">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <label>Folders<span class="text-danger">*</span></label>
                                 <input type="text" name="folder" id="folder" onkeyup="chk_unique_folder_name();" class="form-control"  value="" placeholder="Enter Folder Name">
                                 <span id="folders_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <label>Role<span class="text-danger">*</span></label>
                                 <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="role[]" id="role" multiple>
                                    
                                    <?php
                                       if(!empty($get_all_role_name))
                                       {
                                    foreach ($get_all_role_name as $role_info) { if($role_info->status == 0){ 
                                       if($role_info->role_id != 1){
                                       ?>
                                    <option value="<?php echo $role_info->role_id; ?>" ><?php echo $role_info->role_name; ?></option>
                                    <?php } } }
                                       }
                                       ?>
                                 </select>
                                 <span id="role_err" class="text-danger"></span>
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
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Update exporter-->
<div class="container">
   <div class="modal fade" id="edit_fileaccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   </div>
</div>
<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="del_f_acc_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete File Manager Access</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?php echo base_url(); ?>Settings/del_filemanager_access" method="POST">
               <div class="modal-body">
                  <p>Are You Sure You Want to Delete this File Manager Access?</p>
                  <input type="hidden" name="del_f_acc_id" id="del_f_acc_id">
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Yes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   var baseurl = '<?php echo base_url(); ?>';
   
   var title = $('title').text() + ' | ' + 'Interest List';
   
   $(document).attr("title", title); 
   
   
   // To check exporter name is unique
   
   var expo = 0;
   
   function chk_unique_folder_name()
   
   {
   
      var val = $('#folder').val();
   
      $.ajax({
   
         type:"POST",
   
         url:baseurl+'Settings/chk_unique_folder_name',
   
         data:{'value':val},
   
         cache: false,
   
         dataType: "html",
   
         success: function(result){
   
            if(result>0)
   
            {
   
               $('#folders_err').html('Folder Name is already exists!');
   
               $('#btnSubmit').prop('disabled', true);
   
               expo = 1;
   
            }
   
            else
   
            {
   
               $('#folders_err').html('');
   
               $('#btnSubmit').prop('disabled', false);
   
               expo = 0;
   
            }
   
         }
   
      });
   
   }
   
   
   
   
   
    // To validate lead Status add form
   
   function create_f_acc_validation()
   
   {
   
      var err = 0;
   
      var role = $('#role').val();
   
      var folders = $('#folder').val();
   
      if(role == '')
   
      {
   
         $('#role_err').html('Role is required!');
   
         err++;
   
      }else{
   
         if(expo == 1)
   
         {
   
            $('#role_err').html('Role is already exists!');
   
            err++;
   
         }
   
         else
   
         {
   
            $('#role_err').html('');
   
         }
   
      }
   
    
   
      if (folders == '') {
   
         $('#folders_err').html('Folders is required!');
   
         err++;
   
      }
   
      else {
   
         $('#folders_err').html('');
   
      }
   
      if(err> 0){ return false;}else{ return true; }   
   
   }
   
   
   
   // To edit exporter
   
   function edit_fileaccess(val)
   
   {
   
      $.ajax({
   
      type: "POST",
   
      url: baseurl+'Settings/edit_fileaccess',
   
      async: false,
   
      data: "value="+val,
   
      dataType: "html",
   
      success: function(response)
   
      {
   
      $('#edit_fileaccess').empty().append(response);
      $('#edit_fileaccess').modal('show');
   
      }
   
      });
   
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
   
         url:baseurl+'Terms_of_payment/top_change_status',
   
         data:datastring,
   
         cache: false,
   
         dataType: "html",
   
         success: function(result){ 
   
           if(unactive == 0){
   
               $('#active_success').show();
   
               $('#inactive_success').hide();
   
               setTimeout(function() {
   
               window.location = baseurl+"Terms_of_payment";
   
            }, 3000);
   
           }else{
   
               $('#active_success').hide();
   
               $('#inactive_success').show();
   
               setTimeout(function() {
   
            window.location = baseurl+"Terms_of_payment";
   
            }, 3000);
   
           }
   
          } 
   
      });
   
   }
   
   // To delete exporter

   function delete_fileaccess(val){
      $('#del_f_acc_id').empty().val(val);
      $('#del_f_acc_modal').modal('show');
   } 
   
   
   
</script>
</body>
<!-- end::Body -->
</html>