<div class="row">
   <div class="col-lg-12">

      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost1" width="100%">
         <thead>
            <tr>
               <th data-orderable="false">Lead Source </th>
               <th data-orderable="false">Sub Lead Source </th>
               <?php
                  for($j = 0; $j < COUNT($no_of_month_in_year); $j++)
                  { 
                     // if(strlen($j) > 1)
                     //       {
                     //          $d_format = $j;
                     //       }else{
                     //          $d_format = '0'.$j;
                     //       }
                          $exp = explode('-', $no_of_month_in_year[$j]);
                          $check_date = $exp[1].'-'.$exp[0];
                          // $check_date = $f_year.'-'.$d_format;  

                     ?>

                     
                     <th data-orderable="false"><?php  echo date('M', strtotime($check_date)); ?></th>
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
                        for($j = 0; $j < COUNT($no_of_month_in_year); $j++)
                        { 
                           // if(strlen($j) > 1)
                           //       {
                           //          $d_format = $j;
                           //       }else{
                           //          $d_format = '0'.$j;
                           //       }
                          $exp = explode('-', $no_of_month_in_year[$j]);
                          $check_date = $exp[1].'-'.$exp[0];
                                 $row_count = $row_count + $lead_source_list[$exp[0]];
                           ?>
                           <td><h5 class="text-center text-black"><?php echo ($lead_source_list[$exp[0]] == 0) ? '-' : $lead_source_list[$exp[0]]; ?></h5></td>
                        <?php ${"lscol$j"} = (int)${"lscol$j"} + (int)$lead_source_list[$exp[0]]; }
                     ?>
                     <td style="background: #f2ee87;" class="text-center"><h4 class="text-theme"><?php echo ($row_count == 0) ? '-' : $row_count; ?></h4></td>
                    </tr>
                  <?php  }
               }
            ?>
            
         </tbody>
         <tfoot>
            <tr>
               <th><b><h5>Total</h5></b></th>
               <th><b><h5>-</h5></b></th>
                  <?php
                  $foot_count = 0;
                  for($j = 0; $j < COUNT($no_of_month_in_year); $j++)
                  { 

                           $foot_count = $foot_count + ${"lscol$j"};
                     ?>
                     <th style="background: #f2ee87;"><h4 class="text-center text-theme"><b><?php echo (${"lscol$j"} == 0) ? '-' : ${"lscol$j"}; ?></b></h4></th>
                  <?php }
               ?>
               <th style="background: #f2ee87;" class="text-center"><h4 class="text-theme"><b><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></b></h4></th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>
<table id="monthly_ls_report_export" style="display: none;">
   <thead>
      <tr>
         <th>Lead Source </th>
         <th>Sub Lead Source </th>
         <?php
            for($j = 0; $j < COUNT($no_of_month_in_year); $j++)
            { 
               // if(strlen($j) > 1)
               //       {
               //          $d_format = $j;
               //       }else{
               //          $d_format = '0'.$j;
               //       }
                    $exp = explode('-', $no_of_month_in_year[$j]);
                    $check_date = $exp[1].'-'.$exp[0];
                    // $check_date = $f_year.'-'.$d_format;  

               ?>

               
               <th><?php  echo date('M', strtotime($check_date)); ?></th>
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
               <td><?php echo $lead_source_list['lead_source']; ?></td>
               <td><?php echo $lead_source_list['sub_lead_source']; ?></td>
               <?php
                  for($j = 0; $j < COUNT($no_of_month_in_year); $j++)
                  { 
                     // if(strlen($j) > 1)
                     //       {
                     //          $d_format = $j;
                     //       }else{
                     //          $d_format = '0'.$j;
                     //       }
                    $exp = explode('-', $no_of_month_in_year[$j]);
                    $check_date = $exp[1].'-'.$exp[0];
                           $row_count = $row_count + $lead_source_list[$exp[0]];
                     ?>
                     <td><?php echo ($lead_source_list[$exp[0]] == 0) ? '-' : $lead_source_list[$exp[0]]; ?></td>
                  <?php ${"lscol$j"} = (int)${"lscol$j"} + (int)$lead_source_list[$exp[0]]; }
               ?>
               <td><?php echo ($row_count == 0) ? '-' : $row_count; ?></td>
              </tr>
            <?php  }
         }
      ?>
      
   </tbody>
   <tfoot>
      <tr>
         <th>Total</th>
         <th>-</th>
            <?php
            $foot_count = 0;
            for($j = 0; $j < COUNT($no_of_month_in_year); $j++)
            { 

                     $foot_count = $foot_count + ${"lscol$j"};
               ?>
               <th><?php echo (${"lscol$j"} == 0) ? '-' : ${"lscol$j"}; ?></th>
            <?php }
         ?>
         <th><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></th>
      </tr>
   </tfoot>
</table>
<script type="text/javascript">
   var DatatablesBasicScrollable = {
    init: function() {
       
        $(".usage_cost1").DataTable({
            scrollY: "50vh",
            scrollX: !0,
            scrollCollapse: !0,paging:0,
                    ordering:false,
            fixedColumns: {
                                 leftColumns: 1,
                                 rightColumns: 1
                             }
         
        })
    }
};

// var val = '<?php //echo $val; ?>';
// alert(val);
// if(val == 2)
// {
   DatatablesBasicScrollable.init().fnDestroy();
  jQuery(document).ready(function() {
       DatatablesBasicScrollable.init()
   }); 
// }
   
</script>