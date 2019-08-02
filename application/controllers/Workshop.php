<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Workshop extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('workshop_model');
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/workshop/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}

		$workshops = $this->workshop_model->getAllById();
		$rekanan = 0;
		$non_rekanan = 0;
		if(!empty($workshops)){
			foreach ($workshops as $key => $value) {
			 	if($value->type == 1) $rekanan++;
			 	else $non_rekanan++;
			}
		}
		
		$this->data['jumlah_rekanan'] =  $rekanan;
		$this->data['jumlah_non_rekanan'] =  $non_rekanan;

		$this->load->view('admin/layouts/page',$this->data);  
	}
	public function map()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/workshop/map_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}

		$workshops = $this->workshop_model->getAllById(); 
		$new_data = array();
		foreach ($workshops as $key => $value) {
			$new = new stdClass();
			$new->lat = $value->lat;
			$new->long = $value->long;
			$new->produk_name = $value->produk_name;
			$new->name = $value->name;
			$new_data[] = $new;
		}
		$this->data['workshops'] =  $new_data; 

		$this->load->view('admin/layouts/page',$this->data);  
	}

	public function create()
	{ 
		$this->form_validation->set_rules('code',"Code Is Required", 'trim|required'); 
		$this->form_validation->set_rules('name',"Name Is Required", 'trim|required');  

		if ($this->form_validation->run() === TRUE)
		{  

			$data = array(
				'code' => $this->input->post('code'),
				'name' => $this->input->post('name'), 
				'phone_number' => $this->input->post('phone_number'), 
				'area_id' => $this->input->post('area_id'), 
				'city_id' => $this->input->post('city_id'), 
				'address' => $this->input->post('address'), 
				'lat' => $this->input->post('lat'), 
				'long' => $this->input->post('long'), 
				'merk' => $this->input->post('merk'),
				'type' => $this->input->post('rekanan')
			); 
			 
			$insert_workshop = $this->workshop_model->insert($data); 
			if ($insert_workshop)
			{ 

				$parts = $this->input->post('parts');
				if(!empty($parts)){
					foreach ($parts as $key => $value) { 
						$data_parts = array(
							'workshop_id' => $insert_workshop,
							'specification_id' => $value, 
						);
						$insert_workshop_parts = $this->workshop_model->insert_workshop_parts($data_parts); 
					} 
				}
				
				$pic_names = $this->input->post('pic_name');
				$pic_phones = $this->input->post('pic_phone');
				$pic_emails = $this->input->post('pic_email');
				$pic_cs = $this->input->post('pic_cs'); 
				if(!empty($pic_names)){ 
			 		foreach ($pic_names as $key => $pic) {
			 			if($pic_names[$key] !== "" && $pic_phones[$key] !== ""){ 
						 	$data_pic = array(
						 		"workshop_id"=>$insert_workshop, 
						 		"name"=>$pic_names[$key], 
						 		"phone"=>$pic_phones[$key],
						 		"email"=>$pic_emails[$key],
						 		"is_cs"=>$pic_cs[$key],
						 	);
					  		$insert_workshop_pics = $this->workshop_model->insert_workshop_pics($data_pic); 
						}
						
				 	}
				}
				$nama_bengkel =  $this->input->post('name');
				$is_rekanan =  $this->input->post('rekanan');
				if($is_rekanan == 1){
					sendBoNotification(1,"all", "New Bengkel Rekanan","Nama Bengkel :".$nama_bengkel,$insert_workshop,"WORKSHOP");
				}else{
					sendBoNotification(1,"all", "New Bengkel Non Rekanan","Nama Bengkel :".$nama_bengkel,$insert_workshop,"WORKSHOP");	
				}
				
				$this->session->set_flashdata('message', "Success Create workshop");
				redirect("workshop");
			}
			else
			{

				$this->session->set_flashdata('message_error',"Failed Create workshop");
				redirect("workshop");
			}
		}else{   
			if(!empty($_POST)){  
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("workshop/create");	
			}else{ 
				$this->load->model("Produk_model");
 				$this->data['merk_units'] = $this->Produk_model->getAllById();

				$this->load->model('parts_model');
				$this->data['parts'] = $this->parts_model->getAllById();
				$this->load->model('city_model');
				$this->data['cities'] = $this->city_model->getAllById();
				$this->load->model('area_model');
				$this->data['areas'] = $this->area_model->getAllById();

				$this->data['content'] = 'admin/workshop/create_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('code', "Code Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('name', "Name Harus Diisi", 'trim|required'); 
		   
		if ($this->form_validation->run() === TRUE)
		{
			$id = $this->input->post('id');  
		 
			$data = array(
				'code' => $this->input->post('code'),
				'name' => $this->input->post('name'), 
				'phone_number' => $this->input->post('phone_number'), 
				'area_id' => $this->input->post('area_id'), 
				'city_id' => $this->input->post('city_id'), 
				'address' => $this->input->post('address'), 
				'lat' => $this->input->post('lat'), 
				'long' => $this->input->post('long'), 
				'merk' => $this->input->post('merk'),
				'type' => $this->input->post('rekanan')
			);  
			$update = $this->workshop_model->update($data,array("workshop.id"=>$this->input->post('id')));
			  
			//ADD & REMOVE WORKSHOP PARTS
			$delete_workshop_parts = $this->workshop_model->delete_workshop_parts(array("workshop_id"=>$id)); 

			$parts = $this->input->post('parts');
			foreach ($parts as $key => $value) { 
				$data_parts = array(
					'workshop_id' => $id,
					'specification_id' => $value, 
				); 
				$insert_workshop_parts = $this->workshop_model->insert_workshop_parts($data_parts); 
			} 

			//ADD & REMOVE WORKSHOP PIC
			$delete_workshop_pics = $this->workshop_model->delete_workshop_pics(array("workshop_id"=>$id));  

			$pic_names = $this->input->post('pic_name');
			$pic_phones = $this->input->post('pic_phone');
			$pic_emails = $this->input->post('pic_email');
			$pic_cs = $this->input->post('pic_cs'); 
	 		foreach ($pic_names as $key => $pic) {
	 			if($pic_names[$key] !== "" && $pic_phones[$key] !== ""){ 
				 	$data_pic = array(
				 		"workshop_id"=>$id, 
				 		"name"=>$pic_names[$key], 
				 		"phone"=>$pic_phones[$key],
				 		"email"=>$pic_emails[$key],
				 		"is_cs"=>$pic_cs[$key],
				 	);
	 			}

			  	$insert_workshop_pics = $this->workshop_model->insert_workshop_pics($data_pic); 
		 	} 

 			$this->session->set_flashdata('message',"Update Workshop Berhasil");
	 		redirect("workshop");
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("workshop/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->workshop_model->getAllById(array("workshop.id"=>$this->data['id'])); 


				$this->load->model('parts_model');
				$this->data['parts'] = $this->parts_model->getAllById();
				$this->load->model('city_model');
				$this->data['cities'] = $this->city_model->getAllById();
				$this->load->model('area_model');
				$this->data['areas'] = $this->area_model->getAllById();

				$this->load->model('workshop_model');
				$this->data['workshop_parts'] = $this->workshop_model->getWorkshopParts(array("workshop.id"=>$this->data['id'])); 

				$this->data['workshop_pics'] = $this->workshop_model->getWorkshopPICs(array("workshop.id"=>$this->data['id']));  

				$this->load->model("Produk_model");
 				$this->data['merk_units'] = $this->Produk_model->getAllById();
			 
				$this->data['code'] =   (!empty($data))?$data[0]->code:"";
				$this->data['name'] =   (!empty($data))?$data[0]->name:""; 
				$this->data['phone_number'] =   (!empty($data))?$data[0]->phone_number:""; 
				$this->data['area_id'] =   (!empty($data))?$data[0]->area_id:""; 
				$this->data['city_id'] =   (!empty($data))?$data[0]->city_id:""; 
				$this->data['address'] =   (!empty($data))?$data[0]->address:""; 
				$this->data['lat'] =   (!empty($data))?$data[0]->lat:""; 
				$this->data['long'] =   (!empty($data))?$data[0]->long:""; 
				$this->data['description'] =   (!empty($data))?$data[0]->description:"";  
				$this->data['rekanan'] =   (!empty($data))?$data[0]->type:"";  
				$this->data['merk'] =   (!empty($data))?$data[0]->merk:"";  
				
				$this->data['content'] = 'admin/workshop/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function detail()
	{ 
		$this->form_validation->set_rules('code', "Code Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('name', "Name Harus Diisi", 'trim|required'); 
		   
		 
		if(!empty($_POST)){ 
			$id = $this->input->post('id'); 
			$this->session->set_flashdata('message_error',validation_errors());
			return redirect("workshop/edit/".$id);	
		}else{
			$this->data['id']= $this->uri->segment(3);
			$data = $this->workshop_model->getAllById(array("workshop.id"=>$this->data['id'])); 


			$this->load->model('parts_model');
			$this->data['parts'] = $this->parts_model->getAllById();
			$this->load->model('city_model');
			$this->data['cities'] = $this->city_model->getAllById();
			$this->load->model('area_model');
			$this->data['areas'] = $this->area_model->getAllById();

			$this->load->model('workshop_model');
			$this->data['workshop_parts'] = $this->workshop_model->getWorkshopParts(array("workshop.id"=>$this->data['id'])); 

			$this->data['workshop_pics'] = $this->workshop_model->getWorkshopPICs(array("workshop.id"=>$this->data['id']));  
		 
			$this->data['code'] =   (!empty($data))?$data[0]->code:"";
			$this->data['name'] =   (!empty($data))?$data[0]->name:""; 
			$this->data['phone_number'] =   (!empty($data))?$data[0]->phone_number:""; 
			$this->data['area_id'] =   (!empty($data))?$data[0]->area_id:""; 
			$this->data['city_id'] =   (!empty($data))?$data[0]->city_id:""; 
			$this->data['address'] =   (!empty($data))?$data[0]->address:""; 
			$this->data['lat'] =   (!empty($data))?$data[0]->lat:""; 
			$this->data['long'] =   (!empty($data))?$data[0]->long:""; 
			$this->data['description'] =   (!empty($data))?$data[0]->description:"";  
			$this->data['rekanan'] =   (!empty($data))?$data[0]->type:"";  
			$this->data['produk_name'] =   (!empty($data))?$data[0]->produk_name:"";  
			
			$this->data['content'] = 'admin/workshop/detail_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}  
	    
		
	} 

	public function dataList()
	{
		 $columns = array( 
            0 =>'id', 
            1 =>'workshop.code',
            2=> 'workshop.name', 
            3=> 'workshop.address', 
            4=> 'workshop.phone_number', 
            5=> 'workshop.lat', 
            6=> 'workshop.long',  
            7=> 'action'
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$where = array();
  		$limit = 0;
  		$start = 0;
  		$isSearchColumn = false;
  	 	$searchColumn = $this->input->post('columns');
        $totalData = $this->workshop_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        
        if(!empty($searchColumn[1]['search']['value'])){
        	$value = $searchColumn[1]['search']['value'];
        	$isSearchColumn = true;
         	$search['workshop.type'] = $value;
        }

        if(!empty($searchColumn[2]['search']['value'])){
        	$value = $searchColumn[2]['search']['value'];
        	$isSearchColumn = true;
         	$search['workshop.name'] = $value;
        } 

    	if(!empty($searchColumn[3]['search']['value'])){
        	$value = $searchColumn[3]['search']['value'];
        	$isSearchColumn = true;
         	$search['area.name'] = $value;
        } 


       	if($isSearchColumn){ 
           	$totalFiltered = $this->workshop_model->getCountAllBy($limit,$start,$search,$order,$dir,$where); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->workshop_model->getAllBy($limit,$start,$search,$order,$dir);
     	$this->load->model("workshop_model");

        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     			$view_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."workshop/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."workshop/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."workshop/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		} 
        		} 
            	
            	$view_url = "<a  href='".base_url()."workshop/detail/".$data->id."'
	        				class='btn btn-sm white' 
	        				 >View
	        				</a>";
            	

                $nestedData['id'] = $start+$key+1;
                $nestedData['code'] = $data->code;
                $nestedData['name'] = $data->name; 
                $nestedData['address'] = $data->address; 
                $nestedData['phone_number'] = $data->phone_number; 
                $nestedData['lat'] = number_format($data->lat,5,".",''); 
                $nestedData['long'] = number_format($data->long,5,".",'');  

                $workshop_pics = $this->workshop_model->getWorkshopPICs(array("workshop.id"=>$data->id)); 

                $name = "";
                $phone = "";
                $i = 1;
                if(!empty($workshop_pics)){
                	foreach ($workshop_pics as $key => $value) {
	                 	$name .= $i.". ".$value->name."<br>";
	                 	$phone .= $i.". ".$value->phone."<br>";
	                	$i++;
	                } 
                }
               

                $nestedData['pic_name'] = $name; 
                $nestedData['pic_phone'] = $phone;  
           		$nestedData['action'] = $edit_url." ".$delete_url." ".$view_url;   
                $new_data[] = $nestedData; 
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $new_data   
                    );
            
        echo json_encode($json_data); 
	}
	public function destroy(){
		$response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();   

		$id =$this->uri->segment(3);
		$is_deleted = $this->uri->segment(4);
 		if(!empty($id)){
 			$this->load->model("workshop_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->workshop_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
	public function accept_order(){
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/workshop/accept_order'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		} 

		$this->data['success'] = true;
	 	$workshop_id = $this->uri->segment(3);
		$user_id =$this->uri->segment(4);
		$token = $this->uri->segment(5);
 		if(!empty($user_id) && !empty($workshop_id) && !empty($token)){
 			$this->load->model("workshop_model");
 			$this->load->model("user_model");
			$data = array(
				'user_id' => $user_id,
				'workshop_id' => $workshop_id
			); 
			// $update = $this->workshop_model->update($data,array("id"=>$id));
			$data_user = $this->user_model->getAllById(array("users.id"=>$user_id)); 
			$data_workshop = $this->workshop_model->getAllById(array("id"=>$workshop_id)); 
			if(!empty($data_workshop)){ 
	         	sendNotification(
	         		$data_user[0]->fcm_token,
	         		"Order Anda Sudah Diterima", 
	         		"Oleh ".$data_workshop[0]->name, 
	         		"ACCEPT_ORDER", 
	         		"FCM_PLUGIN_ACTIVITY"
	         	); 
	         	
				$this->load->view('front/accept_order',$this->data);
			}else{ 
				die();
				// redirect("login");
			}
 		} 
	}
}
