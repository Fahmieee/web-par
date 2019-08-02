<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Employee extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->model('employee_model');
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
			$this->data['content'] = 'admin/employee/list_v'; 	
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
		$this->form_validation->set_rules('role_id',"Role Harus Diisi", 'trim|required');
		 
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
				'active' => 1,
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'), 
				'nip' => $this->input->post('nip'),
				'department' => $this->input->post('department'),
				'address' => $this->input->post('address'),
				'photo' => $file_name
			); 
			$role = array($this->input->post('role_id'));  
 			$username = $this->input->post('username');
 			$password = $this->input->post('password');
 			$email = $this->input->post('email');
			$insert = $this->ion_auth->register($username, $password, $email, $data,$role);
			if ($insert)
			{ 
				$this->session->set_flashdata('message', "Karyawan Baru Berhasil Disimpan");
				redirect("employee");
			}
			else
			{
				$this->session->set_flashdata('message_error',$this->ion_auth->errors());
				redirect("employee");
			}
		}else{  
			$this->load->model("area_model");
			$this->data['areas'] = $this->area_model->getAllById();
			$this->data['content'] = 'admin/employee/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required');  
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');     
		$this->form_validation->set_rules('nip',"NIP Harus Diisi", 'trim|required');  
		$this->form_validation->set_rules('role_id',"Role Harus Diisi", 'trim|required');
		   
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
				// 'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'), 
				'nip' => $this->input->post('nip'),
				'department' => $this->input->post('department'),
				'address' => $this->input->post('address'),
				'password' => $this->input->post('password'),
				'photo' => $file_name
			); 
			$user_id = $this->input->post('id');
			$role_id = $this->input->post('role_id');
			$this->ion_auth->remove_from_group('', $user_id);
 			$this->ion_auth->add_to_group(array($role_id), $user_id);  
			$update = $this->ion_auth->update($user_id, $data);
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("employee","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("employee","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("employee/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->employee_model->getAllById(array("users.id"=>$this->data['id'])); 
				 
				$this->load->model("area_model");
				$this->data['areas'] = $this->area_model->getAllById();
				$this->data['name'] =   (!empty($data))?$data[0]->first_name:"";
				$this->data['username'] =   (!empty($data))?$data[0]->username:"";
				$this->data['email'] =   (!empty($data))?$data[0]->email:""; 
				$this->data['phone'] =   (!empty($data))?$data[0]->phone:""; 
				$this->data['address'] =   (!empty($data))?$data[0]->address:"";  
				$this->data['department'] =   (!empty($data))?$data[0]->department:""; 
				$this->data['nip'] =   (!empty($data))?$data[0]->nip:""; 
				$this->data['area_id'] =   (!empty($data))?$data[0]->area_id:""; 
				$this->data['group_id'] =   (!empty($data))?$data[0]->group_id:""; 
				$this->data['role_id'] =   (!empty($data))?$data[0]->role_id:""; 
				$this->data['photo'] =   (!empty($data))?$data[0]->photo:"";

				$this->data['content'] = 'admin/employee/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function detail()
	{ 
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required');  
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');     
		$this->form_validation->set_rules('nip',"NIP Harus Diisi", 'trim|required');  
		$this->form_validation->set_rules('role_id',"Role Harus Diisi", 'trim|required');
		 
		if(!empty($_POST)){ 
			$id = $this->input->post('id'); 
			$this->session->set_flashdata('message_error',validation_errors());
			return redirect("employee/edit/".$id);	
		}else{
			$this->data['id']= $this->uri->segment(3);
			$data = $this->employee_model->getAllById(array("users.id"=>$this->data['id'])); 
			 
			$this->load->model("area_model");
			$this->data['areas'] = $this->area_model->getAllById();
			$this->data['name'] =   (!empty($data))?$data[0]->first_name:"";
			$this->data['username'] =   (!empty($data))?$data[0]->username:"";
			$this->data['email'] =   (!empty($data))?$data[0]->email:""; 
			$this->data['phone'] =   (!empty($data))?$data[0]->phone:""; 
			$this->data['address'] =   (!empty($data))?$data[0]->address:"";  
			$this->data['department'] =   (!empty($data))?$data[0]->department:""; 
			$this->data['nip'] =   (!empty($data))?$data[0]->nip:""; 
			$this->data['area_id'] =   (!empty($data))?$data[0]->area_id:""; 
			$this->data['group_id'] =   (!empty($data))?$data[0]->group_id:""; 
			$this->data['role_id'] =   (!empty($data))?$data[0]->role_id:""; 
			$this->data['photo'] =   (!empty($data))?$data[0]->photo:"";

			$this->data['content'] = 'admin/employee/detail_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}  
		 
		
	} 

	public function dataList()
	{
		$columns = array( 
            0 =>'id',  
      		1 =>'role.name',
            2 =>'nip',
            3 =>'users.first_name',
            4 =>'users.department',
            5 =>'users.phone',
            6 => 'users.email', 
            7 => 'photo',
            8 => 'action'
        ); 
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->employee_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        
        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        if(!empty($searchColumn[2]['search']['value'])){
        	$value = $searchColumn[2]['search']['value'];
        	$isSearchColumn = true;
         	$search['users.nip'] = $value;
        }

        if(!empty($searchColumn[3]['search']['value'])){
        	$value = $searchColumn[3]['search']['value'];
        	$isSearchColumn = true;
         	$search['users.first_name'] = $value;
        } 

    	if(!empty($searchColumn[4]['search']['value'])){
        	$value = $searchColumn[4]['search']['value'];
        	$isSearchColumn = true;
         	$search['groups.id'] = $value;
        } 

        if(!empty($searchColumn[5]['search']['value'])){
        	$value = $searchColumn[5]['search']['value'];
        	$isSearchColumn = true;
         	$search['users.phone'] = $value;
        } 

      	if(!empty($searchColumn[6]['search']['value'])){
        	$value = $searchColumn[6]['search']['value'];
        	$isSearchColumn = true;
         	$search['users.email'] = $value;
        } 

      	if(!empty($searchColumn[7]['search']['value'])){
        	$value = $searchColumn[7]['search']['value'];
        	$isSearchColumn = true;
         	$search['role.id'] = $value;
        } 

    	if($isSearchColumn){ 
           	$totalFiltered = $this->employee_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->employee_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     			$view_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."employee/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."employee/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."employee/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		}  
        		}

        		$view_url = "<a href='".base_url()."employee/detail/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> View</a>";

            	

                $nestedData['id'] = $start+$key+1;
                $nestedData['role_name'] = $data->role_name;
                $nestedData['area_name'] = $data->area_name;
                $nestedData['department'] = $data->group_name;  
                $nestedData['nip'] = $data->nip;
                $nestedData['name'] = $data->first_name;
                $nestedData['phone'] = $data->phone; 
                $nestedData['email'] = $data->email;
                if(empty($data->photo)){
                	$nestedData['photo'] = ''; 	
                }else{
                	$photo = explode(".", $data->photo);
                	$nestedData['photo'] = "<img width='40px' src=".base_url()."assets/images/photo/thumbs/".$data->photo.">"; 
                }
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
 			$this->load->model("employee_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->employee_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
