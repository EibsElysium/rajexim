<?php
// To get info email details
$email_id = $email_details->email_name;
$password = aes128Decrypt('arjunerp',$email_details->password);
/* connect to gmail */
$hostname = '{imap.gmail.com:993/imap/ssl}[Gmail]/Spam';
$username = $email_id;
$password = $password;

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
/* grab emails */
$emails = imap_search($inbox,'ALL');

// In Box count
$inbox_hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$inbox_count = imap_open($inbox_hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
/* grab emails */
$unseen_emails = imap_search($inbox_count,'UNSEEN');
$inbox_unread_count = COUNT($unseen_emails);
?>


<!--  Search Starts Here -->
    <!--<div class="row">-->
    <!--    <div class="col-md-12">-->
    <!--        <div class="form-group m-form__group">-->
    <!--            <div class="input-group">-->
    <!--                <input type="text" class="search-query form-control" placeholder="Search" style="height:35px;"/>-->
    <!--                <span class="input-group-btn">-->
    <!--                    <button class="btn btn-primary" type="button">-->
    <!--                        <span class=" glyphicon glyphicon-search"></span>-->
    <!--                    </button>-->
    <!--                </span>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

    <!--</div>-->

    <!--  Search Ends Here -->
	<div class="row">
	    <div class="col-md-3">
	        <div class="panel">
	            <div class="pad-all bord-btm">
	                <a href="mailbox-compose.html" class="btn btn-block btn-primary">Compose Mail</a>
	            </div>
	
	            <p class="pad-hor mar-top text-main text-bold">Folders</p>
	            <div class="list-group bg-trans pad-btm bord-btm">
	                <a href="#" onclick="show_inbox_list();" class="list-group-item text-semibold text-main">
	                    <span class="badge badge-success pull-right"><?php echo ($inbox_unread_count > 0) ? $inbox_unread_count : ''; ?></span>
	                    <span class="text-main"><i class="mailbox-pli-inbox-full icon-lg icon-fw"></i> Inbox</span>
	                </a>
	                <a href="#" onclick="show_draft_list();" class="list-group-item">
	                    <i class="mailbox-pli-file icon-lg icon-fw"></i>
	                    Draft
	                </a>
	                <a href="#" onclick="show_sent_list();" class="list-group-item">
	                    <i class="mailbox-pli-mail-send icon-lg icon-fw"></i>
	                    Sent
	                </a>
	                <a href="#" onclick="show_spam_list();" class="list-group-item text-semibold">
	                    <!--<span class="badge badge-danger pull-right">3</span>-->
	                    <span class="text-main"><i class="mailbox-pli-fire-flame-2 icon-lg icon-fw"></i> Spam</span>
	                </a>
	                <a href="#" onclick="show_trash_list();" class="list-group-item">
	                    <i class="mailbox-pli-recycling icon-lg icon-fw"></i>
	                    Trash
	                </a>
	            </div>
	
	        </div>
	    </div>
	    <div class="col-md-9">
	        <div class="panel">
	            <div id="mailbox-email-list" class="panel-body">
	                <h1 class="page-header text-overflow pad-btm">Spam</h1>
	
	                <!--<div class="row">-->
	                <!--    <div class="col-sm-7">-->
	
	                        <!-- Mail toolbar -->
	                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	
	                        <!--Split button dropdowns-->
	                <!--        <div class="btn-group">-->
	                <!--            <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" style="padding: 0;">-->
                 <!--               <div id="mailbox-checked-all-mail" class="btn btn-sm btn-default" style="border:none !important;">-->
                 <!--                   <input id="select-all-mail" class="magic-checkbox" type="checkbox">-->
                 <!--                   <label for="select-all-mail"></label>-->
                 <!--               </div><i class="dropdown-caret"></i></button>-->
	                <!--            <ul class="dropdown-menu">-->
	                <!--                <li><a href="javascript:void(0)" id="mailbox-select-all-list">All</a></li>-->
	                <!--                <li><a href="javascript:void(0)" id="mailbox-select-none-list">None</a></li>-->
	                <!--                <li><a href="javascript:void(0)" id="mailbox-select-toggle-list">Toggle</a></li>-->
	                <!--                <li class="divider"></li>-->
	                <!--                <li><a href="javascript:void(0)" id="mailbox-select-read-list">Read</a></li>-->
	                <!--                <li><a href="javascript:void(0)" id="mailbox-select-unread-list">Unread</a></li>-->
	                <!--                <li><a href="javascript:void(0)" id="mailbox-select-starred-list">Starred</a></li>-->
	                <!--            </ul>-->
	                <!--        </div>-->
	
	                        <!--Refresh button-->
	                <!--        <button id="mailbox-mail-ref-btn" data-toggle="panel-overlay" data-target="#mailbox-email-list" class="btn btn-default btn-sm" type="button">-->
	                <!--            <i class="mailbox-psi-repeat-2"></i>-->
	                <!--        </button>-->
	
	                        <!--Dropdown button (More Action)-->
	                <!--        <div class="btn-group">-->
	                <!--            <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">-->
	                <!--                More <i class="dropdown-caret"></i>-->
	                <!--            </button>-->
	                <!--            <ul class="dropdown-menu">-->
	                <!--                <li><a href="#">Mark as read</a></li>-->
	                <!--                <li><a href="#">Mark as unread</a></li>-->
	                <!--                <li class="divider"></li>-->
	                <!--                <li><a href="#">Star</a></li>-->
	                <!--                <li><a href="#">Clear Star</a></li>-->
	                <!--            </ul>-->
	                <!--        </div>-->
	                <!--    </div>-->
	                <!--    <hr class="hr-sm visible-xs">-->
	                <!--    <div class="col-sm-5 clearfix">-->
	                <!--        <div class="pull-right">-->
	
	                            <!--Pager buttons-->
	                <!--            <span class="text-muted">-->
	                <!--                <strong>1-50</strong>-->
	                <!--                of-->
	                <!--                <strong>160</strong>-->
	                <!--            </span>-->
	                <!--            <div class="btn-group btn-group">-->
	                <!--                <button class="btn btn-sm btn-default" type="button">-->
	                <!--                    <i class="mailbox-psi-arrow-left"></i>-->
	                <!--                </button>-->
	                <!--                <button class="btn btn-sm btn-default" type="button">-->
	                <!--                    <i class="mailbox-psi-arrow-right"></i>-->
	                <!--                </button>-->
	                <!--            </div>-->
	                <!--        </div>-->
	                <!--    </div>-->
	                <!--</div>-->
	                <!--<hr class="hr-sm">-->

                    <!-- Mail List Starts Here-->

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
                                                        ?>
                                        <?php
    							                 $flag_star = '';
    							                 if($overview[0]->flagged == 1)
    							                 {
    							                    $flag_star = 'mail-starred';                                                 }else{
    							                    $flag_star = '';                     }
							                ?>
                                                            <!--Mail list item-->
                                                            <li class="<?php echo ($overview[0]->seen == 0) ? 'mail-list-unread' : ''; ?> <?php echo $flag_star; ?> mail-attach">
                                                                <div class="mail-control">
                                                                    <input id="email-list-1" class="magic-checkbox" type="checkbox">
                                                                    <label for="email-list-1"></label>
                                                                </div>
                                                                <div class="mail-star"><a href="#"><i class="mailbox-psi-star"></i></a></div>
                                                                <div class="mail-from"><a href="#"><?php echo $overview[0]->from; ?></a></div>
                                                                <div class="mail-time"><?php echo date('d M', strtotime($overview[0]->date)); ?></div>
                                                                <div class="mail-attach-icon"></div>
                                                                <div class="mail-subject">
                                                                    <a href="mailbox-message.html"><?php echo imap_qprint($message); ?> </a>
                                                                </div>
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
