<?php $this->load->view('common_header'); $date_format =common_date_format();?>
<style type="text/css">
   /*.m-wizard [data-wizard-action=""]{display: none;}*/
   .m-wizard.m-wizard--step-first [data-wizard-action=""] {
    display: none;
}
/*.m-wizard.m-wizard--step-between [data-wizard-action=""] {
    display: none;
}*/
</style>
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
                                 <span class="m-nav__link-text">Invoice</span>
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
                        <!--Begin::Main Portlet-->
                        <div class="m-portlet">
                           <!--begin: Portlet Head-->
                           <div class="m-portlet__head">
                              <div class="m-portlet__head-caption">
                                 <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                       Invoice
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
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
                           <!--end: Portlet Head-->
                           <!--begin: Form Wizard-->
                                 <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>buyerorder/invoice_copy_save" onsubmit="return invoice_validation();">
                                    <!--begin: Form Body -->
                                    <input type="hidden" id="buyer_order_id" name="buyer_order_id" value="<?php echo $buyer_order_list->buyer_order_id;?>">
                                    <input type="hidden" id="is_local" name="is_local" value="<?php echo $buyer_order_list->is_local;?>">
                                    <input type="hidden" id="terms_and_payment_id" name="terms_and_payment_id" value="<?php echo $buyer_order_list->terms_and_payment_id;?>">
                                    <input type="hidden" id="price" name="price" value="<?php echo $buyer_order_list->price;?>">
                                    <div class="m-portlet__body">
                                       <!--begin: Form Wizard Step 1-->
                                       <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                          <h5 class="text-theme"><b>Invoice Details</b></h5><hr>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Bill On<span class="text-danger">*</span></label>
                                                   <input type="text" id="exporter" name="exporter" class="form-control" value="<?php echo $buyer_order_list->exporter_name;?>" readonly>
                                                   <input type="hidden" id="exporter_id" name="exporter_id" value="<?php echo $buyer_order_list->exporter_id;?>">
                                                   <span class="text-danger" id="exporter_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>GSTIN No</label>
                                                   <input type="text" id="gstin_no" name="gstin_no" class="form-control" value="<?php echo $gst_no;?>" readonly>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>IEC No</label>
                                                   <input type="text" id="iec_no" name="iec_no" class="form-control" value="<?php echo $iec_no;?>" readonly>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Buyer Order No<span class="text-danger">*</span></label>
                                                   <input type="text" id="buyer_order_invoice_no" name="buyer_order_invoice_no" value="<?php echo $buyer_order_invoice_no;?>" class="form-control"  readonly>
                                                   <span class="text-danger"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Date<span class="text-danger">*</span></label>
                                                   <input type="text" id="invoice_date" name="invoice_date" class="form-control m_datepicker_1" value="<?php $qdate = explode('-', $buyer_order_list->invoice_date); echo $qdate[1].'/'.$qdate[2].'/'.$qdate[0];?>">
                                                   <span class="text-danger" id="proforma_invoice_date_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Subject<span class="text-danger">*</span></label>
                                                   <input type="text" id="subject" name="subject" class="form-control"  placeholder="Enter Subject" value="<?php echo $buyer_order_list->subject;?>" readonly>
                                                   <span class="text-danger" id="subject_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Terms of Payment Type<span class="text-danger">*</span></label>
                                                   <input type="text" id="topt" name="topt" class="form-control" value="<?php echo $buyer_order_list->terms_of_payment_type_id==1?'Advance':'LC';?>" readonly>
                                                   <input type="hidden" id="terms_of_payment_type_id" name="terms_of_payment_type_id" value="<?php echo $buyer_order_list->exporter_id;?>">
                                                   <span class="text-danger" id="terms_of_payment_type_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Buyer Confirmation Date<span class="text-danger">*</span></label>
                                                   <input type="text" id="buyer_confirmation_date" name="buyer_confirmation_date" class="form-control m_datepicker_1" value="<?php $qdate = explode('-', $buyer_order_list->buyer_confirmation_date); echo $qdate[1].'/'.$qdate[2].'/'.$qdate[0];?>">
                                                   <span class="text-danger" id="buyer_confirmation_date_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Other References</label>
                                                   <input type="text" id="other_reference" name="other_reference" class="form-control"  placeholder="Enter Other Reference" value="<?php echo $buyer_order_list->other_reference;?>" readonly>
                                                   <span class="text-danger" id="other_reference_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>PI Stage<span class="text-danger">*</span></label>
                                                   <input type="text" id="pi_stage" name="pi_stage" class="form-control" value="<?php echo $buyer_order_list->pi_stage;?>" readonly>
                                                   <input type="hidden" id="pi_stage_id" name="pi_stage_id" value="<?php echo $buyer_order_list->pi_stage_id;?>">
                                                   <span class="text-danger" id="pi_stage_id_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <h5 class="text-theme mt_25px"><b>Buyer Details</b></h5><hr>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Contact Name<span class="text-danger">*</span></label>
                                                   <input type="text" id="lead" name="lead" class="form-control" value="<?php echo $buyer_order_list->lead_name;?>" readonly>
                                                   <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $buyer_order_list->lead_id;?>">
                                                   <span class="text-danger" id="lead_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Organization Name</label>

                                                   <input type="text" id="organization_name" name="organization_name" class="form-control"  readonly value="<?php echo $buyer_order_list->company_name;?>">
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Country</label>
                                                   <input type="text" name="" id="country" name="country" class="form-control"  readonly value="<?php echo $buyer_order_list->country_name;?>">
                                                   <span class="text-danger"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Email ID</label>

                                                   <input type="text" id="email_id" name="email_id" class="form-control"  readonly value="<?php echo $buyer_order_list->email_id;?>">
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Phone No</label>

                                                   <input type="text" id="phone_no" name="phone_no" class="form-control"  readonly value="<?php echo $buyer_order_list->contact_no;?>">
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Mobile No</label>

                                                   <input type="text" id="mobile_no" name="mobile_no" class="form-control"  readonly>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Assigned To</label>
                                                   <input type="text" id="assigned_to" name="assigned_to" class="form-control"  readonly value="<?php echo $buyer_order_list->lead_assigned_name;?>">
                                                </div>
                                             </div>
                                             <div class="col-lg-8">
                                                <div class="form-group m-form__group"> <label>Address</label>
                                                   <textarea class="form-control" cols="40" id="address" name="address" rows="2" readonly><?php echo $buyer_order_list->address;?></textarea>
                                                </div>
                                             </div>
                                          </div>

                                          <?php if($buyer_order_list->is_local==1){?>
                                             <div class="row">
                                                <div class="col-lg-3">
                                                   <div class="form-group m-form__group">
                                                      <label>State Name</label>
                                                      <input type="text" id="state_name" name="state_name" class="form-control" value="<?php echo $buyer_order_list->state_name;?>">
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="form-group m-form__group"> 
                                                      <label>State Code</label>
                                                      <input type="text" id="state_code" name="state_code" class="form-control" value="<?php echo $buyer_order_list->state_code;?>">
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="form-group m-form__group"> 
                                                      <label>GST No</label>
                                                      <input type="text" id="gst_no" name="gst_no" class="form-control" value="<?php echo $buyer_order_list->gst_no;?>">
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="form-group m-form__group"> 
                                                      <label>VAT TIN No</label>
                                                      <input type="text" id="vat_tin_no" name="vat_tin_no" class="form-control" value="<?php echo $buyer_order_list->vat_tin_no;?>">
                                                   </div>
                                                </div>
                                             </div>
                                          <?php }?>

                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Pre-Carriage By<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="pre_carriage_by_id" name="pre_carriage_by_id" data-live-search="true"> 
                                                      <option value=''>Choose</option> 
                                                      <?php foreach ($pre_carriage_by_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['pre_carriage_by_id']; ?>" <?php echo $buyer_order_list->pre_carriage_by_id == $vflist['pre_carriage_by_id']?'selected':'';?>><?php echo $vflist['pre_carriage_by']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="pre_carriage_by_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Place of Receipt by Pre-Carrier<span class="text-danger">*</span></label>
                                                   <input type="text" id="place_of_receipt_by_pre_carrier" name="place_of_receipt_by_pre_carrier" class="form-control"  placeholder="Enter Place of Receipt" value="<?php echo $buyer_order_list->place_of_receipt_by_pre_carrier;?>">
                                                   <span class="text-danger" id="place_of_receipt_by_pre_carrier_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Vessel / Flight<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="vessel_flight_id" name="vessel_flight_id" data-live-search="true" onchange="getFromPort(this.value);"> 
                                                      <option value=''>Choose</option> 
                                                      <?php foreach ($vessel_flight_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['vessel_flight_id']; ?>" <?php echo $buyer_order_list->vessel_flight_id == $vflist['vessel_flight_id']?'selected':'';?>><?php echo $vflist['vessel_flight_name']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="vessel_flight_id_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Port of Loading<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="port_of_loading_id" name="port_of_loading_id" data-live-search="true"> 
                                                      <?php echo $port_of_loading_id;?>
                                                   </select>
                                                   <span class="text-danger" id="port_of_loading_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Port of Dis-charge<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="port_of_discharge_id" name="port_of_discharge_id" data-live-search="true"> 
                                                      <option value=''>Choose Port</option> 
                                                      <?php foreach ($port_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['port_id']; ?>" <?php echo $buyer_order_list->port_of_discharge_id == $vflist['port_id']?'selected':'';?>><?php echo $vflist['port_name']; ?> - <?php echo $vflist['port_city']; ?> - <?php echo $vflist['port_country']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="port_of_discharge_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Final Destination<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="final_destination_id" name="final_destination_id" data-live-search="true"> 
                                                      <option value=''>Choose Destination</option> 
                                                      <?php foreach ($port_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['port_id']; ?>" <?php echo $buyer_order_list->final_destination_id == $vflist['port_id']?'selected':'';?>><?php echo $vflist['port_name']; ?> - <?php echo $vflist['port_city']; ?> - <?php echo $vflist['port_country']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="final_destination_id_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Despatched Through</label>
                                                   <input type="text" id="despatched_through" name="despatched_through" class="form-control"  placeholder="Enter Despathced Through">
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Terms of Delivery</label>
                                                   <input type="text" id="terms_of_delivery" name="terms_of_delivery" class="form-control"  placeholder="Enter Terms of Delivery">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!--end: Form Wizard Step 1-->
                                       <!--begin: Form Wizard Step 2-->
                                       <div class="m-wizard__form-step" id="m_wizard_form_step_2">
                                          
                                          <h5 class="text-theme"><b>Item Details</b></h5><hr>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Currency<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="currency_id" name="currency_id" data-live-search="true" onchange="getCurrencyCode(this.value);"> 
                                                      <option value="">Choose Currency</option>  
                                                      <?php foreach ($currency_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['currency_id']; ?>" <?php echo $buyer_order_list->currency_id == $vflist['currency_id']?'selected':'';?>><?php echo $vflist['currency_name']; ?> - <?php echo $vflist['currency_code']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <input type="hidden" id="curcode" value="<?php echo $curcode;?>">
                                                   <span class="text-danger" id="currency_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Rate<span class="text-danger">*</span></label>
                                                   <input type="text" class="form-control" id="rate" name="ratec" placeholder="Enter Rate" value="<?php echo $buyer_order_list->rate;?>">
                                                   <span class="text-danger" id="rate_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Bank Detail<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="bank_detail_id" name="bank_detail_id" data-live-search="true"> 
                                                      <?php echo $bdetail;?>
                                                   </select>
                                                   <span class="text-danger" id="bank_detail_id_err"></span>
                                                </div>
                                             </div>
                                             
                                          </div>
                                          <div id="mcontent10">
                                             <?php $i=0; $tot=0; foreach($buyer_order_product_list as $qplist){

                                                $dispname = $this->Productcosting_model->get_display_name_by_product_item_display_name_id($qplist['product_item_display_name_id']);
                                                $invqty = $qplist['quantity'] - $qplist['invoice_quantity'];?>
                                             <fieldset id="mid<?php echo $i;?>">
                                                <input type="hidden" id="buyer_order_product_id<?php echo $i;?>" name="buyer_order_product_id[]" value="<?php echo $qplist['buyer_order_product_id'];?>">
                                                <?php //if($i==0){?>
                                                <legend>
                                                   Product <?php echo $i+1;?>
                                                </legend>
                                                <?php //}else{?>
                                                <!-- <legend class="text-right"><button class="btn btn-danger" onclick="remove_quote_prod(<?php //echo $i;?>)"><i class="fa fa-minus"></i></button></legend> -->
                                                <?php //}?>
                                                   <div class="row">

                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Vendor Name<span class="text-danger">*</span></label>
                                                            <input type="text" id="vname<?php echo $i;?>" name="vname[]" class="form-control" value="<?php echo $qplist['vendor_name'];?>" readonly>
                                                            <input type="hidden" id="vendor_id<?php echo $i;?>" name="vendor_id[]" value="<?php echo $qplist['vendor_id'];?>">
                                                            <span class="text-danger" id="vendor_id_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Mark & No<span class="text-danger">*</span></label>
                                                            <input type="text" id="marks_and_no<?php echo $i;?>" name="marks_and_no[]" class="form-control" placeholder="Enter Mark & No" value="<?php echo $qplist['marks_and_no'];?>">
                                                            <span class="text-danger" id="marks_and_no_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Item Name<span class="text-danger">*</span></label>
                                                            <input type="text" id="piname<?php echo $i;?>" name="piname[]" class="form-control" value="<?php echo $qplist['product_name'].' - '.$qplist['product_item'];?>" readonly>
                                                            <input type="hidden" id="product_item_id<?php echo $i;?>" name="product_item_id[]" value="<?php echo $qplist['product_item_id'];?>">
                                                            <span class="text-danger" id="product_item_id_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Display Name</label>
                                                            <input type="text" class="form-control" id="dname<?php echo $i;?>" name="dname[]" value="<?php echo $dispname->display_name;?>" readonly>
                                                            <input type="hidden" id="product_item_display_name_id<?php echo $i;?>" name="product_item_display_name_id[]" value="<?php echo $dispname->product_item_display_name_id;?>">
                                                            <span class="text-danger" id="product_item_display_name_id_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-4">
                                                         <div class="form-group m-form__group">
                                                            <label>Specification<span class="text-danger">*</span></label>
                                                            <!-- <input type="text" id="specification<?php //echo $i;?>" name="specification[]" class="form-control" placeholder="Specification" value="<?php //echo $qplist['product_item_spec'];?>" readonly> -->
                                                            <textarea class="form-control snote" id="specification<?php echo $i;?>" name="specification[]" rows="3"><?php echo $qplist['specification'];?></textarea>
                                                            <span class="text-danger" id="specification_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                   
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Unit<span class="text-danger">*</span></label>
                                                            <select class="form-control m-bootstrap-select m_selectpicker" id="sku_unit_id<?php echo $i;?>" name="sku_unit_id[]" data-live-search="true"> 
                                                               <option value=''>Choose Unit</option> 
                                                               <?php foreach($product_unit as $punit){?>
                                                                  <option value="<?php echo $punit['product_unit_id'];?>" <?php echo $punit['product_unit_id'] == $qplist['sku_unit_id']?'selected':'';?>><?php echo $punit['product_unit'];?></option>
                                                               <?php }?>
                                                            </select>
                                                            <span class="text-danger" id="sku_unit_id_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Quantity<span class="text-danger">*</span></label>
                                                            <input type="text" id="quantity<?php echo $i;?>" name="quantity[]" class="form-control" placeholder="Enter Quantity" value="<?php echo $invqty;?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getAmount(<?php echo $i;?>);">

                                                            <input type="hidden" id="old_qty_<?php echo $i;?>" value="<?php echo $invqty;?>">
                                                            <span class="text-danger" id="quantity_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Rate in <span class="ccode"></span><span class="text-danger">*</span></label>
                                                            <input type="text" id="rate<?php echo $i;?>" name="rate[]" class="form-control" placeholder="Enter Rate" value="<?php echo $qplist['rate'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getAmount(<?php echo $i;?>);">
                                                            <span class="text-danger" id="rate_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      
                                                      <div class="col-lg-2" <?php echo $buyer_order_list->is_local==0?"style=display:none;":'';?>>
                                                         <div class="form-group m-form__group">
                                                            <label>Tax Type<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="tax_type_value<?php echo $i;?>" name="tax_type_value[]" value="<?php echo $qplist['tax_type']==0?'CGST/SGST':'IGST';?>" readonly>
                                                            <input type="hidden" id="tax_type<?php echo $i;?>" name="tax_type[]" value="<?php echo $qplist['tax_type'];?>">
                                                            <span class="text-danger" id="tax_type_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2" <?php echo $buyer_order_list->is_local==0?"style=display:none;":'';?>>
                                                         <div class="form-group m-form__group">
                                                            <label>Tax %<span class="text-danger">*</span></label>
                                                            <input type="text" id="tax_percent<?php echo $i;?>" name="tax_percent[]" class="form-control" placeholder="Enter Tax %" value="<?php echo $qplist['tax_percent'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                            <span class="text-danger" id="tax_percent_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Amount in <span class="ccode"></span><span class="text-danger">*</span></label>
                                                            <input type="text" id="amount<?php echo $i;?>" name="amount[]" class="form-control" readonly value="<?php echo $invqty*$qplist['rate'];?>">
                                                            <span class="text-danger" id="amount_err<?php echo $i;?>"></span>
                                                         </div>
                                                      </div>
                                                      
                                                      
                                                   </div>
                                             </fieldset>
                                             <?php $i++;$tot+=($invqty*$qplist['rate']);}?>
                                          </div>

                                          <?php if($buyer_order_list->is_local==1){?>
                                             <fieldset>
                                                <legend>
                                                   Other Charges
                                                </legend>
                                                <div class="row">
                                                   <div class="col-lg-4">
                                                      <div class="form-group m-form__group">
                                                         <label>Particulars</label>
                                                         <input type="text" id="particulars" name="particulars" class="form-control" placeholder="Particulars" value="<?php echo $buyer_order_other_charge_list->particulars;?>" onkeyup="getOthersAmount();">
                                                         <span class="text-danger" id="particulars_err"></span>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-2">
                                                      <div class="form-group m-form__group">
                                                         <label>Taxable Amount</label>
                                                         <input type="text" id="taxable_amount" name="taxable_amount" class="form-control" placeholder="Enter Taxable Amount" value="<?php echo $buyer_order_other_charge_list->taxable_amount;?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getOthersAmount();">
                                                         <span class="text-danger" id="taxable_amount_err"></span>
                                                      </div>
                                                   </div>
                                                
                                                <div class="col-lg-2">
                                                   <div class="form-group m-form__group">
                                                      <label>Tax Type</label>
                                                      <select class="form-control m-bootstrap-select m_selectpicker" id="otax_type" name="otax_type" data-live-search="true" onchange="getOthersAmount();"> 
                                                         <option value='0' <?php echo $buyer_order_other_charge_list->tax_type==0?'selected':'';?>>CGST/SGST</option>
                                                         <option value='1' <?php echo $buyer_order_other_charge_list->tax_type==1?'selected':'';?>>IGST</option>
                                                      </select>
                                                      <span class="text-danger" id="otax_type_err"></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-2">
                                                   <div class="form-group m-form__group">
                                                      <label>Tax %</label>
                                                      <input type="text" id="otax_percent" name="otax_percent" class="form-control" placeholder="Enter Tax %" value="<?php echo $buyer_order_other_charge_list->tax_percent;?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getOthersAmount();">
                                                      <span class="text-danger" id="otax_percent_err"></span>
                                                   </div>
                                                </div>
                                                   <div class="col-lg-2">
                                                      <div class="form-group m-form__group">
                                                         <label>Amount</label>
                                                         <input type="text" id="oamount" name="oamount" class="form-control" readonly value="<?php echo $buyer_order_other_charge_list->amount;?>">
                                                         <span class="text-danger" id="oamount_err"></span>
                                                      </div>
                                                   </div>
                                                   
                                                   
                                                </div>
                                             </fieldset>
                                          <?php $tot+=$buyer_order_other_charge_list->amount;}?>

                                          <!-- <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group m-form__group">
                                                   <div class="pull-right">
                                                      <button type="button" class="btn btn-primary" onclick="add_quote_prod(0)">
                                                         <i class="fa fa-plus"></i>
                                                      </button>
                                                   </div>
                                                </div>
                                             </div> 
                                          </div> -->
                                          <input type="hidden" id="mailcount" name="mailcount" value="<?php echo count($proformainvoice_product_list);?>">

                                          <div class="row mt_25px">
                                             <div class="col-lg-9">
                                                <label>Amount Chargeable in <span class="ccode"></span></label>
                                                <h5 class="text-theme"><span id="amwords"><span></h5>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Total</label>

                                                   <input type="text" id="grand_total" name="grand_total" class="form-control" readonly value="<?php echo $tot;?>">
                                                </div>
                                             </div>
                                          </div>
                                       
                                       </div>
                                       <!--end: Form Wizard Step 2-->
                                    </div>
                                    <!--end: Form Body -->
                                    <!--end: Form Body -->
                                    <div class="m-portlet__foot">
                                       <div class="row align-items-center">
                                          <div class="col-lg-12 m--align-right">
                                             <button type="submit" id="add_wl_btn" class="btn btn-primary">Create</button>
                                          </div>
                                       </div>
                                    </div>
                                    <input type="hidden" id='baseurl' name="baseurl" value="<?php echo base_url();?>">
                                    <input type="hidden" id='error' name="error" value="0">
                                    <input type="hidden" id='visible_type' name="visible_type" value="hide">
                                    <!--end: Form Actions -->
                                 </form>
                           <!--end: Form Wizard-->
                        </div>
                        <!--End::Main Portlet-->
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




      <script src="<?php echo base_url();?>assets/demo/demo12/custom/crud/wizard/wizard.js" type="text/javascript"></script>
      <!--end::Global Theme Bundle -->






<script>

   var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Edit Proforma Invoice';
   $(document).attr("title", title);

   $('.snote').summernote();

$('#amwords').html(withDecimal($('#grand_total').val()));
$('.ccode').html($('#curcode').val());

function withDecimal(n) {
    var nums = n.toString().split('.')
    var whole = convertNumberToWords(nums[0]);
    if (nums.length == 2) {
        var fraction = convertNumberToWords(nums[1]);
        if(fraction!='')
        {
            if(whole!='')
               return whole + ' Rupees and ' + fraction+' Paise';
            else
               return fraction+' Paise';
         }
     else
     {
         if(whole!='')
           return whole+' Rupees';
        else
            return 'Zero Rupees'
      }
    } else {
      if(whole!='')
        return whole+' Rupees';
     else
         return 'Zero Rupees'
    }
}   

function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
}

function isNumberKey(evt, obj)
{ 
    var charCode = (evt.which) ? evt.which : event.keyCode
    var value = obj.value;
    var dotcontains = value.indexOf(".") != -1;
    if (dotcontains)
        if (charCode == 46) return false;
    if (charCode == 46) return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}   

function add_quote_prod()
{
   var count=$('#mailcount').val();
   var cont = $("#mcontent10");
   var voption = '<?php echo $venoption;?>';
   var poption = '<?php echo $prodoption;?>';
   
   cont.append('<fieldset id="mid'+count+'"><legend class="text-right"><button class="btn btn-danger" onclick="remove_quote_prod('+count+')"><i class="fa fa-minus"></i></button></legend><div class="row"><div class="col-lg-2"><div class="form-group m-form__group"><label>Vendor Name<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="vendor_id'+count+'" name="vendor_id[]" data-live-search="true">'+voption+'</select><span class="text-danger" id="vendor_id_err'+count+'"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group"><label>Mark & No<span class="text-danger">*</span></label><input type="text" id="marks_and_no'+count+'" name="marks_and_no[]" class="form-control" placeholder="Enter Mark & No"><span class="text-danger" id="marks_and_no_err'+count+'"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group"><label>Item Name<span class="text-danger">*</span></label><select class="form-control m-bootstrap-select m_selectpicker" id="product_item_id'+count+'" name="product_item_id[]" data-live-search="true">'+poption+'</select><span class="text-danger" id="product_item_id_err'+count+'"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group"><label>Quantity<span class="text-danger">*</span></label><input type="text" id="quantity'+count+'" name="quantity[]" class="form-control" placeholder="Enter Quantity" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getAmount('+count+');"><span class="text-danger" id="quantity_err'+count+'"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group"><label>Rate in <span class="ccode"></span><span class="text-danger">*</span></label><input type="text" id="rate'+count+'" name="rate[]" class="form-control" placeholder="Enter Rate" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getAmount('+count+');"><span class="text-danger" id="rate_err'+count+'"></span></div></div><div class="col-lg-2"><div class="form-group m-form__group"><label>Amount in <span class="ccode"></span><span class="text-danger">*</span></label><input type="text" id="amount'+count+'" name="amount[]" class="form-control" readonly value=0><span class="text-danger" id="amount_err'+count+'"></span></div></div></div></fieldset>');

   count=Number(count)+1;
   $('#mailcount').val(count);

            $('.m_selectpicker').selectpicker('refresh');

var curcode = $('#curcode').val();
if(curcode!='')
{
   $('.ccode').html(curcode);
}
else
{
   $('.ccode').html('');
}

}

function remove_quote_prod(val)
{
   $('#mid'+val).remove();

   var totamt = 0;
   $("input[id^='amount']").each(function(){
      var id = this.id;
      var res = id.substring(6);

      totamt = parseFloat(totamt)+parseFloat($('#'+id).val());

   });

   $('#grand_total').val(totamt.toFixed('2'));
   $('#amwords').html(withDecimal(totamt.toFixed('2')));

}

function getOthersAmount()
{
   var parti = $('#particulars').val();
   if(parti!='')
   {
      var totamt = 0;
      $("input[id^='amount']").each(function(){
         var id = this.id;
         var res = id.substring(6);

         totamt = parseFloat(totamt)+parseFloat($('#'+id).val());

      });

      var tbleamt = $('#taxable_amount').val();
      var ottype = $('#otax_type').val();
      var otpercent = $('#otax_percent').val();
      if(ottype==0)
         otpercent = parseFloat(otpercent)*2;

      var otaxvalue = (parseFloat(tbleamt)*parseFloat(otpercent))/100;

      var ototamt = parseFloat(tbleamt)+parseFloat(otaxvalue);

      $('#oamount').val(ototamt.toFixed('2'));

      var oamt = $('#oamount').val();

      var ftotamt = parseFloat(totamt)+parseFloat(oamt);
      
      $('#grand_total').val(ftotamt.toFixed('2'));
      $('#amwords').html(withDecimal(ftotamt.toFixed('2')));
   }
   else
   {
      $('#oamount').val(0);
      var totamt = 0;
      $("input[id^='amount']").each(function(){
         var id = this.id;
         var res = id.substring(6);

         totamt = parseFloat(totamt)+parseFloat($('#'+id).val());

      });

      $('#grand_total').val(totamt.toFixed('2'));
      $('#amwords').html(withDecimal(totamt.toFixed('2')));
   }
}


function getAmount(i)
{
   var qty = $('#quantity'+i).val();
   var rat = $('#rate'+i).val();
   var oldqty = $('#old_qty_'+i).val();   

   var islocal = $('#is_local').val();

   if(parseFloat(qty)<=parseFloat(oldqty))
   {
      var amt = parseFloat(qty)*parseFloat(rat);

      if(islocal==1)
      {
         var ttype = $('#tax_type'+i).val();
         var tpercent = $('#tax_percent'+i).val();
         if(ttype==0)
            tpercent = parseFloat(tpercent)*2;

         var taxvalue = (parseFloat(amt)*parseFloat(tpercent))/100;
      }
      else
      {
         var taxvalue = 0;
      }

      var amtwtax = parseFloat(amt)+parseFloat(taxvalue);

      $('#amount'+i).val(amtwtax.toFixed('2'));

      var totamt = 0;
      $("input[id^='amount']").each(function(){
         var id = this.id;
         var res = id.substring(6);

         totamt = parseFloat(totamt)+parseFloat($('#'+id).val());

      });

      /*$('#grand_total').val(totamt.toFixed('2'));
      $('#amwords').html(withDecimal(totamt.toFixed('2')));*/
      var parti = $('#particulars').val();
      if(parti!='')
      {
         var totamt = 0;
         $("input[id^='amount']").each(function(){
            var id = this.id;
            var res = id.substring(6);

            totamt = parseFloat(totamt)+parseFloat($('#'+id).val());

         });

         var tbleamt = $('#taxable_amount').val();
         var ottype = $('#otax_type').val();
         var otpercent = $('#otax_percent').val();
         if(ottype==0)
            otpercent = parseFloat(otpercent)*2;

         var otaxvalue = (parseFloat(tbleamt)*parseFloat(otpercent))/100;

         var ototamt = parseFloat(tbleamt)+parseFloat(otaxvalue);

         $('#oamount').val(ototamt.toFixed('2'));

         var oamt = $('#oamount').val();

         var ftotamt = parseFloat(totamt)+parseFloat(oamt);
         
         $('#grand_total').val(ftotamt.toFixed('2'));
         $('#amwords').html(withDecimal(ftotamt.toFixed('2')));
      }
      else
      {
         $('#oamount').val(0);
         var totamt = 0;
         $("input[id^='amount']").each(function(){
            var id = this.id;
            var res = id.substring(6);

            totamt = parseFloat(totamt)+parseFloat($('#'+id).val());

         });

         $('#grand_total').val(totamt.toFixed('2'));
         $('#amwords').html(withDecimal(totamt.toFixed('2')));
      }
      $('#quantity_err'+i).html('');
   }
   else
   {
      $('#quantity_err'+i).html('Invalid Quantity!');
   }
}

function getCurrencyCode(val)
{
   var eid = $('#exporter_id').val();
   if(eid!='')
   {
      if(val!='')
      {
         $.ajax({
           type: "POST",
           url: baseurl+'quote/getCurrencyCode',
           async: false,
           type: "POST",
           data: "id="+val,
           dataType: "html",
           success: function(response)
           {
             $('.ccode').html(response);
             $('#curcode').val(response);
           }
         });

         $.ajax({
           type: "POST",
           url: baseurl+'proformainvoice/getBankDetail',
           async: false,
           type: "POST",
           data: "cid="+val+"&eid="+eid,
           dataType: "html",
           success: function(response)
           {
             $('#bank_detail_id').empty().html(response).selectpicker('refresh');
           }
         });
      }
      else
      {      
         $('.ccode').html('');
         $('#curcode').val('');
         $('#bank_detail_id').empty().html('<option vaue="">Choose Bank Detail</option>').selectpicker('refresh');
      }
   }
   else
   {
      alert("Choose Exporter!");
   }
}


function getExporterDetail(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'proformainvoice/getExporterDetail',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
           var data = response.split('|');
           $('#gstin_no').val(data[0]);
           $('#iec_no').val(data[1]);
        }
      });

      var cid = $('#currency_id').val();
      if(cid!='')
      {
         $.ajax({
           type: "POST",
           url: baseurl+'proformainvoice/getBankDetail',
           async: false,
           type: "POST",
           data: "cid="+cid+"&eid="+val,
           dataType: "html",
           success: function(response)
           {
             $('#bank_detail_id').empty().html(response).selectpicker('refresh');
           }
         });
      }
      else
      {
         $('#bank_detail_id').empty().html('<option vaue="">Choose Bank Detail</option>').selectpicker('refresh');
      }
   }
   else
   {
      $('#gstin_no').val('');
      $('#iec_no').val('');
   }
}

