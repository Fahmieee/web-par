<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Driver extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->model('driver_model');
		$this->load->model('ion_auth_model');
	}
	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->load->model("groups_model");
			$this->data['groups'] = $this->groups_model->getAllById();
			$this->data['content'] = 'admin/driver/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}


	public function create()
	{ 
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');     
		$this->form_validation->set_rules('nip',"NIP Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('username',"Username Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('password',"Password Harus Diisi", 'trim|required'); 
		 
		if ($this->form_validation->run() === TRUE)
		{
			$dir = './assets/images/photo';
			if (!is_dir($dir)) {  
			    mkdir($dir); 
			    $dirThumbs = './assets/images/photo/thumbs';
			 	mkdir($dirThumbs);    
			}else{
				$dirThumbs = './assets/images/photo/thumbs';
				if (!is_dir($dirThumbs)) {
				    mkdir($dirThumbs);         
				}
			}

			$file_name = "";
			$config['upload_path']          = './assets/images/photo';
			$config['allowed_types']        = '*'; 
	  		$config['file_name'] = time();

			$this->load->library('upload');
	      	$this->upload->initialize($config);
	      	if ($this->upload->do_upload('photo')){   
				$upload_data = $this->upload->data(); 
				$file_name = $config['file_name'].$upload_data['file_ext'];
	 			$source_path =$config['upload_path']."/".$file_name;
			   	$target_path =$config['upload_path'].'/thumbs/';
			    $config_manip = array(
			        'image_library' => 'gd2',
			        'source_image' => $source_path,
			        'new_image' => $target_path,
			        'maintain_ratio' => TRUE,
			        'create_thumb' => TRUE,
			        'thumb_marker' => '',
			        'width' => 100,
			        'height' => 100
			    );
			    $this->load->library('image_lib', $config_manip);
			    if (!$this->image_lib->resize()) { 
			        $response['message'] = $this->image_lib->display_errors();
			        $this->response($response,Restdata::HTTP_OK);
			    }else{
			    	$this->image_lib->clear(); 
		    	}  
		    }

			$data = array(
				'first_name' => $this->input->post('name'),
				'driver_type' => $this->input->post('driver_type'),
				'driver_sim_no' => $this->input->post('driver_sim_no'),
				'driver_sim_date' => $this->input->post('driver_sim_date'),
				'driver_sim_type' => $this->input->post('driver_sim_type'),
				'active' => 0,
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'), 
				'nip' => $this->input->post('nip'), 
				'nik' => $this->input->post('nik'), 
				'address' => $this->input->post('address'),
				'start_date_contract' => $this->input->post('start_date'),
				'end_date_contract' => $this->input->post('end_date'),
				'photo' => $file_name
			); 
			$role = array(2);  
 			$username = $this->input->post('username');
 			$password = $this->input->post('password');
 			$email = $this->input->post('email');
			$insert = $this->ion_auth->register($username, $password, $email, $data,$role);
			if ($insert)
			{ 

				sendBoNotification(1,"all", "New Driver","New Driver :".$this->input->post('name'),$insert,"DRIVER");
				$this->session->set_flashdata('message', "Driver Baru Berhasil Disimpan");
				redirect("driver");
			}
			else
			{
				$this->session->set_flashdata('message_error',$this->ion_auth->errors());
				redirect("driver");
			}
		}else{   
			$this->data['content'] = 'admin/driver/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required');  
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');     
		$this->form_validation->set_rules('nip',"NIP Harus Diisi", 'trim|required');   
		   
		if ($this->form_validation->run() === TRUE)
		{
			$dir = './assets/images/photo';
			if (!is_dir($dir)) {  
			    mkdir($dir); 
			    $dirThumbs = './assets/images/photo/thumbs';
			 	mkdir($dirThumbs);    
			}else{
				$dirThumbs = './assets/images/photo/thumbs';
				if (!is_dir($dirThumbs)) {
				    mkdir($dirThumbs);         
				}
			}

			$file_name = "";
			$config['upload_path']          = './assets/images/photo';
			$config['allowed_types']        = '*'; 
	  		$config['file_name'] = time();

			$this->load->library('upload');
	      	$this->upload->initialize($config);
	      	if ($this->upload->do_upload('photo')){   
				$upload_data = $this->upload->data(); 
				$file_name = $config['file_name'].$upload_data['file_ext'];
	 			$source_path =$config['upload_path']."/".$file_name;
			   	$target_path =$config['upload_path'].'/thumbs/';
			    $config_manip = array(
			        'image_library' => 'gd2',
			        'source_image' => $source_path,
			        'new_image' => $target_path,
			        'maintain_ratio' => TRUE,
			        'create_thumb' => TRUE,
			        'thumb_marker' => '',
			        'width' => 100,
			        'height' => 100
			    );
			    $this->load->library('image_lib', $config_manip);
			    if (!$this->image_lib->resize()) { 
			       $this->image_lib->display_errors();
			    }else{
			    	$this->image_lib->clear(); 
		    	}  
		    } 

			$data = array(
				'first_name' => $this->input->post('name'), 
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'), 
				'nip' => $this->input->post('nip'), 
				'nik' => $this->input->post('nik'), 
				'address' => $this->input->post('address'),
				'password' => $this->input->post('password'),
				'photo' => $file_name,
				'driver_type' => $this->input->post('driver_type'),
				'driver_sim_no' => $this->input->post('driver_sim_no'),
				'driver_sim_date' => $this->input->post('driver_sim_date'),
				'driver_sim_type' => $this->input->post('driver_sim_type'),
				'start_date_contract' => $this->input->post('start_date'),
				'end_date_contract' => $this->input->post('end_date'),
			); 
			$user_id = $this->input->post('id'); 
			$update = $this->ion_auth->update($user_id, $data);
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Driver Berhasil Di Ubah");
				redirect("driver","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Driver Gagal Di Ubah");
				redirect("driver","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("driver/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->driver_model->getAllById(array("users.id"=>$this->data['id']));  
				$this->data['name'] =   (!empty($data))?$data[0]->first_name:"";
				$this->data['username'] =   (!empty($data))?$data[0]->username:"";
				$this->data['email'] =   (!empty($data))?$data[0]->email:""; 
				$this->data['phone'] =   (!empty($data))?$data[0]->phone:""; 
				$this->data['address'] =   (!empty($data))?$data[0]->address:"";   
				$this->data['nip'] =   (!empty($data))?$data[0]->nip:"";  
				$this->data['nik'] =   (!empty($data))?$data[0]->nik:"";  
				$this->data['photo'] =   (!empty($data))?$data[0]->photo:"";
				$this->data['driver_type'] =   (!empty($data))?$data[0]->driver_type:"";
				$this->data['driver_sim_no'] =   (!empty($data))?$data[0]->driver_sim_no:"";
				$this->data['driver_sim_date'] =   (!empty($data))?$data[0]->driver_sim_date:"";
				$this->data['driver_sim_type'] =   (!empty($data))?$data[0]->driver_sim_type:"";
				$this->data['start_date_contract'] =   (!empty($data))?$data[0]->start_date_contract:"";
				$this->data['end_date_contract'] =   (!empty($data))?$data[0]->end_date_contract:"";
				$this->data['photo'] =   (!empty($data))?$data[0]->photo:"";
				$this->data['content'] = 'admin/driver/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 
	public function view()
	{ 
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required');  
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');     
		$this->form_validation->set_rules('nip',"NIP Harus Diisi", 'trim|required');   
		   
		if ($this->form_validation->run() === TRUE)
		{
			$dir = './assets/images/photo';
			if (!is_dir($dir)) {  
			    mkdir($dir); 
			    $dirThumbs = './assets/images/photo/thumbs';
			 	mkdir($dirThumbs);    
			}else{
				$dirThumbs = './assets/images/photo/thumbs';
				if (!is_dir($dirThumbs)) {
				    mkdir($dirThumbs);         
				}
			}

			$file_name = "";
			$config['upload_path']          = './assets/images/photo';
			$config['allowed_types']        = '*'; 
	  		$config['file_name'] = time();

			$this->load->library('upload');
	      	$this->upload->initialize($config);
	      	if ($this->upload->do_upload('photo')){   
				$upload_data = $this->upload->data(); 
				$file_name = $config['file_name'].$upload_data['file_ext'];
	 			$source_path =$config['upload_path']."/".$file_name;
			   	$target_path =$config['upload_path'].'/thumbs/';
			    $config_manip = array(
			        'image_library' => 'gd2',
			        'source_image' => $source_path,
			        'new_image' => $target_path,
			        'maintain_ratio' => TRUE,
			        'create_thumb' => TRUE,
			        'thumb_marker' => '',
			        'width' => 100,
			        'height' => 100
			    );
			    $this->load->library('image_lib', $config_manip);
			    if (!$this->image_lib->resize()) { 
			       $this->image_lib->display_errors();
			    }else{
			    	$this->image_lib->clear(); 
		    	}  
		    }

			$data = array(
				'first_name' => $this->input->post('name'), 
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'), 
				'nip' => $this->input->post('nip'), 
				'address' => $this->input->post('address'),
				'password' => $this->input->post('password'),
				'photo' => $file_name,
				'driver_type' => $this->input->post('driver_type'),
				'driver_sim_no' => $this->input->post('driver_sim_no'),
				'driver_sim_date' => $this->input->post('driver_sim_date'),
				'driver_sim_type' => $this->input->post('driver_sim_type')
			); 
			$user_id = $this->input->post('id'); 
			$update = $this->ion_auth->update($user_id, $data);
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Driver Berhasil Di Ubah");
				redirect("driver","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Driver Gagal Di Ubah");
				redirect("driver","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("driver/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->driver_model->getAllById(array("users.id"=>$this->data['id']));  
				$this->data['name'] =   (!empty($data))?$data[0]->first_name:"";
				$this->data['username'] =   (!empty($data))?$data[0]->username:"";
				$this->data['email'] =   (!empty($data))?$data[0]->email:""; 
				$this->data['phone'] =   (!empty($data))?$data[0]->phone:""; 
				$this->data['address'] =   (!empty($data))?$data[0]->address:"";   
				$this->data['nip'] =   (!empty($data))?$data[0]->nip:"";  
				$this->data['nik'] =   (!empty($data))?$data[0]->nik:"";  
				$this->data['photo'] =   (!empty($data))?$data[0]->photo:"";
				$this->data['driver_type'] =   (!empty($data))?$data[0]->driver_type:"";
				$this->data['driver_sim_no'] =   (!empty($data))?$data[0]->driver_sim_no:"";
				$this->data['driver_sim_date'] =   (!empty($data))?$data[0]->driver_sim_date:"";
				$this->data['driver_sim_type'] =   (!empty($data))?$data[0]->driver_sim_type:"";
				$this->data['start_date_contract'] =   (!empty($data))?$data[0]->start_date_contract:"";
				$this->data['end_date_contract'] =   (!empty($data))?$data[0]->end_date_contract:"";
				$this->data['photo'] =   (!empty($data))?$data[0]->photo:"";
				$this->data['content'] = 'admin/driver/view_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{
		$this->load->model("review_spot_model");
		$this->load->model("review_periodik_model");
		$columns = array( 
            0 =>'id',  
      		1 =>'users.username',
            2 =>'users.first_name',
            3 =>'users.address',
            4 =>'users.phone',
            5 =>'users.created_on', 
            6 =>'users.driver_type', 
            7 => 'rating',
            7 => 'action'
        ); 
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->driver_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        
        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        if(!empty($searchColumn[1]['search']['value'])){
        	$value = $searchColumn[1]['search']['value'];
        	$isSearchColumn = true;
         	$search['users.username'] = $value;
        }  
         if(!empty($searchColumn[2]['search']['value'])){
        	$value = $searchColumn[2]['search']['value'];
        	$isSearchColumn = true;
         	$search['users.first_name'] = $value;
        }  

        if(!empty($searchColumn[3]['search']['value'])){
        	$value = $searchColumn[3]['search']['value'];
        	$isSearchColumn = true;
         	$search['users.phone'] = $value;
        } 
        if(!empty($searchColumn[4]['search']['value'])){
        	$value = $searchColumn[4]['search']['value'];
        	$isSearchColumn = true;
         	$search['users.driver_type'] = $value;
        } 
 

    	if($isSearchColumn){ 
           	$totalFiltered = $this->driver_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->driver_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     			$approve_url = "";
     			$view_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0 && $data->active == 1){
            		$edit_url = "<a href='".base_url()."driver/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete'] && $data->active == 1){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."driver/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."driver/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		}  
        		}

        		if( $data->active == 0){
        			$approve_url = "<a href='#' 
	        				url='".base_url()."driver/approve/".$data->id."'
	        				class='btn btn-sm white approve' 
	        				 >Waiting Approval
	        				</a>";
        		}

        		$view_url = "<a  href='".base_url()."driver/view/".$data->id."'
	        				class='btn btn-sm white' 
	        				 >View
	        				</a>";

	        				//COUNTING RATING
             	$where = array("driver_id"=>$data->id);  
		      	$review_periodik = $this->review_periodik_model->getAllById($where);
		      	$review_spot = $this->review_spot_model->getAllById($where);
		      	$akumulasirating = 0;
		      	$jumlahrating = 0;
		      	if(!empty($review_periodik)){
		         	foreach ($review_periodik as  $value) {
			          	$akumulasirating += $value->rating;
			          	$jumlahrating++;
		        	}
		      	}
		      	if(!empty($review_spot)){
		        	foreach ($review_spot as $value) {
			          	$akumulasirating += $value->rating;
			          	$jumlahrating++;
		        	}
		      	}

		      	if($jumlahrating == 0){
		        	$rata_rating = 0;
		      	}else{
		        	$rata_rating = $akumulasirating/$jumlahrating;  
		      	}

		      	$rating = "";
	          	$jumlah_rating = 5;
	          	for ($i=0; $i < $jumlah_rating ; $i++) {  
		            if($i < $rata_rating){
		               $rating .= '<span class="fa fa-star checked"></span>'; 
		            }else{  
		               $rating .=' <span class="fa fa-star"></span>';
		            }  
	          	}

                $nestedData['id'] = $start+$key+1;  
                $nestedData['username'] = $data->username;
                $nestedData['driver_type'] = ($data->driver_type == 1)?"POOL":"DEDICATED";
                $nestedData['name'] = $data->first_name;
                $nestedData['address'] = $data->address;
                $nestedData['phone'] = $data->phone; 
                $nestedData['created_on'] = date("Y-m-d",$data->created_on);
                $nestedData['rating'] = $rating; 
           		$nestedData['action'] = $edit_url." ".$delete_url." ".$approve_url." ".$view_url;   
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
 			$this->load->model("driver_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->driver_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
	public function approve(){
		$response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();   

		$id =$this->uri->segment(3);
		$active = $this->uri->segment(4);
 		if(!empty($id)){
 			$this->load->model("driver_model");
			$data = array(
				'active' => ($active == 1)?0:1
			); 
			$update = $this->driver_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
