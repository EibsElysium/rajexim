<?php $this->load->view('common_header'); ?>


		<div class="m-grid__item m-grid__item--fluid m-wrapper">

                  
			<!-- BEGIN: Subheader -->
			<div class="m-subheader ">
				
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<!-- <h3 class="m-subheader__title m-subheader__title--separator">General Settings</h3> -->
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
									<span class="m-nav__link-text">General Settings</span>
								</a>
							</li>
						</ul>

					</div>
				</div>
			</div>
			
			<!-- END: Subheader -->
			<div class="m-content">
				<?php if($this->session->flashdata('g_success')){?>
                    <div class="alert alert-success" id="alertaddmessage">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                <?php echo $this->session->flashdata('g_success'); ?>
	                </div>
                <?php } ?>

                <?php if($this->session->flashdata('g_err')){?>
                    <div class="alert alert-success" id="alertaddmessage">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                <?php echo $this->session->flashdata('g_err'); ?>
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
											General Settings
										</h3>
									</div>
								</div>
							</div>
							<form  name="generalsetting_form" id="generalsetting_form" method="POST" action="<?php echo base_url(); ?>Settings/general_settings_update" enctype="multipart/form-data" onsubmit="return gvalidation();" >

								<input type="hidden" name="oldlogo" value="<?php echo $g_settings->product_logo;?>">
                               	<input type="hidden" name="oldfav" value="<?php echo $g_settings->favicon;?>">	

							<div class="m-portlet__body">
								<div class="row">
									<div class="col-lg-6">
										<div class="text-center">
											<div class="form-group m-form__group">
												<label>Product Logo<span class="text-danger">*</span></label>
												<div>
			                                       <div class="fileinput fileinput-new" data-provides="fileinput">
			                                          <div class="fileinput-new thumbnail img-file">
			                                             <img src="<?php echo base_url();?>assets/common_images/<?php echo $g_settings->product_logo; ?>" width="200" class="img-responsive" height="150" alt="logo">
			                                          </div>
			                                          <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" class="img-responsive" height="150">
			                                          </div>
			                                          <div class="text-center">
			                                             <span class="btn btn-primary btn-file ">
			                                             <span class="fileinput-new">Select image</span>
			                                             <span class="fileinput-exists">Change</span>
			                                             <input type="file" id="product_logo" name="product_logo">
			                                             </span>
			                                             <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			                                          </div>
			                                       </div>
			                                    </div>
			                                    <span class="m-form__help text-danger" id="product_logo_err"></span>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="text-center">
											<div class="form-group m-form__group">
												<label>Favicon<span class="text-danger">*</span></label>
												<div>
			                                       <div class="fileinput fileinput-new" data-provides="fileinput">
			                                          <div class="fileinput-new thumbnail img-file">
			                                             <img src="<?php echo base_url();?>assets/common_images/<?php echo $g_settings->favicon; ?>" width="200" class="img-responsive" height="150" alt="logo">
			                                          </div>
			                                          <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" class="img-responsive" height="150">
			                                          </div>
			                                          <div class="text-center">
			                                             <span class="btn btn-primary btn-file ">
			                                             <span class="fileinput-new">Select image</span>
			                                             <span class="fileinput-exists">Change</span>
			                                             <input type="file" name="favicon" id="favicon">
			                                             </span>
			                                             <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			                                          </div>
			                                       </div>
			                                    </div>
											</div>
											<span class="m-form__help text-danger" id="favicon_err"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>Title<span class="text-danger">*</span></label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter Title" id="title" name="title" maxlength="100" value="<?php echo $g_settings->product_title; ?>">
											<span class="m-form__help text-danger" id="title_err"></span>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>Website</label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter Website" name="website" maxlength="100" id="website" value="<?php echo $g_settings->website; ?>">
											<span class="m-form__help text-danger" id="website_err"></span>
											
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>Contact Person Name<span class="text-danger">*</span></label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Name" 
                               id="contact_person_name" name="contact_person_name" maxlength="100" value="<?php echo $g_settings->contact_person_name; ?>">
                               <span class="m-form__help text-danger" id="contact_person_name_err"></span>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>Contact Person Email ID</label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact Person Email ID" id="contact_person_emailId" name="contact_person_emailId" maxlength="100" value="<?php echo $g_settings->contact_person_email_id; ?>">
											<span class="m-form__help text-danger" id="contact_person_emailId_err"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>Date Format<span class="text-danger">*</span></label>
												<select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="date_format" id="date_format">
												<option value="">Select Date Format</option>
													<?php
														if(!empty($date_formats)){ 
															foreach ($date_formats as $key => $dformat) { ?>
																<option value="<?php echo $dformat->date_format; ?>" <?php if($dformat->date_format == $g_settings->date_format) { echo 'selected'; }else{ echo ''; } ?>><?php echo $dformat->date_format; ?></option> 
															<?php }
														}
													?>
												</select>

												<span class="text-danger" id="date_format_err"></span>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>Address</label>
                               <textarea class="form-control m-input m-input--square" placeholder="Enter Address" id="address" name="address"><?php echo $g_settings->address; ?></textarea>
											
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group m-form__group">
											<label>Country</label>
											<select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="country" id="country" onchange="state_list()">
											<option value="">Select Country</option>
												<?php
													if(!empty($country_lists)){ 
														foreach ($country_lists as $key => $country_list) { ?>
															<option value="<?php echo $country_list->id; ?>" <?php 
															if($country_list->id == $g_settings->country){ echo 'selected'; }else{ echo ''; } ?>><?php echo $country_list->name; ?></option>
														<?php }
													}
													?>
											</select>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group m-form__group">
											<label>State</label>
											<select class="form-control m-bootstrap-select m_selectpicker" name="state" id="state" onchange="city_list()">
												<?php
													if(!empty($state_lists)){ 
														foreach ($state_lists as $key => $state_list) { ?>
															<option value="<?php echo $state_list->id; ?>" <?php if($state_list->id == $g_settings->state){ echo 'selected'; }else{ echo ''; } ?>><?php echo $state_list->name; ?></option>
														<?php }
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group m-form__group">
											<label>City</label>
											<select class="form-control m-bootstrap-select m_selectpicker" name="city" id="city">
												<?php
													if(!empty($city_lists)){ 
														foreach ($city_lists as $key => $city_list) { ?>
															<option value="<?php echo $city_list->sid; ?>" <?php if($city_list->sid == $g_settings->city){ echo 'selected'; }else{ echo ''; } ?>><?php echo $city_list->name; ?></option>
														<?php }
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group m-form__group">
											<label>Pincode<span class="text-danger">*</span></label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter Pincode" id="pincode" name="pincode" maxlength="6" value="<?php echo $g_settings->pincode; ?>" onkeypress="isNumber(event, 'pincode_err');" maxlength="6">
											<span class="m-form__help text-danger" id="pincode_err"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>CGST (%)</label>
											<input type="text" class="form-control m-input m-input--square"  placeholder="Enter CGST" id="cgst" name="cgst"   value="<?php echo $g_settings->cgst; ?>" onkeypress="isNumber(event, 'cgst_err');" >
											<span class="m-form__help text-danger" id="cgst_err"></span>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>SGST (%)</label>
											<input type="text" class="form-control m-input m-input--square"  placeholder="Enter SGST" id="sgst" name="sgst"   value="<?php echo $g_settings->sgst; ?>" onkeypress="isNumber(event, 'sgst_err');">
											<span class="m-form__help text-danger" id="sgst_err"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>GST</label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter GST" id="gst_no" name="gst_no" maxlength="15" value="<?php echo $g_settings->gst_no; ?>">
											<span class="m-form__help text-danger" id="gst_no_err"></span>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>CIN</label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter CIN" id="cin_no" name="cin_no" maxlength="17" value="<?php echo $g_settings->cin_no; ?>">
											<span class="m-form__help text-danger" id="cin_no_err"></span>
										</div>
									</div>
								</div>
								<div class="row" style="display: none;">
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>SMTP Host Name</label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter SMTP Host Name" id="smtp_host_name" name="smtp_host_name" maxlength="100" value="<?php echo $g_settings->smtp_host_name; ?>">
											<span class="m-form__help text-danger" id="smtp_host_name_err"></span>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>SMTP Username</label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter SMTP Username" id="smtp_user_name" name="smtp_user_name" maxlength="100" value="<?php echo $g_settings->smtp_user_name; ?>">
											<span class="m-form__help text-danger" id="smtp_user_name_err"></span>
										</div>
									</div>
								</div>
								<div class="row" style="display: none;">
									<div class="col-lg-6">
										<div class="form-group m-form__group">
											<label>SMTP Password</label>
											<input type="text" class="form-control m-input m-input--square" placeholder="Enter SMTP Password" id="smtp_password" name="smtp_password" maxlength="100" value="<?php echo  decryptthis($g_settings->smtp_password, 'Rajexim2020'); ?>">
											<span class="m-form__help text-danger" id="smtp_password_err"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="m-portlet__foot">
								<div class="row align-items-center">
									<div class="col-lg-12 m--align-right">
										<input type="submit"  class="btn btn-primary" name="submit" id="btnsubmit" value="Save Changes">
									</div>
								</div>
							</div>
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
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->

<script type="text/javascript">
var title = $('title').text() + ' | ' + 'General Settings';
$(document).attr("title", title);	
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#logo-id").change(function() {
        readURL(this);
    });



// To validate general setting form
function gvalidation()
{
	var err = 0;
	var title = check_input_empty_values($('#title').val(), 'title_err', 'Title');
	var website = $('#website').val();  
	var contact_person_name = check_input_empty_values($('#contact_person_name').val(), 'contact_person_name_err', 'Contact Person Name'); 
	var contact_person_emailId = $('#contact_person_emailId').val();
	var pincode = check_input_empty_values($('#pincode').val(), 'pincode_err', 'Pincode');
	var date_format = check_input_empty_values($('#date_format').val(), 'date_format_err', 'Date Format');
	var gst_no = $('#gst_no').val();
	var cin_no = $('#cin_no').val();

   if(title)
   {
        err++;
   }
  
   if(website != '' && !isUrlValid(website))
   {
           $('#website_err').html('Valid Website is required!');
           err++;
    }else{
         $('#website_err').html('');
    }

   if(contact_person_name)
   {
        err++;
   }


   if(contact_person_emailId.trim() !='' && !ValidateEmail(contact_person_emailId)){ 

        $('#contact_person_emailId_err').html('Invalid Email ID!');
        err++;
    }else{
        $('#contact_person_emailId_err_err').html('');
    }
    

    if(date_format)
    {
        err++;
    }
     
    if(pincode)
    {
        err++;
     } 
      
    
    if(gst_no.trim() !='' && gst_no.length < 15){

        $('#gst_no_err').html('GST Should be 15 digits!');
        err++;
    }else{
        $('#gst_no_err').html('');
    }

    if(cin_no.trim() !='' && gst_no.length < 17){
        $('#cin_no_err').html('CIN is required!');
        err++;
    }else{
        $('#cin_no_err').html('');
    }
    if(err>0){ return false; }else{ return true; }
}

// To validate product logo
$("#product_logo").change(function() {

  var ext = document.getElementById('product_logo').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#btnsubmit').prop('disabled', true);
            $('#product_logo_err').html('Upload file allows only file types of GIF, PNG, JPG and JPEG');
            error++;
        }else{
            $('#btnsubmit').prop('disabled', false);
            $('#product_logo_err').html('');
            error=0;
        }
    }else{  $('#btnsubmit').prop('disabled', false);
            $('#product_logo_err').html(''); error=0; }
});

