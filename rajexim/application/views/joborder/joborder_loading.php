<?php $this->load->view('common_header'); $date_format =common_date_format();?>
<link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-preview.min.css" rel="stylesheet" type="text/css" />
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
                              <a href="<?php echo base_url(); ?>joborder" class="m-nav__link">
                                 <span class="m-nav__link-text">Job Order</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Loading Document</span>
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
                                      Loading Document - <?php echo $joborder_list->job_order_no;?>
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url();?>joborder" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                       <span>
                                       <i class="la la-angle-double-left"></i>
                                       <span>Back</span>
                                       </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <?php $date_format =common_date_format();?>
                           <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>joborder/upload_loading_files" onsubmit="return joborder_loading_validation();">
                              <!-- <input type="hidden" id="job_order_id" name="job_order_id" value="<?php echo $joborder_list->job_order_id;?>"> -->
                              <div class="m-portlet__body">

                                 <div class="row">
                                    <div class="col-lg-12">
                                       <fieldset>
                                          <legend class="text-info"><b>Job Order Info</b></legend>
                                             <div class="row">
                                                <div class="col-lg-6">
                                                   <label class="col-lg-5">JO Date</label>
                                                   <label class="col-lg-1">:</label>
                                                   <p class="col-lg-5"><?php echo date($date_format, strtotime($joborder_list->job_order_date));?></p>
                                                </div>
                                                <div class="col-lg-6">
                                                   <label class="col-lg-5">JO End Date</label>
                                                   <label class="col-lg-1">:</label>
                                                   <p class="col-lg-5"><?php echo date($date_format, strtotime($joborder_list->job_order_end_date));?></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-6">
                                                   <label class="col-lg-5">SPO No</label>
                                                   <label class="col-lg-1">:</label>
                                                   <p class="col-lg-5"><?php echo $joborder_list->supplier_purchase_order_no;?></p>
                                                </div>
                                                <div class="col-lg-6">
                                                   <label class="col-lg-5">Assigned To</label>
                                                   <label class="col-lg-1">:</label>
                                                   <p class="col-lg-5"><?php echo $joborder_list->display_name;?></p>
                                                </div>
                                             </div>
                                              <div class="row">
                                                 <div class="col-lg-6">
                                                    <label class="col-lg-5">Buyer</label>
                                                    <label class="col-lg-1">:</label>
                                                    <p class="col-lg-5"><?php echo $joborder_list->lead_name;?></p>
                                                 </div>
                                                 <div class="col-lg-6">
                                                    <label class="col-lg-5">Vendor</label>
                                                    <label class="col-lg-1">:</label>
                                                    <p class="col-lg-5"><?php echo $joborder_list->vendor_name;?></p>
                                                 </div>
                                              </div>
                                               <!-- <fieldset>
                                                  <legend class="text-info"><b>Specification</b></legend>
                                                     <div class="row">
                                                        <div class="col-lg-12">
                                                           <?php //echo $joborder_list->description;?>
                                                        </div>
                                                     </div>
                                                     
                                               </fieldset> -->
                                       </fieldset>
                                       
                                    </div>
                                 </div>

                                 <fieldset>
                                    <legend class="text-info"><b>Upload JO Doucment</b></legend>
                                    <!--begin: Datatable -->
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                           <label>Loading Type<span class="text-danger">*</span></label>
                                           <select class="custom-select form-control" id="loading_type" name="loading_type">
                                              <option value="">Choose Loading Type</option>
                                              <?php foreach($loading_type as $ltype){?>
                                                <option value="<?php echo $ltype['loading_type'];?>"><?php echo $ltype['loading_type'];?></option>
                                              <?php }?>
                                           </select>
                                           <span id="loading_type_err" class="text-danger"></span>
                                        </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <!-- <input type="file" class="filepond" id="filepond" name="filepond[]" multiple data-max-file-size="3MB" data-max-files="3" /> -->
                                          <input type="file" class="filepond" id="filepond" name="filepond[]" multiple data-max-file-size="3MB" />
                                          <span id="filepond_err" class="form-control-feedback err_msg"></span>
                                          Note : Max Upload Size 3MB
                                       </div>
                                    </div>
                                 </fieldset>
                              </div>
                              <div class="m-portlet__foot">
                                 <div class="row align-items-center">
                                    <div class="col-lg-12 m--align-right">
                                       <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                 </div>
                              </div>
                              <input type="hidden" id="job_order_id" name="job_order_id" value="<?php echo $joborder_list->job_order_id;?>">
                           </form>
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
         <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-preview.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-exif-orientation.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-size.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-encode.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-type.min.js" type="text/javascript"></script>

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->


<script type="text/javascript">
   var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Job Order - Loading Document';
   $(document).attr("title", title);


   FilePond.registerPlugin(
         
         // encodes the file as base64 data
          FilePondPluginFileEncode,
   
            // validates files based on input type
           FilePondPluginFileValidateType,
         
         // validates the size of the file
         FilePondPluginFileValidateSize,
         
         // corrects mobile image orientation
         FilePondPluginImageExifOrientation,
         
         // previews dropped images
          FilePondPluginImagePreview
         );
         
         // Select the file input and use create() to turn it into a pond
         FilePond.create(
         document.querySelector('input[type="file"]'), {
    acceptedFileTypes: ['image/*']}
         );





function joborder_loading_validation()
{
   var err = 0;
   /*var fil = $('#filepond').val();

   if(fil==''){
      $('#filepond_err').html('Choose File!');
      err++;
   }
   else
   {
      $('#filepond_err').html('');
   }*/

   var ltype = $('#loading_type').val();
   //var fil = $('#filepond').val();

   if(ltype==''){
      $('#loading_type_err').html('Choose Loading Type!');
      err++;
   }
   else
   {
      $('#loading_type_err').html('');
   }

   if(err>0){ return false; }else{ return true; }
}

</script>


   </body>

   <!-- end::Body -->
</html>