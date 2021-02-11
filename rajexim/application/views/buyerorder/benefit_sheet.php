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
                                 <span class="m-nav__link-text">Benefit Sheet</span>
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
                                       Buyer Order Benefit Sheet
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
                           <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="POST" action="<?php echo base_url(); ?>buyerorder/buyerorder_benefit" onsubmit="return benefit_sheet_validation()">
                              <input type="hidden" id="buyer_order_id" name="buyer_order_id" value="<?php echo $buyer_order_list->buyer_order_id;?>">
                           <div class="m-portlet__body">
                              <table class="table table-bordered m-table m-table--border-theme m-table--head-bg-theme">
                                 <thead>
                                    <tr>
                                       <th width="10%">Date</th>
                                       <th width="35%">Particulars</th>
                                       <th width="15%">TT Receipt</th>
                                       <th width="15%">Pur Value</th>
                                       <th width="15%">Tot Pur Value</th>
                                       <th width="10%"></th>
                                    </tr>
                                 </thead>
                                 <tbody id="mcontent10">
                                    <?php if(count($buyer_order_benefit_details)>0){
                                 $i=0;foreach($buyer_order_benefit_details as $bobdetails){
                                    if($bobdetails['buyer_order_benefit_date']=='0000-00-00')
                                    {
                                       $bobdate = '';
                                       $bgcolor = '';
                                    }
                                    else
                                    {
                                       $vdate = explode('-', $bobdetails['buyer_order_benefit_date']);
                                       $bobdate = $vdate[1].'/'.$vdate[2].'/'.$vdate[0];
                                       $bgcolor = 'background-color:#f8f644;';
                                    }

                                    ?>
                                    <tr id="mid<?php echo $i;?>">
                                       <td>
                                          <input type="text" id="buyer_order_benefit_date<?php echo $i;?>" name="buyer_order_benefit_date[]" class="form-control m_datepicker_1" style="height:25px;" placeholder="Enter Date" value="<?php echo $bobdate;?>">
                                       </td>
                                       <td>
                                          <input type="text" id="particulars<?php echo $i;?>" name="particulars[]" class="form-control" placeholder="Enter Particulars" style="height:25px;" value="<?php echo $bobdetails['particulars'];?>">
                                                <span class="text-danger" id="particulars_err<?php echo $i;?>"></span>
                                       </td>
                                       <td>
                                          <input type="text" id="tt_receipt<?php echo $i;?>" name="tt_receipt[]" class="form-control" placeholder="Enter TT Receipt" style="float:left;width:85%;height:25px;<?php echo $bobdetails['tt_receipt']!=0?$bgcolor:'';?>" value="<?php echo $bobdetails['tt_receipt'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);changeTTValue(this.id);"><div id="isttval<?php echo $i;?>" style="float:right;width:10%;margin-left:5%;"><a href="javascript:;" id="togglerate<?php echo $i;?>" onclick="togglerate(this.id);"><i class="la la-money"></i></a></div>

                                          <div id="tograte<?php echo $i;?>" style="<?php echo ($bobdetails['cur_rate']==0 && $bobdetails['con_rate']==0)?'display:none':'display:block';?>;">
                                             <hr>
                                             <input type="text" id="cur_rate<?php echo $i;?>" name="cur_rate[]" class="form-control" placeholder="Currency" style="float:left;width:45%;height:25px;" value="<?php echo $bobdetails['cur_rate'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);">&nbsp;x&nbsp;
                                             <input type="text" id="con_rate<?php echo $i;?>" name="con_rate[]" class="form-control" placeholder="Conversion" style="float:right;width:45%;height:25px;" value="<?php echo $bobdetails['con_rate'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);">
                                          </div>
                                       </td>
                                       <td>
                                          <input type="text" id="pur_value<?php echo $i;?>" name="pur_value[]" class="form-control" placeholder="Enter Pur Value" style="float:left;width:85%;height:25px;<?php echo $bobdetails['pur_value']!=0?$bgcolor:'';?>" value="<?php echo $bobdetails['pur_value'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);">
                                          <div id="istot<?php echo $i;?>" style="float:right;width:10%;margin-left:5%;">
                                             <?php if($bobdetails['is_tot']==0){?>
                                             <a href="javascript:;" onclick="showtotpur(<?php echo $i;?>)"><i class="la la-money"></i></a>
                                             <?php }else if($bobdetails['is_tot']==1){

                                                   $chk=0;
                                                   $pval=0;
                                                   $tpurval=0;
                                                   for($tp=$i;$tp>=0;$tp--)
                                                   {
                                                      if($chk==0)
                                                      {
                                                         if($buyer_order_benefit_details[$tp]['total_pur_value']!=0)
                                                         {
                                                            $tpurval+=$buyer_order_benefit_details[$tp]['total_pur_value'];
                                                            $chk=1;
                                                         }
                                                         $pval+=$buyer_order_benefit_details[$tp]['pur_value'];
                                                      }
                                                   }
                                                   
                                                ?>
                                                <?php if($pval<$tpurval){?>
                                                   <a href="javascript:;" onclick="add_pcs_type_clone(<?php echo $i;?>)"><i class="fa fa-plus"></i></a>
                                                   <?php }?>
                                             <?php }else{?>
                                             <?php }?>
                                          </div>
                                          <input type="hidden" id="is_tot<?php echo $i;?>" name="is_tot[]" class="form-control" value="<?php echo $bobdetails['is_tot'];?>">
                                       </td>
                                       <td>
                                          <div id="tpval<?php echo $i;?>" style="<?php echo $bobdetails['total_pur_value']!=0?'display:block':'display:none';?>">
                                             <input type="text" id="total_pur_value<?php echo $i;?>" name="total_pur_value[]" class="form-control" placeholder="Enter Total Pur Value" style="height:25px;" value="<?php echo $bobdetails['total_pur_value'];?>" onfocus="this.select();" onkeypress="return isNumberKey(event,this);">
                                          </div>
                                       </td>
                                       <?php if($i!=0){?>
                                          <?php if($i==count($buyer_order_benefit_details)-1){?>
                                          <td>
                                             <button class="btn btn-danger" onclick="remove_pc_type(<?php echo $i;?>)"  id="removebtn<?php echo $i;?>"><i class="fa fa-minus"></i></button>
                                          </td>
                                          <?php }else{?>
                                          <td>
                                             <button class="btn btn-danger" onclick="remove_pc_type(<?php echo $i;?>)"  id="removebtn<?php echo $i;?>" style="display: none;"><i class="fa fa-minus"></i></button>
                                          </td>
                                          <?php }?>
                                       <?php }else{?>
                                          <td></td>
                                       <?php }?>
                                    </tr>
                                 <?php $i++;}}else{?>
                                    <tr id="mid0">
                                       <td>
                                          <input type="text" id="buyer_order_benefit_date0" name="buyer_order_benefit_date[]" class="form-control m_datepicker_1" style="height:25px;" placeholder="Enter Date">
                                       </td>
                                       <td>
                                          <input type="text" id="particulars0" name="particulars[]" class="form-control" style="height:25px;" placeholder="Enter Particulars">
                                          <span class="text-danger" id="particulars_err0"></span>
                                       </td>
                                       <td>
                                          <input type="text" id="tt_receipt0" name="tt_receipt[]" class="form-control" placeholder="Enter TT Receipt" style="float:left;width:85%;height:25px;" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);changeTTValue(this.id);"><div id="isttval0" style="float:right;width:10%;margin-left:5%;"><a href="javascript:;" id="togglerate0" onclick="togglerate(this.id);"><i class="la la-money"></i></a></div>

                                          <div id="tograte0" style="display:none;">
                                             <hr>
                                             <input type="text" id="cur_rate0" name="cur_rate[]" class="form-control" placeholder="Currency" style="float:left;width:45%;height:25px;" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);">&nbsp;x&nbsp;
                                             <input type="text" id="con_rate0" name="con_rate[]" class="form-control" placeholder="Conversion" style="float:right;width:45%;height:25px;" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);">
                                          </div>
                                       </td>
                                       <td>
                                          <input type="text" id="pur_value0" name="pur_value[]" class="form-control" placeholder="Enter Pur Value" value=0 onfocus="this.select();" style="float:left;width:85%;height:25px;" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);"><div id="istot0" style="float:right;width:10%;margin-left:5%;"><a href="javascript:;" onclick="showtotpur(0)"><i class="la la-money"></i></a></div>
                                          <input type="hidden" id="is_tot0" name="is_tot[]" class="form-control" value=0>
                                       </td>
                                       <td>
                                          <div id="tpval0" style="display:none;">
                                             <input type="text" id="total_pur_value0" style="height:25px;" name="total_pur_value[]" class="form-control" placeholder="Enter Total Pur Value" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);">
                                          </div>
                                       </td>
                                       <td></td>
                                    </tr>
                                    <?php }?>
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
                                 <input type="hidden" id="mailcount" name="mailcount" value="<?php echo count($buyer_order_benefit_details)>0?count($buyer_order_benefit_details):1;?>">

                              <div class="row">
                                 <div class="col-lg-6">
                                 </div>
                                 <div class="col-lg-2">
                                    <div class="form-group m-form__group">
                                       <label>Total TT Receipt<span class="text-danger">*</span></label>
                                       <input type="text" id="total_tt_receipt" name="total_tt_receipt" class="form-control" value="<?php echo count($buyer_order_benefit)>0?$buyer_order_benefit->total_tt_receipt:0;?>" readonly>
                                    </div>
                                 </div>
                                 <div class="col-lg-2">
                                    <div class="form-group m-form__group">
                                       <label>Total Pur Value<span class="text-danger">*</span></label>
                                       <input type="text" id="total_pur_val" name="total_pur_val" class="form-control" value="<?php echo count($buyer_order_benefit)>0?$buyer_order_benefit->total_pur_value:0;?>" readonly>
                                    </div>
                                 </div>
                                 <div class="col-lg-2">
                                    <div class="form-group m-form__group">
                                       <label>Contribution<span class="text-danger">*</span></label>
                                       <input type="text" id="contribution" name="contribution" class="form-control" value="<?php echo count($buyer_order_benefit)>0?$buyer_order_benefit->contribution:0;?>" readonly>
                                    </div>
                                 </div>
                              </div>

                              <!-- <div class="row">
                                 <div class="col-lg-9">
                                 </div>
                                 <div class="col-lg-2">
                                    <div class="form-group m-form__group">
                                       <label>Contribution<span class="text-danger">*</span></label>
                                       <input type="text" id="contribution" name="contribution" class="form-control" value="<?php //echo count($buyer_order_benefit)>0?$buyer_order_benefit->contribution:0;?>" readonly>
                                    </div>
                                 </div>
                                 <div class="col-lg-1">
                                 </div>
                              </div> -->

                              <div class="row">
                                 <div class="col-lg-2">
                                    <div class="form-group m-form__group">
                                       <label>MEIS<span class="text-danger">*</span></label>
                                       <input type="text" id="meis" name="meis" class="form-control" value="<?php echo count($buyer_order_benefit)>0?$buyer_order_benefit->meis:0;?>" onfocus="this.select();">
                                    </div>
                                 </div>
                                 <div class="col-lg-2">
                                    <div class="form-group m-form__group">
                                       <label>Draw Back<span class="text-danger">*</span></label>
                                       <input type="text" id="drawback" name="drawback" class="form-control" value="<?php echo count($buyer_order_benefit)>0?$buyer_order_benefit->drawback:0;?>" onfocus="this.select();">
                                    </div>
                                 </div>
                              </div>

                              <!-- <div class="row">
                                 <div class="col-lg-9">
                                 </div>
                                 <div class="col-lg-2">
                                    <div class="form-group m-form__group">
                                       <label>Draw Back<span class="text-danger">*</span></label>
                                       <input type="text" id="drawback" name="drawback" class="form-control" value="<?php //echo count($buyer_order_benefit)>0?$buyer_order_benefit->drawback:0;?>" onfocus="this.select();">
                                    </div>
                                 </div>
                                 <div class="col-lg-1">
                                 </div>
                              </div> -->
                              
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
   var title = $('title').text() + ' | ' + 'Buyer Order Benefit Sheet';
   $(document).attr("title", title);
