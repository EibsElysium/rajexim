<?php $this->load->view('common_header'); ?>
       <link href="<?php echo base_url();?>assets/mailbox/js/summernote/summernote.css" rel="stylesheet">
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
							<span class="m-nav__link-text">Product Settings</span>
						</a>
					</li>
					<li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
					<li class="m-nav__item">
						<a href="javascript:;" class="m-nav__link">
							<span class="m-nav__link-text">Costing Template List</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>	
		<div class="m-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Costing Template List
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<?php if($_SESSION['Product Item ListView']==1) { ?>
										 <li class="m-portlet__nav-item">
	                                       <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_prd_item">
	                                          <span>
	                                             <i class="la la-plus"></i>
	                                             <span>Create Costing Template</span>
	                                          </span>
	                                       </a>
	                                    </li>
	                                	<?php } ?>
										<li class="m-portlet__nav-item"></li>
										<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
											<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
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
																	<a href="#" class="m-nav__link" id="export_print">
																		<i class="m-nav__link-icon la la-print"></i>
																		<span class="m-nav__link-text">Print</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#" class="m-nav__link" id="export_copy">
																		<i class="m-nav__link-icon la la-copy"></i>
																		<span class="m-nav__link-text">Copy</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#" class="m-nav__link" id="export_excel">
																		<i class="m-nav__link-icon la la-file-excel-o"></i>
																		<span class="m-nav__link-text">Excel</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#" class="m-nav__link" id="export_csv">
																		<i class="m-nav__link-icon la la-file-text-o"></i>
																		<span class="m-nav__link-text">CSV</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#" class="m-nav__link" id="export_pdf">
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
							<?php if($this->session->flashdata('prd_item_success')){?>
			                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										</button>
										<?php echo $this->session->flashdata('prd_item_success'); ?>
									</div>
					            <?php } ?>

								<?php if($this->session->flashdata('prd_item_err')){?>
				                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										</button>
										<?php echo $this->session->flashdata('prd_item_err'); ?>
									</div>
					            <?php } ?>	

								<div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									</button>
									Product Item activated successfully.
								</div>

								<div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									</button>
									Product Item deactivated successfully.
								</div>
							<div class="m-portlet__body">
								
								<!--begin: Datatable -->
								<table class="table table-striped table-bordered table-hover table-checkable" id="m_table_2">
									<thead>
										<tr>
											<th>Container</th>
											<th>Costing Template</th>
											<th>Product</th>
		                                    <th>Industry</th>
		                                    <th>Status</th>
		                                    <th class="notexport" data-orderable="false">Action</th>
		                                 </tr>
									</thead>
									<tbody>
										<?php
										$i = 1; 
										if(!empty($product_item_lists))
										{
											foreach ($product_item_lists as $product_item_list ) { 
												$product_costing_stage = $this->Product_model->get_product_costing_stage_by_piid($product_item_list->product_item_id);
												if(count($product_costing_stage)>0)
												{
													$clr = 'text-green';
												}
												else
												{
													$clr = 'text-danger';
												}
												?>
											<tr>
												<td><?php echo $product_item_list->container_name;?></td>
												<td><?php echo $product_item_list->product_item; ?></td>
												<td><?php echo $product_item_list->product_name; ?></td>
												<td><?php echo $product_item_list->industry_name; ?></td>
												<td>
													<span class="m-switch m-switch--sm m-switch--success" title=<?php if($product_item_list->status==0){echo "Active";} else{echo "Inactive";} ?>>
														<label>
															<input type="checkbox" <?php if($product_item_list->status==0){echo "checked";} ?> id="activeunactive_<?php echo $i;?>"  name="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $product_item_list->product_item_id; ?>,<?php echo $i; ?>)" value="<?php echo $product_item_list->status;?>"  data-plugin="switchery" data-color="#3f3e6a" data-size="small">
															<span></span>
														</label>
													</span>
												</td>
												<td>
													<?php if($_SESSION['Product Item ListEdit']==1) { ?>
													<a href="javascript:;" data-toggle="m-tooltip" data-placement="top" title="Edit"><span onclick="product_item_edit(<?php echo $product_item_list->product_item_id; ?>)" class="tooltip-animation"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
													<?php } ?>
													<?php if($_SESSION['Product Item ListDelete']==1) { ?>
													<a href="#" onclick="return product_item_delete(<?php echo $product_item_list->product_item_id; ?>)" data-toggle="m-tooltip" data-placement="top" title="Delete"><span class="tooltip-animation"><i class="fa fa-trash-alt"></i></span></a>&nbsp;&nbsp;
													<?php } ?>
													<a href="javascript:;" data-toggle="modal" data-target="#product_staging"  onclick="return product_staging(<?php echo $product_item_list->product_item_id; ?>);"><span class="tooltip-animation <?php echo $clr;?>" data-toggle="m-tooltip" data-placement="top" title="Staging"><i class="fa fa-layer-group"></i></span></a>
													<?php if($_SESSION['Product Item ListView']==1) { ?>
													<a href="javascript:;" data-toggle="modal" data-target="#display_name"  onclick="return display_name(<?php echo $product_item_list->product_item_id; ?>);"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Display Name"><i class="fa fa-info-circle"></i></span></a>
													<?php } ?>
												</td>
											</tr>
										<?php  $i++; } } ?>
									</tbody>
								</table>
							</div>
					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>

