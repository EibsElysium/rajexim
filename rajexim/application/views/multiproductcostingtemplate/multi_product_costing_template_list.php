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
                              <a href="<?php echo base_url(); ?>multiproductcostingtemplate" class="m-nav__link">
                                 <span class="m-nav__link-text">Multi Product Costing Template</span>
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
                                       Multi Product Costing Template List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Multi Product Costing TypeAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#multi_create_product_costing_template">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Multi Product Costing Template</span>
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
                                    <th>Template</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($multi_product_costing_template_list))
                                    {
                                       $i = 1;
                                       foreach ($multi_product_costing_template_list as $e_list) 
                                       { 
                                          ?>
                                          <tr>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['multi_product_costing_template']; ?></h5>   
                                             </td>
                                             <td>
                                                   <?php if($_SESSION['Multi Product Costing TypeEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#multi_product_costing_template_edit_mod" onclick="return multi_product_costing_template_edit(<?php echo $e_list['multi_product_costing_template_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
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
   <div class="modal fade" id="multi_create_product_costing_template" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Multi Product Costing Type</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_multi_product_costing_template" id="create_multi_product_costing_template" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>multiproductcostingtemplate/create_multi_product_costing_template" onsubmit="return multi_product_costing_template_validation()">
               <input type="hidden" id="multi_product_costing_template_id" name="multi_product_costing_template_id">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Template<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="multi_product_costing_template" name="multi_product_costing_template" placeholder="Enter Costing Template" onkeyup="checkUniqueTemplateName();">
                           <span id="multi_product_costing_template_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>

                  <div id="mcontent10">
                     <div id="mid0">
                        <div class="row">
                           <div class="col-lg-3">
                              <div class="form-group m-form__group">
                                 <label>Costing Type<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" id="multi_product_costing_type0" name="multi_product_costing_type[]" placeholder="Enter Costing Type">
                                 <span id="multi_product_costing_type_err0" class="text-danger"></span>
                                 <input type="hidden" id="stage_no0" name="stage_no[]" value=0>
                              </div>
                           </div>

                           <div class="col-lg-3">
                              <div class="form-group m-form__group">
                                 <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                    <input type="checkbox" class="menu_checkbox" id="is_edit0" name="is_edit[]" value="0" onchange="changePermissionCheck(this.id,this.value,0);"> Is Editable
                                    <input type="hidden" class="menu_checkbox_hidden" id="is_edit0hidden" name="is_edit[]" value=0>
                                    <span></span>
                                 </label>
                              </div>
                           </div>

                           <div class="col-lg-3">
                              <div class="form-group m-form__group">
                                 <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                    <input type="checkbox" class="menu_checkbox" id="is_display0" name="is_display[]" value="0" onchange="changePermission(this.id,this.value,0);"> Is Display
                                    <input type="hidden" class="menu_checkbox_hidden" id="is_display0hidden" name="is_display[]" value=0>
                                    <span></span>
                                 </label>
                              </div>
                           </div>

                           <div class="col-lg-3" id="maction0">
                              <div class="form-group m-form__group">
                                 <label>Mathematic Action</label>
                                 <select class="form-control custom-select" id="math_action0" name="math_action[]" onchange="changemathtype(this.value,0);">
                                    <option value="">Select Mathematic Action</option>
                                    <option value="Addition(+)">Addition ( + )</option>
                                    <option value="Subtraction(-)">Subtraction ( - )</option>
                                    <option value="Multiplication(*)">Multiplication ( * )</option>
                                    <option value="Division(/)">Division ( / )</option>
                                    <option value="Percentage(%)">Percentage ( % )</option>
                                 </select>
                                 <span id="math_action_err0" class="text-danger"></span>
                              </div>
                           </div>

                           <div class="col-lg-3" id="mtype0">
                              <div class="form-group m-form__group">
                                 <label>Math Type</label>
                                 <select class="form-control m-bootstrap-select m_selectpicker" multiple id="multi_product_costing_type_id_math0" name="multi_product_costing_type_id_math[0][]" data-live-search="true"> 
                                    <option value=''>Choose</option> 
                                    <?php if(count($multi_product_costing_type_list)>0){
                                       foreach($multi_product_costing_type_list as $mpctl)
                                       {?>
                                          <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>"><?php echo $mpctl['multi_product_costing_type'];?></option>
                                       <?php }
                                    }?>
                                 </select>
                                 <span class="text-danger" id="multi_product_costing_type_id_math_err0"></span>
                              </div>
                           </div>

                           <div class="col-lg-3" id="mtype_div0" style="display:none;">
                              <div class="form-group m-form__group">
                                 <label>Math Type</label>
                                 <select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math10" name="multi_product_costing_type_id_math1[]" data-live-search="true"> 
                                    <option value=''>Choose</option> 
                                    <?php if(count($multi_product_costing_type_list)>0){
                                       foreach($multi_product_costing_type_list as $mpctl)
                                       {?>
                                          <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>"><?php echo $mpctl['multi_product_costing_type'];?></option>
                                       <?php }
                                    }?>
                                 </select>
                                 <span class="text-danger" id="multi_product_costing_type_id_math1_err0"></span>
                              </div>
                           </div>

                           <div class="col-lg-3" id="mtype_1_div0" style="display:none;">
                              <div class="form-group m-form__group">
                                 <label>Math Type</label>
                                 <select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math_10" name="multi_product_costing_type_id_math_1[]" data-live-search="true"> 
                                    <option value=''>Choose</option> 
                                    <?php if(count($multi_product_costing_type_list)>0){
                                       foreach($multi_product_costing_type_list as $mpctl)
                                       {?>
                                          <option value="<?php echo $mpctl['multi_product_costing_type_id'];?>"><?php echo $mpctl['multi_product_costing_type'];?></option>
                                       <?php }
                                    }?>
                                 </select>
                                 <span class="text-danger" id="multi_product_costing_type_id_math_1_err0"></span>
                              </div>
                           </div>

                           <div class="col-lg-3" id="mtype_2_div0" style="display:none;">
                              <div class="form-group m-form__group">
                                 <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                    <input type="checkbox" class="menu_checkbox" id="is_nop_greater0" name="is_nop_greater[]" value="0" onchange="changePermission(this.id,this.value,0);"> Is No of Pack > 1 (Multiply)
                                    <input type="hidden" class="menu_checkbox_hidden" id="is_nop_greater0hidden" name="is_nop_greater[]" value=0>
                                    <span></span>
                                 </label>
                              </div>
                           </div>

                        </div>
                        <hr>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <div class="pull-right">
                              <button type="button" class="btn btn-primary" onclick="add_pcs_type()">
                                 <i class="fa fa-plus"></i>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" id="mailcount" name="mailcount" value="1">

               </div>
               <div class="modal-footer">
                  <button type="submit" id="btnSubmit" name="gobutton" value="go" class="btn btn-primary">Create</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!-- Update exporter-->
<div class="container">
   <div class="modal fade" id="multi_product_costing_template_edit_mod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Multi Product Costing Template List';
$(document).attr("title", title); 

var expo = 0;
function checkUniqueTemplateName()
{
   var val = $('#multi_product_costing_template').val();
   $.ajax({
      type:"POST",
      url:baseurl+'multiproductcostingtemplate/checkUniqueTemplateName',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#multi_product_costing_template_err').html('Template already exists!');
            //$('#btnSubmit').prop('disabled', true);
            expo = 1;
         }
         else
         {
            $('#multi_product_costing_template_err').html('');
            //$('#btnSubmit').prop('disabled', false);
            expo = 0;
         }
      }
   });
}

function changemathtype(val,i)
{
   if(val=='Division(/)')
   {
      $('#mtype'+i).hide();
      $('#mtype_div'+i).show();
      $('#mtype_1_div'+i).show();
      $('#mtype_2_div'+i).show();
   }
   else
   {
      $('#mtype'+i).show();
      $('#mtype_div'+i).hide();
      $('#mtype_1_div'+i).hide();
      $('#mtype_2_div'+i).hide();
   }
}


function changePermissionCheck(id,val,i)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;

      $('#math_action'+i).val('');
      $('#maction'+i).show();
      $('#multi_product_costing_type_id_math'+i).val('');
      $('#mtype'+i).show();
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
      $('#math_action'+i).val('');
      $('#maction'+i).hide();
      $('#multi_product_costing_type_id_math'+i).val('');
      $('#mtype'+i).hide();
   }
}


