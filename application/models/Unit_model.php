<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Unit_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("units.*, branch.name as branch_name,produk.name as produk_name")->from("units");  
		$this->db->join("branch","branch.id=units.branch_id"); 
		$this->db->join("produk","produk.id=units.merk","left"); 
		$this->db->where("units.is_deleted",0); 
		$this->db->where("branch.is_deleted",0); 
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('units', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('units', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('units'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("units.*, branch.name as branch_name,produk.name as produk_name")->from("units");  
		$this->db->join("branch","branch.id=units.branch_id");  
		$this->db->join("produk","produk.id=units.merk","left"); 
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}   
		$this->db->where("branch.is_deleted",0); 
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

    	$this->db->select("units.*, branch.name as branch_name,produk.name as produk_name")->from("units");  
		$this->db->join("branch","branch.id=units.branch_id"); 
		
		$this->db->join("produk","produk.id=units.merk","left"); 
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}  
    	$this->db->where("branch.is_deleted",0); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
