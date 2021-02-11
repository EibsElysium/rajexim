<div class="modal-dialog modal-md" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit File Manager Access</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            
            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>Settings/update_f_acc" onsubmit="return update_f_acc_validation()">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <label>Folder<span class="text-danger">*</span></label>
                                 <input type="text" name="e_folder" id="e_folder" class="form-control" placeholder="Enter Folder Name" onkeyup="e_chk_unique_folder_name();" value="<?php echo $get_fa_by_id->folder_name; ?>"> 
                                 <input type="hidden" name="ex_folder" id="ex_folder" value="<?php echo $get_fa_by_id->folder_name; ?>">
                                 <span id="e_folders_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group m-form__group">
                                 <input type="hidden" name="f_id" value="<?php echo $get_fa_by_id->f_id; ?>">
                                 <label>Role<span class="text-danger">*</span></label>
                                 <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="e_role[]" id="e_role" multiple>
                                    
                                    <?php
                                       if(!empty($get_all_role_name))
                                       {
                                    foreach ($get_all_role_name as $role_info) { if($role_info->status == 0){ if($role_info->role_id != 1){ ?>
                                    <option <?php echo (in_array($role_info->role_id, $get_fai_by_id)) ? 'selected' : ''; ?> value="<?php echo $role_info->role_id; ?>" ><?php echo $role_info->role_name; ?></option>
                                    <?php } } }
                                       }
                                       ?>
                                 </select>
                                 
                                 <span id="e_role_err" class="text-danger"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" id="e_btnSubmit" class="btn btn-primary">Create</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
      <script>
         $('.m_selectpicker').selectpicker();
           var eexpo = 0;
   
   function e_chk_unique_folder_name()
   {
      var val = $('#e_folder').val();
      var ex_val = $('#ex_folder').val();

      if (val.toUpperCase() != ex_val.toUpperCase()) {
         $.ajax({
      
            type:"POST",
      
            url:baseurl+'Settings/chk_unique_folder_name',
      
            data:{'value':val},
      
            cache: false,
      
            dataType: "html",
      
            success: function(result){
      
               if(result>0)
      
               {
      
                  $('#e_folders_err').html('Folder Name is already exists!');
      
                  $('#e_btnSubmit').prop('disabled', true);
      
                  eexpo = 1;
      
               }
      
               else
      
               {
      
                  $('#e_folders_err').html('');
      
                  $('#e_btnSubmit').prop('disabled', false);
      
                  eexpo = 0;
      
               }
      
            }
      
         });
      }
   }
   function update_f_acc_validation()
   {
      var err = 0;
   
      var role = $('#e_role').val();
   
      var folders = $('#e_folder').val();
   
      if(role == '')
   
      {
   
         $('#e_role_err').html('Role is required!');
   
         err++;
   
      }else{
   
         if(eexpo == 1)
   
         {
   
            $('#e_role_err').html('Role is already exists!');
   
            err++;
   
         }
   
         else
   
         {
   
            $('#e_role_err').html('');
   
         }
   
      }
   
      if (folders == '') {
   
         $('#e_folders_err').html('Folders is required!');
   
         err++;
   
      }
   
      else {
   
         $('#e_folders_err').html('');
   
      }
   
      if(err> 0){ return false;}else{ return true; }   
   }
      </script>   
