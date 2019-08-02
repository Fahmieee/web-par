 
<div class="padding-top">
  <?php if($is_can_search){?>
  <div class="box"> 
    <div class="box-header"> 
    </div>  
    <div class="box-body">
      <div class="col-sm-12"> 
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 control-label">Fungsi Driver</label> 
          <div class="col-sm-4"> 
            <select class="form-control" id="driver_type" name="driver_type">
                <option value="">Pilih Fungsi Driver</option>
                <option value="2">Pool</option>
                <option value="1">Dedicated</option>
            </select>
          </div>
          <label for="inputEmail3" class="col-sm-2 control-label">Alokasi</label> 
          <div class="col-sm-4">
            <input type="name" class="form-control" id="allocation" placeholder="Alokasi" name="allocation">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Driver</label> 
          <div class="col-sm-4">
            <input type="name" class="form-control" id="driver_name" placeholder="Nama Driver" name="driver_name">
          </div>
          <label for="inputEmail3" class="col-sm-2 control-label">Merk Unit</label> 
          <div class="col-sm-4">
            <select name="merk" id="merk" class="form-control">
               <option value=""> Pilih Merk Unit</option>
              <?php foreach($merk_units as $unit){?>
              <option value="<?php echo $unit->id;?>"><?php echo $unit->name;?></option>
            <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group row">
         
          <label for="inputEmail3" class="col-sm-2 control-label">No. Polisi</label> 
          <div class="col-sm-4">
            <input type="name" class="form-control" id="police_number" placeholder="No. Polisi" name="police_number">
          </div> 
        </div>
        <div class="form-group row">
          <div class="col-sm-12 text-right"> 
            <a class="btn btn-sm btn-primary" id="search">Search</a>
            <a class="btn btn-sm btn-danger" id="reset">Reset</a>
          </div>
        </div>
      </div> 
    </div>
  </div> 
  <?php }?>
  <div class="box"> 
    <div class="box-header">
      <?php if($is_can_create){?>
      <div class="col-md-2 text-right pull-right">
        <a href="<?php echo base_url()?>scheduler/create" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i>Membuat Scheduler</a>
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
            <th>No</th> 
            <th>Fungsi</th>  
            <th>Nama Driver</th> 
            <th>Alokasi</th> 
            <th>Nama Lengkap</th>
            <th>Merk Unit</th>
            <th>Model Unit</th>  
            <th>Varian Unit</th>  
            <th>No Polisi</th>   
            <th>Action</th> 
          </thead>      
        </table>
      </div>
    </div>
  </div> 
</div>  
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-scheduler" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>