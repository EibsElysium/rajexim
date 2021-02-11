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
               <?php if($this->session->flashdata('employee_success')){?>
               <div class="alert alert-success alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('employee_success'); ?>               
               </div>
               <?php } ?> 
               <?php if($this->session->flashdata('employee_err')){?>
               <div class="alert alert-danger alert-dismissible response" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <?php echo $this->session->flashdata('employee_err'); ?>                
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
                                      Employee List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">

                                    <?php if($_SESSION['EmployeeAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url();?>employee/add_employee" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Employee</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php }?>

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

                              <?php if($this->session->flashdata('qstage_success')){?>
                                   <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('qstage_success'); ?>
                                 </div>
                                 <?php } ?>

                              <?php if($this->session->flashdata('qstage_err')){?>
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <?php echo $this->session->flashdata('qstage_err'); ?>
                                 </div>
                                 <?php } ?>  
                              <!--begin: Datatable -->

                              <div class="row"> 
                                 <div class="col-lg-12">  
                                    <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
                                       <thead>
                                          <tr>
                                             <th>Emp ID</th>
                                             <th>Name</th>
                                             <th>Contact No</th>
                                             <th>Gender</th>
                                             <th>Designation</th>
                                             <th>Area</th>
                                             <th data-orderable="false">Status</th>
                                             <th class="notexport" data-orderable="false">Actions</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php $i=0;foreach ($employee_list as $qlist){
                                          if($qlist['gender']==0)
                                             $gender = 'Male';
                                          else
                                             $gender = 'Female';
                                             ?>
                                          <tr>
                                             <td><?php echo $qlist['employee_no']; ?></td>
                                             <td><?php echo $qlist['display_name']; ?></td>
                                             <td><?php echo $qlist['contact_no']; ?></td>
                                             <td><?php echo $gender; ?></td>
                                             <td><?php echo $qlist['designation']; ?></td>
                                             <td><?php echo $qlist['area']; ?></td>
                                             <td>
                                                <span class="m-switch m-switch--sm m-switch--success" data-toggle="m-tooltip" data-placement="top" title=<?php if($qlist['status']==0){echo "Active";} else{echo "Inactive";} ?>>
                                                   <label>
                                                      <input type="checkbox" <?php if($qlist['status']==0){echo "checked";} ?> id="activeunactive_<?php echo $i;?>"  name="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $qlist['employee_id']; ?>,<?php echo $i; ?>)" value="<?php echo $qlist['status'];?>"  data-plugin="switchery" data-color="#3f3e6a" data-size="small">
                                                      <span></span>
                                                      <span id="statusprint" style="display:none"><?php if($qlist['status']==0){echo 'Active';}else{echo 'Inactive';} ?></span>
                                                   </label>
                                                </span>
                                             </td>
                                             <td>

                                                <?php if($_SESSION['EmployeeView']==1){?>
                                                <a href="<?php echo base_url(); ?>employee/employee_view/<?php echo $qlist['employee_id']; ?>">
                                                   <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></span>
                                                </a>&nbsp;&nbsp;
                                                <?php }?>
                                                <?php if($_SESSION['EmployeeEdit']==1){?>
                                                <a href="<?php echo base_url(); ?>employee/employee_edit/<?php echo $qlist['employee_id']; ?>">
                                                   <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span>
                                                </a>&nbsp;&nbsp;
                                                <?php }?>
                                                <?php if($_SESSION['EmployeeDelete']==1){?>
                                                   <a href="#" onclick="return delete_employee(<?php echo $qlist['employee_id']; ?>)" data-toggle="m-tooltip" data-placement="top" title="Delete"><span class="tooltip-animation"><i class="fa fa-trash-alt"></i></span></a>
                                                <?php }?>
                                             </td>
                                          </tr>
                                          <?php $i++;}?>
                                       </tbody>
                                    </table>
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


         <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <form action="<?php echo base_url(); ?>employee/employee_delete" method="post">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>Are you sure want to delete this employee permanently?</p>
                     </div>
                     <input type="hidden" name="employee" id="employee" value="">
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                     </div>
                  </form>
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
   var title = $('title').text() + ' | ' + 'Employee List';
   $(document).attr("title", title);


         function delete_employee(val){
            $("#employee").val(val);
            $("#m_modal_1").modal('show');
         }
         function activeunactive(val,ival) {
            var unactive;
            var unactv;
            //var baseurl= $("#baseurl").val();
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
               url:baseurl+'employee/employee_active',
               data:datastring,
               cache: false,
               dataType: "html",
               success: function(result){
                  // alert(result+unactive);
                  if(a == 1){
                        $("#active").css('display','block');
                     $("#active").addClass('response');
                    }else{
                        $("#deactive").css('display','block');
                     $("#deactive").addClass('response');
                    }      
                     setTimeout(function() {
                     window.location = baseurl+"employee";
                    }, 3000);
               },
               error: function (error) {
                  alert('error; ' + eval(error));
                  setTimeout(function() {
                     window.location = baseurl+"employee";
                    }, 3000);
               }
            });
         }

</script>


   </body>

   <!-- end::Body -->
</html>