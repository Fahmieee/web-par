 <style type="text/css">
  .dataTables_filter input { visibility: hidden;}
  .dataTables_filter label { visibility: hidden;}
</style>
<div class="padding-top">
  <?php if($is_can_search){?> 
  <div class="box"> 
    <div class="box-header"> 
      <h3 class="box-title">Cari Permintaan Maintenance</h3>
    </div>  
    <div class="box-body">
     <!--  <div class="col-sm-10"> 
        <div class="form-group row">
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="wo_no" name="wo_no" autocomplete="off">
              <label for="wo_no" class="form-control-feedback">No WO</label>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="driver_name" name="driver_name" autocomplete="off">
              <label for="driver_name" class="form-control-feedback">Nama Driver</label>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <select id="maintenance_type" class="md-input">
                <option value="">Pilih Jenis Maintenance</option>
                <option value="treatment">Perawatan</option>
                <option value="repair">Perbaikan</option>
                <option value="emergency">Darurat</option>
              </select>
              <label for="maintenance_type" class="form-control-feedback">Jenis Maintenance</label>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="md-form-group full-width">
              <input type="text" class="md-input" id="workshop_name" name="workshop_name" autocomplete="off">
              <label for="workshop_name" class="form-control-feedback">Nama Bengkel</label>
            </div>
          </div>   
          <div class="col-md-6">
            <div class="md-form-group full-width">  
              <label for="name" class="form-control-feedback">Periode</label>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="md-form-group  full-width">
            
            </div>
          </div> 
             <div class="col-md-3">
            <div class="md-form-group full-width"> 
              <input class="md-input" id="from" name="from" autocomplete="off">
              <label for="from" class="form-control-feedback">Dari</label>
            </div>
          </div> 
        <div class="col-md-3">
            <div class="md-form-group full-width"> 
              <input class="md-input" id="to" name="to" autocomplete="off">
              <label for="to" class="form-control-feedback">Sampai</label>
            </div>
          </div> 
        </div> 
        <div class="form-group row">
          <div class="col-sm-12 text-right"> 
            <a class="btn btn-sm btn-primary uppercase" id="search">Search</a>
            <a class="btn btn-sm btn-danger uppercase" id="reset">Reset</a>
          </div>
        </div>
      </div>  -->
       <div class="col-sm-10"> 
        <div class="form-group row">
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="no_police" name="no_police" autocomplete="off">
              <label for="no_police" class="form-control-feedback">No Police</label>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="unit_name" name="unit_name" autocomplete="off">
              <label for="unit_name" class="form-control-feedback">Merk Unit</label>
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
      <div class="col-sm-12 row">
        <div class="col-sm-6"> <h2>List Maintenance</h2></div>
        <div class="col-sm-6 text-right">
          <a href="<?php echo base_url()?>report/report_excel" 
            target="_blank" class="btn"><span class=" fa fa-file-excel-o"></span> Download Excel</a>
          <a href="<?php echo base_url()?>report/report_pdf" 
            target="_blank" class="btn"><span class=" fa fa-file-excel-o"></span> Download Pdf</a>
        </div>
      </div>
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
            <th>No Police</th>
            <th>Nama Unit</th>
            <th>Model </th>  
            <th>Varian </th>  
            <th>Tahun</th>   
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