<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the lead report database details
    Date    :28-02-2020 
****************************************************************/
class Report_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }

  /************************************************************************************************************
                                  Purpose : To handle all the lead source database details
                                  Date    : 28-02-2020 
                  ****************************************************************************/
  // To get lead source daily details
public function lead_source_daily_report($year_month, $no_days)
{

    $day_val = "";
    if($no_days > 0)
    {
        for($i = 1; $i<=$no_days; $i++)
        {
            if(strlen($i) > 1)
            {
                $d_format = $i;
            }else{
                $d_format = '0'.$i;
            }
            $created_date = $year_month.'-'.$d_format;
            $day_val .= "(select COUNT(l.lead_id) from leads l WHERE l.lead_source_id = ls.lead_source_id AND l.status != 2 
            AND date_format(l.created_on, '%Y-%m-%d') = '".$created_date."') as '$d_format',";
        }
    }
    $day_val = trim($day_val, ',');
    $query = $this->db->query("SELECT ls.lead_source_id, ls.lead_source , $day_val FROM lead_source ls WHERE ls.status != 2 GROUP BY ls.lead_source_id");
    return $query->result_array();
}
// To get lead source daily count
public function lead_source_daily_count_report($year_month, $no_days)
{
  $day_val = "";
    if($no_days > 0)
    {
        for($i = 1; $i<=$no_days; $i++)
        {
            if(strlen($i) > 1)
            {
                $d_format = $i;
            }else{
                $d_format = '0'.$i;
            }
            $date = $year_month.'-'.$d_format;
           
            $day_val .= "(SELECT COUNT(l.lead_id) as '$d_format' FROM leads l WHERE l.status != 2 AND date_format(l.created_on, '%Y-%m-%d') = '".$date."') as '$d_format',";
        }
    }
    $day_val = trim($day_val, ',');
    $query = $this->db->query("SELECT $day_val");
    return $query->row_array();
}
// To get lead source month details
public function lead_source_month_report($year, $no_days)
{

    $day_val = "";
    if($no_days > 0)
    {
        for($i = 1; $i<=$no_days; $i++)
        {
            if(strlen($i) > 1)
            {
                $d_format = $i;
            }else{
                $d_format = '0'.$i;
            }
            $created_date = $year.'-'.$d_format;
            $day_val .= "(select COUNT(l.lead_id) from leads l WHERE l.lead_source_id = ls.lead_source_id AND l.status != 2 
            AND date_format(l.created_on, '%Y-%m') = '".$created_date."') as '$d_format',";
        }
    }
    $day_val = trim($day_val, ',');
    $query = $this->db->query("SELECT ls.lead_source_id, ls.lead_source , $day_val FROM lead_source ls WHERE ls.status != 2 GROUP BY ls.lead_source_id");
    return $query->result_array();
}
// To get lead source month count
public function lead_source_month_count_report($year, $no_days)
{
  $day_val = "";
    if($no_days > 0)
    {
        for($i = 1; $i<=$no_days; $i++)
        {
            if(strlen($i) > 1)
            {
                $d_format = $i;
            }else{
                $d_format = '0'.$i;
            }
            $date = $year.'-'.$d_format;
           
            $day_val .= "(SELECT COUNT(l.lead_id) as '$d_format' FROM leads l WHERE l.status != 2 AND date_format(l.created_on, '%Y-%m') = '".$date."') as '$d_format',";
        }
    }
    $day_val = trim($day_val, ',');
    $query = $this->db->query("SELECT $day_val");
    return $query->row_array();
}



}

?>