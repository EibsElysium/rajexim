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
    if($query = $this->db->query("call lead_source_update(

        '".$data['lead_source']."',
        '".$data['m_on']."',
        '".$data['m_by']."',
        '".$l_s_id."'
        
        )"))
        { save_query_in_log(); return true; }else{ save_query_in_log(); return false; }
  }
  
  // To add lead source
  public function lead_source_add($data)
  {
    if($query = $this->db->query("call lead_source_add(

        '".$data['lead_source']."',
        '".$data['c_on']."',
        '".$data['c_by']."'
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
  public function lead_list($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $year, $month, $product_id, $tab)
  {

    $qcond = '';
    $tab_join = '';
    $tab_col_val = '';

    if($tab == 1)
    {
      $tab_val = " AND l.status = 0 AND NOT EXISTS( SELECT lead_id FROM lead_followups WHERE lead_id = l.lead_id)";
    }
    else if($tab == 2)
    {
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

    if($t_fup == 1 && $tab == 2)
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
    if($year != '' && $month != 'all' && $lead_daterange == '')
    {
      $year_month = $year.'-'.$month;
      $year_month_val = 'DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
    }else  if($year != '' && $month == 'all' && $lead_daterange == ''){
      $year_month = $year;
      $year_month_val = 'DATE_FORMAT(l.created_on, "%Y") = "'.$year_month.'"';
    }
    else if($year != '' && $month != '' && $lead_daterange != ''){
        $explode_date = explode('/', $lead_daterange);
        $startdate = $explode_date[0];
        $startdate = date('Y-m-d', strtotime($explode_date[0]));
        $enddate =date('Y-m-d', strtotime($explode_date[1]));
        $year_month_val = "DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
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

    $sql = $this->db->query("SELECT l.lead_id, l.lead_name, l.company_name, l.designation,l.country, contry.name as country_name, l.email_id, l.lead_type_id,  l.contact_no as contact_no,  l.lead_source_id, l.lead_taken_by,  l.created_on, l.created_by, l.modified_on, l.modified_by, l.status, lt.lead_type as lead_type_name, ls.lead_source as source_name, u.name as lead_assign_name, cu.name as lead_created_by, p.product_name, indus.industry_name, l.lead_status_id, lst.lead_status as lead_status_name $tab_col_val
     FROM leads l
           LEFT JOIN  lead_type lt on lt.lead_type_id = l.lead_type_id
           LEFT JOIN  lead_status lst on lst.lead_status_id = l.lead_status_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = l.lead_source_id
           LEFT JOIN ad_countries contry ON contry.id = l.country
           LEFT JOIN users u ON u.user_id = l.lead_assigned_to
           LEFT JOIN users cu ON cu.user_id = l.created_by
           LEFT JOIN  products p on p.product_id = l.product_id
           LEFT JOIN  industries indus on indus.industry_id = l.industry_id
           $tab_join
           WHERE $year_month_val $tab_val $lead_assign_val  $lt $ls $lst $pv $t_fups $qcond
           GROUP BY l.lead_id
           ORDER BY l.lead_id DESC
           ")->result(); 
    //save_query_in_log();
    return $sql; 
  }
  // To opportunities lead details
  public function opportunity_lead_list($lead_type , $lead_source, $lead_daterange, $lead_status, $t_fup, $year, $month, $product_id, $tab)
  {

    $qcond = '';

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
    if($year != '' && $month != 'all' && $lead_daterange == '')
    {
      $year_month = $year.'-'.$month;
      $year_month_val = 'DATE_FORMAT(l.created_on, "%Y-%m") >= "'.$year_month.'" and DATE_FORMAT(l.created_on, "%Y-%m") <= "'.$year_month.'"';
    }else  if($year != '' && $month == 'all' && $lead_daterange == ''){
      $year_month = $year;
      $year_month_val = 'DATE_FORMAT(l.created_on, "%Y") = "'.$year_month.'"';
    }
    // else if($year != '' && $month != '' && $lead_daterange != ''){


    //     $explode_date = explode('-', $lead_daterange);
    //     $startdate = $explode_date[0];

    //     $startdate = explode('/', $explode_date[0]);
    //     $startdate = trim($startdate[2], ' ').'-'.$startdate[0].'-'.$startdate[1];
      
    //     $enddate = explode('/', $explode_date[1]);
    //     $enddate = $enddate[2].'-'.trim($enddate[0], ' ').'-'.$enddate[1];

    //     $year_month_val = "DATE_FORMAT(l.created_on, '%Y-%m-%d') >= '".$startdate."' and DATE_FORMAT(l.created_on, '%Y-%m-%d') <= '".$enddate."'";
    // }
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

    $tab_join = '';
    $tab_col_val = '';

   if($tab == 1)
    {
      $tab_val = "AND l.status = 3";
      $tab_join = "LEFT JOIN  lead_followups fups on fups.lead_id = l.lead_id AND DATE(fups.followup_date) = DATE(NOW()) AND fups.status = 0";
      $tab_col_val = ", CASE WHEN (DATE(fups.followup_date) = DATE(NOW())) THEN GROUP_CONCAT(fups.followup_time) else 0 END as fup_status, fups.status as 'fupst'";
    }
    else if($tab == 2)
    {
      $tab_val = "AND l.status = 1";
      $tab_join = '';
      $tab_col_val = '';

    }
    else{

      $tab_val = '';
    }

    $sql = $this->db->query("SELECT l.lead_id, l.lead_name, l.company_name, l.designation,l.country, contry.name as country_name, l.email_id, l.lead_type_id,  l.contact_no as contact_no,  l.lead_source_id, l.lead_taken_by,  l.created_on, l.created_by, l.modified_on, l.modified_by, l.status, lt.lead_type as lead_type_name, ls.lead_source as source_name, u.name as lead_assign_name, cu.name as lead_created_by, p.product_name, indus.industry_name, l.lead_status_id, lst.lead_status as lead_status_name $tab_col_val
     FROM leads l
           LEFT JOIN  lead_type lt on lt.lead_type_id = l.lead_type_id
           LEFT JOIN  lead_status lst on lst.lead_status_id = l.lead_status_id
           LEFT JOIN  lead_source ls on ls.lead_source_id = l.lead_source_id
           LEFT JOIN ad_countries contry ON contry.id = l.country
           LEFT JOIN users u ON u.user_id = l.lead_assigned_to
           LEFT JOIN users cu ON cu.user_id = l.created_by
           LEFT JOIN  products p on p.product_id = l.product_id
           LEFT JOIN  industries indus on indus.industry_id = l.industry_id
            $tab_join
           WHERE  $year_month_val $tab_val $lead_assign_val  $lt $ls $lst $pv $t_fups $qcond 
           GROUP BY l.lead_id
           ORDER BY l.lead_id DESC
           ")->result(); 
    //save_query_in_log();
    return $sql; 
  }

  // To get today followup count list
  public function lead_today_followup_list($lead_type , $lead_source, $lead_daterange, $lead_status, $product_id, $tab)
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
           WHERE DATE(followup_date) = DATE(NOW()) $tab_val $lead_assign_val  $lt $ls $lst $pv $dateq ORDER BY l.lead_id DESC
           ")->row(); 
    save_query_in_log();
    return $sql; 
  }

  // To get today followup count list
  public function opportunity_lead_today_followup_list($lead_type , $lead_source, $lead_daterange, $lead_status, $product_id, $tab)
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
           WHERE DATE(followup_date) = DATE(NOW()) $tab_val $lead_assign_val  $lt $ls $lst $pv $dateq ORDER BY l.lead_id DESC
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
  public function lead_cancel($bid)
  {
     
    $result = $this->db->query("CALL lead_cancel('".$bid."')");
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

  public function re_lead($bid)
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
    $result = $this->db->insert('leads', $data);
    return $result;
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
        $this->db->where('lead_id', $l_id);
       $result =  $this->db->update('leads', $data);
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
    $result = common_select_values('l.lead_id, l.lead_name, l.company_name, l.email_id, l.product_id, l.industry_id, l.created_on, l.lead_assigned_to, (select product_name from products where product_id = l.product_id) as product_name, (select industry_name from industries where industry_id = l.industry_id) as industry_name, (select lead_status from lead_status where lead_status_id = l.lead_status_id) as lead_status_name, (select name from users where user_id = l.lead_assigned_to) as assigned_person', 'leads l', ' email_id LIKE "'.'%'.$value.'%'.'" AND l.lead_id != "'.$lead_id.'" AND l.status != 2', 'result');
    return $result; 
  }

  // To get assigned user list
  public function assigned_user_lists()
  {
    $result = common_select_values('user_id, name', 'users', ' status!=2 AND allow_lead = 1', 'result');
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
      $result = common_select_values('*', 'email_details', ' status!=2 AND email_ID = "'.$email_id.'"', 'row');
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
}

?>