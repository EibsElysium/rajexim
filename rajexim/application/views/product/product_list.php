<?php $this->load->view('common_header'); ?>
<style>
.pro_btn_color {
    color: #000;
}
</style>
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
										<a href="javascript:;" class="m-nav__link">
											<span class="m-nav__link-text">Settings</span>
										</a>
									</li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Product Settings</span>
                              </a>
                           </li>
									<li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
									<li class="m-nav__item">
										<a href="javascript:;" class="m-nav__link">
											<span class="m-nav__link-text">Product List</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>	
					 <div class="m-content">

                  <!--Begin::Section-->
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile ">
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                      Product List
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Product ListAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#create_product">
                                          <span>
                                             <i class="la la-plus"></i>
                                             <span>Create Product</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php } ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" onclick="product_export_items();" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="fa fa-file-export"></i>
                                             <span>Generate Report</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                           	<?php if($this->session->flashdata('prd_success')){?>
		                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertaddmessage">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									</button>
									<?php echo $this->session->flashdata('prd_success'); ?>
								</div>
				            <?php } ?>

							<?php if($this->session->flashdata('prd_err')){?>
			                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertaddmessage">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									</button>
									<?php echo $this->session->flashdata('prd_err'); ?>
								</div>
				            <?php } ?>	

							<div class="alert alert-success alert-dismissible fade show" role="alert" id="active_success" style="display:none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								</button>
								Product has been activated successfully.
							</div>

							<div class="alert alert-danger alert-dismissible fade show" role="alert" id="inactive_success" style="display:none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								</button>
								Product has been deactivated successfully.
							</div>

                           	<form name="product_list_form" id="product_list_form" action="<?php echo base_url(); ?>Products" method="POST">
                              <div class="row"> 
                                 <div class="col-lg-12">
                                    <div class="form-group m-form__group">
                                       <button class="btn btn-sm <?php echo ($f_letter_val == 'A') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="A" name="A" id="A" 
										    	onclick="filter_products(this.value);">A</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'B') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="B" name="B"  id="B" type="button" onclick="filter_products(this.value);">B</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'C') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="C" name="C"  id="C" type="button" onclick="filter_products(this.value);">C</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'D') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="D" name="D"  id="D" type="button" onclick="filter_products(this.value);">D</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'E') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="E" name="E"  id="E" type="button" onclick="filter_products(this.value);">E</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'F') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="F" name="F"  id="F" type="button" onclick="filter_products(this.value);">F</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'G') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="G" name="G"  id="G" type="button" onclick="filter_products(this.value);">G</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'H') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="H" name="H"  id="H" type="button" onclick="filter_products(this.value);">H</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'I') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="I" name="I"  id="I" type="button" onclick="filter_products(this.value);">I</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'J') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="J" name="J"  id="J" type="button" onclick="filter_products(this.value);">J</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'K') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="K" name="K"  id="K" type="button" onclick="filter_products(this.value);">K</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'L') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="L" name="L"  id="L" type="button" onclick="filter_products(this.value);">L</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'M') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="M" name="M"  id="M" type="button" onclick="filter_products(this.value);">M</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'N') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="N" name="N"  id="N" type="button" onclick="filter_products(this.value);">N</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'O') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="O" name="O"  id="O" type="button" onclick="filter_products(this.value);">O</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'P') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="P" name="P"  id="P" type="button" onclick="filter_products(this.value);">P</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'Q') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="Q" name="Q"  id="Q" type="button" onclick="filter_products(this.value);">Q</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'R') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="R" name="R"  id="R" type="button" onclick="filter_products(this.value);">R</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'S') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="S" name="S"  id="S" type="button" onclick="filter_products(this.value);">S</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'T') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="T" name="T"  id="T" type="button" onclick="filter_products(this.value);">T</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'U') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="U" name="U"  id="U" type="button" onclick="filter_products(this.val);">U</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'V') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="V" name="V"  id="V" type="button" onclick="filter_products(this.value);">V</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'W') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="W" name="W"  id="W" type="button" onclick="filter_products(this.value);">W</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val  == 'X') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="X" name="X"  id="X" type="button" onclick="filter_products(this.value);">X</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'Y') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="Y" name="Y"  id="Y" type="button" onclick="filter_products(this.value);">Y</button>
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'Z') ? 'btn-primary' :'btn-default'; ?> pro_btn_color" value="Z" name="Z"  id="Z" type="button" onclick="filter_products(this.value);">Z</button>&nbsp;&nbsp;&nbsp;&nbsp;
										    <button class="btn btn-sm <?php echo ($f_letter_val == 'all') ? 'btn-primary' :'btn-default'; ?>" value="all" name="all"  id="all" type="button" onclick="filter_products(this.value);">All</button>
										    <input type="hidden" name="letter_val" id="letter_val" value="">
                                    </div>
                                 </div>
                              </div>


                              <div class="row"> 
                                 <div class="col-lg-3">
                                    <div class="form-group m-form__group">
                                       <label>Industry</label>
                                       <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="industry" id="industry" onchange="submit_product_filter('filter');">
                                          <option value="">Choose</option>
                                          <?php
			                              	if(!empty($industry_lists))
			                              	{
			                              		foreach ($industry_lists as $key => $industry_list) { 
                                                if($industry_list->status == 0){ ?>
			                              			<option value="<?php echo $industry_list->industry_id; ?>" 
			                              				<?php if($industry_list->industry_id == $f_industry_id){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $industry_list->industry_name; ?></option>
			                              		<?php } }
			                              	}
			                              ?>
                                       </select>
                                       <span class="text-danger"></span>
                                    </div>
                                 </div>
                                 
                              </div>
                          </form>

                              <!--begin: Datatable -->

                              <div class="row" id="pro_list_table_append_block" style="display: none;"> 
                                 
                              </div>
                              <div class="row" id="pro_list_table_append_block_loader"> 
                                 <div class="col-lg-5"></div>
                                 <div class="col-lg-2">
                                    <img src="<?php echo base_url(); ?>assets/demo/demo12/media/img/logo/aero_world2.gif" height="100px" width="100px" style="margin-top: 93px;">
                                 </div>
                                 <div class="col-lg-5"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!--End::Section-->
               </div>
				
				</div>
			</div>
			<!-- end:: Body -->
<!--begin::Create Industry-->
<div class="container">
   <div class="modal fade" id="create_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form  name="product_add" id="product_add" method="POST" action="<?php echo base_url(); ?>Products/product_save" 
            	onsubmit="return product_validation();">
	            <div class="modal-body">
	               <div class="row">
	                     <div class="col-lg-6">
	                        <div class="form-group m-form__group">
	                           <label>Industry Name<span class="text-danger">*</span></label>
	                           <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="industry_id" id="industry_id">
	                           	<option value="">Choose Industry</option>
	                              <?php
	                              	if(!empty($industry_lists))
	                              	{
	                              		foreach ($industry_lists as $key => $industry_list) { if($industry_list->status == 0){ ?>
	                              			<option value="<?php echo $industry_list->industry_id; ?>"><?php echo $industry_list->industry_name; ?></option>
	                              		<?php } }
	                              	}
	                              ?>
	                           </select>
	                           <span class="text-danger" id="industry_id_err"></span>
	                        </div>
	                     </div>
	                     <div class="col-lg-6">
	                        <div class="form-group m-form__group">
	                           <label>Product Name<span class="text-danger">*</span></label>
	                           <input type="text" class="form-control m-input m-input--square" placeholder="Enter Product Name" name="product_name" id="product_name" maxlength="100" autocomplete="off" onblur="product_unique(this.value);">
	                           <span class="text-danger" id="product_name_err"></span>
	                        </div>
	                     </div>
	               </div>
	               <div class="row">
	                  <div class="col-lg-12">
	                     <div class="form-group m-form__group">
	                        <label>Email ID<span class="text-danger">*</span></label>
	                        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple name="prd_email[]" id="email_id">
	                           <option value="">Choose Email ID</option>
	                           <?php
	                              	if(!empty($email_lists))
	                              	{
	                              		foreach ($email_lists as $key => $email_list) { if($email_list->status == 0){ ?>
	                              			<option value="<?php echo $email_list->email_detail_id; ?>"><?php echo $email_list->email_ID; ?></option>
	                              		<?php } }
	                              	}
	                              ?>
	                        </select>
	                        <span class="text-danger" id="email_ID_err"></span>
	                     </div>
	                  </div>
	               </div>
	               <div class="row">
	                     <div class="col-lg-12">
	                        <div class="form-group m-form__group">
	                           <label>Product Description</label>
	                           <textarea class="form-control" placeholder="Enter Product Description"  name="description" id="description"> </textarea>
	                           <span class="text-danger" id="description_err"></span>
	                        </div>
	                     </div>
	               </div>
                  <div class="row">
                     <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                              <input type="checkbox" name="for_lead" id="for_lead" value="1" checked onchange="for_lead_check();"> For Lead
                              <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="form-group m-form__group">
                           <label class="m-checkbox m-checkbox--bold m-checkbox--state-info mt_25px">
                              <input type="checkbox" name="for_vendor" id="for_vendor" value="1" checked onchange="for_vendor_check();"> For vendor
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
                              //$pctype = $this->Product_model->get_product_costing_type_by_pccid($pcclist['product_costing_category_id']);
                              ?>
                           <tr>
                              <td>
                                    <label class="m-checkbox m-checkbox--bold m-checkbox--state-success" style="margin-top: 10px;">
                                       <input type="checkbox" class="menu_checkbox" id="ccategory<?php //echo $i;?>" name="ccategory<?php //echo $i;?>" value="<?php //echo $pcclist['product_costing_category_id'];?>" onchange="changeDocReq(<?php //echo $i;?>);"> <?php //echo $pcclist['product_costing_category_name'];?>
                                       <span></span>
                                    </label>
                                    <input type="hidden" id="product_costing_category_id<?php //echo $i;?>" name="product_costing_category_id<?php //echo $i;?>">
                              </td>
                              <td>
                                 <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="product_costing_type_id<?php //echo $i;?>" name="product_costing_type_id<?php //echo $i;?>[]" multiple>
                                    <?php //foreach($pctype as $pct){?>
                                       <option value="<?php //echo $pct['product_costing_type_id'];?>" selected><?php //echo $pct['product_costing_type'];?></option>
                                    <?php //}?>
                              </select>
                              </td>
                           </tr>
                           <?php //$i++;}?>
                        </tbody>
                     </table>
                  </div>
               </div> -->
	               
	            </div>
	            <div class="modal-footer">
	               <button type="submit" class="btn btn-primary">Create</button>
	            </div>
        	</form>

         </div>
      </div>
   </div>
</div>
<!--End::-->

<!--begin::View Product-->
<div class="container">
   <div class="modal fade" id="view_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
   </div>
</div>
<!--End::-->

<div class="container">
	<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
	</div>
</div>

<!--begin::Modal-->

<div class="container">
   <div class="modal fade" id="delete_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
         	<form action="<?php echo base_url(); ?>Products/product_delete" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Delete this Product Permanently?</p>
            </div>
            <input type="hidden" name="product_id" id="product_id" value="">
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Yes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
       		</form>
         </div>
      </div>
   </div>
</div>


<div class="container">

   <div class="modal fade" id="product_export_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

         <div class="modal-content">

            <div class="modal-header">

               <h5 class="modal-title" id="exampleModalLabel">Export Product Info</h5>

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

               </button>

            </div>

            <form action="<?php echo base_url(); ?>Leads/export_product_info" method="POST" onsubmit="return product_exp_validation();">

               <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12">
                       <div class="form-group m-form__group">
                          <h3>Filter By<span class="text-danger"></span></h3>
                          <div class="row">
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Industry :</label>
                                     <input type="hidden" name="exp_pro_industry_val" id="exp_pro_industry_val">
                                     <span id="exp_pro_industry"></span>
                                   </label>
                                </div>
                             </div>
                             <!-- <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Quarter :</label>
                                     <input type="hidden" name="exp_bo_filt_quarter_val" id="exp_bo_filt_quarter_val">
                                     <span id="exp_bo_filt_quarter"></span>
                                   </label>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Search By :</label>
                                     <input type="hidden" name="exp_bo_filt_search_val" id="exp_bo_filt_search_val">
                                     <span id="exp_bo_filt_search"></span>
                                   </label>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="">
                                   <label class="">
                                     <label class="label" style="color: #2D4A89;">Date Range Wise :</label>
                                     <input type="hidden" name="exp_bo_filt_dtrng_val" id="exp_bo_filt_dtrng_val">
                                     <span id="exp_bo_filt_dtrng"></span>
                                   </label>
                                </div>
                             </div> -->
                          </div>

                       </div>
                    </div>
                  </div>
                  <hr>
                  <div class="required">
                    <div class="row">

                       <div class="col-lg-3">

                          <div class="bank m-checkbox-inline">

                             <label class="m-checkbox">

                               <input type="checkbox" id="exp_product_name" class = "product_export" name="product_export[]" value="Product Name"><label class="label" for="exp_product_name">Product Name</label>

                               <span></span>

                             </label>

                          </div>

                       </div>

                       <div class="col-lg-3">

                          <div class="bank m-checkbox-inline">

                             <label class="m-checkbox">

                               <input type="checkbox" id="exp_industry_name" class = "product_export" name="product_export[]" value="Industry Name"><label class="label" for="exp_industry_name">Industry Name</label>

                               <span></span>

                             </label>

                          </div>

                       </div>

                       <div class="col-lg-3">

                          <div class="bank m-checkbox-inline">

                             <label class="m-checkbox">

                               <input type="checkbox" id="exp_description" class = "product_export" name="product_export[]" value="Description"><label class="label" for="exp_description">Description</label>

                               <span></span>

                             </label>

                          </div>

                       </div>

                       <div class="col-lg-3">

                          <div class="bank m-checkbox-inline">

                             <label class="m-checkbox">

                               <input type="checkbox" id="exp_product_emails" class = "product_export" name="product_export[]" value="Product Emails"><label class="label" for="exp_product_emails">Product Emails</label>

                               <span></span>

                             </label>

                          </div>

                       </div>

                    </div>



                    <div class="row">

                       <div class="col-lg-3">

                          <div class="bank m-checkbox-inline">

                             <label class="m-checkbox">

                               <input type="checkbox" id="exp_pro_users" class = "product_export" name="product_export[]" value="Product Users"><label class="label" for="exp_pro_users">Product Users</label>

                               <span></span>

                             </label>

                          </div>

                       </div>

                       <div class="col-lg-3">

                          <div class="bank m-checkbox-inline">

                             <label class="m-checkbox">

                               <input type="checkbox" id="exp_pro_for" class = "product_export" name="product_export[]" value="Product For"><label class="label" for="exp_pro_for">Product For</label>

                               <span></span>

                             </label>

                          </div>

                       </div>

                    </div>


                  </div>
               </div>

               <div class="modal-footer">

                  <div class="bank m-checkbox-inline">

                     <label class="m-checkbox">

                       <input type="checkbox" onclick="toggle(this)"><label class="label">All</label>

                       <span></span>

                     </label>

                  </div>&nbsp;
                  <p class="text-danger" id="exp_error"></p>
                 <button type="submit" class="btn btn-primary">Yes</button>

                 <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

               </div>

            </form>

         </div>

      </div>

   </div>

</div>
<!--end::Modal-->

	<!-- begin::Footer -->
	<?php $this->load->view('common_footer'); ?>
	<script src="<?php echo base_url(); ?>assets/demo/demo12/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>

	<!-- end::Footer -->
	</div>
		<!-- end:: Page -->
		<!--begin::Global Theme Bundle -->
<script>

var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Product List';
$(document).attr("title", title);
function get_id_by_name_in_js(id,table_name,name_col,id_col)
{
   var return_name = '';
   if (id != '') {
      $.ajax({
        url:baseurl+'Leads/get_id_by_name_in_js',
        type:'POST',
        data:{'id':id,'table_name':table_name,'name_col':name_col,'id_col':id_col},
        dataType: 'html',
        async:false,
        success:function(result){
           return_name = result;
        }
      });
   }
   else {
      return_name = 'All';   
   }
   return return_name;
}
function product_exp_validation()
{
   var err = 0;
   if ($('div.required :checkbox:checked').length > 0) {
      $('#exp_error').html('');
   }
   else {
       $('#exp_error').html('Choose Any one..');
       err++;
   }
   if (err == 0) {
      return true;
   }
   else {
      return false;
   }
}
function product_export_items()
{
  
  var industry = $('#industry_id').val();
  var industry_name = get_id_by_name_in_js(industry,'industries','industry_name','industry_id');

  $('#exp_pro_industry').empty().append(industry_name);
  $('#exp_pro_industry_val').empty().val(industry);

  // $('#exp_bo_filt_quarter').empty().append(quarter);
  // $('#exp_bo_filt_quarter_val').empty().val(quarter);

  // $('#exp_bo_filt_search').empty().append(search);
  // $('#exp_bo_filt_search_val').empty().val(search);

  // $('#exp_bo_filt_dtrng').empty().append(dtrnge);
  // $('#exp_bo_filt_dtrng_val').empty().val(dtrnge);

  // $('#exp_bo_filt_user').empty().append(pi_sales_user_name);
  // $('#exp_bo_filt_user_val').empty().val(pi_sales_user);

  // $('#exp_bo_filt_country').empty().append(country_name);
  // $('#exp_bo_filt_country_val').empty().val(country_id);

  // $('#quarter_or_range').empty().val(fbase);

   $('#product_export_model').modal('show');

}
function for_lead_check()
{
   if ($("#for_lead").is(":checked")) {
      $('#for_lead').val('1');
   }
   else {
      $('#for_lead').val('0');  
   }
}
function for_vendor_check()
{
   if ($("#for_vendor").is(":checked")) {
      $('#for_vendor').val('1');
   }
   else {
      $('#for_vendor').val('0');  
   }
}
function changeDocReq(val)
{
   var favorite = [];
   $.each($("input[name='ccategory"+val+"']:checked"), function(){
      favorite.push($(this).val());
   });
   
   $('#product_costing_category_id'+val).val(favorite);
}

function filter_products(v)
{
	$('#letter_val').val(v);
	submit_product_filter('filter');
}

var pagecount = '';
var current_pagination_index = '';
function paginate_page(page,l_id)
{  
   current_pagination_index = l_id;
   pagecount = page;
   submit_product_filter('pagination');
}

var search_val = '';
function search_on_list(val)
{
   // if (val != '') {
    search_val = val;
    submit_product_filter('search');
   // }
}

submit_product_filter('filter');
function submit_product_filter(diff) {
   if(diff=='pagination'){
      current_pagination_index = current_pagination_index;
   }
   else{
      current_pagination_index = 1;
   }
   if (diff == 'search' || diff=='perpage_count') {
      pagecount = 0;
   }
   else {
      pagecount = pagecount;
   }
   // var pagecount = localStorage.getItem('curr_page');
   $('#pro_list_table_append_block_loader').show();
   $('#pro_list_table_append_block').hide();
   var perpage = $('#perpage').val();
   var letter_val = $('#letter_val').val();
   var industry = $('#industry').val();
   
   // var active_tab = "<?php // echo (isset($_GET['active_tab'])) ? '?active_tab='.$_GET['active_tab'] : ''; ?>";
  
   $.ajax({
      url:baseurl+'products/product_list_by_filter',
      type:'POST',
      data:{'letter_val':letter_val,'industry':industry, 'pagecount' : pagecount, 'search_val' : search_val, 'current_pagination_index' : current_pagination_index,'perpage':perpage},
      dataType: 'html',
      success:function(result)
      {
         $('#pro_list_table_append_block').empty().append(result);
         $('#pro_list_table_append_block_loader').hide();
         $('#pro_list_table_append_block').show();
      }
   });
}
function activeunactive(val,ival) 
{
      var unactive;
      var unactv;
      var baseurl='<?php echo base_url(); ?>';
      var a = $("#activeunactive_"+ival).val();
      if(a==1) {
         unactive=0;
         unactv="Active"
      }
      else{
         unactive=1;
         unactv="In-Active"
      }
      var datastring="id="+val+"&status="+unactive;
      $.ajax({
         type:"POST",
         url:baseurl+'Products/product_status_change',
         data:datastring,
         cache: false,
         dataType: "html",
         success: function(result){
             if(unactive == 0){
	            $('#active_success').show();
	            $('#inactive_success').hide();
	            setTimeout(function() {
	            window.location = baseurl+"Products";
	         }, 3000);
	        }else{
	            $('#active_success').hide();
	            $('#inactive_success').show();
	            setTimeout(function() {
	         window.location = baseurl+"Products";
	         }, 3000);
	        }
         },
         error: function (error) {
            alert('error; ' + eval(error));
         }
      });
   }
// View product details   
function product_view(val)
{
	$.ajax({
		type:'POST',
		url:baseurl+'Products/product_view',
		data:{'val':val},
		dataType: 'html',
		success:function(result){
			$('#view_product').empty().append(result);
			$('#view_product').modal('show');
		}
	});
}
// Edit product details   
function product_edit(val)
{
	$.ajax({
		type:'POST',
		url:baseurl+'Products/product_edit',
		data:{'val':val},
		dataType: 'html',
		success:function(result){
			$('#edit_product').empty().append(result);
			$('#edit_product').modal('show');
		}
	})
}

var er = 0;
function product_unique(val)
{
	var industry_id = $("#industry_id").val();
	$.ajax({
		type:"POST",
		url:baseurl+'Products/product_unique',
		data:{'value':val, 'industry_id':industry_id},
		cache: false,
		dataType: "html",
			success: function(result){
			if(result > 0)
			{
				$('#product_name_err').html('Product Name already exists!');
				er++;
			}
			else
			{
				$('#product_name_err').html('');
				
			}
		}
	});
	
}
function product_validation()
{
	var err = 0;
	var industry_id = check_input_empty_values($('#industry_id').val(), 'industry_id_err', 'Industry Name');
	var product_name = check_input_empty_values($('#product_name').val(), 'product_name_err', 'Product Name');
	var email_id = $('#email_id').val()
	if(industry_id)
	{
		err++;
	}
	if(product_name)
	{
		err++;
	}
	if(email_id == '')
	{
		$('#email_ID_err').html('Email ID is required!');
		err++;
	}
	else{
		$('#email_ID_err').html('');
	}
	if(er > 0)
	{
		$('#product_name_err').html('Product Name already exists!');
		err++;
	}else{
		$('#product_name_err').html('');
	}
	if(err>0 || er > 0){ return false }else{ return true; }
}
// Email ID Edit   
function email_edit(val)
{
	$.ajax({
		type:'POST',
		url:baseurl+'Settings/Email_ID_edit',
		data:{'val':val},
		dataType: 'html',
		success:function(result){
			$('#email_edit_modal').empty().append(result);
			$('#email_edit_modal').modal('show');
		}
	})
}
var e_er = 0;
function e_email_ID_unique(val)
{
	var o_email_ID = $("#o_email_ID").val();

	if(val != '' && o_email_ID != val.trim())
	{
		$.ajax({
		type:"POST",
		url:baseurl+'Settings/email_ID_unique',
		data:{'value':val},
		cache: false,
		dataType: "html",
			success: function(result){
			if(result > 0)
			{
				$('#e_email_ID_err').html('Email ID already exists!');
				e_er++;
			}
			else
			{
				$('#e_email_ID_err').html('');
				
			}
		}
	});
	}
}
function e_email_validation()
{
	var err = 0;
	var email_ID = check_input_empty_values($('#e_email_ID').val(), 'e_email_ID_err', 'Email ID');
	var from_name = check_input_empty_values($('#e_from_name').val(), 'e_from_name_err', 'From Name');
	if(email_ID)
	{
		$('#e_email_ID_err').html('Email ID is required!');
		err++;
	}
	else if(!ValidateEmail($('#e_email_ID').val()))
	{
		$('#e_email_ID_err').html('Invalid Email ID!');
		err++;
	}
	else if(e_er > 0)
	{
		$('#e_email_ID_err').html('Email ID already exists!');
		err++;
	}
	else{
		$('#e_email_ID_err').html('');
	}
	if(from_name)
	{
		err++;
	}

	if(err>0 || e_er > 0){ return false }else{ return true; }
}
// To delete product
function product_delete(val)
{
	alert(val);
	$("#product_id").val(val);
	$("#delete_product").modal('show');
}

function toggle(source) {

   checkboxes = document.getElementsByClassName('product_export');

   for(var i=0, n=checkboxes.length;i<n;i++) {

      checkboxes[i].checked = source.checked;

   }

}
</script>
<!--end::Page Scripts -->
	</body>
	<!-- end::Body -->
</html>