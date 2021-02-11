<h5>Reply Message</h5>
<div class="panel">
    <div class="panel-body">
      
        <!--Input form-->
    <form role="form" class="form-horizontal send_reply_ajax_form" enctype="multipart/form-data" onsubmit="return send_compose_validation();">
            <input type="hidden" name="mail_reply_from" id="mail_reply_from" value="<?php echo $mail_reply_from; ?>">
            <input type="hidden" id="from_email" name="from_email" value="<?php echo $info_email_name;?>">
            <input type="hidden" id="info_email" name="info_email" value="<?php echo $info_email;?>">
            <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead_id;?>">
            <div class="form-group">
                <label class="col-lg-1 control-label text-left" for="inputEmail">To</label>
                <div class="col-lg-11">
                    <input type="text" id="to_email" name="to_email" class="form-control" value="<?php echo $msg_to; ?>">
                    <p class="text-danger" id="to_email_err"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label text-left" for="inputCc">Cc</label>
                <div class="col-lg-11">
                    <input type="text" id="cc_email" name="cc_email" class="form-control" value="<?php echo $imap_email_lists['cc_address']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label text-left" for="inputBcc">Bcc</label>
                <div class="col-lg-11">
                    <input type="text" id="bcc_email" name="bcc_email" class="form-control" value="<?php echo $imap_email_lists['bcc_address']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label text-left" for="inputSubject">Subject</label>
                <div class="col-lg-11">
                    <input type="text" id="sub_email" name="sub_email"  class="form-control" value="<?php echo $imap_email_lists['subject']; ?> ">
                    <p class="text-danger" id="sub_email_err"></p>
                </div>
            </div>

        <!--Attact file button-->
        <div class="media pad-btm">
            <div class="media-left attach-file-names">
                <span class="btn btn-default btn-file">
                    Attachment <input type="file" name="attach_email[]" onchange="get_all_files_name();" id="attach_email" multiple>
                </span>
            </div>
            <div id="mailbox-attach-file" class="media-body"></div>
        </div>


        <!--Wysiwyg editor : Summernote placeholder-->
        <textarea name="content_email" id="mailbox-mail-compose"><?php echo $imap_email_lists['message']; ?></textarea>
        <!-- <div ></div> -->
        <p class="text-danger" id="mail_message_err"></p>
        <input type="hidden" name="removed_attachment_name" id="removed_attachment_name">
        <div class="pad-ver">
        
            <!--Send button-->
            <button id="mail-send-btn" type="submit" name="btn_submit"  class="btn btn-primary">
                <i class="mailbox-psi-mail-send icon-lg icon-fw"></i> Reply Mail
            </button>
            <p id="mail_send_response_msg" class="text-primary"></p>
        </div>

    </form>
    </div>
</div>
						    	
<script type="text/javascript">
	$('#mailbox-mail-compose').summernote();
    
    $("form.send_reply_ajax_form").submit(function(e) {
        $('#mail-send-btn').prop('disabled', true);
        e.preventDefault();    
        var formData = new FormData(this);
        var base_url = "<?php echo base_url(); ?>";
        $.ajax({
            url: base_url+'Mailbox/send_reply_mail_via_ajax',
            type: 'POST',
            data: formData,
            success: function (data) {
                $('#mail_send_response_msg').empty().html(data);
                $('#mail-send-btn').prop('disabled', false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    function send_compose_validation()
    {
       var sub_email = $('#sub_email').val();
       var mail_message = $('#mailbox-mail-compose').val();
       var to_email = $('#to_email').val();
       var err = 0; 
       if (sub_email == '') {
          $('#sub_email_err').html('Email Subject Required!');
          err++;
       }
       else {
          $('#sub_email_err').html('');
       }
       if (mail_message == '') {
          $('#mail_message_err').html('Contect is Required!');
          err++;
       }
       else {
          $('#mail_message_err').html('');
       }
       if (to_email == '') {
          $('#to_email_err').html('Reciever Mail Required!');
          err++;  
       }
       else {
          $('#to_email_err').html('');
       }
       if (err > 0) {
          return false;
       }
       else {
          return true;
       }

    }
    // function get_all_files_name()
    // {
    //   $('.file_names').remove();
    //   var files = $('#attach_email').prop("files")
    //   var names = $.map(files, function(val) { return val.name; });
    //   for (var i = 0; i < names.length; i++) {
    //     $('.media-left').append('<span class="btn btn-primary file_names" style="padding: 5px; margin: 3px;">'+names[i]+'</span>');
    //   }
    // }
    function get_all_files_name()
    {
      $('.file_names').remove();
      var files = $('#attach_email').prop("files")
      var names = $.map(files, function(val) { return val.name; });
      var each_file_name = '';
      for (var i = 0; i < names.length; i++) {
        each_file_name = "'"+names[i]+"'";

        $('.attach-file-names').append('<span class="file_names" style="position:relative; cursor:pointer;" id="ind_file_in_attach_'+i+'"><button class="btn btn-primary" style="padding: 5px; margin: 3px;">'+names[i]+'</button><span class="m-badge m-badge--danger" style="position:absolute;right: 0;top: -15px;left: 255px;" onclick="rmv_attachment('+each_file_name+','+i+');">&times;</span></span>');
      }
      $('#removed_attachment_name').val('');
    }
    function rmv_attachment(file_name,id)
    {
      $('#ind_file_in_attach_'+id).remove();
      var remval = $('#removed_attachment_name').val();
      if(remval=='')
      {
        var removed_attachment_name = file_name;
      }
      else
      {
        var removed_attachment_name = remval+','+file_name;
      }
      $('#removed_attachment_name').val(removed_attachment_name);
      
    }
</script>