$('.m_selectpicker').selectpicker();

function changeTTValue(id)
{
   var res = id.substring(10);
   $('#cur_rate'+res).val(0);
   $('#con_rate'+res).val(0);
}

function getTTValue(id)
{
   var res = id.substring(8);
   var cur_rate = $('#cur_rate'+res).val();
   var con_rate = $('#con_rate'+res).val();

   if(cur_rate=='')
      cur_rate = 0;
   if(con_rate=='')
      con_rate=0;

   var ttval = parseFloat(cur_rate)*parseFloat(con_rate);
   $('#tt_receipt'+res).val(ttval.toFixed('2'));
   getValues(id);
}

function togglerate(id)
{
   var res = id.substring(10);
   $('#tograte'+res).toggle("slow");
}

function showtotpur(i)
{
   $('#tpval'+i).show();
   $('#istot'+i).html('<a href="javascript:;" onclick="add_pcs_type_clone('+i+')"><i class="fa fa-plus"></i></a>');
   $('#is_tot'+i).val(1);
}

function getValues(id)
{

   var res = id.substring(0, 9);
   if(res=='pur_value')
   {
      var pres = id.substring(9);
      if($('#is_tot'+pres).val()==1)
      {
         var chk=0;
         var pval=0;
         var tpurval=0;
         for(var tp=pres;tp>=0;tp--)
         {
            if(chk==0)
            {
               if(document.getElementById('tpval'+tp).style.display!='none')
               {
                  tpurval = parseFloat(tpurval)+parseFloat($('#total_pur_value'+tp).val());
                  chk=1;
               }
               pval=parseFloat(pval)+parseFloat($('#pur_value'+tp).val());
            }
         }

         var pvalnew = parseFloat(tpurval) - parseFloat(pval);

          if(parseFloat(pvalnew)>0)
            $('#istot'+pres).html('<a href="javascript:;" onclick="add_pcs_type_clone('+pres+')"><i class="fa fa-plus"></i></a>');
         else
            $('#istot'+pres).html('');
      }
   }

   var inpval = $('#'+id).val();
   if(inpval=='')
   {
      inpval=0;
      $('#'+id).val(inpval);
   }

   var tottt = 0;
   var purval=0;
   var contri=0;
   $("tr[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);

      var tt = $('#tt_receipt'+res).val();
      var  pur = $('#pur_value'+res).val();

      tottt = parseFloat(tottt)+parseFloat(tt);
      purval = parseFloat(purval)+parseFloat(pur);
   });

   $('#total_tt_receipt').val(tottt.toFixed('2'));
   $('#total_pur_val').val(purval.toFixed('2'));

   contri = parseFloat(tottt)-parseFloat(purval);

   $('#contribution').val(contri.toFixed('2'));
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

