<div class="padding-top"> 
  <div class="row"> 
    <div class="col-md-12"> 
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Membuat Cabang</h3>
        </div> 
        <div class="box-divider m-0"></div>
        <form class="form-horizontal" id="form" method="POST" action="">
          <div class="box-body">
            <?php if(!empty($this->session->flashdata('message_error'))){?>
  			    <div class="alert alert-danger">
  			    <?php   
  			       print_r($this->session->flashdata('message_error'));
  			    ?>
  			    </div>
  			    <?php }?>
            <div class="full-width">
              <div class="md-form-group  full-width">
                <select id="area_id" name="area_id" class="md-input">
                  <option value="">Pilih Area</option>
                  <?php foreach ($areas as $area) { ?>
                      <option value="<?php echo $area->id?>"><?php echo $area->name?></option>
                  <?php } ?>
                </select>
                <label for="area_id" class="form-control-feedback">Area</label>
              </div>
            </div> 
            <div class="full-width">
              <div class="md-form-group  full-width">
                <select id="city_id" name="city_id" class="md-input">
                  <option value="">Pilih Kota</option>
                  <?php foreach ($cities as $city) { ?>
                      <option value="<?php echo $city->id?>"><?php echo $city->name?></option>
                  <?php } ?>
                </select>
                <label for="area_id" class="form-control-feedback">Kota</label>
              </div>
            </div> 
            <div class="full-width">
              <div class="md-form-group full-width">
                <input class="md-input" id="code" name="code" autocomplete="off" required>
                <label for="code" class="form-control-feedback">Kode Cabang</label>
              </div>
            </div> 
            <div class="full-width">
              <div class="md-form-group full-width">
                <input class="md-input" id="name" name="name" autocomplete="off" required>
                <label for="name" class="form-control-feedback">Nama Cabang</label>
              </div>
            </div> 
            <div class="full-width">
              <div class="md-form-group  full-width">
                <textarea class="md-input" id="description" name="description" autocomplete="off"></textarea>
                <label for="description" class="form-control-feedback">Keterangan</label>
              </div>
            </div> 
            <div class="form-group row m-t-md">
              <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-sm btn-info uppercase" id="save-btn">Simpan</button>
                <a href="<?php echo base_url();?>branch" class="btn btn-sm btn-danger uppercase">Batal</a>
              </div>
            </div> 
          </div>
        </form>
      </div>  
    </div>
  </div>
</div>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-branch" src="<?php echo base_url()?>assets/js/require.js"></script>