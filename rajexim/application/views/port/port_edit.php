<div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Port</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form name="edit_exporter" id="edit_exporter" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>port/update_port" onsubmit="return port_edit_validation()">
               <input type="hidden" name="port_id" id="port_id" value="<?php echo $port_list->port_id;?>">
               <div class="modal-body">
                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Vessel / Flight<span class="text-danger">*</span></label>
                           <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="vessel_flight_id" id="vessel_flight_id_edit"> 
                              <option value="">Choose Vessel/Flight</option>
                              <?php
                                 if(!empty($vessel_flight_list))
                                 {
                                    foreach ($vessel_flight_list as $vflist) { ?>
                                       <option value="<?php echo $vflist['vessel_flight_id']; ?>" <?php echo $port_list->vessel_flight_id == $vflist['vessel_flight_id']?'selected':'';?>><?php echo $vflist['vessel_flight_name']; ?></option>
                                    <?php }
                                 }
                              ?>
                           </select>
                           <span class="text-danger" id="vessel_flight_id_edit_err"></span>
                        </div>
                     </div>
                  </div>

                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Port Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Port Name" name="port_name" id="port_name_edit" onkeyup="checkUniquePortEdit();" value="<?php echo $port_list->port_name;?>">
                           <span id="port_name_edit_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>

                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Port City<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Port City" name="port_city" id="port_city_edit" value="<?php echo $port_list->port_city;?>">
                           <span id="port_city_edit_err" class="text-danger"></span>
                        </div>
                     </div>
                  </div>

                  <div class="row">                        
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Port Country<span class="text-danger">*</span></label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Port Country" name="port_country" id="port_country_edit" value="<?php echo $port_list->port_country;?>">
                           <span id="port_country_edit_err" class="text-danger"></span>
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

$('.m_selectpicker').selectpicker();

var eexpo = 0;
function checkUniquePortEdit()
{
   var val = $('#port_name_edit').val();
   var eid = $('#port_id').val();
   $.ajax({
      type:"POST",
      url:baseurl+'port/checkUniquePortEdit',
      data:{'value':val,'eid':eid},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#port_name_edit_err').html('Port already exists!');
            $('#btnSubmit').prop('disabled', true);
            eexpo = 1;
         }
         else
         {
            $('#port_name_edit_err').html('');
            $('#btnSubmit').prop('disabled', false);
            eexpo = 0;
         }
      }
   });
}


 // To validate lead Status add form
function port_edit_validation()
{
   var err = 0;
   var vfid = $('#vessel_flight_id_edit').val();
   var pname = $('#port_name_edit').val();
   var pcity = $('#port_city_edit').val();
   var pctry = $('#port_country_edit').val();

   if(vfid=='')
   {
      $('#vessel_flight_id_edit_err').html('Vessel Flight is required!');
      err++;
   }
   else
   {
      $('#vessel_flight_id_edit_err').html('');
   }

   if(pname == '')
   {
      $('#port_name_edit_err').html('Port Name is required!');
      err++;
   }else{
      if(eexpo == 1)
      {
         $('#port_name_edit_err').html('Port already exists!');
         err++;
      }
      else
      {
         $('#port_name_edit_err').html('');
      }
   }

   if(pcity=='')
   {
      $('#port_city_edit_err').html('Port City is required!');
      err++;
   }
   else
   {
      $('#port_city_edit_err').html('');
   }

   if(pctry=='')
   {
      $('#port_country_edit_err').html('Port Country is required!');
      err++;
   }
   else
   {
      $('#port_country_edit_err').html('');
   }
   
   if(err> 0){ return false;}else{ return true; }   
}

</script>