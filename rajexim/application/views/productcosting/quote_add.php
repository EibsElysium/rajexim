<?php $this->load->view('common_header'); $date_format =common_date_format();?>
<style type="text/css">
   /*.m-wizard [data-wizard-action=""]{display: none;}*/
   /*.m-wizard.m-wizard--step-first [data-wizard-action=""] {
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
                              <a href="<?php echo base_url(); ?>quote" class="m-nav__link">
                                 <span class="m-nav__link-text">Quote Management</span>
                              </a>
                           </li>

                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="" class="m-nav__link">
                                 <span class="m-nav__link-text">Create Quote</span>
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
                                       Create Quote
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
                           <!--end: Portlet Head-->
                                 <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>quote/create_quote" onsubmit="return quote_validation();">
                                    <input type="hidden" id="is_local" name="is_local" value="<?php echo $quote_type;?>">
                                    <!--begin: Form Body -->
                                    <div class="m-portlet__body">
                                       <!--begin: Form Wizard Step 1-->
                                       <fieldset>
                                          <legend><b>Quote Details</b></legend>

                                          <div id="pcview">
                                          </div>
<br>
                                          <div class="row">
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Product Costing</label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="prod_costing_id" name="prod_costing_id" onchange="changeProductCostingValue(this.value);"> 
                                                      <?php foreach($product_costing_list_parent as $pclist)
                                                      {?>
                                                         <option value="<?php echo $pclist['product_costing_id'];?>" <?php echo $pclist['product_costing_id']==$pcid?'selected':'';?>><?php echo $pclist['product_costing_no'];?></option>
                                                      <?php }?>
                                                   </select>
                                                   <span class="text-danger" id="prod_costing_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Stage Type</label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="stage_type" name="stage_type" data-live-search="true" onchange="changeStage(this.value);">
                                                       <option value=''>Select Type</option>
                                                       <option value="fob" <?php echo $stage_type=='fob'?'selected':'';?>>FOB</option>
                                                       <option value="cnf" <?php echo $stage_type=='cnf'?'selected':'';?>>CNF</option>
                                                    </select>
                                                   <span class="text-danger" id="stage_type_err"></span>
                                                </div>
                                             </div>

                                             <div class="col-lg-3" id="cnfstage" style="<?php echo $stage_type=='fob'?'display:none':'';?>">
                                                <div class="form-group m-form__group">
                                                   <label>Stage<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="stage_id" name="stage_id" data-live-search="true" onchange="getProd_Cost_Value(this.value);">
                                                             <?php echo $pcstagelist;?>
                                                          </select>
                                                          <span id="stage_id_err" class="text-danger"></span>
                                                </div>
                                             </div>

                                             <div class="col-lg-3" id="fobstage" style="<?php echo $stage_type=='cnf'?'display:none':'';?>">
                                                <div class="form-group m-form__group">
                                                   <label>Stage<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="fob_stage_id" name="fob_stage_id" data-live-search="true" onchange="getProd_Cost_Value(this.value);">
                                                             <?php echo $fobpcstagelist;?>
                                                          </select>
                                                          <span id="fob_stage_id_err" class="text-danger"></span>
                                                </div>
                                             </div>

                                             <input type="hidden" id="fobusdval" name="fobusdval" value="<?php echo $fobusdval;?>">
                                             <input type="hidden" id="fobarrval" name="fobarrval" value="<?php echo $fobarrval;?>">
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Bill On<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="exporter_id" name="exporter_id" onchange="getExporterLogo(this.value);"> 
                                                      <option value="">Select Exporter</option>
                                                      <?php foreach ($exporter_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['exporter_id']; ?>"><?php echo $vflist['exporter_name']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="exporter_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Logo</label>
                                                   <div style="border: 1px solid #ccc;padding: 5px;">
                                                      <img src="<?php echo base_url();?>assets/demo/demo12/media/img/logo/logo_def.png" id="exporter_logo" height="75" width="100%"  alt="logo" style="object-fit: contain;">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Quote No<span class="text-danger">*</span></label>
                                                   <input type="text" id="quote_no" name="quote_no" value="<?php echo $quote_no;?>" class="form-control"  readonly>
                                                   <span class="text-danger"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Subject<span class="text-danger">*</span></label>
                                                   <input type="text" id="subject" name="subject" class="form-control"  placeholder="Enter Subject">
                                                   <span class="text-danger" id="subject_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">

                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Created Date<span class="text-danger">*</span></label>
                                                   <input type="text" id="alter_created_date" onblur="createdate_change_to_commondate();" name="alter_created_date" class="form-control m_datepicker_1">
                                                   <input type="hidden" id="created_date" name="created_date" >
                                                   <span class="text-danger" id="created_date_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Valid Till<span class="text-danger">*</span></label>
                                                   <input type="text" id="alter_valid_till" onblur="validtill_change_to_commondate();" name="alter_valid_till" class="form-control m_datepicker_1">
                                                   <input type="hidden" id="valid_till" name="valid_till">
                                                   <span class="text-danger" id="valid_till_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Quote Stage<span class="text-danger">*</span></label>
                                                   <select class="form-control custom-select" id="quote_stage_id" name="quote_stage_id"> 
                                                      <option value=''>Choose Stage</option> 
                                                      <?php foreach ($quote_stage_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['quote_stage_id']; ?>"><?php echo $vflist['quote_stage']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="quote_stage_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Price Validity<span class="text-danger">*</span></label>
                                                   <input type="text" class="form-control" id="price_validity" name="price_validity" placeholder="Enter Price Validity">
                                                   <span class="text-danger" id="price_validity_err"></span>
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
                                                      <?php //foreach ($opportunity_list as $vflist) { ?>
                                                         <option value="<?php //echo $vflist['lead_id']; ?>"><?php //echo $vflist['lead_name']; ?></option>
                                                      <?php //}?>
                                                   </select> -->
                                                   <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $contact_book_details->lead_name;?>" readonly>
                                                   <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead_details->lead_id;?>">
                                                   <span class="text-danger" id="lead_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Organization Name</label>

                                                   <input type="text" id="organization_name" name="organization_name" class="form-control" value="<?php echo $contact_book_details->company_name;?>" readonly>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group m-form__group">
                                                   <label>Country</label>
                                                   <input type="text" id="country" name="country" class="form-control" value="<?php echo $contact_book_details->country_name;?>" readonly>
                                                   <span class="text-danger"></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group m-form__group"> <label>Address</label>
                                                   <textarea class="form-control" cols="40" id="address" name="address" rows="2" readonly><?php echo $contact_book_details->address;?></textarea>
                                                </div>
                                             </div>

                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Email ID</label>

                                                   <input type="text" id="email_id" name="email_id" class="form-control" value="<?php echo $contact_book_details->email_id;?>" readonly>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Phone No</label>

                                                   <input type="text" id="phone_no" name="phone_no" class="form-control" value="<?php echo $contact_book_details->contact_no;?>" readonly>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Mobile No</label>

                                                   <input type="text" id="mobile_no" name="mobile_no" class="form-control"  readonly>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Assigned To</label>

                                                   <input type="text" id="assigned_to" name="assigned_to" class="form-control" value="<?php echo $lead_list->lead_assigned_name;?>" readonly>
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="row">
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Vessel / Flight<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="vessel_flight_id" name="vessel_flight_id" data-live-search="true" onchange="getFromPort(this.value);"> 
                                                      <option value=''>Choose</option> 
                                                      <?php foreach ($vessel_flight_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['vessel_flight_id']; ?>"><?php echo $vflist['vessel_flight_name']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="vessel_flight_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>From Port<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="from_port" name="from_port" data-live-search="true"> 
                                                      <option value="">Choose Port</option> 
                                                   </select>
                                                   <span class="text-danger" id="from_port_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>To Port<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="to_port" name="to_port" data-live-search="true"> 
                                                      <option value=''>Choose Port</option> 
                                                      <?php foreach ($port_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['port_id']; ?>"><?php echo $vflist['port_name']; ?> - <?php echo $vflist['port_city']; ?> - <?php echo $vflist['port_country']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="to_port_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Price Terms<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="price_term_id" name="price_term_id" data-live-search="true"> 
                                                      <option value="">Choose Price Terms</option>  
                                                      <?php foreach ($price_term_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['price_term_id']; ?>"><?php echo $vflist['price_term_name']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <span class="text-danger" id="price_term_id_err"></span>
                                                </div>
                                             </div>
                                          </div>
                                       </fieldset>
                                       <!--end: Form Wizard Step 1-->
                                       <!--begin: Form Wizard Step 2-->
                                       <fieldset>
                                          
                                          <legend><b>Item Details</b></legend>
                                          <div class="row">
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Currency<span class="text-danger">*</span></label>
                                                   <select class="form-control m-bootstrap-select m_selectpicker" id="currency_id" name="currency_id" data-live-search="true" onchange="getCurrencyCode(this.value);"> 
                                                      <option value="">Choose Currency</option>  
                                                      <?php foreach ($currency_list as $vflist) {
                                                         if($vflist['status']==0){ ?>
                                                         <option value="<?php echo $vflist['currency_id']; ?>"><?php echo $vflist['currency_name']; ?> - <?php echo $vflist['currency_code']; ?></option>
                                                      <?php }}?>
                                                   </select>
                                                   <input type="hidden" id="curcode">
                                                   <span class="text-danger" id="currency_id_err"></span>
                                                </div>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Rate<span class="text-danger">*</span></label>
                                                   <input type="text" class="form-control" id="rate" name="ratec" placeholder="Enter Rate" value="<?php echo $curval;?>">
                                                   <span class="text-danger" id="rate_err"></span>
                                                </div>
                                             </div>
                                             
                                          </div>
                                          <div id="mcontent10">
                                             <fieldset id="mid0">
                                                <legend>
                                                </legend>
                                                   <div class="row">

                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Vendor Name<span class="text-danger">*</span></label>
                                                            <select class="form-control m-bootstrap-select m_selectpicker" id="vendor_id0" name="vendor_id[]" data-live-search="true"> 
                                                               <?php $venoption = '<option value="">Select Vendor</option>';?>
                                                               <option value="">Select Vendor</option>
                                                               <?php foreach ($vendor_list as $value) { ?>
                                                                  <option value="<?php echo $value['vendor_id']; ?>"><?php echo $value['vendor_name'];?></option>
                                                                  <?php $venoption.='<option value="'.$value['vendor_id'].'">'.$value['vendor_name'].'</option>';
                                                               } ?>
                                                            </select>
                                                            <span class="text-danger" id="vendor_id_err0"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Mark & No<span class="text-danger">*</span></label>
                                                            <input type="text" id="marks_and_no0" name="marks_and_no[]" class="form-control" placeholder="Enter Mark & No">
                                                            <span class="text-danger" id="marks_and_no_err0"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Item Name<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="pname0" name="pname[]" value="<?php echo $product_item->product_name.' - '.$product_item->product_item;?>" readonly>
                                                            <!-- <input type="text" class="form-control" id="pname0" name="pname[]" value="<?php //echo $dispname->display_name;?>" readonly> -->
                                                            <input type="hidden" id="product_item_id0" name="product_item_id[]" value="<?php echo $product_item->product_item_id;?>">
                                                            <span class="text-danger" id="product_item_id_err0"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Display Name</label>
                                                            <input type="text" class="form-control" id="pname0" name="pname[]" value="<?php echo $dispname->display_name;?>" readonly>
                                                            <input type="hidden" id="product_item_display_name_id0" name="product_item_display_name_id[]" value="<?php echo $dispname->product_item_display_name_id;?>">
                                                            <span class="text-danger" id="product_item_display_name_id_err0"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Specification<span class="text-danger">*</span></label>
                                                            <!-- <input type="text" id="specification0" name="specification[]" class="form-control" placeholder="Specification" value="<?php //echo $product_item->product_item_spec;?>" readonly> -->
                                                            <textarea class="form-control snote" id="specification0" name="specification[]" rows="3"><?php echo $product_item->product_item_spec;?></textarea>
                                                            <span class="text-danger" id="specification_err0"></span>
                                                         </div>
                                                      </div>
                                                      
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Unit<span class="text-danger">*</span></label>
                                                            <select class="form-control m-bootstrap-select m_selectpicker" id="sku_unit_id0" name="sku_unit_id[]" data-live-search="true"> 
                                                               <option value=''>Choose Unit</option> 
                                                               <?php foreach($product_unit as $punit){?>
                                                                  <option value="<?php echo $punit['product_unit_id'];?>" <?php echo $punit['product_unit_id'] == $prodstage[$stage_id]['stage_name']?'selected':'';?>><?php echo $punit['product_unit'];?></option>
                                                               <?php }?>
                                                            </select>
                                                            <span class="text-danger" id="sku_unit_id_err0"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Quantity<span class="text-danger">*</span></label>
                                                            <input type="text" id="quantity0" name="quantity[]" class="form-control" placeholder="Enter Quantity" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getAmount(0);">
                                                            <span class="text-danger" id="quantity_err0"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Rate in <span class="ccode"></span><span class="text-danger">*</span></label>
                                                            <input type="text" id="rate0" name="rate[]" class="form-control" placeholder="Enter Rate" value="<?php echo $fobval;?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getAmount(0);">
                                                            <span class="text-danger" id="rate_err0"></span>
                                                         </div>
                                                      </div>
                                                      
                                                      <div class="col-lg-2" <?php echo $quote_type==0?"style=display:none;":'';?>>
                                                         <div class="form-group m-form__group">
                                                            <label>Tax Type<span class="text-danger">*</span></label>
                                                            <select class="form-control m-bootstrap-select m_selectpicker" id="tax_type0" name="tax_type[]" data-live-search="true" onchange="getAmount(0);"> 
                                                               <option value='0'>CGST/SGST</option>
                                                               <option value='1'>IGST</option>
                                                            </select>
                                                            <span class="text-danger" id="tax_type_err0"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-2" <?php echo $quote_type==0?"style=display:none;":'';?>>
                                                         <div class="form-group m-form__group">
                                                            <label>Tax %<span class="text-danger">*</span></label>
                                                            <input type="text" id="tax_percent0" name="tax_percent[]" class="form-control" placeholder="Enter Tax %" value="0" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getAmount(0);">
                                                            <span class="text-danger" id="tax_percent_err0"></span>
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-2">
                                                         <div class="form-group m-form__group">
                                                            <label>Amount in <span class="ccode"></span><span class="text-danger">*</span></label>
                                                            <input type="text" id="amount0" name="amount[]" class="form-control" readonly value=0>
                                                            <span class="text-danger" id="amount_err0"></span>
                                                         </div>
                                                      </div>
                                                      
                                                      
                                                   </div>
                                             </fieldset>
                                          </div>

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
                                          <input type="hidden" id="mailcount" name="mailcount" value="1">

                                          <div class="row mt_25px">
                                             <div class="col-lg-9">
                                                <label>Amount Chargeable in <span class="ccode"></span></label>
                                                <h5 class="text-theme"><span id="amwords"></span></h5>
                                             </div>
                                             <div class="col-lg-3">
                                                <div class="form-group m-form__group">
                                                   <label>Total</label>

                                                   <input type="text" id="grand_total" name="grand_total" class="form-control" readonly value=0>
                                                </div>
                                             </div>
                                          </div>
                                       
                                       </fieldset>
                                       <!--end: Form Wizard Step 2-->
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

   var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Create Quote';
   $(document).attr("title", title);

$('.snote').summernote();



function changeStage(val)
{
   if(val!='')
   {
      if(val=='fob')
      {
         $('#fobstage').show();
         $('#cnfstage').hide();
         $('#stage_id').val('');
         $('#fob_stage_id').val('');
      }
      else
      {
         $('#cnfstage').show();
         $('#fobstage').hide();
         $('#fob_stage_id').val('');
         $('#stage_id').val('');
      }
   }
   else
   {
      $('#cnfstage').hide();
      $('#fobstage').hide();
      $('#fob_stage_id').val('');
      $('#stage_id').val('');
   }

   $('.m_selectpicker').selectpicker('refresh');

   var i=0;
   $('#rate'+i).val(0);
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

      $('#grand_total').val(totamt.toFixed('2'));
      $('#amwords').html(withDecimal(totamt.toFixed('2')));
}


function getProd_Cost_Value(val)
{
   var i=0;
   if(val!='')
   {
      var stype = $('#stage_type').val();
      if(stype=='cnf')
      {
         var fobusdval = $('#fobusdval').val();
         var fobusdvalsplit = fobusdval.split(',');
         $('#rate'+i).val(fobusdvalsplit[val]);
      }
      else
      {
         var fobarrval = $('#fobarrval').val();
         var fobvalsplit = fobarrval.split(',');
         $('#rate'+i).val(fobvalsplit[val]);
      }
   }
   else
   {
      $('#rate'+i).val(0);
   }
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

      $('#grand_total').val(totamt.toFixed('2'));
      $('#amwords').html(withDecimal(totamt.toFixed('2')));
}

function changeProductCostingValue(val)
{
   $.ajax({
   type: "POST",
   url: baseurl+'productcosting/change_quote_product_costing',
   async: false,
   type: "POST",
   data: "id="+val,
   dataType: "html",
   success: function(response)
   {
      $('#pcview').empty().append(response);
      $('#fobstage').hide();
      $('#cnfstage').hide();
      $('#stage_id').val('');
      $('#fob_stage_id').val('');
      $('#stage_type').val('');
      $('.m_selectpicker').selectpicker('refresh');

      var cscount = $('#cscount').val();
      var fobval=[];
      var fobusdval=[];
      for(var i=0;i<cscount;i++)
      {
         fobval.push($('#stagetot2'+i).val());
         fobusdval.push($('#stagetot3'+i).val()); 
      }

      var curval = $('#input30').html();
      //var pcid = $('#product_costing_id').val();
      $.ajax({
         type: "POST",
         url: baseurl+'productcosting/product_costing_change',
         async: false,
         type: "POST",
         data: "id="+val+"&fobusdval="+fobusdval+"&curval="+curval+"&fobval="+fobval,
         dataType: "html",
         success: function(response)
         {
            var respsplit = response.split("|");
            $('#stage_id').html(respsplit[1]);
            $('#fob_stage_id').html(respsplit[2]);
            $('#rate').val(respsplit[0]);
            $('#fobusdval').val(respsplit[3]);
            $('#fobarrval').val(respsplit[4]);

            var i=0;
            $('#rate'+i).val(0);
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

               $('#grand_total').val(totamt.toFixed('2'));
               $('#amwords').html(withDecimal(totamt.toFixed('2')));
         }
      });

   }
   });
}

function createdate_change_to_commondate()
{
   var date_picker_val = $('#alter_created_date').val();
   $('#created_date').val(date_picker_val);
   $.ajax({
        url:baseurl+'Leads/change_dtrange_val',
        type:'POST',
        data:{'value':date_picker_val},
        dataType: 'html',
        success:function(result){
           $('#alter_created_date').val(result);
        }
     });
}
function validtill_change_to_commondate()
{
   var date_picker_val = $('#alter_valid_till').val();
   $('#valid_till').val(date_picker_val);
   $.ajax({
        url:baseurl+'Leads/change_dtrange_val',
        type:'POST',
        data:{'value':date_picker_val},
        dataType: 'html',
        success:function(result){
           $('#alter_valid_till').val(result);
        }
     });
}

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

   $('#grand_total').val(totamt.toFixed('2'));
   $('#amwords').html(withDecimal(totamt.toFixed('2')));
}

function getCurrencyCode(val)
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
   }
   else
   {      
      $('.ccode').html('');
      $('#curcode').val('');
   }
}


function getExporterLogo(val)
{
   if(val!='')
   {
      $.ajax({
        type: "POST",
        url: baseurl+'quote/getExporterLogo',
        async: false,
        type: "POST",
        data: "id="+val,
        dataType: "html",
        success: function(response)
        {
           //$('#vendor_delete').empty().append(response);
           document.getElementById("exporter_logo").src = baseurl+response;
        }
      });
   }
   else
   {
      document.getElementById("exporter_logo").src = baseurl+'assets/demo/demo12/media/img/logo/logo_def.png';
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
          $('#from_port').empty().html(response).selectpicker('refresh');
        }
      });
   }
   else
   {      
      $('#from_port').empty().html('<option vaue="">Choose Port</option>').selectpicker('refresh');
   }
}




function quote_validation()
{
   var err = 0;
   var pcid = $('#prod_costing_id').val();
   var expoid = $('#exporter_id').val();
   var sub = $('#subject').val();
   var cdate = $('#created_date').val();
   var vtill = $('#valid_till').val();
   var qstate = $('#quote_stage_id').val();
   var pvalid = $('#price_validity').val();
   var cname = $('#lead_id').val();
   var vfid = $('#vessel_flight_id').val();
   var fport = $('#from_port').val();
   var tport = $('#to_port').val();
   var pterm = $('#price_term_id').val();   
   var curr = $('#currency_id').val();
   var rat = $('#rate').val();
   var stype = $('#stage_type').val();

   if(pcid=='')
   {
      $('#prod_costing_id_err').html('Choose Product Costing!');
      err++;
   }
   else
   {
      $('#prod_costing_id_err').html('');
   }

   if(stype=='')
   {
      $('#stage_type_err').html('Choose Stage Type!');
      err++;
   }
   else
   {
      if(stype=='fob')
      {
         var fobstgid = $('#fob_stage_id').val();
         if(stype=='')
         {
            $('#fob_stage_id_err').html('Choose Stage!');
            err++;
         }
         else
         {
            $('#fob_stage_id_err').html('');
         }
      }
      else
      {
         var stgid = $('#stage_id').val();
         if(stype=='')
         {
            $('#stage_id_err').html('Choose Stage!');
            err++;
         }
         else
         {
            $('#stage_id_err').html('');
         }         
      }
      $('#stage_type_err').html('');
   }

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

   if(cdate=='')
   {
      $('#created_date_err').html('Created Date is required!');
      err++;
   }
   else
   {
      $('#created_date_err').html('');
   }

   if(vtill=='')
   {
      $('#valid_till_err').html('Valid Till is required!');
      err++;
   }
   else
   {
      $('#valid_till_err').html('');
   }

   if(qstate=='')
   {
      $('#quote_stage_id_err').html('Choose Quote Stage!');
      err++;
   }
   else
   {
      $('#quote_stage_id_err').html('');
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

   if(cname=='')
   {
      $('#lead_id_err').html('Choose Contact Name!');
      err++;
   }
   else
   {
      $('#lead_id_err').html('');
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

   if(fport=='')
   {
      $('#from_port_err').html('Choose From Port!');
      err++;
   }
   else
   {
      $('#from_port_err').html('');
   }

   if(tport=='')
   {
      $('#to_port_err').html('Choose To Port!');
      err++;
   }
   else
   {
      $('#to_port_err').html('');
   }

   if(pterm=='')
   {
      $('#price_term_id_err').html('Choose Price Term!');
      err++;
   }
   else
   {
      $('#price_term_id_err').html('');
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

   var bav=0
$("fieldset[id^='mid']").each(function(){
  var id = this.id;
  var res = id.substring(3);
  var venid=$('#vendor_id'+res).val();
  var markno=$('#marks_and_no'+res).val();
  var pitem=$('#product_item_id'+res).val();
  var qty=$('#quantity'+res).val();
  var rate=$('#rate'+res).val();
  var uid = $('#sku_unit_id'+res).val();

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

     if(uid==''){
       $('#sku_unit_id_err'+res).html('Choose Unit!');
       err++;
     }else{
       $('#sku_unit_id_err'+res).html('');
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

     if(venid!='' && uid==''){
       $('#sku_unit_id_err'+res).html('Choose Unit!');
       err++;
     }else{
       $('#sku_unit_id_err'+res).html('');
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
     
   }
   bav++;
});
   
   if(err> 0){ return false;}else{ return true; }   
}
</script>




   </body>

   <!-- end::Body -->
</html>