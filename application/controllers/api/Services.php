<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 require APPPATH . 'libraries/REST_Controller.php';
class Services extends REST_Controller {

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

    public function get_perawatan_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $this->load->model("maintenance_model");    
            $this->load->model("orders_model");    
            $this->load->model("unit_model");    

            $user_id = $this->get('user_id'); 
            $unit_id = $this->get('unit_id'); 
            $type = array(); 
            $where = array();
            $where['service_type'] = "treatment";
            if(!empty($user_id)){
                $where['user_id'] = $user_id; 
            }  
            if(!empty($unit_id)){
                $where['unit_id'] = $unit_id; 
            }  
            $data_unit  = $this->unit_model->getAllById(array("units.id"=>$unit_id));
            
            unset($where['user_id']);
            $data_order = $this->orders_model->getAllTreatmentById($where);  
            $max = 0;
            if(!empty($data_order)){
                foreach ($data_order as $key => $value) {
                     $type[] = $value->type;
                     if($max < $value->distance){
                        $max = $value->distance;
                     }
                }
            }

            $where = array("merk"=>$data_unit[0]->merk);
            $data_maintenance =$this->maintenance_model->getAllById($where);
            if(!empty($data_maintenance) ){ 
                $parts = array();   
                foreach ($data_maintenance as $key => $value) {
                   
                    $where = array("maintenance_id"=>$value->id);
                    $data_maintenance_parts =$this->maintenance_model->getAllMaintenanceParts($where);
                    $value->parts = $data_maintenance_parts;  

                    if(!in_array($value->id, $type) && $max < $value->distance){ 
                    
                       $parts[] = $value;
                    }
                    
                }  

                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $parts;  
            }else{
                 $this->_response['message'] = "Maintenance Not Found";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }
    public function get_perbaikan_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $this->load->model("parts_model");    
            $where = array("service_type"=>1);
            $data_parts =$this->parts_model->getAllById($where);
            if(!empty($data_parts) ){     
                    $this->_response['status'] = TRUE;
                    $this->_response['message'] = ""; 
                    $this->_response['data'] = $data_parts;  
            }else{
                 $this->_response['message'] = "Parts Not Found";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }

    public function get_darurat_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $this->load->model("parts_model");    
            $where = array("service_type"=>2);
            $data_parts =$this->parts_model->getAllById($where);
            if(!empty($data_parts) ){     
                    $this->_response['status'] = TRUE;
                    $this->_response['message'] = ""; 
                    $this->_response['data'] = $data_parts;  
            }else{
                 $this->_response['message'] = "Parts Not Found";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    } 

