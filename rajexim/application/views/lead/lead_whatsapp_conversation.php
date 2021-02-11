<link href="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.css" rel="stylesheet" type="text/css" />
<style>

.chat-search-box {
    -webkit-border-radius: 3px 0 0 0;
    -moz-border-radius: 3px 0 0 0;
    border-radius: 3px 0 0 0;
    padding: .75rem 1rem;
}

.chat-search-box .input-group .form-control {
    -webkit-border-radius: 2px 0 0 2px;
    -moz-border-radius: 2px 0 0 2px;
    border-radius: 2px 0 0 2px;
    border-right: 0;
}

.chat-search-box .input-group .form-control:focus {
    border-right: 0;
}

.chat-search-box .input-group .input-group-btn .btn {
    -webkit-border-radius: 0 2px 2px 0;
    -moz-border-radius: 0 2px 2px 0;
    border-radius: 0 2px 2px 0;
    margin: 0;
}

.chat-search-box .input-group .input-group-btn .btn i {
    font-size: 1.2rem;
    line-height: 100%;
    vertical-align: middle;
}

@media (max-width: 767px) {
    .chat-search-box {
        display: none;
    }
}


/************************************************
  ************************************************
                  Users Container
  ************************************************
************************************************/

.users-container {
    position: relative;
    padding: 1rem 0;
    border-right: 1px solid #e6ecf3;
    height: 100%;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
}


/************************************************
  ************************************************
                      Users
  ************************************************
************************************************/

.users {
    padding: 0;
}

.users .person {
    position: relative;
    width: 100%;
    padding: 10px 1rem;
    cursor: pointer;
    border-bottom: 1px solid #f0f4f8;
}

