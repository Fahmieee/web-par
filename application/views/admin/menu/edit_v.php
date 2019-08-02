 
<div class="padding-top">
  <div class="box">  
    <div class="box-body">
     <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Form Ubah Menu</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
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
                   
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 control-label">Icon Menu</label> 
                    <div class="col-sm-10">
                     <input type="name" class="form-control" id="icon" placeholder="Icon Menu" name="icon" value="<?php echo $icon;?>">
                    </div>
                  </div>   
                  <div class="form-group row m-t-md">
                    <div class="col-sm-12 text-right pull-right">   
                      <a href="<?php echo base_url();?>menu" class="btn btn-sm btn-default  ">Batal</a>
                     <button type="submit" class="btn btn-sm btn-info " id="save-btn">Simpan</button>
                    </div>
                  </div>    
               </div> 
             </form>
          </div>
          
        </div>
    </div>
  </div>
</div> 
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-menu" src="<?php echo base_url()?>assets/js/require.js"></script>