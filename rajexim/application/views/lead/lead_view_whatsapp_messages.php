<div class="modal-dialog lg" role="document">
  <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Lead Whatsapp Messages</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
             
          <form  action="<?php echo base_url(); ?>Leads/lead_bulk_import_update" method="POST" 
               enctype="multipart/form-data" onsubmit="return lead_upload_validation();">
            <div class="modal-body">
             
                <fieldset>
                  <legend class="text-info"><b>Whatsapp Messages</b></legend>

                  <?php echo $get_whatsapp_conversations->messages; ?> 
                </fieldset>
                
                <fieldset>
                  <legend class="text-info"><b>Whatsapp Attachments</b></legend>
                  <?php  

                    if ($get_whatsapp_conversations->attachments != '') { 
                       ?>
                  <?php
                      $exp_files = explode(',',$get_whatsapp_conversations->attachments);

                      $extenions = array('PDF', 'pdf', 'txt', 'TXT', 'DOC', 'doc', 'DOCX', 'docx', 'XL', 'xl', 'XLS', 'xls', 'xlsx', 'XLSX', 'sql', 'SQL');
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
                </fieldset>
                
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
  </div>
</div>
<script>
  $('.fancybox').fancybox();
</script>