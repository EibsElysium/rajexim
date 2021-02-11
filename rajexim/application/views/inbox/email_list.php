<!--Page content-->
<!--===================================================-->  
<!-- <?php //echo "<pre>"; print_r($results); ?> -->
<div class="row" style="padding-top: 15px;">
    <div class="col-md-6">
        <div class="pull-left"><h4>Mail Box</h4></div>
    </div>
    <?php if(count($whole_array_results) > 0){  ?>
    <div class="col-md-4">
        <div class="pad-all">
          <div class="pull-right">
              <span class="text-muted" style="font-size: 1rem;"><strong>
                  <span id="start_mail"></span><span id="end_email"></span>
               <?php echo $start; ?> - <?php echo ($end > count($whole_array_results))  ? count($whole_array_results) : $end; ?></strong> of <strong><?php echo count($whole_array_results); ?></strong></span>
             <div class="btn-group btn-group">
             <?php if ($start > $per_page) { ?>
                 <button type="button" class="btn btn-default" onclick="pagination_lead_mails(<?php echo $start - $per_page; ?>, <?php echo $end - $per_page; ?>, <?php echo $per_page; ?>);">
                   <i class="mailbox-psi-arrow-left"></i>
                 </button>
             <?php } ?> 
             <?php if ($end <= count($whole_array_results) && $end != count($whole_array_results)) { ?>
                       <button type="button" class="btn btn-default" onclick="pagination_lead_mails(<?php echo $start + $per_page; ?>, <?php echo $end + $per_page; ?>, <?php echo $per_page; ?>);">
                            <i class="mailbox-psi-arrow-right"></i>
                      </button>
              <?php } ?>
                 
             </div>
          </div>
        </div>
    </div>
    <?php } else { ?>
        <div class="col-md-4">
            <div class="pad-all">
                
            </div>
        </div>
    <?php } ?>
    <div class="col-md-2">
        <div class="pad-all bord-btm" style="display: none;">
            <a href="javascript:;" onclick="compose_mail();" class="btn btn-block btn-primary"><i class="fa fa-plus"></i>&nbsp; &nbsp; Compose</a>
        </div>
    </div>
</div>  

    <hr class="hr-sm">
    <!-- Mail List Starts Here-->
