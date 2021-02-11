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
                                       Buyer Order Followup Sheet
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
                           <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>buyerorder/buyerorder_followup">
                              <input type="hidden" id="buyer_order_id" name="buyer_order_id" value="<?php echo $buyer_order_list->buyer_order_id;?>">
                           <div class="m-portlet__body">
                              <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
                                 <thead>
                                    <tr>
                                       <th width="20%">Category</th>
                                       <th width="25%">Inputs</th>
                                       <th width="25%">Remarks</th>
                                       <th width="20%">Status</th>
                                       <th width="10%"></th>
                                    </tr>
                                 </thead>
                                 <tbody id="mcontent10">
                                    <tr id="mid0">
                                       <td>
                                          <p>DOCUMENT NO</p>
                                          <input type="hidden" name="automatic_field[]" id="automatic_field0" class="form-control" placeholder="Enter Stage Name" value="DOCUMENT NO" readonly>
                                          <input type="hidden" name="followup_sheet_category_id[]" id="followup_sheet_category_id0" class="form-control">
                                       </td>
                                       <td>
                                          <p><?php echo $buyer_order_list->buyer_order_invoice_no;?></p>
                                          <input type="hidden" name="inputt_field[]" id="inputt_field0" class="form-control" placeholder="" value="<?php echo $buyer_order_list->buyer_order_invoice_no;?>" readonly>
                                          <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                       </td>
                                       <td>
                                          <!-- <textarea name="remarks[]" id="remarks0" class="form-control"></textarea> -->
                                          <input type="text" name="remarks[]" id="remarks0" class="form-control">
                                       </td>
                                       <td>
                                          <select class="form-control m_selectpicker" id="followup_sheet_stage_id0" name="followup_sheet_stage_id[]">
                                             <?php foreach($followup_stage as $fustage){?>
                                                <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td></td>
                                    </tr>

                                    <tr id="mid1">
                                       <td>
                                          <p>Buyer Name</p>
                                          <input type="hidden" name="automatic_field[]" id="automatic_field1" class="form-control" placeholder="Enter Stage Name" value="Buyer Name" readonly>
                                          <input type="hidden" name="followup_sheet_category_id[]" id="followup_sheet_category_id1" class="form-control">
                                       </td>
                                       <td>
                                          <p><?php echo $buyer_order_list->lead_name;?></p>
                                          <input type="hidden" name="inputt_field[]" id="inputt_field1" class="form-control" placeholder="" value="<?php echo $buyer_order_list->lead_name;?>" readonly>
                                          
                                          <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                       </td>
                                       <td>
                                          <!-- <textarea name="remarks[]" id="remarks1" class="form-control"></textarea> -->
                                          <input type="text" name="remarks[]" id="remarks1" class="form-control">
                                       </td>
                                       <td>
                                          <select class="form-control m_selectpicker" id="followup_sheet_stage_id1" name="followup_sheet_stage_id[]">
                                             <?php foreach($followup_stage as $fustage){?>
                                                <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td></td>
                                    </tr>

                                    <tr id="mid2">
                                       <td>
                                          <p>PORT OF LOADING</p>
                                          <input type="hidden" name="automatic_field[]" id="automatic_field2" class="form-control" placeholder="Enter Stage Name" value="PORT OF LOADING" readonly>
                                          <input type="hidden" name="followup_sheet_category_id[]" id="followup_sheet_category_id2" class="form-control">
                                       </td>
                                       <td>
                                          <p><?php echo $buyer_order_list->polname.' - '.$buyer_order_list->polcity.' - '.$buyer_order_list->polcountry;?></p>
                                          <input type="hidden" name="inputt_field[]" id="inputt_field2" class="form-control" placeholder="" value="<?php echo $buyer_order_list->polname.' - '.$buyer_order_list->polcity.' - '.$buyer_order_list->polcountry;?>" readonly>                                          
                                          <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                       </td>
                                       <td>
                                          <!-- <textarea name="remarks[]" id="remarks2" class="form-control"></textarea> -->
                                          <input type="text" name="remarks[]" id="remarks2" class="form-control">   
                                       </td>
                                       <td>
                                          <select class="form-control m_selectpicker" id="followup_sheet_stage_id2" name="followup_sheet_stage_id[]">
                                             <?php foreach($followup_stage as $fustage){?>
                                                <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td></td>
                                    </tr>

                                    <tr id="mid3">
                                       <td>
                                          <p>SEA / AIRPORT - COUNTRY</p>
                                          <input type="hidden" name="automatic_field[]" id="automatic_field3" class="form-control" placeholder="Enter Stage Name" value="SEA / AIRPORT - COUNTRY" readonly>
                                          <input type="hidden" name="followup_sheet_category_id[]" id="followup_sheet_category_id3" class="form-control">
                                       </td>
                                       <td>
                                          <p><?php echo $buyer_order_list->fdname.' - '.$buyer_order_list->fdcity.' - '.$buyer_order_list->fdcountry;?></p>
                                          <input type="hidden" name="inputt_field[]" id="inputt_field3" class="form-control" placeholder="" value="<?php echo $buyer_order_list->fdname.' - '.$buyer_order_list->fdcity.' - '.$buyer_order_list->fdcountry;?>" readonly>
                                          
                                          <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                       </td>
                                       <td>
                                          <!-- <textarea name="remarks[]" id="remarks3" class="form-control"></textarea> -->
                                          <input type="text" name="remarks[]" id="remarks3" class="form-control">
                                       </td>
                                       <td>
                                          <select class="form-control m_selectpicker" id="followup_sheet_stage_id3" name="followup_sheet_stage_id[]">
                                             <?php foreach($followup_stage as $fustage){?>
                                                <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td></td>
                                    </tr>

                                    <tr id="mid4">
                                       <td>
                                          <p>PROFORMA INVOICE</p>
                                          <input type="hidden" name="automatic_field[]" id="automatic_field4" class="form-control" placeholder="Enter Stage Name" value="PROFORMA INVOICE" readonly>
                                          <input type="hidden" name="followup_sheet_category_id[]" id="followup_sheet_category_id4" class="form-control">
                                       </td>
                                       <td>
                                          <p><?php echo $buyer_order_list->proforma_invoice_no;?></p>
                                          <input type="hidden" name="inputt_field[]" id="inputt_field4" class="form-control" placeholder="" value="<?php echo $buyer_order_list->proforma_invoice_no;?>" readonly>
                                          
                                          <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                       </td>
                                       <td>
                                          <!-- <textarea name="remarks[]" id="remarks4" class="form-control"></textarea> -->
                                          <input type="text" name="remarks[]" id="remarks4" class="form-control">
                                       </td>
                                       <td>
                                          <select class="form-control m_selectpicker" id="followup_sheet_stage_id4" name="followup_sheet_stage_id[]">
                                             <?php foreach($followup_stage as $fustage){?>
                                                <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td></td>
                                    </tr>

                                    <tr id="mid5">
                                       <td>
                                          <p>OUR PURCHASE ORDER NO</p>
                                          <input type="hidden" name="automatic_field[]" id="automatic_field5" class="form-control" placeholder="Enter Stage Name" value="OUR PURCHASE ORDER NO" readonly>
                                          <input type="hidden" name="followup_sheet_category_id[]" id="followup_sheet_category_id5" class="form-control">
                                       </td>
                                       <td>
                                          <p><?php echo $spono;?></p>
                                          <input type="hidden" name="inputt_field[]" id="inputt_field5" class="form-control" placeholder="" value="<?php echo $spono;?>" readonly>
                                          
                                          <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                       </td>
                                       <td>
                                          <!-- <textarea name="remarks[]" id="remarks5" class="form-control"></textarea> -->
                                          <input type="text" name="remarks[]" id="remarks5" class="form-control">
                                       </td>
                                       <td>
                                          <select class="form-control m_selectpicker" id="followup_sheet_stage_id5" name="followup_sheet_stage_id[]">
                                             <?php foreach($followup_stage as $fustage){?>
                                                <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td></td>
                                    </tr>

                                    <tr id="mid6">
                                       <td>
                                          <p>SUPPLIER</p>
                                          <input type="hidden" name="automatic_field[]" id="automatic_field6" class="form-control" placeholder="Enter Stage Name" value="SUPPLIER" readonly>
                                          <input type="hidden" name="followup_sheet_category_id[]" id="followup_sheet_category_id6" class="form-control">
                                       </td>
                                       <td>
                                          <p><?php echo $supli;?></p>
                                          <input type="hidden" name="inputt_field[]" id="inputt_field6" class="form-control" placeholder="" value="<?php echo $supli;?>" readonly>
                                          
                                          <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                       </td>
                                       <td>
                                          <!-- <textarea name="remarks[]" id="remarks6" class="form-control"></textarea> -->
                                          <input type="text" name="remarks[]" id="remarks6" class="form-control">
                                       </td>
                                       <td>
                                          <select class="form-control m_selectpicker" id="followup_sheet_stage_id6" name="followup_sheet_stage_id[]">
                                             <?php foreach($followup_stage as $fustage){?>
                                                <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td></td>
                                    </tr>

                                    <tr id="mid7">
                                       <td>
                                          <p>PAYMENT TERMS</p>
                                          <input type="hidden" name="automatic_field[]" id="automatic_field7" class="form-control" placeholder="Enter Stage Name" value="PAYMENT TERMS" readonly>
                                          <input type="hidden" name="followup_sheet_category_id[]" id="followup_sheet_category_id7" class="form-control">
                                       </td>
                                       <td>
                                          <p><?php echo $buyer_order_list->terms_of_payment_type_id==1?'Advance':'LC';?></p>
                                          <input type="hidden" name="inputt_field[]" id="inputt_field7" class="form-control" placeholder="" value="<?php echo $buyer_order_list->terms_of_payment_type_id==1?'Advance':'LC';?>" readonly>
                                          
                                          <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                       </td>
                                       <td>
                                          <!-- <textarea name="remarks[]" id="remarks7" class="form-control"></textarea> -->
                                          <input type="text" name="remarks[]" id="remarks7" class="form-control">
                                       </td>
                                       <td>
                                          <select class="form-control m_selectpicker" id="followup_sheet_stage_id7" name="followup_sheet_stage_id[]">
                                             <?php foreach($followup_stage as $fustage){?>
                                                <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td></td>
                                    </tr>

                                    <?php $i=8; foreach($followup_default_category as $fudcat){?>
                                       <tr id="mid<?php echo $i;?>">
                                          <td>
                                             <p><?php echo $fudcat['followup_sheet_category'];?></p>
                                             <input type="hidden" name="automatic_field[]" id="automatic_field<?php echo $i;?>" class="form-control" value="">
                                             <input type="hidden" name="followup_sheet_category[]" id="followup_sheet_category<?php echo $i;?>" class="form-control" value="<?php echo $fudcat['followup_sheet_category'];?>">
                                             <input type="hidden" name="followup_sheet_category_id[]" id="followup_sheet_category_id<?php echo $i;?>" class="form-control" value="<?php echo $fudcat['followup_sheet_category_id'];?>">
                                          </td>
                                             <?php if($fudcat['input_type']==0){?>
                                             <td>
                                                <input type="text" name="inputt_field[]" id="inputt_field<?php echo $i;?>" class="form-control" placeholder="" value="">
                                             
                                                <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                             </td>
                                             <?php }else{?>
                                             <td>
                                                <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                                   <input type="checkbox" class="menu_checkbox" id="input_field<?php echo $i;?>" name="input_field[]" value="0" onchange="changePermissionCheck(this.id,this.value);"> Yes / No
                                                   <input type="hidden" class="menu_checkbox_hidden" id="input_field<?php echo $i;?>hidden" name="input_field[]" value=0>
                                             
                                                   <input type="hidden" name="inputt_field[]" id="inputt_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly>
                                                   <span></span>
                                                </label>
                                             </td>
                                             <?php }?>
                                          <td>
                                             <!-- <textarea name="remarks[]" id="remarks<?php //echo $i;?>" class="form-control"></textarea> -->
                                             <input type="text" name="remarks[]" id="remarks<?php echo $i;?>" class="form-control">
                                          </td>
                                          <td>
                                             <select class="form-control m_selectpicker" id="followup_sheet_stage_id<?php echo $i;?>" name="followup_sheet_stage_id[]">
                                                <?php foreach($followup_stage as $fustage){?>
                                                   <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                                <?php }?>
                                             </select>
                                          </td>
                                          <td></td>
                                       </tr>
                                    <?php $i++;}?>

                                    <tr id="mid<?php echo $i;?>">
                                       <td>
                                          <input type="hidden" name="automatic_field[]" id="automatic_field<?php echo $i;?>" class="form-control" value="">
                                          <select name="followup_sheet_category_id[]" id="followup_sheet_category_id<?php echo $i;?>" class="form-control" onchange="getCategoryInputType(this.value,<?php echo $i;?>);">
                                             <option value="">Select Category</option>
                                             <?php 
                                                $fupcat = '<option value="">Select Category</option>';
                                                ?>
                                             <?php foreach($followup_other_category as $fuocat){?>
                                                <option value="<?php echo $fuocat['followup_sheet_category_id'];?>"><?php echo $fuocat['followup_sheet_category'];?></option>
                                             <?php 
                                             $fupcat.='<option value="'.$fuocat['followup_sheet_category_id'].'">'.$fuocat['followup_sheet_category'].'</option>';
                                          }?>
                                          </select>
                                       </td>
                                       <td id="inptext<?php echo $i;?>">
                                          <input type="text" name="inputt_field[]" id="inputt_field<?php echo $i;?>" class="form-control" placeholder="" value="">
                                          
                                          <!-- <input type="hidden" name="input_field[]" id="input_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly> -->
                                       </td>
                                       <td id="inpcheck<?php echo $i;?>" style="display:none;">
                                          <label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px">
                                             <input type="checkbox" class="menu_checkbox" id="input_field<?php echo $i;?>" name="input_field[]" value="0" onchange="changePermissionCheck(this.id,this.value);"> Yes / No
                                             <input type="hidden" class="menu_checkbox_hidden" id="input_field<?php echo $i;?>hidden" name="input_field[]" value=0>
                                          
                                             <!-- <input type="hidden" name="inputt_field[]" id="inputt_field<?php echo $i;?>" class="form-control" placeholder="" value="" readonly> -->
                                             <span></span>
                                          </label>
                                       </td>
                                       <td>
                                          <!-- <textarea name="remarks[]" id="remarks<?php //echo $i;?>" class="form-control"></textarea> -->
                                          <input type="text" name="remarks[]" id="remarks<?php echo $i;?>" class="form-control">
                                       </td>
                                       <td>
                                          <select class="form-control m_selectpicker" id="followup_sheet_stage_id<?php echo $i;?>" name="followup_sheet_stage_id[]">
                                             <?php $sts=''; foreach($followup_stage as $fustage){?>
                                                <option value="<?php echo $fustage['followup_sheet_stage_id'];?>"><?php echo $fustage['followup_sheet_stage'];?></option>
                                             <?php $sts.='<option value="'.$fustage['followup_sheet_stage_id'].'">'.$fustage['followup_sheet_stage'].'</option>';}?>
                                          </select>
                                       </td>
                                       <td></td>
                                    </tr>

                                 </tbody>
                              </table>

                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group m-form__group">
                                          <div class="pull-right">
                                             <button type="button" class="btn btn-primary" onclick="add_pcs_type(<?php echo $i;?>)">
                                                <i class="fa fa-plus"></i>
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <input type="hidden" id="mailcount" name="mailcount" value="<?php echo $i+1;?>">
            
                              
                           </div>
                                    
                           <div class="m-portlet__foot">
                              <div class="row align-items-center">
                                 <div class="col-lg-12 m--align-right">
                                    <button type="submit" id="add_wl_btn" class="btn btn-primary">Save</button>
                                 </div>
                              </div>
                           </div>
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

         <!-- end::Footer -->
      </div>

      <!-- end:: Page -->




<script type="text/javascript">

var baseurl = '<?php echo base_url(); ?>';
   var title = $('title').text() + ' | ' + 'Buyer Order Followup Sheet';
   $(document).attr("title", title);
$('.m_selectpicker').selectpicker();

function add_pcs_type()
{
   var count=$('#mailcount').val();
   var cont = $("#mcontent10");
    var fupcat = '<?php echo $fupcat;?>';
    var sts = '<?php echo $sts;?>';
    
    cont.append('<tr id="mid'+count+'"><td><input type="hidden" name="automatic_field[]" id="automatic_field'+count+'" class="form-control" value=""><select name="followup_sheet_category_id[]" id="followup_sheet_category_id'+count+'" class="form-control" onchange="getCategoryInputType(this.value,'+count+');">'+fupcat+'</select></td><td id="inptext'+count+'"><input type="text" name="inputt_field[]" id="inputt_field'+count+'" class="form-control" placeholder="" value=""></td><td id="inpcheck'+count+'" style="display:none;"><label class="m-checkbox m-checkbox--bold m-checkbox--state-success mt_25px"><input type="checkbox" class="menu_checkbox" id="input_field'+count+'" name="input_field[]" value="0" onchange="changePermissionCheck(this.id,this.value);"> Yes / No<input type="hidden" class="menu_checkbox_hidden" id="input_field'+count+'hidden" name="input_field[]" value=0><span></span></label></td><td><input type="text" name="remarks[]" id="remarks'+count+'" class="form-control"></td><td><select class="form-control m_selectpicker" id="followup_sheet_stage_id'+count+'" name="followup_sheet_stage_id[]">'+sts+'</select></td><td><button class="btn btn-danger" onclick="remove_pc_type('+count+')"><i class="fa fa-minus"></i></button></td></tr>');

    count=Number(count)+1;
    $('#mailcount').val(count);
    $('.m_selectpicker').selectpicker();
}

function remove_pc_type(val)
{
   $('#mid'+val).remove();

}

function getCategoryInputType(val,i)
{
   if(val!='')
   {
      var alreadyprod=0;
      $('select[id^="followup_sheet_category_id"]').each(function(){
       var id = this.id;
       var res = id.substring(26);
       var prodval = $("#followup_sheet_category_id"+res).val();
       if(i!=res && val == prodval)
               {
                   alreadyprod++;
               }
       });

       if(alreadyprod>0)
       {
         $("#followup_sheet_category_id"+i).val('');
         alert("Category Already Selected");
      }
      else
      {
         $.ajax({
            type: "POST",
            url: baseurl+'buyerorder/getCategoryInputType',
            async: false,
            data: "val="+val,
            dataType: "html",
            success: function(response)
            {
               if(response==0)
               {
                  $('#inptext'+i).show();
                  $('#inpcheck'+i).hide();
               }
               else
               {
                  $('#inptext'+i).hide();
                  $('#inpcheck'+i).show();
               }
            }
           });
      }
   }
   else
   {
      $('#inptext'+i).show();
       $('#inpcheck'+i).hide();
   }
}


function changePermissionCheck(id,val)
{
   if(val==1)
   {
      $('#'+id).val(0);
      document.getElementById(id+'hidden').disabled = false;
   }
   else
   {
      $('#'+id).val(1);
      document.getElementById(id+'hidden').disabled = true;
   }
}

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