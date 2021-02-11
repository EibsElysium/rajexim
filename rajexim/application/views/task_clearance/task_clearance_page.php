<?php $this->load->view('common_header'); ?>


		<div class="m-grid__item m-grid__item--fluid m-wrapper">

                  
			<!-- BEGIN: Subheader -->
			<div class="m-subheader ">
				
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<!-- <h3 class="m-subheader__title m-subheader__title--separator">General Settings</h3> -->
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
								<a href="<?php echo base_url(); ?>dashboardsettings" class="m-nav__link">
									<span class="m-nav__link-text">Task Data Clearance</span>
								</a>
							</li>
						</ul>

					</div>
				</div>
			</div>
			
			<!-- END: Subheader -->
			<div class="m-content">
				<?php if($this->session->flashdata('g_success')){?>
                    <div class="alert alert-success" id="alertaddmessage">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                <?php echo $this->session->flashdata('g_success'); ?>
	                </div>
                <?php } ?>

                <?php if($this->session->flashdata('g_err')){?>
                    <div class="alert alert-success" id="alertaddmessage">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                <?php echo $this->session->flashdata('g_err'); ?>
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
											Task Data Clearance
										</h3>
									</div>
								</div>
							</div>
							<form  name="generalsetting_form" id="generalsetting_form" method="POST" action="<?php echo base_url(); ?>Settings/clear_task_data" enctype="multipart/form-data" onsubmit="return dvalidation();" >

							<div class="m-portlet__body">
								<fieldset>
									<legend>Task Data Clearance Period</legend>
									<div class="row">
										<div class="col-lg-3">
											
										</div>
										<div class="col-lg-3">
											<div class="form-group m-form__group">
												<label>From Date<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter From Date" id="m_datepicker_1_modal" name="from_date">
												<span class="m-form__help text-danger" id="from_date_err"></span>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group m-form__group">
												<label>To Date<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter To Date" id="m_datepicker_2_modal" name="to_date">
												<span class="m-form__help text-danger" id="to_date_err"></span>
												
											</div>
										</div>
										<div class="col-lg-3">
											
										</div>
									</div>								
								</fieldset>
								
									
							</div>
							<div class="m-portlet__foot">
								<div class="row align-items-center">
									<div class="col-lg-12 m--align-right">
										<input type="submit"  class="btn btn-primary" name="submit" id="btnsubmit" value="Delete">
									</div>
								</div>
							</div>
							</form>
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

<script type="text/javascript">
var title = $('title').text() + ' | ' + 'Task Data Clearance Settings';
$(document).attr("title", title);

$('#m_datepicker_1_modal').datepicker({format:'mm-dd-yyyy', todayHighlight:!0,orientation:"bottom left",templates:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'}});
$('#m_datepicker_2_modal').datepicker({format:'mm-dd-yyyy', todayHighlight:!0,orientation:"bottom left",templates:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'}});




// To validate general setting form
function dvalidation()
{
	
	var err = 0;
	var from_date = $('#m_datepicker_1_modal').val();
	var to_date = $('#m_datepicker_2_modal').val();
	
	if(from_date=='')
	{
		$('#from_date_err').html('From Date is required!');
		err++;
	}
	else
	{
		$('#from_date_err').html('');
	}

	const date1 = new Date(from_date);
	const date2 = new Date(to_date);
	// const diffTime = Math.abs(date2 - date1);
	// const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
	// console.log(diffTime + " milliseconds");
	// console.log(diffDays + " days");

	
	

	if(to_date=='')
	{
		$('#to_date_err').html('To Date is required!');
		err++;
	}
	else if(date1 >= date2) 
	{
		$('#to_date_err').html('To Date Must be Greater Than From Date');
		err++;
	}
	else
	{
		$('#to_date_err').html('');
	}
    if(err>0){ return false; }else{ return true; }
}
</script>

	</body>
	<!-- end::Body -->
</html>