// To validate favicon
$("#favicon").change(function() {

  var ext = document.getElementById('favicon').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['gif','png','jpg','jpeg','ico']) == -1) {
            $(this).val('');
            $('#btnsubmit').prop('disabled', true);
            $('#favicon_err').html('Upload file allows only file types of GIF, PNG, JPG, ICO and JPEG');
            error++;
        }else{
            $('#btnsubmit').prop('disabled', false);
            $('#favicon_err').html('');
            error=0;
        }
    }else{  $('#btnsubmit').prop('disabled', false);
            $('#favicon_err').html(''); error=0; }
});

// To get state base on country
function state_list()
{
    var country = $('#country').val();
    var base = '<?php echo base_url(); ?>';
    $.ajax({
    type: "POST",
    url: base+'settings/state_list',
    data: "country="+country,
    success: function(response) {   
       $('#state').val('');
       $('#state').empty().append(response);
    }
    });
}

function city_list()
{
    var state = $('#state').val();
    var base  = '<?php echo base_url(); ?>';
    $.ajax({
    type: "POST",
    url: base+'settings/city_list',
    data: "state="+state,
    success: function(response) {  
       $('#city').val(''); 
       $('#city').empty().append(response);
    }
    });
}   
</script>

	</body>
	<!-- end::Body -->
</html>