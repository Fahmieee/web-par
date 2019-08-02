<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PAR | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/fonts/font-awesome/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/flatkit/app.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
<body class="bg-dark-blue">


<div id="infoMessage"><?php echo $message; ?></div>
  <div class="app" id="app">
    <div class="center-block w-xxl w-auto-xs p-y-md">
      <div class="p-a-md box-color r box-shadow-z1 text-color martop-40">
        <div style="display: table;margin:0 auto 20px;">
          <img src="<?php echo base_url()?>assets/images/logo.png">
        </div>
          <h5>Change Password</h5>
          <div class="md-form-group float-label">
              <input class="md-input" id="old_password" name="old_password" autocomplete="off" required>
              <label>Old Password</label>
          </div>
          <div class="md-form-group float-label">
              <input class="md-input" id="new_password" name="new_password" autocomplete="off" required>
              <label>New Password</label>
          </div>
          <div class="md-form-group float-label">
              <input class="md-input" id="new_password_confirm" name="new_password_confirm" autocomplete="off" required>
              <label>Confirm New Password</label>
          </div> 
		      <?php echo form_input($user_id); ?>
		      <p><?php echo form_submit('submit', 'Ubah', 'class="btn primary btn-block p-x-md"'); ?></p>
		      <p><a class="btn text-color btn-block p-x-md" href="<?php echo base_url();?>dashboard">Batal</a></p>

		<?php echo form_close(); ?>
	  </div>
    </div>
  </div>
  <script data-main="<?php echo base_url()?>assets/js/main/main-change-password" src="<?php echo base_url()?>assets/js/require.js"></script>
  <input type="hidden" id="base_url" value="<?php echo base_url();?>">
</body>
</html>