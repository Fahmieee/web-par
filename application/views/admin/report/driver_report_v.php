 <style type="text/css">
  .dataTables_filter input { visibility: hidden;}
  .dataTables_filter label { visibility: hidden;}
</style>
<div class="padding-top">
  <div class="row">
    <div class="col-sm-9">
      <ul class="nav nav-tabs nav-pill-custom martop-25">
        <li class="nav-item active">
          <a class="nav-link" href="#driveractive" data-toggle="tab">
            <div class="icon-contain">
              <img src="<?php echo base_url()?>assets/images/icon-driver.png">
            </div>
            <div class="text-contain">
              <h4 class="text-blue marbot-0 bolder"><?php echo $count_driver;?></h4>
              <p class="text-blue marbot-0 bolder">Driver Aktif</p>
            </div>  
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#drivertop" data-toggle="tab">
            <div class="icon-contain">
              <img src="<?php echo base_url()?>assets/images/icon-top-driver.png">
            </div>
            <div class="text-contain padleft-15">
              <h4 class="text-blue marbot-0 bolder">10</h4>
              <p class="text-blue marbot-0 bolder">Top Driver</p>
            </div>  
          </a>
        </li>
      </ul>
    </div>
      <?php if($is_can_search){?> 
    <div class="col-sm-3">
      <div class="form-group">
        <div class="row">
          <label class="control-label col-sm-12" for="">Cari Driver</label>
          <div class="col-sm-12 marbot-5">
            <input type="text" class="form-control" id="driver_id" placeholder="Masukkan ID Driver">
          </div>
          <div class="col-sm-12 marbot-5">
            <input type="text" class="form-control" id="driver_name" placeholder="Masukkan Nama Driver">
          </div>
          <div class="col-sm-12">
            <input type="submit" value="Cari" class="btn btn-warning pull-right" id="search">
          </div>
        </div>
      </div>
    </div>
    <?php }?>
  </div>
  <div class="tab-content martop-15 clearfix">
    <div role="tabpanel" class="tab-pane active" id="driveractive">
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
                <th>ID</th>
                <th>Nama</th>
                <th>Fungsi</th>  
                <th>Lokasi</th>    
                <th>Rating</th>  
              </thead>        
            </table>
          </div>
        </div>
      </div> 
    </div>
    <div role="tabpanel" class="tab-pane" id="drivertop">
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
            <table class="table table-striped" id="table-top"> 
              <thead>
                <th>No</th> 
                <th>ID</th>
                <th>Nama</th>
                <th>Fungsi</th>  
                <th>Lokasi</th>  
                <th>Rating</th>  
              </thead>        
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>   
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-report-driver" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>