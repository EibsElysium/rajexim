<?php $this->load->view('common_header'); 
	// To get info email details
	$email_id = $email_details->email_name; 
	$password =  aes128Decrypt('arjunerp',$email_details->password);
	$smtp_name = $email_details->smtp_host;
	/* connect to gmail */
	$hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}INBOX';
	$username = $email_id;
	$password = $password;
	/* try to connect */
	$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
	/* grab emails */
	$emails_count = 0;
	$from_name = '';
	$next_start = 1;
	if($search_email_id != '')
	{
	       $from_name = $search_email_id;
	       if($from_name != '')
	       {
	         $name = $from_name;
        	 $emails_count = COUNT(imap_search($inbox, 'FROM "'.$name.'"'));
        	 $emails_count_val = imap_search($inbox, 'FROM "'.$name.'"');
	       	 rsort($emails_count_val);
	       	 $p_start = 0;
	       	 $end = (count($emails_count_val) > $per_page) ? $per_page : count($emails_count_val);
	       	 $emails_count_val = array_slice($emails_count_val,$p_start,$end);
	       	 $implode_val = implode($emails_count_val, ',');
	       	 $range =$implode_val;
	         $emails_val = imap_fetch_overview($inbox,"$range");
             $emails = array_reverse($emails_val);
            
	       }
	       
	    //}
	}else{
		
		$emails_count = COUNT(imap_search($inbox,'ALL'));
		$end = $emails_count;
        $p_start = $end - ($per_page - 1);
        $p_start = ($p_start > 0) ? $p_start : 1;
        
    	$range = $p_start.':'.$end;
    	$reverse_emails = imap_fetch_overview($inbox,"$range");
        $emails = array_reverse($reverse_emails);

	}
	$unseen_emails = imap_search($inbox,'UNSEEN');
    if (is_array($unseen_emails)) {
            $inbox_unread_count = count($unseen_emails);
        } else {
            $inbox_unread_count = 0;
        }
	//$inbox_unread_count = COUNT($unseen_emails);

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
	    </style>
		</head>
		<!-- end::Head -->
		<!-- begin::Body -->
		<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

			<!-- begin:: Page -->
			<div class="m-grid m-grid--hor m-grid--root m-page">
				<!-- BEGIN: Header -->
				<?php $this->load->view('common_topbar'); ?>
				<!-- END: Header -->
				<!-- begin::Body -->
				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

					<!-- BEGIN: Left Aside -->
					<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
					<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
						<!-- BEGIN: Aside Menu -->
						<?php $this->load->view('common_sidebar'); ?>
						<!-- END: Aside Menu -->
					</div>
					<!-- END: Left Aside -->
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
												<span class="m-nav__link-text">Mail Box</span>
											</a>
										</li>
										<li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
										<li class="m-nav__item">
											<a href="javascript:;" class="m-nav__link">
												<span class="m-nav__link-text">Mail List</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- END: Subheader -->
						<div class="m-content">
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
						<!--  Select email Here -->
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="form-group m-form__group">
		                            <div class="input-group">
		                               <select name="info_email" id="info_email" class="custom-select form-control" onchange="get_info_email_list(this.value);">
		                               		<?php
		                               			if(!empty($email_lists))
		                               			{
		                               				foreach ($email_lists as $key => $email_list) { ?>
		                               					<option value="<?php echo $email_list->email_id; ?>" <?php if($default_email == $email_list->email_id){ echo 'selected'; }else{ echo ''; } ?>><?php echo $email_list->email_name; ?></option>
		                               				<?php }
		                               			}
		                               		?>
		                               </select>
		                            </div>
		                        </div>
	                        </div>

	                    </div>
	        		 <!--  email Ends Here --> 
	                    <?php
	                    	if($search_email_id != ''){ ?>
	                    		<div class="row">
			                        <div class="col-md-12">
			                        	 <h4 class="text-primary text-center"><span>Search Result for <?php echo $search_email_id; ?></span> </h4>
			                        </div>
			                    </div>
	                    <?php } ?>
	                      

	        			<!--  Search Ends Here -->
	        			<div id="email_list_view">
		        			<div class="row">
							    <div class="col-md-3">
							        <div class="panel">
							            <div class="pad-all bord-btm">
							                <a href="javascript:;" onclick="compose_mail();" class="btn btn-block btn-primary">Compose Mail</a>
							            </div>
							
							            <p class="pad-hor mar-top text-main text-bold">Folders</p>
							            <div class="list-group bg-trans pad-btm bord-btm">
							                <a href="javascript:;" onclick="show_inbox_list();" class="list-group-item text-semibold text-main">
							                     <span class="badge badge-success pull-right"><?php echo ($inbox_unread_count > 0) ? $inbox_unread_count : ''; ?></span> 
							                    <span class="text-main"><i class="mailbox-pli-inbox-full icon-lg icon-fw"></i> Inbox</span>
							                </a>
							                <!-- <a href="#" onclick="show_draft_list();" class="list-group-item">
							                    <i class="mailbox-pli-file icon-lg icon-fw"></i>
							                    Draft
							                </a> -->
							                <a href="javascript:;" onclick="show_sent_list();" class="list-group-item">
							                    <i class="mailbox-pli-mail-send icon-lg icon-fw"></i>
							                    Sent
							                </a>
							                <!-- <a href="#" onclick="show_spam_list();" class="list-group-item text-semibold">
							                    <span class="badge badge-danger pull-right">3</span>
							                    <span class="text-main"><i class="mailbox-pli-fire-flame-2 icon-lg icon-fw"></i> Spam</span>
							                </a> -->
							                <a href="javascript:;" onclick="show_trash_list();" class="list-group-item">
							                    <i class="mailbox-pli-recycling icon-lg icon-fw"></i>
							                    Trash
							                </a>
							            </div>
							
							        </div>
							    </div>
							    <div class="col-md-9">
							    	<!-- Image loader -->
									<div id='loader' style='display: none;'>
									   <div class="se-pre-con"></div>
									</div>
									<!-- Image loader -->

							        <div class="panel">
							            <div id="mailbox-email-list" class="panel-body">
							                 <h1 class="page-header text-overflow pad-btm">Inbox
							                 	<?php if(!empty($emails)){ ?>
							                 	<div class="pull-right">
									                    <span class="text-muted" style="font-size: 1rem;"><strong>



									                    <?php echo 1; ?>-<?php 

									                    $end_val = ($start)*$per_page;
									                    if($emails_count > $end_val)
									                    {
									                        $end_val = $end_val;
									                    }else{
									                        $end_val = $emails_count;
									                    }
									                    
									                    echo $end_val; ?></strong> of <strong>
									                    	<?php echo $emails_count; ?></strong></span>
									                   <div class="btn-group btn-group">
									                       <!--<button type="button" class="btn btn-default" >-->
									                       <!--  <i class="mailbox-psi-arrow-left"></i>-->
									                       <!--</button>-->

									                       <?php 
									                       		if($emails_count > $end)
									                       		{ ?>
									                       			 <button type="button" class="btn btn-default">
												                          <i class="mailbox-psi-arrow-right" onclick="show_next_page(<?php echo $next_start+1; ?>);"></i>
												                  	</button>
									                       		<?php } ?>
									                     
									                   </div>
									                </div>
									            <?php } ?>
							                 </h1> 


							                  <!-- <div class="panel-footer clearfix">
									              
									            </div> -->
		                                    <!-- Mail List Starts Here-->
			                                     <div class="row">
								                    <div class="col-md-12">
								                        <div class="panel with-nav-tabs panel-default" style="border: 1px solid #ffffff !important;">
								                        	  <!--Mail footer-->
							          
								                            <div class="panel-body">
								                                <div class="tab-content">
								                                    <div class="tab-pane fade in active" id="tab1default">
								                                            <!--Mail list group-->
								                                            <ul id="mailbox-mail-list" class="mail-list">
								                                                
								                                                <?php if(!empty($emails))
								                                                    {
								                                                       //rsort($emails); 
								                                                       /* for every email... */
								                                                        foreach($emails as $key=>$email_number)
								                                                        {
								                                                             
								                                                                $flag_star = '';
								                                                                	if($email_number->flagged == 1)
								                                                                	{
								                                                                		$flag_star = 'mail-starred';
								                                                                	}else{
								                                                                		$flag_star = '';
								                                                                	}
								                                                                ?>
								                                                            <li class="<?php echo ($email_number->seen == 0) ? 'mail-list-unread' : ''; ?> <?php echo $flag_star; ?> mail-attach ">
								                                                                <div class="mail-control">
								                                                                    <input id="email-list-1" class="magic-checkbox" type="checkbox">
								                                                                    <label for="email-list-1"></label>
								                                                                </div>
								                                                                <div class="mail-star"><a href="#"><i class="mailbox-psi-star"></i></a></div>
								                                                                <div class="mail-from"><a href="#"><?php echo $email_number->from; ?></a></div>
								                                                                <div class="mail-time"><?php echo date('d M', strtotime($email_number->date)); ?></div>
								                                                               

			        																				<div class="mail-subject">
								                                                                    <a href="<?php echo base_url(); ?>inbox/email_message_view/<?php echo $email_number->msgno; ?>/<?php echo $default_email; ?>/INBOX<?php echo ($search_email_id != '') ? '/'.str_replace('@', '_', $search_email_id) : '';?>"> <?php echo $email_number->subject; ?></a>
								                                                                </div>
								                                                               
								                                                               
								                                        					  </li> 
								                                        					<?php } ?>

								                                                   <?php }else{ ?>
										                                                        <li>No Record Found</li>
										                                                   <?php }

										                                                ?>
								                                            </ul>

								                                            <!-- Mail List Ends Here -->
								                                    </div>
								                                    <div class="tab-pane fade" id="tab4default">Your Desired Content</div>
								                                    <div class="tab-pane fade" id="tab5default">Your Desired Content Tab 5</div>
								                                </div>
								                            </div>
								                        </div>
								                    </div>
								                </div>
		                                
		                                    <!-- Mail List Ends Here -->
						
							            </div>
							           
							        </div>
							    </div>
							</div>
					    </div>
						</div>
					</div>
				</div>
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
	    <!--jQuery [ REQUIRED ]-->
	    <!--<script src="<?php //echo base_url();?>assets/mailbox/js/jquery.js"></script>-->
	    <!--BootstrapJS [ RECOMMENDED ]-->
	    <script src="<?php echo base_url();?>assets/mailbox/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>assets/mailbox/js/mailbox.js"></script> 
	 
	<script>
	var baseurl = '<?php echo base_url(); ?>';
	$('#alertaddmessage').fadeIn().delay(3000).fadeOut();
	function get_info_email_list(val)
	{
	    var s_e_id = '<?php echo $search_email_id; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/info_email_list',
		async: false,
		type: "POST",
		data: "e_id="+val+"&start=1&s_e_id="+s_e_id,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		
		});
	}
	function show_inbox_list()
	{	
		var val = $('#info_email').val();
		var s_e_id = '<?php echo $search_email_id; ?>';
		var from_name = '<?php echo $from_name; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/inbox_email_list',
		async: false,
		type: "POST",
		data: "e_id="+val+"&s_e_id="+s_e_id+"&start=1",
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		});
	}

	function show_draft_list()
	{	
		var val = $('#info_email').val();
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/draft_email_list',
		async: false,
		type: "POST",
		data: "e_id="+val,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		});
	}
	function show_sent_list()
	{	
		var val = $('#info_email').val();
		var s_e_id = '<?php echo $search_email_id; ?>';
		var from_name = '<?php echo $from_name; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/sent_email_list',
		async: false,
		type: "POST",
		data: "e_id="+val+"&s_e_id="+s_e_id+"&from_name="+from_name,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		});
	}
	function show_spam_list()
	{	
		var val = $('#info_email').val();
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/spam_email_list',
		async: false,
		type: "POST",
		data: "e_id="+val,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		});
	}

	function show_trash_list()
	{	
		var val = $('#info_email').val();
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/trash_email_list',
		async: false,
		type: "POST",
		data: "e_id="+val,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		});
	}

