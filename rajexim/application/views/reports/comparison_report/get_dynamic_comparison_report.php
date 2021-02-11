<div class="row">

   <div class="col-lg-12">

    <?php if ($day_filt == '') { $single_q_tot = 0;?>

      

      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost" width="100%">

         <thead>

            <tr>

               <th></th>

               <?php



                    foreach ($get_quarter_year as $quarter_year) { ?>

  

                    

                     <th data-orderable="false" align="center" colspan="5"><?php  echo $quarter_year->quarter_label; ?></th>

                  <?php }

               ?>
               <th data-orderable="false" align="center" colspan="6">Total</th>

               <!-- <th></th> -->

            </tr>      

            <tr>

              <th data-orderable="false">Product</th>

               <?php $i=1; foreach ($get_quarter_year as $quarter_year) { ${"l_col$i"} = 0; ${"o_col$i"} = 0; ${"q_col$i"} = 0; ${"pi_col$i"} = 0; ${"bo_col$i"} = 0; ?>

                     <th data-orderable="false" align="center" >Lead</th>

                     <th data-orderable="false" align="center" >Opportunity</th>

                     <th data-orderable="false" align="center" >Quote</th>

                     <th data-orderable="false" align="center" >PI</th>

                     <th data-orderable="false" align="center" >Order</th>

              <?php $i++; } ?>
              <?php if(count($get_quarter_year) > 1){ ?>
              <th data-orderable="false" align="center" >Lead</th>

               <th data-orderable="false" align="center" >Opportunity</th>

               <th data-orderable="false" align="center" >Quote</th>

               <th data-orderable="false" align="center" >PI</th>

               <th data-orderable="false" align="center" >Order</th>
               
               <th data-orderable="false" align="center" >Grand Total</th>
              <?php } else { echo "<th></th>"; } ?>
            </tr>

         </thead>

         <tbody>

            <?php $l_tot =0; $o_tot = 0; $q_tot = 0; $pi_tot = 0; $bo_tot = 0;

             foreach ($get_all_product as $product) { 
              ?>

              <tr>

                <th data-orderable="false"><?php echo $product->product_name; ?></th>

                 <?php

                     $i=1; $l_row_tot = 0; $o_row_tot = 0; $q_row_tot = 0; $pi_row_tot = 0; $bo_row_tot = 0; foreach ($get_quarter_year as $quarter_year) { 

                        if ($i == 1) {

                          $q_s_month = $yr1.'-'.$quarter_year->start_month_date;

                          $q_e_month = $yr1.'-'.$quarter_year->end_month_date;

                        }

                        elseif ($i == 2) {

                          $q_s_month = $yr1.'-'.$quarter_year->start_month_date;

                          $q_e_month = $yr1.'-'.$quarter_year->end_month_date;

                        }

                        elseif ($i == 3) {

                          $q_s_month = $yr1.'-'.$quarter_year->start_month_date;

                          $q_e_month = $yr1.'-'.$quarter_year->end_month_date; 

                        }

                        elseif ($i == 4) {

                          $q_s_month = $yr2.'-'.$quarter_year->start_month_date;

                          $q_e_month = $yr2.'-'.$quarter_year->end_month_date;

                        }

                        ?>

                      

                      

                       <th data-orderable="false" align="center" ><?php $get_lead_counts = get_lead_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_lead_counts->lead_count == '0') ? '-' : $get_lead_counts->lead_count; $l_row_tot = $l_row_tot + $get_lead_counts->lead_count; ${"l_col$i"} = ${"l_col$i"} + $get_lead_counts->lead_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_oppo_counts = get_oppo_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_oppo_counts->lead_count == '0') ? '-' : $get_oppo_counts->lead_count; $o_row_tot = $o_row_tot + $get_oppo_counts->lead_count; ${"o_col$i"} = ${"o_col$i"} + $get_oppo_counts->lead_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_quote_counts = get_quote_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_quote_counts->quote_count == '0') ? '-' : $get_quote_counts->quote_count; $q_row_tot = $q_row_tot + $get_quote_counts->quote_count; ${"q_col$i"} = ${"q_col$i"} + $get_quote_counts->quote_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_pi_counts = get_pi_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_pi_counts->pi_count == '0') ? '-' : $get_pi_counts->pi_count; $pi_row_tot = $pi_row_tot + $get_pi_counts->pi_count; ${"pi_col$i"} = ${"pi_col$i"} + $get_pi_counts->pi_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_order_counts = get_order_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_order_counts->order_count == '0') ? '-' : $get_order_counts->order_count; $bo_row_tot = $bo_row_tot + $get_order_counts->order_count; ${"bo_col$i"} = ${"bo_col$i"} + $get_order_counts->order_count; ?></th>

                    <?php $i++; }

                 ?>

                 <?php if(count($get_quarter_year) > 1){ 
                  $l_tot = $l_tot + $l_row_tot; $o_tot = $o_tot + $o_row_tot; $q_tot = $q_tot + $q_row_tot; $pi_tot = $pi_tot + $pi_row_tot; $bo_tot = $bo_tot + $bo_row_tot;
                  ?>

                 <th data-orderable="false" align="center" ><?php echo ($l_row_tot == '0') ? '-' : $l_row_tot; ?></th>
                 <th data-orderable="false" align="center" ><?php echo ($o_row_tot == '0') ? '-' : $o_row_tot; ?></th>
                 <th data-orderable="false" align="center" ><?php echo ($q_row_tot == '0') ? '-' : $q_row_tot; ?></th>
                 <th data-orderable="false" align="center" ><?php echo ($pi_row_tot == '0') ? '-' : $pi_row_tot; ?></th>
                 <th data-orderable="false" align="center" ><?php echo ($bo_row_tot == '0') ? '-' : $bo_row_tot; ?></th>
                 <?php } ?>
                 <th style="background: #f2ee87;" data-orderable="false"><?php echo $l_row_tot + $o_row_tot + $q_row_tot + $pi_row_tot + $bo_row_tot; $single_q_tot = $single_q_tot + ($l_row_tot + $o_row_tot + $q_row_tot + $pi_row_tot + $bo_row_tot); ?></th>
            </tr>

            <?php }  ?>

         </tbody>

         <tfoot>

            <tr>

               <th><b><h5>Total</h5></b></th>

               

               

              

              

                 <?php

                     $i=1;foreach ($get_quarter_year as $quarter_year) { 

                        

                        ?>

                      

                      

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"l_col$i"} == '0') ? '-' : ${"l_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"o_col$i"} == '0') ? '-' : ${"o_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"q_col$i"} == '0') ? '-' : ${"q_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"pi_col$i"} == '0') ? '-' : ${"pi_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"bo_col$i"} == '0') ? '-' : ${"bo_col$i"}; ?></th>

                    <?php  $i++; }

                 ?>

                 <?php if(count($get_quarter_year) > 1) { ?>
                 <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo ($l_tot == '0') ? '-' : $l_tot; ?></th>
                 <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo ($o_tot == '0') ? '-' : $o_tot; ?></th>
                 <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo ($q_tot == '0') ? '-' : $q_tot; ?></th>
                 <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo ($pi_tot == '0') ? '-' : $pi_tot; ?></th>
                 <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo ($bo_tot == '0') ? '-' : $bo_tot; ?></th>
               <?php } ?>
                  <th style="background: #f2ee87;" data-orderable="false"><?php echo (count($get_quarter_year) > 1) ? $foot_tot = $l_tot + $o_tot + $q_tot + $pi_tot + $bo_tot : $single_q_tot; ?></th>

           

           

            </tr>

         </tfoot>

      </table>

      <table id="comparison_report_export" style="display: none;">

         <thead>

            <tr>

               <th></th>

               <?php



                    foreach ($get_quarter_year as $quarter_year) { ?>

  

                    

                     <th colspan="5"><?php  echo $quarter_year->quarter_label; ?></th>

                  <?php }

               ?>
               <th align="center" colspan="6">Total</th>

               <!-- <th></th> -->

            </tr>      

            <tr>

              <th>Product</th>

               <?php $i=1; foreach ($get_quarter_year as $quarter_year) { ${"l_col$i"} = 0; ${"o_col$i"} = 0; ${"q_col$i"} = 0; ${"pi_col$i"} = 0; ${"bo_col$i"} = 0; ?>

                     <th align="center" >Lead</th>

                     <th align="center" >Opportunity</th>

                     <th align="center" >Quote</th>

                     <th align="center" >PI</th>

                     <th align="center" >Order</th>

              <?php $i++; } ?>
              <?php if(count($get_quarter_year) > 1){ ?>
              <th align="center" >Lead</th>

               <th align="center" >Opportunity</th>

               <th align="center" >Quote</th>

               <th align="center" >PI</th>

               <th align="center" >Order</th>
               
               <th align="center" >Grand Total</th>
              <?php } else { echo "<th></th>"; } ?>
            </tr>

         </thead>

         <tbody>

            <?php $l_tot =0; $o_tot = 0; $q_tot = 0; $pi_tot = 0; $bo_tot = 0;

             foreach ($get_all_product as $product) { 
              ?>

              <tr>

                <th><?php echo $product->product_name; ?></th>

                 <?php

                     $i=1; $l_row_tot = 0; $o_row_tot = 0; $q_row_tot = 0; $pi_row_tot = 0; $bo_row_tot = 0; foreach ($get_quarter_year as $quarter_year) { 

                        if ($i == 1) {

                          $q_s_month = $yr1.'-'.$quarter_year->start_month_date;

                          $q_e_month = $yr1.'-'.$quarter_year->end_month_date;

                        }

                        elseif ($i == 2) {

                          $q_s_month = $yr1.'-'.$quarter_year->start_month_date;

                          $q_e_month = $yr1.'-'.$quarter_year->end_month_date;

                        }

                        elseif ($i == 3) {

                          $q_s_month = $yr1.'-'.$quarter_year->start_month_date;

                          $q_e_month = $yr1.'-'.$quarter_year->end_month_date; 

                        }

                        elseif ($i == 4) {

                          $q_s_month = $yr2.'-'.$quarter_year->start_month_date;

                          $q_e_month = $yr2.'-'.$quarter_year->end_month_date;

                        }

                        ?>

                      

                      

                       <th align="center" ><?php $get_lead_counts = get_lead_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_lead_counts->lead_count == '0') ? '-' : $get_lead_counts->lead_count; $l_row_tot = $l_row_tot + $get_lead_counts->lead_count; ${"l_col$i"} = ${"l_col$i"} + $get_lead_counts->lead_count; ?></th>

                       <th align="center" ><?php $get_oppo_counts = get_oppo_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_oppo_counts->lead_count == '0') ? '-' : $get_oppo_counts->lead_count; $o_row_tot = $o_row_tot + $get_oppo_counts->lead_count; ${"o_col$i"} = ${"o_col$i"} + $get_oppo_counts->lead_count; ?></th>

                       <th align="center" ><?php $get_quote_counts = get_quote_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_quote_counts->quote_count == '0') ? '-' : $get_quote_counts->quote_count; $q_row_tot = $q_row_tot + $get_quote_counts->quote_count; ${"q_col$i"} = ${"q_col$i"} + $get_quote_counts->quote_count; ?></th>

                       <th align="center" ><?php $get_pi_counts = get_pi_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_pi_counts->pi_count == '0') ? '-' : $get_pi_counts->pi_count; $pi_row_tot = $pi_row_tot + $get_pi_counts->pi_count; ${"pi_col$i"} = ${"pi_col$i"} + $get_pi_counts->pi_count; ?></th>

                       <th align="center" ><?php $get_order_counts = get_order_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_order_counts->order_count == '0') ? '-' : $get_order_counts->order_count; $bo_row_tot = $bo_row_tot + $get_order_counts->order_count; ${"bo_col$i"} = ${"bo_col$i"} + $get_order_counts->order_count; ?></th>

                    <?php $i++; }

                 ?>

                 <?php if(count($get_quarter_year) > 1){ 
                  $l_tot = $l_tot + $l_row_tot; $o_tot = $o_tot + $o_row_tot; $q_tot = $q_tot + $q_row_tot; $pi_tot = $pi_tot + $pi_row_tot; $bo_tot = $bo_tot + $bo_row_tot;
                  ?>

                 <th align="center" ><?php echo ($l_row_tot == '0') ? '-' : $l_row_tot; ?></th>
                 <th align="center" ><?php echo ($o_row_tot == '0') ? '-' : $o_row_tot; ?></th>
                 <th align="center" ><?php echo ($q_row_tot == '0') ? '-' : $q_row_tot; ?></th>
                 <th align="center" ><?php echo ($pi_row_tot == '0') ? '-' : $pi_row_tot; ?></th>
                 <th align="center" ><?php echo ($bo_row_tot == '0') ? '-' : $bo_row_tot; ?></th>
                 <?php } ?>
                 <th><?php echo $l_row_tot + $o_row_tot + $q_row_tot + $pi_row_tot + $bo_row_tot; $single_q_tot = $single_q_tot + ($l_row_tot + $o_row_tot + $q_row_tot + $pi_row_tot + $bo_row_tot); ?></th>
            </tr>

            <?php }  ?>

         </tbody>

         <tfoot>

            <tr>

               <th><b><h5>Total</h5></b></th>

               

               

              

              

                 <?php

                     $i=1;foreach ($get_quarter_year as $quarter_year) { 

                        

                        ?>

                      

                      

                       <th align="center" ><?php echo (${"l_col$i"} == '0') ? '-' : ${"l_col$i"}; ?></th>

                       <th align="center" ><?php echo (${"o_col$i"} == '0') ? '-' : ${"o_col$i"}; ?></th>

                       <th align="center" ><?php echo (${"q_col$i"} == '0') ? '-' : ${"q_col$i"}; ?></th>

                       <th align="center" ><?php echo (${"pi_col$i"} == '0') ? '-' : ${"pi_col$i"}; ?></th>

                       <th align="center" ><?php echo (${"bo_col$i"} == '0') ? '-' : ${"bo_col$i"}; ?></th>

                    <?php  $i++; }

                 ?>

                 <?php if(count($get_quarter_year) > 1) { ?>
                 <th align="center" ><?php echo ($l_tot == '0') ? '-' : $l_tot; ?></th>
                 <th align="center" ><?php echo ($o_tot == '0') ? '-' : $o_tot; ?></th>
                 <th align="center" ><?php echo ($q_tot == '0') ? '-' : $q_tot; ?></th>
                 <th align="center" ><?php echo ($pi_tot == '0') ? '-' : $pi_tot; ?></th>
                 <th align="center" ><?php echo ($bo_tot == '0') ? '-' : $bo_tot; ?></th>
               <?php } ?>
                  <th><?php echo (count($get_quarter_year) > 1) ? $foot_tot = $l_tot + $o_tot + $q_tot + $pi_tot + $bo_tot : $single_q_tot; ?></th>

           

           

            </tr>

         </tfoot>

      </table>

    <?php } elseif ($day_filt == 'thisyear') { ?>

      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost" width="100%">

         <thead>

            <tr>

               <th></th>

               <?php

                    foreach ($get_quarter_year as $quarter_year) { ?>

  

                    

                     <th data-orderable="false" align="center" colspan="5"><?php echo $quarter_year->quarter_label; ?></th>

                  <?php }

               ?>

               <th></th>

            </tr>

            <tr>

              <th data-orderable="false">Product</th>

               <?php $i=1; foreach ($get_quarter_year as $quarter_year) { ${"l_col$i"} = 0; ${"o_col$i"} = 0; ${"q_col$i"} = 0; ${"pi_col$i"} = 0; ${"bo_col$i"} = 0; ?>

                     <th data-orderable="false" align="center" >Lead</th>

                     <th data-orderable="false" align="center" >Opportunity</th>

                     <th data-orderable="false" align="center" >Quote</th>

                     <th data-orderable="false" align="center" >PI</th>

                     <th data-orderable="false" align="center" >Order</th>

              <?php $i++; } ?>

              <th rowspan="2" data-orderable="false">Total</th>

            </tr>

         </thead>

         <tbody>

            <?php  foreach ($get_all_product as $product) { ?>

              <tr>

                <th data-orderable="false"><?php echo $product->product_name; ?></th>

                 <?php

                     $i=1; $l_row_tot = 0; $o_row_tot = 0; $q_row_tot = 0; $pi_row_tot = 0; $bo_row_tot = 0; foreach ($get_quarter_year as $quarter_year) { 

                        if ($i == 1) {

                          $q_s_month = date('Y').'-'.$quarter_year->start_month_date;

                          $q_e_month = date('Y').'-'.$quarter_year->end_month_date;

                        }

                        elseif ($i == 2) {

                          $q_s_month = date('Y').'-'.$quarter_year->start_month_date;

                          $q_e_month = date('Y').'-'.$quarter_year->end_month_date;

                        }

                        elseif ($i == 3) {

                          $q_s_month = date('Y').'-'.$quarter_year->start_month_date;

                          $q_e_month = date('Y').'-'.$quarter_year->end_month_date; 

                        }

                        elseif ($i == 4) {

                          $q_s_month = date('Y',strtotime('+1 year')).'-'.$quarter_year->start_month_date;

                          $q_e_month = date('Y',strtotime('+1 year')).'-'.$quarter_year->end_month_date;

                        }

                        ?>

                      

                      

                       <th data-orderable="false" align="center" ><?php $get_lead_counts = get_lead_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_lead_counts->lead_count == '0') ? '-' : $get_lead_counts->lead_count; $l_row_tot = $l_row_tot + $get_lead_counts->lead_count; ${"l_col$i"} = ${"l_col$i"} + $get_lead_counts->lead_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_oppo_counts = get_oppo_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_oppo_counts->lead_count == '0') ? '-' : $get_oppo_counts->lead_count; $o_row_tot = $o_row_tot + $get_oppo_counts->lead_count; ${"o_col$i"} = ${"o_col$i"} + $get_oppo_counts->lead_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_quote_counts = get_quote_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_quote_counts->quote_count == '0') ? '-' : $get_quote_counts->quote_count; $q_row_tot = $q_row_tot + $get_quote_counts->quote_count; ${"q_col$i"} = ${"q_col$i"} + $get_quote_counts->quote_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_pi_counts = get_pi_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_pi_counts->pi_count == '0') ? '-' : $get_pi_counts->pi_count; $pi_row_tot = $pi_row_tot + $get_pi_counts->pi_count; ${"pi_col$i"} = ${"pi_col$i"} + $get_pi_counts->pi_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_order_counts = get_order_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_order_counts->order_count == '0') ? '-' : $get_order_counts->order_count; $bo_row_tot = $bo_row_tot + $get_order_counts->order_count; ${"bo_col$i"} = ${"bo_col$i"} + $get_order_counts->order_count; ?></th>

                    <?php $i++; }

                 ?>

                 <th style="background: #f2ee87;" data-orderable="false"><?php echo $l_row_tot + $o_row_tot + $q_row_tot + $pi_row_tot + $bo_row_tot; ?></th>

            </tr>

            <?php } ?>

         </tbody>

         <tfoot>

            <tr>

               <th><b><h5>Total</h5></b></th>

               

               

              

              

                 <?php

                     $i=1; $foot_tot_l = 0;$foot_tot_o = 0;$foot_tot_q = 0;$foot_tot_pi = 0;$foot_tot_bo = 0; foreach ($get_quarter_year as $quarter_year) { 

                        

                        ?>

                      

                      

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php $foot_tot_l = $foot_tot_l + ${"l_col$i"}; echo (${"l_col$i"} == '0') ? '-' : ${"l_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php $foot_tot_o = $foot_tot_o + ${"o_col$i"}; echo (${"o_col$i"} == '0') ? '-' : ${"o_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php $foot_tot_q = $foot_tot_q + ${"q_col$i"}; echo (${"q_col$i"} == '0') ? '-' : ${"q_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php $foot_tot_pi = $foot_tot_pi + ${"pi_col$i"}; echo (${"pi_col$i"} == '0') ? '-' : ${"pi_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php $foot_tot_bo = $foot_tot_bo + ${"bo_col$i"}; echo (${"bo_col$i"} == '0') ? '-' : ${"bo_col$i"}; ?></th>

                    <?php $i++; }

                 ?>

                 <th style="background: #f2ee87;" data-orderable="false"><?php echo $foot_tot = $foot_tot_l + $foot_tot_o + $foot_tot_q + $foot_tot_pi + $foot_tot_bo; ?></th>

           

           

            </tr>

         </tfoot>

      </table>
      <table id="comparison_report_export" style="display: none;">

         <thead>

            <tr>

               <th></th>

               <?php

                    foreach ($get_quarter_year as $quarter_year) { ?>

                     <th align="center" colspan="5"><?php echo $quarter_year->quarter_label; ?></th>

                  <?php }

               ?>

               <th></th>

            </tr>

            <tr>

              <th>Product</th>

               <?php $i=1; foreach ($get_quarter_year as $quarter_year) { ${"l_col$i"} = 0; ${"o_col$i"} = 0; ${"q_col$i"} = 0; ${"pi_col$i"} = 0; ${"bo_col$i"} = 0; ?>

                     <th >Lead</th>

                     <th >Opportunity</th>

                     <th >Quote</th>

                     <th >PI</th>

                     <th >Order</th>

              <?php $i++; } ?>

              <th rowspan="2">Total</th>

            </tr>

         </thead>

         <tbody>

            <?php  foreach ($get_all_product as $product) { ?>

              <tr>

                <th><?php echo $product->product_name; ?></th>

                 <?php

                     $i=1; $l_row_tot = 0; $o_row_tot = 0; $q_row_tot = 0; $pi_row_tot = 0; $bo_row_tot = 0; foreach ($get_quarter_year as $quarter_year) { 

                        if ($i == 1) {

                          $q_s_month = date('Y').'-'.$quarter_year->start_month_date;

                          $q_e_month = date('Y').'-'.$quarter_year->end_month_date;

                        }

                        elseif ($i == 2) {

                          $q_s_month = date('Y').'-'.$quarter_year->start_month_date;

                          $q_e_month = date('Y').'-'.$quarter_year->end_month_date;

                        }

                        elseif ($i == 3) {

                          $q_s_month = date('Y').'-'.$quarter_year->start_month_date;

                          $q_e_month = date('Y').'-'.$quarter_year->end_month_date; 

                        }

                        elseif ($i == 4) {

                          $q_s_month = date('Y',strtotime('+1 year')).'-'.$quarter_year->start_month_date;

                          $q_e_month = date('Y',strtotime('+1 year')).'-'.$quarter_year->end_month_date;

                        }

                        ?>

                      

                      

                       <th ><?php $get_lead_counts = get_lead_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_lead_counts->lead_count == '0') ? '-' : $get_lead_counts->lead_count; $l_row_tot = $l_row_tot + $get_lead_counts->lead_count; ${"l_col$i"} = ${"l_col$i"} + $get_lead_counts->lead_count; ?></th>

                       <th ><?php $get_oppo_counts = get_oppo_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_oppo_counts->lead_count == '0') ? '-' : $get_oppo_counts->lead_count; $o_row_tot = $o_row_tot + $get_oppo_counts->lead_count; ${"o_col$i"} = ${"o_col$i"} + $get_oppo_counts->lead_count; ?></th>

                       <th ><?php $get_quote_counts = get_quote_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_quote_counts->quote_count == '0') ? '-' : $get_quote_counts->quote_count; $q_row_tot = $q_row_tot + $get_quote_counts->quote_count; ${"q_col$i"} = ${"q_col$i"} + $get_quote_counts->quote_count; ?></th>

                       <th ><?php $get_pi_counts = get_pi_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_pi_counts->pi_count == '0') ? '-' : $get_pi_counts->pi_count; $pi_row_tot = $pi_row_tot + $get_pi_counts->pi_count; ${"pi_col$i"} = ${"pi_col$i"} + $get_pi_counts->pi_count; ?></th>

                       <th ><?php $get_order_counts = get_order_compare_counts($sale_user,$q_s_month,$q_e_month,$product->product_id,$country); echo ($get_order_counts->order_count == '0') ? '-' : $get_order_counts->order_count; $bo_row_tot = $bo_row_tot + $get_order_counts->order_count; ${"bo_col$i"} = ${"bo_col$i"} + $get_order_counts->order_count; ?></th>

                    <?php $i++; }

                 ?>

                 <th><?php echo $l_row_tot + $o_row_tot + $q_row_tot + $pi_row_tot + $bo_row_tot; ?></th>

            </tr>

            <?php } ?>

         </tbody>

         <tfoot>

            <tr>

               <th>>Total</th>

               

               

              

              

                 <?php

                     $i=1;foreach ($get_quarter_year as $quarter_year) { 

                        

                        ?>

                      

                      

                       <th><?php echo (${"l_col$i"} == '0') ? '-' : ${"l_col$i"}; ?></th>

                       <th><?php echo (${"o_col$i"} == '0') ? '-' : ${"o_col$i"}; ?></th>

                       <th><?php echo (${"q_col$i"} == '0') ? '-' : ${"q_col$i"}; ?></th>

                       <th><?php echo (${"pi_col$i"} == '0') ? '-' : ${"pi_col$i"}; ?></th>

                       <th><?php echo (${"bo_col$i"} == '0') ? '-' : ${"bo_col$i"}; ?></th>

                    <?php $i++; }

                 ?>

                 <th><?php echo $foot_tot = ${"l_col1"} + ${"o_col1"} + ${"q_col1"} + ${"pi_col1"} + ${"bo_col1"}; ?></th>

           

           

            </tr>

         </tfoot>

      </table>

    <?php } else { ?>

      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost" width="100%">

         <thead>

            

            <tr>

              <th data-orderable="false">Product</th>

               <?php $i=1;  ${"l_col$i"} = 0; ${"o_col$i"} = 0; ${"q_col$i"} = 0; ${"pi_col$i"} = 0; ${"bo_col$i"} = 0; ?>

                     <th data-orderable="false" align="center" >Lead</th>

                     <th data-orderable="false" align="center" >Opportunity</th>

                     <th data-orderable="false" align="center" >Quote</th>

                     <th data-orderable="false" align="center" >PI</th>

                     <th data-orderable="false" align="center" >Order</th>

              

              <th data-orderable="false">Total</th>

            </tr>

         </thead>

         <tbody>

            <?php  foreach ($get_all_product as $product) { ?>

              <tr>

                <th data-orderable="false"><?php echo $product->product_name; ?></th>

                 <?php

                     $i=1; $l_row_tot = 0; $o_row_tot = 0; $q_row_tot = 0; $pi_row_tot = 0; $bo_row_tot = 0; 

                        

                        ?>

                      

                      

                       <th data-orderable="false" align="center" ><?php $get_lead_counts = get_lead_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_lead_counts->lead_count == '0') ? '-' : $get_lead_counts->lead_count; $l_row_tot = $l_row_tot + $get_lead_counts->lead_count; ${"l_col$i"} = ${"l_col$i"} + $get_lead_counts->lead_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_oppo_counts = get_oppo_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_oppo_counts->lead_count == '0') ? '-' : $get_oppo_counts->lead_count; $o_row_tot = $o_row_tot + $get_oppo_counts->lead_count; ${"o_col$i"} = ${"o_col$i"} + $get_oppo_counts->lead_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_quote_counts = get_quote_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_quote_counts->quote_count == '0') ? '-' : $get_quote_counts->quote_count; $q_row_tot = $q_row_tot + $get_quote_counts->quote_count; ${"q_col$i"} = ${"q_col$i"} + $get_quote_counts->quote_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_pi_counts = get_pi_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_pi_counts->pi_count == '0') ? '-' : $get_pi_counts->pi_count; $pi_row_tot = $pi_row_tot + $get_pi_counts->pi_count; ${"pi_col$i"} = ${"pi_col$i"} + $get_pi_counts->pi_count; ?></th>

                       <th data-orderable="false" align="center" ><?php $get_order_counts = get_order_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_order_counts->order_count == '0') ? '-' : $get_order_counts->order_count; $bo_row_tot = $bo_row_tot + $get_order_counts->order_count; ${"bo_col$i"} = ${"bo_col$i"} + $get_order_counts->order_count; ?></th>

                    

                 <th style="background: #f2ee87;" data-orderable="false"><?php echo $l_row_tot + $o_row_tot + $q_row_tot + $pi_row_tot + $bo_row_tot; ?></th>

            </tr>

            <?php } ?>

         </tbody>

         <tfoot>

            <tr>

               <th><b><h5>Total</h5></b></th>

               

                      

                      

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"l_col$i"} == '0') ? '-' : ${"l_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"o_col$i"} == '0') ? '-' : ${"o_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"q_col$i"} == '0') ? '-' : ${"q_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"pi_col$i"} == '0') ? '-' : ${"pi_col$i"}; ?></th>

                       <th style="background: #f2ee87;" data-orderable="false" align="center" ><?php echo (${"bo_col$i"} == '0') ? '-' : ${"bo_col$i"}; ?></th>

                   

                 <th style="background: #f2ee87;" data-orderable="false"><?php echo $foot_tot = ${"l_col1"} + ${"o_col1"} + ${"q_col1"} + ${"pi_col1"} + ${"bo_col1"}; ?></th>

           

           

            </tr>

         </tfoot>

      </table>
      <table id="comparison_report_export" style="display: none;">

         <thead>

            

            <tr>

              <th>Product</th>

               <?php $i=1;  ${"l_col$i"} = 0; ${"o_col$i"} = 0; ${"q_col$i"} = 0; ${"pi_col$i"} = 0; ${"bo_col$i"} = 0; ?>

                     <th>Lead</th>

                     <th>Opportunity</th>

                     <th>Quote</th>

                     <th>PI</th>

                     <th>Order</th>

              

              <th>Total</th>

            </tr>

         </thead>

         <tbody>

            <?php  foreach ($get_all_product as $product) { ?>

              <tr>

                <th><?php echo $product->product_name; ?></th>

                 <?php

                     $i=1; $l_row_tot = 0; $o_row_tot = 0; $q_row_tot = 0; $pi_row_tot = 0; $bo_row_tot = 0; 

                        

                        ?>

                      

                      

                       <th><?php $get_lead_counts = get_lead_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_lead_counts->lead_count == '0') ? '-' : $get_lead_counts->lead_count; $l_row_tot = $l_row_tot + $get_lead_counts->lead_count; ${"l_col$i"} = ${"l_col$i"} + $get_lead_counts->lead_count; ?></th>

                       <th><?php $get_oppo_counts = get_oppo_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_oppo_counts->lead_count == '0') ? '-' : $get_oppo_counts->lead_count; $o_row_tot = $o_row_tot + $get_oppo_counts->lead_count; ${"o_col$i"} = ${"o_col$i"} + $get_oppo_counts->lead_count; ?></th>

                       <th><?php $get_quote_counts = get_quote_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_quote_counts->quote_count == '0') ? '-' : $get_quote_counts->quote_count; $q_row_tot = $q_row_tot + $get_quote_counts->quote_count; ${"q_col$i"} = ${"q_col$i"} + $get_quote_counts->quote_count; ?></th>

                       <th><?php $get_pi_counts = get_pi_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_pi_counts->pi_count == '0') ? '-' : $get_pi_counts->pi_count; $pi_row_tot = $pi_row_tot + $get_pi_counts->pi_count; ${"pi_col$i"} = ${"pi_col$i"} + $get_pi_counts->pi_count; ?></th>

                       <th><?php $get_order_counts = get_order_compare_counts_by_single($sale_user,$day_filt,$dtrange,$product->product_id,$country); echo ($get_order_counts->order_count == '0') ? '-' : $get_order_counts->order_count; $bo_row_tot = $bo_row_tot + $get_order_counts->order_count; ${"bo_col$i"} = ${"bo_col$i"} + $get_order_counts->order_count; ?></th>

                    

                 <th><?php echo $l_row_tot + $o_row_tot + $q_row_tot + $pi_row_tot + $bo_row_tot; ?></th>

            </tr>

            <?php } ?>

         </tbody>

         <tfoot>

            <tr>

               <th><b><h5>Total</h5></b></th>

               

                      

                      

                       <th><?php echo (${"l_col$i"} == '0') ? '-' : ${"l_col$i"}; ?></th>

                       <th><?php echo (${"o_col$i"} == '0') ? '-' : ${"o_col$i"}; ?></th>

                       <th><?php echo (${"q_col$i"} == '0') ? '-' : ${"q_col$i"}; ?></th>

                       <th><?php echo (${"pi_col$i"} == '0') ? '-' : ${"pi_col$i"}; ?></th>

                       <th><?php echo (${"bo_col$i"} == '0') ? '-' : ${"bo_col$i"}; ?></th>

                   

                 <th><?php echo $foot_tot = ${"l_col1"} + ${"o_col1"} + ${"q_col1"} + ${"pi_col1"} + ${"bo_col1"}; ?></th>

           

           

            </tr>

         </tfoot>

      </table>
    <?php } ?>

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

        });

    }

};

DatatablesBasicScrollable.init().fnDestroy();

  jQuery(document).ready(function() {

       DatatablesBasicScrollable.init()

   }); 



</script>