<div class="fluid" style="padding-top: 15px;">    
    <!-- VIEW MESSAGE -->
    <!--===================================================-->
    <div class="panel col-md-12">
        <div class="panel-body">
            <div class="mar-btm pad-btm bord-btm">
                <h1 class="page-header">
                    
                    
                    <?php echo $subject;  ?>
                    <span class="pull-right" onclick="get_info_email_list();"><i class="fa fa-arrow-left" style="font-size: 20px;cursor: pointer;"></i></span>

                </h1>
            </div>

    <?php 
    $i = 1;
    $count_val = count($email_thread_lists);
    $thread_id = '';
    if(!empty($email_thread_lists)) { foreach ($email_thread_lists as $key => $email_thread_list) { ?>
    <div class="head_thread">
              <div class="row">
                  <div class="col-sm-7">

                      <!--Sender Information-->
                      <div class="media">
                          <span class="media-left">
                              <img src="<?php echo base_url(); ?>assets/images/avatar.png" class="img-circle img-sm" alt="Profile Picture">
                          </span>
                          <div class="media-body">
                              <div class="text-bold"><?php echo $email_thread_list->message_from; ?></div>
                              <div class="btn-group" style="position: unset;display: none;" id="cc_<?php echo $key; ?>">
                                  <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                                      to me <i class="dropdown-caret"></i>
                                  </button>
                                  <ul class="dropdown-menu" style="top:unset;">
                                      <table class="table">
                                        <tr>
                                          <td>From</td>
                                          <td><?php echo $email_thread_list->message_from; ?></td>
                                        </tr>
                                        <tr>
                                          <td>To</td>
                                          <td><?php echo $email_thread_list->message_to; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Date</td>
                                          <td><?php echo $email_thread_list->mail_date; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Subject</td>
                                          <td><?php echo $email_thread_list->subject; ?></td>
                                        </tr>
                                       
                                      </table>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
                  <hr class="hr-sm visible-xs">
                  <div class="col-sm-5 clearfix">

                      <!--Details Information-->
                      <div class="pull-right text-right">
                          <p class="mar-no"><small class="text-muted"><?php echo date('d M Y H:i:s', strtotime($email_thread_list->mail_date)); ?></small></p>
                          <a href="#">
                              
                              <i class="mailbox-psi-paperclip icon-fw"></i>
                          </a>
                      </div>
                  </div>
              </div>
              <div class="row pad-ver head_content" id="head_content_<?php echo $key; ?>" onclick="show_message_content(<?php echo $key; ?>);">
                 <div class="col-sm-12">
                  <a href="javascript:;" >
                    <?php echo strlen($email_thread_list->body_text) > 50 ? substr($email_thread_list->body_text,0,100)."..." : $email_thread_list->body_html; ?> </a>
                </div>
              </div>
    </div>
    
    <div class="head_body" style="display: none;" id="head_body_<?php echo $key; ?>">
              <!--Message-->
              <!--===================================================-->
              <div class="pad-ver bord-ver">
                  <?php echo $email_thread_list->body_html; ?>
              </div>
              <!--===================================================-->
              <!--End Message-->

              <!-- Attach Files-->
              <!--===================================================-->

              <?php
               
                if($email_thread_list->attach_file_name != '')
                {
                  $ex_attach_files = explode(',', $email_thread_list->attach_file_name);
                }
                else{
                  $ex_attach_files = '';
                }

              ?>

              <?php
                  if(!empty($ex_attach_files))
                  { ?>
                    
                <div class="pad-ver mar-ver bord-btm">
                  <ul class="mail-attach-list list-ov">
                    <?php foreach ($ex_attach_files as  $ex_attach_file) { 

                      $ex_val = explode('.', $ex_attach_file);
                     
                      $img_type = $ex_val[1];
                      ?>

                      <li>
                          <a href="<?php echo base_url(); ?>mail_box/files/<?php echo $email_thread_list->uniqid; ?>/<?php echo $ex_attach_file; ?>" class="thumbnail">
                              <div class="mail-file-img">
                                  <img class="image-responsive" src="<?php echo base_url(); ?>mail_box/files/<?php echo $email_thread_list->uniqid; ?>/<?php echo $ex_attach_file; ?>" alt="<?php echo $img_type; ?>">
                                  <p class="text-info mar-no"><?php echo $ex_attach_file; ?></p>
                              </div>
                              
                          </a>
                      </li>
                    <?php } ?>
                     
                  </ul>
              </div>
                    <?php 
                  }
              ?>
             
              <!--===================================================-->
              <!-- End Attach Files-->
    
    </div>
     <hr class="hr-sm">

   <?php if($count_val == $i){ $thread_id = $email_thread_list->id; }   $i++; } } ?>
   <input type="hidden" name="i_val" id="i_val" value="<?php echo $thread_id; ?>">
   <!--Quick reply : Summernote Placeholder -->
    <span onclick="reply_mail(<?php echo $lead_id; ?>);"><strong>Reply</strong></span> or <span onclick="forward_mail(<?php echo $lead_id; ?>);"><strong>Forward</strong></span>

    <div id="reply_forward"></div>
    <!--Send button-->


        </div>
    </div>
    <!--===================================================-->
    <!-- END VIEW MESSAGE -->

</div>
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
function show_message_content(v)
{

 $('#cc_'+v).show();
 $('#head_body_'+v).slideToggle();
}


function reply_mail(lead_id)
{
 
  var val = $('#lead_emails').val();
  var msg_no = $('#i_val').val();
  $.ajax({
  type: "POST",
  url: baseurl+'Leads/reply_mail',
  async: false,
  type: "POST",
  data: "e_id="+val+"&msg_no="+msg_no+"&lead_id="+lead_id,
  dataType: "html",
  success: function(response)
    {
       
      $('#reply_forward').empty().append(response);
      
    }
  });
}
function forward_mail(lead_id)
{
  var val = $('#lead_emails').val();
  var msg_no = $('#i_val').val();
  $.ajax({
  type: "POST",
  url: baseurl+'Leads/forward_mail',
  async: false,
  type: "POST",
  data: "e_id="+val+"&msg_no="+msg_no+"&lead_id="+lead_id,
  dataType: "html",
  success: function(response)
    {

      $('#reply_forward').empty().append(response);
      
    }
  });
}
</script>