<?php $this->load->view('common_header'); 
$date_format = get_common_date_format();
?>
<!--MailBox Stylesheet [ REQUIRED ]-->
<!--Bootstrap Stylesheet [ REQUIRED ]-->
<link href="<?php echo base_url();?>assets/mailbox/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/mailbox/css/mailbox.css" rel="stylesheet">
<!-- MailBox Premium Icon -->
<link href="<?php echo base_url();?>assets/mailbox/css/mailbox/mailbox-icons.css" rel="stylesheet">
<!--mailbox [ DEMONSTRATION ]-->
<link href="<?php echo base_url();?>assets/mailbox/css/mailbox/mailbox.css" rel="stylesheet">
<!--Magic Checkbox [ OPTIONAL ]-->
<link href="<?php echo base_url();?>assets/mailbox/css/mailbox/magic-check.css" rel="stylesheet">
<!--Summernote [ OPTIONAL ]-->
<link href="<?php echo base_url();?>assets/mailbox/js/summernote/summernote.css" rel="stylesheet">
<style type="text/css">
	
	.no-js #loader { display: none;  }
		.js #loader { display: block; position: absolute; left: 100px; top: 0; }
		.se-pre-con {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url("http://smallenvelop.com/wp-content/uploads/2014/08/Preloader_2.gif") center no-repeat #fff;
		}
		.raj_exim_theme_color {
			background: #335291;
		}
		.comp_email_id_option_block .dropdown.bootstrap-select.form-control.m-bootstrap-select.m_{
			width: 225px;
		}
		.mailbox_load_opacity {
			opacity: 0.5;
		}
