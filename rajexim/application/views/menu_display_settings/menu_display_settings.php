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
                           <span class="m-nav__link-text">Menu Display Settings</span>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         
         <!-- END: Subheader -->
         <div class="m-content">
            <?php if($this->session->flashdata('mds_success')){?>
                    <div class="alert alert-success" id="alertaddmessage">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                   <?php echo $this->session->flashdata('mds_success'); ?>
                   </div>
                <?php } ?>

                <?php if($this->session->flashdata('mds_err')){?>
                    <div class="alert alert-success" id="alertaddmessage">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                   <?php echo $this->session->flashdata('mds_err'); ?>
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
                                 Menu Display Settings
                              </h3>
                           </div>
                        </div>
                     </div>
                     <form  name="menu_display_setting_form" id="menu_display_setting_form" method="POST" action="<?php echo base_url(); ?>Settings/display_menu" >

                        <input type="hidden" name="user_id" value="<?php echo $user_details->user_id;?>">
                     <div class="m-portlet__body">
                        <div class="row">
                           <div class="col-lg-6">
                                  <div class="form-group m-form__group">
                                             <label>Show Menu</label>
                                                <div class="m-radio-inline">
                                                <label class="m-radio m-radio--bold m-radio--success"> 
                                                <input type="radio" name="show_menu"  id="show_menu_0" value="0" <?php echo ($user_details->show_menu == 0) ? 'checked' : ''; ?>>Vertical
                                                <span></span>
                                                </label>
                                                <label class="m-radio m-radio--bold m-radio--success">
                                                <input type="radio" name="show_menu" id="show_menu_1" value="1" <?php echo ($user_details->show_menu == 1) ? 'checked' : ''; ?>>Horizontal 
                                                <span></span>
                                                </label>
                                             </div>
                                             <span class="text-danger"></span>
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
var title = $('title').text() + ' | ' + 'Display Menu Settings';
$(document).attr("title", title);   
</script>

   </body>
   <!-- end::Body -->
</html>