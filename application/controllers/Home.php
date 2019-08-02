<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller { 
	public function index()
	{
		$this->load->helper('url');
		$data = array();

		$this->load->model("schedule_model");
		$this->load->model("pandu_model");
		$where = array(
          "schedule_status"=>1,
          "sliptime_start >="=>date('Y-m-d H:i:s', time()),
          "sliptime_start <="=>date('Y-m-d H:i:s', time() + 86400)
        );

		$search = array();
		empty($this->input->post('tugs_name'))?0:$search['pandu.first_name'] = $this->input->post('tugs_name');
		is_null($this->input->post('ppjk_status'))?0:$where['ppjk_status'] = $this->input->post('ppjk_status');

		if (!empty($this->input->post('sliptime_start_from'))) {
			$search_date_from = date("Y-m-d H:i:s", strtotime($this->input->post('sliptime_start_from')));
			$where['sliptime_start >='] = $search_date_from;
		}

		if (!empty($this->input->post('sliptime_start_to'))) {
			$search_date_to = date("Y-m-d H:i:s", strtotime($this->input->post('sliptime_start_to')."+1 day"));
			$where['sliptime_start <='] = $search_date_to;
		}

		if (!empty($this->input->post('search_general'))) {
			$search['ppjk.ppjk_no'] = $this->input->post('search_general');
			$search['ppjk.ship_name'] = $this->input->post('search_general');
			$search['users.first_name'] = $this->input->post('search_general');
		}

	 	$dataSchedule = $this->schedule_model->getAllOperationOrderBy(null,null,$search,null,null,$where);

	  
	 	if ($dataSchedule) {
		 	foreach ($dataSchedule as $key => $value) {  
	 			if($value->bapp_status == 1 || $value->bapp_status == 2){ 
                	if($value->bapp_job_order_status == 1){
	                 	$dataSchedule[$key]->job_order_status =  "Alongside";
	                }elseif($value->bapp_job_order_status == 2){
	                 	$dataSchedule[$key]->job_order_status =  "Sail";
	                }elseif($value->bapp_job_order_status == 3){
	                 	$dataSchedule[$key]->job_order_status =  "Anchorage";
	                }elseif($value->bapp_job_order_status == 4){
	                 	$dataSchedule[$key]->job_order_status =  "Cancel Order";
	                }else{
	                	$dataSchedule[$key]->job_order_status =  "Finish Job";
	                } 
                }else{ 
	              	if($value->job_order_status == 1){
	                 	$dataSchedule[$key]->job_order_status =  "Start a Arival";
	                }else{
	                	$dataSchedule[$key]->job_order_status =  "Waiting";
	                }
                }
		 	}
	 	}
	 	/*echo "<pre>";
	 	foreach ($dataSchedule as $key => $value) {
	 		# code...
	 	print_r($value);
	 	echo "<hr>";
	 	}
	 	die();*/
	 	$dataPandu = $this->pandu_model->getAllById();
	 	$data['schedules'] = $dataSchedule;
	 	$data['pandus'] = $dataPandu;

		$this->load->view('front/main',$data);
	}

	
}
