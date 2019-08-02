<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 require APPPATH . 'libraries/REST_Controller.php';
class Scheduler extends REST_Controller {

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

    public function update_km_post()
    {
        $user_id = $this->post('user_id');
        $no_police = $this->post('no_police');
        $last_km = $this->post('last_km');
        $this->load->model("scheduler_model");  
        $this->load->model("unit_model");  
        $this->load->model("driver_model");  
        $this->load->model("user_model");  
        $where_unit = array(
            "REPLACE(no_police,' ','') = "=>str_replace(' ', '', $no_police)
        );
        $data_unit = $this->unit_model->getAllById($where_unit);
        if(!empty($data_unit)){ 
            $data_user = $this->ion_auth->get_users_groups($user_id)->row(); 
            $role_id = $data_user->id;

            if($role_id == 2){
                 $where = array( 
                    "unit_id"=>$data_unit[0]->id,
                    "driver_id"=>$user_id 
                );
            }else{
                $where = array( 
                    "unit_id"=>$data_unit[0]->id,
                    "user_id"=>$user_id
                );
            }
            $data_scheduler =$this->scheduler_model->getAllById($where);

           
            if(!empty($data_scheduler)){

                foreach ($data_scheduler as $key => $value) {
                    $units = $this->unit_model->getAllById(array("units.id"=>$value->unit_id));
                    if(!empty($units)){
                        $value->units = $units[0];
                    }else{
                        $value->units = array();
                    }
                    $drivers = $this->driver_model->getAllById(array("users.id"=>$value->driver_id));
                    if(!empty($drivers)){
                        $value->drivers = $drivers[0];
                    }else{
                        $value->drivers = array();
                    }
                    $users = $this->user_model->getAllById(array("users.id"=>$value->user_id));
                    if(!empty($users)){
                        $value->users = $users[0];
                    }else{
                        $value->users = array();
                    } 
                    $value->end_date = date("Y-m-d",strtotime($value->end_date));
                }

                $data_update = array("last_km"=>$last_km);
                $update_km = $this->scheduler_model->update($data_update,$where); 
                $data_scheduler[0]->last_km = $last_km;
                $this->_response = [
                    'status' => true, 
                    'data' => $data_scheduler[0], 
                    'message' => 'Success'
                ]; 
            }else{
                 $this->_response = [
                        'status' => false, 
                        'data' => array(), 
                        'message' => "Pairing Not Found"
                    ];
            }
        }else{
             $this->_response = [
                        'status' => false, 
                        'data' => array(), 
                        'message' => "Unit Not Found"
                    ];
        }
       
        

        $this->set_response($this->_response, REST_Controller::HTTP_OK);
    }  

    public function get_scheduler_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{ 

            $this->load->model("scheduler_model");  
            $this->load->model("unit_model");  
            $this->load->model("driver_model");  
            $user_id = $this->get('user_id');
            $unit_id = $this->get('unit_id');
            $data = array();

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
                $data['detail_scheduler'] = $data_scheduler[0];
                $data_units = array();
               
                foreach ($data_scheduler as $key => $value) {
                    $where_unit = array(
                        "units.id="=>$value->unit_id
                    );
                    $get_units = $this->unit_model->getAllById($where_unit);

                   $data_units[] = $get_units[0];
                }
                if(!empty($data_scheduler[0]->driver_id)){ 
                    $where_driver = array(
                        "users.id="=> $data_scheduler[0]->driver_id
                    );
                    $get_drivers = $this->driver_model->getAllById($where_driver);
                    $data_drivers = $get_drivers[0];
                    if(!empty($get_drivers)){
                       foreach ($get_drivers as $key => $value) { 
                           $value->driver_sim_date = date("d M Y",strtotime($value->driver_sim_date)); 
                           $value->next_review = date("M Y",strtotime($value->driver_sim_date)); 
                        } 
                    }
                    
                }else{
                    $data_drivers = array();
                } 
                if(!empty($data_units)){
                    $data['drivers'] = $data_drivers;
                    $data['units'] = $data_units;
                    $this->_response['status'] = TRUE;
                    $this->_response['message'] = ""; 
                    $this->_response['data'] = $data; 
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
