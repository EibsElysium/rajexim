<?php $date_format =common_date_format(); ?>
<div class="col-lg-12">
 <div class="col-lg-2">
   <span>Show</span> 
   <select id="perpage" onchange="submit_spo_filter('perpage_count');" name="perpage">
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
            <th>SPO No / Date</th>
            <th>Vendor</th>
            <th>Lead</th>
            <th>Number of Product</th>
            <th>Amount</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         if(count($supplierpo_list) > 0){
         $i=0;foreach ($supplierpo_list as $qlist){
            ?>
         <tr>
            <td>
               <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['supplier_purchase_order_no'];?></h5>
               <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo date($date_format, strtotime($qlist['supply_date'])); ?></sub><b></b></b></span>
               
            </td> 
            <td>
               <?php echo $qlist['vendor_name'];?>
            </td>
            <td>
               <?php echo $qlist['lead_name'];?>
            </td>
            <td align="center">
               <!-- <h5 class="text-black"><?php echo $qlist['product_name'].' - '.$qlist['product_item'];?></h5> -->
               <h5 class="text-black"><?php $get_spo_pro = common_select_values('*','supplier_purchase_order_product','supplier_purchase_order_id = "'.$qlist['supplier_purchase_order_id'].'"','result'); echo count($get_spo_pro);?></h5>
            </td>
            <td align="center">
               <?php echo number_format($qlist['total_amount'],2);?>
            </td>
            <td>

               <?php if($_SESSION['Supplier POView']==1){?>
               <a href="<?php echo base_url(); ?>supplierpo/supplierpo_view/<?php echo $qlist['supplier_purchase_order_id']; ?>">
                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></span>
               </a>&nbsp;&nbsp;
               <?php }?>
               <?php if($_SESSION['Supplier POEdit']==1 && $qlist['status']!=2 && $qlist['cancel_status'] ==0 && $qlist['is_complete']==0){?>
               <a href="<?php echo base_url(); ?>supplierpo/supplierpo_edit/<?php echo $qlist['supplier_purchase_order_id']; ?>">
                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span>
               </a>&nbsp;&nbsp;
               <?php }?>
               <?php if($_SESSION['Supplier POComplete']==1){ ?>
               <?php if($qlist['is_complete']==0){ ?>
               <a href="javascript:;" data-toggle="modal" data-target="#spo_complete" onclick="return spo_complete(<?php echo $qlist['supplier_purchase_order_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Complete"><i class="fa fa-check-circle"></i></span>
               </a>
               <?php } } ?>
            </td>
         </tr>
         <?php $i++;} } else { ?>
          <tr><td colspan="6"><h6 class="text-center">No Records Found..</h6></td></tr>
         <?php } ?>
      </tbody>
   </table>
</div>

<div class="col-lg-12">
  <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($supplierpo_list_count)) ? count($supplierpo_list_count) : $page + $perpage; ?> of <?php echo count($supplierpo_list_count); ?> entries</div>
  <div class="col-lg-7"></div>
  <div class="col-lg-3">
   <?php if (count($supplierpo_list_count) > $perpage) { ?>
   <ul class="pagination">
     <?php if (($page - $perpage) >= 0){ ?>
     <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
     <?php } ?>
     <?php 
       $last_page_count = '';
       $split_list = (int) (count($supplierpo_list_count) / $perpage);
       $remaining_val = count($supplierpo_list_count) % $perpage;
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
     <?php if (($page + $perpage) < count($supplierpo_list_count)){ ?>
     <li class="page-item"><a class="page-link" onclick="paginate_page('<?php echo $last_page_count; ?>','<?php echo $pagination_count; ?>');">Last</a></li>
     <?php } ?>
   </ul>
   <?php } ?>
  </div>
</div>
<script>
   $('[data-toggle="m-tooltip"]').tooltip();
   $(document).ready(function(){
     var perpage = '<?php echo $perpage; ?>';
     var count_of_pagination_links = '<?php echo $pagination_count; ?>';
     var curr_pagi_ind = '<?php echo $current_pagination_index; ?>';
     var show_links_count = 3;

     if (parseInt(count_of_pagination_links) > show_links_count) {
      var start_index_showing = 0;
      // alert('curr'+curr_pagi_ind);
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