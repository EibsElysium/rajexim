<?php $this->load->view('common_header'); ?>
<link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-preview.min.css" rel="stylesheet" type="text/css" />          


            <div class="m-grid__item m-grid__item--fluid m-wrapper">



               <!-- BEGIN: Subheader -->

               <div class="m-subheader ">

                  <div class="d-flex align-items-center">

                     <div class="mr-auto">

                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                           <li class="m-nav__item m-nav__item--home">

                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">

                                 <i class="m-nav__link-icon fa fa-home"></i>

                              </a>

                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>

                           <li class="m-nav__item">

                              <a href="javascript:;" class="m-nav__link">

                                 <span class="m-nav__link-text">Mail Box</span>

                              </a>

                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>

                           <li class="m-nav__item">

                              <a href="<?php echo base_url(); ?>loadingtype" class="m-nav__link">

                                 <span class="m-nav__link-text">Compose Mail</span>

                              </a>

                           </li>

                        </ul>

                     </div>

                  </div>

               </div>



               <!-- END: Subheader -->

               <div class="m-content">

                  

                  <!--Begin::Section-->

                  <div class="row">

                     <div class="col-xl-12">

                        <div class="m-portlet m-portlet--mobile ">

                           <div class="m-portlet__head">

                              <div class="m-portlet__head-caption">

                                 <div class="m-portlet__head-title">

                                    <h3 class="m-portlet__head-text">

                                      Compose Email

                                    </h3>

                                 </div>

                              </div>

                              <div class="m-portlet__head-tools">


                              </div>

                           </div>

                           <div class="m-portlet__body">
                              <form role="form" class="form-horizontal send_newmail_ajax_form" enctype="multipart/form-data" onsubmit="return send_compose_validation();">
                                   <input type="hidden" id="from_email" name="from_email" value="<?php echo $info_email_name;?>">
                                   <input type="hidden" id="info_email" name="info_email" value="<?php echo $info_email;?>">
                                   <input type="hidden" name="mail_compose_from" value="<?php echo $mail_compose_from; ?>">
                                   <div class="row">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                         <label class="col-lg-1 control-label text-left" for="inputEmail">To</label>
                                         <div class="col-lg-11">
                                             <input type="text" id="to_email" name="to_email" class="form-control" value="<?php if($compose_mail_from_lead_or_mail == 1 ) { echo $lead_email; } else { echo ''; }?>">
                                             <p class="text-danger" id="to_email_err"></p>
                                         </div>
                                      </div>
                                    </div>
                                   </div>

                                   <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                           <label class="col-lg-1 control-label text-left" for="inputCc">Cc</label>
                                           <div class="col-lg-11">
                                               <input type="text" id="cc_email" name="cc_email" class="form-control">
                                           </div>
                                       </div>
                                     </div>
                                   </div>

                                   <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                           <label class="col-lg-1 control-label text-left" for="inputBcc">Bcc</label>
                                           <div class="col-lg-11">
                                               <input type="text" id="bcc_email" name="bcc_email" class="form-control">
                                           </div>
                                       </div>
                                     </div>
                                   </div>

                                   <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                           <label class="col-lg-1 control-label text-left" for="inputSubject">Subject</label>
                                           <div class="col-lg-11">
                                               <input type="text" id="sub_email" name="sub_email" class="form-control" value="">
                                               <p class="text-danger" id="sub_email_err"></p>

                                           </div>
                                       </div>
                                     </div>
                                   </div>

                                   <div class="row">
                                    <div class="col-lg-12">
                                       <!-- <div class="media pad-btm">
                                           <div class="media-left">
                                               <span class="btn btn-default btn-file">
                                                   Attachment <input type="file" onchange="get_all_files_name();" name="attach_email[]" id="attach_email" multiple>
                                               </span>
                                               
                                           </div>
                                           <div id="mailbox-attach-file" class="media-body"></div>
                                       </div> -->
                                       <input type="file" class="filepond" name="attach_email[]" id="attach_email" multiple>
                                     </div>
                                   </div>

                                   <div class="row" id="snote1">
                                    <i class="fa fa-power-off show_snote"></i>
                                    <div class="col-lg-12">
                                       <textarea name="content_email" id="mailbox-mail-compose"></textarea>
                                     </div>
                                   </div>

                                   <p class="text-danger" id="mail_message_err"></p>
                                   <input type="hidden" name="removed_attachment_name" id="removed_attachment_name">
                                   <div class="pad-ver">
                                       <button id="mail-send-btn" type="submit" name="btn_submit"  class="btn btn-primary">
                                           <i class="mailbox-psi-mail-send icon-lg icon-fw"></i> Send Mail
                                       </button>
                                       <button id="mail-draft-btn" type="button" name="btn_submit"  class="btn btn-primary">
                                           <i class="mailbox-psi-mail-send icon-lg icon-fw"></i> Save as Draft
                                       </button>
                                       <p id="mail_send_response_msg" class="text-primary"></p>
                                   </div>
                               </form>
                           </div>

                        </div>

                     </div>

                  </div>

                  <!--End::Section-->

               </div>

            </div>

         </div>



         <!-- end:: Body -->



         <!-- begin::Footer -->

         <?php $this->load->view('common_footer'); ?>
         
         <!-- end::Footer -->

      </div>

      <!-- end:: Page -->



      <!-- end::Scroll Top -->

      <!--begin::Modal-->

      <!-- Create Lead Status-->



