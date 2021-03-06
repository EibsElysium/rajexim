<?php $this->load->view('common_header'); ?>
<style>
   span.lead_source_color {
       border: 1px solid #aaa;
       padding: 1px 11px;
       margin-left: 2%;
       border-radius: 50px;
   }
</style>

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
                                 <span class="m-nav__link-text">Followup Sheet</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>followupsheetstage" class="m-nav__link">
                                 <span class="m-nav__link-text">Stage</span>
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
                                       Followup Sheet Stage List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Followup Sheet StageAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_followup_sheet_stage">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Followup Sheet Stage</span>
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
                                    <th>Stage</th>
                                    <th>Color</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($followup_sheet_stage_list))
                                    {
                                       $i = 1;
                                       foreach ($followup_sheet_stage_list as $e_list) 
                                       { 
                                          ?>
                                          <tr>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['followup_sheet_stage']; ?></h5>   
                                             </td>
                                             <?php if($e_list['stage_color']!=''){?>
                                             <td><span class="lead_source_color" style="background-color: <?php echo $e_list['stage_color']; ?>;"></span></td>
                                             <?php }else{?>
                                             <td></td>
                                             <?php }?>
                                             <td>
                                                   <?php if($_SESSION['Followup Sheet StageEdit']==1 && $e_list['followup_sheet_stage_id']>2){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#followup_sheet_stage_edit" onclick="return followup_sheet_stage_edit(<?php echo $e_list['followup_sheet_stage_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
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
   <div class="modal fade" id="create_followup_sheet_stage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Followup Sheet Stage</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>followupsheetstage/create_followup_sheet_stage" onsubmit="return followup_sheet_stage_validation()">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Stage<span class="text-danger">*</span></label>
                              <input type="text" class="form-control m-input m-input--square" placeholder="Enter Followup Sheet Stage" id="followup_sheet_stage" name="followup_sheet_stage" onkeyup="checkUniqueFollowupSheetStage();">
                              <span id="followup_sheet_stage_err" class="text-danger"></span>
                           </div>
                        </div>                           
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Stage Color</label>
                              <input type="text"  class="form-control m-input m-input--square picker4" readonly placeholder="Choose Stage Color" name="stage_color" id="stage_color">
                              <span id="stage_color_err" class="text-danger"></span>
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
   <div class="modal fade" id="followup_sheet_stage_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Followup Stage List';
$(document).attr("title", title); 

$('.picker4').colorpicker({
   colorSelectors: {
       'default': '#A9B6BC',
       'primary': '#418BCA',
       'success': '#01BC8C',
       'info': '#67C5DF',
       'warning': '#F89A14',
       'danger': '#EF6F6C'
   }
});

var expo = 0;
function checkUniqueFollowupSheetStage()
{
   var val = $('#followup_sheet_stage').val();
   $.ajax({
      type:"POST",
      url:baseurl+'followupsheetstage/checkUniqueFollowupSheetStage',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#followup_sheet_stage_err').html('Stage already exists!');
            $('#btnSubmit').prop('disabled', true);
            expo = 1;
         }
         else
         {
            $('#followup_sheet_stage_err').html('');
            $('#btnSubmit').prop('disabled', false);
            expo = 0;
         }
      }
   });
}


function followup_sheet_stage_validation()
{
   var err = 0;
   var name = $('#followup_sheet_stage').val();
   //var scolor = $('#stage_color').val();
   if(name == '')
   {
      $('#followup_sheet_stage_err').html('Stage is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#followup_sheet_stage_err').html('Stage already exists!');
         err++;
      }
      else
      {
         $('#followup_sheet_stage_err').html('');
      }
   }

   /*if(scolor=='')
   {
      $('#stage_color_err').html('Choose Type!');
      err++;
   }
   else
   {
      $('#stage_color_err').html('');
   }*/
   
   if(err> 0){ return false;}else{ return true; }   
}

function changePermissionCheck(id,val)
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


function followup_sheet_stage_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'followupsheetstage/followup_sheet_stage_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#followup_sheet_stage_edit').empty().append(response);
   }
   });
}



</script>
</body>
   <!-- end::Body -->
</html>