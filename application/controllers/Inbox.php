<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Inbox extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->model('profile_model');
		$this->load->model('notification_model');
	 
	}  
	public function index()
	{ 
		 
		$role_id = $this->data['users_groups']->id;
		$this->data['all_notifications'] = $this->notification_model->getNotifications(array('to'=>$role_id));

		//get dispatcher tasks 
		if(!empty($this->data['all_notifications'])){
			foreach ($this->data['all_notifications'] as $key => $value) { 
				if ($value->category == "reminder") {
				 	$this->data['task_notifications'][] = $task; 
				} 
			}
		}
		$this->data['content'] = 'admin/inbox/list_v'; 
		$this->load->view('admin/layouts/page',$this->data); 
	}   

	public function setNotificationRead()
	{ 
		$response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();
  		$id = $this->uri->segment(3);
  		
  		if(!empty($id)){
 			$data = array(
				'is_read' => 1
			); 
	  		$result = $this->notification_model->update($data, array("id" => $id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 

	}   
}
