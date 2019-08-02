<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Role extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('role_model');
	}

	public function index()
	{

		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/role/role_list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}

	public function create()
	{ 
		$this->form_validation->set_rules('group_id',"Grup Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required'); 
		 
		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'name' => $this->input->post('name'),
				'group_id' => $this->input->post('group_id'),
				'description' => $this->input->post('description')
			); 
			if ($this->role_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Role Baru Berhasil Disimpan");
				redirect("role");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Role Baru Gagal Disimpan");
				redirect("role");
			}
		}else{   
			$this->load->model("area_model");
	 		$this->data['areas'] = $this->area_model->getAllById();
			$this->data['content'] = 'admin/role/role_create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('group_id',"Grup Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('name', "Name Harus Diisi", 'trim|required');
		   
		if ($this->form_validation->run() === TRUE)
		{
		 
			$data = array(
				'name' => $this->input->post('name'),
				'group_id' => $this->input->post('group_id'),
				'description' => $this->input->post('description')
			);
			$update = $this->role_model->update($data,array("role.id"=>$this->input->post('id')));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("role","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("role","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("role/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$roles = $this->role_model->getAllById(array("role.id"=>$this->data['id'])); 

			 
				$this->load->model("area_model");
				$this->data['areas'] = $this->area_model->getAllById(array());

				$this->data['area_id'] = (!empty($roles))?$roles[0]->area_id:"";
				$this->data['group_id'] =   (!empty($roles))?$roles[0]->group_id:"";
				$this->data['name'] =   (!empty($roles))?$roles[0]->name:"";
				$this->data['description'] =   (!empty($roles))?$roles[0]->description:""; 
				
				$this->data['content'] = 'admin/role/role_edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{

		 $columns = array( 
            0 =>'id', 
            1 =>'area_name',
            2 =>'group_name',
            3 =>'name', 
            4=> 'description',
            5=> ''
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->role_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"role.name"=>$search_value,
           		"groups.name"=>$search_value,
           		"role.description"=>$search_value
           	); 
           	$totalFiltered = $this->role_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->role_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        {
        	 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."role/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."role/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."role/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		} 
        		}
            	
                $nestedData['id'] = $start+$key+1;
                $nestedData['area_name'] = $data->area_name;
                $nestedData['group_name'] = $data->group_name; 
                $nestedData['name'] = $data->name; 
                $nestedData['description'] = substr(strip_tags($data->description),0,50);
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

	public function getRoleByGroup(){
		$response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();   

		$group_id = $this->input->get('group_id');
 		if(!empty($group_id)){
 			$this->load->model("role_model");
			$data = $this->role_model->getAllById(array("role.group_id"=>$group_id)); 
        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "Grup ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}

	public function destroy(){
		$response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();   

		$id =$this->uri->segment(3);
		$is_deleted = $this->uri->segment(4);
 		if(!empty($id)){
 			$this->load->model("role_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->role_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
