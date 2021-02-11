<div class="row">			        
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
	                        Forward Message
	                    </h1>
	                </div>
	                <!--Input form onsubmit="return send_compose_validation();"-->
	                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Leads/send_forward_mail"  enctype="multipart/form-data" >
	                    <input type="hidden" id="from_email" name="from_email" value="<?php echo $message_details->company_email;?>">
	                    <input type="hidden" id="e_id" name="e_id" value="<?php echo $e_id;?>">
	                   <input type="hidden" name="lead_id" value="<?php echo $lead_id; ?>">
	                   <div class="form-group">
	                        <label class="col-lg-1 control-label text-left" for="inputEmail">From</label>
	                        <div class="col-lg-11">
	                            <input type="text" id="from_email" name="from_email" class="form-control" value="<?php echo $message_details->lead_email; ?>">
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-lg-1 control-label text-left" for="inputEmail">To</label>
	                        <div class="col-lg-11">
	                            <input type="text" id="to_email" name="to_email" class="form-control" value="">
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
						<div class="form-group">
	                        <label class="col-lg-1 control-label text-left" for="inputSubject">Attachment</label>
	                        <div class="col-lg-11">
	                            <!--Attact file button-->
					                <div class="media pad-btm">
					                    <div class="media-left">
					                        <span class="btn btn-default btn-file">
					                            Attachment <input type="file" name="attach_email[]" id="attach_email" multiple>
					                        </span>
					                    </div>
					                    <div id="mailbox-attach-file" class="media-body"></div>
					                </div>
					                <?php
                                		if(!empty($message_details->attach_file_name))
                                		{ 
                                			$ex_vals = explode(',', $message_details->attach_file_name);

                                			foreach($ex_vals as $ex_val) {?>
                                			<a href="<?php echo base_url(); ?>mail_box/files/<?php echo $message_details->uniqid; ?>/<?php echo $ex_val; ?>" download > <strong><?php echo $ex_val; ?></strong> <i class="mailbox-psi-paperclip icon-fw"></i></a>
                                		<?php }	}?>
	                        </div>
		                    </div>
		        		
	                <!--Wysiwyg editor : Summernote placeholder-->
	                <textarea name="content_email" id="f_mailbox-mail-compose">
	                	---------- Forwarded message ---------<br>
From: <?php echo $message_details->message_from; ?> <br>
Date: <?php echo date('d M Y, H:s', strtotime($message_details->mail_date)); ?><br>
Subject: <?php echo $message_details->subject; ?><br>
To: <?php echo $message_details->company_email; ?> <br><br>

	                	<?php echo $message_details->body_html; ?></textarea>
	                <!-- <div ></div> -->
	                
	                <div class="pad-ver">
					 
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
	$('#f_mailbox-mail-compose').summernote();
</script>