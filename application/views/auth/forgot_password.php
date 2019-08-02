<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PAR | Forgot Password</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/fonts/font-awesome/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/flatkit/app.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="bg-dark-blue">
	<div class="loadingpage"><img src="<?php echo base_url()?>assets/images/loading.svg"></div>
	<div class="app" id="app">
		<div class="center-block w-xxl w-auto-xs p-y-md">
			<div class="p-a-md box-color r box-shadow-z1 text-color martop-40">
				<div style="display: table;margin:0 auto 20px;">
					<img src="<?php echo base_url()?>assets/images/logo-login.png">
				</div>
				<h5><?php echo lang('forgot_password_heading');?></h5>
				<p>Enter your email address below and we will send you instructions on how to change your password.</p>

				<?php if(!empty($message)){?>
					<div class="alert alert-danger"><?php echo $message;?></div>
				<?php } ?>
				
				<?php echo form_open("auth/forgot_password", array('id' => 'form-forgot-password'));?> 
					<div class="md-form-group float-label">
			            <input class="md-input" id="identity" name="email" autocomplete="off" required>
			            <label for="email" class="form-control-feedback">Your Email</label>
			        </div> 
 					<button type="submit" class="btn primary btn-block p-x-md">Send</button>
 					 

				<?php echo form_close();?>
			</div>
			 <div class="p-v-lg text-center">
		        <div class="m-b"><a ui-sref="access.forgot-password" href="<?php echo base_url()?>login" class="text-primary _600">Login</a></div>
		      </div>
		</div>
	</div>
	<script data-main="<?php echo base_url()?>assets/js/main/main-forgot-password" src="<?php echo base_url()?>assets/js/require.js"></script>
	<input type="hidden" id="base_url" value="<?php echo base_url();?>">
</body>
</html>





















