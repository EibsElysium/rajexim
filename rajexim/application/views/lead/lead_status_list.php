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

                                 <span class="m-nav__link-text">Lead Settings</span>

                              </a>

                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>

                           <li class="m-nav__item">

                              <a href="javascript:;" class="m-nav__link">

                                 <span class="m-nav__link-text">Lead Status List</span>

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

                                       Lead Status List

                                    </h3>

                                 </div>

                              </div>

                              <div class="m-portlet__head-tools">

                                 <ul class="m-portlet__nav">

                                    <li class="m-portlet__nav-item">

                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_lead_status">

                                          <span>

                                             <i class="la la-plus"></i>

                                             <span>Create</span>

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

                              <div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">

                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                 </button>

                                 Lead Status has activated successfully.

                              </div>



                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">

                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                 </button>

                                 Lead Status has deactivated successfully.

                              </div>



                              <?php if($this->session->flashdata('l_t_success')){?>

                                   <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">

                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    </button>

                                    <?php echo $this->session->flashdata('l_t_success'); ?>

                                 </div>

                                 <?php } ?>



                              <?php if($this->session->flashdata('l_t_err')){?>

                                      <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    </button>

                                    <?php echo $this->session->flashdata('l_t_err'); ?>

                                 </div>

                                 <?php } ?>  

                              <!--begin: Datatable -->

                           <table class="table table-striped table-bordered  table-checkable" id="m_table_2">

                              <thead>

                                 <tr>

                                    <th>Lead Status</th>

                                    <th>Status</th>

                                    <th class="notexport" data-orderable="false">Action</th>

                                 </tr>

                              </thead>

                              <tbody>

                                 <?php

                                    if(!empty($lead_statuss))

                                    {

                                       $i = 1;

                                       foreach ($lead_statuss as $key => $l_status) 

                                       { ?>

                                          <tr>

                                             <td><?php echo $l_status->lead_status; ?></td>

                                             <td>

                                                <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="<?php if($l_status->status==0){ echo 'Active'; }else{ echo 'In Active'; } ?>">

                                                <label>

                                                   <input type="checkbox" <?php if($l_status->status==0){ echo "checked";} ?> name="activeunactive_<?php echo $i;?>" id="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $l_status->lead_status_id; ?>,<?php echo $i; ?>)" value="<?php echo $l_status->status;?>">

                                                   <span></span>

                                                </label>

                                                </span>

                                             </td>

                                             <td>

                                                   <a href="javascript:;" data-toggle="modal" data-target="#lead_status_edit" onclick="return lead_status_edit(<?php echo $l_status->lead_status_id; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;

                                              

                                                   <a href="javascript:;" data-toggle="modal" data-target="#delete_lead_status" onclick="return lead_status_delete(<?php echo $l_status->lead_status_id; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>

                                                

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



      <!-- begin::Scroll Top -->

      <div id="m_scroll_top" class="m-scroll-top">

         <i class="la la-arrow-up"></i>

      </div>



      <!-- end::Scroll Top -->

      <!--begin::Modal-->

      <!-- Create Lead Status-->

<div class="container">

   <div class="modal fade" id="create_lead_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-md" role="document">

         <form name="create_lead_status" id="create_lead_status" method="POST" action="<?php echo base_url(); ?>Leads/lead_status_add" onsubmit="return lead_status_validation()">

            <div class="modal-content">

               <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel">Create Lead Status</h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                     <span aria-hidden="true">&times;</span>

                  </button>

               </div>

               <div class="modal-body">

                  <div class="row">

                     <div class="col-lg-12">

                        <div class="row">

                         

                           <div class="col-lg-12">

                              <div class="form-group m-form__group">

                                 <label>Lead Status<span class="text-danger">*</span></label>

                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Status" name="lead_status" id="lead_status" maxlength="100" onblur="return lead_status_unique();">

                                 <span id="lead_status_err" class="text-danger"></span>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>

               <div class="modal-footer">

                  <button type="submit" id="btnSubmit" class="btn btn-primary">Create</button>

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

               </div>

            </div>

         </form>

      </div>

   </div>

</div>



<!-- Update Lead Status-->

<div class="container">

   <div class="modal fade" id="lead_status_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-md" role="document">

         <form name="lead_status_edit_form" id="lead_status_edit_form" method="POST" action="<?php echo base_url(); ?>Leads/lead_status_update" onsubmit="return lead_status_edit_validation()">

            <div class="modal-content">

               <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel">Edit Lead Status</h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                     <span aria-hidden="true">&times;</span>

                  </button>

               </div>

               <div class="modal-body">

                  <div class="row">

                     <div class="col-lg-12">

                        <div class="row">

                         

                           <div class="col-lg-12">

                              <div class="form-group m-form__group">

                                 <label>Lead Status<span class="text-danger">*</span></label>

                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Status" name="lead_status" 

                                 id="e_lead_status" maxlength="100" onblur="return lead_status_unique_edit();">

                                 <span id="e_lead_status_err" class="text-danger"></span>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>

               <div class="modal-footer">

                  <input type="hidden" name="e_lead_status_id" id="e_lead_status_id" value="">

                  <button type="submit" id="edit_btnSubmit" class="btn btn-primary">Save Changes</button>

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

               </div>

            </div>

         </form>

      </div>

   </div>

</div>



<!-- Drop Lead-->

<div class="container">

   <div class="modal fade" id="lead_status_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">

         <form name="lead_status_delete_form" id="lead_status_delete_form" method="POST" action="<?php echo base_url(); ?>Leads/lead_status_delete">

            <div class="modal-content">

               <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel">Delete Lead Status</h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                     <span aria-hidden="true">&times;</span>

                  </button>

               </div>

               <div class="modal-body">

                  <p>Are You Sure You Want to Drop this lead Status permanently?</p>

               </div>

               <input type="hidden" name="delete_lead_status_id" id="delete_lead_status_id">

               <div class="modal-footer">

                  <button type="submit" id="delete_btnSubmit" class="btn btn-primary">Yes</button>

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

               </div>

            </div>

         </form>

      </div>

   </div>

</div>

   

<script type="text/javascript">

var baseurl = '<?php echo base_url(); ?>';

var title = $('title').text() + ' | ' + 'Lead Status List';

$(document).attr("title", title);   

 // To validate lead Status add form

function lead_status_validation()

{

   var err = 0;

   var l_t_name = $('#lead_status').val();

   if(l_t_name == '')

   {

      $('#lead_status_err').html('Lead Status is required!');

      err++;

   }else{

      $('#lead_status_err').html('');

   }

   

   if(err> 0){ return false;}else{ return true; }   

}



 // To validate lead Status edit form

function lead_status_edit_validation()

{

   var err = 0;

   var l_t_name = $('#e_lead_status').val();

   if(l_t_name == '')

   {

      $('#e_lead_status_err').html('Lead Status is required!');

      err++;

   }else{

      $('#e_lead_status_err').html('');

   }

   

   if(err> 0){ return false;}else{ return true; }   

}



// To check lead Status name is unique

function lead_status_unique()

{

   var l_t_name = $('#lead_status').val();



   $.ajax({

      type:"POST",

      url:baseurl+'Leads/lead_status_unique',

      data:{'value':l_t_name},

      cache: false,

      dataType: "html",

      success: function(result){

            

         if(result>0)

         {

            $('#lead_status_err').html('Lead Status already exists!');

            $('#btnSubmit').prop('disabled', true);

         }

         else

         {

            $('#btnSubmit').prop('disabled', false);

         }

      }

   });

}



// To check lead Status name is unique for edit form

function lead_status_unique_edit()

{

   var l_t_name = $('#e_lead_status').val();

   var l_t_id   = $('#e_lead_status_id').val();



   $.ajax({

      type:"POST",

      url:baseurl+'Leads/lead_status_unique_edit',

      data:{'value':l_t_name, 'id':l_t_id},

      cache: false,

      dataType: "html",

      success: function(result){

            

         if(result>0)

         {

            $('#e_lead_status_err').html('Lead Status already exists!');

            $('#edit_btnSubmit').prop('disabled', true);

         }

         else

         {

            $('#edit_btnSubmit').prop('disabled', false);

         }

      }

   });

}



// To show lead edit

function lead_status_edit(val)

{

   $.ajax({

      type:"POST",

      url:baseurl+'Leads/lead_status_edit',

      data:{'value':val},

      cache: false,

      dataType: "html",

      success: function(result){



         if(result != '')

         {

            var res = result.split('|');

            $("#e_lead_status_id").val(res[0]);

            $("#e_lead_status").val(res[1]);

         }else{

            $("#e_lead_status_id").val();

            $("#e_lead_status").val();

         }

         

      }

   });

   $("#lead_status_edit").modal('show');

}

// To change active status

function activeunactive(val,ival) {



   var unactive;

   var unactv;

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

      url:baseurl+'Leads/lead_status_change_status',

      data:datastring,

      cache: false,

      dataType: "html",

      success: function(result){ 

        if(unactive == 0){

            $('#active_success').show();

            $('#inactive_success').hide();

            setTimeout(function() {

            window.location = baseurl+"Leads/lead_status_list";

         }, 3000);

        }else{

            $('#active_success').hide();

            $('#inactive_success').show();

            setTimeout(function() {

         window.location = baseurl+"Leads/lead_status_list";

         }, 3000);

        }

       } 

   });

}

// To delete lead Status id

function lead_status_delete(val){



    $("#delete_lead_status_id").val(val)

   $("#lead_status_delete").modal('show');



}

</script>

</body>

   <!-- end::Body -->

</html>