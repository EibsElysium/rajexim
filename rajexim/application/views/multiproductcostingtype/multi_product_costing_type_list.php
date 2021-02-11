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
                                 <span class="m-nav__link-text">Product Costing</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>multiproductcostingtype" class="m-nav__link">
                                 <span class="m-nav__link-text">Multi Product Costing Type</span>
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
                                       Multi Product Costing Type List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Multi Product Costing TypeAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#multi_create_product_costing_type">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Multi Product Costing Type</span>
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
                                    <th>Costing Type</th>
                                    <th>Is Edit</th>
                                    <th>Mathematic Action</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($multi_product_costing_type_list))
                                    {
                                       $i = 1;
                                       foreach ($multi_product_costing_type_list as $e_list) 
                                       { 
                                          if($e_list['is_edit']!=0)
                                          {
                                             
                                             $edit = 'Yes';
                                          }
                                          else
                                          {
                                             $edit = 'No';
                                          }
                                          if($e_list['math_action']!='')
                                          {
                                             
                                             $maction = $e_list['math_action'];
                                          }
                                          else
                                          {
                                             $maction = '-';
                                          }
                                          ?>
                                          <tr>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['multi_product_costing_type']; ?></h5>   
                                             </td>
                                             <td><?php echo $edit;?></td>
                                             <td><?php echo $maction; ?></td>
                                             <td>
                                                   <?php if($_SESSION['Multi Product Costing TypeEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#multi_product_costing_type_edit_mod" onclick="return multi_product_costing_type_edit(<?php echo $e_list['multi_product_costing_type_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
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
   <div class="modal fade" id="multi_create_product_costing_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Multi Product Costing Type</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>multiproductcostingtype/create_multi_product_costing_type" onsubmit="return multi_product_costing_type_validation()">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label>Costing Type<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="multi_product_costing_type" name="multi_product_costing_type" placeholder="Enter Costing Type">
                           <span id="multi_product_costing_type_err" class="text-danger"></span>
                        </div>
                     </div>

                     <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                              <input type="checkbox" class="menu_checkbox" id="is_edit" name="is_edit" value="0" onchange="changePermissionCheck(this.id,this.value);"> Is Editable
                              <input type="hidden" class="menu_checkbox_hidden" id="is_edithidden" name="is_edit" value=0>
                              <span></span>
                           </label>
                        </div>
                     </div>

                     <div class="col-lg-3" id="maction">
                        <div class="form-group m-form__group">
                           <label>Mathematic Action</label>
                           <select class="form-control custom-select" id="math_action" name="math_action" onchange="changemathtype(this.value);">
                              <option value="">Select Mathematic Action</option>
                              <option value="Addition(+)">Addition ( + )</option>
                              <option value="Subtraction(-)">Subtraction ( - )</option>
                              <option value="Multiplication(*)">Multiplication ( * )</option>
                              <option value="Division(/)">Division ( / )</option>
                              <option value="Percentage(%)">Percentage ( % )</option>
                           </select>
                           <span id="math_action_err" class="text-danger"></span>
                        </div>
                     </div>

                     <div class="col-lg-3" id="mtype">
                        <div class="form-group m-form__group">
                           <label>Math Type</label>
                           <select class="form-control m-bootstrap-select m_selectpicker" multiple id="multi_product_costing_type_id_math" name="multi_product_costing_type_id_math[]" data-live-search="true"> 
                              <option value=''>Choose</option> 
                              <?php if(count($multi_product_costing_type_list)>0){
                                 foreach($multi_product_costing_type_list as $mpctl)
                                 {?>
                                    <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>"><?php echo $mpctl['multi_product_costing_type'];?></option>
                                 <?php }
                              }?>
                           </select>
                           <span class="text-danger" id="multi_product_costing_type_id_math_err"></span>
                        </div>
                     </div>

                     <div class="col-lg-3" id="mtype_div" style="display:none;">
                        <div class="form-group m-form__group">
                           <label>Math Type</label>
                           <select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math1" name="multi_product_costing_type_id_math1" data-live-search="true"> 
                              <option value=''>Choose</option> 
                              <?php if(count($multi_product_costing_type_list)>0){
                                 foreach($multi_product_costing_type_list as $mpctl)
                                 {?>
                                    <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>"><?php echo $mpctl['multi_product_costing_type'];?></option>
                                 <?php }
                              }?>
                           </select>
                           <span class="text-danger" id="multi_product_costing_type_id_math1_err"></span>
                        </div>
                     </div>

                     <div class="col-lg-3" id="mtype_1_div" style="display:none;">
                        <div class="form-group m-form__group">
                           <label>Math Type</label>
                           <select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math_1" name="multi_product_costing_type_id_math_1" data-live-search="true"> 
                              <option value=''>Choose</option> 
                              <?php if(count($multi_product_costing_type_list)>0){
                                 foreach($multi_product_costing_type_list as $mpctl)
                                 {?>
                                    <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>"><?php echo $mpctl['multi_product_costing_type'];?></option>
                                 <?php }
                              }?>
                           </select>
                           <span class="text-danger" id="multi_product_costing_type_id_math_1_err"></span>
                        </div>
                     </div>

                     <div class="col-lg-3" id="mtype_2_div" style="display:none;">
                        <div class="form-group m-form__group">
                           <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                              <input type="checkbox" class="menu_checkbox" id="is_nop_greater" name="is_nop_greater" value="0" onchange="changePermission(this.id,this.value);"> Is No of Pack > 1 (Multiply)
                              <input type="hidden" class="menu_checkbox_hidden" id="is_nop_greaterhidden" name="is_nop_greater" value=0>
                              <span></span>
                           </label>
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
   <div class="modal fade" id="multi_product_costing_type_edit_mod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Multi Product Costing Type List';
$(document).attr("title", title); 

function changemathtype(val)
{
   if(val=='Division(/)')
   {
      $('#mtype').hide();
      $('#mtype_div').show();
      $('#mtype_1_div').show();
      $('#mtype_2_div').show();
   }
   else
   {
      $('#mtype').show();
      $('#mtype_div').hide();
      $('#mtype_1_div').hide();
      $('#mtype_2_div').hide();
   }
}


function changePermissionCheck(id,val)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;

      $('#math_action').val('');
      $('#maction').show();
      $('#multi_product_costing_type_id_math').val('');
      $('#mtype').show();
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
      $('#math_action').val('');
      $('#maction').hide();
      $('#multi_product_costing_type_id_math').val('');
      $('#mtype').hide();
   }
}


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

function multi_product_costing_type_validation()
{
   var err = 0;
   var pctype = $('#multi_product_costing_type').val();
   if(pctype == '')
   {
      $('#multi_product_costing_type_err').html('Costing Type is required!');
      err++;
   }else{
      $('#multi_product_costing_type_err').html('');
   }

   //if($('#is_edit'). is(":not(:checked)")){
      var maction = $('#math_action').val();
      var mtype = $('#multi_product_costing_type_id_math').val();
      var mtype1 = $('#multi_product_costing_type_id_math1').val();
      var mtype_1 = $('#multi_product_costing_type_id_math_1').val();
      /*if(maction == '')
      {
         $('#math_action_err').html('Mathematic Action is required!');
         err++;
      }else{
         $('#math_action_err').html('');
      }*/

      if(maction!='' && maction!='Division(/)' && mtype == '')
      {
         $('#multi_product_costing_type_id_math_err').html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_err').html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype1 == '')
      {
         $('#multi_product_costing_type_id_math1_err').html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math1_err').html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype_1 == '')
      {
         $('#multi_product_costing_type_id_math_1_err').html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_1_err').html('');
      }
   //}
   
   if(err> 0){ return false;}else{ return true; }   
}


function multi_product_costing_type_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'multiproductcostingtype/multi_product_costing_type_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#multi_product_costing_type_edit_mod').empty().append(response);
   }
   });
}



</script>
</body>
   <!-- end::Body -->
</html>