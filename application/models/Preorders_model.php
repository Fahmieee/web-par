<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class preorders_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("preorders.*")->from("preorders");  
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	} 
	public function getAllItemById($where = array()){
		$this->db->select("preorders_item.*, parts.name as part_name")->from("preorders_item");  
		$this->db->join("parts","parts.id=preorders_item.part_id");
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('preorders', $data);
		return $this->db->insert_id();
	}
	public function insertItem($data){
		$this->db->insert('preorders_item', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('preorders', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('preorders'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir,$where=array())
    {
    	$this->db->select("preorders.*,workshop.name as workshop_name,units.merk as unit_merk,units.model as unit_model,units.no_police,users.first_name,produk.name as produk_name")->from("preorders");  
    	$this->db->join("units","units.id=preorders.unit_id");
    	$this->db->join("produk","produk.id=units.merk");
    	$this->db->join("users","users.id=preorders.user_id");
    	$this->db->join("workshop","workshop.id=preorders.workshop_id", 'left');
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

    function getCountAllBy($limit,$start,$search,$order,$dir,$where=array())
    { 
    	$this->db->select("preorders.*,workshop.name as workshop_name,units.merk as unit_merk,units.model as unit_model,units.no_police,users.first_name,produk.name as produk_name")->from("preorders");  
    	$this->db->join("units","units.id=preorders.unit_id");
    	$this->db->join("produk","produk.id=units.merk");
    	$this->db->join("users","users.id=preorders.user_id");
    	$this->db->join("workshop","workshop.id=preorders.workshop_id", 'left');
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
