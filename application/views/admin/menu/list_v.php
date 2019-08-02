 
<div class="padding-top">
  <div class="box"> 
   <!--  <div class="box-header">
      <div class="col-md-12 text-right">
         <a href="<?php echo base_url()?>menu/create" class="btn btn-sm btn-primary" >Buat Menu Baru</a>
      </div>
    </div> -->
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
              <th>Parent</th>  
              <th>Name</th> 
              <th>URL</th> 
              <th>Icon</th> 
              <th>Action</th> 
            </thead>        
       </table>
      </div>
    </div>
  </div> 
</div>
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-menu" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>