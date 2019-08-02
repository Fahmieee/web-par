<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 require APPPATH . 'libraries/REST_Controller.php';
class Order extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
 

    } 

    public function repair_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $order_id = $this->get('order_id');
            $status = $this->get('status');
            $user_id = $this->get('user_id');
            $unit_id = $this->get('unit_id');

            $this->load->model("orders_model");      
            $this->load->model("workshop_model"); 
            $this->load->model("unit_model"); 

            $where = array("service_type"=>"repair");
            if(!empty($user_id)){
                $where['orders.user_id'] = $user_id;
            }  
            if(!empty($unit_id)){
                $where['orders.unit_id'] = $unit_id;
            } 
                 
            if(!empty($order_id)){ 
                $where['orders.id'] = $order_id;
            }

            if(!empty($status)){
                 if($status=="listorder"){
                    $where['orders.status <='] = 2;
                }else{
                    $where['orders.status'] = $status;    
                } 
            } 
            $data_order_repair =$this->orders_model->getAllById($where); 
            
            if(!empty($data_order_repair) ){    
                foreach ($data_order_repair as $key => $value) {
                    $value->order_date = date("d M Y",strtotime($value->order_date));
                    $workshop = $this->workshop_model->getAllById(array("workshop.id"=>$value->workshop_id)); 
                    
                    $workshop_pics = $this->workshop_model->getWorkshopPICs(array("workshop.id"=>$value->workshop_id));

                    $units = $this->unit_model->getAllById(array("units.id"=>$value->unit_id));
                    
                    $items = $this->orders_model->getAllItemById(array("order_id"=>$value->id));
                    foreach ($items as $key => $value2) {
                        if(!empty($value2->file )){
                            $value2->file  = base_url()."assets/images/repair/".$value2->file;
                        }
                    }
                    if(!empty($workshop)){
                        $value->workshop = $workshop[0];
                    }else{
                        $value->workshop = array();
                    }

                    if(!empty($workshop_pics)){
                        $value->workshop_pics = $workshop_pics;
                    }else{
                        $value->workshop_pics = array();
                    } 

                    if(!empty($units)){
                        $value->units = $units[0];
                    }else{
                        $value->units = array();
                    } 

                    if(!empty($items)){
                        $value->items = $items;
                    }else{
                        $value->items = array();
                    }
                    
                }     
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $data_order_repair;  
            }else{
                 $this->_response['message'] = "Order Not Found";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }  
    public function treatment_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $order_id = $this->get('order_id');
            $user_id = $this->get('user_id');
            $status = $this->get('status'); 
            $unit_id = $this->get('unit_id');
            
            $this->load->model("orders_model");      
            $this->load->model("workshop_model");      
            $this->load->model("unit_model");    

            $where = array("service_type"=>"treatment"); 

            if(!empty($user_id)){
                $where['orders.user_id'] = $user_id;
            } 
                
            if(!empty($unit_id)){
                $where['orders.unit_id'] = $unit_id;
            } 
                 
            if(!empty($order_id)){ 
                $where['orders.id'] = $order_id;
            }

            if(!empty($status)){
                if($status=="listorder"){
                    $where['orders.status <='] = 2;
                }else{
                    $where['orders.status'] = $status;    
                } 
            } 
           
          
            $data_order_treatment =$this->orders_model->getAllById($where);  
            if(!empty($data_order_treatment) ){    

                foreach ($data_order_treatment as $key => $value) {
                    $value->order_date = date("d M Y",strtotime($value->order_date));
                    
                    $workshop = $this->workshop_model->getAllById(array("workshop.id"=>$value->workshop_id)); 
                    
                    $workshop_pics = $this->workshop_model->getWorkshopPICs(array("workshop.id"=>$value->workshop_id));

                    $units = $this->unit_model->getAllById(array("units.id"=>$value->unit_id));
                    
                    $items = $this->orders_model->getAllItemById(array("order_id"=>$value->id));
                    if(!empty($items)){
                        foreach ($items as $key => $value2) {
                            if(!empty($value2->file )){
                                $value2->file  = base_url()."assets/images/repair/".$value2->file;
                            }
                        }
                    }
                    
                    if(!empty($workshop)){
                        $value->workshop = $workshop[0];
                    }else{
                        $value->workshop = array();
                    }

                    if(!empty($workshop_pics)){
                        $value->workshop_pics = $workshop_pics;
                    }else{
                        $value->workshop_pics = array();
                    } 

                    if(!empty($units)){
                        $value->units = $units[0];
                    }else{
                        $value->units = array();
                    } 

                    if(!empty($items)){
                        $value->items = $items;
                    }else{
                        $value->items = array();
                    }
                    
                }  
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $data_order_treatment;  
            }else{
                 $this->_response['message'] = "Order Not Found";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }  
    public function emergency_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{      
            $order_id = $this->get('order_id');
            $user_id = $this->get('user_id');
            $status = $this->get('status');
            $unit_id = $this->get('unit_id');

            $this->load->model("orders_model");        
            $this->load->model("unit_model");   
            $this->load->model("workshop_model");   
            $this->load->model("parts_model");   

            
            $where = array("service_type"=>"emergency");
            if(!empty($user_id)){
                $where['orders.user_id'] = $user_id;
            }  

            if(!empty($unit_id)){
                $where['orders.unit_id'] = $unit_id;
            } 

            if(!empty($status)){
                if($status=="listorder"){
                    $where['orders.status <='] = 2;
                }else{
                    $where['orders.status'] = $status;    
                } 
            } 

            if(!empty($order_id)){ 
                $where['orders.id'] = $order_id;
               
            }
            $data_order_emergency =$this->orders_model->getAllById($where); 
            if(!empty($data_order_emergency) ){      
                foreach ($data_order_emergency as $key => $value) {
                    $value->order_date = date("d M Y",strtotime($value->order_date)); 

                    $units = $this->unit_model->getAllById(array("units.id"=>$value->unit_id));
                    $parts = $this->parts_model->getAllById(array("parts.id"=>$value->type));
                    if(!empty($parts)){
                        $value->type_name = $parts[0]->name;
                    }else{
                        $value->type_name = "";
                    }
                    if(!empty($units)){
                        $value->units = $units[0];
                    }else{
                        $value->units = array();
                    }

                    $workshop = $this->workshop_model->getAllById(array("workshop.id"=>$value->workshop_id));

                    if(!empty($workshop)){
                        $value->workshop = $workshop[0];
                    }else{
                        $value->workshop = array();
                    }
                    
                }  
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $data_order_emergency;  
            }else{
                 $this->_response['message'] = "Order Not Found";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }  

    public function all_order_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{      
            $order_id = $this->get('order_id');
            $user_id = $this->get('user_id');
            $this->load->model("orders_model");        
            $this->load->model("unit_model");   
            $this->load->model("workshop_model");   

            $user_id = $this->get('user_id');
            $unit_id = $this->get('unit_id');
            $where = array();
            if(!empty($user_id)){
                $where = array("orders.user_id"=>$user_id);
            }else{
                $where = array();
            }

            if(!empty($order_id)){ 
                $where['orders.id'] = $order_id; 
            }
            if(!empty($unit_id)){ 
                $where['orders.unit_id'] = $unit_id; 
            }
            $where['orders.status >='] = 3;
            $data_all_order =$this->orders_model->getAllById($where); 
            if(!empty($data_all_order) ){      
                foreach ($data_all_order as $key => $value) {
                    $value->order_date = date("d M Y",strtotime($value->order_date)); 

                    $units = $this->unit_model->getAllById(array("units.id"=>$value->unit_id));

                    if(!empty($units)){
                        $value->units = $units[0];
                    }else{
                        $value->units = array();
                    }

                    $workshop = $this->workshop_model->getAllById(array("workshop.id"=>$value->workshop_id));

                    if(!empty($workshop)){
                        $value->workshop = $workshop[0];
                    }else{
                        $value->workshop = array();
                    }
                    
                }  
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $data_all_order;  
            }else{
                 $this->_response['message'] = "Order Not Found";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }  

    public function detail_order_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{      

            $this->load->model("orders_model");        
            $this->load->model("unit_model");   
            $this->load->model("workshop_model");   
            $this->load->model("driver_model");   
            $this->load->model("user_model");   
            $this->load->model("parts_model");   

            $order_id = $this->get('order_id'); 
            $where = array();
             
            if(!empty($order_id)){ 
                $where['orders.id'] = $order_id; 
            }
            $data_all_order =$this->orders_model->getAllById($where); 
            if(!empty($data_all_order) ){      
                foreach ($data_all_order as $key => $value) {
                    $value->order_date = date("d M Y",strtotime($value->order_date)); 

                    $units = $this->unit_model->getAllById(array("units.id"=>$value->unit_id));

                    $parts = $this->parts_model->getAllById(array("parts.id"=>$value->type));
                    if(!empty($parts)){
                        $value->type_name = $parts[0]->name;
                    }else{
                        $value->type_name = "";
                    }
                    if(!empty($units)){
                        $value->units = $units[0];
                    }else{
                        $value->units = array();
                    }
                    $parts = $this->orders_model->getAllItemById(array("order_id"=>$value->id));
                    if(!empty($parts)){
                        foreach ($parts as $key => $value2) {
                            if(!empty($value2->file )){
                                $value2->file  = base_url()."assets/images/repair/".$value2->file;
                            }
                        }
                    }
                   
                    if(!empty($parts)){
                        $value->parts = $parts;
                    }else{
                        $value->parts = array();
                    }

                    $workshop = $this->workshop_model->getAllById(array("workshop.id"=>$value->workshop_id));

                    if(!empty($workshop)){
                        $value->workshop = $workshop[0];
                    }else{
                        $value->workshop = array();
                    }

                    $getLastOrder = $this->orders_model->getAllById(
                        array(
                            "orders.unit_id"=>$value->unit_id,
                            "orders.order_date <="=>date("Y-m-d H:i:s",strtotime($value->order_date)) 
                        )
                    );

                    if(!empty($getLastOrder)){ 
                        $lastOrder = new stdClass();

                        $lastOrderWorkshop = $this->workshop_model->getAllById(
                            array("workshop.id"=>$getLastOrder[0]->workshop_id)
                        );

                        if(!empty($lastOrderWorkshop)){
                            $lastOrder->workshop_name = $lastOrderWorkshop[0]->name; 
                            $lastOrder->workshop_address = $lastOrderWorkshop[0]->address; 
                        }else{
                            $lastOrder->workshop_name =""; 
                            $lastOrder->workshop_address =""; 
                        } 
                        $lastOrder->order_date = $getLastOrder[0]->order_date;
                        
                        $user_id = $getLastOrder[0]->user_id;
                        $data_role = $this->ion_auth->get_users_groups($user_id)->row(); 
                        $role_id = $data_role->id;
                        $lastOrder->role_name = $data_role->name;
                        if($role_id == 2){
                            $data_user = $this->driver_model->getAllById(array("users.id"=>$user_id)); 
                        }else{
                            $data_user = $this->user_model->getAllById(array("users.id"=>$user_id)); 
                        }

                        if(!empty($data_user)){ 
                            $lastOrder->first_name = $data_user[0]->first_name;
                        }else{
                             $lastOrder->first_name = "";
                        }
                        
                        $lastOrder->service_type = $getLastOrder[0]->service_type; 

                        $lastOrderParts = $this->orders_model->getAllItemById(
                            array("order_id"=>$getLastOrder[0]->id)
                        );

                        if(!empty($lastOrderParts)){
                            $lastOrder->parts = $lastOrderParts; 
                        }else{
                            $lastOrder->parts = array(); 
                        }
                       

                        $value->lastOrder = $lastOrder;
                    }else{
                        $value->lastOrder = array();
                    }
                    
                }  
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $data_all_order[0];  
            }else{
                 $this->_response['message'] = "Order Not Found";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }  

    public function send_emergency_post(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $user_id = $this->post('user_id');
            $unit_id = $this->post('unit_id');
            $description = $this->post('description');
            $order_date = $this->post('order_date');
            $type = $this->post('type');
           
                $this->load->model("workshop_model");
            $this->load->model("user_model");
            $this->load->model("driver_model");
            $this->load->model("orders_model");
            $this->load->model("scheduler_model"); 

            $data_order_emergency =$this->orders_model->getAllById(array("orders.service_type"=>"emergency")); 
            $data_order = $this->orders_model->getAllById(); 
            if(!empty($data_order)){
                $order_no = "PAR - ".str_pad(count($data_order)+1, 5, "0", STR_PAD_LEFT)."/".date('dmY'); 
            }else{
                $order_no = "";
            } 
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
            
            $data_scheduler = $this->scheduler_model->getAllById($where); 
             if(!empty($data_scheduler)){ 
                $pairing_id = $data_scheduler[0]->id; 
            }else{
                $pairing_id = 0; 
            }
            date_default_timezone_set("Asia/Jakarta");
            $data = array(
                'service_type' =>"emergency", 
                'unit_id' => $unit_id, 
                'order_no' => $order_no, 
                'order_date' => date('Y-m-d H:i:s'), 
                'user_id' => $user_id,
                'status' => 1,
                'type' => $type,
                'pairing_id' => $pairing_id,
                'description' => $description
            ); 
            $insert = $this->orders_model->insert($data);
            if ($insert)
            {  
                $data['order_id'] = $insert;
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $data;  
            }else{
                 $this->_response['message'] = "Gagal Menyimpan Emergency";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }  
    public function done_post(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            
            $note = $this->post('note');  
            $rating = $this->post('rating');  
            $order_id = $this->post('order_id');
            $this->load->model("orders_model"); 

             $data = array( 
                'status' => 3,
                'rating' => $rating,
                'review_note' => $note
            ); 
            $update = $this->orders_model->update($data,array("id"=>$order_id));
            if ($update)
            { 
                 $data_order = $this->orders_model->getAllById(array("orders.id"=>$order_id));
                 sendBoNotification(1,"all", "Maintenance sudah selesai",
                                    "Order No :".$data_order[0]->order_no,$order_id,"ORDER");

                $data['order_id'] = $update;
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $data;  
            }else{
                 $this->_response['message'] = "Gagal Menyimpan Status";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }  
 
}
