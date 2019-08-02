<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Unit extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('unit_model');
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->load->model("branch_model");
	 		$this->data['branches'] = $this->branch_model->getAllById();
	 	 	
	 	 	$this->load->model("Produk_model");
 		 	$this->data['merk_units'] = $this->Produk_model->getAllById();

			$this->data['content'] = 'admin/unit/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}

	public function create()
	{ 
		$this->form_validation->set_rules('merk',"Merk Is Required", 'trim|required'); 
		$this->form_validation->set_rules('model',"Model Is Required", 'trim|required');  
		$this->form_validation->set_rules('varian',"varian Is Required", 'trim|required');  
		$this->form_validation->set_rules('branch_id',"Branch Is Required", 'trim|required');  

		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'branch_id' => $this->input->post('branch_id'),
				'type_assets' => $this->input->post('type_assets'),
				'type_unit' => $this->input->post('type_unit'),
				'merk' => $this->input->post('merk'),
				'model' => $this->input->post('model'), 
				'varian' => $this->input->post('varian'),
				'years' => $this->input->post('years'),
				'mes' => $this->input->post('mes'),
				'transmition' => $this->input->post('transmition'),
				'no_police' => $this->input->post('no_police'),
				'mileage' => $this->input->post('mileage'),
				'stnk_due_date' => $this->input->post('stnk_due_date'),
				'kir_due_date' => $this->input->post('kir_due_date'),
				'chassis_number' => $this->input->post('chassis_number'),
				'machine_number' => $this->input->post('machine_number'),
				'color' => $this->input->post('color')
			); 
			if ($this->unit_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Success Create unit");
				redirect("unit");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Failed Create unit");
				redirect("unit");
			}
		}else{   
			$this->load->model("branch_model");
	 		$this->data['branches'] = $this->branch_model->getAllById();
	 	 	
	 	 	$this->load->model("Produk_model");
 		 	$this->data['merk_units'] = $this->Produk_model->getAllById();

			$this->data['content'] = 'admin/unit/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit()
	{ 
		$this->form_validation->set_rules('merk',"Merk Is Required", 'trim|required'); 
		$this->form_validation->set_rules('model',"Model Is Required", 'trim|required');  
		$this->form_validation->set_rules('varian',"varian Is Required", 'trim|required');  
		$this->form_validation->set_rules('branch_id',"Branch Is Required", 'trim|required');  

		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'branch_id' => $this->input->post('branch_id'),
				'type_assets' => $this->input->post('type_assets'),
				'type_unit' => $this->input->post('type_unit'),
				'merk' => $this->input->post('merk'),
				'model' => $this->input->post('model'), 
				'varian' => $this->input->post('varian'),
				'years' => $this->input->post('years'),
				'mes' => $this->input->post('mes'),
				'transmition' => $this->input->post('transmition'),
				'no_police' => $this->input->post('no_police'),
				'mileage' => $this->input->post('mileage'),
				'stnk_due_date' => $this->input->post('stnk_due_date'),
				'kir_due_date' => $this->input->post('kir_due_date'),
				'chassis_number' => $this->input->post('chassis_number'),
				'machine_number' => $this->input->post('machine_number'),
				'color' => $this->input->post('color')
			); 
			$update = $this->unit_model->update($data,array("units.id"=>$this->input->post('id')));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Success Update");
				redirect("unit","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Failed Update");
				redirect("unit","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("unit/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$data = $this->unit_model->getAllById(array("units.id"=>$this->data['id'])); 

			 	$this->load->model("branch_model");
	 			$this->data['branches'] = $this->branch_model->getAllById();
	 			
	 			$this->load->model("Produk_model");
 				$this->data['merk_units'] = $this->Produk_model->getAllById();

				$this->data['branch_id'] =   (!empty($data))?$data[0]->branch_id:"";
				$this->data['type_assets'] =   (!empty($data))?$data[0]->type_assets:"";
				$this->data['type_unit'] =   (!empty($data))?$data[0]->type_unit:"";
				$this->data['merk'] =   (!empty($data))?$data[0]->merk:"";
				$this->data['model'] =   (!empty($data))?$data[0]->model:""; 
				$this->data['varian'] =   (!empty($data))?$data[0]->varian:""; 
				$this->data['years'] =   (!empty($data))?$data[0]->years:"";
				$this->data['mes'] =   (!empty($data))?$data[0]->mes:"";
				$this->data['transmition'] =   (!empty($data))?$data[0]->transmition:"";
				$this->data['no_police'] =   (!empty($data))?$data[0]->no_police:"";
				$this->data['mileage'] =   (!empty($data))?$data[0]->mileage:"";
				$this->data['stnk_due_date'] =   (!empty($data))?$data[0]->stnk_due_date:"";
				$this->data['kir_due_date'] =   (!empty($data))?$data[0]->kir_due_date:"";
				$this->data['chassis_number'] =   (!empty($data))?$data[0]->chassis_number:"";
				$this->data['machine_number'] =   (!empty($data))?$data[0]->machine_number:"";
				$this->data['color'] =   (!empty($data))?$data[0]->color:"";
				
				$this->data['content'] = 'admin/unit/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{
		 $columns = array( 
            0 =>'id', 
            1 =>'units.type_unit',
            2 =>'units.branch_id',
            3 =>'units.type_assets',
            4 =>'produk.name',
            5=> 'units.model', 
            6=> 'units.varian',
            7=> 'units.no_police',
            8=> 'units.stnk_due_date',
            9=> 'units.kir_due_date',
            10=> 'action'
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->unit_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        
 		$searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        if(!empty($searchColumn[1]['search']['value'])){
        	$value = $searchColumn[1]['search']['value'];
        	$isSearchColumn = true;
         	$search['units.type_unit'] = $value;
        }  
         if(!empty($searchColumn[2]['search']['value'])){
        	$value = $searchColumn[2]['search']['value'];
        	$isSearchColumn = true;
         	$search['units.merk'] = $value;
        }  

        if(!empty($searchColumn[3]['search']['value'])){
        	$value = $searchColumn[3]['search']['value'];
        	$isSearchColumn = true;
         	$search['units.branch_id'] = $value;
        } 
        if(!empty($searchColumn[4]['search']['value'])){
        	$value = $searchColumn[4]['search']['value'];
        	$isSearchColumn = true;
         	$search['units.no_police'] = $value;
        }
        if(!empty($searchColumn[5]['search']['value'])){
        	$value = $searchColumn[5]['search']['value'];
        	$isSearchColumn = true;
         	$search['units.type_assets'] = $value;
        } 
        if(!empty($searchColumn[6]['search']['value'])){
        	$value = $searchColumn[6]['search']['value'];
        	$isSearchColumn = true;
         	$search['produk.name'] = $value;
        } 
 

    	if($isSearchColumn){ 
           	$totalFiltered = $this->unit_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        }  
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->unit_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."unit/edit/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."unit/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' >Set To Inactive
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."unit/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm white delete' 
	        				 >Set To Active
	        				</a>";
	        		} 
        		}  

                $nestedData['id'] = $start+$key+1;
                $nestedData['type_assets'] = ($data->type_assets == 1)?"PAR":"Vendor";
                $nestedData['branch'] =	$data->branch_name;
                $nestedData['type_unit'] = ($data->type_unit==1)?"Dedicated":"Pool";
                $nestedData['no_police'] = $data->no_police;
                $nestedData['stnk_due_date'] = $data->stnk_due_date;
                $nestedData['kir_due_date'] = $data->kir_due_date;
                $nestedData['merk'] = $data->produk_name; 
                $nestedData['varian'] = $data->varian;  
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
 			$this->load->model("unit_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->unit_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
	public function getUnitByNoPolice(){
		$response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();   

		$police_number = $this->input->post('police_number'); 

 		if(!empty($police_number)){
 			$this->load->model("unit_model");
			$data = $this->unit_model->getAllById(array("no_police"=>$police_number));
			if(!$data){
				$response_data['msg'] = "Data Unit Tidak Ditemukan";
			}else{
				$response_data['data'] = $data; 
         		$response_data['status'] = true;
			}
        	
 		}else{
 		 	$response_data['msg'] = "No Polisi Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
