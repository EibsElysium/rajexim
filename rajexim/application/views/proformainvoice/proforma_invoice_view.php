<?php $this->load->view('common_header'); $date_format =common_date_format();?>

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                           <li class="m-nav__item m-nav__item--home">
                              <a href="#" class="m-nav__link m-nav__link--icon">
                                 <i class="m-nav__link-icon fa fa-home"></i>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="<?php echo base_url(); ?>proformainvoice" class="m-nav__link">
                                 <span class="m-nav__link-text">Proforma Invoice</span>
                              </a>
                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">View Proforma Invoice</span>
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
                                       Proforma Invoice View
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>proformainvoice" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="m-portlet__body">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <h5 class="text-theme">Proforma Invoice Details</h5><hr>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Exporter</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->exporter_name;?></p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Invoice No</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->proforma_invoice_no;?></p>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Date</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo date($date_format, strtotime($proformainvoice_list->proforma_invoice_date)); ?></p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Subject</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->subject;?></p>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Terms of Payment Type</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->terms_of_payment_type_id==1?'Advance':'LC';?></p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Buyer Confirmation Date</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo date($date_format, strtotime($proformainvoice_list->buyer_confirmation_date)); ?></p>
                                             </div>                                             
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Other Reference</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->other_reference;?></p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">PI Stage</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->pi_stage;?></p>
                                             </div>
                                          </div>
                                                

                                       </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-lg-12">
                                          <h5 class="text-theme">Buyer Details</h5><hr>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Contact Name</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->lead_name;?></p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Organization</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->company_name!=''?$proformainvoice_list->company_name:'-';?></p>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Address</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->address!=''?$proformainvoice_list->address:'-';?></p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Country</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->country_name!=''?$proformainvoice_list->country_name:'-';?></p>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Email ID</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->email_id!=''?$proformainvoice_list->email_id:'-';?></p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Phone No</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->contact_no!=''?$proformainvoice_list->contact_no:'-';?></p>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Mobile No</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->office_phone_no!=''?$proformainvoice_list->office_phone_no:'-';?></p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Assigned To</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->lead_assigned_name!=''?$proformainvoice_list->lead_assigned_name:'-';?></p>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Pre-Carriage By </label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->pre_carriage_by;?> </p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Place of Receipt by Pre-Carrier</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->place_of_receipt_by_pre_carrier;?></p>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Vessel / Flight </label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->vessel_flight_name!=''?$proformainvoice_list->vessel_flight_name:'-';?> </p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Port of Loading</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->polname;?> - <?php echo $proformainvoice_list->polcity;?> - <?php echo $proformainvoice_list->polcountry;?></p>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Port of Discharge</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->podname;?> - <?php echo $proformainvoice_list->podcity;?> - <?php echo $proformainvoice_list->podcountry;?></p>
                                             </div>
                                             <div class="col-lg-6">
                                                <label class="col-lg-4">Final Destination</label>
                                                <label class="col-lg-1">:</label>
                                                <p class="col-lg-7"><?php echo $proformainvoice_list->fdname;?> - <?php echo $proformainvoice_list->fdcity;?> - <?php echo $proformainvoice_list->fdcountry;?></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-lg-12">
                                          <h5 class="text-theme">Item Details</h5><hr>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Currency</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $proformainvoice_list->currency_name;?> - <?php echo $proformainvoice_list->currency_code;?></p>
                                       </div>
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Rate</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $proformainvoice_list->rate;?></p>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Correspondence Bank</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $bank_detail->correspondence_bank;?></p>
                                       </div>
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Bnak Detail</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $bank_detail->bank_detail;?></p>
                                       </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-lg-12">
                                          <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme m_table_2">
                                             <thead>
                                                <tr>
                                                   <th>Mark & No</th>
                                                   <th>Vendor Name</th>
                                                   <th>Item Name</th>
                                                   <th>Display Name</th>
                                                   <th>SKU</th>
                                                   <th>Specification</th>
                                                   <th>Quantity</th>
                                                   <th>Rate in <?php echo $proformainvoice_list->currency_code;?></th>
                                                   <?php if($proformainvoice_list->is_local==1){?>
                                                   <th>Tax Type</th>
                                                   <th>Tax %</th>
                                                   <?php }?>
                                                   <th>Amount in <?php echo $proformainvoice_list->currency_code;?></th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php $i=1;foreach($proformainvoice_product_list as $qprod){
                                                      if($qprod['product_item_display_name_id']!=0)
                                                      {
                                                         $dispname = $this->Productcosting_model->get_display_name_by_id($qprod['product_item_display_name_id']);
                                                         $dname = $dispname->display_name;
                                                      }
                                                      else
                                                      {
                                                         $dname = '-';
                                                      }
                                                   ?>
                                                <tr>
                                                   <td><?php echo $qprod['marks_and_no'];?></td>
                                                   <td><?php echo $qprod['vendor_name'];?></td>
                                                   <td><?php echo $qprod['product_name'];?> - <?php echo $qprod['product_item'];?></td>
                                                   <td><?php echo $dname;?></td>
                                                   <td><?php echo $qprod['product_unit'];?></td>
                                                   <td><?php echo $qprod['product_item_spec'];?></td>
                                                   <td>
                                                      <span class="pull-left"><?php echo $qprod['quantity'];?></span>
                                                      <!-- <span class="pull-right">Carton</span> -->
                                                   </td>
                                                   <td align="right"><?php echo number_format($qprod['rate'],2);?></td>
                                                   <?php if($proformainvoice_list->is_local==1){
                                                      if($qprod['tax_type']==0){
                                                         $ttype = 'CGST/SGST';
                                                      }else{
                                                         $ttype = 'IGST';
                                                      }?>
                                                      <td><?php echo $ttype;?></td>
                                                      <td><?php echo $qprod['tax_percent'];?></td>
                                                   <?php }?>
                                                   <td align="right"><?php echo number_format($qprod['amount'],2);?></td>
                                                </tr>
                                                <?php $i++;}
                                                ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>

                                    <?php if(count($proformainvoice_other_charge_list)>0){?>
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <br><p><h2>Other Charges</h2></p><br>
                                          <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
                                             <thead>
                                                <tr>
                                                   <th>Particulars</th>
                                                   <th>Taxable Amount</th>
                                                   <th>Tax Type</th>
                                                   <th>Tax %</th>
                                                   <th>Amount</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <td><?php echo $proformainvoice_other_charge_list->particulars;?></td>
                                                <td><?php echo number_format($proformainvoice_other_charge_list->taxable_amount,2);?></td>
                                                <td><?php echo $ttype;?></td>
                                                <td><?php echo $proformainvoice_other_charge_list->tax_percent;?></td>
                                                <td><?php echo number_format($proformainvoice_other_charge_list->amount,2);?></td>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    <?php }?>
                                    <div class="row mt_25px">
                                       <div class="col-lg-12">
                                          <h4 class="text-green text-right">Grand Total : <?php echo number_format($proformainvoice_list->grand_total,2);?></h4>
                                       </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-lg-12">
                                          <h5 class="text-theme">Notes</h5><hr>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Sales Note</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $proformainvoice_list->sales_note;?></p>
                                       </div>
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Purchase Note</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $proformainvoice_list->purchase_note;?></p>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Shipping Note</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $proformainvoice_list->shipping_note;?></p>
                                       </div>
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Accounts Note</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $proformainvoice_list->accounts_note;?></p>
                                       </div>
                                    </div>
                                    <!-- <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Specifications and Packing Details</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php //echo $proformainvoice_list->specification_packing_details;?></p>
                                       </div>
                                    </div> -->

                                    <div class="row">
                                       <div class="col-lg-12">
                                          <h5 class="text-theme">Other Details</h5><hr>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Price Validity</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $proformainvoice_list->price_validity;?></p>
                                       </div>
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Loadability</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $proformainvoice_list->loadability;?></p>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Interest</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $interest_text;?></p>
                                       </div>
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Terms & Payment</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $terms_and_payment_value;?></p>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Terms of Payment</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $terms_of_payment_text;?></p>
                                       </div>
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Arbitration</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $arbitration_text;?></p>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Declaration</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $declaration;?></p>
                                       </div>
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Price</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7"><?php echo $proformainvoice_list->price;?></p>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="col-lg-4">Document Required</label>
                                          <label class="col-lg-1">:</label>
                                          <p class="col-lg-7">
                                             <ul>
                                                <?php $drec = explode(',', $document_required); for($i=0;$i<count($drec);$i++){?>
                                                   <li><?php echo $drec[$i];?></li>
                                                <?php }?>
                                             </ul>
                                          </p>
                                       </div>
                                    </div>

                                 </div>
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

         <!-- begin::Footer -->
         <?php $this->load->view('common_footer'); ?>

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->




<script type="text/javascript">
   $('.m_table_2').DataTable({responsive:!0});
   $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .responsive.recalc();
   });   
</script>

   </body>

   <!-- end::Body -->
</html>