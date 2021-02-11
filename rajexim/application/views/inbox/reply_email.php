<div class="row">

<!--===================================================-->

    <div class="col-md-12">
            <div class="panel">
	            <div class="panel-body">
	                <div class="mar-btm pad-btm clearfix">
	                    <!--Cc & bcc toggle buttons-->
	                    <div class="pull-right pad-btm">
	                        <div class="btn-group">
	                            <button id="mailbox-toggle-cc" data-toggle="button" type="button" class="btn btn-sm btn-default btn-active-info">Cc</button>
	                            <button id="mailbox-toggle-bcc" data-toggle="button" type="button" class="btn btn-sm btn-default btn-active-info">Bcc</button>
	                        </div>
	                    </div>
	
	                    <h1 class="page-header text-overflow">
	                        Reply Message
	                    </h1>
	                </div>
	                <!--Input form-->

	                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Leads/send_reply_mail"  enctype="multipart/form-data">
	                	<input type="hidden" name="mail_reply_from" value="1">
	                	<input type="hidden" name="e_id" value="<?php echo $e_id; ?>">
	                	<input type="hidden" name="lead_id" value="<?php echo $lead_id; ?>">
	                    <div class="form-group">
	                        <label class="col-lg-1 control-label text-left" for="inputEmail">To</label>
	                        <div class="col-lg-11">
	                            <input type="text" id="to_email" name="to_email" class="form-control" value="<?php echo $reply_mail; ?>">
	                        </div>
	                    </div>
	                    <div id="mailbox-cc-input" class="hide form-group">
	                        <label class="col-lg-1 control-label text-left" for="inputCc">Cc</label>
	                        <div class="col-lg-11">
	                            <input type="text" id="cc_email" name="cc_email" class="form-control">
	                        </div>
	                    </div>
	                    <div id="mailbox-bcc-input" class="hide form-group">
	                        <label class="col-lg-1 control-label text-left" for="inputBcc">Bcc</label>
	                        <div class="col-lg-11">
	                            <input type="text" id="bcc_email" name="bcc_email" class="form-control">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-lg-1 control-label text-left" for="inputSubject">Subject</label>
	                        <div class="col-lg-11">
	                            <input type="text" id="sub_email" name="sub_email"  class="form-control" value="<?php echo $message_details->subject; ?>">
	                        </div>
	                    </div>
	                
	
	
	                <!--Attact file button-->
	                <div class="media pad-btm">
	                    <div class="media-left">
	                        <span class="btn btn-default btn-file">
	                            Attachment <input type="file" name="attach_email[]" id="attach_email">
	                        </span>
	                    </div>
	                    <div id="mailbox-attach-file" class="media-body"></div>
	                </div>
	
	
	                <!--Wysiwyg editor : Summernote placeholder-->
	                <textarea name="content_email" id="mailbox-mail-compose"><?php echo $message_details->body_html; ?></textarea>
	                <!-- <div ></div> -->
	                <div class="pad-ver pull-right">
	
	                
	                    <!--Send button-->
	                    <button id="mail-send-btn" type="submit" name="btn_submit"  class="btn btn-primary">
	                        <i class="mailbox-psi-mail-send icon-lg icon-fw"></i> Send Mail
	                    </button>
	                </div>

            </form>
	            </div>
        </div>
	</div>

<!--===================================================-->
<!-- END COMPOSE EMAIL -->
</div>
<script type="text/javascript">
	$('#mailbox-mail-compose').summernote();
</script>