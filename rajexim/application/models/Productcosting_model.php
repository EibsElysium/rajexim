<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productcosting_model extends CI_Model 
{
  function __construct()
  {
      parent::__construct();
      date_default_timezone_set('Asia/Calcutta'); 
  }   

  function lead_list($postData){

     $response = array();

     if(isset($postData['search']) ){
       // Select record
       /*$this->db->select('*');
       $this->db->where("lead_name like '%".$postData['search']."%' ");
       $records = $this->db->get('leads')->result();*/

       $records = $this->db->query("SELECT l.lead_id,c.lead_name,c.company_name,adc.name FROM leads l, contact_book c, ad_countries adc WHERE c.contact_book_id = l.contact_book_id AND c.country = adc.id AND (c.lead_name LIKE '%".$postData['search']."%' OR c.company_name LIKE '%".$postData['search']."%' OR adc.name LIKE '%".$postData['search']."%')")->result();

       foreach($records as $row ){
          $lname = $row->lead_name;
          if($row->company_name!='')
          {
            $compname = ' - '.$row->company_name;
          }
          else
          {
            $compname = '';
          }
          $ctryName = ' - '.$row->name;

          $val = $lname.$compname.$ctryName;

          $response[] = array("value"=>$row->lead_id,"label"=>$val);
       }

     }

     return $response;
  }

  public function get_product_costing_list()
  {
    $result = $this->db->query("CALL get_product_costing_list()")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_product_list()
  {
    $result = $this->db->query("CALL get_product_list()")->result_array();
    save_query_in_log();
    return $result;
  }  
  public function get_lead_list()
  {
    $result = $this->db->query("CALL get_lead_list()")->result_array();
    save_query_in_log();
    return $result;
  }  
  public function get_product_costing_product_mapping_by_pid($pid)
  {
    $result = $this->db->query("CALL get_product_costing_product_mapping_by_pid('".$pid."')")->result_array();
    save_query_in_log();
    return $result;
  }  
  public function get_product_by_id($pid)
  {
    $result = $this->db->query("CALL get_product_by_id('".$pid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_product_item_by_product_id($pid,$cid)
  {
    $result = $this->db->query("CALL get_product_item_by_product_id('".$pid."','".$cid."')")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_product_item_by_id($piid)
  {
    $result = $this->db->query("CALL get_product_item_by_id('".$piid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function get_product_costing_stage_by_piid($piid)
  {
    $result = $this->db->query("CALL get_product_costing_stage_by_piid('".$piid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_stage_by_id($piid)
  {
    $result = $this->db->query("CALL get_product_costing_stage_by_id('".$piid."')")->row();
    save_query_in_log();
    return $result;
  }  
  public function create_product_costing($data)
  {
    $result = $this->db->query("CALL create_product_costing('".$data['lead_id']."','".$data['product_id']."','".$data['product_item_id']."','".$data['created_on']."','".$data['created_by']."','".$data['product_costing_no']."','".$data['parent_costing_id']."','".$data['is_draft']."','".$data['revised']."','".$data['product_item_display_name_id']."','".$data['container_id']."')");
    save_query_in_log();
    return $result;
  }
  public function product_costing_last_id()
  {
    $result = $this->db->query("CALL product_costing_last_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function create_product_costing_input($data)
  {
    $result = $this->db->query("CALL create_product_costing_input('".$data['product_costing_id']."','".$data['product_costing_type_id']."','".$data['product_costing_input']."')");
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_by_id($pcid)
  {
    $result = $this->db->query("CALL get_product_costing_by_id('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_input_by_pctype_pcid($pctid,$pcid)
  {
    $result = $this->db->query("CALL get_product_costing_input_by_pctype_pcid('".$pctid."','".$pcid."')")->row();
    save_query_in_log();
    return $result;
  }
  public function update_product_costing($data)
  {
    $result = $this->db->query("CALL update_product_costing('".$data['product_costing_id']."','".$data['lead_id']."','".$data['product_id']."','".$data['product_item_id']."','".$data['modified_on']."','".$data['modified_by']."','".$data['parent_costing_id']."','".$data['is_draft']."','".$data['revised']."')");
    save_query_in_log();
    return $result;
  }
  public function delete_product_costing_input_by_pcid($pcid)
  {
    $result = $this->db->query("CALL delete_product_costing_input_by_pcid('".$pcid."')");
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_mapping()
  {
    $result = $this->db->query("CALL get_product_costing_mapping()")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_type_list()
  {
    $result = $this->db->query("CALL get_product_costing_type_list()")->result_array();
    save_query_in_log();
    return $result;
  } 
  public function get_product_costing_type_by_id($pctid)
  {
    $result = $this->db->query("CALL get_product_costing_type_by_id('".$pctid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function product_costing_last_parent_id()
  {
    $result = $this->db->query("CALL product_costing_last_parent_id()")->row();
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_by_parent_id($parcid)
  {
    $result = $this->db->query("CALL get_product_costing_by_parent_id('".$parcid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function product_costing_delete($data)
  {
    $result = $this->db->query("CALL product_costing_delete('".$data['product_costing_id']."','".$data['status']."')");
    save_query_in_log();
    return $result;
  }
  public function get_product_costing_by_no($pcno)
  {
    $result = $this->db->query("CALL get_product_costing_by_no('".$pcno."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function get_product_costing_by_revised($pcid)
  {
    $result = $this->db->query("CALL get_product_costing_by_revised('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function get_product_costing_stage_by_product_costing_id($parcid)
  {
    $result = $this->db->query("CALL get_product_costing_stage_by_product_costing_id('".$parcid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function lead_by_id($pcid)
  {
    $result = $this->db->query("CALL lead_by_id('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function product_costing_approve($data)
  {
    $result = $this->db->query("CALL product_costing_approve('".$data['product_costing_id']."','".$data['is_approve']."','".$data['approved_by']."','".$data['approved_date']."')");
    save_query_in_log();
    return $result;
  }
  public function get_user_by_id($pcid)
  {
    $result = $this->db->query("CALL get_user_by_id('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  }  
  public function get_product_item_display_name_by_id($piid)
  {
    $result = $this->db->query("CALL get_product_item_display_name_by_id('".$piid."')")->result_array();
    save_query_in_log();
    return $result;
  }
  public function get_display_name_by_product_item_display_name_id($pcid)
  {
    $result = $this->db->query("CALL get_display_name_by_product_item_display_name_id('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  } 
  public function get_display_name_by_id($pcid)
  {
    $result = $this->db->query("CALL get_display_name_by_id('".$pcid."')")->row();
    save_query_in_log();
    return $result;
  }  

}
?>