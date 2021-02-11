<div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">View Product</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-lg-4">
                     <h6><b>Product Name</b></h6>
                     <h5  class="text-theme"><?php echo ($product_details->product_name) ? $product_details->product_name : '-'; ?> </h5>
                  </div>
                  <div class="col-lg-4">
                     <h6><b>Industry Name</b></h6>
                     <h5  class="text-theme"><?php echo ($product_details->industry_name) ? $product_details->industry_name : '-'; ?></h5>
                  </div>
                  <div class="col-lg-4">
                     <h6><b>Product Description</b></h6>
                     <h5  class="text-theme"><?php echo ($product_details->description != '') ? $product_details->description : '-'; ?></h5>
                  </div>
               </div>
               <div class="row mt_25px">
                     <div class="col-lg-6">
                        <p class="top_head">
                           <i class="fa fa-user"></i>&nbsp;&nbsp;Users
                        </p>
                        <div class="card-box">

                            <?php
                              if(!empty($product_users))
                              {
                                 foreach ($product_users as $key => $product_user) { ?>
                                    <h5  class="text-default"><?php echo $product_user->user_name; ?></h5>
                                    <hr>
                                 <?php }
                              }else{ ?>
                                 <h5  class="text-default">No User</h5>
                              <?php } ?>
                        </div>
                     
                     </div>
                     <div class="col-lg-6">
                        <p class="top_head">
                         <i class="fa fa-envelope"></i>&nbsp;&nbsp;  Email ID
                        </p>
                        <div class="card-box">

                           <?php
                              if(!empty($product_emails))
                              {
                                 foreach ($product_emails as $key => $product_email) { ?>
                                    <h5  class="text-default"><?php echo $product_email['email_name']; ?></h5>
                                    <hr>
                                 <?php }
                              }else{ ?>
                                 <h5  class="text-default">No Email ID</h5>
                              <?php } ?>
                        </div>
                     </div>
               </div>

               <!-- <h5 class="text-theme">Map With Product Costing</h5><hr>
               <div class="row">
                  <div class="col-lg-12">
                     <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
                        <thead>
                           <tr>
                              <th width="50%">Costing Category</th>
                              <th width="50%">Costing Type</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php //foreach($pcp_mapping as $pcpm){?>
                           <tr>
                              <td><h5><?php //echo $pcpm['product_costing_category_name'];?></h5></td>
                              <td>
                                 <?php //$pct = explode(',', $pcpm['pctype']);
                                 //foreach($pct as $pctype){?>
                                 <h6>
                                    <span><i class="fa fa-angle-double-right"></i></span>&nbsp;&nbsp;
                                    <span><?php //echo $pctype;?></span>
                                 </h6>
                                 <?php //}?>
                              </td>
                           </tr>
                           <?php //}?>
                        </tbody>
                     </table>
                  </div>
               </div> -->
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
         </div>
      </div>