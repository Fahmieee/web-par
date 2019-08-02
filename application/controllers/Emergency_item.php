<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Emergency_item extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('parts_model');
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/emergency_item/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}

	public function create()
	{  
		$this->form_validation->set_rules('name',"Name Is Required", 'trim|required');  

		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array( 
				'name' => $this->input->post('name'), 
				'service_type' =>2 
			); 
			if ($this->parts_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Success Create Item Request Darurat");
				redirect("emergency_item");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Failed Create Item Request Darurat");
				redirect("emergency_item");
			}
		}else{   
			$this->data['content'] = 'admin/emergency_item/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{  
		$this->form_validation->set_rules('name', "Name Is Required", 'trim|required'); 
		   
		if ($this->form_validation->run() === TRUE)
		{
		 
			$data = array( 
				'name' => $this->input->post('name'), 
				'description' => $this->input->post('description')
			);
			$update = $this->parts_model->update($data,array("parts.id"=>$this->input->post('id')));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("emergency_item","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("emergency_item","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("emergency_item/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->parts_model->getAllById(array("parts.id"=>$this->data['id'])); 

			 
				$this->data['code'] =   (!empty($data))?$data[0]->code:"";
				$this->data['name'] =   (!empty($data))?$data[0]->name:""; 
				$this->data['description'] =   (!empty($data))?$data[0]->description:""; 
				
				$this->data['content'] = 'admin/emergency_item/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{
		 $columns = array( 
            0 =>'id',  
            1=> 'parts.name',  
            4=> 'action'
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$where = array("service_type"=>2);
  		$limit = 0;
  		$start = 0;
        $totalData = $this->parts_model->getCountAllBy($limit,$start,$search,$order,$dir,$where); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array( 
           		"parts.name"=>$search_value, 
           		"parts.description"=>$search_value
           	); 
           	$totalFiltered = $this->parts_model->getCountAllBy($limit,$start,$search,$order,$dir,$where); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->parts_model->getAllBy($limit,$start,$search,$order,$dir,$where);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."emergency_item/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."emergency_item/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."emergency_item/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		} 
        		}  

                $nestedData['id'] = $start+$key+1;
                $nestedData['code'] = $data->code;
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
	public function destroy(){
		$response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();   

		$id =$this->uri->segment(3);
		$is_deleted = $this->uri->segment(4);
 		if(!empty($id)){
 			$this->load->model("parts_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->parts_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
