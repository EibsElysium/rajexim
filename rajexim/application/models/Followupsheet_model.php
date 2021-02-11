<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Followupsheet_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_buyer_order_list_by_date($sdate,$edate)
  {
    $result = $this->db->query("CALL get_buyer_order_list_by_date('".$sdate."','".$edate."')")->result_array();
    save_query_in_log();
    return $result;
  }

}
?>