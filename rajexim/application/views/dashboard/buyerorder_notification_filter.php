<div class="timeline-items">
   <?php if (!empty($buyerorder_notifications)) { 
      foreach ($buyerorder_notifications as $buyerorder_notification) {
      ?>
   <div class="timeline-item" onclick='window.open( 
              "<?php echo base_url(); ?>buyerorder/buyerorder_view/<?php echo $buyerorder_notification->buyer_order_id;?>", "_blank");'>
      <div class="timeline-media-<?php echo (date('Y-m-d') > date('Y-m-d',strtotime($buyerorder_notification->order_end_date))) ? 'job' : 'lead'; ?>">
         <?php echo date('M',strtotime($buyerorder_notification->order_end_date)); ?><br/><?php echo date('d',strtotime($buyerorder_notification->order_end_date)); ?>
      </div>
      <div class="timeline-content">
         <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="mr-3">  
               The order code <b><?php echo $buyerorder_notification->buyer_order_invoice_no; ?></b> Assigned Person is <b><?php echo $buyerorder_notification->name; ?></b>, of this products (<b><?php echo ucfirst($buyerorder_notification->products_name); ?></b>) which its supplied to the buyer <?php echo (date('Y-m-d') > date('Y-m-d',strtotime($buyerorder_notification->order_end_date))) ? 'End date is Over' : 'will be ended soon'; ?> .

                              
               <span class="text-muted ml-2">
               <?php echo ucfirst($buyerorder_notification->lead_name).'-'.ucfirst($buyerorder_notification->lead_country); ?>
               </span>                        
            </div>
         </div>
      </div>
   </div>
   <?php } } ?>
</div>