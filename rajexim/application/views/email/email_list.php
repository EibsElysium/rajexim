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

											<span class="m-nav__link-text">Email List</span>

										</a>

									</li>

								</ul>

							</div>

						</div>

					</div>	

					<div class="m-content">

						<div class="row">

			                  <div class="col-md-12">

								<div style="margin-bottom:2.2rem;">

				                     <ul class="que_sett">

				                        <li class="active"><a href="<?php echo base_url(); ?>Settings/email_list">Email List</a></li>

				                        <li><a href="<?php echo base_url(); ?>smtphost">SMTP Host</a></li>

				                     </ul>

				                 </div>

			                  </div>

               			</div>

						<div class="row">

							<div class="col-lg-12">

								<div class="m-portlet m-portlet--mobile">

										<div class="m-portlet__head">

											<div class="m-portlet__head-caption">

												<div class="m-portlet__head-title">

													<h3 class="m-portlet__head-text">

														Email List

													</h3>

												</div>

											</div>

											<div class="m-portlet__head-tools">

												<ul class="m-portlet__nav">
													<?php if($_SESSION['Rajexim Email SettingsAdd'] == 1) { ?>
													<li class="m-portlet__nav-item">

				                                       <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_email">

				                                          <span>

				                                             <i class="la la-plus"></i>

				                                             <span>Create Email</span>

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

										<?php if($this->session->flashdata('email_success')){?>

						                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">

												<button type="button" class="close" data-dismiss="alert" aria-label="Close">

													</button>

													<?php echo $this->session->flashdata('email_success'); ?>

												</div>

								            <?php } ?>



											<?php if($this->session->flashdata('email_err')){?>

							                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">

													<button type="button" class="close" data-dismiss="alert" aria-label="Close">

													</button>

													<?php echo $this->session->flashdata('email_err'); ?>

												</div>

								            <?php } ?>	



											<div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">

												<button type="button" class="close" data-dismiss="alert" aria-label="Close">

												</button>

												Email ID activated successfully.

											</div>



											<div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">

												<button type="button" class="close" data-dismiss="alert" aria-label="Close">

												</button>

												Email ID deactivated successfully.

											</div>

										<div class="m-portlet__body">

											

											<!--begin: Datatable -->

											<table class="table table-striped table-bordered table-hover table-checkable" id="m_table_2">

												<thead>

													<tr>

				                                    <th>Email ID</th>

				                                    <th>From Name</th>

				                                    <th>SMTP Host</th>

				                                    <th>CC</th>

				                                    <th>BCC</th>
				                                    
				                                    <th>Status</th>

				                                    <th class="notexport" data-orderable="false">Action</th>

				                                 </tr>

												</thead>

												<tbody>

													<?php

													$i=1; foreach ($email_lists as $email_list ) { ?>

													<tr>

														<td><?php echo $email_list->email_ID; ?></td>

														<td><?php echo $email_list->from_name; ?></td>

														<td><?php echo $email_list->smtp_host; ?></td>

														<td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;" class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo ($email_list->cc_name) ? $email_list->cc_name : '-'; ?>"><?php echo ($email_list->cc_name) ? $email_list->cc_name : '-'; ?></td>
														<td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;" class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo ($email_list->bcc_name) ? $email_list->bcc_name : '-'; ?>"><?php echo ($email_list->bcc_name) ? $email_list->bcc_name : '-'; ?></td>
														<td>

															<span class="m-switch m-switch--sm m-switch--success" title=<?php if($email_list->status==0){echo "Active";} else{echo "Inactive";} ?>>

																<label>

																	<input type="checkbox" <?php if($email_list->status==0){echo "checked";} ?> id="activeunactive_<?php echo $i;?>"  name="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $email_list->email_detail_id; ?>,<?php echo $i; ?>)" value="<?php echo $email_list->status;?>"  data-plugin="switchery" data-color="#3f3e6a" data-size="small">

																	<span></span>

																</label>

															</span>

														</td>

														<td>
															<?php if($_SESSION['Rajexim Email SettingsEdit'] == 1) { ?>
															<a href="javascript:;" data-toggle="m-tooltip" data-placement="top" title="Edit"><span onclick="email_edit(<?php echo $email_list->email_detail_id; ?>)" class="tooltip-animation"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
															<?php } ?>

															<?php if($_SESSION['Rajexim Email SettingsDelete'] == 1) { ?>
															<a href="#" onclick="return email_delete(<?php echo $email_list->email_detail_id; ?>)" data-toggle="m-tooltip" data-placement="top" title="Delete"><span class="tooltip-animation"><i class="fa fa-trash-alt"></i></span></a>
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

   <div class="modal fade" id="create_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-keyboard="false" data-backdrop = "static" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

         <div class="modal-content">

            <div class="modal-header">

               <h5 class="modal-title" id="exampleModalLabel">Create Email ID</h5>

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

               </button>

            </div>

            <form  name="email_add" id="email_add" method="POST" action="<?php echo base_url(); ?>Settings/email_save" 

            	onsubmit="return email_validation();">

            <div class="modal-body">

               <div class="row">

                     <div class="col-lg-6">

                        <div class="form-group m-form__group">

                           <label>Email ID<span class="text-danger">*</span></label>

                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Email ID" name="email_ID" id="email_ID" maxlength="100" onblur="email_ID_unique(this.value);" >

                           <span class="text-danger" id="email_ID_err"></span>

                        </div>

                     </div>

                     <div class="col-lg-6">

                        <div class="form-group m-form__group">

                           <label>From Name<span class="text-danger">*</span></label>

                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter From Name" name="from_name" id="from_name" maxlength="60">

                           <span class="text-danger" id="from_name_err"></span>

                        </div>

                     </div>

               </div>



                <div class="row">

                      <div class="col-lg-6">

                              <div class="form-group m-form__group">

                                 <label>Password<span class="text-danger">*</span></label>

                                 <span class="m-input-icon__icon m-input-icon__icon--right" onclick="change_view();" style="height: calc(2.95rem + 2px);"><span style="cursor:pointer;"><i id="close" class="fa fa-eye-slash"></i><i id="open" style="display:none" class="fa fa-eye"></i></span></span>

                                 <input type="password" class="form-control m-input m-input--square" placeholder="Enter Password" name="password" id="password">

                                 <span class="m-form__help text-danger" id="password_err"></span>

                              </div>

                           </div>

                      <div class="col-lg-6">

		                   <div class="form-group m-form__group">

		                      <label>SMTP Host<span class="text-danger">*</span></label>

		                      <select class="form-control m-bootstrap-select m_selectpicker" name="smtp_host" id="smtp_host">

									<option value="">Choose</option>

									<?php foreach ($smtp_host_list as $value) { ?>

										<option value="<?php echo $value['smtp_host_name']; ?>"><?php echo $value['smtp_name'];?></option>

									<?php } ?>

								</select>

		                      <span id="smtp_host_err" class="text-danger"></span>

		                   </div>




                              </div>

                           </div>




               <div class="row">

                  <div class="col-lg-12">

                     <div class="form-group m-form__group">

                        <label>Add CC</label>

                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple name="email_cc[]" id="email_cc">

                           <option value="">Choose CC</option>

                           <?php

                           	if(!empty($email_lists))

                           	{

                           		foreach ($email_lists as $key => $email_list) { if($email_list->status == 0){ ?>

                           			<option value="<?php echo $email_list->email_detail_id; ?>"><?php echo $email_list->email_ID; ?></option>

                           		<?php   } } }

                           ?>

                        </select>

                        <span class="text-danger" id="email_cc_err"></span>

                     </div>

                  </div>

               </div>

               <div class="row">

                  <div class="col-lg-12">

                     <div class="form-group m-form__group">

                        <label>Add BCC</label>

                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple name="email_bcc[]" id="email_bcc">

                           <option value="">Choose BCC</option>

                           <?php

                           	if(!empty($email_lists))

                           	{

                           		foreach ($email_lists as $key => $email_list) { if($email_list->status == 0){ ?>

                           			<option value="<?php echo $email_list->email_detail_id; ?>"><?php echo $email_list->email_ID; ?></option>

                           		<?php   } } }

                           ?>

                        </select>

                        <span class="text-danger" id="email_bcc_err"></span>

                     </div>

                  </div>

               </div>

               <div class="row">

                     <div class="col-lg-12">

                        <div class="form-group m-form__group">

                           <label>Signature</label>

                           <textarea class="summernote" id="m_summernote_1" name="signature"></textarea>

                           <span class="text-danger" id="signature_err"></span>

                        </div>

                     </div>

               </div>

               

            </div>

            <input type="hidden" id='visible_type' name="visible_type" value="hide">

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

	<div class="modal fade" id="email_edit_modal" data-keyboard="false" data-backdrop = "static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

		

	</div>

</div>



<!--begin::Modal-->

<div class="container">

   <div class="modal fade" data-keyboard="false" data-backdrop = "static" id="delete_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">

         <div class="modal-content">

         	<form action="<?php echo base_url(); ?>Settings/email_ID_delete" method="post">

            <div class="modal-header">

               <h5 class="modal-title" id="exampleModalLabel">Delete Email ID</h5>

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

               </button>

            </div>

            <div class="modal-body">

               <p>Are You Sure You Want to Delete this Email ID Permanently?</p>

            </div>

            <div class="modal-footer">

            	<input type="hidden" name="email_detail_id" id="email_detail_id" value="">

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

	<script src="<?php echo base_url(); ?>assets/demo/demo12/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>



	<!-- end::Footer -->

	</div>

		<!-- end:: Page -->

		<!--begin::Global Theme Bundle -->

<script>


var baseurl = '<?php echo base_url(); ?>';

var title = $('title').text() + ' | ' + 'Email List';

$(document).attr("title", title);


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

         url:baseurl+'Settings/email_status_change',

         data:datastring,

         cache: false,

         dataType: "html",

         success: function(result){

             if(unactive == 0){

	            $('#active_success').show();

	            $('#inactive_success').hide();

	            setTimeout(function() {

	            window.location = baseurl+"Settings/email_list";

	         }, 3000);

	        }else{

	            $('#active_success').hide();

	            $('#inactive_success').show();

	            setTimeout(function() {

	         window.location = baseurl+"Settings/email_list";

	         }, 3000);

	        }

         },

         error: function (error) {

            alert('error; ' + eval(error));

         }

      });

   }