<div class="row">
  <?php if($email_list_from_db_or_imap == '1'){ ?>
          <input type="hidden" id="info_email" value="">

    <div class="col-md-12">
        
      <!--Mail list group-->
      <ul id="mailbox-mail-list" class="mail-list">

          <!--Mail list item-->

          <?php
            // echo "<pre>";
            // print_r($results);
            // die();
            if(!empty($results))
            {
               foreach ($results as $email_list) 
              {


                      if($email_list['size'] > 60000)
                      {
                          $attach_file_name = 'mail-attach';
                          $attach_icon = '<i class="mailbox-psi-paperclip"></i>';
                      }
                      else{
                          $attach_file_name = '';
                          $attach_icon = '';
                      }
                  
                
               ?>
                  <li class="mail-list-unread <?php echo ($email_list['flagged'] == 1) ? 'mail-starred' : ''; ?> ">
                      <div class="mail-control">
                          <input id="email-list-1" class="magic-checkbox" type="checkbox">
                          <label for="email-list-1"></label>
                      </div>
                      <div class="mail-star"><a href="javascript:;"><i class="mailbox-psi-star"></i></a></div>
                      <div class="mail-from"><a href="javascript:;"><?php echo $email_list['from']; ?> </a></div>
                      <div class="mail-time"><?php $mail_recieved_date = date('Y-m-d H:i:s', strtotime($email_list['date'])); echo time_elapsed_string_in_helper($mail_recieved_date); ?></div>
                      <div class="mail-attach-icon"><?php echo $attach_icon; ?></div>
                      <div class="mail-subject">
                          <a href="javascript:;" onclick="show_email_thread('<?php echo $email_list['msgno']; ?>', '<?php echo $email_list['email_type']; ?>', '<?php echo $company_email; ?>','<?php echo ($email_list['email_type'] == 1) ? $lead_email : $company_email; ?>');"><?php echo $email_list['subject']; ?></a>
                      </div>
                  </li>
        <?php } } else { ?>
          
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <h3>There is No Data Availbale..!</h3>
            </div>
        </div>
        <?php } ?>
        <input type="hidden" name="mail_view_lead_id" id="mail_view_lead_id" value="<?php echo $lead_id; ?>">
      </ul>
      <!-- Mail List Ends Here -->
    </div>
  <?php } else { ?>
    <input type="hidden" id="info_email" value="<?php echo $comp_email_id ?>">
    <div class="col-md-12">
        
      <!--Mail list group-->
      <ul id="mailbox-mail-list" class="mail-list">

          <!--Mail list item-->
          <?php
            if(!empty($results))
            {
              for ($i=0; $i < count($results); $i++) { 
               foreach ($results[$i] as $key => $result) 
              {
                $results[$i][$key]->subject = str_replace("'", "`", $result->subject); 

                      if($result->size > 60000)
                      {
                          $attach_file_name = 'mail-attach';
                          $attach_icon = '<i class="mailbox-psi-paperclip"></i>';
                      }
                      else{
                          $attach_file_name = '';
                          $attach_icon = '';
                      }
                  
                
               ?>
                  <li class="mail-list-unread <?php echo ($result->flagged  == 1) ? 'mail-starred' : ''; ?> ">
                      <div class="mail-control">
                          <input id="email-list-1" class="magic-checkbox" type="checkbox">
                          <label for="email-list-1"></label>
                      </div>
                      <div class="mail-star"><a href="javascript:;"><i class="mailbox-psi-star"></i></a></div>
                      <div class="mail-from"><a href="javascript:;"><?php echo $result->from; ?> </a></div>
                      <div class="mail-time"><?php $mail_recieved_date = date('Y-m-d H:i:s', strtotime($result->date)); echo time_elapsed_string_in_helper($mail_recieved_date); ?></div>
                      <div class="mail-attach-icon"><?php echo $attach_icon; ?></div>
                      <div class="mail-subject">
                          <a href="javascript:;" onclick="imap_mailbox_view(<?php echo $result->msgno ; ?>, <?php echo ($email_type == '1') ? 'INBOX' : '[Gmail]/Sent Mail' ?>, <?php echo $start; ?>, <?php echo $end; ?>, <?php echo $per_page; ?>);"><?php echo $result->subject; ?></a>
                      </div>
                  </li>
        <?php } } } else { ?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <h3>There is No Data Availbale..!</h3>
            </div>
        </div>
        <?php } ?>
        <input type="hidden" name="mail_view_lead_id" id="mail_view_lead_id" value="<?php echo $lead_id; ?>">
      </ul>
      <!-- Mail List Ends Here -->
    </div>
  <?php } ?>
    <script>
    // function compose_mail()
    // {
    //    alert('in');
    //    var info_email = $('#info_email').val();
    //    var lead_id = $('#mail_view_lead_id').val();
    //    var off_chosen_mail = $('#lead_emails').val();
    //    alert(info_email);
    //    alert(lead_id);
    //    alert(off_chosen_mail);
    //    $.ajax({
    //       type: "POST",
    //       url: baseurl+'Leads/lead_compose_mail',
    //       async: false,
    //       type: "POST",
    //       data:{'lead_id': lead_id, 'off_chosen_mail': off_chosen_mail},
    //       dataType: "html",
    //       success: function(response)
    //       {
    //          alert(response);
    //          $('#lead_email_list').empty().append(response);
             
    //       }
    //    });

    // }
    function pagination_lead_mails(start,end,per_page)
    {
        var whole_array_results = '<?php echo json_encode($whole_array_results); ?>';
        console.log(whole_array_results);
        var whole_arr = JSON.stringify(whole_array_results);
        var lead_id = '<?php echo $lead_id; ?>';
        var company_email = '<?php echo $company_email; ?>';
        var lead_email = '<?php echo $lead_email; ?>';
        $.ajax({
          type: "POST",
          url: baseurl+'Leads/lead_list_email_pagination',
          type: "POST",
          data:{'start': start, 'end': end, 'per_page':per_page, 'whole_array_results':whole_arr, 'lead_id':lead_id, 'company_email' : company_email, 'lead_email' : lead_email},
          dataType: "html",
          success: function(response)
          {
             $('#lead_email_list').empty().append(response);
          }
       });

    }
    function imap_mailbox_view(msgno, label, start, end, per_page)
  {
    
    var emailid = $('#info_email').val();
    var tot_mail_list_count = '<?php echo count($whole_array_results); ?>';
    var first_index = start;
    var second_index = end;
    $.ajax({
    type: "POST",
    url: baseurl+'Mailbox/imap_mailbox_view',
    
    type: "POST",
    data:{'emailid':emailid, 'msgno':msgno, 'label':label, 'start' : start, 'end' : end, 'per_page' : per_page, 'tot_mail_list_count' : tot_mail_list_count, 'first_index' : first_index, 'second_index' : second_index },
    dataType: "html",
    success: function(response)
    {
      
      $('#lead_email_list').empty().append(response);
      
    }
    });

  }
    </script>
    <!--===================================================-->
    <!-- END OF MAIL INBOX -->