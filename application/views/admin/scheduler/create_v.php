 
<div class="padding-top">
   <div class="row"> 
      <div class="col-md-12"> 
        <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
          <div class="box box-primary">
            <div class="box-header with-border"> 
            </div>   
            <div class="box-body">   
              <div class="col-md-12 row">
                <div class="col-md-4  offset-md-3">
                  <div class="md-form-group">
                    <input class="md-input" id="police_number" name="police_number" autocomplete="off">
                    <label for="police_number" class="form-control-feedback">No Polisi</label>  
                  </div>
                </div>  
                <div class="col-md-2">
                  <div class="md-form-group"> 
                    <a href="#" id="find-unit" class="btn btn-sm btn-primary">FIND</a>
                  </div>
                </div>  
              </div>
             
            </div>  
          </div>  
          <div class="box box-primary">
            <div class="box-header with-border"> 
              Data Unit
            </div>   
            <div class="box-body">
              <div class="form-group row m-t-md">
                <div class="col-sm-6">
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <select class="md-input" id="branch_id">
                        <option value=""> Pilih Cabang</option>
                        <?php foreach($branches as $branch){ ?>
                          <option value="<?php echo $branch->id;?>"><?php echo $branch->name;?></option>
                        <?php }?>
                      </select>
                      <label for="branch" class="form-control-feedback">Cabang</label>
                    </div>
                  </div>  
                  <input type="hidden" name="unit_id" id="unit_id">
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="type_assets" name="type_assets" autocomplete="off" required>
                      <label for="type_assets" class="form-control-feedback">Tipe Assets</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12"> 
                      <select class="md-input" id="type_unit">
                        <option value=""> Pilih Fungsi Unit</option>
                        <option value="1"> Dedicated</option>
                        <option value="2"> Pool</option>
                        <option value="3"> Shifting</option>
                      </select>
                      <label for="type_unit" class="form-control-feedback">Fungsi Unit</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="merk" name="merk" autocomplete="off" required>
                      <label for="merk" class="form-control-feedback">Merk Unit</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="model" name="model" autocomplete="off" required>
                      <label for="model" class="form-control-feedback">Model Unit</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="varian" name="varian" autocomplete="off" required>
                      <label for="varian" class="form-control-feedback">Varian Unit</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="mes" name="mes" autocomplete="off" required>
                      <label for="mes" class="form-control-feedback">Cakupan Mesin</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="transmition" name="transmition" autocomplete="off" required>
                      <label for="transmition" class="form-control-feedback">Transmisi</label>
                    </div>
                  </div>  
                </div>
                <div class="col-sm-6">
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="years" name="years" autocomplete="off" required>
                      <label for="years" class="form-control-feedback">Tahun</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="mileage" name="mileage" autocomplete="off" required>
                      <label for="mileage" class="form-control-feedback">Jarak Tempuh</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="stnk_due_date" name="stnk_due_date" autocomplete="off" required>
                      <label for="stnk_due_date" class="form-control-feedback">Masa Berlaku STNK</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="kir_due_date" name="kir_due_date" autocomplete="off" required>
                      <label for="kir_due_date" class="form-control-feedback">Masa Berlaku KIR</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="chassis_number" name="chassis_number" autocomplete="off" required>
                      <label for="chassis_number" class="form-control-feedback">Nomor Rangka</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="machine_number" name="machine_number" autocomplete="off" required>
                      <label for="machine_number" class="form-control-feedback">Nomor Mesin</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="color" name="color" autocomplete="off" required>
                      <label for="color" class="form-control-feedback">Warna</label>
                    </div>
                  </div>    
                </div>
              </div>
            </div>
          </div> 

          <div class="box box-primary">
            <div class="box-header with-border"> 
              Pairing Dengan Driver
            </div>   
            <div class="box-body">  
              <div class="full-width">
                <div class="md-form-group col-sm-6">
                  <select class="md-input" id="driver_id" name="driver_id"> 
                    <option value="0">Tanpa Driver</option>
                    <?php foreach($drivers as $driver){ ?>
                      <option value="<?php echo $driver->id;?>"><?php echo $driver->first_name;?></option>
                    <?php }?>
                  </select>
                  <label for="driver_id" class="form-control-feedback">Driver</label>
                </div>
              </div>  
            </div>  
          </div>  
          <div class="box box-primary">
            <div class="box-header with-border">
            Pairing Dengan User 
            </div>   
            <div class="box-body">  
              <div class="form-group row m-t-md">
                <div class="col-sm-4">
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="start_date" name="start_date" autocomplete="off" required onkeydown="return false">
                      <label for="start_date" class="form-control-feedback">Tanggal Mulai</label>
                    </div>
                  </div>  
                </div>
                <div class="col-sm-4">
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="end_date" name="end_date" autocomplete="off" required onkeydown="return false">
                      <label for="end_date" class="form-control-feedback">Tanggal Selesai</label>
                    </div>
                  </div>  
                </div>
                <div class="col-sm-4">
                  <div class="full-width">
                    <div class="md-form-group col-sm-12">
                      <select class="md-input" id="user_id" name="user_id"> 
                        <?php foreach($data_users as $user){ ?>
                          <option value="<?php echo $user->id;?>"><?php echo $user->first_name;?></option>
                        <?php }?>
                      </select>
                      <label for="user_id" class="form-control-feedback">Pilih User</label>
                    </div>
                  </div>  
                </div>
              </div>    
            </div>  
          </div> 
          <div class="box box-primary">
            <div class="box-header with-border">  
            </div> 
            <div class="box-body">   
                <div class="col-sm-12 text-right">
                  <button type="submit" class="btn btn-sm btn-info" id="save-btn">Simpan</button>
                  <a href="<?php echo base_url();?>scheduler" class="btn btn-sm btn-danger ">Batal</a>
                </div>
              
            </div>    
          </div> 
      </form>
      </div> 
    </div>
</section>
<div class="padding"></div>
<script data-main="<?php echo base_url()?>assets/js/main/main-scheduler" src="<?php echo base_url()?>assets/js/require.js"></script>