var er = 0;

function email_ID_unique(val)

{

	var email_ID = $("#email_ID").val();

	$.ajax({

		type:"POST",

		url:baseurl+'Settings/email_ID_unique',

		data:{'value':val},

		cache: false,

		dataType: "html",

			success: function(result){

			if(result > 0)

			{

				$('#email_ID_err').html('Email ID already exists!');

				er++;

			}

			else

			{

				$('#email_ID_err').html('');

				

			}

		}

	});

	

}

function email_validation()

{

	 var err = 0;

	 var email_ID = check_input_empty_values($('#email_ID').val(), 'email_ID_err', 'Email ID');

	 var from_name = check_input_empty_values($('#from_name').val(), 'from_name_err', 'From Name');

	 var password = check_input_empty_values($('#password').val(), 'password_err', 'Password');

	 var host_name = check_input_empty_values($('#smtp_host').val(), 'smtp_host_err', 'SMTP Host');

		if(email_ID)

		{

			$('#email_ID_err').html('Email ID is required!');

			err++;

		}

		else if(!ValidateEmail($('#email_ID').val()))

		{

			$('#email_ID_err').html('Invalid Email ID!');

			err++;

		}else{

			$('#email_ID_err').html('');

		}

		if(from_name)

		{

			err++;

		}

		if(password)
		{
			err++;
		}
		if(host_name)
		{
			err++;
		}
	if(err>0 || er > 0){ return false }else{ return true; }

}

