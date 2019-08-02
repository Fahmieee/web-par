<?php 

function sendNotification($to="all",$title="", $desc="", $category=0, $action = false,$data = array()){
	$fcm_server_key =  "AAAAikgbe44:APA91bE3bL3j5w5HeMm6PdypicXDvq1qS5s2dF0Vdb7QeWzwtl18yyUWYgeOyBNSLPisZuDpHTP70nz2x3GoICrcdI_3bqS-41TZZ7AvQeR7zD5O20MDKTy7GjWEUs6qVxVLE_LUGgnp"; 
      //firebase server url to send the curl request
    $url = 'https://fcm.googleapis.com/fcm/send';

    //building headers for the request
    $headers = array(
        'Authorization: key=' . $fcm_server_key,
        'Content-Type: application/json'
    ); 

    $payload = array(
            "to" => $to, //  /topics/all
            "priority" => "high",
            "notification" => array( 
                "title" => $title,
                "body" => $desc,
                "time" => date("H:i"),
                "category" => $category, //document, approval,invoice
                "data" => $data, //document, approval,invoice
                "date" => date("Y-m-d"),
                "click_action" => $action,
                "sound"=> "default" 
            ),
            "data" => array( 
                "title" => $title, 
                "body" => $desc,
                "time" => date("H:i"),
                "category" => $category, //document, approval,invoice
                "data" => $data, //document, approval,invoice
                "date" => date("Y-m-d"),
                "click_action" => $action,
                "sound"=> "default" 
            )
        );
    //Initializing curl to open a connection
    $ch = curl_init();

    //Setting the curl url
    curl_setopt($ch, CURLOPT_URL, $url);
    
    //setting the method as post
    curl_setopt($ch, CURLOPT_POST, true);

    //adding headers 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //disabling ssl support
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    //adding the fields in json format 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    //finally executing the curl request 
    $result = curl_exec($ch);

    //Now close the connection
    curl_close($ch);
 
	if($result){
		return $result;
	}

	return false;
 
} 

function sendBoNotification($from = -1, $to = 'all', $title = '', $message = '', $reference_id = -1,$category="broadcast")
{ 

    $CI = get_instance(); 
    $CI->load->model('notification_model');
    $CI->load->model('role_model');
    if ($to == 'all') {
        $roles = $CI->role_model->getAllById();
        foreach ($roles as $key => $value) {
            $dataInsert = array(
                'from' => $from, 
                'to' => $value->id, 
                'title' => $title, 
                'message' => $message, 
                'category' => $category,
                'reference_id' => $reference_id,
                'created_at' => date("Y-m-d h:i:s", time()),
                'created_by' => $from,
            );
            $CI->notification_model->insert($dataInsert);
        }
    } 
}