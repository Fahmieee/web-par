<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 require APPPATH . 'libraries/REST_Controller.php';
class Workshop extends REST_Controller {

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

    public function find_nearby_post(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $this->load->model("workshop_model");    
            $this->load->model("user_model");    
            $this->load->model("driver_model");    
            $this->load->model("maintenance_model");    
            $order_date = $this->post('order_date');
            $service_type = $this->post('service_type'); //perawatan, perbaikan atau emergency
            $type =  $this->post('type'); //parts
            $user_id = $this->post('user_id');
            $radius = $this->post('radius');
            $lat = $this->post('lat');
            $long = $this->post('long');
            $token = $this->post('token');
            $merk = $this->post('merk');
            $workshops = "";
            $parts = "";
            $data_role = $this->ion_auth->get_users_groups($user_id)->row(); 
            $role_id = $data_role->id;
            if($role_id == 2){
                $data_user = $this->driver_model->getAllById(array("users.id"=>$user_id)); 
            }else{

                $data_user = $this->user_model->getAllById(array("users.id"=>$user_id)); 
            }

            if($service_type == "treatment"){
                $data_maintenance = $this->maintenance_model->getAllMaintenanceParts(array("maintenance_parts.maintenance_id"=>$type));
                foreach ($data_maintenance as $key => $value) {
                   $parts .= $value->part_id.",";
                }
                $parts = substr($parts, 0,-1);
                //search workshop yang punya spesifikasi parts diatas
                $data_workshop = $this->workshop_model->getWorkshopPartsByPartID($parts);
                if(!empty($data_workshop)){
                    foreach ($data_workshop as $key => $value) {
                        $workshops .=$value->workshop_id.",";
                    }
                }
                
               $workshops = substr($workshops, 0,-1);
            }elseif($service_type == "repair"){ 
                $itemRepair = $this->post('itemRepair');
            
                for ($i=0; $i < count($itemRepair) ; $i++) {  
                   $parts .= $itemRepair[$i]['part_id'].",";
                }
                $parts = substr($parts, 0,-1);
                //search workshop yang punya spesifikasi parts diatas
                $data_workshop = $this->workshop_model->getWorkshopPartsByPartID($parts);
                if(!empty($data_workshop)){
                    foreach ($data_workshop as $key => $value) {
                        $workshops .=$value->workshop_id.",";
                    }
                }
                
               $workshops = substr($workshops, 0,-1);
            }else{
                $data_workshop = $this->workshop_model->getWorkshopPartsByPartID($type);
                foreach ($data_workshop as $key => $value) {
                    $workshops .=$value->workshop_id.",";
                }
               $workshops = substr($workshops, 0,-1);
            }
            if($workshops != ""){
                $radius = $radius/1000;
                $data_workshop_nearby =$this->workshop_model->findNearby($lat,$long,$radius,$workshops,$merk);

                if(!empty($data_workshop_nearby) ){   
                    $lat = 0.0;
                    $lon = 0.0;
                    foreach ($data_workshop_nearby as $key => $value) {
                        $lat += $value->lat; // or $marker['lat'] I don't remember
                        $lon += $value->long; // or $marker['lon'] ? 
                    } 

                    $centerlat = $lat / count($data_workshop_nearby);
                    $centerlong = $lon / count($data_workshop_nearby);

                    $response_data = array( 
                        "workshop"=>$data_workshop_nearby,
                        "centerlat"=>$centerlat,
                        "centerlong"=>$centerlong,
                    );
                    $this->_response['status'] = TRUE;
                    $this->_response['message'] = ""; 
                    $this->_response['data'] = $response_data;  
                }else{
                     $this->_response['message'] = "Workshops Not Found";
                } 
            }else{
                $this->_response['message'] = "Workshops Not Found";
            }
            
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    } 


    public function find_workshop_post(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $this->load->model("workshop_model");    
             

            $name = $this->post('name');
            $merk = $this->post('merk');
            $lat = $this->post('lat');
            $long = $this->post('long'); 
            if(empty($lat)){
                $lat = -1;
            }
            if(empty($long)){
                $long = -1;
            }
            $data_workshop =$this->workshop_model->findWorkshop($lat,$long,$name,$merk);

            if(!empty($data_workshop) ){   
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $data_workshop;  
            }else{
                 $this->_response['message'] = "Workshops Not Found";
            } 
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }  
 
}
