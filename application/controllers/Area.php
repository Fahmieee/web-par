<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Area extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('area_model');
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/area/area_list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
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
				'description' => $this->input->post('description')
			); 
			if ($this->area_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Success Create Area");
				redirect("area");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Failed Create Area");
				redirect("area");
			}
		}else{  
			$this->data['content'] = 'admin/area/area_create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('code', "Code Is Required", 'trim|required');
		$this->form_validation->set_rules('name', "Name Is Required", 'trim|required'); 
		   
		if ($this->form_validation->run() === TRUE)
		{
		 
			$data = array(
				'code' => $this->input->post('code'),
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description')
			);
			$update = $this->area_model->update($data,array("id"=>$this->input->post('id')));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("area","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("area","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("area/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->area_model->getAllById(array("id"=>$this->data['id'])); 

				$this->data['code'] =   (!empty($data))?$data[0]->code:"";
				$this->data['name'] =   (!empty($data))?$data[0]->name:"";
				$this->data['description'] =   (!empty($data))?$data[0]->description:""; 
				
				$this->data['content'] = 'admin/area/area_edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{
		$columns = array( 
            0 =>'id', 
            1 =>'code',
            2=> 'name',
            3=> 'description',
            4=> 'action'
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->area_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"code"=>$search_value,
           		"name"=>$search_value,
           		"description"=>$search_value
           	); 
           	$totalFiltered = $this->area_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->area_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."area/edit/".$data->id."' class='btn btn-sm white edit'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_edit']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."area/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."area/destroy/".$data->id."/".$data->is_deleted."'
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
 			$this->load->model("area_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->area_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}

}