.users .person:hover {
    background-color: #ffffff;
    /* Fallback Color */
    background-image: -webkit-gradient(linear, left top, left bottom, from(#e9eff5), to(#ffffff));
    /* Saf4+, Chrome */
    background-image: -webkit-linear-gradient(right, #e9eff5, #ffffff);
    /* Chrome 10+, Saf5.1+, iOS 5+ */
    background-image: -moz-linear-gradient(right, #e9eff5, #ffffff);
    /* FF3.6 */
    background-image: -ms-linear-gradient(right, #e9eff5, #ffffff);
    /* IE10 */
    background-image: -o-linear-gradient(right, #e9eff5, #ffffff);
    /* Opera 11.10+ */
    background-image: linear-gradient(right, #e9eff5, #ffffff);
}

.users .person.active-user {
    background-color: #ffffff;
    /* Fallback Color */
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f7f9fb), to(#ffffff));
    /* Saf4+, Chrome */
    background-image: -webkit-linear-gradient(right, #f7f9fb, #ffffff);
    /* Chrome 10+, Saf5.1+, iOS 5+ */
    background-image: -moz-linear-gradient(right, #f7f9fb, #ffffff);
    /* FF3.6 */
    background-image: -ms-linear-gradient(right, #f7f9fb, #ffffff);
    /* IE10 */
    background-image: -o-linear-gradient(right, #f7f9fb, #ffffff);
    /* Opera 11.10+ */
    background-image: linear-gradient(right, #f7f9fb, #ffffff);
}

.users .person:last-child {
    border-bottom: 0;
}

.users .person .user {
    display: inline-block;
    position: relative;
    margin-right: 10px;
}

.users .person .user img {
    width: 48px;
    height: 48px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}

.users .person .user .status {
    width: 10px;
    height: 10px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
    background: #e6ecf3;
    position: absolute;
    top: 0;
    right: 0;
}

.users .person .user .status.online {
    background: #9ec94a;
}

.users .person .user .status.offline {
    background: #c4d2e2;
}

.users .person .user .status.away {
    background: #f9be52;
}

.users .person .user .status.busy {
    background: #fd7274;
}

.users .person p.name-time {
    font-weight: 600;
    font-size: .85rem;
    display: inline-block;
}

.users .person p.name-time .time {
    font-weight: 400;
    font-size: .7rem;
    text-align: right;
    color: #8796af;
}

@media (max-width: 767px) {
    .users .person .user img {
        width: 30px;
        height: 30px;
    }
    .users .person p.name-time {
        display: none;
    }
    .users .person p.name-time .time {
        display: none;
    }
}


/************************************************
  ************************************************
                  Chat right side
  ************************************************
************************************************/

.selected-user {
    width: 100%;
    padding: 0 15px;
    min-height: 64px;
    line-height: 64px;
    border-bottom: 1px solid #e6ecf3;
    -webkit-border-radius: 0 3px 0 0;
    -moz-border-radius: 0 3px 0 0;
    border-radius: 0 3px 0 0;
}

.selected-user span {
    line-height: 100%;
}

.selected-user span.name {
    font-weight: 700;
}

.chat-container {
    position: relative;
    padding: 1rem;
    width: 100%;
}

.chat-container li.chat-left,
.chat-container li.chat-right {
    display: flex;
    flex: 1;
    flex-direction: row;
    margin-bottom: 40px;
}

.chat-container li img {
    width: 48px;
    height: 48px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
}

.chat-container li .chat-avatar {
    margin-right: 20px;
}

.chat-container li.chat-right {
    justify-content: flex-end;
}

.chat-container li.chat-right > .chat-avatar {
    margin-left: 20px;
    margin-right: 0;
}

.chat-container li .chat-name {
    font-size: .75rem;
    color: #999999;
    text-align: center;
}

.chat-container li .chat-text {
    padding: .4rem 1rem;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #ffffff;
    font-weight: 300;
    line-height: 150%;
    position: relative;
    max-width: 510px;
}

.chat-container li .chat-text:before {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    top: 10px;
    left: -20px;
    border: 10px solid;
    border-color: transparent #ffffff transparent transparent;
}

.chat-container li.chat-right > .chat-text {
    text-align: right;
    max-width: 510px;
}

.chat-container li.chat-right > .chat-text:before {
    right: -20px;
    border-color: transparent transparent transparent #ffffff;
    left: inherit;
}

.chat-container li .chat-hour {
    padding: 0;
    margin-bottom: 10px;
    font-size: .75rem;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin: 0 0 0 15px;
}

.chat-container li .chat-hour > span {
    font-size: 16px;
    color: #9ec94a;
}

.chat-container li.chat-right > .chat-hour {
    margin: 0 15px 0 0;
}

@media (max-width: 767px) {
    .chat-container li.chat-left,
    .chat-container li.chat-right {
        flex-direction: column;
        margin-bottom: 30px;
    }
    .chat-container li img {
        width: 32px;
        height: 32px;
    }
    .chat-container li.chat-left .chat-avatar {
        margin: 0 0 5px 0;
        display: flex;
        align-items: center;
    }
    .chat-container li.chat-left .chat-hour {
        justify-content: flex-end;
    }
    .chat-container li.chat-left .chat-name {
        margin-left: 5px;
    }
    .chat-container li.chat-right .chat-avatar {
        order: -1;
        margin: 0 0 5px 0;
        align-items: center;
        display: flex;
        justify-content: right;
        flex-direction: row-reverse;
    }
    .chat-container li.chat-right .chat-hour {
        justify-content: flex-start;
        order: 2;
    }
    .chat-container li.chat-right .chat-name {
        margin-right: 5px;
    }
    .chat-container li .chat-text {
        font-size: .8rem;
    }
}

.chat-form {
    padding: 15px;
    width: 100%;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ffffff;
    border-top: 1px solid white;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.card {
    border: 0;
    background: #f4f5fb;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    margin-bottom: 2rem;
    box-shadow: none;
}
ul#comments_block {
    max-height: 200px;
    overflow-y: scroll;
}
</style>
<div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"><?php echo (isset($view_from)) ? $view_from : ''; ?> Comments </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Leads/add_whatsapp_conversation" onsubmit="return add_whatsapp_validataion()">
      <div class="modal-body" style="padding: 0px;">
         <?php if (count($get_whatsapp_conversation)>0){ ?>
            <div class="row">
               <div class="col-md-9"></div>
               <div class="col-md-3">
                  
               </div>
            </div>
            <div class="row">
                                                 <div class="col-md-12">
                                                   <br>
                                                   <div class="row page-header">
                                                      <div class="col-md-3"> <h5 style="padding-left: 15px;padding-top: 13px;"><?php echo count($get_whatsapp_conversation); ?> Message<?php echo(count($get_whatsapp_conversation) > 1) ? 's' : '' ?></h5> </div>
                                                      <div class="col-md-6"></div>
                                                      <div class="col-md-3">
                                                         <input type="text" id="search_in_comment" class="form-control" placeholder="Search in Comments" style="margin-bottom: 8px;width: 161px;">
                                                      </div>
                                                   </div> 
                                                   <div class="container">
                                                       <div class="content-wrapper">

                                                           <div class="row gutters">

                                                               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                                                   <div class="card m-0">

                                                                       <!-- Row start -->
                                                                       <div class="row no-gutters">
                                                                              
                                                                               <div class="chat-container">
                                                                                   <ul class="chat-box chatContainerScroll ul-li" id="comments_block">
                                                                                    <?php foreach($get_whatsapp_conversation as $botlist){ 
                                                                                      $get_user_info = common_select_values('*','users','user_id = "'.$botlist->created_by.'"','row');
                                                                                       ?>
                                                                                       <li class="chat-left each_comments_blocks">
                                                                                           <div class="chat-avatar">
                                                                                               <img src="<?php echo base_url(); ?>assets/user_profile/<?php echo $get_user_info->profile_image; ?>">
                                                                                               <div class="chat-name"><?php echo $get_user_info->name;?></div>
                                                                                           </div>
                                                                                           <div class="chat-text">
                                                                                             <?php  
                                                                                               echo $botlist->messages; 

                                                                                               if ($botlist->attachments != '') { 
                                                                                                  ?>
                                                                                             <hr>
                                                                                             <h5 class="text-info">Attachments</h5>
                                                                                             <?php
                                                                                                 $exp_files = explode(',',$botlist->attachments);

                                                                                                 $extenions = array('PDF', 'pdf', 'txt', 'TXT', 'DOC', 'doc', 'DOCX', 'docx', 'XL', 'xl', 'XLS', 'xls', 'xlsx', 'XLSX');
                                                                                                  $img_extenions = array('PNG', 'png', 'JPEG', 'jpeg', 'JPG', 'jpg', 'GIF', 'gif');
                                                                                                  $other_files = array();
                                                                                                  $images_files = array();
                                                                                                  if(count($exp_files) > 0)
                                                                                                  {
                                                                                                     for($i = 0; $i < count($exp_files); $i++)
                                                                                                     {
                                                                                                        $ex_val = explode('.', $exp_files[$i]);
                                                                                                        if(!empty($ex_val) && in_array($ex_val[1], $extenions))
                                                                                                        { 
                                                                                                           $other_files[] = $exp_files[$i];
                                                                                                        }

                                                                                                        if(!empty($ex_val) && (in_array($ex_val[1], $img_extenions)))
                                                                                                        { 
                                                                                                           $images_files[] = $exp_files[$i];
                                                                                                        }

                                                                                                     } 
                                                                                                  }
                                                                                                 ?>
                                                                                                 <?php 
                                                                                                    if(!empty($other_files))
                                                                                                    {
                                                                                                       foreach ($other_files as $key => $other_file) { ?>
                                                                                                          <a href="<?php echo base_url(); ?>assets/whatsapp_attach/<?php echo $other_file; ?>" download><h5 style="word-break: break-all;"><?php echo $other_file; ?></h5></a><hr>
                                                                                                       <?php } ?>
                                                                                                       
                                                                                                 
                                                                                                 <?php } ?>
                                                                                                 <?php 
                                                                                                 if(!empty($images_files))
                                                                                                  {

                                                                                                     foreach ($images_files as $key => $images_file) { ?>
                                                                                                        <a class="fancybox" href="<?php echo base_url(); ?>assets/whatsapp_attach/<?php echo $images_file; ?>"  data-fancybox-group="gallery" ><img src="<?php echo base_url(); ?>assets/whatsapp_attach/<?php echo $images_file; ?>" width="50" height="50"></a>
                                                                                                        
                                                                                                     <?php } ?>
                                                                                                  <?php } ?>
                                                                                             <?php }
                                                                                             ?>    
                                                                                           </div>
                                                                                           <div class="chat-hour"><?php echo time_elapsed_string_in_helper($botlist->created_on);?> <span class="fa fa-check-circle"></span></div>
                                                                                       </li>
                                                                                       
                                                                                    <?php }  ?>
                                                                                   </ul>
                                                                                   
                                                                               </div>
                                                                           
                                                                       </div>
                                                                       <!-- Row end -->
                                                                   </div>

                                                               </div>

                                                           </div>
                                                           <!-- Row end -->

                                                       </div>
                                                       <!-- Content wrapper end -->

                                                   </div>
                                                     
                                                 </div>
                                             </div>
      
       <?php } ?>
       <div class="container">
         
           <div class="row">
              <div class="col-lg-12">
                 <div class="row">                        
                    <div class="col-lg-12">
                       <div class="form-group m-form__group">
                          <label>Messages<span class="text-danger">*</span></label>
                          <textarea class="form-control m-input m-input--square whatsapp_summernote" placeholder="Enter Whatsapp Messages" name="whatsapp_messages" id="whatsapp_messages"></textarea>
                          <input type="hidden" name="message_lead_id" value="<?php echo $lead_id; ?>">
                          <input type="hidden" name="msg_from_list_or_view" value="<?php echo $whatsapp_view_from; ?>">
                          <span id="whatsapp_messages_err" class="text-danger"></span>
                       </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-lg-12">
                       <input type="file" class="filepond" name="whatsapp_attach[]" id="whatsapp_attach" multiple>
                     </div>
                   </div>
              </div>
           </div>
<!--            <div class="row">
             <div class="col-lg-9"></div>
             <div class="col-lg-3"></div>
           </div> -->
           
         
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btnSubmit" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
   </div>
</div>
<script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-preview.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-image-exif-orientation.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-size.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-encode.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/demo/demo12/fileuploader/filepond-plugin-file-validate-type.min.js" type="text/javascript"></script>
<script>
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

  FilePond.create(document.querySelector('#whatsapp_attach'), {
acceptedFileTypes: []
});
$(document).ready(function(){
  $("#search_in_comment").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#comments_block .each_comments_blocks").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  // $("#comments_block").pagify(6, ".each_comments_blocks");
});   

$('.whatsapp_summernote').summernote();
function add_whatsapp_validataion()
{
   var whatsapp_messages = $('#whatsapp_messages').val();
   var err = 0;
   if (whatsapp_messages == '') {
      $('#whatsapp_messages_err').html('Message is Required!');
      err++;
   }
   else {
      $('#whatsapp_messages_err').html('');
   }
   if (err > 0) {
      return false;
   }
   else {
      return true;
   }
}
</script>