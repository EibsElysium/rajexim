<div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Exporter</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form name="edit_exporter" id="edit_exporter" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>exporter/update_exporter" onsubmit="return exporter_edit_validation()">
               <input type="hidden" name="oldlogo" value="<?php echo $exporter_list->exporter_logo;?>">
               <input type="hidden" name="oldsign" value="<?php echo $exporter_list->exporter_sign_file;?>">
               <input type="hidden" name="exporter_id" id="exporter_id" value="<?php echo $exporter_list->exporter_id;?>">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">                        
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>Exporter Name<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Exporter Name" name="exporter_name" id="exporter_name_edit" value="<?php echo $exporter_list->exporter_name;?>" onkeyup="checkUniqueExporterEdit();">
                                 <span id="exporter_name_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>Address</label>
                                 <textarea class="form-control m-input" id="exporter_address_edit" name="exporter_address" rows="3"><?php echo $exporter_list->exporter_address;?></textarea>
                                 <span id="exporter_address_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>Country</label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Country" name="exporter_country" id="exporter_country_edit" value="<?php echo $exporter_list->exporter_country;?>">
                                 <span id="exporter_country_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>Contact Name<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Name" name="contact_name" id="contact_name_edit" value="<?php echo $exporter_list->contact_name;?>">
                                 <span id="contact_name_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>Contact No<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact No" name="phone_no" id="phone_no_edit" value="<?php echo $exporter_list->phone_no;?>">
                                 <span id="phone_no_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>State Name</label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter State Name" name="state_name" id="state_name_edit" value="<?php echo $exporter_list->state_name;?>">
                                 <span id="state_name_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>State Code</label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter State Code" name="state_code" id="state_code_edit" value="<?php echo $exporter_list->state_code;?>">
                                 <span id="state_code_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>GST No</label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter GST No" name="gst_no" id="gst_no_edit" value="<?php echo $exporter_list->gst_no;?>">
                                 <span id="gst_no_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>IEC No</label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter IEC No" name="iec_no" id="iec_no_edit" value="<?php echo $exporter_list->iec_no;?>">
                                 <span id="iec_no_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>VAT TIN No</label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter VAT TIN No" name="vat_tin_no" id="vat_tin_no_edit" value="<?php echo $exporter_list->vat_tin_no;?>">
                                 <span id="vat_tin_no_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>CST No</label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter CST No" name="cst_no" id="cst_no_edit" value="<?php echo $exporter_list->cst_no;?>">
                                 <span id="cst_no_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group m-form__group">
                                 <label>PAN No</label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter PAN No" name="pan_no" id="pan_no_edit" value="<?php echo $exporter_list->pan_no;?>">
                                 <span id="pan_no_edit_err" class="text-danger"></span>
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
                                             <img src="<?php echo base_url();?>exporterlogo/<?php echo str_replace(' ', '_', $exporter_list->exporter_logo); ?>" width="200" class="img-responsive" height="150" alt="logo">
                                          </div>
                                          <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" class="img-responsive" height="150">
                                          </div>
                                          <div class="text-center">
                                             <span class="btn btn-primary btn-file ">
                                             <span class="fileinput-new">Select image</span>
                                             <span class="fileinput-exists">Change</span>
                                             <input type="file" class="custom-file-input" id="exporter_logo_edit" name="exporter_logo">
                                             </span>
                                             <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>
                                          <span class="m-form__help text-danger" id="exporter_logo_edit_err"></span>
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
                                             <img src="<?php echo base_url();?>exportersign/<?php echo str_replace(' ', '_', $exporter_list->exporter_sign_file); ?>" width="200" class="img-responsive" height="150" alt="logo">
                                          </div>
                                          <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" class="img-responsive" height="150">
                                          </div>
                                          <div class="text-center">
                                             <span class="btn btn-primary btn-file ">
                                             <span class="fileinput-new">Select image</span>
                                             <span class="fileinput-exists">Change</span>
                                             <input type="file" class="custom-file-input" id="exporter_sign_file_edit" name="exporter_sign_file">
                                             </span>
                                             <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>
                                          <span class="m-form__help text-danger" id="exporter_sign_file_edit_err"></span>
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
                  <button type="submit" id="btnSubmit" class="btn btn-primary">Save Changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>

         </form>
      </div>
</div>

<script>
var eelogo=0;
var eesign=0;
$("#exporter_logo_edit").change(function() {

  var ext = document.getElementById('exporter_logo_edit').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#btnsubmit').prop('disabled', true);
            $('#exporter_logo_edit_err').html('Allow Image files only!');
            eelogo=1;
        }else{
            $('#btnsubmit').prop('disabled', false);
            $('#exporter_logo_edit_err').html('');
            eelogo=0;
        }
    }else{  $('#btnsubmit').prop('disabled', false);
            $('#exporter_logo_edit_err').html(''); eelogo=0; }
});

