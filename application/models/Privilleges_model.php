<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Privilleges_model extends CI_Model
{
	  
	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("privilleges.id,privilleges.menu_id,privilleges.function_id, area.id as area_id,groups.id as group_id,role.id as role_id")
                ->from("privilleges"); 
        $this->db->join("role","role.id = privilleges.role_id"); 
        $this->db->join("menu","menu.id = privilleges.menu_id"); 
        $this->db->join("groups","groups.id = role.group_id"); 
        $this->db->join("area","area.id = groups.area_id"); 
         $this->db->where("area.is_deleted",0); 
        $this->db->where("groups.is_deleted",0); 
        $this->db->where("role.is_deleted",0); 
		$this->db->where($where);   
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('privilleges', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('privilleges', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($where){
		$this->db->where($where);
		$this->db->delete('privilleges'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("privilleges.id, area.name as area_name,groups.name as group_name,role.name as role_name,role.id as role_id,privilleges.is_deleted")
                ->from("privilleges"); 
        $this->db->join("role","role.id = privilleges.role_id"); 
        $this->db->join("menu","menu.id = privilleges.menu_id"); 
        $this->db->join("groups","groups.id = role.group_id"); 
        $this->db->join("area","area.id = groups.area_id"); 

       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
    	}
        $this->db->where("area.is_deleted",0); 
        $this->db->where("groups.is_deleted",0); 
        $this->db->where("role.is_deleted",0); 
        $this->db->group_by('privilleges.role_id'); 
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
        $this->db->select("privilleges.id,area.name as area_name,groups.name as group_name,role.name as role_name,role.id as role_id")
                ->from("privilleges"); 
        $this->db->join("role","role.id = privilleges.role_id"); 
        $this->db->join("menu","menu.id = privilleges.menu_id"); 
        $this->db->join("groups","groups.id = role.group_id"); 
        $this->db->join("area","area.id = groups.area_id"); 
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
    	}

        $this->db->where("area.is_deleted",0); 
        $this->db->where("groups.is_deleted",0); 
        $this->db->where("role.is_deleted",0); 
        $this->db->group_by('privilleges.role_id');
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
