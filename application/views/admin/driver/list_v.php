<div class="padding-top">
  <?php if($is_can_search){?>
  <div class="box"> 
    <div class="box-header"> 
      <h3 class="box-title">Cari Driver</h3>
    </div>  
    <div class="box-body">
      <div class="col-sm-12">  
        <div class="form-group row">
          <div class="col-md-6">
            <div class="md-form-group   full-width">
              <input class="md-input" id="name" name="name" autocomplete="off">
              <label for="name" class="form-control-feedback">Nama Driver</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group full-width">
              <select class="md-input" id="type_driver" name="type_driver">
                <option value="0">Pilih Fungsi Driver</option>
                <option value="1">Pool</option>
                <option value="2">Dedicated</option>
              </select>
              <label for="type_driver" class="form-control-feedback">Fungsi Driver</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group   full-width">
              <input class="md-input" id="username" name="username" autocomplete="off">
              <label for="username" class="form-control-feedback">Username</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="handphone" name="handphone" autocomplete="off">
              <label for="handphone" class="form-control-feedback">Nomor Handphone</label>
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
        <a href="<?php echo base_url()?>driver/create" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i> driver</a>
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
         <?php if(!empty($this->session->flashdata('message_error'))){?>
        <div class="alert alert-info">
        <?php   
           print_r($this->session->flashdata('message_error'));
        ?>
        </div>
        <?php }?> 
        <table class="table table-striped" id="table"> 
          <thead>
            <th>No Urut</th> 
            <th>Username</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Handphone</th> 
            <th>Join Date</th> 
            <th>Tipe Driver</th> 
            <th>Rating</th>   
            <th>Action</th> 
          </thead>        
        </table>
      </div>
    </div>
  </div> 
</div>  
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-driver" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>