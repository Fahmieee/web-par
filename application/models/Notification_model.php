<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Notification_model extends CI_Model
{ 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getNotifications($where = array()){
		$this->db->select("notification.*, users.first_name");
		$this->db->from('notification');
		$this->db->join('users', 'users.id = notification.from');
		$this->db->where($where);
		$this->db->order_by('notification.created_at', 'desc');
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('notification', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('notification', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($where){
		$this->db->where($where);
		$this->db->delete('notification'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("*")->from("notification"); 
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

    	$this->db->select("*")->from("notification");  
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->like($key,$value);	
			} 	
    	}
		 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
