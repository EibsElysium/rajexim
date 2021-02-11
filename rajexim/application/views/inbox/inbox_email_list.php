<?php
// To get info email details
$email_id = $email_name;
$password = decryptthis($email_details->password, 'Rajexim2020');
/* connect to gmail */
$smtp_name = $email_details->smtp_host;
$hostname = '{'.$smtp_name.':993/imap/ssl/novalidate-cert}INBOX';
$username = $email_id;
$password = $password;
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
/* grab emails */
$emails_count = COUNT(imap_search($inbox,'ALL'));
$search_email_id = 'vimala2611992@gmail.com';
if($search_email_id != '')
{
    $inbox_all = imap_search($inbox,'ALL');
    if(!empty($inbox_all))
    {
       $from_name = $search_email_id;
       if($from_name != '')
       {
            $name = $from_name;
       	 $emails_count = COUNT(imap_search($inbox, 'FROM "'.$name.'"'));
       	 $emails_count_val = imap_search($inbox, 'FROM "'.$name.'"');
       	 rsort($emails_count_val);
       	 $val = $start - 1;
         $r_val = $val*$per_page;
         $end = $emails_count - $r_val;
         $start_val = $r_val;
        
        if($end > $per_page)
        {
         $end = $start * $per_page;
        }else{
            $end = $end;
        }
       	 $emails_count_val = array_slice($emails_count_val,$start_val,$per_page);
       	 $implode_val = implode($emails_count_val, ',');
       	 $range =$implode_val;
         $emails_val = imap_fetch_overview($inbox,"$range");
         $emails = array_reverse($emails_val);
       } 
    }
    
}else{
    
    $val = $start - 1;
    $r_val = $val*$per_page;
    $end = $emails_count - $r_val;
    if($end > $per_page)
    {
     $start_val = $end - ($per_page - 1);
    }else{
        $start_val = 1;
    }
    $range = $start_val.':'.$end;
    $reverse_emails = imap_fetch_overview($inbox,"$range");
    $emails = array_reverse($reverse_emails);
}

$unseen_emails = imap_search($inbox,'UNSEEN');

if (is_array($unseen_emails)) {
            $inbox_unread_count = count($unseen_emails);
        } else {
            $inbox_unread_count = 0;
        }
?>


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
    <!--  Search Ends Here -->
	<div class="row">
	    
	    <div class="col-md-12">

            <!-- Image loader -->
            <!-- <div id='loader' style='display: none;'> -->
              <div class="se-pre-con"></div>
            <!-- </div> -->
            <!-- Image loader -->

	        <div class="panel">
	            <div id="mailbox-email-list" class="panel-body">
	                <h1 class="page-header text-overflow pad-btm">Mail List
	                	<div class="pull-right">
	                    <span class="text-muted" style="font-size: 1rem;"><strong><?php 
	                    echo (($start-1)*$per_page) + 1; ?>-<?php 
	                    
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
                        <?php 
                          if(($start) > 1)
                          { ?>

	                       <button type="button" class="btn btn-default" >
	                         <i class="mailbox-psi-arrow-left" 
	                         onclick="show_previous_page(<?php echo $start-1; ?>);"></i>
	                       </button>
                         <?php } ?>
	                      <?php 
                       		if($emails_count > $end_val)
                       		{ ?>
                       			 <button type="button" class="btn btn-default">
			                          <i class="mailbox-psi-arrow-right" onclick="show_next_page(<?php echo $start+1; ?>);"></i>
			                  	</button>
                       		<?php } ?>
	                   </div>
	                </div>


	                </h1>
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
                                                       foreach($emails as $key=>$email_number){?>
                                         											
                                         				<?php
						                                    $flag_star = '';
                                                                	if($email_number->flagged == 1)
                                                                	{
                                                                		$flag_star = 'mail-starred';
                                                                	}else{
                                                                		$flag_star = '';
                                                                	}
                                                                ?>
		                                                                <!--Mail list item-->
	                                                            <li class="<?php echo ($email_number->seen == 0) ? 'mail-list-unread' : ''; ?> <?php echo $flag_star; ?> mail-attach ">
		                                                                <div class="mail-control">
		                                                                    <input id="email-list-1" class="magic-checkbox" type="checkbox">
		                                                                    <label for="email-list-1"></label>
		                                                                </div>
		                                                                <div class="mail-star"><a href="#"><i class="mailbox-psi-star"></i></a></div>
		                                                                <div class="mail-from"><a href="#"><?php echo $email_number->from; ?></a></div>
		                                                                <div class="mail-time"><?php echo date('d M Y H:i:s', strtotime($email_number->date)); ?></div>
																			<div class="mail-subject">
		                                                                        <a href="<?php echo base_url(); ?>Leads/email_message_view/<?php echo $lead_id; ?>/<?php echo $email_number->msgno; ?>/<?php echo str_replace('@', '_', $email_id) ; ?>/INBOX<?php echo ($search_email_id != '') ? '/'.str_replace('@', '_', $search_email_id) : '';?>" target="_blank"> <?php echo $email_number->subject; ?></a>
		                                                                     </div>
                                                                </li>
                                                        <?php }

                                                    }else{ ?>
                                                        <p>No Email Found</p>
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
	             <!--  <div class="panel-footer clearfix">
	               
	            </div>  -->
	        </div>
	    </div>
	</div>
    <script type="text/javascript">
        $(document).ready(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
    <?php imap_close($inbox); ?>
