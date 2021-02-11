<?php $this->load->view('common_header'); ?>
<style>
   .folder_ico_style{
      text-decoration: none;
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
                  <i class="m-nav__link-icon la la-home"></i>
                  </a>
               </li>
               <li class="m-nav__separator">-</li>
               <li class="m-nav__item">
                  <a href="<?php echo base_url(); ?>Settings/filemanager" class="m-nav__link">
                  <span class="m-nav__link-text">FileManager</span>
                  </a>
               </li>
               <li class="m-nav__separator">-</li>
               <li class="m-nav__item">
                  <a href="<?php echo base_url(); ?>Settings/filemanager" class="m-nav__link">
                  <span class="m-nav__link-text">File Manager List</span>
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
                          File Manager 
                        </h3>
                     </div>
                  </div>
                  <div class="m-portlet__head-tools">
                     
                  </div>
               </div>
               <div class="m-portlet__body">
                  <div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     File has activated successfully.
                  </div>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     File has deactivated successfully.
                  </div>
                  <?php if($this->session->flashdata('qstage_success')){?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     <?php echo $this->session->flashdata('qstage_success'); ?>
                  </div>
                  <?php } ?>
                  <?php if($this->session->flashdata('qstage_err')){?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     <?php echo $this->session->flashdata('qstage_err'); ?>
                  </div>
                  <?php } ?>  
                  <!--begin: Datatable -->
                  <div class="container">
                     <div class="row">
                        <?php foreach ($get_user_folders as $folders) { ?>
                        <div class="col-lg-2">
                           <a class="filemanager_iframe" href="<?php echo base_url(); ?>assets/responsive_filemanager/filemanager/dialog.php?fldr=<?php echo $folders->folder_name; ?>&get_fldr_from_filemanager=<?php echo $folders->folder_name; ?>">
                              <p class="text-center"><i class="fa fa-folder" style="font-size: 91px; color: #EEC103;"></i></p>
                              <p class="text-center" style="text-decoration: none;"><?php echo $folders->folder_name; ?></p>
                           </a>   
                        </div>
                        <?php } ?>
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
<!-- end::Scroll Top -->
<!--begin::Modal-->
<!-- Create Lead Status-->

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
</script>
</body>
<!-- end::Body -->
</html>