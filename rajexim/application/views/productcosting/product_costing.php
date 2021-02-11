<?php $this->load->view('common_header'); ?>
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="<?php echo base_url(); ?>Dashboard" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>productcosting" class="m-nav__link">
                                 <span class="m-nav__link-text">Product Costing</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Create Product Costing</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <!-- END: Subheader -->
               <div class="m-content">
                  
                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                      Create Product Costing
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>productcosting" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <form  name="productcosting_form" id="productcosting_form" method="POST" action="<?php echo base_url(); ?>productcosting/product_costing_save" onsubmit="return product_costing_validation();" >
                              <div class="m-portlet__body">
                                 <!--begin: Datatable -->

                                 <div class="row">
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Lead<span class="text-danger">*</span></label>
                                          <!-- <select class="form-control m-bootstrap-select m_selectpicker" id="lead_id" name="lead_id" data-live-search="true">
                                             <option value="">Select Lead</option>
                                             <?php foreach($lead_list as $plist){?>
                                                <option value="<?php echo $plist['lead_id'];?>"><?php echo $plist['lead_name'];?> - <?php echo $plist['email_id'];?></option>
                                             <?php }?>
                                          </select> -->
                                          <?php if($lid==''){?>
                                           <input type="text" id="lead_name" name="lead_name" class="form-control">
                                          <input type="hidden" id="lead_id" name="lead_id">
                                          <?php }else{?>
                                           <input type="text" id="lead_name" name="lead_name" class="form-control" value="<?php echo $contact_book_details->lead_name;?>" readonly>
                                          <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead_details->lead_id;?>">
                                          <?php }?>
                                          <span id="lead_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Product<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" id="product_id" name="product_id" data-live-search="true">
                                             <option value="">Select Product</option>
                                             <?php foreach($product_list as $plist){?>
                                                <option value="<?php echo $plist['product_id'];?>" <?php echo $productId == $plist['product_id']?'selected':'';?>><?php echo $plist['product_name'];?></option>
                                             <?php }?>
                                          </select>
                                          <span id="product_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Container<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" id="container_id" name="container_id" data-live-search="true" onchange="getProductItem(this.value);">
                                             <option value="">Select Container</option>
                                             <?php foreach ($container_list as $value) { ?>
                                                <option value="<?php echo $value['container_id']; ?>"><?php echo $value['container_name'];?></option>
                                             <?php }?>
                                          </select>
                                          <span id="container_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3" id="proditem" style="<?php echo $productId==''?'display:none':'display:block';?>;">
                                       <div class="form-group m-form__group">
                                          <label>Product Item<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" id="product_item_id" name="product_item_id" data-live-search="true" onchange="getPPC(this.value);">
                                             <?php echo $prodItem;?>                                         
                                          </select>
                                          <span id="product_item_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3" id="proditemdisp" style="<?php echo $productId==''?'display:none':'display:block';?>;">
                                       <div class="form-group m-form__group">
                                          <label>Display Name</label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" id="product_item_display_name_id" name="product_item_display_name_id" data-live-search="true">
                                             <option value="">Select Display Name</option>                                         
                                          </select>
                                          <span id="product_item_display_name_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                 </div>

                                 <div id="sboard"></div>
                                 
                              </div>
                              <div class="m-portlet__foot">
                                 <div class="row align-items-center">
                                    <div class="col-lg-12 m--align-right">
                                       <input type="submit"  class="btn btn-primary" name="submit" id="btnsubmit" value="Save" onclick="changedraftvalue(this.value);">
                                       <input type="submit"  class="btn btn-primary" name="draft" id="btndraft" value="Draft" onclick="changedraftvalue(this.value);">
                                    </div>
                                 </div>
                              </div>
                              <input type="hidden" id="is_draft" name="is_draft">
                           </form>
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->
               </div>
            </div>
         </div>

         <!-- end:: Body -->

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>

<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->

   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Product Costing';
$(document).attr("title", title); 

$(document).ready(function(){

     // Initialize 
     $( "#lead_name" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: baseurl+"productcosting/lead_list",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
              //alert(JSON.stringify(data));
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#lead_name').val(ui.item.label); // display the selected text
          $('#lead_id').val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });

function changedraftvalue(val)
{
   if(val=='Draft')
   {
      $('#is_draft').val(1);
   }
   else
   {
      $('#is_draft').val(0);
   }
}

function product_costing_validation()
{
   var err=0;
   var lid = $('#lead_id').val();
   var pid = $('#product_id').val();
   var piid = $('#product_item_id').val();
   var cid = $('#container_id').val();
   //var dname = $('#product_item_display_name_id').val();
   if(lid=='')
   {
      $('#lead_id_err').html('Choose Lead!');
      err++;
   }
   else
   {
      $('#lead_id_err').html('');
   }

   if(pid=='')
   {
      $('#product_id_err').html('Choose Product!');
      err++;
   }
   else
   {
      $('#product_id_err').html('');
   }

   if(piid=='')
   {
      $('#product_item_id_err').html('Choose Product Item!');
      err++;
   }
   else
   {
      $('#product_item_id_err').html('');
   }

   if(cid=='')
   {
      $('#container_id_err').html('Choose Container!');
      err++;
   }
   else
   {
      $('#container_id_err').html('');
   }

   /*if(dname=='')
   {
      $('#product_item_display_name_id_err').html('Choose Display Name!');
      err++;
   }
   else
   {
      $('#product_item_display_name_id_err').html('');
   }*/

   if(err>0){ return false; }else{ return true; }
}

function getProductItem(val)
{
   var pId = $('#product_id').val();
   if(pId!='')
   {
      if(val!='')
      {
         $.ajax({
            type: "POST",
            url: baseurl+'productcosting/getProductItem',
            async: false,
            data: "value="+val+"&pId="+pId,
            dataType: "html",
            success: function(response)
            {
               $('#product_item_id').empty().append(response);
               $('.m_selectpicker').selectpicker('refresh');
            }
         });
         $('#proditem').show();
         $('#proditemdisp').show();
      }
      else
      {
         $('#product_item_id').html('');
         $('#proditem').hide();
         $('#proditemdisp').hide();
      }
   }
   else
   {
      alert("Choose Product");
      $('#container_id').val('');
      $('.m_selectpicker').selectpicker('refresh');
   }
   $('#sboard').html('');
}


function getPPC(val)
{
   if(val!='')
   {
      var prodId = $('#product_id').val();
      $.ajax({
         type: "POST",
         url: baseurl+'productcosting/getPPC',
         async: false,
         data: "value="+val+"&prodId="+prodId,
         dataType: "html",
         success: function(response)
         {
            $('#sboard').empty().append(response);
            $.ajax({
               type: "POST",
               url: baseurl+'productcosting/get_display_name',
               async: false,
               data: "value="+val,
               dataType: "html",
               success: function(resp)
               {
                  $('#product_item_display_name_id').html(resp).selectpicker('refresh');
               }
            });
         }
      });
   }
   else
   {
      $('#sboard').html('');
   }
}



</script>
</body>
   <!-- end::Body -->
</html>