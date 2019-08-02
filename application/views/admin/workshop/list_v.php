<style type="text/css">
  .dataTables_filter input { visibility: hidden;}
  .dataTables_filter label { visibility: hidden;}
</style>
  
<div class="padding-top">
  <div class="full-width">
    <div class="row">
      <div class="col-md-6 row">
        <div class=" col-sm-6">
          <div class="box p-a"> 
            <span class="w-48 rounded accent">
              <i class="material-icons">&#xe7f0;</i>
            </span> 
            <div style="float:right;">
              <span><?php echo $jumlah_rekanan;?></span> <br>
              <span>Bengkel Rekanan</span> 
            </div> 
          </div>
        </div>  
        <div class=" col-sm-6">
          <div class="box p-a"> 
            <span class="w-48 rounded accent">
              <i class="material-icons">&#xe7f0;</i>
            </span> 
            <div style="float:right;">
              <span><?php echo $jumlah_non_rekanan;?></span> <br>
              <span>Bengkel Non-Rekanan</span> 
            </div> 
          </div>
        </div> 
       
      </div>
      <?php if($is_can_search){?>
      <div class="col-md-6">
        <div class="box padtop-10">
          <div class="box-body">
            <label>Cari Bengkel</label>
            <div class="row">
              <div class="col-md-4">
                <div class="full-width">
                  <div class="md-form-group full-width">
                    <select class="form-control md-input" name="partner" id="partner">
                        <option value="">Pilih Rekanan</option>
                        <option value="1">Rekanan</option>
                        <option value="2">Bukan Rekanan</option>
                    </select>
                    <label for="phone_number" class="form-control-feedback">Rekanan</label>
                  </div>
                </div>  
              </div>
              <div class="col-md-3">
                <div class="full-width">
                  <div class="md-form-group full-width">
                    <input class="md-input" id="name" name="name" autocomplete="off">
                    <label for="phone_number" class="form-control-feedback">Nama Bengkel</label>
                  </div>
                </div>  
              </div>
              <div class="col-md-3">
                <div class="full-width">
                  <div class="md-form-group full-width">
                    <input class="md-input" id="area" name="area" autocomplete="off">
                    <label for="phone_number" class="form-control-feedback">Area Bengkel</label>
                  </div>
                </div>  
              </div>
              <div class="col-md-2 padtop-20">
                 <button class="btn btn-sm btn-primary" id="search">Cari</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php }?>
    </div>
  </div>
  <div class="tab-content clearfix">
    <div class="tab-pane active" id="1a">
      <div class="box"> 
        <div class="box-header">
          List Bengkel
          <?php if($is_can_create){?>
          <div class="col-md-2 datatableButton text-right">
            <a href="<?php echo base_url()?>workshop/create" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i> Workshop</a>
          </div>
          <?php }?>
        </div>
        <div class="box-divider m-0"></div>  
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
            <div class="alert alert-danger">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
            </div>
            <?php }?> 
            <table class="table table-striped" id="table"> 
              <thead>
                <th>No Urut</th> 
                <th>Kode Bengkel</th>
                <th>Nama Bengkel</th> 
                <th>Alamat</th> 
                <th>No Telp</th>    
                <th>Latitude</th>    
                <th>Longitude</th>    
                <th>PIC Bengkel</th>    
                <th>No HP Bengkel</th>    
                <th>Action</th> 
              </thead>        
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="2a">
      <div class="box"> 
        <div class="box-header">
          List Bengkel Non-Rekanan
        </div>
        <div class="box-divider m-0"></div>  
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
                <th>Kode Workshop</th>
                <th>Nama Workshop</th> 
                <th>Keterangan</th> 
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
  data-main="<?php echo base_url()?>assets/js/main/main-workshop" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>