function add_pcs_type_clone(i)
{
   //var count=$('#mailcount').val();
   j=i+1;
   k=i+2;
   var cont = $("#mcontent10");

   if ($('#mid'+j).length)
   {
      s=k;
      var tottr=0;
      $("tr[id^='mid']").each(function(){
         tottr = parseFloat(tottr)+1;
      });

    for(var res=tottr-1;res>=0;res--){
      if(res>i)
      { 
         s=res+1;
         $("#mid"+res).prop('id', 'mid'+s);
         $("#buyer_order_benefit_date"+res).prop('id', 'buyer_order_benefit_date'+s);
         $("#particulars"+res).prop('id', 'particulars'+s);
         $("#particulars_err"+res).prop('id', 'particulars_err'+s);
         $("#tt_receipt"+res).prop('id', 'tt_receipt'+s);
         $("#pur_value"+res).prop('id', 'pur_value'+s);
         $("#tpval"+res).prop('id', 'tpval'+s);
         $("#total_pur_value"+res).prop('id', 'total_pur_value'+s);
         $("#istot"+res).prop('id', 'istot'+s);
         $("#is_tot"+res).prop('id', 'istot'+s);
         $("#rembtn"+res).prop('id', 'rembtn'+s);
         $("#removebtn"+res).prop('id', 'removebtn'+s);
         var str='<button class="btn btn-danger" onclick="remove_pc_type('+res+')" id="removebtn'+s+'"><i class="fa fa-minus"></i></button>';
         var str1 = str.replace(res, s);
         $('#rembtn'+s).html(str1);

         if(res!=tottr-1)
            $('#removebtn'+s).hide();
         //$('#rembtn'+s).html('');

         var str2 = $("#istot"+s).html();
         var str3 = str2.replace(res, s);

         $('#istot'+s).html(str3);


         $("#isttval"+res).prop('id', 'isttval'+s);
         $("#tograte"+res).prop('id', 'tograte'+s);
         $("#cur_rate"+res).prop('id', 'cur_rate'+s);
         $("#con_rate"+res).prop('id', 'con_rate'+s);
         $("#togglerate"+res).prop('id', 'togglerate'+s);
         //s++;
      }
    }


      var chk=0;
      var pval=0;
      var tpurval=0;
      for(var tp=i;tp>=0;tp--)
      {
         if(chk==0)
         {
            if(document.getElementById('tpval'+tp).style.display!='none')
            {
               tpurval = parseFloat(tpurval)+parseFloat($('#total_pur_value'+tp).val());
               chk=1;
            }
            pval=parseFloat(pval)+parseFloat($('#pur_value'+tp).val());
         }
      }

      //var tpurval = $('#total_pur_value'+i).val();
      var parti = $('#particulars'+i).val();
      //var pval = $('#pur_value'+i).val();

      var pvalnew = parseFloat(tpurval) - parseFloat(pval);
      $('#istot'+i).html('');

   /*var lcount = Number(j)-1;
   if(lcount!=0)
      $('#removebtn'+lcount).hide();*/

    $('#mid'+k).before('<tr id="mid'+j+'"><td><input type="text" id="buyer_order_benefit_date'+j+'" name="buyer_order_benefit_date[]" class="form-control m_datepicker_1" style="height:25px;" placeholder="Enter Date"></td><td><input type="text" id="particulars'+j+'" name="particulars[]" class="form-control" placeholder="Enter Particulars" style="height:25px;" value="'+parti+'"><span class="text-danger" id="particulars_err'+j+'"></span></td><td><input type="text" id="tt_receipt'+j+'" name="tt_receipt[]" class="form-control" placeholder="Enter TT Receipt" style="float:left;width:85%;height:25px;" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);changeTTValue(this.id);"><div id="isttval'+j+'" style="float:right;width:10%;margin-left:5%;"><a href="javascript:;" id="togglerate'+j+'" onclick="togglerate(this.id);"><i class="la la-money"></i></a></div><div id="tograte'+j+'" style="display:none;"><hr><input type="text" id="cur_rate'+j+'" name="cur_rate[]" class="form-control" placeholder="Currency" style="float:left;width:45%;height:25px;" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);">&nbsp;x&nbsp;<input type="text" id="con_rate'+j+'" name="con_rate[]" class="form-control" placeholder="Conversion" style="float:right;width:45%;height:25px;" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);"></div></td><td><input type="text" id="pur_value'+j+'" name="pur_value[]" class="form-control" placeholder="Enter Pur Value" value="'+pvalnew+'" onfocus="this.select();" style="float:left;width:85%;height:25px;" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);"><div id="istot'+j+'" style="float:right;width:10%;margin-left:5%;"></div><input type="hidden" id="is_tot'+j+'" name="is_tot[]" class="form-control" value=1></td><td><div id="tpval'+j+'" style="display:none;"><input type="text" id="total_pur_value'+j+'" name="total_pur_value[]" class="form-control" placeholder="Enter Total Pur Value" value=0 onfocus="this.select();" style="height:25px;" onkeypress="return isNumberKey(event,this);"></div></td><td id="rembtn'+j+'"><button class="btn btn-danger" onclick="remove_pc_type('+j+')" id="removebtn'+j+'"><i class="fa fa-minus"></i></button></td></tr>');

    $('#removebtn'+j).hide();

   var totval = parseFloat(pval)+parseFloat(pvalnew);
    if(parseFloat(totval)!=parseFloat(tpurval))
      $('#istot'+j).html('<a href="javascript:;" onclick="add_pcs_type_clone('+j+')"><i class="fa fa-plus"></i></a>');

      $('#mailcount').val(s);
   }
   else
   {
      var chk=0;
      var pval=0;
      var tpurval=0;
      for(var tp=i;tp>=0;tp--)
      {
         if(chk==0)
         {
            if(document.getElementById('tpval'+tp).style.display!='none')
            {
               tpurval = parseFloat(tpurval)+parseFloat($('#total_pur_value'+tp).val());
               chk=1;
            }
            pval=parseFloat(pval)+parseFloat($('#pur_value'+tp).val());
         }
      }
      
      //var tpurval = $('#total_pur_value'+i).val();
      var parti = $('#particulars'+i).val();
      //var pval = $('#pur_value'+i).val();

      var pvalnew = parseFloat(tpurval) - parseFloat(pval);
      $('#istot'+i).html('');



   var lcount = Number(j)-1;
   if(lcount!=0)
      $('#removebtn'+lcount).hide();

      cont.append('<tr id="mid'+j+'"><td><input type="text" id="buyer_order_benefit_date'+j+'" name="buyer_order_benefit_date[]" class="form-control m_datepicker_1" style="height:25px;" placeholder="Enter Date"></td><td><input type="text" id="particulars'+j+'" name="particulars[]" class="form-control" style="height:25px;" placeholder="Enter Particulars" value="'+parti+'"><span class="text-danger" id="particulars_err'+j+'"></span></td><td><input type="text" id="tt_receipt'+j+'" name="tt_receipt[]" class="form-control" placeholder="Enter TT Receipt" style="float:left;width:85%;height:25px;" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);changeTTValue(this.id);"><div id="isttval'+j+'" style="float:right;width:10%;margin-left:5%;"><a href="javascript:;" id="togglerate'+j+'" onclick="togglerate(this.id);"><i class="la la-money"></i></a></div><div id="tograte'+j+'" style="display:none;"><hr><input type="text" id="cur_rate'+j+'" name="cur_rate[]" class="form-control" placeholder="Currency" style="float:left;width:45%;height:25px;" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);">&nbsp;x&nbsp;<input type="text" id="con_rate'+j+'" name="con_rate[]" class="form-control" placeholder="Conversion" style="float:right;width:45%;height:25px;" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);"></div></td><td><input type="text" id="pur_value'+j+'" name="pur_value[]" class="form-control" placeholder="Enter Pur Value" value="'+pvalnew+'" onfocus="this.select();" style="float:left;width:85%;height:25px;" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);"><div id="istot'+j+'" style="float:right;width:10%;margin-left:5%;"></div><input type="hidden" id="is_tot'+j+'" name="is_tot[]" class="form-control" value=1></td><td><div id="tpval'+j+'" style="display:none;"><input type="text" id="total_pur_value'+j+'" name="total_pur_value[]" class="form-control" placeholder="Enter Total Pur Value" value=0 onfocus="this.select();" style="height:25px;" onkeypress="return isNumberKey(event,this);"></div></td><td id="rembtn'+j+'"><button class="btn btn-danger" onclick="remove_pc_type('+j+')" id="removebtn'+j+'"><i class="fa fa-minus"></i></button></td></tr>');

   var totval = parseFloat(pval)+parseFloat(pvalnew);
   
    if(parseFloat(totval)!=parseFloat(tpurval))
      $('#istot'+j).html('<a href="javascript:;" onclick="add_pcs_type_clone('+j+')"><i class="fa fa-plus"></i></a>');

      $('#mailcount').val(k);
   }

   var tottt = 0;
   var purval=0;
   var contri=0;
   $("tr[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);

      var tt = $('#tt_receipt'+res).val();
      var  pur = $('#pur_value'+res).val();

      tottt = parseFloat(tottt)+parseFloat(tt);
      purval = parseFloat(purval)+parseFloat(pur);
   });

   $('#total_tt_receipt').val(tottt.toFixed('2'));
   $('#total_pur_val').val(purval.toFixed('2'));

   contri = parseFloat(tottt)-parseFloat(purval);

   $('#contribution').val(contri.toFixed('2'));


    
    /*cont.append('<tr id="mid'+j+'"><td><input type="text" id="buyer_order_benefit_date'+j+'" name="buyer_order_benefit_date[]" class="form-control m_datepicker_1" placeholder="Enter Date"></td><td><input type="text" id="particulars'+j+'" name="particulars[]" class="form-control" placeholder="Enter Particulars"><span class="text-danger" id="particulars_err'+j+'"></span></td><td><input type="text" id="tt_receipt'+j+'" name="tt_receipt[]" class="form-control" placeholder="Enter TT Receipt" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);"></td><td><input type="text" id="pur_value'+j+'" name="pur_value[]" class="form-control" placeholder="Enter Pur Value" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);"></td><td><div id="tpval'+j+'" style="display:none;"><input type="text" id="total_pur_value'+j+'" name="total_pur_value[]" class="form-control" placeholder="Enter Total Pur Value" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);"></div></td><button class="btn btn-danger" onclick="remove_pc_type('+j+')"><i class="fa fa-minus"></i></button><td></td></tr>');*/

    //count=Number(i)+1;
    //$('#mailcount').val(k);
    $('.m_datepicker_1').datepicker();
    $('#is_tot'+i).val(2);
}

