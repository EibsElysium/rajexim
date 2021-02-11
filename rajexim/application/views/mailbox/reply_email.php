<link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/jquery.fancybox.css" rel="stylesheet">
       <link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-preview.min.css" rel="stylesheet" type="text/css" />
<h5>Reply Message</h5>
<div class="panel">
    <div class="panel-body">
      
        <!--Input form-->
    <form role="form" class="form-horizontal send_reply_ajax_form" enctype="multipart/form-data" onsubmit="return send_compose_validation();">
            <input type="hidden" name="mail_reply_from" id="mail_reply_from" value="<?php echo $mail_reply_from; ?>">
            <input type="hidden" id="from_email" name="from_email" value="<?php echo $info_email_name;?>">
            <input type="hidden" id="info_email" name="info_email" value="<?php echo $info_email;?>">
            <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead_id;?>">
            <input type="hidden" name="mail_is_lead" id="mail_is_lead" value="<?php echo count($get_all_lead_based_contact_book_id); ?>">
            <?php if(count($get_all_lead_based_contact_book_id)>0) { ?>
            <div class="form-group">
                <label class="col-lg-2 control-label text-left" for="inputEmail">Choose Lead to Reply </label>
                <div class="col-lg-5">
                    <select class="form-control selectpicker" id="reply_lead_id" name="reply_lead_id">
                      <option value="">Choose Lead</option>
                      <?php foreach($get_all_lead_based_contact_book_id as $lead_list){ ?>
                        <option <?php echo ($lead_id == $lead_list['lead_id']) ? 'selected' : ''; ?> value="<?php echo $lead_list['lead_id']; ?>"><?php echo $lead_list['lead_code']; ?></option>
                      <?php } ?>
                    </select>
                    <p class="text-danger" id="reply_lead_id_err"></p>
                </div>
            </div>
            <?php } else { ?>
              <input type="hidden" id="reply_lead_id" name="reply_lead_id" value="">
            <?php } ?>
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
                    <input type="text" id="cc_email" name="cc_email" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label text-left" for="inputBcc">Bcc</label>
                <div class="col-lg-11">
                    <input type="text" id="bcc_email" name="bcc_email" class="form-control" value="">
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
        <!-- <div class="media pad-btm">
            <div class="media-left attach-file-names">
                <span class="btn btn-default btn-file">
                    Attachment <input type="file" name="attach_email[]" onchange="get_all_files_name();" id="attach_email" multiple>
                </span>
            </div>
            <div id="mailbox-attach-file" class="media-body"></div>
        </div> -->
        <div class="row">
          <div class="col-lg-12">
            <input type="file" class="filepond" name="attach_email[]" id="attach_email" multiple>
          </div>
        </div>
      <div class="row" id="snote1">
        <i class="fa fa-power-off show_snote"></i>
        <div class="col-lg-12">
        <!--Wysiwyg editor : Summernote placeholder-->
          <textarea name="content_email" id="mailbox-mail-compose"><?php echo $signature; echo $imap_email_lists['message']; ?></textarea>
          <!-- <div ></div> -->
          <p class="text-danger" id="mail_message_err"></p>
        </div>
      </div>
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

<div class="container">
   <div class="modal fade" id="mail_response_modal" data-keyboard="false" data-backdrop = "static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Sending Email Response</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
               <div class="modal-body">
                  <p id="modal_mail_send_response"></p>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
         </div>
      </div>
   </div>
</div>

<script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/jquery.fancybox.pack.js" type="text/javascript"></script>

 <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-preview.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-exif-orientation.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-size.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-encode.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-type.min.js" type="text/javascript"></script>               
<script type="text/javascript">
  $("#snote1 i.show_snote").click(function(){
   $('#snote1 .note-toolbar-wrapper').toggle();
   $('#snote1 .note-editable').toggleClass("mt");
  });
  $('.selectpicker').selectpicker();
  $('#mailbox-mail-compose').summernote('lineHeight', '5px');
    

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
    var re_err = 0;
    function send_compose_validation()
    {
       var sub_email = $('#sub_email').val();
       var mail_message = $('#mailbox-mail-compose').val();
       var to_email = $('#to_email').val();
       var mail_is_lead = $('#mail_is_lead').val();
       var err = 0; 
       // alert(err);
       // alert('Lead Count '+mail_is_lead);
       if (mail_is_lead != '0') {
        var reply_lead_id = $('#reply_lead_id').val();
        if (reply_lead_id == '') {
          // alert('new 1');
          $('#reply_lead_id_err').html('Choose Lead!');
          err++;
        }
        else {
          $('#reply_lead_id_err').html('');
        }
       }
       // else {
       //  err--;
       // }
       if (sub_email == '') {
        // alert('new 2');
          $('#sub_email_err').html('Email Subject Required!');
          err++;
       }
       else {
          $('#sub_email_err').html('');
       }
       if (mail_message == '') {
        // alert('new 3');
          $('#mail_message_err').html('Contect is Required!');
          err++;
       }
       else {
          $('#mail_message_err').html('');
       }
       if (to_email == '') {
        // alert('new 4');
          $('#to_email_err').html('Reciever Mail Required!');
          err++;  
       }
       else {
          $('#to_email_err').html('');
       }
       // alert('Err Count '+err);
       if (err > 0) {
          re_err = 1;
          return false;
       }
       else {
        re_err = 0;
        // $("form.send_reply_ajax_form").submit();
        return false;  
       }
       
       // alert(err);
      /* else {
          
          // err = 0;
       }*/

    }
    // alert('re_err '+re_err);
    $("form.send_reply_ajax_form").submit(function(e) {
        e.preventDefault(); 
      // alert(err);
      if(re_err == 0){
        $('#mail-send-btn').prop('disabled', true);
           
        var formData = new FormData(this);
        var base_url = "<?php echo base_url(); ?>";
        $.ajax({
            url: base_url+'Mailbox/send_reply_all_mail_via_ajax',
            type: 'POST',
            data: formData,
            success: function (data) {
                let result = data.replaceAll("Invalid address:", "");
                $('#mail_send_response_msg').empty().html(result);
                $('#modal_mail_send_response').empty().html(result);
                $('#mail_response_modal').modal('show');
                $('#mail-send-btn').prop('disabled', false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
      }
    });
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