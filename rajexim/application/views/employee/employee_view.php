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
                                      View Employee
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
                            <div class="m-portlet__body">
                              <div class="row">
                      <div class="col-lg-12">
                        <fieldset>
                          <legend class="text-info"><b>Employee Info</b></legend>
                          <div class="col-lg-9">
                            <div class="row">
                                <label class="col-lg-4">Employee ID</label>
                                <label class="col-lg-1">:</label>
                                <p class="col-lg-7"><?php echo $employee_details['employee_no'];?></p>
                            </div>
                            <div class="row">
                                <label class="col-lg-4">Name</label>
                                <label class="col-lg-1">:</label>
                                <p class="col-lg-7"><?php echo $employee_details['display_name'];?></p>
                            </div>
                            <div class="row">
                                <label class="col-lg-4">Contact No</label>
                                <label class="col-lg-1">:</label>
                                <p class="col-lg-7"><?php echo $employee_details['contact_no'];?></p>
                            </div>
                            <div class="row">
                                <label class="col-lg-4">Gender</label>
                                <label class="col-lg-1">:</label>
                                <p class="col-lg-7"><?php echo $employee_details['gender']==0?'Male':'Female';?></p>
                            </div>
                            <div class="row">
                                <label class="col-lg-4">Designation</label>
                                <label class="col-lg-1">:</label>
                                <p class="col-lg-7"><?php echo $employee_details['designation'];?></p>
                            </div>
                            <div class="row">
                                <label class="col-lg-4">Area</label>
                                <label class="col-lg-1">:</label>
                                <p class="col-lg-7"><?php echo $employee_details['area'];?></p>
                            </div>
                            <div class="row">
                                <label class="col-lg-4">Address</label>
                                <label class="col-lg-1">:</label>
                                <p class="col-lg-7"><?php echo $employee_details['address'];?></p>
                            </div>

                          </div>
                          <div class="col-lg-3">
                            <div class="row">
                              <div class="col-lg-12">

                                <div style="margin: 0 auto;text-align: center;"> 
                                  <img src="<?php echo base_url();?>assets/images/employee_profile/<?php echo $employee_details['profile_image']; ?>"  class="img-responsive"  alt="User Image" height="100" width="100" style="border-radius:50%;border:2px solid #04488b;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                      </div>
                    </div>
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
   
<script src="<?php echo base_url();?>assets/autocomplete-master/jquery.autocomplete.js"></script>
<script src="<?php echo base_url();?>assets/demo/demo12/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>

<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Employee View';
$(document).attr("title", title); 



</script>
</body>
   <!-- end::Body -->
</html>