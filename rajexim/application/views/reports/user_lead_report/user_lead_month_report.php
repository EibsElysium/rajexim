<div class="row">
   <div class="col-lg-12">

      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost1" width="100%">
         <thead>
            <tr>
               <th data-orderable="false">Users </th>
               <th data-orderable="false">Assigned Products </th>
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
                  <?php ${"upcol$j"} = ''; }
               ?>
               <th data-orderable="false">Total</th>
               <th data-orderable="false">Domestic</th>
               <th data-orderable="false">International</th>
            </tr>
         </thead>
         <tbody>
            <?php

               if(!empty($user_name_with_assigned_product))
               {
                $ind_col = 0;
                $inter_col = 0;
                  foreach ($user_name_with_assigned_product as $user_product) {
                    if ($user_product->user_id != 1) {
                      
                  $row_count = 0;
                  $ind_row_count = 0;
                  $inter = 0;
                   ?>

                    <tr>
                     <td><b><h5><?php echo $user_product->name; ?></h5></b></td>
                     <td><b><h5><?php echo $user_product->product_name; ?></h5></b></td>
                     <?php
                        for($j = 0; $j < COUNT($no_of_month_in_year); $j++)
                        { 
                           // if(strlen($j) > 1)
                           // {
                           //    $d_format = $j;
                           // }else{
                           //    $d_format = '0'.$j;
                           // }
                           // $check_date = $f_year_month.'-'.$d_format;
                          $exp = explode('-', $no_of_month_in_year[$j]);
                          $month = $exp[0];
                          $year = $exp[1];
                           $get_day_lead_by_user_product = get_month_lead_by_user_product($user_product->product_id,$user_product->user_id,$month,$year);
                           $get_day_lead_by_user_product_from_india = get_month_lead_by_user_product_from_india($user_product->product_id,$user_product->user_id,$month,$year);
                           ?>
                           <td><h5 class="text-center text-black"><?php echo ($get_day_lead_by_user_product->lead_count == 0) ? '-' : $get_day_lead_by_user_product->lead_count; ?></h5></td>
                        <?php ${"upcol$j"} = (int)${"upcol$j"} + (int)$get_day_lead_by_user_product->lead_count; $row_count = $row_count + $get_day_lead_by_user_product->lead_count; $ind_row_count = $ind_row_count + $get_day_lead_by_user_product_from_india->lead_count; }

                     ?>
                     <td style="background: #f2ee87;"><h4 class="text-center text-theme"><?php  echo ($row_count == 0) ? '-' : $row_count; ?></h4></td>
                     <td><h4 class="text-center text-theme"><?php $ind_col = $ind_col + $ind_row_count; echo ($ind_row_count == 0) ? '-' : $ind_row_count; ?></h4></td>
                     <td><h4 class="text-center text-theme"><?php $inter = $row_count - $ind_row_count; echo ($inter == 0) ? '-' : $inter; $inter_col = $inter_col + $inter; ?></h4></td>
                    </tr>
                  <?php } }
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

                     if(strlen($j) > 1)
                           {
                              $d_format = $j;
                           }else{
                              $d_format = '0'.$j;
                           }
                           // $foot_count = $foot_count + $lead_source_daily_counts[$d_format];
                     ?>
                     <th style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo (${"upcol$j"} == 0) ? '-' : ${"upcol$j"}; ?></b></h4></th>
                  <?php $foot_count = (int)$foot_count + (int)${"upcol$j"}; }
               ?>
               <th style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></b></h4></th>
               <th><h4 class="text-theme text-center"><b><?php echo ($ind_col == 0) ? '-' : $ind_col; ?></b></h4></th>
               <th><h4 class="text-theme text-center"><b><?php echo ($inter_col == 0) ? '-' : $inter_col; ?></b></h4></th>
            </tr>
         </tfoot>
      </table>
      <table id="monthly_lead_user_report_export" style="display: none;">
         <thead>
            <tr>
               <th>Users </th>
               <th>Assigned Products </th>
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
                  <?php ${"upcol$j"} = ''; }
               ?>
               <th>Total</th>
               <th>Domestic</th>
               <th>International</th>
            </tr>
         </thead>
         <tbody>
            <?php

               if(!empty($user_name_with_assigned_product))
               {
                $ind_col = 0;
                $inter_col = 0;
                  foreach ($user_name_with_assigned_product as $user_product) {
                    if ($user_product->user_id != 1) {
                      
                  $row_count = 0;
                  $ind_row_count = 0;
                  $inter = 0;
                   ?>

                    <tr>
                     <td><?php echo $user_product->name; ?></td>
                     <td><?php echo $user_product->product_name; ?></td>
                     <?php
                        for($j = 0; $j < COUNT($no_of_month_in_year); $j++)
                        { 
                           // if(strlen($j) > 1)
                           // {
                           //    $d_format = $j;
                           // }else{
                           //    $d_format = '0'.$j;
                           // }
                           // $check_date = $f_year_month.'-'.$d_format;
                          $exp = explode('-', $no_of_month_in_year[$j]);
                          $month = $exp[0];
                          $year = $exp[1];
                           $get_day_lead_by_user_product = get_month_lead_by_user_product($user_product->product_id,$user_product->user_id,$month,$year);
                           $get_day_lead_by_user_product_from_india = get_month_lead_by_user_product_from_india($user_product->product_id,$user_product->user_id,$month,$year);
                           ?>
                           <td><?php echo ($get_day_lead_by_user_product->lead_count == 0) ? '-' : $get_day_lead_by_user_product->lead_count; ?></td>
                        <?php ${"upcol$j"} = (int)${"upcol$j"} + (int)$get_day_lead_by_user_product->lead_count; $row_count = $row_count + $get_day_lead_by_user_product->lead_count; $ind_row_count = $ind_row_count + $get_day_lead_by_user_product_from_india->lead_count; }

                     ?>
                     <td><?php  echo ($row_count == 0) ? '-' : $row_count; ?></td>
                     <td><?php $ind_col = $ind_col + $ind_row_count; echo ($ind_row_count == 0) ? '-' : $ind_row_count; ?></td>
                     <td><?php $inter = $row_count - $ind_row_count; echo ($inter == 0) ? '-' : $inter; $inter_col = $inter_col + $inter; ?></td>
                    </tr>
                  <?php } }
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

                     if(strlen($j) > 1)
                           {
                              $d_format = $j;
                           }else{
                              $d_format = '0'.$j;
                           }
                           // $foot_count = $foot_count + $lead_source_daily_counts[$d_format];
                     ?>
                     <th><?php echo (${"upcol$j"} == 0) ? '-' : ${"upcol$j"}; ?></th>
                  <?php $foot_count = (int)$foot_count + (int)${"upcol$j"}; }
               ?>
               <th><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></th>
               <th><?php echo ($ind_col == 0) ? '-' : $ind_col; ?></th>
               <th><?php echo ($inter_col == 0) ? '-' : $inter_col; ?></th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>

<script type="text/javascript">
   var DatatablesBasicScrollable = {
    init: function() {
       
        $(".usage_cost1").DataTable({
            scrollY: "50vh",
            scrollX: !0,
            scrollCollapse: !0,paging:0,
                    ordering:false,
            fixedColumns: {
                                 leftColumns: 2,
                                 rightColumns: 3
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