<style type="text/css">
  .dataTables_filter input { visibility: hidden;}
  .dataTables_filter label { visibility: hidden;}
</style>
<div class="padding-top">
   
  <div class="box"> 
    <div class="box-header">
      Mapping Bengkel
    </div> 
    <div class="box-body">
      <div id="map"></div>
      <textarea id="data_workshop" hidden><?php echo json_encode($workshops);?></textarea>
    </div>
  </div>
     
</div>   
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-map" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>