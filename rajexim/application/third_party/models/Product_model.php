<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all Product detabase functions
    Date    : 04-02-2020
****************************************************************/
class Product_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta'); 
    }

    // To list Product list details
    public function product_list($letter, $industry)                 
    {
        if($letter != '' && $letter != 'all' )
        {
          $letter_val = " AND p.product_name LIKE '$letter%'";
        }else{
          $letter_val = '';
        }
        if($industry != '')
        {
          $industry_val = " AND p.industry_id = '$industry'";
          $letter_val = '';
        }else{
          $industry_val = '';

        }
        $sql = $this->db->query("SELECT p.*, idus.industry_name FROM products p
        LEFT JOIN industries  idus ON idus.industry_id = p.industry_id
        WHERE p.status !=2 $letter_val $industry_val"); 
        return $sql->result(); 
    }
    // To get next auto id for product id
    public function product_next_auto_id()
    {
        $result = common_select_values('AUTO_INCREMENT', 'INFORMATION_SCHEMA.TABLES', ' TABLE_SCHEMA = database() AND TABLE_NAME = "products"', 'row');
        return $result; 
    }
    // To save product details
    public function product_save($insert_columns, $table_name, $insert_values)
    {
        $result = common_insert_values($insert_columns, $table_name, $insert_values);
        return $result;
    }
    // To save product details
    public function product_emails_save($insert_columns, $table_name, $insert_values)
    {
        $result = common_insert_values($insert_columns, $table_name, $insert_values);
        return $result;
    }
    // To change industry status change
    public function product_status_change($data)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "status = '".trim($data['status'])."',  modified_on = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."'";
            $condition = ' product_id = "'.trim($data['product_id']).'"';
            $result = common_update_values($columns, 'products', $condition);
        }
        else
        {
            $result = false;
        }
       return $result;
    }
    // To get product by id
    public function product_by_id($product_id)
    {
        $result = common_select_values('p.product_id, p.industry_id, p.product_name, p.status, p.description, (SELECT GROUP_CONCAT(industry_name) FROM industries WHERE FIND_IN_SET(industry_id, p.industry_id)) as industry_name ', 'products p', ' p.status !=2 AND p.product_id = "'.$product_id.'"', 'row');
        return $result;
    }
    // To get product by id
    public function product_id_by_name($product)
    {
        $result = common_select_values('p.product_id, p.industry_id, p.product_name, p.status, p.description, (SELECT GROUP_CONCAT(industry_name) FROM industries WHERE FIND_IN_SET(industry_id, p.industry_id)) as industry_name ', 'products p', ' p.status !=2 AND p.product_name = "'.$product.'"', 'row');
        return $result;
    }
    // To get product emails by product id
    public function product_emails_by_id($product_id)
    {
        $result = common_select_values('p.product_email_id, p.product_id, p.email_detail_id, p.status, (SELECT GROUP_CONCAT(email_ID) FROM email_details WHERE FIND_IN_SET(email_detail_id, p.email_detail_id)) as email_name ', 'product_emails p', ' p.status !=2 AND p.product_id = "'.$product_id.'"', 'result_array');
        return $result;
    }
    // To get product user by product id
    public  function product_users_by_id($product_id)
    {
     $result = common_select_values('u.user_product_id, u.user_id, u.product_id, (select name from users where find_in_set(user_id, u.user_id)) as user_name', 'user_products u', ' u.product_id = "'.$product_id.'"', 'result');
        return $result;   
    }
    // To get product email id only
    public function product_email_ID_only_by_id($product_id)
    {
        $result = common_select_values('p.email_detail_id', 'product_emails p', ' p.status !=2 AND p.product_id = "'.$product_id.'"', 'result');
        return $result;
    }
    // To check product unique
    public function product_unique($product_name, $industry_id)
    {
       $result = common_select_values('product_id, industry_id,  status', 'products', ' status !=2 AND product_name = "'.$product_name.'" AND industry_id = "'.$industry_id.'"', 'row');
        return $result; 
    }
    // To update product details
    public function product_update($data)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "industry_id = '".trim($data['industry_id'])."',  product_name = '".trim($data['product_name'])."', description = '".trim($data['description'])."', modified_by = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."'";
            $condition = ' product_id = "'.trim($data['product_id']).'"';
            $result = common_update_values($columns, 'products', $condition);
        }
        else
        {
            $result = false;
        }
       return $result;
    }   
    // To check product email ID exists for product id
    public function product_email_ID_existby_product_id($product_id, $prd_email_id)
    {
        $result = common_select_values('p.product_email_id, p.product_id, p.email_detail_id', 'product_emails p', ' p.status !=2 AND p.product_id = "'.$product_id.'" AND email_detail_id = "'.$prd_email_id.'"', 'row');
        return $result;
    }
    // To delete product delete email id
    public function product_email_ID_delete_by_id($product_email_id)
    {   
        $result = common_delete_values('product_emails', ' product_email_id = "'.$product_email_id.'"');
        return $result;

    }
    // To delete product email id by product id
     public function product_email_ID_delete_by_product_id($product_id)
     {
        $result = common_delete_values('product_emails', ' product_id = "'.$product_id.'"');
        return $result;
     }
      // To check product item  unique
    public function product_item_unique($product_item, $product)
    {
       $result = common_select_values('product_item_id, product_id,  industry_id, product_item, status', 'product_items', ' status !=2 AND product_item = "'.$product_item.'" AND product_id = "'.$product.'"', 'row');
        return $result; 
    }
    // To save product item details
    public function product_item_save($insert_columns, $table_name, $insert_values)
    {
        $result = common_insert_values($insert_columns, $table_name, $insert_values);
        return $result;
    }
    // To list product item
    public function product_item_list()
    {
        $result = common_select_values('pi.*, (select product_name from products where product_id = pi.product_id) as product_name, (select industry_name from industries where industry_id = pi.industry_id) as industry_name', 'product_items pi', ' pi.status != 2', 'result');
        return $result; 
    }
    // To change product item status changes
    public function product_item_status_change($data)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "status = '".trim($data['status'])."',  modified_on = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."'";
            $condition = ' product_item_id = "'.trim($data['product_item_id']).'"';
            $result = common_update_values($columns, 'product_items', $condition);
        }
        else
        {
            $result = false;
        }
       return $result;
    }
    // To get product item by id
    public function product_item_by_id($prd_item_id)
    {
        $result = common_select_values('pi.*, (select product_name from products where product_id = pi.product_id) as product_name, (select     industry_name from industries where industry_id = pi.industry_id) as    industry_name', 'product_items pi', ' pi.status != 2 AND product_item_id= "'.$prd_item_id.'"', 'row');
        return $result;   
    }
    // To update product item details
    public function product_item_update($data, $product_item_id)
    {
       $this->db->where('product_item_id', $product_item_id);
       $result =  $this->db->update('product_items', $data);
       return true;
    }



    public function get_product_costing_category_list()
    {
        $result = $this->db->query("CALL get_product_costing_category_list()")->result_array();
        save_query_in_log();
        return $result;
    }     
    public function get_product_costing_type_by_pccid($pccid)
    {
        $result = $this->db->query("CALL get_product_costing_type_by_pccid('".$pccid."')")->result_array();
        save_query_in_log();
        return $result;
    } 
    public function create_product_costing_product_mapping($data)
    {
        $result = $this->db->query("CALL create_product_costing_product_mapping('".$data['product_id']."','".$data['product_costing_category_id']."','".$data['product_costing_type_id']."')");
        save_query_in_log();
        return $result;
    }    
    public function get_product_costing_product_mapping_by_pid_pccid($pid,$pccid)
    {
        $result = $this->db->query("CALL get_product_costing_product_mapping_by_pid_pccid('".$pid."','".$pccid."')")->row();
        save_query_in_log();
        return $result;
    } 
    public function delete_product_costing_product_mapping_by_pid($pid)
    {
        $result = $this->db->query("CALL delete_product_costing_product_mapping_by_pid('".$pid."')");
        save_query_in_log();
        return $result;
    }     
    public function get_product_costing_product_mapping_by_pid($pid)
    {
        $result = $this->db->query("CALL get_product_costing_product_mapping_by_pid('".$pid."')")->result_array();
        save_query_in_log();
        return $result;
    }     
    public function get_product_costing_stage_by_piid($piid)
    {
        $result = $this->db->query("CALL get_product_costing_stage_by_piid('".$piid."')")->result_array();
        save_query_in_log();
        return $result;
    }     
    public function get_product_unit()
    {
        $result = $this->db->query("CALL get_product_unit()")->result_array();
        save_query_in_log();
        return $result;
    }    
    public function get_product_item_by_id($piid)
    {
        $result = $this->db->query("CALL get_product_item_by_id('".$piid."')")->row();
        save_query_in_log();
        return $result;
    }   
    public function get_product_costing_stage_by_prod_item_id_stage_no($piid,$sno)
    {
        $result = $this->db->query("CALL get_product_costing_stage_by_prod_item_id_stage_no('".$piid."','".$sno."')")->row();
        save_query_in_log();
        return $result;
    }  
    public function create_product_costing_stage($data)
    {
        $result = $this->db->query("CALL create_product_costing_stage('".$data['product_item_id']."','".$data['stage_no']."','".$data['stage_name']."','".$data['unit_value']."','".$data['sub_stage']."','".$data['in_kg']."','".$data['in_price']."','".$data['product_unit_id']."','".$data['data_status']."','".$data['created_on']."','".$data['created_by']."')");
        save_query_in_log();
        return $result;
    }  
    public function update_product_costing_stage($data,$pcsid)
    {
        $result = $this->db->query("CALL update_product_costing_stage('".$data['product_item_id']."','".$data['stage_no']."','".$data['stage_name']."','".$data['unit_value']."','".$data['sub_stage']."','".$data['in_kg']."','".$data['in_price']."','".$data['product_unit_id']."','".$data['data_status']."','".$data['modified_on']."','".$data['modified_by']."','".$pcsid."')");
        save_query_in_log();
        return $result;
    }  
}

?>