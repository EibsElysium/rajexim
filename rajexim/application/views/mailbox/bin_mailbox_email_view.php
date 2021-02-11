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
                .mail-message-reply {
                    min-height: 40px;
                }
        </style>
    <!--  Search Ends Here -->
            <!-- Image loader -->
            <!-- <div id='loader' style='display: none;'> -->
              <div class="se-pre-con"></div>
            <!-- </div> -->
            <!-- Image loader -->

	        <!-- VIEW MESSAGE -->
                                <!--===================================================-->
                                <div class="panel col-md-12" style="margin-top: -5px;">
                                    <div class="panel-body">
                                        <div class="mar-btm pad-btm bord-btm row">
                                          <div class="col-sm-9">
                                            <input type="hidden" name="msgno" id="sentbox_msgno" value="<?php echo $msgno; ?>"> 
                                             <input type="hidden" name="label" id="label" value="<?php echo $label; ?>"> 
                                             <input type="hidden" name="message_to" id="message_to" value="<?php echo $imap_email_lists['msg_to'][0]->mailbox.'@'.$imap_email_lists['msg_to'][0]->host; ?>"> 
                                            <h1 class="page-header text-overflow">

                                                <!-- <span class="label label-normal label-info">Business</span> -->
                                                <?php echo $imap_email_lists['subject']; ?> 
                                                <!-- <span class="pull-right" onclick="get_another_part_of_sent_list(<?php echo $second_index; ?>,<?php echo $first_index; ?>,<?php echo $start; ?>,<?php echo $end; ?>,<?php echo $emails_count; ?>);"><i class="fa fa-arrow-left" style="font-size: 20px;cursor: pointer;"></i></span> -->

                                                <button type="button" class="btn btn-primary pull-right" onclick="get_another_part_of_bin_list(<?php echo $second_index; ?>,<?php echo $first_index; ?>,<?php echo $start; ?>,<?php echo $end; ?>,<?php echo $emails_count; ?>);">
                                                <i class="fa fa-arrow-left" style="cursor: pointer;"></i>&nbsp;&nbsp;Back
                                                </button>
                                            </h1>
                                          </div>
                                          <div class="col-sm-3">
                                          
                                          </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-7">

                                                <div class="media">
                                                  <span class="media-left">
                                                      <img src="<?php echo base_url(); ?>assets/images/avatar.png" class="img-circle img-sm" alt="Profile Picture">
                                                  </span>
                                                  <div class="media-body">
                                                      <div class="text-bold"><?php echo $imap_email_lists['msg_from'][0]->personal; ?> < <a href="javascript:;"><?php echo $imap_email_lists['msg_from'][0]->mailbox.'@'.$imap_email_lists['msg_from'][0]->host; ?></a> ></div>
                                                      <div class="btn-group" style="position: unset;display: none;" >
                                                      <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                                                          to me <i class="dropdown-caret"></i>
                                                      </button>
                                                      
                                                  </div>
                                                  </div>
                                              </div>

                                            </div>
                                            <hr class="hr-sm visible-xs">
                                            <div class="col-sm-5 clearfix">
                        
                                                <!--Details Information-->
                                                <div class="pull-right text-right">
                                                    <p class="mar-no"><small class="text-muted"><?php echo date('d M Y, H:s', strtotime($imap_email_lists['msg_date'])); ?></small></p>
                                                    <a href="#">
                                                        <strong>

                                                            </strong>
                                                        
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!--Message-->
                                        <!--===================================================-->
                                        <div class="pad-ver bord-ver">
                                           <?php echo $imap_email_lists['message']; ?>
                                        </div>
                                        <!--===================================================-->
                                        <!--End Message-->

                                        <!--Quick reply : Summernote Placeholder -->
                                        <div id="mailbox-mail-textarea" class="mail-message-reply bg-gray-light">
                                            <strong><span onclick="reply_mail();">Reply</span></strong> or <strong><span onclick="reply_to_all();">Reply to All</span></strong> or <strong><span onclick="forward_mail();">Forward</span></strong> this message...
                                        </div> 
                                         <div id="reply_forward"></div>
                        
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

                               
	   

    <script type="text/javascript">
        $(document).ready(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
var baseurl = '<?php echo base_url(); ?>';
function reply_mail()
{
 
  var info_email = $('#info_email').val();
  var msg_no = $('#sentbox_msgno').val();
  var label = $('#label').val();
  var msg_to = $('#message_to').val();
  $.ajax({
  type: "POST",
  url: baseurl+'Mailbox/reply_mail',
  async: false,
  type: "POST",
  data: "info_email="+info_email+"&msg_no="+msg_no+"&msg_to="+msg_to+"&label="+label,
  dataType: "html",
  success: function(response)
    {
       
      $('#reply_forward').empty().append(response);
      $('#mailbox-mail-textarea').hide();
      
    }
  });
}

function forward_mail()
{
  var info_email = $('#info_email').val();
  var msg_no = $('#sentbox_msgno').val();
  var msg_to = $('#message_to').val();
  var label = $('#label').val();
  $.ajax({
  type: "POST",
  url: baseurl+'Mailbox/forward_mail',
  async: false,
  type: "POST",
  data: "info_email="+info_email+"&msg_no="+msg_no+"&msg_to="+msg_to+"&label="+label,
  dataType: "html",
  success: function(response)
    {
       
      $('#reply_forward').empty().append(response);
      $('#mailbox-mail-textarea').hide();
      
    }
  });
}
function reply_to_all()
{
  var info_email = $('#info_email').val();
  var msg_no = $('#sentbox_msgno').val();
  var msg_to = $('#message_to').val();
  var label = $('#label').val();
  var lead_id = '0';
  var mail_reply_from = '2';
  $.ajax({
  type: "POST",
  url: baseurl+'Mailbox/reply_to_all_mail',
  async: false,
  type: "POST",
  data: "info_email="+info_email+"&msg_no="+msg_no+"&msg_to="+msg_to+"&lead_id="+lead_id+"&mail_reply_from="+mail_reply_from+"&label="+label,
  dataType: "html",
  success: function(response)
    {
      $('#reply_forward').empty().append(response);
      $('#mailbox-mail-textarea').hide(); 
    }
  })
}
</script>

