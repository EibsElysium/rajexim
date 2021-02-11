<?php $this->load->view('common_header'); $date_format =common_date_format();?>
       <!--Summernote [ OPTIONAL ]-->
       <link href="<?php echo base_url();?>assets/mailbox/js/summernote/summernote.css" rel="stylesheet">
<style type="text/css">
   /*.m-wizard [data-wizard-action=""]{display: none;}*/
   /*.m-wizard.m-wizard--step-first [data-wizard-action=""] {
    display: none;
}
.m-wizard.m-wizard--step-between [data-wizard-action=""] {
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
                              <a href="<?php echo base_url(); ?>proformainvoice" class="m-nav__link">
                                 <span class="m-nav__link-text">Proforma Invoice</span>
                              </a>
                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Create Proforma Invoice</span>
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
                                       Create Proforma Invoice
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
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
                           <!--end: Portlet Head-->
                                 <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>proformainvoice/create_proformainvoice" onsubmit="return proformainvoice_validation();">
                                    <input type="hidden" id="quote_id" name="quote_id" value="<?php echo $quotelist->quote_id;?>">
                                    <input type="hidden" id="is_local" name="is_local" value="<?php echo $quotelist->is_local;?>">
                                    <!--begin: Form Body -->
                                    <div class="m-portlet__body">
                                       <!--begin: Form Wizard Step 1-->
                                       <fieldset>
                                          <legend><b>Proforma Invoice Details</b></legend>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Bill On<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="exporter_id" name="exporter_id" onchange="getExporterDetail(this.value);"> 
                                                      <option value="">Select Exporter</option>
                                                      <?php foreach ($exporter_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['exporter_id']; ?>" <?php echo $quotelist->exporter_id == $vflist['exporter_id']?'selected':'';?>><?php echo $vflist['exporter_name']; ?></option>
                                                      <?php }}?>
                                                   </select>
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
                                                   <label>Invoice No<span class="text-danger">*</span></label>
                                                   <input type="text" id="proforma_invoice_no" name="proforma_invoice_no" value="<?php echo $proforma_invoice_no;?>" class="form-control"  readonly>
                                                   <span class="text-danger"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Date<span class="text-danger">*</span></label>
                                                   <input type="text" id="alter_proforma_invoice_date" onblur="pidate_change_to_commondate();" name="alter_proforma_invoice_date" class="form-control m_datepicker_1">
                                                   <input type="hidden" id="proforma_invoice_date" name="proforma_invoice_date">
                                                   <span class="text-danger" id="proforma_invoice_date_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Subject<span class="text-danger">*</span></label>
                                                   <input type="text" id="subject" name="subject" class="form-control"  placeholder="Enter Subject" value="<?php echo $quotelist->subject;?>">
                                                   <span class="text-danger" id="subject_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Terms of Payment Type<span class="text-danger">*</span></label>
                                                   <select class="form-control custom-select" id="terms_of_payment_type_id" name="terms_of_payment_type_id" onchange="getTermsandPayment(this.value);"> 
                                                      <option value="">Select</option>
                                                      <?php foreach ($terms_of_payment_type_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['terms_of_payment_type_id']; ?>"><?php echo $vflist['terms_of_payment_type']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="terms_of_payment_type_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Buyer Confirmation Date<span class="text-danger">*</span></label>
                                                   <input type="text" id="alter_buyer_confirmation_date" name="alter_buyer_confirmation_date" onblur="buyerdate_change_to_commondate();" class="form-control m_datepicker_1">
                                                   <input type="hidden" id="buyer_confirmation_date" name="buyer_confirmation_date">
                                                   <span class="text-danger" id="buyer_confirmation_date_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Other References</label>
                                                   <input type="text" id="other_reference" name="other_reference" class="form-control"  placeholder="Enter Other Reference">
                                                   <span class="text-danger" id="other_reference_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>PI Stage<span class="text-danger">*</span></label>
                                                   <select class="form-control custom-select" id="pi_stage_id" name="pi_stage_id"> 
                                                      <option value = ''>Select Stage</option> 
                                                      <?php foreach ($pi_stage_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['pi_stage_id']; ?>"><?php echo $vflist['pi_stage']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="pi_stage_id_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <h5 class="text-theme mt_25px"><b>Buyer Details</b></h5><hr>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Contact Name<span class="text-danger">*</span></label>
                                                   <!-- <select class="form-control m-bootstrap-select m_selectpicker" id="lead_id" name="lead_id" data-live-search="true" onchange="getLeadDetails(this.value);"> 
                                                      <option value=''>Choose Name</option> 
                                                      <?php foreach ($opportunity_list as $vflist) { ?>
                                                         <option value="<?php echo $vflist['lead_id']; ?>" <?php echo $quotelist->lead_id == $vflist['lead_id']?'selected':'';?>><?php echo $vflist['lead_name']; ?></option>
                                                      <?php }?>
                                                   </select> -->

                                                   <input type="text" class="form-control" name="lead_id_by_name" id="lead_id_by_name" value="<?php $lead_info = common_select_values('*','leads','lead_id = "'.$quotelist->lead_id.'"','row'); $get_cb_info = common_select_values('*','contact_book','contact_book_id = "'.$lead_info->contact_book_id.'"','row'); echo $get_cb_info->lead_name; ?>" readonly>
                                                   <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $quotelist->lead_id; ?>">
                                                   <span class="text-danger" id="lead_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Organization Name</label>

                                                   <input type="text" id="organization_name" name="organization_name" class="form-control"  value="<?php echo $quotelist->company_name;?>">
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Country<span class="text-danger">*</span></label>
                                                   <!-- <input type="text" id="country" name="country" class="form-control" value="<?php echo $quotelist->country_name;?>"  readonly> -->
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="country" name="country" data-live-search="true"> 
                                                      <option value=''>Choose Country</option> 
                                                      <?php foreach ($country_lists as $key => $c_list) { ?>
                                                         <option value="<?php echo $c_list->id; ?>" <?php echo $quotelist->country == $c_list->id?'selected':'';?>><?php echo $c_list->name; ?></option>
                                                      <?php }?>
                                                   </select>
                                                   <span class="text-danger" id="country_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Email ID<span class="text-danger">*</span></label>

                                                   <input type="text" id="email_id" name="email_id" class="form-control" value="<?php echo $quotelist->email_id;?>">
                                                   <span class="text-danger" id="email_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Phone No</label>

                                                   <input type="text" id="phone_no" name="phone_no" class="form-control" value="<?php echo $quotelist->contact_no;?>">
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Mobile No</label>

                                                   <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="<?php echo $quotelist->office_phone_no;?>">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Assigned To</label>
                                                   <input type="text" id="assigned_to" name="assigned_to" class="form-control" value="<?php echo $quotelist->lead_assigned_name;?>" readonly>
                                                </div>
                                             </div>
                                             <div class="col-lg-8">
                                                <div class="form-group m-form__group"> <label>Address</label>
                                                   <textarea class="form-control snote" cols="40" id="address" name="address" rows="2"> <?php echo $quotelist->address;?></textarea>
                                                </div>
                                             </div>

                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Pre-Carriage By<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="pre_carriage_by_id" name="pre_carriage_by_id" data-live-search="true"> 
                                                      <option value=''>Choose</option> 
                                                      <?php foreach ($pre_carriage_by_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['pre_carriage_by_id']; ?>"><?php echo $vflist['pre_carriage_by']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="pre_carriage_by_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Place of Receipt by Pre-Carrier<span class="text-danger">*</span></label>
                                                   <input type="text" id="place_of_receipt_by_pre_carrier" name="place_of_receipt_by_pre_carrier" class="form-control"  placeholder="Enter Place of Receipt">
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
                                                         <option value="<?php echo $vflist['vessel_flight_id']; ?>" <?php echo $quotelist->vessel_flight_id == $vflist['vessel_flight_id']?'selected':'';?>><?php echo $vflist['vessel_flight_name']; ?></option>
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
                                                      <?php echo $from_port;?>
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
                                                         <option value="<?php echo $vflist['port_id']; ?>" <?php echo $quotelist->to_port == $vflist['port_id']?'selected':'';?>><?php echo $vflist['port_name']; ?> - <?php echo $vflist['port_city']; ?> - <?php echo $vflist['port_country']; ?></option>
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
                                                         <option value="<?php echo $vflist['port_id']; ?>"><?php echo $vflist['port_name']; ?> - <?php echo $vflist['port_city']; ?> - <?php echo $vflist['port_country']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="final_destination_id_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                       </fieldset>
                                       <!--end: Form Wizard Step 1-->
                                       <!--begin: Form Wizard Step 2-->
                                       <fieldset>
                                          
                                          <legend><b>Item Details</b></legend>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Currency<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="currency_id" name="currency_id" data-live-search="true" onchange="getCurrencyCode(this.value);"> 
                                                      <option value="">Choose Currency</option>  
                                                      <?php foreach ($currency_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['currency_id']; ?>" <?php echo $quotelist->currency_id == $vflist['currency_id']?'selected':'';?>><?php echo $vflist['currency_name']; ?> - <?php echo $vflist['currency_code']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <input type="hidden" id="curcode">
                                                   <span class="text-danger" id="currency_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Rate<span class="text-danger">*</span></label>
                                                   <input type="text" class="form-control" id="rate" value="<?php echo $quotelist->rate;?>" name="ratec" placeholder="Enter Rate">
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
                                             <?php $specification_groups=''; $i=0;foreach($quote_product_list as $qplist){

                                                $dispname = $this->Productcosting_model->get_display_name_by_product_item_display_name_id($qplist['product_item_display_name_id']);
                                                $displayname = $this->Product_model->get_display_name_by_piid($qplist['product_item_id']);
                                                ?>
                                                <fieldset id="mid<?php echo $i;?>">
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
                                                               <select class="form-control m-bootstrap-select m_selectpicker" id="vendor_id<?php echo $i;?>" name="vendor_id[]" data-live-search="true"> 
                                                                  <?php $venoption = '<option value="">Select Vendor</option>';?>
                                                                  <option value="">Select Vendor</option>
                                                                  <?php foreach ($vendor_list as $value) { ?>
                                                                     <option value="<?php echo $value['vendor_id']; ?>" <?php echo $qplist['vendor_id'] == $value['vendor_id']?'selected':'';?>><?php echo $value['vendor_name'];?></option>
                                                                     <?php $venoption.='<option value="'.$value['vendor_id'].'">'.$value['vendor_name'].'</option>';
                                                                  } ?>
                                                               </select>
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
                                                               <input type="text" class="form-control" id="pname0" name="pname[]" value="<?php echo $qplist['product_name'].' - '.$qplist['product_item'];?>" readonly>
                                                               <?php $specification_groups .= '<b>'.$qplist['product_name'].' - '.$qplist['product_item'].'</b>'; ?>
                                                               <input type="hidden" id="product_item_id<?php echo $i;?>" name="product_item_id[]" value="<?php echo $qplist['product_item_id'];?>">
                                                               <!-- <select class="form-control m-bootstrap-select m_selectpicker" id="product_item_id<?php //echo $i;?>" name="product_item_id[]" data-live-search="true"> 
                                                                  <?php //$prodoption = '<option value="">Select Item</option>';?>
                                                                  <option value="">Select Item</option>
                                                                  <?php //foreach ($product_item_list as $value) { ?>
                                                                     <option value="<?php //echo $value['product_item_id']; ?>" <?php //echo $qplist['product_item_id'] == $value['product_item_id']?'selected':'';?>><?php //echo $value['product_name'];?> -  <?php //echo $value['product_item'];?></option>
                                                                     <?php //$prodoption.='<option value="'.$value['product_item_id'].'">'.$value['product_name'].' - '.$value['product_item'].'</option>';
                                                                  //} ?>
                                                               </select> -->
                                                               <span class="text-danger" id="product_item_id_err<?php echo $i;?>"></span>
                                                            </div>
                                                         </div>
                                                         <div class="col-lg-2">
                                                            <div class="form-group m-form__group">
                                                               <label>Display Name</label>
                                                               <?php //if(count($dispname)>0){?>
                                                                  <!-- <input type="text" class="form-control" id="dname<?php //echo $i;?>" name="dname[]" value="<?php //echo $dispname->display_name;?>" readonly>
                                                                  <input type="hidden" id="product_item_display_name_id<?php //echo $i;?>" name="product_item_display_name_id[]" value="<?php //echo $dispname->product_item_display_name_id;?>"> -->
                                                               <?php //}else{?>
                                                                  <select class="form-control m-bootstrap-select m_selectpicker" id="product_item_display_name_id<?php echo $i;?>" name="product_item_display_name_id[]" data-live-search="true" onchange="getDisplayName(this.value,<?php echo $i;?>);"> 
                                                                  <option value=''>Choose Display Name</option> 
                                                                  <?php foreach($displayname as $dname){?>
                                                                     <option value="<?php echo $dname['product_item_display_name_id'];?>"><?php echo $dname['display_name'];?></option>
                                                                  <?php }?>
                                                               </select>
                                                               <?php //}?>
                                                               <span class="text-danger" id="product_item_display_name_id_err<?php echo $i;?>"></span>
                                                            </div>
                                                         </div>
                                                         <!-- <input type="hidden" id="specification<?php //echo $i;?>" name="specification[]" class="form-control" placeholder="Specification" value="<?php //echo $qplist['product_item_spec'];?>" readonly> -->
                                                         <div class="col-lg-4" style="display: none;">
                                                            <div class="form-group m-form__group">
                                                               <label>Specification<span class="text-danger">*</span></label>
                                                               <!-- <input type="text" id="specification<?php echo $i;?>" name="specification[]" class="form-control snote" placeholder="Specification" value="<?php //echo $qplist['product_item_spec'];?>"> -->
                                                               <textarea class="form-control snote" id="specification<?php echo $i;?>" name="specification[]" rows="3"><?php echo $qplist['product_item_spec'];?></textarea>
                                                               <?php $specification_groups .= $qplist['product_item_spec'].'<br>'; ?>
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
                                                               <input type="text" id="quantity<?php echo $i;?>" name="quantity[]" class="form-control" placeholder="Enter Quantity" value="<?php echo $qplist['quantity'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getAmount(<?php echo $i;?>);">
                                                               <span class="text-danger" id="quantity_err<?php echo $i;?>"></span>
                                                            </div>
                                                         </div>
                                                         <div class="col-lg-2">
                                                            <div class="form-group m-form__group">
                                                               <label>Rate in <span class="ccode"><?php echo $curcode;?></span><span class="text-danger">*</span></label>
                                                               <input type="text" id="rate<?php echo $i;?>" name="rate[]" class="form-control" placeholder="Enter Rate" value="<?php echo $qplist['rate'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getAmount(<?php echo $i;?>);">
                                                               <span class="text-danger" id="rate_err<?php echo $i;?>"></span>
                                                            </div>
                                                         </div>
                                                      
                                                         <div class="col-lg-2" <?php echo $quotelist->is_local==0?"style=display:none;":'';?>>
                                                            <div class="form-group m-form__group">
                                                               <label>Tax Type<span class="text-danger">*</span></label>
                                                               <input type="text" class="form-control" id="tax_type_value<?php echo $i;?>" name="tax_type_value[]" value="<?php echo $qplist['tax_type']==0?'CGST/SGST':'IGST';?>" readonly>
                                                               <input type="hidden" id="tax_type<?php echo $i;?>" name="tax_type[]" value="<?php echo $qplist['tax_type'];?>">
                                                               <span class="text-danger" id="tax_type_err<?php echo $i;?>"></span>
                                                            </div>
                                                         </div>
                                                         <div class="col-lg-2" <?php echo $quotelist->is_local==0?"style=display:none;":'';?>>
                                                            <div class="form-group m-form__group">
                                                               <label>Tax %<span class="text-danger">*</span></label>
                                                               <input type="text" id="tax_percent<?php echo $i;?>" name="tax_percent[]" class="form-control" placeholder="Enter Tax %" value="<?php echo $qplist['tax_percent'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" readonly>
                                                               <span class="text-danger" id="tax_percent_err<?php echo $i;?>"></span>
                                                            </div>
                                                         </div>

                                                         <div class="col-lg-2">
                                                            <div class="form-group m-form__group">
                                                               <label>Amount in <span class="ccode"></span><span class="text-danger">*</span></label>
                                                               <input type="text" id="amount<?php echo $i;?>" name="amount[]" class="form-control" readonly value="<?php echo $qplist['amount'];?>">
                                                               <span class="text-danger" id="amount_err<?php echo $i;?>"></span>
                                                            </div>
                                                         </div>
                                                         
                                                         
                                                      </div>
                                                </fieldset>
                                             <?php $i++;}?>
                                          </div>
                                         
                                          <?php if($quotelist->is_local==1){?>
                                             <fieldset>
                                                <legend>
                                                   Other Charges
                                                </legend>
                                                <div class="row">
                                                   <div class="col-lg-4">
                                                      <div class="form-group m-form__group">
                                                         <label>Particulars</label>
                                                         <input type="text" id="particulars" name="particulars" class="form-control" placeholder="Particulars" onkeyup="getOthersAmount();">
                                                         <span class="text-danger" id="particulars_err"></span>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-2">
                                                      <div class="form-group m-form__group">
                                                         <label>Taxable Amount</label>
                                                         <input type="text" id="taxable_amount" name="taxable_amount" class="form-control" placeholder="Enter Taxable Amount" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getOthersAmount();">
                                                         <span class="text-danger" id="taxable_amount_err"></span>
                                                      </div>
                                                   </div>
                                                
                                                <div class="col-lg-2">
                                                   <div class="form-group m-form__group">
                                                      <label>Tax Type</label>
                                                      <select class="form-control m-bootstrap-select m_selectpicker" id="otax_type" name="otax_type" data-live-search="true" onchange="getOthersAmount();"> 
                                                         <option value='0'>CGST/SGST</option>
                                                         <option value='1'>IGST</option>
                                                      </select>
                                                      <span class="text-danger" id="otax_type_err"></span>
                                                   </div>
                                                </div>
                                                <div class="col-lg-2">
                                                   <div class="form-group m-form__group">
                                                      <label>Tax %</label>
                                                      <input type="text" id="otax_percent" name="otax_percent" class="form-control" placeholder="Enter Tax %" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getOthersAmount();">
                                                      <span class="text-danger" id="otax_percent_err"></span>
                                                   </div>
                                                </div>
                                                   <div class="col-lg-2">
                                                      <div class="form-group m-form__group">
                                                         <label>Amount</label>
                                                         <input type="text" id="oamount" name="oamount" class="form-control" readonly value="0">
                                                         <span class="text-danger" id="oamount_err"></span>
                                                      </div>
                                                   </div>
                                                   
                                                   
                                                </div>
                                             </fieldset>
                                          <?php }?>

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
                                          </div>
                                          <input type="hidden" id="mailcount" name="mailcount" value="<?php //echo count($quote_product_list);?>"> -->

                                          <div class="row mt_25px">
                                             <div class="col-lg-9">
                                                <label>Amount Chargeable in <span class="ccode"><?php echo $curcode;?></span></label>
                                                <h5 class="text-theme"><span id="amwords"><span></h5>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Total</label>

                                                   <input type="text" id="grand_total" name="grand_total" class="form-control" readonly value="<?php echo $quotelist->grand_total;?>">
                                                </div>
                                             </div>
                                          </div>
                                       
                                       </fieldset>
                                       <!--end: Form Wizard Step 2-->

                                       <!--begin: Form Wizard Step 3-->
                                       <fieldset>
                                          
                                          <legend><b>Notes</b></legend>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <div class="form-group m-form__group">
                                                   <label>Sales Note</label>
                                                   <textarea class="form-control snote" id="sales_note" name="sales_note" rows="3"></textarea>
                                                   <span class="text-danger" id="sales_note_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group m-form__group">
                                                   <label>Purchase Note</label>
                                                   <textarea class="form-control snote" id="purchase_note" name="purchase_note" rows="3"></textarea>
                                                   <span class="text-danger" id="purchase_note_err"></span>
                                                </div>
                                             </div>                                              
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <div class="form-group m-form__group">
                                                   <label>Shipping Note</label>
                                                   <textarea class="form-control snote" id="shipping_note" name="shipping_note" rows="3"></textarea>
                                                   <span class="text-danger" id="shipping_note_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group m-form__group">
                                                   <label>Accounts Note</label>
                                                   <textarea class="form-control snote" id="accounts_note" name="accounts_note" rows="3"></textarea>
                                                   <span class="text-danger" id="accounts_note_err"></span>
                                                </div>
                                             </div>                                              
                                          </div>
                                          
                                       
                                       </fieldset>
                                       <!--end: Form Wizard Step 3-->

                                       <!--begin: Form Wizard Step 4-->
                                       <fieldset>
                                          
                                          <legend><b>Other Details</b></legend>
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                   <label>Price Validity<span class="text-danger">*</span></label>
                                                   <input type="text" id="price_validity" name="price_validity" class="form-control"  placeholder="Enter Price Validity">
                                                   <span class="text-danger" id="price_validity_err"></span>
                                                </div>
                                                <div class="form-group">
                                                   <label>Loadability<span class="text-danger">*</span></label>
                                                   <textarea class="form-control snote" id="loadability" name="loadability" rows="3"></textarea>
                                                   <span class="text-danger" id="loadability_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <label>Specificaiton Groups</label>
                                                <textarea class="form-control snote" id="specification_group" name="specification_group"><?php echo $specification_groups; ?></textarea>
                                             </div>
                                             <div class="col-lg-6" style="display:none;">
                                                <div class="form-group m-form__group">
                                                   <label>Specifications and Packing Details</label>
                                                   <textarea class="form-control snote" id="specification_packing_details" name="specification_packing_details" rows="3"></textarea>
                                                   <span class="text-danger" id="specification_packing_details_err"></span>
                                                </div>
                                             </div>  
                                                                                         
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6">                                                
                                                <div class="form-group">
                                                   <label>Interest<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="interest_id" name="interest_id" data-live-search="true" onchange="getInterestText(this.value);"> 
                                                      <option value="">Choose Interest</option>  
                                                      <?php foreach ($interest_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['interest_id']; ?>"><?php echo $vflist['interest_label']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="interest_id_err"></span>
                                                </div>                                               
                                                <div class="form-group inttext" style="display:none;">
                                                   <label>Interest Details<span class="text-danger">*</span></label>
                                                   <textarea class="form-control snote" id="intrest_text" name="intrest_text" rows="3" readonly></textarea>
                                                   
                                                </div>
                                             </div>  
                                             <div class="col-lg-6">                                                
                                                <div class="form-group">
                                                   <label>Terms & Payment<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="terms_and_payment_id" name="terms_and_payment_id" data-live-search="true" onchange="getTAPText(this.value);"> 
                                                      <option value="">Choose Terms & Payment</option> 
                                                   </select>
                                                   <span class="text-danger" id="terms_and_payment_id_err"></span>
                                                </div>                                               
                                                <div class="form-group taptext" style="display:none;">
                                                   <textarea class="form-control snote " id="terms_and_payment_text" name="terms_and_payment_text" rows="3" ></textarea>
                                                </div>
                                             </div> 
                                                                                         
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-6" >                                                
                                                <div class="form-group">
                                                   <label>Terms of Payment<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="terms_of_payment_id" name="terms_of_payment_id" data-live-search="true" onchange="getTOPText(this.value);"> 
                                                      <option value="">Choose Terms of Payment</option> 
                                                   </select>
                                                   <span class="text-danger" id="terms_of_payment_id_err"></span>
                                                </div>                                               
                                                <div class="form-group toptext"  style="display:none;">
                                                   <textarea class="form-control snote " id="terms_of_payment_text" name="terms_of_payment_text" rows="3" ></textarea>
                                                </div>
                                             </div> 
                                             <div class="col-lg-6">                                                
                                                <div class="form-group">
                                                   <label>Arbitration<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="arbitration_id" name="arbitration_id" data-live-search="true" onchange="getArbitrationText(this.value);"> 
                                                      <option value="">Choose Arbitration</option>  
                                                      <?php foreach ($arbitration_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['arbitration_id']; ?>"><?php echo $vflist['arbitration_label']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="arbitration_id_err"></span>
                                                </div>                                               
                                                <div class="form-group">
                                                   <textarea class="form-control snote arbtext" id="arbitration_text" name="arbitration_text" rows="3" readonly style="display:none;"></textarea>
                                                </div>
                                             </div> 
                                                                                        
                                          </div>

                                          <div class="row">
                                             <div class="col-lg-6">                                                
                                                <div class="form-group">
                                                   <label>Declaration<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="declaration_id" name="declaration_id" data-live-search="true" onchange="getDeclarationText(this.value);"> 
                                                      <option value="">Choose Declaration</option>  
                                                      <?php foreach ($declaration_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['declaration_id']; ?>"><?php echo $vflist['declaration_label']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="declaration_id_err"></span>
                                                </div>                                               
                                                <div class="form-group">
                                                   <textarea class="form-control snote dectext" id="declaration" name="declaration" rows="3" readonly style="display:none;" ></textarea>
                                                </div>
                                             </div>  
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                   <label>Price Term<span class="text-danger">*</span></label>
                                                   <textarea class="form-control snote dectext" id="price" name="price" rows="3"></textarea>
                                                   <span class="text-danger" id="price_err"></span>
                                                </div>
                                             </div>

                                          </div>

                                          
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                   <label>Document Required<span class="text-danger">*</span></label>
                                                      <div class="row"> 
                                                   <?php $i=0; $cdlist = count($document_required_list);foreach($document_required_list as $docreq){
                                                      if($docreq['status']==0){?>                                 
                                                         <div class="col-lg-4">
                                                            <div class="form-group m-form__group">
                                                               <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                                                  <input type="checkbox" class="menu_checkbox" id="document_required<?php echo $i;?>" name="document_required" value="<?php echo $docreq['document_required_id'];?>" onchange="changeDocReq();"> <?php echo $docreq['document_required'];?>
                                                                  <span></span>
                                                               </label>
                                                            </div>
                                                         </div>                                                         
                                                   <?php }$i++;}?>
                                                      <span class="text-danger" id="document_required_err"></span>
                                                      </div>
                                                      <input type="hidden" id="docrequired" name="docrequired">
                                                </div>
                                             </div>
                                          </div>
                                       
                                       </fieldset>
                                       <!--end: Form Wizard Step 4-->
                                    </div>
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
                                 </form>
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
   $('#address').summernote('lineHeight', '5px');
   var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Create Proforma Invoice';
   $(document).attr("title", title);

$('.snote').summernote('lineHeight', '5px');

$('#amwords').html(withDecimal($('#grand_total').val()));
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
function buyerdate_change_to_commondate()
{
   var date_picker_val = $('#alter_buyer_confirmation_date').val();
   $('#buyer_confirmation_date').val(date_picker_val);
   $.ajax({
        url:baseurl+'Leads/change_dtrange_val',
        type:'POST',
        data:{'value':date_picker_val},
        dataType: 'html',
        success:function(result){
           $('#alter_buyer_confirmation_date').val(result);
        }
     });
}
function pidate_change_to_commondate()
{
   var date_picker_val = $('#alter_proforma_invoice_date').val();
   $('#proforma_invoice_date').val(date_picker_val);
   $.ajax({
        url:baseurl+'Leads/change_dtrange_val',
        type:'POST',
        data:{'value':date_picker_val},
        dataType: 'html',
        success:function(result){
           $('#alter_proforma_invoice_date').val(result);
        }
     });
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
   //var poption = '<?php //echo $prodoption;?>';
   
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
      // alert(totamt);
      $('#grand_total').val(totamt.toFixed('2'));
      $('#amwords').html(withDecimal(totamt.toFixed('2')));
   }
}


function getAmount(i)
{
   var qty = $('#quantity'+i).val();
   var rat = $('#rate'+i).val();

   var islocal = $('#is_local').val();

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
         // alert($('#'+id).val());
         totamt = parseFloat(totamt)+parseFloat($('#'+id).val());

      });

      var tbleamt = $('#taxable_amount').val();
      var ottype = $('#otax_type').val();
      var otpercent = $('#otax_percent').val();
      if(ottype==0)
         otpercent = parseFloat(otpercent)*2;

      var otaxvalue = (parseFloat(tbleamt)*parseFloat(otpercent))/100;
      alert('tbleamt '+tbleamt);
      alert('otpercent '+otpercent);
      var ototamt = parseFloat(tbleamt)+parseFloat(otaxvalue);
      alert('ototamt'+ototamt);
      $('#oamount').val(ototamt.toFixed('2'));

      var oamt = $('#oamount').val();
      alert('totamt :'+totamt);
      alert('oamt :'+oamt);
      var ftotamt = parseFloat(totamt)+parseFloat(oamt);
      alert('test1 '+ftotamt);
      // $('#grand_total').val(ftotamt.toFixed('2'));
      $('#grand_total').val(parseFloat(ftotamt.toFixed('2')));
      $('#amwords').html(withDecimal(ftotamt.toFixed('2')));
   }
   else
   {
      $('#oamount').val(0);
      var totamt = 0;
      $("input[id^='amount']").each(function(){
         var id = this.id;
         var res = id.substring(6);
         // alert(id);
         totamt = parseFloat(totamt)+parseFloat($('#'+id).val());

      });

      $('#grand_total').val(parseFloat(totamt.toFixed('2')));
      $('#amwords').html(withDecimal(totamt.toFixed('2')));
       alert('test '+totamt);
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

function getTermsandPayment(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'proformainvoice/getTermsandPayment',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          $('#terms_and_payment_id').empty().html(response).selectpicker('refresh');
        }
      });
   }
   else
   {      
      $('#terms_and_payment_id').empty().html('<option vaue="">Choose Terms & Payment</option>').selectpicker('refresh');
   }
}

/*function getTermsofPayment(val)
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
}*/

