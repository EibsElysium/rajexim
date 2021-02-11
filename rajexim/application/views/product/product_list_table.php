<div class="col-lg-12">
   <div class="col-lg-2">
     <span>Show</span> 
     <select id="perpage" onchange="submit_product_filter('perpage_count');" name="perpage">
      <option <?php echo ($perpage == '10') ? 'selected' : ''; ?> value="10">10</option>
      <option <?php echo ($perpage == '25') ? 'selected' : ''; ?> value="25">25</option>
      <option <?php echo ($perpage == '100') ? 'selected' : ''; ?> value="100">100</option>
    </select>
      <span>Entries</span>
   </div>
   <div class="col-lg-7"></div>
   <div class="col-lg-3" style="padding: 4px; padding-left: 45px;">
    <span>Search</span>  <input type="text" style="width: 162px;" name="lead_list_search" id="lead_list_search" value="<?php echo $search_val; ?>"><button style="padding: 3px; background: #c1c1c1; cursor: pointer;" onclick="search_on_list($('#lead_list_search').val());"><i class="fa fa-search" style="color: #000;"></i></button>
   </div>
</div>
<div class="col-lg-12">  
   <table class="table table-striped table-bordered table-hover table-checkable">
      <thead>
         <tr>
            <th>Product</th>
            <th>Product For Lead</th>
            <th>Product For Vendor</th>
            <th>Status</th>
            <th class="notexport" data-orderable="false">Action</th>
         </tr>
      </thead>
      <tbody>
      	<?php
         if (count($product_lists) > 0) {
			$i=1; foreach ($product_lists as $product_list ) { ?>
			<tr>
				<td>
               <h5  style="margin-bottom: 0px;"><?php echo $product_list->product_name; ?></h5>
               <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo $product_list->industry_name; ?></sub><b></b></b></span>
            </td>
            <td align="center"><?php echo ($product_list->for_lead == 1) ? "Yes" : "No"; ?></td>
            <td align="center"><?php echo ($product_list->for_vendor == 1) ? "Yes" : "No"; ?></td>
				<td>
					<span class="m-switch m-switch--sm m-switch--success" title=<?php if($product_list->status==0){echo "Active";} else{echo "Inactive";} ?>>
						<label>
							<input type="checkbox" <?php if($product_list->status==0){echo "checked";} ?> id="activeunactive_<?php echo $i;?>"  name="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $product_list->product_id; ?>,<?php echo $i; ?>)" value="<?php echo $product_list->status;?>"  data-plugin="switchery" data-color="#3f3e6a" data-size="small">
							<span></span>
						</label>
					</span>
				</td>
				<td>
               <?php if($_SESSION['Product ListView']==1){ ?>
					<a href="#" data-toggle="modal" onclick="product_view(<?php echo $product_list->product_id; ?>)" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Product Info"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
               <?php } ?>
               <?php if($_SESSION['Product ListEdit']==1){ ?>
					<a href="javascript:;" data-toggle="m-tooltip" data-placement="top" title="Edit"><span onclick="product_edit(<?php echo $product_list->product_id; ?>)" class="tooltip-animation"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
               <?php } ?>
               <?php if($_SESSION['Product ListDelete']==1){ ?>
					<a href="#" onclick="return product_delete(<?php echo $product_list->product_id; ?>)" data-toggle="m-tooltip" data-placement="top" title="Delete"><span class="tooltip-animation"><i class="fa fa-trash-alt"></i></span></a>
               <?php } ?>
				</td>
			</tr>
			<?php $i++;  } } else { ?>
            <tr><td colspan="5"><p class="text-center">No Records Found..</p></td></tr>
         <?php } ?>
      </tbody>
   </table>
</div>
<div class="col-lg-12">
  <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($product_lists_count)) ? count($product_lists_count) : $page + $perpage; ?> of <?php echo count($product_lists_count); ?> entries</div>
  <div class="col-lg-7"></div>
  <div class="col-lg-3">
   <?php if (count($product_lists_count) > $perpage) { ?>
   <ul class="pagination">
     <?php if (($page - $perpage) >= 0){ ?>
     <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
     <?php } ?>
     <?php 
       $last_page_count = '';
       $split_list = (int) (count($product_lists_count) / $perpage);
       $remaining_val = count($product_lists_count) % $perpage;
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
     <?php if (($page + $perpage) < count($product_lists_count)){ ?>
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