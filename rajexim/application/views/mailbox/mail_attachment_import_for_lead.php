<div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Import Lead Attachment</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
         <div class="modal-body">
            <label class="label">Choose To Add As Document</label>
            <select class="form-control selectpicker" data-live-search="true" id="lead_import_lead_id">
               <option value="">Choose Leads</option>
               <?php foreach ($all_lead_info as $key => $value) { ?>
                  <option value="<?php echo $value->lead_id; ?>"><?php echo $value->lead_code.' - '.$value->company_name.' - '.$value->product_name; ?></option>
               <?php } ?>
            </select>
            <p class="text-danger" id="lead_import_lead_id_err"></p>
            <input type="hidden" id="lead_import_label" value="<?php echo $label; ?>">
            <input type="hidden" id="lead_import_email_id" value="<?php echo $emailid; ?>">
            <input type="hidden" id="lead_import_msg_no" value="<?php echo $msg_no; ?>">
            <input type="hidden" id="lead_import_contact_book_id" value="<?php echo $contact_book_id; ?>">
            <!-- <input type="hidden" id="lead_import_email_id"> -->
            <p id="imp_mail_label"></p>
         </div>
         <div class="modal-footer">
           <button type="button" onclick="import_lead_validation();" id="attach_btn" class="btn btn-primary">Yes</button>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
         </div>
   </div>
</div>
<script>
   $('.selectpicker').selectpicker();
   function import_lead_validation()
   {
      $('#attach_btn').prop('disabled','true');
      var lead_id = $('#lead_import_lead_id').val();
      var label = $('#lead_import_label').val();
      var email_id = $('#lead_import_email_id').val();
      var msg_no = $('#lead_import_msg_no').val();
      var contact_book_id = $('#lead_import_contact_book_id').val();
      
      var err = 0;
      if (lead_id == '') {
         $('#lead_import_lead_id_err').html('Choose Any one Lead!');
         err++;
      }
      else {
         $('#lead_import_lead_id_err').html('');
      }
      if (err==0) { 
         $.ajax({
            url:baseurl+'Mailbox/import_email_attachment_for_lead',
            type:'POST',
            data:{'lead_id':lead_id,'label':label,'email_id':email_id,'msg_no':msg_no,'contact_book_id':contact_book_id},
            dataType: 'html',
            success:function(result){
               if (result == 1) {

                  $('#import_lead_attachment_modal').modal('toggle');
                  $('#attach_btn').prop('disabled','false');
                  $('#mail_attach_import_msg').show();
                  $('#mail_attach_import_msg').fadeOut(5000);
               }
            }
         });
      }
   }
</script>
