<?php if(!$is_can_search){?>
<style type="text/css">
  .dataTables_filter input { visibility: hidden;}
  .dataTables_filter label { visibility: hidden;}
</style>
<?php }?>
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
        <?php }?>  <?php if(!empty($this->session->flashdata('message_error'))){?>
        <div class="alert alert-danger">
        <?php   
           print_r($this->session->flashdata('message_error'));
        ?>
        </div>
        <?php }?> 
        <table class="table table-striped" id="table"> 
          <thead>
            <th>No</th> 
            <th>Pre Order No</th>
            <th>Date</th>  
            <th>Jenis Maintenance</th>  
            <th>Nama Bengkel</th>  
            <th>Nama Driver</th>  
            <th>Nama Unit</th>  
            <th>Status</th>  
            <th>Action</th> 
          </thead>        
        </table>
      </div>
    </div>
  </div> 
</div>   
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-preorder" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>