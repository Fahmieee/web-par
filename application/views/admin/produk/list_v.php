 <?php if($is_can_search){?>
<style type="text/css">
  .dataTables_filter{
    right: 90px;
    position: relative;
    top:5px;
  }
</style> 
<?php }?>
<div class="padding-top">
  <div class="box"> 
    <div class="box-header">
       <?php if($is_can_create){?>
      <div class="col-md-2 datatableButton text-right">
        <a href="<?php echo base_url()?>produk/create" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i> Produk</a>
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
        <table class="table table-striped" id="table"> 
          <thead>
            <th>No Urut</th>
            <th>Kode produk</th>
            <th>Nama produk</th> 
            <th>Keterangan</th> 
            <th>Action</th> 
          </thead>        
        </table>
      </div>
    </div>
  </div> 
</div>   
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-produk" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>