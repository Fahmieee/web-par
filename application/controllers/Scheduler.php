<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Scheduler extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->model('scheduler_model'); 
	}
	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->load->model("groups_model");
			$this->data['groups'] = $this->groups_model->getAllById();
			$this->load->model("produk_model");
			$this->data['merk_units'] = $this->produk_model->getAllById();
			$this->data['content'] = 'admin/scheduler/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 
	public function create()
	{  
		$this->form_validation->set_rules('unit_id',"Unit Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('user_id',"user Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('driver_id',"Driver Harus Diisi", 'trim|required'); 
		 
		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'user_id' => $this->input->post('user_id'),
				'driver_id' => $this->input->post('driver_id'), 
				'unit_id' => $this->input->post('unit_id'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date')
			);  

	 		$insert = $this->scheduler_model->insert($data);
			 
			if ($insert)
			{
				$this->session->set_flashdata('message', "Scheduler Berhasil Disimpan");
				redirect("scheduler");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Scheduler Gagal Disimpan");
				redirect("scheduler");
			}
		}else{   
 			$this->load->model("user_model");
 			$this->data['data_users'] = $this->user_model->getAllById();

 			$this->load->model("driver_model");
 			$this->data['drivers'] = $this->driver_model->getAllById();

 			$this->load->model("branch_model");
	 		$this->data['branches'] = $this->branch_model->getAllById(); 
	 		
			$this->data['content'] = 'admin/scheduler/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('unit_id',"Unit Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('user_id',"user Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('driver_id',"Driver Harus Diisi", 'trim|required'); 
		   
		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'user_id' => $this->input->post('user_id'),
				'driver_id' => $this->input->post('driver_id'), 
				'unit_id' => $this->input->post('unit_id'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date')
			);  
 

	 		$update = $this->scheduler_model->update($data,array("user_contract_history.id"=>$this->input->post('id')));
			 
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update Scheduler");
				redirect("scheduler");
			}else{
				$this->session->set_flashdata('message_error', "No data update");
				redirect("scheduler");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("scheduler/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->scheduler_model->getAllById(array("user_contract_history.id"=>$this->data['id']));  
				 
	 			$this->load->model("user_model");
	 			$this->load->model("unit_model");
	 			$this->data['data_users'] = $this->user_model->getAllById();

	 			$this->load->model("driver_model");
	 			$this->data['drivers'] = $this->driver_model->getAllById();

	 			$this->load->model("branch_model");
		 		$this->data['branches'] = $this->branch_model->getAllById(); 
		 		
 
				$this->data['user_id'] =   (!empty($data))?$data[0]->user_id:""; 
				$this->data['driver_id'] =   (!empty($data))?$data[0]->driver_id:"";
				$this->data['unit_id'] =   (!empty($data))?$data[0]->unit_id:"";
				$this->data['start_date'] =   (!empty($data))?date("Y-m-d",strtotime($data[0]->start_date)):"";
				$this->data['end_date'] =   (!empty($data))?date("Y-m-d",strtotime($data[0]->end_date)):"";
				$this->data['units'] =    array();
				 
				if(!empty($data[0]->unit_id)){
					$units = $this->unit_model->getAllById(array("units.id"=>$data[0]->unit_id));  
				} 
				$this->data['units'] = $units[0]; 
				$this->data['content'] = 'admin/scheduler/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function detail()
	{  
		$this->data['id']= $this->uri->segment(3);
		$data = $this->scheduler_model->getAllById(array("user_contract_history.id"=>$this->data['id']));  
		 
		$this->load->model("user_model");
		$this->load->model("unit_model");
		$this->data['data_users'] = $this->user_model->getAllById();

		$this->load->model("driver_model");
		$this->data['drivers'] = $this->driver_model->getAllById();

		$this->load->model("branch_model");
 		$this->data['branches'] = $this->branch_model->getAllById(); 
 		

		$this->data['user_id'] =   (!empty($data))?$data[0]->user_id:""; 
		$this->data['driver_id'] =   (!empty($data))?$data[0]->driver_id:"";
		$this->data['unit_id'] =   (!empty($data))?$data[0]->unit_id:"";
		$this->data['start_date'] =   (!empty($data))?date("Y-m-d",strtotime($data[0]->start_date)):"";
		$this->data['end_date'] =   (!empty($data))?date("Y-m-d",strtotime($data[0]->end_date)):"";
		$this->data['units'] =    array();
		 
		if(!empty($data[0]->unit_id)){
			$units = $this->unit_model->getAllById(array("units.id"=>$data[0]->unit_id));  
		} 
		$this->data['units'] = $units[0]; 
		$this->data['content'] = 'admin/scheduler/detail_v'; 
		$this->load->view('admin/layouts/page',$this->data);  
	} 

	public function dataList()
	{
		$columns = array( 
            0 =>'units.id',  
      		1 =>'users.driver_type',
            2 =>'users.first_name',
            3 =>'users.company',
            4 =>'users.first_name', 
            5 =>'units.merk',
            6 => 'units.model', 
            7 => 'units.varian',
            8 => 'no_police',
            9 => 'action'
        ); 
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->scheduler_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        
        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        
        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        if(!empty($searchColumn[1]['search']['value'])){
        	$value = $searchColumn[1]['search']['value'];
        	$isSearchColumn = true;
         	$search['driver.driver_type'] = $value;
        }
        if(!empty($searchColumn[2]['search']['value'])){
        	$value = $searchColumn[2]['search']['value'];
        	$isSearchColumn = true;
         	$search['users.company'] = $value;
        }

        if(!empty($searchColumn[3]['search']['value'])){
        	$value = $searchColumn[3]['search']['value'];
        	$isSearchColumn = true;
         	$search['driver.first_name'] = $value;
        } 

    	if(!empty($searchColumn[4]['search']['value'])){
        	$value = $searchColumn[4]['search']['value'];
        	$isSearchColumn = true;
         	$search['units.no_police'] = $value;
        } 

        if(!empty($searchColumn[5]['search']['value'])){
        	$value = $searchColumn[5]['search']['value'];
        	$isSearchColumn = true;
         	$search['units.merk'] = $value;
        }   
    	if($isSearchColumn){
	        if(!empty($this->input->post('search')['value'])){
	        	$search_value = $this->input->post('search')['value']; 
	      	}
           	$totalFiltered = $this->scheduler_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->scheduler_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
            	$view_url = "";
     			$delete_url = "";
     		
            	if($this->data['is_can_edit']){
            		$edit_url = "<a href='".base_url()."scheduler/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}   

             	$view_url = "<a href='".base_url()."scheduler/detail/".$data->id."' class='btn btn-sm white'><i class='fa fa-info'></i> Detail</a>";
             
            	
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."scheduler/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."scheduler/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		} 
        		}

                $nestedData['id'] = $start+$key+1;
            
                $nestedData['driver_type'] = ($data->driver_type == 1)?"Dedicated":"Pool";  
                $nestedData['driver_name'] = $data->driver_name; 
                $nestedData['driver_code'] = $data->driver_name; 
                $nestedData['company'] = $data->company;
                $nestedData['first_name'] = $data->first_name;
                $nestedData['merk'] = $data->unit_merk;
                $nestedData['model'] = $data->model;
                $nestedData['varian'] = $data->varian; 
                $nestedData['police_no'] = $data->no_police;
                if(empty($data->photo)){
                	$nestedData['photo'] = ''; 	
                }else{
                	$photo = explode(".", $data->photo);
                	$nestedData['photo'] = "<img width='40px' src=".base_url()."assets/images/photo/thumbs/".$data->photo.">"; 
                }
           		$nestedData['action'] = $edit_url." ".$view_url." ".$delete_url;   
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
 			$this->load->model("scheduler_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->scheduler_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