</style>
			<div class="m-grid__item m-grid__item--fluid m-wrapper" id="mailbox_container_div">

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
                              <a href="<?php echo base_url(); ?>MailBox" class="m-nav__link">
                                 <span class="m-nav__link-text">Mail Box</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>MailBox" class="m-nav__link">
                                 <span class="m-nav__link-text">Mail Box List</span>
                              </a>
                           </li>
								</ul>
							</div>
						</div>
					</div>
				<!-- END: Subheader -->
				<div class="m-content">
					<div class="alert alert-success" role="alert" id="compose_email_sent" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
						Mail Sent Successfully
					</div>

					<div class="alert alert-success" role="alert" id="mail_attach_import_msg" style="display: none;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
						Mail Attachement Imported Successfully
					</div>
					<?php if($this->session->flashdata('mail_success')){?>
                <div class="alert alert-success" role="alert" id="">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
						<?php echo $this->session->flashdata('mail_success'); ?>
					</div>
	            <?php } ?>

				<?php if($this->session->flashdata('mail_err')){?>
                    <div class="alert alert-danger" role="alert" id="">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
						<?php echo $this->session->flashdata('mail_err'); ?>
					</div>
	            <?php } ?>

	            <div class="alert alert-success" role="alert" id="mail_import_result" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
						Mail Imported Successfully
				</div>	
				<div class="alert alert-danger" role="alert" id="mail_import_result_err" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
						Fail to Import the Mail  
				</div>
				<!--  Select email Here -->
				<!-- <form action="<?php //echo base_url(); ?>/Mailbox" method = "POST" id = "company_email_change_form"> -->
					
	                <div class="row">
	                	<div class="col-md-2" style="margin-top: 15px!important;max-width: 178px;">
	                		<label class="label" style="color: #000; font-size: 18px; padding-left: 0px;">Select Email</label>
	                	</div>
	                    <div class="col-md-3">
	                        <div class="form-group m-form__group comp_email_id_option_block">
	                               <select name="info_email" id="info_email" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="width:auto;" onchange="get_mail_content_block(this.value);">
	                               	<option value="">Choose Email</option>

	                               	<?php 
	                               		$users_emails = $this->session->userdata('user_own_emails');
	                               		if (count($users_emails) > 0) {
	                               			foreach ($users_emails as $key => $user_email) {
	                               				$users_email_info = get_users_mail_details_if_exist($user_email['user_emails']);	
		                               			if(count($users_email_info) > 0){
		                               				echo "<option value=".$users_email_info->email_detail_id.">".$users_email_info->email_ID."</option>"; 
		                               			}
	                               			}
	                               		}
	                               	 ?>
                               		<?php
                               			if(!empty($email_lists))
                               			{
                               				foreach ($email_lists as $key => $email_list) { ?>
                               					<option value="<?php echo $email_list->email_detail_id; ?>" <?php if($default_email == $email_list->email_detail_id){ echo 'selected'; }else{ echo ''; } ?>><?php echo $email_list->email_ID; ?></option>
                               				<?php }
                               			}
                               		?>
	                               </select>
	                        </div>
	                    </div>
	                    <div class="col-md-3">
	                    	<div id="email_calling" style="display: none; height: 0px;">
								<p class="text-center" style="margin-top: 9px;font-weight: bold;padding-right: 122px;color: #325191;"><span id="wait">Connecting to Email Server</span></p> 
							</div>
	                    </div>
	                </div>
	                <!-- <div class="alert raj_exim_theme_color" role="alert" id="email_calling" style="display: none; height: 0px;">
						<p class="text-center" style="color: white;margin-top: -9px;"><span id="wait">Connecting to Email Server</span></p> 
					</div> -->
                <!-- </form> -->
    		 <!--  email Ends Here --> 
    				<div id="mail_content_append_block">
    					<div class="row">
    						<div class="col-md-5">
    							
    						</div>
    						<div class="col-md-7">
    							<!-- <img src="<?php echo base_url(); ?>assets/images/mail_loader.gif" id="mailbox_loader_img" height="100px" width="100px" style="display: none;margin-top: 93px;"> -->
    							<img src="<?php echo base_url(); ?>assets/demo/demo12/media/img/logo/aero_world2.gif" id="mailbox_loader_img" height="100px" width="100px" style="display: none;margin-top: 93px;">
    						</div>
    					</div>
    				</div>
				</div>
			</div>
		</div>
		<!-- <img src="<?php //echo base_url(); ?>assets/images/blue_dots_gif.gif" id="mailbox_loader_img" height="100px" width="100px"> -->
		<!-- end:: Body -->

		<!-- begin::Footer -->
		<?php $this->load->view('common_footer'); ?>

		<!-- end::Footer -->
	</div>

	<!-- end:: Page -->
			
	<!--begin::Modal-->

	<!--Edit email-->
		<div class="container">
			<div class="modal fade" id="edit_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				
			</div>
		</div>

	      <!--Add Email ID-->
	      <div class="container">
	         <div class="modal fade" id="create_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	            
	         </div>
	      </div>
	      <div class="container">
			   <div class="modal fade" id="import_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			      <div class="modal-dialog" role="document">
			         <div class="modal-content">
			            
			               <div class="modal-header">
			                  <h5 class="modal-title" id="exampleModalLabel">Convert as Lead</h5>
			                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">&times;</span>
			                  </button>
			               </div>
			               <div class="modal-body">
			                  <p>Are You Sure, You Want to Convert this Email as Lead?</p>
			               </div>
			               <div class="modal-footer">
			                  <input type="hidden" name="info_email_id" id="info_email_id" value="">
			                  <input type="hidden" name="msg_no" id="msg_no">
			                  <input type="hidden" name="content" id="content">
			                  <button type="button" onclick="save_to_lead();" id="save_lead_btn" class="btn btn-primary">Yes</button>
			                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			               </div>
			            
			         </div>
			      </div>
			   </div>
			</div>
			<div class="container">
			   <div class="modal fade" id="normal_import_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			      <div class="modal-dialog" role="document">
			         <div class="modal-content">
			            
			               <div class="modal-header">
			                  <h5 class="modal-title" id="exampleModalLabel">Import to Lead</h5>
			                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">&times;</span>
			                  </button>
			               </div>
			               <div class="modal-body">
			                  <p>Are You Sure, You Want to Convert this Email as Lead?</p>
			               </div>
			               <div class="modal-footer">
			                  <input type="hidden" name="normal_info_email_id" id="normal_info_email_id" value="">
			                  <input type="hidden" name="normal_msg_no" id="normal_msg_no">
			                  <input type="hidden" name="normal_content" id="normal_content">
			                  <button type="button" onclick="normal_save_to_lead();" id="normal_save_lead_btn" class="btn btn-primary">Yes</button>
			                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			               </div>
			            
			         </div>
			      </div>
			   </div>
			</div>

			<div class="container">
			   <div class="modal fade" id="create_lead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    
			   </div>
			</div>

			<div class="container">
			   <div class="modal fade" id="compose_mail_modal"  data-keyboard="false" data-backdrop = "static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    
			   </div>
			</div>

			<div class="container">
			   <div class="modal fade" id="import_lead_attachment_modal"  data-keyboard="false" data-backdrop = "static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    
			   </div>
			</div>

	    <!--jQuery [ REQUIRED ]-->
	    <!--<script src="<?php //echo base_url();?>assets/mailbox/js/jquery.js"></script>-->
	    <!--BootstrapJS [ RECOMMENDED ]-->
	    <script src="<?php echo base_url();?>assets/mailbox/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>assets/mailbox/js/mailbox.js"></script> 

	 
	<script>
	var text = ["Fetching . . .", "Retrieving . . ."];
	var counter = 0;
	var elem = document.getElementById("wait");
	var inst = setInterval(change, 6000);

	function change() {
	  elem.innerHTML = text[counter];
	  counter++;
	  if (counter >= text.length) {
	    counter = 0;
	    // clearInterval(inst); // uncomment this if you want to stop refreshing after one cycle
	  }
	}

	//Dot running loading starts here

    // window.dotsGoingUp = true;
    // var dots = window.setInterval( function() {
    // var wait = document.getElementById("wait");
    // if ( window.dotsGoingUp ) 
    //     wait.innerHTML += " . ";
    // else {
    //     wait.innerHTML = wait.innerHTML.substring(1, wait.innerHTML.length);
    //     if ( wait.innerHTML === "")
    //         window.dotsGoingUp = true;
    // }
    // if ( wait.innerHTML.length > 10 )
    //     window.dotsGoingUp = false;



    // }, 100);

    // var dots = window.setInterval( function() {
    // var wait = document.getElementById("wait");
    // if ( wait.innerHTML.length > 3 ) 
    //     wait.innerHTML = "";
    // else 
    //     wait.innerHTML += " . ";
    // }, 1000);

    // Dot running
		$(document).ready(function(){
			$('#info_email').val('');
			$('.m_selectpicker').selectpicker('refresh');
		});
	var baseurl = '<?php echo base_url(); ?>';
	$('#alertaddmessage').fadeIn().delay(3000).fadeOut();
	function get_mail_content_block(val)
	{	
		$('#email_calling').show();
		$('#mailbox_container_div').addClass("mailbox_load_opacity");
		$('#mailbox_loader_img').show();
		$.ajax({
		type: "POST",
		url: baseurl+'Mailbox/email_content_block',
		type: "POST",
		data:{'email_id':val },
		dataType: "html",
		
		success: function(response)
		{	
			$('#email_calling').hide();
			$('#mailbox_container_div').removeClass("mailbox_load_opacity");
			$('#mailbox_loader_img').hide();
			$('#mail_content_append_block').empty().append(response);	
		}
		
		});
	}
	
	
	
