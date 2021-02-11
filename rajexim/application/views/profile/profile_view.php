<?php $this->load->view('common_header'); ?>
<style>
    
       .fileinput-new.thumbnail.img-file
         {
         width:150px!important;
         height:150px!important;/*object-fit: cover;*/
         }
                  .fileinput-new.thumbnail.img-file img
         {
         width:100%;
         height:100%;/*object-fit: cover;*/
         }
         .fileinput-preview.fileinput-exists.thumbnail.img-max
         {
         width:150px!important;
         height:150px!important;/*object-fit: cover;*/
         }
         .fileinput-preview.fileinput-exists.thumbnail.img-max img
         {
         width:100%;
         height:100%;/*object-fit: cover;*/
         }
</style>
				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title ">My Profile</h3>
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">
						<?php if($this->session->flashdata('update_success')){?>
                        <div class="alert alert-success alert-dismissible response" role="alert" id="alertaddmessage">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            <?php echo $this->session->flashdata('update_success'); ?>                      
                        </div>
                    <?php } if($this->session->flashdata('update_error')){?>
                        <div class="alert alert-danger alert-dismissible response" role="alert" id="alertaddmessage">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            <?php echo $this->session->flashdata('update_error'); ?>                        
                        </div>
                    <?php } ?>
                    
						<div class="row">
							<div class="col-xl-8 col-lg-8">
								<div class="m-portlet m-portlet--mobile">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Update Profile
												</h3>
											</div>
										</div>
									</div>
									<form class="m-form m-form--fit m-form--label-align-right" name="profile_change" method="POST" 
									action="<?php echo base_url(); ?>Profiles/profile_update" enctype="multipart/form-data" onsubmit="return profile_validation();">
									<div class="m-portlet__body">
										
											<div class="row">
												<div class="col-lg-3">	
													<div class="row">
														<div class="form-group m-form__group row">
														<div class="col-lg-12">
					                                       <div class="fileinput fileinput-new" data-provides="fileinput">
					                                          <div class="fileinput-new thumbnail img-file">
					                                              <?php $profile_image = ($profile->profile_image) ? 'assets/user_profile/'.$profile->profile_image : 'assets/images/default_image.jpg'; ?>
					                                             <img src="<?php echo base_url().$profile_image; ?>" width="100" height="100" class="img-responsive"  alt="logo">
					                                          </div>
					                                          <input type="hidden" name="oimage" value="<?php echo $profile->profile_image; ?>">
					                                          <div class="fileinput-preview fileinput-exists thumbnail img-max" width="100" class="img-responsive" height="100">
					                                          </div>
					                                          <div class="text-center">
					                                             <span class="btn btn-primary btn-file ">
					                                             <span class="fileinput-new">Select Image</span>
					                                             <span class="fileinput-exists">Change</span>
					                                             <input type="file" class="form-control m-input" name="image" id="image" aria-describedby="emailHelp">
					                                             </span>
					                                             <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
					                                          </div>
					                                          <span class="m-form__help text-danger" id="image_err"></span>
					                                       </div>
					                                   </div>
					                                </div>
					                            </div>
												</div>
												<div class="col-lg-9">
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group m-form__group row">
																<label for="example-text-input" class="col-form-label">Name<span class="text-danger">*</span></label>
																<input class="form-control m-input" type="text" name="fname" id="fname" value="<?php echo $profile->name; ?>" autocomplete="off" Placeholder="Name">
																<input type="hidden" name="eid" id="eid" value="<?php echo $profile->user_id; ?>">
																<span id="fname_err" style="color:red"></span>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group m-form__group row">
																<label for="example-text-input" class="col-form-label">Date of Birth</label>
																<input type="text" class="form-control m-input m-input--square datepicker" placeholder="Enter Date of Birth"  name="dob" id="dob" value="<?php echo date('d-m-Y',strtotime($profile->dob))
																; ?>" readonly onclick="dob_validation(this.value); "><span id="dob_err" style="color:red"></span>
															</div>
														</div>
													</div>
													<div class="row">
														
														<!-- <div class="col-lg-6">
															<div class="form-group m-form__group row">
																<label for="example-text-input" class="col-form-label">Email ID<span class="text-danger">*</span></label>
																<input type="text" class="form-control m-input" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email ID" value="<?php echo $profile->email_id; ?>" >
                                                				
                                                				<span id="email_err" style="color:red"></span>
															</div>
														</div> -->
														<div class="col-lg-6">
															<div class="form-group m-form__group row">
																<label for="example-text-input" class="col-form-label">Contact No<span class="text-danger">*</span></label>
																<input type="text" class="form-control m-input" name="cno" id="cno" aria-describedby="emailHelp" value="<?php echo $profile->contact_no; ?>" placeholder="Enter contact No" onkeypress="return isNumber(event,'cno_err');" maxlength="12"> 
                                                				
                                                				<span id="cno_err" style="color:red"></span>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group m-form__group row">
																<label for="example-text-input" class="col-form-label">Pincode</label>
																<input class="form-control m-input" type="text" name="pincode" id="pincode" value="<?php echo $profile->pincode; ?>" maxlength="6" onkeypress="isNumber(event, 'pincode_err');" placeholder="Pincode">
																<span id="pincode_err" style="color:red"></span>
															</div>
														</div>
													</div>
													
													<div class="row">
														<div class="col-lg-12">
															<div class="form-group m-form__group row">
																<label for="example-text-input" class="col-form-label">Address</label>
																 <textarea name="address" id="address" class="form-control m-input" Placeholder="Address"><?php echo $profile->address; ?></textarea>
                                                				<span id="address_err" style="color:red"></span>
															</div>
														</div>
														
													</div>
												</div>
											</div>
										</div>
									<div class="m-portlet__foot">
										<div class="row align-items-center">
											<div class="col-lg-12 m--align-right">
												<div class="col-lg-12">
													<button type="submit" class="btn btn-primary">Save Changes</button>
													
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" id='baseurl' name="baseurl" value="<?php echo base_url();?>">
                                        
								</form>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4">
								<div class="m-portlet m-portlet--mobile">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Change password
												</h3>
											</div>
										</div>
									</div>
									<form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="<?php echo base_url(); ?>/profiles/password_update" onsubmit="return pass_validation();">
									<div class="m-portlet__body" style="min-height: 352px;">
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-form-label">Old Password<span class="text-danger">*</span></label>
														<input type="password" class="form-control m-input" name="opass" id="opass" aria-describedby="emailHelp" placeholder="Enter Old Password" value="" onblur="pass_check(this.value);" autocomplete="off" ><input type="hidden" id="eid" name="eid" value="<?php echo $profile->user_id; ?>">
                                                		<span id="opass_err" style="color:red"></span>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-form-label">New Password<span class="text-danger">*</span></label>
														<input type="password" class="form-control m-input" name="npass" id="npass" aria-describedby="emailHelp" placeholder="Enter New Password" autocomplete="off">
                                                		<span id="npass_err" style="color:red"></span>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
															<input type="password" class="form-control m-input" name="cpass" id="cpass" aria-describedby="emailHelp" placeholder="Enter Confirm Password" autocomplete="off">
                                                			<span id="cpass_err" style="color:red"></span>
													</div>
												</div>
											</div>
									</div>
									<div class="m-portlet__foot">
										<div class="row align-items-center">
											<div class="col-lg-12 m--align-right">
												<div class="col-lg-12">
													
													<input type="submit"  class="btn btn-primary" name="submit" id="btnsubmit" value="Save Changes">
												</div>
											</div>
										</div>
									</div>
								</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

			<!-- end:: Body -->

			<!-- begin::Footer -->
			<?php $this->load->view('common_footer'); ?>

			<!-- end::Footer -->
		</div>

		<!-- end:: Page -->

	
