<?php $this->load->view('common_header'); $date_format =common_date_format();?>

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="#" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>buyerorder" class="m-nav__link">
                                 <span class="m-nav__link-text">Buyer Order</span>
                              </a>
                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Upload Verified Document</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
               <?php if($this->session->flashdata('purchase_success')){?>
               <div class="alert alert-success alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('purchase_success'); ?>               
               </div>
               <?php } ?> 
               <?php if($this->session->flashdata('purchase_err')){?>
               <div class="alert alert-danger alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('purchase_err'); ?>                
               </div>
               <?php } ?> 

                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Upload Verified Document
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>buyerorder" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <fieldset>
                                 <legend class="text-info"><b>Buyer & Invoice Info</b></legend>
                                    <div class="row">
                                       <div class="col-lg-6">
                                         <label class="col-lg-4">PO Order No</label>
                                         <label class="col-lg-1">:</label>
                                         <p class="col-lg-7"><?php echo ($bo_details->buyer_order_invoice_no) ? $bo_details->buyer_order_invoice_no : '-';?></p>
                                       </div>
                                       <div class="col-lg-6">
                                         <label class="col-lg-4">PO Order Date</label>
                                         <label class="col-lg-1">:</label>
                                         <p class="col-lg-7"><?php echo ($bo_details->order_date) ? date('d-m-Y', strtotime($bo_details->order_date)) : '-';?></p>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                         <label class="col-lg-4">Buyer Name</label>
                                         <label class="col-lg-1">:</label>
                                         <p class="col-lg-7"><?php echo ($bo_details->lead_name) ? $bo_details->lead_name : '-';?></p>
                                       </div>
                                       <div class="col-lg-6">
                                         <label class="col-lg-4">Destination</label>
                                         <label class="col-lg-1">:</label>
                                         <p class="col-lg-7"><?php echo $bo_details->fdname;?> - <?php echo $bo_details->fdcity;?> - <?php echo $bo_details->fdcountry;?></p>
                                       </div>
                                    </div>
                                 </fieldset> 

                                 <fieldset>
                                     <legend class="text-info"><b>Upload Documents</b></legend>
                                     <div class="row">
                                       <div class="col-sm-3">
                                       </div>
                                       <div class="col-sm-6">
                                         <div class="card-box">
                                           <h4 align="center"><strong>Instructions!</strong></h4>
                                           <p class="text-muted text-justify" style="color:#434A54; text-indent:20px">
                                             <i class="fa fa-star"></i> Please Note that the allowed file formats to upload  <strong class="text-danger">*.XLSX, .PDF, .PNG, .JPEG, .doc, .docx only.</strong>
                                           </p>
                                           
                                           <form name="m_file_form" role="form"  method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>buyerorder/upload_po_verify_docs" onsubmit="return verify_docs_validation();">
                                             <h5></h5>
                                             <div class="row">
                                               <div class="col-lg-12">
                                                 <div class="form-group m-form__group">
                                                   <label for="exampleInputEmail1">Upload Verified Documents</label>
                                                   <div></div>
                                                   <div class="custom-file">
                                                     <input type="file" class="custom-file-input" id="file" name="files[]" multiple />

                                                     
                                                     <label class="custom-file-label" for="file">Choose Verified Document</label>
                                                   </div>
                                                   <span id="bo_verify_doc_err" class="text-danger"></span>
                                                 </div> 
                                               </div>
                                             </div>
                                             <div class="row">
                                               <div class="col-lg-12">
                                                 <div class="pull-right">
                                                   <input type="hidden" name="boid" value="<?php echo $boid; ?>">
                                                   <button class="btn btn-success waves-effect waves-light w-sm waves-light m-b-5" type="submit" name="import">Upload</button>
                                                 </div>
                                               </div>
                                             </div>
                                           </form>
                                         </div>
                                       </div>
                                       <div class="col-sm-3">
                                       </div>
                                     </div>
                                   </fieldset>                         

                              <fieldset>
                                 <legend class="text-info"><b>Verified Document List</b></legend>
                                <?php

                                  $inv_no = str_replace('/', '-', $bo_details->buyer_order_invoice_no);

                                  $customer_folder_path = $inv_no.'/verify_docs';

                                  $open = "buyer_order_document/".$customer_folder_path;

                                  if ($files = glob($open . "/*")) 
                                  {

                                    if(!empty($files))
                                    { ?>
                                      

                                          <div class="row">
                                            <div class="col-lg-12">
                                              <!--begin: Datatable -->
                                              <table class="table table-bordered m-table m-table--border-success m-table--head-bg-success" id="m_table_2">
                                              <thead>
                                                <tr>
                                                  <th>File Name</th>
                                                 
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                               foreach ($files as $key => $v_files)
                                                {
                                                  $ex_v_file = explode('/', $v_files);
                                                  $file_name = $ex_v_file[3]; ?>
                                                <tr>
                                                  <td>
                                                    <a href="<?php echo base_url(); ?><?php echo $v_files; ?>" target="_blank"><?php echo $file_name; ?> </a>
                                                  </td>
                                                 
                                                </tr>
                                                <?php } ?>
                                              </tbody>
                                              </table>
                                            </div>
                                          </div>
                                    <?php  }   ?>
                                  <?php }else{?> No File <?php } ?>
                                </fieldset>
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




<script type="text/javascript">
   var er=0;
            $("#file").change(function () {
        //var fileExtension = ['xls', 'xlsx', 'csv'];
        var fileExtension = ['xls', 'csv', 'xlsx', 'png', 'jpg', 'jpeg', 'doc', 'docx', 'pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#bo_verify_doc_err').html('Invalid File!');
            er++;
        }
        else
        {            
            $('#bo_verify_doc_err').html('');
            er--;
        }
    });

   function verify_docs_validation(){
    var err = 0;
      var ferror = $('#file').val();
      if(ferror==''){
         $('#bo_verify_doc_err').html('Choose File!');
         err++;
      }else{
         //$('#ferror_err').html('');
         if(er>0)
         {
            $('#bo_verify_doc_err').html('Invalid File!');
         }
         else
         {
            $('#bo_verify_doc_err').html('');
         }
      }


  if(err>0||er>0){ return false; }else{ return true; }
}    
</script>

   </body>

   <!-- end::Body -->
</html>