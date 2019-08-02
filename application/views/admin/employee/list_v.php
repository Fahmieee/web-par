<div class="padding-top">
  <?php if($is_can_search){?>
  <div class="box"> 
    <div class="box-header with-border"> 
      <h3 class="box-title">Search Employee</h3>
    </div>  
    <div class="box-body">
      <div class="col-sm-12"> 
        <div class="form-group row">
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="nip" name="nip" autocomplete="off" required>
              <label for="username" class="form-control-feedback">NIP</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="phone" name="phone" autocomplete="off" required>
              <label for="username" class="form-control-feedback">Handphone</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="name" name="name" autocomplete="off" required>
              <label for="username" class="form-control-feedback">Nama Karyawan</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <select id="group_id" name="group_id" class="md-input">
                <option value="0">Pilih Departemen</option>
                <?php foreach($groups as $group){?>
                <option value="<?php echo $group->id?>"><?php echo $group->name;?></option>
                <?php }?>
              </select>
              <label for="area_id" class="form-control-feedback">Departemen</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group  full-width"> 
               <select id="role_id" name="role_id" class="md-input">
                <option value="0">Pilih Jabatan</option>
                <?php foreach($roles as $role){?>
                <option value="<?php echo $role->id?>"><?php echo $role->name;?></option>
                <?php }?>
              </select>
              <label for="username" class="form-control-feedback">Jabatan</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="md-form-group  full-width">
              <input class="md-input" id="email" name="email" autocomplete="off" required>
              <label for="username" class="form-control-feedback">Email</label>
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
        <a href="<?php echo base_url()?>employee/create" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i> Employee</a>
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
            <th>NIP</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>No HP</th> 
            <th>Departemen</th> 
            <th>Email</th>  
            <th>Foto</th>  
            <th>Action</th> 
          </thead>        
        </table>
      </div>
    </div>
  </div> 
</div>  
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-employee" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>