<script>
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'My Profile';
$(document).attr("title", title);	

$('#dob').datepicker({

	format : 'dd-mm-yyyy'
});

var error = 0;
// To validate product logo
$("#image").change(function() {

  var ext = document.getElementById('image').value.split('.').pop().toLowerCase();
  if(ext){
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $(this).val('');
            $('#btnsubmit').prop('disabled', true);
            $('#image_err').html('Upload file allows only file types of GIF, PNG, JPG and JPEG');
            error++;
        }else{
            $('#btnsubmit').prop('disabled', false);
            $('#image_err').html('');
            error=0;
        }
    }else{  $('#btnsubmit').prop('disabled', false);
            $('#image_err').html(''); error=0; }
});

// To validate dob
var dob_err = 0;
function dob_validation(val)
{
	$.ajax({
	    type: "POST",
	    url: baseurl+'Profiles/dob_validation',
	    data: "dob="+val,
	    success: function(response) {   

	    	if(response > 0) 
	    	{
	    		$('#dob_err').html('Date of Birth should be above +18 years!');
	  		 	dob_err = 1;
	    	}
	    	else{
	    		$('#dob_err').html('');
	  		 	
	    	}
	    }
    });

}
function profile_validation()
{
    var err = 0;
    var fname = check_input_empty_values($('#fname').val(), 'fname_err', 'Name');
    //var dob = check_input_empty_values($('#dob').val(), 'dob_err', 'Date of Birth');
    //var email = $('#email').val();
    var contact_no = check_input_empty_values($('#cno').val(), 'cno_err', 'Contact No');
    //var address = check_input_empty_values($('#address').val(), 'address_err', 'Address');
    var cno = $("#cno").val();
    //var pincode = check_input_empty_values($('#pincode').val(), 'pincode_err', 'Pincode');

    if(fname)
    {
        err++;
    }
    if(dob_err > 0)
    {
    	$('#dob_err').html('Date of Birth should be above +18 years!');
    	err++;
    }else{
    	$('#dob_err').html('');
    }

    // if(email.trim() =='')
    // {
    // 	$('#email_err').html('Email ID is required!');
    // 	err++;
    // }
    // else if(email.trim() !='' && !ValidateEmail(email)){ 

    //     $('#email_err').html('Invalid Email ID!');
    //     err++;
    // }else{
    //     $('#email_err').html('');
    // }
    
    if(contact_no)
    {
        err++;
    }
    else if(cno.length > 10 || cno.length < 10)
    {
        $('#cno_err').html('Contact No should be 10 digits only!');
        err++;
    }
    else
    {
        $('#cno_err').html('');
    }
    if(err>0 || error > 0){ return false; }else{ return true; }
}


