<?php $date_format =common_date_format(); ?>
<div class="row"> 
  <div class="col-lg-12">
    <div class="col-lg-2">
      <span>Show</span> 
      <select id="perpage" onchange="submit_quote_filter('perpage_count');" name="perpage">
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
               <th>Quote No</th>
               <th>Exporter</th>
               <th>Subject</th>
               <th>Consignee</th>
               <th>No.of Products</th>
               <th>Value</th>
               <th>Stages</th>
               <th>Assigned To</th>
               <th>Comments</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if(count($quote_list) > 0){
              // print_r($quote_list);
              //  die();
             $i=0;foreach ($quote_list as $key => $qlist){

               $quotlist = $this->Quote_model->get_quote_by_id($qlist['qid']);

               $qprod = $this->Quote_model->get_quote_product_by_quote_id($qlist['qid']);
               $get_value_variant_by_quote_Value = get_value_variant_by_value($quotlist->grand_total);
               // $value_based_color = '';
               $value_based_color = ($get_value_variant_by_quote_Value) ? $get_value_variant_by_quote_Value->vv_color : '';
            ?>
            <tr>
               <td>
                  
                  <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['quote_no'];?></h5> <?php if($qlist['qcount']>1){?><span class="m-badge m-badge--info pull-right tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $qlist['qcount']-1; ?> QTN Revised"><?php echo $qlist['qcount']-1; ?></span><?php }?>
                  <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo date($date_format, strtotime($quotlist->created_date)); ?> / <?php echo date($date_format, strtotime($quotlist->valid_till)); ?></sub><b></b></b></span>
                  
               </td> 
               <td>
                  <?php echo $quotlist->exporter_name;?>
               </td>
               <td>
                  <?php echo $quotlist->subject;?>
               </td>
               <td>
                  <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $quotlist->lead_name;?></h5>
                  <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo $quotlist->country_name; ?></sub><b></b></b></span>
               </td>
               <td align="center">
                  <h5 class="text-black"><?php echo count($qprod);?></h5>
               </td>
               <td class="grand_total" style="background-color: <?php echo $value_based_color; ?>;">
                  <h5 class="text-black">
                     <span class="pull-left">
                        <i class="fa fa-rupee-sign"></i>
                     </span>
                     <span class="pull-right"><?php echo number_format($quotlist->grand_total,2);?></span>
                  </h5>
                  <h6 class="text-primary curr_amnt_info">
                     <span class="pull-right"> <?php $convert_curr = $quotlist->grand_total / $quotlist->rate; echo $quotlist->currency_code.' '.number_format($convert_curr,2); ?></span>
                  </h6>
               </td>
               <td>
                  <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $quotlist->quote_stage; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:60px;margin-bottom: 0px; float: left; font-size: 14px" class="tooltip-animation" id="quo_stage_quick_icon_label_<?php echo $key; ?>"> <?php echo $quotlist->quote_stage; ?></h6>
                  <div id="quo_stage_quick_icon_<?php echo $key; ?>" style="display: none;">
                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_quo_stage_id_<?php echo $key; ?>"
                                onchange="quote_stage_change(this.value, '<?php echo $quotlist->quote_id; ?>', 'quote_stage_id', 'quo_stage_quick_icon', <?php echo $key; ?>, 3);" > 
                     <?php
                       if(!empty($quote_stage_list))
                       {
                          foreach ($quote_stage_list as $quote_stage_lis) { if($quote_stage_lis['status'] == 0){ ?>
                             <option value="<?php echo $quote_stage_lis['quote_stage_id']; ?>" <?php echo ($quote_stage_lis['quote_stage_id'] == $quotlist->quote_stage_id) ? 'selected' : ''; ?> ><?php echo $quote_stage_lis['quote_stage']; ?></option>
                          <?php } }
                       }
                    ?>
                   </select>
                  </div>
                  <p class="text-right" style="max-width: 15px;float: right;">
                     <a href="#" data-toggle="modal" id="quick_edit_3_<?php echo $key; ?>" onclick="show_quick_icon('quo_stage_quick_icon', <?php echo $key; ?>, 3);">
                        <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt" ></i>
                     </a>
                     <a style="display: none;" href="#" data-toggle="modal" id="quick_save_3_<?php echo $key; ?>" 
                        onclick="show_quick_pencil_icon('quo_stage_quick_icon', <?php echo $key; ?>, 3);">
                        <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Cancel"><i class="fa fa-undo-alt"></i>
                     </a>
                  </p>
               </td>
               <!-- <td>
                 <h5 class="text-black"><?php echo $quotlist->quote_stage; ?></h5>
               </td> -->
               <td>
                  <?php echo $quotlist->lead_assigned_name;?>
               </td>
               <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:160px;">
                   <p class="text-right">
                     <a href="javascript:;" onclick="view_quote_comments(<?php echo $quotlist->quote_id; ?>);">
                        <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View Comments"><i class="fa fa-comments" ></i></span>
                     </a>
                   </p>
                     <span style="margin-bottom: 0px;"> <?php echo htmlspecialchars_decode(stripslashes($quotlist->comments)); ?></span>
               </td>
               <td>
                  <?php if($_SESSION['Quote ManagementView']==1){ ?>
                  <a href="<?php echo base_url(); ?>quote/quote_view/<?php echo $quotlist->quote_id;?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                  <?php }?>
                  <?php if($_SESSION['Quote ManagementEdit']==1){ ?>
                  <a href="<?php echo base_url(); ?>quote/quote_edit/<?php echo $quotlist->quote_id;?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></span></a>
                  <?php }?>
                  
               </td>
            </tr>
            <?php $i++; } } else { ?>
              <tr><td colspan="10"><h6 class="text-center">No Records Found..</h6></td></tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
   <div class="col-lg-12" >
     <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($quote_list_count)) ? count($quote_list_count) : $page + $perpage; ?> of <?php echo count($quote_list_count); ?> entries</div>
     <div class="col-lg-7"></div>
     <div class="col-lg-3">
      <?php if (count($quote_list_count) > $perpage) { ?>
      <ul class="pagination">
        <?php if (($page - $perpage) >= 0){ ?>
        <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
        <?php } ?>
        <?php 
          $last_page_count = '';
          $split_list = (int) (count($quote_list_count) / $perpage);
          $remaining_val = count($quote_list_count) % $perpage;
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
        <?php if (($page + $perpage) < count($quote_list_count)){ ?>
        <li class="page-item"><a class="page-link" onclick="paginate_page('<?php echo $last_page_count; ?>','<?php echo $pagination_count; ?>');">Last</a></li>
        <?php } ?>
      </ul>
      <?php }  ?>
     </div>
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