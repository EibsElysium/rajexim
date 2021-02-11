  <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Upload Document</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

             <!-- onsubmit="return upload_document_validation();" -->
             
            <form name="lead_upload_document_form" id="lead_upload_document_form" action="<?php echo base_url(); ?>Leads/lead_upload_document_update" method="POST" 
               enctype="multipart/form-data" onsubmit="return upload_document_validation();"> 
                <div class="modal-body">
                  <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead_id; ?>">
                  <div class="row">
                      
                      <div class="col-lg-12">
                    
                          <h4 align="center"><strong>Instructions!</strong></h4>
                          <p class="text-muted text-justify" style="color:#434A54; text-indent:20px">
                            <i class="fa fa-star text-info"></i> Please Note that the file upload allowed <strong class="text-danger">PNG, JPEG, JPG, GIF, PDF, DOC, XLS, TXT</strong> file format only.
                          </p>
                           <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group m-form__group">
                                  <label for="exampleInputEmail1">Upload Document</label>
                                  <div></div>
                                  <div class="custom-file">
                                    <input type="file" onchange="file_ext_validation();" class="custom-file-input" id="lead_docs_file" name="files[]" multiple>
                                    <label class="custom-file-label" for="file">Choose Document</label>
                                  </div>
                                </div> 
                                <span id="upload_document_err" class="text-danger"></span>
                              </div>
                           </div>
                      </div>
                  </div>
                </div>
            
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Save Changes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
</form>
         </div>
      </div>
      <script type="text/javascript">
         function upload_document_validation(){
          
            err = 0;
            if($('#lead_docs_file').get(0).files.length === 0)
            {
               $('#upload_document_err').html('Upload Document is required!');
               err++;
            }

            else if($('#upload_document_err').html() != '')
            {
              err++;
            }
            else {
               $('#upload_document_err').html('');

            }
            if(err > 0)
            {
               return false;
            }else{
               $('#lead_upload_document_form').submit();
            }
         }
         function  file_ext_validation() {
              //var modelname=$("#inputmodelname").val();
              for (var i = 0; i < $("#lead_docs_file").get(0).files.length; ++i) {
                  var upload_document=$("#lead_docs_file").get(0).files[i].name;
                     
                      var file_size=$("#lead_docs_file").get(0).files[i].size;
                      
                          var ext = upload_document.split('.').pop().toLowerCase();                            
                          if($.inArray(ext,['jpg','jpeg','gif','png','doc','docx','xls','xlsx','txt','pdf'])===-1){
                            
                              $('#upload_document_err').html('Invalid file extension');
                            
                          }
                          else {
                              $('#upload_document_err').html('');
                          }

                                           
                  
              }
         }
      </script>
      <script type="text/javascript">

    $('.custom-file input').change(function (e) {
        if (e.target.files.length) {
            $(this).next('.custom-file-label').html(e.target.files[0].name);
        }
    });

</script>