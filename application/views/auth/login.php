<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PAR | Log in</title>
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
        <div class="m-b text-sm">Sign in with your Account</div>
        <?php if(!empty($this->session->flashdata('message_error'))){?>
          <div class="alert alert-danger">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
            </div>
          <?php }?>
        <form action="<?php echo base_url();?>auth/login" method="post" id="form-login"> 
          <div class="md-form-group float-label">
            <input class="md-input" id="username" name="username" autocomplete="off" required>
            <label for="username" class="form-control-feedback">Username</label>
          </div>
          <div class="md-form-group float-label">
            <input type="password" class="md-input" id="password" name="password" autocomplete="off" required>
            <label for="password" class="form-control-feedback">Password</label>
          </div>  
          <div class="form-check marbot-20">
            <p>
              <label class="md-check">
                <input type="checkbox">
                <i class="blue"></i>
                Keep me login
              </label>
            </p>
          </div>
          <button type="submit" class="btn primary btn-block p-x-md" disabled id="btn-login">Sign in</button>
        </form>
      </div>

      <div class="p-v-lg text-center">
        <div class="m-b"><a ui-sref="access.forgot-password" href="<?php echo base_url()?>auth/forgot_password" class="text-primary _600">Forgot password?</a></div>
      </div>
    </div>
  </div>
  <script data-main="<?php echo base_url()?>assets/js/main/main-login" src="<?php echo base_url()?>assets/js/require.js"></script>
  <input type="hidden" id="base_url" value="<?php echo base_url();?>">
</body>
</html>
