<?php $date_format =common_date_format(); ?>
<style>
  table.table p {
 /*display: none;*/
 visibility: hidden;margin-bottom: 0;
}
table.table tr:hover p {
      /* display: block;*/
      visibility: visible;
}
.lead_table td{
    border-top: solid 1px #ebebeb;
    border-spacing:none;
    cellpadding: 0;
    cellspacing: 0;
    color: #3D3D3D;
    padding: 0px 4px 0px 4px;
    margin-left: 3px !important; 
}
.lead_table td .contact_info{
    white-space: nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
    min-width:47px;
}
.breadcrumb_fonts {
   font-size: 12px !important;
}
.m-portlet .m-portlet__body {
    padding: 0.2rem 2.2rem !important;
}
.tr_size{
   height: 10px !important;
}
.m-subheader {
    padding: 0px 15px 0 15px;
}
.m-body .m-content {
    padding: 0px 15px;
}
.btn.m-btn--custom {
    padding: 5px 12px !important;
}
.m-portlet .m-portlet__head {
    height: 43px !important;
}
.lead_modi_info {
   padding: 1px !important;
}
.active {
  background: #395A9A;
  color: #fff !important;
}
.handshake_hide {
   display: none;
}
</style>
<div class="col-lg-12" >
 <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($lead_lists_count)) ? count($lead_lists_count) : $page + $perpage; ?> of <?php echo count($lead_lists_count); ?> entries</div>
 <div class="col-lg-7"></div>
 <div class="col-lg-3">
  <?php if (count($lead_lists_count) > $perpage) { ?>
  <ul class="pagination">
    <?php if (($page - $perpage) >= 0){ ?>
    <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
    <?php } ?>
    <?php 
      $last_page_count = '';
      $split_list = (int) (count($lead_lists_count) / $perpage);
      $remaining_val = count($lead_lists_count) % $perpage;
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
      <li class="page-item <?php if($i == $current_pagination_index) { echo "active"; } ?>"><a class="page-link paginate_links pagination_link_<?php echo $i; ?>" onclick="paginate_page('<?php echo $page_count; ?>','<?php echo $i; ?>');"><?php echo $i; ?></a></li>
    <?php }  ?>
    <?php if (($page + $perpage) < count($lead_lists_count)) { ?>
    <li class="page-item"><a class="page-link" onclick="paginate_page('<?php echo $last_page_count; ?>','<?php echo $pagination_count; ?>');">Last</a></li>
    <?php } ?>
  </ul>
  <?php } ?>
 </div>
</div>
<hr>
<div class="col-lg-12">
  <div class="col-lg-2">
    <span>Show</span> 
    <select id="perpage" onchange="submit_lead_form('perpage_count');" name="perpage">
      <option <?php echo ($perpage == '10') ? 'selected' : ''; ?> value="10">10</option>
      <option <?php echo ($perpage == '25') ? 'selected' : ''; ?> value="25">25</option>
      <option <?php echo ($perpage == '100') ? 'selected' : ''; ?> value="100">100</option>
    </select>
    <span>Entries</span> 
  </div>
  <div class="col-lg-5"></div>
  <div class="col-lg-5" style="padding: 4px; padding-left: 40px;">
  <!--  <span>Search</span>  <input type="text" name="lead_list_search" id="lead_list_search" style="width: 162px;" value="<?php echo $_SESSION['lead_search_val']; ?>"><button style="padding: 3px; background: #c1c1c1; cursor: pointer;" onclick="search_on_list($('#lead_list_search').val());"><i class="fa fa-search" style="color: #000;"></i></button> -->
  </div>
