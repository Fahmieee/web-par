<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Branch_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("branch.*, cities.name as city_name, area.name as area_name")->from("branch");  
    	$this->db->join("cities","cities.id = branch.city_id");
    	$this->db->join("area","area.id = branch.area_id");
		$this->db->where($where); 
		$this->db->where("branch.is_deleted",0); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('branch', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('branch', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('branch'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("branch.*, cities.name as city_name, area.name as area_name")->from("branch");  
    	$this->db->join("cities","cities.id = branch.city_id");
    	$this->db->join("area","area.id = branch.area_id");
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
    	}  
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

    	$this->db->select("branch.*, cities.name as city_name, area.name as area_name")->from("branch");  
    	$this->db->join("cities","cities.id = branch.city_id");
    	$this->db->join("area","area.id = branch.area_id");
    	 
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
    	}  
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
