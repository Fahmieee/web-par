<div class="padding-top">
  <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
  <div class="row"> 
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body">
          <p class="padtop-30 padbot-30">
            <img src="<?php echo base_url()?>assets/images/default-image.png" class="img-circle w-110">
          </p>
          <div class="form-group row">
            <div class="col-sm-12">
              <input type="file" class="form-control" id="photo" placeholder="foto karyawan" name="photo">
            </div> 
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8"> 
      <div class="box box-primary">
        <input type="hidden" id="user_id" value="">
        <div class="box-body">
          <?php if(!empty($this->session->flashdata('message_error'))){?>
  		    <div class="alert alert-danger">
  		    <?php   
  		       print_r($this->session->flashdata('message_error'));
  		    ?>
  		    </div>
  		    <?php }?>   
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="name" name="name" autocomplete="off" required>
              <label for="name" class="form-control-feedback">Nama Lengkap</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="email" name="email" autocomplete="off" required>
              <label for="email" class="form-control-feedback">Email</label>
            </div>
          </div> 
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="phone" name="phone" autocomplete="off" required>
              <label for="phone" class="form-control-feedback">Nomor Handphone</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="company" name="company" autocomplete="off" required>
              <label for="company" class="form-control-feedback">Alokasi/Perusahaan</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group full-width"> 
               <select id="department" name="department" class="md-input">
                <option value="">Pilih Jabatan</option>
                  <?php
                  foreach ($roles as $key => $role) { ?>
                    <option value="<?php echo $role->id;?>"><?php echo $role->name;?></option>
                  <?php }
                  ?>
              </select>
              <label for="department" class="form-control-feedback">Jabatan</label>
            </div>
          </div> 
          <hr> 
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="username" name="username" autocomplete="off" required>
              <label for="username" class="form-control-feedback">Username</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="password" name="password" type="password" autocomplete="off" required>
              <label for="password" class="form-control-feedback">Password</label>
            </div>
          </div> 
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="password_confirm" name="password_confirm" type="password" autocomplete="off" required>
              <label for="password_confirm" class="form-control-feedback">Ulangi Password</label>
            </div>
          </div> 
          <div class="form-group row m-t-md">
            <div class="col-sm-12 text-right">
              <button type="submit" class="btn btn-sm btn-info uppercase" id="save-btn">Simpan</button>
              <a href="<?php echo base_url();?>user" class="btn btn-sm btn-danger uppercase">Batal</a>
            </div>
          </div>   
        </div>  
      </div>  
    </div> 
  </div>
  </form> 
</div>
<div class="padding"></div>
<script data-main="<?php echo base_url()?>assets/js/main/main-user" src="<?php echo base_url()?>assets/js/require.js"></script>