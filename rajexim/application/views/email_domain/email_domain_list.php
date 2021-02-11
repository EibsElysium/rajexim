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
                              <a href="<?php echo base_url(); ?>designation" class="m-nav__link">
                                 <span class="m-nav__link-text">Email Domain</span>
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
                                       Email Domain List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_email_domain">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Email Domain</span>
                                          </span>
                                       </a>
                                    </li>

                              <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                 <a href="javascript:;" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
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
                                                   <a href="javascript:;" class="m-nav__link" id="export_print">
                                                      <i class="m-nav__link-icon la la-print"></i>
                                                      <span class="m-nav__link-text">Print</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_copy">
                                                      <i class="m-nav__link-icon la la-copy"></i>
                                                      <span class="m-nav__link-text">Copy</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_excel">
                                                      <i class="m-nav__link-icon la la-file-excel-o"></i>
                                                      <span class="m-nav__link-text">Excel</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_csv">
                                                      <i class="m-nav__link-icon la la-file-text-o"></i>
                                                      <span class="m-nav__link-text">CSV</span>
                                                   </a>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="javascript:;" class="m-nav__link" id="export_pdf">
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

                                 <div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    </button>

                                    Email Domain activated successfully.

                                 </div>



                                 <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    </button>

                                    Email Domain deactivated successfully.

                                 </div>
                              <!--begin: Datatable -->
                           <table class="table table-striped table-bordered  table-checkable" id="m_table_2">
                              <thead>
                                 <tr>
                                    <th>Email Domain</th>
                                    <th>Status</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($get_all_email_domain))
                                    {
                                       $i = 1;
                                       foreach ($get_all_email_domain as $e_list) 
                                       { 
                                          ?>
                                          <tr>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['email_domain']; ?></h5>   
                                             </td>
                                             <td>
                                                <span class="m-switch m-switch--sm m-switch--success" data-toggle="m-tooltip" data-placement="top"  title=<?php if($e_list['status']==0){echo "Active";} else{echo "Inactive";} ?>>
                                                <label>
                                                   <input type="checkbox" <?php if($e_list['status']==0){echo "checked";} ?> id="activeunactive_<?php echo $i;?>"  name="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $e_list['email_domain_id']; ?>,<?php echo $i; ?>)" value="<?php echo $e_list['status'];?>"  data-plugin="switchery" data-color="#3f3e6a" data-size="small">
                                                   <span></span>
                                                   <span id="statusprint" style="display:none"><?php if($e_list['status']==0){echo 'Active';}else{echo 'Inactive';} ?></span>
                                                </label>
                                                </span>  
                                             </td>
                                             <td>
                                                <a href="javascript:;" data-toggle="modal" data-target="#email_domain_edit" onclick="return email_domain_edit(<?php echo $e_list['email_domain_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                                                                 
                                                <a href="javascript:;" data-toggle="modal" data-target="#email_domain_delete" onclick="return email_domain_delete(<?php echo $e_list['email_domain_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
                                             </td>
                                          </tr>
                                          
                                    <?php   $i++; }
                                    } ?>
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

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->

      <!-- end::Scroll Top -->
      <!--begin::Modal-->
      <!-- Create Lead Status-->
<div class="container">
   <div class="modal fade" id="create_email_domain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Email Domain</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Settings/add_email_domain" onsubmit="return add_email_domian_validation()">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Email Domain<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="email_domain" name="email_domain" placeholder="Enter Designation" onkeyup="chk_email_domain_unique(this.value);">
                           <span id="email_domain_err" class="text-danger"></span>
                        </div>
                     </div>

                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" id="btnSubmit" class="btn btn-primary">Create</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!-- Update exporter-->
<div class="container">
   <div class="modal fade" id="edit_email_domain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->


<div class="container">
   <div class="modal fade" id="delete_email_domain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Email Domain</h5>
               <button Source="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form method="POST" action="<?php echo base_url(); ?>Settings/delete_email_domain">
               <div class="modal-body">
                  <p>Are You Sure You Want to Delete this Email Domain Permanently?</p>
               </div>
               <input type="hidden" name="delete_email_domain_id" id="delete_email_domain_id">
               <div class="modal-footer">
                  <button Source="submit" id="delete_btnSubmit" class="btn btn-primary">Yes</button>
                  <button Source="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Designation List';
$(document).attr("title", title); 


function email_domain_delete($id)
{
   $('#delete_email_domain_id').empty().val($id);
   $('#delete_email_domain').modal('show');
}

var cno=0;
function chk_email_domain_unique(val)
{
    //var baseurl= $("#baseUrl").val();
    if(val!='')
    {
       $.ajax({
         type:"POST",
         url:baseurl+'Settings/chk_email_domain_unique',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
               
               if(result>0)
               {
                   $('#email_domain_err').html('Email Domain Already Exist!');
                   cno++;
               }
               else
               {
                   $('#email_domain_err').html('');
                   cno=0;
               }

         }
         });
   }
}
var cnoe=0;
function e_chk_email_domain_unique(val)
{
   var ex_val = $('#ex_email_domain').val();
    //var baseurl= $("#baseUrl").val();
    if(val.toUpperCase() != ex_val.toUpperCase())
    {
       $.ajax({
         type:"POST",
         url:baseurl+'Settings/chk_email_domain_unique',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
               if(result>0)
               {
                   $('#e_email_domain_err').html('Email Domain Already Exist!');
                   cnoe++;
               }
               else
               {
                   $('#e_email_domain_err').html('');
                   cnoe=0;
               }

         }
         });
   }
}
function add_email_domian_validation()
{
   var err = 0;
   var email_domain = $('#email_domain').val();

   if(email_domain==''){
      $('#email_domain_err').html('Email Domain is required!');
      err++;
   }
   else
   {
      if(cno>0)
      {
         $('#email_domain_err').html('Email Domain Already Exist!');
         err++;
      }
      else
      {
         $('#email_domain_err').html('');
      }
   }

   if(err>0){ return false; }else{ return true; }
}
function edit_email_domian_validation()
{
   var err = 0;
   var email_domain = $('#e_email_domain').val();

   if(email_domain==''){
      $('#e_email_domain_err').html('Email Domain is required!');
      err++;
   }
   else
   {
      if(cnoe>0)
      {
         $('#e_email_domain_err').html('Email Domain Already Exist!');
         err++;
      }
      else
      {
         $('#e_email_domain_err').html('');
      }
   }

   if(err>0){ return false; }else{ return true; }
}

function activeunactive(val,ival) {
            var unactive;
            var unactv;
            //var baseurl= $("#baseUrl").val();
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
               url:baseurl+'Settings/email_domain_change_status',
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
                     window.location = baseurl+"Settings/email_domain";
                    }, 3000);
               },
               error: function (error) {
                  alert('error; ' + eval(error));
                  setTimeout(function() {
                     window.location = baseurl+"Settings/email_domain";
                    }, 3000);
               }
            });
         }

function email_domain_edit(val){
//var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'Settings/email_domain_edit',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#edit_email_domain').empty().append(response);
$('#edit_email_domain').modal('show');
}
});
}   



</script>
</body>
   <!-- end::Body -->
</html>