// Email ID Edit   

function email_edit(val)

{

	$.ajax({

		type:'POST',

		url:baseurl+'Settings/Email_ID_edit',

		data:{'val':val},

		dataType: 'html',

		success:function(result){

			$('#email_edit_modal').empty().append(result);

			$('#email_edit_modal').modal('show');

		}

	});

}

var e_er = 0;

function e_email_ID_unique(val)

{

	var o_email_ID = $("#o_email_ID").val();



	if(val != '' && o_email_ID != val.trim())

	{

		$.ajax({

		type:"POST",

		url:baseurl+'Settings/email_ID_unique',

		data:{'value':val},

		cache: false,

		dataType: "html",

			success: function(result){

			if(result > 0)

			{

				$('#e_email_ID_err').html('Email ID already exists!');

				e_er++;

			}

			else

			{

				$('#e_email_ID_err').html('');

				

			}

		}

	});

	}

}

function e_email_validation()

{

	var err = 0;

	var email_ID = check_input_empty_values($('#e_email_ID').val(), 'e_email_ID_err', 'Email ID');

	var from_name = check_input_empty_values($('#e_from_name').val(), 'e_from_name_err', 'From Name');

	var password = check_input_empty_values($('#e_password').val(), 'e_password_err', 'Password');

	 var host_name = check_input_empty_values($('#e_smtp_host').val(), 'e_smtp_host_err', 'SMTP Host');

	if(email_ID)

	{

		$('#e_email_ID_err').html('Email ID is required!');

		err++;

	}

	else if(!ValidateEmail($('#e_email_ID').val()))

	{

		$('#e_email_ID_err').html('Invalid Email ID!');

		err++;

	}

	else if(e_er > 0)

	{

		$('#e_email_ID_err').html('Email ID already exists!');

		err++;

	}

	else{

		$('#e_email_ID_err').html('');

	}

	if(from_name)

	{

		err++;

	}



	if(password)

	{

		err++;

	}

	if(host_name)

	{

		err++;

	}



	if(err>0 || e_er > 0){ return false }else{ return true; }

}

// To delete email

function email_delete(val)

{

	$("#email_detail_id").val(val);

	$("#delete_email").modal('show');

}



function change_view() 

{

	var show = $("#visible_type").val();

	if (show == "hide") 

	{

		$("#password").attr("type", "text");

		$("#open").show();

		$("#close").hide();

		$("#visible_type").val('show');

	}

	else

	{

		$("#visible_type").val('hide');

		$("#password").attr("type", "password");

		$("#close").show();

		$("#open").hide();

	}	

}
	
function e_change_view() 

{
	var show = $("#e_visible_type").val();

	if (show == "hide") 

	{

		$("#e_password").attr("type", "text");

		$("#e_open").show();

		$("#e_close").hide();

		$("#e_visible_type").val('show');

	}

	else

	{

		$("#e_visible_type").val('hide');

		$("#e_password").attr("type", "password");

		$("#e_close").show();

		$("#e_open").hide();

	}	

}

</script>

<!--end::Page Scripts -->

	</body>

	<!-- end::Body -->

</html>