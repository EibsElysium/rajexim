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
                              <a href="<?php echo base_url(); ?>container" class="m-nav__link">
                                 <span class="m-nav__link-text">Container</span>
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
                                       Container List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['ContainerAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_container">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Container</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php }?>

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
                              <!--begin: Datatable -->
                           <table class="table table-striped table-bordered  table-checkable" id="m_table_2">
                              <thead>
                                 <tr>
                                    <th>Container</th>
                                    <th>Max CBM</th>
                                    <th>Min CBM</th>
                                    <th>Max Ton</th>
                                    <th>Ton Variance</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($container_list))
                                    {
                                       $i = 1;
                                       foreach ($container_list as $e_list) 
                                       { 
                                          ?>
                                          <tr>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['container_name']; ?></h5>   
                                             </td>
                                             <td><?php echo $e_list['max_cbm']; ?></td>
                                             <td><?php echo $e_list['min_cbm']; ?></td>
                                             <td><?php echo $e_list['max_ton']; ?></td>
                                             <td><?php echo $e_list['ton_variance']; ?></td>
                                             <td>
                                                   <?php if($_SESSION['ContainerEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#container_edit" onclick="return container_edit(<?php echo $e_list['container_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                   <?php }?>
                                                
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
   <div class="modal fade" id="create_container" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Container</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_cont" id="create_cont" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>container/create_container" onsubmit="return container_validation()">
               <div class="modal-body">
                  <div class="row">

                     <div class="col-lg-4">
                        <div class="form-group m-form__group">
                           <label>Container<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="container_name" name="container_name" placeholder="Enter Container" onkeyup="checkContainerUnique(this.value);">
                           <span id="container_name_err" class="text-danger"></span>
                        </div>
                     </div>

                     <div class="col-lg-4">
                        <div class="form-group m-form__group">
                           <label>Min CBM<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="min_cbm" name="min_cbm" placeholder="Enter Min CBM" onkeypress="return isNumberKey(event,this);">
                           <span id="min_cbm_err" class="text-danger"></span>
                        </div>
                     </div>

                     <div class="col-lg-4">
                        <div class="form-group m-form__group">
                           <label>Max CBM<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="max_cbm" name="max_cbm" placeholder="Enter Max CBM" onkeypress="return isNumberKey(event,this);">
                           <span id="max_cbm_err" class="text-danger"></span>
                        </div>
                     </div>

                  </div>
                  <div class="row">

                     <div class="col-lg-4">
                        <div class="form-group m-form__group">
                           <label>Max Ton<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="max_ton" name="max_ton" placeholder="Enter Max Ton" onkeypress="return isNumberKey(event,this);">
                           <span id="max_ton_err" class="text-danger"></span>
                        </div>
                     </div>

                     <div class="col-lg-4">
                        <div class="form-group m-form__group">
                           <label>Ton Variance</label>
                           <input type="text" class="form-control m-input m-input--square" id="ton_variance" name="ton_variance" placeholder="Enter Ton Variance" onkeypress="return isNumberKey(event,this);">
                           <span id="ton_variance_err" class="text-danger"></span>
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
   <div class="modal fade" id="container_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Container List';
$(document).attr("title", title); 

var cno=0;
function checkContainerUnique(val)
{
    //var baseurl= $("#baseUrl").val();
    if(val!='')
    {
       $.ajax({
         type:"POST",
         url:baseurl+'container/checkContainerUnique',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
               
               if(result>0)
               {
                   $('#container_name_err').html('Container Already Exist!');
                   cno++;
               }
               else
               {
                   $('#container_name_err').html('');
                   cno=0;
               }

         }
         });
   }
}   

var cnoe=0;
function checkContainerUniqueEdit(val)
{
    //var baseurl= $("#baseUrl").val();
    var bid = $('#container_id').val();
    if(val!='')
    {
       $.ajax({
         type:"POST",
         url:baseurl+'container/checkContainerUniqueEdit',
         data:{'value':val,'bid':bid},
         cache: false,
         dataType: "html",
         success: function(result){
               
               if(result>0)
               {
                   $('#container_name_edit_err').html('Container Already Exist!');
                   cnoe++;
               }
               else
               {
                   $('#container_name_edit_err').html('');
                   cnoe=0;
               }

         }
         });
   }
} 


function isNumberKey(evt, obj)
{ 
    var charCode = (evt.which) ? evt.which : event.keyCode
    var value = obj.value;
    var dotcontains = value.indexOf(".") != -1;
    if (dotcontains)
        if (charCode == 46) return false;
    if (charCode == 46) return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function container_validation()
{
   var err = 0;
   var cname = $('#container_name').val();
   var micbm = $('#min_cbm').val();
   var mxcbm = $('#max_cbm').val();
   var mxton = $('#max_ton').val();
   if(cname == '')
   {
      $('#container_name_err').html('Container is required!');
      err++;
   }else{
      if(cno>0)
      {
         $('#container_name_err').html('Container Already Exist!');
         err++;
      }
      else
      {
         $('#container_name_err').html('');
      }
   }
   if(micbm == '')
   {
      $('#min_cbm_err').html('Min CBM is required!');
      err++;
   }else{
      $('#min_cbm_err').html('');
   }
   if(mxcbm == '')
   {
      $('#max_cbm_err').html('Max CBM is required!');
      err++;
   }else{
      $('#max_cbm_err').html('');
   }
   if(mxton == '')
   {
      $('#max_ton_err').html('Max Ton is required!');
      err++;
   }else{
      $('#max_ton_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

function container_edit_validation()
{
   var err = 0;
   var cname = $('#container_name_edit').val();
   var micbm = $('#min_cbm_edit').val();
   var mxcbm = $('#max_cbm_edit').val();
   var mxton = $('#max_ton_edit').val();
   if(cname == '')
   {
      $('#container_name_edit_err').html('Container is required!');
      err++;
   }else{
      if(cnoe>0)
      {
         $('#container_name_edit_err').html('Container Already Exist!');
         err++;
      }
      else
      {
         $('#container_name_edit_err').html('');
      }
   }
   if(micbm == '')
   {
      $('#min_cbm_edit_err').html('Min CBM is required!');
      err++;
   }else{
      $('#min_cbm_edit_err').html('');
   }
   if(mxcbm == '')
   {
      $('#max_cbm_edit_err').html('Max CBM is required!');
      err++;
   }else{
      $('#max_cbm_edit_err').html('');
   }
   if(mxton == '')
   {
      $('#max_ton_edit_err').html('Max Ton is required!');
      err++;
   }else{
      $('#max_ton_edit_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}


function container_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'container/container_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#container_edit').empty().append(response);
   }
   });
}



</script>
</body>
   <!-- end::Body -->
</html>