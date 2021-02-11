<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Document Required</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Document_Req/update_doc_req" onsubmit="return edit_doc_req_validataion()">
         <input type="hidden" name="doc_req_id" value="<?php echo $doc_req_by_id->document_required_id; ?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Document Required<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Document Required" name="e_doc_req" id="e_doc_req" onkeyup="e_checkUniquedocReq();" value="<?php echo $doc_req_by_id->document_required; ?>">
                           <input type="hidden" id="ex_doc_req" value="<?php echo $doc_req_by_id->document_required; ?>">
                           <span id="e_doc_req_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" id="e_btnSubmit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </form>
   </div>
</div>
<script>
  
var eexpo = 0;
function e_checkUniquedocReq()
{
   var ex_val = $('#ex_doc_req').val();
   var val = $('#e_doc_req').val();
   if (val.toLowerCase() != ex_val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'Document_Req/checkUniquedocReq',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_doc_req_err').html('Document Required already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_doc_req_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate lead Status add form
function edit_doc_req_validataion()
{
   var err = 0;
   var name = $('#e_doc_req').val();
   if(name == '')
   {
      $('#e_doc_req_err').html('Document Required is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#e_doc_req_err').html('Document Required already exists!');
         err++;
      }
      else
      {
         $('#e_doc_req_err').html('');
      }
   }
  
   if(err> 0){ return false;}else{ return true; }   
}



</script>