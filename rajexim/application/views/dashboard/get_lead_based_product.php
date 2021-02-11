<div class="row">
   <div class="col-lg-12">
      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost" width="100%">
               <thead>
                  <tr>
                     <th data-orderable="false">Product</th>
                     <?php $i = 1; foreach ($lead_sources as $lead_source) { ?>
                     <th data-orderable="false"><?php echo $lead_source->lead_source; ?></th>
                     
                     <?php ${"lscol$i"} = ''; 
                     $i++; } ?>
                     <th data-orderable="false">Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($get_all_product as $product) { ?>
                     <tr>
                        <td><h5><?php echo $product->product_name; ?></h5></td>
                        <?php $i=1; $sum_st_count = 0; foreach ($lead_sources as $lead_source) { ?>
                        <td align="center"><h5><?php $get_user_lead_count = get_user_lead_based_on_product($lead_source->lead_source_id,$product->product_id,$yr1,$yr2,$sale_user,$dt_range,$day_filt,$quarter); $sum_st_count = $sum_st_count + $get_user_lead_count->lead_count; echo ($get_user_lead_count->lead_count == 0) ? '-' : $get_user_lead_count->lead_count; ?></h5></td>
                        <?php ${"lscol$i"} = (int)${"lscol$i"} + (int)$get_user_lead_count->lead_count; 
                        $i++; } ?>
                        <td style="background: #f2ee87;" align="center"><h4  class="text-green"><?php echo ($sum_st_count == 0) ? '-' : $sum_st_count; ?></h4></td>
                     </tr>                                                   
                  <?php } ?>
               </tbody>
               <tfoot>
                  <tr>
                     <th><b><h5>Total</h5></b></th>
                     <?php $i=1; $foot_count = 0; foreach ($lead_sources as $lead_source) { 
                        $foot_count = (int)$foot_count + (int)${"lscol$i"};
                      ?>
                        <th align="center" style="background: #f2ee87;" data-orderable="false"><?php echo (${"lscol$i"} == 0) ? '-' : ${"lscol$i"}; ?></th>  
                        <?php $i++; } ?>
                     <th align="center" style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo $foot_count; ?></b></h4></th>
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