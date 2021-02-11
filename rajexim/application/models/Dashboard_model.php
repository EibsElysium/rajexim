<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Dashboard_model database details
    Date    :29-02-2020 
****************************************************************/
class Dashboard_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  //To List all price tag Procedure
  public function get_lead_count_info()
  {
    $role_id = $_SESSION['admindata']['role_id'];
    $user_hasnt_product = $_SESSION['admindata']['user_hasnt_product'];
    $user_id = $_SESSION['admindata']['user_id'];
    if ($user_hasnt_product != 1) {
      $user_filt = "AND l.lead_assigned_to = '$user_id'";
      $user_filt_t = "AND lt.lead_assigned_to = '$user_id'";
    }
    else {
      $user_filt = ""; 
      $user_filt_t = "";
    }
    $result = $this->db->query("SELECT COUNT(l.lead_id) AS total_active_leads, 
                          (SELECT COUNT(lt.lead_id) FROM leads lt WHERE DATEDIFF(NOW(),lt.created_on) = 1 AND lt.status !=2 AND lt.status!=3 $user_filt_t) AS yesterday_leads, 
                          (SELECT COUNT(lt.lead_id) FROM leads lt WHERE DATEDIFF(NOW(),lt.created_on) = 0 AND lt.status !=2 AND lt.status!=3 $user_filt_t) AS today_leads 
                          FROM leads l WHERE l.status !=2 AND l.status!=3 $user_filt")->row();
    save_query_in_log();
    return $result;
  }
  public function get_opportunity_count_info()
  {
    $role_id = $_SESSION['admindata']['role_id'];
    $user_hasnt_product = $_SESSION['admindata']['user_hasnt_product'];
    $user_id = $_SESSION['admindata']['user_id'];
    if ($user_hasnt_product != 1) {
      $user_filt = "AND l.lead_assigned_to = '$user_id'";
      $user_filt_t = "AND lt.lead_assigned_to = '$user_id'";
    }
    else {
      $user_filt = ""; 
      $user_filt_t = "";
    }

    $result = $this->db->query("SELECT COUNT(l.lead_id) AS total_active_opportunities, 
                            (SELECT COUNT(lt.lead_id) FROM leads lt WHERE DATEDIFF(NOW(),lt.created_on) = 1 AND lt.status !=2 AND lt.status=3 $user_filt_t) AS yesterday_opportunities, 
                            (SELECT COUNT(lt.lead_id) FROM leads lt WHERE DATEDIFF(NOW(),lt.created_on) = 0 AND lt.status !=2 AND lt.status=3 $user_filt_t) AS today_opportunities 
                            FROM leads l WHERE l.status !=2 AND l.status=3 $user_filt")->row();
    save_query_in_log();
    return $result;
  }
  public function get_proforma_count_info()
  {
    $role_id = $_SESSION['admindata']['role_id'];
    $user_hasnt_product = $_SESSION['admindata']['user_hasnt_product'];
    $user_id = $_SESSION['admindata']['user_id'];
    if ($user_hasnt_product != 1) {
      $user_filt = "AND l.lead_assigned_to = '$user_id'";
      $user_filt_t = "AND lt.lead_assigned_to = '$user_id'";
    }
    else {
      $user_filt = ""; 
      $user_filt_t = "";
    }
    $result = $this->db->query("SELECT COUNT(pi.proforma_invoice_id) AS total_active_pro_inv, 
                            (SELECT COUNT(pit.proforma_invoice_id) FROM proforma_invoice pit, leads lt WHERE DATEDIFF(NOW(),pit.created_on) = 1 AND pi.lead_id = lt.lead_id AND pit.status !=2 $user_filt_t) AS yesterday_pro_inv, 
                            (SELECT COUNT(pit.proforma_invoice_id) FROM proforma_invoice pit, leads lt WHERE DATEDIFF(NOW(),pit.created_on) = 0 AND pi.lead_id = lt.lead_id AND pit.status !=2 $user_filt_t) AS today_pro_inv 
                            FROM proforma_invoice pi, leads l WHERE pi.status !=2 AND pi.lead_id = l.lead_id $user_filt")->row();
    save_query_in_log();
    return $result;
  }
  public function get_quotation_count_info()
  {
    $role_id = $_SESSION['admindata']['role_id'];
    $user_hasnt_product = $_SESSION['admindata']['user_hasnt_product'];
    $user_id = $_SESSION['admindata']['user_id'];
    if ($user_hasnt_product != 1) {
      $user_filt = "AND l.lead_assigned_to = '$user_id'";
      $user_filt_t = "AND lt.lead_assigned_to = '$user_id'";
    }
    else {
      $user_filt = ""; 
      $user_filt_t = "";
    }
    // SELECT COUNT(quo.quote_id) AS total_active_quo, (SELECT COUNT(quot.quote_id) FROM quote quot WHERE DATEDIFF(NOW(),quot.created_on) = 0 AND quot.status !=2 AND lt.lead_assigned_to = '1') AS today_quote, (SELECT COUNT(quot.quote_id) FROM quote quot WHERE DATEDIFF(NOW(),quot.created_on) = 1 AND quot.status !=2 AND lt.lead_assigned_to = '1') AS yesterday_quote FROM quote quo WHERE quo.status !=2 AND l.lead_assigned_to = '1'
    $result = $this->db->query("SELECT COUNT(quo.quote_id) AS total_active_quo,  
                            (SELECT COUNT(quot.quote_id) FROM quote quot, leads lt WHERE DATEDIFF(NOW(),quot.created_on) = 0 AND quot.status !=2 AND quot.lead_id = lt.lead_id $user_filt_t) AS today_quote,
                            (SELECT COUNT(quot.quote_id) FROM quote quot, leads lt WHERE DATEDIFF(NOW(),quot.created_on) = 1 AND quot.status !=2 AND quot.lead_id = lt.lead_id $user_filt_t) AS yesterday_quote
                            FROM quote quo, leads l WHERE quo.status !=2 AND quo.lead_id = l.lead_id $user_filt")->row();
    save_query_in_log();
    return $result;
  }
  public function get_lead_followup_notification_before_three_days_and_missed($after_day_count)
  {
    $result = $this->db->query("SELECT lf.*,cb.lead_name,p.product_name,u.name,ac.name AS country_name FROM lead_followups lf 
                            LEFT JOIN leads l ON l.lead_id = lf.lead_id
                            LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
                            LEFT JOIN ad_countries ac ON ac.id = cb.country
                            LEFT JOIN users u  ON u.user_id = lf.lead_assigned_to
                            LEFT JOIN products p ON p.product_id = l.product_id
                            WHERE (DATEDIFF(lf.followup_date, CURDATE()) < 0 AND lf.comments IS NULL AND lf.comment_status = 0) OR (DATEDIFF(lf.followup_date, CURDATE()) <= '$after_day_count' AND DATEDIFF(lf.followup_date,CURDATE()) >= 0 AND lf.comments IS NULL AND lf.comment_status = 0) ")->result();
    save_query_in_log();
    return $result;
  }
  public function get_incomplete_joborder_notificaiton_before_enddate($before_day_count)
  {
    $result = $this->db->query("SELECT jo.*,u.name, v.vendor_name,v.city AS vendor_city,joi.items,p.product_name FROM job_order jo 
                            LEFT JOIN users u ON u.user_id = jo.employee_id
                            LEFT JOIN supplier_purchase_order spo ON spo.supplier_purchase_order_id = jo.supplier_purchase_order_id
                            LEFT JOIN job_order_item joi ON joi.job_order_id = jo.job_order_id
                            LEFT JOIN products p ON p.product_id = joi.items
                            LEFT JOIN vendor v ON v.vendor_id = spo.vendor_id
                            WHERE DATEDIFF(jo.job_order_end_date,CURDATE()) <= '$before_day_count' AND jo.is_complete = 0")->result();
    save_query_in_log();
    return $result;
  }
  public function get_incomplete_buyerorder_notificaiton_before_enddate($before_day_count)
  {
    $result = $this->db->query("SELECT bo.*,cb.lead_name,ac.name AS lead_country,l.lead_assigned_to,u.name,DATEDIFF(bo.order_end_date,CURDATE()),GROUP_CONCAT(pi.product_item) AS product_item_name,GROUP_CONCAT(p.product_name) AS products_name FROM buyer_order bo 
      LEFT JOIN leads l ON l.lead_id = bo.lead_id
      LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
      LEFT JOIN ad_countries ac ON ac.id = cb.country
      LEFT JOIN users u ON u.user_id = l.lead_assigned_to
      LEFT JOIN buyer_order_product bop ON bop.buyer_order_id = bo.buyer_order_id
      LEFT JOIN product_items pi ON pi.product_item_id = bop.product_item_id
      LEFT JOIN products p ON p.product_id = pi.product_id
      WHERE DATEDIFF(bo.order_end_date,CURDATE()) <= '$before_day_count' AND bo.is_complete = 0 GROUP BY bo.buyer_order_id")->result();
    save_query_in_log();
    return $result;
  }

  public function get_funnel_report_counts($yr1,$yr2,$user,$product)
  {
      $fdate = $yr1.'-04-01';
      $tdate = $yr2.'-03-31';

      // $current_month = date('m');
      // $current_year = date('Y');
      // if($current_month>=1 && $current_month<=3)
      // {
      //   $start_date = strtotime('1-January-'.$current_year);  // timestamp or 1-Januray 12:00:00 AM
      //   $end_date = strtotime('1-April-'.$current_year);  // timestamp or 1-April 12:00:00 AM means end of 31 March
      // }
      // else  if($current_month>=4 && $current_month<=6)
      // {
      //   $start_date = strtotime('1-April-'.$current_year);  // timestamp or 1-April 12:00:00 AM
      //   $end_date = strtotime('1-July-'.$current_year);  // timestamp or 1-July 12:00:00 AM means end of 30 June
      // }
      // else  if($current_month>=7 && $current_month<=9)
      // {
      //   $start_date = strtotime('1-July-'.$current_year);  // timestamp or 1-July 12:00:00 AM
      //   $end_date = strtotime('1-October-'.$current_year);  // timestamp or 1-October 12:00:00 AM means end of 30 September
      // }
      // else  if($current_month>=10 && $current_month<=12)
      // {
      //   $start_date = strtotime('1-October-'.$current_year);  // timestamp or 1-October 12:00:00 AM
      //   $end_date = strtotime('1-January-'.($current_year+1));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
      // }
      // echo date('Y-m-d',$start_date);
      // echo "<br>";
      // echo date('Y-m-d',$end_date);
      // die();
      if ($user != '') {
        $lead_users_filt = "AND l.lead_assigned_to = '$user'";
        $oppo_users_filt = "AND l.lead_assigned_to = '$user'";
        $quote_users_filt = "AND l.lead_assigned_to = '$user'";
        $proforma_users_filt = "AND l.lead_assigned_to = '$user'";
        $bo_users_filt = "AND l.lead_assigned_to = '$user'";
      }
      else {
        $lead_users_filt = "";
        $oppo_users_filt = "";
        $quote_users_filt = "";
        $proforma_users_filt = "";
        $bo_users_filt = ""; 
      }
      if ($product != '') {
        $lead_pro_filt = "AND l.product_id = '$product'";
        $oppo_pro_filt = "AND l.product_id = '$product'";
        $quote_pro_filt = "AND p.product_id = '$product'";
        $proforma_pro_filt = "AND p.product_id = '$product'";
        $bo_pro_filt = "AND p.product_id = '$product'"; 
      }
      else {
        $lead_pro_filt = "";
        $oppo_pro_filt = "";
        $quote_pro_filt = "";
        $proforma_pro_filt = "";
        $bo_pro_filt = ""; 
      }
      // echo "SELECT  (
      //                 SELECT COUNT(l.lead_id)
      //                 FROM   leads l WHERE l.status !=2 AND l.lead_type_id != 1 AND l.lead_status_id != 3 $lead_users_filt $lead_pro_filt AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')
      //                 ) AS lead_count,
      //                 (
      //                 SELECT COUNT(*) FROM leads l 
      //                 WHERE l.status = 3 $oppo_pro_filt $oppo_users_filt AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')
      //                 ) AS opportunity_count,
                      
      //                 (
      //                 SELECT COUNT(*) FROM (SELECT COUNT(q.quote_id) FROM quote q 
      //                 LEFT JOIN leads l ON q.lead_id = l.lead_id
      //                 LEFT JOIN quote_product qp ON qp.quote_id = q.quote_id
      //                 LEFT JOIN product_items pri ON pri.product_item_id = qp.product_item_id
      //                 LEFT JOIN products p ON p.product_id = pri.product_id
      //                 WHERE q.status != 2 $quote_users_filt $quote_pro_filt AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') GROUP BY qp.quote_id) AS sub_q
      //                 ) AS quotation_count,
                      
      //                 (
      //                 SELECT COUNT(*) FROM (SELECT COUNT(pro_inv.proforma_invoice_id) FROM proforma_invoice pro_inv 
      //                 LEFT JOIN leads l ON pro_inv.lead_id = l.lead_id
      //                 LEFT JOIN proforma_invoice_product pro_inv_pro ON pro_inv_pro.proforma_invoice_id = pro_inv.proforma_invoice_id
      //                 LEFT JOIN product_items pri ON pri.product_item_id = pro_inv_pro.product_item_id
      //                 LEFT JOIN products p ON p.product_id = pri.product_id
      //                 WHERE pro_inv.status != 2 $proforma_users_filt $proforma_pro_filt AND STR_TO_DATE(pro_inv.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pro_inv.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')  GROUP BY pro_inv_pro.proforma_invoice_id) AS sub_piv
      //                 ) AS proforma_invoice_count,
                      
      //                 (
      //                 SELECT COUNT(*) FROM (SELECT COUNT(o.buyer_order_id) FROM buyer_order o 
      //                 LEFT JOIN leads l ON o.lead_id = l.lead_id
      //                 LEFT JOIN buyer_order_product o_pro ON o_pro.buyer_order_id = o.buyer_order_id
      //                 LEFT JOIN product_items pri ON pri.product_item_id = o_pro.product_item_id
      //                 LEFT JOIN products p ON p.product_id = pri.product_id
      //                 WHERE o.status != 2 $bo_users_filt $bo_pro_filt AND STR_TO_DATE(o.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(o.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') GROUP BY o_pro.buyer_order_id) AS sub_bo
      //                 ) AS order_count
      //             FROM DUAL";
      //             die();
    $result = $this->db->query("SELECT  (
                      SELECT COUNT(l.lead_id)
                      FROM   leads l WHERE l.status !=2 AND l.lead_type_id != 1 AND l.lead_status_id != 3 $lead_users_filt $lead_pro_filt AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')
                      ) AS lead_count,
                      (
                      SELECT COUNT(*) FROM leads l 
                      WHERE l.status = 3 $oppo_pro_filt $oppo_users_filt AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')
                      ) AS opportunity_count,
                      
                      (
                      SELECT COUNT(*) FROM (SELECT COUNT(q.quote_id) FROM quote q 
                      LEFT JOIN leads l ON q.lead_id = l.lead_id
                      LEFT JOIN quote_product qp ON qp.quote_id = q.quote_id
                      LEFT JOIN product_items pri ON pri.product_item_id = qp.product_item_id
                      LEFT JOIN products p ON p.product_id = pri.product_id
                      WHERE q.status != 2 $quote_users_filt $quote_pro_filt AND STR_TO_DATE(q.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(q.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') GROUP BY qp.quote_id) AS sub_q
                      ) AS quotation_count,
                      
                      (
                      SELECT COUNT(*) FROM (SELECT COUNT(pro_inv.proforma_invoice_id) FROM proforma_invoice pro_inv 
                      LEFT JOIN leads l ON pro_inv.lead_id = l.lead_id
                      LEFT JOIN proforma_invoice_product pro_inv_pro ON pro_inv_pro.proforma_invoice_id = pro_inv.proforma_invoice_id
                      LEFT JOIN product_items pri ON pri.product_item_id = pro_inv_pro.product_item_id
                      LEFT JOIN products p ON p.product_id = pri.product_id
                      WHERE pro_inv.status != 2 $proforma_users_filt $proforma_pro_filt AND STR_TO_DATE(pro_inv.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(pro_inv.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d')  GROUP BY pro_inv_pro.proforma_invoice_id) AS sub_piv
                      ) AS proforma_invoice_count,
                      
                      (
                      SELECT COUNT(*) FROM (SELECT COUNT(o.buyer_order_id) FROM buyer_order o 
                      LEFT JOIN leads l ON o.lead_id = l.lead_id
                      LEFT JOIN buyer_order_product o_pro ON o_pro.buyer_order_id = o.buyer_order_id
                      LEFT JOIN product_items pri ON pri.product_item_id = o_pro.product_item_id
                      LEFT JOIN products p ON p.product_id = pri.product_id
                      WHERE o.status != 2 $bo_users_filt $bo_pro_filt AND STR_TO_DATE(o.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(o.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') GROUP BY o_pro.buyer_order_id) AS sub_bo
                      ) AS order_count
                  FROM DUAL")->row();
    
    save_query_in_log();
    return $result;
  }

  public function get_top_least_product($top_or_least,$yr1,$yr2,$top_least_count)
  {
    $fdate = $yr1.'-04-01';
    $tdate = $yr2.'-03-31';

    if ($top_or_least == 1) {
      $asc_desc = 'DESC';
    }
    else {
      $asc_desc = 'ASC';
    }

    $result = $this->db->query("SELECT COUNT(bop.product_item_id) AS product_order_count,p.product_name,p.product_id FROM buyer_order_product bop 
          LEFT JOIN product_items pi ON pi.product_item_id = bop.product_item_id 
          LEFT JOIN products p ON p.product_id = pi.product_id 
          LEFT JOIN buyer_order bo ON bo.buyer_order_id = bop.buyer_order_id 
          WHERE bop.status != 2  AND STR_TO_DATE(bo.order_date, '%Y-%m-%d') >= STR_TO_DATE('$fdate', '%Y-%m-%d') and STR_TO_DATE(bo.order_date, '%Y-%m-%d') <= STR_TO_DATE('$tdate', '%Y-%m-%d') GROUP BY pi.product_id ORDER BY product_order_count $asc_desc LIMIT $top_least_count")->result_array();
    
    save_query_in_log();
    return $result;
  }
  public function get_top_least_lead_source($top_or_least,$yr1,$yr2,$top_least_count)
  {
    $fdate = $yr1.'-04-01';
    $tdate = $yr2.'-03-31';

    if ($top_or_least == 1) {
      $asc_desc = 'DESC';
    }
    else {
      $asc_desc = 'ASC';
    }
    $result = $this->db->query("SELECT COUNT(l.lead_id) AS lead_source_counts,sls.sub_lead_source_id,sls.sub_lead_source,l.lead_source_id AS gained_lead_source,ls.lead_source_id,ls.lead_source FROM leads l 
              LEFT JOIN sub_lead_source sls ON sls.sub_lead_source_id = l.lead_source_id
              LEFT JOIN lead_source ls ON ls.lead_source_id = sls.lead_source_id
              WHERE l.status != 2 AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('$fdate', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('$tdate', '%Y-%m-%d') GROUP BY ls.lead_source_id ORDER BY lead_source_counts $asc_desc LIMIT $top_least_count")->result_array();
    
    save_query_in_log();
    return $result;
  }

  
  public function get_product_list()
  {
    $result = $this->db->query("CALL get_product_list()")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_user_list()
  {
    $result = $this->db->query("CALL get_user_list()")->result_array();
    save_query_in_log();
    return $result;
  } 

  public function get_users_allocated_industry($user_id)
  {
    $result = $this->db->query("CALL get_users_allocated_industry('".$user_id."')")->result();
    save_query_in_log();
    return $result;
  }
  public function get_all_product()
  {
    $result = $this->db->query("SELECT p.* FROM products p WHERE p.status != 2")->result();
    save_query_in_log();
    return $result; 
  }
  public function get_lead_followup_notification_before_three_days_and_missed_by_filt($lead_days_after, $assign_person, $product)
  {
    if ($assign_person != '') {
      $assign_person_filt = "AND lf.lead_assigned_to = '$assign_person'";
    }
    else {
      $assign_person_filt = ""; 
    }
    if ($product != '') {
      $product_filt = "AND l.product_id = '$product'";
    }
    else {
      $product_filt = ""; 
    }
   
    $result = $this->db->query("SELECT lf.*,cb.lead_name,p.product_name,u.name,ac.name AS country_name FROM lead_followups lf 
                            LEFT JOIN leads l ON l.lead_id = lf.lead_id
                            LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
                            LEFT JOIN ad_countries ac ON ac.id = cb.country
                            LEFT JOIN users u  ON u.user_id = lf.lead_assigned_to
                            LEFT JOIN products p ON p.product_id = l.product_id
                            WHERE lf.status != 2 AND (DATEDIFF(lf.followup_date, CURDATE()) < 0 AND lf.comments IS NULL AND lf.comment_status = 0) OR (DATEDIFF(lf.followup_date, CURDATE()) <= '$lead_days_after' AND DATEDIFF(lf.followup_date,CURDATE()) >= 0 AND lf.comments IS NULL AND lf.comment_status = 0) $product_filt $assign_person_filt")->result();
    save_query_in_log();
    return $result;

  }
  public function get_incomplete_joborder_notificaiton_before_enddate_by_filt($jo_days_before, $assign_person, $product)
  {
    if ($assign_person != '') {
      $assign_person_filt = "AND jo.employee_id = '$assign_person'";
    }
    else {
      $assign_person_filt = ""; 
    }
    if ($product != '') {
      $product_filt = "AND p.product_id = '$product'";
    }
    else {
      $product_filt = ""; 
    }
    $result = $this->db->query("SELECT jo.*,u.name, v.vendor_name,v.city AS vendor_city,joi.items,p.product_name FROM job_order jo 
                            LEFT JOIN users u ON u.user_id = jo.employee_id
                            LEFT JOIN supplier_purchase_order spo ON spo.supplier_purchase_order_id = jo.supplier_purchase_order_id
                            LEFT JOIN job_order_item joi ON joi.job_order_id = jo.job_order_id
                            LEFT JOIN products p ON p.product_id = joi.items
                            LEFT JOIN vendor v ON v.vendor_id = spo.vendor_id
                            WHERE jo.status != 2 $assign_person_filt $product_filt AND DATEDIFF(jo.job_order_end_date,CURDATE()) <= '$jo_days_before' AND jo.is_complete = 0")->result();
    save_query_in_log();
    return $result;
  }
  public function get_incomplete_buyerorder_notificaiton_before_enddate_by_filt($bo_days_before, $assign_person, $product)
  {
    if ($assign_person != '') {
      $assign_person_filt = "AND l.lead_assigned_to = '$assign_person'";
    }
    else {
      $assign_person_filt = ""; 
    }
    if ($product != '') {
      $product_filt = "AND p.product_id = '$product'";
    }
    else {
      $product_filt = ""; 
    }
    $result = $this->db->query("SELECT bo.*,cb.lead_name,ac.name AS lead_country,l.lead_assigned_to,u.name,DATEDIFF(bo.order_end_date,CURDATE()),GROUP_CONCAT(pi.product_item) AS product_item_name,GROUP_CONCAT(p.product_name) AS products_name FROM buyer_order bo 
      LEFT JOIN leads l ON l.lead_id = bo.lead_id
      LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
      LEFT JOIN ad_countries ac ON ac.id = cb.country
      LEFT JOIN users u ON u.user_id = l.lead_assigned_to
      LEFT JOIN buyer_order_product bop ON bop.buyer_order_id = bo.buyer_order_id
      LEFT JOIN product_items pi ON pi.product_item_id = bop.product_item_id
      LEFT JOIN products p ON p.product_id = pi.product_id
      WHERE bo.status != 2 $assign_person_filt $product_filt AND DATEDIFF(bo.order_end_date,CURDATE()) <= '$bo_days_before' AND bo.is_complete = 0 GROUP BY bo.buyer_order_id")->result();
    save_query_in_log();
    return $result;
  }
  public function get_lessmail_reply_notifications()
  {
    $result = $this->db->query("SELECT MAX(lmr.lead_mail_reply_id),COUNT(lmr.lead_mail_reply_id) AS lead_replies,l.*,u.name,ac.name as country_name,MAX(lmr.created_on) AS last_reply_date FROM lead_mail_reply lmr LEFT JOIN leads l ON l.lead_id = lmr.lead_id LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id LEFT JOIN ad_countries ac ON ac.id = cb.country LEFT JOIN users u ON u.user_id = l.lead_assigned_to AND l.status=0 GROUP BY lmr.lead_id ORDER BY l.lead_id ASC")->result();
    save_query_in_log();
    return $result; 
  }
  public function get_lessmail_reply_notifications_by_filt($assign_person, $product)
  {
    if ($assign_person != '') {
      $assign_person_filt = "AND l.lead_assigned_to = '$assign_person'";
    }
    else {
      $assign_person_filt = ""; 
    }
    if ($product != '') {
      $product_filt = "AND l.product_id = '$product'";
    }
    else {
      $product_filt = ""; 
    }
    $g_settings = common_select_values('*', 'general_settings', '', 'row');
    $min_days_of_fresh_lead = $g_settings->lead_replies_max;
    // $result = $this->db->query("SELECT COUNT(lmr.lead_mail_reply_id) AS lead_replies,l.*,u.name,ac.name AS country_name, cb.lead_name FROM lead_mail_reply lmr LEFT JOIN leads l ON l.lead_id = lmr.lead_id LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id  LEFT JOIN users u ON u.user_id = l.lead_assigned_to LEFT JOIN ad_countries ac ON ac.id = cb.country WHERE l.status != 2 $assign_person_filt $product_filt GROUP BY lmr.lead_id")->result();
    $result = $this->db->query("SELECT l.*, cb.lead_name, ac.name AS country_name, u.name AS assigned_person,p.product_name, (SELECT COUNT(lfc.lead_followup_id) FROM lead_followups lfc WHERE lfc.lead_id = l.lead_id) AS lead_followups_count, (SELECT COUNT(lmr.lead_mail_reply_id) FROM lead_mail_reply lmr WHERE lmr.lead_id = l.lead_id) AS lead_reply_count FROM leads l, contact_book cb, users u, ad_countries ac, products p WHERE l.status != 2 AND DATEDIFF(now(), l.created_on) > '$min_days_of_fresh_lead' AND cb.contact_book_id = l.contact_book_id AND u.user_id = l.lead_assigned_to AND ac.id = cb.country AND l.product_id = p.product_id AND l.status=0 $assign_person_filt $product_filt")->result();
    save_query_in_log();
    return $result;
  }
  public function get_product_by_id($quote_product)
  {
    $result = $this->db->query("SELECT p.* FROM products p WHERE p.product_id = '$quote_product'")->result();
    save_query_in_log();
    return $result; 
  }
  public function get_product_by_industry_id($industry_id)
  {
    $result = $this->db->query("SELECT p.* FROM products p WHERE p.industry_id = '$industry_id'")->result();
    save_query_in_log();
    return $result;
  } 
  public function get_product_by_industry_id_pro_id($industry_id,$product_id)
  {
    $result = $this->db->query("SELECT p.* FROM products p WHERE p.industry_id = '$industry_id' AND p.product_id = '$product_id'")->result();
    save_query_in_log();
    return $result;
  }
  public function get_lead_source_by_id($ls_filt)
  {
    // echo "SELECT ls.* FROM lead_source ls WHERE ls.status != 2 $ls_filt";
    // die();
    $result = $this->db->query("SELECT ls.* FROM lead_source ls WHERE ls.status != 2 $ls_filt")->result();
    save_query_in_log();
    return $result; 
  }
  public function get_lead_status_by_id($ls_filt)
  {
    // echo "SELECT ls.* FROM lead_status ls WHERE ls.status != 2 $ls_filt";
    // die();
    $result = $this->db->query("SELECT ls.* FROM oppo_status ls WHERE ls.status != 2 $ls_filt")->result();
    save_query_in_log();
    return $result; 
  }
  public function get_quote_stage_by_id($quote_stage_filt)
  {
    $result = $this->db->query("SELECT qs.* FROM quote_stage qs WHERE qs.status != 2 $quote_stage_filt")->result_array();
    save_query_in_log();
    return $result; 
  }
  public function get_pi_stage_by_id($pi_stage_id_filt)
  {
    $result = $this->db->query("SELECT pi.* FROM pi_stage pi WHERE pi.status != 2 $pi_stage_id_filt")->result_array();
    save_query_in_log();
    return $result; 
  }
  public function get_single_quarter_year_by_id($qqtr)
  { 
    $result = $this->db->query("SELECT qy.* FROM quarter_year qy WHERE qy.quarter_id = '$qqtr'")->row();
    save_query_in_log();
    return $result;
  }
  public function get_products_by_user_allocated($user_id)
  {
    $result = $this->db->query("SELECT up.*,p.* FROM user_products up,products p WHERE up.status != 2 AND up.product_id = p.product_id AND up.user_id = '$user_id'")->result();
    save_query_in_log();
    return $result;
  }
  
}
?>