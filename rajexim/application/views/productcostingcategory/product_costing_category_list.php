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
                              <a href="<?php echo base_url(); ?>productcostingcategory" class="m-nav__link">
                                 <span class="m-nav__link-text">Product Costing Category</span>
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
                                       Product Costing Category List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Product Costing CategoryAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_product_costing_category">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Costing Category</span>
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
                                    <th>Costing Category</th>
                                    <th>Parent Costing Category</th>
                                    <th>Mathematic Action</th>
                                    <th class="notexport" data-orderable="false">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($product_costing_category_list))
                                    {
                                       $i = 1;
                                       foreach ($product_costing_category_list as $e_list) 
                                       { 
                                          if($e_list['parent_product_costing_category_id']!=0)
                                          {
                                             $parentpcc = $this->Productcostingcategory_model->get_product_costing_category_by_id($e_list['parent_product_costing_category_id']);
                                             $ppcc = $parentpcc->product_costing_category_name;
                                             $maction = $e_list['math_action'];
                                          }
                                          else
                                          {
                                             $ppcc = '-';
                                             $maction = '-';
                                          }
                                          ?>
                                          <tr>
                                             <td>
                                                <h5 class="text-black"><?php echo $e_list['product_costing_category_name']; ?></h5>   
                                             </td>
                                             <td><?php echo $ppcc;?></td>
                                             <td><?php echo $maction; ?></td>
                                             <td>
                                                   <?php if($_SESSION['Product Costing CategoryEdit']==1){ ?>
                                                   <a href="javascript:;" data-toggle="modal" data-target="#product_costing_category_edit" onclick="return product_costing_category_edit(<?php echo $e_list['product_costing_category_id']; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
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
   <div class="modal fade" id="create_product_costing_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Product Costing Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>productcostingcategory/create_product_costing_category" onsubmit="return product_costing_category_validation()">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Costing Category<span class="text-danger">*</span></label>
                              <input type="text" class="form-control m-input m-input--square" placeholder="Enter Costing Category" id="product_costing_category_name" name="product_costing_category_name" onkeyup="checkUniqueProductCostingCategory();">
                              <span id="product_costing_category_name_err" class="text-danger"></span>
                           </div>
                        </div>                           
                     </div>
                     <input type="hidden" id="listcount" name="listcount" value="<?php echo count($product_costing_category_list);?>">
                     <?php if(count($product_costing_category_list)>0){?>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Parent Costing Category<span class="text-danger">*</span></label>
                              <select class="form-control m-bootstrap-select m_selectpicker" id="parent_product_costing_category_id" name="parent_product_costing_category_id" data-live-search="true">
                                 <option value=''>Select Parent Costing Category</option>
                                 <?php foreach($product_costing_category_list as $pclist){?>
                                    <option value="<?php echo $pclist['product_costing_category_id'];?>"><?php echo $pclist['product_costing_category_name'];?></option>
                                 <?php }?>
                              </select>
                              <span id="parent_product_costing_category_id_err" class="text-danger"></span>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <label>Mathematic Action<span class="text-danger">*</span></label>
                              <select class="form-control custom-select" id="math_action" name="math_action">
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
                     <?php }?>
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
   <div class="modal fade" id="product_costing_category_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<!-- Drop Lead-->
<div class="container">
   <div class="modal fade" id="product_costing_category_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Product Costing Category List';
$(document).attr("title", title); 

var expo = 0;
function checkUniqueProductCostingCategory()
{
   var val = $('#product_costing_category_name').val();
   $.ajax({
      type:"POST",
      url:baseurl+'productcostingcategory/checkUniqueProductCostingCategory',
      data:{'value':val},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#product_costing_category_name_err').html('Costing Category already exists!');
            $('#btnSubmit').prop('disabled', true);
            expo = 1;
         }
         else
         {
            $('#product_costing_category_name_err').html('');
            $('#btnSubmit').prop('disabled', false);
            expo = 0;
         }
      }
   });
}


function product_costing_category_validation()
{
   var err = 0;
   var lcount = $('#listcount').val();
   var name = $('#product_costing_category_name').val();
   if(name == '')
   {
      $('#product_costing_category_name_err').html('Costing Category is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#product_costing_category_name_err').html('Costing Category already exists!');
         err++;
      }
      else
      {
         $('#product_costing_category_name_err').html('');
      }
   }

   if(lcount>0)
   {
      var ppccid = $('#parent_product_costing_category_id').val()
      var maction = $('#math_action').val();
      /*if(ppccid=='')
      {
         $('#parent_product_costing_category_id_err').html('Parent Product Costing Category is required!');
         err++;
      }
      else
      {
         $('#parent_product_costing_category_id_err').html('');
      }*/

      if(ppccid!='' && maction=='')
      {
         $('#math_action_err').html('Mathematic Action is required!');
         err++;
      }
      else
      {
         $('#math_action_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}


function product_costing_category_edit(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'productcostingcategory/product_costing_category_edit',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#product_costing_category_edit').empty().append(response);
   }
   });
}



</script>
</body>
   <!-- end::Body -->
</html>