<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the lead database details
    Date    :06-02-2020 
****************************************************************/
class Lead_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }

  /************************************************************************************************************
                                  Purpose : To handle all the lead type database details
                                  Date    : 06-02-2020 
                  ****************************************************************************/


  // To list lead type
  public function lead_type_list()
  {
     
    $result = $this->db->query("call lead_type_list()")->result();
     
    save_query_in_log();
    return $result;
  }
  // To check lead type is unique
  public function lead_type_unique($l_t_name)
  {
     
    $result = $this->db->query("call lead_type_unique('".$l_t_name."')")->row();
    save_query_in_log();
     
    return $result;
  }
   // To check lead type name is unique for edit form
  public function lead_type_unique_edit($l_t_name, $l_t_id)
  {
     
    $result = $this->db->query("call lead_type_unique_edit('".$l_t_name."', '".$l_t_id."')")->row();
    save_query_in_log();
     
    return $result;
  }
 
  // To get lead type by id 
  public function lead_type_by_id($l_t_id)
  {
     
    $result = $this->db->query("call lead_type_by_id('".$l_t_id."')")->row();
    save_query_in_log();
     
    return $result;
  }

  // To update lead type details
  public function lead_type_update($data, $l_t_id)
  {
    if($query = $this->db->query("call lead_type_update(

        '".$data['lead_type']."',
        '".$data['m_on']."',
        '".$data['m_by']."',
        '".$l_t_id."'
        
        )"))
        { 
        save_query_in_log();
        return true;
        }else{ return false; }
  }
  
  // To add lead type
  public function lead_type_add($data)
  {
    if($query = $this->db->query("call lead_type_add(

        '".$data['lead_type']."',
        '".$data['c_on']."',
        '".$data['c_by']."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
  
  public function lead_type_change_status($l_t_id, $status)
  {
    if($query = $this->db->query("call lead_type_change_status(
        '".$l_t_id."',
        '".$status."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
  // To check lead type in lead
  public function lead_type_in_lead($l_t_id)
  {
     
    $result = $this->db->query("call lead_type_in_lead('$l_t_id')")->result();
    save_query_in_log();
     
    return $result;
  }
/*********************************************************************************************************
                          Purpose : To handle all the lead source database details
                          Date    : 06-11-2019 
                  ****************************************************************/

  // To list lead source
  public function lead_source_list()
  {
     
    $result = $this->db->query("call lead_source_list()")->result();
    save_query_in_log();
     
    return $result;
  }
  // To check lead source name is unique
  public function lead_source_unique($l_s_name)
  {
     
    $result = $this->db->query("call lead_source_unique('".$l_s_name."')")->row();
    save_query_in_log();
     
    return $result;
  }
   // To check lead source name is unique for edit form
  public function lead_source_unique_edit($l_t_name, $l_t_id)
  {
     
    $result = $this->db->query("call lead_source_unique_edit('".$l_t_name."', '".$l_t_id."')")->row();
    save_query_in_log();
     
    return $result;
  }
 
  // To get lead source by id 
  public function lead_source_by_id($l_t_id)
  {
     
    $result = $this->db->query("call lead_source_by_id('".$l_t_id."')")->row();
    save_query_in_log();
     
    return $result;
  }

  // To update lead source details
  public function lead_source_update($data, $l_s_id)
  {
    $query = $this->db->query("call lead_source_update(
        '".$data['lead_source']."',
        '".$data['m_on']."',
        '".$data['m_by']."',
        '".$l_s_id."',
        '".$data['source_color']."'
        )");
       save_query_in_log(); 
       return 1;
  }
  
  // To add lead source
  public function lead_source_add($data)
  {
    if($query = $this->db->query("call lead_source_add(

        '".$data['lead_source']."',
        '".$data['c_on']."',
        '".$data['c_by']."',
        '".$data['lead_source_color']."'
        )"))
        {  save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
  
  public function lead_source_change_status($l_t_id, $status)
  {
    if($query = $this->db->query("call lead_source_change_status(
        '".$l_t_id."',
        '".$status."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
  // To check lead source in lead
  public function lead_source_in_lead($l_s_id)
  {
     
    $result = $this->db->query("call lead_source_in_lead('$l_s_id')")->result();
    save_query_in_log();
     
    return $result;
  }
   /************************************************************************************************************
                                  Purpose : To handle all the lead status database details
                                  Date    : 06-02-2020 
                  ****************************************************************************/
  // To list lead status
  public function lead_status_list()
  {
     
    $result = $this->db->query("call lead_status_list()")->result();
     
    save_query_in_log();
    return $result;
  }
  // To check lead status is unique
  public function lead_status_unique($l_s_name)
  {
     
    $result = $this->db->query("call lead_status_unique('".$l_s_name."')")->row();
    save_query_in_log();
     
    return $result;
  }
   // To check lead status name is unique for edit form
  public function lead_status_unique_edit($l_t_name, $l_t_id)
  {
     
    $result = $this->db->query("call lead_status_unique_edit('".$l_t_name."', '".$l_t_id."')")->row();
    save_query_in_log();
     
    return $result;
  }
 
  // To get lead status by id 
  public function lead_status_by_id($l_t_id)
  {
     
    $result = $this->db->query("call lead_status_by_id('".$l_t_id."')")->row();
    save_query_in_log();
    return $result;
  }

  // To update lead status details
  public function lead_status_update($data, $l_t_id)
  {
    if($query = $this->db->query("call lead_status_update(

        '".$data['lead_status']."',
        '".$data['m_on']."',
        '".$data['m_by']."',
        '".$l_t_id."'
        
        )"))
        { 
        save_query_in_log();
        return true;
        }else{ return false; }
  }
  
  // To add lead status
  public function lead_status_add($data)
  {
    if($query = $this->db->query("call lead_status_add(

        '".$data['lead_status']."',
        '".$data['c_on']."',
        '".$data['c_by']."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
  
  public function lead_status_change_status($l_t_id, $status)
  {
    if($query = $this->db->query("call lead_status_change_status(
        '".$l_t_id."',
        '".$status."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
  // To check lead status in lead
  public function lead_status_in_lead($l_t_id)
  {
    $result = $this->db->query("call lead_status_in_lead('$l_t_id')")->result();
    save_query_in_log();  
    return $result;
  }
  /*********************************************************************************************************
                          Purpose : To handle all the lead database details
                          Date    : 06-02-2020 
                  ****************************************************************/


  // To get country list
  public  function country_list()
  {
    $result = common_select_values('id, name', 'ad_countries', '', 'result');
        return $result; 
  } 
  // To get product industry details
  public function product_industry_by_product_id($product_id)                   
  {
    $result = common_select_values('p.product_id, p.industry_id, (select group_concat(industry_name) from industries where find_in_set(industry_id, p.industry_id) AND status !=2 )  as industry_name', 'products p', ' product_id = "'.$product_id.'"', 'row');
        return $result;
  }
  
  //
  // To check lead name unique
  public function lead_name_unique($l_name)
  {
       
      $result = $this->db->query("call lead_name_unique('".$l_name."')")->row();
      save_query_in_log();
       
      return $result;
  }
 
 
  // To list lead details
  public function lead_list($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $year, $month, $product_id, $tab, $lead_country, $lead_assigned_to, $page, $perpage , $search_val, $list_lsource, $product_sort, $country_sort, $leadsource_sort, $priority_sort, $status_sort, $user_sort,$created_on_sort,$leadname_sort,$dtrng_or_other)
  {

    $qcond = '';
    $tab_join = '';
    $tab_col_val = '';

    if ($search_val != '') {
      $sc = 'AND (cb.lead_name LIKE "%'.$search_val.'%" OR p.product_name LIKE "%'.$search_val.'%" OR contry.name LIKE "%'.$search_val.'%" OR u.name LIKE "%'.$search_val.'%" OR cb.email_id LIKE "%'.$search_val.'%" OR sls.sub_lead_source LIKE "%'.$search_val.'%" OR lt.lead_type LIKE "%'.$search_val.'%" OR lst.lead_status LIKE "%'.$search_val.'%" OR ls.lead_source LIKE "%'.$search_val.'%"  OR indus.industry_name LIKE "%'.$search_val.'%")';
    }
    else {
      $sc = '';
    }

    if ($lead_country != '') {
      $lc_filt = " AND cb.country = '$lead_country'";
    }
    else {
      $lc_filt = "";
    }
    if ($lead_assigned_to != '') {
      $la_filt = " AND l.lead_assigned_to IN ($lead_assigned_to)";
    }
    else {
      $la_filt = "";
    }
    if($tab == 1)
    {
      $tab_val = " AND l.status = 0 AND NOT EXISTS(SELECT lead_id FROM lead_followups WHERE lead_id = l.lead_id)";
    }
    else if($tab == 2)
    {
      // echo $tab;
      // echo "<br>";
      // echo "this is tab two";
      // die();
      $tab_val = "AND l.status = 0 AND EXISTS( SELECT lead_id FROM lead_followups WHERE lead_id = l.lead_id)";
      $tab_join = "LEFT JOIN  lead_followups fups on fups.lead_id = l.lead_id AND DATE(fups.followup_date) = DATE(NOW()) AND fups.status = 0";
      $tab_col_val = ", CASE WHEN (DATE(fups.followup_date) = DATE(NOW())) THEN GROUP_CONCAT(fups.followup_time) else 0 END as fup_status, fups.status as 'fupst'";
    }
    else if($tab == 3)
    {
      $tab_val = " AND l.status = 2";
    }
    else{

      $tab_val = '';
    }

    if($t_fup == 1 && $tab == 2)
    {
      $t_fups = " AND DATE(fups.followup_date) = DATE(NOW())";
    }
    else{
      $t_fups = "";
    }

    if($product_id != '')
    {
      $pv = " AND l.product_id IN ($product_id)";
    }
    else{
      $pv = "";
    }
  
    if($lead_type != '')
    {
      $lt = " AND l.lead_type_id = '$lead_type'";
    }
    else{
      $lt = "";
    }

    if($lead_source != '')
    {
      $ls = " AND l.lead_source_id = '$lead_source'";
    }
    else{
      $ls = "";
    }

    if($list_lsource != '')
    {
      $lls = " AND ls.lead_source_id = '$list_lsource'";
    }
    else{
      $lls = "";
    }

    if($lead_status != '')
    {
      $lst = " AND l.lead_status_id = '$lead_status'";
    }
    else{
      $lst = "";
    }

    $explode_date = '';
    $startdate = '';
    $enddate = '';
    $year_month = '';
    $get_n_of_records = '';
    if($year == '' && $month == '' && $lead_daterange == '')
    {
      $get_n_of_records = 'LIMIT 100';
    }
    else 
    {
      $get_n_of_records = '';
    }
    if($year != '' && $month != '' && $dtrng_or_other == 'All')
    {
      $year_month = $year.'-'.$month;
      $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
    }
    else if($dtrng_or_other != 'All'){
      if ($dtrng_or_other == 'today') {
        $year_month_val = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') = CURDATE()";
      }
      elseif ($dtrng_or_other == 'thisweek') {
        $year_month_val = "AND YEARWEEK(STR_TO_DATE(l.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
      }
      elseif ($dtrng_or_other == 'thismonth') {
        $year_month_val = "AND MONTH(STR_TO_DATE(l.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
      }
      elseif ($dtrng_or_other == 'thisyear') {
        $finstart = date('Y').'-01-01';
        $finend = date('Y').'-12-31';
        $year_month_val = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
      }
      elseif ($dtrng_or_other == 'dtrng') {
        if ($lead_daterange != '') {
          $explode_date = explode(' - ', $lead_daterange);
          $startdate = date('Y-m-d', strtotime($explode_date[0]));
          $enddate =date('Y-m-d', strtotime($explode_date[1]));

          $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
        }
        else {
          $year_month_val = '';
        }
      }
        
    }
    else{
      $year_month_val = "";
    }

    $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

    if($user_details->show_leads == 1)
    {
      $lead_assign_val == '';
    }
    else if($user_details->show_leads == 2)
    {
      $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
    }
    else if($user_details->show_leads == 3 && $user_details->product_users != '')
    {
      $lead_assign_val = " AND (FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."') OR l.lead_assigned_to = '".$_SESSION['admindata']['user_id']."')";
    }else{
        $lead_assign_val = '';
    }


    if ($product_sort != '') {
      if($product_sort == '0') {
        $sort_by = " ORDER BY p.product_name ASC";
      }
      else {
        $sort_by = " ORDER BY p.product_name DESC";
      }
    } else if ($country_sort != '') {
      if($country_sort == '0') {
        $sort_by = " ORDER BY contry.name ASC";
      }
      else {
        $sort_by = " ORDER BY contry.name DESC";
      }
    }
    else if ($leadsource_sort != '') {
      if($leadsource_sort == '0') {
        $sort_by = " ORDER BY sls.sub_lead_source ASC";
      }
      else {
        $sort_by = " ORDER BY sls.sub_lead_source DESC";
      }
    }
    else if ($priority_sort != '') {
      if($priority_sort == '0') {
        $sort_by = " ORDER BY lt.lead_type ASC";
      }
      else {
        $sort_by = " ORDER BY lt.lead_type DESC";
      }
    }
    else if ($status_sort != '') {
      if($status_sort == '0') {
        $sort_by = " ORDER BY lst.lead_status ASC";
      }
      else {
        $sort_by = " ORDER BY lst.lead_status DESC";
      }
    }
    else if ($user_sort != '') {
      if($user_sort == '0') {
        $sort_by = " ORDER BY u.name ASC";
      }
      else {
        $sort_by = " ORDER BY u.name DESC";
      }
    }
    
    else if ($leadname_sort != '') {
      if($leadname_sort == '0') {
        $sort_by = " ORDER BY cb.lead_name ASC";
      }
      else {
        $sort_by = " ORDER BY cb.lead_name DESC";
      }
    }
    else if ($created_on_sort != '') {
      if($created_on_sort == '0') {
        $sort_by = " ORDER BY l.created_on ASC";
      }
      else {
        $sort_by = " ORDER BY l.created_on DESC";
      }
    }
    else {
      $sort_by = " ORDER BY l.created_on DESC";
    }
    // echo $tab_col_val;
    // echo "<br>";
    // echo $tab_join;
    // echo "<br>";
    // echo $tab_val;
    $sql = $this->db->query("SELECT (SELECT COUNT(lmr.lead_id) FROM lead_mail_reply lmr WHERE lmr.lead_id = l.lead_id) AS mail_reply_count,l.lead_id, l.import_lead_mails, contry.name as country_name, l.lead_type_id,cb.*, l.lead_source_id, l.lead_taken_by,  l.created_on, l.created_by, l.modified_on, l.modified_by, l.status, lt.lead_type as lead_type_name, ls.lead_source as source_name, sls.sub_lead_source as sub_source_name, u.name as lead_assign_name, cu.name as lead_created_by, p.product_name, indus.industry_name, l.lead_status_id, lst.lead_status as lead_status_name,l.comments $tab_col_val
     FROM leads l
           LEFT JOIN  contact_book cb ON cb.contact_book_id = l.contact_book_id
           LEFT JOIN  lead_type lt on lt.lead_type_id = l.lead_type_id
           LEFT JOIN  lead_status lst on lst.lead_status_id = l.lead_status_id
           LEFT JOIN  sub_lead_source sls on sls.sub_lead_source_id = l.lead_source_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = sls.lead_source_id
           LEFT JOIN ad_countries contry ON contry.id = cb.country
           LEFT JOIN users u ON u.user_id = l.lead_assigned_to
           LEFT JOIN users cu ON cu.user_id = l.created_by
           LEFT JOIN  products p on p.product_id = l.product_id
           LEFT JOIN  industries indus on indus.industry_id = l.industry_id
           $tab_join
           WHERE l.status !=3 $year_month_val $tab_val $lead_assign_val  $lt $ls $lst $pv $t_fups $qcond $lc_filt $la_filt $sc $lls
           GROUP BY l.lead_id
           $sort_by LIMIT $page, $perpage
           ")->result(); 
    //save_query_in_log();
    return $sql; 
  }
  public function lead_list_count($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $year, $month, $product_id, $tab, $lead_country, $lead_assigned_to, $search_val, $list_lsource, $product_sort,$dtrng_or_other)
  {

    $qcond = '';
    $tab_join = '';
    $tab_col_val = '';

    if ($search_val != '') {
      $sc = 'AND (cb.lead_name LIKE "%'.$search_val.'%" OR p.product_name LIKE "%'.$search_val.'%" OR contry.name LIKE "%'.$search_val.'%" OR u.name LIKE "%'.$search_val.'%" OR cb.email_id LIKE "%'.$search_val.'%" OR sls.sub_lead_source LIKE "%'.$search_val.'%" OR lt.lead_type LIKE "%'.$search_val.'%" OR lst.lead_status LIKE "%'.$search_val.'%" OR ls.lead_source LIKE "%'.$search_val.'%"  OR indus.industry_name LIKE "%'.$search_val.'%")';
    }
    else {
      $sc = '';
    }
    if ($lead_country != '') {
      $lc_filt = " AND cb.country = '$lead_country'";
    }
    else {
      $lc_filt = "";
    }
    if ($lead_assigned_to != '') {
      $la_filt = " AND l.lead_assigned_to IN ($lead_assigned_to)";
    }
    else {
      $la_filt = "";
    }
    if($tab == 1)
    {
      $tab_val = " AND l.status = 0 AND NOT EXISTS(SELECT lead_id FROM lead_followups WHERE lead_id = l.lead_id)";
    }
    else if($tab == 2)
    {
      // echo $tab;
      // echo "<br>";
      // echo "this is tab two";
      // die();
      $tab_val = "AND l.status = 0 AND EXISTS( SELECT lead_id FROM lead_followups WHERE lead_id = l.lead_id)";
      $tab_join = "LEFT JOIN  lead_followups fups on fups.lead_id = l.lead_id AND DATE(fups.followup_date) = DATE(NOW()) AND fups.status = 0";
      $tab_col_val = ", CASE WHEN (DATE(fups.followup_date) = DATE(NOW())) THEN GROUP_CONCAT(fups.followup_time) else 0 END as fup_status, fups.status as 'fupst'";
    }
    else if($tab == 3)
    {
      $tab_val = " AND l.status = 2";
    }
    else{

      $tab_val = '';
    }

    if($t_fup == 1 && $tab == 2)
    {
      $t_fups = " AND DATE(fups.followup_date) = DATE(NOW())";
    }
    else{
      $t_fups = "";
    }

    if($product_id != '')
    {
      $pv = " AND l.product_id IN ($product_id)";
    }
    else{
      $pv = "";
    }
  
    if($lead_type != '')
    {
      $lt = " AND l.lead_type_id = '$lead_type'";
    }
    else{
      $lt = "";
    }

    if($lead_source != '')
    {
      $ls = " AND l.lead_source_id = '$lead_source'";
    }
    else{
      $ls = "";
    }

    if($list_lsource != '')
    {
      $lls = " AND ls.lead_source_id = '$list_lsource'";
    }
    else{
      $lls = "";
    }

    if($lead_status != '')
    {
      $lst = " AND l.lead_status_id = '$lead_status'";
    }
    else{
      $lst = "";
    }

    $explode_date = '';
    $startdate = '';
    $enddate = '';
    $year_month = '';
    $get_n_of_records = '';
    if($year == '' && $month == '' && $lead_daterange == '')
    {
      $get_n_of_records = 'LIMIT 100';
    }
    else 
    {
      $get_n_of_records = '';
    }
    if($year != '' && $month != '' && $dtrng_or_other == 'All')
    {
      $year_month = $year.'-'.$month;
      $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
    }
    else if($dtrng_or_other != 'All'){
      if ($dtrng_or_other == 'today') {
        $year_month_val = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') = CURDATE()";
      }
      elseif ($dtrng_or_other == 'thisweek') {
        $year_month_val = "AND YEARWEEK(STR_TO_DATE(l.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
      }
      elseif ($dtrng_or_other == 'thismonth') {
        $year_month_val = "AND MONTH(STR_TO_DATE(l.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
      }
      elseif ($dtrng_or_other == 'thisyear') {
        $finstart = date('Y').'-01-01';
        $finend = date('Y').'-12-31';
        $year_month_val = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
      }
      elseif ($dtrng_or_other == 'dtrng') {
        if ($lead_daterange != '') {
          $explode_date = explode(' - ', $lead_daterange);
          $startdate = date('Y-m-d', strtotime($explode_date[0]));
          $enddate =date('Y-m-d', strtotime($explode_date[1]));

          $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
        }
        else {
          $year_month_val = '';
        }
      }
        
    }
    else{
      $year_month_val = "";
    }

    $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

    if($user_details->show_leads == 1)
    {
      $lead_assign_val == '';
    }
    else if($user_details->show_leads == 2)
    {
      $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
    }
    else if($user_details->show_leads == 3 && $user_details->product_users != '')
    {
      $lead_assign_val = " AND (FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."') OR l.lead_assigned_to = '".$_SESSION['admindata']['user_id']."')";
    }else{
        $lead_assign_val = '';
    }
    // echo $tab_col_val;
    // echo "<br>";
    // echo $tab_join;
    // echo "<br>";
    // echo $tab_val;
    $sql = $this->db->query("SELECT (SELECT COUNT(lmr.lead_id) FROM lead_mail_reply lmr WHERE lmr.lead_id = l.lead_id) AS mail_reply_count,l.lead_id, l.import_lead_mails, contry.name as country_name, l.lead_type_id,cb.*, l.lead_source_id, l.lead_taken_by,  l.created_on, l.created_by, l.modified_on, l.modified_by, l.status, lt.lead_type as lead_type_name, ls.lead_source as source_name, sls.sub_lead_source as sub_source_name, u.name as lead_assign_name, cu.name as lead_created_by, p.product_name, indus.industry_name, l.lead_status_id, lst.lead_status as lead_status_name,l.comments $tab_col_val
     FROM leads l
           LEFT JOIN  contact_book cb ON cb.contact_book_id = l.contact_book_id
           LEFT JOIN  lead_type lt on lt.lead_type_id = l.lead_type_id
           LEFT JOIN  lead_status lst on lst.lead_status_id = l.lead_status_id
           LEFT JOIN  sub_lead_source sls on sls.sub_lead_source_id = l.lead_source_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = sls.lead_source_id
           LEFT JOIN ad_countries contry ON contry.id = cb.country
           LEFT JOIN users u ON u.user_id = l.lead_assigned_to
           LEFT JOIN users cu ON cu.user_id = l.created_by
           LEFT JOIN  products p on p.product_id = l.product_id
           LEFT JOIN  industries indus on indus.industry_id = l.industry_id
           $tab_join
           WHERE l.status !=3 $year_month_val $tab_val $lead_assign_val  $lt $ls $lst $pv $t_fups $qcond $lc_filt $la_filt $sc $lls
           GROUP BY l.lead_id
           ORDER BY l.created_on DESC
           ")->result(); 
    //save_query_in_log();
    return $sql; 
  }
  public function lead_list_row_count($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $year, $month, $product_id, $tab, $lead_country, $lead_assigned_to)
  {

    $qcond = '';
    // $tab_join = '';
    // $tab_col_val = '';

    if ($lead_country != '') {
      $lc_filt = " AND cb.country = '$lead_country'";
    }
    else {
      $lc_filt = "";
    }
    if ($lead_assigned_to != '') {
      $la_filt = " AND l.lead_assigned_to = '$lead_assigned_to'";
    }
    else {
      $la_filt = "";
    }
    if($tab == 1)
    {
      $tab_val = " AND l.status = 0 AND NOT EXISTS(SELECT lead_id FROM lead_followups WHERE lead_id = l.lead_id)";
    }
    else if($tab == 2)
    {
      // echo $tab;
      // echo "<br>";
      // echo "this is tab two";
      // die();
      $tab_val = "AND l.status = 0 AND EXISTS( SELECT lead_id FROM lead_followups WHERE lead_id = l.lead_id)";
      $tab_join = "LEFT JOIN  lead_followups fups on fups.lead_id = l.lead_id AND DATE(fups.followup_date) = DATE(NOW()) AND fups.status = 0";
      $tab_col_val = ", CASE WHEN (DATE(fups.followup_date) = DATE(NOW())) THEN GROUP_CONCAT(fups.followup_time) else 0 END as fup_status, fups.status as 'fupst'";
    }
    else if($tab == 3)
    {
      $tab_val = " AND l.status = 2";
    }
    else{

      $tab_val = '';
    }

    if($t_fup == 1 && $tab == 2)
    {
      $t_fups = " AND DATE(fups.followup_date) = DATE(NOW())";
    }
    else{
      $t_fups = "";
    }

    if($product_id != '')
    {
      $pv = " AND l.product_id = '$product_id'";
    }
    else{
      $pv = "";
    }
  
    if($lead_type != '')
    {
      $lt = " AND l.lead_type_id = '$lead_type'";
    }
    else{
      $lt = "";
    }

    if($lead_source != '')
    {
      $ls = " AND l.lead_source_id = '$lead_source'";
    }
    else{
      $ls = "";
    }

    if($lead_status != '')
    {
      $lst = " AND l.lead_status_id = '$lead_status'";
    }
    else{
      $lst = "";
    }

    $explode_date = '';
    $startdate = '';
    $enddate = '';
    $year_month = '';
    $get_n_of_records = '';
    if($year == '' && $month == '' && $lead_daterange == '')
    {
      $get_n_of_records = 'LIMIT 100';
    }
    else 
    {
      $get_n_of_records = '';
    }
    if($year != '' && $month != '' && $lead_daterange == '')
    {
      $year_month = $year.'-'.$month;
      $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
    }
    else if($lead_daterange != ''){
        $explode_date = explode(' - ', $lead_daterange);
        $startdate = date('Y-m-d', strtotime($explode_date[0]));
        $enddate =date('Y-m-d', strtotime($explode_date[1]));

        $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
    }
    else{
      $year_month_val = "";
    }

    $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

    if($user_details->show_leads == 1)
    {
      $lead_assign_val == '';
    }
    else if($user_details->show_leads == 2)
    {
      $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
    }
    else if($user_details->show_leads == 3 && $user_details->product_users != '')
    {
      $lead_assign_val = " AND (FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."') OR l.lead_assigned_to = '".$_SESSION['admindata']['user_id']."')";
    }else{
        $lead_assign_val = '';
    }
    // echo $tab_col_val;
    // echo "<br>";
    // echo $tab_join;
    // echo "<br>";
    // echo $tab_val;
    $sql = $this->db->query("SELECT (SELECT COUNT(lmr.lead_id) FROM lead_mail_reply lmr WHERE lmr.lead_id = l.lead_id) AS mail_reply_count,l.lead_id, l.import_lead_mails, contry.name as country_name, l.lead_type_id,cb.*, l.lead_source_id, l.lead_taken_by,  l.created_on, l.created_by, l.modified_on, l.modified_by, l.status, lt.lead_type as lead_type_name, ls.lead_source as source_name, sls.sub_lead_source as sub_source_name, u.name as lead_assign_name, cu.name as lead_created_by, p.product_name, indus.industry_name, l.lead_status_id, lst.lead_status as lead_status_name,l.comments $tab_col_val
     FROM leads l
           LEFT JOIN  contact_book cb ON cb.contact_book_id = l.contact_book_id
           LEFT JOIN  lead_type lt on lt.lead_type_id = l.lead_type_id
           LEFT JOIN  lead_status lst on lst.lead_status_id = l.lead_status_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = l.lead_source_id
           LEFT JOIN  sub_lead_source sls on sls.sub_lead_source_id = l.lead_source_id
           LEFT JOIN ad_countries contry ON contry.id = cb.country
           LEFT JOIN users u ON u.user_id = l.lead_assigned_to
           LEFT JOIN users cu ON cu.user_id = l.created_by
           LEFT JOIN  products p on p.product_id = l.product_id
           LEFT JOIN  industries indus on indus.industry_id = l.industry_id
           $tab_join
           WHERE l.status !=3 $year_month_val $tab_val $lead_assign_val  $lt $ls $lst $pv $t_fups $qcond $lc_filt $la_filt
           GROUP BY l.lead_id
           ORDER BY l.lead_id DESC $get_n_of_records
           ")->result(); 
    //save_query_in_log();
    return $sql; 
  }
  // To opportunities lead details
  public function opportunity_lead_list($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $year, $month, $product_id, $tab,$lead_country,$lead_assigned_to, $page, $perpage, $search_val, $list_lsource, $product_sort,$country_sort,$leadsource_sort,$priority_sort,$status_sort,$user_sort,$created_on_sort,$leadname_sort,$dtrng_or_other)
  {
    // echo $dtrng_or_other;
    // die();

    $qcond = '';

    if ($search_val != '') {
      $sc = 'AND (cb.lead_name LIKE "%'.$search_val.'%" OR p.product_name LIKE "%'.$search_val.'%" OR contry.name LIKE "%'.$search_val.'%" OR u.name LIKE "%'.$search_val.'%" OR cb.email_id LIKE "%'.$search_val.'%" OR sls.sub_lead_source LIKE "%'.$search_val.'%" OR lt.lead_type LIKE "%'.$search_val.'%" OR ost.oppo_status LIKE "%'.$search_val.'%" OR ls.lead_source LIKE "%'.$search_val.'%"  OR indus.industry_name LIKE "%'.$search_val.'%")';
    }
    else {
      $sc = '';
    }

    if ($lead_assigned_to != '') {
      $la_filt = " AND l.lead_assigned_to IN ($lead_assigned_to)";
    }
    else {
      $la_filt = "";
    }
    if ($lead_country != '') {
      $lc_filt = " AND cb.country = '$lead_country'";
    }
    else {
      $lc_filt = "";
    }
    if($product_id != '')
    {
      $pv = " AND l.product_id IN ($product_id)";
    }
    else{
      $pv = "";
    }
  
    if($lead_type != '')
    {
      $lt = " AND l.lead_type_id = '$lead_type'";
    }
    else{
      $lt = "";
    }

    if($lead_source != '')
    {
      $ls = " AND l.lead_source_id = '$lead_source'";
    }
    else{
      $ls = "";
    }

    if($list_lsource != '')
    {
      $lls = " AND ls.lead_source_id = '$list_lsource'";
    }
    else{
      $lls = "";
    }

    if($t_fup == 1)
    {
      $t_fups = " AND DATE(fups.followup_date) = DATE(NOW())";
    }
    else{
      $t_fups = "";
    }

    if($lead_status != '')
    {
      $lst = " AND l.lead_status_id = '$lead_status'";
    }
    else{
      $lst = "";
    }

    $explode_date = '';
    $startdate = '';
    $enddate = '';
    $year_month = '';
    if($year == '' && $month == '' && $lead_daterange == '')
    {
      $get_n_of_records = 'LIMIT 100';
    }
    else 
    {
      $get_n_of_records = '';
    }

    if($year != '' && $month != '' && $dtrng_or_other == 'All')
    {
      $year_month = $year.'-'.$month;
      $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
    }
    else if($dtrng_or_other != 'All'){
      if ($dtrng_or_other == 'today') {
        $year_month_val = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') = CURDATE()";
      }
      elseif ($dtrng_or_other == 'thisweek') {
        $year_month_val = "AND YEARWEEK(STR_TO_DATE(l.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
      }
      elseif ($dtrng_or_other == 'thismonth') {
        $year_month_val = "AND MONTH(STR_TO_DATE(l.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
      }
      elseif ($dtrng_or_other == 'thisyear') {
        $finstart = date('Y').'-01-01';
        $finend = date('Y').'-12-31';
        $year_month_val = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
      }
      elseif ($dtrng_or_other == 'dtrng') {
        if ($lead_daterange != '') {
          $explode_date = explode(' - ', $lead_daterange);
          $startdate = date('Y-m-d', strtotime($explode_date[0]));
          $enddate =date('Y-m-d', strtotime($explode_date[1]));
          
          $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
        }
        else {
          $year_month_val = '';
        }
      }
        
    }
    else{
      $year_month_val = "";
    }

     $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

    if($user_details->show_leads == 1)
    {
      $lead_assign_val == '';
    }
    else if($user_details->show_leads == 2)
    {
      $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
    }
    else if($user_details->show_leads == 3 && $user_details->product_users != '')
    {
      $lead_assign_val = " AND (FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."') OR l.lead_assigned_to = '".$_SESSION['admindata']['user_id']."')";
    }else{
        $lead_assign_val = '';
    }

    $tab_join = '';
    $tab_col_val = '';

   if($tab == 1)
    {
      $tab_val = "AND l.status = 3";
      $tab_join = "LEFT JOIN  lead_followups fups on fups.lead_id = l.lead_id AND DATE(fups.followup_date) = DATE(NOW()) AND fups.status = 0";
      $tab_col_val = ", CASE WHEN (DATE(fups.followup_date) = DATE(NOW())) THEN GROUP_CONCAT(fups.followup_time) else 0 END as fup_status, fups.status as 'fupst'";
      $order_by_col = "fups.followup_date";
    }
    else if($tab == 2)
    {
      $tab_val = "AND l.status = 1";
      $tab_join = '';
      $tab_col_val = '';
      $order_by_col = "l.lead_id";

    }
    else{

      $tab_val = '';
    }

    if ($product_sort != '') {
      if($product_sort == '0') {
        $sort_by = " ORDER BY p.product_name ASC";
      }
      else {
        $sort_by = " ORDER BY p.product_name DESC";
      }
    } else if ($country_sort != '') {
      if($country_sort == '0') {
        $sort_by = " ORDER BY contry.name ASC";
      }
      else {
        $sort_by = " ORDER BY contry.name DESC";
      }
    }
    else if ($leadsource_sort != '') {
      if($leadsource_sort == '0') {
        $sort_by = " ORDER BY sls.sub_lead_source ASC";
      }
      else {
        $sort_by = " ORDER BY sls.sub_lead_source DESC";
      }
    }
    else if ($priority_sort != '') {
      if($priority_sort == '0') {
        $sort_by = " ORDER BY lt.lead_type ASC";
      }
      else {
        $sort_by = " ORDER BY lt.lead_type DESC";
      }
    }
    else if ($status_sort != '') {
      if($status_sort == '0') {
        $sort_by = " ORDER BY ost.oppo_status ASC";
      }
      else {
        $sort_by = " ORDER BY ost.oppo_status DESC";
      }
    }
    else if ($user_sort != '') {
      if($user_sort == '0') {
        $sort_by = " ORDER BY u.name ASC";
      }
      else {
        $sort_by = " ORDER BY u.name DESC";
      }
    }
    else if ($leadname_sort != '') {
      if($leadname_sort == '0') {
        $sort_by = " ORDER BY cb.lead_name ASC";
      }
      else {
        $sort_by = " ORDER BY cb.lead_name DESC";
      }
    }
    else if ($created_on_sort != '') {
      if($created_on_sort == '0') {
        $sort_by = " ORDER BY l.created_on ASC";
      }
      else {
        $sort_by = " ORDER BY l.created_on DESC";
      }
    }
    else {
      $sort_by = " ORDER BY l.created_on DESC";
    }

    $sql = $this->db->query("SELECT l.lead_id, contry.name as country_name, cb.*, l.lead_type_id,  l.lead_source_id, l.lead_taken_by,  l.created_on, l.created_by, l.modified_on, l.modified_by, l.status, lt.lead_type as lead_type_name, ls.lead_source as source_name, u.name as lead_assign_name, sls.sub_lead_source as sub_source_name, cu.name as lead_created_by, p.product_name, indus.industry_name, l.lead_status_id, ost.oppo_status as lead_status_name,l.comments $tab_col_val
     FROM leads l
           LEFT JOIN  contact_book cb ON cb.contact_book_id = l.contact_book_id
           LEFT JOIN  lead_type lt on lt.lead_type_id = l.lead_type_id
           LEFT JOIN  lead_status lst on lst.lead_status_id = l.lead_status_id
           LEFT JOIN  oppo_status ost on ost.oppo_status_id = l.lead_status_id
           LEFT JOIN  sub_lead_source sls on sls.sub_lead_source_id = l.lead_source_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = sls.lead_source_id
           LEFT JOIN ad_countries contry ON contry.id = cb.country
           LEFT JOIN users u ON u.user_id = l.lead_assigned_to
           LEFT JOIN users cu ON cu.user_id = l.created_by
           LEFT JOIN  products p on p.product_id = l.product_id
           LEFT JOIN  industries indus on indus.industry_id = l.industry_id
            $tab_join
           WHERE l.status = 3 $year_month_val $tab_val $lead_assign_val $lc_filt $lt $ls $lst $pv $t_fups $qcond $la_filt $sc $lls
           GROUP BY l.lead_id
           $sort_by LIMIT $page, $perpage
           ")->result(); 
    //save_query_in_log();
    return $sql; 
  }
  public function opportunity_lead_list_count($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $year, $month, $product_id, $tab,$lead_country,$lead_assigned_to,$search_val,$list_lsource,$dtrng_or_other)
  {

    $qcond = '';

    if ($search_val != '') {
      $sc = 'AND (cb.lead_name LIKE "%'.$search_val.'%" OR p.product_name LIKE "%'.$search_val.'%" OR contry.name LIKE "%'.$search_val.'%" OR u.name LIKE "%'.$search_val.'%" OR cb.email_id LIKE "%'.$search_val.'%" OR sls.sub_lead_source LIKE "%'.$search_val.'%" OR lt.lead_type LIKE "%'.$search_val.'%" OR ost.oppo_status LIKE "%'.$search_val.'%" OR ls.lead_source LIKE "%'.$search_val.'%"  OR indus.industry_name LIKE "%'.$search_val.'%")';
    }
    else {
      $sc = '';
    }
    if ($lead_assigned_to != '') {
      $la_filt = " AND l.lead_assigned_to IN ($lead_assigned_to)";
    }
    else {
      $la_filt = "";
    }
    if ($lead_country != '') {
      $lc_filt = " AND cb.country = '$lead_country'";
    }
    else {
      $lc_filt = "";
    }
    if($product_id != '')
    {
      $pv = " AND l.product_id IN ($product_id)";
    }
    else{
      $pv = "";
    }
  
    if($lead_type != '')
    {
      $lt = " AND l.lead_type_id = '$lead_type'";
    }
    else{
      $lt = "";
    }

    if($lead_source != '')
    {
      $ls = " AND l.lead_source_id = '$lead_source'";
    }
    else{
      $ls = "";
    }

    if($list_lsource != '')
    {
      $lls = " AND ls.lead_source_id = '$list_lsource'";
    }
    else{
      $lls = "";
    }

    if($t_fup == 1)
    {
      $t_fups = " AND DATE(fups.followup_date) = DATE(NOW())";
    }
    else{
      $t_fups = "";
    }

    if($lead_status != '')
    {
      $lst = " AND l.lead_status_id = '$lead_status'";
    }
    else{
      $lst = "";
    }

    $explode_date = '';
    $startdate = '';
    $enddate = '';
    $year_month = '';
    if($year == '' && $month == '' && $lead_daterange == '')
    {
      $get_n_of_records = 'LIMIT 100';
    }
    else 
    {
      $get_n_of_records = '';
    }
    if($year != '' && $month != '' && $dtrng_or_other == 'All')
    {
      $year_month = $year.'-'.$month;
      $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
    }
    else if($dtrng_or_other != 'All'){
      if ($dtrng_or_other == 'today') {
        $year_month_val = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') = CURDATE()";
      }
      elseif ($dtrng_or_other == 'thisweek') {
        $year_month_val = "AND YEARWEEK(STR_TO_DATE(l.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1)";
      }
      elseif ($dtrng_or_other == 'thismonth') {
        $year_month_val = "AND MONTH(STR_TO_DATE(l.created_on, '%Y-%m-%d')) = MONTH(CURDATE())";
      }
      elseif ($dtrng_or_other == 'thisyear') {
        $finstart = date('Y').'-01-01';
        $finend = date('Y').'-12-31';
        $year_month_val = "AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d')";
      }
      elseif ($dtrng_or_other == 'dtrng') {
        if ($lead_daterange != '') {
          $explode_date = explode(' - ', $lead_daterange);
          $startdate = date('Y-m-d', strtotime($explode_date[0]));
          $enddate =date('Y-m-d', strtotime($explode_date[1]));

          $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
        }
        else {
          $year_month_val = '';
        }
      }
        
    }
    else{
      $year_month_val = "";
    }

     $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

    if($user_details->show_leads == 1)
    {
      $lead_assign_val == '';
    }
    else if($user_details->show_leads == 2)
    {
      $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
    }
    else if($user_details->show_leads == 3 && $user_details->product_users != '')
    {
      $lead_assign_val = " AND (FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."') OR l.lead_assigned_to = '".$_SESSION['admindata']['user_id']."')";
    }else{
        $lead_assign_val = '';
    }

    $tab_join = '';
    $tab_col_val = '';

   if($tab == 1)
    {
      $tab_val = "AND l.status = 3";
      $tab_join = "LEFT JOIN  lead_followups fups on fups.lead_id = l.lead_id AND DATE(fups.followup_date) = DATE(NOW()) AND fups.status = 0";
      $tab_col_val = ", CASE WHEN (DATE(fups.followup_date) = DATE(NOW())) THEN GROUP_CONCAT(fups.followup_time) else 0 END as fup_status, fups.status as 'fupst'";
      $order_by_col = "fups.followup_date";
    }
    else if($tab == 2)
    {
      $tab_val = "AND l.status = 1";
      $tab_join = '';
      $tab_col_val = '';
      $order_by_col = "l.created_on";

    }
    else{

      $tab_val = '';
    }

    $sql = $this->db->query("SELECT l.lead_id, contry.name as country_name, cb.*, l.lead_type_id,  l.lead_source_id, l.lead_taken_by,  l.created_on, l.created_by, l.modified_on, l.modified_by, l.status, lt.lead_type as lead_type_name, ls.lead_source as source_name, u.name as lead_assign_name, sls.sub_lead_source as sub_source_name, cu.name as lead_created_by, p.product_name, indus.industry_name, l.lead_status_id, ost.oppo_status as lead_status_name,l.comments $tab_col_val
     FROM leads l
           LEFT JOIN  contact_book cb ON cb.contact_book_id = l.contact_book_id
           LEFT JOIN  lead_type lt on lt.lead_type_id = l.lead_type_id
           LEFT JOIN  lead_status lst on lst.lead_status_id = l.lead_status_id
           LEFT JOIN  oppo_status ost on ost.oppo_status_id = l.lead_status_id
           LEFT JOIN  sub_lead_source sls on sls.sub_lead_source_id = l.lead_source_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = sls.lead_source_id
           LEFT JOIN ad_countries contry ON contry.id = cb.country
           LEFT JOIN users u ON u.user_id = l.lead_assigned_to
           LEFT JOIN users cu ON cu.user_id = l.created_by
           LEFT JOIN  products p on p.product_id = l.product_id
           LEFT JOIN  industries indus on indus.industry_id = l.industry_id
            $tab_join
           WHERE l.status = 3 $year_month_val $tab_val $lead_assign_val $lc_filt $lt $ls $lst $pv $t_fups $qcond $la_filt $sc $lls
           GROUP BY l.lead_id
           ORDER BY $order_by_col DESC
           ")->result(); 
    //save_query_in_log();
    return $sql; 
  }

  // To get today followup count list
  public function lead_today_followup_list($lead_type , $lead_source, $lead_daterange, $lead_status, $product_id, $tab, $list_lsource)
  {

    if($tab == 2)
    {
      $tab_val = " AND l.status = 0";
    }
    else{

      $tab_val = '';
    }

    if($product_id != '')
    {
      $pv = " AND l.product_id IN ($product_id)";
    }
    else{
      $pv = "";
    }
  

    if($lead_type != '')
    {
      $lt = " AND l.lead_type_id = '$lead_type'";
    }
    else{
      $lt = "";
    }

    if($lead_source != '')
    {
      $ls = " AND l.lead_source_id = '$lead_source'";
    }
    else{
      $ls = "";
    }

    if($list_lsource != '')
    {
      $lls = " AND ls.lead_source_id = '$list_lsource'";
    }
    else{
      $lls = "";
    }

    if($lead_status != '')
    {
      $lst = " AND l.lead_status_id = '$lead_status'";
    }
    else{
      $lst = "";
    }
    
     if($lead_daterange != '')
    {
      $explode_date = explode('/', $lead_daterange);
      $startdate = $explode_date[0];

      //$startdate = explode('/', $explode_date[0]);
      //$startdate = $startdate[2].'-'.$startdate[0].'-'.$startdate[1];
    
      $enddate = $explode_date[1];
      //$enddate = $enddate[2].'-'.$enddate[0].'-'.$enddate[1];

      $dateq = " AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$startdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$enddate."', '%Y-%m-%d')";

    }else{
      $lead_daterange = '';
      $startdate = '';
      $enddate   = '';
      $dateq = "";
    }

   $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

    if($user_details->show_leads == 1)
    {
      $lead_assign_val == '';
    }
    else if($user_details->show_leads == 2)
    {
      $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
    }
    else if($user_details->show_leads == 3 && $user_details->product_users != '')
    {
      $lead_assign_val = " AND FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."')";
    }else{
        $lead_assign_val = '';
    }

    $sql = $this->db->query("SELECT count(l.lead_id) as today_followups FROM leads l
           LEFT JOIN  lead_followups fups on fups.lead_id = l.lead_id 
           LEFT JOIN  sub_lead_source sls on sls.sub_lead_source_id = l.lead_source_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = sls.lead_source_id
           WHERE DATE(followup_date) = DATE(NOW()) $tab_val $lead_assign_val  $lt $ls $lst $pv $dateq $lls ORDER BY l.lead_id DESC
           ")->row(); 
    save_query_in_log();
    return $sql; 
  }

  // To get today followup count list
  public function opportunity_lead_today_followup_list($lead_type , $lead_source, $lead_daterange, $lead_status, $product_id, $tab, $list_lsource)
  {

    if($tab == 1)
    {
      $tab_val = " AND l.status = 3";
    }
    else{

      $tab_val = '';
    }

    if($product_id != '')
    {
      $pv = " AND l.product_id IN ($product_id)";
    }
    else{
      $pv = "";
    }
  

    if($lead_type != '')
    {
      $lt = " AND l.lead_type_id = '$lead_type'";
    }
    else{
      $lt = "";
    }

    if($lead_source != '')
    {
      $ls = " AND l.lead_source_id = '$lead_source'";
    }
    else{
      $ls = "";
    }

    if($list_lsource != '')
    {
      $lls = " AND ls.lead_source_id = '$list_lsource'";
    }
    else{
      $lls = "";
    }

    if($lead_status != '')
    {
      $lst = " AND l.lead_status_id = '$lead_status'";
    }
    else{
      $lst = "";
    }
    
     if($lead_daterange != '')
    {
      $explode_date = explode('/', $lead_daterange);
      $startdate = $explode_date[0];

      //$startdate = explode('/', $explode_date[0]);
      //$startdate = $startdate[2].'-'.$startdate[0].'-'.$startdate[1];
    
      $enddate = $explode_date[1];
      //$enddate = $enddate[2].'-'.$enddate[0].'-'.$enddate[1];

      $dateq = " AND STR_TO_DATE(l.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$startdate."', '%Y-%m-%d') and STR_TO_DATE(l.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$enddate."', '%Y-%m-%d')";

    }else{
      $lead_daterange = '';
      $startdate = '';
      $enddate   = '';
      $dateq = "";
    }

   $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

    if($user_details->show_leads == 1)
    {
      $lead_assign_val == '';
    }
    else if($user_details->show_leads == 2)
    {
      $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
    }
    else if($user_details->show_leads == 3 && $user_details->product_users != '')
    {
      $lead_assign_val = " AND FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."')";
    }else{
        $lead_assign_val = '';
    }

    $sql = $this->db->query("SELECT count(l.lead_id) as today_followups FROM leads l
           
           LEFT JOIN  lead_followups fups on fups.lead_id = l.lead_id 
           LEFT JOIN  sub_lead_source sls on sls.sub_lead_source_id = l.lead_source_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = sls.lead_source_id
           WHERE DATE(followup_date) = DATE(NOW()) $tab_val $lead_assign_val  $lt $ls $lst $pv $dateq $lls ORDER BY l.lead_id DESC
           ")->row(); 
    save_query_in_log();
    return $sql; 
  }

  // To list follow up based on lead 
  public function followup_lists($l_id)
  {
     
      $result = $this->db->query("call lead_followup_lists('".$l_id."')")->result_array();
      save_query_in_log();
       
      return $result;
  }
  // To add lead followups
  public function followup_add($data)
  {
    $modified_on = date('Y-m-d H:i:s');
    if($query = $this->db->query("call lead_followup_add(

        '".$data['lead_id']."',
        '".$data['followup_date']."',
        '".$data['followup_time']."',
        '".$data['followup_purpose_next']."',
        '".$modified_on."',
        '".$data['assigned_to']."',
        '".$data['created_by']."',
        '".$data['created_on']."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }

  // To change lead status and type status change
    public function lead_status_type_change($data, $type_val)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "$type_val = '".trim($data['type_val'])."',  modified_on = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."'";


            $condition = ' lead_id = "'.trim($data['lead_id']).'"';
            $result = common_update_values($columns, 'leads', $condition);
        }
        else
        {
            $result = false;
        }
       return $result;
    }
  // To get lead by id
  public function lead_by_id($l_id)
  {
     
    $result = $this->db->query("call lead_by_id('".$l_id."')")->row();
    save_query_in_log();
     
    return $result;
  }
  public function contact_book_info_by_id($cont_book_id)
  {
    $result = $this->db->query("SELECT cb.*,ac.name AS country_name FROM contact_book cb,ad_countries ac WHERE ac.id = cb.country AND cb.contact_book_id = '$cont_book_id'")->row();
    save_query_in_log();
     
    return $result;
  }
  public function lead_cancel($bid,$d_by,$d_on)
  {
     
    $result = $this->db->query("CALL lead_cancel('".$bid."','".$d_by."','".$d_on."')");
    save_query_in_log();
    return $result;
  }

   // To get lead followup by id
  public function lead_followup_by_id($l_id)
  {
     
    $result = $this->db->query("call lead_followup_by_id('".$l_id."')")->result();
    save_query_in_log();
     
    return $result;
  }

  public function re_lead($bid,$r_by,$r_on)
  {
     
    $modified_on = date('Y-m-d H:i:s');
    $result = $this->db->query("CALL lead_re_lead('".$bid."', '".$modified_on."')");
    save_query_in_log();
     
    return $result;
  }
  // To get lead followup by id
  public function lead_followup_by_id_edit($l_id)
  {
     
    $result = $this->db->query("call lead_followup_by_id_edit('".$l_id."')")->row();
    save_query_in_log();
     
    return $result;
  }
  
  // To add lead details
  public function lead_save($data)
  {
    // $result = $this->db->insert('leads', $data);
    // echo "INSERT INTO `leads`(`lead_code`,`contact_book_id`,`lead_source_id`, `message`, `lead_assigned_to`, `lead_status_id`, `lead_type_id`, `product_id`, `industry_id`, `created_by`, `created_on`) VALUES ('".$data['lead_code']."','".$data['cont_book_id_for_lead']."','".$data['lead_source_id']."','".$data['message']."','".$data['lead_assigned_to']."','".$data['lead_status_id']."','".$data['lead_type_id']."','".$data['product_id']."','".$data['industry_id']."','".$data['created_by']."','".$data['created_on']."')";
    // die();
    $result = $this->db->query("INSERT INTO `leads`(`lead_code`,`contact_book_id`,`lead_source_id`, `message`, `lead_assigned_to`, `lead_status_id`, `lead_type_id`, `product_id`, `industry_id`, `created_by`, `created_on`, `status`) VALUES ('".$data['lead_code']."','".$data['cont_book_id_for_lead']."','".$data['lead_source_id']."','".$data['message']."','".$data['lead_assigned_to']."','".$data['lead_status_id']."','".$data['lead_type_id']."','".$data['product_id']."','".$data['industry_id']."','".$data['created_by']."','".$data['created_on']."','".$data['status']."')");
    return $result;
  }
  public function add_lead_notification_save($data_n)
  {
    $result =  $this->db->insert('notification', $data_n);
    return true;
  }

  // To add lead status
  public function lead_change_status($l_t_id, $status)
  {
    if($query = $this->db->query("call lead_change_status(
        '".$l_t_id."',
        '".$status."'
        )"))
        { save_query_in_log(); return true; }else{ return false; }
  }

   // to update follow up
   public function lead_followup_update($data)
   {
      if($query = $this->db->query("call lead_followup_update(

        '".$data['lead_followups_id']."',
        '".$data['comment_status']."',
        '".$data['comments']."',
        '".$data['status']."',
        '".$data['modified_on']."',
        '".$data['modified_by']."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
   } 
  

    // To get lead followup by id
  public function lead_followup_edit_by_id($l_id)
  {
     
    $result = $this->db->query("call lead_followup_edit_by_id('".$l_id."')")->row();
    save_query_in_log();
     
    return $result;
  }

  // To update lead deails
  public function lead_update($data, $l_id)
  {
    // echo "<pre>";

    // print_r($data);
    // die();
       $this->db->where('lead_id', $l_id);
       $result =  $this->db->update('leads', $data);
       return true;
  }
  public function contact_info_update($data1,$contact_book_id)
  {
      $this->db->where('contact_book_id', $contact_book_id);
      $result =  $this->db->update('contact_book', $data1);
      return true;
  }

   // To update follow up lead deails
  public function lead_followup_edit_update($data, $l_id)
  {
      if($query = $this->db->query("call lead_followup_edit_update(

        '".$data['lead_assigned_to']."',
        '".$data['followup_date']."',
        '".$data['followup_time']."',
        '".$data['purpose']."',
        '".$l_id."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }

  public function lead_followups_by_pending_lfuid($id)
  {
     
    $result = $this->db->query("CALL lead_followups_by_pending_lfuid('".$id."')")->row();
    save_query_in_log();
     
    return $result;
  }

  public function get_last_followup_by_id($id)
  {
     
    $result = $this->db->query("CALL lead_last_followup_by_id('".$id."')")->row();
    save_query_in_log();
     
    return $result;
  }

  // To check lead name unique
  public function lead_name_unique_edit($l_name, $l_id)
  {
       
      $result = $this->db->query("call lead_name_unique_edit('".$l_name."', '".$l_id."')")->row();
      save_query_in_log();
       
      return $result;
  }

  // To change lead convert status
  public function lead_convert_status($lead_id, $status)
  {
    if($query = $this->db->query("call lead_convert_status(

        '".$lead_id."',
        '".$status."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }

  // To get active enquries
  public  function lead_active_enquiries($value, $lead_id)
  {
    $result = common_select_values('l.lead_id, cb.lead_name, cb.company_name, cb.email_id, l.product_id, l.industry_id, l.created_on, l.lead_assigned_to, (select product_name from products where product_id = l.product_id) as product_name, (select industry_name from industries where industry_id = l.industry_id) as industry_name, (select lead_status from lead_status where lead_status_id = l.lead_status_id) as lead_status_name, (select name from users where user_id = l.lead_assigned_to) as assigned_person', 'leads l, contact_book cb', ' email_id LIKE "'.'%'.$value.'%'.'" AND l.lead_id != "'.$lead_id.'" AND l.status != 2 AND l.contact_book_id = cb.contact_book_id', 'result');
    return $result; 
  }

  // To get assigned user list
  public function assigned_user_lists()
  {
    $result = common_select_values('user_id, name, role_id', 'users', ' status=0', 'result');
        return $result; 

  }
  public function product_assigned_users()
  {
    $result = $this->db->query("SELECT u.*,r.role_name FROM user_products up, users u,roles r WHERE u.status = 0 AND u.user_id = up.user_id AND u.role_id = r.role_id GROUP BY up.user_id")->result();
    return $result;    
  }
  // To get product emails by product id
    public function product_emails_by_id($product_id)
    {
        $result = common_select_values('p.product_email_id, p.product_id, p.email_detail_id, p.status, (SELECT GROUP_CONCAT(email_ID) FROM email_details WHERE FIND_IN_SET(email_detail_id, p.email_detail_id)) as email_name ', 'product_emails p', ' p.status !=2 AND p.product_id = "'.$product_id.'"', 'result');
        return $result;
    }
  // To get email id details
    public function email_by_id($email_id)
    {
      $result = common_select_values('*', 'email_details', ' status!=2 AND email_detail_id = "'.$email_id.'"', 'row');
        return $result; 

    }
    public function email_by_name($email_id)
    {
      $result = common_select_values('*', 'email_details', ' status = 0 AND email_ID = "'.$email_id.'"', 'row');
        return $result; 

    }
    // To get next auto id for lead id
    public function lead_next_auto_id()
    {
        $result = common_select_values('AUTO_INCREMENT', 'INFORMATION_SCHEMA.TABLES', ' TABLE_SCHEMA = database() AND TABLE_NAME = "leads"', 'row');
        return $result; 
    }
    // To add lead log
    public function lead_log_save($data)
    {
      $result = $this->db->insert('lead_history_log', $data);
      return $result;

    }
    // To get lead log list
    public function lead_log_list($lead_id)
    {
      $result = common_select_values('lg.*, (select name from users where user_id = lg.created_by) as log_created_by', 'lead_history_log lg', ' lg.lead_id = "'.$lead_id.'"', 'result');
        return $result; 
    }
    // To get country name
    public function country_name($country)
    {
      $result = common_select_values('name', 'ad_countries', ' id = "'.$country.'"', 'row');
        return $result; 
    }
    // To get country name
    public function country_id($country)
    {
      $result = common_select_values('id', 'ad_countries', ' name = "'.$country.'"', 'row');
        return $result; 
    }
    // To get lead count based on date
    public function lead_count_by_date($date, $lead_type)
    {
      $lead_type_val = '';
      if($lead_type == 0)
      {
        $lead_type_val = '0';
      }
      else{
        $lead_type_val = '3';
      }
      $result = common_select_values('count(lead_id) as lead_count', 'leads', ' DATE_FORMAT(created_on, "%Y-%m-%d")= "'.$date.'" AND status = "'.$lead_type_val.'"', 'row');
        return $result;
    }
     // To get lead convert count based on date
    public function lead_convert_count_by_date($date)
    {
      
      $result = common_select_values('count(lead_id) as lead_count', 'leads', ' DATE_FORMAT(modified_on, "%Y-%m-%d")= "'.$date.'"  AND status = 1', 'row');
        return $result;
    }
    // To get company email list
    public function company_email_list($lead_email_ID)
    {
      $result = common_select_values('Distinct company_email', 'emails', ' lead_email = "'.$lead_email_ID.'"', 'result');
        return $result;
    }
    // To get lead email list
    public function lead_email_list($company_email, $lead_email)
    {
      $result = common_select_values('e.*, COUNT(e.parent_id) as mail_count, (select GROUP_CONCAT(filename) from files WHERE email_id = e.id ) as attach_file_name', 'emails e', ' e.company_email = "'.$company_email.'" AND e.lead_email ="'.$lead_email.'" GROUP BY e.parent_id ORDER BY e.mail_date ASC', 'result');
        return $result;
    }
    // To show lead thread emails
    public function show_email_thread($parent_id)
    {
      $result = common_select_values('e.*, (select GROUP_CONCAT(filename) from files WHERE email_id = e.id ) as attach_file_name', 'emails e ', ' e.parent_id = "'.$parent_id.'" ORDER BY e.mail_date ASC', 'result');
        return $result;
    }
    // To get email details by id
    public function email_details_by_id($id)
    {
      $result = common_select_values('e.*, (select GROUP_CONCAT(filename) from files WHERE email_id = e.id ) as attach_file_name', 'emails e ', ' e.id = "'.$id.'"', 'row');
        return $result;
    }
    public function add_lead_reply_to_db($lead_id,$send_from,$send_to,$cc_email,$sub_email,$content,$c_by,$c_on)
    {
      $query = $this->db->query("INSERT INTO `lead_mail_reply`(`lead_id`, `send_from`, `send_to`, `send_cc`, `mail_subject`, `mail_content`, `created_by`, `created_on`) VALUES ('$lead_id','$send_from','$send_to','$cc_email','$sub_email','$content','$c_by','$c_on')");
      return 1;
    }
    public function get_all_mail_replies($lead_id)
    {
      $query = $this->db->query("SELECT cb.lead_name, lmr.* FROM lead_mail_reply lmr LEFT JOIN leads l ON l.lead_id = lmr.lead_id LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id WHERE lmr.lead_id = '$lead_id'")->result();
      return $query;
    }

    public function get_product_costing_by_lead_id($l_id)
   {       
      $result = $this->db->query("call get_product_costing_by_lead_id('".$l_id."')")->result_array();
      save_query_in_log();       
      return $result;
   }
   public function sub_lead_source_list()
  {
    $query = $this->db->query("CALL get_sub_lead_source_list()")->result();
    return $query;
  }
  public function chk_unique_sls_name($sls,$ls)
  {
    $query = $this->db->query("CALL chk_unique_sls_name('".$sls."','".$ls."')")->row();
    return $query;
  }
  public function add_sub_lead_source($ls,$sls,$c_by,$c_on)
  {
    $query = $this->db->query("CALL add_sub_lead_source('".$ls."','".$sls."','".$c_by."','".$c_on."')");
    return 1; 
  }
  public function sub_lead_sorce_status($l_t_id, $status)
  {
    if($query = $this->db->query("call sub_lead_source_change_status(
        '".$l_t_id."',
        '".$status."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
  public function get_sls_by_id($sls_id)
  {
    $query = $this->db->query("CALL get_sls_by_id('".$sls_id."')")->row();
    return $query; 
  }
  public function update_sls_info($sls_id,$l_s,$s_l_s,$m_by,$m_on)
  {
    $query = $this->db->query("CALL update_sls_info('".$sls_id."','".$l_s."','".$s_l_s."','".$m_by."','".$m_on."')");
    return 1; 
  }
  public function delete_sub($sls_id)
  {
    $query = $this->db->query("CALL delete_sub('".$sls_id."')");
    return 1;
  } 
  public function chk_domain_is_blocked($domain_name)
  {
    $query = $this->db->query("SELECT bed.* FROM block_email_or_domain bed WHERE bed.status = 0 AND bed.email_or_domain = 0 AND bed.value = '$domain_name'")->result();
    return $query;
  }
  public function chk_email_is_blocked($value)
  {
    $query = $this->db->query("SELECT bed.* FROM block_email_or_domain bed WHERE bed.status = 0 AND bed.email_or_domain = 1 AND bed.value = '$value'")->result();
    return $query;
  }

    public function get_proforma_invoice_by_lead_id($l_id)
   {       
      $result = $this->db->query("call get_proforma_invoice_by_lead_id('".$l_id."')")->result_array();
      save_query_in_log();       
      return $result;
   }
   public function get_buyer_order_by_lead_id($l_id)
   {       
      $result = $this->db->query("call get_buyer_order_by_lead_id('".$l_id."')")->result_array();
      save_query_in_log();       
      return $result;
   }
   public function update_import_mails_from_imap_flag($l_id,$flag)
   {
      $result = $this->db->query("call update_import_mails_from_imap_flag('".$l_id."','".$flag."')");
      save_query_in_log();       
      return 1;
   }
   public function get_allow_import_leads_email_id()
   {
      $result = $this->db->query("SELECT l.lead_id,cb.email_id FROM leads l,contact_book cb WHERE l.status != 2 AND (l.contact_book_id = cb.contact_book_id) AND ((l.status = 0 AND l.import_lead_mails = 1) OR l.status = 3 OR (l.status = 0 AND l.import_lead_mails = 0)) GROUP BY l.lead_id")->result();
      save_query_in_log();       
      return $result;
   }
   public function get_all_leads_mails($content_email,$lead_email,$email_type)
   {  
      if ($email_type == 1) {
        $result = $this->db->query("SELECT eli.* FROM email_list_info eli WHERE eli.from LIKE '%{$lead_email}%' AND eli.company_email = '$content_email' AND eli.email_type = '$email_type' ORDER BY eli.email_list_info_id DESC")->result_array();
      }
      elseif ($email_type == 2) {
        $result = $this->db->query("SELECT eli.* FROM email_list_info eli WHERE eli.to LIKE '%{$lead_email}%' AND eli.company_email = '$content_email' AND eli.email_type = '$email_type' ORDER BY eli.email_list_info_id DESC")->result_array(); 
      }
      save_query_in_log();    
      return $result;
   }
   public function get_email_content($lead_email,$company_email,$msgno, $label)
   {
      $result = $this->db->query("SELECT eim.* FROM email_info_messages eim WHERE eim.company_email = '$company_email' AND eim.msg_from_host LIKE '%{$lead_email}%' AND eim.msg_no = '$msgno' AND eim.email_type = '$label'")->row_array();
      save_query_in_log();       
      return $result;
   }
   public function get_all_leads($lead_type , $lead_source, $lead_daterange, $lead_status, $year, $month, $product_id, $lead_country, $lead_assigned_to)
   {
      if ($lead_country != '') {
        $lc_filt = " AND cb.country = '$lead_country'";
      }
      else {
        $lc_filt = "";
      }
      if ($lead_assigned_to != '') {
        $la_filt = " AND l.lead_assigned_to = '$lead_assigned_to'";
      }
      else {
        $la_filt = "";
      }

      if($product_id != '')
      {
        $pv = " AND l.product_id = '$product_id'";
      }
      else{
        $pv = "";
      }
    
      if($lead_type != '')
      {
        $lt = " AND l.lead_type_id = '$lead_type'";
      }
      else{
        $lt = "";
      }

      if($lead_source != '')
      {
        $ls = " AND l.lead_source_id = '$lead_source'";
      }
      else{
        $ls = "";
      }

      if($lead_status != '')
      {
        $lst = " AND l.lead_status_id = '$lead_status'";
      }
      else{
        $lst = "";
      }

      $explode_date = '';
      $startdate = '';
      $enddate = '';
      $year_month = '';
      if($year != '' && $month != '' && $lead_daterange == '')
      {
        $year_month = $year.'-'.$month;
        $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
      }
      else if($lead_daterange != ''){
          $explode_date = explode(' - ', $lead_daterange);
          $startdate = date('Y-m-d', strtotime($explode_date[0]));
          $enddate =date('Y-m-d', strtotime($explode_date[1]));
          $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
      }
      else{
        $year_month_val = "";
      }
      // echo $lead_daterange;
      // echo "<br>";
      // echo $startdate;
      // echo "<br>";
      // echo $enddate;
      // die();
      $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

      if($user_details->show_leads == 1)
      {
        $lead_assign_val == '';
      }
      else if($user_details->show_leads == 2)
      {
        $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
      }
      else if($user_details->show_leads == 3 && $user_details->product_users != '')
      {
        $lead_assign_val = " AND FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."')";
      }else{
          $lead_assign_val = '';
      }

      $result = $this->db->query("SELECT l.*,cb.*, ls.lead_source as lead_source_name,sls.sub_lead_source as sub_lead_source_name, lt.lead_type as l_type,  con.name as country_name, u.name as lead_assigned_name, ut.name as lead_taken_name, p.product_name, idus.industry_name, lst.lead_status as lead_status_name  FROM leads l
        LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
        LEFT JOIN sub_lead_source sls ON sls.sub_lead_source_id = l.lead_source_id
        LEFT JOIN lead_source ls on ls.lead_source_id = sls.lead_source_id
        LEFT JOIN lead_type lt on lt.lead_type_id = l.lead_type_id
        LEFT JOIN ad_countries con ON con.id = cb.country
        LEFT JOIN users u ON u.user_id = l.lead_assigned_to
        LEFT JOIN users ut ON u.user_id = l.lead_taken_by
        LEFT JOIN products p ON p.product_id = l.product_id
        LEFT JOIN industries idus ON idus.industry_id = l.industry_id
        LEFT JOIN lead_status lst on lst.lead_status_id = l.lead_status_id
        WHERE l.status != 2 AND l.status != 3 $year_month_val $lead_assign_val  $lt $ls $lst $pv $lc_filt $la_filt")->result_array();
      return $result;
   }
   public function get_all_oppo($lead_type , $lead_source, $lead_daterange, $lead_status, $year, $month, $product_id, $lead_country, $lead_assigned_to)
   {
      if ($lead_country != '') {
        $lc_filt = " AND cb.country = '$lead_country'";
      }
      else {
        $lc_filt = "";
      }
      if ($lead_assigned_to != '') {
        $la_filt = " AND l.lead_assigned_to = '$lead_assigned_to'";
      }
      else {
        $la_filt = "";
      }

      if($product_id != '')
      {
        $pv = " AND l.product_id = '$product_id'";
      }
      else{
        $pv = "";
      }
    
      if($lead_type != '')
      {
        $lt = " AND l.lead_type_id = '$lead_type'";
      }
      else{
        $lt = "";
      }

      if($lead_source != '')
      {
        $ls = " AND l.lead_source_id = '$lead_source'";
      }
      else{
        $ls = "";
      }

      if($lead_status != '')
      {
        $lst = " AND l.lead_status_id = '$lead_status'";
      }
      else{
        $lst = "";
      }

      $explode_date = '';
      $startdate = '';
      $enddate = '';
      $year_month = '';
      if($year != '' && $month != '' && $lead_daterange == '')
      {
        $year_month = $year.'-'.$month;
        $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
      }
      else if($lead_daterange != ''){
          $explode_date = explode(' - ', $lead_daterange);
          
          $startdate = date('Y-m-d', strtotime($explode_date[0]));
          $enddate =date('Y-m-d', strtotime($explode_date[1]));
          $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
      }
      else{
        $year_month_val = "";
      }

      $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

      if($user_details->show_leads == 1)
      {
        $lead_assign_val == '';
      }
      else if($user_details->show_leads == 2)
      {
        $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
      }
      else if($user_details->show_leads == 3 && $user_details->product_users != '')
      {
        $lead_assign_val = " AND FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."')";
      }else{
          $lead_assign_val = '';
      }
      // echo "SELECT l.*, ls.lead_source as lead_source_name,sls.sub_lead_source as sub_lead_source_name, lt.lead_type as l_type,  con.name as country_name, u.name as lead_assigned_name, ut.name as lead_taken_name, p.product_name, idus.industry_name, lst.lead_status as lead_status_name  FROM leads l
      //   LEFT JOIN sub_lead_source sls ON sls.sub_lead_source_id = l.lead_source_id
      //   LEFT JOIN lead_source ls on ls.lead_source_id = sls.lead_source_id

      //   LEFT JOIN lead_type lt on lt.lead_type_id = l.lead_type_id
      //   LEFT JOIN ad_countries con ON con.id = l.country
      //   LEFT JOIN users u ON u.user_id = l.lead_assigned_to
      //   LEFT JOIN users ut ON u.user_id = l.lead_taken_by
      //   LEFT JOIN products p ON p.product_id = l.product_id
      //   LEFT JOIN industries idus ON idus.industry_id = l.industry_id
      //   LEFT JOIN lead_status lst on lst.lead_status_id = l.lead_status_id
      //   WHERE l.lead_type_id = 1 AND l.lead_status_id = 3 AND l.status != 2 $year_month_val $lead_assign_val  $lt $ls $lst $pv $lc_filt $la_filt";
      //   die();
      $result = $this->db->query("SELECT l.*,cb.*, ls.lead_source as lead_source_name,sls.sub_lead_source as sub_lead_source_name, lt.lead_type as l_type,  con.name as country_name, u.name as lead_assigned_name, ut.name as lead_taken_name, p.product_name, idus.industry_name, lst.lead_status as lead_status_name  FROM leads l
        LEFT JOIN contact_book cb ON cb.contact_book_id = l.contact_book_id
        LEFT JOIN sub_lead_source sls ON sls.sub_lead_source_id = l.lead_source_id
        LEFT JOIN lead_source ls on ls.lead_source_id = sls.lead_source_id

        LEFT JOIN lead_type lt on lt.lead_type_id = l.lead_type_id
        LEFT JOIN ad_countries con ON con.id = cb.country
        LEFT JOIN users u ON u.user_id = l.lead_assigned_to
        LEFT JOIN users ut ON u.user_id = l.lead_taken_by
        LEFT JOIN products p ON p.product_id = l.product_id
        LEFT JOIN industries idus ON idus.industry_id = l.industry_id
        LEFT JOIN lead_status lst on lst.lead_status_id = l.lead_status_id
        WHERE l.lead_type_id = 1 AND l.lead_status_id = 3 AND l.status != 2 AND l.status = 3 $year_month_val $lead_assign_val  $lt $ls $lst $pv $lc_filt $la_filt")->result_array();
      return $result;
   }
   public function get_all_quotes_for_expo($quarter_filt, $user_filt, $qs_filt, $cid)
   {
      $result = $this->db->query("SELECT q.*,e.exporter_name,e.exporter_logo,qs.quote_stage, cb.company_name,cb.lead_name,cb.address,ac.name as country_name,cb.email_id,cb.contact_no,u.name as lead_assigned_name,vf.vessel_flight_name,fp.port_name as fpname,fp.port_city as fpcity,fp.port_country as fpcountry,tp.port_name as tpname,tp.port_city as tpcity,tp.port_country as tpcountry,pt.price_term_name,c.currency_name,c.currency_code FROM quote q, exporter e,quote_stage qs, leads l, contact_book cb, ad_countries ac,users u,vessel_flight vf,port fp,port tp,price_term pt,currency c WHERE q.exporter_id = e.exporter_id AND q.quote_stage_id = qs.quote_stage_id AND q.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND cb.country = ac.id AND l.lead_assigned_to = u.user_id AND q.vessel_flight_id = vf.vessel_flight_id AND q.from_port = fp.port_id AND q.to_port = tp.port_id AND q.price_term_id = pt.price_term_id AND q.currency_id = c.currency_id $user_filt $qs_filt $quarter_filt $cid")->result_array();
      return $result;
   }
   public function get_all_inv_for_expo($quarter_filt,$country_filt)
   {
      $result = $this->db->query("SELECT inv.*, 
       e.exporter_name,
       bo.buyer_order_invoice_no, 
       e.exporter_logo, 
       pis.pi_stage, 
       cb.company_name, 
       cb.lead_name, 
       cb.address, 
       ac.name          AS country_name, 
       cb.email_id, 
       cb.contact_no, 
       u.name           AS lead_assigned_name, 
       vf.vessel_flight_name, 
       pol.port_name    AS polname, 
       pol.port_city    AS polcity, 
       pol.port_country AS polcountry, 
       pod.port_name    AS podname, 
       pod.port_city    AS podcity, 
       pod.port_country AS podcountry, 
       fd.port_name     AS fdname, 
       fd.port_city     AS fdcity, 
       fd.port_country  AS fdcountry, 
       c.currency_name, 
       c.currency_code, 
       pcb.pre_carriage_by, 
       topt.terms_of_payment_type,
       bd.bank_detail, 
       (SELECT SUM(invp.amount) FROM invoice_product invp WHERE invp.invoice_id = inv.invoice_id AND invp.status = 0) AS grand_total
FROM   invoice inv, 
       buyer_order bo,
       exporter e, 
       pi_stage pis, 
       leads l, 
       contact_book cb,
       ad_countries ac, 
       users u, 
       vessel_flight vf, 
       port pol, 
       port pod, 
       port fd, 
       currency c, 
       pre_carriage_by pcb, 
       terms_of_payment_type topt,
       bank_detail bd
WHERE  inv.exporter_id = e.exporter_id 
       AND inv.buyer_order_id = bo.buyer_order_id
       AND inv.pi_stage_id = pis.pi_stage_id 
       AND inv.lead_id = l.lead_id
       AND cb.contact_book_id = l.contact_book_id 
       AND cb.country = ac.id 
       AND l.lead_assigned_to = u.user_id 
       AND inv.vessel_flight_id = vf.vessel_flight_id 
       AND inv.port_of_loading_id = pol.port_id 
       AND inv.port_of_discharge_id = pod.port_id 
       AND inv.final_destination_id = fd.port_id 
       AND inv.currency_id = c.currency_id 
       AND pcb.pre_carriage_by_id = inv.pre_carriage_by_id 
       AND bd.bank_detail_id = inv.bank_detail_id 
       AND topt.terms_of_payment_type_id = inv.terms_of_payment_type_id  $quarter_filt $user_filt $c_filt")->result_array();
      return $result;
   }
   public function get_all_pi_for_expo($quarter_filt, $user_filt, $c_filt)
   {
      $result = $this->db->query("SELECT pi.*, 
       e.exporter_name, 
       e.exporter_logo, 
       pis.pi_stage, 
       cb.company_name, 
       cb.lead_name, 
       cb.address, 
       ac.name          AS country_name, 
       cb.email_id, 
       cb.contact_no, 
       u.name           AS lead_assigned_name, 
       vf.vessel_flight_name, 
       pol.port_name    AS polname, 
       pol.port_city    AS polcity, 
       pol.port_country AS polcountry, 
       pod.port_name    AS podname, 
       pod.port_city    AS podcity, 
       pod.port_country AS podcountry, 
       fd.port_name     AS fdname, 
       fd.port_city     AS fdcity, 
       fd.port_country  AS fdcountry, 
       c.currency_name, 
       c.currency_code, 
       pcb.pre_carriage_by
FROM   proforma_invoice pi, 
       exporter e, 
       pi_stage pis, 
       leads l, 
       contact_book cb,
       ad_countries ac, 
       users u, 
       vessel_flight vf, 
       port pol, 
       port pod, 
       port fd, 
       currency c, 
       pre_carriage_by pcb
WHERE  pi.exporter_id = e.exporter_id 
       AND pi.pi_stage_id = pis.pi_stage_id 
       AND pi.lead_id = l.lead_id 
       AND cb.contact_book_id = l.contact_book_id
       AND cb.country = ac.id 
       AND l.lead_assigned_to = u.user_id 
       AND pi.vessel_flight_id = vf.vessel_flight_id 
       AND pi.port_of_loading_id = pol.port_id 
       AND pi.port_of_discharge_id = pod.port_id 
       AND pi.final_destination_id = fd.port_id 
       AND pi.currency_id = c.currency_id 
       AND pcb.pre_carriage_by_id = pi.pre_carriage_by_id $quarter_filt $user_filt $c_filt")->result_array();
      return $result;
   }
   public function get_all_bo_for_expo($quarter_filt, $user_filt, $c_filt)
   {
      $result = $this->db->query("SELECT bo.*, 
       e.exporter_name, 
       e.exporter_logo, 
       pis.pi_stage, 
       cb.company_name, 
       cb.lead_name, 
       cb.address, 
       cb.email_id, 
       ac.name          AS country_name, 
       cb.email_id, 
       cb.contact_no, 
       u.name           AS lead_assigned_name, 
       vf.vessel_flight_name, 
       pol.port_name    AS polname, 
       pol.port_city    AS polcity, 
       pol.port_country AS polcountry, 
       pod.port_name    AS podname, 
       pod.port_city    AS podcity, 
       pod.port_country AS podcountry, 
       fd.port_name     AS fdname, 
       fd.port_city     AS fdcity, 
       fd.port_country  AS fdcountry, 
       c.currency_name, 
       c.currency_code, 
       pcb.pre_carriage_by,
       topt.terms_of_payment_type, 
       top.terms_of_payment_name, 
       tap.terms_and_payment, 
       bd.bank_detail, 
       inte.interest_label, 
       arb.arbitration_label, 
       decl.declaration_label 
FROM   buyer_order bo, 
       exporter e, 
       pi_stage pis, 
       leads l, 
       contact_book cb,
       ad_countries ac, 
       users u, 
       vessel_flight vf, 
       port pol, 
       port pod, 
       port fd, 
       currency c, 
       pre_carriage_by pcb,
       terms_of_payment_type topt, 
       terms_of_payment top, 
       terms_and_payment tap, 
       bank_detail bd, 
       interest inte, 
       arbitration arb, 
       declaration decl 
WHERE  bo.exporter_id = e.exporter_id 
       AND bo.pi_stage_id = pis.pi_stage_id 
       AND bo.lead_id = l.lead_id 
       AND cb.contact_book_id = l.contact_book_id 
       AND cb.country = ac.id 
       AND l.lead_assigned_to = u.user_id 
       AND bo.vessel_flight_id = vf.vessel_flight_id 
       AND bo.port_of_loading_id = pol.port_id 
       AND bo.port_of_discharge_id = pod.port_id 
       AND bo.final_destination_id = fd.port_id 
       AND bo.currency_id = c.currency_id 
       AND pcb.pre_carriage_by_id = bo.pre_carriage_by_id
       AND topt.terms_of_payment_type_id = bo.terms_of_payment_type_id 
       AND tap.terms_and_payment_id = bo.terms_and_payment_id 
       AND top.terms_of_payment_id = bo.terms_of_payment_id 
       AND bd.bank_detail_id = bo.bank_detail_id 
       AND inte.interest_id = bo.interest_id 
       AND arb.arbitration_id = bo.arbitration_id 
       AND decl.declaration_id = bo.declaration_id $quarter_filt $user_filt $c_filt")->result_array();
      return $result;
   }
   public function get_all_spo_for_expo($quarter_filt,$user_filt)
   {
    $result = $this->db->query("SELECT spo.*, 
                             v.vendor_name, 
                             v.phone_no, 
                             bo.buyer_order_invoice_no, 
                             bo.order_end_date, 
                             cb.lead_name 
                      FROM   `supplier_purchase_order` spo, 
                             vendor v, 
                             buyer_order bo, 
                             leads l,
                             contact_book cb
                      WHERE  spo.vendor_id = v.vendor_id 
                             AND spo.buyer_order_id = bo.buyer_order_id 
                             AND l.lead_id = bo.lead_id 
                             AND l.contact_book_id = cb.contact_book_id $quarter_filt $user_filt")->result_array();
    return $result;
   } 
   public function get_all_jo_for_expo($quarter_filt,$user_filt)
   {
      $result = $this->db->query("SELECT jo.*, 
             spo.buyer_order_id, 
             bo.buyer_order_invoice_no,
             spo.supplier_purchase_order_no, 
             u.name as display_name, 
             v.vendor_name, 
             cb.lead_name, 
             p.product_name, 
             pi.product_item 
      FROM   job_order jo, 
             supplier_purchase_order spo, 
             users u, 
             vendor v, 
             supplier_purchase_order_product spop, 
             leads l, 
             contact_book cb,
             products p, 
             product_items pi, 
             buyer_order bo 
      WHERE  jo.supplier_purchase_order_id = spo.supplier_purchase_order_id 
             AND u.user_id = jo.employee_id 
             AND spo.vendor_id = v.vendor_id 
             AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id 
             AND spop.product_item_id = pi.product_item_id 
             AND pi.product_id = p.product_id 
             AND spo.buyer_order_id = bo.buyer_order_id 
             AND bo.lead_id = l.lead_id
             AND l.contact_book_id = cb.contact_book_id")->result_array();
      return $result;
   } 
   public function get_left_side_loop_array($left_side)
   {
      if ($left_side == 'cb.country') {
        $left_join_table_name = 'ad_countries c';
        $left_join_connection = ' AND '.$left_side.' = c.id';
        $left_join_column_value = 'c.name';
      }
      else if ($left_side == 'l.lead_source_id') {
        $left_join_table_name = 'sub_lead_source sls';
        $left_join_connection = ' AND '.$left_side.' = sls.sub_lead_source_id';
        $left_join_column_value = 'sls.sub_lead_source';
      }
      else if ($left_side == 'l.product_id') {
        $left_join_table_name = 'products p';
        $left_join_connection = ' AND '.$left_side.' = p.product_id';
        $left_join_column_value = 'p.product_name';
      }
      else if ($left_side == 'l.lead_assigned_to') {
        $left_join_table_name = 'users u';
        $left_join_connection = ' AND '.$left_side.' = u.user_id';
        $left_join_column_value = 'u.name';
      }
      else if ($left_side == 'l.lead_status_id') {
        $left_join_table_name = 'lead_status ls';
        $left_join_connection = ' AND '.$left_side.' = ls.lead_status_id';
        $left_join_column_value = 'ls.lead_status';
      }
      else if ($left_side == 'l.lead_type_id') {
        $left_join_table_name = 'lead_type lt';
        $left_join_connection = ' AND '.$left_side.' = lt.lead_type_id';
        $left_join_column_value = 'lt.lead_type';
      }
    //   echo "SELECT $left_side AS left_column_id,$left_join_column_value AS left_column_name FROM leads l, contact_book cb, $left_join_table_name
    // WHERE l.status != 2 AND cb.contact_book_id = l.contact_book_id $left_join_connection GROUP BY $left_side";
    // die();
      $result = $this->db->query("SELECT $left_side AS left_column_id,$left_join_column_value AS left_column_name FROM leads l, contact_book cb, $left_join_table_name
    WHERE l.status != 2 AND cb.contact_book_id = l.contact_book_id $left_join_connection GROUP BY $left_side")->result_array();
      return $result;
   }
   public function get_top_side_loop_array($top_side)
   {
      if ($top_side == 'cb.country') {
        $left_join_table_name = 'ad_countries c';
        $left_join_connection = ' AND '.$top_side.' = c.id';
        $left_join_column_value = 'c.name';
      }
      else if ($top_side == 'l.lead_source_id') {
        $left_join_table_name = 'sub_lead_source sls';
        $left_join_connection = ' AND '.$top_side.' = sls.sub_lead_source_id';
        $left_join_column_value = 'sls.sub_lead_source';
      }
      else if ($top_side == 'l.product_id') {
        $left_join_table_name = 'products p';
        $left_join_connection = ' AND '.$top_side.' = p.product_id';
        $left_join_column_value = 'p.product_name';
      }
      else if ($top_side == 'l.lead_assigned_to') {
        $left_join_table_name = 'users u';
        $left_join_connection = ' AND '.$top_side.' = u.user_id';
        $left_join_column_value = 'u.name';
      }
      else if ($top_side == 'l.lead_status_id') {
        $left_join_table_name = 'lead_status ls';
        $left_join_connection = ' AND '.$top_side.' = ls.lead_status_id';
        $left_join_column_value = 'ls.lead_status';
      }
      else if ($top_side == 'l.lead_type_id') {
        $left_join_table_name = 'lead_type lt';
        $left_join_connection = ' AND '.$top_side.' = lt.lead_type_id';
        $left_join_column_value = 'lt.lead_type';
      }
      $result = $this->db->query("SELECT $top_side AS top_column_id,$left_join_column_value AS top_column_name FROM leads l, contact_book cb, $left_join_table_name
    WHERE l.status != 2 AND l.contact_book_id = cb.contact_book_id $left_join_connection GROUP BY $top_side")->result_array();
      return $result;
   }
   public function lead_exp_list_daily_report($year_month, $no_days, $graph_left)
    {

      if ($graph_left == 'l.country') {
        $left_join_table_name = 'ad_countries c';
        $left_join_connection = ' AND '.$graph_left.' = c.id';
        $left_join_column_value = 'c.name';
      }
      else if ($graph_left == 'l.lead_source_id') {
        $left_join_table_name = 'sub_lead_source sls';
        $left_join_connection = ' AND '.$graph_left.' = sls.sub_lead_source_id';
        $left_join_column_value = 'sls.sub_lead_source';
      }
      else if ($graph_left == 'l.product_id') {
        $left_join_table_name = 'products p';
        $left_join_connection = ' AND '.$graph_left.' = p.product_id';
        $left_join_column_value = 'p.product_name';
      }
      else if ($graph_left == 'l.lead_assigned_to') {
        $left_join_table_name = 'users u';
        $left_join_connection = ' AND '.$graph_left.' = u.user_id';
        $left_join_column_value = 'u.name';
      }
      else if ($graph_left == 'l.lead_status_id') {
        $left_join_table_name = 'lead_status ls';
        $left_join_connection = ' AND '.$graph_left.' = ls.lead_status_id';
        $left_join_column_value = 'ls.lead_status';
      }
      else if ($graph_left == 'l.lead_type_id') {
        $left_join_table_name = 'lead_type lt';
        $left_join_connection = ' AND '.$graph_left.' = lt.lead_type_id';
        $left_join_column_value = 'lt.lead_type';
      }
        if ($_SESSION['admindata']['role_id'] != 1) {
            $user_id = $_SESSION['admindata']['user_id'];
            $user_filt = "AND l.lead_assigned_to = '$user_id'";
        }
        else {
            $user_filt = "";   
        }

        $day_val = "";
        if($no_days > 0)
        {
            for($i = 1; $i<=$no_days; $i++)
            {
                if(strlen($i) > 1)
                {
                    $d_format = $i;
                }
                else{
                    $d_format = '0'.$i;
                }
                $created_date = $year_month.'-'.$d_format;
                $day_val .= "(select COUNT(l.lead_id) from leads l WHERE l.status != 2 $left_join_connection $user_filt 
                AND date_format(l.created_on, '%Y-%m-%d') = '".$created_date."') as '$d_format',";
            }
        }
        // echo "SELECT ls.lead_source, sls.sub_lead_source_id, sls.lead_source_id, sls.sub_lead_source , $day_val FROM sub_lead_source sls LEFT JOIN lead_source ls ON ls.lead_source_id = sls.sub_lead_source_id WHERE sls.status != 2 GROUP BY sls.sub_lead_source_id";
        // die();
        $day_val = trim($day_val, ',');
        $query = $this->db->query("SELECT $left_join_column_value AS col_name, $day_val FROM $left_join_table_name");
        return $query->result_array();
    }

    public function get_values_only_exist_id($col_name)
    {
      if ($col_name == 'cb.country') {
        $left_join_table_name = 'ad_countries c';
        $left_join_connection = ' AND '.$col_name.' = c.id';
        $left_join_column_value = 'c.name';
      }
      else if ($col_name == 'l.lead_source_id') {
        $left_join_table_name = 'sub_lead_source sls';
        $left_join_connection = ' AND '.$col_name.' = sls.sub_lead_source_id';
        $left_join_column_value = 'sls.sub_lead_source';
      }
      else if ($col_name == 'l.product_id') {
        $left_join_table_name = 'products p';
        $left_join_connection = ' AND '.$col_name.' = p.product_id';
        $left_join_column_value = 'p.product_name';
      }
      else if ($col_name == 'l.lead_assigned_to') {
        $left_join_table_name = 'users u';
        $left_join_connection = ' AND '.$col_name.' = u.user_id';
        $left_join_column_value = 'u.name';
      }
      else if ($col_name == 'l.lead_status_id') {
        $left_join_table_name = 'lead_status ls';
        $left_join_connection = ' AND '.$col_name.' = ls.lead_status_id';
        $left_join_column_value = 'ls.lead_status';
      }
      else if ($col_name == 'l.lead_type_id') {
        $left_join_table_name = 'lead_type lt';
        $left_join_connection = ' AND '.$col_name.' = lt.lead_type_id';
        $left_join_column_value = 'lt.lead_type';
      }

      $query = $this->db->query("SELECT $col_name AS col_id, $left_join_column_value AS col_name FROM leads l, contact_book cb,$left_join_table_name WHERE l.status != 2 AND cb.contact_book_id = l.contact_book_id $left_join_connection GROUP BY $col_name")->result_array();
      return $query;
    }
    
    public function get_graph_count_by_line_bottom($line_id,$line_col_name,$bot_id,$bot_col_name, $lead_type , $lead_source, $lead_daterange, $lead_status, $year, $month, $product_id, $lead_country, $lead_assigned_to)
    {
      if ($line_col_name == 'cb.country') {
        
        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';
       
      }
      else if ($line_col_name == 'l.lead_source_id') {
        
        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';
        
      }
      else if ($line_col_name == 'l.product_id') {
        
        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';
        
      }
      else if ($line_col_name == 'l.lead_assigned_to') {
        
        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';
        
      }
      else if ($line_col_name == 'l.lead_status_id') {

        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';

      }
      else if ($line_col_name == 'l.lead_type_id') {

        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';

      }

      if ($bot_col_name == 'cb.country') {
        
        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';
       
      }
      else if ($bot_col_name == 'l.lead_source_id') {
        
        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';
        
      }
      else if ($bot_col_name == 'l.product_id') {
        
        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';
        
      }
      else if ($bot_col_name == 'l.lead_assigned_to') {
        
        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';
        
      }
      else if ($bot_col_name == 'l.lead_status_id') {

        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';

      }
      else if ($bot_col_name == 'l.lead_type_id') {

        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';

      }

      if ($lead_country != '') {
        $lc_filt = " AND cb.country = '$lead_country'";
      }
      else {
        $lc_filt = "";
      }
      if ($lead_assigned_to != '') {
        $la_filt = " AND l.lead_assigned_to = '$lead_assigned_to'";
      }
      else {
        $la_filt = "";
      }

      if($product_id != '')
      {
        $pv = " AND l.product_id = '$product_id'";
      }
      else{
        $pv = "";
      }

      if($lead_type != '')
      {
        $lt = " AND l.lead_type_id = '$lead_type'";
      }
      else{
        $lt = "";
      }

      if($lead_source != '')
      {
        $ls = " AND l.lead_source_id = '$lead_source'";
      }
      else{
        $ls = "";
      }

      if($lead_status != '')
      {
        $lst = " AND l.lead_status_id = '$lead_status'";
      }
      else{
        $lst = "";
      }

      $explode_date = '';
      $startdate = '';
      $enddate = '';
      $year_month = '';
      if($year != '' && $month != '' && $lead_daterange == '')
      {
        $year_month = $year.'-'.$month;
        $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
      }
      else if($lead_daterange != ''){
          $explode_date = explode(' - ', $lead_daterange);
          $startdate = date('Y-m-d', strtotime($explode_date[0]));
          $enddate =date('Y-m-d', strtotime($explode_date[1]));
          $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
      }
      else{
        $year_month_val = "";
      }
      // echo "SELECT COUNT(l.lead_id) AS graph_count, $line_col_name, $bot_col_name FROM leads l WHERE l.status != 2 $bot_join_connection $line_join_connection";
      // echo "<br>";
      $query = $this->db->query("SELECT COUNT(l.lead_id) AS graph_count FROM leads l, contact_book cb WHERE l.status != 2 AND l.contact_book_id = cb.contact_book_id AND l.status != 3 $bot_join_connection $line_join_connection $year_month_val $lt $ls $lst $pv $lc_filt $la_filt")->result_array();
      return $query;
    }
    public function get_oppo_graph_count_by_line_bottom($line_id,$line_col_name,$bot_id,$bot_col_name, $lead_type , $lead_source, $lead_daterange, $lead_status, $year, $month, $product_id, $lead_country, $lead_assigned_to)
    {
      if ($line_col_name == 'cb.country') {
        
        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';
       
      }
      else if ($line_col_name == 'l.lead_source_id') {
        
        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';
        
      }
      else if ($line_col_name == 'l.product_id') {
        
        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';
        
      }
      else if ($line_col_name == 'l.lead_assigned_to') {
        
        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';
        
      }
      else if ($line_col_name == 'l.lead_status_id') {

        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';

      }
      else if ($line_col_name == 'l.lead_type_id') {

        $line_join_connection = ' AND '.$line_col_name.' = '.$line_id.'';

      }

      if ($bot_col_name == 'cb.country') {
        
        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';
       
      }
      else if ($bot_col_name == 'l.lead_source_id') {
        
        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';
        
      }
      else if ($bot_col_name == 'l.product_id') {
        
        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';
        
      }
      else if ($bot_col_name == 'l.lead_assigned_to') {
        
        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';
        
      }
      else if ($bot_col_name == 'l.lead_status_id') {

        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';

      }
      else if ($bot_col_name == 'l.lead_type_id') {

        $bot_join_connection = ' AND '.$bot_col_name.' = '.$bot_id.'';

      }

      if ($lead_country != '') {
        $lc_filt = " AND cb.country = '$lead_country'";
      }
      else {
        $lc_filt = "";
      }
      if ($lead_assigned_to != '') {
        $la_filt = " AND l.lead_assigned_to = '$lead_assigned_to'";
      }
      else {
        $la_filt = "";
      }

      if($product_id != '')
      {
        $pv = " AND l.product_id = '$product_id'";
      }
      else{
        $pv = "";
      }

      if($lead_type != '')
      {
        $lt = " AND l.lead_type_id = '$lead_type'";
      }
      else{
        $lt = "";
      }

      if($lead_source != '')
      {
        $ls = " AND l.lead_source_id = '$lead_source'";
      }
      else{
        $ls = "";
      }

      if($lead_status != '')
      {
        $lst = " AND l.lead_status_id = '$lead_status'";
      }
      else{
        $lst = "";
      }

      $explode_date = '';
      $startdate = '';
      $enddate = '';
      $year_month = '';
      if($year != '' && $month != '' && $lead_daterange == '')
      {
        $year_month = $year.'-'.$month;
        $year_month_val = ' AND DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
      }
      else if($lead_daterange != ''){
          $explode_date = explode(' - ', $lead_daterange);
          $startdate = $explode_date[0];
          $startdate = date('Y-m-d', strtotime($explode_date[0]));
          $enddate =date('Y-m-d', strtotime($explode_date[1]));
          $year_month_val = " AND DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
      }
      else{
        $year_month_val = "";
      }
      // echo "SELECT COUNT(l.lead_id) AS graph_count, $line_col_name, $bot_col_name FROM leads l WHERE l.status != 2 $bot_join_connection $line_join_connection";
      // echo "<br>";
      $query = $this->db->query("SELECT COUNT(l.lead_id) AS graph_count FROM leads l, contact_book cb WHERE l.status != 2 AND l.contact_book_id = cb.contact_book_id AND l.status = 3 $bot_join_connection $line_join_connection $year_month_val $lt $ls $lst $pv $lc_filt $la_filt")->result_array();
      return $query;
    }
  public function oppo_status_list()
  {
    $result = $this->db->query("call oppo_status_list()")->result();
     
    save_query_in_log();
    return $result;
  }
  public function oppo_status_unique($l_s_name)
  {
     
    $result = $this->db->query("call oppo_status_unique('".$l_s_name."')")->row();
    save_query_in_log();
     
    return $result;
  }
  public function oppo_status_by_id($l_t_id)
  {
    $result = $this->db->query("call oppo_status_by_id('".$l_t_id."')")->row();
    save_query_in_log();
    return $result;
  }
  public function oppo_status_unique_edit($l_t_name, $l_t_id)
  {
    $result = $this->db->query("call oppo_status_unique_edit('".$l_t_name."', '".$l_t_id."')")->row();
    save_query_in_log();
    return $result;
  }
  public function oppo_status_change_status($l_t_id, $status)
  {
    if($query = $this->db->query("call oppo_status_change_status(
        '".$l_t_id."',
        '".$status."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
   public function oppo_status_update($data, $l_t_id)
  {
    if($query = $this->db->query("call oppo_status_update(

        '".$data['lead_status']."',
        '".$data['m_on']."',
        '".$data['m_by']."',
        '".$l_t_id."'
        
        )"))
        { 
        save_query_in_log();
        return true;
        }else{ return false; }
  }
  
  // To add lead status
  public function oppo_status_add($data)
  {
    if($query = $this->db->query("call oppo_status_add(

        '".$data['lead_status']."',
        '".$data['c_on']."',
        '".$data['c_by']."'
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
  public function oppo_status_in_lead($l_t_id)
  {
    $result = $this->db->query("call oppo_status_in_lead('$l_t_id')")->result();
    save_query_in_log();  
    return $result;
  }
  public function update_oppo_status($l_id,$oppo_st_id)
  {
    $result = $this->db->query("call update_oppo_status('".$l_id."','".$oppo_st_id."')");
    save_query_in_log();  
    return $result;
  }
  public function update_lead_status_from_oppo($l_id, $oppo_to_lead_status)
  {
    $result = $this->db->query("call update_lead_status_from_oppo('".$l_id."','".$oppo_to_lead_status."')");
    save_query_in_log();  
    return $result; 
  } 


  public function get_lead_comments_by_id($tid)
  {
    $result = $this->db->query("CALL get_lead_comments_by_id('".$tid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function update_lead_comments($data)
  {
    $result = $this->db->query("CALL update_lead_comments('".$data['lead_id']."','".str_replace("'", "`", $data['comments'])."')");
    save_query_in_log();
    return $result;
  } 
  public function create_lead_comments($data)
  {
    $result = $this->db->query("CALL create_lead_comments('".$data['lead_id']."','".str_replace("'", "`", $data['comments'])."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function chk_the_lead_has_same_product($contact_book_id,$product_id)
  {
    $result = $this->db->query("SELECT l.* FROM leads l WHERE l.status != 2 AND l.contact_book_id = '$contact_book_id' AND l.product_id = '$product_id'")->row();
    save_query_in_log();
    return $result; 
  }
  public function add_new_contact_info($data)
  {
    $result = $this->db->query("INSERT INTO `contact_book`(`lead_name`, `company_name`, `designation`, `country`, `website`, `address`, `email_id`, `alternative_email_id`, `skype_id`, `contact_no`, `whatsapp_no`, `office_phone_no`, `created_by`, `created_on`) VALUES ('".$data['lead_name']."','".$data['company_name']."','".$data['designation']."','".$data['country']."','".$data['website']."','".$data['address']."','".$data['email_id']."','".$data['alternative_email_id']."','".$data['skype_id']."','".$data['contact_no']."','".$data['whatsapp_no']."','".$data['office_phone_no']."','".$data['created_by']."','".$data['created_on']."')");
    $insert_id = $this->db->insert_id();
    save_query_in_log();
    return $insert_id; 
  }
  public function lead_followup_next_auto_id()
  {
      $result = common_select_values('AUTO_INCREMENT', 'INFORMATION_SCHEMA.TABLES', ' TABLE_SCHEMA = database() AND TABLE_NAME = "lead_followups"', 'row');
      return $result; 
  }
  public function get_notification_type_by_id($id)
  {
    $result = $this->db->query("SELECT nt.* FROM notification_type nt WHERE nt.notification_type_id = '$id'")->row();
    save_query_in_log();
    return $result; 
  }
  public function add_filt_template($module_flag,$filt_temp_name,$filt_temp)
  {
    $cby = $_SESSION['admindata']['user_id'];
    $con = date('Y-m-d H:i:s');
    $result = $this->db->query("INSERT INTO `filter_templates`(`module_in`, `filter_template_name`, `filter_template`, `created_by`, `created_on`) VALUES ('$module_flag','$filt_temp_name','$filt_temp','$cby','$con')");
    save_query_in_log();
    return 1; 
  }
  public function get_filter_template_by_module($module_flag)
  {
    $result = $this->db->query("SELECT ft.* FROM filter_templates ft WHERE ft.module_in = '$module_flag'")->result();
    save_query_in_log();
    return $result; 
  }

    public function get_multi_product_costing_product_by_lead_id($l_id)
   {       
      $result = $this->db->query("call get_multi_product_costing_product_by_lead_id('".$l_id."')")->result_array();
      save_query_in_log();       
      return $result;
   }

    public function get_quote_by_lead_id($l_id)
   {       
      $result = $this->db->query("call get_quote_by_lead_id('".$l_id."')")->result_array();
      save_query_in_log();       
      return $result;
   }
   public function get_all_product_for_expo($industry_filt)
   {
          $result = $this->db->query("SELECT p.*,i.industry_name,(SELECT GROUP_CONCAT(ed.email_ID) FROM product_emails pe, email_details ed WHERE ed.email_detail_id = pe.email_detail_id AND pe.product_id = p.product_id) AS product_emails_group, (SELECT GROUP_CONCAT(u.name) FROM user_products up, users u WHERE up.user_id = u.user_id AND up.product_id = p.product_id ) AS product_users_group FROM products p 
  LEFT JOIN industries i ON i.industry_id = p.industry_id
  WHERE p.status != 2 $industry_filt")->result_array();
          return $result;
   }
  // public function get_parent_leads_info()
  // {
  //   $result = $this->db->query("SELECT l.* FROM leads l WHERE l.status != 2 AND l.parent_or_child = 0")->result();
  //   save_query_in_log();
  //   return $result;
  // }
  public function get_lead_task_list($boid)
  {
    $result = $this->db->query("CALL get_lead_task_list('".$boid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function lead_task_next_auto_id()
  {
    $result = common_select_values('AUTO_INCREMENT', 'INFORMATION_SCHEMA.TABLES', ' TABLE_SCHEMA = database() AND TABLE_NAME = "lead_task"', 'row');
        return $result; 
  }
  public function create_lead_task($data)
  {
    $result = $this->db->query("CALL create_lead_task('".$data['lead_task_date']."','".$data['task']."','".$data['assigned_to']."','".$data['lead_task_end_date']."','".$data['lead_id']."','".$data['created_on']."','".$data['created_by']."')");
    save_query_in_log();
    return $result;
  }
  public function create_lead_task_remarks($data)
  {
    $result = $this->db->query("CALL create_lead_task_remarks('".$data['lead_task_id']."','".$data['remarks']."','".$data['modified_on']."','".$data['modified_by']."','".$data['status']."')");
    save_query_in_log();
    return $result;
  }
  public function update_lead_task($data)
  {
    $result = $this->db->query("CALL update_lead_task('".$data['lead_task_id']."','".$data['remarks']."','".$data['modified_on']."','".$data['modified_by']."','".$data['status']."')");
    save_query_in_log();
    return $result;
  }
  public function get_lead_task_by_id($iid)
  {
    $result = $this->db->query("CALL get_lead_task_by_id('".$iid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_lead_task_remarks_by_botid($iid)
  {
    $result = $this->db->query("CALL get_lead_task_remarks_by_botid('".$iid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function save_contact_person_info($data)
  {
    $result = $this->db->insert('contact_persons',$data);
    save_query_in_log();
    return $result;
  }
  public function save_billing_addr_info($ba_data)
  {
    $result = $this->db->insert('lead_billing_address',$ba_data);
    save_query_in_log();
    return $result;
  }
  public function save_shipping_addr_info($data)
  {
    $result = $this->db->insert('lead_shipping_address',$data);
    save_query_in_log();
    return $result;
  }
  public function del_lead_contact_person($cb_id)
  {
    $result = $this->db->query("DELETE FROM contact_persons WHERE contact_book_id = '".$cb_id."'");
    return 1;
  }
  public function remove_shipping_addr_by_id($value)
  {
    $result = $this->db->query("DELETE FROM lead_shipping_address WHERE lead_shipping_address_id = '".$value."'");
    return 1;
  }
  public function remove_billing_addr_by_id($value)
  {
    $result = $this->db->query("DELETE FROM lead_billing_address WHERE lead_billing_address_id = '".$value."'");
    return 1;
  }
  public function update_billing_addr_info($ba_data,$lead_billing_address_id)
  {
    $this->db->where('lead_billing_address_id', $lead_billing_address_id);
    $this->db->update('lead_billing_address', $ba_data);
    return 1;
  }
  public function update_shipping_addr_info($ba_data,$lead_shipping_address_id)
  {
    $this->db->where('lead_shipping_address_id', $lead_shipping_address_id);
    $this->db->update('lead_shipping_address', $ba_data);
    return 1;
  }
  public function search_lead_list($page, $perpage, $search_val)
  {
    $qcond = '';
    $tab_join = '';
    $tab_col_val = '';

    if ($search_val != '') {
      $sc = 'AND (cb.lead_name LIKE "%'.$search_val.'%" OR p.product_name LIKE "%'.$search_val.'%" OR contry.name LIKE "%'.$search_val.'%" OR u.name LIKE "%'.$search_val.'%" OR cb.email_id LIKE "%'.$search_val.'%" OR sls.sub_lead_source LIKE "%'.$search_val.'%" OR lt.lead_type LIKE "%'.$search_val.'%" OR lst.lead_status LIKE "%'.$search_val.'%" OR ls.lead_source LIKE "%'.$search_val.'%"  OR indus.industry_name LIKE "%'.$search_val.'%")';
    }
    else {
      $sc = '';
    }
    

    $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

    if($user_details->show_leads == 1)
    {
      $lead_assign_val == '';
    }
    else if($user_details->show_leads == 2)
    {
      $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
    }
    else if($user_details->show_leads == 3 && $user_details->product_users != '')
    {
      $lead_assign_val = " AND (FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."') OR l.lead_assigned_to = '".$_SESSION['admindata']['user_id']."')";
    }else{
        $lead_assign_val = '';
    }
    // echo $tab_col_val;
    // echo "<br>";
    // echo $tab_join;
    // echo "<br>";
    // echo $tab_val;
    $sql = $this->db->query("SELECT (SELECT COUNT(lmr.lead_id) FROM lead_mail_reply lmr WHERE lmr.lead_id = l.lead_id) AS mail_reply_count,l.lead_id, l.import_lead_mails, contry.name as country_name, l.lead_type_id,cb.*, l.lead_source_id, l.lead_taken_by,  l.created_on, l.created_by, l.modified_on, l.modified_by, l.status, lt.lead_type as lead_type_name, ls.lead_source as source_name, sls.sub_lead_source as sub_source_name, u.name as lead_assign_name, cu.name as lead_created_by, p.product_name, indus.industry_name, l.lead_status_id, lst.lead_status as lead_status_name,l.comments $tab_col_val
     FROM leads l
           LEFT JOIN  contact_book cb ON cb.contact_book_id = l.contact_book_id
           LEFT JOIN  lead_type lt on lt.lead_type_id = l.lead_type_id
           LEFT JOIN  lead_status lst on lst.lead_status_id = l.lead_status_id
           LEFT JOIN  sub_lead_source sls on sls.sub_lead_source_id = l.lead_source_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = sls.lead_source_id
           LEFT JOIN ad_countries contry ON contry.id = cb.country
           LEFT JOIN users u ON u.user_id = l.lead_assigned_to
           LEFT JOIN users cu ON cu.user_id = l.created_by
           LEFT JOIN  products p on p.product_id = l.product_id
           LEFT JOIN  industries indus on indus.industry_id = l.industry_id
           WHERE l.status !=999 $lead_assign_val $sc 
           GROUP BY l.lead_id
           ORDER BY l.created_on DESC LIMIT $page, $perpage
           ")->result(); 
    //save_query_in_log();
    return $sql; 
  }
  public function search_lead_list_count($search_val)
  {
    $qcond = '';
    $tab_join = '';
    $tab_col_val = '';

    if ($search_val != '') {
      $sc = 'AND (cb.lead_name LIKE "%'.$search_val.'%" OR p.product_name LIKE "%'.$search_val.'%" OR contry.name LIKE "%'.$search_val.'%" OR u.name LIKE "%'.$search_val.'%" OR cb.email_id LIKE "%'.$search_val.'%" OR sls.sub_lead_source LIKE "%'.$search_val.'%" OR lt.lead_type LIKE "%'.$search_val.'%" OR lst.lead_status LIKE "%'.$search_val.'%" OR ls.lead_source LIKE "%'.$search_val.'%"  OR indus.industry_name LIKE "%'.$search_val.'%")';
    }
    else {
      $sc = '';
    }
    

    $user_details = $this->User_model->user_by_id($_SESSION['admindata']['user_id']);

    if($user_details->show_leads == 1)
    {
      $lead_assign_val == '';
    }
    else if($user_details->show_leads == 2)
    {
      $lead_assign_val = " AND l.lead_assigned_to =".$_SESSION['admindata']['user_id'];
    }
    else if($user_details->show_leads == 3 && $user_details->product_users != '')
    {
      $lead_assign_val = " AND (FIND_IN_SET(l.lead_assigned_to, '".$user_details->product_users."') OR l.lead_assigned_to = '".$_SESSION['admindata']['user_id']."')";
    }else{
        $lead_assign_val = '';
    }
    // echo $tab_col_val;
    // echo "<br>";
    // echo $tab_join;
    // echo "<br>";
    // echo $tab_val;
    $sql = $this->db->query("SELECT (SELECT COUNT(lmr.lead_id) FROM lead_mail_reply lmr WHERE lmr.lead_id = l.lead_id) AS mail_reply_count,l.lead_id, l.import_lead_mails, contry.name as country_name, l.lead_type_id,cb.*, l.lead_source_id, l.lead_taken_by,  l.created_on, l.created_by, l.modified_on, l.modified_by, l.status, lt.lead_type as lead_type_name, ls.lead_source as source_name, sls.sub_lead_source as sub_source_name, u.name as lead_assign_name, cu.name as lead_created_by, p.product_name, indus.industry_name, l.lead_status_id, lst.lead_status as lead_status_name,l.comments $tab_col_val
     FROM leads l
           LEFT JOIN  contact_book cb ON cb.contact_book_id = l.contact_book_id
           LEFT JOIN  lead_type lt on lt.lead_type_id = l.lead_type_id
           LEFT JOIN  lead_status lst on lst.lead_status_id = l.lead_status_id
           LEFT JOIN  sub_lead_source sls on sls.sub_lead_source_id = l.lead_source_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = sls.lead_source_id
           LEFT JOIN ad_countries contry ON contry.id = cb.country
           LEFT JOIN users u ON u.user_id = l.lead_assigned_to
           LEFT JOIN users cu ON cu.user_id = l.created_by
           LEFT JOIN  products p on p.product_id = l.product_id
           LEFT JOIN  industries indus on indus.industry_id = l.industry_id
           WHERE l.status !=999 $lead_assign_val $sc 
           GROUP BY l.lead_id
           ORDER BY l.created_on DESC
           ")->result(); 
    //save_query_in_log();
    return $sql; 
  }
}

?>