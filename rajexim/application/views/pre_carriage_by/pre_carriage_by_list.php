<?php $this->load->view('common_header'); ?>

            <div class="m-grid__item m-grid__item--fluid m-wrapper">
               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon la la-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Settings</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Proforma Invoice</span>
                              </a>
                           </li>
                           <li class="m-nav__separator">-</li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>Pre_carriage_by" class="m-nav__link">
                                 <span class="m-nav__link-text">Pre-Carriage By</span>
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
                                       Pre-Carriage By List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Pre-Carriage ByAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_pre_carriage_by">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php } ?>

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
                                 Pre-Carriage By has activated successfully.
                              </div>

                              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 </button>
                                 Pre-Carriage By has deactivated successfully.
                              </div>

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
                                    <th>Pre-Carriage By</th>
                                    <th>Status</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($pre_carriage_by_list))
                                    {
                                       $i = 1;
                                       foreach ($pre_carriage_by_list as $pre_list) 
                                       { ?>
                                          <tr>
                                             <td>
                                                <?php echo $pre_list['pre_carriage_by']; ?>   
                                             </td>
                                             <td>
                                                <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="<?php if($pre_list['status']==0){ echo 'Active'; }else{ echo 'In Active'; } ?>">
                                                <label>
                                                   <input type="checkbox" <?php if($pre_list['status']==0){ echo "checked";} ?> name="activeunactive_<?php echo $i;?>" id="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $pre_list['pre_carriage_by_id']; ?>,<?php echo $i; ?>)" value="<?php echo $pre_list['status'];?>">
                                                   <span></span>
                                                </label>
                                                </span>
                                             </td>
                                             <td>
                                                   <?php if($_SESSION['PI StageEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#pre_carriage_by_edit" onclick="return pre_carriage_by_edit(<?php echo $pre_list['pre_carriage_by_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                   <?php }?>
                                                   <?php if($_SESSION['PI StageDelete']==1){ ?>                                              
                                                   <a href="javascript:;" data-toggle="modal" data-target="#pre_carriage_by_delete" onclick="return pre_carriage_by_delete(<?php echo $pre_list['pre_carriage_by_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>
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
   <div class="modal fade" id="create_pre_carriage_by" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Pre-Carriage By</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Pre_carriage_by/create_pre_carriage_by" onsubmit="return create_pre_carriage_by_validataion()">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Pre-Carriage By<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Pre-Carriage by" name="pre_carriage_by" id="pre_carriage_by" onkeyup="checkUniquePreCarriage();">
                                    <span id="pre_carriage_by_err" class="text-danger"></span>
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
               </form>
            </div>
      </div>
   </div>
</div>

<!-- Update exporter-->
<div class="container">
   <div class="modal fade" id="pre_carriage_by_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="pre_carriage_by_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Pre-Carriage By</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?php echo base_url(); ?>pre_carriage_by/pre_carriage_by_delete" method="POST">
               <div class="modal-body">
                  <p>Are You Sure You Want to Delete this Pre-Carriage By Permanently?</p>
                  <input type="hidden" name="del_pre_carriage_by_id" id="del_pre_carriage_by_id">
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
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Pre-Carriage By List';
$(document).attr("title", title); 

// To check exporter name is unique
var expo = 0;
function checkUniquePreCarriage()
{
   var val = $('#pre_carriage_by').val();
   $.ajax({
      type:"POST",
      url:baseurl+'Pre_carriage_by/checkUniquePreCarriage',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#pre_carriage_by_err').html('Pre-Carriage By already exists!');
            $('#btnSubmit').prop('disabled', true);
            expo = 1;
         }
         else
         {
            $('#pre_carriage_by_err').html('');
            $('#btnSubmit').prop('disabled', false);
            expo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function create_pre_carriage_by_validataion()
{
   var err = 0;
   var name = $('#pre_carriage_by').val();
   if(name == '')
   {
      $('#pre_carriage_by_err').html('Pre-Carriage by is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#pre_carriage_by_err').html('Pre-Carriage by already exists!');
         err++;
      }
      else
      {
         $('#pre_carriage_by_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

// To edit exporter
function pre_carriage_by_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'Pre_carriage_by/pre_carriage_by_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#pre_carriage_by_edit').empty().append(response);
   }
   });
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
      url:baseurl+'Pre_carriage_by/pre_carriage_by_change_status',
      data:datastring,
      cache: false,
      dataType: "html",
      success: function(result){ 
        if(unactive == 0){
            $('#active_success').show();
            $('#inactive_success').hide();
            setTimeout(function() {
            window.location = baseurl+"Pre_carriage_by";
         }, 3000);
        }else{
            $('#active_success').hide();
            $('#inactive_success').show();
            setTimeout(function() {
         window.location = baseurl+"Pre_carriage_by";
         }, 3000);
        }
       } 
   });
}
// To delete exporter


function pre_carriage_by_delete(val){
   $('#del_pre_carriage_by_id').empty().val(val);
   $('#pre_carriage_by_delete').modal('show');
}


</script>
</body>
   <!-- end::Body -->
</html>