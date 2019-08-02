<div class="padding-top">
  <div class="row"> 
    <div class="col-md-12"> 
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit produk</h3>
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
  			    <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="full-width">
              <div class="md-form-group full-width">
                <input class="md-input" id="code" name="code" autocomplete="off" value="<?php echo $code;?>" required>
                <label for="code" class="form-control-feedback">Kode Produk</label>
              </div>
            </div>   
            <div class="full-width">
              <div class="md-form-group full-width">
                <input class="md-input" id="name" name="name" autocomplete="off" value="<?php echo $name;?>" required>
                <label for="name" class="form-control-feedback">Nama Produk</label>
              </div>
            </div>   
            <div class="full-width">
              <div class="md-form-group  full-width">
                <textarea class="md-input" id="description" name="description" autocomplete="off"><?php echo $description;?></textarea>
                <label for="description" class="form-control-feedback">Keterangan</label>
              </div>
            </div>
            <div class="form-group row m-t-md">
              <div class="col-sm-12 text-right">
                <a href="<?php echo base_url();?>produk" class="btn btn-sm btn-default ">Cancel</a>
                <button type="submit" class="btn btn-sm btn-info" id="save-btn">Simpan</button>
              </div>
            </div>  
          </div> 
        </form>
      </div> 
    </div> 
  </div>
</div>
<div class="padding"></div>
<script data-main="<?php echo base_url()?>assets/js/main/main-produk" src="<?php echo base_url()?>assets/js/require.js"></script>