<div class="container">
   <div class="modal fade" id="product_staging" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>

<div class="container">
   <div class="modal fade" id="display_name" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
			<!-- end:: Body -->
<!--begin::Create Industry-->
<div class="container">
   <div class="modal fade" id="create_prd_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Costing Template</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            
            <form  name="prd_item_form" id="prd_item_form" method="POST" action="<?php echo base_url(); ?>Products/product_item_save" 
            	onsubmit="return product_item_validation();">
	            <div class="modal-body">

	            	 <div class="row">
	                     <div class="col-lg-12">
	                        <div class="form-group m-form__group">
	                           <label>Product Name<span class="text-danger">*</span></label>
	                           <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="product_name" id="product_name" onchange="prd_industry(this.value);"> 
	                           	<option value="">Choose</option>
	                           	<?php
	                           		if(!empty($product_lists))
	                           		{
	                           			foreach ($product_lists as $product_list) { ?>
	                           				<option value="<?php echo $product_list->product_id; ?>"><?php echo $product_list->product_name; ?></option>
	                           			<?php }
	                           		}
	                           	?>
	                           </select>
	                           <span class="text-danger" id="product_name_err"></span>
	                        </div>
	                     </div>
	               </div>
	                <div class="row">
	                     <div class="col-lg-12">
	                        <div class="form-group m-form__group">
	                           <label>Industry</label>
	                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Industry" id="industry_name" name="industry_name" maxlength="60" autocomplete="off" readonly> 
		                       <input type="hidden" class="form-control m-input m-input--square" placeholder="Enter Industry" id="industry_id" name="industry_id" maxlength="60" autocomplete="off" readonly> 
	                        </div>
	                     </div>
	               </div>

	            	<div class="prd_dynamic">
		               <div class="row" id="prd_dynamic_cont_id_0">
		                     <div class="col-lg-12">
		                        <div class="form-group m-form__group">
		                           <label>Container<span class="text-danger">*</span></label>
		                           <select class="form-control m-bootstrap-select m_selectpicker" id="cont_0" name="product_item_cont[]" data-live-search="true"> 
                                       <?php $contoption = '<option value="">Select Container</option>';?>
                                       <option value="">Select Container</option>
                                       <?php foreach ($container_list as $value) { ?>
                                          <option value="<?php echo $value['container_id']; ?>"><?php echo $value['container_name'];?></option>
                                          <?php $contoption.='<option value="'.$value['container_id'].'">'.$value['container_name'].'</option>';
                                       } ?>
                                    </select> 
		                           <span class="text-danger" id="prd_item_cont_err_0"></span>
		                        </div>
		                     </div>
		               </div>
		               <div class="row" id="prd_dynamic_id_0">
		                     <div class="col-lg-12">
		                        <div class="form-group m-form__group">
		                           <label>Costing Template<span class="text-danger">*</span></label>
		                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Costing Template" id="prd_item_0" name="product_item[]" maxlength="60" autocomplete="off" onblur="product_item_unique(this.value, 0);"> 
		                           <span class="text-danger" id="prd_item_err_0"></span>
		                        </div>
		                     </div>
		               </div>
		               <div class="row" id="prd_dynamic_spec_id_0">
		                     <div class="col-lg-12">
		                        <div class="form-group m-form__group">
		                           <label>Product Specification</label>
		                           <!-- <input type="text" class="form-control m-input m-input--square" placeholder="Enter Costing Template Spec" id="prd_item_spec_0" name="product_item_spec[]" autocomplete="off">  -->
		                           <textarea class="form-control snote" placeholder="Enter Costing Template Spec" id="prd_item_spec_0" name="product_item_spec[]"></textarea>
		                           <span class="text-danger" id="prd_item_spec_err_0"></span>
		                        </div>
		                     </div>
		               </div>
	           		</div>

	               <div class="row">
	                  <div class="col-lg-12">
	                     <div class="pull-right">
	                        <div class="form-group m-form__group mt_25px">
	                          <button type="button" class="btn btn-primary"><i class="fa fa-plus" onclick="product_add_row();"></i></button>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	               <input type="hidden" name="prd_dynamic_val" id="prd_dynamic_val" value="1">
	            </div>
	            <div class="modal-footer">
	               <button type="submit" class="btn btn-primary">Create</button>
	              
	            </div>
        	</form>

         </div>
      </div>
   </div>
