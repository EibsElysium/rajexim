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
        if ($_SESSION['admindata']['user_hasnt_product'] != 1) {
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
                }else{
                    $d_format = '0'.$i;
                }
                $created_date = $year_month.'-'.$d_format;
                $day_val .= "(select COUNT(l.lead_id) from leads l WHERE l.lead_source_id = sls.sub_lead_source_id AND l.status != 2 $user_filt 
                AND date_format(l.created_on, '%Y-%m-%d') = '".$created_date."') as '$d_format',";
            }
        }
        // echo "SELECT ls.lead_source, sls.sub_lead_source_id, sls.lead_source_id, sls.sub_lead_source , $day_val FROM sub_lead_source sls LEFT JOIN lead_source ls ON ls.lead_source_id = sls.sub_lead_source_id WHERE sls.status != 2 GROUP BY sls.sub_lead_source_id";
        // die();
        $day_val = trim($day_val, ',');
        $query = $this->db->query("SELECT ls.lead_source, sls.sub_lead_source_id, sls.lead_source_id, sls.sub_lead_source , $day_val FROM sub_lead_source sls LEFT JOIN lead_source ls ON ls.lead_source_id = sls.lead_source_id WHERE sls.status != 2 ORDER BY sls.lead_source_id DESC");
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
        if ($_SESSION['admindata']['user_hasnt_product'] != 1) {
            $user_id = $_SESSION['admindata']['user_id'];
            $user_filt = "AND l.lead_assigned_to = '$user_id'";
        }
        else {
            $user_filt = "";   
        }
        $day_val = "";
        if($no_days > 0)
        {
            for($i = 0; $i < COUNT($no_days); $i++)
            {
                // if(strlen($i) > 1)
                // {
                //     $d_format = $i;
                // }else{
                //     $d_format = '0'.$i;
                // }
                $exp = explode('-', $no_days[$i]);
                $created_date = $exp[1].'-'.$exp[0];
                $day_val .= "(select COUNT(l.lead_id) from leads l WHERE l.lead_source_id = sls.sub_lead_source_id AND l.status != 2 $user_filt 
                AND date_format(l.created_on, '%Y-%m') = '".$created_date."') as '$exp[0]',";
            }
        }
        $day_val = trim($day_val, ',');
        $query = $this->db->query("SELECT ls.lead_source, sls.sub_lead_source_id, sls.lead_source_id, sls.sub_lead_source , $day_val FROM sub_lead_source sls LEFT JOIN lead_source ls ON ls.lead_source_id = sls.lead_source_id WHERE sls.status != 2 ORDER BY sls.lead_source_id DESC");
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
    public function oppo_source_daily_report($year_month, $no_days)
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
                $day_val .= "(select COUNT(l.lead_id) from leads l WHERE l.lead_source_id = ls.lead_source_id AND l.status != 2 AND l.lead_status_id = 3 AND l.lead_type_id = 1 AND date_format(l.created_on, '%Y-%m-%d') = '".$created_date."') as '$d_format',";
            }
        }
        $day_val = trim($day_val, ',');
        $query = $this->db->query("SELECT ls.lead_source_id, ls.lead_source , $day_val FROM lead_source ls WHERE ls.status != 2 GROUP BY ls.lead_source_id");
        return $query->result_array();
    }
    // To get lead source daily count
    public function oppo_source_daily_count_report($year_month, $no_days)
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
               
                $day_val .= "(SELECT COUNT(l.lead_id) as '$d_format' FROM leads l WHERE l.status != 2 AND l.lead_status_id = 3 AND l.lead_type_id = 1 AND date_format(l.created_on, '%Y-%m-%d') = '".$date."') as '$d_format',";
            }
        }
        $day_val = trim($day_val, ',');
        $query = $this->db->query("SELECT $day_val");
        return $query->row_array();
    }
    // To get lead source month details
    public function oppo_source_month_report($year, $no_days)
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
                $day_val .= "(select COUNT(l.lead_id) from leads l WHERE l.lead_source_id = ls.lead_source_id AND l.lead_status_id = 3 AND l.lead_type_id = 1 AND l.status != 2 
                AND date_format(l.created_on, '%Y-%m') = '".$created_date."') as '$d_format',";
            }
        }
        $day_val = trim($day_val, ',');
        $query = $this->db->query("SELECT ls.lead_source_id, ls.lead_source , $day_val FROM lead_source ls WHERE ls.status != 2 GROUP BY ls.lead_source_id");
        return $query->result_array();
    }
    // To get lead source month count
    public function oppo_source_month_count_report($year, $no_days)
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
               
                $day_val .= "(SELECT COUNT(l.lead_id) as '$d_format' FROM leads l WHERE l.status != 2 AND l.lead_status_id = 3 AND l.lead_type_id = 1 AND date_format(l.created_on, '%Y-%m') = '".$date."') as '$d_format',";
            }
        }
        $day_val = trim($day_val, ',');
        $query = $this->db->query("SELECT $day_val");
        return $query->row_array();
    }
    public function sub_lead_source_list_by_ls_id($lead_source_id)
    {
        $query = $this->db->query("SELECT sls.* FROM sub_lead_source sls WHERE sls.lead_source_id = '$lead_source_id'")->result();
        return $query;
    }
    public function get_lead_count_based_product_graph($assign_person,$month,$year,$ls_filt,$product_id,$indus_id)
    {

        if($assign_person != '') {
            $user_filt = "AND le.lead_assigned_to = '$assign_person'";
        }
        else {
            $user_filt = '';
        }
        if ($product_id != '') {
            $pro_filt = "AND le.product_id = '$product_id'";
        }
        else {
            $pro_filt = "";
        }
        if ($indus_id != '') {
            $indus_filt = "AND le.industry_id = '$indus_id'";
        }
        else {
            $indus_filt = '';
        }
        $query = $this->db->query("SELECT 
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '01' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d1,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '02' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d2,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '03' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d3,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '04' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d4,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '05' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d5,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '06' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d6,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '07' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d7,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '08' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d8,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '09' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d9,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '10' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d10,

            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '11' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d11,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '12' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d12,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '13' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d13,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '14' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d14,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '15' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d15,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '16' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d16,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '17' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d17,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '18' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d18,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '19' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d19,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '20' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d20,

            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '21' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d21,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '22' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d22,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '23' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d23,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '24' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d24,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '25' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d25,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '26' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d26,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '27' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d27,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '28' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d28,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '29' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d29,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '30' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d30,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND DAY(le.created_on) = '31' AND MONTH(le.created_on) = '$month' AND YEAR(le.created_on) = '$year' $user_filt $pro_filt $indus_filt $ls_filt) AS d31
            FROM leads l WHERE l.status != 2 GROUP BY d1")->row();
        return $query;           
    }
    public function get_month_lead_count_based_product_graph($assign_person,$year,$ls_filt,$product_id,$indus_id)
    {
        $exp_year = explode('-', $year);
        $yr1 = $exp_year[0];
        $yr2 = $exp_year[1];
        if($assign_person != '') {
            $user_filt = "AND le.lead_assigned_to = '$assign_person'";
        }
        else {
            $user_filt = '';
        }
        if ($product_id != '') {
            $pro_filt = "AND le.product_id = '$product_id'";
        }
        else {
            $pro_filt = "";
        }
        if ($indus_id != '') {
            $indus_filt = "AND le.industry_id = '$indus_id'";
        }
        else {
            $indus_filt = '';
        }
        $query = $this->db->query("SELECT 
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '04' AND YEAR(le.created_on) = '$yr1' $user_filt $pro_filt $indus_filt $ls_filt) AS m4,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '05' AND YEAR(le.created_on) = '$yr1' $user_filt $pro_filt $indus_filt $ls_filt) AS m5,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '06' AND YEAR(le.created_on) = '$yr1' $user_filt $pro_filt $indus_filt $ls_filt) AS m6,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '07' AND YEAR(le.created_on) = '$yr1' $user_filt $pro_filt $indus_filt $ls_filt) AS m7,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '08' AND YEAR(le.created_on) = '$yr1' $user_filt $pro_filt $indus_filt $ls_filt) AS m8,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '09' AND YEAR(le.created_on) = '$yr1' $user_filt $pro_filt $indus_filt $ls_filt) AS m9,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '10' AND YEAR(le.created_on) = '$yr1' $user_filt $pro_filt $indus_filt $ls_filt) AS m10,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '11' AND YEAR(le.created_on) = '$yr1' $user_filt $pro_filt $indus_filt $ls_filt) AS m11,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '12' AND YEAR(le.created_on) = '$yr1' $qy $pro_filt $indus_filt $ls_filt) AS m12,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '01' AND YEAR(le.created_on) = '$yr2' $user_filt $pro_filt $indus_filt $ls_filt) AS m1,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '02' AND YEAR(le.created_on) = '$yr2' $user_filt $pro_filt $indus_filt $ls_filt) AS m2,
            (SELECT COUNT(le.lead_id) FROM leads le WHERE le.status != 2 AND MONTH(le.created_on) = '03' AND YEAR(le.created_on) = '$yr2' $user_filt $pro_filt $indus_filt $ls_filt) AS m3
           FROM leads l WHERE l.status != 2 GROUP BY m1")->row();
        return $query;   
    }
    public function get_user_name_with_assigned_product()
    {
        $query = $this->db->query("SELECT up.*,u.name, p.product_name FROM user_products up LEFT JOIN users u ON u.user_id = up.user_id LEFT JOIN products p ON p.product_id = up.product_id WHERE up.status != 2 ORDER BY up.user_id ASC")->result();
        return $query;
    }
    public function product_assigned_users()
    {
        $query = $this->db->query("SELECT up.*,u.name, p.product_name FROM user_products up LEFT JOIN users u ON u.user_id = up.user_id LEFT JOIN products p ON p.product_id = up.product_id WHERE up.status != 2 GROUP BY up.user_id ASC")->result();
        return $query;   
    }
    public function get_product_assigned_user_by_ids($ls_filt)
    {
        $query = $this->db->query("SELECT up.*,u.name, p.product_name FROM user_products up LEFT JOIN users u ON u.user_id = up.user_id LEFT JOIN products p ON p.product_id = up.product_id WHERE up.status != 2 $ls_filt ORDER BY up.user_id ASC")->result();
        return $query;
    }
    public function get_products_by_id($p_filt)
    {
        $query = $this->db->query("SELECT p.* FROM products p WHERE p.status != 2 $p_filt");
        return $query->result();   
    }
    public function get_quarter_year_by_id($ls_filt)
    {
        $query = $this->db->query("SELECT qy.* FROM quarter_year qy WHERE qy.status != 2 $ls_filt");
        return $query->result();   
    }
    public function get_one_user_by_id($user_id)
    {
        $query = $this->db->query("SELECT u.* FROM users u WHERE u.user_id = '$user_id'")->result();
        return $query;
    }
}

?>