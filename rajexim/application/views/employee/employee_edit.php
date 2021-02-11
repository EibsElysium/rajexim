<?php $this->load->view('common_header'); ?>

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
                                 <span class="m-nav__link-text">User Settings</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>employee" class="m-nav__link">
                                 <span class="m-nav__link-text">Employee</span>
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
                                      Edit Employee
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>employee" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>employee/update_employee" onsubmit="return employee_validation();">
                            <div class="m-portlet__body">
                              <div class="row">
                                <div class="col-lg-12">
                                <fieldset>
                                  <legend class="text-info"><b>Employee Info</b></legend>
                                  <input type="hidden" id='employeeId' name="employeeId" value="<?php echo $employee_details['employee_id']; ?>">
                                  <input type="hidden" name="old_image" id="old_image" value="<?php echo $employee_details['profile_image'];?>">
                                  <div class="col-lg-9">
                                    <div class="row">
                                      <div class="col-lg-12">
                                        <div class="form-group m-form__group">
                                          <label>Employee ID</label>
                                      <span class="m-form__help">&nbsp;&nbsp;&nbsp;&nbsp;(Employee ID is an auto-generated value)</span>
                                      <input type="text" class="form-control m-input" name="employee_no" id="employee_no" readonly value="<?php echo $employee_details['employee_no']; ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group m-form__group">
                                          <label>First Name<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter First Name" name="first_name" id="first_name" value="<?php echo $employee_details['first_name']; ?>">
                                          <span id="fname_err" class="text-danger"></span>
                                        </div>
                                      </div>
                                      <div class="col-lg-6">
                                        <div class="form-group m-form__group">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Last Name" name="last_name" id="last_name" value="<?php echo $employee_details['last_name']; ?>">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group m-form__group">
                                          <label>Contact No<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Contact No" name="contact_no" id="contact_no" onkeypress="return isNumber(event,'contact_no_err');" value="<?php echo $employee_details['contact_no']; ?>" onkeyup="cno_unique_edit(this.value);">
                                          <span id="contact_no_err" class="text-danger"></span>
                                        </div>
                                      </div>
                                      <div class="col-lg-6">
                                        <div class="form-group m-form__group">
                                          <label>Gender<span class="text-danger">*</span></label>
                                            <div class="m-radio-inline">
                                              <label class="m-radio m-radio--bold m-radio--success">
                                                <input type="radio" name="gender" <?php echo $employee_details['gender']==0?'checked':'';?> id="gender_0" value="0"> Male
                                                <span></span>
                                              </label>
                                              <label class="m-radio m-radio--bold m-radio--success">
                                                <input type="radio" name="gender" id="gender_1" <?php echo $employee_details['gender']==1?'checked':'';?> value="1"> Female
                                                <span></span>
                                              </label>
                                            </div>
                                        </div>
                                      </div>
                                    </div>  

                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group m-form__group">
                                          <label>Employee<span class="text-danger">*</span></label>
                                          <select class="custom-select form-control" name="designation_id" id="designation_id">
                                            <option value="">Select Designation</option>
                                            <?php foreach ($designation_list as $value) { ?>
                                              <option value="<?php echo $value['designation_id']; ?>" <?php echo $value['designation_id'] == $employee_details['designation_id']?'selected':'';?>><?php echo $value['designation'];?></option>
                                            <?php } ?>
                                          </select>
                                          <span id="designation_id_err" class="text-danger"></span>
                                        </div>
                                      </div>
                                      <div class="col-lg-6">
                                        <div class="form-group m-form__group">
                                          <label>Area<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control m-input m-input--square" placeholder="Enter Area" name="area" id="area" value="<?php echo $employee_details['area'];?>">
                                          <span id="area_err" class="text-danger"></span>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group m-form__group">
                                          <label>Address</label>
                                          <textarea class="form-control m-input" id="address" name="address" rows="3"><?php echo $employee_details['address']; ?></textarea>
                                        </div>
                                      </div>
                                    </div>

                                  </div>

                                  <div class="col-lg-3">
                                    <div class="row">
                                      <div class="col-lg-12">
                                        <div class="form-group m-form__group">
                                          <label></label>
                                          <div>
                                             <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-file">
                                                   <img src="<?php echo base_url(); ?>assets/images/employee_profile/<?php echo $employee_details['profile_image']; ?>" width="200" class="img-responsive" height="150" alt="logo">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-max" width="200" class="img-responsive" height="150">
                                                </div>
                                                <div class="text-center">
                                                   <span class="btn btn-primary btn-file ">
                                                   <span class="fileinput-new">Select image</span>
                                                   <span class="fileinput-exists">Change</span>
                                                   <input type="file" name="profile" id="profile" onchange="validate_profile()">
                                                   </span>
                                                   <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                                <span id="profile_err" class="text-danger"></span>
                                             </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </fieldset>
                                </div>
                              </div>
                            </div>
                          <div class="m-portlet__foot">
                            <div class="row align-items-center">
                              <div class="col-lg-12 m--align-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <!-- <button type="reset" class="btn btn-default">Cancel</button> -->
                              </div>
                            </div>
                          </div>
                            <input type="hidden" id='baseurl' name="baseurl" value="<?php echo base_url();?>">
                            <input type="hidden" id='error' name="error" value="0">
                            <input type="hidden" id='visible_type' name="visible_type" value="hide">
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
   
