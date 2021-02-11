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
                              <a href="<?php echo base_url(); ?>multiproductcostingtypeproduct" class="m-nav__link">
                                 <span class="m-nav__link-text">Multi Product Costing Type - P</span>
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
                                       Multi Product Costing Type - P List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Multi Product Costing Type - PAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_multi_product_costing_type_product">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Multi Product Costing Type - P</span>
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
                                    <th>Multi Product Costing Type - P</th>
                                    <th>Math Action</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($multiproductcostingtypeproduct_list))
                                    {
                                       $i = 1;
                                       foreach ($multiproductcostingtypeproduct_list as $e_list) 
                                       { 
                                          ?>
                                          <tr>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['multi_product_costing_type_product']; ?></h5>   
                                             </td>
                                             <td><?php echo $e_list['math_action']; ?></td>
                                             <td>
                                                   <?php if($_SESSION['Multi Product Costing Type - PEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#multi_product_costing_type_product_edit" onclick="return multi_product_costing_type_product_edit(<?php echo $e_list['multi_product_costing_type_product_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
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
   <div class="modal fade" id="create_multi_product_costing_type_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Multi Product Costing Type - P</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form name="create_cont" id="create_cont" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>multiproductcostingtypeproduct/create_multi_product_costing_type_product" onsubmit="return multi_product_costing_type_product_validation()">
               <div class="modal-body">
                  <div class="row">

                     <div class="col-lg-6">
                        <div class="form-group m-form__group">
                           <label>Multi Product Costing Type - P<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" id="multi_product_costing_type_product" name="multi_product_costing_type_product" placeholder="Enter Multi Product Costing Type - P">
                           <span id="multi_product_costing_type_product_err" class="text-danger"></span>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group m-form__group">
                           <label>Mathematic Action</label>
                           <select class="form-control custom-select" id="math_action" name="math_action" onchange="changemathtype(this.value);">
                              <option value="">Select Mathematic Action</option>
                              <option value="Addition(+)">Addition ( + )</option>
                              <option value="Subtraction(-)">Subtraction ( - )</option>
                              <option value="Multiplication(*)">Multiplication ( * )</option>
                              <option value="Division(/)">Division ( / )</option>
                           </select>
                           <span id="math_action_err" class="text-danger"></span>
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
   <div class="modal fade" id="multi_product_costing_type_product_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Multi Product Costing Type - P List';
$(document).attr("title", title); 


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

function multi_product_costing_type_product_validation()
{
   var err = 0;
   var cname = $('#multi_product_costing_type_product').val();
   var micbm = $('#math_action').val();
   var mxcbm = $('#max_cbm').val();
   var mxton = $('#max_ton').val();
   if(cname == '')
   {
      $('#multi_product_costing_type_product_err').html('Multi Product Costing Type - P is required!');
      err++;
   }else{
         $('#multi_product_costing_type_product_err').html('');
   }
   if(micbm == '')
   {
      $('#math_action_err').html('Math Action is required!');
      err++;
   }else{
      $('#math_action_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

function multi_product_costing_type_product_edit_validation()
{
   var err = 0;
   var cname = $('#multi_product_costing_type_product_edit_col').val();
   var micbm = $('#math_action_edit').val();
   var mxcbm = $('#max_cbm_edit').val();
   var mxton = $('#max_ton_edit').val();
   if(cname == '')
   {
      $('#multi_product_costing_type_product_edit_err').html('Multi Product Costing Type - P is required!');
      err++;
   }else{
         $('#multi_product_costing_type_product_edit_err').html('');
   }
   if(micbm == '')
   {
      $('#math_action_edit_err').html('Math Action is required!');
      err++;
   }else{
      $('#math_action_edit_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}


function multi_product_costing_type_product_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'multiproductcostingtypeproduct/multi_product_costing_type_product_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#multi_product_costing_type_product_edit').empty().append(response);
   }
   });
}



</script>
</body>
   <!-- end::Body -->
</html>