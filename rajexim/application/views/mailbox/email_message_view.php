<?php $this->load->view('common_header');

// To get info email details
$email_id = $email_details->email_name; 
$password = aes128Decrypt('arjunerp',$email_details->password);
$smtp_name = $email_details->smtp_host;

/* connect to gmail */
$hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}'.str_replace('_', ' ',$email_label);
//echo $hostname;die;
$username = $email_id;
$password = $password;
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

/* grab emails */
$header = imap_headerinfo($inbox, $msgno);
$overview = imap_fetch_overview($inbox, $msgno,0);
$subject = $overview[0]->subject;
$msg_date = $overview[0]->date;
//$message = imap_fetchbody($inbox,$msgno,2);


$from_details = $header->from;


function get_mime_type(&$structure) {
   $primary_mime_type = array("TEXT", "MULTIPART","MESSAGE", "APPLICATION", "AUDIO","IMAGE", "VIDEO", "OTHER");
   if($structure->subtype) {
   	return $primary_mime_type[(int) $structure->type] . '/' .$structure->subtype;
   }
   	return "TEXT/PLAIN";
   }
   function get_part($stream, $msg_number, $mime_type, $structure = false,$part_number    = false) {
   
   	if(!$structure) {
   		$structure = imap_fetchstructure($stream, $msg_number);
   	}
   	if($structure) {
   		if($mime_type == get_mime_type($structure)) {
   			if(!$part_number) {
   				$part_number = "1";
   			}
   			$text = imap_fetchbody($stream, $msg_number, $part_number);
   			if($structure->encoding == 3) {
   				return imap_base64($text);
   			} else if($structure->encoding == 4) {
   				return imap_qprint($text);
   			} else {
   			return $text;
   		}
   	}
   
		if($structure->type == 1) /* multipart */ {
   		while(list($index, $sub_structure) = each($structure->parts)) {
   			if($part_number) {
   				$prefix = $part_number . '.';
   			}
   			$data = get_part($stream, $msg_number, $mime_type, $sub_structure,$prefix .    ($index + 1));
   			if($data) {
   				return $data;
   			}
   		} // END OF WHILE
   		} // END OF MULTIPART
   	} // END OF STRUTURE
   	return false;
   } // END OF FUNCTION

function transformHTML($str) {
   if ((strpos($str,"<HTML") < 0) || (strpos($str,"<html")    < 0)) {
  		$makeHeader = "<html><head><meta http-equiv=\"Content-Type\"    content=\"text/html; charset=iso-8859-1\"></head>\n";
   	if ((strpos($str,"<BODY") < 0) || (strpos($str,"<body")    < 0)) {
   		$makeBody = "\n<body>\n";
   		$str = $makeHeader . $makeBody . $str ."\n</body></html>";
   	} else {
   		$str = $makeHeader . $str ."\n</html>";
   	}
   } else {
   	$str = "<meta http-equiv=\"Content-Type\" content=\"text/html;    charset=iso-8859-1\">\n". $str;
   }
   	return $str;
 }

 // GET TEXT BODY
   $dataTxt = get_part($inbox, $msgno, "TEXT/PLAIN");
   
   // GET HTML BODY
   $dataHtml = get_part($inbox, $msgno, "TEXT/HTML");
   //echo "<pre>";
   //print_r($msgBody);die;
   
   if ($dataHtml != "") {
	$message = transformHTML($dataHtml);
 } else {
   $message = ereg_replace("\n","<br>",$dataTxt);
   $message = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i","$1http://$2",    $message);
   $message = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i","<A    TARGET=\"_blank\" HREF=\"$1\">$1</A>", $message);
   $message = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i","<A    HREF=\"mailto:$1\">$1</A>",$message);
 }
 $structure = imap_fetchstructure($inbox, $msgno);
 $attachments = getAttachments($inbox, $msgno, $structure, "");
 
 // To get inbox count
