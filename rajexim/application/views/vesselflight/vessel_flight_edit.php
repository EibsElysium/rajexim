<div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Vessel Flight</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form name="edit_exporter" id="edit_exporter" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>vesselflight/update_vessel_flight" onsubmit="return vessel_flight_edit_validation()">
               <input type="hidden" name="vessel_flight_id" id="vessel_flight_id" value="<?php echo $vessel_flight_list->vessel_flight_id;?>">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">                        
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <label>Vessel Flight<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control m-input m-input--square" placeholder="Enter Vessel Flight" name="vessel_flight_name" id="vessel_flight_name_edt" value="<?php echo $vessel_flight_list->vessel_flight_name;?>" onkeyup="checkUniqueVesselFlightEdit();">
                                 <span id="vessel_flight_name_edit_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" id="btnSubmit" class="btn btn-primary">Save Changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>

         </form>
      </div>
</div>

<script>
var eexpo = 0;
function checkUniqueVesselFlightEdit()
{
   var val = $('#vessel_flight_name_edt').val();
   var eid = $('#vessel_flight_id').val();

   $.ajax({
      type:"POST",
      url:baseurl+'vesselflight/checkUniqueVesselFlightEdit',
      data:{'value':val,'eid':eid},
      cache: false,
      dataStatus: "html",
      success: function(result){
         if(result>0)
         {
            $('#vessel_flight_name_edit_err').html('Vessel Flight already exists!');
            $('#btnSubmit').prop('disabled', true);
            eexpo = 1;
         }
         else
         {
            $('#vessel_flight_name_edit_err').html('');
            $('#btnSubmit').prop('disabled', false);
            eexpo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function vessel_flight_edit_validation()
{
   var err = 0;
   var name = $('#vessel_flight_name_edt').val();
   if(name == '')
   {
      $('#vessel_flight_name_edit_err').html('Vessel Flight is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#vessel_flight_name_edit_err').html('Vessel Flight already exists!');
         err++;
      }
      else
      {
         $('#vessel_flight_name_edit_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

</script>