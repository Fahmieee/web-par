<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	} 

	public function index()
	{
		$this->load->helper('url');

		$this->load->model("port_model");
		$this->data['ports'] = $this->port_model->getAllById();
		$this->load->view('auth/create_user', $this->data);
	}

	public function create()
	{
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('email',"Email Harus Diisi", 'trim|required');  
		$this->form_validation->set_rules('nip',"No KTP Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('username',"Username Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('password',"Password Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('port_id',"Pelabuhan Harus Diisi", 'trim|required');  
		 
		if ($this->form_validation->run() === TRUE){
			$foto_file_name = $this->uploadFileAgent('foto_file', "./assets/images/foto/", 'agent');
			$data = array(
				'first_name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'), 
				'nip' => $this->input->post('nip'),
				'department' => $this->input->post('department'),
				'address' => $this->input->post('address'),
				'foto' => $foto_file_name
			); 
			$role = array(2);  
 			$username = $this->input->post('username');
 			$password = $this->input->post('password');
 			$email = $this->input->post('email');
			$insert = $this->ion_auth->register($username, $password, $email, $data, $role);
			if ($insert) { 
				//send verification code
				$config = Array(
		            'protocol' => 'smtp',
		            'smtp_host' => 'smtp.office365.com',
		            'smtp_user' => 'adminerp@prima-armada-raya.com',
		            'smtp_pass' => 'Par12345',
		            'smtp_crypto' => 'tls',    
		            'newline' => "\r\n", //REQUIRED! Notice the double quotes!
		            'smtp_port' => 587,
		            'mailtype' => 'html'
		            'mail_charset' => 'iso-8859-1',
		            'mail_timeout' => '4',
		            'wordwrap'=>TRUE
				);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");

				// Set to, from, message, etc.
				$this->email->from('adminerp@prima-armada-raya.com', 'Patrajasa - noreply');
		        $this->email->to($email); 
		        $this->email->subject('Verification Code');

		        //verification code
		        $code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6); 
		        $isi_email = '<table width="100%" cellspacing="0" border="0">'.
							    '<tr bgcolor="#5c9df2">'.
							        '<td colspan="3" ><center>&nbsp</center></td>'.
							    '</tr>'.
							    '<tr height="100">'.
							        '<td bgcolor="#5c9df2"></td>'.
							        '<td bgcolor="white" width="50%"><center><h1>Selamat Akun Anda Terdaftar!</h1></center></td>'.
							        '<td bgcolor="#5c9df2"></td>'.
							    '</tr>'.
							    '<tr height="100">'.
							        '<td bgcolor="white"></td>'.
							        '<td bgcolor="white" width="50%"><center><h4>Berikut adalah tautan untuk mengaktivasikan akun anda,</h4><a href="'.base_url().'signup/verify/'.$insert.'/'.$code.'"><button>Aktifkan Akun</button></a> </center></td>'.
							        '<td bgcolor="white"></td>'.
							    '</tr>'.
							    '<tr height="100">'.
							        '<td bgcolor="white"></td>'.
							        '<td bgcolor="white" width="50%"><center><p>Pelabuhan cilegon mandiri</p></center></td>'.
							        '<td bgcolor="white"></td>'.
							    '</tr>'.
							'</table>';

		        $this->email->message($isi_email); 
		        $this->agent_model->updateUser(array('verification_code' => $code, 'active' => '0'), array("id" => $insert));

				if ($this->email->send()) {
					$this->session->set_flashdata('message',"Agen Behasil Didaftarkan");
					redirect("login");
				} else {
					$this->session->set_flashdata('message_error', $this->email->print_debugger());
					redirect("login");
				}

				
			}else{
				$this->session->set_flashdata('message_error',"Agen Gagal Didaftarkan");
				redirect("login");
			}
		}else{
			redirect("login");
		}
	}

	public function verify($id, $code)
	{	
		$this->load->model("agent_model");
		$verification_code = $this->agent_model->getAllById(array('users.id' => $id)) [0]->verification_code;

		if ($verification_code == $code) {
			$this->agent_model->updateUser(array('active' => '1'), array("id" => $id));
			$this->session->set_flashdata('message',"Agen Behasil Diverifikasi");
			redirect("login");
		}else{
			$this->session->set_flashdata('message_error',"No Match Result");
			redirect("login");
		}
		
	}

	public function uploadFileAgent($file_name, $dir,$prefix_file){  
	 	 
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
		   $this->load->library('image_lib', $config_manip);
		    if (!$this->image_lib->resize()) { 
		 		$this->image_lib->display_errors(); 
		    }else{
		    	$this->image_lib->clear(); 
	    	}  
	    }else{ 
	    	$this->upload->display_errors();
	    }
		return $return_file_name;
	}

}
