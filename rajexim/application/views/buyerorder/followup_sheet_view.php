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
                              <a href="<?php echo base_url(); ?>buyerorder" class="m-nav__link">
                                 <span class="m-nav__link-text">Buyer Order</span>
                              </a>
                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Followup Sheet</span>
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
                                       Buyer Order Followup Sheet View
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>buyerorder/followup_sheet_edit/<?php echo $buyer_order_list->buyer_order_id;?>" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="fa fa-pencil-alt"></i>
                                             <span>Edit</span>
                                          </span>
                                       </a>
                                    </li>
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>buyerorder" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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
                                    <table class="table table-striped- table-bordered table-hover table-checkable">
                                       <thead>
                                          <tr>
                                             <th width="20%">Category</th>
                                             <th><?php echo $buyer_order_list->buyer_order_invoice_no;?></th>
                                          </tr>
                                       </thead>

                                       <tbody>
                                             <tr>
                                                <td>DOCUMENT NO</td>
                                                <?php
                                                   $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$buyer_order_list->buyer_order_id."' AND bofs.automatic_field='DOCUMENT NO'")->row();
                                                   ?>
                                                   <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                                             </tr>
                                             <tr>
                                                <td>Buyer Name</td>
                                                <?php
                                                   $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$buyer_order_list->buyer_order_id."' AND bofs.automatic_field='Buyer Name'")->row();
                                                   ?>
                                                   <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                                             </tr>
                                             <tr>
                                                <td>PORT OF LOADING</td>
                                                <?php
                                                   $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$buyer_order_list->buyer_order_id."' AND bofs.automatic_field='PORT OF LOADING'")->row();
                                                   ?>
                                                   <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                                             </tr>
                                             <tr>
                                                <td>SEA / AIRPORT - COUNTRY</td>
                                                <?php
                                                   $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$buyer_order_list->buyer_order_id."' AND bofs.automatic_field='SEA / AIRPORT - COUNTRY'")->row();
                                                   ?>
                                                   <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                                             </tr>
                                             <tr>
                                                <td>PROFORMA INVOICE</td>
                                                <?php
                                                   $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$buyer_order_list->buyer_order_id."' AND bofs.automatic_field='PROFORMA INVOICE'")->row();
                                                   ?>
                                                   <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                                             </tr>
                                             <tr>
                                                <td>OUR PURCHASE ORDER NO</td>
                                                <?php 
                                                   $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$buyer_order_list->buyer_order_id."' AND bofs.automatic_field='OUR PURCHASE ORDER NO'")->row();
                                                   ?>
                                                   <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                                             </tr>
                                             <tr>
                                                <td>SUPPLIER</td>
                                                <?php
                                                   $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$buyer_order_list->buyer_order_id."' AND bofs.automatic_field='SUPPLIER'")->row();
                                                   ?>
                                                   <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                                             </tr>
                                             <tr>
                                                <td>PAYMENT TERMS</td>
                                                <?php
                                                   $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.buyer_order_id = '".$buyer_order_list->buyer_order_id."' AND bofs.automatic_field='PAYMENT TERMS'")->row();
                                                   ?>
                                                   <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                                             </tr>

                                             <?php foreach($followup_sheet_category_list as $fsclist){?>
                                                <tr>
                                                   <td><?php echo $fsclist['followup_sheet_category'];?></td>                     
                                                   <?php
                                                      $fuplist = $this->db->query("SELECT bofs.*,fss.stage_color,fsc.input_type FROM buyer_order_followup_sheet bofs,followup_sheet_stage fss,followup_sheet_category fsc WHERE bofs.followup_sheet_stage_id = fss.followup_sheet_stage_id AND bofs.followup_sheet_category_id = fsc.followup_sheet_category_id AND bofs.buyer_order_id = '".$buyer_order_list->buyer_order_id."' AND bofs.followup_sheet_category_id='".$fsclist['followup_sheet_category_id']."'")->row();
                                                      ?>
                                                      <?php if(count($fuplist)>0){
                                                       if($fuplist->input_type == 0){?>
                                                            <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field;?><br><br> <?php echo $fuplist->remarks;?></td>
                                                         <?php }else{?>
                                                            <td style="background-color:<?php echo $fuplist->stage_color;?>"><?php echo $fuplist->input_field==1?'Yes':'No';?><br><br> <?php echo $fuplist->remarks;?></td>
                                                         <?php }
                                                         }else{?>
                                                         <td style="background-color:<?php echo $fuplist->stage_color;?>"><br><br> </td>
                                                      <?php }?>
                                                </tr>
                                             <?php }?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
            
                              
                           </div>
                                    
                           <div class="m-portlet__foot">
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

var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Buyer Order Followup Sheet View';
   $(document).attr("title", title);
</script>

   </body>

   <!-- end::Body -->
</html>