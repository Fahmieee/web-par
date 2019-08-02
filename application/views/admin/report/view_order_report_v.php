 <div class="padding-top">
  <div class="box"> 
    <div class="box-header"> 
      <h3 class="box-title">Cari Permintaan Maintenance</h3>
    </div>  
    <div class="box-body">
      <div class="row"> 
        <div class="col-sm-12"> 
          <div class="form-group row">
            <div class="col-md-6">
              <div class="md-form-group  full-width">
                <input class="md-input" id="merk_unit" name="merk_unit" autocomplete="off">
                <label for="merk_unit" class="form-control-feedback">Merk Unit</label>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="md-form-group  full-width">
                <input class="md-input" id="police_no" name="police_no" autocomplete="off">
                <label for="police_no" class="form-control-feedback">No. Polisi</label>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="md-form-group  full-width">
                <input class="md-input" id="model_unit" name="model_unit" autocomplete="off">
                <label for="model_unit" class="form-control-feedback">Model Unit</label>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="md-form-group full-width">
                <input type="text" class="md-input" id="warna" name="warna" autocomplete="off">
                <label for="warna" class="form-control-feedback">Warna</label>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="md-form-group  full-width">
                <input class="md-input" id="varian_unit" name="varian_unit" autocomplete="off">
                <label for="varian_unit" class="form-control-feedback">Model Unit</label>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="md-form-group full-width">
                <input type="text" class="md-input" id="stnk" name="stnk" autocomplete="off">
                <label for="stnk" class="form-control-feedback">Masa Aktif STNK</label>
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
  </div> 
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
            <th>Nama Unit</th>
            <th>Work Order No.</th>  
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
