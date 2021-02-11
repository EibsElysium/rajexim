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
											<span class="m-nav__link-text">Product Settings</span>
										</a>
									</li>
									<li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
									<li class="m-nav__item">
										<a href="javascript:;" class="m-nav__link">
											<span class="m-nav__link-text">Industry List</span>
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
														Industry List
													</h3>
												</div>
											</div>
											<div class="m-portlet__head-tools">
												<ul class="m-portlet__nav">
													<?php if($_SESSION['Industry ListAdd']==1) { ?>
													 <li class="m-portlet__nav-item">
				                                       <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_industry">
				                                          <span>
				                                             <i class="la la-plus"></i>
				                                             <span>Create Industry</span>
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
										<?php if($this->session->flashdata('industry_success')){?>
						                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													</button>
													<?php echo $this->session->flashdata('industry_success'); ?>
												</div>
								            <?php } ?>

											<?php if($this->session->flashdata('industry_err')){?>
							                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													</button>
													<?php echo $this->session->flashdata('industry_err'); ?>
												</div>
								            <?php } ?>	

											<div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												</button>
												Industry Name activated successfully.
											</div>

											<div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												</button>
												Industry Name deactivated successfully.
											</div>
										<div class="m-portlet__body">
											
											<!--begin: Datatable -->
											<table class="table table-striped table-bordered table-hover table-checkable" id="m_table_2">
												<thead>
													<tr>
					                                    <th>Industry</th>
					                                    <th>Status</th>
					                                    <th>Action</th>
					                                 </tr>
												</thead>
												<tbody>
													<?php
													$i=1; foreach ($industry_lists as $industry_list ) { ?>
													<tr>
														<td><?php echo $industry_list->industry_name; ?></td>
														<td>
															<span class="m-switch m-switch--sm m-switch--success" title=<?php if($industry_list->status==0){echo "Active";} else{echo "Inactive";} ?>>
																<label>
																	<input type="checkbox" <?php if($industry_list->status==0){echo "checked";} ?> id="activeunactive_<?php echo $i;?>"  name="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $industry_list->industry_id; ?>,<?php echo $i; ?>)" value="<?php echo $industry_list->status;?>"  data-plugin="switchery" data-color="#3f3e6a" data-size="small">
																	<span></span>
																</label>
															</span>
														</td>
														<td>
															<?php if($_SESSION['Industry ListEdit']==1) { ?>
															<a href="javascript:;" data-toggle="m-tooltip" data-placement="top" title="Edit"><span onclick="industry_edit(<?php echo $industry_list->industry_id; ?>)" class="tooltip-animation"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
															<?php } ?>
															<?php if($_SESSION['Industry ListDelete']==1) { ?>
															<a href="#" onclick="return industry_delete(<?php echo $industry_list->industry_id; ?>)" data-toggle="m-tooltip" data-placement="top" title="Delete"><span class="tooltip-animation"><i class="fa fa-trash-alt"></i></span></a>
															<?php } ?>
														</td>
													</tr>
													<?php $i++;  }?>
												</tbody>
											</table>
										</div>
								</div>
							</div>
						</div>
					</div>
				
				</div>
			</div>
			<!-- end:: Body -->
<!--begin::Create Industry-->
<div class="container">
   <div class="modal fade" id="create_industry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Industry</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            
            <form  name="industry_add" id="industry_add" method="POST" action="<?php echo base_url(); ?>Settings/industry_save" 
            	onsubmit="return industry_validation();">
	            <div class="modal-body">
	            	<div class="indus_dynamic">
		               <div class="row" id="indus_dynamic_id_0">
		                     <div class="col-lg-12">
		                        <div class="form-group m-form__group">
		                           <label>Industry Name<span class="text-danger">*</span></label>
		                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Industry Name" id="industry_0" name="industry[]" maxlength="60" autocomplete="off" onblur="industry_name_unique(this.value, 0);"> 
		                           <span class="text-danger" id="industry_err_0"></span>
		                        </div>
		                     </div>
		               </div>
	           		</div>

	               <div class="row">
	                  <div class="col-lg-12">
	                     <div class="pull-right">
	                        <div class="form-group m-form__group mt_25px">
	                          <button type="button" class="btn btn-primary"><i class="fa fa-plus" onclick="industry_add_row();"></i></button>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	               <input type="hidden" name="indus_dynamic_val" id="indus_dynamic_val" value="1">
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
	<div class="modal fade" id="industry_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
	</div>
</div>

<!--begin::Modal-->
<div class="container">
   <div class="modal fade" id="delete_industry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
         	<form action="<?php echo base_url(); ?>Settings/industry_delete" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Industry</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Delete this Industry Permanently?</p>
            </div>
            <input type="hidden" name="indus_id" id="indus_id" value="">
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
var title = $('title').text() + ' | ' + 'Industry List';
$(document).attr("title", title);

function industry_add_row()
{
  var indus_dynamic_val = $('#indus_dynamic_val').val();
  var indus_dynamic = $('.indus_dynamic');
  indus_dynamic.append('<div class="row" id="indus_dynamic_id_'+indus_dynamic_val+'"><div class="col-lg-10"><div class="class="form-group m-form__group"><label>Industry Name<span class="text-danger">*</span></label><input type="text" class="form-control m-input m-input--square" placeholder="Enter Industry Name" id="industry_'+indus_dynamic_val+'" name="industry[]" maxlength="60" autocomplete="off" onblur="industry_name_unique(this.value, '+indus_dynamic_val+');"><span class="text-danger" id="industry_err_'+indus_dynamic_val+'"></span></div></div><div class="col-lg-2"><div class="pull-right"> <div class="form-group m-form__group mt_25px"> <button type="button" onclick="remove_industry(indus_dynamic_id_'+indus_dynamic_val+','+indus_dynamic_val+');" class="btn btn-danger" ><i class="fa fa-minus"></i></button></div> </div> </div> </div></div>');

 // 
 
  indus_dynamic_val = Number(indus_dynamic_val)+1;
  $('#indus_dynamic_val').val(indus_dynamic_val);
}
function remove_industry(id,val)
{
  $(id).remove();
}
function activeunactive(val,ival) 
{
      var unactive;
      var unactv;
      var baseurl='<?php echo base_url(); ?>';
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
         url:baseurl+'Settings/industry_status_change',
         data:datastring,
         cache: false,
         dataType: "html",
         success: function(result){
             if(unactive == 0){
	            $('#active_success').show();
	            $('#inactive_success').hide();
	            setTimeout(function() {
	            window.location = baseurl+"Settings/industry_list";
	         }, 3000);
	        }else{
	            $('#active_success').hide();
	            $('#inactive_success').show();
	            setTimeout(function() {
	         window.location = baseurl+"Settings/industry_list";
	         }, 3000);
	        }
         },
         error: function (error) {
            alert('error; ' + eval(error));
         }
      });
   }

