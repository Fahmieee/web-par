<div class="padding-top">
  <div class="row"> 
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h2>Edit Jabatan</h2> 
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
            <input type="hidden" id="group_id_selected" value="<?php echo $group_id;?>">
            <input type="hidden" id="area_id_selected" value="<?php echo $area_id;?>">
             <div class="full-width">
              <div class="md-form-group   full-width">
                <select id="area_id" name="area_id" class="md-input">
                  <option value="" >Pilih Area</option>
                  <?php foreach($areas as $area){?>
                    <?php if($area_id == $area->id){?>
                  <option value="<?php echo $area->id?>" selected><?php echo $area->name;?></option>
                   <?php }else{?>
                  <option value="<?php echo $area->id?>"><?php echo $area->name;?></option>
                  <?php }?>
                  <?php }?>
                </select>
                <label for="area_id" class="form-control-feedback">Area</label>
              </div>
            </div>
            <div class="full-width">
              <div class="md-form-group  full-width">
                <select id="group_id" name="group_id" class="md-input">
                  <option value="" >Pilih Departemen</option> 
                </select>
                <label for="group_id" class="form-control-feedback">Departemen</label>
              </div>
            </div>  
            <div class="full-width">
              <div class="md-form-group float-label full-width">
                <input class="md-input" id="name" value="<?php echo $name;?>" name="name" value="<?php echo $name;?>" autocomplete="off" required> 
                <label for="username" class="form-control-feedback">Jabatan</label>
              </div>
            </div>
            <div class="full-width">
              <div class="md-form-group float-label full-width">
                <textarea class="md-input" id="description" name="description" autocomplete="off" ><?php echo $description;?></textarea>
                <label for="description" class="form-control-feedback">Deskripsi</label>
              </div>
            </div>  
            <div class="form-group row m-t-md">
              <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-sm btn-info uppercase" id="save-btn">Simpan Perubahan</button>
                <a href="<?php echo base_url();?>role" class="btn btn-sm btn-danger uppercase">Batal</a>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div> 
  </div>
</div>  
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-role" src="<?php echo base_url()?>assets/js/require.js"></script>