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
                <div class="md-form-group  full-width">
                  <input class="md-input" id="email" name="email" autocomplete="off" required>
                  <label for="email" class="form-control-feedback">Email</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input" id="phone" name="phone" autocomplete="off" required>
                  <label for="phone" class="form-control-feedback">Nomor Handphone</label>
                </div>
              </div>
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input"  type="number" id="nip" name="nip" autocomplete="off" required>
                  <label for="nip" class="form-control-feedback">Nomor NIP</label>
                </div>
              </div>  
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input"  type="number" id="nik" name="nik" autocomplete="off" required>
                  <label for="nik" class="form-control-feedback">Nomor NIK</label>
                </div>
              </div>   
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <textarea class="md-input" id="address" name="address" autocomplete="off" required></textarea>
                  <label for="address" class="form-control-feedback">Alamat</label>
                </div>
              </div>  
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input" id="driver_sim_no" name="driver_sim_no" autocomplete="off" required>
                  <label for="driver_sim_no" class="form-control-feedback">No. SIM Pengemudi</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input" id="driver_sim_type" name="driver_sim_type" autocomplete="off" value="A" required readonly>
                  <label for="driver_sim_type" class="form-control-feedback">Jenis SIM</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input type="text" class="md-input date" id="driver_sim_date" name="driver_sim_date" autocomplete="off" required>
                  <label for="driver_sim_date" class="form-control-feedback">Masa Berlaku SIM</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <select id="driver_type" name="driver_type" class="md-input">
                    <option value="1">Dedicated</option>
                    <option value="2">Pool</option>
                  </select>
                  <label for="area_id" class="form-control-feedback">Fungsi Driver</label>
                </div>
              </div>
              <div class="full-width">
                <label class="form-control-feedback">Masa Kontrak</label>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="md-form-group  full-width">
                      <input type="text" class="md-input date" id="start_date" name="start_date" autocomplete="off" required>
                      <label for="start_date" class="form-control-feedback">Mulai Kontrak</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="md-form-group  full-width">
                      <input type="text" class="md-input date" id="end_date" name="end_date" autocomplete="off" required>
                      <label for="end_date" class="form-control-feedback">Selesai Kontrak</label>
                    </div>
                  </div>
                </div>
              </div>  
              <hr>    
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input" id="username" name="username" autocomplete="off">
                  <label for="username" class="form-control-feedback">Username</label>
                </div>
              </div>
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input" id="password" name="password" type="password" autocomplete="off">
                  <label for="password" class="form-control-feedback">Password</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group  full-width">
                  <input class="md-input" id="password_confirm" name="password_confirm" type="password" autocomplete="off">
                  <label for="password_confirm" class="form-control-feedback">Ulangi Password</label>
                </div>
              </div> 
              <div class="form-group row m-t-md">
                <div class="col-sm-12 text-right">
                  <button type="submit" class="btn btn-sm btn-info  uppercase" id="save-btn">Simpan</button>
                  <a href="<?php echo base_url();?>driver" class="btn btn-sm btn-danger uppercase ">Batal</a>
                </div>
              </div>   
            </div> 
          </form>
        </div>  
      </div> 
    </div>
</section>
<div class="padding"></div>
<script data-main="<?php echo base_url()?>assets/js/main/main-driver" src="<?php echo base_url()?>assets/js/require.js"></script>