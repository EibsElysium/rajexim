<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Notification database details
    Date    : 04-10-2018 
****************************************************************/
class Notification_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta'); 
    }
 /* ************************************************************************************
                        Purpose : To handle Notification  Function
            **********************************************************************/
    public function get_all_notification_type() {
    	$query = $this->db->query("CALL get_all_notification_type()")->result();
      save_query_in_log();
    	return $query;
    }
    public function get_all_notification($user_id,$ntype,$dtrange)
    {
    	$q_cond = '';
    	$dq_cond = '';
    	if ($ntype != '') {
    		$q_cond = "AND n.notification_type_id = '$ntype'";
    	}
    	if($dtrange != '')
        {
          $explode_date = explode(' / ', $dtrange);
          $startdate = $explode_date[0];

          $startdate = explode('-', $explode_date[0]);
          $startdate = $startdate[2].'-'.$startdate[1].'-'.$startdate[0];
        
          $enddate = explode('-', $explode_date[1]);
          $enddate = $enddate[2].'-'.$enddate[1].'-'.$enddate[0];

          $dq_cond = 'AND STR_TO_DATE(n.created_on, "%Y-%m-%d") >= STR_TO_DATE("'.$startdate.'", "%Y-%m-%d") and STR_TO_DATE(n.created_on, "%Y-%m-%d") <= STR_TO_DATE("'.$enddate.'", "%Y-%m-%d")';

        }

    	$datetime = new DateTime('tomorrow'); 
 		  $tdate = $datetime->format('Y-m-d H:i:s');
 		
    	$query = $this->db->query("SELECT n.*,nt.notification_type,nt.content,lap.product_name AS al_intrest_product,lcby.name AS lead_created_by_name, laby.name AS lead_assigned_to_name, alc.name AS add_lead_country,nlcb.lead_name, 
    lf.followup_date, lf.followup_time, lcby_lf.name AS lead_fup_cby_name, laby_lf.name AS lead_fup_aby_name, alc_lf.name AS lf_lead_country, lap_lf.product_name AS lf_product_name,nlcb_lf.lead_name AS lf_lead_name, tau.name AS task_allocated_person, tcu.name AS task_created_person, botau.name AS bo_task_allocated_person, botcu.name AS bo_task_created_person, t.task_title, t.priority, tct.task_title AS task_title_for_comments, tccu.name AS task_comment_create_user, bot.task AS bo_task, tcru.name AS task_comment_receiver,botccu.name AS bo_task_commentor, botcru.name AS bo_task_receiver, botr.task AS bo_comment_task FROM notification n

      LEFT JOIN notification_type nt ON nt.notification_type_id = n.notification_type_id

      LEFT JOIN leads l ON l.lead_id = n.lead_id
      LEFT JOIN contact_book nlcb ON nlcb.contact_book_id = l.contact_book_id
      LEFT JOIN products lap ON lap.product_id = l.product_id
      LEFT JOIN users lcby ON lcby.user_id = l.created_by
      LEFT JOIN users laby ON laby.user_id = l.lead_assigned_to
      LEFT JOIN ad_countries alc ON alc.id = nlcb.country 

      LEFT JOIN lead_followups lf ON lf.lead_followup_id = n.lead_followup_id
      LEFT JOIN leads lf_li ON lf_li.lead_id = lf.lead_id
      LEFT JOIN contact_book nlcb_lf ON nlcb_lf.contact_book_id = lf_li.contact_book_id
      LEFT JOIN products lap_lf ON lap_lf.product_id = lf_li.product_id
      LEFT JOIN users lcby_lf ON lcby_lf.user_id = lf.created_by
      LEFT JOIN users laby_lf ON laby_lf.user_id = lf.lead_assigned_to
      LEFT JOIN ad_countries alc_lf ON alc_lf.id = nlcb_lf.country 

      LEFT JOIN task t ON t.task_id = n.task_id
      LEFT JOIN users tau ON tau.user_id = t.assigned_to
      LEFT JOIN users tcu ON tcu.user_id = t.created_by

      LEFT JOIN task_comments tc ON tc.task_comments_id = n.task_comments_id
      LEFT JOIN task tct ON tct.task_id = tc.task_id
      LEFT JOIN users tccu ON tccu.user_id = n.created_by 
      LEFT JOIN users tcru ON tcru.user_id = n.notification_allow_to

      LEFT JOIN buyer_order_task bot ON bot.buyer_order_task_id = n.bo_task_id
      LEFT JOIN users botau ON botau.user_id = bot.assigned_to
      LEFT JOIN users botcu ON botcu.user_id = bot.created_by

      LEFT JOIN buyer_order_task botr ON botr.buyer_order_task_id = n.bo_task_id
      LEFT JOIN users botccu ON botccu.user_id = n.created_by 
      LEFT JOIN users botcru ON botcru.user_id = n.notification_allow_to

      WHERE n.created_on < '$tdate' AND find_in_set('$user_id', n.notification_allow_to) $q_cond $dq_cond
      ORDER BY n.created_on DESC LIMIT 10");
		  $result = $query->result(); 
      save_query_in_log();
		  return $result;
    }
} // class end
?>