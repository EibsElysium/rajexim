<div class="row">
   <div class="col-lg-12">
      <table class="table table-striped- table-bordered table-checkable m-table m-table--head-bg-theme usage_cost1" width="100%">
               <thead>
                  <tr>
                     <th data-orderable="false">Product</th>
                     <?php $i=1; foreach ($oppo_status_lists as $lead_status) { ?>
                     <th data-orderable="false"><?php echo $lead_status->oppo_status; ?></th>
                     
                     <?php ${"lscol$i"}=''; $i++; } ?>
                     <th data-orderable="false">Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($get_all_product as $product) { ?>
                     <tr>
                        <td><h5><?php echo $product->product_name; ?></h5></td>
                        <?php $sum_st_count = 0; $i=1; foreach ($oppo_status_lists as $lead_status) { ?>
                        <td align="center"><h5><?php $get_user_lead_count = get_user_lead_count_based_on_industry($lead_status->oppo_status_id,$product->product_id,$sale_user,$financial_year_from,$financial_year_to,$dt_range,$day_filt,$quarter); $sum_st_count = $sum_st_count + $get_user_lead_count->status_count; echo ($get_user_lead_count->status_count == 0) ? '-' : $get_user_lead_count->status_count; ?></h5></td>
                        <?php ${"lscol$i"}= (int)${"lscol$i"} + (int)$get_user_lead_count->status_count; $i++; } ?>
                        <td style="background: #f2ee87;" align="center"><h4  class="text-green"><?php echo ($sum_st_count == 0) ? '-' : $sum_st_count; ?></h4></td>
                     </tr>                                                   
                  <?php } ?>
               </tbody>
               <tfoot>
                     <tr>
                        <th>Total</th>
                        <?php $foot_count=0; $i=1; foreach ($oppo_status_lists as $lead_status) { ?>
                        <th align="center" style="background: #f2ee87;" data-orderable="false"><?php echo (${"lscol$i"} == 0) ? '-' : ${"lscol$i"}; ?></th>
                        
                        <?php $foot_count = (int)$foot_count + (int)${"lscol$i"}; $i++; } ?>
                        <th align="center" style="background: #f2ee87;"><h4 class="text-theme text-center"><b><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></b></h4></th>
                     </tr>
                  
               </tfoot>
            </table>
             <table id="oppo_report_export" style="display: none;">
               <thead>
                  <tr>
                     <th>Product</th>
                     <?php $i=1; foreach ($oppo_status_lists as $lead_status) { ?>
                     <th><?php echo $lead_status->oppo_status; ?></th>
                     
                     <?php ${"lscol$i"}=''; $i++; } ?>
                     <th>Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($get_all_product as $product) { ?>
                     <tr>
                        <td><?php echo $product->product_name; ?></td>
                        <?php $sum_st_count = 0; $i=1; foreach ($oppo_status_lists as $lead_status) { ?>
                        <td><?php $get_user_lead_count = get_user_lead_count_based_on_industry($lead_status->oppo_status_id,$product->product_id,$sale_user,$financial_year_from,$financial_year_to,$dt_range,$day_filt,$quarter); $sum_st_count = $sum_st_count + $get_user_lead_count->status_count; echo ($get_user_lead_count->status_count == 0) ? '-' : $get_user_lead_count->status_count; ?></td>
                        <?php ${"lscol$i"}= (int)${"lscol$i"} + (int)$get_user_lead_count->status_count; $i++; } ?>
                        <td><?php echo ($sum_st_count == 0) ? '-' : $sum_st_count; ?></td>
                     </tr>                                                   
                  <?php } ?>
               </tbody>
               <tfoot>
                     <tr>
                        <th>Total</th>
                        <?php $foot_count=0; $i=1; foreach ($oppo_status_lists as $lead_status) { ?>
                        <th><?php echo (${"lscol$i"} == 0) ? '-' : ${"lscol$i"}; ?></th>
                        
                        <?php $foot_count = (int)$foot_count + (int)${"lscol$i"}; $i++; } ?>
                        <th align="center"><h4 class="text-theme text-center"><b><?php echo ($foot_count == 0) ? '-' : $foot_count; ?></b></h4></th>
                     </tr>
                  
               </tfoot>
            </table>
   </div>
</div>
<script type="text/javascript">
   var DatatablesBasicScrollable1 = {
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
DatatablesBasicScrollable1.init().fnDestroy();
  jQuery(document).ready(function() {
       DatatablesBasicScrollable1.init()
   });
   </script>