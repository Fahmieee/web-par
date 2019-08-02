<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tes_email extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}
	
	public function index()
	{
			// $config = array(
			// 	'mail_protocol' => 'smtp',
			// 	'mail_host' => 'mail.ndt-dev.com',
			// 	'mail_port' => 465,
			// 	'mail_user' => 'developer@ndt-dev.com',
			// 	'mail_pass' => '1qaz2wsx1@', 
			// 	'newline' => '\r\n', 
			// 	'wordwrap'=>TRUE
			// );
			// $config = array( 
	  //           'mail_protocol' => 'smtp',
	  //           'mail_port' => 'smtp.office365.com',
	  //           'mail_user' => 'adminerp@prima-armada-raya.com',
	  //           'mail_pass' => 'Par12345',
	  //           'mail_crypto' => 'tls',    
	  //           'newline' => '\r\n', //REQUIRED! Notice the double quotes!
	  //           'mail_port' => 587,
	  //           'mailtype' => 'html'
	  //           'mail_charset' => 'iso-8859-1',
	  //           'wordwrap'=>TRUE
	  //       );
			$config = [        
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
			];
			$this->load->library('email', $config);        

			$this->email->from('adminerp@prima-armada-raya.com', 'PAR - Email Server');        
			$this->email->to('genta.yudaswara@gmail.com;fazhaldarul@gmail.com;niamora05@gmail.com;rizki@ndt-partner.com;lina@ndt-partner.com');        
			$this->email->subject('Test Server');
			$this->email->message('SMTP sending test');

			$sent = $this->email->send();

			if ($sent) 
			{
			    echo 'OK';
			    
			} else {
			    echo $this->email->print_debugger();
			}
		
	}
}