<div class="modal-dialog lg" role="document">
  <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Lead Import</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
             
            <form name="lead_import_form" id="lead_import_form" action="<?php echo base_url(); ?>Leads/lead_bulk_import_update" method="POST" 
               enctype="multipart/form-data" onsubmit="return lead_upload_validation();">
            <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-12">
                        
                          <h4 align="center"><strong>Instructions!</strong></h4>
                          <p class="text-muted text-justify" style="color:#434A54; text-indent:20px">
                            <i class="fa fa-star"></i> Please Note that the allowed XL file format for upload is  <strong class="text-danger">*.XLSX only.</strong>
                          </p>
                          <p class="text-muted text-justify" style="color:#434A54; text-indent:20px">
                            <i class="fa fa-star"></i> Sample file attached for your reference <a href="<?php echo base_url();?>Leads/lead_upload_file" download style="text-decoration:none"><i class="fas fa-cloud-download-alt" ></i></a> .
                          </p>
                          <p class="text-muted text-justify" style="color:#434A54; text-indent:20px; page-break-inside:auto">
                            <i class="fa fa-star"></i> Save your spreadsheet XL file with extension as <strong class="text-danger">.xlsx</strong> and click Upload. Files with format other than .xlsx will not be allowed.
                          </p>
                        
                      </div>
                  </div>
                   <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Lead Upload</label>
                        <div></div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="lead_import" name="lead_import">
                          <label class="custom-file-label" for="file">Choose File</label>
                        </div>
                        <span id="lead_import_err" class="text-danger"></span>
                      </div> 
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Upload</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
  </div>
</div>


<script type="text/javascript">
  var l_er=0;
  $("#lead_import").change(function () 
  {
  //var fileExtension = ['xls', 'xlsx', 'csv'];
  var fileExtension = ['xlsx','xls'];
  if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
      $('#lead_import_err').html('Invalid File!');
      l_er++;
  }
  else
  {            
      $('#lead_import_err').html('');
      
  }
});

 function lead_upload_validation()
 {

    var lead_import = $('#lead_import').val();
    err = 0;
    if(lead_import == '')
    {
       $('#lead_import_err').html('Upload File is required!');
       err++;
    }
    else if(l_er > 0)
    {
      $('#lead_import_err').html('Invalid File!');
       err++;
    }
    else{
      $('#lead_import_err').html('');
    }

    if(err > 0)
    {
       return false;
    }else{
       $('#lead_import_form').submit();
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