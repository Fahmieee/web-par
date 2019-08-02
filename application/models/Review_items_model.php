<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Review_items_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("review_items.*")->from("review_items");  
		$this->db->where($where); 
		$this->db->where("review_items.is_deleted",0); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('review_items', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('review_items', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('review_items'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("review_items.*")->from("review_items");  
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

    	$this->db->select("review_items.*")->from("review_items"); 
    	 
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
    	}  
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
