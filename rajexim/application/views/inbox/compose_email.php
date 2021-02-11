<?php 
$email_id = $email_details->email_ID;
$password = decryptthis($email_details->password, 'Rajexim2020');
$smtp_name = $email_details->smtp_host;
/* connect to gmail */
//$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}INBOX';
$username = $email_id;
$password = $password;

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
/* grab emails */
//$inbox_unread_count = imap_search($inbox,'UNSEEN');
$emails = imap_search($inbox,'ALL');
$unseen_emails = imap_search($inbox,'UNSEEN');
$inbox_unread_count = COUNT($unseen_emails);
?>
 <!--Summernote [ OPTIONAL ]-->
    <script src="<?php echo base_url();?>assets/mailbox/js/summernote/summernote.js"></script>
     <!--Mail [ SAMPLE ]-->
    <script src="<?php echo base_url();?>assets/mailbox/js/mail.js"></script>
<div class="row">

					        <!--===================================================-->
					        
						        <div class="col-md-12">
							            <div class="panel">
								            <div class="panel-body">
								                <div class="mar-btm pad-btm clearfix">
								                    <!--Cc & bcc toggle buttons-->
								                    <div class="pull-right pad-btm">
								                        <div class="btn-group">
								                            <button id="mailbox-toggle-cc" data-toggle="button" type="button" class="btn btn-sm btn-default btn-active-info">Cc</button>
								                            <button id="mailbox-toggle-bcc" data-toggle="button" type="button" class="btn btn-sm btn-default btn-active-info">Bcc</button>
								                        </div>
								                    </div>
								
								                    <h1 class="page-header text-overflow">
								                        Compose Message
								                    </h1>
								                </div>
								                <!--Input form onsubmit="return send_compose_validation();"-->
								                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Leads/send_compose_mail"  enctype="multipart/form-data" >
								                    <input type="hidden" id="from_email" name="from_email" value="<?php echo $email_details->email_ID;?>">
								                    <input type="hidden" id="e_id" name="e_id" value="<?php echo $e_id;?>">
								                    <div class="form-group">
								                        <label class="col-lg-1 control-label text-left" for="inputEmail">To</label>
								                        <div class="col-lg-11">
								                            <input type="text" id="to_email" name="to_email" class="form-control" value="<?php echo ($search_email_id) ? $search_email_id: ''; ?>" <?php echo ($search_email_id) ? 'readonly': ''; ?>>
								                        </div>
								                    </div>
								                    <div id="mailbox-cc-input" class="hide form-group">
								                        <label class="col-lg-1 control-label text-left" for="inputCc">Cc</label>
								                        <div class="col-lg-11">
								                            <input type="text" id="cc_email" name="cc_email" class="form-control">
								                        </div>
								                    </div>
								                    <div id="mailbox-bcc-input" class="hide form-group">
								                        <label class="col-lg-1 control-label text-left" for="inputBcc">Bcc</label>
								                        <div class="col-lg-11">
								                            <input type="text" id="bcc_email" name="bcc_email" class="form-control">
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-lg-1 control-label text-left" for="inputSubject">Subject</label>
								                        <div class="col-lg-11">
								                            <input type="text" id="sub_email" name="sub_email"  class="form-control">
								                        </div>
								                    </div>

								                    <div class="form-group">
								                        <label class="col-lg-1 control-label text-left" for="inputSubject">Attachment</label>
								                        <div class="col-lg-11">
								                            <!--Attact file button-->
												                <div class="media pad-btm">
												                    <div class="media-left">
												                        <span class="btn btn-default btn-file">
												                            Attachment <input type="file" name="attach_email[]" id="attach_email" multiple>
												                        </span>
												                    </div>
												                    <div id="mailbox-attach-file" class="media-body"></div>
												                </div>
								                        </div>
								                    </div>
								                <!--Wysiwyg editor : Summernote placeholder-->
								                <textarea name="content_email" id="mailbox-mail-compose"></textarea>
								                <!-- <div ></div> -->
								
								                <div class="pad-ver pull-right">
								
								                 <input type="hidden" name="lead_id" value="<?php echo ($lead_id) ? $lead_id : ''; ?>">
								                 
								                    <!--Send button-->
								                    <button id="mail-send-btn" type="submit" name="btn_submit"  class="btn btn-primary">
								                        <i class="mailbox-psi-mail-send icon-lg icon-fw"></i> Send Mail
								                    </button>
								                </div>

							            </form>
								            </div>
							        </div>
						    	</div>
					        
					        <!--===================================================-->
					        <!-- END COMPOSE EMAIL -->
</div></div>

