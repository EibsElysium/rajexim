<div class="modal-dialog modal-md" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Product Costing Category</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>

      <form name="create_exporter" id="create_exp" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>productcostingcategory/update_product_costing_category" onsubmit="return product_costing_category_edit_validation()">
         <input type="hidden" id="product_costing_category_id" name="product_costing_category_id" value="<?php echo $product_costing_category->product_costing_category_id;?>">
         <input type="hidden" id="ppccid" name="ppccid" value="<?php echo $product_costing_category->parent_product_costing_category_id;?>">
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Costing Category<span class="text-danger">*</span></label>
                     <input type="text" class="form-control m-input m-input--square" placeholder="Enter Costing Category" id="product_costing_category_name_edit" name="product_costing_category_name" onkeyup="checkUniqueProductCostingCategoryEdit();" value="<?php echo $product_costing_category->product_costing_category_name;?>">
                     <span id="product_costing_category_name_edit_err" class="text-danger"></span>
                  </div>
               </div>                           
            </div>
            <?php if($product_costing_category->parent_product_costing_category_id>0){?>
            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Parent Costing Category<span class="text-danger">*</span></label>
                     <select class="form-control m-bootstrap-select m_selectpicker" id="parent_product_costing_category_id_edit" name="parent_product_costing_category_id" data-live-search="true">
                        <option value=''>Select Parent Costing Category</option>
                        <?php foreach($product_costing_category_list as $pclist){
                           if($product_costing_category->product_costing_category_id!=$pclist['product_costing_category_id']){?>
                           <option value="<?php echo $pclist['product_costing_category_id'];?>" <?php echo $product_costing_category->parent_product_costing_category_id == $pclist['product_costing_category_id']?'selected':'';?>><?php echo $pclist['product_costing_category_name'];?></option>
                        <?php }}?>
                     </select>
                     <span id="parent_product_costing_category_id_edit_err" class="text-danger"></span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group m-form__group">
                     <label>Mathematic Action<span class="text-danger">*</span></label>
                     <select class="form-control custom-select" id="math_action_edit" name="math_action">
                        <option value="">Select Mathematic Action</option>
                        <option value="Addition(+)" <?php echo $product_costing_category->math_action == 'Addition(+)'?'selected':'';?>>Addition ( + )</option>
                        <option value="Subtraction(-)" <?php echo $product_costing_category->math_action == 'Subtraction(-)'?'selected':'';?>>Subtraction ( - )</option>
                        <option value="Multiplication(*)" <?php echo $product_costing_category->math_action == 'Multiplication(*)'?'selected':'';?>>Multiplication ( * )</option>
                        <option value="Division(/)" <?php echo $product_costing_category->math_action == 'Division(/)'?'selected':'';?>>Division ( / )</option>
                     </select>
                     <span id="math_action_edit_err" class="text-danger"></span>
                  </div>
               </div>
            </div>
            <?php }?>
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

var expo = 0;
function checkUniqueProductCostingCategoryEdit()
{
   var val = $('#product_costing_category_name_edit').val();
   var pccid = $('#product_costing_category_id').val();
   $.ajax({
      type:"POST",
      url:baseurl+'productcostingcategory/checkUniqueProductCostingCategoryEdit',
      data:{'value':val,'pccid':pccid},
      cache: false,
      dataType: "html",
      success: function(result){
         if(result>0)
         {
            $('#product_costing_category_name_edit_err').html('Costing Category already exists!');
            $('#btnSubmit').prop('disabled', true);
            expo = 1;
         }
         else
         {
            $('#product_costing_category_name_edit_err').html('');
            $('#btnSubmit').prop('disabled', false);
            expo = 0;
         }
      }
   });
}


function product_costing_category_edit_validation()
{
   var err = 0;
   var lcount = $('#ppccid').val();
   var name = $('#product_costing_category_name_edit').val();
   if(name == '')
   {
      $('#product_costing_category_name_edit_err').html('Costing Category is required!');
      err++;
   }else{
      if(expo == 1)
      {
         $('#product_costing_category_name_edit_err').html('Costing Category already exists!');
         err++;
      }
      else
      {
         $('#product_costing_category_name_edit_err').html('');
      }
   }

   if(lcount>0)
   {
      var ppccid = $('#parent_product_costing_category_id_edit').val()
      var maction = $('#math_action_edit').val();
      /*if(ppccid=='')
      {
         $('#parent_product_costing_category_id_edit_err').html('Parent Product Costing Category is required!');
         err++;
      }
      else
      {
         $('#parent_product_costing_category_id_edit_err').html('');
      }*/

      if(ppccid!='' && maction=='')
      {
         $('#math_action_edit_err').html('Mathematic Action is required!');
         err++;
      }
      else
      {
         $('#math_action_edit_err').html('');
      }
   }
   
   if(err> 0){ return false;}else{ return true; }   
}
</script>