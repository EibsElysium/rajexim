<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the settings database details
    Date    : 03-02-2020
****************************************************************/
class Login_model extends CI_Model
{
  function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta'); 
    }
 /* ************************************************************************************
                        Purpose : To handle Admin Login Function
            **********************************************************************/

// To get Admin user name and password details
public function admin_login_details($username)
{ 

   $result = common_select_values('user_id, username, password, role_id, status, show_menu', 'users', ' status!=2 AND username = "'.$username.'"', 'row');
   return $result;
}

public function admin_role_details($roleId)
{
    
    $query  = $this->db->query("call admin_role_details('".$roleId."')");
    $result = $query->row();
   
    return $result;
}

// To get date formats details
public function date_format_list(){

    
    $query  = $this->db->query("call date_format_list()");
    $result = $query->result();
   
    return $result;
     
}
// To get country details
public function country_list(){

    
    $query  = $this->db->query("call country_list()");
    $result = $query->result();
   
    return $result;
     
}

// To get state details
public function state_list($countryId){

    
    $query  = $this->db->query("call state_list('".$countryId."')");
    $result = $query->result();
   
    return $result;
}

// To get city details
public function city_list($stateId){

    
    $query  = $this->db->query("call city_list('".$stateId."')");
    $result = $query->result();
   
    return $result;
     
}

