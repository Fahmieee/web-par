 
<div class="padding-top">
     <?php if($is_can_search){?>
  <div class="box"> 
    <div class="box-header"> 
      <h3 class="box-title">Cari Work Order</h3>
    </div>  
    <div class="box-body">
      <div class="col-sm-12">  
        <div class="form-group row">
          <div class="col-md-6">
            <div class="md-form-group   full-width">
              <input class="md-input" id="order_no" name="order_no" autocomplete="off">
              <label for="order_no" class="form-control-feedback">Nomor Order</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group full-width">
              <select name="maintenance" id="maintenance" class="md-input">
                <option value=""> Pilih Jenis Maintenance</option>
                <option value="treatment"> Perawatan</option>
                <option value="repair"> Perbaikan</option>
                <option value="emergency"> Darurat</option> 
              </select>
              <label for="maintenance" class="form-control-feedback">Jenis Maintenance</label>

            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group   full-width">
                <input class="md-input" id="unit_name" name="unit_name" autocomplete="off">
              <label for="unit_name" class="form-control-feedback">Nama Unit</label>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="md-form-group   full-width">
              <input class="md-input" id="order_date" name="order_date" autocomplete="off">
              <label for="order_date" class="form-control-feedback">Tanggal Order</label>
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
            <th>No</th> 
            <th>Work Order No</th>
            <th>Date</th>  
            <th>Jenis Maintenance</th>  
            <th>Nama Bengkel</th>  
            <th>Nama Driver</th>  
            <th>Nama Unit</th>  
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
  data-main="<?php echo base_url()?>assets/js/main/main-report-workorder" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>