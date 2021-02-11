<div class="col-lg-12">
 <div class="col-lg-2">
   <span>Show</span> 
   <select id="perpage" onchange="submit_vendor_filter('perpage_count');" name="perpage">
      <option <?php echo ($perpage == '10') ? 'selected' : ''; ?> value="10">10</option>
      <option <?php echo ($perpage == '25') ? 'selected' : ''; ?> value="25">25</option>
      <option <?php echo ($perpage == '100') ? 'selected' : ''; ?> value="100">100</option>
    </select>
   <span>Entries</span> 
 </div>
 <div class="col-lg-7"></div>
 <div class="col-lg-3" style="padding: 4px; padding-left: 40px;">
  <span>Search</span>  <input type="text" name="lead_list_search" id="lead_list_search" style="width: 162px;" value="<?php echo $search_val; ?>"><button style="padding: 3px; background: #c1c1c1; cursor: pointer;" onclick="search_on_list($('#lead_list_search').val());"><i class="fa fa-search" style="color: #000;"></i></button>
 </div>
</div>
<div class="col-lg-12">
   <table class="table table-striped table-bordered  table-checkable">

      <thead>

         <tr>

            <th>Vendor Name</th>

            <th>Email</th>

            <th>Vendor Type</th>

            <th>Vendor Category</th>

            <th>Product</th>

            <th>Status</th>

            <th class="notexport" data-orderable="false">Action</th>

         </tr>

      </thead>

      <tbody>

         <?php

            if(!empty($vendor_list))

            {

               $i = 1;

               foreach ($vendor_list as $e_list) 

               { 

                  $vendor_product_details = $this->Vendor_model->get_vendor_product_by_id($e_list['vendor_id']);

                  $vparr = []; foreach($vendor_product_details as $vprod){

                     array_push($vparr, $vprod['product_name']);

                  }

                  $vprod = implode(', ', $vparr);

                  ?>

                  <tr>

                     <td>

                        <h5  style="margin-bottom: 0px;">

                        <?php echo $e_list['vendor_name']; ?></h5>

                        <span style="font-size: 16.5px;" class="text-muted"><b><sub> <?php echo $e_list['phone_no']; ?> 

                        </sub><b></b></b></span>    

                     </td>

                     <td>

                        <?php echo $e_list['email_id']; ?>   

                     </td>

                     <td>

                        <?php echo $e_list['vendor_type']; ?>   

                     </td>

                     <td>

                        <?php echo $e_list['vendor_category']; ?>   

                     </td>

                     <td>

                        <?php echo str_replace(',', ', ', $vprod); ?>   

                     </td>

                     <td>

                        <span class="m-switch m-switch--sm m-switch--success"  data-toggle="m-tooltip" data-placement="top" title="<?php if($e_list['status']==0){ echo 'Active'; }else{ echo 'In Active'; } ?>">

                        <label>

                           <input type="checkbox" <?php if($e_list['status']==0){ echo "checked";} ?> name="activeunactive_<?php echo $i;?>" id="activeunactive_<?php echo $i;?>" onchange="activeunactive(<?php echo $e_list['vendor_id']; ?>,<?php echo $i; ?>)" value="<?php echo $e_list['status'];?>">

                           <span></span>

                        </label>

                        </span>

                     </td>

                     <td>

                           <?php if($_SESSION['VendorView']==1){ ?>

                           <a href="<?php echo base_url(); ?>vendor/vendor_view/<?php echo $e_list['vendor_id']; ?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;

                           <?php }?>

                           <?php if($_SESSION['VendorEdit']==1){ ?>

                           <a href="<?php echo base_url(); ?>vendor/vendor_edit/<?php echo $e_list['vendor_id']; ?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;

                           <?php }?>

                           <?php if($_SESSION['VendorDelete']==1){ ?>                                              

                           <a href="javascript:;" data-toggle="modal" data-target="#vendor_delete" onclick="return vendor_delete(<?php echo $e_list['vendor_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></span></a>

                           <?php }?>

                        

                     </td>

                  </tr>

                  

            <?php   $i++; }

            } else {?>
              <tr><td colspan="7"><h6 class="text-center">No Records Found..</h6></td></tr>
            <?php } ?>

      </tbody>

   </table>
</div>
<div class="col-lg-12">
  <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($vendor_list_count)) ? count($vendor_list_count) : $page + $perpage; ?> of <?php echo count($vendor_list_count); ?> entries</div>
  <div class="col-lg-7"></div>
  <div class="col-lg-3">
   <?php if (count($vendor_list_count) > $perpage) { ?>
   <ul class="pagination">
     <?php if (($page - $perpage) >= 0){ ?>
     <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
     <?php } ?>
     <?php 
       $last_page_count = '';
       $split_list = (int) (count($vendor_list_count) / $perpage);
       $remaining_val = count($vendor_list_count) % $perpage;
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
     <?php if (($page + $perpage) < count($vendor_list_count)){ ?>
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