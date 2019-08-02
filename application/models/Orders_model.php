<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Orders_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
    public function getAllById($where = array()){
        $this->db->select("orders.*,user_contract_history.last_km")->from("orders");  
        $this->db->join("user_contract_history","user_contract_history.id =orders.pairing_id ");  
        $this->db->where($where);  
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }
	public function getAllTreatmentById($where = array()){
		$this->db->select("orders.*,maintenance.distance")->from("orders");  
        $this->db->join("maintenance","maintenance.id=orders.type");
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function getAllItemById($where = array()){
		$this->db->select("orders_item.*, parts.name as part_name")->from("orders_item");  
		$this->db->join("parts","parts.id=orders_item.part_id");
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('orders', $data);
		return $this->db->insert_id();
	}
	public function insertItem($data){
		$this->db->insert('orders_item', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('orders', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('orders'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

    function getAllBy($limit,$start,$search,$col,$dir,$where=array())
    {
        $this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian,users.first_name")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk");
        $this->db->join("users","users.id=orders.user_id");
        $this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
        $this->db->limit($limit,$start)->order_by($col,$dir) ;
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->like($key,$value);    
            }   
        }  
        $this->db->where($where); 

        $this->db->group_by("orders.unit_id");
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
        $this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk");
        $this->db->join("users","users.id=orders.user_id");
        $this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->like($key,$value);    
            }   
        }  
         
        $this->db->where($where);
        $this->db->group_by("orders.unit_id");
        $result = $this->db->get();
    
        return $result->num_rows();
    } 

    function getDetailWorkshopAllBy($limit,$start,$search,$col,$dir,$where=array())
    {
        $this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian,users.first_name")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk");
        $this->db->join("users","users.id=orders.user_id");
        $this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
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

    function getDetailWorkshopCountAllBy($limit,$start,$search,$order,$dir,$where=array())
    { 
        $this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk");
        $this->db->join("users","users.id=orders.user_id");
        $this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->like($key,$value);    
            }   
        }  
         
        $this->db->where($where); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
    function getAllDaruratBy($limit,$start,$search,$col,$dir,$where=array())
    {
        $this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian,users.first_name")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk");
        $this->db->join("users","users.id=orders.user_id");
        $this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
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

    function getCountAllDaruratBy($limit,$start,$search,$order,$dir,$where=array())
    { 
        $this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk");
        $this->db->join("users","users.id=orders.user_id");
        $this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
        }  
         
        $this->db->where($where); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
	function getAllWorkorderBy($limit,$start,$search,$col,$dir,$where=array())
    {
        $this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian,users.first_name")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk");
        $this->db->join("users","users.id=orders.user_id");
        $this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
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

    function getCountAllWorkorderBy($limit,$start,$search,$order,$dir,$where=array())
    { 
        $this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian,users.first_name")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk");
        $this->db->join("users","users.id=orders.user_id");
        $this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->like($key,$value);    
            }   
        }  
         
        $this->db->where($where); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
    function getAllRequestBy($limit,$start,$search,$col,$dir,$where=array())
    {
    	$this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian,users.first_name")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
    	$this->db->join("produk","produk.id=units.merk");
    	$this->db->join("users","users.id=orders.user_id");
    	$this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
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

    function getCountAllRequestBy($limit,$start,$search,$order,$dir,$where=array())
    { 
        $this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as model,units.no_police,units.years, units.varian")->from("orders");  
        $this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk");
        $this->db->join("users","users.id=orders.user_id");
        $this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}  
    	 
    	$this->db->where($where); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 

	function getAllDetailOrderBy($limit,$start,$search,$col,$dir,$where=array())
    {
    	$this->db->select("orders.*,workshop.name as workshop_name,produk.name as unit_merk,units.model as unit_model,units.no_police")->from("orders");  
    	$this->db->join("units","units.id=orders.unit_id");
        $this->db->join("produk","produk.id=units.merk"); 
    	$this->db->join("users","users.id=orders.user_id");
    	$this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
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

    function getCountAllDetailOrderBy($limit,$start,$search,$order,$dir,$where=array())
    { 
    	$this->db->select("orders.*, produk.name as unit_merk")->from("orders"); 
        $this->db->join("units","units.id=orders.unit_id");
    	$this->db->join("produk","produk.id=units.merk"); 
    	$this->db->join("users","users.id=orders.user_id");
    	$this->db->join("workshop","workshop.id=orders.workshop_id", 'left');
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}  

    	 
    	$this->db->where($where);
        $result = $this->db->get();
    
        return $result->num_rows();
    } 

    function getCDriverAllBy($limit,$start,$search,$order,$dir,$where=array())
    { 
		$this->db->select("users.*, role.name as role_name")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.user_id");
    	$this->db->join("role","role.id = users_roles.role_id"); 
        
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	} 
    	 $roles_default = array('2');
        $this->db->where_in('role.id', $roles_default); 
		$this->db->where("role.is_deleted",0); 
       	$result = $this->db->get();
         return $result->num_rows();
    } 

    function getDriverAllBy($limit,$start,$search,$col,$dir,$where=array())
    {
    	$this->db->select("users.*, role.name as role_name")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.user_id");
    	$this->db->join("role","role.id = users_roles.role_id"); 
        $this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	} 
    	 $roles_default = array('2');
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
}
