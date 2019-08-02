 <div class="padding-top">
  <div class="box"> 
    <div class="box-header"> 
      <h3 class="box-title">Detail Pelayanan</h3>
    </div>  
    <div class="box-body">
      <div class="row">
        <div class="col-sm-2">
          <img class="centered-image martop-15" src="<?php echo base_url()?>assets/images/icon-history-order.png">
        </div>
        <div class="col-sm-10"> 
          <div class="form-group row">
            <div class="col-md-6">
              <div class="md-form-group  full-width">
                <input class="md-input" id="merk_unit" name="merk_unit" autocomplete="off" value="<?php if(!empty($data_units)){ echo $data_units[0]->produk_name;}?>" readonly>
                <label for="merk_unit" class="form-control-feedback">Merk Unit</label>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="md-form-group  full-width">
                <input class="md-input" id="police_no" name="police_no" autocomplete="off" value="<?php if(!empty($data_units)){ echo $data_units[0]->no_police;}?>" readonly>
                <label for="police_no" class="form-control-feedback" >No. Polisi</label>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="md-form-group  full-width">
                <input class="md-input" id="model_unit" name="model_unit" autocomplete="off" value="<?php if(!empty($data_units)){ echo $data_units[0]->model;}?>" readonly>
                <label for="model_unit" class="form-control-feedback">Model Unit</label>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="md-form-group full-width">
                <input type="text" class="md-input" id="warna" name="warna" autocomplete="off" value="<?php if(!empty($data_units)){ echo $data_units[0]->color;}?>" readonly>
                <label for="warna" class="form-control-feedback">Warna</label>
              </div>
            </div> 
            <div class="col-md-6">
               <div class="md-form-group full-width">
                <input type="text" class="md-input" id="stnk" name="stnk" autocomplete="off" value="<?php if(!empty($data_units)){ echo $data_units[0]->stnk_due_date;}?>" readonly>
                <label for="stnk" class="form-control-feedback">Masa Aktif STNK</label>
              </div>
            </div> 
             
          </div> 
         <!--  <div class="form-group row">
            <div class="col-sm-12 text-right"> 
              <a class="btn btn-sm btn-primary uppercase" id="search">Search</a>
              <a class="btn btn-sm btn-danger uppercase" id="reset">Reset</a>
            </div>
          </div> -->
        </div> 
      </div>
    </div>
  </div> 
  <input type="hidden" id="unit_id" value="<?php echo $unit_id;?>">
  <div class="box"> 
    <div class="box-header">
      <h2>History Maintenance</h2>
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
        <table class="table table-striped" id="detailOrder"> 
          <thead>
            <th>No</th> 
            <th>WO No</th> 
            <th>Tanggal Order</th>  
            <th>Waktu</th>  
            <th>Nama Bengkel</th>  
            <th>Jenis Maintenance</th>  
            <th>Total(IDR)</th>  
            <th>Status</th> 
            <th>Action</th> 
          </thead>        
        </table>
      </div>
    </div>
  </div> 
</div>   
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-report-order" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>
