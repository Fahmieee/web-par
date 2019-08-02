<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 require APPPATH . 'libraries/REST_Controller.php';
class Units extends REST_Controller {

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

    public function get_unit_by_user_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{  
            $this->load->model("scheduler_model");  
            $this->load->model("unit_model"); 
            $user_id = $this->get('user_id'); 
            $role_id = $this->ion_auth->get_users_groups($user_id)->row()->id;

            if($role_id == 2){
                $where = array(
                    "driver_id"=>$user_id 
                );
            }else{
                  $where = array(
                    "user_id"=>$user_id 
                );
            }
          
            $data_scheduler =$this->scheduler_model->getAllById($where);
            if(!empty($data_scheduler) ){   
                $where_unit = array(
                    "units.id="=>$data_scheduler[0]->unit_id
                );
                $data_units = $this->unit_model->getAllById($where_unit);

                if(!empty($data_units)){ 
                    $this->_response['status'] = TRUE;
                    $this->_response['message'] = ""; 
                    $this->_response['data'] = $data_units[0]; 
                }else{
                     $this->_response['message'] = "Unit Not Found";
                } 
                
            }else{
                 $this->_response['message'] = "Pairing Not Found";
            }
            
            
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }
}
