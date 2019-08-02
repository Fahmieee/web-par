<div class="padding-top">
   <div class="row">
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body">
          
          <p class="padtop-30 padbot-30">
            <?php if(!empty($photo)){?>
            <img src="<?php echo base_url()."assets/images/photo/".$photo;?>" class="img-circle w-110">
            <?php }else{ ?>
              <img src="<?php echo base_url()?>assets/images/default-image.png" class="img-circle w-110">
            <?php }?>
          </p> 
          <div class="form-group row">
            <div class="col-sm-12">
              <p class="text-blue text-center bolder fsize-16 marbot-0"><?php echo $name?></p>
              <p class="text-grey text-center fsize-12 marbot-0"><?php echo $company?></p>
            </div> 
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary padbot-5">
        <!-- form start -->
        <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
          <div class="box-body">
            <?php if(!empty($this->session->flashdata('message_error'))){?>
            <div class="alert alert-danger">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
            </div>
            <?php }?> 
            <input type="hidden" name="id" id="user_id" value="<?php echo $id;?>"> 
            <div class="full-width">
                <div class="md-form-group   full-width">
                  <input class="md-input" id="name" name="name" autocomplete="off" value="<?php echo $name;?>" disabled>
                  <label for="name" class="form-control-feedback">Nama Lengkap</label>
                </div>
              </div>
              <div class="full-width">
                <div class="md-form-group   full-width">
                  <input class="md-input" id="email" name="email" autocomplete="off" value="<?php echo $email;?>" disabled>
                  <label for="email" class="form-control-feedback">Email</label>
                </div>
              </div> 
              <div class="full-width">
                <div class="md-form-group   full-width">
                  <input class="md-input" id="phone" name="phone" autocomplete="off" value="<?php echo $phone;?>" disabled>
                  <label for="phone" class="form-control-feedback">Nomor Handphone</label>
                </div>
              </div>
              <div class="full-width">
                <div class="md-form-group   full-width">
                  <input class="md-input" id="company" name="company" autocomplete="off" value="<?php echo $company;?>" disabled>
                  <label for="company" class="form-control-feedback">Alokasi/Perusahaan</label>
                </div>
              </div>
              <div class="full-width">
                <div class="md-form-group   full-width">
                  <input class="md-input" id="department" name="department" autocomplete="off" value="<?php echo $department;?>" disabled>
                  <label for="department" class="form-control-feedback">Jabatan</label>
                </div>
              </div> 
            </div>    
            <div class="full-width marbot-15">
              <div class="col-sm-12 text-right">
                <a href="<?php echo base_url();?>user" class="btn btn-sm btn-danger uppercase">Batal</a> 
              </div>
            </div>   
          </div> 
        </form>
      </div>  
    </div>
  </div>
</section>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-user" src="<?php echo base_url()?>assets/js/require.js"></script>