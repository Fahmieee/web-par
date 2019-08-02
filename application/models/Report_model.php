<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Report_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}   

    function getAllWorkshop($limit,$start,$search,$col,$dir,$where=array())
    {
        $this->db->select("workshop.* ")->from("workshop");   
        
        $this->db->join("area","area.id = workshop.area_id"); 
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

    function getAllCountWorkshop($limit,$start,$search,$order,$dir,$where=array())
    { 
        $this->db->select("workshop.* ")->from("workshop");  
        $this->db->join("area","area.id = workshop.area_id"); 
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->like($key,$value);    
            }   
        }  
         
        $this->db->where($where);
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
	function getTopWorkshop($limit,$start,$search,$col,$dir,$where=array())
    {
    	$this->db->select("COUNT(*) as jumlah_workshop,SUM(rating) as total_rating, workshop.*")->from("workshop");   
        $this->db->join("orders","workshop.id=orders.workshop_id","right");
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}  
        $this->db->where($where); 
        $this->db->where("workshop_id !=",0); 
    	$this->db->group_by("orders.workshop_id"); 
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

    function getTopCountWorkshop($limit,$start,$search,$order,$dir,$where=array())
    { 
        $this->db->select("COUNT(*) as jumlah_workshop,SUM(rating) as total_rating, workshop.*")->from("workshop");   
        $this->db->join("orders","workshop.id=orders.workshop_id","right");
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}  
        $this->db->where($where);
         $this->db->where("workshop_id !=",0); 
    	 $this->db->group_by("orders.workshop_id"); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
 
}
