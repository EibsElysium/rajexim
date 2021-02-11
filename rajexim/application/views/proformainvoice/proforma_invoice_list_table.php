<?php $date_format =common_date_format(); ?>
 <div class="col-lg-12">
    <div class="col-lg-2">
      <span>Show</span> 
     <select id="perpage" onchange="submit_pi_filter('perpage_count');" name="perpage">
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
      <table class="table table-striped- table-bordered table-hover table-checkable" style="max-width: 100%; min-width: 100%; ">
         <thead>
            <tr>
               <th>Invoice No / Date</th>
               <th>Exporter</th>
               <th>Consignee</th>
               <th>No.of Products</th>
               <th>Country</th>
               <th>Stages</th>
               <th>Comments</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php 
            if(count($proforma_invoice_list) > 0){
            $i=0;foreach ($proforma_invoice_list as $key => $qlist){
               $qprod = $this->Proformainvoice_model->get_proforma_invoice_product_by_id($qlist['proforma_invoice_id']);
               ?>
            <tr>
               <td>
                  
                  <h5 class="text-black" style="margin-bottom: 0px;"><?php echo $qlist['proforma_invoice_no'];?></h5>
                  <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo date($date_format, strtotime($qlist['proforma_invoice_date'])); ?></sub><b></b></b></span>
                  
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
                  <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $qlist['pi_stage']; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:60px;margin-bottom: 0px; float: left; font-size: 14px" class="tooltip-animation" id="quo_stage_quick_icon_label_<?php echo $key; ?>"> <?php echo $qlist['pi_stage']; ?></h6>
                  <div id="quo_stage_quick_icon_<?php echo $key; ?>" style="display: none;">
                   <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_quo_stage_id_<?php echo $key; ?>"
                                onchange="quote_stage_change(this.value, '<?php echo $qlist['proforma_invoice_id']; ?>', 'pi_stage_id', 'quo_stage_quick_icon', <?php echo $key; ?>, 3);" > 
                     <?php
                       if(!empty($pi_stage_list))
                       {
                          foreach ($pi_stage_list as $pi_stage_lis) { if($pi_stage_lis['status'] == 0){ ?>
                             <option value="<?php echo $pi_stage_lis['pi_stage_id']; ?>" <?php echo ($pi_stage_lis['pi_stage_id'] == $qlist['pi_stage_id']) ? 'selected' : ''; ?> ><?php echo $pi_stage_lis['pi_stage']; ?></option>
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
               <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:160px;">
                   <p class="text-right">
                     <a href="javascript:;" onclick="view_quote_comments(<?php echo $qlist['quote_id']; ?>);">
                        <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View Comments"><i class="fa fa-comments" ></i></span>
                     </a>
                   </p>
                     <span style="margin-bottom: 0px;"> <?php echo htmlspecialchars_decode(stripslashes($qlist['comments'])); ?></span>
               </td>
               <td>
                  <?php if($_SESSION['Proforma InvoiceView']==1){ ?>
                  <a href="<?php echo base_url(); ?>proformainvoice/proformainvoice_view/<?php echo $qlist['proforma_invoice_id'];?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                  <?php }?>
                  <?php if($qlist['status']==0 && $_SESSION['Proforma InvoiceEdit']==1){ ?>
                  <a href="<?php echo base_url(); ?>proformainvoice/proformainvoice_edit/<?php echo $qlist['proforma_invoice_id'];?>"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
                  <?php }?>
                  <?php if($_SESSION['Proforma InvoicePrint']==1 && $qlist['is_local']==0){ ?>
                  <a href="<?php echo base_url();?>proformainvoice/proformainvoice_print/<?php echo $qlist['proforma_invoice_id'];?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="PI Print"><i class="fa fa-print"></i></span></a>&nbsp;&nbsp;
                  <?php } ?>
                  <?php if($_SESSION['Proforma InvoicePrint']==1 && $qlist['is_local']==0){ ?>
                  <a href="<?php echo base_url();?>proformainvoice/proformainvoice_sc_print/<?php echo $qlist['proforma_invoice_id'];?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="SC Print"><i class="la la-print"></i></span></a>&nbsp;&nbsp;
                  <?php } ?>
                  <?php if($_SESSION['Proforma InvoicePrint']==1 && $qlist['is_local']==1){ ?>
                  <a href="<?php echo base_url();?>proformainvoice/proformainvoice_local_print/<?php echo $qlist['proforma_invoice_id'];?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Local PI Print"><i class="fa fa-print"></i></span></a>&nbsp;&nbsp;
                  <?php } ?>
                  <?php if($qlist['status']==0){?>
               <?php if($_SESSION['Proforma InvoiceDocument_upload']==1){ ?>
               <a href="<?php echo base_url(); ?>proformainvoice/proformainvoice_confirm_upload/<?php echo $qlist['proforma_invoice_id']; ?>">
                  <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Upload Confirmed Invoice" ><i class="fa fa-file-upload"></i></span>
               </a>&nbsp;&nbsp;
               <?php } ?>
            <?php } ?>
               </td>
            </tr>
            <?php $i++; } } else { ?>
              <tr><td colspan="8"><h6 class="text-center">No Records Found..</h6></td></tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
   <div class="col-lg-12" >
     <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($pi_list_count)) ? count($pi_list_count) : $page + $perpage; ?> of <?php echo count($pi_list_count); ?> entries</div>
     <div class="col-lg-7"></div>
     <div class="col-lg-3">
      <?php if (count($pi_list_count) > $perpage) { ?>
      <ul class="pagination">
        <?php if (($page - $perpage) >= 0){ ?>
        <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
        <?php } ?>
        <?php 
          $last_page_count = '';
          $split_list = (int) (count($pi_list_count) / $perpage);
          $remaining_val = count($pi_list_count) % $perpage;
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
        <?php if (($page + $perpage) < count($pi_list_count)){ ?>
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