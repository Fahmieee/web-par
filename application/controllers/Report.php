<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Report extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('orders_model');
	}

	public function workorder()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/report/workorder_report_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 

	public function order()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/report/order_report_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 

  public function detailorder()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $unit_id =  $this->uri->segment(3);
      $this->load->model("unit_model");
      $this->data['unit_id'] =$unit_id;
      $units = $this->unit_model->getAllById(array("units.id"=>$unit_id)); 
      if(!empty($units)){
        $this->data['data_units'] = $units;
      }else{
        $this->data['data_units'] = array();
      }
      $this->data['content'] = 'admin/report/orderdetail_report_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  } 
	public function viewOrder()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $order_id = $this->uri->segment(3);
      $this->data['orders'] = $this->orders_model->getAllById(array("orders.id"=>$order_id));
      
      $this->data['content'] = 'admin/report/view_order_report_v';  
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  } 
  public function detailViewOrder()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
      $order_id = $this->uri->segment(3);
      $data_orders = $this->orders_model->getAllById(array("orders.id"=>$order_id));
       $this->data['orders'] = $data_orders[0];
      
			$this->data['content'] = 'admin/report/detailview_order_report_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 
	public function detailworkshop()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
      $workshop_id = $this->uri->segment(3);
      $this->load->model("workshop_model");
      $this->load->model("orders_model");
      $where = array("workshop.id"=>$workshop_id);
      $where_workshop = array("orders.workshop_id"=>$workshop_id);
      $workshops = $this->workshop_model->getAllById($where);
      $orders = $this->orders_model->getAllById($where_workshop);
      $rating = 0;
      $total_rating = 0;
      $index = 0;
      $rata_rating = 0;
      if(!empty($orders)){
        foreach ($orders as $key => $value) {
            $total_rating += $value->rating;
            $index++;
        }
        $rata_rating = $total_rating/$index;  
      } 
      

      $this->data['workshops'] = $workshops[0];
      $this->data['workshop_id'] = $workshop_id;
      $this->data['rata_rating'] = $rata_rating;   
			$this->data['content'] = 'admin/report/workshopdetail_report_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 
	public function review_periodik()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
      $this->load->model("review_periodik_model");
      $this->load->model("review_spot_model");
      $this->load->model("driver_model");
      $driver_id = $this->uri->segment(3);
      $where = array("driver_id"=>$driver_id);
      $where_users = array("users.id"=>$driver_id);
      $users = $this->driver_model->getAllById($where_users);
      $review_periodik = $this->review_periodik_model->getAllById($where);
      $review_spot = $this->review_spot_model->getAllById($where);
      $akumulasirating = 0;
      $jumlahrating = 0;
      if(!empty($review_periodik)){
         foreach ($review_periodik as $key => $value) {
          $akumulasirating += $value->rating;
          $jumlahrating++;
        }
      }
      if(!empty($review_spot)){
        foreach ($review_spot as $key => $value) {
          $akumulasirating += $value->rating;
          $jumlahrating++;
        }
      }

      if($jumlahrating == 0){
        $rata_rating = 0;
      }else{
        $rata_rating = $akumulasirating/$jumlahrating;  
      }
      
      $this->data['rata_rating']  = $rata_rating;
      $result = array();

    
      foreach($review_periodik as $key => $value){
        $month_item = date("n",strtotime($value->created_at));
      
        if(!isset($result[$month_item][$value->item_id])) $result[$month_item][$value->item_id] = array();
        $result[$month_item][$value->item_id] = $value;
      }
      

      $this->data['review_periodik']  =$result;
      $this->data['review_spot']  = $review_spot;
      $this->data['users']  = $users[0];
 
 

			$this->data['content'] = 'admin/report/review_periodik_report_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 
	public function review_spot()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/report/review_spot_report_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 

	public function driver()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
      $this->load->model("driver_model");
      $getAllBy = $this->driver_model->getAllById();
      $this->data['count_driver'] = count($getAllBy);
			$this->data['content'] = 'admin/report/driver_report_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 
	public function workshop()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
      $this->load->model("workshop_model");
      $workshops = $this->workshop_model->getAllById();
      $rekanan = 0;
      $non_rekanan = 0;
      if(!empty($workshops)){
        foreach ($workshops as $key => $value) {
          if($value->type == 1) $rekanan++;
          else $non_rekanan++;
        } 
      } 
      $this->data['jumlah_rekanan'] =  $rekanan;
      $this->data['jumlah_non_rekanan'] =  $non_rekanan;
			$this->data['content'] = 'admin/report/workshop_report_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	} 
  public function orderList()
  {
    $columns = array( 
      0 =>'id', 
      1 =>'units.no_police',
      2=> 'produk.name',  
      3=> 'units.merk',  
      4=> 'units.varian',  
      5=> 'units.years',  
      6=> 'action'
    );

    
    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array();
    $limit = 0;
    $start = 0;
    $totalData = $this->orders_model->getCountAllBy($limit,$start,$search,$order,$dir,$where);  

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;
    if(!empty($searchColumn[1]['search']['value'])){
      $value = $searchColumn[1]['search']['value'];
      $isSearchColumn = true;
      $search['orders.order_wo_no'] = $value;
    }  
     if(!empty($searchColumn[2]['search']['value'])){
      $value = $searchColumn[2]['search']['value'];
      $isSearchColumn = true;
      $search['orders.service_type'] = $value;
    }  

    if(!empty($searchColumn[3]['search']['value'])){
      $value = $searchColumn[3]['search']['value'];
      $isSearchColumn = true;
      $search['orders.service_type'] = $value;
    } 
    if(!empty($searchColumn[4]['search']['value'])){
      $value = $searchColumn[4]['search']['value'];
      $isSearchColumn = true;
      $search["workshop.workshop_name"] = $value;
    } 
 
    if(!empty($searchColumn[5]['search']['value'])){
      $value = $searchColumn[5]['search']['value'];
      $isSearchColumn = true;
      $search["units.no_police"] = $value;
    } 

    if(!empty($searchColumn[6]['search']['value'])){
      $value = $searchColumn[6]['search']['value'];
      $isSearchColumn = true;
      $search["produk.name"] = $value;
    } 


    if($isSearchColumn){ 
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

        $edit_url = "";
        $delete_url = "";
        $view_url = ""; 

        $view_url = "<a href='".base_url()."report/detailorder/".$data->unit_id."' class='btn btn-sm white'><i class='fa fa-detail'></i> View</a>";

            $nestedData['id'] = $start+$key+1;
            $nestedData['unit_name'] = $data->unit_merk;  
            $nestedData['no_police'] = $data->no_police;   
            $nestedData['years'] = $data->years;   
            $nestedData['varian'] = $data->varian;   
            $nestedData['model'] = $data->model;   
           
            
          $nestedData['action'] = $edit_url." ".$delete_url." ".$view_url;   
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
  public function detailOrderList()
	{
    $columns = array( 
      0 =>'id', 
      1 =>'workorders.distance',
      2=> 'workorders.distance',  
      3=> 'action'
    );

		$unit_id = $this->uri->segment(3);
    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
		$where = array("orders.unit_id"=>$unit_id);
		$limit = 0;
		$start = 0;
    $totalData = $this->orders_model->getCountAllDetailOrderBy($limit,$start,$search,$order,$dir,$where);  

    if(!empty($this->input->post('search')['value'])){
    	$search_value = $this->input->post('search')['value'];
       	$search = array(
       		"produk.name"=>$search_value, 
       	); 
       	$totalFiltered = $this->orders_model->getCountAllDetailOrderBy($limit,$start,$search,$order,$dir,$where); 
    }else{
    	$totalFiltered = $totalData;
    } 
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->orders_model->getAllDetailOrderBy($limit,$start,$search,$order,$dir,$where);
     	
    $new_data = array();
    if(!empty($datas))
    { 
      foreach ($datas as $key=>$data)
      {  

        $edit_url = "";
        $delete_url = "";
        $view_url = "";  

    		$view_url = "<a href='".base_url()."maintenance_request/view_wo/".$data->id."' class='btn btn-sm white'><i class='fa fa-detail'></i> View</a>";

            $nestedData['id'] = $start+$key+1;
            $nestedData['order_wo_no'] = $data->order_wo_no;   
            $nestedData['order_date'] =date("Y-m-d",strtotime($data->order_date)) ;  
            $nestedData['order_time'] = date("H:i:s",strtotime($data->order_date)) ;
            $nestedData['workshop_name'] = $data->workshop_name;  
            if($data->service_type == "treatment"){
              $nestedData['maintenance_type'] = "Perawatan";    
            }elseif($data->service_type == "repair"){
               $nestedData['maintenance_type'] = "Perbaikan"; 
            }else{
              $nestedData['maintenance_type'] = "Darurat"; 
            }
            if($data->status == 0){
                 $nestedData['status']  = "Waiting Approval";
               }else if($data->status == 1){
                 $nestedData['status']  = "On Progress";
               }else if($data->status == 2){
                 $nestedData['status']  = "DONE";
               }else{
                 $nestedData['status']  = "Close WO";
               }
             $nestedData['total_idr'] = intval($data->est_biaya_part)+intval($data->est_biaya_jasa)+intval($data->est_biaya_maintenance);
       		$nestedData['action'] = $edit_url." ".$delete_url." ".$view_url;   
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
  public function driverList()
  {
    $this->load->model("review_periodik_model");
    $this->load->model("review_spot_model");
    $columns = array( 
        0 =>'id', 
        1 =>'users.id',
        2=> 'users.first_name',  
        3=> 'users.driver_type',  
        4=> 'users.address',  
        5=> 'action'
    );


    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array();
    $limit = 0;
    $start = 0;
    $totalData = $this->orders_model->getCDriverAllBy($limit,$start,$search,$order,$dir,$where); 
        
      $searchColumn = $this->input->post('columns');
      $isSearchColumn = false;
      if(!empty($searchColumn[1]['search']['value'])){
        $value = $searchColumn[1]['search']['value'];
        $isSearchColumn = true;
        $search['users.id'] = $value;
      }  
       if(!empty($searchColumn[2]['search']['value'])){
        $value = $searchColumn[2]['search']['value'];
        $isSearchColumn = true;
        $search['users.first_name'] = $value;
      }  
 


      if($isSearchColumn){ 
          $totalFiltered = $this->orders_model->getCDriverAllBy($limit,$start,$search,$order,$dir,$where); 
      }else{
        $totalFiltered = $totalData;
      }   

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->orders_model->getDriverAllBy($limit,$start,$search,$order,$dir,$where);

    $new_data = array();
    if(!empty($datas))
    { 
      $review_periodik = "";
      $review_spot = "";
      foreach ($datas as $key=>$data)
      {    

          $nestedData['id'] = $start+$key+1;
          $nestedData['driver_id'] = $data->id;  
          $nestedData['driver_name'] = 
          "<a href='".base_url()."report/review_periodik/".$data->id."'>".$data->first_name."</a>";  
          if($data->driver_type == 1){
            $nestedData['driver_type'] = "DEDICATED";  
          }else{
             $nestedData['driver_type'] = "POOL";  
          }
         
          $nestedData['alokasi'] = $data->address;  
          $nestedData['rating'] = "";    

          $where = array("driver_id"=>$data->id); 
          $review_periodik = $this->review_periodik_model->getAllById($where);
          $review_spot = $this->review_spot_model->getAllById($where);

          $akumulasirating = 0;
          $jumlahrating = 0;
          if(!empty($review_periodik)){
             foreach ($review_periodik as $value) {
              $akumulasirating += $value->rating;
              $jumlahrating++;
            }
          }
          if(!empty($review_spot)){
            foreach ($review_spot as $value) {
              $akumulasirating += $value->rating;
              $jumlahrating++;
            }
          }

          if($jumlahrating == 0){
            $rata_rating = 0;
          }else{
            $rata_rating = $akumulasirating/$jumlahrating;  
          }

          $rating = "";
          $jumlah_rating = 5;
          for ($i=0; $i < $jumlah_rating ; $i++) {  
            if($i < $rata_rating){
               $rating .= '<span class="fa fa-star checked"></span>'; 
            }else{  
               $rating .=' <span class="fa fa-star"></span>';
            }
            
            
          }
          $nestedData['rating'] = $rating;   
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
	public function topDriverList()
	{
 		   $this->load->model("review_periodik_model");
    $this->load->model("review_spot_model");
    $columns = array( 
        0 =>'id', 
        1 =>'users.id',
        2 =>'users.first_name',
        3=> 'users.driver_type',  
        4=> 'users.address',  
        5=> 'action'
    );


    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array();
    $limit = 0;
    $start = 0;
    $totalData = $this->orders_model->getCDriverAllBy($limit,$start,$search,$order,$dir); 
        
    $searchColumn = $this->input->post('columns');
      $isSearchColumn = false;
      if(!empty($searchColumn[1]['search']['value'])){
        $value = $searchColumn[1]['search']['value'];
        $isSearchColumn = true;
        $search['users.id'] = $value;
      }  
       if(!empty($searchColumn[2]['search']['value'])){
        $value = $searchColumn[2]['search']['value'];
        $isSearchColumn = true;
        $search['users.first_name'] = $value;
      }  
 


      if($isSearchColumn){ 
          $totalFiltered = $this->orders_model->getCDriverAllBy($limit,$start,$search,$order,$dir,$where); 
      }else{
        $totalFiltered = $totalData;
      }  

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->orders_model->getDriverAllBy($limit,$start,$search,$order,$dir);

    $new_data = array();
    if(!empty($datas))
    { 
      $review_periodik = "";
      $review_spot = "";
      foreach ($datas as $key=>$data)
      {    

          $nestedData['id'] = $start+$key+1;
          $nestedData['driver_id'] = $data->id;  
          $nestedData['driver_name'] = 
          "<a href='".base_url()."report/review_periodik/".$data->id."'>".$data->first_name."</a>";  
          if($data->driver_type == 1){
            $nestedData['driver_type'] = "DEDICATED";  
          }else{
             $nestedData['driver_type'] = "POOL";  
          }
         
          $nestedData['alokasi'] = $data->address;  
          $nestedData['rating'] = "";    

          $where = array("driver_id"=>$data->id); 
          $review_periodik = $this->review_periodik_model->getAllById($where);
          $review_spot = $this->review_spot_model->getAllById($where);

          $akumulasirating = 0;
          $jumlahrating = 0;
          if(!empty($review_periodik)){
             foreach ($review_periodik as $key => $value) {
              $akumulasirating += $value->rating;
              $jumlahrating++;
            }
          }
          if(!empty($review_spot)){
            foreach ($review_spot as $key => $value) {
              $akumulasirating += $value->rating;
              $jumlahrating++;
            }
          }

          if($jumlahrating == 0){
            $rata_rating = 0;
          }else{
            $rata_rating = $akumulasirating/$jumlahrating;  
          }

          $rating = "";
          $jumlah_rating = 5;
          for ($i=0; $i < $jumlah_rating ; $i++) {  
            if($i < $rata_rating){
               $rating .= '<span class="fa fa-star checked"></span>'; 
            }else{  
               $rating .=' <span class="fa fa-star"></span>';
            }
            
            
          }
          $nestedData['rating'] = $rating;   
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
  public function workshopList()
  {
    $this->load->model("report_model");
    $this->load->model("report_model");
    $type = $this->uri->segment(3);
    $columns = array( 
      0 =>'id', 
      1 =>'workshop.name',
      2=> 'workshop.address',  
      3=> 'action'
    ); 

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array("type"=>$type);
    $limit = 0;
    $start = 0;
    $totalData = $this->report_model->getAllCountWorkshop($limit,$start,$search,$order,$dir,$where); 
        

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;
    if(!empty($searchColumn[1]['search']['value'])){
      $value = $searchColumn[1]['search']['value'];
      $isSearchColumn = true;
      $search['workshop.name'] = $value;
    }  
    if(!empty($searchColumn[2]['search']['value'])){
      $value = $searchColumn[2]['search']['value'];
      $isSearchColumn = true;
      $search['area.name'] = $value;
    }   

    if($isSearchColumn){ 
        $totalFiltered = $this->report_model->getAllCountWorkshop($limit,$start,$search,$order,$dir,$where); 
    }else{
      $totalFiltered = $totalData;
    }  
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->report_model->getAllWorkshop($limit,$start,$search,$order,$dir,$where);
      
    $new_data = array();
    if(!empty($datas))
    { 
      foreach ($datas as $key=>$data)
      {  

        $view_url = "<a href='".base_url()."report/detailworkshop/".$data->id."' class='btn btn-sm white'><i class='fa fa-detail'></i> View</a>";

        $nestedData['id'] = $start+$key+1;
        $nestedData['workshop_name'] = $data->name;  
        $nestedData['workshop_address'] = $data->address;     
        $orders = $this->orders_model->getAllById(array("orders.workshop_id"=>$data->id)); 
        $rating = "";
        if(!empty($orders)){
          $nestedData['order_no'] = $orders[0]->order_no;   
          if($orders[0]->service_type == "treatment"){
            $nestedData['maintenance_type'] = "Perawatan";    
          }elseif($orders[0]->service_type == "repair"){
             $nestedData['maintenance_type'] = "Perbaikan"; 
          }else{
            $nestedData['maintenance_type'] = "Darurat"; 
          }
          
          $jumlah_rating = 5;
          for ($i=0; $i < $jumlah_rating ; $i++) { 
            if($i < $orders[0]->rating){
               $rating .= '<span class="fa fa-star checked"></span>'; 
            }else{  
               $rating .=' <span class="fa fa-star"></span>';
            }
          }
          $nestedData['rating'] = $rating;   
        }else{
          $jumlah_rating = 5;
          for ($i=0; $i < $jumlah_rating ; $i++) { 
              $rating .=' <span class="fa fa-star"></span>'; 
          }
          $nestedData['rating'] = $rating; 
        }
      
        $nestedData['action'] = $view_url;   
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
	public function topWorkshopList()
	{
    $this->load->model("report_model");
    $this->load->model("report_model");
    $type = $this->uri->segment(3);
    $columns = array( 
      0 =>'id', 
      1 =>'workshop.name',
      2=> 'workshop.address',  
      3=> 'action'
    ); 

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array();
    $limit = 0;
    $start = 0;
    $totalData = $this->report_model->getTopCountWorkshop($limit,$start,$search,$order,$dir,$where); 
        
    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;
    if(!empty($searchColumn[1]['search']['value'])){
      $value = $searchColumn[1]['search']['value'];
      $isSearchColumn = true;
      $search['workshop.name'] = $value;
    }  
    if(!empty($searchColumn[2]['search']['value'])){
      $value = $searchColumn[2]['search']['value'];
      $isSearchColumn = true;
      $search['workshop.area_id'] = $value;
    }   

    if($isSearchColumn){ 
        $totalFiltered = $this->report_model->getTopCountWorkshop($limit,$start,$search,$order,$dir,$where); 
    }else{
      $totalFiltered = $totalData;
    }   
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->report_model->getTopWorkshop($limit,$start,$search,$order,$dir,$where);
     	
    $new_data = array();
    if(!empty($datas))
    { 
      foreach ($datas as $key=>$data)
      {  

		    $view_url = "<a href='".base_url()."report/detailworkshop/".$data->id."' class='btn btn-sm white'><i class='fa fa-detail'></i> View</a>";

        $nestedData['id'] = $start+$key+1;
        $nestedData['workshop_name'] = $data->name;  
        $nestedData['workshop_address'] = $data->address;       
        $rating= $data->total_rating/$data->jumlah_workshop;  

        $rating_text = "";
        $jumlah_rating = 5;
        for ($i=0; $i < $jumlah_rating ; $i++) { 
          if($i < $rating){
             $rating_text .= '<span class="fa fa-star checked"></span>'; 
          }else{  
             $rating_text .=' <span class="fa fa-star"></span>';
          }
        }

        $nestedData['rating'] =$rating_text;  
      
   		  $nestedData['action'] = $view_url;   
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


  public function detailWorkshopList()
  {
    $this->load->model("report_model");
    $this->load->model("report_model");
    $workshop_id = $this->uri->segment(3);
    $columns = array( 
      0 =>'id', 
      1 =>'orders.order_no',
      2=> 'orders.order_wo_no',  
      3=> 'orders.order_date',  
      4=> 'orders.service_type',  
      5=> 'action'
    ); 

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array("orders.workshop_id"=>$workshop_id);
    $limit = 0;
    $start = 0;
    $totalData = $this->orders_model->getDetailWorkshopCountAllBy($limit,$start,$search,$order,$dir,$where); 
        

    if(!empty($this->input->post('search')['value'])){
      $search_value = $this->input->post('search')['value']; 
        $totalFiltered = $this->orders_model->getDetailWorkshopCountAllBy($limit,$start,$search,$order,$dir,$where); 
    }else{
      $totalFiltered = $totalData;
    } 
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->orders_model->getDetailWorkshopAllBy($limit,$start,$search,$order,$dir,$where);
      
    $new_data = array();
    if(!empty($datas))
    { 
      foreach ($datas as $key=>$data)
      {  

        $view_url = "<a href='".base_url()."maintenance_request/view_wo/".$data->id."' class='btn btn-sm white'><i class='fa fa-detail'></i> View</a>";
        // $view_url = " ";

        $nestedData['id'] = $start+$key+1;     
        
        $nestedData['order_no'] = $data->order_no;   
        $nestedData['order_wo_no'] = $data->order_wo_no;   
        $nestedData['order_date'] = $data->order_date;   
        if($data->service_type == "treatment"){
          $nestedData['maintenance_type'] = "Perawatan";    
        }elseif($data->service_type == "repair"){
           $nestedData['maintenance_type'] = "Perbaikan"; 
        }else{
          $nestedData['maintenance_type'] = "Darurat"; 
        }

        $rating = "";
        $jumlah_rating = 5;
        for ($i=0; $i < $jumlah_rating ; $i++) { 
          if($i < $data->rating){
             $rating .= '<span class="fa fa-star checked"></span>'; 
          }else{  
             $rating .=' <span class="fa fa-star"></span>';
          }
        }
        $nestedData['rating'] = $rating;    
        $nestedData['note'] = $data->review_note;   
      
        $nestedData['action'] = $view_url;   
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

  public function getReportOrderByMonth(){
    $response_data = array();
    $response_data['status'] = false;
    $response_data['msg'] = "";
    $response_data['data'] = array();   
    
    $orders = $this->orders_model->getAllById(array()); 
    $dataPerawatan = array(0,0,0,0,0,0,0,0,0,0,0,0);
    $dataPerbaikan = array(0,0,0,0,0,0,0,0,0,0,0,0);
    $dataDarurat = array(0,0,0,0,0,0,0,0,0,0,0,0); 
    
    if(!empty($orders)){  
      foreach ($orders as $key => $value) { 
        $month = date("m",strtotime($value->order_date));  

        if($value->service_type == "treatment"){
          $dataPerawatan[ltrim($month, '0')-1] += 1; 
        }elseif($value->service_type == "repair"){
         $dataPerbaikan[ltrim($month, '0')-1] += 1; 
        }else{
         $dataDarurat[ltrim($month, '0')-1] += 1; 
        }
      }
      $response_data['data'] = array(
        "perawatan"=>$dataPerawatan,
        "perbaikan"=>$dataPerbaikan,
        "darurat"=>$dataDarurat 
      );
      $response_data['status'] = true;
    }else{
      $response_data['msg'] = "ID Harus Diisi";
    }
    echo json_encode($response_data); 
  }
  
  public function getReportOrderByWeek(){
    $response_data = array();
    $response_data['status'] = false;
    $response_data['msg'] = "";
    $response_data['data'] = array();   
    
    $orders = $this->orders_model->getAllById(array()); 
    $dataPerawatan  = array(0,0,0,0,0,0,0);
    $dataPerbaikan  = array(0,0,0,0,0,0,0);
    $dataDarurat    = array(0,0,0,0,0,0,0); 
    
    if(!empty($orders)){  
      foreach ($orders as $key => $value) { 
        $day = date("N",strtotime($value->order_date));  

        if($value->service_type == "treatment"){
          $dataPerawatan[ltrim($day, '0')-1] += 1; 
        }elseif($value->service_type == "repair"){
         $dataPerbaikan[ltrim($day, '0')-1] += 1; 
        }else{
         $dataDarurat[ltrim($day, '0')-1] += 1; 
        }
      }
      $response_data['data'] = array(
        "perawatan"=>$dataPerawatan,
        "perbaikan"=>$dataPerbaikan,
        "darurat"=>$dataDarurat 
      );
      $response_data['status'] = true;
    }else{
      $response_data['msg'] = "ID Harus Diisi";
    }
    echo json_encode($response_data);  
  }
  public function getReportOrderByToday(){
    $response_data = array();
    $response_data['status'] = false;
    $response_data['msg'] = "";
    $response_data['data'] = array();   
    
    $orders = $this->orders_model->getAllById(array()); 
    $waiting  = array(0);
    $onprogress  = array(0);
    $done    = array(0);
    
    if(!empty($orders)){  
    $current_day =  date("N"); 
      foreach ($orders as $key => $value) { 
        $day = date("N",strtotime($value->order_date));  
        if($day == $current_day){
          if($value->status == 1){
            $waiting[0] += 1; 
          }elseif($value->status == 2){
           $onprogress[0] += 1; 
          }elseif($value->status == 3){
           $done[0] += 1; 
          }
        }
      }
      $response_data['data'] = array(
        "waiting"=>$waiting,
        "onprogress"=>$onprogress,
        "done"=>$done 
      );
      $response_data['status'] = true;
    }else{
      $response_data['msg'] = "ID Harus Diisi";
    }
    echo json_encode($response_data);  
  }

  public function report_excel(){
    $this->load->library('Libexcel');
    $objPHPExcel = new PHPExcel();
    $arrCol = array();
    $arrCol[] = array('urutan'=>1, 'nilai'=>'No.','fontsize'=> '12', 'bold'=>true, 
      'namanya'=>'nomor', 'format'=>'string');
    $arrCol[] = array('urutan'=>2, 'nilai'=>'No Police.','fontsize'=> '12', 'bold'=>true,'namanya'=>'no_police','format'=>'string');
     $arrCol[] = array('urutan'=>2, 'nilai'=>'No Police.','fontsize'=> '12', 'bold'=>true,'namanya'=>'unit_merk','format'=>'string');
    $arrCol[] = array('urutan'=>3, 'nilai'=>'Model.','fontsize'=> '12', 'bold'=>true, 'namanya'=>'model','format'=>'string');
    $arrCol[] = array('urutan'=>4, 'nilai'=>'Varian.','fontsize'=> '12', 'bold'=>true,'halign'=>'right', 'namanya'=>'varian','format'=>'string');
     $arrCol[] = array('urutan'=>5, 'nilai'=>'Tahun.','fontsize'=> '12', 'bold'=>true,'halign'=>'right', 'namanya'=>'years','format'=>'string');
    
    $datas = $this->orders_model->getAllBy(0,0,array(),0,"DESC",array());
    $nama_file = "REPORT PELAYANAN";

    $arrExcel = array('sNAMESS'=>'PAR', 'sFILNAM'=>$nama_file,'col'=>$arrCol, 'rsl'=>$datas);
    $this->libexcel->createExcel($arrExcel);
  }

  public function report_pdf(){
      $mpdf = new \Mpdf\Mpdf();
      $this->data['datas'] = $this->orders_model->getAllBy(0,0,array(),0,"DESC",array());
       $html = $this->load->view('admin/report/pdf/order_report_v',$this->data,true);
      
     
      $mpdf->WriteHTML($html);
      $mpdf->Output(); // opens in browser
  }
}
