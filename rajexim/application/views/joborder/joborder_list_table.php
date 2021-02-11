<?php $date_format =common_date_format(); ?>
<div class="col-lg-12">
   <div class="col-lg-2">
     <span>Show</span> 
     <select id="perpage" onchange="submit_jo_filter('perpage_count');" name="perpage">
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
            <th>JO No</th>
            <th>JO Duration</th>
            <th>SPO No</th>
            <th>Product</th>
            <th>Assigned To</th>
            <th class="notexport" data-orderable="false">Action</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         if(count($joborder_list) > 0) {
         $i=0;foreach ($joborder_list as $qlist){

            $joborder_items = $this->Joborder_model->get_joborder_item_by_id($qlist['job_order_id']);

            $abspath = getcwd();
            $filecount = 0;
            $jo_folder_path = str_replace('/', '-', $qlist['job_order_no'])."/";
            $baseFileLocation = '/assets/joborder/'.$jo_folder_path;
              $files = glob($abspath.$baseFileLocation . "*");
              if ($files){
               $filecount = count($files);
              }
              else
              {
                $filecount=0;
              }
            ?>
         <tr>
            <td>
               <span class="pull-left">
                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $qlist['lead_name'];?>"><?php echo $qlist['job_order_no']; ?>
                              </span>
                           </span>
               <?php if($filecount>0){?>
                           <span class="pull-right" data-toggle="modal" data-target="#load_doc">
                              <a href="javascript:;" class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Loading Document Info" onclick="joborder_load_doc('<?php echo $qlist['job_order_id']; ?>')">
                                 <i class="fa fa-file-image text-success"></i>
                              </a>
                           </span>
                           <?php }?>
            </td> 
            <td><?php echo date($date_format, strtotime($qlist['job_order_date']));?> - <?php echo date($date_format, strtotime($qlist['job_order_end_date']));?>
            </td>
            <td>
               <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $qlist['vendor_name'];?>"><?php echo $qlist['supplier_purchase_order_no']; ?>
               </span>
            </td>
            <td><?php echo $qlist['product_name'].' - '.$qlist['product_item'];?></td>
            <td><?php echo $qlist['display_name']; ?></td>
            <td>

               <a href="<?php echo base_url(); ?>joborder/joborder_print/<?php echo $qlist['job_order_id']; ?>" target="_blank">
               <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="JO Print"><i class="la la-print"></i></span>
               </a>&nbsp;&nbsp;
               <?php if($_SESSION['Job OrderView']==1){?>
               <a href="javascript:;" data-toggle="modal" data-target="#view_joborder"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View" onclick="joborder_view('<?php echo $qlist['job_order_id']; ?>')"><i class="fa fa-eye"></i></span></a>&nbsp;&nbsp;
               <?php }?>
               <?php if($_SESSION['Job OrderEdit']==1 && $qlist['status']==0 && $qlist['status'] !=2 && $qlist['is_complete']==0){?>
               <a href="javascript:;" data-toggle="modal" data-target="#edit_joborder"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit" onclick="joborder_edit('<?php echo $qlist['job_order_id']; ?>')"><i class="fa fa-pencil-alt"></i></span></a>&nbsp;&nbsp;
               <?php }?>
               <?php if($_SESSION['Job OrderProcess']==1){?>
               <a href="javascript:;" data-toggle="modal" data-target="#process_joborder"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Process Job Order" onclick="joborder_process('<?php echo $qlist['job_order_id']; ?>')"><i class="fa fa-spinner"></i></span></a>&nbsp;&nbsp;
               <?php }?>
               <?php if($_SESSION['Job OrderInspect']==1){?>
               <a href="javascript:;" data-toggle="modal" data-target="#inspect_joborder"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Inspect Job Order" onclick="joborder_inspect('<?php echo $qlist['job_order_id']; ?>')"><i class="fa fa-clipboard-check"></i></span></a>&nbsp;&nbsp;
               <?php }?>
               <?php if($_SESSION['Job OrderLoading Document']==1){ ?>
               <a href="<?php echo base_url();?>joborder/loading_joborder_document/<?php echo $qlist['job_order_id'];?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Loading Document"><i class="fa fa-file-upload"></i></span></a>&nbsp;&nbsp;
               <?php }?>
               <?php if(count($joborder_items)>0 && $qlist['status'] !=2){?>
               <a href="<?php echo base_url(); ?>joborder/joborder_inspection_print/<?php echo $qlist['job_order_id']; ?>" target="_blank">
                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Inspection Print"><i class="fa fa-print"></i></span>
               </a>&nbsp;&nbsp;
               <?php }?>
               <?php if($_SESSION['Job OrderComplete']==1){ ?>
               <?php if($qlist['is_complete']==0){ ?>
               <a href="javascript:;" data-toggle="modal" data-target="#jo_complete" onclick="return jo_complete(<?php echo $qlist['job_order_id']; ?>);" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Complete"><i class="fa fa-check-circle"></i></span></a>
               <?php } } ?>
            </td>
         </tr>
         <?php $i++; } }else { ?>
          <tr><td colspan="6"><h6 class="text-center">No Records Found..</h6></td></tr>
         <?php } ?>
      </tbody>
   </table>
</div>
<div class="col-lg-12">
  <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($joborder_list_count)) ? count($joborder_list_count) : $page + $perpage; ?> of <?php echo count($joborder_list_count); ?> entries</div>
  <div class="col-lg-7"></div>
  <div class="col-lg-3">
   <?php if (count($joborder_list_count) > $perpage) { ?>
   <ul class="pagination">
     <?php if (($page - $perpage) >= 0){ ?>
     <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
     <?php } ?>
     <?php 
       $last_page_count = '';
       $split_list = (int) (count($joborder_list_count) / $perpage);
       $remaining_val = count($joborder_list_count) % $perpage;
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
     <?php if (($page + $perpage) < count($joborder_list_count)){ ?>
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