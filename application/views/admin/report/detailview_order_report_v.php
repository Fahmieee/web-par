<div class="padding-top">
  <div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" id="form" method="POST" action="">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Detail View Order</h3>
        </div>
        <div class="box-divider m-0"></div>
        <div class="box-body">
          <?php if(!empty($this->session->flashdata('message_error'))){?>
          <div class="alert alert-danger">
            <?php   
             print_r($this->session->flashdata('message_error'));
            ?>
          </div>
          <?php }?> 
          <div class="full-width">
            <div class="md-form-group   full-width">
              <textarea class="md-input" id="ulasan" name="ulasan" autocomplete="off"><?php echo $orders->review_note;?></textarea>
              <label for="ulasan" class="form-control-feedback">Ulasan</label>
            </div>
          </div> 
          <div class="form-group row m-t-md">
            <div class="col-sm-12 text-right"> 
              <a href="<?php echo base_url();?>report/viewOrder/<?php echo $orders->id;?>" class="btn btn-sm btn-danger uppercase">Kembali</a>
            </div>
          </div>
      </div>    
      </form>
    </div> 
  </div>
</div>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-report-order" src="<?php echo base_url()?>assets/js/require.js"></script>