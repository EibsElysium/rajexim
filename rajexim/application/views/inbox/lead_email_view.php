
    <!--  Search Ends Here -->
            <!-- Image loader -->
            <!-- <div id='loader' style='display: none;'> -->
            <!-- </div> -->
            <!-- Image loader -->

	        <!-- VIEW MESSAGE -->
                                <!--===================================================-->
                                <div class="panel col-md-12" style="margin-top: 25px;">
                                    <div class="panel-body">
                                        <div class="mar-btm pad-btm bord-btm row">
                                          <div class="col-sm-9">
                                            <h1 class="page-header text-overflow">
                                                <!-- <span class="label label-normal label-info">Business</span> -->
                                                <?php echo $get_email_content['subject']; ?> 
                                                <span class="pull-right" onclick="get_info_email_list(<?php echo $get_email_content['email_type']; ?>);"><i class="fa fa-arrow-left" style="font-size: 20px;cursor: pointer;"></i></span>
                                        
                                            </h1>
                                          </div>
                                          
                                        </div>
                                        <?php  // print_r($get_email_content); ?>
                                        <div class="row">
                                            <div class="col-sm-7">

                                                <div class="media">
                                                  <span class="media-left">
                                                      <img src="<?php echo base_url(); ?>assets/images/avatar.png" class="img-circle img-sm" alt="Profile Picture">
                                                  </span>
                                                  <div class="media-body">
                                                    <?php 
                                                      $exp_msg_from = explode(',', $get_email_content['msg_from_host']);
                                                     ?>
                                                      <div class="text-bold"><?php echo $exp_msg_from[0]; ?> < <a href="javascript:;"><?php echo $exp_msg_from[0].'@'.$exp_msg_from[1]; ?></a> ></div>
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
                                                    <p class="mar-no"><small class="text-muted"><?php echo date('d M Y, H:s', strtotime($get_email_content['msg_date'])); ?></small></p>
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
                                           <?php echo $get_email_content['message']; ?>
                                        </div>
                                        <div class="pad-ver bord-ver">
                                          <?php if($get_email_content['attachments'] != ''){ ?>
                                            <label>Attachments</label><br>
                                            <?php
                                                $exp_attach = explode(',', $get_email_content['attachments']);
                                            for ($i=0; $i < count($exp_attach); $i++) { ?>
                                            <a href="<?php echo base_url(); ?>assets/mail_box_attachment/<?php echo $exp_attach[$i]; ?>" target = "_blank" class="btn btn-primary"><?php echo $exp_attach[$i]; ?></a>&nbsp;&nbsp;
                                          <?php } } ?>
                                        </div>
                                        <!--===================================================-->
                                        <!--End Message-->

                                        <!--Quick reply : Summernote Placeholder -->
                                        <div id="mailbox-mail-textarea" class="mail-message-reply bg-gray-light" style="display: none;">
                                            <strong><span onclick="reply_mail();">Reply</span></strong> or <strong><span onclick="forward_mail();">Forward</span></strong> this message...
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

                               <input type="hidden" name="msgno" id="msgno" value="<?php echo $msgno; ?>"> 
                               <input type="hidden" name="label" id="label" value="<?php echo $label; ?>"> 
                               <input type="hidden" name="message_to" id="message_to" value="<?php echo $exp_msg_from[1].'@'.$exp_msg_from[2]; ?>"> 
	   

    <script type="text/javascript">
       
var baseurl = '<?php echo base_url(); ?>';
function reply_mail()
{
 
  var info_email = $('#lead_emails').val();
  var msg_no = $('#msgno').val();
  var msg_to = $('#message_to').val();
  var lead_id = '<?php echo $lead_id; ?>';
  var mail_reply_from = '1';
  $.ajax({
  type: "POST",
  url: baseurl+'Mailbox/reply_mail',
  async: false,
  type: "POST",
  data: "info_email="+info_email+"&msg_no="+msg_no+"&msg_to="+msg_to+"&lead_id="+lead_id+"&mail_reply_from="+mail_reply_from,
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
  var info_email = $('#lead_emails').val();
  var msg_no = $('#msgno').val();
  var msg_to = $('#message_to').val();
  var lead_id = '<?php echo $lead_id; ?>';
  var mail_reply_from = '1';
  $.ajax({
  type: "POST",
  url: baseurl+'Mailbox/forward_mail',
  async: false,
  type: "POST",
  data: "info_email="+info_email+"&msg_no="+msg_no+"&msg_to="+msg_to+"&lead_id="+lead_id+"&mail_reply_from="+mail_reply_from,
  dataType: "html",
  success: function(response)
    {
       
      $('#reply_forward').empty().append(response);
      $('#mailbox-mail-textarea').hide();
      
    }
  });
}
</script>

