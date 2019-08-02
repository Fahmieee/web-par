<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class workshop_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("workshop.*,area.name as area_name,cities.name as city_name,produk.name as produk_name")->from("workshop");  
		$this->db->join("area","area.id = workshop.area_id");
		$this->db->join("cities","cities.id = workshop.city_id");
		$this->db->join("produk","produk.id = workshop.merk","left");
		$this->db->where($where); 
		$this->db->where("workshop.is_deleted",0); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}

	public function findNearby($lat, $long, $radius,$workshops,$merk){
		$query = $this->db->query("SELECT * , FORMAT(FLOOR(3956 * 2 * ASIN(SQRT( POWER(SIN((".$lat." - lat) *  pi()/180 / 2), 2) + COS(".$lat." * pi()/180) * COS(lat * pi()/180) * POWER(SIN(( ".$long." - `long`) * pi()/180 / 2), 2) ))),0) as distance  from workshop where id in (".$workshops.") and merk='".$merk."' having  distance <= ".$radius."  order by distance ASC ");
	 
		if ($query->num_rows() > 0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function findWorkshop($lat, $long, $name,$merk){
		$query = $this->db->query("SELECT * , FORMAT(FLOOR(3956 * 2 * ASIN(SQRT( POWER(SIN((".$lat." - lat) *  pi()/180 / 2), 2) + COS(".$lat." * pi()/180) * COS(lat * pi()/180) * POWER(SIN(( ".$long." - `long`) * pi()/180 / 2), 2) ))),0) as distance  from workshop where merk='".$merk."' AND workshop.name LIKE '%".$name."%'  order by distance ASC ");
	 
		if ($query->num_rows() > 0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function getWorkshopParts($where = array()){
		$this->db->select("workshops_specifications.*")->from("workshop");  
		$this->db->join("workshops_specifications","workshop.id = workshops_specifications.workshop_id");
		$this->db->where("workshop.is_deleted",0); 
		$this->db->where($where); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function getWorkshopPartsByPartID($where = array()){
		$this->db->select("workshops_specifications.*")->from("workshop");  
		$this->db->join("workshops_specifications","workshop.id = workshops_specifications.workshop_id");
		$this->db->where("workshop.is_deleted",0); 
		$this->db->where_in("workshops_specifications.specification_id",$where); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function getWorkshopPICs($where = array()){
		$this->db->select("workshops_pics.*")->from("workshop");  
		$this->db->join("workshops_pics","workshop.id = workshops_pics.workshop_id");
		$this->db->where("workshop.is_deleted",0); 
		$this->db->where($where); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function getWorkshopPICsByWorkshops($where = array()){
		$this->db->select("workshops_pics.*")->from("workshop");  
		$this->db->join("workshops_pics","workshop.id = workshops_pics.workshop_id");
		$this->db->where("workshop.is_deleted",0); 
		$this->db->where("workshops_pics.is_cs",1); 
		$this->db->where_in("workshops_pics.workshop_id",$where); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('workshop', $data);
		return $this->db->insert_id();
	}
	public function insert_workshop_parts($data){
		$this->db->insert('workshops_specifications', $data);
		return $this->db->insert_id();
	}
	public function insert_workshop_pics($data){
		$this->db->insert('workshops_pics', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('workshop', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('workshop'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}
	public function delete_workshop_parts($where){
		$this->db->where($where);
		$this->db->delete('workshops_specifications'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}
	public function delete_workshop_pics($where){
		$this->db->where($where);
		$this->db->delete('workshops_pics'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir,$where = array())
    {
    	$this->db->select("workshop.*,produk.name as produk_name,area.name as area_name")->from("workshop"); 
		$this->db->join("produk","produk.id = workshop.merk","left");
		$this->db->join("area","area.id = workshop.area_id","left");
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
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

    function getCountAllBy($limit,$start,$search,$order,$dir,$where = array())
    {

    	$this->db->select("workshop.*,produk.name as produk_name,area.name as area_name")->from("workshop"); 
		$this->db->join("produk","produk.id = workshop.merk","left");
		$this->db->join("area","area.id = workshop.area_id","left");
    	 
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}  
    	$this->db->where($where);
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
