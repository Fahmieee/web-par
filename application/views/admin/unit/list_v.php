 <style type="text/css">
  .dataTables_filter input { visibility: hidden;}
  .dataTables_filter label { visibility: hidden;}
</style>
<div class="padding-top">
   <?php if($is_can_search){?>
  <div class="box"> 
    <div class="box-header"> 
      <h3 class="box-title">Cari Unit</h3>
    </div>  
    <div class="box-body">
      <div class="col-sm-12">  
        <div class="form-group row">
          <div class="col-md-6">
            <div class="md-form-group   full-width">
              <select name="type_unit" id="type_unit" class="md-input">
                <option value=""> Pilih Fungsi Unit</option>
                <option value="1">Dedicated</option>
                <option value="2">Pool</option>
              </select>
              <label for="name" class="form-control-feedback">Fungsi Unit</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group full-width">
              <select name="merk" id="merk" class="md-input">
                 <option value=""> Pilih Merk Unit</option>
                <?php foreach($merk_units as $unit){?>
                <option value="<?php echo $unit->id;?>"><?php echo $unit->name;?></option>
              <?php }?>
              </select>
              <label for="name" class="form-control-feedback">Merk Unit</label>

            </div>
          </div> 
           <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="no_police" name="no_police" autocomplete="off">
              <label for="no_police" class="form-control-feedback">Nomor Polisi</label>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="md-form-group   full-width">
              <select id="type_assets" name="type_assets" class="md-input">
                <option value="">Pilih Kepemilikan Aset</option>
                <option value="1">PAR</option>
                <option value="2">Vendor</option>
              </select>
              <label for="username" class="form-control-feedback">Kepemilikan Aset</label>
            </div>
          </div>  
        </div> 
        <div class="form-group row">
          <div class="col-sm-12 text-right"> 
            <a class="btn btn-sm btn-primary uppercase" id="search">Search</a>
            <a class="btn btn-sm btn-danger uppercase" id="reset">Reset</a>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <?php }?> 
  <div class="box"> 
    <div class="box-header">
      <?php if($is_can_create){?>
      <div class="col-md-2 datatableButton text-right">
        <a href="<?php echo base_url()?>unit/create" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i> Unit</a>
      </div>
      <?php }?>
    </div>  
    <div class="box-body">
      <div class="table-responsive">
        <?php if(!empty($this->session->flashdata('message'))){?>
        <div class="alert alert-info">
        <?php   
           print_r($this->session->flashdata('message'));
        ?>
        </div>
        <?php }?> 
        <table class="table table-striped" id="table"> 
          <thead>
            <th>No Urut</th> 
            <th>Fungsi Unit</th>
            <th>Cabang</th>
            <th>Kepemilikan Asset</th>
            <th>Merk unit</th> 
            <th>Varian Unit</th> 
            <th>No Polisi</th> 
            <th>Masa Aktif STNK</th> 
            <th>Masa Aktif KIR</th> 
            <th>Action</th> 
          </thead>        
        </table>
      </div>
    </div>
  </div> 
</div>   
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-unit" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>