<div class="container">
   <div class="modal fade show" id="mail_response_modal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Sending Email Response</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
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

<!-- <div class="container">
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
</div> -->



<script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-preview.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-exif-orientation.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-size.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-encode.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-type.min.js" type="text/javascript"></script>
<script type="text/javascript">

var baseurl = '<?php echo base_url(); ?>';

var title = $('title').text() + ' | ' + 'Loading Type List';

$(document).attr("title", title); 
$("#snote1 i.show_snote").click(function(){
 $('#snote1 .note-toolbar-wrapper').toggle();
 $('#snote1 .note-editable').toggleClass("mt");
});
var aj_err = 0;
   $('#mailbox-mail-compose').summernote('lineHeight', '5px');

    function send_compose_validation()
    {
       var sub_email = $('#sub_email').val();
       var mail_message = $('#mailbox-mail-compose').val();
       var to_email = $('#to_email').val();
       var err = 0; 
       if (sub_email == '') {
          $('#sub_email_err').html('Email Subject Required!');
          err++;
          aj_err++;
       }
       else {
          $('#sub_email_err').html('');
       }
       if (mail_message == '') {
          $('#mail_message_err').html('Contect is Required!');
          err++;
          aj_err++;
       }
       else {
          $('#mail_message_err').html('');
       }
       if (to_email == '') {
          $('#to_email_err').html('Reciever Mail Required!');
          err++;  
          aj_err++;
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

    $('#mail-draft-btn').click(function(){
      $('#mail-draft-btn').prop('disabled', true);
        
        var base_url = "<?php echo base_url(); ?>";
        var from_email = $('#from_email').val();
        var content_email = $('#mailbox-mail-compose').val();
        var to_email = $('#to_email').val();
        var sub_email = $('#sub_email').val();
        $.ajax({
            url: base_url+'Mailbox/draft_forward_mail_via_ajax',
            type: 'POST',
            data: { from_email: from_email, content_email: content_email, to_email: to_email, sub_email:sub_email },
            success: function (data) {
              
                $('#mail_send_response_msg').empty().html(data);
                $('#mail-draft-btn').prop('disabled', false);
                window.close();
            },
            
        });
    });
    $("form.send_newmail_ajax_form").submit(function(e) {
      if (aj_err == 0) {
        $('#mail-send-btn').prop('disabled', true);
        e.preventDefault();    
        var formData = new FormData(this);
        var base_url = "<?php echo base_url(); ?>";
        $.ajax({
            url: base_url+'Mailbox/send_forward_mail_via_ajax',
            type: 'POST',
            data: formData,
            success: function (data) {
              let result = data.replaceAll("Invalid address:", "");
                $('#mail_send_response_msg').empty().html(result);
                $('#modal_mail_send_response').empty().html(result);
                $('#mail_response_modal').modal('show');
                $('#mail-send-btn').prop('disabled', false);
                // $('#compose_mail_modal').modal('hide');
                // $('#compose_email_sent').show();
            },
            cache: false,
            contentType: false,
            processData: false
        });
      }
    });
    function get_all_files_name()
    {
      $('.file_names').remove();
      var files = $('#attach_email').prop("files")
      var names = $.map(files, function(val) { return val.name; });
      var each_file_name = '';
      for (var i = 0; i < names.length; i++) {
        each_file_name = "'"+names[i]+"'";

        $('.media-left').append('<span class="file_names" style="position:relative; cursor:pointer;" id="ind_file_in_attach_'+i+'"><button class="btn btn-primary" style="padding: 5px; margin: 3px;">'+names[i]+'</button><span class="m-badge m-badge--danger" style="position:absolute;right: 0;top: -15px;left: 255px;" onclick="rmv_attachment('+each_file_name+','+i+');">&times;</span></span>');
      }
      $('#removed_attachment_name').val('');
    }
    function rmv_attachment(file_name,id)
    {
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
      $('#ind_file_in_attach_'+id).remove();
    }
    get_email_signature_into_content();
    function get_email_signature_into_content()
    {
      var from_email = $('#from_email').val();
      var baseurl = '<?php echo base_url(); ?>';
      // alert(from_email);  
       if (from_email != '') {
        // alert(baseurl);  
          $.ajax({
             type: "POST",
             url:baseurl+'Leads/get_email_signature_into_content',
             data:{'email_id':from_email},
             dataType: "html",
             success: function(result){
                $("#mailbox-mail-compose").summernote("code", result);
                // $('#reply-mailbox-mail-compose').summernote('refresh');
             }
          });
       }
    }
</script>

</body>

   <!-- end::Body -->

</html>