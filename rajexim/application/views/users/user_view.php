<div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">View User</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <div class="row">
            <div class="col-lg-12">
               <ul class="nav nav-pills nav-pills--theme" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" data-toggle="tab" href="#user_info">User info</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#user_product_info">Active Enquiries</a>
                  </li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="user_info" role="tabpanel">
                     <div class="row">
                        <div class="col-lg-9">
                           <h5 class="text-theme"><b>User Info</b></h5><hr>
                           <div class="row">
                                 <label class="col-lg-4">Name</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php echo ($user_details->name) ? $user_details->name: '-'; ?></p>
                           </div>
                           <div class="row">
                                 <label class="col-lg-4">D.O.B</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php echo ($user_details->dob != '0000-00-00') ? date('d-m-Y', strtotime($user_details->dob)) : '-'; ?></p>
                           </div>
                           <div class="row">
                                 <label class="col-lg-4">Gender</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php echo ($user_details->gender == 0) ? 'Male': 'Female'; ?></p>
                           </div>
                           <div class="row">
                                 <label class="col-lg-4">Email ID</label>
                                 <label class="col-lg-1">:</label>
                                 <?php 
                                    $user_emails = '';
                                    foreach ($users_emails_details as $user_email_own) {
                                       $user_emails .= ','.$user_email_own->user_emails;
                                    }
                                     $trimmed_user_emails = ltrim($user_emails,','); 
                                 ?>
                                 <p class="col-lg-7"><?php echo ($trimmed_user_emails) ? $trimmed_user_emails: '-'; ?></p>
                           </div>
                           
                           
                           <div class="row">
                                 <label class="col-lg-4">Role</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php echo ($user_details->role_name) ? $user_details->role_name: '-'; ?></p>
                           </div>
                           <div class="row">
                                 <label class="col-lg-4">Contact No</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php echo ($user_details->contact_no) ? $user_details->contact_no: '-'; ?></p>
                           </div>
                           <div class="row">
                                 <label class="col-lg-4">Address</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php echo ($user_details->address) ? $user_details->address: '-'; ?></p>
                           </div>
                           <div class="row">
                                 <label class="col-lg-4">Pincode</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php echo ($user_details->pincode) ? $user_details->pincode: '-'; ?></p>
                           </div>
                           <div class="row">
                                 <label class="col-lg-4">Allow Lead</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php echo ($user_details->allow_lead > 0) ? 'Yes' : 'No'; ?></p>
                           </div>   
                            <div class="row">
                                 <label class="col-lg-4">Show Leads</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php 

                                 if($user_details->show_leads == 1)
                                 {
                                    echo 'All Lead';
                                 }
                                 else if($user_details->show_leads == 2){
                                    echo 'My Leads';
                                 }
                                 else if($user_details->show_leads == 3){
                                    echo 'Product Users';
                                 }
                                 else { echo '-'; }

                                 ?></p>
                           </div>
                           <?php 
                              if($user_details->show_leads == 3)
                              { ?>
                                 <div class="row">
                                    <label class="col-lg-4">Product Users</label>
                                    <label class="col-lg-1">:</label>
                                    <p class="col-lg-7"><?php echo $user_details->product_users_name; ?></p>
                                  </div>
                              <?php } ?>
                           <h5 class="text-theme"><b>User Credential</b></h5><hr>
                           <div class="row">
                                 <label class="col-lg-4">Userame</label>
                                 <label class="col-lg-1">:</label>
                                 <p class="col-lg-7"><?php echo ($user_details->username) ? $user_details->username: '-'; ?></p>
                           </div>
                        </div>
                        <?php 
                        $profile = '';

                        if($user_details->profile_image != '')
                        {
                              $profile = base_url().'assets/user_profile/'.$user_details->profile_image;
                        }else{
                           $profile = base_url().'assets/images/default_image.jpg'; 
                        } ?>
                        <div class="col-lg-3">
                           <div class="row">
                              <div class="col-lg-12">
                                 <label>User Profile<label>
                                 <div style="margin:0 auto 10px;text-align:center;">
                                    <img src="<?php echo $profile; ?>"  class="img-responsive"  alt="employee" height="100" width="100">
                                 </div>
                              </div>

                              <?php if($user_details->signature != ''){

                                 $signature = base_url().'assets/user_signature/'.$user_details->signature;?>

                                    <div class="col-lg-12">
                                    <label>User Signature</label>
                                    <div style="margin:0 auto 10px;text-align:center;">
                                       <img src="<?php echo $signature; ?>"  class="img-responsive"  alt="employee" height="100" width="100">
                                    </div>
                                 </div>

                              <?php } ?>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="user_product_info" role="tabpanel">
                     <div class="row mt_25px">
                        <div class="col-lg-12">
                           <p class="top_head">
                              Product & Email ID
                           </p>
                           <div class="card-box">

                              <?php

                                 if(!empty($user_product_details))
                                 {
                                    foreach ($user_product_details as $key => $user_product_detail) { 
                                    
                                       $product_email = common_select_values('(SELECT GROUP_CONCAT(email_ID) FROM email_details WHERE  FIND_IN_SET(email_detail_id, GROUP_CONCAT(u.email_detail_id) )) as email_name', 'user_emails u', ' u.status !=2 AND u.user_id ="'.$user_product_detail->user_id.'" AND  u.product_id = "'.$user_product_detail->product_id.'"', 'row');

                                     ?>
                                       <h5  class="text-info"><?php echo $user_product_detail->product_name; ?></h5>
                                         <h5  class="text-success" ><?php echo $product_email->email_name; ?></h5>
                                       <hr>
                                    <?php }
                                 }else{ ?>
                                    <h5  class="text-default">No Product</h5>
                                 <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
   </div>
</div>