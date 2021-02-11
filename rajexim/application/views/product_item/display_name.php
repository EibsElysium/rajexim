<div class="modal-dialog" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Display Name</span></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <form name="create_product_costing_stage" id="create_product_costing_stage" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>products/create_display_name" onsubmit="return display_name_validation()">
         <div class="modal-body">
            <div class="row">
               <input type="hidden" id="product_item_id" name="product_item_id" value="<?php echo $product_item->product_item_id;?>">
               <div class="col-lg-12">
                  <?php if(count($display_name_list)==0){?>
                     <div id="mcontent10">
                        <div id="mid0">
                           <div class="row">
                              <div class="col-lg-10">
                                 <div class="form-group m-form__group">
                                    <label>Display Name<span class="text-danger">*</span></label>
                                    <input type="text" name="display_name[]" id="display_name0" class="form-control" placeholder="Enter Display Name">
                                    <span class="text-danger" id="display_name_err0"></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <div class="pull-right">
                                 <button type="button" class="btn btn-primary" onclick="add_dpcs_type(0)">
                                    <i class="fa fa-plus"></i>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" id="mailcount" name="mailcount" value="1">
                  <?php }else{?>               
                     <div id="mcontent10">
                        <?php $i=0;foreach($display_name_list as $dname){?>
                           <div id="mid<?php echo $i;?>">
                              <div class="row">
                                 <div class="col-lg-10">
                                    <div class="form-group m-form__group">
                                       <label>Display_name<span class="text-danger">*</span></label>
                                       <input type="text" name="display_name[]" id="display_name<?php echo $i;?>" class="form-control" placeholder="Enter Display Name" value="<?php echo $dname['display_name'];?>">
                                       <span class="text-danger" id="display_name_err<?php echo $i;?>"></span>
                                    </div>
                                 </div>
                                 <?php if($i>0){?>
                                 <!-- <div class="col-lg-2">
                                    <div class="pull-right">
                                       <div class="form-group m-form__group mt_25px">
                                          <button type="button" onclick="remove_dprd_item(<?php //echo $i;?>);" class="btn btn-danger" ><i class="fa fa-minus"></i></button>
                                       </div>
                                    </div>
                                 </div> -->
                                 <?php }?>
                              </div>
                           </div>
                        <?php $i++;}?>
                     </div>

                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group m-form__group">
                              <div class="pull-right">
                                 <button type="button" class="btn btn-primary" onclick="add_dpcs_type(<?php echo $i;?>)">
                                    <i class="fa fa-plus"></i>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" id="mailcount" name="mailcount" value="<?php echo count($display_name_list);?>">
                  <?php }?>

               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" name="gobutton" value="go" class="btn btn-primary">Create</button>
           
         </div>
      </form>
   </div>
</div>    