<?php
// To get info email details
$email_id = $email_details->email_name;
$password = aes128Decrypt('arjunerp',$email_details->password);
$smtp_name = $email_details->smtp_host;
/* connect to gmail */
$hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}[Gmail]/Bin';
$username = $email_id;
$password = $password;

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
/* grab emails */
$emails = imap_search($inbox,'ALL');

// In Box count
$inbox_hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}INBOX';
$inbox_count = imap_open($inbox_hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
/* grab emails */
$unseen_emails = imap_search($inbox_count,'UNSEEN');
if (is_array($unseen_emails)) {
            $inbox_unread_count = count($unseen_emails);
        } else {
            $inbox_unread_count = 0;
        }
        
//$inbox_unread_count = COUNT($unseen_emails);
?>

    <!--  Search Ends Here -->
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
	               <!--  <a href="#" onclick="show_spam_list();" class="list-group-item text-semibold">
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
	        <div class="panel">
	            <div id="mailbox-email-list" class="panel-body">
	                <h1 class="page-header text-overflow pad-btm">Trash</h1>
	
                     <div class="row">
                    <div class="col-md-12">
                        <div class="panel with-nav-tabs panel-default" style="border: 1px solid #ffffff !important;">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1default">
                                            <!--Mail list group-->
                                            <ul id="mailbox-mail-list" class="mail-list">
                                                
                                                <?php 

                                                    if(!empty($emails))
                                                    {
                                                       rsort($emails); 
                                                       /* for every email... */
                                                        foreach($emails as $key=>$email_number)
                                                        {
                                                            $header = imap_headerinfo($inbox, $email_number);
                                                            $fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                                                            /* get information specific to this email */
                                                            $overview = imap_fetch_overview($inbox,$email_number,0); 
                                                            $message  = imap_fetchbody($inbox,$email_number,2);
                                                            /* get mail structure */
															$structure = imap_fetchstructure($inbox, $email_number);
															$attachments = getAttachments($inbox, $email_number, $structure, "");
                                                        ?>
                                                            <!--Mail list item-->
                                                            <li class="<?php echo ($overview[0]->seen == 0) ? 'mail-list-unread' : ''; ?> mail-attach">
                                                                <div class="mail-control">
                                                                    <input id="email-list-1" class="magic-checkbox" type="checkbox">
                                                                    <label for="email-list-1"></label>
                                                                </div>
                                                                <div class="mail-star"><a href="#"><i class="mailbox-psi-star"></i></a></div>
                                                                <div class="mail-from"><a href="#"><?php echo $overview[0]->from; ?></a></div>
                                                                <div class="mail-time"><?php echo date('d M', strtotime($overview[0]->date)); ?></div>
                                                                <div class="mail-attach-icon"></div>
                                                                 <?php
                                                            	if(!empty($attachments))
																{ ?>
																	 <div class="mail-attach-icon">
	                                                                	<i class="mailbox-psi-paperclip" title="<?php echo $attachments[0]['name']; ?>"></i>
	                                                                </div>
	                                                                <div class="mail-subject">
	                                                                    <a href="<?php echo base_url(); ?>inbox/email_message_view/<?php echo $email_number; ?>/<?php echo $e_id; ?>/Bin"><?php echo $overview[0]->subject; ?> - <?php echo $attachments[0]['name']; ?> </a>
	                                                                </div>

																<?php }else{ ?>

																	 <div class="mail-subject">
                                                                <a href="<?php echo base_url(); ?>inbox/email_message_view/<?php echo $email_number; ?>/<?php echo $e_id; ?>/Bin"><?php echo $overview[0]->subject; ?>  <?php //echo imap_qprint($message); ?> </a>
                                                            </div>
																<?php } ?>
                                                            </li>
                                                        <?php }

                                                    }else{ ?>
                                                        <p>No Record Found</p>
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
	
	
	            <!--Mail footer-->
	            <!--<div class="panel-footer clearfix">-->
	            <!--    <div class="pull-right">-->
	            <!--        <span class="text-muted"><strong>1-50</strong> of <strong>160</strong></span>-->
	            <!--        <div class="btn-group btn-group">-->
	            <!--            <button type="button" class="btn btn-default">-->
	            <!--                <i class="mailbox-psi-arrow-left"></i>-->
	            <!--            </button>-->
	            <!--            <button type="button" class="btn btn-default">-->
	            <!--                <i class="mailbox-psi-arrow-right"></i>-->
	            <!--            </button>-->
	            <!--        </div>-->
	            <!--    </div>-->
	            <!--</div>-->
	        </div>
	    </div>
	</div>
    <?php imap_close($inbox); ?>