</div>
<!--End::-->
<div class="container">
	<div class="modal fade" id="prd_item_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
	</div>
</div>

<!--begin::Modal-->
<div class="container">
   <div class="modal fade" id="delete_prd_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
         	<form action="<?php echo base_url(); ?>Products/product_item_delete" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Costing Template</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Delete this Costing Template Permanently?</p>
            </div>
            <input type="hidden" name="prd_item_id" id="prditem_id" value="">
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Yes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--end::Modal-->
	<!-- begin::Footer -->
	<?php $this->load->view('common_footer'); ?>

	<!-- end::Footer -->
	</div>
		<!-- end:: Page -->
		<!--begin::Global Theme Bundle -->
<script>

var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Costing Template List';
$(document).attr("title", title);

$('.snote').summernote();

function product_staging(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'products/product_staging',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#product_staging').empty().append(response);
   }
   });
}

function display_name(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'products/display_name',
   async: false,
   data: "value="+val,
   dataType: "html",
   success: function(response)
   {
   $('#display_name').empty().append(response);
   }
   });
}




function display_name_validation()
{
   var err = 0;
   $("div[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);
      var dname = $('#display_name'+res).val();

      if(dname == '')
      {
         $('#display_name_err'+res).html('Display Name is required!');
         err++;
      }else{
         $('#display_name_err'+res).html('');
      }

   });
   
   if(err> 0){ return false;}else{ return true;}
}

function add_dpcs_type()
{
   var count=$('#mailcount').val();
   var cont = $("#mcontent10");

   cont.append('<div id="mid'+count+'"><div class="row"><div class="col-lg-10"><div class="form-group m-form__group"><label>Display Name<span class="text-danger">*</span></label><input type="text" name="display_name[]" id="display_name'+count+'" class="form-control" placeholder="Enter Display Name"><span class="text-danger" id="display_name_err'+count+'"></span></div></div><div class="col-lg-2"><div class="pull-right"><div class="form-group m-form__group mt_25px"><button type="button" onclick="remove_dprd_item('+count+');" class="btn btn-danger" ><i class="fa fa-minus"></i></button></div></div></div></div></div>');

   count=Number(count)+1;
   $('#mailcount').val(count);   

} 

function remove_dprd_item(val)
{
   $('#mid'+val).remove();
}

