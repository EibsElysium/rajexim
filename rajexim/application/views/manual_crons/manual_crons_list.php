<?php $this->load->view('common_header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   .border_crons{
      border: 1px solid #000;
      padding: 15px;
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
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Settings</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Run Auto Setup Functions</span>
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
                                       Run Auto Setup Functions 
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
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
                                 Run Auto Setup Functions has activated successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Run Auto Setup Functions has deactivated successfully.
                              </div>

                              <?php if($this->session->flashdata('qstage_success')){ ?>
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
                              <div class="row">
                                 <?php if ($_SESSION['Run Auto Setup FunctionsEmail_import']==1) { ?>
                                 <div class="col-lg-6 border_crons">
                                  <div class="card-small">
                                    <h4 class="card__name">
                                        <span>Mail Box Configured Emails with lead Flagged Mails Import</span>
                                    </h4>
                                    <i class="la la-envelope laprof" aria-hidden="true"></i>
                                    <div class="card__number">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air " id="mail_imp_btn" onclick="run_mails_import_function();">
                                          <span>
                                             <i id="mail_imp_btn_ico" class="fa fa-play"></i>
                                             <span id="mail_imp_btn_label">Run</span>
                                          </span>
                                       </a>
                                    </div>
                                  </div>
                                </div>
                                <?php } ?>
                                <?php if ($_SESSION['Run Auto Setup FunctionsDB_backup']==1) { ?>
                                <div class="col-lg-6 border_crons">
                                  <div class="card-small">
                                    <h4 class="card__name">
                                        <span>DataBase Backup</span>
                                    </h4>
                                    <i class="la la-database lalead" aria-hidden="true"></i>
                                    <div class="card__number">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air " id="db_backup_btn" onclick="run_db_backup_function();">
                                          <span>
                                             <i id="db_back_btn_ico" class="fa fa-play"></i>
                                             <span id="db_back_btn_label">Run</span>
                                          </span>
                                       </a>
                                    </div>
                                  </div>
                                </div>
                                <?php } ?>
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

   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'PI Stages List';
$(document).attr("title", title); 

function run_mails_import_function()
{
   $('#mail_imp_btn_ico').removeClass('fa fa-play');
   $('#mail_imp_btn_label').html('Running');
   $('#mail_imp_btn_ico').addClass('fa fa-circle-o-notch fa-spin');
   $.ajax({
      type:"POST",
      url:baseurl+'Mailbox/run_mails_import_function',
      cache: false,
      dataType: "html",
      success: function(result){
         // alert(result);
         console.log(result); 
         if(result == 1)
         {
            $('#mail_imp_btn_ico').removeClass('fa fa-circle-o-notch fa-spin');
            $('#mail_imp_btn_label').html('Completed');
            $('#mail_imp_btn_ico').addClass('fa fa-check');
         }
         else
         {
            $('#mail_imp_btn_ico').removeClass('fa fa-circle-o-notch fa-spin');
            $('#mail_imp_btn_label').html('Error, Try Again');
            $('#mail_imp_btn_ico').addClass('fa fa-times');
         }
      }
   });
}



function run_db_backup_function()
{
   $('#db_back_btn_ico').removeClass('fa fa-play');
   $('#db_back_btn_label').html('Running');
   $('#db_back_btn_ico').addClass('fa fa-circle-o-notch fa-spin');
   $('#mail_imp_btn').prop('disabled', true);
   $.ajax({
      type:"POST",
      url:baseurl+'Login/export_backup_db',
      cache: false,
      dataType: "html",
      success: function(result){

         if(result == 1)
         {
            $('#db_back_btn_ico').removeClass('fa fa-circle-o-notch fa-spin');
            $('#db_back_btn_label').html('Completed');
            $('#db_back_btn_ico').addClass('fa fa-check');
         }
         else
         {
            $('#db_back_btn_ico').removeClass('fa fa-circle-o-notch fa-spin');
            $('#db_back_btn_label').html('Error, Try Again');
            $('#db_back_btn_ico').addClass('fa fa-times');
         }
      }
   });
}





</script>
</body>
   <!-- end::Body -->
</html>