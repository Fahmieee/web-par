<div class="padding-top">
  <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
  <div class="row"> 
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body">
          <p class="padtop-30 padbot-30">
            <?php if(!empty($photo)){?>
            <img src="<?php echo base_url()?>assets/images/photo/<?php echo $photo;?>" class="img-circle w-110">
            <?php }else{?>
            <img src="<?php echo base_url()?>assets/images/default-image.png" class="img-circle w-110">
            <?php }?>
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
        <input type="hidden" id="user_id" value="<?php echo $id;?>">
        <input type="hidden" name="id" value="<?php echo $id;?>">
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
              <input class="md-input" id="name" name="name" autocomplete="off" value="<?php echo $name;?>" required>
              <label for="name" class="form-control-feedback">Nama Lengkap</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group  full-width">
              <input class="md-input" id="email" name="email" autocomplete="off" value="<?php echo $email;?>" required>
              <label for="email" class="form-control-feedback">Email</label>
            </div>
          </div> 
          <div class="full-width">
            <div class="md-form-group  full-width">
              <input class="md-input" id="phone" name="phone" autocomplete="off" value="<?php echo $phone;?>" required>
              <label for="phone" class="form-control-feedback">Nomor Handphone</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group  full-width">
              <input class="md-input"  type="number" id="nip" name="nip" autocomplete="off" value="<?php echo $nip;?>" required>
              <label for="nip" class="form-control-feedback">Nomor KTP</label>
            </div>
          </div> 
          <div class="full-width">
            <div class="md-form-group  full-width">
              <input class="md-input"  type="number" id="nik" name="nik" autocomplete="off" value="<?php echo $nik;?>" required>
              <label for="nik" class="form-control-feedback">Nomor NIK</label>
            </div>
          </div> 
          <div class="full-width">
            <div class="md-form-group  full-width">
              <textarea class="md-input" id="address" name="address" autocomplete="off" required><?php echo $address?></textarea>
              <label for="address" class="form-control-feedback">Alamat</label>
            </div>
          </div>  
          <div class="full-width">
            <div class="md-form-group  full-width">
              <input class="md-input" id="driver_sim_no" name="driver_sim_no" autocomplete="off" value="<?php echo $driver_sim_no;?>" required>
              <label for="driver_sim_no" class="form-control-feedback">No. SIM Pengemudi</label>
            </div>
          </div> 
          <div class="full-width">
            <div class="md-form-group  full-width">
              <input class="md-input" id="driver_sim_type" name="driver_sim_type" autocomplete="off" value="<?php echo $driver_sim_type;?>" value="A" required readonly>
              <label for="driver_sim_type" class="form-control-feedback">Jenis SIM</label>
            </div>
          </div> 
          <div class="full-width">
            <div class="md-form-group  full-width">
              <input type="text" class="md-input date" id="driver_sim_date" name="driver_sim_date" autocomplete="off" value="<?php echo $driver_sim_date?>" required onkeydown="return false">
              <label for="driver_sim_date" class="form-control-feedback">Masa Berlaku SIM</label>
            </div>
          </div>  
          <div class="full-width">
            <div class="md-form-group  full-width">
              <select id="driver_type" name="driver_type" class="md-input">
                <option value="1" <?php if($driver_type == 1) echo "selected";?> >Dedicated</option>
                <option value="2" <?php if($driver_type == 2) echo "selected";?> >Pool</option>
              </select>
              <label for="area_id" class="form-control-feedback">Fungsi Driver</label>
            </div>
          </div>
          <div class="full-width">
            <label class="form-control-feedback">Masa Kontrak</label>
            <div class="row">
              <div class="col-sm-6">
                <div class="md-form-group  full-width">
                  <input type="text" class="md-input date" id="start_date" name="start_date" autocomplete="off" required onkeydown="return false" value="<?php echo date('Y-m-d',strtotime($start_date_contract))?>">
                  <label for="start_date" class="form-control-feedback">Mulai Kontrak</label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="md-form-group  full-width">
                  <input type="text" class="md-input date" id="end_date" name="end_date" autocomplete="off" required onkeydown="return false" value="<?php echo date('Y-m-d',strtotime($end_date_contract))?>">
                  <label for="end_date" class="form-control-feedback">Selesai Kontrak </label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row m-t-md">
            <div class="col-sm-12 text-right">
              <button type="submit" class="btn btn-sm btn-info uppercase" id="save-btn">Simpan</button>
              <a href="<?php echo base_url();?>driver" class="btn btn-sm btn-danger uppercase">Batal</a>
            </div>
          </div>   
        </div>  
      </div>  
    </div> 
  </div>
  </form>
</section>
<div class="padding"></div>
<script data-main="<?php echo base_url()?>assets/js/main/main-driver" src="<?php echo base_url()?>assets/js/require.js"></script>