<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Profile extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->model('profile_model');
	}  
	public function index()
	{ 
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');    
		$this->form_validation->set_rules('department',"Jabatan Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('nip',"NIP Harus Diisi", 'trim|required');  
	  
		if ($this->form_validation->run() === TRUE)
		{
		 
			$data = array(
				'first_name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'), 
				'nip' => $this->input->post('nip'),
				'department' => $this->input->post('department'),
				'address' => $this->input->post('address')
			); 
			$user_id = $this->input->post('id'); 

			$update = $this->profile_model->update($data,array("id"=>$user_id));
			 
			$this->session->set_flashdata('message', "Success Update");
			redirect("dashboard"); 
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("dashboard");	
			}else{ 
			 	$this->data['id'] = $this->data['users']->id;
				if($this->data['is_superadmin']){
					$data = $this->profile_model->getAllIdSuperadmin(
												array("users.id"=>$this->data['id'])
												);
				}else{	
					$data = $this->profile_model->getAllById(
												array("users.id"=>$this->data['id'])
												);
				}
				 
				$this->load->model("area_model");
				$this->data['areas'] = $this->area_model->getAllById();
				$this->data['name'] =   (!empty($data))?$data[0]->first_name:"";
				$this->data['email'] =   (!empty($data))?$data[0]->email:""; 
				$this->data['phone'] =   (!empty($data))?$data[0]->phone:""; 
				$this->data['address'] =   (!empty($data))?$data[0]->address:"";  
				$this->data['department'] =   (!empty($data))?$data[0]->department:""; 
				$this->data['nip'] =   (!empty($data))?$data[0]->nip:""; 
				if(!$this->data['is_superadmin']){
				$this->data['area_id'] =   (!empty($data))?$data[0]->area_id:""; 
				$this->data['group_id'] =   (!empty($data))?$data[0]->group_id:""; 
				$this->data['role_id'] =   (!empty($data))?$data[0]->role_id:""; 
				}
				$this->data['content'] = 'admin/profile/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data);  
			}  
		}    
		
	}  

	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() === FALSE)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id' => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id' => 'new',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			);
			$this->data['user_id'] = array(
				'name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id,
			);

			$this->data['content'] = 'admin/profile/change_password'; 
			$this->load->view('admin/layouts/page',$this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('auth/logout');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('profile/change_password', 'refresh');
			}
		}
	}

	public function change_photo()
	{	
		// update script
		$photo_file_name = $this->uploadFile('photo_file', "./assets/images/photo/", 'agent');
		if (!empty($photo_file_name)) {
			$id = $this->data['users']->id;
			$dataUser['photo'] = $photo_file_name;
			$this->load->model('profile_model');
			$updateUser = $this->profile_model->update($dataUser,array("id"=>$id));
			redirect('profile/change_photo', 'refresh');
		}
		 
		$this->data['content'] = 'admin/profile/change_photo';
		$this->load->view('admin/layouts/page',$this->data);
	}

	public function uploadFile($file_name, $dir,$prefix_file){  
	 	
	 	$this->load->library('image_lib');
		if (!is_dir($dir)) {  
		    mkdir($dir);  
		    $dirThumbs = $dir.'thumbs';
		 	mkdir($dirThumbs);    
		}else{
			$dirThumbs = $dir.'thumbs';
			if (!is_dir($dirThumbs)) {
			    mkdir($dirThumbs);         
			}
		}  

		$return_file_name="";
		$config['upload_path']          = $dir;
		$config['allowed_types']        = '*'; 
  		$config['file_name'] = $prefix_file."_".time();

		$this->load->library('upload');
      	$this->upload->initialize($config);
		if ($this->upload->do_upload($file_name)){   
			$upload_data = $this->upload->data(); 
			$return_file_name = $config['file_name'].$upload_data['file_ext'];
 		  	$source_path =$config['upload_path'].$return_file_name; 
		    $target_path =$config['upload_path'].'thumbs/';
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
		   	$this->image_lib->clear();
            $this->image_lib->initialize($config_manip);
		    if (!$this->image_lib->resize()) { 
		 		$this->image_lib->display_errors(); 
		    }  
	    }else{ 
	    	$this->upload->display_errors();
	    }
		return $return_file_name;
	}
}
