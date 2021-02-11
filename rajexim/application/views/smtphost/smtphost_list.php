<?php $this->load->view('common_header'); ?>
	
				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<!-- <h3 class="m-subheader__title m-subheader__title--separator">Type</h3> -->
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="<?php echo base_url(); ?>dashboard" class="m-nav__link m-nav__link--icon">
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
											<span class="m-nav__link-text">Email Settings</span>
										</a>
									</li>
									<li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
									<li class="m-nav__item">
										<a href="<?php echo base_url(); ?>smtphost" class="m-nav__link">
											<span class="m-nav__link-text">SMTP Host</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">
						<div class="row">
			                  <div class="col-md-12">
								<div style="margin-bottom:2.2rem;">
				                     <ul class="que_sett">
				                        <li><a href="<?php echo base_url(); ?>Settings/email_list">Email List</a></li>
				                        <li class="active"><a href="<?php echo base_url(); ?>Smtphost">SMTP Host</a></li>
				                     </ul>
				                 </div>
			                  </div>
               			</div>

						<div class="alert alert-success alert-dismissible" style="display:none;" id="active" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
							SMTP Host has been activated successfully
						</div>
                        <div class="alert alert-success alert-dismissible" style="display:none;" id="deactive" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
							SMTP Host has been deactivated successfully
						</div>
					<?php if($this->session->flashdata('add_success')){?>
	 						<div class="alert alert-success alert-dismissible response" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								</button>
							  	<?php echo $this->session->flashdata('add_success'); ?>				  	
							</div>
					<?php } if($this->session->flashdata('add_err')){?>
                        <div class="alert alert-success alert-dismissible response" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
						  	<?php echo $this->session->flashdata('add_err'); ?>					  	
						</div>
					<?php } if($this->session->flashdata('del_success')){?>
                        <div class="alert alert-success alert-dismissible response" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
						  	<?php echo $this->session->flashdata('del_success'); ?>					  	
						</div>
					<?php }  if($this->session->flashdata('del_err')){?>
                        <div class="alert alert-success alert-dismissible response" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
						  	<?php echo $this->session->flashdata('del_err'); ?>					  	
						</div>
					<?php } if($this->session->flashdata('up_success')){?>
                        <div class="alert alert-success alert-dismissible response" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
						  	<?php echo $this->session->flashdata('up_success'); ?>					  	
						</div>
					<?php } if($this->session->flashdata('up_err')){?>
                        <div class="alert alert-success alert-dismissible response" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
						  	<?php echo $this->session->flashdata('up_err'); ?>					  	
						</div>
					<?php } ?>

						<!--Begin::Section-->
						<div class="row">
							<div class="col-xl-12">
								<div class="m-portlet m-portlet--mobile ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													SMTP Host List
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<?php //if($_SESSION['Job Order SettingsAdd']==1){?>
												<li class="m-portlet__nav-item">
													<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_pro_type">
														<span>
															<i class="la la-plus"></i>
															<span>Create</span>
														</span>
													</a>
												</li>
												<?php //}?>

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
									<div class="m-portlet__body">

										<!--begin: Datatable -->
									<table class="table table-striped table-bordered table-hover table-checkable" id="m_table_2">
										<thead>
											<tr>
												<th>SMTP Name</th>
												<th>SMTP Host Name</th>
												<th data-orderable="false">Status</th>
												<th class="notexport" data-orderable="false">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach ($smtphost_list as $u_list ) {?>
											<tr>
												<td><?php echo $u_list['smtp_name'];?></td>
												<td><?php echo $u_list['smtp_host_name'];?></td>
												<td>
													<span class="m-switch m-switch--sm m-switch--success" data-toggle="m-tooltip" data-placement="top"  title=<?php if($u_list['status']==0){echo "Active";} else{echo "Inactive";} ?>>
														<label>
															<input type="checkbox" <?php if($u_list['status']==0){echo "checked";} ?> id="activeunactive_<?php echo $i;?>"  name="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $u_list['smtp_host_id']; ?>,<?php echo $i; ?>)" value="<?php echo $u_list['status'];?>"  data-plugin="switchery" data-color="#3f3e6a" data-size="small">
															<span></span>
															<span id="statusprint" style="display:none"><?php if($u_list['status']==0){echo 'Active';}else{echo 'Inactive';} ?></span>
														</label>
														</span>
												</td>
												<td>
													<?php //if($_SESSION['Job Order SettingsEdit']==1){?>
													<a href="javascript:;" data-toggle="modal" data-target="#edit_pro_type"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit" onclick="smtphost_edit('<?php echo $u_list['smtp_host_id']; ?>')"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
													<?php //}?>
													<?php //if($_SESSION['Job Order SettingsDelete']==1){?>
													<a href="javascript:;" data-toggle="modal" data-target="#delete_pro_type" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete" onclick="smtphost_delete('<?php echo $u_list['smtp_host_id']; ?>')"><i class="fa fa-trash-alt"></i></span></a>
													<?php //}?>
												</td>
											</tr>
											<?php $i++;}?>
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

		
		<!--end::Page Scripts -->

<!--begin::Modal-->

