<div class="timeline-items">
   <?php if (!empty($lead_notifications)) { 
      foreach ($lead_notifications as $lead_notification) {
      ?>
         <div class="timeline-item" onclick='window.open( 
              "<?php echo base_url(); ?>Leads/lead_view/<?php echo $lead_notification->lead_id; ?>", "_blank");'>
            <div class="timeline-media-<?php echo (date('Y-m-d') > date('Y-m-d',strtotime($lead_notification->followup_date))) ? 'job' : 'lead'; ?>">
               <?php echo date('M',strtotime($lead_notification->followup_date)); ?><br/><?php echo date('d',strtotime($lead_notification->followup_date)); ?>
            </div>
            <div class="timeline-content">
               <div class="d-flex align-items-center justify-content-between mb-3">
                  <div class="mr-2">                        
                     <b><?php echo ucfirst($lead_notification->lead_name); ?></b> from <b><?php echo ucfirst($lead_notification->country_name); ?></b> regarding <b><?php echo ucfirst($lead_notification->product_name); ?></b> has a sales follow up at <b><?php echo $lead_notification->followup_time; ?></b> to be  
                     followed by 
                     <span class="text-muted ml-2">
                     <?php echo ucfirst($lead_notification->name); ?>
                     </span>
                  </div>
               </div>
            </div>
         </div>
   <?php } } ?>
</div>