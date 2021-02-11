<div class="row">
   <div class="col-lg-12">
      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost3" width="100%">
               <thead class="thead-theme">
                  <tr>
                     <th data-orderable="false">product</th>
                     <?php $i=1; foreach ($quote_stage_list as $quote_stage) { ?>
                     <th data-orderable="false"><?php echo $quote_stage['quote_stage']; ?></th>
                     
                     <?php ${"qscol$i"}=''; $i++; } ?>
                     <th data-orderable="false">Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php  foreach ($get_all_product as $product) { ?>
                     <tr>
                        <td><h5><?php echo $product->product_name; ?></h5></td>
                        <?php $sum_st_count = 0; $i=1; foreach ($quote_stage_list as $quote_stage) { ?>
                        <td align="center"><h5><?php 
                        $get_quote_count = get_quote_based_quote_stage($quote_stage['quote_stage_id'],$product->product_id,$yr1,$yr2,$sale_user,$dt_range,$day_filt,$quarter); 
                        $sum_st_count = $sum_st_count + $get_quote_count->quote_count; 
                        echo ($get_quote_count->quote_count == 0) ? '-' : $get_quote_count->quote_count; ?></h5></td>
                        <?php ${"qscol$i"} = (int)${"qscol$i"} + (int)$get_quote_count->quote_count; $i++; } ?>
                        <td style="background: #f2ee87;" align="center"><h4  class="text-green"><?php echo ($sum_st_count == 0) ? '-' : $sum_st_count; ?></h4></td>
                     </tr>                                                   
                  <?php } ?>
               </tbody>
               <tfoot>
                     <tr>
                        <th>Total</th>
                        <?php $foot_count=0; $i=1; foreach ($quote_stage_list as $quote_stage) { ?>
                        <th align="center" style="background: #f2ee87;"><?php echo (${"qscol$i"} == 0) ? '-' : ${"qscol$i"}; ?></th>
                        
                        <?php $foot_count = (int)$foot_count + (int)${"qscol$i"}; $i++; } ?>
                        <th align="center" style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></b></h4></th>
                     </tr>
                  
               </tfoot>
            </table>    
            <table id="quote_report_export" style="display: none;">
               <thead>
                  <tr>
                     <th>product</th>
                     <?php $i=1; foreach ($quote_stage_list as $quote_stage) { ?>
                     <th><?php echo $quote_stage['quote_stage']; ?></th>
                     
                     <?php ${"qscol$i"}=''; $i++; } ?>
                     <th>Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php  foreach ($get_all_product as $product) { ?>
                     <tr>
                        <td><?php echo $product->product_name; ?></td>
                        <?php $sum_st_count = 0; $i=1; foreach ($quote_stage_list as $quote_stage) { ?>
                        <td align="center"><?php 
                        $get_quote_count = get_quote_based_quote_stage($quote_stage['quote_stage_id'],$product->product_id,$yr1,$yr2,$sale_user,$dt_range,$day_filt,$quarter); 
                        $sum_st_count = $sum_st_count + $get_quote_count->quote_count; 
                        echo ($get_quote_count->quote_count == 0) ? '-' : $get_quote_count->quote_count; ?></td>
                        <?php ${"qscol$i"} = (int)${"qscol$i"} + (int)$get_quote_count->quote_count; $i++; } ?>
                        <td><?php echo ($sum_st_count == 0) ? '-' : $sum_st_count; ?></td>
                     </tr>                                                   
                  <?php } ?>
               </tbody>
               <tfoot>
                     <tr>
                        <th>Total</th>
                        <?php $foot_count=0; $i=1; foreach ($quote_stage_list as $quote_stage) { ?>
                        <th><?php echo (${"qscol$i"} == 0) ? '-' : ${"qscol$i"}; ?></th>
                        
                        <?php $foot_count = (int)$foot_count + (int)${"qscol$i"}; $i++; } ?>
                        <th><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></th>
                     </tr>
               </tfoot>
            </table> 
   </div>
</div>   
<script type="text/javascript">
   var DatatablesBasicScrollable = {
    init: function() {
       
        $(".usage_cost3").DataTable({
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