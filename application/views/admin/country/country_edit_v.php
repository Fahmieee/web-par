 
<div class="padding-top">
  <div class="row"> 
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h2>Form Ubah</h2> 
        </div>
        <div class="box-divider m-0"></div>
        <div class="box-body">
           <form class="form-horizontal" id="form" method="POST" action="">
            <?php if(!empty($this->session->flashdata('message_error'))){?>
            <div class="alert alert-danger">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
            </div>
            <?php }?> 
           <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 control-label">Kode Negara</label> 
              <div class="col-sm-10">
                <input type="name" class="form-control" id="code" placeholder="Kode Negara" name="code" value="<?php echo $code;?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Negara</label> 
              <div class="col-sm-10">
               <input type="name" class="form-control" id="name" placeholder="Nama Negara" name="name" value="<?php echo $name;?>">
              </div>
            </div> 
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label> 
              <div class="col-sm-10">
               <textarea class="form-control" name="description"><?php echo $description;?></textarea>
              </div>
            </div> 
            <div class="form-group row m-t-md">
              <div class="col-sm-12 text-right">
                <a href="<?php echo base_url();?>country" class="btn btn-sm btn-default ">Batal</a>
                  <button type="submit" class="btn btn-sm btn-info" id="save-btn">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div> 
  </div>
</div>
<div class="padding"></div>
<script data-main="<?php echo base_url()?>assets/js/main/main-country" src="<?php echo base_url()?>assets/js/require.js"></script>