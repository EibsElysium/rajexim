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
                              <a href="<?php echo base_url(); ?>productcostingtype" class="m-nav__link">
                                 <span class="m-nav__link-text">Product Costing Type</span>
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
                                       Product Costing Type List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Product Costing TypeAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_product_costing_type">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Costing Type</span>
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
                                    <th>Costing Category</th>
                                    <th>Is Percent / Division</th>
                                    <th>Mathematic Action</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($product_costing_type_list))
                                    {
                                       $i = 1;
                                       foreach ($product_costing_type_list as $e_list) 
                                       { 
                                          if($e_list['is_percent']!=0)
                                          {
                                             if($e_list['is_percent']==1)
                                                $percent = 'Percent';
                                             else
                                                $percent = 'Division';
                                          }
                                          else
                                          {
                                             $percent = 'No';
                                          }
                                          ?>
                                          <tr>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['product_costing_type']; ?></h5>   
                                             </td>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['product_costing_category_name']; ?></h5>   
                                             </td>
                                             <td><?php echo $percent;?></td>
                                             <td><?php echo $e_list['math_action']; ?></td>
                                             <td>
                                                   <?php if($_SESSION['Product Costing TypeEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#product_costing_type_edit" onclick="return product_costing_type_edit(<?php echo $e_list['product_costing_type_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
                                                   <?php }?>
                                                   <?php //if($_SESSION['Product Costing CategoryDelete']==1){ ?>                                              
                                                   <!-- <a href="javascript:;" data-toggle="modal" data-target="#product_costing_category_delete" onclick="return product_costing_category_delete(<?php //echo $e_list['product_costing_category_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a> -->
                                                   <?php //}?>
                                                
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
   <div class="modal fade" id="create_product_costing_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Product Costing Type</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>productcostingtype/create_product_costing_type" onsubmit="return product_costing_type_validation()">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group m-form__group">
                           <label>Costing Category<span class="text-danger">*</span></label>
                           <select class="form-control m-bootstrap-select m_selectpicker" id="product_costing_category_id" name="product_costing_category_id" data-live-search="true" onchange="getTypePCC(this.value);">
                              <option value=''>Select Costing Category</option>
                              <?php foreach($product_costing_category_list as $pclist){?>
                                 <option value="<?php echo $pclist['product_costing_category_id'];?>"><?php echo $pclist['product_costing_category_name'];?></option>
                              <?php }?>
                           </select>
                           <span id="product_costing_category_id_err" class="text-danger"></span>
                        </div>
                     </div>

                     <div class="col-lg-2">
                        <div class="form-group m-form__group">
                           <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                              <input type="checkbox" class="menu_checkbox" id="is_edit" name="is_edit" value="0" onchange="changePermissionCheck(this.id,this.value);"> Is Editable
                              <input type="hidden" class="menu_checkbox_hidden" id="is_edithidden" name="is_edit" value=0>
                              <span></span>
                           </label>
                        </div>
                     </div>

                     <div class="col-lg-2">
                        <div class="form-group m-form__group">
                           <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                              <input type="checkbox" class="menu_checkbox" id="is_default" name="is_default" value="1" checked onchange="changePermissionCheck(this.id,this.value);"> is Default
                              <input type="hidden" class="menu_checkbox_hidden" id="is_defaulthidden" name="is_default" value=0 disabled>
                              <span></span>
                           </label>
                        </div>
                     </div>

                     <div class="col-lg-2">
                        <div class="form-group m-form__group">
                           <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                              <input type="checkbox" class="menu_checkbox" id="is_input" name="is_input" value="1" checked onchange="changePermissionCheck(this.id,this.value);"> is Input
                              <input type="hidden" class="menu_checkbox_hidden" id="is_inputhidden" name="is_input" value=0 disabled>
                              <span></span>
                           </label>
                        </div>
                     </div>

                  </div>
                  <input type="hidden" id="locprod">
                  <div id="mcontent10">
                     <div class="row" id="mid0">
                        <div class="col-lg-3">
                           <div class="form-group m-form__group">
                              <label>Costing Type<span class="text-danger">*</span></label>
                              <input type="text" class="form-control m-input m-input--square" id="product_costing_type0" name="product_costing_type[]" placeholder="Enter Costing Type">
                              <span id="product_costing_type_err0" class="text-danger"></span>
                           </div>
                        </div>
                        <div class="col-lg-2">
                           <!-- <div class="form-group m-form__group mt_25px">
                              <label class="m-checkbox m-checkbox--bold m-checkbox--state-success" style="margin-top: 10px;">
                                 <input type="checkbox" class="menu_checkbox" id="is_percent0" name="is_percent[]" value=0 onchange="changePermission(this.id,this.value,0);"> is % 
                                 <input type="hidden" class="menu_checkbox_hidden" id="is_percent0hidden" name="is_percent[]" value=0>
                                 <span></span>
                              </label>
                           </div> -->
                           <div class="form-group m-form__group">
                              <label>Is % or /</label>
                              <select class="form-control custom-select" id="is_percent0" name="is_percent[]" onchange="changePermission(this.value,0);">
                                 <option value="0">Select</option>
                                 <option value="1">%</option>
                                 <option value="2">/</option>
                              </select>
                           </div>
                        </div>                        
                        <div class="col-lg-3" id="ptcc0" style="display:none">
                           <div class="form-group m-form__group">
                              <label>Type Costing Category<span class="text-danger">*</span></label>
                              <select class="form-control custom-select tcc" id="type_costing_category0" name="type_costing_category[]">
                              </select>
                              <span id="type_costing_category_err0" class="text-danger"></span>
                           </div>
                        </div>
                        <div class="col-lg-3">
                           <div class="form-group m-form__group">
                              <label>Mathematic Action<span class="text-danger">*</span></label>
                              <select class="form-control custom-select" id="math_action0" name="math_action[]">
                                 <option value="">Select Mathematic Action</option>
                                 <option value="Addition(+)">Addition ( + )</option>
                                 <option value="Subtraction(-)">Subtraction ( - )</option>
                                 <option value="Multiplication(*)">Multiplication ( * )</option>
                                 <option value="Division(/)">Division ( / )</option>
                              </select>
                              <span id="math_action_err0" class="text-danger"></span>
                           </div>
                        </div>
                     </div>
                  </div>                    

                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <div class="pull-right">
                              <button type="button" class="btn btn-primary" onclick="add_pc_type(0)">
                                 <i class="fa fa-plus"></i>
                              </button>
                           </div>
                        </div>
                     </div> 
                  </div>
                  <input type="hidden" id="mailcount" name="mailcount" value="1">
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
   <div class="modal fade" id="product_costing_type_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="product_costing_category_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Product Costing Type List';
$(document).attr("title", title); 



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

/*function changePermission(id,val,i)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;
      $('#ptcc'+i).hide();
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
      $('#ptcc'+i).show();
   }
}*/  
function changePermission(val,i)
{
   if(val==0)
   {
      //$('#'+id).val(0);
      //document.getElementById(id+'hidden').disabled = false;
      $('#ptcc'+i).hide();
   }
   else
   {
      //$('#'+id).val(1);
      //document.getElementById(id+'hidden').disabled = true;
      $('#ptcc'+i).show();
   }
}

function add_pc_type()
{
   var count=$('#mailcount').val();
   var cont = $("#mcontent10");
   var locprod = $('#locprod').val();
   
   /*cont.append('<div class="row" id="mid'+count+'"><div class="col-lg-3"><div class="form-group m-form__group"><label>Costing Type<span class="text-danger">*</span></label><input type="text" class="form-control m-input m-input--square" id="product_costing_type'+count+'" name="product_costing_type[]" placeholder="Enter Costing Type"><span id="product_costing_type_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group mt_25px"><label class="m-checkbox m-checkbox--bold m-checkbox--state-success" style="margin-top: 10px;"><input type="checkbox" class="menu_checkbox" id="is_percent'+count+'" name="is_percent[]" value=0 onchange="changePermission(this.id,this.value,'+count+');"> is %<input type="hidden" class="menu_checkbox_hidden" id="is_percent'+count+'hidden" name="is_percent[]" value=0><span></span></label></div></div><div class="col-lg-3" id="ptcc'+count+'" style="display:none"><div class="form-group m-form__group"><label>Type Costing Category<span class="text-danger">*</span></label><select class="form-control custom-select tcc" id="type_costing_category'+count+'" name="type_costing_category[]">'+locprod+'</select><span id="type_costing_category_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Mathematic Action<span class="text-danger">*</span></label><select class="form-control custom-select" id="math_action'+count+'" name="math_action[]"><option value="">Select Mathematic Action</option><option value="Addition(+)">Addition ( + )</option><option value="Subtraction(-)">Subtraction ( - )</option><option value="Multiplication(*)">Multiplication ( * )</option><option value="Division(/)">Division ( / )</option></select><span id="math_action_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-1"><div class="pull-right"><div class="form-group m-form__group mt_25px"><button class="btn btn-danger" onclick="remove_pc_type('+count+')"><i class="fa fa-minus"></i></button></div></div></div></div>');*/
   cont.append('<div class="row" id="mid'+count+'"><div class="col-lg-3"><div class="form-group m-form__group"><label>Costing Type<span class="text-danger">*</span></label><input type="text" class="form-control m-input m-input--square" id="product_costing_type'+count+'" name="product_costing_type[]" placeholder="Enter Costing Type"><span id="product_costing_type_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group"><label>Is % or /</label><select class="form-control custom-select" id="is_percent'+count+'" name="is_percent[]" onchange="changePermission(this.value,'+count+');"><option value="0">Select</option><option value="1">%</option><option value="2">/</option></select></div></div><div class="col-lg-3" id="ptcc'+count+'" style="display:none"><div class="form-group m-form__group"><label>Type Costing Category<span class="text-danger">*</span></label><select class="form-control custom-select tcc" id="type_costing_category'+count+'" name="type_costing_category[]">'+locprod+'</select><span id="type_costing_category_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-3"><div class="form-group m-form__group"><label>Mathematic Action<span class="text-danger">*</span></label><select class="form-control custom-select" id="math_action'+count+'" name="math_action[]"><option value="">Select Mathematic Action</option><option value="Addition(+)">Addition ( + )</option><option value="Subtraction(-)">Subtraction ( - )</option><option value="Multiplication(*)">Multiplication ( * )</option><option value="Division(/)">Division ( / )</option></select><span id="math_action_err'+count+'" class="text-danger"></span></div></div><div class="col-lg-1"><div class="pull-right"><div class="form-group m-form__group mt_25px"><button class="btn btn-danger" onclick="remove_pc_type('+count+')"><i class="fa fa-minus"></i></button></div></div></div></div>');

   count=Number(count)+1;
   $('#mailcount').val(count);

}

function remove_pc_type(val)
{
   $('#mid'+val).remove();

}

function product_costing_type_validation()
{
   var err = 0;
   var pccid = $('#product_costing_category_id').val();
   if(pccid == '')
   {
      $('#product_costing_category_id_err').html('Costing Category is required!');
      err++;
   }else{
      $('#product_costing_category_id_err').html('');
   }

   var bav=0
   $("div[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);
      var pctype=$('#product_costing_type'+res).val();
      var maction=$('#math_action'+res).val();
      var ispercent = $('#is_percent'+res).val();

      if(bav==0)  
      {
         if(pctype == '')
         {
            $('#product_costing_type_err'+res).html('Costing Type is required!');
            err++;
         }else{
            $('#product_costing_type_err'+res).html('');
         }

         if(ispercent!=0)
         {
            var tcc = $('#type_costing_category'+res).val();
            if(tcc == '')
            {
               $('#type_costing_category_err'+res).html('Category is required!');
               err++;
            }else{
               $('#type_costing_category_err'+res).html('');
            }
         }

         if(maction == '')
         {
            $('#math_action_err'+res).html('Mathematic Action is required!');
            err++;
         }else{
            $('#math_action_err'+res).html('');
         }
      }
      else
      {
         if(pctype!='' && ispercent)
         {
            var tcc = $('#type_costing_category'+res).val();
            if(tcc == '')
            {
               $('#type_costing_category_err'+res).html('Category is required!');
               err++;
            }else{
               $('#type_costing_category_err'+res).html('');
            }
         }

         if(pctype!='' && maction == '')
         {
            $('#math_action_err'+res).html('Mathematic Action is required!');
            err++;
         }else{
            $('#math_action_err'+res).html('');
         }
      }
      bav++;
  });
   
   if(err> 0){ return false;}else{ return true; }   
}


function product_costing_type_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'productcostingtype/product_costing_type_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#product_costing_type_edit').empty().append(response);
   }
   });
}

function getTypePCC(val)
{
   if(val!='')
   {
      $.ajax({
           type: "POST",
           url: baseurl+'productcostingtype/getTypePCC',
           async: false,
           type: "POST",
           data: "id="+val,
           dataType: "html",
           success: function(response)
           {
               $('.tcc').empty().append(response);
               $('#locprod').val(response);
           }
       });
   }
}



</script>
</body>
   <!-- end::Body -->
</html>