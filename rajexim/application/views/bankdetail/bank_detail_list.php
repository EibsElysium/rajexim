<?php $this->load->view('common_header'); ?>
       <link href="<?php echo base_url();?>assets/mailbox/js/summernote/summernote.css" rel="stylesheet">

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
                                 <span class="m-nav__link-text">Proforma Invoice</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>bankdetail" class="m-nav__link">
                                 <span class="m-nav__link-text">Bank Detail</span>
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
                                       Bank Detail List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Bank DetailAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_bankdetail">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php }?>

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
                                 Bank Detail has activated successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Bank Detail has deactivated successfully.
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
                           <table class="table table-striped table-bordered  table-checkable" id="m_table_2">
                              <thead>
                                 <tr>
                                    <th>Exporter</th>
                                    <th>Currency</th>
                                    <th>Bank Label</th>
                                    <th>Correspondence Bank</th>
                                    <th>Bank Detail</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($bank_detail_list))
                                    {
                                       $i = 1;
                                       foreach ($bank_detail_list as $e_list) 
                                       { ?>
                                          <tr>
                                             <td>
                                                <?php echo $e_list['exporter_name']; ?>   
                                             </td>
                                             <td>
                                                <?php echo $e_list['currency_name']; ?> - <?php echo $e_list['currency_code']; ?>   
                                             </td>
                                             <td>
                                                <?php echo $e_list['bank_label']; ?>   
                                             </td>
                                             <td>
                                                <?php echo $e_list['correspondence_bank']; ?>   
                                             </td>
                                             <td>
                                                <?php echo $e_list['bank_detail']; ?>   
                                             </td>
                                             <td>
                                                   <?php if($_SESSION['Bank DetailEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#bankdetail_edit" onclick="return bankdetail_edit(<?php echo $e_list['bank_detail_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                   <?php }?>
                                                   <?php if($_SESSION['Bank DetailDelete']==1){ ?>                                              
                                                   <a href="javascript:;" data-toggle="modal" data-target="#bankdetail_delete" onclick="return bankdetail_delete(<?php echo $e_list['bank_detail_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
                                                   <?php }?>
                                                
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
   <div class="modal fade" id="create_bankdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Bank Detail</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>bankdetail/create_bankdetail" onsubmit="return bankdetail_validation()">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="row">                        
                              <div class="col-lg-4">
                                 <div class="form-group m-form__group">
                                    <label>Exporter<span class="text-danger">*</span></label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="exporter_id" id="exporter_id"> 
                                       <option value="">Choose Exporter</option>
                                       <?php
                                          if(!empty($exporter_list))
                                          {
                                             foreach ($exporter_list as $vflist) { ?>
                                                <option value="<?php echo $vflist['exporter_id']; ?>"><?php echo $vflist['exporter_name']; ?></option>
                                             <?php }
                                          }
                                       ?>
                                    </select>
                                    <span class="text-danger" id="exporter_id_err"></span>
                                 </div>
                              </div>                        
                              <div class="col-lg-4">
                                 <div class="form-group m-form__group">
                                    <label>Currency<span class="text-danger">*</span></label>
                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="currency_id" id="currency_id"> 
                                       <option value="">Choose Currency</option>
                                       <?php
                                          if(!empty($currency_list))
                                          {
                                             foreach ($currency_list as $vflist) { ?>
                                                <option value="<?php echo $vflist['currency_id']; ?>"><?php echo $vflist['currency_name']; ?> - <?php echo $vflist['currency_code']; ?></option>
                                             <?php }
                                          }
                                       ?>
                                    </select>
                                    <span class="text-danger" id="currency_id_err"></span>
                                 </div>
                              </div>                       
                              <div class="col-lg-4">
                                 <div class="form-group m-form__group">
                                    <label>Bank Label<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Bank Label" name="bank_label" id="bank_label">
                                    <span id="bank_label_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">                        
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Correspondence Bank<span class="text-danger">*</span></label>
                                    <textarea class="form-control snote" rows="5" id="correspondence_bank" name="correspondence_bank"></textarea>
                                    <span id="correspondence_bank_err" class="text-danger"></span>
                                 </div>
                              </div>                       
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Bank Detail<span class="text-danger">*</span></label>
                                    <textarea class="form-control snote" rows="5" id="bank_detail" name="bank_detail"></textarea>
                                    <span id="bank_detail_err" class="text-danger"></span>
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
   <div class="modal fade" id="bankdetail_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="bankdetail_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Bank Detail List';
$(document).attr("title", title); 
$('.snote').summernote();

function bankdetail_validation()
{
   var err = 0;
   var eid = $('#exporter_id').val();
   var cid = $('#currency_id').val();
   var blabel = $('#bank_label').val();
   var cbank = $('#correspondence_bank').val();
   var bdetail = $('#bank_detail').val();

   if(eid=='')
   {
      $('#exporter_id_err').html('Choose Exporter!');
      err++;
   }
   else
   {
      $('#exporter_id_err').html('');
   }

   if(cid=='')
   {
      $('#currency_id_err').html('Choose Currency!');
      err++;
   }
   else
   {
      $('#currency_id_err').html('');
   }

   if(blabel == '')
   {
      $('#bank_label_err').html('Bank Label is required!');
      err++;
   }else{
      $('#bank_label_err').html('');
   }

   if(cbank=='')
   {
      $('#correspondence_bank_err').html('Correspondence Bank is required!');
      err++;
   }
   else
   {
      $('#correspondence_bank_err').html('');
   }

   if(bdetail=='')
   {
      $('#bank_detail_err').html('Bank Detail is required!');
      err++;
   }
   else
   {
      $('#bank_detail_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

function bankdetail_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'bankdetail/bankdetail_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#bankdetail_edit').empty().append(response);
   }
   });
}

function bankdetail_delete(val){
$.ajax({
type: "POST",
url: baseurl+'bankdetail/bankdetail_delete',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#bankdetail_delete').empty().append(response);
}
});
}

function removeBankdetail(val)
{ 
$.ajax({
type: "POST",
url: baseurl+'bankdetail/delete',
async: false,
data:"field="+val,
success: function(response)
{
window.location.href = baseurl+'bankdetail';
}
});
}



</script>
</body>
   <!-- end::Body -->
</html>