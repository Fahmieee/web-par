 
<div class="padding-top">
  <div class="box">  
    <div class="box-body">
   <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Buat Menu Baru</h3>
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
                <!-- <input type="hidden" name="module" id="module" value="1">
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Parent</label> 
                  <div class="col-sm-10">
                   <select id="parent" name="parent_id" class="form-control">
                      <option value="">Pilih</option>
                      <option value="2">Dashboard</option>
                      <option value="3">System Access</option>
                      <option value="4">Manage Account</option>
                      <option value="5">Master Data</option>
                      <option value="6">PPJK Service</option>
                      <option value="7">Operation Tools</option>
                   </select>
                  </div>
                </div>  -->
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Menu</label> 
                  <div class="col-sm-10">
                   <input type="name" class="form-control" id="name" placeholder="Nama Menu" name="name">
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Url Menu</label> 
                  <div class="col-sm-10">
                   <input type="name" class="form-control" id="url" placeholder="URL" name="url">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Icon Menu</label> 
                  <div class="col-sm-10">
                   <input type="name" class="form-control" id="icon" placeholder="Icon Menu" name="icon">
                  </div>
                </div>   
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              	 <div class="col-sm-2 pull-right">
	                <a href="<?php echo base_url();?>menu" class="btn btn-sm btn-default ">Batal</a>
	                <button type="submit" class="btn btn-sm btn-info" id="save-btn">Simpan</button>
	            </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div> 

        </div>
        
      </div>
    </div>
  </div>
</div>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-menu" src="<?php echo base_url()?>assets/js/require.js"></script>