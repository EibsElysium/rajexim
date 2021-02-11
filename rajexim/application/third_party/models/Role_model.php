<?php
class Role_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
    $this->load->database();
	}

  //To get role list 
  public function get_role_lists()
  {
    $qcond = '';
    if($_SESSION['admindata']['user_id'] != 1)
    {
      $uid = $_SESSION['admindata']['user_id'];
      $qcond .= " AND r.created_by = $uid ";
    }
    $query = $this->db->query("SELECT r.* FROM roles r WHERE r.status != 2 AND r.role_id != 1 $qcond ");
    return $query->result();
  }

  //to active inactive Role
  public function role_change_status($id,$data)
  {
    $this->db->reconnect();
    $result = $this->db->query("CALL role_change_status('".$data."','".$id."')");
    $this->db->close();
    return 1;
  }


  //To get menu list
  public function get_menu_lists($ftype)
  {
    $this->db->reconnect();
    $result = $this->db->query("CALL menu_list('".$ftype."')")->result_array();
    $this->db->close();
    return $result;
  }


  //to check role name unique
  public function unique_role($val)
  {
      $this->db->reconnect();
      $query  = $this->db->query("call role_name_unique('".$val."')");
      $result = $query->row();
      $this->db->close();
      return $result;
  }

  //To save role
  public function roles_create($data)
  {
    $this->db->reconnect();
    $result = $this->db->query("CALL role_add('".$data['rname']."','".$data['mon']."','".$data['mby']."')");
    $this->db->close();
    return $result;
  }


  //To save role permission
  public function permission_create($data)
  {
    $this->db->reconnect();
    $result = $this->db->query("CALL role_permission_add('".$data['role_id']."',".$data['menu_id'].",".$data['submenu_id'].",'".$data['fields']."','".$data['value']."',".$data['status'].")");
    $this->db->close();
    return $result;
  }


  //To get role by id
  public function get_role_by_id($id)
  {
    $this->db->reconnect();
    $query = $this->db->query("CALL role_by_id('".$id."')");
    $result = $query->result_array();
    $this->db->close();
    return $result;
  }


  //To update role name
  public function update_role($data)
  {
    $this->db->reconnect();
    $result = $this->db->query("CALL update_role('".$data['rname']."','".$data['id']."','".$data['mon']."','".$data['mby']."')");
    $this->db->close();
    return $result;
  }

  //to drop role permission
  public function drop_permission($id)
  {
    $this->db->reconnect();
    $result = $this->db->query("CALL drop_permission('".$id."')");
    $this->db->close();
    return $result;
  }


}
	
?>