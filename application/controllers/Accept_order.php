<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Accept_order extends CI_Controller {
 	public function __construct()
	{
		parent::__construct();  
	}  
	public function accept(){

		$this->form_validation->set_rules('est_biaya_part',"Estimasi Biaya Part Harus Diisi", 'trim|required');   
		$this->form_validation->set_rules('est_biaya_jasa',"Estimasi Biaya Jasa Harus Diisi", 'trim|required');   
		$this->form_validation->set_rules('est_biaya_maintenance',"Estimasi Biaya Maintenance Harus Diisi", 'trim|required');   
		// $this->form_validation->set_rules('photo',"Bukti Estimasi Harus Diisi", 'trim|required');   

		if ($this->form_validation->run() === TRUE)
		{ 
			$est_biaya_part = $this->input->post('est_biaya_part'); 
			$est_biaya_jasa = $this->input->post('est_biaya_jasa'); 
			$est_biaya_maintenance = $this->input->post('est_biaya_maintenance'); 
			$workshop_id = $this->input->post('workshop_id'); 
			$user_id = $this->input->post('user_id'); 
			$service_type = $this->input->post('service_type'); 
			$type = $this->input->post('type'); 
			$token = $this->input->post('token'); 
		 	$this->load->model("workshop_model");
 			$this->load->model("user_model");
 			$this->load->model("driver_model");
 			$this->load->model("orders_model");
 			$this->load->model("scheduler_model");
 			$this->load->model("maintenance_model");
 			$this->load->model("preorders_model");
			$data = array(
				'user_id' => $user_id,
				'workshop_id' => $workshop_id
			);  

			$data_workshop = $this->workshop_model->getAllById(array("workshop.id"=>$workshop_id)); 
			$response['workshop_id'] = $workshop_id;
 			$response['user_id'] = $user_id;
 			$response['service_type'] = $service_type;
 			$response['type'] = $type;
 			$response['token'] = $token;

 			$where_token = array("orders.token"=>$token);
	 		$data_order_token = $this->orders_model->getAllById($where_token); 

	 		if(empty($data_order_token)){
	 			if(!empty($data_workshop)){  
		         	$data_order = $this->orders_model->getAllById();  

		     		$data_role = $this->ion_auth->get_users_groups($user_id)->row(); 
	            	$role_id = $data_role->id;
	            	if($role_id == 2){
		               	$where = array(
			         		"driver_id"=>$user_id,
			         		"DATE(start_date) <="=>date('Y-m-d'),
			                "DATE(end_date) >="=>date('Y-m-d')
			         	);
			         	$data_user = $this->driver_model->getAllById(array("users.id"=>$user_id)); 
		            }else{
						$where = array(
			         		"user_id"=>$user_id,
			         		"DATE(start_date) <="=>date('Y-m-d'),
			                "DATE(end_date) >="=>date('Y-m-d')
		         		);
		         		$data_user = $this->user_model->getAllById(array("users.id"=>$user_id)); 
		            }
		         	  
		         	if(!empty($data_order)){
						$order_no = "PAR - ".str_pad(count($data_order)+1, 5, "0", STR_PAD_LEFT)."/".date('dmY');
		         		
		         	}else{
		         		$order_no = "PAR - ".str_pad(1, 5, "0", STR_PAD_LEFT)."/".date('dmY');
		         	}  

		            $preorders = $this->preorders_model->getAllById(array("preorders.token"=>$token));
		        	date_default_timezone_set("Asia/Jakarta");
		        	$dir = './assets/images/bukti_estimasi';
					if (!is_dir($dir)) {  
					    mkdir($dir); 
					    $dirThumbs = $dir . '/thumbs';
					 	mkdir($dirThumbs);    
					}else{
					    $dirThumbs = $dir . '/thumbs';
						if (!is_dir($dirThumbs)) {
						    mkdir($dirThumbs);         
						}
					}

					$file_name = "";
					$config['upload_path']          = $dir;
					$config['allowed_types']        = '*'; 
			  		$config['file_name'] = time();

					$this->load->library('upload');
			      	$this->upload->initialize($config);
			      	if ($this->upload->do_upload('photo')){   
						$upload_data = $this->upload->data(); 
						$file_name = $config['file_name'].$upload_data['file_ext'];
				    }
		        	$data = array(
		                'service_type' =>$service_type, 
		                'type' =>$type, 
		                'pairing_id' =>$preorders[0]->pairing_id, 
		                'order_no' => $order_no, 
		                'order_date' => $preorders[0]->order_date, 
		                'unit_id' => $preorders[0]->unit_id, 
		                'user_id' => $user_id,
		                'workshop_id' => $workshop_id,
		                'est_biaya_part' => $est_biaya_part,
		                'est_biaya_jasa' => $est_biaya_jasa,
		                'est_biaya_maintenance' => $est_biaya_maintenance,
		                'file' => $file_name,
		                'token' => $token,
		                'is_booking' => $preorders[0]->is_booking,
		                'distance' => $preorders[0]->distance,
		                'status'=>1,
		                'description' => ""
		            ); 
		          	$insert = $this->orders_model->insert($data);
		         	if($insert){

		         		sendBoNotification(1,"all", "Order maintenance baru ","Order No :".$order_no,$insert,"ORDER");
		         		
		         		$data_maintenance = $this->maintenance_model->getAllMaintenanceParts(
		         			array("maintenance_id"=>$type));
	         			foreach ($data_maintenance as $key => $value) {
		         			$data = array(
				                'order_id' =>$insert, 
				                'part_id' => $value->part_id,
				                'status'=>0
			            	); 
		          			$insert_item = $this->orders_model->insertItem($data);
		          		}
		          		
		          		$preorders_items = $this->preorders_model->getAllItemById(
		          			array(
		          				"preorders_item.status"=>1,
		          				"preorders_item.preorder_id"=>$preorders[0]->id
		          			)
		          		);
		          		if(!empty($preorders_items)){ 
			         		foreach ($preorders_items as $key => $value) {
			         			$data = array(
					                'order_id' =>$insert, 
					                'part_id' => $value->part_id,
					                'status'=>$value->status,
					                'file'=>$value->file
				            	);
				          		$insert_item2 = $this->orders_model->insertItem($data);
	         				}
		          		}



		         		$update_preorders = $this->preorders_model->update(array("status"=>1),array("token"=>$token));
		         		$data_send = array(
		         			"order_id"=>$insert,
		         			"user_id"=>$user_id,
		         			"distance"=>12,
		         			"service_type"=>$service_type
		         		);
		         		sendNotification(
			         		$data_user[0]->fcm_token,
			         		$order_no, 
			         		"Order Anda Sudah Diterima Oleh ".$data_workshop[0]->name, 
			         		"ACCEPT_ORDER", 
			         		"FCM_PLUGIN_ACTIVITY",
			         		$data_send
			         	); 
		         	}
		         	$this->session->set_flashdata('message',"Berhasil Menyimpan Estimasi");
					redirect('accept_order/accept/'.$workshop_id.'/'.$user_id.'/'.$token.'/'.$service_type.'/'.$type,'refresh');
				}else{
					$this->session->set_flashdata('message_error',"Gagal Menyimpan Estimasi");
					redirect('accept_order/accept/'.$workshop_id.'/'.$user_id.'/'.$token.'/'.$service_type.'/'.$type,'refresh');
				}
	 		}else{ 
			 	$this->session->set_flashdata('message_error',"Token Sudah Ada");
					redirect('accept_order/accept/'.$workshop_id.'/'.$user_id.'/'.$token.'/'.$service_type.'/'.$type,'refresh'); 
	 		}
			
		}else{   
			$this->load->helper('url');
	 		$response['content'] = 'admin/workshop/accept_order'; 	 
			 
		 	$workshop_id = $this->uri->segment(3);
			$user_id =$this->uri->segment(4);
			$token = $this->uri->segment(5);
			$service_type = $this->uri->segment(6);
			$type = $this->uri->segment(7);

	 		if(!empty($user_id) && !empty($workshop_id) && !empty($token)){
	 		
	 			$response['workshop_id'] = $workshop_id;
	 			$response['user_id'] = $user_id;
	 			$response['service_type'] = $service_type;
	 			$response['type'] = $type;
	 			$response['token'] = $token;
				$this->load->view('front/accept_order',$response);
	 		} 
		}
		
	}
}
