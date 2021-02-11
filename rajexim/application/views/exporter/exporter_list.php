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
                                 <span class="m-nav__link-text">Proforma Invoice</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>exporter" class="m-nav__link">
                                 <span class="m-nav__link-text">Exporter</span>
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
                                       Exporter List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['ExporterAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_exporter">
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
                                 Exporter has activated successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Exporter has deactivated successfully.
                              </div>

                              <?php if($this->session->flashdata('expo_success')){?>
                                   <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('expo_success'); ?>
                                 </div>
                                 <?php } ?>

                              <?php if($this->session->flashdata('expo_err')){?>
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('expo_err'); ?>
                                 </div>
                                 <?php } ?>  
                              <!--begin: Datatable -->
                           <table class="table table-striped table-bordered  table-checkable" id="m_table_2">
                              <thead>
                                 <tr>
                                    <th>Logo</th>
                                    <th>Exporter</th>
                                    <th>Contact Info</th>
                                    <th>GST No</th>
                                    <th>IEC No</th>
                                    <th>Status</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($exporter_list))
                                    {
                                       $i = 1;
                                       foreach ($exporter_list as $e_list) 
                                       { ?>
                                          <tr>
                                             <td><img src="<?php echo base_url(); ?>exporterlogo/<?php echo str_replace(' ', '_',$e_list['exporter_logo']); ?>" height="75" width="75" style="object-fit: contain;border: 1px solid #ccc;"></td>
                                             <td>
                                                <h5  style="margin-bottom: 0px;">
                                                <?php echo $e_list['exporter_name']; ?></h5>
                                                <span style="font-size: 16.5px;" class="text-muted"><b><sub> <?php echo $e_list['exporter_country']; ?> 
                                                </sub><b></b></b></span>    
                                             </td>
                                             <td>
                                                <h5  style="margin-bottom: 0px;">
                                                <?php echo $e_list['contact_name']; ?>
                                                </h5>
                                                <span style="font-size: 16.5px;" class="text-muted"><b><sub> 
                                                <?php echo $e_list['phone_no']; ?>  

                                                </sub><b></b></b></span>   
                                             </td>
                                             <td><?php echo $e_list['gst_no']; ?></td>
                                             <td><?php echo $e_list['iec_no']; ?></td>
                                             <td>
                                                <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="<?php if($e_list['status']==0){ echo 'Active'; }else{ echo 'In Active'; } ?>">
                                                <label>
                                                   <input type="checkbox" <?php if($e_list['status']==0){ echo "checked";} ?> name="activeunactive_<?php echo $i;?>" id="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $e_list['exporter_id']; ?>,<?php echo $i; ?>)" value="<?php echo $e_list['status'];?>">
                                                   <span></span>
                                                </label>
                                                </span>
                                             </td>
                                             <td>
                                                <?php if($_SESSION['ExporterView']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#exporter_view" onclick="return exporter_view(<?php echo $e_list['exporter_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                                                   <?php }?>
                                                   <?php if($_SESSION['ExporterEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#exporter_edit" onclick="return exporter_edit(<?php echo $e_list['exporter_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                   <?php }?>
                                                   <?php if($_SESSION['ExporterDelete']==1){ ?>                                              
                                                   <a href="javascript:;" data-toggle="modal" data-target="#exporter_delete" onclick="return exporter_delete(<?php echo $e_list['exporter_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
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
   <div class="modal fade" id="create_exporter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Exporter</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>exporter/create_exporter" onsubmit="return exporter_validation()">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="row">                        
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Exporter Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Exporter Name" name="exporter_name" id="exporter_name" onkeyup="checkUniqueExporter();">
                                    <span id="exporter_name_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Address</label>
                                    <textarea class="form-control m-input" id="exporter_address" name="exporter_address" rows="3"></textarea>
                                    <span id="exporter_address_err" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Country</label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Country" name="exporter_country" id="exporter_country">
                                    <span id="exporter_country_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Contact Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Name" name="contact_name" id="contact_name">
                                    <span id="contact_name_err" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Contact No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact No" name="phone_no" id="phone_no">
                                    <span id="phone_no_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>State Name</label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter State Name" name="state_name" id="state_name">
                                    <span id="state_name_err" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>State Code</label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter State Code" name="state_code" id="state_code">
                                    <span id="state_code_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>GST No</label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter GST No" name="gst_no" id="gst_no">
                                    <span id="gst_no_err" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>IEC No</label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter IEC No" name="iec_no" id="iec_no">
                                    <span id="iec_no_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>VAT TIN No</label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter VAT TIN No" name="vat_tin_no" id="vat_tin_no">
                                    <span id="vat_tin_no_err" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>CST No</label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter CST No" name="cst_no" id="cst_no">
                                    <span id="cst_no_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>PAN No</label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter PAN No" name="pan_no" id="pan_no">
                                    <span id="pan_no_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">                        
                              <div class="col-lg-6">
                                 <div class="text-center">
                                    <div class="form-group m-form__group">                                 
                                       <label>Logo</label>
                                       <div>
                                          <div class="fileinput fileinput-new" data-provides="fileinput">
                                             <div class="fileinput-new thumbnail img-file">
                                                <img src="<?php echo base_url();?>exporterlogo/deflogo.jpg" width="200" class="img-responsive" height="150" alt="logo">
                                             </div>
                                             <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" class="img-responsive" height="150">
                                             </div>
                                             <div class="text-center">
                                                <span class="btn btn-primary btn-file ">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" class="custom-file-input" id="exporter_logo" name="exporter_logo">
                                                </span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                             </div>
                                             <span class="m-form__help text-danger" id="exporter_logo_err"></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>                          
                              <div class="col-lg-6">
                                 <div class="text-center">
                                    <div class="form-group m-form__group">                                 
                                       <label>Sign</label>
                                       <div>
                                          <div class="fileinput fileinput-new" data-provides="fileinput">
                                             <div class="fileinput-new thumbnail img-file">
                                                <img src="<?php echo base_url();?>exportersign/signature.jpg" width="200" class="img-responsive" height="150" alt="logo">
                                             </div>
                                             <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" class="img-responsive" height="150">
                                             </div>
                                             <div class="text-center">
                                                <span class="btn btn-primary btn-file ">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" class="custom-file-input" id="exporter_sign_file" name="exporter_sign_file">
                                                </span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                             </div>
                                             <span class="m-form__help text-danger" id="exporter_sign_file_err"></span>
                                          </div>
                                       </div>
                                    </div>
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
   <div class="modal fade" id="exporter_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="exporter_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Exporter View-->
<div class="container">
   <div class="modal fade" id="exporter_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Exporter List';
$(document).attr("title", title); 

var elogo=0;
var esign=0;
/*$('#exporter_logo').change(
function () {
   var fileExtension = ['jpeg', 'jpg', 'png'];
   if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
      //alert("Only '.jpeg','.jpg','.pdf' formats are allowed.");
      $('#exporter_logo_err').html('Allow Image files only!');
      elogo=1;

   return false; }
   else
   {
      $('#exporter_logo_err').html('');
      elogo=0;
   }
}); 

$('#exporter_sign_file').change(
function () {
   var fileExtension = ['jpeg', 'jpg', 'png'];
   if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
      //alert("Only '.jpeg','.jpg','.pdf' formats are allowed.");
      $('#exporter_sign_file_err').html('Allow Image files only!');
      esign=1;
   return false; }
   else
   {
      $('#exporter_sign_file_err').html('');
      esign=0;
   }
});*/


$("#exporter_logo").change(function() {

  var ext = document.getElementById('exporter_logo').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#btnsubmit').prop('disabled', true);
            $('#exporter_logo_err').html('Allow Image files only!');
            elogo=1;
        }else{
            $('#btnsubmit').prop('disabled', false);
            $('#exporter_logo_err').html('');
            elogo=0;
        }
    }else{  $('#btnsubmit').prop('disabled', false);
            $('#exporter_logo_err').html(''); elogo=0; }
});

$("#exporter_sign_file").change(function() {

  var ext = document.getElementById('exporter_sign_file').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#btnsubmit').prop('disabled', true);
            $('#exporter_sign_file_err').html('Allow Image files only!');
            esign=1;
        }else{
            $('#btnsubmit').prop('disabled', false);
            $('#exporter_sign_file_err').html('');
            esign=0;
        }
    }else{  $('#btnsubmit').prop('disabled', false);
            $('#exporter_sign_file_err').html(''); esign=0; }
});


// To check exporter name is unique
var expo = 0;
function checkUniqueExporter()
{
   var val = $('#exporter_name').val();
   $.ajax({
      type:"POST",
      url:baseurl+'exporter/checkUniqueExporter',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#exporter_name_err').html('Exporter already exists!');
            $('#btnSubmit').prop('disabled', true);
            expo = 1;
         }
         else
         {
            $('#exporter_name_err').html('');
            $('#btnSubmit').prop('disabled', false);
            expo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function exporter_validation()
{
   var err = 0;
   var name = $('#exporter_name').val();
   var address = $('#exporter_address').val();
   var country = $('#exporter_country').val();
   var cname = $('#contact_name').val();
   var pno = $('#phone_no').val();
   var gstno = $('#gst_no').val();
   var iecno = $('#iec_no').val();
   var sname = $('#state_name').val();
   var scode = $('#state_code').val();
   var vtno = $('#vat_tin_no').val();
   var cstno = $('#cst_no').val();
   var panno = $('#pan_no').val();
   /*var logo = $('#exporter_logo').val();
   var sign = $('#exporter_sign_file').val();*/
   if(name == '')
   {
      $('#exporter_name_err').html('Exporter Name is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#exporter_name_err').html('Exporter already exists!');
         err++;
      }
      else
      {
         $('#exporter_name_err').html('');
      }
   }
   // if(address == '')
   // {
   //    $('#exporter_address_err').html('Exporter Address is required!');
   //    err++;
   // }else{
   //    $('#exporter_address_err').html('');
   // }
   // if(country == '')
   // {
   //    $('#exporter_country_err').html('Exporter Country is required!');
   //    err++;
   // }else{
   //    $('#exporter_country_err').html('');
   // }

   if(cname == '')
   {
      $('#contact_name_err').html('Contact Name is required!');
      err++;
   }else{
      $('#contact_name_err').html('');
   }
   if(pno == '')
   {
      $('#phone_no_err').html('Contact No is required!');
      err++;
   }else{
      $('#phone_no_err').html('');
   }

   // if(gstno == '')
   // {
   //    $('#gst_no_err').html('GST No is required!');
   //    err++;
   // }else{
   //    $('#gst_no_err').html('');
   // }
   // if(iecno == '')
   // {
   //    $('#iec_no_err').html('IEC No is required!');
   //    err++;
   // }else{
   //    $('#iec_no_err').html('');
   // }
   // if(sname == '')
   // {
   //    $('#state_name_err').html('State Name is required!');
   //    err++;
   // }else{
   //    $('#state_name_err').html('');
   // }
   // if(scode == '')
   // {
   //    $('#state_code_err').html('State Code is required!');
   //    err++;
   // }else{
   //    $('#state_code_err').html('');
   // }
   // if(vtno == '')
   // {
   //    $('#vat_tin_no_err').html('VAT TIN No is required!');
   //    err++;
   // }else{
   //    $('#vat_tin_no_err').html('');
   // }
   // if(cstno == '')
   // {
   //    $('#cst_no_err').html('CST No is required!');
   //    err++;
   // }else{
   //    $('#cst_no_err').html('');
   // }
   // if(panno == '')
   // {
   //    $('#pan_no_err').html('PAN No is required!');
   //    err++;
   // }else{
   //    $('#pan_no_err').html('');
   // }

   // if(elogo==1)
   // {
   //    $('#exporter_logo_err').html('Allow Image files only!');
   //    err++;
   // }
   // else
   // {
   //    $('#exporter_logo_err').html('');
   // }

   // if(esign==1)
   // {
   //    $('#exporter_sign_file_err').html('Allow Image files only!');
   //    err++;
   // }
   // else
   // {
   //    $('#exporter_sign_file_err').html('');
   // }
   
   if(err> 0){ return false;}else{ return true; }   
}

// To show exporter
function exporter_view(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'exporter/exporter_view',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#exporter_view').empty().append(response);
   }
   });
}

// To edit exporter
function exporter_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'exporter/exporter_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#exporter_edit').empty().append(response);
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
      url:baseurl+'exporter/exporter_change_status',
      data:datastring,
      cache: false,
      dataType: "html",
      success: function(result){ 
        if(unactive == 0){
            $('#active_success').show();
            $('#inactive_success').hide();
            setTimeout(function() {
            window.location = baseurl+"exporter";
         }, 3000);
        }else{
            $('#active_success').hide();
            $('#inactive_success').show();
            setTimeout(function() {
         window.location = baseurl+"exporter";
         }, 3000);
        }
       } 
   });
}
// To delete exporter


function exporter_delete(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'exporter/exporter_delete',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#exporter_delete').empty().append(response);
}
});
}

function removeExporter(val)
{ 
//var baseurl= $("#baseUrl").val();
$.ajax({
type: "POST",
url: baseurl+'exporter/delete',
async: false,
data:"field="+val,
success: function(response)
{
window.location.href = baseurl+'exporter';
}
});
}



</script>
</body>
   <!-- end::Body -->
</html>