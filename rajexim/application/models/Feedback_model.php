<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Feedback_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }
  public function get_buyerorder_by_feedback_status($id)
  {  
    $result = $this->db->query("call get_buyerorder_by_feedback_status('".$id."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_buyer_order_by_id($id)
  {  
    $result = $this->db->query("call get_buyer_order_by_id('".$id."')")->row();
    save_query_in_log();
    return $result;
  }
  public function create_order_feedback($data)
  {
    $result = $this->db->query("CALL create_order_feedback('".$data['buyer_order_id']."','".$data['work_followup']."','".$data['staff_approach']."','".$data['timely_delivery']."','".$data['quality']."','".$data['suggestion']."','".$data['created_on']."',".$data['created_by'].")");
    save_query_in_log();
    return $result;
  }

}
?>