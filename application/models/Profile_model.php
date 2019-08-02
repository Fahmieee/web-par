<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Profile_model extends CI_Model
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
		$this->db->where($where); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function getAllIdSuperadmin($where = array()){
		$this->db->select("users.*")->from("users");  
		$this->db->where("users.is_deleted",0); 
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
}