function changePermission(id,val,i)
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

function multi_product_costing_template_validation()
{
   var err = 0;

   var mpctemp = $('#multi_product_costing_template').val();
   if(mpctemp == '')
   {
      $('#multi_product_costing_template_err').html('Template is required!');
      err++;
   }else{
      //$('#multi_product_costing_template_err').html('');
      if(expo == 1)
      {
         $('#multi_product_costing_template_err').html('Template already exists!');
         err++;
      }
      else
      {
         $('#multi_product_costing_template_err').html('');
      }
   }

   $("div[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);
      var pctype = $('#multi_product_costing_type'+res).val();
      if(pctype == '')
      {
         $('#multi_product_costing_type_err'+res).html('Costing Type is required!');
         err++;
      }else{
         $('#multi_product_costing_type_err'+res).html('');
      }
      
      var maction = $('#math_action'+res).val();
      var mtype = $('#multi_product_costing_type_id_math'+res).val();
      var mtype1 = $('#multi_product_costing_type_id_math1'+res).val();
      var mtype_1 = $('#multi_product_costing_type_id_math_1'+res).val();

      if(maction!='' && maction!='Division(/)' && mtype == '')
      {
         $('#multi_product_costing_type_id_math_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_err'+res).html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype1 == '')
      {
         $('#multi_product_costing_type_id_math1_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math1_err'+res).html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype_1 == '')
      {
         $('#multi_product_costing_type_id_math_1_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_1_err'+res).html('');
      }
   });
   
   if(err> 0){ return false;}else{ return true; }   
}