var er = 0;
function email_id_unique(val) 
{
   $.ajax({
      type: "POST",
      url:baseurl+'Leads/lead_email_id_exits',
      data:{'value':val},
      async: false,
      dataType: "html",
      success: function(result){
         if(result > 0)
         {
            $('#email_id_err').html('Email ID already exists!');
            er = 1;
         }else{
            er = 0;
         }
         
      }
   });
}
function lead_validation()
{
   var err = 0;
   var lead_name = $('#lead_name').val();
   
   var country = $('#country').val();
   
   var email_id = $('#email_id').val();
   
   
   var product_id = $('#product_id').val();
   var lead_source = $('#lead_source').val();
   var lead_type = $('#lead_type').val();
   var lead_status = $('#lead_status').val();
   var assigned_to = $('#assigned_to').val();
   
   
   
   
   if(lead_name == '')
   {
      $('#lead_name_err').html('Lead Name is required!');
      err++;
   }else{
      $('#lead_name_err').html('');
   }  
   if(country == '')
   {
      $('#country_err').html('Country is required!');
      err++;
   }else{
      $('#country_err').html('');
   } 
  
   
   if(email_id == '')
   {
         $('#email_id_err').html('Email ID is required!');
           err++;

   }else if(!ValidateEmail(email_id)){ 

           $('#email_id_err').html('Invalid Email ID!');
           err++;
   }else if(er > 0){

      $('#email_id_err').html('Email ID already exists!');
      err++;
   }
   else{
     $('#email_id_err').html('');
   }


   if(product_id.trim()==''){

      $('#product_id_err').html('Product is required!');
      err++;
   }else{
      $('#product_id_err').html('');

   }

   if(lead_source.trim()==''){

      $('#lead_source_err').html('Lead Source is required!');
      err++;
   }else{
      $('#lead_source_err').html('');

   }
    if(lead_type.trim()==''){

      $('#lead_type_err').html('Priority is required!');
      err++;
   }else{
      $('#lead_type_err').html('');

   }
   if(lead_status.trim()==''){

      $('#lead_status_err').html('Lead Status is required!');
      err++;
   }else{
      $('#lead_status_err').html('');

   }

   if(assigned_to.trim()==''){

      $('#assigned_to_err').html('Assigned To is required!');
      err++;
   }else{
      $('#assigned_to_err').html('');

   }
 
   if(err>0){ return false; }else{ return true; }
}  
// To check only digit values
function isNumber(evt,id_val)
{
	evt = (evt) ? evt : window.event;
	if (evt.which != 8 && evt.which != 0 && (evt.which < 48 || evt.which > 57 && evt.which != 46)) {
		$("#"+id_val).html("Digit Only");
		return false;
	}
	else{
		$("#"+id_val).html("");
		return true;
	}
}
// To check empty val
function check_input_empty_values(val, id_val, error_name)
{
	if(val.trim()=='')
	{
		$("#"+id_val).html(error_name + " is required!");
        return true;
	}else{
		$("#"+id_val).html('');
		return false;
	}

}
// To check website is valid or not
function isUrlValid(s) 
{
    var regexp = /^(www:\/\/www\.|http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
    return regexp.test(s);
}
// To validate Email ID
function ValidateEmail(email)
{
	var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	return expr.test(email);
}
	function product_user_list(val) 
	{
	   $.ajax({
	      
	      url:baseurl+'Leads/product_user_list',
	      type:'POST',
	      data:{'value':val},
	      dataType: 'html',

	      success:function(result){

	         var valval = result.split("|");
	         $('#industry_name').val(valval[1]);
	         $('#industry_id').val(valval[2]);
	         $('#assigned_to').empty().append(valval[0]);
	         $('.m_selectpicker').selectpicker('refresh');
	      }
	   });
	}
	function get_chosen_email_mails()
	{
		$('#company_email_change_form').submit();
	}
	function import_attachments_of_lead(msg_no, label, contact_book_id)
	{
		var emailid = $('#info_email').val();
		
		$.ajax({
			url:baseurl+'Mailbox/get_list_of_lead_by_contact_bood_id',
			type:'POST',
			data:{'emailid':emailid, 'msg_no':msg_no, 'label':label, 'contact_book_id':contact_book_id},
			dataType: 'html',

			success:function(result){
				 $('#import_lead_attachment_modal').empty().append(result);
		$('#import_lead_attachment_modal').modal('show');
			}
		});
	}
	function import_into_lead(msgno, label) {
		var emailid = $('#info_email').val();
		$('#info_email_id').empty().val(emailid);
		$('#content').empty().val(label);
		$('#msg_no').empty().val(msgno);
		$('#import_email').modal('show');
	}
	function normal_mail_import_into_lead(msgno, label) {
		var emailid = $('#info_email').val();
		$('#normal_info_email_id').empty().val(emailid);
		$('#normal_content').empty().val(label);
		$('#normal_msg_no').empty().val(msgno);
		$('#normal_import_email').modal('show');	
	}
	
	function save_to_lead()
	{
		$('#save_lead_btn').prop('disabled', true);
		var email = $('#info_email_id').val();
		var msg_no = $('#msg_no').val();
		var label = $('#content').val();
		$('#import_email').modal('toggle');
		window.open(baseurl+'Mailbox/save_mail_to_lead/'+email+'/'+msg_no+'/'+label,'popUpWindow','width=1200,height=800,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
		$('#save_lead_btn').prop('disabled', false);
		// $.ajax({
		// 	type: "POST",
		// 	url: baseurl+'Mailbox/save_mail_to_lead',
		// 	async: false,
		// 	type: "POST",
		// 	data:{'emailid':email, 'msgno':msg_no, 'label':label},
		// 	dataType: "html",
		// 	success: function(response)
		// 	{	
		// 		$('#save_lead_btn').prop('disabled', false);
				// if(response == 1) {				
				// 	$('#save_lead_btn').prop('disabled', false);
				// 	$('#import_email').modal('toggle');
				// 	$('#mail_import_result').show();
				// 	setTimeout(function(){
				// 	   $('#mail_import_result').hide();
				// 	}, 5000);
				// }
				// else {
				// 	$('#mail_import_result_err').show();
				// 	setTimeout(function(){
				// 	   $('#mail_import_result_err').hide();
				// 	}, 5000);	
				// 	$('#save_lead_btn').prop('disabled', false);
				// }
				// $('#create_lead').empty().append(response);
				// $('#create_lead').modal('show');
				
		// 	}
		// });
	}
	function normal_save_to_lead()
	{
		$('#save_lead_btn').prop('disabled', true);
		var email = $('#normal_info_email_id').val();
		var msg_no = $('#normal_msg_no').val();
		var label = $('#normal_content').val();
		$('#normal_import_email').modal('toggle');
		window.open(baseurl+'Mailbox/normal_save_mail_to_lead/'+email+'/'+msg_no+'/'+label,'popUpWindow','width=1200,height=800,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
		$('#save_lead_btn').prop('disabled', false);
		// $.ajax({
		// 	type: "POST",
		// 	url: baseurl+'Mailbox/normal_save_mail_to_lead',
		// 	async: false,
		// 	type: "POST",
		// 	data:{'emailid':email, 'msgno':msg_no, 'label':label},
		// 	dataType: "html",
		// 	success: function(response)
		// 	{	
				// if(response == 1){				
				// 	$('#normal_save_lead_btn').prop('disabled', false);
				// 	$('#normal_import_email').modal('toggle');
				// 	$('#mail_import_result').show();
				// 	setTimeout(function(){
				// 	   $('#mail_import_result').hide();
				// 	}, 5000);
				// }
				// else {
				// 	$('#mail_import_result_err').show();
				// 	setTimeout(function(){
				// 	   $('#mail_import_result_err').hide();
				// 	}, 5000);	
				// 	$('#normal_save_lead_btn').prop('disabled', false);
				// }
		// 		$('#create_lead').empty().append(response);
		// 		$('#create_lead').modal('show');
		// 	}
		// });
	}
	
    
    function compose_mail()
    {
    	var info_email = $('#info_email').val();
    	var email_name = $('#email_name').val();
		// $.ajax({
		// 	type: "POST",
		// 	url: baseurl+'Mailbox/compose_mail',
		// 	async: false,
		// 	type: "POST",
		// 	data:{'info_email':info_email},
		// 	dataType: "html",
		// 	success: function(response)
		// 	{
		// 		// $('#email_list_view').empty().append(response);
				
		// 	}
		// });
		window.open(baseurl+'Mailbox/compose_mail/'+email_name,'popUpWindow','height=600,width=700,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
    }

	</script>
		</body>
		<!-- end::Body -->
</html>