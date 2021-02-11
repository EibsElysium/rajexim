<?php $this->load->view('common_header'); ?>

<style>


.table-wrapper {
    overflow-x: scroll;
    width: 600px;
    margin: 0 auto;
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
                              <a href="<?php echo base_url(); ?>multiproductcosting" class="m-nav__link">
                                 <span class="m-nav__link-text">Multi Product Costing - G</span>
                              </a>
                           </li>
                           <li class="m-nav__separator"><i class="fa fa-angle-double-right"></i></li>
                           <li class="m-nav__item">
                              <a href="javascript:;" class="m-nav__link">
                                 <span class="m-nav__link-text">Create Multi Product Costing - G</span>
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
                                      Create Multi Product Costing - G
                                    </h3>
                                 </div>
                              </div>
                              <div class="m-portlet__head-tools">
                                 <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                       <a href="<?php echo base_url(); ?>multiproductcosting" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                          <span>
                                             <i class="la la-angle-double-left"></i>
                                             <span>Back</span>
                                          </span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <form  name="productcosting_form" id="productcosting_form" method="POST" action="<?php echo base_url(); ?>multiproductcosting/multi_product_costing_save" onsubmit="return multi_product_costing_validation();" >
                              <div class="m-portlet__body">
                                 <!--begin: Datatable -->

                                 <div class="row">
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Lead<span class="text-danger">*</span></label>
                                          <!-- <select class="form-control m-bootstrap-select m_selectpicker" id="lead_id" name="lead_id" data-live-search="true">
                                             <option value="">Select Lead</option>
                                             <?php //foreach($lead_list as $plist){?>
                                                <option value="<?php //echo $plist['lead_id'];?>"><?php //echo $plist['lead_name'];?> - <?php //echo $plist['email_id'];?></option>
                                             <?php //}?>
                                          </select> -->
                                          <?php if($lid==''){?>
                                           <input type="text" id="lead_name" name="lead_name" class="form-control">
                                          <input type="hidden" id="lead_id" name="lead_id">
                                          <?php }else{?>
                                           <input type="text" id="lead_name" name="lead_name" class="form-control" value="<?php echo $contact_book_details->lead_name;?>" readonly>
                                          <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead_details->lead_id;?>">
                                          <?php }?>
                                          <span id="lead_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Template<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" id="multi_product_costing_template_id" name="multi_product_costing_template_id" data-live-search="true" onchange="get_template_details(this.value);">
                                             <option value="">Select Template</option>
                                             <?php foreach($multi_product_costing_template_list as $plist){?>
                                                <option value="<?php echo $plist['multi_product_costing_template_id'];?>"><?php echo $plist['multi_product_costing_template'];?></option>
                                             <?php }?>
                                          </select>
                                          <span id="multi_product_costing_template_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Container<span class="text-danger">*</span></label>
                                          <select class="form-control m-bootstrap-select m_selectpicker" id="container_id" name="container_id" data-live-search="true" onchange="get_container_details(this.value);">
                                             <option value="">Select Container</option>
                                             <?php foreach($container_list as $plist){?>
                                                <option value="<?php echo $plist['container_id'];?>"><?php echo $plist['container_name'];?></option>
                                             <?php }?>
                                          </select>
                                          <input type="hidden" id="min_cbm">
                                          <input type="hidden" id="max_cbm">
                                          <input type="hidden" id="max_ton">
                                          <input type="hidden" id="ton_variance">
                                          <span id="container_id_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>Margin %<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="margin_in_percent" name="margin_in_percent" onkeypress="return isNumberKey(event,this);" value="1" onkeyup="getCalculatedValue()" onfocus="this.select();">
                                          <span id="margin_in_percent_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group m-form__group">
                                          <label>CHA Expense<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="cha_expense" name="cha_expense" onkeypress="return isNumberKey(event,this);" value="0" onkeyup="getCalculatedValue()" onfocus="this.select();">
                                          <span id="cha_expense_err" class="text-danger"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group m-form__group">
                                          <label>Based On<span class="text-danger">*</span></label>
                                             <div class="m-radio-inline">
                                             <label class="m-radio m-radio--bold m-radio--success">
                                             <input type="radio" name="cha_based_on" checked id="cha_based_on_0" value="0" onchange="getCalculatedValue()">Weight
                                             <span></span>
                                             </label>
                                             <label class="m-radio m-radio--bold m-radio--success">
                                             <input type="radio" name="cha_based_on" id="cha_based_on_1" value="1" onchange="getCalculatedValue()">Cost
                                             <span></span>
                                             </label>
                                             <!-- <label class="m-radio m-radio--bold m-radio--success">
                                             <input type="radio" name="cha_based_on" id="cha_based_on_2" value="2">CBM
                                             <span></span>
                                             </label> -->
                                          </div>
                                          <span class="text-danger"></span>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <input type="hidden" id="mpctcount" value="">
                                    <div class="col-lg-12 table-wrapper" id="tabcontent">
                                    </div>
                                 </div>
                                 <br>
                                 <div id="totkg_err" class="text-danger"></div>
                                 <br>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group m-form__group">
                                          <div class="pull-right">
                                             <button type="button" class="btn btn-primary" onclick="addProductLine()">
                                                <i class="fa fa-plus"></i>
                                             </button>
                                          </div>
                                       </div>
                                    </div> 
                                 </div>
                                 <input type="hidden" id="mailcount" name="mailcount" value="1">
                                 
                              </div>
                              <div class="m-portlet__foot">
                                 <div class="row align-items-center">
                                    <div class="col-lg-12 m--align-right">
                                       <input type="submit"  class="btn btn-primary" name="submit" id="btnsubmit" value="Save" onclick="changedraftvalue(this.value);">
                                       <input type="submit"  class="btn btn-primary" name="draft" id="btndraft" value="Draft" onclick="changedraftvalue(this.value);">
                                    </div>
                                 </div>
                              </div>
                              <input type="hidden" id="is_draft" name="is_draft">
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

<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
         <!-- end::Footer -->
      </div>
      <!-- end:: Page -->
   
<script type="text/javascript">
var baseurl = '<?php echo base_url(); ?>';
var title = $('title').text() + ' | ' + 'Multi Product Costing';
$(document).attr("title", title); 

$(document).ready(function(){

     // Initialize 
     $( "#lead_name" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: baseurl+"productcosting/lead_list",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
              //alert(JSON.stringify(data));
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#lead_name').val(ui.item.label); // display the selected text
          $('#lead_id').val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });

function get_template_details(val)
{
   if(val!='')
   {
      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcosting/get_template_details',
         async: false,
         data: "tid="+val,
         dataType: "html",
         success: function(response)
         {
            var sdata = response.split('|');
            $('#mpctcount').val(sdata[0]);
            $('#tabcontent').html(sdata[1]);
         }
      });
   }
   else
   {
      $('#mpctcount').val(0);
      $('#tabcontent').html('');
   }
}

