<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Dashboard extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		 
    $this->load->model('orders_model');
	}
	public function index()
	{
		$this->load->helper('url');
		$this->data['content'] = 'admin/dashboard';   
    $orders = $this->orders_model->getAllById(array());
    $jumlah_perawatan = 0;
    $jumlah_perbaikan = 0;
    $jumlah_darurat = 0;

    
    $total_today    = 0;
    $current_day =  date("N"); 
    if(!empty($orders)){
      foreach ($orders as $key => $value) {
        if($value->service_type == "treatment"){
          $jumlah_perawatan++;
        }elseif($value->service_type == "repair"){
          $jumlah_perbaikan++;
        }else{
          $jumlah_darurat++;
        }

        $day = date("N",strtotime($value->order_date)); 

        if($current_day == $day){
          $total_today++;
        }
      }
    } 
    $this->data['total_today']=$total_today;
    $this->data['jumlah_perawatan']=$jumlah_perawatan;
    $this->data['jumlah_perbaikan']=$jumlah_perbaikan;
    $this->data['jumlah_darurat']=$jumlah_darurat;
		$this->load->view('admin/layouts/page',$this->data); 
	}
 

  public function dataList()
  {
    $columns = array( 
        0 =>'id', 
        1 =>'orders.order_no',
        2 =>'orders.order_date',
        3=> 'orders.service_type',  
        4=> 'workshop.name',  
        5=> 'workshop.name',  
        6=> 'units.merk',
        7=> 'orders.status',
        8=> 'action'
    );


    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array("status >="=>0);
    $limit = 0;
    $start = 0;
    $totalData = $this->orders_model->getCountAllBy($limit,$start,$search,$order,$dir,$where); 
    

    if(!empty($this->input->post('search')['value'])){
      $search_value = $this->input->post('search')['value'];
        $search = array(
          "units.merk"=>$search_value, 
          "workshop.name"=>$search_value, 
          "units.varian"=>$search_value, 
          "units.no_police"=>$search_value, 
          "units.model"=>$search_value, 
          "users.first_name"=>$search_value, 
        ); 
        $totalFiltered = $this->orders_model->getCountAllBy($limit,$start,$search,$order,$dir,$where); 
    }else{
      $totalFiltered = $totalData;
    } 
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->orders_model->getAllBy($limit,$start,$search,$order,$dir,$where);
      
    $new_data = array();
    if(!empty($datas))
    { 
      foreach ($datas as $key=>$data)
      {  

        $view_url = "";
        $delete_url = "";
        $edit_url = "";
  
        if($this->data['is_can_read'] && $data->status == 0){
          $edit_url = "<a href='".base_url()."maintenance_request/create_wo/".$data->id."' class='btn btn-sm white'><i class='fa fa-pencil'></i> Create WO</a>";
        }   

        $nestedData['id'] = $start+$key+1;
        $nestedData['order_no'] = $data->order_no; 
        $nestedData['driver_name'] = $data->first_name; 
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
        $nestedData['unit_merk'] = $data->unit_merk;  
        $nestedData['no_police'] = $data->no_police;  
        $nestedData['unit_model'] = $data->model;   
        if($data->status == 0){
         $nestedData['status']  = "Waiting Approval";
        }else if($data->status == 1){
         $nestedData['status']  = "On Progress";
        }else if($data->status == 2){
         $nestedData['status']  = "DONE";
        }else{
         $nestedData['status']  = "Close WO";
        }
        $total = intval($data->est_biaya_part)+intval($data->est_biaya_jasa)+intval($data->est_biaya_maintenance);
        $nestedData['total'] = $total;   
        $nestedData['action'] = $edit_url." ".$delete_url;   
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
