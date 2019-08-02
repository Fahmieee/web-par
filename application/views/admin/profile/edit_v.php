<div class="pad-25">
   <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <input type="hidden" id="user_id" value="">
            <form class="form-horizontal" id="form" method="POST" action="">
              <div class="box-footer">
                <?php if(!empty($this->session->flashdata('message_error'))){?>
                <div class="alert alert-danger">
                <?php   
                   print_r($this->session->flashdata('message_error'));
                ?>
                </div>
                <?php }?> 
                <input type="hidden" name="id" value="<?php echo $id;?>">
                  <?php if(!$is_superadmin){?>
                <input type="hidden" id="group_id_selected" value="<?php echo $group_id;?>"> 
                <input type="hidden" id="role_id_selected" value="<?php echo $role_id;?>"> 
                <?php }?>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Nama Lengkap</label> 
                  <div class="col-sm-9">
                    <input type="name" class="form-control" id="name" placeholder="Nama Lengkap" name="name" value="<?php echo $name;?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 control-label">Email</label> 
                  <div class="col-sm-9">
                   <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $email;?>">
                  </div>
                </div> 
                <div class="form-group row">
                  <label  class="col-sm-3 control-label">Nomor Handphone</label> 
                  <div class="col-sm-9">
                   <input type="name" class="form-control" id="phone" placeholder="Nomor Handphone" name="phone" value="<?php echo $phone;?>">
                  </div>
                </div> 
                <div class="form-group row">
                  <label class="col-sm-3 control-label">Alamat</label> 
                  <div class="col-sm-9">
                   <textarea class="form-control" name="address"><?php echo $address?></textarea>
                  </div>
                </div> 
                
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 control-label">Jabatan</label> 
                  <div class="col-sm-9">
                   <input type="name" class="form-control" id="department" placeholder="Jabatan" name="department" value="<?php echo $department;?>">
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 control-label">NIP</label> 
                  <div class="col-sm-9">
                   <input type="name" class="form-control" id="nip" placeholder="NIP" name="nip" value="<?php echo $nip;?>">
                  </div>
                </div>  
                <hr>
                <?php if(!$is_superadmin){?>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 control-label">Area</label> 
                  <div class="col-sm-9">
                    <select id="area_id" name="area_id" class="form-control">
                      <option value="">Pilih Area</option>
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
                  </div>
                </div>  
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 control-label">Grup</label> 
                  <div class="col-sm-9">
                     <select id="group_id" name="group_id" class="form-control">
                      <option value="">Pilih Grup</option>
                    </select>
                  </div>
                </div>  
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 control-label">Role</label> 
                  <div class="col-sm-9">
                     <select id="role_id" name="role_id" class="form-control">
                      <option value="">Pilih Role</option>
                    </select>
                  </div>
                </div>   
                <?php }?>
                <div class="form-group row m-t-md">
                  <div class="col-sm-12 text-right">
                    <a href="<?php echo base_url();?>dashboard" class="btn btn-sm btn-default ">Batal</a>
                    <button type="submit" class="btn btn-sm btn-info" id="save-btn">Simpan</button>
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