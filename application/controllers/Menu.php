<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Menu extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model');
	}
	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/menu/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}

	public function create()
	{ 
		$this->form_validation->set_rules('module',"Module Is Required", 'trim|required'); 
		$this->form_validation->set_rules('name',"Name Is Required", 'trim|required'); 
		$this->form_validation->set_rules('url',"URL Is Required", 'trim|required');
		$this->form_validation->set_rules('parent_id',"Parent Is Required", 'trim|required'); 

		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'module_id' => $this->input->post('module'),
				'name' => $this->input->post('name'),
				'parent_id' => $this->input->post('parent_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon')
			); 
			if ($this->menu_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Success Create Menu");
				redirect("menu");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Failed Create Menu");
				redirect("menu");
			}
		}else{  
			$this->data['content'] = 'admin/menu/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		// $this->form_validation->set_rules('module',"Module Is Required", 'trim|required'); 
		// $this->form_validation->set_rules('name',"Name Is Required", 'trim|required'); 
		// $this->form_validation->set_rules('url',"URL Is Required", 'trim|required');
		// $this->form_validation->set_rules('parent_id',"Parent Is Required", 'trim|required');
	 	$this->form_validation->set_rules('icon',"Parent Is Required", 'trim|required');
		if ($this->form_validation->run() === TRUE)
		{
		 
			$data = array(
			 
				'icon' => $this->input->post('icon')
			); 
			$update = $this->menu_model->update($data,array("id"=>$this->input->post('id')));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("menu","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("menu","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("menu/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->menu_model->getAllById(array("id"=>$this->data['id'])); 

				$this->data['module_id'] =   (!empty($data))?$data[0]->module_id:"";
				$this->data['name'] =   (!empty($data))?$data[0]->name:"";
				$this->data['url'] =   (!empty($data))?$data[0]->url:"";
				$this->data['icon'] =   (!empty($data))?$data[0]->icon:""; 
				
				$this->data['content'] = 'admin/menu/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{
	 	$columns = array( 
            0 =>'id', 
            1 =>'module.id',
            2 => 'name',
            3 => 'url',
            4 => 'icon',
            5 => ''
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->menu_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"menu.name"=>$search_value,
           		"menu.url"=>$search_value,
           		"menu.icon"=>$search_value
           	); 
           	$totalFiltered = $this->menu_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->menu_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        {
        	$edit_url = "";
     		$delete_url = "";
     		
            foreach ($datas as $key=>$data)
            {  

            	if($this->data['is_can_edit']){
            		$edit_url = "<a href='".base_url()."menu/edit/".$data->id."' class='btn btn-sm white'>  <i class='fa fa-pencil'></i> Edit</a>";
            	}  
            
            	// if($this->data['is_can_delete']){
            	// 	$delete_url = "<a href='".base_url()."menu/active/".$data->id."' class='btn btn-danger'>Set To Active</a>";
            	// }  

                $nestedData['id'] = $start+$key+1;
                $nestedData['module'] = $data->module_name;
                $nestedData['parent'] = $data->parent_id;
                $nestedData['name'] = $data->name;
                $nestedData['url'] = $data->url;
           		$nestedData['icon'] = $data->icon;
           		$nestedData['action'] = $edit_url." ".$delete_url;   
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
}