$("#exporter_sign_file_edit").change(function() {

  var ext = document.getElementById('exporter_sign_file_edit').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#btnsubmit').prop('disabled', true);
            $('#exporter_sign_file_edit_err').html('Allow Image files only!');
            eesign=1;
        }else{
            $('#btnsubmit').prop('disabled', false);
            $('#exporter_sign_file_edit_err').html('');
            eesign=0;
        }
    }else{  $('#btnsubmit').prop('disabled', false);
            $('#exporter_sign_file_edit_err').html(''); eesign=0; }
});

// To check exporter name is unique
var eexpo = 0;
function checkUniqueExporterEdit()
{
   var val = $('#exporter_name_edit').val();
   var eid = $('#exporter_id').val();
   $.ajax({
      type:"POST",
      url:baseurl+'exporter/checkUniqueExporterEdit',
      data:{'value':val,'eid':eid},
      cache: false,
      dataStatus: "html",
      success: function(result){
         if(result>0)
         {
            $('#exporter_name_edit_err').html('Exporter already exists!');
            $('#btnSubmit').prop('disabled', true);
            eexpo = 1;
         }
         else
         {
            $('#exporter_name_edit_err').html('');
            $('#btnSubmit').prop('disabled', false);
            eexpo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function exporter_edit_validation()
{
   var err = 0;
   var name = $('#exporter_name_edit').val();
   var address = $('#exporter_address_edit').val();
   var country = $('#exporter_country_edit').val();
   var cname = $('#contact_name_edit').val();
   var pno = $('#phone_no_edit').val();
   var gstno = $('#gst_no_edit').val();
   var iecno = $('#iec_no_edit').val();
   var sname = $('#state_name_edit').val();
   var scode = $('#state_code_edit').val();
   var vtno = $('#vat_tin_no_edit').val();
   var cstno = $('#cst_no_edit').val();
   var panno = $('#pan_no_edit').val();
   /*var logo = $('#exporter_logo').val();
   var sign = $('#exporter_sign_file').val();*/
   if(name == '')
   {
      $('#exporter_name_edit_err').html('Exporter Name is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#exporter_name_edit_err').html('Exporter already exists!');
         err++;
      }
      else
      {
         $('#exporter_name_edit_err').html('');
      }
   }
   // if(address == '')
   // {
   //    $('#exporter_address_edit_err').html('Exporter Address is required!');
   //    err++;
   // }else{
   //    $('#exporter_address_edit_err').html('');
   // }
   // if(country == '')
   // {
   //    $('#exporter_country_edit_err').html('Exporter Country is required!');
   //    err++;
   // }else{
   //    $('#exporter_country_edit_err').html('');
   // }
   if(cname == '')
   {
      $('#contact_name_edit_err').html('Contact Name is required!');
      err++;
   }else{
      $('#contact_name_edit_err').html('');
   }
   if(pno == '')
   {
      $('#phone_no_edit_err').html('Contact No is required!');
      err++;
   }else{
      $('#phone_no_edit_err').html('');
   }
   // if(gstno == '')
   // {
   //    $('#gst_no_edit_err').html('GST No is required!');
   //    err++;
   // }else{
   //    $('#gst_no_edit_err').html('');
   // }
   // if(iecno == '')
   // {
   //    $('#iec_no_edit_err').html('IEC No is required!');
   //    err++;
   // }else{
   //    $('#iec_no_edit_err').html('');
   // }
   // if(sname == '')
   // {
   //    $('#state_name_edit_err').html('State Name is required!');
   //    err++;
   // }else{
   //    $('#state_name_edit_err').html('');
   // }
   // if(scode == '')
   // {
   //    $('#state_code_edit_err').html('State Code is required!');
   //    err++;
   // }else{
   //    $('#state_code_edit_err').html('');
   // }
   // if(vtno == '')
   // {
   //    $('#vat_tin_no_edit_err').html('VAT TIN No is required!');
   //    err++;
   // }else{
   //    $('#vat_tin_no_edit_err').html('');
   // }
   // if(cstno == '')
   // {
   //    $('#cst_no_edit_err').html('CST No is required!');
   //    err++;
   // }else{
   //    $('#cst_no_edit_err').html('');
   // }
   // if(panno == '')
   // {
   //    $('#pan_no_edit_err').html('PAN No is required!');
   //    err++;
   // }else{
   //    $('#pan_no_edit_err').html('');
   // }

   // if(eelogo==1)
   // {
   //    $('#exporter_logo_edit_err').html('Allow Image files only!');
   //    err++;
   // }
   // else
   // {
   //    $('#exporter_logo_edit_err').html('');
   // }

   // if(eesign==1)
   // {
   //    $('#exporter_sign_file_edit_err').html('Allow Image files only!');
   //    err++;
   // }
   // else
   // {
   //    $('#exporter_sign_file_edit_err').html('');
   // }
   
   if(err> 0){ return false;}else{ return true; }   
}

</script>