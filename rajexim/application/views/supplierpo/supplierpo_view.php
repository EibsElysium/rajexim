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
                              <a href="<?php echo base_url(); ?>supplierpo" class="m-nav__link">
                                 <span class="m-nav__link-text">Supplier PO</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">View Supplier PO</span>
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
                                      View Supplier PO
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>supplierpo" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <!--begin::Form-->
                  <?php $date_format =common_date_format();?>
                  <div class="m-portlet__body">
                    <fieldset>
                      <legend class="text-info"><b>Supplier Info</b></legend>
                      <div class="row">
                        <div class="col-lg-6">
                          <label class="col-lg-4">Supplier PO No</label>
                          <label class="col-lg-1">:</label>
                          <p class="col-lg-7"><?php echo $supplierpo_list->supplier_purchase_order_no;?></p>
                        </div>
                        <div class="col-lg-6">
                          <label class="col-lg-4">Supplier Name</label>
                          <label class="col-lg-1">:</label>
                          <p class="col-lg-7"><?php echo $supplierpo_list->vendor_name.' - '.$supplierpo_list->phone_no;?></p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <label class="col-lg-4">Date</label>
                          <label class="col-lg-1">:</label>
                          <p class="col-lg-7"><?php echo date($date_format, strtotime($supplierpo_list->supply_date));?></p>
                        </div>
                        <div class="col-lg-6">
                          <label class="col-lg-4">Delivery Place</label>
                          <label class="col-lg-1">:</label>
                          <p class="col-lg-7"><?php echo $supplierpo_list->delivery_place;?></p>
                        </div>
                      </div>
                    </fieldset>

                    <?php if(count($supplierpo_product_details)>0){?>
                    <fieldset>
                      <legend class="text-info"><b>Product Info</b></legend>
                      <table class="table table-bordered m-table m-table--border-success m-table--head-bg-success">
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Product</th>
                            <th>Quantity <?php echo $supplierpo_list->unit_type;?></th>
                            <th>Rate / INR</th>
                            <th>Amount (INR)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1;foreach($supplierpo_product_details as $spodet){?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $spodet['product_name'];?> - <?php echo $spodet['product_item'];?></td>
                              <td align="right"><?php echo $spodet['quantity'];?></td>
                              <td><span class="pull-right"><?php echo $spodet['rate'];?></span></td>
                              <td><span class="pull-right"><?php echo number_format($spodet['amount'],2);?></span></td>
                            </tr>
                          <?php $i++;}?>
                        </tbody>
                      </table>
                    </fieldset>
                    <?php }?>

                  </div>

                  <!--end::Form-->
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
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->

<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Supplier PO View';
$(document).attr("title", title); 
</script>

</body>
   <!-- end::Body -->
</html>