function getTermsofPayment(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'proformainvoice/getTermsofPayment',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#terms_of_payment_id').empty().html(response).selectpicker('refresh');
        }
      });
   }
   else
   {      
      $('#terms_of_payment_id').empty().html('<option vaue="">Choose Term of Payment</option>').selectpicker('refresh');
   }
}

function getLeadDetails(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'quote/getLeadDetails',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          var data = response.split('|');
          $('#organization_name').val(data[0]);
          $('#country').val(data[1]);
          $('#address').html(data[2]);
          $('#email_id').val(data[3]);
          $('#phone_no').val(data[4]);
          $('#assigned_to').val(data[5]);
        }
      });
   }
   else
   {      
      $('#organization_name').val('');
      $('#country').val('');
      $('#address').html('');
      $('#email_id').val('');
      $('#phone_no').val('');
      $('#assigned_to').val('');
   }
}

function getFromPort(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'quote/getFromPort',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#port_of_loading_id').empty().html(response).selectpicker('refresh');
        }
      });
   }
   else
   {      
      $('#from_port').empty().html('<option vaue="">Choose Port</option>').selectpicker('refresh');
   }
}

function getInterestText(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'proformainvoice/getInterestText',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#intrest_text').html(response);
          $('.inttext').show();
        }
      });
   }
   else
   {      
      $('#intrest_text').html('');
      $('.inttext').hide();
   }
}

