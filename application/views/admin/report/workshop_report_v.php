 <style type="text/css">
  .dataTables_filter input { visibility: hidden;}
  .dataTables_filter label { visibility: hidden;}
  .checked {
    color: orange;
}
</style> 
<div class="padding-top">
  <div class="row">
    <div class="col-sm-9">
      <ul class="nav nav-tabs nav-pill-custom martop-25">
        <li class="nav-item active">
          <a class="nav-link" href="#partner" data-toggle="tab">
            <div class="icon-contain">
              <img src="<?php echo base_url()?>assets/images/icon-wrench.png">
            </div>
            <div class="text-contain">
              <h4 class="text-blue marbot-0 bolder"><?php echo $jumlah_rekanan?></h4>
              <p class="text-blue marbot-0 bolder">Bengkel Rekanan</p>
            </div>  
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#nonpartner" data-toggle="tab">
            <div class="icon-contain">
              <img src="<?php echo base_url()?>assets/images/icon-wrench.png">
            </div>
            <div class="text-contain">
              <h4 class="text-blue marbot-0 bolder"><?php echo $jumlah_non_rekanan?></h4>
              <p class="text-blue marbot-0 bolder">Bengkel Non-Rekanan</p>
            </div>  
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#workshoptop" data-toggle="tab">
            <div class="icon-contain">
              <img src="<?php echo base_url()?>assets/images/icon-wrench.png">
            </div>
            <div class="text-contain">
              <h4 class="text-blue marbot-0 bolder">10</h4>
              <p class="text-blue marbot-0 bolder">Top Bengkel</p>
            </div>  
          </a>
        </li>
      </ul>
    </div>
    <?php if($is_can_search){?> 
    <div class="col-sm-3">
      <div class="form-group">
        <div class="row">
          <label class="control-label col-sm-12" for="">Cari Bengkel</label>
          <div class="col-sm-12 marbot-5">
            <input type="text" class="form-control" id="workshop_name" placeholder="Masukkan Nama Bengkel">
          </div>
          <div class="col-sm-12 marbot-5">
            <input type="text" class="form-control" id="area_name" placeholder="Masukkan Area Bengkel">
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
    <div class="tab-pane active" id="partner">
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
            <table class="table table-striped" id="tableRekanan"> 
              <thead>
                <th>No</th>  
                <th>Nama Bengkel</th>
                <th width="50%">Alamat</th>   
                <th>Rating</th> 
                <th>Action</th> 
              </thead>        
            </table>
          </div>
        </div>
      </div> 
    </div>
    <div class="tab-pane" id="nonpartner">
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
            <table class="table table-striped" id="tableNonRekanan"> 
              <thead>
                <th>No</th>  
                <th>Nama Bengkel</th>
                <th width="50%">Alamat</th>   
                <th>Rating</th> 
                <th>Action</th> 
              </thead>       
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="workshoptop">
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
            <table class="table table-striped" id="topWorkshop"> 
              <thead>
                <th>No</th>  
                <th>Nama Bengkel</th>
                <th width="50%">Alamat</th>  
                <th>Rating</th> 
                <th>Action</th> 
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
  data-main="<?php echo base_url()?>assets/js/main/main-report-workshop" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>