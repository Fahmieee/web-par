<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
 	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		$this->data = array();

		$this->data['is_superadmin'] = false;
		$this->data['is_admin'] = false;
		$this->data['is_customer'] = false;
		if ($this->ion_auth->in_group(1))
		{
			$this->data['is_superadmin'] = true;
		}elseif($this->ion_auth->in_group(2)){
			$this->data['is_customer'] = true;
		}else{
			$this->data['is_admin'] = true;
		}
		$this->data['is_load_datatables_plugin'] = false;
	}
	public function index()
	{ 
		$this->data['content'] = 'admin/dashboard'; 
		$this->load->view('admin/layouts/page',$this->data);
	}   
}
