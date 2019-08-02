<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class User extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('ion_auth_model');
	}
	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->load->model("groups_model");
			$this->load->model("role_model");
			$this->data['groups'] = $this->groups_model->getAllById();
			$this->data['roles'] = $this->role_model->getAllById();
			$this->data['content'] = 'admin/user/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}


	public function create()
	{ 
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');    
		$this->form_validation->set_rules('department',"Jabatan Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('company',"Perusahaan Harus Diisi", 'trim|required'); 
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
				'active' => 0,
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'), 
				'nip' => $this->input->post('nip'),
				'department' => $this->input->post('department'),
				'company' => $this->input->post('company'),
				'address' => $this->input->post('address'),
				'photo' => $file_name
			); 
			$role = array(3);  
 			$username = $this->input->post('username');
 			$password = $this->input->post('password');
 			$email = $this->input->post('email');
			$insert = $this->ion_auth->register($username, $password, $email, $data,$role);
			if ($insert)
			{ 
				$this->session->set_flashdata('message', "User Baru Berhasil Disimpan");
				redirect("user");
			}
			else
			{
				$this->session->set_flashdata('message_error',$this->ion_auth->errors());
				redirect("user");
			}
		}else{   
			$this->load->model("role_model");
		 	$this->data['roles'] = $this->role_model->getAllById();
			$this->data['content'] = 'admin/user/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required');  
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');    
		$this->form_validation->set_rules('department',"Jabatan Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('company',"Perusahaan Harus Diisi", 'trim|required'); 
		   
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
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),  
				'department' => $this->input->post('department'),
				'company' => $this->input->post('company'),
				'address' => $this->input->post('address'),
				'password' => $this->input->post('password'),
				'photo' => $file_name
			); 
			$user_id = $this->input->post('id');
			$role_id = 3;
			$this->ion_auth->remove_from_group('', $user_id);
 			$this->ion_auth->add_to_group(array($role_id), $user_id);  
			$update = $this->ion_auth->update($user_id, $data);
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("user");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("user");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("user/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->user_model->getAllById(array("users.id"=>$this->data['id'])); 
				  
				$this->data['name'] =   (!empty($data))?$data[0]->first_name:"";
				$this->data['username'] =   (!empty($data))?$data[0]->username:"";
				$this->data['email'] =   (!empty($data))?$data[0]->email:""; 
				$this->data['phone'] =   (!empty($data))?$data[0]->phone:""; 
				$this->data['address'] =   (!empty($data))?$data[0]->address:"";  
				$this->data['department'] =   (!empty($data))?$data[0]->department:"";    
				$this->data['department_id'] =   (!empty($data))?$data[0]->department_id:"";    
				$this->data['company'] =   (!empty($data))?$data[0]->company:"";    
				$this->data['photo'] =   (!empty($data))?$data[0]->photo:"";    

				$this->load->model("role_model");
				$this->data['roles'] = $this->role_model->getAllById();
				$this->data['content'] = 'admin/user/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 
	public function view()
	{ 
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required');  
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');    
		$this->form_validation->set_rules('department',"Jabatan Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('company',"Perusahaan Harus Diisi", 'trim|required'); 
		   
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
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),  
				'department' => $this->input->post('department'),
				'company' => $this->input->post('company'),
				'address' => $this->input->post('address'),
				'password' => $this->input->post('password'),
				'photo' => $file_name
			); 
			$user_id = $this->input->post('id');
			$role_id = 3;
			$this->ion_auth->remove_from_group('', $user_id);
 			$this->ion_auth->add_to_group(array($role_id), $user_id);  
			$update = $this->ion_auth->update($user_id, $data);
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("user","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("user","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("user/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->user_model->getAllById(array("users.id"=>$this->data['id'])); 
				  
				$this->data['name'] =   (!empty($data))?$data[0]->first_name:"";
				$this->data['username'] =   (!empty($data))?$data[0]->username:"";
				$this->data['email'] =   (!empty($data))?$data[0]->email:""; 
				$this->data['phone'] =   (!empty($data))?$data[0]->phone:""; 
				$this->data['address'] =   (!empty($data))?$data[0]->address:"";  
				$this->data['department'] =   (!empty($data))?$data[0]->department:"";    
				$this->data['company'] =   (!empty($data))?$data[0]->company:"";    
				$this->data['photo'] =   (!empty($data))?$data[0]->photo:"";    

				$this->data['content'] = 'admin/user/view_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{
		$columns = array( 
            0 =>'id',  
      		1 =>'users.username', 
            2 =>'users.first_name',
            3 =>'users.department',
            4 =>'users.company',
            5 =>'users.phone',   
            6 => 'action'
        ); 
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->user_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        
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
         	$search['DATE_FORMAT(FROM_UNIXTIME(users.created_on), "%Y-%m-%d")'] = ($value);
        }  

    	if($isSearchColumn){
	        if(!empty($this->input->post('search')['value'])){
	        	$search_value = $this->input->post('search')['value'];
	           	$search = array( 
	           		"groups.id"=>$search_value
	           	); 
	      	}
           	$totalFiltered = $this->user_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->user_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     			$view_url = "";
     			$approve_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0  && $data->active == 1 ){
            		$edit_url = "<a href='".base_url()."user/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete'] && $data->active == 1){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."user/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."user/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		}  
        		}
            	
        		if($data->active == 0){

            		$approve_url = "<a href='#' 
	        				url='".base_url()."user/approve/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white approve' 
	        				 >Waiting Approval
	        				</a>";
        		}

            	$view_url = "<a href='".base_url()."user/view/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> View</a>";

                $nestedData['id'] = $start+$key+1; 
                $nestedData['username'] = $data->username;  
                $nestedData['department'] = $data->department;
                $nestedData['company'] = $data->company; 
                $nestedData['name'] = $data->first_name;
                $nestedData['phone'] = $data->phone; 
                $nestedData['email'] = $data->email;
                if(empty($data->photo)){
                	$nestedData['photo'] = ''; 	
                }else{
                	$photo = explode(".", $data->photo);
                	$nestedData['photo'] = "<img width='40px' src=".base_url()."assets/images/photo/thumbs/".$data->photo.">"; 
                }
           		$nestedData['action'] = $edit_url." ".$delete_url." ".$view_url." ".$approve_url;   
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
 			$this->load->model("user_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->user_model->update($data,array("id"=>$id));

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
 			$this->load->model("user_model");
			$data = array(
				'active' => ($active == 1)?0:1
			); 
			$update = $this->user_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
