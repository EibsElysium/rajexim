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
                              <a href="<?php echo base_url(); ?>Terms_of_payment" class="m-nav__link">
                                 <span class="m-nav__link-text">Terms of Payment</span>
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
                                       Terms of Payment List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Terms of PaymentAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_top">
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
                                 Terms of Payment has activated successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Terms of Payment has deactivated successfully.
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
                                    <th>Terms of Payment Name</th>
                                    <th>Terms of Payment Text</th>
                                    <th>Terms of Payment Type</th>
                                    <th>Status</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($terms_of_payment_list))
                                    {
                                       $i = 1;
                                       foreach ($terms_of_payment_list as $top_list) 
                                       { ?>
                                          <tr>
                                             <td>
                                                <?php echo $top_list['terms_of_payment_name']; ?>   
                                             </td>
                                             <td>
                                                <?php echo $top_list['terms_of_payment_text']; ?>   
                                             </td>
                                             <td>
                                                <?php echo $top_list['terms_of_payment_type']; ?>   
                                             </td>
                                             <td>
                                                <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="<?php if($top_list['status']==0){ echo 'Active'; }else{ echo 'In Active'; } ?>">
                                                <label>
                                                   <input type="checkbox" <?php if($top_list['status']==0){ echo "checked";} ?> name="activeunactive_<?php echo $i;?>" id="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $top_list['terms_of_payment_id']; ?>,<?php echo $i; ?>)" value="<?php echo $top_list['status'];?>">
                                                   <span></span>
                                                </label>
                                                </span>
                                             </td>
                                             <td>
                                                   <?php if($_SESSION['Terms of PaymentEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#top_edit" onclick="return top_edit(<?php echo $top_list['terms_of_payment_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                   <?php }?>
                                                   <?php if($_SESSION['Terms of PaymentDelete']==1){ ?>                                              
                                                   <a href="javascript:;" data-toggle="modal" data-target="#top_delete" onclick="return top_delete(<?php echo $top_list['terms_of_payment_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
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
   <div class="modal fade" id="create_top" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Terms of Payment</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Terms_of_payment/create_top" onsubmit="return create_top_validataion()">
                  <div class="modal-body">
                     <div class="row">                        
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Terms of Payment Type<span class="text-danger">*</span></label>
                              <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="top_type" id="top_type" onchange="getTermsandPayment(this.value);">
                                 <option value="">Choose Terms of Payment Type</option>
                                    <?php
                                       if(!empty($get_top_type))
                                       {
                                          foreach ($get_top_type as $top_type) { if($top_type->status == 0){ ?>
                                             <option value="<?php echo $top_type->terms_of_payment_type_id; ?>" ><?php echo $top_type->terms_of_payment_type; ?></option>
                                          <?php } }
                                       }
                                    ?>
                              </select>
                              <span id="top_type_err" class="text-danger"></span>
                           </div>
                        </div>
                     </div>
                     <div class="row">                        
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Terms And Payment<span class="text-danger">*</span></label>
                              <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="terms_and_payment_id" id="terms_and_payment_id">
                                 <option value="">Choose Terms And Payment</option>
                              </select>
                              <span id="terms_and_payment_id_err" class="text-danger"></span>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Terms of Payment Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Terms of Payment Name" name="top_name" id="top_name" onkeyup="checkUniquetopName();">
                                    <span id="top_name_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Terms of Payment Text<span class="text-danger">*</span></label>
                                    <textarea class="form-control snote" placeholder="Enter Terms of Payment Text" name="top_text" id="top_text" ></textarea>
                                    <span id="top_text_err" class="text-danger"></span>
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
   <div class="modal fade" id="top_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="top_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Terms of payment</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?php echo base_url(); ?>Terms_of_payment/top_delete" method="POST">
               <div class="modal-body">
                  <p>Are You Sure You Want to Delete this Terms of payment Permanently?</p>
                  <input type="hidden" name="del_terms_of_payment_id" id="del_terms_of_payment_id">
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

$('.snote').summernote();

function getTermsandPayment(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'Terms_of_payment/getTermsandPayment',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#terms_and_payment_id').empty().html(response).selectpicker('refresh');
        }
      });
   }
   else
   {      
      $('#terms_and_payment_id').empty().html('<option vaue="">Choose Term and Payment</option>').selectpicker('refresh');
   }
}

// To check exporter name is unique
var expo = 0;
function checkUniquetopName()
{
   var val = $('#top_name').val();
   $.ajax({
      type:"POST",
      url:baseurl+'Terms_of_payment/checkUniquetopName',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#top_name_err').html('Terms of payment Name already exists!');
            $('#btnSubmit').prop('disabled', true);
            expo = 1;
         }
         else
         {
            $('#top_name_err').html('');
            $('#btnSubmit').prop('disabled', false);
            expo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function create_top_validataion()
{
   var err = 0;
   var name = $('#top_name').val();
   var txt = $('#top_text').val();
   var type = $('#top_type').val();
   var tapid = $('#terms_and_payment_id').val();
   if(name == '')
   {
      $('#top_name_err').html('Terms of payment Name is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#top_name_err').html('Terms of payment Name already exists!');
         err++;
      }
      else
      {
         $('#top_name_err').html('');
      }
   }
   if (txt.trim() == '') {
      $('#top_text_err').html('Terms of payment Text is required!');
      err++;
   }
   else {
      $('#top_text_err').html('');
   }
   if (type == '') {
      $('#top_type_err').html('Terms of payment Type is required!');
      err++;
   }
   else {
      $('#top_type_err').html('');
   }
   if (tapid == '') {
      $('#terms_and_payment_id_err').html('Choose Terms and Payment!');
      err++;
   }
   else {
      $('#terms_and_payment_id_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }   
}

// To edit exporter
function top_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'Terms_of_payment/top_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#top_edit').empty().append(response);
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


function top_delete(val){
   $('#del_terms_of_payment_id').empty().val(val);
   $('#top_delete').modal('show');
}


</script>
</body>
   <!-- end::Body -->
</html>