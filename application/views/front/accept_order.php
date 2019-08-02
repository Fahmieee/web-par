<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PAR | Estimasi Order</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
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
      <!--   <div class="m-b text-sm">Terima Kasih Telah Menerima Order</div>
          <a href="<?php echo base_url();?>" class="btn btn-primary">Close</a>
         
        </div>  -->
         <?php if(!empty($this->session->flashdata('message_error'))){?>
            <div class="alert alert-danger">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
            </div>
          <?php }?> 
          <?php if(!empty($this->session->flashdata('message'))){?>
            <div class="alert alert-success">
            <?php   
               print_r($this->session->flashdata('message'));
            ?>
            </div>
          <?php }?> 
          <form action="" method="post" id="form-login" enctype="multipart/form-data"> 
          <div class="md-form-group float-label">
            <input class="md-input" id="est_biaya_part" name="est_biaya_part" autocomplete="off" required>
            <label for="est_biaya_part" class="form-control-feedback">Estimasi Biaya Part Dan Material</label>
          </div>
          <div class="md-form-group float-label">
            <input type="text" class="md-input" id="est_biaya_jasa" name="est_biaya_jasa" autocomplete="off" required>
            <label for="est_biaya_jasa" class="form-control-feedback">Estimasi Biaya Jasa</label>
          </div>   
          <!-- <div class="md-form-group float-label">
            <input type="text" class="md-input" id="est_biaya_maintenance" name="est_biaya_maintenance" autocomplete="off" required>
            <label for="est_biaya_maintenance" class="form-control-feedback">Estimasi Waktu Maintenance</label>
          </div> -->
          <div class="md-form-group">
            <input type="text" class="md-input number" id="est_biaya_maintenance" name="est_biaya_maintenance"  required>
            <label for="est_biaya_maintenance" class="form-control-feedback">Estimasi Waktu Maintenance(Jam)</label>
          </div>
          <div class="md-form-group">
            <input type="file" class="md-input" id="photo" name="photo" required>
            <label for="est_biaya_maintenance_end" class="form-control-feedback">Bukti Estimasi</label>
          </div>   

           <input type="hidden" name="workshop_id" value="<?php echo $workshop_id?>">
           <input type="hidden" name="user_id" value="<?php echo $user_id?>">
           <input type="hidden" name="token" value="<?php echo $token?>">
           <input type="hidden" name="service_type" value="<?php echo $service_type?>">
           <input type="hidden" name="type" value="<?php echo $type?>">
          <button type="submit" class="btn primary btn-block p-x-md" disabled id="btn-login">Simpan</button>
        </form>
    </div>
  </div>
  <script data-main="<?php echo base_url()?>assets/js/main/main-login" src="<?php echo base_url()?>assets/js/require.js"></script>
  <input type="hidden" id="base_url" value="<?php echo base_url();?>">
</body>
</html>
