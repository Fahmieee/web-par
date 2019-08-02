<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 require APPPATH . 'libraries/REST_Controller.php';
class Reviews extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model("Review_items_model");   

    } 

    public function get_reviews_get(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{   
            
            $reviews = $this->Review_items_model->getAllById(); 
            if(!empty($reviews)){ 
                $this->_response['status'] = TRUE;
                $this->_response['message'] = ""; 
                $this->_response['data'] = $reviews; 
            }else{
                 $this->_response['message'] = "Reviews Not Found";
            } 
        
            
            
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    }
    public function review_periodik_post(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{   
            date_default_timezone_set("Asia/Jakarta");
            $this->load->model("Review_periodik_model"); 
            $user_id = $this->post('user_id'); 
            $driver_id = $this->post('driver_id');    
            $grade = $this->post('grade'); //perawatan, perbaikan atau emergency
            $rating =  $this->post('rating'); //parts
            $note = $this->post('note'); 
            $this->load->model("Review_items_model"); 
              $this->load->model("Review_periodik_model"); 
            $reviews = $this->Review_items_model->getAllById(); 
            foreach ($reviews as $key => $value) {
                  $data = array(
                    "user_id"=>$user_id,
                    "driver_id"=>$driver_id,
                    "item_id"=>$value->id,
                    "nilai"=>$grade[$key],
                    "rating"=>$rating,
                    "note"=>$note,
                    "created_at"=>date("Y-m-d H:i:s")
                );
                $insert = $this->Review_periodik_model->insert($data); 
            }
           
            
       
            $this->_response['status'] = TRUE;
            $this->_response['message'] = ""; 
            $this->_response['data'] = $reviews; 
            
        
            
            
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }
    } 

    public function review_spot_post(){
        if(!$this->_detect_api_key()){ 
            $this->_response['message'] = "Token is mitmatch";
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
        }else{    
            date_default_timezone_set("Asia/Jakarta");
            $user_id = $this->post('user_id'); 
            $driver_id = $this->post('driver_id');    
            $nilai = $this->post('nilai'); //perawatan, perbaikan atau emergency
            $rating =  $this->post('rating'); //parts
            $note = $this->post('note');  
            $file = $this->post('file');  
            $this->load->model("Review_spot_model"); 
            $location_path = "./assets/images/review/";   
            $uploaded = $this->uploadFile("file", $location_path,"spot");
            if($uploaded['status']){
                $data = array(
                    "user_id"=>$user_id,
                    "driver_id"=>$driver_id, 
                    "nilai"=>$nilai,
                    "rating"=>$rating,
                    "note"=>$note,
                    "file"=>$uploaded['message'],
                    "created_at"=>date("Y-m-d H:i:s"),
                );
                $insert = $this->Review_spot_model->insert($data); 
                 if(!empty($insert)){ 
                    $this->_response['status'] = TRUE;
                    $this->_response['message'] = ""; 
                    $this->_response['data'] = $data; 
                }else{
                    $this->_response['message'] = "Insert Review is Failed";
                } 
            }else{
                 $this->_response['message'] = $uploaded['message'];
            }
            
           
        
            
            
            $this->set_response($this->_response, REST_Controller::HTTP_OK);
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

}
