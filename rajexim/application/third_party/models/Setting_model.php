<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all common settings detabase functions
    Date    : 04-10-2018 
****************************************************************/
class Setting_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta'); 
    }
 /* ************************************************************************************
                        Purpose : To handle General Setting Functions
            **********************************************************************/

// To update the general settings details
public function  general_setting_update($gen_settings, $id)
{

    

    $columns = '';
    $condition = '';
    if($gen_settings != '' && $id != '')
    {
        $columns = "product_logo = '".trim($gen_settings['product_logo'])."',  favicon = '".trim($gen_settings['favicon'])."',  product_title = '".trim($gen_settings['product_title'])."', contact_person_name = '".trim($gen_settings['contact_person_name'])."', contact_person_email_id = '".trim($gen_settings['contact_person_email_id'])."', website =  '".trim($gen_settings['website'])."',  address ='".trim($gen_settings['address'])."',  country = '".trim($gen_settings['country'])."', state = '".trim($gen_settings['state'])."', city = '".trim($gen_settings['city'])."', pincode = '".trim($gen_settings['pincode'])."', sgst = '".trim($gen_settings['sgst'])."', cgst = '".trim($gen_settings['cgst'])."', date_format = '".trim($gen_settings['date_format'])."', gst_no = '".trim($gen_settings['gst_no'])."', cin_no = '".trim($gen_settings['cin_no'])."'";

        $condition = ' general_setting_id = "'.$id.'"';
        $result = common_update_values($columns, 'general_settings', $condition);

    }
    else
    {
        $result = false;
    }
   return $result;
}

/* ************************************************************************************
                        Purpose : To handle Industry Functions
            **********************************************************************/
    // To list industry details
    public function industry_list()                 
    {
        $result = common_select_values('industry_id, industry_name, status', 'industries', ' status !=2', 'result');
        return $result;
    }
    // To save industry details
    public function industry_save($insert_columns, $table_name,  $insert_values)
    {
        $result = common_insert_values($insert_columns, $table_name, $insert_values);
        return $result;

    }
    // To change industry status change
    public function industry_status_change($data)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "status = '".trim($data['status'])."',  modified_on = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."'";
            $condition = ' industry_id = "'.trim($data['industry_id']).'"';
            $result = common_update_values($columns, 'industries', $condition);

        }
        else
        {
            $result = false;
        }
       return $result;
    }
    // To get industry by id
    public function industry_by_id($industry_id)
    {
        $result = common_select_values('industry_id, industry_name, status', 'industries', ' status !=2 AND industry_id = "'.$industry_id.'"', 'row');
        return $result;
    }
    // To check industry unique
    public function industry_unique($industry_name)
    {
       $result = common_select_values('industry_id, industry_name, status', 'industries', ' status !=2 AND industry_name = "'.$industry_name.'"', 'row');
        return $result; 
    }
    // To update industry details
    public function industry_update($data)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "industry_name = '".trim($data['industry_name'])."',  modified_by = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."'";
            $condition = ' industry_id = "'.trim($data['industry_id']).'"';
            $result = common_update_values($columns, 'industries', $condition);
        }
        else
        {
            $result = false;
        }
       return $result;
    }
    // To check industry id in proudct
    public  function industry_in_product($industry_id)
    {
      $result = common_select_values('industry_id', 'products', ' status !=2 AND industry_id = "'.$industry_id.'"', 'row');
        return $result; 
    }
    /* ************************************************************************************
                        Purpose : To handle Email Settings Functions
            **********************************************************************/
    // To list email details
    public function email_list()                 
    {
        $result = common_select_values('e.email_detail_id, e.email_ID, e.from_name, e.signature, e.cc, e.status, e.password, e.smtp_host, (SELECT GROUP_CONCAT(email_ID) FROM email_details WHERE FIND_IN_SET(email_detail_id, e.cc)) as cc_name', 'email_details e', ' e.status !=2', 'result');
        return $result;
    }
    // To change email status
    public function email_status_change($data)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "status = '".trim($data['status'])."',  modified_on = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."'";
            $condition = ' email_detail_id = "'.trim($data['email_detail_id']).'"';
            $result = common_update_values($columns, 'email_details', $condition);

        }
        else
        {
            $result = false;
        }
       return $result;
    }
    // To save email details
    public function email_save($insert_columns, $table_name,  $insert_values)
    {
        $result = common_insert_values($insert_columns, $table_name, $insert_values);
        return $result;
    }
    // To check email ID unique
    public function email_ID_unique($email_ID)
    {
       $result = common_select_values('email_detail_id, email_ID, from_name, signature, cc, status', 'email_details', ' status !=2 AND email_ID = "'.$email_ID.'"', 'row');
        return $result; 
    }
    // To get email ID by id
    public function email_ID_by_id($email_ID)
    {
        $result = common_select_values('email_detail_id, email_ID, from_name, signature, cc, status, password, smtp_host', 'email_details', ' status !=2 AND email_detail_id = "'.$email_ID.'"', 'row');
        return $result;
    }
    // To update email details
    public function email_update($data)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "  email_ID = '".trim($data['email_ID'])."',  from_name = '".trim($data['from_name'])."', signature = '".trim($data['signature'])."', cc = '".trim($data['cc'])."', modified_by = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."', password = '".trim($data['password'])."', smtp_host = '".trim($data['smtp_host'])."'";
            $condition = ' email_detail_id = "'.trim($data['email_detail_id']).'"';
            $result = common_update_values($columns, 'email_details', $condition);
        }
        else
        {
            $result = false;
        }
       return $result;

    }
    // To get smtp host list
    public function smtp_host_list()
    {
        $result = common_select_values('*', 'smtp_host', ' status =0', 'result_array');
        return $result;
    }


    /**********************************************************************************************************
                            Purpose : To handle Email Configuration Function
    *****************************************************************************************/
