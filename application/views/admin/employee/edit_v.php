<div class="padding-top">
  <div class="row">
    <!-- left column -->
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body">
          <p class="padtop-30 padbot-30">
            <img src="<?php echo base_url()?>assets/images/default-image.png" class="img-circle w-110">
          </p>
          <?php if(!empty($photo)){?>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 control-label"></label> 
            <div class="col-sm-12">
             <img width="100px" src="<?php echo base_url()."assets/images/photo/".$photo;?>">
            </div>
          </div>
          <?php }?>
          <div class="col-sm-12">
            <input type="file" class="form-control" id="photo" placeholder="foto karyawan" name="photo">
          </div> 
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
          <div class="box-body">
            <?php if(!empty($this->session->flashdata('message_error'))){?>
            <div class="alert alert-danger">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
            </div>
            <?php }?> 
            <input type="hidden" name="id" id="user_id" value="<?php echo $id;?>">
            <input type="hidden" id="group_id_selected" value="<?php echo $group_id;?>"> 
            <input type="hidden" id="role_id_selected" value="<?php echo $role_id;?>"> 
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
                <textarea class="md-input" id="address" name="address" autocomplete="off" required><?php echo $address?></textarea>
                <label for="address" class="form-control-feedback">Alamat</label>
              </div>
            </div>  
            <div class="full-width">
              <div class="md-form-group  full-width">
                <input class="md-input" id="nip" name="nip" autocomplete="off" value="<?php echo $nip;?>" required>
                <label for="phone" class="form-control-feedback">Nomor NIP</label>
              </div>
            </div>  
            <div class="full-width">
              <div class="md-form-group  full-width">
                <input class="md-input" id="nik" name="nik" autocomplete="off" value="<?php echo $nip;?>" required>
                <label for="phone" class="form-control-feedback">Nomor NIK</label>
              </div>
            </div>  
            <div class="full-width">
              <div class="md-form-group  full-width">
                <select id="area_id" name="area_id" class="md-input">
                  <option value="" disabled hidden>Pilih Area</option>
                    <?php
                    foreach ($areas as $key => $area) { ?>
                    <?php if($area->id == $area_id){?>
                    <option value="<?php echo $area->id?>" selected><?php echo $area->name;?></option>
                    <?php }else{?>
                    <option value="<?php echo $area->id?>"><?php echo $area->name;?></option>
                    <?php }?> 
                   
                    <?php }
                    ?>
                </select>
                <label for="area_id" class="form-control-feedback">Area</label>
              </div>
            </div>
            <div class="full-width">
              <div class="md-form-group  full-width">
                <select id="group_id" name="group_id" class="md-input">
                  <option value="" disabled hidden>Pilih Departemen</option> 
                </select>
                <label for="group_id" class="form-control-feedback">Departemen</label>
              </div>
            </div>
            <div class="full-width">
              <div class="md-form-group  full-width">
                <select id="role_id" name="role_id" class="md-input">
                  <option value="" disabled hidden>Pilih Jabatan</option> 
                </select>
                <label for="role_id" class="form-control-feedback">Pilih Jabatan</label>
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