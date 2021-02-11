<?php $email_list_start = date('H:i:s'); ?>
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
	                <h1 class="page-header text-overflow"><?php if($search_for_flag == '1') { echo 'Inbox'; }else if($search_for_flag == '2') { echo 'Sent Mail'; }else if($search_for_flag == '3') { echo 'Drafts'; }else if($search_for_flag == '4') { echo 'Bin'; } ?>
	                <div class="pull-right">
                        <span class="text-muted" style="font-size: 1rem;"><strong>
                            <span id="start_mail"></span><span id="end_email"></span>
                            <?php
                                if($end >= count($search_msg_no_lists)){
                                    $end_val = count($search_msg_no_lists);
                                }
                                else {
                                    $end_val = $end;
                                }

                            ?>
                        <?php echo $start + 1; ?>-<?php echo $end_val; ?></strong> of <strong>
                                <?php echo count($search_msg_no_lists); ?></strong></span>
                       <div class="btn-group btn-group">
                        <?php if(($start - $per_page) >= 0){ ?>
                           <button type="button" class="btn btn-default">
                             <i class="mailbox-psi-arrow-left" onclick="search_get_another_part_of_list('<?php echo json_encode($search_msg_no_lists); ?>','<?php echo ($start) - $per_page; ?>','<?php echo ($start); ?>', '<?php echo $per_page; ?>');"></i>
                           </button>
                        <?php } ?>
                        <?php if(($end + $per_page) <= count($search_msg_no_lists)){ ?>
                            <button type="button" class="btn btn-default">
                                  <i class="mailbox-psi-arrow-right" onclick="search_get_another_part_of_list('<?php echo json_encode($search_msg_no_lists); ?>','<?php echo ($end); ?>','<?php echo ($end+$per_page); ?>', '<?php echo $per_page; ?>');"></i>
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
                                                    if($mailbox_array != '""')
                                                    {
                                                        // echo "hi";
                                                        // print_r($mailbox_array);
                                                        // die();
                                                        $ex_values = explode('},', str_replace('[', '', str_replace(']', '', str_replace('"', '', str_replace('{', '', $mailbox_array) ))));
                                                        $imap_email_lists = array_slice($ex_values, ($start - 1), $per_page, true);
                                                        
                                                        //echo '<pre>';print_r($imap_email_lists); 
                                                        $i=1;
							                            foreach($ex_values as $email_number)
                                                        {  ?>
                                         										
                                         				<?php

                                                            $explode_msg = explode(',', $email_number);

                                                            //echo '<pre>';print_r($explode_msg); 

                                                            $flag_star = '';
                                                            $msg_no  = '';
                                                            $seen = '';
                                                            $mail_size = '';
                                                            $mail_size = str_replace('size:', '', $explode_msg[6]);
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
                                                                $uid = str_replace('uid:', '', $explode_msg[7]);
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
                                                                $uid = str_replace('uid:', '', $explode_msg[9]);
                                                                $msg_no = str_replace('msgno:', '', $explode_msg[10]);
                                                                $seen = str_replace('seen:', '', $explode_msg[15]);
                                                        	}
                                                            $date = str_replace('date:', '', $explode_msg[3]).$explode_msg[4];
                                                            
                                                            ?>
								                            <!--Mail list item-->
                                                            <li onclick="search_imap_mailbox_view(<?php echo $msg_no; ?>, '<?php if($search_for_flag == '1') { echo 'Inbox'; }else if($search_for_flag == '2') { echo '[Gmail]/Sent Mail'; }else if($search_for_flag == '3') { echo '[Gmail]/Drafts'; }else if($search_for_flag == '4') { echo '[Gmail]/Bin'; } ?>','<?php echo $search_for_flag; ?>','<?php echo $search_criteria; ?>');" class="<?php echo ($seen == 0) ? 'mail-list-unread' : ''; ?> <?php echo $flag_star; ?> mail-attach"
                                                                id="mailbox_email_list_<?php echo $i; ?>">
	                                                                <div class="mail-control">
	                                                                    <input id="email-list-1" class="magic-checkbox" type="checkbox">
	                                                                    <label for="email-list-1"></label>
	                                                                </div>
	                                                                <div class="mail-star">
                                                                        <a href="#"><i class="mailbox-psi-star"></i></a>
                                                                    </div>
	                                                                <div class="mail-from"><a href="#"><?php echo str_replace('from:', '', $explode_msg[1]); ?></a></div>
	                                                                <div class="mail-time" style="width: 150px;">
                                                                        <?php if($mail_size > 60000) { ?>
                                                                            <span><i class="fa fa-paperclip"></i></span>&nbsp;&nbsp;
                                                                        <?php } ?> &nbsp;&nbsp;
                                                                        <span class="move_to_bin" onclick="event.stopPropagation();move_to_bin('<?php echo $emailid; ?>','<?php echo $msg_no; ?>','<?php echo $i; ?>',);"><i class="fa fa-trash"></i></span> &nbsp;&nbsp;
                                                                        <?php $mail_recieved_date = date('Y-m-d H:i:s', strtotime($date)); echo time_elapsed_string_in_helper($mail_recieved_date); ?>
                                                                    </div>
																	<div class="mail-subject">
	                                                           <a href="javascript:;" > <?php $subject = str_replace('subject:', '', $explode_msg[0]); echo $subject; ?></a>
                                                               
	                                                                </div>
                                                            </li>
                                                        <?php $i++; }

                                                    }else{ ?>
                                                            <li class="mail-list-unread  mail-attach" id="mailbox_email_list_1">
                                                                <div class="mail-control">
                                                                    <label for="email-list-1"></label>
                                                                </div>
                                                                <div class="mail-star">
                                                                    <a href="#"><i class="fa fa-times"></i></a>
                                                                </div>
                                                                <div class="mail-from"><a class="text-center" href="#">Oops! Mail Box is Empty</a></div>
                                                                <!-- <div class="mail-time" style="width: 150px;">
                                                                     &nbsp;&nbsp;
                                                                    <span class="move_to_bin"><i class="fa fa-trash"></i></span> &nbsp;&nbsp;                                                      
                                                                </div> -->
                                                                <div class="mail-subject">
                                                                    <a href="javascript:;"> </a>
                                                                </div>
                                                            </li>
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
	<?php 
        $email_list_end = date('H:i:s');
        timing_log($email_list_start,$email_list_end,'Search Email View Page Loading Time');
    ?>   

    <script type="text/javascript">
        $(document).ready(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
        // var start = $('#start_val').val();
        // var end = $('#end_val').val();
        // $('#start_mail').val(start);
        // $('#end_email').val(end);

    });
        $(".move_to_bin").click(function(event){    
             // event.stopPropagation();    
        });
    // function pre_current_page_mail_pointing(val)
    // {
    //     var start = $('#start_val').val();
    //     var end = $('#end_val').val();

    //     $('#start_mail').val(parseInt(start) - parseInt(val));
    //     $('#start_mail').val(parseInt(end) - parseInt(val));

    //     $('#start_val').val(parseInt(start) - parseInt(val));
    //     $('#end_val').val(parseInt(end) - parseInt(val));
    // }
    // function for_current_page_mail_pointing(val)
    // {
    //     var start = $('#start_val').val();
    //     var end = $('#end_val').val();

    //     $('#start_mail').val(parseInt(start) + parseInt(val));
    //     $('#start_mail').val(parseInt(end) + parseInt(val));

    //     $('#start_val').val(parseInt(start) + parseInt(val));
    //     $('#end_val').val();
    // }
    // function paging_mail_list(start, end)
    // {   
    //     var emailid = $('#info_email').val();

       
    //     var per_page = '<?php echo $per_page; ?>';
    //     var mail_list_count = '<?php echo $emails_count; ?>';
    //     var mailbox_array = '<?php echo json_encode($mailbox_array); ?>';

    //     $.ajax({
    //         type: "POST",
    //         url: baseurl+'Mailbox/info_email_list',
    //         async: false,
    //         type: "POST",
    //         data:{'emailid':emailid, 'start':start, 'end':end, 'per_page' : per_page, 'tot_mail_list_count' : mail_list_count, 'mailbox_array': mailbox_array},
    //         dataType: "html",
    //         success: function(response)
    //         {
    //             $('#email_list_view').empty().append(response);
                
    //         }
    //     });
    // }
    function search_inbox()
    {
        var search_val = $('#inbox_search').val();
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


