 
<div ui-view class="app-body" id="view">
  <div class="padding-top">
    <div class="box">
       
      <div class="box-body">
        <div class="table-responsive">
            <?php if(!empty($this->session->flashdata('message'))){?>
            <div class="alert alert-info">
            <?php   
               print_r($this->session->flashdata('message'));
            ?>
            </div>
            <?php }?> 
            <table ui-jp="dataTable" class="table table-striped" id="table"> 
                <thead>
                  <th>No Urut</th>
                  <th>Area</th>
                  <th>Nama Departemen</th> 
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
  data-main="<?php echo base_url()?>assets/js/main/main-groups" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>