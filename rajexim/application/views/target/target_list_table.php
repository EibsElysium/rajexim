<div class="col-lg-12">
   <div class="col-lg-2">
     <span>Show</span> 
     <select id="perpage" onchange="submit_target_form('perpage_count');" name="perpage">
      <option <?php echo ($perpage == '10') ? 'selected' : ''; ?> value="10">10</option>
      <option <?php echo ($perpage == '25') ? 'selected' : ''; ?> value="25">25</option>
      <option <?php echo ($perpage == '100') ? 'selected' : ''; ?> value="100">100</option>
    </select>
     <span>Entries</span> 
   </div>
   <div class="col-lg-7"></div>
   <div class="col-lg-3" style="padding: 4px;">
    <span>Search</span>  <input type="text" name="lead_list_search" id="lead_list_search" style="width: 100px;" value="<?php echo $search_val; ?>"><button style="padding: 3px; background: #c1c1c1; cursor: pointer;" onclick="search_on_list($('#lead_list_search').val());"><i class="fa fa-search" style="color: #000;"></i></button>
   </div>
</div>
<div class="col-lg-12">
   <table class="table table-striped table-bordered table-hover table-checkable">
      <thead>
         <tr>
            <th width="120px">Product</th>
            <th data-orderable="false">Quote</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         if (count($get_all_target_by_target) > 0) {
         foreach ($get_all_target_by_target as $key => $target) { ?>
         <tr>
            <td><?php echo $target->product_name; ?></td>
            <td>
               
               <span  style="margin-bottom: 0px;" id="quote_quick_icon_label_<?php echo $key; ?>"> <?php echo $target->quote; ?></span>
               <?php $exp_yr = explode('-', $year); $yr1 = $exp_yr[0]; 
                  if (date('Y') <= $yr1) { ?>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <span class="text-right">
                  <a href="#" data-toggle="modal" id="quick_edit_1_<?php echo $key; ?>" onclick="show_quick_icon('quote_quick_icon', <?php echo $key; ?>, 1);">
                     <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt" ></i>
                  </a>
                  <a style="display: none;" href="#" data-toggle="modal" id="quick_save_1_<?php echo $key; ?>" 
                     onclick="show_quick_pencil_icon('quote_quick_icon', <?php echo $key; ?>, 1);">
                     <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Cancel"><i class="fa fa-undo-alt"></i>
                  </a>
               </span>
               <?php } ?>
               <div id="quote_quick_icon_<?php echo $key; ?>" style="display: none; width: 352px;">
                     <input type="text" name="quote_count[]" id = "quote_count_<?php echo $key; ?>" class = "form-control tar_count" value = "<?php echo $target->quote; ?>" onblur="update_target_counts(this.value,'<?php echo $target->target_id ?>','quote','quote_quick_icon','<?php echo $key; ?>',1);"  >
                 </div>
            </td>
            <!-- onblur="lead_status_type_change(this.value,'<?php echo $target->lead_id; ?>','country','country_quick_icon',<?php echo $key; ?>,1);" value = "<?php echo $target->quote; ?>" -->
         </tr>
         <?php } } else { ?>
            <tr><td colspan="2"><p class="text-center">No Records Found..</p></td></tr>
         <?php } ?>
      </tbody>
   </table>
</div>
<div class="col-lg-12">
  <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($get_all_target_by_target_count)) ? count($get_all_target_by_target_count) : $page + $perpage; ?> of <?php echo count($get_all_target_by_target_count); ?> entries</div>
  <div class="col-lg-7"></div>
  <div class="col-lg-3">
   <?php if (count($get_all_target_by_target_count) > $perpage) { ?>
   <ul class="pagination">
     <?php if (($page - $perpage) >= 0){ ?>
     <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
     <?php } ?>
     <?php 
       $last_page_count = '';
       $split_list = (int) (count($get_all_target_by_target_count) / $perpage);
       $remaining_val = count($get_all_target_by_target_count) % $perpage;
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
     <?php if (($page + $perpage) < count($get_all_target_by_target_count)){ ?>
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