<script src="<?php echo base_url();?>assets/autocomplete-master/jquery.autocomplete.js"></script>
<script src="<?php echo base_url();?>assets/demo/demo12/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>

<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Employee Edit';
$(document).attr("title", title); 




function changePermission(id,val)
{
  if(val==1)
  {
    $('#'+id).val(0);
    document.getElementById(id+'hidden').disabled = false;
  }
  else
  {
    $('#'+id).val(1);
    document.getElementById(id+'hidden').disabled = true;
  }
}

function validate_profile() {
          var formData = new FormData();  
       
          var file = document.getElementById("profile").files[0];
       
         var l = 0;
           $('#profile_err').html('');
          formData.append("Filedata", file);
          var t = file.type.split('/').pop().toLowerCase();
          if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
              l++;
              $('#profile_err').html('Image file accepts JPEG, PNG, BMP, GIF');
                 //$('#edit_btn').attr("disabled", "disabled");
              document.getElementById("profile").value = '';
              return false;
          }
          if (file.size > 102400) {
              l++;
               $('#profile_err').html('Image size limit upto 100 KB');
                 //$('#edit_btn').attr("disabled", "disabled");
              document.getElementById("profile").value = '';
              return false;
          }
           /*if(l==0 && i==0) {
           $('#edit_btn').removeAttr("disabled");
       }*/
          return true;
      }

function employee_validation()
  {
    var err = 0;
    var first_name = $('#first_name').val();
    var contact_no = $('#contact_no').val();
    var designation = $('#designation_id').val();
    var area = $('#area').val();
    if(first_name==''){
      $('#fname_err').html('First name is required!');
      err++;
    }
    else
    {
      $('#fname_err').html('');
    }
    if(contact_no==''){
      $('#contact_no_err').html('Contact number is required!');
      err++;
    }
      else if(contact_no.length > 10 || contact_no.length < 10)
      {
        $('#contact_no_err').html('Invalid contact number');
        err++;
      }
    else
    {   
      if(er>0)
      {
        $('#contact_no_err').html('Contact No already exist!');
          err++;
      }
      else
      {
        $('#contact_no_err').html('');
      }
    }
    if(designation==''){
      $('#designation_id_err').html('Designation is required!');
      err++;
    }
    else
    {
      $('#designation_id_err').html('');
    }
    if(area==''){
      $('#area_err').html('Area is required!');
      err++;
    }
    else
    {
      $('#area_err').html('');
    }
    if(err>0){ return false; }else{ return true; }
  }   
  
  function isNumber(evt,id_val) {
    evt = (evt) ? evt : window.event;
    if (evt.which != 8 && evt.which != 0 && (evt.which < 48 || evt.which > 57)) {
      $("#"+id_val).html("Digits Only");
      return false;
    }
    else{
      $("#"+id_val).html("");
      return true;
    }
  }
  var er=0
  function cno_unique_edit(val)
  {
      var baseurl= $("#baseurl").val();
      var u_id = $("#employeeId").val();
      $.ajax({
      type:"POST",
      url:baseurl+'employee/unique_cno_edit',
      data:{'value':val,'id':u_id},
      cache: false,
      dataType: "html",
      success: function(result){
          if(result>0)
          {
              $('#contact_no_err').html('Contact No already exist!');
              //$("#error_email").val(2);
              er++;
          }
          else
          {
              $('#contact_no_err').html('');
              //$("#error_email").val(0);
              er=0;
          }
      }
    });
  } 



</script>
</body>
   <!-- end::Body -->
</html>