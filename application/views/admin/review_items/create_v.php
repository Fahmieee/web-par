<!-- Main content -->
<div class="padding-top"> 
   <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Baru Item Review</h3>
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
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 control-label">Nama Item Review</label> 
                  <div class="col-sm-9">
                    <input type="name" class="form-control" id="name" placeholder="Nama Item Review" name="name">
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 control-label">Keterangan</label> 
                  <div class="col-sm-9">
                    <textarea class="form-control" rows="5" name="description"></textarea>
                  </div>
                </div> 
                <div class="form-group row m-t-md">
                  <div class="col-sm-12 text-right">
                    <a href="<?php echo base_url();?>review_items" class="btn btn-sm btn-default ">Batal</a>
                    <button type="submit" class="btn btn-sm btn-info" id="save-btn">Simpan</button>
                  </div>
              </div> 
              <!-- /.box-footer -->
              </div>
              <!-- /.box-body -->
            </form>
          </div> 

        </div>
        
      </div>
</div>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-review-items" src="<?php echo base_url()?>assets/js/require.js"></script>