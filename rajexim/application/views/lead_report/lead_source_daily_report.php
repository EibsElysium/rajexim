<div class="row">
   <div class="col-lg-12">

      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost" width="100%">
         <thead>
            <tr>
               <th data-orderable="false">Lead Source </th>
               <th data-orderable="false">Sub Lead Source</th>
               <?php
                  for($j = 1; $j<= $no_of_days_in_month; $j++)
                  { 
                     if(strlen($j) > 1)
                           {
                              $d_format = $j;
                           }else{
                              $d_format = '0'.$j;
                           }
                           $check_date = $f_year_month.'-'.$d_format;  

                     ?>
                    
                     <th data-orderable="false"><?php echo $d_format; ?><sub><?php  echo date('D', strtotime($check_date)); ?></sub></th>
                  <?php ${"lscol$j"} = ''; }
               ?>
               <th data-orderable="false">Total</th>
            </tr>
         </thead>
         <tbody>
            <?php

               if(!empty($lead_source_lists))
               {
                  foreach ($lead_source_lists as $lead_source_list) {
                  $row_count = 0;
                   ?>

                    <tr>
                     <td><b><h5><?php echo $lead_source_list['lead_source']; ?></h5></b></td>
                     <td><b><h5><?php echo $lead_source_list['sub_lead_source']; ?></h5></b></td>
                     <?php
                        for($j = 1; $j<= $no_of_days_in_month; $j++)
                        { 
                           if(strlen($j) > 1)
                           {
                              $d_format = $j;
                           }else{
                              $d_format = '0'.$j;
                           }
                           $row_count = $row_count + $lead_source_list[$d_format];

                           ?>
                           <td><h5 class="text-center text-black"><?php echo ($lead_source_list[$d_format] == 0) ? '-' : $lead_source_list[$d_format]; ?></h5></td>
                        <?php ${"lscol$j"} = (int)${"lscol$j"} + (int)$lead_source_list[$d_format]; }
                     ?>
                     <td style="background: #f2ee87;"><h4 class="text-center text-theme"><?php  echo ($row_count == 0) ? '-' : $row_count; ?></h4></td>
                    </tr>
                  <?php }
               }
            ?>
            
         </tbody>
         <tfoot>
            <tr>
               <th><b><h5>Total</h5></b></th>
               <th><b><h5>-</h5></b></th>
                  <?php
                  $foot_count = 0;
                  for($j = 1; $j<= $no_of_days_in_month; $j++)
                  { 

                     if(strlen($j) > 1)
                           {
                              $d_format = $j;
                           }else
                           {
                              $d_format = '0'.$j;
                           }
                           // $foot_count = $foot_count + $lead_source_daily_counts[$d_format];
                     ?>
                     <th style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo (${"lscol$j"} == 0) ? '-' : ${"lscol$j"}; ?></b></h4></th>
                  <?php $foot_count = (int)$foot_count + (int)${"lscol$j"}; }
               ?>
               <th style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></b></h4></th>
            </tr>
         </tfoot>
      </table>

      <table id="daily_ls_report_export" style="display: none;">
         <thead>
            <tr>
               <th>Lead Source </th>
               <th>Sub Lead Source</th>
               <?php
                  for($j = 1; $j<= $no_of_days_in_month; $j++)
                  { 
                     if(strlen($j) > 1)
                           {
                              $d_format = $j;
                           }else{
                              $d_format = '0'.$j;
                           }
                           $check_date = $f_year_month.'-'.$d_format;  

                     ?>
                    
                     <th><?php echo $d_format; ?><sub><?php  echo date('D', strtotime($check_date)); ?></sub></th>
                  <?php ${"lscol$j"} = ''; }
               ?>
               <th>Total</th>
            </tr>
         </thead>
         <tbody>
            <?php

               if(!empty($lead_source_lists))
               {
                  foreach ($lead_source_lists as $lead_source_list) {
                  $row_count = 0;
                   ?>

                    <tr>
                     <td><b><h5><?php echo $lead_source_list['lead_source']; ?></h5></b></td>
                     <td><b><h5><?php echo $lead_source_list['sub_lead_source']; ?></h5></b></td>
                     <?php
                        for($j = 1; $j<= $no_of_days_in_month; $j++)
                        { 
                           if(strlen($j) > 1)
                           {
                              $d_format = $j;
                           }else{
                              $d_format = '0'.$j;
                           }
                           $row_count = $row_count + $lead_source_list[$d_format];

                           ?>
                           <td><?php echo ($lead_source_list[$d_format] == 0) ? '-' : $lead_source_list[$d_format]; ?></td>
                        <?php ${"lscol$j"} = (int)${"lscol$j"} + (int)$lead_source_list[$d_format]; }
                     ?>
                     <td><?php  echo ($row_count == 0) ? '-' : $row_count; ?></td>
                    </tr>
                  <?php }
               }
            ?>
            
         </tbody>
         <tfoot>
            <tr>
               <th>Total</th>
               <th>-</th>
                  <?php
                  $foot_count = 0;
                  for($j = 1; $j<= $no_of_days_in_month; $j++)
                  { 

                     if(strlen($j) > 1)
                           {
                              $d_format = $j;
                           }else
                           {
                              $d_format = '0'.$j;
                           }
                           // $foot_count = $foot_count + $lead_source_daily_counts[$d_format];
                     ?>
                     <th><?php echo (${"lscol$j"} == 0) ? '-' : ${"lscol$j"}; ?></th>
                  <?php $foot_count = (int)$foot_count + (int)${"lscol$j"}; }
               ?>
               <th><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>

<script type="text/javascript">
   var DatatablesBasicScrollable = {
    init: function() {
       
        $(".usage_cost").DataTable({
            scrollY: "50vh",
            scrollX: !0,
            scrollCollapse: !0,paging:0,
                    ordering:false,
            fixedColumns: {
                                 leftColumns: 2,
                                 rightColumns: 1
                             }
         
        })
    }
};
DatatablesBasicScrollable.init().fnDestroy();
  jQuery(document).ready(function() {
       DatatablesBasicScrollable.init()
   }); 

</script>