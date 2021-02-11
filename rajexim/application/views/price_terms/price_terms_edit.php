<div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Price Terms</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>PriceTerms/update_price_term" onsubmit="return update_price_term_validation()">
                  <input type="hidden" name="price_term_id" value="<?php echo $price_term_by_id->price_term_id; ?>">
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Price Term Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input m-input--square" placeholder="Enter Price Term Name" name="e_price_term_name" id="e_price_term_name" onkeyup="e_checkUniquePriceTermName();" value="<?php echo $price_term_by_id->price_term_name; ?>">
                                    <input type="hidden" id="ex_price_term" value="<?php echo $price_term_by_id->price_term_name; ?>">
                                    <span id="e_price_term_name_err" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">                        
                              <div class="col-lg-12">
                                 <div class="form-group m-form__group">
                                    <label>Price Term<span class="text-danger">*</span></label>
                                    <textarea class="form-control m-input m-input--square" placeholder="Enter Price Term" name="e_price_term" id="e_price_term" ><?php echo $price_term_by_id->price_term; ?></textarea>
                                    <span id="e_price_term_err" class="text-danger"></span>
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
function e_checkUniquePriceTermName()
{
   var ex_val = $('#ex_price_term').val();
   var val = $('#e_price_term_name').val();
   if(ex_val.toLowerCase() != val.toLowerCase()) {
      $.ajax({
         type:"POST",
         url:baseurl+'PriceTerms/checkUniquePriceTermName',
         data:{'value':val},
         cache: false,
         dataType: "html",
         success: function(result){
            if(result>0)
            {
               $('#e_price_term_name_err').html('Price Term Name already exists!');
               $('#e_btnSubmit').prop('disabled', true);
               eexpo = 1;
            }
            else
            {
               $('#e_price_term_name_err').html('');
               $('#e_btnSubmit').prop('disabled', false);
               eexpo = 0;
            }
         }
      });
   }
}


 // To validate price terms add form
function update_price_term_validation()
{
   var err = 0;
   var name = $('#e_price_term_name').val();
   var term = $('#e_price_term').val();
   if(name.trim() == '')
   {
      $('#e_price_term_name_err').html('Price Term Name is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#e_price_term_name_err').html('Price Term Name already exists!');
         err++;
      }
      else
      {
         $('#e_price_term_name_err').html('');
      }
   }
   if (term.trim() == '') {
      $('#e_price_term_err').html('Price Term is required!');
      err++;
   }
   else {
      $('#e_price_term_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }   
}


</script>