// To update email configuration details
public function email_configuration_update($data, $id)
{
    if($query = $this->db->query("call email_configuration_update(
    '".trim($data['smtp_host_name'])."',   
    '".trim($data['smtp_user_name'])."',
    '".trim($data['smtp_password'])."',
    '".trim($data['from_mail'])."',
    '".trim($id)."'
    )"))
       {  return true; }else{ return false; }
}
/**********************************************************************************************************
                            Purpose : To handle SMS Configuration Function
    *****************************************************************************************/
// To update SMS configuration details
public function sms_configuration_update($data, $id)
{
    if($query = $this->db->query("call sms_configuration_update(
    '".trim($data['sms_sender_id'])."',   
    '".trim($data['sms_auth_key'])."',
    '".trim($id)."'
    )"))
       {  return true; }else{ return false; }
}
/**********************************************************************************************************
                            Purpose : To handle Email Template Function
    *****************************************************************************************/
// To list email templates
public function email_template_list()
{
    
    $query  = $this->db->query("call email_template_list()");
    $result = $query->result();
   
    return $result;
}

// To update email template status
public function email_template_change_status($data, $id)
{
    if($query = $this->db->query("call email_template_change_status(
    '".trim($data['status'])."',   
    '".trim($data['modified_on'])."',
    '".trim($id)."'
    )"))
       {  return true; }else{ return false; }
}

// To get email templatey id
public function email_template_by_id($id)
{
    
    $query  = $this->db->query("call email_template_by_id('".$id."')");
    $result = $query->row();
   
    return $result;
}

// To update email template by
public function email_template_update($data, $id)
{
    if($query = $this->db->query("call email_template_update(
    '".trim($data['email_name'])."',   
    '".trim($data['email_subject'])."',
    '".trim($data['email_content'])."',
    '".trim($data['modified_by'])."',
    '".trim($data['modified_on'])."',
    '".trim($id)."'
    )"))
       {  return true; }else{ return false; }
}

/**********************************************************************************************************
                            Purpose : To handle SMS Template Function
    *****************************************************************************************/
// To list sms templates
public function sms_template_list()
{
    
    $query  = $this->db->query("call sms_template_list()");
    $result = $query->result();
   
    return $result;
}

// To get sms templatey id
public function sms_template_by_id($id)
{
    
    $query  = $this->db->query("call sms_template_by_id('".$id."')");
    $result = $query->row();
   
    return $result;
}

// To update sms template by
public function sms_template_update($data, $id)
{
    if($query = $this->db->query("call sms_template_update(
    '".trim($data['sms_template_name'])."',   
    '".trim($data['sms_content'])."',
    '".trim($data['modified_on'])."',
    '".trim($id)."'
    )"))
       {  return true; }else{ return false; }
}

// To update sms template status
public function sms_template_change_status($data, $id)
{
    if($query = $this->db->query("call sms_template_change_status(
    '".trim($data['status'])."',   
    '".trim($data['modified_on'])."',
    '".trim($id)."'
    )"))
       {  return true; }else{ return false; }
}
    
}
?>