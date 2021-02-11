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
									<span class="m-nav__link-text">Dashboard Settings</span>
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
											Dashboard Settings
										</h3>
									</div>
								</div>
							</div>
							<form  name="generalsetting_form" id="generalsetting_form" method="POST" action="<?php echo base_url(); ?>dashboardsettings/dashboard_settings_update" enctype="multipart/form-data" onsubmit="return dvalidation();" >
								<input type="hidden" id="dashboard_settings_id" name="dashboard_settings_id" value="<?php echo $d_settings->dashboard_settings_id;?>">

							<div class="m-portlet__body">
								<fieldset>
									<legend>Notification Days</legend>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group m-form__group">
												<label>Lead After<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead After Days" id="lead_days_after" name="lead_days_after" value="<?php echo $d_settings->lead_days_after; ?>" onkeypress="return isNumber(event,'lead_days_after_err');">
												<span class="m-form__help text-danger" id="lead_days_after_err"></span>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group m-form__group">
												<label>JO Before<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter JO Before Days" name="jo_days_before" id="jo_days_before" value="<?php echo $d_settings->jo_days_before; ?>" onkeypress="return isNumber(event,'jo_days_before_err');">
												<span class="m-form__help text-danger" id="jo_days_before_err"></span>
												
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group m-form__group">
												<label>BO Before<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter BO Before Days" name="bo_days_before" id="bo_days_before" value="<?php echo $d_settings->bo_days_before; ?>" onkeypress="return isNumber(event,'bo_days_before_err');">
												<span class="m-form__help text-danger" id="bo_days_before_err"></span>
												
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group m-form__group">
												<label>Un-Attended Minimum Count<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter Un-Attended Minimum Count" name="un_attend_count" id="un_attend_count" value="<?php echo $g_settings->lead_replies_max; ?>" onkeypress="return isNumber(event,'un_attend_count_err');">
												<span class="m-form__help text-danger" id="un_attend_count_err"></span>
											</div>
										</div>
									</div>								
								</fieldset>
								<fieldset>
									<legend>Top/Least Count</legend>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group m-form__group">
												<label>Product<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter Product Count" id="max_product_count" name="max_product_count" value="<?php echo $d_settings->max_product_count; ?>" onkeypress="return isNumber(event,'max_product_count_err');">
												<span class="m-form__help text-danger" id="max_product_count_err"></span>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group m-form__group">
												<label>Lead Source<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter Lead Source Count" name="max_lead_source_count" id="max_lead_source_count" value="<?php echo $d_settings->max_lead_source_count; ?>" onkeypress="return isNumber(event,'max_lead_source_count_err');">
												<span class="m-form__help text-danger" id="max_lead_source_count_err"></span>
												
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group m-form__group">
												<label>Supplier<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter Supplier Count" name="max_supplier_count" id="max_supplier_count" value="<?php echo $d_settings->max_supplier_count; ?>" onkeypress="return isNumber(event,'max_supplier_count_err');">
												<span class="m-form__help text-danger" id="max_supplier_count_err"></span>
												
											</div>
										</div>
									</div>								
								</fieldset>
								<fieldset>
									<legend>Supplier Points for SPO Complete</legend>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group m-form__group">
												<label>Before End Date<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter Before End Date Points" id="supplier_point_before" name="supplier_point_before" value="<?php echo $d_settings->supplier_point_before; ?>" onkeypress="return isNumberKey(event,this);">
												<span class="m-form__help text-danger" id="supplier_point_before_err"></span>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group m-form__group">
												<label>On End Date<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter On End Date Points" name="supplier_point_ondate" id="supplier_point_ondate" value="<?php echo $d_settings->supplier_point_ondate; ?>" onkeypress="return isNumberKey(event,this);">
												<span class="m-form__help text-danger" id="supplier_point_ondate_err"></span>
												
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group m-form__group">
												<label>After End Date<span class="text-danger">*</span></label>
												<input type="text" class="form-control m-input m-input--square" placeholder="Enter After End Date Points" name="supplier_point_after" id="supplier_point_after" value="<?php echo $d_settings->supplier_point_after; ?>">
												<span class="m-form__help text-danger" id="supplier_point_after_err"></span>
												
											</div>
										</div>
									</div>								
								</fieldset>
									
							</div>
							<div class="m-portlet__foot">
								<div class="row align-items-center">
									<div class="col-lg-12 m--align-right">
										<input type="submit"  class="btn btn-primary" name="submit" id="btnsubmit" value="Save Changes">
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
var title = $('title').text() + ' | ' + 'Dashboard Settings';
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
  
  function isNumber(evt,id_val) {
    evt = (evt) ? evt : window.event;
    if (evt.which != 8 && evt.which != 0 && (evt.which < 48 || evt.which > 57)) {
      $("#"+id_val).html("Digits Only");
      return false;
    }
    else{
      $("#"+id_val).html("");
      return true;
    }
  }



// To validate general setting form
function dvalidation()
{
	var err = 0;
	var ladays = $('#lead_days_after').val();
	var jobefore = $('#jo_days_before').val();
	var bobefore = $('#bo_days_before').val();
	var unattcount = $('#un_attend_count').val();
	var pcount = $('#max_product_count').val();
	var lscount = $('#max_lead_source_count').val();
	var scount = $('#max_supplier_count').val();
	var spbed = $('#supplier_point_before').val();
	var spoed = $('#supplier_point_ondate').val();
	var spaed = $('#supplier_point_after').val();
	if(ladays=='' || ladays==0)
	{
		$('#lead_days_after_err').html('Lead After Days is required!');
		err++;
	}
	else
	{
		$('#lead_days_after_err').html('');
	}
	if(jobefore=='' || jobefore==0)
	{
		$('#jo_days_before_err').html('JO Before Days is required!');
		err++;
	}
	else
	{
		$('#jo_days_before_err').html('');
	}
	if(bobefore=='' || bobefore==0)
	{
		$('#bo_days_before_err').html('BO Before Days is required!');
		err++;
	}
	else
	{
		$('#bo_days_before_err').html('');
	}
	if(unattcount=='' || unattcount==0)
	{
		$('#un_attend_count_err').html('Un-Attended Minimum Count');
		err++;
	}
	else
	{
		$('#un_attend_count_err').html('');
	}
	if(pcount=='' || pcount==0)
	{
		$('#max_product_count_err').html('Product Count is required!');
		err++;
	}
	else
	{
		$('#max_product_count_err').html('');
	}
	if(lscount=='' || lscount==0)
	{
		$('#max_lead_source_count_err').html('Lead Source Count is required!');
		err++;
	}
	else
	{
		$('#max_lead_source_count_err').html('');
	}
	if(scount=='' || scount==0)
	{
		$('#max_supplier_count_err').html('Supplier Count is required!');
		err++;
	}
	else
	{
		$('#max_supplier_count_err').html('');
	}
	if(spbed=='' || spbed==0)
	{
		$('#supplier_point_before_err').html('Before End Date Point is required!');
		err++;
	}
	else
	{
		$('#supplier_point_before_err').html('');
	}
	if(spoed=='' || spoed==0)
	{
		$('#supplier_point_ondate_err').html('On End Date Point is required!');
		err++;
	}
	else
	{
		$('#supplier_point_ondate_err').html('');
	}
	if(spaed=='' || spaed==0)
	{
		$('#supplier_point_after_err').html('After End Date Point is required!');
		err++;
	}
	else
	{
		$('#supplier_point_after_err').html('');
	}
    if(err>0){ return false; }else{ return true; }
}
</script>

	</body>
	<!-- end::Body -->
</html>