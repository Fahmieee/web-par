 <style type="text/css">
  .dataTables_filter input { visibility: hidden;}
  .dataTables_filter label { visibility: hidden;}
  .checked {
    color: orange;
}
</style> 
<input type="hidden" name="workshop_id" id="workshop_id" value="<?php echo $workshop_id?>">
<div class="padding-top">
  <div class="box"> 
    <div class="box-body padtop-30">
      <div class="row">
        <div class="col-sm-2">
          <img class="centered-image martop-15" src="<?php echo base_url()?>assets/images/logo-bengkel.png">
        </div>
        <div class="col-sm-7"> 
          <div class="form-group row">
            <div class="col-md-6">
              <div class="md-form-group  full-width">
                <input class="md-input" id="workshop_code" name="workshop_code" autocomplete="off" value="<?php echo $workshops->code?>" readonly>
                <label for="workshop_code" class="form-control-feedback">Kode Bengkel</label>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="md-form-group  full-width">
                <input class="md-input" id="workshop_name" name="workshop_name" autocomplete="off" value="<?php echo $workshops->name?>" readonly>
                <label for="workshop_name" class="form-control-feedback">Nama Bengkel</label>
              </div>
            </div> 
            <div class="col-md-12">
              <div class="md-form-group  full-width">
                <input class="md-input" id="address" name="address" autocomplete="off" value="<?php echo $workshops->address;?>" readonly>
                <label for="address" class="form-control-feedback">Alamat</label>
              </div>
            </div> 
          </div> 
        </div> 
        <div class="col-sm-3">
          <p class="text-blue marbot-0 bolder marbot-15">Rating</p>
          <div class="full-width">
            <p class="text-blue fsize-46 single-line marbot-0 bolder pull-left marright-5">
              <?php echo number_format(round($rata_rating),2);?></p>
            <div class="pull-left">
              <div class="rating">
              <?php 
              $rating_text = "";
              $jumlah_rating = 5;
              for ($i=0; $i < $jumlah_rating ; $i++) { 
                if($i < $rata_rating){
                   $rating_text .= '<span class="fa fa-star checked"></span>'; 
                }else{  
                   $rating_text .=' <span class="fa fa-star"></span>';
                }
              }
              echo $rating_text;
              ?>

              </div>
             
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div> 
  <div class="box"> 
    <div class="box-header">
      <h2>Penilaian Bengkel</h2>
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
        <table class="table table-striped" id="detailWorkshop"> 
          <thead>
            <th>No</th> 
            <th>Order No</th>
            <th>Work Order No</th>  
            <th>Tanggal Order</th>  
            <th>Tipe Maintenance</th>  
            <th>Rating</th>  
            <th>Ulasan</th>  
            <th>Action</th>  
          </thead>        
        </table>
      </div>
    </div>
  </div> 
</div>   
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-report-workshop" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>