    public function order_workshop_post(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $this->load->model("workshop_model");
            $this->load->model("user_model");
            $this->load->model("driver_model");
            $this->load->model("scheduler_model");
            $this->load->model("preorders_model");
            $this->load->model("maintenance_model");

            $user_id = $this->post('user_id'); 
            $workshop_id = $this->post('workshop_id');    
            $pairing_id = $this->post('pairing_id');    
            $unit_id = $this->post('unit_id');    
            $service_type = $this->post('service_type'); //perawatan, perbaikan atau emergency
            $type =  $this->post('type'); //parts
            $token = $this->post('token');
            $orderType = $this->post('orderType');
            $itemRepair = $this->post('itemRepair');
            $distance = $this->post('distance');
           
            
            $where = array("workshop.id"=>$workshop_id);
            $data_workshop =$this->workshop_model->getAllById($where);
            $workshops = ""; 

            $data_role = $this->ion_auth->get_users_groups($user_id)->row(); 
            $role_id = $data_role->id;
            if($role_id == 2){
                $data_user = $this->driver_model->getAllById(array("users.id"=>$user_id)); 
            }else{

                $data_user = $this->user_model->getAllById(array("users.id"=>$user_id)); 
            }

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

            
            $data_order = $this->preorders_model->getAllById();  
            if(!empty($data_order)){
                $order_no = "PREORDER - ".str_pad(count($data_order)+1, 5, "0", STR_PAD_LEFT)."/".date('dmY');
                
            }else{
                $order_no = "PREORDER - ".str_pad(1, 5, "0", STR_PAD_LEFT)."/".date('dmY');
                
            }  
            $content = " ";
            $data_workshop_pics =$this->workshop_model->getWorkshopPICsByWorkshops($workshop_id);
            if(!empty($data_workshop_pics)){
                foreach ($data_workshop_pics as $key => $value) {
                    $parts = $this->preorders_model->getAllItemById(array("preorder_id"=>$data_order[0]->id, 'preorders_item.status' => 1));
                    $jenis_serpis = '';
                    $part_serpis = '';
                    if($data_order[0]->service_type== "treatment"){
                        $jenis_serpis = "Perawatan";
                    }else if($data_order[0]->service_type== "repair"){
                        $jenis_serpis = "Perbaikan";
                    } else{
                        $jenis_serpis = "Darurat";
                    }
                    if($parts){
                        foreach($parts as $part){
                            $part_serpis .= '<p>'.$part->part_name.'<img src="'.base_url('./assets/images/repair' . $part->file).'"></p>';
                        }
                    }
                    $data_repairing = '
                         Dengan Hormat,<br>
                         Bersama ini kami kirimkan kendaraan Agar diadakan pemeriksaan untuk : '.$jenis_serpis.'
                         <br>'.$part_serpis.' 
                    ';
                    //send email to PIC WORKSHOP;
                   $content = "Hi, ".$value->name."<br> Anda Mendapatkan Order dari ".$data_user[0]->first_name."<br> Silahkan Konfirmasi dengan klik url dibawah ini jika ingin menerima order<br><a href=".base_url()."accept_order/accept/".$value->workshop_id."/".$data_user[0]->id."/".$token."/".$service_type."/".$type.">Accept Order</a><br>" . $data_repairing;
                    $this->send_email("Patrajasa - Order",$value->email, $content);
                }
            }
            
            date_default_timezone_set("Asia/Jakarta");
            $data = array(
                'service_type' =>$service_type, 
                'type' =>$type, 
                'pairing_id' =>$pairing_id, 
                'preorder_no' => $order_no, 
                'order_date' => date('Y-m-d H:i:s'), 
                'unit_id' => $unit_id, 
                'user_id' => $user_id,
                'workshop_id' => $workshop_id, 
                'token' => $token,
                'is_booking' => $orderType,
                'distance' => $distance,
                'status'=>0,
                'description' => ""
            ); 

            if($service_type == "emergency"){
                $data['status'] = 1;
            }
            $insert = $this->preorders_model->insert($data);
            if($insert){
                if($service_type == "treatment"){
                    $data_maintenance = $this->maintenance_model->getAllMaintenanceParts(
                        array("maintenance_id"=>$type)
                    );
                    if(!empty($data_maintenance)){
                        foreach ($data_maintenance as $key => $value) {
                            $data = array(
                                'preorder_id' =>$insert, 
                                'part_id' => $value->part_id,
                                'status'=>0
                            ); 
                            $insert_item = $this->preorders_model->insertItem($data);
                        }
                    }

                    $itemRepair = $this->post('itemRepair'); 
                    $partRepair = json_decode($itemRepair);
                    if(!empty($partRepair)){
                        for ($i=0; $i < count($partRepair) ; $i++) { 
                            $location_path = "./assets/images/repair/";   
                            $other_document = $this->uploadFile($partRepair[$i]->part_id, $location_path,$token);
                             $data = array(
                                'preorder_id' =>$insert, 
                                'part_id' => $partRepair[$i]->part_id,
                                'status'=>1,
                                'file'=>$other_document['message']
                            ); 
                            $insert_item = $this->preorders_model->insertItem($data); 
                        }
                    }
                }else{
                    $itemRepair = $this->post('itemRepair'); 
                    $partRepair = json_decode($itemRepair);
                    if(!empty($partRepair)){
                        for ($i=0; $i < count($partRepair) ; $i++) { 
                            $location_path = "./assets/images/repair/";   
                            $other_document = $this->uploadFile($partRepair[$i]->part_id, $location_path,$token);
                             $data = array(
                                'preorder_id' =>$insert, 
                                'part_id' => $partRepair[$i]->part_id,
                                'status'=>1,
                                'file'=>$other_document['message']
                            ); 
                            $insert_item = $this->preorders_model->insertItem($data); 
                        }
                    }
                }
                
                sendBoNotification(1,"all", "Order maintenance sudah di respon bengkel ",
                                    "Order No :".$order_no,$insert,"PREORDER");
               
                if(!empty($data_workshop)){ 
                    $this->_response['status'] = TRUE;
                    $this->_response['message'] = $content; 
                    $this->_response['data'] = $data_workshop;  
                }else{
                     $this->_response['message'] = "Workshops Not Found";
                } 
            }
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    } 

    public function upload_repair_post(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $itemRepair = $this->post('itemRepair');
            $token = $this->post('token'); 
            $partRepair = json_decode($itemRepair);
            if(!empty($partRepair)){
                for ($i=0; $i < count($partRepair) ; $i++) { 
                    $location_path = "./assets/images/repair/";   
                    $other_document = $this->uploadFile($partRepair[$i]->part_id, $location_path,$token);
                 
                }
            }
            
        }
    }

    public function uploadFile($file_name, $dir,$prefix_file){   
        
        $return_file_name="";
        $config['upload_path']          = $dir;
        $config['allowed_types']        = '*'; 
        $config['file_name'] = $prefix_file."_".time().".jpg";

        $return = array();
        $return['status'] = FALSE;
        $return['message'] = "";

        $this->load->library('upload');
        $this->upload->initialize($config);
        if ($this->upload->do_upload($file_name)){   
            $upload_data = $this->upload->data(); 
            $return_file_name = $config['file_name']; 
            $return['status'] = TRUE;
            $return['message'] = $return_file_name;
        }else{  
            $return['message'] =  $this->upload->display_errors();
        }
        return $return;
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
        $this->email->from('adminerp@prima-armada-raya.com', 'Patrajasa - Order');
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
