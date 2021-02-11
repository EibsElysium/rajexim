<div class="timeline-items">
   <?php if (!empty($joborder_notifications)) { 
      foreach ($joborder_notifications as $joborder_notification) {
      ?>
   <div class="timeline-item">
      <div class="timeline-media-<?php echo (date('Y-m-d') > date('Y-m-d',strtotime($joborder_notification->job_order_end_date))) ? 'job' : 'lead'; ?>">
         <?php echo date('M',strtotime($joborder_notification->job_order_end_date)); ?><br/><?php echo date('d',strtotime($joborder_notification->job_order_end_date)); ?>
      </div>
      <div class="timeline-content">
         <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="mr-3">                        
               <b><?php echo ucfirst($joborder_notification->product_name); ?></b> from <b><?php echo $joborder_notification->job_order_no; ?></b> given is <?php echo (date('Y-m-d') > date('Y-m-d',strtotime($joborder_notification->job_order_end_date))) ? 'over' : 'near'; ?> to due                 
               <span class="text-muted ml-2">
               <?php echo ucfirst($joborder_notification->vendor_name).'-'.ucfirst($joborder_notification->vendor_city); ?>
               </span>                        
            </div>
         </div>
      </div>
   </div>
   <?php } } ?>
</div>