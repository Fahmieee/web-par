<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Maintenance_model extends CI_Model
{ 
	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("maintenance.*")->from("maintenance");  
		$this->db->join("produk","produk.id = maintenance.merk","left");
		$this->db->where("maintenance.is_deleted",0); 
		$this->db->order_by("maintenance.distance","ASC");
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}

	public function getAllMaintenanceParts($where = array()){
		$this->db->select("maintenance_parts.*,parts.name")->from("maintenance_parts"); 
		$this->db->join("maintenance","maintenance.id = maintenance_parts.maintenance_id"); 
		$this->db->join("parts","parts.id = maintenance_parts.part_id");
		$this->db->where($where); 
		$this->db->order_by("maintenance.distance","ASC");
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}

	public function insert($data){
		$this->db->insert('maintenance', $data);
		return $this->db->insert_id();
	}
	public function insert_maintenance_parts($data){
		$this->db->insert('maintenance_parts', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('maintenance', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('maintenance'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}
	public function delete_maintenance_parts($where){
		$this->db->where($where);
		$this->db->delete('maintenance_parts'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir,$where)
    {
    	$this->db->select("maintenance.*,produk.name as produk_name")->from("maintenance");  
    	$this->db->join("produk","produk.id = maintenance.merk","left");
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
    	}  
    	$this->db->where($where); 
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

    function getCountAllBy($limit,$start,$search,$order,$dir,$where)
    {

    	$this->db->select("maintenance.*,produk.name as produk_name")->from("maintenance"); 
    	 $this->db->join("produk","produk.id = maintenance.merk","left");
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
    	}  
    	$this->db->where($where); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