var er = 0;
function industry_name_unique(val, v)
{
	var value = $("#industry_"+v).val();
	var alreadyprod = 0;
	var prod = $('input[id^="industry"]').length; 
	if(value != '')
	{
		for(var i=0;i<prod;i++)
		{
		    var prodval = $("#industry_"+i).val();
		    if(v!=i && value == prodval)
		    {
		        alreadyprod++;
		    }
		}
		if(alreadyprod > 0)
		{
			$("#industry_"+v).val('');
		    alert("Industry Name already entered!");
		}else{
			    $.ajax({
				type:"POST",
				url:baseurl+'Settings/industry_unique',
				data:{'value':val},
				cache: false,
				dataType: "html",
					success: function(result){
					if(result > 0)
					{
						$('#industry_err_'+v).html('Industry Name already exists!');
						er++;
					}
					else
					{
						$('#industry_err_'+v).html('');
						
					}
				}
			});
		}
	}
	
}
function industry_validation()
{
	 var err = 0;
	$("input[id^='industry_']").each(function(){
		var id = this.id;
		var res = id.substring(9);
		var industry_name = check_input_empty_values($('#industry_'+res).val(), 'industry_err_'+res, 'Industry Name');
		if(industry_name)
		{
			err++;
		}
		
	});
	if(err>0 || er > 0){ return false }else{ return true; }
}
// Industry Edit   
function industry_edit(val)
{
	$.ajax({
		type:'POST',
		url:baseurl+'Settings/industry_edit',
		data:{'val':val},
		dataType: 'html',
		success:function(result){
			$('#industry_edit_modal').empty().append(result);
			$('#industry_edit_modal').modal('show');
		}
	})
}
var e_er = 0;
function e_industry_unique(val)
{
	var o_industry = $("#o_industry_name").val();

	if(val != '' && o_industry != val.trim())
	{
		$.ajax({
			type:"POST",
			url:baseurl+'Settings/industry_unique',
			data:{'value':val},
			cache: false,
			dataType: "html",
				success: function(result){
				if(result > 0)
				{
					$('#e_industry_name_err').html('Industry Name already exists!');
					e_er++;
				}
				else
				{
					$('#e_industry_name_err').html('');
					e_er=0;
				}
			}
		});
	}
}
function e_industry_validation()
{
	var err = 0;
	var industry_name = check_input_empty_values($('#e_industry_name').val(), 'e_industry_name_err', 'Industry Name');
	if(industry_name)
	{
		err++;
	}else if(e_er > 0)
	{
		$('#e_industry_name_err').html('Industry Name already exists!');
		err++;
	}
	else
	{
		$('#e_industry_name_err').html('');
	}

	if(err>0 || e_er > 0){ return false }else{ return true; }
}
// To delete industry
function industry_delete(val)
{
	$("#indus_id").val(val);
	$("#delete_industry").modal('show');
}

</script>
<!--end::Page Scripts -->
	</body>
	<!-- end::Body -->
</html>