function add_pcs_type()
{
   var count=$('#mailcount').val();
   var cont = $("#mcontent10");

   var lcount = Number(count)-1;
   if(lcount!=0)
      $('#removebtn'+lcount).hide();
    
    cont.append('<tr id="mid'+count+'"><td><input type="text" id="buyer_order_benefit_date'+count+'" name="buyer_order_benefit_date[]" class="form-control m_datepicker_1" style="height:25px;" placeholder="Enter Date"></td><td><input type="text" id="particulars'+count+'" name="particulars[]" class="form-control" style="height:25px;" placeholder="Enter Particulars"><span class="text-danger" id="particulars_err'+count+'"></span></td><td><input type="text" id="tt_receipt'+count+'" name="tt_receipt[]" class="form-control" placeholder="Enter TT Receipt" style="float:left;width:85%;height:25px;" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getValues(this.id);changeTTValue(this.id);"><div id="isttval'+count+'" style="float:right;width:10%;margin-left:5%;"><a href="javascript:;" id="togglerate'+count+'" onclick="togglerate(this.id);"><i class="la la-money"></i></a></div><div id="tograte'+count+'" style="display:none;"><hr><input type="text" id="cur_rate'+count+'" name="cur_rate[]" class="form-control" placeholder="Currency" style="float:left;width:45%;height:25px;" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);">&nbsp;x&nbsp;<input type="text" id="con_rate'+count+'" name="con_rate[]" class="form-control" placeholder="Conversion" style="float:right;width:45%;height:25px;" onfocus="this.select();" onkeypress="return isNumberKey(event,this);" onkeyup="getTTValue(this.id);"></div></td><td><input type="text" id="pur_value'+count+'" name="pur_value[]" class="form-control" placeholder="Enter Pur Value" value=0 onfocus="this.select();" onkeypress="return isNumberKey(event,this);" style="float:left;width:85%;height:25px;" onkeyup="getValues(this.id);"><div id="istot'+count+'" style="float:right;width:10%;margin-left:5%;"><a href="javascript:;" onclick="showtotpur('+count+')"><i class="la la-money"></i></a></div><input type="hidden" id="is_tot'+count+'" name="is_tot[]" class="form-control" value=0></td><td><div id="tpval'+count+'" style="display:none;"><input type="text" id="total_pur_value'+count+'" name="total_pur_value[]" class="form-control" placeholder="Enter Total Pur Value" value=0 onfocus="this.select();" style="height:25px;" onkeypress="return isNumberKey(event,this);"></div></td><td id="rembtn'+count+'"><button class="btn btn-danger" onclick="remove_pc_type('+count+')" id="removebtn'+count+'"><i class="fa fa-minus"></i></button></td></tr>');

    count=Number(count)+1;
    $('#mailcount').val(count);
    $('.m_datepicker_1').datepicker();
}