function add_pcs_type()
{
   var count=$('#mailcount').val();
   var cnt = parseInt(count)-1;
   var scount = parseInt(count)+1;

   var err = 0;
   var mpctemp = $('#multi_product_costing_template').val();
   if(mpctemp == '')
   {
      $('#multi_product_costing_template_err').html('Template is required!');
      err++;
   }else{
      //$('#multi_product_costing_template_err').html('');
      
      if(expo == 1)
      {
         $('#multi_product_costing_template_err').html('Template already exists!');
         err++;
      }
      else
      {
         $('#multi_product_costing_template_err').html('');
      }
   }

   $("div[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);
      var pctype = $('#multi_product_costing_type'+res).val();
      if(pctype == '')
      {
         $('#multi_product_costing_type_err'+res).html('Costing Type is required!');
         err++;
      }else{
         $('#multi_product_costing_type_err'+res).html('');
      }
      
      var maction = $('#math_action'+res).val();
      var mtype = $('#multi_product_costing_type_id_math'+res).val();
      var mtype1 = $('#multi_product_costing_type_id_math1'+res).val();
      var mtype_1 = $('#multi_product_costing_type_id_math_1'+res).val();

      if(maction!='' && maction!='Division(/)' && mtype == '')
      {
         $('#multi_product_costing_type_id_math_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_err'+res).html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype1 == '')
      {
         $('#multi_product_costing_type_id_math1_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math1_err'+res).html('');
      }

      if(maction!='' && maction=='Division(/)' && mtype_1 == '')
      {
         $('#multi_product_costing_type_id_math_1_err'+res).html('Math Type is required!');
         err++;
      }
      else{
         $('#multi_product_costing_type_id_math_1_err'+res).html('');
      }
   });
   
   if(err> 0){ return false;}else{ 

      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcostingtemplate/create_multi_product_costing_template',
         async: false,
         data: $('#create_multi_product_costing_template').serialize(),
         dataType: "html",
         success: function(response)
         {
            var cont = $("#mcontent10");

            var resp = response.split('|');

            $('#multi_product_costing_template_id').val(resp[1]);

            cont.append('<div id="mid'+count+'"><div class="row"><div class="col-lg-3"><div class="form-group m-form__group"><label>Costing Type<span class="text-danger">*</span></label><input type="text" class="form-control m-input m-input--square" id="multi_product_costing_type'+count+'" name="multi_product_costing_type[]" placeholder="Enter Costing Type"><span id="multi_product_costing_type_err'+count+'" class="text-danger"></span><input type="hidden" id="stage_no'+count+'" name="stage_no[]" value="'+count+'"></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px"><input type="checkbox" class="menu_checkbox" id="is_edit'+count+'" name="is_edit[]" value="0" onchange="changePermissionCheck(this.id,this.value,'+count+');"> Is Editable<input type="hidden" class="menu_checkbox_hidden" id="is_edit'+count+'hidden" name="is_edit[]" value=0><span></span></label></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px"><input type="checkbox" class="menu_checkbox" id="is_display'+count+'" name="is_display[]" value="0" onchange="changePermission(this.id,this.value,'+count+');"> Is Display<input type="hidden" class="menu_checkbox_hidden" id="is_display'+count+'hidden" name="is_display[]" value=0><span></span></label></div></div><div class="col-lg-3" id="maction'+count+'"><div class="form-group m-form__group"><label>Mathematic Action</label><select class="form-control custom-select" id="math_action'+count+'" name="math_action[]" onchange="changemathtype(this.value,'+count+');"><option value="">Select Mathematic Action</option><option value="Addition(+)">Addition ( + )</option><option value="Subtraction(-)">Subtraction ( - )</option><option value="Multiplication(*)">Multiplication ( * )</option><option value="Division(/)">Division ( / )</option><option value="Percentage(%)">Percentage ( % )</option></select><span id="math_action_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-3" id="mtype'+count+'"><div class="form-group m-form__group"><label>Math Type</label><select class="form-control m-bootstrap-select m_selectpicker" multiple id="multi_product_costing_type_id_math'+count+'" name="multi_product_costing_type_id_math['+count+'][]" data-live-search="true">'+resp[0]+'</select><span class="text-danger" id="multi_product_costing_type_id_math_err'+count+'"></span></div></div><div class="col-lg-3" id="mtype_div'+count+'" style="display:none;"><div class="form-group m-form__group"><label>Math Type</label><select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math1'+count+'" name="multi_product_costing_type_id_math1[]" data-live-search="true">'+resp[0]+'</select><span class="text-danger" id="multi_product_costing_type_id_math1_err'+count+'"></span></div></div><div class="col-lg-3" id="mtype_1_div'+count+'" style="display:none;"><div class="form-group m-form__group"><label>Math Type</label><select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_type_id_math_1'+count+'" name="multi_product_costing_type_id_math_1[]" data-live-search="true">'+resp[0]+'</select><span class="text-danger" id="multi_product_costing_type_id_math_1_err'+count+'"></span></div></div><div class="col-lg-3" id="mtype_2_div'+count+'" style="display:none;"><div class="form-group m-form__group"><label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px"><input type="checkbox" class="menu_checkbox" id="is_nop_greater'+count+'" name="is_nop_greater[]" value="0" onchange="changePermission(this.id,this.value,'+count+');"> Is No of Pack > 1 (Multiply)<input type="hidden" class="menu_checkbox_hidden" id="is_nop_greater'+count+'hidden" name="is_nop_greater[]" value=0><span></span></label></div></div></div><hr></div>');

            count=Number(count)+1;
            $('#mailcount').val(count);
            $('.m_selectpicker').selectpicker();
         }
      });

    } 
 }


function multi_product_costing_template_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'multiproductcostingtemplate/multi_product_costing_template_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#multi_product_costing_template_edit_mod').empty().append(response);
   }
   });
}



</script>
</body>
   <!-- end::Body -->
</html>