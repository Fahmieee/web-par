<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Employee_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("users.*, role.id as role_id,area.id as area_id,groups.id as group_id")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.user_id");
    	$this->db->join("role","role.id = users_roles.role_id");
    	$this->db->join("groups","groups.id = role.group_id");
    	$this->db->join("area","area.id = groups.area_id");
		$this->db->where("users.is_deleted",0);
		$this->db->where("role.is_deleted",0);
		$this->db->where("groups.is_deleted",0);
		$this->db->where("area.is_deleted",0); 
		//superadmin, driver,users
		$roles_default = array('1','2','3');
        $this->db->where_not_in('role.id', $roles_default); 
		$this->db->where($where); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('users', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('users'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("users.*, role.name as role_name,area.name as area_name,groups.name as group_name")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.user_id");
    	$this->db->join("role","role.id = users_roles.role_id");
    	$this->db->join("groups","groups.id = role.group_id");
    	$this->db->join("area","area.id = groups.area_id");
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	} 
    	//superadmin, driver,users
		$roles_default = array('1','2','3');
        $this->db->where_not_in('role.id', $roles_default); 
		$this->db->where("role.is_deleted",0);
		$this->db->where("groups.is_deleted",0);
		$this->db->where("area.is_deleted",0);
       	$result = $this->db->get();
        if($result->num_rows()>0)
        {
            return $result->result();  
        }
        else
        {
            return null;
        }
    }

    function getCountAllBy($limit,$start,$search,$order,$dir)
    {

    	$this->db->select("users.*, role.name as role_name,area.name as area_name,groups.name as group_name")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.user_id");
    	$this->db->join("role","role.id = users_roles.role_id");
    	$this->db->join("groups","groups.id = role.group_id");
    	$this->db->join("area","area.id = groups.area_id");
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	} 
    	//superadmin, driver,users
		$roles_default = array('1','2','3');
        $this->db->where_not_in('role.id', $roles_default); 
		$this->db->where("role.is_deleted",0);
		$this->db->where("groups.is_deleted",0);
		$this->db->where("area.is_deleted",0);
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
