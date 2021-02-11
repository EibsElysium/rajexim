<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Target_model database details
    Date    :29-02-2020 
****************************************************************/
class Target_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  function add_products_with_year($product_id,$yr)
  {
    $result = $this->db->query("CALL add_product_into_target('".$product_id."','".$yr."')");
    save_query_in_log();
    return 1;
  }
  function chk_pro_and_year_already_exist($product_id,$yr)
  {
    $result = $this->db->query("CALL chk_pro_and_year_already_exist('".$product_id."','".$yr."')")->row_array();
    save_query_in_log();
    return $result; 
  }
  function get_all_target_by_target($year,$search_val,$page,$perpage)
  {
    if ($search_val != '') {
      $sc = ' AND (p.product_name LIKE "%'.$search_val.'%" OR t.quote LIKE "%'.$search_val.'%")';
      // $data['page'] = $page = '0';
    }
    else {
      $sc = '';
    }
    $result = $this->db->query("SELECT t.*,p.* FROM target t 
                                LEFT JOIN products p ON p.product_id = t.product_id
                                WHERE t.year = '$year' $sc LIMIT $page, $perpage")->result();
    save_query_in_log();
    return $result; 
  }
  function get_all_target_by_target_count($year,$search_val)
  {
    if ($search_val != '') {
      $sc = ' AND (p.product_name LIKE "%'.$search_val.'%" OR t.quote LIKE "%'.$search_val.'%")';
      // $data['page'] = $page = '0';
    }
    else {
      $sc = '';
    }
    $result = $this->db->query("SELECT t.*,p.* FROM target t 
                              LEFT JOIN products p ON p.product_id = t.product_id
                              WHERE t.year = '$year' $sc")->result();
    save_query_in_log();
    return $result; 
  }
  function update_target_counts($tar_id,$column,$value)
  {
    $result = $this->db->query("UPDATE target t SET t.$column = '$value' WHERE t.target_id = '$tar_id'");
    save_query_in_log();
    return 1; 
  }
  function chk_filter_year_exist_or_not($year)
  {
    $result = $this->db->query("SELECT t.* FROM target t WHERE t.year = '$year'")->result();
    save_query_in_log();
    return $result; 
  }
}
?>