function prd_industry(prd)
{
	$.ajax({
		type:"POST",
		url:baseurl+'Products/industry_by_product_id',
		data:{'prd':prd},
		cache: false,
		dataType: "html",
			success: function(result){

			if(result)
			{
				var indus_val = result.split('|');

				$('#industry_id').val(indus_val[0]);
				$('#industry_name').val(indus_val[1]);
				
			}
			else
			{
				$('#industry_id').val();
				$('#industry_name').val();
				
			}
		}
	});
}
var prd_item_er = 0;
function product_item_unique(val, v)
{
	var product_name = $("#product_name").val();
	var value = $("#prd_item_"+v).val();
	var alreadyprod = 0;
	var prod = $('input[id^="prd_item"]').length; 
	if(value != '')
	{
		for(var i=0;i<prod;i++)
		{
		    var prodval = $("#prd_item_"+i).val();
		    if(v!=i && value == prodval)
		    {
		        alreadyprod++;
		    }
		}
		if(alreadyprod > 0)
		{
			$("#prd_item_"+v).val('');
		    alert("Costing Template already entered!");
		}else{
			    $.ajax({
				type:"POST",
				url:baseurl+'Products/product_item_unique',
				data:{'value':val, 'product_name':product_name},
				cache: false,
				dataType: "html",
					success: function(result){
					if(result > 0)
					{
						$('#prd_item_err_'+v).html('Costing Template already exists!');
						prd_item_er++;
					}
					else
					{
						$('#prd_item_err_'+v).html('');
						
					}
				}
			});
		}
	}
}
function product_add_row()
{
  var prd_dynamic_val = $('#prd_dynamic_val').val();
  var prd_dynamic = $('.prd_dynamic');
  var contlist = '<?php echo $contoption;?>';

  prd_dynamic.append('<div class="row" id="prd_dynamic_cont_id_'+prd_dynamic_val+'"><div class="col-lg-10"><div class="form-group m-form__group"><label>Container<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="cont_'+prd_dynamic_val+'" name="product_item_cont[]" data-live-search="true">'+contlist+'</select><span class="text-danger" id="prd_item_cont_err_'+prd_dynamic_val+'"></span></div></div></div><div class="row" id="prd_dynamic_id_'+prd_dynamic_val+'"><div class="col-lg-10"><div class="class="form-group m-form__group"><label>Costing Template<span class="text-danger">*</span></label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Costing Template" id="prd_item_'+prd_dynamic_val+'" name="product_item[]" maxlength="60" autocomplete="off" onblur="product_item_unique(this.value, '+prd_dynamic_val+');"><span class="text-danger" id="prd_item_err_'+prd_dynamic_val+'"></span></div></div></div><div class="row" id="prd_dynamic_spec_id_'+prd_dynamic_val+'"><div class="col-lg-10"><div class="form-group m-form__group"><label>Product Specification</label><textarea class="form-control snote" placeholder="Enter Costing Template Spec" id="prd_item_spec_'+prd_dynamic_val+'" name="product_item_spec[]"></textarea><span class="text-danger" id="prd_item_spec_err_'+prd_dynamic_val+'"></span></div></div><div class="col-lg-2"><div class="pull-right"> <div class="form-group m-form__group mt_25px"> <button type="button" onclick="remove_prd_item(prd_dynamic_id_'+prd_dynamic_val+','+prd_dynamic_val+');" class="btn btn-danger" ><i class="fa fa-minus"></i></button></div> </div> </div> </div></div>');

  prd_dynamic_val = Number(prd_dynamic_val)+1;
  $('#prd_dynamic_val').val(prd_dynamic_val);
  $('.m_selectpicker').selectpicker('refresh');
  $('.snote').summernote();
}
function remove_prd_item(id,val)
{
  $(id).remove();
  $('#prd_dynamic_spec_id_'+val).remove();
  $('#prd_dynamic_cont_id_'+val).remove();
}

function activeunactive(val,ival) 
{
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
         url:baseurl+'Products/product_item_status_change',
         data:datastring,
         cache: false,
         dataType: "html",
         success: function(result){
             if(unactive == 0){
	            $('#active_success').show();
	            $('#inactive_success').hide();
	            setTimeout(function() {
	            window.location = baseurl+"product_item_list";
	         }, 3000);
	        }else{
	            $('#active_success').hide();
	            $('#inactive_success').show();
	            setTimeout(function() {
	         window.location = baseurl+"product_item_list";
	         }, 3000);
	        }
         },
         error: function (error) {
            alert('error; ' + eval(error));
         }
      });
   }