function getLeadDetails(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'quote/getLeadDetails1',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
          var data = response.split('|');
          $('#organization_name').val(data[0]);
          $('#country').val(data[1]).selectpicker('refresh');
          $('#address').html(data[2]);
          $('#email_id').val(data[3]);
          $('#phone_no').val(data[4]);
          $('#assigned_to').val(data[5]);
          $('#mobile_no').val(data[6]);
        }
      });
   }
   else
   {      
      $('#organization_name').val('');
      $('#country').val('').selectpicker('refresh');
      $('#address').html('');
      $('#email_id').val('');
      $('#phone_no').val('');
      $('#assigned_to').val('');
      $('#mobile_no').val('');
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
         $("#intrest_text").summernote("code", response);
          // $('#intrest_text').html(response);
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
          var dsplit = response.split('||');
          // $('#terms_and_payment_text').html(dsplit[0]);
          $("#terms_and_payment_text").summernote("code", dsplit[0]);
          $('.taptext').show();
          // $('#terms_and_payment_text').summernote('disable');

          $('#terms_of_payment_id').empty().html(dsplit[1]).selectpicker('refresh');
        }
      });
   }
   else
   {      
      $("#terms_and_payment_text").summernote("code", '');
      $('.taptext').hide();
      $('#terms_of_payment_id').empty().html('<option vaue="">Choose Terms of Payment</option>').selectpicker('refresh');
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
          // $('#terms_of_payment_text').html(response);
          $("#terms_of_payment_text").summernote("code", response);
          $('.toptext').show();
          // $('#terms_of_payment_text').summernote('disable');
        }
      });
   }
   else
   {      
      $("#terms_of_payment_text").summernote("code", "");
      // $('#terms_of_payment_text').html('');
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
          // $('#arbitration_text').html(response);
          $("#arbitration_text").summernote("code", response);
          $('.arbtext').show();
        }
      });
   }
   else
   {  
      $("#arbitration_text").summernote("code", "");
      // $('#arbitration_text').html('');
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
          // $('#declaration').html(response);
          $("#declaration").summernote("code", response);
          $('.dectext').show();
        }
      });
   }
   else
   {      
     $("#declaration").summernote("code", "");
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

function proformainvoice_validation()
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
   var pvalid = $('#price_validity').val();
   var loadab = $('#loadability').val();
   var iid = $('#interest_id').val();
   var tap = $('#terms_and_payment_id').val();
   var top = $('#terms_of_payment_id').val();
   var arb = $('#arbitration_id').val();
   var dec = $('#declaration_id').val();
   var docrec = $('#docrequired').val();
   var cntry = $('#country').val();
   var emid = $('#email_id').val();
   var pri = $('#price').val();

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

   if(cntry=='')
   {
      $('#country_err').html('Choose Country!');
      err++;
   }
   else
   {
      $('#country_err').html('');
   }

   if(emid=='')
   {
      $('#email_id_err').html('Enter Email Id!');
      err++;
   }
   else
   {
      $('#email_id_err').html('');
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

   if(pvalid=='')
   {
      $('#price_validity_err').html('Price Validity is required!');
      err++;
   }
   else
   {
      $('#price_validity_err').html('');
   }

   if(loadab=='')
   {
      $('#loadability_err').html('Loadability is required!');
      err++;
   }
   else
   {
      $('#loadability_err').html('');
   }

   if(iid=='')
   {
      $('#interest_id_err').html('Choose Interest!');
      err++;
   }
   else
   {
      $('#interest_id_err').html('');
   }

   if(tap=='')
   {
      $('#terms_and_payment_id_err').html('Choose Terms and Payment!');
      err++;
   }
   else
   {
      $('#terms_and_payment_id_err').html('');
   }

   if(toptype=='2' && top=='')
   {
      $('#terms_of_payment_id_err').html('Choose Terms of Payment!');
      err++;
   }
   else
   {
      $('#terms_of_payment_id_err').html('');
   }

   if(arb=='')
   {
      $('#arbitration_id_err').html('Choose Arbitration!');
      err++;
   }
   else
   {
      $('#arbitration_id_err').html('');
   }

   if(dec=='')
   {
      $('#declaration_id_err').html('Choose Declaration!');
      err++;
   }
   else
   {
      $('#declaration_id_err').html('');
   }

   if(toptype=='2' && docrec=='')
   {
      $('#document_required_err').html('Choose Any Document!');
      err++;
   }
   else
   {
      $('#document_required_err').html('');
   }

   if(pri=='')
   {
      $('#price_err').html('Price is required!');
      err++;
   }
   else
   {
      $('#price_err').html('');
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
  var dname = $('#product_item_display_name_id'+res).val();

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
       $('#quantity_err'+res).html('');
     }
     
     if(rate=='' || rate==0){
       $('#rate_err'+res).html('Rate is required!');
       err++;
     }else{
       $('#rate_err'+res).html('');
     }

     if(dname==''){
       $('#product_item_display_name_id_err'+res).html('Choose Display Name!');
       err++;
     }else{
       $('#product_item_display_name_id_err'+res).html('');
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
       $('#quantity_err'+res).html('');
     }
     
     if(venid!='' && (rate=='' || rate==0)){
       $('#rate_err'+res).html('Rate is required!');
       err++;
     }else{
       $('#rate_err'+res).html('');
     }

     if(venid!='' && dname==''){
       $('#product_item_display_name_id_err'+res).html('Choose Display Name!');
       err++;
     }else{
       $('#product_item_display_name_id_err'+res).html('');
     }
     
   }
   bav++;
});

var isloc = $('#is_local').val();

if(isloc==1)
{
   var parti = $('#particulars').val();
   if(parti!='')
   {
      var tblamt = $('#taxable_amount').val();
      var otpercent = $('#otax_percent').val();

      if(tblamt=='' || tblamt==0){
         $('#taxable_amount_err').html('Taxable amount is required!');
         err++;
      }else{
         $('#taxable_amount_err').html('');
      }
      
      if(otpercent=='' || otpercent==0){
         $('#otax_percent_err').html('Tax Percent is required!');
         err++;
      }else{
         $('#otax_percent_err').html('');
      }
   }
}
   
   if(err> 0){ return false;}else{ return true; }   
}
</script>




   </body>

   <!-- end::Body -->
</html>