</div>
<div class="col-lg-12">  
    <table class="table table-responsive table-striped table-bordered table-checkable lead_table" style="width: 100%;">
       <thead>
          <tr>
             <th> 
                Lead Name
             </th>
             <th>Track Lead</th>
             <th>
                Product 
             </th>
             <th>
                Country
             </th>

             <th>
                Lead Source
             </th>
             <th>
                Priority
             </th>
             <th>
                Status
             </th>
             <th>
                Assigned To
             </th>
             <th>
                Comments
             </th>
             <th>
                Created On
             </th>
             
          </tr>
       </thead>
       <tbody>
          <?php 
          $select_all_leads = '';
          $i = 0;
          if(!empty($lead_lists)){
             foreach ($lead_lists as $key=> $lead_list) { ?>
              <tr >
              
             <td class="contact_info">
                
                <span class="pull-left">
                   <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->lead_name; ?>" class="text-black tooltip-animation" style="margin-bottom: 0px; font-weight: bold;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:100px;"><?php echo ucfirst($lead_list->lead_name); ?>
                   </h6>
                </span>
                <h5 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->email_id; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:160px;" class="text-muted tooltip-animation"><b><sub><?php echo $lead_list->email_id; ?></sub><b></b></b></h5>
                
             </td>
             <th>
               <?php
                $get_active_followup_by_lead_id = get_active_followup_by_lead_id($lead_list->lead_id);
              
                if ($lead_list->status == "0" && count($get_active_followup_by_lead_id) == 0) {
                  echo "New Lead";
                }
                else if($lead_list->status == "2") {
                  echo "Archive Lead"; 
                }
                else if($lead_list->status == "3" && count($get_active_followup_by_lead_id) == 0) {
                  echo "Opportunities"; 
                }
                else if(count($get_active_followup_by_lead_id) > 0) {
                  echo "Followup Lead"; 
                }
               ?>
             </th>
             <td>
                <h5 class="text-black"  style="margin-bottom: 0px;"><?php echo $lead_list->product_name; ?></h5>
                <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo $lead_list->industry_name; ?></sub><b></b></b></span>
             </td>
              <td> 
                

                <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->country_name; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:126px;margin-bottom: 0px; float: left; font-size: 14px;" id="country_quick_icon_label_<?php echo $key; ?>" class="tooltip-animation"> <?php echo $lead_list->country_name; ?></h6>
              </td>
            
              <td>
                  <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->sub_source_name." | ".$lead_list->source_name; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:126px;margin-bottom: 0px; float: left; font-size: 14px" class="tooltip-animation">
                    <span  style="margin-bottom: 0px;" id="lead_source_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->sub_source_name; ?></span> <br> 
                    <span style="font-size: 9.5px;" class="text-muted"><b><sub><?php echo $lead_list->source_name; ?></sub><b></b></b></span>
                  </h6>
              </td>
              <td>
                  <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->lead_type_name; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:60px;margin-bottom: 0px; float: left; font-size: 14px" class="tooltip-animation" id="lead_type_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->lead_type_name; ?></h6>
                </td>
             <td>
                 <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->lead_status_name; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:126px;margin-bottom: 0px; float: left; font-size: 14px" class="tooltip-animation" id="lead_status_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->lead_status_name; ?></h6>
             </td>
              <td>
                <?php echo $lead_list->lead_assign_name; ?>
                  
                 
             </td>
             <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:160px;">
                <span style="margin-bottom: 0px;"> <?php echo htmlspecialchars_decode(stripslashes($lead_list->comments)); ?></span>
             </td>
             <td>
               <?php echo date($date_format,strtotime($lead_list->created_on)); ?>
             </td>
            
          </tr>
           <?php $i++; } } else { ?>
            <tr><td colspan="11"><h6 class="text-center">No Records Found..</h6></td></tr>
           <?php } ?> 
       </tbody>
    </table>
    <input type="hidden" id="countchk" value="<?php echo $i; ?>">
 </div>
<div class="col-lg-12" >
 <div class="col-lg-2">Showing <?php echo $page + 1; ?> to <?php echo (($page + $perpage) > count($lead_lists_count)) ? count($lead_lists_count) : $page + $perpage; ?> of <?php echo count($lead_lists_count); ?> entries</div>
 <div class="col-lg-7"></div>
 <div class="col-lg-3">
  <?php if (count($lead_lists_count) > $perpage) { ?>
  <ul class="pagination">
    <?php if (($page - $perpage) >= 0){ ?>
    <li class="page-item"><a class="page-link" onclick="paginate_page('0','1');">First</a></li>
    <?php } ?>
    <?php 
      $last_page_count = '';
      $split_list = (int) (count($lead_lists_count) / $perpage);
      $remaining_val = count($lead_lists_count) % $perpage;
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
      <li class="page-item <?php if($i == $current_pagination_index) { echo "active"; } ?>"><a class="page-link paginate_links pagination_link_<?php echo $i; ?>" onclick="paginate_page('<?php echo $page_count; ?>','<?php echo $i; ?>');"><?php echo $i; ?></a></li>
    <?php }  ?>
    <?php if (($page + $perpage) < count($lead_lists_count)){ ?>
    <li class="page-item"><a class="page-link" onclick="paginate_page('<?php echo $last_page_count; ?>','<?php echo $pagination_count; ?>');">Last</a></li>
    <?php } ?>
  </ul>
  <?php } ?>
 </div>
</div>

 <script>
   // $('#m_table_2').dataTable({ stateSave: true });
   $('.m_selectpicker').selectpicker();
   $('[data-toggle="m-tooltip"]').tooltip();
   $(document).ready(function(){
     var perpage = '<?php echo $perpage; ?>';
     var count_of_pagination_links = '<?php echo (isset($pagination_count)) ? $pagination_count : 0; ?>';
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
         $('.pagination_link_'+i).show();
       }
     }
  });
 </script>