function compose_mail()
	{
	    var val = $('#info_email').val();
	    var lead_id = '<?php echo ($lead_id) ? $lead_id: ''; ?>';
	    var pi_id = '<?php echo ($pi_id) ? $pi_id: ''; ?>';
	    var o_id = '<?php echo (o_id) ? $o_id: ''; ?>';
	    var s_e_id = '<?php echo $search_email_id; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/compose_mail',
		async: false,
		type: "POST",
		data: "e_id="+val+"&lead_id="+lead_id+"&s_e_id="+s_e_id+"&pi_id="+pi_id+"&o_id="+o_id,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				$('#followup_date').datepicker({ format : 'dd-mm-yyyy', todayHighlight:!0,orientation:"top left"});
				
			}
		});
	}

	function show_next_page(start)
	{
		var val = $('#info_email').val();
		var s_e_id = '<?php echo $search_email_id; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/inbox_email_list',
		async: false,
		type: "POST",
		data: "start="+start+"&e_id="+val+"&s_e_id="+s_e_id,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		});
	}
	
	function show_previous_page(start)
	{
		var val = $('#info_email').val();
		var s_e_id = '<?php echo $search_email_id; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/inbox_email_list',
		async: false,
		type: "POST",
		data: "start="+start+"&e_id="+val+"&s_e_id="+s_e_id,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		});
	}
	
	
	function show_next_sent_page(start)
	{
		var val = $('#info_email').val();
		var s_e_id = '<?php echo $search_email_id; ?>';
		var from_name = '<?php echo $from_name; ?>';
		
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/sent_email_list',
		async: false,
		type: "POST",
		data: "e_id="+val+"&s_e_id="+s_e_id+"&from_name="+from_name+"&start="+start,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		});
	}
	
	function show_previous_sent_page(start)
	{
		var val = $('#info_email').val();
		var s_e_id = '<?php echo $search_email_id; ?>';
		var from_name = '<?php echo $from_name; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/sent_email_list',
		async: false,
		type: "POST",
		data: "start="+start+"&e_id="+val+"&s_e_id="+s_e_id+"&from_name="+from_name,
		dataType: "html",
		success: function(response)
			{
				$('#email_list_view').empty().append(response);
				
			}
		});
	}
	</script>
		</body>
		<!-- end::Body -->
	</html>
<?php imap_close($inbox); ?>