function pass_check(val)
{
    var u_id = $("#eid").val();
    $.ajax({
        type:"POST",
        url:baseurl+'Profiles/profile_password_check',
        data:{'value':val,'id':u_id},
        cache: false,
        dataType: "html",
        success: function(result){
            if(result==0)
            {
                $('#opass_err').html('Old Password is incorrect!');
                $("#error_opass").val(2);
            }
            else
            {
                $('#opass_err').html('');
                $("#error_opass").val(0);
            }
        }
    });
}

function pass_validation()
    {
        var cerr = 0;
        var opass = check_input_empty_values($('#opass').val(), 'opass_err', 'Old Password');
        var npass = check_input_empty_values($('#npass').val(), 'npass_err', 'New Password');
        var cpass = check_input_empty_values($('#cpass').val(), 'cpass_err', 'Confirm Password');
        var er_opass = $("#error_opass").val();
        if(opass)
        {
            cerr++;
        }
        
        if(npass)
        {
            cerr++;
        }
        
        if(cpass)
        {
            cerr++;
        }
        else if($('#npass').val()!=$('#cpass').val())
        {
            $('#cpass_err').html('Password Mismatch');
            cerr++;
        }
        else
        {
            $('#cpass_err').html('');
        }

        if(cerr>0||er_opass>0){ return false; }else{ return true; }
    }
    
</script>
	</body>

	<!-- end::Body -->
</html>