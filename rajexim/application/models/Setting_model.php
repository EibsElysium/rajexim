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
        $columns = "product_logo = '".trim($gen_settings['product_logo'])."',  favicon = '".trim($gen_settings['favicon'])."',  product_title = '".trim($gen_settings['product_title'])."', contact_person_name = '".trim($gen_settings['contact_person_name'])."', contact_person_email_id = '".trim($gen_settings['contact_person_email_id'])."', website =  '".trim($gen_settings['website'])."',  address ='".trim($gen_settings['address'])."',  country = '".trim($gen_settings['country'])."', state = '".trim($gen_settings['state'])."', city = '".trim($gen_settings['city'])."', pincode = '".trim($gen_settings['pincode'])."', sgst = '".trim($gen_settings['sgst'])."', cgst = '".trim($gen_settings['cgst'])."', date_format = '".trim($gen_settings['date_format'])."', gst_no = '".trim($gen_settings['gst_no'])."', cin_no = '".trim($gen_settings['cin_no'])."', lead_replies_max = '".trim($gen_settings['max_reply'])."', lead_unattend_minimum_duration = '".trim($gen_settings['min_duration'])."' , smtp_host_name = '".trim($gen_settings['smtp_host_name'])."' , smtp_user_name = '".trim($gen_settings['smtp_user_name'])."', smtp_password = '".trim($gen_settings['smtp_password'])."'";

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
        $result = common_select_values('e.email_detail_id, e.email_ID, e.from_name, e.signature, e.cc, e.status, e.password, e.smtp_host, (SELECT GROUP_CONCAT(email_ID) FROM email_details WHERE FIND_IN_SET(email_detail_id, e.cc)) as cc_name, (SELECT GROUP_CONCAT(email_ID) FROM email_details WHERE FIND_IN_SET(email_detail_id, e.bcc)) as bcc_name', 'email_details e', ' e.status !=2', 'result');
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
        $result = common_select_values('email_detail_id, email_ID, from_name, signature, cc, bcc, status, password, smtp_host', 'email_details', ' status !=2 AND email_detail_id = "'.$email_ID.'"', 'row');
        return $result;
    }
    // To update email details
    public function email_update($data)
    {
        $columns = '';
        $condition = '';
        if($data != '')
        {
            $columns = "  email_ID = '".trim($data['email_ID'])."',  from_name = '".trim($data['from_name'])."', signature = '".trim($data['signature'])."', cc = '".trim($data['cc'])."', bcc = '".trim($data['bcc'])."', modified_by = '".trim($data['modified_on'])."',  modified_by = '".trim($data['modified_by'])."', password = '".trim($data['password'])."', smtp_host = '".trim($data['smtp_host'])."'";
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
public function get_all_email_domain()
{
    $query = $this->db->query('CALL get_all_email_domain()')->result_array();
    return $query;
}
public function chk_email_domain_already_exist($value)
{
    $query = $this->db->query("CALL chk_email_domain_already_exist('".$value."')")->row();
    return $query;
}
public function add_email_domain($email_domain,$c_by,$c_on)
{
    $query = $this->db->query("CALL add_email_domain('".$email_domain."','".$c_by."','".$c_on."')");
    return 1;
}
public function email_domain_change_status($st, $id)
{
    $query = $this->db->query("CALL email_domain_change_status('".$st."','".$id."')");
    return 1;
}
public function get_email_domain_by_id($id)
{
    $query = $this->db->query("CALL get_email_domain_by_id('".$id."')")->row();
    return $query;
}
public function update_email_domain($ed_id,$email_domain,$m_by,$m_on)
{
    $query = $this->db->query("CALL update_email_domain('".$ed_id."','".$email_domain."','".$m_by."','".$m_on."')");
    return 1;
}
public function delete_email_domain($ed_id)
{
    $query = $this->db->query("CALL delete_email_domain('".$ed_id."')");
    return 1;
}
public function get_all_block_email_domain()
{
    $query = $this->db->query('SELECT bed.* FROM block_email_or_domain bed WHERE bed.status != 2')->result_array();
    return $query;
}
public function chk_block_email_domain_unique($val)
{
    $query = $this->db->query("SELECT bed.* FROM block_email_or_domain bed WHERE bed.status != 2 AND bed.value = '$val'")->row();
    return $query;
}
public function add_block_email_domain($email_domain,$flag,$c_by,$c_on)
{
    $query = $this->db->query("INSERT INTO `block_email_or_domain`(`email_or_domain`, `value`, `created_by`, `created_on`) VALUES ('$flag','$email_domain','$c_by','$c_on')");
    return 1;
}
public function block_email_domain_change_status($id,$data)
{
    $query = $this->db->query("UPDATE block_email_or_domain bed SET bed.status = '$data' WHERE bed.ed_id = '$id'");
    return 1;
}
public function get_block_email_info_by_id($id)
{
    $query = $this->db->query("SELECT bed.* FROM block_email_or_domain bed WHERE bed.ed_id = '$id'")->row();
    return $query;
} 
public function update_block_email_domain($id,$value,$flag,$m_by,$m_on)
{
    $query = $this->db->query("UPDATE `block_email_or_domain` SET `email_or_domain`='$flag',`value`='$value',`modified_by`='$m_by',`modified_on`='$m_on' WHERE `ed_id` = '$id'");
    return 1;
}
public function delete_block_email_domain($ed_id)
{
    $query = $this->db->query("UPDATE `block_email_or_domain` SET `status` = 2 WHERE `ed_id` = '$ed_id'");
    return 1;
}
public function chk_email_domain_is_cannot_blockable($val)
{
    $query = $this->db->query("SELECT ed.* FROM email_domain ed WHERE ed.email_domain = '$val' AND ed.status != 2")->row();
    return$query;   
}
public function get_all_prodcutunit()
{   
    $query = $this->db->query("CALL get_all_prodcutunit()")->result_array();
    return $query;
}
public function chk_pro_unit_exist_or_not($val)
{
    $query = $this->db->query("CALL chk_pro_unit_exist_or_not('".$val."')")->row();
    return $query;   
}
public function create_product_unit($pro_unit,$c_by,$c_on)
{
    $query = $this->db->query("CALL create_product_unit('".$pro_unit."','".$c_by."','".$c_on."')");
    return 1;   
}
public function prodcut_unit_change_status($st, $id)
{
    $query = $this->db->query("UPDATE product_unit pu SET pu.status = '$st' WHERE pu.product_unit_id = '$id'");
    return 1;
}
public function get_product_unit_by_id($val)
{
    $query = $this->db->query("SELECT pu.* FROM product_unit pu WHERE pu.product_unit_id = '$val'")->row();
    return $query;   
}
public function update_product_unit($pro_unit_id,$pro_unit, $m_by, $m_on)
{
    $query = $this->db->query("CALL update_product_unit('".$pro_unit_id."','".$pro_unit."','".$m_by."','".$m_on."')");
    return 1;
}
public function product_unit_delete($pro_id)
{
    $query = $this->db->query("CALL product_unit_delete('".$pro_id."')");
    return 1;   
}
public function get_email_names_by_findinset($email_ids)
{
    $query = $this->db->query("SELECT GROUP_CONCAT(ed.email_ID) AS mail_name FROM email_details ed WHERE FIND_IN_SET(ed.email_detail_id, '$email_ids') ")->row();
    return $query;   
}
public function quarter_year_list()
{
    $query = $this->db->query("SELECT qy.* FROM quarter_year qy WHERE qy.status != 2")->result();
    return $query;   
}
public function quarter_year_by_id($q_id)
{
    $query = $this->db->query("SELECT qy.* FROM quarter_year qy WHERE qy.quarter_id = '$q_id'")->row();
    return $query;   
}
public function chk_unnique_label($q_label)
{
    $query = $this->db->query("SELECT qy.* FROM quarter_year qy WHERE qy.quarter_label = '$q_label' AND qy.status != 2")->row_array();
    return $query;     
}
public function update_quarter_year($q_id,$label,$s_date,$e_date,$m_by,$m_on)
{
    $query = $this->db->query("UPDATE `quarter_year` SET `quarter_label`='$label',`start_month_date`='$s_date',`end_month_date`='$e_date',`modified_on`='$m_on',`modified_by`='$m_by' WHERE `quarter_id`='$q_id'");
    return 1;   
}
public function get_all_vv()
{
    $query = $this->db->query("CALL get_all_vv()")->result_array();
    return $query;
}
public function vv_change_status($data, $id)
{
    $query = $this->db->query("CALL vv_change_status('".$data['status']."','".$data['modified_by']."','".$data['modified_on']."','".$id."')");
    return 1;
}
public function get_vv_by_id($vv_id)
{
    $query = $this->db->query("CALL get_vv_by_id('".$vv_id."')")->row();
    return $query;
}
public function chk_unique_from_amnt($val)
{
    $query = $this->db->query("SELECT vv.* FROM value_variant vv WHERE vv.vv_from_amount = '$val'")->row();
    return $query;   
}
public function chk_unique_to_amnt($val)
{
    $query = $this->db->query("SELECT vv.* FROM value_variant vv WHERE vv.vv_to_amount = '$val'")->row();
    return $query;   
}
public function update_vv_info($vv_id,$from,$to,$color,$m_by,$m_on)
{
    $query = $this->db->query("CALL update_vv_info('".$vv_id."','".$from."','".$to."','".$color."','".$m_by."','".$m_on."')");
    return 1;  
}
public function get_all_role_name()
{
    $query = $this->db->query("SELECT r.* FROM roles r WHERE r.status = 0")->result();
    return $query; 
}


public function get_all_folder_access()
{
    $query = $this->db->query("SELECT f.*,(SELECT GROUP_CONCAT(r.role_name) FROM folders_control fc, roles r WHERE fc.f_id = f.f_id AND fc.role_id = r.role_id) AS allocated_roles FROM folders f WHERE f.status != 2 ")->result();
    return $query;   
}
public function chk_unique_folder($val)
{
    $query = $this->db->query("SELECT f.* FROM folders f WHERE f.folder_name = '$val'")->row();
    return $query;   
}
public function add_f_acc($folder,$c_by,$c_on)
{
    $query = $this->db->query("INSERT INTO `folders`(`folder_name`, `created_on`, `created_by`) VALUES ('$folder','$c_on','$c_by')");
    $insert_id = $this->db->insert_id();
    return $insert_id;   
}
public function add_f_acc_info($f_acc_id,$role_id)
{
    $c_by = $_SESSION['admindata']['user_id'];
    $c_on = date('Y-m-d H:i:s');
    $query = $this->db->query("INSERT INTO `folders_control`(`f_id`, `role_id`, `created_by`, `created_on`) VALUES ('$f_acc_id','$role_id','$c_by', '$c_on')");
   
    return 1;  
}
public function get_fa_by_id($id)
{
   $query = $this->db->query("SELECT f.* FROM folders f WHERE f.f_id = '$id'")->row();
    return $query;   
}
public function get_fai_by_id($id)
{
    $query = $this->db->query("SELECT fc.role_id FROM folders_control fc WHERE fc.f_id = '$id'")->result_array();
    return $query;  
}
public function update_f_acc($f_id,$folder,$m_by,$m_on)
{
    $query = $this->db->query("UPDATE `folders` SET `folder_name`='$folder',`modified_on`='$m_on',`modified_by`='$m_by' WHERE `f_id`= '$f_id'");
    return 1;  
}
public function del_f_acc_info_by_fa_id($f_acc_id)
{
    $query = $this->db->query("DELETE FROM `folders_control` WHERE `f_id` = '$f_acc_id'");
    return 1; 
}
public function del_f_acc($f_acc_id)
{
    $query = $this->db->query("DELETE FROM `folders` WHERE `f_id` = '$f_acc_id'");
    return 1; 
}
public function get_user_folders($role_id){
    $query = $this->db->query("SELECT f.* FROM folders f, folders_control fc WHERE fc.f_id = f.f_id AND fc.role_id = '$role_id'")->result();
    return $query;
}
public function get_user_all_folders(){
    $query = $this->db->query("SELECT f.* FROM folders f")->result();
    return $query;
}
public function delete_all_buyer_order_task($from,$to)
{
    
    $query = $this->db->query("DELETE FROM task where task_end_date < '".$to."' AND task_end_date > '".$from."'");
    $query = $this->db->query("DELETE FROM lead_task where lead_task_end_date < '".$to."' AND lead_task_end_date > '".$from."'");
    $query = $this->db->query("DELETE FROM buyer_order_task where buyer_order_task_end_date < '".$to."' AND buyer_order_task_end_date > '".$from."'");
    return 1;
}
}
?>