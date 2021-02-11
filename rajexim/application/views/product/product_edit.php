<div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form method="POST" action="<?php echo base_url(); ?>Products/product_update" onsubmit="return e_product_validation();">
            <div class="modal-body">
             <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group m-form__group">
                              <label>Industry Name<span class="text-danger">*</span></label>
                              <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="industry_id" id="e_industry_id">
                                 <option value="">Choose Industry</option>
                                 <?php
                                    if(!empty($industry_lists))
                                    {
                                       foreach ($industry_lists as $key => $industry_list) { if($industry_list->status == 0){ ?>
                                          <option value="<?php echo $industry_list->industry_id; ?>" <?php echo ($product_details->industry_id == $industry_list->industry_id) ? 'selected': '';?>><?php echo $industry_list->industry_name; ?></option>
                                       <?php } }
                                    }
                                 ?>
                              </select>
                              <span class="text-danger" id="e_industry_id_err"></span>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group m-form__group">
                              <label>Product Name<span class="text-danger">*</span></label>
                              <input type="text" class="form-control m-input m-input--square" placeholder="Enter Product Name" name="product_name" id="e_product_name" maxlength="100" autocomplete="off" value="<?php echo $product_details->product_name; ?>" >

                              <input type="hidden" class="form-control m-input m-input--square" placeholder="Enter Product Name" name="" id="o_product_name" maxlength="100" autocomplete="off" value="<?php echo $product_details->product_name; ?>" >

                              <span class="text-danger" id="e_product_name_err"></span>
                           </div>
                        </div>
                  </div>
                  <?php
                  $edit_emails = array();
                  if(!empty($product_emails))
                  {  
                     foreach ($product_emails as $key => $product_email) {
                        $edit_emails[] = $product_email['email_detail_id'];
                     }
                  }
                  $edit_emails = (!empty($edit_emails)) ? $edit_emails : array();
               ?>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group m-form__group">
                        <label>Email ID<span class="text-danger">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple name="prd_email[]" id="e_email_id">
                              <option value="">Choose Email ID</option>
                              <?php
                                    if(!empty($email_lists))
                                    {
                                       foreach ($email_lists as $key => $email_list) { if($email_list->status == 0){ ?>
                                          <option value="<?php echo $email_list->email_detail_id; ?>" 
                                             <?php echo (in_array($email_list->email_detail_id, $edit_emails)) ? 'selected' : '';?> >
                                             <?php echo $email_list->email_ID; ?></option>
                                       <?php } }
                                    }
                                 ?>
                           </select>
                        <span class="text-danger" id="e_email_id_err"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group m-form__group">
                           <label>Product Description</label>
                           <textarea class="form-control" name="description" id="e_description"><?php echo $product_details->description; ?></textarea>
                           <span class="text-danger"></span>
                        </div>
                     </div>
               </div>
               <div class="row">
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                           <input type="checkbox" name="for_lead" id="e_for_lead" value="<?php echo $product_details->for_lead; ?>" <?php echo($product_details->for_lead == 1) ? "checked" : ""; ?> onchange="e_for_lead_check();"> For Lead
                           <span></span>
                        </label>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form-group m-form__group">
                        <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                           <input type="checkbox" name="for_vendor" id="e_for_vendor" value="<?php echo $product_details->for_vendor; ?>" <?php echo($product_details->for_vendor == 1) ? "checked" : ""; ?> onchange="e_for_vendor_check();"> For vendor
                           <span></span>
                        </label>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     
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
                           <?php //$i=0; foreach($product_costing_category_list as $pcclist){
                              /*$pctype = $this->Product_model->get_product_costing_type_by_pccid($pcclist['product_costing_category_id']);
                              $pcpmap = $this->Product_model->get_product_costing_product_mapping_by_pid_pccid($product_details->product_id,$pcclist['product_costing_category_id']);
                              if(count($pcpmap)>0)
                              {
                                 $cbox = 'checked';
                                 $pccid = $pcpmap->product_costing_category_id;
                                 $arr = explode(',', $pcpmap->product_costing_type_id);
                              }
                              else
                              {
                                 $cbox = '';
                                 $pccid = '';
                                 $arr = [];
                              }*/
                              ?>
                           <tr>
                              <td>
                                    <label class="m-checkbox m-checkbox--bold m-checkbox--state-success" style="margin-top: 10px;">
                                       <input type="checkbox" class="menu_checkbox" id="ccategory_edit<?php //echo $i;?>" name="ccategory<?php //echo $i;?>" <?php //echo $cbox;?> value="<?php //echo $pcclist['product_costing_category_id'];?>" onchange="changeDocReqEdit(<?php //echo $i;?>);"> <?php //echo $pcclist['product_costing_category_name'];?>
                                       <span></span>
                                    </label>
                                    <input type="hidden" id="product_costing_category_id_edit<?php //echo $i;?>" name="product_costing_category_id<?php //echo $i;?>" value="<?php //echo $pccid;?>">
                              </td>
                              <td>
                                 <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="product_costing_type_id_edit<?php //echo $i;?>" name="product_costing_type_id<?php //echo $i;?>[]" multiple>
                                    <?php //if(count($arr)>0){foreach($pctype as $pct){?>
                                       <option value="<?php //echo $pct['product_costing_type_id'];?>" <?php //echo in_array($pct['product_costing_type_id'], $arr)?'selected':'';?>><?php //echo $pct['product_costing_type'];?></option>
                                    <?php //}}else{foreach($pctype as $pct){?>
                                       <option value="<?php //echo $pct['product_costing_type_id'];?>" selected><?php //echo $pct['product_costing_type'];?></option>
                                    <?php //}}?>
                              </select>
                              </td>
                           </tr>
                           <?php //$i++;}?>
                        </tbody>
                     </table>
                  </div>
               </div> -->
               
            </div>
            <input type="hidden" name="product_id" value="<?php echo $product_details->product_id; ?>">
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Save Changes</button>
              
            </div>


         </div>
      </div>
      <script type="text/javascript">
         $('.m_selectpicker').selectpicker();


function changeDocReqEdit(val)
{
   var favorite = [];
   $.each($("input[id='ccategory_edit"+val+"']:checked"), function(){
      favorite.push($(this).val());
   });
   
   $('#product_costing_category_id_edit'+val).val(favorite);
}
function e_for_lead_check()
{
   if ($("#e_for_lead").is(":checked")) {
      $('#e_for_lead').val('1');
   }
   else {
      $('#e_for_lead').val('0');  
   }
}
function e_for_vendor_check()
{
   if ($("#e_for_vendor").is(":checked")) {
      $('#e_for_vendor').val('1');
   }
   else {
      $('#e_for_vendor').val('0');  
   }
}
      </script>