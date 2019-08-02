<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Darurat extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('orders_model');
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/darurat/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 
	public function detail()
	{ 
		$this->form_validation->set_rules('order_id',"Order Harus Diisi", 'trim|required');   
		$this->form_validation->set_rules('order_wo_no',"Work Order No Harus Diisi", 'trim|required');   

		if ($this->form_validation->run() === TRUE)
		{ 
			$order_id = $this->input->post('order_id');
			$data = array( 
				'order_wo_no' => $this->input->post('order_wo_no'), 
				'status' => 1 
			); 
			if ($this->orders_model->update($data,array("id"=>$order_id)))
			{ 
				$this->session->set_flashdata('message', "Success Create Work Order");
				redirect("maintenance_request");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Failed Create Work Order");
				redirect("maintenance_request");
			}
		}else{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("role/edit/".$id);	
			}else{
				$id= $this->uri->segment(3); 
				$this->data['id']= $id; 

				$this->load->model("orders_model");
				$this->load->model("workshop_model");
				$this->load->model("unit_model");
				$this->load->model("maintenance_model");
				$this->load->model("parts_model");
				$this->load->model("preorders_model");

				$data_order = $this->orders_model->getAllById(array("orders.order_wo_no IS NOT NULL"=>null)); 
				$orders = $this->orders_model->getAllById(array("orders.id"=>$id));
				if(!empty($orders)){ 
					$this->data['orders'] = $orders[0];
					$workshop_id = $orders[0]->workshop_id;
					$workshops = $this->workshop_model->getAllById(array("workshop.id"=>$workshop_id));
					$this->data['workshops'] = $workshops[0];
					
					$unit_id = $orders[0]->unit_id;
					$units = $this->unit_model->getAllById(array("units.id"=>$unit_id));
					$this->data['units'] = $units[0];

					$service_type = $orders[0]->service_type;
					$type = $orders[0]->type;
					$data_maintenance = array();
					if($service_type == "treatment"){ 
						$maintenance = $this->maintenance_model->getAllById(array("maintenance.id"=>$type));
						$maintenance_id = $maintenance[0]->id;
						$parts = $this->maintenance_model->getAllMaintenanceParts(array("maintenance_id"=>$maintenance_id));
						$data_maintenance = $maintenance[0];
						if($orders[0]->status === 1){
							$preorders = $this->preorders_model->getAllById(array("preorders.token"=>$token));
			          		$part_repairs = $this->preorders_model->getAllItemById(
			          			array(
			          				"preorders_item.status"=>1,
			          				"preorders_item.preorder_id"=>$preorders[0]->id
			          			)
			          		);
						}else{
							$part_repairs = $this->orders_model->getAllItemById(
								array(
									"order_id"=>$orders[0]->id,
									"status"=>1
							));
						}
						
					}elseif($service_type == "emergency"){ 
						$units = $this->unit_model->getAllById(array("units.id"=>$unit_id));
						$maintenance = $this->parts_model->getAllById(array("parts.id"=>$orders[0]->type));
						$data_maintenance = $maintenance[0];
					}else{
						$parts = $this->orders_model->getAllItemById(array("order_id"=>$orders[0]->id));
					}
					$this->data['maintenance'] = $data_maintenance;
					$this->data['parts'] = (!empty($parts))?$parts:array(); 
					$this->data['part_repairs'] = (!empty($part_repairs))?$part_repairs:array(); 
				}else{
					$this->data['orders'] = array();

				}

				if(!empty($data_order)){
					$order_wo_no = "WO - ".str_pad(count($data_order)+1, 5, "0", STR_PAD_LEFT)."/".date('dmY'); 
	         	}else{
	         		$order_wo_no = "WO - ".str_pad(1, 5, "0", STR_PAD_LEFT)."/".date('dmY');
	         	} 

				$this->data['order_wo_no'] =$order_wo_no; 
			 	 
			 
				if($orders[0]->service_type == "treatment"){
					$this->data['content'] = 'admin/darurat/detail_treatment_v'; 

				}else{
					$this->data['content'] = 'admin/darurat/detail_repair_v'; 
				}
				$this->load->view('admin/layouts/page',$this->data); 
			}
		}
	}  

	public function dataList()
	{
		$columns = array( 
            0 =>'id', 
            1 =>'orders.order_no',
            2 =>'orders.order_date',
            3=> 'orders.service_type',  
            4=> 'workshop.name',  
            5=> 'users.first_name',  
            6=> 'produk.name',
            7=> 'orders.status',
            8=> 'action'
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$where = array("status"=>1,"service_type"=>"emergency");
  		$start = 0;
        $totalData = $this->orders_model->getCountAllDaruratBy($limit,$start,$search,$order,$dir,$where); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"produk.name"=>$search_value, 
           		"workshop.name"=>$search_value, 
           		"users.first_name"=>$search_value, 
           	); 
           	$totalFiltered = $this->orders_model->getCountAllDaruratBy($limit,$start,$search,$order,$dir,$where); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->orders_model->getAllDaruratBy($limit,$start,$search,$order,$dir,$where);
     	
        $new_data = array();
        if(!empty($datas))
        { 
            foreach ($datas as $key=>$data)
            {  

            	$view_url = "";
     			$delete_url = "";
     			$edit_url = "";
     			$close_url = ""; 
            	
            	$view_url = "<a href='".base_url()."darurat/detail/".$data->id."' class='btn btn-sm white'><i class='fa fa-detail'></i> Detail</a>";
            

                $nestedData['id'] = $start+$key+1;
                $nestedData['order_no'] = $data->order_no; 
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
                $nestedData['unit_name'] = $data->unit_merk;  
                if($data->status == 0){
                 $nestedData['status']  = "Waiting Approval";
               	}else if($data->status == 1){
                 $nestedData['status']  = "Approved";
               	}else if($data->status == 2){
                 $nestedData['status']  = "On Progress";
               	}else if($data->status == 3){
                 $nestedData['status']  = "Done";
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

	function send_email($subject,$email, $content)
    {            
        $config = array( 
            'protocol' => 'smtp',
		    'smtp_host' => 'smtp.office365.com',
		    'smtp_user' => 'adminerp@prima-armada-raya.com',
		    'smtp_pass' => 'Par12345',
		    'smtp_crypto' => 'tls',    
		    'newline' => "\r\n", //REQUIRED! Notice the double quotes!
		    'smtp_port' => 587,
		    'mailtype' => 'html',
		    'mail_charset' => 'iso-8859-1',
            'wordwrap'=>TRUE 
        );
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n"); 
        $this->email->from('adminerp@prima-armada-raya.com', 'Patrajasa - Work Order');
        $this->email->to($email); 
        $this->email->subject($subject);
        
        $email_content['content'] = $content;
        
        // $message = $this->load->view('auth/email/default_email', $email_content); 
        $this->email->message($content); 
        if ($this->email->send())
        {
            $this->_response['status'] = TRUE;
            $this->_response['message'] = "";
            $this->_response['data'] = "";
        }
        else
        {
             $this->_response['message'] = $this->email->print_debugger();
        } 
    } 
}
