 
<div class="padding-top">
  <div class="box"> 
    <div class="box-header">
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
            <th>Kode Negara</th>
            <th>Nama Negara</th> 
            <th>Keterangan</th> 
            <th>Action</th> 
          </thead>        
        </table>
      </div>
    </div>
  </div> 
</div>   
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-country" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>