/* connect to gmail */
$hostname1 = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}INBOX';
/* try to connect */
$inbox_count = imap_open($hostname1,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

$unseen_emails = imap_search($inbox_count,'UNSEEN');
if (is_array($unseen_emails)) {
        $unseen_emails = count($unseen_emails);
    } else {
        $unseen_emails = 0;
    }
    

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
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="javascript:;" class="m-nav__link">
											<span class="m-nav__link-text">Mail Box</span>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="javascript:;" class="m-nav__link">
											<span class="m-nav__link-text">Mail View</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">

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
	                               					<option value="<?php echo $email_list->email_id; ?>" <?php if($e_id == $email_list->email_id){ echo 'selected'; }else{ echo ''; } ?>><?php echo $email_list->email_name; ?></option>
	                               				<?php }
	                               			}
	                               		?>
	                               </select>
	                            </div>
	                        </div>
                        </div>

                    </div>
        		 <!--  email Ends Here -->
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
						                    <span class="badge badge-success pull-right"><?php echo ($unseen_emails>0) ? $unseen_emails : ''; ?></span>
						                    <span class="text-main"><i class="mailbox-pli-inbox-full icon-lg icon-fw"></i> Inbox</span>
						                </a>
						                
						                <a href="javascript:;" onclick="show_sent_list();" class="list-group-item">
						                    <i class="mailbox-pli-mail-send icon-lg icon-fw"></i>
						                    Sent
						                </a>
						                
						                <a href="javascript:;" onclick="show_trash_list();" class="list-group-item">
						                    <i class="mailbox-pli-recycling icon-lg icon-fw"></i>
						                    Trash
						                </a>
						                
						            </div>
						
						        </div>
						    </div>
						    <!-- VIEW MESSAGE -->
					        <!--===================================================-->
					        <div class="panel col-md-9">
					            <div class="panel-body">
					                <div class="mar-btm pad-btm bord-btm">
					                    <h1 class="page-header text-overflow">
					                        <!-- <span class="label label-normal label-info">Business</span> -->
					                        <?php echo str_replace('%20', ' ', $subject); ?> [<?php $re_label =  str_replace('[Gmail]/', ' ', $email_label); 
					                    echo  str_replace('_', ' ', $re_label); 
					                ?>]
					                    </h1>
					                </div>
					                <div class="row">
					                    <div class="col-sm-7">
					
					                        <!--Sender Information-->
					                        <div class="media">
					                            <span class="media-left">

					                                <!-- <img src="images/user/1.png" class="img-circle img-sm" alt="Profile Picture"> -->
					                            </span>
					                            <div class="media-body">
					                                <div class="text-bold"><?php echo $overview[0]->from; ?><span class="text-muted"><a href="">[<?php echo $from_details[0]->mailbox.'.'.$from_details[0]->host; ?>]</a></span></div>
					                                
					                                
					                            </div>
					                        </div>
					                    </div>
					                    <hr class="hr-sm visible-xs">
					                    <div class="col-sm-5 clearfix">
					
					                        <!--Details Information-->
					                        <div class="pull-right text-right">
					                            <p class="mar-no"><small class="text-muted"><?php echo date('d M Y, H:s', strtotime($msg_date)); ?></small></p>
					                            <a href="#">
					                                <strong>
					                                	<?php
					                                		if(!empty($attachments))
					                                		{ 
					                                			foreach($attachments as $attachment) {?>
					                                			<a href="javascript:;" download onclick="download_attach(<?php echo $msgno; ?>, <?php echo $e_id; ?>, '<?php echo str_replace('_', ' ',$email_label); ?>')"><?php echo $attachment['name']; ?> <i class="mailbox-psi-paperclip icon-fw"></i>
					                                		<?php }	}?></strong>
					                                
					                            </a>
					                        </div>
					                    </div>
					                </div>
					
					                <!--Message-->
					                <!--===================================================-->
					                <div class="pad-ver bord-ver">
					                   <?php echo $message; ?>
					                </div>
					                <!--===================================================-->
					                <!--End Message-->

					                <!--Quick reply : Summernote Placeholder -->
					                <div id="mailbox-mail-textarea" class="mail-message-reply bg-gray-light">
					                    <strong><span onclick="reply_mail();">Reply</span></strong> or <strong><span onclick="forward_mail();">Forward</span></strong> this message...
					                </div> 
					
					                <!--Send button-->
					                <!-- <div class="pad-ver">
					                    <button id="mailbox-mail-send-btn" type="button" class="btn btn-primary hide">
					                        <span class="mailbox-psi-mail-send icon-lg icon-fw"></span>
					                        Send Message
					                    </button>
					                </div> -->
					            </div>
					        </div>
					        <!--===================================================-->
					        <!-- END VIEW MESSAGE -->
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

      <!--Delete Email ID-->
      <div class="container">
         <div class="modal fade" id="email_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form class="" method="POST" action="<?php echo base_url(); ?>email/email_delete">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
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
                  	 <input type="hidden" name="e_id" id="e_id">
                     <button type="submit" class="btn btn-primary">Yes</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  </div>
               </div>
            </div>
        	</form>
         </div>
      </div>
      <!--end::Modal-->
    <!--jQuery [ REQUIRED ]-->
    <script src="<?php echo base_url();?>assets/mailbox/js/jquery.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url();?>assets/mailbox/js/bootstrap.js"></script>
 <script src="<?php echo base_url();?>assets/mailbox/js/mailbox.js"></script>   
<script>
var baseurl = '<?php echo base_url(); ?>';


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
	$.ajax({
	type: "POST",
	url: baseurl+'inbox/compose_mail',
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

function download_attach(msgno, e_id, label)
{
	$.ajax({
	type: "POST",
	url: baseurl+'inbox/download_attach',
	async: false,
	type: "POST",
	data: "e_id="+e_id+"&msgno="+msgno+"&label="+label,
	dataType: "html",
	success: function(response)
		{
			//alert('downloaded');
			
			//window.location.href = response;
			
			
			
			
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
	function reply_mail()
	{
	    var val = $('#info_email').val();
	    var msg_no = '<?php echo $msgno; ?>';
	    var email_label = '<?php echo $email_label; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/reply_mail',
		async: false,
		type: "POST",
		data: "e_id="+val+"&msg_no="+msg_no+"&email_label="+email_label,
		dataType: "html",
		success: function(response)
			{
			   
				$('#email_list_view').empty().append(response);
				
			}
		});
	}
	
	function forward_mail()
	{
	    var val = $('#info_email').val();
	    var msg_no = '<?php echo $msgno; ?>';
	    var email_label = '<?php echo $email_label; ?>';
		$.ajax({
		type: "POST",
		url: baseurl+'inbox/forward_mail',
		async: false,
		type: "POST",
		data: "e_id="+val+"&msg_no="+msg_no+"&email_label="+email_label,
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