function remove_pc_type(val)
{

   var lval = Number(val)-1;
   if(lval!=0)
      $('#removebtn'+lval).show();


   if($('#is_tot'+val).val()==1 && $('#tt_receipt'+lval).val()==0)
   {
      $('#is_tot'+lval).val(1);
      $('#istot'+lval).html('<a href="javascript:;" onclick="add_pcs_type_clone('+lval+')"><i class="fa fa-plus"></i></a>');
   }

   $('#mid'+val).remove();

   $('#mailcount').val(val);

   var tottt = 0;
   var purval=0;
   var contri=0;
   $("tr[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);

      var tt = $('#tt_receipt'+res).val();
      var  pur = $('#pur_value'+res).val();

      tottt = parseFloat(tottt)+parseFloat(tt);
      purval = parseFloat(purval)+parseFloat(pur);
   });

   $('#total_tt_receipt').val(tottt.toFixed('2'));
   $('#total_pur_val').val(purval.toFixed('2'));

   contri = parseFloat(tottt)-parseFloat(purval);

   $('#contribution').val(contri.toFixed('2'));

}

function benefit_sheet_validation()
{
   var err = 0;
   $("tr[id^='mid']").each(function(){
      var id = this.id;
      var res = id.substring(3);
      var parti=$('#particulars'+res).val();

      if(parti==''){
         $('#particulars_err'+res).html('Enter Particulars!');
         err++;
      }else{
         $('#particulars_err'+res).html('');
      }
   });
   
   if(err> 0){ return false;}else{ return true; }   
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