function get_container_details(val)
{
   if(val!='')
   {
      $.ajax({
      type: "POST",
      url: baseurl+'multiproductcosting/get_container_details',
      async: false,
      data: "cid="+val,
      dataType: "html",
      success: function(response)
      {
         var sdata = response.split('|');
         $('#min_cbm').val(sdata[0]);
         $('#max_cbm').val(sdata[1]);
         $('#max_ton').val(sdata[2]);
         $('#ton_variance').val(sdata[3]);
      }
   });
   }
}

function addProductLine()
{
   var count=$('#mailcount').val();
   var cont = $("#mcontent10");
   var tempid = $('#multi_product_costing_template_id').val();
   var contplus = parseFloat(count)+1;
   $.ajax({
      type: "POST",
      url: baseurl+'multiproductcosting/addProductLine',
      async: false,
      data: "count="+count+"&tempid="+tempid,
      dataType: "html",
      success: function(response)
      {
         cont.append(response);
         $('#mailcount').val(contplus);
      }
   });
}

function getCalculatedValue()
{
   var mip = $('#margin_in_percent').val();
   var cid = $('#container_id').val();
   var cha = $('#cha_expense').val();
   var noprbb=0;tkg=0;mpcpkg=0;cpftqiu=tifp=tmar=mpct=tcec=pcpkg=0;
   if(cid!='')
   {
      var mton = $('#max_ton').val();
      var tvari = $('#ton_variance').val();
      var tdiff = parseFloat(mton) - parseFloat(tvari);
      var radioValue = $("input[name='cha_based_on']:checked").val();
      
      if(mip!='')
      {
         if(cha!='' && cha>0)
         {


            if(radioValue==0)
            {
               var totkg = $($('#tkg').html()).text();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            if(radioValue==1)
            {
               var totkg = $('#tifp').html();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            var linecount=$('#mailcount').val();
            for(var lc=0;lc<linecount;lc++)
            {
               if(radioValue==1)
               {
                  var pppk = $('#inp'+lc+'_5').val();
                  var spcha1 = parseFloat(spcha)*parseFloat(pppk);
               }
               else
                  var spcha1 = spcha;
               $('#inp'+lc+'_9').val(spcha1.toFixed('2'));
            }
            var linecount=$('#mailcount').val();
            var mpctcount=$('#mpctcount').val();
            var mpctfid = $('#mpctfid').val();
            var mpctlid = $('#mpctlid').val();
            for(var lc=0;lc<linecount;lc++)
            {
               for(var mpctc=mpctfid;mpctc<=mpctlid;mpctc++)
               {
                  var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                  if(isedit!=1)
                  {
                     var mathaction = $('#math_action_'+lc+'_'+mpctc).val();
                     if(mathaction=='')
                     {
                        var ival = $('#inp'+lc+'_'+(mpctc-1)).val();
                        if(ival>1 || ival==0)
                        {
                           $('#val'+lc+'_'+mpctc).html(ival);
                        }
                        else
                        {
                           inpval = 1/ival;
                           $('#val'+lc+'_'+mpctc).html(inpval.toFixed('2'));
                        }
                     }
                     else if(mathaction=='Addition(+)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var splmpctim = mpctim.split(',');
                        var cntsplmpctim = splmpctim.length;
                        var mval = 0;
                        for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                        {
                           var reqval = splmpctim[cntspl];
                           var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                           if(isedit1!=1)
                           {
                              mval = parseFloat(mval) + parseFloat($('#val'+lc+'_'+reqval).html());
                           }
                           else
                           {
                              mval = parseFloat(mval) + parseFloat($('#inp'+lc+'_'+reqval).val());
                           }
                        }
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else if(mathaction=='Subtraction(-)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var splmpctim = mpctim.split(',');
                        var cntsplmpctim = splmpctim.length;
                        var mval = 0;
                        for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                        {
                           var reqval = splmpctim[cntspl];
                           var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                           if(isedit1!=1)
                           {
                              mval = parseFloat(mval) - parseFloat($('#val'+lc+'_'+reqval).html());
                           }
                           else
                           {
                              mval = parseFloat(mval) - parseFloat($('#inp'+lc+'_'+reqval).val());
                           }
                        }
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else if(mathaction=='Multiplication(*)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var splmpctim = mpctim.split(',');
                        var cntsplmpctim = splmpctim.length;
                        var mval = 1;
                        for (var cntspl=0;cntspl<cntsplmpctim;cntspl++)
                        {
                           var reqval = splmpctim[cntspl];
                           var isedit1 = $('#is_edit_'+lc+'_'+reqval).val();
                           if(isedit1!=1)
                           {
                              mval = parseFloat(mval) * parseFloat($('#val'+lc+'_'+reqval).html());
                           }
                           else
                           {
                              mval = parseFloat(mval) * parseFloat($('#inp'+lc+'_'+reqval).val());
                           }
                        }
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else if(mathaction=='Percentage(%)')
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var isedit1 = $('#is_edit_'+lc+'_'+mpctim).val();
                        if(isedit1!=1)
                        {
                           var pval = parseFloat($('#val'+lc+'_'+mpctim).html());
                        }
                        else
                        {
                           var pval = parseFloat($('#inp'+lc+'_'+mpctim).val());
                        }
                        var mval = (parseFloat(pval)*parseFloat(mip))/100;
                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                     else
                     {
                        var mpctim = $('#multi_product_costing_type_id_math_'+lc+'_'+mpctc).val();
                        var mpctim1 = $('#multi_product_costing_type_id_math_1-'+lc+'_'+mpctc).val();
                        var nopg = $('#is_nop_greater_'+lc+'_'+mpctc).val();

                        var isedit1 = $('#is_edit_'+lc+'_'+mpctim).val();
                        if(isedit1!=1)
                        {
                           var mval1 = parseFloat($('#val'+lc+'_'+mpctim).html());
                        }
                        else
                        {
                           var mval1 = parseFloat($('#inp'+lc+'_'+mpctim).val());
                        }

                        var isedit2 = $('#is_edit_'+lc+'_'+mpctim1).val();
                        if(isedit2!=1)
                        {
                           var mval2 = parseFloat($('#val'+lc+'_'+mpctim1).html());
                        }
                        else
                        {
                           var mval2 = parseFloat($('#inp'+lc+'_'+mpctim1).val());
                        }

                        /*if(nopg==0)
                           var mval = parseFloat(mval1) / parseFloat(mval2);
                        else
                           var mval = parseFloat(mval1) * parseFloat(mval2);*/
                        if(ival>1 && nopg==1)
                           var mval = parseFloat(mval1) * parseFloat(mval2);
                        else
                           var mval = parseFloat(mval1) / parseFloat(mval2);

                        $('#val'+lc+'_'+mpctc).html(mval.toFixed('2'));
                     }
                  }
                  if(mpctc==3)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        noprbb = parseFloat(noprbb) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        noprbb = parseFloat(noprbb) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#noprbb').html(noprbb.toFixed('2'));
                  }
                  if(mpctc==4)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tkg = parseFloat(tkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tkg = parseFloat(tkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tkg').html(tkg.toFixed('2'));
                  }
                  if(mpctc==6)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        mpcpkg = parseFloat(mpcpkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        mpcpkg = parseFloat(mpcpkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#mpcpkg').html(mpcpkg.toFixed('2'));
                  }
                  if(mpctc==7)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        pcpkg = parseFloat(pcpkg) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        pcpkg = parseFloat(pcpkg) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#pcpkg').html(pcpkg.toFixed('2'));
                  }
                  if(mpctc==14)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        cpftqiu = parseFloat(cpftqiu) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        cpftqiu = parseFloat(cpftqiu) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#cpftqiu').html(cpftqiu.toFixed('2'));
                  }
                  if(mpctc==15)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tifp = parseFloat(tifp) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tifp = parseFloat(tifp) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tifp').html(tifp.toFixed('2'));
                  }
                  if(mpctc==16)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tmar = parseFloat(tmar) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tmar = parseFloat(tmar) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tmar').html(tmar.toFixed('2'));
                  }
                  if(mpctc==17)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        mpct = parseFloat(mpct) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        mpct = parseFloat(mpct) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#mpct').html(mpct.toFixed('2'));
                  }
                  if(mpctc==18)
                  {
                     var isedit = $('#is_edit_'+lc+'_'+mpctc).val();
                     if(isedit!=1)
                     {
                        tcec = parseFloat(tcec) + parseFloat($('#val'+lc+'_'+mpctc).html());
                     }
                     else
                     {
                        tcec = parseFloat(tcec) + parseFloat($('#inp'+lc+'_'+mpctc).val());
                     }
                     $('#tcec').html(tcec.toFixed('2'));
                  }
               }
            }
            var tkgval = $('#tkg').html();
            if((tkgval/1000)<=parseFloat(tdiff))
            {
               $('#tkg').html('<font color="green">'+tkgval+'</font>');
            }
            else if(((tkgval/1000)>parseFloat(tdiff)) && ((tkgval/1000)<=parseFloat(mton)))
            {
               $('#tkg').html('<font color="orange">'+tkgval+'</font>');
            }
            else
            {
               $('#tkg').html('<font color="red">'+tkgval+'</font>');
            }

            if(radioValue==0)
            {
               var totkg = $($('#tkg').html()).text();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            if(radioValue==1)
            {
               var totkg = $('#tifp').html();
               var spcha = parseFloat(cha)/parseFloat(totkg);
            }

            var linecount=$('#mailcount').val();
            for(var lc=0;lc<linecount;lc++)
            {
               if(radioValue==1)
               {
                  var pppk = $('#inp'+lc+'_5').val();
                  var spcha1 = parseFloat(spcha)*parseFloat(pppk);
               }
               else
                  var spcha1 = spcha;
               $('#inp'+lc+'_9').val(spcha1.toFixed('2'));
            }
         }
         else
         {
            alert("CHA is required!");
         }
      }
      else
      {
         alert("Margin is required!");
      }
   }
   else
   {
      alert("Choose Container");
   }

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

function changedraftvalue(val)
{
   if(val=='Draft')
   {
      $('#is_draft').val(1);
   }
   else
   {
      $('#is_draft').val(0);
   }
}

function multi_product_costing_validation()
{
   var err=0;
   var lid = $('#lead_id').val();
   var mip = $('#margin_in_percent').val();
   var cid = $('#container_id').val();
   var tkgval = $($('#tkg').html()).text();
   var mton = $('#max_ton').val();
   
   if((tkgval/1000)>parseFloat(mton))
   {
      $('#totkg_err').html('Exceed Container Weight!');
      err++;
   }
   else
   {
      $('#totkg_err').html('');
   }
   if(lid=='')
   {
      $('#lead_id_err').html('Choose Lead!');
      err++;
   }
   else
   {
      $('#lead_id_err').html('');
   }
   if(cid=='')
   {
      $('#container_id_err').html('Choose Container!');
      err++;
   }
   else
   {
      $('#container_id_err').html('');
   }

   if(mip=='')
   {
      $('#margin_in_percent_err').html('Margin % is required!');
      err++;
   }
   else
   {
      $('#margin_in_percent_err').html('');
   }

   var bav=0
   $("tr[id^='mid']").each(function(){
     var id = this.id;
     var res = id.substring(3);
     var pid=$('#product_id'+res).val();
     var pidnid=$('#product_item_display_name_id'+res).val();
     var sku=$('#sku_unit_id'+res).val();

     if(bav==0)  
     {     
        if(pid==''){
          $('#product_id_err'+res).html('Choose Product!');
          err++;
        }else{
          $('#product_id_err'+res).html('');
        }

        if(pidnid==''){
          $('#product_item_display_name_id_err'+res).html('Display Name is required!');
          err++;
        }else{
          $('#product_item_display_name_id_err'+res).html('');
        }

        if(sku==''){
          $('#sku_unit_id_err'+res).html('SKU is required!');
          err++;
        }else{
          $('#sku_unit_id_err'+res).html('');
        }
      }
      else
      {     

        if(pid!='' && pidnid==''){
          $('#product_item_display_name_id_err'+res).html('Display Name is required!');
          err++;
        }else{
          $('#product_item_display_name_id_err'+res).html('');
        }        

        if(pid!='' && sku==''){
          $('#sku_unit_id_err'+res).html('SKU is required!');
          err++;
        }else{
          $('#sku_unit_id_err'+res).html('');
        }
        
      }
      bav++;
   });

   if(err>0){ return false; }else{ return true; }
}



function getProductItemInputs(val,i)
{
   if(val!='')
   {
      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcosting/getProductItemInputs',
         async: false,
         type: "POST",
         data: "piid="+val,
         dataType: "html",
         success: function(response)
         {
            $('#product_item_display_name_id'+i).empty().append(response);
            $('#product_item_display_name_id'+i).selectpicker('refresh');
         }
      });

   }
}

function getProductItemDisplayName(val,i)
{
   if(val!='')
   {
      $.ajax({
         type: "POST",
         url: baseurl+'multiproductcosting/getProductItemDisplayName',
         async: false,
         type: "POST",
         data: "pidnid="+val,
         dataType: "html",
         success: function(response)
         {
            $('#product_item_id'+i).val(response);
         }
      });

   }
   else
   {
      $('#product_item_id'+i).val('');
   }
}



</script>
</body>
   <!-- end::Body -->
</html>