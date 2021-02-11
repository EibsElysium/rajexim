<?php $date_format =common_date_format(); ?>
<div class="col-lg-12">
<div class="col-lg-2">
  <span>Show</span> 
  <select id="perpage" onchange="submit_bo_filter('perpage_count');" name="perpage">
      <option <?php echo ($perpage == '10') ? 'selected' : ''; ?> value="10">10</option>
      <option <?php echo ($perpage == '25') ? 'selected' : ''; ?> value="25">25</option>
      <option <?php echo ($perpage == '100') ? 'selected' : ''; ?> value="100">100</option>
    </select>
  <span>Entries</span> 
</div>
<div class="col-lg-7"></div>
<div class="col-lg-3" style="padding: 4px; padding-left: 45px;">
 <span>Search</span>  <input type="text" name="lead_list_search" id="lead_list_search" style="width: 162px;" value="<?php echo $search_val; ?>"><button style="padding: 3px; background: #c1c1c1; cursor: pointer;" onclick="search_on_list($('#lead_list_search').val());"><i class="fa fa-search" style="color: #000;"></i></button>
</div>
</div>
<div class="col-lg-12">  

   <table class="table table-striped- table-bordered table-hover table-checkable">

      <thead>

         <tr>

            <th>Invoice No / Date</th>

            <th>Exporter</th>

            <th>Consignee</th>

            <th>No.of Products</th>

            <th>Country</th>

            <th>Stages</th>
            <th>Total Value</th>
            <th>Action</th>

         </tr>

      </thead>

      <tbody>

         <?php 
         if(count($buyer_order_list) > 0) {
         $i=0;foreach ($buyer_order_list as $qlist){

            $qprod = $this->Buyerorder_model->get_buyer_order_product_by_id($qlist['buyer_order_id']);
            $get_value_variant_by_order_Value = get_value_variant_by_value($qlist['grand_total']);
            // print_r($get_value_variant_by_order_Value);
            $value_based_color = ($get_value_variant_by_order_Value) ? $get_value_variant_by_order_Value->vv_color : '';
            $buyer_order_followup = $this->Buyerorder_model->get_buyer_order_followup_sheet($qlist['buyer_order_id']);
            ?>

         <tr>

            <td>
               <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['buyer_order_invoice_no'];?></h5>
               <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo date($date_format, strtotime($qlist['invoice_date'])); ?></sub><b></b></b></span>
            </td> 

            <td>

               <?php echo $qlist['exporter_name'];?>

            </td>

            <td>

               <?php echo $qlist['lead_name'];?>

            </td>

            <td align="center">

               <h5 class="text-black"><?php echo count($qprod);?></h5>

            </td>

            <td align="center">

               <?php echo $qlist['country_name'];?>

            </td>

            <td>

              <h5 class="text-black"><?php echo $qlist['pi_stage'];?></h5>

            </td>

            <td style="background-color: <?php echo $value_based_color; ?>;">
               
              <h5 class="text-black">
                  <span class="pull-left">
                     <i class="fa fa-rupee-sign"></i>
                  </span>
                  <span class="pull-right"><?php echo number_format($qlist['grand_total'],2);?></span>
               </h5>
               <h6 class="text-primary curr_amnt_info">
                  <span class="pull-right"> <?php $convert_curr = $qlist['grand_total'] / $qlist['rate']; echo $qlist['currency_code'].' '.number_format($convert_curr,2); ?></span>
               </h6>

            </td>

            <td>
               <?php if($_SESSION['Buyer OrderBO_Task']==1){ ?>
               <a href="<?php echo base_url(); ?>buyerorder/buyerorder_task/<?php echo $qlist['buyer_order_id']; ?>">

               <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="" data-original-title="Task"><i class="fa fa-spinner"></i></span>

               </a>&nbsp;&nbsp;
               <?php } ?>


               <?php if($_SESSION['Buyer OrderView']==1){ ?>

               <a href="<?php echo base_url(); ?>buyerorder/buyerorder_view/<?php echo $qlist['buyer_order_id'];?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;

               <?php }?>


               <?php if($_SESSION['Buyer OrderVerify_Documents']==1){ ?>
               <a href="<?php echo base_url(); ?>buyerorder/buyerorder_verify_files/<?php echo $qlist['buyer_order_id']; ?>">

               <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="" data-original-title="Upload Verified Doc"><i class="fa fa-file-upload"></i></span>

               </a>&nbsp;&nbsp;
               <?php }?>

               <?php if($_SESSION['Buyer OrderInvoice_copy']==1){ ?>
               <a href="<?php echo base_url(); ?>buyerorder/invoice_copy/<?php echo $qlist['buyer_order_id']; ?>">

                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Invoice Copy" ><i class="fa fa-copy"></i></span>

               </a>&nbsp;&nbsp;
               <?php } ?>
               <?php if($_SESSION['Buyer OrderFeedback']==1){ ?>
               <a href="<?php echo base_url(); ?>buyerorder/po_feedback/<?php echo $qlist['buyer_order_id']; ?>">

               <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="" data-original-title="Order Feedback"><i class="fa fa-comment-dots"></i></span>

               </a>&nbsp;&nbsp;
               <?php } ?>
               <?php if($_SESSION['Buyer OrderComplete']==1)
               {?>
               <?php if($qlist['is_complete']==0){?>

               <a href="javascript:;" data-toggle="modal" data-target="#bo_complete" onclick="return bo_complete(<?php echo $qlist['buyer_order_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Complete"><i class="fa fa-check-circle"></i></span></a>

               <?php }}?>


               <?php if($_SESSION['Buyer OrderBO_followup']==1){ ?>
               <?php if(count($buyer_order_followup)==0){?>
               <a href="<?php echo base_url(); ?>buyerorder/followup_sheet/<?php echo $qlist['buyer_order_id']; ?>">
                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Follow up" ><i class="flaticon-calendar-with-a-clock-time-tools"></i></span>
               </a>&nbsp;&nbsp;
               <?php }else{?>
               <a href="<?php echo base_url(); ?>buyerorder/followup_sheet_view/<?php echo $qlist['buyer_order_id']; ?>">
                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Follow up" ><i class="flaticon-calendar-with-a-clock-time-tools"></i></span>
               </a>&nbsp;&nbsp;
               <?php }?>
               <?php }?>

               <?php if($_SESSION['Buyer OrderBenefit_sheet']==1){ ?>
               <a href="<?php echo base_url(); ?>buyerorder/benefit_sheet/<?php echo $qlist['buyer_order_id']; ?>">

                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Benefit" ><i class="la la-money"></i></span>

               </a>&nbsp;&nbsp;
               <?php } ?>
            </td>

         </tr>

         <?php $i++;} } else {?>
          <tr><td colspan="10"><h6 class="text-center">No Records Found..</h6></td></tr>
         <?php } ?>

      </tbody>

   </table>
