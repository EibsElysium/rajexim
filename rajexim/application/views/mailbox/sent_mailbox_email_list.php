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
                .page-header {
                     padding-bottom: 0px !important; 
                }
                .text-overflow {
                    width: 100%;
                }
        </style>
       
    <!--  Search Ends Here -->
            <!-- Image loader -->
            <!-- <div id='loader' style='display: none;'> -->
              <div class="se-pre-con"></div>
            <!-- </div> -->
            <!-- Image loader -->

	        <div class="panel">
	            <div id="mailbox-email-list" class="panel-body">
	                <h1 class="page-header text-overflow pad-btm">Sent Mails
	                	<div class="pull-right">
	                    <span class="text-muted" style="font-size: 1rem;"><strong>
                    <?php 
	                    echo $start; ?>-<?php 
	                    
	                    $end_val = $end;

	                    if($emails_count > $end_val)
	                    {
	                        $end_val = $end;
	                    }else{
	                        $end_val = $emails_count;
	                    }
	                    // $emails_count = $emails_count - $per_page;

                        // if($per_page < $tot_mail_list_count){
                        //     $displayed_mail_list_count = $tot_mail_list_count - $per_page;
                        // }
                        // else {
                        //     $displayed_mail_list_count = $tot_mail_list_count;
                        // }
	                    echo $end_val; ?></strong> of <strong>
	                    	<?php echo $emails_count; ?></strong></span>
	                   <div class="btn-group btn-group">
                        <?php 
                          if(($displayed_mail_list_count + ($per_page * 2)) < $emails_count)
                          { ?>

	                       <button type="button" class="btn btn-default" >
	                         <i class="mailbox-psi-arrow-left" 
	                         onclick="get_another_part_of_sent_list(<?php echo $displayed_mail_list_count + ($per_page * 2); ?>,<?php echo (($displayed_mail_list_count + $per_page) < $emails_count) ? $displayed_mail_list_count + $per_page : $emails_count; ?>,<?php echo $start - $per_page; ?>, <?php echo $end - $per_page; ?>,<?php echo $emails_count; ?>);"></i>
	                       </button>
                         <?php } ?>
	                      <?php 
                       		if($displayed_mail_list_count > $per_page)
                       		{ ?>
                       			 <button type="button" class="btn btn-default">
			                          <i class="mailbox-psi-arrow-right" onclick="get_another_part_of_sent_list(<?php echo $displayed_mail_list_count - 1 ?>,<?php echo ($displayed_mail_list_count > $per_page) ? $displayed_mail_list_count - $per_page : 1; ?>,<?php echo $end+1; ?>, <?php echo $end + $per_page; ?>,<?php echo $emails_count; ?>);"></i>
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


                                                    if(!empty($mailbox_array))
                                                    {
                                                        // print_r($mailbox_array);
                                                        // echo $mailbox_array;
                                                        // die();
                                                        $ex_values = explode('},', str_replace('[', '', str_replace(']', '', str_replace('"', '', str_replace('{', '', $mailbox_array) ))));
                                                        $imap_email_lists = array_slice($ex_values, ($start - 1), $per_page, true);
                                                        
                                                        //echo '<pre>';print_r($imap_email_lists); 

							                            foreach($ex_values as $email_number)
                                                        { ?>
                                         										
                                         				<?php

                                                            $explode_msg = explode(',', $email_number);

                                                            //echo '<pre>';print_r($explode_msg); 

                                                            $flag_star = '';
                                                            $msg_no  = '';
                                                            $seen = '';

                                                           // echo COUNT($explode_msg);
                                                            if(COUNT($explode_msg) == 16)
                                                            {
                                                                if( str_replace('flagged:', '', $explode_msg[10]) == 1)
                                                                {
                                                                    $flag_star = 'mail-starred';
                                                                }
                                                                else
                                                                {
                                                                    $flag_star = '';
                                                                }
                                                                $msg_no = str_replace('msgno:', '', $explode_msg[8]);
                                                                $seen = str_replace('seen:', '', $explode_msg[13]);

                                                            }
                                                        	else{

                                                        		if( str_replace('flagged:', '', $explode_msg[12]) == 1)
                                                                {
                                                                    $flag_star = 'mail-starred';
                                                                }
                                                                else
                                                                {
                                                                    $flag_star = '';
                                                                }
                                                                $msg_no = str_replace('msgno:', '', $explode_msg[10]);
                                                                $seen = str_replace('seen:', '', $explode_msg[15]);
                                                        	}
                                                            $date = str_replace('date:', '', $explode_msg[3]).$explode_msg[4];
                                                            
                                                            ?>
								                            <!--Mail list item-->
                                                            <li onclick="sent_imap_mailbox_view(<?php echo $msg_no; ?>, '[Gmail]/Sent Mail', <?php echo $start; ?>, <?php echo $end; ?>, <?php echo $per_page; ?>,<?php echo $emails_count; ?>,<?php echo $first_index; ?>,<?php echo $second_index; ?>);" class="<?php echo ($seen == 0) ? 'mail-list-unread' : ''; ?> <?php echo $flag_star; ?> mail-attach ">
	                                                                <div class="mail-control">
	                                                                    <input id="email-list-1" class="magic-checkbox" type="checkbox">
	                                                                    <label for="email-list-1"></label>
	                                                                </div>
	                                                                <div class="mail-star"><a href="#"><i class="mailbox-psi-star"></i></a></div>
	                                                                <div class="mail-from"><a href="#"><?php echo str_replace('from:', '', $explode_msg[1]); ?></a></div>
	                                                                <div class="mail-time"><?php $mail_recieved_date = date('Y-m-d', strtotime($date)); echo time_elapsed_string_in_helper($mail_recieved_date); ?></div>
																	<div class="mail-subject">
	                                                           <a href="javascript:;"> <?php $subject = str_replace('subject:', '', $explode_msg[0]); echo $subject; ?></a>
                                                               
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
	   

    <script type="text/javascript">
        $(document).ready(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
    function paging_mail_list(start, end)
    {   
        var emailid = $('#info_email').val();

       
        var per_page = '<?php echo $per_page; ?>';
        var mail_list_count = '<?php echo $emails_count; ?>';
        var mailbox_array = '<?php echo json_encode($mailbox_array); ?>';

        $.ajax({
        type: "POST",
        url: baseurl+'Mailbox/info_email_list',
        async: false,
        type: "POST",
        data:{'emailid':emailid, 'start':start, 'end':end, 'per_page' : per_page, 'tot_mail_list_count' : mail_list_count, 'mailbox_array': mailbox_array},
        dataType: "html",
        success: function(response)
        {
            $('#email_list_view').empty().append(response);
            
        }
        
        });
    }
    
</script>


