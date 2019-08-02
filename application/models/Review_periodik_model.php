<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Review_periodik_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("review_periodik.*,review_items.name as item_name")->from("review_periodik"); 
		$this->db->join("review_items","review_items.id=review_periodik.item_id");
		$this->db->where($where);  
		$this->db->group_by("driver_id,DATE_FORMAT(created_at, '%Y-%m-%d'),item_id");
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('review_periodik', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('review_periodik', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('review_periodik'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("review_periodik.*")->from("review_periodik");  
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
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

    	$this->db->select("review_periodik.*")->from("review_periodik"); 
    	 
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}  
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
