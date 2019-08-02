<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Auth extends REST_Controller {

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

    public function login_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $fcm_token = $this->post('fcm_token');
        $uuid = $this->post('uuid');
        $this->load->model("ion_auth_model"); 
        $this->load->model("user_model");
        $isAuthenticated = $this->ion_auth_model->login($username,$password);
        $data_users = $this->ion_auth->user()->row();
        $data = array();
        $token =substr( _hash($username.time()), 0, config_item('rest_key_length'));
        if(!empty($data_users)){
            if($data_users->active == 1){ 
                if($data_users->uuid == $uuid || $data_users->uuid == ""){

                    if($data_users->uuid == ""){
                        //update FCM TOKEN
                        $data = array(
                            'uuid' => $uuid
                        ); 
                        $update = $this->user_model->update($data,array("id"=>$data_users->id));
                    }
                    if($isAuthenticated){  
                        ///INSERT TOKEN LOGIN
                        $isHasToken = $this->ion_auth_model->checkToken($data_users->id); 
                        if(!$isHasToken){
                            $dataToken = array(
                                "key"=>$token,
                                "user_id"=>$data_users->id
                            );
                            $insertToken = $this->ion_auth_model->addToken($dataToken); 
                        }else{
                            $dataToken = array(
                                "key"=>$token
                            );
                            $insertToken = $this->ion_auth_model->updateToken($dataToken,array("user_id"=>$data_users->id));
                        } 
                        $data_users->token = $token;

                        //update FCM TOKEN
                        $data = array(
                            'fcm_token' => $fcm_token
                        ); 
                        $update = $this->user_model->update($data,array("id"=>$data_users->id));


                        $user_groups = $this->ion_auth->get_users_groups($data_users->id)->row(); 
                        $data_users->role_id = $user_groups->id;
                        $data_users->role_name = $user_groups->name;
                        $this->load->model("role_model");
                        if($data_users->role_id == 3){
                            $data_jabatan = $this->role_model->getAllById(array("role.id"=>$data_users->department));
                             if(!empty($data_jabatan)){ 
                                $data_users->department=$data_jabatan[0]->name;
                            }
                        }else{
                            $data_jabatan = $this->role_model->getAllById(array("role.id"=>$data_users->role_id));
                             if(!empty($data_jabatan)){ 
                                $data_users->jabatan=$data_jabatan[0]->name;
                            }
                        }
                        
                       
                        if(!empty($data_users->foto)){
                            $data_users->foto = base_url()."assets/images/foto/thumbs/".$data_users->foto;    
                        }else{
                            $data_users->foto = base_url()."assets/images/user.png";
                        } 
                        
                        if($data_users->role_id == 1){
                            $this->_response = [
                                'status' =>false, 
                                'data' => $data_users, 
                                'message' => 'Cannot Access Mobile'
                            ];
                        }else{
                            $this->_response = [
                                'status' => true, 
                                'data' => $data_users, 
                                'message' => 'Success'
                            ];
                        }
                        
                         
                    }else{
                        $this->_response = [
                            'status' => false, 
                            'data' => array(), 
                            'message' => $this->ion_auth->errors()
                        ];
                    }
                }else{
                    $this->_response = [
                        'status' => false, 
                        'data' => array(), 
                        'message' => "User Sedang Digunakan"
                    ];
                }
                
            }else{
                $this->_response = [
                    'status' => false, 
                    'data' => array(), 
                    'message' => "User Not Active, Please Verification Your Code"
                ];
            }
        }else{
            $this->_response = [
                'status' => false, 
                'data' => array(), 
                'message' => "User Not Found"
            ];
        }
       
        

        $this->set_response($this->_response, REST_Controller::HTTP_OK);
    } 

    public function get_profile_get(){
        $user_id = $this->get('user_id');
        $this->load->model("role_model");
        $data_users = $this->ion_auth_model->getUsersBy(array("id"=>$user_id));
        if(!empty($data_users)){
            $user_groups = $this->ion_auth->get_users_groups($data_users[0]->id)->row(); 
            $data_users[0]->role_id = $user_groups->id;
            $data_users[0]->role_name = $user_groups->name;

            if(!empty($data_users[0]->foto)){
                $data_users[0]->foto = base_url()."assets/images/foto/thumbs/".$data_users[0]->foto;    
            }else{
                $data_users[0]->foto = base_url()."assets/images/user.png";
            } 

            if($data_users[0]->role_id == 3){
                $data_jabatan = $this->role_model->getAllById(array("role.id"=>$data_users[0]->department));
                 if(!empty($data_jabatan)){ 
                    $data_users[0]->department=$data_jabatan[0]->name;
                }
            }else{
                $data_jabatan = $this->role_model->getAllById(array("role.id"=>$data_users[0]->role_id));
                 if(!empty($data_jabatan)){ 
                    $data_users[0]->jabatan=$data_jabatan[0]->name;
                }
            }

            $this->_response = [
                    'status' => TRUE, 
                    'data' => $data_users[0], 
                    'message' => ""
                ];
        }else{
            $this->_response = [
                'status' => false, 
                'data' => array(), 
                'message' => "User Not Found"
            ];
        }
       $this->set_response($this->_response, REST_Controller::HTTP_OK);

       
    }
    public function logout_post()
    {  
        $user_id = $this->post('user_id'); 
        $this->load->model("user_model");
        if(!empty($user_id)){ 
            $data = array(
                'uuid' => ""
            ); 
            $update = $this->user_model->update($data,array("id"=>$user_id));
            if($update){
                 
                $this->_response['status'] = TRUE;
                $this->_response['message'] = "";
            
            }else{
                 $this->_response['message'] = "Logout Gagal";
            }
           
        }else{
            $this->_response['message'] = "User ID is required";
        }

        $this->set_response($this->_response, REST_Controller::HTTP_OK); 
    } 
    public function change_password_post()
    {  
        $email = $this->post('email');
        $password = $this->post('password');

        if(!empty($email) && !empty($password)){ 
            $dataUsers = $this->ion_auth_model->getUsersBy(array("email"=>$email));
            if(!empty($dataUsers)){
                 $isChangePassword = $this->ion_auth_model->change_password_without_old(
                                        $dataUsers[0]->username,$password
                                    ); 
                if($isChangePassword){
                    $this->_response['status'] = TRUE;
                    $this->_response['message'] = "";
                }else{

                    $this->_response['message'] =  $this->ion_auth_model->errors();
                }
            }else{
                 $this->_response['message'] = "Email Not Found";
            }
           
        }else{
            $this->_response['message'] = "Email Or New Password is required";
        }

        $this->set_response($this->_response, REST_Controller::HTTP_OK); 
    }   
     public function reset_password_post()
    {  
        $email = $this->post('email'); 
        if(!empty($email)){ 
            $identity_column = 'email';
            $identity = $this->ion_auth->where($identity_column, $this->input->post('email'))->users()->row();

            if (empty($identity))
            { 
                $this->_response['message'] = $this->ion_auth->errors();
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($email);

            if ($forgotten)
            {
               
                 $this->_response['message'] = $this->ion_auth->messages();
            }
            else
            {
                 $this->_response['message'] = $this->ion_auth->errors();
            }
           
        }else{
             $this->_response['message'] = "Please Complete Form";
        }
       

         $this->set_response($this->_response, REST_Controller::HTTP_OK);
    } 

    public function resend_email_post(){
        $email = $this->post('email');  
        if(!empty($email)){     
            $dataUsers = $this->ion_auth_model->getUsersBy(array("email"=>$email)); 
            if(!empty($dataUsers)){  
                if($this->sendEmail($dataUsers[0]->username,$email,$dataUsers[0]->code)){  
                    $this->_response['status'] = true;
                }else{
                    $this->_response['message'] = "Failed Send Email";
                }
                
            }else{
                 $this->_response['message'] = "Email Not Found";
            }
           
        }else{
             $this->_response['message'] = "Please Complete Form";
        } 
        $this->set_response($this->_response, REST_Controller::HTTP_OK);
    }
    public function sendEmail($username,$email,$code){
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
        $this->email->from('adminerp@prima-armada-raya.com', 'Patrajasa - Reset Password');
        $this->email->to($email); 
        $this->email->subject('Reset Password');
        
        $email_content['code'] = $code;
        $email_content['username'] = $username;
        
        $message = $this->load->view('auth/email/confirmation_account', $email_content, true);
        
        $this->email->message($message); 
        $this->email->send();

        return true;
      
    }
    public function update_profile_post()
    { 
        $this->load->model("driver_model");
        $this->load->model("user_model");
        $role_id = $this->post('role_id');  
        $user_id = $this->post('user_id');  
        $name = $this->post('name');  
        $phone = $this->post('noPhone');  
        $email = $this->post('email');  
        $address = $this->post('address');  
        $company = $this->post('company');  
        $department = $this->post('position');  
        $nip = $this->post('nip');  
        //driver
        $nik = $this->post('nik');  
        $driver_sim_no = $this->post('noSIM');  
        $driver_sim_date = $this->post('expireDate');   

        if(!empty($user_id)){     
            $data = array(
                'first_name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'company' => $company,
                'department' => $department,
                'nip' => $nip,
                'driver_sim_no' => $driver_sim_no,
                'driver_sim_date' => $driver_sim_date
            ); 
            if($role_id == 2){
                 $update = $this->driver_model->update($data,array("id"=>$user_id));
            }else{
                 $update = $this->user_model->update($data,array("id"=>$user_id));
            }
              $this->_response['status'] = TRUE;
              $this->_response['message'] = "";
              $this->_response['data'] = $update;
           
        }else{
             $this->_response['message'] = "Please Complete Form";
        } 
        $this->set_response($this->_response, REST_Controller::HTTP_OK);
        $this->set_response($this->_response, REST_Controller::HTTP_OK);
    } 

    public function upload_profile_put()
    { 
        $this->set_response($this->_response, REST_Controller::HTTP_OK);
    }   
    public function notif_post()
    {    
        $send = sendNotification("/topics/all","Push Notification","Lorem Epsum","1","pmku");
        if($send){
              $this->_response['status'] = TRUE;
              $this->_response['message'] = "";
              $this->_response['data'] = $send;
        }
        $this->set_response($this->_response, REST_Controller::HTTP_OK);
    }  

    public function send_email_post()
    {    

        $email = $this->post('email');
        $code = $this->post('code'); 
        $username = $this->post('username'); 
        
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
        $this->email->from('adminerp@prima-armada-raya.com', 'Patrajasa - noreply');
        $this->email->to($email); 
        $this->email->subject('Verification Code');
        
        $email_content['code'] = $code;
        $email_content['username'] = $username;
        
        $message = $this->load->view('auth/email/confirmation_account', $email_content, true);
        
        $this->email->message($message); 
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
        $this->set_response($this->_response, REST_Controller::HTTP_OK);
    }  
      
}
