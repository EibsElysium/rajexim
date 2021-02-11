<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***************************************************************
    Purpose : To handle all the Rawmaterial database details
    Date    : 03-02-2020
****************************************************************/
class Profile_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta'); 
    }
 /* ************************************************************************************
                        Purpose : To handle Profile Functions
            **********************************************************************/

    //To Get Profile details
    public function user_profile_details($userid)
    {
       $result = common_select_values('*', 'users', ' status !=2 AND user_id="'.$userid.'"', 'row');
       return $result;
    }
    //To Update the profile Details
    public function profile_update($data,$id)
    {

        $columns = '';
        $condition = '';
        if($data != '' && $id != '')
        {
            $columns = "name = '".trim($data['fname'])."',  dob = '".trim($data['dob'])."',  address = '".trim($data['address'])."', contact_no = '".trim($data['cno'])."', email_id = '".trim($data['email'])."', pincode =  '".trim($data['pincode'])."',  profile_image ='".trim($data['profile_image'])."',  modified_on = '".trim($data['modified_on'])."', modified_by = '".trim($data['modified_by'])."'";
            $condition = ' user_id = "'.$id.'"';
            $result = common_update_values($columns, 'users', $condition);

        }
        else
        {
            $result = false;
        }
        return $result;
    }
    //To Check Old password correct
    public function profile_password_check($password,$userid)
    {
        $result = common_select_values('*', 'users', ' status !=2 AND password ="'.$password.'" AND user_id ="'.$userid.'"', 'row');
        return $result;
    }
    //To Update New Password
    public function profile_update_pass($val,$id)
    {

        $columns = '';
        $condition = '';
        if($val != '' && $id != '')
        {
            $columns = "password = '".trim($val)."'";
            $condition = ' user_id = "'.$id.'"';
            $result = common_update_values($columns, 'users', $condition);
        }
        else
        {
            $result = false;
        }
        return $result;
    }

    //To Check Email Unique
    public function profile_unique_email_edit($mail,$id)
    {
       
        $result = $this->db->query("CALL profile_unique_email_edit('".$mail."','".$id."')")->row();
        
        return $result;
    }

    //To Check Contact Number unique
    public function profile_contact_number_unique($no,$id)
    {
       
        $result = $this->db->query("CALL profile_contact_number_unique('".$no."','".$id."')")->row();
        
        return $result;
    }

    

    

    


} // class end
