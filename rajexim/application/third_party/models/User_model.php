<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all user detabase functions
    Date    : 04-02-2020
****************************************************************/
class User_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta'); 
    }
    // To list role 
    public function role_list()
    {
        $result = common_select_values('role_id, role_name, status', 'roles', ' status !=2', 'result');
        return $result;
    }
    // To check username unique
    public function username_unique($username)
    {
       $result = common_select_values('*', 'users', ' status !=2 AND username = "'.$username.'"', 'row');
        return $result; 
    }
    // To get next auto id for user id
    public function user_next_auto_id()
    {
        $result = common_select_values('AUTO_INCREMENT', 'INFORMATION_SCHEMA.TABLES', ' TABLE_SCHEMA = database() AND TABLE_NAME = "users"', 'row');
        return $result; 
    }
    // To save user details
    public function user_save($insert_columns, $table_name, $insert_values)
    {
        $result = common_insert_values($insert_columns, $table_name, $insert_values);
        return $result;
    }
    // To save user product details
    public  function user_product_save($insert_columns, $table_name, $insert_values)
    {
        $result = common_insert_values($insert_columns, $table_name, $insert_values);
        return $result;
    }
    // To save user product details
    public  function user_product_email_save($insert_columns, $table_name, $insert_values)
    {
        $result = common_insert_values($insert_columns, $table_name, $insert_values);
        return $result;
    }
    // To list user list details
    public function user_list()                 
    {
        $sql = $this->db->query("SELECT u.* , r.role_name, GROUP_CONCAT(p.product_name) as user_product FROM users u
            LEFT JOIN roles r ON r.role_id = u.role_id
            LEFT JOIN user_products up ON up.user_id = u.user_id
            LEFT JOIN products p ON p.product_id = up.product_id
        WHERE u.status !=2 GROUP BY u.user_id"); 
        return $sql->result(); 
    }
     // To change user status change
    public function user_status_change($data)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "status = '".trim($data['status'])."',  modified_on = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."'";
            $condition = ' user_id = "'.trim($data['user_id']).'"';
            $result = common_update_values($columns, 'users', $condition);
        }
        else
        {
            $result = false;
        }
       return $result;
    }
     // To get user by id
    public function user_by_id($user_id)
    {
        $result = common_select_values('u.user_id, u.name, u.dob, u.gender, u.address, u.contact_no, u.email_id, u.pincode, u.profile_image, u.signature, u.role_id, u.username, u.password, (SELECT GROUP_CONCAT(role_name) FROM roles WHERE FIND_IN_SET(role_id, u.role_id)) as role_name, u.allow_lead, u.show_menu, u.show_leads, u.product_users, (SELECT GROUP_CONCAT(name) FROM users WHERE FIND_IN_SET(user_id, u.product_users)) as product_users_name', 'users u', ' u.status !=2 AND u.user_id = "'.$user_id.'"', 'row');
        return $result;
    }
    // To get user email ids
    public  function user_email_by_user_id($user_id)
    {
        $result = common_select_values('u.email_detail_id, u.product_id, (SELECT GROUP_CONCAT(email_ID) FROM email_details WHERE FIND_IN_SET(email_detail_id, u.email_detail_id)) as email_name', 'user_emails u', ' u.status !=2 AND u.user_id = "'.$user_id.'" ORDER BY u.product_id ASC', 'result');
        return $result;
    }
    // To get user product ids
    public  function user_product_by_user_id($user_id)
    {
        $result = common_select_values('u.user_product_id, u.product_id, u.user_id, (SELECT GROUP_CONCAT(product_name) FROM products WHERE FIND_IN_SET(product_id, u.product_id)) as product_name', 'user_products u', ' u.status !=2 AND u.user_id = "'.$user_id.'" ORDER BY u.product_id ASC', 'result');
        return $result;
    }
    // To update user details
    public function user_update($columns, $table_name, $condition)
    {
        if($columns != '' && $table_name != '' && $condition != '')
        {
            $result = common_update_values($columns, $table_name, $condition);
        }
        else
        {
            $result = false;
        }
       return $result;
    }  
    // To delete user prodct id
    public  function delete_user_product_id($user_prodct_id)
    {
        $result = common_delete_values('user_products', ' user_product_id = "'.$user_prodct_id.'"');
        return $result;
    } 
     // To delete user prodct email id
    public  function delete_user_product_email_id($user_product_id)
    {
        $result = common_delete_values('user_emails', '  product_id = "'.$user_product_id.'"');
        return $result;
    }
    // To get user product id 
    public  function user_product_id_exists_by_product_id($user_id, $product_id)
    {
        $result = common_select_values('*', 'user_products ', ' user_id = "'.$user_id.'" AND product_id = "'.$product_id.'"', 'row');
        return $result;
       
    }
    // To delete product user by id
    public  function user_product_id_delete_by_id($user_product_id)
    {
       $result = common_delete_values('user_products', '  user_product_id = "'.$user_product_id.'"');
        return $result;
    }
    // To check user email by 
    public function user_email_id_exists_by_email_id($user_id, $prd_id, $email_detail_id)
    {
        $result = common_select_values('*', 'user_emails ', ' user_id = "'.$user_id.'" AND product_id = "'.$prd_id.'" AND email_detail_id = "'.$email_detail_id.'"', 'row');
        return $result;
    }
    // To delete email id 
    public function user_email_id_delete_by_id($user_email_detail_id)
    {
        $result = common_delete_values('user_emails', '  user_email_id = "'.$user_email_detail_id.'"');
        return $result;
    }
    // To check user in lead
    public function user_ID_in_lead($user_id)
    {
        $result = common_select_values('*', 'leads ', ' lead_assigned_to = "'.$user_id.'" AND status = 0', 'result');
        return $result;
    }

    // To delete user products
    public function delete_user_products($user_id)
    {
        $result = common_delete_values('user_products', '  user_id = "'.$user_id.'"');
        return $result;
    }
    // To delete user products
    public function delete_user_emails($user_id)
    {
        $result = common_delete_values('user_emails', '  user_id = "'.$user_id.'"');
        return $result;
    }

    // To get next auto id for product id
    public function product_next_auto_id()
    {
        $result = common_select_values('AUTO_INCREMENT', 'INFORMATION_SCHEMA.TABLES', ' TABLE_SCHEMA = database() AND TABLE_NAME = "products"', 'row');
        return $result; 
    }
    
    // To save product details
    public function product_emails_save($insert_columns, $table_name, $insert_values)
    {
        $result = common_insert_values($insert_columns, $table_name, $insert_values);
        return $result;
    }
   
   
    // To get product emails by product id
    public function product_emails_by_id($product_id)
    {
        $result = common_select_values('p.product_email_id, p.product_id, p.user_id, p.email_detail_id, p.status, (SELECT GROUP_CONCAT(email_ID) FROM email_details WHERE FIND_IN_SET(email_detail_id, p.email_detail_id)) as email_name ', 'product_emails p', ' p.status !=2 AND p.product_id = "'.$product_id.'"', 'result');
        return $result;
    }
    // To get product email id only
    public function product_email_ID_only_by_id($product_id)
    {
        $result = common_select_values('p.email_detail_id', 'product_emails p', ' p.status !=2 AND p.product_id = "'.$product_id.'"', 'result');
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
     // To get product user by product id
    public  function product_users_by_id($product_id)
    {
     $result = common_select_values('DISTINCT u.user_id, (select name from users where find_in_set(user_id, u.user_id)) as user_name, r.role_name', 'user_products u LEFT JOIN users pu ON pu.user_id = u.user_id LEFT JOIN roles r ON r.role_id = pu.role_id', ' FIND_IN_SET(u.product_id, "'.$product_id.'")', 'result');
        return $result;   
    }
     // To check user contact no unique
    public function user_contact_no_unique($contact_no)
    {
       $result = common_select_values('*', 'users', ' status !=2 AND contact_no = "'.$contact_no.'"', 'row');
        return $result; 
    }
}

?>