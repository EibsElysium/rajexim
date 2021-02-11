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
      <?php if (($page + $perpage) < count($lead_lists_count)){ ?>
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
   <span id="save_temp_btn">
    <a href="javascript:;" onclick="save_filt_temp();" <?php if($save_temp_btn_flag != '1'){ ?> style="display: none;" <?php } ?> class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
      <span>
        <!-- <i class="fa fa-filter"></i> -->
         <span>Save as Template</span>
      </span>
    </a>
   </span>&nbsp;&nbsp;&nbsp;&nbsp;<span <?php if($save_temp_btn_flag != '1'){ ?> style="margin-left: 128px;" <?php } ?> >Search</span>  <input type="text" name="lead_list_search" id="lead_list_search" style="width: 162px;" value="<?php echo $search_val; ?>"><button style="padding: 3px; background: #c1c1c1; cursor: pointer;" onclick="search_on_list($('#lead_list_search').val());"><i class="fa fa-search" style="color: #000;"></i></button>
  </div>
</div>
<div class="col-lg-12">  
  <?php // echo "<pre>" print_r($lead_lists); ?>
  <table class="table table-responsive table-striped table-bordered table-checkable lead_table">
     <thead>
        <tr>
           <th data-sortable="false">
              <label class="m-checkbox m-checkbox--bold m-checkbox--state-info">
                   <input id="allchk" type="checkbox" onclick="overall_chk();">
                   <span style="top:-10px;left:5px;"></span>
              </label>
           </th>
           <th>
             <div class="row">
                <div class="col-md-8">
                  Lead Name
                </div>
                <div class="col-md-4">
                  <input type="hidden" name="leadname_sort" id="leadname_sort" value="<?php echo $leadname_sort; ?>">
                  <i onclick="$('#created_on_sort').val('');$('#product_sort').val('');$('#country_sort').val('');$('#leadsource_sort').val('');$('#priority_sort').val('');$('#status_sort').val('');$('#user_sort').val('');var flag = $('#leadname_sort').val(); if(flag == '0'){ flag = '1' }else { flag = '0'; } $('#leadname_sort').val(flag); submit_lead_form('filter');" class="fa fa-fw fa-sort"></i>
                </div>
              </div> 
           </th>
           <th>
              <div class="row">
                <div class="col-lg-12">
                  Product
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  <select onchange="submit_lead_form('filter');" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="list_product[]" multiple id="list_product" >
                      <option value="">All Product</option>
                         <?php
                            if(!empty($product_lists))
                            {
                               foreach ($product_lists as  $product_list) { if($product_list->status == 0){ ?>
                                  <option <?php echo (in_array($product_list->product_id, $list_product)) ? 'selected' : ''; ?> value="<?php echo $product_list->product_id; ?>" <?php if($product_list->product_id == $list_product && $list_product != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo $product_list->product_name; ?></option>
                               <?php } }
                            }
                         ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="hidden" name="product_sort" id="product_sort" value="<?php echo $product_sort; ?>">
                  <i onclick="$('#leadname_sort').val('');$('#created_on_sort').val('');$('#country_sort').val('');$('#leadsource_sort').val('');$('#priority_sort').val('');$('#status_sort').val('');$('#user_sort').val('');var flag = $('#product_sort').val(); if(flag == '0'){ flag = '1' }else { flag = '0'; } $('#product_sort').val(flag); submit_lead_form('filter');" class="fa fa-fw fa-sort"></i>
                </div>
              </div>
             </th>

             <th>
              <div class="row">
                <div class="col-lg-12">
                  Country
                </div>
              </div>
               <div class="row">
                <div class="col-md-8">
                  <select class="form-control m-bootstrap-select m_selectpicker" onchange="submit_lead_form('filter');" data-live-search="true" name="list_lead_country" id="list_lead_country" >
                    <option value="">All Country</option>
                    <?php
                       if(!empty($country_lists))
                       {
                          foreach ($country_lists as $country_list) {  ?>
                             <option <?php echo($list_lead_country == $country_list->id) ? 'selected' : ''; ?> value="<?php echo $country_list->id; ?>"><?php echo $country_list->name; ?></option>
                          <?php } 
                       }
                    ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="hidden" name="country_sort" id="country_sort" value="<?php echo $country_sort; ?>">
                  <i onclick="$('#leadname_sort').val('');$('#created_on_sort').val('');$('#product_sort').val('');$('#leadsource_sort').val('');$('#priority_sort').val('');$('#status_sort').val('');$('#user_sort').val('');var flag = $('#country_sort').val(); if(flag == '0'){ flag = '1' }else { flag = '0'; } $('#country_sort').val(flag); submit_lead_form('filter');" class="fa fa-fw fa-sort"></i>
                </div>
              </div>
             </th>

             <th>
              <div class="row">
                <div class="col-lg-12">
                  Lead Source
                </div>
              </div>
               <div class="row">
                  <div class="col-md-8">
                    <select class="form-control m-bootstrap-select m_selectpicker" onchange="submit_lead_form('filter');" data-live-search="true" name="list_lead_source" id="list_sub_lead_source" >
                      <option value="">All Lead Source</option>
                      <?php
                         if(!empty($sub_lead_sources))
                         {
                            foreach ($sub_lead_sources as $sls_list) {  ?>
                               <option <?php echo($list_lead_source == $sls_list->sub_lead_source_id) ? 'selected' : ''; ?> value="<?php echo $sls_list->sub_lead_source_id; ?>"><?php echo $sls_list->sub_lead_source; ?></option>
                            <?php } 
                         }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <input type="hidden" name="leadsource_sort" id="leadsource_sort" value="<?php echo $leadsource_sort; ?>">
                    <i onclick="$('#leadname_sort').val('');$('#created_on_sort').val('');$('#product_sort').val('');$('#country_sort').val('');$('#priority_sort').val('');$('#status_sort').val('');$('#user_sort').val('');var flag = $('#leadsource_sort').val(); if(flag == '0'){ flag = '1' }else { flag = '0'; } $('#leadsource_sort').val(flag); submit_lead_form('filter');" class="fa fa-fw fa-sort"></i>
                  </div>
                </div>
             </th>
             <th>
              <div class="row">
                <div class="col-lg-12">
                  Priority
                </div>
              </div>
               <div class="row">
                <div class="col-md-8">
                  <select class="form-control m-bootstrap-select m_selectpicker" onchange="submit_lead_form('filter');" data-live-search="true" name="list_lead_type" id="list_lead_type">
                      <option value="">All Priority</option>
                         <?php
                            if(!empty($lead_type_lists))
                            {
                               foreach ($lead_type_lists as $lead_type) { if($lead_type->status == 0){ ?>
                                  <option <?php echo ($list_lead_type == $lead_type->lead_type_id) ? 'selected' : ''; ?> value="<?php echo $lead_type->lead_type_id; ?>" <?php if($lead_type->lead_type_id == $list_lead_type && $list_lead_type != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo $lead_type->lead_type; ?></option>
                               <?php } }
                            }
                         ?>
                   </select>
                </div>
                <div class="col-md-4">
                  <input type="hidden" name="priority_sort" id="priority_sort" value="<?php echo $priority_sort; ?>">
                  <i onclick="$('#leadname_sort').val('');$('#created_on_sort').val('');$('#product_sort').val('');$('#country_sort').val('');$('#leadsource_sort').val('');$('#status_sort').val('');$('#user_sort').val('');var flag = $('#priority_sort').val(); if(flag == '0'){ flag = '1' }else { flag = '0'; } $('#priority_sort').val(flag); submit_lead_form('filter');" class="fa fa-fw fa-sort"></i>
                </div>
              </div>
             </th>
             <th>
              <div class="row">
                <div class="col-lg-12">
                  Status
                </div>
              </div>
                <div class="row">
                  <div class="col-md-8">
                     <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" onchange="submit_lead_form('filter');" name="list_lead_status" id="list_lead_status" >
                        <option value="">All Opportunity Status</option>
                        <?php
                           if(!empty($oppo_status_lists))
                           {
                              foreach ($oppo_status_lists as  $oppo_status_list) { if($oppo_status_list->status == 0){ ?>
                                 <option <?php echo ($oppo_status_list->oppo_status_id == $list_lead_status) ? 'selected' : ''; ?> value="<?php echo $oppo_status_list->oppo_status_id; ?>" <?php if($oppo_status_list->oppo_status_id == $list_lead_status && $list_lead_status != '') { echo 'selected';}else{ echo '' ;} ?> ><?php echo
                                  $oppo_status_list->oppo_status; ?></option>
                              <?php } }
                           }
                        ?>
                     </select>
                  </div>
                  <div class="col-md-4">
                    <input type="hidden" name="status_sort" id="status_sort" value="<?php echo $status_sort; ?>">
                    <i onclick="$('#leadname_sort').val('');$('#created_on_sort').val('');$('#product_sort').val('');$('#country_sort').val('');$('#leadsource_sort').val('');$('#priority_sort').val('');$('#user_sort').val('');var flag = $('#status_sort').val(); if(flag == '0'){ flag = '1' }else { flag = '0'; } $('#status_sort').val(flag); submit_lead_form('filter');" class="fa fa-fw fa-sort"></i>
                  </div>
                </div>
             </th>
             <th>
              <div class="row">
                <div class="col-lg-12">
                  Assigned To
                </div>
              </div>
                <div class="row">
                  <div class="col-md-8">
                    <select class="form-control m-bootstrap-select m_selectpicker" onchange="submit_lead_form('filter');" data-live-search="true" name="filt_assign_to[]" multiple id="filt_assign_to">
                        <option value="">All Assigned to</option>
                        <?php
                           if(!empty($assigned_user_lists))
                           {
                              foreach ($assigned_user_lists as  $assigned_user_list) { ?>
                                 <option <?php echo (in_array($assigned_user_list->user_id, $selected_lead_ass)) ? 'selected' : ''; ?> value="<?php echo $assigned_user_list->user_id; ?>"><?php echo $assigned_user_list->name; ?></option>
                              <?php } 
                           }
                        ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <input type="hidden" name="user_sort" id="user_sort" value="<?php echo $user_sort; ?>">
                    <i onclick="$('#leadname_sort').val('');$('#created_on_sort').val('');$('#product_sort').val('');$('#country_sort').val('');$('#leadsource_sort').val('');$('#priority_sort').val('');$('#status_sort').val('');var flag = $('#user_sort').val(); if(flag == '0'){ flag = '1' }else { flag = '0'; } $('#user_sort').val(flag); submit_lead_form('filter');" class="fa fa-fw fa-sort"></i>
                  </div>
                </div>
             </th>
           <th>Comments</th>
           <th>
            <div class="row">
              <div class="col-md-8">
                Created On
              </div>
              <div class="col-md-4">
                <input type="hidden" name="created_on_sort" id="created_on_sort" value="<?php echo $created_on_sort; ?>">
                <i onclick="$('#leadname_sort').val('');$('#product_sort').val('');$('#country_sort').val('');$('#leadsource_sort').val('');$('#priority_sort').val('');$('#status_sort').val('');$('#user_sort').val('');var flag = $('#created_on_sort').val(); if(flag == '0'){ flag = '1' }else { flag = '0'; } $('#created_on_sort').val(flag); submit_lead_form('filter');" class="fa fa-fw fa-sort"></i>
              </div>
            </div> 
           </th>
           <th class="notexport" data-orderable="false">Action</th>
        </tr>
     </thead>
     <tbody>
        <?php 
        $select_all_leads = '';
        $i = 0;
        if(!empty($lead_lists)){   foreach ($lead_lists as $key=> $lead_list) {
              $select_all_leads .= $lead_list->lead_id.',';

              $res = $this->Lead_model->followup_lists($lead_list->lead_id);
              $fupcnt = count($res);
              $pleads = $this->Lead_model->lead_followups_by_pending_lfuid($lead_list->lead_id);

              if(!empty($pleads)){
                 $fcclass = 'm-badge--info';
              }else{
                 $fcclass = 'm-badge--danger';
              }
              if($fupcnt>0)
              {
                 $lfup = $this->Lead_model->get_last_followup_by_id($lead_list->lead_id);

                 if($lfup->modified_by==0)
                 {
                    $lfdate = $lfup->created_on;
                    $lfby = $lfup->created_by;
                 }
                 else
                 {
                    $lfdate = $lfup->modified_on;
                    $lfby = $lfup->modified_by;
                 }
              }
              else
              {
                 if($lead_list->modified_by==0)
                 {
                    $lfdate = $lead_list->created_on;
                    $lfby   = $lead_list->created_by;
                 }
                 else
                 {
                    $lfdate = $lead_list->modified_on;
                    $lfby   = $lead_list->modified_by;
                 }

              }
              $lfbydet = login_user_details($lfby);
              $displayname = $lfbydet->name;
              if($lfbydet){ $lfbyname = ($displayname) ? $displayname : ''; }
              
              $datetime1 = new DateTime(date_format(date_create($lfdate),'Y-m-d'));
              $datetime2 = new DateTime(date('Y-m-d'));
              $interval = $datetime1->diff($datetime2);

              if($interval->format('%y')==0 && $interval->format('%m')==0)
              {
                 $tday = $interval->format('%d').' D';
                 $tclass = 'btn-info';
              }
              else if($interval->format('%y')==0 && $interval->format('%m')!=0)
              {
                 $tday = $interval->format('%m').' M';
                 $tclass = 'btn-warning';
              }
              else
              {
                 $tday = $interval->format('%y').' Y';
                 $tclass = 'btn-danger';
              }
              ?>
        <tr>
              <td data-sortable="false">
                  <label class="m-checkbox m-checkbox--bold m-checkbox--state-info">
                       <input type="checkbox" id="chk<?php echo $i; ?>" value="<?php echo $lead_list->lead_id; ?>">
                       <span style="left: 10px;"></span>
                 </label>
              </td>
           <td class="contact_info">
              <?php if($lead_list->whatsapp_no != ''){ ?>
                &nbsp;&nbsp;<span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Has Whatsapp">
                   <i class="la la-whatsapp text-green"></i></span>&nbsp;&nbsp;
              <?php } ?>
              <span class="pull-left">
              <h5 class="text-black tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->lead_name; ?>" style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:100px;margin-bottom: 0px;"><?php echo $lead_list->lead_name; ?></h5>
              </span>
              <span class="pull-right">
                 <p class="text-right">
                 <?php if($_SESSION['Lead ManagementView'] == 1){ ?>
                 <a href="<?php echo base_url(); ?>lead_view/<?php echo $lead_list->lead_id; ?>" target="_blank"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Opportunity Info"><i class="fa fa-info-circle"></i></span></a>&nbsp;&nbsp;
                 <?php } ?>

                 <?php
                 if($lead_list->status == 3){ ?>
                    <?php if($_SESSION['Lead ManagementEdit'] == 1){ ?>
                    <a href="#" data-toggle="modal" onClick="MyWindow=window.open('<?php echo base_url(); ?>Leads/opportunity_edit/<?php echo $lead_list->lead_id; ?>','MyWindow','width=1200,height=800'); return false;"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;
                    <?php } ?>
                    <?php if($_SESSION['Lead ManagementDelete'] == 1){ ?>
                     <a href="#" data-toggle="modal" data-target="#cancel_lead" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Archive" onclick="cancel_lead('<?php echo $lead_list->lead_id; ?>')"><i class="fa fa-times"></i></span></a>&nbsp;&nbsp;
                 <?php } } ?>
                 </p>
              </span><br>
              <h5 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->email_id; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:120px;" class="text-muted tooltip-animation"><b><sub><?php echo $lead_list->email_id; ?></sub><b></b></b></h5>
           </td>
           <td>
              <h5 class="text-black"  style="margin-bottom: 0px;"><?php echo $lead_list->product_name; ?></h5>
              <span style="font-size: 16.5px;" class="text-muted"><b><sub><?php echo $lead_list->industry_name; ?></sub><b></b></b></span>
           </td>
            <td>
              <h6 data-toggle="m-tooltip" data-placement="top" class="tooltip-animation" title="<?php echo $lead_list->country_name; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:126px;margin-bottom: 0px; float: left; font-size: 14px;" id="country_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->country_name; ?></h6>

              <div id="country_quick_icon_<?php echo $key; ?>" style="display: none;">
               <?php 
                       if($lead_list->status == 3)
                       {  ?>
                          <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_country_<?php echo $key; ?>"
                              onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'country', 'country_quick_icon', <?php echo $key; ?>, 1);" > 
                                 <?php
                                      if(!empty($country_lists))
                                      {
                                         foreach ($country_lists as  $country_list) { ?>
                                            <option value="<?php echo $country_list->id; ?>"  <?php echo ($country_list->id == $lead_list->country) ? 'selected' : ''; ?> ><?php echo $country_list->name; ?></option>
                                         <?php } 
                                      }
                                   ?>
                             </select>
                      <?php  }?>
                </div>
                <p class="text-right" style="max-width: 15px;float: right;">
                 <a href="#" data-toggle="modal" id="quick_edit_1_<?php echo $key; ?>" onclick="show_quick_icon('country_quick_icon', <?php echo $key; ?>, 1);">
                    <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt" ></i>
                 </a>
                 <a style="display: none;" href="#" data-toggle="modal" id="quick_save_1_<?php echo $key; ?>" 
                    onclick="show_quick_pencil_icon('country_quick_icon', <?php echo $key; ?>, 1);">
                    <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Cancel"><i class="fa fa-undo-alt"></i>
                 </a>
              </p>
           </td>
          
            <td>
                <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->sub_source_name." | ".$lead_list->source_name; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:126px;margin-bottom: 0px; float: left; font-size: 14px" class="tooltip-animation">
                <span  style="margin-bottom: 0px;" id="lead_source_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->sub_source_name; ?></span> <br>
                <span style="font-size: 9.5px;" class="text-muted"><b><sub><?php echo $lead_list->source_name; ?></sub><b></b></b></span>
                </h6>
                <div id="lead_source_quick_icon_<?php echo $key; ?>" style="display: none;">
                 <!-- <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_source_id_<?php echo $key; ?>"
                              onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'lead_source', 'lead_source_quick_icon', <?php echo $key; ?>, 2);" > 
                   <?php
                           if(!empty($lead_source_lists))
                           {
                              foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                 <option value="<?php echo $lead_source_list->lead_source_id; ?>"  <?php echo ($lead_source_list->lead_source_id == $lead_list->lead_source_id) ? 'selected' : ''; ?> ><?php echo $lead_source_list->lead_source; ?></option>
                              <?php } }
                           }
                        ?>
                     </select> -->
                     <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_source_id_<?php echo $key; ?>"
                                onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'lead_source', 'lead_source_quick_icon', <?php echo $key; ?>, 2);" > 
                     
                          <?php
                               if(!empty($lead_source_lists))
                               {
                                  foreach ($lead_source_lists as  $lead_source_list) { if($lead_source_list->status == 0){ ?>
                                     <optgroup label="<?php echo $lead_source_list->lead_source; ?>">
                                        <?php $get_all_subgroup_source = get_all_subgroup_source($lead_source_list->lead_source_id); 
                                        foreach ($get_all_subgroup_source as $sub_lead){
                                        ?>
                                        <option value="<?php echo $sub_lead->sub_lead_source_id; ?>" <?php echo ($sub_lead->sub_lead_source_id == $lead_list->lead_source_id) ? 'selected' : ''; ?>><?php echo $sub_lead->sub_lead_source; ?></option>
                                        <?php } ?>
                                     </optgroup>
                                     
                                  <?php } }
                               }
                            ?>
                   </select>
                </div>
                <p class="text-right" style="max-width: 15px;float: right;">
                   <a href="#" data-toggle="modal" id="quick_edit_2_<?php echo $key; ?>" onclick="show_quick_icon('lead_source_quick_icon', <?php echo $key; ?>, 2);">
                      <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt" ></i>
                   </a>
                   <a style="display: none;" href="#" data-toggle="modal" id="quick_save_2_<?php echo $key; ?>" 
                      onclick="show_quick_pencil_icon('lead_source_quick_icon', <?php echo $key; ?>, 2);">
                      <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Cancel"><i class="fa fa-undo-alt"></i>
                   </a>
                </p>
            </td>
           <!-- <td>
                 
                  <span  style="margin-bottom: 0px;" id="lead_type_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->lead_type_name; ?></span>
                 
              </td> -->

              <td>
                
                <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->lead_type_name; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:60px;margin-bottom: 0px; float: left; font-size: 14px" class="tooltip-animation" id="lead_type_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->lead_type_name; ?></h6>
                <div id="lead_type_quick_icon_<?php echo $key; ?>" style="display: none;">
                 <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_type_id_<?php echo $key; ?>" onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'lead_type', 'lead_type_quick_icon', <?php echo $key; ?>, 3);" > 
                   <?php
                     if(!empty($lead_type_lists))
                     {
                        foreach ($lead_type_lists as $lead_type_list) { if($lead_type_list->status == 0){ ?>
                           <option value="<?php echo $lead_type_list->lead_type_id; ?>" <?php echo ($lead_type_list->lead_type_id == $lead_list->lead_type_id) ? 'selected' : ''; ?> ><?php echo $lead_type_list->lead_type; ?></option>
                        <?php } }
                     }
                  ?>
                 </select>
                </div>
                <p class="text-right" style="max-width: 15px;float: right;">
                   <a href="#" data-toggle="modal" id="quick_edit_3_<?php echo $key; ?>" onclick="show_quick_icon('lead_type_quick_icon', <?php echo $key; ?>, 3);">
                      <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt" ></i>
                   </a>
                   <a style="display: none;" href="#" data-toggle="modal" id="quick_save_3_<?php echo $key; ?>" 
                      onclick="show_quick_pencil_icon('lead_type_quick_icon', <?php echo $key; ?>, 3);">
                      <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Cancel"><i class="fa fa-undo-alt"></i>
                   </a>
                </p>
            </td>
           <!-- <td>
               <span  style="margin-bottom: 0px;" id="lead_status_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->lead_status_name; ?></span>
           </td> -->
          <td>
             <h6 data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->lead_status_name; ?>" style="font-size: 16.5px;white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:126px;margin-bottom: 0px; float: left; font-size: 14px" class="tooltip-animation" id="lead_status_quick_icon_label_<?php echo $key; ?>"> <?php echo $lead_list->lead_status_name; ?></h6>
             <div id="lead_status_quick_icon_<?php echo $key; ?>" style="display: none;">
              <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="list_status_id_<?php echo $key; ?>" onchange="lead_status_type_change(this.value, '<?php echo $lead_list->lead_id; ?>', 'lead_status', 'lead_status_quick_icon', <?php echo $key; ?>, 4);" > 
                <?php
                  if(!empty($oppo_status_lists))
                  {
                     foreach ($oppo_status_lists as $oppo_status_list) { if($oppo_status_list->status == 0){ ?>
                        <option value="<?php echo $oppo_status_list->oppo_status_id; ?>" <?php echo ($oppo_status_list->oppo_status_id == $lead_list->lead_status_id) ? 'selected' : ''; ?> ><?php echo $oppo_status_list->oppo_status; ?></option>
                     <?php } }
                  }
                ?>
              </select>

             </div>
             <p class="text-right" style="max-width: 15px;float: right;">
                <a href="#" data-toggle="modal" id="quick_edit_4_<?php echo $key; ?>" onclick="show_quick_icon('lead_status_quick_icon', <?php echo $key; ?>, 4);">
                   <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt" ></i>
                </a>
                <a style="display: none;" href="#" data-toggle="modal" id="quick_save_4_<?php echo $key; ?>" 
                   onclick="show_quick_pencil_icon('lead_status_quick_icon', <?php echo $key; ?>, 3);">
                   <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Cancel"><i class="fa fa-undo-alt"></i>
                </a>
             </p>
          </td>
            <td>
              <?php echo $lead_list->lead_assign_name; ?>
                <?php 

               if (isset($lead_list->fup_status) && $lead_list->fup_status != 0 && $tab_val == 1){ if($lead_list->fupst == 0){
                 $ftimes = explode(',', $lead_list->fup_status);
                ?>
                <span class="tag_fup">&nbsp;<?php
                foreach ($ftimes as $ft) {
                    $time = date("h:i A",strtotime($ft));
                    $ctime = date("h:i A");
                    if(date("H:i:s",strtotime($time)) < date("H:i:s",strtotime($ctime)))
                    {
                       echo '<b class="text-danger">'.$time.'&nbsp;</b>';
                    }
                    else
                    {
                       echo '<b>'.$time.'&nbsp;</b>';
                    }
                }
                ?>
                 </b></span>
              <?php } else{ ?>
                 <span class="tag_fup">Followed</span>
              <?php } } ?>
           </td>
           <!-- <td>
              <p class="text-right">
                <a href="#" onclick="view_lead_comments(<?php echo $lead_list->lead_id; ?>);">
                   <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View Comments"><i class="fa fa-eye" ></i>
                </a>
              </p>
                <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="<?php echo $lead_list->comments; ?>" style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:160px;margin-bottom: 0px;"> <?php echo $lead_list->comments; ?></span>
           </td> -->
           <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:160px;">
                <p class="text-right">
                  <a href="#" onclick="view_lead_comments(<?php echo $lead_list->lead_id; ?>);">
                     <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="View Comments"><i class="fa fa-comments" ></i>
                  </a>
                </p>
                  <span style="margin-bottom: 0px;"> <?php echo htmlspecialchars_decode(stripslashes($lead_list->comments)); ?></span>
             </td>
             <td>
               <?php echo date($date_format,strtotime($lead_list->created_on)); ?>
             </td>
           <td>
              <?php if($lead_list->status == 3){?>
                    <a href="#" data-toggle="modal" onclick="lead_opportunity_change(0, '<?php echo $lead_list->lead_id; ?>', 'status');"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Move To Lead">
                       <i class="fa fa-undo-alt"></i></span></a>&nbsp;&nbsp;

           <?php } ?>
           <?php if($lead_list->status == 0 && ($lead_list->lead_status_name == 'Potential' && $lead_list->lead_type_name == 'Hot')  ){ ?>     
                    <a href="#" id="opp_id_<?php echo $key; ?>" data-toggle="modal" onclick="lead_opportunity_modal('<?php echo $lead_list->lead_id; ?>');"><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Move To Opportunity"><i class="fa fa-hands-helping"></i></span></a>&nbsp;&nbsp;
           <?php } ?>

              <?php
           if($_SESSION['Lead ManagementFollowup'] == 1) {   
           if($lead_list->status == 3 ){ ?>
                 <a href="#" data-toggle="modal" data-target="#follow_edit">
                    <span style="position:relative;">
                    <span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Follow Up" onclick="lead_fp_edit('<?php echo $lead_list->lead_id; ?>')"><i class="flaticon-calendar-with-a-clock-time-tools"></i></span>

                    <?php if($fupcnt>0){?>
                    <span class="m-badge <?php echo $fcclass;?>" style="position:absolute;right: 0;top: -15px;left: 3px;"><?php echo $fupcnt;?></span><?php }?></span>
                 </a>&nbsp;&nbsp;
           <?php } } ?>
           
           <div class="btn-group">
                 <button type="button" class="lead_modi_info btn btn-sm <?php echo $tclass;?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b><?php echo $tday;?></b></button>
                 <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:;">Created By <br><b><?php echo $lead_list->lead_created_by; ?></b></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;">Created On <br><b><?php echo date($date_format. ' H:i:s', strtotime($lead_list->created_on)); ?></b></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;">Last Modified By <br><b><?php echo $lfbyname;?></b></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;">Last Modified On <br><b><?php echo date($date_format.' H:i:s', strtotime($lfdate));?></b></a>
                 </div>
              </div>
              <?php if($_SESSION['Lead ManagementReopen_lead'] == 1){ ?>
              <?php if ($lead_list->status == 2){ ?>
                 <a href="#" data-toggle="modal" data-target="#re_lead" ><span class="tooltip-animation" data-toggle="m-tooltip" data-placement="top" title="Reopen Lead" onclick="re_lead('<?php echo $lead_list->lead_id; ?>')"><i class="fa fa-undo-alt"></i></span></a>
              <?php } } ?>

           </td>
        </tr>
         <?php $i++; } } else { ?> 
          <tr><td colspan="10"><h6 class="text-center">No Records Found..</h6></td></tr>
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
      <?php if (($page + $perpage) < count($lead_lists_count)){ ?>
      <li class="page-item"><a class="page-link" onclick="paginate_page('<?php echo $last_page_count; ?>','<?php echo $pagination_count; ?>');">Last</a></li>
      <?php } ?>
    </ul>
    <?php } ?>
   </div>
 </div>

 <script>
   $('#m_table_2').dataTable({ stateSave: true });
   $('.m_selectpicker').selectpicker();
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