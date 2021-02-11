<div class="timeline-items">
   <?php 
   $date_format = common_date_format();
   $g_settings = common_select_values('*', 'general_settings', '', 'row');
   $max_replies = $g_settings->lead_replies_max;
   if (!empty($lessmail_reply_notifications)) { 
      foreach ($lessmail_reply_notifications as $lessreply_notification) {
         if ($lessreply_notification->lead_followups_count == 0 && $lessreply_notification->lead_reply_count == 0) {
      ?>
   <div class="timeline-item">
      <div class="timeline-media-<?php echo (date('Y-m-d') > date('Y-m-d',strtotime($lessreply_notification->created_on))) ? 'job' : 'lead'; ?>">
         <?php echo date('M',strtotime($lessreply_notification->created_on)); ?><br/><?php echo date('d',strtotime($lessreply_notification->created_on)); ?>
      </div>
      <div class="timeline-content">
         <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="mr-3">  
               <b><?php echo ucfirst($lessreply_notification->lead_name); ?></b> From <b><?php echo ucfirst($lessreply_notification->country_name); ?></b>, Requested for <b><?php echo ucfirst($lessreply_notification->product_name); ?></b> On <b><?php echo date($date_format,strtotime($lessreply_notification->created_on)); ?></b>, This lead still Un-Attended By <b><?php echo ucfirst($lessreply_notification->assigned_person); ?></b>.          
               <span class="text-muted ml-2">
               </span>                        
            </div>
         </div>
      </div>
   </div>
   <?php } } } ?>
</div>