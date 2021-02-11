<div class="row">
   <div class="col-lg-12">
      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost2" width="100%">
               <thead class="thead-theme">
                  <tr>
                     <th data-orderable="false">Product</th>
                     <?php $i=1; foreach ($pi_stage_list as $pi_stage) { ?>
                     <th data-orderable="false"><?php echo $pi_stage['pi_stage']; ?></th>
                     
                     <?php ${"picol$i"} = ''; $i++; } ?>
                     <th data-orderable="false">Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($get_all_product as $product) { ?>
                     <tr>
                        <td><h5><?php echo $product->product_name; ?></h5></td>
                        <?php $i=1; $sum_st_count = 0; foreach ($pi_stage_list as $pi_stage) { ?>
                        <td align="center"><h5><?php 
                        $get_pi_count = get_pi_based_pi_stage($pi_stage['pi_stage_id'],$product->product_id,$yr1,$yr2,$sale_user,$dt_range,$day_filt,$quarter); 
                        $sum_st_count = $sum_st_count + $get_pi_count->pi_count; 
                        echo ($get_pi_count->pi_count==0) ? '-' : $get_pi_count->pi_count; ?></h5></td>
                        <?php ${"picol$i"} = (int)${"picol$i"} + (int)$get_pi_count->pi_count; $i++; } ?>
                        <td style="background: #f2ee87;" align="center"><h4  class="text-green"><?php echo ($sum_st_count == 0) ? '-' : $sum_st_count; ?></h4></td>
                     </tr>                                                   
                  <?php } ?>
               </tbody>
               <tfoot>
                     <tr>
                        <th>Total</th>
                        <?php $foot_count=0; $i=1; foreach ($pi_stage_list as $pi_stage) { ?>
                        <th align="center" style="background: #f2ee87;" data-orderable="false"><?php echo (${"picol$i"} == 0) ? '-' : ${"picol$i"}; ?></th>
                        
                        <?php $foot_count = (int)$foot_count + (int)${"picol$i"}; $i++; } ?>
                        <th align="center" style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></b></h4></th>
                     </tr>
                  
               </tfoot>
            </table>
            <table id="pi_report_export" style="display: none;">
               <thead>
                  <tr>
                     <th>Product</th>
                     <?php $i=1; foreach ($pi_stage_list as $pi_stage) { ?>
                     <th><?php echo $pi_stage['pi_stage']; ?></th>
                     
                     <?php ${"picol$i"} = ''; $i++; } ?>
                     <th>Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($get_all_product as $product) { ?>
                     <tr>
                        <td><?php echo $product->product_name; ?></td>
                        <?php $i=1; $sum_st_count = 0; foreach ($pi_stage_list as $pi_stage) { ?>
                        <td><?php 
                        $get_pi_count = get_pi_based_pi_stage($pi_stage['pi_stage_id'],$product->product_id,$yr1,$yr2,$sale_user,$dt_range,$day_filt,$quarter); 
                        $sum_st_count = $sum_st_count + $get_pi_count->pi_count; 
                        echo ($get_pi_count->pi_count==0) ? '-' : $get_pi_count->pi_count; ?></td>
                        <?php ${"picol$i"} = (int)${"picol$i"} + (int)$get_pi_count->pi_count; $i++; } ?>
                        <td><?php echo ($sum_st_count == 0) ? '-' : $sum_st_count; ?></td>
                     </tr>                                                   
                  <?php } ?>
               </tbody>
               <tfoot>
                     <tr>
                        <th>Total</th>
                        <?php $foot_count=0; $i=1; foreach ($pi_stage_list as $pi_stage) { ?>
                        <th><?php echo (${"picol$i"} == 0) ? '-' : ${"picol$i"}; ?></th>
                        
                        <?php $foot_count = (int)$foot_count + (int)${"picol$i"}; $i++; } ?>
                        <th><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></th>
                     </tr>
                  
               </tfoot>
            </table>
   </div>
</div>
<script type="text/javascript">
   var DatatablesBasicScrollable = {
    init: function() {
       
        $(".usage_cost2").DataTable({
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