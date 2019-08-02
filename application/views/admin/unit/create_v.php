 <div class="padding-top"> 
  <div class="row"> 
    <div class="col-md-12"> 
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Baru Unit</h3>
        </div> 
        <form class="form-horizontal" id="form" method="POST" action="">
        <div class="box-body">
          <?php if(!empty($this->session->flashdata('message_error'))){?>
    	    <div class="alert alert-danger">
    	    <?php   
    	       print_r($this->session->flashdata('message_error'));
    	    ?>
    	    </div>
    	    <?php }?>  
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 control-label">Cabang</label> 
            <div class="col-sm-9">
              <select name="branch_id" id="branch_id" class="form-control">
                <option value=""> Pilih Cabang</option>
                <?php foreach($branches as $branch){ ?>
                    <option value="<?php echo $branch->id;?>"><?php echo $branch->name;?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 control-label">Kepemilikan Aset</label> 
            <div class="col-sm-9">
             <select id="type_assets" name="type_assets" class="form-control">
               <option value="">Pilih Kepemilikan Aset</option>
               <option value="1">PAR</option>
               <option value="2">Vendor</option>
             </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 control-label">Fungsi Unit</label> 
            <div class="col-sm-9">
              <select name="type_unit" id="type_unit" class="form-control">
                  <option value=""> Pilih Fungsi Unit</option>
                 <option value="1">Dedicated</option>
                 <option value="2">Pool</option>
                 </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 control-label">Merk Unit</label> 
            <div class="col-sm-9">
              <!-- <input type="text" class="form-control" id="merk" placeholder="Merk Unit" name="merk"> -->
            
               <select name="merk" id="merk" class="form-control">
                   <option value=""> Pilih Merk Unit</option>
                  <?php foreach($merk_units as $unit){?>
                  <option value="<?php echo $unit->id;?>"><?php echo $unit->name;?></option>
                <?php }?>
                </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Model Unit</label> 
            <div class="col-sm-9">
              <input type="text" class="form-control" id="model" placeholder="Model Unit" name="model">
            </div>
          </div> 
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Varian Unit</label> 
            <div class="col-sm-9">
              <input type="name" class="form-control" id="varian" placeholder="Varian Unit" name="varian">
            </div>
          </div>   
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Tahun</label> 
            <div class="col-sm-9">
              <input type="text" class="form-control" id="years" placeholder="Tahun Unit" name="years">
            </div>
          </div>    
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Kapasitas Mesin</label> 
            <div class="col-sm-9">
              <input type="text" class="form-control" id="mes" placeholder="Kapasitas Mesin" name="mes">
            </div>
          </div>    
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Transmisi</label> 
            <div class="col-sm-9">
              <input type="text" class="form-control" id="transmition" placeholder="Transmisi" name="transmition">
            </div>
          </div>    
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">No Polisi</label> 
            <div class="col-sm-9">
              <input type="text" class="form-control" id="no_police" placeholder="No Polisi" name="no_police">
            </div>
          </div>    
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Jarak Tempuh</label> 
            <div class="col-sm-9">
              <input type="text" class="form-control" id="mileage" placeholder="Jarak Tempuh" name="mileage">
            </div>
          </div>  
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Masa Berlaku STNK</label> 
            <div class="col-sm-9">
              <input type="name" class="form-control" id="stnk_due_date" placeholder="Masa Berlaku STNK" name="stnk_due_date" onkeydown="return false" autocomplete="off">
            </div>
          </div> 
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Masa Berlaku KIR</label> 
            <div class="col-sm-9">
              <input type="name" class="form-control" id="kir_due_date" placeholder="Masa Berlaku KIR" name="kir_due_date" onkeydown="return false" autocomplete="off">
            </div>
          </div>  
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Nomor Rangka</label> 
            <div class="col-sm-9">
              <input type="name" class="form-control" id="chassis_number" placeholder="Nomor Rangka" name="chassis_number">
            </div>
          </div>  
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Nomor Mesin</label> 
            <div class="col-sm-9">
              <input type="name" class="form-control" id="machine_number" placeholder="Nomor Mesin" name="machine_number">
            </div>
          </div>  
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 control-label">Warna</label> 
            <div class="col-sm-9">
              <input type="name" class="form-control" id="color" placeholder="Warna" name="color">
            </div>
          </div>  
          <div class="form-group row m-t-md">
            <div class="col-sm-12 text-right">
              <a href="<?php echo base_url();?>unit" class="btn btn-sm btn-default ">Batal</a>
              <button type="submit" class="btn btn-sm btn-info" id="save-btn">Simpan</button>
            </div>
          </div>  
        </div> 
        </form>
      </div>  
    </div>
    
  </div>
</div>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-unit" src="<?php echo base_url()?>assets/js/require.js"></script>