</div>
<div class="col-lg-12">
  <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($buyer_order_list_count)) ? count($buyer_order_list_count) : $page + $perpage; ?> of <?php echo count($buyer_order_list_count); ?> entries</div>
  <div class="col-lg-7"></div>
  <div class="col-lg-3">
   <?php if (count($buyer_order_list_count) > $perpage) { ?>
   <ul class="pagination">
     <?php if (($page - $perpage) >= 0){ ?>
     <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
     <?php } ?>
     <?php 
       $last_page_count = '';
       $split_list = (int) (count($buyer_order_list_count) / $perpage);
       $remaining_val = count($buyer_order_list_count) % $perpage;
       if ($remaining_val == 0) {
         $pagination_count = $split_list;
       }
       else {
         $pagination_count = $split_list + 1;
       }
       // echo 'pagination count : '.$pagination_count.' : end';
       for ($i=1; $i <= $pagination_count; $i++) { 
         if($i == 1){ 
           $page_count = '0';  
         } 
         else if ($i > 1) {
           $page_count = ($i - 1) * $perpage;
         }
         if ($i == $pagination_count) {
           $last_page_count = $page_count;
         }
         ?>
       <li class="page-item <?php if($i == $current_pagination_index) { echo "active"; } ?>"><a class="page-link paginate_links" id="pagination_link_<?php echo $i; ?>" onclick="paginate_page('<?php echo $page_count; ?>','<?php echo $i; ?>');"><?php echo $i; ?></a></li>
     <?php }  ?>
     <?php if (($page + $perpage) < count($buyer_order_list_count)){ ?>
     <li class="page-item"><a class="page-link" onclick="paginate_page('<?php echo $last_page_count; ?>','<?php echo $pagination_count; ?>');">Last</a></li>
     <?php } ?>
   </ul>
   <?php } ?>
  </div>
</div>
<script>
   $(document).ready(function(){
     var perpage = '<?php echo $perpage; ?>';
     var count_of_pagination_links = '<?php echo $pagination_count; ?>';
     var curr_pagi_ind = '<?php echo $current_pagination_index; ?>';
     var show_links_count = 3;
   
     if (parseInt(count_of_pagination_links) > show_links_count) {
      var start_index_showing = 0;
      
      if (parseInt(curr_pagi_ind) < show_links_count ) {
        start_index_showing = 1;
      }
      else {
        start_index_showing = parseInt(curr_pagi_ind) - 1;
        show_links_count = parseInt(show_links_count) + parseInt(curr_pagi_ind);
      }
      // alert('start'+start_index_showing);
       $('.paginate_links').hide();
       for (var i = start_index_showing; i <= show_links_count; i++) {
         $('#pagination_link_'+i).show();
       }
     }
   });
</script>