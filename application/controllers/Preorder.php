<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Preorder extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('preorders_model');
	}

	public function index()
    {
        $this->load->helper('url');
        if($this->data['is_can_read']){
            $this->data['content'] = 'admin/preorder/list_v';   
        }else{
            $this->data['content'] = 'errors/html/restrict'; 
        }
        
        $this->load->view('admin/layouts/page',$this->data);  
    } 

    public function view_preorder()
	{
        $this->form_validation->set_rules('est_biaya_part',"Estimasi Biaya Part Harus Diisi", 'trim|required');   
        $this->form_validation->set_rules('est_biaya_jasa',"Estimasi Biaya Jasa Harus Diisi", 'trim|required');   
        $this->form_validation->set_rules('est_biaya_maintenance',"Estimasi Biaya Maintenance Harus Diisi", 'trim|required');   

        if ($this->form_validation->run() === TRUE)
        {
            $est_biaya_part = $this->input->post('est_biaya_part'); 
            $est_biaya_jasa = $this->input->post('est_biaya_jasa'); 
            $est_biaya_maintenance = $this->input->post('est_biaya_maintenance'); 
            $workshop_id = $this->input->post('workshop_id'); 
            $user_id = $this->input->post('user_id'); 
            $service_type = $this->input->post('service_type'); 
            $type = $this->input->post('type'); 
            $token = $this->input->post('token'); 
            $id = $this->input->post('id'); 

            $this->load->model("workshop_model");
            $this->load->model("user_model");
            $this->load->model("driver_model");
            $this->load->model("orders_model");
            $this->load->model("scheduler_model");
            $this->load->model("maintenance_model");
            $this->load->model("preorders_model");
            $data = array(
                'user_id' => $user_id,
                'workshop_id' => $workshop_id
            );  

            $data_workshop = $this->workshop_model->getAllById(array("workshop.id"=>$workshop_id)); 
            $response['workshop_id'] = $workshop_id;
            $response['user_id'] = $user_id;
            $response['service_type'] = $service_type;
            $response['type'] = $type;
            $response['token'] = $token;

            $where_token = array("orders.token"=>$token);
            $where_preorders = array("preorders.id"=>$id);
            $data_order = $this->orders_model->getAllById($where_token); 
            $data_preorders = $this->preorders_model->getAllById($where_preorders); 

            if(empty($data_order)){
                if(!empty($data_workshop)){  
                    $data_order = $this->orders_model->getAllById();  

                    $data_role = $this->ion_auth->get_users_groups($user_id)->row(); 
                    $role_id = $data_role->id;
                    if($role_id == 2){
                        $where = array(
                            "driver_id"=>$user_id,
                            "DATE(start_date) <="=>date('Y-m-d'),
                            "DATE(end_date) >="=>date('Y-m-d')
                        );
                        $data_user = $this->driver_model->getAllById(array("users.id"=>$user_id)); 
                    }else{
                        $where = array(
                            "user_id"=>$user_id,
                            "DATE(start_date) <="=>date('Y-m-d'),
                            "DATE(end_date) >="=>date('Y-m-d')
                        );
                        $data_user = $this->user_model->getAllById(array("users.id"=>$user_id)); 
                    } 
                    if(!empty($data_order)){
                        $order_no = "PAR - ".str_pad(count($data_order)+1, 5, "0", STR_PAD_LEFT)."/".date('dmY');
                        
                    }else{
                        $order_no = "PAR - ".str_pad(1, 5, "0", STR_PAD_LEFT)."/".date('dmY');
                    } 
                    if(!empty($data_preorders)){ 
                        $pairing_id = $data_preorders[0]->pairing_id;
                        $unit_id = $data_preorders[0]->unit_id;
                    }else{
                        $pairing_id = 0;
                        $unit_id = 0;
                    }
                    $preorders = $this->preorders_model->getAllById(array("token"=>$token));
                    date_default_timezone_set("Asia/Jakarta");
                    $data = array(
                        'service_type' =>$service_type, 
                        'type' =>$type, 
                        'pairing_id' =>$pairing_id, 
                        'order_no' => $order_no, 
                        'order_date' => date('Y-m-d H:i:s'), 
                        'unit_id' => $unit_id, 
                        'user_id' => $user_id,
                        'workshop_id' => $workshop_id,
                        'est_biaya_part' => $est_biaya_part,
                        'est_biaya_jasa' => $est_biaya_jasa,
                        'est_biaya_maintenance' => $est_biaya_maintenance,
                        'token' => $token,
                        'is_booking' => $preorders[0]->is_booking,
                        'distance' => $preorders[0]->distance,
                        'status'=>1,
                        'description' => ""
                    ); 
                    $insert = $this->orders_model->insert($data);
                    if($insert){
                        $data_maintenance = $this->maintenance_model->getAllMaintenanceParts(
                            array("maintenance_id"=>$type));
                        foreach ($data_maintenance as $key => $value) {
                            $data = array(
                                'order_id' =>$insert, 
                                'part_id' => $value->part_id,
                                'status'=>0
                            ); 
                            $insert_item = $this->orders_model->insertItem($data);
                        }
                       
                        $preorders_items = $this->preorders_model->getAllItemById(
                            array(
                                "preorders_item.status"=>1,
                                "preorders_item.preorder_id"=>$preorders[0]->id
                            )
                        );
                        foreach ($preorders_items as $key => $value) {
                            $data = array(
                                'order_id' =>$insert, 
                                'part_id' => $value->part_id,
                                'status'=>$value->status,
                                'file'=>$value->file
                            );
                            $insert_item2 = $this->orders_model->insertItem($data);
                        }



                        $update_preorders = $this->preorders_model->update(array("status"=>1),array("token"=>$token));
                        $data_send = array(
                            "order_id"=>$insert,
                            "user_id"=>$user_id,
                            "distance"=>12,
                            "service_type"=>$service_type
                        );
                        sendNotification(
                            $data_user[0]->fcm_token,
                            "Order Anda Sudah Diterima", 
                            "Oleh ".$data_workshop[0]->name, 
                            "ACCEPT_ORDER", 
                            "FCM_PLUGIN_ACTIVITY",
                            $data_send
                        ); 
                    }
                    $this->session->set_flashdata('message',"Berhasil Menyimpan Estimasi");
                    redirect("preorder");
                }else{
                    $this->session->set_flashdata('message_error',"Gagal Menyimpan Estimasi");
                    redirect("preorder");
                }
            }else{ 
                $this->session->set_flashdata('message_error',"Token Sudah Ada");
                redirect("preorder");
            }

        }else{
            $this->load->helper('url');
            $id =  $this->uri->segment(3);
            $this->data['id'] = $id;
            $this->load->model("preorders_model");
            $this->load->model("orders_model");
            $this->load->model("workshop_model");
            $this->load->model("unit_model");
            $this->load->model("scheduler_model");
            $this->load->model("user_model");
            $this->load->model("driver_model");

            $data_order = $this->preorders_model->getAllById(array("preorders.id"=>$id)); 
            $this->data['orders'] = $data_order[0];
            if(!empty($data_order)){
                $unit_id = $data_order[0]->unit_id;
                $order_date = $data_order[0]->order_date;
                $units = $this->unit_model->getAllById(array("units.id"=>$unit_id)); 
                $this->data['units'] = $units[0];

                $pairing_id = $data_order[0]->pairing_id; 
                $pairings = $this->scheduler_model->getAllById(
                            array("user_contract_history.id"=>$pairing_id)
                            ); 
                if(!empty($pairings)){
                    $driver_id = $pairings[0]->driver_id;
                    $user_id = $pairings[0]->user_id; 
                    $data_driver = $this->driver_model->getAllById(array("users.id"=>$driver_id));  
                    $data_user = $this->user_model->getAllById(array("users.id"=>$user_id)); 
                    
                    $this->data['data_users'] = $data_user[0]; 
                    $this->data['drivers'] = $data_driver[0]; 
                }else{
                    $data_driver = array();
                    $data_user = array();

                    $this->data['data_users'] = array();
                    $this->data['drivers'] = array();
                } 

                $data_parts = $this->preorders_model->getAllItemById(array("preorder_id"=>$id));
                $part_perawatan = array();
                $part_perbaikan = array();
                foreach ($data_parts as $key => $value) {   
                    if($value->status == 1){
                        $part_perbaikan[] = $value->part_name;
                    }else{
                        $part_perawatan[] = $value->part_name;    
                    } 
                   
                } 

                $this->data['part_perawatan'] = $part_perawatan;
                $this->data['part_perbaikan'] = $part_perbaikan; 

                $getLastOrder = $this->orders_model->getAllById(
                    array(
                        "orders.unit_id"=>$unit_id,
                        "orders.order_date <="=>date("Y-m-d H:i:s",strtotime($order_date)) 
                    )
                );
                $lastOrder = new stdClass();
                $lastOrder->order_date = "";
                $lastOrder->service_type = "";
                $lastOrder->type = "";
                $lastOrder->parts = array(); 
                if(!empty($getLastOrder)){  
                    $lastOrder->order_date = $getLastOrder[0]->order_date; 
                    $lastOrder->service_type = $getLastOrder[0]->service_type; 
                    $lastOrder->type = $getLastOrder[0]->type;  

                    $lastOrderParts = $this->orders_model->getAllItemById(
                        array("order_id"=>$getLastOrder[0]->id)
                    );

                    if(!empty($lastOrderParts)){
                        $lastOrder->parts = $lastOrderParts; 
                    }else{
                        $lastOrder->parts = array(); 
                    } 
                     
                } 

                $this->data['lastOrder']=$lastOrder;  
            }  

            $this->load->model("branch_model");
            $this->data['branches'] = $this->branch_model->getAllById(); 
            $this->load->model("workshop_model");
            $this->data['workshops'] = $this->workshop_model->getAllById(); 

            $this->data['content'] = 'admin/preorder/detail_preorder_v';    
           
        
            $this->load->view('admin/layouts/page',$this->data);  
        }
        
		
		 
	} 


	public function dataList()
	{
		$columns = array( 
            0 =>'id', 
            1 =>'preorders.preorder_no',
            2 =>'preorders.order_date',
            3=> 'preorders.service_type',  
            4=> 'workshop.name',  
            5=> 'users.first_name',  
            6=> 'units.merk',
            7=> 'preorders.status',
            8=> 'action'
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = array();
  		$where = array("status"=>0);
  		$limit = 0;
  		$start = 0;
        $totalData = $this->preorders_model->getCountAllBy($limit,$start,$search,$order,$dir,$where); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
                "users.first_name"=>$search_value, 
                "workshop.name"=>$search_value, 
           		"produk.name"=>$search_value, 
           	); 
           	$totalFiltered = $this->preorders_model->getCountAllBy($limit,$start,$search,$order,$dir,$where); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->preorders_model->getAllBy($limit,$start,$search,$order,$dir,$where);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$view_url = "";
     			$delete_url = "";
     			$edit_url = "";
     			$close_url = "";
     		
            	if($this->data['is_can_read'] && $data->status == 0){
            		$edit_url = "<a href='".base_url()."preorder/view_preorder/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> View Preorder</a>";
            	}  
            	
            	// $view_url = "<a href='".base_url()."preorder/view/".$data->id."' class='btn btn-sm white'><i class='fa fa-detail'></i> View</a>";
            

                $nestedData['id'] = $start+$key+1;
                $nestedData['order_no'] = $data->preorder_no; 
                $nestedData['order_date'] = date("Y-m-d",strtotime($data->order_date)); 
                  if($data->service_type == "treatment"){
		             $nestedData['order_type'] = "Perawatan"; 
		         }else if($data->service_type == "repair"){
		             $nestedData['order_type'] = "Perbaikan"; 
		         }
		          else{
		             $nestedData['order_type'] = "Darurat"; 
		         }
                $nestedData['workshop_name'] = $data->workshop_name;  
                $nestedData['driver_name'] = $data->first_name;  
                $nestedData['unit_name'] = $data->produk_name;  
                if($data->status == 0){
                 $nestedData['status']  = "Waiting Approval";
               	}else if($data->status == 1){
                 $nestedData['status']  = "On Progress";
               	}else if($data->status == 2){
                 $nestedData['status']  = "DONE";
               	}else{
                 $nestedData['status']  = "Close WO";
               	}
           		$nestedData['action'] = $edit_url." ".$delete_url." ".$view_url." ".$close_url;   
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
