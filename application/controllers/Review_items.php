<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Review_items extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('review_items_model');
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/review_items/list_v'; 	
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
				'description' => $this->input->post('description')
			); 
			if ($this->review_items_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Success Create review_items");
				redirect("review_items");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Failed Create review_items");
				redirect("review_items");
			}
		}else{   
			$this->data['content'] = 'admin/review_items/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('name',"Name Is Required", 'trim|required');  

		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array( 
				'name' => $this->input->post('name'), 
				'description' => $this->input->post('description')
			); 
			$update = $this->review_items_model->update($data,array("review_items.id"=>$this->input->post('id')));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("review_items","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("review_items","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("review_items/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->review_items_model->getAllById(array("review_items.id"=>$this->data['id'])); 
 
				$this->data['name'] =   (!empty($data))?$data[0]->name:""; 
				$this->data['description'] =   (!empty($data))?$data[0]->description:""; 
				
				$this->data['content'] = 'admin/review_items/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 
	public function detail()
	{ 
		$this->form_validation->set_rules('name',"Name Is Required", 'trim|required');  

		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array( 
				'name' => $this->input->post('name'), 
				'description' => $this->input->post('description')
			); 
			$update = $this->review_items_model->update($data,array("review_items.id"=>$this->input->post('id')));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("review_items","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("review_items","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("review_items/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->review_items_model->getAllById(array("review_items.id"=>$this->data['id'])); 
 
				$this->data['name'] =   (!empty($data))?$data[0]->name:""; 
				$this->data['description'] =   (!empty($data))?$data[0]->description:""; 
				
				$this->data['content'] = 'admin/review_items/view_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{
		 $columns = array( 
            0 =>'id',  
            1=> 'review_items.name', 
            2=> 'description',
            3=> 'action'
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->review_items_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array( 
           		"review_items.name"=>$search_value, 
           		"review_items.description"=>$search_value
           	); 
           	$totalFiltered = $this->review_items_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->review_items_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     			$view_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."review_items/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."review_items/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."review_items/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		} 
        		} 
        		if($this->data['is_can_read']){
        		$view_url = "<a href='".base_url()."review_items/detail/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> View</a>";
            	}
            	

                $nestedData['id'] = $start+$key+1; 
                $nestedData['name'] = $data->name; 
           		$nestedData['description'] = (!empty($data->description))?substr(strip_tags($data->description),0,50):"";
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
 			$this->load->model("review_items_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->review_items_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
