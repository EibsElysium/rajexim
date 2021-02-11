<h5>New Message</h5>
<div class="panel">
    <div class="panel-body">
      
        <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Leads/send_compose_mail"  enctype="multipart/form-data" onsubmit="return send_compose_validation();">
            <input type="hidden" id="from_email" name="from_email" value="<?php echo $info_email_name;?>">
            <input type="hidden" id="info_email" name="info_email" value="<?php echo $info_email;?>">
            <input type="hidden" name="mail_compose_from" value="<?php echo $compose_mail_from_lead_or_mail; ?>">
            <?php if($compose_mail_from_lead_or_mail == 1){ ?>
                <input type="hidden" name="lead_id" value="<?php echo $lead_id; ?>">
            <?php } ?>
            <div class="form-group">
                <label class="col-lg-1 control-label text-left" for="inputEmail">To</label>
                <div class="col-lg-11">
                    <input type="text" id="to_email" name="to_email" class="form-control" value="<?php if ($compose_mail_from_lead_or_mail == '1') { echo $lead_email; echo (trim($lead_a_email)!= '') ? ','.$lead_a_email : ''; }  else { echo ''; }  ?>">
                    <p class="text-danger" id="to_email_err"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label text-left" for="inputCc">Cc</label>
                <div class="col-lg-11">
                    <input type="text" id="cc_email" name="cc_email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label text-left" for="inputBcc">Bcc</label>
                <div class="col-lg-11">
                    <input type="text" id="bcc_email" name="bcc_email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label text-left" for="inputSubject">Subject</label>
                <div class="col-lg-11">
                    <input type="text" id="sub_email" name="sub_email"  class="form-control" value="">
                    <p class="text-danger" id="sub_email_err"></p>

                </div>
            </div>

        <!-- <div class="media pad-btm">
            <div class="media-left lead_emails_block_compose_attach">
                <span class="btn btn-default btn-file">
                    Attachment <input type="file" name="attach_email[]" onchange="compose_get_all_files_name();" id="attach_email" multiple>
                </span>
            </div>
            <div id="mailbox-attach-file" class="media-body"></div>
        </div> -->
        <div class="row">
          <div class="col-lg-12">
             <input type="file" class="filepond" id="attach_email" name="attach_email[]" multiple  />
          </div>
       </div>


        <textarea name="content_email" id="mailbox-mail-compose"></textarea>
        <p class="text-danger" id="mail_message_err"></p>
        <input type="hidden" name="removed_attachment_name" id="removed_attachment_name">
        
        <div class="pad-ver">
        
            <button id="mail-send-btn" type="submit" name="btn_submit"  class="btn btn-primary">
                <i class="mailbox-psi-mail-send icon-lg icon-fw"></i> Send Mail
            </button>
        </div>

</form>
    </div>
</div>
						    	
<script type="text/javascript">
	$('#mailbox-mail-compose').summernote();
FilePond.registerPlugin(
  // encodes the file as base64 data
  FilePondPluginFileEncode,

  // validates files based on input type
  FilePondPluginFileValidateType,

  // validates the size of the file
  FilePondPluginFileValidateSize,

  // corrects mobile image orientation
  FilePondPluginImageExifOrientation,

  // previews dropped images
  // FilePondPluginImagePreview
);
         
// Select the file input and use create() to turn it into a pond
FilePond.create(document.querySelector('#attach_email'), {
  acceptedFileTypes: []
});
    function compose_get_all_files_name()
    {
      $('.c_file_names').remove();
      var files = $('#attach_email').prop("files")
      var names = $.map(files, function(val) { return val.name; });
      var each_file_name = '';
      for (var i = 0; i < names.length; i++) {
        each_file_name = "'"+names[i]+"'";

        $('.lead_emails_block_compose_attach').append('<span class="c_file_names" style="position:relative; cursor:pointer;" id="ind_file_in_attach_'+i+'"><button class="btn btn-primary" style="padding: 5px; margin: 3px;">'+names[i]+'</button><span class="m-badge m-badge--danger" style="position:absolute;right: 0;top: -15px;left: 255px;" onclick="rmv_attachment('+each_file_name+','+i+');">&times;</span></span>');
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