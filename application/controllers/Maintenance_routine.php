<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Maintenance_routine extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('maintenance_model');
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/maintenance_routine/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}

	public function create()
	{ 
		$this->form_validation->set_rules('merk',"Merk Is Required", 'trim|required');   
		$this->form_validation->set_rules('distance',"KM Is Required", 'trim|required');   
		$this->form_validation->set_rules('parts[]',"Parts Is Required", 'trim|required');   

		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array( 
				'merk' => $this->input->post('merk'),
				'distance' => $this->input->post('distance')
			); 
			$insert_maintenance = $this->maintenance_model->insert($data);
			if ($insert_maintenance)
			{ 
				$parts = $this->input->post('parts');
				foreach ($parts as $key => $value) {
					$data = array( 
						'maintenance_id' => $insert_maintenance,
						'part_id' => $value
					); 
					 
	 				$this->maintenance_model->insert_maintenance_parts($data);
				}
 
				$this->session->set_flashdata('message', "Success Create Parts Perawatan");
				redirect("maintenance_routine");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Failed Create Parts Perawatan");
				redirect("maintenance_routine");
			}
		}else{   

			$this->load->model("parts_model");
 			$this->data['parts'] = $this->parts_model->getAllById(array("service_type"=>1));
			$this->load->model("Produk_model");
 			$this->data['merk_units'] = $this->Produk_model->getAllById();
 			
			$this->data['content'] = 'admin/maintenance_routine/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('merk',"Merk Is Required", 'trim|required');   
		$this->form_validation->set_rules('distance',"KM Is Required", 'trim|required');   
		$this->form_validation->set_rules('parts[]',"Parts Is Required", 'trim|required');   

		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'merk' => $this->input->post('merk'),
				'distance' => $this->input->post('distance')
			); 
			$update = $this->maintenance_model->update($data,array("maintenance.id"=>$this->input->post('id')));
			 
			$where = array("maintenance_id"=>$this->input->post('id'));
		 	$this->maintenance_model->delete_maintenance_parts($where);

			$parts = $this->input->post('parts');
			foreach ($parts as $key => $value) {
				$data = array( 
					'maintenance_id' => $this->input->post('id'),
					'part_id' => $value
				); 
				 
 				$this->maintenance_model->insert_maintenance_parts($data);
			}

			$this->session->set_flashdata('message', "Success Update");
			redirect("maintenance_routine","refresh");
			 
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("maintenance_routine/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->maintenance_model->getAllById(
						array(
							"maintenance.id"=>$this->data['id'] 
						));  
				$this->load->model("parts_model"); 
 				$this->data['parts'] = $this->parts_model->getAllById(array("service_type"=>1));

 				$this->load->model("Produk_model");
 				$this->data['merk_units'] = $this->Produk_model->getAllById();

 				$this->data['maintenance_parts'] = $this->maintenance_model->getAllMaintenanceParts(array("maintenance_id"=>$this->data['id'])); 
				$this->data['merk'] =   (!empty($data))?$data[0]->merk:""; 
				$this->data['distance'] =   (!empty($data))?$data[0]->distance:""; 
				
				$this->data['content'] = 'admin/maintenance_routine/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 
	public function detail()
	{ 
		$this->form_validation->set_rules('merk',"Merk Is Required", 'trim|required');   
		$this->form_validation->set_rules('distance',"KM Is Required", 'trim|required');   
		$this->form_validation->set_rules('parts[]',"Parts Is Required", 'trim|required');   

		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'merk' => $this->input->post('merk'),
				'distance' => $this->input->post('distance')
			); 
			$update = $this->maintenance_model->update($data,array("maintenance.id"=>$this->input->post('id')));
			 
			$where = array("maintenance_id"=>$this->input->post('id'));
		 	$this->maintenance_model->delete_maintenance_parts($where);

			$parts = $this->input->post('parts');
			foreach ($parts as $key => $value) {
				$data = array( 
					'maintenance_id' => $this->input->post('id'),
					'part_id' => $value
				); 
				 
 				$this->maintenance_model->insert_maintenance_parts($data);
			}

			$this->session->set_flashdata('message', "Success Update");
			redirect("maintenance_routine","refresh");
			 
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("maintenance_routine/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->maintenance_model->getAllById(
						array(
							"maintenance.id"=>$this->data['id'] 
						));  
				$this->load->model("parts_model"); 
 				$this->data['parts'] = $this->parts_model->getAllById(array("service_type"=>1));

 				$this->load->model("Produk_model");
 				$this->data['merk_units'] = $this->Produk_model->getAllById();

 				$this->data['maintenance_parts'] = $this->maintenance_model->getAllMaintenanceParts(array("maintenance_id"=>$this->data['id'])); 
				$this->data['merk'] =   (!empty($data))?$data[0]->merk:""; 
				$this->data['distance'] =   (!empty($data))?$data[0]->distance:""; 
				
				$this->data['content'] = 'admin/maintenance_routine/view_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{
		 $columns = array( 
            0 =>'id', 
            1 =>'maintenance.merk',
            2=> 'maintenance.distance',  
            3=> 'parts',
            4=> 'action'
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$where = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->maintenance_model->getCountAllBy($limit,$start,$search,$order,$dir,$where); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"maintenance.distance"=>$search_value, 
           		"produk.name"=>$search_value, 
           	); 
           	$totalFiltered = $this->maintenance_model->getCountAllBy($limit,$start,$search,$order,$dir,$where); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->maintenance_model->getAllBy($limit,$start,$search,$order,$dir,$where);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     			$view_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."maintenance_routine/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."maintenance_routine/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."maintenance_routine/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		} 
        		}  
        		if($this->data['is_can_read']){
        			$view_url = "<a href='".base_url()."maintenance_routine/detail/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> View</a>";
        		}
        		$maintenance_parts = $this->maintenance_model->getAllMaintenanceParts(
        												array("maintenance_id"=>$data->id)
        											); 
        		$parts = "";
        		if(!empty($maintenance_parts)){
        			foreach ($maintenance_parts as $key_part => $value) {
	        			$parts .= $value->name.",";
	        		} 
        		}
        		

        		if(strlen($parts) > 0){ $parts = substr($parts, 0,-1);
        		}
                $nestedData['id'] = $start+$key+1;
                $nestedData['merk'] = $data->produk_name;
                $nestedData['distance'] = $data->distance;
                $nestedData['parts'] = $parts;  
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
 			$this->load->model("maintenance_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->maintenance_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
