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
                              <a href="<?php echo base_url(); ?>proformainvoice" class="m-nav__link">
                                 <span class="m-nav__link-text">Proforma Invoice</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Upload Confirmed Proforma Invoice</span>
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
                                      Upload Confirmed Proforma Invoice
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                      <a href="<?php echo base_url();?>proformainvoice" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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
                                       <label class="col-lg-4">Invoice No</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php echo ($pi_details->proforma_invoice_no) ? $pi_details->proforma_invoice_no : '-';?></p>
                                    </div>
                                    <div class="col-lg-6">
                                       <label class="col-lg-4">Invoice Date</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php echo ($pi_details->proforma_invoice_date) ? date('d-m-Y', strtotime($pi_details->proforma_invoice_date)) : '-';?></p>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <label class="col-lg-4">Buyer Name</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php echo $pi_details->lead_name;?></p>
                                    </div>
                                    <div class="col-lg-6">
                                       <label class="col-lg-4">Destination</label>
                                       <label class="col-lg-1">:</label>
                                       <p class="col-lg-7"><?php echo $pi_details->fdname;?> - <?php echo $pi_details->fdcity;?> - <?php echo $pi_details->fdcountry;?></p>
                                    </div>
                                 </div>
                              </fieldset>

                              <fieldset>
                                 <legend class="text-info"><b>Buyer Order Details</b></legend>

                                 <form name="typeexcel" role="form"  method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>proformainvoice/proforma_invoice_confirm_save" onsubmit="return productupload_validation();">
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <div class="form-group m-form__group">
                                             <label>Order No</label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Order No" name="order_no" id="order_no">
                                             <span class="text-danger" id="order_no_err"></span>
                                          </div>
                                       </div>

                                       <div class="col-sm-6">
                                          <div class="form-group m-form__group">
                                             <label>Order Date</label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Buyer Order Date" name="order_date" id="order_date">
                                             <span class="text-danger" id="order_date_err"></span>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label>Order End Date<span class="text-danger">*</span></label>
                                             <input type="text" class="form-control m-input m-input--square" placeholder="Enter Order End Date" name="order_end_date" id="order_end_date">
                                             <span class="text-danger" id="order_end_date_err"></span>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group m-form__group">
                                             <label for="exampleInputEmail1">Proforma Invoice<span class="text-danger">*</span></label>
                                             <div></div>
                                             <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file" name="file">
                                                <label class="custom-file-label" for="file">Choose Proforma Invoice</label>
                                             </div>
                                             <i class="text-muted text-justify" style="color:#434A54;padding-top: 5px;">
                                             <i class="fa fa-star text-orange"></i> Please Note that the allowed file formats to upload  <strong class="text-danger">*.XLSX, .PDF, .PNG, .JPEG, .doc, .docx only.</strong></i>
                                             <br>
                                             <span id="product_upload_err" class="text-danger"></span>
                                          </div> 
                                       </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group m-form__group pull-right">
                                             <div class="">
                                                <input type="hidden" name="proforma_invoice_id" value="<?php echo $proforma_invoice_id; ?>">
                                                <input type="hidden" id="is_local" name="is_local" value="<?php echo $pi_details->is_local;?>">
                                                <button class="btn btn-primary" type="submit" name="import">Confirm</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
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
   var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Proforma Invoice List';
   $(document).attr("title", title);


var er=0;
            $("#file").change(function () {
        //var fileExtension = ['xls', 'xlsx', 'csv'];
        var fileExtension = ['xlsx', 'png', 'jpg', 'jpeg', 'doc', 'dox', 'pdf', 'docx'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#product_upload_err').html('Invalid File!');
            er++;
        }
        else
        {            
            $('#product_upload_err').html('');
            er--;
        }
    });

   $('#order_date').datepicker({ format : 'dd-mm-yyyy', todayHighlight:!0,orientation:"bottom left",templates:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'}});
   $('#order_end_date').datepicker({ format : 'dd-mm-yyyy', todayHighlight:!0,orientation:"bottom left",templates:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'}});

   function productupload_validation(){
    var err = 0;
      var ferror = $('#file').val();
      //var buyer_order_no = $('#buyer_order_no').val();
      //var buyer_order_date = $('#buyer_order_date').val();

      var order_end_date = $('#order_end_date').val();

      /*if(buyer_order_no == '')
      {
        $('#buyer_order_no_err').html('Buyer Order No is required!');
         err++;
      }else{
        $('#buyer_order_no_err').html('');
      }
       if(buyer_order_date == '')
      {
        $('#buyer_order_date_err').html('Buyer Order Date is required!');
         err++;
      }else{
        $('#buyer_order_date_err').html('');
      }*/

       if(order_end_date == '')
      {
        $('#order_end_date_err').html('Order End Date is required!');
         err++;
      }else{
        $('#order_end_date_err').html('');
      }


      if(ferror==''){
         $('#product_upload_err').html('Choose File!');
         err++;
      }else{
         //$('#ferror_err').html('');
         if(er>0)
         {
            $('#product_upload_err').html('Invalid File!');
         }
         else
         {
            $('#product_upload_err').html('');
         }
      }


  if(err>0||er>0){ return false; }else{ return true; }
} 


</script>


   </body>

   <!-- end::Body -->
</html>