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
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
<body>
  <div class="row" id="app">
    <div class="center-block">
      <div class="navbar">
        <div style="display: table;margin:0 auto 10px;">
          <img src="<?php echo base_url()?>assets/images/logo.png">
        </div>
      </div>
      <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
      <h1>Sign Up Agen</h1>
        <form class="form-horizontal" id="form" method="POST" action="signup/create" enctype="multipart/form-data">   
            <hr>  
            <div class="mt-3 form-group row">
            <label for="inputEmail3" class="col-sm-3 control-label">Foto Agen</label> 
              <div class="col-sm-9">
                <input type="file" class="form-control" id="foto" placeholder="foto agen" name="foto_file">
              </div> 
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-3 control-label">Pelabuhan *</label> 
              <div class="col-sm-9">
                <select id="port_id" name="port_id" class="form-control">
                  <option value="">Pilih Pelabuhan</option>
                  <?php
                  foreach ($ports as $key => $port) { ?>
                    <option value="<?php echo $port->id;?>"><?php echo $port->name;?></option>
                  <?php }
                  ?>
                </select>
              </div>
            </div>  
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 control-label">Nama Lengkap *</label> 
              <div class="col-sm-9">
                <input type="name" class="form-control" id="name" placeholder="Nama Lengkap" name="name">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-3 control-label">No KTP * </label> 
              <div class="col-sm-9">
               <input type="name" class="form-control" id="nip" placeholder="No KTP" name="nip">
              </div>
            </div>   
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-3 control-label">Email *</label> 
              <div class="col-sm-9">
               <input type="email" class="form-control" id="email" placeholder="Email" name="email">
              </div>
            </div> 
            <div class="form-group row">
              <label  class="col-sm-3 control-label">Nomor Handphone</label> 
              <div class="col-sm-9">
               <input type="name" class="form-control" id="phone" placeholder="Nomor Handphone" name="phone">
              </div>
            </div> 
            <div class="form-group row">
              <label class="col-sm-3 control-label">Alamat</label> 
              <div class="col-sm-9">
               <textarea class="form-control" name="address"></textarea>
              </div>
            </div>  
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-3 control-label">Jabatan</label> 
              <div class="col-sm-9">
               <input type="name" class="form-control" id="department" placeholder="Jabatan" name="department">
              </div>
            </div>  
            <hr>  
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-3 control-label">Username</label> 
              <div class="col-sm-9">
               <input type="name" class="form-control" id="username" placeholder="Username" name="username">
              </div>
            </div>  
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-3 control-label">Password</label> 
              <div class="col-sm-9">
               <input type="password" class="form-control" id="password"  name="password">
              </div>
            </div>  
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-3 control-label">Ulangi Password</label> 
              <div class="col-sm-9">
               <input type="password" class="form-control" id="password_confirm" name="password_confirm">
              </div>
            </div>
            <hr>
            <button type='submit' class="btn primary btn-block p-x-md")>Daftar</button>
        </form>
      </div>
    </div>
  </div>
  <script data-main="<?php echo base_url()?>assets/js/main/main-signup-agent" src="<?php echo base_url()?>assets/js/require.js"></script>
  <input type="hidden" id="base_url" value="<?php echo base_url();?>">
</body>
</html>
