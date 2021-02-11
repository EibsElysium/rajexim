<div class="row">

   <div class="col-lg-12">



      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost" width="100%">

         <thead>

            <tr>

               <th data-orderable="false">Products </th>

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

                           ${"day$j"} = '';

                     ?>

                    

                     <th data-orderable="false"><?php echo $d_format; ?><sub><?php  echo date('D', strtotime($check_date)); ?></sub></th>

                  <?php }

               ?>

               <th data-orderable="false">Total</th>

            </tr>

         </thead>

         <tbody>

            <?php



               if(!empty($get_all_product))

               {

                  foreach ($get_all_product as $product) {

                  $row_count = 0;

                  $sum = 0

                   ?>



                    <tr>

                     <td><b><h5><?php echo $product->product_name; ?></h5></b></td>

                     <?php

                        for($j = 1; $j<= $no_of_days_in_month; $j++)

                        { 

                           if(strlen($j) > 1)

                           {

                              $d_format = $j;

                           }else{

                              $d_format = '0'.$j;

                           }

                           $cell_date = $f_year_month."-".$d_format;

                           

                           

                           // $row_count = $row_count + $product[$d_format];

                           $count = get_total_count_based_on_product_by_date($product->product_id,$cell_date,$assign_to,$lead_source);

                           ?>

                           <td class="text-center"><h5 class="text-center text-black"  style="float: left; padding-top: 7px;"><?php echo ($count->lead_count == 0) ? '-' : $count->lead_count; ?></h5><?php if($count->lead_count != 0){ $count_by_ls = get_total_count_divide_by_lead_source_based_on_product_by_date($product->product_id,$cell_date,$assign_to,$lead_source);

                            echo "<ul class = 'ls_list'>"; 

                             foreach ($count_by_ls as $ls_count) {

                                 echo "<li><span style='color:".$ls_count->source_color.";font-weight:bold;'>".$ls_count->ls_count."</span></li>";

                               }  

                            echo "</ul>";

                           } ?></td>

                        <?php $row_count = $row_count + $count->lead_count;

                        ${"day$j"} = (int)${"day$j"} + (int)$count->lead_count;

                      }

                     ?>

                     <td style="background: #f2ee87;"><h4 class="text-center text-theme"><?php echo ($row_count == 0) ? '-' : $row_count; ?></h4></td>

                    </tr>

                  <?php }

               }

            ?>

            

         </tbody>

         <tfoot>

            <tr>

               <th><b><h5>Total</h5></b></th>

                  <?php

                  $foot_count = 0;

                  for($j = 1; $j<= $no_of_days_in_month; $j++)

                  { 



                     if(strlen($j) > 1)

                           {

                              $d_format = $j;

                           }else{

                              $d_format = '0'.$j;

                           }

                           $foot_count = (int)$foot_count + (int)${"day$j"};

                     ?>

                     <th style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo ${"day$j"}; ?></b></h4></th>

                  <?php }

               ?> 

               <th style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo $foot_count; ?></b></h4></th>

            </tr>

         </tfoot> 

      </table>
      <table id="ls_pro_daily_export" style="display: none;">

         <thead>

            <tr>

               <th>Products </th>

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

                           ${"day$j"} = '';

                     ?>

                    

                     <th><?php echo $d_format; ?><sub><?php  echo date('D', strtotime($check_date)); ?></sub></th>

                  <?php }

               ?>

               <th>Total</th>

            </tr>

         </thead>

         <tbody>

            <?php



               if(!empty($get_all_product))

               {

                  foreach ($get_all_product as $product) {

                  $row_count = 0;

                  $sum = 0

                   ?>



                    <tr>

                     <td><?php echo $product->product_name; ?></td>

                     <?php

                        for($j = 1; $j<= $no_of_days_in_month; $j++)

                        { 

                           if(strlen($j) > 1)

                           {

                              $d_format = $j;

                           }else{

                              $d_format = '0'.$j;

                           }

                           $cell_date = $f_year_month."-".$d_format;

                           

                           

                           // $row_count = $row_count + $product[$d_format];

                           $count = get_total_count_based_on_product_by_date($product->product_id,$cell_date,$assign_to,$lead_source);

                           ?>

                           <td><?php echo ($count->lead_count == 0) ? '-' : $count->lead_count; ?></td>

                        <?php $row_count = $row_count + $count->lead_count;

                        ${"day$j"} = (int)${"day$j"} + (int)$count->lead_count;

                      }

                     ?>

                     <td><?php echo ($row_count == 0) ? '-' : $row_count; ?></td>

                    </tr>

                  <?php }

               }

            ?>

            

         </tbody>

         <tfoot>

            <tr>

               <th>Total</th>

                  <?php

                  $foot_count = 0;

                  for($j = 1; $j<= $no_of_days_in_month; $j++)

                  { 



                     if(strlen($j) > 1)

                           {

                              $d_format = $j;

                           }else{

                              $d_format = '0'.$j;

                           }

                           $foot_count = (int)$foot_count + (int)${"day$j"};

                     ?>

                     <th><?php echo ${"day$j"}; ?></th>

                  <?php }

               ?> 

               <th><?php echo $foot_count; ?></th>

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

                                 leftColumns: 1,

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