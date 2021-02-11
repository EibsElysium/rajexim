<div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Update Costing Template</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <form method="POST" action="<?php echo base_url(); ?>Products/product_item_update" onsubmit="return e_product_item_validation();">
            <div class="modal-body">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group m-form__group">
                        <label>Product Name<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="product_name" id="e_product_name" onchange="e_prd_industry(this.value);"> 
                           <option value="">Choose</option>
                           <?php
                              if(!empty($product_lists))
                              {
                                 foreach ($product_lists as $product_list) { ?>
                                    <option value="<?php echo $product_list->product_id; ?>" <?php echo ($prd_item_details->product_id == $product_list->product_id) ?  'selected' : ''; ?> ><?php echo $product_list->product_name; ?></option>
                                 <?php }
                              }
                           ?>
                        </select>
                        
                        <span class="text-danger" id="e_product_name_err"></span>
                     </div>
                  </div>
               </div>
                <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Industry</label>
                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Industry" id="e_industry_name" name="industry_name" maxlength="60" autocomplete="off" readonly value="<?php echo $prd_item_details->industry_name; ?>"> 
                          <input type="hidden" class="form-control m-input m-input--square" placeholder="Enter Industry" id="e_industry_id" name="industry_id" maxlength="60" autocomplete="off" readonly value="<?php echo $prd_item_details->industry_id; ?>"> 
                        </div>
                     </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group m-form__group">
                        <label>Container<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" id="e_cont" name="product_item_cont" data-live-search="true"> 
                              <option value="">Select Container</option>
                              <?php foreach ($container_list as $value) { ?>
                                 <option value="<?php echo $value['container_id']; ?>" <?php echo $value['container_id'] == $prd_item_details->container_id?'selected':'';?>><?php echo $value['container_name'];?></option>
                                 <?php } ?>
                           </select> 
                        <span class="text-danger" id="e_prd_item_cont_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group m-form__group">
                        <label>Costing Template<span class="text-danger">*</span></label>
                        <input type="text" class="form-control m-input m-input--square" placeholder="Enter Costing Template" id="e_prd_item" name="product_item" maxlength="60" autocomplete="off" onblur="e_product_item_unique(this.value);" value="<?php echo $prd_item_details->product_item; ?>"> 

                        <input type="hidden" class="form-control m-input m-input--square" id="o_product_item" value="<?php echo $prd_item_details->product_item; ?>"> 

                        <span class="text-danger" id="e_prd_item_err"></span>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group m-form__group">
                        <label>Product Specification</label>
                        <!-- <input type="text" class="form-control m-input m-input--square" placeholder="Enter Costing Template Spec" id="e_prd_item_spec" name="product_item_spec" autocomplete="off" value="<?php //echo $prd_item_details->product_item_spec; ?>">  -->

                        <textarea class="form-control snote" placeholder="Enter Costing Template Spec" id="e_prd_item_spec" name="product_item_spec"><?php echo $prd_item_details->product_item_spec; ?></textarea>

                        <!-- <input type="hidden" class="form-control m-input m-input--square" id="o_product_item" value="<?php //echo $prd_item_details->product_item; ?>">  -->

                        <span class="text-danger" id="e_prd_item_spec_err"></span>
                     </div>
                  </div>
               </div>
            </div>
            <input type="hidden" name="product_item_id" id="product_item_id" value="<?php echo $prd_item_details->product_item_id; ?>">
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
         </form>


         </div>
      </div>
<script type="text/javascript">
   $('.m_selectpicker').selectpicker();
   $('.snote').summernote();
</script>