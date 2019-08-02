<div class="pad-25">
   <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            
            <form class="form-horizontal" id="form-change-password" method="POST" action="">
              <div class="box-footer">
                <h1>Change Password</h1>
                 <?php if(!empty($this->session->flashdata('message'))){?>
                <div class="alert alert-danger">
                <?php   
                   print_r($this->session->flashdata('message'));
                ?>
                </div>
                <?php }?> 
                      <div class="form-group row">
                        <label  class="col-sm-3 control-label">Password Lama</label> 
                        <div class="col-sm-6">
                         <?php echo form_input($old_password, "", 'class="form-control"'); ?> 
                        </div>
                        <div class="col-sm-3 padtop-5">
                          <span class="form-info"><i class="fa fa-info-circle"></i></span>
                          <div class="form-info-content">
                            <p class="mar-0">- Use a strong password</p>
                            <p class="mar-0">- Use combination of numbers and alphabets</p>
                          </div>
                        </div>
                      </div> 

                      <div class="form-group row">
                        <label  class="col-sm-3 control-label">Password Baru</label> 
                        <div class="col-sm-6">
                         <?php echo form_input($new_password, "", 'class="form-control"'); ?>
                         <a href="#" class="btn btn-sm btn-sm white viewpass" onclick="showPassNew()"><i class="fa fa-eye"> View</i></a>
                        </div>
                        <div class="col-sm-3 padtop-5">
                          <span class="form-info"><i class="fa fa-info-circle"></i></span>
                          <div class="form-info-content">
                            <p class="mar-0">- Use a strong password</p>
                            <p class="mar-0">- Use combination of numbers and alphabets</p>
                          </div>
                        </div>
                      </div> 

                      <div class="form-group row">
                        <label  class="col-sm-3 control-label">Konfirmasi Password Baru</label> 
                        <div class="col-sm-6">
                         <?php echo form_input($new_password_confirm, "", 'class="form-control"'); ?>
                         <a href="#" class="btn btn-sm btn-sm white viewpass" onclick="showPassConfirm()"><i class="fa fa-eye"> View</i></a>
                        </div>
                        <div class="col-sm-3 padtop-5">
                          <span class="form-info"><i class="fa fa-info-circle"></i></span>
                          <div class="form-info-content">
                            <p class="mar-0">- Use a strong password</p>
                            <p class="mar-0">- Use combination of numbers and alphabets</p>
                          </div>
                        </div>
                      </div>

                      <?php echo form_input($user_id); ?>
                      <div class="form-group row">  
                        <div class="col-sm-12">
                         <button type="submit" class="btn btn-sm btn-info pull-right" id="save-btn">Ubah</button>
                          <a href="<?php echo base_url();?>dashboard" class="btn btn-sm btn-default pull-right">Batal</a>
                        </div>
                      </div>
              </div> 
            </form>
          </div>  
        </div>
        
      </div>
</section>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-change-password" src="<?php echo base_url()?>assets/js/require.js"></script>
 <script type="text/javascript">
   function showPassOld() {
    var x = document.getElementById("old");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }
  function showPassNew() {
    var x = document.getElementById("new");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }
  function showPassConfirm() {
    var x = document.getElementById("new_confirm");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }
 </script>