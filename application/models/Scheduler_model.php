<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Scheduler_model extends CI_Model
{ 
	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("user_contract_history.*")->from("user_contract_history");   
		
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	} 
	public function insert($data){
		$this->db->insert('user_contract_history', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('user_contract_history', $data, $where);
		return $this->db->affected_rows();
	}
 
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('user_contract_history'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("user_contract_history.id,user_contract_history.is_deleted,users.first_name, users.company,driver.first_name as driver_name,
    		driver.driver_type,units.merk,produk.name as unit_merk, units.model, units.varian,units.no_police,units.id as unit_id")->from("user_contract_history");   
    	$this->db->join("units","units.id = user_contract_history.unit_id"); 
    	$this->db->join("produk","produk.id = units.merk"); 
    	$this->db->join("users","users.id = user_contract_history.user_id"); 
    	$this->db->join("users as driver","driver.id =  user_contract_history.driver_id","left"); 
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	} 
    	$this->db->where("users.is_deleted",0);
		$this->db->where("units.is_deleted",0); 
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

    function getCountAllBy($limit,$start,$search,$col,$dir)
    {
		$this->db->select("user_contract_history.id,user_contract_history.is_deleted,users.first_name, users.company,driver.first_name as driver_name,
    		driver.driver_type,units.merk,produk.name as unit_merk, units.model, units.varian,units.no_police,units.id as unit_id")->from("user_contract_history");   
    	$this->db->join("units","units.id = user_contract_history.unit_id"); 
    	$this->db->join("produk","produk.id = units.merk"); 
    	$this->db->join("users","users.id = user_contract_history.user_id"); 
    	$this->db->join("users as driver","driver.id =  user_contract_history.driver_id","left"); 
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}  
		$this->db->where("users.is_deleted",0);
		$this->db->where("units.is_deleted",0); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
