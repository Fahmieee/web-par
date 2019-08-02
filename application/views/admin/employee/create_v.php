<div class="padding-top">
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
          <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
            <div class="box-body">
              <?php if(!empty($this->session->flashdata('message_error'))){?>
    			    <div class="alert alert-danger">
    			    <?php   
    			       print_r($this->session->flashdata('message_error'));
    			    ?>
    			    </div>
    			    <?php }?>   
              <div class="full-width">
                <div class="md-form-group  full-width">
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
                <div class="md-form-group   full-width">
                  <input class="md-input" id="phone" name="phone" autocomplete="off" required>
                  <label for="phone" class="form-control-feedback">Nomor Handphone</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <textarea class="md-input" id="address" name="address" autocomplete="off" required></textarea>
                  <label for="address" class="form-control-feedback">Alamat</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group   full-width">
                  <input class="md-input" id="nip" name="nip" autocomplete="off" required>
                  <label for="nip" class="form-control-feedback">Nomor NIP</label>
                </div>
              </div>  
              <div class="full-width">
                <div class="md-form-group   full-width">
                  <input class="md-input" id="nik" name="nik" autocomplete="off" required>
                  <label for="nik" class="form-control-feedback">Nomor NIK</label>
                </div>
              </div>  
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <select id="area_id" name="area_id" class="md-input">
                    <option value="">Pilih Area</option>
                      <?php
                      foreach ($areas as $key => $area) { ?>
                        <option value="<?php echo $area->id;?>"><?php echo $area->name;?></option>
                      <?php }
                      ?>
                  </select>
                  <label for="area_id" class="form-control-feedback">Area</label>
                </div>
              </div>  
              <div class="full-width">
                <div class="md-form-group   full-width">
                  <select id="group_id" name="group_id" class="md-input">
                    <option value="">Pilih Departemen</option> 
                  </select>
                  <label for="group_id" class="form-control-feedback">Departemen</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <select id="role_id" name="role_id" class="md-input">
                    <option value="">Pilih Jabatan</option> 
                  </select>
                  <label for="role_id" class="form-control-feedback">Pilih Jabatan</label>
                </div>
              </div>
              <hr>
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input" id="username" name="username" autocomplete="off" required>
                  <label for="username" class="form-control-feedback">Username</label>
                </div>
              </div>
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input" id="password" name="password" type="password" autocomplete="off" required>
                  <label for="password" class="form-control-feedback">Password</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input" id="password_confirm" name="password_confirm" type="password" autocomplete="off" required>
                  <label for="password_confirm" class="form-control-feedback">Ulangi Password</label>
                </div>
              </div> 
              <div class="form-group row m-t-md">
                <div class="col-sm-12 text-right">
                  <button type="submit" class="btn btn-sm btn-info uppercase" id="save-btn">Simpan</button>
                  <a href="<?php echo base_url();?>employee" class="btn btn-sm btn-danger uppercase">Batal</a>
                </div>
              </div>   
            </div> 
          </form>
        </div>  
      </div> 
    </div>
</section>
<div class="padding"></div>
<script data-main="<?php echo base_url()?>assets/js/main/main-employee" src="<?php echo base_url()?>assets/js/require.js"></script>