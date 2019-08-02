<div class="padding-top">
   <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
  <div class="row">
   
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body">
         
          <p class="padtop-30 padbot-30">
            <?php if(!empty($photo)){?>
            <img src="<?php echo base_url()."assets/images/photo/".$photo;?>" class="img-circle w-110">
            <?php }else{ ?>
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
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start --> 
          <div class="box-body">
            <?php if(!empty($this->session->flashdata('message_error'))){?>
            <div class="alert alert-danger">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
            </div>
            <?php }?> 
            <input type="hidden" name="id" id="user_id" value="<?php echo $id;?>"> 
             
            <div class="full-width">
              <div class="md-form-group full-width">
                <input class="md-input" id="name" name="name" autocomplete="off" value="<?php echo $name;?>" required>
                <label for="name" class="form-control-feedback">Nama Lengkap</label>
              </div>
            </div>
            <div class="full-width">
              <div class="md-form-group full-width">
                <input class="md-input" id="email" name="email" autocomplete="off" value="<?php echo $email;?>" required>
                <label for="email" class="form-control-feedback">Email</label>
              </div>
            </div> 
            <div class="full-width">
              <div class="md-form-group full-width">
                <input class="md-input" id="phone" name="phone" autocomplete="off" value="<?php echo $phone;?>" required>
                <label for="phone" class="form-control-feedback">Nomor Handphone</label>
              </div>
            </div>
            <div class="full-width">
              <div class="md-form-group full-width">
                <input class="md-input" id="company" name="company" autocomplete="off" value="<?php echo $company?>" required>
                <label for="company" class="form-control-feedback">Alokasi/Perusahaan</label>
              </div>
            </div>
            <div class="full-width">
              <div class="md-form-group full-width">
               <select id="department" name="department" class="md-input">
                <option value="">Pilih Jabatan</option>
                  <?php
                  foreach ($roles as $key => $role) { ?>
                    <?php if($role->id == $department_id){?>
                    <option value="<?php echo $role->id;?>" selected><?php echo $role->name;?></option>
                    <?php }else{ ?>
                    <option value="<?php echo $role->id;?>"><?php echo $role->name;?></option>
                    <?php }
                  }
                  ?>
              </select>
                <label for="department" class="form-control-feedback">Jabatan</label>
              </div>
            </div>    
            <hr> 
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