<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class User_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("users.*, role.id as role_id,role_department.name as department,role_department.id as department_id")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.user_id");
    	$this->db->join("role","role.id = users_roles.role_id"); 
    	$this->db->join("role as role_department","role_department.id = users.department",'left');
		$this->db->where("users.is_deleted",0);
		$this->db->where("role.is_deleted",0);
		 
		//superadmin, driver,users
		$roles_default = array('3');
        $this->db->where_in('role.id', $roles_default); 
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
    	$this->db->select("users.*, role.name as role_name,role_department.name as department")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.user_id");
    	$this->db->join("role","role.id = users_roles.role_id");
    	$this->db->join("role as role_department","role_department.id = users.department",'left');
    	 
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	} 
    	// users
	 	$roles_default = array('3');
        $this->db->where_in('role.id', $roles_default); 
		$this->db->where("role.is_deleted",0); 
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

    	$this->db->select("users.*, role.name as role_name,role_department.name as department")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.user_id");
    	$this->db->join("role","role.id = users_roles.role_id"); 
    		$this->db->join("role as role_department","role_department.id = users.department",'left');
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	} 
    	//superadmin, driver,users
	 	$roles_default = array('3');
        $this->db->where_in('role.id', $roles_default); 
		$this->db->where("role.is_deleted",0); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