// To update the general settings details
public function  general_setting_update($gen_settings, $id)
{

    if($query = $this->db->query("call general_setting_update(
    '".trim($gen_settings['product_logo'])."',   
    '".trim($gen_settings['favicon'])."',
    '".trim($gen_settings['product_title'])."',
    '".trim($gen_settings['contact_person_name'])."',
    '".trim($gen_settings['contact_person_email_id'])."',
    '".trim($gen_settings['website'])."',
    '".trim($gen_settings['address'])."',
    '".trim($gen_settings['country'])."',
    '".trim($gen_settings['state'])."',
    '".trim($gen_settings['city'])."',
    '".trim($gen_settings['pincode'])."',
    '".trim($id)."',
    '".trim($gen_settings['date_format'])."'

    )"))
       {  return true; }else{ return false; }
}
// To check general settings contact email and contact mobile are existing in database table
public function check_general_settings_exists($contact_email, $contact_mobile){
    $query =  $this->db->query("call check_general_settings_exists('".$contact_email."', '".$contact_mobile."')");
    $result = $query->num_rows();
    return $result;
}
// To check the general settings email exist or not
public function check_gen_settings_email_exits($contact_email)
{
    $query =  $this->db->query("call check_gen_settings_email_exits('".$contact_email."')");
    $result= $query->row();
    return $result;
}
// To check the general settings contact mobile exist or not
public function check_gen_settings_mobile_exits($contact_mobile)
{
    $query =  $this->db->query("call check_gen_settings_mobile_exits('".$contact_mobile."')");
    $result= $query->row();
    return $result;
}
        /**********************************************************************************************************
                            Purpose : To handle Payment Settings Database details
                            Date    : 04-Dec-2017 
                        ****************************************************************/
/******************************* // To get payment settings details *********************************************/
public function payment_settings_list(){

    $query = $this->db->query("call payment_settings_list()");
    $result = $query->row();
    return $result;
}
/*******************************  // To update payment_authorize_update *******************************/
public function payment_authorize_update($payment_auth)
{

    if($query = $this->db->query("call payment_authorize_update(
    '".$payment_auth['setting_id']."',   
    '".$payment_auth['merchant_key']."',
    '".$payment_auth['salt_key']."',
    '".$payment_auth['auth_mode']."',
    '".$payment_auth['auth_test_url']."',
    '".$payment_auth['auth_live_url']."',
    '".$payment_auth['auth_email']."',
    '".$payment_auth['auth_status']."',
    '".$payment_auth["modified_by"]."',
    '".$payment_auth['modified_on']."'
    )"))
       {  return true; }else{ return false; }
}
/*******************************  // To update payment_authorize_update *******************************/
public function payment_paypal_update($paypal)
{

    if($query = $this->db->query("call payment_paypal_update(
    '".$paypal['setting_id']."',   
    '".$paypal['paypal_username']."',
    '".$paypal['paypal_password']."',
    '".$paypal['paypal_signature']."',
    '".$paypal['email_id']."',
    '".$paypal['test_url']."',
    '".$paypal['live_url']."',
    '".$paypal['mode']."',
    '".$paypal["modified_by"]."',
    '".$paypal['status']."',
    '".$paypal['modified_on']."'
    )"))
       {  return true; }else{ return false; }
}      
/**********************************************************************************************************
                            Purpose : To handle SMS & Email Settings Database details
                            Date    : 04-Dec-2017 
                        ****************************************************************/
                      
/******************************* // To get SMS Email settings details *********************************************/
public function get_sms_email_settings_details($setting_id){

    $query = $this->db->query("call sms_email_settings_list('".$setting_id."')");
    $result = $query->row();
    return $result;
}
/*******************************  // To update the sms settings details *******************************/
public function sms_settings_update($sms_settings)
{
    if($query = $this->db->query("call sms_settings_update(
    '".$sms_settings['setting_id']."',   
    '".$sms_settings['sms_authentication_key']."',
    '".$sms_settings['sms_sender_id']."',
    '".$sms_settings["modified_by"]."',
    '".$sms_settings['modified_on']."'
    )"))
       {  return true; }else{ return false; }
}
/*******************************  // To update the sms settings details *******************************/
public function email_settings_update($email_settings)
{
    if($query = $this->db->query("call email_settings_update(
    '".$email_settings['setting_id']."',   
    '".$email_settings['smtp_host_name']."',
    '".$email_settings['smtp_user_name']."',
    '".$email_settings['smtp_password']."',
    '".$email_settings["modified_by"]."',
    '".$email_settings['modified_on']."'
    )"))
       {  return true; }else{ return false; }
}

// To update the sms settings details
public function update_email_settings($email_settings)
{
    if($query = $this->db->query("call update_email_settings(
    '".$email_settings['setting_id']."',   
    '".$email_settings['smtp_host_name']."',
    '".$email_settings['smtp_user_name']."',
    '".$email_settings['smtp_password']."',
    '".$email_settings["status"]."',
    '".$email_settings["created_by"]."',
    '".$email_settings["created_on"]."',
    '".$email_settings["modified_by"]."',
    '".$email_settings['modified_on']."'
    )"))
       {  return true; }else{ return false; }
}
/**********************************************************************************************************
                            Purpose : To handle Question Settings Database details
                            Date    : 04-Dec-2017 
                    ****************************************************************/  
  /*****************************************  // To get defalut languages from general setting *************************/
  public function get_default_language()
  {
    $query  = $this->db->query("call get_default_language()");
    $result = $query->row();
    return $result;
  } 
/*****************************************   // To check category exists or not ************************************/
public function check_category($language_id, $category_name)
{

  $query = $this->db->query("call check_category_exists('".$language_id."', '".$category_name."')");
  $result = $query->row();
  return $result;    
}   
/*****************************************   // To check category name exists or not ************************************/
public function check_category_name_exists($cat_id, $category_name)
{
  $query = $this->db->query("call check_category_name_exists('".$cat_id."', '".$category_name."')");
  $result = $query->result();
  return $result;    
}

/*****************************************   // To add category list ************************************/
public function add_category($category)
{

    $query = $this->db->query("call add_category(
    '".$category['language_id']."',   
    '".$category['refer_category_id']."',
    '".$category['category_name']."',
    '".$category["status"]."',
    '".$category["created_by"]."',
    '".$category["created_on"]."',
    '".$category["modified_by"]."',
    '".$category['modified_on']."'
    )");
    $query = $this->db->query('SELECT LAST_INSERT_ID()');
    $row = $query->row_array();
    return $row['LAST_INSERT_ID()'];
       
} 
/*****************************************   // To update category ************************************/
public function category_update($category)
{
    if($query = $this->db->query("call category_update(
      '".$category['category_name']."',
      '".$category["modified_by"]."',
      '".$category['modified_on']."',
      '".$category['category_id']."'
    )")){
     return true; }else{ return false; }

} 
/*****************************************   // To category list  ************************************/
public function get_category_list($category_id)
{
    if($query = $this->db->query("call get_category_list('".$category_id."')"))
    {  $result = $query->result(); return $result; }else{ return 0; }
} 
/*****************************************   // To category list  ************************************/
public function category_active_list($lang)
{
    if($query = $this->db->query("call category_active_list('".$lang."')"))
    {  $result = $query->result(); return $result; }else{ return 0; }
} 
/*****************************************   // To category list  ************************************/
public function category_details_byid($category_id)
{
    if($query = $this->db->query("call category_details_byid('".$category_id."')"))
    {  $result = $query->result(); return $result; }else{ return 0; }
} 
/*****************************************   // To category edit  ************************************/
public function category_by_id_lang($category_id, $lang)
{
    if($query = $this->db->query("call category_by_id_lang('".$category_id."', '".$lang."')"))
    {  $result = $query->row(); return $result; }else{ return 0; }
} 
/*****************************************   // To category edit  ************************************/
public function category_by_id_other_lang($category_id, $lang)
{
    if($query = $this->db->query("call category_by_id_other_lang('".$category_id."', '".$lang."')"))
    {  $result = $query->row(); return $result; }else{ return 0; }
} 
/*****************************************   // To category refer id category ************************************/
public function category_delete_refer_id($category)
{
    if($query = $this->db->query("call category_delete_refer_id(
    '".$category['category_id']."',   
    '".$category["status"]."',
    '".$category["modified_by"]."',
    '".$category['modified_on']."'

  )"))
    {  return true; }else{ return false; }
} 

/*****************************************   // To delete category details ************************************/
public function category_delete($category)
{
    if($query = $this->db->query("call category_delete(
    '".$category['category_id']."',   
    '".$category["status"]."',
    '".$category["modified_by"]."',
    '".$category['modified_on']."'

  )"))
    {  return true; }else{ return false; }
}
/*****************************************   // To check category for language ************************************/
public function category_lang_details($language_id, $referid)
{
  $query = $this->db->query("call category_lang_details('".$language_id."', '".$referid."')");
  $result = $query->row();

  return $result;    
} 
/******************************  //  Starts Subcategory Function  ****************************************/
public function get_subcategory_list($language_id)
{
    if($query = $this->db->query("call get_subcategory_list(
    '".$language_id."')"))
    {   $result = $query->result(); return $result; }else{ return false; }
}
/******************************  //  To check subcategory exists already  ****************************************/
public function check_subcategory($language_id, $category_id, $subcategory_name)
{
  $query = $this->db->query("call check_subcategory_exists('".$language_id."', '".$category_id."', '".$subcategory_name."')");
  $result = $query->row();
  return $result;    
} 
/******************************  //  To add subcategory details  ****************************************/
public function subcategory_add($subcategory)
{
    $query = $this->db->query("call subcategory_add(
    '".$subcategory['category_id']."',   
    '".$subcategory['language_id']."',
    '".$subcategory['refer_subcategory_id']."',
    '".$subcategory['subcategory_name']."',
    '".$subcategory["status"]."',
    '".$subcategory["created_by"]."',
    '".$subcategory["created_on"]."',
    '".$subcategory["modified_by"]."',
    '".$subcategory['modified_on']."'
    )");
    $query = $this->db->query('SELECT LAST_INSERT_ID()');
    $row = $query->row_array();
    return $row['LAST_INSERT_ID()'];
       
} 
/*****************************************   // To sub category by id  ************************************/
public function subcategory_details_byid($subcategory_id)
{
    if($query = $this->db->query("call subcategory_details_byid('".$subcategory_id."')"))
    {  $result = $query->result(); return $result; }else{ return 0; }
}
/*****************************************   // To subcategory refer id detail ************************************/
public function get_subcategory_by_refer_id($subcategory_id)
{
    $query = $this->db->query("call get_subcategory_by_refer_id('".$subcategory_id."')");
    $result = $query->result(); return $result;
} 
/*****************************************   // To subcategory refer id details for edit ************************************/
public function subcategory_by_id_lang($subcategory_id, $lang)
{
    $query = $this->db->query("call subcategory_by_id_lang('".$subcategory_id."', '".$lang."')");
    $result = $query->row(); return $result;
}
/*****************************************   // To subcategory refer id details for edit ************************************/
public function subcategory_by_id_other_lang($subcategory_id, $lang)
{
    $query = $this->db->query("call subcategory_by_id_other_lang('".$subcategory_id."', '".$lang."')");
    $result = $query->row(); return $result;
}
/*****************************************   // To update subcategory refer id detail ************************************/
public function subcategory_update($subcategory_id)
{
     $query = $this->db->query("call subcategory_update(
      '".$subcategory_id['subcategory_id']."',
      '".$subcategory_id['subcategory_name']."',
      '".$subcategory_id["modified_by"]."',
      '".$subcategory_id['modified_on']."',
      '".$subcategory_id['category_id']."'
      
    )");
      $query = $this->db->query('SELECT LAST_INSERT_ID()');
    $row = $query->row_array();
    return $row['LAST_INSERT_ID()'];
} 
/*****************************************   // To update subcategory inactive status ************************************/
public function subcategory_inactive_status($subcategory)
{

   if( $query = $this->db->query("call subcategory_inactive_status(
      '".$subcategory['status']."',
      '".$subcategory["modified_by"]."',
      '".$subcategory['modified_on']."',
      '".$subcategory['subcategory_id']."'
    )")){ return true; }else{ return false; }
} 
/*****************************************   // To update subcategory inactive status ************************************/
public function subcategory_by_refer_id_delete($subcategory)
{

   if( $query = $this->db->query("call subcategory_by_refer_id_delete(
      '".$subcategory['status']."',
      '".$subcategory["modified_by"]."',
      '".$subcategory['modified_on']."',
      '".$subcategory['subcategory_id']."'
    )")){ return true; }else{ return false; }
}
/*****************************************   // To update subcategory delete status ************************************/
public function subcategory_delete_all($subcategory)
{

   if( $query = $this->db->query("call subcategory_delete_all(
      '".$subcategory['status']."',
      '".$subcategory["modified_by"]."',
      '".$subcategory['modified_on']."',
      '".$subcategory['subcategory_id']."'
    )")){ return true; }else{ return false; }
} 
/*****************************************   // To subcategory on category ************************************/
public function subcategory_category_lang_by_id($category)
{

    $query = $this->db->query("call subcategory_category_lang_by_id('".$category."')");
    $result = $query->row(); return $result;
} 
/*****************************************   // To subcategory on category to check ************************************/
public function  check_category_by_id($category)
{
    $query = $this->db->query("call check_category_by_id('".$category."')");
    $result = $query->row(); return $result;
} 
/*****************************************   // To subcategory on subcategory name to check ************************************/
public function  check_subcategory_by_name($subcategory)
{
    $query = $this->db->query("call subcategory_by_name('".$subcategory."')");
    $result = $query->row(); return $result;
}
/******************************************************************************************/
                  // Level Settings Starts
/*******************************************************************************************/
public function check_level_exists($language_id, $level)
{
  $query = $this->db->query("call check_level_exists('".$language_id."', '".$level."')");
  $result = $query->row();
  return $result;    
} 
/******************************  //  To add level  details  ****************************************/
public function level_add($level)
{

    $query = $this->db->query("call level_add(
    '".$level['language_id']."',   
    '".$level['refer_qtn_level_id']."',
    '".$level['question_level']."',
    '".$level['level_number']."',
    '".$level['time_to_solve']."',
    '".$level['score_suggestion']."',
    '".$level["status"]."',
    '".$level["created_by"]."',
    '".$level["created_on"]."',
    '".$level["modified_by"]."',
    '".$level['modified_on']."'
    )");
    $query = $this->db->query('SELECT LAST_INSERT_ID()');
    $row = $query->row_array();
    return $row['LAST_INSERT_ID()'];
       
}
/******************************  //  To list levels  ****************************************/
public function get_level_list($language_id)
{
    if( $query = $this->db->query("call get_level_list('".$language_id."')")){ 
        $result = $query->result();
        return $result; }else{ return false; }
}
/*****************************************   // To get level by id  ************************************/
public function level_details_byid($levelid)
{
    if($query = $this->db->query("call level_details_byid('".$levelid."')"))
    {  $result = $query->result(); return $result; }else{ return 0; }
}
/*****************************************   // To get level by id  ************************************/
public function level_by_id_lang($levelid,$language)
{
    if($query = $this->db->query("call level_by_id_lang('".$levelid."','".$language."')"))
    {  $result = $query->row(); return $result; }else{ return 0; }
}
/*****************************************   // To levels refer id detail ************************************/
public function level_by_id_other_lang($levelid, $language)
{
    $query = $this->db->query("call level_by_id_other_lang('".$levelid."' ,'".$language."')");
    $result = $query->row(); return $result;
}

/*****************************************   // To levels delete ************************************/
public function level_delete($level)
{
    if( $query = $this->db->query("call level_inactive_status(
      '".$level['status']."',
      '".$level["modified_by"]."',
      '".$level['modified_on']."',
      '".$level['question_level_id']."'
    )")){ return true; }else{ return false; }
}
/*****************************************   // To levels delete all other language ************************************/
public function level_delete_all($level)
{
    if( $query = $this->db->query("call level_delete_all(
      '".$level['status']."',
      '".$level["modified_by"]."',
      '".$level['modified_on']."',
      '".$level['question_level_id']."'
    )")){ return true; }else{ return false; }
}
/*****************************************   // To levels delete ************************************/
public function level_refer_delete($level)
{
    if( $query = $this->db->query("call level_refer_delete(
      '".$level['status']."',
      '".$level["modified_by"]."',
      '".$level['modified_on']."',
      '".$level['question_level_id']."'
    )")){ return true; }else{ return false; }
}
/*****************************************   // To check level name exists ************************************/
public function check_level_name($level)
{
  $query = $this->db->query("call check_level_name('".$level."')");
  $result = $query->row();
  return $result;    
}
/*****************************************   // To update level ************************************/
public function level_update($level)
{

echo '<pre>';
        print_r($level);
    if($query = $this->db->query("call level_update(
      '".$level['question_level']."',
      '".$level["modified_by"]."',
      '".$level['modified_on']."',
      '".$level['question_level_id']."'

    )")){
     return true; }else{ return false; }

} 
/*****************************************  ******************  *******************************************************************
                                             Starts Question Type
/*****************************************  ******************  *******************************************************************/
 public function check_question_type_exists($language_id, $q_type)
{

  $query = $this->db->query("call check_question_type_exists('".$language_id."', '".$q_type."')");
  $result = $query->row();
  return $result;    
}   
/******************************  //  To add Question type  ****************************************/
public function question_type_add($q_type)
{
  
    $query = $this->db->query("call question_type_add(
    '".$q_type['language_id']."',   
    '".$q_type['refer_qtn_type_id']."',
    '".$q_type['question_type']."',
    '".$q_type['field_type']."',
    '".$q_type["status"]."',
    '".$q_type["created_by"]."',
    '".$q_type["created_on"]."',
    '".$q_type["modified_by"]."',
    '".$q_type['modified_on']."'
    )");
    $query = $this->db->query('SELECT LAST_INSERT_ID()');
    $row = $query->row_array();
    return $row['LAST_INSERT_ID()']; 
       
}
/*****************************************   // To question type list  ************************************/
public function get_question_type_list($lang)
{
    if($query = $this->db->query("call get_question_type_list('".$lang."')"))
    {  $result = $query->result(); return $result; }else{ return 0; }
} 
/*****************************************   // To view question type by id  ************************************/
public function q_type_details_byid($q_typeid)
{
    if($query = $this->db->query("call q_type_details_byid('".$q_typeid."')"))
    {  $result = $query->result(); return $result; }else{ return 0; }
} 
/*****************************************   // To get other question types by  id ************************************/
public function question_type_by_id_lang($q_typeid,$lang)
{
    $query = $this->db->query("call question_type_by_id_lang('".$q_typeid."','".$lang."' )");
    $result = $query->row(); return $result;
}
/*****************************************   // To get other question types by other lang id ************************************/
public function question_type_by_id_other_lang($q_typeid,$lang)
{
    $query = $this->db->query("call question_type_by_id_other_lang('".$q_typeid."','".$lang."' )");
    $result = $query->row(); return $result;
}



/*****************************************   // To update question type ************************************/
public function question_type_update($q_type)
{

    if($query = $this->db->query("call question_type_update(
      '".str_replace("'", "`", $q_type['question_type'])."',
      '".$q_type["modified_by"]."',
      '".$q_type['modified_on']."',
      '".$q_type['question_type_id']."'

    )")){
     return true; }else{ return false; }

} 
/*****************************************   // To update level ************************************/
public function question_type_delete($q_type)
{

    if($query = $this->db->query("call question_type_delete(
      '".$q_type['status']."',
      '".$q_type["modified_by"]."',
      '".$q_type['modified_on']."',
      '".$q_type['question_type_id']."'

    )")){
     return true; }else{ return false; }
} 
/*****************************************   // To update level ************************************/
public function question_type_delete_all($q_type)
{
    if($query = $this->db->query("call question_type_delete_all(
      '".$q_type['status']."',
      '".$q_type["modified_by"]."',
      '".$q_type['modified_on']."',
      '".$q_type['question_type_id']."'
    )")){
     return true; }else{ return false; }

} 
/*****************************************  ******************  *******************************************************************
                                             Starts Question Category
/*****************************************  ******************  *******************************************************************/
 public function check_question_category_exists($language_id, $q_cat)
{

  $query = $this->db->query("call check_question_category_exists('".$language_id."', '".$q_cat."')");
  $result = $query->row();
  return $result;    
} 
/******************************  //  To add Question Category  ****************************************/
public function question_category_add($q_cat)
{
  
    $query = $this->db->query("call question_category_add(
    '".$q_cat['language_id']."',   
    '".$q_cat['refer_qtn_category_id']."',
    '".$q_cat['question_category']."',
    '".$q_cat['category_type']."',
    '".$q_cat["status"]."',
    '".$q_cat["created_by"]."',
    '".$q_cat["created_on"]."',
    '".$q_cat["modified_by"]."',
    '".$q_cat['modified_on']."'
    )");
    $query = $this->db->query('SELECT LAST_INSERT_ID()');
    $row = $query->row_array();
    return $row['LAST_INSERT_ID()']; 
       
}
/******************************  //  To list levels  ****************************************/
public function get_question_category_list($language_id)
{
    if( $query = $this->db->query("call get_question_category_list('".$language_id."')")){ 
        $result = $query->result();
        return $result; }else{ return false; }
}
/*****************************************   // To get question category by id  ************************************/
public function question_category_details_byid($q_cat)
{
    if($query = $this->db->query("call question_category_details_byid('".$q_cat."')"))
    {  $result = $query->result(); return $result; }else{ return 0; }
}
/*****************************************   // To get question category by id  ************************************/
public function question_category_by_id_lang($q_cat, $lang)
{
    if($query = $this->db->query("call question_category_by_id_lang('".$q_cat."', '".$lang."')"))
    {  $result = $query->row(); return $result; }else{ return 0; }
}
/*****************************************   // To get question category by id for other languages ************************************/
public function question_category_by_id_other_lang($q_cat, $lang)
{
    if($query = $this->db->query("call question_category_by_id_other_lang('".$q_cat."', '".$lang."')"))
    {  $result = $query->row(); return $result; }else{ return 0; }
}
/*****************************************   // To update question category ************************************/
public function question_category_update($q_cate)
{

    if($query = $this->db->query("call question_category_update(
      '".$q_cate['question_category']."',
      '".$q_cate["modified_by"]."',
      '".$q_cate['modified_on']."',
      '".$q_cate['question_category_id']."'

    )")){
     return true; }else{ return false; }

}
/*****************************************   // To update question category status 2 by id ************************************/
public function question_category_active_intactive($q_cate)
{

    if($query = $this->db->query("call question_category_active_intactive(
      '".$q_cate['status']."',
      '".$q_cate["modified_by"]."',
      '".$q_cate['modified_on']."',
      '".$q_cate['question_category_id']."'

    )")){
     return true; }else{ return false; }
}
/*****************************************   // To update question category status 2 by id and refer ids ************************************/
public function question_category_delete($q_cate)
{
    if($query = $this->db->query("call question_category_delete(
      '".$q_cate['status']."',
      '".$q_cate["modified_by"]."',
      '".$q_cate['modified_on']."',
      '".$q_cate['question_category_id']."'

    )")){
     return true; }else{ return false; }
}

/*****************************************   **************************************************
                                     Starts Answer Type Function
/*****************************************    **************************************************/
public function check_answer_type_exists($language_id, $ans_type)
{

  $query = $this->db->query("call check_answer_type_exists('".$language_id."', '".$ans_type."')");
  $result = $query->row();
  return $result;    
} 
/******************************  //  To list answer type  ****************************************/
public function get_answer_type_list($language_id)
{
    if( $query = $this->db->query("call get_answer_type_list('".$language_id."')")){ 
        $result = $query->result();
        return $result; }else{ return false; }
}
/******************************  //  To add Answer Type  ****************************************/
public function answer_type_add($ans_type)
{
  
    $query = $this->db->query("call answer_type_add(
    '".$ans_type['language_id']."',   
    '".$ans_type['refer_answer_type_id']."',
    '".$ans_type['answer_type']."',
    '".$ans_type['option_type']."',
    '".$ans_type['one_of_many']."',
    '".$ans_type['many_of_many']."',
    '".$ans_type['is_descriptive']."',
    '".$ans_type["status"]."',
    '".$ans_type["created_by"]."',
    '".$ans_type["created_on"]."',
    '".$ans_type["modified_by"]."',
    '".$ans_type['modified_on']."'
    )");
    $query = $this->db->query('SELECT LAST_INSERT_ID()');
    $row = $query->row_array();
    return $row['LAST_INSERT_ID()']; 
       
}
/*****************************************   // To get answer type by id  ************************************/
public function answer_type_details_byid($ans_type_id)
{
    if($query = $this->db->query("call answer_type_details_byid('".$ans_type_id."' )"))
    {  $result = $query->result(); return $result; }else{ return 0; }
}

/*****************************************   // To get answer type by id and language ************************************/
public function answer_type_details_by_id_lang($ans_refer_type_id,$lang)
{
 
  $query  = $this->db->query("call answer_type_details_by_id_lang('".$ans_refer_type_id."', '".$lang."' )");
  $result = $query->row(); return $result;
}
/*****************************************   // To get answer set by id and language ************************************/
public function answer_type_details_by_id_other_lang($ans_refer_type_id,$lang)
{
  $query  = $this->db->query("call answer_type_details_by_id_other_lang('".$ans_refer_type_id."', '".$lang."' )");
  $result = $query->row(); return $result;
}

/*****************************************   // To update question category ************************************/
public function answer_type_update($ans_type)
{

    if($query = $this->db->query("call answer_type_update(

      '".$ans_type['answer_type']."',
      '".$ans_type['option_type']."',
      '".$ans_type["modified_by"]."',
      '".$ans_type['modified_on']."',
      '".$ans_type['answer_type_id']."'

    )")){
     return true; }else{ return false; }

}
/*****************************************   // To update answer type status************************************/
public function answer_type_active_inactive_delete($ans_type)
{

    if($query = $this->db->query("call answer_type_active_inactive_delete(
      '".$ans_type['status']."',
      '".$ans_type["modified_by"]."',
      '".$ans_type['modified_on']."',
      '".$ans_type['answer_type_id']."'

    )")){
     return true; }else{ return false; }
}
/*****************************************   // To update answer type status************************************/
public function answer_type_delete_refer_id($ans_type)
{

    if($query = $this->db->query("call answer_type_delete_refer_id(
      '".$ans_type['status']."',
      '".$ans_type["modified_by"]."',
      '".$ans_type['modified_on']."',
      '".$ans_type['answer_type_id']."'

    )")){
     return true; }else{ return false; }
}

                /*****************************************   **************************************************
                                Starts Answer Set Function
                /*****************************************    **************************************************/
public function check_answer_set_exists($language_id, $ansset)
{
  $query = $this->db->query("call check_answer_set_exists('".$language_id."', '".$ansset."')");
  $result = $query->row();
  return $result;    
} 
/******************************  //  To add Answer Set  ****************************************/
public function answer_set_add($ans_set)
{
  
    $query = $this->db->query("call answer_set_add(
    '".$ans_set['language_id']."',   
    '".$ans_set['refer_answer_set_id']."',
    '".$ans_set['answer_set_name']."',
    '".$ans_set['set_type']."',
    '".$ans_set['description']."',
    '".$ans_set["status"]."',
    '".$ans_set["created_by"]."',
    '".$ans_set["created_on"]."',
    '".$ans_set["modified_by"]."',
    '".$ans_set['modified_on']."'
    )");
    $query = $this->db->query('SELECT LAST_INSERT_ID()');
    $row = $query->row_array();
    return $row['LAST_INSERT_ID()']; 
       
}
/******************************  //  To list answer set  ****************************************/
public function get_answer_set_list($language_id)
{
    if( $query = $this->db->query("call get_answer_set_list('".$language_id."')")){ 
        $result = $query->result();
        return $result; }else{ return false; }
}
/*****************************************   // To get answer set by id  ************************************/
public function answer_set_details_byid($ans_refer_set_id)
{
  $query  = $this->db->query("call answer_set_details_byid('".$ans_refer_set_id."')");
  $result = $query->result(); return $result;
}
/*****************************************   // To update answer set status 1 to inactive ************************************/
public function answer_set_active_intactive($ans_set)
{
    if($query = $this->db->query("call answer_set_active_intactive(
      '".$ans_set['answer_set_id']."',
      '".$ans_set['status']."',
      '".$ans_set["modified_by"]."',
      '".$ans_set['modified_on']."'
    )")){
     return true; }else{ return false; }
}
/*****************************************   // To update answer set status 1 to inactive ************************************/
public function answer_set_delete_refer_id($ans_set)
{
    if($query = $this->db->query("call answer_set_delete_refer_id(
      '".$ans_set['answer_set_id']."',
      '".$ans_set['status']."',
      '".$ans_set["modified_by"]."',
      '".$ans_set['modified_on']."'
    )")){
     return true; }else{ return false; }
}
/*****************************************   // To update answer type status 1 to inactive ************************************/
public function answer_set_update($ans_set)
{
    if($query = $this->db->query("call answer_set_update(
      '".$ans_set['answer_set_id']."',
      '".$ans_set['answer_set_name']."',
      '".$ans_set["modified_by"]."',
      '".$ans_set['modified_on']."'
    )")){
     return true; }else{ return false; }
}
/*****************************************   // To get answer set by id and language ************************************/
public function answer_set_details_by_id_lang($ans_refer_set_id,$lang)
{
  $query  = $this->db->query("call answer_set_details_by_id_lang('".$ans_refer_set_id."', '".$lang."' )");
  $result = $query->row(); return $result;
}
/*****************************************   // To get answer set by id and language ************************************/
public function answer_set_details_by_id_lang1($ans_refer_set_id,$lang)
{
  $query  = $this->db->query("call answer_set_details_by_id_lang1('".$ans_refer_set_id."', '".$lang."' )");
  $result = $query->row(); return $result;
}
/*****************************************   // To update option count ************************************/
public function option_count_update($opt)
{
  if($query = $this->db->query("call option_count_update(
      '".$opt['option_count']."',
      '".$opt['status']."',
      '".$opt["modified_by"]."',
      '".$opt['modified_on']."',
      '".$opt['setting_id']."'

    )")){
     return true; }else{ return false; }
}


/**********************************************************************************************************
                            Purpose : To handle Languages Settings Database details
                            Date    : 04-Dec-2017 
                        ****************************************************************/
// To get language details
public function get_languages(){

    $query  = $this->db->query("call get_languages()");
    $result = $query->result();
    return $result;
}
// To get languages
public function languages_list(){

    $query  = $this->db->query("call languages_list()");
    $result = $query->result();
    return $result;
}

// To check the lanugage exists already
public function check_language_exists($language)
{
    $query  = $this->db->query("call check_language_exists('".$language."')");
    $result = $query->row();
    return $result;
}
// To update the language settings details
public function save_language($lang)
{
    if($query = $this->db->query("call save_language(
    '".$lang['language']."',   
    '".$lang['status']."',
    '".$lang['created_by']."',
    '".$lang["created_on"]."',
    '".$lang["modified_by"]."',
    '".$lang["modified_on"]."'
    )"))
   {  return  $this->db->insert_id();  }else{ return false; }
}
// To update the language settings details
public function update_language($lang)
{    
    if($query = $this->db->query("call update_language(
    '".$lang['language_id']."',
    '".$lang['language']."',   
    '".$lang['status']."',
    '".$lang["modified_by"]."',
    '".$lang["modified_on"]."'
    )"))
   {  return true; }else{ return false; }
   
}

// To update default language
public function update_default_language($lang,$id,$modify_by,$modified_on)
{
    if($query = $this->db->query("call default_lanuage_update(
    '".$lang."',
    '".$id."' ,
    '".$modify_by."'  ,
    '".$modified_on."' 
    
    )"))
   {  return true; }else{ return false; }
   
}
// To delete language ( change status is 2 to delete language)
public function language_delete($lang)
{
    if($query = $this->db->query("call language_delete('".$lang['language_id']."',
        '".$lang['status']."',
        '".$lang['modified_by']."',
         '".$lang['modified_on']."'
)"))
    {  return true; }else{ return false; }
   
}
    /**********************************************************************************************************
                            Purpose : To handle Industry Settings Database details
                            Date    : 04-Dec-2017 
                        ****************************************************************/
/*************************** // To get organization details *******************************/
public function industry_list(){

    $query  = $this->db->query("call industry_list()");
    $result = $query->result();
    return $result;
}
/*************************** // To check organisation type exists  *******************************/
public function check_industry_exists($org){

    $query  = $this->db->query("call check_industry_exists('".$org['organization_type']."')");
    $result = $query->row();
    return $result;
}
/************************ // To save oranisation type details *************************************/
public function industry_add($org)
{
    if($query = $this->db->query("call industry_add(
    '".$org['language_id']."',   
    '".$org['refer_org_type_id']."',
    '".$org['organization_type']."',
    '".$org['status']."',
    '".$org['created_by']."',
    '".$org["created_on"]."',
    '".$org["modified_by"]."',
    '".$org["modified_on"]."'
    )"))
   {  return  $this->db->insert_id();  }else{ return false; }
}
/**************************** // To update organisation  details ****************************************/
public function industry_update($org)
{
    if($query = $this->db->query("call industry_update(
    '".$org['language_id']."',
    '".$org['organization_type']."',   
    '".$org['status']."',
    '".$org["modified_by"]."',
    '".$org["modified_on"]."',
    '".$org["organization_type_id"]."'
    )"))
   {  return true; }else{ return false; }
   
}
/**************************** // To update organisation  status as inactive ****************************************/
public function industry_inactive_active_delete($org)
{
    if($query = $this->db->query("call industry_inactive_active_delete(   
    '".$org['status']."',
    '".$org["modified_by"]."',
    '".$org["modified_on"]."',
    '".$org["organization_type_id"]."'
    )"))
   {  return true; }else{ return false; }
   
}                            

/**********************************************************************************************************
                            Purpose : To handle Question Theme Settings Database details
                            Date    : 04-Dec-2017 
                        ****************************************************************/                       
/*********************** // To get quetion theme details for list ************************************/
public function question_theme_list(){

    $query  = $this->db->query("call question_theme_list()");
    $result = $query->result();
    return $result;
}
/**************************** // To update organisation  status as inactive ****************************************/
public function question_theme_update($theme)
{
    if($query = $this->db->query("call question_theme_update(   
    '".$theme["theme"]."',
    '".$theme["modified_by"]."',
    '".$theme["modified_on"]."',
    '".$theme["theme_id"]."',
    '".$theme["theme_preview"]."',
    '".$theme["theme_css"]."'
    )"))
   {  return true; }else{ return false; }
   
}
public function question_theme_get($theme_id)
{
    $query = $this->db->query("call question_theme_get('".$theme_id."')");
    $result = $query->row();
    return $result;
}
/**********************************************************************************************************
                            Purpose : To handle Question Template Settings Database details
                            Date    : 04-Dec-2017 
                        ****************************************************************/                       
/*********************** // To get quetion Template details for list ************************************/
public function question_template_list(){

    $query  = $this->db->query("call question_template_list()");
    $result = $query->result();
    return $result;
}
/**************************** // To update Question Template  ****************************************/
public function question_template_update($temp)
{
    if($query = $this->db->query("call question_template_update(   
    '".$temp["template_name"]."',
    '".$temp["template_id"]."',
    '".$temp['template_preview']."'
    )"))
   {  return true; }else{ return false; }
   
}
public function question_template_get($template_id)
{
    $query = $this->db->query("call question_template_get('".$template_id."')");
    $result = $query->row();
    return $result;
}

/**********************************************************************************************************
                            Purpose : To handle package type Settings Database details
                            Date    : 06-Jan-2018 
                        ****************************************************************/
/******************************* // To get package settings details *********************************************/
public function package_type_list(){

    $query = $this->db->query("call package_type_list()");
    $result = $query->result();
    return $result;
}
/******************************* // To get package type name exists *********************************************/
public function package_type_exists($packagename){

    $query  = $this->db->query("call package_type_exists('".$packagename."')");
    $result = $query->row();
    return $result;
}
/************************ // To save package type details *************************************/
public function package_type_add($package_type)
{
    if($query = $this->db->query("call package_type_add(
    '".$package_type['language_id']."',   
    '".$package_type['refer_package_type_id']."',
    '".$package_type['package_type']."',
    '".$package_type['status']."',
    '".$package_type['created_by']."',
    '".$package_type["created_on"]."',
    '".$package_type["modified_by"]."',
    '".$package_type["modified_on"]."'
    )"))
   {  return  $this->db->insert_id();  }else{ return false; }
}
/**************************** // To update package type active and inactive ****************************************/
public function package_type_inactive_active($packagetype)
{
    if($query = $this->db->query("call package_type_inactive_active(
    '".$packagetype['package_type_id']."',
    '".$packagetype['status']."',
    '".$packagetype["modified_by"]."',
    '".$packagetype["modified_on"]."'
    )"))
   {  return true; }else{ return false; }
   
}
/*****************************************   // To get package type by id ************************************/
public function package_type_by_id($package_type)
{
  $query  = $this->db->query("call package_type_by_id('".$package_type."')");
  $result = $query->row(); return $result;
}
/******************************* // To get package type name exists by id *********************************************/
public function package_type_exists_id($package_id, $package_name){

    $query  = $this->db->query("call package_type_exists_id('".$package_id."', '".$package_name."')");
    $result = $query->row();
    return $result;
}
/************************ // To update package type details *************************************/
public function package_type_update($package_type)
{
    if($query = $this->db->query("call package_type_update(
    '".$package_type['package_type_id']."',   
    '".$package_type['package_type']."',
    '".$package_type["modified_by"]."',
    '".$package_type["modified_on"]."'
    )"))
   {  return  $this->db->insert_id();  }else{ return false; }
}


//==========START: SA Email Template function===============================//
function email_temp_list()
{
    $query =  $this->db->query("call email_temp_list('')");
    $result = $query->result();
    return $result;
}

function add_emailtemplate($title,$subject,$content,$user_id,$modify_on)
{
    if($query =  $this->db->query("call add_emailtemplate('".$title."','".$subject."','".$content."','$user_id','".$modify_on."')")){
    $result = 1; }else{ $result = 0; }
    return $result;
}
function emailtemp_status_change($status,$id)
{
    if($query =  $this->db->query("call emailtemp_status_change('$status','$id')")){
    $result = 1; }else{ $result = 0; }
    return $result;
}

function email_temp_view($id)
{
    $query =  $this->db->query("call email_temp_view('$id')");
    $result = $query->row_array();
    return $result;
}

function email_temp_delete($id)
{
    if($query =  $this->db->query("call email_temp_delete('$id')")){
    $result = 1; }else{ $result = 0; }
    return $result;
}

function edit_email_temp($id)
{
    $query =  $this->db->query("call email_temp_by_id('".$id."')");
    $result = $query->row_array();
    return $result;
}
function update_email_temp($id,$title,$subject,$content,$user_id,$modify_on)
{
    if($query =  $this->db->query("call update_email_temp_by_id('$id','".$title."','".$subject."','".$content."','$user_id','".$modify_on."')")){
    $result = 1; }else{ $result = 0; }
    return $result;
}
//==========END: SA Email Template Function ===============================//

//==========START: User Support ===============================//
function get_support_list()
{
    $query = $this->db->query("call user_support_list('')");
    $result = $query->result();
    return $result;
}
function support_view($id)
{
    $query = $this->db->query("call user_support_view('$id')");
    $result = $query->row();
    return $result;
}
function support_update($email,$message,$status)
{
    if($query = $this->db->query("call user_support_edit('$email','$message','$status')"))
    { $result =1; } else { $result = 0; }
    return $result;
}
//==========END: User Support=================================// 

//==========START : CSA Settings==============================// 
function get_admin_user_list()
{
    $query = $this->db->query("call get_admin_user_list('')");
    $result = $query->result();
    return $result;
}
public function get_role_permission_by_role_id($roleId)
{
    
    $query = $this->db->query("call get_role_permission_by_role_id('".$roleId."')");
    $res = $query->result_array();
   
    return $res;
}
public function get_all_user_own_mail_by_id($user_id)
{
    $query = $this->db->query("SELECT uoe.user_emails FROM user_owned_emails uoe WHERE uoe.user_id = '$user_id'");
    return $query->result_array();
}
public function get_all_product_by_user_id($user_id)
{
    $query = $this->db->query("SELECT up.user_product_id FROM user_products up WHERE up.user_id = '$user_id' AND up.status = 0 AND up.product_id != 0");
    return $query->result_array();
}
public function store_login_time($user_id,$login_time,$user_ip)
{
    $query = $this->db->query("INSERT INTO `login_history_details`(`user_id`, `ip_address`, `login_time`, `last_active_time`) VALUES ('$user_id','$user_ip','$login_time','$login_time')");
    $insert_id = $this->db->insert_id();
    return $insert_id;
}
public function update_logout_time($login_history_id,$logout_time,$diff_log)
{
    $query = $this->db->query("UPDATE `login_history_details` SET `logout_time`= '$logout_time', `log_diff` = '$diff_log', `status` =  2 WHERE `login_history_detail_id`= '$login_history_id'"); 
    return 1;
}
public function get_log_hist_by_id($login_history_id)
{
    $query = $this->db->query("SELECT lh.* FROM login_history_details lh WHERE lh.login_history_detail_id = '$login_history_id'")->row(); 
    return $query;   
}
public function get_logged_user_login_history($user_id)
{
    $query = $this->db->query("SELECT lh.* FROM login_history_details lh WHERE lh.user_id = '$user_id' AND lh.status = 0")->row(); 
    return $query;   
}
public function get_all_login_users()
{
    $query = $this->db->query("SELECT lh.* FROM login_history_details lh WHERE lh.status = 0")->result(); 
    return $query; 
}
//==========END : CSA Settings================================//

} // class end
