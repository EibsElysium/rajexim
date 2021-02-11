<fieldset>
	<legend class="text-info"><b>Product Info</b></legend>
	<div id="mcontent10">
		<input type="hidden" id="order_end_date" name="order_end_date" value="<?php echo date('Y/m/d', strtotime($po_details->order_end_date)); ?>">
			<div id="spo_pro_append">
				<div class="row" id="mid1">														
					<div class="col-lg-5">
						<div class="form-group m-form__group">	
							<label>Product<span class="text-danger">*</span></label>
							<select class="form-control selectpicker" id="product_id1" name="product_id[]" onchange="get_bo_product_information('1');">
								<?php echo $bo_products; ?>
							</select>
							<p class="text-danger" id="product_err1"></p>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group m-form__group">	
							<label>Quantity</label>
							<input type="text" class="form-control m-input m-input--square" placeholder="Quantity" name="quantity[]" id="quantity1" value="" onkeyup="getQty(this.value,1);">
							<input type="hidden" id="reqqty1" value="">
							<span id="quantity_err1" class="text-danger"></span>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group m-form__group">	
							<label>Rate<span class="text-danger">*</span></label>
							<input type="text" class="form-control m-input m-input--square" placeholder="Rate/quantity" name="rate[]" id="rate1" value=0 onkeypress="return isNumberKey(event,this);" onfocus="this.select();" onkeyup="getAmount(this.value,1)">
							<span id="rate_err1" class="text-danger"></span>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group m-form__group">	
							<label>Amount</label>
							<input type="text" class="form-control m-input m-input--square" placeholder="Amount" name="amount[]" id="amount1" readonly value=0>
						</div>
					</div>
					<div class="col-lg-1">
						<div class="pull-right">
							<div class="form-group m-form__group mt_25px">
								<button class="btn btn-primary" type="button" onclick="add_spo_product();"><i class="fa fa-plus"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
		<input type="hidden" name="spo_product_append_block_count" id="spo_product_append_block_count" value="2">
		<input type="hidden" id="total_amount" name="total_amount">
	</div>
</fieldset>


<script>
$('.m_datetimepicker_3').datetimepicker({todayHighlight:!0,autoclose:!0,pickerPosition:"bottom-left",todayBtn:!0,format:"yyyy/mm/dd hh:ii"});
$('.snotedesc').summernote("disable");
$('.selectpicker').selectpicker();
function getQty(val,i)
{
	var qty = $('#quantity'+i).val();
	var rqty = $('#reqqty'+i).val();
	if(parseFloat(qty)>parseFloat(rqty))
	{
		$('#quantity_err'+i).html('Invalid Quantity');
	}
	else
	{
		$('#quantity_err'+i).html('');
		var qty = $('#quantity'+i).val();
		var rate = $('#rate'+i).val();
		var amt = parseFloat(qty)*parseFloat(rate);
		$('#amount'+i).val(amt.toFixed('2'));

		var totamt = 0;

		$("input[id^='amount']").each(function(){
			var id = this.id;
			var res = id.substring(6);

			totamt = parseFloat(totamt)+parseFloat($('#'+id).val());
		});

		$('#total_amount').val(totamt.toFixed('2'));
	}
}

function add_spo_product()
{

  var cp_inc = $('#spo_product_append_block_count').val();
  alert(cp_inc);
  $('#spo_pro_append').append('<div class="row" id="mid'+cp_inc+'"> <div class="col-lg-5"> <div class="form-group m-form__group"> <label>Product<span class="text-danger">*</span></label> <select class="form-control selectpicker" id="product_id'+cp_inc+'" name="product_id[]" onchange="get_bo_product_information('+cp_inc+');"> <?php echo $bo_products; ?> </select> <p class="text-danger" id="product_err'+cp_inc+'"></p> </div> </div> <div class="col-lg-2"> <div class="form-group m-form__group"> <label>Quantity</label> <input type="text" class="form-control m-input m-input--square" placeholder="Quantity" name="quantity[]" id="quantity'+cp_inc+'" value="" onkeyup="getQty(this.value,'+cp_inc+');"> <input type="hidden" id="reqqty'+cp_inc+'" value=""> <span id="quantity_err'+cp_inc+'" class="text-danger"></span> </div> </div> <div class="col-lg-2"> <div class="form-group m-form__group"> <label>Rate<span class="text-danger">*</span></label> <input type="text" class="form-control m-input m-input--square" placeholder="Rate/quantity" name="rate[]" id="rate'+cp_inc+'" value=0 onkeypress="return isNumberKey(event,this);" onfocus="this.select();" onkeyup="getAmount(this.value,'+cp_inc+')"> <span id="rate_err'+cp_inc+'" class="text-danger"></span> </div> </div> <div class="col-lg-2"> <div class="form-group m-form__group"> <label>Amount</label> <input type="text" class="form-control m-input m-input--square" placeholder="Amount" name="amount[]" id="amount'+cp_inc+'" readonly value=0> </div> </div> <div class="col-lg-1"> <div class="pull-right"> <div class="form-group m-form__group mt_25px"> <button class="btn btn-danger" type="button" onclick="rmv_spo_product('+cp_inc+');"><i class="fa fa-minus"></i></button> </div> </div> </div> </div>');

  cp_inc = Number(cp_inc) + 1;
  $('#spo_product_append_block_count').val(cp_inc);
  $('.selectpicker').selectpicker();
}
function rmv_spo_product(lid)
{
	$('#mid'+lid).remove();
}

function get_bo_product_information(lid)
{
	var bo_pro_id = $('#product_id'+lid).val();

	// var bo_pro_id = $("#product_id"+lid).val();
     var alreadyprod = 0;
     var prod = $('select[id^="product_id"]').length;
     if(bo_pro_id != '')
     {
        for(var i=1;i<=prod;i++)
        {
            var prodval = $("#product_id"+i).val();
            if(lid!=i && bo_pro_id == prodval)
            {
                alreadyprod++;
            }
        }

        if(alreadyprod > 0)
        {
           $("#product_id"+lid).val('');
           
            alert("Product Already Selected");

        }
        else
        {
           	$.ajax({
		        type: "POST",
		        url: baseurl+'supplierpo/getBOProduct_Details_by_id',
		        async: false,
		        type: "POST",
		        data: "bo_pro_id="+bo_pro_id,
		        dataType: "html",
		        success: function(response)
		        {
		            $('#quantity'+lid).empty().val(response);
		            $('#reqqty'+lid).empty().val(response);
		        }
		    });
        }
     }
}

</script>