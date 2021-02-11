<div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Quarter year</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Settings/update_quarter_year" onsubmit="return update_quarter_year_validation()">
                  <input type="hidden" name="quarter_id" value="<?php echo $get_quarter_year_by_id->quarter_id; ?>">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Quarter Label<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Quarter Label Name" name="q_label" id="q_label" onkeyup="chk_unnique_label();" value="<?php echo $get_quarter_year_by_id->quarter_label; ?>">
                                    <input type="hidden" id="ex_q_label" value="<?php echo $get_quarter_year_by_id->quarter_label; ?>">
                                    <span id="q_label_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">                        
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>Start Date<span class="text-danger">*</span></label>
                                    <input class="form-control m-input m-input--square date_month" placeholder="Enter Start Date" name="s_date" id="s_date" value="<?php echo $get_quarter_year_by_id->start_month_date; ?>">
                                    <span id="s_date_err" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group m-form__group">
                                    <label>End Date<span class="text-danger">*</span></label>
                                    <input class="form-control m-input m-input--square date_month" placeholder="Enter End Date" name="e_date" id="e_date" value="<?php echo $get_quarter_year_by_id->end_month_date; ?>">
                                    <span id="e_date_err" class="text-danger"></span>
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
   $('.date_month').datepicker({
        minViewMode: 1,
         todayHighlight: true,
        format: 'd-m',
          autoclose: true
   });
var eexpo = 0;
function chk_unnique_label()
{
   var ex_val = $('#ex_q_label').val();
   var val = $('#q_label').val();
   if(ex_val.toLowerCase() != val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'Settings/chk_unnique_label',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#q_label_err').html('Quarter Label already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#q_label_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate price terms add form
function update_quarter_year_validation()
{
   var err = 0;
   var name = $('#q_label').val();
   var start = $('#s_date').val();
   var end = $('#e_date').val();
   if(name.trim() == '')
   {
      $('#q_label_err').html('Quarter Label is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#q_label_err').html('Quarter Label Name already exists!');
         err++;
      }
      else
      {
         $('#q_label_err').html('');
      }
   }
   if (start.trim() == '') {
      $('#s_date_err').html('Start Date is required!');
      err++;
   }
   else {
      $('#s_date_err').html('');
   }
   if (end.trim() == '') {
      $('#e_date_err').html('End Date is required!');
      err++;
   }
   else {
      $('#e_date_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }   
}


</script>