function getTAPText(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'proformainvoice/getTAPText',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#terms_and_payment_text').html(response);
          $('.taptext').show();
        }
      });
   }
   else
   {      
      $('#terms_and_payment_text').html('');
      $('.taptext').hide();
   }
}

function getTOPText(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'proformainvoice/getTOPText',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#terms_of_payment_text').html(response);
          $('.toptext').show();
        }
      });
   }
   else
   {      
      $('#terms_of_payment_text').html('');
      $('.toptext').hide();
   }
}

function getArbitrationText(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'proformainvoice/getArbitrationText',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#arbitration_text').html(response);
          $('.arbtext').show();
        }
      });
   }
   else
   {      
      $('#arbitration_text').html('');
      $('.arbtext').hide();
   }
}

function getDeclarationText(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'proformainvoice/getDeclarationText',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#declaration').html(response);
          $('.dectext').show();
        }
      });
   }
   else
   {      
      $('#declaration').html('');
      $('.dectext').hide();
   }
}

function changeDocReq()
{
   var favorite = [];
   $.each($("input[name='document_required']:checked"), function(){
      favorite.push($(this).val());
   });
   $('#docrequired').val(favorite.join(","));
}

function invoice_validation()
{
   var err = 0;
   var expoid = $('#exporter_id').val();
   var sub = $('#subject').val();
   var pidate = $('#proforma_invoice_date').val();
   var toptype = $('#terms_of_payment_type_id').val();
   var bcdate = $('#buyer_confirmation_date').val();
   var pistage = $('#pi_stage_id').val();
   var cname = $('#lead_id').val();
   var pcbid = $('#pre_carriage_by_id').val();
   var porbpc = $('#place_of_receipt_by_pre_carrier').val();
   var vfid = $('#vessel_flight_id').val();
   var pol = $('#port_of_loading_id').val();
   var pod = $('#port_of_discharge_id').val();
   var pofd = $('#final_destination_id').val();  
   var curr = $('#currency_id').val();
   var rat = $('#rate').val();
   var bdetail = $('#bank_detail_id').val();

   if(expoid=='')
   {
      $('#exporter_id_err').html('Choose Bill On!');
      err++;
   }
   else
   {
      $('#exporter_id_err').html('');
   }

   if(sub=='')
   {
      $('#subject_err').html('Subject is required!');
      err++;
   }
   else
   {
      $('#subject_err').html('');
   }

   if(pidate=='')
   {
      $('#proforma_invoice_date_err').html('Proforma Invoice Date is required!');
      err++;
   }
   else
   {
      $('#proforma_invoice_date_err').html('');
   }

   if(toptype=='')
   {
      $('#terms_of_payment_type_id_err').html('Choose Terms of Payment Type!');
      err++;
   }
   else
   {
      $('#terms_of_payment_type_id_err').html('');
   }

   if(bcdate=='')
   {
      $('#buyer_confirmation_date_err').html('Buyer Confirmation Date is required!');
      err++;
   }
   else
   {
      $('#buyer_confirmation_date_err').html('');
   }

   if(pistage=='')
   {
      $('#pi_stage_id_err').html('Choose PI Stage!');
      err++;
   }
   else
   {
      $('#pi_stage_id_err').html('');
   }

   if(cname=='')
   {
      $('#lead_id_err').html('Choose Contact Name!');
      err++;
   }
   else
   {
      $('#lead_id_err').html('');
   }

   if(pcbid=='')
   {
      $('#pre_carriage_by_id_err').html('Choose Pre Carriage By!');
      err++;
   }
   else
   {
      $('#pre_carriage_by_id_err').html('');
   }

   if(porbpc=='')
   {
      $('#place_of_receipt_by_pre_carrier_err').html('Place of Receipt is required');
      err++;
   }
   else
   {
      $('#place_of_receipt_by_pre_carrier_err').html('');
   }

   if(vfid=='')
   {
      $('#vessel_flight_id_err').html('Choose Vessel/Flight!');
      err++;
   }
   else
   {
      $('#vessel_flight_id_err').html('');
   }

   if(pol=='')
   {
      $('#port_of_loading_id_err').html('Choose Port of Loading!');
      err++;
   }
   else
   {
      $('#port_of_loading_id_err').html('');
   }

   if(pod=='')
   {
      $('#port_of_discharge_id_err').html('Choose Port of Discharge!');
      err++;
   }
   else
   {
      $('#port_of_discharge_id_err').html('');
   }

   if(pofd=='')
   {
      $('#final_destination_id_err').html('Choose Final Destination!');
      err++;
   }
   else
   {
      $('#final_destination_id_err').html('');
   }

   if(curr=='')
   {
      $('#currency_id_err').html('Choose Currency!');
      err++;
   }
   else
   {
      $('#currency_id_err').html('');
   }

   if(rat=='')
   {
      $('#rate_err').html('Rate is required!');
      err++;
   }
   else
   {
      $('#rate_err').html('');
   }

   if(bdetail=='')
   {
      $('#bank_detail_id_err').html('Choose Bank Detail!');
      err++;
   }
   else
   {
      $('#bank_detail_id_err').html('');
   }

   var bav=0
$("fieldset[id^='mid']").each(function(){
  var id = this.id;
  var res = id.substring(3);
  var venid=$('#vendor_id'+res).val();
  var markno=$('#marks_and_no'+res).val();
  var pitem=$('#product_item_id'+res).val();
  var qty=$('#quantity'+res).val();
  var rate=$('#rate'+res).val();
  var oldqty = $('#old_qty_'+res).val();

  if(bav==0)  
  {     
     if(venid==''){
       $('#vendor_id_err'+res).html('Choose Vendor!');
       err++;
     }else{
       $('#vendor_id_err'+res).html('');
     }

     if(markno==''){
       $('#marks_and_no_err'+res).html('Mark & No is required!');
       err++;
     }else{
       $('#marks_and_no_err'+res).html('');
     }

     if(pitem==''){
       $('#product_item_id_err'+res).html('Choose Product Item!');
       err++;
     }else{
       $('#product_item_id_err'+res).html('');
     }
     
     if(qty=='' || qty==0){
       $('#quantity_err'+res).html('Quantity is required!');
       err++;
     }else{
      if(parseFloat(qty)>parseFloat(oldqty))
      {
         $('#quantity_err'+res).html('Invalid Quantity!');
       err++;
      }
      else
      {
       $('#quantity_err'+res).html('');
      }
     }
     
     if(rate=='' || rate==0){
       $('#rate_err'+res).html('Rate is required!');
       err++;
     }else{
       $('#rate_err'+res).html('');
     }
   }
   else
   {     

     if(venid!='' && markno==''){
       $('#marks_and_no_err'+res).html('Mark & No is required!');
       err++;
     }else{
       $('#marks_and_no_err'+res).html('');
     }

     if(venid!='' && pitem==''){
       $('#product_item_id_err'+res).html('Choose Product Item!');
       err++;
     }else{
       $('#product_item_id_err'+res).html('');
     }
     
     if(venid!='' && (qty=='' || qty==0)){
       $('#quantity_err'+res).html('Quantity is required!');
       err++;
     }else{
       
         if(parseFloat(qty)>parseFloat(oldqty))
         {
            $('#quantity_err'+res).html('Invalid Quantity!');
          err++;
         }
         else
         {
          $('#quantity_err'+res).html('');
         }
     }
     
     if(venid!='' && (rate=='' || rate==0)){
       $('#rate_err'+res).html('Rate is required!');
       err++;
     }else{
       $('#rate_err'+res).html('');
     }
     
   }
   bav++;
});
   
   if(err> 0){ return false;}else{ return true; }   
}
</script>




   </body>

   <!-- end::Body -->
</html>