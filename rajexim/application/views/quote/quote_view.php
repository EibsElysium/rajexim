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
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Quote Management</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Quote List</span>
                              </a>
                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Quote View</span>
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
                                       Quote View
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <?php if($_SESSION['Proforma InvoiceAdd']==1){ ?>
                                    <li class="m-portlet__nav-item">
                                       <a href="javascript:;" data-toggle="modal" data-target="#move_to_pi" onclick="return move_to_pi(<?php echo $quotelist->parent_quote_id;?>);" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Move to PI">
                                             <i class="la la-share"></i>
                                             <span>Move to PI</span>
                                          </span>
                                       </a>
                                    </li>
                                    <?php }?>
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>quote" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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

                                    <ul class="nav nav-pills nav-pills--theme" role="tablist">
                                       <?php foreach($quote_list as $qlist){?>
                                       <li class="nav-item">
                                          <a class="nav-link <?php echo $qlist->quote_id == $quote_id?'active':'';?>"  data-toggle="tab" href="#q_<?php echo $qlist->quote_id;?>"><?php echo $qlist->quote_no;?></a>
                                       </li>
                                       <?php }?>
                                    </ul>
                                    <div class="tab-content">
                                       <?php foreach($quote_list as $qlist){
                                          $quotation_product = $this->Quote_model->get_quote_product_by_id($qlist->quote_id);
                                          ?>
                                          <div class="tab-pane <?php echo $qlist->quote_id == $quote_id?' active':'';?>" id="q_<?php echo $qlist->quote_id;?>" role="tabpanel">


                                             <?php 
                                             if($qlist->is_approve==1)
                                             {
                                                $appuser = $this->Productcosting_model->get_user_by_id($qlist->is_approve);?>
                                                <div class="pull-left">
                                                   <b>Approved by &nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $appuser->name;?><br>
                                                   <b>Approved Date :</b> <?php echo $qlist->approved_date;?>
                                                </div>

                                             <?php }?>

                                             <div class="pull-right">
                                                <?php if($_SESSION['Quote ManagementApprove']==1 && $qlist->is_approve==0){ ?>
                                                <a href="javascript:;" onclick="return quote_approve(<?php echo $qlist->quote_id; ?>)" data-toggle="m-tooltip" data-placement="top" title="Approve"><span class="tooltip-animation"><i class="fa fa-check-circle"></i></span></a>&nbsp;&nbsp;
                                                <?php }?>
                                             </div><br><br>

                                             <!-- <a class="pull-right" href="<?php //echo base_url(); ?>quote/quote_pdf/<?php //echo $qlist->quote_id; ?>">
                                               <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="PDF"><i class="fa fa-print"></i></span>
                                             </a> -->

                                             <div class="row">
                                                <div class="col-lg-12">
                                                   <h5 class="text-theme">Quote Details</h5><hr>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="text-center">
                                                      <div style="border: 1px solid #ccc;padding: 5px;margin:0 auto;width: 20%;">
                                                         <img src="<?php echo base_url();?>exporterlogo/<?php echo str_replace(' ', '_', $qlist->exporter_logo);?>" height="75" width="150"  alt="logo" style="object-fit: contain;">
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12 mt_25px">
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Exporter</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->exporter_name;?></p>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Subject</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->subject;?></p>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Quote Duration</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo date($date_format, strtotime($qlist->created_date)); ?> / <?php echo date($date_format, strtotime($qlist->valid_till)); ?>  </p>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Quote Stage</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->quote_stage;?></p>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Price validtity</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->price_validity;?></p>
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
                                                         <p class="col-lg-7"><?php echo $qlist->lead_name;?></p>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Organization</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->company_name!=''?$qlist->company_name:'-';?></p>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Address</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->address!=''?$qlist->address:'-';?></p>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Country</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->country_name!=''?$qlist->country_name:'-';?></p>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Email ID</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->email_id!=''?$qlist->email_id:'-';?></p>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Phone No</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->contact_no!=''?$qlist->contact_no:'-';?></p>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Mobile No</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7">-</p>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Assigned To</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->lead_assigned_name!=''?$qlist->lead_assigned_name:'-';?></p>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Vessel / Flight </label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->vessel_flight_name!=''?$qlist->vessel_flight_name:'-';?> </p>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">From Port</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->fpname;?> - <?php echo $qlist->fpcity;?> - <?php echo $qlist->fpcountry;?></p>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">To Port</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->tpname;?> - <?php echo $qlist->tpcity;?> - <?php echo $qlist->tpcountry;?></p>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <label class="col-lg-4">Price Terms</label>
                                                         <label class="col-lg-1">:</label>
                                                         <p class="col-lg-7"><?php echo $qlist->price_term_name;?></p>
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
                                                   <p class="col-lg-7"><?php echo $qlist->currency_name;?> - <?php echo $qlist->currency_code;?></p>
                                                </div>
                                                <div class="col-lg-6">
                                                   <label class="col-lg-4">Rate</label>
                                                   <label class="col-lg-1">:</label>
                                                   <p class="col-lg-7"><?php echo $qlist->rate;?></p>
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
                                                            <th>Rate in <?php echo $qlist->currency_code;?></th>
                                                            <?php if($qlist->is_local==1){?>
                                                            <th>Tax Type</th>
                                                            <th>Tax %</th>
                                                            <?php }?>
                                                            <th>Amount in <?php echo $qlist->currency_code;?></th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                         <?php $i=1;foreach($quotation_product as $qprod){
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
                                                            <?php if($qlist->is_local==1){
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
                                                         <?php $i++;}?>
                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                             <div class="row mt_25px">
                                                <div class="col-lg-12">
                                                   <h4 class="text-green text-right">Grand Total : <?php echo number_format($qlist->grand_total,2);?></h4>
                                                </div>
                                             </div>
                                          </div>
                                       <?php }?>
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
         <!--begin::Modal-->

<div class="container">
   <div class="modal fade" id="approve_prd_cost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form action="<?php echo base_url(); ?>quote/quote_approve" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Approve Quote</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Are You Sure You Want to Approve this Quote?</p>
            </div>
            <input type="hidden" name="qid" id="qid" value="">
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
   <div class="modal fade" id="move_to_pi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
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

   var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Quote View';
   $(document).attr("title", title);



   function quote_approve(val)
   {
      $("#qid").val(val);
      $("#approve_prd_cost").modal('show');
   }

   function move_to_pi(parqid){
   
   $.ajax({
   type: "POST",
   url: baseurl+'quote/move_to_pi',
   async: false,
   type: "POST",
   data: "parqid="+parqid,
   dataType: "html",
   success: function(response)
   {
   $('#move_to_pi').empty().append(response);
   }
   });
}  
</script>

   </body>

   <!-- end::Body -->
</html>