<?php 
   $not_tot = get_notify_countByUser();
   $all_noti = get_notify_message();
?>

<?php $i=1; foreach ($all_noti as $noti) { 
   $noti_read = get_read_notify_message($_SESSION['user_id'],$noti->notification_id);
   $cont = get_notification_content($noti);
   if($noti_read==0)
      {
         $rcolor = '#e6f2fe';
      }
      else
      {
         $rcolor = '';
      }
      $agotime = time_elapsed_string_in_helper($noti->notificaton_added_date);
       ?>
   <div id="noti<?php echo $i;?>" style="cursor:pointer;background-color:<?php echo $rcolor; ?>;" class="m-list-timeline__item" onclick="read_single_notification(<?php echo $noti->notification_id;?>,<?php echo $i;?>);">
      <span class="m-list-timeline__badge -m-list-timeline__danger--state-success"></span>
      <span class="m-list-timeline__text"><p><?php echo $cont; ?></p> </span>
      <span class="m-list-timeline__time"><?php echo $agotime; ?></span>
   </div>
<?php $i++; } ?>
                           