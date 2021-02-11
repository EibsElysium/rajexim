<?php $this->load->view('common_header'); ?>
	
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
										<a href="javascript:;" class="m-nav__link">
											<span class="m-nav__link-text">Role List</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">
                  <div class="alert alert-success alert-dismissible" style="display:none;" id="active" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     Role has been activated successfully
                  </div>
                        <div class="alert alert-success alert-dismissible" style="display:none;" id="deactive" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     </button>
                     Role has been deactivated successfully
                  </div>

                  <?php if($this->session->flashdata('role_success')){?>
                     <div class="alert alert-success alert-dismissible response" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <?php echo $this->session->flashdata('role_success'); ?>              
                     </div>
                  <?php } if($this->session->flashdata('role_err')){?>
                     <div class="alert alert-success alert-dismissible response" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <?php echo $this->session->flashdata('role_err'); ?>                  
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
                                       Role Permission
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php //if($_SESSION['Role PermissionAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url();?>Roles/add_role_page" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create</span>
                                          </span>
                                       </a>
                                    </li>
                                 <?php //} ?>

                              <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                 <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
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
                                                   <a href="#" class="m-nav__link" id="export_print">
                                                      <i class="m-nav__link-icon la la-print"></i>
                                                      <span class="m-nav__link-text">Print</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="#" class="m-nav__link" id="export_copy">
                                                      <i class="m-nav__link-icon la la-copy"></i>
                                                      <span class="m-nav__link-text">Copy</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="#" class="m-nav__link" id="export_excel">
                                                      <i class="m-nav__link-icon la la-file-excel-o"></i>
                                                      <span class="m-nav__link-text">Excel</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="#" class="m-nav__link" id="export_csv">
                                                      <i class="m-nav__link-icon la la-file-text-o"></i>
                                                      <span class="m-nav__link-text">CSV</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="#" class="m-nav__link" id="export_pdf">
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

                              <!--begin: Datatable -->
                           <table class="table table-striped table-bordered table-hover table-checkable" id="m_table_2">
                              <thead>
                                 <tr>
                                    <th>Role Name</th>
                                    <th data-orderable="false">Status</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php $i=1; foreach ($role_list as $role ) { 
                                    if ($role->role_id != 1) { ?>
                                 <tr>
                                    <td><?php echo ucfirst($role->role_name); ?></td>
                                    <td>
                                       <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="Active">
                                       <label>
                                          <input <?php if($role->status==0){echo "checked";} ?> type="checkbox" id="activeunactive_<?php echo $i;?>"  name="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $role->role_id; ?>,<?php echo $i; ?>)" value="<?php echo $role->status;?>">
                                          <span></span>
                                          <span id="statusprint" style="display:none"><?php if($role->status==0){echo 'Active';}else{echo 'Inactive';} ?></span>
                                       </label>
                                       </span>
                                    </td>
                                    <td>

                                    <?php if($_SESSION['Role PermissionEdit']==1){ ?>
                                       <a href="<?php echo base_url();?>Roles/edit_role_page/<?php echo $role->role_id; ?>" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php if($_SESSION['Role PermissionDelete']==1){ ?>
                                       <a href="#" data-toggle="modal" ><span onclick="role_delete(<?php echo $role->role_id; ?>)"  class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
                                    <?php } ?>
                                    </td>
                                 </tr>
                                 <?php $i++; } } ?>
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

			<?php $this->load->view('common_footer'); ?>
<!--begin::Modal-->
<div class="container">
   <div class="modal fade" id="role_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form action="<?php echo base_url(); ?>Roles/role_delete" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Role</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Delete this Role Permanently?</p>
               <input type="hidden" name="rid" id="rid">
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
<!--end::Modal-->


	</body>

   <script type="text/javascript">
      function activeunactive(val,ival) 
      {
         var unactive;
         var unactv;
         var baseurl='<?php echo base_url(); ?>';
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
            url:baseurl+'Roles/role_active',
            data:datastring,
            cache: false,
            dataType: "html",
            success: function(result){
               if(unactive==0){
                  $("#active").css('display','block');
                  $("#active").addClass('response');
               }
               if(unactive==1){
                  $("#deactive").css('display','block');
                  $("#deactive").addClass('response');
               }
               setTimeout(function() {
                    window.location = baseurl+"Roles";
                  $("#deactive").removeClass('response');
                  $("#deactive").removeClass('response');
                 }, 3000);
            },
            error: function (error) {
               alert('error; ' + eval(error));
            }
         });
      }


      function role_delete(val)
      {
         $('#rid').val(val);
         $("#role_delete").modal('show');
      }
   </script>

	<!-- end::Body -->
</html>