<input type="hidden" id="baseUrl" value="<?php echo base_url();?>">
<!--Add Job-->
<div class="container">
	<div class="modal fade" id="create_pro_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Create SMTP Host</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="" method="POST"  enctype="multipart/form-data" action="<?php echo base_url(); ?>smtphost/create_smtphost" onsubmit="return smtphost_validation();">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>SMTP Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control m-input m-input--square" placeholder="Enter SMTP Name" id="smtp_name" name="smtp_name" onkeyup="checkSmtphostUnique(this.value);">
									<span id="smtp_name_err" class="form-control-feedback text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group m-form__group">
									<label>SMTP Host Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control m-input m-input--square" placeholder="Enter SMTP Host Name" id="smtp_host_name" name="smtp_host_name">
									<span id="smtp_host_name_err" class="form-control-feedback text-danger"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Create</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--Edit Job-->
<div class="container">
	<div class="modal fade" id="edit_pro_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
	</div>
</div>

<!--Delete Job-->
<div class="container">
	<div class="modal fade" id="delete_pro_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
	</div>
</div>
<!--end::Modal-->

<script>
var cno=0;
function checkSmtphostUnique(val)
{
    var baseurl= $("#baseUrl").val();
    if(val!='')
    {
	    $.ajax({
	      type:"POST",
	      url:baseurl+'smtphost/checkSmtphostUnique',
	      data:{'value':val},
	      cache: false,
	      dataType: "html",
	      success: function(result){
	            
	            if(result>0)
	            {
	                $('#smtp_name_err').html('SMTP Name Already Exist!');
	                cno++;
	            }
	            else
	            {
	                $('#smtp_name_err').html('');
	                cno=0;
	            }

	      }
	      });
	}
}

function smtphost_validation()
{
	var err = 0;
	var smtpname = $('#smtp_name').val();
	var smtphostname = $('#smtp_host_name').val();

	if(smtpname==''){
		$('#smtp_name_err').html('SMTP Name is required!');
		err++;
	}
	else
	{
		if(cno>0)
		{
			$('#smtp_name_err').html('SMTP Name Already Exist!');
	    	err++;
		}
		else
		{
			$('#smtp_name_err').html('');
		}
	}

	if(smtphostname==''){
		$('#smtp_host_name_err').html('SMTP Host Name is required!');
		err++;
	}
	else
	{
		$('#smtp_host_name_err').html('');
	}

	if(err>0){ return false; }else{ return true; }
}

function activeunactive(val,ival) {
				var unactive;
				var unactv;
				var baseurl= $("#baseUrl").val();
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
					url:baseurl+'smtphost/smtphost_active',
					data:datastring,
					cache: false,
					dataType: "html",
					success: function(result){
						// alert(result+unactive);
						if(a == 1){
				            $("#active").css('display','block');
							$("#active").addClass('response');
				        }else{
				            $("#deactive").css('display','block');
							$("#deactive").addClass('response');
				        }      
			            setTimeout(function() {
				         window.location = baseurl+"smtphost";
				        }, 3000);
					},
					error: function (error) {
						alert('error; ' + eval(error));
						setTimeout(function() {
				         window.location = baseurl+"smtphost";
				        }, 3000);
					}
				});
			}

function smtphost_edit(val){
var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'smtphost/smtphost_edit',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#edit_pro_type').empty().append(response);
}
});
}

function smtphost_delete(val){
var baseurl= $("#baseUrl").val();
//alert(val);
$.ajax({
type: "POST",
url: baseurl+'smtphost/smtphost_delete',
async: false,
type: "POST",
data: "id="+val,
dataType: "html",
success: function(response)
{
$('#delete_pro_type').empty().append(response);
}
});
}

function removeSmtphost(val)
{ 
var baseurl= $("#baseUrl").val();
$.ajax({
type: "POST",
url: baseurl+'smtphost/delete',
async: false,
data:"field="+val,
success: function(response)
{
window.location.href = baseurl+'smtphost';
}
});
}

var cnoe=0;
function checkSmtphostUniqueEdit(val)
{
    var baseurl= $("#baseUrl").val();
    var bid = $('#smtp_host_id').val();
    if(val!='')
    {
	    $.ajax({
	      type:"POST",
	      url:baseurl+'smtphost/checkSmtphostUniqueEdit',
	      data:{'value':val,'bid':bid},
	      cache: false,
	      dataType: "html",
	      success: function(result){
	            
	            if(result>0)
	            {
	                $('#smtp_name_edit_err').html('SMTP Name Already Exist!');
	                cnoe++;
	            }
	            else
	            {
	                $('#smtp_name_edit_err').html('');
	                cnoe=0;
	            }

	      }
	      });
	}
}

function smtphost_edit_validation()
{
	var err = 0;
	var smtpname = $('#smtp_name_edit').val();
	var smtphostname = $('#smtp_host_name_edit').val();

	if(smtpname==''){
		$('#smtp_name_edit_err').html('SMTP Name is required!');
		err++;
	}
	else
	{
		if(cnoe>0)
		{
			$('#smtp_name_edit_err').html('SMTP Name Already Exist!');
	    	err++;
		}
		else
		{
			$('#smtp_name_edit_err').html('');
		}
	}

	if(smtphostname==''){
		$('#smtp_host_name_edit_err').html('SMTP Host Name is required!');
		err++;
	}
	else
	{
		$('#smtp_host_name_edit_err').html('');
	}

	if(err>0){ return false; }else{ return true; }
}
</script>


	</body>

	<!-- end::Body -->
</html>