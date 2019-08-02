<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Branch extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('branch_model');
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/branch/list_v'; 	
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
				'city_id' => $this->input->post('city_id'), 
				'area_id' => $this->input->post('area_id'), 
				'description' => $this->input->post('description')
			); 
			if ($this->branch_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Success Create branch");
				redirect("branch");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Failed Create branch");
				redirect("branch");
			}
		}else{   
			$this->load->model("area_model");
	 		$this->data['areas'] = $this->area_model->getAllById(); 
	 		$this->load->model("city_model");
	 		$this->data['cities'] = $this->city_model->getAllById();

			$this->data['content'] = 'admin/branch/create_v'; 
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
				'city_id' => $this->input->post('city_id'), 
				'area_id' => $this->input->post('area_id'), 
				'description' => $this->input->post('description')
			);
			$update = $this->branch_model->update($data,array("branch.id"=>$this->input->post('id')));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("branch","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("branch","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("branch/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->branch_model->getAllById(array("branch.id"=>$this->data['id'])); 

				
				$this->load->model("area_model");
		 		$this->data['areas'] = $this->area_model->getAllById(); 
		 		$this->load->model("city_model");
		 		$this->data['cities'] = $this->city_model->getAllById();
			 
				$this->data['code'] =   (!empty($data))?$data[0]->code:"";
				$this->data['name'] =   (!empty($data))?$data[0]->name:""; 
				$this->data['city_id'] =   (!empty($data))?$data[0]->city_id:""; 
				$this->data['area_id'] =   (!empty($data))?$data[0]->area_id:""; 
				$this->data['description'] =   (!empty($data))?$data[0]->description:""; 
				
				$this->data['content'] = 'admin/branch/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{
		 $columns = array( 
            0 =>'id', 
            1 =>'area.name',
            2 =>'cities.name',
            3 =>'branch.code',
            4=> 'branch.name', 
            5=> 'description',
            6=> 'action'
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->branch_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"branch.code"=>$search_value,
           		"branch.name"=>$search_value, 
           		"branch.description"=>$search_value
           	); 
           	$totalFiltered = $this->branch_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->branch_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."branch/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."branch/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."branch/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		} 
        		} 
            	
            	

                $nestedData['id'] = $start+$key+1;
                $nestedData['code'] = $data->code;
                $nestedData['name'] = $data->name; 
                $nestedData['city_name'] = $data->name; 
                $nestedData['area_name'] = $data->name; 
           		$nestedData['description'] = (!empty($data->description))?substr(strip_tags($data->description),0,50):"";
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
 			$this->load->model("branch_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->branch_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
