<!-- Main content -->
<div class="padding-top"> 
  <form class="form-horizontal" id="form" method="POST" action="">
  <div class="row">   
    <div class="col-md-12"> 
      <div class="box box-primary">  
         <div class="box-header">
          <h2>Work Order</h2> 
        </div>
        <div class="box-body">
          <?php if(!empty($this->session->flashdata('message_error'))){?>
          <div class="alert alert-danger">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
          </div>
          <?php }?>  
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="hidden"  class="md-input" id="order_id" name="order_id" value="<?php echo $orders->id;?>">
              <input type="text" class="md-input" id="order_no" name="order_no" value="<?php echo $orders->order_no?>" readonly>
              <label for="area_id" class="form-control-feedback">Nomor Order</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text" class="md-input" id="order_date" name="order_date" value="<?php echo date("Y-m-d",strtotime($orders->order_date))?>" readonly>
              <label for="area_id" class="form-control-feedback">Tanggal Order</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text" class="md-input" id="order_wo_no" name="order_wo_no" value="<?php echo $orders->order_wo_no?>"readonly>
              <label for="area_id" class="form-control-feedback">Nomor Work Order</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text" class="md-input" id="order_time" name="order_time" value="<?php echo date("h:i:s",strtotime($orders->order_date))?>" readonly>
              <label for="area_id" class="form-control-feedback">Waktu Order</label>
            </div>
          </div> 
        </div>  
      </div>
    </div>  
    <div class="col-md-12"> 
      <div class="box box-primary">  
         <div class="box-header">
          <h2>Informasi kendaraan</h2> 
        </div>
        <div class="box-body"> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="unit_branch" name="unit_branch" value="<?php echo $units->branch_name;?>" readonly>
              <label for="area_id" class="form-control-feedback">Cabang</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="merk" name="merk" value="<?php echo $units->merk;?>">
              <label for="area_id" class="form-control-feedback">Merk</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="unit_type" name="unit_type" value="<?php 
                  if($units->type_unit == 1){
                    echo "Dedicated";
                  }else{
                    echo "Pool";
                  }
              ?>">
              <label for="area_id" class="form-control-feedback">Tipe Unit</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="model" name="model" value="<?php echo $units->model;?>">
              <label for="area_id" class="form-control-feedback">Model</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="asset_type" name="asset_type"
              value="<?php 
                  if($units->type_assets == 1){
                    echo "PAR";
                  }else{
                    echo "Vendor";
                  }
              ?>">
              <label for="area_id" class="form-control-feedback">Tipe Aset</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="varian" name="varian" value="<?php echo $units->varian;?>">
              <label for="area_id" class="form-control-feedback">Varian</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="no_police" name="no_police" value="<?php echo $units->no_police;?>">
              <label for="area_id" class="form-control-feedback">No Polisi</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="year" name="year" value="<?php echo $units->years;?>">
              <label for="area_id" class="form-control-feedback">Tahun</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="mileage" name="mileage" value="<?php echo $units->mileage;?>">
              <label for="area_id" class="form-control-feedback">Jarak Tempuh (KM)</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="stnk_due_date" name="stnk_due_date" value="<?php echo $units->stnk_due_date;?>">
              <label for="area_id" class="form-control-feedback">Masa STNK</label>
            </div>
          </div> 
        </div>  
      </div>
    </div>  
    <div class="col-md-12"> 
      <div class="box box-primary">  
         <div class="box-header">
          <h2>Request Darurat</h2> 
        </div>
        <div class="box-body"> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="maintenance_type" name="maintenance_type" value="<?php echo $maintenance->name;?>" disabled>
              <label for="area_id" class="form-control-feedback">Jenis Darurat</label>
            </div> 
          </div>  
        </div>  
      </div>   
    </div> 

    <div class="col-md-12"> 
      <div class="box box-primary">  
         <div class="box-header">
          <h2>Catatan/Tindakan Koreksi</h2> 
        </div>
        <div class="box-body">  
          <div class="form-group row  col-sm-12"> 
            <textarea class="md-input" id="note" name="note" disabled><?php echo $orders->description?></textarea> 
          </div>  
        </div>  
      </div>
    </div> 
    <div class="col-md-12"> 
      <div class="box box-primary">  
        <div class="box-body"> 
          <div class="form-group row m-t-md">
            <div class="col-sm-12 text-right"> 
              <a href="<?php echo base_url();?>maintenance_request" class="btn btn-sm btn-default ">Batal</a>
            </div>
          </div> 
        </div>  
      </div>
    </div> 
   
  </div> 
  </form>
</div>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-maintenance-routine" src="<?php echo base_url()?>assets/js/require.js"></script>