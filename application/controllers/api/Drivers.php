<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 require APPPATH . 'libraries/REST_Controller.php';
class Drivers extends REST_Controller {

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

    public function get_drivers_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $this->load->model("driver_model");   
            $driver_id = $this->get('driver_id'); 
            if(!empty($driver_id)){
                $where = array("users.id"=>$driver_id);
            }else{
                $where = array();
            }

            $drivers = $this->driver_model->getAllById($where); 
            if(!empty($drivers)){ 
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $drivers[0]; 
            }else{
                 $this->_response['message'] = "Driver Not Found";
            } 
        
            
            
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }
}
