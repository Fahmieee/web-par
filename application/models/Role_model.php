<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Role_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("role.*,area.id as area_id")->from("role"); 
        $this->db->join("groups","groups.id=role.group_id"); 
        $this->db->join("area","area.id=groups.area_id");
        //superadmin, agent, pandu
        $roles_default = array('1', '2', '3');
        $this->db->where_not_in('role.id', $roles_default);

		$this->db->where($where); 

        $this->db->where("role.is_deleted",0); 
        $this->db->where("groups.is_deleted",0); 
        $this->db->where("area.is_deleted",0); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('role', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('role', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($where){
		$this->db->where($where);
		$this->db->delete('role'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("role.*,groups.name as group_name,area.name as area_name")->from("role");  
        $this->db->join("groups","groups.id=role.group_id"); 
        $this->db->join("area","area.id=groups.area_id"); 

       	$this->db->limit($limit,$start)->order_by($col,$dir);
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
    	}
        //superadmin, agent, pandu
        $roles_default = array('1', '2', '3');
        $this->db->where_not_in('role.id', $roles_default);
 
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
    	$this->db->select("role.*")->from("role");  
        $this->db->join("groups","groups.id=role.group_id");
        $this->db->join("area","area.id=groups.area_id"); 
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->openssl_csr_get_public_key(csr)($key,$value);	
			} 	
    	}

        //superadmin, agent, pandu
        $roles_default = array('1', '2', '3');
        $this->db->where_not_in('role.id', $roles_default);

 
	    $this->db->where("groups.is_deleted",0);
        $this->db->where("area.is_deleted",0); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