function product_item_validation()
{
	 var err = 0;
	 var product_name = $("#product_name").val();
	 if(product_name == '')
	 {
	 	$('#product_name_err').html('Product Name is required!');
	 	err++;
	 }
	 else
	 {
	 	$('#product_name_err').html('');
	 }
	$("input[id^='prd_item']").each(function(){
		var id = this.id;
		var res = id.substring(9);
		var prd_item = check_input_empty_values($('#prd_item_'+res).val(), 'prd_item_err_'+res, 'Costing Template');
		if(prd_item)
		{
			err++;
		}
		
	});
	$("select[id^='cont_']").each(function(){
		var id = this.id;
		var res = id.substring(5);
		var cont = check_input_empty_values($('#cont_'+res).val(), 'prd_item_cont_err_'+res, 'Container');
		if(cont)
		{
			err++;
		}
		
	});
	if(err>0 || prd_item_er > 0){ return false }else{ return true; }
}
// Costing Template  Edit   
function product_item_edit(val)
{
	$.ajax({
		type:'POST',
		url:baseurl+'Products/product_item_edit',
		data:{'val':val},
		dataType: 'html',
		success:function(result){
			$('#prd_item_edit_modal').empty().append(result);
			$('#prd_item_edit_modal').modal('show');
		}
	})
}
var e_prd_item_er = 0;
function e_product_item_unique(val)
{
	var o_product_item = $("#o_product_item").val();
	var product_name = $('#e_product_name').val();
	if(val != '' && o_product_item != val)
	{
		$.ajax({
				type:"POST",
				url:baseurl+'Products/product_item_unique',
				data:{'value':val, 'product_name':product_name},
				cache: false,
				dataType: "html",
					success: function(result){
					if(result > 0)
					{
						$('#e_prd_item_err').html('Costing Template already exists!');
						e_prd_item_er++;
					}
					else
					{
						$('#e_prd_item_err').html('');
						e_prd_item_er = 0;
						
					}
				}
			});
	}else{ e_prd_item_er = 0; }
}
function e_product_item_validation()
{
	var err = 0;
	 var product_name = $("#e_product_name").val();
	 var prd_item = $("#e_prd_item").val();
	 var cont = $("#e_cont").val();
	 if(product_name == '')
	 {
	 	$('#e_product_name_err').html('Product Name is required!');
	 	err++;
	 }
	 else
	 {
	 	$('#e_product_name_err').html('');
	 }
	 if(cont == '')
	 {
	 	$('#e_prd_item_cont_err').html('Choose Container!');
	 	err++;
	 }
	 else
	 {
	 	$('#e_prd_item_cont_err').html('');
	 }
	 if(prd_item == '')
	 {
	 	$('#e_prd_item_err').html('Costing Template is required!');
	 	err++;
	 }
	else if(e_prd_item_er > 0)
	{
		$('#e_prd_item_err').html('Costing Template already exists!');
		err++;
	}
	 else
	 {
	 	$('#e_prd_item_err').html('');
	 }

	if(err>0 ){ return false }else{ return true; }
}
function e_prd_industry(prd)
{
	$.ajax({
		type:"POST",
		url:baseurl+'Products/industry_by_product_id',
		data:{'prd':prd},
		cache: false,
		dataType: "html",
			success: function(result){

			if(result)
			{
				var indus_val = result.split('|');

				$('#e_industry_id').val(indus_val[0]);
				$('#e_industry_name').val(indus_val[1]);
				
			}
			else
			{
				$('#e_industry_id').val();
				$('#e_industry_name').val();
				
			}
		}
	});
}
// To delete industry
function product_item_delete(val)
{
	$("#prditem_id").val(val);
	$("#delete_prd_item").modal('show');
}

</script>
<!--end::Page Scripts -->
	</body>
	<!-- end::Body -->
</html>