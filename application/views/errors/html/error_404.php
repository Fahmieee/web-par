<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PAR | ERROR</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/fonts/font-awesome/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/flatkit/app.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/material-design-icons.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script>
function goBack() {
    window.history.back();
}
</script>
  </head>
<body> 
	<div class="app-body bg-white bg-auto w-full">
	  <div class="container">
        <div class="row">
            <div class="col-sm-6 padtop-80">
                <img class="notfound-image" src="<?php echo base_url()?>assets/images/404 Icon.svg">
            </div>
            <div class="col-sm-6 padtop-60">
                <h1 class="text-dark-blue notfound-text">404</h1>
                <h2 class="fsize-28 bolder uppercase">looks like you're lose</h2>
                <p class="text-grey marbot-30 fsize-20">The page you are looking for not available</p>
                <a class="fsize-28 uppercase bolder" href="#">go to home <i class="fsize-30 material-icons">&#xe5c8;</i></a>
            </div>
        </div>
      </div>
	</div>
</body>
</html>